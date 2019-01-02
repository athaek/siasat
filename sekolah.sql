-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2018 at 10:11 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `akademik_jadwal_sekolah`
--

CREATE TABLE IF NOT EXISTS `akademik_jadwal_sekolah` (
  `jadwal_id` int(11) NOT NULL,
  `tahun_akademik_id` int(11) NOT NULL,
  `konsentrasi_id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `hari_id` int(11) NOT NULL,
  `waktu_id` int(11) NOT NULL,
  `ruangan_id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `jam_mulai` varchar(9) NOT NULL,
  `jam_selesai` varchar(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akademik_jadwal_sekolah`
--

INSERT INTO `akademik_jadwal_sekolah` (`jadwal_id`, `tahun_akademik_id`, `konsentrasi_id`, `mapel_id`, `hari_id`, `waktu_id`, `ruangan_id`, `guru_id`, `semester`, `jam_mulai`, `jam_selesai`) VALUES
(1, 1, 1, 1, 1, 0, 0, 0, 1, '07:00', '08:40'),
(2, 1, 1, 2, 2, 0, 0, 0, 1, '07:00', '08:40'),
(3, 1, 1, 3, 3, 0, 0, 0, 1, '07:00', '08:40'),
(4, 1, 1, 4, 4, 0, 0, 0, 1, '07:00', '08:40'),
(5, 1, 1, 5, 5, 0, 0, 0, 1, '07:00', '08:40'),
(6, 1, 1, 6, 6, 0, 0, 0, 1, '07:00', '08:40');

-- --------------------------------------------------------

--
-- Table structure for table `akademik_kelas`
--

CREATE TABLE IF NOT EXISTS `akademik_kelas` (
  `kelas_id` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `ketua` varchar(70) NOT NULL,
  `no_izin` varchar(40) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=aktif ,2=g aktif'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akademik_kelas`
--

INSERT INTO `akademik_kelas` (`kelas_id`, `nama_kelas`, `ketua`, `no_izin`, `status`) VALUES
(1, 'XI', '', '', 0),
(2, 'X', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `akademik_khs`
--

CREATE TABLE IF NOT EXISTS `akademik_khs` (
  `khs_id` int(11) NOT NULL,
  `krs_id` int(11) NOT NULL,
  `mutu` int(11) NOT NULL,
  `kehadiran` int(11) NOT NULL,
  `tugas` int(11) NOT NULL,
  `grade` varchar(1) NOT NULL,
  `confirm` int(11) NOT NULL COMMENT '1=ya 2=tidak'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akademik_khs`
--

INSERT INTO `akademik_khs` (`khs_id`, `krs_id`, `mutu`, `kehadiran`, `tugas`, `grade`, `confirm`) VALUES
(1, 1, 0, 0, 0, '', 2),
(2, 2, 0, 0, 0, '', 2),
(3, 3, 0, 0, 0, '', 2),
(4, 4, 0, 0, 0, '', 2),
(5, 5, 0, 0, 0, '', 2),
(6, 6, 0, 0, 0, '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `akademik_konsentrasi`
--

CREATE TABLE IF NOT EXISTS `akademik_konsentrasi` (
  `konsentrasi_id` int(11) NOT NULL,
  `nama_konsentrasi` varchar(100) NOT NULL,
  `ketua` varchar(50) NOT NULL,
  `jenjang` varchar(3) NOT NULL COMMENT '1=D1,2=D2,3=D3,4=D4',
  `jml_semester` int(11) NOT NULL,
  `kode_nomor` varchar(20) NOT NULL,
  `gelar` varchar(40) NOT NULL,
  `kelas_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akademik_konsentrasi`
--

INSERT INTO `akademik_konsentrasi` (`konsentrasi_id`, `nama_konsentrasi`, `ketua`, `jenjang`, `jml_semester`, `kode_nomor`, `gelar`, `kelas_id`) VALUES
(1, 'IPA', '', 'd1', 1, '', '', 1),
(2, 'IPS', '', 'd1', 1, '', '', 1),
(3, 'IPA', '', 'd1', 1, '', '', 2),
(4, 'IPS', '', 'd1', 1, '', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `akademik_krs`
--

CREATE TABLE IF NOT EXISTS `akademik_krs` (
  `krs_id` int(11) NOT NULL,
  `nis` varchar(10) NOT NULL,
  `jadwal_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL COMMENT 'semester siswa waktu pengambilan krs'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akademik_krs`
--

INSERT INTO `akademik_krs` (`krs_id`, `nis`, `jadwal_id`, `semester`) VALUES
(1, '689.202', 1, 1),
(2, '689.202', 2, 1),
(3, '689.202', 3, 1),
(4, '689.202', 4, 1),
(5, '689.202', 5, 1),
(6, '689.202', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `akademik_registrasi`
--

CREATE TABLE IF NOT EXISTS `akademik_registrasi` (
  `registrasi_id` int(11) NOT NULL,
  `nis` varchar(10) NOT NULL,
  `tanggal_registrasi` datetime NOT NULL,
  `tahun_akademik_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akademik_registrasi`
--

INSERT INTO `akademik_registrasi` (`registrasi_id`, `nis`, `tanggal_registrasi`, `tahun_akademik_id`, `semester`) VALUES
(2, '689.101', '2018-02-13 14:48:30', 1, 2),
(3, '689.202', '2018-02-13 16:12:59', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `akademik_tahun_akademik`
--

CREATE TABLE IF NOT EXISTS `akademik_tahun_akademik` (
  `tahun_akademik_id` int(11) NOT NULL,
  `keterangan` varchar(15) NOT NULL,
  `batas_registrasi` date NOT NULL,
  `status` enum('n','y') NOT NULL,
  `tahun` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akademik_tahun_akademik`
--

INSERT INTO `akademik_tahun_akademik` (`tahun_akademik_id`, `keterangan`, `batas_registrasi`, `status`, `tahun`) VALUES
(1, '20181', '2018-02-28', 'y', 0);

-- --------------------------------------------------------

--
-- Table structure for table `akademik_waktu_sekolah`
--

CREATE TABLE IF NOT EXISTS `akademik_waktu_sekolah` (
  `waktu_id` int(11) NOT NULL,
  `keterangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `app_agama`
--

CREATE TABLE IF NOT EXISTS `app_agama` (
  `agama_id` int(11) NOT NULL,
  `keterangan` varchar(15) COLLATE utf8_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `app_agama`
--

INSERT INTO `app_agama` (`agama_id`, `keterangan`) VALUES
(1, 'Islam'),
(2, 'Kristen'),
(3, 'Katolik'),
(4, 'Budha'),
(5, 'Hindu'),
(6, 'Kepercayaan');

-- --------------------------------------------------------

--
-- Table structure for table `app_gedung`
--

CREATE TABLE IF NOT EXISTS `app_gedung` (
  `gedung_id` int(11) NOT NULL,
  `nama_gedung` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_gedung`
--

INSERT INTO `app_gedung` (`gedung_id`, `nama_gedung`) VALUES
(5, 'gedung 1'),
(6, 'gedung 2'),
(7, 'gedung 3');

-- --------------------------------------------------------

--
-- Table structure for table `app_guru`
--

CREATE TABLE IF NOT EXISTS `app_guru` (
  `guru_id` int(11) NOT NULL,
  `nama_lengkap` varchar(70) NOT NULL,
  `nidn` varchar(20) NOT NULL,
  `nip` varchar(22) NOT NULL,
  `no_ktp` varchar(20) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `gender` enum('1','2') NOT NULL,
  `agama_id` int(1) NOT NULL,
  `status_kawin` int(1) NOT NULL COMMENT '1=kawin ,2=belum kawin',
  `gelar_pendidikan` varchar(10) NOT NULL,
  `alamat` text NOT NULL,
  `hp` varchar(12) NOT NULL,
  `email` varchar(40) NOT NULL,
  `kelas_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_guru`
--

INSERT INTO `app_guru` (`guru_id`, `nama_lengkap`, `nidn`, `nip`, `no_ktp`, `tempat_lahir`, `tanggal_lahir`, `gender`, `agama_id`, `status_kawin`, `gelar_pendidikan`, `alamat`, `hp`, `email`, `kelas_id`) VALUES
(5, 'RAHADIYAN', '', '', '', '', '0000-00-00', '1', 1, 1, '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `app_hari`
--

CREATE TABLE IF NOT EXISTS `app_hari` (
  `hari_id` int(11) NOT NULL,
  `hari` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_hari`
--

INSERT INTO `app_hari` (`hari_id`, `hari`) VALUES
(0, 'not set'),
(1, 'senin'),
(2, 'selasa'),
(3, 'rabu'),
(4, 'kamis'),
(5, 'jumat'),
(6, 'sabtu'),
(7, 'minggu');

-- --------------------------------------------------------

--
-- Table structure for table `app_nilai_grade`
--

CREATE TABLE IF NOT EXISTS `app_nilai_grade` (
  `nilai_id` int(11) NOT NULL,
  `dari` float NOT NULL,
  `sampai` float NOT NULL,
  `grade` varchar(1) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_nilai_grade`
--

INSERT INTO `app_nilai_grade` (`nilai_id`, `dari`, `sampai`, `grade`, `keterangan`) VALUES
(1, 9.5, 10, 'A', ''),
(2, 8.5, 9.4, 'B', ''),
(3, 7.5, 8.4, 'C', ''),
(4, 6, 7.4, 'D', 'perbaikan'),
(5, 0, 5.9, 'E', 'tidak lulus');

-- --------------------------------------------------------

--
-- Table structure for table `app_pekerjaan`
--

CREATE TABLE IF NOT EXISTS `app_pekerjaan` (
  `pekerjaan_id` varchar(2) NOT NULL,
  `keterangan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_pekerjaan`
--

INSERT INTO `app_pekerjaan` (`pekerjaan_id`, `keterangan`) VALUES
('01', 'tidak bekerja'),
('02', 'nelayan'),
('03', 'petani'),
('04', 'peternak'),
('05', 'PNS/ TNI/ Polri'),
('06', 'Karyawan Swasta'),
('07', 'Pedagang Kecil'),
('08', 'Pedagang Besar'),
('09', 'Wiraswasta'),
('10', 'Wirausaha'),
('11', 'buruh'),
('12', 'pensiunan'),
('99', 'lainya');

-- --------------------------------------------------------

--
-- Table structure for table `app_ruangan`
--

CREATE TABLE IF NOT EXISTS `app_ruangan` (
  `ruangan_id` int(11) NOT NULL,
  `nama_ruangan` varchar(20) NOT NULL,
  `gedung_id` int(11) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_ruangan`
--

INSERT INTO `app_ruangan` (`ruangan_id`, `nama_ruangan`, `gedung_id`, `kapasitas`, `keterangan`) VALUES
(30, 'X1', 5, 30, ''),
(31, 'X2', 5, 30, ''),
(32, 'X3', 5, 30, ''),
(33, 'XII1', 6, 30, ''),
(34, 'XII2', 6, 30, ''),
(35, 'XII3', 6, 30, ''),
(36, 'XIII1', 7, 30, ''),
(37, 'XIII2', 7, 30, ''),
(38, 'XIII3', 7, 30, '');

-- --------------------------------------------------------

--
-- Table structure for table `app_users`
--

CREATE TABLE IF NOT EXISTS `app_users` (
  `id_users` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` int(1) NOT NULL COMMENT '1=admin ,2=pegawai ,3=guru ,4=siswa',
  `keterangan` varchar(5) NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_users`
--

INSERT INTO `app_users` (`id_users`, `username`, `nama`, `password`, `level`, `keterangan`, `last_login`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '', '2018-02-28 22:49:37'),
(9, 'RAHADIYAN', '', '61f8a8e6d7ef03722c1e6dae8c9bbaab', 3, '5', '0000-00-00 00:00:00'),
(10, 'admin1', '', '$2y$10$UbauoZBbO5dhywLWutvhu.mPi', 0, '', '0000-00-00 00:00:00'),
(11, 'admin2', '', '$2y$10$KgBaUvkVq2jG8BkuKmy/X.FD3', 0, '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `app_usersiswa`
--

CREATE TABLE IF NOT EXISTS `app_usersiswa` (
  `id_usersiswa` int(11) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `namasiswa` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_usersiswa`
--

INSERT INTO `app_usersiswa` (`id_usersiswa`, `nis`, `namasiswa`, `username`, `password`) VALUES
(1, '689.101', '', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(7, '689.202', '', 'admin1', 'e00cf25ad42683b3df678c61f42c6bda');

-- --------------------------------------------------------

--
-- Table structure for table `daemons`
--

CREATE TABLE IF NOT EXISTS `daemons` (
  `Start` text NOT NULL,
  `Info` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gammu`
--

CREATE TABLE IF NOT EXISTS `gammu` (
  `Version` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE IF NOT EXISTS `inbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ReceivingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Text` text NOT NULL,
  `SenderNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL,
  `RecipientID` text NOT NULL,
  `Processed` enum('false','true') NOT NULL DEFAULT 'false'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `keuangan_biaya_sekolah`
--

CREATE TABLE IF NOT EXISTS `keuangan_biaya_sekolah` (
  `biaya_sekolah_id` int(11) NOT NULL,
  `jenis_bayar_id` int(3) NOT NULL,
  `konsentrasi_id` int(3) NOT NULL,
  `angkatan_id` int(3) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keuangan_biaya_sekolah`
--

INSERT INTO `keuangan_biaya_sekolah` (`biaya_sekolah_id`, `jenis_bayar_id`, `konsentrasi_id`, `angkatan_id`, `jumlah`) VALUES
(1, 1, 1, 1, 500000),
(2, 1, 2, 1, 0),
(3, 1, 3, 1, 0),
(4, 1, 4, 1, 0),
(5, 2, 1, 1, 30000),
(6, 2, 2, 1, 0),
(7, 2, 3, 1, 0),
(8, 2, 4, 1, 0),
(9, 3, 1, 1, 10000),
(10, 3, 2, 1, 0),
(11, 3, 3, 1, 0),
(12, 3, 4, 1, 0),
(13, 4, 1, 1, 100000),
(14, 4, 2, 1, 0),
(15, 4, 3, 1, 0),
(16, 4, 4, 1, 0),
(17, 5, 1, 1, 100000),
(18, 5, 2, 1, 0),
(19, 5, 3, 1, 0),
(20, 5, 4, 1, 0),
(21, 6, 1, 1, 50000),
(22, 6, 2, 1, 0),
(23, 6, 3, 1, 0),
(24, 6, 4, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `keuangan_jenis_bayar`
--

CREATE TABLE IF NOT EXISTS `keuangan_jenis_bayar` (
  `jenis_bayar_id` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keuangan_jenis_bayar`
--

INSERT INTO `keuangan_jenis_bayar` (`jenis_bayar_id`, `keterangan`) VALUES
(1, 'PENDAFTARAN'),
(2, 'IURAN TAHUNAN'),
(3, 'PERPUSTAKAAN'),
(4, 'SEMESTER 1'),
(5, 'SEMESTER 2');

-- --------------------------------------------------------

--
-- Table structure for table `keuangan_pembayaran`
--

CREATE TABLE IF NOT EXISTS `keuangan_pembayaran` (
  `pembayaran_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `no_bayar` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keuangan_pembayaran_detail`
--

CREATE TABLE IF NOT EXISTS `keuangan_pembayaran_detail` (
  `pembayara_detail_id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `nis` varchar(11) NOT NULL,
  `jenis_bayar_id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keuangan_pembayaran_detail`
--

INSERT INTO `keuangan_pembayaran_detail` (`pembayara_detail_id`, `tanggal`, `nis`, `jenis_bayar_id`, `id_users`, `jumlah`, `semester`) VALUES
(1, '2018-02-13 15:28:43', '689.101', 1, 1, 500000, 0),
(4, '2018-02-13 15:59:38', '689.101', 2, 1, 30000, 0),
(5, '2018-02-13 16:07:42', '689.101', 4, 1, 100000, 0),
(6, '2018-02-13 16:13:19', '689.202', 1, 1, 500000, 0),
(7, '2018-02-28 22:50:14', '689.101', 5, 1, 50000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `keuangan_transaksi`
--

CREATE TABLE IF NOT EXISTS `keuangan_transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `nis` varchar(8) NOT NULL,
  `biaya_sekolah_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `added_by` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT 'L=lunas ,1= cicilan ke 1 ,2=cicilan ke 2, 3=cicilan ke 3'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mainmenu`
--

CREATE TABLE IF NOT EXISTS `mainmenu` (
  `id_mainmenu` int(11) NOT NULL,
  `nama_mainmenu` varchar(100) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `aktif` enum('y','t') NOT NULL,
  `link` varchar(50) NOT NULL,
  `level` int(11) NOT NULL COMMENT '1= admin,2=jurusan,3=guru'
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mainmenu`
--

INSERT INTO `mainmenu` (`id_mainmenu`, `nama_mainmenu`, `icon`, `aktif`, `link`, `level`) VALUES
(26, 'master data', 'fa fa-bar-chart-o', 'y', '#', 1),
(27, 'siswa', 'gi gi-group', 'y', 'siswa', 1),
(28, 'simas', 'fa fa-building-o', 'y', '#', 1),
(29, 'keuangan', 'gi gi-money', 'y', '#', 1),
(30, 'pengguna sistem', 'gi gi-qrcode', 'y', 'users', 1),
(31, 'siswa', 'gi gi-group', 'y', 'siswa', 2),
(32, 'guru', 'gi gi-user', 'y', 'guru', 2),
(33, 'matapelajaran', 'gi gi-address_book', 'y', 'matapelajaran', 2),
(34, 'registrasi', 'hi hi-qrcode', 'y', 'registrasi', 2),
(35, 'krs & khs', 'gi gi-display', 'y', '#', 2),
(36, 'jadwal sekolah', 'gi gi-calendar', 'y', 'jadwalsekolah', 2),
(37, 'jadwal', 'gi gi-calendar', 'y', 'jadwalsekolah/jadwalngajar', 3),
(38, 'absen siswa', 'gi gi-notes_2', 'y', 'absensi', 3),
(39, 'nilai', 'gi gi-stats', 'y', 'khs/berinilai', 3),
(40, 'bodata', 'gi gi-user', 'y', 'users/account', 3);

-- --------------------------------------------------------

--
-- Table structure for table `mapel_kelompok`
--

CREATE TABLE IF NOT EXISTS `mapel_kelompok` (
  `kelompok_id` int(11) NOT NULL,
  `kode_kelompok` varchar(5) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapel_kelompok`
--

INSERT INTO `mapel_kelompok` (`kelompok_id`, `kode_kelompok`, `nama`) VALUES
(1, 'mpk', 'mata pelajaran pengembangan keperibadian'),
(2, 'mkk', 'mata pelajaran pengembangan keilmuan dan keterampi'),
(3, 'mkb', 'mata pelajaran keahlian berkarya'),
(4, 'mpb', 'mata pelajaran perilaku berkarya'),
(5, 'mbb', 'mata pelajaran berkehidupan bermasyarakat');

-- --------------------------------------------------------

--
-- Table structure for table `mapel_matapelajaran`
--

CREATE TABLE IF NOT EXISTS `mapel_matapelajaran` (
  `mapel_id` int(11) NOT NULL,
  `kode_mapel` varchar(11) NOT NULL,
  `nama_mapel` varchar(60) NOT NULL,
  `sks` int(11) NOT NULL,
  `semester` int(1) NOT NULL,
  `konsentrasi_id` int(3) NOT NULL,
  `kelompok_id` int(1) NOT NULL,
  `aktif` enum('y','n') NOT NULL,
  `jam` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapel_matapelajaran`
--

INSERT INTO `mapel_matapelajaran` (`mapel_id`, `kode_mapel`, `nama_mapel`, `sks`, `semester`, `konsentrasi_id`, `kelompok_id`, `aktif`, `jam`) VALUES
(1, 'XIPA', 'MTK DASAR 1', 4, 1, 1, 1, 'y', 2),
(2, 'XPA1', 'MTK DASAR 2', 4, 1, 1, 1, 'y', 2),
(3, 'XPA2', 'MTK DASAR 3', 4, 1, 1, 1, 'y', 2),
(4, 'XPA3', 'MTK DASAR 4', 4, 1, 1, 1, 'y', 2),
(5, 'XPA4', 'MTK DASAR 5', 4, 1, 1, 1, 'y', 2),
(6, 'XPA5', 'MTK DASAR 6', 4, 1, 1, 1, 'y', 2);

-- --------------------------------------------------------

--
-- Table structure for table `outbox`
--

CREATE TABLE IF NOT EXISTS `outbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Text` text,
  `DestinationNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL,
  `MultiPart` enum('false','true') DEFAULT 'false',
  `RelativeValidity` int(11) DEFAULT '-1',
  `SenderID` varchar(255) DEFAULT NULL,
  `SendingTimeOut` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryReport` enum('default','yes','no') DEFAULT 'default',
  `CreatorID` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `outbox_multipart`
--

CREATE TABLE IF NOT EXISTS `outbox_multipart` (
  `Text` text,
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` text,
  `ID` int(10) unsigned NOT NULL DEFAULT '0',
  `SequencePosition` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pbk`
--

CREATE TABLE IF NOT EXISTS `pbk` (
  `ID` int(11) NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT '-1',
  `Name` text NOT NULL,
  `Number` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pbk_groups`
--

CREATE TABLE IF NOT EXISTS `pbk_groups` (
  `Name` text NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `phones`
--

CREATE TABLE IF NOT EXISTS `phones` (
  `ID` text NOT NULL,
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TimeOut` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Send` enum('yes','no') NOT NULL DEFAULT 'no',
  `Receive` enum('yes','no') NOT NULL DEFAULT 'no',
  `IMEI` varchar(35) NOT NULL,
  `Client` text NOT NULL,
  `Battery` int(11) NOT NULL DEFAULT '0',
  `Signal` int(11) NOT NULL DEFAULT '0',
  `Sent` int(11) NOT NULL DEFAULT '0',
  `Received` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sentitems`
--

CREATE TABLE IF NOT EXISTS `sentitems` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryDateTime` timestamp NULL DEFAULT NULL,
  `Text` text NOT NULL,
  `DestinationNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL DEFAULT '0',
  `SenderID` varchar(255) NOT NULL,
  `SequencePosition` int(11) NOT NULL DEFAULT '1',
  `Status` enum('SendingOK','SendingOKNoReport','SendingError','DeliveryOK','DeliveryFailed','DeliveryPending','DeliveryUnknown','Error') NOT NULL DEFAULT 'SendingOK',
  `StatusError` int(11) NOT NULL DEFAULT '-1',
  `TPMR` int(11) NOT NULL DEFAULT '-1',
  `RelativeValidity` int(11) NOT NULL DEFAULT '-1',
  `CreatorID` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL,
  `nama_sekolah` varchar(160) NOT NULL,
  `alamat_sekolah` text NOT NULL,
  `telpon` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `nama_sekolah`, `alamat_sekolah`, `telpon`) VALUES
(1, 'sma negeri 1 tuban', 'Kabupaten tuban', '0356 322725');

-- --------------------------------------------------------

--
-- Table structure for table `student_absen`
--

CREATE TABLE IF NOT EXISTS `student_absen` (
  `absen_id` int(11) NOT NULL,
  `jadwal_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_absen_detail`
--

CREATE TABLE IF NOT EXISTS `student_absen_detail` (
  `detail_id` int(11) NOT NULL,
  `absen_id` int(11) NOT NULL,
  `nis` varchar(10) NOT NULL,
  `kehadiran` varchar(1) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_angkatan`
--

CREATE TABLE IF NOT EXISTS `student_angkatan` (
  `angkatan_id` int(11) NOT NULL,
  `keterangan` varchar(15) NOT NULL,
  `aktif` varchar(1) NOT NULL COMMENT 'y = aktif dan n = tidak'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_angkatan`
--

INSERT INTO `student_angkatan` (`angkatan_id`, `keterangan`, `aktif`) VALUES
(1, '20181', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `student_siswa`
--

CREATE TABLE IF NOT EXISTS `student_siswa` (
  `siswa_id` int(11) NOT NULL,
  `nis` varchar(13) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `konsentrasi_id` int(2) NOT NULL,
  `angkatan_id` int(4) NOT NULL COMMENT 'tahun akademik ketika masuk',
  `alamat` text NOT NULL,
  `semester` int(11) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `agama_id` int(11) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `no_hp_ortu` varchar(12) NOT NULL,
  `pekerjaan_id_ibu` int(11) NOT NULL,
  `pekerjaan_id_ayah` int(11) NOT NULL,
  `alamat_ayah` text NOT NULL,
  `alamat_ibu` text NOT NULL,
  `penghasilan_ayah` int(11) NOT NULL,
  `penghasilan_ibu` int(11) NOT NULL,
  `sekolah_nama` varchar(50) NOT NULL,
  `sekolah_telpon` varchar(12) NOT NULL,
  `sekolah_alamat` text NOT NULL,
  `sekolah_jurusan` varchar(80) NOT NULL,
  `sekolah_tahun_lulus` int(4) NOT NULL,
  `kampus_nama` varchar(50) NOT NULL,
  `kampus_telpon` varchar(12) NOT NULL,
  `kampus_alamat` text NOT NULL,
  `kampus_jurusan` varchar(80) NOT NULL,
  `kampus_tahun_lulus` int(4) NOT NULL,
  `institusi_nama` varchar(80) NOT NULL,
  `institusi_telpon` varchar(12) NOT NULL,
  `institusi_alamat` text NOT NULL,
  `instansi_nama` varchar(80) NOT NULL,
  `instansi_telpon` varchar(12) NOT NULL,
  `instansi_alamat` text NOT NULL,
  `instansi_mulai` int(4) NOT NULL,
  `instansi_sampai` int(4) NOT NULL,
  `semester_aktif` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_siswa`
--

INSERT INTO `student_siswa` (`siswa_id`, `nis`, `nama`, `konsentrasi_id`, `angkatan_id`, `alamat`, `semester`, `gender`, `agama_id`, `tempat_lahir`, `tanggal_lahir`, `nama_ibu`, `nama_ayah`, `no_hp_ortu`, `pekerjaan_id_ibu`, `pekerjaan_id_ayah`, `alamat_ayah`, `alamat_ibu`, `penghasilan_ayah`, `penghasilan_ibu`, `sekolah_nama`, `sekolah_telpon`, `sekolah_alamat`, `sekolah_jurusan`, `sekolah_tahun_lulus`, `kampus_nama`, `kampus_telpon`, `kampus_alamat`, `kampus_jurusan`, `kampus_tahun_lulus`, `institusi_nama`, `institusi_telpon`, `institusi_alamat`, `instansi_nama`, `instansi_telpon`, `instansi_alamat`, `instansi_mulai`, `instansi_sampai`, `semester_aktif`) VALUES
(1, '689.101', 'DUWI EKSANTI', 1, 1, 'DS. BEKTIHARJO - SEMANDING - TUBAN', 0, '2', 1, 'tuban', '2000-02-01', '', '', '', 1, 1, '', '', 0, 0, '', '', '', '', 0, '', '', '', '', 0, '0', '', '', '', '', '0', 0, 0, 2),
(2, '689.202', 'Arta Waluyo Putra', 1, 1, 'DS.KLANGON - JATIROGO - TUBAN', 0, '1', 1, 'TUBAN', '2000-02-23', '', '', '', 1, 1, '', '', 0, 0, '', '', '', '', 0, '', '', '', '', 0, '0', '', '', '', '', '0', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `submenu`
--

CREATE TABLE IF NOT EXISTS `submenu` (
  `id_submenu` int(11) NOT NULL,
  `id_mainmenu` int(11) NOT NULL,
  `nama_submenu` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `aktif` enum('y','t') NOT NULL,
  `icon` varchar(30) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submenu`
--

INSERT INTO `submenu` (`id_submenu`, `id_mainmenu`, `nama_submenu`, `link`, `aktif`, `icon`, `level`) VALUES
(70, 28, 'tahun akademik', 'tahunakademik', 'y', 'gi gi-calendar', 1),
(71, 26, 'gedung', 'gedung', 'y', 'gi gi-cargo', 1),
(72, 26, 'ruangan', 'ruangan', 'y', 'gi gi-bank', 1),
(73, 28, 'matapelajaran', 'matapelajaran', 'y', 'gi gi-book_open', 1),
(74, 26, 'kelas', 'kelas', 'y', 'gi gi-table', 1),
(75, 26, 'konsentrasi', 'konsentrasi', 'y', 'fa fa-credit-card', 1),
(76, 26, 'guru', 'guru', 'y', 'gi gi-parents', 1),
(77, 28, 'jadwal sekolah', 'jadwalsekolah', 'y', 'fa fa-calendar', 1),
(78, 26, 'kelompok matapelajaran', 'kelompokmatapelajaran', 'y', 'gi gi-address_book', 1),
(79, 29, 'form pembayaran', 'keuangan/pembayaran', 'y', 'gi gi-coins', 1),
(80, 29, 'jenis pembayaran', 'jenisbayar', 'y', 'fa fa-puzzle-piece', 1),
(81, 29, 'biaya sekolah', 'setupbiayasekolah', 'y', 'fa fa-money', 1),
(82, 29, 'laporan keuangan', 'keuangan/laporan', 'y', 'gi gi-notes_2', 1),
(83, 28, 'registrasi', 'registrasi', 'y', 'fa fa-keyboard-o', 1),
(84, 28, 'kartu rencana studi', 'krs/lihat', 'y', 'gi gi-cart_in', 1),
(85, 35, 'kartu rencana studi', 'krs/lihat', 'y', 'gi gi-notes_2', 0),
(86, 35, 'kartu rencana studi', 'khs', 'y', 'hi hi-list-alt', 0),
(87, 26, 'grade nilai', 'grade', 'y', 'gi gi-credit_card', 0),
(88, 28, 'kartu hasil studi', 'khs', 'y', 'gi gi-notes', 0),
(89, 26, 'tahun angkatan', 'tahunangkatan', 'y', 'gi gi-calendar', 0),
(90, 29, 'laporan periode', 'keuangan/view', 'y', 'gi gi-notes_2', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akademik_jadwal_sekolah`
--
ALTER TABLE `akademik_jadwal_sekolah`
  ADD PRIMARY KEY (`jadwal_id`);

--
-- Indexes for table `akademik_kelas`
--
ALTER TABLE `akademik_kelas`
  ADD PRIMARY KEY (`kelas_id`);

--
-- Indexes for table `akademik_khs`
--
ALTER TABLE `akademik_khs`
  ADD PRIMARY KEY (`khs_id`);

--
-- Indexes for table `akademik_konsentrasi`
--
ALTER TABLE `akademik_konsentrasi`
  ADD PRIMARY KEY (`konsentrasi_id`);

--
-- Indexes for table `akademik_krs`
--
ALTER TABLE `akademik_krs`
  ADD PRIMARY KEY (`krs_id`);

--
-- Indexes for table `akademik_registrasi`
--
ALTER TABLE `akademik_registrasi`
  ADD PRIMARY KEY (`registrasi_id`);

--
-- Indexes for table `akademik_tahun_akademik`
--
ALTER TABLE `akademik_tahun_akademik`
  ADD PRIMARY KEY (`tahun_akademik_id`);

--
-- Indexes for table `akademik_waktu_sekolah`
--
ALTER TABLE `akademik_waktu_sekolah`
  ADD PRIMARY KEY (`waktu_id`);

--
-- Indexes for table `app_agama`
--
ALTER TABLE `app_agama`
  ADD PRIMARY KEY (`agama_id`);

--
-- Indexes for table `app_gedung`
--
ALTER TABLE `app_gedung`
  ADD PRIMARY KEY (`gedung_id`);

--
-- Indexes for table `app_guru`
--
ALTER TABLE `app_guru`
  ADD PRIMARY KEY (`guru_id`);

--
-- Indexes for table `app_hari`
--
ALTER TABLE `app_hari`
  ADD PRIMARY KEY (`hari_id`);

--
-- Indexes for table `app_nilai_grade`
--
ALTER TABLE `app_nilai_grade`
  ADD PRIMARY KEY (`nilai_id`);

--
-- Indexes for table `app_pekerjaan`
--
ALTER TABLE `app_pekerjaan`
  ADD PRIMARY KEY (`pekerjaan_id`);

--
-- Indexes for table `app_ruangan`
--
ALTER TABLE `app_ruangan`
  ADD PRIMARY KEY (`ruangan_id`);

--
-- Indexes for table `app_users`
--
ALTER TABLE `app_users`
  ADD PRIMARY KEY (`id_users`);

--
-- Indexes for table `app_usersiswa`
--
ALTER TABLE `app_usersiswa`
  ADD PRIMARY KEY (`id_usersiswa`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `keuangan_biaya_sekolah`
--
ALTER TABLE `keuangan_biaya_sekolah`
  ADD PRIMARY KEY (`biaya_sekolah_id`);

--
-- Indexes for table `keuangan_jenis_bayar`
--
ALTER TABLE `keuangan_jenis_bayar`
  ADD PRIMARY KEY (`jenis_bayar_id`);

--
-- Indexes for table `keuangan_pembayaran`
--
ALTER TABLE `keuangan_pembayaran`
  ADD PRIMARY KEY (`pembayaran_id`);

--
-- Indexes for table `keuangan_pembayaran_detail`
--
ALTER TABLE `keuangan_pembayaran_detail`
  ADD PRIMARY KEY (`pembayara_detail_id`);

--
-- Indexes for table `mainmenu`
--
ALTER TABLE `mainmenu`
  ADD PRIMARY KEY (`id_mainmenu`);

--
-- Indexes for table `mapel_kelompok`
--
ALTER TABLE `mapel_kelompok`
  ADD PRIMARY KEY (`kelompok_id`);

--
-- Indexes for table `mapel_matapelajaran`
--
ALTER TABLE `mapel_matapelajaran`
  ADD PRIMARY KEY (`mapel_id`);

--
-- Indexes for table `outbox`
--
ALTER TABLE `outbox`
  ADD PRIMARY KEY (`ID`), ADD KEY `outbox_date` (`SendingDateTime`,`SendingTimeOut`), ADD KEY `outbox_sender` (`SenderID`);

--
-- Indexes for table `outbox_multipart`
--
ALTER TABLE `outbox_multipart`
  ADD PRIMARY KEY (`ID`,`SequencePosition`);

--
-- Indexes for table `pbk`
--
ALTER TABLE `pbk`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pbk_groups`
--
ALTER TABLE `pbk_groups`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `phones`
--
ALTER TABLE `phones`
  ADD PRIMARY KEY (`IMEI`);

--
-- Indexes for table `sentitems`
--
ALTER TABLE `sentitems`
  ADD PRIMARY KEY (`ID`,`SequencePosition`), ADD KEY `sentitems_date` (`DeliveryDateTime`), ADD KEY `sentitems_tpmr` (`TPMR`), ADD KEY `sentitems_dest` (`DestinationNumber`), ADD KEY `sentitems_sender` (`SenderID`);

--
-- Indexes for table `student_absen`
--
ALTER TABLE `student_absen`
  ADD PRIMARY KEY (`absen_id`);

--
-- Indexes for table `student_absen_detail`
--
ALTER TABLE `student_absen_detail`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `student_angkatan`
--
ALTER TABLE `student_angkatan`
  ADD PRIMARY KEY (`angkatan_id`);

--
-- Indexes for table `student_siswa`
--
ALTER TABLE `student_siswa`
  ADD PRIMARY KEY (`siswa_id`);

--
-- Indexes for table `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`id_submenu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akademik_jadwal_sekolah`
--
ALTER TABLE `akademik_jadwal_sekolah`
  MODIFY `jadwal_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `akademik_kelas`
--
ALTER TABLE `akademik_kelas`
  MODIFY `kelas_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `akademik_khs`
--
ALTER TABLE `akademik_khs`
  MODIFY `khs_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `akademik_konsentrasi`
--
ALTER TABLE `akademik_konsentrasi`
  MODIFY `konsentrasi_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `akademik_krs`
--
ALTER TABLE `akademik_krs`
  MODIFY `krs_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `akademik_registrasi`
--
ALTER TABLE `akademik_registrasi`
  MODIFY `registrasi_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `akademik_tahun_akademik`
--
ALTER TABLE `akademik_tahun_akademik`
  MODIFY `tahun_akademik_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `akademik_waktu_sekolah`
--
ALTER TABLE `akademik_waktu_sekolah`
  MODIFY `waktu_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `app_gedung`
--
ALTER TABLE `app_gedung`
  MODIFY `gedung_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `app_guru`
--
ALTER TABLE `app_guru`
  MODIFY `guru_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `app_hari`
--
ALTER TABLE `app_hari`
  MODIFY `hari_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `app_nilai_grade`
--
ALTER TABLE `app_nilai_grade`
  MODIFY `nilai_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `app_ruangan`
--
ALTER TABLE `app_ruangan`
  MODIFY `ruangan_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `app_users`
--
ALTER TABLE `app_users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `app_usersiswa`
--
ALTER TABLE `app_usersiswa`
  MODIFY `id_usersiswa` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `ID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `keuangan_biaya_sekolah`
--
ALTER TABLE `keuangan_biaya_sekolah`
  MODIFY `biaya_sekolah_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `keuangan_jenis_bayar`
--
ALTER TABLE `keuangan_jenis_bayar`
  MODIFY `jenis_bayar_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `keuangan_pembayaran`
--
ALTER TABLE `keuangan_pembayaran`
  MODIFY `pembayaran_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `keuangan_pembayaran_detail`
--
ALTER TABLE `keuangan_pembayaran_detail`
  MODIFY `pembayara_detail_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `mainmenu`
--
ALTER TABLE `mainmenu`
  MODIFY `id_mainmenu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `mapel_kelompok`
--
ALTER TABLE `mapel_kelompok`
  MODIFY `kelompok_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `mapel_matapelajaran`
--
ALTER TABLE `mapel_matapelajaran`
  MODIFY `mapel_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `outbox`
--
ALTER TABLE `outbox`
  MODIFY `ID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pbk`
--
ALTER TABLE `pbk`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pbk_groups`
--
ALTER TABLE `pbk_groups`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student_absen`
--
ALTER TABLE `student_absen`
  MODIFY `absen_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student_absen_detail`
--
ALTER TABLE `student_absen_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student_angkatan`
--
ALTER TABLE `student_angkatan`
  MODIFY `angkatan_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `student_siswa`
--
ALTER TABLE `student_siswa`
  MODIFY `siswa_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `submenu`
--
ALTER TABLE `submenu`
  MODIFY `id_submenu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=91;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
