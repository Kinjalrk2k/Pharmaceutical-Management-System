-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2021 at 08:47 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

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
(10, 'Potassium Sorbate', 2.96, 300, '50c31507eb275386e31344f5b99304cc.gif'),
(11, 'Stearic Acid', 3.8, 78, 'da0535356c00953dde1fda6dff34fa70.png'),
(12, 'Providone', 3.82, 52, '9b0eedffb770d43f7b97a2ef7f0e12e3.png'),
(13, 'Starch', 2.2, 35, '3013d09bd8288547f6118fa7e6c54fb3.png'),
(14, 'Phenoxymethylpenicillin ', 0, 800, 'd15ecee4395f6432e3689fff78d79a09.png'),
(15, 'Metronidazole', 1.4, 700, 'f8911e67c48f4b4ef861347428366a1b.png'),
(16, 'Disodium Edetate', 2.76, 1068, 'beedbba2002bc760dbbf459025c3cbd4.png');

-- --------------------------------------------------------

--
-- Table structure for table `composition`
--

CREATE TABLE `composition` (
  `comp_id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `c_qty` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `composition`
--

INSERT INTO `composition` (`comp_id`, `cid`, `mid`, `c_qty`) VALUES
(3, 10, 1, 0.02),
(4, 11, 1, 0.1),
(5, 12, 1, 0.09),
(6, 13, 1, 0.5),
(8, 14, 3, 0.6),
(9, 15, 4, 0.4),
(10, 13, 4, 0.7),
(11, 16, 4, 0.06);

-- --------------------------------------------------------

--
-- Stand-in structure for view `ctview`
-- (See below for the actual view)
--
CREATE TABLE `ctview` (
`name` varchar(30)
,`email` varchar(30)
,`qty` int(11)
,`medName` varchar(30)
,`price` float
,`amt` double
);

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

--
-- Dumping data for table `customertransactions`
--

INSERT INTO `customertransactions` (`id`, `mid`, `cid`, `qty`) VALUES
(1, 3, 5, 2),
(2, 1, 5, 1),
(3, 4, 5, 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `manufatureview`
-- (See below for the actual view)
--
CREATE TABLE `manufatureview` (
`comp_id` int(11)
,`cid` int(11)
,`mid` int(11)
,`c_qty` double
,`id` int(11)
,`name` varchar(30)
,`qty` double
,`rate` double
,`image` varchar(200)
,`req_qty` double
,`left_qty` double
);

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
(1, 'Paracetamol', 1, 50, 1, 'e90512ca9230da03e5231e5f0ebc623a.jpg'),
(3, 'Penicillin', 3, 500, 1, '05a35517f51b01132c03310b85df6c9b.jpg'),
(4, 'Metrogyl', 2, 400, 1, '24c6334633edc9f183239c3ccc49a37b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` enum('admin','vendor','customer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `type`) VALUES
(4, 'Administrator', 'admin@pharma.com', '$2y$10$kj1PIewbwTvBnpMq3b180OHf3JTAD4wSBDJ0oe7XfCyM6QOlGNk5S', 'admin'),
(5, 'Customer', 'customer@pharma.com', '$2y$10$bXspDJgBj67ii0CKAIUsGuHGyR5wIS/fN8IRTmyCDdks93cksIuQe', 'customer'),
(6, 'Vendor', 'vendor@pharma.com', '$2y$10$UAD7TYxyRHfIj5MBmupfGuGm4j46bzH.WdewS4uPufxCyGP7evz7G', 'vendor');

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
-- Dumping data for table `vendortransactions`
--

INSERT INTO `vendortransactions` (`id`, `cid`, `vid`, `qty`) VALUES
(1, 10, 6, 3),
(2, 11, 6, 4),
(3, 12, 6, 4),
(4, 13, 6, 1),
(5, 14, 6, 3),
(6, 16, 6, 3),
(7, 15, 6, 3),
(8, 13, 6, 5);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vtview`
-- (See below for the actual view)
--
CREATE TABLE `vtview` (
`name` varchar(30)
,`email` varchar(30)
,`qty` float
,`chemName` varchar(30)
,`rate` double
,`amt` double
);

-- --------------------------------------------------------

--
-- Structure for view `ctview`
--
DROP TABLE IF EXISTS `ctview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ctview`  AS SELECT `users`.`name` AS `name`, `users`.`email` AS `email`, `customertransactions`.`qty` AS `qty`, `medicines`.`name` AS `medName`, `medicines`.`price` AS `price`, `customertransactions`.`qty`* `medicines`.`price` AS `amt` FROM ((`customertransactions` join `medicines`) join `users`) WHERE `customertransactions`.`mid` = `medicines`.`id` AND `customertransactions`.`cid` = `users`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `manufatureview`
--
DROP TABLE IF EXISTS `manufatureview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `manufatureview`  AS SELECT `composition`.`comp_id` AS `comp_id`, `composition`.`cid` AS `cid`, `composition`.`mid` AS `mid`, `composition`.`c_qty` AS `c_qty`, `chemicals`.`id` AS `id`, `chemicals`.`name` AS `name`, `chemicals`.`qty` AS `qty`, `chemicals`.`rate` AS `rate`, `chemicals`.`image` AS `image`, `composition`.`c_qty`* 32 AS `req_qty`, `chemicals`.`qty`- `composition`.`c_qty` * 32 AS `left_qty` FROM (`composition` join `chemicals`) WHERE `composition`.`mid` = '1' AND `composition`.`cid` = `chemicals`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `vtview`
--
DROP TABLE IF EXISTS `vtview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vtview`  AS SELECT `users`.`name` AS `name`, `users`.`email` AS `email`, `vendortransactions`.`qty` AS `qty`, `chemicals`.`name` AS `chemName`, `chemicals`.`rate` AS `rate`, `vendortransactions`.`qty`* `chemicals`.`rate` AS `amt` FROM ((`vendortransactions` join `chemicals`) join `users`) WHERE `vendortransactions`.`cid` = `chemicals`.`id` AND `vendortransactions`.`vid` = `users`.`id` ;

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
  ADD PRIMARY KEY (`comp_id`),
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
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customertransactions`
--
ALTER TABLE `customertransactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vendortransactions`
--
ALTER TABLE `vendortransactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
