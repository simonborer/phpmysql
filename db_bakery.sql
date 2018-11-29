-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2018 at 09:01 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bakery`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_bakery_locations` (IN `location_id_param` INT, IN `location_name_param` VARCHAR(100), IN `address_param` VARCHAR(100))  BEGIN
  INSERT INTO bakery (bakery_id, bakery_name , bakery_address) 
  VALUES (location_id_param,  location_name_param, address_param); 
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bakery`
--

CREATE TABLE `bakery` (
  `BAKERY_ID` int(11) NOT NULL,
  `BAKERY_NAME` varchar(100) DEFAULT NULL,
  `BAKERY_ADDRESS` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bakery`
--

INSERT INTO `bakery` (`BAKERY_ID`, `BAKERY_NAME`, `BAKERY_ADDRESS`) VALUES
(1, 'Delectable Doughbreads Done Dirt Cheap BW', '123 Bloor West'),
(2, 'Delectable Doughbreads Done Dirt Cheap Dufferin', '456 Dufferin Street'),
(3, 'Delectable Doughbreads Done Dirt Cheap Parkdale', '789 Parkdale');

-- --------------------------------------------------------

--
-- Table structure for table `bakery_transactions`
--

CREATE TABLE `bakery_transactions` (
  `TRANSACTION_ID` int(11) NOT NULL,
  `BAKERY_ID` int(11) DEFAULT NULL,
  `ITEM_ID` int(11) DEFAULT NULL,
  `ITEM_QTY` decimal(5,0) DEFAULT NULL,
  `TRANSACTION_DATE` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EMPLOYEE_ID` int(11) NOT NULL,
  `BAKERY_ID` int(11) NOT NULL DEFAULT '1',
  `EMPLOYEE_FIRST_NAME` varchar(30) NOT NULL,
  `EMPLOYEE_LAST_NAME` varchar(30) NOT NULL,
  `EMPLOYEE_TYPE_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EMPLOYEE_ID`, `BAKERY_ID`, `EMPLOYEE_FIRST_NAME`, `EMPLOYEE_LAST_NAME`, `EMPLOYEE_TYPE_ID`) VALUES
(1, 1, 'Clayton', 'Bigsby', 1),
(2, 1, 'Rick', 'James', 1),
(3, 1, 'Tyrone', 'Biggums', 1),
(4, 1, 'Tron', 'Carter', 2),
(5, 1, 'Chuck', 'Taylor', 2),
(6, 1, 'Leonard', 'Washington', 2);

-- --------------------------------------------------------

--
-- Table structure for table `employee_shift`
--

CREATE TABLE `employee_shift` (
  `SHIFT_ID` int(11) NOT NULL,
  `EMPLOYEE_ID` int(11) DEFAULT NULL,
  `BAKERY_ID` int(11) DEFAULT NULL,
  `SHIFT_START_DAY` date DEFAULT NULL,
  `SHIFT_END_DAY` date DEFAULT NULL,
  `SHIFT_START_TIME` datetime DEFAULT NULL,
  `SHIFT_END_TIME` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_shift`
--

INSERT INTO `employee_shift` (`SHIFT_ID`, `EMPLOYEE_ID`, `BAKERY_ID`, `SHIFT_START_DAY`, `SHIFT_END_DAY`, `SHIFT_START_TIME`, `SHIFT_END_TIME`) VALUES
(1, 1, 1, '2018-11-29', '2018-11-29', '2018-11-29 07:00:00', '2018-11-29 15:00:00'),
(2, 2, 1, '2018-11-29', '2018-11-29', '2018-11-29 10:00:00', '2018-11-29 18:00:00'),
(3, 5, 2, '2018-11-29', '2018-11-29', '2018-11-29 10:00:00', '2018-11-29 18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `employee_type`
--

CREATE TABLE `employee_type` (
  `EMPLOYEE_TYPE_ID` int(11) NOT NULL,
  `EMPLOYEE_DESCRIPTION` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_type`
--

INSERT INTO `employee_type` (`EMPLOYEE_TYPE_ID`, `EMPLOYEE_DESCRIPTION`) VALUES
(1, 'BAKER'),
(2, 'CASHIER');

-- --------------------------------------------------------

--
-- Table structure for table `item_discounts`
--

CREATE TABLE `item_discounts` (
  `discount_id` int(11) NOT NULL,
  `discount_description` varchar(20) NOT NULL,
  `discount_amt` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `MENU_ID` int(11) NOT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `ITEM_ID` int(11) DEFAULT NULL,
  `MENU_WEEK_START` date DEFAULT NULL,
  `MENU_WEEK_END` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_items`
--

CREATE TABLE `product_items` (
  `ITEM_ID` int(11) NOT NULL,
  `ITEM_DESCRIPTION` varchar(30) DEFAULT NULL,
  `ITEM_TYPE` varchar(10) DEFAULT NULL,
  `ITEM_PRICE` decimal(5,2) DEFAULT NULL,
  `PRODUCTION_INGREDIENTS` varchar(100) DEFAULT NULL,
  `PRODUCTION_COST` decimal(9,2) NOT NULL,
  `PRODUCTION_TIME` int(2) NOT NULL,
  `PRODUCTION_QTY` int(5) NOT NULL,
  `OVEN_SPACE` decimal(2,0) DEFAULT NULL,
  `NUM_OF_BATCHES` decimal(5,0) DEFAULT '1',
  `PRODUCTION_TEMP` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `weekly_schedule`
-- (See below for the actual view)
--
CREATE TABLE `weekly_schedule` (
`name` varchar(61)
,`shift_start_day` date
,`start_time` varchar(13)
,`end_time` varchar(13)
,`bakery_address` varchar(100)
,`employee_description` varchar(30)
);

-- --------------------------------------------------------

--
-- Structure for view `weekly_schedule`
--
DROP TABLE IF EXISTS `weekly_schedule`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `weekly_schedule`  AS  select concat(`z`.`EMPLOYEE_FIRST_NAME`,' ',`z`.`EMPLOYEE_LAST_NAME`) AS `name`,`y`.`SHIFT_START_DAY` AS `shift_start_day`,date_format(`y`.`SHIFT_START_TIME`,'%H:%i:%s') AS `start_time`,date_format(`y`.`SHIFT_END_TIME`,'%H:%i:%s') AS `end_time`,`x`.`BAKERY_ADDRESS` AS `bakery_address`,`e`.`EMPLOYEE_DESCRIPTION` AS `employee_description` from (((`bakery` `x` join `employee_shift` `y` on((`x`.`BAKERY_ID` = `y`.`BAKERY_ID`))) join `employee` `z` on((`y`.`EMPLOYEE_ID` = `z`.`EMPLOYEE_ID`))) join `employee_type` `e` on((`z`.`EMPLOYEE_TYPE_ID` = `e`.`EMPLOYEE_TYPE_ID`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bakery`
--
ALTER TABLE `bakery`
  ADD PRIMARY KEY (`BAKERY_ID`);

--
-- Indexes for table `bakery_transactions`
--
ALTER TABLE `bakery_transactions`
  ADD PRIMARY KEY (`TRANSACTION_ID`),
  ADD KEY `trans_bakery_id_fk` (`BAKERY_ID`),
  ADD KEY `trans_item_id_fk` (`ITEM_ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EMPLOYEE_ID`),
  ADD KEY `employee_type_id_fk` (`EMPLOYEE_TYPE_ID`),
  ADD KEY `BAKERY_ID` (`BAKERY_ID`);

--
-- Indexes for table `employee_shift`
--
ALTER TABLE `employee_shift`
  ADD PRIMARY KEY (`SHIFT_ID`),
  ADD KEY `employee_shift_emp_id_fk` (`EMPLOYEE_ID`);

--
-- Indexes for table `employee_type`
--
ALTER TABLE `employee_type`
  ADD PRIMARY KEY (`EMPLOYEE_TYPE_ID`);

--
-- Indexes for table `item_discounts`
--
ALTER TABLE `item_discounts`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`MENU_ID`),
  ADD KEY `menu_discount_id_fk` (`discount_id`),
  ADD KEY `menu_item_id_fk` (`ITEM_ID`);

--
-- Indexes for table `product_items`
--
ALTER TABLE `product_items`
  ADD PRIMARY KEY (`ITEM_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee_shift`
--
ALTER TABLE `employee_shift`
  MODIFY `SHIFT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bakery_transactions`
--
ALTER TABLE `bakery_transactions`
  ADD CONSTRAINT `trans_bakery_id_fk` FOREIGN KEY (`BAKERY_ID`) REFERENCES `bakery` (`BAKERY_ID`),
  ADD CONSTRAINT `trans_item_id_fk` FOREIGN KEY (`ITEM_ID`) REFERENCES `product_items` (`ITEM_ID`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_type_id_fk` FOREIGN KEY (`EMPLOYEE_TYPE_ID`) REFERENCES `employee_type` (`EMPLOYEE_TYPE_ID`);

--
-- Constraints for table `employee_shift`
--
ALTER TABLE `employee_shift`
  ADD CONSTRAINT `employee_shift_emp_id_fk` FOREIGN KEY (`EMPLOYEE_ID`) REFERENCES `employee` (`EMPLOYEE_ID`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_discount_id_fk` FOREIGN KEY (`discount_id`) REFERENCES `item_discounts` (`discount_id`),
  ADD CONSTRAINT `menu_item_id_fk` FOREIGN KEY (`ITEM_ID`) REFERENCES `product_items` (`ITEM_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
