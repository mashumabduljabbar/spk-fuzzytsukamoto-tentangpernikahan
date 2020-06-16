-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 19, 2019 at 11:53 PM
-- Server version: 10.0.38-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mule7148_fuzzytsukamoto`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_admin`
--

CREATE TABLE `m_admin` (
  `id` int(6) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('admin','guru','siswa') NOT NULL,
  `kon_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_admin`
--

INSERT INTO `m_admin` (`id`, `username`, `password`, `level`, `kon_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 0),
(2, 'guru1', '9310f83135f238b04af729fec041cca8', 'guru', 1),
(6, 'siswa1', '3afa0d81296a4f17d477ec823261b1ec', 'siswa', 1),
(13, 'guru2', '21232f297a57a5a743894a0e4a801fc3', 'guru', 2),
(17, 'siswa4', '21232f297a57a5a743894a0e4a801fc3', 'siswa', 4);

-- --------------------------------------------------------

--
-- Table structure for table `m_guru`
--

CREATE TABLE `m_guru` (
  `id` int(6) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_guru`
--

INSERT INTO `m_guru` (`id`, `nama`) VALUES
(1, 'Ir. Raden Teguh Hamdani'),
(2, 'M.A Jabbar, S.Ag'),
(3, 'Tito Novyantara');

--
-- Triggers `m_guru`
--
DELIMITER $$
CREATE TRIGGER `hapus_guru` AFTER DELETE ON `m_guru` FOR EACH ROW BEGIN
DELETE FROM m_admin WHERE m_admin.level = 'guru' AND m_admin.kon_id = OLD.id;
DELETE FROM m_soal WHERE m_soal.id_guru = OLD.id;
DELETE FROM tr_guru_mapel WHERE tr_guru_mapel.id_guru = OLD.id;
DELETE FROM tr_guru_tes WHERE tr_guru_tes.id_guru = OLD.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `m_mapel`
--

CREATE TABLE `m_mapel` (
  `id` int(6) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_mapel`
--

INSERT INTO `m_mapel` (`id`, `nama`) VALUES
(1, 'Dasar-Dasar Pernikahan'),
(2, 'rerrr');

--
-- Triggers `m_mapel`
--
DELIMITER $$
CREATE TRIGGER `hapus_mapel` AFTER DELETE ON `m_mapel` FOR EACH ROW BEGIN
DELETE FROM m_soal WHERE m_soal.id_mapel = OLD.id;
DELETE FROM tr_guru_mapel WHERE tr_guru_mapel.id_mapel = OLD.id;
DELETE FROM tr_guru_tes WHERE tr_guru_tes.id_mapel = OLD.id;
DELETE FROM tr_siswa_mapel WHERE tr_siswa_mapel.id_mapel = OLD.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `m_siswa`
--

CREATE TABLE `m_siswa` (
  `id` int(6) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nim` varchar(50) NOT NULL,
  `jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_siswa`
--

INSERT INTO `m_siswa` (`id`, `nama`, `nim`, `jurusan`) VALUES
(1, 'Agus Yudhoyono', '12090671', 'Teknik Informatika'),
(3, 'Jabbar', '1234567', 'Teknik Informatika'),
(4, 'Tito Novyantara', '1234567', 'Teknik Informatika');

--
-- Triggers `m_siswa`
--
DELIMITER $$
CREATE TRIGGER `hapus_siswa` AFTER DELETE ON `m_siswa` FOR EACH ROW BEGIN
DELETE FROM tr_ikut_ujian WHERE tr_ikut_ujian.id_user = OLD.id;
DELETE FROM tr_siswa_mapel WHERE tr_siswa_mapel.id_siswa = OLD.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `m_soal`
--

CREATE TABLE `m_soal` (
  `id` int(6) NOT NULL,
  `id_guru` int(6) NOT NULL,
  `id_mapel` int(6) NOT NULL,
  `bobot` int(2) NOT NULL,
  `gambar` varchar(150) NOT NULL,
  `soal` longtext NOT NULL,
  `opsi_a` longtext NOT NULL,
  `opsi_b` longtext NOT NULL,
  `opsi_c` longtext NOT NULL,
  `opsi_d` longtext NOT NULL,
  `opsi_e` longtext NOT NULL,
  `jawaban` varchar(5) NOT NULL,
  `tgl_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_soal`
--

INSERT INTO `m_soal` (`id`, `id_guru`, `id_mapel`, `bobot`, `gambar`, `soal`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `jawaban`, `tgl_input`) VALUES
(1, 1, 1, 35, '', 'Berikut ini mana yang bukan termasuk di dalam rukun nikah?', 'Mempelai', 'Wali', 'Saksi', 'Ijab Qabul', 'Mas Kawin', 'E', '2015-08-27 18:20:22'),
(2, 1, 1, 15, '', 'Berapakah jumlah saksi minimal yang harus hadir menurut jumhur ulama?', '1', '2', '3', '4', '5', 'B', '2015-08-27 18:21:02'),
(3, 1, 1, 30, '', 'Manakah dari kriteria berikut yang bukan syarat wajib untuk menjadi wali nikah?', 'Laki-laki', 'Perempuan', 'Balig dan berakal sehat', 'Memiliki hak perwalian', 'Merdeka', 'B', '2015-08-27 18:21:55'),
(4, 1, 1, 20, '', 'Seseorang menyatakan sesuatu kepada lawan bicaranya, kemudian lawan bicaranya menyatakan menerima disebut?', 'Ijab', 'Qabul', 'Janji Nikah', 'Ijab dan Qabul', 'Talaq', 'D', '2015-08-27 18:23:13');

-- --------------------------------------------------------

--
-- Table structure for table `m_soal_angket`
--

CREATE TABLE `m_soal_angket` (
  `id` int(6) NOT NULL,
  `id_guru` int(6) NOT NULL,
  `id_mapel` int(6) NOT NULL,
  `soal` longtext NOT NULL,
  `opsi_a` varchar(50) NOT NULL DEFAULT '4',
  `opsi_b` varchar(50) NOT NULL DEFAULT '3',
  `opsi_c` varchar(50) NOT NULL DEFAULT '2',
  `opsi_d` varchar(50) NOT NULL DEFAULT '1',
  `tgl_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `m_soal_angket`
--

INSERT INTO `m_soal_angket` (`id`, `id_guru`, `id_mapel`, `soal`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `tgl_input`) VALUES
(1, 1, 1, 'Narasumber hadir tepat waktu, memulai materi dan menyelesaikan materi tepat waktu.', '4', '3', '2', '1', '2015-08-27 18:20:22'),
(2, 1, 1, 'Narasumber menggunakan fasilitas belajar seperti infokus, dll.', '4', '3', '2', '1', '2015-08-27 18:21:02'),
(3, 1, 1, 'Peserta memahami dan menyukai materi yang diberikan oleh narasumber', '4', '3', '2', '1', '2015-08-27 18:21:55'),
(4, 1, 1, 'Dalam pembelajaran, Narasumber memberi kesempatan bertanya', '4', '3', '2', '1', '2015-08-27 18:23:13'),
(5, 1, 1, 'Narasumber dapat menumbuhkan minat belajar, Anda.', '4', '3', '2', '1', '2015-08-27 18:23:13');

-- --------------------------------------------------------

--
-- Table structure for table `m_soal_tanya_jawab`
--

CREATE TABLE `m_soal_tanya_jawab` (
  `id` int(6) NOT NULL,
  `id_guru` int(6) NOT NULL,
  `id_mapel` int(6) NOT NULL,
  `id_user` int(6) NOT NULL,
  `soal` longtext NOT NULL,
  `jawaban` longtext NOT NULL,
  `tgl_input` datetime NOT NULL,
  `tgl_jawab` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `m_soal_tanya_jawab`
--

INSERT INTO `m_soal_tanya_jawab` (`id`, `id_guru`, `id_mapel`, `id_user`, `soal`, `jawaban`, `tgl_input`, `tgl_jawab`) VALUES
(1, 1, 1, 1, 'Jam berapa?', '', '2015-08-27 18:20:22', '0000-00-00 00:00:00'),
(2, 1, 1, 1, 'Kapan?', 'besok', '2015-08-27 18:21:02', '2018-05-01 16:01:02'),
(21, 1, 2, 1, 'dfdfd', 'kapan2 ya', '2018-05-01 14:27:20', '2018-05-01 16:01:47'),
(22, 2, 2, 1, 'okokoko', '', '2018-05-01 14:27:50', '0000-00-00 00:00:00'),
(24, 2, 2, 2, 'rararara', '', '2018-05-01 14:50:02', '0000-00-00 00:00:00'),
(26, 1, 2, 1, 'masa sih pak?', 'iya dong', '2018-05-01 16:02:20', '2018-05-01 16:04:03');

-- --------------------------------------------------------

--
-- Table structure for table `tr_angket`
--

CREATE TABLE `tr_angket` (
  `id` int(6) NOT NULL,
  `id_guru` int(6) NOT NULL,
  `id_mapel` int(6) NOT NULL,
  `id_user` int(6) NOT NULL,
  `jawaban` varchar(50) NOT NULL,
  `nilai` int(6) NOT NULL,
  `tgl_dibuat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tr_angket`
--

INSERT INTO `tr_angket` (`id`, `id_guru`, `id_mapel`, `id_user`, `jawaban`, `nilai`, `tgl_dibuat`) VALUES
(1, 1, 1, 1, '4,3,2,2,1', 60, '2018-05-04 09:48:00'),
(35, 2, 1, 3, '4,3,2,2,1', 70, '2018-05-04 09:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `tr_guest`
--

CREATE TABLE `tr_guest` (
  `id_guest` int(5) NOT NULL,
  `userid_guest` varchar(50) DEFAULT NULL COMMENT 'RandomID',
  `tanya_guest` text,
  `jawab_guest` text,
  `created_guest` varchar(20) DEFAULT NULL,
  `penjawab_guest` varchar(50) DEFAULT NULL,
  `update_guest` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_guest`
--

INSERT INTO `tr_guest` (`id_guest`, `userid_guest`, `tanya_guest`, `jawab_guest`, `created_guest`, `penjawab_guest`, `update_guest`) VALUES
(1, '20180509070540', 'Ter', 's', '2018-05-09 07:56:44', 'Teguh', '2018-05-09 17:56:44'),
(2, '20180509070541', 'Apakah? Apakah? Apakah? Apakah? Apakah?Apakah? v Apakah? Apakah? Apakah? Apakah? Apakah? Apakah? Apakah? Apakah?Apakah? v Apakah? Apakah? Apakah?', 'ggegege', '2018-05-09 07:56:44', 'Ir. Raden Teguh Hamdani', '2018-05-09 18:47:27'),
(3, '20190214110206', 'Test', 'er', '2019-02-14 23:28:11', 'M.A Jabbar, S.Ag', '2019-02-14 23:30:04');

-- --------------------------------------------------------

--
-- Table structure for table `tr_guru_mapel`
--

CREATE TABLE `tr_guru_mapel` (
  `id` int(6) NOT NULL,
  `id_guru` int(6) NOT NULL,
  `id_mapel` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_guru_mapel`
--

INSERT INTO `tr_guru_mapel` (`id`, `id_guru`, `id_mapel`) VALUES
(1, 1, 1),
(7, 2, 2),
(8, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tr_guru_tes`
--

CREATE TABLE `tr_guru_tes` (
  `id` int(6) NOT NULL,
  `id_guru` int(6) NOT NULL,
  `id_mapel` int(6) NOT NULL,
  `nama_ujian` varchar(200) NOT NULL,
  `jumlah_soal` int(6) NOT NULL,
  `waktu` int(6) NOT NULL,
  `jenis` enum('acak','set') NOT NULL,
  `detil_jenis` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_guru_tes`
--

INSERT INTO `tr_guru_tes` (`id`, `id_guru`, `id_mapel`, `nama_ujian`, `jumlah_soal`, `waktu`, `jenis`, `detil_jenis`) VALUES
(1, 1, 1, 'Dasar-Dasar Pernikahan', 5, 10, 'acak', '');

-- --------------------------------------------------------

--
-- Table structure for table `tr_ikut_ujian`
--

CREATE TABLE `tr_ikut_ujian` (
  `id` int(6) NOT NULL,
  `id_tes` int(6) NOT NULL,
  `id_user` int(6) NOT NULL,
  `list_soal` longtext NOT NULL,
  `list_jawaban` longtext NOT NULL,
  `jml_benar` int(6) NOT NULL,
  `nilai` int(6) NOT NULL,
  `nilai_bobot` int(6) NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `status` enum('Y','N') NOT NULL,
  `hasil_ujian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_ikut_ujian`
--

INSERT INTO `tr_ikut_ujian` (`id`, `id_tes`, `id_user`, `list_soal`, `list_jawaban`, `jml_benar`, `nilai`, `nilai_bobot`, `tgl_mulai`, `tgl_selesai`, `status`, `hasil_ujian`) VALUES
(23, 1, 1, '2,3,4,1', '2:B,3:C,4:D,1:E', 3, 75, 70, '2018-05-04 10:07:57', '2018-05-04 10:17:57', 'N', 'Lulus');

-- --------------------------------------------------------

--
-- Table structure for table `tr_siswa_mapel`
--

CREATE TABLE `tr_siswa_mapel` (
  `id` int(6) NOT NULL,
  `id_siswa` int(6) NOT NULL,
  `id_mapel` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_siswa_mapel`
--

INSERT INTO `tr_siswa_mapel` (`id`, `id_siswa`, `id_mapel`) VALUES
(1, 1, 1),
(2, 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_admin`
--
ALTER TABLE `m_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_guru`
--
ALTER TABLE `m_guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_mapel`
--
ALTER TABLE `m_mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_siswa`
--
ALTER TABLE `m_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_soal`
--
ALTER TABLE `m_soal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_soal_angket`
--
ALTER TABLE `m_soal_angket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_soal_tanya_jawab`
--
ALTER TABLE `m_soal_tanya_jawab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_angket`
--
ALTER TABLE `tr_angket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_guest`
--
ALTER TABLE `tr_guest`
  ADD PRIMARY KEY (`id_guest`);

--
-- Indexes for table `tr_guru_mapel`
--
ALTER TABLE `tr_guru_mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_guru_tes`
--
ALTER TABLE `tr_guru_tes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_ikut_ujian`
--
ALTER TABLE `tr_ikut_ujian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_siswa_mapel`
--
ALTER TABLE `tr_siswa_mapel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_admin`
--
ALTER TABLE `m_admin`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `m_guru`
--
ALTER TABLE `m_guru`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_mapel`
--
ALTER TABLE `m_mapel`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_siswa`
--
ALTER TABLE `m_siswa`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_soal`
--
ALTER TABLE `m_soal`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_soal_angket`
--
ALTER TABLE `m_soal_angket`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_soal_tanya_jawab`
--
ALTER TABLE `m_soal_tanya_jawab`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tr_angket`
--
ALTER TABLE `tr_angket`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tr_guest`
--
ALTER TABLE `tr_guest`
  MODIFY `id_guest` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tr_guru_mapel`
--
ALTER TABLE `tr_guru_mapel`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tr_guru_tes`
--
ALTER TABLE `tr_guru_tes`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tr_ikut_ujian`
--
ALTER TABLE `tr_ikut_ujian`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tr_siswa_mapel`
--
ALTER TABLE `tr_siswa_mapel`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
