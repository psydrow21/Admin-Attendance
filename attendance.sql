-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2022 at 11:02 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_10_11_071620_create_z_k_fetchings_table', 1),
(6, '2022_10_12_001512_create_students_table', 2),
(7, '2022_10_12_050443_create_z_kfetches_table', 2),
(8, '2022_10_12_051225_create_zkfetches_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `empid`, `status`, `name`, `email`, `username`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '320', 'active', 'Mark Jerome Cabotaje', 'psydrow21@gmail.com', 'mark', NULL, 'qwe', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `zkfetches`
--

CREATE TABLE `zkfetches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `biometricsuid` int(11) NOT NULL,
  `empid` int(11) NOT NULL,
  `logs` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zkfetches`
--

INSERT INTO `zkfetches` (`id`, `biometricsuid`, `empid`, `logs`, `status`, `type`, `created_at`, `updated_at`) VALUES
(1, 1395, 320, '2022-10-06 09:42:54', '1', '0', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(2, 1396, 320, '2022-10-06 09:43:00', '1', '1', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(3, 1397, 320, '2022-10-06 09:43:56', '1', '0', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(4, 1398, 320, '2022-10-06 11:07:57', '1', '0', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(5, 1399, 320, '2022-10-06 11:08:03', '1', '1', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(6, 1400, 320, '2022-10-10 11:19:05', '1', '0', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(7, 1401, 320, '2022-10-10 16:52:02', '1', '0', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(8, 1402, 320, '2022-10-10 16:52:07', '1', '1', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(9, 1403, 320, '2022-10-10 16:53:05', '1', '0', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(10, 1404, 320, '2022-10-10 16:53:10', '1', '1', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(11, 1405, 320, '2022-10-10 16:53:14', '1', '1', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(12, 1406, 315, '2022-10-10 16:59:10', '1', '0', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(13, 1407, 315, '2022-10-10 17:00:14', '1', '1', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(14, 1408, 320, '2022-10-11 08:02:17', '1', '0', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(15, 1409, 320, '2022-10-11 08:02:23', '1', '1', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(16, 1410, 320, '2022-10-11 08:02:35', '1', '1', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(17, 1411, 320, '2022-10-11 11:14:40', '1', '1', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(18, 1412, 320, '2022-10-11 11:14:45', '1', '0', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(19, 1413, 320, '2022-10-11 11:14:50', '1', '1', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(20, 1414, 315, '2022-10-11 11:15:02', '1', '0', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(21, 1415, 315, '2022-10-11 11:26:00', '1', '0', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(22, 1416, 315, '2022-10-11 11:26:03', '1', '0', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(23, 1417, 952, '2022-10-11 11:28:50', '1', '0', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(24, 1418, 952, '2022-10-11 11:28:54', '1', '0', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(25, 1419, 320, '2022-10-11 13:03:26', '1', '0', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(26, 1420, 564, '2022-10-11 13:04:21', '1', '0', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(27, 1421, 564, '2022-10-11 13:04:32', '1', '1', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(28, 1422, 564, '2022-10-11 13:04:38', '1', '1', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(29, 1423, 320, '2022-10-11 13:20:13', '1', '1', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(30, 1424, 952, '2022-10-11 13:20:18', '1', '1', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(31, 1425, 564, '2022-10-11 13:20:23', '1', '1', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(32, 1426, 320, '2022-10-11 14:46:32', '1', '1', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(33, 1427, 320, '2022-10-11 14:46:37', '1', '0', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(34, 1428, 952, '2022-10-11 14:46:41', '1', '0', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(35, 1429, 564, '2022-10-11 14:46:46', '1', '0', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(36, 1430, 564, '2022-10-11 14:47:00', '1', '1', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(37, 1431, 320, '2022-10-11 14:47:05', '1', '1', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(38, 1432, 952, '2022-10-11 14:47:09', '1', '1', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(39, 1433, 320, '2022-10-11 16:58:17', '1', '1', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(40, 1434, 952, '2022-10-11 16:58:24', '1', '0', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(41, 1435, 564, '2022-10-11 16:58:30', '1', '0', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(42, 1436, 320, '2022-10-11 17:10:04', '1', '0', '2022-10-11 21:54:33', '2022-10-11 21:54:33'),
(43, 1437, 564, '2022-10-11 17:14:16', '1', '0', '2022-10-11 21:54:33', '2022-10-11 21:54:33');

-- --------------------------------------------------------

--
-- Table structure for table `z_k_fetchings`
--

CREATE TABLE `z_k_fetchings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `biometricsuid` int(11) NOT NULL,
  `empid` int(11) NOT NULL,
  `logs` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_empid_unique` (`empid`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `zkfetches`
--
ALTER TABLE `zkfetches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `zkfetches_biometricsuid_unique` (`biometricsuid`);

--
-- Indexes for table `z_k_fetchings`
--
ALTER TABLE `z_k_fetchings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `z_k_fetchings_biometricsuid_unique` (`biometricsuid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `zkfetches`
--
ALTER TABLE `zkfetches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `z_k_fetchings`
--
ALTER TABLE `z_k_fetchings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
