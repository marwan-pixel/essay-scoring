-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Apr 2024 pada 08.13
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

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
-- Struktur dari tabel `hasil_algoritma`
--

CREATE TABLE `hasil_algoritma` (
  `id_hasil` int(11) NOT NULL,
  `kd_jawaban` int(11) NOT NULL,
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
-- Dumping data untuk tabel `hasil_algoritma`
--

INSERT INTO `hasil_algoritma` (`id_hasil`, `kd_jawaban`, `pre_processing_jawaban`, `pre_processing_kj`, `tokenisasi_jawaban`, `tokenisasi_kj`, `hashing_jawaban`, `hashing_kj`, `winnowing_jawaban`, `winnowing_kj`, `similarity`, `skor`) VALUES
(1, 11, '\"bahasa pemrograman bahasa instruksi komputer pecah masalah\"', '\"bahasa pemrograman perangkat atur instruksi tentu tulis program komputer\"', '[\"ba\",\"ah\",\"ha\",\"as\",\"sa\",\"ap\",\"pe\",\"em\",\"mr\",\"ro\",\"og\",\"gr\",\"ra\",\"am\",\"ma\",\"an\",\"nb\",\"ba\",\"ah\",\"ha\",\"as\",\"sa\",\"ai\",\"in\",\"ns\",\"st\",\"tr\",\"ru\",\"uk\",\"ks\",\"si\",\"ik\",\"ko\",\"om\",\"mp\",\"pu\",\"ut\",\"te\",\"er\",\"rp\",\"pe\",\"ec\",\"ca\",\"ah\",\"hm\",\"ma\",\"as\",\"sa\",\"al\",\"la\",\"ah\"]', '[\"ba\",\"ah\",\"ha\",\"as\",\"sa\",\"ap\",\"pe\",\"em\",\"mr\",\"ro\",\"og\",\"gr\",\"ra\",\"am\",\"ma\",\"an\",\"np\",\"pe\",\"er\",\"ra\",\"an\",\"ng\",\"gk\",\"ka\",\"at\",\"ta\",\"at\",\"tu\",\"ur\",\"ri\",\"in\",\"ns\",\"st\",\"tr\",\"ru\",\"uk\",\"ks\",\"si\",\"it\",\"te\",\"en\",\"nt\",\"tu\",\"ut\",\"tu\",\"ul\",\"li\",\"is\",\"sp\",\"pr\",\"ro\",\"og\",\"gr\",\"ra\",\"am\",\"mk\",\"ko\",\"om\",\"mp\",\"pu\",\"ut\",\"te\",\"er\"]', '[46561461,46223235,49310750,46416497,54335559,46366408,53033247,48150413,51891876,54118889,52614359,49140695,53876452,46310986,51592261,46328906,52058181,46561461,46223235,49310743,46416324,54331067,46249618,49996710,52370097,54671269,55094869,54227083,55427401,50991545,54473047,49941094,50924081,52718990,51861105,53318860,55576360,54864469,48236677,54134723,53026038,47962985,47018731,46230897,49509947,51595626,46416389]', '[46561461,46223235,49310750,46416497,54335559,46366408,53033247,48150413,51891876,54118889,52614359,49140695,53876452,46311000,51592629,46338484,52307209,53036184,48226775,53877281,46332539,52152658,49017845,50682358,46434193,54795660,46447649,55145512,55543811,54018210,49996710,52370097,54671269,55094869,54227083,55427410,50991769,54478872,50092548,54861885,48169510,52388401,55147174,55587013,55141461,55438482,51279654,50082507,54600805,53262804,54118889,52614359,49140705,53876713,46317783,51768998,50924081,52718990,51861105]', '[46223235,46223235,46366408,46366408,46366408,46366408,48150413,46310986,46310986,46310986,46310986,46310986,46223235,46223235,46223235,46223235,46223235,46223235,46223235,46249618,46249618,46249618,46249618,49996710,50991545,49941094,49941094,49941094,49941094,49941094,49941094,49941094,48236677,48236677,48236677,47962985,47018731,46230897,46230897,46230897]', '[46223235,46223235,46366408,46366408,46366408,46366408,48150413,46311000,46311000,46311000,46311000,46311000,46311000,46311000,46332539,46332539,46332539,46332539,46332539,46332539,46332539,46434193,46434193,46434193,46434193,46447649,46447649,49996710,49996710,49996710,49996710,50991769,50092548,50092548,48169510,48169510,48169510,48169510,48169510,48169510,48169510,50082507,50082507,50082507,50082507,50082507,49140705,49140705,46317783,46317783,46317783,46317783]', '0.87160777872228', '4'),
(4, 18, '\"alam revolusi buku tarik buku peristiwa peristiwa tari tarik baca isi buku milik cerita unik tarik layak baca bahasa buku segi bahasa arang sederhana mikat kalimat susun paragraf mudah paham\"', '\"buku tema pengalamanpengalaman revolusi menarikdalam buku perisiwa peristiwa kait tarik pembacaisi buku cerita unikmenarik layak dibacadilihat segi bahasa arang sederhanaakan mikat kalimatkalimat paragraf susun runtut mudah paham\"', '[\"ala\",\"lam\",\"amr\",\"mre\",\"rev\",\"evo\",\"vol\",\"olu\",\"lus\",\"usi\",\"sib\",\"ibu\",\"buk\",\"uku\",\"kut\",\"uta\",\"tar\",\"ari\",\"rik\",\"ikb\",\"kbu\",\"buk\",\"uku\",\"kup\",\"upe\",\"per\",\"eri\",\"ris\",\"ist\",\"sti\",\"tiw\",\"iwa\",\"wap\",\"ape\",\"per\",\"eri\",\"ris\",\"ist\",\"sti\",\"tiw\",\"iwa\",\"wat\",\"ata\",\"tar\",\"ari\",\"rit\",\"ita\",\"tar\",\"ari\",\"rik\",\"ikb\",\"kba\",\"bac\",\"aca\",\"cai\",\"ais\",\"isi\",\"sib\",\"ibu\",\"buk\",\"uku\",\"kum\",\"umi\",\"mil\",\"ili\",\"lik\",\"ikc\",\"kce\",\"cer\",\"eri\",\"rit\",\"ita\",\"tau\",\"aun\",\"uni\",\"nik\",\"ikt\",\"kta\",\"tar\",\"ari\",\"rik\",\"ikl\",\"kla\",\"lay\",\"aya\",\"yak\",\"akb\",\"kba\",\"bac\",\"aca\",\"cab\",\"aba\",\"bah\",\"aha\",\"has\",\"asa\",\"sab\",\"abu\",\"buk\",\"uku\",\"kus\",\"use\",\"seg\",\"egi\",\"gib\",\"iba\",\"bah\",\"aha\",\"has\",\"asa\",\"saa\",\"aar\",\"ara\",\"ran\",\"ang\",\"ngs\",\"gse\",\"sed\",\"ede\",\"der\",\"erh\",\"rha\",\"han\",\"ana\",\"nam\",\"ami\",\"mik\",\"ika\",\"kat\",\"atk\",\"tka\",\"kal\",\"ali\",\"lim\",\"ima\",\"mat\",\"ats\",\"tsu\",\"sus\",\"usu\",\"sun\",\"unp\",\"npa\",\"par\",\"ara\",\"rag\",\"agr\",\"gra\",\"raf\",\"afm\",\"fmu\",\"mud\",\"uda\",\"dah\",\"ahp\",\"hpa\",\"pah\",\"aha\",\"ham\"]', '[\"buk\",\"uku\",\"kut\",\"ute\",\"tem\",\"ema\",\"map\",\"ape\",\"pen\",\"eng\",\"nga\",\"gal\",\"ala\",\"lam\",\"ama\",\"man\",\"anp\",\"npe\",\"pen\",\"eng\",\"nga\",\"gal\",\"ala\",\"lam\",\"ama\",\"man\",\"anr\",\"nre\",\"rev\",\"evo\",\"vol\",\"olu\",\"lus\",\"usi\",\"sim\",\"ime\",\"men\",\"ena\",\"nar\",\"ari\",\"rik\",\"ikd\",\"kda\",\"dal\",\"ala\",\"lam\",\"amb\",\"mbu\",\"buk\",\"uku\",\"kup\",\"upe\",\"per\",\"eri\",\"ris\",\"isi\",\"siw\",\"iwa\",\"wap\",\"ape\",\"per\",\"eri\",\"ris\",\"ist\",\"sti\",\"tiw\",\"iwa\",\"wak\",\"aka\",\"kai\",\"ait\",\"itt\",\"tta\",\"tar\",\"ari\",\"rik\",\"ikp\",\"kpe\",\"pem\",\"emb\",\"mba\",\"bac\",\"aca\",\"cai\",\"ais\",\"isi\",\"sib\",\"ibu\",\"buk\",\"uku\",\"kuc\",\"uce\",\"cer\",\"eri\",\"rit\",\"ita\",\"tau\",\"aun\",\"uni\",\"nik\",\"ikm\",\"kme\",\"men\",\"ena\",\"nar\",\"ari\",\"rik\",\"ikl\",\"kla\",\"lay\",\"aya\",\"yak\",\"akd\",\"kdi\",\"dib\",\"iba\",\"bac\",\"aca\",\"cad\",\"adi\",\"dil\",\"ili\",\"lih\",\"iha\",\"hat\",\"ats\",\"tse\",\"seg\",\"egi\",\"gib\",\"iba\",\"bah\",\"aha\",\"has\",\"asa\",\"saa\",\"aar\",\"ara\",\"ran\",\"ang\",\"ngs\",\"gse\",\"sed\",\"ede\",\"der\",\"erh\",\"rha\",\"han\",\"ana\",\"naa\",\"aak\",\"aka\",\"kan\",\"anm\",\"nmi\",\"mik\",\"ika\",\"kat\",\"atk\",\"tka\",\"kal\",\"ali\",\"lim\",\"ima\",\"mat\",\"atk\",\"tka\",\"kal\",\"ali\",\"lim\",\"ima\",\"mat\",\"atp\",\"tpa\",\"par\",\"ara\",\"rag\",\"agr\",\"gra\",\"raf\",\"afs\",\"fsu\",\"sus\",\"usu\",\"sun\",\"unr\",\"nru\",\"run\",\"unt\",\"ntu\",\"tut\",\"utm\",\"tmu\",\"mud\",\"uda\",\"dah\",\"ahp\",\"hpa\",\"pah\",\"aha\",\"ham\"]', '[1780511,1966728,1781621,1995592,2075119,1857938,2151929,2027101,1980395,2136960,2094885,1914877,1804439,2131882,1962837,2137444,2107457,1784773,2077524,1920477,1950029,1804439,2131878,1962737,2134844,2039857,1855085,2077750,1926341,2102505,2112987,1928558,2160129,1783324,2039857,1855085,2077750,1926341,2102505,2112987,1928562,2160229,1785924,2107457,1784782,2077757,1926532,2107457,1784773,2077524,1920457,1949501,1790691,1774423,1808441,1778947,1926048,2094885,1914877,1804439,2131875,1962663,2132914,1989677,1921325,1972069,1920487,1950296,1811369,1855086,2077757,1926535,2107540,1786929,2133589,2007238,1920925,1961684,2107457,1784773,2077534,1920717,1956283,1967023,1789297,2195148,1779849,1949501,1790691,1774416,1808241,1773746,1790821,1777813,1896563,1785232,2089477,1774269,1804439,2131881,1962815,2136861,2092299,1847632,1883953,1914354,1790821,1777813,1896563,1785231,2089448,1773505,1784568,2072199,1782025,2006079,1890794,2092217,1845516,1828944,1855041,2076600,1896433,1781863,2001871,1781393,1989643,1920450,1949327,1786167,2113778,1949117,1780719,1972119,1921802,1984487,1786395,2119713,2103439,2137284,2103304,2133761,2011708,2037145,1784561,2072028,1777561,1890016,2071997,1776775,1869578,1997573,2126618,1825988,1778185,1906242]', '[1804439,2131882,1962841,2137543,2110023,1851494,1984369,1783320,2039751,1852311,2005618,1878805,1780511,1966711,1781188,1984328,1782245,2011808,2039751,1852311,2005618,1878805,1780511,1966711,1781188,1984330,1782297,2013168,2075119,1857938,2151929,2027101,1980395,2136971,2095155,1921900,1987017,1852172,2002001,1784773,2077526,1920509,1950862,1826077,1780511,1966712,1781221,1985181,1804439,2131878,1962737,2134844,2039857,1855085,2077739,1926069,2095411,1928558,2160129,1783324,2039857,1855085,2077750,1926341,2102505,2112987,1928553,2159995,1779831,1949050,1778984,1927009,2119868,2107457,1784773,2077538,1920825,1959079,2039720,1851505,1984653,1790691,1774423,1808441,1778947,1926048,2094885,1914877,1804439,2131865,1962399,2126056,1811369,1855086,2077757,1926535,2107540,1786929,2133589,2007231,1920747,1957052,1987017,1852172,2002001,1784773,2077534,1920717,1956283,1967023,1789297,2195150,1779909,1951060,1831225,1914349,1790691,1774418,1808301,1775310,1831493,1921322,1971989,1918422,1896607,1786379,2119285,2092299,1847632,1883953,1914354,1790821,1777813,1896563,1785231,2089448,1773505,1784568,2072199,1782025,2006079,1890794,2092217,1845516,1828944,1855041,2076600,1896433,1781851,2001561,1773323,1779836,1949173,1782171,2009881,1989643,1920450,1949327,1786167,2113778,1949117,1780719,1972119,1921802,1984479,1786167,2113778,1949117,1780719,1972119,1921802,1984484,1786297,2117164,2037145,1784561,2072028,1777561,1890016,2072003,1776931,1873649,2103439,2137284,2103306,2133833,2013576,2085732,2133885,2014934,2121033,2137759,2115642,1997573,2126618,1825988,1778185,1906242]', '[1780511,1781621,1781621,1857938,1857938,1857938,1980395,1914877,1804439,1804439,1804439,1804439,1804439,1784773,1784773,1784773,1784773,1784773,1804439,1804439,1804439,1804439,1855085,1855085,1855085,1855085,1855085,1926341,1926341,1783324,1783324,1783324,1783324,1783324,1855085,1855085,1926341,1926341,1785924,1785924,1784782,1784782,1784782,1784782,1784773,1784773,1784773,1784773,1784773,1774423,1774423,1774423,1774423,1774423,1778947,1778947,1804439,1804439,1804439,1804439,1921325,1921325,1920487,1920487,1811369,1811369,1811369,1811369,1811369,1786929,1786929,1786929,1786929,1786929,1920925,1784773,1784773,1784773,1784773,1784773,1789297,1789297,1779849,1779849,1779849,1774416,1774416,1773746,1773746,1773746,1773746,1773746,1777813,1774269,1774269,1774269,1774269,1774269,1804439,1847632,1847632,1847632,1790821,1777813,1777813,1777813,1777813,1773505,1773505,1773505,1773505,1773505,1782025,1782025,1782025,1828944,1828944,1828944,1828944,1781863,1781863,1781393,1781393,1781393,1781393,1781393,1786167,1786167,1780719,1780719,1780719,1780719,1780719,1786395,1786395,1786395,1786395,2103304,2011708,2011708,1784561,1784561,1777561,1777561,1777561,1776775,1776775,1776775,1776775,1776775,1778185]', '[1804439,1851494,1851494,1783320,1783320,1783320,1783320,1783320,1780511,1780511,1780511,1780511,1780511,1781188,1781188,1782245,1782245,1852311,1780511,1780511,1780511,1780511,1780511,1781188,1781188,1782297,1782297,1857938,1857938,1857938,1980395,1921900,1921900,1852172,1852172,1784773,1784773,1784773,1784773,1784773,1780511,1780511,1780511,1780511,1780511,1781221,1781221,1804439,1804439,1855085,1855085,1855085,1855085,1855085,1926069,1783324,1783324,1783324,1783324,1783324,1855085,1855085,1926341,1926341,1779831,1779831,1778984,1778984,1778984,1778984,1778984,1784773,1784773,1784773,1784773,1851505,1851505,1790691,1774423,1774423,1774423,1774423,1774423,1778947,1778947,1804439,1804439,1804439,1804439,1811369,1811369,1811369,1811369,1786929,1786929,1786929,1786929,1786929,1920747,1852172,1852172,1784773,1784773,1784773,1784773,1784773,1789297,1789297,1779909,1779909,1779909,1779909,1779909,1774418,1774418,1774418,1774418,1774418,1775310,1775310,1831493,1786379,1786379,1786379,1786379,1786379,1847632,1790821,1777813,1777813,1777813,1777813,1773505,1773505,1773505,1773505,1773505,1782025,1782025,1782025,1828944,1828944,1828944,1828944,1781851,1781851,1773323,1773323,1773323,1773323,1773323,1779836,1782171,1782171,1786167,1786167,1786167,1780719,1780719,1780719,1780719,1780719,1786167,1786167,1780719,1780719,1780719,1780719,1780719,1786297,1786297,1784561,1784561,1777561,1777561,1777561,1776931,1776931,1776931,1776931,1776931,1873649,2013576,2013576,2013576,2013576,2013576,2014934,2014934,1997573,1997573,1825988,1778185]', '0.88026442809842', '7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_mahasiswa`
--

CREATE TABLE `jawaban_mahasiswa` (
  `id_jawaban` int(11) NOT NULL,
  `kd_soal` varchar(6) NOT NULL,
  `npm` int(8) NOT NULL,
  `nama_mahasiswa` varchar(50) NOT NULL,
  `jawaban` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jawaban_mahasiswa`
--

INSERT INTO `jawaban_mahasiswa` (`id_jawaban`, `kd_soal`, `npm`, `nama_mahasiswa`, `jawaban`) VALUES
(11, 'PL22', 12342, 'John Doe', 'Bahasa pemrograman adalah instruksi yang digunakan oleh programmer untuk menentukan perilaku komputer.'),
(12, 'PL22', 12343, 'Mike', 'Bahasa pemrograman mudah digunakan.'),
(13, 'PL22', 12341, 'Jane Doe', 'Bahasa pemrograman adalah bahasa yang dibuat untuk memberikan instruksi kepada komputer guna memecahkan permasalahan.'),
(18, 'BINDO8', 123, 'Jane Doe', 'Pengalaman selama revolusi buku ini \r\nsangat menarik. Dalam buku ini antara \r\nsatu peristiwa dengan peristiwa lainnya \r\nmempunyai ketertarikan sehingga \r\nmampu menarik pembaca. Dari isinya \r\nbuku ini memiliki cerita sangat unik \r\ndan menarik sehingga layak untuk di \r\nbaca. Untuk bahasa dari buku ini dilihat \r\ndari segi bahasa yang digunakan \r\npengarang sederhana tapi memikat. \r\nKalimatnya pun disusun dalam \r\nparagraf sehingga mudah dipahami\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `kd_matkul` varchar(6) NOT NULL,
  `nama_matkul` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`kd_matkul`, `nama_matkul`) VALUES
('BINDO', 'Bahasa Indonesia'),
('DBMS', 'Database Management System'),
('PL', 'Programming Language'),
('WP', 'Web Programming');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal_esai`
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
-- Dumping data untuk tabel `soal_esai`
--

INSERT INTO `soal_esai` (`kd_soal`, `kd_matkul`, `soal`, `skor`, `bobot`, `kunci_jawaban`) VALUES
('BINDO8', 'BINDO', 'Tulislah sebuah paragraf yang berisi keunggulan karya dengan memperhatikan kelengkapan penggunaan bahasa dan ejaan yang tepat', 8, 30, 'Buku yang bertemakan pengalamanpengalaman selama revolusi ini sangat \nmenarik.Dalam buku ini antara satu \nperisiwa dengan peristiwa lainnya \nterdapat keterkaitan sehingga mampu \nmenarik pembaca.Isi dari buku ini \nmempunyai cerita yang sangat \nunik,menarik sehingga layak untuk \ndibaca.Dilihat dari segi bahasa yang \ndigunakan pengarang sederhana,akan \ntetapi memikat kalimat-kalimat dalam \nparagraf disusun secara runtut sehingga \nmudah dipahami.\n'),
('PL22', 'PL', 'Apa yang dimaksud dengan bahasa pemrograman?', 4, 30, 'Bahasa pemrograman adalah seperangkat aturan dan instruksi yang digunakan untuk menentukan cara menulis program komputer'),
('PL32', 'PL', 'Apa perbedaan antara bahasa pemrograman tingkat rendah dan tingkat tinggi?', 6, 20, 'Bahasa pemrograman tingkat rendah berorientasi pada bahasa mesin atau bahasa biner yang dapat dimengerti oleh komputer dan lebih sulit dipahami oleh manusia.\r\nBahasa pemrograman tingkat tinggi berorientasi pada bahasa manusia sehingga lebih mudah dipahami oleh manusia yang memiliki fitur dan abstraksi sehingga memungkinkan untuk mengekspresikan algoritma dengan mudah. ');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `hasil_algoritma`
--
ALTER TABLE `hasil_algoritma`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `kd_jawaban` (`kd_jawaban`);

--
-- Indeks untuk tabel `jawaban_mahasiswa`
--
ALTER TABLE `jawaban_mahasiswa`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indeks untuk tabel `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`kd_matkul`);

--
-- Indeks untuk tabel `soal_esai`
--
ALTER TABLE `soal_esai`
  ADD PRIMARY KEY (`kd_soal`),
  ADD KEY `kd_matkul` (`kd_matkul`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `hasil_algoritma`
--
ALTER TABLE `hasil_algoritma`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jawaban_mahasiswa`
--
ALTER TABLE `jawaban_mahasiswa`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
