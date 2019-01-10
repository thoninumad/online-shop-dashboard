-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jan 2019 pada 13.45
-- Versi server: 10.1.26-MariaDB
-- Versi PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `larashop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'berisi nama file image saja tanpa path',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Aksesoris Roda 2', 'aksesoris-roda-2', 'category_images/vFPqW6N3jTmKlpBLeUuDwjTgdTJOonmPRP9XWG7X.jpeg', 1, 1, NULL, NULL, '2019-01-07 08:11:54', '2019-01-07 08:51:49'),
(2, 'Aksesoris Roda 4', 'aksesoris-roda-4', 'category_images/f4l1jQicESPIrOWpbfsjXBiXvnGAB0Y9mniP8qDv.jpeg', 1, 1, NULL, NULL, '2019-01-07 08:12:15', '2019-01-09 10:43:34'),
(3, 'Komponen Ringan Kapal', 'komponen-ringan-kapal', 'category_images/LTxDrR7C7IrhY9WVp1xPhSxpqdAYICL69Kxdpq6Y.jpeg', 1, 1, NULL, NULL, '2019-01-07 08:12:33', '2019-01-07 11:19:06'),
(5, 'Lain-lain', 'lain-lain', 'category_images/ba0EnMTiRefsXI67Iiy8xBNPieiRotH4xz7u3IgT.jpeg', 1, NULL, NULL, NULL, '2019-01-07 11:18:21', '2019-01-09 12:40:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `category_product`
--

CREATE TABLE `category_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `category_product`
--

INSERT INTO `category_product` (`id`, `product_id`, `category_id`, `created_at`, `updated_at`) VALUES
(2, 2, 1, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 3, 2, NULL, NULL),
(5, 4, 2, NULL, NULL),
(6, 4, 5, NULL, NULL),
(8, 1, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_01_06_091841_penyesuaian_table_users', 2),
(4, '2019_01_07_122527_create_table_categories', 3),
(5, '2019_01_08_130041_create_products_table', 4),
(7, '2019_01_08_140438_create_product_category_table', 5),
(8, '2019_01_09_045127_create_orders_table', 6),
(9, '2019_01_09_074702_create_order_product_table', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `total_price` double(8,2) UNSIGNED NOT NULL,
  `invoice_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('SUBMIT','PROCESS','FINISH','CANCEL') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `invoice_number`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 135000.00, '201901070001', 'FINISH', '2019-01-06 23:29:24', '2019-01-09 04:44:08'),
(2, 1, 250000.00, '201901090001', 'PROCESS', '2019-01-09 08:20:00', '2019-01-09 08:20:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_product`
--

CREATE TABLE `order_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, '2019-01-06 23:29:24', '2019-01-06 23:29:24'),
(2, 1, 3, 1, '2019-01-06 23:29:24', '2019-01-06 23:29:24'),
(3, 2, 4, 1, '2019-01-09 08:20:00', '2019-01-09 08:20:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `views` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `stock` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status` enum('PUBLISH','DRAFT') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `image`, `price`, `views`, `stock`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Daya Baudouin 1400hp Besar', 'daya-baudouin-1400hp-besar', 'Ini adalah mesin kapal tempur', 'product-images/28lwObMsglpeZWhAHh7kCLYGIsvJyGTBv7Qs69ux.jpeg', 950000.00, 0, 16, 'DRAFT', 2, 2, NULL, '2019-01-08 10:12:03', '2019-01-09 04:45:54', NULL),
(2, 'Ban Sepeda Motor', 'ban-sepeda-motor', 'Ini adalah ban sepeda motor bebek', 'product-images/4mvz5zEQKp6Y9Q4xVFtfX7ecwkxr5oNSYS1M2yOD.jpeg', 100000.00, 0, 20, 'PUBLISH', 2, 2, NULL, '2019-01-08 12:55:11', '2019-01-08 19:43:34', NULL),
(3, 'Kampas Rem', 'kampas-rem', 'Ini adalah kampas rem', 'product-images/Q6fvsWtsA8Fkcf7DTXfPsIwXEaF45rc40E0nUbbB.jpeg', 35000.00, 0, 53, 'PUBLISH', 2, NULL, NULL, '2019-01-08 12:56:06', '2019-01-08 20:37:19', NULL),
(4, 'Dongkrak Buaya', 'dongkrak-buaya', 'Ini adalah dongkrak buaya', 'product-images/SlT1qqbcgWETXa4S01eITKol6ptRJjqPV6Um33ri.jpeg', 250000.00, 0, 8, 'PUBLISH', 2, 2, NULL, '2019-01-08 12:57:10', '2019-01-09 04:46:16', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `username`, `roles`, `address`, `phone`, `avatar`, `status`) VALUES
(1, 'Fathoni Nur Muhammad', 'fathonimuhammad580@gmail.com', NULL, '$2y$10$sTidVpkgvld9yVIqtzH7metfQFJ/RHbk2BhAo299Mf3iP6rJDxQ7W', 'viLhcVnzQshq4e6I936Uy9Kt8roL3xP41hEZhboaCxaZyBR7KX11I0rhCYFn', '2019-01-06 02:10:38', '2019-01-07 05:51:38', 'thoninumad', '[\"STAFF\",\"CUSTOMER\"]', 'Durungbedug, Candi, Sidoarjo', '081230048503', 'avatars/8xPKuxgJOkE3cZNHmssacpn0st8TzlofwP3EI1n2.jpeg', 'ACTIVE'),
(2, 'Site Administrator', 'administrator@larashop.test', NULL, '$2y$10$nUcAq2ZqLt9jRZW256AKnudV8/NxxkxfIxdjWRBbPjSpmRprAr1Ua', 'JAtH0N35r313NKlH9ZA7eL3ZoCJRMjEheaYaqoNE6FtHJnvDrgtPHhP6qO43', '2019-01-06 02:38:15', '2019-01-08 21:49:01', 'administrator', '[\"ADMIN\"]', 'Keputih, Sukolilo, Surabaya', '085203500626', 'avatars/SXjkAeqX8FmivvjECcORMe32YXRoL6DTjhttiWk3.png', 'ACTIVE'),
(3, 'Syafrie Dwi Faisal', 'syafriedwi@gmail.com', NULL, '$2y$10$7vMIWjc5yTfhslzCwZhTpex4KRXfFFWztchTUyGgO.q.rtME0Ygma', NULL, '2019-01-06 21:00:39', '2019-01-09 10:01:06', 'syafriedwif', '[\"STAFF\"]', 'Gunung Anyar Harapan, Rungkut, Surabaya', '091982371982', 'avatars/5CSp0W9EgrEmosXQNocdMIsFgkBTBEfRAe2SQ0Tx.jpeg', 'INACTIVE'),
(4, 'Aldy Syah D R', 'aldysyah@gmail.com', NULL, '$2y$10$nXsjst8QOL7vPP0PH00oNeODrJjd.DW3lj0hNhBhOaMpTAumd9NhC', 'Hg5X2sIIyGyG832lsQPpJKcKpaA4YjtcPjTI5wQL0GSAejCo1KLVCrMcDoYd', '2019-01-08 22:26:23', '2019-01-09 10:02:23', 'aldysyah', '[\"CUSTOMER\"]', 'Gresik Kota Baru, Gresik', '087651908234', 'avatars/j2nOtr1Hc96b67nO33bq87pAPA8ykPDBJ6U72dpl.jpeg', 'ACTIVE');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_product_product_id_foreign` (`product_id`),
  ADD KEY `category_product_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_product_order_id_foreign` (`order_id`),
  ADD KEY `order_product_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `category_product`
--
ALTER TABLE `category_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `category_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
