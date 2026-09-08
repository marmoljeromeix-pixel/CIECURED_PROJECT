<?php
/**
 * CIEcured — Admin logout.
 * Clears the login session and sends staff back to the login form.
 */

require __DIR__ . '/auth.php';

$_SESSION = array();
session_destroy();

header('Location: login.php');
exit;
