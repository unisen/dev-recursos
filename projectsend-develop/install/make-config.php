<?php
/**
 * Contains the form and the processes used to install ProjectSend.
 */
error_reporting(E_ALL);

define('IS_INSTALL', true);
define('IS_MAKE_CONFIG', true);

define('ABS_PARENT', dirname(dirname(__FILE__)));
require_once ABS_PARENT . '/bootstrap.php';

$page_id = 'make_config';

/** Config file exists. Do not continue and show the message */
if (file_exists(CONFIG_FILE)) {
    ps_redirect(BASE_URI . 'install/config-file-exists.php');
}

// array of POST variables to check, with associated default value
$post_vars = array(
    'dbdriver' => 'mysql',
    'dbname' => 'projectsend',
    'dbuser' => 'root',
    'dbpassword' => 'root',
    'dbhost' => 'localhost',
    'dbprefix' => 'tbl_',
    'dbreuse' => 'no',
    'lang' => 'en',
    'maxfilesize' => '2048',
);

// parse all variables in the above array and fill in whatever is sent via POST
foreach ($post_vars as $var => $value) {
    if (isset($_POST[$var])) {
        $post_vars[$var] = trim(stripslashes((string) $_POST[$var]));
    }
}

//check PDO status
$pdo_available_drivers = PDO::getAvailableDrivers();
$pdo_mysql_available = in_array('mysql', $pdo_available_drivers);
$pdo_mssql_available = in_array('dblib', $pdo_available_drivers);
$pdo_driver_available = $pdo_mysql_available || $pdo_mssql_available;

// only mysql driver is available, let's force it
if ($pdo_mysql_available && !$pdo_mssql_available) {
    $post_vars['dbdriver'] = 'mysql';
}

// only mysql driver is available, let's force it
if (!$pdo_mysql_available && $pdo_mssql_available) {
    $post_vars['dbdriver'] = 'mssql';
}

/**
 * Check host connection
 * This function can take a few seconds to respond
 */
if ($pdo_driver_available) {
    $dsn = $post_vars['dbdriver'] . ':host=' . $post_vars['dbhost'] . ';dbname=' . $post_vars['dbname'];
    try {
        $pdo = new PDO($dsn, $post_vars['dbuser'], $post_vars['dbpassword'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $pdo_connected = true;
    } catch (PDOException $ex) {
        $pdo_connected = false;
    }
}

/** List of tables comes from includes/app.php */

// check if tables exists
$table_exists = true;
if ($pdo_connected) {
    $availableTables = $pdo->query("SHOW TABLES")->fetchAll(\PDO::FETCH_COLUMN);
    foreach ($all_system_tables as $name) {
        $prefixed = $post_vars['dbprefix'] . $name;
        if (!in_array($prefixed, $availableTables)) {
            $table_exists = false;
            break;
        }
    }
}
$reuse_tables =  $post_vars['dbreuse'] == 'reuse';

// scan for language files
$langs = get_available_languages();

// ok if selected language has a .po file associated
$lang_ok = array_key_exists($post_vars['lang'], $langs);

// check file & folders are writable
$config_file = CONFIG_FILE;
$config_file_writable = is_writable($config_file) || is_writable(dirname($config_file));
$upload_dir = ROOT_DIR . '/upload';
$upload_files_dir = ROOT_DIR . '/upload/files';
$upload_files_dir_writable = is_writable($upload_files_dir) || is_writable($upload_dir);
$upload_temp_dir = ROOT_DIR . '/upload/temp';
$upload_temp_dir_writable = is_writable($upload_temp_dir) || is_writable($upload_dir);

// retrieve user data for web server
if (function_exists('posix_getpwuid')) {
    $server_user_data = posix_getpwuid(posix_getuid());
    $server_user = $server_user_data['name'] . ' (uid=' . $server_user_data['uid'] . ' gid=' . $server_user_data['gid'] . ')';
} else {
    $server_user = getenv('USERNAME');
}

// if everything is ok, we can proceed
$ready_to_go = $pdo_connected && (!$table_exists || $reuse_tables) && $lang_ok && $config_file_writable && $upload_files_dir_writable && $upload_temp_dir_writable;

// if the user requested to write the config file AND we can proceed, we try to write the new configuration
if (isset($_POST['submit-start']) && $ready_to_go) {
    $template = file_get_contents(ROOT_DIR . '/includes/sys.config.sample.php');
    $template_search = array(
        "'mysql'",
        "'database'",
        "'localhost'",
        "'username'",
        "'password'",
        "'tbl_'",
        "'en'",
        "2048"
    );
    $template_replace = array(
        "'" . $post_vars['dbdriver'] . "'",
        "'" . $post_vars['dbname'] . "'",
        "'" . $post_vars['dbhost'] . "'",
        "'" . $post_vars['dbuser'] . "'",
        "'" . $post_vars['dbpassword'] . "'",
        "'" . $post_vars['dbprefix'] . "'",
        "'" . $post_vars['lang'] . "'",
        "'" . $post_vars['maxfilesize'] . "'",
    );
    $template = str_replace($template_search, $template_replace, $template);

    $result = file_put_contents($config_file, $template, LOCK_EX);
    if ($result > 0) {
        // config file written successfully
        $flash->success(__('Successfully wrote the config file.', 'cftp_admin'));
        ps_redirect('index.php');
    }
}

global $status_indicator_ok;
global $status_indicator_error;
$status_indicator_ok = '<h3><span class="badge bg-success"><i class="fa fa-check" aria-hidden="true"></i></span></h3>';
$status_indicator_error = '<h3><span class="badge bg-danger"><i class="fa fa-times" aria-hidden="true"></i></span></h3>';

function pdo_status_label()
{
    if (empty($_POST)) {
        return null;
    }

    global $pdo_connected;
    global $status_indicator_ok;
    global $status_indicator_error;

    if ($pdo_connected) {
        echo $status_indicator_ok;
    } else {
        echo $status_indicator_error;
    }
}

include_once ABS_PARENT . '/header-unlogged.php';
?>
<div class="row justify-content-md-center">
    <div class="col-12 col-sm-12 col-lg-4">
        <div class="white-box">
            <div class="white-box-interior">
                <form action="make-config.php" name="installform" method="post" class="form-horizontal">

                    <h3><?php _e('Database configuration', 'cftp_admin'); ?></h3>
                    <p><?php _e('You need to provide this data for a correct database communication.', 'cftp_admin'); ?></p>

                    <div class="form-group row">
                        <label for="dbdriver" class="col-12 col-sm-4 control-label"><?php _e('Select driver', 'cftp_admin'); ?></label>
                        <div class="col-12 col-sm-6">
                            <div class="radio <?php if (!$pdo_mysql_available) {
                                                    echo 'disabled';
                                                } ?>">
                                <label for="dbdriver_mysql">
                                    <input type="radio" id="dbdriver_mysql" name="dbdriver" value="mysql" <?php echo !$pdo_mysql_available ? 'disabled' : ''; ?> <?php echo $post_vars['dbdriver'] == 'mysql' ? 'checked' : ''; ?> />
                                    MySQL/MariaDB <?php if (!$pdo_mysql_available) {
                                                        _e('(not available)', 'cftp_admin');
                                                    } ?>
                                </label>
                            </div>
                            <div class="radio <?php if (!$pdo_mssql_available) {
                                                    echo 'disabled';
                                                } ?>">
                                <label for="dbdriver_mssql">
                                    <input type="radio" id="dbdriver_mssql" name="dbdriver" value="mssql" <?php echo !$pdo_mssql_available ? 'disabled' : ''; ?> <?php echo $post_vars['dbdriver'] == 'mssql' ? 'checked' : ''; ?> />
                                    MS SQL Server <?php if (!$pdo_mssql_available) {
                                                        _e('(not available)', 'cftp_admin');
                                                    } ?>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <?php echo ($pdo_driver_available) ? $status_indicator_ok : $status_indicator_error; ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="dbhost" class="col-12 col-sm-4 control-label"><?php _e('Host', 'cftp_admin'); ?></label>
                        <div class="col-12 col-sm-6">
                            <input type="text" name="dbhost" id="dbhost" <?php echo !$pdo_driver_available ? 'disabled' : ''; ?> class="required form-control" value="<?php echo $post_vars['dbhost']; ?>" />
                        </div>
                        <div class="col-sm-2">
                            <?php pdo_status_label(); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="dbname" class="col-12 col-sm-4 control-label"><?php _e('Database name', 'cftp_admin'); ?></label>
                        <div class="col-12 col-sm-6">
                            <input type="text" name="dbname" id="dbname" <?php echo !$pdo_driver_available ? 'disabled' : ''; ?> class="required form-control" value="<?php echo $post_vars['dbname']; ?>" />
                        </div>
                        <div class="col-sm-2">
                            <?php pdo_status_label(); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="dbuser" class="col-12 col-sm-4 control-label"><?php _e('Username', 'cftp_admin'); ?></label>
                        <div class="col-12 col-sm-6">
                            <input type="text" name="dbuser" id="dbuser" <?php echo !$pdo_driver_available ? 'disabled' : ''; ?> class="required form-control" value="<?php echo $post_vars['dbuser']; ?>" />
                        </div>
                        <div class="col-sm-2">
                            <?php pdo_status_label(); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="dbpassword" class="col-12 col-sm-4 control-label"><?php _e('Password', 'cftp_admin'); ?></label>
                        <div class="col-12 col-sm-6">
                            <input type="password" name="dbpassword" id="dbpassword" <?php echo !$pdo_driver_available ? 'disabled' : ''; ?> class="required form-control attach_password_toggler" value="<?php echo $post_vars['dbpassword']; ?>" />
                        </div>
                        <div class="col-sm-2">
                            <?php pdo_status_label(); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="dbprefix" class="col-12 col-sm-4 control-label"><?php _e('Table prefix', 'cftp_admin'); ?></label>
                        <div class="col-12 col-sm-6">
                            <input type="text" name="dbprefix" id="dbprefix" <?php echo !$pdo_driver_available ? 'disabled' : ''; ?> class="required form-control" value="<?php echo $post_vars['dbprefix']; ?>" />
                            <?php if ($pdo_connected && $table_exists) { ?>
                                <p class="badge bg-danger"><?php _e('The database is already populated', 'cftp_admin'); ?></p>
                            <?php } ?>
                        </div>
                        <div class="col-sm-2">
                            <?php
                            if ($pdo_connected) {
                                if (!$table_exists || $reuse_tables) {
                                    echo $status_indicator_ok;
                                } else {
                                    echo $status_indicator_error;
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <?php if ($pdo_connected) : ?>
                        <?php if ($table_exists) : ?>
                            <div class="form-group row">
                                <div class="offset-sm-4 col-12 col-sm-6">
                                    <div class="checkbox">
                                        <label for="dbreuse">
                                            <input type="checkbox" name="dbreuse" id="dbreuse" value="reuse" <?php echo $post_vars['dbreuse'] == 'reuse' ? 'checked' : ''; ?> /> <?php _e('Reuse existing tables', 'cftp_admin'); ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <?php if ($reuse_tables) {
                                        echo $status_indicator_ok;
                                    } ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="options_divide"></div>

                    <h3><?php _e('Language selection', 'cftp_admin'); ?></h3>

                    <div class="form-group row">
                        <label for="lang" class="col-12 col-sm-4 control-label"><?php _e('Language', 'cftp_admin'); ?></label>
                        <div class="col-12 col-sm-8">
                            <select class="form-select" name="lang">
                                <?php foreach ($langs as $filename => $name) : ?>
                                    <option value="<?php echo $filename; ?>" <?php echo $post_vars['lang'] == $filename ? 'selected' : ''; ?>><?php echo $name; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="options_divide"></div>

                    <h3><?php _e('Files', 'cftp_admin'); ?></h3>

                    <div class="form-group row">
                        <label for="lang" class="col-12 col-sm-4 control-label"><?php _e('Default maximum upload file size', 'cftp_admin'); ?></label>
                        <div class="col-12 col-sm-8">
                            <input type="number" name="maxfilesize" id="maxfilesize" class="required form-control" value="<?php echo (!empty($post_vars['maxfilesize'])) ? $post_vars['maxfilesize'] : '2048'; ?>" />
                            <p class="field_note form-text"><?php _e('Value expressed in MB, where 1GB = 1024', 'cftp_admin'); ?></p>
                        </div>
                    </div>

                    <div class="options_divide"></div>

                    <h3><?php _e('Folders', 'cftp_admin'); ?></h3>

                    <?php
                    $write_checks = array(
                        'config' => array(
                            'label' => 'Config file',
                            'file' => $config_file,
                            'status' => $config_file_writable,
                        ),
                        'upload' => array(
                            'label' => 'Upload directory',
                            'file' => $upload_files_dir,
                            'status' => $upload_files_dir_writable,
                        ),
                        'temp' => array(
                            'label' => 'Temp directory',
                            'file' => $upload_temp_dir,
                            'status' => $upload_temp_dir_writable,
                        ),
                    );
                    foreach ($write_checks as $check => $values) {
                    ?>
                        <div class="form-group row">
                            <label class="col-12 col-sm-4 control-label">
                                <?php _e($values['label'], 'cftp_admin'); ?>
                            </label>
                            <div class="col-sm-5">
                                <span class="format_url"><?php echo $values['file']; ?></span>
                            </div>
                            <div class="col-sm-3">
                                <?php if ($values['status'] == true) : ?>
                                    <span class="badge bg-success"><?php _e('Writable', 'cftp_admin'); ?></span>
                                <?php else : ?>
                                    <span class="badge bg-danger"><?php _e('Not writable', 'cftp_admin'); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="options_divide"></div>

                    <h3><?php _e('System information', 'cftp_admin'); ?></h3>

                    <?php
                    $system_info = array(
                        'os' => array(
                            'label' => 'Server OS',
                            'name' => 'server_os',
                            'value' => php_uname(),
                        ),
                        'user' => array(
                            'label' => 'Server user',
                            'name' => 'server_user',
                            'value' => $server_user,
                        ),
                        'version' => array(
                            'label' => 'PHP version',
                            'name' => 'phpversion',
                            'value' => phpversion(),
                        ),
                        'sapi' => array(
                            'label' => 'PHP SAPI',
                            'name' => 'sapi_name',
                            'value' => php_sapi_name(),
                        ),
                        'memory' => array(
                            'label' => 'Memory limit',
                            'name' => 'memory_limit',
                            'value' => ini_get('memory_limit'),
                        ),
                        'post' => array(
                            'label' => 'POST max size',
                            'name' => 'post_max_size',
                            'value' => ini_get('post_max_size'),
                        ),
                        'upload' => array(
                            'label' => 'Upload max filesize',
                            'name' => 'upload_max_filesize',
                            'value' => ini_get('upload_max_filesize'),
                        ),
                    );
                    foreach ($system_info as $data => $values) {
                    ?>
                        <div class="form-group row">
                            <label for="<?php echo $values['name']; ?>" class="col-12 col-sm-4 control-label"><?php _e($values['label'], 'cftp_admin'); ?></label>
                            <div class="col-12 col-sm-8">
                                <input type="text" name="<?php echo $values['name']; ?>" id="<?php echo $values['name']; ?>" class="form-control" disabled value="<?php echo $values['value']; ?>" />
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="inside_form_buttons">
                        <?php if ($ready_to_go) { ?>
                            <button type="submit" name="submit" class="btn btn-wide btn-secondary"><?php _e('Check again', 'cftp_admin'); ?></button>
                            <button type="submit" name="submit-start" class="btn btn-wide btn-primary"><?php _e('Write config file', 'cftp_admin'); ?></button>
                        <?php } else { ?>
                            <?php $btn_label = (empty($_POST)) ? __('Check', 'cftp_admin') : __('Check again', 'cftp_admin'); ?>
                            <button type="submit" name="submit" class="btn btn-wide btn-primary"><?php echo $btn_label; ?></button>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include_once ABS_PARENT . '/footer.php';
