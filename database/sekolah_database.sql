-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2022 at 02:17 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sekolah_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `golongan`
--

CREATE TABLE `golongan` (
  `kd_golongan` char(4) NOT NULL,
  `golongan` varchar(15) NOT NULL,
  `gaji` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `golongan`
--

INSERT INTO `golongan` (`kd_golongan`, `golongan`, `gaji`) VALUES
('1111', 'Golongan I', 2500000),
('2222', 'Golongan II', 3000000),
('3333', 'Golongan III', 35000000),
('4444', 'Golongan IV', 4000000);

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `nip` char(18) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jns_kelamin` varchar(10) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `bidang_studi` varchar(20) NOT NULL,
  `kd_golongan` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nip`, `nama`, `jns_kelamin`, `tgl_lahir`, `alamat`, `no_telp`, `bidang_studi`, `kd_golongan`) VALUES
('1234567890112343', 'Ria Nadiatama', 'Perempuan', '1994-01-05', 'Jl. Mekar No.99', '089612345679', 'Matematika', '3333'),
('1234567890112344', 'Muhammad Zain', 'Laki-laki', '2022-01-06', 'Jl. Apel No.24', '089612345679', 'Sastra Jepang', '2222'),
('1963122419123452', 'Dea Aryananda', 'Perempuan', '2022-01-01', 'Jl. Dua Puluh No.20', '081212345678', 'Bahasa Inggris', '1111'),
('1963122419890030', 'Reynara Ghavin', 'Laki-laki', '2022-01-16', 'Jl. Lurus No.1', '081212345678', 'Bahasa Indonesia', '2222'),
('1963122419899008', 'Akaela Karina', 'Perempuan', '1997-01-11', 'Jl. Mawar No.9', '089612345678', 'Ekonomi', '3333'),
('1963122419899065', 'Ahmad Hafidzi', 'Laki-laki', '1963-02-02', 'Jl. Dharma No.23', '089612345234', 'Fisika', '4444'),
('1963122419899999', 'Edward Bramhiers', 'Laki-laki', '1995-01-01', 'Jl. Kerikil No.12', '081212345678', 'Kimia', '1111'),
('1983122419899111', 'Aveera Narudhana', 'Perempuan', '1983-02-13', 'Jl. Terusan No.32', '089612345777', 'Sosiologi', '2222'),
('19931224198999999', 'Arisha Hanifa', 'Perempuan', '1983-02-04', 'Jl. Hidrogen No.1', '089612345676', 'Biologi', '3333');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_pelajaran`
--

CREATE TABLE `jadwal_pelajaran` (
  `kd_jadwal` char(5) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `waktu` time NOT NULL,
  `jmlh_jam` int(3) NOT NULL,
  `kd_kelas` char(4) NOT NULL,
  `nip` char(18) NOT NULL,
  `kd_mapel` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal_pelajaran`
--

INSERT INTO `jadwal_pelajaran` (`kd_jadwal`, `hari`, `waktu`, `jmlh_jam`, `kd_kelas`, `nip`, `kd_mapel`) VALUES
('11111', 'Senin', '08:00:00', 3, 'B100', '1234567890112343', '1004'),
('11112', 'Senin', '09:00:00', 4, 'B100', '1963122419899999', '1002'),
('11113', 'Senin', '14:00:00', 2, 'B100', '1963122419899999', '1003'),
('11114', 'Senin', '11:00:00', 3, 'B100', '1963122419899999', '1004');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kd_kelas` char(4) NOT NULL,
  `jurusan` varchar(20) NOT NULL,
  `tingkat` varchar(5) NOT NULL,
  `jmlh_siswa` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kd_kelas`, `jurusan`, `tingkat`, `jmlh_siswa`) VALUES
('B100', 'Bahasa', '10', 72),
('B110', 'Bahasa', '11', 60),
('B120', 'Bahasa', '12', 55),
('M100', 'MIPA', '10', 150),
('M110', 'MIPA', '11', 147),
('M120', 'MIPA', '12', 152),
('S100', 'Sosial', '10', 170),
('S110', 'Sosial', '11', 163),
('S120', 'Sosial', '12', 176);

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `kd_mapel` char(4) NOT NULL,
  `nama_mapel` varchar(29) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`kd_mapel`, `nama_mapel`) VALUES
('1000', 'Matematika'),
('1001', 'Biologi'),
('1002', 'Bahasa Inggris'),
('1003', 'Fisika'),
('1004', 'Bahasa Indonesia'),
('1005', 'Kimia'),
('1006', 'Ekonomi'),
('1007', 'Sosiologi'),
('1008', 'Sejarah'),
('1009', 'Sastra Jepang');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` char(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jns_kelamin` varchar(10) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `kd_kelas` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `nama`, `jns_kelamin`, `alamat`, `kd_kelas`) VALUES
('12311000', 'Eren Yaeger', 'Laki-laki', 'Jalan Satu Nusa No.30', 'B110'),
('12311110', 'Arya Firdaus', 'Laki-laki', 'Jalan 123', 'B110'),
('12311115', 'Reina Radiatama', 'Perempuan', 'Jalan S No.32', 'M120'),
('12311123', 'Ahmad Zaidan', 'Laki-laki', 'Jalan Kosong No.18', 'B120');

-- --------------------------------------------------------

--
-- Table structure for table `spp`
--

CREATE TABLE `spp` (
  `no_kuitansi` char(10) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `ket_bayar` varchar(20) NOT NULL,
  `total` int(8) NOT NULL,
  `nis` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spp`
--

INSERT INTO `spp` (`no_kuitansi`, `tgl_bayar`, `ket_bayar`, `total`, `nis`) VALUES
('1111111115', '2022-01-15', 'Lunas', 600000, '12311115'),
('1111111121', '2022-01-15', 'Lunas', 600000, '12311123'),
('1111131121', '2022-01-13', 'lunas', 300000, '12311123');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(4) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_type`) VALUES
(32, 'adminhero', '$2y$10$Em2fpkQCFUtgb4QC3AHhtOQvds0JSD5.QczLbfe.IR9pK2LieOmhO', 'Super Admin'),
(33, 'admin', '$2y$10$3BGm.lUKGiHHcY0RhXqNPud94D.u/9dME4cAo9uk0W7VXjkHtujSC', 'Admin'),
(34, 'wahni', '$2y$10$5hE4WvANMSTr8houzRKlw..owfcoKhAtS54Iy7k3qnOTC8yPRaMde', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`kd_golongan`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `jadwal_pelajaran`
--
ALTER TABLE `jadwal_pelajaran`
  ADD PRIMARY KEY (`kd_jadwal`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kd_kelas`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`kd_mapel`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`no_kuitansi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
