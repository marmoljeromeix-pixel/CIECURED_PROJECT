<?php
// Admin → database.
// Called when staff change a status, send a reply, or toggle the
// urgent flag. Each of these only touches what actually changed —
// changing a status does not rewrite the messages, and so on.

header('Content-Type: application/json');
require __DIR__ . '/../ciecured-data/reports_lib.php';

$code = '';
if (isset($_POST['code'])) {
    $code = strtoupper(trim($_POST['code']));
}

$report = get_report_by_code($code);

if ($code == '' || $report === null) {
    http_response_code(404);
    echo json_encode(array('error' => 'No report found for that tracking code.'));
    exit;
}

$resolution_note = '';
if (isset($_POST['resolution_note'])) {
    $resolution_note = trim($_POST['resolution_note']);
}

if (isset($_POST['status']) && $_POST['status'] != '') {
    $new_status = $_POST['status'];

    if ($new_status == 'resolved' && $resolution_note == '') {
        http_response_code(400);
        echo json_encode(array('error' => 'A message for the student is required to mark this resolved.'));
        exit;
    }

    if ($new_status == 'resolved') {
        update_status($code, $new_status, $resolution_note);
    } else {
        update_status($code, $new_status);
    }
}

if (isset($_POST['reply']) && trim($_POST['reply']) != '') {
    $reply_text = trim($_POST['reply']);
    add_message($code, 'staff', $reply_text);

    if ($report['status'] == 'received') {
        update_status($code, 'replied');
    }
}

if (isset($_POST['urgent'])) {
    $is_urgent = ($_POST['urgent'] == '1');
    set_urgent($code, $is_urgent);
}

// Get the report again so everything we just changed is included.
$updated_report = get_report_by_code($code);
unset($updated_report['password_hash']);

echo json_encode($updated_report);
