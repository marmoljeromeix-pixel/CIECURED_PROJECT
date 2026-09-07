<?php
// Student → shared store.
// Called by script.js when a student sends a follow-up message from
// their Inbox, so staff see it on the admin dashboard too.

header('Content-Type: application/json');
require __DIR__ . '/../ciecured-data/reports_lib.php';

$code = '';
if (isset($_POST['code'])) {
    $code = strtoupper(trim($_POST['code']));
}

$text = '';
if (isset($_POST['text'])) {
    $text = trim($_POST['text']);
}

$password = '';
if (isset($_POST['password'])) {
    $password = trim($_POST['password']);
}

$reports = load_reports();

if ($code == '' || !isset($reports[$code])) {
    http_response_code(404);
    echo json_encode(array('error' => "We couldn't find a report with that tracking code."));
    exit;
}

$stored_hash = '';
if (isset($reports[$code]['password_hash'])) {
    $stored_hash = $reports[$code]['password_hash'];
}

if ($password == '' || $stored_hash == '' || !password_matches($password, $stored_hash)) {
    http_response_code(403);
    echo json_encode(array('error' => 'That tracking code and password do not match.'));
    exit;
}

if ($text == '') {
    http_response_code(400);
    echo json_encode(array('error' => 'Message cannot be empty.'));
    exit;
}

$reports[$code]['messages'][] = array('from' => 'student', 'text' => $text, 'ts' => time());

if ($reports[$code]['status'] == 'resolved') {
    $reports[$code]['status'] = 'review';
}

save_reports($reports);

echo json_encode(hydrate_case($reports[$code]));
