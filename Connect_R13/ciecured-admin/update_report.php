<?php
// Admin → shared store.
// Called when staff change a status or send a reply. Saves the
// change to the same file the student site reads from.
// Only logged-in staff can call this.

require __DIR__ . '/auth.php';
require_admin_login_json();

header('Content-Type: application/json');
require __DIR__ . '/../ciecured-data/reports_lib.php';

$tup_id = '';
if (isset($_POST['tup_id'])) {
    $tup_id = strtoupper(trim($_POST['tup_id']));
}

$reports = load_reports();

if ($tup_id == '' || !isset($reports[$tup_id])) {
    http_response_code(404);
    echo json_encode(array('error' => 'No report found for that TUP ID.'));
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

    $reports[$tup_id]['status'] = $new_status;

    if ($new_status == 'resolved') {
        $reports[$tup_id]['resolution_note'] = $resolution_note;
    }
}

if (isset($_POST['reply']) && trim($_POST['reply']) != '') {
    $reply_text = trim($_POST['reply']);
    $reports[$tup_id]['messages'][] = array('from' => 'staff', 'text' => $reply_text, 'ts' => time());

    if ($reports[$tup_id]['status'] == 'received') {
        $reports[$tup_id]['status'] = 'replied';
    }
}

if (isset($_POST['urgent'])) {
    $reports[$tup_id]['urgent'] = ($_POST['urgent'] == '1');
}

save_reports($reports);

echo json_encode(hydrate_case($reports[$tup_id]));
