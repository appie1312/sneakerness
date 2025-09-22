DROP DATABASE IF EXISTS sneakerness;
CREATE DATABASE sneakerness;
USE sneakerness;

CREATE TABLE Organisator (
     Id INT AUTO_INCREMENT PRIMARY KEY
    ,Naam VARCHAR(50) NOT NULL
    ,Gebruikersnaam VARCHAR(30) UNIQUE NOT NULL
    ,Wachtwoord VARCHAR(255) NOT NULL
    ,IsActief BOOLEAN DEFAULT TRUE
    ,Opmerking VARCHAR(255)
    ,DatumAangemaakt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,DatumGewijzigd TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE Bezoeker (
     Id INT AUTO_INCREMENT PRIMARY KEY
    ,Naam VARCHAR(50) NOT NULL
    ,Emailadres VARCHAR(100) UNIQUE NOT NULL
    ,IsActief BOOLEAN DEFAULT TRUE
    ,Opmerking VARCHAR(255)
    ,DatumAangemaakt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,DatumGewijzigd TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE Evenement (
     Id INT AUTO_INCREMENT PRIMARY KEY
    ,Naam VARCHAR(100) NOT NULL
    ,Datum DATE NOT NULL
    ,Locatie VARCHAR(100) NOT NULL
    ,AantalTicketsPerTijdslot INT NOT NULL
    ,BeschikbareStands INT NOT NULL
    ,IsActief BOOLEAN DEFAULT TRUE
    ,Opmerking VARCHAR(255)
    ,DatumAangemaakt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,DatumGewijzigd TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO Evenement (Naam, Datum, Locatie, AantalTicketsPerTijdslot, BeschikbareStands)
VALUES
('Athens 2025',   '2025-10-10', 'Athens', 300, 40),
('Milan 2025',    '2025-11-15', 'Milan',  350, 50),
('Budapest 2025', '2025-11-08', 'Budapest', 250, 30),
('Bern 2025',     '2025-11-22', 'Bern',   200, 25),
('Paris 2026',    '2026-03-14', 'Paris',  400, 55);


CREATE TABLE Prijs (
     Id INT AUTO_INCREMENT PRIMARY KEY
    ,Datum DATE NOT NULL
    ,Tijdslot VARCHAR(20) NOT NULL
    ,Tarief DECIMAL(6,2) NOT NULL
    ,IsActief BOOLEAN DEFAULT TRUE
    ,Opmerking VARCHAR(255)
    ,DatumAangemaakt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,DatumGewijzigd TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE Ticket (
     Id INT AUTO_INCREMENT PRIMARY KEY
    ,BezoekerId INT NOT NULL
    ,EvenementId INT NOT NULL
    ,PrijsId INT NOT NULL
    ,AantalTickets INT NOT NULL
    ,Datum DATE NOT NULL
    ,IsActief BOOLEAN DEFAULT TRUE
    ,Opmerking VARCHAR(255)
    ,DatumAangemaakt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,DatumGewijzigd TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ,FOREIGN KEY (BezoekerId) REFERENCES Bezoeker(Id)
    ,FOREIGN KEY (EvenementId) REFERENCES Evenement(Id)
    ,FOREIGN KEY (PrijsId) REFERENCES Prijs(Id)
);

CREATE TABLE Verkoper (
     Id INT AUTO_INCREMENT PRIMARY KEY
    ,Naam VARCHAR(75) NOT NULL
    ,SpecialeStatus BOOLEAN DEFAULT FALSE
    ,VerkooptSoort VARCHAR(50) NOT NULL
    ,StandType ENUM('A', 'AA', 'AA+') NOT NULL
    ,Dagen ENUM('Eén dag', 'Twee dagen') NOT NULL
    ,Logo VARCHAR(255)
    ,IsActief BOOLEAN DEFAULT TRUE
    ,Opmerking VARCHAR(255)
    ,DatumAangemaakt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,DatumGewijzigd TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE Stand (
     Id INT AUTO_INCREMENT PRIMARY KEY
    ,VerkoperId INT NOT NULL
    ,StandType ENUM('A', 'AA', 'AA+') NOT NULL
    ,Prijs DECIMAL(8,2) NOT NULL
    ,VerhuurdStatus BOOLEAN DEFAULT FALSE
    ,IsActief BOOLEAN DEFAULT TRUE
    ,Opmerking VARCHAR(255)
    ,DatumAangemaakt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,DatumGewijzigd TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ,FOREIGN KEY (VerkoperId) REFERENCES Verkoper(Id)
);

CREATE TABLE Contactpersoon (
     Id INT AUTO_INCREMENT PRIMARY KEY
    ,Naam VARCHAR(50) NOT NULL
    ,Telefoonnummer VARCHAR(15)
    ,Emailadres VARCHAR(100) UNIQUE NOT NULL
    ,IsActief BOOLEAN DEFAULT TRUE
    ,Opmerking VARCHAR(255)
    ,DatumAangemaakt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,DatumGewijzigd TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE ContactPerVerkoper (
     Id INT AUTO_INCREMENT PRIMARY KEY
    ,VerkoperId INT NOT NULL
    ,ContactpersoonId INT NOT NULL
    ,IsActief BOOLEAN DEFAULT TRUE
    ,Opmerking VARCHAR(255)
    ,DatumAangemaakt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ,DatumGewijzigd TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ,FOREIGN KEY (VerkoperId) REFERENCES Verkoper(Id)
    ,FOREIGN KEY (ContactpersoonId) REFERENCES Contactpersoon(Id)
);


INSERT INTO Organisator (Naam, Gebruikersnaam, Wachtwoord, Opmerking) VALUES
('Organisator 1', 'org1', 'wachtwoord123', 'Test organisator'),
('Organisator 2', 'org2', 'wachtwoord456', 'Test organisator'),
('Organisator 3', 'org3', 'wachtwoord789', 'Test organisator');

INSERT INTO Bezoeker (Naam, Emailadres, Opmerking) VALUES
('Abdulkadir', 'abdulkadir@test.com', 'Test bezoeker'),
('Emma', 'emma@test.com', 'Test bezoeker'),
('Lucas', 'lucas@test.com', 'Test bezoeker');

INSERT INTO Evenement (Naam, Datum, Locatie, AantalTicketsPerTijdslot, BeschikbareStands, Opmerking) VALUES
('Sneaker Expo 2025', '2025-10-10', 'Amsterdam', 100, 20, 'Test evenement'),
('Urban Sneak Event', '2025-11-05', 'Rotterdam', 50, 15, 'Test evenement'),
('Sneak Fest', '2025-12-01', 'Utrecht', 75, 10, 'Test evenement');

INSERT INTO Prijs (Datum, Tijdslot, Tarief, Opmerking) VALUES
('2025-10-10', 'Ochtend', 15.00, 'Ochtend tarief'),
('2025-10-10', 'Middag', 20.00, 'Middag tarief'),
('2025-11-05', 'Ochtend', 12.50, 'Ochtend tarief');

INSERT INTO Ticket (BezoekerId, EvenementId, PrijsId, AantalTickets, Datum, Opmerking) VALUES
(1, 1, 1, 2, '2025-10-10', ''),
(2, 1, 2, 1, '2025-10-10', ''),
(3, 2, 3, 3, '2025-11-05', '');

INSERT INTO Verkoper (Naam, SpecialeStatus, VerkooptSoort, StandType, Dagen, Logo, Opmerking) VALUES
('Sneaker Store 1', TRUE, 'Schoenen', 'A', 'Eén dag', '', 'Test verkoper'),
('Sneaker Store 2', FALSE, 'Kleding', 'AA', 'Twee dagen', '', 'Test verkoper'),
('Sneaker Store 3', FALSE, 'Accessoires', 'AA+', 'Eén dag', '', 'Test verkoper');

INSERT INTO Stand (VerkoperId, StandType, Prijs, VerhuurdStatus, Opmerking) VALUES
(1, 'A', 150.00, FALSE, 'Test stand'),
(2, 'AA', 200.00, TRUE, 'Verhuurde stand'),
(3, 'AA+', 250.00, FALSE, 'Test stand');

INSERT INTO Contactpersoon (Naam, Telefoonnummer, Emailadres, Opmerking) VALUES
('Jan Jansen', '0612345678', 'jan@test.com', 'Contactpersoon test'),
('Emma de Vries', '0698765432', 'emma@test.com', 'Contactpersoon test'),
('Lucas van Dijk', '0687654321', 'lucas@test.com', 'Contactpersoon test');

INSERT INTO ContactPerVerkoper (VerkoperId, ContactpersoonId, Opmerking) VALUES
(1, 1, 'Koppel test'),
(2, 2, 'Koppel test'),
(3, 3, 'Koppel test');