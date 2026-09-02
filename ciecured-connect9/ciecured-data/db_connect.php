<?php
/**
 * CIEcured — database connection.
 *
 * This is the only file where the database name, username, and
 * password live. If your XAMPP MySQL setup uses different login
 * details, change them here.
 */

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'ciecured_db';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}
