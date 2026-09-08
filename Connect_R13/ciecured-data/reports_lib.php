<?php
/**
 * CIEcured — shared reports data layer.
 *
 * This file is the connection point between the student site
 * (ciecured-student/) and the admin dashboard (ciecured-admin/). Both
 * sides read and write the same MySQL database through the functions
 * below. That's how a report submitted by a student shows up in the
 * admin inbox, and a staff reply shows up in the student's tracking
 * inbox.
 *
 * Everything else in the project (save_report.php, get_report.php,
 * student_reply.php, update_report.php, the admin dashboard) only
 * ever calls load_reports() / save_reports() / hydrate_case() /
 * hydrate_all() — none of it needs to know the data now lives in
 * MySQL instead of reports.json.
 */

// ===== InfinityFree database settings =====
// Get these exact values from your InfinityFree control panel under
// "MySQL Databases" — they will NOT be 127.0.0.1 / root / blank like
// a local XAMPP setup. Typical InfinityFree values look like:
//   DB_HOST -> sqlXXX.infinityfree.com (something like this, they give you the exact host)
//   DB_NAME -> if0_XXXXXXXX_ciecured
//   DB_USER -> if0_XXXXXXXX
//   DB_PASS -> the password you set when creating the database
define('DB_HOST', 'localhost');
define('DB_NAME', 'bmvakbzc_ciecured');
define('DB_USER', 'bmvakbzc_ciecured');
define('DB_PASS', 'XCfzAc94KgxLJT7AVdGY');

// Opens (or reuses) the database connection. Note: unlike local
// XAMPP, InfinityFree accounts do not have permission to CREATE a
// database from PHP — you must create the database yourself in the
// control panel first, and import schema.sql via phpMyAdmin. This
// function only connects to that already-created database and adds
// its tables if they're missing.
function get_db() {
    static $pdo = null;

    if ($pdo !== null) {
        return $pdo;
    }

    try {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS, array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ));

        $pdo->exec('
            CREATE TABLE IF NOT EXISTS reports (
                id VARCHAR(32) PRIMARY KEY,
                category VARCHAR(120) NOT NULL,
                status VARCHAR(20) NOT NULL DEFAULT "received",
                submitted_at DATETIME NOT NULL,
                password_hash VARCHAR(255) NOT NULL,
                location VARCHAR(255) NOT NULL DEFAULT "",
                name VARCHAR(255) NOT NULL DEFAULT "",
                resolution_note TEXT NULL,
                urgent TINYINT(1) NOT NULL DEFAULT 0
            )
        ');

        $pdo->exec('
            CREATE TABLE IF NOT EXISTS messages (
                id INT AUTO_INCREMENT PRIMARY KEY,
                report_id VARCHAR(32) NOT NULL,
                sender VARCHAR(10) NOT NULL,
                text TEXT NOT NULL,
                ts DATETIME NOT NULL,
                FOREIGN KEY (report_id) REFERENCES reports(id) ON DELETE CASCADE
            )
        ');

        migrate_old_column_names($pdo);
        migrate_timestamp_columns($pdo);
    } catch (PDOException $e) {
        http_response_code(500);
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Could not connect to the database. Make sure MySQL is running in the XAMPP control panel. (' . $e->getMessage() . ')'));
        exit;
    }

    return $pdo;
}

// Earlier versions of this app named these columns "tup_id" (on both
// tables) and "display_name". If a database from that earlier version
// is still around, rename those columns in place so nothing already
// submitted gets lost — this only runs once; after the rename, these
// checks find nothing to do and skip straight through.
function migrate_old_column_names($pdo) {
    $reports_columns = $pdo->query('SHOW COLUMNS FROM reports')->fetchAll(PDO::FETCH_COLUMN);
    $messages_columns = $pdo->query('SHOW COLUMNS FROM messages')->fetchAll(PDO::FETCH_COLUMN);

    $needs_migration = in_array('tup_id', $reports_columns) || in_array('display_name', $reports_columns) || in_array('tup_id', $messages_columns);
    if (!$needs_migration) {
        return;
    }

    $pdo->exec('SET FOREIGN_KEY_CHECKS=0');

    if (in_array('tup_id', $reports_columns)) {
        $pdo->exec('ALTER TABLE reports CHANGE COLUMN tup_id id VARCHAR(32) NOT NULL');
    }
    if (in_array('display_name', $reports_columns)) {
        $pdo->exec('ALTER TABLE reports CHANGE COLUMN display_name name VARCHAR(255) NOT NULL DEFAULT ""');
    }
    if (in_array('tup_id', $messages_columns)) {
        $pdo->exec('ALTER TABLE messages CHANGE COLUMN tup_id report_id VARCHAR(32) NOT NULL');
    }

    $pdo->exec('SET FOREIGN_KEY_CHECKS=1');
}

// Earlier versions of this app stored "submitted_at" and "ts" as plain
// numbers (seconds since 1970 — a Unix timestamp), which is why
// phpMyAdmin showed a value like 1788794073 instead of a real date. If
// a database from that earlier version is still around, convert those
// columns to a real DATETIME column, so phpMyAdmin (and anything else
// looking at the database directly) shows an exact, readable date and
// time instead. This only runs once — after the conversion, these
// checks find nothing to do and skip straight through.
function migrate_timestamp_columns($pdo) {
    $reports_type = $pdo->query("
        SELECT DATA_TYPE FROM information_schema.COLUMNS
        WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'reports' AND COLUMN_NAME = 'submitted_at'
    ")->fetchColumn();

    if ($reports_type !== false && strtolower($reports_type) !== 'datetime') {
        $pdo->exec('ALTER TABLE reports ADD COLUMN submitted_at_new DATETIME NULL');
        $pdo->exec('UPDATE reports SET submitted_at_new = FROM_UNIXTIME(submitted_at)');
        $pdo->exec('ALTER TABLE reports DROP COLUMN submitted_at');
        $pdo->exec('ALTER TABLE reports CHANGE COLUMN submitted_at_new submitted_at DATETIME NOT NULL');
    }

    $messages_type = $pdo->query("
        SELECT DATA_TYPE FROM information_schema.COLUMNS
        WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'messages' AND COLUMN_NAME = 'ts'
    ")->fetchColumn();

    if ($messages_type !== false && strtolower($messages_type) !== 'datetime') {
        $pdo->exec('ALTER TABLE messages ADD COLUMN ts_new DATETIME NULL');
        $pdo->exec('UPDATE messages SET ts_new = FROM_UNIXTIME(ts)');
        $pdo->exec('ALTER TABLE messages DROP COLUMN ts');
        $pdo->exec('ALTER TABLE messages CHANGE COLUMN ts_new ts DATETIME NOT NULL');
    }
}

// Read all reports from the database. Returns an array where each
// key is the student's TUP ID, like "TUPM-12-3456" — same shape the
// old reports.json file used to return.
function load_reports() {
    $pdo = get_db();
    $reports = array();

    $report_rows = $pdo->query('SELECT * FROM reports')->fetchAll(PDO::FETCH_ASSOC);

    foreach ($report_rows as $row) {
        $tup_id = $row['id'];

        $reports[$tup_id] = array(
            'category' => $row['category'],
            'status' => $row['status'],
            'submitted_at' => strtotime($row['submitted_at']),
            'password_hash' => $row['password_hash'],
            'location' => $row['location'],
            'display_name' => $row['name'],
            'urgent' => ((int) $row['urgent']) === 1,
            'messages' => array(),
        );

        if ($row['resolution_note'] !== null) {
            $reports[$tup_id]['resolution_note'] = $row['resolution_note'];
        }
    }

    $message_stmt = $pdo->prepare('SELECT sender, text, ts FROM messages WHERE report_id = ? ORDER BY ts ASC, id ASC');

    foreach ($reports as $tup_id => $case) {
        $message_stmt->execute(array($tup_id));
        $message_rows = $message_stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($message_rows as $message_row) {
            $reports[$tup_id]['messages'][] = array(
                'from' => $message_row['sender'],
                'text' => $message_row['text'],
                'ts' => strtotime($message_row['ts']),
            );
        }
    }

    return $reports;
}

// Save all reports back to the database. Every caller in the project
// loads the whole array, changes one report, and passes the whole
// thing back here — so, to keep this simple, we just clear both
// tables and re-insert everything fresh each time. The number of
// reports here is small, so this is fast enough and a lot easier to
// follow than trying to patch individual rows.
function save_reports($reports) {
    $pdo = get_db();

    $pdo->beginTransaction();

    $pdo->exec('DELETE FROM messages');
    $pdo->exec('DELETE FROM reports');

    $insert_report = $pdo->prepare('
        INSERT INTO reports (id, category, status, submitted_at, password_hash, location, name, resolution_note, urgent)
        VALUES (:id, :category, :status, :submitted_at, :password_hash, :location, :name, :resolution_note, :urgent)
    ');

    $insert_message = $pdo->prepare('
        INSERT INTO messages (report_id, sender, text, ts)
        VALUES (:report_id, :sender, :text, :ts)
    ');

    foreach ($reports as $tup_id => $case) {
        $resolution_note = null;
        if (isset($case['resolution_note'])) {
            $resolution_note = $case['resolution_note'];
        }

        $urgent = 0;
        if (isset($case['urgent']) && $case['urgent']) {
            $urgent = 1;
        }

        $insert_report->execute(array(
            'id' => $tup_id,
            'category' => $case['category'],
            'status' => $case['status'],
            'submitted_at' => date('Y-m-d H:i:s', $case['submitted_at']),
            'password_hash' => $case['password_hash'],
            'location' => isset($case['location']) ? $case['location'] : '',
            'name' => isset($case['display_name']) ? $case['display_name'] : '',
            'resolution_note' => $resolution_note,
            'urgent' => $urgent,
        ));

        if (isset($case['messages'])) {
            foreach ($case['messages'] as $message) {
                $insert_message->execute(array(
                    'report_id' => $tup_id,
                    'sender' => $message['from'],
                    'text' => $message['text'],
                    'ts' => date('Y-m-d H:i:s', $message['ts']),
                ));
            }
        }
    }

    $pdo->commit();
}

// Turn a timestamp into an exact, readable date and time, like
// "Sep 7, 2026 at 2:30 PM" — so students and staff always see the real
// date and time something was submitted or sent, not a vague "3 days
// ago" that changes every time the page is reloaded.
function format_exact_datetime($timestamp) {
    return date('M j, Y \a\t g:i A', $timestamp);
}

// Turn a plain-text password into a hash that's safe to store.
// PHP's built-in function does the hard part for us.
function hash_password($plain_password) {
    return password_hash($plain_password, PASSWORD_DEFAULT);
}

// Check if a plain-text password matches a stored hash.
function password_matches($plain_password, $stored_hash) {
    return password_verify($plain_password, $stored_hash);
}

// Take one stored report and turn its raw timestamps into an exact,
// readable date and time ("submitted": "Sep 7, 2026 at 2:30 PM"),
// without changing what's saved.
function hydrate_case($case) {
    $result = $case;

    // Never send the password hash back to the browser.
    unset($result['password_hash']);

    if (isset($case['submitted_at'])) {
        $result['submitted'] = format_exact_datetime($case['submitted_at']);
    } else {
        $result['submitted'] = format_exact_datetime(time());
    }

    $messages = array();
    if (isset($case['messages'])) {
        foreach ($case['messages'] as $message) {
            $time_text = format_exact_datetime(time());
            if (isset($message['ts'])) {
                $time_text = format_exact_datetime($message['ts']);
            }

            $messages[] = array(
                'from' => $message['from'],
                'text' => $message['text'],
                'time' => $time_text,
            );
        }
    }
    $result['messages'] = $messages;

    return $result;
}

// Do the same thing as hydrate_case(), but for every report at once.
function hydrate_all($reports) {
    $result = array();
    foreach ($reports as $tup_id => $case) {
        $result[$tup_id] = hydrate_case($case);
    }
    return $result;
}
