-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2024 at 08:05 AM
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
-- Table structure for table `hasil_algoritma`
--

CREATE TABLE `hasil_algoritma` (
  `id_hasil` int(11) NOT NULL,
  `pre_processing_jawaban` text NOT NULL,
  `pre_processing_kj` text NOT NULL,
  `tokenisasi_jawaban` text NOT NULL,
  `tokenisasi_kj` text NOT NULL,
  `hashing_jawaban` text NOT NULL,
  `hashing_kj` text NOT NULL,
  `winnowing_jawaban` text NOT NULL,
  `winnowing_kj` text NOT NULL,
  `similarity` text NOT NULL,
  `skor` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil_algoritma`
--

INSERT INTO `hasil_algoritma` (`id_hasil`, `pre_processing_jawaban`, `pre_processing_kj`, `tokenisasi_jawaban`, `tokenisasi_kj`, `hashing_jawaban`, `hashing_kj`, `winnowing_jawaban`, `winnowing_kj`, `similarity`, `skor`) VALUES
(1, '\"bahasa pemrograman bahasa instruksi komputer pecah masalah\"', '\"bahasa pemrograman perangkat atur instruksi tentu tulis program komputer\"', '[\"ba\",\"ah\",\"ha\",\"as\",\"sa\",\"ap\",\"pe\",\"em\",\"mr\",\"ro\",\"og\",\"gr\",\"ra\",\"am\",\"ma\",\"an\",\"nb\",\"ba\",\"ah\",\"ha\",\"as\",\"sa\",\"ai\",\"in\",\"ns\",\"st\",\"tr\",\"ru\",\"uk\",\"ks\",\"si\",\"ik\",\"ko\",\"om\",\"mp\",\"pu\",\"ut\",\"te\",\"er\",\"rp\",\"pe\",\"ec\",\"ca\",\"ah\",\"hm\",\"ma\",\"as\",\"sa\",\"al\",\"la\",\"ah\"]', '[\"ba\",\"ah\",\"ha\",\"as\",\"sa\",\"ap\",\"pe\",\"em\",\"mr\",\"ro\",\"og\",\"gr\",\"ra\",\"am\",\"ma\",\"an\",\"np\",\"pe\",\"er\",\"ra\",\"an\",\"ng\",\"gk\",\"ka\",\"at\",\"ta\",\"at\",\"tu\",\"ur\",\"ri\",\"in\",\"ns\",\"st\",\"tr\",\"ru\",\"uk\",\"ks\",\"si\",\"it\",\"te\",\"en\",\"nt\",\"tu\",\"ut\",\"tu\",\"ul\",\"li\",\"is\",\"sp\",\"pr\",\"ro\",\"og\",\"gr\",\"ra\",\"am\",\"mk\",\"ko\",\"om\",\"mp\",\"pu\",\"ut\",\"te\",\"er\"]', '[46561461,46223235,49310750,46416497,54335559,46366408,53033247,48150413,51891876,54118889,52614359,49140695,53876452,46310986,51592261,46328906,52058181,46561461,46223235,49310743,46416324,54331067,46249618,49996710,52370097,54671269,55094869,54227083,55427401,50991545,54473047,49941094,50924081,52718990,51861105,53318860,55576360,54864469,48236677,54134723,53026038,47962985,47018731,46230897,49509947,51595626,46416389]', '[46561461,46223235,49310750,46416497,54335559,46366408,53033247,48150413,51891876,54118889,52614359,49140695,53876452,46311000,51592629,46338484,52307209,53036184,48226775,53877281,46332539,52152658,49017845,50682358,46434193,54795660,46447649,55145512,55543811,54018210,49996710,52370097,54671269,55094869,54227083,55427410,50991769,54478872,50092548,54861885,48169510,52388401,55147174,55587013,55141461,55438482,51279654,50082507,54600805,53262804,54118889,52614359,49140705,53876713,46317783,51768998,50924081,52718990,51861105]', '[46223235,46223235,46366408,46366408,46366408,46366408,48150413,46310986,46310986,46310986,46310986,46310986,46223235,46223235,46223235,46223235,46223235,46223235,46223235,46249618,46249618,46249618,46249618,49996710,50991545,49941094,49941094,49941094,49941094,49941094,49941094,49941094,48236677,48236677,48236677,47962985,47018731,46230897,46230897,46230897]', '[46223235,46223235,46366408,46366408,46366408,46366408,48150413,46311000,46311000,46311000,46311000,46311000,46311000,46311000,46332539,46332539,46332539,46332539,46332539,46332539,46332539,46434193,46434193,46434193,46434193,46447649,46447649,49996710,49996710,49996710,49996710,50991769,50092548,50092548,48169510,48169510,48169510,48169510,48169510,48169510,48169510,50082507,50082507,50082507,50082507,50082507,49140705,49140705,46317783,46317783,46317783,46317783]', '0.87160777872228', '4');

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
(11, 'PL22', 12342, 'John Doe', 'Bahasa pemrograman adalah instruksi yang digunakan oleh programmer untuk menentukan perilaku komputer.', 30),
(12, 'PL22', 12343, 'Mike', 'Bahasa pemrograman mudah digunakan.', 15),
(13, 'PL22', 12341, 'Jane Doe', 'Bahasa pemrograman adalah bahasa yang dibuat untuk memberikan instruksi kepada komputer guna memecahkan permasalahan.', 30);

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
('PL22', 'PL', 'Apa yang dimaksud dengan bahasa pemrograman?', 4, 30, 'Bahasa pemrograman adalah seperangkat aturan dan instruksi yang digunakan untuk menentukan cara menulis program komputer'),
('PL32', 'PL', 'Apa perbedaan antara bahasa pemrograman tingkat rendah dan tingkat tinggi?', 6, 20, 'Bahasa pemrograman tingkat rendah berorientasi pada bahasa mesin atau bahasa biner yang dapat dimengerti oleh komputer dan lebih sulit dipahami oleh manusia.\r\nBahasa pemrograman tingkat tinggi berorientasi pada bahasa manusia sehingga lebih mudah dipahami oleh manusia yang memiliki fitur dan abstraksi sehingga memungkinkan untuk mengekspresikan algoritma dengan mudah. ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hasil_algoritma`
--
ALTER TABLE `hasil_algoritma`
  ADD PRIMARY KEY (`id_hasil`);

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
-- AUTO_INCREMENT for table `hasil_algoritma`
--
ALTER TABLE `hasil_algoritma`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jawaban_mahasiswa`
--
ALTER TABLE `jawaban_mahasiswa`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
