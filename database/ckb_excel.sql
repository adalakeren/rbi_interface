-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 07 Feb 2020 pada 07.29
-- Versi server: 10.4.10-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ckb_excel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_upload`
--

DROP TABLE IF EXISTS `detail_upload`;
CREATE TABLE IF NOT EXISTS `detail_upload` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_upload` int(11) NOT NULL,
  `no` int(11) NOT NULL,
  `kode_customer` varchar(100) NOT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `dn` varchar(100) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `pallet` int(11) NOT NULL,
  `s` int(11) NOT NULL,
  `m` int(11) NOT NULL,
  `l` int(11) NOT NULL,
  `total_coli` int(11) NOT NULL,
  PRIMARY KEY (`id_detail`),
  KEY `id_user` (`id_user`),
  KEY `id_upload` (`id_upload`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `upload`
--

DROP TABLE IF EXISTS `upload`;
CREATE TABLE IF NOT EXISTS `upload` (
  `id_upload` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `rows` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_upload`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `akses` varchar(20) NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `password`, `akses`, `status`) VALUES
(1, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'aktif'),
(2, 'user', 'user@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', 'aktif'),
(3, 'supervisor', 'supervisor@gmail.com', '09348c20a019be0318387c08df7a783d', 'supervisor', 'aktif'),
(4, 'Manager', 'manager@gmail.com', '1d0258c2440a8d19e716292b231e3190', 'manager', 'aktif');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
