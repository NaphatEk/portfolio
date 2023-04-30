-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2023 at 05:59 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstores`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `BookID` varchar(10) NOT NULL,
  `BookTitle` varchar(100) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Author` varchar(128) DEFAULT NULL,
  `Type` varchar(128) DEFAULT NULL,
  `Image` varchar(128) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`BookID`, `BookTitle`, `Price`, `Author`, `Type`, `Image`, `Quantity`) VALUES
('B-001', 'A Room with a View', '200.00', 'Forster, E. M. (Edward Morgan)', 'modernist literature', 'image/ARoom.png', 3),
('B-002', 'War and Peace', '250.00', 'Tolstoy, Leo, graf', 'Historical novel', 'image/WarAndPeace.png', 5),
('B-003', 'Anna Karenina', '250.00', 'Tolstoy, Leo, graf', 'Novel', 'image/AnnaKarenina.png', 7),
('B-004', 'Pride and Prejudice', '200.00', 'Austen, Jane', 'Romantic novel', 'image/PrideAndPrejudice.png', 10),
('B-005', 'Alice\'s Adventures in Wonderland', '250.00', 'Carroll, Lewis', 'Children\'s literature', 'image/AliceAdventures.png', 5);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CartID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `BookID` varchar(10) DEFAULT NULL,
  `Price` decimal(12,2) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `TotalPrice` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `CustomerFName` varchar(64) DEFAULT NULL,
  `CustomerLName` varchar(64) DEFAULT NULL,
  `CustomerPhone` varchar(12) DEFAULT NULL,
  `CustomerEmail` varchar(100) DEFAULT NULL,
  `CusAddress` varchar(200) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `OrderID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `BookID` varchar(10) DEFAULT NULL,
  `DatePurchase` datetime DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `TotalPrice` decimal(12,2) DEFAULT NULL,
  `Status` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(128) DEFAULT NULL,
  `Password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`BookID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CartID`),
  ADD KEY `BookID` (`BookID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `BookID` (`BookID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`BookID`) REFERENCES `book` (`BookID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`BookID`) REFERENCES `book` (`BookID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
