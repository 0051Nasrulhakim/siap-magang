-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 23, 2023 at 02:03 PM
-- Server version: 10.11.2-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magangku`
--

-- --------------------------------------------------------

--
-- Table structure for table `angkatan`
--

CREATE TABLE `angkatan` (
  `id` int(11) UNSIGNED NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `angkatan`
--

INSERT INTO `angkatan` (`id`, `tahun`, `nama`, `tgl_mulai`, `tgl_selesai`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2023', '2023 Gelombang 1', '2023-03-03', '2023-05-03', '2023-05-23 14:02:15', '2023-05-23 14:02:15', NULL),
(2, '2023', '2023 Gelombang 2', '2023-05-05', '2023-07-05', '2023-05-23 14:02:15', '2023-05-23 14:02:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Site Administrator'),
(2, 'pembimbing', 'Pembimbing magang'),
(3, 'siswa', 'Siswa');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 14),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 13);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL,
  `nama_jurusan` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama_jurusan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'RPL', '2023-05-23 14:02:15', '2023-05-23 14:02:15', NULL),
(2, 'TKJ', '2023-05-23 14:02:15', '2023-05-23 14:02:15', NULL),
(3, 'TKR', '2023-05-23 14:02:15', '2023-05-23 14:02:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lamaran`
--

CREATE TABLE `lamaran` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_siswa` int(11) UNSIGNED NOT NULL,
  `id_tempat` int(11) UNSIGNED DEFAULT NULL,
  `status` enum('pending','accepted','rejected','selesai','reject by system') NOT NULL DEFAULT 'pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logbooks`
--

CREATE TABLE `logbooks` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_siswa` int(11) UNSIGNED NOT NULL,
  `id_tempat` int(11) UNSIGNED NOT NULL,
  `id_pembimbing` int(11) UNSIGNED NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `tanggal` date NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `kegiatan` text DEFAULT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(459, '2023-03-02-071644', 'App\\Database\\Migrations\\JurusanMigrate', 'default', 'App', 1684825289, 1),
(460, '2023-03-02-211427', 'App\\Database\\Migrations\\AngkatanMigrate', 'default', 'App', 1684825289, 1),
(461, '2023-03-05-080439', 'App\\Database\\Migrations\\CreateAuthTables', 'default', 'App', 1684825289, 1),
(462, '2023-03-05-080523', 'App\\Database\\Migrations\\PembimbingMigrate', 'default', 'App', 1684825289, 1),
(463, '2023-03-05-080601', 'App\\Database\\Migrations\\SiswaMigrate', 'default', 'App', 1684825289, 1),
(464, '2023-03-06-025749', 'App\\Database\\Migrations\\TempatMagangMigrate', 'default', 'App', 1684825290, 1),
(465, '2023-03-10-165123', 'App\\Database\\Migrations\\LamaranMigrate', 'default', 'App', 1684825290, 1),
(466, '2023-03-27-034313', 'App\\Database\\Migrations\\LogBook', 'default', 'App', 1684825290, 1),
(467, '2023-04-16-053356', 'App\\Database\\Migrations\\PengumumanMigrate', 'default', 'App', 1684825290, 1),
(468, '2023-04-28-102137', 'App\\Database\\Migrations\\NilaiMigrate', 'default', 'App', 1684825290, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `idt` int(11) UNSIGNED NOT NULL,
  `ids` int(11) UNSIGNED NOT NULL,
  `n_disiplin` int(3) NOT NULL,
  `n_motivasi` int(3) NOT NULL,
  `n_kehadiran` int(3) NOT NULL,
  `n_kreatifitas` int(3) NOT NULL,
  `n_kejujuran` int(3) NOT NULL,
  `n_kesopanan` int(3) NOT NULL,
  `n_kerjasama` int(3) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembimbing`
--

CREATE TABLE `pembimbing` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `pembimbing`
--

INSERT INTO `pembimbing` (`id`, `user_id`, `nama`, `no_hp`, `email`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Karen Nurdiyanti', '(+62) 871 0743 3679', 'anom.nashiruddin@gmail.com', '2023-05-23 14:02:15', '2023-05-23 14:02:15', NULL),
(2, 2, 'Genta Puspita', '(+62) 507 4331 3216', 'jyuniar@gmail.com', '2023-05-23 14:02:15', '2023-05-23 14:02:15', NULL),
(3, 3, 'Kanda Winarsih', '(+62) 902 8047 2907', 'cindy15@gmail.co.id', '2023-05-23 14:02:15', '2023-05-23 14:02:15', NULL),
(4, 4, 'Ajimat Uyainah', '(+62) 27 1513 899', 'usamah.ika@yahoo.com', '2023-05-23 14:02:15', '2023-05-23 14:02:15', NULL),
(5, 5, 'Darmana Dabukke', '0345 1570 153', 'crajasa@yahoo.co.id', '2023-05-23 14:02:15', '2023-05-23 14:02:15', NULL),
(6, 6, 'Lutfan Maheswara', '(+62) 23 8901 084', 'fmansur@gmail.com', '2023-05-23 14:02:15', '2023-05-23 14:02:15', NULL),
(7, 7, 'Emas Rahayu', '(+62) 996 2982 8555', 'syuliarti@yahoo.com', '2023-05-23 14:02:15', '2023-05-23 14:02:15', NULL),
(8, 8, 'Tedi Suryatmi', '(+62) 350 2904 1226', 'pangeran.yuliarti@gmail.co.id', '2023-05-23 14:02:15', '2023-05-23 14:02:15', NULL),
(9, 9, 'Elvina Dabukke', '0737 2968 049', 'satya45@gmail.com', '2023-05-23 14:02:15', '2023-05-23 14:02:15', NULL),
(10, 10, 'Harja Hakim', '0207 1169 178', 'rpradipta@yahoo.co.id', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(11, 11, 'Adinata Padmasari', '(+62) 321 3688 859', 'yolanda.darsirah@gmail.co.id', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(12, 12, 'Juli Lailasari', '(+62) 256 2845 7390', 'purwanti.cawuk@gmail.co.id', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(13, 13, 'Ophelia Andriani', '0276 0234 4642', 'spradipta@gmail.com', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(14, 14, 'Eman', '+492674751026', 'amalia.wulandari@gmail.com', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `oleh` int(10) UNSIGNED NOT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `judul`, `isi`, `oleh`, `lampiran`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ut est repellat dignissimos.', 'Iusto non assumenda quo vel nulla perferendis reprehenderit beatae. Harum quisquam vero voluptatem. Nostrum aut et velit reiciendis assumenda fuga.', 12, 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(2, 'Dignissimos voluptatem ipsum incidunt aperiam qui eum.', 'Quisquam consequatur doloribus sint optio. Voluptatem qui accusamus voluptatem temporibus quia a. Eligendi non quae ut dolore. Aperiam quis enim alias natus et.', 3, 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(3, 'Nobis impedit optio eligendi aut est voluptatem.', 'Omnis non provident maiores quia pariatur nihil molestiae. Aperiam commodi voluptatem enim explicabo inventore. Harum quod quia delectus qui dolores quas natus. Sapiente voluptatem rem cumque.', 10, 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(4, 'Mollitia ab quidem voluptatem alias nulla.', 'Cum illo quas sequi aut perferendis. Excepturi sed saepe vel. Harum laboriosam at officiis voluptate sed recusandae a illum.', 4, 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(5, 'Quo quo sint omnis sit.', 'Consectetur corporis unde ea eos et qui est sit. Aut dolores dolores sed nulla cumque dolores mollitia quasi. Eaque quia quidem qui sequi dolor. Vitae tenetur sunt quo quo. Quia nisi blanditiis est.', 2, 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(6, 'Sunt delectus soluta id debitis.', 'Provident eius blanditiis magni ratione nihil maxime. Id hic temporibus aperiam et dicta est quasi. Incidunt aut voluptatem explicabo quia voluptate. Et voluptatem beatae aut voluptatem saepe sed. Recusandae aut necessitatibus recusandae sit aut. Consequatur ut maxime a.', 13, 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(7, 'Labore doloremque repellendus accusamus tempora.', 'Dolores autem quod magni itaque aut dolor. Est soluta quod nemo aut. Maxime architecto quia ad eum eveniet qui laudantium. Dolor id est aut placeat. Non ullam dolorem magnam omnis. Vel ut sequi quia voluptates.', 3, 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `nis` varchar(255) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `kelas` varchar(255) DEFAULT NULL,
  `angkatan` int(11) UNSIGNED DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `laporan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tempat_magang`
--

CREATE TABLE `tempat_magang` (
  `id` int(11) UNSIGNED NOT NULL,
  `pid` int(11) UNSIGNED DEFAULT NULL,
  `status` enum('buka','tutup') NOT NULL DEFAULT 'buka',
  `kuota` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `hp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `tempat_magang`
--

INSERT INTO `tempat_magang` (`id`, `pid`, `status`, `kuota`, `nama`, `hp`, `email`, `alamat`, `deskripsi`, `foto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'buka', 5, 'PJ Aryani', '+260515373387', 'rahayu.marsito@megantara.info', 'Dk. Laswi No. 322, Langsa 32202, Kalsel', 'Qui aut et exercitationem corrupti voluptas. Repellat quos voluptatem quae consequatur qui nulla et. Reiciendis excepturi non minima quisquam iste voluptates labore.', 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(2, 4, 'tutup', 6, 'Yayasan Namaga Wibowo', '+382307819724', 'lalita.utami@pratiwi.info', 'Ds. Otto No. 364, Denpasar 32646, Kalbar', 'Tempora vel doloribus exercitationem non consequatur. Quam pariatur sapiente quibusdam delectus rem.', 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(3, 11, 'tutup', 5, 'CV Mulyani', '+6887848036', 'diana.tarihoran@pudjiastuti.ac.id', 'Dk. Raya Setiabudhi No. 106, Banjarbaru 77603, Sumbar', 'In voluptas sunt voluptas inventore molestiae officiis. Dicta provident quia explicabo id et modi debitis consequatur. Quia aut repellat rerum totam quis quia.', 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(4, 1, 'tutup', 5, 'Yayasan Mayasari Waskita', '+2380517074', 'elisa.puspasari@wijayanti.or.id', 'Dk. Kebangkitan Nasional No. 273, Banjarbaru 66734, Kalbar', 'Numquam repudiandae quaerat hic cum in. Error velit corrupti est odio. Incidunt exercitationem autem beatae eius.', 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(5, 12, 'buka', 8, 'PD Agustina', '+9706721074077', 'kenari.pertiwi@mangunsong.name', 'Jr. Suryo Pranoto No. 550, Kotamobagu 42229, Lampung', 'Sapiente ratione ad iste corporis. Non et ad doloremque quia et eaque est.', 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(6, 5, 'tutup', 4, 'Perum Widiastuti Tbk', '+25700378291', 'sabar.narpati@putra.my.id', 'Dk. Siliwangi No. 793, Tual 55476, Papua', 'Sit deleniti vel aliquid possimus enim. Ad libero earum explicabo dolore voluptas dignissimos est sed. Autem et non occaecati molestiae tempore minus rerum.', 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(7, 6, 'tutup', 9, 'UD Nainggolan', '+50330627541', 'tarihoran.ega@oktaviani.co', 'Ki. Ikan No. 491, Bitung 49004, Banten', 'Qui harum et id molestiae optio. Eaque ad quasi ut. Voluptate dolore saepe vitae et velit delectus laborum.', 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(8, 9, 'tutup', 1, 'Perum Nasyiah Prakasa Tbk', '+268106652192', 'gatra.rajasa@hastuti.my.id', 'Jr. Gatot Subroto No. 671, Sukabumi 91477, Bengkulu', 'Soluta eos qui aliquam. Dolor aliquid sit ea tempore ut maxime dolore.', 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(9, 2, 'tutup', 5, 'PJ Pertiwi (Persero) Tbk', '+594728762280', 'jmarpaung@mulyani.asia', 'Gg. Moch. Yamin No. 107, Batam 26602, Jateng', 'Qui aut corporis sint ullam dicta. Odit neque sunt consequatur aut.', 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(10, 11, 'buka', 4, 'CV Mandala Putra Tbk', '+8801236553085', 'diah.dabukke@adriansyah.biz.id', 'Psr. Banal No. 439, Palopo 68850, Sumsel', 'Iure dolores adipisci vitae tempore soluta dicta. Pariatur eum dolore et sequi quo. Ea quia maiores quo rerum enim quos.', 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(11, 4, 'buka', 9, 'PJ Lestari', '+6788477364', 'zkusmawati@rahimah.tv', 'Jln. Sugiono No. 561, Tegal 84468, Riau', 'Hic eaque quasi iusto vel aliquid voluptas. Tempore numquam non pariatur suscipit voluptatem debitis.', 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(12, 10, 'tutup', 3, 'Perum Sirait Tbk', '+50527910548', 'banara.utama@suartini.co.id', 'Gg. Kebonjati No. 595, Cimahi 84575, Sulteng', 'Sint natus similique harum quis provident eos quisquam beatae. Voluptatem deserunt ut molestiae voluptatum.', 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(13, 2, 'buka', 1, 'Fa Habibi Nasyidah (Persero) Tbk', '+50901892788', 'taufik34@sihombing.sch.id', 'Gg. Bahagia No. 889, Subulussalam 78730, Sumsel', 'Iure corporis laboriosam accusamus voluptatem eaque accusamus molestias. Ipsam nisi debitis quidem voluptatem totam qui quos qui.', 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(14, 8, 'buka', 3, 'Yayasan Napitupulu Prastuti Tbk', '+2398988705', 'melinda62@permata.co.id', 'Ds. Ters. Buah Batu No. 594, Pekalongan 81796, Lampung', 'Dolorem sint facere vitae omnis unde doloribus. Aut ut suscipit asperiores enim rerum.', 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(15, 6, 'buka', 5, 'PJ Wacana Thamrin (Persero) Tbk', '+231968457888', 'jane80@pertiwi.go.id', 'Kpg. Warga No. 764, Cirebon 92794, Maluku', 'Non rerum sed fuga consequatur aperiam. Adipisci beatae nobis et repudiandae ad velit.', 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(16, 7, 'tutup', 9, 'Perum Widodo Hutapea Tbk', '+261165504966', 'patricia66@rahmawati.id', 'Ds. Salam No. 738, Cilegon 45816, Bengkulu', 'Quam nisi aut eum dolore. Vitae perspiciatis labore nemo quasi eum rerum consequatur.', 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(17, 13, 'tutup', 8, 'CV Wastuti', '+2463522136', 'wijayanti.nabila@januar.info', 'Dk. Bakau No. 195, Dumai 70207, Kalsel', 'Eius dolor sit et. Sit iusto unde nisi fugit quisquam.', 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(18, 6, 'tutup', 1, 'PD Puspasari Tbk', '+355865472008', 'opangestu@maryati.com', 'Psr. Raden Saleh No. 748, Metro 60637, Banten', 'Aut cupiditate ipsum aliquid aut et quasi dolore. Laudantium qui et beatae iusto magnam. Nobis inventore expedita in rerum aspernatur sed.', 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(19, 6, 'tutup', 7, 'Fa Hardiansyah Tbk', '+97470217645', 'hnurdiyanti@hartati.or.id', 'Jln. Ters. Kiaracondong No. 886, Semarang 60082, Papua', 'Itaque quia inventore harum aut velit natus. Et ea occaecati nesciunt assumenda qui ratione eos.', 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(20, 13, 'buka', 7, 'PT Andriani', '+480200234849', 'prayoga.gabriella@wulandari.biz.id', 'Kpg. Kalimantan No. 262, Magelang 73345, Sumsel', 'Repellendus deleniti est voluptas voluptatem blanditiis itaque omnis. Mollitia repellendus perferendis a est molestias eum. Id laudantium deleniti voluptatum aut voluptatibus voluptatibus.', 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(21, 10, 'tutup', 1, 'CV Hidayat Nugroho (Persero) Tbk', '+651773106506', 'gading76@winarsih.co', 'Jln. Ters. Buah Batu No. 943, Tanjungbalai 30174, Sulbar', 'Nostrum voluptas consequatur totam sed quidem. Dicta consequatur ex provident sed. Voluptatem minima provident aut nam cum sint quis.', 'https://propertywiselaunceston.com.au/wp-content/themes/property-wise/images/no-image@2x.png', '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'anom.nashiruddin@gmail.com', 'pembimbing1', '$2y$10$AgvW/oMUsWTTFbQdNOh6hOkX2UDOtd.QEuFfYSkRCB/3oGRtll95K', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-05-23 14:02:15', '2023-05-23 14:02:15', NULL),
(2, 'jyuniar@gmail.com', 'pembimbing2', '$2y$10$bRPve5W7V4I9drbCUkPJ2.vydKgqU0GKTNLoZX3kqtzujwoU8y29y', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-05-23 14:02:15', '2023-05-23 14:02:15', NULL),
(3, 'cindy15@gmail.co.id', 'pembimbing3', '$2y$10$sQrdLFB6j93CfG9MaDAUJOpVAzkWPE4lEyczqh85Nnh5USOm7hoT6', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-05-23 14:02:15', '2023-05-23 14:02:15', NULL),
(4, 'usamah.ika@yahoo.com', 'pembimbing4', '$2y$10$J2TG7sb08aQGV03mvEQlvua/Y0sqOQbyN/7kHW/UCbVerfK0AiIRK', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-05-23 14:02:15', '2023-05-23 14:02:15', NULL),
(5, 'crajasa@yahoo.co.id', 'pembimbing5', '$2y$10$S3JqO/m4ApV6LVmLKHjboeOQ03zgtiREFRWEYKg1AWpmh9wE5FnIO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-05-23 14:02:15', '2023-05-23 14:02:15', NULL),
(6, 'fmansur@gmail.com', 'pembimbing6', '$2y$10$Cou4apztnKEPOMwjH7VcYunEJ085T3VkiUfryj0nVg8GaJB1c1SeG', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-05-23 14:02:15', '2023-05-23 14:02:15', NULL),
(7, 'syuliarti@yahoo.com', 'pembimbing7', '$2y$10$LD6Qm7iN0C8jc55t9ZKisOVkXknlqZqCm/dyQ9f6QWaMRMIGHCzQG', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-05-23 14:02:15', '2023-05-23 14:02:15', NULL),
(8, 'pangeran.yuliarti@gmail.co.id', 'pembimbing8', '$2y$10$rXASnkjIEKfLn6fWDC21ie3wST5ZtDLIeJdV.aKcDPyLKe5GtuDVq', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-05-23 14:02:15', '2023-05-23 14:02:15', NULL),
(9, 'satya45@gmail.com', 'pembimbing9', '$2y$10$rBvKJpCLAuhC7loRu4injOQoH6L5hEzboxCWBIbyQWYUPKn5JZ9Z6', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-05-23 14:02:15', '2023-05-23 14:02:15', NULL),
(10, 'rpradipta@yahoo.co.id', 'pembimbing10', '$2y$10$pNQ6T3uyoCsw/2Iw6iJEqOFrq9LxapqpYVUjtZuV75GpJkYGepFzS', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(11, 'yolanda.darsirah@gmail.co.id', 'pembimbing11', '$2y$10$tp2m9DUbcFAc0xVLvDW.5uoAK4fVBmVZF7fEq36XIzao66.k5r53q', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(12, 'purwanti.cawuk@gmail.co.id', 'pembimbing12', '$2y$10$VtXyjtf13SW2JTIlofMIReTDP35cXS3GG06FpmWrCSif.M/cKnoP.', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(13, 'spradipta@gmail.com', 'pembimbing13', '$2y$10$4B6ngpqyOWaH5dHAuo.Eu.J3spbv4cbfqxZR1c8/et5KrZ67MTgKW', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL),
(14, 'admin@gmail.com', 'admin', '$2y$10$bXX3StQ90Gmpu28uPy.SDOy2ONup73uFvr78Z/cOIEngbwLp..puG', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-05-23 14:02:16', '2023-05-23 14:02:16', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angkatan`
--
ALTER TABLE `angkatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lamaran`
--
ALTER TABLE `lamaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lamaran_id_tempat_foreign` (`id_tempat`),
  ADD KEY `id_siswa_id_tempat` (`id_siswa`,`id_tempat`);

--
-- Indexes for table `logbooks`
--
ALTER TABLE `logbooks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logbooks_id_siswa_foreign` (`id_siswa`),
  ADD KEY `logbooks_id_tempat_foreign` (`id_tempat`),
  ADD KEY `logbooks_id_pembimbing_foreign` (`id_pembimbing`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilai_idt_foreign` (`idt`),
  ADD KEY `nilai_ids_foreign` (`ids`);

--
-- Indexes for table `pembimbing`
--
ALTER TABLE `pembimbing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengumuman_oleh_foreign` (`oleh`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswa_angkatan_foreign` (`angkatan`),
  ADD KEY `user_id_angkatan` (`user_id`,`angkatan`);

--
-- Indexes for table `tempat_magang`
--
ALTER TABLE `tempat_magang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `angkatan`
--
ALTER TABLE `angkatan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lamaran`
--
ALTER TABLE `lamaran`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logbooks`
--
ALTER TABLE `logbooks`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=469;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembimbing`
--
ALTER TABLE `pembimbing`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tempat_magang`
--
ALTER TABLE `tempat_magang`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lamaran`
--
ALTER TABLE `lamaran`
  ADD CONSTRAINT `lamaran_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lamaran_id_tempat_foreign` FOREIGN KEY (`id_tempat`) REFERENCES `tempat_magang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `logbooks`
--
ALTER TABLE `logbooks`
  ADD CONSTRAINT `logbooks_id_pembimbing_foreign` FOREIGN KEY (`id_pembimbing`) REFERENCES `pembimbing` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `logbooks_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `logbooks_id_tempat_foreign` FOREIGN KEY (`id_tempat`) REFERENCES `tempat_magang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ids_foreign` FOREIGN KEY (`ids`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_idt_foreign` FOREIGN KEY (`idt`) REFERENCES `tempat_magang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembimbing`
--
ALTER TABLE `pembimbing`
  ADD CONSTRAINT `pembimbing_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD CONSTRAINT `pengumuman_oleh_foreign` FOREIGN KEY (`oleh`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_angkatan_foreign` FOREIGN KEY (`angkatan`) REFERENCES `angkatan` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tempat_magang`
--
ALTER TABLE `tempat_magang`
  ADD CONSTRAINT `tempat_magang_pid_foreign` FOREIGN KEY (`pid`) REFERENCES `pembimbing` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
