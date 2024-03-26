-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2024 at 06:56 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `essay-scoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_mahasiswa`
--

CREATE TABLE `jawaban_mahasiswa` (
  `id_jawaban` int(11) NOT NULL,
  `kd_soal` varchar(6) NOT NULL,
  `npm` int(8) NOT NULL,
  `nama_mahasiswa` varchar(50) NOT NULL,
  `jawaban` text NOT NULL,
  `nilai` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jawaban_mahasiswa`
--

INSERT INTO `jawaban_mahasiswa` (`id_jawaban`, `kd_soal`, `npm`, `nama_mahasiswa`, `jawaban`, `nilai`) VALUES
(1, 'PL22', 12341, 'Jane Doe', 'Bahasa pemrograman adalah bahasa yang dibuat untuk memberikan instruksi kepada komputer guna memecahkan permasalahan', 0),
(2, 'PL22', 12342, 'John Doe', 'Bahasa pemrograman adalah instruksi yang digunakan oleh programmer untuk menentukan perilaku komputer', 0),
(3, 'PL22', 12343, 'Mike', 'Bahasa pemrograman adalah cara bagi programmer untuk memberikan instruksi kepada komputer', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `kd_matkul` varchar(6) NOT NULL,
  `nama_matkul` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`kd_matkul`, `nama_matkul`) VALUES
('DBMS', 'Database Management System'),
('PL', 'Programming Language'),
('WP', 'Web Programming');

-- --------------------------------------------------------

--
-- Table structure for table `soal_esai`
--

CREATE TABLE `soal_esai` (
  `kd_soal` varchar(6) NOT NULL,
  `kd_matkul` varchar(6) NOT NULL,
  `soal` text NOT NULL,
  `skor` int(1) NOT NULL,
  `bobot` int(3) NOT NULL,
  `kunci_jawaban` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `soal_esai`
--

INSERT INTO `soal_esai` (`kd_soal`, `kd_matkul`, `soal`, `skor`, `bobot`, `kunci_jawaban`) VALUES
('PL22', 'PL', 'Apa yang dimaksud dengan bahasa pemrograman?', 3, 10, 'Bahasa pemrograman adalah seperangkat aturan dan instruksi yang digunakan untuk menentukan cara menulis program komputer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jawaban_mahasiswa`
--
ALTER TABLE `jawaban_mahasiswa`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`kd_matkul`);

--
-- Indexes for table `soal_esai`
--
ALTER TABLE `soal_esai`
  ADD PRIMARY KEY (`kd_soal`),
  ADD KEY `kd_matkul` (`kd_matkul`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jawaban_mahasiswa`
--
ALTER TABLE `jawaban_mahasiswa`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
