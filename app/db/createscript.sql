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
('EuroSneak Org', 'euroorg', 'passAthens1', 'Hoofd Athens editie'),
('Milano Hype', 'milanoorg', 'passMilan2', 'Organisator Milan editie'),
('Paris Street Events', 'parisorg', 'passParis3', 'Organisator Paris editie');

INSERT INTO Bezoeker (Naam, Emailadres, Opmerking) VALUES
('Maria Papadopoulos', 'maria.p@test.com', 'Bezoeker Athens event'),
('Luca Bianchi', 'luca.b@test.com', 'Bezoeker Milan event'),
('Anna Kovacs', 'anna.k@test.com', 'Bezoeker Budapest event');

INSERT INTO Evenement (Naam, Datum, Locatie, AantalTicketsPerTijdslot, BeschikbareStands) VALUES
('Athens 2025',   '2025-10-10', 'Athens', 300, 40),
('Milan 2025',    '2025-11-15', 'Milan',  350, 50),
('Budapest 2025', '2025-11-08', 'Budapest', 250, 30),
('Bern 2025',     '2025-11-22', 'Bern',   200, 25),
('Paris 2026',    '2026-03-14', 'Paris',  400, 55);

INSERT INTO Prijs (Datum, Tijdslot, Tarief, Opmerking) VALUES
('2025-10-10', 'Ochtend', 20.00, 'Athens ochtendtarief'),
('2025-10-10', 'Middag', 25.00, 'Athens middagtarief'),
('2025-11-15', 'Middag', 30.00, 'Milan middagtarief'),
('2025-11-08', 'Avond', 22.50, 'Budapest avondtarief'),
('2025-11-22', 'Ochtend', 18.00, 'Bern ochtendtarief'),
('2026-03-14', 'Middag', 35.00, 'Paris middagtarief');

INSERT INTO Ticket (BezoekerId, EvenementId, PrijsId, AantalTickets, Datum, Opmerking) VALUES
(1, 1, 1, 2, '2025-10-10', 'Samen met vriendin'),
(2, 2, 3, 1, '2025-11-15', 'Solo bezoek'),
(3, 3, 4, 3, '2025-11-08', 'Groep vrienden');

INSERT INTO Verkoper (Naam, SpecialeStatus, VerkooptSoort, StandType, Dagen, Logo, Opmerking) VALUES
('Athens Kicks', TRUE, 'Sneakers', 'A', 'Eén dag', '', 'Populaire stand in Athens'),
('Milano Streetwear', FALSE, 'Kleding', 'AA', 'Twee dagen', '', 'Lokale modewinkel'),
('Paris Collectibles', FALSE, 'Accessoires', 'AA+', 'Eén dag', '', 'Speciale Paris editie'),
('Budapest Vintage', TRUE, 'Vintage kleding', 'A', 'Twee dagen', '', 'Vintage specialist'),
('Milan Artisans', FALSE, 'Handgemaakte items', 'AA', 'Eén dag', '', 'Lokale ambachtslieden');

INSERT INTO Stand (VerkoperId, StandType, Prijs, VerhuurdStatus, Opmerking) VALUES
(1, 'A', 200.00, TRUE, 'Verhuurd aan Athens Kicks'),
(2, 'AA', 250.00, TRUE, 'Milano Streetwear stand'),
(3, 'AA+', 300.00, FALSE, 'Paris stand nog beschikbaar'),
(4, 'AA+', 300.00, TRUE, 'Paris Collectibles stand'),
(5, 'AA', 250.00, FALSE, 'Extra stand beschikbaar voor Milan event');

INSERT INTO Contactpersoon (Naam, Telefoonnummer, Emailadres, Opmerking) VALUES
('Nikos Stavros', '0611111111', 'nikos@test.com', 'Contact Athens Kicks'),
('Giulia Rossi', '0622222222', 'giulia@test.com', 'Contact Milano Streetwear'),
('Claire Dubois', '0633333333', 'claire@test.com', 'Contact Paris Collectibles');

INSERT INTO ContactPerVerkoper (VerkoperId, ContactpersoonId, Opmerking) VALUES
(1, 1, 'Athens contactpersoon'),
(2, 2, 'Milan contactpersoon'),
(3, 3, 'Paris contactpersoon');
