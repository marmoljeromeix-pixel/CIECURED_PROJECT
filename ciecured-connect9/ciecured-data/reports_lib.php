<?php
/**
 * CIEcured — shared reports data layer (SQL version).
 *
 * This file is the connection point between the student site
 * (ciecured-student/) and the admin dashboard (ciecured-admin/).
 * Both sides call the functions below instead of touching the
 * database directly. That's how a report submitted by a student
 * shows up in the admin inbox, and a staff reply shows up in the
 * student's tracking inbox.
 *
 * Each function below does ONE thing and runs ONE small query —
 * sending a reply only adds one row, it does not rewrite the whole
 * database. This is the main advantage over the old JSON file
 * version, where every single change had to rewrite everything.
 */

require __DIR__ . '/db_connect.php';

// Make a new tracking code, e.g. "CIE-4F2A-09". This works like a
// username — it's the unique thing a student uses to log back in,
// paired with their password.
function gen_report_code() {
    $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $part1 = '';
    for ($i = 0; $i < 4; $i++) {
        $part1 .= $letters[random_int(0, strlen($letters) - 1)];
    }
    $part2 = str_pad((string) random_int(0, 99), 2, '0', STR_PAD_LEFT);

    return 'CIE-' . $part1 . '-' . $part2;
}

// Turn a timestamp into a simple readable string, like "3 days ago".
function time_ago($timestamp) {
    $seconds = time() - $timestamp;

    if ($seconds < 60) {
        return 'Just now';
    }

    $minutes = floor($seconds / 60);
    if ($minutes < 60) {
        if ($minutes == 1) {
            return '1 minute ago';
        }
        return $minutes . ' minutes ago';
    }

    $hours = floor($minutes / 60);
    if ($hours < 24) {
        if ($hours == 1) {
            return '1 hour ago';
        }
        return $hours . ' hours ago';
    }

    $days = floor($hours / 24);
    if ($days < 7) {
        if ($days == 1) {
            return '1 day ago';
        }
        return $days . ' days ago';
    }

    $weeks = floor($days / 7);
    if ($weeks == 1) {
        return '1 week ago';
    }
    return $weeks . ' weeks ago';
}

// Turn a plain-text password into a hash that's safe to store.
function hash_password($plain_password) {
    return password_hash($plain_password, PASSWORD_DEFAULT);
}

// Check if a plain-text password matches a stored hash.
function password_matches($plain_password, $stored_hash) {
    return password_verify($plain_password, $stored_hash);
}

// Get every message for one report, in the order they were sent.
// Used by both get_report_by_code() and get_all_reports().
function get_messages_for_report($report_id) {
    global $conn;

    $messages = array();

    $stmt = mysqli_prepare($conn, "SELECT sender, message, sent_at FROM messages WHERE report_id = ? ORDER BY sent_at ASC, id ASC");
    mysqli_stmt_bind_param($stmt, "i", $report_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        $messages[] = array(
            'from' => $row['sender'],
            'text' => $row['message'],
            'time' => time_ago(strtotime($row['sent_at'])),
        );
    }

    return $messages;
}

// Create a new report and its first message. Returns the tracking
// code on success, or false if something went wrong.
function create_report($code, $category, $message, $password_hash) {
    global $conn;

    // The code comes from gen_report_code(), which is random, so a
    // collision is extremely unlikely — but just in case, treat it
    // the same way the old version did: add the message to the
    // existing report instead of losing it.
    $existing = get_report_by_code($code);
    if ($existing !== null) {
        add_message($code, 'student', $message);
        return $code;
    }

    $stmt = mysqli_prepare($conn, "INSERT INTO reports (code, password_hash, category, status, urgent, submitted_at) VALUES (?, ?, ?, 'received', 0, NOW())");
    mysqli_stmt_bind_param($stmt, "sss", $code, $password_hash, $category);
    $ok = mysqli_stmt_execute($stmt);

    if (!$ok) {
        return false;
    }

    $report_id = mysqli_insert_id($conn);

    $stmt2 = mysqli_prepare($conn, "INSERT INTO messages (report_id, sender, message, sent_at) VALUES (?, 'student', ?, NOW())");
    mysqli_stmt_bind_param($stmt2, "is", $report_id, $message);
    mysqli_stmt_execute($stmt2);

    return $code;
}

// Look up one report by its tracking code. Returns an array with
// the report's details AND its password_hash (the calling file is
// responsible for removing the hash before sending anything back to
// the browser). Returns null if the code doesn't exist.
function get_report_by_code($code) {
    global $conn;

    $stmt = mysqli_prepare($conn, "SELECT * FROM reports WHERE code = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "s", $code);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        return null;
    }

    return array(
        'code' => $row['code'],
        'password_hash' => $row['password_hash'],
        'category' => $row['category'],
        'status' => $row['status'],
        'urgent' => ($row['urgent'] == 1),
        'resolution_note' => $row['resolution_note'],
        'submitted' => time_ago(strtotime($row['submitted_at'])),
        'messages' => get_messages_for_report($row['id']),
    );
}

// Get every report, keyed by tracking code, for the admin dashboard.
// The password hash is left out here — the admin side never needs
// to check a student's password.
function get_all_reports() {
    global $conn;

    $reports = array();

    $result = mysqli_query($conn, "SELECT * FROM reports ORDER BY submitted_at DESC");

    while ($row = mysqli_fetch_assoc($result)) {
        $reports[$row['code']] = array(
            'code' => $row['code'],
            'category' => $row['category'],
            'status' => $row['status'],
            'urgent' => ($row['urgent'] == 1),
            'resolution_note' => $row['resolution_note'],
            'submitted_at' => strtotime($row['submitted_at']),
            'submitted' => time_ago(strtotime($row['submitted_at'])),
            'messages' => get_messages_for_report($row['id']),
        );
    }

    return $reports;
}

// Add one message to one report. $sender is either 'student' or
// 'staff'. Returns true on success, false if the code doesn't exist.
function add_message($code, $sender, $text) {
    global $conn;

    $stmt = mysqli_prepare($conn, "SELECT id FROM reports WHERE code = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "s", $code);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        return false;
    }

    $report_id = $row['id'];

    $stmt2 = mysqli_prepare($conn, "INSERT INTO messages (report_id, sender, message, sent_at) VALUES (?, ?, ?, NOW())");
    mysqli_stmt_bind_param($stmt2, "iss", $report_id, $sender, $text);
    mysqli_stmt_execute($stmt2);

    return true;
}

// Change a report's status, and optionally save a resolution note
// at the same time (used when marking a case resolved).
function update_status($code, $status, $resolution_note = null) {
    global $conn;

    if ($resolution_note !== null) {
        $stmt = mysqli_prepare($conn, "UPDATE reports SET status = ?, resolution_note = ? WHERE code = ?");
        mysqli_stmt_bind_param($stmt, "sss", $status, $resolution_note, $code);
    } else {
        $stmt = mysqli_prepare($conn, "UPDATE reports SET status = ? WHERE code = ?");
        mysqli_stmt_bind_param($stmt, "ss", $status, $code);
    }

    return mysqli_stmt_execute($stmt);
}

// Turn the urgent flag on or off for one report.
function set_urgent($code, $is_urgent) {
    global $conn;

    $urgent_value = $is_urgent ? 1 : 0;

    $stmt = mysqli_prepare($conn, "UPDATE reports SET urgent = ? WHERE code = ?");
    mysqli_stmt_bind_param($stmt, "is", $urgent_value, $code);

    return mysqli_stmt_execute($stmt);
}
