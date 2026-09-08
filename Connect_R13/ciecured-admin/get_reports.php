<?php
// Admin → shared store.
// Returns every report. Called every few seconds by index.php so new
// student submissions show up without a manual page reload.
// Only logged-in staff can call this.

require __DIR__ . '/auth.php';
require_admin_login_json();

header('Content-Type: application/json');
require __DIR__ . '/../ciecured-data/reports_lib.php';

$reports = load_reports();
echo json_encode(hydrate_all($reports));
