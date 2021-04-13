-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 13, 2021 at 09:34 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shis`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

DROP TABLE IF EXISTS `announcement`;
CREATE TABLE IF NOT EXISTS `announcement` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `dateAnnouncement` date NOT NULL,
  `messageA` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `dateAnnouncement`, `messageA`) VALUES
(15, '2020-04-25', 'hjvgh,jdfmn cvh mnbhdsjzx,mn hbjdsc'),
(16, '2020-11-03', 'Hello, I love you'),
(17, '2021-04-13', 'hello today is 13 april 2021...\r\n ');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `imageD` varchar(150) NOT NULL,
  `nameD` varchar(100) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `phoneNumber` int(25) NOT NULL,
  `country` varchar(25) NOT NULL,
  `sex` varchar(25) NOT NULL,
  `code` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `imageD`, `nameD`, `dateOfBirth`, `email`, `phoneNumber`, `country`, `sex`, `code`) VALUES
(21, 'C:\\Users\\HarsonY EducatioN\\Documents\\_DSC3827.JPG', 'Dr. Eveline Yuma', '1989-07-01', 'eveline@gmail.com', 58457858, 'United Arab Emirates', 'male', 8004),
(22, 'Frontend-vs-Backend.webp', 'Dr. Philipp Ozir', '1985-07-10', 'philippos@gmail.com', 569874521, 'Albania', 'male', 2812),
(23, 'PASSPORT PHOTO.jpg', 'Dr. aris', '1988-02-05', 'aris@yahoo.fr', 3, 'Select Country Name', 'male', 6902),
(24, 'Graduation.jpeg', 'Dr. Sherif', '1985-08-05', 'hdjd@yahoo.fr', 552656, 'Antarctica', 'male', 2234);

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

DROP TABLE IF EXISTS `enquiry`;
CREATE TABLE IF NOT EXISTS `enquiry` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `answer` text,
  `studentNumber` int(11) NOT NULL,
  `statusE` tinyint(1) NOT NULL,
  `dateMessage` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`id`, `question`, `answer`, `studentNumber`, `statusE`, `dateMessage`) VALUES
(8, 'Hello Doctor,\r\nIf you can help me this time i am not able to sleep i want you to suggest me a medicine so that i can take.', 'Hello dear,\r\nI understood but we can\'t provide a medicine like this first you have to come in ciu health center then I will consult you.', 21702770, 1, '2020-04-14'),
(7, 'Hello Dr\r\n\r\nPlease help me.', 'ok', 21916622, 1, '2020-04-08'),
(6, 'Hello Dr.\r\nJ\'ai mal.', 'Hello patient,\r\nHow are you?', 21916622, 1, '2020-04-04'),
(10, 'Hello Doctor, If you can help me this time i am not able to sleep i want you to suggest me a medicine so that i can take. ', 'Hello dear, I understood but we can\'t provide a medicine like this first you have to come in ciu health center then I will consult you.', 21702770, 1, '2020-04-14'),
(11, 'hcgbvhdcjbsdnxcbsd', 'Sauvy complains again !!!!!!!!!!!!!!!!!!', 21702770, 1, '2020-04-25'),
(12, 'Are you okay ???????????????????', 'yes, I\'m okay and you ??', 21917500, 1, '2020-11-03'),
(13, 'hello, how can I sleep ?\r\n', 'close your eyes and sleep...', 12345678, 1, '2020-11-03');

-- --------------------------------------------------------

--
-- Table structure for table `loginp`
--

DROP TABLE IF EXISTS `loginp`;
CREATE TABLE IF NOT EXISTS `loginp` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `pswd` varchar(25) NOT NULL,
  `repswd` varchar(25) NOT NULL,
  `studentId` int(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loginp`
--

INSERT INTO `loginp` (`id`, `username`, `pswd`, `repswd`, `studentId`) VALUES
(1, 'Dr. Sherif', '2234', '2234', 2234),
(2, 'Dr. aris', '6902', '6902', 6902),
(3, 'Richard Mbuyi', 'rich12345', 'rich12345', 21915555),
(4, 'Dr. Philipp Ozir', '2812', '2812', 2812),
(5, 'RECEPTION', '123', '123', 1),
(6, 'Harmick Makiese', '123456', '123456', 21702770),
(7, 'Rodrick Mbungu', '123456', '123456', 21916622),
(8, 'Eveline Yuma', '8004', '8004', 8004),
(9, 'ARNOLD MUTOMBO', '123456', '123456', 12345678);

-- --------------------------------------------------------

--
-- Table structure for table `medical_report`
--

DROP TABLE IF EXISTS `medical_report`;
CREATE TABLE IF NOT EXISTS `medical_report` (
  `Id` int(15) NOT NULL AUTO_INCREMENT,
  `appointmentDate` datetime NOT NULL,
  `comments` text NOT NULL,
  `temperature` varchar(25) NOT NULL,
  `bloodPressure` varchar(25) NOT NULL,
  `downloadFile` varchar(500) NOT NULL,
  `studentNumber` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medical_report`
--

INSERT INTO `medical_report` (`Id`, `appointmentDate`, `comments`, `temperature`, `bloodPressure`, `downloadFile`, `studentNumber`) VALUES
(9, '2020-04-13 11:12:39', 'You have to come back after 2 weeks for check up.', '40', '82.2', 'confirmation.pdf', 21702770),
(7, '2020-04-04 07:02:02', 'You\'re health is fine you don\'t have a problem in your health.', '29', '15/5', 'confirmation.pdf', 21916622),
(10, '2020-11-03 10:00:42', 'Drinks 2l of water every day', '10', '145', 'house.jfif', 12345678);

-- --------------------------------------------------------

--
-- Table structure for table `schedule_appointment`
--

DROP TABLE IF EXISTS `schedule_appointment`;
CREATE TABLE IF NOT EXISTS `schedule_appointment` (
  `Id` int(25) NOT NULL AUTO_INCREMENT,
  `scheduleId` varchar(100) NOT NULL,
  `doctorName` varchar(45) NOT NULL,
  `appointmentDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `timeSchedule` varchar(25) NOT NULL,
  `patientName` varchar(100) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `studentNumber` int(25) NOT NULL,
  `patientMobile` varchar(15) NOT NULL,
  `country` varchar(150) NOT NULL,
  `department` varchar(150) NOT NULL,
  `gender` varchar(25) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule_appointment`
--

INSERT INTO `schedule_appointment` (`Id`, `scheduleId`, `doctorName`, `appointmentDate`, `timeSchedule`, `patientName`, `dateOfBirth`, `studentNumber`, `patientMobile`, `country`, `department`, `gender`) VALUES
(55, '21702770-20-04-13-11:12:25', 'Eveline Yuma', '2020-05-11 00:00:00', '11h55 - 12h55', 'Harmick Makiese', '1987-06-25', 21702770, '05338369731', 'Democratic Republic Of Congo', 'Information Technologies', 'male'),
(57, '21916622-20-04-14-07:08:13', 'Eveline Yuma', '2020-04-30 00:00:00', '10h45 - 11h45', 'Rodrick Mbungu', '1999-01-25', 21916622, '0625478941', 'Afghanistan', 'Radio &amp; Tv Programming', 'female'),
(58, '12345678-20-11-03-10:00:01', 'Dr. Sherif', '2020-11-03 00:00:00', '14h10 - 15h10', 'ARNOLD MUTOMBO', '2020-11-03', 12345678, '5391096944', 'Democratic Republic Of Congo', 'Computer Engineering', 'male');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
