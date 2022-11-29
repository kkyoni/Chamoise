-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 17, 2021 at 07:20 PM
-- Server version: 10.3.31-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.3.29-1+ubuntu20.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chamalse`
--

-- --------------------------------------------------------

--
-- Table structure for table `exclusiveoffer`
--

CREATE TABLE `exclusiveoffer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `images` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `exclusiveoffer`
--

INSERT INTO `exclusiveoffer` (`id`, `images`, `title`, `description`, `start_date`, `end_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'exclusiveoffer/M03yZthywMZ4ltPqr51f757L19mVRgWQcB8qu5Vb.png', 'Lorem Ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '2021-08-17', '2021-08-17', '2021-08-17 07:13:48', '2021-08-17 07:16:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `long` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shortdescription` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `video_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `title`, `address`, `lat`, `long`, `phone_number`, `shortdescription`, `image`, `video_url`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Lorem Ipsum', 'Patan, Gujarat, India', '23.8500156', '72.1210274', '8488080145', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'h51p4303GQ.jpg', 'https://www.lipsum.com/', '2021-08-17 07:17:58', '2021-08-17 07:17:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `locationimage`
--

CREATE TABLE `locationimage` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `locationimage`
--

INSERT INTO `locationimage` (`id`, `location_id`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', 'location/uPcmImOQn0X6L1iypYmjxXben0I2uIq576VMz8rq.png', '2021-08-17 07:17:58', '2021-08-17 07:17:58', NULL),
(2, '1', 'location/laCM4222Oh5RyoLrWFjAdxaOzBYKX9gdBakiswY5.png', '2021-08-17 07:17:58', '2021-08-17 07:17:58', NULL),
(3, '1', 'location/IEl0jHxOQVoTWwERChLcLH2DVlUxpmB7Tsdjtf9M.png', '2021-08-17 07:17:58', '2021-08-17 07:17:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0000_00_00_000000_create_settings_table', 1),
(2, '2021_02_03_000000_create_failed_jobs_table', 1),
(3, '2021_02_03_000000_create_users_table', 1),
(4, '2021_02_03_100000_create_password_resets_table', 1),
(5, '2021_07_08_121444_create_token_table', 1),
(6, '2021_07_08_122421_create_promotionsimages_table', 1),
(7, '2021_07_08_122525_create_promotions_table', 1),
(8, '2021_07_08_122837_create_locationimage_table', 1),
(9, '2021_07_08_122948_create_location_table', 1),
(10, '2021_07_14_103554_create_transaction_table', 1),
(11, '2021_07_14_103757_create_notification_table', 1),
(12, '2021_08_17_123008_create_exclusiveoffer_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `title`, `message`, `url`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Lorem Ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'https://www.lipsum.com/', '2021-08-17 07:18:35', '2021-08-17 07:18:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `title`, `description`, `start_date`, `end_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Lorem Ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '2021-08-17', '2021-08-17', '2021-08-17 07:16:00', '2021-08-17 07:16:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promotionsimages`
--

CREATE TABLE `promotionsimages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `promotions_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `promotionsimages`
--

INSERT INTO `promotionsimages` (`id`, `promotions_id`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', 'promotions/NMT2FTfr6h2O6w9s5Nk9MIlkAGn7pzwLBu1ojM4C.jpg', '2021-08-17 07:16:00', '2021-08-17 07:16:00', NULL),
(2, '1', 'promotions/MdZS28T6tc1r00AEndi5dtvR434sqz0XUXF4VXK3.png', '2021-08-17 07:16:00', '2021-08-17 07:16:00', NULL),
(3, '1', 'promotions/zxgF4F5X1qaxmvtExaBJpJjO7eXyTaM3KR8VduB3.png', '2021-08-17 07:16:00', '2021-08-17 07:16:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('BOOLEAN','NUMBER','DATE','TEXT','SELECT','FILE','TEXTAREA') COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `hidden` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `code`, `type`, `label`, `value`, `hidden`, `created_at`, `updated_at`) VALUES
(1, 'application_logo', 'FILE', 'Application logo', 'application_logo.png', 0, '2021-08-17 07:03:22', '2021-08-17 07:03:22'),
(2, 'application_title', 'TEXT', 'Application Title', 'SMN', 0, '2021-08-17 07:03:22', '2021-08-17 07:03:22'),
(3, 'favicon_logo', 'FILE', 'Favicon Logo', 'favicon_logo.png', 0, '2021-08-17 07:03:22', '2021-08-17 07:03:22'),
(4, 'copyright', 'TEXT', 'Copy Right', 'SMN', 0, '2021-08-17 07:03:22', '2021-08-17 07:03:22'),
(5, 'giftcertificate', 'TEXT', 'Gift Certificate', 'https://www.google.com/', 0, '2021-08-17 07:03:22', '2021-08-17 07:03:22');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `token`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '356', 'ios', '2021-08-17 07:36:44', '2021-08-17 08:10:50', NULL),
(2, '3565', 'ios', '2021-08-17 08:11:45', '2021-08-17 08:11:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notification_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('read','unread') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `notification_id`, `token`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', '356', 'read', '2021-08-23 13:37:38', '2021-08-23 13:37:38', NULL),
(2, '1', '3565', 'read', '2021-08-23 13:37:38', '2021-08-23 13:37:38', NULL),
(3, '1', '3565', 'unread', '2021-08-23 13:37:38', '2021-08-23 13:37:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('active','block') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `avatar`, `name`, `email`, `email_verified_at`, `password`, `user_type`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'XfkX2WLaRs.png', 'SMN', 'admin@admin.com', NULL, '$2y$10$gOS5pI6oTbWa1otEA2c2MeWyWxOvl06/aZmkTBj489C9s89l7sMbu', 'superadmin', 'active', NULL, '2021-08-17 07:03:22', '2021-08-17 08:13:21', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exclusiveoffer`
--
ALTER TABLE `exclusiveoffer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locationimage`
--
ALTER TABLE `locationimage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotionsimages`
--
ALTER TABLE `promotionsimages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_code_unique` (`code`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exclusiveoffer`
--
ALTER TABLE `exclusiveoffer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `locationimage`
--
ALTER TABLE `locationimage`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `promotionsimages`
--
ALTER TABLE `promotionsimages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
