<?php
/**
 * CIEcured — shared reports data layer.
 *
 * This file is the connection point between the student site
 * (ciecured/) and the admin dashboard (ciecured-admin/). Both sides
 * read and write the same reports.json file through the functions
 * below. That's how a report submitted by a student shows up in the
 * admin inbox, and a staff reply shows up in the student's tracking
 * inbox.
 *
 * This is a stand-in for the real database. Later, when MySQL is
 * added, only load_reports() and save_reports() need to change.
 */

define('REPORTS_FILE', __DIR__ . '/reports.json');

// Read all reports from the JSON file. Returns an array where each
// key is a tracking code, like "CIE-7X4K-92".
function load_reports() {
    if (!file_exists(REPORTS_FILE)) {
        return array();
    }

    $raw = file_get_contents(REPORTS_FILE);
    $data = json_decode($raw, true);

    if (!is_array($data)) {
        return array();
    }

    return $data;
}

// Save all reports back to the JSON file.
function save_reports($reports) {
    $json = json_encode($reports, JSON_PRETTY_PRINT);
    file_put_contents(REPORTS_FILE, $json, LOCK_EX);
}

// Make a new tracking code, e.g. "CIE-4F2A-09".
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
// PHP's built-in function does the hard part for us.
function hash_password($plain_password) {
    return password_hash($plain_password, PASSWORD_DEFAULT);
}

// Check if a plain-text password matches a stored hash.
function password_matches($plain_password, $stored_hash) {
    return password_verify($plain_password, $stored_hash);
}

// Take one stored report and turn its raw timestamps into readable
// text ("submitted": "3 days ago"), without changing what's saved.
function hydrate_case($case) {
    $result = $case;

    // Never send the password hash back to the browser.
    unset($result['password_hash']);

    if (isset($case['submitted_at'])) {
        $result['submitted'] = time_ago($case['submitted_at']);
    } else {
        $result['submitted'] = 'Just now';
    }

    $messages = array();
    if (isset($case['messages'])) {
        foreach ($case['messages'] as $message) {
            $time_text = 'Just now';
            if (isset($message['ts'])) {
                $time_text = time_ago($message['ts']);
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
    foreach ($reports as $code => $case) {
        $result[$code] = hydrate_case($case);
    }
    return $result;
}
