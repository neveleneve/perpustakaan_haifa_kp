-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2021 at 02:44 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `id_buku` varchar(255) DEFAULT NULL,
  `penerbit` varchar(255) DEFAULT NULL,
  `nama_buku` varchar(255) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `id_buku`, `penerbit`, `nama_buku`, `stok`) VALUES
(1, 'KD24912474', 'Gramedia Asri Media', 'Belajar Bahasa Indonesia', 8),
(2, 'SK19284059', 'Erlangga Group', 'Matematika Itu Mudah Tau!', 10),
(3, 'BM45036827', 'Gramedia Asri Media', 'Menambah Pengetahuan Sosial', 9),
(4, 'BK59874036', 'Erlangga Group', 'Belajar Biologi Itu Asyik', 10),
(5, 'EK24371960', 'Erlangga Group', 'Agama Islam', 10),
(6, 'FB51396084', 'Bukit Raya Media', 'Jembatan Ilmu', 10);

-- --------------------------------------------------------

--
-- Table structure for table `list_peminjaman`
--

CREATE TABLE `list_peminjaman` (
  `id` int(11) NOT NULL,
  `id_peminjaman` varchar(255) NOT NULL,
  `id_buku` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_peminjaman`
--

INSERT INTO `list_peminjaman` (`id`, `id_peminjaman`, `id_buku`, `jumlah`) VALUES
(1, 'NTMQZ496GP', 'SK19284059', 2),
(2, 'MKYWFHXURB', 'SK19284059', 1),
(3, 'RN2HXIYUFK', 'BK59874036', 2),
(4, 'RN2HXIYUFK', 'SK19284059', 1),
(5, 'KNAZO5L8UG', 'BM45036827', 1),
(6, 'KNAZO5L8UG', 'KD24912474', 2);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `id_peminjaman` varchar(255) NOT NULL,
  `nama_peminjam` varchar(255) NOT NULL,
  `alamat_peminjam` varchar(255) NOT NULL,
  `status_input` int(1) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `id_peminjaman`, `nama_peminjam`, `alamat_peminjam`, `status_input`, `tanggal_pinjam`, `tanggal_kembali`) VALUES
(1, 'NTMQZ496GP', 'Jaja Miharja', 'Jalan Pengadaan', 1, '2020-12-23', '2021-07-16'),
(2, 'MKYWFHXURB', 'budi', 'jalan', 1, '2020-12-23', '2021-07-16'),
(3, 'RN2HXIYUFK', 'Andi', 'Jalan Budiono', 1, '2021-06-23', '2021-06-23'),
(4, 'KNAZO5L8UG', 'Udin Makmur', 'Jalan Keramaian', 1, '2021-07-16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`) VALUES
(1, 'Haifa Nabila', 'haifanab', 'adminadmin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_peminjaman`
--
ALTER TABLE `list_peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `list_peminjaman`
--
ALTER TABLE `list_peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
