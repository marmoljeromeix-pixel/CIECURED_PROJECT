<?php
// Student → database.
// Called by script.js to open a case in the Inbox, or to check for
// staff replies. Uses POST (not a URL) so the password isn't sitting
// in the address bar or browser history.
//
// Both the tracking code AND the password must match, otherwise we
// don't send back anything about the report.

header('Content-Type: application/json');
require __DIR__ . '/../ciecured-data/reports_lib.php';

$code = '';
if (isset($_POST['code'])) {
    $code = strtoupper(trim($_POST['code']));
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

// Never send the password hash back to the browser.
unset($report['password_hash']);

echo json_encode($report);
