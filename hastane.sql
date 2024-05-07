-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 07, 2024 at 10:00 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hastane`
--

-- --------------------------------------------------------

--
-- Table structure for table `doktorlar`
--

CREATE TABLE `doktorlar` (
  `doktorid` int(11) NOT NULL,
  `email` text NOT NULL,
  `doktorisim` text NOT NULL,
  `doktorsoyisim` text NOT NULL,
  `doktortc` int(20) NOT NULL,
  `password` text NOT NULL,
  `clinic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doktorlar`
--

INSERT INTO `doktorlar` (`doktorid`, `email`, `doktorisim`, `doktorsoyisim`, `doktortc`, `password`, `clinic`) VALUES
(21, 'aliosmanbalat@gmail.com', 'Ali Osman', 'ALAT', 1000000000, '123', 'kardiyoloji'),
(24, 'orhanbalak@gmail.com', 'Orhan', 'BALAK', 1010101010, '123', 'kbb'),
(25, 'ihsansolak@gmail.com', 'Ihsan', 'SOLAK', 1010101010, '123', 'nöroloji'),
(26, 'aliyekaraman@gmail.com', 'Aliye', 'KARAMAN', 101010100, '123', 'diyetisyenlik'),
(38, '100@gmail.com', '100', '100', 100, '100', 'nöroloji');

-- --------------------------------------------------------

--
-- Table structure for table `hastalar`
--

CREATE TABLE `hastalar` (
  `hastaid` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `hastaisim` text NOT NULL,
  `hastasoyisim` varchar(50) NOT NULL,
  `hastatc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hastalar`
--

INSERT INTO `hastalar` (`hastaid`, `email`, `password`, `hastaisim`, `hastasoyisim`, `hastatc`) VALUES
(1, 'halitakca11', '123', 'Halit AKCA', '', 0),
(5, 'halitakca4', '123', 'Halit AKCA', '', 0),
(6, 'halitakca2', '123', 'Halit AKCA', '', 0),
(7, 'halitakca3', '123', 'Halit AKCA', '', 0),
(8, 'halitakcaa', '123', 'halitakcaaa', '', 0),
(9, 'halitakca1', '123', 'halitakcaas', '', 0),
(10, '121321123@gmail.com', '2132132132131', '1231', '1313213', 132132132),
(11, 'halit@gmail.com', '123', 'Halit', 'AKCA', 100);

-- --------------------------------------------------------

--
-- Table structure for table `randevular`
--

CREATE TABLE `randevular` (
  `randevuid` int(11) NOT NULL,
  `hasta` text NOT NULL,
  `doktor` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `clinic` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `randevular`
--

INSERT INTO `randevular` (`randevuid`, `hasta`, `doktor`, `date`, `time`, `clinic`) VALUES
(24, 'HalitAKCA', 'Ali Osman ALAT', '2024-05-17', '12:12:00', 'Nöroloji'),
(26, 'Halit AKCA', 'Orhan BALAK', '2024-05-09', '01:01:00', 'Nöroloji');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doktorlar`
--
ALTER TABLE `doktorlar`
  ADD PRIMARY KEY (`doktorid`);

--
-- Indexes for table `hastalar`
--
ALTER TABLE `hastalar`
  ADD PRIMARY KEY (`hastaid`);

--
-- Indexes for table `randevular`
--
ALTER TABLE `randevular`
  ADD PRIMARY KEY (`randevuid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doktorlar`
--
ALTER TABLE `doktorlar`
  MODIFY `doktorid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `hastalar`
--
ALTER TABLE `hastalar`
  MODIFY `hastaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `randevular`
--
ALTER TABLE `randevular`
  MODIFY `randevuid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
