-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Mar 2020 pada 02.52
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kepegawaian`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `emp_absensi`
--

CREATE TABLE `emp_absensi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nip_pegawai` varchar(18) NOT NULL,
  `clockin` timestamp NULL DEFAULT NULL,
  `clockout` datetime NOT NULL,
  `kehadiran` varchar(25) NOT NULL,
  `judul_kegiatan` varchar(50) NOT NULL,
  `uraian_kegiatan` longtext NOT NULL,
  `kondisi_kesehatan` varchar(25) NOT NULL,
  `uraian_kondisi_kesehatan` longtext NOT NULL,
  `status_laporan` varchar(2) NOT NULL,
  `approval_by` varchar(18) NOT NULL,
  `approval_ts` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `emp_absensi`
--

INSERT INTO `emp_absensi` (`id`, `user_id`, `nip_pegawai`, `clockin`, `clockout`, `kehadiran`, `judul_kegiatan`, `uraian_kegiatan`, `kondisi_kesehatan`, `uraian_kondisi_kesehatan`, `status_laporan`, `approval_by`, `approval_ts`) VALUES
(1, 2, '000000000000000005', '2020-03-30 14:48:15', '0000-00-00 00:00:00', 'Hadir', 'asadsad', 'Direktur Utama		Direksi 	1	197206181997032002	Ririn Kadariyah	0000-00-00	0000-00-00\r\nDirektur	Keuangan, Umum dan Sistem Informasi	Direktorat Keuangan, Umum dan Sistem Informasi	2	196611091988021001	Sochif Winarno	0000-00-00	0000-00-00\r\nDirektur	 Kerjasama Pembiayaan dan Pendanaan	Direktorat Kerjasama Pembiayaan dan Pendanaan	2	197212071999031003	Muhamad Yusuf	0000-00-00	0000-00-00\r\nDirektur	Pengelolaan Aset Piutang	Direktorat Pengelolaan Aset Piutang	2	197204151993011001	Mohd Zeki Arifudin	0000-00-00	0000-00-00\r\nDirektur	 Hukum dan Manajemen Risiko	Direktorat Hukum dan Manajemen Risiko	2	197008281996031002	Aris Saputro	0000-00-00	0000-00-00\r\nKepala	SPI	Satuan Pengawasan Intern	2	000000000000000001	Toni Andrianto	0000-00-00	0000-00-00\r\nKepala Divisi	Pembiayaan	Analis	3	000000000000000002	Djoko Koes Hery Soeryanto	0000-00-00	0000-00-00\r\nKepala Divisi	 Umum dan SDM	Direktorat Keuangan, Umum dan Sistem Informasi	3	196209301988101001	Prabowo Bambang P	0000-00-00	0000-00-00\r\nKepala Divisi	 Akuntansi dan Setelmen	Direktorat Keuangan, Umum dan Sistem Informasi	3	197308101995021002	Saiful Anam	0000-00-00	0000-00-00\r\nKepala Divisi	 Anggaran	Direktorat Keuangan, Umum dan Sistem Informasi	3	197501231996021001	Abdul Rahman	0000-00-00	0000-00-00\r\nKepala Divisi	 Sistem Informasi dan Teknologi	Direktorat Keuangan, Umum dan Sistem Informasi	3	197804102002121003	Adhita Surya Permana	0000-00-00	0000-00-00\r\nKepala Divisi	 Pengelolaan Aset Piutang	Direktorat Pengelolaan Aset Piutang	3	197910182002121001	Wirawan Firman Nurcahya	0000-00-00	0000-00-00\r\nKepala Divisi	 Penyaluran Pembiayaan I	Direktorat Kerjasama Pembiayaan dan Pendanaan	3	198102222001121001	Ary Dekky Hananto	0000-00-00	0000-00-00\r\nKepala Divisi	 Penyaluran Pembiayaan II	Direktorat Kerjasama Pembiayaan dan Pendanaan	3	197609212002121003	Tonny Wahyu Poernomo	0000-00-00	0000-00-00\r\nKepala Divisi	 Hukum I	Direktorat Hukum dan Manajemen Risiko	3	197207181993011002	Yulianto	0000-00-00	0000-00-00\r\nKepala Divisi	 Manajemen Risiko	Direktorat Hukum dan Manajemen Risiko	3	197808132000011001	Adnan Agung Nugraha 	0000-00-00	0000-00-00\r\nKepala Divisi	 Kerjasama Pendanaan	Direktorat Kerjasama Pembiayaan dan Pendanaan	3	000000000000000003	Faiz Rasyid Hendrawan	0000-00-00	0000-00-00\r\nPelaksana	Pembiayaan	Analis	4	000000000000000004	Ostiawan Yudiantoro	0000-00-00	0000-00-00\r\nPelaksana	 Anggaran	Direktorat Keuangan, Umum dan Sistem Informasi	4	198302202003121002	Catur Febrianto	0000-00-00	0000-00-00\r\nPelaksana	 Umum dan SDM	Direktorat Keuangan, Umum dan Sistem Informasi	4	198301062004121001	Andry Syahputra	0000-00-00	0000-00-00\r\nPelaksana	 Akuntansi dan Setelmen	Direktorat Keuangan, Umum dan Sistem Informasi	4	198011232001121002	Eka Arisandy	0000-00-00	0000-00-00\r\nPelaksana	 Umum dan SDM	Direktorat Keuangan, Umum dan Sistem Informasi	4	198208152004121002	Stefanus Mulyono	0000-00-00	0000-00-00\r\nPelaksana	 Hukum I	Direktorat Hukum dan Manajemen Risiko	4	198309142002121004	Restu Septe Kuncoro Ginting	0000-00-00	0000-00-00\r\nPelaksana	 Penyaluran Pembiayaan I	Direktorat Kerjasama Pembiayaan dan Pendanaan	4	198309242006021001	Arip Pauzi	0000-00-00	0000-00-00\r\nPelaksana	 Kerjasama Pendanaan	Direktorat Kerjasama Pembiayaan dan Pendanaan	4	198406122006021001	Wardana Herliyanto	0000-00-00	0000-00-00\r\nPelaksana	 Anggaran	Direktorat Keuangan, Umum dan Sistem Informasi	4	198506162007101001	Fajrin Agung Wibowo	0000-00-00	0000-00-00\r\nPelaksana	SPI	Satuan Pengawasan Intern	4	198409242007101000	Amirrudin	0000-00-00	0000-00-00\r\nPelaksana	 Manajemen Risiko	Direktorat Hukum dan Manajemen Risiko	4	198404082003121002	Melthin Afrindo Riansir	0000-00-00	0000-00-00\r\nPelaksana	 Umum dan SDM	Direktorat Keuangan, Umum dan Sistem Informasi	4	198306212003121004	Fitriyanto	0000-00-00	0000-00-00\r\nPelaksana	 Sistem Informasi dan Teknologi	Direktorat Keuangan, Umum dan Sistem Informasi	4	198404162006021001	Candra Dwi Aprida	0000-00-00	0000-00-00\r\nPelaksana	 Penyaluran Pembiayaan II	Direktorat Kerjasama Pembiayaan dan Pendanaan	4	198109102002121002	Teguh Ariefianto	0000-00-00	0000-00-00\r\nPelaksana	SPI	Satuan Pengawasan Intern	4	198308302003121002	Agus Harianto	0000-00-00	0000-00-00\r\nPelaksana	Anggaran	Direktorat Keuangan, Umum dan Sistem Informasi	4	198407292006021002	Suryoto Adi Prawira	0000-00-00	0000-00-00\r\nPelaksana	 Pengelolaan Aset Piutang	Direktorat Pengelolaan Aset Piutang	4	000000000000000007	Widya Anggareni	0000-00-00	0000-00-00\r\nPelaksana	 Sistem Informasi dan Teknologi	Direktorat Keuangan, Umum dan Sistem Informasi	4	000000000000000006	Melviana Anggraini	0000-00-00	0000-00-00\r\nPelaksana	 Sistem Informasi dan Teknologi	Direktorat Keuangan, Umum dan Sistem Informasi	4	000000000000000005	Tetty Syamei Rianinda	0000-00-00	0000-00-00\r\n', 'sehat', 'alhamdulillah', '0', '', '0000-00-00 00:00:00'),
(2, 2, '000000000000000005', '2020-03-30 14:46:12', '0000-00-00 00:00:00', 'Hadir', 'asadsad', 'Direktur Utama		Direksi 	1	197206181997032002	Ririn Kadariyah	0000-00-00	0000-00-00\r\nDirektur	Keuangan, Umum dan Sistem Informasi	Direktorat Keuangan, Umum dan Sistem Informasi	2	196611091988021001	Sochif Winarno	0000-00-00	0000-00-00\r\nDirektur	 Kerjasama Pembiayaan dan Pendanaan	Direktorat Kerjasama Pembiayaan dan Pendanaan	2	197212071999031003	Muhamad Yusuf	0000-00-00	0000-00-00\r\nDirektur	Pengelolaan Aset Piutang	Direktorat Pengelolaan Aset Piutang	2	197204151993011001	Mohd Zeki Arifudin	0000-00-00	0000-00-00\r\nDirektur	 Hukum dan Manajemen Risiko	Direktorat Hukum dan Manajemen Risiko	2	197008281996031002	Aris Saputro	0000-00-00	0000-00-00\r\nKepala	SPI	Satuan Pengawasan Intern	2	000000000000000001	Toni Andrianto	0000-00-00	0000-00-00\r\nKepala Divisi	Pembiayaan	Analis	3	000000000000000002	Djoko Koes Hery Soeryanto	0000-00-00	0000-00-00\r\nKepala Divisi	 Umum dan SDM	Direktorat Keuangan, Umum dan Sistem Informasi	3	196209301988101001	Prabowo Bambang P	0000-00-00	0000-00-00\r\nKepala Divisi	 Akuntansi dan Setelmen	Direktorat Keuangan, Umum dan Sistem Informasi	3	197308101995021002	Saiful Anam	0000-00-00	0000-00-00\r\nKepala Divisi	 Anggaran	Direktorat Keuangan, Umum dan Sistem Informasi	3	197501231996021001	Abdul Rahman	0000-00-00	0000-00-00\r\nKepala Divisi	 Sistem Informasi dan Teknologi	Direktorat Keuangan, Umum dan Sistem Informasi	3	197804102002121003	Adhita Surya Permana	0000-00-00	0000-00-00\r\nKepala Divisi	 Pengelolaan Aset Piutang	Direktorat Pengelolaan Aset Piutang	3	197910182002121001	Wirawan Firman Nurcahya	0000-00-00	0000-00-00\r\nKepala Divisi	 Penyaluran Pembiayaan I	Direktorat Kerjasama Pembiayaan dan Pendanaan	3	198102222001121001	Ary Dekky Hananto	0000-00-00	0000-00-00\r\nKepala Divisi	 Penyaluran Pembiayaan II	Direktorat Kerjasama Pembiayaan dan Pendanaan	3	197609212002121003	Tonny Wahyu Poernomo	0000-00-00	0000-00-00\r\nKepala Divisi	 Hukum I	Direktorat Hukum dan Manajemen Risiko	3	197207181993011002	Yulianto	0000-00-00	0000-00-00\r\nKepala Divisi	 Manajemen Risiko	Direktorat Hukum dan Manajemen Risiko	3	197808132000011001	Adnan Agung Nugraha 	0000-00-00	0000-00-00\r\nKepala Divisi	 Kerjasama Pendanaan	Direktorat Kerjasama Pembiayaan dan Pendanaan	3	000000000000000003	Faiz Rasyid Hendrawan	0000-00-00	0000-00-00\r\nPelaksana	Pembiayaan	Analis	4	000000000000000004	Ostiawan Yudiantoro	0000-00-00	0000-00-00\r\nPelaksana	 Anggaran	Direktorat Keuangan, Umum dan Sistem Informasi	4	198302202003121002	Catur Febrianto	0000-00-00	0000-00-00\r\nPelaksana	 Umum dan SDM	Direktorat Keuangan, Umum dan Sistem Informasi	4	198301062004121001	Andry Syahputra	0000-00-00	0000-00-00\r\nPelaksana	 Akuntansi dan Setelmen	Direktorat Keuangan, Umum dan Sistem Informasi	4	198011232001121002	Eka Arisandy	0000-00-00	0000-00-00\r\nPelaksana	 Umum dan SDM	Direktorat Keuangan, Umum dan Sistem Informasi	4	198208152004121002	Stefanus Mulyono	0000-00-00	0000-00-00\r\nPelaksana	 Hukum I	Direktorat Hukum dan Manajemen Risiko	4	198309142002121004	Restu Septe Kuncoro Ginting	0000-00-00	0000-00-00\r\nPelaksana	 Penyaluran Pembiayaan I	Direktorat Kerjasama Pembiayaan dan Pendanaan	4	198309242006021001	Arip Pauzi	0000-00-00	0000-00-00\r\nPelaksana	 Kerjasama Pendanaan	Direktorat Kerjasama Pembiayaan dan Pendanaan	4	198406122006021001	Wardana Herliyanto	0000-00-00	0000-00-00\r\nPelaksana	 Anggaran	Direktorat Keuangan, Umum dan Sistem Informasi	4	198506162007101001	Fajrin Agung Wibowo	0000-00-00	0000-00-00\r\nPelaksana	SPI	Satuan Pengawasan Intern	4	198409242007101000	Amirrudin	0000-00-00	0000-00-00\r\nPelaksana	 Manajemen Risiko	Direktorat Hukum dan Manajemen Risiko	4	198404082003121002	Melthin Afrindo Riansir	0000-00-00	0000-00-00\r\nPelaksana	 Umum dan SDM	Direktorat Keuangan, Umum dan Sistem Informasi	4	198306212003121004	Fitriyanto	0000-00-00	0000-00-00\r\nPelaksana	 Sistem Informasi dan Teknologi	Direktorat Keuangan, Umum dan Sistem Informasi	4	198404162006021001	Candra Dwi Aprida	0000-00-00	0000-00-00\r\nPelaksana	 Penyaluran Pembiayaan II	Direktorat Kerjasama Pembiayaan dan Pendanaan	4	198109102002121002	Teguh Ariefianto	0000-00-00	0000-00-00\r\nPelaksana	SPI	Satuan Pengawasan Intern	4	198308302003121002	Agus Harianto	0000-00-00	0000-00-00\r\nPelaksana	Anggaran	Direktorat Keuangan, Umum dan Sistem Informasi	4	198407292006021002	Suryoto Adi Prawira	0000-00-00	0000-00-00\r\nPelaksana	 Pengelolaan Aset Piutang	Direktorat Pengelolaan Aset Piutang	4	000000000000000007	Widya Anggareni	0000-00-00	0000-00-00\r\nPelaksana	 Sistem Informasi dan Teknologi	Direktorat Keuangan, Umum dan Sistem Informasi	4	000000000000000006	Melviana Anggraini	0000-00-00	0000-00-00\r\nPelaksana	 Sistem Informasi dan Teknologi	Direktorat Keuangan, Umum dan Sistem Informasi	4	000000000000000005	Tetty Syamei Rianinda	0000-00-00	0000-00-00\r\n', 'sehat', 'alhamdulillah', '2', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `emp_divisi`
--

CREATE TABLE `emp_divisi` (
  `id` int(11) NOT NULL,
  `direktorat` varchar(50) NOT NULL,
  `divisi` varchar(50) NOT NULL,
  `kode_induk` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `emp_divisi`
--

INSERT INTO `emp_divisi` (`id`, `direktorat`, `divisi`, `kode_induk`) VALUES
(1, 'Direktorat Keuangan, Umum, dan Sistem Informasi', 'Divisi Anggaran', ''),
(2, 'Direktorat Keuangan, Umum, dan Sistem Informasi', 'Divisi Umum dan SDM', ''),
(3, 'Direktorat Keuangan, Umum, dan Sistem Informasi', 'Divisi Akuntansi dan Setelmen', ''),
(4, 'Direktorat Keuangan, Umum, dan Sistem Informasi', 'Divisi Sistem Informasi dan Teknologi', ''),
(5, 'Direktorat Kerjasama Pembiayaan dan Pendanaan', 'Divisi Kerjasama Pendanaan', ''),
(6, 'Direktorat Kerjasama Pembiayaan dan Pendanaan', 'Divisi Penyaluran Pembiayaan I', ''),
(7, 'Direktorat Kerjasama Pembiayaan dan Pendanaan', 'Divisi Penyaluran Pembiayaan II', ''),
(8, 'Direktorat Pengelolaan Aset Piutang', 'Divisi Pengelolaan Aset Piutang', ''),
(9, 'Direktorat Hukum dan Manajemen Risiko', 'Divisi Hukum I', ''),
(10, 'Direktorat Hukum dan Manajemen Risiko', 'Divisi Manajemen Risiko', ''),
(11, 'Satuan Pengawasan Intern', '-', ''),
(12, 'Analis', 'Pembiayaan', ''),
(13, 'Analis', 'Divisi Sistem Informasi dan Teknologi', ''),
(14, 'Direksi', 'Utama', ''),
(15, 'Direktorat Keuangan, Umum, dan Sistem Informasi', 'Keuangan, Umum dan Sistem Informasi', ''),
(16, 'Direktorat Kerjasama Pembiayaan dan Pendanaan', 'Kerjasama Pembiayaan dan Pendanaan', ''),
(17, 'Direktorat Pengelolaan Aset Piutang', 'Pengelolaan Aset Piutang', ''),
(18, 'Direktorat Hukum dan Manajemen Risiko', 'Hukum dan Manajemen Risiko', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `emp_historyjabatan`
--

CREATE TABLE `emp_historyjabatan` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `direktorat` varchar(50) NOT NULL,
  `divisi` varchar(50) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `level` int(11) NOT NULL,
  `nip_pegawai` varchar(18) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `mulai_jabatan` date NOT NULL,
  `akhir_jabatan` date NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `emp_historyjabatan`
--

INSERT INTO `emp_historyjabatan` (`id`, `status`, `id_divisi`, `direktorat`, `divisi`, `id_jabatan`, `nama_jabatan`, `level`, `nip_pegawai`, `nama_pegawai`, `mulai_jabatan`, `akhir_jabatan`, `keterangan`) VALUES
(1, 1, 14, 'Direksi ', '', 1, 'Direktur Utama', 1, '197206181997032002', 'Ririn Kadariyah', '0000-00-00', '0000-00-00', ''),
(2, 1, 15, 'Direktorat Keuangan, Umum dan Sistem Informasi', 'Keuangan, Umum dan Sistem Informasi', 2, 'Direktur', 2, '196611091988021001', 'Sochif Winarno', '0000-00-00', '0000-00-00', ''),
(3, 1, 16, 'Direktorat Kerjasama Pembiayaan dan Pendanaan', ' Kerjasama Pembiayaan dan Pendanaan', 2, 'Direktur', 2, '197212071999031003', 'Muhamad Yusuf', '0000-00-00', '0000-00-00', ''),
(4, 1, 17, 'Direktorat Pengelolaan Aset Piutang', 'Pengelolaan Aset Piutang', 2, 'Direktur', 2, '197204151993011001', 'Mohd Zeki Arifudin', '0000-00-00', '0000-00-00', ''),
(5, 1, 18, 'Direktorat Hukum dan Manajemen Risiko', ' Hukum dan Manajemen Risiko', 2, 'Direktur', 2, '197008281996031002', 'Aris Saputro', '0000-00-00', '0000-00-00', ''),
(6, 1, 11, 'Satuan Pengawasan Intern', 'SPI', 3, 'Kepala', 2, '000000000000000001', 'Toni Andrianto', '0000-00-00', '0000-00-00', ''),
(7, 1, 12, 'Analis', 'Pembiayaan', 4, 'Kepala Divisi', 3, '000000000000000002', 'Djoko Koes Hery Soeryanto', '0000-00-00', '0000-00-00', ''),
(8, 1, 2, 'Direktorat Keuangan, Umum dan Sistem Informasi', ' Umum dan SDM', 4, 'Kepala Divisi', 3, '196209301988101001', 'Prabowo Bambang P', '0000-00-00', '0000-00-00', ''),
(9, 1, 3, 'Direktorat Keuangan, Umum dan Sistem Informasi', ' Akuntansi dan Setelmen', 4, 'Kepala Divisi', 3, '197308101995021002', 'Saiful Anam', '0000-00-00', '0000-00-00', ''),
(10, 1, 1, 'Direktorat Keuangan, Umum dan Sistem Informasi', ' Anggaran', 4, 'Kepala Divisi', 3, '197501231996021001', 'Abdul Rahman', '0000-00-00', '0000-00-00', ''),
(11, 1, 4, 'Direktorat Keuangan, Umum dan Sistem Informasi', ' Sistem Informasi dan Teknologi', 4, 'Kepala Divisi', 3, '197804102002121003', 'Adhita Surya Permana', '0000-00-00', '0000-00-00', ''),
(12, 1, 8, 'Direktorat Pengelolaan Aset Piutang', ' Pengelolaan Aset Piutang', 4, 'Kepala Divisi', 3, '197910182002121001', 'Wirawan Firman Nurcahya', '0000-00-00', '0000-00-00', ''),
(13, 1, 6, 'Direktorat Kerjasama Pembiayaan dan Pendanaan', ' Penyaluran Pembiayaan I', 4, 'Kepala Divisi', 3, '198102222001121001', 'Ary Dekky Hananto', '0000-00-00', '0000-00-00', ''),
(14, 1, 7, 'Direktorat Kerjasama Pembiayaan dan Pendanaan', ' Penyaluran Pembiayaan II', 4, 'Kepala Divisi', 3, '197609212002121003', 'Tonny Wahyu Poernomo', '0000-00-00', '0000-00-00', ''),
(15, 1, 9, 'Direktorat Hukum dan Manajemen Risiko', ' Hukum I', 4, 'Kepala Divisi', 3, '197207181993011002', 'Yulianto', '0000-00-00', '0000-00-00', ''),
(16, 1, 10, 'Direktorat Hukum dan Manajemen Risiko', ' Manajemen Risiko', 4, 'Kepala Divisi', 3, '197808132000011001', 'Adnan Agung Nugraha ', '0000-00-00', '0000-00-00', ''),
(17, 1, 5, 'Direktorat Kerjasama Pembiayaan dan Pendanaan', ' Kerjasama Pendanaan', 4, 'Kepala Divisi', 3, '000000000000000003', 'Faiz Rasyid Hendrawan', '0000-00-00', '0000-00-00', ''),
(18, 1, 12, 'Analis', 'Pembiayaan', 5, 'Pelaksana', 4, '000000000000000004', 'Ostiawan Yudiantoro', '0000-00-00', '0000-00-00', ''),
(19, 1, 1, 'Direktorat Keuangan, Umum dan Sistem Informasi', ' Anggaran', 5, 'Pelaksana', 4, '198302202003121002', 'Catur Febrianto', '0000-00-00', '0000-00-00', ''),
(20, 1, 2, 'Direktorat Keuangan, Umum dan Sistem Informasi', ' Umum dan SDM', 5, 'Pelaksana', 4, '198301062004121001', 'Andry Syahputra', '0000-00-00', '0000-00-00', ''),
(21, 1, 3, 'Direktorat Keuangan, Umum dan Sistem Informasi', ' Akuntansi dan Setelmen', 5, 'Pelaksana', 4, '198011232001121002', 'Eka Arisandy', '0000-00-00', '0000-00-00', ''),
(22, 1, 2, 'Direktorat Keuangan, Umum dan Sistem Informasi', ' Umum dan SDM', 5, 'Pelaksana', 4, '198208152004121002', 'Stefanus Mulyono', '0000-00-00', '0000-00-00', ''),
(23, 1, 9, 'Direktorat Hukum dan Manajemen Risiko', ' Hukum I', 5, 'Pelaksana', 4, '198309142002121004', 'Restu Septe Kuncoro Ginting', '0000-00-00', '0000-00-00', ''),
(24, 1, 6, 'Direktorat Kerjasama Pembiayaan dan Pendanaan', ' Penyaluran Pembiayaan I', 5, 'Pelaksana', 4, '198309242006021001', 'Arip Pauzi', '0000-00-00', '0000-00-00', ''),
(25, 1, 5, 'Direktorat Kerjasama Pembiayaan dan Pendanaan', ' Kerjasama Pendanaan', 5, 'Pelaksana', 4, '198406122006021001', 'Wardana Herliyanto', '0000-00-00', '0000-00-00', ''),
(26, 1, 1, 'Direktorat Keuangan, Umum dan Sistem Informasi', ' Anggaran', 5, 'Pelaksana', 4, '198506162007101001', 'Fajrin Agung Wibowo', '0000-00-00', '0000-00-00', ''),
(27, 1, 11, 'Satuan Pengawasan Intern', 'SPI', 5, 'Pelaksana', 4, '198409242007101000', 'Amirrudin', '0000-00-00', '0000-00-00', ''),
(28, 1, 10, 'Direktorat Hukum dan Manajemen Risiko', ' Manajemen Risiko', 5, 'Pelaksana', 4, '198404082003121002', 'Melthin Afrindo Riansir', '0000-00-00', '0000-00-00', ''),
(29, 1, 2, 'Direktorat Keuangan, Umum dan Sistem Informasi', ' Umum dan SDM', 5, 'Pelaksana', 4, '198306212003121004', 'Fitriyanto', '0000-00-00', '0000-00-00', ''),
(30, 1, 4, 'Direktorat Keuangan, Umum dan Sistem Informasi', ' Sistem Informasi dan Teknologi', 5, 'Pelaksana', 4, '198404162006021001', 'Candra Dwi Aprida', '0000-00-00', '0000-00-00', ''),
(31, 1, 7, 'Direktorat Kerjasama Pembiayaan dan Pendanaan', ' Penyaluran Pembiayaan II', 5, 'Pelaksana', 4, '198109102002121002', 'Teguh Ariefianto', '0000-00-00', '0000-00-00', ''),
(32, 1, 11, 'Satuan Pengawasan Intern', 'SPI', 5, 'Pelaksana', 4, '198308302003121002', 'Agus Harianto', '0000-00-00', '0000-00-00', ''),
(33, 1, 1, 'Direktorat Keuangan, Umum dan Sistem Informasi', 'Anggaran', 5, 'Pelaksana', 4, '198407292006021002', 'Suryoto Adi Prawira', '0000-00-00', '0000-00-00', ''),
(34, 1, 8, 'Direktorat Pengelolaan Aset Piutang', ' Pengelolaan Aset Piutang', 5, 'Pelaksana', 4, '000000000000000007', 'Widya Anggareni', '0000-00-00', '0000-00-00', ''),
(35, 1, 4, 'Direktorat Keuangan, Umum dan Sistem Informasi', ' Sistem Informasi dan Teknologi', 5, 'Pelaksana', 4, '000000000000000006', 'Melviana Anggraini', '0000-00-00', '0000-00-00', ''),
(36, 1, 4, 'Direktorat Keuangan, Umum dan Sistem Informasi', ' Sistem Informasi dan Teknologi', 5, 'Pelaksana', 4, '000000000000000005', 'Tetty Syamei Rianinda', '0000-00-00', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `emp_institusi`
--

CREATE TABLE `emp_institusi` (
  `ID` int(11) NOT NULL,
  `regName` varchar(15) NOT NULL,
  `officialName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `emp_institusi`
--

INSERT INTO `emp_institusi` (`ID`, `regName`, `officialName`) VALUES
(1, 'PIP', 'Pusat Investasi Pemerintah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `emp_jabatan`
--

CREATE TABLE `emp_jabatan` (
  `id` int(11) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `emp_jabatan`
--

INSERT INTO `emp_jabatan` (`id`, `nama_jabatan`, `level`) VALUES
(1, 'Direktur Utama', 1),
(2, 'Direktur', 2),
(3, 'Kepala', 2),
(4, 'Kepala Divisi', 3),
(5, 'Pelaksana', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `emp_pegawai`
--

CREATE TABLE `emp_pegawai` (
  `nip` varchar(18) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `eselon` varchar(5) NOT NULL,
  `golongan` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `emp_pegawai`
--

INSERT INTO `emp_pegawai` (`nip`, `nama_pegawai`, `email`, `eselon`, `golongan`) VALUES
('000000000000000001', 'Toni Andrianto', '', '0', '0'),
('000000000000000002', 'Djoko Koes Hery Soeryanto', '', '0', '0'),
('000000000000000003', 'Faiz Rasyid Hendrawan', 'faiz@umi.id', '0', '0'),
('000000000000000004', 'Ostiawan Yudiantoro', '', '0', '0'),
('000000000000000005', 'Tetty Syamei Rianinda', 'rianindaa@umi.id', '0', '0'),
('000000000000000006', 'Melviana Anggraini', 'melvianggra@umi.id', '0', '0'),
('000000000000000007', 'Widya Anggareni', 'widya@umi.id', '0', '0'),
('196209301988101001', 'Prabowo Bambang P', '', '0', '0'),
('196611091988021001', 'Sochif Winarno', '', '0', '0'),
('197008281996031002', 'Aris Saputro', '', '0', '0'),
('197204151993011001', 'Mohd Zaki Arifudin', '', '0', '0'),
('197206181997032002', 'Ririn Kadariyah', 'ririn@umi.id', '0', '0'),
('197207181993011002', 'Yulianto', '', '0', '0'),
('197212071999031003', 'Muhamad Yusuf', '', '0', '0'),
('197308101995021002', 'Saiful Anam', '', '0', '0'),
('197501231996021001', 'Abdul Rahman', '', '0', '0'),
('197609212002121003', 'Tonny Wahyu Poernomo', '', '0', '0'),
('197804102002121003', 'Adhita Surya Permana', 'adhita@umi.id', '0', '0'),
('197808132000011001', 'Adnan Agung Nugraha ', '', '0', '0'),
('197910182002121001', 'Wirawan Firman Nurcahya', '', '0', '0'),
('198011232001121002', 'Eka Arisandy', '', '0', '0'),
('198102222001121001', 'Ary Dekky Hananto', '', '0', '0'),
('198109102002121002', 'Teguh Ariefianto', '', '0', '0'),
('198208152004121002', 'Stefanus Mulyono', '', '0', '0'),
('198301062004121001', 'Andry Syahputra', '', '0', '0'),
('198302202003121002', 'Catur Febrianto', '', '0', '0'),
('198306212003121004', 'Fitriyanto', '', '0', '0'),
('198308302003121002', 'Agus Harianto', '', '0', '0'),
('198309142002121004', 'Restu Septe Kuncoro Ginting', '', '0', '0'),
('198309242006021001', 'Arip Pauzi', '', '0', '0'),
('198404082003121002', 'Melthin Afrindo Riansir', '', '0', '0'),
('198404162006021001', 'Candra Dwi Aprida', '', '0', '0'),
('198406122006021001', 'Wardana Herliyanto', '', '0', '0'),
('198407292006021002', 'Suryoto Adi Prawira', '', '0', '0'),
('198409242007101000', 'Amirrudin', '', '0', '0'),
('198506162007101001', 'Fajrin Agung Wibowo', '', '0', '0'),
('p', 'namaPegawai', 'email', 'eselo', 'golon');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nip_pegawai` varchar(18) NOT NULL,
  `username` varchar(128) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_create` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nip_pegawai`, `username`, `fullname`, `email`, `image`, `password`, `role_id`, `is_active`, `date_create`) VALUES
(1, '', 'master', 'MASTER', 'master@umi.id', '', '$2y$10$1G99Jsf/SG9nCN/2yOgt9eS2YODTbMCF0PGnj1zJLxMj.YRKkFfFK', 1, 1, '2020-03-30 09:59:52'),
(2, '000000000000000005', 'rianindaa', 'Tetty Syamei Rianinda', 'rianindaa@gmail.com', 'dflt.jpg', '$2y$10$ORWJpb4jl3X9J/V8x/CEpe26JCoNmqUyz4/KkxDhY4VJ.qMFObO1q', 6, 1, '2020-03-30 07:05:34'),
(3, '197804102002121003', 'adhitasp', 'Adhita Surya Permana', 'adhita@umi.id', 'dflt.jpg', '$2y$10$17qEa4LxzaKAs3fNhFGaAu8NzrsyfmXnyGJ/cnED3xRRuJJ4wG2nG', 5, 1, '2020-03-30 14:05:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `submenu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`, `submenu_id`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 2),
(3, 1, 2, 3),
(4, 1, 3, 4),
(6, 2, 1, 1),
(7, 3, 1, 1),
(9, 4, 1, 1),
(10, 5, 1, 1),
(11, 6, 1, 1),
(13, 1, 3, 5),
(14, 1, 4, 6),
(16, 7, 1, 1),
(18, 7, 2, 3),
(35, 1, 5, 7),
(36, 1, 5, 8),
(37, 1, 6, 9),
(39, 6, 5, 7),
(41, 5, 6, 9),
(42, 5, 5, 8),
(43, 5, 5, 7),
(44, 5, 4, 6),
(46, 6, 4, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `group` varchar(20) NOT NULL,
  `menu` varchar(128) NOT NULL,
  `urutan` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `group`, `menu`, `urutan`) VALUES
(1, 'Account', 'Account', 100),
(2, 'Setting', 'Users', 101),
(3, 'Setting', 'Menu', 102),
(4, 'WFH', 'Absensi', 1),
(5, 'WFH', 'Laporan', 2),
(6, 'Kepegawaian', 'List Pegawai', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Direktur Utama'),
(3, 'Direktur'),
(4, 'Kepala'),
(5, 'Kepala Divisi'),
(6, 'Pelaksana'),
(7, 'SDM');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Account', 'account', 'fa fa-address-card', 1),
(2, 2, 'Roles', 'users/role', 'fa fa-users', 1),
(3, 2, 'Users', 'users', '', 1),
(4, 3, 'Menu Management', 'menu', 'far fa-fw fa-folder', 1),
(5, 3, 'Submenu Management', 'menu/submenu', '', 1),
(6, 4, 'Absensi', 'wfh/absensi', 'fa fa-user-check', 1),
(7, 5, 'Input Laporan', 'wfh/list', 'fa fa-tasks', 1),
(8, 5, 'Approval Laporan', 'wfh/approval', 'fa fa-tasks', 1),
(9, 6, 'List Pegawai', 'kepegawaian/index', 'fa fa-list', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `emp_absensi`
--
ALTER TABLE `emp_absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `emp_divisi`
--
ALTER TABLE `emp_divisi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `emp_institusi`
--
ALTER TABLE `emp_institusi`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `emp_jabatan`
--
ALTER TABLE `emp_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `emp_pegawai`
--
ALTER TABLE `emp_pegawai`
  ADD PRIMARY KEY (`nip`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `emp_absensi`
--
ALTER TABLE `emp_absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `emp_divisi`
--
ALTER TABLE `emp_divisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `emp_institusi`
--
ALTER TABLE `emp_institusi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
