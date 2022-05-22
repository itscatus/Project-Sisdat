-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2022 at 06:49 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi_perkuliahan`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` varchar(25) NOT NULL,
  `nip_dosen` varchar(25) NOT NULL,
  `npm_mhs` varchar(15) NOT NULL,
  `kode_matkul` varchar(20) NOT NULL,
  `media_bljr` varchar(255) NOT NULL,
  `materi_bljr` varchar(255) NOT NULL,
  `status_absensi` varchar(12) NOT NULL,
  `tgl_absensi` date NOT NULL,
  `jam_mulai` datetime NOT NULL,
  `jam_selesai` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `nip_dosen`, `npm_mhs`, `kode_matkul`, `media_bljr`, `materi_bljr`, `status_absensi`, `tgl_absensi`, `jam_mulai`, `jam_selesai`) VALUES
('20220517-012.210005', '0001', '140810210005', 'D10H.2201-210005', 'Live', 'Listrik', 'Hadir', '2022-05-17', '2022-05-17 08:00:00', '2022-05-17 10:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(20) NOT NULL,
  `nama_admin` varchar(30) NOT NULL,
  `email_admin` varchar(50) NOT NULL,
  `telp_admin` varchar(50) NOT NULL,
  `alamat_admin` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email_admin`, `telp_admin`, `alamat_admin`, `password`) VALUES
('admin001', 'Fel', '', '', '', '2d35e1191dc40b8f8cb3f1abcb6ace03');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nip_dosen` varchar(25) NOT NULL,
  `kode_fakultas` int(6) NOT NULL,
  `kode_prodi` int(6) NOT NULL,
  `nama_dosen` varchar(50) NOT NULL,
  `golongan` varchar(3) NOT NULL,
  `telp_dosen` varchar(13) NOT NULL,
  `email_dosen` varchar(30) NOT NULL,
  `gelar_dosen` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nip_dosen`, `kode_fakultas`, `kode_prodi`, `nama_dosen`, `golongan`, `telp_dosen`, `email_dosen`, `gelar_dosen`, `password`) VALUES
('0001', 140000, 140810, 'Budi', '', '', '', '', 'e10adc3949ba59abbe56e057f20f883e'),
('0002', 140000, 140810, 'Adi', 'IV', '08889282982', 'adi8101@gmail.com', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `kode_fakultas` int(6) NOT NULL,
  `kode_univ` int(6) NOT NULL,
  `nama_fakultas` varchar(50) NOT NULL,
  `alamat_fakultas` varchar(50) NOT NULL,
  `telp_fakultas` varchar(12) NOT NULL,
  `email_fakultas` varchar(30) NOT NULL,
  `nama_dekan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`kode_fakultas`, `kode_univ`, `nama_fakultas`, `alamat_fakultas`, `telp_fakultas`, `email_fakultas`, `nama_dekan`) VALUES
(140000, 1007, 'Fakultas Matematika dan Ilmu Pengetahuan Alam', '', '', '', 'Iman Rahayu');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `npm_mhs` varchar(15) NOT NULL,
  `kode_fakultas` int(6) NOT NULL,
  `kode_prodi` int(6) NOT NULL,
  `nip_dosen` varchar(25) NOT NULL,
  `nama_mhs` varchar(50) NOT NULL,
  `kelas_mhs` varchar(1) NOT NULL,
  `jk_mhs` char(2) NOT NULL,
  `thn_angkatan` int(4) NOT NULL,
  `email_mhs` varchar(50) NOT NULL,
  `telp_mhs` varchar(15) NOT NULL,
  `alamat_mhs` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`npm_mhs`, `kode_fakultas`, `kode_prodi`, `nip_dosen`, `nama_mhs`, `kelas_mhs`, `jk_mhs`, `thn_angkatan`, `email_mhs`, `telp_mhs`, `alamat_mhs`, `password`) VALUES
('140810210005', 140000, 140810, '0001', 'Aliya Rahmania', 'A', 'P', 2021, '', '', 'Bandung', '827ccb0eea8a706c4c34a16891f84e7b'),
('140810210017', 140000, 140810, '0001', 'Adinda Salsabila', 'A', 'P', 2021, '', '', '', 'cd9cf7fdc96afab1d657061f69957cd9');

-- --------------------------------------------------------

--
-- Table structure for table `perkuliahan`
--

CREATE TABLE `perkuliahan` (
  `kode_matkul` varchar(20) NOT NULL,
  `nip_dosen` varchar(25) NOT NULL,
  `npm_mhs` varchar(15) NOT NULL,
  `kode_ruangan` varchar(15) NOT NULL,
  `nama_matkul` varchar(50) NOT NULL,
  `jml_sks` int(1) NOT NULL,
  `semester` varchar(8) NOT NULL,
  `thn_akademik` year(4) NOT NULL,
  `jadwal_kuliah` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perkuliahan`
--

INSERT INTO `perkuliahan` (`kode_matkul`, `nip_dosen`, `npm_mhs`, `kode_ruangan`, `nama_matkul`, `jml_sks`, `semester`, `thn_akademik`, `jadwal_kuliah`) VALUES
('D10H.2201-210005', '0001', '140810210005', '0201-0726-0204', 'Fisika Informatika', 2, '2-Genap', 2022, 'Rabu, 08.00-10.30'),
('D10H.2201-210017', '0001', '140810210017', '0201-0726-0204', 'Fisika Informatika', 2, '2-Genap', 2022, 'Rabu, 08.00-10.30');

-- --------------------------------------------------------

--
-- Table structure for table `program_studi`
--

CREATE TABLE `program_studi` (
  `kode_prodi` int(6) NOT NULL,
  `kode_fakultas` int(6) NOT NULL,
  `nama_prodi` varchar(50) NOT NULL,
  `jenjang` varchar(10) NOT NULL,
  `telp_prodi` varchar(13) NOT NULL,
  `email_prodi` varchar(30) NOT NULL,
  `nama_kaprodi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program_studi`
--

INSERT INTO `program_studi` (`kode_prodi`, `kode_fakultas`, `nama_prodi`, `jenjang`, `telp_prodi`, `email_prodi`, `nama_kaprodi`) VALUES
(140810, 140000, 'Teknik Informatika', 'Sarjana', '', '', 'Juli Rejito');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `kode_ruangan` varchar(15) NOT NULL,
  `lokasi_ruangan` varchar(30) NOT NULL,
  `kapasitas` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`kode_ruangan`, `lokasi_ruangan`, `kapasitas`) VALUES
('0201-0724-0206', 'Gedung PPBS A', 90),
('0201-0726-0204', 'Gedung PPBS B', 0);

-- --------------------------------------------------------

--
-- Table structure for table `universitas`
--

CREATE TABLE `universitas` (
  `kode_univ` int(6) NOT NULL,
  `nama_univ` varchar(30) NOT NULL,
  `alamat_univ` varchar(255) NOT NULL,
  `telp_univ` varchar(12) NOT NULL,
  `email_univ` varchar(20) NOT NULL,
  `nama_rektor` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `universitas`
--

INSERT INTO `universitas` (`kode_univ`, `nama_univ`, `alamat_univ`, `telp_univ`, `email_univ`, `nama_rektor`) VALUES
(1007, 'Universitas Padjadjaran', 'Jalan Raya Bandung Sumedang KM 21 Jatinangor, Kab. Sumedang - Prov. Jawa Barat - Indonesia, 45363', '022-84288888', 'humas@unpad.ac.id', 'Rina Indiastuti');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `pk_matkul` (`kode_matkul`),
  ADD KEY `pk_dosen3` (`nip_dosen`),
  ADD KEY `pk_mhs2` (`npm_mhs`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nip_dosen`),
  ADD KEY `pk_prodi2` (`kode_prodi`),
  ADD KEY `pk_fakultas2` (`kode_fakultas`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`kode_fakultas`),
  ADD KEY `pk_univ` (`kode_univ`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`npm_mhs`),
  ADD KEY `pk_dosen` (`nip_dosen`),
  ADD KEY `pk_prodi` (`kode_prodi`),
  ADD KEY `pk_fakultas` (`kode_fakultas`);

--
-- Indexes for table `perkuliahan`
--
ALTER TABLE `perkuliahan`
  ADD PRIMARY KEY (`kode_matkul`),
  ADD KEY `pk_dosen2` (`nip_dosen`),
  ADD KEY `pk_ruangan` (`kode_ruangan`),
  ADD KEY `pk_mhs` (`npm_mhs`);

--
-- Indexes for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD PRIMARY KEY (`kode_prodi`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`kode_ruangan`);

--
-- Indexes for table `universitas`
--
ALTER TABLE `universitas`
  ADD PRIMARY KEY (`kode_univ`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `kode_fakultas` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140001;

--
-- AUTO_INCREMENT for table `program_studi`
--
ALTER TABLE `program_studi`
  MODIFY `kode_prodi` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140811;

--
-- AUTO_INCREMENT for table `universitas`
--
ALTER TABLE `universitas`
  MODIFY `kode_univ` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1008;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `pk_dosen3` FOREIGN KEY (`nip_dosen`) REFERENCES `dosen` (`nip_dosen`),
  ADD CONSTRAINT `pk_matkul` FOREIGN KEY (`kode_matkul`) REFERENCES `perkuliahan` (`kode_matkul`),
  ADD CONSTRAINT `pk_mhs2` FOREIGN KEY (`npm_mhs`) REFERENCES `mahasiswa` (`npm_mhs`);

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `pk_fakultas2` FOREIGN KEY (`kode_fakultas`) REFERENCES `fakultas` (`kode_fakultas`),
  ADD CONSTRAINT `pk_prodi2` FOREIGN KEY (`kode_prodi`) REFERENCES `program_studi` (`kode_prodi`);

--
-- Constraints for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD CONSTRAINT `pk_univ` FOREIGN KEY (`kode_univ`) REFERENCES `universitas` (`kode_univ`);

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `pk_dosen` FOREIGN KEY (`nip_dosen`) REFERENCES `dosen` (`nip_dosen`),
  ADD CONSTRAINT `pk_fakultas` FOREIGN KEY (`kode_fakultas`) REFERENCES `fakultas` (`kode_fakultas`),
  ADD CONSTRAINT `pk_prodi` FOREIGN KEY (`kode_prodi`) REFERENCES `program_studi` (`kode_prodi`);

--
-- Constraints for table `perkuliahan`
--
ALTER TABLE `perkuliahan`
  ADD CONSTRAINT `pk_dosen2` FOREIGN KEY (`nip_dosen`) REFERENCES `dosen` (`nip_dosen`),
  ADD CONSTRAINT `pk_mhs` FOREIGN KEY (`npm_mhs`) REFERENCES `mahasiswa` (`npm_mhs`),
  ADD CONSTRAINT `pk_ruangan` FOREIGN KEY (`kode_ruangan`) REFERENCES `ruangan` (`kode_ruangan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
