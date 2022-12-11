-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 07, 2022 at 02:54 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Jalees`
--

-- --------------------------------------------------------

--
-- Table structure for table `Babysitters`
--

CREATE TABLE `Babysitters` (
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `userID` text NOT NULL,
  `gender` text NOT NULL,
  `email` text NOT NULL,
  `photo` text NOT NULL DEFAULT 'css/images/ava2.webp',
  `pass` text NOT NULL,
  `phone` text NOT NULL,
  `city` text NOT NULL,
  `bio` text NOT NULL,
  `ID` int(11) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Babysitters`
--

INSERT INTO `Babysitters` (`firstName`, `lastName`, `userID`, `gender`, `email`, `photo`, `pass`, `phone`, `city`, `bio`, `ID`, `age`) VALUES
('Sarah', 'Salem', '2345675432', 'Female', 'sarah@outlook.com', 'css/images/woman2.png', '1234567!', '0505050505', 'Mecca', 'HI MY NAME IS SARAH I AM A BABYSITTTkjfkljfdRERehfkhfdfkdsfjkhvkfj', 2, 25);

-- --------------------------------------------------------

--
-- Table structure for table `jobRequests`
--

CREATE TABLE `jobRequests` (
  `kidsNames` text NOT NULL,
  `kidsAges` text NOT NULL,
  `serviceType` text NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `ID` int(11) NOT NULL,
  `parentID` int(11) NOT NULL,
  `babysitterID` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `reqStatus` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobRequests`
--

INSERT INTO `jobRequests` (`kidsNames`, `kidsAges`, `serviceType`, `startDate`, `endDate`, `startTime`, `endTime`, `ID`, `parentID`, `babysitterID`, `createdAt`, `reqStatus`) VALUES
('Salma', '8', 'Infant Babysitting', '2022-11-09', '2022-11-11', '14:00:00', '17:00:00', 33, 1, NULL, '2022-11-07 14:46:55', 'Expired'),
('Yasser, Amira', '5, 3', 'Infant Babysitting', '2022-11-10', '2022-11-17', '16:00:00', '22:00:00', 34, 6, NULL, '2022-11-07 16:52:42', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `Offers`
--

CREATE TABLE `Offers` (
  `offerID` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `offerStatus` text NOT NULL DEFAULT 'Pending' COMMENT 'accepted, rejected, pending, expired',
  `babysitterOfferID` int(11) NOT NULL,
  `requestID` int(11) NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Offers`
--

INSERT INTO `Offers` (`offerID`, `price`, `offerStatus`, `babysitterOfferID`, `requestID`, `createdAt`) VALUES
(92, 444, 'Canceled', 2, 33, '2022-11-07 16:48:11'),
(93, 222, 'Pending', 2, 33, '2022-11-07 16:48:44');

-- --------------------------------------------------------

--
-- Table structure for table `Parents`
--

CREATE TABLE `Parents` (
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `pass` text NOT NULL,
  `photo` text DEFAULT 'css/images/ava2.webp' COMMENT 'optional',
  `city` text NOT NULL,
  `email` text NOT NULL,
  `parentID` int(11) NOT NULL,
  `district` text NOT NULL,
  `street` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Parents`
--

INSERT INTO `Parents` (`firstName`, `lastName`, `pass`, `photo`, `city`, `email`, `parentID`, `district`, `street`) VALUES
('Dana', 'Almoaiqel', '1234567!', 'css/images/woman3.png', 'Riyadh', 'dana@gmail.com', 1, 'rahmaniyah', 'gla'),
('Ahmad', 'Salman', '1234567!', 'css/images/ava2.webp', 'Abha', 'ahmad@gmail.com', 6, 'Alsulaimaniyyah', 'ABC');

-- --------------------------------------------------------

--
-- Table structure for table `Reviews`
--

CREATE TABLE `Reviews` (
  `stars` int(11) NOT NULL COMMENT '0-5',
  `review` text NOT NULL,
  `babysitter` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `title` text NOT NULL,
  `reviewID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Reviews`
--

INSERT INTO `Reviews` (`stars`, `review`, `babysitter`, `parent`, `title`, `reviewID`) VALUES
(5, 'amazing', 2, 1, 'omg', 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Babysitters`
--
ALTER TABLE `Babysitters`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `jobRequests`
--
ALTER TABLE `jobRequests`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `Offers`
--
ALTER TABLE `Offers`
  ADD PRIMARY KEY (`offerID`),
  ADD KEY `babysitter who is offering` (`babysitterOfferID`),
  ADD KEY `job request being offered to` (`requestID`);

--
-- Indexes for table `Parents`
--
ALTER TABLE `Parents`
  ADD PRIMARY KEY (`parentID`),
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- Indexes for table `Reviews`
--
ALTER TABLE `Reviews`
  ADD PRIMARY KEY (`reviewID`),
  ADD KEY `babysitter` (`babysitter`),
  ADD KEY `reviews_ibfk_2` (`parent`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Babysitters`
--
ALTER TABLE `Babysitters`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobRequests`
--
ALTER TABLE `jobRequests`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `Offers`
--
ALTER TABLE `Offers`
  MODIFY `offerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `Parents`
--
ALTER TABLE `Parents`
  MODIFY `parentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Reviews`
--
ALTER TABLE `Reviews`
  MODIFY `reviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Offers`
--
ALTER TABLE `Offers`
  ADD CONSTRAINT `babysitter who is offering` FOREIGN KEY (`babysitterOfferID`) REFERENCES `Babysitters` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `job request being offered to` FOREIGN KEY (`requestID`) REFERENCES `jobRequests` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Reviews`
--
ALTER TABLE `Reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`babysitter`) REFERENCES `Babysitters` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`parent`) REFERENCES `Parents` (`parentID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
