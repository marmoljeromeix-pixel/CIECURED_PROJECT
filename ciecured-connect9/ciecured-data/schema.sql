
CREATE DATABASE IF NOT EXISTS ciecured_db;
USE ciecured_db;

-- One row per report. yung code nila it serves as their username —
-- it's the unique thing a student uses, paired with a password na ginawa nila, to
-- get back into their report later.
CREATE TABLE IF NOT EXISTS reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(20) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'received',
    urgent TINYINT(1) NOT NULL DEFAULT 0,
    resolution_note TEXT NULL,
    submitted_at DATETIME NOT NULL
);

-- One row per message. Many messages belong to one report.
CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    report_id INT NOT NULL,
    sender VARCHAR(10) NOT NULL,
    message TEXT NOT NULL,
    sent_at DATETIME NOT NULL,
    FOREIGN KEY (report_id) REFERENCES reports(id)
);
