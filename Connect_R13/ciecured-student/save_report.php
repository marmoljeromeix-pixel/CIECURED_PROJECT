<?php
// Student → shared store.
// Called by script.js once the student confirms their report in the
// popup. The identifier here is the student's own TUP ID, typed in
// on the report form — not a randomly generated code. This is what
// makes the report show up on the admin dashboard.

header('Content-Type: application/json');
require __DIR__ . '/ciecured-data/reports_lib.php';

$tup_id = '';
if (isset($_POST['tup_id'])) {
    $tup_id = strtoupper(trim($_POST['tup_id']));
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

$location = '';
if (isset($_POST['location'])) {
    $location = trim($_POST['location']);
}

$display_name = '';
if (isset($_POST['display_name'])) {
    $display_name = trim($_POST['display_name']);
}

if ($tup_id == '' || $category == '' || $password == '') {
    http_response_code(400);
    echo json_encode(array('error' => 'Missing TUP ID, category, or password.'));
    exit;
}

// The TUP ID must look like TUPM-12-3456 — two digits for the year
// enrolled, then the student's ID number.
if (!preg_match('/^TUPM-\d{2}-\d{3,6}$/', $tup_id)) {
    http_response_code(400);
    echo json_encode(array('error' => 'That TUP ID format looks incorrect. It should look like TUPM-12-3456.'));
    exit;
}

$reports = load_reports();

// A TUP ID can only be used to submit one report. If it's already
// been used, the student needs to open their existing case from the
// Inbox instead of submitting a new one.
if (isset($reports[$tup_id])) {
    http_response_code(409);
    echo json_encode(array('error' => 'This TUP ID has already been used to submit a report. Open it from the Inbox instead.'));
    exit;
}

// There's no student-entered "when did this happen" field anymore —
// submitted_at (set below, as a server timestamp) is what the site
// uses everywhere to show when a report came in.
$reports[$tup_id] = array(
    'category' => $category,
    'status' => 'received',
    'submitted_at' => time(),
    'password_hash' => hash_password($password),
    'location' => $location,
    'display_name' => $display_name,
    'messages' => array(
        array('from' => 'student', 'text' => $message, 'ts' => time()),
    ),
);

save_reports($reports);

echo json_encode(array('tup_id' => $tup_id));
