-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2024 at 07:19 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adkesma`
--

-- --------------------------------------------------------

--
-- Table structure for table `datamhs`
--

CREATE TABLE `datamhs` (
  `nim` int(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `ukt` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `datamhs`
--

INSERT INTO `datamhs` (`nim`, `nama`, `alamat`, `prodi`, `ukt`) VALUES
(133737372, 'Jauhari Samsung', 'Jalan Brembo no 1', 'Ilmu Motor', 90000000),
(1313623000, 'Alexander Arnault', 'Jalan Beverly Hills nomor 7', 'Sastra Mesin', 70000000),
(1313625000, 'Jamal Black Guy', 'Jalan Downton nomor 69', 'Ilmu Kenikmatan', 10000000),
(1313627000, 'Rusdi si Imut', 'Jalan Ngawi nomor 4646', 'Ekonomi Cukur Rambut', 69000000),
(1313629000, 'Abdul Yade', 'Jalan Arab Saudi no 3', 'Teknik Gurun', 80000000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datamhs`
--
ALTER TABLE `datamhs`
  ADD PRIMARY KEY (`nim`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
