-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2021 at 12:36 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petsco`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ItemID` int(11) NOT NULL,
  `Name` varchar(64) NOT NULL,
  `Brand` varchar(64) NOT NULL,
  `Description` varchar(512) NOT NULL,
  `Category` int(11) NOT NULL,
  `SellingPrice` float NOT NULL,
  `QuantityInStock` int(11) NOT NULL,
  `Image` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ItemID`, `Name`, `Brand`, `Description`, `Category`, `SellingPrice`, `QuantityInStock`, `Image`) VALUES
(2, 'Rover', 'Husky', 'A super awesome dog.', 0, 200, 3, 'dog1.jpg'),
(3, 'Coco', 'German Shephard', 'Huge lazy dog.', 0, 100, 1, 'dog2.jpg'),
(4, 'Mini Indoor Adult Food', 'Royal Canin', 'Dog food for adult dog.', 1, 20.1, 9, '541ca8aad3a9b4444265538d74d125de.png'),
(5, 'Puppy Mini Food', 'Royal Canin', 'Dog food for puppy.', 1, 18.2, 9, '85c9e183179520e9e8bfdc078a048aa7.jpg'),
(6, 'Large Bed', 'PETS.CO', 'Super large and comfy bed.', 2, 50.3, 3, 'ins bed large grey-400x385h.jpg'),
(7, 'RGB Collar', 'Razer', 'RGB collar for RGB lovers.', 2, 100.2, 7, 'rgb collar - blue.jpg'),
(8, 'Mikey', 'Dachshund', 'Dog with white fur.', 0, 305.2, 10, 'Brand - Dachshund.jpg'),
(9, 'Fluffy', 'Golden Retriever', 'Fluffy white doggy.', 0, 142.3, 24, 'Brand - Golden Retriever.jpg'),
(10, 'Natural Chicken', 'Instinct', 'Real chicken dog food.', 1, 30.8, 30, 'Be Natural Chicken 2kg 652809-400x385h.jpg'),
(11, 'Salmon', 'Alps Natural', 'Premium salmon food.', 1, 30.5, 20, '550010_ALPS_DOG_1.8KG_SMALLBITESALMON-400x385h.jpg'),
(12, 'Tin Salmon', 'Alps Natural', 'A tin of premium salmon.', 1, 28.3, 24, 'alpls salmon-400x385h.jpg'),
(13, 'Red Leash', 'PETS.CO', 'A red leash to guide your dog.', 2, 10, 49, 'leash red-400x385h.jpg'),
(14, 'Dark Blue Harness', 'PETS.CO', 'Use this harness to keep your dog safe!', 2, 15, 60, 'dark-blue harness.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `MemberID` int(11) NOT NULL,
  `Username` varchar(64) NOT NULL,
  `Password` varchar(512) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `PrivilegeLevel` int(11) NOT NULL DEFAULT 0,
  `OTP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`MemberID`, `Username`, `Password`, `Email`, `PrivilegeLevel`, `OTP`) VALUES
(1, 'admin', '$2y$10$zNm0pAQGWib65F96Jkt86u8HCux/ClBrRlEYLLz/tL4edTEPxNaAS', 'admin@gmail.com', 1, 0),
(2, 'nixon', '$2y$10$dY81kwdCdkiaZkSCuyWtQeIqdi1ddcqoXrbS3xiYscplnt/50FIy2', 'nixon@gmail.com', 0, 0),
(8, 'test123', '$2y$10$JCrci.8DtUUi3QBBenl/uu360mw7PFT3CFxG/b7SgOgnSiN26nwva', 'admin@gmail.com', 0, 0),
(9, 'maxwell', '$2y$10$lYNNdqzgJ9Pjn3CZ0w8DRO9AMM6gyJZ4WVR/GfLDsvmx5qw9csJ.2', 'admin@gmail.com', 0, 0),
(10, 'rover', '$2y$10$R8og8/eyhBZkRP2hxgib0eL/Zl1kVrJkeqEVfsOcgSJQdvS4HCAsm', 'rover@gmail.com', 0, 0),
(11, 'andrew', '$2y$10$vI5IHZTAv0OeZi1KaJTr7eOWjv6KVYpD0/vyHTg7Mgx6dM3ca.6Dy', 'andrew@gmail.com', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `OrderItemID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `Price` varchar(64) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `AddedDatetime` datetime NOT NULL,
  `Feedback` varchar(512) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`OrderItemID`, `OrderID`, `ItemID`, `Price`, `Quantity`, `AddedDatetime`, `Feedback`, `Rating`) VALUES
(22, 1, 7, '100.2', 2, '2021-11-11 18:48:41', 'Ok, but it is too bright!', 3),
(24, 1, 8, '305.2', 2, '2021-11-11 18:49:15', 'White dogs are the best!', 4),
(25, 1, 5, '18.2', 2, '2021-11-11 18:52:20', NULL, NULL),
(26, 1, 4, '20.1', 2, '2021-11-11 18:55:44', NULL, NULL),
(27, 1, 6, '50.3', 2, '2021-11-11 18:55:51', NULL, NULL),
(28, 1, 2, '200', 2, '2021-11-11 18:56:04', NULL, NULL),
(29, 1, 3, '100', 2, '2021-11-11 18:56:20', NULL, NULL),
(30, 4, 2, '200', 2, '2021-11-12 13:02:40', NULL, NULL),
(35, 2, 5, '18.2', 2, '2021-11-12 14:21:24', NULL, NULL),
(36, 2, 7, '100.2', 1, '2021-11-12 14:21:32', 'RGB is the best!', 5),
(37, 9, 3, '100', 1, '2021-11-12 18:35:09', 'Coco is cute but naughty.', 4),
(38, 5, 3, '100', 1, '2021-11-12 18:55:10', 'Coco is too innocent.', 5),
(40, 7, 6, '50.3', 1, '2021-11-12 18:57:35', 'This bed is too large, I can even sleep in it!\r\nMy dogs hates it really much!', 1),
(41, 12, 13, '10', 1, '2021-11-12 19:19:38', 'Super awesome leash, my dog likes it!', 4),
(42, 11, 3, '100', 1, '2021-11-12 19:31:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `CartFlag` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `MemberID`, `CartFlag`) VALUES
(1, 1, b'0'),
(2, 2, b'0'),
(3, 8, b'1'),
(4, 1, b'0'),
(5, 1, b'0'),
(6, 2, b'1'),
(7, 9, b'0'),
(8, 10, b'1'),
(9, 11, b'0'),
(10, 11, b'1'),
(11, 1, b'1'),
(12, 9, b'0'),
(13, 9, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `PaymentDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentID`, `OrderID`, `PaymentDate`) VALUES
(1, 1, '2021-11-11'),
(2, 4, '2021-11-12'),
(3, 2, '2021-11-12'),
(4, 9, '2021-11-12'),
(5, 5, '2021-11-12'),
(6, 7, '2021-11-12'),
(7, 12, '2021-11-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ItemID`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`MemberID`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`OrderItemID`),
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `ItemID` (`ItemID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `MemberID` (`MemberID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `OrderID` (`OrderID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `MemberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `OrderItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `orderitems_ibfk_2` FOREIGN KEY (`ItemID`) REFERENCES `items` (`ItemID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `members` (`MemberID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
