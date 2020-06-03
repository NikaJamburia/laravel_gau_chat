-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2019 at 01:51 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_1_id` int(11) NOT NULL,
  `user_2_id` int(11) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unapproved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_message_id` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `user_1_id`, `user_2_id`, `status`, `created_at`, `updated_at`, `last_message_id`) VALUES
(1, 1, 2, 'Approved', '2018-10-22 09:00:09', '2019-10-26 09:01:28', '18'),
(4, 1, 3, 'Approved', '2019-10-24 17:12:23', '2019-10-24 17:54:51', '17'),
(7, 3, 2, 'Approved', '2019-10-26 10:52:46', '2019-10-26 11:05:03', '19'),
(9, 1, 4, 'Approved', '2019-10-26 11:33:57', '2019-10-26 11:34:24', '15'),
(11, 4, 2, 'Approved', '2019-10-26 11:42:14', '2019-10-26 11:47:33', '22');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unseen',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `reciever_id`, `chat_id`, `status`, `created_at`, `updated_at`, `body`) VALUES
(1, 1, 2, 1, 'Seen', '2019-10-17 06:06:04', '2019-10-19 18:04:32', 'Zdarova!'),
(2, 2, 1, 1, 'Seen', '2019-10-18 20:00:00', '2019-10-19 19:13:29', 'gaumarjos'),
(4, 2, 1, 1, 'Seen', '2019-10-20 17:54:30', '2019-10-20 18:16:13', 'ra gindoda?'),
(5, 1, 2, 1, 'Seen', '2019-10-20 18:16:29', '2019-10-20 18:20:18', 'araperi'),
(6, 1, 2, 1, 'Seen', '2019-10-20 18:19:14', '2019-10-20 18:20:18', 'vsio'),
(7, 2, 1, 1, 'Seen', '2019-10-20 18:21:28', '2019-10-20 18:28:25', 'kai'),
(8, 2, 1, 1, 'Seen', '2019-10-20 18:22:19', '2019-10-20 18:28:25', 'bavshvebi rogor gyavs?'),
(9, 2, 1, 1, 'Seen', '2019-10-20 18:24:50', '2019-10-20 18:28:25', 'haaa?'),
(10, 2, 1, 1, 'Seen', '2019-10-20 18:25:27', '2019-10-20 18:28:25', '????'),
(11, 1, 2, 1, 'Seen', '2019-10-20 18:34:56', '2019-10-20 18:43:15', 'ar mcalia axla'),
(12, 2, 1, 1, 'Seen', '2019-10-20 20:03:53', '2019-10-20 20:04:46', 'wfwgwe'),
(13, 1, 2, 1, 'Seen', '2019-10-22 09:00:09', '2019-10-22 09:00:48', 'fvwsgw'),
(14, 0, 0, 0, 'Unseen', NULL, NULL, 'You can now chat with this user'),
(15, 0, 0, 0, 'Seen', NULL, NULL, 'You can now chat with this user'),
(16, 3, 1, 4, 'Seen', '2019-10-24 17:53:30', '2019-10-24 17:54:44', 'Gamarjoba'),
(17, 1, 3, 4, 'Seen', '2019-10-24 17:54:50', '2019-10-24 18:16:34', 'zd'),
(18, 1, 2, 1, 'Seen', '2019-10-26 09:01:28', '2019-10-26 11:42:52', 'aaaa'),
(19, 3, 2, 7, 'Seen', '2019-10-26 11:05:03', '2019-10-26 11:42:51', 'agfehjehe'),
(20, 2, 4, 11, 'Seen', '2019-10-26 11:43:31', '2019-10-26 11:50:07', 'hrjhnr'),
(21, 2, 4, 11, 'Seen', '2019-10-26 11:47:31', '2019-10-26 11:50:07', 'aaaafea'),
(22, 2, 4, 11, 'Seen', '2019-10-26 11:47:33', '2019-10-26 11:50:07', 'gege');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_10_15_092657_create_chats_table', 1),
(4, '2019_10_15_092745_create_messages_table', 1),
(9, '2019_10_17_221030_add_last_message_to_chats_table', 2),
(10, '2019_10_17_221203_add_body_to_messages_table', 2),
(13, '2019_10_26_130240_create_notifications_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unseen',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `body`, `link`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(9, 'friendRequest', 'The user <b>vigaca vigaca</b> Has sent you a friend request', '/friends?action=req', 'Seen', 2, '2019-10-26 11:42:14', '2019-10-26 11:42:34'),
(10, 'friendRequestAccepted', 'The user <b>nika2</b> Has accepted your friend request', '/chat', 'Seen', 4, '2019-10-26 11:42:44', '2019-10-26 11:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'nika', 'nika@gmail.com', NULL, '$2y$10$OjeHjzKczX/r3AwFMo52BuSUL7ijELkhsF.55r1HV2jxhyfkdk//O', NULL, '2019-10-15 11:07:43', '2019-10-15 11:07:43'),
(2, 'nika2', 'nika2@gmail.com', NULL, '$2y$10$hlsyLJAP0Ua6m50NeWBQ3OH.rpsZKhQ3yDqrBXKaO9VsCp.DBKDe2', NULL, '2019-10-17 17:21:48', '2019-10-17 17:21:48'),
(3, 'Nika Jamburia', 'nikaj@gmail.com', NULL, '$2y$10$6lVr4gf8MyY4rLBLcJiAKuIlb2oiwJdn2Vo2B/Bog23IqM99.OHHu', NULL, '2019-10-23 08:01:31', '2019-10-23 08:01:31'),
(4, 'vigaca vigaca', 'vigaca@gmail.com', NULL, '$2y$10$y0NWxlnDpoh.sMXH1K8j0.x.khG8nxgH3am3t7qEohTJGcB.qpG2W', NULL, '2019-10-26 11:10:00', '2019-10-26 11:10:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
