<?php
// Student → shared store.
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

$reports = load_reports();

if (isset($reports[$code])) {
    // Same code already exists (very unlikely, but just in case) —
    // add this as a new message instead of losing the old case.
    $reports[$code]['messages'][] = array('from' => 'student', 'text' => $message, 'ts' => time());
} else {
    $reports[$code] = array(
        'category' => $category,
        'status' => 'received',
        'submitted_at' => time(),
        'password_hash' => hash_password($password),
        'messages' => array(
            array('from' => 'student', 'text' => $message, 'ts' => time()),
        ),
    );
}

save_reports($reports);

echo json_encode(array('code' => $code));
