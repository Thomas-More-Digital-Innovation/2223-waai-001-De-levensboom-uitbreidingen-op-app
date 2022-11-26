SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+01:00";

-- verwijder onderstaande DROP TABLE commando's bij eerste uitvoering
-- DROP TABLE nieuwtjes;
-- DROP TABLE infoBlok; 
-- DROP TABLE infoSegment;
-- DROP TABLE afdelingBegeleiderClient;
-- DROP TABLE begeleider;
-- DROP TABLE client;
-- DROP TABLE afdeling;
-- DROP TABLE contactGegevens;
-- DROP TABLE secretCodes;
-- DROP TABLE tevredenheidsMeting;
-- DROP TABLE mails;


-- Database: `waaiburg_db` - utf8mb4_unicode_ci
--
-- --------------------------------------------------------
--
-- Table structure for table `contactGegevens`
--
CREATE TABLE `contactGegevens` (
  `contactGegevensId` int(11) NOT NULL AUTO_INCREMENT,
  `straat` varchar(255),
  `huisNr` varchar(255),
  `woonplaats` varchar(255),
  `postcode` varchar(255),
  `telNummer` varchar(255),
  `email` varchar(255),
  `isActief` boolean NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (contactGegevensId)
);
-- --------------------------------------------------------
--
-- Table structure for table `afdeling`
--
CREATE TABLE `afdeling` (
  `afdelingId` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(255) NOT NULL,
  `contactGegevensId` int(11) NOT NULL,
  `isActief` boolean NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (afdelingId),
  FOREIGN KEY (contactGegevensId) REFERENCES contactGegevens(contactGegevensId) ON DELETE CASCADE
);
-- --------------------------------------------------------
--
-- Table structure for table `client`
--
CREATE TABLE `client` (
  `clientId` int(11) NOT NULL AUTO_INCREMENT,
  `voornaam` varchar(255) NOT NULL,
  `achternaam` varchar(255) NOT NULL,
  `geslacht` varchar(255) NOT NULL,
  `geboorteDatum` date NOT NULL,
  `wachtwoord` varchar(255),
  `contactGegevensId` int(11) NOT NULL,
  `isActief` boolean NOT NULL, 
  `tevredenheidsMetingVerstuurd` boolean DEFAULT false, 
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (clientId),
  FOREIGN KEY (contactGegevensId) REFERENCES contactGegevens(contactGegevensId) ON DELETE CASCADE
);
-- --------------------------------------------------------
--
-- Table structure for table `begeleider`
--
CREATE TABLE `begeleider` (
  `begeleiderId` int(11) NOT NULL AUTO_INCREMENT,
  `voornaam` varchar(255) NOT NULL,
  `achternaam` varchar(255) NOT NULL,
  `functie` enum('admin','afdelingHoofd','begeleider') NOT NULL,
  `isVerified` boolean NOT NULL,
  `wachtwoord` varchar(255),
  `contactGegevensId` int(11) NOT NULL,
  `isActief` boolean NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (begeleiderId),
  FOREIGN KEY (contactGegevensId) REFERENCES contactGegevens(contactGegevensId) ON DELETE CASCADE
);
-- --------------------------------------------------------
--
-- Table structure for table `afdelingBegeleider`
--
CREATE TABLE `afdelingBegeleiderClient` (
  `afdelingBegeleiderClientId` int(11) NOT NULL AUTO_INCREMENT,
  `afdelingId` int(11),
  `begeleiderId` int(11),
  `clientId` int(11),
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (afdelingBegeleiderClientId),
  FOREIGN KEY (afdelingId) REFERENCES afdeling(afdelingId) ON DELETE CASCADE,
  FOREIGN KEY (clientId) REFERENCES client(clientId) ON DELETE CASCADE,
  FOREIGN KEY (begeleiderId) REFERENCES begeleider(begeleiderId) ON DELETE CASCADE
);
-- --------------------------------------------------------
--
-- Table structure for table `infoSegment`
--
CREATE TABLE `infoSegment` (
  `infoSegmentId` int(11) NOT NULL AUTO_INCREMENT,
  `titel` varchar(255) NOT NULL,
  `isVolwassenen` boolean NOT NULL,
  `volgordeNr` int(11) NOT NULL,
  `isActief` boolean NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (infoSegmentId)
);
-- --------------------------------------------------------
--
-- Table structure for table `infoBlok`
--
CREATE TABLE `infoBlok` (
  `infoBlokId` int(11) NOT NULL AUTO_INCREMENT,
  `titel` varchar(255) NOT NULL,
  `inhoud` varchar(10000),
  `blokFotoUrl` varchar(255),
  `meerInfoLink` varchar(255),
  `infoSegmentId` int(11) NOT NULL,
  `volgordeNr` int(11) NOT NULL,
  `isActief` boolean NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (infoBlokId),
  FOREIGN KEY (infoSegmentId) REFERENCES infoSegment(infoSegmentId) ON DELETE CASCADE
);
-- --------------------------------------------------------
--
-- Table structure for table `nieuwtjes`
--
CREATE TABLE `nieuwtjes` (
  `nieuwtjesId` int(11) NOT NULL AUTO_INCREMENT,
  `titel` varchar(255) NOT NULL,
  `korteInhoud` varchar(350),
  `inhoud` varchar(10000),
  `isActief` boolean NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (nieuwtjesId)
);
-- --------------------------------------------------------
--
-- Table structure for table `secretCodes`
--
CREATE TABLE `secretCodes` (
  `secretCodeId` int(11) NOT NULL AUTO_INCREMENT,
  `secretcode` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (secretCodeId)
);
-- --------------------------------------------------------
--
-- Table structure for table `tevredenheidsmetingLink`
--
CREATE TABLE `tevredenheidsMeting` (
  `tevredenheidsMetingId` int(11) NOT NULL AUTO_INCREMENT,
  `formLink` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (tevredenheidsMetingId)
);

-- --------------------------------------------------------
--
-- Table structure for table `mails`
--
CREATE TABLE `mails` (
  `mailId` int(11) NOT NULL AUTO_INCREMENT,
  `titel` varchar(255) NOT NULL,
  `inhoud` varchar(10000),
  `isActief` boolean NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (mailId)
);

--
-- Inserting test data in table `tevredenheidsMeting`
--
INSERT INTO `tevredenheidsMeting` (`formLink`) VALUES
('Google form link');

--
-- Inserting test data in table `contactgegevens`
--
INSERT INTO `contactGegevens` (`straat`, `huisNr`, `woonplaats`, `postcode`, `telNummer`, `email`) VALUES
('Kameinestraat', '35', 'Geel', '2440', '014/58.84.56', 'leeuwerik@dewaaiburg.be'),
('Kameinestraat', '35', 'Geel', '2440', '014/58.84.56', 'spoor@dewaaiburg.be'),
('Wilgenstraat', '18', 'Mol', '2400', '014/31.92.45', 'janrap@dewaaiburg.be'),
('Dorpsstraat', '14', 'Booischot', '2221', '0474177181', 'r0784206@student.thomasmore.be'),
('Hoogstraat', '56', 'Tremelo', '3120', '0474157241', 'Jef@hotmail.com'),
('Laagstraat', '65', 'Tongelro', '2260', '0474512714', 'Josy@outlook.com'),
('Dorpsstraat', '14', 'Booischot', '2221', '0474177181', 'yannick@hagim.be'),
('Middelstraat', '2', 'Mol', '2400', '0484112615', 'tinne@gmail.com'),
('Groenstraat', '444', 'Antwerpen', '2000', '0584113615', 'jan@gmail.com');
--
-- Inserting test data in table `afdeling`
--
INSERT INTO `afdeling` (`naam`, `contactgegevensId`, `isActief`) VALUES
("Leeuwrik", 1, true),
("t'Spoor", 2, true),
("Jan Rap", 3, true);
--
-- Inserting test data in table `client`
--
INSERT INTO `client` (`afdelingId`, `voornaam`, `achternaam`, `geslacht`, `geboorteDatum`, `wachtwoord`, `contactgegevensId`, `isActief`) VALUES
(1, 'Yannick', 'Ceulemans', 'mannelijk', DATE '2000-05-17', 'password', 4, true),
(3, 'Jef', 'Jefferson', 'mannelijk', DATE '2005-06-07', 'password', 5, true),
(2, 'Josy', 'Josierson', 'vrouwlijk', DATE '2007-11-15', 'password', 6, true);
--
-- Inserting test data in table `begeleider`
--
INSERT INTO `begeleider` ( `voornaam`, `achternaam`, `functie`, `isVerified`, `wachtwoord`, `contactgegevensId`, `isActief`) VALUES
('Yannick', 'Ceulemans', 'Developer', true, true, '$2y$10$RG9CF3ZORb8FTqO.sd2hRuybuXOar/VXmybU6QKtl3/jqVUxAiyJ.', 7, true);
--
-- Inserting test data in table `afdelingBegeleider`
--
INSERT INTO `afdelingBegeleider` (`afdelingId`, `begeleiderId`) VALUES
(5, 3),
(6, 4);
--
-- Inserting test data in table `infoSegment`
--
INSERT INTO `infoSegment` ( `titel`, `isVolwassenen`, `volgordeNr`, `isActief`) VALUES
('Afdelingen', true , 1, true),
('Vragen over mijn begeleiding', true , 2, true),
('Rechten, Plichten, Klachten', false , 1, true),
('Afdelingen', false , 2, true);

--
-- Inserting data in table `mails`
--
INSERT INTO `mails` (`mailId`, `titel`, `inhoud`, `isActief`, `createdAt`) VALUES
(0, 'Account aangemaakt voor APP', 'testdata', true, DATE '2022-01-10'),
(1, 'Account aangemaakt voor WEBAPP', 'testdata', true, DATE '2022-01-10'),
(2, 'Wachtwoord vergeten voor APP', 'testdata', true, DATE '2022-01-10'),
(3, 'Wachtwoord vergeten voor WEBAPP', 'testdata', true, DATE '2022-01-10'),
(4, 'Tevredenheidsmeting beschikbaar', 'testdata', true, DATE '2022-01-10');

--

COMMIT;