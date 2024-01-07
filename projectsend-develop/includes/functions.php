<?php
/**
 * Define the common functions that can be accessed from anywhere.
 */

use enshrined\svgSanitize\Sanitizer;

function try_queries($queries = [])
{
    global $dbh;

    $total = count($queries);
    $success = 0;
    $failed = 0;

    foreach ($queries as $i => $value) {
        try {
            $statement = $dbh->prepare($queries[$i]['query']);
            if (!empty($queries[$i]['params'])) {
                foreach ($queries[$i]['params'] as $name => $value) {
                    $statement->bindValue($name, $value);
                }
            }
            $statement->execute($queries[$i]['params']);
            $success++;
        } catch (Exception $e) {
            $failed++;
        }
    }

    return $failed == 0;
}

function get_server_requirements_errors()
{
    $errors_found = [];

    // Check for PDO extensions
    $pdo_available_drivers = PDO::getAvailableDrivers();
    if (empty($pdo_available_drivers)) {
        $errors_found[] = sprintf(__('Missing required extension: %s', 'cftp_admin'), 'pdo');
    } else {
        if ((DB_DRIVER == 'mysql') && !defined('PDO::MYSQL_ATTR_INIT_COMMAND')) {
            $errors_found[] = sprintf(__('Missing required extension: %s', 'cftp_admin'), 'pdo');
        }
        if ((DB_DRIVER == 'mssql') && !in_array('dblib', $pdo_available_drivers)) {
            $errors_found[] = sprintf(__('Missing required extension: %s', 'cftp_admin'), 'pdo');
        }
    }

    // Version requirements
    $version_not_met =  __('%s minimum version not met. Please upgrade to at least version %s', 'cftp_admin');

    // php
    if (version_compare(phpversion(), REQUIRED_VERSION_PHP, "<")) {
        $errors_found[] = sprintf($version_not_met, 'php', REQUIRED_VERSION_PHP);
    }

    // mysql
    global $dbh;
    if (!empty($dbh)) {
        $version_mysql = $dbh->query('SELECT version()')->fetchColumn();
        if (version_compare($version_mysql, REQUIRED_VERSION_MYSQL, "<")) {
            $errors_found[] = sprintf($version_not_met, 'MySQL', REQUIRED_VERSION_MYSQL);
        }
    }

    return $errors_found;
}

function check_server_requirements()
{
    $errors = get_server_requirements_errors();

    if (!empty($errors)) {
        ps_redirect(PAGE_STATUS_CODE_REQUIREMENTS);
    }
}

/**
 * Check if ProjectSend is installed by trying to find the main users table.
 * If it is missing, the installation is invalid.
 */
function is_projectsend_installed()
{
    $tables_need = array(
        TABLE_USERS
    );

    $tables_missing = 0;
    /**
     * This table list is defined on app.php
     */
    foreach ($tables_need as $table) {
        if (!table_exists($table)) {
            $tables_missing++;
        }
    }
    if ($tables_missing > 0) {
        return false;
    } else {
        return true;
    }
}

function is_unique_username($string)
{
    global $dbh;
    $statement = $dbh->prepare("SELECT * FROM " . TABLE_USERS . " WHERE user = :user");
    $statement->execute(array(':user'    => $string));
    if ($statement->rowCount() > 0) {
        return false;
    }

    return true;
}

/** Prevents an infinite loop */
function force_logout()
{
    $auth = new \ProjectSend\Classes\Auth();
    $auth->logout();

    ps_redirect(BASE_URI);
}

/**
 * Check if curl is enabled
 */
function curl_is_enabled()
{
    return function_exists('curl_version');
}

/** Gets a Json file from and url and caches the result */
function get_json($url, $cache_time)
{
    $cache_dir = JSON_CACHE_DIR;
    $cacheFile = $cache_dir . DS . md5($url);

    if (file_exists($cacheFile)) {
        $fh = fopen($cacheFile, 'r');
        $cacheTime = trim(fgets($fh));

        // if data was cached recently, return cached data
        if ($cacheTime > strtotime($cache_time)) {
            return fread($fh, filesize($cacheFile));
        }

        // else delete cache file
        fclose($fh);
        unlink($cacheFile);
    }

    if (curl_is_enabled()) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, CURL_TIMEOUT_SECONDS);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, CURL_TIMEOUT_SECONDS);

        $json = curl_exec($ch);
        curl_close($ch);

        $fh = fopen($cacheFile, 'w');
        fwrite($fh, time() . "\n");
        fwrite($fh, $json);
        fclose($fh);
    } else {
        $json = file_get_contents($url);
    }

    return $json;
}

/**
 * To successfully add the orderby and order parameters to a query,
 * check if the column exists on the table and validate that order
 * is either ASC or DESC.
 * Defaults to ORDER BY: id, ORDER: DESC
 */
function sql_add_order($table, $column = 'id', $initial_order = 'ASC')
{
    global $dbh;
    $allowed_custom_sort_columns = array('download_count');

    $columns_query = $dbh->query('SELECT * FROM ' . $table . ' LIMIT 1');
    if ($columns_query->rowCount() > 0) {
        $columns_keys = array_keys($columns_query->fetch(PDO::FETCH_ASSOC));
        $columns_keys = array_merge($columns_keys, $allowed_custom_sort_columns);
        $orderby = (isset($_GET['orderby']) && in_array($_GET['orderby'], $columns_keys)) ? $_GET['orderby'] : $column;

        $order = (isset($_GET['order'])) ? strtoupper($_GET['order']) : $initial_order;
        $order = (preg_match("/^(DESC|ASC)$/", $order)) ? $order : $initial_order;

        return " ORDER BY $orderby $order";
    } else {
        return false;
    }
}

function generate_password($length = 12)
{
    $error_unexpected = __('An unexpected error has occurred', 'cftp_admin');
    $error_os_fail = __('Could not generate a random password', 'cftp_admin');

    try {
        $password = random_bytes($length);
    } catch (TypeError $e) {
        die($error_unexpected);
    } catch (Error $e) {
        die($error_unexpected);
    } catch (Exception $e) {
        die($error_os_fail);
    }

    return bin2hex($password);
}


/**
 * Reads the lang folder and scans for .mo files.
 * Returns an array of available languages.
 */
function get_available_languages()
{
    /** Load the language and locales names list */
    require ROOT_DIR . '/includes/language.locales.names.php';

    $langs = [];

    $mo_files = glob(ROOT_DIR . '/lang/*.mo');
    foreach ($mo_files as $file) {
        $lang_file = pathinfo($file, PATHINFO_FILENAME);
        $extension = pathinfo($file, PATHINFO_EXTENSION);

        if (array_key_exists($lang_file, $locales_names)) {
            $lang_name = $locales_names[$lang_file];
        } else {
            $lang_name = $lang_file;
        }

        $langs[$lang_file] = $lang_name;
    }

    /** Sort alphabetically */
    asort($langs, SORT_STRING);

    return $langs;
}

/**
 * Get the total count of downloads grouped by file
 * Data returned:
 * - Count anonymous downloads (Public downloads)
 * - Unique logged in clients downloads
 * - Total count
 */
function get_downloads_information($id = null)
{
    global $dbh;

    $data = [];

    $sql = "SELECT file_id, COUNT(*) as downloads, SUM( ISNULL(user_id) ) AS anonymous_users, COUNT(DISTINCT user_id) as unique_clients FROM " . TABLE_DOWNLOADS;
    if (!empty($id)) {
        $sql .= ' WHERE file_id = :id';
    }

    $sql .= " GROUP BY file_id";

    $statement = $dbh->prepare($sql);

    if (!empty($id)) {
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
    }

    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);

    if (!empty($id)) {
        $data[$id] = array(
            'file_id' => $id,
            'total' => 0,
            'unique_clients' => 0,
            'anonymous_users' => 0,
        );
    }

    while ($row = $statement->fetch()) {
        $data[$row['file_id']] = array(
            'file_id' => html_output($row['file_id']),
            'total' => html_output($row['downloads']),
            'unique_clients' => html_output($row['unique_clients']),
            'anonymous_users' => html_output($row['anonymous_users']),
        );
    }

    return $data;
}

/**
 * Check if a table exists in the current database.
 *
 * @param string $table Table to search for.
 * @return bool TRUE if table exists, FALSE if no table found.
 * by esbite on http://stackoverflow.com/questions/1717495/check-if-a-database-table-exists-using-php-pdo
 */
function table_exists($table)
{
    global $dbh;

    $result = false;

    if (!empty($dbh)) {
        try {
            $statement = $dbh->prepare("SELECT 1 FROM $table LIMIT 1");
            $result = $statement->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    // Result is either boolean FALSE (no table found) or PDOStatement Object (table found)
    return $result !== false;
}

/**
 * Check if a file id exists on the database.
 * Used on the download information page.
 *
 * @return bool
 */
function download_information_exists($id)
{
    global $dbh;
    $statement = $dbh->prepare("SELECT id FROM " . TABLE_DOWNLOADS . " WHERE file_id = :id");
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    if ($statement->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}


/**
 * Check if a client id exists on the database.
 * Used on the Edit client page.
 *
 * @return bool
 */
function client_exists_id($id)
{
    global $dbh;
    $statement = $dbh->prepare("SELECT * FROM " . TABLE_USERS . " WHERE id=:id");
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    if ($statement->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

/**
 * Check if a user id exists on the database.
 * Used on the Edit user page.
 *
 * @return bool
 */
function user_exists_id($id)
{
    global $dbh;
    $statement = $dbh->prepare("SELECT * FROM " . TABLE_USERS . " WHERE id=:id");
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    if ($statement->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

/**
 * Get all the client information knowing only the id
 * Used on the Manage files page.
 *
 * @return array
 */
function get_client_by_id($client)
{
    global $dbh;

    $statement = $dbh->prepare("SELECT * FROM " . TABLE_USERS . " WHERE id=:id");
    $statement->bindParam(':id', $client, PDO::PARAM_INT);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);

    if ($statement->rowCount() > 0) {
        while ($row = $statement->fetch()) {
            $information = array(
                'id' => html_output($row['id']),
                'username' => html_output($row['user']),
                'name' => html_output($row['name']),
                'address' => html_output($row['address']),
                'phone' => html_output($row['phone']),
                'email' => html_output($row['email']),
                'notify_upload' => html_output($row['notify']),
                'level' => html_output($row['level']),
                'active' => html_output($row['active']),
                'max_file_size' => html_output($row['max_file_size']),
                'can_upload_public' => html_output($row['can_upload_public']),
                'contact' => html_output($row['contact']),
                'created_date' => html_output($row['timestamp']),
                'created_by' => html_output($row['created_by'])
            );
            if (!empty($information)) {
                return $information;
            } else {
                return false;
            }
        }
    } else {
        return false;
    }
}

function username_exists($username)
{
    global $dbh;
    $statement = $dbh->prepare("SELECT * FROM " . TABLE_USERS . " WHERE user = :user");
    $statement->execute([
        ':user' => $username,
    ]);

    if ($statement->rowCount() > 0) {
        return true;
    }

    return false;
}

function generate_random_password()
{
    return bin2hex(openssl_random_pseudo_bytes(5));
}

function generate_username($from)
{
    $cut = substr($from, 0, MAX_USER_CHARS);
    if (!username_exists($cut)) {
        return $cut;
    }

    $rand = substr(uniqid(), 0, MAX_USER_CHARS);

    return $rand;
}

/**
 * Get all the client information knowing only the log in username
 *
 * @return array
 */
function get_client_by_username($client)
{
    global $dbh;

    $statement = $dbh->prepare("SELECT id FROM " . TABLE_USERS . " WHERE user=:username");
    $statement->bindParam(':username', $client);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);

    while ($row = $statement->fetch()) {
        $found_id = html_output($row['id']);
        if (!empty($found_id)) {
            $information = get_client_by_id($found_id);
            return $information;
        } else {
            return false;
        }
    }
}

/**
 * Get a user using any of the accepted field names
 * 
 * @uses get_user_by_id
 * @return array
 */
function get_user_by($user_type, $field, $value)
{
    global $dbh;

    $field = (string)$field;
    $field = trim(strip_Tags(htmlentities(strtolower($field))));
    $acceptable_fields = [
        'username',
        'name',
        'email',
    ];

    if (in_array($field, $acceptable_fields)) {
        $statement = $dbh->prepare("SELECT id FROM " . TABLE_USERS . " WHERE `$field`=:value");
        $statement->bindParam(':value', $value);
        $statement->execute();

        $result = $statement->fetchColumn();
        if ($result) {
            switch ($user_type) {
                case 'user':
                    $user_data = get_user_by_id($result);
                    break;
                case 'client':
                    $user_data = get_client_by_id($result);
            }

            return $user_data;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

/**
 * Get all the user information knowing only the id
 *
 * @return array
 */
function get_user_by_id($id)
{
    global $dbh;

    $statement = $dbh->prepare("SELECT * FROM " . TABLE_USERS . " WHERE id=:id");
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);

    while ($row = $statement->fetch()) {
        $information = array(
            'id' => html_output($row['id']),
            'username' => html_output($row['user']),
            'name' => html_output($row['name']),
            'email' => html_output($row['email']),
            'level' => html_output($row['level']),
            'active' => html_output($row['active']),
            'max_file_size' => html_output($row['max_file_size']),
            'created_date' => html_output($row['timestamp']),
        );
        if (!empty($information)) {
            return $information;
        } else {
            return false;
        }
    }
}

/**
 * Get all the user information knowing only the log in username
 *
 * @return array
 * @uses get_user_by_id
 */
function get_user_by_username($user)
{
    global $dbh;

    $statement = $dbh->prepare("SELECT * FROM " . TABLE_USERS . " WHERE user=:user");
    $statement->execute(
        array(
            ':user' => $user
        )
    );
    $statement->setFetchMode(PDO::FETCH_ASSOC);

    if ($statement->rowCount() > 0) {
        while ($row = $statement->fetch()) {
            $found_id = html_output($row['id']);
            if (!empty($found_id)) {
                $information = get_user_by_id($found_id);
                return $information;
            } else {
                return false;
            }
        }
    } else {
        return false;
    }
}

function current_user_can($permission, $params = [])
{
    global $permissions;
    return $permissions->can($permission);
}

function client_can_upload_public($client_id)
{
    switch (get_option('clients_can_set_public')) {
        case 'all':
            return true;
            break;
        case 'allowed':
            $client = get_client_by_id($client_id);
            return (bool)$client['can_upload_public'];
            break;
    }

    return false;
}

function client_can_assign_to_public_folder($client_id)
{
    if (!client_can_upload_public($client_id)) {
        return false;
    }

    if (get_option('clients_can_upload_to_public_folders') == '1') {
        return true;
    }

    return false;
}

function current_user_can_upload()
{
    if (!defined('CURRENT_USER_LEVEL')) {
        return false;
    }

    switch (CURRENT_USER_LEVEL) {
        case 9:
        case 8:
        case 7:
            return true;
            break;
        case 0:
            return (get_option('clients_can_upload') == '1');
            break;
        default:
            break;
    }

    return false;
}

function current_user_can_upload_public()
{
    switch (CURRENT_USER_LEVEL) {
        case 9:
        case 8:
        case 7:
            return true;
            break;
        case 0:
            return client_can_upload_public(CURRENT_USER_ID);
            break;
        default:
            break;
        }

    return false;
}

/**
 * Get all the file information knowing only the id
 * Used on the Download information page.
 *
 * @return array
 */
function get_file_by_id($id)
{
    global $dbh;
    $statement = $dbh->prepare("SELECT * FROM " . TABLE_FILES . " WHERE id=:id");
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);

    while ($row = $statement->fetch()) {
        $information = array(
            'id' => html_output($row['id']),
            'user_id' => html_output($row['user_id']),
            'title' => html_output($row['filename']),
            'original_url' => html_output($row['original_url']),
            'url' => html_output($row['url']),
            'description' => html_output($row['description']),
            'uploaded_date' => html_output($row['timestamp']),
            'uploaded_by' => html_output($row['uploader']),
            'expires' => html_output($row['expires']),
            'expiry_date' => html_output($row['expiry_date']),
            'public' => html_output($row['public_allow']),
            'public_token' => html_output($row['public_token']),
        );

        if (!empty($information)) {
            return $information;
        } else {
            return false;
        }
    }
}

/**
 * Get all the file information knowing only the id
 * Used on the Download information page.
 *
 * @return array
 */
function get_file_by_filename($filename)
{
    global $dbh;
    $statement = $dbh->prepare("SELECT * FROM " . TABLE_FILES . " WHERE url=:filename");
    $statement->execute(
        array(
            ':filename' => $filename
        )
    );

    if ($statement->rowCount() > 0) {
        while ($row = $statement->fetch()) {
            $found_id = $row['id'];
            if (!empty($found_id)) {
                $information = get_file_by_id($found_id);
                return $information;
            } else {
                return false;
            }
        }
    }

    return false;
}

function get_file_assignations($file_id)
{
    if (empty($file_id)) {
        return false;
    }

    if (!is_numeric($file_id)) {
        return false;
    }

    global $dbh;

    $statement = $dbh->prepare("SELECT * FROM " . TABLE_FILES_RELATIONS . " WHERE file_id = :file_id");
    $statement->bindParam(':file_id', $file_id, PDO::PARAM_INT);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);

    $count = $statement->rowCount();

    $return = [
        'clients' => [],
        'groups' => [],
    ];

    if ($count > 0) {
        while ($row = $statement->fetch()) {
            if (!empty($row['client_id'])) {
                $return['clients'][$row['client_id']] = [
                    'hidden' => $row['hidden'],
                ];
            }

            if (!empty($row['group_id'])) {
                $return['groups'][$row['group_id']] = [
                    'hidden' => $row['hidden'],
                ];
            }
        }

        return $return;
    }

    return false;
}

/**
 * Standard footer mark up and information generated on this function to
 * prevent code repetition.
 * Used on the default template, log in page, install page and the back-end
 * footer file.
 */
function render_footer_text()
{
    ?>
    <footer>
        <div id="footer">
            <?php
            if (is_projectsend_installed() && get_option('footer_custom_enable') == '1') {
                echo strip_tags(get_option('footer_custom_content'), '<br><span><a><strong><em><b><i><u><s>');
            } else {
                // $link = '<a href="'.SYSTEM_URI.'" target="_blank">'.SYSTEM_NAME.'</a>';
                // echo sprintf(__('Provided by %s', 'cftp_admin'), $link);
                _e('Provided by', 'cftp_admin'); ?> <a href="<?php echo SYSTEM_URI; ?>" target="_blank"><?php echo SYSTEM_NAME; ?></a> <?php if (user_is_logged_in() == true) {
                    _e('version', 'cftp_admin');
                    echo ' ' . CURRENT_VERSION;
                } ?> - <?php _e('Free software', 'cftp_admin');
            }
            ?>
        </div>
    </footer>
<?php
}

/**
 * function render_json_variables
 * 
 * Adds a CDATA block with variables that are used on the main JS file
 * URLs. text strings, etc.
 */
function render_json_variables()
{
    global $json_strings;
    $output = json_encode($json_strings);
?>
    <script type="text/javascript">
        /*<![CDATA[*/
        var json_strings = <?php echo $output; ?>;
        /*]]>*/
    </script>
    <?php
}

/**
 * Standard "There are no clients" message mark up and information
 * generated on this function to prevent code repetition.
 *
 * Used on the upload pages and the clients list.
 */
function message_no_clients()
{
    global $dbh;
    // Count the clients to show a warning message or the form
    $statement = $dbh->query("SELECT id FROM " . TABLE_USERS . " WHERE level = '0'");
    $count_clients = $statement->rowCount();
    $statement = $dbh->query("SELECT id FROM " . TABLE_GROUPS);
    $count_groups = $statement->rowCount();

    if ((!$count_clients or $count_clients < 1) && (!$count_groups or $count_groups < 1)) {
        global $flash;
        $msg = '<strong>' . __('Important:', 'cftp_admin') . '</strong> ' . __('There are no clients or groups at the moment. You can still upload files and assign them later.', 'cftp_admin');
        $flash->warning($msg);
    }
}


/**
 * Generate a system text message.
 *
 * Current CSS available message classes:
 * - message_ok
 * - message_error
 * - message_info
 *
 */
/**
 * Generate a system text message using Bootstrap's alert box.
 */
function system_message($type, $message, $div_id = '')
{
    if (empty($type)) {
        $type = 'success';
    }

    switch ($type) {
        case 'success':
            break;
        case 'danger':
            break;
        case 'info':
            break;
        case 'warning':
            break;
    }

    $return = '<div class="alert alert-' . $type . '"';
    if (isset($div_id) && $div_id != '') {
        $return .= ' id="' . $div_id . '"';
    }

    $return .= '>';

    if (isset($close) && $close == true) {
        $return .= '<a href="#" class="close" data-dismiss="alert">&times;</a>';
    }

    $return .= $message;

    $return .= '</div>';
    return $return;
}


/**
 * Function used across the system to determine if the current logged in
 * account has permission to do something.
 *
 */
function current_role_in($levels)
{
    if (!is_array($levels)) {
        $levels = array($levels);
    }

    if (isset($_SESSION['role']) && (in_array($_SESSION['role'], $levels))) {
        return true;
    } else {
        return false;
    }
}


/**
 * Returns the current logged in account level either from the active
 * session or the cookies.
 *
 * @todo Validate the returned value against the one stored on the database
 */
function get_current_user_level()
{
    $level = 0;
    if (isset($_SESSION['role'])) {
        $level = $_SESSION['role'];
    }

    return $level;
}

/**
 * Wrap print_r with pre tags
 */
function print_array($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

/**
 * Alias for previous function
 */
function pa($array)
{
    print_array($array);
}

/**
 * Prints array and ends execution
 */
function pax($array)
{
    print_array($array);
    exit;
}

function va($array)
{
    echo '<pre>';
    var_dump($array);
    echo '</pre>';
}

function vax($array)
{
    va($array);
    exit;
}

/**
 * Wrapper for htmlentities with default options
 *
 */
function html_output($str, $flags = ENT_QUOTES, $encoding = CHARSET, $double_encode = false)
{
    if ($str == null) { return; }
    return htmlentities($str ?? '', $flags, $encoding, $double_encode);
}

/**
 * Allow some html tags for file and group descriptions on htmlentities
 *
 */
function htmlentities_allowed($str, $quoteStyle = ENT_COMPAT, $charset = CHARSET, $doubleEncode = false)
{
    if ($str == null) { return $str; }
    //$description = htmlspecialchars($str, $quoteStyle, $charset, $doubleEncode);
    $string = htmlspecialchars_decode($str, $quoteStyle);
    return strip_tags($string, '<i><b><strong><em><p><br><ul><ol><li><u><sup><sub><s>');
        /*
    $allowed_tags = array('i','b','strong','em','p','br','ul','ol','li','u','sup','sub','s');

    $find = [];
    $replace = [];

    foreach ( $allowed_tags as $tag ) {
        // Opening tags
        $find[] = '&lt;' . $tag . '&gt;';
        $replace[] = '<' . $tag . '>';
        // Closing tags
        $find[] = '&lt;/' . $tag . '&gt;';
        $replace[] = '</' . $tag . '>';
    }

    $description = str_replace($find, $replace, $description);
    return $description
    */;
}

// Remove script and style tags
function htmlentities_allowed_code_editor($html, $quoteStyle = ENT_COMPAT, $charset = CHARSET, $doubleEncode = false)
{
    if (!empty($html)) {
        $html = htmlspecialchars_decode($html, $quoteStyle);
    }
    // $html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);
    // $html = preg_replace('#<style(.*?)>(.*?)</style>#is', '', $html);

    return $html;
}

/**
 * Solution by Philippe Flipflip. Fixes an error that would not convert special
 * characters when saving to the database.
 */
function encode_html($str)
{
    $str = htmlentities($str, ENT_QUOTES, $encoding = CHARSET);
    $str = nl2br($str);
    //$str = addslashes($str);
    return $str;
}


/**
 * Based on a script found on webcheatsheet. Fixed an issue from the original code.
 * Used on the installation form to fill the URI field automatically.
 *
 * @author		http://webcheatsheet.com
 * @link		http://www.webcheatsheet.com/php/get_current_page_url.php
 */
function get_current_url()
{
    $pageURL = 'http';
    if (!empty($_SERVER['HTTPS'])) {
        if ($_SERVER['HTTPS'] == 'on') {
            $pageURL .= "s";
        }
    }
    $pageURL .= "://";
    /*
    ** Using $_SERVER["HTTP_HOST"] now.
    ** Fixing problems wth the old solution: $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"] when using a reverse proxy.
    ** HTTP_HOST already includes port number (if non-standard), no specific handling of port number necessary.
    */
    $pageURL .= $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

    /**
     * Check if we are accessing the install folder or the index.php file directly
     */
    $extension = substr($pageURL, -4);
    if ($extension == '.php') {
        $pageURL = substr($pageURL, 0, -17);
        return $pageURL;
    } else {
        $pageURL = substr($pageURL, 0, -8);
        return $pageURL;
    }
}

function file_is_allowed($filename)
{
    if (true == user_can_upload_any_file_type(CURRENT_USER_ID)) {
        return true;
    }

    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $allowed_extensions = explode(',', strtolower(get_option('allowed_file_types')));
    if (in_array($extension, $allowed_extensions)) {
        return true;
    }

    return false;
}

/**
 * Receives the size of a file in bytes, and formats it for readability.
 * Used on files listings (templates and the files manager).
 */
function format_file_size($file)
{
    if ($file < 1024) {
        /** No digits so put a ? much better than just seeing Byte */
        $formatted = (ctype_digit($file)) ? $file . ' Byte' :  ' ? ';
    } elseif ($file < 1048576) {
        $formatted = round($file / 1024, 2) . ' KB';
    } elseif ($file < 1073741824) {
        $formatted = round($file / 1048576, 2) . ' MB';
    } elseif ($file < 1099511627776) {
        $formatted = round($file / 1073741824, 2) . ' GB';
    } elseif ($file < 1125899906842624) {
        $formatted = round($file / 1099511627776, 2) . ' TB';
    } elseif ($file < 1152921504606846976) {
        $formatted = round($file / 1125899906842624, 2) . ' PB';
    } elseif ($file < 1180591620717411303424) {
        $formatted = round($file / 1152921504606846976, 2) . ' EB';
    } elseif ($file < 1208925819614629174706176) {
        $formatted = round($file / 1180591620717411303424, 2) . ' ZB';
    } else {
        $formatted = round($file / 1208925819614629174706176, 2) . ' YB';
    }

    return $formatted;
}


/**
 * Since filesize() was giving trouble with files larger
 * than 2gb, I looked for a solution and found this great
 * function by Alessandro Marinuzzi from www.alecos.it on
 * http://stackoverflow.com/questions/5501451/php-x86-how-
 * to-get-filesize-of-2gb-file-without-external-program
 *
 * I changed the name of the function and split it in 2,
 * because I do not want to display it directly.
 */
function get_real_size($file)
{
    clearstatcache();
    $ff = filesize($file);

    if (isEnabled('shell_exec')) {
        if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
            if (class_exists("COM")) {
                $fsobj = new COM('Scripting.FileSystemObject');
                $f = $fsobj->GetFile(realpath($file));
                $ff = $f->Size;
            } else {
                $ff = trim(exec("for %F in (\"" . escapeshellarg($file) . "\") do @echo %~zF"));
            }
        } elseif (PHP_OS == 'Darwin') {
            $ff = trim(shell_exec("stat -L -f %z " . escapeshellarg($file)));
        } elseif (PHP_OS == 'FreeBSD') {
            $ff = trim(shell_exec("stat -L -f%z " . escapeshellarg($file)));
        } elseif ((PHP_OS == 'Linux') || (PHP_OS == 'Unix') || (PHP_OS == 'SunOS')) {
            $ff = trim(shell_exec("stat -L -c%s " . escapeshellarg($file)));
        }
    }

    /** Fix for 0kb downloads by AlanReiblein */
    if (!ctype_digit($ff)) {
        /* returned value not a number so try filesize() */
        $ff = filesize($file);
    }

    return $ff;
}

/**
 * function isEnabled()
 * From https://stackoverflow.com/questions/21581560/php-how-to-know-if-server-allows-shell-exec
 */
function isEnabled(string $func)
{
    return is_callable($func) && false === stripos(ini_get('disable_functions'), $func);
}

/**
 * Delete just one file.
 * Used on the files management page.
 */
function delete_file_from_disk($filename)
{
    if (file_exists($filename)) {
        @chmod($filename, 0777);
        return unlink($filename);
    } else {
        return true;
    }

    return false;
}

/**
 * Deletes all files and sub-folders of the selected directory.
 * Used when deleting a client.
 */
function delete_recursive($dir)
{
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if ($file != "." && $file != "..") {
                    if (is_dir($dir . $file)) {
                        delete_recursive($dir . $file . "/");
                        rmdir($dir . $file);
                    } else {
                        @chmod($dir . $file, 0777);
                        unlink($dir . $file);
                    }
                }
            }
            closedir($dh);
            rmdir($dir);
        }
    }
}

/**
 * Takes a text string and makes an excerpt.
 */
function make_excerpt($string, $length, $break = "...")
{
    if (strlen($string) > $length) {
        $pos = strpos($string, " ", $length);
        return substr($string, 0, $pos) . $break;
    }
    return $string;
}

/**
 * Generates a random string to be used on the automatically
 * created zip files and tokens.
 */
function generate_random_string($length = 10)
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $rnd_result = '';
    for ($i = 0; $i < $length; $i++) {
        $rnd_result .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $rnd_result;
}

function get_file_type_by_mime($full_path)
{
    if (!file_exists($full_path)) {
        return null;
    }

    $mimeType = mime_content_type($full_path);

    return $mimeType;
}

function file_is_image($full_path)
{
    $mimeType = get_file_type_by_mime($full_path);
    if ($mimeType != null && explode('/', $mimeType)[0] == 'image') {
        return true;
    }

    return false;
}

function file_is_video($full_path)
{
    $mimeType = get_file_type_by_mime($full_path);
    if (explode('/', $mimeType)[0] == 'video') {
        return true;
    }

    return false;
}

function file_is_audio($full_path)
{
    $mimeType = get_file_type_by_mime($full_path);
    if (explode('/', $mimeType)[0] == 'audio') {
        return true;
    }

    return false;
}

/**
 * Try to recognize if a file is a valid svg
 */
function file_is_svg($file)
{
    if (file_exists($file)) {
        // Check by mime type
            if (in_array(mime_content_type($file), [
                'image/svg+xml',
                'image/svg',
            ])) {
                return true;
            }
    } else {
        return false;
    }
}

function sanitize_svg($file)
{
    try {
        $svg_sanitizer = new Sanitizer();
        $source_file = file_get_contents($file);
        $sanitized_file = $svg_sanitizer->sanitize($source_file);
        return $sanitized_file;
    } catch (\Exception $e) {
        return null;
    }
}

/**
 * Make a thumbnail with SimpleImage
 */
function make_thumbnail($file, $type = 'thumbnail', $width = THUMBS_MAX_WIDTH, $height = THUMBS_MAX_HEIGHT, $quality = THUMBS_QUALITY)
{
    $thumbnail = [];

    if (!file_exists($file)) {
        $thumbnail_file = 'thumb_unavailable_' . $width . 'x' . $height . '.png';

        $thumbnail['original']['url'] = ASSETS_IMG_URL . '/thumbnail-unavailable.png';
        $thumbnail['thumbnail']['location'] = THUMBNAILS_FILES_DIR . DS . $thumbnail_file;
        $thumbnail['thumbnail']['url'] = THUMBNAILS_FILES_URL . '/' . $thumbnail_file;

        $file = ASSETS_IMG_DIR . DS . '/thumbnail-unavailable.png'; // Reset to make thumbnail
    } else {
        if (file_is_image($file)) {
            if (file_is_svg($file)) {
                if (get_option('svg_show_as_thumbnail') == '1') {
                    $file = str_replace(ROOT_DIR, BASE_URI, $file);
                    $thumbnail['original']['url'] = $file;
                    $thumbnail['thumbnail']['location'] = $file;
                    $thumbnail['thumbnail']['url'] = $file;
                }

                return $thumbnail;
            }
            /** Original extension */
            $pathinfo = pathinfo($file);
            $filename = md5($pathinfo['basename']);
            $extension = strtolower($pathinfo['extension']);
            $mime_type = mime_content_type($file);

            $thumbnail_file = 'thumb_' . $filename . '_' . $width . 'x' . $height . '.' . $extension;

            $thumbnail['original']['url'] = $file;
            $thumbnail['thumbnail']['location'] = THUMBNAILS_FILES_DIR . DS . $thumbnail_file;
            $thumbnail['thumbnail']['url'] = THUMBNAILS_FILES_URL . '/' . $thumbnail_file;
        }
    }

    if (!file_exists($thumbnail['thumbnail']['location'])) {
        try {
            $image = new \claviska\SimpleImage();
            $image
                ->fromFile($file)
                ->autoOrient();

            switch ($type) {
                case 'proportional':
                    $method = 'bestFit';
                    break;
                case 'thumbnail':
                default:
                    $method = 'thumbnail';
                    break;
            }

            $image->$method($width, $height);

            $image
                ->toFile($thumbnail['thumbnail']['location'], $mime_type, $quality);
        } catch (Exception $err) {
            $thumbnail['error'] = $err->getMessage();
        }
    }

    return $thumbnail;
}

/**
 * Prepare the branding image file using the database options
 * for the file name and the thumbnails path value.
 */
function generate_logo_url()
{
    $branding = [];
    $branding['exists'] = false;
    $logo_filename = get_option('logo_filename');
    if (empty($logo_filename)) {
        $branding['dir'] = ASSETS_IMG_DIR . DS . DEFAULT_LOGO_FILENAME;
        $branding['url'] = ASSETS_IMG_URL . '/' . DEFAULT_LOGO_FILENAME;
    } else {
        $branding['dir'] = ADMIN_UPLOADS_DIR . DS . $logo_filename;
        $branding['url'] = ADMIN_UPLOADS_URI . $logo_filename;
    }

    if (file_exists($branding['dir'])) {
        $branding['exists'] = true;

        /* Make thumbnails for raster files */
        if (file_is_image($branding['dir'])) {
            $thumbnail = make_thumbnail($branding['dir'], 'proportional', LOGO_MAX_WIDTH, LOGO_MAX_HEIGHT);
            $branding['thumbnail'] = (!empty($thumbnail['thumbnail']['url'])) ? $thumbnail['thumbnail']['url'] : $branding['url'];
            $branding['thumbnail_info'] = $thumbnail;
            $branding['type'] = 'raster';
        } elseif (file_is_svg($branding['dir'])) {
            $branding['type'] = 'vector';
            $branding['thumbnail'] = $branding['dir']; // no thumbnail, just return the original file
        }

        $branding['ext'] = pathinfo($branding['dir'], PATHINFO_EXTENSION);
    }

    return $branding;
}

/**
 * Returns the corresponding layout to show an image tag or the svg contents
 * of the current uploaded logo file.
 */
function get_branding_layout($return_thumbnail = false)
{
    $layout = '<figure>%LOGO%</figure>';

    $branding = generate_logo_url();

    if ($branding['exists'] === true) {
        $branding_image = ($return_thumbnail === true) ? $branding['thumbnail'] : $branding['url'];
    } else {
        $branding_image = ASSETS_IMG_URL . DEFAULT_LOGO_FILENAME;
    }

    $replace = '<img src="' . $branding_image . '" alt="' . html_output(get_option('this_install_title')) . '" />';

    if ($branding['type'] == 'raster') {
        $replace = '<img src="' . $branding_image . '" alt="' . html_output(get_option('this_install_title')) . '" />';
    } elseif ($branding['type'] == 'vector') {
        $replace = sanitize_svg($branding['dir']);
    }

    $layout = str_replace('%LOGO%', $replace, $layout);

    return $layout;
}

/**
 * This function is called when a file is loaded
 * directly, but it shouldn't.
 */
function prevent_direct_access()
{
    if (!defined('CAN_INCLUDE_FILES')) {
        ob_end_flush();
        exit;
    }
}

/**
 * Add a noindex to the header
 */
function meta_noindex()
{
    $option = get_option('privacy_noindex_site');

    if (!empty($option)) {
        if ((int)$option == 1) {
            echo '<meta name="robots" content="noindex">';
        }
    }
}

/**
 * Favicon meta tags
 */
function meta_favicon()
{
    $favicon_location = BASE_URI . 'assets/img/favicon/';
    echo '<link rel="apple-touch-icon" sizes="180x180" href="' . $favicon_location . 'apple-touch-icon.png">';
    echo '<link rel="icon" type="image/png" sizes="32x32" href="' . $favicon_location . 'favicon-32x32.png">';
    echo '<link rel="icon" type="image/png" sizes="16x16" href="' . $favicon_location . 'favicon-16x16.png">';
    echo '<link rel="manifest" href="' . $favicon_location . 'site.webmanifest">';
    echo '<meta name="theme-color" content="#4c2ab6">';
}


/**
 * If password rules are set, show a message
 */
function password_notes()
{
    $pass_notes_output = '';
    global $json_strings;

    $rules_active = [];
    $rules = array(
        'lower' => array(
            'value' => get_option('pass_require_lower'),
            'text' => $json_strings['validation']['req_lower'],
        ),
        'upper' => array(
            'value' => get_option('pass_require_upper'),
            'text' => $json_strings['validation']['req_upper'],
        ),
        'number' => array(
            'value' => get_option('pass_require_number'),
            'text' => $json_strings['validation']['req_number'],
        ),
        'special' => array(
            'value' => get_option('pass_require_special'),
            'text' => $json_strings['validation']['req_special'],
        ),
    );

    foreach ($rules as $rule => $data) {
        if ($data['value'] == '1') {
            $rules_active[$rule] = $data['text'];
        }
    }

    if (count($rules_active) > 0) {
        $pass_notes_output = '<p class="field_note form-text">' . __('The password must contain, at least:', 'cftp_admin') . '</strong><br />';
        foreach ($rules_active as $rule => $text) {
            $pass_notes_output .= '- ' . $text . '<br>';
        }
        $pass_notes_output .= '</p>';
    }

    return $pass_notes_output;
}

/**
 * Adds default and custom css classes to the body.
 */
function add_body_class($custom = '')
{
    /** Remove query string */
    $current_url = strtok($_SERVER['REQUEST_URI'], '?');
    $classes = array('body');

    $pathinfo = pathinfo($current_url);

    if (!empty($pathinfo['extension'])) {
        $classes = array(
            strpos($pathinfo['filename'], "?"),
            str_replace('.', '-', $pathinfo['filename']),
        );
    }

    if (user_is_logged_in()) {
        $classes[] = 'logged-in';

        $logged_type = CURRENT_USER_LEVEL == '0' ? 'client' : 'admin';

        $classes[] = 'logged-as-' . $logged_type;
    }

    if (!empty($custom) && is_array($custom)) {
        $classes = array_merge($classes, $custom);
    }

    if (!in_array('template-default', $classes)) {
        $classes[] = 'backend';
    }

    $classes = array_filter(array_unique($classes));

    $render = 'class="' . implode(' ', $classes) . '"';
    return $render;
}

function add_page_id($id)
{
    $return = '';

    if (!empty($id)) {
        $return .= 'data-page-id="' . $id . '"';
    }

    return $return;
}

/**
 * Creates a standardized download link. Used on
 * each template.
 */
function make_download_link($file_info)
{
    $download_link = BASE_URI . 'process.php?do=download&amp;id=' . $file_info['id'];

    return $download_link;
}

/**
 * Convert to array only if it's not one already
 */
function to_array_if_not($data)
{
    if (!is_array($data)) {
        $value = array($data);
    } else {
        $value = $data;
    }

    return $value;
}

function generate_safe_filename($filename)
{
    $original_filename = pathinfo(trim($filename));
    $filename = $original_filename['filename'];
    $extension = $original_filename['extension'];

    // Replace accent characters, foreign languages
    $search = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
    $replace = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
    $filename = str_replace($search, $replace, $filename);

    // Replace common characters
    $search = array('&', '£', '$');
    $replace = array('and', 'pounds', 'dollars');
    $filename = str_replace($search, $replace, $filename);

    // Remove - for spaces and union characters
    $search = array(' ', '&', '\r\n', '\n', '+', ',', '//');
    $replace = '-';
    $filename = str_replace($search, $replace, $filename);

    // Delete and replace rest of special chars
    $search = array('/[^a-zA-Z0-9\-<>_]/', '/[\-]+/', '/<[^>]*>/', '/[  *]/');
    $replace = array('', '-', '', '-');
    $filename = preg_replace($search, $replace, $filename);

    return $filename . '.' . $extension;
}

/**
 * Simple file upload. Used on normal file fields, eg: logo on branding page
 */
function option_file_upload($file, $validate_type = '', $option = '', $action = '')
{
    global $dbh;
    $continue = true;

    /** Validate file extensions */
    if (!empty($validate_type)) {
        switch ($validate_type) {
            case 'image':
                $validate_types = "/^\.(jpg|jpeg|gif|png|svg){1}$/i";
                break;
            default:
                break;
        }
    }

    if (is_uploaded_file($file['tmp_name'])) {
        $safe_filename = generate_safe_filename($file['name']);
        /**
         * Check the file type for allowed extensions.
         */
        if (!empty($validate_types) && !preg_match($validate_types, strrchr($safe_filename, '.'))) {
            $continue = false;
        }
        
        if (file_is_svg($file['tmp_name'])) {
            file_put_contents($file['tmp_name'], sanitize_svg($file['tmp_name']));
        }

        if ($continue) {
            /**
             * Move the file to the destination defined on app.php. If ok, add the
             * new file name to the database.
             */
            if (move_uploaded_file($file['tmp_name'], ADMIN_UPLOADS_DIR . DS . $safe_filename)) {
                if (!empty($option)) {
                    save_option($option, $safe_filename);
                }

                // Record the action log
                if (!empty($action)) {
                    $logger = new \ProjectSend\Classes\ActionsLog;
                    $new_record_action = $logger->addEntry([
                        'action' => $action,
                        'owner_id' => CURRENT_USER_ID
                    ]);
                }

                return [
                    'status' => 'success'
                ];
            } else {
                $error = __('The file could not be moved to the corresponding folder.', 'cftp_admin');
                $error .= __("This is most likely a permissions issue. If that's the case, it can be corrected via FTP by setting the chmod value of the", 'cftp_admin');
                $error .= ' ' . ADMIN_UPLOADS_DIR . ' ';
                $error .= __('directory to 755, or 777 as a last resource.', 'cftp_admin');
                $error .= __("If this doesn't solve the issue, try giving the same values to the directories above that one until it works.", 'cftp_admin');

                return [
                    'status' => 'error',
                    'message' => $error,
                ];
            }
        } else {
            return [
                'status' => 'error',
                'message' => __('The file you selected is not an allowed format.', 'cftp_admin'),
            ];
        }
    }

    return [
        'status' => 'error',
        'message' => __('There was an error uploading the file. Please try again.', 'cftp_admin'),
    ];
}

function format_date($date)
{
    if (!$date) {
        return false;
    }

    $formatted = date(get_option('timeformat'), strtotime($date));

    return $formatted;
}

function format_time($date)
{
    if (!$date) {
        return false;
    }

    $formatted = date('h:i:s', strtotime($date));

    return $formatted;
}

function extensionIsAllowed($extension)
{
    $allowed_extensions = explode(',', get_option('allowed_file_types'));
    if (in_array($extension, $allowed_extensions)) {
        return true;
    }

    return false;
}

function file_editor_get_all_clients()
{
    global $dbh;

    /** Fill the users array that will be used on the notifications process */
    //$users = [];
    $clients = [];

    $statement = $dbh->prepare("SELECT id, name, level FROM " . TABLE_USERS . " WHERE level='0' AND account_requested='0' ORDER BY name ASC");
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    while ($row = $statement->fetch()) {
        $clients[$row["id"]] = $row["name"];
    }

    return $clients;
}

function file_editor_get_clients_by_ids($clients_ids = [])
{
    global $dbh;

    if (empty($clients_ids)) {
        return [];
    }

    $clients = [];
    $clients_ids = implode(',', $clients_ids);
    $statement = $dbh->prepare("SELECT id, name, level FROM " . TABLE_USERS . " WHERE level='0' AND account_requested='0' AND FIND_IN_SET(id, :clients_ids) ORDER BY name ASC");
    $statement->bindParam(':clients_ids', $clients_ids);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    while ($row = $statement->fetch()) {
        $clients[$row["id"]] = $row["name"];
    }

    return $clients;
}

function file_editor_get_all_groups()
{
    global $dbh;

    /** Fill the groups array that will be used on the form */
    $groups = [];
    $statement = $dbh->prepare("SELECT id, name FROM " . TABLE_GROUPS . " ORDER BY name ASC");
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    while ($row = $statement->fetch()) {
        $groups[$row["id"]] = $row["name"];
    }

    return $groups;
}

function file_editor_get_groups_by_members($clients_ids = [])
{
    if (empty($clients_ids)) {
        return [];
    }

    global $dbh;

    $groups_find_in = [];
    $clients_ids = implode(',', $clients_ids);
    $statement = $dbh->prepare("SELECT DISTINCT group_id FROM " . TABLE_MEMBERS . " WHERE FIND_IN_SET(client_id, :clients_ids)");
    $statement->bindParam(':clients_ids', $clients_ids);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    while ($row = $statement->fetch()) {
        $groups_find_in[] = $row['group_id'];
    }

    if (empty($groups_find_in)) {
        return [];
    }

    /** Fill the groups array that will be used on the form */
    $groups = [];
    $groups_find_in = implode(',', $groups_find_in);
    $statement = $dbh->prepare("SELECT id, name FROM " . TABLE_GROUPS . " WHERE FIND_IN_SET(id, :groups_ids) ORDER BY name ASC");
    $statement->bindParam(':groups_ids', $groups_find_in);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    while ($row = $statement->fetch()) {
        $groups[$row["id"]] = $row["name"];
    }

    return $groups;
}

function user_can_edit_file($user_id = null, $file_id = null)
{
    if (empty($user_id) or empty($file_id)) {
        return false;
    }

    $user = get_user_by_id($user_id);

    if (in_array($user['level'], [9, 8])) {
        return true;
        // Special case for uploader?
        // } elseif ($user['level'] == 7) {
        //     return true;
    } else {
        $file = get_file_by_id($file_id);

        // Pre-update when column didn't exist
        if ($file['user_id'] == null) {
            if ($user['username'] == $file['uploaded_by']) {
                return true;
            }
        }
        if ($user['id'] == $file['user_id']) {
            return true;
        }
    }

    return false;
}

function record_new_download($user_id = CURRENT_USER_ID, $file_id = null)
{
    global $dbh;
    if (empty($file_id)) {
        return false;
    }

    if (!is_numeric($user_id) || !is_numeric($file_id)) {
        return false;
    }

    // Anonymous download
    $ip = get_client_ip();
    $host = (!empty($_SERVER['REMOTE_HOST'])) ? $_SERVER['REMOTE_HOST'] : null;
    switch (get_option('privacy_record_downloads_ip_address')) {
        default:
        case 'all':
            break;
        case 'anonymous':
            if ($user_id != 0) {
                $ip = null;
                $host = null;
            }
            break;
        case 'none':
            $ip = null;
            $host = null;
            break;
    }

    if ($user_id == 0) {
        $statement = $dbh->prepare("INSERT INTO " . TABLE_DOWNLOADS . " (file_id, remote_ip, remote_host, anonymous) VALUES (:file_id, :remote_ip, :remote_host, :anonymous)");
        $statement->bindParam(':file_id', $file_id, PDO::PARAM_INT);
        $statement->bindParam(':remote_ip', $ip);
        $statement->bindParam(':remote_host', $host);
        $statement->bindValue(':anonymous', 1, PDO::PARAM_INT);
        $statement->execute();
    } else {
        // Do not log if option is enabled and downloader is the original author
        if (get_option('download_logging_ignore_file_author') == '1') {
            $file = new \ProjectSend\Classes\Files($file_id);
            if ($file->user_id == $user_id) {
                return;
            }
        }

        // Record the download
        $statement = $dbh->prepare("INSERT INTO " . TABLE_DOWNLOADS . " (user_id , file_id, remote_ip, remote_host) VALUES (:user_id, :file_id, :remote_ip, :remote_host)");
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->bindParam(':file_id', $file_id, PDO::PARAM_INT);
        $statement->bindParam(':remote_ip', $ip);
        $statement->bindParam(':remote_host', $host);
        $statement->execute();
    }

    if (!empty($statement)) {
        return true;
    }

    return false;
}

function user_can_download_file($user_id = CURRENT_USER_ID, $file_id = null)
{
    global $dbh;
    if (empty($file_id)) {
        return false;
    }

    if (!is_numeric($user_id) || !is_numeric($file_id)) {
        return false;
    }


    if (CURRENT_USER_LEVEL != 0) {
        return true;
    }

    // Get the file
    $file = new \ProjectSend\Classes\Files($file_id);

    // Get groups
    $get_groups = new \ProjectSend\Classes\GroupsMemberships();
    $found_groups = $get_groups->getGroupsByClient([
        'client_id' => $user_id,
        'return' => 'list',
    ]);

    if ($file->user_id == $user_id) {
        return true;
    } else {
        if ($file->expires == '0' || $file->expired == false) {
            $statement = $dbh->prepare("SELECT * FROM " . TABLE_FILES_RELATIONS . " WHERE (client_id = :client_id OR FIND_IN_SET(group_id, :groups)) AND file_id = :file_id AND hidden = '0'");
            $statement->bindValue(':client_id', $user_id, PDO::PARAM_INT);
            $statement->bindParam(':groups', $found_groups);
            $statement->bindParam(':file_id', $file->id, PDO::PARAM_INT);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $row = $statement->fetch();

            if ($row) {
                return true;
            }
        }
    }

    return false;
}

function count_groups_requests_for_existing_clients()
{
    global $dbh;
    $count = 0;
    $ignore_user_ids = [];

    // First, get accounts requests. This will give us the ids of the clients that we need to ignore later
    $statement = $dbh->prepare("SELECT id FROM " . TABLE_USERS . " WHERE level='0' AND active='1' AND account_denied='0'");
    $statement->execute();
    if ($statement->rowCount() > 0) {
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $statement->fetch()) {
            $ignore_user_ids[] = $row['id'];
        }
    }

    if (!empty($ignore_user_ids)) {
        $ignore_user_ids = implode(',', $ignore_user_ids);

        $statement = $dbh->prepare("SELECT id FROM " . TABLE_MEMBERS_REQUESTS . " WHERE denied='0' AND FIND_IN_SET(client_id, :ignore)");
        $statement->bindParam(':ignore', $ignore_user_ids);
        $statement->execute();
        $count = $statement->rowCount();
    }

    return $count;
}

function count_memberships_requests_denied()
{
    global $dbh;

    $sql_requests = $dbh->prepare("SELECT DISTINCT id FROM " . TABLE_MEMBERS_REQUESTS . " WHERE denied='1'");
    $sql_requests->execute();
   
    return $sql_requests->rowCount();
}

function count_account_requests()
{
    global $dbh;

    $sql_requests = $dbh->prepare("SELECT DISTINCT user FROM " . TABLE_USERS . " WHERE account_requested='1' AND account_denied='0'");
    $sql_requests->execute();

    return $sql_requests->rowCount();
}

function count_account_requests_denied()
{
    global $dbh;

    $sql_requests = $dbh->prepare("SELECT DISTINCT user FROM " . TABLE_USERS . " WHERE account_requested='1' AND account_denied='1'");
    $sql_requests->execute();

    return $sql_requests->rowCount();
}


// Function to get the client ip address
function get_client_ip()
{
    // The 'null' value should pass validators
    $ip = '0.0.0.0';

    // Expanded for readability
    $ipHeaders = array(
        'HTTP_X_REAL_IP',
        'X-Forwarded-For',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_CLIENT_IP',
        'HTTP_VIA',
        'CF-Connecting-IP',
        'REMOTE_ADDR',
    );
    
    // A bit more concise 
    foreach($ipHeaders as $header) {
        if (empty($_SERVER[$header])) continue;
        $ip = $_SERVER[$header];
        break;
    }
    
    // Simplified single IP filtering
    return explode(',', $ip)[0];
}

function convert_seconds($seconds)
{

    $return = [
        'hours' => floor($seconds / 3600),
        'minutes' => floor(($seconds / 60 % 60)),
    ];

    return $return;
}

function sanitize_filename_for_download($file_name)
{
    $file_name = str_replace(
        [
            '"', "'", ' ', ','
        ],
        '_',
        $file_name
    );

    return $file_name;
}

function recaptcha2_is_enabled()
{
    if (
        get_option('recaptcha_enabled') == 1 &&
        !empty(get_option('recaptcha_site_key')) &&
        !empty(get_option('recaptcha_secret_key'))
    ) {
        return true;
    }

    return false;
}

function recaptcha2_render_widget()
{
    if (recaptcha2_is_enabled()) {
    ?>
        <div class="form-group row">
            <!-- <label><?php _e('Verification', 'cftp_admin'); ?></label> -->
            <div class="g-recaptcha" data-sitekey="<?php echo get_option('recaptcha_site_key'); ?>"></div>
        </div>
<?php
    }
}

function recaptcha2_get_request()
{
    $recaptcha_request = null;

    if (recaptcha2_is_enabled()) {
        $recaptcha_user_ip        = $_SERVER["REMOTE_ADDR"];
        $recaptcha_response        = $_POST['g-recaptcha-response'];
        $recaptcha_secret_key    = get_option('recaptcha_secret_key');
        $recaptcha_request        = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptcha_secret_key}&response={$recaptcha_response}&remoteip={$recaptcha_user_ip}");
    }

    return $recaptcha_request;
}

function recaptcha2_validate_request($redirect = true)
{
    $validation_passed = false;

    if (recaptcha2_is_enabled()) {
        $validation = new \ProjectSend\Classes\Validation;
        $validation->validate_items([
            recaptcha2_get_request() => [
                'recaptcha2' => [],
            ],
        ]);

        if ($validation->passed()) {
            $validation_passed = true;
        }
    } else {
        $validation_passed = true;
    }

    if ($redirect && !$validation_passed) {
        exit_with_error_code(403);
    }

    return $validation_passed;
}

function ps_redirect($location, $status = 303)
{
    while (ob_get_level()) ob_end_clean();
    header("Location: $location", true, $status);
    exit;
}

function die_with_error_code($code = 403)
{
    http_response_code( $code );
    exit;
}

function exit_with_error_code($code = 403)
{
    switch ($code) {
        default:
        case 403:
            $url = PAGE_STATUS_CODE_403;
            break;
        case 404:
            $url = PAGE_STATUS_CODE_404;
            break;
    }

    ps_redirect($url);
}

function is_view_type($type)
{
    switch ($type) {
        case 'public':
        case 'private':
        case 'template':
            return get_current_view_type() == $type;
            break;
        default:
            return false;
            break;
    }
}

function get_current_view_type()
{
    if (defined('VIEW_TYPE')) {
        return VIEW_TYPE;
    }

    return null;
}

// From https://stackoverflow.com/questions/20545301/partially-hide-email-address-in-php
function mask($str, $first, $last)
{
    $len = strlen($str);
    $toShow = $first + $last;
    return substr($str, 0, $len <= $toShow ? 0 : $first) . str_repeat("*", $len - ($len <= $toShow ? 0 : $toShow)) . substr($str, $len - $last, $len <= $toShow ? 0 : $last);
}

function mask_email($email)
{
    $mail_parts = explode("@", $email);
    $domain_parts = explode('.', $mail_parts[1]);

    $mail_parts[0] = mask($mail_parts[0], 2, 1); // show first 2 letters and last 1 letter
    $domain_parts[0] = mask($domain_parts[0], 2, 1); // same here
    $mail_parts[1] = implode('.', $domain_parts);

    return implode("@", $mail_parts);
}

function modify_url_with_parameters($url, $parameters_add = [], $parameters_remove = [])
{
    $base_url = strtok($url, '?');
    $parsed = parse_url($url);
    if (empty($parsed['query'])) {
        $query = '';
    } else {
        $query = $parsed['query'];
    }
    parse_str($query, $params);
    if (!empty($parameters_remove)) {
        foreach ($parameters_remove as $parameter) {
            unset($params[$parameter]);
        }
    }
    if (!empty($parameters_add)) {
        foreach ($parameters_add as $parameter => $value) {
            $params[$parameter] = $value;
        }
    }

    return (!empty($params)) ? $base_url.'?'.http_build_query($params) : $base_url;
}

function make_return_to_url($from = null, $encode = false)
{
    $return_to = BASE_URI;
    if (!empty($from)) {
        $from = basename($_SERVER['REQUEST_URI']);
        if (strpos($from, '.php') !== false) {
            $return_to .= $from;
        }
    }

    if ($encode) {
        return urlencode($return_to);
    }

    return $return_to;
}
