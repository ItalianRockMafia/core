-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--

-- Erstellungszeit: 16. Mai 2018 um 10:52
-- Server-Version: 10.1.33-MariaDB
-- PHP-Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `husserjo_italianrockmafia`
--

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `albumArtist`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `albumArtist` (
`albumID` int(11)
,`album_title` varchar(255)
,`mbid` varchar(255)
,`artist` varchar(255)
);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `albums`
--

CREATE TABLE `albums` (
  `albumID` int(11) NOT NULL,
  `artistIDFK` int(11) NOT NULL,
  `album_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mbid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artistEvent`
--

CREATE TABLE `artistEvent` (
  `actID` int(11) NOT NULL,
  `artistIDFK` int(11) NOT NULL,
  `eventIDFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artists`
--

CREATE TABLE `artists` (
  `artistID` int(11) NOT NULL,
  `artist` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `attendes`
--

CREATE TABLE `attendes` (
  `attendeID` int(11) NOT NULL,
  `userIDFK` int(11) NOT NULL,
  `eventIDFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `carbrands`
--

CREATE TABLE `carbrands` (
  `brandID` int(11) NOT NULL,
  `brand` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `carmodels`
--

CREATE TABLE `carmodels` (
  `modelID` int(11) NOT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cars`
--

CREATE TABLE `cars` (
  `carID` int(11) NOT NULL,
  `brandIDFK` int(11) NOT NULL,
  `modelIDFK` int(11) NOT NULL,
  `ownerIDFK` int(11) NOT NULL,
  `colorIDFK` int(11) NOT NULL,
  `licence` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `places` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `carUsers`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `carUsers` (
`carID` int(11)
,`brand` varchar(255)
,`model` varchar(255)
,`color` varchar(50)
,`licence` varchar(50)
,`places` int(3)
,`firstname` varchar(255)
,`lastname` varchar(255)
,`telegramID` int(11)
,`tgusername` varchar(80)
);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `colors`
--

CREATE TABLE `colors` (
  `colorID` int(11) NOT NULL,
  `color` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `comments`
--

CREATE TABLE `comments` (
  `commentID` int(11) NOT NULL,
  `authorIDFK` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `emp-orders`
--

CREATE TABLE `emp-orders` (
  `empID` int(11) NOT NULL,
  `userIDFK` int(11) NOT NULL,
  `products` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `empComments`
--

CREATE TABLE `empComments` (
  `empCommID` int(11) NOT NULL,
  `empIDFK` int(11) NOT NULL,
  `commentIDFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `eventAttendes`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `eventAttendes` (
`attendeID` int(11)
,`eventIDFK` int(11)
,`telegramID` int(11)
,`tgusername` varchar(80)
,`firstname` varchar(255)
,`lastname` varchar(255)
);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `eventCarUsers`
--

CREATE TABLE `eventCarUsers` (
  `comboID` int(11) NOT NULL,
  `eventIDFK` int(11) NOT NULL,
  `carIDFK` int(11) NOT NULL,
  `userIDFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `eventComments`
--

CREATE TABLE `eventComments` (
  `eventCommentID` int(11) NOT NULL,
  `eventIDFK` int(11) NOT NULL,
  `commentIDFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `events`
--

CREATE TABLE `events` (
  `eventID` int(11) NOT NULL,
  `userIDFK` int(11) NOT NULL,
  `event_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `startdate` datetime NOT NULL,
  `enddate` datetime NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `station` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `eventUsers`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `eventUsers` (
`eventID` int(11)
,`event_title` varchar(255)
,`startdate` datetime
,`enddate` datetime
,`url` varchar(255)
,`station` varchar(255)
,`description` text
,`telegramID` int(11)
,`tgusername` varchar(80)
);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `stations`
--

CREATE TABLE `stations` (
  `stationID` int(11) NOT NULL,
  `station` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `userAlbums`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `userAlbums` (
`useralbumID` int(11)
,`album_title` varchar(255)
,`mbid` varchar(255)
,`artist` varchar(255)
,`telegramID` int(11)
,`tgusername` varchar(80)
);

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `userArtistEvent`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `userArtistEvent` (
`actID` int(11)
,`artistID` int(11)
,`artist` varchar(255)
,`eventID` int(11)
,`event_title` varchar(255)
,`telegramID` int(11)
);

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `userGoEventWithCar`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `userGoEventWithCar` (
`comboID` int(11)
,`telegramID` int(11)
,`firstname` varchar(255)
,`lastname` varchar(255)
,`licence` varchar(50)
,`places` int(3)
,`event_title` varchar(255)
,`color` varchar(50)
,`model` varchar(255)
,`brand` varchar(255)
);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `userHasAlbum`
--

CREATE TABLE `userHasAlbum` (
  `useralbumID` int(11) NOT NULL,
  `userIDFK` int(11) NOT NULL,
  `albumIDFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `telegramID` int(11) DEFAULT NULL,
  `tgusername` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `public_transport` tinyint(1) NOT NULL,
  `bsc` tinyint(1) NOT NULL,
  `accessIDFK` int(11) NOT NULL,
  `stationIDFK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `userStation`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `userStation` (
`userID` int(11)
,`telegramID` int(11)
,`firstname` varchar(255)
,`lastname` varchar(255)
,`tgusername` varchar(80)
,`station` varchar(255)
,`public_transport` tinyint(1)
);

-- --------------------------------------------------------

--
-- Struktur des Views `albumArtist`
--
DROP TABLE IF EXISTS `albumArtist`;

CREATE ALGORITHM=UNDEFINED DEFINER=`husserjo`@`10.0.24.%` SQL SECURITY DEFINER VIEW `albumArtist`  AS  select `albums`.`albumID` AS `albumID`,`albums`.`album_title` AS `album_title`,`albums`.`mbid` AS `mbid`,`artists`.`artist` AS `artist` from (`artists` left join `albums` on((`albums`.`artistIDFK` = `artists`.`artistID`))) order by `artists`.`artist`,`albums`.`album_title` ;

-- --------------------------------------------------------

--
-- Struktur des Views `carUsers`
--
DROP TABLE IF EXISTS `carUsers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`hpid_88225`@`10.0.24.%` SQL SECURITY DEFINER VIEW `carUsers`  AS  select `cars`.`carID` AS `carID`,`carbrands`.`brand` AS `brand`,`carmodels`.`model` AS `model`,`colors`.`color` AS `color`,`cars`.`licence` AS `licence`,`cars`.`places` AS `places`,`users`.`firstname` AS `firstname`,`users`.`lastname` AS `lastname`,`users`.`telegramID` AS `telegramID`,`users`.`tgusername` AS `tgusername` from ((((`users` left join `cars` on((`cars`.`ownerIDFK` = `users`.`userID`))) left join `colors` on((`cars`.`colorIDFK` = `colors`.`colorID`))) left join `carbrands` on((`cars`.`brandIDFK` = `carbrands`.`brandID`))) left join `carmodels` on((`cars`.`modelIDFK` = `carmodels`.`modelID`))) where (`cars`.`carID` <> 'NULL') ;

-- --------------------------------------------------------

--
-- Struktur des Views `eventAttendes`
--
DROP TABLE IF EXISTS `eventAttendes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`hpid_88225`@`10.0.24.%` SQL SECURITY DEFINER VIEW `eventAttendes`  AS  select `attendes`.`attendeID` AS `attendeID`,`attendes`.`eventIDFK` AS `eventIDFK`,`users`.`telegramID` AS `telegramID`,`users`.`tgusername` AS `tgusername`,`users`.`firstname` AS `firstname`,`users`.`lastname` AS `lastname` from (`users` left join `attendes` on((`attendes`.`userIDFK` = `users`.`userID`))) where (`attendes`.`attendeID` <> 'NULL') ;

-- --------------------------------------------------------

--
-- Struktur des Views `eventUsers`
--
DROP TABLE IF EXISTS `eventUsers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`hpid_88225`@`10.0.24.%` SQL SECURITY DEFINER VIEW `eventUsers`  AS  select `events`.`eventID` AS `eventID`,`events`.`event_title` AS `event_title`,`events`.`startdate` AS `startdate`,`events`.`enddate` AS `enddate`,`events`.`url` AS `url`,`events`.`station` AS `station`,`events`.`description` AS `description`,`users`.`telegramID` AS `telegramID`,`users`.`tgusername` AS `tgusername` from (`users` left join `events` on((`events`.`userIDFK` = `users`.`userID`))) where (`events`.`eventID` <> 'NULL') order by `events`.`startdate` ;

-- --------------------------------------------------------

--
-- Struktur des Views `userAlbums`
--
DROP TABLE IF EXISTS `userAlbums`;

CREATE ALGORITHM=UNDEFINED DEFINER=`hpid_88225`@`10.0.24.%` SQL SECURITY DEFINER VIEW `userAlbums`  AS  select `userHasAlbum`.`useralbumID` AS `useralbumID`,`albums`.`album_title` AS `album_title`,`albums`.`mbid` AS `mbid`,`artists`.`artist` AS `artist`,`users`.`telegramID` AS `telegramID`,`users`.`tgusername` AS `tgusername` from (((`users` left join `userHasAlbum` on((`userHasAlbum`.`userIDFK` = `users`.`userID`))) left join `albums` on((`userHasAlbum`.`albumIDFK` = `albums`.`albumID`))) left join `artists` on((`albums`.`artistIDFK` = `artists`.`artistID`))) where (`userHasAlbum`.`useralbumID` <> 'NULL') ;

-- --------------------------------------------------------

--
-- Struktur des Views `userArtistEvent`
--
DROP TABLE IF EXISTS `userArtistEvent`;

CREATE ALGORITHM=UNDEFINED DEFINER=`hpid_88225`@`10.0.24.%` SQL SECURITY DEFINER VIEW `userArtistEvent`  AS  select `artistEvent`.`actID` AS `actID`,`artists`.`artistID` AS `artistID`,`artists`.`artist` AS `artist`,`events`.`eventID` AS `eventID`,`events`.`event_title` AS `event_title`,`users`.`telegramID` AS `telegramID` from (((`artists` left join `artistEvent` on((`artistEvent`.`artistIDFK` = `artists`.`artistID`))) left join `events` on((`artistEvent`.`eventIDFK` = `events`.`eventID`))) left join `users` on((`events`.`userIDFK` = `users`.`userID`))) where (`artistEvent`.`actID` <> 'NULL') ;

-- --------------------------------------------------------

--
-- Struktur des Views `userGoEventWithCar`
--
DROP TABLE IF EXISTS `userGoEventWithCar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`hpid_88225`@`10.0.24.%` SQL SECURITY DEFINER VIEW `userGoEventWithCar`  AS  select `eventCarUsers`.`comboID` AS `comboID`,`users`.`telegramID` AS `telegramID`,`users`.`firstname` AS `firstname`,`users`.`lastname` AS `lastname`,`cars`.`licence` AS `licence`,`cars`.`places` AS `places`,`events`.`event_title` AS `event_title`,`colors`.`color` AS `color`,`carmodels`.`model` AS `model`,`carbrands`.`brand` AS `brand` from ((((((`eventCarUsers` left join `events` on((`eventCarUsers`.`eventIDFK` = `events`.`eventID`))) left join `cars` on((`eventCarUsers`.`carIDFK` = `cars`.`carID`))) left join `users` on((`eventCarUsers`.`userIDFK` = `users`.`userID`))) left join `carbrands` on((`cars`.`brandIDFK` = `carbrands`.`brandID`))) left join `carmodels` on((`cars`.`modelIDFK` = `carmodels`.`modelID`))) left join `colors` on((`cars`.`colorIDFK` = `colors`.`colorID`))) ;

-- --------------------------------------------------------

--
-- Struktur des Views `userStation`
--
DROP TABLE IF EXISTS `userStation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`hpid_88225`@`10.0.24.%` SQL SECURITY DEFINER VIEW `userStation`  AS  select `users`.`userID` AS `userID`,`users`.`telegramID` AS `telegramID`,`users`.`firstname` AS `firstname`,`users`.`lastname` AS `lastname`,`users`.`tgusername` AS `tgusername`,`stations`.`station` AS `station`,`users`.`public_transport` AS `public_transport` from (`stations` left join `users` on((`users`.`stationIDFK` = `stations`.`stationID`))) order by `users`.`lastname`,`users`.`firstname` ;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`albumID`),
  ADD UNIQUE KEY `unique_album` (`albumID`,`artistIDFK`,`album_title`),
  ADD UNIQUE KEY `artistAlbumUnique` (`album_title`,`artistIDFK`),
  ADD UNIQUE KEY `mbid` (`mbid`),
  ADD KEY `artist` (`artistIDFK`);

--
-- Indizes für die Tabelle `artistEvent`
--
ALTER TABLE `artistEvent`
  ADD PRIMARY KEY (`actID`),
  ADD UNIQUE KEY `uniqueAct` (`artistIDFK`,`eventIDFK`),
  ADD KEY `artist` (`artistIDFK`),
  ADD KEY `event` (`eventIDFK`);

--
-- Indizes für die Tabelle `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`artistID`),
  ADD UNIQUE KEY `artist` (`artist`);

--
-- Indizes für die Tabelle `attendes`
--
ALTER TABLE `attendes`
  ADD PRIMARY KEY (`attendeID`),
  ADD UNIQUE KEY `userevents` (`userIDFK`,`eventIDFK`),
  ADD KEY `userIDFK` (`userIDFK`),
  ADD KEY `eventIDFK` (`eventIDFK`);

--
-- Indizes für die Tabelle `carbrands`
--
ALTER TABLE `carbrands`
  ADD PRIMARY KEY (`brandID`),
  ADD UNIQUE KEY `brand` (`brand`);

--
-- Indizes für die Tabelle `carmodels`
--
ALTER TABLE `carmodels`
  ADD PRIMARY KEY (`modelID`),
  ADD UNIQUE KEY `model` (`model`);

--
-- Indizes für die Tabelle `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`carID`),
  ADD UNIQUE KEY `licence_2` (`licence`),
  ADD KEY `brandIDFK` (`brandIDFK`),
  ADD KEY `modeIDFK` (`modelIDFK`),
  ADD KEY `ownerIDFK` (`ownerIDFK`),
  ADD KEY `colorIDFK` (`colorIDFK`),
  ADD KEY `licence` (`licence`);

--
-- Indizes für die Tabelle `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`colorID`),
  ADD UNIQUE KEY `color` (`color`);

--
-- Indizes für die Tabelle `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `author` (`authorIDFK`);

--
-- Indizes für die Tabelle `emp-orders`
--
ALTER TABLE `emp-orders`
  ADD PRIMARY KEY (`empID`),
  ADD KEY `orderUser` (`userIDFK`),
  ADD KEY `order` (`products`(255));

--
-- Indizes für die Tabelle `empComments`
--
ALTER TABLE `empComments`
  ADD PRIMARY KEY (`empCommID`),
  ADD UNIQUE KEY `uniqueEmpComment` (`empIDFK`,`commentIDFK`) USING BTREE,
  ADD KEY `empIDFK` (`empIDFK`),
  ADD KEY `commentIDFK` (`commentIDFK`);

--
-- Indizes für die Tabelle `eventCarUsers`
--
ALTER TABLE `eventCarUsers`
  ADD PRIMARY KEY (`comboID`),
  ADD UNIQUE KEY `userEvent` (`userIDFK`,`eventIDFK`),
  ADD UNIQUE KEY `userEventCar` (`eventIDFK`,`carIDFK`,`userIDFK`),
  ADD KEY `event` (`eventIDFK`),
  ADD KEY `car` (`carIDFK`),
  ADD KEY `user` (`userIDFK`);

--
-- Indizes für die Tabelle `eventComments`
--
ALTER TABLE `eventComments`
  ADD PRIMARY KEY (`eventCommentID`),
  ADD UNIQUE KEY `uniqueEventComment` (`eventIDFK`,`commentIDFK`),
  ADD KEY `eventIDFK` (`eventIDFK`),
  ADD KEY `commentIDFK` (`commentIDFK`);

--
-- Indizes für die Tabelle `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventID`),
  ADD KEY `userIDFK` (`userIDFK`);

--
-- Indizes für die Tabelle `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`stationID`),
  ADD UNIQUE KEY `station` (`station`);

--
-- Indizes für die Tabelle `userHasAlbum`
--
ALTER TABLE `userHasAlbum`
  ADD PRIMARY KEY (`useralbumID`),
  ADD KEY `user` (`userIDFK`),
  ADD KEY `album` (`albumIDFK`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `tgusername` (`tgusername`),
  ADD UNIQUE KEY `telegramID` (`telegramID`),
  ADD KEY `stationIDFK` (`stationIDFK`),
  ADD KEY `accessIDFK` (`accessIDFK`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `albums`
--
ALTER TABLE `albums`
  MODIFY `albumID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT für Tabelle `artistEvent`
--
ALTER TABLE `artistEvent`
  MODIFY `actID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `artists`
--
ALTER TABLE `artists`
  MODIFY `artistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT für Tabelle `attendes`
--
ALTER TABLE `attendes`
  MODIFY `attendeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT für Tabelle `carbrands`
--
ALTER TABLE `carbrands`
  MODIFY `brandID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `carmodels`
--
ALTER TABLE `carmodels`
  MODIFY `modelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `cars`
--
ALTER TABLE `cars`
  MODIFY `carID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT für Tabelle `colors`
--
ALTER TABLE `colors`
  MODIFY `colorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT für Tabelle `emp-orders`
--
ALTER TABLE `emp-orders`
  MODIFY `empID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT für Tabelle `empComments`
--
ALTER TABLE `empComments`
  MODIFY `empCommID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT für Tabelle `eventCarUsers`
--
ALTER TABLE `eventCarUsers`
  MODIFY `comboID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT für Tabelle `eventComments`
--
ALTER TABLE `eventComments`
  MODIFY `eventCommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `events`
--
ALTER TABLE `events`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT für Tabelle `stations`
--
ALTER TABLE `stations`
  MODIFY `stationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT für Tabelle `userHasAlbum`
--
ALTER TABLE `userHasAlbum`
  MODIFY `useralbumID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_ibfk_1` FOREIGN KEY (`artistIDFK`) REFERENCES `artists` (`artistID`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `artistEvent`
--
ALTER TABLE `artistEvent`
  ADD CONSTRAINT `artistEvent_ibfk_1` FOREIGN KEY (`eventIDFK`) REFERENCES `events` (`eventID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `artistEvent_ibfk_2` FOREIGN KEY (`artistIDFK`) REFERENCES `artists` (`artistID`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `attendes`
--
ALTER TABLE `attendes`
  ADD CONSTRAINT `attendes_ibfk_1` FOREIGN KEY (`userIDFK`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendes_ibfk_2` FOREIGN KEY (`eventIDFK`) REFERENCES `events` (`eventID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`colorIDFK`) REFERENCES `colors` (`colorID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cars_ibfk_2` FOREIGN KEY (`brandIDFK`) REFERENCES `carbrands` (`brandID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cars_ibfk_3` FOREIGN KEY (`modelIDFK`) REFERENCES `carmodels` (`modelID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cars_ibfk_4` FOREIGN KEY (`ownerIDFK`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`authorIDFK`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `emp-orders`
--
ALTER TABLE `emp-orders`
  ADD CONSTRAINT `emp-orders_ibfk_1` FOREIGN KEY (`userIDFK`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `empComments`
--
ALTER TABLE `empComments`
  ADD CONSTRAINT `empComments_ibfk_1` FOREIGN KEY (`empIDFK`) REFERENCES `emp-orders` (`empID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `empComments_ibfk_2` FOREIGN KEY (`commentIDFK`) REFERENCES `comments` (`commentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `eventCarUsers`
--
ALTER TABLE `eventCarUsers`
  ADD CONSTRAINT `eventCarUsers_ibfk_1` FOREIGN KEY (`eventIDFK`) REFERENCES `events` (`eventID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eventCarUsers_ibfk_2` FOREIGN KEY (`userIDFK`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eventCarUsers_ibfk_3` FOREIGN KEY (`carIDFK`) REFERENCES `cars` (`carID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `eventComments`
--
ALTER TABLE `eventComments`
  ADD CONSTRAINT `eventComments_ibfk_1` FOREIGN KEY (`eventIDFK`) REFERENCES `events` (`eventID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eventComments_ibfk_2` FOREIGN KEY (`commentIDFK`) REFERENCES `comments` (`commentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`userIDFK`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `userHasAlbum`
--
ALTER TABLE `userHasAlbum`
  ADD CONSTRAINT `userHasAlbum_ibfk_1` FOREIGN KEY (`albumIDFK`) REFERENCES `albums` (`albumID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userHasAlbum_ibfk_2` FOREIGN KEY (`userIDFK`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`stationIDFK`) REFERENCES `stations` (`stationID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
