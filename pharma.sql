-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2021 at 05:11 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharma`
--

-- --------------------------------------------------------

--
-- Table structure for table `chemicals`
--

CREATE TABLE `chemicals` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `qty` double NOT NULL DEFAULT 0,
  `rate` double NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chemicals`
--

INSERT INTO `chemicals` (`id`, `name`, `qty`, `rate`, `image`) VALUES
(10, 'Potassium Sorbate', 0, 300, '50c31507eb275386e31344f5b99304cc.gif'),
(11, 'Stearic Acid', 0, 78, 'da0535356c00953dde1fda6dff34fa70.png'),
(12, 'Providone', 0, 52, '9b0eedffb770d43f7b97a2ef7f0e12e3.png'),
(13, 'Starch', 0, 35, '3013d09bd8288547f6118fa7e6c54fb3.png'),
(14, 'Phenoxymethylpenicillin ', 0, 800, 'd15ecee4395f6432e3689fff78d79a09.png'),
(15, 'Metronidazole', 0, 700, 'f8911e67c48f4b4ef861347428366a1b.png'),
(16, 'Disodium Edetate', 0, 1068, 'beedbba2002bc760dbbf459025c3cbd4.png');

-- --------------------------------------------------------

--
-- Table structure for table `composition`
--

CREATE TABLE `composition` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `c_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customertransactions`
--

CREATE TABLE `customertransactions` (
  `id` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `price` float NOT NULL DEFAULT 0,
  `forSale` tinyint(1) NOT NULL DEFAULT 0,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `qty`, `price`, `forSale`, `image`) VALUES
(1, 'Paracetamol', 0, 0, 0, 'e90512ca9230da03e5231e5f0ebc623a.jpg'),
(3, 'Penicillin', 0, 0, 0, '05a35517f51b01132c03310b85df6c9b.jpg'),
(4, 'Metrogyl', 0, 0, 0, '24c6334633edc9f183239c3ccc49a37b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` int(11) NOT NULL,
  `password` int(11) NOT NULL,
  `type` enum('admin','vendor','customer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vendortransactions`
--

CREATE TABLE `vendortransactions` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `qty` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chemicals`
--
ALTER TABLE `chemicals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `composition`
--
ALTER TABLE `composition`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cid` (`cid`),
  ADD KEY `mid` (`mid`);

--
-- Indexes for table `customertransactions`
--
ALTER TABLE `customertransactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mid` (`mid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendortransactions`
--
ALTER TABLE `vendortransactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cid` (`cid`),
  ADD KEY `vid` (`vid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chemicals`
--
ALTER TABLE `chemicals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `composition`
--
ALTER TABLE `composition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customertransactions`
--
ALTER TABLE `customertransactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendortransactions`
--
ALTER TABLE `vendortransactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `composition`
--
ALTER TABLE `composition`
  ADD CONSTRAINT `composition_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `chemicals` (`id`),
  ADD CONSTRAINT `composition_ibfk_2` FOREIGN KEY (`mid`) REFERENCES `medicines` (`id`);

--
-- Constraints for table `customertransactions`
--
ALTER TABLE `customertransactions`
  ADD CONSTRAINT `customertransactions_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `customertransactions_ibfk_2` FOREIGN KEY (`mid`) REFERENCES `medicines` (`id`);

--
-- Constraints for table `vendortransactions`
--
ALTER TABLE `vendortransactions`
  ADD CONSTRAINT `vendortransactions_ibfk_1` FOREIGN KEY (`vid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `vendortransactions_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `chemicals` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
