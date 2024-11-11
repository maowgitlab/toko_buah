-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Okt 2019 pada 11.40
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_buah_offline`
--
CREATE DATABASE IF NOT EXISTS `toko_buah_offline` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `toko_buah_offline`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pembelian`
--

CREATE TABLE IF NOT EXISTS `detail_pembelian` (
  `id_pembelian` int(11) NOT NULL AUTO_INCREMENT,
  `id_akun` varchar(30) NOT NULL,
  `id_pembeli` varchar(30) NOT NULL,
  `id_buah` varchar(30) NOT NULL,
  `total_harga` varchar(30) NOT NULL,
  `tgl_beli` datetime NOT NULL,
  PRIMARY KEY (`id_pembelian`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id_pembelian`, `id_akun`, `id_pembeli`, `id_buah`, `total_harga`, `tgl_beli`) VALUES
(15, 'agen', 'dimas', 'Apel', '40000', '2019-10-21 08:40:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_buah`
--

CREATE TABLE IF NOT EXISTS `stok_buah` (
  `id_stok` int(11) NOT NULL AUTO_INCREMENT,
  `id_buah` varchar(30) NOT NULL,
  `nama_buah` varchar(30) NOT NULL,
  `gambar_buah` varchar(50) NOT NULL,
  `jumlah_stok` varchar(30) NOT NULL,
  `harga_awal` varchar(50) NOT NULL,
  PRIMARY KEY (`id_stok`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stok_buah`
--

INSERT INTO `stok_buah` (`id_stok`, `id_buah`, `nama_buah`, `gambar_buah`, `jumlah_stok`, `harga_awal`) VALUES
(43, 'B001', 'Pisang', 'pisang.png', '16', '3500'),
(44, 'B002', 'Nanas', 'nanas.png', '7', '4000'),
(45, 'B003', 'Pepaya', 'pepaya.png', '9', '6000'),
(46, 'B004', 'Apel', 'apel.png', '149', '4000'),
(47, 'B005', 'Pupuk Premium PRO', 'pupuk.png', '113', '500000'),
(48, 'B006', 'Buah Naga', 'naga.png', '118', '8000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_akun`
--

CREATE TABLE IF NOT EXISTS `tb_akun` (
  `id_akun` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id_akun`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_akun`
--

INSERT INTO `tb_akun` (`id_akun`, `username`, `password`, `status`) VALUES
(1, 'robianoor', '12345', 'owner'),
(2, 'nisa', '12345', 'agen'),
(3, 'ihsan', '12345', 'agen'),
(4, 'anang', '12345', 'agen'),
(5, 'dimas', '12345', 'agen');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_buah`
--

CREATE TABLE IF NOT EXISTS `tb_buah` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `id_buah` varchar(30) NOT NULL,
  `nama_buah` varchar(30) NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `harga_satuan` varchar(20) NOT NULL,
  `jumlah_stok` varchar(100) NOT NULL,
  `nama_pelanggan` text NOT NULL,
  `id_akun` varchar(20) NOT NULL,
  `tgl_beli` datetime NOT NULL,
  `total_harga` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_buah`
--

INSERT INTO `tb_buah` (`id`, `id_buah`, `nama_buah`, `jumlah_beli`, `harga_satuan`, `jumlah_stok`, `nama_pelanggan`, `id_akun`, `tgl_beli`, `total_harga`, `status`) VALUES
(63, 'B004', 'Apel', 10, '4000', '159', 'dimas', 'agen', '2019-10-21 08:40:05', '40000', 'Barang / buah telah dikirim');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggan`
--

CREATE TABLE IF NOT EXISTS `tb_pelanggan` (
  `id_pelanggan` varchar(30) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `jenkel` enum('L','P') NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `tgl_beli` date NOT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `jenkel`, `no_hp`, `tgl_beli`) VALUES
('P001', 'Nanam', 'P', '01283138013', '2019-10-05'),
('P002', 'rahmat', 'L', '01831231313', '2019-10-05');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
