-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2023 at 03:58 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(3) NOT NULL,
  `ID_PIC` varchar(255) NOT NULL,
  `LASTNAME` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `FIRSTNAME` varchar(100) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `ROLE` varchar(50) NOT NULL,
  `USERNAME` varchar(20) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `ID_PIC`, `LASTNAME`, `FIRSTNAME`, `EMAIL`, `ROLE`, `USERNAME`, `PASSWORD`) VALUES
(117, 'pic4.png', 'Morales', 'Jerome', 'j.morales@gmail.com', 'ceo', 'Jerome.Morales', '$2y$10$0xjgJ8skA5xFN/y2/iX0dukjZZVih4wlHJ2SiHyclUg.zK/sc1udO'),
(130, 'woman2.png', 'Wright', 'Catherine', 'c.wright@gmail.com', 'administrator', 'Catherine.Wright', '$2y$10$R7FWGthXB/NmaGrDS8V2jOlvY8.gzmK2svcxu/OtojBsI5o29cV9i'),
(131, 'woman3.png', 'Gutierrez', 'Tanya', 't.gutierrez@example.com', 'supervisor', 'Tanya.Gutierrez', '$2y$10$97YswmkSUzdSoj3ElXrFEOiUvEWq5eDGvPLVmi3ZqvhabOsJslkym'),
(132, 'pic.png', 'Hines', 'Lawrence', 'l.hines@code.com', 'team_leader', 'Lawrence.Hines', '$2y$10$cpn1bUp9iG/xCC1T4MnWie86tFZs8idTUxKYtLR8FgcttBvqxGHE6'),
(133, 'pic4.png', 'Austin', 'Timothy', 't.austin@email.com', 'administrator', 'Timothy.Austin', '$2y$10$gmuo/VnMX7522ysdUBJ5mOZwN/uVIEBdQf1npPUWofqyc7cci6t.2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
