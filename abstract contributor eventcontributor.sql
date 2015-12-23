-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2015 at 05:03 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `devmeth`
--

-- --------------------------------------------------------

--
-- Table structure for table `abstract`
--

CREATE TABLE `abstract` (
  `abstractID` int(11) NOT NULL,
  `eventID` int(11) NOT NULL,
  `contributorID` int(11) NOT NULL,
  `abstract` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `abstractattachments`
--

CREATE TABLE `abstractattachments` (
  `attachmentID` int(11) NOT NULL,
  `abstractID` int(11) NOT NULL,
  `attachment` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contributor`
--

CREATE TABLE `contributor` (
  `contributorID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `title` varchar(10) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `institution` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eventcontributor`
--

CREATE TABLE `eventcontributor` (
  `eventID` int(11) NOT NULL,
  `contributorID` int(11) NOT NULL,
  `attendingStatus` tinyint(1) NOT NULL,
  `presentation` blob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abstract`
--
ALTER TABLE `abstract`
  ADD PRIMARY KEY (`abstractID`,`eventID`,`contributorID`);

--
-- Indexes for table `abstractattachments`
--
ALTER TABLE `abstractattachments`
  ADD PRIMARY KEY (`attachmentID`);

--
-- Indexes for table `contributor`
--
ALTER TABLE `contributor`
  ADD PRIMARY KEY (`contributorID`);

--
-- Indexes for table `eventcontributor`
--
ALTER TABLE `eventcontributor`
  ADD PRIMARY KEY (`eventID`,`contributorID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abstract`
--
ALTER TABLE `abstract`
  MODIFY `abstractID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `abstractattachments`
--
ALTER TABLE `abstractattachments`
  MODIFY `attachmentID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contributor`
--
ALTER TABLE `contributor`
  MODIFY `contributorID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
