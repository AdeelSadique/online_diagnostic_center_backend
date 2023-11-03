-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 04, 2023 at 11:51 AM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fasttest`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `a_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `a_contact` char(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `a_gender` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `a_dob` date NOT NULL,
  `user_type` char(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `a_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `a_password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`a_id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`a_id`, `name`, `email`, `a_contact`, `a_gender`, `a_dob`, `user_type`, `a_address`, `a_password`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@fasttest.com', '11111111111', 'M', '1997-06-28', '2', 'Azad Jammu and Kashmir', '$2y$10$bTFAgnjXWyh5xEtSDNl4XOEl55.Bq/t2kx1NHVZnLHLHoyeTdDWUm', '2023-08-04 02:02:01', '2023-08-04 02:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `admin_messages`
--

DROP TABLE IF EXISTS `admin_messages`;
CREATE TABLE IF NOT EXISTS `admin_messages` (
  `am_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` char(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`am_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_messages`
--

INSERT INTO `admin_messages` (`am_id`, `name`, `email`, `contact`, `message`, `reply`, `created_at`, `updated_at`) VALUES
(1, 'user', 'smartchand7@gmail.com', '11111111111', 'fdgssdffgsdfgsdffgdsdfgdfsgsdfdgsdfgsdfgfdgssdffgsdfgsdffgdsdfgdfsgsdfdgsdfgsdfg', 'fdhrthrthtrthrhrter', '2023-08-04 05:22:07', '2023-08-04 05:25:36'),
(2, 'ok', 'user@gmail.com', '11111111111', 'fhgfg', NULL, '2023-08-04 06:03:27', '2023-08-04 06:03:27');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE IF NOT EXISTS `appointments` (
  `ap_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `ap_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ap_status` int NOT NULL,
  `ap_date` date NOT NULL,
  `b_status` tinyint(1) NOT NULL DEFAULT '0',
  `p_id` bigint UNSIGNED NOT NULL,
  `t_id` bigint UNSIGNED NOT NULL,
  `m_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ap_id`),
  KEY `appointments_p_id_foreign` (`p_id`),
  KEY `appointments_t_id_foreign` (`t_id`),
  KEY `appointments_m_id_foreign` (`m_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`ap_id`, `ap_type`, `ap_status`, `ap_date`, `b_status`, `p_id`, `t_id`, `m_id`, `created_at`, `updated_at`) VALUES
(1, 'home', 4, '2023-08-31', 1, 1, 3, 1, '2023-08-04 04:11:36', '2023-08-04 04:26:44');

-- --------------------------------------------------------

--
-- Table structure for table `billings`
--

DROP TABLE IF EXISTS `billings`;
CREATE TABLE IF NOT EXISTS `billings` (
  `b_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `b_status` tinyint(1) NOT NULL,
  `b_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ap_id` bigint UNSIGNED NOT NULL,
  `m_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`b_id`),
  KEY `billings_ap_id_foreign` (`ap_id`),
  KEY `billings_m_id_foreign` (`m_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `billings`
--

INSERT INTO `billings` (`b_id`, `b_status`, `b_amount`, `ap_id`, `m_id`, `created_at`, `updated_at`) VALUES
(1, 1, '1500', 1, 1, '2023-08-04 04:11:36', '2023-08-04 04:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

DROP TABLE IF EXISTS `feedbacks`;
CREATE TABLE IF NOT EXISTS `feedbacks` (
  `f_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `feedback` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply` text COLLATE utf8mb4_unicode_ci,
  `ap_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`f_id`),
  KEY `feedbacks_ap_id_foreign` (`ap_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`f_id`, `feedback`, `reply`, `ap_id`, `created_at`, `updated_at`) VALUES
(1, 'fantastic service', NULL, 1, '2023-08-04 04:21:05', '2023-08-04 04:21:05');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

DROP TABLE IF EXISTS `managers`;
CREATE TABLE IF NOT EXISTS `managers` (
  `m_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_contact` char(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospital_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` char(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`m_id`),
  UNIQUE KEY `managers_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`m_id`, `name`, `email`, `m_contact`, `hospital_name`, `user_type`, `m_address`, `m_password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'manager', 'manager@gmail.com', '11111111111', 'alshifa', '1', 'hjhjkhh hjbnbmnb', '$2y$10$nER484I5KuymjjEZVJEGh.L/jwiikmeUAXy33RT3ZyDxKy6Sy95yG', 1, '2023-08-04 02:02:34', '2023-08-04 05:01:31');

-- --------------------------------------------------------

--
-- Table structure for table `manager_messages`
--

DROP TABLE IF EXISTS `manager_messages`;
CREATE TABLE IF NOT EXISTS `manager_messages` (
  `mm_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply` text COLLATE utf8mb4_unicode_ci,
  `p_id` bigint UNSIGNED NOT NULL,
  `m_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`mm_id`),
  KEY `manager_messages_p_id_foreign` (`p_id`),
  KEY `manager_messages_m_id_foreign` (`m_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_07_20_064305_create_patients_table', 1),
(6, '2023_07_21_181134_create_managers_table', 1),
(7, '2023_07_22_065556_create_tests_table', 1),
(8, '2023_07_22_101243_create_appointments_table', 1),
(9, '2023_07_23_061009_create_reports_table', 1),
(10, '2023_07_24_040844_create_billings_table', 1),
(11, '2023_07_24_052127_create_admin_messages_table', 1),
(12, '2023_07_24_060206_create_manager_messages_table', 1),
(13, '2023_07_24_063440_create_ratings_table', 1),
(14, '2023_07_24_071231_create_feedbacks_table', 1),
(15, '2023_07_24_175350_create_admins_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('smartchand7@gmail.com', 'x6YJVfS6uhs6nThF340mYZPZm6u7nvckSjLfoqQyO1FtyC7K68yKH7zvoRpJAyZl', '2023-08-04 05:21:34');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
CREATE TABLE IF NOT EXISTS `patients` (
  `p_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `p_contact` char(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `p_blood` char(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p_gender` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `p_dob` date NOT NULL,
  `user_type` char(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `p_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `p_password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`p_id`),
  UNIQUE KEY `patients_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`p_id`, `name`, `email`, `p_contact`, `p_blood`, `p_gender`, `p_dob`, `user_type`, `p_address`, `p_password`, `created_at`, `updated_at`) VALUES
(1, 'patient', 'patient@gmail.com', '11111111111', 'B+', 'M', '1998-06-23', '0', 'somewhere', '$2y$10$KhaG9yYAg6VdWpBtuXoqpOE8L.kxbxO4ce5q7pjwswX9dGEcfK0y.', '2023-08-04 04:10:48', '2023-08-04 05:28:22');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
CREATE TABLE IF NOT EXISTS `ratings` (
  `r_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `rating` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_id` bigint UNSIGNED NOT NULL,
  `p_id` bigint UNSIGNED NOT NULL,
  `ap_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`r_id`),
  KEY `ratings_t_id_foreign` (`t_id`),
  KEY `ratings_p_id_foreign` (`p_id`),
  KEY `ratings_ap_id_foreign` (`ap_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`r_id`, `rating`, `t_id`, `p_id`, `ap_id`, `created_at`, `updated_at`) VALUES
(1, '4', 3, 1, 1, '2023-08-04 04:21:05', '2023-08-04 04:21:05');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE IF NOT EXISTS `reports` (
  `r_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `p_id` bigint UNSIGNED NOT NULL,
  `r_status` tinyint(1) NOT NULL,
  `r_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ap_id` bigint UNSIGNED NOT NULL,
  `m_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`r_id`),
  KEY `reports_ap_id_foreign` (`ap_id`),
  KEY `reports_m_id_foreign` (`m_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`r_id`, `p_id`, `r_status`, `r_file`, `ap_id`, `m_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1.pdf', 1, 1, '2023-08-04 04:11:36', '2023-08-04 04:26:44');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

DROP TABLE IF EXISTS `tests`;
CREATE TABLE IF NOT EXISTS `tests` (
  `t_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `t_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_category` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_status` tinyint(1) NOT NULL DEFAULT '1',
  `t_location` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reporting_time` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`t_id`),
  KEY `tests_m_id_foreign` (`m_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`t_id`, `t_name`, `t_category`, `t_price`, `t_status`, `t_location`, `reporting_time`, `m_id`, `created_at`, `updated_at`) VALUES
(2, 'HIVI', 'Microbiology', '2500', 1, 'somewhere', '10:00 AM', 1, '2023-08-04 02:16:15', '2023-08-04 05:44:37'),
(3, 'Complete Blood Count', 'Basic Panel', '1500', 1, 'somewhere', '12:00 PM', 1, '2023-08-04 02:22:04', '2023-08-04 05:01:31'),
(4, 'HDL Cholesterol', 'Basic Panel', '800', 1, 'somewhere', '4:00 PM', 1, '2023-08-04 02:32:03', '2023-08-04 06:46:56'),
(5, 'X-Ray', 'Imaging', '1500', 1, 'somewhere', '9:00 AM', 1, '2023-08-04 04:31:04', '2023-08-04 06:44:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
