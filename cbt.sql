-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.0.30 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk cbt
CREATE DATABASE IF NOT EXISTS `cbt` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cbt`;

-- membuang struktur untuk table cbt.cbt_dosen
CREATE TABLE IF NOT EXISTS `cbt_dosen` (
  `nip` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_dosen` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table cbt.cbt_jawaban
CREATE TABLE IF NOT EXISTS `cbt_jawaban` (
  `kd_jawaban` int NOT NULL AUTO_INCREMENT,
  `thn_akademik` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `semester` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kd_kelas` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kd_progstudi` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kd_matkul` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kd_soal` int NOT NULL,
  `jawaban` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gambar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `npm` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_insert` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `hasil_nilai` int NOT NULL,
  PRIMARY KEY (`kd_jawaban`)
) ENGINE=InnoDB AUTO_INCREMENT=74985 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table cbt.cbt_kelas
CREATE TABLE IF NOT EXISTS `cbt_kelas` (
  `kd_kelas` varchar(1) NOT NULL,
  PRIMARY KEY (`kd_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table cbt.cbt_kontrak_matakuliah
CREATE TABLE IF NOT EXISTS `cbt_kontrak_matakuliah` (
  `id_kontrak_matakuliah` int NOT NULL AUTO_INCREMENT,
  `npm` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `semester` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `kd_matkul` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `thn_akademik` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nilai_uts` int NOT NULL DEFAULT '0',
  `nilai_uas` int NOT NULL DEFAULT '0',
  `akses_ujian` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kontrak_matakuliah`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3014 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table cbt.cbt_kontrak_matkul
CREATE TABLE IF NOT EXISTS `cbt_kontrak_matkul` (
  `kd_kontrak_matkul` int NOT NULL AUTO_INCREMENT,
  `kd_matkul` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `thn_akademik` varchar(10) NOT NULL,
  `nip` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `semester` char(2) NOT NULL,
  `kd_kelas` char(50) NOT NULL,
  `kd_progstudi` int NOT NULL,
  PRIMARY KEY (`kd_kontrak_matkul`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=943 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table cbt.cbt_mahasiswa
CREATE TABLE IF NOT EXISTS `cbt_mahasiswa` (
  `id_siswa` int NOT NULL AUTO_INCREMENT,
  `npm` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_mahasiswa` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kd_kelas` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kd_progstudi` int NOT NULL,
  PRIMARY KEY (`id_siswa`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table cbt.cbt_matkul
CREATE TABLE IF NOT EXISTS `cbt_matkul` (
  `kd_matkul` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mata_kuliah` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`kd_matkul`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table cbt.cbt_perhitungan_algoritma
CREATE TABLE IF NOT EXISTS `cbt_perhitungan_algoritma` (
  `kd_hasil` int NOT NULL AUTO_INCREMENT,
  `kd_jawaban` int NOT NULL,
  `jawaban_mahasiswa` text NOT NULL,
  `kunci_jawaban` text NOT NULL,
  `winnowing_jawaban` text NOT NULL,
  `winnowing_kunci_jawaban` text NOT NULL,
  `dot_product` float NOT NULL DEFAULT '0',
  `magnitude_esai` float NOT NULL DEFAULT '0',
  `magnitude_kunci_jawaban` float NOT NULL DEFAULT '0',
  `similarity` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`kd_hasil`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table cbt.cbt_progstudi
CREATE TABLE IF NOT EXISTS `cbt_progstudi` (
  `kd_progstudi` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `nama_progstudi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`kd_progstudi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table cbt.cbt_soal
CREATE TABLE IF NOT EXISTS `cbt_soal` (
  `kd_soal` int NOT NULL AUTO_INCREMENT,
  `kd_progstudi` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `semester` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kd_kelas` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kd_matkul` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `nip` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `soal` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bobot_soal` int NOT NULL,
  `kunci_jawaban` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gambar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `thn_akademik` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ctype` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '3=UTS;4=UAS',
  `aktif` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '0=Tidak Aktif;1=Aktif',
  `dentry` datetime NOT NULL,
  `dupdate` datetime NOT NULL,
  PRIMARY KEY (`kd_soal`)
) ENGINE=InnoDB AUTO_INCREMENT=4891 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table cbt.thn_akademik
CREATE TABLE IF NOT EXISTS `thn_akademik` (
  `thn_akademik` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Pengeluaran data tidak dipilih.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
