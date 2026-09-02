<?php
// Student → database.
// Lets a student add a follow-up message to their own thread from
// the tracking/inbox page. If the case was already resolved, a new
// student message reopens it for review so staff see it again.

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

$report = get_report_by_code($code);

if ($code == '' || $report === null) {
    http_response_code(404);
    echo json_encode(array('error' => "We couldn't find a report with that tracking code."));
    exit;
}

if ($password == '' || !password_matches($password, $report['password_hash'])) {
    http_response_code(403);
    echo json_encode(array('error' => 'That tracking code and password do not match.'));
    exit;
}

if ($text == '') {
    http_response_code(400);
    echo json_encode(array('error' => 'Message cannot be empty.'));
    exit;
}

add_message($code, 'student', $text);

if ($report['status'] == 'resolved') {
    update_status($code, 'review');
}

// Get the report again so the reply we just sent is included.
$updated_report = get_report_by_code($code);
unset($updated_report['password_hash']);

echo json_encode($updated_report);
