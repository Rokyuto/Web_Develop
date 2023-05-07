create database if not exists showroom;
use showroom;

CREATE TABLE IF NOT EXISTS user (
	user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(45) NOT NULL,
	email VARCHAR(45) NOT NULL,
	password VARCHAR(255) NOT NULL
);

create table if not exists carImages(
	images_ID int not null auto_increment primary key,
	carFrontImage varchar(255) NOT NULL,
    carBackImage varchar(255) NOT NULL,
    carInteriorImage varchar(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS car (
	car_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	brand VARCHAR(45) NOT NULL,
	model VARCHAR(45) NOT NULL,
    color VARCHAR(45) NOT NULL,
	price int NOT NULL,
    horsePower int NOT NULL,
    year year not null,
    description text not null,
    images_ID int not null,
    foreign key(images_ID) references carImages(images_ID)
);

CREATE TABLE IF NOT EXISTS information (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	CityName VARCHAR(45) NOT NULL,
	date date NOT NULL,
    startTime TIME NOT NULL,
	endTime TIME NOT NULL,
    cityImage varchar(255) NOT NULL
);