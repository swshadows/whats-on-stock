DROP DATABASE IF EXISTS `whats-on-stock`;
CREATE DATABASE `whats-on-stock`;
USE `whats-on-stock`;

CREATE TABLE users(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	email VARCHAR(100) NOT NULL,
	password VARCHAR(255) NOT NULL,
	UNIQUE(email)
)