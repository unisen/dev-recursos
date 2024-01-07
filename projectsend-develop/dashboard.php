<?php
/**
 * Home page for logged in system users.
 */
$allowed_levels = array(9, 8, 7);
require_once 'bootstrap.php';
$page_title = __('Dashboard', 'cftp_admin');

$active_nav = 'dashboard';

$body_class = array('dashboard', 'home', 'hide_title');
$page_id = 'dashboard';

include_once ADMIN_VIEWS_DIR . DS . 'header.php';

define('CAN_INCLUDE_FILES', true);

if (current_role_in([9])) {
    include_once WIDGETS_FOLDER . 'counters.php';
}
?>
<div class="row">
    <div class="col-sm-8">
        <div class="row">
            <div class="col-sm-12">
                <?php include_once WIDGETS_FOLDER . 'statistics.php'; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <?php include_once WIDGETS_FOLDER . 'news.php'; ?>
            </div>
            <?php
            if (current_role_in([9])) {
            ?>
                <div class="col-sm-6">
                    <?php include_once WIDGETS_FOLDER . 'system-information.php'; ?>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <?php
    if (current_role_in([9])) {
    ?>
        <div class="col-sm-4 container_widget_actions_log">
            <?php include_once WIDGETS_FOLDER . 'actions-log.php'; ?>
        </div>
    <?php
    }
    ?>
</div>
<?php
include_once ADMIN_VIEWS_DIR . DS . 'footer.php';
