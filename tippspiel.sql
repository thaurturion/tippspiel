-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 12. Mai 2014 um 14:47
-- Server Version: 5.5.31
-- PHP-Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `tippspiel`
--
CREATE DATABASE IF NOT EXISTS `tippspiel` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tippspiel`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `game`
--

CREATE TABLE IF NOT EXISTS `game` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `teamA` int(11) NOT NULL,
  `teamB` int(11) NOT NULL,
  `scoreA` int(11) DEFAULT NULL,
  `scoreB` int(11) DEFAULT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `teamA` (`teamA`),
  KEY `teamB` (`teamB`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `game`
--

INSERT INTO `game` (`ID`, `teamA`, `teamB`, `scoreA`, `scoreB`, `datetime`) VALUES
(2, 1, 2, NULL, NULL, '2014-06-16 18:00:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ranking`
--

CREATE TABLE IF NOT EXISTS `ranking` (
  `team_id` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  PRIMARY KEY (`team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `ID` int(11) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `scored` int(11) NOT NULL,
  `received` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `group` varchar(1) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `team_name` (`team_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `team`
--

INSERT INTO `team` (`ID`, `team_name`, `scored`, `received`, `points`, `group`) VALUES
(1, 'Deutschland', 0, 0, 0, 'G'),
(2, 'Portugal', 0, 0, 0, 'G');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tipp`
--

CREATE TABLE IF NOT EXISTS `tipp` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_ID` int(11) NOT NULL,
  `game_ID` int(11) NOT NULL,
  `tippScoreA` int(11) NOT NULL,
  `tippScoreB` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `user_ID` (`user_ID`),
  KEY `game_ID` (`game_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `cash` int(11) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL,
  `point` int(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `ID_2` (`ID`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`ID`, `username`, `password`, `email`, `birthdate`, `cash`, `admin`, `point`) VALUES
(1, 'Hans wurst', 'dwqerb', 'fd', '2014-04-09', 7777, 0, 234567),
(2, 'Van der Vaart', 'dfvgbhjnm', 'sdf@fdsv.de', '2014-04-05', 0, 0, 2),
(3, 'Manuel Digeser', 'lauch', 'test@test.de', '2014-04-22', 77, 1, 0),
(4, 'a', 'a', 'jojo', '2014-04-15', 9999, 0, 11),
(5, 'lauch', 'lauch', 'e', '0000-00-00', NULL, 0, NULL),
(6, '', '', '', '0000-00-00', NULL, 0, 0);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`teamA`) REFERENCES `team` (`ID`),
  ADD CONSTRAINT `game_ibfk_2` FOREIGN KEY (`teamB`) REFERENCES `team` (`ID`);

--
-- Constraints der Tabelle `ranking`
--
ALTER TABLE `ranking`
  ADD CONSTRAINT `ranking_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `team` (`ID`);

--
-- Constraints der Tabelle `tipp`
--
ALTER TABLE `tipp`
  ADD CONSTRAINT `tipp_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `tipp_ibfk_2` FOREIGN KEY (`game_ID`) REFERENCES `game` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
