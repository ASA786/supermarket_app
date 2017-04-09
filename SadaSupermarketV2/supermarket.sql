-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 09, 2017 at 11:37 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `points` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `username`, `email`, `password`, `points`) VALUES
(1, 'test_user', 'test@user.com', '$2y$10$IrzYJi10j3Jy/K6jzSLQtOLif1wEZqTRQoK3DcS3jdnFEhL4fWM4G', 512),
(2, 'test', 'test@test.com', '1afaff1707c403382548d0c0a0b5690c', 0),
(3, 'testuser', 'testuser@test.com', '1afaff1707c403382548d0c0a0b5690c', 0),
(4, 'test2', 'test2@test.com', '098f6bcd4621d373cade4e832627b4f6', 0),
(5, 'test3', 'test3@test.com', '098f6bcd4621d373cade4e832627b4f6', 0),
(6, 'test5', 'test5@test.com', '098f6bcd4621d373cade4e832627b4f6', 10),
(7, 'test10', 'test10@test.com', '1afaff1707c403382548d0c0a0b5690c', 0),
(8, 'test11', 'test11@test.com', '1afaff1707c403382548d0c0a0b5690c', 0);

-- --------------------------------------------------------

--
-- Table structure for table `loyalty`
--

CREATE TABLE `loyalty` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `product_desc` text NOT NULL,
  `cate` varchar(250) NOT NULL,
  `code` varchar(5) NOT NULL,
  `image` varchar(250) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `product_desc`, `cate`, `code`, `image`, `price`) VALUES
(1, 'Apple', '', '1', 'AP1', 'apple.jpeg', 1),
(2, 'Banana', '', '1', 'BN1', 'banana.jpeg', 0.9),
(3, 'Cherries', '', '1', 'CH1', 'cherries.jpeg', 2),
(4, 'Grapefruit', '', '6', 'GF1', 'grapefruit.jpeg', 1),
(5, 'Grapes', '', '1', 'GR1', 'grapes.jpeg', 1.95),
(6, 'Mango', '', '1', 'MA1', 'mango.jpeg', 1.8),
(7, 'Orange', '', '1', 'OR1', 'orange.jpeg', 1.25),
(8, 'Pear', '', '1', 'PE1', 'pear.jpeg', 1),
(9, 'Pineapple', '', '1', 'PI1', 'pineapple.jpeg', 1),
(10, 'Strawberries', '', '1', 'ST1', 'strawberries.jpeg', 1.5),
(11, 'Watermelon', '', '1', 'WA1', 'watermelon.jpeg', 3),
(12, 'Asparagus', '', '2', 'AS2', 'Asparagus.jpeg', 2),
(13, 'Broccoli', '', '2', 'BR2', 'Broccoli.jpeg', 0.79),
(14, 'Carrot', '', '2', 'CA2', 'Carrot.jpeg', 0.6),
(15, 'Garlic', '', '2', 'GA2', 'Garlic.jpeg', 0.2),
(16, 'Mushrooms', '', '2', 'MU2', 'Mushrooms.jpeg', 1.15),
(17, 'Onions', '', '2', 'ON2', 'Onions.jpeg', 0.75),
(18, 'Peas', '', '2', 'PE2', 'Peas.jpeg', 1),
(19, 'Potatoes', '', '2', 'PO2', 'Potatoes.jpeg', 1),
(20, 'Redpepper', '', '2', 'RE2', 'Redpepper.jpeg', 0.6),
(21, 'Sweetcorn', '', '2', 'SW2', 'Sweetcorn.jpeg', 2),
(22, 'Bacon', '', '3', 'BA3', 'Bacon.jpeg', 2.5),
(23, 'Bassfillets', '', '3', 'BF3', 'Bassfillets.jpeg', 3.5),
(24, 'BeefMince', '', '3', 'BM3', 'BeefMince.jpeg', 4),
(25, 'BeefSteak ', '', '3', 'BS3', 'BeefSteak.jpeg', 5.5),
(26, 'PorkSteak', '', '3', 'PS3', 'PorkSteak.jpeg', 4.2),
(27, 'ChickenBreast', '', '3', 'CB3', 'ChickenBreast.jpeg', 1.75),
(28, 'DuckLeg', '', '3', 'DL3', 'DuckLeg.jpeg', 3),
(29, 'Sausages', '', '3', 'SA3', 'Sausages.jpeg', 2),
(30, 'DicedLamb', '', '3', 'DL33', 'Diced-Lamb.jpeg', 4.6),
(31, 'PorkChops', '', '3', 'PC3', 'PorkChops.jpeg', 3.3),
(32, 'SalmonFillets', '', '3', 'SF3', 'SalmonFillets.jpeg', 6.6),
(33, 'ChickenWings', '', '3', 'CW3', 'ChickenWings.jpeg', 3.3),
(34, 'Rohu', '', '4', 'RO4', 'Rohu.jpeg', 5),
(35, 'Tilapia-Fillet', '', '4', 'TI4', 'Tilapia-Fillet.jpeg', 4.5),
(36, 'Salmon', '', '4', 'SA4', 'Salmon.jpeg', 11),
(37, 'Cod-Fillets', '', '4', 'CO4', 'Cod-Fillets.jpeg', 6),
(38, 'Catfish', '', '4', 'CA4', 'Catfish.jpeg', 7.5),
(39, 'Snapper', '', '4', 'SN4', 'Snapper.jpeg', 6.8),
(40, 'Crab', '', '4', 'CR4', 'Crab.jpeg', 7),
(41, 'Jellied-Eels', '', '4', 'JE4', 'Jellied-Eels.jpeg', 6.2),
(42, 'Lobster', '', '4', 'LO4', 'Lobster.jpeg', 9),
(43, 'Octopus', '', '4', 'OC4', 'Octopus.jpeg', 8.5),
(44, 'Squid', '', '4', 'SQ4', 'Squid.jpeg', 10),
(45, 'AlmondCroissant', '', '5', 'AC5', 'almondCroissant.jpeg', 1.3),
(46, 'Scone', '', '5', 'SC5', 'scone.jpeg', 1),
(47, 'Doughnuts', '', '5', 'DO5', 'doughnuts.jpeg', 1.2),
(48, 'WalnutPastry', '', '5', 'WP5', 'walnutPastry.jpeg', 2),
(49, 'Brownie', '', '5', 'BR5', 'brownie.jpeg', 1.1),
(50, 'SwissRoll', '', '5', 'SW5', 'swissRoll.jpeg', 2.1),
(51, 'CreamCake', '', '5', 'CC5', 'creamCake.jpeg', 3),
(52, 'WhiteRolls', '', '5', 'WR5', 'whiterolls.jpeg', 1.1),
(53, 'Crumpets', '', '5', 'CP5', 'crumpets.jpeg', 2.4),
(54, 'CustardSlice', '', '5', 'CS5', 'custardslice.jpeg', 2.5),
(55, 'Coke', '', '6', 'CK6', 'coke.jpeg', 1),
(56, 'Fanta', '', '6', 'FN6', 'fanta.jpeg', 1.2),
(57, 'Sprite', '', '6', 'SP6', 'sprite.jpeg', 1.27),
(58, 'Redbull', '', '6', 'RB6', 'redbull.jpeg', 2),
(59, 'Nurishment Chocolate', '', '6', 'NM6', 'nurish-choc.jpeg', 1.35),
(60, 'Nurishment Vanilla', '', '6', 'NM7', 'nurish-vanilla.jpeg', 1.35),
(61, 'Nurishment Strawberry', '', '6', 'NM8', 'nurish-strawberry.jpeg', 1.35),
(62, 'Lucozade', '', '6', 'LZ6', 'lucozade.jpeg', 1.5),
(63, 'J2o', '', '6', 'J26', 'j2o.jpeg', 1.35),
(64, 'Freeway', '', '6', 'FW6', 'freeway.jpeg', 0.35),
(65, 'Slow Cooker', '', '7', 'SL7', 'George.jpeg', 10),
(66, 'Logitech Deskset', '', '7', 'LD7', 'Logitechk.jpeg', 20),
(67, 'Wireless Mouse', '', '7', 'WM7', 'Logitech.jpeg', 12.5),
(68, 'Beard Trimmer', '', '7', 'BT7', 'Philips.jpeg', 74.96),
(69, 'Phillips Headphones', '', '7', 'PH7', 'Phillips.jpeg', 30),
(70, 'iPhone Charge Cable', '', '7', 'IC7', 'Polaroid.jpeg', 10),
(71, 'PS4 Slim', '', '7', 'PS7', 'PS4.jpeg', 259),
(72, 'Toaster', '', '7', 'TO7', 'Russell.jpeg', 35),
(73, 'Samsung Tab', '', '7', 'SM7', 'Samsung.jpeg', 159),
(74, 'Sandisk', '', '7', 'SL8', 'Sandisk.jpeg', 10),
(75, 'LEGO City Fire Ladder', '', '8', 'LC8', 'LEGOCityFireLadder.jpeg', 17.97),
(76, 'Bathtime Fun', '', '8', 'BF8', 'LittleTikesBathtime.jpeg', 10),
(77, 'Little Tikes Hammer', '', '8', 'LH8', 'LittleTikesHammer.jpeg', 6),
(78, 'Little Tikes Sunny Funflower', '', '8', 'LF8', 'LittleTikes.jpeg', 8),
(79, 'Baby In Car', '', '8', 'BC8', 'MySweetBaby.jpeg', 10),
(80, 'NERF N-strike', '', '8', 'NS8', 'NERF.jpeg', 10),
(81, 'Racing Car', '', '8', 'RC8', 'Remote.jpeg', 60),
(82, 'Dipsy', '', '8', 'DI8', 'Teletubbies.jpeg', 10),
(83, 'Van Caravan', '', '8', 'VC8', 'Van.jpeg', 10),
(84, 'X Shot Zombie', '', '8', 'XS8', 'XShot.jpeg', 10),
(85, 'Andrex Moist Toilet Tissue', '', '9', 'AN9', 'AndrexWashletsClassic.jpeg', 1.5),
(86, 'Decorative Antique GLS Light Bulb', '', '9', 'DE9', 'CrystaliteDecorative.jpeg', 3),
(87, 'Cotton Bath Towel', '', '9', 'CO9', 'GeorgeHome1.jpeg', 4),
(88, 'Photo Frame', '', '9', 'PH9', 'GeorgeHomeBaroque.jpeg', 2.5),
(89, 'Table Lamp', '', '9', 'TA9', 'GeorgeHomeCream.jpeg', 5),
(90, 'Bed Duvet Set', '', '9', 'BE9', 'GeorgeHomeGrey.jpeg', 25),
(91, 'Photo Album', '', '9', 'PH10', 'GeorgeHomeMoments.jpeg', 4),
(92, 'Hollowfibre Pillows', '', '9', 'HO9', 'GeorgeHomeSoftComfort.jpeg', 6),
(93, 'White Toilet Brush', '', '9', 'WH9', 'GeorgeHomeWhiteToiletBrush.jpeg', 2),
(94, 'Grand Alarm Clock', '', '9', 'GR9', 'JonesGrandAlarm.jpeg', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loyalty`
--
ALTER TABLE `loyalty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code_2` (`code`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `code` (`code`),
  ADD KEY `code_3` (`code`),
  ADD KEY `id_2` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `loyalty`
--
ALTER TABLE `loyalty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=95;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
