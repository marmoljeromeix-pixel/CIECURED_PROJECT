<?php
// Student → shared store.
// Called by script.js to check for staff replies on a case.

header('Content-Type: application/json');
require __DIR__ . '/../ciecured-data/reports_lib.php';

$code = '';
if (isset($_GET['code'])) {
    $code = strtoupper(trim($_GET['code']));
}

$reports = load_reports();

if ($code == '' || !isset($reports[$code])) {
    http_response_code(404);
    echo json_encode(array('error' => "We couldn't find a report with that tracking code."));
    exit;
}

echo json_encode(hydrate_case($reports[$code]));
