drop database wsers2;

create database wsers2;
use wsers2;

Create table Countries (
    ID_COUNTRY int not null AUTO_INCREMENT,
    CountryName varchar(50) UNIQUE,
    primary key (ID_COUNTRY)
);

CREATE TABLE PPL (
    ID_PERSON int NOT NULL AUTO_INCREMENT,
    LastName varchar(50),
    FirstName varchar(50),
    Age int,
    UserName varchar(20) NOT NULL UNIQUE,
    Psw varchar(100) NOT NULL,
    primary key (ID_PERSON),
    ID_COUNTRY int not null,
    foreign key (ID_COUNTRY) references Countries(ID_COUNTRY)
);

Insert into Countries (CountryName) values ("Luxembourg");