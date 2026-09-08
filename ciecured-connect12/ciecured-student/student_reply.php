<?php
// Student → shared store.
// Called by script.js when a student sends a follow-up message from
// their Inbox, so staff see it on the admin dashboard too.

header('Content-Type: application/json');
require __DIR__ . '/../ciecured-data/reports_lib.php';

$tup_id = '';
if (isset($_POST['tup_id'])) {
    $tup_id = strtoupper(trim($_POST['tup_id']));
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

if ($tup_id == '' || !isset($reports[$tup_id])) {
    http_response_code(404);
    echo json_encode(array('error' => "We couldn't find a report with that TUP ID."));
    exit;
}

$stored_hash = '';
if (isset($reports[$tup_id]['password_hash'])) {
    $stored_hash = $reports[$tup_id]['password_hash'];
}

if ($password == '' || $stored_hash == '' || !password_matches($password, $stored_hash)) {
    http_response_code(403);
    echo json_encode(array('error' => 'That TUP ID and password do not match.'));
    exit;
}

if ($text == '') {
    http_response_code(400);
    echo json_encode(array('error' => 'Message cannot be empty.'));
    exit;
}

$reports[$tup_id]['messages'][] = array('from' => 'student', 'text' => $text, 'ts' => time());

if ($reports[$tup_id]['status'] == 'resolved') {
    $reports[$tup_id]['status'] = 'review';
}

save_reports($reports);

echo json_encode(hydrate_case($reports[$tup_id]));
