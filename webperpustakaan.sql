-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2022 at 08:47 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webperpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `kode_buku` varchar(5) NOT NULL,
  `isbn` int(13) NOT NULL,
  `judul_buku` varchar(25) NOT NULL,
  `pengarang` varchar(30) NOT NULL,
  `penerbit` varchar(20) NOT NULL,
  `tahun_terbit` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`kode_buku`, `isbn`, `judul_buku`, `pengarang`, `penerbit`, `tahun_terbit`) VALUES
('C1234', 40887284, 'Naruto', 'Masashi Kishimoto', 'Shueisha', 1999),
('B1234', 100121132, 'Garis Waktu', 'Fiersa Besari', 'PT Mediakita', 2016),
('A1234', 210002110, 'Web Developer', 'Rendra Towidjojo', 'PT GARUDA', 2021),
('C1234', 978979663, 'Detective Conan', 'Gosho Aoyama', 'Shogakukan', 1994),
('B1234', 1987602100, 'Magic Hour', 'Tisa TS', 'PT Loveable', 2015),
('A1234', 2147483647, 'Pemrograman Web', 'Amanda Rahma Yanti', 'PT ERLANGGA', 2020);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `telepon` int(13) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `telepon`, `alamat`, `username`, `password`) VALUES
(12121, 'Nur Laila', 'Perempuan', '2002-03-03', 823456789, 'Jl. Buluh Cina', 'nurlailaa', 'laila03'),
(123456, 'Amanda Rahma', 'Perempuan', '2001-12-27', 2147483647, 'Jl. Garuda Sakti', 'amandarhma', 'redvelveet'),
(234567, 'Mita Tri Leony', 'Perempuan', '2003-08-17', 898765312, 'Panam', 'mitaleony', 'mitaa123'),
(251246, 'Arfan Khalif Fauzan', 'Laki-laki', '2003-02-20', 2147483647, 'Air Molek', 'arfankhalif', ''),
(987654, 'Aldan Rizki', 'Laki-laki', '2002-03-23', 2147483647, 'Jl. A.R Hakim, Perawang', 'aldanrizki', 'aldan23');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(6) NOT NULL,
  `id_pelanggan` int(10) NOT NULL,
  `isbn` int(13) NOT NULL,
  `judul_buku` varchar(25) NOT NULL,
  `tanggal_meminjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_pelanggan`, `isbn`, `judul_buku`, `tanggal_meminjam`, `tanggal_kembali`) VALUES
(99911, 123456, 2147483647, 'Pemrograman Web', '2022-06-22', '2022-06-28'),
(99912, 987654, 1987602100, 'Magic Hour', '2022-06-22', '2022-06-25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`isbn`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_pelanggan` (`id_pelanggan`,`isbn`),
  ADD KEY `isbn` (`isbn`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `buku` (`isbn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
