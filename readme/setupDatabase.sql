-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2013 at 04:56 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `easysupt`
--
CREATE DATABASE easysupt;
USE easysupt;
-- --------------------------------------------------------

--
-- Table structure for table `attend`
--

CREATE TABLE IF NOT EXISTS `attend` (
  `cadetID` int(11) NOT NULL,
  `formID` int(11) NOT NULL,
  PRIMARY KEY (`cadetID`,`formID`),
  KEY `fk_cadet_has_form1_form11_idx` (`formID`),
  KEY `fk_cadet_has_form1_cadet1_idx` (`cadetID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attend`
--

INSERT INTO `attend` (`cadetID`, `formID`) VALUES
(35, 1),
(61, 1),
(62, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cadet`
--

CREATE TABLE IF NOT EXISTS `cadet` (
  `cadetID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `firstName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `classYear` int(11) DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `squadNum` int(11) NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cadetID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=104 ;

--
-- Dumping data for table `cadet`
--

INSERT INTO `cadet` (`cadetID`, `email`, `firstName`, `lastName`, `classYear`, `isAdmin`, `squadNum`, `password`) VALUES
(1, 'c14gavin.delphia@usafa.edu', 'Gavin', 'Delphia', 14, 1, 21, 'bda9643ac6601722a28f238714274da4'),
(2, 'C13Francis.Adkins@usafa.edu', 'Francis', 'Adkins', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(3, 'C13David.Baska@usafa.edu', 'David', 'Baska', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(4, 'C13Christina.Beckett@usafa.edu', 'Christina', 'Beckett', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(5, 'C13Melissa.Cecil@usafa.edu', 'Melissa', 'Cecil', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(6, 'C13Nathan.Davies@usafa.edu', 'Nathan', 'Davies', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(7, 'C13Richard.Edwards@usafa.edu', 'Richard', 'Edwards', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(8, 'C13Robert.Gasper@usafa.edu', 'Robert', 'Gasper', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(9, 'C13Jonathan.Hagan@usafa.edu', 'Jonathan', 'Hagan', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(10, 'C13Molly.Heath@usafa.edu', 'Molly', 'Heath', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(11, 'C13Shawn.Hibbard@usafa.edu', 'Shawn', 'Hibbard', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(12, 'C13James.Hurley@usafa.edu', 'James', 'Hurley', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(13, 'C13Ryan.Kelly@usafa.edu', 'Ryan', 'Kelly', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(14, 'C13Seth.Kesler@usafa.edu', 'Seth', 'Kesler', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(15, 'C13William.Lawlor@usafa.edu', 'William', 'Lawlor', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(16, 'C13Michael.Leland@usafa.edu', 'Michael', 'Leland', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(17, 'C13Elisabeth.Mellado@usafa.edu', 'Elisabeth', 'Mellado', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(18, 'C13Christine.Molina@usafa.edu', 'Christine', 'Molina', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(19, 'C13Meagan.Ostrander@usafa.edu', 'Meagan', 'Ostrander', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(20, 'C13Gage.Parrott@usafa.edu', 'Gage', 'Parrott', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(21, 'C13Joshua.Partain@usafa.edu', 'Joshua', 'Partain', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(22, 'C13Maiya.Perich@usafa.edu', 'Maiya', 'Perich', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(23, 'C13Robert.Simmons@usafa.edu', 'Robert', 'Simmons', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(24, 'C13Justin.Sleeter@usafa.edu', 'Justin', 'Sleeter', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(25, 'C13Michael.Tibbs@usafa.edu', 'Michael', 'Tibbs', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(26, 'C13Cole.VonOhlen@usafa.edu', 'Cole', 'VonOhlen', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(27, 'C13Weston.Walker@usafa.edu', 'Weston', 'Walker', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(28, 'C13Zachary.Watkins@usafa.edu', 'Zachary', 'Watkins', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(29, 'C13Michael.Yemane@usafa.edu', 'Michael', 'Yemane', 13, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(30, 'C14Kenneth.Appel@usafa.edu', 'Kenneth', 'Appel', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(31, 'C14Daniel.Barringer@usafa.edu', 'Daniel', 'Barringer', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(32, 'C14Andrew.Burns@usafa.edu', 'Andrew', 'Burns', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(33, 'C14Grace.Cho@usafa.edu', 'Grace', 'Cho', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(34, 'C14Anna.Cruz@usafa.edu', 'Anna', 'Cruz', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(35, 'C14Joseph.Gallinatti@usafa.edu', 'Joseph', 'Gallinatti', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(36, 'C14Andrew.Gough@usafa.edu', 'Andrew', 'Gough', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(37, 'C14Taylor.Hanley@usafa.edu', 'Taylor', 'Hanley', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(38, 'C14Daniel.Hayduchok@usafa.edu', 'Daniel', 'Hayduchok', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(39, 'C14Matthew.Johnson@usafa.edu', 'Matthew', 'Johnson', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(40, 'C14Elizabeth.Keenan@usafa.edu', 'Elizabeth', 'Keenan', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(41, 'C14Andrew.Lambert@usafa.edu', 'Andrew', 'Lambert', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(42, 'C14Garrett.Manley@usafa.edu', 'Garrett', 'Manley', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(43, 'C14Nichole.McCarthy@usafa.edu', 'Nichole', 'McCarthy', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(44, 'C14Cherae.Medina@usafa.edu', 'Cherae', 'Medina', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(45, 'C14Evan.Miller@usafa.edu', 'Evan', 'Miller', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(46, 'C14Eric.Peek@usafa.edu', 'Eric', 'Peek', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(47, 'C14Esteban.Perez@usafa.edu', 'Esteban', 'Perez', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(48, 'C14Parker.Quinn@usafa.edu', 'Parker', 'Quinn', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(49, 'C14James.Reeder@usafa.edu', 'James', 'Reeder', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(50, 'C14Samantha.Saltamachia@usafa.edu', 'Samantha', 'Saltamachia', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(51, 'C14Ben.Scott@usafa.edu', 'Ben', 'Scott', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(52, 'C14Jonathan.Sebourn@usafa.edu', 'Jonathan', 'Sebourn', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(53, 'C14Jason.Torf@usafa.edu', 'Jason', 'Torf', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(54, 'C14Alec.Trilles@usafa.edu', 'Alec', 'Trilles', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(55, 'C14Charles.Whitaker@usafa.edu', 'Charles', 'Whitaker', 14, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(56, 'C15David.Adler@usafa.edu', 'David', 'Adler', 15, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(57, 'C15Katharine.Albright@usafa.edu', 'Katharine', 'Albright', 15, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(58, 'C15Jacob.Butters@usafa.edu', 'Jacob', 'Butters', 15, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(59, 'C15William.Chapman@usafa.edu', 'William', 'Chapman', 15, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(60, 'C15Owen.Corn@usafa.edu', 'Owen', 'Corn', 15, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(61, 'C15Patrick.Dunkel@usafa.edu', 'Patrick', 'Dunkel', 15, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(62, 'C15Alexander.Frazier@usafa.edu', 'Alexander', 'Frazier', 15, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(63, 'C15Molly.Gilroy@usafa.edu', 'Molly', 'Gilroy', 15, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(64, 'C15Davis.Gunter@usafa.edu', 'Davis', 'Gunter', 15, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(65, 'C15Michael.Hychko@usafa.edu', 'Michael', 'Hychko', 15, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(66, 'C15Abhiram.Iyengar@usafa.edu', 'Abhiram', 'Iyengar', 15, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(67, 'C15Robert.Larson@usafa.edu', 'Robert', 'Larson', 15, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(68, 'C15Scott.McGillivray@usafa.edu', 'Scott', 'McGillivray', 15, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(69, 'C15Blaise.McNeese@usafa.edu', 'Blaise', 'McNeese', 15, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(70, 'C15Jeanne.Nolan@usafa.edu', 'Jeanne', 'Nolan', 15, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(71, 'C15John.Pacheco@usafa.edu', 'John', 'Pacheco', 15, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(72, 'C15Nirachaporn.Pitaksarp@usafa.edu', 'Nirachaporn', 'Pitaksarp', 15, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(73, 'C15John.Rosenberg@usafa.edu', 'John', 'Rosenberg', 15, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(74, 'C15Robert.Schilpp@usafa.edu', 'Robert', 'Schilpp', 15, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(75, 'C15William.Sherrill@usafa.edu', 'William', 'Sherrill', 15, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(76, 'C15James.Shults@usafa.edu', 'James', 'Shults', 15, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(77, 'C15David.Stone@usafa.edu', 'David', 'Stone', 15, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(78, 'C15Grant.Taylor@usafa.edu', 'Grant', 'Taylor', 15, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(79, 'C15Marie.Yokan@usafa.edu', 'Marie', 'Yokan', 15, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(80, 'C16Madison.Aiman@usafa.edu', 'Madison', 'Aiman', 16, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(81, 'C16John.Allen@usafa.edu', 'John', 'Allen', 16, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(82, 'C16Colin.Borum@usafa.edu', 'Colin', 'Borum', 16, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(83, 'C16Pyung.Choi@usafa.edu', 'Pyung', 'Choi', 16, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(84, 'C16Brandon.Chung@usafa.edu', 'Brandon', 'Chung', 16, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(85, 'C16Marc.Corey@usafa.edu', 'Marc', 'Corey', 16, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(86, 'C16Alberto.DeLaRivaherrera@usafa.edu', 'Alberto', 'DeLaRivaherrera', 16, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(87, 'C16Amanda.Fanning@usafa.edu', 'Amanda', 'Fanning', 16, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(88, 'C16Jonathan.Graham@usafa.edu', 'Jonathan', 'Graham', 16, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(89, 'C16Samuel.Hunt@usafa.edu', 'Samuel', 'Hunt', 16, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(90, 'C16Michael.Hyde@usafa.edu', 'Michael', 'Hyde', 16, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(91, 'C16Stephen.Jones@usafa.edu', 'Stephen', 'Jones', 16, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(92, 'C16Kathy.Kim@usafa.edu', 'Kathy', 'Kim', 16, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(93, 'C16Jared.Koch@usafa.edu', 'Jared', 'Koch', 16, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(94, 'C16Krista.McAloose@usafa.edu', 'Krista', 'McAloose', 16, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(95, 'C16Kevin.Mihalik@usafa.edu', 'Kevin', 'Mihalik', 16, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(96, 'C16Clay.Nordhaus@usafa.edu', 'Clay', 'Nordhaus', 16, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(97, 'C16Zachary.Paulson@usafa.edu', 'Zachary', 'Paulson', 16, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(98, 'C16Elijah.Simon@usafa.edu', 'Elijah', 'Simon', 16, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(99, 'C16Nathanael.Turley@usafa.edu', 'Nathanael', 'Turley', 16, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(100, 'C16DAngelo.Turner@usafa.edu', 'DAngelo', 'Turner', 16, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(101, 'C16Zoe.VanWirt@usafa.edu', 'Zoe', 'VanWirt', 16, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(102, 'C16Kimberly.Webb@usafa.edu', 'Kimberly', 'Webb', 16, 0, 21, '92097fb7ec3608af03fde53c91fc0b67'),
(103, 'C16Timothy.Welkener@usafa.edu', 'Timothy', 'Welkener', 16, 0, 21, '92097fb7ec3608af03fde53c91fc0b67');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `eventID` int(11) NOT NULL AUTO_INCREMENT,
  `eventName` varchar(45) NOT NULL,
  `eventDate` date NOT NULL,
  PRIMARY KEY (`eventID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eventID`, `eventName`, `eventDate`) VALUES
(1, 'Parade', '2013-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `form1`
--

CREATE TABLE IF NOT EXISTS `form1` (
  `formID` int(11) NOT NULL AUTO_INCREMENT,
  `eventID` int(11) NOT NULL,
  `squadNum` int(11) NOT NULL,
  `fauxDeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`formID`),
  KEY `fk_form1_event1_idx` (`eventID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `form1`
--

INSERT INTO `form1` (`formID`, `eventID`, `squadNum`, `fauxDeleted`) VALUES
(1, 1, 21, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attend`
--
ALTER TABLE `attend`
  ADD CONSTRAINT `fk_cadet_has_form1_cadet1` FOREIGN KEY (`cadetID`) REFERENCES `cadet` (`cadetID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cadet_has_form1_form11` FOREIGN KEY (`formID`) REFERENCES `form1` (`formID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `form1`
--
ALTER TABLE `form1`
  ADD CONSTRAINT `fk_form1_event1` FOREIGN KEY (`eventID`) REFERENCES `event` (`eventID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
