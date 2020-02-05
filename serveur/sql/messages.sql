
CREATE TABLE messages
(
    id_message int(11) NOT NULL AUTO_INCREMENT,
    id_webdiffusion int(11) NOT NULL,
    pseudo varchar(45)NOT NULL,
    message longtext DEFAULT NULL,
    date_heure DATETIME,
    PRIMARY KEY(id_message)
);


CREATE TABLE compteurs
(
    compteur int(11) NOT NULL AUTO_INCREMENT,
    id_webdiffusion int(11) NOT NULL,
    pseudo varchar(45)NOT NULL,
    PRIMARY KEY(compteur)
);

-- -----------------------------------
-- ********************************* -
-- -----------------------------------
-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2020 at 02:32 AM
-- Server version: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `p51`
--

-- --------------------------------------------------------

--
-- Table structure for table `compteurs`
--

CREATE TABLE `compteurs` (
  `compteur` int(11) NOT NULL,
  `id_webdiffusion` int(11) NOT NULL,
  `pseudo` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id_message` int(11) NOT NULL,
  `id_webdiffusion` int(11) NOT NULL,
  `pseudo` varchar(45) NOT NULL,
  `message` longtext,
  `date_heure` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id_message`, `id_webdiffusion`, `pseudo`, `message`, `date_heure`) VALUES
(1, 1, 'U1', 'This is a test message', '2020-02-02 04:00:00'),
(2, 1, 'U2', 'This is another test message', '2020-01-14 08:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `compteurs`
--
ALTER TABLE `compteurs`
  ADD PRIMARY KEY (`compteur`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_message`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `compteurs`
--
ALTER TABLE `compteurs`
  MODIFY `compteur` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
