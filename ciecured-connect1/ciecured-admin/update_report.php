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

if (isset($_POST['status']) && $_POST['status'] != '') {
    $reports[$code]['status'] = $_POST['status'];
}

if (isset($_POST['reply']) && trim($_POST['reply']) != '') {
    $reply_text = trim($_POST['reply']);
    $reports[$code]['messages'][] = array('from' => 'staff', 'text' => $reply_text, 'ts' => time());

    if ($reports[$code]['status'] == 'received') {
        $reports[$code]['status'] = 'replied';
    }
}

save_reports($reports);

echo json_encode(hydrate_case($reports[$code]));
