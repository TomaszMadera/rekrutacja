-- Jeżeli korzystasz że środowiska dockerów to omijasz bo baza jest już założona wraz z użytkownikami
-- CREATE DATABASE `db`; 
-- USE `db`;
-- CREATE USER 'dbuser'@'%' IDENTIFIED BY 'dbpass';
-- GRANT ALL PRIVILEGES ON *.* TO 'dbuser'@'%';
-- FLUSH PRIVILEGES;

CREATE TABLE `user` (
	`user_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`login` VARCHAR(30) NOT NULL UNIQUE,
	`password` VARCHAR(32) NOT NULL,
	`name` VARCHAR(30) NOT NULL,
	`surname` VARCHAR(30) NOT NULL,
	`sex_id` INT(1) UNSIGNED NOT NULL
);

INSERT IGNORE INTO `user` (`user_id`, `login`, `password`, `name`, `surname`, `sex_id`) VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Tomasz', 'Madera', 1);

CREATE TABLE `sex` (
	`sex_id` INT(1) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`value` VARCHAR(30) NOT NULL
);

INSERT IGNORE INTO `sex` (`sex_id`, `value`) VALUES (1, 'M');
INSERT IGNORE INTO `sex` (`sex_id`, `value`) VALUES (2, 'K');

CREATE TABLE `wniosek` (
	`wniosek_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`typ_id` INT(1) UNSIGNED NOT NULL,
	`data_od` DATE NULL DEFAULT NULL,
	`data_do` DATE NULL DEFAULT NULL,
	`plik` VARCHAR(255) NULL DEFAULT NULL,
	`komentarz` TEXT NULL DEFAULT NULL
);

CREATE TABLE `typ` (
	`typ_id` INT(1) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`value` VARCHAR(30) NOT NULL
);

INSERT IGNORE INTO `typ` (`typ_id`, `value`) VALUES (1, 'Zwykły');
INSERT IGNORE INTO `typ` (`typ_id`, `value`) VALUES (2, 'Na żądanie');
INSERT IGNORE INTO `typ` (`typ_id`, `value`) VALUES (3, 'Urlop bezpłatny');
