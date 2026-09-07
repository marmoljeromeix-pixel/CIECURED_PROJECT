-- =====================================================
-- CIEcured — database schema
-- =====================================================
--
-- This file is for reference / GitHub only. The actual app does NOT
-- read this file — ciecured-data/reports_lib.php creates this exact
-- database and these exact tables automatically the first time the
-- site runs (CREATE DATABASE IF NOT EXISTS / CREATE TABLE IF NOT
-- EXISTS), so nothing here needs to be run by hand for the app to
-- work on a computer that already has it set up.
--
-- This file is useful for:
--   - Showing the schema on GitHub without having to read PHP code.
--   - Setting up the database manually (e.g. phpMyAdmin's Import tab)
--     on a fresh computer, before ever opening the site.
--
-- Requires MySQL / MariaDB (this project was built against XAMPP's
-- bundled MySQL).

CREATE DATABASE IF NOT EXISTS `ciecured` CHARACTER SET utf8mb4;
USE `ciecured`;

-- One row per report. The primary key is the student's TUP ID itself
-- (e.g. "TUPM-12-3456") — a TUP ID can only ever submit one report,
-- so it works as both the report's ID and a natural key.
CREATE TABLE IF NOT EXISTS `reports` (
    `id` VARCHAR(32) PRIMARY KEY,
    `category` VARCHAR(120) NOT NULL,
    `status` VARCHAR(20) NOT NULL DEFAULT 'received',
    `submitted_at` DATETIME NOT NULL,
    `password_hash` VARCHAR(255) NOT NULL,
    `location` VARCHAR(255) NOT NULL DEFAULT '',
    `name` VARCHAR(255) NOT NULL DEFAULT '',
    `resolution_note` TEXT NULL,
    `urgent` TINYINT(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB;

-- One row per chat message in a report's thread (both the student's
-- original message and every back-and-forth reply after it).
CREATE TABLE IF NOT EXISTS `messages` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `report_id` VARCHAR(32) NOT NULL,
    `sender` VARCHAR(10) NOT NULL,
    `text` TEXT NOT NULL,
    `ts` DATETIME NOT NULL,
    FOREIGN KEY (`report_id`) REFERENCES `reports`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;
