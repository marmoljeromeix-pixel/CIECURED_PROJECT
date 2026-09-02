<?php
// Admin → database.
// Returns every report. Called every few seconds by index.php so new
// student submissions show up without a manual page reload.

header('Content-Type: application/json');
require __DIR__ . '/../ciecured-data/reports_lib.php';

echo json_encode(get_all_reports());
