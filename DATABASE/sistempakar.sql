-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2024 at 05:52 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistempakar`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `nama_lengkap`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `basis_pengetahuan`
--

CREATE TABLE `basis_pengetahuan` (
  `kode_pengetahuan` int(11) NOT NULL,
  `kode_penyakit` int(11) NOT NULL,
  `kode_gejala` int(11) NOT NULL,
  `mb` float NOT NULL,
  `md` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `basis_pengetahuan`
--

INSERT INTO `basis_pengetahuan` (`kode_pengetahuan`, `kode_penyakit`, `kode_gejala`, `mb`, `md`) VALUES
(2, 1, 1, 0.4, 0),
(3, 1, 2, 1, 0.2),
(4, 1, 3, 0.4, 0),
(5, 1, 4, 0.4, 0.2),
(6, 1, 5, 0.6, 0.2),
(7, 2, 1, 1, 0),
(8, 2, 3, 0.4, 0),
(9, 2, 4, 0.4, 0.2),
(10, 2, 5, 0.2, 0),
(11, 2, 6, 0.4, 0.2),
(12, 2, 7, 0.4, 0),
(13, 2, 8, 1, 0.2),
(14, 2, 9, 0.4, 0.2),
(15, 3, 1, 0.4, 0.2),
(16, 3, 4, 0.4, 0.2),
(17, 3, 6, 0.4, 0),
(18, 3, 10, 0.4, 0.2),
(19, 3, 11, 0, 0.2),
(20, 3, 12, 0.4, 0.2),
(21, 3, 13, 0.2, 0.2),
(22, 3, 14, 1, 0),
(23, 3, 15, 1, 0.2);

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `kode_gejala` int(11) NOT NULL,
  `nama_gejala` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`kode_gejala`, `nama_gejala`) VALUES
(1, 'Perut kembung'),
(2, 'Mengalami sakit pada ulu hati'),
(3, 'Sering merasa lapar'),
(4, 'Mual dan Muntah'),
(5, 'nyeri di bagian tulang belakang'),
(15, 'Rasa panas di dada'),
(6, 'Sendawa'),
(7, 'Rasa sakit/tidak nyaman pada perut bagian atas'),
(8, 'Perasaan panas di dada dan perut '),
(9, 'Mengeluarkan gas asam dari mulut '),
(10, 'Rasa tidak nyaman waktu menelan'),
(11, 'Rasa sakit pada saat menelean'),
(12, 'Rasa nyeri di dada'),
(13, 'Gangguan pencernaan'),
(14, 'Batuk');

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `tanggal` varchar(50) NOT NULL DEFAULT '0',
  `nama_pasien` varchar(225) NOT NULL,
  `penyakit` text NOT NULL,
  `gejala` text NOT NULL,
  `hasil_id` int(11) NOT NULL,
  `hasil_nilai` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `tanggal`, `nama_pasien`, `penyakit`, `gejala`, `hasil_id`, `hasil_nilai`) VALUES
(321, '2024-01-02 19:46:57', '', 'a:0:{}', 'a:0:{}', 0, ''),
(322, '2024-01-02 19:47:06', '', 'a:0:{}', 'a:0:{}', 0, ''),
(323, '2024-01-02 23:51:56', '', 'a:3:{i:2;s:6:\"0.8589\";i:1;s:6:\"0.7030\";i:3;s:6:\"0.4288\";}', 'a:6:{i:1;s:1:\"1\";i:2;s:1:\"2\";i:3;s:1:\"3\";i:4;s:1:\"4\";i:5;s:1:\"5\";i:6;s:1:\"1\";}', 2, '0.8589');

-- --------------------------------------------------------

--
-- Table structure for table `kondisi`
--

CREATE TABLE `kondisi` (
  `id` int(11) NOT NULL,
  `kondisi` varchar(64) NOT NULL,
  `ket` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kondisi`
--

INSERT INTO `kondisi` (`id`, `kondisi`, `ket`) VALUES
(1, 'sangat yakin', ''),
(2, 'Yakin', ''),
(3, 'Cukup yakin', ''),
(4, 'sedikit yakin', ''),
(5, 'tidak', '');

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `kode_penyakit` int(11) NOT NULL,
  `nama_penyakit` varchar(50) NOT NULL,
  `det_penyakit` varchar(500) NOT NULL,
  `srn_penyakit` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`kode_penyakit`, `nama_penyakit`, `det_penyakit`, `srn_penyakit`) VALUES
(1, 'Maag', 'Maag adalah istilah umum yang digunakan untuk merujuk pada rasa tidak nyaman atau nyeri yang terjadi di bagian atas perut, khususnya di sekitar lambung. ', 'Mengubah Pola Makan: Hindari makanan yang dapat menyebabkan iritasi lambung, seperti makanan pedas, berlemak, atau asam.'),
(2, 'Dispepsia', 'melainkan suatu kondisi yang menggambarkan kumpulan gejala pencernaan yang umum. Beberapa penyebab umum dispepsia meliputi:Irritasi Lambung,Helikobakter pylori,Gastroesophageal Reflux Disease (GERD)', 'Perubahan Gaya Hidup dan Pola Makan,Manajemen Stres,Hindari Konsumsi Zat-Iritan,Manajemen Berat Badan'),
(3, 'GERD', 'GERD adalah singkatan dari \"Gastroesophageal Reflux Disease,\" yang dapat diartikan sebagai penyakit refluks gastroesofageal. Ini adalah kondisi medis yang terjadi ketika asam lambung atau isi lambung lainnya naik ke dalam kerongkongan secara berulang, menyebabkan gejala yang tidak nyaman. GERD merupakan bentuk yang lebih serius dari refluks asam.', 'Perubahan Gaya Hidup dan Pola Makan,Manajemen Stres,Hindari Konsumsi Zat-Iritan,Manajemen Berat Badan,Obat penghambat asam (H2 blockers atau proton pump inhibitors) untuk ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `basis_pengetahuan`
--
ALTER TABLE `basis_pengetahuan`
  ADD PRIMARY KEY (`kode_pengetahuan`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`kode_gejala`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `kondisi`
--
ALTER TABLE `kondisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`kode_penyakit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basis_pengetahuan`
--
ALTER TABLE `basis_pengetahuan`
  MODIFY `kode_pengetahuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `gejala`
--
ALTER TABLE `gejala`
  MODIFY `kode_gejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=324;

--
-- AUTO_INCREMENT for table `kondisi`
--
ALTER TABLE `kondisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `kode_penyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
