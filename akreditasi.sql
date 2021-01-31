-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 31, 2021 at 09:50 AM
-- Server version: 5.7.24
-- PHP Version: 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akreditasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_akreditasi`
--

CREATE TABLE `tbl_akreditasi` (
  `akreditasi_id` int(11) NOT NULL,
  `akreditasi_nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_akreditasi`
--

INSERT INTO `tbl_akreditasi` (`akreditasi_id`, `akreditasi_nama`) VALUES
(1, 'Terakreditasi A'),
(2, 'Terakreditasi B'),
(3, 'Terakreditasi C'),
(4, 'Terakreditasi Kadaluwarsa'),
(5, 'Belum Terakreditasi ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fakultas`
--

CREATE TABLE `tbl_fakultas` (
  `fakultas_id` int(11) NOT NULL,
  `fakultas_nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_fakultas`
--

INSERT INTO `tbl_fakultas` (`fakultas_id`, `fakultas_nama`) VALUES
(1, 'Fakultas Sains dan Teknologi'),
(2, 'Fakultas Hukum'),
(3, 'Fakultas Ekonomi dan Bisnis'),
(4, 'Fakultas Psikologi dan Pendidikan'),
(5, 'Fakultas Ilmu Pengetahuan Budaya'),
(6, 'Fakultas Sosial dan Ilmu Politik');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenjang`
--

CREATE TABLE `tbl_jenjang` (
  `jenjang_id` int(11) NOT NULL,
  `jenjang_nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jenjang`
--

INSERT INTO `tbl_jenjang` (`jenjang_id`, `jenjang_nama`) VALUES
(1, 'S1'),
(2, 'S2'),
(3, 'S3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mahasiswa`
--

CREATE TABLE `tbl_mahasiswa` (
  `mahasiswa_id` int(11) NOT NULL,
  `id_prodi` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `nim` varchar(255) DEFAULT NULL,
  `status_kelulusan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_mahasiswa`
--

INSERT INTO `tbl_mahasiswa` (`mahasiswa_id`, `id_prodi`, `nama`, `nim`, `status_kelulusan`) VALUES
(1, '1', 'Budjang', '1', 0),
(4, '1', 'Budjang123', 'sadasd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prodi`
--

CREATE TABLE `tbl_prodi` (
  `prodi_id` int(11) NOT NULL,
  `prodi_nama` varchar(255) DEFAULT NULL,
  `id_fakultas` int(11) DEFAULT NULL,
  `id_subjenjang` int(11) DEFAULT NULL,
  `no_sk` varchar(255) DEFAULT NULL,
  `tahun_sk` int(255) DEFAULT NULL,
  `daluarsa` date DEFAULT NULL,
  `sertifikat` varchar(255) DEFAULT NULL,
  `id_akreditasi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_prodi`
--

INSERT INTO `tbl_prodi` (`prodi_id`, `prodi_nama`, `id_fakultas`, `id_subjenjang`, `no_sk`, `tahun_sk`, `daluarsa`, `sertifikat`, `id_akreditasi`) VALUES
(1, 'Pendidikan Guru Pendidikan Anak Usia Dini', 4, 3, '6767/SK/BAN-PT/Akred/S/X/2020', 2020, '2025-10-27', '', 2),
(2, 'Budaya dan Bahasa Arab', 5, 3, '4558/SK/BAN-PT/Ak-PPJ/S/VIII/2020', 2020, '2025-08-08', '', 1),
(3, 'Informatika', 1, 3, '2924/SK/BAN-PT/Ak-PPJ/S/V/2020', 2020, '2025-05-05', '20210127-220122-Sertifikat-Akreditasi-Informatika_2020.pdf', 2),
(4, 'Budaya dan Bahasa Inggris', 5, 3, '2974/SK/BAN-PT/Ak-PPJ/S/V/2020', 2020, '2025-05-05', NULL, 2),
(5, 'Akuntansi', 3, 3, '2877/SK/BAN-PT/Ak-PPJ/S/V/2020', 2020, '2025-05-05', '', 2),
(6, 'Teknik Elektro', 1, 3, '2015/SK/BAN-PT/Ak-PPJ/S/III/2020', 2020, '2025-03-29', NULL, 2),
(7, 'Teknik Industri', 1, 3, '1758/SK/BAN-PT/Ak-PPJ/S/III/2020', 2020, '2025-03-18', NULL, 2),
(8, 'Manajemen', 3, 3, '2149/SK/BAN-PT/Akred/S/VIII/2018', 2018, '2023-08-07', NULL, 2),
(9, 'Ilmu Hukum', 2, 2, '1035/SK/BAN-PT/SURV-BDG/M/IV/2018', 2018, '2023-04-10', '20210123-180120-Sertifikat-Akreditasi-Ilmu-Hukum-Magister-2018.pdf', 2),
(10, 'Psikologi', 4, 3, '3434/SK/BAN-PT/Akred/S/IX/2017', 2017, '2022-09-19', NULL, 2),
(11, 'Bimbingan dan Penyuluhan Islam', 4, 3, '2354/SK/BAN-PT/Akred/S/VII/2017', 2017, '2022-07-25', NULL, 2),
(12, 'Ilmu Hubungan Internasional', 6, 3, '2279/SK/BAN-PT/Akred/S/VII/2017', 2017, '2022-07-11', NULL, 2),
(13, 'Ilmu Komunikasi', 6, 3, '1916/SK/BAN-PT/Akred/S/VI/2017', 2017, '2022-06-13', '', 1),
(14, 'Biologi', 1, 3, '0120/SK/BAN-PT/Akred/S/I/2017', 2017, '2022-01-10', '20210127-220153-Sertifikat-Akreditasi-Biologi-2017.pdf', 1),
(15, 'Budaya dan Bahasa Jepang', 5, 3, '1987/SK/BAN-PT/Akred/S/IX/2016', 2016, '2021-09-23', NULL, 2),
(16, 'Budaya Tiongkok dan Bahasa Mandarin', 5, 3, '1670/SK/BAN-PT/Akred/S/VIII/2016', 2016, '2021-08-26', '', 2),
(17, 'Ilmu Hukum', 2, 3, '0810/SK/BAN-PT/Akred/S/VI/2016', 2016, '2021-06-10', '20210123-220111-Sertifikat-Akreditasi-Ilmu-Hukum-2016.pdf', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profil_univ`
--

CREATE TABLE `tbl_profil_univ` (
  `profil_univ_id` int(11) NOT NULL,
  `visi` text,
  `misi` text,
  `tujuan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_profil_univ`
--

INSERT INTO `tbl_profil_univ` (`profil_univ_id`, `visi`, `misi`, `tujuan`) VALUES
(1, '<div align=\"center\"><span style=\"font-size: 12pt; font-family: \" arial=\"\" black\";\"=\"\"><b><br></b></span></div><div align=\"center\"><span style=\"font-size: 12pt; font-family: \" arial=\"\" black\";\"=\"\"><b><br></b></span></div><div align=\"center\"><img src=\"http://localhost/akreditasibaru/uploads/FI28012021132653785.png\" style=\"width: 493px;\"><span style=\"font-size: 12pt; font-family: \" arial=\"\" black\";\"=\"\"><b><br></b></span></div><div align=\"center\"><span style=\"font-size: 12pt; font-family: \" arial=\"\" black\";\"=\"\"><b><br></b></span></div><div align=\"center\"><div class=\"wpb_text_column wpb_content_element \" style=\"margin: 0px auto; padding: 0px; border: 0px solid transparent; outline: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 13px; line-height: inherit; vertical-align: baseline; font-family: \" open=\"\" sans\";=\"\" max-width:=\"\" 100%;=\"\" color:=\"\" rgb(102,=\"\" 102,=\"\" 102);=\"\" text-align:=\"\" start;\"=\"\"><div class=\"wpb_wrapper\" style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;\"><p style=\"text-align: center; font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; margin-bottom: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline;\"><b><em style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; vertical-align: baseline; font-family: inherit;\">“Menjadi Universitas Terkemuka dalam Membentuk Manusia Unggul dan Bermartabat, yang Memiliki Kemampuan Intelektual Berlandaskan Nilai-nilai Spiritual, Moral, dan Etika Islami</em>&nbsp;“</b></p><p style=\"text-align: center; font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; margin-bottom: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline;\"><b>(sumber : uai.ac.id)</b></p><div style=\"font-weight: inherit;\"><br></div></div></div></div><div align=\"center\"><span style=\"font-size: 12.000000pt; font-family: \'Bookman Old Style\'\"></span></div>', '<ol><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-align: justify;\"><b>Meningkatkan <span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; vertical-align: baseline; font-family: inherit; font-style: inherit;\"><em style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; vertical-align: baseline; font-family: inherit;\">kualitas</em></span> pendidikan, penelitian, dan pelayanan kepada masyarakat, dengan menerapkan kaidah <span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; vertical-align: baseline; font-family: inherit; font-style: inherit;\"><em style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; vertical-align: baseline; font-family: inherit;\">enterprising university</em></span>;</b></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-align: justify;\"><b>Menjalin <span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; vertical-align: baseline; font-family: inherit; font-style: inherit;\"><em style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; vertical-align: baseline; font-family: inherit;\">kemitraan </em></span>dengan institusi yang relevan, baik di dalam maupun di luar negeri;</b></li><li style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; text-align: justify;\"><b>Menumbuh-kembangkan <span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; vertical-align: baseline; font-family: inherit; font-style: inherit;\"><em style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; vertical-align: baseline; font-family: inherit;\">nilai-nilai universal Islam</em></span> dalam pembentukan <span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; vertical-align: baseline; font-family: inherit; font-style: inherit;\"><em style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; vertical-align: baseline; font-family: inherit;\">karakter</em></span><em style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; vertical-align: baseline; font-family: inherit;\">.</em></b></li></ol>', '<ol><li>\r\n		<span style=\"font-size:14px;\"><b>Menghasilkan sarjana (lulusan) yang \r\nberiman, bertaqwa, dan berakhlak mulia serta memiliki keunggulan \r\nkompetitif dalam persaingan global;</b></span></li><li>\r\n		<span style=\"font-size:14px;\"><b>Menyiapkan peserta didik agar menjadi \r\nwarga negara dan anggota masyarakat yang memiliki kemampuan akademik, \r\nprofesi, dan atau vokasi yang kompetitif serta dapat mengembangkan ilmu \r\nagama Islam, sains dan teknologi, serta seni;</b></span></li><li>\r\n		<span style=\"font-size:14px;\"><b>Menyebarluaskan ilmu agama Islam, sains \r\ndan teknologi, serta seni yang dijiwai oleh nilai keislaman, dan \r\nmeningkatkan taraf hidup masyarakat dan memperkaya budaya nasional.</b></span></li></ol>');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subjenjang`
--

CREATE TABLE `tbl_subjenjang` (
  `subjenjang_id` int(11) NOT NULL,
  `id_jenjang` int(11) DEFAULT NULL,
  `subjenjang_nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subjenjang`
--

INSERT INTO `tbl_subjenjang` (`subjenjang_id`, `id_jenjang`, `subjenjang_nama`) VALUES
(1, 1, 'S3'),
(2, 2, 'S2'),
(3, 1, 'S1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `username`, `password`, `nama`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Admin'),
(5, 'test2', '4297f44b13955235245b2497399d7a93', 'waduh'),
(6, 'testing', '827ccb0eea8a706c4c34a16891f84e7b', 'Testing User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_akreditasi`
--
ALTER TABLE `tbl_akreditasi`
  ADD PRIMARY KEY (`akreditasi_id`);

--
-- Indexes for table `tbl_fakultas`
--
ALTER TABLE `tbl_fakultas`
  ADD PRIMARY KEY (`fakultas_id`);

--
-- Indexes for table `tbl_jenjang`
--
ALTER TABLE `tbl_jenjang`
  ADD PRIMARY KEY (`jenjang_id`);

--
-- Indexes for table `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  ADD PRIMARY KEY (`mahasiswa_id`);

--
-- Indexes for table `tbl_prodi`
--
ALTER TABLE `tbl_prodi`
  ADD PRIMARY KEY (`prodi_id`);

--
-- Indexes for table `tbl_profil_univ`
--
ALTER TABLE `tbl_profil_univ`
  ADD PRIMARY KEY (`profil_univ_id`);

--
-- Indexes for table `tbl_subjenjang`
--
ALTER TABLE `tbl_subjenjang`
  ADD PRIMARY KEY (`subjenjang_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_akreditasi`
--
ALTER TABLE `tbl_akreditasi`
  MODIFY `akreditasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_fakultas`
--
ALTER TABLE `tbl_fakultas`
  MODIFY `fakultas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_jenjang`
--
ALTER TABLE `tbl_jenjang`
  MODIFY `jenjang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  MODIFY `mahasiswa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_prodi`
--
ALTER TABLE `tbl_prodi`
  MODIFY `prodi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_profil_univ`
--
ALTER TABLE `tbl_profil_univ`
  MODIFY `profil_univ_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_subjenjang`
--
ALTER TABLE `tbl_subjenjang`
  MODIFY `subjenjang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
