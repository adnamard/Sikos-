-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2024 at 06:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sikos`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_status`
--

CREATE TABLE `daftar_status` (
  `id` int(5) UNSIGNED NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `daftar_status`
--

INSERT INTO `daftar_status` (`id`, `status`) VALUES
(1, 'menunggu'),
(2, 'diterima'),
(3, 'ditolak');

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id` int(5) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `luas` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) DEFAULT 1,
  `deskripsi` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id`, `nama`, `luas`, `harga`, `stok`, `deskripsi`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Alpha', '3 x 4 meter', 500000, 3, 'Kamar kos tipe Alpha adalah kamar premium yang dirancang untuk kenyamanan dan kemewahan maksimal. Tipe kamar ini cocok untuk para profesional muda atau mahasiswa yang menginginkan lingkungan yang tenang dan fasilitas modern.', 'kamar1.jpg', NULL, NULL),
(2, 'Omega', '3 x 4 meter', 450000, 2, 'Kamar tipe Omega menawarkan suasana yang sederhana namun fungsional. Dekorasi interior menggunakan warna-warna cerah dan perabotan minimalis yang membuat ruangan terasa lapang meskipun berukuran kecil. Penataan ruang yang efisien memastikan semua kebutuhan dasar terpenuhi tanpa terasa sempit.', 'kamar2.jpg', NULL, NULL),
(3, 'Gamma', '5 x 5 meter', 750000, 2, 'Kamar tipe Gamma menawarkan suasana yang nyaman dan hangat dengan sentuhan klasik. Dekorasi interior menggunakan warna-warna pastel dan bahan-bahan alami seperti kayu dan kain. Perabotan yang nyaman dan dekorasi personalisasi memberikan rasa seperti berada di rumah sendiri.', 'kamar3.jpg', NULL, NULL),
(4, 'Beta', '5 x 5 meter', 650000, 1, 'Kamar Kos Beta menawarkan kenyamanan maksimal dengan desain modern dan minimalis. Dilengkapi dengan tempat tidur queen-size yang empuk, meja belajar ergonomis, dan lemari pakaian luas. Selain itu, Kamar Kos Beta juga memiliki jendela besar yang memberikan pencahayaan alami yang melimpah serta sirkulasi udara yang baik.', 'kamar4.jpg', NULL, NULL),
(5, 'Delta', '6 x 5 meter', 750000, 1, 'Kamar Kos Delta adalah pilihan sempurna bagi kamu yang mencari kenyamanan dan kemewahan dalam satu paket. Didesain dengan sentuhan elegan, kamar ini dilengkapi dengan tempat tidur king-size, sofa nyaman, dan meja kerja yang luas. Fasilitas tambahan seperti TV kabel, kulkas mini, dan kamar mandi pribadi dengan air panas membuat pengalaman tinggalmu semakin menyenangkan. ', 'kamar5.jpg', NULL, NULL),
(9, 'Zeta', '6 x 6 meter', 1000000, 3, 'Bla bla', '1718654107_a0cde17f329a18afe123.jpg', NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-06-15-143206', 'App\\Database\\Migrations\\UserModel', 'default', 'App', 1718462022, 1),
(2, '2024-06-15-155601', 'App\\Database\\Migrations\\KamarModel', 'default', 'App', 1718468190, 2),
(3, '2024-06-17-191040', 'App\\Database\\Migrations\\SewaModel', 'default', 'App', 1718651550, 3),
(4, '2024-06-17-191938', 'App\\Database\\Migrations\\Daftarstatus', 'default', 'App', 1718652053, 4),
(5, '2024-06-17-192211', 'App\\Database\\Migrations\\StatusPembelian', 'default', 'App', 1718652167, 5),
(6, '2024-06-17-192416', 'App\\Database\\Migrations\\StatusPembelian', 'default', 'App', 1718652347, 6),
(7, '2024-06-17-192645', 'App\\Database\\Migrations\\StatusPembelian', 'default', 'App', 1718652493, 7);

-- --------------------------------------------------------

--
-- Table structure for table `sewa`
--

CREATE TABLE `sewa` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `kamar_id` int(11) UNSIGNED DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sewa`
--

INSERT INTO `sewa` (`id`, `user_id`, `kamar_id`, `jumlah`, `created_at`) VALUES
(11, 4, 2, 1, '2024-06-18 18:09:41');

-- --------------------------------------------------------

--
-- Table structure for table `status_pembelian`
--

CREATE TABLE `status_pembelian` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `kamar_id` int(11) UNSIGNED DEFAULT NULL,
  `status_id` int(11) UNSIGNED DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `transaksi` int(11) NOT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `tanggal_pembelian` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `status_pembelian`
--

INSERT INTO `status_pembelian` (`id`, `user_id`, `kamar_id`, `status_id`, `jumlah`, `transaksi`, `bukti_pembayaran`, `tanggal_pembelian`, `updated_at`) VALUES
(2, 4, 2, 2, 1, 1, '1718697074_219446e70e6a89830960.jpg', '2024-06-18 14:52:29', '2024-06-18 14:52:29'),
(3, 4, 2, 3, 1, 2, '1718697211_827585bc8a66986e600c.jpg', '2024-06-18 14:55:47', '2024-06-18 14:55:47');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telepon` int(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(5) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `telepon`, `alamat`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', 2147483647, 'Nowhere', '$2y$10$Iog1aHJQoFzNlmn4EC3hNOlDmrqAy7Wnc06kJHT1BhqmznBkMNAAK', 1, NULL, NULL),
(4, 'user1', 'user1@gmail.com', 2147483647, 'Hanging Gardens of Babylon', '$2y$10$BdjQ/HkwsjKPrWdW8Ub2U.hp2VwOcdeHKkltEhIuPJrjEHkJ3lsJ.', 0, NULL, NULL),
(7, 'gamma', 'gammarion@gmail.com', 0, 'Unknown', '$2y$10$ry/t1d9THVwNyrb9CVynD.V9A8pgrO9I2ihPtpf5vMtym77.CDGSi', 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_status`
--
ALTER TABLE `daftar_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sewa`
--
ALTER TABLE `sewa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sewa_user_id_foreign` (`user_id`),
  ADD KEY `sewa_kamar_id_foreign` (`kamar_id`);

--
-- Indexes for table `status_pembelian`
--
ALTER TABLE `status_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_pembelian_user_id_foreign` (`user_id`),
  ADD KEY `status_pembelian_kamar_id_foreign` (`kamar_id`),
  ADD KEY `status_pembelian_status_id_foreign` (`status_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_status`
--
ALTER TABLE `daftar_status`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sewa`
--
ALTER TABLE `sewa`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `status_pembelian`
--
ALTER TABLE `status_pembelian`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sewa`
--
ALTER TABLE `sewa`
  ADD CONSTRAINT `sewa_kamar_id_foreign` FOREIGN KEY (`kamar_id`) REFERENCES `kamar` (`id`),
  ADD CONSTRAINT `sewa_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `status_pembelian`
--
ALTER TABLE `status_pembelian`
  ADD CONSTRAINT `status_pembelian_kamar_id_foreign` FOREIGN KEY (`kamar_id`) REFERENCES `kamar` (`id`),
  ADD CONSTRAINT `status_pembelian_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `daftar_status` (`id`),
  ADD CONSTRAINT `status_pembelian_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
