<?php
// Admin → shared store.
// Called when staff change a status or send a reply. Saves the
// change to the same file the student site reads from.

header('Content-Type: application/json');
require __DIR__ . '/../ciecured-data/reports_lib.php';

$code = '';
if (isset($_POST['code'])) {
    $code = strtoupper(trim($_POST['code']));
}

$reports = load_reports();

if ($code == '' || !isset($reports[$code])) {
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

    $reports[$code]['status'] = $new_status;

    if ($new_status == 'resolved') {
        $reports[$code]['resolution_note'] = $resolution_note;
    }
}

if (isset($_POST['reply']) && trim($_POST['reply']) != '') {
    $reply_text = trim($_POST['reply']);
    $reports[$code]['messages'][] = array('from' => 'staff', 'text' => $reply_text, 'ts' => time());

    if ($reports[$code]['status'] == 'received') {
        $reports[$code]['status'] = 'replied';
    }
}

if (isset($_POST['urgent'])) {
    $reports[$code]['urgent'] = ($_POST['urgent'] == '1');
}

save_reports($reports);

echo json_encode(hydrate_case($reports[$code]));
