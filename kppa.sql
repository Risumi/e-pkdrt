-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2019 at 02:18 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kppa`
--

-- --------------------------------------------------------

--
-- Table structure for table `kasus`
--
DROP TABLE IF EXISTS `kasus`;

CREATE TABLE IF NOT EXISTS `kasus` (
  `id_kasus` int(11) NOT NULL,
  `nomor_registrasi` varchar(100) NOT NULL,
  `hari` varchar(100) NOT NULL,
  `konselor` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kasus`
--

INSERT INTO `kasus` (`id_kasus`, `nomor_registrasi`, `hari`, `konselor`, `deskripsi`) VALUES
(1, '10/ppa/32', 'Selasa, 30 November 2019', 'new meow', 'telah terjadi');

-- --------------------------------------------------------

--
-- Table structure for table `korban`
--
DROP TABLE IF EXISTS `korban`;

CREATE TABLE IF NOT EXISTS `korban` (
  `id_korban` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `usia` int(11) NOT NULL,
  `ttl` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `pendidikan` varchar(20) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `pekerjaan` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `difabel` varchar(10) NOT NULL,
  `kdrt` varchar(10) NOT NULL,
  `tindak_kekerasan` varchar(100) NOT NULL,
  `kategori_trafficking` varchar(100) NOT NULL,
  `fk_id_kasus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `korban`
--

INSERT INTO `korban` (`id_korban`, `nama`, `jenis_kelamin`, `usia`, `ttl`, `alamat`, `telepon`, `pendidikan`, `agama`, `pekerjaan`, `status`, `difabel`, `kdrt`, `tindak_kekerasan`, `kategori_trafficking`, `fk_id_kasus`) VALUES
(1, 'Rizky w', 'Laki laki', 40, 'Banten, 30 Februri 1945', 'Banten selatan', '834353535424', 'S1/S2/S3', 'Islam', 'Swasta/Buruh', 'Belum Menikah', 'Tidak', 'Ya', 'Fisik,Eksploitasi', 'Perbudakan,Perdagangan Narkoba', 1),
(2, 'Nugi', 'Laki laki', 23, 'Plembang, 30 Februri 1945', 'Plembang', '8546372829', 'SMA', 'Islam', 'Swasta/Buruh', 'Belum Menikah', 'Tidak', 'Tidak', 'Seksual,Penelantaran,Trafficking', 'Perbudakan,Perdagangan Organ Tubuh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pelaku`
--
DROP TABLE IF EXISTS `pelaku`;

CREATE TABLE IF NOT EXISTS`pelaku` (
  `id_pelaku` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `usia` int(11) NOT NULL,
  `ttl` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `pendidikan` varchar(20) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `pekerjaan` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `difabel` varchar(10) NOT NULL,
  `hubungan_dengan_korban` varchar(100) NOT NULL,
  `fk_id_kasus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelaku`
--

INSERT INTO `pelaku` (`id_pelaku`, `nama`, `jenis_kelamin`, `usia`, `ttl`, `alamat`, `telepon`, `pendidikan`, `agama`, `pekerjaan`, `status`, `difabel`, `hubungan_dengan_korban`, `fk_id_kasus`) VALUES
(1, 'Taruna', 'Perempuan', 3, 'Sukabumi 05 mei 1990', 'Suab', '834321535424', 'SMP', 'Islam', 'Pelajar', 'Menikah', 'Tidak', 'teman', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pelayanan`
--
DROP TABLE IF EXISTS `pelayanan`;

CREATE TABLE IF NOT EXISTS`pelayanan` (
  `id_pelayanan` int(11) NOT NULL,
  `instansi` varchar(50) NOT NULL,
  `pelayanan` varchar(255) NOT NULL,
  `detail_pelayanan` text NOT NULL,
  `deskripsi_pelayanan` text NOT NULL,
  `fk_id_kasus` int(11) NOT NULL,
  `fk_id_korban` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelayanan`
--

INSERT INTO `pelayanan` (`id_pelayanan`, `instansi`, `pelayanan`, `detail_pelayanan`, `deskripsi_pelayanan`, `fk_id_kasus`, `fk_id_korban`) VALUES
(1, 'Bapas', 'Reintegrasi Sosial', 'Konseling Psikologi Korban Berkoordinasi dengan kelurahan, babinkhamtibmas, RT, RW untuk dilakukan mediasi antara pelapor dan terlapor terkait permasalahan', 'deskrip Konseling Psikologi Korban Berkoordinasi dengan kelurahan, babinkhamtibmas, RT, RW untuk dilakukan mediasi antara pelapor dan terlapor terkait permasalahan', 1, 1),
(2, 'Dinas Kesehatan', 'Reintegrasi Sosial kedua', 'pelayanan kedua', 'pelayanan kedua', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `penanganan`
--
DROP TABLE IF EXISTS `penanganan`;

CREATE TABLE IF NOT EXISTS `penanganan` (
  `id_penanganan` int(11) NOT NULL,
  `instansi` varchar(50) NOT NULL,
  `jenis_proses` varchar(50) NOT NULL,
  `deskripsi_proses` text NOT NULL,
  `fk_id_kasus` int(11) NOT NULL,
  `fk_id_pelaku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penanganan`
--

INSERT INTO `penanganan` (`id_penanganan`, `instansi`, `jenis_proses`, `deskripsi_proses`, `fk_id_kasus`, `fk_id_pelaku`) VALUES
(1, 'Dinas Kesehatan', 'Penyidikan', 'Dinas Kesehatan', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rujukan`
--

DROP TABLE IF EXISTS `rujukan`;

CREATE TABLE IF NOT EXISTS `rujukan` (
  `id_rujukan` int(11) NOT NULL,
  `tanggal_rujukan` varchar(100) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `instansi` varchar(40) NOT NULL,
  `deskripsi_rujukan` text NOT NULL,
  `fk_id_korban` int(11) NOT NULL,
  `fk_id_kasus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rujukan`
--

INSERT INTO `rujukan` (`id_rujukan`, `tanggal_rujukan`, `kota`, `instansi`, `deskripsi_rujukan`, `fk_id_korban`, `fk_id_kasus`) VALUES
(1, 'Jumat 8 nov 2019', 'Malang', 'UPPA Polresta', 'Deskripsi dari rujukan', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kasus`
--
ALTER TABLE `kasus`
  ADD PRIMARY KEY (`id_kasus`);

--
-- Indexes for table `korban`
--
ALTER TABLE `korban`
  ADD PRIMARY KEY (`id_korban`);

--
-- Indexes for table `pelaku`
--
ALTER TABLE `pelaku`
  ADD PRIMARY KEY (`id_pelaku`);

--
-- Indexes for table `pelayanan`
--
ALTER TABLE `pelayanan`
  ADD PRIMARY KEY (`id_pelayanan`);

--
-- Indexes for table `penanganan`
--
ALTER TABLE `penanganan`
  ADD PRIMARY KEY (`id_penanganan`);

--
-- Indexes for table `rujukan`
--
ALTER TABLE `rujukan`
  ADD PRIMARY KEY (`id_rujukan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kasus`
--
ALTER TABLE `kasus`
  MODIFY `id_kasus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `korban`
--
ALTER TABLE `korban`
  MODIFY `id_korban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pelaku`
--
ALTER TABLE `pelaku`
  MODIFY `id_pelaku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pelayanan`
--
ALTER TABLE `pelayanan`
  MODIFY `id_pelayanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penanganan`
--
ALTER TABLE `penanganan`
  MODIFY `id_penanganan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rujukan`
--
ALTER TABLE `rujukan`
  MODIFY `id_rujukan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
