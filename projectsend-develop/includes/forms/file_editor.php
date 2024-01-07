<form action="files-edit.php?ids=<?php echo html_output($_GET['ids']); ?><?php if (isset($_GET['confirm'])) { echo "&confirmed=true"; } ?>" name="files" id="files" method="post" enctype="multipart/form-data">
    <?php addCsrf(); ?>

    <div class="container-fluid">
        <?php
            $i = 1;

            $me = new \ProjectSend\Classes\Users(CURRENT_USER_ID);
            if ($me->shouldLimitUploadTo() && !empty($me->limit_upload_to)) {
                $clients = file_editor_get_clients_by_ids($me->limit_upload_to);
                $groups = file_editor_get_groups_by_members($me->limit_upload_to);
            } else {
                $clients = file_editor_get_all_clients();
                $groups = file_editor_get_all_groups();
            }

            foreach ($editable as $file_id) {
                clearstatcache();
                $file = new ProjectSend\Classes\Files($file_id);
                if ($file->recordExists()) {
                    if ($file->existsOnDisk()) {
            ?>
                        <div class="file_editor_wrapper">
                            <div class="row">
                                <div class="col-12">
                                    <div class="file_title">
                                        <button type="button" class="btn btn-md btn-secondary toggle_file_editor">
                                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                        </button>
                                        <p><?php echo $file->filename_original; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row file_editor">
                                <div class="col-12">
                                    <div class="row gx-5">
                                        <div class="col">
                                            <div class="file_data">
                                                <h3><?php _e('File information', 'cftp_admin');?></h3>
                                                <input type="hidden" name="file[<?php echo $i; ?>][id]" value="<?php echo $file->id; ?>" />
                                                <input type="hidden" name="file[<?php echo $i; ?>][original]" value="<?php echo $file->filename_original; ?>" />
                                                <input type="hidden" name="file[<?php echo $i; ?>][file]" value="<?php echo $file->filename_on_disk; ?>" />

                                                <div class="form-group">
                                                    <label><?php _e('Title', 'cftp_admin');?></label>
                                                    <input type="text" name="file[<?php echo $i; ?>][name]" value="<?php echo $file->title; ?>" class="form-control" placeholder="<?php _e('Enter here the required file title.', 'cftp_admin');?>" />
                                                </div>

                                                <div class="form-group">
                                                    <label><?php _e('Description', 'cftp_admin');?></label>
                                                    <textarea id="description_<?php echo $file->id; ?>" name="file[<?php echo $i; ?>][description]" class="<?php if ( get_option('files_descriptions_use_ckeditor') == 1 ) { echo 'ckeditor'; } ?> form-control textarea_description" placeholder="<?php _e('Optionally, enter here a description for the file.', 'cftp_admin');?>"><?php if (!empty($file->description)) { echo $file->description; } ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                            // The following options are available to users or client if clients_can_set_expiration_date set
                                            if (CURRENT_USER_LEVEL != 0 || get_option('clients_can_set_expiration_date') == '1' ) {
                                        ?>
                                                <div class="col">
                                                    <div class="file_data">
                                                        <h3><?php _e('Expiration date', 'cftp_admin');?></h3>

                                                        <div class="form-group">
                                                            <label for="file[<?php echo $i; ?>][expires_date]"><?php _e('Select a date', 'cftp_admin');?></label>
                                                            <div class="input-group date-container">
                                                                <input type="text" class="date-field form-control datapick-field readonly-not-grayed" readonly id="file_expiry_date_<?php echo $i; ?>" name="file[<?php echo $i; ?>][expiry_date]" value="<?php echo (!empty($file->expiry_date)) ? date('d-m-Y', strtotime($file->expiry_date)) : date('d-m-Y'); ?>" />
                                                                <div class="input-group-text">
                                                                    <i class="fa fa-clock-o"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="checkbox">
                                                            <label for="exp_checkbox_<?php echo $i; ?>">
                                                                <input type="checkbox" class="checkbox_setting_expires" name="file[<?php echo $i; ?>][expires]" id="exp_checkbox_<?php echo $i; ?>" value="1" <?php if ($file->expires) { ?>checked="checked"<?php } ?> /> <?php _e('File expires', 'cftp_admin');?>
                                                            </label>
                                                        </div>

                                                        <?php
                                                            // The following options are available to users only
                                                            if (CURRENT_USER_LEVEL != 0 || current_user_can_upload_public()) {
                                                        ?>
                                                                <div class="divider"></div>

                                                                <h3><?php _e('Public downloading', 'cftp_admin');?></h3>

                                                                <div class="checkbox">
                                                                    <label for="pub_checkbox_<?php echo $i; ?>">
                                                                        <input type="checkbox" class="checkbox_setting_public" id="pub_checkbox_<?php echo $i; ?>" name="file[<?php echo $i; ?>][public]" value="1" <?php if ($file->public) { ?>checked="checked"<?php } ?>/> <?php _e('Allow public downloading of this file.', 'cftp_admin');?>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <div class="divider"></div>
                                                                    <h3><?php _e('Custom download aliases', 'cftp_admin');?></h3>
                                                                    <?php foreach ($file->getCustomDownloads() as $j => $custom_download) {
                                                                        $trans = __('Enter a custom download link.', 'cftp_admin');
                                                                        $custom_download_uri = get_option('custom_download_uri');
                                                                        if (!$custom_download_uri) $custom_download_uri = BASE_URI . 'custom-download.php?link=';
                                                                        echo <<<EOL
                                                                            <div class="input-group">
                                                                                <input type="hidden" value="{$custom_download['link']}" name="file[$i][custom_downloads][$j][id]" />
                                                                                <input type="text" name="file[$i][custom_downloads][$j][link]"
                                                                                    id="custom_download_input_$j"
                                                                                    value="{$custom_download['link']}"
                                                                                    class="form-control"
                                                                                    placeholder="$trans" />
                                                                                <a href="#" class="input-group-text" onclick="copyTextToClipboard('$custom_download_uri' + document.getElementById('custom_download_input_$j').value);">
                                                                                    <i class="fa fa-copy" style="cursor: pointer"></i>
                                                                                </a>
                                                                            </div>
EOL;
                                                                    }
                                                                    ?>
                                                                    <p class="field_note form-text">
                                                                        <?php echo sprintf(__('Optional: enter an alias to use on the custom download link. Ej: "my-first-file" will let you download this file from %s'), BASE_URI.'custom-download.php?link=my-first-file'); ?>
                                                                    </p>
                                                                </div>
                                                        <?php
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                        <?php
                                            }

                                            // Only show the CLIENTS select field if the current uploader is a system user, and not a client.
                                            if (CURRENT_USER_LEVEL != 0) {
                                        ?>
                                                <div class="col assigns">
                                                    <div class="file_data">
                                                        <h3><?php _e('Assignations', 'cftp_admin');?></h3>
                                                        <label><?php _e('Clients', 'cftp_admin');?></label>
                                                        <select class="form-select select2 assignments_clients none" multiple="multiple" id="clients_<?php echo $file->id; ?>" name="file[<?php echo $i; ?>][assignments][clients][]" data-file-id="<?php echo $file->id; ?>" data-type="clients" data-placeholder="<?php _e('Select one or more options. Type to search.', 'cftp_admin');?>">
                                                            <?php
                                                                foreach($clients as $id => $name) {
                                                                ?>
                                                                    <option value="<?php echo html_output($id); ?>" <?php if (in_array($id, $file->assignments_clients)) { echo ' selected="selected"'; } ?>>
                                                                        <?php echo html_output($name); ?>
                                                                    </option>
                                                                <?php
                                                                }
                                                            ?>
                                                        </select>
                                                        <div class="select_control_buttons">
                                                            <button type="button" class="btn btn-sm btn-primary add-all" data-target="clients_<?php echo $file->id; ?>"><?php _e('Add all','cftp_admin'); ?></button>
                                                            <button type="button" class="btn btn-sm btn-primary remove-all" data-target="clients_<?php echo $file->id; ?>"><?php _e('Remove all','cftp_admin'); ?></button>
                                                        </div>

                                                        <div class="divider"></div>

                                                        <label><?php _e('Groups', 'cftp_admin');?></label>
                                                        <select class="form-select select2 assignments_groups none" multiple="multiple" id="groups_<?php echo $file->id; ?>" name="file[<?php echo $i; ?>][assignments][groups][]" data-file-id="<?php echo $file->id; ?>" data-type="groups" data-placeholder="<?php _e('Select one or more options. Type to search.', 'cftp_admin');?>">
                                                            <?php
                                                                foreach($groups as $id => $name) {
                                                                ?>
                                                                    <option value="<?php echo html_output($id); ?>" <?php if (in_array($id, $file->assignments_groups)) { echo ' selected="selected"'; } ?>>
                                                                        <?php echo html_output($name); ?>
                                                                    </option>
                                                                <?php
                                                                }
                                                            ?>
                                                        </select>
                                                        <div class="select_control_buttons">
                                                            <button type="button" class="btn btn-sm btn-primary add-all" data-target="groups_<?php echo $file->id; ?>"><?php _e('Add all','cftp_admin'); ?></button>
                                                            <button type="button" class="btn btn-sm btn-primary remove-all" data-target="groups_<?php echo $file->id; ?>"><?php _e('Remove all','cftp_admin'); ?></button>
                                                        </div>

                                                        <div class="divider"></div>

                                                        <div class="checkbox">
                                                            <label for="hid_checkbox_<?php echo $i; ?>">
                                                                <input type="checkbox" class="checkbox_setting_hidden" id="hid_checkbox_<?php echo $i; ?>" name="file[<?php echo $i; ?>][hidden]" value="1" /> <?php _e('Hidden (will not send notifications or show into the files list)', 'cftp_admin');?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        ?>
                                        <div class="col">
                                            <?php
                                                if (CURRENT_USER_LEVEL != 0) {
                                                    $generate_categories_options = generate_categories_options( $get_categories['arranged'], 0, $file->categories);
                                            ?>
                                                    <div class="categories">
                                                        <div class="file_data">
                                                            <h3><?php _e('Categories', 'cftp_admin');?></h3>
                                                            <label><?php _e('Add to', 'cftp_admin');?>:</label>
                                                            <select class="form-select select2 none" multiple="multiple" id="categories_<?php echo $file->id; ?>" name="file[<?php echo $i; ?>][categories][]" data-type="categories" data-placeholder="<?php _e('Select one or more options. Type to search.', 'cftp_admin');?>">
                                                                <?php echo render_categories_options($generate_categories_options, ['selected' => $file->categories, 'ignore' => $ignore]); ?>
                                                            </select>
                                                            <div class="select_control_buttons">
                                                                <button type="button" class="btn btn-sm btn-primary add-all" data-target="categories_<?php echo $file->id; ?>"><?php _e('Add all','cftp_admin'); ?></button>
                                                                <button type="button" class="btn btn-sm btn-primary remove-all" data-target="categories_<?php echo $file->id; ?>"><?php _e('Remove all','cftp_admin'); ?></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php
                                                }
                                            ?>

                                            <div class="folders">
                                                <h3><?php _e('Location', 'cftp_admin');?></h3>
                                                <label><?php _e('Store in this folder', 'cftp_admin');?>:</label>
                                                <?php
                                                    $ignore = [];
                                                    if (CURRENT_USER_LEVEL == 0) {
                                                        $see_public_folders = get_option('clients_files_list_include_public');
                                                        $statement = $dbh->prepare("SELECT * FROM " . TABLE_FOLDERS);
                                                        $statement->execute();
                                                        if ($statement->rowCount() > 0) {
                                                            $statement->setFetchMode(PDO::FETCH_ASSOC);
                                                            while ($folder_row = $statement->fetch()) {
                                                                if ($folder_row['user_id'] == CURRENT_USER_ID) {
                                                                    continue;
                                                                }
                                                                if ($see_public_folders == '1' && $folder_row['public'] != 1) {
                                                                    $ignore[] = $folder_row['id'];
                                                                }
                                                            }
                                                        }
                                                    }

                                                    $folders = new \ProjectSend\Classes\Folders;
                                                    $folders_arranged = $folders->getAllArranged();

                                                    if (CURRENT_USER_LEVEL == 0 && get_option('clients_files_list_include_public')) {
                                                        $folders_arguments['public_or_client'] = true;
                                                    }
                                                ?>
                                                <select class="form-select select2 none" id="folder_<?php echo $file->id; ?>" name="file[<?php echo $i; ?>][folder_id]" data-type="folder" data-placeholder="<?php _e('Optional. Type to search.', 'cftp_admin');?>">
                                                    <option value=""><?php _e('Root','cftp_admin'); ?></option>
                                                    <?php echo $folders->renderSelectOptions($folders_arranged, ['selected' => $file->folder_id, 'ignore' => $ignore]); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                        // Copy settings buttons
                                        $copy_buttons = [];
                                        if (count($editable) > 1) {
                                            // Expiration
                                            if (CURRENT_USER_LEVEL != 0 || get_option('clients_can_set_expiration_date') == '1' ) {
                                                $copy_buttons['expiration'] = [
                                                    'label' => __('Expiration settings','cftp_admin'),
                                                    'class' => 'copy-expiration-settings',
                                                    'data' => [
                                                        'copy-from' => 'exp_checkbox_'.$i,
                                                        'copy-date-from' => 'file_expiry_date_'.$i,
                                                    ],
                                                ];
                                            }
                                            // Public checkbox
                                            if (CURRENT_USER_LEVEL != 0 || current_user_can_upload_public()) {
                                                $copy_buttons['public'] = [
                                                    'label' => __('Public settings','cftp_admin'),
                                                    'class' => 'copy-public-settings',
                                                    'data' => [
                                                        'copy-from' => 'pub_checkbox_'.$i,
                                                    ],
                                                ];
                                            }

                                            if (CURRENT_USER_LEVEL != 0) {
                                                // Selected clients
                                                $copy_buttons['clients'] = [
                                                    'label' => __('Selected clients','cftp_admin'),
                                                    'class' => 'copy-all',
                                                    'data' => [
                                                        'type' => 'clients',
                                                        'target' => 'clients_'.$file->id,
                                                    ],
                                                ];

                                                // Selected groups
                                                $copy_buttons['groups'] = [
                                                    'label' => __('Selected groups','cftp_admin'),
                                                    'class' => 'copy-all',
                                                    'data' => [
                                                        'type' => 'groups',
                                                        'target' => 'groups_'.$file->id,
                                                    ],
                                                ];

                                                // Hidden status
                                                $copy_buttons['hidden'] = [
                                                    'label' => __('Hidden status','cftp_admin'),
                                                    'class' => 'copy-hidden-settings',
                                                    'data' => [
                                                        'copy-from' => 'hid_checkbox_'.$i,
                                                    ],
                                                ];

                                                // Categories
                                                $copy_buttons['categories'] = [
                                                    'label' => __('Selected categories','cftp_admin'),
                                                    'class' => 'copy-all',
                                                    'data' => [
                                                        'type' => 'categories',
                                                        'target' => 'categories_'.$file->id,
                                                    ],
                                                ];

                                                // Folders
                                                $copy_buttons['folder'] = [
                                                    'label' => __('Selected folder','cftp_admin'),
                                                    'class' => 'copy-all',
                                                    'data' => [
                                                        'type' => 'folder',
                                                        'target' => 'folder_'.$file->id,
                                                    ],
                                                ];
                                            }

                                            if (count($copy_buttons) > 0) {
                                    ?>
                                                <footer>
                                                    <div class="row">
                                                        <div class="col">
                                                            <h3><?php _e('Apply to all files','cftp_admin'); ?></h3>
                                                            <?php foreach ($copy_buttons as $id => $button) { ?>
                                                                <button type="button" class="btn btn-sm btn-pslight mb-2 <?php echo $button['class']; ?>"
                                                                    <?php
                                                                        foreach ($button['data'] as $key => $value) {
                                                                            echo ' data-'.$key.'="'.$value.'"';
                                                                        }
                                                                    ?>
                                                                >
                                                                    <?php echo $button['label']; ?>
                                                                </button>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </footer>
                                    <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
            <?php
                        $i++;
                    } else {
                        $msg = sprintf(__('File not found on disk: %s'), $file->filename_on_disk);
                        echo system_message('danger', $msg);
                    }
                }
            }
        ?>
    </div> <!-- container -->

    <div class="after_form_buttons">
        <button type="submit" name="save" class="btn btn-wide btn-primary" id="upload-continue"><?php _e('Save','cftp_admin'); ?></button>
    </div>
</form>