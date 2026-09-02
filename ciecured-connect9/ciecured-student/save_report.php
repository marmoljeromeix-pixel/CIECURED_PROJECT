<?php
// Student → database.
// Called by script.js right after a report is created on the page,
// using the same tracking code the page already generated and
// showed to the student. This is what makes the report show up on
// the admin dashboard.

header('Content-Type: application/json');
require __DIR__ . '/../ciecured-data/reports_lib.php';

$code = '';
if (isset($_POST['code'])) {
    $code = strtoupper(trim($_POST['code']));
}

$category = '';
if (isset($_POST['category'])) {
    $category = trim($_POST['category']);
}

$message = '';
if (isset($_POST['message'])) {
    $message = trim($_POST['message']);
}

$password = '';
if (isset($_POST['password'])) {
    $password = trim($_POST['password']);
}

if ($code == '' || $category == '' || $password == '') {
    http_response_code(400);
    echo json_encode(array('error' => 'Missing tracking code, category, or password.'));
    exit;
}

$password_hash = hash_password($password);
$saved_code = create_report($code, $category, $message, $password_hash);

if ($saved_code === false) {
    http_response_code(500);
    echo json_encode(array('error' => 'Something went wrong saving your report.'));
    exit;
}

echo json_encode(array('code' => $saved_code));
