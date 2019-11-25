-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2018 at 09:03 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `msa`
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
  `processed` int(11) NOT NULL DEFAULT '0'
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
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `product_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`product_id`, `name`) VALUES
(1, 'Aceclofenac '),
(2, 'BournVita'),
(3, 'Digene'),
(4, 'Flexon'),
(5, 'Gelucil'),
(6, 'Horlicks'),
(7, 'Ketto'),
(8, 'Lopex'),
(9, 'Paracentamol'),
(10, 'Aceclofenac 2');

-- --------------------------------------------------------

--
-- Table structure for table `ordered_medicine`
--

CREATE TABLE `ordered_medicine` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordered_medicine`
--

INSERT INTO `ordered_medicine` (`id`, `order_id`, `product_id`, `qty`) VALUES
(1, 1, 1, 100),
(2, 1, 1, 30),
(3, 2, 1, 100),
(4, 2, 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `shop_id` varchar(20) NOT NULL,
  `supplier_id` varchar(20) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT '0',
  `processed` int(11) NOT NULL DEFAULT '0',
  `confirmed` int(11) NOT NULL DEFAULT '0',
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `shop_id`, `supplier_id`, `seen`, `processed`, `confirmed`, `date`) VALUES
(1, 'koshal_sk@gmail.com', 'koshal_s@gmail.com', 1, 1, 1, '2018-04-12'),
(2, 'koshal_sk@gmail.com', 'koshal_s@gmail.com', 1, 1, 1, '2018-04-12');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `pres_id` int(11) NOT NULL,
  `doctor_id` varchar(20) NOT NULL,
  `patient_id` varchar(20) NOT NULL,
  `shop_id` varchar(50) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT '0',
  `processed` int(11) NOT NULL DEFAULT '0',
  `bought` int(11) NOT NULL DEFAULT '0',
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
  `batch_no` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`shop_id`, `product_id`, `batch_no`, `quantity`) VALUES
('koshal_sk@gmail.com', 1, 1, 898),
('koshal_sk@gmail.com', 1, 2, 1000),
('koshal_sk@gmail.com', 3, 1, 1000),
('koshal_sk@gmail.com', 4, 1, 1000),
('koshal_sk@gmail.com', 5, 1, 1000),
('koshal_sk@gmail.com', 6, 1, 992),
('koshal_sk@gmail.com', 7, 1, 998),
('koshal_sk@gmail.com', 8, 1, 1000),
('koshal_sk@gmail.com', 1, 6, 930),
('koshal_sk@gmail.com', 2, 1, 80);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` varchar(40) NOT NULL AUTO_INCREMENT,
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
(1, 'koshal_sk@gmail.com', '123456', 'Koshal Garg', 1, 'Rourkela', '8339895678', '2018/04/05'),
(2, 'dibya_sk@gmail.com', '123456', 'Dibya Ranjan Mishra', 1, 'Rourkela', '9777511898', '2018/04/05'),
(3, 'patient1@gmail.com', '123456', 'Patient One', 2, 'bbsr', '955612100', '2017-12-22'),
(4, 'patient2@gmail.com', '123456', 'Patient Two', 2, 'bbsr', '8795612100', '2017-08-16'),
(5, 'doctor1@gmail.com', '123456', 'doctor_one', 3, 'rourkela', '906832521', '2017-10-23'),
(6, 'doctor2@gmail.com', '123456', 'doctor_two', 3, 'rourkela', '906212521', '2017-12-04'),
(7, 'koshal_s@gmail.com', '123456', 'Koshal Kumar Garg', 4, 'Rourkela', '8339895678', '2018/04/08'),
(8, 'koshal.kkg1996@gmail.com', '123456', 'KAILASH KUMAR GARG', 1, 'JHARBANDH, COLLEGE R', '8339895678', '2018/04/12');

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
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`product_id`);

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
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `ordered_medicine`
--
ALTER TABLE `ordered_medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
