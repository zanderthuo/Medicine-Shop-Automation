-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 15, 2019 at 07:55 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Med`
--

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `product_id` int(11) NOT NULL,
  `batch_no` int(11) NOT NULL,
  `mfd` varchar(40) NOT NULL,
  `expd` varchar(40) NOT NULL,
  `mrp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`product_id`, `batch_no`, `mfd`, `expd`, `mrp`) VALUES
(0, 1, '1', '1', 1),
(1, 1, '2017-04-05', '2020-06-05', 25),
(1, 2, '2017-06-05', '2021-06-05', 27),
(1, 3, '2020-01-02', '2021-02-04', 10),
(1, 4, '2020-01-02', '2021-02-04', 10),
(1, 5, '2020-01-02', '2021-02-04', 10),
(1, 6, '2020-01-02', '2021-02-04', 10),
(2, 1, '2017-04-05', '2020-06-05', 120),
(3, 1, '2017-04-05', '2020-06-05', 25),
(4, 1, '2017-04-05', '2020-06-05', 30),
(5, 1, '2017-04-05', '2020-06-05', 65),
(6, 1, '2017-04-05', '2020-06-05', 500),
(7, 1, '2017-04-05', '2020-06-05', 99),
(8, 1, '2017-04-05', '2020-06-05', 100),
(10, 1, '2020-01-02', '2021-02-04', 10),
(10, 2, '2020-01-02', '2021-02-04', 10),
(10, 3, '2021-03-03', '2022-03-03', 5),
(10, 4, '2021-02-03', '2021-03-04', 8);

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `bill_id` int(11) NOT NULL,
  `shop_id` varchar(100) NOT NULL,
  `patient_id` varchar(100) NOT NULL,
  `date` varchar(20) NOT NULL,
  `total` int(11) NOT NULL,
  `paid` int(11) NOT NULL,
  `processed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`bill_id`, `shop_id`, `patient_id`, `date`, `total`, `paid`, `processed`) VALUES
(1, 'koshal_sk@gmail.com', 'patient1@gmail.com', '2018-04-12', 2550, 2550, 1),
(16, 'koshal_sk@gmail.com', 'patient2@gmail.com', '2018-04-12', 3198, 1222, 1),
(24, 'koshal_sk@gmail.com', 'patient2@gmail.com', '2018-04-12', 1000, 123, 1),
(26, 'koshal_sk@gmail.com', '', '2018-04-12', 0, 0, 0),
(27, 'koshal_sk@gmail.com', '', '2018-04-12', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bill_medicine`
--

CREATE TABLE `bill_medicine` (
  `id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `batch_no` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill_medicine`
--

INSERT INTO `bill_medicine` (`id`, `bill_id`, `product_id`, `batch_no`, `qty`) VALUES
(8, 1, 1, 1, 102),
(9, 16, 6, 1, 6),
(10, 16, 7, 1, 2),
(11, 24, 6, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `inn`
--

CREATE TABLE `inn` (
  `Id` int(11) NOT NULL,
  `meds` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inn`
--

INSERT INTO `inn` (`Id`, `meds`, `quantity`) VALUES
(1, 'Ketto', 30),
(2, 'Ketto', 30),
(3, 'Ketto', 30),
(4, 'Ketto', 30),
(5, 'Ketto', 78),
(6, 'Paracetemol', 78),
(7, 'Paracetemol', 78),
(8, 'Paracetemol', 78),
(9, 'Paracetemol', 78),
(10, 'Paracetemol', 78);

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `product_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `prices` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`product_id`, `name`, `prices`) VALUES
(1, 'Aceclofenac ', 0),
(2, 'BournVita', 0),
(3, 'Digene', 0),
(4, 'Flexon', 0),
(5, 'Gelucil', 0),
(6, 'Horlicks', 0),
(7, 'Ketto', 0),
(8, 'Lopex', 0),
(9, 'Paracentamol', 0),
(10, 'Aceclofenac 2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `NewPres`
--

CREATE TABLE `NewPres` (
  `Id` int(11) NOT NULL,
  `patientname` varchar(255) NOT NULL,
  `medicinename` varchar(255) NOT NULL,
  `dosage` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ordered_medicine`
--

CREATE TABLE `ordered_medicine` (
  `id` int(11) NOT NULL,
  `medicine_name` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordered_medicine`
--

INSERT INTO `ordered_medicine` (`id`, `medicine_name`, `product_id`, `qty`) VALUES
(1, '1', 1, 100),
(2, '1', 1, 30),
(3, '2', 1, 100),
(4, '2', 2, 10),
(5, '3', 3, 20),
(6, '4', 7, 2),
(7, '5', 7, 2),
(8, '6', 7, 2),
(9, '7', 7, 1),
(10, '8', 7, 2),
(11, '9', 7, 2),
(12, '10', 9, 10),
(13, '11', 7, 5),
(14, '12', 7, 5),
(15, '13', 7, 6),
(16, '14', 7, 5),
(17, '14', 9, 89),
(18, '15', 9, 40),
(19, '16', 9, 40),
(20, '17', 9, 45);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `shop_id` varchar(20) NOT NULL,
  `supplier_id` varchar(20) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `processed` int(11) NOT NULL DEFAULT 0,
  `confirmed` int(11) NOT NULL DEFAULT 0,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `shop_id`, `supplier_id`, `seen`, `processed`, `confirmed`, `date`) VALUES
(1, 'koshal_sk@gmail.com', 'koshal_s@gmail.com', 1, 1, 1, '2018-04-12'),
(2, 'koshal_sk@gmail.com', 'koshal_s@gmail.com', 1, 1, 1, '2018-04-12'),
(3, 'koshal_sk@gmail.com', '', 1, 0, 0, '2019-11-25'),
(4, 'dibya_sk@gmail.com', '', 1, 0, 0, '2019-11-25'),
(5, 'dibya_sk@gmail.com', '', 1, 0, 0, '2019-11-25'),
(6, 'dibya_sk@gmail.com', '', 1, 0, 0, '2019-11-25'),
(7, 'dibya_sk@gmail.com', 'test2@test.com', 1, 1, 1, '2019-11-25'),
(8, 'test11@test.com', 'test2@test.com', 1, 1, 0, '2019-11-25'),
(9, 'test11@test.com', 'test2@test.com', 1, 0, 0, '2019-11-25'),
(10, 'test3@gmail.com', 'joy@gmail.com', 1, 1, 1, '2019-11-30'),
(11, 'alex@gmail.com', 'test2@test.com', 1, 0, 0, '2019-12-12'),
(12, 'alex@gmail.com', 'test2@test.com', 1, 0, 0, '2019-12-12'),
(13, 'alex@gmail.com', 'test2@test.com', 1, 0, 0, '2019-12-12'),
(14, 'alex@gmail.com', 'test2@test.com', 1, 0, 0, '2019-12-12'),
(15, 'alex@gmail.com', 'test2@test.com', 1, 0, 0, '2019-12-12'),
(16, 'alex@gmail.com', 'test2@test.com', 1, 0, 0, '2019-12-12'),
(17, 'alex@gmail.com', 'test2@test.com', 1, 0, 0, '2019-12-13'),
(18, 'alex@gmail.com', '', 0, 0, 0, '2019-12-13'),
(19, 'alex@gmail.com', '', 0, 0, 0, '2019-12-13'),
(20, 'alex@gmail.com', 'test2@test.com', 1, 0, 0, '2019-12-13');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `pres_id` int(11) NOT NULL,
  `doctor_id` varchar(20) NOT NULL,
  `patient_id` varchar(20) NOT NULL,
  `shop_id` varchar(50) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `processed` int(11) NOT NULL DEFAULT 0,
  `bought` int(11) NOT NULL DEFAULT 0,
  `bill_id` int(11) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`pres_id`, `doctor_id`, `patient_id`, `shop_id`, `seen`, `processed`, `bought`, `bill_id`, `date`) VALUES
(1, 'doctor1@gmail.com', 'patient2@gmail.com', 'koshal_sk@gmail.com', 1, 1, 2, 9, '2018-04-12'),
(2, 'doctor1@gmail.com', '', '', 0, 0, 0, 0, '2018-04-12'),
(3, 'doctor1@gmail.com', 'patient2@gmail.com', 'koshal_sk@gmail.com', 1, 1, 1, 24, '2018-04-12'),
(4, 'doctor1@gmail.com', '', '', 0, 0, 0, 0, '2018-04-12');

-- --------------------------------------------------------

--
-- Table structure for table `pres_meds`
--

CREATE TABLE `pres_meds` (
  `id` int(11) NOT NULL,
  `pres_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pres_meds`
--

INSERT INTO `pres_meds` (`id`, `pres_id`, `product_id`, `quantity`) VALUES
(1, 1, 6, 7),
(2, 1, 7, 4),
(3, 3, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `shop_id` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `medicine_name` varchar(255) NOT NULL,
  `batch_no` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`shop_id`, `product_id`, `medicine_name`, `batch_no`, `quantity`) VALUES
('koshal_sk@gmail.com', 1, '', 1, 898),
('koshal_sk@gmail.com', 1, '', 2, 1000),
('koshal_sk@gmail.com', 3, '', 1, 1000),
('koshal_sk@gmail.com', 4, '', 1, 1000),
('koshal_sk@gmail.com', 5, '', 1, 1000),
('koshal_sk@gmail.com', 6, '', 1, 992),
('koshal_sk@gmail.com', 7, '', 1, 998),
('koshal_sk@gmail.com', 8, '', 1, 1000),
('koshal_sk@gmail.com', 1, '', 6, 930),
('koshal_sk@gmail.com', 2, '', 1, 80),
('dibya_sk@gmail.com', 7, '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(40) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `type` int(11) NOT NULL,
  `address` varchar(20) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `password`, `name`, `type`, `address`, `contact_no`, `date`) VALUES
(1, 'alex@gmail.com', '123456', 'Alex Alex', 1, 'Rourkela', '8339895678', '2018/04/05'),
(2, 'zanderzander@gmail.com', '123456', 'zander zander', 1, 'Rourkela', '9777511898', '2018/04/05'),
(3, 'peter@gmail.com', '123456', 'Peter', 2, 'bbsr', '955612100', '2017-12-22'),
(4, 'alexalex@gmail.com', '123456', 'Alex', 2, 'bbsr', '8795612100', '2017-08-16'),
(5, 'doctor1@gmail.com', '123456', 'doctor_one', 3, 'rourkela', '906832521', '2017-10-23'),
(6, 'doctor2@gmail.com', '123456', 'doctor_two', 3, 'rourkela', '906212521', '2017-12-04'),
(7, 'test2@test.com', '123456', 'zander zander', 4, 'Rourkela', '8339895678', '2018/04/08'),
(8, 'zander@gmail.com', '123456', 'zander', 1, 'JHARBANDH, COLLEGE R', '8339895678', '2018/04/12'),
(9, 'test@test.com', '12345', 'Lex', 1, 'buru', '+254719808225', '2019/10/02'),
(10, '', '', '', 0, '', '', '2019/10/02'),
(11, '', '', '', 0, '', '', '2019/10/02'),
(12, '', '', '', 0, '', '', '2019/10/02'),
(13, '', '', '', 0, '', '', '2019/10/28'),
(14, '', '', '', 0, '', '', '2019/10/28'),
(15, '', '', '', 0, '', '', '2019/10/28'),
(16, 'test@test.com', '123456789', 'John Doe', 3, 'buruburu', '789789567', '2019/11/02'),
(17, 'lex@test.com', '123456', 'Ale', 1, 'kericho', '123456789', '2019/11/02'),
(18, 'j@test.com', '123456', 'Johnny', 2, 'ruiru', '00000000', '2019/11/02'),
(19, 'jake@test.com', '123456', 'Jake', 1, 'kiserian', '00000000', '2019/11/03'),
(20, 'test11@test.com', '123456abc', 'zandzander', 1, 'Nairobi', '0710000000', '2019/11/25'),
(21, 'steve@gmail.com', '123456', 'Steve', 2, 'buru', '0790000000', '2019/11/29'),
(22, 'mwojeffren100@gmail.com', '123456', 'jeff', 2, '23340-00100', '070400000', '2019/11/29'),
(23, 'test3@gmail.com', '123456', 'Moses', 1, 'juja', '0700000000', '2019/11/30'),
(24, 'joy@gmail.com', '123456', 'Joy', 4, 'juja', '07001234556', '2019/11/30'),
(25, 'maggy@gmail.com', '123456', 'Maggy', 3, 'juja', '0701010101', '2019/11/30'),
(26, 'martin@gmail.com', '123456', 'Martin', 2, 'juja', '0800000000', '2019/11/30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`product_id`,`batch_no`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `bill_medicine`
--
ALTER TABLE `bill_medicine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inn`
--
ALTER TABLE `inn`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `NewPres`
--
ALTER TABLE `NewPres`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `ordered_medicine`
--
ALTER TABLE `ordered_medicine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`pres_id`);

--
-- Indexes for table `pres_meds`
--
ALTER TABLE `pres_meds`
  ADD PRIMARY KEY (`id`,`pres_id`,`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `bill_medicine`
--
ALTER TABLE `bill_medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `inn`
--
ALTER TABLE `inn`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `NewPres`
--
ALTER TABLE `NewPres`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ordered_medicine`
--
ALTER TABLE `ordered_medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `pres_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pres_meds`
--
ALTER TABLE `pres_meds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
