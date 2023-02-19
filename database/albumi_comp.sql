-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Feb 2023 pada 04.54
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `albumi_comp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`, `level`) VALUES
(1, 'admin', 'admin', 'Operator Albumi Comp', 'operator'),
(2, 'manager', 'manager', 'Manager Albumi Comp', 'manager');

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto`
--

CREATE TABLE `foto` (
  `id_foto` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `foto1` varchar(255) NOT NULL,
  `foto2` varchar(255) NOT NULL,
  `foto3` varchar(255) NOT NULL,
  `foto4` varchar(255) NOT NULL,
  `foto5` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `foto`
--

INSERT INTO `foto` (`id_foto`, `id_produk`, `foto1`, `foto2`, `foto3`, `foto4`, `foto5`) VALUES
(5, 1, '5e3be541ad3d1.jpg', '5e3be541ada64.jpg', '5e3be541adfe4.jpg', '5e3be541ae636.jpg', '5e3be541aec6d.jpg'),
(6, 5, '6246b4e1dd8b0.jpg', '6246b4e1ddd1c.jpg', '6246b4e1de144.jpg', '6246b4e1de655.jpg', '6246b4e1deb70.jpg'),
(7, 6, '625725a6ce9cc.jpg', '625725a6e013e.jpg', '625725a6e0587.jpg', '625725a6e09b5.jpg', '625725a6e0eca.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gift`
--

CREATE TABLE `gift` (
  `id_gift` int(11) NOT NULL,
  `nama_gift` varchar(255) NOT NULL,
  `point_gift` int(11) NOT NULL,
  `gambar_gift` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gift`
--

INSERT INTO `gift` (`id_gift`, `nama_gift`, `point_gift`, `gambar_gift`) VALUES
(4, 'X-Box One 360 Series', 100, '6254fbc405730-12.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori_produk` varchar(100) NOT NULL,
  `point_kategori` varchar(255) NOT NULL,
  `jumlah_favorit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori_produk`, `point_kategori`, `jumlah_favorit`) VALUES
(1, 'Gold', '100', 4),
(2, 'Silver', '50', 4),
(3, 'Bronze', '30', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `klaim`
--

CREATE TABLE `klaim` (
  `id_klaim` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_laporan` int(11) NOT NULL,
  `tanggal_klaim` date NOT NULL,
  `status_klaim` varchar(255) NOT NULL DEFAULT 'pending',
  `total_harga` varchar(255) NOT NULL,
  `bulan_klaim` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `klaim`
--

INSERT INTO `klaim` (`id_klaim`, `id_member`, `id_laporan`, `tanggal_klaim`, `status_klaim`, `total_harga`, `bulan_klaim`) VALUES
(1, 1, 1, '2020-02-05', 'confirmed', '58000000', 'Feb'),
(2, 1, 1, '2020-02-05', 'confirmed', '69000000', 'Feb'),
(3, 1, 1, '2020-02-07', 'confirmed', '45000000', 'Feb'),
(4, 1, 1, '2020-02-08', 'confirmed', '69000000', 'Feb'),
(5, 1, 2, '2020-03-01', 'confirmed', '58000000', 'Mar'),
(6, 1, 2, '2020-03-01', 'confirmed', '90000000', 'Mar'),
(7, 1, 2, '2020-03-01', 'confirmed', '60000000', 'Mar'),
(8, 2, 3, '2020-04-01', 'confirmed', '90000000', 'Apr'),
(9, 2, 4, '2021-01-01', 'confirmed', '120000000', 'Jan'),
(10, 2, 5, '2021-02-01', 'confirmed', '58000000', 'Feb'),
(11, 2, 6, '2021-12-31', 'confirmed', '58000000', 'Dec'),
(12, 2, 7, '2022-03-31', 'confirmed', '69000000', 'Mar'),
(13, 2, 8, '2022-04-01', 'confirmed', '60000000', 'Apr'),
(14, 2, 8, '2022-04-03', 'confirmed', '10000000', 'Apr'),
(15, 2, 8, '2022-04-03', 'confirmed', '69000000', 'Apr'),
(16, 3, 8, '2022-04-04', 'confirmed', '60000000', 'Apr'),
(17, 1, 8, '2022-04-04', 'confirmed', '69000000', 'Apr'),
(25, 3, 8, '2022-04-09', 'confirmed', '10000000', 'Apr'),
(26, 3, 8, '2022-04-09', 'confirmed', '45000000', 'Apr'),
(27, 3, 8, '2022-04-09', 'confirmed', '58000000', 'Apr'),
(28, 3, 8, '2022-04-09', 'confirmed', '15000000', 'Apr'),
(29, 3, 8, '2022-04-09', 'pending', '15000000', 'Apr'),
(34, 7, 8, '2022-04-15', 'confirmed', '15000000', 'Apr'),
(36, 7, 1, '2020-02-23', 'confirmed', '45000000', 'Feb'),
(50, 11, 1, '2020-02-28', 'confirmed', '90000000', 'Feb'),
(52, 11, 1, '2020-02-29', 'confirmed', '58000000', 'Feb'),
(53, 11, 1, '2020-02-29', 'confirmed', '10000000', 'Feb');

-- --------------------------------------------------------

--
-- Struktur dari tabel `klaim_gift`
--

CREATE TABLE `klaim_gift` (
  `id_klaim_gift` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_gift` int(11) NOT NULL,
  `nama_gift` varchar(255) NOT NULL,
  `point_gift` int(11) NOT NULL,
  `gambar_gift` varchar(255) NOT NULL,
  `tanggal_klaim` datetime NOT NULL,
  `tanggal_expired` datetime NOT NULL,
  `status_klaim` varchar(255) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `klaim_gift`
--

INSERT INTO `klaim_gift` (`id_klaim_gift`, `id_member`, `id_gift`, `nama_gift`, `point_gift`, `gambar_gift`, `tanggal_klaim`, `tanggal_expired`, `status_klaim`) VALUES
(1, 2, 1, 'PlayStation 5', 100, '5e3d246cc876c-8.jpg', '2022-04-01 22:54:42', '0000-00-00 00:00:00', 'expired'),
(2, 1, 1, 'PlayStation 5', 100, '5e3d246cc876c-8.jpg', '2022-04-01 22:58:18', '0000-00-00 00:00:00', 'expired'),
(3, 1, 1, 'PlayStation 5', 100, '5e3d246cc876c-8.jpg', '2022-04-01 21:00:58', '2022-04-02 21:00:58', 'expired'),
(4, 1, 1, 'PlayStation 5', 100, '5e3d246cc876c-8.jpg', '2022-04-02 02:05:44', '2022-04-03 02:05:44', 'expired'),
(5, 2, 1, 'PlayStation 5', 100, '5e3d246cc876c-8.jpg', '2022-04-03 02:15:51', '2022-04-04 02:15:51', 'expired'),
(6, 2, 2, 'X-Box One 360', 200, '5e3d1ac069cd3-12.jpg', '2022-04-04 02:19:54', '2022-04-05 02:19:54', 'expired'),
(7, 2, 1, 'PlayStation 5', 100, '5e3d246cc876c-8.jpg', '2022-04-04 02:21:10', '2022-04-05 02:21:10', 'expired'),
(8, 1, 1, 'PlayStation 5', 100, '5e3d246cc876c-8.jpg', '2022-04-04 05:57:22', '2022-04-05 05:57:22', 'expired'),
(9, 2, 2, 'X-Box One 360', 200, '624a286cd318d-12.jpg', '2022-04-04 06:11:24', '2022-04-05 06:11:24', 'expired'),
(10, 1, 1, 'PlayStation 5', 100, '5e3d246cc876c-8.jpg', '2022-04-05 07:23:19', '2022-04-06 07:23:19', 'expired'),
(11, 7, 4, 'X-Box One 360 Series', 100, '6254fbc405730-12.jpg', '2022-04-13 14:47:46', '2022-04-14 14:47:46', 'expired'),
(12, 7, 4, 'X-Box One 360 Series', 100, '6254fbc405730-12.jpg', '2020-02-23 18:12:40', '2020-02-24 18:12:40', 'expired'),
(13, 11, 4, 'X-Box One 360 Series', 100, '6254fbc405730-12.jpg', '2020-02-27 19:34:12', '2020-02-28 19:34:12', 'expired'),
(14, 11, 4, 'X-Box One 360 Series', 100, '6254fbc405730-12.jpg', '2020-02-27 19:51:04', '2020-02-28 19:51:04', 'expired'),
(15, 11, 4, 'X-Box One 360 Series', 100, '6254fbc405730-12.jpg', '2020-02-27 19:54:18', '2020-02-28 19:54:18', 'expired'),
(16, 11, 4, 'X-Box One 360 Series', 100, '6254fbc405730-12.jpg', '2020-02-27 19:55:44', '2020-02-28 19:55:44', 'expired'),
(17, 11, 4, 'X-Box One 360 Series', 100, '6254fbc405730-12.jpg', '2020-02-27 19:57:46', '2020-02-28 19:57:46', 'expired'),
(18, 11, 4, 'X-Box One 360 Series', 100, '6254fbc405730-12.jpg', '2020-02-27 19:58:09', '2020-02-28 19:58:09', 'expired'),
(19, 11, 4, 'X-Box One 360 Series', 100, '6254fbc405730-12.jpg', '2020-02-27 20:23:12', '2020-02-28 20:23:12', 'expired'),
(20, 11, 4, 'X-Box One 360 Series', 100, '6254fbc405730-12.jpg', '2020-02-27 20:23:51', '2020-02-28 20:23:51', 'expired'),
(21, 11, 4, 'X-Box One 360 Series', 100, '6254fbc405730-12.jpg', '2020-02-27 20:27:29', '2020-02-28 20:27:29', 'expired'),
(22, 11, 4, 'X-Box One 360 Series', 100, '6254fbc405730-12.jpg', '2020-02-27 23:06:46', '2020-02-28 23:06:46', 'expired'),
(23, 11, 4, 'X-Box One 360 Series', 100, '6254fbc405730-12.jpg', '2020-02-28 06:41:55', '2020-02-29 06:41:55', 'expired');

-- --------------------------------------------------------

--
-- Struktur dari tabel `klaim_produk`
--

CREATE TABLE `klaim_produk` (
  `id_klaim_produk` int(11) NOT NULL,
  `id_klaim` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `total_klaim` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kategori_produk` varchar(255) NOT NULL,
  `berat_produk` int(11) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `point_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `klaim_produk`
--

INSERT INTO `klaim_produk` (`id_klaim_produk`, `id_klaim`, `id_produk`, `total_klaim`, `nama_produk`, `kategori_produk`, `berat_produk`, `harga_produk`, `point_kategori`) VALUES
(1, 1, 2, 1, '', '', 0, 0, 0),
(2, 2, 1, 1, '', '', 0, 0, 0),
(3, 3, 4, 1, '', '', 0, 0, 0),
(4, 4, 1, 1, '', '', 0, 0, 0),
(5, 5, 2, 1, '', '', 0, 0, 0),
(6, 6, 4, 2, '', '', 0, 0, 0),
(7, 7, 3, 1, '', '', 0, 0, 0),
(8, 8, 4, 2, '', '', 0, 0, 0),
(9, 9, 3, 2, '', '', 0, 0, 0),
(10, 10, 2, 1, '', '', 0, 0, 0),
(11, 11, 2, 1, '', '', 0, 0, 0),
(12, 12, 1, 1, '', '', 0, 0, 0),
(13, 13, 3, 1, '', '', 0, 0, 0),
(14, 14, 5, 1, '', '', 0, 0, 0),
(15, 15, 1, 1, '', '', 0, 0, 0),
(16, 16, 3, 1, '', '', 0, 0, 0),
(17, 17, 1, 1, '', '', 0, 0, 0),
(25, 25, 5, 1, 'Testing Laptop Produk Produk', 'Bronze', 1000, 10000000, 30),
(26, 26, 4, 1, 'MSI Sonic Fire-X333', 'Bronze', 2000, 45000000, 30),
(27, 27, 2, 1, 'Acer Predator Px-009 ', 'Silver', 3000, 58000000, 50),
(28, 28, 6, 1, 'Samsung S007 Slim', 'Gold', 1000, 15000000, 100),
(29, 29, 6, 1, 'Samsung S007 Slim', 'Gold', 1000, 15000000, 100),
(34, 34, 6, 1, 'Samsung S007', 'Gold', 1000, 15000000, 100),
(36, 36, 4, 1, 'MSI Sonic Fire-X333', 'Bronze', 2000, 45000000, 30),
(50, 50, 4, 2, 'MSI Sonic Fire-X333', 'Bronze', 2000, 45000000, 30),
(52, 52, 2, 1, 'Acer Predator Px-009 ', 'Silver', 3000, 58000000, 50),
(53, 53, 5, 1, 'Testing Laptop Produk Produk', 'Bronze', 1000, 10000000, 30);

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int(11) NOT NULL,
  `tahun_laporan` int(11) NOT NULL,
  `bulan_laporan` varchar(255) NOT NULL,
  `total_laporan` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `tahun_laporan`, `bulan_laporan`, `total_laporan`) VALUES
(1, 2020, 'Feb', 444000000),
(2, 2020, 'Mar', 208000000),
(3, 2020, 'Apr', 90000000),
(4, 2021, 'Jan', 120000000),
(5, 2021, 'Feb', 58000000),
(6, 2021, 'Dec', 58000000),
(7, 2022, 'Mar', 69000000),
(8, 2022, 'Apr', 411000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `nama_member` varchar(255) NOT NULL,
  `email_member` varchar(255) NOT NULL,
  `password_member` varchar(255) NOT NULL,
  `alamat_member` text NOT NULL,
  `telepon_member` varchar(255) NOT NULL,
  `img_member` varchar(255) NOT NULL DEFAULT 'face-0.jpg',
  `status_member` varchar(255) NOT NULL DEFAULT 'active',
  `point_member` varchar(255) NOT NULL DEFAULT '10',
  `jenis_kelamin` varchar(255) NOT NULL,
  `tanggal_registrasi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id_member`, `nama_member`, `email_member`, `password_member`, `alamat_member`, `telepon_member`, `img_member`, `status_member`, `point_member`, `jenis_kelamin`, `tanggal_registrasi`) VALUES
(1, 'Cristiano Ronaldo', 'c.ronaldo@gmail.com', '12345', 'St.Monreal, No.771, Lisbon, Portugal', '0812341119090', '624a9cd024250_4.jpg', 'active', '410', 'pria', '2022-04-05'),
(2, 'Leonal Messi', 'l.messi@gmail.com', '12345', 'Catalan Lounge No.111, Catalonia Barcelona, Espana', '087121333234', '624e12c22e7db_13.jpg', 'active', '230', 'pria', '2022-04-06'),
(3, 'Bambang Pamungkas', 'bp@gmail.com', '12345', 'Jakarta, DKI Jakarta Indonesia', '082345123342', '624e1274219d2_7.jpg', 'active', '250', 'pria', '2022-04-06'),
(7, 'Egy Maulana Vikri', 'egy@gmail.com', '12345', 'Gdanks, Polnski, Poland', '089675435444', 'face-0.jpg', 'active', '220', 'pria', '2022-04-09'),
(8, 'raditya dika', 'raditya@gmail.com', '$2y$10$sFOH3FTMNRs.i2o/tnI8NuJGDfacz2pB2PzWWlcnpzAojPcxE6sM2', 'Jakarta, Indonesia', '087678564312', 'face-0.jpg', 'active', '10', 'pria', '2020-02-24'),
(9, 'uus aja', 'uus@gmail.com', '$2y$10$2J99D3FhwlOWlqF7fEkwuOwfmhDToaD4Xuzkpni5JfULgH/b1r2z6', 'Jakarta, Indonesia', '088765555432', 'face-0.jpg', 'non active', '10', 'pria', '2020-02-24'),
(10, 'deddy combusier', 'deddy@gmail.com', '$2y$10$B4CNvcHsEaxDYtBzshHGx.tsWv/CLihdqp7TlibPA6e/og9.uRX4a', 'Jakarta, Indonesia', '087675555443', 'face-0.jpg', 'active', '10', 'pria', '2020-02-24'),
(11, 'babe cabitaaaa', 'babe@gmail.com', '$2y$10$RAmhHYSJUsqFKDLw1uEnROcfwGXBBGWBv0icQWRSxGzWotH.sfo7K', 'Jakarta, Indonesia', '089765787777', '5e5395db7e256_353974-PBME6B-537.jpg', 'active', '110', 'pria', '2020-02-24'),
(12, 'bintang timur', 'biti@gmail.com', '$2y$10$TSJEHlNW4E0K5E5rN8xG4.c7OUbBEm.mbL6T.Lstt0JRhTz7/XGC2', 'Jakarta, Indonesia', '0888654635444', 'face-0.jpg', 'non active', '10', 'pria', '2020-02-24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `berat_produk` int(11) NOT NULL,
  `foto_produk` varchar(100) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `stok_produk` int(11) NOT NULL,
  `nilai_ux` int(11) NOT NULL,
  `nilai_desain` int(11) NOT NULL,
  `nilai_solusi` int(11) NOT NULL,
  `nilai_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga_produk`, `berat_produk`, `foto_produk`, `deskripsi_produk`, `stok_produk`, `nilai_ux`, `nilai_desain`, `nilai_solusi`, `nilai_harga`) VALUES
(2, 2, 'Acer Predator Px-009 ', 58000000, 3000, '5e3a5e112cb58_2.jpeg', 'Predator baru dari acer, dengan kemampuan yang relevan', 7, 10, 20, 30, 40),
(3, 3, 'Lenovo Legion Y-11 Wizard', 60000000, 3500, '5e3a5e742ec0a_5.jpeg', 'Laptop gaming dan design keluaran terbaru dari lenovo', 5, 10, 20, 30, 40),
(4, 3, 'MSI Sonic Fire-X333', 45000000, 2000, '5e3a5ec6656e8_10.jpeg', 'Laptop gaming MSI yang merah tapi tidak murahan', 8, 10, 20, 30, 40),
(5, 3, 'Testing Laptop Produk Produk', 10000000, 1000, '6246b08db869f_6.jpg', 'Ini hanya testing..', 7, 90, 60, 50, 17),
(6, 1, 'Samsung S007', 15000000, 1000, '6254b1e7187f6_3.jpg', 'Laptop dengan keunggulan design yang slim dan elegan.', 7, 90, 100, 85, 88),
(7, 3, 'MSI Red Valvet', 5000000, 5000, '5e5b3a64ae3a8_353974-PBME6B-537.jpg', 'Laptop JOS.', 10, 80, 90, 40, 10),
(8, 1, 'Lenovo Legion V', 60000000, 5000, '5e5b3aef246a8_FULL Trello Board Page.JPG', 'LENOVO Hebat', 10, 90, 79, 99, 56),
(9, 2, 'COBA COBA', 10000000, 7000, '5e5b3bc2cf964_fashion.PNG', 'JOS', 10, 90, 78, 78, 77),
(10, 1, 'TRY', 100000000, 6000, '5e5b3c2ead245_rasa tanggal tua.JPG', 'MANTEB', 5, 89, 89, 88, 55),
(11, 3, 'XXX', 8900000, 6000, '5e5b3c7b2b790_ecommerce.PNG', 'HEBAT', 11, 78, 55, 47, 67);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id_foto`);

--
-- Indeks untuk tabel `gift`
--
ALTER TABLE `gift`
  ADD PRIMARY KEY (`id_gift`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `klaim`
--
ALTER TABLE `klaim`
  ADD PRIMARY KEY (`id_klaim`),
  ADD KEY `id_member` (`id_member`);

--
-- Indeks untuk tabel `klaim_gift`
--
ALTER TABLE `klaim_gift`
  ADD PRIMARY KEY (`id_klaim_gift`);

--
-- Indeks untuk tabel `klaim_produk`
--
ALTER TABLE `klaim_produk`
  ADD PRIMARY KEY (`id_klaim_produk`),
  ADD KEY `id_klaim` (`id_klaim`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `foto`
--
ALTER TABLE `foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `gift`
--
ALTER TABLE `gift`
  MODIFY `id_gift` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `klaim`
--
ALTER TABLE `klaim`
  MODIFY `id_klaim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `klaim_gift`
--
ALTER TABLE `klaim_gift`
  MODIFY `id_klaim_gift` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `klaim_produk`
--
ALTER TABLE `klaim_produk`
  MODIFY `id_klaim_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `klaim`
--
ALTER TABLE `klaim`
  ADD CONSTRAINT `klaim_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_member`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `klaim_produk`
--
ALTER TABLE `klaim_produk`
  ADD CONSTRAINT `klaim_produk_ibfk_1` FOREIGN KEY (`id_klaim`) REFERENCES `klaim` (`id_klaim`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
