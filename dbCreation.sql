drop database wsers2;
create database wsers2;
use wsers2;

Create table Countries (
    ID_COUNTRY int not null AUTO_INCREMENT,
    CountryName varchar(50) UNIQUE,
    PPL_count varchar(20),
    primary key (ID_COUNTRY)
);


CREATE TABLE PPL (
    ID_PERSON int NOT NULL AUTO_INCREMENT,
    LastName varchar(50),
    FirstName varchar(50),
    UserName varchar(20) NOT NULL UNIQUE,
    Psw varchar(100) NOT NULL,
    ID_COUNTRY int not null,
    UserRole varchar(20),
    primary key (ID_PERSON),
    foreign key (ID_COUNTRY) references Countries(ID_COUNTRY)
);

Create table Product (
    ID_Prouduct int NOT NULL AUTO_INCREMENT,
    PName varchar(50),
    Price decimal(5,2),
    ItemsNumber int(5),
    primary key (ID_Prouduct)
);


Insert into Countries (CountryName) values ("Luxembourg");

