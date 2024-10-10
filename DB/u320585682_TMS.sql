-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 01, 2024 at 03:10 PM
-- Server version: 10.11.8-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u320585682_TMS`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(20) NOT NULL,
  `hub` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `name`, `address`, `contact`, `email`, `password`, `hub`, `role`) VALUES
(26, 'Admin', 'Lipa City, Batangas', '09337815782', 'cristianolivadeluna2001@gmail.com', 'crcadmin', 'Admin', 'Admin'),
(28, 'Chiara Recio', 'kinalaglagan', '09337815782', 'reciochiarayvonne@gmail.com', 'recio', 'Batangas', 'Staff'),
(29, 'Ryan', 'Lipa City, Batangas', '09278441417', 'castroryan715@gmail.com', 'ryancastro', 'Batangas', 'Rider'),
(30, 'Yvonne', 'mataasnakahoy', '09653875864', 'reciochiarayvonneo@gmail.com', 'yvonne', 'Calamba', 'Staff'),
(31, 'Joyce Amazona', 'Mataas na Kahoy', '09278441417', 'ninajoyceamazona0120@gmail.com', 'ninaamazona', 'Makati', 'Staff'),
(32, 'Rovic Atienza', 'San Juan', '09848530075', 'atienzarovic59@gmail.com', 'rovic59', 'Pasay', 'Staff'),
(33, 'Kyla ', 'San Jose', '09539864027', 'delunakylamareis17@gmail.com', 'kyladeluna', 'Calamba', 'Rider'),
(34, 'Mareis Oliva', 'Rizal', '09539864027', 'kylamareisolivadeluna@gmail.com', 'oliva', 'Makati', 'Rider'),
(35, 'Charles De Luna', 'Bagong Katipunan', '09278441417', 'charlesdeluna2019@gmail.com', 'charles', 'Pasay', 'Rider');

-- --------------------------------------------------------

--
-- Table structure for table `manifests`
--

CREATE TABLE `manifests` (
  `id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `awbnumber` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `hub` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `contact` int(20) NOT NULL,
  `seller` varchar(255) NOT NULL,
  `weight` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `rider_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manifests`
--

INSERT INTO `manifests` (`id`, `product_id`, `awbnumber`, `customer_name`, `hub`, `address`, `contact`, `seller`, `weight`, `size`, `price`, `datetime`, `status`, `image`, `rider_name`) VALUES
(13, ' P00100', 'AWB00100', 'JOSE', 'Batangas', ' Lipa City, San Jose, Purok 4, House No. 23', 2147483647, 'Jonathan', '45kg', '24x5x5', 300.00, '2024-08-17 19:30:47', 'Assigned', '', 'rider1'),
(14, ' P00101', 'AWB00101', 'Ariel', 'Pasay ', 'Barangay 185/zone 19', 2147483647, 'Nina', '32kg', '21x2x2', 200.00, '2024-08-17 08:56:02', 'Arrived at Warehouse', '', 'rider4'),
(15, ' P00102', 'AWB00102', 'Myrna', 'Makati', 'Ayala-Paseo De Roxas', 2147483647, 'Jayr', '5kg', '2x2x2', 40.00, '2024-08-17 08:56:11', 'Arrived at Warehouse', '', 'rider3'),
(16, ' P00103', 'AWB00103', 'Lyka', 'Calamba', 'Old Municipal Site, Belarmino St., Brgy. 7', 2147483647, 'Hedrica', '30kg', '32x5x5', 156.00, '2024-08-17 08:56:17', 'Arrived at Warehouse', '', 'rider2'),
(17, ' P00104', 'AWB00104', 'Joanne', 'Batangas', ' Mataasnakhoy, Santol , Purok 3 ', 2147483647, 'Joshua', '6kg', '4x4x2', 29.00, '2024-08-24 02:16:24', 'Assigned', '', 'raider5'),
(18, ' P00105', 'AWB00105', 'Arjay', 'Pasay ', 'Barangay 146 Zone 16 Don Carlos Rivilla St.', 2147483647, 'Brix', '16kg', '10x3x4', 85.00, '2024-08-17 08:56:32', 'Arrived at Warehouse', '', 'rider4'),
(19, ' P00106', 'AWB00106', 'Janice', 'Calamba', 'Camp Vicente Lim, Mayapa', 2147483647, 'Jeanie', '4kg', '2x2x4', 30.00, '2024-08-17 08:56:42', 'Arrived at Warehouse', '', 'rider2'),
(20, ' P00107', 'AWB00107', 'Patrick', 'Makati', '14th Ave', 1924018309, 'Rowell', '5kg', '4x2x4', 70.00, '2024-08-17 08:56:48', 'Arrived at Warehouse', '', 'rider3'),
(21, ' P00108', 'AWB00108', 'Pepito', 'Batangas', ' Mataasnakhoy, Kinalaglagan, Purok 5, House No. 54', 2147483647, 'Cristian', '32kg', '3x4x3', 400.00, '2024-08-17 08:32:06', 'Arrived at Warehouse', '', 'rider1'),
(22, ' P00109', 'AWB00109', 'Alyza', 'Pasay ', 'BARANGAY 197 - Zone 20 Naia', 2147483647, 'Angela', '15kg', '4x3x5', 175.00, '2024-08-01 13:49:02', 'Arrived at Warehouse', '', ''),
(23, ' P00110', 'AWB00110', 'Finizz', 'Makati', 'Aguila St', 2147483647, 'Kristine', '29kg', '23x4x3', 325.00, '2024-08-01 13:49:12', 'Arrived at Warehouse', '', ''),
(24, ' P00111', 'AWB00111', 'Justine', 'Calamba', 'Carmelray Industrial Park I, Carmeltown, Brgy. Canlubang', 2147483647, 'Camille', '43kg', '30x4x4', 764.00, '2024-08-01 13:49:24', 'Arrived at Warehouse', '', ''),
(25, 'P00112', 'AWB00112', 'kath', 'Batangas', 'Lipa City, Latag, purok 3', 2147483647, 'Juan', '55kg', '12x5x23', 500.00, '2024-08-17 08:32:15', 'Arrived at Warehouse', '', 'rider1'),
(26, 'P00113', 'AWB00113', 'chiara', 'Makati', 'Bel-air', 2147483647, 'Mark', '23kg', '3x5x9', 259.00, '0000-00-00 00:00:00', 'Arrived at Warehouse', '', ''),
(27, 'P00114', 'AWB00114', 'jen', 'Pasay', 'Barangay 137', 2147483647, 'Patrick', '19kg', '7x9x4', 164.00, '0000-00-00 00:00:00', 'Arrived at Warehouse', '', ''),
(28, 'P00115', 'AWB00115', 'mon', 'Calamba', 'Puting Lupa', 2147483647, 'Jerome', '38kg', '23x12x9', 499.00, '0000-00-00 00:00:00', 'Arrived at Warehouse', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `manifest_id` int(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `remittance`
--

CREATE TABLE `remittance` (
  `id` int(11) NOT NULL,
  `hub` varchar(50) NOT NULL,
  `rider_name` varchar(200) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `manifests`
--
ALTER TABLE `manifests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `remittance`
--
ALTER TABLE `remittance`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `manifests`
--
ALTER TABLE `manifests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `remittance`
--
ALTER TABLE `remittance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
