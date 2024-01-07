<h3><?php _e('General','cftp_admin'); ?></h3>
<p><?php _e('Basic information to be shown around the site. The time format and zones values affect how the clients see the dates on their files lists.','cftp_admin'); ?></p>

<div class="form-group row">
    <label for="this_install_title" class="col-sm-4 control-label"><?php _e('Site name','cftp_admin'); ?></label>
    <div class="col-sm-8">
        <input type="text" name="this_install_title" id="this_install_title" class="form-control" value="<?php echo html_output(get_option('this_install_title')); ?>" required />
    </div>
</div>

<div class="form-group row">
    <label for="timezone" class="col-sm-4 control-label"><?php _e('Timezone','cftp_admin'); ?></label>
    <div class="col-sm-8">
        <?php
            /**
             * Generates a select field.
             * Code is stored on a separate file since it's pretty long.
             */
            include_once 'timezones.php';
        ?>
    </div>
</div>

<div class="form-group row">
    <label for="timeformat" class="col-sm-4 control-label"><?php _e('Time format','cftp_admin'); ?></label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="timeformat" id="timeformat" value="<?php echo get_option('timeformat'); ?>" required />
        <p class="field_note form-text"><?php echo sprintf(__('For example, %s will display the current date and time like this: %s','cftp_admin'), 'd/m/Y h:i:s', date('d/m/Y h:i:s')); ?><br>
            <?php echo sprintf(__("For the full list of available values, visit %s the official PHP Manual %s",'cftp_admin'), '<a href="http://php.net/manual/en/function.date.php" target="_blank">', '</a>'); ?><br>
            <?php _e("This date will be considered for files expiration.",'cftp_admin'); ?><br>
            <?php _e("You can adjust your timezone if your local date/time does not match your server's settings.",'cftp_admin'); ?>
        </p>
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-8 offset-sm-4">
        <label for="footer_custom_enable">
            <input type="checkbox" value="1" name="footer_custom_enable" id="footer_custom_enable" class="checkbox_options" <?php echo (get_option('footer_custom_enable') == 1) ? 'checked="checked"' : ''; ?> /> <?php _e("Use custom footer text",'cftp_admin'); ?>
        </label>
    </div>
</div>

<div class="form-group row">
    <label for="footer_custom_content" class="col-sm-4 control-label"><?php _e('Footer content','cftp_admin'); ?></label>
    <div class="col-sm-8">
        <input type="text" name="footer_custom_content" id="footer_custom_content" class="form-control" value="<?php echo html_output(get_option('footer_custom_content')); ?>" />
    </div>
</div>

<div class="form-group row">
    <label for="pagination_results_per_page" class="col-sm-4 control-label"><?php _e('Pagination results per page','cftp_admin'); ?></label>
    <div class="col-sm-8">
        <select class="form-select" name="pagination_results_per_page" id="pagination_results_per_page" required>
            <?php
                $pagination_amounts = [10, 20, 50, 100];
                foreach ($pagination_amounts as $pagination_amount) {
            ?>
                    <option value="<?php echo $pagination_amount; ?>" <?php echo (get_option('pagination_results_per_page') == $pagination_amount) ? 'selected="selected"' : ''; ?>><?php echo $pagination_amount; ?></option>
            <?php
                }
            ?>
        </select>
        <p class="field_note form-text"><?php _e('Applies to pagination in all administration areas','cftp_admin'); ?>
    </div>
</div>

<div class="options_divide"></div>

<h3><?php _e('Editor','cftp_admin'); ?></h3>

<div class="form-group row">
    <div class="col-sm-8 offset-sm-4">
        <label for="files_descriptions_use_ckeditor">
            <input type="checkbox" value="1" name="files_descriptions_use_ckeditor" id="files_descriptions_use_ckeditor" class="checkbox_options" <?php echo (get_option('files_descriptions_use_ckeditor') == 1) ? 'checked="checked"' : ''; ?> /> <?php _e("Use the visual editor on files descriptions",'cftp_admin'); ?>
        </label>
    </div>
</div>

<div class="options_divide"></div>

<h3><?php _e('Uploads','cftp_admin'); ?></h3>

<div class="form-group row">
    <div class="col-sm-8 offset-sm-4">
        <label for="uploads_organize_folders_by_date">
            <input type="checkbox" value="1" name="uploads_organize_folders_by_date" id="uploads_organize_folders_by_date" class="checkbox_options" <?php echo (get_option('uploads_organize_folders_by_date') == 1) ? 'checked="checked"' : ''; ?> /> <?php _e("Organize uploads in folders based on year and month",'cftp_admin'); ?>
            <p class="field_note form-text"><?php _e("For new uploads only. Will not affect existing files.",'cftp_admin'); ?></p>
        </label>
    </div>
</div>

<h3><?php _e('Uploads defaults','cftp_admin'); ?></h3>

<div class="form-group row">
    <div class="col-sm-8 offset-sm-4">
        <label for="files_default_expire">
            <input type="checkbox" value="1" name="files_default_expire" id="files_default_expire" class="checkbox_options" <?php echo (get_option('files_default_expire') == 1) ? 'checked="checked"' : ''; ?> /> <?php _e("Files expire by default",'cftp_admin'); ?>
        </label>
        <p class="field_note form-text">
            <?php _e('Users can always set an expiration date for files. This option just makes the checkbox marked by default in the editor.', 'cftp_admin'); ?>
            <?php _e('For clients not allowed to set it, this setting will be directly applied to the file.', 'cftp_admin'); ?>
        </p>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-8 offset-sm-4">
        <label for="files_default_public">
            <input type="checkbox" value="1" name="files_default_public" id="files_default_public" class="checkbox_options" <?php echo (get_option('files_default_public') == 1) ? 'checked="checked"' : ''; ?> /> <?php _e("Files are public by default",'cftp_admin'); ?>
        </label>
        <p class="field_note form-text">
            <?php _e('Users can always set a download to be public. This option just makes the checkbox marked by default in the editor.', 'cftp_admin'); ?>
            <?php _e('For clients not allowed to set it, this setting will be directly applied to the file.', 'cftp_admin'); ?>
        </p>
    </div>
</div>

<div class="form-group row">
    <label for="files_default_expire_days_after" class="col-sm-4 control-label"><?php _e('After these many days:','cftp_admin'); ?></label>
    <div class="col-sm-8">
        <input type="text" name="files_default_expire_days_after" id="files_default_expire_days_after" class="form-control" value="<?php echo html_output(get_option('files_default_expire_days_after')); ?>" />
    </div>
</div>

<div class="options_divide"></div>

<h3><?php _e('Language','cftp_admin'); ?></h3>

<div class="form-group row">
    <div class="col-sm-8 offset-sm-4">
        <label for="use_browser_lang">
            <input type="checkbox" value="1" name="use_browser_lang" id="use_browser_lang" class="checkbox_options" <?php echo (get_option('use_browser_lang') == 1) ? 'checked="checked"' : ''; ?> /> <?php _e("Detect user browser language",'cftp_admin'); ?>
            <p class="field_note form-text"><?php _e("If available, will override the default one from the system configuration file. Affects all users and clients.",'cftp_admin'); ?></p>
        </label>
    </div>
</div>

<div class="options_divide"></div>

<h3><?php _e('Downloads','cftp_admin'); ?></h3>
<div class="form-group row">
    <label for="download_method" class="col-sm-4 control-label"><?php _e('Download method','cftp_admin'); ?></label>
    <div class="col-sm-8">
        <select class="form-select" name="download_method" id="download_method" required>
            <option value="php" <?php echo (get_option('download_method') == 'php') ? 'selected="selected"' : ''; ?>>php</option>
            <option value="apache_xsendfile" <?php echo (get_option('download_method') == 'apache_xsendfile') ? 'selected="selected"' : ''; ?>>XSendFile (apache)</option>
            <option value="nginx_xaccel" <?php echo (get_option('download_method') == 'nginx_xaccel') ? 'selected="selected"' : ''; ?>>X-Accel (nginx)</option>
        </select>
        <div class="method_note none" data-method="php">
            <p class="field_note form-text"><?php _e("Serving files with php is the default method and does not require any changes to your webserver. However, very large files could download with errors depending on your php configuration.",'cftp_admin'); ?></p>
        </div>
        <div class="method_note none" data-method="apache_xsendfile">
            <p class="field_note form-text"><?php _e("XSendfile improves downloads by allowing the web server to send the file directly bypassing php and it's limitations. This in an advanced feature that requires you to install and enable a module on your server.",'cftp_admin'); ?></p>
            <p class="field_note form-text"><?php _e("Be aware that if the module is not set up correctly, downloads will trigger but the files will have a length of 0 bytes.",'cftp_admin'); ?></p>
        </div>
        <div class="method_note none" data-method="nginx_xaccel">
            <p class="field_note form-text"><?php _e("X-Accel is a method available in nginx that allows the system to serve files directly, bypassing php and it's limitations. To configure it, you need to edit your server block and add the following code:",'cftp_admin'); ?></p>
            <pre>location <?php echo XACCEL_FILES_URL; ?> {
    internal;
    alias <?php echo UPLOADED_FILES_ROOT; ?>/;
}</pre>
        </div>
    </div>
</div>


<div class="form-group row">
    <div class="col-sm-8 offset-sm-4">
        <label for="download_logging_ignore_file_author">
            <input type="checkbox" value="1" name="download_logging_ignore_file_author" id="download_logging_ignore_file_author" class="checkbox_options" <?php echo (get_option('download_logging_ignore_file_author') == 1) ? 'checked="checked"' : ''; ?> /> <?php _e("Do not log downloads by the file's uploader",'cftp_admin'); ?>
            <p class="field_note form-text"><?php _e("When a user or client downloads their own files, do not log the download or add to the downloads count.",'cftp_admin'); ?></p>
        </label>
    </div>
</div>

<div class="options_divide"></div>

<h3><?php _e('System location','cftp_admin'); ?></h3>
<p class="text-warning"><?php _e('These options are to be changed only if you are moving the system to another place. Changes here can cause ProjectSend to stop working.','cftp_admin'); ?></p>

<div class="form-group row">
    <label for="base_uri" class="col-sm-4 control-label"><?php _e('System URI','cftp_admin'); ?></label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="base_uri" id="base_uri" value="<?php echo BASE_URI; ?>" required />
    </div>
</div>

<h3><?php _e('Custom download URI','cftp_admin'); ?></h3>

<div class="form-group row">
    <label for="custom_download_uri" class="col-sm-4 control-label"><?php _e('Custom download URI','cftp_admin'); ?></label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="custom_download_uri" id="custom_download_uri" value="<?php echo get_option('custom_download_uri'); ?>" />
    </div>
</div>
