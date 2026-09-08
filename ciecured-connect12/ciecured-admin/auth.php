<?php
/**
 * CIEcured — admin login check.
 *
 * Every admin page and every admin AJAX endpoint requires this file
 * first, before doing anything else. It starts the login session and
 * gives two small functions to guard access:
 *
 *   - require_admin_login_page()  → for a full page (index.php).
 *     Sends the browser to login.php if not logged in yet.
 *
 *   - require_admin_login_json()  → for an AJAX endpoint
 *     (get_reports.php, update_report.php). Replies with a JSON
 *     error instead of a redirect, since those are called by
 *     JavaScript, not by loading a page.
 *
 * The username and password are fixed on purpose — there's only one
 * shared admin account for now, not individual staff logins.
 */

session_start();

define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'TUPMANILA');

function is_admin_logged_in() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function require_admin_login_page() {
    if (!is_admin_logged_in()) {
        header('Location: login.php');
        exit;
    }
}

function require_admin_login_json() {
    if (!is_admin_logged_in()) {
        http_response_code(401);
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Not logged in.'));
        exit;
    }
}
