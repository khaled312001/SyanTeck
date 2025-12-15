-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2025 at 04:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qixer`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountdeactives`
--

CREATE TABLE `accountdeactives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `reason` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) DEFAULT NULL,
  `account_status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `username` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `role` varchar(191) NOT NULL DEFAULT 'editor',
  `image` varchar(191) DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text DEFAULT NULL,
  `designation` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `username`, `email`, `email_verified`, `role`, `image`, `password`, `remember_token`, `created_at`, `updated_at`, `description`, `designation`) VALUES
(1, 'admin', 'super_admin', 'admin@gmail.com', 1, '1', '913', '$2y$10$A.LBLmqktb/guL.3C4I87uSPZybnQV3Jp3xt/GOdFckqmLPABOlHW', 'YpJ72UzHiBobWRanZG2VGamj61jNr0v98mWrYFghwAR0qF2IEqzAWhSmqWgw', '2025-11-14 02:18:43', '2025-11-16 09:27:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_commissions`
--

CREATE TABLE `admin_commissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_type` varchar(191) NOT NULL,
  `commission_charge_from` varchar(191) DEFAULT NULL,
  `commission_charge_type` varchar(191) DEFAULT NULL,
  `commission_charge` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_commissions`
--

INSERT INTO `admin_commissions` (`id`, `system_type`, `commission_charge_from`, `commission_charge_type`, `commission_charge`, `created_at`, `updated_at`) VALUES
(1, 'commission', NULL, 'percentage', 10, '2022-09-05 07:34:16', '2023-07-22 23:03:02');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notices`
--

CREATE TABLE `admin_notices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` longtext DEFAULT NULL,
  `notice_type` tinyint(4) NOT NULL DEFAULT 0,
  `notice_for` tinyint(4) NOT NULL DEFAULT 0,
  `expire_date` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_notices`
--

INSERT INTO `admin_notices` (`id`, `title`, `description`, `notice_type`, `notice_for`, `expire_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Notices: Demo information for title', 'qixer new version 1.7.0', 3, 1, '2024-10-31 00:00:00', 0, '2023-10-21 23:47:33', '2023-10-21 23:48:23'),
(2, 'Notices: buyer dashboard new version update', NULL, 4, 2, '2023-10-27 00:00:00', 0, '2023-10-21 23:51:06', '2023-10-21 23:51:06'),
(3, 'Notice: seller dashboard', NULL, 2, 3, '2024-10-31 00:00:00', 0, '2023-10-21 23:51:48', '2023-10-21 23:51:48');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ticket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `job_post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_notifications`
--

INSERT INTO `admin_notifications` (`id`, `order_id`, `ticket_id`, `job_post_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 71, NULL, NULL, 1, '2025-11-16 09:22:30', '2025-11-16 09:39:30'),
(2, 72, NULL, NULL, 0, '2025-11-17 19:20:01', '2025-11-17 19:20:01');

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `permission` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `amount_settings`
--

CREATE TABLE `amount_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `min_amount` double DEFAULT NULL,
  `max_amount` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `amount_settings`
--

INSERT INTO `amount_settings` (`id`, `min_amount`, `max_amount`, `created_at`, `updated_at`) VALUES
(1, 50, 250, '2022-02-07 07:54:03', '2022-02-07 07:54:24');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `created_by` varchar(191) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `blog_content` longtext DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `author` varchar(191) DEFAULT NULL,
  `excerpt` text DEFAULT NULL,
  `views` varchar(191) DEFAULT NULL,
  `visibility` varchar(191) DEFAULT NULL,
  `featured` varchar(191) DEFAULT NULL,
  `schedule_date` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` text DEFAULT NULL,
  `tag_name` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `category_id`, `user_id`, `admin_id`, `created_by`, `title`, `slug`, `blog_content`, `image`, `author`, `excerpt`, `views`, `visibility`, `featured`, `schedule_date`, `created_at`, `updated_at`, `deleted_at`, `status`, `tag_name`) VALUES
(2, '1', NULL, 22, 'admin', 'AC Repair Service By Expert AC Repair Machenic', 'ac-repair-service-by-expert-ac-repair-machenic', '<div style=\"text-align: justify;\"><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Barnaby The Bear’s my name, never call me Jack or James, I will sing my way to fame, Barnaby the Bear’s my name. Birds taught me to sing, when they took me to their king, first I had to fly, in the sky so high so high, so high so high so high, so — if you want to sing this way, think of what you’d like to say, add a tune and you will see, just how easy it can be. Treacle pudding, fish and chips, fizzy drinks and liquorice, flowers, rivers, sand and sea, snowflakes and the stars are free.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Ulysses, Ulysses — Soaring through all the galaxies. In search of Earth, flying in to the night. Ulysses, Ulysses — Fighting evil and tyranny, with all his power, and with all of his might. Ulysses — no-one else can do the things you do. Ulysses — like a bolt of thunder from the blue. Ulysses — always fighting all the evil forces bringing peace and justice to all.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Hey there where ya goin’, not exactly knowin’, who says you have to call just one place home. He’s goin’ everywhere, B.J. McKay and his best friend Bear. He just keeps on movin’, ladies keep improvin’, every day is better than the last. New dreams and better scenes, and best of all I don’t pay property tax. Rollin’ down to Dallas, who’s providin’ my palace, off to New Orleans or who knows where. Places new and ladies, too, I’m B.J. McKay and this is my best friend Bear.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">80 days around the world, we’ll find a pot of gold just sitting where the rainbow’s ending. Time — we’ll fight against the time, and we’ll fly on the white wings of the wind. 80 days around the world, no we won’t say a word before the ship is really back. Round, round, all around the world. Round, all around the world. Round, all around the world. Round, all around the world.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">I never spend much time in school but I taught ladies plenty. It’s true I hire my body out for pay, hey hey. I’ve gotten burned over Cheryl Tiegs, blown up for Raquel Welch. But when I end up in the hay it’s only hay, hey hey. I might jump an open drawbridge, or Tarzan from a vine. ’Cause I’m the unknown stuntman that makes Eastwood look so fine.&nbsp;</span></font></p></div>', '103', 's-admin@gmail.com', '80 days around the world, we’ll find a pot of gold just sitting where the rainbow’s ending.', '0', 'public', NULL, NULL, '2022-01-08 03:18:18', '2022-02-13 02:50:53', NULL, 'publish', '[\"Electronics\"]'),
(3, '5', NULL, 22, 'admin', 'Get Beard Shaving Service At Low Price', 'get-beard-shaving-service-at-low-price', '<p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Barnaby The Bear’s my name, never call me Jack or James, I will sing my way to fame, Barnaby the Bear’s my name. Birds taught me to sing, when they took me to their king, first I had to fly, in the sky so high so high, so high so high so high, so — if you want to sing this way, think of what you’d like to say, add a tune and you will see, just how easy it can be. Treacle pudding, fish and chips, fizzy drinks and liquorice, flowers, rivers, sand and sea, snowflakes and the stars are free.</span></font></p><p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Ulysses, Ulysses — Soaring through all the galaxies. In search of Earth, flying in to the night. Ulysses, Ulysses — Fighting evil and tyranny, with all his power, and with all of his might. Ulysses — no-one else can do the things you do. Ulysses — like a bolt of thunder from the blue. Ulysses — always fighting all the evil forces bringing peace and justice to all.</span></font></p><p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Hey there where ya goin’, not exactly knowin’, who says you have to call just one place home. He’s goin’ everywhere, B.J. McKay and his best friend Bear. He just keeps on movin’, ladies keep improvin’, every day is better than the last. New dreams and better scenes, and best of all I don’t pay property tax. Rollin’ down to Dallas, who’s providin’ my palace, off to New Orleans or who knows where. Places new and ladies, too, I’m B.J. McKay and this is my best friend Bear.</span></font></p><p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">80 days around the world, we’ll find a pot of gold just sitting where the rainbow’s ending. Time — we’ll fight against the time, and we’ll fly on the white wings of the wind. 80 days around the world, no we won’t say a word before the ship is really back. Round, round, all around the world. Round, all around the world. Round, all around the world. Round, all around the world.</span></font></p><p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">I never spend much time in school but I taught ladies plenty. It’s true I hire my body out for pay, hey hey. I’ve gotten burned over Cheryl Tiegs, blown up for Raquel Welch. But when I end up in the hay it’s only hay, hey hey. I might jump an open drawbridge, or Tarzan from a vine. ’Cause I’m the unknown stuntman that makes Eastwood look so fine.&nbsp;</span></font></p>', '104', 's-admin@gmail.com', '80 days around the world, we’ll find a pot of gold just sitting where the rainbow’s ending.', '0', 'public', NULL, NULL, '2022-01-08 03:22:45', '2022-02-13 02:50:31', NULL, 'publish', '[\"Salon & Spa\",\"Body Message\"]'),
(4, '4', NULL, 22, 'admin', 'Painting & Renovation Service From Us At Affordable Price', 'painting-&-renovation-service-from-us-at-affordable-price', '<div style=\"text-align: justify;\"><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Barnaby The Bear’s my name, never call me Jack or James, I will sing my way to fame, Barnaby the Bear’s my name. Birds taught me to sing, when they took me to their king, first I had to fly, in the sky so high so high, so high so high so high, so — if you want to sing this way, think of what you’d like to say, add a tune and you will see, just how easy it can be. Treacle pudding, fish and chips, fizzy drinks and liquorice, flowers, rivers, sand and sea, snowflakes and the stars are free.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Ulysses, Ulysses — Soaring through all the galaxies. In search of Earth, flying in to the night. Ulysses, Ulysses — Fighting evil and tyranny, with all his power, and with all of his might. Ulysses — no-one else can do the things you do. Ulysses — like a bolt of thunder from the blue. Ulysses — always fighting all the evil forces bringing peace and justice to all.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Hey there where ya goin’, not exactly knowin’, who says you have to call just one place home. He’s goin’ everywhere, B.J. McKay and his best friend Bear. He just keeps on movin’, ladies keep improvin’, every day is better than the last. New dreams and better scenes, and best of all I don’t pay property tax. Rollin’ down to Dallas, who’s providin’ my palace, off to New Orleans or who knows where. Places new and ladies, too, I’m B.J. McKay and this is my best friend Bear.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">80 days around the world, we’ll find a pot of gold just sitting where the rainbow’s ending. Time — we’ll fight against the time, and we’ll fly on the white wings of the wind. 80 days around the world, no we won’t say a word before the ship is really back. Round, round, all around the world. Round, all around the world. Round, all around the world. Round, all around the world.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">I never spend much time in school but I taught ladies plenty. It’s true I hire my body out for pay, hey hey. I’ve gotten burned over Cheryl Tiegs, blown up for Raquel Welch. But when I end up in the hay it’s only hay, hey hey. I might jump an open drawbridge, or Tarzan from a vine. ’Cause I’m the unknown stuntman that makes Eastwood look so fine.&nbsp;</span></font></p></div>', '105', 's-admin@gmail.com', '80 days around the world, we’ll find a pot of gold just sitting where the rainbow’s ending.', '0', 'public', 'on', NULL, '2022-01-08 05:23:52', '2022-02-13 02:49:52', NULL, 'publish', '[\"Painting\"]'),
(5, '2', NULL, 22, 'admin', 'Cleaning & Renovation Service By Our Expert Cleaner', 'cleaning-&-renovation-service-by-our-expert-cleaner', '<div style=\"text-align: justify;\"><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Barnaby The Bear’s my name, never call me Jack or James, I will sing my way to fame, Barnaby the Bear’s my name. Birds taught me to sing, when they took me to their king, first I had to fly, in the sky so high so high, so high so high so high, so — if you want to sing this way, think of what you’d like to say, add a tune and you will see, just how easy it can be. Treacle pudding, fish and chips, fizzy drinks and liquorice, flowers, rivers, sand and sea, snowflakes and the stars are free.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Ulysses, Ulysses — Soaring through all the galaxies. In search of Earth, flying in to the night. Ulysses, Ulysses — Fighting evil and tyranny, with all his power, and with all of his might. Ulysses — no-one else can do the things you do. Ulysses — like a bolt of thunder from the blue. Ulysses — always fighting all the evil forces bringing peace and justice to all.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Hey there where ya goin’, not exactly knowin’, who says you have to call just one place home. He’s goin’ everywhere, B.J. McKay and his best friend Bear. He just keeps on movin’, ladies keep improvin’, every day is better than the last. New dreams and better scenes, and best of all I don’t pay property tax. Rollin’ down to Dallas, who’s providin’ my palace, off to New Orleans or who knows where. Places new and ladies, too, I’m B.J. McKay and this is my best friend Bear.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">80 days around the world, we’ll find a pot of gold just sitting where the rainbow’s ending. Time — we’ll fight against the time, and we’ll fly on the white wings of the wind. 80 days around the world, no we won’t say a word before the ship is really back. Round, round, all around the world. Round, all around the world. Round, all around the world. Round, all around the world.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">I never spend much time in school but I taught ladies plenty. It’s true I hire my body out for pay, hey hey. I’ve gotten burned over Cheryl Tiegs, blown up for Raquel Welch. But when I end up in the hay it’s only hay, hey hey. I might jump an open drawbridge, or Tarzan from a vine. ’Cause I’m the unknown stuntman that makes Eastwood look so fine.&nbsp;</span></font></p></div>', '107', 's-admin@gmail.com', '80 days around the world, we’ll find a pot of gold just sitting where the rainbow’s ending.', '0', 'public', NULL, NULL, '2022-01-08 05:23:57', '2022-02-13 02:49:21', NULL, 'publish', '[\"Cleaning\"]'),
(6, '1', NULL, 22, 'admin', 'AC Cleaning Service ! Get ASAP And Take The Best Benifits', 'ac-cleaning-service-!-get-asap-and-take-the-best-benifits', '<div style=\"text-align: justify;\"><div style=\"text-align: left;\"><p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Barnaby The Bear’s my name, never call me Jack or James, I will sing my way to fame, Barnaby the Bear’s my name. Birds taught me to sing, when they took me to their king, first I had to fly, in the sky so high so high, so high so high so high, so — if you want to sing this way, think of what you’d like to say, add a tune and you will see, just how easy it can be. Treacle pudding, fish and chips, fizzy drinks and liquorice, flowers, rivers, sand and sea, snowflakes and the stars are free.</span></font></p><p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Ulysses, Ulysses — Soaring through all the galaxies. In search of Earth, flying in to the night. Ulysses, Ulysses — Fighting evil and tyranny, with all his power, and with all of his might. Ulysses — no-one else can do the things you do. Ulysses — like a bolt of thunder from the blue. Ulysses — always fighting all the evil forces bringing peace and justice to all.</span></font></p><p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Hey there where ya goin’, not exactly knowin’, who says you have to call just one place home. He’s goin’ everywhere, B.J. McKay and his best friend Bear. He just keeps on movin’, ladies keep improvin’, every day is better than the last. New dreams and better scenes, and best of all I don’t pay property tax. Rollin’ down to Dallas, who’s providin’ my palace, off to New Orleans or who knows where. Places new and ladies, too, I’m B.J. McKay and this is my best friend Bear.</span></font></p><p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">80 days around the world, we’ll find a pot of gold just sitting where the rainbow’s ending. Time — we’ll fight against the time, and we’ll fly on the white wings of the wind. 80 days around the world, no we won’t say a word before the ship is really back. Round, round, all around the world. Round, all around the world. Round, all around the world. Round, all around the world.</span></font></p><p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">I never spend much time in school but I taught ladies plenty. It’s true I hire my body out for pay, hey hey. I’ve gotten burned over Cheryl Tiegs, blown up for Raquel Welch. But when I end up in the hay it’s only hay, hey hey. I might jump an open drawbridge, or Tarzan from a vine. ’Cause I’m the unknown stuntman that makes Eastwood look so fine.&nbsp;</span></font></p></div></div>', '108', 's-admin@gmail.com', '80 days around the world, we’ll find a pot of gold just sitting where the rainbow’s ending.', '0', 'public', NULL, NULL, '2022-01-08 05:24:04', '2022-02-13 02:48:58', NULL, 'publish', '[\"Electronics\"]'),
(7, '3', NULL, 22, 'admin', 'Moving Service From One Place to Another', 'moving-service-from-one-place-to-another', '<div style=\"text-align: justify;\"><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Barnaby The Bear’s my name, never call me Jack or James, I will sing my way to fame, Barnaby the Bear’s my name. Birds taught me to sing, when they took me to their king, first I had to fly, in the sky so high so high, so high so high so high, so — if you want to sing this way, think of what you’d like to say, add a tune and you will see, just how easy it can be. Treacle pudding, fish and chips, fizzy drinks and liquorice, flowers, rivers, sand and sea, snowflakes and the stars are free.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Ulysses, Ulysses — Soaring through all the galaxies. In search of Earth, flying in to the night. Ulysses, Ulysses — Fighting evil and tyranny, with all his power, and with all of his might. Ulysses — no-one else can do the things you do. Ulysses — like a bolt of thunder from the blue. Ulysses — always fighting all the evil forces bringing peace and justice to all.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Hey there where ya goin’, not exactly knowin’, who says you have to call just one place home. He’s goin’ everywhere, B.J. McKay and his best friend Bear. He just keeps on movin’, ladies keep improvin’, every day is better than the last. New dreams and better scenes, and best of all I don’t pay property tax. Rollin’ down to Dallas, who’s providin’ my palace, off to New Orleans or who knows where. Places new and ladies, too, I’m B.J. McKay and this is my best friend Bear.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">80 days around the world, we’ll find a pot of gold just sitting where the rainbow’s ending. Time — we’ll fight against the time, and we’ll fly on the white wings of the wind. 80 days around the world, no we won’t say a word before the ship is really back. Round, round, all around the world. Round, all around the world. Round, all around the world. Round, all around the world.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">I never spend much time in school but I taught ladies plenty. It’s true I hire my body out for pay, hey hey. I’ve gotten burned over Cheryl Tiegs, blown up for Raquel Welch. But when I end up in the hay it’s only hay, hey hey. I might jump an open drawbridge, or Tarzan from a vine. ’Cause I’m the unknown stuntman that makes Eastwood look so fine.&nbsp;</span></font></p></div>', '106', 's-admin@gmail.com', '80 days around the world, we’ll find a pot of gold just sitting where the rainbow’s ending.', '0', 'public', NULL, NULL, '2022-01-08 05:24:08', '2022-02-13 02:47:43', NULL, 'publish', '[\"Home Move\"]'),
(8, '4', NULL, 22, 'admin', 'Our Cool Painting Service Only For You', 'our-cool-painting-service-only-for-you', '<div style=\"text-align: justify;\"><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Barnaby The Bear’s my name, never call me Jack or James, I will sing my way to fame, Barnaby the Bear’s my name. Birds taught me to sing, when they took me to their king, first I had to fly, in the sky so high so high, so high so high so high, so — if you want to sing this way, think of what you’d like to say, add a tune and you will see, just how easy it can be. Treacle pudding, fish and chips, fizzy drinks and liquorice, flowers, rivers, sand and sea, snowflakes and the stars are free.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Ulysses, Ulysses — Soaring through all the galaxies. In search of Earth, flying in to the night. Ulysses, Ulysses — Fighting evil and tyranny, with all his power, and with all of his might. Ulysses — no-one else can do the things you do. Ulysses — like a bolt of thunder from the blue. Ulysses — always fighting all the evil forces bringing peace and justice to all.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Hey there where ya goin’, not exactly knowin’, who says you have to call just one place home. He’s goin’ everywhere, B.J. McKay and his best friend Bear. He just keeps on movin’, ladies keep improvin’, every day is better than the last. New dreams and better scenes, and best of all I don’t pay property tax. Rollin’ down to Dallas, who’s providin’ my palace, off to New Orleans or who knows where. Places new and ladies, too, I’m B.J. McKay and this is my best friend Bear.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">80 days around the world, we’ll find a pot of gold just sitting where the rainbow’s ending. Time — we’ll fight against the time, and we’ll fly on the white wings of the wind. 80 days around the world, no we won’t say a word before the ship is really back. Round, round, all around the world. Round, all around the world. Round, all around the world. Round, all around the world.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">I never spend much time in school but I taught ladies plenty. It’s true I hire my body out for pay, hey hey. I’ve gotten burned over Cheryl Tiegs, blown up for Raquel Welch. But when I end up in the hay it’s only hay, hey hey. I might jump an open drawbridge, or Tarzan from a vine. ’Cause I’m the unknown stuntman that makes Eastwood look so fine.&nbsp;</span></font></p></div>', '109', 's-admin@gmail.com', '80 days around the world, we’ll find a pot of gold just sitting where the rainbow’s ending.', '0', 'public', 'on', NULL, '2022-01-08 05:24:12', '2022-02-13 02:46:58', NULL, 'publish', '[\"Painting Home Mobe test Color Paint  2305 %&433\"]'),
(9, '5', NULL, 22, 'admin', 'Now Get Massage Service From Mr Mahmud', 'now-get-massage-service-from-mr-mahmud', '<div style=\"text-align: justify;\"><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Barnaby The Bear’s my name, never call me Jack or James, I will sing my way to fame, Barnaby the Bear’s my name. Birds taught me to sing, when they took me to their king, first I had to fly, in the sky so high so high, so high so high so high, so — if you want to sing this way, think of what you’d like to say, add a tune and you will see, just how easy it can be. Treacle pudding, fish and chips, fizzy drinks and liquorice, flowers, rivers, sand and sea, snowflakes and the stars are free.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Ulysses, Ulysses — Soaring through all the galaxies. In search of Earth, flying in to the night. Ulysses, Ulysses — Fighting evil and tyranny, with all his power, and with all of his might. Ulysses — no-one else can do the things you do. Ulysses — like a bolt of thunder from the blue. Ulysses — always fighting all the evil forces bringing peace and justice to all.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Hey there where ya goin’, not exactly knowin’, who says you have to call just one place home. He’s goin’ everywhere, B.J. McKay and his best friend Bear. He just keeps on movin’, ladies keep improvin’, every day is better than the last. New dreams and better scenes, and best of all I don’t pay property tax. Rollin’ down to Dallas, who’s providin’ my palace, off to New Orleans or who knows where. Places new and ladies, too, I’m B.J. McKay and this is my best friend Bear.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">80 days around the world, we’ll find a pot of gold just sitting where the rainbow’s ending. Time — we’ll fight against the time, and we’ll fly on the white wings of the wind. 80 days around the world, no we won’t say a word before the ship is really back. Round, round, all around the world. Round, all around the world. Round, all around the world. Round, all around the world.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">I never spend much time in school but I taught ladies plenty. It’s true I hire my body out for pay, hey hey. I’ve gotten burned over Cheryl Tiegs, blown up for Raquel Welch. But when I end up in the hay it’s only hay, hey hey. I might jump an open drawbridge, or Tarzan from a vine. ’Cause I’m the unknown stuntman that makes Eastwood look so fine.&nbsp;</span></font></p></div>', '110', 's-admin@gmail.com', '80 days around the world, we’ll find a pot of gold just sitting where the rainbow’s ending.', '0', 'public', 'on', NULL, '2022-01-08 05:24:17', '2022-02-13 02:46:32', NULL, 'publish', '[\"Salon & Spa\"]'),
(10, '5', NULL, 22, 'admin', 'Hair Cutting Service At Reasonable Price', 'hair-cutting-service-at-reasonable-price', '<div style=\"text-align: justify;\"><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Barnaby The Bear’s my name, never call me Jack or James, I will sing my way to fame, Barnaby the Bear’s my name. Birds taught me to sing, when they took me to their king, first I had to fly, in the sky so high so high, so high so high so high, so — if you want to sing this way, think of what you’d like to say, add a tune and you will see, just how easy it can be. Treacle pudding, fish and chips, fizzy drinks and liquorice, flowers, rivers, sand and sea, snowflakes and the stars are free.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Ulysses, Ulysses — Soaring through all the galaxies. In search of Earth, flying in to the night. Ulysses, Ulysses — Fighting evil and tyranny, with all his power, and with all of his might. Ulysses — no-one else can do the things you do. Ulysses — like a bolt of thunder from the blue. Ulysses — always fighting all the evil forces bringing peace and justice to all.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Hey there where ya goin’, not exactly knowin’, who says you have to call just one place home. He’s goin’ everywhere, B.J. McKay and his best friend Bear. He just keeps on movin’, ladies keep improvin’, every day is better than the last. New dreams and better scenes, and best of all I don’t pay property tax. Rollin’ down to Dallas, who’s providin’ my palace, off to New Orleans or who knows where. Places new and ladies, too, I’m B.J. McKay and this is my best friend Bear.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">80 days around the world, we’ll find a pot of gold just sitting where the rainbow’s ending. Time — we’ll fight against the time, and we’ll fly on the white wings of the wind. 80 days around the world, no we won’t say a word before the ship is really back. Round, round, all around the world. Round, all around the world. Round, all around the world. Round, all around the world.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">I never spend much time in school but I taught ladies plenty. It’s true I hire my body out for pay, hey hey. I’ve gotten burned over Cheryl Tiegs, blown up for Raquel Welch. But when I end up in the hay it’s only hay, hey hey. I might jump an open drawbridge, or Tarzan from a vine. ’Cause I’m the unknown stuntman that makes Eastwood look so fine.&nbsp;</span></font></p></div>', '111', 's-admin@gmail.com', '80 days around the world, we’ll find a pot of gold just sitting where the rainbow’s ending.', '0', 'public', NULL, NULL, '2022-01-08 05:24:24', '2022-02-13 02:46:00', NULL, 'publish', '[\"Hair Cutting\"]'),
(11, '2', NULL, 22, 'admin', 'Car Cleaning Service From Best Cleaner', 'car-cleaning-service-from-best-cleaner', '<div style=\"text-align: justify;\"><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Barnaby The Bear’s my name, never call me Jack or James, I will sing my way to fame, Barnaby the Bear’s my name. Birds taught me to sing, when they took me to their king, first I had to fly, in the sky so high so high, so high so high so high, so — if you want to sing this way, think of what you’d like to say, add a tune and you will see, just how easy it can be. Treacle pudding, fish and chips, fizzy drinks and liquorice, flowers, rivers, sand and sea, snowflakes and the stars are free.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Ulysses, Ulysses — Soaring through all the galaxies. In search of Earth, flying in to the night. Ulysses, Ulysses — Fighting evil and tyranny, with all his power, and with all of his might. Ulysses — no-one else can do the things you do. Ulysses — like a bolt of thunder from the blue. Ulysses — always fighting all the evil forces bringing peace and justice to all.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Hey there where ya goin’, not exactly knowin’, who says you have to call just one place home. He’s goin’ everywhere, B.J. McKay and his best friend Bear. He just keeps on movin’, ladies keep improvin’, every day is better than the last. New dreams and better scenes, and best of all I don’t pay property tax. Rollin’ down to Dallas, who’s providin’ my palace, off to New Orleans or who knows where. Places new and ladies, too, I’m B.J. McKay and this is my best friend Bear.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">80 days around the world, we’ll find a pot of gold just sitting where the rainbow’s ending. Time — we’ll fight against the time, and we’ll fly on the white wings of the wind. 80 days around the world, no we won’t say a word before the ship is really back. Round, round, all around the world. Round, all around the world. Round, all around the world. Round, all around the world.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">I never spend much time in school but I taught ladies plenty. It’s true I hire my body out for pay, hey hey. I’ve gotten burned over Cheryl Tiegs, blown up for Raquel Welch. But when I end up in the hay it’s only hay, hey hey. I might jump an open drawbridge, or Tarzan from a vine. ’Cause I’m the unknown stuntman that makes Eastwood look so fine.&nbsp;</span></font></p></div>', '112', 's-admin@gmail.com', '80 days around the world, we’ll find a pot of gold just sitting where the rainbow’s ending.', '0', 'public', NULL, NULL, '2022-01-08 05:24:28', '2022-02-13 02:45:28', NULL, 'publish', '[\"Car Cleaning\",\"Cleaning\"]'),
(12, '2', NULL, 22, 'admin', 'Get Furniture Cleaning Service At Reasonable Price', 'get-furniture-cleaning-service-at-reasonable-price', '<div style=\"text-align: justify;\"><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Barnaby The Bear’s my name, never call me Jack or James, I will sing my way to fame, Barnaby the Bear’s my name. Birds taught me to sing, when they took me to their king, first I had to fly, in the sky so high so high, so high so high so high, so — if you want to sing this way, think of what you’d like to say, add a tune and you will see, just how easy it can be. Treacle pudding, fish and chips, fizzy drinks and liquorice, flowers, rivers, sand and sea, snowflakes and the stars are free.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Ulysses, Ulysses — Soaring through all the galaxies. In search of Earth, flying in to the night. Ulysses, Ulysses — Fighting evil and tyranny, with all his power, and with all of his might. Ulysses — no-one else can do the things you do. Ulysses — like a bolt of thunder from the blue. Ulysses — always fighting all the evil forces bringing peace and justice to all.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Hey there where ya goin’, not exactly knowin’, who says you have to call just one place home. He’s goin’ everywhere, B.J. McKay and his best friend Bear. He just keeps on movin’, ladies keep improvin’, every day is better than the last. New dreams and better scenes, and best of all I don’t pay property tax. Rollin’ down to Dallas, who’s providin’ my palace, off to New Orleans or who knows where. Places new and ladies, too, I’m B.J. McKay and this is my best friend Bear.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">80 days around the world, we’ll find a pot of gold just sitting where the rainbow’s ending. Time — we’ll fight against the time, and we’ll fly on the white wings of the wind. 80 days around the world, no we won’t say a word before the ship is really back. Round, round, all around the world. Round, all around the world. Round, all around the world. Round, all around the world.</span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p style=\"text-align: left;\"><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">I never spend much time in school but I taught ladies plenty. It’s true I hire my body out for pay, hey hey. I’ve gotten burned over Cheryl Tiegs, blown up for Raquel Welch. But when I end up in the hay it’s only hay, hey hey. I might jump an open drawbridge, or Tarzan from a vine. ’Cause I’m the unknown stuntman that makes Eastwood look so fine.&nbsp;</span></font></p></div>', '113', 's-admin@gmail.com', '80 days around the world, we’ll find a pot of gold just sitting where the rainbow’s ending.', '0', 'public', NULL, NULL, '2022-01-08 05:44:56', '2022-02-13 02:44:10', NULL, 'publish', '[\"Cleaning\"]'),
(13, '1', NULL, 22, 'admin', 'Get Our Electrice Service For Home and Office', 'get-our-electrice-service-for-home-and-office', '<p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Barnaby The Bear’s my name, never call me Jack or James, I will sing my way to fame, Barnaby the Bear’s my name. Birds taught me to sing, when they took me to their king, first I had to fly, in the sky so high so high, so high so high so high, so — if you want to sing this way, think of what you’d like to say, add a tune and you will see, just how easy it can be. Treacle pudding, fish and chips, fizzy drinks and liquorice, flowers, rivers, sand and sea, snowflakes and the stars are free.</span></font></p><p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Ulysses, Ulysses — Soaring through all the galaxies. In search of Earth, flying in to the night. Ulysses, Ulysses — Fighting evil and tyranny, with all his power, and with all of his might. Ulysses — no-one else can do the things you do. Ulysses — like a bolt of thunder from the blue. Ulysses — always fighting all the evil forces bringing peace and justice to all.</span></font></p><p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">Hey there where ya goin’, not exactly knowin’, who says you have to call just one place home. He’s goin’ everywhere, B.J. McKay and his best friend Bear. He just keeps on movin’, ladies keep improvin’, every day is better than the last. New dreams and better scenes, and best of all I don’t pay property tax. Rollin’ down to Dallas, who’s providin’ my palace, off to New Orleans or who knows where. Places new and ladies, too, I’m B.J. McKay and this is my best friend Bear.</span></font></p><p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">80 days around the world, we’ll find a pot of gold just sitting where the rainbow’s ending. Time — we’ll fight against the time, and we’ll fly on the white wings of the wind. 80 days around the world, no we won’t say a word before the ship is really back. Round, round, all around the world. Round, all around the world. Round, all around the world. Round, all around the world.</span></font></p><p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\"><br></span></font></p><p><font color=\"#666666\" face=\"Roboto, sans-serif\"><span style=\"font-size: 16px;\">I never spend much time in school but I taught ladies plenty. It’s true I hire my body out for pay, hey hey. I’ve gotten burned over Cheryl Tiegs, blown up for Raquel Welch. But when I end up in the hay it’s only hay, hey hey. I might jump an open drawbridge, or Tarzan from a vine. ’Cause I’m the unknown stuntman that makes Eastwood look so fine.&nbsp;</span></font></p>', '114', 's-admin@gmail.com', '80 days around the world, we’ll find a pot of gold just sitting where the rainbow’s ending.', '0', 'public', NULL, NULL, '2022-01-08 23:09:53', '2022-02-13 02:45:01', NULL, 'publish', '[\"Switch Repair\",\"Board Repair\"]');

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `url` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `title`, `url`, `image`, `created_at`, `updated_at`) VALUES
(3, 'Test1', 'Test1', '24', '2022-01-07 22:17:46', '2022-01-07 22:18:26'),
(4, 'Test2', 'Test2', '25', '2022-01-07 22:18:09', '2022-01-07 22:18:09'),
(5, 'Test3', 'Test3', '26', '2022-01-07 22:19:08', '2022-01-07 22:19:08'),
(6, 'Test4', 'Test4', '27', '2022-01-07 22:19:37', '2022-01-07 22:19:37'),
(7, 'Test5', '#', '25', '2022-01-07 22:20:38', '2022-01-07 22:55:02');

-- --------------------------------------------------------

--
-- Table structure for table `buyer_jobs`
--

CREATE TABLE `buyer_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `subcategory_id` bigint(20) NOT NULL,
  `child_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `buyer_id` bigint(20) NOT NULL,
  `country_id` bigint(20) NOT NULL DEFAULT 0,
  `city_id` bigint(20) NOT NULL DEFAULT 0,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `is_job_on` tinyint(4) NOT NULL DEFAULT 1,
  `is_job_online` tinyint(4) NOT NULL DEFAULT 0,
  `price` double NOT NULL DEFAULT 0,
  `view` bigint(20) NOT NULL DEFAULT 0,
  `dead_line` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buyer_jobs`
--

INSERT INTO `buyer_jobs` (`id`, `category_id`, `subcategory_id`, `child_category_id`, `buyer_id`, `country_id`, `city_id`, `title`, `slug`, `description`, `image`, `status`, `is_job_on`, `is_job_online`, `price`, `view`, `dead_line`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 5, 1, 14, 'I never spend much time in school but I taught ladies plenty', 'i-never-spend-much-time-in-school-but-i-taught-ladies-plenty', '<p>I never spend much time in school but I taught ladies plenty. It’s true I hire my body out for pay, hey hey. I’ve gotten burned over Cheryl Tiegs, blown up for Raquel Welch. But when I end up in the hay it’s only hay, hey hey. I might jump an open drawbridge, or Tarzan from a vine. ’Cause I’m the unknown stuntman that makes Eastwood look so fine.\r\n</p><p>\r\n</p><p>Top Cat! The most effectual Top Cat! Who’s intellectual close friends get to call him T.C., providing it’s with dignity. Top Cat! The indisputable leader of the gang. He’s the boss, he’s a pip, he’s the championship. He’s the most tip top, Top Cat.\r\n</p><p>\r\n</p><p>Ulysses, Ulysses — Soaring through all the galaxies. In search of Earth, flying in to the night. Ulysses, Ulysses — Fighting evil and tyranny, with all his power, and with all of his might. Ulysses — no-one else can do the things you do. Ulysses — like a bolt of thunder from the blue. Ulysses — always fighting all the evil forces bringing peace and justice to all.\r\n</p><p>\r\n</p><p>This is my boss, Jonathan Hart, a self-made millionaire, he’s quite a guy. This is Mrs H., she’s gorgeous, she’s one lady who knows how to take care of herself. By the way, my name is Max. I take care of both of them, which ain’t easy, ’cause when they met it was MURDER!\r\n</p><p>\r\n</p><p>Children of the sun, see your time has just begun, searching for your ways, through adventures every day. Every day and night, with the condor in flight, with all your friends in tow, you search for the Cities of Gold. Ah-ah-ah-ah-ah… wishing for The Cities of Gold. Ah-ah-ah-ah-ah… some day we will find The Cities of Gold. Do-do-do-do ah-ah-ah, do-do-do-do, Cities of Gold. Do-do-do-do, Cities of Gold. Ah-ah-ah-ah-ah… some day we will find The Cities of Gold.</p>', '437', 0, 1, 0, 234, 323, '2023-07-30 18:00:00', '2022-10-11 04:24:13', '2023-11-20 12:51:22'),
(5, 1, 3, NULL, 5, 0, 0, 'This is my boss, Jonathan Hart, a self-made millionaire', 'this-is-my-boss,-jonathan-hart,-a-self-made-millionaire', '<p>I never spend much time in school but I taught ladies plenty. It’s true I hire my body out for pay, hey hey. I’ve gotten burned over Cheryl Tiegs, blown up for Raquel Welch. But when I end up in the hay it’s only hay, hey hey. I might jump an open drawbridge, or Tarzan from a vine. ’Cause I’m the unknown stuntman that makes Eastwood look so fine.\r\n</p><p>\r\n</p><p>Top Cat! The most effectual Top Cat! Who’s intellectual close friends get to call him T.C., providing it’s with dignity. Top Cat! The indisputable leader of the gang. He’s the boss, he’s a pip, he’s the championship. He’s the most tip top, Top Cat.\r\n</p><p>\r\n</p><p>Ulysses, Ulysses — Soaring through all the galaxies. In search of Earth, flying in to the night. Ulysses, Ulysses — Fighting evil and tyranny, with all his power, and with all of his might. Ulysses — no-one else can do the things you do. Ulysses — like a bolt of thunder from the blue. Ulysses — always fighting all the evil forces bringing peace and justice to all.\r\n</p><p>\r\n</p><p>This is my boss, Jonathan Hart, a self-made millionaire, he’s quite a guy. This is Mrs H., she’s gorgeous, she’s one lady who knows how to take care of herself. By the way, my name is Max. I take care of both of them, which ain’t easy, ’cause when they met it was MURDER!\r\n</p><p>\r\n</p><p>Children of the sun, see your time has just begun, searching for your ways, through adventures every day. Every day and night, with the condor in flight, with all your friends in tow, you search for the Cities of Gold. Ah-ah-ah-ah-ah… wishing for The Cities of Gold. Ah-ah-ah-ah-ah… some day we will find The Cities of Gold. Do-do-do-do ah-ah-ah, do-do-do-do, Cities of Gold. Do-do-do-do, Cities of Gold. Ah-ah-ah-ah-ah… some day we will find The Cities of Gold.</p>', '166', 1, 0, 1, 123, 127, '2022-10-27 18:00:00', '2022-10-11 06:16:02', '2023-11-19 16:46:53'),
(6, 2, 9, NULL, 3, 1, 1, 'Children of the sun, see your time has just begun, searching for your ways', 'children-of-the-sun-see-your-time-has-just-begun-searching-for-your-ways', '<p>I never spend much time in school but I taught ladies plenty. It’s true I hire my body out for pay, hey hey. I’ve gotten burned over Cheryl Tiegs, blown up for Raquel Welch. But when I end up in the hay it’s only hay, hey hey. I might jump an open drawbridge, or Tarzan from a vine. ’Cause I’m the unknown stuntman that makes Eastwood look so fine.<br><br>Top Cat! The most effectual Top Cat! Who’s intellectual close friends get to call him T.C., providing it’s with dignity. Top Cat! The indisputable leader of the gang. He’s the boss, he’s a pip, he’s the championship. He’s the most tip top, Top Cat.<br><br>Ulysses, Ulysses — Soaring through all the galaxies. In search of Earth, flying in to the night. Ulysses, Ulysses — Fighting evil and tyranny, with all his power, and with all of his might. Ulysses — no-one else can do the things you do. Ulysses — like a bolt of thunder from the blue. Ulysses — always fighting all the evil forces bringing peace and justice to all.<br><br>This is my boss, Jonathan Hart, a self-made millionaire, he’s quite a guy. This is Mrs H., she’s gorgeous, she’s one lady who knows how to take care of herself. By the way, my name is Max. I take care of both of them, which ain’t easy, ’cause when they met it was MURDER!<br><br>Children of the sun, see your time has just begun, searching for your ways, through adventures every day. Every day and night, with the condor in flight, with all your friends in tow, you search for the Cities of Gold. Ah-ah-ah-ah-ah… wishing for The Cities of Gold. Ah-ah-ah-ah-ah… some day we will find The Cities of Gold. Do-do-do-do ah-ah-ah, do-do-do-do, Cities of Gold. Do-do-do-do, Cities of Gold. Ah-ah-ah-ah-ah… some day we will find The Cities of Gold.<br></p>', '321', 1, 1, 0, 74, 224, '2022-10-30 18:00:00', '2022-10-13 02:31:12', '2023-11-20 05:21:48'),
(15, 7, 13, NULL, 5, 5, 8, 'When courage is needed, you’re never around', 'when-courage-is-needed--you-re-never-around', '<p>I never spend much time in school but I taught ladies plenty. It’s true I hire my body out for pay, hey hey. I’ve gotten burned over Cheryl Tiegs, blown up for Raquel Welch. But when I end up in the hay it’s only hay, hey hey. I might jump an open drawbridge, or Tarzan from a vine. ’Cause I’m the unknown stuntman that makes Eastwood look so fine.\r\n</p><p>\r\n</p><p>Top Cat! The most effectual Top Cat! Who’s intellectual close friends get to call him T.C., providing it’s with dignity. Top Cat! The indisputable leader of the gang. He’s the boss, he’s a pip, he’s the championship. He’s the most tip top, Top Cat.\r\n</p><p>\r\n</p><p>Ulysses, Ulysses — Soaring through all the galaxies. In search of Earth, flying in to the night. Ulysses, Ulysses — Fighting evil and tyranny, with all his power, and with all of his might. Ulysses — no-one else can do the things you do. Ulysses — like a bolt of thunder from the blue. Ulysses — always fighting all the evil forces bringing peace and justice to all.\r\n</p><p>\r\n</p><p>This is my boss, Jonathan Hart, a self-made millionaire, he’s quite a guy. This is Mrs H., she’s gorgeous, she’s one lady who knows how to take care of herself. By the way, my name is Max. I take care of both of them, which ain’t easy, ’cause when they met it was MURDER!\r\n</p><p>\r\n</p><p>Children of the sun, see your time has just begun, searching for your ways, through adventures every day. Every day and night, with the condor in flight, with all your friends in tow, you search for the Cities of Gold. Ah-ah-ah-ah-ah… wishing for The Cities of Gold. Ah-ah-ah-ah-ah… some day we will find The Cities of Gold. Do-do-do-do ah-ah-ah, do-do-do-do, Cities of Gold. Do-do-do-do, Cities of Gold. Ah-ah-ah-ah-ah… some day we will find The Cities of Gold.</p>', '435', 0, 1, 0, 195, 617, '2023-09-14 18:00:00', '2022-10-28 07:05:12', '2023-11-21 02:59:41'),
(55, 3, 2, NULL, 5, 0, 0, 'Online Job demo test two 0000', 'online-job-demo-test-two', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 00</p><p><br></p><p>\r\n</p>', '433', 1, 1, 1, 900, 271, '2023-11-10 18:00:00', '2023-04-09 04:19:46', '2023-11-23 08:45:38'),
(56, 5, 1, 1, 5, 0, 0, 'Remote Customer Service - Part Time', 'online-job-post-new-1', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '711', 1, 0, 1, 150, 544, '2023-12-29 18:00:00', '2023-04-14 22:44:20', '2023-11-23 20:23:03'),
(57, 5, 7, NULL, 5, 4, 9, 'Salon Job Post Test', 'salon-job-post-test', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n</p><p><br></p><p>\r\n</p>', '493', 0, 1, 0, 150, 156, '2023-11-29 18:00:00', '2023-04-15 00:25:43', '2023-11-23 12:51:36'),
(64, 4, 18, 6, 5, 1, 1, 'Remote Personal Assistant', 'international-interactions-consultant-1', '<p>Chief Identity PlannerChief Identity PlannerChief Identity PlannerChief Identity PlannerChief Identity PlannerChief Identity PlannerChief Identity PlannerChief Identity PlannerChief Identity PlannerChief Identity PlannerChief Identity PlannerChief Identity PlannerChief Identity Planner fgdf&nbsp; 123 66<br></p>', '712', 1, 1, 0, 200, 691, '2024-05-30 18:00:00', '2023-05-25 01:36:54', '2023-11-22 20:48:36'),
(74, 1, 1, NULL, 1624, 2, 2, 'ok', '', 'Yi', '767', 0, 1, 0, 120, 2, '2023-07-28 18:00:00', '2023-07-29 07:46:10', '2023-11-07 00:53:10'),
(75, 1, 8, NULL, 5, 1, 1, 'light change', '-1', 'change your light - now', '784', 0, 1, 0, 5, 21, '2023-08-07 18:00:00', '2023-08-08 08:51:20', '2023-11-19 16:46:07'),
(76, 1, 8, NULL, 5, 11, 0, 'صيانة الكهرباء', '-2', 'اريد صيانه الكهرباء في المنزل وايجاد الخلل بشكل عاجل', '787', 0, 1, 0, 100, 75, '2023-08-10 18:00:00', '2023-08-08 11:46:54', '2023-11-24 12:57:14'),
(78, 1, 1, NULL, 5, 2, 2, 'gsgs', '-3', 'svvsvsb', '797', 0, 0, 0, 50, 77, '2023-08-30 18:00:00', '2023-08-15 09:02:05', '2023-11-22 14:49:03'),
(79, 1, 3, NULL, 5, 2, 2, 'ac water leak', '-4', 'water leak from ac', '806', 0, 1, 0, 150, 71, '2023-08-22 18:00:00', '2023-08-20 09:33:24', '2023-11-12 20:21:44'),
(80, 2, 9, NULL, 5, 1, 1, 'hsjd', '-5', 'jxjdjd', '814', 0, 1, 0, 100, 5, '2023-08-28 18:00:00', '2023-08-29 01:38:08', '2023-09-25 02:44:45'),
(81, 2, 9, NULL, 5, 1, 1, 'تست سرویس', '-6', 'نینینبن', '815', 0, 1, 0, 1000, 42, '2023-08-28 18:00:00', '2023-08-29 01:58:05', '2023-11-23 12:27:13'),
(82, 2, 11, NULL, 5, 1, 1, 'تستست', '-7', 'تستیت', '819', 0, 1, 0, 100001, 105, '2023-09-10 18:00:00', '2023-09-02 05:47:24', '2023-11-24 19:59:30'),
(83, 4, 18, NULL, 1798, 0, 0, 'abc', '-9', 'jznsjsj', '824', 0, 1, 1, 5000, 5, '2023-09-15 18:00:00', '2023-09-16 05:48:12', '2023-09-26 05:38:28'),
(84, 1, 3, NULL, 1813, 0, 0, 'ff', '-8', 'ff', '830', 0, 1, 1, 850, 5, '2023-09-20 18:00:00', '2023-09-21 03:34:03', '2023-09-24 05:51:03'),
(85, 1, 1, NULL, 5, 0, 0, 'test', '-11', 'Test', '835', 0, 0, 1, 100, 8, '2023-09-24 18:00:00', '2023-09-25 04:33:22', '2023-11-21 02:56:03'),
(86, 1, 3, NULL, 5, 2, 2, 'test5', '-10', 'Tedt', '836', 0, 1, 0, 200, 9, '2023-09-25 18:00:00', '2023-09-25 04:56:29', '2023-10-29 09:31:31'),
(87, 1, 26, NULL, 5, 1, 0, 'JavaScript', '-12', 'JavaScript.com is a resource for the JavaScript community. You will find resources and examples for JavaScript beginners as well as support for JavaScript', '838', 0, 1, 0, 100, 53, '2023-09-29 18:00:00', '2023-09-25 10:49:10', '2023-11-19 15:25:35'),
(88, 3, 2, NULL, 1829, 1, 1, 'ggvvhjj', '-13', 'ggbhj', '839', 0, 1, 0, 100, 10, '2023-09-25 18:00:00', '2023-09-26 05:21:00', '2023-10-16 14:15:04'),
(89, 1, 1, NULL, 5, 6, 7, 'test5', '-14', 'tessst', '841', 0, 0, 0, 50, 14, '2023-09-25 18:00:00', '2023-09-26 05:53:07', '2023-11-15 13:33:23'),
(90, 1, 3, NULL, 5, 1, 1, 'test', '-15', 'Test', '843', 0, 0, 0, 50, 30, '2023-09-27 18:00:00', '2023-09-28 04:26:18', '2023-11-20 04:59:37'),
(91, 2, 11, NULL, 1838, 0, 0, 'test cleaning', '-16', 'whole house cleaning', '844', 0, 1, 1, 900, 107, '2023-10-30 18:00:00', '2023-09-29 17:29:53', '2023-11-23 14:06:43'),
(92, 1, 3, NULL, 5, 2, 16, 'gshz', '-17', 'bshs', '846', 0, 1, 0, 66, 6, '2023-10-04 18:00:00', '2023-10-05 07:19:04', '2023-10-11 19:15:56'),
(93, 5, 7, NULL, 5, 15, 35, '57777', '-18', 'ghhhx', '853', 0, 1, 0, 500, 8, '2023-10-11 18:00:00', '2023-10-11 19:14:59', '2023-11-22 05:21:41'),
(94, 8, 30, NULL, 5, 6, 7, 'Business Logo design', 'business-logo-design', '<p><b>Job Summary:\r\n</b></p><p>We are seeking a talented and creative Business Logo Designer to join our team. The ideal candidate will have a strong passion for graphic design, a keen eye for detail, and the ability to create visually appealing, memorable, and effective logos that reflect our brand\'s identity.</p><p><br></p><p>\r\n</p><p><b>Responsibilities:\r\n</b></p><p>Logo Design:&nbsp;<span style=\"color: var(--light-color); font-family: var(--body-font); text-align: var(--bs-body-text-align); display: inline !important;\">Collaborate with clients or internal stakeholders to understand their branding and design requirements.</span></p><p>Create unique and visually appealing logos that convey the company\'s message, values, and identity.\r\n</p><p>Ensure logos are versatile and effective across various platforms, including digital and print media.</p><p>\r\n</p><p>\r\n</p><p>\r\n</p>', '869', 1, 1, 0, 200, 174, '2024-10-30 18:00:00', '2023-10-22 01:02:46', '2023-11-24 19:13:50'),
(95, 8, 30, NULL, 5, 6, 7, 'Write an appeal letter', 'write-an-appeal-letter', '<p><b>Position Overview:</b></p><p><b><br></b></p><p><b>\r\n</b></p><p>We are seeking an experienced and highly skilled Appeal Letter Writer to join our team. The successful candidate will be responsible for drafting persuasive and well-structured appeal letters for a variety of purposes, including job rejections, academic appeals, insurance claims, and more. The Appeal Letter Writer will play a critical role in helping individuals and organizations present their cases effectively and professionally.</p>', '870', 1, 1, 0, 300, 147, '2024-10-29 18:00:00', '2023-10-22 01:12:06', '2023-11-24 19:13:08'),
(97, 9, 29, NULL, 5, 6, 15, 'Assistant Project Manager', 'assistant-project-manager', '<p><b>Position Overview:</b></p><p>\r\n</p><p>We are seeking a highly organized and detail-oriented Assistant Project Manager to join our team. The Assistant Project Manager will work closely with the Project Manager to assist in planning, executing, and closing projects, ensuring that they are completed on time, within scope, and on budget. This role requires effective communication, problem-solving skills, and a proactive approach to project management.</p>', '872', 1, 0, 0, 200, 162, '2024-12-25 18:00:00', '2023-10-22 01:19:15', '2023-11-24 10:03:23'),
(98, 1, 8, NULL, 5, 6, 7, 'Buyer', '-19', 'yehukzjz', '882', 0, 1, 0, 5, 5, '2023-11-08 18:00:00', '2023-11-09 04:36:37', '2023-11-21 04:48:31'),
(99, 3, 2, NULL, 5, 2, 2, 'имам потреба од водовоџија', '-20', 'дасдасдасдас дса', '884', 0, 1, 0, 100, 21, '2023-11-15 18:00:00', '2023-11-14 17:45:47', '2023-11-21 09:38:27'),
(101, 4, 27, NULL, 5, 2, 2, 'titeeeel', '-21', 'hhhhuhuhhhh', '890', 0, 1, 0, 500, 6, '2023-11-19 18:00:00', '2023-11-20 05:04:45', '2023-11-21 06:46:39'),
(102, 5, 7, NULL, 1927, 0, 0, 'spa', '-22', 'we are open  24 Hours', '899', 0, 1, 1, 500, 2, '2023-11-22 18:00:00', '2023-11-23 14:02:07', '2023-11-23 18:24:42');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` longtext DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `icon` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `mobile_icon` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `slug`, `icon`, `image`, `status`, `mobile_icon`, `created_at`, `updated_at`) VALUES
(1, 'كهرباء', NULL, 'electronics', 'las la-charging-station', '661', 1, '214', '2021-11-29 00:31:11', '2025-11-14 22:12:52'),
(2, 'سباكة', NULL, 'cleaning', 'las la-toilet', '113', 1, '215', '2021-11-29 00:34:42', '2025-11-14 22:12:52'),
(3, 'تكييف', '<p>This is test category with description for cat update cat</p>', 'home-move', 'las la-people-carry', '106', 1, '213', '2021-11-29 00:35:13', '2025-11-14 22:12:52'),
(4, 'دهان', NULL, 'painting', 'las la-paint-roller', '109', 1, '216', '2021-11-29 00:35:49', '2025-11-14 22:12:52'),
(5, 'أجهزة منزلية', NULL, 'salon-&-spa', 'las la-hand-scissors', '111', 1, '212', '2021-11-29 00:36:07', '2025-11-14 22:12:52'),
(6, 'نجارة', NULL, 'helping', 'lab la-accessible-icon', '97', 1, '217', '2021-11-29 00:36:25', '2025-11-14 22:12:52'),
(7, 'Digital Marketing', NULL, 'digital-marketing', 'las la-closed-captioning', '177', 1, '218', '2022-04-24 00:05:59', '2022-07-22 22:00:25'),
(8, 'Computers & IT', '<p>Whether you need a personal computer for home use or assistance with an IT issue at your place of business, you can find trustworthy computer services in your area with the knowledge and skills you need.</p><p><br></p>', 'computers---it-', 'las la-laptop', NULL, 1, NULL, '2023-10-22 00:29:28', '2023-10-22 00:29:28'),
(9, 'Business', '<p>You can locate the ideal company consultant close to you whether you require assistance with strategy and management or assistance with business services (large or small).</p><p><br></p>', 'business', 'las la-check-double', '863', 1, NULL, '2023-10-22 00:39:12', '2023-10-22 00:39:12'),
(10, 'كهرباء', NULL, 'khrbaaa', 'las la-tools', NULL, 1, NULL, '2025-11-14 19:23:09', '2025-11-14 19:23:09'),
(11, 'سباكة', NULL, 'sbak', 'las la-tools', NULL, 1, NULL, '2025-11-14 19:23:09', '2025-11-14 19:23:09'),
(12, 'تكييف', NULL, 'tkyyf', 'las la-tools', NULL, 1, NULL, '2025-11-14 19:23:09', '2025-11-14 19:23:09'),
(13, 'أجهزة منزلية', NULL, 'aghz-mnzly', 'las la-tools', NULL, 1, NULL, '2025-11-14 19:23:09', '2025-11-14 19:23:09'),
(14, 'نجارة', NULL, 'ngar', 'las la-tools', NULL, 1, NULL, '2025-11-14 19:23:09', '2025-11-14 19:23:09'),
(15, 'دهان', NULL, 'dhan', 'las la-tools', NULL, 1, NULL, '2025-11-14 19:23:10', '2025-11-14 19:23:10'),
(16, 'صيانة تكييف', NULL, NULL, 'ti-settings', NULL, 1, NULL, '2025-11-15 08:05:03', '2025-11-15 08:05:03'),
(17, 'صيانة كهرباء', NULL, NULL, 'ti-bolt', NULL, 1, NULL, '2025-11-15 08:05:03', '2025-11-15 08:05:03'),
(18, 'صيانة سباكة', NULL, NULL, 'ti-drop', NULL, 1, NULL, '2025-11-15 08:05:03', '2025-11-15 08:05:03'),
(19, 'صيانة أجهزة منزلية', NULL, NULL, 'ti-home', NULL, 1, NULL, '2025-11-15 08:05:03', '2025-11-15 08:05:03'),
(20, 'صيانة أجهزة إلكترونية', NULL, NULL, 'ti-desktop', NULL, 1, NULL, '2025-11-15 08:05:03', '2025-11-15 08:05:03');

-- --------------------------------------------------------

--
-- Table structure for table `category_zones`
--

CREATE TABLE `category_zones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `zone_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_zones`
--

INSERT INTO `category_zones` (`id`, `category_id`, `zone_id`, `created_at`, `updated_at`) VALUES
(4, 16, 11, NULL, NULL),
(5, 16, 12, NULL, NULL),
(6, 16, 13, NULL, NULL),
(7, 16, 14, NULL, NULL),
(9, 15, 17, NULL, NULL),
(10, 15, 18, NULL, NULL),
(11, 8, 12, NULL, NULL),
(12, 8, 13, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `child_categories`
--

CREATE TABLE `child_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `sub_category_id` bigint(20) NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` longtext DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `child_categories`
--

INSERT INTO `child_categories` (`id`, `category_id`, `sub_category_id`, `name`, `description`, `slug`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Test Mobile', '<p>Our systems have detected unusual traffic from your computer network. This page checks to see if it\'s really you sending theOur systems have detected unusual traffic from your computer network. This page checks to see if it\'s really you sending the new test 44</p>', 'test-mobile', '765', 1, '2023-01-03 04:02:39', '2023-07-29 02:26:32'),
(5, 2, 2, 'House cleaning mop', NULL, 'test-spa', '764', 1, '2023-01-03 04:02:39', '2023-07-29 02:26:35'),
(6, 4, 18, '3D with color', NULL, '3d-with-color', '755', 1, '2023-05-17 02:08:20', '2023-07-29 02:26:37'),
(7, 4, 18, '3D without color', NULL, '3d-without-color', NULL, 1, '2023-05-17 02:08:57', '2023-05-17 02:08:57'),
(8, 4, 19, 'UK 3D Print', NULL, 'uk-3d-print', NULL, 1, '2023-05-17 02:09:12', '2023-05-17 02:09:12'),
(9, 4, 19, 'US 3D Print', NULL, 'us-3d-print-', NULL, 1, '2023-05-17 02:09:26', '2023-05-17 02:09:26');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country` varchar(191) DEFAULT NULL,
  `flag` varchar(191) DEFAULT NULL,
  `flag_url` varchar(191) DEFAULT NULL,
  `country_code` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `zone_status` tinyint(4) NOT NULL DEFAULT 1,
  `latitude` varchar(191) DEFAULT NULL,
  `longitude` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country`, `flag`, `flag_url`, `country_code`, `status`, `zone_status`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(69, 'السعودية', NULL, NULL, 'SA', 1, 1, NULL, NULL, '2025-11-15 08:05:03', '2025-11-15 08:05:03');

-- --------------------------------------------------------

--
-- Table structure for table `custom_font_imports`
--

CREATE TABLE `custom_font_imports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file` varchar(191) NOT NULL,
  `path` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_font_imports`
--

INSERT INTO `custom_font_imports` (`id`, `file`, `path`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Nitro-OpliqueL-fixed', 'assets/common/fonts/custom-fonts/css/Nitro-OpliqueL-fixed.woff', 0, NULL, '2025-11-17 20:16:19'),
(2, 'Nitro-OpliqueL-fixed', 'assets/common/fonts/custom-fonts/css/Nitro-OpliqueL-fixed.woff', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `day` varchar(191) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `seller_id` int(11) NOT NULL,
  `total_day` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `day`, `status`, `seller_id`, `total_day`, `created_at`, `updated_at`) VALUES
(14, 'Fri', 0, 2, 12, '2022-01-17 08:27:17', '2022-01-17 08:27:17'),
(15, 'Wed', 0, 1, 5, '2022-02-07 00:24:34', '2023-05-04 04:21:39'),
(19, 'Sat', 0, 2, NULL, '2022-02-07 00:58:21', '2022-02-07 00:58:21'),
(20, 'Sun', 0, 2, NULL, '2022-02-07 00:58:32', '2022-02-07 00:58:32'),
(21, 'Mon', 0, 2, NULL, '2022-02-07 00:58:40', '2022-02-07 00:58:40'),
(22, 'Tue', 0, 2, NULL, '2022-02-07 00:58:49', '2022-02-07 00:58:49'),
(23, 'Wed', 0, 2, NULL, '2022-02-07 00:58:59', '2022-02-07 00:58:59'),
(27, 'Sat', 0, 4, 14, '2022-02-07 02:32:46', '2022-02-14 00:32:17'),
(28, 'Mon', 0, 4, 14, '2022-02-09 00:44:06', '2022-02-14 00:32:17'),
(29, 'Fri', 0, 4, 14, '2022-02-09 00:44:16', '2022-02-14 00:32:17'),
(30, 'Sun', 0, 4, 14, '2022-02-09 00:44:36', '2022-02-14 00:32:17'),
(31, 'Tue', 0, 4, 14, '2022-02-09 00:44:48', '2022-02-14 00:32:17'),
(32, 'Wed', 0, 4, 14, '2022-02-09 00:45:03', '2022-02-14 00:32:17'),
(33, 'Thu', 0, 4, 7, '2023-01-05 09:39:30', '2023-01-05 09:39:30'),
(35, 'Sat', 0, 1617, 7, '2023-07-26 04:13:01', '2023-07-26 04:13:01'),
(36, 'Sun', 0, 1617, 7, '2023-07-26 04:13:03', '2023-07-26 04:13:03'),
(37, 'Mon', 0, 1617, 7, '2023-07-26 04:13:03', '2023-07-26 04:13:03'),
(38, 'Tue', 0, 1617, 7, '2023-07-26 04:13:03', '2023-07-26 04:13:03'),
(39, 'Wed', 0, 1617, 7, '2023-07-26 04:13:03', '2023-07-26 04:13:03'),
(40, 'Thu', 0, 1617, 7, '2023-07-26 04:13:03', '2023-07-26 04:13:03'),
(41, 'Fri', 0, 1617, 7, '2023-07-26 04:13:03', '2023-07-26 04:13:03'),
(48, 'Sat', 0, 1677, 7, '2023-08-09 19:27:37', '2023-08-09 19:27:37'),
(49, 'Sun', 0, 1677, 7, '2023-08-09 19:27:39', '2023-08-09 19:27:39'),
(50, 'Mon', 0, 1677, 7, '2023-08-09 19:27:39', '2023-08-09 19:27:39'),
(51, 'Tue', 0, 1677, 7, '2023-08-09 19:27:39', '2023-08-09 19:27:39'),
(52, 'Wed', 0, 1677, 7, '2023-08-09 19:27:39', '2023-08-09 19:27:39'),
(53, 'Thu', 0, 1677, 7, '2023-08-09 19:27:39', '2023-08-09 19:27:39'),
(54, 'Fri', 0, 1677, 7, '2023-08-09 19:27:39', '2023-08-09 19:27:39'),
(57, 'Thu', 0, 2, 7, '2023-08-20 05:02:48', '2023-08-20 05:02:48'),
(60, 'Thu', 0, 1, 7, '2023-08-25 03:17:28', '2023-08-25 03:17:28'),
(61, 'Fri', 0, 1, 7, '2023-08-25 03:17:28', '2023-08-25 03:17:28'),
(62, 'Mon', 0, 1789, 7, '2023-09-13 15:30:55', '2023-09-13 15:30:55'),
(63, 'Sat', 0, 1789, 7, '2023-09-13 15:30:59', '2023-09-13 15:30:59'),
(64, 'Sun', 0, 1789, 7, '2023-09-13 15:30:59', '2023-09-13 15:30:59'),
(65, 'Tue', 0, 1789, 7, '2023-09-13 15:30:59', '2023-09-13 15:30:59'),
(66, 'Wed', 0, 1789, 7, '2023-09-13 15:30:59', '2023-09-13 15:30:59'),
(67, 'Thu', 0, 1789, 7, '2023-09-13 15:30:59', '2023-09-13 15:30:59'),
(68, 'Fri', 0, 1789, 7, '2023-09-13 15:30:59', '2023-09-13 15:30:59'),
(69, 'Sun', 0, 1800, 7, '2023-09-16 07:32:04', '2023-09-16 07:32:04'),
(70, 'Sat', 0, 1800, 7, '2023-09-16 07:32:10', '2023-09-16 07:32:10'),
(71, 'Mon', 0, 1800, 7, '2023-09-16 07:32:10', '2023-09-16 07:32:10'),
(72, 'Tue', 0, 1800, 7, '2023-09-16 07:32:10', '2023-09-16 07:32:10'),
(73, 'Wed', 0, 1800, 7, '2023-09-16 07:32:10', '2023-09-16 07:32:10'),
(74, 'Thu', 0, 1800, 7, '2023-09-16 07:32:10', '2023-09-16 07:32:10'),
(75, 'Fri', 0, 1800, 7, '2023-09-16 07:32:10', '2023-09-16 07:32:10'),
(76, 'Sat', 0, 1, 7, '2023-09-21 22:20:48', '2023-09-21 22:20:48'),
(77, 'Sun', 0, 1831, 7, '2023-09-27 02:01:07', '2023-09-27 02:01:07'),
(78, 'Sat', 0, 1831, 7, '2023-09-27 02:01:08', '2023-09-27 02:01:08'),
(79, 'Mon', 0, 1831, 7, '2023-09-27 02:01:08', '2023-09-27 02:01:08'),
(80, 'Tue', 0, 1831, 7, '2023-09-27 02:01:08', '2023-09-27 02:01:08'),
(81, 'Wed', 0, 1831, 7, '2023-09-27 02:01:08', '2023-09-27 02:01:08'),
(82, 'Thu', 0, 1831, 7, '2023-09-27 02:01:08', '2023-09-27 02:01:08'),
(83, 'Fri', 0, 1831, 7, '2023-09-27 02:01:08', '2023-09-27 02:01:08'),
(84, 'Tue', 0, 1, 7, '2023-10-11 13:58:07', '2023-10-11 13:58:07'),
(85, 'Sun', 0, 1, 7, '2023-11-01 11:02:38', '2023-11-01 11:02:38'),
(86, 'Mon', 0, 1, 7, '2023-11-16 01:54:57', '2023-11-16 01:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `edit_service_histories`
--

CREATE TABLE `edit_service_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) NOT NULL,
  `seller_id` bigint(20) NOT NULL,
  `service_title` varchar(191) NOT NULL,
  `service_description` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extra_services`
--

CREATE TABLE `extra_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `quantity` bigint(20) UNSIGNED NOT NULL,
  `price` double NOT NULL,
  `payment_gateway` varchar(191) DEFAULT NULL,
  `manual_payment_gateway_image` varchar(191) DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `commission_amount` double DEFAULT NULL,
  `sub_total` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `transaction_id` varchar(191) DEFAULT NULL,
  `payment_status` varchar(191) DEFAULT NULL,
  `status` bigint(20) UNSIGNED DEFAULT NULL COMMENT '0=pending,1=accept,2=decline',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extra_services`
--

INSERT INTO `extra_services` (`id`, `order_id`, `title`, `quantity`, `price`, `payment_gateway`, `manual_payment_gateway_image`, `tax`, `commission_amount`, `sub_total`, `total`, `transaction_id`, `payment_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 2186, 'sdfsdf', 2, 10, 'Manual Payment', 'manual_attachment_1665576501.png', 1.4, 0, 20, 21.4, NULL, 'complete', 2, '2022-10-12 03:49:42', '2022-10-12 07:23:50'),
(2, 2186, 'qweqweq', 2, 34, NULL, NULL, 4.76, 0, 68, 72.76, '20221012111212800110168962604132088', 'complete', 0, '2022-10-12 03:52:52', '2022-10-12 04:08:53'),
(5, 2269, 'TestT', 1, 10, NULL, NULL, 0.7, 0, 10, 10.7, NULL, 'pending', 0, '2022-11-06 23:30:25', '2022-11-06 23:30:25'),
(7, 2, 'Alada Service', 3, 10, 'Manual Payment', 'manual_attachment_1667807742.png', 2.1, 0, 30, 32.1, NULL, 'complete', 1, '2022-11-07 01:52:14', '2022-11-07 02:10:07'),
(9, 2, 'sfsdf', 4, 100, 'Manual Payment', 'manual_attachment_1669195938.jpg', 28, 0, 400, 428, NULL, 'pending', 1, '2022-11-07 02:21:00', '2022-11-23 03:32:18'),
(13, 2, 'v', 1, 2, NULL, NULL, 0.14, 0, 2, 2.14, NULL, 'pending', 1, '2022-11-23 04:21:28', '2022-11-23 06:50:10'),
(14, 2, 'm', 7, 8, 'Manual Payment', 'manual_attachment_1669208281.jpg', 3.92, 0, 56, 59.92, NULL, 'pending', 1, '2022-11-23 06:57:22', '2022-11-23 06:58:01'),
(15, 2529, 'test title', 1, 10, NULL, NULL, 0.7, 0, 10, 10.7, NULL, 'pending', 1, '2022-12-27 00:35:14', '2022-12-27 03:07:53'),
(16, 2529, 'nnnn', 1, 5, NULL, NULL, 0.35, 0, 5, 5.35, NULL, 'pending', 1, '2022-12-27 03:09:31', '2022-12-27 03:10:14'),
(17, 2529, 'bbb', 1, 3, NULL, NULL, 0.21, 0, 3, 3.21, NULL, 'pending', 1, '2022-12-27 03:16:31', '2022-12-27 03:16:57'),
(18, 2529, 'qqq', 1, 3, NULL, NULL, 0.21, 0, 3, 3.21, NULL, 'pending', 1, '2022-12-27 04:28:12', '2022-12-27 04:29:30'),
(19, 2529, 'bbbgggg', 1, 3, NULL, NULL, 0.21, 0, 3, 3.21, NULL, 'pending', 1, '2022-12-27 06:37:40', '2022-12-27 06:47:27'),
(21, 2, 'jnn', 7, 88, NULL, NULL, 43.12, 0, 616, 659.12, NULL, 'pending', 1, '2022-12-31 16:41:00', '2023-01-02 15:45:24'),
(22, 3, 'Fox', 3, 45, NULL, NULL, 9.45, 13.5, 135, 144.45, NULL, 'pending', 1, '2023-01-06 20:20:04', '2023-01-08 06:18:42'),
(23, 2, 'Abasa', 23, 2, NULL, NULL, 3.22, 4.6, 46, 49.22, NULL, 'decline', 2, '2023-01-06 20:20:31', '2023-01-08 02:26:06'),
(24, 2748, 'jj', 8, 77, NULL, NULL, 43.12, 61.6, 616, 659.12, NULL, 'pending', 0, '2023-01-21 12:30:20', '2023-01-21 12:30:20'),
(28, 50, 'fsdf', 33, 100, NULL, NULL, 231, 0, 3300, 3531, NULL, 'pending', 0, '2023-05-22 08:48:34', '2023-05-22 08:48:34'),
(29, 63, 'Investor Creative Producer', 414, 382, NULL, NULL, 11070.36, 0, 158148, 169218.36, NULL, 'pending', 0, '2023-05-28 02:36:39', '2023-05-28 02:36:39'),
(30, 153, '111', 1, 1, NULL, NULL, 0.07, 0.1, 1, 1.07, NULL, 'pending', 0, '2023-07-31 02:12:56', '2023-07-31 02:12:56'),
(31, 213, 'hh', 1, 66, NULL, NULL, 4.62, 6.6, 66, 70.62, NULL, 'pending', 0, '2023-08-07 05:23:40', '2023-08-07 05:23:40'),
(32, 239, 'hi', 1, 40, NULL, NULL, 2.8, 4, 40, 42.8, NULL, 'pending', 1, '2023-08-09 12:11:20', '2023-08-15 08:59:03'),
(33, 284, 'lghbv', 1, 10, NULL, NULL, 0.7, 1, 10, 10.7, NULL, 'pending', 0, '2023-08-13 03:44:46', '2023-08-13 03:44:46'),
(34, 343, 'dbnnm', 1, 457788, NULL, NULL, 32045.16, 45778.8, 457788, 489833.16, NULL, 'pending', 0, '2023-08-29 01:05:07', '2023-08-29 01:05:07'),
(35, 416, 'extra', 1, 56, NULL, NULL, 3.92, 5.6, 56, 59.92, NULL, 'pending', 0, '2023-09-11 09:31:55', '2023-09-11 09:31:55'),
(36, 419, 'extra', 1, 50, NULL, NULL, 3.5, 5, 50, 53.5, NULL, 'pending', 1, '2023-09-12 03:51:19', '2023-09-12 03:51:44'),
(37, 420, 'extra', 1, 50, NULL, NULL, 3.5, 5, 50, 53.5, NULL, 'decline', 2, '2023-09-12 04:16:50', '2023-09-12 04:18:00'),
(38, 547, 'tes', 6, 100, NULL, NULL, 42, 60, 600, 642, NULL, 'pending', 0, '2023-11-01 11:12:19', '2023-11-01 11:12:19'),
(39, 656, 'Extra Fee', 1, 100, NULL, NULL, 7, 10, 100, 107, NULL, 'pending', 1, '2023-11-15 13:37:42', '2023-11-15 13:39:07');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_builders`
--

CREATE TABLE `form_builders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `button_text` varchar(191) DEFAULT NULL,
  `fields` longtext DEFAULT NULL,
  `success_message` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form_builders`
--

INSERT INTO `form_builders` (`id`, `title`, `email`, `button_text`, `fields`, `success_message`, `created_at`, `updated_at`) VALUES
(1, 'Contact Form', 'dvrobin4@gmail.com', 'Send Message', '{\"success_message\":\"Thanx for your message\",\"field_type\":[\"text\",\"email\",\"tel\",\"text\",\"textarea\"],\"field_name\":[\"name\",\"email\",\"phone\",\"address\",\"message\"],\"field_placeholder\":[\"Your Name\",\"Your Email\",\"Your Phone\",\"Your Address\",\"Message\"],\"field_required\":[\"on\",\"on\",\"on\",\"on\",\"on\"]}', 'Thanx for your message', '2021-10-07 01:27:02', '2023-01-25 18:56:14'),
(3, 'fgf', 'tyqixi@mailinator.com', 'fgvfgfg', '{\"success_message\":\"fgf\",\"field_type\":[\"text\",\"file\",\"textarea\"],\"field_name\":[\"your-name\",\"\",\"hghgh\"],\"field_placeholder\":[\"Your Name\",null,\"ghgh\"],\"mimes_type\":{\"1\":\"mimes:jpg,jpeg,png\"}}', 'fgf', '2023-01-25 18:56:36', '2023-01-25 18:57:02');

-- --------------------------------------------------------

--
-- Table structure for table `job_requests`
--

CREATE TABLE `job_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) NOT NULL,
  `buyer_id` bigint(20) NOT NULL,
  `job_post_id` bigint(20) NOT NULL,
  `is_hired` tinyint(4) NOT NULL DEFAULT 0,
  `expected_salary` double DEFAULT NULL,
  `cover_letter` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_request_conversations`
--

CREATE TABLE `job_request_conversations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` longtext DEFAULT NULL,
  `notify` varchar(191) DEFAULT NULL,
  `attachment` varchar(191) DEFAULT NULL,
  `type` varchar(191) DEFAULT NULL,
  `job_request_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `default` int(10) UNSIGNED DEFAULT NULL,
  `direction` varchar(191) DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `slug`, `default`, `direction`, `status`, `created_at`, `updated_at`) VALUES
(1, 'English (UK)', 'en_GB', 0, 'ltr', 'publish', '2020-01-03 18:58:44', '2025-11-14 13:26:35'),
(3, 'العربية', 'ar', 1, 'rtl', 'publish', '2025-11-14 13:26:22', '2025-11-14 13:26:35');

-- --------------------------------------------------------

--
-- Table structure for table `live_chat_messages`
--

CREATE TABLE `live_chat_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_user` bigint(20) NOT NULL,
  `to_user` bigint(20) NOT NULL,
  `seller_id` bigint(20) DEFAULT NULL,
  `buyer_id` bigint(20) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media_uploads`
--

CREATE TABLE `media_uploads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `path` text NOT NULL,
  `alt` text DEFAULT NULL,
  `size` text DEFAULT NULL,
  `dimensions` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'admin',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_uploads`
--

INSERT INTO `media_uploads` (`id`, `title`, `path`, `alt`, `size`, `dimensions`, `created_at`, `updated_at`, `type`, `user_id`) VALUES
(1, 'favicons.png', 'favicons1637750368.png', NULL, '2.28 KB', '40 x 40 pixels', '2021-11-24 04:39:28', '2021-11-24 04:39:28', 'admin', 22),
(2, 'logo-01.png', 'logo-011637754681.png', NULL, '4.19 KB', '214 x 51 pixels', '2021-11-24 05:51:21', '2021-11-24 05:51:21', 'admin', 22),
(3, 'logo-02.png', 'logo-021637754687.png', NULL, '4.49 KB', '214 x 51 pixels', '2021-11-24 05:51:27', '2021-11-24 05:51:27', 'admin', 22),
(4, 'banner-bg.jpg', 'banner-bg1638104986.jpg', NULL, '743.1 KB', '1920 x 931 pixels', '2021-11-28 07:09:46', '2021-11-28 07:09:46', 'admin', 22),
(5, 'banner1.png', 'banner11638279446.png', NULL, '686.35 KB', '641 x 918 pixels', '2021-11-30 07:37:26', '2021-11-30 07:37:26', 'web', 12),
(6, 'banner2.jpg', 'banner21638339592.jpg', NULL, '253.08 KB', '743 x 743 pixels', '2021-12-01 00:19:53', '2021-12-01 00:19:53', 'web', 12),
(7, 'banner-bg.jpg', 'banner-bg1638446467.jpg', NULL, '743.1 KB', '1920 x 931 pixels', '2021-12-02 06:01:08', '2021-12-02 06:01:08', 'web', 12),
(8, 'author7.jpg', 'author71638610733.jpg', NULL, '45.01 KB', '300 x 220 pixels', '2021-12-04 03:38:53', '2021-12-04 03:38:53', 'web', 12),
(9, 'serviece1.jpg', 'serviece11638621079.jpg', NULL, '30.93 KB', '280 x 200 pixels', '2021-12-04 06:31:19', '2021-12-04 06:31:19', 'web', 12),
(10, 'author7.jpg', 'author71638869659.jpg', NULL, '45.01 KB', '300 x 220 pixels', '2021-12-07 03:34:19', '2021-12-07 03:34:19', 'web', 1),
(11, 'extra1.jpg', 'extra11638872378.jpg', NULL, '6.46 KB', '78 x 78 pixels', '2021-12-07 04:19:38', '2021-12-07 04:19:38', 'web', 1),
(12, 'author2.jpg', 'author21638874607.jpg', NULL, '39.99 KB', '350 x 240 pixels', '2021-12-07 04:56:47', '2021-12-07 04:56:47', 'web', 1),
(13, 's2.jpg', 's21638874652.jpg', NULL, '39.99 KB', '350 x 240 pixels', '2021-12-07 04:57:32', '2021-12-07 04:57:32', 'web', 1),
(14, 's3.jpg', 's31638879054.jpg', NULL, '46.44 KB', '350 x 240 pixels', '2021-12-07 06:10:54', '2021-12-07 06:10:54', 'web', 1),
(15, 's5.jpg', 's51638879454.jpg', NULL, '48.7 KB', '342 x 220 pixels', '2021-12-07 06:17:34', '2021-12-07 06:17:34', 'web', 1),
(16, 's6.jpg', 's61638879755.jpg', NULL, '36.3 KB', '342 x 220 pixels', '2021-12-07 06:22:35', '2021-12-07 06:22:35', 'web', 1),
(17, 's9.jpg', 's91638880201.jpg', NULL, '36.71 KB', '300 x 220 pixels', '2021-12-07 06:30:02', '2021-12-07 06:30:02', 'web', 1),
(18, 's12.jpg', 's121638880499.jpg', NULL, '48.05 KB', '300 x 220 pixels', '2021-12-07 06:34:59', '2021-12-07 06:34:59', 'web', 1),
(19, 'author9.jpg', 'author91638938458.jpg', NULL, '36.71 KB', '300 x 220 pixels', '2021-12-07 22:40:58', '2021-12-07 22:40:58', 'web', 1),
(20, 'image.png', 'image1638946497.png', NULL, '635.92 KB', '512 x 512 pixels', '2021-12-08 00:54:57', '2021-12-08 00:54:57', 'web', 2),
(21, 's12.jpg', 's121638946666.jpg', NULL, '48.05 KB', '300 x 220 pixels', '2021-12-08 00:57:46', '2021-12-08 00:57:46', 'web', 2),
(22, 'author11.jpg', 'author111639044291.jpg', NULL, '39.95 KB', '300 x 220 pixels', '2021-12-09 04:04:51', '2021-12-09 04:04:51', 'web', 2),
(23, 'author9.jpg', 'author91639999147.jpg', NULL, '36.71 KB', '300 x 220 pixels', '2021-12-20 05:19:07', '2021-12-20 05:19:07', 'web', 3),
(24, 'cl1.png', 'cl11641478287.png', NULL, '3.75 KB', '192 x 68 pixels', '2022-01-06 08:11:27', '2022-01-06 08:11:27', 'admin', 22),
(25, 'cl2.png', 'cl21641480573.png', NULL, '4.71 KB', '182 x 76 pixels', '2022-01-06 08:49:33', '2022-01-06 08:49:33', 'admin', 22),
(26, 'cl3.png', 'cl31641615538.png', NULL, '4.45 KB', '172 x 62 pixels', '2022-01-07 22:18:59', '2022-01-07 22:18:59', 'admin', 22),
(27, 'cl4.png', 'cl41641615570.png', NULL, '3.37 KB', '105 x 76 pixels', '2022-01-07 22:19:30', '2022-01-07 22:19:30', 'admin', 22),
(28, 'bd1.jpg', 'bd11641631771.jpg', NULL, '415.87 KB', '1110 x 650 pixels', '2022-01-08 02:49:32', '2022-01-08 02:49:32', 'admin', 22),
(29, 'b2.jpg', 'b21641633715.jpg', NULL, '45.03 KB', '382 x 254 pixels', '2022-01-08 03:21:55', '2022-05-05 19:45:19', 'admin', 22),
(30, 'b5.jpg', 'b51641641302.jpg', NULL, '38.87 KB', '382 x 254 pixels', '2022-01-08 05:28:22', '2022-01-08 05:28:22', 'admin', 22),
(31, 'b1.jpg', 'b11641641414.jpg', NULL, '47.13 KB', '350 x 240 pixels', '2022-01-08 05:30:14', '2022-01-08 05:30:14', 'admin', 22),
(32, 'b9.jpg', 'b91641641557.jpg', NULL, '51.68 KB', '382 x 254 pixels', '2022-01-08 05:32:38', '2022-01-08 05:32:38', 'admin', 22),
(33, 'b3.jpg', 'b31641641631.jpg', NULL, '49.45 KB', '382 x 254 pixels', '2022-01-08 05:33:51', '2022-01-08 05:33:51', 'admin', 22),
(34, 'b6.jpg', 'b61641641712.jpg', NULL, '67.29 KB', '350 x 240 pixels', '2022-01-08 05:35:12', '2022-01-08 05:35:12', 'admin', 22),
(35, 'b7.jpg', 'b71641641793.jpg', NULL, '42.47 KB', '350 x 240 pixels', '2022-01-08 05:36:33', '2022-01-08 05:36:33', 'admin', 22),
(36, 'b8.jpg', 'b81641641872.jpg', NULL, '47.73 KB', '350 x 240 pixels', '2022-01-08 05:37:52', '2022-01-08 05:37:52', 'admin', 22),
(37, 'bd2.jpg', 'bd21641642117.jpg', NULL, '126.62 KB', '540 x 341 pixels', '2022-01-08 05:41:57', '2022-01-08 05:41:57', 'admin', 22),
(38, 'b3.jpg', 'b31641642209.jpg', NULL, '49.45 KB', '382 x 254 pixels', '2022-01-08 05:43:29', '2022-01-08 05:43:29', 'admin', 22),
(39, 'b9.jpg', 'b91641642356.jpg', NULL, '51.68 KB', '382 x 254 pixels', '2022-01-08 05:45:56', '2022-01-08 05:45:56', 'admin', 22),
(40, 'seller2.jpg', 'seller21641902661.jpg', NULL, '128.8 KB', '500 x 443 pixels', '2022-01-11 06:04:22', '2022-01-11 06:04:22', 'admin', 22),
(41, 'banner-smile.png', 'banner-smile1641971297.png', NULL, '1.81 KB', '46 x 46 pixels', '2022-01-12 01:08:17', '2022-01-12 01:08:17', 'admin', 22),
(42, 'dot-square.png', 'dot-square1641971791.png', NULL, '4.9 KB', '163 x 163 pixels', '2022-01-12 01:16:31', '2022-01-12 01:16:31', 'admin', 22),
(43, 'c1.png', 'c11641975772.png', NULL, '4.09 KB', '80 x 80 pixels', '2022-01-12 02:22:52', '2022-01-12 02:22:52', 'admin', 22),
(44, 'c3.png', 'c31641976661.png', NULL, '4.35 KB', '80 x 80 pixels', '2022-01-12 02:37:41', '2022-01-12 02:37:41', 'admin', 22),
(45, 'c2.png', 'c21641976661.png', NULL, '5.71 KB', '80 x 80 pixels', '2022-01-12 02:37:41', '2022-01-12 02:37:41', 'admin', 22),
(46, 'c4.png', 'c41641976661.png', NULL, '4.58 KB', '80 x 80 pixels', '2022-01-12 02:37:41', '2022-01-12 02:37:41', 'admin', 22),
(47, 'c5.png', 'c51641976661.png', NULL, '2.08 KB', '80 x 80 pixels', '2022-01-12 02:37:41', '2022-01-12 02:37:41', 'admin', 22),
(48, 'c6.png', 'c61641976662.png', NULL, '3.54 KB', '80 x 80 pixels', '2022-01-12 02:37:42', '2022-01-12 02:37:42', 'admin', 22),
(49, 'm1.png', 'm11641985855.png', NULL, '2.6 KB', '60 x 60 pixels', '2022-01-12 05:10:55', '2022-01-12 05:10:55', 'admin', 22),
(50, 'm2.png', 'm21641985855.png', NULL, '2.27 KB', '60 x 60 pixels', '2022-01-12 05:10:55', '2022-01-12 05:10:55', 'admin', 22),
(51, 'm3.png', 'm31641985855.png', NULL, '2.44 KB', '60 x 60 pixels', '2022-01-12 05:10:55', '2022-01-12 05:10:55', 'admin', 22),
(52, 'm4.png', 'm41641985855.png', NULL, '2.32 KB', '60 x 60 pixels', '2022-01-12 05:10:55', '2022-01-12 05:10:55', 'admin', 22),
(53, 'market-shape.png', 'market-shape1641985855.png', NULL, '39.73 KB', '608 x 608 pixels', '2022-01-12 05:10:55', '2022-01-12 05:10:55', 'admin', 22),
(54, 'circle1.png', 'circle11641994879.png', NULL, '1.35 KB', '70 x 70 pixels', '2022-01-12 07:41:20', '2022-01-12 07:41:20', 'admin', 22),
(55, 'circle2.png', 'circle21641994879.png', NULL, '5.26 KB', '164 x 164 pixels', '2022-01-12 07:41:20', '2022-01-12 07:41:20', 'admin', 22),
(56, 'dot-square.png', 'dot-square1641994880.png', NULL, '3.79 KB', '138 x 138 pixels', '2022-01-12 07:41:20', '2022-01-12 07:41:20', 'admin', 22),
(57, 'line-cross.png', 'line-cross1641994880.png', NULL, '3.94 KB', '222 x 139 pixels', '2022-01-12 07:41:20', '2022-01-12 07:41:20', 'admin', 22),
(58, 'banner1.png', 'banner11642048429.png', NULL, '686.35 KB', '641 x 918 pixels', '2022-01-12 22:33:49', '2022-01-12 22:33:49', 'admin', 22),
(59, 'logo-01.png', 'logo-011642251277.png', NULL, '4.19 KB', '214 x 51 pixels', '2022-01-15 06:54:37', '2022-01-15 06:54:37', 'admin', 22),
(60, 'c2.png', 'c21642306753.png', NULL, '1.76 KB', '50 x 28 pixels', '2022-01-15 22:19:13', '2022-01-15 22:19:13', 'admin', 22),
(61, 'c1.png', 'c11642306753.png', NULL, '1.39 KB', '50 x 28 pixels', '2022-01-15 22:19:13', '2022-01-15 22:19:13', 'admin', 22),
(62, 'c3.png', 'c31642306753.png', NULL, '2.18 KB', '50 x 28 pixels', '2022-01-15 22:19:13', '2022-01-15 22:19:13', 'admin', 22),
(63, 'c4.png', 'c41642306753.png', NULL, '1.61 KB', '50 x 28 pixels', '2022-01-15 22:19:13', '2022-01-15 22:19:13', 'admin', 22),
(64, 'logo-footer.png', 'logo-footer1642310896.png', NULL, '3.55 KB', '173 x 41 pixels', '2022-01-15 23:28:16', '2022-01-15 23:28:16', 'admin', 22),
(65, 'r2vg1z.jpg', 'r2vg1z1642491053.jpg', NULL, '25.52 KB', '720 x 720 pixels', '2022-01-18 01:30:53', '2022-01-18 01:30:53', 'web', 3),
(66, 'paytm.jpeg', 'paytm1642502870.jpeg', NULL, '18.17 KB', '630 x 336 pixels', '2022-01-18 04:47:50', '2022-01-18 04:47:50', 'admin', 22),
(67, 'stripe.png', 'stripe1642503882.png', NULL, '3.28 KB', '318 x 159 pixels', '2022-01-18 05:04:42', '2022-01-18 05:04:42', 'admin', 22),
(68, 'razorpay.png', 'razorpay1642506994.png', NULL, '20.27 KB', '900 x 230 pixels', '2022-01-18 05:56:34', '2022-01-18 05:56:34', 'admin', 22),
(69, 'paystack.png', 'paystack1642507044.png', NULL, '2.86 KB', '301 x 167 pixels', '2022-01-18 05:57:24', '2022-01-18 05:57:24', 'admin', 22),
(70, 'moli.png', 'moli1642507075.png', NULL, '2.11 KB', '301 x 167 pixels', '2022-01-18 05:57:55', '2022-01-18 05:57:55', 'admin', 22),
(71, 'flutterwave-logo.png', 'flutterwave-logo1642507117.png', NULL, '4.51 KB', '900 x 500 pixels', '2022-01-18 05:58:38', '2022-01-18 05:58:38', 'admin', 22),
(72, 'paypal.png', 'paypal1642511774.png', NULL, '3.14 KB', '300 x 168 pixels', '2022-01-18 07:16:14', '2022-01-18 07:16:14', 'admin', 22),
(73, 'OIP.jpg', 'oip1642584590.jpg', NULL, '10.9 KB', '324 x 173 pixels', '2022-01-19 03:29:50', '2022-05-05 11:52:39', 'admin', 22),
(74, 'payfast.png', 'payfast1642666904.png', NULL, '2.72 KB', '314 x 160 pixels', '2022-01-20 02:21:44', '2022-01-20 02:21:44', 'admin', 22),
(75, 'cashfree.png', 'cashfree1642672230.png', NULL, '4.06 KB', '310 x 162 pixels', '2022-01-20 03:50:30', '2022-01-20 03:50:30', 'admin', 22),
(76, 'instramojo.jpeg', 'instramojo1642673705.jpeg', NULL, '23.94 KB', '827 x 437 pixels', '2022-01-20 04:15:05', '2022-01-20 04:15:05', 'admin', 22),
(77, 'mercadopago.png', 'mercadopago1642674662.png', NULL, '17.66 KB', '1280 x 334 pixels', '2022-01-20 04:31:03', '2022-01-20 04:31:03', 'admin', 22),
(78, 'midtrans.jpg', 'midtrans1642678419.jpg', NULL, '13.1 KB', '710 x 380 pixels', '2022-01-20 05:33:39', '2022-01-20 05:33:39', 'admin', 22),
(79, 'sd.jpg', 'sd1643688644.jpg', NULL, '176.72 KB', '730 x 497 pixels', '2022-01-31 22:10:45', '2022-01-31 22:10:45', 'web', 1),
(80, 'sd4.jpg', 'sd41643689294.jpg', NULL, '165.76 KB', '730 x 497 pixels', '2022-01-31 22:21:35', '2022-01-31 22:21:35', 'web', 1),
(81, 'sd2.jpg', 'sd21643689732.jpg', NULL, '67.69 KB', '730 x 497 pixels', '2022-01-31 22:28:52', '2022-01-31 22:28:52', 'web', 1),
(82, '350.png', '3501643689992.png', NULL, '94.74 KB', '350 x 240 pixels', '2022-01-31 22:33:12', '2022-01-31 22:33:12', 'web', 1),
(83, '730.png', '7301643690061.png', NULL, '324.15 KB', '730 x 500 pixels', '2022-01-31 22:34:22', '2022-01-31 22:34:22', 'web', 1),
(84, '1920.png', '19201643690135.png', NULL, '1.63 MB', '1920 x 1316 pixels', '2022-01-31 22:35:36', '2022-01-31 22:35:36', 'web', 1),
(85, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-54.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-541643693233.png', NULL, '459.88 KB', '730 x 497 pixels', '2022-01-31 23:27:13', '2022-01-31 23:27:13', 'web', 1),
(86, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-61.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-611643693372.png', NULL, '477.29 KB', '730 x 497 pixels', '2022-01-31 23:29:32', '2022-01-31 23:29:32', 'web', 1),
(87, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-58.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-581643693756.png', NULL, '577.83 KB', '730 x 497 pixels', '2022-01-31 23:35:56', '2022-01-31 23:35:56', 'web', 1),
(88, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-20.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-201643693988.png', NULL, '445.6 KB', '730 x 497 pixels', '2022-01-31 23:39:48', '2022-01-31 23:39:48', 'web', 1),
(89, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-49.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-491643694792.png', NULL, '593.68 KB', '730 x 497 pixels', '2022-01-31 23:53:12', '2022-01-31 23:53:12', 'web', 2),
(90, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-51.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-511643694967.png', NULL, '627.07 KB', '730 x 497 pixels', '2022-01-31 23:56:07', '2022-01-31 23:56:07', 'web', 2),
(91, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-7.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-71643695162.png', NULL, '551.09 KB', '730 x 497 pixels', '2022-01-31 23:59:22', '2022-01-31 23:59:22', 'web', 2),
(92, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-9.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-91643695259.png', NULL, '546.44 KB', '730 x 497 pixels', '2022-02-01 00:00:59', '2022-02-01 00:00:59', 'web', 2),
(93, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-64.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-641643695713.png', NULL, '557.07 KB', '730 x 497 pixels', '2022-02-01 00:08:33', '2022-02-01 00:08:33', 'web', 2),
(94, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-31.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-311643696011.png', NULL, '475.09 KB', '730 x 497 pixels', '2022-02-01 00:13:32', '2022-02-01 00:13:32', 'web', 2),
(95, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-35.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-351643700019.png', NULL, '681.53 KB', '730 x 497 pixels', '2022-02-01 01:20:19', '2022-02-01 01:20:19', 'web', 2),
(96, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-57.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-571643701130.png', NULL, '566.57 KB', '730 x 497 pixels', '2022-02-01 01:38:51', '2022-02-01 01:38:51', 'web', 1),
(97, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-19.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-191643709206.png', NULL, '445.87 KB', '730 x 497 pixels', '2022-02-01 03:53:26', '2022-02-01 03:53:26', 'web', 5),
(98, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-15.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-151643709530.png', NULL, '609.5 KB', '730 x 497 pixels', '2022-02-01 03:58:51', '2022-02-01 03:58:51', 'web', 5),
(99, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-34.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-341643710084.png', NULL, '361.25 KB', '730 x 497 pixels', '2022-02-01 04:08:04', '2022-02-01 04:08:04', 'web', 5),
(100, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-22.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-221643710652.png', NULL, '389.29 KB', '730 x 497 pixels', '2022-02-01 04:17:32', '2022-02-01 04:17:32', 'web', 5),
(101, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-56.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-561643711145.png', NULL, '705.04 KB', '730 x 497 pixels', '2022-02-01 04:25:45', '2022-02-01 04:25:45', 'web', 5),
(102, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-45.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-451643711224.png', NULL, '600.61 KB', '730 x 497 pixels', '2022-02-01 04:27:04', '2022-02-01 04:27:04', 'web', 5),
(103, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-5.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-51643712682.png', 'AAAAA', '431.76 KB', '730 x 497 pixels', '2022-02-01 04:51:22', '2022-05-10 14:14:39', 'admin', 22),
(104, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-29.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-291643712832.png', NULL, '612.42 KB', '730 x 497 pixels', '2022-02-01 04:53:52', '2022-02-01 04:53:52', 'admin', 22),
(105, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-8.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-81643712998.png', NULL, '458.52 KB', '730 x 497 pixels', '2022-02-01 04:56:38', '2022-02-01 04:56:38', 'admin', 22),
(106, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-54.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-541643714922.png', NULL, '459.88 KB', '730 x 497 pixels', '2022-02-01 05:28:42', '2022-02-01 05:28:42', 'admin', 22),
(107, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-61.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-611643715007.png', 'ddddd', '477.29 KB', '730 x 497 pixels', '2022-02-01 05:30:08', '2022-04-03 11:02:40', 'admin', 22),
(108, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-58.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-581643715103.png', NULL, '577.83 KB', '730 x 497 pixels', '2022-02-01 05:31:43', '2022-02-01 05:31:43', 'admin', 22),
(109, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-20.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-201643715291.png', NULL, '445.6 KB', '730 x 497 pixels', '2022-02-01 05:34:51', '2022-02-01 05:34:51', 'admin', 22),
(110, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-49.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-491643715397.png', NULL, '593.68 KB', '730 x 497 pixels', '2022-02-01 05:36:37', '2022-02-01 05:36:37', 'admin', 22),
(111, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-52.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-521643715484.png', NULL, '602.87 KB', '730 x 497 pixels', '2022-02-01 05:38:05', '2022-02-01 05:38:05', 'admin', 22),
(112, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-7.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-71643715584.png', NULL, '551.09 KB', '730 x 497 pixels', '2022-02-01 05:39:44', '2022-02-01 05:39:44', 'admin', 22),
(113, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-9.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-91643715796.png', NULL, '546.44 KB', '730 x 497 pixels', '2022-02-01 05:43:16', '2022-02-01 05:43:16', 'admin', 22),
(114, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-31.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-311643715937.png', NULL, '475.09 KB', '730 x 497 pixels', '2022-02-01 05:45:37', '2022-02-01 05:45:37', 'admin', 22),
(115, 'circle1.png', 'circle11643799195.png', NULL, '1.35 KB', '70 x 70 pixels', '2022-02-02 04:53:15', '2022-02-02 04:53:15', 'admin', 22),
(116, 'circle2.png', 'circle21643799195.png', NULL, '5.26 KB', '164 x 164 pixels', '2022-02-02 04:53:15', '2022-02-02 04:53:15', 'admin', 22),
(117, 'dot-square.png', 'dot-square1643799195.png', NULL, '3.79 KB', '138 x 138 pixels', '2022-02-02 04:53:15', '2022-02-02 04:53:15', 'admin', 22),
(118, 'line-cross.png', 'line-cross1643799195.png', NULL, '3.94 KB', '222 x 139 pixels', '2022-02-02 04:53:15', '2022-02-02 04:53:15', 'admin', 22),
(119, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-24.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-241643809860.png', NULL, '455.07 KB', '730 x 497 pixels', '2022-02-02 07:51:01', '2022-02-02 07:51:01', 'web', 14),
(120, 'seller-s2.jpg', 'seller-s21644057790.jpg', NULL, '11.68 KB', '120 x 120 pixels', '2022-02-05 04:43:10', '2022-02-05 04:43:10', 'web', 1),
(121, 'ads.jpg', 'ads1644057883.jpg', NULL, '250.25 KB', '1394 x 315 pixels', '2022-02-05 04:44:44', '2022-02-05 04:44:44', 'web', 1),
(122, 'ads.jpg', 'ads1644069923.jpg', NULL, '250.25 KB', '1394 x 315 pixels', '2022-02-05 08:05:24', '2022-02-05 08:05:24', 'web', 3),
(123, '404.png', '4041644133345.png', NULL, '67.12 KB', '438 x 419 pixels', '2022-02-06 01:42:25', '2022-02-06 01:42:25', 'admin', 22),
(124, 'logo-02.png', 'logo-021644225302.png', NULL, '4.49 KB', '214 x 51 pixels', '2022-02-07 03:15:02', '2022-02-07 03:15:02', 'admin', 22),
(125, 'logo-01.png', 'logo-011644226204.png', NULL, '4.19 KB', '214 x 51 pixels', '2022-02-07 03:30:04', '2022-02-07 03:30:04', 'admin', 22),
(126, 'logo-footer.png', 'logo-footer1644227812.png', NULL, '3.55 KB', '173 x 41 pixels', '2022-02-07 03:56:52', '2022-02-07 03:56:52', 'admin', 22),
(127, 'cashfree.png', 'cashfree1644320824.png', NULL, '4.06 KB', '310 x 162 pixels', '2022-02-08 05:47:04', '2022-02-08 05:47:04', 'admin', 22),
(129, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-59.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-591644410863.png', NULL, '559.72 KB', '730 x 497 pixels', '2022-02-09 06:47:44', '2022-02-09 06:47:44', 'admin', 22),
(130, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-59.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-591644647980.png', NULL, '559.72 KB', '730 x 497 pixels', '2022-02-12 00:39:40', '2022-02-12 00:39:40', 'web', 1),
(131, 'extra1.jpg', 'extra11644649003.jpg', NULL, '6.46 KB', '78 x 78 pixels', '2022-02-12 00:56:43', '2022-02-12 00:56:43', 'web', 1),
(132, 'extra2.jpg', 'extra21644649003.jpg', NULL, '4.38 KB', '78 x 78 pixels', '2022-02-12 00:56:43', '2022-02-12 00:56:43', 'web', 1),
(133, 'extra3.jpg', 'extra31644649004.jpg', NULL, '5.85 KB', '78 x 78 pixels', '2022-02-12 00:56:44', '2022-02-12 00:56:44', 'web', 1),
(134, 'extra4.jpg', 'extra41644649004.jpg', NULL, '6.22 KB', '78 x 78 pixels', '2022-02-12 00:56:44', '2022-02-12 00:56:44', 'web', 1),
(135, 'brick-wall.png', 'brick-wall1644742898.png', NULL, '5.96 KB', '512 x 512 pixels', '2022-02-13 03:01:39', '2022-02-13 03:01:39', 'web', 1),
(136, 'fridge.png', 'fridge1644742898.png', NULL, '7.82 KB', '512 x 512 pixels', '2022-02-13 03:01:39', '2022-02-13 03:01:39', 'web', 1),
(137, 'kitchen.png', 'kitchen1644742899.png', NULL, '18.29 KB', '512 x 512 pixels', '2022-02-13 03:01:39', '2022-02-13 03:01:39', 'web', 1),
(138, 'tv.png', 'tv1644742899.png', NULL, '10.88 KB', '512 x 512 pixels', '2022-02-13 03:01:39', '2022-02-13 03:01:39', 'web', 1),
(139, 'air-conditioner.png', 'air-conditioner1644743229.png', NULL, '12.77 KB', '512 x 512 pixels', '2022-02-13 03:07:09', '2022-02-13 03:07:09', 'web', 1),
(140, 'beauty-treatment.png', 'beauty-treatment1644743435.png', NULL, '22.27 KB', '512 x 512 pixels', '2022-02-13 03:10:35', '2022-02-13 03:10:35', 'web', 1),
(141, 'table.png', 'table1644743548.png', NULL, '7.05 KB', '512 x 512 pixels', '2022-02-13 03:12:28', '2022-02-13 03:12:28', 'web', 1),
(142, 'door.png', 'door1644743630.png', NULL, '5.87 KB', '512 x 512 pixels', '2022-02-13 03:13:50', '2022-02-13 03:13:50', 'web', 1),
(143, 'car.png', 'car1644743744.png', NULL, '9.24 KB', '512 x 512 pixels', '2022-02-13 03:15:44', '2022-02-13 03:15:44', 'web', 1),
(144, 'window.png', 'window1644744549.png', NULL, '21.03 KB', '512 x 512 pixels', '2022-02-13 03:29:09', '2022-02-13 03:29:09', 'web', 1),
(145, 'massage.png', 'massage1644744796.png', NULL, '40.64 KB', '512 x 512 pixels', '2022-02-13 03:33:17', '2022-02-13 03:33:17', 'web', 2),
(146, 'shave.png', 'shave1644744864.png', NULL, '35.19 KB', '512 x 512 pixels', '2022-02-13 03:34:24', '2022-02-13 03:34:24', 'web', 2),
(147, 'hair-style.png', 'hair-style1644744948.png', NULL, '36.43 KB', '512 x 512 pixels', '2022-02-13 03:35:49', '2022-02-13 03:35:49', 'web', 2),
(148, 'car.png', 'car1644745074.png', NULL, '9.24 KB', '512 x 512 pixels', '2022-02-13 03:37:54', '2022-02-13 03:37:54', 'web', 2),
(149, 'full-service.png', 'full-service1644745094.png', NULL, '12 KB', '512 x 512 pixels', '2022-02-13 03:38:14', '2022-02-13 03:38:14', 'web', 2),
(150, 'seater-sofa.png', 'seater-sofa1644745215.png', NULL, '17.08 KB', '512 x 512 pixels', '2022-02-13 03:40:16', '2022-02-13 03:40:16', 'web', 2),
(151, 'broken-wire.png', 'broken-wire1644745364.png', NULL, '13.69 KB', '512 x 512 pixels', '2022-02-13 03:42:44', '2022-02-13 03:42:44', 'web', 2),
(152, 'circuit-board.png', 'circuit-board1644745364.png', NULL, '9.86 KB', '512 x 512 pixels', '2022-02-13 03:42:44', '2022-02-13 03:42:44', 'web', 2),
(153, 'seater-sofa.png', 'seater-sofa1644745402.png', NULL, '17.08 KB', '512 x 512 pixels', '2022-02-13 03:43:22', '2022-02-13 03:43:22', 'web', 2),
(154, 'hairstyle.png', 'hairstyle1644745517.png', NULL, '58.85 KB', '512 x 512 pixels', '2022-02-13 03:45:17', '2022-02-13 03:45:17', 'web', 5),
(155, 'tv.png', 'tv1644745549.png', NULL, '10.88 KB', '512 x 512 pixels', '2022-02-13 03:45:49', '2022-02-13 03:45:49', 'web', 5),
(156, 'electrical-panel.png', 'electrical-panel1644745615.png', NULL, '7.78 KB', '512 x 512 pixels', '2022-02-13 03:46:55', '2022-02-13 03:46:55', 'web', 5),
(157, 'skincare.png', 'skincare1644745720.png', NULL, '29.21 KB', '512 x 512 pixels', '2022-02-13 03:48:40', '2022-06-11 05:44:44', 'web', 5),
(158, 'wheel.png', 'wheel1644746364.png', NULL, '22.29 KB', '512 x 512 pixels', '2022-02-13 03:59:24', '2022-02-13 03:59:24', 'web', 2),
(159, 'massage (1).png', 'massage-11644746519.png', NULL, '27.47 KB', '512 x 512 pixels', '2022-02-13 04:01:59', '2022-02-13 04:01:59', 'web', 2),
(160, 'cleaning.png', 'cleaning1644746825.png', NULL, '19.95 KB', '512 x 512 pixels', '2022-02-13 04:07:05', '2022-02-13 04:07:05', 'web', 1),
(161, 'hairstyle.png', 'hairstyle1644746911.png', 'https://bytesed.com/laravel/qixer/assets/uploads/media-uploader/semi-large-hairstyle1644746911.png', '58.85 KB', '512 x 512 pixels', '2022-02-13 04:08:31', '2022-04-06 11:20:11', 'web', 1),
(162, 'dye.png', 'dye1644746990.png', NULL, '28.43 KB', '512 x 512 pixels', '2022-02-13 04:09:50', '2022-02-13 04:09:50', 'web', 1),
(163, 'door.png', 'door1644747194.png', NULL, '5.87 KB', '512 x 512 pixels', '2022-02-13 04:13:14', '2022-02-13 04:13:14', 'web', 1),
(164, 'about.jpg', 'about1644902065.jpg', NULL, '131.49 KB', '501 x 443 pixels', '2022-02-14 23:14:25', '2022-02-14 23:14:25', 'admin', 22),
(165, 'about-shape.jpg', 'about-shape1644902293.jpg', NULL, '8.18 KB', '208 x 208 pixels', '2022-02-14 23:18:13', '2022-02-14 23:18:13', 'admin', 22),
(166, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-60.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-601645017295.png', NULL, '532.08 KB', '730 x 497 pixels', '2022-02-16 18:14:55', '2022-02-16 18:14:55', 'web', 5),
(167, 'ads.jpg', 'ads1645105027.jpg', NULL, '250.25 KB', '1394 x 315 pixels', '2022-02-17 18:37:07', '2022-02-17 18:37:07', 'web', 5),
(168, 'wim-van-t-einde-ZnSi3W0MBHI-unsplash.jpg', 'wim-van-t-einde-znsi3w0mbhi-unsplash1646643015.jpg', NULL, '3.21 MB', '4032 x 2268 pixels', '2022-03-07 13:50:18', '2022-03-07 13:50:18', 'web', 1),
(169, 'images.jfif', 'images1646676576.jfif', NULL, '5.06 KB', '225 x 225 pixels', '2022-03-07 23:09:36', '2022-03-07 23:09:36', 'web', 36),
(170, 'IMG-20220312-WA0006.jpeg', 'img-20220312-wa00061647203599.jpeg', NULL, '1.41 MB', '2448 x 3264 pixels', '2022-03-14 00:33:21', '2022-04-11 18:56:06', 'web', 1),
(171, '11227939_884665174948836_2162515690193028077_n.jpg', '11227939-884665174948836-2162515690193028077-n1648340971.jpg', NULL, '29.87 KB', '701 x 701 pixels', '2022-03-27 04:29:31', '2022-03-27 04:29:31', 'web', 1),
(172, 'download.png', 'download1648442270.png', NULL, '3.15 KB', '225 x 225 pixels', '2022-03-28 08:37:50', '2022-03-28 08:37:50', 'admin', 22),
(173, '2022_03_28_16.51.03.jpg', '2022-03-28-1651031648477022.jpg', NULL, '400.23 KB', '720 x 1640 pixels', '2022-03-28 18:17:02', '2022-03-28 18:17:02', 'web', 1),
(174, 'Screenshot_20220330-192825.jpg', 'screenshot-20220330-1928251648686596.jpg', NULL, '355.6 KB', '720 x 1640 pixels', '2022-03-31 04:29:57', '2022-03-31 04:29:57', 'web', 1),
(176, 'd99460c91f759a23ca369c00c3774d17.jpg', 'd99460c91f759a23ca369c00c3774d171649133331.jpg', NULL, '1.16 MB', '3600 x 3600 pixels', '2022-04-05 08:35:34', '2022-05-15 10:34:00', 'web', 107),
(177, 'IMG-20220314-WA0000.jpg', 'img-20220314-wa00001649348574.jpg', NULL, '13.67 KB', '553 x 451 pixels', '2022-04-07 20:22:54', '2022-04-07 20:22:54', 'admin', 22),
(178, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-12.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-121651039452.png', NULL, '510.09 KB', '730 x 497 pixels', '2022-04-27 00:04:12', '2022-04-27 00:04:12', 'web', 1),
(179, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-20.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-201651039452.png', NULL, '445.6 KB', '730 x 497 pixels', '2022-04-27 00:04:12', '2022-04-27 00:04:12', 'web', 1),
(180, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-14.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-141651039503.png', NULL, '233.36 KB', '730 x 497 pixels', '2022-04-27 00:05:04', '2022-06-14 09:47:45', 'web', 1),
(181, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-26.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-261651039503.png', NULL, '512.98 KB', '730 x 497 pixels', '2022-04-27 00:05:04', '2022-07-07 08:21:17', 'web', 1),
(182, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-31.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-311651039504.png', NULL, '475.09 KB', '730 x 497 pixels', '2022-04-27 00:05:04', '2022-04-27 00:05:04', 'web', 1),
(183, 'Frame 21.jpg', 'frame-211651124011.jpg', NULL, '342.43 KB', '730 x 497 pixels', '2022-04-28 09:33:31', '2022-04-28 09:33:31', 'web', 1),
(184, 'Frame 19.jpg', 'frame-191651124014.jpg', NULL, '471.57 KB', '730 x 497 pixels', '2022-04-28 09:33:35', '2022-04-28 09:33:35', 'web', 1),
(185, 'Frame 18.jpg', 'frame-181651124016.jpg', NULL, '340.22 KB', '730 x 497 pixels', '2022-04-28 09:33:36', '2022-04-28 09:33:36', 'web', 1),
(186, 'Frame 20.jpg', 'frame-201651124017.jpg', NULL, '330.88 KB', '730 x 497 pixels', '2022-04-28 09:33:37', '2022-04-28 09:33:37', 'web', 1),
(187, 'Frame 22.jpg', 'frame-221651124049.jpg', NULL, '340.96 KB', '730 x 497 pixels', '2022-04-28 09:34:09', '2022-04-28 09:34:09', 'web', 1),
(188, 'logo 1-01.png', 'logo-1-011651564718.png', NULL, '48.5 KB', '3187 x 964 pixels', '2022-05-03 11:58:39', '2022-05-03 11:58:39', 'admin', 22),
(189, 'favicon.png', 'favicon1651564722.png', NULL, '1.56 KB', '64 x 59 pixels', '2022-05-03 11:58:42', '2022-05-03 11:58:42', 'admin', 22),
(190, '1 (89).jpg', '1-891651715872.jpg', NULL, '401.72 KB', '2508 x 1672 pixels', '2022-05-05 05:57:53', '2022-05-05 12:35:52', 'admin', 22),
(191, 'CR3A3473.JPG', 'cr3a34731651765556.JPG', NULL, '4.89 MB', '5760 x 3840 pixels', '2022-05-05 19:46:02', '2022-05-28 13:31:05', 'admin', 22),
(192, 'Auction.png', 'auction1651785675.png', NULL, '5.23 MB', '1440 x 10103 pixels', '2022-05-06 01:21:20', '2022-05-06 01:21:20', 'web', 163),
(193, 'WhatsApp Image 2022-05-05 at 6.29.36 PM.jpeg', 'whatsapp-image-2022-05-05-at-62936-pm1652006894.jpeg', NULL, '50.68 KB', '929 x 617 pixels', '2022-05-08 14:48:14', '2022-05-08 14:48:38', 'admin', 22),
(194, 'horizontal-shot-of-attentive-asian-housewife-disin-2022-02-03-02-56-59-utc.jpg', 'horizontal-shot-of-attentive-asian-housewife-disin-2022-02-03-02-56-59-utc1652227077.jpg', NULL, '349.89 KB', '2507 x 1672 pixels', '2022-05-11 03:57:58', '2022-05-11 03:57:58', 'web', 182),
(195, 'cleaning-tools-composition-flat-lay-on-yellow-wood-2021-12-09-07-47-44-utc.jpg', 'cleaning-tools-composition-flat-lay-on-yellow-wood-2021-12-09-07-47-44-utc1652227092.jpg', NULL, '359.16 KB', '2508 x 1672 pixels', '2022-05-11 03:58:13', '2022-05-11 03:58:13', 'web', 182),
(196, 'localhost_3000_.png', 'localhost-30001652272930.png', NULL, '231.3 KB', '1903 x 671 pixels', '2022-05-11 16:42:10', '2022-05-11 16:42:10', 'admin', 22),
(197, 'localhost_3000_.png', 'localhost-30001652272951.png', NULL, '231.3 KB', '1903 x 671 pixels', '2022-05-11 16:42:31', '2022-05-11 16:42:31', 'admin', 22),
(198, 'Screenshot_20220512-224224_Chrome.jpg', 'screenshot-20220512-224224-chrome1652627333.jpg', NULL, '349.02 KB', '720 x 1600 pixels', '2022-05-15 19:08:54', '2022-05-15 19:08:54', 'web', 197),
(199, 'Q8e63nHZeAU.jpg', 'q8e63nhzeau1652633642.jpg', NULL, '252.33 KB', '1920 x 1920 pixels', '2022-05-15 20:54:03', '2022-05-15 20:54:03', 'web', 199),
(200, '925981.jpg', '9259811652911511.jpg', NULL, '3.81 KB', '128 x 128 pixels', '2022-05-19 02:05:11', '2022-05-19 02:05:11', 'web', 208),
(201, 'NEWbAsset 11@0.5x.png', 'newbasset-11-at-05x1652984281.png', NULL, '1.18 KB', '91 x 24 pixels', '2022-05-19 22:18:01', '2022-05-19 22:18:01', 'admin', 22),
(202, 'NEWbAsset 10.png', 'newbasset-101652984294.png', NULL, '2.52 KB', '182 x 48 pixels', '2022-05-19 22:18:14', '2022-05-19 22:18:14', 'admin', 22),
(203, 'logo.png', 'logo1652984304.png', NULL, '4.66 KB', '363 x 95 pixels', '2022-05-19 22:18:24', '2022-05-19 22:18:24', 'admin', 22),
(204, 'white.png', 'white1652984305.png', NULL, '2.54 KB', '346 x 95 pixels', '2022-05-19 22:18:25', '2022-05-19 22:18:25', 'admin', 22),
(205, 'logob.png', 'logob1652984305.png', NULL, '2.54 KB', '348 x 95 pixels', '2022-05-19 22:18:25', '2022-05-19 22:19:09', 'admin', 22),
(206, 'logoAsset 9@4x.png', 'logoasset-9-at-4x1652984316.png', NULL, '81.7 KB', '3105 x 1640 pixels', '2022-05-19 22:18:37', '2022-05-19 22:18:37', 'admin', 22),
(207, 'Screenshot_20220521_214016.jpg', 'screenshot-20220521-2140161653236513.jpg', NULL, '364.59 KB', '1080 x 974 pixels', '2022-05-22 20:21:53', '2022-05-22 20:21:53', 'admin', 22),
(208, 'mc.JPG', 'mc1653754798.JPG', NULL, '10.76 KB', '250 x 45 pixels', '2022-05-28 20:19:58', '2022-05-28 20:19:58', 'web', 240),
(209, 'S2.png', 's21654088278.png', NULL, '33.77 KB', '320 x 148 pixels', '2022-06-01 16:57:58', '2022-06-01 16:57:58', 'admin', 22),
(210, 'S1.png', 's11654088278.png', NULL, '62.3 KB', '320 x 148 pixels', '2022-06-01 16:57:58', '2022-06-01 16:57:58', 'admin', 22),
(211, 'S3.png', 's31654088279.png', NULL, '32.1 KB', '320 x 148 pixels', '2022-06-01 16:57:59', '2022-06-01 16:57:59', 'admin', 22),
(212, '001-salon.png', '001-salon1654088379.png', NULL, '7.11 KB', '128 x 128 pixels', '2022-06-01 16:59:39', '2022-06-01 16:59:39', 'admin', 22),
(213, '002-house.png', '002-house1654088380.png', NULL, '5.45 KB', '128 x 128 pixels', '2022-06-01 16:59:40', '2022-06-01 16:59:40', 'admin', 22),
(214, '003-cpu.png', '003-cpu1654088380.png', NULL, '4.95 KB', '128 x 128 pixels', '2022-06-01 16:59:40', '2022-06-01 16:59:40', 'admin', 22),
(215, '004-mop.png', '004-mop1654088380.png', NULL, '6.97 KB', '128 x 128 pixels', '2022-06-01 16:59:40', '2022-06-01 16:59:40', 'admin', 22),
(216, '005-paint-palette.png', '005-paint-palette1654088380.png', NULL, '6.39 KB', '128 x 128 pixels', '2022-06-01 16:59:40', '2022-06-01 16:59:40', 'admin', 22),
(217, '006-help.png', '006-help1654088381.png', NULL, '6.78 KB', '128 x 128 pixels', '2022-06-01 16:59:41', '2022-06-01 16:59:41', 'admin', 22),
(218, '007-social-media.png', '007-social-media1654088381.png', NULL, '10.42 KB', '128 x 128 pixels', '2022-06-01 16:59:41', '2022-06-01 16:59:41', 'admin', 22),
(219, '008-bubbles.png', '008-bubbles1654088381.png', NULL, '7.49 KB', '128 x 128 pixels', '2022-06-01 16:59:42', '2022-06-01 16:59:42', 'admin', 22),
(220, 'image_picker8862614319185928389.jpg.jpg', 'image-picker8862614319185928389jpg1654320007.jpg', NULL, '77.44 KB', '720 x 1600 pixels', '2022-06-04 09:20:08', '2022-06-04 09:20:08', 'admin', NULL),
(221, 'image_picker3395934874189110471.jpg.jpg', 'image-picker3395934874189110471jpg1654321159.jpg', NULL, '167.51 KB', '1080 x 2400 pixels', '2022-06-04 09:39:20', '2022-06-04 09:39:20', 'admin', NULL),
(222, '25-Beautiful-Cinderella-Coloring-Pages-For-Your-Toddler_1-910x1024.jpg', '25-beautiful-cinderella-coloring-pages-for-your-toddler-1-910x10241654351267.jpg', NULL, '68.39 KB', '910 x 1024 pixels', '2022-06-04 18:01:08', '2022-06-04 18:01:08', 'admin', 22),
(223, 'image_picker7975150125260668698.jpg.jpg', 'image-picker7975150125260668698jpg1654704108.jpg', NULL, '178.48 KB', '1300 x 1300 pixels', '2022-06-08 10:01:48', '2022-06-08 10:01:48', 'admin', NULL),
(224, 'image_picker8059686529657847860.jpg.jpg', 'image-picker8059686529657847860jpg1654768310.jpg', NULL, '335.7 KB', '960 x 960 pixels', '2022-06-09 03:51:50', '2022-06-09 03:51:50', 'admin', NULL),
(225, 'image_picker6816185857731392238.jpg.jpg', 'image-picker6816185857731392238jpg1654781471.jpg', NULL, '1.45 MB', '2448 x 3264 pixels', '2022-06-09 07:31:13', '2022-06-09 07:31:13', 'admin', NULL),
(226, 'image_picker5153446679905995484.jpg.jpg', 'image-picker5153446679905995484jpg1654802465.jpg', NULL, '25.81 KB', '480 x 480 pixels', '2022-06-09 13:21:05', '2022-06-09 13:21:05', 'admin', NULL),
(227, 'image_picker1907834294180281395.jpg.jpg', 'image-picker1907834294180281395jpg1654811729.jpg', NULL, '638.24 KB', '1080 x 2340 pixels', '2022-06-09 15:55:30', '2022-06-09 15:55:30', 'admin', NULL),
(228, 'image_picker950017028222866533.jpg.jpg', 'image-picker950017028222866533jpg1654882575.jpg', NULL, '16 MB', '4608 x 3456 pixels', '2022-06-10 11:36:20', '2022-06-10 11:36:20', 'admin', NULL),
(229, 'image_picker1282251233654716549.jpg.jpg', 'image-picker1282251233654716549jpg1655043142.jpg', NULL, '327.07 KB', '1080 x 2460 pixels', '2022-06-12 08:12:23', '2022-06-12 08:12:23', 'admin', NULL),
(230, '3D-Man@2x.png', '3d-man-at-2x1655221372.png', NULL, '95.02 KB', '944 x 848 pixels', '2022-06-14 09:42:53', '2023-01-08 01:21:56', 'web', 1),
(231, 'Global-Checkout-Funnel.png', 'global-checkout-funnel1655221417.png', 'jyg', '51.23 KB', '730 x 550 pixels', '2022-06-14 09:43:38', '2022-06-27 05:21:32', 'web', 1),
(232, 'Blueprint256px.png', 'blueprint256px1655221500.png', NULL, '2.97 KB', '256 x 256 pixels', '2022-06-14 09:45:00', '2022-06-14 09:45:00', 'web', 1),
(233, 'Building_Height512px.png', 'building-height512px1655221500.png', NULL, '5.58 KB', '512 x 512 pixels', '2022-06-14 09:45:00', '2022-06-14 09:45:00', 'web', 1),
(234, 'Engineering256px.png', 'engineering256px1655221501.png', NULL, '11.57 KB', '256 x 256 pixels', '2022-06-14 09:45:01', '2022-06-14 09:45:01', 'web', 1),
(235, 'Measuring_Tape512px.png', 'measuring-tape512px1655221501.png', NULL, '13.93 KB', '512 x 512 pixels', '2022-06-14 09:45:01', '2022-06-14 09:45:01', 'web', 1),
(236, 'Painting_Color256px.png', 'painting-color256px1655221501.png', NULL, '3.82 KB', '256 x 256 pixels', '2022-06-14 09:45:02', '2022-06-14 09:45:02', 'web', 1),
(237, 'image_picker1218377256598925890.jpg.jpg', 'image-picker1218377256598925890jpg1655580458.jpg', NULL, '226.84 KB', '512 x 512 pixels', '2022-06-18 13:27:38', '2022-06-18 13:27:38', 'admin', NULL),
(238, 'image_picker8810152954525379743.jpg.jpg', 'image-picker8810152954525379743jpg1655580826.jpg', NULL, '87.43 KB', '900 x 1600 pixels', '2022-06-18 13:33:46', '2022-07-14 12:01:50', 'admin', NULL),
(239, 'IMG_2742.png', 'img-27421655589418.png', NULL, '364.88 KB', '1042 x 1853 pixels', '2022-06-18 15:56:59', '2022-06-18 15:56:59', 'web', 511),
(240, 'rent-a-home-01.png', 'rent-a-home-011655601778.png', NULL, '70.49 KB', '1000 x 540 pixels', '2022-06-18 19:22:59', '2022-06-18 19:22:59', 'web', 518),
(241, 'image_picker64692099299277916.jpg.jpg', 'image-picker64692099299277916jpg1655647184.jpg', NULL, '3.18 MB', '4032 x 3024 pixels', '2022-06-19 07:59:47', '2022-06-22 05:12:17', 'admin', NULL),
(242, 'dd.png', 'dd1655722823.png', NULL, '2.42 KB', '313 x 161 pixels', '2022-06-20 05:00:23', '2022-06-20 05:00:23', 'admin', 22),
(243, 'image_picker8750567388797051448.jpg.jpg', 'image-picker8750567388797051448jpg1655789779.jpg', NULL, '3.92 MB', '3016 x 4032 pixels', '2022-06-20 23:36:22', '2022-06-20 23:36:22', 'admin', NULL),
(244, 'image_picker2251654108686547890.jpg.jpg', 'image-picker2251654108686547890jpg1655799476.jpg', NULL, '1.82 MB', '4000 x 3000 pixels', '2022-06-21 02:17:59', '2022-06-21 02:17:59', 'admin', NULL),
(245, 'hair-spa.jpg', 'hair-spa1655801455.jpg', NULL, '88.43 KB', '660 x 535 pixels', '2022-06-21 02:50:56', '2022-06-21 02:50:56', 'web', 548),
(246, 'maxresdefault.jpg', 'maxresdefault1655801479.jpg', NULL, '135.95 KB', '1280 x 720 pixels', '2022-06-21 02:51:19', '2022-06-21 02:51:19', 'web', 548),
(247, 'hair3.JPG', 'hair31655801650.JPG', NULL, '80.7 KB', '850 x 995 pixels', '2022-06-21 02:54:10', '2022-06-21 02:54:10', 'web', 548),
(248, 'image_picker5266821474107957701.jpg.jpg', 'image-picker5266821474107957701jpg1655823938.jpg', NULL, '330.71 KB', '1078 x 1080 pixels', '2022-06-21 09:05:38', '2022-06-21 09:05:38', 'admin', NULL),
(249, '00a988b4-4ed7-4b89-984b-ffcac154d526.c10.jpg', '00a988b4-4ed7-4b89-984b-ffcac154d526c101656082627.jpg', NULL, '85.67 KB', '1024 x 768 pixels', '2022-06-24 08:57:08', '2022-08-24 04:07:44', 'web', 1),
(250, '0e3cd564-88cf-4c5e-9076-f3da231504ea.c10.jpg', '0e3cd564-88cf-4c5e-9076-f3da231504eac101656082650.jpg', NULL, '61.46 KB', '1024 x 768 pixels', '2022-06-24 08:57:30', '2022-06-24 08:57:30', 'web', 1),
(251, '0b2014dd-bb6d-4fb6-b06b-fa8b5b19fc65.c10.jpg', '0b2014dd-bb6d-4fb6-b06b-fa8b5b19fc65c101656082650.jpg', NULL, '115.21 KB', '1024 x 619 pixels', '2022-06-24 08:57:30', '2022-06-24 08:57:30', 'web', 1),
(252, '3bbf4cf8-daff-4b97-8494-7f8853335085.c10.jpg', '3bbf4cf8-daff-4b97-8494-7f8853335085c101656082651.jpg', NULL, '90.72 KB', '1024 x 768 pixels', '2022-06-24 08:57:31', '2022-06-24 08:57:31', 'web', 1),
(253, '3c16a61d-27d1-4036-8db8-d2a04fbf9ffe.c10.jpg', '3c16a61d-27d1-4036-8db8-d2a04fbf9ffec101656082651.jpg', NULL, '67.29 KB', '1024 x 768 pixels', '2022-06-24 08:57:31', '2022-07-12 15:37:26', 'web', 1),
(254, '3dcdecc5-3ffc-414f-ba0d-143df9308ea4.c10.jpg', '3dcdecc5-3ffc-414f-ba0d-143df9308ea4c101656082651.jpg', NULL, '86.61 KB', '1024 x 644 pixels', '2022-06-24 08:57:32', '2022-11-13 01:40:58', 'web', 1),
(255, 'image_picker4203788344384438481.jpg.jpg', 'image-picker4203788344384438481jpg1656095306.jpg', 'rahim', '659.01 KB', '3024 x 3024 pixels', '2022-06-24 12:28:28', '2022-06-27 05:21:15', 'admin', NULL),
(256, 'Crème et Bleu Technologie Entreprise Logo.png', 'creme-et-bleu-technologie-entreprise-logo1656240870.png', NULL, '18.45 KB', '500 x 500 pixels', '2022-06-26 04:54:30', '2022-06-26 04:54:30', 'admin', 22),
(257, 'Capture d’écran 2022-06-22 143227.png', 'capture-decran-2022-06-22-1432271656241236.png', NULL, '61.51 KB', '551 x 545 pixels', '2022-06-26 05:00:36', '2022-06-26 05:00:36', 'admin', 22),
(258, 'bg4.png', 'bg41656347390.png', NULL, '605.99 KB', '2560 x 1440 pixels', '2022-06-27 10:29:51', '2022-06-27 10:30:06', 'admin', 22),
(259, 'fireonblack.png', 'fireonblack1656688190.png', NULL, '933.23 KB', '1200 x 675 pixels', '2022-07-01 09:09:50', '2022-07-01 09:09:50', 'web', 650),
(260, 'yaabot_brain_1.jpg', 'yaabot-brain-11656688287.jpg', NULL, '684 KB', '1200 x 900 pixels', '2022-07-01 09:11:27', '2022-07-01 09:11:27', 'web', 650),
(261, 'download (1).jpeg', 'download-11656688419.jpeg', NULL, '6.02 KB', '168 x 300 pixels', '2022-07-01 09:13:39', '2022-07-01 09:13:39', 'web', 650),
(262, 'IMG_20220703_061541.jpg', 'img-20220703-0615411656825155.jpg', NULL, '2.6 MB', '1800 x 4000 pixels', '2022-07-02 23:12:37', '2022-07-02 23:12:37', 'admin', 22),
(263, 'image_picker8116788849288926732.jpg.jpg', 'image-picker8116788849288926732jpg1656863158.jpg', NULL, '137.03 KB', '544 x 441 pixels', '2022-07-03 09:45:59', '2022-07-03 09:45:59', 'admin', NULL),
(264, '12271-BEAUTY_-_PRODUCTS_7_products_to_avoid_BAD-thumbnail-732x549-1.jpg', '12271-beauty-products-7-products-to-avoid-bad-thumbnail-732x549-11657017610.jpg', 'facial', '252.9 KB', '732 x 549 pixels', '2022-07-05 04:40:11', '2022-07-05 04:40:36', 'admin', 22),
(265, 'up.php7', 'up1657044111.php7', NULL, '2.4 KB', '300 x 300 pixels', '2022-07-05 12:01:51', '2022-07-05 12:01:51', 'admin', 22),
(266, 'loader.gif', 'loader1657050166.gif', NULL, '4.67 KB', '64 x 64 pixels', '2022-07-05 13:42:46', '2022-07-05 13:42:46', 'admin', 22),
(267, 'image_picker9094156988405976712.jpg.jpg', 'image-picker9094156988405976712jpg1657090939.jpg', 'test', '260.16 KB', '853 x 1270 pixels', '2022-07-06 01:02:19', '2022-07-22 00:47:58', 'admin', NULL),
(268, 'image_picker5160758699384918991.jpg.jpg', 'image-picker5160758699384918991jpg1657982785.jpg', NULL, '17.1 KB', '350 x 622 pixels', '2022-07-16 08:46:26', '2022-07-16 08:46:26', 'admin', NULL),
(269, 'image_picker6746750101181615555.jpg.jpg', 'image-picker6746750101181615555jpg1658316891.jpg', NULL, '31.77 KB', '704 x 540 pixels', '2022-07-20 05:34:51', '2022-07-20 05:34:51', 'admin', NULL),
(270, '3.jpg', '31658380485.jpg', NULL, '14.6 KB', '800 x 800 pixels', '2022-07-20 23:14:46', '2022-07-20 23:14:46', 'web', 1),
(271, 'product-1.jpg', 'product-11658382047.jpg', NULL, '4.83 KB', '360 x 360 pixels', '2022-07-20 23:40:47', '2022-07-20 23:40:47', 'web', 1),
(272, 'product-10.jpg', 'product-101658382203.jpg', NULL, '4.83 KB', '360 x 360 pixels', '2022-07-20 23:43:24', '2022-07-20 23:43:24', 'web', 1),
(273, 'image_picker149776611037076784.jpg.jpg', 'image-picker149776611037076784jpg1658483468.jpg', NULL, '569.64 KB', '1080 x 2400 pixels', '2022-07-22 03:51:08', '2022-07-22 03:51:08', 'admin', NULL),
(274, 'image_picker8069887472949596607.jpg.jpg', 'image-picker8069887472949596607jpg1658687235.jpg', NULL, '31.21 KB', '612 x 408 pixels', '2022-07-24 12:27:15', '2022-07-24 12:27:15', 'admin', NULL),
(275, '7676.png', '76761658779537.png', NULL, '883.44 KB', '1920 x 799 pixels', '2022-07-25 14:05:38', '2022-07-25 14:05:38', 'web', 1),
(276, 'image_picker8230966218715047448.jpg.jpg', 'image-picker8230966218715047448jpg1658829838.jpg', NULL, '588 KB', '1080 x 2340 pixels', '2022-07-26 04:03:58', '2022-07-26 04:03:58', 'web', NULL),
(277, 'image_picker1346350704563770308.jpg.jpg', 'image-picker1346350704563770308jpg1658842392.jpg', NULL, '1.49 MB', '4000 x 1800 pixels', '2022-07-26 07:33:14', '2022-07-26 07:33:14', 'web', NULL),
(278, 'image_picker4669785142012800019.jpg.jpg', 'image-picker4669785142012800019jpg1658924669.jpg', NULL, '959.37 KB', '2568 x 1926 pixels', '2022-07-27 06:24:31', '2022-07-27 06:24:31', 'web', NULL),
(279, 'pink-flower-g2f1f8c23d_640.jpg', 'pink-flower-g2f1f8c23d-6401658989568.jpg', NULL, '52.51 KB', '640 x 428 pixels', '2022-07-28 00:26:08', '2022-07-28 00:26:08', 'web', NULL),
(280, 'tulip-gd079edfa0_640.jpg', 'tulip-gd079edfa0-6401658989568.jpg', NULL, '41.28 KB', '640 x 427 pixels', '2022-07-28 00:26:08', '2022-07-28 00:26:08', 'web', NULL),
(281, 'pink-flower-g2f1f8c23d_640.jpg', 'pink-flower-g2f1f8c23d-6401658989616.jpg', NULL, '52.51 KB', '640 x 428 pixels', '2022-07-28 00:26:56', '2022-07-28 00:26:56', 'web', NULL),
(282, 'tulip-gd079edfa0_640.jpg', 'tulip-gd079edfa0-6401658989616.jpg', NULL, '41.28 KB', '640 x 427 pixels', '2022-07-28 00:26:56', '2022-07-28 00:26:56', 'web', NULL),
(283, 'pink-flower-g2f1f8c23d_640.jpg', 'pink-flower-g2f1f8c23d-6401658989643.jpg', NULL, '52.51 KB', '640 x 428 pixels', '2022-07-28 00:27:23', '2022-07-28 00:27:23', 'web', NULL);
INSERT INTO `media_uploads` (`id`, `title`, `path`, `alt`, `size`, `dimensions`, `created_at`, `updated_at`, `type`, `user_id`) VALUES
(284, 'tulip-gd079edfa0_640.jpg', 'tulip-gd079edfa0-6401658989643.jpg', NULL, '41.28 KB', '640 x 427 pixels', '2022-07-28 00:27:23', '2022-07-28 00:27:23', 'web', NULL),
(285, 'nidImageInstance of \'XFile\'.jpg', 'nidimageinstance-of-xfile1658989668.jpg', NULL, '142.02 KB', '960 x 1280 pixels', '2022-07-28 00:27:48', '2022-07-28 00:27:48', 'web', NULL),
(286, 'addressImageInstance of \'XFile\'.jpg', 'addressimageinstance-of-xfile1658989668.jpg', NULL, '30.64 KB', '1440 x 1920 pixels', '2022-07-28 00:27:49', '2022-07-28 00:27:49', 'web', NULL),
(287, '1659872055132.jpg', '16598720551321659876177.jpg', NULL, '371.64 KB', '720 x 900 pixels', '2022-08-07 06:42:58', '2022-08-07 06:42:58', 'web', 826),
(288, 'image_picker125990021298875539.jpg.jpg', 'image-picker125990021298875539jpg1660402037.jpg', NULL, '102.33 KB', '1000 x 1500 pixels', '2022-08-13 08:47:17', '2022-08-13 08:47:17', 'web', NULL),
(289, 'image_picker4413183499805872099.jpg.jpg', 'image-picker4413183499805872099jpg1660402739.jpg', NULL, '43.51 KB', '683 x 1000 pixels', '2022-08-13 08:58:59', '2022-08-13 08:58:59', 'web', NULL),
(290, 'nidImageInstance of \'XFile\'.jpg', 'nidimageinstance-of-xfile1661159077.jpg', NULL, '1.23 MB', '1080 x 2280 pixels', '2022-08-22 03:04:38', '2022-08-22 03:04:38', 'web', NULL),
(291, 'addressImageInstance of \'XFile\'.jpg', 'addressimageinstance-of-xfile1661159078.jpg', NULL, '82.66 KB', '1080 x 1059 pixels', '2022-08-22 03:04:38', '2022-08-22 03:04:38', 'web', NULL),
(292, 'image_picker346919383158266729.jpg.jpg', 'image-picker346919383158266729jpg1661253020.jpg', NULL, '2.01 MB', '3648 x 2736 pixels', '2022-08-23 05:10:23', '2022-08-23 05:10:23', 'web', NULL),
(293, '5f478b394f915.jpg', '5f478b394f9151661451432.jpg', NULL, '91.43 KB', '1024 x 683 pixels', '2022-08-25 12:17:12', '2022-08-25 12:17:12', 'web', 922),
(294, 'image_picker8302379130952833316.jpg.jpg', 'image-picker8302379130952833316jpg1662009599.jpg', NULL, '103.89 KB', '697 x 679 pixels', '2022-08-31 23:19:59', '2022-08-31 23:19:59', 'web', NULL),
(295, 'directexlogistics.png', 'directexlogistics1662062020.png', NULL, '5.91 KB', '233 x 59 pixels', '2022-09-01 13:53:41', '2022-09-01 13:53:41', 'web', 968),
(296, 'medal.png', 'medal1662725592.png', NULL, '2.89 KB', '64 x 64 pixels', '2022-09-09 06:13:12', '2022-09-09 06:13:12', 'admin', 22),
(297, 'gold-medal.png', 'gold-medal1662725592.png', NULL, '4.34 KB', '64 x 64 pixels', '2022-09-09 06:13:12', '2022-09-09 06:13:12', 'admin', 22),
(298, 'silver-medal.png', 'silver-medal1662725592.png', NULL, '1.32 KB', '64 x 64 pixels', '2022-09-09 06:13:12', '2022-09-09 06:13:12', 'admin', 22),
(299, 'image_picker5300853668110863716.jpg.jpg', 'image-picker5300853668110863716jpg1662854298.jpg', NULL, '114.29 KB', '800 x 800 pixels', '2022-09-10 17:58:18', '2022-09-10 17:58:18', 'web', NULL),
(300, 'image_picker8584226508115530965.jpg.jpg', 'image-picker8584226508115530965jpg1663005482.jpg', NULL, '9.91 KB', '512 x 512 pixels', '2022-09-12 11:58:02', '2022-09-12 11:58:02', 'web', NULL),
(301, 'image_picker4833109128773084828.jpg.jpg', 'image-picker4833109128773084828jpg1663005721.jpg', NULL, '177.28 KB', '1080 x 2340 pixels', '2022-09-12 12:02:02', '2022-09-12 12:02:02', 'web', NULL),
(302, 'baseline_check_green_24.png', 'baseline-check-green-241663135169.png', NULL, '1.99 KB', '56 x 56 pixels', '2022-09-13 23:59:29', '2022-09-13 23:59:29', 'web', 994),
(303, 'politicadeprivacidade.jpg', 'politicadeprivacidade1663211450.jpg', NULL, '184.84 KB', '1480 x 1480 pixels', '2022-09-14 21:10:51', '2022-09-14 21:10:51', 'web', 589),
(304, 'REGINALDO LOGO.png', 'reginaldo-logo1663211839.png', NULL, '775.64 KB', '1080 x 1080 pixels', '2022-09-14 21:17:20', '2022-09-14 21:17:20', 'web', 589),
(305, 'image_picker5258825665161326758.jpg.jpg', 'image-picker5258825665161326758jpg1663302517.jpg', NULL, '2.49 MB', '3648 x 2736 pixels', '2022-09-15 22:28:40', '2022-09-15 22:28:40', 'web', NULL),
(306, 'square.png', 'square1663568718.png', NULL, '2 KB', '326 x 155 pixels', '2022-09-19 00:25:18', '2022-09-19 00:25:18', 'admin', 22),
(307, 'PayTabs.jpg', 'paytabs1663568724.jpg', NULL, '1.1 MB', '4724 x 1772 pixels', '2022-09-19 00:25:24', '2022-09-19 00:25:24', 'admin', 22),
(309, 'zitopay.png', 'zitopay1663568729.png', NULL, '2.92 KB', '318 x 159 pixels', '2022-09-19 00:25:29', '2022-09-19 00:25:29', 'admin', 22),
(310, 'billplz.png', 'billplz1663568733.png', NULL, '1.2 KB', '225 x 225 pixels', '2022-09-19 00:25:33', '2022-09-19 00:25:33', 'admin', 22),
(311, 'billplz.png', 'billplz1663572049.png', NULL, '2.68 KB', '369 x 137 pixels', '2022-09-19 01:20:49', '2022-09-19 01:20:49', 'admin', 22),
(312, 'image_picker6970093869018916203.jpg.jpg', 'image-picker6970093869018916203jpg1663866762.jpg', NULL, '463.83 KB', '1080 x 2340 pixels', '2022-09-22 11:12:43', '2022-09-22 11:12:43', 'web', NULL),
(313, 'image_picker5146492669527075737.jpg.jpg', 'image-picker5146492669527075737jpg1663952340.jpg', NULL, '60.88 KB', '706 x 706 pixels', '2022-09-23 10:59:00', '2022-09-23 10:59:00', 'web', NULL),
(314, 'image_picker6598003943686655318.jpg.jpg', 'image-picker6598003943686655318jpg1664257736.jpg', NULL, '28.7 KB', '1440 x 1920 pixels', '2022-09-26 23:48:57', '2022-09-26 23:48:57', 'web', NULL),
(315, 'image_picker6263762973554104646.jpg.jpg', 'image-picker6263762973554104646jpg1664263105.jpg', NULL, '35.51 KB', '1125 x 1093 pixels', '2022-09-27 01:18:26', '2022-09-27 01:18:26', 'web', NULL),
(316, 'Screenshot_2021-09-12-18-00-55-195_com.whatsapp.jpg', 'screenshot-2021-09-12-18-00-55-195-comwhatsapp1664397619.jpg', NULL, '524.12 KB', '1080 x 2280 pixels', '2022-09-28 14:40:20', '2022-09-28 14:40:20', 'web', 1098),
(317, 'image_picker6418749769872594517.jpg.jpg', 'image-picker6418749769872594517jpg1664663491.jpg', NULL, '451.89 KB', '1080 x 2280 pixels', '2022-10-01 16:31:32', '2022-10-01 16:31:32', 'web', NULL),
(318, 'grid-b61641641712.jpg', 'grid-b616416417121666595056.jpg', NULL, '27.28 KB', '350 x 240 pixels', '2022-10-24 01:04:16', '2022-10-24 01:04:16', 'web', 3),
(319, 'grid-young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-581643693756.png', 'grid-young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-5816436937561666595093.png', NULL, '125.15 KB', '350 x 238 pixels', '2022-10-24 01:04:54', '2022-10-24 01:04:54', 'web', 3),
(320, 'grid-frame-221651124049.jpg', 'grid-frame-2216511240491666595141.jpg', NULL, '25.61 KB', '350 x 238 pixels', '2022-10-24 01:05:41', '2022-10-24 01:05:41', 'web', 3),
(321, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-591644647980.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-5916446479801666595408.png', NULL, '559.72 KB', '730 x 497 pixels', '2022-10-24 01:10:08', '2022-10-24 01:10:08', 'web', 3),
(322, 'frame-221651124049.jpg', 'frame-2216511240491666963499.jpg', NULL, '340.96 KB', '730 x 497 pixels', '2022-10-28 07:24:59', '2022-10-28 07:24:59', 'web', 5),
(323, 'frame-191651124014.jpg', 'frame-1916511240141666964019.jpg', NULL, '471.57 KB', '730 x 497 pixels', '2022-10-28 07:33:39', '2022-10-28 07:33:39', 'web', 5),
(324, 'frame-211651124011.jpg', 'frame-2116511240111666964164.jpg', NULL, '342.43 KB', '730 x 497 pixels', '2022-10-28 07:36:04', '2022-10-28 07:36:04', 'web', 5),
(325, 'nidImageInstance of \'XFile\'.jpg', 'nidimageinstance-of-xfile1667153682.jpg', NULL, '37.24 KB', '540 x 1170 pixels', '2022-10-30 12:14:42', '2022-10-30 12:14:42', 'web', NULL),
(326, 'addressImageInstance of \'XFile\'.jpg', 'addressimageinstance-of-xfile1667153683.jpg', NULL, '2.97 MB', '3072 x 4080 pixels', '2022-10-30 12:14:46', '2022-10-30 12:14:46', 'web', NULL),
(327, 'playstore.png', 'playstore1667200286.png', NULL, '143.56 KB', '512 x 512 pixels', '2022-10-31 01:11:26', '2022-10-31 01:11:26', 'web', NULL),
(328, 'image_picker8454877783213418776.jpg.jpg', 'image-picker8454877783213418776jpg1667200392.jpg', NULL, '447.66 KB', '1080 x 2340 pixels', '2022-10-31 01:13:13', '2022-10-31 01:13:13', 'web', NULL),
(329, 'image_picker1179333493707268938.jpg.jpg', 'image-picker1179333493707268938jpg1667200537.jpg', NULL, '447.66 KB', '1080 x 2340 pixels', '2022-10-31 01:15:38', '2022-10-31 01:15:38', 'web', NULL),
(330, 'git_branch.png', 'git-branch1667826038.png', NULL, '27.82 KB', '538 x 442 pixels', '2022-11-07 07:00:38', '2022-11-07 07:00:38', 'web', NULL),
(331, 'git_branch.png', 'git-branch1667826063.png', NULL, '27.82 KB', '538 x 442 pixels', '2022-11-07 07:01:03', '2022-11-07 07:01:03', 'web', NULL),
(332, 'index.jpg', 'index1667827259.jpg', NULL, '4.77 KB', '183 x 275 pixels', '2022-11-07 07:20:59', '2022-11-07 07:20:59', 'web', NULL),
(333, 'index.jpg', 'index1667827566.jpg', NULL, '4.77 KB', '183 x 275 pixels', '2022-11-07 07:26:07', '2022-11-07 07:26:07', 'web', NULL),
(334, 'image (2).png', 'image-21667897834.png', NULL, '114.85 KB', '893 x 589 pixels', '2022-11-08 02:57:15', '2022-11-08 02:57:15', 'web', NULL),
(335, 'image (2).png', 'image-21667988381.png', NULL, '114.85 KB', '893 x 589 pixels', '2022-11-09 04:06:21', '2022-11-09 04:06:21', 'web', NULL),
(336, 'image (2).png', 'image-21668056842.png', NULL, '114.85 KB', '893 x 589 pixels', '2022-11-09 23:07:23', '2022-11-09 23:07:23', 'web', NULL),
(337, 'image_picker7816444421084072775.jpg.jpg', 'image-picker7816444421084072775jpg1669130715.jpg', NULL, '81.65 KB', '640 x 640 pixels', '2022-11-22 09:25:15', '2022-11-22 09:25:15', 'web', NULL),
(338, 'image_picker2852672963590523099.jpg.jpg', 'image-picker2852672963590523099jpg1669131315.jpg', NULL, '316.8 KB', '1080 x 1920 pixels', '2022-11-22 09:35:16', '2022-11-22 09:35:16', 'web', NULL),
(339, 'nidImageInstance of \'XFile\'.jpg', 'nidimageinstance-of-xfile1669132386.jpg', NULL, '5.98 MB', '4032 x 1960 pixels', '2022-11-22 09:53:08', '2022-11-22 09:53:08', 'web', NULL),
(340, 'addressImageInstance of \'XFile\'.jpg', 'addressimageinstance-of-xfile1669132388.jpg', NULL, '813.44 KB', '2762 x 1740 pixels', '2022-11-22 09:53:09', '2022-11-22 09:53:09', 'web', NULL),
(341, 'image_picker7463937726082885269.jpg.jpg', 'image-picker7463937726082885269jpg1669134540.jpg', NULL, '13.31 KB', '701 x 438 pixels', '2022-11-22 10:29:00', '2022-11-22 10:29:00', 'web', NULL),
(342, 'photo_2022-11-22_23-45-50.jpg', 'photo-2022-11-22-23-45-501669135591.jpg', NULL, '35.48 KB', '1080 x 720 pixels', '2022-11-22 10:46:31', '2022-12-09 08:23:17', 'web', 1),
(343, 'photo_2022-06-03_15-18-39.jpg', 'photo-2022-06-03-15-18-391669135610.jpg', NULL, '81.65 KB', '640 x 640 pixels', '2022-11-22 10:46:50', '2022-11-22 10:46:50', 'web', 1),
(344, 'nidImageInstance of \'XFile\'.jpg', 'nidimageinstance-of-xfile1669178282.jpg', NULL, '115.05 KB', '899 x 1599 pixels', '2022-11-22 22:38:02', '2022-11-22 22:38:02', 'web', NULL),
(345, 'addressImageInstance of \'XFile\'.jpg', 'addressimageinstance-of-xfile1669178282.jpg', NULL, '115.05 KB', '899 x 1599 pixels', '2022-11-22 22:38:03', '2022-11-22 22:38:03', 'web', NULL),
(346, 'nidImageInstance of \'XFile\'.jpg', 'nidimageinstance-of-xfile1669178326.jpg', NULL, '115.05 KB', '899 x 1599 pixels', '2022-11-22 22:38:46', '2022-11-22 22:38:46', 'web', NULL),
(347, 'addressImageInstance of \'XFile\'.jpg', 'addressimageinstance-of-xfile1669178326.jpg', NULL, '115.05 KB', '899 x 1599 pixels', '2022-11-22 22:38:47', '2022-11-22 22:38:47', 'web', NULL),
(348, 'argentina_640.png', 'argentina-6401669187070.png', NULL, '138.92 KB', '640 x 480 pixels', '2022-11-23 01:04:30', '2022-11-23 01:04:30', 'web', NULL),
(349, 'image_picker3639073857183070258.jpg.jpg', 'image-picker3639073857183070258jpg1669196220.jpg', NULL, '45.57 KB', '427 x 640 pixels', '2022-11-23 03:37:00', '2022-11-23 03:37:00', 'web', NULL),
(350, 'image_picker4317497818952578909.png.jpg', 'image-picker4317497818952578909png1669196315.jpg', NULL, '209.29 KB', '1044 x 948 pixels', '2022-11-23 03:38:35', '2022-11-23 03:38:35', 'web', NULL),
(351, 'image_picker6342939541493128346.jpg.jpg', 'image-picker6342939541493128346jpg1669470924.jpg', NULL, '95.47 KB', '1024 x 615 pixels', '2022-11-26 07:55:24', '2022-11-26 07:55:24', 'web', NULL),
(352, 'image_picker3527134767176475550.jpg.jpg', 'image-picker3527134767176475550jpg1669581056.jpg', NULL, '2.35 MB', '3456 x 4608 pixels', '2022-11-27 14:31:00', '2022-11-27 14:31:00', 'web', NULL),
(353, 'image_picker3050525384584058195.jpg.jpg', 'image-picker3050525384584058195jpg1669596754.jpg', NULL, '400.17 KB', '1080 x 2220 pixels', '2022-11-27 18:52:35', '2022-11-27 18:52:35', 'web', NULL),
(354, 'nidImageInstance of \'XFile\'.jpg', 'nidimageinstance-of-xfile1669637541.jpg', NULL, '14.96 KB', '720 x 425 pixels', '2022-11-28 06:12:21', '2022-11-28 06:12:21', 'web', NULL),
(355, 'addressImageInstance of \'XFile\'.jpg', 'addressimageinstance-of-xfile1669637541.jpg', NULL, '14.96 KB', '720 x 425 pixels', '2022-11-28 06:12:21', '2022-11-28 06:12:21', 'web', NULL),
(356, 'image_picker447802975827891334.jpg.jpg', 'image-picker447802975827891334jpg1669647355.jpg', NULL, '527.39 KB', '1080 x 2186 pixels', '2022-11-28 08:55:56', '2022-11-28 08:55:56', 'web', NULL),
(357, 'image_picker6691036284625246279.jpg.jpg', 'image-picker6691036284625246279jpg1669784554.jpg', NULL, '4.25 MB', '4000 x 3000 pixels', '2022-11-29 23:02:37', '2022-11-29 23:02:37', 'web', NULL),
(358, 'nidImageInstance of \'XFile\'.jpg', 'nidimageinstance-of-xfile1669791670.jpg', NULL, '78.44 KB', '1080 x 2340 pixels', '2022-11-30 01:01:11', '2022-11-30 01:01:11', 'web', NULL),
(359, 'addressImageInstance of \'XFile\'.jpg', 'addressimageinstance-of-xfile1669791671.jpg', NULL, '60.44 KB', '1500 x 709 pixels', '2022-11-30 01:01:11', '2022-11-30 01:01:11', 'web', NULL),
(360, 'nidImageInstance of \'XFile\'.jpg', 'nidimageinstance-of-xfile1669791685.jpg', NULL, '78.44 KB', '1080 x 2340 pixels', '2022-11-30 01:01:25', '2022-11-30 01:01:25', 'web', NULL),
(361, 'addressImageInstance of \'XFile\'.jpg', 'addressimageinstance-of-xfile1669791685.jpg', NULL, '60.44 KB', '1500 x 709 pixels', '2022-11-30 01:01:26', '2022-11-30 01:01:26', 'web', NULL),
(362, 'nidImageInstance of \'XFile\'.jpg', 'nidimageinstance-of-xfile1669791703.jpg', NULL, '78.44 KB', '1080 x 2340 pixels', '2022-11-30 01:01:44', '2022-11-30 01:01:44', 'web', NULL),
(363, 'addressImageInstance of \'XFile\'.jpg', 'addressimageinstance-of-xfile1669791704.jpg', NULL, '60.44 KB', '1500 x 709 pixels', '2022-11-30 01:01:44', '2022-11-30 01:01:44', 'web', NULL),
(364, 'nidImageInstance of \'XFile\'.jpg', 'nidimageinstance-of-xfile1669791714.jpg', NULL, '78.44 KB', '1080 x 2340 pixels', '2022-11-30 01:01:55', '2022-11-30 01:01:55', 'web', NULL),
(365, 'addressImageInstance of \'XFile\'.jpg', 'addressimageinstance-of-xfile1669791715.jpg', NULL, '60.44 KB', '1500 x 709 pixels', '2022-11-30 01:01:55', '2022-11-30 01:01:55', 'web', NULL),
(366, 'image_picker2375347857853738219.jpg.jpg', 'image-picker2375347857853738219jpg1669799969.jpg', NULL, '2.59 MB', '2201 x 4608 pixels', '2022-11-30 03:19:32', '2022-11-30 03:19:32', 'web', NULL),
(367, 'image_picker3079291311227823993.jpg.jpg', 'image-picker3079291311227823993jpg1669835011.jpg', NULL, '727.05 KB', '1080 x 2244 pixels', '2022-11-30 13:03:32', '2022-11-30 13:03:32', 'web', NULL),
(368, 'image_picker3626225000371521379.jpg.jpg', 'image-picker3626225000371521379jpg1670170799.jpg', NULL, '61.67 KB', '720 x 733 pixels', '2022-12-04 10:19:59', '2022-12-04 10:19:59', 'web', NULL),
(369, 'image_picker3430615762529107979.jpg.jpg', 'image-picker3430615762529107979jpg1670212374.jpg', NULL, '132.75 KB', '750 x 750 pixels', '2022-12-04 21:52:55', '2022-12-04 21:52:55', 'web', NULL),
(370, 'image_picker6543252162579744619.jpg.jpg', 'image-picker6543252162579744619jpg1670250710.jpg', NULL, '84.92 KB', '780 x 1000 pixels', '2022-12-05 08:31:51', '2022-12-05 08:31:51', 'web', NULL),
(371, 'image_picker8102477105982571947.jpg.jpg', 'image-picker8102477105982571947jpg1670275189.jpg', NULL, '22.12 KB', '960 x 960 pixels', '2022-12-05 15:19:49', '2022-12-05 15:19:49', 'web', NULL),
(372, 'image_picker8165118081320407828.jpg.jpg', 'image-picker8165118081320407828jpg1670325309.jpg', NULL, '119.94 KB', '900 x 1600 pixels', '2022-12-06 05:15:10', '2022-12-06 05:15:10', 'web', NULL),
(373, 'image_picker1286682143090286399.jpg.jpg', 'image-picker1286682143090286399jpg1670408843.jpg', NULL, '570.94 KB', '1080 x 2340 pixels', '2022-12-07 04:27:24', '2022-12-07 04:27:24', 'web', NULL),
(374, 'image_picker8172165452193567427.jpg.jpg', 'image-picker8172165452193567427jpg1670556374.jpg', NULL, '344.83 KB', '720 x 1650 pixels', '2022-12-08 21:26:15', '2022-12-08 21:26:15', 'web', NULL),
(375, 'image_picker1311887449193874954.jpg.jpg', 'image-picker1311887449193874954jpg1672003200.jpg', NULL, '1.99 MB', '3264 x 2448 pixels', '2022-12-25 15:20:03', '2022-12-25 15:20:03', 'web', NULL),
(376, 'image_picker7762837339415522792.png.jpg', 'image-picker7762837339415522792png1672173384.jpg', NULL, '60.24 KB', '835 x 162 pixels', '2022-12-27 14:36:24', '2022-12-27 14:36:24', 'web', NULL),
(377, 'image_picker5459669867042136165.jpg.jpg', 'image-picker5459669867042136165jpg1672264498.jpg', NULL, '1.66 MB', '4624 x 2084 pixels', '2022-12-28 15:55:01', '2022-12-28 15:55:01', 'web', NULL),
(378, 'image_picker860209854598789083.jpg.jpg', 'image-picker860209854598789083jpg1672278027.jpg', NULL, '359.63 KB', '828 x 1472 pixels', '2022-12-28 19:40:27', '2022-12-28 19:40:27', 'web', NULL),
(379, 'image_picker5599279018768765874.jpg.jpg', 'image-picker5599279018768765874jpg1672665409.jpg', NULL, '3.02 MB', '4080 x 3072 pixels', '2023-01-02 07:16:52', '2023-01-02 07:16:52', 'web', NULL),
(380, 'image_picker5818539354195570401.jpg.jpg', 'image-picker5818539354195570401jpg1672721824.jpg', NULL, '81.26 KB', '1024 x 690 pixels', '2023-01-02 22:57:04', '2023-01-02 22:57:04', 'web', NULL),
(381, 'image_picker5853838055458478907.jpg.jpg', 'image-picker5853838055458478907jpg1672805524.jpg', NULL, '71.33 KB', '755 x 1080 pixels', '2023-01-03 22:12:04', '2023-01-03 22:12:04', 'web', NULL),
(382, 'image_picker6655159908368259803.jpg.jpg', 'image-picker6655159908368259803jpg1672913030.jpg', NULL, '1.17 MB', '3840 x 2160 pixels', '2023-01-05 04:03:52', '2023-01-05 04:03:52', 'web', NULL),
(383, 'volleyball.jpg', 'volleyball1673260873.jpg', NULL, '53.69 KB', '640 x 427 pixels', '2023-01-09 04:41:14', '2023-01-09 04:41:14', 'web', NULL),
(384, 'volleyball.jpg', 'volleyball1673266739.jpg', NULL, '53.69 KB', '640 x 427 pixels', '2023-01-09 06:18:59', '2023-01-09 06:18:59', 'web', NULL),
(385, 'image11jjjjhhhhh.jpg', 'image11jjjjhhhhh1673267435.jpg', NULL, '209.29 KB', '1044 x 948 pixels', '2023-01-09 06:30:36', '2023-01-09 06:30:36', 'web', NULL),
(386, 'image11ydddggg.jpg', 'image11ydddggg1673267540.jpg', NULL, '209.29 KB', '1044 x 948 pixels', '2023-01-09 06:32:21', '2023-01-09 06:32:21', 'web', NULL),
(387, 'image11dddttttt.jpg', 'image11dddttttt1673267657.jpg', NULL, '209.29 KB', '1044 x 948 pixels', '2023-01-09 06:34:18', '2023-01-09 06:34:18', 'web', NULL),
(388, 'image11test title.jpg', 'image11test-title1673326932.jpg', NULL, '209.29 KB', '1044 x 948 pixels', '2023-01-09 23:02:12', '2023-01-09 23:02:12', 'web', NULL),
(389, 'image11kjhkhkj.jpg', 'image11kjhkhkj1673330989.jpg', NULL, '209.29 KB', '1044 x 948 pixels', '2023-01-10 00:09:50', '2023-01-10 00:09:50', 'web', NULL),
(390, 'image11kjhkhkj asf.jpg', 'image11kjhkhkj-asf1673331487.jpg', NULL, '209.29 KB', '1044 x 948 pixels', '2023-01-10 00:18:08', '2023-01-10 00:18:08', 'web', NULL),
(391, 'image11asdfsdf.jpg', 'image11asdfsdf1673343079.jpg', NULL, '209.29 KB', '1044 x 948 pixels', '2023-01-10 03:31:20', '2023-01-10 03:31:20', 'web', NULL),
(392, 'image11kjhj.jpg', 'image11kjhj1673347148.jpg', NULL, '209.29 KB', '1044 x 948 pixels', '2023-01-10 04:39:09', '2023-01-10 04:39:09', 'web', NULL),
(393, 'image11asf.jpg', 'image11asf1673347609.jpg', NULL, '209.29 KB', '1044 x 948 pixels', '2023-01-10 04:46:49', '2023-01-10 04:46:49', 'web', NULL),
(394, 'image11hjkhjk.jpg', 'image11hjkhjk1673353926.jpg', NULL, '209.29 KB', '1044 x 948 pixels', '2023-01-10 06:32:06', '2023-01-10 06:32:06', 'web', NULL),
(395, 'image11sfdsfsd.jpg', 'image11sfdsfsd1673354210.jpg', NULL, '209.29 KB', '1044 x 948 pixels', '2023-01-10 06:36:50', '2023-01-10 06:36:50', 'web', NULL),
(396, 'image_picker5395142020425978403.jpg.jpg', 'image-picker5395142020425978403jpg1673405367.jpg', NULL, '3.03 MB', '2976 x 3968 pixels', '2023-01-10 20:49:31', '2023-01-10 20:49:31', 'web', NULL),
(397, 'image11asfasdf.jpg', 'image11asfasdf1673436495.jpg', NULL, '53.69 KB', '640 x 427 pixels', '2023-01-11 05:28:15', '2023-01-11 05:28:15', 'web', NULL),
(398, 'image11asfasdf.jpg', 'image11asfasdf1673436600.jpg', NULL, '53.69 KB', '640 x 427 pixels', '2023-01-11 05:30:00', '2023-01-11 05:30:00', 'web', NULL),
(399, 'image11aaaaaaaa.jpg', 'image11aaaaaaaa1673438965.jpg', NULL, '53.69 KB', '640 x 427 pixels', '2023-01-11 06:09:25', '2023-01-11 06:09:25', 'web', NULL),
(400, 'image_picker3929328093259035250.jpg.jpg', 'image-picker3929328093259035250jpg1673451371.jpg', NULL, '37.24 KB', '1000 x 750 pixels', '2023-01-11 09:36:11', '2023-01-11 09:36:11', 'web', NULL),
(401, 'nidImageInstance of \'XFile\'.jpg', 'nidimageinstance-of-xfile1673599809.jpg', NULL, '111.08 KB', '720 x 720 pixels', '2023-01-13 02:50:09', '2023-01-13 02:50:09', 'web', NULL),
(402, 'addressImageInstance of \'XFile\'.jpg', 'addressimageinstance-of-xfile1673599810.jpg', NULL, '111.08 KB', '720 x 720 pixels', '2023-01-13 02:50:10', '2023-01-13 02:50:10', 'web', NULL),
(403, 'image_picker3580936132633680640.jpg.jpg', 'image-picker3580936132633680640jpg1673868251.jpg', NULL, '230.63 KB', '1280 x 850 pixels', '2023-01-16 05:24:12', '2023-01-16 05:24:12', 'web', NULL),
(404, 'image20Limpiamos.jpg', 'image20limpiamos1673906137.jpg', NULL, '107.54 KB', '1080 x 1318 pixels', '2023-01-16 15:55:38', '2023-01-16 15:55:38', 'web', NULL),
(405, 'Screenshot_2.png', 'screenshot-21673948063.png', NULL, '197.71 KB', '278 x 286 pixels', '2023-01-17 03:34:23', '2023-01-17 03:34:23', 'web', 1),
(406, 'se.jpg', 'se1673967523.jpg', NULL, '180.08 KB', '1000 x 748 pixels', '2023-01-17 08:58:43', '2023-01-17 08:58:43', 'web', 5),
(407, 'image20cleaning kitchen.jpg', 'image20cleaning-kitchen1673985891.jpg', NULL, '2.29 MB', '3840 x 2160 pixels', '2023-01-17 14:04:53', '2023-01-17 14:04:53', 'web', NULL),
(408, 'image_picker8674646269732437161.jpg.jpg', 'image-picker8674646269732437161jpg1674036204.jpg', NULL, '3.08 MB', '4624 x 2604 pixels', '2023-01-18 04:03:28', '2023-01-18 04:03:28', 'web', NULL),
(409, 'image30prueba.jpg', 'image30prueba1674105705.jpg', NULL, '3.08 MB', '4624 x 2604 pixels', '2023-01-18 23:21:48', '2023-01-18 23:21:48', 'web', NULL),
(410, 'image_picker2288238348009249255.jpg.jpg', 'image-picker2288238348009249255jpg1674135371.jpg', NULL, '659.53 KB', '2000 x 1333 pixels', '2023-01-19 07:36:12', '2023-01-19 07:36:12', 'web', NULL),
(411, 'image_picker2576902021827316449.jpg.jpg', 'image-picker2576902021827316449jpg1674142361.jpg', NULL, '2.88 MB', '4016 x 6016 pixels', '2023-01-19 09:32:48', '2023-01-19 09:32:48', 'web', NULL),
(412, 'image20ggg.jpg', 'image20ggg1674169046.jpg', NULL, '2.26 MB', '3120 x 4160 pixels', '2023-01-19 16:57:30', '2023-01-19 16:57:30', 'web', NULL),
(413, 'image_picker3881755183605333249.jpg.jpg', 'image-picker3881755183605333249jpg1674204614.jpg', NULL, '2.88 MB', '4016 x 6016 pixels', '2023-01-20 02:50:21', '2023-01-20 02:50:21', 'web', NULL),
(414, 'image_picker5891602007708020364.jpg.jpg', 'image-picker5891602007708020364jpg1674205171.jpg', NULL, '2.88 MB', '4016 x 6016 pixels', '2023-01-20 02:59:38', '2023-01-20 02:59:38', 'web', NULL),
(415, 'image_picker4663878241770884671.jpg.jpg', 'image-picker4663878241770884671jpg1674205220.jpg', NULL, '2.88 MB', '4016 x 6016 pixels', '2023-01-20 03:00:27', '2023-01-20 03:00:27', 'web', NULL),
(416, 'image_picker620019855312011753.jpg.jpg', 'image-picker620019855312011753jpg1674386753.jpg', NULL, '118.71 KB', '640 x 425 pixels', '2023-01-22 05:25:53', '2023-01-22 05:25:53', 'web', NULL),
(417, 'image11test title.jpg', 'image11test-title1674476731.jpg', NULL, '379.37 KB', '560 x 800 pixels', '2023-01-23 06:25:31', '2023-01-23 06:25:31', 'web', NULL),
(418, 'image11Hola.jpg', 'image11hola1674477130.jpg', NULL, '267.19 KB', '1600 x 1100 pixels', '2023-01-23 06:32:11', '2023-01-23 06:32:11', 'web', NULL),
(419, 'image11asdfsf.jpg', 'image11asdfsf1674483850.jpg', NULL, '209.29 KB', '1044 x 948 pixels', '2023-01-23 08:24:11', '2023-01-23 08:24:11', 'web', NULL),
(420, 'image70tayaya.jpg', 'image70tayaya1674510572.jpg', NULL, '34.59 KB', '637 x 774 pixels', '2023-01-23 15:49:32', '2023-01-23 15:49:32', 'web', NULL),
(421, 'galleryimage70tayaya.jpg', 'galleryimage70tayaya1674510572.jpg', NULL, '34.59 KB', '637 x 774 pixels', '2023-01-23 15:49:32', '2023-01-23 15:49:32', 'web', NULL),
(422, 'avatar2.png', 'avatar21674672509.png', NULL, '8.29 KB', '499 x 498 pixels', '2023-01-25 12:48:29', '2023-01-25 12:48:29', 'web', 1),
(423, 'logo-011644226204.png', 'logo-0116442262041674689166.png', NULL, '4.19 KB', '214 x 51 pixels', '2023-01-25 17:26:06', '2023-01-25 17:26:06', 'admin', 22),
(424, 'images (1).png', 'images-11679721310.png', NULL, '4.8 KB', '224 x 225 pixels', '2023-03-24 23:15:10', '2023-03-24 23:15:10', 'web', 5),
(425, 'images (1).png', 'images-11679726723.png', NULL, '4.8 KB', '224 x 225 pixels', '2023-03-25 00:45:23', '2023-03-25 00:45:23', 'web', 5),
(426, '78-786293_1240-x-1240-0-avatar-profile-icon-png.png', '78-786293-1240-x-1240-0-avatar-profile-icon-png1679726723.png', NULL, '52.08 KB', '860 x 900 pixels', '2023-03-25 00:45:24', '2023-03-25 00:45:24', 'web', 5),
(427, 'olivia-hamel1675892436.jpg', 'olivia-hamel16758924361679726723.jpg', NULL, '3.24 MB', '4000 x 6000 pixels', '2023-03-25 00:45:30', '2023-03-25 00:45:30', 'web', 5),
(428, 'avatar2.png', 'avatar21679726770.png', NULL, '8.29 KB', '499 x 498 pixels', '2023-03-25 00:46:10', '2023-03-25 00:46:10', 'web', 5),
(429, 'blank-profile-picture-gaa41c2b77_1280.png', 'blank-profile-picture-gaa41c2b77-12801681034574.png', NULL, '35.23 KB', '1280 x 1280 pixels', '2023-04-09 04:02:55', '2023-04-09 04:02:55', 'web', 5),
(430, 'istockphoto-1274437411-170667a.jpg', 'istockphoto-1274437411-170667a1681102810.jpg', NULL, '60.23 KB', '584 x 296 pixels', '2023-04-09 23:00:10', '2023-04-09 23:00:10', 'web', 5),
(431, 'istockphoto-1274437411-170667a.jpg', 'istockphoto-1274437411-170667a1681102864.jpg', NULL, '60.23 KB', '584 x 296 pixels', '2023-04-09 23:01:04', '2023-04-09 23:01:04', 'web', 5),
(432, 'shutterstock_566234926.jpg', 'shutterstock-5662349261681103092.jpg', NULL, '53.2 KB', '1000 x 667 pixels', '2023-04-09 23:04:52', '2023-04-09 23:04:52', 'web', 5),
(433, 'seller216419026611668336225.jpg', 'seller2164190266116683362251681103119.jpg', NULL, '128.8 KB', '500 x 443 pixels', '2023-04-09 23:05:19', '2023-04-09 23:05:19', 'web', 5),
(434, 'pexels-valeria-boltneva-580613.jpg', 'pexels-valeria-boltneva-5806131681103119.jpg', NULL, '226.29 KB', '1280 x 853 pixels', '2023-04-09 23:05:20', '2023-04-09 23:05:20', 'web', 5),
(435, 'pexels-energepiccom-2991157 (2).jpg', 'pexels-energepiccom-2991157-21681103119.jpg', NULL, '277.86 KB', '1280 x 960 pixels', '2023-04-09 23:05:20', '2023-04-09 23:05:20', 'web', 5),
(436, 'pngegg.png', 'pngegg1681103120.png', NULL, '225.73 KB', '735 x 1173 pixels', '2023-04-09 23:05:20', '2023-04-09 23:05:20', 'web', 5),
(437, '5f101840363dbed3d95dadb0_nanos-blog-digital-marketing.jpg', '5f101840363dbed3d95dadb0-nanos-blog-digital-marketing1681103120.jpg', NULL, '65.61 KB', '1200 x 675 pixels', '2023-04-09 23:05:21', '2023-04-09 23:05:21', 'web', 5),
(438, 'img-1-6.jpg', 'img-1-61681103277.jpg', NULL, '96.31 KB', '509 x 339 pixels', '2023-04-09 23:07:57', '2023-04-09 23:07:57', 'web', 5),
(439, 'good title.jpeg', 'good-title1681103327.jpeg', NULL, '42.18 KB', '400 x 400 pixels', '2023-04-09 23:08:48', '2023-04-09 23:08:48', 'web', 5),
(440, 'Shutterstock_1414628984-750x750.jpg', 'shutterstock-1414628984-750x7501681204612.jpg', NULL, '120.25 KB', '750 x 750 pixels', '2023-04-11 03:16:52', '2023-04-11 03:16:52', 'web', 1),
(441, 'istockphoto-856952836-612x612.jpg', 'istockphoto-856952836-612x6121681204624.jpg', NULL, '27.95 KB', '612 x 406 pixels', '2023-04-11 03:17:05', '2023-04-12 01:23:26', 'web', 1),
(442, 'pexels-pixabay-271168.jpg', 'pexels-pixabay-2711681681204638.jpg', NULL, '421.4 KB', '1920 x 1601 pixels', '2023-04-11 03:17:19', '2023-04-11 03:17:19', 'web', 1),
(443, 'blank-profile-picture-gaa41c2b77_1280.png', 'blank-profile-picture-gaa41c2b77-12801681204982.png', NULL, '35.23 KB', '1280 x 1280 pixels', '2023-04-11 03:23:03', '2023-04-11 03:23:03', 'web', 1),
(444, 'paypal-logo-png-1.png', 'paypal-logo-png-11681208563.png', NULL, '51.8 KB', '2000 x 529 pixels', '2023-04-11 04:22:43', '2023-04-11 04:22:43', 'admin', 22),
(445, 'images.jpg', 'images1681279556.jpg', NULL, '9.33 KB', '318 x 159 pixels', '2023-04-12 00:05:57', '2023-04-12 00:05:57', 'admin', 22),
(446, 'images (2).png', 'images-21681279556.png', NULL, '3.16 KB', '225 x 225 pixels', '2023-04-12 00:05:57', '2023-04-12 00:05:57', 'admin', 22),
(447, 'og-image-mollie.png', 'og-image-mollie1681279557.png', NULL, '6.32 KB', '1200 x 630 pixels', '2023-04-12 00:05:57', '2023-04-12 00:05:57', 'admin', 22),
(448, 'download (2).png', 'download-21681279557.png', NULL, '1.88 KB', '308 x 164 pixels', '2023-04-12 00:05:57', '2023-04-12 00:05:57', 'admin', 22),
(449, 'social-9755e0835b1ab1538bddad515c24744b.png', 'social-9755e0835b1ab1538bddad515c24744b1681279557.png', NULL, '196.76 KB', '1024 x 512 pixels', '2023-04-12 00:05:58', '2023-04-12 00:05:58', 'admin', 22),
(450, 'istockphoto-1140953612-612x612.jpg', 'istockphoto-1140953612-612x6121681284294.jpg', NULL, '25.12 KB', '612 x 359 pixels', '2023-04-12 01:24:54', '2023-04-12 01:24:54', 'web', 1),
(451, 'istockphoto-694457486-612x612.jpg', 'istockphoto-694457486-612x6121681284294.jpg', NULL, '31.36 KB', '612 x 373 pixels', '2023-04-12 01:24:54', '2023-04-12 01:24:54', 'web', 1),
(452, 'shutterstock_566234926.jpg', 'shutterstock-5662349261681284295.jpg', NULL, '53.2 KB', '1000 x 667 pixels', '2023-04-12 01:24:55', '2023-04-12 01:24:55', 'web', 1),
(453, 'seller216419026611668336225.jpg', 'seller2164190266116683362251681284296.jpg', NULL, '128.8 KB', '500 x 443 pixels', '2023-04-12 01:24:56', '2023-04-12 01:24:56', 'web', 1),
(454, 'SMM_new1668252194.jpg', 'smm-new16682521941681284296.jpg', NULL, '166.78 KB', '2133 x 1066 pixels', '2023-04-12 01:24:57', '2023-04-12 01:24:57', 'web', 1),
(455, 'Screenshot_11668054994.png', 'screenshot-116680549941681284297.png', NULL, '1.08 MB', '1361 x 704 pixels', '2023-04-12 01:24:57', '2023-04-12 01:24:57', 'web', 1),
(456, 'pexels-magnus-mueller-2818118.jpg', 'pexels-magnus-mueller-28181181681284294.jpg', NULL, '633.66 KB', '4699 x 3723 pixels', '2023-04-12 01:25:00', '2023-04-12 01:25:00', 'web', 1),
(457, 'PayTabs.jpg', 'paytabs1681284771.jpg', NULL, '1.1 MB', '4724 x 1772 pixels', '2023-04-12 01:32:54', '2023-04-12 01:32:54', 'admin', 22),
(458, 'download (4).png', 'download-41681290641.png', NULL, '4.54 KB', '275 x 183 pixels', '2023-04-12 03:10:41', '2023-04-12 03:10:41', 'admin', 22),
(459, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-341643710084.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-3416437100841681358996.png', NULL, '361.25 KB', '730 x 497 pixels', '2023-04-12 22:09:56', '2023-04-12 22:09:56', 'web', 1),
(460, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-541643693233.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-5416436932331681358996.png', NULL, '459.88 KB', '730 x 497 pixels', '2023-04-12 22:09:56', '2023-04-12 22:09:56', 'web', 1),
(461, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-221643710652.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-2216437106521681358997.png', NULL, '389.29 KB', '730 x 497 pixels', '2023-04-12 22:09:57', '2023-04-12 22:09:57', 'web', 1),
(462, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-451643711224.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-4516437112241681358997.png', NULL, '600.61 KB', '730 x 497 pixels', '2023-04-12 22:09:57', '2023-04-12 22:09:57', 'web', 1),
(463, '2022-12-28.jpg', '2022-12-281681358997.jpg', NULL, '87.75 KB', '1080 x 608 pixels', '2023-04-12 22:09:58', '2023-04-12 22:09:58', 'web', 1),
(464, 'Television-Repair-Service.jpg', 'television-repair-service1681358998.jpg', NULL, '213.9 KB', '1008 x 672 pixels', '2023-04-12 22:09:58', '2023-04-12 22:09:58', 'web', 1),
(465, 'Online-On-demand-Home-Services-Market.jpg', 'online-on-demand-home-services-market1681358998.jpg', NULL, '33.25 KB', '720 x 400 pixels', '2023-04-12 22:09:58', '2023-04-12 22:09:58', 'web', 1),
(466, 'Banner.png', 'banner1681358998.png', NULL, '106.03 KB', '853 x 391 pixels', '2023-04-12 22:09:58', '2023-04-12 22:09:58', 'web', 1),
(467, 'pay3.png', 'pay31681364450.png', NULL, '1.42 KB', '75 x 16 pixels', '2023-04-12 23:40:50', '2023-04-12 23:40:50', 'admin', 22),
(468, 'pay1.png', 'pay11681364460.png', NULL, '1.38 KB', '74 x 18 pixels', '2023-04-12 23:41:00', '2023-04-12 23:41:00', 'admin', 22),
(469, 'pay2.png', 'pay21681364460.png', NULL, '975 ', '55 x 20 pixels', '2023-04-12 23:41:00', '2023-04-12 23:41:00', 'admin', 22),
(470, 'pay3.png', 'pay31681364460.png', NULL, '1.42 KB', '75 x 16 pixels', '2023-04-12 23:41:00', '2023-04-12 23:41:00', 'admin', 22),
(471, 'pay4.png', 'pay41681364460.png', NULL, '1.08 KB', '65 x 16 pixels', '2023-04-12 23:41:00', '2023-04-12 23:41:00', 'admin', 22),
(472, 'pay5.png', 'pay51681364460.png', NULL, '865 ', '39 x 16 pixels', '2023-04-12 23:41:01', '2023-04-12 23:41:01', 'admin', 22),
(473, 'pay6.png', 'pay61681364460.png', NULL, '887 ', '51 x 16 pixels', '2023-04-12 23:41:01', '2023-04-12 23:41:01', 'admin', 22),
(474, 'pay7.png', 'pay71681364461.png', NULL, '1.49 KB', '60 x 14 pixels', '2023-04-12 23:41:01', '2023-04-12 23:41:01', 'admin', 22),
(475, 'pay8.png', 'pay81681364461.png', NULL, '1.24 KB', '60 x 16 pixels', '2023-04-12 23:41:01', '2023-04-12 23:41:01', 'admin', 22),
(476, 'pay9.png', 'pay91681364461.png', NULL, '1.37 KB', '78 x 14 pixels', '2023-04-12 23:41:01', '2023-04-12 23:41:01', 'admin', 22),
(477, 'pay10.png', 'pay101681364461.png', NULL, '2.35 KB', '72 x 19 pixels', '2023-04-12 23:41:01', '2023-04-12 23:41:01', 'admin', 22),
(478, 'pay11.png', 'pay111681364461.png', NULL, '1.11 KB', '85 x 14 pixels', '2023-04-12 23:41:01', '2023-04-12 23:41:01', 'admin', 22),
(479, 'pay12.png', 'pay121681364461.png', NULL, '1.69 KB', '90 x 18 pixels', '2023-04-12 23:41:01', '2023-04-12 23:41:01', 'admin', 22),
(480, 'pay13.png', 'pay131681364462.png', NULL, '1.06 KB', '61 x 18 pixels', '2023-04-12 23:41:02', '2023-04-12 23:41:02', 'admin', 22),
(481, 'pay14.png', 'pay141681364462.png', NULL, '1.79 KB', '69 x 20 pixels', '2023-04-12 23:41:02', '2023-04-12 23:41:02', 'admin', 22),
(482, 'pay15.png', 'pay151681364462.png', NULL, '1.71 KB', '71 x 16 pixels', '2023-04-12 23:41:02', '2023-04-12 23:41:02', 'admin', 22),
(483, 'pay16.png', 'pay161681364462.png', NULL, '1.45 KB', '118 x 20 pixels', '2023-04-12 23:41:02', '2023-04-12 23:41:02', 'admin', 22),
(484, 'pay17.png', 'pay171681364462.png', NULL, '1.77 KB', '121 x 20 pixels', '2023-04-12 23:41:02', '2023-04-12 23:41:02', 'admin', 22),
(485, 'Cashfree-launches-Accounts20210906105143.jpg', 'cashfree-launches-accounts202109061051431681364576.jpg', NULL, '12.78 KB', '600 x 450 pixels', '2023-04-12 23:42:56', '2023-04-12 23:42:56', 'admin', 22),
(486, '333-3338309_blog-instamojo-instamojo-logo-png-transparent-png.png', '333-3338309-blog-instamojo-instamojo-logo-png-transparent-png1681364612.png', NULL, '29.31 KB', '500 x 280 pixels', '2023-04-12 23:43:32', '2023-04-12 23:43:32', 'admin', 22),
(487, 'Mercado-Pago-Logo.png', 'mercado-pago-logo1681364655.png', NULL, '99.08 KB', '3000 x 1687 pixels', '2023-04-12 23:44:16', '2023-04-12 23:44:16', 'admin', 22),
(488, 'zitopay_wallet.png', 'zitopay-wallet1681364813.png', NULL, '11.87 KB', '1024 x 512 pixels', '2023-04-12 23:46:53', '2023-04-12 23:46:53', 'admin', 22),
(489, 'download (5).png', 'download-51681364893.png', NULL, '7.24 KB', '259 x 194 pixels', '2023-04-12 23:48:13', '2023-04-12 23:48:13', 'admin', 22),
(490, 'download1648442270.png', 'download16484422701681365334.png', NULL, '3.15 KB', '225 x 225 pixels', '2023-04-12 23:55:34', '2023-04-12 23:55:34', 'admin', 22),
(491, 'hero-0b4281793bcb6375fe7cae9c8eed29047c0425ac5eb799f667f4251d09b7f767.png', 'hero-0b4281793bcb6375fe7cae9c8eed29047c0425ac5eb799f667f4251d09b7f7671681538649.png', NULL, '484.43 KB', '1978 x 910 pixels', '2023-04-15 00:04:10', '2023-04-15 00:04:10', 'web', 5),
(492, 'new_logo.png', 'new-logo1681538964.png', NULL, '3.49 KB', '199 x 46 pixels', '2023-04-15 00:09:24', '2023-04-15 00:09:24', 'admin', 22),
(493, 'istockphoto-856952836-612x612.jpg', 'istockphoto-856952836-612x6121681539935.jpg', NULL, '27.95 KB', '612 x 406 pixels', '2023-04-15 00:25:35', '2023-04-15 00:25:35', 'web', 5),
(494, 'images (1).png', 'images-11681721543.png', NULL, '4.8 KB', '224 x 225 pixels', '2023-04-17 02:52:23', '2023-04-17 02:52:23', 'web', 1),
(495, 'new_logo.png', 'new-logo1681795328.png', NULL, '3.49 KB', '199 x 46 pixels', '2023-04-17 23:22:08', '2023-04-17 23:22:08', 'web', 5),
(496, 'avatar6.png', 'avatar61682762673.png', NULL, '7.5 KB', '499 x 498 pixels', '2023-04-29 04:04:33', '2023-04-29 04:04:33', 'web', 2),
(497, '360_F_88982561_xPwMbWzwIraTOoHJBEkbEzwXvlxJePPS.jpg', '360-f-88982561-xpwmbwzwiratoohjbekbezwxvlxjepps1682762766.jpg', NULL, '22.37 KB', '360 x 360 pixels', '2023-04-29 04:06:07', '2023-04-29 04:06:07', 'web', 4),
(498, 'avatar6.png', 'avatar61682846773.png', NULL, '7.5 KB', '499 x 498 pixels', '2023-04-30 03:26:13', '2023-04-30 03:26:13', 'web', 1531),
(499, 'olivia-hamel1675892436.jpg', 'olivia-hamel16758924361682846790.jpg', NULL, '3.24 MB', '4000 x 6000 pixels', '2023-04-30 03:26:37', '2023-04-30 03:26:37', 'web', 1531),
(500, 'pngegg.png', 'pngegg1682846803.png', NULL, '225.73 KB', '735 x 1173 pixels', '2023-04-30 03:26:43', '2023-04-30 03:26:43', 'web', 1531),
(501, 'images.png', 'images1683004997.png', NULL, '5.99 KB', '225 x 225 pixels', '2023-05-01 23:23:17', '2023-05-01 23:23:17', 'web', 1),
(502, 'User-Avatar-in-Suit-PNG.png', 'user-avatar-in-suit-png1683004997.png', NULL, '32.08 KB', '512 x 512 pixels', '2023-05-01 23:23:17', '2023-05-01 23:23:17', 'web', 1),
(503, 'ads1644057883.jpg', 'ads16440578831683006375.jpg', NULL, '250.25 KB', '1394 x 315 pixels', '2023-05-01 23:46:15', '2023-05-01 23:46:15', 'web', 1),
(504, 'eE95E7WFbficvUmJRQQgCU.jpg', 'ee95e7wfbficvumjrqqgcu1683014577.jpg', NULL, '99.66 KB', '1280 x 842 pixels', '2023-05-02 02:02:57', '2023-05-02 02:02:57', 'web', 1),
(505, 'paypal-logo-png-11681551173.png', 'paypal-logo-png-116815511731683014888.png', NULL, '51.8 KB', '2000 x 529 pixels', '2023-05-02 02:08:08', '2023-05-02 02:08:08', 'web', 1),
(506, 'images.jpg', 'images1683018221.jpg', NULL, '9.33 KB', '318 x 159 pixels', '2023-05-02 03:03:41', '2023-05-02 03:03:41', 'web', 1),
(507, 'organization-word-cloud-business-concept-58626767.jpg', 'organization-word-cloud-business-concept-586267671683119158.jpg', NULL, '106.8 KB', '800 x 533 pixels', '2023-05-03 07:05:58', '2023-05-03 07:05:58', 'web', 1533),
(508, 'digital-markting.jpg', 'digital-markting1683119158.jpg', NULL, '60.69 KB', '1536 x 786 pixels', '2023-05-03 07:05:58', '2023-05-03 07:05:58', 'web', 1533),
(509, 'download.png', 'download1683119159.png', NULL, '3.75 KB', '307 x 164 pixels', '2023-05-03 07:05:59', '2023-05-03 07:05:59', 'web', 1533),
(510, 'edd-new-authorize-net-download-graphic2-s.png', 'edd-new-authorize-net-download-graphic2-s1683119159.png', NULL, '31.38 KB', '1600 x 800 pixels', '2023-05-03 07:05:59', '2023-05-03 07:05:59', 'web', 1533),
(511, 'corporate-minimal-letterhead-document-template_788646-56.jpg', 'corporate-minimal-letterhead-document-template-788646-561683119381.jpg', NULL, '180.87 KB', '1601 x 2000 pixels', '2023-05-03 07:09:42', '2023-05-03 07:09:42', 'web', 1533),
(512, 'AFI-National-ID-banner-top.jpg', 'afi-national-id-banner-top1683119419.jpg', NULL, '37.13 KB', '532 x 364 pixels', '2023-05-03 07:10:19', '2023-05-03 07:10:19', 'web', 1533),
(513, '73087188_101697494595723_807115863491608576_n.jpg', '73087188-101697494595723-807115863491608576-n1683191987.jpg', NULL, '16.41 KB', '500 x 250 pixels', '2023-05-04 03:19:48', '2023-05-04 03:19:48', 'admin', 22),
(514, 'Comparing-JPEG-image-to-WebP-image.png', 'comparing-jpeg-image-to-webp-image1683542888.png', NULL, '70.55 KB', '760 x 480 pixels', '2023-05-08 04:48:08', '2023-05-08 04:48:08', 'web', 1536),
(515, 'paypal-logo-png-11681551173.png', 'paypal-logo-png-116815511731683620123.png', NULL, '51.8 KB', '2000 x 529 pixels', '2023-05-09 02:15:24', '2023-05-09 02:15:24', 'web', 1536),
(516, 'WebP_Logo.png', 'webp-logo1683620123.png', NULL, '85 KB', '2000 x 653 pixels', '2023-05-09 02:15:24', '2023-05-09 02:15:24', 'web', 1536),
(517, 'new_logo.png', 'new-logo1683620124.png', NULL, '3.49 KB', '199 x 46 pixels', '2023-05-09 02:15:24', '2023-05-09 02:15:24', 'web', 1536),
(518, 'download (5).png', 'download-51683620124.png', NULL, '7.24 KB', '259 x 194 pixels', '2023-05-09 02:15:24', '2023-05-09 02:15:24', 'web', 1536),
(519, 'zitopay_wallet.png', 'zitopay-wallet1683620125.png', NULL, '11.87 KB', '1024 x 512 pixels', '2023-05-09 02:15:25', '2023-05-09 02:15:25', 'web', 1536),
(520, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-541643693233.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-5416436932331683620125.png', NULL, '459.88 KB', '730 x 497 pixels', '2023-05-09 02:15:25', '2023-05-09 02:15:25', 'web', 1536),
(521, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-341643710084.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-3416437100841683620125.png', NULL, '361.25 KB', '730 x 497 pixels', '2023-05-09 02:15:26', '2023-05-09 02:15:26', 'web', 1536),
(522, 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-451643711224.png', 'young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-4516437112241683620126.png', NULL, '600.61 KB', '730 x 497 pixels', '2023-05-09 02:15:26', '2023-05-09 02:15:26', 'web', 1536),
(523, '2022-12-28.jpg', '2022-12-281683620126.jpg', NULL, '87.75 KB', '1080 x 608 pixels', '2023-05-09 02:15:26', '2023-05-09 02:15:26', 'web', 1536),
(524, 'Television-Repair-Service.jpg', 'television-repair-service1683620127.jpg', NULL, '213.9 KB', '1008 x 672 pixels', '2023-05-09 02:15:27', '2023-05-09 02:15:27', 'web', 1536),
(525, 'Online-On-demand-Home-Services-Market.jpg', 'online-on-demand-home-services-market1683620127.jpg', NULL, '33.25 KB', '720 x 400 pixels', '2023-05-09 02:15:27', '2023-05-09 02:15:27', 'web', 1536),
(526, 'Banner.png', 'banner1683620127.png', NULL, '106.03 KB', '853 x 391 pixels', '2023-05-09 02:15:28', '2023-05-09 02:15:28', 'web', 1536),
(527, 'woman-cleaning-her-window-car-from-snow.jpg', 'woman-cleaning-her-window-car-from-snow1684045793.jpg', NULL, '3.67 MB', '3800 x 2533 pixels', '2023-05-14 00:29:56', '2023-05-14 00:29:56', 'web', 1536),
(528, 'download.jpg', 'download1684045856.jpg', NULL, '17.04 KB', '265 x 190 pixels', '2023-05-14 00:30:56', '2023-05-14 00:30:56', 'web', 1536),
(529, 'tw.jpg', 'tw1684045856.jpg', NULL, '13.4 KB', '508 x 307 pixels', '2023-05-14 00:30:57', '2023-05-14 00:30:57', 'web', 1536),
(530, '2vEFZRTEUsPmQrQ6Q5EQtY.jpg', '2vefzrteuspmqrq6q5eqty1684045857.jpg', NULL, '293.68 KB', '1920 x 1080 pixels', '2023-05-14 00:30:57', '2023-05-14 00:30:57', 'web', 1536),
(531, 'design-amazon-kdp-book-cover-fix-design-journal-cover-notebook-etc.jpg', 'design-amazon-kdp-book-cover-fix-design-journal-cover-notebook-etc1684047129.jpg', NULL, '138.36 KB', '680 x 372 pixels', '2023-05-14 00:52:09', '2023-05-14 00:52:09', 'web', 1536),
(532, 'design-amazon-kdp-book-cover-fix-design-journal-cover-notebook-etc (1).jpg', 'design-amazon-kdp-book-cover-fix-design-journal-cover-notebook-etc-11684047129.jpg', NULL, '41.39 KB', '680 x 510 pixels', '2023-05-14 00:52:09', '2023-05-20 08:55:42', 'web', 1536),
(533, 'deepcleaning.jpg', 'deepcleaning1684300728.jpg', NULL, '138.3 KB', '890 x 502 pixels', '2023-05-16 23:18:48', '2023-05-16 23:18:48', 'web', 1536),
(534, 'depositphotos_87200948-stock-photo-builder-with-tablet-pc-and.jpg', 'depositphotos-87200948-stock-photo-builder-with-tablet-pc-and1684300728.jpg', NULL, '52.25 KB', '1023 x 640 pixels', '2023-05-16 23:18:49', '2023-05-16 23:18:49', 'web', 1536),
(535, 'images (2).jpg', 'images-21684300899.jpg', NULL, '6.69 KB', '275 x 183 pixels', '2023-05-16 23:21:39', '2023-05-16 23:21:39', 'web', 1536),
(536, 'istockphoto-1417839986-612x612.jpg', 'istockphoto-1417839986-612x6121684300899.jpg', NULL, '41.53 KB', '612 x 407 pixels', '2023-05-16 23:21:39', '2023-05-16 23:21:39', 'web', 1536),
(537, 'Food service-505.jpg', 'food-service-5051684300900.jpg', NULL, '38.85 KB', '505 x 336 pixels', '2023-05-16 23:21:40', '2023-05-16 23:21:40', 'web', 1536),
(538, 'sec-2.png', 'sec-21684300900.png', NULL, '84.88 KB', '567 x 365 pixels', '2023-05-16 23:21:40', '2023-05-16 23:21:40', 'web', 1536),
(539, '673524.png', '6735241684316666.png', NULL, '16.84 KB', '512 x 512 pixels', '2023-05-17 03:44:26', '2023-05-17 03:44:26', 'web', 1536),
(540, 'maxresdefault (1).jpg', 'maxresdefault-11684333451.jpg', NULL, '119.76 KB', '1280 x 720 pixels', '2023-05-17 08:24:11', '2023-05-17 08:24:11', 'web', 1536),
(541, 'maxresdefault.jpg', 'maxresdefault1684333451.jpg', NULL, '157.24 KB', '1280 x 720 pixels', '2023-05-17 08:24:11', '2023-05-17 08:24:11', 'web', 1536),
(542, 'images (2).jpg', 'images-21684659836.jpg', NULL, '6.69 KB', '275 x 183 pixels', '2023-05-21 03:03:56', '2023-05-21 03:03:56', 'web', 1537),
(543, 'sec-2.png', 'sec-21684659839.png', NULL, '84.88 KB', '567 x 365 pixels', '2023-05-21 03:03:59', '2023-05-21 03:03:59', 'web', 1537),
(544, '673524.png', '6735241684665090.png', NULL, '16.84 KB', '512 x 512 pixels', '2023-05-21 04:31:30', '2023-05-21 04:31:30', 'web', 1540),
(545, 'maxresdefault.jpg', 'maxresdefault1684733368.jpg', NULL, '157.24 KB', '1280 x 720 pixels', '2023-05-21 23:29:29', '2023-05-21 23:29:29', 'web', 1542),
(546, 'Food service-505.jpg', 'food-service-5051684734709.jpg', NULL, '38.85 KB', '505 x 336 pixels', '2023-05-21 23:51:49', '2023-05-21 23:51:49', 'web', 1542),
(547, 'istockphoto-1417839986-612x612.jpg', 'istockphoto-1417839986-612x6121684734709.jpg', NULL, '41.53 KB', '612 x 407 pixels', '2023-05-21 23:51:49', '2023-05-21 23:51:49', 'web', 1542),
(548, 'sec-2.png', 'sec-21684734709.png', NULL, '84.88 KB', '567 x 365 pixels', '2023-05-21 23:51:50', '2023-05-21 23:51:50', 'web', 1542),
(549, 'depositphotos_87200948-stock-photo-builder-with-tablet-pc-and.jpg', 'depositphotos-87200948-stock-photo-builder-with-tablet-pc-and1684734709.jpg', NULL, '52.25 KB', '1023 x 640 pixels', '2023-05-21 23:51:50', '2023-05-21 23:51:50', 'web', 1542),
(550, 'deepcleaning.jpg', 'deepcleaning1684734710.jpg', NULL, '138.3 KB', '890 x 502 pixels', '2023-05-21 23:51:50', '2023-05-21 23:51:50', 'web', 1542),
(551, 'design-amazon-kdp-book-cover-fix-design-journal-cover-notebook-etc (1).jpg', 'design-amazon-kdp-book-cover-fix-design-journal-cover-notebook-etc-11684734710.jpg', NULL, '41.39 KB', '680 x 510 pixels', '2023-05-21 23:51:50', '2023-05-21 23:51:50', 'web', 1542),
(552, 'design-amazon-kdp-book-cover-fix-design-journal-cover-notebook-etc.jpg', 'design-amazon-kdp-book-cover-fix-design-journal-cover-notebook-etc1684734711.jpg', NULL, '138.36 KB', '680 x 372 pixels', '2023-05-21 23:51:51', '2023-05-21 23:51:51', 'web', 1542),
(553, 'download.jpg', 'download1684734711.jpg', NULL, '17.04 KB', '265 x 190 pixels', '2023-05-21 23:51:51', '2023-05-21 23:51:51', 'web', 1542),
(554, 'tw.jpg', 'tw1684734711.jpg', NULL, '13.4 KB', '508 x 307 pixels', '2023-05-21 23:51:51', '2023-05-21 23:51:51', 'web', 1542),
(555, '2vEFZRTEUsPmQrQ6Q5EQtY.jpg', '2vefzrteuspmqrq6q5eqty1684734711.jpg', NULL, '293.68 KB', '1920 x 1080 pixels', '2023-05-21 23:51:52', '2023-05-21 23:51:52', 'web', 1542),
(556, '73087188_101697494595723_807115863491608576_n.jpg', '73087188-101697494595723-807115863491608576-n1684734712.jpg', NULL, '16.41 KB', '500 x 250 pixels', '2023-05-21 23:51:52', '2023-05-21 23:51:52', 'web', 1542),
(557, 'images (1).jpg', 'images-11684734713.jpg', NULL, '9.33 KB', '318 x 159 pixels', '2023-05-21 23:51:53', '2023-05-21 23:51:53', 'web', 1542),
(558, 'cash-on-delivery-icon-14.jpg', 'cash-on-delivery-icon-141684734713.jpg', NULL, '16.55 KB', '346 x 136 pixels', '2023-05-21 23:51:53', '2023-05-21 23:51:53', 'web', 1542),
(559, 'ads1644057883.jpg', 'ads16440578831684734714.jpg', NULL, '250.25 KB', '1394 x 315 pixels', '2023-05-21 23:51:54', '2023-05-21 23:51:54', 'web', 1542),
(560, 'User-Avatar-in-Suit-PNG.png', 'user-avatar-in-suit-png1684734714.png', NULL, '32.08 KB', '512 x 512 pixels', '2023-05-21 23:51:54', '2023-05-21 23:51:54', 'web', 1542),
(561, 'woman-cleaning-her-window-car-from-snow.jpg', 'woman-cleaning-her-window-car-from-snow1684734711.jpg', NULL, '3.67 MB', '3800 x 2533 pixels', '2023-05-21 23:51:54', '2023-05-21 23:51:54', 'web', 1542),
(562, '673524.png', '6735241684830584.png', NULL, '16.84 KB', '512 x 512 pixels', '2023-05-23 02:29:44', '2023-05-23 02:29:44', 'web', 1543),
(563, 'gettyimages-sharing-food.jpg', 'gettyimages-sharing-food1684848151.jpg', NULL, '100.21 KB', '704 x 396 pixels', '2023-05-23 07:22:31', '2023-05-23 07:22:31', 'admin', 22),
(564, '1599-Fast food.jpg', '1599-fast-food1684848151.jpg', NULL, '492.38 KB', '1200 x 630 pixels', '2023-05-23 07:22:32', '2023-05-23 07:22:32', 'admin', 22);
INSERT INTO `media_uploads` (`id`, `title`, `path`, `alt`, `size`, `dimensions`, `created_at`, `updated_at`, `type`, `user_id`) VALUES
(565, 'istockphoto-1417839986-612x612.jpg', 'istockphoto-1417839986-612x6121684848226.jpg', NULL, '41.53 KB', '612 x 407 pixels', '2023-05-23 07:23:46', '2023-05-23 07:23:46', 'admin', 22),
(566, 'download (1).jpg', 'download-11684848633.jpg', NULL, '4.15 KB', '206 x 244 pixels', '2023-05-23 07:30:33', '2023-05-23 07:30:33', 'admin', 22),
(567, 'iphone7lineup.jpg', 'iphone7lineup1684848633.jpg', NULL, '84.52 KB', '1600 x 1354 pixels', '2023-05-23 07:30:34', '2023-05-23 07:30:34', 'admin', 22),
(568, 'iPhone-14-Pro-Max-9907.jpg', 'iphone-14-pro-max-99071684848634.jpg', NULL, '25.08 KB', '739 x 739 pixels', '2023-05-23 07:30:34', '2023-05-23 07:30:34', 'admin', 22),
(569, 'images (2).jpg', 'images-21684905699.jpg', NULL, '6.69 KB', '275 x 183 pixels', '2023-05-23 23:21:39', '2023-05-23 23:21:39', 'web', 1),
(570, 'home-care-logo-png_268574.jpg', 'home-care-logo-png-2685741684913208.jpg', NULL, '12.94 KB', '360 x 360 pixels', '2023-05-24 01:26:48', '2023-05-24 01:26:48', 'web', 1),
(571, 'istockphoto-1316230197-612x612.jpg', 'istockphoto-1316230197-612x6121684913208.jpg', NULL, '25.43 KB', '612 x 612 pixels', '2023-05-24 01:26:49', '2023-05-24 01:26:49', 'web', 1),
(572, 'istockphoto-904115868-612x612.jpg', 'istockphoto-904115868-612x6121684913209.jpg', NULL, '19.67 KB', '612 x 467 pixels', '2023-05-24 01:26:49', '2023-05-24 01:26:49', 'web', 1),
(573, 'iPhone-14-Pro-Max-9907.jpg', 'iphone-14-pro-max-99071684995271.jpg', NULL, '25.08 KB', '739 x 739 pixels', '2023-05-25 00:14:31', '2023-05-25 00:14:31', 'web', 1544),
(574, 'istockphoto-1224452027-612x612.jpg', 'istockphoto-1224452027-612x6121685180019.jpg', NULL, '20.39 KB', '612 x 326 pixels', '2023-05-27 03:33:40', '2023-05-27 03:33:40', 'web', 1),
(575, '360_F_435650529_fdtx8euYTrcxH5NEAWONH2zQYOEWfgrA (1).jpg', '360-f-435650529-fdtx8euytrcxh5neawonh2zqyoewfgra-11685180019.jpg', NULL, '31.88 KB', '673 x 360 pixels', '2023-05-27 03:33:40', '2023-05-27 03:33:40', 'web', 1),
(576, '246821-200.png', '246821-2001685256833.png', NULL, '7.33 KB', '200 x 200 pixels', '2023-05-28 00:53:53', '2023-05-28 00:53:53', 'admin', 22),
(577, '279-2795639_clipart-transparent-web-development-web-app-icon-png.png', '279-2795639-clipart-transparent-web-development-web-app-icon-png1685256833.png', NULL, '74.97 KB', '820 x 860 pixels', '2023-05-28 00:53:53', '2023-05-28 00:53:53', 'admin', 22),
(578, '1688400.png', '16884001685256833.png', NULL, '29.6 KB', '512 x 512 pixels', '2023-05-28 00:53:53', '2023-05-28 00:53:53', 'admin', 22),
(579, 'web-development-5685844-4744562.png', 'web-development-5685844-47445621685256833.png', NULL, '68.77 KB', '450 x 450 pixels', '2023-05-28 00:53:53', '2023-05-28 00:53:53', 'admin', 22),
(580, '246821-200.png', '246821-2001685257907.png', NULL, '7.33 KB', '200 x 200 pixels', '2023-05-28 01:11:48', '2023-05-28 01:11:48', 'web', 1),
(581, '279-2795639_clipart-transparent-web-development-web-app-icon-png.png', '279-2795639-clipart-transparent-web-development-web-app-icon-png1685257907.png', NULL, '74.97 KB', '820 x 860 pixels', '2023-05-28 01:11:48', '2023-05-28 01:11:48', 'web', 1),
(582, '1688400.png', '16884001685257908.png', NULL, '29.6 KB', '512 x 512 pixels', '2023-05-28 01:11:48', '2023-05-28 01:11:48', 'web', 1),
(583, 'web-development-5685844-4744562.png', 'web-development-5685844-47445621685257908.png', NULL, '68.77 KB', '450 x 450 pixels', '2023-05-28 01:11:48', '2023-05-28 01:11:48', 'web', 1),
(584, 'web-development1.png', 'web-development11685257909.png', NULL, '154.9 KB', '1000 x 500 pixels', '2023-05-28 01:11:49', '2023-05-28 01:11:49', 'web', 1),
(585, 'C_EI_PH_A_Infographic-4-Step-Test-For-A-More-Accurate-Career-Path-AP-scaled.jpg', 'c-ei-ph-a-infographic-4-step-test-for-a-more-accurate-career-path-ap-scaled1685257909.jpg', NULL, '200.23 KB', '2560 x 1440 pixels', '2023-05-28 01:11:50', '2023-05-28 01:11:50', 'web', 1),
(586, 'hero.png', 'hero1685257909.png', NULL, '239.76 KB', '2401 x 1351 pixels', '2023-05-28 01:11:50', '2023-05-28 01:11:50', 'web', 1),
(587, 'images (2).png', 'images-21685258332.png', NULL, '3.16 KB', '225 x 225 pixels', '2023-05-28 01:18:52', '2023-05-28 01:18:52', 'web', 1),
(588, 'istockphoto-856952836-612x612.jpg', 'istockphoto-856952836-612x6121685258332.jpg', NULL, '27.95 KB', '612 x 406 pixels', '2023-05-28 01:18:53', '2023-05-28 01:18:53', 'web', 1),
(589, 'istockphoto-1154947817-612x612.jpg', 'istockphoto-1154947817-612x6121685258333.jpg', NULL, '55.76 KB', '612 x 408 pixels', '2023-05-28 01:18:53', '2023-05-28 01:18:53', 'web', 1),
(590, '{b353ab87-28c0-432a-978f-209591ed22c8}_icon-3-without-border.png', 'b353ab87-28c0-432a-978f-209591ed22c8-icon-3-without-border1685258333.png', NULL, '7.86 KB', '150 x 130 pixels', '2023-05-28 01:18:53', '2023-05-28 01:18:53', 'web', 1),
(591, '831637998784-S pure spa 2-01.png', '831637998784-s-pure-spa-2-011685258332.png', NULL, '109.89 KB', '2400 x 2400 pixels', '2023-05-28 01:18:54', '2023-05-28 01:18:54', 'web', 1),
(592, '{24c615c8-298b-40dc-869f-b4cb27aaeef8}_icon-2-without-border.png', '24c615c8-298b-40dc-869f-b4cb27aaeef8-icon-2-without-border1685258334.png', NULL, '10.76 KB', '150 x 130 pixels', '2023-05-28 01:18:54', '2023-05-28 01:18:54', 'web', 1),
(593, '627530b5d030b17096815c34_Mask group (4)-p-500.png', '627530b5d030b17096815c34-mask-group-4-p-5001685258334.png', NULL, '45.99 KB', '500 x 382 pixels', '2023-05-28 01:18:54', '2023-05-28 01:18:54', 'web', 1),
(594, '360_F_167812893_9AUj626NC8tose0SY56DCllMpr1bUyCU.jpg', '360-f-167812893-9auj626nc8tose0sy56dcllmpr1buycu1685258641.jpg', NULL, '52.04 KB', '540 x 360 pixels', '2023-05-28 01:24:01', '2023-05-28 01:24:01', 'web', 1),
(595, 'Web-Development-Careers-1-scaled.jpg', 'web-development-careers-1-scaled1685258641.jpg', NULL, '1.53 MB', '2560 x 1440 pixels', '2023-05-28 01:24:03', '2023-05-28 01:24:03', 'web', 1),
(596, '0_BaRSXh-rAfy0aiTf.jpg', '0-barsxh-rafy0aitf1685258715.jpg', NULL, '115.17 KB', '1400 x 933 pixels', '2023-05-28 01:25:15', '2023-05-28 01:25:15', 'web', 1),
(597, '4444.png', '44441687151518.png', NULL, '37.63 KB', '1058 x 130 pixels', '2023-06-18 23:11:59', '2023-06-18 23:11:59', 'web', 1551),
(598, '2022-10-10-634394617eacc.png', '2022-10-10-634394617eacc1687151673.png', NULL, '81.77 KB', '500 x 500 pixels', '2023-06-18 23:14:33', '2023-06-18 23:14:33', 'web', 1551),
(599, 'a2dfec3de974f27433aa6d7c955ba591.jpg', 'a2dfec3de974f27433aa6d7c955ba5911687151673.jpg', NULL, '40.19 KB', '474 x 474 pixels', '2023-06-18 23:14:33', '2023-06-18 23:14:33', 'web', 1551),
(600, 'images (3).jpg', 'images-31687151674.jpg', NULL, '8.18 KB', '300 x 168 pixels', '2023-06-18 23:14:34', '2023-06-18 23:14:34', 'web', 1551),
(601, 'photo-1580618672591-eb180b1a973f.jpg', 'photo-1580618672591-eb180b1a973f1687151674.jpg', NULL, '91.22 KB', '1000 x 668 pixels', '2023-06-18 23:14:34', '2023-06-18 23:14:34', 'web', 1551),
(602, 'istockphoto-872361244-612x612.jpg', 'istockphoto-872361244-612x6121687151674.jpg', NULL, '32.98 KB', '612 x 408 pixels', '2023-06-18 23:14:34', '2023-06-18 23:14:34', 'web', 1551),
(603, 'download (1).jpg', 'download-11687409349.jpg', NULL, '4.15 KB', '206 x 244 pixels', '2023-06-21 22:49:10', '2023-06-21 22:49:10', 'web', 2),
(604, 'iPhone-14-Pro-Max-9907.jpg', 'iphone-14-pro-max-99071687409349.jpg', NULL, '25.08 KB', '739 x 739 pixels', '2023-06-21 22:49:10', '2023-06-21 22:49:10', 'web', 2),
(605, 'gettyimages-sharing-food.jpg', 'gettyimages-sharing-food1687409350.jpg', NULL, '100.21 KB', '704 x 396 pixels', '2023-06-21 22:49:10', '2023-06-21 22:49:10', 'web', 2),
(606, '1599-Fast food.jpg', '1599-fast-food1687409350.jpg', NULL, '492.38 KB', '1200 x 630 pixels', '2023-06-21 22:49:10', '2023-06-21 22:49:10', 'web', 2),
(607, 'maxresdefault (1).jpg', 'maxresdefault-11687409350.jpg', NULL, '119.76 KB', '1280 x 720 pixels', '2023-06-21 22:49:11', '2023-06-21 22:49:11', 'web', 2),
(608, 'maxresdefault.jpg', 'maxresdefault1687409351.jpg', NULL, '157.24 KB', '1280 x 720 pixels', '2023-06-21 22:49:11', '2023-06-21 22:49:11', 'web', 2),
(609, 'istockphoto-1417839986-612x612.jpg', 'istockphoto-1417839986-612x6121687409351.jpg', NULL, '41.53 KB', '612 x 407 pixels', '2023-06-21 22:49:11', '2023-06-21 22:49:11', 'web', 2),
(610, 'Food service-505.jpg', 'food-service-5051687409351.jpg', NULL, '38.85 KB', '505 x 336 pixels', '2023-06-21 22:49:12', '2023-06-21 22:49:12', 'web', 2),
(611, 'sec-2.png', 'sec-21687409352.png', NULL, '84.88 KB', '567 x 365 pixels', '2023-06-21 22:49:12', '2023-06-21 22:49:12', 'web', 2),
(612, 'deepcleaning.jpg', 'deepcleaning1687409352.jpg', NULL, '138.3 KB', '890 x 502 pixels', '2023-06-21 22:49:12', '2023-06-21 22:49:12', 'web', 2),
(613, 'banner-smile1641971297 (2).png', 'banner-smile1641971297-21687761312.png', NULL, '1.81 KB', '46 x 46 pixels', '2023-06-26 00:35:12', '2023-06-26 00:35:12', 'admin', 22),
(614, 'banner11642048429 (1).png', 'banner11642048429-11687761312.png', NULL, '686.35 KB', '641 x 918 pixels', '2023-06-26 00:35:12', '2023-06-26 00:35:12', 'admin', 22),
(615, 'dot-square1641971791 (1).png', 'dot-square1641971791-11687761366.png', NULL, '4.9 KB', '163 x 163 pixels', '2023-06-26 00:36:06', '2023-06-26 00:36:06', 'admin', 22),
(616, 'OIP (1).jpg', 'oip-11689165261.jpg', NULL, '13.89 KB', '474 x 355 pixels', '2023-07-12 06:34:21', '2023-07-12 06:34:21', 'web', 1),
(617, 'logo-new.png', 'logo-new1689864609.png', NULL, '15.7 KB', '648 x 211 pixels', '2023-07-20 08:50:09', '2023-07-20 08:50:09', 'admin', 22),
(618, 'man.png', 'man1690183392.png', NULL, '23.96 KB', '512 x 512 pixels', '2023-07-24 01:23:12', '2023-07-24 01:23:12', 'web', 1),
(619, 'ads16440578831683006375.jpg', 'ads164405788316830063751690183404.jpg', NULL, '250.25 KB', '1394 x 315 pixels', '2023-07-24 01:23:25', '2023-07-24 01:23:25', 'web', 1),
(620, 'grid-logo-021637754687.png', 'grid-logo-0216377546871690183879.png', NULL, '11.76 KB', '350 x 83 pixels', '2023-07-24 01:31:19', '2023-07-24 01:31:19', 'admin', 22),
(621, 'grid-logo-021644225302.png', 'grid-logo-0216442253021690183880.png', NULL, '11.76 KB', '350 x 83 pixels', '2023-07-24 01:31:20', '2023-07-24 01:31:20', 'admin', 22),
(622, 'circle21643799195.png', 'circle216437991951690184056.png', NULL, '5.26 KB', '164 x 164 pixels', '2023-07-24 01:34:16', '2023-07-24 01:34:16', 'admin', 22),
(623, 'circle21641994879.png', 'circle216419948791690184056.png', NULL, '5.26 KB', '164 x 164 pixels', '2023-07-24 01:34:16', '2023-07-24 01:34:16', 'admin', 22),
(624, 'dot-square1641994880.png', 'dot-square16419948801690184058.png', NULL, '3.79 KB', '138 x 138 pixels', '2023-07-24 01:34:18', '2023-07-24 01:34:18', 'admin', 22),
(625, 'download1648442270.png', 'download16484422701690184058.png', NULL, '3.15 KB', '225 x 225 pixels', '2023-07-24 01:34:18', '2023-07-24 01:34:18', 'admin', 22),
(626, 'grid-b51641641302.jpg', 'grid-b516416413021690184059.jpg', NULL, '13.52 KB', '350 x 233 pixels', '2023-07-24 01:34:19', '2023-07-24 01:34:19', 'admin', 22),
(627, 'grid-banner11642048429.png', 'grid-banner116420484291690184060.png', NULL, '216.23 KB', '350 x 501 pixels', '2023-07-24 01:34:20', '2023-07-24 01:34:20', 'admin', 22),
(628, 'grid-banner21638339592.jpg', 'grid-banner216383395921690184061.jpg', NULL, '27.71 KB', '350 x 350 pixels', '2023-07-24 01:34:21', '2023-07-24 01:34:21', 'admin', 22),
(629, 'manual_attachment_1662335523.png', 'manual-attachment-16623355231690184117.png', NULL, '1.81 KB', '46 x 46 pixels', '2023-07-24 01:35:17', '2023-07-24 01:35:17', 'admin', 22),
(630, 'User-Avatar-in-Suit-PNG.png', 'user-avatar-in-suit-png1690184600.png', NULL, '32.08 KB', '512 x 512 pixels', '2023-07-24 01:43:20', '2023-07-24 01:43:20', 'web', 5),
(631, 'manual_attachment_1649867921.jpg', 'manual-attachment-16498679211690208090.jpg', NULL, '932.85 KB', '960 x 1444 pixels', '2023-07-24 08:14:50', '2023-07-24 08:14:50', 'admin', 22),
(632, '2022-10-10-634394617eacc.png', '2022-10-10-634394617eacc1690209953.png', NULL, '81.77 KB', '500 x 500 pixels', '2023-07-24 08:45:54', '2023-07-24 08:45:54', 'admin', 22),
(633, 'new_logo.png', 'new-logo1690209977.png', NULL, '3.49 KB', '199 x 46 pixels', '2023-07-24 08:46:17', '2023-07-24 08:46:17', 'admin', 22),
(634, 'logo-01.png', 'logo-011690210012.png', NULL, '4.19 KB', '214 x 51 pixels', '2023-07-24 08:46:52', '2023-07-24 08:46:52', 'admin', 22),
(635, 'IMG20230702175833.jpg.jpg', 'img20230702175833jpg1690224638.jpg', NULL, '2.63 MB', '3120 x 4160 pixels', '2023-07-24 12:50:42', '2023-07-24 12:50:42', 'web', NULL),
(636, 'image10test .jpg', 'image10test1690226295.jpg', NULL, '183.95 KB', '662 x 716 pixels', '2023-07-24 13:18:15', '2023-07-24 13:18:15', 'web', NULL),
(637, 'galleryimage10test .jpg', 'galleryimage10test1690226295.jpg', NULL, '183.95 KB', '662 x 716 pixels', '2023-07-24 13:18:15', '2023-07-24 13:18:15', 'web', NULL),
(638, 'image110234123.jpg', 'image1102341231690285163.jpg', NULL, '141.87 KB', '960 x 1280 pixels', '2023-07-25 05:39:24', '2023-07-25 05:39:24', 'web', NULL),
(639, 'image46213.jpg', 'image462131690285460.jpg', NULL, '141.87 KB', '960 x 1280 pixels', '2023-07-25 05:44:21', '2023-07-25 05:44:21', 'web', NULL),
(640, 'image4632424.jpg', 'image46324241690285716.jpg', NULL, '141.87 KB', '960 x 1280 pixels', '2023-07-25 05:48:36', '2023-07-25 05:48:36', 'web', NULL),
(641, 'image11123.jpg', 'image111231690285936.jpg', NULL, '141.87 KB', '960 x 1280 pixels', '2023-07-25 05:52:16', '2023-07-25 05:52:16', 'web', NULL),
(642, 'image20Noni.jpg', 'image20noni1690448011.jpg', NULL, '499.97 KB', '720 x 1600 pixels', '2023-07-27 02:53:32', '2023-07-27 02:53:32', 'web', NULL),
(643, 'nidImageInstance of \'XFile\'.jpg', 'nidimageinstance-of-xfile1690448075.jpg', NULL, '183.95 KB', '662 x 716 pixels', '2023-07-27 02:54:35', '2023-07-27 02:54:35', 'web', NULL),
(644, 'addressImageInstance of \'XFile\'.jpg', 'addressimageinstance-of-xfile1690448075.jpg', NULL, '499.97 KB', '720 x 1600 pixels', '2023-07-27 02:54:36', '2023-07-27 02:54:36', 'web', NULL),
(645, '031562a3c22a416426198af88e7abde2.jpg', '031562a3c22a416426198af88e7abde21690457020.jpg', NULL, '117.74 KB', '800 x 800 pixels', '2023-07-27 05:23:40', '2023-07-27 05:23:40', 'web', 1),
(646, 'new_choose2 (1).png', 'new-choose2-11690466426.png', NULL, '2.68 KB', '48 x 49 pixels', '2023-07-27 08:00:26', '2023-07-27 08:00:26', 'admin', 22),
(647, 'new_choose1 (1).png', 'new-choose1-11690466426.png', NULL, '2.48 KB', '48 x 48 pixels', '2023-07-27 08:00:26', '2023-07-27 08:00:26', 'admin', 22),
(648, 'playStore.png', 'playstore1690466427.png', NULL, '3.85 KB', '182 x 60 pixels', '2023-07-27 08:00:27', '2023-07-27 08:00:27', 'admin', 22),
(649, 'appleStore.png', 'applestore1690466428.png', NULL, '3.03 KB', '186 x 64 pixels', '2023-07-27 08:00:28', '2023-07-27 08:00:28', 'admin', 22),
(650, 'new_app1.png', 'new-app11690466429.png', NULL, '87.73 KB', '266 x 492 pixels', '2023-07-27 08:00:30', '2023-07-27 08:00:30', 'admin', 22),
(651, 'new_app2.png', 'new-app21690466430.png', NULL, '87.4 KB', '336 x 590 pixels', '2023-07-27 08:00:30', '2023-07-27 08:00:30', 'admin', 22),
(652, 'consulting_reviewer1.jpg', 'consulting-reviewer11690466434.jpg', NULL, '3.92 KB', '40 x 40 pixels', '2023-07-27 08:00:34', '2023-07-27 08:00:34', 'admin', 22),
(653, 'new_joinMain.png', 'new-joinmain1690466434.png', NULL, '101.3 KB', '636 x 444 pixels', '2023-07-27 08:00:34', '2023-07-27 08:00:34', 'admin', 22),
(654, 'consulting_reviewer2.jpg', 'consulting-reviewer21690466435.jpg', NULL, '2.94 KB', '40 x 40 pixels', '2023-07-27 08:00:36', '2023-07-27 08:00:36', 'admin', 22),
(655, 'consulting_reviewer3.jpg', 'consulting-reviewer31690466436.jpg', NULL, '3.94 KB', '40 x 40 pixels', '2023-07-27 08:00:36', '2023-07-27 08:00:36', 'admin', 22),
(656, 'consulting_reviewer4.jpg', 'consulting-reviewer41690466437.jpg', NULL, '3.89 KB', '40 x 40 pixels', '2023-07-27 08:00:37', '2023-07-27 08:00:37', 'admin', 22),
(657, 'consulting_reviewer5.jpg', 'consulting-reviewer51690466437.jpg', NULL, '3.94 KB', '40 x 40 pixels', '2023-07-27 08:00:38', '2023-07-27 08:00:38', 'admin', 22),
(658, 'new_banner1.png', 'new-banner11690466439.png', NULL, '184.29 KB', '280 x 408 pixels', '2023-07-27 08:00:39', '2023-07-27 08:00:39', 'admin', 22),
(659, 'new_banner2.png', 'new-banner21690466440.png', NULL, '171.62 KB', '320 x 400 pixels', '2023-07-27 08:00:40', '2023-07-27 08:00:40', 'admin', 22),
(660, 'new_choose3.png', 'new-choose31690466921.png', NULL, '2.14 KB', '48 x 49 pixels', '2023-07-27 08:08:41', '2023-07-27 08:08:41', 'admin', 22),
(661, 'eletronices-cat.png', 'eletronices-cat1690538911.png', NULL, '188.97 KB', '860 x 769 pixels', '2023-07-28 04:08:31', '2023-07-28 04:08:31', 'admin', 22),
(662, 'pexels-pavel-danilyuk-7120911.jpg', 'pexels-pavel-danilyuk-71209111690540327.jpg', NULL, '116.95 KB', '1279 x 854 pixels', '2023-07-28 04:32:08', '2023-07-28 04:32:08', 'web', 1),
(663, 'pexels-ketut-subiyanto-4350169.jpg', 'pexels-ketut-subiyanto-43501691690540470.jpg', NULL, '169.4 KB', '1279 x 795 pixels', '2023-07-28 04:34:31', '2023-07-28 04:34:31', 'web', 1),
(664, 'pexels-ketut-subiyanto-4350166.jpg', 'pexels-ketut-subiyanto-43501661690540471.jpg', NULL, '295.21 KB', '1280 x 1611 pixels', '2023-07-28 04:34:32', '2023-07-28 04:34:32', 'web', 1),
(665, 'pexels-monstera-6238013.jpg', 'pexels-monstera-62380131690540474.jpg', NULL, '166.99 KB', '1279 x 853 pixels', '2023-07-28 04:34:34', '2023-07-28 04:34:34', 'web', 1),
(666, 'pexels-keira-burton-6146995.jpg', 'pexels-keira-burton-61469951690540475.jpg', NULL, '257.91 KB', '1280 x 853 pixels', '2023-07-28 04:34:35', '2023-07-28 04:34:35', 'web', 1),
(667, 'pexels-pavel-danilyuk-7120911.jpg', 'pexels-pavel-danilyuk-71209111690540477.jpg', NULL, '116.95 KB', '1279 x 854 pixels', '2023-07-28 04:34:38', '2023-07-28 04:34:38', 'web', 1),
(668, 'pexels-george-milton-7034734.jpg', 'pexels-george-milton-70347341690540482.jpg', NULL, '3.11 MB', '6000 x 4000 pixels', '2023-07-28 04:34:49', '2023-07-28 04:34:49', 'web', 1),
(669, 'pexels-cottonbro-studio-7117028.jpg', 'pexels-cottonbro-studio-71170281690541584.jpg', NULL, '132.26 KB', '1280 x 853 pixels', '2023-07-28 04:53:04', '2023-07-28 04:53:04', 'web', 1),
(670, 'pexels-felicity-tai-7951256.jpg', 'pexels-felicity-tai-79512561690541584.jpg', NULL, '227.33 KB', '1280 x 853 pixels', '2023-07-28 04:53:05', '2023-07-28 04:53:05', 'web', 1),
(671, 'pexels-blue-bird-7217990.jpg', 'pexels-blue-bird-72179901690541586.jpg', NULL, '196.96 KB', '1280 x 853 pixels', '2023-07-28 04:53:07', '2023-07-28 04:53:07', 'web', 1),
(672, 'pexels-blue-bird-7218026.jpg', 'pexels-blue-bird-72180261690541587.jpg', NULL, '135.03 KB', '1279 x 853 pixels', '2023-07-28 04:53:07', '2023-07-28 04:53:07', 'web', 1),
(673, 'pexels-blue-bird-7218000.jpg', 'pexels-blue-bird-72180001690541589.jpg', NULL, '69.65 KB', '569 x 853 pixels', '2023-07-28 04:53:09', '2023-07-28 04:53:09', 'web', 1),
(674, 'pexels-blue-bird-7217998.jpg', 'pexels-blue-bird-72179981690541589.jpg', NULL, '80.76 KB', '1280 x 853 pixels', '2023-07-28 04:53:09', '2023-07-28 04:53:09', 'web', 1),
(675, 'pexels-george-milton-7034390.jpg', 'pexels-george-milton-70343901690541591.jpg', NULL, '142.19 KB', '1280 x 853 pixels', '2023-07-28 04:53:11', '2023-07-28 04:53:11', 'web', 1),
(676, 'pexels-cottonbro-studio-4098151.jpg', 'pexels-cottonbro-studio-40981511690541591.jpg', NULL, '212.93 KB', '1280 x 853 pixels', '2023-07-28 04:53:12', '2023-07-28 04:53:12', 'web', 1),
(677, 'pexels-inline-media-5229639.jpg', 'pexels-inline-media-52296391690541593.jpg', NULL, '214.91 KB', '1280 x 853 pixels', '2023-07-28 04:53:14', '2023-07-28 04:53:14', 'web', 1),
(678, 'pexels-erik-mclean-4876645.jpg', 'pexels-erik-mclean-48766451690541594.jpg', NULL, '166.63 KB', '1280 x 853 pixels', '2023-07-28 04:53:14', '2023-07-28 04:53:14', 'web', 1),
(679, 'pexels-erik-mclean-4876675.jpg', 'pexels-erik-mclean-48766751690541595.jpg', NULL, '288.53 KB', '1280 x 853 pixels', '2023-07-28 04:53:16', '2023-07-28 04:53:16', 'web', 1),
(680, 'pexels-tima-miroshnichenko-6873079.jpg', 'pexels-tima-miroshnichenko-68730791690541596.jpg', NULL, '242.13 KB', '1280 x 853 pixels', '2023-07-28 04:53:17', '2023-07-28 04:53:17', 'web', 1),
(681, 'pexels-tima-miroshnichenko-6873118.jpg', 'pexels-tima-miroshnichenko-68731181690541598.jpg', NULL, '176.2 KB', '1280 x 853 pixels', '2023-07-28 04:53:18', '2023-07-28 04:53:18', 'web', 1),
(682, 'pexels-tima-miroshnichenko-6196229.jpg', 'pexels-tima-miroshnichenko-61962291690541619.jpg', NULL, '163.03 KB', '1256 x 837 pixels', '2023-07-28 04:53:39', '2023-07-28 04:53:39', 'web', 1),
(683, 'pexels-cottonbro-studio-4107149.jpg', 'pexels-cottonbro-studio-41071491690541619.jpg', NULL, '134.11 KB', '1280 x 960 pixels', '2023-07-28 04:53:39', '2023-07-28 04:53:39', 'web', 1),
(684, 'pexels-tima-miroshnichenko-6195136.jpg', 'pexels-tima-miroshnichenko-61951361690541632.jpg', NULL, '141.2 KB', '1279 x 853 pixels', '2023-07-28 04:53:52', '2023-07-28 04:53:52', 'web', 1),
(685, 'pexels-tima-miroshnichenko-6195273.jpg', 'pexels-tima-miroshnichenko-61952731690541632.jpg', NULL, '123.46 KB', '1280 x 853 pixels', '2023-07-28 04:53:52', '2023-07-28 04:53:52', 'web', 1),
(686, 'pexels-andrea-piacquadio-3760263.jpg', 'pexels-andrea-piacquadio-37602631690541634.jpg', NULL, '101.54 KB', '1280 x 853 pixels', '2023-07-28 04:53:54', '2023-07-28 04:53:54', 'web', 1),
(687, 'pexels-alexander-suhorucov-6457537.jpg', 'pexels-alexander-suhorucov-64575371690541634.jpg', NULL, '76.85 KB', '921 x 614 pixels', '2023-07-28 04:53:54', '2023-07-28 04:53:54', 'web', 1),
(688, 'pexels-alexander-suhorucov-6457537.jpg', 'pexels-alexander-suhorucov-64575371690541646.jpg', NULL, '76.85 KB', '921 x 614 pixels', '2023-07-28 04:54:07', '2023-07-28 04:54:07', 'web', 1),
(689, 'pexels-andrea-piacquadio-3760263.jpg', 'pexels-andrea-piacquadio-37602631690541646.jpg', NULL, '101.54 KB', '1280 x 853 pixels', '2023-07-28 04:54:07', '2023-07-28 04:54:07', 'web', 1),
(690, 'pexels-sora-shimazaki-5673489.jpg', 'pexels-sora-shimazaki-56734891690541648.jpg', NULL, '118.42 KB', '1280 x 614 pixels', '2023-07-28 04:54:09', '2023-07-28 04:54:09', 'web', 1),
(691, 'pexels-sora-shimazaki-5673488 (1).jpg', 'pexels-sora-shimazaki-5673488-11690541649.jpg', NULL, '137.32 KB', '1280 x 853 pixels', '2023-07-28 04:54:09', '2023-07-28 04:54:09', 'web', 1),
(692, 'pexels-ketut-subiyanto-4350169.jpg', 'pexels-ketut-subiyanto-43501691690541662.jpg', NULL, '169.4 KB', '1279 x 795 pixels', '2023-07-28 04:54:22', '2023-07-28 04:54:22', 'web', 1),
(693, 'pexels-ketut-subiyanto-4350166.jpg', 'pexels-ketut-subiyanto-43501661690541664.jpg', NULL, '295.21 KB', '1280 x 1611 pixels', '2023-07-28 04:54:25', '2023-07-28 04:54:25', 'web', 1),
(694, 'pexels-monstera-6238013.jpg', 'pexels-monstera-62380131690541667.jpg', NULL, '166.99 KB', '1279 x 853 pixels', '2023-07-28 04:54:28', '2023-07-28 04:54:28', 'web', 1),
(695, 'pexels-sora-shimazaki-5673488.jpg', 'pexels-sora-shimazaki-56734881690541667.jpg', NULL, '3.86 MB', '6000 x 4000 pixels', '2023-07-28 04:54:34', '2023-07-28 04:54:34', 'web', 1),
(696, 'pexels-felicity-tai-7951256.jpg', 'pexels-felicity-tai-79512561690542243.jpg', NULL, '227.33 KB', '1280 x 853 pixels', '2023-07-28 05:04:04', '2023-07-28 05:04:04', 'admin', 22),
(697, 'pinting cool.jpg', 'pinting-cool1690542281.jpg', NULL, '56.83 KB', '600 x 400 pixels', '2023-07-28 05:04:41', '2023-07-28 05:04:41', 'admin', 22),
(699, '54e564e596ba02f9482baa74eeb72bf7.jpg', '54e564e596ba02f9482baa74eeb72bf71690542972.jpg', NULL, '163.83 KB', '1920 x 1080 pixels', '2023-07-28 05:16:13', '2023-07-28 05:16:13', 'web', 1),
(701, '748141670401655.jpg', '7481416704016551690542974.jpg', NULL, '269.22 KB', '1024 x 750 pixels', '2023-07-28 05:16:15', '2023-07-28 05:16:15', 'web', 1),
(702, 'download.jpg', 'download1690542975.jpg', NULL, '23.49 KB', '1024 x 683 pixels', '2023-07-28 05:16:16', '2023-07-28 05:16:16', 'web', 1),
(705, 'pexels-gustavo-fring-3985338.jpg', 'pexels-gustavo-fring-39853381690543346.jpg', NULL, '114 KB', '1280 x 853 pixels', '2023-07-28 05:22:26', '2023-07-28 05:22:26', 'web', 1),
(706, 'pexels-gustavo-fring-3985331.jpg', 'pexels-gustavo-fring-39853311690543346.jpg', '332492024_566307205439970_3463679327432228346_n', '116.53 KB', '1280 x 853 pixels', '2023-07-28 05:22:26', '2023-08-12 10:37:38', 'web', 1),
(707, 'pexels-nico-becker-5619458.jpg', 'pexels-nico-becker-56194581690543348.jpg', NULL, '154.39 KB', '1280 x 853 pixels', '2023-07-28 05:22:28', '2023-07-28 05:22:28', 'web', 1),
(708, 'workshop-state-management-with-pinia.png', 'workshop-state-management-with-pinia1690543349.png', NULL, '103.65 KB', '1136 x 926 pixels', '2023-07-28 05:22:30', '2023-07-28 05:22:30', 'web', 1),
(709, '11-119893_php-logo-in-png-transparent-png.png', '11-119893-php-logo-in-png-transparent-png1690543353.png', NULL, '41.11 KB', '516 x 280 pixels', '2023-07-28 05:22:34', '2023-10-04 14:26:55', 'web', 1),
(710, '54e564e596ba02f9482baa74eeb72bf7.jpg', '54e564e596ba02f9482baa74eeb72bf71690543354.jpg', NULL, '163.83 KB', '1920 x 1080 pixels', '2023-07-28 05:22:35', '2023-07-28 05:22:35', 'web', 1),
(711, 'customer-service-1.jpg', 'customer-service-11690545187.jpg', NULL, '119.64 KB', '1280 x 853 pixels', '2023-07-28 05:53:08', '2023-07-28 05:53:08', 'web', 5),
(712, 'asst.jpg', 'asst1690545188.jpg', NULL, '195.18 KB', '1280 x 853 pixels', '2023-07-28 05:53:08', '2023-07-28 05:53:08', 'web', 5),
(713, 'ae9bae263ed27be66a775eff13e603c5.jpg', 'ae9bae263ed27be66a775eff13e603c51690577037.jpg', NULL, '39.07 KB', '1024 x 682 pixels', '2023-07-28 14:43:58', '2023-07-28 14:43:58', 'web', 2),
(714, 'Perfocal_17-11-2019_TYWFAQ_100_standard-3.jpg', 'perfocal-17-11-2019-tywfaq-100-standard-31690577037.jpg', NULL, '192.57 KB', '2000 x 1334 pixels', '2023-07-28 14:43:58', '2023-07-28 14:43:58', 'web', 2),
(715, 'pngtree-company-profile-corporate-culture-exhibition-board-display-poster-material-image_131622.jpg', 'pngtree-company-profile-corporate-culture-exhibition-board-display-poster-material-image-1316221690577532.jpg', NULL, '76.36 KB', '714 x 260 pixels', '2023-07-28 14:52:12', '2023-07-28 14:52:12', 'web', 2),
(716, 'ae9bae263ed27be66a775eff13e603c5.jpg', 'ae9bae263ed27be66a775eff13e603c51690578104.jpg', NULL, '39.07 KB', '1024 x 682 pixels', '2023-07-28 15:01:45', '2023-07-28 15:01:45', 'web', 2),
(717, 'hero-homepage.jpg', 'hero-homepage1690578106.jpg', NULL, '629.08 KB', '2000 x 975 pixels', '2023-07-28 15:01:46', '2023-07-28 15:01:46', 'web', 2),
(718, 'home2.jpg', 'home21690578107.jpg', NULL, '84.02 KB', '960 x 604 pixels', '2023-07-28 15:01:47', '2023-07-28 15:01:47', 'web', 2),
(719, 'Homepage-Hero-2.jpg', 'homepage-hero-21690578108.jpg', NULL, '48.42 KB', '1240 x 401 pixels', '2023-07-28 15:01:49', '2023-07-28 15:01:49', 'web', 2),
(720, 'home-move1.jpg', 'home-move11690578110.jpg', NULL, '293.55 KB', '1400 x 625 pixels', '2023-07-28 15:01:51', '2023-07-28 15:01:51', 'web', 2),
(721, 'moving-box-removalist_54210892b12.jpg', 'moving-box-removalist-54210892b121690578111.jpg', NULL, '372.4 KB', '2000 x 1500 pixels', '2023-07-28 15:01:52', '2023-07-28 15:01:52', 'web', 2),
(722, 'Perfocal_17-11-2019_TYWFAQ_100_standard-3.jpg', 'perfocal-17-11-2019-tywfaq-100-standard-31690578112.jpg', NULL, '192.57 KB', '2000 x 1334 pixels', '2023-07-28 15:01:53', '2023-07-28 15:01:53', 'web', 2),
(723, 'pngtree-company-profile-corporate-culture-exhibition-board-display-poster-material-image_131622.jpg', 'pngtree-company-profile-corporate-culture-exhibition-board-display-poster-material-image-1316221690578114.jpg', NULL, '76.36 KB', '714 x 260 pixels', '2023-07-28 15:01:55', '2023-07-28 15:01:55', 'web', 2),
(724, '100hmo.jpg', '100hmo1690578194.jpg', NULL, '113.46 KB', '1024 x 683 pixels', '2023-07-28 15:03:14', '2023-07-28 15:03:14', 'web', 2),
(725, '1.jpg', '11690578459.jpg', NULL, '24.01 KB', '612 x 314 pixels', '2023-07-28 15:07:39', '2023-07-28 15:07:39', 'web', 2),
(726, 'electrician-standing-with-paper-folder_23-2147743084.jpg', 'electrician-standing-with-paper-folder-23-21477430841690578459.jpg', NULL, '86.22 KB', '624 x 417 pixels', '2023-07-28 15:07:39', '2023-07-28 15:07:39', 'web', 2),
(727, 'istockphoto-944907568-612x612.jpg', 'istockphoto-944907568-612x6121690578461.jpg', NULL, '32.71 KB', '612 x 408 pixels', '2023-07-28 15:07:41', '2023-07-28 15:07:41', 'web', 2),
(728, 'istockphoto-1189116152-612x612.jpg', 'istockphoto-1189116152-612x6121690578461.jpg', NULL, '30.74 KB', '612 x 408 pixels', '2023-07-28 15:07:41', '2023-07-28 15:07:41', 'web', 2),
(729, 'What-Qualities-Should-a-Professional-Electrician-Posses-_-Electrician-in-Myrtle-Beach-SC-1024x683.jpg', 'what-qualities-should-a-professional-electrician-posses-electrician-in-myrtle-beach-sc-1024x6831690578464.jpg', NULL, '133.11 KB', '1024 x 683 pixels', '2023-07-28 15:07:44', '2023-07-28 15:07:44', 'web', 2),
(730, 'f00.jpg', 'f001690578859.jpg', NULL, '34.11 KB', '962 x 641 pixels', '2023-07-28 15:14:19', '2023-07-28 15:14:19', 'web', 2),
(731, 'f1.jpg', 'f11690578859.jpg', NULL, '65.99 KB', '800 x 474 pixels', '2023-07-28 15:14:20', '2023-07-28 15:14:20', 'web', 2),
(732, 'f4.jpg', 'f41690578862.jpg', NULL, '96.92 KB', '800 x 474 pixels', '2023-07-28 15:14:22', '2023-07-28 15:14:22', 'web', 2),
(733, 'f2.jpg', 'f21690578862.jpg', NULL, '172.59 KB', '1800 x 1078 pixels', '2023-07-28 15:14:23', '2023-07-28 15:14:23', 'web', 2),
(734, 'f6.jpg', 'f61690578864.jpg', NULL, '62.25 KB', '800 x 475 pixels', '2023-07-28 15:14:24', '2023-07-28 15:14:24', 'web', 2),
(735, 'f5.jpg', 'f51690578864.jpg', NULL, '88.82 KB', '1200 x 801 pixels', '2023-07-28 15:14:25', '2023-07-28 15:14:25', 'web', 2),
(736, 'f7.jpg', 'f71690578866.jpg', NULL, '76.5 KB', '800 x 474 pixels', '2023-07-28 15:14:26', '2023-07-28 15:14:26', 'web', 2),
(737, 'f9.jpg', 'f91690578866.jpg', NULL, '62.09 KB', '998 x 649 pixels', '2023-07-28 15:14:26', '2023-07-28 15:14:26', 'web', 2),
(738, 'f98.jpg', 'f981690578869.jpg', NULL, '43.98 KB', '626 x 417 pixels', '2023-07-28 15:14:29', '2023-07-28 15:14:29', 'web', 2),
(739, 'car2.jpg', 'car21690579136.jpg', NULL, '92.07 KB', '1600 x 900 pixels', '2023-07-28 15:18:57', '2023-07-28 15:18:57', 'web', 2),
(740, 'car-1.jpg', 'car-11690579138.jpg', NULL, '452.96 KB', '848 x 469 pixels', '2023-07-28 15:18:58', '2023-07-28 15:18:58', 'web', 2),
(741, 'hair-1.jpeg', 'hair-11690579384.jpeg', NULL, '98.17 KB', '1000 x 667 pixels', '2023-07-28 15:23:05', '2023-07-28 15:23:05', 'web', 2),
(742, 'hair-22.jpg', 'hair-221690579385.jpg', NULL, '165.19 KB', '533 x 350 pixels', '2023-07-28 15:23:05', '2023-07-28 15:23:05', 'web', 2),
(743, 'hair-33.jpg', 'hair-331690579390.jpg', NULL, '1.25 MB', '6720 x 4200 pixels', '2023-07-28 15:23:18', '2023-07-28 15:23:18', 'web', 2),
(744, 'message 2.jpg', 'message-21690579648.jpg', NULL, '27.89 KB', '650 x 433 pixels', '2023-07-28 15:27:28', '2023-07-28 15:27:28', 'web', 2),
(745, 'message 1.jpg', 'message-11690579648.jpg', NULL, '122.36 KB', '1568 x 939 pixels', '2023-07-28 15:27:28', '2023-07-28 15:27:28', 'web', 2),
(746, 'download.png', 'download1690580199.png', NULL, '4.8 KB', '224 x 225 pixels', '2023-07-28 15:36:39', '2023-07-28 15:36:39', 'web', 2),
(747, '963000.jpg', '9630001690581661.jpg', NULL, '44.25 KB', '632 x 551 pixels', '2023-07-28 16:01:02', '2023-07-28 16:01:02', 'web', 4),
(748, 'stripe-logo-white-on-blue.png', 'stripe-logo-white-on-blue1690616213.png', NULL, '36.08 KB', '1600 x 1200 pixels', '2023-07-29 01:36:54', '2023-07-29 01:36:54', 'admin', 22),
(749, 'og-image-mollie.png', 'og-image-mollie1690616278.png', NULL, '6.32 KB', '1200 x 630 pixels', '2023-07-29 01:37:58', '2023-07-29 01:37:58', 'admin', 22),
(750, '3d-wall-painting.jpg', '3d-wall-painting1690618139.jpg', NULL, '58.46 KB', '640 x 437 pixels', '2023-07-29 02:08:59', '2023-07-29 02:08:59', 'admin', 22),
(751, '4D2E746500000578-0-image-a-37_1528894797290.jpg', '4d2e746500000578-0-image-a-37-15288947972901690618140.jpg', NULL, '311.04 KB', '1908 x 1146 pixels', '2023-07-29 02:09:01', '2023-07-29 02:09:01', 'admin', 22),
(752, '1588849616216.png', '15888496162161690618143.png', NULL, '50.54 KB', '1056 x 720 pixels', '2023-07-29 02:09:03', '2023-07-29 02:09:03', 'admin', 22),
(753, 'ac-repair-services.jpg', 'ac-repair-services1690618145.jpg', NULL, '89.65 KB', '861 x 451 pixels', '2023-07-29 02:09:05', '2023-07-29 02:09:05', 'admin', 22),
(754, 'AC-Service-AC-Repair-AC-Maintenance-Dubai.jpg', 'ac-service-ac-repair-ac-maintenance-dubai1690618147.jpg', NULL, '133.89 KB', '1024 x 597 pixels', '2023-07-29 02:09:07', '2023-07-29 02:09:07', 'admin', 22),
(755, '117575-digital-art-mountains-landscape-colorful.png', '117575-digital-art-mountains-landscape-colorful1690618147.png', NULL, '4.56 MB', '1920 x 1080 pixels', '2023-07-29 02:09:08', '2023-07-29 02:09:08', 'admin', 22),
(756, 'CarService1-1.jpg', 'carservice1-11690618149.jpg', NULL, '267.54 KB', '800 x 533 pixels', '2023-07-29 02:09:09', '2023-07-29 02:09:09', 'admin', 22),
(757, 'covid-bookindustry-index-1589296234.jpg', 'covid-bookindustry-index-15892962341690618150.jpg', NULL, '76.88 KB', '1200 x 600 pixels', '2023-07-29 02:09:10', '2023-07-29 02:09:10', 'admin', 22),
(758, 'download.png', 'download1690618150.png', NULL, '6.98 KB', '275 x 183 pixels', '2023-07-29 02:09:10', '2023-07-29 02:09:10', 'admin', 22),
(759, 'istockphoto-1353185042-612x612.jpg', 'istockphoto-1353185042-612x6121690618153.jpg', NULL, '22.89 KB', '612 x 612 pixels', '2023-07-29 02:09:13', '2023-07-29 02:09:13', 'admin', 22),
(760, 'image-wr-180312-report-image-3-12-18FiveKeyWaysToImproveFoodAndBeveragePartVMAGNAN-Full.png', 'image-wr-180312-report-image-3-12-18fivekeywaystoimprovefoodandbeveragepartvmagnan-full1690618154.png', NULL, '674.36 KB', '1600 x 900 pixels', '2023-07-29 02:09:15', '2023-07-29 02:09:15', 'admin', 22),
(761, 'jsw-header-illustrations---v3.png', 'jsw-header-illustrations-v31690618155.png', NULL, '230.21 KB', '1786 x 1023 pixels', '2023-07-29 02:09:16', '2023-07-29 02:09:16', 'admin', 22),
(762, 'mechanic_with_customer.jpeg', 'mechanic-with-customer1690618157.jpeg', NULL, '83.1 KB', '850 x 567 pixels', '2023-07-29 02:09:17', '2023-07-29 02:09:17', 'admin', 22),
(763, 'painting-outdoors-illustration-with-someone-who-paints-using-easel-canvas-brushes-watercolor_2175-3968.jpg', 'painting-outdoors-illustration-with-someone-who-paints-using-easel-canvas-brushes-watercolor-2175-39681690618157.jpg', NULL, '14.07 KB', '360 x 253 pixels', '2023-07-29 02:09:17', '2023-07-29 02:09:17', 'admin', 22),
(764, '1000_F_192576735_k9seNT5u2o56K0adB0uR5WEaEJOq8Uai.jpg', '1000-f-192576735-k9sent5u2o56k0adb0ur5weaejoq8uai1690619160.jpg', NULL, '246.38 KB', '1000 x 667 pixels', '2023-07-29 02:26:01', '2023-07-29 02:26:01', 'admin', 22),
(765, 'How-to-Start-Your-Own-Mobile-Service-Center-business-in-India-from-Basic.png', 'how-to-start-your-own-mobile-service-center-business-in-india-from-basic1690619161.png', NULL, '267.88 KB', '1000 x 667 pixels', '2023-07-29 02:26:01', '2023-07-29 02:26:01', 'admin', 22),
(766, 'mobile-testing_service.jpg', 'mobile-testing-service1690619162.jpg', NULL, '73.61 KB', '350 x 300 pixels', '2023-07-29 02:26:02', '2023-07-29 02:26:02', 'admin', 22),
(767, 'Screenshot_20230722_105340_com.novatikgames.mInicarsv3.jpg.jpg', 'screenshot-20230722-105340-comnovatikgamesminicarsv3jpg1690638369.jpg', NULL, '867.44 KB', '2340 x 1080 pixels', '2023-07-29 07:46:10', '2023-07-29 07:46:10', 'web', NULL),
(768, 'IMG-20230723-WA0000.jpg.jpg', 'img-20230723-wa0000jpg1690705463.jpg', NULL, '100.58 KB', '768 x 1024 pixels', '2023-07-30 02:24:23', '2023-07-30 02:24:23', 'web', NULL),
(769, 'Screenshot_20230712_125123_Via.jpg', 'screenshot-20230712-125123-via1690721147.jpg', NULL, '103.38 KB', '691 x 1198 pixels', '2023-07-30 06:45:47', '2023-07-30 06:45:47', 'admin', 22),
(770, 'image20 ققق.jpg', 'image20-kkk1690774047.jpg', NULL, '3.32 MB', '4000 x 1846 pixels', '2023-07-30 21:27:29', '2023-07-30 21:27:29', 'web', NULL),
(771, 'igor photo.png.jpg', 'igor-photopng1690807365.jpg', NULL, '354.53 KB', '321 x 561 pixels', '2023-07-31 06:42:45', '2023-07-31 06:42:45', 'web', NULL),
(772, 'image20house cleaning special offer.jpg', 'image20house-cleaning-special-offer1690887129.jpg', NULL, '79.33 KB', '1920 x 1920 pixels', '2023-08-01 04:52:10', '2023-08-01 04:52:10', 'web', NULL),
(773, 'galleryimage20house cleaning special offer.jpg', 'galleryimage20house-cleaning-special-offer1690887130.jpg', NULL, '79.33 KB', '1920 x 1920 pixels', '2023-08-01 04:52:11', '2023-08-01 04:52:11', 'web', NULL),
(774, 'image20house cleaning special offer.jpg', 'image20house-cleaning-special-offer1690888736.jpg', NULL, '79.33 KB', '1920 x 1920 pixels', '2023-08-01 05:18:57', '2023-08-01 05:18:57', 'web', NULL),
(775, 'galleryimage20house cleaning special offer.jpg', 'galleryimage20house-cleaning-special-offer1690888737.jpg', NULL, '79.33 KB', '1920 x 1920 pixels', '2023-08-01 05:18:58', '2023-08-01 05:18:58', 'web', NULL),
(776, 'mode.png', 'mode1690989501.png', NULL, '804.76 KB', '1600 x 1688 pixels', '2023-08-02 09:18:22', '2023-08-02 09:18:22', 'web', 1),
(777, 'BOX.png', 'box1690989549.png', NULL, '597.47 KB', '1600 x 1688 pixels', '2023-08-02 09:19:10', '2023-08-02 09:19:10', 'web', 1),
(778, 'BOITE01.png', 'boite011690989551.png', NULL, '1.45 MB', '1600 x 1688 pixels', '2023-08-02 09:19:12', '2023-08-02 09:19:12', 'web', 1),
(779, 'Fitness (1).png', 'fitness-11690989553.png', NULL, '1.14 MB', '1600 x 1688 pixels', '2023-08-02 09:19:15', '2023-08-02 09:19:15', 'web', 1),
(781, 'sturm.PNG', 'sturm1691149632.PNG', NULL, '55.32 KB', '159 x 284 pixels', '2023-08-04 05:47:12', '2023-08-04 05:47:12', 'web', 5),
(782, 'Comercio_electronico.jpg', 'comercio-electronico1691344853.jpg', NULL, '36.54 KB', '630 x 420 pixels', '2023-08-06 12:00:54', '2023-10-02 21:56:14', 'web', 1),
(783, 'cloud-3406627_1280-1024x682.jpg', 'cloud-3406627-1280-1024x6821691344933.jpg', NULL, '44.63 KB', '1024 x 682 pixels', '2023-08-06 12:02:13', '2023-08-06 12:02:13', 'web', 1),
(784, 'Wallpaper.jpg.jpg', 'wallpaperjpg1691506279.jpg', NULL, '573.95 KB', '1080 x 1920 pixels', '2023-08-08 08:51:19', '2023-08-08 08:51:19', 'web', NULL),
(785, 'image10electrical service .jpg', 'image10electrical-service1691508382.jpg', NULL, '70.33 KB', '894 x 794 pixels', '2023-08-08 09:26:22', '2023-08-08 09:26:22', 'web', NULL),
(786, 'galleryimage10electrical service .jpg', 'galleryimage10electrical-service1691508382.jpg', NULL, '70.33 KB', '894 x 794 pixels', '2023-08-08 09:26:22', '2023-08-08 09:26:22', 'web', NULL),
(787, 'IMG_3200.JPG.jpg', 'img-3200jpg1691516812.jpg', NULL, '2 MB', '3264 x 2448 pixels', '2023-08-08 11:46:54', '2023-08-08 11:46:54', 'web', NULL),
(788, 'chatnet_app_192.png', 'chatnet-app-1921691618406.png', NULL, '28.67 KB', '500 x 500 pixels', '2023-08-09 16:00:06', '2023-08-09 16:00:06', 'admin', 22),
(789, '[removal.ai]_5e6d0307-c09b-4cf2-b80f-2d02ae85b076-black-elegant-initial-photography-logo.png', 'removalai-5e6d0307-c09b-4cf2-b80f-2d02ae85b076-black-elegant-initial-photography-logo1691618420.png', NULL, '6.76 KB', '475 x 475 pixels', '2023-08-09 16:00:20', '2023-08-09 16:00:20', 'admin', 22),
(790, 'large-grid-young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-1916437092061690180601 (1).png', 'large-grid-young-beautiful-cleaner-woman-holding-bucket-with-products-pointing-camera-against-blue-backdrop-1916437092061690180601-11691620789.png', NULL, '53.4 KB', '768 x 522 pixels', '2023-08-09 16:39:50', '2023-08-09 16:39:50', 'admin', 22),
(791, 'image11syhs.jpg', 'image11syhs1691630962.jpg', NULL, '48.42 KB', '1152 x 532 pixels', '2023-08-09 19:29:22', '2023-08-09 19:29:22', 'web', NULL),
(792, '360_F_410726461_FDpDfV4DBgKZDMHUkAXRbTQ5PmkkrGlx.jpg', '360-f-410726461-fdpdfv4dbgkzdmhukaxrbtq5pmkkrglx1691858199.jpg', NULL, '12.11 KB', '533 x 360 pixels', '2023-08-12 10:36:39', '2023-08-12 10:36:39', 'web', 1),
(793, '332492024_566307205439970_3463679327432228346_n.jpg', '332492024-566307205439970-3463679327432228346-n1691858237.jpg', NULL, '40.47 KB', '720 x 692 pixels', '2023-08-12 10:37:17', '2023-08-12 10:37:45', 'web', 1),
(794, 'b1fb1c00-f348-448c-a59d-2f7d2693f445.jpg', 'b1fb1c00-f348-448c-a59d-2f7d2693f4451691912527.jpg', NULL, '38.08 KB', '1125 x 1080 pixels', '2023-08-13 01:42:08', '2023-08-13 01:42:08', 'web', 1),
(795, 'IMG_20230813_201854.jpg.jpg', 'img-20230813-201854jpg1691961239.jpg', NULL, '1.35 MB', '1520 x 3264 pixels', '2023-08-13 15:14:02', '2023-08-13 15:14:02', 'web', NULL),
(796, '371f21f72d6621c7e530f10c767a5497.jpg', '371f21f72d6621c7e530f10c767a54971692049006.jpg', NULL, '296.35 KB', '1930 x 1200 pixels', '2023-08-14 15:36:47', '2023-08-14 15:36:47', 'admin', 22),
(797, 'IMG-20230815-WA0008.jpg.jpg', 'img-20230815-wa0008jpg1692111725.jpg', NULL, '174 KB', '1200 x 1599 pixels', '2023-08-15 09:02:05', '2023-08-15 09:02:05', 'web', NULL),
(798, '1000002249.jpg.jpg', '1000002249jpg1692223314.jpg', NULL, '903.75 KB', '1080 x 2400 pixels', '2023-08-16 16:01:56', '2023-08-16 16:01:56', 'web', NULL),
(799, 'image46hagags.jpg', 'image46hagags1692506675.jpg', NULL, '15.7 KB', '512 x 512 pixels', '2023-08-19 22:44:35', '2023-08-19 22:44:35', 'web', NULL),
(800, 'nidImageInstance of \'XFile\'.jpg', 'nidimageinstance-of-xfile1692529110.jpg', NULL, '128.14 KB', '1032 x 581 pixels', '2023-08-20 04:58:31', '2023-08-20 04:58:31', 'web', NULL),
(801, 'addressImageInstance of \'XFile\'.jpg', 'addressimageinstance-of-xfile1692529111.jpg', NULL, '128.14 KB', '1032 x 581 pixels', '2023-08-20 04:58:31', '2023-08-20 04:58:31', 'web', NULL),
(802, 'nidImageInstance of \'XFile\'.jpg', 'nidimageinstance-of-xfile1692529392.jpg', NULL, '30.57 KB', '1024 x 688 pixels', '2023-08-20 05:03:12', '2023-08-20 05:03:12', 'web', NULL),
(803, 'addressImageInstance of \'XFile\'.jpg', 'addressimageinstance-of-xfile1692529392.jpg', NULL, '29.53 KB', '527 x 486 pixels', '2023-08-20 05:03:12', '2023-08-20 05:03:12', 'web', NULL),
(804, 'nidImageInstance of \'XFile\'.jpg', 'nidimageinstance-of-xfile1692533204.jpg', NULL, '2.23 MB', '1800 x 4000 pixels', '2023-08-20 06:06:47', '2023-08-20 06:06:47', 'web', NULL),
(805, 'addressImageInstance of \'XFile\'.jpg', 'addressimageinstance-of-xfile1692533207.jpg', NULL, '30.57 KB', '1024 x 688 pixels', '2023-08-20 06:06:47', '2023-08-20 06:06:47', 'web', NULL),
(806, 'IMG_20230820_183226.jpg.jpg', 'img-20230820-183226jpg1692545600.jpg', NULL, '1.83 MB', '3120 x 4160 pixels', '2023-08-20 09:33:24', '2023-08-20 09:33:24', 'web', NULL),
(807, 'IMG-20230220-WA0001.jpg.jpg', 'img-20230220-wa0001jpg1692650415.jpg', NULL, '122.91 KB', '1280 x 960 pixels', '2023-08-21 14:40:16', '2023-08-21 14:40:16', 'web', NULL),
(808, 'image20affordable cleaning.jpg', 'image20affordable-cleaning1692664360.jpg', NULL, '2.26 MB', '3472 x 3472 pixels', '2023-08-21 18:32:44', '2023-08-21 18:32:44', 'web', NULL),
(809, 'galleryimage20affordable cleaning.jpg', 'galleryimage20affordable-cleaning1692664364.jpg', NULL, '2.26 MB', '3472 x 3472 pixels', '2023-08-21 18:32:47', '2023-08-21 18:32:47', 'web', NULL),
(810, 'IMG-20210707-WA0000.jpg.jpg', 'img-20210707-wa0000jpg1692774848.jpg', NULL, '61.01 KB', '768 x 1024 pixels', '2023-08-23 01:14:08', '2023-08-23 01:14:08', 'web', NULL),
(812, 'image11selly.jpg', 'image11selly1693248327.jpg', NULL, '2.12 MB', '2128 x 4608 pixels', '2023-08-28 12:45:30', '2023-08-28 12:45:30', 'web', NULL),
(813, '1000072777.jpg.jpg', '1000072777jpg1693262595.jpg', NULL, '754.03 KB', '2400 x 1080 pixels', '2023-08-28 16:43:16', '2023-08-28 16:43:16', 'web', NULL),
(814, 'IMG-20230822-WA0000.jpg.jpg', 'img-20230822-wa0000jpg1693294687.jpg', NULL, '16.06 KB', '720 x 577 pixels', '2023-08-29 01:38:08', '2023-08-29 01:38:08', 'web', NULL),
(815, 'IMG-20230822-WA0000.jpg.jpg', 'img-20230822-wa0000jpg1693295885.jpg', NULL, '16.06 KB', '720 x 577 pixels', '2023-08-29 01:58:05', '2023-08-29 01:58:05', 'web', NULL),
(816, 'image10Ac Repair In 399.jpg', 'image10ac-repair-in-3991693299613.jpg', NULL, '291.22 KB', '1594 x 1594 pixels', '2023-08-29 03:00:14', '2023-08-29 03:00:14', 'web', NULL),
(817, 'galleryimage10Ac Repair In 399.jpg', 'galleryimage10ac-repair-in-3991693299614.jpg', NULL, '291.22 KB', '1594 x 1594 pixels', '2023-08-29 03:00:15', '2023-08-29 03:00:15', 'web', NULL),
(818, '61rSgGkjLAL._AC_SX679_.jpg', '61rsggkjlal-ac-sx6791693486218.jpg', NULL, '37.73 KB', '679 x 632 pixels', '2023-08-31 06:50:18', '2023-08-31 06:50:18', 'web', 1),
(819, '20230831_114112.jpg.jpg', '20230831-114112jpg1693655239.jpg', NULL, '2.99 MB', '4032 x 3024 pixels', '2023-09-02 05:47:24', '2023-09-02 05:47:24', 'web', NULL),
(820, 'image11testing market .jpg', 'image11testing-market1694252576.jpg', NULL, '165.81 KB', '1200 x 628 pixels', '2023-09-09 03:42:56', '2023-09-09 03:42:56', 'web', NULL),
(821, '26-05-2022.jpg', '26-05-20221694331009.jpg', NULL, '45.61 KB', '800 x 392 pixels', '2023-09-10 01:30:09', '2023-09-10 01:30:35', 'web', 1),
(822, 'image11mobil servis .jpg', 'image11mobil-servis1694640536.jpg', NULL, '7.38 MB', '3000 x 4000 pixels', '2023-09-13 15:29:00', '2023-09-13 15:29:00', 'web', NULL),
(823, 'galleryimage11mobil servis .jpg', 'galleryimage11mobil-servis1694640542.jpg', NULL, '7.38 MB', '3000 x 4000 pixels', '2023-09-13 15:29:07', '2023-09-13 15:29:07', 'web', NULL),
(824, '1000371021.jpg.jpg', '1000371021jpg1694864888.jpg', NULL, '7.09 MB', '4096 x 3072 pixels', '2023-09-16 05:48:12', '2023-09-16 05:48:12', 'web', NULL),
(825, 'image50abc.jpg', 'image50abc1694870879.jpg', NULL, '382.23 KB', '720 x 1612 pixels', '2023-09-16 07:27:59', '2023-09-16 07:27:59', 'web', NULL),
(826, 'galleryimage50abc.jpg', 'galleryimage50abc1694870879.jpg', NULL, '382.23 KB', '720 x 1612 pixels', '2023-09-16 07:28:00', '2023-09-16 07:28:00', 'web', NULL),
(829, 'free.png', 'free1694935074.png', NULL, '401.3 KB', '628 x 610 pixels', '2023-09-17 01:17:55', '2023-09-17 01:17:55', 'web', 1),
(832, 'addressImageInstance of \'XFile\'.jpg', 'addressimageinstance-of-xfile1695356596.jpg', NULL, '4.22 MB', '4000 x 2250 pixels', '2023-09-21 22:23:19', '2023-09-21 22:23:19', 'web', NULL),
(833, 'professional1.png', 'professional11695493779.png', NULL, '135.63 KB', '2957 x 1440 pixels', '2023-09-23 12:29:40', '2023-09-23 12:29:40', 'web', 1),
(840, 'image11ggsgs.jpg', 'image11ggsgs1695728196.jpg', NULL, '160.14 KB', '1080 x 2400 pixels', '2023-09-26 05:36:37', '2023-09-26 05:36:37', 'web', NULL),
(842, 'shutterstock_2056414424.jpg', 'shutterstock-20564144241695734364.jpg', NULL, '3.04 MB', '5120 x 2880 pixels', '2023-09-26 07:19:30', '2023-09-26 07:19:30', 'web', 1),
(844, '20230930_082634.jpg.jpg', '20230930-082634jpg1696030190.jpg', NULL, '1 MB', '4000 x 2252 pixels', '2023-09-29 17:29:52', '2023-09-29 17:29:52', 'web', NULL),
(845, 'image11Test - electro.jpg', 'image11test-electro1696086566.jpg', NULL, '3.52 MB', '4032 x 3024 pixels', '2023-09-30 09:09:30', '2023-09-30 09:09:30', 'web', NULL),
(847, 'image70test digital marketing.jpg', 'image70test-digital-marketing1696856574.jpg', NULL, '2.31 MB', '4032 x 3024 pixels', '2023-10-09 07:02:58', '2023-10-09 07:02:58', 'web', NULL),
(848, 'galleryimage70test digital marketing.jpg', 'galleryimage70test-digital-marketing1696856578.jpg', NULL, '2.31 MB', '4032 x 3024 pixels', '2023-10-09 07:03:02', '2023-10-09 07:03:02', 'web', NULL),
(849, 'image70test digital marketing.jpg', 'image70test-digital-marketing1696856884.jpg', NULL, '2.31 MB', '4032 x 3024 pixels', '2023-10-09 07:08:08', '2023-10-09 07:08:08', 'web', NULL),
(850, 'galleryimage70test digital marketing.jpg', 'galleryimage70test-digital-marketing1696856888.jpg', NULL, '2.31 MB', '4032 x 3024 pixels', '2023-10-09 07:08:12', '2023-10-09 07:08:12', 'web', NULL),
(858, 'R (1).jpg', 'r-11697955219.jpg', NULL, '53.94 KB', '300 x 300 pixels', '2023-10-22 00:13:39', '2023-10-22 00:13:39', 'web', 5),
(859, 'gettyimages-1212153411.jpg__640x439_q85_crop_subsampling-2_upscale.jpg', 'gettyimages-1212153411jpg-640x439-q85-crop-subsampling-2-upscale1697956383.jpg', NULL, '32.7 KB', '640 x 439 pixels', '2023-10-22 00:33:03', '2023-10-22 00:33:03', 'admin', 22),
(860, '106975776-1637011374555-gettyimages-1222642927-kim_3920.jpeg', '106975776-1637011374555-gettyimages-1222642927-kim-39201697956383.jpeg', NULL, '35.81 KB', '929 x 523 pixels', '2023-10-22 00:33:03', '2023-10-22 00:33:03', 'admin', 22),
(862, 'AdobeStock_145045985.webp', 'adobestock-1450459851697956385.webp', NULL, '78.08 KB', '1200 x 800 pixels', '2023-10-22 00:33:05', '2023-10-22 00:33:05', 'admin', 22),
(863, '20191127190639-shutterstock-431848417-crop.jpeg', '20191127190639-shutterstock-431848417-crop1697956745.jpeg', NULL, '213.91 KB', '2000 x 1333 pixels', '2023-10-22 00:39:05', '2023-10-22 00:39:05', 'admin', 22),
(865, '1674547165434.jpg', '16745471654341697957166.jpg', NULL, '137.8 KB', '1080 x 720 pixels', '2023-10-22 00:46:06', '2023-10-22 00:46:06', 'admin', 22),
(866, 'BLOG-engagement-zones-4050388.jpg', 'blog-engagement-zones-40503881697957174.jpg', NULL, '119.37 KB', '1280 x 853 pixels', '2023-10-22 00:46:14', '2023-10-22 00:46:14', 'admin', 22),
(867, 'austin-distel-gUIJ0YszPig-unsplash-scaled.webp', 'austin-distel-guij0yszpig-unsplash-scaled1697957175.webp', NULL, '303.01 KB', '2560 x 1707 pixels', '2023-10-22 00:46:16', '2023-10-22 00:46:16', 'admin', 22),
(868, '106975776-1637011374555-gettyimages-1222642927-kim_3920.jpeg', '106975776-1637011374555-gettyimages-1222642927-kim-39201697957474.jpeg', NULL, '35.81 KB', '929 x 523 pixels', '2023-10-22 00:51:14', '2023-10-22 00:51:14', 'web', 5),
(870, 'Letter-of-Appeal-for-College.png', 'letter-of-appeal-for-college1697958679.png', NULL, '219.74 KB', '900 x 600 pixels', '2023-10-22 01:11:19', '2023-10-22 01:11:19', 'web', 5),
(871, 'T1-1.png', 't1-11697958903.png', NULL, '113.58 KB', '600 x 400 pixels', '2023-10-22 01:15:04', '2023-10-22 01:15:04', 'web', 5),
(872, 'hero_financial_advisory_services_723_0_1811_600.jpg', 'hero-financial-advisory-services-723-0-1811-6001697959134.jpg', NULL, '78.58 KB', '1088 x 600 pixels', '2023-10-22 01:18:54', '2023-10-22 01:18:54', 'web', 5),
(875, 'rog.jpg', 'rog1698086381.jpg', NULL, '1.17 MB', '1920 x 1080 pixels', '2023-10-23 12:39:42', '2023-10-23 12:48:14', 'web', 1),
(879, 'IMG_20231029_100748_586.jpg', 'img-20231029-100748-5861698890918.jpg', NULL, '4.27 MB', '2992 x 4000 pixels', '2023-11-01 20:08:41', '2023-11-01 20:08:41', 'web', 5),
(880, 'image70Book Now.jpg', 'image70book-now1699280700.jpg', NULL, '2.67 MB', '1600 x 2000 pixels', '2023-11-06 08:25:02', '2023-11-06 08:25:02', 'web', NULL);
INSERT INTO `media_uploads` (`id`, `title`, `path`, `alt`, `size`, `dimensions`, `created_at`, `updated_at`, `type`, `user_id`) VALUES
(881, 'image11test 1.jpg', 'image11test-11699524366.jpg', NULL, '5.09 MB', '4000 x 3000 pixels', '2023-11-09 04:06:09', '2023-11-09 04:06:09', 'web', NULL),
(882, 'Sample-jpg-image-10mb.jpg.jpg', 'sample-jpg-image-10mbjpg1699526186.jpg', NULL, '10.02 MB', '7724 x 5148 pixels', '2023-11-09 04:36:37', '2023-11-09 04:36:37', 'web', NULL),
(884, 'Screenshot 2023-10-13 183435.png.jpg', 'screenshot-2023-10-13-183435png1700005545.jpg', NULL, '2.52 MB', '2053 x 1115 pixels', '2023-11-14 17:45:47', '2023-11-14 17:45:47', 'web', NULL),
(885, 'image20house cleaning .jpg', 'image20house-cleaning1700047379.jpg', NULL, '14.77 MB', '7200 x 5400 pixels', '2023-11-15 05:23:10', '2023-11-15 05:23:10', 'web', NULL),
(886, 'galleryimage20house cleaning .jpg', 'galleryimage20house-cleaning1700047390.jpg', NULL, '14.77 MB', '7200 x 5400 pixels', '2023-11-15 05:23:21', '2023-11-15 05:23:21', 'web', NULL),
(887, 'image20cleaning .jpg', 'image20cleaning1700139863.jpg', NULL, '14.77 MB', '7200 x 5400 pixels', '2023-11-16 07:04:36', '2023-11-16 07:04:36', 'web', NULL),
(891, 'image35mopping.jpg', 'image35mopping1700480640.jpg', NULL, '8.68 MB', '5876 x 3917 pixels', '2023-11-20 05:44:08', '2023-11-20 05:44:08', 'web', NULL),
(892, 'galleryimage35mopping.jpg', 'galleryimage35mopping1700480648.jpg', NULL, '8.68 MB', '5876 x 3917 pixels', '2023-11-20 05:44:16', '2023-11-20 05:44:16', 'web', NULL),
(893, 'new-banner11690466439-11700110845.png', 'new-banner11690466439-117001108451700743483.png', NULL, '184.29 KB', '280 x 408 pixels', '2023-11-23 06:44:43', '2023-11-23 06:44:43', 'admin', 22),
(894, 'new-banner116904664391700110845 (1).png', 'new-banner116904664391700110845-11700743483.png', NULL, '171.62 KB', '320 x 400 pixels', '2023-11-23 06:44:43', '2023-11-23 06:44:43', 'admin', 22),
(895, 'consulting-reviewer31690717780.jpg', 'consulting-reviewer316907177801700743564.jpg', NULL, '3.94 KB', '40 x 40 pixels', '2023-11-23 06:46:04', '2023-11-23 06:46:04', 'admin', 22),
(897, 'images-41697441244.jpg', 'images-416974412441700743566.jpg', NULL, '4.41 KB', '150 x 150 pixels', '2023-11-23 06:46:06', '2023-11-23 06:46:06', 'admin', 22),
(901, 'logo.png', 'logo1763153679.png', NULL, '98.77 KB', '500 x 500 pixels', '2025-11-14 18:54:40', '2025-11-14 18:54:40', 'admin', 1),
(902, 'logo.png', 'logo1763153773.png', NULL, '31.67 KB', '250 x 250 pixels', '2025-11-14 18:56:13', '2025-11-14 18:56:13', 'admin', 1),
(903, 'صيانة-منازل-ومباني-دبي-.png', 'syan-mnazl-ombany-dby1763285654.png', NULL, '20.81 KB', '725 x 413 pixels', '2025-11-16 07:34:14', '2025-11-16 07:34:14', 'admin', 1),
(904, 'صيانة-منازل-ومباني-في-أبو-ظبي-2.png', 'syan-mnazl-ombany-fy-abo-thby-21763285671.png', NULL, '14.12 KB', '736 x 479 pixels', '2025-11-16 07:34:31', '2025-11-16 07:34:31', 'admin', 1),
(905, 'ss4.png', 'ss41763287356.png', NULL, '43.8 KB', '875 x 500 pixels', '2025-11-16 08:02:36', '2025-11-16 08:02:36', 'admin', 1),
(906, 'معلم-دهانات1-1.jpg', 'maalm-dhanat1-11763287356.jpg', NULL, '46.69 KB', '1180 x 677 pixels', '2025-11-16 08:02:37', '2025-11-16 08:02:37', 'admin', 1),
(907, '0d2e51_8b9807bbd29b438ea3a621d537812825~mv2.jpeg', '0d2e51-8b9807bbd29b438ea3a621d537812825mv21763287358.jpeg', NULL, '17.84 KB', '747 x 400 pixels', '2025-11-16 08:02:38', '2025-11-16 08:02:38', 'admin', 1),
(908, 'General-Maintenance-2-2-e1688325257203.png', 'general-maintenance-2-2-e16883252572031763287357.png', NULL, '38.39 KB', '800 x 658 pixels', '2025-11-16 08:02:38', '2025-11-16 08:02:38', 'admin', 1),
(909, 'technician-service-removing-air-filter-air-conditioner-cleaning_35076-3618.jpg', 'technician-service-removing-air-filter-air-conditioner-cleaning-35076-36181763287359.jpg', NULL, '51.37 KB', '626 x 417 pixels', '2025-11-16 08:02:39', '2025-11-16 08:02:39', 'admin', 1),
(910, 'سباكم-1.png', 'sbakm-11763287360.png', NULL, '27.67 KB', '650 x 450 pixels', '2025-11-16 08:02:40', '2025-11-16 08:02:40', 'admin', 1),
(911, 'oVSOs0D499GWHuMiawd2i5zU8ABv9Z0Y225Oq3EC.png', 'ovsos0d499gwhumiawd2i5zu8abv9z0y225oq3ec1763287360.png', NULL, '31.32 KB', '550 x 366 pixels', '2025-11-16 08:02:40', '2025-11-16 08:02:40', 'admin', 1),
(912, 'images.jpg', 'images1763287361.jpg', NULL, '8.67 KB', '225 x 225 pixels', '2025-11-16 08:02:41', '2025-11-16 08:02:41', 'admin', 1),
(913, '9703596.png', '97035961763292467.png', NULL, '20.52 KB', '512 x 512 pixels', '2025-11-16 09:27:48', '2025-11-16 09:27:48', 'admin', 1),
(914, 'logo.jpg', 'logo1764970176.jpg', NULL, '142.47 KB', '514 x 462 pixels', '2025-12-05 19:29:36', '2025-12-05 19:29:36', 'admin', 1),
(915, 'Gemini_Generated_Image_kdeoj4kdeoj4kdeo', 'gemini-generated-image-kdeoj4kdeoj4kdeo1765180935.png', 'فريق صيانة تك', '6437115', '2176 x 1952 pixels', '2025-12-08 06:02:15', '2025-12-08 06:02:15', 'admin', NULL),
(916, 'Gemini_Generated_Image_kdeoj4kdeoj4kdeo.png', 'gemini-generated-image-kdeoj4kdeoj4kdeo1765182930.png', NULL, '6.14 MB', '2176 x 1952 pixels', '2025-12-08 06:35:32', '2025-12-08 06:35:32', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `content` longtext DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `content`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Primary Menu', '[{\"pname\":\"الرئيسية\",\"ptype\":\"custom\",\"id\":2,\"antarget\":\"\",\"icon\":\"\",\"purl\":\"@url\",\"children\":[{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{},{}]},{\"ptype\":\"pages\",\"id\":152,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"من نحن\",\"pid\":31},{\"ptype\":\"pages\",\"id\":153,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"خدماتنا\",\"pid\":32,\"children\":[{},{},{},{}]},{\"ptype\":\"pages\",\"id\":198,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"تواصل معنا\",\"pid\":34}]', 'default', '2021-03-24 08:07:56', '2025-11-14 18:52:31'),
(6, 'Useful Links', '[{\"ptype\":\"pages\",\"id\":2,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"\",\"pid\":32},{\"ptype\":\"pages\",\"id\":3,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"\",\"pid\":35},{\"ptype\":\"pages\",\"id\":4,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"\",\"pid\":40},{\"ptype\":\"pages\",\"id\":5,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"\",\"pid\":41},{\"ptype\":\"pages\",\"id\":6,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"\",\"pid\":45}]', '', '2021-03-29 03:27:29', '2023-05-27 06:35:22'),
(7, 'Footer Menu', '[{\"ptype\":\"custom\",\"id\":2,\"antarget\":\"\",\"icon\":\"\",\"pname\":\"Home\",\"purl\":\"@url\"},{\"ptype\":\"pages\",\"id\":3,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"Blog\",\"pid\":26},{\"ptype\":\"pages\",\"id\":4,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"\",\"pid\":20},{\"ptype\":\"pages\",\"id\":5,\"antarget\":\"\",\"icon\":\"\",\"menulabel\":\"\",\"pid\":19}]', NULL, '2021-10-30 03:41:20', '2023-05-27 06:36:03');

-- --------------------------------------------------------

--
-- Table structure for table `meta_data`
--

CREATE TABLE `meta_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meta_taggable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `meta_taggable_type` varchar(191) DEFAULT NULL,
  `meta_title` varchar(191) DEFAULT NULL,
  `meta_tags` varchar(191) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `facebook_meta_tags` varchar(191) DEFAULT NULL,
  `facebook_meta_description` text DEFAULT NULL,
  `facebook_meta_image` varchar(191) DEFAULT NULL,
  `twitter_meta_tags` varchar(191) DEFAULT NULL,
  `twitter_meta_description` text DEFAULT NULL,
  `twitter_meta_image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meta_data`
--

INSERT INTO `meta_data` (`id`, `meta_taggable_id`, `meta_taggable_type`, `meta_title`, `meta_tags`, `meta_description`, `facebook_meta_tags`, `facebook_meta_description`, `facebook_meta_image`, `twitter_meta_tags`, `twitter_meta_description`, `twitter_meta_image`, `created_at`, `updated_at`) VALUES
(25, 36, 'App\\Blog', 'bloghttp://localhost/ozagi/assets/uploads/media-uploader/image-21633150859.jpg', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-10-01 22:56:29', '2021-11-17 17:27:36'),
(26, 37, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-10-01 23:09:43', '2021-11-17 14:13:18'),
(27, 38, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-10-01 23:09:47', '2021-11-17 19:29:27'),
(28, 39, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-10-01 23:09:50', '2021-11-10 06:39:03'),
(29, 40, 'App\\Blog', 'blog dd', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-10-01 23:09:53', '2021-11-17 17:26:41'),
(30, 41, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-10-01 23:09:55', '2021-11-17 14:09:33'),
(31, 42, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-10-01 23:10:00', '2021-10-02 00:15:30'),
(32, 43, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-10-01 23:10:04', '2021-10-01 23:47:51'),
(33, 44, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-10-01 23:10:18', '2021-10-01 23:46:55'),
(34, 45, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-10-01 23:10:21', '2021-10-01 23:30:24'),
(40, 55, 'App\\Blog', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-02 04:57:06', '2021-10-02 04:57:06'),
(41, 56, 'App\\Blog', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-02 04:58:14', '2021-10-02 04:58:14'),
(42, 57, 'App\\Blog', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-02 04:58:25', '2021-10-02 04:58:25'),
(43, 62, 'App\\Blog', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-02 05:01:45', '2021-10-02 05:01:45'),
(44, 64, 'App\\Blog', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-02 05:02:37', '2021-10-02 05:02:37'),
(45, 65, 'App\\Blog', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-02 05:03:02', '2021-10-02 05:03:02'),
(46, 73, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-10-02 05:14:45', '2021-10-02 05:48:52'),
(47, 78, 'App\\Blog', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-02 06:31:08', '2021-10-02 06:31:08'),
(48, 79, 'App\\Blog', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-02 06:31:11', '2021-10-02 06:31:11'),
(52, 83, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-10-02 06:53:28', '2021-10-02 06:53:28'),
(63, 94, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-10-02 23:28:22', '2021-10-02 23:28:22'),
(81, 100, 'App\\Blog', 'sdf', '', 'sdf', '', '', NULL, '', '', NULL, '2021-10-07 06:47:42', '2021-10-07 06:47:42'),
(82, 101, 'App\\Blog', '', '', '', '', '', NULL, '', '', NULL, '2021-10-07 07:01:03', '2021-10-07 07:01:03'),
(83, 102, 'App\\Blog', '', '', '', '', '', NULL, '', '', NULL, '2021-10-07 07:13:00', '2021-10-07 07:13:00'),
(84, 103, 'App\\Blog', '', '', '', '', '', NULL, '', '', NULL, '2021-10-07 07:13:10', '2021-10-07 07:13:10'),
(85, 104, 'App\\Blog', '', '', '', '', '', NULL, '', '', NULL, '2021-10-07 07:14:09', '2021-10-07 07:14:09'),
(87, 105, 'App\\Blog', 'sdfsdfdsf', 'sd', 'sdf', 'sdfsdf', 'sdf', NULL, 'sdf', 'sdf', NULL, '2021-10-11 22:20:01', '2021-10-20 22:24:56'),
(88, 106, 'App\\Blog', 'dfs', 'sfd', 'sdf', '', '', NULL, '', '', NULL, '2021-10-11 22:40:06', '2021-10-20 22:27:16'),
(89, 107, 'App\\Blog', 'sdf', 'sdf', 'sdf', '', '', NULL, '', '', NULL, '2021-10-11 22:47:16', '2021-10-17 23:57:10'),
(91, 109, 'App\\Blog', 'sf', 'sf', 'sdf', '', '', NULL, '', '', NULL, '2021-10-12 05:38:27', '2021-10-20 22:25:26'),
(92, 110, 'App\\Blog', 'dfgdfg', 'dfg', 'dfg', 'dfg', 'dfg', NULL, 'dfg', 'dfg', NULL, '2021-10-13 00:52:59', '2021-10-13 00:52:59'),
(93, 111, 'App\\Blog', 'sdf', 'sdf', 'sdf', '', '', NULL, '', '', NULL, '2021-10-13 01:11:59', '2021-10-13 01:11:59'),
(99, 112, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-10-24 04:05:12', '2021-11-01 08:35:13'),
(100, 113, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-10-24 04:08:21', '2021-11-17 19:21:15'),
(101, 114, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-10-24 04:09:10', '2021-11-17 18:27:59'),
(102, 115, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-10-24 04:11:09', '2021-11-17 19:46:01'),
(103, 116, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-10-24 04:12:11', '2021-11-01 08:33:41'),
(104, 117, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-10-24 05:55:53', '2021-11-14 06:50:39'),
(105, 118, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-10-24 05:56:11', '2021-11-14 06:50:21'),
(106, 119, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-10-24 05:56:14', '2021-11-14 06:49:18'),
(107, 120, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-10-24 05:56:17', '2021-11-08 07:12:23'),
(108, 121, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-10-24 06:11:03', '2021-11-17 18:35:34'),
(109, 122, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-10-24 06:13:24', '2021-11-14 01:01:40'),
(110, 123, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-10-24 06:14:21', '2021-11-14 06:48:58'),
(111, 124, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-10-24 06:15:33', '2021-11-14 06:48:37'),
(112, 125, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-10-24 06:16:41', '2021-11-14 06:48:14'),
(113, 126, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-10-24 06:20:15', '2021-11-17 19:48:15'),
(114, 127, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '213', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '218', '2021-10-24 06:21:15', '2021-11-14 23:44:04'),
(118, 128, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-10-25 01:23:45', '2021-10-25 01:25:55'),
(119, 129, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-10-25 01:29:39', '2021-10-25 01:30:16'),
(120, 130, 'App\\Blog', 'dsf', NULL, '', '', '', NULL, '', '', NULL, '2021-10-25 01:36:10', '2021-10-25 01:36:34'),
(121, 139, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-10-25 04:20:43', '2021-10-27 04:46:22'),
(122, 140, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-10-25 04:21:44', '2021-10-26 06:52:18'),
(123, 141, 'App\\Blog', '', '', '', '', '', NULL, '', '', NULL, '2021-10-25 04:25:03', '2021-10-25 04:25:03'),
(126, 143, 'App\\Blog', '', '', '', '', '', NULL, '', '', NULL, '2021-10-28 03:40:19', '2021-10-28 03:40:19'),
(127, 144, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-10-28 03:44:12', '2021-10-31 01:11:34'),
(128, 145, 'App\\Blog', '', '', '', '', '', NULL, '', '', NULL, '2021-10-28 03:45:29', '2021-10-28 03:45:29'),
(129, 146, 'App\\Blog', '', '', '', '', '', NULL, '', '', NULL, '2021-10-28 03:57:09', '2021-10-28 03:57:09'),
(130, 147, 'App\\Blog', '', '', '', '', '', NULL, '', '', NULL, '2021-10-30 00:14:08', '2021-10-30 00:14:08'),
(131, 148, 'App\\Blog', '', '', '', '', '', NULL, '', '', NULL, '2021-10-30 00:19:41', '2021-10-30 00:19:41'),
(132, 149, 'App\\Blog', '', '', '', '', '', NULL, '', '', NULL, '2021-10-30 00:20:15', '2021-10-30 00:20:15'),
(133, 150, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-10-30 00:23:30', '2021-10-31 03:37:16'),
(137, 151, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-10-31 01:14:40', '2021-11-01 01:26:06'),
(138, 152, 'App\\Blog', '', '', '', '', '', NULL, '', '', NULL, '2021-10-31 03:38:55', '2021-10-31 03:38:55'),
(139, 153, 'App\\Blog', '', '', '', '', '', NULL, '', '', NULL, '2021-10-31 04:33:24', '2021-10-31 04:33:24'),
(140, 154, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-10-31 04:38:13', '2021-10-31 04:42:35'),
(141, 155, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-10-31 04:44:54', '2021-10-31 04:44:54'),
(142, 156, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-10-31 04:45:02', '2021-10-31 04:45:02'),
(143, 157, 'App\\Blog', '', '', '', '', '', NULL, '', '', NULL, '2021-10-31 04:45:50', '2021-10-31 04:45:50'),
(145, 159, 'App\\Blog', '', '', '', '', '', NULL, '', '', NULL, '2021-10-31 04:47:51', '2021-10-31 04:47:51'),
(146, 160, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-11-01 02:24:19', '2021-11-01 02:24:19'),
(147, 161, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-11-01 02:27:56', '2021-11-01 02:27:56'),
(148, 162, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-11-01 02:28:23', '2021-11-17 19:49:11'),
(149, 163, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-11-01 02:39:49', '2021-11-01 02:46:52'),
(150, 164, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-11-01 02:47:45', '2021-11-01 03:00:26'),
(151, 165, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-11-01 03:02:09', '2021-11-01 03:40:33'),
(152, 166, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-11-01 03:40:41', '2021-11-01 03:40:42'),
(153, 167, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-11-01 03:43:01', '2021-11-01 03:43:01'),
(154, 168, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-11-01 03:55:40', '2021-11-01 03:57:20'),
(155, 169, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-11-01 03:58:14', '2021-11-01 03:58:14'),
(156, 170, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-11-01 03:58:22', '2021-11-01 03:58:22'),
(158, 171, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-11-07 00:14:59', '2021-11-07 01:24:50'),
(159, 172, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-11-07 01:40:28', '2021-11-07 01:40:28'),
(160, 173, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-11-11 07:22:45', '2021-11-11 07:22:45'),
(161, 174, 'App\\Blog', '', '', '', '', '', NULL, '', '', NULL, '2021-11-13 03:12:59', '2021-11-13 03:12:59'),
(162, 175, 'App\\Blog', 'sdf ok', 'sdf', 'sdf', '', '', NULL, '', '', NULL, '2021-11-14 04:37:52', '2021-11-14 04:41:37'),
(163, 177, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '213', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '218', '2021-11-17 14:01:54', '2021-11-17 18:34:28'),
(164, 178, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-11-17 15:32:02', '2021-11-17 15:33:09'),
(165, 179, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-11-17 17:28:58', '2021-11-18 11:23:50'),
(166, 180, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-11-17 19:52:28', '2021-11-17 19:56:54'),
(167, 181, 'App\\Blog', 'blog', 'blog', 'Fighting evil and tyranny, with all his power', 'blog', 'Fighting evil and tyranny, with all his power', '10', 'sdfsdf', 'Fighting evil and tyranny, with all his power', '6', '2021-11-17 19:57:16', '2021-11-17 19:58:51'),
(169, 182, 'App\\Blog', 'dsf', 'sdfdsf', '', '', '', NULL, '', '', NULL, '2021-11-21 16:58:52', '2021-11-21 16:59:10'),
(170, 183, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-11-21 17:24:42', '2021-11-21 17:34:05'),
(171, 184, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2021-11-21 17:25:00', '2021-11-21 17:25:13'),
(172, 185, 'App\\Blog', '', '', '', '', '', NULL, '', '', NULL, '2021-11-21 17:33:41', '2021-11-21 17:33:41'),
(173, 31, 'App\\Page', 'About Us', 'about', 'about', '', '', NULL, '', '', NULL, '2021-11-24 06:44:23', '2025-12-08 06:36:46'),
(174, 32, 'App\\Page', 'service list', 'service-list', '', '', '', NULL, '', '', NULL, '2021-11-24 06:52:32', '2022-02-14 22:28:02'),
(176, 34, 'App\\Page', 'contact', 'contact', '', '', '', NULL, '', '', NULL, '2021-11-24 06:54:28', '2022-02-12 04:28:37'),
(177, 35, 'App\\Page', 'blog', 'blog', '', '', '', NULL, '', '', NULL, '2021-11-24 06:56:35', '2022-02-12 04:42:04'),
(180, 187, 'App\\Blog', '', '', '', '', '', NULL, '', '', NULL, '2022-01-08 00:25:46', '2022-01-08 00:25:46'),
(181, 190, 'App\\Blog', '', '', '', '', '', NULL, '', '', NULL, '2022-01-08 00:38:44', '2022-01-08 00:38:44'),
(182, 191, 'App\\Blog', 'Test', 'Test', 'Test', '', '', NULL, '', '', NULL, '2022-01-08 00:51:33', '2022-01-08 00:51:33'),
(183, 192, 'App\\Blog', '', '', '', '', '', NULL, '', '', NULL, '2022-01-08 00:54:41', '2022-01-08 00:54:41'),
(184, 193, 'App\\Blog', '', '', '', '', '', NULL, '', '', NULL, '2022-01-08 01:04:02', '2022-01-08 01:04:02'),
(186, 2, 'App\\Blog', 'werwe', 'werwer', 'werewr', 'werwer', 'werwer', NULL, 'werwer', 'werwe', NULL, '2022-01-08 01:32:50', '2022-02-13 02:50:53'),
(187, 3, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2022-01-08 01:34:16', '2022-02-13 02:50:31'),
(188, 4, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2022-01-08 01:57:12', '2022-02-13 02:49:52'),
(190, 2, 'App\\Blog', 'werwe', 'werwer', 'werewr', 'werwer', 'werwer', NULL, 'werwer', 'werwe', NULL, '2022-01-08 03:18:18', '2022-02-13 02:50:53'),
(191, 3, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2022-01-08 03:22:45', '2022-02-13 02:50:31'),
(192, 4, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2022-01-08 05:23:52', '2022-02-13 02:49:52'),
(193, 5, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2022-01-08 05:23:57', '2022-02-13 02:49:30'),
(194, 6, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2022-01-08 05:24:04', '2022-02-13 02:48:58'),
(195, 7, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2022-01-08 05:24:08', '2022-02-13 02:47:43'),
(196, 8, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2022-01-08 05:24:12', '2022-02-13 02:46:58'),
(197, 9, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2022-01-08 05:24:17', '2022-02-13 02:46:32'),
(198, 10, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2022-01-08 05:24:24', '2022-02-13 02:46:00'),
(199, 11, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2022-01-08 05:24:28', '2022-02-13 02:45:28'),
(200, 12, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2022-01-08 05:44:56', '2022-02-13 02:44:10'),
(201, 13, 'App\\Blog', '', NULL, '', '', '', NULL, '', '', NULL, '2022-01-08 23:09:53', '2022-02-13 02:45:01'),
(204, 40, 'App\\Page', '', '', '', '', '', NULL, '', '', NULL, '2022-01-13 06:53:28', '2023-07-24 01:33:11'),
(205, 41, 'App\\Page', 'Privacy Policy', '', '', '', '', NULL, '', '', NULL, '2022-01-13 07:37:39', '2022-02-13 01:39:42'),
(206, 42, 'App\\Page', 'الشروط والأحكام - صيانة تك', 'شروط وأحكام, صيانة تك, خدمات الصيانة', 'شروط وأحكام استخدام منصة صيانة تك لخدمات الصيانة والإصلاح والتركيب', 'شروط وأحكام, صيانة تك', 'شروط وأحكام استخدام منصة صيانة تك', NULL, 'شروط وأحكام, صيانة تك', 'شروط وأحكام استخدام منصة صيانة تك', NULL, '2022-01-14 22:15:25', '2025-11-16 09:12:45'),
(217, NULL, 'App\\Service', 'test', 'test,test2,test3', 'vsdfgdf', 'test,test2', 'asdasd', '101', 'test,test2', 'asdasd', '97', '2022-02-01 07:28:09', '2022-02-01 07:28:09'),
(218, 21, 'App\\Service', 'tester', 'tester,tessert,Kester', 'sfsfssd', 'sdsf,sdf,Kester', 'sdfs', NULL, 'sdsfsdf,sdfsdf,kester', 'sdfsdf kester', '99', '2022-02-01 07:34:29', '2022-02-01 08:30:57'),
(219, 22, 'App\\Service', 'Test', 'test', 'test', 'test', 'test', '121', 'test', 'test', '19', '2022-02-05 07:24:49', '2022-02-05 07:24:49'),
(220, 23, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-02-06 00:24:02', '2022-02-06 00:24:02'),
(221, 24, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-02-06 02:57:21', '2022-02-06 02:57:21'),
(222, 25, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-02-06 03:07:23', '2022-02-06 03:07:23'),
(223, 26, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-02-06 03:14:05', '2022-02-06 03:14:05'),
(224, 27, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-02-06 03:16:06', '2022-02-06 03:16:06'),
(225, 28, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-02-06 03:16:56', '2022-02-06 03:16:56'),
(226, 29, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-02-06 03:24:26', '2022-02-06 03:24:26'),
(227, 30, 'App\\Service', 'Molestias consequatu', 'Occaecat vel quaerat', 'Deserunt sunt occaec', '', '', NULL, '', '', NULL, '2022-02-06 07:58:30', '2022-02-06 07:58:30'),
(228, 31, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-02-07 23:32:27', '2022-02-07 23:32:27'),
(229, 32, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-02-07 23:33:02', '2022-02-07 23:33:02'),
(230, 33, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-02-07 23:33:39', '2022-02-07 23:33:39'),
(232, 34, 'App\\Service', 'Et similique eligend', 'Delectus iste et ex', 'Perspiciatis aut ve', '', '', NULL, '', '', NULL, '2022-02-09 04:49:25', '2022-02-09 04:49:25'),
(233, 35, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-02-10 04:08:29', '2022-02-10 04:08:29'),
(234, 36, 'App\\Service', '', 'n', 'hhhh', '', '', '', '', '', '', '2022-02-12 00:40:56', '2023-08-20 01:49:33'),
(235, 37, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-02-12 02:06:34', '2022-02-12 02:06:34'),
(236, 38, 'App\\Service', 'Test', 'test', 'test', '', '', NULL, '', '', NULL, '2022-02-12 03:50:06', '2022-02-12 03:50:06'),
(237, 39, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-02-12 04:07:24', '2022-02-12 04:07:24'),
(238, 40, 'App\\Service', 'Test', 'test', 'test', '', '', NULL, '', '', NULL, '2022-02-16 11:18:31', '2022-02-16 11:30:38'),
(239, 41, 'App\\Service', 'Test', '', '', '', '', '', '', '', '', '2022-02-17 17:40:47', '2023-07-28 04:59:13'),
(240, 42, 'App\\Service', 'Test', 'rest', 'test', '', '', NULL, '', '', NULL, '2022-02-17 17:45:07', '2022-02-17 17:45:07'),
(241, 37, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-04-21 03:39:26', '2022-04-21 03:39:26'),
(242, 43, 'App\\Page', '', '', '', '', '', NULL, '', '', NULL, '2022-04-21 05:28:48', '2023-07-18 13:01:32'),
(243, 38, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-04-23 00:24:57', '2022-04-23 00:24:57'),
(244, 39, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-04-23 00:29:11', '2022-04-23 00:29:11'),
(245, 40, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-04-24 00:14:43', '2022-04-24 00:14:43'),
(246, 41, 'App\\Service', 'Test', '', '', '', '', '', '', '', '', '2022-04-24 04:12:18', '2023-07-28 04:59:13'),
(247, 42, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-04-24 23:11:20', '2022-04-24 23:11:20'),
(248, 43, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-04-24 23:17:12', '2022-04-24 23:17:12'),
(249, 44, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-04-24 23:20:28', '2022-04-24 23:20:28'),
(250, 45, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-04-24 23:23:02', '2022-04-24 23:23:02'),
(251, 46, 'App\\Service', '', NULL, '', '', '', NULL, '', '', NULL, '2022-04-26 23:51:33', '2022-04-27 00:03:01'),
(252, 47, 'App\\Service', '', NULL, '', '', '', NULL, '', '', NULL, '2022-04-27 01:57:46', '2022-04-27 02:40:35'),
(253, 48, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-04-27 02:44:53', '2022-04-27 02:44:53'),
(254, 49, 'App\\Service', 'fsdfsd sf', 'sd fsd', 'fsdfgsdf', '', '', NULL, '', '', NULL, '2022-04-27 02:57:48', '2022-04-28 09:39:26'),
(255, 50, 'App\\Service', '', NULL, '', '', '', NULL, '', '', NULL, '2022-04-28 07:57:51', '2023-09-12 03:48:47'),
(256, 51, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-04-28 07:59:33', '2022-04-28 07:59:33'),
(257, 52, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-04-28 08:09:48', '2022-04-28 08:09:48'),
(258, 53, 'App\\Service', '', '', '', '', '', '', '', '', '', '2022-04-28 08:31:38', '2023-07-28 04:59:07'),
(259, 54, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-04-28 08:35:15', '2022-04-28 08:35:15'),
(260, 55, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-04-28 08:37:48', '2022-04-28 08:37:48'),
(261, 56, 'App\\Service', '', NULL, '', '', '', NULL, '', '', NULL, '2022-04-28 08:47:42', '2022-11-16 05:18:26'),
(262, 57, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-04-28 03:15:23', '2022-04-28 03:15:23'),
(263, 58, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-04-29 12:26:15', '2022-04-29 12:26:15'),
(264, 44, 'App\\Page', '', '', '', '', '', NULL, '', '', NULL, '2022-09-03 04:04:25', '2022-11-22 07:21:24'),
(265, 57, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-10-08 04:59:32', '2022-10-08 04:59:32'),
(266, 45, 'App\\Page', '', '', '', '', '', NULL, '', '', NULL, '2022-10-11 22:38:42', '2022-10-11 23:10:39'),
(267, 58, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-10-23 00:37:38', '2022-10-23 00:37:38'),
(268, 59, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-10-23 01:53:50', '2022-10-23 01:53:50'),
(269, 60, 'App\\Service', '', NULL, '', '', '', NULL, '', '', NULL, '2022-10-23 01:58:30', '2022-10-23 04:05:42'),
(270, 61, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-11-13 01:41:09', '2022-11-13 01:41:09'),
(271, 62, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2022-11-14 03:03:13', '2022-11-14 03:03:13'),
(273, 63, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-01-09 04:41:14', '2023-01-09 04:41:14'),
(274, 64, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-01-09 06:18:59', '2023-01-09 06:18:59'),
(275, 65, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-01-09 06:34:18', '2023-01-09 06:34:18'),
(276, 66, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-01-09 23:02:12', '2023-01-09 23:02:12'),
(277, 67, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-01-10 00:09:50', '2023-01-10 00:09:50'),
(278, 68, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-01-10 00:18:08', '2023-01-10 00:18:08'),
(279, 69, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-01-10 03:31:20', '2023-01-10 03:31:20'),
(280, 70, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-01-10 04:39:09', '2023-01-10 04:39:09'),
(281, 71, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-01-10 04:46:49', '2023-01-10 04:46:49'),
(282, 72, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-01-10 06:32:07', '2023-01-10 06:32:07'),
(283, 73, 'App\\Service', '', NULL, '', '', '', NULL, '', '', NULL, '2023-01-10 06:36:50', '2023-01-11 06:29:56'),
(284, 74, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-01-11 05:28:15', '2023-01-11 05:28:15'),
(285, 75, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-01-16 15:55:38', '2023-01-16 15:55:38'),
(286, 76, 'App\\Service', '', NULL, '', '', '', NULL, '', '', NULL, '2023-01-17 14:04:53', '2023-04-12 22:11:40'),
(287, 77, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-01-18 23:21:48', '2023-01-18 23:21:48'),
(288, 78, 'App\\Service', '', NULL, '', '', '', NULL, '', '', NULL, '2023-01-19 16:57:30', '2023-04-12 22:11:27'),
(289, 79, 'App\\Service', '', NULL, '', '', '', NULL, '', '', NULL, '2023-01-23 06:25:31', '2023-04-12 22:11:21'),
(290, 80, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-01-23 06:32:11', '2023-01-23 06:32:11'),
(291, 81, 'App\\Service', '', NULL, '', '', '', NULL, '', '', NULL, '2023-01-23 08:24:11', '2023-04-12 22:11:16'),
(292, 82, 'App\\Service', '', NULL, '', '', '', NULL, '', '', NULL, '2023-01-23 15:49:32', '2023-04-12 22:09:37'),
(293, 83, 'App\\Service', 'demo 33', 'tag', 'tag 3', '', '', NULL, '', '', NULL, '2023-01-25 16:50:13', '2023-04-12 22:09:44'),
(294, 84, 'App\\Service', 'demo Meta Title', 'demometa_tag', 'demo meta description', 'Facebook Meta Tag', 'Facebook Meta Description', '180', '', '', NULL, '2023-01-27 21:40:06', '2023-04-12 22:10:01'),
(295, 8, 'App\\Category', '', '', '', 'Facebook Meta Tag', 'Facebook Meta Description', '397', 'Twitter Meta Tag', 'Twitter Meta Description', '348', '2023-01-27 22:26:47', '2023-06-16 23:22:51'),
(296, 9, 'App\\Category', NULL, NULL, NULL, '', '', NULL, '', '', NULL, '2023-01-27 22:29:46', '2023-01-28 01:14:10'),
(297, 85, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-01-27 22:32:48', '2023-01-27 22:32:48'),
(298, 15, 'App\\Subcategory', NULL, NULL, NULL, 'Facebook Meta Tag 200', 'Facebook Meta Description 5555', '298', 'Twitter Meta Tag 444', 'Twitter Meta Description 44', '298', '2023-01-27 23:14:41', '2023-01-28 08:14:30'),
(299, 16, 'App\\Subcategory', NULL, NULL, NULL, 'fdsfd', 'fdsf', '298', '', '', NULL, '2023-01-28 01:44:08', '2023-01-28 01:44:08'),
(300, 2, 'App\\ChildCategory', NULL, NULL, NULL, 'Facebook Meta Tag', 'Facebook Meta Description', '298', 'Twitter Meta Twitter Meta Tag', 'Twitter Meta Description', '298', '2023-01-28 08:28:23', '2023-01-28 08:28:23'),
(301, 3, 'App\\ChildCategory', NULL, NULL, NULL, 'Facebook Meta Tag', 'Facebook Meta Description', '355', 'Twitter Meta Twitter Meta Tag', 'Twitter Meta Description', '338', '2023-01-28 08:29:06', '2023-01-28 23:00:58'),
(302, 10, 'App\\Category', NULL, NULL, NULL, 'Facebook Meta Tag 33 66', 'Facebook Meta Description 33 666', '410', 'Twitter Meta Tag 333', 'Twitter Meta Description f 333', '274', '2023-01-28 23:03:33', '2023-01-28 23:07:18'),
(303, 17, 'App\\Subcategory', NULL, NULL, NULL, '11', '22', '306', '44', '55', '298', '2023-01-28 23:08:26', '2023-01-28 23:51:57'),
(304, 4, 'App\\ChildCategory', NULL, NULL, NULL, 'Facebook Meta Tag 44', 'Facebook Meta Description 44', '306', 'Twitter Meta Tag 55', 'Twitter Meta Description55', '311', '2023-01-28 23:41:08', '2023-01-28 23:50:56'),
(305, 86, 'App\\Service', 'fds', 'fdsf', 'dsf', '', '', NULL, '', '', NULL, '2023-04-03 22:14:15', '2023-04-12 22:10:06'),
(306, 87, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-04-13 01:10:49', '2023-04-13 01:10:49'),
(307, 88, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-04-13 01:14:35', '2023-04-13 01:14:35'),
(308, 89, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-05-04 05:47:35', '2023-05-04 05:47:35'),
(309, 90, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-05-04 06:01:58', '2023-05-04 06:01:58'),
(310, 91, 'App\\Service', 'Quis in saepe minima', 'Autem id quo ea id', 'Praesentium ipsam al', '', '', NULL, '', '', NULL, '2023-05-04 06:03:51', '2023-05-04 06:03:51'),
(311, 92, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-05-04 06:48:47', '2023-05-04 06:48:47'),
(312, 93, 'App\\Service', 'Non ducimus vero do', 'Et perferendis ut du', 'Ullam repellendus I', 'Veniam sed molestia', 'dfsdf', NULL, '', '', NULL, '2023-05-04 07:01:20', '2023-05-04 07:01:20'),
(313, 94, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-05-07 06:43:19', '2023-05-07 06:43:19'),
(314, 95, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-05-08 06:29:49', '2023-05-08 06:29:49'),
(315, 98, 'App\\Service', 'fdfsffdsf', 'dffddsfds', 'fsdfdsfdsfsdf', 'dfdfdf', 'sdfdfdfdfdsfdsf', '', 'fsdfdsf', 'fdsfdfsdfsdfdsf', '', '2023-05-09 08:20:52', '2023-05-09 08:20:52'),
(316, 99, 'App\\Service', 'gfg', 'fdgd gf', 'dg fdg dfg', 'fdgd', 'f gdfg fdgdfg', '', 'fgdf gfgdfg', 'gfgdfsgf', '', '2023-05-09 08:36:37', '2023-05-09 08:36:37'),
(317, 100, 'App\\Service', 'fsdf', 'sdfsdf', 'sdfsdf', '', '', '', '', '', '', '2023-05-09 08:40:15', '2023-05-09 08:40:15'),
(318, 101, 'App\\Service', 'fdfsdf', 'sdfdf', 'dsfd', '', '', '', '', '', '', '2023-05-09 08:42:09', '2023-05-09 08:42:09'),
(319, 102, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-09 08:42:25', '2023-05-09 08:42:25'),
(320, 103, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-09 08:43:05', '2023-05-09 08:43:05'),
(321, 104, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-09 08:44:24', '2023-05-09 08:44:24'),
(322, 105, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-09 08:45:07', '2023-05-09 08:45:07'),
(323, 106, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-09 08:46:31', '2023-05-09 08:46:31'),
(324, 107, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-10 04:39:59', '2023-05-10 04:39:59'),
(325, 108, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-10 04:41:32', '2023-05-10 04:41:32'),
(326, 109, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-10 04:42:40', '2023-05-10 04:42:40'),
(327, 110, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-10 04:46:05', '2023-05-10 04:46:05'),
(328, 111, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-10 04:57:09', '2023-05-10 04:57:09'),
(329, 112, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-10 04:58:26', '2023-05-10 04:58:26'),
(330, 113, 'App\\Service', 'Et dolorem tempor ad', 'Molestias totam dolo', 'Ut qui neque nisi ne', '', '', NULL, '', '', NULL, '2023-05-10 05:04:21', '2023-05-10 05:04:21'),
(331, 114, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-10 05:07:00', '2023-05-10 05:07:00'),
(332, 132, 'App\\Service', 'fdsf', 'dsfds', 'fdsf', '', '', '', '', '', '', '2023-05-11 00:29:54', '2023-05-11 00:29:54'),
(333, 133, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-11 00:31:20', '2023-05-11 00:31:20'),
(334, 154, 'App\\Service', 'fsdfsd', 'fdfsf', 'd', 'dsfsdf', 'sdfsdf', '524', '', '', '', '2023-05-11 01:25:02', '2023-05-11 01:25:02'),
(335, 157, 'App\\Service', 'fsdfdfsdf', 'fsdfdsf', 'fsdfd ', 'fdsfds', 'fdsfds', '', '', '', '', '2023-05-14 00:23:59', '2023-05-14 00:23:59'),
(336, 158, 'App\\Service', 'Meta Title', 'dfdsfdsfd,fdsfds', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'dfsfdf', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '530', 'this is twitter meta title', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '528', '2023-05-14 00:32:03', '2023-05-14 00:32:03'),
(337, 159, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-14 00:52:31', '2023-05-14 00:52:31'),
(338, 161, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-14 02:26:14', '2023-05-14 02:26:14'),
(339, 162, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-14 02:28:53', '2023-05-14 02:28:53'),
(340, 163, 'App\\Service', 'fdfds', 'fdsf', '', '', '', '', '', '', '', '2023-05-14 02:30:49', '2023-05-14 02:30:49'),
(341, 164, 'App\\Service', 'fdfds', 'fdsf', '', '', '', '', '', '', '', '2023-05-14 02:31:59', '2023-05-14 02:31:59'),
(342, 165, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-14 02:33:31', '2023-05-14 02:33:31'),
(343, 166, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-14 02:36:19', '2023-05-14 02:36:19'),
(344, 167, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-14 02:39:11', '2023-05-14 02:39:11'),
(345, 168, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-14 02:40:22', '2023-05-14 02:40:22'),
(346, 169, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-14 02:40:44', '2023-05-14 02:40:44'),
(347, 170, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-14 02:41:25', '2023-05-14 02:41:25'),
(348, 171, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-14 03:05:34', '2023-05-14 03:05:34'),
(349, 176, 'App\\Service', 'fsdfsdf', 'fdsf', 'sdfsdf', 'sdfsdf', 'sdfsdf', '526', 'fsdf', 'sdfsdaf', '525', '2023-05-14 08:23:01', '2023-05-14 08:23:01'),
(350, 177, 'App\\Service', '', '', '', 'sdfds', 'fdsf', '519', 'dsfdf', 'fsdf', '522', '2023-05-14 08:25:32', '2023-05-14 08:25:32'),
(351, 178, 'App\\Service', '', 'fdsf,dsfdsf', '', '', '', '526', '', '', '524', '2023-05-14 23:22:50', '2023-05-16 00:51:21'),
(352, 179, 'App\\Service', 'dfdsf', 'dfdsf', 'sdfsd', 'dfdsf', 'dsfdsf', '526', 'dsfd', 'sfsdfsd', '514', '2023-05-15 07:52:14', '2023-05-15 23:44:35'),
(353, 180, 'App\\Service', 'this is 1st title this  dd fdfd 1121fsdfds', 'dfdsfs,dfsdfds,fdfsdfdsf,1222,ds,dsfasdfsd', 'this is 1st  Description ttt dd dfdsf 7777fsdfdsfsdf', 'Facebook title dd', 'this is 1st Facebook  Description dd', '521', 'Twitter title dddsfsd', 'Twitter Description ddfsdfsdf', '537', '2023-05-15 08:59:35', '2023-05-17 04:46:36'),
(354, 18, 'App\\Subcategory', '', '', '', '', '', NULL, '', '', NULL, '2023-05-17 02:07:02', '2023-07-29 02:12:45'),
(355, 19, 'App\\Subcategory', '', '', '', '', '', NULL, '', '', NULL, '2023-05-17 02:07:27', '2023-07-29 02:12:42'),
(356, 6, 'App\\ChildCategory', '', '', '', '', '', NULL, '', '', NULL, '2023-05-17 02:08:20', '2023-07-29 02:26:37'),
(357, 7, 'App\\ChildCategory', '', '', '', '', '', NULL, '', '', NULL, '2023-05-17 02:08:57', '2023-05-17 02:08:57'),
(358, 8, 'App\\ChildCategory', '', '', '', '', '', NULL, '', '', NULL, '2023-05-17 02:09:12', '2023-05-17 02:09:12'),
(359, 9, 'App\\ChildCategory', '', '', '', '', '', NULL, '', '', NULL, '2023-05-17 02:09:26', '2023-05-17 02:09:26'),
(360, 181, 'App\\Service', 'Eius aperiam ad quo ', 'fsdfds', 'fasdff', 'fsdfsad', 'fsdfds', '521', 'fsdf sf', 'sd fdsf sd f', '533', '2023-05-17 04:50:03', '2023-05-17 04:50:03'),
(361, 192, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-17 07:55:16', '2023-05-17 07:55:16'),
(362, 193, 'App\\Service', 'Vero voluptate cupid fff', 'Molestiae dolor et N,dsfdsf', 'Qui quia illum temp fs ', 'Nihil quo sint rerumf', 'Minim iste facere au f', '530', 'Explicabo Voluptati', 'Et eos a voluptas sa', '539', '2023-05-17 08:27:59', '2023-05-17 08:27:59'),
(363, 194, 'App\\Service', 'dsfsdfsd sdf ', 'fsdfsdf,d sdf', 'dsfs sdf d', 'fsdf', ' fsdf d', '535', 'dsf ', 'fsd f', '537', '2023-05-17 08:31:40', '2023-05-17 08:31:40'),
(364, 195, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-17 23:26:32', '2023-05-17 23:26:32'),
(365, 197, 'App\\Service', 'Eius aperiam ad quo ', 'fsdf,dsfsdf', 'fdf d df', 'fsd d', 'f asd ', '539', 'sdf', ' fsdf', '523', '2023-05-18 01:00:51', '2023-05-20 02:12:05'),
(366, 198, 'App\\Service', 'fsdf', '66', 'fdsfds', '', '', '', '', '', '', '2023-05-18 05:22:55', '2023-05-21 00:27:27'),
(367, 201, 'App\\Service', 'sdfsdfsa', 'sd,sdf,df,dsfd,dsf', 'sdafdsfsdffsdfsdffdsfsd', 'fsdf', ' sdfsa fds ', '', 'dsfdsf', 'asdfs', '533', '2023-05-20 05:30:54', '2023-05-20 07:58:09'),
(368, 202, 'App\\Service', 'fsdfdfsfsdf', 'dfsdf', 'sdffdsffsdf', 'fdf', 'dfsdd', '', 'dsffdf', 'fsdfdsf', '', '2023-05-20 08:05:45', '2023-05-20 23:07:57'),
(369, 205, 'App\\Service', 'tilte one ', 'one,two,three', 'Meta Description all show', 'Facebook Meta Title', 'Facebook Meta Description', '534', 'Twitter Meta Title tilte one ', 'Twitter Meta Description', '532', '2023-05-20 23:52:34', '2023-05-21 00:07:38'),
(370, 205, 'App\\Service', 'tilte one ', 'one,two,three', 'Meta Description all show', 'Facebook Meta Title', 'Facebook Meta Description', '534', 'Twitter Meta Title tilte one ', 'Twitter Meta Description', '532', '2023-05-20 23:53:03', '2023-05-21 00:07:38'),
(371, 205, 'App\\Service', 'tilte one ', 'one,two,three', 'Meta Description all show', 'Facebook Meta Title', 'Facebook Meta Description', '534', 'Twitter Meta Title tilte one ', 'Twitter Meta Description', '532', '2023-05-20 23:53:29', '2023-05-21 00:07:38'),
(372, 205, 'App\\Service', 'tilte one ', 'one,two,three', 'Meta Description all show', 'Facebook Meta Title', 'Facebook Meta Description', '534', 'Twitter Meta Title tilte one ', 'Twitter Meta Description', '532', '2023-05-20 23:53:41', '2023-05-21 00:07:38'),
(373, 205, 'App\\Service', 'tilte one ', 'one,two,three', 'Meta Description all show', 'Facebook Meta Title', 'Facebook Meta Description', '534', 'Twitter Meta Title tilte one ', 'Twitter Meta Description', '532', '2023-05-20 23:54:23', '2023-05-21 00:07:38'),
(374, 206, 'App\\Service', '1234df', '#dfdg #fgyuyh', 'afdcgtfyhdsfds f', 'Facebook title', 'fghjnmhn', '530', 'Twitter title', 'dfghnjmhm', '539', '2023-05-21 00:19:29', '2023-05-21 00:26:37'),
(375, 207, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-21 00:28:29', '2023-05-21 01:21:47'),
(376, 11, 'App\\Category', '', '', '', '', '', NULL, '', '', NULL, '2023-05-21 07:54:45', '2023-05-21 07:54:45'),
(377, 12, 'App\\Category', '', '', '', '', '', NULL, '', '', NULL, '2023-05-21 07:56:53', '2023-05-22 00:49:58'),
(378, 20, 'App\\Subcategory', '', '', '', '', '', NULL, '', '', NULL, '2023-05-21 08:13:36', '2023-05-21 08:13:52'),
(379, 10, 'App\\ChildCategory', '', '', '', '', '', NULL, '', '', NULL, '2023-05-21 08:14:17', '2023-05-21 08:14:34'),
(380, 215, 'App\\Service', 'Meta title one ', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic ', 'This is Title one  44', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic ', '549', 'Twitter Meta Title 444444', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic ', '548', '2023-05-22 00:20:09', '2023-05-22 00:25:38'),
(381, 213, 'App\\Service', 'Eius aperiam ad quo ', '', 'fsdfdsf', 'dsfsd', 'fdsfsdf', '506', 'sfds', 'fdsfdsf', '463', '2023-05-22 00:58:52', '2023-05-23 23:02:42'),
(382, 21, 'App\\Subcategory', '', '', '', '', '', NULL, '', '', NULL, '2023-05-23 07:22:37', '2023-07-29 02:12:40'),
(383, 22, 'App\\Subcategory', '', '', '', '', '', NULL, '', '', NULL, '2023-05-23 07:23:02', '2023-07-29 02:12:37'),
(384, 23, 'App\\Subcategory', '', '', '', '', '', NULL, '', '', NULL, '2023-05-23 07:23:52', '2023-07-29 02:12:34'),
(385, 24, 'App\\Subcategory', '', '', '', '', '', NULL, '', '', NULL, '2023-05-23 07:30:38', '2023-05-23 07:30:38'),
(386, 25, 'App\\Subcategory', '', '', '', '', '', NULL, '', '', NULL, '2023-05-23 07:31:03', '2023-05-23 07:31:03'),
(387, 216, 'App\\Service', '11 66', '', '11 88', '22 44', '44 55555555555', '', '', '', '', '2023-05-23 08:54:58', '2023-05-24 01:19:49'),
(388, 217, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-24 01:41:42', '2023-05-24 01:50:59'),
(389, 218, 'App\\Service', 'fdsf', '', 'sdfsdfds', 'fsd', 'fdsfds', '', 'sdfds', 'fsdfsd', '', '2023-05-24 01:53:55', '2023-05-25 08:18:31'),
(390, 221, 'App\\Service', 'tag one ', '', 'tag info one tag info onetag info onetag info onetag info onetag info onetag info onetag info onetag info onetag info onetag info onetag info onetag info onetag info onetag info onetag info onetag info onetag info onetag info onetag info onetag info onetag info onetag info onetag info onetag info onetag info onetag info onetag info onetag info one', 'fb one', 'fb info', '570', 'Twitter one', 'Twitter info ', '', '2023-05-25 09:25:14', '2023-05-27 01:19:48'),
(391, 222, 'App\\Service', 'sdfsdf', '111dfdsf', 'sfsddf', '', '', '', '', '', '', '2023-05-27 01:20:27', '2023-05-27 01:21:03'),
(392, 223, 'App\\Service', 'fsdfdsf', '', 'dsfdsf', '', '', '459', '', '', '505', '2023-05-27 01:22:09', '2023-05-28 00:42:50'),
(393, 225, 'App\\Service', 'fsdf dsf ', '', 'fds fsd ds ', '', '', '', '', '', '', '2023-05-27 01:27:27', '2023-05-27 01:28:02'),
(394, 226, 'App\\Service', 'fdfsd', '', 'fsdfsdffdsf', 'dsfdsf', 'fdsf', '466', 'fsdf', 'fsdf', '461', '2023-05-27 01:28:40', '2023-05-27 03:05:50'),
(395, 227, 'App\\Service', 'one', 'one,two', 'Meta Description\r\n', 'Facebook Meta Title', 'Facebook Meta Description\r\n', '442', 'Twitter Meta Title', 'Twitter Meta Description\r\n', '440', '2023-05-27 03:29:05', '2023-05-27 03:30:33'),
(396, 228, 'App\\Service', 'fdsf', 'sdfds', 'fsdf', 'fsdf', 'sdfsdf', '', 'fsd', 'fsdfd', '', '2023-05-27 03:33:51', '2023-05-27 03:33:51'),
(397, 229, 'App\\Service', 'fdsf', 'sdfds', 'fsdf', 'fsdf', 'sdfsdf', '', 'fsd', 'fsdfd', '', '2023-05-27 03:36:05', '2023-05-27 03:36:05'),
(398, 230, 'App\\Service', 'fdsf', 'sdfds', 'fsdf', 'fsdf', 'sdfsdf', '', 'fsd', 'fsdfd', '', '2023-05-27 03:37:15', '2023-05-27 03:37:15'),
(399, 232, 'App\\Service', 'fsdfdsfds', 'fdsafdsfsadfsdafsf,sfsdfsdf,sda,f,sd,sdf,sad,fds', 'fsdf', 'fdsf', 'dsfsd', '461', '', '', '', '2023-05-27 04:42:52', '2023-05-27 04:43:09'),
(400, 234, 'App\\Service', 'dsfds', 'dsfdsf,dsfsdfds', 'fsdfdsffdsf', 'dsfdsf', 'sdfsdf', '', 'fdsfa', 'sdf', '503', '2023-05-27 04:59:42', '2023-05-27 05:25:58'),
(401, 238, 'App\\Service', 'fsdf', 'fdsf', 'dsfdsfsdf', 'fsd', 'fdfd', '', 'dsfd', 'sfdsfdsf', '', '2023-05-27 05:24:33', '2023-05-28 00:29:34'),
(402, 235, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-27 05:25:49', '2023-05-27 05:25:49'),
(403, 13, 'App\\Category', '', '', '', '', '', NULL, '', '', NULL, '2023-05-28 00:54:01', '2023-05-28 00:54:01'),
(404, 26, 'App\\Subcategory', '', '', '', '', '', NULL, '', '', NULL, '2023-05-28 00:56:58', '2023-07-29 02:12:31'),
(405, 11, 'App\\ChildCategory', '', '', '', '', '', NULL, '', '', NULL, '2023-05-28 00:58:30', '2023-05-28 00:58:30'),
(406, 239, 'App\\Service', 'SMALL SCALE WORDPRESS WEBSITE', 'SMALL SCALE WORDPRESS WEBSITE,test', 'Custom Wordpress website using Custom post types and Advance custom fields with divi and elementor\r\n', 'Custom Wordpress', 'Custom Wordpress website using Custom post types and Advance custom fields with divi and elementor', '454', 'Custom WordPress website ', 'Custom WordPress website using Custom post types and Advance custom fields with divi and elementor', '587', '2023-05-28 01:25:51', '2023-05-28 01:25:51'),
(407, 240, 'App\\Service', 'shgfjkuhjk', '#abcd ,#efgh,#1234,#xyz', 'As a web developer and designer with over 3 years of experience and 1000+ satisfied clients, I know exactly how to create a website that gets results. Whether you need an e-commerce site, a listing site, or a social media site, I\'ve got you covered.\r\n\r\n', 'fb ', 'As a web developer and designer with over 3 years of experience and 1000+ satisfied clients, I know exactly how to create a website that gets results. Whether you need an e-commerce site, a listing site, or a social media site, I\'ve got you covered.\r\n\r\n', '582', 'Twitter title', 'As a web developer and designer with over 3 years of experience and 1000+ satisfied clients, I know exactly how to create a website that gets results. Whether you need an e-commerce site, a listing site, or a social media site, I\'ve got you covered.\r\n\r\n', '586', '2023-05-28 01:39:32', '2023-05-28 01:54:05'),
(408, 241, 'App\\Service', 'fsdfds', 'fds,sdfsdaff', 'sdfdsfsdfds', 'fadsfds', 'fsdf', '587', 'sdfds', 'fsdfsdf', '589', '2023-05-28 02:11:10', '2023-05-28 02:11:10'),
(409, 242, 'App\\Service', 'SDFDS', 'FDSFFSDF', 'FDSFDSFSDF', 'SDF', 'DSFDSFDSF', '575', 'DSF', 'FSDFD', '575', '2023-05-28 02:14:34', '2023-05-28 02:14:34'),
(410, 243, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-05-29 03:54:22', '2023-05-29 03:54:22'),
(411, 244, 'App\\Service', 'fdsfdsffdsf', 'fdsfsd,dfsdf,dsfdsfds', 'dsfdsfds', 'fsdf', 'fdsfdsf', '0', 'dfdsf', 'dsfdsf', '', '2023-05-29 04:00:17', '2023-05-29 04:00:17'),
(412, 245, 'App\\Service', 'Eius aperiam ad quo ', 'dfsd ds sd ', 'rffxsdc sds sd xdweds xdddddddddddddddddx sd', '', '', '', '', '', '', '2023-05-29 04:04:51', '2023-07-12 06:36:51'),
(413, 15, 'App\\Category', '', '', '', '', '', NULL, '', '', NULL, '2023-06-15 06:58:54', '2023-06-16 23:19:32'),
(414, 16, 'App\\Category', '', '', '', '', '', NULL, '', '', NULL, '2023-06-15 07:00:36', '2023-06-15 07:00:36'),
(415, 247, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-06-18 23:14:49', '2023-06-18 23:14:49'),
(417, 248, 'App\\Service', 'gdfg', '', '', '', '', '', '', '', '', '2023-06-21 08:14:22', '2023-07-05 00:17:10'),
(418, 15, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-06-21 22:48:35', '2023-07-28 15:28:51'),
(419, 14, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-06-21 22:48:43', '2023-07-28 15:28:48'),
(420, 12, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-06-21 22:49:31', '2023-07-28 15:28:42'),
(421, 9, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-06-21 22:49:46', '2023-07-28 15:28:38'),
(422, 8, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-06-21 22:49:59', '2023-07-28 15:28:40'),
(423, 246, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-07-10 05:46:51', '2023-07-10 05:46:51');
INSERT INTO `meta_data` (`id`, `meta_taggable_id`, `meta_taggable_type`, `meta_title`, `meta_tags`, `meta_description`, `facebook_meta_tags`, `facebook_meta_description`, `facebook_meta_image`, `twitter_meta_tags`, `twitter_meta_description`, `twitter_meta_image`, `created_at`, `updated_at`) VALUES
(424, 47, 'App\\Page', '', '', '', '', '', NULL, '', '', NULL, '2023-07-17 18:02:45', '2023-07-17 18:03:32'),
(425, 249, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-07-24 13:18:15', '2023-07-24 13:18:15'),
(426, 250, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-07-25 05:39:24', '2023-07-25 05:39:24'),
(427, 251, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-07-25 05:44:21', '2023-07-25 05:44:21'),
(428, 252, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-07-25 05:48:36', '2023-07-25 05:48:36'),
(429, 253, 'App\\Service', '', NULL, '', '', '', NULL, '', '', NULL, '2023-07-25 05:52:16', '2023-07-26 04:15:36'),
(430, 254, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-07-27 02:53:32', '2023-07-27 02:53:32'),
(431, 255, 'App\\Service', 'sadasd', '', 'sdadas', '', '', '', '', '', '', '2023-07-27 05:24:33', '2023-07-27 05:24:33'),
(432, 48, 'App\\Page', '', '', '', '', '', NULL, '', '', NULL, '2023-07-27 07:50:33', '2025-12-08 06:36:35'),
(433, 1, 'App\\Category', '', '', '', '', '', NULL, '', '', NULL, '2023-07-28 04:10:34', '2023-07-28 04:11:37'),
(434, 16, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-07-28 04:59:18', '2023-07-28 04:59:18'),
(435, 7, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-07-28 05:00:27', '2023-09-28 17:28:09'),
(436, 27, 'App\\Subcategory', '', '', '', '', '', NULL, '', '', NULL, '2023-07-28 05:05:03', '2023-07-28 05:05:03'),
(437, 1, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-07-28 05:06:01', '2023-08-04 00:19:15'),
(438, 2, 'App\\Service', '', NULL, '', '', '', NULL, '', '', NULL, '2023-07-28 05:21:04', '2023-11-18 23:46:45'),
(439, 6, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-07-28 05:25:18', '2023-07-28 05:25:18'),
(440, 3, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-07-28 05:25:29', '2023-10-01 03:38:14'),
(441, 4, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-07-28 05:25:33', '2023-07-28 05:25:33'),
(442, 5, 'App\\Service', '', NULL, '', '', '', NULL, '', '', NULL, '2023-07-28 05:25:38', '2023-08-20 01:59:07'),
(443, 13, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-07-28 15:29:56', '2023-07-28 15:30:53'),
(444, 1, 'App\\Subcategory', '', '', '', '', '', NULL, '', '', NULL, '2023-07-29 02:12:26', '2023-07-29 02:12:26'),
(445, 3, 'App\\Subcategory', '', '', '', '', '', NULL, '', '', NULL, '2023-07-29 02:12:29', '2023-07-29 02:12:29'),
(446, 13, 'App\\Subcategory', '', '', '', '', '', NULL, '', '', NULL, '2023-07-29 02:12:48', '2023-07-29 02:12:48'),
(447, 1, 'App\\ChildCategory', '', '', '', '', '', NULL, '', '', NULL, '2023-07-29 02:26:33', '2023-07-29 02:26:33'),
(448, 5, 'App\\ChildCategory', '', '', '', '', '', NULL, '', '', NULL, '2023-07-29 02:26:35', '2023-07-29 02:26:35'),
(449, 256, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-07-30 21:27:29', '2023-07-30 21:27:29'),
(450, 257, 'App\\Service', '', NULL, '', '', '', NULL, '', '', NULL, '2023-08-01 04:52:11', '2023-08-01 05:21:53'),
(451, 258, 'App\\Service', 'Création boite 3D', 'MOCKUP', 'je vais créer votre boite 3d', '', '', '', '', '', '', '2023-08-02 09:19:27', '2023-08-02 11:29:02'),
(452, 259, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-08-08 09:26:23', '2023-08-09 20:59:17'),
(453, 260, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-08-09 19:29:22', '2023-08-09 19:29:22'),
(454, 261, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-08-10 00:39:31', '2023-08-10 00:39:31'),
(455, 263, 'App\\Service', '', NULL, '', '', '', NULL, '', '', NULL, '2023-08-15 06:48:05', '2023-08-16 05:40:23'),
(456, 264, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-08-19 22:44:35', '2023-08-19 22:44:35'),
(457, 265, 'App\\Service', 'this is service', '', '', '', '', '', '', '', '', '2023-08-20 12:06:13', '2023-08-21 01:30:43'),
(458, 266, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-08-21 18:32:47', '2023-08-21 18:32:47'),
(459, 268, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-08-26 01:03:26', '2023-08-26 01:03:26'),
(460, 269, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-08-28 12:45:30', '2023-08-28 12:45:30'),
(461, 270, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-08-29 03:00:15', '2023-08-29 03:00:15'),
(462, 272, 'App\\Service', 'Deneme', 'deneme', 'Meta DescriptionMeta DescriptionMeta Description', '', '', '', '', '', '', '2023-09-01 10:41:32', '2023-09-01 13:20:49'),
(463, 273, 'App\\Service', '', NULL, '', '', '', NULL, '', '', NULL, '2023-09-01 13:24:22', '2023-09-06 19:39:38'),
(464, 274, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-09-05 04:29:25', '2023-11-19 05:08:51'),
(465, 275, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-09-09 03:42:56', '2023-09-12 08:51:36'),
(466, 276, 'App\\Service', 'kasdajsk', 'jkdad,tagsss', 'descrip', '', '', '', '', '', '', '2023-09-10 01:31:34', '2023-09-11 10:08:08'),
(467, 277, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-09-13 15:29:07', '2023-09-13 15:29:07'),
(468, 278, 'App\\Service', 'Test Service One v', 'Test Service One v', 'Test Service One v', '', '', '0', '', '', '', '2023-09-14 06:11:22', '2023-09-14 06:11:22'),
(469, 280, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-09-16 07:28:00', '2023-09-16 07:28:00'),
(470, 281, 'App\\Service', '', NULL, '', '', '', NULL, '', '', NULL, '2023-09-17 01:18:30', '2023-09-21 22:21:53'),
(471, 282, 'App\\Service', 'HVAC Inspection', 'hvac-inspection', 'HVAC Inspection', '', '', '', '', '', '', '2023-09-23 12:31:20', '2023-09-23 12:32:59'),
(472, 283, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-09-25 08:46:53', '2023-09-26 06:17:18'),
(473, 284, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-09-26 05:36:37', '2023-09-26 05:36:37'),
(474, 285, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-09-27 06:38:26', '2023-09-27 06:38:26'),
(475, 287, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-09-29 06:57:10', '2023-09-29 06:57:10'),
(476, 288, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-09-30 09:09:30', '2023-10-01 08:00:51'),
(477, 289, 'App\\Service', 'errand', 'errand', 'Al Physical errand services.hhhhhhhhhhhhhhhhhrhhhhhhhhhhhhhhtrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr', '', '', '', '', '', '', '2023-10-02 21:58:31', '2023-10-02 21:58:31'),
(478, 290, 'App\\Service', 'fthdfhrgh', 'dgsdfgertg', 'gsedfggxger', '', '', '0', '', '', '', '2023-10-03 06:48:29', '2023-10-04 14:27:10'),
(479, 291, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-10-04 14:31:20', '2023-10-04 14:31:20'),
(480, 292, 'App\\Service', '463442;i', 'uilkkjh,ulk', 'ukjhg,ghkukuk', '', '', '0', '', '', '', '2023-10-05 02:31:45', '2023-10-05 02:31:45'),
(481, 293, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-10-07 06:26:20', '2023-10-07 08:19:58'),
(482, 294, 'App\\Service', '', NULL, '', '', '', NULL, '', '', NULL, '2023-10-09 07:03:02', '2023-10-09 07:08:12'),
(483, 295, 'App\\Service', 'dsfsdfdsfsdfs', 'sdfsfsd', 'fsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdffsdfsdfsdf', '', '', '0', '', '', '', '2023-10-09 11:24:42', '2023-10-09 11:24:42'),
(484, 296, 'App\\Service', '', NULL, '', '', '', NULL, '', '', NULL, '2023-10-14 02:50:19', '2023-10-15 13:44:31'),
(485, 297, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-10-16 08:50:37', '2023-10-16 08:52:15'),
(486, 298, 'App\\Service', 'babysitter', '', '', '', '', '0', '', '', '', '2023-10-17 05:24:04', '2023-10-24 04:47:21'),
(487, 8, 'App\\Category', '', '', '', '', '', NULL, '', '', NULL, '2023-10-22 00:29:28', '2023-10-22 00:29:28'),
(488, 9, 'App\\Category', '', '', '', '', '', NULL, '', '', NULL, '2023-10-22 00:39:12', '2023-10-22 00:39:12'),
(489, 28, 'App\\Subcategory', '', '', '', '', '', NULL, '', '', NULL, '2023-10-22 00:41:19', '2023-10-22 00:41:19'),
(490, 29, 'App\\Subcategory', '', '', '', '', '', NULL, '', '', NULL, '2023-10-22 00:42:57', '2023-10-22 00:42:57'),
(491, 30, 'App\\Subcategory', '', '', '', '', '', NULL, '', '', NULL, '2023-10-22 00:44:10', '2023-10-22 00:44:10'),
(492, 31, 'App\\Subcategory', '', '', '', '', '', NULL, '', '', NULL, '2023-10-22 00:46:24', '2023-10-22 00:46:25'),
(493, 300, 'App\\Service', 'iphone 15pro', 'iphone 15pro', 'iphone 15pro', '', '', '', '', '', '', '2023-10-24 04:36:11', '2023-10-24 04:37:57'),
(494, 301, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-10-31 03:18:00', '2023-10-31 03:18:00'),
(495, 302, 'App\\Service', 'trty', 'rty', 'rty', '', '', '0', '', '', '', '2023-11-04 12:55:02', '2023-11-04 12:55:02'),
(496, 303, 'App\\Service', 'msg', 'msg', 'msg', '', '', '0', '', '', '', '2023-11-05 14:33:05', '2023-11-05 14:33:05'),
(497, 304, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-11-06 08:25:02', '2023-11-06 17:18:38'),
(498, 305, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-11-09 04:06:09', '2023-11-09 04:06:09'),
(499, 307, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-11-15 05:23:21', '2023-11-15 05:23:21'),
(500, 308, 'App\\Service', '', '', '', '', '', '', '', '', '', '2023-11-16 07:04:37', '2023-11-16 15:45:31'),
(501, 309, 'App\\Service', 'SRC Merkezi', 'srcmerkezi', 'srcmerkezi', '', '', '0', '', '', '', '2023-11-17 09:34:57', '2023-11-23 20:16:21'),
(502, 310, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-11-20 05:44:16', '2023-11-20 05:44:16'),
(503, 312, 'App\\Service', '', '', '', '', '', NULL, '', '', NULL, '2023-11-24 10:07:43', '2023-11-24 10:07:43');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_11_06_180949_create_admins_table', 1),
(6, '2019_12_07_082524_create_static_options_table', 1),
(7, '2019_12_08_171750_create_counterups_table', 1),
(8, '2019_12_09_063224_create_testimonials_table', 1),
(10, '2019_12_10_125636_create_support_infos_table', 1),
(15, '2019_12_13_221931_create_languages_table', 1),
(27, '2020_04_14_082508_create_media_uploads_table', 4),
(31, '2020_07_22_132250_create_popup_builders_table', 5),
(33, '2020_04_20_170818_create_orders_table', 6),
(34, '2020_04_21_142420_create_payment_logs_table', 7),
(38, '2021_03_24_140243_create_menus_table', 11),
(41, '2021_03_27_113444_create_counterups_table', 14),
(46, '2020_06_14_081955_create_widgets_table', 16),
(47, '2019_12_10_125607_create_social_icons_table', 17),
(59, '2021_04_10_060146_create_infobar_right_icons_table', 18),
(60, '2021_04_11_063158_create_blogs_table', 18),
(61, '2021_04_11_063236_create_blog_langs_table', 18),
(62, '2021_04_11_063420_create_blog_categories_table', 18),
(63, '2021_04_11_063445_create_blog_category_langs_table', 18),
(64, '2019_12_28_140343_create_key_features_table', 19),
(65, '2021_04_18_132805_create_header_sliders_table', 20),
(67, '2020_04_20_073746_create_quotes_table', 22),
(68, '2021_04_24_132853_create_progress_bars_table', 23),
(70, '2021_04_15_105203_create_appointment_bookings_table', 24),
(71, '2021_04_15_105212_create_appointment_reviews_table', 24),
(73, '2021_04_15_121056_create_appointment_booking_times_table', 24),
(76, '2020_07_08_132910_create_product_cupons_table', 26),
(77, '2020_07_08_161737_create_product_shippings_table', 26),
(80, '2020_07_13_124351_create_product_orders_table', 26),
(81, '2020_07_21_053307_create_product_ratings_table', 26),
(82, '2021_04_15_105219_create_appointment_categories_table', 27),
(83, '2021_04_26_090448_create_appointment_category_langs_table', 27),
(84, '2021_04_15_105154_create_appointments_table', 28),
(85, '2021_04_26_095611_create_appointment_langs_table', 28),
(88, '2020_07_09_084606_create_product_categories_table', 29),
(89, '2021_04_28_104831_create_product_category_langs_table', 29),
(93, '2021_04_28_110990_create_products_table', 30),
(94, '2021_04_28_110995_create_products_langs_table', 30),
(102, '2020_01_25_155448_create_pages_table', 31),
(106, '2021_04_30_113454_create_page_langs_table', 32),
(107, '2021_04_30_141804_create_service_category_langs_table', 32),
(108, '2020_01_23_162404_create_service_categories_table', 33),
(109, '2021_05_01_152404_create_services_table', 34),
(110, '2021_05_01_152405_create_services_langs_table', 35),
(111, '2021_05_06_092507_create_price_plans_table', 36),
(112, '2021_05_06_092508_create_price_plan_langs_table', 36),
(113, '2021_05_18_062316_create_practice_areas_table', 37),
(114, '2021_05_18_062351_create_cases_table', 37),
(115, '2021_05_18_062404_create_attorneys_table', 37),
(116, '2021_05_19_111058_create_practice_area_categories_table', 37),
(117, '2021_05_19_111128_create_practice_area_category_langs_table', 37),
(119, '2021_05_20_045324_create_practice_area_langs_table', 38),
(120, '2021_05_20_120226_create_case_categories_table', 39),
(121, '2021_05_20_120508_create_case_category_langs_table', 39),
(122, '2021_05_20_120550_create_case_langs_table', 39),
(123, '2021_05_22_114053_create_attorney_langs_table', 40),
(124, '2021_05_24_050431_create_consulations_table', 41),
(125, '2021_08_17_093522_create_blog_categories_table', 42),
(126, '2021_08_17_093537_create_blogs_table', 42),
(127, '2021_08_18_101922_create_pages_table', 43),
(129, '2021_08_19_042434_create_event_categories_table', 45),
(130, '2021_08_19_042457_create_events_table', 45),
(131, '2021_08_19_130619_create_donations_table', 46),
(132, '2021_08_21_051439_create_contributions_table', 47),
(133, '2021_08_26_130940_create_social_icons_table', 48),
(134, '2021_08_28_061248_create_contribution_payment_logs_table', 49),
(135, '2021_08_28_061308_create_event_payment_logs_table', 49),
(136, '2021_08_28_120014_create_event_attendances_table', 50),
(137, '2021_08_28_122103_create_event_attendances_table', 51),
(138, '2021_09_02_044018_create_permission_tables', 52),
(139, '2021_09_02_060623_create_admin_roles_table', 53),
(140, '2021_09_26_094904_add_column_soft_deletes_to_blogs_table', 54),
(141, '2021_09_27_051529_create_blog_categories_table', 55),
(142, '2021_09_27_051607_create_blogs_table', 55),
(144, '2021_09_27_051709_create_meta_data_table', 55),
(146, '2021_09_27_064329_new_column_status_to_blogs_table', 56),
(147, '2021_10_04_060411_new_column_page_builder_status_to_page_table', 57),
(149, '2021_10_04_063133_create_page_builders_table', 58),
(150, '2021_10_04_122027_new_column_layout_to_pages_table', 59),
(151, '2021_10_07_054604_create_form_builders_table', 60),
(154, '2021_10_09_074153_add_new_column_to_media_uploads_table', 62),
(155, '2021_10_12_070221_new_column_permissions_to_users_table', 63),
(156, '2021_10_13_053529_create_tags_table', 64),
(157, '2021_10_13_054320_add_new_column_tags_to_blogs_table', 64),
(158, '2021_10_13_111623_create_blog_comments_table', 65),
(159, '2021_10_13_112008_add_new_column_image_to_users_table', 66),
(160, '2021_10_13_134025_add_new_column_social_to_users_table', 67),
(161, '2021_10_14_044046_add_new_column_parent_to_blog_comments_table', 68),
(170, '2021_10_21_095323_new_column_sidebar_to_pages_table', 76),
(171, '2021_10_24_063221_new_column_class_to_pages_table', 77),
(172, '2021_10_26_122003_add_column_breadcrumb_status_to_pages_table', 78),
(173, '2021_10_26_133647_add_column_footer_variant_to_pages_table', 79),
(174, '2021_10_30_041624_add_column_widget_style_to_pages_table', 80),
(175, '2021_10_30_044614_add_page_column_to_pages_table', 81),
(176, '2021_11_10_142735_add_column_image_blog_categories_table', 82),
(180, '2021_11_20_094154_add_column_description_to_users_table', 84),
(181, '2021_11_20_094906_add_column_description_to_admins_table', 85),
(183, '2014_10_12_000000_create_users_table', 86),
(184, '2021_11_28_090735_create_accountdeactives_table', 87),
(187, '2021_11_29_061320_create_categories_table', 88),
(190, '2021_11_30_073640_create_subcategories_table', 90),
(191, '2021_11_30_105303_create_services_table', 91),
(193, '2021_12_01_115855_create_serviceincludes_table', 92),
(196, '2021_12_01_131813_add_price_to_services', 93),
(197, '2021_12_02_072539_add_is_service_on_to_services_table', 94),
(198, '2021_12_01_120021_create_serviceadditionals_table', 95),
(199, '2021_12_01_120241_create_servicebenifits_table', 95),
(200, '2021_11_30_053538_create_locations_table', 96),
(201, '2021_12_05_050949_create_service_cities_table', 97),
(202, '2021_12_05_051309_create_service_areas_table', 97),
(203, '2021_12_07_043941_create_countries_table', 98),
(207, '2021_12_13_062919_create_schedules_table', 99),
(210, '2021_12_14_070939_create_days_table', 100),
(211, '2021_12_17_093220_create_orders_table', 101),
(212, '2021_12_17_171630_create_order_includes_table', 102),
(213, '2021_12_17_171651_create_order_additionals_table', 102),
(214, '2021_12_20_070438_create_reviews_table', 103),
(215, '2022_01_06_131123_create_brands_table', 104),
(216, '2022_01_17_041615_create_notifications_table', 105),
(217, '2022_01_17_101451_create_service_coupons_table', 106),
(218, '2022_01_23_041226_create_support_tickets_table', 107),
(220, '2022_01_23_105302_create_support_ticket_messages_table', 108),
(221, '2022_01_24_135321_create_payout_requests_table', 109),
(222, '2022_01_26_074206_create_to_do_lists_table', 110),
(224, '2022_02_07_123947_create_amount_settings_table', 112),
(225, '2022_03_17_051426_add_extra_fields_to_user_table', 113),
(226, '2022_03_17_051428_add_extra_fields_to_user_table', 114),
(227, '2022_03_22_075312_create_seller_verifies_table', 115),
(228, '2022_03_23_064136_add_manual_payment_image_to_orders_table', 115),
(229, '2022_03_27_042022_add_order_complete_request_to_orders_table', 115),
(230, '2022_03_27_100209_add_cancel_order_money_return_to_orders_table', 115),
(231, '2022_04_01_040848_change_data_type_of_orders_table', 116),
(232, '2022_04_01_040848_change_data_type_of_orders_table', 116),
(233, '2022_04_01_041340_change_data_type_of_seller_verifies_table', 116),
(234, '2022_04_01_041340_change_data_type_of_seller_verifies_table', 116),
(235, '2022_04_01_041521_change_data_type_of_serviceadditionals_table', 116),
(236, '2022_04_01_041521_change_data_type_of_serviceadditionals_table', 116),
(237, '2022_04_01_041655_change_data_type_of_servicebenifits_table', 116),
(238, '2022_04_01_041655_change_data_type_of_servicebenifits_table', 116),
(239, '2022_04_01_042025_change_data_type_of_serviceincludes_table', 116),
(240, '2022_04_01_042025_change_data_type_of_serviceincludes_table', 116),
(241, '2022_04_01_042222_change_data_type_of_services_table', 116),
(242, '2022_04_01_042222_change_data_type_of_services_table', 116),
(243, '2022_04_01_042426_change_data_type_of_service_coupons_table', 116),
(244, '2022_04_01_042426_change_data_type_of_service_coupons_table', 116),
(245, '2022_04_01_042542_change_data_type_of_support_tickets_table', 116),
(246, '2022_04_01_042542_change_data_type_of_support_tickets_table', 116),
(247, '2022_04_01_042813_change_data_type_of_to_do_lists_table', 116),
(248, '2022_04_01_042813_change_data_type_of_to_do_lists_table', 116),
(249, '2019_12_14_000001_create_personal_access_tokens_table', 117),
(250, '2022_04_20_052902_create_sliders_table', 118),
(252, '2022_04_21_040113_add_sold_count_to_services_table', 119),
(256, '2022_04_24_072211_create_online_service_faqs_table', 121),
(259, '2022_04_24_085125_add_online_service_price_to_services_table', 122),
(260, '2022_04_24_095152_add_delivery_days_to_services_table', 122),
(261, '2022_04_24_095231_add_revision_to_services_table', 122),
(262, '2022_04_25_040102_add_is_service_online_to_services_table', 123),
(263, '2022_04_27_034803_add_is_order_online_to_orders_table', 124),
(264, '2022_04_27_053223_add_image_gallery_to_services_table', 125),
(265, '2022_04_27_073345_add_video_to_services_table', 126),
(266, '2022_04_27_073345_add_country_code_column_to_users_table', 127),
(267, '2022_04_27_073345_add_mobile_icon_fields_to_categories_table', 127),
(268, '2022_06_09_124645_create_reports_table', 128),
(269, '2022_05_30_060241_create_live_chat_messages_table', 129),
(270, '2022_08_10_083550_add_user_type_to_service_coupons_table', 130),
(271, '2022_08_10_113702_create_taxes_table', 130),
(272, '2022_05_12_044924_create_subscriptions_table', 131),
(273, '2022_05_14_092755_create_seller_subscriptions_table', 131),
(274, '2022_07_02_051127_create_subscription_coupons_table', 131),
(275, '2022_09_04_070638_create_subscription_histories_table', 132),
(278, '2022_01_26_141520_create_admin_commissions_table', 133),
(279, '2022_08_10_083550_add_ system_type_to_ admin_commissions_table', 134),
(280, '2022_09_23_152012_create_extra_services_table', 134),
(281, '2022_10_01_092840_add_admin_id_and_guard_name_to_services_table', 134),
(284, '2022_10_11_061913_create_buyer_jobs_table', 135),
(285, '2022_10_15_054247_create_job_requests_table', 136),
(286, '2022_10_16_083603_create_job_request_conversations_table', 137),
(287, '2022_10_17_081334_add_order_from_job_and_job_post_id_to_orders_table', 138),
(288, '2022_10_20_084216_create_seller_view_jobs_table', 139),
(289, '2022_10_23_073450_add_is_service_all_cities_to_services_table', 140),
(290, '2022_10_23_103240_add_allow_multiple_schedule_to_schedules_table', 141),
(291, '2022_11_02_060742_create_wallets_table', 142),
(292, '2022_11_02_061244_create_wallet_histories_table', 142),
(293, '2022_11_10_075331_create_order_complete_declines_table', 143),
(294, '2022_11_16_104801_create_edit_service_histories_table', 144),
(296, '2022_11_17_045413_create_report_chat_messages_table', 145),
(298, '2022_11_20_062439_add_image_to_order_complete_declines_table', 146),
(299, '2022_12_04_110015_create_child_categories_table', 147),
(300, '2022_12_05_051245_add_child_category_id_to_services_table', 147),
(301, '2022_12_06_050213_add_child_category_id_to_buyer_jobs_table', 147),
(302, '2022_12_18_020211_create_custom_font_imports_table', 147),
(303, '2022_12_19_050630_add_path_to_custom_font_imports_table', 147),
(305, '2023_02_07_130746_add_order_id_add_type_to_reviews_table', 148),
(306, '2023_02_11_235025_add_service_add_job_to_subscriptions_table', 148),
(307, '2023_02_12_002249_add_initial_connect_add_initial_job_to_seller_subscriptions_table', 148),
(308, '2023_02_27_131645_create_admin_notifications_table', 148),
(309, '2023_02_28_111829_add_job_post_id_to_admin_notifications_table', 148),
(310, '2023_04_29_074300_add_last_seen_to_users_table', 149),
(311, '2023_05_21_134412_add_description_to_categories_table', 150),
(312, '2023_05_21_134700_add_description_to_subcategories_table', 151),
(313, '2023_05_21_134727_add_description_to_child_categories_table', 151),
(314, '2023_05_28_110505_create_xg_ftp_infos_table', 152),
(315, '2023_05_31_133542_add_otp_code_to_users_table', 153),
(316, '2023_06_01_054206_add_otp_expire_at_to_users_table', 153),
(317, '2023_06_04_062734_add_otp_verified_to_users_table', 153),
(318, '2023_06_05_070116_add_country_code_to_countries_table', 153),
(320, '2023_06_15_052755_add_latitude_add_longitude_to_users_table', 154),
(321, '2023_06_15_055051_create_zone_users_table', 155),
(322, '2023_06_15_065600_add_zone_id_to_users_table', 156),
(323, '2023_06_15_121632_create_category_zones_table', 157),
(324, '2023_06_13_072650_create_zones_table', 158),
(326, '2023_06_21_091202_add_latitude_add_longitude_to_countries_table', 159),
(327, '2023_06_25_090942_add_zone_status_to_countries_table', 160),
(332, '2023_07_18_230809_change_category_id_bigint_in_child_categories', 161),
(333, '2023_07_18_233142_change_category_id_bigint_in_subcategories', 162),
(334, '2023_07_30_065017_add_seller_address_to_users', 163),
(335, '2023_08_14_175503_add_flag_to_countries_table', 164),
(336, '2023_09_23_064406_add_flag_url_to_countries_table', 164),
(337, '2023_10_10_125154_create_user_unique_keys_table', 164),
(338, '2023_10_16_140933_create_admin_notices_table', 164),
(339, '2023_10_17_113938_add_invoice_to_orders', 164),
(340, '2023_10_19_134237_modify_subcategory_id_in_services', 164),
(341, '2023_10_19_144128_add_tax_number_to_users', 164),
(342, '2023_11_13_120602_add_password_changed_at_to_users', 165),
(343, '2023_11_14_140552_add_service_area_id_services', 165),
(344, '2023_11_21_114552_add_service_add_job_to_subscription_histories', 165),
(345, '2023_11_21_114800_add_service_add_job_to_seller_subscriptions', 165),
(346, '2024_01_01_000002_create_regions_table', 166),
(347, '2024_01_01_000003_create_pricing_rules_table', 166),
(348, '2024_01_01_000004_create_quality_followups_table', 166),
(349, '2024_01_01_000005_update_users_table_for_maintenance_roles', 166),
(350, '2024_01_01_000006_create_technician_regions_table', 166),
(351, '2024_01_01_000007_add_maintenance_fields_to_orders_table', 167),
(352, '2025_11_15_005210_add_issue_image_to_orders_table', 168),
(353, '2025_01_15_000001_add_invoice_warranty_fields_to_orders_table', 169),
(354, '2025_11_16_122550_add_technician_report_fields_to_orders_table', 170);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Admin', 1),
(4, 'App\\User', 1933),
(5, 'App\\User', 1934),
(5, 'App\\User', 1968),
(5, 'App\\User', 1969),
(5, 'App\\User', 1970),
(5, 'App\\User', 1971),
(5, 'App\\User', 1972),
(5, 'App\\User', 1973),
(5, 'App\\User', 2005),
(5, 'App\\User', 2006),
(5, 'App\\User', 2007),
(5, 'App\\User', 2008),
(5, 'App\\User', 2009),
(5, 'App\\User', 2010),
(5, 'App\\User', 2041),
(5, 'App\\User', 2042),
(5, 'App\\User', 2043),
(5, 'App\\User', 2044),
(5, 'App\\User', 2045),
(5, 'App\\User', 2046),
(6, 'App\\User', 1935),
(6, 'App\\User', 1938),
(6, 'App\\User', 1939),
(6, 'App\\User', 1940),
(6, 'App\\User', 1941),
(6, 'App\\User', 1942),
(6, 'App\\User', 1943),
(6, 'App\\User', 1944),
(6, 'App\\User', 1945),
(6, 'App\\User', 1946),
(6, 'App\\User', 1947),
(6, 'App\\User', 1948),
(6, 'App\\User', 1949),
(6, 'App\\User', 1950),
(6, 'App\\User', 1951),
(6, 'App\\User', 1952),
(6, 'App\\User', 1953),
(6, 'App\\User', 1954),
(6, 'App\\User', 1955),
(6, 'App\\User', 1956),
(6, 'App\\User', 1957),
(6, 'App\\User', 1958),
(6, 'App\\User', 1959),
(6, 'App\\User', 1960),
(6, 'App\\User', 1961),
(6, 'App\\User', 1962),
(6, 'App\\User', 1963),
(6, 'App\\User', 1964),
(6, 'App\\User', 1965),
(6, 'App\\User', 1966),
(6, 'App\\User', 1967),
(6, 'App\\User', 1975),
(6, 'App\\User', 1976),
(6, 'App\\User', 1977),
(6, 'App\\User', 1978),
(6, 'App\\User', 1979),
(6, 'App\\User', 1980),
(6, 'App\\User', 1981),
(6, 'App\\User', 1982),
(6, 'App\\User', 1983),
(6, 'App\\User', 1984),
(6, 'App\\User', 1985),
(6, 'App\\User', 1986),
(6, 'App\\User', 1987),
(6, 'App\\User', 1988),
(6, 'App\\User', 1989),
(6, 'App\\User', 1990),
(6, 'App\\User', 1991),
(6, 'App\\User', 1992),
(6, 'App\\User', 1993),
(6, 'App\\User', 1994),
(6, 'App\\User', 1995),
(6, 'App\\User', 1996),
(6, 'App\\User', 1997),
(6, 'App\\User', 1998),
(6, 'App\\User', 1999),
(6, 'App\\User', 2000),
(6, 'App\\User', 2001),
(6, 'App\\User', 2002),
(6, 'App\\User', 2003),
(6, 'App\\User', 2004),
(6, 'App\\User', 2011),
(6, 'App\\User', 2012),
(6, 'App\\User', 2013),
(6, 'App\\User', 2014),
(6, 'App\\User', 2015),
(6, 'App\\User', 2016),
(6, 'App\\User', 2017),
(6, 'App\\User', 2018),
(6, 'App\\User', 2019),
(6, 'App\\User', 2020),
(6, 'App\\User', 2021),
(6, 'App\\User', 2022),
(6, 'App\\User', 2023),
(6, 'App\\User', 2024),
(6, 'App\\User', 2025),
(6, 'App\\User', 2026),
(6, 'App\\User', 2027),
(6, 'App\\User', 2028),
(6, 'App\\User', 2029),
(6, 'App\\User', 2030),
(6, 'App\\User', 2031),
(6, 'App\\User', 2032),
(6, 'App\\User', 2033),
(6, 'App\\User', 2034),
(6, 'App\\User', 2035),
(6, 'App\\User', 2036),
(6, 'App\\User', 2037),
(6, 'App\\User', 2038),
(6, 'App\\User', 2039),
(6, 'App\\User', 2040),
(7, 'App\\User', 1936),
(8, 'App\\User', 1937);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(191) NOT NULL,
  `notifiable_type` varchar(191) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('499c1bb4-1e78-4620-bad9-ffa26a670890', 'App\\Notifications\\OrderNotification', 'App\\User', 1933, '{\"order_id\":\"71\",\"service_id\":\"366\",\"seller_id\":\"1\",\"buyer_id\":null,\"order_message\":\"New order received - Order #71\"}', NULL, '2025-11-16 09:22:30', '2025-11-16 09:22:30'),
('653acdb4-d24a-41b3-925a-7b2edf832b3c', 'App\\Notifications\\OrderNotification', 'App\\User', 1, '{\"order_id\":\"71\",\"service_id\":\"366\",\"seller_id\":\"1\",\"buyer_id\":null,\"order_message\":\"You have a new order\"}', NULL, '2025-11-16 09:22:30', '2025-11-16 09:22:30'),
('67005e8b-8d12-45ec-94cf-3629683ef678', 'App\\Notifications\\OrderNotification', 'App\\User', 1933, '{\"order_id\":\"72\",\"service_id\":\"366\",\"seller_id\":\"1\",\"buyer_id\":null,\"order_message\":\"New order received - Order #72\"}', NULL, '2025-11-17 19:20:01', '2025-11-17 19:20:01'),
('ea4284c9-f75c-4f70-a590-6e6faa314d18', 'App\\Notifications\\OrderNotification', 'App\\User', 1, '{\"order_id\":\"72\",\"service_id\":\"366\",\"seller_id\":\"1\",\"buyer_id\":null,\"order_message\":\"You have a new order\"}', NULL, '2025-11-17 19:20:01', '2025-11-17 19:20:01');

-- --------------------------------------------------------

--
-- Table structure for table `online_service_faqs`
--

CREATE TABLE `online_service_faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) DEFAULT NULL,
  `seller_id` bigint(20) DEFAULT NULL,
  `title` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `online_service_faqs`
--

INSERT INTO `online_service_faqs` (`id`, `service_id`, `seller_id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(10, 49, 1, 'werwer w', 'wer werw', NULL, NULL),
(11, 49, 1, 'werwer', 'werwer', NULL, NULL),
(34, 76, 1, 'are you available always', 'yes', NULL, NULL),
(35, 76, 1, 'what', 'no', NULL, NULL),
(36, 79, 1, 'i long ', 'just 1 minute', NULL, NULL),
(50, 82, 1, 'faq 1', 'faq 1', NULL, '2023-01-24 18:46:25'),
(51, 82, 1, 'faq 2', 'faq 2', NULL, '2023-01-24 18:46:25'),
(52, 82, 1, 'faq 3', 'faq 3', NULL, '2023-01-24 18:46:25'),
(60, 113, 1536, 'Benefit Of This Package', 'gfgfdgfd fg dfg', NULL, NULL),
(61, 175, 1536, 'title one', 'desc one', NULL, NULL),
(62, 175, 1536, 'title two', 'desc two', NULL, NULL),
(63, 175, 1536, 'title three', 'desc three', NULL, NULL),
(64, 176, 1536, 'dsfdsf', 'sdfsadfs', NULL, NULL),
(65, 176, 1536, 'fsdf', 'fdfsdf', NULL, NULL),
(66, 176, 1536, 'dsfds', 'fsdfd', NULL, NULL),
(67, 176, 1536, 'fsdf', 'sdfdsf', NULL, NULL),
(68, 178, 1536, 'one', 'des one', NULL, NULL),
(69, 178, 1536, 'two', 'des two', NULL, NULL),
(70, 178, 1536, 'two ', 'des two', NULL, NULL),
(71, 179, 1536, 'dfsdf', 'sdfsdf', NULL, NULL),
(72, 179, 1536, 'fsdfsd', 'fdsfdsf', NULL, NULL),
(73, 179, 1536, 'fsdfdsf', 'sf', NULL, NULL),
(74, 192, 1536, 'one tiltedsf', 'one infodsf', NULL, NULL),
(75, 192, 1536, 'two title', 'two info', NULL, NULL),
(76, 192, 1536, 'sd f', 'd fdsf', NULL, NULL),
(77, 192, 1536, 'dsf', 'fd sf', NULL, NULL),
(78, 192, 1536, 'fsdf', 'sdfa d', NULL, NULL),
(79, 193, 1536, 'Faqs one', 'Faqs one', NULL, NULL),
(80, 193, 1536, 'Faqs two', 'Faqs two', NULL, NULL),
(81, 193, 1536, 'Faqs three', 'Faqs three', NULL, NULL),
(82, 193, 1536, 'Faqs four', 'Faqs four', NULL, NULL),
(83, 194, 1536, '1', '1', NULL, NULL),
(84, 194, 1536, '2', '2', NULL, NULL),
(85, 194, 1536, '3', '3', NULL, NULL),
(86, 195, 1536, 'one ', 'one ', NULL, NULL),
(87, 195, 1536, 'two', 'two', NULL, NULL),
(257, 240, 1, 'This is best food', 'new food items new food items new food items new food items new food items new food items new food items new food items new food items new food items new food items new food items new food items new food items new food items new food items new food items new food items new food items new food items new food items new food items new food items new food items new food items new food items new food items new food items new food items new food items new food items new food items new food items new food items ', NULL, NULL),
(261, 245, 1, 'Faq-1', 'This is Good Service one', NULL, NULL),
(262, 245, 1, 'Faq-2', 'This is Good Service one', NULL, NULL),
(263, 245, 1, 'Faq-3', 'This is Good Service one', NULL, NULL),
(267, 50, 1, 'Faq', 'Faq Description', NULL, NULL),
(268, 41, 1, 'What is...', 'Desc....', NULL, NULL),
(269, 41, 1, 'How much...', 'Desc....', NULL, NULL),
(270, 41, 1, 'How to...', 'Desc....', NULL, NULL),
(271, 41, 1, 'When I...', 'Desc....', NULL, NULL),
(273, 260, 1677, 'sggsgs', 'sgsggs', NULL, NULL),
(274, 261, 1, 'ZxZ', 'ZZZZ', NULL, NULL),
(276, 266, 1, 'what if I don\'t use the full 3 houes', 'we will find something to clean, windows, walls, etc', NULL, NULL),
(277, 266, 1, 'can you do cooking and cleaning ', 'please see our other offer', NULL, NULL),
(278, 269, 1, 'jajaj', 'najja', NULL, NULL),
(279, 270, 1743, 'Maintaiance ', 'all services free afte once repair ', NULL, NULL),
(280, 270, 1743, 'Repais', 'No new chardfs', NULL, NULL),
(281, 280, 1800, 'afg', 'agghh', NULL, NULL),
(282, 298, 1, 'Why?', 'sssssssssssss', NULL, NULL),
(283, 301, 1, 'bbebe', 'vssvsv', NULL, NULL),
(285, 310, 1, 'winfoe', 'hdiddj', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice` varchar(191) DEFAULT NULL,
  `invoice_pdf` varchar(191) DEFAULT NULL COMMENT 'مسار ملف الفاتورة PDF',
  `invoice_number` varchar(191) DEFAULT NULL COMMENT 'رقم الفاتورة',
  `invoice_date` date DEFAULT NULL COMMENT 'تاريخ إصدار الفاتورة',
  `invoice_issued_by` int(11) DEFAULT NULL COMMENT 'ID من أصدر الفاتورة',
  `tracking_code` varchar(191) DEFAULT NULL,
  `warranty_code` varchar(191) DEFAULT NULL,
  `warranty_pdf` varchar(191) DEFAULT NULL COMMENT 'مسار ملف شهادة الضمان PDF',
  `warranty_issued_at` timestamp NULL DEFAULT NULL COMMENT 'تاريخ إصدار شهادة الضمان',
  `warranty_issued_by` int(11) DEFAULT NULL COMMENT 'ID من أصدر شهادة الضمان',
  `warranty_days` int(11) NOT NULL DEFAULT 30,
  `has_warranty` tinyint(1) NOT NULL DEFAULT 1,
  `service_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `assigned_by` int(11) DEFAULT NULL COMMENT 'ID of admin/support who assigned',
  `buyer_id` int(11) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `post_code` varchar(191) NOT NULL,
  `address` varchar(191) NOT NULL,
  `city` bigint(20) DEFAULT NULL,
  `area` bigint(20) DEFAULT NULL,
  `region_id` bigint(20) UNSIGNED DEFAULT NULL,
  `country` bigint(20) DEFAULT NULL,
  `date` varchar(191) NOT NULL,
  `schedule` varchar(191) NOT NULL,
  `package_fee` double NOT NULL,
  `extra_service` double NOT NULL,
  `sub_total` double NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL,
  `coupon_code` varchar(191) DEFAULT NULL,
  `coupon_type` varchar(191) DEFAULT NULL,
  `coupon_amount` double DEFAULT NULL,
  `commission_type` varchar(191) DEFAULT NULL,
  `commission_charge` double DEFAULT NULL,
  `commission_amount` double DEFAULT NULL,
  `payment_gateway` varchar(191) DEFAULT NULL,
  `payment_status` varchar(191) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0=pending, 1=active, 2=completed, 3=delivered, 4=cancelled',
  `urgency_level` varchar(191) NOT NULL DEFAULT 'normal' COMMENT 'normal, urgent, emergency',
  `assigned_at` timestamp NULL DEFAULT NULL,
  `accepted_at` timestamp NULL DEFAULT NULL,
  `en_route_at` timestamp NULL DEFAULT NULL,
  `arrived_at` timestamp NULL DEFAULT NULL,
  `started_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `is_order_online` int(11) NOT NULL DEFAULT 0,
  `order_complete_request` int(11) NOT NULL DEFAULT 0,
  `cancel_order_money_return` int(11) NOT NULL DEFAULT 0,
  `transaction_id` varchar(191) DEFAULT NULL,
  `order_note` varchar(191) DEFAULT NULL,
  `issue_image` varchar(191) DEFAULT NULL COMMENT 'صورة العطل أو المشكلة',
  `issue_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'صور العطل المتعددة' CHECK (json_valid(`issue_images`)),
  `notes` text DEFAULT NULL,
  `technician_report` longtext DEFAULT NULL,
  `technician_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`technician_images`)),
  `technician_videos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`technician_videos`)),
  `technician_report_submitted_at` timestamp NULL DEFAULT NULL,
  `admin_pricing` decimal(10,2) DEFAULT NULL,
  `admin_pricing_notes` text DEFAULT NULL,
  `admin_pricing_at` timestamp NULL DEFAULT NULL,
  `admin_pricing_by` bigint(20) UNSIGNED DEFAULT NULL,
  `order_from_job` varchar(191) DEFAULT NULL,
  `job_post_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `manual_payment_image` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `invoice`, `invoice_pdf`, `invoice_number`, `invoice_date`, `invoice_issued_by`, `tracking_code`, `warranty_code`, `warranty_pdf`, `warranty_issued_at`, `warranty_issued_by`, `warranty_days`, `has_warranty`, `service_id`, `seller_id`, `assigned_by`, `buyer_id`, `name`, `email`, `phone`, `post_code`, `address`, `city`, `area`, `region_id`, `country`, `date`, `schedule`, `package_fee`, `extra_service`, `sub_total`, `tax`, `total`, `coupon_code`, `coupon_type`, `coupon_amount`, `commission_type`, `commission_charge`, `commission_amount`, `payment_gateway`, `payment_status`, `status`, `urgency_level`, `assigned_at`, `accepted_at`, `en_route_at`, `arrived_at`, `started_at`, `completed_at`, `is_order_online`, `order_complete_request`, `cancel_order_money_return`, `transaction_id`, `order_note`, `issue_image`, `issue_images`, `notes`, `technician_report`, `technician_images`, `technician_videos`, `technician_report_submitted_at`, `admin_pricing`, `admin_pricing_notes`, `admin_pricing_at`, `admin_pricing_by`, `order_from_job`, `job_post_id`, `created_at`, `updated_at`, `manual_payment_image`) VALUES
(1, 'INV-2025-000001', NULL, NULL, NULL, NULL, 'TRK-69184FC043E61', NULL, NULL, NULL, NULL, 30, 1, 313, 1934, NULL, 1935, 'Client', 'client@syanteck.com', '0500000003', '32712', 'شارع 56، حي العليا', 1, 1, NULL, 1, '2025-12-06', 'ظهراً', 203, 161, 364, 54.6, 418.6, NULL, NULL, NULL, NULL, NULL, NULL, 'online', 'failed', 0, 'medium', '2025-10-23 07:02:40', NULL, NULL, NULL, NULL, NULL, 1, 0, 0, NULL, 'ملاحظات الطلب: صيانة عادية', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:02:40', '2025-11-15 08:02:40', NULL),
(2, 'INV-2025-000002', NULL, NULL, NULL, NULL, 'TRK-69184FC044E48', NULL, NULL, NULL, NULL, 30, 1, 317, 1934, NULL, 1935, 'Client', 'client@syanteck.com', '0500000003', '30995', 'شارع 6، حي العليا', 1, 1, NULL, 1, '2025-12-03', 'ظهراً', 280, 5, 285, 42.75, 327.75, NULL, NULL, NULL, NULL, NULL, NULL, 'cash', 'pending', 0, 'high', '2025-11-01 08:02:40', NULL, NULL, NULL, NULL, NULL, 1, 0, 0, NULL, 'ملاحظات الطلب: صيانة عادية', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:02:40', '2025-11-15 08:02:40', NULL),
(3, 'INV-2025-000003', NULL, NULL, NULL, NULL, 'TRK-69184FC045667', NULL, NULL, NULL, NULL, 30, 1, 315, 1934, NULL, 3, 'Md xyz', 'testdoc2021@gmail.com', '+8801713606060', '72107', 'شارع 41، حي الملز', 1, 1, NULL, 1, '2025-11-29', 'مساءً', 374, 94, 468, 70.2, 538.2, NULL, NULL, NULL, NULL, NULL, NULL, 'cash', 'pending', 0, 'high', '2025-11-10 08:02:40', NULL, NULL, NULL, NULL, NULL, 1, 0, 0, NULL, 'ملاحظات الطلب: إصلاح عطل', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:02:40', '2025-11-15 08:02:40', NULL),
(4, 'INV-2025-000004', NULL, NULL, NULL, NULL, 'TRK-69184FC0460F3', NULL, NULL, NULL, NULL, 30, 1, 322, 1934, NULL, 1935, 'Client', 'client@syanteck.com', '0500000003', '86580', 'شارع 95، حي النزهة', 1, 1, NULL, 1, '2025-12-04', 'صباحاً', 174, 83, 257, 38.55, 295.55, NULL, NULL, NULL, NULL, NULL, NULL, 'bank_transfer', 'failed', 0, 'low', '2025-10-17 07:02:40', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'ملاحظات الطلب: صيانة عادية', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:02:40', '2025-11-15 08:02:40', NULL),
(5, 'INV-2025-000005', NULL, NULL, NULL, NULL, 'TRK-69184FC0469C5', NULL, NULL, NULL, NULL, 30, 1, 316, 1934, NULL, 1935, 'Client', 'client@syanteck.com', '0500000003', '89644', 'شارع 6، حي العليا', 1, 1, NULL, 1, '2025-12-04', 'ظهراً', 142, 96, 238, 35.7, 273.7, NULL, NULL, NULL, NULL, NULL, NULL, 'online', 'failed', 0, 'medium', '2025-10-17 07:02:40', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'ملاحظات الطلب: إصلاح عطل', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:02:40', '2025-11-15 08:02:40', NULL),
(6, 'INV-2025-000006', NULL, NULL, NULL, NULL, 'TRK-69184FC0474EC', NULL, NULL, NULL, NULL, 30, 1, 316, 1934, NULL, 5, 'Test Buyer', 'test_buyer_final@gmail.com', '98799999999', '62978', 'شارع 74، حي العليا', 1, 1, NULL, 1, '2025-11-23', 'صباحاً', 169, 51, 220, 33, 253, NULL, NULL, NULL, NULL, NULL, NULL, 'online', 'pending', 1, 'medium', '2025-11-03 08:02:40', '2025-11-03 16:02:40', NULL, NULL, NULL, NULL, 1, 0, 0, NULL, 'ملاحظات الطلب: صيانة عاجلة', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:02:40', '2025-11-15 08:02:40', NULL),
(7, 'INV-2025-000007', NULL, NULL, NULL, NULL, 'TRK-69184FC0480A1', NULL, NULL, NULL, NULL, 30, 1, 313, 1934, NULL, 3, 'Md xyz', 'testdoc2021@gmail.com', '+8801713606060', '77359', 'شارع 43، حي النزهة', 1, 1, NULL, 1, '2025-12-02', 'ظهراً', 181, 24, 205, 30.75, 235.75, NULL, NULL, NULL, NULL, NULL, NULL, 'cash', 'completed', 1, 'low', '2025-11-14 08:02:40', '2025-11-14 23:02:40', NULL, NULL, NULL, NULL, 1, 0, 0, NULL, 'ملاحظات الطلب: فحص شامل', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:02:40', '2025-11-15 08:02:40', NULL),
(8, 'INV-2025-000008', NULL, NULL, NULL, NULL, 'TRK-69184FC048B8F', NULL, NULL, NULL, NULL, 30, 1, 320, 1934, NULL, 3, 'Md xyz', 'testdoc2021@gmail.com', '+8801713606060', '27552', 'شارع 56، حي العليا', 1, 1, NULL, 1, '2025-11-19', 'مساءً', 229, 156, 385, 57.75, 442.75, NULL, NULL, NULL, NULL, NULL, NULL, 'online', 'completed', 1, 'low', '2025-11-07 08:02:40', '2025-11-08 02:02:40', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'ملاحظات الطلب: صيانة عاجلة', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:02:40', '2025-11-15 08:02:40', NULL),
(9, 'INV-2025-000009', NULL, NULL, NULL, NULL, 'TRK-69184FC04999E', NULL, NULL, NULL, NULL, 30, 1, 316, 1934, NULL, 3, 'Md xyz', 'testdoc2021@gmail.com', '+8801713606060', '11040', 'شارع 82، حي العليا', 1, 1, NULL, 1, '2025-12-12', 'مساءً', 122, 133, 255, 38.25, 293.25, NULL, NULL, NULL, NULL, NULL, NULL, 'bank_transfer', 'failed', 1, 'medium', '2025-11-13 08:02:40', '2025-11-14 05:02:40', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'ملاحظات الطلب: صيانة عاجلة', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:02:40', '2025-11-15 08:02:40', NULL),
(10, 'INV-2025-000010', NULL, NULL, NULL, NULL, 'TRK-69184FC04A62E', NULL, NULL, NULL, NULL, 30, 1, 313, 1934, NULL, 3, 'Md xyz', 'testdoc2021@gmail.com', '+8801713606060', '60798', 'شارع 44، حي العليا', 1, 1, NULL, 1, '2025-12-01', 'مساءً', 311, 103, 414, 62.1, 476.1, NULL, NULL, NULL, NULL, NULL, NULL, 'online', 'pending', 1, 'low', '2025-11-07 08:02:40', '2025-11-07 13:02:40', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'ملاحظات الطلب: فحص شامل', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:02:40', '2025-11-15 08:02:40', NULL),
(11, 'INV-2025-000011', NULL, NULL, NULL, NULL, 'TRK-69184FC04B211', NULL, NULL, NULL, NULL, 30, 1, 313, 1934, NULL, 5, 'Test Buyer', 'test_buyer_final@gmail.com', '98799999999', '46976', 'شارع 82، حي العليا', 1, 1, NULL, 1, '2025-12-13', 'ظهراً', 459, 33, 492, 73.8, 565.8, NULL, NULL, NULL, NULL, NULL, NULL, 'online', 'failed', 1, 'medium', '2025-11-08 08:02:40', '2025-11-09 04:02:40', NULL, NULL, NULL, NULL, 1, 0, 0, NULL, 'ملاحظات الطلب: إصلاح عطل', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:02:40', '2025-11-15 08:02:40', NULL),
(12, 'INV-2025-000012', NULL, NULL, NULL, NULL, 'TRK-69184FC04BBC3', NULL, NULL, NULL, NULL, 30, 1, 319, 1934, NULL, 1935, 'Client', 'client@syanteck.com', '0500000003', '20770', 'شارع 93، حي النزهة', 1, 1, NULL, 1, '2025-12-01', 'مساءً', 433, 142, 575, 86.25, 661.25, NULL, NULL, NULL, NULL, NULL, NULL, 'bank_transfer', 'pending', 1, 'high', '2025-11-07 08:02:40', '2025-11-08 04:02:40', NULL, NULL, NULL, NULL, 1, 0, 0, NULL, 'ملاحظات الطلب: صيانة عادية', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:02:40', '2025-11-15 08:02:40', NULL),
(13, 'INV-2025-000013', NULL, NULL, NULL, NULL, 'TRK-69184FC04C4DC', NULL, NULL, NULL, NULL, 30, 1, 316, 1934, NULL, 5, 'Test Buyer', 'test_buyer_final@gmail.com', '98799999999', '41428', 'شارع 100، حي الملز', 1, 1, NULL, 1, '2025-12-15', 'ظهراً', 471, 12, 483, 72.45, 555.45, NULL, NULL, NULL, NULL, NULL, NULL, 'cash', 'completed', 1, 'high', '2025-11-12 08:02:40', '2025-11-12 09:02:40', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'ملاحظات الطلب: فحص شامل', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:02:40', '2025-11-15 08:02:40', NULL),
(14, 'INV-2025-000014', NULL, NULL, NULL, NULL, 'TRK-69184FC04CFF7', 'WAR-69184FC04D13D', NULL, NULL, NULL, 276, 1, 314, 1934, NULL, 1935, 'Client', 'client@syanteck.com', '0500000003', '22847', 'شارع 13، حي العليا', 1, 1, NULL, 1, '2025-11-25', 'صباحاً', 141, 1, 142, 21.3, 163.3, NULL, NULL, NULL, NULL, NULL, NULL, 'online', 'completed', 2, 'low', '2025-10-21 07:02:40', '2025-10-21 23:02:40', NULL, NULL, NULL, '2025-10-22 23:02:40', 1, 0, 0, NULL, 'ملاحظات الطلب: إصلاح عطل', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:02:40', '2025-11-15 08:02:40', NULL),
(15, 'INV-2025-000015', NULL, NULL, NULL, NULL, 'TRK-69184FC04DB12', 'WAR-69184FC04DC5B', NULL, NULL, NULL, 213, 1, 315, 1934, NULL, 5, 'Test Buyer', 'test_buyer_final@gmail.com', '98799999999', '22467', 'شارع 45، حي الروضة', 1, 1, NULL, 1, '2025-12-01', 'مساءً', 453, 152, 605, 90.75, 695.75, NULL, NULL, NULL, NULL, NULL, NULL, 'online', 'completed', 2, 'low', '2025-10-22 07:02:40', '2025-10-23 05:02:40', NULL, NULL, NULL, '2025-10-26 05:02:40', 1, 0, 0, NULL, 'ملاحظات الطلب: صيانة عاجلة', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:02:40', '2025-11-15 08:02:40', NULL),
(16, 'INV-2025-000016', NULL, NULL, NULL, NULL, 'TRK-69184FC04E47F', 'WAR-69184FC04E5AA', NULL, NULL, NULL, 39, 1, 316, 1934, NULL, 1935, 'Client', 'client@syanteck.com', '0500000003', '32749', 'شارع 24، حي العليا', 1, 1, NULL, 1, '2025-11-23', 'صباحاً', 303, 22, 325, 48.75, 373.75, NULL, NULL, NULL, NULL, NULL, NULL, 'online', 'completed', 2, 'low', '2025-11-08 08:02:40', '2025-11-09 07:02:40', NULL, NULL, NULL, '2025-11-14 07:02:40', 0, 0, 0, NULL, 'ملاحظات الطلب: صيانة عاجلة', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:02:40', '2025-11-15 08:02:40', NULL),
(17, 'INV-2025-000017', NULL, NULL, NULL, NULL, 'TRK-69184FC04EDC7', 'WAR-69184FC04EEE2', NULL, NULL, NULL, 360, 1, 317, 1934, NULL, 1935, 'Client', 'client@syanteck.com', '0500000003', '25683', 'شارع 73، حي العليا', 1, 1, NULL, 1, '2025-11-19', 'صباحاً', 263, 140, 403, 60.45, 463.45, NULL, NULL, NULL, NULL, NULL, NULL, 'bank_transfer', 'completed', 2, 'high', '2025-10-30 07:02:40', '2025-10-31 05:02:40', NULL, NULL, NULL, '2025-11-04 05:02:40', 0, 0, 0, NULL, 'ملاحظات الطلب: صيانة عادية', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:02:40', '2025-11-15 08:02:40', NULL),
(18, 'INV-2025-000018', NULL, NULL, NULL, NULL, 'TRK-69184FC04F7B1', 'WAR-69184FC04FA12', NULL, NULL, NULL, 196, 1, 313, 1934, NULL, 5, 'Test Buyer', 'test_buyer_final@gmail.com', '98799999999', '80324', 'شارع 97، حي الروضة', 1, 1, NULL, 1, '2025-12-05', 'مساءً', 301, 114, 415, 62.25, 477.25, NULL, NULL, NULL, NULL, NULL, NULL, 'bank_transfer', 'completed', 2, 'high', '2025-11-09 08:02:40', '2025-11-10 07:02:40', NULL, NULL, NULL, '2025-11-11 07:02:40', 0, 0, 0, NULL, 'ملاحظات الطلب: صيانة عاجلة', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:02:40', '2025-11-15 08:02:40', NULL),
(19, 'INV-2025-000019', NULL, NULL, NULL, NULL, 'TRK-69184FC05051B', 'WAR-69184FC0506B7', NULL, NULL, NULL, 42, 1, 316, 1934, NULL, 3, 'Md xyz', 'testdoc2021@gmail.com', '+8801713606060', '55377', 'شارع 14، حي العليا', 1, 1, NULL, 1, '2025-12-15', 'مساءً', 119, 162, 281, 42.15, 323.15, NULL, NULL, NULL, NULL, NULL, NULL, 'bank_transfer', 'completed', 2, 'medium', '2025-11-06 08:02:40', '2025-11-06 13:02:40', NULL, NULL, NULL, '2025-11-10 13:02:40', 1, 0, 0, NULL, 'ملاحظات الطلب: إصلاح عطل', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:02:40', '2025-11-15 08:02:40', NULL),
(20, 'INV-2025-000020', NULL, NULL, NULL, NULL, 'TRK-69184FC0512AE', 'WAR-69184FC0513FC', NULL, NULL, NULL, 364, 1, 321, 1934, NULL, 3, 'Md xyz', 'testdoc2021@gmail.com', '+8801713606060', '98357', 'شارع 26، حي النزهة', 1, 1, NULL, 1, '2025-11-18', 'ظهراً', 132, 52, 184, 27.6, 211.6, NULL, NULL, NULL, NULL, NULL, NULL, 'online', 'completed', 2, 'high', '2025-11-12 08:02:40', '2025-11-12 15:02:40', NULL, NULL, NULL, '2025-11-14 15:02:40', 0, 0, 0, NULL, 'ملاحظات الطلب: فحص شامل', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:02:40', '2025-11-15 08:02:40', NULL),
(21, 'INV-44BSHZVC', NULL, 'INV-2025-000021', '2025-11-17', NULL, 'TRK-F3CJS5DOZA', 'WAR-AGBTAFJCPO', NULL, NULL, NULL, 95, 1, 363, 2042, 1, 2033, 'منصور خالد القحطاني', 'client23_1763201587@makkah.com', '0533214404', '27742', 'منطقة الاسكان، مكة المكرمة', 50, NULL, 115, 69, '2025-11-14', '19:00', 250, 81, 331, 49.65, 380.65, NULL, NULL, NULL, NULL, NULL, NULL, 'cash', 'complete', 2, 'urgent', '2025-11-14 11:13:09', '2025-11-14 14:13:09', NULL, NULL, NULL, '2025-11-17 08:13:09', 0, 0, 0, NULL, 'مكيف يخرج هواء ساخن', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-14 08:13:09', '2025-11-15 08:13:09', NULL),
(22, 'INV-FTMXZZIW', NULL, 'INV-2025-000022', '2025-11-12', NULL, 'TRK-YZGFDWS8DK', 'WAR-ISRXXKTLYL', NULL, NULL, NULL, 59, 1, 355, 2041, 1, 2026, 'وليد هشام الرشيد', 'client16_1763201586@makkah.com', '0578879564', '20141', 'منطقة الريان، مكة المكرمة', 50, NULL, 162, 69, '2025-11-11', '17:00', 150, 127, 277, 41.55, 318.55, NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', 'complete', 2, 'normal', '2025-11-11 12:13:09', '2025-11-11 15:13:09', NULL, NULL, NULL, '2025-11-12 08:13:09', 0, 0, 0, NULL, 'مفتاح كهربائي معطل', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 08:13:09', '2025-11-15 08:13:09', NULL),
(23, 'INV-JIHQBDMV', NULL, 'INV-2025-000023', '2025-10-27', NULL, 'TRK-ZCEKLVQP5T', 'WAR-YBAPYPSZEJ', NULL, NULL, NULL, 33, 1, 364, 2046, 1, 2020, 'حسام عبدالله الثقفي', 'client10_1763201585@makkah.com', '0541195728', '25936', 'منطقة الزهراء، مكة المكرمة', 50, NULL, 114, 69, '2025-10-24', '20:00', 180, 183, 363, 54.45, 417.45, NULL, NULL, NULL, NULL, NULL, NULL, 'bank_transfer', 'complete', 3, 'urgent', '2025-10-24 09:13:09', '2025-10-24 12:13:09', NULL, NULL, NULL, '2025-10-27 07:13:09', 0, 0, 0, NULL, 'مكيف يصدر صوت عالي', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-24 07:13:09', '2025-11-15 08:13:09', NULL),
(24, 'INV-X8ONQZAG', NULL, NULL, NULL, NULL, 'TRK-9DAXCCUCMH', NULL, NULL, NULL, NULL, 30, 0, 360, 2045, 1, 2034, 'مشاري سعد الحربي', 'client24_1763201587@makkah.com', '0555501867', '25425', 'منطقة مخطط ولي العهد 7، مكة المكرمة', 50, NULL, 125, 69, '2025-10-23', '20:00', 80, 76, 156, 23.4, 179.4, NULL, NULL, NULL, NULL, NULL, NULL, 'bank_transfer', 'pending', 0, 'urgent', '2025-10-23 10:13:09', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'ثلاجة لا تبرد', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-23 07:13:09', '2025-10-23 07:13:09', NULL),
(25, 'INV-V1DF1CPB', NULL, NULL, NULL, NULL, 'TRK-ECPKRUYZM9', NULL, NULL, NULL, NULL, 30, 0, 361, 2046, 1, 2028, 'فيصل عبدالعزيز الشمري', 'client18_1763201586@makkah.com', '0574171648', '28255', 'منطقة القرارة، مكة المكرمة', 50, NULL, 112, 69, '2025-11-10', '12:00', 120, 84, 204, 30.6, 234.6, NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', 'complete', 0, 'normal', '2025-11-10 09:13:09', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'مكيف يصدر صوت عالي', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 08:13:09', '2025-11-10 08:13:09', NULL),
(26, 'INV-ER8PLPX0', NULL, NULL, NULL, NULL, 'TRK-L3BMJVUWR6', NULL, NULL, NULL, NULL, 30, 0, 355, 2041, 1, 2014, 'سعد محمد الزهراني', 'client4_1763201584@makkah.com', '0524946839', '24690', 'منطقة المعابدة، مكة المكرمة', 50, NULL, 146, 69, '2025-11-01', '8:00', 150, 94, 244, 36.6, 280.6, NULL, NULL, NULL, NULL, NULL, NULL, 'cash', 'pending', 0, 'urgent', '2025-11-01 13:13:09', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'غسالة لا تعمل', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-01 08:13:09', '2025-11-01 08:13:09', NULL),
(27, 'INV-NQFD3H0V', NULL, NULL, NULL, NULL, 'TRK-SAYM14O96W', NULL, NULL, NULL, NULL, 30, 0, 364, 2044, 1, 2016, 'عمر عبدالرحمن الشهري', 'client6_1763201585@makkah.com', '0512585984', '24808', 'منطقة مخطط ولي العهد 2، مكة المكرمة', 50, NULL, 112, 69, '2025-11-03', '10:00', 180, 126, 306, 45.9, 351.9, NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', 'complete', 1, 'emergency', '2025-11-03 11:13:09', '2025-11-03 12:13:09', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'مفتاح كهربائي معطل', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-03 08:13:09', '2025-11-03 08:13:09', NULL),
(28, 'INV-FYFEPCJC', NULL, 'INV-2025-000028', '2025-11-05', NULL, 'TRK-PDKMKHWZDT', 'WAR-LTSLKZYYBD', NULL, NULL, NULL, 359, 1, 358, 2042, 1, 2024, 'نايف راشد السبيعي', 'client14_1763201586@makkah.com', '0572507436', '26866', 'منطقة حي النسيم، مكة المكرمة', 50, NULL, 157, 69, '2025-11-03', '13:00', 100, 89, 189, 28.35, 217.35, NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', 'complete', 3, 'emergency', '2025-11-03 11:13:09', '2025-11-03 13:13:09', NULL, NULL, NULL, '2025-11-05 08:13:09', 0, 0, 0, NULL, 'مصباح لا يعمل', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-03 08:13:09', '2025-11-15 08:13:09', NULL),
(29, 'INV-EFXCZTWP', NULL, 'INV-2025-000029', '2025-11-02', NULL, 'TRK-IQ4WZ3EW1Y', 'WAR-IQZOITJGIQ', NULL, NULL, NULL, 145, 1, 357, 2045, 1, 2014, 'سعد محمد الزهراني', 'client4_1763201584@makkah.com', '0524946839', '24690', 'منطقة المعابدة، مكة المكرمة', 50, NULL, 148, 69, '2025-10-31', '17:00', 300, 178, 478, 71.7, 549.7, NULL, NULL, NULL, NULL, NULL, NULL, 'bank_transfer', 'complete', 2, 'normal', '2025-10-31 09:13:09', '2025-10-31 12:13:09', NULL, NULL, NULL, '2025-11-02 08:13:09', 0, 0, 0, NULL, 'ثلاجة لا تبرد', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-31 08:13:09', '2025-11-15 08:13:09', NULL),
(30, 'INV-ZEY3RXVV', NULL, NULL, NULL, NULL, 'TRK-WCBFXAGVQF', NULL, NULL, NULL, NULL, 30, 0, 358, 2045, 1, 2022, 'بندر طلال البقمي', 'client12_1763201586@makkah.com', '0578835228', '27553', 'منطقة الكعكية، مكة المكرمة', 50, NULL, 165, 69, '2025-11-04', '8:00', 100, 172, 272, 40.8, 312.8, NULL, NULL, NULL, NULL, NULL, NULL, 'cash', 'pending', 0, 'emergency', '2025-11-04 12:13:09', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'تلفزيون لا يعمل', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-04 08:13:09', '2025-11-04 08:13:09', NULL),
(31, 'INV-QB5YDSIY', NULL, NULL, NULL, NULL, 'TRK-CYZ7GGOIU3', NULL, NULL, NULL, NULL, 30, 0, 356, 2045, 1, 2017, 'يوسف إبراهيم المطيري', 'client7_1763201585@makkah.com', '0594828550', '27162', 'منطقة الشرائع مخطط 2، مكة المكرمة', 50, NULL, 163, 69, '2025-11-03', '11:00', 120, 177, 297, 44.55, 341.55, NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', 'complete', 0, 'normal', '2025-11-03 13:13:09', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'تسرب مياه', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-03 08:13:09', '2025-11-03 08:13:09', NULL),
(32, 'INV-CLBWBOLI', NULL, 'INV-2025-000032', '2025-10-19', NULL, 'TRK-0BKM4WSN0G', 'WAR-M50RJZSZ8F', NULL, NULL, NULL, 184, 1, 359, 2044, 1, 2011, 'محمد أحمد العتيبي', 'client1_1763201584@makkah.com', '0594884739', '20409', 'منطقة الشرائع مخطط 7، مكة المكرمة', 50, NULL, 158, 69, '2025-10-17', '13:00', 50, 189, 239, 35.85, 274.85, NULL, NULL, NULL, NULL, NULL, NULL, 'bank_transfer', 'complete', 2, 'urgent', '2025-10-17 08:13:09', '2025-10-17 10:13:09', NULL, NULL, NULL, '2025-10-19 07:13:09', 0, 0, 0, NULL, 'مصباح لا يعمل', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-17 07:13:09', '2025-11-15 08:13:09', NULL),
(33, 'INV-YXZB0W7F', NULL, 'INV-2025-000033', '2025-11-16', NULL, 'TRK-HBDR4J6ZUH', 'WAR-LQMA4VCTAF', NULL, NULL, NULL, 130, 1, 360, 2046, 1, 2016, 'عمر عبدالرحمن الشهري', 'client6_1763201585@makkah.com', '0512585984', '24808', 'منطقة مخطط ولي العهد 2، مكة المكرمة', 50, NULL, 124, 69, '2025-11-14', '8:00', 80, 42, 122, 18.3, 140.3, NULL, NULL, NULL, NULL, NULL, NULL, 'cash', 'complete', 2, 'normal', '2025-11-14 13:13:09', '2025-11-14 14:13:09', NULL, NULL, NULL, '2025-11-16 08:13:09', 0, 0, 0, NULL, 'تلفزيون لا يعمل', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-14 08:13:09', '2025-11-15 08:13:09', NULL),
(34, 'INV-7Z9OGUOZ', NULL, 'INV-2025-000034', '2025-10-21', NULL, 'TRK-YI9UEZNSHX', 'WAR-86KQ0WIHFV', NULL, NULL, NULL, 104, 1, 359, 2045, 1, 2034, 'مشاري سعد الحربي', 'client24_1763201587@makkah.com', '0555501867', '25425', 'منطقة مخطط ولي العهد 7، مكة المكرمة', 50, NULL, 142, 69, '2025-10-20', '10:00', 50, 51, 101, 15.15, 116.15, NULL, NULL, NULL, NULL, NULL, NULL, 'cash', 'complete', 3, 'normal', '2025-10-20 11:13:09', '2025-10-20 14:13:09', NULL, NULL, NULL, '2025-10-21 07:13:09', 0, 0, 0, NULL, 'ثلاجة لا تبرد', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-20 07:13:09', '2025-11-15 08:13:09', NULL),
(35, 'INV-6TYKBMDY', NULL, 'INV-2025-000035', '2025-10-30', NULL, 'TRK-CZTB5XRKWY', 'WAR-7SY6YJTLDO', NULL, NULL, NULL, 258, 1, 357, 2043, 1, 2018, 'أحمد صالح الغامدي', 'client8_1763201585@makkah.com', '0529273477', '28088', 'منطقة مخطط ولي العهد 4، مكة المكرمة', 50, NULL, 151, 69, '2025-10-29', '9:00', 300, 106, 406, 60.9, 466.9, NULL, NULL, NULL, NULL, NULL, NULL, 'bank_transfer', 'complete', 3, 'urgent', '2025-10-29 12:13:09', '2025-10-29 13:13:09', NULL, NULL, NULL, '2025-10-30 07:13:09', 0, 0, 0, NULL, 'مكيف يصدر صوت عالي', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-29 07:13:09', '2025-11-15 08:13:09', NULL),
(36, 'INV-40MKSVZO', NULL, NULL, NULL, NULL, 'TRK-NZ6XXWN0C4', NULL, NULL, NULL, NULL, 30, 0, 357, 2043, 1, 2019, 'علي حسن الجهني', 'client9_1763201585@makkah.com', '0539905060', '20908', 'منطقة الشرائع مخطط 10، مكة المكرمة', 50, NULL, 125, 69, '2025-10-20', '11:00', 300, 60, 360, 54, 414, NULL, NULL, NULL, NULL, NULL, NULL, 'cash', 'pending', 1, 'emergency', '2025-10-20 10:13:09', '2025-10-20 12:13:09', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'غسالة لا تعمل', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-20 07:13:09', '2025-10-20 07:13:09', NULL),
(37, 'INV-X5FIIHDN', NULL, 'INV-2025-000037', '2025-11-04', NULL, 'TRK-14RCHPGH4V', 'WAR-KT58PW8Z77', NULL, NULL, NULL, 264, 1, 360, 2045, 1, 2033, 'منصور خالد القحطاني', 'client23_1763201587@makkah.com', '0533214404', '27742', 'منطقة الاسكان، مكة المكرمة', 50, NULL, 139, 69, '2025-11-02', '18:00', 80, 141, 221, 33.15, 254.15, NULL, NULL, NULL, NULL, NULL, NULL, 'bank_transfer', 'complete', 2, 'emergency', '2025-11-02 13:13:09', '2025-11-02 14:13:09', NULL, NULL, NULL, '2025-11-04 08:13:09', 0, 0, 0, NULL, 'مكيف يصدر صوت عالي', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-02 08:13:09', '2025-11-15 08:13:09', NULL),
(38, 'INV-WA3I3KS2', NULL, 'INV-2025-000038', '2025-11-08', NULL, 'TRK-XBI7IUG01Q', 'WAR-MLRYWJUCYQ', NULL, NULL, NULL, 326, 1, 360, 2045, 1, 2030, 'مشعل نايف الحارثي', 'client20_1763201587@makkah.com', '0585548972', '22035', 'منطقة بطحاء قريش، مكة المكرمة', 50, NULL, 153, 69, '2025-11-07', '16:00', 80, 168, 248, 37.2, 285.2, NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', 'complete', 3, 'normal', '2025-11-07 12:13:09', '2025-11-07 14:13:09', NULL, NULL, NULL, '2025-11-08 08:13:09', 0, 0, 0, NULL, 'تسرب في الحمام', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 08:13:09', '2025-11-15 08:13:09', NULL),
(39, 'INV-6A7UCOVG', NULL, 'INV-2025-000039', '2025-11-14', NULL, 'TRK-GCSQG6YVHU', 'WAR-CG8DKYDPER', NULL, NULL, NULL, 66, 1, 364, 2044, 1, 2040, 'عبدالهادي علي الجهني', 'client30_1763201588@makkah.com', '0547417805', '20224', 'منطقة جبل عمر، مكة المكرمة', 50, NULL, 153, 69, '2025-11-11', '19:00', 180, 97, 277, 41.55, 318.55, NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', 'complete', 3, 'normal', '2025-11-11 12:13:09', '2025-11-11 14:13:09', NULL, NULL, NULL, '2025-11-14 08:13:09', 0, 0, 0, NULL, 'ثلاجة لا تبرد', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 08:13:09', '2025-11-15 08:13:09', NULL),
(40, 'INV-QVKNT9BO', NULL, NULL, NULL, NULL, 'TRK-F31GWMWSLH', NULL, NULL, NULL, NULL, 30, 0, 359, 2042, 1, 2015, 'خالد فهد الدوسري', 'client5_1763201585@makkah.com', '0557716678', '26779', 'منطقة التنعيم الشرقي، مكة المكرمة', 50, NULL, 120, 69, '2025-10-22', '8:00', 50, 0, 50, 7.5, 57.5, NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', 'pending', 1, 'normal', '2025-10-22 10:13:09', '2025-10-22 13:13:09', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'مفتاح كهربائي معطل', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-22 07:13:09', '2025-10-22 07:13:09', NULL),
(41, 'INV-N6JIZC8B', NULL, 'INV-2025-000041', '2025-10-25', NULL, 'TRK-TRACLRWC4M', 'WAR-1GMUK7IGWH', NULL, NULL, NULL, 303, 1, 360, 2043, 1, 2031, 'راشد فهد البقمي', 'client21_1763201587@makkah.com', '0588952451', '27394', 'منطقة الشرائع مخطط 10، مكة المكرمة', 50, NULL, 157, 69, '2025-10-24', '12:00', 80, 85, 165, 24.75, 189.75, NULL, NULL, NULL, NULL, NULL, NULL, 'bank_transfer', 'complete', 2, 'emergency', '2025-10-24 09:13:09', '2025-10-24 11:13:09', NULL, NULL, NULL, '2025-10-25 07:13:09', 0, 0, 0, NULL, 'تسرب في الحمام', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-24 07:13:09', '2025-11-15 08:13:09', NULL),
(42, 'INV-MQ0S1473', NULL, NULL, NULL, NULL, 'TRK-7FD6EC19W4', NULL, NULL, NULL, NULL, 30, 0, 364, 2046, 1, 2026, 'وليد هشام الرشيد', 'client16_1763201586@makkah.com', '0578879564', '20141', 'منطقة الريان، مكة المكرمة', 50, NULL, 127, 69, '2025-10-25', '18:00', 180, 160, 340, 51, 391, NULL, NULL, NULL, NULL, NULL, NULL, 'bank_transfer', 'complete', 0, 'emergency', '2025-10-25 09:13:09', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'تسرب مياه', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-25 07:13:09', '2025-10-25 07:13:09', NULL),
(43, 'INV-DD7REZDB', NULL, NULL, NULL, NULL, 'TRK-PTWSUYBKEN', NULL, NULL, NULL, NULL, 30, 0, 355, 2042, 1, 2020, 'حسام عبدالله الثقفي', 'client10_1763201585@makkah.com', '0541195728', '25936', 'منطقة الزهراء، مكة المكرمة', 50, NULL, 114, 69, '2025-10-26', '11:00', 150, 175, 325, 48.75, 373.75, NULL, NULL, NULL, NULL, NULL, NULL, 'bank_transfer', 'complete', 0, 'emergency', '2025-10-26 08:13:09', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'تسرب في الحمام', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-26 07:13:09', '2025-10-26 07:13:09', NULL),
(44, 'INV-PNZBGHGI', NULL, NULL, NULL, NULL, 'TRK-CHOKDSKMGL', NULL, NULL, NULL, NULL, 30, 0, 358, 2044, 1, 2029, 'عبدالرحمن سليمان العلي', 'client19_1763201587@makkah.com', '0532801480', '26907', 'منطقة الشامية، مكة المكرمة', 50, NULL, 114, 69, '2025-10-17', '17:00', 100, 91, 191, 28.65, 219.65, NULL, NULL, NULL, NULL, NULL, NULL, 'bank_transfer', 'complete', 0, 'normal', '2025-10-17 12:13:09', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'مكيف لا يعمل', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-17 07:13:09', '2025-10-17 07:13:09', NULL),
(45, 'INV-14GMF1LR', NULL, 'INV-2025-000045', '2025-11-13', NULL, 'TRK-68UDPP2ITF', 'WAR-QFJTWNBZOI', NULL, NULL, NULL, 306, 1, 364, 2046, 1, 2012, 'فهد سعد القحطاني', 'client2_1763201584@makkah.com', '0550868510', '27316', 'منطقة الفيحاء، مكة المكرمة', 50, NULL, 165, 69, '2025-11-12', '9:00', 180, 37, 217, 32.55, 249.55, NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', 'complete', 2, 'emergency', '2025-11-12 09:13:09', '2025-11-12 10:13:09', NULL, NULL, NULL, '2025-11-13 08:13:09', 0, 0, 0, NULL, 'تسرب في الحمام', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-12 08:13:09', '2025-11-15 08:13:09', NULL),
(46, 'INV-ALRLY0ES', NULL, NULL, NULL, NULL, 'TRK-RFHDA1VAPW', NULL, NULL, NULL, NULL, 30, 0, 361, 2045, 1, 2019, 'علي حسن الجهني', 'client9_1763201585@makkah.com', '0539905060', '20908', 'منطقة الشرائع مخطط 10، مكة المكرمة', 50, NULL, 131, 69, '2025-11-14', '14:00', 120, 23, 143, 21.45, 164.45, NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', 'pending', 1, 'emergency', '2025-11-14 13:13:09', '2025-11-14 15:13:09', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'انقطاع كهرباء', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-14 08:13:09', '2025-11-14 08:13:09', NULL),
(47, 'INV-7XOQLNRG', NULL, 'INV-2025-000047', '2025-10-17', NULL, 'TRK-WCITLUTKIO', 'WAR-NIBG9AG5GC', NULL, NULL, NULL, 287, 1, 356, 2045, 1, 2024, 'نايف راشد السبيعي', 'client14_1763201586@makkah.com', '0572507436', '26866', 'منطقة حي النسيم، مكة المكرمة', 50, NULL, 157, 69, '2025-10-16', '16:00', 120, 138, 258, 38.7, 296.7, NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', 'complete', 2, 'urgent', '2025-10-16 09:13:09', '2025-10-16 12:13:09', NULL, NULL, NULL, '2025-10-17 07:13:09', 0, 0, 0, NULL, 'ثلاجة لا تبرد', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-16 07:13:09', '2025-11-15 08:13:09', NULL),
(48, 'INV-SHR6ZDEP', NULL, 'INV-2025-000048', '2025-11-05', NULL, 'TRK-YONY8CLLDR', 'WAR-NYCG9J7KM9', NULL, NULL, NULL, 114, 1, 361, 2044, 1, 2038, 'عبداللطيف يوسف المطيري', 'client28_1763201588@makkah.com', '0542856336', '26178', 'منطقة الجمعة، مكة المكرمة', 50, NULL, 139, 69, '2025-11-03', '13:00', 120, 81, 201, 30.15, 231.15, NULL, NULL, NULL, NULL, NULL, NULL, 'bank_transfer', 'complete', 3, 'urgent', '2025-11-03 10:13:09', '2025-11-03 11:13:09', NULL, NULL, NULL, '2025-11-05 08:13:09', 0, 0, 0, NULL, 'مياه ساخنة لا تعمل', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-03 08:13:09', '2025-11-15 08:13:09', NULL),
(49, 'INV-JVYKIB66', NULL, NULL, NULL, NULL, 'TRK-XCRRTHAD6P', NULL, NULL, NULL, NULL, 30, 0, 358, 2045, 1, 2029, 'عبدالرحمن سليمان العلي', 'client19_1763201587@makkah.com', '0532801480', '26907', 'منطقة الشامية، مكة المكرمة', 50, NULL, 156, 69, '2025-10-17', '17:00', 100, 82, 182, 27.3, 209.3, NULL, NULL, NULL, NULL, NULL, NULL, 'cash', 'complete', 0, 'urgent', '2025-10-17 10:13:09', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'ثلاجة لا تبرد', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-17 07:13:09', '2025-10-17 07:13:09', NULL),
(50, 'INV-JFYT3NBM', NULL, NULL, NULL, NULL, 'TRK-4HZXBCDSOR', NULL, NULL, NULL, NULL, 30, 0, 359, 2042, 1, 2031, 'راشد فهد البقمي', 'client21_1763201587@makkah.com', '0588952451', '27394', 'منطقة الشرائع مخطط 10، مكة المكرمة', 50, NULL, 157, 69, '2025-10-28', '14:00', 50, 132, 182, 27.3, 209.3, NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', 'complete', 1, 'normal', '2025-10-28 09:13:09', '2025-10-28 11:13:09', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'ثلاجة لا تبرد', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-28 07:13:09', '2025-10-28 07:13:09', NULL),
(51, 'INV-GTZLLB15', NULL, NULL, NULL, NULL, 'TRK-SNQUYUIJA7', NULL, NULL, NULL, NULL, 30, 0, 359, 2045, 1, 2022, 'بندر طلال البقمي', 'client12_1763201586@makkah.com', '0578835228', '27553', 'منطقة الكعكية، مكة المكرمة', 50, NULL, 149, 69, '2025-10-18', '8:00', 50, 134, 184, 27.6, 211.6, NULL, NULL, NULL, NULL, NULL, NULL, 'cash', 'complete', 0, 'normal', '2025-10-18 12:13:09', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'مكيف يصدر صوت عالي', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-18 07:13:09', '2025-10-18 07:13:09', NULL),
(52, 'INV-CNVVAQUQ', NULL, NULL, NULL, NULL, 'TRK-SRIDRDDFQI', NULL, NULL, NULL, NULL, 30, 0, 357, 2044, 1, 2012, 'فهد سعد القحطاني', 'client2_1763201584@makkah.com', '0550868510', '27316', 'منطقة الفيحاء، مكة المكرمة', 50, NULL, 148, 69, '2025-10-28', '16:00', 300, 47, 347, 52.05, 399.05, NULL, NULL, NULL, NULL, NULL, NULL, 'bank_transfer', 'pending', 1, 'urgent', '2025-10-28 11:13:09', '2025-10-28 13:13:09', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'مياه ساخنة لا تعمل', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-28 07:13:09', '2025-10-28 07:13:09', NULL),
(53, 'INV-9TJY7HX3', NULL, 'INV-2025-000053', '2025-11-08', NULL, 'TRK-3VXOYC5GCL', 'WAR-GF221MHUR1', NULL, NULL, NULL, 63, 1, 355, 2041, 1, 2022, 'بندر طلال البقمي', 'client12_1763201586@makkah.com', '0578835228', '27553', 'منطقة الكعكية، مكة المكرمة', 50, NULL, 140, 69, '2025-11-06', '16:00', 150, 8, 158, 23.7, 181.7, NULL, NULL, NULL, NULL, NULL, NULL, 'cash', 'complete', 3, 'normal', '2025-11-06 13:13:09', '2025-11-06 14:13:09', NULL, NULL, NULL, '2025-11-08 08:13:09', 0, 0, 0, NULL, 'مكيف لا يعمل', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-06 08:13:09', '2025-11-15 08:13:09', NULL),
(54, 'INV-PHILF3EZ', NULL, NULL, NULL, NULL, 'TRK-PJG4ORYO6X', NULL, NULL, NULL, NULL, 30, 0, 361, 2045, 1, 2026, 'وليد هشام الرشيد', 'client16_1763201586@makkah.com', '0578879564', '20141', 'منطقة الريان، مكة المكرمة', 50, NULL, 135, 69, '2025-11-07', '9:00', 120, 182, 302, 45.3, 347.3, NULL, NULL, NULL, NULL, NULL, NULL, 'bank_transfer', 'complete', 0, 'emergency', '2025-11-07 11:13:09', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'مكيف يصدر صوت عالي', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 08:13:09', '2025-11-07 08:13:09', NULL),
(55, 'INV-QIX5KU1K', NULL, 'INV-2025-000055', '2025-11-12', NULL, 'TRK-H3NV7ZXCOR', 'WAR-KL7LBABPAI', NULL, NULL, NULL, 156, 1, 364, 2044, 1, 2016, 'عمر عبدالرحمن الشهري', 'client6_1763201585@makkah.com', '0512585984', '24808', 'منطقة مخطط ولي العهد 2، مكة المكرمة', 50, NULL, 118, 69, '2025-11-09', '13:00', 180, 23, 203, 30.45, 233.45, NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', 'complete', 3, 'urgent', '2025-11-09 11:13:09', '2025-11-09 12:13:09', NULL, NULL, NULL, '2025-11-12 08:13:09', 0, 0, 0, NULL, 'تسرب في الحمام', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-09 08:13:09', '2025-11-15 08:13:09', NULL),
(56, 'INV-UCMW47A4', NULL, NULL, NULL, NULL, 'TRK-NCK4JAM0BJ', NULL, NULL, NULL, NULL, 30, 0, 356, 2046, 1, 2024, 'نايف راشد السبيعي', 'client14_1763201586@makkah.com', '0572507436', '26866', 'منطقة حي النسيم، مكة المكرمة', 50, NULL, 139, 69, '2025-11-12', '13:00', 120, 182, 302, 45.3, 347.3, NULL, NULL, NULL, NULL, NULL, NULL, 'bank_transfer', 'complete', 1, 'normal', '2025-11-12 09:13:09', '2025-11-12 11:13:09', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'مفتاح كهربائي معطل', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-12 08:13:09', '2025-11-12 08:13:09', NULL),
(57, 'INV-WL13QMXO', NULL, NULL, NULL, NULL, 'TRK-2QNPPSFMS0', NULL, NULL, NULL, NULL, 30, 0, 355, 2044, 1, 2017, 'يوسف إبراهيم المطيري', 'client7_1763201585@makkah.com', '0594828550', '27162', 'منطقة الشرائع مخطط 2، مكة المكرمة', 50, NULL, 116, 69, '2025-10-31', '14:00', 150, 193, 343, 51.45, 394.45, NULL, NULL, NULL, NULL, NULL, NULL, 'cash', 'pending', 1, 'normal', '2025-10-31 13:13:10', '2025-10-31 15:13:10', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'انقطاع كهرباء', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-31 08:13:10', '2025-10-31 08:13:10', NULL),
(58, 'INV-CNCTWGNF', NULL, NULL, NULL, NULL, 'TRK-44BRRBZVRH', NULL, NULL, NULL, NULL, 30, 0, 357, 2042, 1, 2026, 'وليد هشام الرشيد', 'client16_1763201586@makkah.com', '0578879564', '20141', 'منطقة الريان، مكة المكرمة', 50, NULL, 152, 69, '2025-10-16', '15:00', 300, 136, 436, 65.4, 501.4, NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', 'pending', 1, 'normal', '2025-10-16 11:13:10', '2025-10-16 14:13:10', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'ثلاجة لا تبرد', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-16 07:13:10', '2025-10-16 07:13:10', NULL),
(59, 'INV-AM5KQLQZ', NULL, 'INV-2025-000059', '2025-10-22', NULL, 'TRK-MIJ5H6NGVR', 'WAR-CYYKOEZSBV', NULL, NULL, NULL, 319, 1, 362, 2045, 1, 2011, 'محمد أحمد العتيبي', 'client1_1763201584@makkah.com', '0594884739', '20409', 'منطقة الشرائع مخطط 7، مكة المكرمة', 50, NULL, 167, 69, '2025-10-21', '16:00', 200, 108, 308, 46.2, 354.2, NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', 'complete', 3, 'urgent', '2025-10-21 10:13:10', '2025-10-21 12:13:10', NULL, NULL, NULL, '2025-10-22 07:13:10', 0, 0, 0, NULL, 'مفتاح كهربائي معطل', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-21 07:13:10', '2025-11-15 08:13:10', NULL),
(60, 'INV-T3MFEMXA', NULL, NULL, NULL, NULL, 'TRK-OISHQMR6R5', NULL, NULL, NULL, NULL, 30, 0, 358, 2041, 1, 2019, 'علي حسن الجهني', 'client9_1763201585@makkah.com', '0539905060', '20908', 'منطقة الشرائع مخطط 10، مكة المكرمة', 50, NULL, 140, 69, '2025-10-27', '12:00', 100, 101, 201, 30.15, 231.15, NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', 'pending', 0, 'urgent', '2025-10-27 11:13:10', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'غسالة لا تعمل', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-27 07:13:10', '2025-10-27 07:13:10', NULL),
(61, 'INV-RTU3UTCD', NULL, NULL, NULL, NULL, 'TRK-ZYQSQNZUJF', NULL, NULL, NULL, NULL, 30, 0, 361, 2043, 1, 2028, 'فيصل عبدالعزيز الشمري', 'client18_1763201586@makkah.com', '0574171648', '28255', 'منطقة القرارة، مكة المكرمة', 50, NULL, 147, 69, '2025-11-11', '14:00', 120, 151, 271, 40.65, 311.65, NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', 'complete', 1, 'emergency', '2025-11-11 13:13:10', '2025-11-11 16:13:10', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'انقطاع كهرباء', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 08:13:10', '2025-11-11 08:13:10', NULL),
(62, 'INV-QF6MCYA0', NULL, 'INV-2025-000062', '2025-10-30', NULL, 'TRK-CRHIUZ2S0E', 'WAR-9FFBMU2BBH', NULL, NULL, NULL, 147, 1, 361, 2043, 1, 2024, 'نايف راشد السبيعي', 'client14_1763201586@makkah.com', '0572507436', '26866', 'منطقة حي النسيم، مكة المكرمة', 50, NULL, 155, 69, '2025-10-28', '11:00', 120, 17, 137, 20.55, 157.55, NULL, NULL, NULL, NULL, NULL, NULL, 'cash', 'complete', 3, 'normal', '2025-10-28 10:13:10', '2025-10-28 12:13:10', NULL, NULL, NULL, '2025-10-30 07:13:10', 0, 0, 0, NULL, 'تسرب في الحمام', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-28 07:13:10', '2025-11-15 08:13:10', NULL),
(63, 'INV-2YB1H5US', NULL, 'INV-2025-000063', '2025-11-02', NULL, 'TRK-MR7GJQKNWT', 'WAR-YMMCNZCBHJ', NULL, NULL, NULL, 253, 1, 363, 2045, 1, 2035, 'عبدالمحسن فهد الزهراني', 'client25_1763201587@makkah.com', '0539694782', '28474', 'منطقة المسفلة، مكة المكرمة', 50, NULL, 151, 69, '2025-10-31', '12:00', 250, 22, 272, 40.8, 312.8, NULL, NULL, NULL, NULL, NULL, NULL, 'cash', 'complete', 3, 'emergency', '2025-10-31 13:13:10', '2025-10-31 15:13:10', NULL, NULL, NULL, '2025-11-02 08:13:10', 0, 0, 0, NULL, 'مكيف يصدر صوت عالي', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-31 08:13:10', '2025-11-15 08:13:10', NULL),
(64, 'INV-D8Y3RQCJ', NULL, 'INV-2025-000064', '2025-11-12', NULL, 'TRK-IOXYYJR81Y', 'WAR-KLLC3UIPDJ', NULL, NULL, NULL, 289, 1, 359, 2041, 1, 2039, 'عبدالمجيد أحمد الغامدي', 'client29_1763201588@makkah.com', '0593466392', '25921', 'منطقة العزيزية الشمالية، مكة المكرمة', 50, NULL, 121, 69, '2025-11-10', '16:00', 50, 6, 56, 8.4, 64.4, NULL, NULL, NULL, NULL, NULL, NULL, 'cash', 'complete', 3, 'emergency', '2025-11-10 11:13:10', '2025-11-10 13:13:10', NULL, NULL, NULL, '2025-11-12 08:13:10', 0, 0, 0, NULL, 'تسرب مياه', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 08:13:10', '2025-11-15 08:13:10', NULL),
(65, 'INV-SRRECYZ1', NULL, NULL, NULL, NULL, 'TRK-XI5FWHPKBW', NULL, NULL, NULL, NULL, 30, 0, 357, 2044, 1, 2028, 'فيصل عبدالعزيز الشمري', 'client18_1763201586@makkah.com', '0574171648', '28255', 'منطقة القرارة، مكة المكرمة', 50, NULL, 139, 69, '2025-11-04', '9:00', 300, 111, 411, 61.65, 472.65, NULL, NULL, NULL, NULL, NULL, NULL, 'bank_transfer', 'complete', 1, 'emergency', '2025-11-04 13:13:10', '2025-11-04 15:13:10', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'مكيف يصدر صوت عالي', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-04 08:13:10', '2025-11-04 08:13:10', NULL),
(66, 'INV-MDFRLN16', NULL, 'INV-2025-000066', '2025-11-03', NULL, 'TRK-UOXY1QV0DW', 'WAR-MMBEOKGU2K', NULL, NULL, NULL, 304, 1, 363, 2041, 1, 2026, 'وليد هشام الرشيد', 'client16_1763201586@makkah.com', '0578879564', '20141', 'منطقة الريان، مكة المكرمة', 50, NULL, 162, 69, '2025-10-31', '16:00', 250, 98, 348, 52.2, 400.2, NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', 'complete', 2, 'normal', '2025-10-31 09:13:10', '2025-10-31 10:13:10', NULL, NULL, NULL, '2025-11-03 08:13:10', 0, 0, 0, NULL, 'مكيف يصدر صوت عالي', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-31 08:13:10', '2025-11-15 08:13:10', NULL),
(67, 'INV-AMJY4QGV', NULL, NULL, NULL, NULL, 'TRK-WNGMWDCWC2', NULL, NULL, NULL, NULL, 30, 0, 355, 2045, 1, 2038, 'عبداللطيف يوسف المطيري', 'client28_1763201588@makkah.com', '0542856336', '26178', 'منطقة الجمعة، مكة المكرمة', 50, NULL, 130, 69, '2025-10-24', '8:00', 150, 46, 196, 29.4, 225.4, NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', 'pending', 0, 'normal', '2025-10-24 12:13:10', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'مكيف يصدر صوت عالي', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-24 07:13:10', '2025-10-24 07:13:10', NULL),
(68, 'INV-DQBCMDIV', NULL, 'INV-2025-000068', '2025-11-13', NULL, 'TRK-GJI3JBUDTH', 'WAR-F5KVUQ5P89', NULL, NULL, NULL, 48, 1, 364, 2045, 1, 2026, 'وليد هشام الرشيد', 'client16_1763201586@makkah.com', '0578879564', '20141', 'منطقة الريان، مكة المكرمة', 50, NULL, 115, 69, '2025-11-10', '20:00', 180, 115, 295, 44.25, 339.25, NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', 'complete', 3, 'urgent', '2025-11-10 09:13:10', '2025-11-10 10:13:10', NULL, NULL, NULL, '2025-11-13 08:13:10', 0, 0, 0, NULL, 'تسرب في الحمام', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 08:13:10', '2025-11-15 08:13:10', NULL),
(69, 'INV-TPB39P34', NULL, 'INV-2025-000069', '2025-10-30', NULL, 'TRK-GIGCXE0BUL', 'WAR-HSSIBG2K8U', NULL, NULL, NULL, 266, 1, 360, 2044, 1, 2014, 'سعد محمد الزهراني', 'client4_1763201584@makkah.com', '0524946839', '24690', 'منطقة المعابدة، مكة المكرمة', 50, NULL, 118, 69, '2025-10-29', '17:00', 80, 102, 182, 27.3, 209.3, NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', 'complete', 3, 'urgent', '2025-10-29 11:13:10', '2025-10-29 13:13:10', NULL, NULL, NULL, '2025-10-30 07:13:10', 0, 0, 0, NULL, 'مكيف يخرج هواء ساخن', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-29 07:13:10', '2025-11-15 08:13:10', NULL),
(70, 'INV-WPSI9A6X', NULL, 'INV-2025-000070', '2025-10-31', NULL, 'TRK-6SRQ7WW8EB', 'WAR-HUIDACSZK8', NULL, NULL, NULL, 322, 1, 359, 2046, 1, 2037, 'مشعل عمر الشهري', 'client27_1763201588@makkah.com', '0535551528', '20735', 'منطقة مخطط ولي العهد 8، مكة المكرمة', 50, NULL, 147, 69, '2025-10-30', '9:00', 50, 90, 140, 21, 161, NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', 'complete', 3, 'urgent', '2025-10-30 10:13:10', '2025-10-30 11:13:10', NULL, NULL, NULL, '2025-10-31 08:13:10', 0, 0, 0, NULL, 'مفتاح كهربائي معطل', NULL, NULL, 'ملاحظات إضافية حول الطلب', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-30 07:13:10', '2025-11-15 08:13:10', NULL),
(71, 'INV71', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30, 1, 366, 1, NULL, NULL, 'khaled ahmed', 'khaledahmedhaggagy@gmail.com', '01204593124', '0', 'مكة المكرمة', NULL, NULL, NULL, NULL, 'Mon November 17 2025', '2:30pm', 0, 0, 0, 0, 0, '', '', 0, 'percentage', 10, 0, 'cash_on_delivery', 'complete', 1, 'normal', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 'السرعه فى الصيانة\r\n\r\nAdditional Service: اريد صيانة المكيف كذلك', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-16 09:22:30', '2025-11-16 09:47:00', NULL),
(72, 'INV72', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30, 1, 366, 1971, 1933, NULL, 'khaled ahmed', 'khaledahmedhaggagy@gmail.com', '01204593124', '0', 'Qena', NULL, NULL, NULL, NULL, 'Wed November 19 2025', '2:30pm', 0, 0, 0, 0, 0, '', '', 0, 'percentage', 10, 0, 'cash_on_delivery', 'pending', 0, 'normal', '2025-11-17 20:19:16', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-17 19:20:01', '2025-11-17 20:19:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_additionals`
--

CREATE TABLE `order_additionals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `title` varchar(191) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_complete_declines`
--

CREATE TABLE `order_complete_declines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `buyer_id` bigint(20) NOT NULL,
  `seller_id` bigint(20) NOT NULL,
  `service_id` bigint(20) NOT NULL,
  `decline_reason` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_includes`
--

CREATE TABLE `order_includes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `title` varchar(191) NOT NULL,
  `price` double NOT NULL,
  `quantity` double NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `slug` text DEFAULT NULL,
  `page_content` longtext DEFAULT NULL,
  `visibility` varchar(191) DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `page_builder_status` varchar(191) DEFAULT NULL,
  `layout` varchar(191) DEFAULT NULL,
  `sidebar_layout` varchar(191) DEFAULT NULL,
  `navbar_variant` varchar(191) DEFAULT NULL,
  `page_class` varchar(191) DEFAULT 'container',
  `back_to_top` varchar(191) DEFAULT NULL,
  `breadcrumb_status` varchar(191) DEFAULT NULL,
  `footer_variant` varchar(191) DEFAULT NULL,
  `widget_style` varchar(191) DEFAULT NULL,
  `left_column` varchar(191) DEFAULT NULL,
  `right_column` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `page_content`, `visibility`, `status`, `created_at`, `updated_at`, `page_builder_status`, `layout`, `sidebar_layout`, `navbar_variant`, `page_class`, `back_to_top`, `breadcrumb_status`, `footer_variant`, `widget_style`, `left_column`, `right_column`) VALUES
(31, 'من نحن', 'about', '[object Object]', 'all', 'publish', '2021-11-24 06:44:22', '2025-12-08 06:36:46', 'on', 'normal_layout', NULL, '02', NULL, NULL, 'on', '02', NULL, NULL, NULL),
(32, 'الخدمات', 'service-list', '[object Object]', 'all', 'publish', '2021-11-24 06:52:32', '2025-11-14 19:23:10', 'on', 'normal_layout', NULL, '02', NULL, NULL, 'on', '02', NULL, NULL, NULL),
(34, 'تواصل معنا', 'contact', '[object Object]', 'all', 'publish', '2021-11-24 06:54:28', '2025-11-14 19:10:08', 'on', 'normal_layout', NULL, '02', NULL, NULL, 'on', '02', NULL, NULL, NULL),
(35, 'Blog', 'blog', '[object Object]', 'all', 'publish', '2021-11-24 06:56:35', '2022-02-12 04:42:04', 'on', 'normal_layout', NULL, '02', NULL, NULL, 'on', '02', NULL, NULL, NULL),
(40, 'Faq', 'faq', '[object Object]', 'all', 'publish', '2022-01-13 06:53:28', '2023-07-24 01:33:11', 'on', 'normal_layout', NULL, '02', NULL, NULL, 'on', '02', NULL, NULL, NULL),
(41, 'Privacy Policy', 'privacy-policy', '<h1 style=\"outline: 0px; -webkit-font-smoothing: antialiased; line-height: 1.08333; font-size: 48px; color: rgb(102, 102, 102); font-family: Roboto, sans-serif;\">How can I get a privacy policy on my website? A GDPR compliant privacy policy</h1><p style=\"outline: 0px; -webkit-font-smoothing: antialiased; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; hyphens: auto; line-height: 1.6; font-size: 16px;\"><br style=\"outline: 0px; -webkit-font-smoothing: antialiased;\"></p><p style=\"outline: 0px; -webkit-font-smoothing: antialiased; color: rgb(22, 34, 42); font-family: Gotham, sans-serif; hyphens: auto; line-height: 1.6; font-size: 16px;\">The privacy policy can be written as an independent page on your website, and be made accessible as a link in the header or footer of your website, or on your ‘About’ page. It may also be hosted by a privacy policy-service with a link from your homepage. Basically, it doesn’t matter where you choose to place it, as long as your users have access to it. The privacy policy is a legal text. The phrasing depends on which jurisdictions your website falls under and how&nbsp; website handles data.</p><p style=\"outline: 0px; -webkit-font-smoothing: antialiased; color: rgb(22, 34, 42); font-family: Gotham, sans-serif; hyphens: auto; line-height: 1.6; font-size: 16px;\"><br style=\"outline: 0px; -webkit-font-smoothing: antialiased;\"></p><h1 style=\"outline: 0px; -webkit-font-smoothing: antialiased; line-height: 1.08333; font-size: 16px; color: rgb(22, 34, 42); font-family: Gotham, sans-serif;\"><span style=\"outline: 0px; -webkit-font-smoothing: antialiased; font-weight: bolder;\">All websites are different. We always recommend that you consult a lawyer to ensure that your privacy policy is compliant with all applicable laws.&nbsp;</span></h1><h1 style=\"outline: 0px; -webkit-font-smoothing: antialiased; line-height: 1.08333; font-size: 16px; color: rgb(22, 34, 42); font-family: Gotham, sans-serif;\"><span style=\"outline: 0px; -webkit-font-smoothing: antialiased; font-weight: bolder;\"><br style=\"outline: 0px; -webkit-font-smoothing: antialiased;\"></span></h1><h1 style=\"outline: 0px; -webkit-font-smoothing: antialiased; line-height: 1.08333; font-size: 16px; color: rgb(22, 34, 42); font-family: Gotham, sans-serif;\"><span style=\"outline: 0px; -webkit-font-smoothing: antialiased; font-weight: bolder;\"><br style=\"outline: 0px; -webkit-font-smoothing: antialiased;\"></span>However, this might seem as a large expense if you are, for instance, a hobby blogger or small business. What you should&nbsp;<a href=\"https://medium.com/@StartupPolicy/five-reasons-why-copying-someone-else-s-terms-of-use-and-privacy-policy-is-a-bad-idea-fd8d126ac0b3\" style=\"background-color: rgb(255, 255, 255); -webkit-font-smoothing: antialiased; color: inherit;\">never do, is to copy a privacy policy from some other website</a>.</h1><p style=\"outline: 0px; -webkit-font-smoothing: antialiased; color: rgb(22, 34, 42); font-family: Gotham, sans-serif; hyphens: auto; line-height: 1.6; font-size: 16px;\">That is also why using a privacy policy generator can be a hazardous thing, since you must be very careful to include all the specific information of your website, and not just have privacy policy generator spit out a default one that isn\'t aligned with your domain</p><p style=\"outline: 0px; -webkit-font-smoothing: antialiased; color: rgb(22, 34, 42); font-family: Gotham, sans-serif; hyphens: auto; line-height: 1.6; font-size: 16px;\"><br style=\"outline: 0px; -webkit-font-smoothing: antialiased;\"></p><h5 style=\"outline: 0px; -webkit-font-smoothing: antialiased; line-height: 1.08333; font-size: 16px; color: rgb(102, 102, 102); font-family: Roboto, sans-serif;\">GDPR&nbsp;<span style=\"outline: 0px; -webkit-font-smoothing: antialiased; font-weight: bolder;\">privacy policy templates &amp; privacy policy generators</span></h5><p style=\"outline: 0px; -webkit-font-smoothing: antialiased; color: rgb(22, 34, 42); font-family: Gotham, sans-serif; hyphens: auto; line-height: 1.6; font-size: 16px;\">There exists numerous tools for creating privacy policies, and privacy policy templates and privacy policy generators on the internet.</p><p style=\"outline: 0px; -webkit-font-smoothing: antialiased; color: rgb(22, 34, 42); font-family: Gotham, sans-serif; hyphens: auto; line-height: 1.6; font-size: 16px;\">Some are free and others come at a price. Some are not GDPR compliant privacy policies.</p><p style=\"outline: 0px; -webkit-font-smoothing: antialiased; color: rgb(22, 34, 42); font-family: Gotham, sans-serif; hyphens: auto; line-height: 1.6; font-size: 16px;\"><br style=\"outline: 0px; -webkit-font-smoothing: antialiased;\"></p><p style=\"outline: 0px; -webkit-font-smoothing: antialiased; color: rgb(22, 34, 42); font-family: Gotham, sans-serif; hyphens: auto; line-height: 1.6; font-size: 16px;\">1) Maintain all the content properly</p><p style=\"outline: 0px; -webkit-font-smoothing: antialiased; color: rgb(22, 34, 42); font-family: Gotham, sans-serif; hyphens: auto; line-height: 1.6; font-size: 16px;\">2) Ensure your all input is right</p><p style=\"outline: 0px; -webkit-font-smoothing: antialiased; color: rgb(22, 34, 42); font-family: Gotham, sans-serif; hyphens: auto; line-height: 1.6; font-size: 16px;\">3) if you can do multiple task that will be plus</p><p style=\"outline: 0px; -webkit-font-smoothing: antialiased; color: rgb(22, 34, 42); font-family: Gotham, sans-serif; hyphens: auto; line-height: 1.6; font-size: 16px;\"><br style=\"outline: 0px; -webkit-font-smoothing: antialiased;\"></p><p style=\"outline: 0px; -webkit-font-smoothing: antialiased; color: rgb(22, 34, 42); font-family: Gotham, sans-serif; hyphens: auto; line-height: 1.6; font-size: 16px;\">There policy is the numerous tools for creating privacy policies, and privacy policy templates and privacy policy generators on the internet. Some are free and others come at a price. Some are not GDPR compliant privacy policies.</p><p style=\"outline: 0px; -webkit-font-smoothing: antialiased; color: rgb(22, 34, 42); font-family: Gotham, sans-serif; hyphens: auto; line-height: 1.6; font-size: 16px;\"><br style=\"outline: 0px; -webkit-font-smoothing: antialiased;\"></p><p style=\"outline: 0px; -webkit-font-smoothing: antialiased; color: rgb(22, 34, 42); font-family: Gotham, sans-serif; hyphens: auto; line-height: 1.6; font-size: 16px;\"><span style=\"outline: 0px; -webkit-font-smoothing: antialiased; font-weight: bolder;\">Note :&nbsp;</span>just have privacy policy generator spit out a default one that isn\'t aligned with your domain So it\'s very important loyal technical theury of our reservation.</p>', 'all', 'publish', '2022-01-13 07:37:38', '2022-02-13 01:39:08', NULL, 'normal_layout', NULL, '02', NULL, NULL, 'on', '02', NULL, NULL, NULL),
(42, 'الشروط والأحكام', 'shorout-wa-al-ahkam', '\r\n<div class=\"terms-and-conditions-page\" style=\"max-width: 900px; margin: 0 auto; padding: 40px 20px;\">\r\n    <h1 style=\"text-align: center; color: #333; margin-bottom: 30px; font-size: 32px;\">الشروط والأحكام</h1>\r\n    \r\n    <div style=\"line-height: 1.8; color: #555; font-size: 16px;\">\r\n        <p style=\"margin-bottom: 20px;\"><strong>آخر تحديث:</strong> 2025-11-16</p>\r\n        \r\n        <h2 style=\"color: #2196F3; margin-top: 30px; margin-bottom: 15px; font-size: 24px;\">1. القبول</h2>\r\n        <p style=\"margin-bottom: 20px;\">\r\n            من خلال استخدام منصة صيانة تك، فإنك توافق على الالتزام بهذه الشروط والأحكام. إذا كنت لا توافق على أي جزء من هذه الشروط، فيرجى عدم استخدام خدماتنا.\r\n        </p>\r\n        \r\n        <h2 style=\"color: #2196F3; margin-top: 30px; margin-bottom: 15px; font-size: 24px;\">2. الخدمات</h2>\r\n        <p style=\"margin-bottom: 20px;\">\r\n            تقدم منصة صيانة تك خدمات ربط العملاء بالفنيين المعتمدين لتقديم خدمات الصيانة والإصلاح والتركيب. نحن نعمل كوسيط بين العملاء والفنيين ولا نقدم الخدمات مباشرة.\r\n        </p>\r\n        \r\n        <h2 style=\"color: #2196F3; margin-top: 30px; margin-bottom: 15px; font-size: 24px;\">3. التسعير والدفع</h2>\r\n        <ul style=\"margin-bottom: 20px; padding-right: 20px;\">\r\n            <li style=\"margin-bottom: 10px;\">سيتم حساب سعر الصيانة أو العطل أو التركيب بعد معاينة الفني للمشكلة.</li>\r\n            <li style=\"margin-bottom: 10px;\">طرق الدفع المتاحة: كاش أو فيزا أو STC Pay</li>\r\n            <li style=\"margin-bottom: 10px;\">يتم الدفع بعد إتمام الخدمة والموافقة عليها من قبل العميل.</li>\r\n        </ul>\r\n        \r\n        <h2 style=\"color: #2196F3; margin-top: 30px; margin-bottom: 15px; font-size: 24px;\">4. مسؤولية الفني</h2>\r\n        <p style=\"margin-bottom: 20px;\">\r\n            الفنيون المعتمدون على المنصة مسؤولون عن جودة العمل المقدم. يجب على الفني تقديم خدمة احترافية والتأكد من إصلاح المشكلة بشكل صحيح.\r\n        </p>\r\n        \r\n        <h2 style=\"color: #2196F3; margin-top: 30px; margin-bottom: 15px; font-size: 24px;\">5. مسؤولية العميل</h2>\r\n        <ul style=\"margin-bottom: 20px; padding-right: 20px;\">\r\n            <li style=\"margin-bottom: 10px;\">يجب على العميل تقديم معلومات دقيقة وصحيحة عند طلب الخدمة.</li>\r\n            <li style=\"margin-bottom: 10px;\">يجب على العميل توفير الوصول الكامل للموقع للمعاينة والإصلاح.</li>\r\n            <li style=\"margin-bottom: 10px;\">يجب على العميل الدفع بعد إتمام الخدمة والموافقة عليها.</li>\r\n        </ul>\r\n        \r\n        <h2 style=\"color: #2196F3; margin-top: 30px; margin-bottom: 15px; font-size: 24px;\">6. الإلغاء والاسترجاع</h2>\r\n        <p style=\"margin-bottom: 20px;\">\r\n            يمكن للعميل إلغاء الطلب قبل وصول الفني. في حالة إلغاء الطلب بعد وصول الفني، قد يتم تطبيق رسوم إلغاء. لا يمكن استرجاع المبلغ بعد إتمام الخدمة والموافقة عليها.\r\n        </p>\r\n        \r\n        <h2 style=\"color: #2196F3; margin-top: 30px; margin-bottom: 15px; font-size: 24px;\">7. الضمان</h2>\r\n        <p style=\"margin-bottom: 20px;\">\r\n            يتم تحديد فترة الضمان من قبل الفني حسب نوع الخدمة المقدمة. يجب على العميل الاحتفاظ بإيصال الدفع كدليل على الخدمة المقدمة.\r\n        </p>\r\n        \r\n        <h2 style=\"color: #2196F3; margin-top: 30px; margin-bottom: 15px; font-size: 24px;\">8. الخصوصية</h2>\r\n        <p style=\"margin-bottom: 20px;\">\r\n            نحن نلتزم بحماية خصوصية عملائنا. يتم استخدام المعلومات الشخصية فقط لتقديم الخدمات وتحسين تجربة المستخدم. لمزيد من التفاصيل، يرجى مراجعة سياسة الخصوصية.\r\n        </p>\r\n        \r\n        <h2 style=\"color: #2196F3; margin-top: 30px; margin-bottom: 15px; font-size: 24px;\">9. التعديلات</h2>\r\n        <p style=\"margin-bottom: 20px;\">\r\n            نحتفظ بالحق في تعديل هذه الشروط والأحكام في أي وقت. سيتم إشعار المستخدمين بأي تغييرات جوهرية عبر الموقع أو البريد الإلكتروني.\r\n        </p>\r\n        \r\n        <h2 style=\"color: #2196F3; margin-top: 30px; margin-bottom: 15px; font-size: 24px;\">10. الاتصال</h2>\r\n        <p style=\"margin-bottom: 20px;\">\r\n            إذا كان لديك أي أسئلة حول هذه الشروط والأحكام، يرجى الاتصال بنا من خلال معلومات الاتصال المتاحة على الموقع.\r\n        </p>\r\n        \r\n        <div style=\"margin-top: 40px; padding: 20px; background-color: #f5f5f5; border-radius: 10px;\">\r\n            <p style=\"margin: 0; text-align: center; color: #666;\">\r\n                <strong>باستخدام خدماتنا، فإنك تقر بأنك قد قرأت وفهمت ووافقت على الالتزام بهذه الشروط والأحكام.</strong>\r\n            </p>\r\n        </div>\r\n    </div>\r\n</div>\r\n', 'public', 'publish', '2022-01-14 22:15:25', '2025-11-16 09:12:45', '0', 'default', 'none', '01', '', 'on', 'on', '01', '01', '0', '0'),
(43, 'All Services', 'all-services', NULL, 'all', 'publish', '2022-04-21 05:28:48', '2023-07-18 13:01:32', NULL, 'normal_layout', NULL, '02', NULL, NULL, 'on', '01', NULL, NULL, NULL),
(44, 'Subscription Plan', 'price-plan', '<p>Price Plan<br></p>', 'all', 'publish', '2022-09-03 04:04:25', '2022-11-22 07:21:24', 'on', 'normal_layout', NULL, '02', NULL, NULL, 'on', '02', NULL, NULL, NULL),
(45, 'Jobs', 'jobs', '<p>Jobs</p>', 'all', 'publish', '2022-10-11 22:38:42', '2022-10-11 23:10:39', 'on', 'normal_layout', NULL, '02', NULL, NULL, 'on', '02', NULL, NULL, NULL),
(47, 'Online Services', 'online-services', NULL, 'all', 'publish', '2023-07-17 18:02:45', '2023-07-17 18:03:32', 'on', 'normal_layout', NULL, '02', NULL, NULL, 'on', '02', NULL, NULL, NULL),
(48, 'صيانة تك - منصة خدمات الصيانة المنزلية والتقنية', 'home', NULL, 'all', 'publish', '2023-07-27 07:50:33', '2025-12-08 06:36:35', 'on', 'normal_layout', NULL, '02', 'nav-absolute', NULL, NULL, '02', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `page_builders`
--

CREATE TABLE `page_builders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `addon_name` varchar(191) DEFAULT NULL,
  `addon_type` varchar(191) DEFAULT NULL,
  `addon_namespace` varchar(191) DEFAULT NULL,
  `addon_location` varchar(191) DEFAULT NULL,
  `addon_order` bigint(20) UNSIGNED DEFAULT NULL,
  `addon_page_id` bigint(20) UNSIGNED DEFAULT NULL,
  `addon_page_type` varchar(191) DEFAULT NULL,
  `addon_settings` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_builders`
--

INSERT INTO `page_builders` (`id`, `addon_name`, `addon_type`, `addon_namespace`, `addon_location`, `addon_order`, `addon_page_id`, `addon_page_type`, `addon_settings`, `created_at`, `updated_at`) VALUES
(8, 'AboutAuthorStyleOne', 'new', 'App\\PageBuilder\\Addons\\Common\\AboutAuthorStyleOne', 'dynamic_page_with_sidebar', NULL, 15, 'dynamic_page_with_sidebar', 'a:17:{s:10:\"addon_name\";s:19:\"AboutAuthorStyleOne\";s:15:\"addon_namespace\";s:68:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xDb21tb25cQWJvdXRBdXRob3JTdHlsZU9uZQ==\";s:10:\"addon_type\";s:3:\"new\";s:14:\"addon_location\";s:25:\"dynamic_page_with_sidebar\";s:11:\"addon_order\";N;s:13:\"addon_page_id\";s:2:\"15\";s:15:\"addon_page_type\";s:25:\"dynamic_page_with_sidebar\";s:13:\"header_eleven\";a:14:{s:14:\"subtitle_en_GB\";a:1:{i:0;s:12:\"about author\";}s:11:\"title_en_GB\";a:1:{i:0;N;}s:17:\"description_en_GB\";a:1:{i:0;N;}s:17:\"button_text_en_GB\";a:1:{i:0;N;}s:16:\"button_url_en_GB\";a:1:{i:0;N;}s:17:\"button_icon_en_GB\";a:1:{i:0;N;}s:17:\"right_image_en_GB\";a:1:{i:0;N;}s:11:\"subtitle_ar\";a:1:{i:0;N;}s:8:\"title_ar\";a:1:{i:0;N;}s:14:\"description_ar\";a:1:{i:0;N;}s:14:\"button_text_ar\";a:1:{i:0;N;}s:13:\"button_url_ar\";a:1:{i:0;N;}s:14:\"button_icon_ar\";a:1:{i:0;N;}s:14:\"right_image_ar\";a:1:{i:0;N;}}s:10:\"button_url\";N;s:12:\"author_image\";N;s:11:\"author_name\";N;s:19:\"author_name_summber\";N;s:17:\"summer_note_image\";N;s:18:\"author_name_slider\";s:2:\"50\";s:17:\"author_name_color\";N;s:11:\"padding_top\";s:3:\"200\";s:14:\"padding_bottom\";s:3:\"300\";}', '2021-10-04 07:18:03', '2021-10-04 07:18:03'),
(37, 'ContactArea', 'update', 'App\\PageBuilder\\Addons\\ContactArea\\ContactArea', 'dynamic_page', 1, 19, 'dynamic_page', 'a:14:{s:2:\"id\";s:2:\"37\";s:10:\"addon_name\";s:11:\"ContactArea\";s:15:\"addon_namespace\";s:64:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xDb250YWN0QXJlYVxDb250YWN0QXJlYQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"19\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:11:\"title_en_GB\";s:28:\"Have Any Query? Send Message\";s:8:\"title_ar\";s:55:\"هل لديك أي استفسار؟ أرسل رسالة\";s:28:\"contact_page_contact_info_01\";a:4:{s:11:\"title_en_GB\";a:3:{i:0;s:8:\"Address:\";i:1;s:6:\"Phone:\";i:2;s:6:\"Email:\";}s:17:\"description_en_GB\";a:3:{i:0;s:44:\"2779 Rubaiyat Road,\r\nTraverse City, MI 49684\";i:1;s:30:\"+012 789654321\r\n+969 123456789\";i:2;s:34:\"company@mail.com\r\ncontact@mail.com\";}s:8:\"title_ar\";a:3:{i:0;s:11:\"عنوان:\";i:1;s:9:\"هاتف:\";i:2;s:30:\"بريد الالكتروني:\";}s:14:\"description_ar\";a:3:{i:0;s:44:\"2779 Rubaiyat Road,\r\nTraverse City, MI 49684\";i:1;s:30:\"+012 789654321\r\n+969 123456789\";i:2;s:34:\"company@mail.com\r\ncontact@mail.com\";}}s:14:\"custom_form_id\";s:1:\"1\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";}', '2021-10-06 23:52:42', '2021-11-21 11:02:16'),
(38, 'GoogleMap', 'update', 'App\\PageBuilder\\Addons\\Common\\GoogleMap', 'dynamic_page', 2, 19, 'dynamic_page', 'a:10:{s:2:\"id\";s:2:\"38\";s:10:\"addon_name\";s:9:\"GoogleMap\";s:15:\"addon_namespace\";s:52:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xDb21tb25cR29vZ2xlTWFw\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"2\";s:13:\"addon_page_id\";s:2:\"19\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:8:\"location\";s:22:\"Avenue Afton, MN 55001\";s:10:\"map_height\";s:3:\"500\";}', '2021-10-07 01:44:43', '2021-11-21 10:49:23'),
(39, 'ImageGalleryMasonry', 'update', 'App\\PageBuilder\\Addons\\ImageGallery\\ImageGalleryMasonry', 'dynamic_page', 1, 20, 'dynamic_page', 'a:16:{s:2:\"id\";s:2:\"39\";s:10:\"addon_name\";s:19:\"ImageGalleryMasonry\";s:15:\"addon_namespace\";s:76:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xJbWFnZUdhbGxlcnlcSW1hZ2VHYWxsZXJ5TWFzb25yeQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"20\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:10:\"categories\";a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"9\";s:17:\"pagination_status\";s:2:\"on\";s:20:\"pagination_alignment\";s:11:\"text-center\";s:11:\"padding_top\";s:3:\"110\";s:14:\"padding_bottom\";s:3:\"110\";}', '2021-10-09 00:19:18', '2021-10-09 05:31:18'),
(46, 'BlogGridTravel', 'update', 'App\\PageBuilder\\Addons\\Blog\\BlogGridTravel', 'dynamic_page', 1, 18, 'dynamic_page', 'a:22:{s:2:\"id\";s:2:\"46\";s:10:\"addon_name\";s:14:\"BlogGridTravel\";s:15:\"addon_namespace\";s:56:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xCbG9nXEJsb2dHcmlkVHJhdmVs\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"18\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:16:\"share_text_en_GB\";s:5:\"Share\";s:13:\"share_text_ar\";s:10:\"يشارك\";s:10:\"categories\";s:1:\"2\";s:15:\"play_icon_color\";s:18:\"rgb(234, 244, 248)\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"4\";s:7:\"columns\";s:8:\"col-lg-6\";s:9:\"name_icon\";s:11:\"las la-user\";s:9:\"date_icon\";s:12:\"las la-clock\";s:10:\"share_icon\";s:19:\"las la-share-square\";s:20:\"pagination_alignment\";s:11:\"text-center\";s:11:\"padding_top\";s:1:\"0\";s:14:\"padding_bottom\";s:3:\"100\";}', '2021-10-18 03:58:08', '2021-11-17 19:42:06'),
(59, 'HeaderStyleOne', 'update', 'App\\PageBuilder\\Addons\\Header\\HeaderStyleOne', 'dynamic_page', 1, 23, 'dynamic_page', 'a:18:{s:2:\"id\";s:2:\"59\";s:10:\"addon_name\";s:20:\"HeaderStyleOne\";s:15:\"addon_namespace\";s:68:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIZWFkZXJcSGVhZGVyQXJlYVN0eWxlVGhyZWU=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"23\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:11:\"title_en_GB\";s:5:\"Juice\";s:17:\"description_en_GB\";s:63:\"It is a long established fact that a reader will be distracted.\";s:17:\"button_text_en_GB\";s:9:\"Read More\";s:8:\"title_ar\";s:8:\"عصير\";s:14:\"description_ar\";s:110:\"هناك حقيقة مثبتة منذ زمن طويل وهي أن القارئ سوف يشتت انتباهه.\";s:14:\"button_text_ar\";s:17:\"اقرأ أكثر\";s:10:\"button_url\";s:1:\"#\";s:16:\"background_image\";s:3:\"236\";s:11:\"padding_top\";s:1:\"0\";s:14:\"padding_bottom\";s:1:\"0\";}', '2021-10-23 04:54:22', '2021-11-06 07:10:58'),
(60, 'CategoryHighlight', 'update', 'App\\PageBuilder\\Addons\\Home\\CategoryHighlight', 'dynamic_page', 2, 23, 'dynamic_page', 'a:14:{s:2:\"id\";s:2:\"60\";s:10:\"addon_name\";s:17:\"CategoryHighlight\";s:15:\"addon_namespace\";s:60:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIb21lXENhdGVnb3J5SGlnaGxpZ2h0\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"2\";s:13:\"addon_page_id\";s:2:\"23\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:15:\"blog_categories\";a:4:{i:0;s:1:\"2\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"6\";}s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"4\";s:11:\"padding_top\";s:1:\"2\";s:14:\"padding_bottom\";s:1:\"2\";}', '2021-10-23 05:30:37', '2021-11-10 23:47:05'),
(61, 'BlogSliderStyleTwo', 'update', 'App\\PageBuilder\\Addons\\Blog\\BlogSliderStyleTwo', 'dynamic_page', 3, 23, 'dynamic_page', 'a:18:{s:2:\"id\";s:2:\"61\";s:10:\"addon_name\";s:18:\"BlogSliderStyleTwo\";s:15:\"addon_namespace\";s:64:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xCbG9nXEJsb2dTbGlkZXJTdHlsZVR3bw==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"3\";s:13:\"addon_page_id\";s:2:\"23\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:19:\"section_title_en_GB\";s:19:\"Highlighted Article\";s:16:\"categories_en_GB\";a:1:{i:0;s:1:\"3\";}s:16:\"section_title_ar\";s:21:\"مقالة مميزة\";s:23:\"section_title_alignment\";s:12:\"center-align\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"3\";s:12:\"slider_items\";s:1:\"3\";s:11:\"padding_top\";s:2:\"80\";s:14:\"padding_bottom\";s:1:\"2\";}', '2021-10-23 05:46:25', '2021-10-31 05:30:41'),
(62, 'BannerOne', 'update', 'App\\PageBuilder\\Addons\\Common\\BannerOne', 'dynamic_page', 4, 23, 'dynamic_page', 'a:13:{s:2:\"id\";s:2:\"62\";s:10:\"addon_name\";s:9:\"BannerOne\";s:15:\"addon_namespace\";s:52:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xDb21tb25cQmFubmVyT25l\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"4\";s:13:\"addon_page_id\";s:2:\"23\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"image\";s:2:\"94\";s:9:\"image_url\";s:1:\"#\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";s:17:\"section_show_hide\";s:0:\"\";}', '2021-10-23 05:48:44', '2025-11-14 22:18:25'),
(64, 'BlogGridFood', 'update', 'App\\PageBuilder\\Addons\\Home\\BlogGridFood', 'dynamic_page', 5, 23, 'dynamic_page', 'a:19:{s:2:\"id\";s:2:\"64\";s:10:\"addon_name\";s:12:\"BlogGridFood\";s:15:\"addon_namespace\";s:56:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIb21lXEJsb2dHcmlkRm9vZA==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"5\";s:13:\"addon_page_id\";s:2:\"23\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:18:\"heading_text_en_GB\";s:14:\"Recent Article\";s:15:\"heading_text_ar\";s:27:\"المادة الأخيرة\";s:10:\"categories\";s:1:\"3\";s:15:\"play_icon_color\";N;s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"4\";s:7:\"columns\";s:8:\"col-lg-6\";s:20:\"pagination_alignment\";s:11:\"text-center\";s:11:\"padding_top\";s:1:\"0\";s:14:\"padding_bottom\";s:1:\"0\";}', '2021-10-23 05:56:07', '2021-11-15 01:09:56'),
(66, 'VideoAreaStyleThree', 'update', 'App\\PageBuilder\\Addons\\Home\\VideoAreaStyleThree', 'dynamic_page', 6, 23, 'dynamic_page', 'a:15:{s:2:\"id\";s:2:\"66\";s:10:\"addon_name\";s:19:\"VideoAreaStyleThree\";s:15:\"addon_namespace\";s:64:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIb21lXFZpZGVvQXJlYVN0eWxlVGhyZWU=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"6\";s:13:\"addon_page_id\";s:2:\"23\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:18:\"heading_text_en_GB\";s:6:\"Videos\";s:15:\"heading_text_ar\";s:21:\"أشرطة فيديو\";s:5:\"blogs\";a:2:{i:0;s:3:\"118\";i:1;s:3:\"119\";}s:15:\"play_icon_color\";s:15:\"rgb(36, 36, 36)\";s:5:\"items\";s:1:\"2\";s:11:\"padding_top\";s:1:\"0\";s:14:\"padding_bottom\";s:1:\"0\";}', '2021-10-23 06:51:53', '2021-11-17 17:37:08'),
(67, 'GoogleAdsense', 'update', 'App\\PageBuilder\\Addons\\Common\\Advertise', 'dynamic_page', 7, 23, 'dynamic_page', 'a:12:{s:2:\"id\";s:2:\"67\";s:10:\"addon_name\";s:13:\"GoogleAdsense\";s:15:\"addon_namespace\";s:52:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xDb21tb25cQWR2ZXJ0aXNl\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"7\";s:13:\"addon_page_id\";s:2:\"23\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:18:\"advertisement_type\";s:5:\"image\";s:18:\"advertisement_size\";s:8:\"250*1110\";s:11:\"padding_top\";s:2:\"60\";s:14:\"padding_bottom\";s:3:\"100\";}', '2021-10-23 07:00:46', '2021-11-15 01:11:00'),
(68, 'BestArticle', 'update', 'App\\PageBuilder\\Addons\\Home\\BestArticle', 'dynamic_page', 8, 23, 'dynamic_page', 'a:15:{s:2:\"id\";s:2:\"68\";s:10:\"addon_name\";s:11:\"BestArticle\";s:15:\"addon_namespace\";s:52:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIb21lXEJlc3RBcnRpY2xl\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"8\";s:13:\"addon_page_id\";s:2:\"23\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:18:\"heading_text_en_GB\";s:12:\"Best Article\";s:15:\"heading_text_ar\";N;s:10:\"categories\";a:1:{i:0;s:1:\"3\";}s:15:\"play_icon_color\";s:18:\"rgb(251, 250, 250)\";s:5:\"items\";s:1:\"5\";s:11:\"padding_top\";s:1:\"3\";s:14:\"padding_bottom\";s:3:\"100\";}', '2021-10-23 07:01:58', '2021-11-13 04:36:56'),
(70, 'CustomHeaderSliderTwoWithCategory', 'update', 'App\\PageBuilder\\Addons\\HeaderSlider\\CustomHeaderSliderTwoWithCategory', 'dynamic_page', 1, 24, 'dynamic_page', 'a:11:{s:2:\"id\";s:2:\"70\";s:10:\"addon_name\";s:33:\"CustomHeaderSliderTwoWithCategory\";s:15:\"addon_namespace\";s:92:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIZWFkZXJTbGlkZXJcQ3VzdG9tSGVhZGVyU2xpZGVyVHdvV2l0aENhdGVnb3J5\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"24\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:10:\"header_ten\";a:12:{s:20:\"category_title_en_GB\";a:3:{i:0;s:6:\"Flower\";i:1;s:5:\"Music\";i:2;s:6:\"Nature\";}s:18:\"category_url_en_GB\";a:3:{i:0;s:1:\"#\";i:1;s:1:\"#\";i:2;s:1:\"#\";}s:11:\"title_en_GB\";a:3:{i:0;s:62:\"Working in front of nature one receives far more than he seeks\";i:1;s:46:\"So love is the flower you’ve got to let grow\";i:2;s:63:\"In every walk in with nature one receives far more than he seek\";}s:15:\"title_url_en_GB\";a:3:{i:0;s:1:\"#\";i:1;s:1:\"#\";i:2;s:1:\"#\";}s:19:\"category_icon_en_GB\";a:3:{i:0;s:10:\"las la-tag\";i:1;s:10:\"las la-tag\";i:2;s:10:\"las la-tag\";}s:22:\"background_image_en_GB\";a:3:{i:0;s:3:\"188\";i:1;s:3:\"196\";i:2;s:3:\"190\";}s:17:\"category_title_ar\";a:3:{i:0;s:6:\"ورد\";i:1;s:12:\"موسيقى\";i:2;s:19:\"طبيعة سجية\";}s:15:\"category_url_ar\";a:3:{i:0;s:1:\"#\";i:1;s:1:\"#\";i:2;s:1:\"#\";}s:8:\"title_ar\";a:3:{i:0;s:72:\"الحب هو الزهرة التي عليك أن تتركها تنمو.\";i:1;s:72:\"الحب هو الزهرة التي عليك أن تتركها تنمو.\";i:2;s:72:\"الحب هو الزهرة التي عليك أن تتركها تنمو.\";}s:12:\"title_url_ar\";a:3:{i:0;s:1:\"#\";i:1;s:1:\"#\";i:2;s:1:\"#\";}s:16:\"category_icon_ar\";a:3:{i:0;N;i:1;N;i:2;N;}s:19:\"background_image_ar\";a:3:{i:0;s:3:\"191\";i:1;s:3:\"192\";i:2;s:3:\"195\";}}s:11:\"padding_top\";s:1:\"0\";s:14:\"padding_bottom\";s:1:\"0\";}', '2021-10-23 07:34:20', '2021-11-17 17:57:22'),
(73, 'BlogListStyleFour', 'update', 'App\\PageBuilder\\Addons\\Home\\BlogListStyleFour', 'dynamic_page_with_sidebar', 1, 24, 'dynamic_page_with_sidebar', 'a:20:{s:2:\"id\";s:2:\"73\";s:10:\"addon_name\";s:17:\"BlogListStyleFour\";s:15:\"addon_namespace\";s:60:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIb21lXEJsb2dMaXN0U3R5bGVGb3Vy\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:25:\"dynamic_page_with_sidebar\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"24\";s:15:\"addon_page_type\";s:25:\"dynamic_page_with_sidebar\";s:25:\"comment_button_text_en_GB\";s:7:\"Comment\";s:16:\"share_text_en_GB\";s:5:\"Share\";s:22:\"comment_button_text_ar\";s:10:\"تعليق\";s:13:\"share_text_ar\";s:10:\"يشارك\";s:10:\"categories\";s:1:\"7\";s:15:\"play_icon_color\";N;s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:4:\"desc\";s:5:\"items\";s:1:\"1\";s:7:\"columns\";s:9:\"col-lg-12\";s:11:\"padding_top\";s:1:\"0\";s:14:\"padding_bottom\";s:2:\"50\";}', '2021-10-24 00:14:09', '2021-11-20 10:05:04'),
(74, 'BlogGridOne', 'update', 'App\\PageBuilder\\Addons\\Blog\\BlogGridOne', 'dynamic_page_with_sidebar', 10, 24, 'dynamic_page_with_sidebar', 'a:20:{s:2:\"id\";s:2:\"74\";s:10:\"addon_name\";s:11:\"BlogGridOne\";s:15:\"addon_namespace\";s:52:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xCbG9nXEJsb2dHcmlkT25l\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:25:\"dynamic_page_with_sidebar\";s:11:\"addon_order\";s:2:\"10\";s:13:\"addon_page_id\";s:2:\"24\";s:15:\"addon_page_type\";s:25:\"dynamic_page_with_sidebar\";s:19:\"comments_text_en_GB\";s:8:\"Comments\";s:16:\"comments_text_ar\";s:14:\"تعليقات\";s:10:\"categories\";a:1:{i:0;s:1:\"7\";}s:15:\"play_icon_color\";s:15:\"rgb(43, 34, 34)\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:4:\"desc\";s:5:\"items\";s:1:\"4\";s:7:\"columns\";s:8:\"col-lg-6\";s:13:\"category_icon\";s:10:\"las la-tag\";s:20:\"pagination_alignment\";s:9:\"text-left\";s:11:\"padding_top\";s:1:\"3\";s:14:\"padding_bottom\";s:1:\"3\";}', '2021-10-24 01:00:29', '2021-11-17 19:59:59'),
(75, 'BannerOne', 'update', 'App\\PageBuilder\\Addons\\Common\\BannerOne', 'dynamic_page_with_sidebar', 11, 24, 'dynamic_page_with_sidebar', 'a:12:{s:2:\"id\";s:2:\"75\";s:10:\"addon_name\";s:9:\"BannerOne\";s:15:\"addon_namespace\";s:52:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xCbG9nXEJhbm5lck9uZQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:25:\"dynamic_page_with_sidebar\";s:11:\"addon_order\";s:1:\"4\";s:13:\"addon_page_id\";s:2:\"24\";s:15:\"addon_page_type\";s:25:\"dynamic_page_with_sidebar\";s:5:\"image\";s:2:\"96\";s:9:\"image_url\";s:1:\"#\";s:11:\"padding_top\";s:1:\"0\";s:14:\"padding_bottom\";s:1:\"0\";}', '2021-10-24 01:15:49', '2021-11-17 17:47:53'),
(76, 'BlogListStyleFour', 'update', 'App\\PageBuilder\\Addons\\Home\\BlogListStyleFour', 'dynamic_page_with_sidebar', 12, 24, 'dynamic_page_with_sidebar', 'a:20:{s:2:\"id\";s:2:\"76\";s:10:\"addon_name\";s:17:\"BlogListStyleFour\";s:15:\"addon_namespace\";s:60:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIb21lXEJsb2dMaXN0U3R5bGVGb3Vy\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:25:\"dynamic_page_with_sidebar\";s:11:\"addon_order\";s:2:\"12\";s:13:\"addon_page_id\";s:2:\"24\";s:15:\"addon_page_type\";s:25:\"dynamic_page_with_sidebar\";s:25:\"comment_button_text_en_GB\";s:8:\"Comments\";s:16:\"share_text_en_GB\";s:5:\"Share\";s:22:\"comment_button_text_ar\";s:14:\"تعليقات\";s:13:\"share_text_ar\";s:10:\"يشارك\";s:10:\"categories\";s:1:\"7\";s:15:\"play_icon_color\";s:18:\"rgb(243, 243, 243)\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:4:\"desc\";s:5:\"items\";s:1:\"1\";s:7:\"columns\";s:9:\"col-lg-12\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";}', '2021-10-24 01:16:54', '2021-11-20 10:14:27'),
(77, 'BlogGridOne', 'update', 'App\\PageBuilder\\Addons\\Blog\\BlogGridOne', 'dynamic_page_with_sidebar', 13, 24, 'dynamic_page_with_sidebar', 'a:20:{s:2:\"id\";s:2:\"77\";s:10:\"addon_name\";s:11:\"BlogGridOne\";s:15:\"addon_namespace\";s:52:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xCbG9nXEJsb2dHcmlkT25l\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:25:\"dynamic_page_with_sidebar\";s:11:\"addon_order\";s:2:\"13\";s:13:\"addon_page_id\";s:2:\"24\";s:15:\"addon_page_type\";s:25:\"dynamic_page_with_sidebar\";s:19:\"comments_text_en_GB\";s:8:\"Comments\";s:16:\"comments_text_ar\";s:14:\"تعليقات\";s:10:\"categories\";a:1:{i:0;s:1:\"7\";}s:15:\"play_icon_color\";s:15:\"rgb(75, 69, 69)\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:4:\"desc\";s:5:\"items\";s:1:\"4\";s:7:\"columns\";s:8:\"col-lg-6\";s:13:\"category_icon\";s:10:\"las la-tag\";s:20:\"pagination_alignment\";s:9:\"text-left\";s:11:\"padding_top\";s:2:\"11\";s:14:\"padding_bottom\";s:2:\"10\";}', '2021-10-24 01:19:39', '2021-11-17 20:00:12'),
(82, 'HeaderAreaStyleFive', 'update', 'App\\PageBuilder\\Addons\\Header\\HeaderAreaStyleFive', 'dynamic_page', 1, 25, 'dynamic_page', 'a:31:{s:2:\"id\";s:2:\"82\";s:10:\"addon_name\";s:19:\"HeaderAreaStyleFive\";s:15:\"addon_namespace\";s:68:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIZWFkZXJcSGVhZGVyQXJlYVN0eWxlRml2ZQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"25\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:16:\"left_title_en_GB\";s:46:\"Life is a challenge, meet it! Life is a dream.\";s:19:\"left_category_en_GB\";s:4:\"Game\";s:21:\"right_title_one_en_GB\";s:68:\"Men are but flesh and blood. They know their doom, but not the hour.\";s:24:\"right_category_one_en_GB\";s:4:\"Game\";s:21:\"right_title_two_en_GB\";s:65:\"What is a drop of rain, compared to the storm? What is a thought.\";s:24:\"right_category_two_en_GB\";s:4:\"Game\";s:13:\"left_title_ar\";s:69:\"الحياة هي التحدي، مواجهته! الحياة حلم.\";s:16:\"left_category_ar\";s:8:\"لعبة\";s:18:\"right_title_one_ar\";s:110:\"الرجال ما هم إلا لحم ودم. إنهم يعرفون مصيرهم ، لكن ليس الساعة.\";s:21:\"right_category_one_ar\";s:8:\"لعبة\";s:18:\"right_title_two_ar\";s:110:\"الرجال ما هم إلا لحم ودم. إنهم يعرفون مصيرهم ، لكن ليس الساعة.\";s:21:\"right_category_two_ar\";s:8:\"لعبة\";s:14:\"left_title_url\";s:1:\"#\";s:17:\"left_category_url\";s:1:\"#\";s:19:\"right_title_url_one\";s:1:\"#\";s:22:\"right_category_url_one\";s:1:\"#\";s:19:\"right_title_url_two\";s:1:\"#\";s:22:\"right_category_url_two\";s:1:\"#\";s:10:\"left_image\";s:3:\"229\";s:15:\"right_image_one\";s:3:\"231\";s:15:\"right_image_two\";s:3:\"232\";s:11:\"padding_top\";s:2:\"30\";s:14:\"padding_bottom\";s:1:\"0\";}', '2021-10-24 03:29:43', '2021-11-20 09:51:19'),
(83, 'BlogListBig', 'update', 'App\\PageBuilder\\Addons\\Home\\BlogListBig', 'dynamic_page', 2, 25, 'dynamic_page', 'a:18:{s:2:\"id\";s:2:\"83\";s:10:\"addon_name\";s:11:\"BlogListBig\";s:15:\"addon_namespace\";s:52:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIb21lXEJsb2dMaXN0Qmln\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"2\";s:13:\"addon_page_id\";s:2:\"25\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:10:\"categories\";s:3:\"115\";s:12:\"button_style\";s:21:\"style_one_violate_tag\";s:15:\"play_icon_color\";N;s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"1\";s:7:\"columns\";s:9:\"col-lg-12\";s:20:\"pagination_alignment\";s:9:\"text-left\";s:11:\"padding_top\";s:1:\"1\";s:14:\"padding_bottom\";s:1:\"1\";}', '2021-10-24 04:23:31', '2021-11-22 11:02:13'),
(85, 'BlogListFive', 'update', 'App\\PageBuilder\\Addons\\Home\\BlogListFive', 'dynamic_page_with_sidebar', 1, 25, 'dynamic_page_with_sidebar', 'a:17:{s:2:\"id\";s:2:\"85\";s:10:\"addon_name\";s:12:\"BlogListFive\";s:15:\"addon_namespace\";s:56:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIb21lXEJsb2dMaXN0Rml2ZQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:25:\"dynamic_page_with_sidebar\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"25\";s:15:\"addon_page_type\";s:25:\"dynamic_page_with_sidebar\";s:10:\"categories\";a:1:{i:0;s:2:\"12\";}s:12:\"button_style\";s:21:\"style_one_violate_tag\";s:15:\"play_icon_color\";N;s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"3\";s:20:\"pagination_alignment\";s:9:\"text-left\";s:11:\"padding_top\";s:1:\"0\";s:14:\"padding_bottom\";s:1:\"0\";}', '2021-10-24 04:52:03', '2021-11-22 10:48:19'),
(86, 'BannerOne', 'update', 'App\\PageBuilder\\Addons\\Common\\BannerOne', 'dynamic_page_with_sidebar', 2, 25, 'dynamic_page_with_sidebar', 'a:12:{s:2:\"id\";s:2:\"86\";s:10:\"addon_name\";s:9:\"BannerOne\";s:15:\"addon_namespace\";s:52:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xCbG9nXEJhbm5lck9uZQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:25:\"dynamic_page_with_sidebar\";s:11:\"addon_order\";s:1:\"2\";s:13:\"addon_page_id\";s:2:\"25\";s:15:\"addon_page_type\";s:25:\"dynamic_page_with_sidebar\";s:5:\"image\";s:2:\"94\";s:9:\"image_url\";s:1:\"#\";s:11:\"padding_top\";s:1:\"2\";s:14:\"padding_bottom\";s:1:\"2\";}', '2021-10-24 04:59:56', '2021-10-31 05:32:37'),
(87, 'BlogListFive', 'update', 'App\\PageBuilder\\Addons\\Home\\BlogListFive', 'dynamic_page_with_sidebar', 3, 25, 'dynamic_page_with_sidebar', 'a:17:{s:2:\"id\";s:2:\"87\";s:10:\"addon_name\";s:12:\"BlogListFive\";s:15:\"addon_namespace\";s:56:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIb21lXEJsb2dMaXN0Rml2ZQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:25:\"dynamic_page_with_sidebar\";s:11:\"addon_order\";s:1:\"3\";s:13:\"addon_page_id\";s:2:\"25\";s:15:\"addon_page_type\";s:25:\"dynamic_page_with_sidebar\";s:10:\"categories\";a:1:{i:0;s:2:\"12\";}s:12:\"button_style\";s:21:\"style_one_violate_tag\";s:15:\"play_icon_color\";N;s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"1\";s:20:\"pagination_alignment\";s:9:\"text-left\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:2:\"76\";}', '2021-10-24 05:00:15', '2021-11-22 10:48:29'),
(88, 'BlogGridOne', 'update', 'App\\PageBuilder\\Addons\\Blog\\BlogGridOne', 'dynamic_page', 1, 26, 'dynamic_page', 'a:22:{s:2:\"id\";s:2:\"88\";s:10:\"addon_name\";s:11:\"BlogGridOne\";s:15:\"addon_namespace\";s:52:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xCbG9nXEJsb2dHcmlkT25l\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"26\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:19:\"comments_text_en_GB\";s:8:\"Comments\";s:16:\"comments_text_ar\";s:14:\"تعليقات\";s:10:\"categories\";a:1:{i:0;s:1:\"7\";}s:15:\"play_icon_color\";s:15:\"rgb(70, 65, 65)\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"6\";s:7:\"columns\";s:8:\"col-lg-4\";s:13:\"category_icon\";s:10:\"las la-tag\";s:13:\"comments_icon\";s:14:\"las la-comment\";s:17:\"pagination_status\";s:2:\"on\";s:20:\"pagination_alignment\";s:11:\"text-center\";s:11:\"padding_top\";s:3:\"110\";s:14:\"padding_bottom\";s:3:\"110\";}', '2021-10-24 06:31:14', '2021-11-09 01:54:59'),
(89, 'BlogListFood', 'update', 'App\\PageBuilder\\Addons\\Blog\\BlogListFood', 'dynamic_page', 1, 27, 'dynamic_page', 'a:18:{s:2:\"id\";s:2:\"89\";s:10:\"addon_name\";s:12:\"BlogListFood\";s:15:\"addon_namespace\";s:56:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xCbG9nXEJsb2dMaXN0Rm9vZA==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"27\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:10:\"categories\";s:1:\"3\";s:15:\"play_icon_color\";s:15:\"rgb(28, 27, 27)\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:4:\"desc\";s:5:\"items\";s:1:\"4\";s:7:\"columns\";s:9:\"col-lg-12\";s:17:\"pagination_status\";s:2:\"on\";s:20:\"pagination_alignment\";s:11:\"text-center\";s:11:\"padding_top\";s:3:\"120\";s:14:\"padding_bottom\";s:3:\"164\";}', '2021-10-24 07:01:11', '2021-11-13 08:19:40'),
(91, 'BlogListNature', 'update', 'App\\PageBuilder\\Addons\\Blog\\BlogListNature', 'dynamic_page_with_sidebar', 1, 28, 'dynamic_page_with_sidebar', 'a:20:{s:2:\"id\";s:2:\"91\";s:10:\"addon_name\";s:14:\"BlogListNature\";s:15:\"addon_namespace\";s:56:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xCbG9nXEJsb2dMaXN0TmF0dXJl\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:25:\"dynamic_page_with_sidebar\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"28\";s:15:\"addon_page_type\";s:25:\"dynamic_page_with_sidebar\";s:18:\"comment_text_en_GB\";s:8:\"Comments\";s:16:\"share_text_en_GB\";s:5:\"Share\";s:15:\"comment_text_ar\";s:14:\"تعليقات\";s:13:\"share_text_ar\";s:12:\"يشارك :\";s:10:\"categories\";s:1:\"7\";s:15:\"play_icon_color\";N;s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:4:\"desc\";s:5:\"items\";s:1:\"4\";s:20:\"pagination_alignment\";s:9:\"text-left\";s:11:\"padding_top\";s:1:\"0\";s:14:\"padding_bottom\";s:1:\"0\";}', '2021-10-24 07:37:58', '2021-11-21 12:04:46'),
(100, 'InstagramImage', 'update', 'App\\PageBuilder\\Addons\\Home\\InstagramImage', 'dynamic_page_with_sidebar', 6, 24, 'sortable_02', 'a:15:{s:2:\"id\";s:3:\"100\";s:10:\"addon_name\";s:14:\"InstagramImage\";s:15:\"addon_namespace\";s:56:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIb21lXEluc3RhZ3JhbUltYWdl\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:25:\"dynamic_page_with_sidebar\";s:11:\"addon_order\";s:1:\"6\";s:13:\"addon_page_id\";s:2:\"24\";s:15:\"addon_page_type\";s:11:\"sortable_02\";s:16:\"title_text_en_GB\";s:22:\"Follow us on Instagram\";s:13:\"title_text_ar\";s:44:\"متابعتنا على الانستقرام\";s:9:\"title_url\";s:1:\"#\";s:14:\"instagram_icon\";s:16:\"lab la-instagram\";s:9:\"item_show\";s:1:\"6\";s:11:\"padding_top\";s:2:\"60\";s:14:\"padding_bottom\";s:2:\"60\";}', '2021-11-02 05:15:37', '2021-11-02 05:15:38'),
(101, 'InstagramImage', 'update', 'App\\PageBuilder\\Addons\\Home\\InstagramImage', 'dynamic_page_with_sidebar', 38, 24, 'sortable_02', 'a:15:{s:2:\"id\";s:3:\"101\";s:10:\"addon_name\";s:14:\"InstagramImage\";s:15:\"addon_namespace\";s:56:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIb21lXEluc3RhZ3JhbUltYWdl\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:25:\"dynamic_page_with_sidebar\";s:11:\"addon_order\";s:2:\"38\";s:13:\"addon_page_id\";s:2:\"24\";s:15:\"addon_page_type\";s:11:\"sortable_02\";s:16:\"title_text_en_GB\";s:22:\"Follow us on Instagram\";s:13:\"title_text_ar\";s:44:\"متابعتنا على الانستقرام\";s:9:\"title_url\";s:1:\"#\";s:14:\"instagram_icon\";s:16:\"lab la-instagram\";s:9:\"item_show\";s:1:\"6\";s:11:\"padding_top\";s:2:\"60\";s:14:\"padding_bottom\";s:2:\"60\";}', '2021-11-02 05:25:23', '2021-11-02 05:25:25'),
(102, 'InstagramImage', 'update', 'App\\PageBuilder\\Addons\\Home\\InstagramImage', 'dynamic_page_with_sidebar', 6, 24, 'sortable_02', 'a:15:{s:2:\"id\";s:3:\"102\";s:10:\"addon_name\";s:14:\"InstagramImage\";s:15:\"addon_namespace\";s:56:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIb21lXEluc3RhZ3JhbUltYWdl\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:25:\"dynamic_page_with_sidebar\";s:11:\"addon_order\";s:1:\"6\";s:13:\"addon_page_id\";s:2:\"24\";s:15:\"addon_page_type\";s:11:\"sortable_02\";s:16:\"title_text_en_GB\";s:22:\"Follow us on Instagram\";s:13:\"title_text_ar\";s:44:\"متابعتنا على الانستقرام\";s:9:\"title_url\";s:1:\"#\";s:14:\"instagram_icon\";s:16:\"lab la-instagram\";s:9:\"item_show\";s:1:\"6\";s:11:\"padding_top\";s:2:\"60\";s:14:\"padding_bottom\";s:2:\"60\";}', '2021-11-02 05:45:15', '2021-11-02 05:45:17'),
(104, 'InstagramImage', 'update', 'App\\PageBuilder\\Addons\\Home\\InstagramImage', 'dynamic_page_with_sidebar_two', 1, 24, 'dynamic_page_with_sidebar_two', 'a:15:{s:2:\"id\";s:3:\"104\";s:10:\"addon_name\";s:14:\"InstagramImage\";s:15:\"addon_namespace\";s:56:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIb21lXEluc3RhZ3JhbUltYWdl\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:29:\"dynamic_page_with_sidebar_two\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"24\";s:15:\"addon_page_type\";s:29:\"dynamic_page_with_sidebar_two\";s:16:\"title_text_en_GB\";s:22:\"Follow us on Instagram\";s:13:\"title_text_ar\";N;s:9:\"title_url\";s:1:\"#\";s:14:\"instagram_icon\";s:16:\"lab la-instagram\";s:9:\"item_show\";s:1:\"6\";s:11:\"padding_top\";s:1:\"0\";s:14:\"padding_bottom\";s:3:\"100\";}', '2021-11-02 05:50:14', '2021-11-17 12:22:23'),
(109, 'Search', 'update', 'App\\PageBuilder\\Addons\\Common\\Search', 'dynamic_page', 1, 30, 'dynamic_page', 'a:12:{s:2:\"id\";s:3:\"109\";s:10:\"addon_name\";s:6:\"Search\";s:15:\"addon_namespace\";s:48:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xDb21tb25cU2VhcmNo\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"30\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:14:\"tag_titleen_GB\";s:13:\"Top  Keywords\";s:11:\"tag_titlear\";s:38:\"أهم الكلمات الرئيسية\";s:11:\"padding_top\";s:3:\"110\";s:14:\"padding_bottom\";s:3:\"110\";}', '2021-11-20 01:56:38', '2021-11-20 01:56:40'),
(113, 'BrowseCategoryOne', 'update', 'App\\PageBuilder\\Addons\\BrowseCategory\\BrowseCategoryOne', 'dynamic_page', 2, 16, 'dynamic_page', 'a:17:{s:2:\"id\";s:3:\"113\";s:10:\"addon_name\";s:17:\"BrowseCategoryOne\";s:15:\"addon_namespace\";s:76:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xCcm93c2VDYXRlZ29yeVxCcm93c2VDYXRlZ29yeU9uZQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"2\";s:13:\"addon_page_id\";s:2:\"16\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:30:\"Browse فئات الخدمات\";s:16:\"title_text_color\";s:17:\"rgb(29, 191, 115)\";s:8:\"subtitle\";s:124:\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"6\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";N;}', '2021-11-28 22:43:25', '2025-11-14 22:10:41'),
(115, 'FeatureService', 'update', 'App\\PageBuilder\\Addons\\FeatureService\\FeatureService', 'dynamic_page', 3, 16, 'dynamic_page', 'a:19:{s:2:\"id\";s:3:\"115\";s:10:\"addon_name\";s:14:\"FeatureService\";s:15:\"addon_namespace\";s:72:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xGZWF0dXJlU2VydmljZVxGZWF0dXJlU2VydmljZQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"3\";s:13:\"addon_page_id\";s:2:\"16\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:29:\"الخدمات المميزة\";s:16:\"title_text_color\";s:17:\"rgb(29, 191, 115)\";s:8:\"subtitle\";s:123:\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout\";s:5:\"items\";s:1:\"6\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";N;s:9:\"btn_color\";s:17:\"rgb(29, 191, 115)\";s:14:\"btn_text_color\";N;s:16:\"dot_color_slider\";s:12:\"dot-color-01\";s:16:\"book_appointment\";N;}', '2022-01-04 01:00:48', '2025-11-14 19:10:08'),
(116, 'PopularService', 'update', 'App\\PageBuilder\\Addons\\PopularService\\PopularService', 'dynamic_page', 6, 16, 'dynamic_page', 'a:21:{s:2:\"id\";s:3:\"116\";s:10:\"addon_name\";s:14:\"PopularService\";s:15:\"addon_namespace\";s:72:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xQb3B1bGFyU2VydmljZVxQb3B1bGFyU2VydmljZQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"6\";s:13:\"addon_page_id\";s:2:\"16\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:15:\"Popular Service\";s:16:\"title_text_color\";s:17:\"rgb(29, 191, 115)\";s:8:\"subtitle\";s:124:\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.\";s:5:\"items\";s:1:\"6\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";N;s:9:\"btn_color\";s:17:\"rgb(29, 191, 115)\";s:14:\"btn_text_color\";N;s:17:\"explore_btn_color\";s:13:\"btn-outline-1\";s:11:\"hover_color\";s:11:\"hover_color\";s:17:\"explore_more_link\";N;s:16:\"book_appointment\";s:17:\"احجز الآن\";}', '2022-01-04 03:53:37', '2025-11-14 19:10:08'),
(117, 'WhyOurMarketplace', 'update', 'App\\PageBuilder\\Addons\\WhyOurMarketplace\\WhyOurMarketplace', 'dynamic_page', 7, 16, 'dynamic_page', 'a:15:{s:2:\"id\";s:3:\"117\";s:10:\"addon_name\";s:17:\"WhyOurMarketplace\";s:15:\"addon_namespace\";s:80:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xXaHlPdXJNYXJrZXRwbGFjZVxXaHlPdXJNYXJrZXRwbGFjZQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"5\";s:13:\"addon_page_id\";s:2:\"16\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:29:\"لماذا صيانة تك؟?\";s:16:\"title_text_color\";s:17:\"rgb(29, 191, 115)\";s:8:\"subtitle\";s:124:\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";N;s:28:\"contact_page_contact_info_01\";a:3:{s:5:\"icon_\";a:6:{i:0;s:12:\"las la-tools\";i:1;s:16:\"las la-users-cog\";i:2;s:17:\"las la-shield-alt\";i:3;s:16:\"las la-stopwatch\";i:4;s:26:\"las la-file-invoice-dollar\";i:5;s:14:\"las la-headset\";}s:6:\"title_\";a:6:{i:0;s:18:\"Service Commitment\";i:1;s:16:\"Super Experience\";i:2;s:16:\"User Data Secure\";i:3;s:12:\"Fast Service\";i:4;s:14:\"Secure Payment\";i:5;s:17:\"Dedicated Support\";}s:12:\"description_\";a:6:{i:0;s:124:\"It is a long established fact that a reader will be distracted by the readable. It is a long established fact that a reader.\";i:1;s:125:\"It is a long established fact that a reader will be distracted by the readable. It is a long established fact that a reader2.\";i:2;s:123:\"It is a long established fact that a reader will be distracted by the readable. It is a long established fact that a reader\";i:3;s:123:\"It is a long established fact that a reader will be distracted by the readable. It is a long established fact that a reader\";i:4;s:123:\"It is a long established fact that a reader will be distracted by the readable. It is a long established fact that a reader\";i:5;s:123:\"It is a long established fact that a reader will be distracted by the readable. It is a long established fact that a reader\";}}}', '2022-01-04 04:33:37', '2025-11-14 22:10:41'),
(118, 'ProfessionalService', 'update', 'App\\PageBuilder\\Addons\\PopularService\\ProfessionalService', 'dynamic_page', 8, 16, 'dynamic_page', 'a:14:{s:2:\"id\";s:3:\"118\";s:10:\"addon_name\";s:19:\"ProfessionalService\";s:15:\"addon_namespace\";s:76:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xQb3B1bGFyU2VydmljZVxQcm9mZXNzaW9uYWxTZXJ2aWNl\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"8\";s:13:\"addon_page_id\";s:2:\"16\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:29:\"Popular Professional Services\";s:16:\"title_text_color\";s:17:\"rgb(29, 191, 115)\";s:8:\"subtitle\";s:124:\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";N;}', '2022-01-04 07:08:26', '2023-07-28 03:43:13'),
(119, 'BecomeSeller', 'update', 'App\\PageBuilder\\Addons\\BecomeSeller\\BecomeSeller', 'dynamic_page', 9, 16, 'dynamic_page', 'a:19:{s:2:\"id\";s:3:\"119\";s:10:\"addon_name\";s:12:\"BecomeSeller\";s:15:\"addon_namespace\";s:64:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xCZWNvbWVTZWxsZXJcQmVjb21lU2VsbGVy\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"7\";s:13:\"addon_page_id\";s:2:\"16\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:11:\"كن فني\";s:16:\"title_text_color\";s:17:\"rgb(29, 191, 115)\";s:8:\"subtitle\";s:124:\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.\";s:10:\"section_bg\";N;s:9:\"btn_color\";s:17:\"rgb(29, 191, 115)\";s:8:\"btn_text\";s:13:\"Become Seller\";s:8:\"btn_link\";N;s:12:\"seller_image\";s:2:\"40\";s:28:\"contact_page_contact_info_01\";a:1:{s:9:\"benifits_\";a:3:{i:0;s:79:\"It is a long established fact that a reader will be distracted by the readable.\";i:1;s:79:\"It is a long established fact that a reader will be distracted by the readable.\";i:2;s:79:\"It is a long established fact that a reader will be distracted by the readable.\";}}s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";}', '2022-01-04 07:32:44', '2025-11-14 19:10:08'),
(123, 'ContactInfo', 'update', 'App\\PageBuilder\\Addons\\Contact\\ContactInfo', 'dynamic_page', 1, 34, 'dynamic_page', 'a:11:{s:2:\"id\";s:3:\"123\";s:10:\"addon_name\";s:11:\"ContactInfo\";s:15:\"addon_namespace\";s:56:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xDb250YWN0XENvbnRhY3RJbmZv\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"34\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:28:\"contact_page_contact_info_01\";a:4:{s:5:\"icon_\";a:3:{i:0;s:19:\"las la-phone-volume\";i:1;s:20:\"las la-envelope-open\";i:2;s:12:\"las la-clock\";}s:6:\"title_\";a:3:{i:0;s:7:\"Call Us\";i:1;s:12:\"Mail Address\";i:2;s:12:\"Support Time\";}s:14:\"description_1_\";a:3:{i:0;s:12:\"412-723-5750\";i:1;s:16:\"Contact@mail.com\";i:2;s:18:\"08.00am to 11.00pm\";}s:14:\"description_2_\";a:3:{i:0;s:12:\"978-488-6321\";i:1;s:16:\"Support@mail.com\";i:2;N;}}s:11:\"padding_top\";s:2:\"70\";s:14:\"padding_bottom\";s:2:\"50\";}', '2022-01-05 23:45:50', '2022-02-09 05:54:25'),
(124, 'ContactMessage', 'update', 'App\\PageBuilder\\Addons\\Contact\\ContactMessage', 'dynamic_page', 2, 34, 'dynamic_page', 'a:11:{s:2:\"id\";s:3:\"124\";s:10:\"addon_name\";s:14:\"ContactMessage\";s:15:\"addon_namespace\";s:60:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xDb250YWN0XENvbnRhY3RNZXNzYWdl\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"2\";s:13:\"addon_page_id\";s:2:\"34\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:11:\"padding_top\";s:2:\"50\";s:14:\"padding_bottom\";s:3:\"100\";s:14:\"custom_form_id\";s:1:\"1\";}', '2022-01-06 00:47:38', '2022-02-02 05:56:27'),
(125, 'AboutUs', 'update', 'App\\PageBuilder\\Addons\\About\\AboutUs', 'dynamic_page', 1, 31, 'dynamic_page', 'a:20:{s:2:\"id\";s:3:\"125\";s:10:\"addon_name\";s:7:\"AboutUs\";s:15:\"addon_namespace\";s:48:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xBYm91dFxBYm91dFVz\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"31\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:11:\"من نحن\";s:8:\"subtitle\";s:321:\"صيانة تك هي منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية. نوفر خدمات شاملة في مجالات الكهرباء والسباكة والتكييف من خلال فريق من الفنيين المعتمدين والمحترفين.\";s:4:\"year\";s:7:\"8 Years\";s:12:\"button_title\";s:19:\"تواصل معنا\";s:11:\"button_link\";s:24:\"http://localhost/contact\";s:20:\"experience_show_hide\";s:2:\"on\";s:20:\"about_list_show_hide\";s:2:\"on\";s:5:\"image\";s:3:\"916\";s:11:\"shape_image\";s:3:\"165\";s:28:\"contact_page_contact_info_01\";a:1:{s:9:\"benifits_\";a:6:{i:0;s:73:\"خدمات صيانة شاملة (كهرباء، سباكة، تكييف)\";i:1;s:73:\"فنيون معتمدون ومحترفون في جميع التخصصات\";i:2;s:42:\"خدمة على مدار الساعة 24/7\";i:3;s:36:\"أسعار شفافة ومحوكمة\";i:4;s:33:\"ضمان رقمي لكل خدمة\";i:5;s:63:\"تتبع مباشر للطلبات في الوقت الفعلي\";}}s:11:\"padding_top\";s:2:\"70\";s:14:\"padding_bottom\";s:3:\"140\";}', '2022-01-06 03:58:30', '2025-12-08 06:35:41'),
(133, 'AllBlog', 'update', 'App\\PageBuilder\\Addons\\Blog\\AllBlog', 'dynamic_page', 1, 29, 'dynamic_page', 'a:13:{s:2:\"id\";s:3:\"133\";s:10:\"addon_name\";s:7:\"AllBlog\";s:15:\"addon_namespace\";s:48:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xCbG9nXEFsbEJsb2c=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"29\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"4\";s:11:\"padding_top\";s:3:\"110\";s:14:\"padding_bottom\";s:3:\"110\";}', '2022-01-07 23:51:05', '2022-01-07 23:51:07'),
(134, 'AllBlog', 'update', 'App\\PageBuilder\\Addons\\Blog\\AllBlog', 'dynamic_page', 2, 35, 'dynamic_page', 'a:13:{s:2:\"id\";s:3:\"134\";s:10:\"addon_name\";s:7:\"AllBlog\";s:15:\"addon_namespace\";s:48:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xCbG9nXEFsbEJsb2c=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"35\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"6\";s:11:\"padding_top\";s:2:\"70\";s:14:\"padding_bottom\";s:3:\"100\";}', '2022-01-07 23:53:45', '2022-02-17 16:56:21'),
(135, 'RecentBlog', 'update', 'App\\PageBuilder\\Addons\\Home\\RecentBlog', 'dynamic_page', 10, 16, 'dynamic_page', 'a:18:{s:2:\"id\";s:3:\"135\";s:10:\"addon_name\";s:10:\"RecentBlog\";s:15:\"addon_namespace\";s:52:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIb21lXFJlY2VudEJsb2c=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:2:\"10\";s:13:\"addon_page_id\";s:2:\"16\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:22:\"Recent Blog & Articles\";s:16:\"title_text_color\";s:17:\"rgb(29, 191, 115)\";s:8:\"subtitle\";s:124:\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:4:\"desc\";s:5:\"items\";s:1:\"4\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";N;s:16:\"dot_color_slider\";s:12:\"dot-color-01\";}', '2022-01-10 03:33:21', '2023-07-28 03:43:19'),
(138, 'HeaderStyleTwo', 'update', 'App\\PageBuilder\\Addons\\Header\\HeaderStyleTwo', 'dynamic_page', 1, 22, 'dynamic_page', 'a:19:{s:2:\"id\";s:3:\"138\";s:10:\"addon_name\";s:14:\"HeaderStyleTwo\";s:15:\"addon_namespace\";s:60:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIZWFkZXJcSGVhZGVyU3R5bGVUd28=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"22\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:35:\"ONE-STOP SOLUTION FOR YOUR SERVICES\";s:8:\"subtitle\";s:40:\"Order any service, anytime from anywhere\";s:12:\"service_type\";s:19:\"سباكة Service2\";s:12:\"service_icon\";s:12:\"las la-broom\";s:5:\"image\";s:3:\"627\";s:17:\"country_show_hide\";s:2:\"on\";s:14:\"city_show_hide\";s:2:\"on\";s:14:\"area_show_hide\";s:2:\"on\";s:18:\"review_banner_area\";s:2:\"on\";s:11:\"padding_top\";s:3:\"107\";s:14:\"padding_bottom\";s:3:\"111\";}', '2022-01-10 23:11:40', '2025-11-14 22:12:51'),
(139, 'BrowseCategoryOne', 'update', 'App\\PageBuilder\\Addons\\BrowseCategory\\BrowseCategoryOne', 'dynamic_page', 2, 22, 'dynamic_page', 'a:17:{s:2:\"id\";s:3:\"139\";s:10:\"addon_name\";s:17:\"BrowseCategoryOne\";s:15:\"addon_namespace\";s:76:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xCcm93c2VDYXRlZ29yeVxCcm93c2VDYXRlZ29yeU9uZQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"2\";s:13:\"addon_page_id\";s:2:\"22\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:30:\"Browse فئات الخدمات\";s:16:\"title_text_color\";s:15:\"rgb(51, 51, 51)\";s:8:\"subtitle\";s:124:\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"6\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";s:18:\"rgb(255, 255, 255)\";}', '2022-01-11 00:22:03', '2025-11-14 22:10:41'),
(147, 'FeatureService', 'update', 'App\\PageBuilder\\Addons\\FeatureService\\FeatureService', 'dynamic_page', 3, 22, 'dynamic_page', 'a:19:{s:2:\"id\";s:3:\"147\";s:10:\"addon_name\";s:14:\"FeatureService\";s:15:\"addon_namespace\";s:72:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xGZWF0dXJlU2VydmljZVxGZWF0dXJlU2VydmljZQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"3\";s:13:\"addon_page_id\";s:2:\"22\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:29:\"الخدمات المميزة\";s:16:\"title_text_color\";N;s:8:\"subtitle\";s:123:\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout\";s:5:\"items\";s:1:\"5\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";s:18:\"rgb(242, 247, 255)\";s:9:\"btn_color\";s:17:\"rgb(71, 201, 237)\";s:14:\"btn_text_color\";N;s:16:\"dot_color_slider\";s:12:\"dot-color-02\";s:16:\"book_appointment\";N;}', '2022-01-11 03:51:58', '2025-11-14 19:10:08'),
(148, 'PopularService', 'update', 'App\\PageBuilder\\Addons\\PopularService\\PopularService', 'dynamic_page', 5, 22, 'dynamic_page', 'a:21:{s:2:\"id\";s:3:\"148\";s:10:\"addon_name\";s:14:\"PopularService\";s:15:\"addon_namespace\";s:72:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xQb3B1bGFyU2VydmljZVxQb3B1bGFyU2VydmljZQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"5\";s:13:\"addon_page_id\";s:2:\"22\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:29:\"الخدمات الشائعة\";s:16:\"title_text_color\";N;s:8:\"subtitle\";s:124:\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.\";s:5:\"items\";s:1:\"6\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";s:18:\"rgb(255, 255, 255)\";s:9:\"btn_color\";s:17:\"rgb(70, 202, 235)\";s:14:\"btn_text_color\";N;s:17:\"explore_btn_color\";s:13:\"btn-outline-2\";s:11:\"hover_color\";s:8:\"style-02\";s:17:\"explore_more_link\";N;s:16:\"book_appointment\";s:17:\"احجز الآن\";}', '2022-01-11 04:06:23', '2025-11-14 19:10:08');
INSERT INTO `page_builders` (`id`, `addon_name`, `addon_type`, `addon_namespace`, `addon_location`, `addon_order`, `addon_page_id`, `addon_page_type`, `addon_settings`, `created_at`, `updated_at`) VALUES
(149, 'WhyOurMarketplace', 'update', 'App\\PageBuilder\\Addons\\WhyOurMarketplace\\WhyOurMarketplace', 'dynamic_page', 6, 22, 'dynamic_page', 'a:15:{s:2:\"id\";s:3:\"149\";s:10:\"addon_name\";s:17:\"WhyOurMarketplace\";s:15:\"addon_namespace\";s:80:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xXaHlPdXJNYXJrZXRwbGFjZVxXaHlPdXJNYXJrZXRwbGFjZQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"5\";s:13:\"addon_page_id\";s:2:\"22\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:29:\"لماذا صيانة تك؟?\";s:16:\"title_text_color\";N;s:8:\"subtitle\";s:132:\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. Service\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";s:18:\"rgb(242, 247, 255)\";s:28:\"contact_page_contact_info_01\";a:3:{s:5:\"icon_\";a:6:{i:0;s:12:\"las la-tools\";i:1;s:16:\"las la-users-cog\";i:2;s:17:\"las la-shield-alt\";i:3;s:16:\"las la-stopwatch\";i:4;s:26:\"las la-file-invoice-dollar\";i:5;s:14:\"las la-headset\";}s:6:\"title_\";a:6:{i:0;s:18:\"Service Commitment\";i:1;s:18:\"Service Commitment\";i:2;s:18:\"Service Commitment\";i:3;s:12:\"Fast Service\";i:4;s:12:\"Fast Service\";i:5;s:17:\"Dedicated Support\";}s:12:\"description_\";a:6:{i:0;s:124:\"It is a long established fact that a reader will be distracted by the readable. It is a long established fact that a reader.\";i:1;s:124:\"It is a long established fact that a reader will be distracted by the readable. It is a long established fact that a reader.\";i:2;s:124:\"It is a long established fact that a reader will be distracted by the readable. It is a long established fact that a reader.\";i:3;s:124:\"It is a long established fact that a reader will be distracted by the readable. It is a long established fact that a reader.\";i:4;s:124:\"It is a long established fact that a reader will be distracted by the readable. It is a long established fact that a reader.\";i:5;s:124:\"It is a long established fact that a reader will be distracted by the readable. It is a long established fact that a reader.\";}}}', '2022-01-11 04:39:34', '2025-11-14 22:10:41'),
(150, 'RecentBlog', 'update', 'App\\PageBuilder\\Addons\\Home\\RecentBlog', 'dynamic_page', 8, 22, 'dynamic_page', 'a:18:{s:2:\"id\";s:3:\"150\";s:10:\"addon_name\";s:10:\"RecentBlog\";s:15:\"addon_namespace\";s:52:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIb21lXFJlY2VudEJsb2c=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"8\";s:13:\"addon_page_id\";s:2:\"22\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:22:\"Recent Blog & Articles\";s:16:\"title_text_color\";N;s:8:\"subtitle\";s:124:\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"4\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";s:18:\"rgb(242, 247, 255)\";s:16:\"dot_color_slider\";s:12:\"dot-color-02\";}', '2022-01-11 04:56:46', '2022-10-28 23:30:41'),
(151, 'BecomeSeller', 'update', 'App\\PageBuilder\\Addons\\BecomeSeller\\BecomeSeller', 'dynamic_page', 7, 22, 'dynamic_page', 'a:19:{s:2:\"id\";s:3:\"151\";s:10:\"addon_name\";s:12:\"BecomeSeller\";s:15:\"addon_namespace\";s:64:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xCZWNvbWVTZWxsZXJcQmVjb21lU2VsbGVy\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"7\";s:13:\"addon_page_id\";s:2:\"22\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:11:\"كن فني\";s:16:\"title_text_color\";N;s:8:\"subtitle\";s:249:\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.\";s:10:\"section_bg\";N;s:9:\"btn_color\";s:17:\"rgb(71, 201, 237)\";s:8:\"btn_text\";s:14:\"Join as Seller\";s:8:\"btn_link\";N;s:12:\"seller_image\";s:2:\"29\";s:28:\"contact_page_contact_info_01\";a:1:{s:9:\"benifits_\";a:3:{i:0;s:79:\"It is a long established fact that a reader will be distracted by the readable.\";i:1;s:79:\"It is a long established fact that a reader will be distracted by the readable.\";i:2;s:79:\"It is a long established fact that a reader will be distracted by the readable.\";}}s:11:\"padding_top\";s:2:\"70\";s:14:\"padding_bottom\";s:3:\"100\";}', '2022-01-11 05:18:50', '2025-11-14 19:10:08'),
(155, 'HeaderStyleOne', 'update', 'App\\PageBuilder\\Addons\\Header\\HeaderStyleOne', 'dynamic_page', 1, 16, 'dynamic_page', 'a:16:{s:2:\"id\";s:3:\"155\";s:10:\"addon_name\";s:14:\"HeaderStyleOne\";s:15:\"addon_namespace\";s:60:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIZWFkZXJcSGVhZGVyU3R5bGVPbmU=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"16\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:35:\"ONE-STOP SOLUTION FOR YOUR SERVICES\";s:8:\"subtitle\";s:40:\"Order any service, anytime from anywhere\";s:16:\"background_image\";s:1:\"4\";s:17:\"country_show_hide\";s:2:\"on\";s:14:\"city_show_hide\";s:2:\"on\";s:14:\"area_show_hide\";s:2:\"on\";s:11:\"padding_top\";s:2:\"92\";s:14:\"padding_bottom\";s:2:\"87\";}', '2022-01-11 23:51:52', '2023-07-24 01:36:08'),
(158, 'HeaderStyleThree', 'update', 'App\\PageBuilder\\Addons\\Header\\HeaderStyleThree', 'dynamic_page', 1, 38, 'dynamic_page', 'a:23:{s:2:\"id\";s:3:\"158\";s:10:\"addon_name\";s:16:\"HeaderStyleThree\";s:15:\"addon_namespace\";s:64:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIZWFkZXJcSGVhZGVyU3R5bGVUaHJlZQ==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"38\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:35:\"One-stop Solution for your Services\";s:8:\"subtitle\";s:40:\"Order any service, anytime from anywhere\";s:12:\"service_type\";s:15:\"Clening Service\";s:12:\"service_icon\";s:12:\"las la-broom\";s:12:\"service_link\";s:1:\"#\";s:9:\"dot_image\";s:3:\"624\";s:12:\"banner_image\";s:3:\"629\";s:5:\"image\";s:3:\"628\";s:17:\"country_show_hide\";s:2:\"on\";s:14:\"city_show_hide\";s:2:\"on\";s:14:\"area_show_hide\";s:2:\"on\";s:18:\"client_banner_area\";s:2:\"on\";s:18:\"review_banner_area\";s:2:\"on\";s:11:\"padding_top\";s:3:\"106\";s:14:\"padding_bottom\";s:3:\"100\";}', '2022-01-12 00:22:33', '2023-07-28 03:46:17'),
(159, 'BrowseCategoryTwo', 'update', 'App\\PageBuilder\\Addons\\BrowseCategory\\BrowseCategoryTwo', 'dynamic_page', 2, 38, 'dynamic_page', 'a:17:{s:2:\"id\";s:3:\"159\";s:10:\"addon_name\";s:17:\"BrowseCategoryTwo\";s:15:\"addon_namespace\";s:76:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xCcm93c2VDYXRlZ29yeVxCcm93c2VDYXRlZ29yeVR3bw==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"2\";s:13:\"addon_page_id\";s:2:\"38\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:15:\"Browse Category\";s:11:\"explore_all\";s:11:\"Explore All\";s:12:\"explore_link\";s:46:\"https://bytesed.com/laravel/qixer/category/all\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"6\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:2:\"50\";s:10:\"section_bg\";N;}', '2022-01-12 03:40:35', '2023-07-29 02:20:28'),
(160, 'FeatureServiceTwo', 'update', 'App\\PageBuilder\\Addons\\FeatureService\\FeatureServiceTwo', 'dynamic_page', 3, 38, 'dynamic_page', 'a:17:{s:2:\"id\";s:3:\"160\";s:10:\"addon_name\";s:17:\"FeatureServiceTwo\";s:15:\"addon_namespace\";s:76:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xGZWF0dXJlU2VydmljZVxGZWF0dXJlU2VydmljZVR3bw==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"3\";s:13:\"addon_page_id\";s:2:\"38\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:29:\"الخدمات المميزة\";s:11:\"explore_all\";s:11:\"Explore All\";s:12:\"explore_link\";N;s:5:\"items\";s:1:\"4\";s:11:\"padding_top\";s:2:\"50\";s:14:\"padding_bottom\";s:2:\"95\";s:10:\"section_bg\";N;s:9:\"btn_color\";N;s:16:\"book_appointment\";s:17:\"احجز الآن\";}', '2022-01-12 04:25:22', '2025-11-14 19:10:08'),
(162, 'WhyOurMarketplaceTwo', 'update', 'App\\PageBuilder\\Addons\\WhyOurMarketplace\\WhyOurMarketplaceTwo', 'dynamic_page', 5, 38, 'dynamic_page', 'a:18:{s:2:\"id\";s:3:\"162\";s:10:\"addon_name\";s:20:\"WhyOurMarketplaceTwo\";s:15:\"addon_namespace\";s:84:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xXaHlPdXJNYXJrZXRwbGFjZVxXaHlPdXJNYXJrZXRwbGFjZVR3bw==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"5\";s:13:\"addon_page_id\";s:2:\"38\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:31:\"Why you ChooseThis Marketplace?\";s:8:\"subtitle\";s:298:\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc in rutrum odio, a blandit leo. Mauris placerat vulputate lacus eu eleifend. Donec euismod, metus id consequat egestas, tellus dui fermentum est, id porttitor tellus tortor in tellus. Maecenas non facilisis tortor. Duis et euismod augue.\";s:16:\"background_image\";s:2:\"53\";s:11:\"padding_top\";s:2:\"99\";s:14:\"padding_bottom\";s:2:\"50\";s:10:\"section_bg\";N;s:9:\"btn_color\";N;s:8:\"btn_text\";s:15:\"Join as  Seller\";s:8:\"btn_link\";N;s:28:\"contact_page_contact_info_01\";a:3:{s:6:\"image_\";a:4:{i:0;s:2:\"49\";i:1;s:2:\"50\";i:2;s:2:\"51\";i:3;s:2:\"52\";}s:6:\"title_\";a:4:{i:0;s:18:\"Service Commitment\";i:1;s:16:\"Super Experience\";i:2;s:21:\"Secure Data & Payment\";i:3;s:17:\"Dedecated Support\";}s:12:\"description_\";a:4:{i:0;s:124:\"It is a long established fact that a reader will be distracted by the readable. It is a long established fact that a reader.\";i:1;s:124:\"It is a long established fact that a reader will be distracted by the readable. It is a long established fact that a reader.\";i:2;s:124:\"It is a long established fact that a reader will be distracted by the readable. It is a long established fact that a reader.\";i:3;s:124:\"It is a long established fact that a reader will be distracted by the readable. It is a long established fact that a reader.\";}}}', '2022-01-12 05:56:37', '2022-10-28 12:09:38'),
(163, 'PopularServiceTwo', 'update', 'App\\PageBuilder\\Addons\\PopularService\\PopularServiceTwo', 'dynamic_page', 6, 38, 'dynamic_page', 'a:15:{s:2:\"id\";s:3:\"163\";s:10:\"addon_name\";s:17:\"PopularServiceTwo\";s:15:\"addon_namespace\";s:76:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xQb3B1bGFyU2VydmljZVxQb3B1bGFyU2VydmljZVR3bw==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"5\";s:13:\"addon_page_id\";s:2:\"38\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:29:\"الخدمات الشائعة\";s:11:\"explore_all\";s:11:\"Explore All\";s:12:\"explore_link\";N;s:5:\"items\";s:1:\"4\";s:11:\"padding_top\";s:2:\"50\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";N;}', '2022-01-12 06:20:00', '2025-11-14 19:10:08'),
(164, 'BecomeSellerTwo', 'update', 'App\\PageBuilder\\Addons\\BecomeSeller\\BecomeSellerTwo', 'dynamic_page', 9, 38, 'dynamic_page', 'a:20:{s:2:\"id\";s:3:\"164\";s:10:\"addon_name\";s:15:\"BecomeSellerTwo\";s:15:\"addon_namespace\";s:68:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xCZWNvbWVTZWxsZXJcQmVjb21lU2VsbGVyVHdv\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"6\";s:13:\"addon_page_id\";s:2:\"38\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:58:\"Join with us to Sale your service & growth your Experience\";s:8:\"subtitle\";s:40:\"Order any service, anytime from anywhere\";s:9:\"btn_color\";s:17:\"rgb(255, 107, 43)\";s:8:\"btn_text\";s:11:\"كن فني\";s:8:\"btn_link\";N;s:8:\"circle_1\";s:3:\"115\";s:8:\"circle_2\";s:3:\"116\";s:10:\"dot_square\";s:3:\"117\";s:10:\"line_cross\";s:3:\"118\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";N;}', '2022-01-12 07:24:18', '2025-11-14 19:10:08'),
(165, 'RecentBlogTwo', 'update', 'App\\PageBuilder\\Addons\\Home\\RecentBlogTwo', 'dynamic_page', 10, 38, 'dynamic_page', 'a:17:{s:2:\"id\";s:3:\"165\";s:10:\"addon_name\";s:13:\"RecentBlogTwo\";s:15:\"addon_namespace\";s:56:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIb21lXFJlY2VudEJsb2dUd28=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"7\";s:13:\"addon_page_id\";s:2:\"38\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:15:\"Blog & Articles\";s:11:\"explore_all\";s:11:\"Explore All\";s:12:\"explore_link\";N;s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"4\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";N;}', '2022-01-12 08:11:41', '2022-11-01 01:48:56'),
(166, 'HeaderStyleFour', 'update', 'App\\PageBuilder\\Addons\\Header\\HeaderStyleFour', 'dynamic_page', 1, 39, 'dynamic_page', 'a:23:{s:2:\"id\";s:3:\"166\";s:10:\"addon_name\";s:15:\"HeaderStyleFour\";s:15:\"addon_namespace\";s:60:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIZWFkZXJcSGVhZGVyU3R5bGVGb3Vy\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"39\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:35:\"One-stop Solution for your Services\";s:8:\"subtitle\";s:40:\"Order any service, anytime from anywhere\";s:12:\"service_type\";s:18:\"سباكة Service\";s:12:\"service_icon\";s:12:\"las la-broom\";s:12:\"service_link\";N;s:9:\"dot_image\";s:3:\"624\";s:12:\"banner_image\";s:3:\"629\";s:5:\"image\";s:3:\"627\";s:17:\"country_show_hide\";s:2:\"on\";s:14:\"city_show_hide\";s:2:\"on\";s:14:\"area_show_hide\";s:2:\"on\";s:18:\"client_banner_area\";s:2:\"on\";s:18:\"review_banner_area\";s:2:\"on\";s:11:\"padding_top\";s:3:\"106\";s:14:\"padding_bottom\";s:2:\"99\";}', '2022-01-12 22:34:02', '2025-11-14 22:12:51'),
(167, 'BrowseCategoryTwo', 'update', 'App\\PageBuilder\\Addons\\BrowseCategory\\BrowseCategoryTwo', 'dynamic_page', 2, 39, 'dynamic_page', 'a:17:{s:2:\"id\";s:3:\"167\";s:10:\"addon_name\";s:17:\"BrowseCategoryTwo\";s:15:\"addon_namespace\";s:76:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xCcm93c2VDYXRlZ29yeVxCcm93c2VDYXRlZ29yeVR3bw==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"2\";s:13:\"addon_page_id\";s:2:\"39\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:15:\"Browse Category\";s:11:\"explore_all\";s:11:\"Explore All\";s:12:\"explore_link\";N;s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"6\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:2:\"50\";s:10:\"section_bg\";N;}', '2022-01-12 23:15:02', '2022-02-09 06:27:28'),
(168, 'FeatureServiceTwo', 'update', 'App\\PageBuilder\\Addons\\FeatureService\\FeatureServiceTwo', 'dynamic_page', 3, 39, 'dynamic_page', 'a:17:{s:2:\"id\";s:3:\"168\";s:10:\"addon_name\";s:17:\"FeatureServiceTwo\";s:15:\"addon_namespace\";s:76:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xGZWF0dXJlU2VydmljZVxGZWF0dXJlU2VydmljZVR3bw==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"3\";s:13:\"addon_page_id\";s:2:\"39\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:29:\"الخدمات المميزة\";s:11:\"explore_all\";s:11:\"Explore All\";s:12:\"explore_link\";N;s:5:\"items\";s:1:\"4\";s:11:\"padding_top\";s:2:\"50\";s:14:\"padding_bottom\";s:3:\"102\";s:10:\"section_bg\";N;s:9:\"btn_color\";N;s:16:\"book_appointment\";s:17:\"احجز الآن\";}', '2022-01-12 23:16:44', '2025-11-14 19:10:08'),
(169, 'BecomeSellerTwo', 'update', 'App\\PageBuilder\\Addons\\BecomeSeller\\BecomeSellerTwo', 'dynamic_page', 8, 39, 'dynamic_page', 'a:20:{s:2:\"id\";s:3:\"169\";s:10:\"addon_name\";s:15:\"BecomeSellerTwo\";s:15:\"addon_namespace\";s:68:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xCZWNvbWVTZWxsZXJcQmVjb21lU2VsbGVyVHdv\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"6\";s:13:\"addon_page_id\";s:2:\"39\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:58:\"Join with us to Sale your service & growth your Experience\";s:8:\"subtitle\";s:40:\"Order any service, anytime from anywhere\";s:9:\"btn_color\";N;s:8:\"btn_text\";s:11:\"كن فني\";s:8:\"btn_link\";N;s:8:\"circle_1\";s:3:\"115\";s:8:\"circle_2\";s:3:\"116\";s:10:\"dot_square\";s:3:\"117\";s:10:\"line_cross\";s:3:\"118\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";N;}', '2022-01-12 23:22:26', '2025-11-14 19:10:08'),
(170, 'WhyOurMarketplaceTwo', 'update', 'App\\PageBuilder\\Addons\\WhyOurMarketplace\\WhyOurMarketplaceTwo', 'dynamic_page', 5, 39, 'dynamic_page', 'a:18:{s:2:\"id\";s:3:\"170\";s:10:\"addon_name\";s:20:\"WhyOurMarketplaceTwo\";s:15:\"addon_namespace\";s:84:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xXaHlPdXJNYXJrZXRwbGFjZVxXaHlPdXJNYXJrZXRwbGFjZVR3bw==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"5\";s:13:\"addon_page_id\";s:2:\"39\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:31:\"Why you ChooseThis Marketplace?\";s:8:\"subtitle\";s:298:\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc in rutrum odio, a blandit leo. Mauris placerat vulputate lacus eu eleifend. Donec euismod, metus id consequat egestas, tellus dui fermentum est, id porttitor tellus tortor in tellus. Maecenas non facilisis tortor. Duis et euismod augue.\";s:16:\"background_image\";s:2:\"53\";s:11:\"padding_top\";s:3:\"101\";s:14:\"padding_bottom\";s:2:\"50\";s:10:\"section_bg\";N;s:9:\"btn_color\";N;s:8:\"btn_text\";s:11:\"كن فني\";s:8:\"btn_link\";N;s:28:\"contact_page_contact_info_01\";a:3:{s:6:\"image_\";a:4:{i:0;s:2:\"49\";i:1;s:2:\"50\";i:2;s:2:\"51\";i:3;s:2:\"52\";}s:6:\"title_\";a:4:{i:0;s:18:\"Service Commitment\";i:1;s:16:\"Super Experience\";i:2;s:21:\"Secure Data & Payment\";i:3;s:17:\"Dedecated Support\";}s:12:\"description_\";a:4:{i:0;s:124:\"It is a long established fact that a reader will be distracted by the readable. It is a long established fact that a reader.\";i:1;s:124:\"It is a long established fact that a reader will be distracted by the readable. It is a long established fact that a reader.\";i:2;s:124:\"It is a long established fact that a reader will be distracted by the readable. It is a long established fact that a reader.\";i:3;s:124:\"It is a long established fact that a reader will be distracted by the readable. It is a long established fact that a reader.\";}}}', '2022-01-12 23:30:15', '2025-11-14 19:10:08'),
(171, 'PopularServiceTwo', 'update', 'App\\PageBuilder\\Addons\\PopularService\\PopularServiceTwo', 'dynamic_page', 6, 39, 'dynamic_page', 'a:15:{s:2:\"id\";s:3:\"171\";s:10:\"addon_name\";s:17:\"PopularServiceTwo\";s:15:\"addon_namespace\";s:76:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xQb3B1bGFyU2VydmljZVxQb3B1bGFyU2VydmljZVR3bw==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"5\";s:13:\"addon_page_id\";s:2:\"39\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:29:\"الخدمات الشائعة\";s:11:\"explore_all\";s:11:\"Explore All\";s:12:\"explore_link\";N;s:5:\"items\";s:1:\"4\";s:11:\"padding_top\";s:2:\"50\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";N;}', '2022-01-12 23:34:38', '2025-11-14 19:10:08'),
(172, 'RecentBlogTwo', 'update', 'App\\PageBuilder\\Addons\\Home\\RecentBlogTwo', 'dynamic_page', 9, 39, 'dynamic_page', 'a:17:{s:2:\"id\";s:3:\"172\";s:10:\"addon_name\";s:13:\"RecentBlogTwo\";s:15:\"addon_namespace\";s:56:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIb21lXFJlY2VudEJsb2dUd28=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"7\";s:13:\"addon_page_id\";s:2:\"39\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:15:\"Blog & Articles\";s:11:\"explore_all\";s:11:\"Explore All\";s:12:\"explore_link\";N;s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"4\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";N;}', '2022-01-12 23:36:46', '2022-10-28 23:22:32'),
(174, 'Faq', 'update', 'App\\PageBuilder\\Addons\\Faq\\Faq', 'dynamic_page', 1, 40, 'dynamic_page', 'a:12:{s:2:\"id\";s:3:\"174\";s:10:\"addon_name\";s:3:\"Faq\";s:15:\"addon_namespace\";s:40:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xGYXFcRmFx\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"40\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:11:\"padding_top\";s:2:\"70\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";N;s:28:\"contact_page_contact_info_01\";a:2:{s:6:\"title_\";a:4:{i:0;s:53:\"Why is this such an important problem for you to fix?\";i:1;s:32:\"What’s your very first memory?\";i:2;s:34:\"Why do you need this solution now?\";i:3;s:44:\"What are the main features that interest you\";}s:12:\"description_\";a:4:{i:0;s:216:\"Sportsman delighted improving dashwoods gay instantly happiness six. Ham now amounted absolute not mistaken way pleasant whatever. At an these still no dried folly stood thing. Rapid it on hours hills it seven years.\";i:1;s:216:\"Sportsman delighted improving dashwoods gay instantly happiness six. Ham now amounted absolute not mistaken way pleasant whatever. At an these still no dried folly stood thing. Rapid it on hours hills it seven years.\";i:2;s:216:\"Sportsman delighted improving dashwoods gay instantly happiness six. Ham now amounted absolute not mistaken way pleasant whatever. At an these still no dried folly stood thing. Rapid it on hours hills it seven years.\";i:3;s:216:\"Sportsman delighted improving dashwoods gay instantly happiness six. Ham now amounted absolute not mistaken way pleasant whatever. At an these still no dried folly stood thing. Rapid it on hours hills it seven years.\";}}}', '2022-01-13 07:23:00', '2022-02-02 05:52:37'),
(175, 'OnlineService', 'update', 'App\\PageBuilder\\Addons\\OnlineService\\OnlineService', 'dynamic_page', 5, 16, 'dynamic_page', 'a:19:{s:2:\"id\";s:3:\"175\";s:10:\"addon_name\";s:13:\"OnlineService\";s:15:\"addon_namespace\";s:68:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xPbmxpbmVTZXJ2aWNlXE9ubGluZVNlcnZpY2U=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"5\";s:13:\"addon_page_id\";s:2:\"16\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:14:\"Online Service\";s:16:\"title_text_color\";s:17:\"rgb(29, 191, 115)\";s:8:\"subtitle\";s:105:\"Get online services at أسعار مناسبة and take the best chance to grow your business and pthers.\";s:5:\"items\";s:1:\"6\";s:11:\"padding_top\";s:3:\"101\";s:14:\"padding_bottom\";s:2:\"97\";s:10:\"section_bg\";N;s:9:\"btn_color\";s:17:\"rgb(29, 191, 115)\";s:14:\"btn_text_color\";N;s:16:\"dot_color_slider\";s:12:\"dot-color-01\";s:16:\"book_appointment\";s:16:\"Book Appointment\";}', '2022-04-28 09:08:53', '2025-11-14 22:10:41'),
(176, 'OnlineService', 'update', 'App\\PageBuilder\\Addons\\OnlineService\\OnlineService', 'dynamic_page', 9, 22, 'dynamic_page', 'a:19:{s:2:\"id\";s:3:\"176\";s:10:\"addon_name\";s:13:\"OnlineService\";s:15:\"addon_namespace\";s:68:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xPbmxpbmVTZXJ2aWNlXE9ubGluZVNlcnZpY2U=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"9\";s:13:\"addon_page_id\";s:2:\"22\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:14:\"Online Service\";s:16:\"title_text_color\";N;s:8:\"subtitle\";s:68:\"Get Our online services now at أسعار مناسبة and benifits.\";s:5:\"items\";s:1:\"3\";s:11:\"padding_top\";s:2:\"66\";s:14:\"padding_bottom\";s:2:\"61\";s:10:\"section_bg\";N;s:9:\"btn_color\";s:17:\"rgb(70, 202, 235)\";s:14:\"btn_text_color\";N;s:16:\"dot_color_slider\";s:12:\"dot-color-01\";s:16:\"book_appointment\";s:16:\"Book Appointment\";}', '2022-04-28 03:29:26', '2025-11-14 22:10:41'),
(177, 'OnlineServiceTwo', 'update', 'App\\PageBuilder\\Addons\\OnlineService\\OnlineServiceTwo', 'dynamic_page', 7, 38, 'dynamic_page', 'a:14:{s:2:\"id\";s:3:\"177\";s:10:\"addon_name\";s:16:\"OnlineServiceTwo\";s:15:\"addon_namespace\";s:72:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xPbmxpbmVTZXJ2aWNlXE9ubGluZVNlcnZpY2VUd28=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"6\";s:13:\"addon_page_id\";s:2:\"38\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:14:\"Online Service\";s:5:\"items\";s:1:\"4\";s:11:\"padding_top\";s:2:\"95\";s:14:\"padding_bottom\";s:2:\"91\";s:10:\"section_bg\";N;s:16:\"book_appointment\";s:17:\"احجز الآن\";}', '2022-04-28 03:40:59', '2025-11-14 19:10:08'),
(178, 'OnlineServiceTwo', 'update', 'App\\PageBuilder\\Addons\\OnlineService\\OnlineServiceTwo', 'dynamic_page', 7, 39, 'dynamic_page', 'a:14:{s:2:\"id\";s:3:\"178\";s:10:\"addon_name\";s:16:\"OnlineServiceTwo\";s:15:\"addon_namespace\";s:72:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xPbmxpbmVTZXJ2aWNlXE9ubGluZVNlcnZpY2VUd28=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"6\";s:13:\"addon_page_id\";s:2:\"39\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:14:\"Online Service\";s:5:\"items\";s:1:\"4\";s:11:\"padding_top\";s:2:\"93\";s:14:\"padding_bottom\";s:2:\"88\";s:10:\"section_bg\";N;s:16:\"book_appointment\";s:17:\"احجز الآن\";}', '2022-04-28 03:49:25', '2025-11-14 19:10:08'),
(180, 'PricePlan', 'update', 'Modules\\Subscription\\PageBuilder\\Addons\\PricePlan', 'dynamic_page', 1, 44, 'dynamic_page', 'a:13:{s:2:\"id\";s:3:\"180\";s:10:\"addon_name\";s:9:\"PricePlan\";s:15:\"addon_namespace\";s:68:\"TW9kdWxlc1xTdWJzY3JpcHRpb25cUGFnZUJ1aWxkZXJcQWRkb25zXFByaWNlUGxhbg==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"44\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:10:\"Price Plan\";s:16:\"title_text_color\";s:17:\"rgb(29, 191, 115)\";s:8:\"subtitle\";s:94:\"Here are our plans. Choose the plan which is more suitable for you from our plans collections.\";s:11:\"padding_top\";s:3:\"158\";s:14:\"padding_bottom\";s:3:\"151\";}', '2022-09-03 05:06:59', '2022-09-03 05:17:51'),
(183, 'Jobs', 'update', 'Modules\\JobPost\\PageBuilder\\Addons\\Jobs', 'dynamic_page', 1, 45, 'dynamic_page', 'a:31:{s:2:\"id\";s:3:\"183\";s:10:\"addon_name\";s:4:\"Jobs\";s:15:\"addon_namespace\";s:52:\"TW9kdWxlc1xKb2JQb3N0XFBhZ2VCdWlsZGVyXEFkZG9uc1xKb2Jz\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"45\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:4:\"desc\";s:5:\"items\";s:2:\"10\";s:7:\"columns\";s:8:\"col-lg-4\";s:11:\"padding_top\";s:2:\"82\";s:14:\"padding_bottom\";s:2:\"84\";s:16:\"stating_at_title\";N;s:8:\"category\";N;s:11:\"subcategory\";N;s:14:\"child_category\";N;s:8:\"book_now\";N;s:9:\"read_more\";N;s:7:\"country\";N;s:4:\"city\";N;s:18:\"job_search_by_text\";N;s:14:\"country_on_off\";s:2:\"on\";s:11:\"city_on_off\";s:2:\"on\";s:25:\"job_search_by_text_on_off\";s:2:\"on\";s:15:\"category_on_off\";s:2:\"on\";s:18:\"subcategory_on_off\";s:2:\"on\";s:21:\"child_category_on_off\";s:2:\"on\";s:20:\"soft_by_price_on_off\";s:2:\"on\";s:17:\"best_match_on_off\";s:2:\"on\";}', '2022-10-11 23:46:57', '2023-11-23 07:13:51'),
(184, 'SellerProfile', 'update', 'App\\PageBuilder\\Addons\\SellerProfile\\SellerProfile', 'dynamic_page', 4, 38, 'dynamic_page', 'a:15:{s:2:\"id\";s:3:\"184\";s:10:\"addon_name\";s:13:\"SellerProfile\";s:15:\"addon_namespace\";s:68:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xTZWxsZXJQcm9maWxlXFNlbGxlclByb2ZpbGU=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"4\";s:13:\"addon_page_id\";s:2:\"38\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:30:\"Our Valuable Service Providers\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"4\";s:11:\"padding_top\";s:2:\"95\";s:14:\"padding_bottom\";s:2:\"72\";s:10:\"section_bg\";N;}', '2022-10-28 10:44:30', '2022-10-28 12:09:02'),
(185, 'SellerProfile', 'update', 'App\\PageBuilder\\Addons\\SellerProfile\\SellerProfile', 'dynamic_page', 4, 39, 'dynamic_page', 'a:15:{s:2:\"id\";s:3:\"185\";s:10:\"addon_name\";s:13:\"SellerProfile\";s:15:\"addon_namespace\";s:68:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xTZWxsZXJQcm9maWxlXFNlbGxlclByb2ZpbGU=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"4\";s:13:\"addon_page_id\";s:2:\"39\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:30:\"Our Valuable Service Providers\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"4\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";N;}', '2022-10-28 23:22:48', '2022-10-28 23:23:38'),
(186, 'SellerProfile', 'update', 'App\\PageBuilder\\Addons\\SellerProfile\\SellerProfile', 'dynamic_page', 4, 22, 'dynamic_page', 'a:15:{s:2:\"id\";s:3:\"186\";s:10:\"addon_name\";s:13:\"SellerProfile\";s:15:\"addon_namespace\";s:68:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xTZWxsZXJQcm9maWxlXFNlbGxlclByb2ZpbGU=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"4\";s:13:\"addon_page_id\";s:2:\"22\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:30:\"Our Valuable Service Providers\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"4\";s:11:\"padding_top\";s:1:\"2\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";N;}', '2022-10-28 23:30:53', '2022-10-28 23:31:14'),
(187, 'SellerProfile', 'new', 'App\\PageBuilder\\Addons\\SellerProfile\\SellerProfile', 'dynamic_page', 4, 16, 'dynamic_page', 'a:14:{s:10:\"addon_name\";s:13:\"SellerProfile\";s:15:\"addon_namespace\";s:68:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xTZWxsZXJQcm9maWxlXFNlbGxlclByb2ZpbGU=\";s:10:\"addon_type\";s:3:\"new\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"4\";s:13:\"addon_page_id\";s:2:\"16\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:30:\"Our Valuable Service Providers\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"4\";s:11:\"padding_top\";s:3:\"100\";s:14:\"padding_bottom\";s:3:\"100\";s:10:\"section_bg\";N;}', '2022-10-28 23:33:15', '2022-10-28 23:33:15'),
(189, 'HomeJobs', 'update', 'Modules\\JobPost\\PageBuilder\\Addons\\HomeJobs', 'dynamic_page', 8, 38, 'dynamic_page', 'a:16:{s:2:\"id\";s:3:\"189\";s:10:\"addon_name\";s:8:\"HomeJobs\";s:15:\"addon_namespace\";s:60:\"TW9kdWxlc1xKb2JQb3N0XFBhZ2VCdWlsZGVyXEFkZG9uc1xIb21lSm9icw==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"8\";s:13:\"addon_page_id\";s:2:\"38\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";N;s:11:\"explore_all\";N;s:12:\"explore_link\";s:39:\"https://bytesed.com/laravel/qixer/jobs0\";s:5:\"items\";N;s:11:\"padding_top\";s:3:\"159\";s:14:\"padding_bottom\";s:3:\"156\";s:10:\"section_bg\";N;s:16:\"book_appointment\";s:17:\"احجز الآن\";}', '2022-11-01 02:31:22', '2025-11-14 19:10:08'),
(196, 'BrowseCategoryOne', 'new', 'App\\PageBuilder\\Addons\\BrowseCategory\\BrowseCategoryOne', 'dynamic_page', 1, 46, 'dynamic_page', 'a:17:{s:10:\"addon_name\";s:17:\"BrowseCategoryOne\";s:15:\"addon_namespace\";s:76:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xCcm93c2VDYXRlZ29yeVxCcm93c2VDYXRlZ29yeU9uZQ==\";s:10:\"addon_type\";s:3:\"new\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"46\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:3:\"Cat\";s:16:\"title_text_color\";N;s:8:\"subtitle\";s:7:\"cat all\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:4:\"desc\";s:5:\"items\";s:2:\"10\";s:24:\"empty_category_show_hide\";s:2:\"on\";s:11:\"padding_top\";s:3:\"213\";s:14:\"padding_bottom\";s:3:\"190\";s:10:\"section_bg\";N;}', '2023-06-21 07:35:00', '2023-06-21 07:35:00'),
(197, 'Faq', 'new', 'App\\PageBuilder\\Addons\\Faq\\Faq', 'dynamic_page', 2, 46, 'dynamic_page', 'a:11:{s:10:\"addon_name\";s:3:\"Faq\";s:15:\"addon_namespace\";s:40:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xGYXFcRmFx\";s:10:\"addon_type\";s:3:\"new\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"2\";s:13:\"addon_page_id\";s:2:\"46\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:11:\"padding_top\";s:3:\"260\";s:14:\"padding_bottom\";s:3:\"190\";s:10:\"section_bg\";N;s:28:\"contact_page_contact_info_01\";a:2:{s:6:\"title_\";a:2:{i:0;s:4:\"fsdf\";i:1;s:4:\"fsdf\";}s:12:\"description_\";a:2:{i:0;s:9:\"sdfsdfsdf\";i:1;s:9:\"sdfsdfsdf\";}}}', '2023-06-21 07:35:39', '2023-06-21 07:35:39'),
(199, 'OnlineServiceList', 'update', 'App\\PageBuilder\\Addons\\Service\\OnlineServiceList', 'dynamic_page', 1, 47, 'dynamic_page', 'a:30:{s:2:\"id\";s:3:\"199\";s:10:\"addon_name\";s:17:\"OnlineServiceList\";s:15:\"addon_namespace\";s:64:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xTZXJ2aWNlXE9ubGluZVNlcnZpY2VMaXN0\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"47\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:4:\"desc\";s:5:\"items\";s:2:\"10\";s:7:\"columns\";s:8:\"col-lg-3\";s:11:\"padding_top\";s:2:\"35\";s:14:\"padding_bottom\";s:2:\"39\";s:11:\"area_on_off\";s:2:\"on\";s:29:\"service_search_by_text_on_off\";s:2:\"on\";s:15:\"category_on_off\";s:2:\"on\";s:18:\"subcategory_on_off\";s:2:\"on\";s:21:\"child_category_on_off\";s:2:\"on\";s:13:\"rating_on_off\";s:2:\"on\";s:14:\"sort_by_on_off\";s:2:\"on\";s:7:\"country\";s:7:\"Country\";s:4:\"city\";s:4:\"City\";s:4:\"area\";s:4:\"Area\";s:22:\"service_search_by_text\";s:12:\"Search Title\";s:8:\"category\";s:8:\"Category\";s:11:\"subcategory\";s:11:\"Subcategory\";s:14:\"child_category\";s:14:\"Child Category\";s:8:\"book_now\";s:17:\"احجز الآن\";s:9:\"read_more\";s:12:\"View Details\";}', '2023-07-18 20:43:34', '2025-11-14 19:10:08'),
(200, 'HeaderStyleFive', 'update', 'App\\PageBuilder\\Addons\\Header\\HeaderStyleFive', 'dynamic_page', 1, 48, 'dynamic_page', 'a:26:{s:2:\"id\";s:3:\"200\";s:10:\"addon_name\";s:15:\"HeaderStyleFive\";s:15:\"addon_namespace\";s:60:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIZWFkZXJcSGVhZGVyU3R5bGVGaXZl\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"48\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:56:\"احصل على أي خدمة من قبل محترفين\";s:8:\"subtitle\";s:59:\"Order service you need, We have professionals ready to help\";s:24:\"satisfied_customer_title\";s:23:\"2k+ Satisficed Customer\";s:12:\"service_type\";s:14:\"5 Star Reviews\";s:12:\"service_icon\";s:11:\"las la-star\";s:12:\"banner_image\";s:3:\"659\";s:5:\"image\";s:3:\"658\";s:21:\"satisfied_customer_01\";a:1:{s:25:\"satisfied_customer_image_\";a:5:{i:0;s:3:\"656\";i:1;s:3:\"655\";i:2;s:3:\"654\";i:3;s:3:\"657\";i:4;s:3:\"652\";}}s:16:\"button_one_title\";s:15:\"طلب خدمة\";s:15:\"button_one_link\";s:38:\"https://bytesed.com/laravel/qixer/jobs\";s:16:\"button_two_title\";s:22:\"ابحث عن خدمة\";s:15:\"button_two_link\";s:46:\"https://bytesed.com/laravel/qixer/service-list\";s:20:\"button_one_show_hide\";s:2:\"on\";s:20:\"button_two_show_hide\";s:2:\"on\";s:28:\"satisfied_customer_show_hide\";s:2:\"on\";s:18:\"review_banner_area\";s:2:\"on\";s:11:\"padding_top\";s:3:\"177\";s:14:\"padding_bottom\";s:2:\"97\";}', '2023-07-27 07:53:05', '2025-11-14 19:10:08'),
(203, 'HomeJobsTwo', 'update', 'Modules\\JobPost\\PageBuilder\\Addons\\HomeJobsTwo', 'dynamic_page', 6, 48, 'dynamic_page', 'a:16:{s:2:\"id\";s:3:\"203\";s:10:\"addon_name\";s:11:\"HomeJobsTwo\";s:15:\"addon_namespace\";s:64:\"TW9kdWxlc1xKb2JQb3N0XFBhZ2VCdWlsZGVyXEFkZG9uc1xIb21lSm9ic1R3bw==\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"6\";s:13:\"addon_page_id\";s:2:\"48\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:8:\"New Jobs\";s:11:\"explore_all\";s:25:\"استكشف المزيد\";s:12:\"explore_link\";s:38:\"https://bytesed.com/laravel/qixer/jobs\";s:5:\"items\";s:1:\"4\";s:11:\"padding_top\";s:2:\"50\";s:14:\"padding_bottom\";s:2:\"50\";s:10:\"section_bg\";N;s:16:\"book_appointment\";s:9:\"Apply Now\";}', '2023-07-27 07:54:24', '2025-11-14 19:10:08'),
(204, 'PopularServiceThree', 'update', 'App\\PageBuilder\\Addons\\PopularService\\PopularServiceThree', 'dynamic_page', 2, 48, 'dynamic_page', 'a:18:{s:2:\"id\";s:3:\"204\";s:10:\"addon_name\";s:19:\"PopularServiceThree\";s:15:\"addon_namespace\";s:76:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xQb3B1bGFyU2VydmljZVxQb3B1bGFyU2VydmljZVRocmVl\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"5\";s:13:\"addon_page_id\";s:2:\"48\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:29:\"الخدمات الشائعة\";s:11:\"explore_all\";s:25:\"استكشف المزيد\";s:12:\"explore_link\";s:66:\"https://bytesed.com/laravel/qixer/service-list/popular-service/all\";s:5:\"items\";s:1:\"8\";s:11:\"padding_top\";s:2:\"50\";s:14:\"padding_bottom\";s:2:\"50\";s:10:\"section_bg\";N;s:9:\"btn_color\";N;s:17:\"button_text_color\";N;s:16:\"book_appointment\";s:17:\"احجز الآن\";}', '2023-07-27 07:54:38', '2025-11-16 07:32:39'),
(205, 'WhyOurMarketplaceThree', 'update', 'App\\PageBuilder\\Addons\\WhyOurMarketplace\\WhyOurMarketplaceThree', 'dynamic_page', 3, 48, 'dynamic_page', 'a:16:{s:2:\"id\";s:3:\"205\";s:10:\"addon_name\";s:22:\"WhyOurMarketplaceThree\";s:15:\"addon_namespace\";s:84:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xXaHlPdXJNYXJrZXRwbGFjZVxXaHlPdXJNYXJrZXRwbGFjZVRocmVl\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"3\";s:13:\"addon_page_id\";s:2:\"48\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:28:\"لماذا صيانة تك؟\";s:8:\"subtitle\";s:370:\"صيانة تك هي منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية. توفر المنصة حلولاً شاملة لربط العملاء بالفنيين المعتمدين مع تتبع مباشر للطلبات، أسعار شفافة، فواتير إلكترونية، وضمانات رقمية.\";s:11:\"padding_top\";s:2:\"50\";s:14:\"padding_bottom\";s:2:\"50\";s:10:\"section_bg\";N;s:17:\"customer_btn_text\";s:19:\"انضم كعميل\";s:17:\"customer_btn_link\";s:34:\"http://localhost/SyanTeck/register\";s:28:\"contact_page_contact_info_01\";a:3:{s:6:\"image_\";a:3:{i:0;s:3:\"647\";i:1;s:3:\"646\";i:2;s:3:\"660\";}s:6:\"title_\";a:3:{i:0;s:4:\"5/ 5\";i:1;s:6:\"دعم\";i:2;s:6:\"آمن\";}s:12:\"description_\";a:3:{i:0;s:72:\"أحب الناس الخدمات المقدمة من قبل فنيينا\";i:1;s:81:\"لدينا فريق دعم مخصص لمساعدتك على مدار الساعة\";i:2;s:81:\"لدينا فريق دعم مخصص لمساعدتك على مدار الساعة\";}}}', '2023-07-27 07:54:52', '2025-11-16 11:20:49'),
(206, 'BannerOne', 'update', 'App\\PageBuilder\\Addons\\Banner\\BannerOne', 'dynamic_page', 4, 48, 'dynamic_page', 'a:23:{s:2:\"id\";s:3:\"206\";s:10:\"addon_name\";s:9:\"BannerOne\";s:15:\"addon_namespace\";s:52:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xCYW5uZXJcQmFubmVyT25l\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"7\";s:13:\"addon_page_id\";s:2:\"48\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:78:\"احصل على تطبيقنا المحمول للطلب بسهولة أكبر\";s:16:\"title_text_color\";N;s:10:\"section_bg\";N;s:9:\"btn_color\";N;s:12:\"bg_image_one\";s:3:\"650\";s:12:\"bg_image_two\";s:3:\"651\";s:13:\"app_image_one\";s:3:\"649\";s:13:\"app_image_two\";s:3:\"648\";s:19:\"app_button_link_one\";s:1:\"#\";s:19:\"app_button_link_two\";s:1:\"#\";s:28:\"contact_page_contact_info_01\";a:1:{s:9:\"benifits_\";a:3:{i:0;s:25:\"فنيون محترفون\";i:1;s:11:\"دعم 24/7\";i:2;s:55:\"استرداد متاح في حالة عدم الرضا\";}}s:22:\"content_list_show_hide\";s:2:\"on\";s:11:\"padding_top\";s:2:\"50\";s:14:\"padding_bottom\";s:2:\"50\";s:17:\"section_show_hide\";s:0:\"\";}', '2023-07-27 07:55:09', '2025-11-16 07:32:39'),
(210, 'BecomeSellerThree', 'update', 'App\\PageBuilder\\Addons\\BecomeSeller\\BecomeSellerThree', 'dynamic_page', 5, 48, 'dynamic_page', 'a:19:{s:2:\"id\";s:3:\"210\";s:10:\"addon_name\";s:17:\"BecomeSellerThree\";s:15:\"addon_namespace\";s:72:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xCZWNvbWVTZWxsZXJcQmVjb21lU2VsbGVyVGhyZWU=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"5\";s:13:\"addon_page_id\";s:2:\"48\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:74:\"انضم إلينا كمقدم خدمة واكسب راتباً جيداً\";s:16:\"title_text_color\";N;s:10:\"section_bg\";N;s:9:\"btn_color\";N;s:8:\"btn_text\";s:17:\"انضم كفني\";s:8:\"btn_link\";s:42:\"https://bytesed.com/laravel/qixer/register\";s:12:\"seller_image\";s:3:\"653\";s:28:\"contact_page_contact_info_01\";a:1:{s:9:\"benifits_\";a:3:{i:0;s:39:\"احصل على أعمال منتظمة\";i:1;s:11:\"دعم 24/7\";i:2;s:10:\"تأمين\";}}s:22:\"content_list_show_hide\";s:2:\"on\";s:11:\"padding_top\";s:2:\"50\";s:14:\"padding_bottom\";s:2:\"50\";}', '2023-07-27 08:17:59', '2025-11-16 11:21:37'),
(212, 'HeaderStyleOne', 'update', 'App\\PageBuilder\\Addons\\Header\\HeaderStyleOne', 'dynamic_page', 1, 48, 'dynamic_page', 'a:23:{s:2:\"id\";s:3:\"212\";s:10:\"addon_name\";s:14:\"HeaderStyleOne\";s:15:\"addon_namespace\";s:60:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xIZWFkZXJcSGVhZGVyU3R5bGVPbmU=\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"48\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:5:\"title\";s:56:\"احصل على أي خدمة من قبل محترفين\";s:8:\"subtitle\";s:109:\"اطلب الخدمة التي تحتاجها. لدينا فنيون معتمدون جاهزون لخدمتك\";s:24:\"satisfied_customer_title\";s:36:\"أكثر من 2000 عميل راضٍ\";s:12:\"service_type\";s:25:\"تقييمات 5 نجوم\";s:12:\"service_icon\";s:11:\"las la-star\";s:23:\"header_background_color\";N;s:12:\"banner_image\";s:3:\"903\";s:5:\"image\";s:3:\"904\";s:16:\"button_one_title\";s:15:\"طلب خدمة\";s:15:\"button_one_link\";s:3:\"/qr\";s:16:\"button_two_title\";s:22:\"ابحث عن خدمة\";s:15:\"button_two_link\";s:46:\"https://bytesed.com/laravel/qixer/service-list\";s:20:\"button_one_show_hide\";s:2:\"on\";s:11:\"padding_top\";s:3:\"199\";s:14:\"padding_bottom\";s:3:\"190\";}', '2023-11-23 06:51:10', '2025-11-16 07:35:44'),
(213, 'ServiceListOne', 'update', 'App\\PageBuilder\\Addons\\Service\\ServiceListOne', 'dynamic_page', 1, 32, 'dynamic_page', 'a:34:{s:2:\"id\";s:3:\"213\";s:10:\"addon_name\";s:14:\"ServiceListOne\";s:15:\"addon_namespace\";s:60:\"QXBwXFBhZ2VCdWlsZGVyXEFkZG9uc1xTZXJ2aWNlXFNlcnZpY2VMaXN0T25l\";s:10:\"addon_type\";s:6:\"update\";s:14:\"addon_location\";s:12:\"dynamic_page\";s:11:\"addon_order\";s:1:\"1\";s:13:\"addon_page_id\";s:2:\"32\";s:15:\"addon_page_type\";s:12:\"dynamic_page\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:2:\"10\";s:7:\"columns\";s:8:\"col-lg-3\";s:11:\"padding_top\";s:2:\"72\";s:14:\"padding_bottom\";s:2:\"71\";s:15:\"location_on_off\";s:2:\"on\";s:18:\"price_range_on_off\";s:2:\"on\";s:14:\"country_on_off\";s:2:\"on\";s:11:\"city_on_off\";s:2:\"on\";s:11:\"area_on_off\";s:2:\"on\";s:29:\"service_search_by_text_on_off\";s:2:\"on\";s:15:\"category_on_off\";s:2:\"on\";s:18:\"subcategory_on_off\";s:2:\"on\";s:21:\"child_category_on_off\";s:2:\"on\";s:13:\"rating_on_off\";s:2:\"on\";s:14:\"sort_by_on_off\";s:2:\"on\";s:7:\"country\";N;s:4:\"city\";N;s:4:\"area\";N;s:22:\"service_search_by_text\";N;s:8:\"category\";N;s:11:\"subcategory\";N;s:14:\"child_category\";N;s:8:\"book_now\";N;s:9:\"read_more\";N;}', '2023-11-23 06:58:34', '2023-11-23 06:59:24'),
(214, 'Vision2030', 'new', 'App\\PageBuilder\\Addons\\Vision2030\\Vision2030', 'dynamic_page', 7, 48, 'dynamic_page', 'a:5:{s:5:\"title\";s:68:\"دعم التحول الرقمي ضمن رؤية المملكة 2030\";s:8:\"subtitle\";s:213:\"نساهم في تحقيق أهداف رؤية المملكة 2030 من خلال تقديم حلول رقمية متطورة وخدمات صيانة ذكية تساهم في بناء مجتمع رقمي متقدم\";s:11:\"padding_top\";i:80;s:14:\"padding_bottom\";i:80;s:10:\"section_bg\";s:7:\"#006633\";}', '2025-12-15 12:37:07', '2025-12-15 12:37:07'),
(215, 'Vision2030', 'new', 'App\\PageBuilder\\Addons\\Vision2030\\Vision2030', 'dynamic_page', 2, 31, 'dynamic_page', 'a:5:{s:5:\"title\";s:68:\"دعم التحول الرقمي ضمن رؤية المملكة 2030\";s:8:\"subtitle\";s:213:\"نساهم في تحقيق أهداف رؤية المملكة 2030 من خلال تقديم حلول رقمية متطورة وخدمات صيانة ذكية تساهم في بناء مجتمع رقمي متقدم\";s:11:\"padding_top\";i:80;s:14:\"padding_bottom\";i:80;s:10:\"section_bg\";s:7:\"#006633\";}', '2025-12-15 12:37:07', '2025-12-15 12:37:07');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payout_requests`
--

CREATE TABLE `payout_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `payment_gateway` varchar(191) DEFAULT NULL,
  `payment_receipt` varchar(191) DEFAULT NULL,
  `seller_note` text DEFAULT NULL,
  `admin_note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=pending 1=complete, 2=cancelled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'user-list', 'admin', '2021-09-01 22:54:39', '2021-09-01 22:54:39'),
(2, 'user-create', 'admin', '2021-09-01 22:54:39', '2021-09-01 22:54:39'),
(3, 'user-edit', 'admin', '2021-09-01 22:54:40', '2021-09-01 22:54:40'),
(4, 'user-delete', 'admin', '2021-09-01 22:54:40', '2021-09-01 22:54:40'),
(53, 'blog-list', 'admin', '2021-09-01 23:13:54', '2021-09-01 23:13:54'),
(54, 'blog-create', 'admin', '2021-09-01 23:13:54', '2021-09-01 23:13:54'),
(55, 'blog-edit', 'admin', '2021-09-01 23:13:54', '2021-09-01 23:13:54'),
(56, 'blog-delete', 'admin', '2021-09-01 23:13:54', '2021-09-01 23:13:54'),
(57, 'category-list', 'admin', '2021-09-01 23:13:54', '2021-09-01 23:13:54'),
(58, 'category-create', 'admin', '2021-09-01 23:13:54', '2021-09-01 23:13:54'),
(59, 'category-edit', 'admin', '2021-09-01 23:13:55', '2021-09-01 23:13:55'),
(60, 'category-delete', 'admin', '2021-09-01 23:13:55', '2021-09-01 23:13:55'),
(62, 'pages-list', 'admin', '2021-09-01 23:16:49', '2021-09-01 23:16:49'),
(63, 'pages-create', 'admin', '2021-09-01 23:16:49', '2021-09-01 23:16:49'),
(64, 'pages-edit', 'admin', '2021-09-01 23:16:50', '2021-09-01 23:16:50'),
(65, 'pages-delete', 'admin', '2021-09-01 23:16:50', '2021-09-01 23:16:50'),
(74, 'form-builder', 'admin', '2021-09-01 23:21:54', '2021-09-01 23:21:54'),
(81, 'appearance-topbar-settings', 'admin', '2021-09-01 23:25:07', '2021-09-01 23:25:07'),
(82, 'appearance-menubar-settings', 'admin', '2021-09-01 23:25:07', '2021-09-01 23:25:07'),
(83, 'appearance-media-image-manage', 'admin', '2021-09-01 23:25:07', '2021-09-01 23:25:07'),
(85, 'appearance-widget-builder', 'admin', '2021-09-01 23:25:07', '2021-09-01 23:25:07'),
(86, 'appearance-menu-list', 'admin', '2021-09-01 23:25:08', '2021-09-01 23:25:08'),
(87, 'appearance-menu-edit', 'admin', '2021-09-01 23:25:08', '2021-09-01 23:25:08'),
(88, 'appearance-menu-delete', 'admin', '2021-09-01 23:25:08', '2021-09-01 23:25:08'),
(97, 'general-settings-site-identity', 'admin', '2021-09-01 23:37:59', '2021-09-01 23:37:59'),
(98, 'general-settings-basic-settings', 'admin', '2021-09-01 23:37:59', '2021-09-01 23:37:59'),
(99, 'general-settings-color-settings', 'admin', '2021-09-01 23:37:59', '2021-09-01 23:37:59'),
(100, 'general-settings-typography-settings', 'admin', '2021-09-01 23:37:59', '2021-09-01 23:37:59'),
(101, 'general-settings-seo-settings', 'admin', '2021-09-01 23:37:59', '2021-09-01 23:37:59'),
(102, 'general-settings-third-party-scripts', 'admin', '2021-09-01 23:37:59', '2021-09-01 23:37:59'),
(103, 'general-settings-email-template', 'admin', '2021-09-01 23:37:59', '2021-09-01 23:37:59'),
(104, 'general-settings-email-settings', 'admin', '2021-09-01 23:37:59', '2021-09-01 23:37:59'),
(105, 'general-settings-smtp-settings', 'admin', '2021-09-01 23:37:59', '2021-09-01 23:37:59'),
(108, 'general-settings-custom-css', 'admin', '2021-09-01 23:37:59', '2021-09-01 23:37:59'),
(109, 'general-settings-custom-js', 'admin', '2021-09-01 23:37:59', '2021-09-01 23:37:59'),
(110, 'general-settings-licence-settings', 'admin', '2021-09-01 23:38:00', '2021-09-01 23:38:00'),
(111, 'general-settings-cache-settings', 'admin', '2021-09-01 23:38:00', '2021-09-01 23:38:00'),
(112, 'language-list', 'admin', '2021-09-01 23:38:01', '2021-09-01 23:38:01'),
(113, 'language-create', 'admin', '2021-09-01 23:38:01', '2021-09-01 23:38:01'),
(114, 'language-edit', 'admin', '2021-09-01 23:38:01', '2021-09-01 23:38:01'),
(115, 'language-delete', 'admin', '2021-09-01 23:38:01', '2021-09-01 23:38:01'),
(119, 'appearance-menu-create', 'admin', '2021-09-05 05:15:19', '2021-09-05 05:15:19'),
(120, 'blog-tag-list', 'admin', NULL, NULL),
(121, 'blog-tag-create', 'admin', '2021-10-28 04:14:02', '2021-10-28 04:14:02'),
(122, 'blog-tag-edit', 'admin', '2021-10-28 04:14:02', '2021-10-28 04:14:02'),
(123, 'blog-tag-delete', 'admin', '2021-10-28 04:14:02', '2021-10-28 04:14:02'),
(124, 'blog-trashed-list', 'admin', '2021-10-28 04:14:02', '2021-10-28 04:14:02'),
(125, 'blog-trashed-restore', 'admin', '2021-10-28 04:14:02', '2021-10-28 04:14:02'),
(126, 'blog-trashed-delete', 'admin', '2021-10-28 04:14:02', '2021-10-28 04:14:02'),
(150, 'general-settings-reading-settings', 'admin', '2021-10-28 04:14:04', '2021-10-28 04:14:04'),
(151, 'general-settings-global-navbar-settings', 'admin', '2021-10-28 04:14:04', '2021-10-28 04:14:04'),
(152, 'general-settings-global-footer-settings', 'admin', '2021-10-28 04:14:04', '2021-10-28 04:14:04'),
(184, 'category-status', 'admin', '2022-01-16 02:46:33', '2022-01-16 02:46:33'),
(185, 'subcategory-list', 'admin', '2022-01-16 02:46:33', '2022-01-16 02:46:33'),
(186, 'subcategory-create', 'admin', '2022-01-16 02:46:33', '2022-01-16 02:46:33'),
(187, 'subcategory-edit', 'admin', '2022-01-16 02:46:33', '2022-01-16 02:46:33'),
(188, 'subcategory-delete', 'admin', '2022-01-16 02:46:33', '2022-01-16 02:46:33'),
(189, 'subcategory-status', 'admin', '2022-01-16 02:46:33', '2022-01-16 02:46:33'),
(190, 'brand-list', 'admin', '2022-01-16 02:46:33', '2022-01-16 02:46:33'),
(191, 'brand-create', 'admin', '2022-01-16 02:46:34', '2022-01-16 02:46:34'),
(192, 'brand-edit', 'admin', '2022-01-16 02:46:34', '2022-01-16 02:46:34'),
(193, 'brand-delete', 'admin', '2022-01-16 02:46:34', '2022-01-16 02:46:34'),
(194, 'country-list', 'admin', '2022-01-16 02:46:34', '2022-01-16 02:46:34'),
(195, 'country-create', 'admin', '2022-01-16 02:46:34', '2022-01-16 02:46:34'),
(196, 'country-edit', 'admin', '2022-01-16 02:46:34', '2022-01-16 02:46:34'),
(197, 'country-delete', 'admin', '2022-01-16 02:46:34', '2022-01-16 02:46:34'),
(198, 'country-status', 'admin', '2022-01-16 02:46:34', '2022-01-16 02:46:34'),
(199, 'city-list', 'admin', '2022-01-16 02:46:34', '2022-01-16 02:46:34'),
(200, 'city-create', 'admin', '2022-01-16 02:46:34', '2022-01-16 02:46:34'),
(201, 'city-edit', 'admin', '2022-01-16 02:46:34', '2022-01-16 02:46:34'),
(202, 'city-delete', 'admin', '2022-01-16 02:46:34', '2022-01-16 02:46:34'),
(203, 'city-status', 'admin', '2022-01-16 02:46:34', '2022-01-16 02:46:34'),
(204, 'area-list', 'admin', '2022-01-16 02:46:34', '2022-01-16 02:46:34'),
(205, 'area-create', 'admin', '2022-01-16 02:46:34', '2022-01-16 02:46:34'),
(206, 'area-edit', 'admin', '2022-01-16 02:46:34', '2022-01-16 02:46:34'),
(207, 'area-delete', 'admin', '2022-01-16 02:46:35', '2022-01-16 02:46:35'),
(208, 'area-status', 'admin', '2022-01-16 02:46:35', '2022-01-16 02:46:35'),
(209, 'service-list', 'admin', '2022-01-16 02:46:35', '2022-01-16 02:46:35'),
(210, 'service-delete', 'admin', '2022-01-16 02:46:35', '2022-01-16 02:46:35'),
(211, 'service-status', 'admin', '2022-01-16 02:46:35', '2022-01-16 02:46:35'),
(212, 'service-view', 'admin', '2022-01-16 02:46:35', '2022-01-16 02:46:35'),
(213, 'order-list', 'admin', '2022-01-16 02:46:35', '2022-01-16 02:46:35'),
(214, 'order-delete', 'admin', '2022-01-16 02:46:35', '2022-01-16 02:46:35'),
(216, 'order-view', 'admin', '2022-01-16 02:46:35', '2022-01-16 02:46:35'),
(227, 'payout-list', 'admin', '2022-02-08 04:21:08', '2022-02-08 04:21:08'),
(228, 'payout-edit', 'admin', '2022-02-08 04:21:08', '2022-02-08 04:21:08'),
(229, 'admin-commission', 'admin', '2022-02-08 04:21:08', '2022-02-08 04:21:08'),
(230, 'amount-settings', 'admin', '2022-02-08 04:21:08', '2022-02-08 04:21:08'),
(232, 'payout-delete', 'admin', '2022-02-08 04:36:26', '2022-02-08 04:36:26'),
(233, 'payout-view', 'admin', '2022-02-08 04:36:26', '2022-02-08 04:36:26'),
(234, 'blog-detail-setting', 'admin', '2022-02-12 23:36:27', '2022-02-12 23:36:27'),
(235, 'service-book-setting', 'admin', '2022-02-12 23:36:27', '2022-02-12 23:36:27'),
(236, 'service-detail-setting', 'admin', '2022-02-12 23:36:27', '2022-02-12 23:36:27'),
(237, 'ticket-list', 'admin', '2022-04-23 03:33:03', '2022-04-23 03:33:03'),
(238, 'ticket-view', 'admin', '2022-04-23 03:33:03', '2022-04-23 03:33:03'),
(239, 'ticket-delete', 'admin', '2022-04-23 03:33:03', '2022-04-23 03:33:03'),
(240, 'slider-list', 'admin', '2022-04-23 03:33:03', '2022-04-23 03:33:03'),
(241, 'slider-edit', 'admin', '2022-04-23 03:33:04', '2022-04-23 03:33:04'),
(242, 'slider-delete', 'admin', '2022-04-23 03:33:04', '2022-04-23 03:33:04'),
(243, 'subscription-list', 'admin', '2022-09-06 01:42:40', '2022-09-06 01:42:40'),
(244, 'seller-subscription-list', 'admin', '2022-09-06 01:42:40', '2022-09-06 01:42:40'),
(245, 'subscription-coupon-list', 'admin', '2022-09-06 01:42:40', '2022-09-06 01:42:40'),
(246, 'subscription-reminder', 'admin', '2022-09-06 01:42:40', '2022-09-06 01:42:40'),
(247, 'job-list', 'admin', '2022-10-18 06:12:45', '2022-10-18 06:12:45'),
(248, 'job-status', 'admin', '2022-10-18 06:12:45', '2022-10-18 06:12:45'),
(249, 'job-delete', 'admin', '2022-10-18 06:12:45', '2022-10-18 06:12:45'),
(250, 'wallet-list', 'admin', '2022-11-09 05:23:22', '2022-11-09 05:23:22'),
(251, 'wallet-history', 'admin', '2022-11-09 05:23:22', '2022-11-09 05:23:22');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pricing_rules`
--

CREATE TABLE `pricing_rules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `type` varchar(191) NOT NULL COMMENT 'category, service, region, urgency',
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `region_id` bigint(20) UNSIGNED DEFAULT NULL,
  `urgency_level` varchar(191) DEFAULT NULL,
  `base_price` decimal(10,2) NOT NULL,
  `additional_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `fee_type` varchar(191) NOT NULL DEFAULT 'fixed' COMMENT 'fixed, percentage',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quality_followups`
--

CREATE TABLE `quality_followups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL COMMENT 'Quality agent ID',
  `rating` int(11) NOT NULL DEFAULT 0 COMMENT '1-5',
  `notes` text DEFAULT NULL,
  `client_feedback` text DEFAULT NULL,
  `technician_feedback` text DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'pending' COMMENT 'pending, completed, needs_improvement',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `name_ar` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `area_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `name_ar`, `description`, `city_id`, `area_id`, `is_active`, `created_at`, `updated_at`) VALUES
(109, 'الشرائع', 'الشرائع', 'منطقة الشرائع في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(110, 'الشرائع مخطط 1', 'الشرائع مخطط 1', 'منطقة الشرائع مخطط 1 في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(111, 'الشرائع مخطط 2', 'الشرائع مخطط 2', 'منطقة الشرائع مخطط 2 في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(112, 'الشرائع مخطط 3', 'الشرائع مخطط 3', 'منطقة الشرائع مخطط 3 في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(113, 'الشرائع مخطط 4', 'الشرائع مخطط 4', 'منطقة الشرائع مخطط 4 في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(114, 'الشرائع مخطط 5', 'الشرائع مخطط 5', 'منطقة الشرائع مخطط 5 في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(115, 'الشرائع مخطط 6', 'الشرائع مخطط 6', 'منطقة الشرائع مخطط 6 في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(116, 'الشرائع مخطط 7', 'الشرائع مخطط 7', 'منطقة الشرائع مخطط 7 في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(117, 'الشرائع مخطط 8', 'الشرائع مخطط 8', 'منطقة الشرائع مخطط 8 في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(118, 'الشرائع مخطط 9', 'الشرائع مخطط 9', 'منطقة الشرائع مخطط 9 في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(119, 'الشرائع مخطط 10', 'الشرائع مخطط 10', 'منطقة الشرائع مخطط 10 في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(120, 'الشرائع مخطط 11', 'الشرائع مخطط 11', 'منطقة الشرائع مخطط 11 في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(121, 'الراشدية', 'الراشدية', 'منطقة الراشدية في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(122, 'الريان', 'الريان', 'منطقة الريان في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(123, 'المنتزهات', 'المنتزهات', 'منطقة المنتزهات في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(124, 'العسيلة', 'العسيلة', 'منطقة العسيلة في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(125, 'الجمعة', 'الجمعة', 'منطقة الجمعة في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(126, 'التنعيم الشرقي', 'التنعيم الشرقي', 'منطقة التنعيم الشرقي في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(127, 'العزيزية الشمالية', 'العزيزية الشمالية', 'منطقة العزيزية الشمالية في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(128, 'الكعكية', 'الكعكية', 'منطقة الكعكية في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(129, 'الخالدية', 'الخالدية', 'منطقة الخالدية في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(130, 'حي النسيم', 'حي النسيم', 'منطقة حي النسيم في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(131, 'حي الشوقية الشمالية', 'حي الشوقية الشمالية', 'منطقة حي الشوقية الشمالية في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(132, 'حي العدل', 'حي العدل', 'منطقة حي العدل في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(133, 'المعابدة', 'المعابدة', 'منطقة المعابدة في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(134, 'جرول', 'جرول', 'منطقة جرول في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(135, 'الرصيفة', 'الرصيفة', 'منطقة الرصيفة في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(136, 'كدي', 'كدي', 'منطقة كدي في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(137, 'بطحاء قريش', 'بطحاء قريش', 'منطقة بطحاء قريش في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(138, 'الهجرة', 'الهجرة', 'منطقة الهجرة في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(139, 'الزهراء', 'الزهراء', 'منطقة الزهراء في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(140, 'حي النوارية الجنوبية', 'حي النوارية الجنوبية', 'منطقة حي النوارية الجنوبية في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(141, 'الحفاير', 'الحفاير', 'منطقة الحفاير في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(142, 'المسفلة', 'المسفلة', 'منطقة المسفلة في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(143, 'الهجلة', 'الهجلة', 'منطقة الهجلة في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:24', '2025-11-14 22:47:24'),
(144, 'أجياد', 'أجياد', 'منطقة أجياد في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:25', '2025-11-14 22:47:25'),
(145, 'القرارة', 'القرارة', 'منطقة القرارة في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:25', '2025-11-14 22:47:25'),
(146, 'جبل عمر', 'جبل عمر', 'منطقة جبل عمر في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:25', '2025-11-14 22:47:25'),
(147, 'الشامية', 'الشامية', 'منطقة الشامية في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:25', '2025-11-14 22:47:25'),
(148, 'الزاهر', 'الزاهر', 'منطقة الزاهر في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:25', '2025-11-14 22:47:25'),
(149, 'الزاهية', 'الزاهية', 'منطقة الزاهية في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:25', '2025-11-14 22:47:25'),
(150, 'الاسكان', 'الاسكان', 'منطقة الاسكان في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:25', '2025-11-14 22:47:25'),
(151, 'حي الشرائع الغربية', 'حي الشرائع الغربية', 'منطقة حي الشرائع الغربية في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:25', '2025-11-14 22:47:25'),
(152, 'حي التخصصي', 'حي التخصصي', 'منطقة حي التخصصي في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:25', '2025-11-14 22:47:25'),
(153, 'مخطط ولي العهد 1', 'مخطط ولي العهد 1', 'منطقة مخطط ولي العهد 1 في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:25', '2025-11-14 22:47:25'),
(154, 'مخطط ولي العهد 2', 'مخطط ولي العهد 2', 'منطقة مخطط ولي العهد 2 في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:25', '2025-11-14 22:47:25'),
(155, 'مخطط ولي العهد 3', 'مخطط ولي العهد 3', 'منطقة مخطط ولي العهد 3 في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:25', '2025-11-14 22:47:25'),
(156, 'مخطط ولي العهد 4', 'مخطط ولي العهد 4', 'منطقة مخطط ولي العهد 4 في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:25', '2025-11-14 22:47:25'),
(157, 'مخطط ولي العهد 5', 'مخطط ولي العهد 5', 'منطقة مخطط ولي العهد 5 في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:25', '2025-11-14 22:47:25'),
(158, 'مخطط ولي العهد 6', 'مخطط ولي العهد 6', 'منطقة مخطط ولي العهد 6 في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:25', '2025-11-14 22:47:25'),
(159, 'مخطط ولي العهد 7', 'مخطط ولي العهد 7', 'منطقة مخطط ولي العهد 7 في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:25', '2025-11-14 22:47:25'),
(160, 'مخطط ولي العهد 8', 'مخطط ولي العهد 8', 'منطقة مخطط ولي العهد 8 في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:25', '2025-11-14 22:47:25'),
(161, 'مخطط ولي العهد 9', 'مخطط ولي العهد 9', 'منطقة مخطط ولي العهد 9 في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:25', '2025-11-14 22:47:25'),
(162, 'النوارية', 'النوارية', 'منطقة النوارية في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:25', '2025-11-14 22:47:25'),
(163, 'العمرة', 'العمرة', 'منطقة العمرة في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:25', '2025-11-14 22:47:25'),
(164, 'النزاوي', 'النزاوي', 'منطقة النزاوي في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:25', '2025-11-14 22:47:25'),
(165, 'الزايدي', 'الزايدي', 'منطقة الزايدي في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:25', '2025-11-14 22:47:25'),
(166, 'عمرة الجديدة', 'عمرة الجديدة', 'منطقة عمرة الجديدة في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:25', '2025-11-14 22:47:25'),
(167, 'الفيحاء', 'الفيحاء', 'منطقة الفيحاء في مكة المكرمة', 50, NULL, 1, '2025-11-14 22:47:25', '2025-11-14 22:47:25');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `service_id` bigint(20) DEFAULT NULL,
  `seller_id` bigint(20) NOT NULL,
  `buyer_id` bigint(20) NOT NULL,
  `report_from` varchar(191) DEFAULT NULL,
  `report_to` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `report` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `order_id`, `service_id`, `seller_id`, `buyer_id`, `report_from`, `report_to`, `status`, `report`, `created_at`, `updated_at`) VALUES
(1, 1, 313, 1934, 1935, 'buyer', 'seller', 0, 'الفني لم يحضر في الموعد المحدد', '2025-11-09 09:54:09', '2025-10-28 08:54:09'),
(2, 1, 313, 1934, 1935, 'seller', 'buyer', 0, 'العميل رفض استلام الخدمة', '2025-11-05 09:54:09', '2025-10-27 08:54:09'),
(3, 2, 317, 1934, 1935, 'buyer', 'seller', 0, 'الفني طلب مبلغ إضافي غير متفق عليه', '2025-11-15 09:54:09', '2025-10-23 08:54:09'),
(4, 3, 315, 1934, 3, 'buyer', 'seller', 0, 'المشكلة لم يتم حلها بشكل كامل', '2025-11-14 09:54:09', '2025-11-13 09:54:09'),
(5, 3, 315, 1934, 3, 'seller', 'buyer', 0, 'العميل رفض استلام الخدمة', '2025-11-07 09:54:09', '2025-10-31 09:54:09'),
(6, 4, 322, 1934, 1935, 'buyer', 'seller', 0, 'جودة العمل لم تكن جيدة', '2025-11-14 09:54:09', '2025-10-22 08:54:09'),
(7, 5, 316, 1934, 1935, 'buyer', 'seller', 0, 'الفني لم يكمل العمل بشكل صحيح', '2025-11-12 09:54:09', '2025-11-06 09:54:09'),
(8, 6, 316, 1934, 5, 'buyer', 'seller', 0, 'الفني كان غير مهذب في التعامل', '2025-11-11 09:54:09', '2025-10-28 08:54:09'),
(9, 6, 316, 1934, 5, 'seller', 'buyer', 0, 'العميل كان غير مهذب في التعامل', '2025-11-12 09:54:09', '2025-10-29 08:54:09'),
(10, 7, 313, 1934, 3, 'buyer', 'seller', 0, 'الخدمة تأخرت كثيراً عن الموعد المحدد', '2025-11-02 09:54:09', '2025-11-03 09:54:09'),
(11, 7, 313, 1934, 3, 'seller', 'buyer', 0, 'العميل كان غير متعاون', '2025-10-28 08:54:09', '2025-10-23 08:54:09'),
(12, 8, 320, 1934, 3, 'buyer', 'seller', 0, 'الفني لم يحضر في الموعد المحدد', '2025-11-13 09:54:09', '2025-10-27 08:54:09'),
(13, 9, 316, 1934, 3, 'buyer', 'seller', 0, 'الخدمة لم تكتمل كما هو مطلوب', '2025-10-31 09:54:09', '2025-11-12 09:54:09'),
(14, 9, 316, 1934, 3, 'seller', 'buyer', 0, 'العميل طلب إلغاء الطلب بعد البدء بالعمل', '2025-11-02 09:54:09', '2025-11-08 09:54:09'),
(15, 10, 313, 1934, 3, 'buyer', 'seller', 0, 'المشكلة لم يتم حلها بشكل كامل', '2025-11-01 09:54:09', '2025-11-12 09:54:09'),
(16, 10, 313, 1934, 3, 'seller', 'buyer', 0, 'العميل رفض استلام الخدمة', '2025-11-11 09:54:09', '2025-10-29 08:54:09');

-- --------------------------------------------------------

--
-- Table structure for table `report_chat_messages`
--

CREATE TABLE `report_chat_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `report_id` bigint(20) NOT NULL,
  `admin_id` bigint(20) DEFAULT NULL,
  `seller_id` bigint(20) DEFAULT NULL,
  `buyer_id` bigint(20) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `type` varchar(191) DEFAULT NULL,
  `notify` varchar(191) DEFAULT NULL,
  `attachment` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `report_chat_messages`
--

INSERT INTO `report_chat_messages` (`id`, `report_id`, `admin_id`, `seller_id`, `buyer_id`, `message`, `type`, `notify`, `attachment`, `created_at`, `updated_at`) VALUES
(1, 11, NULL, 1934, NULL, '<p>السلام عليكم&nbsp;</p>', 'admin', 'off', NULL, '2025-11-16 10:04:27', '2025-11-16 10:04:27');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `service_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `rating` double NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin', '2021-09-01 23:42:51', '2021-09-01 23:42:51'),
(2, 'Admin', 'admin', '2021-09-01 23:45:03', '2021-09-01 23:45:03'),
(4, 'Support Agent', 'web', '2025-11-14 22:57:41', '2025-11-14 22:57:41'),
(5, 'Technician', 'web', '2025-11-14 22:57:41', '2025-11-14 22:57:41'),
(6, 'Client', 'web', '2025-11-14 22:57:41', '2025-11-14 22:57:41'),
(7, 'Quality Agent', 'web', '2025-11-14 22:57:41', '2025-11-14 22:57:41'),
(8, 'Finance', 'web', '2025-11-14 22:57:41', '2025-11-14 22:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(4, 1),
(53, 1),
(53, 2),
(54, 1),
(54, 2),
(55, 1),
(55, 2),
(56, 1),
(56, 2),
(57, 1),
(57, 2),
(58, 1),
(58, 2),
(59, 1),
(59, 2),
(60, 1),
(60, 2),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(74, 1),
(74, 2),
(81, 1),
(81, 2),
(82, 1),
(82, 2),
(83, 1),
(83, 2),
(85, 1),
(85, 2),
(86, 1),
(86, 2),
(87, 1),
(87, 2),
(88, 1),
(88, 2),
(97, 1),
(97, 2),
(98, 1),
(98, 2),
(99, 1),
(99, 2),
(100, 1),
(100, 2),
(101, 1),
(101, 2),
(102, 1),
(102, 2),
(103, 1),
(103, 2),
(104, 1),
(104, 2),
(105, 1),
(105, 2),
(108, 1),
(108, 2),
(109, 1),
(109, 2),
(110, 1),
(110, 2),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(119, 1),
(119, 2),
(120, 2),
(121, 2),
(122, 2),
(123, 2),
(124, 2),
(125, 2),
(126, 2),
(184, 2),
(185, 2),
(186, 2),
(187, 2),
(188, 2),
(189, 2),
(190, 2),
(191, 2),
(192, 2),
(193, 2),
(194, 2),
(196, 2),
(198, 2),
(199, 2),
(200, 2),
(201, 2),
(203, 2),
(204, 2),
(206, 2),
(208, 2),
(209, 2),
(210, 2),
(211, 2),
(212, 2),
(213, 2),
(216, 2),
(227, 2),
(228, 2),
(229, 2),
(230, 2),
(233, 2),
(235, 2),
(236, 2);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `day_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `schedule` varchar(191) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `allow_multiple_schedule` varchar(191) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `day_id`, `seller_id`, `schedule`, `status`, `created_at`, `updated_at`, `allow_multiple_schedule`) VALUES
(2, 1, 1, '12.00AM-01.00PM', 0, '2021-12-14 00:18:34', '2023-05-04 04:29:17', 'yes'),
(13, 14, 2, '12.00AM-01.00PM', 0, '2022-01-17 08:27:31', '2022-01-17 08:27:31', 'no'),
(14, 27, 5, '10.00AM-11.00AM', 0, '2022-02-07 02:33:30', '2022-02-07 02:33:30', 'no'),
(18, 19, 2, '10.00AM-11.00PM', 0, '2022-02-09 00:39:31', '2022-02-09 00:39:31', 'no'),
(19, 20, 2, '12.00AM-01.00PM', 0, '2022-02-09 00:39:44', '2022-02-09 00:39:44', 'no'),
(20, 21, 2, '10.00AM-11.00PM', 0, '2022-02-09 00:39:57', '2022-02-09 00:39:57', 'no'),
(21, 22, 2, '4.00AM-6.00PM', 0, '2022-02-09 00:40:19', '2022-02-09 00:40:19', 'no'),
(22, 23, 2, '10.00AM-11.00PM', 0, '2022-02-09 00:40:33', '2022-02-09 00:40:33', 'no'),
(24, 27, 4, '12.00AM-01.00PM', 0, '2022-02-09 00:45:45', '2022-02-09 00:45:45', 'no'),
(25, 28, 4, '10.00AM-11.00PM', 0, '2022-02-09 00:45:54', '2022-02-09 00:45:54', 'no'),
(26, 29, 4, '4.00AM-6.00PM', 0, '2022-02-09 00:46:05', '2022-02-09 00:46:05', 'no'),
(27, 19, 2, '4.00AM-6.00PM', 0, '2022-02-14 00:46:35', '2022-02-14 00:46:35', 'no'),
(28, 20, 2, '10.00AM-11.00PM', 0, '2022-02-14 00:46:59', '2022-02-14 00:46:59', 'no'),
(33, 9, 1, '04.00AM-05.00PM', 0, '2022-02-27 01:40:30', '2023-05-04 04:29:17', 'yes'),
(37, 27, 4, '10.00AM-11.00PM', 0, '2022-02-27 01:47:21', '2022-02-27 01:47:21', 'no'),
(38, 27, 4, '4.00AM-6.00PM', 0, '2022-02-27 01:47:32', '2022-02-27 01:47:32', 'no'),
(39, 28, 4, '4.00AM-6.00PM', 0, '2022-02-27 01:47:50', '2022-02-27 01:47:50', 'no'),
(40, 29, 4, '10.00AM-11.00PM', 0, '2022-02-27 01:48:17', '2022-02-27 01:48:17', 'no'),
(41, 29, 4, '1.00AM-2.00PM', 0, '2022-02-27 01:50:56', '2022-02-27 01:50:56', 'no'),
(42, 14, 2, '10.00AM-11.00PM', 0, '2022-02-27 01:51:49', '2022-02-27 01:51:49', 'no'),
(43, 19, 2, '11.00AM-12.00PM', 0, '2022-02-27 01:52:05', '2022-02-27 01:52:05', 'no'),
(44, 21, 2, '10.00AM-11.00PM', 0, '2022-02-27 01:52:24', '2022-02-27 01:52:24', 'no'),
(45, 20, 2, '10.00AM-11.00PM', 0, '2022-02-27 01:52:36', '2022-02-27 01:52:36', 'no'),
(46, 22, 2, '10.00AM-11.00PM', 0, '2022-02-27 01:53:30', '2022-02-27 01:53:30', 'no'),
(47, 23, 2, '11.00AM-12.00PM', 0, '2022-02-27 01:53:38', '2022-02-27 01:53:51', 'no'),
(48, 1, 1, '1:00 pm - 5:00 pm', 0, '2023-05-04 00:20:06', '2023-05-04 04:29:17', 'yes'),
(51, 9, 1, '1:00 pm - 5:00 pm', 0, '2023-05-04 00:20:06', '2023-05-04 04:29:17', 'yes'),
(53, 16, 1, '1:00 pm - 5:00 pm', 0, '2023-05-04 00:20:06', '2023-05-04 04:29:17', 'yes'),
(54, 34, 1, '1:00 pm - 5:00 pm', 0, '2023-05-04 00:20:06', '2023-05-04 04:29:17', 'yes'),
(55, 1, 1, '1:0000 pm - 5:00 pm', 0, '2023-05-04 00:20:32', '2023-05-04 04:29:17', 'yes'),
(56, 7, 1, '1:0000 pm - 5:00 pm', 0, '2023-05-04 00:20:32', '2023-05-04 04:29:17', 'yes'),
(58, 9, 1, '1:0000 pm - 5:00 pm', 0, '2023-05-04 00:20:32', '2023-05-04 04:29:17', 'yes'),
(60, 16, 1, '1:0000 pm - 5:00 pm', 0, '2023-05-04 00:20:32', '2023-05-04 04:29:17', 'yes'),
(61, 34, 1, '1:0000 pm - 5:00 pm', 0, '2023-05-04 00:20:32', '2023-05-04 04:29:17', 'yes'),
(63, 1, 1, '4:00 pm - 5:00 pm', 0, '2023-05-04 04:30:23', '2023-05-04 04:30:23', 'no'),
(64, 7, 1, '4:00 pm - 5:00 pm', 0, '2023-05-04 04:30:23', '2023-05-04 04:30:23', 'no'),
(65, 8, 1, '4:00 pm - 5:00 pm', 0, '2023-05-04 04:30:23', '2023-05-04 04:30:23', 'no'),
(66, 9, 1, '4:00 pm - 5:00 pm', 0, '2023-05-04 04:30:24', '2023-05-04 04:30:24', 'no'),
(67, 15, 1, '4:00 pm - 5:00 pm', 0, '2023-05-04 04:30:24', '2023-05-04 04:30:24', 'no'),
(68, 16, 1, '4:00 pm - 5:00 pm', 0, '2023-05-04 04:30:24', '2023-05-04 04:30:24', 'no'),
(69, 34, 1, '4:00 pm - 5:00 pm', 0, '2023-05-04 04:30:24', '2023-05-04 04:30:24', 'no'),
(70, 1, 1, 'heudhh', 0, '2023-07-24 20:19:06', '2023-07-24 20:19:06', 'no'),
(71, 7, 1, 'heudhh', 0, '2023-07-24 20:19:06', '2023-07-24 20:19:06', 'no'),
(72, 8, 1, 'heudhh', 0, '2023-07-24 20:19:06', '2023-07-24 20:19:06', 'no'),
(73, 9, 1, 'heudhh', 0, '2023-07-24 20:19:06', '2023-07-24 20:19:06', 'no'),
(74, 15, 1, 'heudhh', 0, '2023-07-24 20:19:06', '2023-07-24 20:19:06', 'no'),
(75, 16, 1, 'heudhh', 0, '2023-07-24 20:19:06', '2023-07-24 20:19:06', 'no'),
(76, 34, 1, 'heudhh', 0, '2023-07-24 20:19:06', '2023-07-24 20:19:06', 'no'),
(77, 1, 1, 'Teste', 0, '2023-07-25 09:42:01', '2023-07-25 09:42:01', 'no'),
(78, 7, 1, 'Teste', 0, '2023-07-25 09:42:01', '2023-07-25 09:42:01', 'no'),
(79, 8, 1, 'Teste', 0, '2023-07-25 09:42:01', '2023-07-25 09:42:01', 'no'),
(80, 9, 1, 'Teste', 0, '2023-07-25 09:42:01', '2023-07-25 09:42:01', 'no'),
(81, 15, 1, 'Teste', 0, '2023-07-25 09:42:01', '2023-07-25 09:42:01', 'no'),
(82, 16, 1, 'Teste', 0, '2023-07-25 09:42:01', '2023-07-25 09:42:01', 'no'),
(83, 34, 1, 'Teste', 0, '2023-07-25 09:42:01', '2023-07-25 09:42:01', 'no'),
(84, 35, 1617, '11:00 - 18:00', 0, '2023-07-26 04:13:48', '2023-07-26 04:13:48', 'no'),
(85, 36, 1617, '11:00 - 18:00', 0, '2023-07-26 04:13:48', '2023-07-26 04:13:48', 'no'),
(86, 37, 1617, '11:00 - 18:00', 0, '2023-07-26 04:13:48', '2023-07-26 04:13:48', 'no'),
(87, 38, 1617, '11:00 - 18:00', 0, '2023-07-26 04:13:48', '2023-07-26 04:13:48', 'no'),
(88, 39, 1617, '11:00 - 18:00', 0, '2023-07-26 04:13:48', '2023-07-26 04:13:48', 'no'),
(89, 40, 1617, '11:00 - 18:00', 0, '2023-07-26 04:13:48', '2023-07-26 04:13:48', 'no'),
(90, 41, 1617, '11:00 - 18:00', 0, '2023-07-26 04:13:48', '2023-07-26 04:13:48', 'no'),
(91, 35, 1617, '10:00 - 18:00', 0, '2023-07-26 04:14:20', '2023-07-26 04:14:20', 'no'),
(92, 41, 1617, '09:00 - 17:00', 0, '2023-07-26 04:14:53', '2023-07-26 04:14:53', 'no'),
(93, 1, 1, 'عأ', 0, '2023-07-30 21:25:21', '2023-07-30 21:25:21', 'no'),
(94, 7, 1, 'عأ', 0, '2023-07-30 21:25:21', '2023-07-30 21:25:21', 'no'),
(95, 8, 1, 'عأ', 0, '2023-07-30 21:25:21', '2023-07-30 21:25:21', 'no'),
(96, 9, 1, 'عأ', 0, '2023-07-30 21:25:21', '2023-07-30 21:25:21', 'no'),
(97, 15, 1, 'عأ', 0, '2023-07-30 21:25:21', '2023-07-30 21:25:21', 'no'),
(98, 16, 1, 'عأ', 0, '2023-07-30 21:25:21', '2023-07-30 21:25:21', 'no'),
(99, 34, 1, 'عأ', 0, '2023-07-30 21:25:21', '2023-07-30 21:25:21', 'no'),
(100, 15, 1, '10.00AM-11.00AM', 0, '2023-08-01 04:48:02', '2023-08-01 04:48:02', 'no'),
(101, 7, 1, '08', 0, '2023-08-19 22:51:38', '2023-08-19 22:51:38', 'no'),
(102, 8, 1, '08', 0, '2023-08-19 22:51:38', '2023-08-19 22:51:38', 'no'),
(103, 15, 1, '08', 0, '2023-08-19 22:51:38', '2023-08-19 22:51:38', 'no'),
(104, 34, 1, '08', 0, '2023-08-19 22:51:38', '2023-08-19 22:51:38', 'no'),
(105, 47, 1, '08', 0, '2023-08-19 22:51:38', '2023-08-19 22:51:38', 'no'),
(106, 55, 1, '08', 0, '2023-08-19 22:51:38', '2023-08-19 22:51:38', 'no'),
(107, 56, 1, '08', 0, '2023-08-19 22:51:38', '2023-08-19 22:51:38', 'no'),
(108, 7, 1, '09:00AM- 09:00PM', 0, '2023-08-19 22:53:00', '2023-08-19 22:53:00', 'no'),
(109, 8, 1, '09:00AM- 09:00PM', 0, '2023-08-19 22:53:00', '2023-08-19 22:53:00', 'no'),
(110, 15, 1, '09:00AM- 09:00PM', 0, '2023-08-19 22:53:00', '2023-08-19 22:53:00', 'no'),
(111, 34, 1, '09:00AM- 09:00PM', 0, '2023-08-19 22:53:00', '2023-08-19 22:53:00', 'no'),
(112, 47, 1, '09:00AM- 09:00PM', 0, '2023-08-19 22:53:00', '2023-08-19 22:53:00', 'no'),
(113, 55, 1, '09:00AM- 09:00PM', 0, '2023-08-19 22:53:00', '2023-08-19 22:53:00', 'no'),
(114, 56, 1, '09:00AM- 09:00PM', 0, '2023-08-19 22:53:00', '2023-08-19 22:53:00', 'no'),
(115, 7, 1, '09:00AM-09:00PM', 0, '2023-08-19 22:54:55', '2023-08-19 22:54:55', 'no'),
(116, 8, 1, '09:00AM-09:00PM', 0, '2023-08-19 22:54:55', '2023-08-19 22:54:55', 'no'),
(117, 15, 1, '09:00AM-09:00PM', 0, '2023-08-19 22:54:55', '2023-08-19 22:54:55', 'no'),
(118, 34, 1, '09:00AM-09:00PM', 0, '2023-08-19 22:54:55', '2023-08-19 22:54:55', 'no'),
(119, 47, 1, '09:00AM-09:00PM', 0, '2023-08-19 22:54:55', '2023-08-19 22:54:55', 'no'),
(120, 55, 1, '09:00AM-09:00PM', 0, '2023-08-19 22:54:55', '2023-08-19 22:54:55', 'no'),
(121, 56, 1, '09:00AM-09:00PM', 0, '2023-08-19 22:54:55', '2023-08-19 22:54:55', 'no'),
(122, 7, 1, 'peggy', 0, '2023-08-21 18:37:24', '2023-08-21 18:37:24', 'no'),
(123, 8, 1, 'peggy', 0, '2023-08-21 18:37:24', '2023-08-21 18:37:24', 'no'),
(124, 15, 1, 'peggy', 0, '2023-08-21 18:37:24', '2023-08-21 18:37:24', 'no'),
(125, 34, 1, 'peggy', 0, '2023-08-21 18:37:24', '2023-08-21 18:37:24', 'no'),
(126, 47, 1, 'peggy', 0, '2023-08-21 18:37:24', '2023-08-21 18:37:24', 'no'),
(127, 55, 1, 'peggy', 0, '2023-08-21 18:37:24', '2023-08-21 18:37:24', 'no'),
(128, 56, 1, 'peggy', 0, '2023-08-21 18:37:24', '2023-08-21 18:37:24', 'no'),
(129, 7, 1, 'tedt', 0, '2023-09-11 04:31:07', '2023-09-11 04:31:07', 'no'),
(130, 8, 1, 'tedt', 0, '2023-09-11 04:31:07', '2023-09-11 04:31:07', 'no'),
(131, 15, 1, 'tedt', 0, '2023-09-11 04:31:07', '2023-09-11 04:31:07', 'no'),
(132, 58, 1, 'tedt', 0, '2023-09-11 04:31:07', '2023-09-11 04:31:07', 'no'),
(133, 59, 1, 'tedt', 0, '2023-09-11 04:31:07', '2023-09-11 04:31:07', 'no'),
(134, 60, 1, 'tedt', 0, '2023-09-11 04:31:07', '2023-09-11 04:31:07', 'no'),
(135, 61, 1, 'tedt', 0, '2023-09-11 04:31:07', '2023-09-11 04:31:07', 'no'),
(136, 15, 1, 'evgeveevevevev brbervvdvdr dvr dvr dvdhehdbdbdv', 0, '2023-09-14 14:35:12', '2023-09-14 14:35:12', 'no'),
(137, 7, 1, 'привет', 0, '2023-09-21 22:20:48', '2023-09-21 22:20:48', 'no'),
(138, 8, 1, 'привет', 0, '2023-09-21 22:20:48', '2023-09-21 22:20:48', 'no'),
(139, 15, 1, 'привет', 0, '2023-09-21 22:20:48', '2023-09-21 22:20:48', 'no'),
(140, 59, 1, 'привет', 0, '2023-09-21 22:20:48', '2023-09-21 22:20:48', 'no'),
(141, 60, 1, 'привет', 0, '2023-09-21 22:20:48', '2023-09-21 22:20:48', 'no'),
(142, 61, 1, 'привет', 0, '2023-09-21 22:20:48', '2023-09-21 22:20:48', 'no'),
(143, 77, 1831, '10', 0, '2023-09-27 02:01:24', '2023-09-27 02:01:24', 'no'),
(144, 78, 1831, '10', 0, '2023-09-27 02:01:24', '2023-09-27 02:01:24', 'no'),
(145, 79, 1831, '10', 0, '2023-09-27 02:01:24', '2023-09-27 02:01:24', 'no'),
(146, 80, 1831, '10', 0, '2023-09-27 02:01:24', '2023-09-27 02:01:24', 'no'),
(147, 81, 1831, '10', 0, '2023-09-27 02:01:24', '2023-09-27 02:01:24', 'no'),
(148, 82, 1831, '10', 0, '2023-09-27 02:01:24', '2023-09-27 02:01:24', 'no'),
(149, 83, 1831, '10', 0, '2023-09-27 02:01:24', '2023-09-27 02:01:24', 'no'),
(150, 7, 1, '10:00 pm - 5:00 pm', 0, '2023-10-11 14:01:48', '2023-10-11 14:01:48', 'no'),
(151, 7, 1, 'a', 0, '2023-10-14 17:56:27', '2023-10-14 17:56:27', 'no'),
(152, 8, 1, 'a', 0, '2023-10-14 17:56:27', '2023-10-14 17:56:27', 'no'),
(153, 15, 1, 'a', 0, '2023-10-14 17:56:27', '2023-10-14 17:56:27', 'no'),
(154, 60, 1, 'a', 0, '2023-10-14 17:56:27', '2023-10-14 17:56:27', 'no'),
(155, 61, 1, 'a', 0, '2023-10-14 17:56:27', '2023-10-14 17:56:27', 'no'),
(156, 76, 1, 'a', 0, '2023-10-14 17:56:27', '2023-10-14 17:56:27', 'no'),
(157, 84, 1, 'a', 0, '2023-10-14 17:56:27', '2023-10-14 17:56:27', 'no'),
(158, 7, 1, '1:0000 pm - 5:00 pm', 0, '2023-10-15 08:34:48', '2023-10-15 08:34:48', 'no'),
(159, 7, 1, '10:00Am - 11:00pm', 0, '2023-10-15 08:35:34', '2023-10-15 08:35:34', 'no'),
(160, 8, 1, '10:00Am - 11:00pm', 0, '2023-10-15 08:35:34', '2023-10-15 08:35:34', 'no'),
(161, 15, 1, '10:00Am - 11:00pm', 0, '2023-10-15 08:35:34', '2023-10-15 08:35:34', 'no'),
(162, 60, 1, '10:00Am - 11:00pm', 0, '2023-10-15 08:35:34', '2023-10-15 08:35:34', 'no'),
(163, 61, 1, '10:00Am - 11:00pm', 0, '2023-10-15 08:35:34', '2023-10-15 08:35:34', 'no'),
(164, 76, 1, '10:00Am - 11:00pm', 0, '2023-10-15 08:35:34', '2023-10-15 08:35:34', 'no'),
(165, 84, 1, '10:00Am - 11:00pm', 0, '2023-10-15 08:35:34', '2023-10-15 08:35:34', 'no'),
(166, 8, 1, 'game', 0, '2023-11-02 03:06:13', '2023-11-02 03:06:13', 'no'),
(167, 15, 1, 'game', 0, '2023-11-02 03:06:13', '2023-11-02 03:06:13', 'no'),
(168, 60, 1, 'game', 0, '2023-11-02 03:06:13', '2023-11-02 03:06:13', 'no'),
(169, 61, 1, 'game', 0, '2023-11-02 03:06:13', '2023-11-02 03:06:13', 'no'),
(170, 76, 1, 'game', 0, '2023-11-02 03:06:13', '2023-11-02 03:06:13', 'no'),
(171, 84, 1, 'game', 0, '2023-11-02 03:06:13', '2023-11-02 03:06:13', 'no'),
(172, 85, 1, 'game', 0, '2023-11-02 03:06:13', '2023-11-02 03:06:13', 'no'),
(173, 15, 1, '11:00 - 12pm', 0, '2023-11-02 03:06:55', '2023-11-02 03:06:55', 'no'),
(174, 76, 1, '10:00am - 2:00pm', 0, '2023-11-02 03:08:54', '2023-11-02 03:08:54', 'no'),
(175, 8, 1, '10:00am - 11:00pm', 0, '2023-11-02 03:09:50', '2023-11-02 03:09:50', 'no'),
(176, 15, 1, '10:00am - 11:00pm', 0, '2023-11-02 03:09:50', '2023-11-02 03:09:50', 'no'),
(177, 60, 1, '10:00am - 11:00pm', 0, '2023-11-02 03:09:50', '2023-11-02 03:09:50', 'no'),
(178, 61, 1, '10:00am - 11:00pm', 0, '2023-11-02 03:09:50', '2023-11-02 03:09:50', 'no'),
(179, 76, 1, '10:00am - 11:00pm', 0, '2023-11-02 03:09:50', '2023-11-02 03:09:50', 'no'),
(180, 84, 1, '10:00am - 11:00pm', 0, '2023-11-02 03:09:50', '2023-11-02 03:09:50', 'no'),
(181, 85, 1, '10:00am - 11:00pm', 0, '2023-11-02 03:09:50', '2023-11-02 03:09:50', 'no'),
(182, 8, 1, 'port', 0, '2023-11-02 03:11:55', '2023-11-02 03:11:55', 'no'),
(183, 15, 1, 'port', 0, '2023-11-02 03:11:55', '2023-11-02 03:11:55', 'no'),
(184, 60, 1, 'port', 0, '2023-11-02 03:11:55', '2023-11-02 03:11:55', 'no'),
(185, 61, 1, 'port', 0, '2023-11-02 03:11:55', '2023-11-02 03:11:55', 'no'),
(186, 76, 1, 'port', 0, '2023-11-02 03:11:55', '2023-11-02 03:11:55', 'no'),
(187, 84, 1, 'port', 0, '2023-11-02 03:11:55', '2023-11-02 03:11:55', 'no'),
(188, 85, 1, 'port', 0, '2023-11-02 03:11:55', '2023-11-02 03:11:55', 'no'),
(189, 8, 1, 'monday', 0, '2023-11-08 11:39:35', '2023-11-08 11:39:35', 'no'),
(190, 15, 1, 'monday', 0, '2023-11-08 11:39:35', '2023-11-08 11:39:35', 'no'),
(191, 60, 1, 'monday', 0, '2023-11-08 11:39:35', '2023-11-08 11:39:35', 'no'),
(192, 61, 1, 'monday', 0, '2023-11-08 11:39:35', '2023-11-08 11:39:35', 'no'),
(193, 76, 1, 'monday', 0, '2023-11-08 11:39:35', '2023-11-08 11:39:35', 'no'),
(194, 84, 1, 'monday', 0, '2023-11-08 11:39:35', '2023-11-08 11:39:35', 'no'),
(195, 85, 1, 'monday', 0, '2023-11-08 11:39:35', '2023-11-08 11:39:35', 'no'),
(196, 8, 1, 'test', 0, '2023-11-08 11:40:09', '2023-11-08 11:40:09', 'no'),
(197, 15, 1, 'test', 0, '2023-11-08 11:40:09', '2023-11-08 11:40:09', 'no'),
(198, 60, 1, 'test', 0, '2023-11-08 11:40:09', '2023-11-08 11:40:09', 'no'),
(199, 61, 1, 'test', 0, '2023-11-08 11:40:09', '2023-11-08 11:40:09', 'no'),
(200, 76, 1, 'test', 0, '2023-11-08 11:40:09', '2023-11-08 11:40:09', 'no'),
(201, 84, 1, 'test', 0, '2023-11-08 11:40:09', '2023-11-08 11:40:09', 'no'),
(202, 85, 1, 'test', 0, '2023-11-08 11:40:09', '2023-11-08 11:40:09', 'no'),
(203, 8, 1, 'anjali', 0, '2023-11-16 01:54:12', '2023-11-16 01:54:12', 'no'),
(204, 15, 1, 'anjali', 0, '2023-11-16 01:54:12', '2023-11-16 01:54:12', 'no'),
(205, 60, 1, 'anjali', 0, '2023-11-16 01:54:12', '2023-11-16 01:54:12', 'no'),
(206, 61, 1, 'anjali', 0, '2023-11-16 01:54:12', '2023-11-16 01:54:12', 'no'),
(207, 76, 1, 'anjali', 0, '2023-11-16 01:54:12', '2023-11-16 01:54:12', 'no'),
(208, 84, 1, 'anjali', 0, '2023-11-16 01:54:12', '2023-11-16 01:54:12', 'no'),
(209, 85, 1, 'anjali', 0, '2023-11-16 01:54:12', '2023-11-16 01:54:12', 'no'),
(210, 86, 1, 'anjslu', 0, '2023-11-16 01:55:34', '2023-11-16 01:55:34', 'no'),
(211, 60, 1, '10 -11', 0, '2023-11-16 01:56:47', '2023-11-16 01:56:47', 'no'),
(212, 15, 1, 'emizentech', 0, '2023-11-16 01:58:54', '2023-11-16 01:58:54', 'no'),
(213, 60, 1, 'emizentech', 0, '2023-11-16 01:58:54', '2023-11-16 01:58:54', 'no'),
(214, 61, 1, 'emizentech', 0, '2023-11-16 01:58:54', '2023-11-16 01:58:54', 'no'),
(215, 76, 1, 'emizentech', 0, '2023-11-16 01:58:54', '2023-11-16 01:58:54', 'no'),
(216, 84, 1, 'emizentech', 0, '2023-11-16 01:58:54', '2023-11-16 01:58:54', 'no'),
(217, 85, 1, 'emizentech', 0, '2023-11-16 01:58:54', '2023-11-16 01:58:54', 'no'),
(218, 86, 1, 'emizentech', 0, '2023-11-16 01:58:54', '2023-11-16 01:58:54', 'no'),
(219, 15, 1, '11:00am-05:00pm', 0, '2023-11-18 23:33:03', '2023-11-18 23:33:03', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `seller_subscriptions`
--

CREATE TABLE `seller_subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_id` bigint(20) NOT NULL,
  `seller_id` bigint(20) NOT NULL,
  `type` varchar(191) DEFAULT NULL,
  `connect` bigint(20) NOT NULL DEFAULT 0,
  `service` bigint(20) NOT NULL DEFAULT 0,
  `job` bigint(20) NOT NULL DEFAULT 0,
  `price` double NOT NULL DEFAULT 0,
  `initial_connect` bigint(20) NOT NULL DEFAULT 0,
  `initial_service` bigint(20) NOT NULL DEFAULT 0,
  `initial_job` bigint(20) NOT NULL DEFAULT 0,
  `initial_price` double NOT NULL DEFAULT 0,
  `total` double NOT NULL DEFAULT 0,
  `status` bigint(20) NOT NULL DEFAULT 0,
  `expire_date` timestamp NULL DEFAULT NULL,
  `payment_gateway` varchar(191) DEFAULT NULL,
  `payment_status` varchar(191) DEFAULT NULL,
  `transaction_id` varchar(191) DEFAULT NULL,
  `manual_payment_image` varchar(191) DEFAULT NULL,
  `note` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seller_verifies`
--

CREATE TABLE `seller_verifies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` varchar(191) DEFAULT NULL,
  `national_id` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `status` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seller_view_jobs`
--

CREATE TABLE `seller_view_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_post_id` bigint(20) NOT NULL,
  `seller_id` bigint(20) NOT NULL,
  `country_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `serviceadditionals`
--

CREATE TABLE `serviceadditionals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) DEFAULT NULL,
  `seller_id` bigint(20) DEFAULT NULL,
  `additional_service_title` varchar(191) DEFAULT NULL,
  `additional_service_price` double DEFAULT NULL,
  `additional_service_quantity` int(11) DEFAULT NULL,
  `additional_service_image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `serviceadditionals`
--

INSERT INTO `serviceadditionals` (`id`, `service_id`, `seller_id`, `additional_service_title`, `additional_service_price`, `additional_service_quantity`, `additional_service_image`, `created_at`, `updated_at`) VALUES
(26, 17, 5, 'Hair Color', 5, 1, '154', NULL, '2022-02-13 03:45:24'),
(27, 18, 5, 'TV Cleaning Service', 10, 1, '155', NULL, '2022-02-13 03:58:02'),
(28, 19, 5, '5 Switch Board Repair', 5, 1, '156', NULL, '2022-02-13 03:47:17'),
(29, 20, 5, 'Only Face Makeup', 5, 1, '157', NULL, '2022-02-13 03:48:46'),
(82, 49, 1, 'werwer', 10, 1, '168', NULL, NULL),
(83, 49, 1, '1asasd asdas', 20, 1, '170', NULL, NULL),
(123, 75, 1474, 'fregado', 5, 1, NULL, NULL, NULL),
(124, 76, 1, 'cleaning toilet', 15, 1, NULL, NULL, NULL),
(125, 79, 1, 'nothing', 80, 1, NULL, NULL, NULL),
(127, 82, 1, 'test add one', 200, 1, '230', NULL, '2023-01-24 18:46:25'),
(129, 83, 1, '343', 343, 1, NULL, NULL, NULL),
(130, 83, 1, '43', 434, 1, NULL, NULL, NULL),
(131, 83, 1, '4543', 5, 1, NULL, NULL, NULL),
(132, 83, 1, 'dfsf', 43, 1, NULL, NULL, NULL),
(133, 83, 1, '3432', 434, 1, NULL, NULL, NULL),
(134, 83, 1, '34', 324, 1, NULL, NULL, NULL),
(138, 93, 1, 'Culpa recusandae Be', 879, 1, NULL, NULL, NULL),
(139, 176, 1536, 'sdfdsf', 555, 1, '525', NULL, NULL),
(140, 176, 1536, 'dsfsdf', 666, 1, NULL, NULL, NULL),
(141, 177, 1536, 'sdfsdf', 55, 1, '518', NULL, NULL),
(142, 177, 1536, 'sdfdf', 77, 1, NULL, NULL, NULL),
(143, 178, 1536, 'one', 10, 1, '524', NULL, NULL),
(144, 178, 1536, 'three', 30, 1, '514', NULL, NULL),
(145, 179, 1536, 'fdsfdsfs', 767, 1, '525', NULL, NULL),
(146, 180, 1536, 'fdgsd', 3445, 1, NULL, NULL, NULL),
(147, 192, 1536, 'Additional  one', 15, 1, '533', NULL, NULL),
(148, 192, 1536, 'Additional  three fgdfg', 207, 1, '524', NULL, NULL),
(149, 193, 1536, 'Additional One', 20, 1, '522', NULL, NULL),
(150, 193, 1536, 'Additional two', 30, 1, '538', NULL, NULL),
(151, 193, 1536, 'Additional three', 40, 1, '527', NULL, NULL),
(152, 193, 1536, 'Additional four', 50, 1, '528', NULL, NULL),
(153, 194, 1536, 'Included  one', 10, 1, NULL, NULL, NULL),
(154, 194, 1536, 'Included  two', 20, 1, NULL, NULL, NULL),
(155, 194, 1536, 'Included  two', 30, 1, NULL, NULL, NULL),
(156, 194, 1536, 'Included  three', 40, 1, NULL, NULL, NULL),
(157, 195, 1536, 'one ', 20, 1, '535', NULL, NULL),
(158, 195, 1536, 'two', 30, 1, '524', NULL, NULL),
(322, 202, 1536, 'title one', 20, 1, NULL, NULL, NULL),
(323, 202, 1536, 'title two', 30, 1, NULL, NULL, NULL),
(324, 202, 1536, 'title three', 40, 1, NULL, NULL, NULL),
(325, 205, 1536, 'Velit eum et velit s', 47, 1, NULL, NULL, NULL),
(326, 205, 1536, 'Dolor ut consectetur', 25, 1, NULL, NULL, NULL),
(327, 205, 1536, 'Suscipit nihil debit', 82, 1, NULL, NULL, NULL),
(328, 205, 1536, 'Laboris dolor et neq', 72, 1, NULL, NULL, NULL),
(329, 205, 1536, 'Animi sint deserunt', 8, 1, 'Dolore eos eveniet ', NULL, NULL),
(352, 206, 1536, 'Coka cola', 45, 1, NULL, NULL, NULL),
(353, 206, 1536, '7up', 40, 1, NULL, NULL, NULL),
(405, 207, 1536, 'fasdfasd', 21321, 1, NULL, NULL, NULL),
(406, 207, 1536, 'fdsa2f', 16546, 1, NULL, NULL, NULL),
(407, 207, 1536, 'fadsf3asd1', 631321, 1, NULL, NULL, NULL),
(424, 215, 1542, 'Additional  title one ', 100, 1, NULL, NULL, NULL),
(460, 219, 1, 'fsdf ', 333, 1, NULL, NULL, NULL),
(461, 219, 1, 'fsdf', 3333, 1, NULL, NULL, NULL),
(462, 219, 1, 'fsdf ', 3333, 1, NULL, NULL, NULL),
(463, 219, 1, 'fsd df', 33, 1, NULL, NULL, NULL),
(478, 218, 1, 'fsdf', 3434, 1, '459', NULL, NULL),
(479, 218, 1, 'dsfds', 343, 1, '461', NULL, NULL),
(480, 218, 1, 'dsfs', 33, 1, '460', NULL, NULL),
(481, 218, 1, 'fdsf', 33, 1, '459', NULL, NULL),
(742, 239, 1, 'Creation of Membership Web.', 100, 1, '585', NULL, NULL),
(743, 239, 1, 'Unctionality Modification', NULL, 1, '584', NULL, NULL),
(751, 240, 1, 'cocacola 7up fanta', 1000, 1, '584', NULL, NULL),
(752, 242, 1, 'FSDAF SSDFSSDFSDD FDSFDSF', 7567, 1, '572', NULL, NULL),
(753, 242, 1, 'DSFSF', 333, 1, '585', NULL, NULL),
(767, 248, 1551, 'gfdgfd', 444, 1, '598', NULL, NULL),
(768, 246, 1, 'Mobile Display Change  ', 30, 1, '592', NULL, NULL),
(769, 246, 1, 'Mobile software update ', 25, 1, '572', NULL, NULL),
(776, 245, 1, 'Mobile Data Remove', 10, 1, '581', NULL, NULL),
(777, 245, 1, 'Mobile Data Add', 20, 1, '571', NULL, NULL),
(778, 245, 1, 'All Mobile data Test', 30, 1, '593', NULL, NULL),
(785, 50, 1, 'Business scerrt', 10, 1, '186', NULL, NULL),
(786, 50, 1, 'Business plan', 10, 1, '183', NULL, NULL),
(787, 50, 1, 'Business idea', NULL, 1, '184', NULL, NULL),
(788, 41, 1, 'Get business plan', 10, 1, '139', NULL, NULL),
(789, 41, 1, 'Business Idea', 10, 1, '144', NULL, NULL),
(790, 16, 1, 'Drying Car', 3, 1, '143', NULL, NULL),
(798, 2, 1, 'Ac Service', 5, 1, '139', NULL, NULL),
(799, 2, 1, 'Ac Clean', 5, 1, '160', NULL, NULL),
(800, 6, 1, 'AC Dry Wash', 4, 1, '139', NULL, NULL),
(809, 4, 1, 'Table Moving', 5, 1, '141', NULL, NULL),
(810, 4, 1, 'Door Moving', 5, 1, '163', NULL, NULL),
(811, 5, 1, 'Kitchen Cleaning', 5, 1, '137', NULL, NULL),
(812, 5, 1, 'Door Cleaning', 10, 1, '142', NULL, NULL),
(813, 9, 2, 'Boys Beard Shave', 3, 1, '146', NULL, NULL),
(814, 9, 2, 'Cool Cutting Style', 2, 1, '147', NULL, NULL),
(815, 8, 2, 'Back Massage', 3, 1, '145', NULL, NULL),
(816, 8, 2, 'Hand Massage', NULL, 1, '159', NULL, NULL),
(817, 12, 2, 'Car Dry Wash', 10, 1, '148', NULL, NULL),
(818, 12, 2, 'Car Full Service', 50, 1, '149', NULL, NULL),
(819, 12, 2, 'Tire Change', NULL, 1, '158', NULL, NULL),
(820, 14, 2, 'Wire Change', 2, 1, '151', NULL, NULL),
(821, 14, 2, 'Circuit Board', 3, 1, '152', NULL, NULL),
(822, 15, 2, 'Furniture Set', 30, 1, '153', NULL, NULL),
(825, 13, 2, 'Sofa Cover Cloth Clean', 3, 1, '150', NULL, NULL),
(826, 13, 2, '2 Seater Sofa Dry Wash', 10, 1, '150', NULL, NULL),
(828, 53, 1, 'Service Two', 12, 1, NULL, NULL, NULL),
(829, 53, 1, 'Service Three', 15, 1, NULL, NULL, NULL),
(830, 53, 1, 'asdf', 3, 1, NULL, NULL, NULL),
(837, 257, 1, 'addition service', 10, 1, NULL, NULL, NULL),
(838, 257, 1, 'addintion', 5, 10, NULL, NULL, NULL),
(839, 257, 1, 'addition3', 1, 5, NULL, NULL, NULL),
(840, 1, 1, 'Kitchen', 20, 1, '137', NULL, NULL),
(841, 1, 1, 'Fridge', 10, 1, '136', NULL, NULL),
(842, 1, 1, 'Wall2', 12, 1, '135', NULL, NULL),
(844, 260, 1677, 'sysyst', 1132, 1, NULL, NULL, NULL),
(845, 259, 1, 'free checking ', 0, 1, NULL, NULL, NULL),
(846, 261, 1, '44', 444, 1, NULL, NULL, NULL),
(854, 36, 1, 'Kitchen Cleaning', 20, 1, '461', NULL, NULL),
(855, 36, 1, 'Window Clean', 20, 1, '453', NULL, NULL),
(856, 36, 1, 'Table', 10, 1, '452', NULL, NULL),
(857, 266, 1, 'additional hours ', 150, 1, NULL, NULL, NULL),
(858, 269, 1, 'hsh', 64, 1, NULL, NULL, NULL),
(859, 270, 1743, 'avb b', 2999, 1, NULL, NULL, NULL),
(860, 273, 1, 'yj', 5, 1, NULL, NULL, NULL),
(862, 280, 1800, 'axcb', 100, 12, NULL, NULL, NULL),
(864, 283, 1, 'JavaScript ', 50, 1, NULL, NULL, NULL),
(866, 7, 1, 'Kitchen Painting 10x10', 90, 1, '137', NULL, NULL),
(870, 3, 1, 'Facial', 5, 1, '140', NULL, NULL),
(871, 3, 1, 'Hair Color', 5, 1, '162', NULL, NULL),
(872, 288, 1, 'online service', 30, 1, NULL, NULL, NULL),
(875, 294, 1, 'test online 1', 10, 1, NULL, NULL, NULL),
(876, 294, 1, 'online 2', 15, 2, NULL, NULL, NULL),
(908, 298, 1, 'AAAA', 5, 1, '829', NULL, NULL),
(909, 298, 1, 'BBB', 6, 1, '794', NULL, NULL),
(910, 298, 1, 'CCC', 8, 1, '777', NULL, NULL),
(911, 301, 1, 'bsbahsha', 1, 1, NULL, NULL, NULL),
(913, 304, 1, 'dkdckfck', 12, 1, NULL, NULL, NULL),
(914, 306, 1, 'dfdfg', 1, 1, NULL, NULL, NULL),
(915, 310, 1, 'floor ', 5, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `servicebenifits`
--

CREATE TABLE `servicebenifits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) DEFAULT NULL,
  `seller_id` bigint(20) DEFAULT NULL,
  `benifits` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `servicebenifits`
--

INSERT INTO `servicebenifits` (`id`, `service_id`, `seller_id`, `benifits`, `created_at`, `updated_at`) VALUES
(46, 17, 5, 'Quality Service', NULL, '2022-02-13 03:45:24'),
(47, 17, 5, 'Service Gurantee', NULL, '2022-02-13 03:45:24'),
(48, 17, 5, 'Schedule Maintain', NULL, '2022-02-13 03:45:24'),
(49, 18, 5, 'Quality Service', NULL, '2022-02-13 03:58:02'),
(50, 18, 5, 'Service Gurantee', NULL, '2022-02-13 03:58:02'),
(51, 18, 5, 'Home Service Available', NULL, '2022-02-13 03:58:02'),
(52, 19, 5, 'Quality Service', NULL, '2022-02-13 03:47:17'),
(54, 19, 5, 'Professional Service', NULL, '2022-02-13 03:47:18'),
(55, 19, 5, 'Home Service', NULL, '2022-02-13 03:47:18'),
(56, 20, 5, 'High Quality Products', NULL, '2022-02-13 03:48:46'),
(57, 20, 5, 'Quality Service', NULL, '2022-02-13 03:48:46'),
(58, 20, 5, 'Home Service Available', NULL, '2022-02-13 03:48:46'),
(103, 49, 1, 'wqeqwe qw eqw', NULL, NULL),
(104, 49, 1, 'werwe wer', NULL, NULL),
(144, 75, 1474, 'profesional', NULL, NULL),
(145, 76, 1, 'your kitchen will be new ', NULL, NULL),
(146, 76, 1, 'blanblaq', NULL, NULL),
(147, 76, 1, 'hhhhh', NULL, NULL),
(148, 79, 1, 'ok', NULL, NULL),
(179, 82, 1, 'Benefit 1', NULL, '2023-01-24 18:46:25'),
(180, 82, 1, 'Benefit 2', NULL, '2023-01-24 18:46:25'),
(183, 82, 1, 'Benefit', NULL, '2023-01-24 18:46:25'),
(184, 82, 1, 'Benefit', NULL, '2023-01-24 18:46:25'),
(185, 83, 1, '434', NULL, NULL),
(186, 83, 1, '3434', NULL, NULL),
(187, 83, 1, 'fdfs', NULL, NULL),
(188, 83, 1, '3434', NULL, NULL),
(189, 83, 1, '34324', NULL, NULL),
(190, 83, 1, '4324', NULL, NULL),
(194, 93, 1, 'Minim id veniam pa', NULL, NULL),
(195, 93, 1, 'Quas eum sint rerum', NULL, NULL),
(197, 113, 1536, 'Benefit Of This Package', NULL, NULL),
(199, 173, 1536, 'two', NULL, NULL),
(200, 173, 1536, 'three', NULL, NULL),
(201, 176, 1536, 'fdsf', NULL, NULL),
(202, 176, 1536, 'ffsdfsd', NULL, NULL),
(203, 176, 1536, 'sdfsdf', NULL, NULL),
(204, 176, 1536, 'fdsfdsf', NULL, NULL),
(205, 176, 1536, 'dsfdsfd', NULL, NULL),
(206, 176, 1536, 'fsdfdsf', NULL, NULL),
(207, 178, 1536, 'one', NULL, NULL),
(208, 178, 1536, 'two', NULL, NULL),
(209, 178, 1536, 'three', NULL, NULL),
(210, 179, 1536, 'fsdfdsf', NULL, NULL),
(211, 179, 1536, 'fsdfdsf', NULL, NULL),
(212, 179, 1536, 'dfdsf', NULL, NULL),
(213, 179, 1536, 'dsfdsf', NULL, NULL),
(214, 188, 1536, NULL, NULL, NULL),
(215, 192, 1536, 'one55', NULL, NULL),
(216, 192, 1536, 'twof55', NULL, NULL),
(217, 192, 1536, 'three', NULL, NULL),
(218, 192, 1536, 'dsfds55', NULL, NULL),
(219, 192, 1536, 'dsf555', NULL, NULL),
(220, 192, 1536, 'dsfdfd55', NULL, NULL),
(221, 192, 1536, 'fdsf 5555', NULL, NULL),
(222, 193, 1536, 'Benefit one ', NULL, NULL),
(223, 193, 1536, 'Benefit two', NULL, NULL),
(224, 193, 1536, 'Benefit three', NULL, NULL),
(225, 193, 1536, 'Benefit four', NULL, NULL),
(226, 194, 1536, '1', NULL, NULL),
(227, 194, 1536, '2', NULL, NULL),
(228, 194, 1536, '3', NULL, NULL),
(229, 194, 1536, '4', NULL, NULL),
(230, 195, 1536, 'one', NULL, NULL),
(231, 195, 1536, 'two', NULL, NULL),
(232, 195, 1536, 'three', NULL, NULL),
(435, 205, 1536, 'Optio fugiat duis ', NULL, NULL),
(436, 205, 1536, 'Incidunt consequatu', NULL, NULL),
(437, 205, 1536, 'Sint autem quaerat n', NULL, NULL),
(438, 205, 1536, 'Sunt possimus ut no', NULL, NULL),
(439, 205, 1536, 'Aut esse rerum saep', NULL, NULL),
(440, 205, 1536, 'Earum qui eius volup', NULL, NULL),
(463, 206, 1536, 'we try to give you the best food experience ', NULL, NULL),
(464, 206, 1536, 'with best service as well', NULL, NULL),
(520, 215, 1542, 'Benefit one', NULL, NULL),
(521, 215, 1542, 'Benefit two', NULL, NULL),
(522, 215, 1542, 'Benefit three', NULL, NULL),
(563, 219, 1, 'fsdf ', NULL, NULL),
(564, 219, 1, 'dsffsd', NULL, NULL),
(565, 219, 1, 'dsfsd', NULL, NULL),
(566, 219, 1, 'fasd ', NULL, NULL),
(567, 219, 1, 'sdf ds', NULL, NULL),
(590, 218, 1, 'dfsdf', NULL, NULL),
(591, 218, 1, 'fsdf', NULL, NULL),
(592, 218, 1, 'dfsdf', NULL, NULL),
(593, 218, 1, 'dfdsf', NULL, NULL),
(594, 218, 1, 'dsfsdf', NULL, NULL),
(775, 239, 1, '7 Page Responsive Design of your choice with speed optimization + On Page SEO Optimization', NULL, NULL),
(776, 239, 1, 'Premium website with E Commerce and 15 Page Responsive Design + Support', NULL, NULL),
(777, 239, 1, 'Plugins/extensions installation', NULL, NULL),
(778, 239, 1, 'Delivery Time 5 days', NULL, NULL),
(791, 240, 1, 'Good cake in the city', NULL, NULL),
(792, 240, 1, 'good food', NULL, NULL),
(793, 242, 1, 'SFDSFDS', NULL, NULL),
(794, 242, 1, 'SDFDFDFS', NULL, NULL),
(795, 242, 1, 'DSFDSFDS', NULL, NULL),
(796, 242, 1, 'FSDFFDSF', NULL, NULL),
(817, 248, 1551, 'gdfgfd', NULL, NULL),
(818, 248, 1551, 'gdfgf', NULL, NULL),
(819, 246, 1, 'all is good', NULL, NULL),
(823, 245, 1, 'This is Good Service one', NULL, NULL),
(824, 245, 1, 'This is Good Service two', NULL, NULL),
(825, 245, 1, 'This is Good Service three', NULL, NULL),
(837, 50, 1, 'Timely Work', NULL, NULL),
(838, 50, 1, 'Professional work', NULL, NULL),
(839, 50, 1, 'Task gurentee', NULL, NULL),
(840, 50, 1, 'Profitable work get', NULL, NULL),
(841, 41, 1, 'Timely work', NULL, NULL),
(842, 41, 1, 'Professional work', NULL, NULL),
(843, 16, 1, 'Service Gurantee', NULL, NULL),
(844, 16, 1, 'Timely Work', NULL, NULL),
(845, 16, 1, 'Quality Service', NULL, NULL),
(858, 2, 1, 'Service Gurantee', NULL, NULL),
(859, 2, 1, 'Quality Service', NULL, NULL),
(860, 6, 1, 'Home Service', NULL, NULL),
(861, 6, 1, 'Service Gurantee', NULL, NULL),
(862, 6, 1, 'Quality Service', NULL, NULL),
(875, 4, 1, 'Service Gurantee', NULL, NULL),
(876, 4, 1, 'Quality Service', NULL, NULL),
(877, 5, 1, 'Quality Service', NULL, NULL),
(878, 5, 1, 'Service Gurantee', NULL, NULL),
(879, 5, 1, 'Timely work', NULL, NULL),
(880, 9, 2, 'Service Guaranty', NULL, NULL),
(881, 9, 2, 'Quality Service', NULL, NULL),
(882, 9, 2, 'Coffee Offer', NULL, NULL),
(883, 8, 2, 'Ouality Service', NULL, NULL),
(884, 8, 2, 'Service Guaranty', NULL, NULL),
(885, 8, 2, 'Service in Home', NULL, NULL),
(886, 12, 2, 'Service Guaranty', NULL, NULL),
(887, 12, 2, 'Quality Service', NULL, NULL),
(888, 12, 2, 'Timely Work', NULL, NULL),
(889, 14, 2, 'Service Guaranty', NULL, NULL),
(890, 14, 2, 'Quality Service', NULL, NULL),
(891, 14, 2, 'Timely Work', NULL, NULL),
(892, 15, 2, 'Service Guaranty', NULL, NULL),
(893, 15, 2, 'Quality Service', NULL, NULL),
(894, 15, 2, 'Timely Work', NULL, NULL),
(898, 13, 2, 'Service Guaranty', NULL, NULL),
(899, 13, 2, 'Quality Service', NULL, NULL),
(900, 13, 2, 'Timely Work', NULL, NULL),
(902, 53, 1, 'Professional Work', NULL, NULL),
(903, 53, 1, 'Work Gurenty', NULL, NULL),
(906, 257, 1, 'cleaning srvises', NULL, NULL),
(907, 1, 1, 'Service Gurantee2', NULL, NULL),
(908, 1, 1, 'Quality Service2', NULL, NULL),
(909, 1, 1, 'Timely Work2', NULL, NULL),
(910, 1, 1, 'Friendly Service Provider', NULL, NULL),
(911, 1, 1, 'customizable', NULL, NULL),
(913, 260, 1677, 'xsss', NULL, NULL),
(914, 259, 1, 'test', NULL, NULL),
(915, 261, 1, 'Zxcv', NULL, NULL),
(925, 36, 1, 'Service Gurantee', NULL, NULL),
(926, 36, 1, 'Quality Service', NULL, NULL),
(927, 36, 1, 'Timely Work', NULL, NULL),
(928, 36, 1, 'Whats Included This Package', NULL, NULL),
(929, 266, 1, 'great for small homes', NULL, NULL),
(930, 266, 1, 'affordable ', NULL, NULL),
(931, 269, 1, 'hzh', NULL, NULL),
(932, 270, 1743, 'Best service ', NULL, NULL),
(933, 272, 1, 'kgysdvjkasdvassssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', NULL, NULL),
(934, 273, 1, 'ea', NULL, NULL),
(935, 280, 1800, 'adfghj', NULL, NULL),
(937, 283, 1, 'home', NULL, NULL),
(941, 7, 1, 'Home Service', NULL, NULL),
(942, 7, 1, 'Service Gurantee', NULL, NULL),
(943, 7, 1, 'Work In Time', NULL, NULL),
(949, 3, 1, 'Service From Home', NULL, NULL),
(950, 3, 1, 'Quality Service', NULL, NULL),
(951, 3, 1, 'Timely Service', NULL, NULL),
(952, 288, 1, 'test benefit', NULL, NULL),
(953, 288, 1, 'benefit 2', NULL, NULL),
(956, 294, 1, 'test online', NULL, NULL),
(957, 294, 1, 'test online 2', NULL, NULL),
(968, 298, 1, 'City', NULL, NULL),
(969, 298, 1, 'Town', NULL, NULL),
(970, 301, 1, 'bdbeb', NULL, NULL),
(972, 304, 1, 'ddkccc', NULL, NULL),
(973, 310, 1, 'window', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `serviceincludes`
--

CREATE TABLE `serviceincludes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) DEFAULT NULL,
  `seller_id` bigint(20) DEFAULT NULL,
  `include_service_title` varchar(191) NOT NULL,
  `include_service_price` double NOT NULL,
  `include_service_quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `serviceincludes`
--

INSERT INTO `serviceincludes` (`id`, `service_id`, `seller_id`, `include_service_title`, `include_service_price`, `include_service_quantity`, `created_at`, `updated_at`) VALUES
(40, 17, 5, 'Hair Cutting and Style', 10, 1, NULL, '2022-02-13 03:45:24'),
(41, 17, 5, 'Dry Wash', 5, 1, NULL, '2022-02-13 03:45:24'),
(42, 18, 5, 'LCD/LED TV Repair Services', 10, 1, NULL, '2022-02-13 03:58:01'),
(43, 18, 5, 'TV Wall Mount Installation', 10, 1, NULL, '2022-02-13 03:58:01'),
(44, 19, 5, '10 Switch Repair', 10, 1, NULL, '2022-02-13 03:47:17'),
(45, 19, 5, '3 Switch Board Repair', 15, 1, NULL, '2022-02-13 03:47:17'),
(46, 20, 5, 'Weeding soft  layer makeup', 100, 1, NULL, '2022-02-13 03:48:45'),
(47, 20, 5, 'Hair Bonding', 10, 1, NULL, '2022-02-13 03:48:46'),
(48, 18, 5, 'TV Full Service', 34, 1, NULL, '2022-02-13 03:58:01'),
(93, 49, 1, 'test', 0, 0, NULL, NULL),
(94, 49, 1, 'test2', 0, 0, NULL, NULL),
(95, 49, 1, 'test3', 0, 0, NULL, NULL),
(141, NULL, 1, 'sdfsdfd', 0, 0, NULL, NULL),
(148, 75, 1474, 'limpieza de habitación ', 0, 0, NULL, NULL),
(149, 76, 1, 'fridge', 0, 0, NULL, NULL),
(150, 76, 1, 'dishes', 0, 0, NULL, NULL),
(151, 76, 1, 'everything you like ', 0, 0, NULL, NULL),
(152, 79, 1, 'i am title', 800, 0, NULL, NULL),
(153, 79, 1, 'i am okaau', 800, 0, NULL, NULL),
(154, 82, 1, 'dfgadsf', 552, 1, NULL, '2023-01-24 18:46:25'),
(156, 83, 1, 'dsf', 433, 1, NULL, NULL),
(157, 83, 1, '3', 434, 1, NULL, NULL),
(158, 83, 1, 'fdsf', 545, 1, NULL, NULL),
(159, 83, 1, 'fsdf', 34324, 1, NULL, NULL),
(160, 93, 1, 'Nobis ut in vitae la', 808, 1, NULL, NULL),
(161, 113, 1536, 'gfdfg fdg fdgf fg', 0, 0, NULL, NULL),
(162, 157, 1536, 'sf', 200, 1, NULL, NULL),
(163, 157, 1536, 'fdsfd', 100, 1, NULL, NULL),
(164, 157, 1536, 'fds', 100, 1, NULL, NULL),
(165, 157, 1536, 'dfds', 100, 1, NULL, NULL),
(166, 158, 1536, 'Car Wash', 150, 1, NULL, NULL),
(167, 158, 1536, 'inner Wash', 40, 1, NULL, NULL),
(168, 158, 1536, 'Dry Wash', 50, 1, NULL, NULL),
(169, 158, 1536, 'Car inner ', 10, 1, NULL, NULL),
(170, 161, 1536, 'fsdf fds d', 120, 1, NULL, NULL),
(171, 161, 1536, 'fdsfdsf', 10, 1, NULL, NULL),
(172, 162, 1536, 'fdfsdfdf gf', 200, 1, NULL, NULL),
(173, 163, 1536, 'fsdfsd fdsf ', 50, 1, NULL, NULL),
(174, 164, 1536, 'fsdfsd fdsf ', 50, 1, NULL, NULL),
(175, 165, 1536, 'fdsfdsf', 20, 1, NULL, NULL),
(176, 166, 1536, 'dfdsfdsf', 20, 1, NULL, NULL),
(177, 167, 1536, 'dfsd ', 10, 1, NULL, NULL),
(178, 168, 1536, 'dfsd ', 10, 1, NULL, NULL),
(179, 169, 1536, 'dfsd ', 10, 1, NULL, NULL),
(180, 170, 1536, 'dfsd af', 55, 1, NULL, NULL),
(181, 171, 1536, 'dsfsd ', 20, 1, NULL, NULL),
(182, 172, 1536, 'dsfdsf', 656, 1, NULL, NULL),
(183, 172, 1536, 'fsdfdsf', 412, 1, NULL, NULL),
(184, 173, 1536, 'fdsfdsf', 10, 1, NULL, NULL),
(185, 173, 1536, 'dsfdsfdfs', 11, 1, NULL, NULL),
(186, 175, 1536, 'fdsfdsf', 20, 1, NULL, NULL),
(187, 176, 1536, 'fdsfdsffsddsfdsf', 55, 1, NULL, NULL),
(188, 176, 1536, 'sdfdsfdsfdsf', 666, 1, NULL, NULL),
(189, 176, 1536, 'dfsdfdsffdsfsdf', 44, 1, NULL, NULL),
(190, 176, 1536, 'fsdfsf', 44, 1, NULL, NULL),
(191, 178, 1536, 'three', 30, 1, NULL, NULL),
(192, 179, 1536, 'fdsfdsffdsf dsf', 55, 1, NULL, NULL),
(193, 179, 1536, 'fsdfsdf dsf sddfds df  fgfg dsf ', 88, 1, NULL, NULL),
(194, 180, 1536, 'dfdsf', 455, 1, NULL, NULL),
(195, 188, 1536, 'Quia molestiae quide', 0, 0, NULL, NULL),
(196, 188, 1536, 'Whats Included This Package', 0, 0, NULL, NULL),
(197, 188, 1536, 'Whats Included This Package', 0, 0, NULL, NULL),
(198, 191, 1536, 'one', 10, 1, NULL, NULL),
(199, 191, 1536, 'two', 20, 1, NULL, NULL),
(200, 191, 1536, 'three', 40, 1, NULL, NULL),
(201, 191, 1536, 'four', 50, 1, NULL, NULL),
(202, 192, 1536, 'Included  one ', 10, 1, NULL, NULL),
(203, 192, 1536, 'Included  two', 20, 1, NULL, NULL),
(204, 192, 1536, 'Included  three', 30, 1, NULL, NULL),
(205, 192, 1536, 'Included  four', 40, 1, NULL, NULL),
(206, 192, 1536, 'gdfgfd', 44, 1, NULL, NULL),
(207, 193, 1536, 'Included  title one ', 0, 0, NULL, NULL),
(208, 193, 1536, 'Included  title two', 0, 0, NULL, NULL),
(209, 193, 1536, 'Included  title three', 0, 0, NULL, NULL),
(210, 193, 1536, 'Included  title  two', 0, 0, NULL, NULL),
(211, 193, 1536, 'Included  title three', 0, 0, NULL, NULL),
(212, 193, 1536, 'Included  title four', 0, 0, NULL, NULL),
(213, 194, 1536, 'Included  one ', 20, 1, NULL, NULL),
(214, 194, 1536, 'Included  two', 30, 1, NULL, NULL),
(215, 194, 1536, 'Included  three', 40, 1, NULL, NULL),
(216, 194, 1536, 'Included  four', 50, 1, NULL, NULL),
(217, 195, 1536, 'one ', 0, 0, NULL, NULL),
(218, 195, 1536, 'two ', 0, 0, NULL, NULL),
(219, 195, 1536, 'three', 0, 0, NULL, NULL),
(220, 196, 1536, 'trtdtrt', 0, 0, NULL, NULL),
(221, 196, 1536, 'rttrrtrdt', 0, 0, NULL, NULL),
(222, 196, 1536, 'rrrrdttdt', 0, 0, NULL, NULL),
(336, 201, 1536, 'title one gfg', 555, 1, NULL, NULL),
(362, 204, 1536, 'fdsf ', 444, 1, NULL, NULL),
(393, 205, 1536, 'fsdf ', 44, 1, NULL, NULL),
(422, 206, 1536, 'Rice for one person', 500, 1, NULL, NULL),
(423, 206, 1536, 'Chicken fry', 66, 1, NULL, NULL),
(424, 206, 1536, 'rrt', 0, 1, NULL, NULL),
(497, 207, 1536, 'fdsfsdfsd', 0, 1, NULL, NULL),
(498, 207, 1536, 'fdsfd', 0, 1, NULL, NULL),
(499, 207, 1536, 'dsfsdfs', 0, 1, NULL, NULL),
(500, 212, 1540, 'fsdf d', 44, 1, NULL, NULL),
(550, 215, 1542, 'Included  Title one ', 15, 1, NULL, NULL),
(551, 215, 1542, 'Included  title two ', 20, 1, NULL, NULL),
(555, 213, 1, 'title ', 0, 1, NULL, NULL),
(584, 219, 1, 'fsdfsdfs ds', 0, 1, NULL, NULL),
(585, 219, 1, 'fsd ', 0, 1, NULL, NULL),
(586, 219, 1, 'sd sdf ', 0, 1, NULL, NULL),
(622, 218, 1, 'fdsfsd', 0, 1, NULL, NULL),
(623, 218, 1, 'sdfsdf', 0, 1, NULL, NULL),
(624, 218, 1, 'fsdf', 0, 1, NULL, NULL),
(1145, 239, 1, 'Wp-Bakery Page builder 2', 20, 1, NULL, NULL),
(1146, 239, 1, 'PSD to WordPress Design ', 30, 1, NULL, NULL),
(1147, 239, 1, 'Website Design Customization', 40, 1, NULL, NULL),
(1148, 239, 1, 'Content uploading ', 50, 1, NULL, NULL),
(1156, 242, 1, 'FSDFSDFDSDFDSF', 55, 1, NULL, NULL),
(1157, 242, 1, 'FDSAFDFASDF', 66, 1, NULL, NULL),
(1158, 242, 1, 'RRR ', 500, 1, NULL, NULL),
(1159, 244, 1, 'Vero sint dolore ut  ', 0, 0, NULL, NULL),
(1163, 247, 1551, 'Fancy Car Drive ', 50, 1, NULL, NULL),
(1181, 248, 1551, 'dfgfd', 444, 1, NULL, NULL),
(1182, 246, 1, 'Mobile full body change ', 90, 1, NULL, NULL),
(1183, 246, 1, 'Mobile Cover change ', 50, 1, NULL, NULL),
(1184, 246, 1, 'Mobile light update ', 20, 1, NULL, NULL),
(1191, 245, 1, 'Free Service Any time ', 0, 0, NULL, NULL),
(1192, 245, 1, 'Display Service Any time ', 0, 0, NULL, NULL),
(1193, 245, 1, 'Changer Service Any time ', 0, 0, NULL, NULL),
(1196, 255, 1, 'dasd', 21, 1, NULL, NULL),
(1200, 50, 1, 'Business Module Build', 0, 0, NULL, NULL),
(1201, 50, 1, 'Reach Your Customer', 0, 0, NULL, NULL),
(1202, 50, 1, 'Branding Your Business', 0, 0, NULL, NULL),
(1203, 50, 1, 'Get Business Logic', 0, 0, NULL, NULL),
(1204, 41, 1, 'Branding your company', 0, 0, NULL, NULL),
(1205, 41, 1, 'Key scereet of success', 0, 0, NULL, NULL),
(1206, 41, 1, 'Business plans', 0, 0, NULL, NULL),
(1207, 16, 1, 'Car Cleaning', 12, 1, NULL, NULL),
(1208, 16, 1, 'Car Washing', 5, 1, NULL, NULL),
(1214, 2, 1, 'Ac Repair', 30, 1, NULL, NULL),
(1215, 6, 1, 'One Ton AC', 10, 1, NULL, NULL),
(1216, 6, 1, 'Two Ton AC', 15, 1, NULL, NULL),
(1223, 4, 1, '5 Seater Sofa', 5, 1, NULL, NULL),
(1224, 4, 1, '3 Seater Sofa', 4, 1, NULL, NULL),
(1225, 5, 1, 'Table Cleaning', 3.4, 1, NULL, NULL),
(1226, 5, 1, 'Floor Cleaning (1)', 20, 1, NULL, NULL),
(1227, 9, 2, 'Hair Cutting Boys', 5, 1, NULL, NULL),
(1228, 9, 2, 'Hair Cutting Girls', 5, 1, NULL, NULL),
(1229, 8, 2, 'Full Body Massage', 10, 1, NULL, NULL),
(1230, 8, 2, 'Partial Body Massage', 5, 1, NULL, NULL),
(1231, 12, 2, 'Car Wash', 10, 1, NULL, NULL),
(1232, 12, 2, 'Car inner Dry Wash', 20, 1, NULL, NULL),
(1233, 14, 2, 'Switch Change', 1, 1, NULL, NULL),
(1234, 14, 2, 'Selling Fan Repair', 5, 1, NULL, NULL),
(1235, 14, 2, 'Lighting', 1, 1, NULL, NULL),
(1236, 15, 2, 'Fridge', 5, 1, NULL, NULL),
(1237, 15, 2, 'TV', 5, 1, NULL, NULL),
(1238, 15, 2, 'Single Bed', 5, 1, NULL, NULL),
(1239, 15, 2, 'Double Bed', 6, 1, NULL, NULL),
(1243, 13, 2, '2 Seater Sofa', 15, 1, NULL, NULL),
(1244, 13, 2, '3 Seater Sofa', 17, 1, NULL, NULL),
(1245, 13, 2, '4 Seater Sofa', 18, 1, NULL, NULL),
(1248, 53, 1, 'test', 0, 1, NULL, NULL),
(1249, 53, 1, 'test', 0, 1, NULL, NULL),
(1252, 257, 1, 'cleaning  1 room', 11, 1, NULL, NULL),
(1256, 258, 1, 'CREATION BOITE 3D', 0, 1, NULL, NULL),
(1257, 1, 1, '2 Child Room', 50, 1, NULL, NULL),
(1258, 1, 1, '2 Guest Room', 41, 1, NULL, NULL),
(1260, 260, 1677, 'hshhshs', 100, 1, NULL, NULL),
(1261, 259, 1, 'home test', 20, 1, NULL, NULL),
(1262, 261, 1, 'zaSasx', 0, 0, NULL, NULL),
(1263, 262, 1, 'Hhj', 199, 1, NULL, NULL),
(1268, 36, 1, 'Room Cleaning 15 sf', 75, 1, NULL, NULL),
(1271, 265, 1, 'online ', 0, 0, NULL, NULL),
(1272, 266, 1, 'home cleaning - 3 hour package', 500, 1, NULL, NULL),
(1273, 267, 1, 'sss', 1000, 1, NULL, NULL),
(1274, 268, 1, 'sdfdf', 150, 1, NULL, NULL),
(1275, 269, 1, '..', 0, 1, NULL, NULL),
(1276, 270, 1743, 'svvc', 299, 1, NULL, NULL),
(1277, 271, 1, '', 0, 0, NULL, NULL),
(1279, 272, 1, 'Deneme ', 0, 0, NULL, NULL),
(1280, 273, 1, 'egaerg', 0, 0, NULL, NULL),
(1283, 276, 1, 'testtest', 200, 1, NULL, NULL),
(1284, 278, 1, 'Bath Room', 350, 1, NULL, NULL),
(1285, 279, 1, 'Hahahahahahahahahahah', 10000, 1, NULL, NULL),
(1286, 280, 1800, 'qer', 100, 1, NULL, NULL),
(1287, 281, 1, 'cvcvcv', 0, 0, NULL, NULL),
(1289, 282, 1, 'HVAC Inspection', 100, 1, NULL, NULL),
(1291, 283, 1, 'JavaScript ', 0, 1, NULL, NULL),
(1292, 285, 1, 'Web', 200, 1, NULL, NULL),
(1294, 7, 1, 'Wall Painting 12x12', 100, 1, NULL, NULL),
(1296, 287, 1, 'Repair', 1, 1, NULL, NULL),
(1300, 3, 1, 'Beard Cutting By Machine', 0, 1, NULL, NULL),
(1301, 3, 1, 'Beard Shave', 0, 1, NULL, NULL),
(1302, 288, 1, 'test online service', 0, 1, NULL, NULL),
(1303, 289, 1, 'a-z errands ', 10, 1, NULL, NULL),
(1307, 290, 1, 'gdasfg', 0, 0, NULL, NULL),
(1308, 290, 1, 'yasdalkj', 0, 0, NULL, NULL),
(1309, 291, 1, 'umzug 2 Mann', 450, 1, NULL, NULL),
(1310, 292, 1, 'aerdfgsbdft', 0, 0, NULL, NULL),
(1313, 293, 1, 'XCC', 87, 1, NULL, NULL),
(1316, 294, 1, 'onine 1', 0, 1, NULL, NULL),
(1317, 294, 1, 'online 2', 0, 1, NULL, NULL),
(1318, 295, 1, 'fsdfsweere', 33, 1, NULL, NULL),
(1325, 297, 1, 'hI', 0, 0, NULL, NULL),
(1326, 299, 4, 'testtt', 200, 1, NULL, NULL),
(1328, 300, 1, 'Camera', 5, 1, NULL, NULL),
(1338, 298, 1, 'AFD', 0, 0, NULL, NULL),
(1339, 298, 1, 'DDD', 0, 0, NULL, NULL),
(1340, 298, 1, 'CCC', 0, 0, NULL, NULL),
(1341, 301, 1, 'hshahs', 0, 1, NULL, NULL),
(1342, 302, 1, 'testttt', 50, 1, NULL, NULL),
(1343, 303, 1, 'hhhhhhhh eeeeeee ', 500, 1, NULL, NULL),
(1345, 304, 1, 'sdiffckcc', 0, 1, NULL, NULL),
(1346, 306, 1, 'test', 0, 0, NULL, NULL),
(1348, 274, 1, 'àhhh', 250, 1, NULL, NULL),
(1349, 310, 1, 'floor', 0, 1, NULL, NULL),
(1350, 309, 1, 'SRC Merkezi', 0, 1, NULL, NULL),
(1351, 311, 1, 'fff', 42, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `subcategory_id` bigint(20) DEFAULT NULL,
  `child_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `seller_id` bigint(20) DEFAULT NULL,
  `service_city_id` bigint(20) DEFAULT NULL,
  `service_area_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `image_gallery` text DEFAULT NULL,
  `video` longtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `is_service_on` tinyint(4) NOT NULL DEFAULT 1,
  `price` double NOT NULL DEFAULT 0,
  `online_service_price` double NOT NULL DEFAULT 0,
  `delivery_days` bigint(20) NOT NULL DEFAULT 0,
  `revision` bigint(20) NOT NULL DEFAULT 0,
  `is_service_online` tinyint(4) NOT NULL DEFAULT 0,
  `is_service_all_cities` tinyint(4) NOT NULL DEFAULT 0,
  `tax` double DEFAULT 0,
  `view` int(11) NOT NULL DEFAULT 0,
  `sold_count` bigint(20) NOT NULL DEFAULT 0,
  `featured` tinyint(4) DEFAULT 0,
  `admin_id` int(11) DEFAULT NULL,
  `guard_name` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `category_id`, `subcategory_id`, `child_category_id`, `seller_id`, `service_city_id`, `service_area_id`, `title`, `slug`, `description`, `image`, `image_gallery`, `video`, `status`, `is_service_on`, `price`, `online_service_price`, `delivery_days`, `revision`, `is_service_online`, `is_service_all_cities`, `tax`, `view`, `sold_count`, `featured`, `admin_id`, `guard_name`, `created_at`, `updated_at`) VALUES
(365, 1, NULL, NULL, 1, 1, 1, 'صيانة عامة', 'syan-aaam', '<p>نقدم خدمات صيانة وإصلاح متكاملة وشاملة لجميع احتياجاتك اليومية والمستقبلية. فريقنا المختص والمحترف يضمن لك الحصول على أفضل النتائج بأسرع وقت ممكن وبأعلى جودة. نحن نستخدم أحدث التقنيات والأدوات المتطورة لضمان جودة عالية في جميع أعمالنا. خبرتنا الواسعة في المجال تجعلنا قادرين على حل أي مشكلة مهما كانت معقدة.</p><p><br></p><p>لماذا تختارنا:</p><ul><li>خبرة واسعة تمتد لسنوات عديدة في المجال</li><li>فريق محترف ومدرب على أعلى المستويات</li><li>أحدث المعدات والتقنيات الحديثة والمتطورة</li><li>أسعار شفافة وعادلة ومناسبة لجميع الفئات</li><li>ضمان شامل ومضمون على جميع الأعمال المنجزة</li><li>خدمة سريعة وفعالة في جميع الأوقات</li><li>متابعة مستمرة بعد إتمام العمل</li><li>التزام تام بالمواعيد والجودة</li></ul>', '912', '912', NULL, 1, 1, 300, 400, 7, 2, 0, 1, 7, 1, 0, 0, NULL, NULL, '2025-11-16 07:51:55', '2025-12-08 07:02:36'),
(366, 1, NULL, NULL, 1, 1, 1, 'صيانة كهربائية', 'syan-khrbayy', '<p>نوفر خدمات صيانة وإصلاح متخصصة وشاملة لجميع احتياجاتك في مختلف المجالات. فريقنا المحترف والمعتمد يضمن لك الحصول على أفضل الخدمات بأعلى معايير الجودة والكفاءة. نحن نستخدم أحدث التقنيات والأدوات المتطورة لضمان نتائج ممتازة في جميع أعمالنا. خبرتنا الواسعة في السوق تجعلنا قادرين على التعامل مع جميع أنواع المشاكل بسرعة وكفاءة.</p><p><br></p><p>مميزاتنا:</p><ul><li>سرعة فائقة في التنفيذ والإنجاز</li><li>جودة عالية جداً في الأداء والنتائج</li><li>أسعار مناسبة ومنافسة في السوق</li><li>ضمان شامل ومضمون على جميع الأعمال</li><li>فريق محترف ومدرب على أحدث التقنيات</li><li>خدمة عملاء ممتازة ومتابعة مستمرة</li><li>استخدام قطع غيار أصلية وموثوقة</li><li>التزام تام بالمواعيد والجودة المطلوبة</li></ul>', '911', '911', NULL, 1, 1, 300, 150, 4, 4, 0, 1, 7, 1, 2, 0, NULL, NULL, '2025-11-16 07:51:55', '2025-12-08 07:02:29'),
(367, 1, NULL, NULL, 1, 1, 1, 'صيانة سباكة', 'syan-sbak', '<p>خدمات صيانة وإصلاح شاملة ومتكاملة لجميع احتياجاتك. فريقنا من الخبراء المعتمدين والمدربين يضمن لك الحصول على أفضل النتائج بأسرع وقت ممكن. نحن نستخدم أحدث التقنيات والأدوات المتطورة لضمان جودة عالية في جميع أعمالنا. خبرتنا الطويلة في السوق تجعلنا الخيار الأمثل لجميع احتياجاتك في مجال الصيانة والإصلاح.</p><p><br></p><p>خدماتنا المميزة:</p><ul><li>فحص شامل وتشخيص دقيق للمشكلة</li><li>إصلاح وصيانة احترافية بجودة عالية</li><li>استبدال القطع التالفة بقطع أصلية</li><li>ضمان شامل على جميع الأعمال</li><li>خدمة عملاء على مدار الساعة</li><li>أسعار شفافة ومنافسة</li><li>استخدام أحدث المعدات والتقنيات</li><li>فريق محترف ومدرب</li></ul>', '910', '910', NULL, 1, 1, 400, 200, 2, 4, 0, 1, 7, 2, 0, 0, NULL, NULL, '2025-11-16 07:51:55', '2025-12-08 07:02:29'),
(368, 1, NULL, NULL, 1, 1, 1, 'صيانة تكييف', 'syan-tkyyf', '<p>خدمات صيانة وإصلاح احترافية مع ضمان الجودة والكفاءة. نحن نقدم حلولاً شاملة ومتكاملة لجميع مشاكلك مع فريق من الخبراء المعتمدين والمدربين. نضمن لك خدمة ممتازة وأسعار مناسبة مع ضمان شامل على جميع الأعمال المنجزة. خبرتنا الطويلة في السوق تجعلنا الخيار الأول للعديد من العملاء الراضين عن خدماتنا.</p><p><br></p><p>خدماتنا تشمل:</p><ul><li>تشخيص دقيق وشامل للمشكلة</li><li>إصلاح وصيانة احترافية بجودة عالية</li><li>استبدال القطع التالفة بقطع أصلية</li><li>فحص شامل بعد الإصلاح</li><li>نصائح وإرشادات للصيانة الدورية</li><li>خدمة متابعة مستمرة</li><li>استخدام أحدث الأدوات والمعدات</li><li>فريق محترف متاح على مدار الساعة</li></ul>', '909', '909', NULL, 1, 1, 200, 350, 4, 3, 0, 1, 7, 2, 0, 0, NULL, NULL, '2025-11-16 07:51:55', '2025-12-08 07:02:30'),
(369, 1, NULL, NULL, 1, 1, 1, 'صيانة أجهزة منزلية', 'syan-aghz-mnzly', '<p>نوفر خدمات صيانة وإصلاح شاملة ومتكاملة لجميع احتياجاتك اليومية. فريقنا من الفنيين المعتمدين والمحترفين جاهز لتقديم أفضل الخدمات بأعلى معايير الجودة والسلامة. نحن نضمن لك خدمة سريعة وفعالة مع ضمان شامل على جميع الأعمال المنجزة. خبرتنا الواسعة في المجال تمكننا من التعامل مع جميع أنواع الأعطال والمشاكل بسرعة وكفاءة عالية.</p><p><br></p><p>تشمل خدماتنا:</p><ul><li>فحص شامل وتشخيص دقيق للمشكلة</li><li>إصلاح وصيانة احترافية بجودة عالية</li><li>استبدال القطع التالفة بقطع أصلية وموثوقة</li><li>ضمان شامل على جميع الأعمال المنجزة</li><li>خدمة عملاء على مدار الساعة طوال أيام الأسبوع</li><li>أسعار شفافة ومنافسة في السوق</li><li>استخدام أحدث المعدات والتقنيات الحديثة</li><li>فريق محترف ومدرب على أعلى المستويات</li></ul>', '907', '907', NULL, 1, 1, 100, 300, 5, 2, 0, 1, 7, 2, 0, 0, NULL, NULL, '2025-11-16 07:51:55', '2025-12-15 11:24:13'),
(370, 1, NULL, NULL, 1, 1, 1, 'صيانة بناء وترميم', 'syan-bnaaa-otrmym', '<p>نقدم خدمات صيانة وإصلاح متكاملة بأسعار مناسبة وجودة عالية. فريقنا من الفنيين المحترفين والمعتمدين جاهز لتقديم أفضل الخدمات في جميع الأوقات. نحن نضمن لك خدمة سريعة وفعالة مع ضمان شامل على جميع الأعمال المنجزة. خبرتنا الواسعة في المجال تمكننا من التعامل مع جميع أنواع الأعطال والمشاكل بسرعة وكفاءة عالية.</p><p><br></p><p>ما يميزنا:</p><ul><li>خدمة سريعة وفعالة في جميع الأوقات</li><li>جودة عالية ومضمونة في جميع الأعمال</li><li>أسعار مناسبة ومنافسة في السوق</li><li>ضمان شامل على جميع الأعمال المنجزة</li><li>فريق محترف ومدرب على أعلى المستويات</li><li>استخدام أحدث المعدات والتقنيات</li><li>قطع غيار أصلية وموثوقة</li><li>متابعة مستمرة بعد إتمام العمل</li></ul>', '908', '904', NULL, 1, 1, 100, 500, 1, 1, 0, 1, 7, 1, 0, 0, NULL, NULL, '2025-11-16 07:51:55', '2025-12-08 07:02:36'),
(371, 1, NULL, NULL, 1, 1, 1, 'صيانة دهان وديكور', 'syan-dhan-odykor', '<p>خدمات احترافية متخصصة في مجال الصيانة والإصلاح بجميع أنواعها. نقدم حلولاً شاملة ومبتكرة لجميع مشاكلك مع فريق من الخبراء المعتمدين والمدربين. نحن نلتزم بأعلى معايير الجودة والكفاءة في تنفيذ جميع الأعمال. خبرتنا الطويلة في السوق تجعلنا الخيار الأمثل لجميع احتياجاتك في مجال الصيانة والإصلاح.</p><p><br></p><p>مميزات خدماتنا:</p><ul><li>سرعة فائقة في الاستجابة والتنفيذ</li><li>جودة عالية جداً في الأداء والنتائج</li><li>أسعار مناسبة ومنافسة في السوق المحلي</li><li>ضمان شامل ومضمون على جميع الأعمال</li><li>فريق محترف ومدرب على أحدث التقنيات</li><li>خدمة عملاء ممتازة ومتابعة مستمرة</li><li>استخدام قطع غيار أصلية وموثوقة</li><li>التزام بالمواعيد المحددة مسبقاً</li></ul>', '906', '906', NULL, 1, 1, 250, 250, 2, 4, 0, 1, 7, 3, 0, 0, NULL, NULL, '2025-11-16 07:51:55', '2025-12-08 07:02:33'),
(372, 1, NULL, NULL, 1, 1, 1, 'صيانة نجارة', 'syan-ngar', '<p>خدمات احترافية متخصصة في مجال الصيانة والإصلاح بجميع أنواعها. نقدم حلولاً شاملة ومبتكرة لجميع مشاكلك مع فريق من الخبراء المعتمدين والمدربين. نحن نلتزم بأعلى معايير الجودة والكفاءة في تنفيذ جميع الأعمال. خبرتنا الطويلة في السوق تجعلنا الخيار الأمثل لجميع احتياجاتك في مجال الصيانة والإصلاح.</p><p><br></p><p>مميزات خدماتنا:</p><ul><li>سرعة فائقة في الاستجابة والتنفيذ</li><li>جودة عالية جداً في الأداء والنتائج</li><li>أسعار مناسبة ومنافسة في السوق المحلي</li><li>ضمان شامل ومضمون على جميع الأعمال</li><li>فريق محترف ومدرب على أحدث التقنيات</li><li>خدمة عملاء ممتازة ومتابعة مستمرة</li><li>استخدام قطع غيار أصلية وموثوقة</li><li>التزام بالمواعيد المحددة مسبقاً</li></ul>', '905', '905', NULL, 1, 1, 150, 500, 1, 3, 0, 1, 7, 5, 0, 0, NULL, NULL, '2025-11-16 07:51:55', '2025-12-08 07:02:36');

-- --------------------------------------------------------

--
-- Table structure for table `service_areas`
--

CREATE TABLE `service_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_area` varchar(191) NOT NULL,
  `service_city_id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_areas`
--

INSERT INTO `service_areas` (`id`, `service_area`, `service_city_id`, `country_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dhanmondi', 1, 1, 1, '2021-12-05 03:59:13', '2021-12-07 00:11:54'),
(2, 'FarmGate New', 1, 1, 1, '2021-12-05 04:15:40', '2021-12-11 00:36:10'),
(6, 'Southdarm', 3, 3, 1, '2021-12-05 05:47:12', '2021-12-07 00:11:05'),
(7, 'Wales & Seea', 2, 2, 1, '2021-12-07 00:28:08', '2021-12-07 00:28:08'),
(8, 'Jenerio Street', 2, 2, 1, '2022-02-16 10:18:24', '2022-02-16 10:18:24'),
(9, 'Floda Kings', 2, 2, 1, '2022-02-16 10:18:51', '2022-02-16 10:18:51'),
(10, 'DC Town', 3, 3, 1, '2022-02-16 10:19:12', '2022-02-16 10:19:12'),
(11, 'Anthenio Caderis', 3, 3, 1, '2022-02-16 10:19:42', '2022-02-16 10:19:42'),
(12, 'Mirpur', 1, 1, 1, '2022-02-16 10:20:02', '2022-02-16 10:20:02'),
(13, 'Kazi Para', 1, 1, 1, '2022-02-16 10:20:38', '2022-02-16 10:20:38'),
(14, 'Mosi Mosi', 9, 4, 1, '2022-02-16 10:22:43', '2022-02-16 10:22:43'),
(15, 'Nemeosmo Street', 9, 4, 1, '2022-02-16 10:23:10', '2022-02-16 10:23:10'),
(16, 'Alderio 44/2 North', 9, 4, 1, '2022-02-16 10:23:48', '2022-02-16 10:23:48'),
(17, 'Kings Star 55 Road', 8, 5, 1, '2022-02-16 10:24:58', '2022-02-16 10:24:58'),
(18, 'New Ketlin Park', 8, 5, 1, '2022-02-16 10:25:25', '2022-02-16 10:25:25'),
(19, 'West Dumpin', 8, 5, 1, '2022-02-16 10:26:01', '2022-02-16 10:26:01'),
(20, 'Serinjith Road', 7, 6, 1, '2022-02-16 10:26:42', '2022-02-16 10:26:42'),
(21, 'Super Shop  Town Road', 7, 6, 1, '2022-02-16 10:27:25', '2022-02-16 10:27:25'),
(22, 'Belochi', 7, 6, 1, '2022-02-16 10:27:36', '2022-02-16 10:27:36'),
(23, 'Lerio De Beeks 69', 12, 7, 1, '2022-02-16 10:28:24', '2022-02-16 10:28:24'),
(24, 'Serjio Lipo Eskaton', 12, 7, 1, '2022-02-16 10:29:02', '2022-02-16 10:29:02'),
(25, 'Kaka Del Road', 12, 7, 1, '2022-02-16 10:29:45', '2022-02-16 10:29:45'),
(26, 'Kandy House', 11, 8, 1, '2022-02-16 10:30:22', '2022-02-16 10:30:22'),
(27, 'National Park 44/3', 11, 8, 1, '2022-02-16 10:30:45', '2022-02-16 10:30:45'),
(28, 'New Street Jersy', 11, 8, 1, '2022-02-16 10:31:08', '2022-02-16 10:31:08'),
(29, 'Dilkotech  Area', 10, 9, 1, '2022-02-16 10:31:43', '2022-02-16 10:31:43'),
(30, 'Jela Sultanpur', 10, 9, 1, '2022-02-16 10:33:22', '2022-02-16 10:33:22'),
(31, 'Karinabath', 10, 9, 1, '2022-02-16 10:33:44', '2022-02-16 10:33:44'),
(32, 'Mohammadpur', 1, 1, 1, '2022-02-16 10:35:07', '2022-02-16 10:35:07'),
(33, 'Sheowrapara', 1, 1, 1, '2022-02-16 10:35:40', '2022-02-16 10:35:40'),
(34, 'Andheri East', 15, 6, 1, '2022-02-27 02:51:47', '2022-02-27 02:51:47'),
(35, 'Andheri West', 15, 6, 1, '2022-02-27 02:52:14', '2022-02-27 02:52:14'),
(36, 'Band Stand', 15, 6, 1, '2022-02-27 02:53:25', '2022-02-27 02:53:25'),
(37, 'Agrabad', 14, 1, 1, '2022-02-27 02:54:14', '2022-02-27 02:54:14'),
(38, 'Pahartoli', 14, 1, 1, '2022-02-27 02:54:37', '2022-02-27 02:54:37'),
(39, 'Olongkar', 14, 1, 1, '2022-02-27 02:55:21', '2022-02-27 02:55:21'),
(40, 'Chaina Town', 16, 2, 1, '2022-02-27 02:57:25', '2022-02-27 02:57:25'),
(41, 'Penn Quarter', 16, 2, 1, '2022-02-27 02:58:01', '2022-02-27 02:58:01'),
(42, 'Moston', 17, 3, 1, '2022-02-27 03:00:01', '2022-02-27 03:00:01'),
(43, 'Gorton', 17, 3, 1, '2022-02-27 03:00:24', '2022-02-27 03:00:24'),
(44, 'Eastern Beaches', 18, 5, 1, '2022-02-27 03:08:44', '2022-02-27 03:08:44'),
(45, 'Randwick', 18, 5, 1, '2022-02-27 03:09:32', '2022-02-27 03:09:32'),
(46, 'Pendik', 19, 10, 1, '2022-02-27 03:11:02', '2022-02-27 03:11:02'),
(47, 'Umraniya', 19, 10, 1, '2022-02-27 03:11:16', '2022-02-27 03:11:16'),
(48, 'Uskudar', 19, 10, 1, '2022-02-27 03:12:28', '2022-02-27 03:12:28'),
(49, 'Afsar', 20, 10, 1, '2022-02-27 03:14:17', '2022-02-27 03:14:17'),
(50, 'Ayas', 20, 10, 1, '2022-02-27 03:14:42', '2022-02-27 03:14:42'),
(51, 'Elbatho North', 20, 10, 1, '2022-02-27 03:15:17', '2022-02-27 03:15:17'),
(52, 'City Center', 21, 10, 1, '2022-02-27 03:16:31', '2022-02-27 03:16:31'),
(53, 'Edirne', 21, 10, 1, '2022-02-27 03:17:14', '2022-02-27 03:17:14'),
(54, 'Konya', 20, 10, 1, '2022-02-27 03:17:38', '2022-02-27 03:17:38'),
(55, 'Berjio Leren', 22, 11, 1, '2022-02-27 03:19:25', '2022-02-27 03:19:25'),
(56, 'City West 39', 22, 11, 1, '2022-02-27 03:19:53', '2022-02-27 03:19:53'),
(57, 'Neuenhagen', 23, 11, 1, '2022-02-27 03:22:07', '2022-02-27 03:22:07'),
(58, 'Floda Kings', 23, 11, 1, '2022-02-27 03:25:58', '2022-02-27 03:25:58'),
(59, 'Kazi Para', 23, 11, 1, '2022-02-27 03:26:33', '2022-02-27 03:26:33'),
(60, 'Bavaria', 24, 11, 1, '2022-02-27 03:31:01', '2022-02-27 03:31:01'),
(61, 'Anthenio Caderis', 24, 11, 1, '2022-02-27 03:31:21', '2022-02-27 03:31:21'),
(62, 'City North', 25, 12, 1, '2022-02-27 03:33:43', '2022-02-27 03:33:43'),
(63, 'Partholi Sana', 25, 12, 1, '2022-02-27 03:34:14', '2022-02-27 03:34:14'),
(64, 'Paris Square', 25, 12, 1, '2022-02-27 03:34:38', '2022-02-27 03:34:38'),
(65, 'Lyon East', 26, 12, 1, '2022-02-27 03:35:43', '2022-02-27 03:35:43'),
(66, 'Jenerio Street', 26, 12, 1, '2022-02-27 03:36:06', '2022-02-27 03:36:06'),
(67, 'Auvergne', 27, 12, 1, '2022-02-27 03:36:50', '2022-02-27 03:36:50'),
(68, 'Languedoc', 27, 12, 1, '2022-02-27 03:37:22', '2022-02-27 03:37:22'),
(69, 'Brittany', 27, 12, 1, '2022-02-27 03:37:46', '2022-02-27 03:37:46'),
(70, 'Begoma', 28, 13, 1, '2022-02-27 03:38:19', '2022-02-27 03:38:19'),
(71, 'Corso Del Popolu', 28, 13, 1, '2022-02-27 03:38:58', '2022-02-27 03:38:58'),
(72, 'Anthenio Caderis', 28, 13, 1, '2022-02-27 03:39:13', '2022-02-27 03:39:13'),
(73, 'Palermo', 29, 13, 1, '2022-02-27 03:39:36', '2022-02-27 03:39:36'),
(74, 'Kelaro Do  Penki', 29, 13, 1, '2022-02-27 03:40:11', '2022-02-27 03:40:11'),
(75, 'Florance', 30, 13, 1, '2022-02-27 03:40:35', '2022-02-27 03:40:35'),
(76, 'Grandhe', 30, 13, 1, '2022-02-27 03:40:53', '2022-02-27 03:40:53'),
(77, 'Kiambu', 31, 14, 1, '2022-02-27 03:42:25', '2022-02-27 03:42:25'),
(78, 'Kasarani', 31, 14, 1, '2022-02-27 03:43:06', '2022-02-27 03:43:06'),
(79, 'Kabete', 31, 14, 1, '2022-02-27 03:43:43', '2022-02-27 03:43:43'),
(80, 'Kisanu', 32, 14, 1, '2022-02-27 03:48:03', '2022-02-27 03:48:03'),
(81, 'Nyali', 32, 14, 1, '2022-02-27 03:48:30', '2022-02-27 03:48:30'),
(82, 'Likoni', 32, 14, 1, '2022-02-27 03:49:22', '2022-02-27 03:49:22'),
(83, 'Wilson', 33, 14, 1, '2022-02-27 03:51:16', '2022-02-27 03:51:16'),
(84, 'Aerodrome', 33, 14, 1, '2022-02-27 03:51:53', '2022-02-27 03:51:53'),
(85, 'Zayed City', 34, 15, 1, '2022-02-27 03:58:17', '2022-02-27 03:58:17'),
(86, 'Al Danah', 34, 15, 1, '2022-02-27 03:58:42', '2022-02-27 03:58:42'),
(87, 'Sheikha Fatima Park', 34, 15, 1, '2022-02-27 04:00:27', '2022-02-27 04:00:27'),
(88, 'Abu Dhabi Mall', 34, 15, 1, '2022-02-27 04:01:56', '2022-02-27 04:01:56'),
(89, 'Al Qasba', 35, 15, 1, '2022-02-27 04:03:19', '2022-02-27 04:03:19'),
(90, 'Blue Souk', 35, 15, 1, '2022-02-27 04:03:38', '2022-02-27 04:03:38'),
(91, 'Sharjah Aquarium', 35, 15, 1, '2022-02-27 04:04:10', '2022-02-27 04:04:10'),
(92, 'Global Village Dubai', 36, 15, 1, '2022-02-27 04:06:58', '2022-02-27 04:06:58'),
(93, 'Palm Jumeirah', 36, 15, 1, '2022-02-27 04:08:10', '2022-02-27 04:08:10'),
(94, 'Dubai Marina', 36, 15, 1, '2022-02-27 04:08:47', '2022-02-27 04:08:47'),
(95, 'Dhow Cruise', 36, 15, 1, '2022-02-27 04:09:33', '2022-02-27 04:09:33'),
(96, 'Ankara Castle', 20, 10, 1, '2022-02-27 04:11:24', '2022-02-27 04:11:24'),
(97, '   Panthapath', 3, 1, 1, '2022-10-24 07:31:19', '2022-10-24 07:31:19'),
(98, '   Dhanmondi', 3, 1, 1, '2022-10-24 07:31:19', '2022-10-24 07:31:19'),
(99, '   Kalabagan', 3, 1, 1, '2022-10-24 07:31:19', '2022-10-24 07:31:19'),
(100, '   Nilkhet', 3, 1, 1, '2022-10-24 07:31:19', '2022-10-24 07:31:19'),
(101, '   Panthapath', 11, 4, 1, '2022-10-24 07:34:20', '2022-10-24 07:34:20'),
(102, '   Dhanmondi', 11, 4, 1, '2022-10-24 07:34:21', '2022-10-24 07:34:21'),
(103, '   Kalabagan', 11, 4, 1, '2022-10-24 07:34:21', '2022-10-24 07:34:21'),
(104, '   Nilkhet', 11, 4, 1, '2022-10-24 07:34:21', '2022-10-24 07:34:21'),
(105, '   Panthapath', 30, 13, 1, '2022-10-24 07:57:13', '2022-10-24 07:57:13'),
(106, '   Dhanmondi', 30, 13, 1, '2022-10-24 07:57:13', '2022-10-24 07:57:13'),
(107, '   Kalabagan', 30, 13, 1, '2022-10-24 07:57:13', '2022-10-24 07:57:13'),
(108, '   Nilkhet', 30, 13, 1, '2022-10-24 07:57:13', '2022-10-24 07:57:13'),
(109, 'Santiago Area', 10150, 68, 1, '2023-04-14 23:55:00', '2023-04-14 23:55:00'),
(110, 'الشرائع', 50, NULL, 1, '2025-11-16 09:43:09', '2025-11-16 09:43:09');

-- --------------------------------------------------------

--
-- Table structure for table `service_cities`
--

CREATE TABLE `service_cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_city` varchar(191) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_cities`
--

INSERT INTO `service_cities` (`id`, `service_city`, `country_id`, `status`, `created_at`, `updated_at`) VALUES
(50, 'مكة المكرمة', 1, 1, '2025-11-14 22:38:29', '2025-11-14 22:38:29');

-- --------------------------------------------------------

--
-- Table structure for table `service_coupons`
--

CREATE TABLE `service_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) NOT NULL,
  `discount` double DEFAULT NULL,
  `discount_type` varchar(191) DEFAULT NULL,
  `expire_date` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=inactive 1=active',
  `seller_id` bigint(20) DEFAULT NULL,
  `user_type` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_coupons`
--

INSERT INTO `service_coupons` (`id`, `code`, `discount`, `discount_type`, `expire_date`, `status`, `seller_id`, `user_type`, `created_at`, `updated_at`) VALUES
(1, 'Home10', 10, 'percentage', '2022-10-19', 1, 1, NULL, '2022-01-17 05:11:14', '2022-06-02 15:59:18'),
(2, 'Coupon30', 30, 'amount', '2022-03-30', 1, 1, NULL, '2022-01-17 05:12:06', '2022-02-16 10:39:56'),
(4, 'Home15', 15, 'percentage', '2022-01-23', 0, 2, NULL, '2022-01-17 08:29:58', '2022-01-17 08:29:58'),
(6, 'test', 12, 'percentage', '2022-03-15', 0, 1, NULL, '2022-03-02 00:47:37', '2022-03-02 00:47:37'),
(7, 'Coupon11', 8, 'percentage', '2022-03-15', 0, 1, NULL, '2022-03-02 01:43:05', '2022-03-02 01:44:34'),
(8, '2022', 33, 'amount', '2023-05-26', 0, 1, NULL, '2023-05-03 22:30:43', '2023-05-03 22:30:43'),
(9, 'erw', 33, 'amount', '2023-10-27', 0, 1, NULL, '2023-05-03 22:30:57', '2023-05-03 22:30:57'),
(10, 'dsfds', 3, 'percentage', '2023-12-30', 0, 1, NULL, '2023-05-03 22:31:08', '2023-05-03 22:31:08'),
(11, 'fdfs3', 3, 'percentage', '2023-06-10', 0, 1, NULL, '2023-05-03 22:31:17', '2023-05-03 22:31:17'),
(12, '2022', 33, 'amount', '2023-06-10', 0, 1, NULL, '2023-05-03 22:31:27', '2023-05-03 22:31:27'),
(13, '2022', 3, 'amount', '2023-06-10', 0, 1, NULL, '2023-05-03 22:31:35', '2023-05-03 22:31:35'),
(14, '2022', 3, 'amount', '2023-06-02', 0, 1, NULL, '2023-05-03 22:31:44', '2023-05-03 22:31:44'),
(15, '2022', 10, 'percentage', '2024-10-31', 1, 1, NULL, '2023-05-03 22:31:56', '2023-05-28 02:00:07'),
(16, '2023L0', 9, 'amount', '2023-06-10', 1, 1, NULL, '2023-05-03 22:46:53', '2023-05-03 22:55:03'),
(17, 'hasib123', 10, 'percentage', '2024-08-23', 1, 1, NULL, '2023-05-28 02:01:16', '2023-07-06 05:58:48');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `background_image` varchar(191) NOT NULL,
  `title` varchar(191) NOT NULL,
  `sub_title` varchar(191) NOT NULL,
  `service_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `background_image`, `title`, `sub_title`, `service_id`, `created_at`, `updated_at`) VALUES
(1, '209', 'Get our Offers', 'Offers are available at affordable price', NULL, '2022-04-20 00:20:23', '2022-06-01 16:58:08'),
(2, '210', 'Get our Offers', 'Offers are available at affordable price', NULL, '2022-04-20 00:28:51', '2022-06-01 16:58:34'),
(3, '211', 'Get our Offers', 'Offers are available at affordable price', NULL, '2022-06-01 16:58:41', '2022-06-01 16:58:41');

-- --------------------------------------------------------

--
-- Table structure for table `social_icons`
--

CREATE TABLE `social_icons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(191) NOT NULL,
  `url` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_icons`
--

INSERT INTO `social_icons` (`id`, `icon`, `url`, `created_at`, `updated_at`) VALUES
(1, 'lab la-facebook-f', '#', '2021-08-27 22:38:07', '2021-11-03 02:21:03'),
(2, 'lab la-instagram', '#', '2021-08-27 22:38:28', '2021-11-03 02:21:13'),
(3, 'lab la-twitter', '#', '2021-08-27 22:40:08', '2021-11-03 02:21:23'),
(4, 'lab la-linkedin-in', '#', '2021-08-27 22:40:22', '2021-11-03 02:21:32');

-- --------------------------------------------------------

--
-- Table structure for table `static_options`
--

CREATE TABLE `static_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `option_name` varchar(191) NOT NULL,
  `option_value` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `static_options`
--

INSERT INTO `static_options` (`id`, `option_name`, `option_value`, `created_at`, `updated_at`) VALUES
(210, 'extra-light-color', NULL, '2021-12-30 09:38:18', '2021-12-30 09:38:18'),
(367, 'home_page', '48', '2022-02-14 09:27:14', '2023-11-23 07:19:25'),
(368, 'blog_page', '35', '2022-02-14 09:27:14', '2023-11-23 07:19:25'),
(369, 'service_list_page', NULL, '2022-02-14 09:27:14', '2023-11-23 07:19:26'),
(370, 'paypal_preview_logo', '444', '2022-02-14 09:42:57', '2023-07-29 01:39:48'),
(371, 'paypal_mode', NULL, '2022-02-14 09:42:58', '2023-07-29 01:39:48'),
(372, 'paypal_sandbox_client_id', 'AUP7AuZMwJbkee-2OmsSZrU-ID1XUJYE-YB-2JOrxeKV-q9ZJZYmsr-UoKuJn4kwyCv5ak26lrZyb-gb', '2022-02-14 09:42:58', '2023-07-29 01:39:48'),
(373, 'paypal_sandbox_client_secret', 'EEIxCuVnbgING9EyzcF2q-gpacLneVbngQtJ1mbx-42Lbq-6Uf6PEjgzF7HEayNsI4IFmB9_CZkECc3y', '2022-02-14 09:42:58', '2023-07-29 01:39:48'),
(374, 'paypal_sandbox_app_id', '641651651958', '2022-02-14 09:42:58', '2023-07-29 01:39:48'),
(375, 'paypal_live_app_id', NULL, '2022-02-14 09:42:58', '2023-07-29 01:39:48'),
(376, 'paypal_payment_action', NULL, '2022-02-14 09:42:58', '2023-07-29 01:39:48'),
(377, 'paypal_currency', NULL, '2022-02-14 09:42:58', '2023-07-29 01:39:48'),
(378, 'paypal_notify_url', NULL, '2022-02-14 09:42:58', '2023-07-29 01:39:48'),
(379, 'paypal_locale', NULL, '2022-02-14 09:42:58', '2023-07-29 01:39:48'),
(380, 'paypal_validate_ssl', NULL, '2022-02-14 09:42:58', '2023-07-29 01:39:48'),
(381, 'paypal_live_client_id', NULL, '2022-02-14 09:42:58', '2023-07-29 01:39:48'),
(382, 'paypal_live_client_secret', NULL, '2022-02-14 09:42:58', '2023-07-29 01:39:48'),
(383, 'paypal_gateway', NULL, '2022-02-14 09:42:58', '2023-07-29 01:39:48'),
(384, 'paypal_test_mode', NULL, '2022-02-14 09:42:58', '2023-07-29 01:39:48'),
(385, 'razorpay_preview_logo', '470', '2022-02-14 09:42:58', '2023-07-29 01:39:48'),
(386, 'razorpay_key', NULL, '2022-02-14 09:42:58', '2023-07-29 01:39:48'),
(387, 'razorpay_secret', NULL, '2022-02-14 09:42:58', '2023-07-29 01:39:48'),
(388, 'razorpay_api_key', 'rzp_test_SXk7LZqsBPpAkj', '2022-02-14 09:42:58', '2023-07-29 01:39:48'),
(389, 'razorpay_api_secret', 'Nenvq0aYArtYBDOGgmMH7JNv', '2022-02-14 09:42:58', '2023-07-29 01:39:48'),
(390, 'razorpay_gateway', 'on', '2022-02-14 09:42:58', '2023-07-29 01:39:48'),
(391, 'stripe_preview_logo', '748', '2022-02-14 09:42:58', '2023-07-29 01:39:48'),
(392, 'stripe_publishable_key', NULL, '2022-02-14 09:42:58', '2023-07-29 01:39:48'),
(393, 'stripe_secret_key', 'sk_test_51GwS1SEmGOuJLTMs2vhSliTwAGkOt4fKJMBrxzTXeCJoLrRu8HFf4I0C5QuyE3l3bQHBJm3c0qFmeVjd0V9nFb6Z00VrWDJ9Uw', '2022-02-14 09:42:58', '2023-07-29 01:39:48'),
(394, 'stripe_public_key', 'pk_test_51GwS1SEmGOuJLTMsIeYKFtfAT3o3Fc6IOC7wyFmmxA2FIFQ3ZigJ2z1s4ZOweKQKlhaQr1blTH9y6HR2PMjtq1Rx00vqE8LO0x', '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(395, 'stripe_gateway', 'on', '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(396, 'paytm_gateway', 'on', '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(397, 'paytm_preview_logo', '448', '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(398, 'paytm_merchant_key', NULL, '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(399, 'paytm_merchant_mid', NULL, '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(400, 'paytm_merchant_website', NULL, '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(401, 'paytm_test_mode', 'on', '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(402, 'paystack_merchant_email', 'sopnilsohan03@gmail.com', '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(403, 'paystack_preview_logo', '476', '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(404, 'paystack_public_key', 'pk_test_a7e58f850adce9a73750e61668d4f492f67abcd9', '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(405, 'paystack_secret_key', 'sk_test_2a458001d806c878aba51955b962b3c8ed78f04b', '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(406, 'paystack_gateway', 'on', '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(407, 'mollie_preview_logo', '749', '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(408, 'mollie_public_key', 'test_fVk76gNbAp6ryrtRjfAVvzjxSHxC2v', '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(409, 'mollie_gateway', 'on', '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(410, 'marcado_pagp_client_id', NULL, '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(411, 'marcado_pago_client_secret', 'TEST-4644184554273630-070813-7d817e2ca1576e75884001d0755f8a7a-786499991', '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(412, 'marcado_pago_test_mode', NULL, '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(413, 'cash_on_delivery_gateway', 'on', '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(414, 'cash_on_delivery_preview_logo', '513', '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(415, 'flutterwave_preview_logo', '479', '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(416, 'flutterwave_gateway', 'on', '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(417, 'flw_public_key', 'FLWPUBK_TEST-86cce2ec43c63e09a517290a8347fcab-X', '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(418, 'flw_secret_key', 'FLWSECK_TEST-d37a42d8917db84f1b2f47c125252d0a-X', '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(419, 'flw_secret_hash', 'fundorex', '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(420, 'midtrans_preview_logo', '478', '2022-02-14 09:42:59', '2023-07-29 01:39:48'),
(421, 'midtrans_merchant_id', 'G770543580', '2022-02-14 09:43:00', '2023-07-29 01:39:48'),
(422, 'midtrans_server_key', 'SB-Mid-server-9z5jztsHyYxEdSs7DgkNg2on', '2022-02-14 09:43:00', '2023-07-29 01:39:48'),
(423, 'midtrans_client_key', 'SB-Mid-client-iDuy-jKdZHkLjL_I', '2022-02-14 09:43:00', '2023-07-29 01:39:49'),
(424, 'midtrans_environment', NULL, '2022-02-14 09:43:00', '2023-07-29 01:39:49'),
(425, 'midtrans_gateway', 'on', '2022-02-14 09:43:00', '2023-07-29 01:39:49'),
(426, 'midtrans_test_mode', 'on', '2022-02-14 09:43:00', '2023-07-29 01:39:49'),
(427, 'payfast_preview_logo', '458', '2022-02-14 09:43:00', '2023-07-29 01:39:49'),
(428, 'payfast_merchant_id', '10023791', '2022-02-14 09:43:00', '2023-07-29 01:39:49'),
(429, 'payfast_merchant_key', '733jmbxs2kbj5', '2022-02-14 09:43:00', '2023-07-29 01:39:49'),
(430, 'payfast_passphrase', 'dvrobin4', '2022-02-14 09:43:00', '2023-07-29 01:39:49'),
(431, 'payfast_merchant_env', NULL, '2022-02-14 09:43:00', '2023-07-29 01:39:49'),
(432, 'payfast_itn_url', NULL, '2022-02-14 09:43:00', '2023-07-29 01:39:49'),
(433, 'payfast_gateway', 'on', '2022-02-14 09:43:00', '2023-07-29 01:39:49'),
(434, 'cashfree_preview_logo', '485', '2022-02-14 09:43:00', '2023-07-29 01:39:49'),
(435, 'cashfree_test_mode', 'on', '2022-02-14 09:43:00', '2023-07-29 01:39:49'),
(436, 'cashfree_app_id', '94527832f47d6e74fa6ca5e3c72549', '2022-02-14 09:43:00', '2023-07-29 01:39:49'),
(437, 'cashfree_secret_key', 'ec6a3222018c676e95436b2e26e89c1ec6be2830', '2022-02-14 09:43:00', '2023-07-29 01:39:49'),
(438, 'cashfree_gateway', 'on', '2022-02-14 09:43:00', '2023-07-29 01:39:49'),
(439, 'instamojo_preview_logo', '486', '2022-02-14 09:43:00', '2023-07-29 01:39:49'),
(440, 'instamojo_client_id', 'test_nhpJ3RvWObd3uryoIYF0gjKby5NB5xu6S9Z', '2022-02-14 09:43:00', '2023-07-29 01:39:49'),
(441, 'instamojo_client_secret', 'test_iZusG4P35maQVPTfqutbCc6UEbba3iesbCbrYM7zOtDaJUdbPz76QOnBcDgblC53YBEgsymqn2sx3NVEPbl3b5coA3uLqV1ikxKquOeXSWr8Ruy7eaKUMX1yBbm', '2022-02-14 09:43:00', '2023-07-29 01:39:49'),
(442, 'instamojo_username', NULL, '2022-02-14 09:43:00', '2023-07-29 01:39:49'),
(443, 'instamojo_password', NULL, '2022-02-14 09:43:00', '2023-07-29 01:39:49'),
(444, 'instamojo_test_mode', 'on', '2022-02-14 09:43:00', '2023-07-29 01:39:49'),
(445, 'instamojo_gateway', 'on', '2022-02-14 09:43:00', '2023-07-29 01:39:49'),
(446, 'marcadopago_preview_logo', '487', '2022-02-14 09:43:01', '2023-07-29 01:39:49'),
(447, 'marcado_pago_client_id', 'TEST-0a3cc78a-57bf-4556-9dbe-2afa06347769', '2022-02-14 09:43:01', '2023-07-29 01:39:49'),
(448, 'marcadopago_gateway', 'on', '2022-02-14 09:43:01', '2023-07-29 01:39:49'),
(449, 'marcadopago_test_mode', 'on', '2022-02-14 09:43:01', '2023-07-29 01:39:49'),
(450, 'site_global_currency', 'SAR', '2022-02-14 09:43:01', '2025-11-14 22:35:11'),
(451, 'site_global_payment_gateway', NULL, '2022-02-14 09:43:01', '2023-07-29 01:39:49'),
(452, 'site_manual_payment_name', 'Bank Transfer', '2022-02-14 09:43:01', '2023-07-29 01:39:49'),
(453, 'site_manual_payment_description', '<p>this is manual payment description example</p>', '2022-02-14 09:43:01', '2023-07-29 01:39:49'),
(454, 'manual_payment_preview_logo', '490', '2022-02-14 09:43:01', '2023-07-29 01:39:49'),
(455, 'manual_payment_gateway', 'on', '2022-02-14 09:43:01', '2023-07-29 01:39:49'),
(456, 'site_usd_to_ngn_exchange_rate', NULL, '2022-02-14 09:43:01', '2023-07-29 01:39:49'),
(457, 'site_euro_to_ngn_exchange_rate', NULL, '2022-02-14 09:43:01', '2023-07-29 01:39:49'),
(458, 'site_currency_symbol_position', 'right', '2022-02-14 09:43:01', '2025-11-14 22:35:11'),
(459, 'site_default_payment_gateway', 'manual_payment', '2022-02-14 09:43:01', '2023-07-29 01:39:49'),
(460, 'site_usd_to_idr_exchange_rate', '14349.45', '2022-02-14 09:43:01', '2023-07-29 01:39:50'),
(461, 'site_usd_to_inr_exchange_rate', '75.04', '2022-02-14 09:43:01', '2023-07-29 01:39:50'),
(462, 'site_usd_to_zar_exchange_rate', '14.40', '2022-02-14 09:43:01', '2023-07-29 01:39:50'),
(463, 'site_usd_to_brl_exchange_rate', '5.53', '2022-02-14 09:43:01', '2023-07-29 01:39:50'),
(464, 'site_usd_to_usd_exchange_rate', NULL, '2022-02-14 09:43:01', '2023-07-29 01:39:50'),
(465, 'site_logo', '914', '2022-02-14 14:09:41', '2025-12-08 06:30:52'),
(466, 'site_white_logo', '914', '2022-02-14 14:09:41', '2025-12-08 06:30:52'),
(467, 'site_favicon', '914', '2022-02-14 14:09:41', '2025-12-08 06:30:52'),
(468, 'site_title', 'SyanaTech', '2022-02-14 14:10:45', '2025-11-14 19:30:47'),
(469, 'site_tag_line', 'Services', '2022-02-14 14:10:45', '2025-11-14 19:30:47'),
(470, 'site_footer_copyright', 'All copyright {copy} {year} Reserved', '2022-02-14 14:10:45', '2025-11-14 19:30:47'),
(471, 'language_select_option', NULL, '2022-02-14 14:10:46', '2025-11-14 19:30:47'),
(472, 'disable_user_email_verify', 'on', '2022-02-14 14:10:46', '2025-11-14 19:30:47'),
(473, 'site_main_color', NULL, '2022-02-14 14:10:46', '2025-11-14 19:30:47'),
(474, 'site_secondary_color', NULL, '2022-02-14 14:10:46', '2025-11-14 19:30:47'),
(475, 'site_maintenance_mode', NULL, '2022-02-14 14:10:46', '2025-11-14 19:30:47'),
(476, 'admin_loader_animation', NULL, '2022-02-14 14:10:46', '2025-11-14 19:30:47'),
(477, 'site_loader_animation', 'on', '2022-02-14 14:10:46', '2025-11-14 19:30:47'),
(478, 'admin_panel_rtl_status', NULL, '2022-02-14 14:10:46', '2025-11-14 19:30:47'),
(479, 'site_force_ssl_redirection', NULL, '2022-02-14 14:10:46', '2025-11-14 19:30:47'),
(480, 'site_google_captcha_enable', NULL, '2022-02-14 14:10:46', '2025-11-14 19:30:47'),
(481, 'body_font_family', 'Source Sans Pro', '2022-02-15 02:54:15', '2025-11-17 20:16:19'),
(482, 'heading_font_family', 'Laila', '2022-02-15 02:54:15', '2025-11-17 20:16:19'),
(483, 'extra_body_font', NULL, '2022-02-15 02:54:15', '2025-11-17 20:16:19'),
(484, 'heading_font', 'on', '2022-02-15 02:54:15', '2025-11-17 20:16:19'),
(485, 'body_font_variant', 'a:3:{i:0;s:5:\"0,200\";i:1;s:5:\"0,400\";i:2;s:5:\"0,600\";}', '2022-02-15 02:54:15', '2025-11-17 20:16:19'),
(486, 'heading_font_variant', 'a:1:{i:0;s:7:\"regular\";}', '2022-02-15 02:54:15', '2025-11-17 20:16:19'),
(487, 'body_font_family_three', NULL, '2022-02-15 02:54:15', '2025-11-17 20:16:19'),
(488, 'body_font_family_four', NULL, '2022-02-15 02:54:15', '2025-11-17 20:16:19'),
(489, 'body_font_family_five', NULL, '2022-02-15 02:54:15', '2025-11-17 20:16:19'),
(490, 'body_font_variant_three', 'a:1:{i:0;s:3:\"400\";}', '2022-02-15 02:54:15', '2025-11-17 20:16:19'),
(491, 'body_font_variant_four', 'a:1:{i:0;s:3:\"400\";}', '2022-02-15 02:54:15', '2025-11-17 20:16:19'),
(492, 'body_font_variant_five', 'a:1:{i:0;s:3:\"400\";}', '2022-02-15 02:54:15', '2025-11-17 20:16:19'),
(493, 'global_navbar_variant', '02', '2022-02-15 03:27:32', '2022-02-15 03:27:32'),
(494, 'maintain_page_title', 'Sorry  we are down for schedule maintenance right now !!', '2022-02-15 04:40:12', '2022-02-15 04:51:24'),
(495, 'maintain_page_description', NULL, '2022-02-15 04:40:12', '2022-02-15 04:51:24'),
(496, 'maintenance_duration', '2022-02-17', '2022-02-15 04:40:12', '2022-02-15 04:51:24'),
(497, 'maintain_page_logo', '126', '2022-02-15 04:40:12', '2022-02-15 04:40:12'),
(498, 'maintain_page_background_image', '117', '2022-02-15 04:51:24', '2022-02-15 04:51:24'),
(499, 'site_global_email', 'info@syanatech.com', '2022-02-15 18:58:44', '2025-12-15 12:57:15'),
(500, 'site_global_email_template', 'ssdf', '2022-02-15 18:58:44', '2022-02-15 18:58:44'),
(501, 'site_smtp_mail_mailer', 'smtp', '2022-02-15 19:34:53', '2022-02-15 20:16:18'),
(502, 'site_smtp_mail_host', NULL, '2022-02-15 19:34:53', '2022-02-15 20:16:18'),
(503, 'site_smtp_mail_port', '465', '2022-02-15 19:34:53', '2022-02-15 20:16:18'),
(504, 'site_smtp_mail_username', NULL, '2022-02-15 19:34:53', '2022-02-15 20:16:18'),
(505, 'site_smtp_mail_password', NULL, '2022-02-15 19:34:53', '2022-02-15 20:16:18'),
(506, 'site_smtp_mail_encryption', 'tls', '2022-02-15 19:34:53', '2022-02-15 20:16:18'),
(507, 'error_404_page_title', 'Page Not Found', '2022-02-16 23:33:50', '2022-02-16 23:33:50'),
(508, 'error_404_page_subtitle', 'Page Unavailable!!', '2022-02-16 23:33:51', '2022-02-16 23:33:51'),
(509, 'error_404_page_paragraph', NULL, '2022-02-16 23:33:51', '2022-02-16 23:33:51'),
(510, 'error_404_page_button_text', 'Back To Home', '2022-02-16 23:33:51', '2022-02-16 23:33:51'),
(511, 'error_image', '123', '2022-02-16 23:33:51', '2022-02-16 23:33:51'),
(512, 'site_admin_dark_mode', 'off', '2022-02-17 17:14:17', '2025-11-17 20:05:16'),
(513, 'success_title', 'تم الطلب', '2022-02-17 17:30:46', '2023-01-25 16:30:24'),
(514, 'success_subtitle', 'تم إكمال طلبك بنجاح', '2022-02-17 17:30:46', '2023-01-25 16:30:24'),
(515, 'success_details_title', 'تفاصيل طلبك', '2022-02-17 17:30:46', '2023-01-25 16:30:24'),
(516, 'button_title', 'العودة للصفحة الرئيسية', '2022-02-17 17:30:46', '2023-01-25 16:30:24'),
(517, 'button_url', 'http://localhost', '2022-02-17 17:30:46', '2023-01-25 16:30:24'),
(518, 'site_disqus_key', NULL, '2022-02-27 11:26:14', '2022-04-21 03:57:38'),
(519, 'site_google_analytics', NULL, '2022-02-27 11:26:14', '2022-04-21 03:57:38'),
(520, 'tawk_api_key', NULL, '2022-02-27 11:26:14', '2022-04-21 03:57:38'),
(521, 'site_third_party_tracking_code', NULL, '2022-02-27 11:26:14', '2022-04-21 03:57:38'),
(522, 'site_google_captcha_v3_site_key', NULL, '2022-02-27 11:26:14', '2022-04-21 03:57:38'),
(523, 'site_google_captcha_v3_secret_key', NULL, '2022-02-27 11:26:14', '2022-04-21 03:57:38'),
(524, 'enable_google_login', 'on', '2022-02-27 11:26:14', '2022-04-21 03:57:38'),
(525, 'google_client_id', NULL, '2022-02-27 11:26:14', '2022-04-21 03:57:38'),
(526, 'google_client_secret', NULL, '2022-02-27 11:26:14', '2022-04-21 03:57:38'),
(527, 'enable_facebook_login', 'on', '2022-02-27 11:26:14', '2022-04-21 03:57:39'),
(528, 'facebook_client_id', NULL, '2022-02-27 11:26:14', '2022-04-21 03:57:39'),
(529, 'facebook_client_secret', NULL, '2022-02-27 11:26:14', '2022-04-21 03:57:39'),
(530, 'google_adsense_publisher_id', NULL, '2022-02-27 11:26:14', '2022-04-21 03:57:39'),
(531, 'google_adsense_customer_id', NULL, '2022-02-27 11:26:14', '2022-04-21 03:57:39'),
(532, 'enable_google_adsense', NULL, '2022-02-27 11:26:14', '2022-04-21 03:57:39'),
(533, 'instagram_access_token', NULL, '2022-02-27 11:26:14', '2022-04-21 03:57:39'),
(534, 'site_script_version', '1.8.0', '2022-03-02 22:10:16', '2023-07-23 02:44:20'),
(535, 'site_gdpr_cookie_en_GB_title', 'Cookies & Privacy', '2022-03-28 12:17:23', '2022-03-28 12:17:24'),
(536, 'site_gdpr_cookie_en_GB_message', 'Is education residence conveying so so. Suppose shyness say ten behaved morning had. Any unsatiable assistance compliment occasional too reasonably advantages.', '2022-03-28 12:17:24', '2022-03-28 12:17:24'),
(537, 'site_gdpr_cookie_en_GB_more_info_label', 'More information', '2022-03-28 12:17:24', '2022-03-28 12:17:24'),
(538, 'site_gdpr_cookie_en_GB_more_info_link', '{url}/privacy-policy', '2022-03-28 12:17:24', '2022-03-28 12:17:24'),
(539, 'site_gdpr_cookie_en_GB_accept_button_label', 'Accept', '2022-03-28 12:17:24', '2022-03-28 12:17:24'),
(540, 'site_gdpr_cookie_en_GB_decline_button_label', 'Decline', '2022-03-28 12:17:24', '2022-03-28 12:17:24'),
(541, 'site_gdpr_cookie_en_GB_manage_button_label', 'Manage', '2022-03-28 12:17:24', '2022-03-28 12:17:24'),
(542, 'site_gdpr_cookie_en_GB_manage_title', 'Manage Cookie', '2022-03-28 12:17:24', '2022-03-28 12:17:24'),
(543, 'site_gdpr_cookie_en_GB_manage_item_title', 'a:1:{i:0;N;}', '2022-03-28 12:17:24', '2022-03-28 12:17:24'),
(544, 'site_gdpr_cookie_en_GB_manage_item_description', 'a:1:{i:0;N;}', '2022-03-28 12:17:24', '2022-03-28 12:17:24'),
(545, 'site_gdpr_cookie_delay', '5000', '2022-03-28 12:17:24', '2025-11-16 08:52:26'),
(546, 'site_gdpr_cookie_enabled', NULL, '2022-03-28 12:17:24', '2025-11-16 08:52:26'),
(547, 'site_gdpr_cookie_expire', '30', '2022-03-28 12:17:24', '2025-11-16 08:52:26'),
(548, 'site_gdpr_cookie_title', 'Cookies & Privacy', '2022-03-28 12:23:49', '2025-11-16 08:52:26'),
(549, 'site_gdpr_cookie_message', 'Is education residence conveying so so. Suppose shyness say ten behaved morning had. Any unsatiable assistance compliment occasional too reasonably advantages.', '2022-03-28 12:23:49', '2025-11-16 08:52:26'),
(550, 'site_gdpr_cookie_more_info_label', 'More information', '2022-03-28 12:23:49', '2025-11-16 08:52:26'),
(551, 'site_gdpr_cookie_more_info_link', '{url}/privacy-policy', '2022-03-28 12:23:49', '2025-11-16 08:52:26'),
(552, 'site_gdpr_cookie_accept_button_label', 'Accept', '2022-03-28 12:23:49', '2025-11-16 08:52:26'),
(553, 'site_gdpr_cookie_decline_button_label', 'Decline', '2022-03-28 12:23:49', '2025-11-16 08:52:26'),
(554, 'site_gdpr_cookie_manage_button_label', 'Manage', '2022-03-28 12:23:49', '2025-11-16 08:52:26'),
(555, 'site_gdpr_cookie_manage_title', NULL, '2022-03-28 12:23:49', '2025-11-16 08:52:26'),
(556, 'site_gdpr_cookie_manage_item_title', 'a:3:{i:0;s:16:\"Site Preferences\";i:1;s:9:\"Analytics\";i:2;s:9:\"Marketing\";}', '2022-03-28 12:23:49', '2025-11-16 08:52:26'),
(557, 'site_gdpr_cookie_manage_item_description', 'a:3:{i:0;s:111:\"These are cookies that are related to your site preferences, e.g. remembering your username, site colours, etc.\";i:1;s:51:\"Cookies related to site visits, browser types, etc.\";i:2;s:65:\"Cookies related to marketing, e.g. newsletters, social media, etc\";}', '2022-03-28 12:23:49', '2025-11-16 08:52:26'),
(565, 'site_main_color_one', 'rgb(255, 107, 44)', '2022-04-08 10:31:08', '2023-07-13 06:12:39'),
(566, 'site_main_color_two', 'rgb(77, 119, 255)', '2022-04-08 10:31:08', '2023-07-13 06:12:39'),
(567, 'site_main_color_three', 'rgb(255, 107, 44)', '2022-04-08 10:31:08', '2023-07-13 06:12:39'),
(568, 'heading_color', 'rgb(51, 51, 51)', '2022-04-08 10:31:08', '2023-07-13 06:12:39'),
(569, 'light_color', 'rgb(102, 102, 102)', '2022-04-08 10:31:08', '2023-07-13 06:12:39'),
(570, 'extra_light_color', 'rgb(153, 153, 153)', '2022-04-08 10:31:08', '2023-07-13 06:12:39'),
(571, 'service_create_settings', 'verified_seller', '2022-04-21 02:50:29', '2023-05-21 23:21:51'),
(572, 'service_main_attribute_title', NULL, '2022-04-21 04:26:18', '2023-07-17 19:12:05'),
(573, 'service_additional_attribute_title', NULL, '2022-04-21 04:26:18', '2023-07-17 19:12:05'),
(574, 'service_benifits_title', NULL, '2022-04-21 04:26:18', '2023-07-17 19:12:05'),
(575, 'service_booking_title', NULL, '2022-04-21 04:26:18', '2023-07-17 19:12:05'),
(576, 'service_appoinment_package_title', NULL, '2022-04-21 04:26:18', '2023-07-17 19:12:05'),
(577, 'service_package_fee_title', NULL, '2022-04-21 04:26:18', '2023-07-17 19:12:05'),
(578, 'service_extra_title', NULL, '2022-04-21 04:26:18', '2023-07-17 19:12:05'),
(579, 'service_subtotal_title', NULL, '2022-04-21 04:26:18', '2023-07-17 19:12:05'),
(580, 'service_total_amount_title', NULL, '2022-04-21 04:26:18', '2023-07-17 19:12:05'),
(581, 'service_available_date_title', NULL, '2022-04-21 04:26:18', '2023-07-17 19:12:05'),
(582, 'service_available_schudule_title', NULL, '2022-04-21 04:26:18', '2023-07-17 19:12:05'),
(583, 'service_booking_information_title', NULL, '2022-04-21 04:26:18', '2023-07-17 19:12:05'),
(584, 'service_order_confirm_title', NULL, '2022-04-21 04:26:18', '2023-07-17 19:12:05'),
(585, 'terms_and_conditions_link', NULL, '2022-04-21 04:34:16', '2023-07-17 19:12:05'),
(586, 'login_form_title', 'Sign In', '2022-04-27 04:04:35', '2023-01-24 12:00:35'),
(587, 'register_page_title', 'Register For Join With Us', '2022-04-27 04:04:35', '2023-01-24 12:00:35'),
(588, 'register_seller_title', 'Seller', '2022-04-27 04:04:35', '2023-01-24 12:00:35'),
(589, 'register_buyer_title', 'Buyer', '2022-04-27 04:04:35', '2023-01-24 12:00:35'),
(590, 'enable_disable_decimal_point', 'no', '2022-06-26 05:10:08', '2025-11-14 22:35:11'),
(591, 'site_eur_to_usd_exchange_rate', NULL, '2022-06-26 05:10:08', '2023-07-22 05:35:51'),
(592, 'site_eur_to_idr_exchange_rate', NULL, '2022-06-26 07:02:08', '2023-07-22 05:40:03'),
(593, 'site_eur_to_inr_exchange_rate', NULL, '2022-06-26 07:02:08', '2023-07-22 05:40:03'),
(594, 'site_eur_to_ngn_exchange_rate', NULL, '2022-06-26 07:02:08', '2023-07-22 05:40:03'),
(595, 'site_eur_to_zar_exchange_rate', NULL, '2022-06-26 07:02:08', '2023-07-22 05:40:03'),
(596, 'site_eur_to_brl_exchange_rate', NULL, '2022-06-26 07:02:08', '2023-07-22 05:40:03'),
(597, 'site_inr_to_usd_exchange_rate', NULL, '2022-08-03 04:42:05', '2022-08-03 04:42:05'),
(598, 'site_inr_to_idr_exchange_rate', NULL, '2022-08-03 04:45:10', '2022-08-03 04:45:10'),
(599, 'site_inr_to_inr_exchange_rate', NULL, '2022-08-03 04:45:10', '2022-08-03 04:45:10'),
(600, 'site_inr_to_ngn_exchange_rate', NULL, '2022-08-03 04:45:10', '2022-08-03 04:45:10'),
(601, 'site_inr_to_zar_exchange_rate', NULL, '2022-08-03 04:45:10', '2022-08-03 04:45:10'),
(602, 'site_inr_to_brl_exchange_rate', NULL, '2022-08-03 04:45:10', '2022-08-03 04:45:10'),
(603, 'set_number_of_connect', '2', '2022-09-03 05:21:51', '2022-09-03 05:21:51'),
(604, 'package_expire_notify_mail_days', '[\"1\",\"3\",\"7\"]', '2022-09-03 05:44:51', '2022-09-05 02:08:11'),
(605, 'select_terms_condition_page', 'shorout-wa-al-ahkam', '2022-09-08 05:55:51', '2025-11-16 09:12:45'),
(606, 'zitopay_username', 'dvrobin4', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(607, 'zitopay_preview_logo', '488', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(608, 'zitopay_gateway', 'on', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(609, 'zitopay_test_mode', 'on', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(610, 'billplz_collection_name', 'kjj5ya006', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(611, 'billplz_xsignature', 'S-HDXHxRJB-J7rNtoktZkKJg', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(612, 'billplz_key', 'b2ead199-e6f3-4420-ae5c-c94f1b1e8ed6', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(613, 'billplz_preview_logo', '469', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(614, 'billplz_gateway', 'on', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(615, 'billplz_test_mode', 'on', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(616, 'paytabs_region', 'GLOBAL', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(617, 'paytabs_profile_id', '96698', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(618, 'paytabs_server_key', 'SKJNDNRHM2-JDKTZDDH2N-H9HLMJNJ2L', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(619, 'paytabs_preview_logo', '457', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(620, 'paytabs_gateway', 'on', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(621, 'paytabs_test_mode', 'on', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(622, 'cinetpay_site_id', '445160', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(623, 'cinetpay_app_key', '12912847765bc0db748fdd44.40081707', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(624, 'cinetpay_preview_logo', '489', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(625, 'cinetpay_gateway', 'on', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(626, 'cinetpay_test_mode', 'on', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(627, 'squareup_application_id', NULL, '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(628, 'squareup_location_id', 'LE9C12TNM5HAS', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(629, 'squareup_access_token', 'EAAAEOuLQObrVwJvCvoio3H13b8Ssqz1ighmTBKZvIENW9qxirHGHkqsGcPBC1uN', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(630, 'squareup_preview_logo', '471', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(631, 'squareup_gateway', 'on', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(632, 'squareup_test_mode', 'on', '2022-09-19 00:26:00', '2023-07-29 01:39:49'),
(633, 'site_usd_to_myr_exchange_rate', '4.44', '2022-09-19 05:50:39', '2023-07-29 01:39:50'),
(634, 'login_text_show_hide', 'yes', '2022-10-10 05:08:44', '2022-10-10 05:17:14'),
(635, 'seller_register_on_off', 'on', '2022-11-11 23:09:55', '2023-05-29 00:46:42'),
(636, 'buyer_register_on_off', 'on', '2022-11-11 23:13:29', '2023-05-28 08:20:53'),
(637, 'register_notice', 'Please be patient!!. Register system is currently disabled. We will come back very soon.', '2022-11-12 00:40:37', '2022-11-12 00:42:18'),
(646, 'user_register_subject', 'New User Registration', '2022-11-13 00:01:00', '2022-11-13 00:52:28'),
(647, 'user_register_message', '<p><p>Hello @name,</p><p></p>You have user registered as a @type </p><p> Username: @username  Email: @email<p></p> </p>', '2022-11-13 00:01:00', '2022-11-13 00:52:28'),
(648, 'user_email_verify_subject', 'Verify your email address', '2022-11-13 00:40:31', '2022-11-13 00:48:00'),
(649, 'user_email_verify_message', '<p><p>Hello @name,</p><p></p>Here is your verification code</p><p><p>Verification Code: @email_verify_tokn</p> </p>', '2022-11-13 00:40:31', '2022-11-13 00:48:00'),
(650, 'service_approve_subject', 'New Service Approve Request', '2022-11-13 01:33:18', '2022-11-13 02:03:58'),
(651, 'service_approve_message', '<p>Hello,</p><p>\n                                         </p><div>\n                                        </div><div>New service is just created. Please check for approve, thanks</div><div><br></div><div>\n                                        </div><div>Service id: @service_id</div><div>\n                                        </div><p></p>', '2022-11-13 01:33:18', '2022-12-21 07:19:50'),
(652, 'seller_report_subject', 'Seller New Report', '2022-11-13 02:08:12', '2023-07-17 19:55:20'),
(653, 'seller_report_message', '<p>Hello,</p><p>New report is just created by a seller. Please check , thanks</p><p>Report id: @report_id</p>', '2022-11-13 02:08:12', '2023-07-17 19:55:20'),
(654, 'seller_payout_subject', 'Seller Payout Request', '2022-11-13 02:30:06', '2022-11-13 02:40:59'),
(655, 'seller_payout_message', '<p>Hello,</p><p>\n                                         </p><div>\n                                        </div><div>New payout request is just created by a seller. Please check , thanks</div><div><br></div><div>\n                                        </div><div>Payout request id: @payout_request_id</div><div>\n                                        </div><p></p>', '2022-11-13 02:30:06', '2022-12-21 07:19:50'),
(656, 'seller_order_ticket_subject', 'New Order Ticket', '2022-11-13 03:00:43', '2022-11-13 03:22:30'),
(657, 'seller_order_ticket_message', '<p>Hello,\n                                            </p><p>You have a new order ticket\n                                            </p><p>Order ticket id: @order_ticket_id</p><p>\n                                            </p><p>\n                                            </p><div>\n                                            </div><p></p>', '2022-11-13 03:00:43', '2022-12-21 07:19:50'),
(658, 'seller_verification_subject', 'Seller Verification Request', '2022-11-13 03:20:24', '2022-11-13 03:20:24'),
(659, 'seller_verification_message', '<p>Hello,</p><p>\n                                             </p><div>\n                                            </div><div>You have a new request for seller verification.</div><div>\n                                            </div><p></p>', '2022-11-13 03:20:24', '2022-12-21 07:19:50'),
(660, 'seller_extra_service_subject', 'Extra Service Added', '2022-11-13 04:04:39', '2023-07-18 10:31:56'),
(661, 'seller_extra_service_message', '<p>Hello @seller_name</p><p>You have added extra service in your order.</p><p>Order id: @order_id</p>', '2022-11-13 04:04:39', '2023-07-18 10:31:56'),
(662, 'seller_to_buyer_extra_service_message', '<p>Hello @buyer_name</p><p><br></p><p>\r\n                                                     </p><div>\r\n                                                    </div><div>Seller added extra service in your order.</div><div><br></div><div>Order id: @order_id</div><div>\r\n                                                    </div><p></p>', '2022-11-13 04:04:39', '2023-07-18 10:31:56'),
(663, 'buyer_order_decline_subject', 'Order Complete Request Decline', '2022-11-13 04:59:37', '2022-11-13 05:07:19'),
(664, 'buyer_order_decline_message', '<p>Your request to complete an order has been decline by the buyer</p><p>Order id: @order_id</p>', '2022-11-13 04:59:37', '2022-11-13 05:07:19'),
(665, 'buyer_to_admin_extra_service_message', '<p>A buyer has been decline a request to complete an order.</p><div><br></div><div>Order id: @order_id</div><div>\n                                                     </div><p></p>', '2022-11-13 04:59:37', '2022-12-21 07:19:50'),
(666, 'buyer_report_subject', 'Buyer New Report', '2022-11-13 05:33:50', '2022-11-13 05:33:50'),
(667, 'buyer_report_message', '<p>Hello,</p><p>New report is just created by a buyer. Please check , thanks</p><p>Report id: @report_id</p>', '2022-11-13 05:33:50', '2022-11-13 05:33:50'),
(668, 'buyer_order_ticket_subject', 'New Order Ticket', '2022-11-13 06:04:26', '2022-11-13 06:06:37'),
(669, 'buyer_order_ticket_message', '<p>Hello,\n                                            </p><p>You have a new order ticket</p><p>Order ticket id: @order_ticket_id</p><p>\n                                            </p><p>\n                                            </p><div>\n                                            </div><p></p>', '2022-11-13 06:04:26', '2022-12-21 07:19:50'),
(670, 'buyer_extra_service_subject', 'Extra Service Excepted', '2022-11-13 06:36:53', '2022-11-13 06:44:46'),
(671, 'buyer_extra_service_message', '<p>Hello @buyer_name</p><p>You have accepted extra service&nbsp; added by seller in your order.</p><p>Order id: @order_id</p>', '2022-11-13 06:36:53', '2022-11-13 06:44:46'),
(672, 'buyer_to_seller_extra_service_message', '<p>Hello @seller_name</p><p><br></p><p>\n                                             </p><div>\n                                            </div><div>Buyer accepted the&nbsp; extra service added buy you&nbsp; in your order.</div><div><br></div><div>Order id: @order_id</div><div>\n                                            </div><p></p>', '2022-11-13 06:36:53', '2022-12-21 07:19:50'),
(673, 'admin_change_payment_status_subject', 'Payment Status Change', '2022-11-14 00:09:25', '2022-12-21 07:19:50'),
(674, 'admin_change_payment_status_message', '<p></p><p>Hello @name,\n                                                    </p><p>Payment status has been changed @old_status to @new_status\n                                                    </p><p>Order id: @order_id</p><p>\n                                                    </p><p></p> <p></p>', '2022-11-14 00:09:26', '2022-12-21 07:19:50'),
(675, 'admin_withdraw_amount_send_message', '<p></p><p>Hello @name,\n                                                    </p><p>&nbsp;We just send your requested payout amount. Thanks to stay with us.</p><p>Withdraw Amount:&nbsp; @withdraw_amount</p><p>\n                                                    </p><p></p> <p></p>', '2022-11-14 01:19:15', '2022-12-21 07:19:50'),
(676, 'admin_service_approve_subject', 'Service Approve Success', '2022-11-14 02:26:51', '2022-11-14 02:51:46'),
(677, 'admin_service_approve_message', '<p></p><p>Hello @name,</p><p>Your service has been approved by admin.</p><p>\n                                                </p><p></p> <p></p>', '2022-11-14 02:26:51', '2022-12-21 07:19:50'),
(678, 'admin_service_assign_subject', 'Service Assign By Admin', '2022-11-14 02:56:03', '2022-11-14 02:59:27'),
(679, 'admin_service_assign_message', 'Hello new service is just assign to you. Please check for details, thanks', '2022-11-14 02:56:03', '2022-11-14 02:59:27'),
(680, 'admin_seller_verification_subject', 'Seller Verification Success', '2022-11-14 03:29:10', '2022-11-14 03:30:05'),
(681, 'admin_seller_verification_message', '<p></p><p>Hello @name,</p><p>Your verification is success. Now you are a verified seller.</p><p>\n                                                    </p><p></p> <p></p>', '2022-11-14 03:29:10', '2022-12-21 07:19:50'),
(682, 'admin_user_verification_code_subject', 'Verification Code Send Success', '2022-11-14 04:01:57', '2022-11-14 04:03:11'),
(683, 'admin_user_verification_code_message', '<p></p><p>Hello @name,</p><p>Here is your verification code.</p><p>Verification Code: @verification_code</p><p>\n                                                    </p><p></p> <p></p>', '2022-11-14 04:01:57', '2022-12-21 07:19:50'),
(684, 'admin_user_new_password_subject', 'Password Change Success', '2022-11-14 22:47:43', '2022-11-14 22:48:06'),
(685, 'admin_user_new_password_message', '<p>Hello,</p><p>\n                                                 </p><div>\n                                                </div><div>Here is your new password.</div><div><br></div><div>\n                                                </div><div>New password: @new_password</div><div>\n                                                </div><p></p>', '2022-11-14 22:47:43', '2022-12-21 07:19:50'),
(686, 'new_order_email_subject', 'New Order #', '2022-11-15 00:26:37', '2023-10-22 00:09:45'),
(687, 'new_order_buyer_message', '<p><br></p><p>@generatedOrderDetails</p><p>\r\n</p><p>You have successfully placed an order #</p><p><br></p><p>https://bytesed.com/laravel/qixer</p><p><br></p><p>\r\n</p><p>\r\n</p>', '2022-11-15 00:26:37', '2023-10-22 00:09:45'),
(688, 'new_order_admin_seller_message', '<p><br></p><p>@generatedOrderDetails</p><p>\r\n</p><p>You have a new order #</p><p><br></p><p>https://bytesed.com/laravel/qixer</p><p><br></p><p>\r\n</p><p>\r\n</p><p>\r\n</p><p>\r\n</p><div bis_skin_checked=\"1\">\r\n                                                </div><p></p>', '2022-11-15 00:26:37', '2023-10-22 00:09:45'),
(689, 'job_apply_subject', 'New Application Created', '2022-11-15 01:59:35', '2022-11-15 01:59:53'),
(690, 'job_apply_message', '<p>Hello,</p><p>\n                                     </p><div>\n                                    </div><div>New application is created for your job.</div><div><br></div><div>\n                                    </div><div>Job post id: @job_post_id</div><div>\n                                    </div><p></p>', '2022-11-15 01:59:35', '2022-12-21 07:19:50'),
(691, 'buy_subscription_email_subject', 'New Subscription', '2022-11-15 03:28:29', '2023-11-24 23:58:56'),
(692, 'buy_subscription_seller_message', '<p><p>Hello,</p><p>\r\n                                                 </p><div>\r\n                                                </div><div>You have successfully buy a subscription.\r\n                                                </div><div>Your subscription infos---\r\n                                                </div><div>Subscription type: @type\r\n                                                </div><div>Subscription price: @price\r\n                                                </div><div>Subscription connect: @connect</div><div>\r\n                                                </div><div>\r\n                                                </div><div>\r\n                                                </div><div>\r\n                                                </div><p></p> </p><p>Subscription service: @service</p><p>Subscription job: @job</p>', '2022-11-15 03:28:29', '2023-11-24 23:58:56'),
(693, 'buy_subscription_admin_message', '<p>A seller just buy a subscription</p><p>Subscription infos---\r\n                                                </p><p>Subscription type: @type\r\n                                                </p><p>Subscription price: @price\r\n                                                </p><p>Subscription connect: @connect</p><p>Subscription service: @service</p><p>Subscription job: @job</p><p>Seller name: @seller_name</p><p>Seller email: @seller_email</p>', '2022-11-15 03:28:29', '2023-11-24 23:58:56'),
(694, 'renew_subscription_email_subject', 'Renew Subscription', '2022-11-15 03:54:19', '2022-11-15 04:00:39'),
(695, 'renew_subscription_seller_message', '<p>Hello,</p><p>\n                                                     <div>\n                                                    </div><div>You have successfully renew a subscription.</div><div>\n                                                    </div><div>Your subscription infos---\n                                                    </div><div>Subscription type: @type\n                                                    </div><div>Subscription price: @price\n                                                    </div><div>Subscription connect: @connect</div></p>', '2022-11-15 03:54:19', '2022-12-21 07:19:50'),
(696, 'renew_subscription_admin_message', '<p>A seller just renew his subscription</p><p>\n                                                     <div>\n                                                    </div><div>Subscription infos---\n                                                    </div><div>Subscription type: @type\n                                                    </div><div>Subscription price: @price\n                                                    </div><div>Subscription connect: @connect\n                                                    </div><div>Seller name: @seller_name\n                                                    </div><div>Seller email: @seller_email</div><div>\n                                                    </div><div>\n                                                    </div><div>\n                                                    </div><div>\n                                                    </div><div>\n                                                    </div></p>', '2022-11-15 03:54:19', '2022-12-21 07:19:50'),
(697, 'payment_subscription_email_subject', 'Subscription Payment Status', '2022-11-15 05:03:43', '2022-11-15 05:03:43'),
(698, 'payment_subscription_seller_message', '<p>Dear User,</p><p>Your subscription payment status change to complete.</p>', '2022-11-15 05:03:43', '2022-11-15 05:03:43'),
(703, 'pusher_app_id', '1275768', '2022-12-15 02:45:41', '2023-04-18 00:15:11'),
(704, 'pusher_app_key', '425f9b850f4840643c70', '2022-12-15 02:45:41', '2023-04-18 00:15:11'),
(705, 'pusher_app_secret', '492044099b776405b02a', '2022-12-15 02:45:41', '2023-04-18 00:15:11'),
(706, 'pusher_app_cluster', 'ap1', '2022-12-15 02:45:41', '2023-04-18 00:15:11'),
(707, 'pusher_app_push_notification_auth_token', '0C764A214C6154535DB891CBD5640012FB5F4B997242314371798110916EAFCD', '2022-12-15 02:45:41', '2023-04-18 00:15:11'),
(708, 'seller_pusher_app_push_notification_auth_token', 'A4EEE003A0AEB2B95F78FAD12EA11D8E1C281448DD8D9B33B47F6E5EC47CEDEA', '2022-12-15 02:45:41', '2023-04-18 00:15:11'),
(709, 'seller_pusher_app_push_notification_instanceId', 'fcaf9caf-509c-4611-a225-2e508593d6af', '2022-12-15 02:45:41', '2023-04-18 00:15:11'),
(710, 'pusher_app_push_notification_instanceId', 'aa8d8bb4-1030-48a1-a4ac-ad1d5fbd99d3', '2022-12-15 03:30:38', '2023-04-18 00:15:11'),
(711, 'user_register_subject34', 'New User Registration', '2022-12-21 07:19:50', '2022-12-21 07:19:50'),
(712, 'user_register_message45', '<p><p>Hello @name,</p><p></p>You have user registered as a @type </p><p> Username: @username  Email: @email<p></p> </p>', '2022-12-21 07:19:50', '2022-12-21 07:19:50'),
(713, 'contact_mail_success_message', NULL, '2023-01-25 17:23:44', '2023-01-25 17:23:47'),
(714, 'order_mail_success_message', NULL, '2023-01-25 17:23:44', '2023-01-25 17:23:47'),
(715, 'site_meta_tags', NULL, '2023-01-25 17:25:06', '2023-01-25 17:26:12'),
(716, 'site_meta_description', NULL, '2023-01-25 17:25:06', '2023-01-25 17:26:12'),
(717, 'og_meta_title', NULL, '2023-01-25 17:25:06', '2023-01-25 17:26:12'),
(718, 'og_meta_description', NULL, '2023-01-25 17:25:06', '2023-01-25 17:26:12'),
(719, 'og_meta_site_name', NULL, '2023-01-25 17:25:06', '2023-01-25 17:26:12'),
(720, 'og_meta_url', NULL, '2023-01-25 17:25:06', '2023-01-25 17:26:12'),
(721, 'og_meta_image', '423', '2023-01-25 17:25:06', '2023-01-25 17:26:12'),
(722, 'dashboard_variant_buyer', '02', '2023-03-20 23:25:11', '2023-07-30 22:28:46'),
(723, 'dashboard_variant_seller', '02', '2023-04-10 00:14:03', '2023-07-30 22:28:46'),
(724, 'add_remove_comman_form_amount', 'yes', '2023-04-11 23:56:25', '2023-07-29 01:39:50'),
(725, 'add_remove_sapce_between_amount_and_symbol', 'no', '2023-04-11 23:56:25', '2023-07-29 01:39:50'),
(726, 'service_create_status_settings', 'pending', '2023-05-21 03:06:58', '2023-05-21 03:06:58'),
(727, 'seller_service_country_required', 'on', '2023-05-28 08:15:57', '2023-05-28 08:17:36'),
(728, 'seller_service_city_required', 'on', '2023-05-28 08:15:57', '2023-05-28 08:17:36'),
(729, 'seller_service_area_required', NULL, '2023-05-28 08:15:57', '2023-05-29 00:46:42'),
(730, 'buyer_service_country_required', 'on', '2023-05-28 08:20:11', '2023-05-28 08:20:53'),
(731, 'buyer_service_city_required', 'on', '2023-05-28 08:20:11', '2023-05-28 08:20:53'),
(732, 'buyer_service_area_required', 'on', '2023-05-28 08:20:11', '2023-05-28 08:20:53'),
(733, 'service_google_map_api_key', 'AIzaSyCdyM69_P4OdsqIQXF1aZ1a1n-IBlitBZs', '2023-06-14 01:13:52', '2023-11-23 07:07:11'),
(734, 'google_map_settings', 'on', '2023-06-17 23:39:17', '2023-11-23 07:07:11'),
(735, 'order_create_settings', 'login_user', '2023-07-10 06:35:42', '2023-07-10 06:54:11'),
(736, 'google_map_search_placeholder_title', 'Search Location here', '2023-07-15 23:59:49', '2023-11-23 07:07:11'),
(737, 'google_map_search_button_title', 'Set Location', '2023-07-16 00:17:15', '2023-11-23 07:07:11'),
(738, 'disable_user_otp_verify', NULL, '2023-07-16 22:36:12', '2025-11-14 19:30:47'),
(739, 'user_otp_expire_time', NULL, '2023-07-16 22:36:12', '2025-11-14 19:30:47'),
(740, 'site_canonical_url_type', 'self', '2023-07-16 22:44:12', '2025-11-14 19:30:47'),
(741, 'service_load_more_category_available', NULL, '2023-07-17 19:15:32', '2023-07-17 19:31:37'),
(742, 'service_load_more_subcategory_available', '5pppp', '2023-07-17 19:15:32', '2023-07-17 19:31:37'),
(743, 'service_load_more_child_category_available', '5', '2023-07-17 19:15:32', '2023-07-17 19:31:37'),
(744, 'load_more_button_show_hide_settings', 'on', '2023-07-17 19:41:05', '2023-07-17 19:44:26'),
(745, 'kineticpay_username', 'ede1c5e9f81c9d12bf418629f56a7870', '2023-07-20 08:50:24', '2023-07-29 01:39:49'),
(746, 'kineticpay_preview_logo', '617', '2023-07-20 08:50:24', '2023-07-29 01:39:49'),
(747, 'kineticpay_gateway', 'on', '2023-07-20 08:50:24', '2023-07-29 01:39:49'),
(748, 'kineticpay_test_mode', 'on', '2023-07-20 08:50:24', '2023-07-29 01:39:49'),
(749, 'site_eur_to_myr_exchange_rate', '10', '2023-07-20 08:50:25', '2023-07-22 05:40:03'),
(750, 'site_myr_to_usd_exchange_rate', NULL, '2023-07-22 05:40:03', '2023-07-23 00:18:56'),
(751, 'site_myr_to_idr_exchange_rate', NULL, '2023-07-23 00:18:56', '2023-07-24 01:56:30'),
(752, 'site_myr_to_inr_exchange_rate', NULL, '2023-07-23 00:18:56', '2023-07-24 01:56:30'),
(753, 'site_myr_to_ngn_exchange_rate', NULL, '2023-07-23 00:18:56', '2023-07-24 01:56:30'),
(754, 'site_myr_to_zar_exchange_rate', NULL, '2023-07-23 00:18:56', '2023-07-24 01:56:30'),
(755, 'site_myr_to_brl_exchange_rate', NULL, '2023-07-23 00:18:56', '2023-07-24 01:56:30'),
(756, 'site_myr_to_myr_exchange_rate', NULL, '2023-07-23 00:18:56', '2023-07-24 01:56:30'),
(757, 'start_week_from', '0', '2023-07-23 05:40:16', '2023-07-23 05:43:09'),
(758, 'price_plan_page', '44', '2023-07-27 08:38:36', '2023-11-23 07:19:26'),
(759, 'select_home_page_search_service_page_url', 'service-list', '2023-11-23 07:07:11', '2023-11-23 07:07:11'),
(760, 'site_ar_title', 'صيانة تك - منصة خدمات الصيانة المنزلية والتقنية', '2025-11-14 22:10:41', '2025-11-14 22:10:41'),
(761, 'site_ar_tag_line', 'منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية', '2025-11-14 22:10:41', '2025-11-14 22:10:41'),
(762, 'site_meta_ar_description', 'صيانة تك - منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية. ربط العملاء بالفنيين المعتمدين مع تتبع مباشر للطلبات، أسعار شفافة، فواتير إلكترونية، وضمانات رقمية.', '2025-11-14 22:10:41', '2025-11-14 22:10:41'),
(763, 'google_font', NULL, '2025-11-15 09:25:22', '2025-11-17 20:16:19'),
(764, 'custom_font', NULL, '2025-11-15 09:25:22', '2025-11-17 20:16:19'),
(765, 'site_contact_phone', '+966 50 123 4567', '2025-12-15 12:57:15', '2025-12-15 12:57:15'),
(766, 'site_facebook_link', 'https://www.facebook.com/syanatech', '2025-12-15 12:57:15', '2025-12-15 12:57:15'),
(767, 'site_twitter_link', 'https://www.twitter.com/syanatech', '2025-12-15 12:57:15', '2025-12-15 12:57:15'),
(768, 'site_instagram_link', 'https://www.instagram.com/syanatech', '2025-12-15 12:57:15', '2025-12-15 12:57:15'),
(769, 'site_linkedin_link', 'https://www.linkedin.com/company/syanatech', '2025-12-15 12:57:15', '2025-12-15 12:57:15'),
(770, 'site_youtube_link', 'https://www.youtube.com/@syanatech', '2025-12-15 12:57:15', '2025-12-15 12:57:15'),
(771, 'site_whatsapp_link', 'https://wa.me/966501234567', '2025-12-15 12:57:15', '2025-12-15 12:57:15');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` longtext DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `name`, `description`, `slug`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Auto Mobile', NULL, 'auto-mobile', '759', 1, '2021-11-30 03:12:29', '2023-07-29 02:12:26'),
(2, 3, 'House Repair', '<p>This is test category with description for cat update cat</p>', 'house-repair', '106', 1, '2021-11-30 03:13:01', '2022-02-10 07:03:30'),
(3, 1, 'Ac Repair', NULL, 'ac-repair', '754', 1, '2021-11-30 03:13:15', '2023-07-29 02:12:29'),
(7, 5, 'Body Message', NULL, 'body-message', '110', 1, '2021-11-30 06:06:52', '2022-02-10 06:57:15'),
(8, 1, 'Repair', NULL, 'repair', '114', 1, '2022-02-01 00:55:09', '2022-02-10 06:57:05'),
(9, 2, 'Car Cleaning', NULL, 'car-cleaning', '112', 1, '2022-02-01 01:46:58', '2022-02-10 06:55:39'),
(10, 5, 'Hair Cutting', NULL, 'hair-cutting', '90', 1, '2022-02-01 02:44:56', '2022-02-10 06:55:25'),
(11, 2, 'House Cleaning', NULL, 'house-cleaning', '113', 1, '2022-02-01 03:03:50', '2022-02-10 06:55:15'),
(12, 5, 'Beauty Care', NULL, 'beauty-care', '102', 1, '2022-02-01 04:29:49', '2022-02-10 07:05:39'),
(13, 7, 'Profile Build', NULL, 'profile-build', '761', 1, '2022-04-24 00:08:23', '2023-07-29 02:12:47'),
(18, 4, '3D Painting', NULL, '3d-painting', '750', 1, '2023-05-17 02:07:01', '2023-07-29 02:12:45'),
(19, 4, 'Digital Painting', NULL, 'digital-painting-', '755', 1, '2023-05-17 02:07:27', '2023-07-29 02:12:42'),
(21, 1, 'Food Service', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p>', 'food-service', '760', 1, '2023-05-23 07:22:37', '2023-07-29 02:12:40'),
(22, 1, 'Book Service', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p>', 'book-service-', '757', 1, '2023-05-23 07:23:02', '2023-07-29 02:12:37'),
(23, 1, 'Car Service', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'car-service', '756', 1, '2023-05-23 07:23:52', '2023-07-29 02:12:34'),
(26, 1, 'Design & Development', '<p>Among Web professionals, \"Web development\" usually refers to the main non-design aspects of building Web sites: writing markup and coding</p>', 'design---development-', '758', 1, '2023-05-28 00:56:58', '2023-07-29 02:12:31'),
(27, 4, 'Cool Painting', NULL, 'cool-painting', '697', 1, '2023-07-28 05:05:03', '2023-07-28 05:05:03'),
(29, 9, 'Business Advisory', NULL, 'business-advisory', '864', 1, '2023-10-22 00:42:57', '2023-10-22 00:42:57'),
(30, 8, 'IT Support', NULL, 'it-support', '862', 1, '2023-10-22 00:44:10', '2023-10-22 00:44:10'),
(31, 8, 'Software Help', NULL, 'software-help', '865', 1, '2023-10-22 00:46:24', '2023-10-22 00:46:24');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `type` varchar(191) NOT NULL,
  `price` double NOT NULL,
  `connect` bigint(20) NOT NULL,
  `service` bigint(20) NOT NULL DEFAULT 0,
  `job` bigint(20) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `image` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `title`, `type`, `price`, `connect`, `service`, `job`, `status`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Elite Subscription', 'monthly', 0, 6, 6, 6, 1, 297, '2022-09-08 01:59:05', '2023-07-22 07:34:47'),
(2, 'Silver Subscription', 'yearly', 200, 200, 200, 100, 1, 298, '2022-09-08 01:59:32', '2023-05-21 23:35:57'),
(3, 'Gold Subscription', 'lifetime', 1000, 0, 0, 0, 1, 296, '2022-09-08 01:59:58', '2022-09-09 06:13:20');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_coupons`
--

CREATE TABLE `subscription_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) NOT NULL,
  `discount` double DEFAULT NULL,
  `discount_type` varchar(191) DEFAULT NULL,
  `expire_date` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=inactive 1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_coupons`
--

INSERT INTO `subscription_coupons` (`id`, `code`, `discount`, `discount_type`, `expire_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Test10', 10, 'percentage', '2022-09-30', 1, '2022-09-03 05:44:03', '2022-09-03 05:44:32'),
(2, 'Test20', 20, 'percentage', '2022-09-30', 1, '2022-09-03 05:44:26', '2022-09-03 05:44:30');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_histories`
--

CREATE TABLE `subscription_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_id` bigint(20) NOT NULL,
  `seller_id` bigint(20) NOT NULL,
  `type` varchar(191) DEFAULT NULL,
  `connect` bigint(20) NOT NULL DEFAULT 0,
  `service` bigint(20) NOT NULL DEFAULT 0,
  `job` bigint(20) NOT NULL DEFAULT 0,
  `price` double NOT NULL DEFAULT 0,
  `coupon_code` varchar(191) DEFAULT NULL,
  `coupon_type` varchar(191) DEFAULT NULL,
  `coupon_amount` varchar(191) NOT NULL DEFAULT '0',
  `price_with_discount` double NOT NULL DEFAULT 0,
  `expire_date` timestamp NULL DEFAULT NULL,
  `payment_gateway` varchar(191) DEFAULT NULL,
  `payment_status` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text DEFAULT NULL,
  `via` text DEFAULT NULL,
  `operating_system` varchar(191) DEFAULT NULL,
  `user_agent` varchar(191) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `priority` varchar(191) DEFAULT NULL,
  `department` varchar(191) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `buyer_id` bigint(20) DEFAULT NULL,
  `seller_id` bigint(20) DEFAULT NULL,
  `service_id` bigint(20) DEFAULT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `admin_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_tickets`
--

INSERT INTO `support_tickets` (`id`, `title`, `via`, `operating_system`, `user_agent`, `description`, `subject`, `status`, `priority`, `department`, `user_id`, `buyer_id`, `seller_id`, `service_id`, `order_id`, `admin_id`, `created_at`, `updated_at`) VALUES
(1, 'New Order', NULL, NULL, NULL, NULL, 'Order Created By khaled ahmed', 'open', 'high', NULL, NULL, NULL, 1, 366, 71, NULL, '2025-11-16 09:22:30', '2025-11-16 09:22:30'),
(2, 'New Order', NULL, NULL, NULL, NULL, 'Order Created By khaled ahmed', 'open', 'high', NULL, NULL, NULL, 1, 366, 72, NULL, '2025-11-17 19:20:01', '2025-11-17 19:20:01');

-- --------------------------------------------------------

--
-- Table structure for table `support_ticket_messages`
--

CREATE TABLE `support_ticket_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` longtext DEFAULT NULL,
  `notify` varchar(191) DEFAULT NULL,
  `attachment` varchar(191) DEFAULT NULL,
  `type` varchar(191) DEFAULT NULL,
  `support_ticket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `status` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Electronics Painting Home Mobe test Color Paint  2305 %&4', 'publish', '2022-01-08 01:20:00', '2022-01-08 01:20:00'),
(5, 'Salon & Spa', 'publish', '2022-01-08 01:20:16', '2022-01-08 01:20:16'),
(6, 'Home Move', 'draft', '2022-01-08 01:20:51', '2022-01-08 01:20:51'),
(7, 'Body Message', 'publish', '2022-01-08 01:21:16', '2022-01-08 01:21:16'),
(9, 'Painting Home Mobe test Color Paint  2305 %&433', 'publish', '2022-01-08 05:30:42', '2022-01-08 05:30:42'),
(10, 'Cleaning', 'publish', '2022-01-08 05:30:53', '2022-01-08 05:30:53');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tax` double NOT NULL,
  `country_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `tax`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 8, 4, '2022-09-05 05:54:15', '2022-09-05 05:54:24'),
(2, 7, 1, '2022-09-05 05:55:14', '2022-09-05 05:55:14'),
(3, 10, 9, '2023-07-10 06:00:39', '2023-07-10 06:00:39');

-- --------------------------------------------------------

--
-- Table structure for table `technician_regions`
--

CREATE TABLE `technician_regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `technician_id` bigint(20) UNSIGNED NOT NULL,
  `region_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `technician_regions`
--

INSERT INTO `technician_regions` (`id`, `technician_id`, `region_id`, `created_at`, `updated_at`) VALUES
(1, 1968, 116, NULL, NULL),
(2, 1968, 141, NULL, NULL),
(3, 1968, 160, NULL, NULL),
(4, 1969, 120, NULL, NULL),
(5, 1969, 132, NULL, NULL),
(6, 1969, 138, NULL, NULL),
(7, 1969, 165, NULL, NULL),
(8, 1970, 116, NULL, NULL),
(9, 1970, 133, NULL, NULL),
(10, 1970, 137, NULL, NULL),
(11, 1970, 157, NULL, NULL),
(12, 1971, 114, NULL, NULL),
(13, 1971, 124, NULL, NULL),
(14, 1971, 140, NULL, NULL),
(15, 1971, 148, NULL, NULL),
(16, 1971, 151, NULL, NULL),
(17, 1972, 124, NULL, NULL),
(18, 1972, 132, NULL, NULL),
(19, 1972, 157, NULL, NULL),
(20, 1973, 138, NULL, NULL),
(21, 1973, 142, NULL, NULL),
(22, 1973, 163, NULL, NULL),
(23, 2005, 132, NULL, NULL),
(24, 2005, 135, NULL, NULL),
(25, 2005, 145, NULL, NULL),
(26, 2005, 149, NULL, NULL),
(27, 2005, 155, NULL, NULL),
(28, 2006, 113, NULL, NULL),
(29, 2006, 130, NULL, NULL),
(30, 2006, 135, NULL, NULL),
(31, 2006, 153, NULL, NULL),
(32, 2006, 155, NULL, NULL),
(33, 2006, 163, NULL, NULL),
(34, 2007, 114, NULL, NULL),
(35, 2007, 117, NULL, NULL),
(36, 2007, 128, NULL, NULL),
(37, 2007, 142, NULL, NULL),
(38, 2007, 163, NULL, NULL),
(39, 2008, 120, NULL, NULL),
(40, 2008, 121, NULL, NULL),
(41, 2008, 124, NULL, NULL),
(42, 2008, 133, NULL, NULL),
(43, 2008, 138, NULL, NULL),
(44, 2008, 161, NULL, NULL),
(45, 2009, 126, NULL, NULL),
(46, 2009, 137, NULL, NULL),
(47, 2009, 139, NULL, NULL),
(48, 2009, 151, NULL, NULL),
(49, 2009, 163, NULL, NULL),
(50, 2010, 117, NULL, NULL),
(51, 2010, 156, NULL, NULL),
(52, 2010, 164, NULL, NULL),
(53, 2041, 124, NULL, NULL),
(54, 2041, 136, NULL, NULL),
(55, 2041, 140, NULL, NULL),
(56, 2041, 147, NULL, NULL),
(57, 2041, 157, NULL, NULL),
(58, 2041, 158, NULL, NULL),
(59, 2042, 123, NULL, NULL),
(60, 2042, 136, NULL, NULL),
(61, 2042, 140, NULL, NULL),
(62, 2042, 155, NULL, NULL),
(63, 2043, 118, NULL, NULL),
(64, 2043, 122, NULL, NULL),
(65, 2043, 133, NULL, NULL),
(66, 2043, 140, NULL, NULL),
(67, 2043, 152, NULL, NULL),
(68, 2043, 164, NULL, NULL),
(69, 2044, 126, NULL, NULL),
(70, 2044, 137, NULL, NULL),
(71, 2044, 154, NULL, NULL),
(72, 2045, 114, NULL, NULL),
(73, 2045, 120, NULL, NULL),
(74, 2045, 130, NULL, NULL),
(75, 2045, 136, NULL, NULL),
(76, 2045, 143, NULL, NULL),
(77, 2045, 147, NULL, NULL),
(78, 2046, 133, NULL, NULL),
(79, 2046, 142, NULL, NULL),
(80, 2046, 158, NULL, NULL),
(81, 2046, 163, NULL, NULL),
(82, 2046, 165, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `to_do_lists`
--

CREATE TABLE `to_do_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `to_do_lists`
--

INSERT INTO `to_do_lists` (`id`, `title`, `description`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Line chart will', 'In it except to so temper mutual tastes mothe In it except to so', 1, 0, '2022-01-26 02:43:06', '2022-02-02 22:32:45'),
(3, 'In it except to', 'In it except to so temper mutual tastes mothe In it except to so', 1, 1, '2022-01-26 02:50:53', '2023-05-22 07:57:17'),
(5, 'In it except to so', 'In it except to so temper mutual tastes mothe In it except to so', 1, 0, '2022-01-26 03:31:26', '2023-05-03 02:11:41'),
(6, 'Test to do', 'Test to do Test to do', 2, 0, '2022-01-27 02:51:08', '2022-01-27 02:51:08'),
(7, 'Test To do Two', 'Hi there,,, here is your account credentials....', 2, 0, '2022-01-27 03:02:18', '2022-01-27 03:02:18'),
(8, 'awetfraf', 'In it except to so temper mutual tastes mothe In it except to so temper mutual tastes mothe', 5, 0, '2022-02-02 07:01:41', '2022-02-02 07:01:41'),
(9, 'dsghsdgh', 'In it except to so temper mutual tastes mothe In it except to', 5, 0, '2022-02-02 07:02:20', '2022-02-02 07:02:20'),
(10, 'Test To do', 'In it except to so temper mutual tastes mothe In it except to so', 1, 0, '2022-03-02 01:26:16', '2023-05-03 03:05:26'),
(12, 'fdsf', 'sdfsdf', 1, 0, '2023-05-03 03:07:46', '2023-05-03 03:07:46'),
(13, 'demo test', '4444', 1, 1, '2023-05-03 03:07:56', '2023-05-27 07:16:22'),
(14, 'sdf', 'dsfdsf', 1, 0, '2023-05-03 03:08:05', '2023-05-03 03:08:05'),
(15, 'dsf', 'dsfdsf', 1, 0, '2023-05-03 03:08:10', '2023-05-03 03:08:10'),
(16, 'fdsf', 'dsfsd', 1, 1, '2023-05-03 03:08:14', '2023-05-27 07:16:17'),
(17, 'sdf', 'dsfdsf', 1, 1, '2023-05-03 03:08:18', '2023-05-03 08:05:14'),
(18, NULL, 'dfdsf\r\ndfd', 1, 1, '2023-05-22 08:00:57', '2023-05-24 23:37:06'),
(19, NULL, 'frsf', 1, 1, '2023-05-22 08:01:21', '2023-05-22 08:01:30'),
(20, NULL, 'fdfdsf', 1, 1, '2023-05-25 05:47:59', '2023-05-27 07:16:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `username` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `otp_code` varchar(191) DEFAULT NULL,
  `otp_verified` tinyint(4) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `profile_background` varchar(191) DEFAULT NULL,
  `service_city` varchar(191) DEFAULT NULL,
  `service_area` varchar(191) DEFAULT NULL,
  `user_type` int(11) NOT NULL DEFAULT 0 COMMENT '0=seller, 1=buyer',
  `user_status` int(11) NOT NULL DEFAULT 1 COMMENT '0=inactive, 1=active',
  `terms_condition` int(11) NOT NULL DEFAULT 1,
  `address` text DEFAULT NULL,
  `state` varchar(191) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `specializations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Array of service category IDs' CHECK (json_valid(`specializations`)),
  `assigned_regions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Array of region IDs' CHECK (json_valid(`assigned_regions`)),
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `technician_code` varchar(191) DEFAULT NULL,
  `rating` decimal(3,2) NOT NULL DEFAULT 0.00,
  `completed_orders_count` int(11) NOT NULL DEFAULT 0,
  `tax_number` varchar(191) DEFAULT NULL,
  `post_code` varchar(191) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `email_verified` varchar(191) DEFAULT NULL,
  `email_verify_token` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `facebook_id` varchar(191) DEFAULT NULL,
  `google_id` varchar(191) DEFAULT NULL,
  `country_code` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `password_changed_at` datetime DEFAULT NULL,
  `fb_url` varchar(191) DEFAULT NULL,
  `tw_url` varchar(191) DEFAULT NULL,
  `go_url` varchar(191) DEFAULT NULL,
  `li_url` varchar(191) DEFAULT NULL,
  `yo_url` varchar(191) DEFAULT NULL,
  `in_url` varchar(191) DEFAULT NULL,
  `twi_url` varchar(191) DEFAULT NULL,
  `pi_url` varchar(191) DEFAULT NULL,
  `dr_url` varchar(191) DEFAULT NULL,
  `re_url` varchar(191) DEFAULT NULL,
  `last_seen` timestamp NULL DEFAULT NULL,
  `otp_expire_at` timestamp NULL DEFAULT NULL,
  `zone_id` bigint(20) DEFAULT NULL,
  `latitude` varchar(191) DEFAULT NULL,
  `longitude` varchar(191) DEFAULT NULL,
  `seller_address` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `phone`, `otp_code`, `otp_verified`, `image`, `profile_background`, `service_city`, `service_area`, `user_type`, `user_status`, `terms_condition`, `address`, `state`, `about`, `specializations`, `assigned_regions`, `is_available`, `technician_code`, `rating`, `completed_orders_count`, `tax_number`, `post_code`, `country_id`, `email_verified`, `email_verify_token`, `remember_token`, `facebook_id`, `google_id`, `country_code`, `created_at`, `updated_at`, `password_changed_at`, `fb_url`, `tw_url`, `go_url`, `li_url`, `yo_url`, `in_url`, `twi_url`, `pi_url`, `dr_url`, `re_url`, `last_seen`, `otp_expire_at`, `zone_id`, `latitude`, `longitude`, `seller_address`) VALUES
(1, 'فني تجريبي', 'technician@syanteck.com', 'test_seller', '$2y$10$BcrRL8xyCra9gydgtzA2puRsLjAY44gdexATOaGnYHDn6JmL/66uu', '+966501234567', '598146', 1, '873', '619', '50', '110', 0, 1, 1, 'الشرائع، مكة المكرمة، السعودية', '1', 'It is a long established fact that a reader will be distracted by the readable content of a page. It is a long', NULL, NULL, 1, NULL, 0.00, 0, '#123456', '24231', 69, '1', 'qw23QrtQ', 'w4sw5hqndHhVVEslNwOhyBp2cEzjzW7W5P8KlCwKO6Gi0aFZ8c91oc4Zu519', NULL, NULL, 'SA', '2021-12-05 07:11:43', '2025-12-15 13:15:34', NULL, 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', NULL, '2025-12-15 13:15:34', '2023-07-23 06:50:17', 12, '21.3891', '39.8579', 'الشرائع، مكة المكرمة، السعودية'),
(2, 'Seller Two', 'test_seller_two@gmail.com', 'test_seller_two', '$2y$10$1.vO5wn8Y/rp9vSBUi4wXeKzL6KxyitpXIVbEaOzGBnFSwrEUeOB.', '+32464378455', '492870', 1, '746', '715', '7', '21', 0, 1, 1, 'Sotheerm Road-12/A', NULL, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less.', NULL, NULL, 1, NULL, 0.00, 0, NULL, '403', 6, '1', 'qw23QrtY', 'Go7QkD94gzBYMt2mL0uSV4T6k9NYrUuM5ITgulqE1hxDxPL9foJZ24dCUuZK', NULL, NULL, NULL, '2021-12-05 07:13:59', '2023-11-01 21:08:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-01 21:08:25', '2023-07-20 02:37:25', NULL, '28.69202695233511', '77.2218421590912', 'Delhi, India'),
(3, 'Md xyz', 'testdoc2021@gmail.com', 'xyz', '$2y$10$CUyA.WIM.hVTgYl0QLljgu2j84nlA5lwzML.37TOI.u4/ENlbWBDi', '+8801713606060', '242366', 1, '65', '122', '1', '2', 1, 1, 1, '49/3, Dhaka', NULL, 'Hi this is Sohan from Bangladesh', NULL, NULL, 1, NULL, 0.00, 0, NULL, '1203', 1, '1', 'YwO3QPtQ', 'bGS7o1NvdUQLQ9YUmTT6vsmdalNA6bVXxIjJk39KVdpZtY35xKaNoJFZgdSE', NULL, NULL, NULL, '2021-12-05 07:15:03', '2023-11-12 06:24:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-12 06:24:07', '2023-07-20 02:44:47', NULL, NULL, NULL, NULL),
(4, 'Seller Three', 'seller-three@gmail.com', 'seller_three', '$2y$10$1.vO5wn8Y/rp9vSBUi4wXeKzL6KxyitpXIVbEaOzGBnFSwrEUeOB.', '+11955627635', '988786', 1, '747', '1', '18', '45', 0, 1, 1, '90/4, New Dhaka', NULL, 'Hi This is Shahadat From Bangladesh', NULL, NULL, 1, NULL, 0.00, 0, NULL, '1378', 5, '1', 'B9a2iZ4u', 'OYFiC0u7FkKcXnuA1gwtDo59pDfLYkniTFDh0J6Er5LQATCnQRaQeNf7zKlr', NULL, NULL, NULL, '2022-02-01 03:48:09', '2023-11-04 03:15:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-04 03:15:57', '2023-07-17 05:16:36', NULL, '3.1319197', '101.6840589', 'Kuala Lumpur, Malaysia'),
(5, 'Test Buyer', 'test_buyer_final@gmail.com', 'test_buyer', '$2y$10$1.vO5wn8Y/rp9vSBUi4wXeKzL6KxyitpXIVbEaOzGBnFSwrEUeOB.', '98799999999', '964830', 1, '858', '167', '7', '20', 1, 1, 1, 'New Road: #120, Paris, Japan 1500nNana', '7', 'I am a test buyer with test info r 00 1500', NULL, NULL, 1, NULL, 0.00, 0, NULL, '560001', 6, '1', 'BUidWUT7', '8oaqjJSa4Pj4su7V04ihOlg0jWcXTD3WEnRoVlmojX1ffVv6yhdB2pFed5Kx', NULL, NULL, 'IN', '2022-02-09 01:10:01', '2023-11-25 00:17:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-25 00:17:09', '2023-07-20 02:22:33', NULL, NULL, NULL, NULL),
(1933, 'Support Agent', 'support@syanteck.com', 'support', '$2y$10$mv1ph29pxNCUw0Vzv9vZRu/PVD.tQJJmUa2R6FWUHYNcCFYLu/7fu', '0500000001', NULL, 0, NULL, NULL, NULL, NULL, 0, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, '2025-11-14 22:56:58', '2025-12-15 12:16:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-15 12:16:31', NULL, NULL, NULL, NULL, NULL),
(1934, 'Technician', 'technician@syanteck.com', 'technician', '$2y$10$WG/BrUL2eUWogmOfo28pM.eX6XIAb6861ypbcA4O6n4vkacBm8uWC', '0500000002', NULL, 0, NULL, NULL, NULL, NULL, 0, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, '2025-11-14 22:56:59', '2025-11-15 08:11:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:11:50', NULL, NULL, NULL, NULL, NULL),
(1935, 'Client', 'client@syanteck.com', 'client', '$2y$10$jnNCieSc96OBMeaRvXIQruGP2oRujJmtMtIewbDSJk0frwCgBCM/W', '0500000003', NULL, 0, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, '2025-11-14 22:56:59', '2025-11-17 20:26:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-17 20:26:17', NULL, NULL, NULL, NULL, NULL),
(1936, 'Quality Agent', 'quality@syanteck.com', 'quality', '$2y$10$VGWpQg/ws7T043KE3DUZvuo4vVffN97fUV.2Rlc5yiTftk7kLANce', '0500000004', NULL, 0, NULL, NULL, NULL, NULL, 0, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, '2025-11-14 22:56:59', '2025-11-14 22:57:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1937, 'Finance', 'finance@syanteck.com', 'finance', '$2y$10$/OB8pF8d69EyZ30vpVXp9OR8TKZTl6qvnl/KgFr16p6/cg4lh92vK', '0500000005', NULL, 0, NULL, NULL, NULL, NULL, 0, 1, 1, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, '2025-11-14 22:56:59', '2025-11-17 20:27:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-17 20:27:07', NULL, NULL, NULL, NULL, NULL),
(1938, 'محمد أحمد العتيبي', 'client1@makkah.com', 'client_mhmd-ahmd-alaatyby_0', '$2y$10$Mt5fzmnD8oz3uolcpm8l3uVI3kux8Y2zY6kF3w7EKWv3LHJ4AQm.a', '0561565660', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة مخطط ولي العهد 5، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '24595', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:16', '2025-11-15 08:08:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1939, 'فهد سعد القحطاني', 'client2@makkah.com', 'client_fhd-saad-alkhtany_1', '$2y$10$F9/3Jsd5yGt1uwFscE5EW.xhT3kzq5LuuBwxiDvK5LOKlPEDHepte', '0596493535', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الجمعة، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '28439', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:16', '2025-11-15 08:08:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1940, 'عبدالله خالد الحربي', 'client3@makkah.com', 'client_aabdallh-khald-alhrby_2', '$2y$10$7E3kjqJsJP4.64yR8JN5b.4ELlDh4Q0XA5ZOol00dUKL3j48WptH6', '0588502111', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة مخطط ولي العهد 9، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '27926', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:16', '2025-11-15 08:08:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1941, 'سعد محمد الزهراني', 'client4@makkah.com', 'client_saad-mhmd-alzhrany_3', '$2y$10$Oj9k3N7j2ZdeXyk//D5Z8OEJmMWeAi3L0e3hNR/xZzSj5FTEQY2UO', '0519035208', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة مخطط ولي العهد 4، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '26504', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:17', '2025-11-15 08:08:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1942, 'خالد فهد الدوسري', 'client5@makkah.com', 'client_khald-fhd-aldosry_4', '$2y$10$Od4IuY9wV6EQoopXT1KV/eEWBAmWDq3BazNrWzm.R.xZT6FMyW52.', '0589709270', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الشرائع مخطط 11، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '26044', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:17', '2025-11-15 08:08:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1943, 'عمر عبدالرحمن الشهري', 'client6@makkah.com', 'client_aamr-aabdalrhmn-alshhry_5', '$2y$10$9YwTV82OBvNJg6YS6Rwrkeqm.NRl5kT76qxdXoZ14iWvCZDTeChMy', '0549302287', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الخالدية، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '21609', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:17', '2025-11-15 08:08:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1944, 'يوسف إبراهيم المطيري', 'client7@makkah.com', 'client_yosf-abrahym-almtyry_6', '$2y$10$aH9XafUvSO0rq9dN3dlEFe/lZQfRB5tJPwvWhLYhzSkvHuhHNBVGW', '0538934102', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الهجلة، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '21132', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:17', '2025-11-15 08:08:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1945, 'أحمد صالح الغامدي', 'client8@makkah.com', 'client_ahmd-salh-alghamdy_7', '$2y$10$d.wOXGZ4IxETUxP1OT1IZO5lZVV9WyoefIiWx1SpPCI/l6S.6KJOO', '0536267976', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة حي العدل، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '29413', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:17', '2025-11-15 08:08:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1946, 'علي حسن الجهني', 'client9@makkah.com', 'client_aaly-hsn-alghny_8', '$2y$10$26lKR6qkZFz68EcrMkqUU.GGn6JdE0Hf9BndaWsjkxh7evUCSwjUG', '0554798680', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة المعابدة، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '21952', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:17', '2025-11-15 08:08:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1947, 'حسام عبدالله الثقفي', 'client10@makkah.com', 'client_hsam-aabdallh-althkfy_9', '$2y$10$ayv3p/Uyc0b.MFiIbuSiYudcjBBhZ55P9djEUxGkpIXj9QBdSaDsS', '0568735027', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة مخطط ولي العهد 9، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '20873', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:17', '2025-11-15 08:08:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1948, 'ماجد ناصر العسيري', 'client11@makkah.com', 'client_magd-nasr-alaasyry_10', '$2y$10$Q01m8E2dy6xY.lrtyKcKKuSnGNKVT18Sp7Mf8zFcyZFmPctGEXjIi', '0556942501', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الراشدية، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '20237', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:18', '2025-11-15 08:08:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1949, 'بندر طلال البقمي', 'client12@makkah.com', 'client_bndr-tlal-albkmy_11', '$2y$10$lZnvGUyFbO9jI.ygyQ6l9eb4e7bdU2jajWjaUAdrPJigOk/0lNV3i', '0587249257', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة العمرة، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '21192', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:18', '2025-11-15 08:08:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1950, 'سلطان فيصل القرني', 'client13@makkah.com', 'client_sltan-fysl-alkrny_12', '$2y$10$jGVRTaYgLASnkv5c7.52TeHugGIMsjF4N3ah.VSk5TUfZvO1wncbO', '0528156582', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة بطحاء قريش، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '23284', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:18', '2025-11-15 08:08:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1951, 'نايف راشد السبيعي', 'client14@makkah.com', 'client_nayf-rashd-alsbyaay_13', '$2y$10$sTWjRKu4c3lhnrkQFy/t5OauMOuGg2eDrw8n4LfS0.SrBmeyBTiGW', '0570957833', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الزاهية، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '29252', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:18', '2025-11-15 08:08:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1952, 'تركي مشعل العنزي', 'client15@makkah.com', 'client_trky-mshaal-alaanzy_14', '$2y$10$sTEq1T.D54rPGBfUpczinepGlmJvgdWlYXkBtQ..5AF.D3TQa2lvi', '0529486741', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة حي الشرائع الغربية، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '28297', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:18', '2025-11-15 08:08:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1953, 'وليد هشام الرشيد', 'client16@makkah.com', 'client_olyd-hsham-alrshyd_15', '$2y$10$LvMHCD0jImU0W/0ZBjie4er/061/3d7wkVq5jgPMEW9JzRpzjb4za', '0579354651', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة النوارية، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '28132', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:18', '2025-11-15 08:08:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1954, 'بدر خليفة المالكي', 'client17@makkah.com', 'client_bdr-khlyf-almalky_16', '$2y$10$WYaqp2PI.WB7x7ErGnrWN.QT.nKuDmi68vA.FLMH8oCkj5zaQ66jK', '0568943236', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة مخطط ولي العهد 5، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '29835', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:18', '2025-11-15 08:08:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1955, 'فيصل عبدالعزيز الشمري', 'client18@makkah.com', 'client_fysl-aabdalaazyz-alshmry_17', '$2y$10$/hUwVJS4yiORO4d8KycUA.OX4o69q48tV4v4hU.axttQ7tWBWCRUO', '0511301735', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة حي الشوقية الشمالية، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '23783', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:19', '2025-11-15 08:08:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1956, 'عبدالرحمن سليمان العلي', 'client19@makkah.com', 'client_aabdalrhmn-slyman-alaaly_18', '$2y$10$K7i12R3AoIS5KhyzB4foguvYCnHwNnzVnWfPM.7noNJKhvR2zSWVm', '0522596665', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة مخطط ولي العهد 7، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '20008', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:19', '2025-11-15 08:08:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1957, 'مشعل نايف الحارثي', 'client20@makkah.com', 'client_mshaal-nayf-alharthy_19', '$2y$10$DGGFMM84lGV4cGWwEGRYBePb8/R/wUZlafJtYOUhpo6p.J1GVtc6O', '0532721263', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الشرائع مخطط 11، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '25672', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:19', '2025-11-15 08:08:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1958, 'راشد فهد البقمي', 'client21@makkah.com', 'client_rashd-fhd-albkmy_20', '$2y$10$l3bprFCvrMQ6u4c.nJzoweJ3zdz4epDI9Dc3UsR9yg5oYjj5DvfZO', '0566166669', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الجمعة، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '24653', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:19', '2025-11-15 08:08:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1959, 'عبدالعزيز محمد العتيبي', 'client22@makkah.com', 'client_aabdalaazyz-mhmd-alaatyby_21', '$2y$10$arhiKJ8Gzb8GaSE4grrBF.UFy38CCHrJcc9et2GR/.Pl8Vc2af0sm', '0574630812', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الرصيفة، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '28159', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:19', '2025-11-15 08:08:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1960, 'منصور خالد القحطاني', 'client23@makkah.com', 'client_mnsor-khald-alkhtany_22', '$2y$10$YoBisbed4xAhs82NX9JKxu2jR8ug0gWBMvAXnNihWXop6Fit3k5Ki', '0562934397', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة حي النسيم، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '26988', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:19', '2025-11-15 08:08:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1961, 'مشاري سعد الحربي', 'client24@makkah.com', 'client_mshary-saad-alhrby_23', '$2y$10$ad2ghyAPAqP3J1Bzc3YqgeOGNtLglLnsaKyKfVsPD8UDYJVxpkcgi', '0595696138', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الهجرة، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '26392', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:19', '2025-11-15 08:08:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1962, 'عبدالمحسن فهد الزهراني', 'client25@makkah.com', 'client_aabdalmhsn-fhd-alzhrany_24', '$2y$10$RxjEATMnN2CMalNVvHv1becUxgkZEY/TAs9o/EaLlGzomK8LuwtZe', '0582998691', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة حي الشرائع الغربية، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '28610', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:20', '2025-11-15 08:08:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1963, 'سلمان عبدالله الدوسري', 'client26@makkah.com', 'client_slman-aabdallh-aldosry_25', '$2y$10$dHEUdHF4eEall0e5BYV8WObFnRM7Zedg/MbXD1V56dH8CcyeP7oXO', '0565307075', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة أجياد، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '27972', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:20', '2025-11-15 08:08:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1964, 'مشعل عمر الشهري', 'client27@makkah.com', 'client_mshaal-aamr-alshhry_26', '$2y$10$8AKpXe2irRNjsT33dkn6Xu0YE61ZCsHRJzcONKRWsy0YRDS/3jb5e', '0554452731', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الشرائع مخطط 4، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '24067', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:20', '2025-11-15 08:08:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1965, 'عبداللطيف يوسف المطيري', 'client28@makkah.com', 'client_aabdalltyf-yosf-almtyry_27', '$2y$10$PWteL1cSDYDv/ERXT/T7neJOb.SZICUEREWfN0ZH2jjGT4j77wu9q', '0551788973', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الشرائع مخطط 10، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '29744', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:20', '2025-11-15 08:08:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1966, 'عبدالمجيد أحمد الغامدي', 'client29@makkah.com', 'client_aabdalmgyd-ahmd-alghamdy_28', '$2y$10$jlezRF.YCF7X1kQz/rsqqe2VHfEmEOdCI2zCmGiu6qOxiq/zyhuka', '0546463363', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة المسفلة، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '25210', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:20', '2025-11-15 08:08:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1967, 'عبدالهادي علي الجهني', 'client30@makkah.com', 'client_aabdalhady-aaly-alghny_29', '$2y$10$eOGGFndLD8tVfcuvGoVDMuBu3MkuHz4intDWTXcBBG17DDqnzpMYq', '0518901689', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة حي الشرائع الغربية، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '23541', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:20', '2025-11-15 08:08:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1968, 'فني محمد العتيبي', 'tech1@makkah.com', 'tech_fny-mhmd-alaatyby_0', '$2y$10$wXfqw8kUSPH9VAPy6Onb1OnC0Ai2JqpEbcc9R51fygOFfmUw415q2', '0573975812', NULL, 0, NULL, NULL, '50', NULL, 1, 1, 1, 'مكة المكرمة', NULL, NULL, NULL, '\"[116,141,160]\"', 1, NULL, 4.30, 15, NULL, NULL, 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:20', '2025-11-15 08:08:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1969, 'فني فهد القحطاني', 'tech2@makkah.com', 'tech_fny-fhd-alkhtany_1', '$2y$10$iqO7K7H6zJjdxMjm.TA/8.uOx3p.65dA6d3Ut4RWvZ1fd4uz5MWz6', '0599791503', NULL, 0, NULL, NULL, '50', NULL, 1, 1, 1, 'مكة المكرمة', NULL, NULL, NULL, '\"[120,132,138,165]\"', 1, NULL, 4.00, 10, NULL, NULL, 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:21', '2025-11-15 08:08:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1970, 'فني عبدالله الحربي', 'tech3@makkah.com', 'tech_fny-aabdallh-alhrby_2', '$2y$10$I/c2eYGP1xVq3AjBwsgebeoPWvVQrcwRO2LvfpxBnfQrX1p5r/O.y', '0548938682', NULL, 0, NULL, NULL, '50', NULL, 1, 1, 1, 'مكة المكرمة', NULL, NULL, NULL, '\"[116,133,137,157]\"', 1, NULL, 4.80, 46, NULL, NULL, 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:21', '2025-11-15 08:08:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1971, 'فني سعد الزهراني', 'tech4@makkah.com', 'tech_fny-saad-alzhrany_3', '$2y$10$CI3LmkZ79b27zphdU9dm0uC7U/92OpN7q/VqOhrAYVF/BaB3qpbWe', '0529522612', NULL, 0, NULL, NULL, '50', NULL, 1, 1, 1, 'مكة المكرمة', NULL, NULL, NULL, '\"[114,124,140,148,151]\"', 1, NULL, 4.90, 40, NULL, NULL, 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:21', '2025-11-15 08:08:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1972, 'فني خالد الدوسري', 'tech5@makkah.com', 'tech_fny-khald-aldosry_4', '$2y$10$j6/gQJ39nnfkj7apKdxZ0OptP4ACgyj5ziTDiwIzJOG3eMChC5UrK', '0558530169', NULL, 0, NULL, NULL, '50', NULL, 1, 1, 1, 'مكة المكرمة', NULL, NULL, NULL, '\"[124,132,157]\"', 1, NULL, 4.10, 52, NULL, NULL, 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:21', '2025-11-15 08:08:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1973, 'فني عمر الشهري', 'tech6@makkah.com', 'tech_fny-aamr-alshhry_5', '$2y$10$.qx0mKPwAyhrHA0G9rj.iug23.K9B8GiXtQiH13JntP3X.9zqCzCe', '0558562932', NULL, 0, NULL, NULL, '50', NULL, 1, 1, 1, 'مكة المكرمة', NULL, NULL, NULL, '\"[138,142,163]\"', 0, NULL, 4.30, 84, NULL, NULL, 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:08:21', '2025-11-15 08:08:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1975, 'محمد أحمد العتيبي', 'client1_1763201562@makkah.com', 'client_mhmd-ahmd-alaatyby_0_1763201562_6918521a216a5', '$2y$10$WQEkRf7v0BttcW6BD01fSepOy8/iKnHNMPyXA9RnL2CctEv/pp8la', '0524187232', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الجمعة، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '22031', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:42', '2025-11-15 08:12:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1976, 'فهد سعد القحطاني', 'client2_1763201562@makkah.com', 'client_fhd-saad-alkhtany_1_1763201562_6918521a5193b', '$2y$10$CMZKo.knNvW/FcjWKSBVRuL3eo6HuEpRulVKRVnRHwV4MLcx94thq', '0590010869', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الجمعة، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '21181', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:42', '2025-11-15 08:12:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1977, 'عبدالله خالد الحربي', 'client3_1763201562@makkah.com', 'client_aabdallh-khald-alhrby_2_1763201562_6918521a75de9', '$2y$10$pEmqhg/4r3AZCBXUsR4XRufDKTqh0/gFt9bIsg2IodhRLiuTy8WY6', '0536826068', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الشرائع مخطط 1، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '20874', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:42', '2025-11-15 08:12:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1978, 'سعد محمد الزهراني', 'client4_1763201562@makkah.com', 'client_saad-mhmd-alzhrany_3_1763201562_6918521a9aba8', '$2y$10$A.WTxYZvUjjZdXZJBZadcOYTePfOz611WLUCfBSNjC26kuK9D7H7C', '0535474519', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الشرائع مخطط 8، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '20678', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:42', '2025-11-15 08:12:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1979, 'خالد فهد الدوسري', 'client5_1763201562@makkah.com', 'client_khald-fhd-aldosry_4_1763201562_6918521abfe70', '$2y$10$Rg5psk9l1gpeEUD32SautOk8dMF6iiAQJYiAztnC6DjGHM4yoB06G', '0527658011', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الشرائع مخطط 2، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '20216', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:42', '2025-11-15 08:12:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1980, 'عمر عبدالرحمن الشهري', 'client6_1763201562@makkah.com', 'client_aamr-aabdalrhmn-alshhry_5_1763201562_6918521ae3fc8', '$2y$10$JF4fEtveZVlfvKBjHdO1Uuf1D4nPjj4cBKY5FAGISpr5TCqWlALZy', '0554058278', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة بطحاء قريش، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '22513', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:43', '2025-11-15 08:12:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1981, 'يوسف إبراهيم المطيري', 'client7_1763201563@makkah.com', 'client_yosf-abrahym-almtyry_6_1763201563_6918521b168df', '$2y$10$jyUliuyjjdvsyI7nh.QXIOrxsUre1BajLjisb/cVG00iRgrO6LvPi', '0563078030', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الشرائع مخطط 8، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '26986', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:43', '2025-11-15 08:12:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1982, 'أحمد صالح الغامدي', 'client8_1763201563@makkah.com', 'client_ahmd-salh-alghamdy_7_1763201563_6918521be3d9f', '$2y$10$Q1.Sa9l5Gji6uBp.n2jkHuywz7qzL8SJcJO80aMEYhMUpQ/5yvr6u', '0552902442', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الشرائع مخطط 4، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '26253', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:44', '2025-11-15 08:12:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1983, 'علي حسن الجهني', 'client9_1763201564@makkah.com', 'client_aaly-hsn-alghny_8_1763201564_6918521c4fc62', '$2y$10$HK8pSXMkxEjGhfkvg7LKGOzdy7Xrbt9Il3AKBwEr/SXiUvRdBMsIS', '0587856610', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الزهراء، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '21585', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:44', '2025-11-15 08:12:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1984, 'حسام عبدالله الثقفي', 'client10_1763201564@makkah.com', 'client_hsam-aabdallh-althkfy_9_1763201564_6918521c85453', '$2y$10$aP10p8ndlqryPh9fwPkmOOq/RtlIixvRIohGvUAC9oTqGlCQYpM6q', '0569293654', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الشرائع مخطط 1، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '23073', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:44', '2025-11-15 08:12:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1985, 'ماجد ناصر العسيري', 'client11_1763201564@makkah.com', 'client_magd-nasr-alaasyry_10_1763201564_6918521cbe757', '$2y$10$ch4JxyAZc7Gf7pQy0xCkrukTAaW5NeEuHPWambR1JTuxU39QxsB1W', '0545654654', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الهجرة، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '24761', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:44', '2025-11-15 08:12:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1986, 'بندر طلال البقمي', 'client12_1763201564@makkah.com', 'client_bndr-tlal-albkmy_11_1763201564_6918521cee3ff', '$2y$10$XeKWv9Yy5qbuHP0q93ngz.UQsEDL8FXnwCqv//Yoh3K8kdrmF4dm2', '0575719792', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة القرارة، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '29812', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:45', '2025-11-15 08:12:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1987, 'سلطان فيصل القرني', 'client13_1763201565@makkah.com', 'client_sltan-fysl-alkrny_12_1763201565_6918521d1e233', '$2y$10$BKxRlRy1Kb5QE9FRznEBMeT/Cl0i6xsrPb.N.0Kwg.jL4prW9YnG2', '0516461902', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الزاهر، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '27442', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:45', '2025-11-15 08:12:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1988, 'نايف راشد السبيعي', 'client14_1763201565@makkah.com', 'client_nayf-rashd-alsbyaay_13_1763201565_6918521d4138e', '$2y$10$vmpyqP45blXLgFs0/z5EEuhW1JbGSN1QbPuBVZCjQcrqn5HsgFRd6', '0511441785', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة حي الشرائع الغربية، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '21137', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:45', '2025-11-15 08:12:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1989, 'تركي مشعل العنزي', 'client15_1763201565@makkah.com', 'client_trky-mshaal-alaanzy_14_1763201565_6918521d67bca', '$2y$10$dQSD3Yr3t/nmO3jucnsokuX3RzP933ApqaNwLSBj6M.DdwizPBcJK', '0595728186', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة مخطط ولي العهد 2، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '25739', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:45', '2025-11-15 08:12:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1990, 'وليد هشام الرشيد', 'client16_1763201565@makkah.com', 'client_olyd-hsham-alrshyd_15_1763201565_6918521dbc143', '$2y$10$gNSGY4Ary5TMaKN0XdnwauQGhVuGiebtyNgyHyE/5FtTN6DQS8w0K', '0574342296', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة حي العدل، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '24220', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:45', '2025-11-15 08:12:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1991, 'بدر خليفة المالكي', 'client17_1763201566@makkah.com', 'client_bdr-khlyf-almalky_16_1763201566_6918521e07aac', '$2y$10$HAOiQVGQO7OKiqTZVKJYE.JCgkeUjfhgAMrH9Tjcm4YLyYU/9/Txa', '0599247784', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة حي النسيم، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '20056', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:46', '2025-11-15 08:12:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1992, 'فيصل عبدالعزيز الشمري', 'client18_1763201566@makkah.com', 'client_fysl-aabdalaazyz-alshmry_17_1763201566_6918521e615fb', '$2y$10$cqI0qxh1QbhmpeAKFH4aCuiO5OhKmepwhFcWqUkn2gmUcsS1/MdfO', '0546945327', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة مخطط ولي العهد 4، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '20344', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:46', '2025-11-15 08:12:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1993, 'عبدالرحمن سليمان العلي', 'client19_1763201566@makkah.com', 'client_aabdalrhmn-slyman-alaaly_18_1763201566_6918521e91b0d', '$2y$10$j2sxwbOsGywWr3uVqDU8yetXCKrKSzwjIpCZQdiDkY4aOtPNRjB6i', '0552656737', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الفيحاء، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '29074', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:46', '2025-11-15 08:12:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1994, 'مشعل نايف الحارثي', 'client20_1763201566@makkah.com', 'client_mshaal-nayf-alharthy_19_1763201566_6918521eba388', '$2y$10$d8gP6L/IBjVD/VGSzzQnDOnxAS2YBaC5sDVE3KFCBZWBbjlEXpWae', '0516383782', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة مخطط ولي العهد 5، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '26418', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:46', '2025-11-15 08:12:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1995, 'راشد فهد البقمي', 'client21_1763201566@makkah.com', 'client_rashd-fhd-albkmy_20_1763201566_6918521edcfb2', '$2y$10$9oTqH/tNJVt6Ucof2jn2d./0XGKha8EdywcLN73vnctbo1agEPdAa', '0516138517', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الراشدية، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '28981', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:47', '2025-11-15 08:12:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1996, 'عبدالعزيز محمد العتيبي', 'client22_1763201567@makkah.com', 'client_aabdalaazyz-mhmd-alaatyby_21_1763201567_6918521f7e755', '$2y$10$ul5/3t3ejREc48a7FaKf8.ffh.Rp6VBiKmrNshzuIaO1iMkowP94K', '0569835966', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الزهراء، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '28251', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:47', '2025-11-15 08:12:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1997, 'منصور خالد القحطاني', 'client23_1763201567@makkah.com', 'client_mnsor-khald-alkhtany_22_1763201567_6918521fe8ae8', '$2y$10$BaIeroNa4BFtcrxNxaK67eDFA32zOqC.a/mDjDemzW8bHEQl4.Z.O', '0596806680', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الشرائع مخطط 11، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '25934', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:48', '2025-11-15 08:12:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1998, 'مشاري سعد الحربي', 'client24_1763201568@makkah.com', 'client_mshary-saad-alhrby_23_1763201568_691852201e6d4', '$2y$10$OqRaTMHZ0qi5W.yGp3MTwumqrMpyyVJnQSFDFzDqD2QRtlztRvEMy', '0536475095', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الرصيفة، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '25520', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:48', '2025-11-15 08:12:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1999, 'عبدالمحسن فهد الزهراني', 'client25_1763201568@makkah.com', 'client_aabdalmhsn-fhd-alzhrany_24_1763201568_6918522041f99', '$2y$10$75ktQ0HT.X7DTwZXOI.1WO3Mu7TzpHSiG6P7u8aQDU9NeW2g9BIUO', '0591019307', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الشرائع مخطط 5، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '22206', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:48', '2025-11-15 08:12:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2000, 'سلمان عبدالله الدوسري', 'client26_1763201568@makkah.com', 'client_slman-aabdallh-aldosry_25_1763201568_6918522066c4a', '$2y$10$rvjuE/MyJED63vVvjn7JZ.Uin3xbCDPAU6JQUubclOxyEBqxc.FXy', '0523018223', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الشرائع مخطط 6، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '22960', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:48', '2025-11-15 08:12:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2001, 'مشعل عمر الشهري', 'client27_1763201568@makkah.com', 'client_mshaal-aamr-alshhry_26_1763201568_691852208f09d', '$2y$10$gWez.HPsanTZs5EqTI2bmOXEG2vAigjVRnoHq1LET311dt3CRVTgW', '0558318132', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الراشدية، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '24113', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:48', '2025-11-15 08:12:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2002, 'عبداللطيف يوسف المطيري', 'client28_1763201568@makkah.com', 'client_aabdalltyf-yosf-almtyry_27_1763201568_69185220b5402', '$2y$10$KhyMcXfIg9iHRbDM9nBh8u1su6B94eKMGLfxsKmfg7jycWBjQSh8G', '0589414939', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة كدي، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '20435', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:48', '2025-11-15 08:12:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2003, 'عبدالمجيد أحمد الغامدي', 'client29_1763201568@makkah.com', 'client_aabdalmgyd-ahmd-alghamdy_28_1763201568_69185220dae50', '$2y$10$eHdmJV/EBlPEeXXZtWc30.iyWo0PLH/0qzm0pKptbV8qH1pulzBRm', '0554187979', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة كدي، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '22087', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:49', '2025-11-15 08:12:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2004, 'عبدالهادي علي الجهني', 'client30_1763201569@makkah.com', 'client_aabdalhady-aaly-alghny_29_1763201569_6918522115909', '$2y$10$3z6toX/kngsR3iQ5IX7P3eMlFpQP67qQ9si1I0WN7pbIS3VwUzoxG', '0583152371', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة بطحاء قريش، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '21537', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:49', '2025-11-15 08:12:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2005, 'فني محمد العتيبي', 'tech1_1763201569@makkah.com', 'tech_fny-mhmd-alaatyby_0_1763201569_69185221398dc', '$2y$10$h/JIo7Fs4HYGGW1zgI5ssO/edTeYwoyal97hvoj8PNuWvMeN5B2zS', '0521846672', NULL, 0, NULL, NULL, '50', NULL, 1, 1, 1, 'مكة المكرمة', NULL, NULL, NULL, '\"[132,135,145,149,155]\"', 1, NULL, 4.30, 43, NULL, NULL, 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:49', '2025-11-15 08:12:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2006, 'فني فهد القحطاني', 'tech2_1763201569@makkah.com', 'tech_fny-fhd-alkhtany_1_1763201569_691852215ea5b', '$2y$10$9D6a2k8GS5.VtYbAYTw1OOeZxSJ.fbqq1WMAlervEEv6KCPDRnaFW', '0522620619', NULL, 0, NULL, NULL, '50', NULL, 1, 1, 1, 'مكة المكرمة', NULL, NULL, NULL, '\"[113,130,135,153,155,163]\"', 0, NULL, 4.40, 68, NULL, NULL, 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:49', '2025-11-15 08:12:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2007, 'فني عبدالله الحربي', 'tech3_1763201569@makkah.com', 'tech_fny-aabdallh-alhrby_2_1763201569_69185221845c3', '$2y$10$Nu9xJUGL0sk6.C3/OC/vI.u3kgNEBHSheBKs4iPzgYtGw3l3YJdFa', '0580227247', NULL, 0, NULL, NULL, '50', NULL, 1, 1, 1, 'مكة المكرمة', NULL, NULL, NULL, '\"[114,117,128,142,163]\"', 1, NULL, 4.90, 96, NULL, NULL, 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:49', '2025-11-15 08:12:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2008, 'فني سعد الزهراني', 'tech4_1763201569@makkah.com', 'tech_fny-saad-alzhrany_3_1763201569_69185221abe3c', '$2y$10$lEixLF9qMRsDu80Wk3t/Ue7tJbgXlG5dNnd11dagKWajH8KASRjLe', '0554204435', NULL, 0, NULL, NULL, '50', NULL, 1, 1, 1, 'مكة المكرمة', NULL, NULL, NULL, '\"[120,121,124,133,138,161]\"', 1, NULL, 4.50, 50, NULL, NULL, 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:49', '2025-11-15 08:12:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2009, 'فني خالد الدوسري', 'tech5_1763201569@makkah.com', 'tech_fny-khald-aldosry_4_1763201569_69185221d207a', '$2y$10$n4ej922PsLusAt4Eorlhc.iwJKWAOhNqJd7Vmx5sbqVP96sj0YSU6', '0531798179', NULL, 0, NULL, NULL, '50', NULL, 1, 1, 1, 'مكة المكرمة', NULL, NULL, NULL, '\"[126,137,139,151,163]\"', 1, NULL, 4.90, 20, NULL, NULL, 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:49', '2025-11-15 08:12:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2010, 'فني عمر الشهري', 'tech6_1763201570@makkah.com', 'tech_fny-aamr-alshhry_5_1763201570_6918522202db5', '$2y$10$wXH05e1wZuuWArygm0Lx2uprDgpLvIIeCcRfc.Y9Tswyg3lUOUk5y', '0573361179', NULL, 0, NULL, NULL, '50', NULL, 1, 1, 1, 'مكة المكرمة', NULL, NULL, NULL, '\"[117,156,164]\"', 0, NULL, 4.20, 75, NULL, NULL, 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:12:50', '2025-11-15 08:12:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2011, 'محمد أحمد العتيبي', 'client1_1763201584@makkah.com', 'client_mhmd-ahmd-alaatyby_0_1763201584_691852306318a', '$2y$10$M9XCTmf5y5IDGMb1X4rkfum5cHa2AVH03vdQf6DGZ.4cMx74dumsi', '0594884739', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الشرائع مخطط 7، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '20409', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:04', '2025-11-15 08:13:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2012, 'فهد سعد القحطاني', 'client2_1763201584@makkah.com', 'client_fhd-saad-alkhtany_1_1763201584_691852308914a', '$2y$10$PUyYstAmNm89qMMQqdllTeTsXIpvADkXo/vp1nH/4LAiIlzt3.itm', '0550868510', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الفيحاء، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '27316', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:04', '2025-11-15 08:13:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2013, 'عبدالله خالد الحربي', 'client3_1763201584@makkah.com', 'client_aabdallh-khald-alhrby_2_1763201584_69185230ad677', '$2y$10$3VjAXiE3a7cprT.i7AjnSufTrKxXHRRcsnxydHIHXPRH7acIlWF56', '0532458562', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الشرائع مخطط 10، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '25648', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:04', '2025-11-15 08:13:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2014, 'سعد محمد الزهراني', 'client4_1763201584@makkah.com', 'client_saad-mhmd-alzhrany_3_1763201584_69185230d09bd', '$2y$10$KSfUN9d6uQA1/NkNQ0jiUur3Hp4QXMqkT4EbFnmkaZpT01ETSuGz2', '0524946839', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة المعابدة، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '24690', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:04', '2025-11-15 08:13:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2015, 'خالد فهد الدوسري', 'client5_1763201585@makkah.com', 'client_khald-fhd-aldosry_4_1763201585_691852310001e', '$2y$10$EKnCipRqRMB0TjoWNKxZ.ermD6hBrFk6zP.vUQIxO8hTrNzILx6Yq', '0557716678', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة التنعيم الشرقي، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '26779', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:05', '2025-11-15 08:13:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2016, 'عمر عبدالرحمن الشهري', 'client6_1763201585@makkah.com', 'client_aamr-aabdalrhmn-alshhry_5_1763201585_69185231236c6', '$2y$10$OdECq3qE7MI6xfDZ./b7iuHZJmahimlQ9WwPLibOdZggnBQu6Kh4i', '0512585984', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة مخطط ولي العهد 2، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '24808', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:05', '2025-11-15 08:13:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2017, 'يوسف إبراهيم المطيري', 'client7_1763201585@makkah.com', 'client_yosf-abrahym-almtyry_6_1763201585_6918523145fd2', '$2y$10$TieYhn3CTq2dMdreuMVZnO2vX248cCOtOz4373mMjfGY4OUi5tjQa', '0594828550', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الشرائع مخطط 2، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '27162', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:05', '2025-11-15 08:13:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2018, 'أحمد صالح الغامدي', 'client8_1763201585@makkah.com', 'client_ahmd-salh-alghamdy_7_1763201585_69185231692f4', '$2y$10$U5jj4VMNhRyIIC3q0NEkOeeqf85D2hOcbDTqGqICKuWogEUE/45vK', '0529273477', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة مخطط ولي العهد 4، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '28088', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:05', '2025-11-15 08:13:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2019, 'علي حسن الجهني', 'client9_1763201585@makkah.com', 'client_aaly-hsn-alghny_8_1763201585_691852318e57b', '$2y$10$jnWT9CK6Jb.cwq1zLOAkLuvMyGj141VQ0CPADeKG/m8I6l5h8EdwK', '0539905060', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الشرائع مخطط 10، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '20908', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:05', '2025-11-15 08:13:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2020, 'حسام عبدالله الثقفي', 'client10_1763201585@makkah.com', 'client_hsam-aabdallh-althkfy_9_1763201585_69185231b326d', '$2y$10$9xuSIdDHJdXo31VwunILjORgW5XxevSZPltCvHpeghLBUDLo28lfy', '0541195728', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الزهراء، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '25936', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:05', '2025-11-15 08:13:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2021, 'ماجد ناصر العسيري', 'client11_1763201585@makkah.com', 'client_magd-nasr-alaasyry_10_1763201585_69185231d62c9', '$2y$10$/PWTPZCfTe/p0GZO0t2G7er8Bd5je2hmY8IAo7Z62tnK6ETHf1JTu', '0551215844', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الشرائع مخطط 7، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '21167', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:06', '2025-11-15 08:13:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2022, 'بندر طلال البقمي', 'client12_1763201586@makkah.com', 'client_bndr-tlal-albkmy_11_1763201586_6918523204ad0', '$2y$10$vSMXUSLqQinlVO3Zcx/gXunKABOBQxqHOC7AUZBUc4TWYnCvH4sCW', '0578835228', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الكعكية، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '27553', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:06', '2025-11-15 08:13:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2023, 'سلطان فيصل القرني', 'client13_1763201586@makkah.com', 'client_sltan-fysl-alkrny_12_1763201586_69185232269c1', '$2y$10$O.IbffdVi5D3Q8LbiRkEuu0HnrD5tH/KzUFXgg6SXYhLuqSBFyYJ.', '0578758004', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة العزيزية الشمالية، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '22675', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:06', '2025-11-15 08:13:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2024, 'نايف راشد السبيعي', 'client14_1763201586@makkah.com', 'client_nayf-rashd-alsbyaay_13_1763201586_6918523249303', '$2y$10$TDafq7Ua.HKdvx8ANkiiKu0jLp5yFo/dNG4TbE.4qldHW4cX0Z8mq', '0572507436', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة حي النسيم، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '26866', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:06', '2025-11-15 08:13:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `phone`, `otp_code`, `otp_verified`, `image`, `profile_background`, `service_city`, `service_area`, `user_type`, `user_status`, `terms_condition`, `address`, `state`, `about`, `specializations`, `assigned_regions`, `is_available`, `technician_code`, `rating`, `completed_orders_count`, `tax_number`, `post_code`, `country_id`, `email_verified`, `email_verify_token`, `remember_token`, `facebook_id`, `google_id`, `country_code`, `created_at`, `updated_at`, `password_changed_at`, `fb_url`, `tw_url`, `go_url`, `li_url`, `yo_url`, `in_url`, `twi_url`, `pi_url`, `dr_url`, `re_url`, `last_seen`, `otp_expire_at`, `zone_id`, `latitude`, `longitude`, `seller_address`) VALUES
(2025, 'تركي مشعل العنزي', 'client15_1763201586@makkah.com', 'client_trky-mshaal-alaanzy_14_1763201586_691852326b4eb', '$2y$10$yFrt1d4ck.5Eu8ndA8WYJ.MJdZL7xvmCkhbA6oecqmIs8isk.bCuO', '0538757488', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الرصيفة، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '24236', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:06', '2025-11-15 08:13:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2026, 'وليد هشام الرشيد', 'client16_1763201586@makkah.com', 'client_olyd-hsham-alrshyd_15_1763201586_691852328e6b4', '$2y$10$yVZxRyv.HJp7jBghCPnfIOTc2fAb3Bix4M.ncFvtsj8bRa96Tv0um', '0578879564', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الريان، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '20141', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:06', '2025-11-15 08:13:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2027, 'بدر خليفة المالكي', 'client17_1763201586@makkah.com', 'client_bdr-khlyf-almalky_16_1763201586_69185232b2784', '$2y$10$Ymqlp.UpVxinBr735Wk2l.km4RJsLAZ.BzEJmsVKdTYnOyVRWGTWC', '0564151452', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة حي الشرائع الغربية، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '27981', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:06', '2025-11-15 08:13:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2028, 'فيصل عبدالعزيز الشمري', 'client18_1763201586@makkah.com', 'client_fysl-aabdalaazyz-alshmry_17_1763201586_69185232d63a0', '$2y$10$Td6s.mohXi8Etj7QANeFLOiRZ/A5Ef2fD3brLq5rkP555ovE3QoO.', '0574171648', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة القرارة، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '28255', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:07', '2025-11-15 08:13:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2029, 'عبدالرحمن سليمان العلي', 'client19_1763201587@makkah.com', 'client_aabdalrhmn-slyman-alaaly_18_1763201587_6918523305a23', '$2y$10$rUDEcwE8phYYBr13FRpXWOjjc8qT.Vu686rE1WzpCKQWUfXkdqGo.', '0532801480', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الشامية، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '26907', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:07', '2025-11-15 08:13:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2030, 'مشعل نايف الحارثي', 'client20_1763201587@makkah.com', 'client_mshaal-nayf-alharthy_19_1763201587_6918523328965', '$2y$10$PS/xqtnGXAPjR5VVkFPuk.5/2mMgYK.AziSzEDX1oQ60SU0e0HRSu', '0585548972', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة بطحاء قريش، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '22035', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:07', '2025-11-15 08:13:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2031, 'راشد فهد البقمي', 'client21_1763201587@makkah.com', 'client_rashd-fhd-albkmy_20_1763201587_691852334b37f', '$2y$10$AUpIt9WVUKimW6U8TsIvBut7EWhqhAdZ6.T0UJWo5ytSt0Lu6Z.d.', '0588952451', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الشرائع مخطط 10، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '27394', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:07', '2025-11-15 08:13:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2032, 'عبدالعزيز محمد العتيبي', 'client22_1763201587@makkah.com', 'client_aabdalaazyz-mhmd-alaatyby_21_1763201587_691852336ed86', '$2y$10$OVi1RacZXJ3IdIyO0LMYGePP7S4KBUdQIUMd94ErOFkLwVbB3A.wK', '0584259332', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة مخطط ولي العهد 2، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '22051', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:07', '2025-11-15 08:13:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2033, 'منصور خالد القحطاني', 'client23_1763201587@makkah.com', 'client_mnsor-khald-alkhtany_22_1763201587_6918523393002', '$2y$10$xo9sxl7iHoh.lgS9xFs3KuZNRJTtJYaRZqlKcsPjy5GYnvRUiuZMW', '0533214404', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الاسكان، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '27742', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:07', '2025-11-15 08:13:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2034, 'مشاري سعد الحربي', 'client24_1763201587@makkah.com', 'client_mshary-saad-alhrby_23_1763201587_69185233b6a38', '$2y$10$mAg5eCUnX35E9pia9VD/3.2tluS2Z/aVtg6mOB2rsbbSlqJ9EVw72', '0555501867', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة مخطط ولي العهد 7، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '25425', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:07', '2025-11-15 08:13:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2035, 'عبدالمحسن فهد الزهراني', 'client25_1763201587@makkah.com', 'client_aabdalmhsn-fhd-alzhrany_24_1763201587_69185233d965f', '$2y$10$gZ3Wj94fSx43VL7UaCXhOOwt0qE1PSrL0J0zu185HK2KzgAKETPEa', '0539694782', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة المسفلة، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '28474', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:08', '2025-11-15 08:13:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2036, 'سلمان عبدالله الدوسري', 'client26_1763201588@makkah.com', 'client_slman-aabdallh-aldosry_25_1763201588_6918523407b9a', '$2y$10$89yZucBF2ZOLGBMKpm3L3O9Jf53pZ.bS6nuQ/fwPXtxM.Z61V5tzO', '0543927182', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة جبل عمر، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '26639', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:08', '2025-11-15 08:13:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2037, 'مشعل عمر الشهري', 'client27_1763201588@makkah.com', 'client_mshaal-aamr-alshhry_26_1763201588_6918523429ee6', '$2y$10$Ng2aK.KHKDwKVmnlLOjQDOebCfxiH3/y9tqzrmwSjI4pIYprbiFem', '0535551528', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة مخطط ولي العهد 8، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '20735', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:08', '2025-11-15 08:13:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2038, 'عبداللطيف يوسف المطيري', 'client28_1763201588@makkah.com', 'client_aabdalltyf-yosf-almtyry_27_1763201588_691852344cb6b', '$2y$10$fu6n/q91.3sogZgOREnsm.6We/ILShqjedBDam723qsY8s6Zb.5Qy', '0542856336', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة الجمعة، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '26178', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:08', '2025-11-15 08:13:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2039, 'عبدالمجيد أحمد الغامدي', 'client29_1763201588@makkah.com', 'client_aabdalmgyd-ahmd-alghamdy_28_1763201588_69185234710e0', '$2y$10$pysy7faG36zNUfhvxWlB5eymS2efapaeZSvqwNcuJhZTaJoWzpxTi', '0593466392', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة العزيزية الشمالية، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '25921', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:08', '2025-11-15 08:13:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2040, 'عبدالهادي علي الجهني', 'client30_1763201588@makkah.com', 'client_aabdalhady-aaly-alghny_29_1763201588_691852349400a', '$2y$10$G2bA9oC5wmz3s7ko7g7iFe0UXaCwiTOeyNSr4Isn1B.MPdhYFr2S.', '0547417805', NULL, 0, NULL, NULL, '50', NULL, 0, 1, 1, 'منطقة جبل عمر، مكة المكرمة', NULL, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, '20224', 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:08', '2025-11-15 08:13:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2041, 'فني محمد العتيبي', 'tech1_1763201588@makkah.com', 'tech_fny-mhmd-alaatyby_0_1763201588_69185234b7b2f', '$2y$10$aOm7RORkeCS0JsWi4e0S6uYTheI9zy/U3sxqdcWBu9keuHpJ.v0vK', '0518409892', NULL, 0, NULL, NULL, '50', NULL, 1, 1, 1, 'مكة المكرمة', NULL, NULL, NULL, '\"[124,136,140,147,157,158]\"', 1, NULL, 5.00, 85, NULL, NULL, 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:08', '2025-11-15 08:13:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2042, 'فني فهد القحطاني', 'tech2_1763201588@makkah.com', 'tech_fny-fhd-alkhtany_1_1763201588_69185234e01a3', '$2y$10$e1pfhCCNF1qolXuiGzKqceaI9S3iKGLw8y32RwUv.9q/OuA40pGBm', '0534993003', NULL, 0, NULL, NULL, '50', NULL, 1, 1, 1, 'مكة المكرمة', NULL, NULL, NULL, '\"[123,136,140,155]\"', 0, NULL, 4.60, 37, NULL, NULL, 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:09', '2025-11-15 08:13:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2043, 'فني عبدالله الحربي', 'tech3_1763201589@makkah.com', 'tech_fny-aabdallh-alhrby_2_1763201589_6918523511327', '$2y$10$E6e/.0.hp.qpb3g080Me0ebWGePXUx2sy7jUL58eT.1SmCG9kV7AG', '0541482901', NULL, 0, NULL, NULL, '50', NULL, 1, 1, 1, 'مكة المكرمة', NULL, NULL, NULL, '\"[118,122,133,140,152,164]\"', 1, NULL, 4.20, 41, NULL, NULL, 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:09', '2025-11-15 08:13:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2044, 'فني سعد الزهراني', 'tech4_1763201589@makkah.com', 'tech_fny-saad-alzhrany_3_1763201589_691852353812c', '$2y$10$JG.wYFipl0TGRbmWCn1S4.C134uQl.yPhmydrLD8PWjFkolF3r89y', '0583160987', NULL, 0, NULL, NULL, '50', NULL, 1, 1, 1, 'مكة المكرمة', NULL, NULL, NULL, '\"[126,137,154]\"', 1, NULL, 4.80, 88, NULL, NULL, 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:09', '2025-11-15 08:13:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2045, 'فني خالد الدوسري', 'tech5_1763201589@makkah.com', 'tech_fny-khald-aldosry_4_1763201589_691852355e18d', '$2y$10$TzR9WHNkzZTdSTm.q6mc6uYVCdbGAlGMUH5SmUYkvUjC/Iq0VMC3q', '0535388637', NULL, 0, NULL, NULL, '50', NULL, 1, 1, 1, 'مكة المكرمة', NULL, NULL, NULL, '\"[114,120,130,136,143,147]\"', 0, NULL, 4.80, 94, NULL, NULL, 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:09', '2025-11-15 08:13:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2046, 'فني عمر الشهري', 'tech6_1763201589@makkah.com', 'tech_fny-aamr-alshhry_5_1763201589_691852358534f', '$2y$10$YMwYc7Wk.cPs7bUKc7eg6eR5uLwC36KUKZAJ1tQeIiZpqh9ujV0Hm', '0593131268', NULL, 0, NULL, NULL, '50', NULL, 1, 1, 1, 'مكة المكرمة', NULL, NULL, NULL, '\"[133,142,158,163,165]\"', 1, NULL, 4.40, 48, NULL, NULL, 69, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-15 08:13:09', '2025-11-15 08:13:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_unique_keys`
--

CREATE TABLE `user_unique_keys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) NOT NULL,
  `unique_key` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_unique_keys`
--

INSERT INTO `user_unique_keys` (`id`, `user_id`, `unique_key`, `created_at`, `updated_at`) VALUES
(1, '4', '$2y$10$0s1s145odQdC44ifziAMiODDvAlS6.3GMHZBZNDTMagDXEL2d0/em', '2023-10-21 18:56:04', '2023-10-21 18:56:04'),
(2, '2', '$2y$10$BmH33HL0rJh7xJvXn.yLD.FZZ1A3RvrA6drgX87fuZ/55gm8leaBO', '2023-10-22 04:14:48', '2023-11-01 20:52:47'),
(3, '1', '$2y$10$vl9H8RUACfRkiiQi0q1LN.5MNzYdH4FSVvxUnR2JKKuXkM8UvPrhW', '2023-10-23 04:11:16', '2023-11-24 18:15:33'),
(4, '3', '$2y$10$qzP4zy4oTNvUmr/QlsQms.Bj/IU9ffv/UfjygtqSafvwS8cYOT9P2', '2023-10-25 06:38:26', '2023-11-12 06:19:13'),
(5, '5', '$2y$10$vbY1IXJqoa2Vm93iispw6.HsgLPaUarKeGrk/XFOhfWiSIzVFnuSq', '2023-11-06 16:16:47', '2023-11-06 16:16:47');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` bigint(20) NOT NULL,
  `balance` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `buyer_id`, `balance`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 3160.81, 1, '2022-11-03 01:23:27', '2023-11-21 07:34:43'),
(2, 3, 70, 1, '2022-11-03 02:58:18', '2022-11-09 00:10:41'),
(4, 249, 196.11, 0, '2022-12-05 22:27:47', '2022-12-27 06:47:25'),
(5, 455, 128, 0, '2022-12-07 23:14:58', '2022-12-08 02:35:25'),
(6, 563, 500, 0, '2022-12-08 21:16:06', '2022-12-08 21:16:26'),
(16, 1474, 0, 0, '2023-01-17 13:31:18', '2023-01-17 13:31:18'),
(17, 1502, 0, 0, '2023-01-19 22:56:58', '2023-01-19 22:56:58'),
(18, 1514, 0, 0, '2023-01-22 09:44:10', '2023-01-22 09:44:10'),
(19, 1, 1808, 1, '2023-01-27 14:04:57', '2023-11-01 11:09:25'),
(20, 1543, 0, 0, '2023-05-23 02:38:15', '2023-05-23 02:38:15'),
(21, 1628, 0, 0, '2023-07-29 15:40:21', '2023-07-29 15:40:21'),
(22, 1642, 0, 0, '2023-08-01 07:27:06', '2023-08-01 07:27:06'),
(23, 1, 0, 0, '2023-08-09 15:19:35', '2023-08-09 15:19:35'),
(24, 962, 0, 0, '2023-08-21 08:17:06', '2023-08-21 08:17:06'),
(25, 1718, 0, 0, '2023-08-23 01:23:13', '2023-08-23 01:23:13'),
(26, 1759, 0, 0, '2023-09-02 16:34:32', '2023-09-02 16:34:32'),
(27, 1680, 0, 0, '2023-09-16 17:24:07', '2023-09-16 17:24:07'),
(28, 1836, 0, 0, '2023-09-29 07:20:21', '2023-09-29 07:20:21'),
(29, 1857, 0, 0, '2023-10-12 18:04:41', '2023-10-12 18:04:41'),
(30, 1, 0, 0, '2023-10-15 08:38:02', '2023-10-15 08:38:02'),
(31, 1, 0, 0, '2023-10-15 08:38:07', '2023-10-15 08:38:07'),
(32, 1, 0, 0, '2023-10-23 12:08:03', '2023-10-23 12:08:03'),
(33, 1882, 0, 0, '2023-10-29 10:23:30', '2023-10-29 10:23:30'),
(34, 1885, 0, 0, '2023-11-03 15:41:19', '2023-11-03 15:41:19'),
(35, 1930, 0, 0, '2023-11-24 06:22:24', '2023-11-24 06:22:24');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_histories`
--

CREATE TABLE `wallet_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` bigint(20) NOT NULL,
  `payment_gateway` varchar(191) DEFAULT NULL,
  `payment_status` varchar(191) DEFAULT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `transaction_id` varchar(191) DEFAULT NULL,
  `manual_payment_image` varchar(191) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `widgets`
--

CREATE TABLE `widgets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `widget_area` varchar(191) DEFAULT NULL,
  `widget_order` int(11) DEFAULT NULL,
  `widget_location` varchar(191) DEFAULT NULL,
  `widget_name` text NOT NULL,
  `widget_content` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `widgets`
--

INSERT INTO `widgets` (`id`, `widget_area`, `widget_order`, `widget_location`, `widget_name`, `widget_content`, `created_at`, `updated_at`) VALUES
(52, NULL, 4, 'footer', 'ContactInfoWidget', 'a:13:{s:2:\"id\";s:2:\"52\";s:11:\"widget_name\";s:17:\"ContactInfoWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:6:\"footer\";s:12:\"widget_order\";s:1:\"4\";s:5:\"title\";s:12:\"Contact Info\";s:7:\"address\";s:26:\"41/1, Hilton Mall, NY City\";s:12:\"address_icon\";s:21:\"las la-map-marker-alt\";s:5:\"phone\";s:13:\"+012-78901234\";s:10:\"phone_icon\";s:17:\"las la-mobile-alt\";s:5:\"email\";s:13:\"help@mail.com\";s:10:\"email_icon\";s:15:\"las la-envelope\";s:28:\"contact_page_contact_info_01\";a:2:{s:5:\"icon_\";a:4:{i:0;s:17:\"lab la-facebook-f\";i:1;s:14:\"lab la-twitter\";i:2;s:16:\"lab la-instagram\";i:3;s:14:\"lab la-youtube\";}s:4:\"url_\";a:4:{i:0;s:1:\"#\";i:1;s:1:\"#\";i:2;s:1:\"#\";i:3;s:1:\"#\";}}}', '2021-10-03 07:18:35', '2022-01-15 08:30:11'),
(75, NULL, 1, 'footer_style_two', 'FooterStyleTwoWidget', 'a:12:{s:2:\"id\";s:2:\"75\";s:11:\"widget_name\";s:20:\"FooterStyleTwoWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:16:\"footer_style_two\";s:12:\"widget_order\";s:1:\"1\";s:17:\"email_title_en_GB\";s:5:\"Email\";s:11:\"email_en_GB\";s:16:\"contact@mail.com\";s:18:\"follow_title_en_GB\";s:9:\"Follow me\";s:14:\"email_title_ar\";s:29:\"بريد الالكتروني\";s:8:\"email_ar\";s:16:\"contact@mail.com\";s:15:\"follow_title_ar\";s:12:\"اتبعني\";s:9:\"site_logo\";s:2:\"57\";}', '2021-10-27 07:07:26', '2021-10-27 07:11:36'),
(81, NULL, 1, 'style_one_footer', 'LogoWidget', 'a:5:{s:11:\"widget_name\";s:10:\"LogoWidget\";s:11:\"widget_type\";s:3:\"new\";s:15:\"widget_location\";s:16:\"style_one_footer\";s:12:\"widget_order\";s:1:\"1\";s:9:\"site_logo\";s:2:\"57\";}', '2021-10-27 08:55:49', '2021-10-27 08:55:49'),
(82, NULL, 2, 'style_one_footer', 'NavigationMenuWidget', 'a:7:{s:11:\"widget_name\";s:20:\"NavigationMenuWidget\";s:11:\"widget_type\";s:3:\"new\";s:15:\"widget_location\";s:16:\"style_one_footer\";s:12:\"widget_order\";s:1:\"2\";s:18:\"widget_title_en_GB\";N;s:15:\"widget_title_ar\";N;s:7:\"menu_id\";s:1:\"2\";}', '2021-10-27 08:56:25', '2021-10-27 08:56:25'),
(83, NULL, 2, 'footer_three', 'AboutUsWidget', 'a:8:{s:2:\"id\";s:2:\"83\";s:11:\"widget_name\";s:13:\"AboutUsWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:12:\"footer_three\";s:12:\"widget_order\";s:1:\"1\";s:9:\"site_logo\";s:2:\"57\";s:17:\"description_en_GB\";s:115:\"One advanced diverted domestic repeated bringing you old. Possible procured her trifling laughter thoughts property\";s:14:\"description_ar\";s:173:\"متقدم واحد محوّل محلي متكرر يجلب لك الشيخوخة. من الممكن الحصول على ممتلكات تافهة من أفكار الضحك\";}', '2021-10-27 22:32:16', '2021-11-13 00:29:31'),
(86, NULL, 5, 'footer_three', 'ContactInfoWidget', 'a:12:{s:11:\"widget_name\";s:17:\"ContactInfoWidget\";s:11:\"widget_type\";s:3:\"new\";s:15:\"widget_location\";s:12:\"footer_three\";s:12:\"widget_order\";s:1:\"4\";s:18:\"widget_title_en_GB\";s:10:\"Contact us\";s:14:\"location_en_GB\";s:28:\"66 Brooklyn street, New York\";s:11:\"phone_en_GB\";s:11:\"01847111881\";s:11:\"email_en_GB\";s:18:\"sohan@xgenious.com\";s:15:\"widget_title_ar\";s:15:\"اتصل بنا\";s:11:\"location_ar\";s:28:\"66 Brooklyn street, New York\";s:8:\"phone_ar\";s:12:\"+18274737136\";s:8:\"email_ar\";s:18:\"sohan@xgenious.com\";}', '2021-10-27 22:34:39', '2021-11-13 00:29:31'),
(99, NULL, 1, 'footer', 'AboutUsWidget', 'a:8:{s:2:\"id\";s:2:\"99\";s:11:\"widget_name\";s:13:\"AboutUsWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:6:\"footer\";s:12:\"widget_order\";s:1:\"1\";s:11:\"description\";s:186:\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less.\";s:5:\"image\";s:2:\"64\";s:7:\"image_2\";s:3:\"124\";}', '2021-11-24 07:31:12', '2022-02-07 03:15:10'),
(101, NULL, 2, 'footer', 'CommunityWidget', 'a:7:{s:2:\"id\";s:3:\"101\";s:11:\"widget_name\";s:15:\"CommunityWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:6:\"footer\";s:12:\"widget_order\";s:1:\"2\";s:5:\"title\";s:9:\"Community\";s:28:\"contact_page_contact_info_01\";a:2:{s:9:\"com_text_\";a:4:{i:0;s:15:\"Become A Seller\";i:1;s:14:\"Become A Buyer\";i:2;s:12:\"Join With Us\";i:3;s:6:\"Events\";}s:4:\"url_\";a:4:{i:0;s:1:\"#\";i:1;s:1:\"#\";i:2;s:1:\"#\";i:3;s:1:\"#\";}}}', '2021-11-24 23:43:46', '2022-01-15 08:02:24'),
(106, NULL, 3, 'footer', 'Category', 'a:5:{s:11:\"widget_name\";s:8:\"Category\";s:11:\"widget_type\";s:3:\"new\";s:15:\"widget_location\";s:6:\"footer\";s:12:\"widget_order\";s:1:\"3\";s:5:\"title\";s:8:\"Category\";}', '2022-01-15 06:27:46', '2022-01-15 08:30:07'),
(108, NULL, 1, 'copyright', 'PrivacyPolicy', 'a:6:{s:2:\"id\";s:3:\"108\";s:11:\"widget_name\";s:13:\"PrivacyPolicy\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:9:\"copyright\";s:12:\"widget_order\";s:1:\"1\";s:28:\"contact_page_contact_info_01\";a:2:{s:6:\"title_\";a:2:{i:0;s:27:\"سياسة الخصوصية\";i:1;s:29:\"الشروط والأحكام\";}s:4:\"url_\";a:2:{i:0;s:14:\"privacy-policy\";i:1;s:20:\"terms-and-conditions\";}}}', '2022-01-15 22:02:14', '2025-11-14 22:20:57'),
(110, NULL, 2, 'copyright', 'CopyrightText', 'a:6:{s:2:\"id\";s:3:\"110\";s:11:\"widget_name\";s:13:\"CopyrightText\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:9:\"copyright\";s:12:\"widget_order\";s:1:\"2\";s:5:\"title\";s:36:\"All copyright {copy} {year} Reserved\";}', '2022-01-15 22:32:21', '2023-01-02 23:43:06'),
(112, NULL, 1, 'footer2', 'CommunityWidget', 'a:7:{s:2:\"id\";s:3:\"112\";s:11:\"widget_name\";s:15:\"CommunityWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:7:\"footer2\";s:12:\"widget_order\";s:1:\"1\";s:5:\"title\";s:6:\"werwer\";s:28:\"contact_page_contact_info_01\";a:2:{s:9:\"com_text_\";a:1:{i:0;s:5:\"ewrwe\";}s:4:\"url_\";a:1:{i:0;s:1:\"#\";}}}', '2022-01-16 00:05:30', '2022-01-16 00:06:34'),
(113, NULL, 1, 'footer_one', 'AboutUsWidget', 'a:7:{s:2:\"id\";s:3:\"113\";s:11:\"widget_name\";s:13:\"AboutUsWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:10:\"footer_one\";s:12:\"widget_order\";s:1:\"1\";s:11:\"description\";s:370:\"صيانة تك هي منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية. توفر المنصة حلولاً شاملة لربط العملاء بالفنيين المعتمدين مع تتبع مباشر للطلبات، أسعار شفافة، فواتير إلكترونية، وضمانات رقمية.\";s:5:\"image\";s:3:\"914\";}', '2022-02-07 03:30:09', '2025-12-05 19:34:27'),
(114, NULL, 1, 'footer_two', 'AboutUsWidget', 'a:7:{s:2:\"id\";s:3:\"114\";s:11:\"widget_name\";s:13:\"AboutUsWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:10:\"footer_two\";s:12:\"widget_order\";s:1:\"1\";s:11:\"description\";s:370:\"صيانة تك هي منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية. توفر المنصة حلولاً شاملة لربط العملاء بالفنيين المعتمدين مع تتبع مباشر للطلبات، أسعار شفافة، فواتير إلكترونية، وضمانات رقمية.\";s:5:\"image\";s:3:\"914\";}', '2022-02-07 03:30:23', '2025-12-05 19:34:55'),
(115, NULL, 2, 'footer_one', 'CommunityWidget', 'a:10:{s:2:\"id\";s:3:\"115\";s:11:\"widget_name\";s:20:\"المجتمعWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:10:\"footer_one\";s:12:\"widget_order\";s:1:\"2\";s:5:\"title\";s:14:\"المجتمع\";s:12:\"seller_title\";s:11:\"كن فني\";s:11:\"seller_link\";N;s:11:\"buyer_title\";s:13:\"كن عميل\";s:10:\"buyer_link\";N;}', '2022-02-07 03:36:30', '2025-11-14 22:22:49'),
(116, NULL, 3, 'footer_one', 'Category', 'a:9:{s:2:\"id\";s:3:\"116\";s:11:\"widget_name\";s:8:\"Category\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:10:\"footer_one\";s:12:\"widget_order\";s:1:\"4\";s:5:\"title\";s:8:\"Category\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"5\";}', '2022-02-07 03:39:07', '2025-11-15 09:12:37'),
(117, NULL, 4, 'footer_one', 'ContactInfoWidget', 'a:13:{s:2:\"id\";s:3:\"117\";s:11:\"widget_name\";s:17:\"ContactInfoWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:10:\"footer_one\";s:12:\"widget_order\";s:1:\"4\";s:5:\"title\";s:33:\"المعلومات التواصل\";s:7:\"address\";s:39:\"مكة المكرمة, السعودية\";s:12:\"address_icon\";s:21:\"las la-map-marker-alt\";s:5:\"phone\";s:10:\"+966000000\";s:10:\"phone_icon\";s:17:\"las la-mobile-alt\";s:5:\"email\";s:17:\"info@SyanTeck.com\";s:10:\"email_icon\";s:15:\"las la-envelope\";s:28:\"contact_page_contact_info_01\";a:2:{s:5:\"icon_\";a:4:{i:0;s:17:\"lab la-facebook-f\";i:1;s:14:\"lab la-twitter\";i:2;s:16:\"lab la-instagram\";i:3;s:14:\"lab la-youtube\";}s:4:\"url_\";a:4:{i:0;s:1:\"#\";i:1;s:1:\"#\";i:2;s:1:\"#\";i:3;s:1:\"#\";}}}', '2022-02-07 03:45:20', '2025-11-15 09:15:13'),
(119, NULL, 3, 'footer_two', 'Category', 'a:9:{s:2:\"id\";s:3:\"119\";s:11:\"widget_name\";s:8:\"Category\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:10:\"footer_two\";s:12:\"widget_order\";s:1:\"3\";s:5:\"title\";s:8:\"Category\";s:8:\"order_by\";s:2:\"id\";s:5:\"order\";s:3:\"asc\";s:5:\"items\";s:1:\"5\";}', '2022-02-07 03:49:42', '2025-11-15 09:16:25'),
(120, NULL, 4, 'footer_two', 'ContactInfoWidget', 'a:13:{s:2:\"id\";s:3:\"120\";s:11:\"widget_name\";s:17:\"ContactInfoWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:10:\"footer_two\";s:12:\"widget_order\";s:1:\"4\";s:5:\"title\";s:33:\"المعلومات التواصل\";s:7:\"address\";s:39:\"مكة المكرمة, السعودية\";s:12:\"address_icon\";s:21:\"las la-map-marker-alt\";s:5:\"phone\";s:11:\"+9660000000\";s:10:\"phone_icon\";s:13:\"las la-mobile\";s:5:\"email\";s:17:\"info@SyanTeck.com\";s:10:\"email_icon\";s:15:\"las la-envelope\";s:28:\"contact_page_contact_info_01\";a:2:{s:5:\"icon_\";a:4:{i:0;s:17:\"lab la-facebook-f\";i:1;s:14:\"lab la-twitter\";i:2;s:16:\"lab la-instagram\";i:3;s:14:\"lab la-youtube\";}s:4:\"url_\";a:4:{i:0;s:1:\"#\";i:1;s:1:\"#\";i:2;s:1:\"#\";i:3;s:1:\"#\";}}}', '2022-02-07 03:53:34', '2025-11-15 09:18:13'),
(123, NULL, 2, 'footer_two', 'CommunityWidget', 'a:10:{s:2:\"id\";s:3:\"123\";s:11:\"widget_name\";s:20:\"المجتمعWidget\";s:11:\"widget_type\";s:6:\"update\";s:15:\"widget_location\";s:10:\"footer_two\";s:12:\"widget_order\";s:1:\"2\";s:5:\"title\";s:14:\"المجتمع\";s:12:\"seller_title\";s:11:\"كن فني\";s:11:\"seller_link\";N;s:11:\"buyer_title\";s:13:\"كن عميل\";s:10:\"buyer_link\";N;}', '2023-05-29 02:49:52', '2025-11-14 22:22:49');

-- --------------------------------------------------------

--
-- Table structure for table `xg_ftp_infos`
--

CREATE TABLE `xg_ftp_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_version` varchar(191) NOT NULL,
  `item_license_key` varchar(191) NOT NULL,
  `item_license_status` varchar(191) NOT NULL,
  `item_license_msg` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

CREATE TABLE `zones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` int(11) NOT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zones`
--

INSERT INTO `zones` (`id`, `country_id`, `latitude`, `longitude`, `status`, `created_at`, `updated_at`) VALUES
(2, 6, 20.593683, 78.962883, 1, '2023-06-20 08:23:33', '2023-06-20 23:20:21'),
(3, 4, 36.204823, 138.25293, 1, '2023-06-20 08:31:33', '2023-06-20 23:22:25'),
(4, 12, 46.227638, 2.213749, 1, '2023-06-20 08:31:40', '2023-06-20 23:22:02'),
(6, 1, 23.684994, 90.356331, 1, '2023-06-20 23:19:56', '2023-06-20 23:19:56');

-- --------------------------------------------------------

--
-- Table structure for table `zone_users`
--

CREATE TABLE `zone_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `zone_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountdeactives`
--
ALTER TABLE `accountdeactives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `admin_commissions`
--
ALTER TABLE `admin_commissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_notices`
--
ALTER TABLE `admin_notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amount_settings`
--
ALTER TABLE `amount_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buyer_jobs`
--
ALTER TABLE `buyer_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_zones`
--
ALTER TABLE `category_zones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `child_categories`
--
ALTER TABLE `child_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_font_imports`
--
ALTER TABLE `custom_font_imports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edit_service_histories`
--
ALTER TABLE `edit_service_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extra_services`
--
ALTER TABLE `extra_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_builders`
--
ALTER TABLE `form_builders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_requests`
--
ALTER TABLE `job_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_request_conversations`
--
ALTER TABLE `job_request_conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_chat_messages`
--
ALTER TABLE `live_chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_uploads`
--
ALTER TABLE `media_uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meta_data`
--
ALTER TABLE `meta_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `online_service_faqs`
--
ALTER TABLE `online_service_faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_invoice_unique` (`invoice`),
  ADD UNIQUE KEY `orders_invoice_number_unique` (`invoice_number`),
  ADD KEY `orders_region_id_foreign` (`region_id`),
  ADD KEY `orders_admin_pricing_by_foreign` (`admin_pricing_by`);

--
-- Indexes for table `order_additionals`
--
ALTER TABLE `order_additionals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_complete_declines`
--
ALTER TABLE `order_complete_declines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_includes`
--
ALTER TABLE `order_includes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_builders`
--
ALTER TABLE `page_builders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payout_requests`
--
ALTER TABLE `payout_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pricing_rules`
--
ALTER TABLE `pricing_rules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pricing_rules_category_id_foreign` (`category_id`),
  ADD KEY `pricing_rules_service_id_foreign` (`service_id`),
  ADD KEY `pricing_rules_region_id_foreign` (`region_id`);

--
-- Indexes for table `quality_followups`
--
ALTER TABLE `quality_followups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quality_followups_order_id_foreign` (`order_id`),
  ADD KEY `quality_followups_created_by_foreign` (`created_by`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regions_city_id_foreign` (`city_id`),
  ADD KEY `regions_area_id_foreign` (`area_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_chat_messages`
--
ALTER TABLE `report_chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller_subscriptions`
--
ALTER TABLE `seller_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller_verifies`
--
ALTER TABLE `seller_verifies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller_view_jobs`
--
ALTER TABLE `seller_view_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serviceadditionals`
--
ALTER TABLE `serviceadditionals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servicebenifits`
--
ALTER TABLE `servicebenifits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serviceincludes`
--
ALTER TABLE `serviceincludes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_areas`
--
ALTER TABLE `service_areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_cities`
--
ALTER TABLE `service_cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_coupons`
--
ALTER TABLE `service_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_icons`
--
ALTER TABLE `social_icons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `static_options`
--
ALTER TABLE `static_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_coupons`
--
ALTER TABLE `subscription_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_histories`
--
ALTER TABLE `subscription_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_ticket_messages`
--
ALTER TABLE `support_ticket_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `technician_regions`
--
ALTER TABLE `technician_regions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `technician_regions_technician_id_region_id_unique` (`technician_id`,`region_id`),
  ADD KEY `technician_regions_region_id_foreign` (`region_id`);

--
-- Indexes for table `to_do_lists`
--
ALTER TABLE `to_do_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_tax_number_unique` (`tax_number`),
  ADD UNIQUE KEY `users_technician_code_unique` (`technician_code`);

--
-- Indexes for table `user_unique_keys`
--
ALTER TABLE `user_unique_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_histories`
--
ALTER TABLE `wallet_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `widgets`
--
ALTER TABLE `widgets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xg_ftp_infos`
--
ALTER TABLE `xg_ftp_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zones`
--
ALTER TABLE `zones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `zones_country_id_unique` (`country_id`);

--
-- Indexes for table `zone_users`
--
ALTER TABLE `zone_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountdeactives`
--
ALTER TABLE `accountdeactives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_commissions`
--
ALTER TABLE `admin_commissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_notices`
--
ALTER TABLE `admin_notices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `amount_settings`
--
ALTER TABLE `amount_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `buyer_jobs`
--
ALTER TABLE `buyer_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `category_zones`
--
ALTER TABLE `category_zones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `child_categories`
--
ALTER TABLE `child_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `custom_font_imports`
--
ALTER TABLE `custom_font_imports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `edit_service_histories`
--
ALTER TABLE `edit_service_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extra_services`
--
ALTER TABLE `extra_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_builders`
--
ALTER TABLE `form_builders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_requests`
--
ALTER TABLE `job_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_request_conversations`
--
ALTER TABLE `job_request_conversations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `live_chat_messages`
--
ALTER TABLE `live_chat_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media_uploads`
--
ALTER TABLE `media_uploads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=917;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `meta_data`
--
ALTER TABLE `meta_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=504;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=355;

--
-- AUTO_INCREMENT for table `online_service_faqs`
--
ALTER TABLE `online_service_faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `order_additionals`
--
ALTER TABLE `order_additionals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_complete_declines`
--
ALTER TABLE `order_complete_declines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_includes`
--
ALTER TABLE `order_includes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `page_builders`
--
ALTER TABLE `page_builders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT for table `payout_requests`
--
ALTER TABLE `payout_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pricing_rules`
--
ALTER TABLE `pricing_rules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quality_followups`
--
ALTER TABLE `quality_followups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `report_chat_messages`
--
ALTER TABLE `report_chat_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `seller_subscriptions`
--
ALTER TABLE `seller_subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seller_verifies`
--
ALTER TABLE `seller_verifies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seller_view_jobs`
--
ALTER TABLE `seller_view_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `serviceadditionals`
--
ALTER TABLE `serviceadditionals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=916;

--
-- AUTO_INCREMENT for table `servicebenifits`
--
ALTER TABLE `servicebenifits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=974;

--
-- AUTO_INCREMENT for table `serviceincludes`
--
ALTER TABLE `serviceincludes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1352;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=373;

--
-- AUTO_INCREMENT for table `service_areas`
--
ALTER TABLE `service_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `service_cities`
--
ALTER TABLE `service_cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `service_coupons`
--
ALTER TABLE `service_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `social_icons`
--
ALTER TABLE `social_icons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `static_options`
--
ALTER TABLE `static_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=772;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscription_coupons`
--
ALTER TABLE `subscription_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscription_histories`
--
ALTER TABLE `subscription_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `support_ticket_messages`
--
ALTER TABLE `support_ticket_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `technician_regions`
--
ALTER TABLE `technician_regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `to_do_lists`
--
ALTER TABLE `to_do_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2047;

--
-- AUTO_INCREMENT for table `user_unique_keys`
--
ALTER TABLE `user_unique_keys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `wallet_histories`
--
ALTER TABLE `wallet_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `widgets`
--
ALTER TABLE `widgets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `xg_ftp_infos`
--
ALTER TABLE `xg_ftp_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zones`
--
ALTER TABLE `zones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `zone_users`
--
ALTER TABLE `zone_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_admin_pricing_by_foreign` FOREIGN KEY (`admin_pricing_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `pricing_rules`
--
ALTER TABLE `pricing_rules`
  ADD CONSTRAINT `pricing_rules_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pricing_rules_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pricing_rules_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quality_followups`
--
ALTER TABLE `quality_followups`
  ADD CONSTRAINT `quality_followups_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quality_followups_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `regions_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `service_areas` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `regions_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `service_cities` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `technician_regions`
--
ALTER TABLE `technician_regions`
  ADD CONSTRAINT `technician_regions_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `technician_regions_technician_id_foreign` FOREIGN KEY (`technician_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
