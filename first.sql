create or replace database wsers2;
use wsers2;

create table PPL (
    PersonID int NOT NULL auto_increment,
    FirstName varchar(50),
    LastName varchar (50),
    Age int,
    PRIMARY KEY (PersonID)
);

INSERT INTO PPL (LastName, FirstName, Age) VALUES ("Bugs", "Bunny", 120);
INSERT INTO PPL (LastName, FirstName, Age) VALUES ("Bruce", "Lee", 90);
INSERT INTO PPL (LastName, FirstName, Age) VALUES ("Peppa", "Pig", 40);
INSERT INTO PPL (LastName, FirstName, Age) VALUES ("John", "Doe", 0);