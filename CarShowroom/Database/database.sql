create database showroom;
use showroom;

CREATE TABLE IF NOT EXISTS user (
	user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(45) NOT NULL,
	email VARCHAR(45) NOT NULL,
	password VARCHAR(255) NOT NULL
);
