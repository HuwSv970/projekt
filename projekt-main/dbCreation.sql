drop database wsers2;
create database wsers2;
use wsers2;

Create table Countries (
    ID_COUNTRY int not null AUTO_INCREMENT,
    CountryName varchar(50) UNIQUE,
    PPL_count int(5),
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
    foreign key (ID_COUNTRY) references Countries(ID_COUNTRY) ON DELETE CASCADE
);

Create table Products (
    ID_Product int NOT NULL AUTO_INCREMENT,
    PName varchar(50),
    Price int(5),
    ItemsNumber int(5),
    pic_Name varchar(20),
    primary key (ID_Product)
);
Create table OrderTable (
    ID_ORDER int NOT NULL AUTO_INCREMENT,
    person_Order int(5),
    primary key (ID_ORDER),
    foreign key (person_Order) references PPL(ID_PERSON)
 );
Create table OrderContent(
    ID_ORDERCONTENT int NOT NULL AUTO_INCREMENT,
    primary key (ID_OrderContent),
    order_Number int(5),
    order_Item int(5),
    foreign key (order_Number) references OrderTable(ID_ORDER),
    foreign key (order_Item) references Products(ID_Product)
);
Insert into Countries (CountryName) values ("Luxembourg");