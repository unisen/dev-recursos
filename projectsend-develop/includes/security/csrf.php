<?php

/**
 * Generate a new csrf protection token with a cryptographically secure random generator
 *
 * @return string
 */
function getCsrfToken()
{
    if(!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function addCsrf()
{
    echo '<input type="hidden" name="csrf_token" id="csrf_token" value="'.getCsrfToken().'" />';
}

/**
 * Validates the send csrf token with a stable string comparison algorithm.
 * Do not optimize for speed!!!
 *
 * @return bool
 */
function validateCsrfToken()
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_REQUEST['csrf_token']);
}

if (!defined('IS_INSTALL') && !defined('FILE_UPLOADING') && $_POST && !validateCsrfToken()) {
    exit_with_error_code(403);
}