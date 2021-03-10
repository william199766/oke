-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2021 at 06:57 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pw2_pr_20202`
--
DROP DATABASE IF EXISTS `pw2_pr_20202`;
CREATE DATABASE IF NOT EXISTS `pw2_pr_20202` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pw2_pr_20202`;

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

DROP TABLE IF EXISTS `artists`;
CREATE TABLE `artists` (
  `idartists` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `debut` date NOT NULL,
  `leader` varchar(20) NOT NULL,
  `idcompany` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`idartists`, `name`, `debut`, `leader`, `idcompany`) VALUES
(1, 'Super Junior', '2005-11-06', 'Leeteuk', 1),
(2, 'EXO', '2012-04-08', 'Suho', 1),
(3, 'Blackpink', '2016-08-08', '-', 2),
(4, 'Stray Kids', '2018-03-26', 'Bang Chan', 3);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies` (
  `idcompany` int(11) NOT NULL,
  `nameCompany` varchar(30) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`idcompany`, `nameCompany`, `description`) VALUES
(1, 'SM Entertainment', 'SM Entertainment Co., Ltd. is a South Korean entertainment company founded in 1995 by Lee Soo-man. The company has developed and popularized numerous K-pop stars with huge global fandoms.'),
(2, 'YG Entertainment', 'YG Entertainment Inc. is a South Korean entertainment company established in 1996 by Yang Hyun-suk. The company operates as a record label, talent agency, music production company, event management and concert production company, and music publishing house.'),
(3, 'JYP Entertainment', 'JYP Entertainment Corporation is a South Korean multinational entertainment and record label conglomerate founded in 1997 by J. Y. Park.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`idartists`),
  ADD KEY `idcompany` (`idcompany`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`idcompany`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `idartists` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `idcompany` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artists`
--
ALTER TABLE `artists`
  ADD CONSTRAINT `artists_ibfk_1` FOREIGN KEY (`idcompany`) REFERENCES `companies` (`idcompany`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
