-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2025 at 01:44 AM
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
-- Database: `simbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `nama_buku` varchar(50) NOT NULL,
  `penulis` varchar(20) NOT NULL,
  `stok` int(11) NOT NULL,
  `tanggal_input` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_kategori` int(11) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `cover` varchar(225) NOT NULL,
  `harga` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `nama_buku`, `penulis`, `stok`, `tanggal_input`, `id_kategori`, `deskripsi`, `cover`, `harga`) VALUES
(4, 'Bunga', 'Isna', 12, '2025-11-06 17:00:00', 0, 'hal hal itu masih ada', 'hal.jpg', 12000),
(5, 'Bunga', 'saya adal', 1, '2025-11-27 17:00:00', 0, 'nwdbhbdhebd', 'kukis.jpg', 100000),
(12, 'Laut Bercerita', 'Leila S Chudori', 12, '2025-11-28 17:00:00', 1, 'Kisah pengungsi politik Indonesia pada era Orde Baru melalui perspektif seorang anak remaja. Novel i', 'Leila_S_Chudori_Laut_Bercerita.jpg', 100000),
(13, 'Hello', 'Tere Liye', 20, '2025-11-28 17:00:00', 1, 'Tentang pertemuan atau komunikasi antar karakter yang membawa perubahan dalam hidup mereka. Cerita u', 'Tere_Liye_Hello.jpg', 99000),
(15, 'Kalkulus', 'Verbag Purcell', 30, '2025-11-29 17:00:00', 2, 'Buku teks matematika yang membahas konsep dasar dan lanjutan dalam kalkulus, termasuk limit, turunan', 'Verbag_Purcell_Kalkulus.jpg', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `tanggal_input` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `tanggal_input`) VALUES
(1, 'Fiksi', '2025-11-18 02:00:00'),
(2, 'Non Fiksi', '2025-11-19 02:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`) VALUES
(1, 'cahaya', 'cahaya@gmail.com', '$2y$10$I5RkyevBzl4t7gKhmHF8bOibDYSNHcmgbTapu2l71VnvuKYo8JnJa'),
(2, 'bagas', 'bagas@gmail.com', '$2y$10$uQ8oX8Y2Tk45c.HoHrGQlu3K9DAi6cCvkUUPokpB13skK6DJJPMhq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
