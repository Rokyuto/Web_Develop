create database IF NOT EXISTS book_flights;
use book_flights;

create table IF NOT EXISTS Cities(
	CityID int not null auto_increment primary key,
	CityCode varchar(3) not null,
    CityName varchar(60) not null,
    Airport varchar(60) not null,
    Country varchar(60) not null
);

create table IF NOT EXISTS Flights(
	ID int not null auto_increment primary key,
    FromCityID int not null,
    ToCityID int not null,
    FlightDate date not null,
    FlightDepartTime time not null,
    FlightDuration time not null,
    FlightClass varchar(45) not null,
    FlightPrice float not null,
    foreign key(FromCityID) references Cities(CityID),
	foreign key(ToCityID) references Cities(CityID)
);

CREATE TABLE IF NOT EXISTS users (
  idusers INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(45) NOT NULL,
  email VARCHAR(45) NOT NULL,
  password VARCHAR(255) NOT NULL,
  isAdmin BOOLEAN NOT NULL,
  PRIMARY KEY (idusers));
  
  create table IF NOT EXISTS UserFlight(
		UserID int not null,
        FlightID int not null,
        Seat varchar(3) not null,
        Gate int not null,
		primary key(UserID,FlightID),
        foreign key(UserID) references users(idusers),
        foreign key(FlightID) references Flights(ID)
	);