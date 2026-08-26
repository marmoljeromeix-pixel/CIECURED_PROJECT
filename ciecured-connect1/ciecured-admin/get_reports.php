<?php
// Admin → shared store.
// Returns every report. Called every few seconds by index.php so new
// student submissions show up without a manual page reload.

header('Content-Type: application/json');
require __DIR__ . '/../ciecured-data/reports_lib.php';

$reports = load_reports();
echo json_encode(hydrate_all($reports));
