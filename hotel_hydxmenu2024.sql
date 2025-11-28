-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2025 at 05:27 AM
-- Server version: 8.0.39-cll-lve
-- PHP Version: 8.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_hydxmenu2024`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `category` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int NOT NULL DEFAULT '0',
  `total_subcat` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `desc`, `position`, `total_subcat`, `created_at`, `updated_at`) VALUES
(1, 'Starter', 'Available From 11AM to 11PM', 2, 3, '2024-09-20 11:36:51', '2025-10-14 00:25:22'),
(2, 'Main Course', 'Available From 11AM to 11PM', 0, 8, '2024-09-20 11:37:19', '2025-10-14 00:25:22'),
(3, 'Sweet', 'Available From 11AM to 11PM', 1, 2, '2024-09-20 11:37:29', '2025-10-14 00:25:22');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_profiles`
--

CREATE TABLE `company_profiles` (
  `id` int NOT NULL,
  `primary_color` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `color_position` int DEFAULT '0',
  `company_logo` varchar(50) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `company_name_status` int NOT NULL DEFAULT '0',
  `company_name_color` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `company_address` varchar(250) NOT NULL DEFAULT '',
  `address_status` int NOT NULL DEFAULT '0',
  `company_email` varchar(50) NOT NULL DEFAULT '',
  `email_status` int NOT NULL DEFAULT '0',
  `company_mobile` varchar(15) NOT NULL DEFAULT '',
  `mobile_status` int NOT NULL DEFAULT '0',
  `company_name_color_history` varchar(100) DEFAULT NULL,
  `primary_color_history` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company_profiles`
--

INSERT INTO `company_profiles` (`id`, `primary_color`, `color_position`, `company_logo`, `company_name`, `company_name_status`, `company_name_color`, `company_address`, `address_status`, `company_email`, `email_status`, `company_mobile`, `mobile_status`, `company_name_color_history`, `primary_color_history`, `created_at`, `updated_at`) VALUES
(1, '#1ba672', 5, '1728043767.png', 'HOTEL YUVRAJ DX', 1, '#b60c1d', 'Gola Road, Danapur, Patna', 1, 'techiesquad@gmail.com', 0, '9876543210', 0, '[\"#b60c1d\"]', '[\"#1ba672\",\"#be8637\",\"#1ba672\"]', '2024-09-22 00:19:37', '2025-10-16 09:34:25');

-- --------------------------------------------------------

--
-- Table structure for table `dietary_prefences`
--

CREATE TABLE `dietary_prefences` (
  `id` bigint UNSIGNED NOT NULL,
  `dietary_prefences` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dietary_prefences`
--

INSERT INTO `dietary_prefences` (`id`, `dietary_prefences`, `created_at`, `updated_at`) VALUES
(1, 'Kid\'s Choice', '2024-08-21 12:33:09', '2024-08-21 12:33:09'),
(2, 'Spicy', '2024-08-21 12:33:37', '2024-08-21 12:33:37'),
(3, 'No Onion or Garlic', '2024-08-21 12:33:56', '2024-08-21 12:33:56'),
(4, 'None', '2024-08-21 12:34:23', '2024-08-21 12:34:23');

-- --------------------------------------------------------

--
-- Table structure for table `email_otps`
--

CREATE TABLE `email_otps` (
  `id` int NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `otp` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `updated_at` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_otps`
--

INSERT INTO `email_otps` (`id`, `email`, `otp`, `created_at`, `updated_at`) VALUES
(2, 'kundan.techiesquad@gmail.com', '1264809', '2024-08-05 10:02:04', '2025-05-06 05:04:26'),
(3, 'admin@techiesquad.in', '3895231', '2024-08-06 07:29:07', '2024-11-20 05:29:46');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_categories`
--

CREATE TABLE `food_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food_categories`
--

INSERT INTO `food_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Veg', '2024-08-20 13:47:53', '2024-08-20 13:47:53'),
(2, 'Non Veg', '2024-08-20 13:48:07', '2024-08-20 13:48:07');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint UNSIGNED NOT NULL,
  `categoryid` int DEFAULT NULL,
  `subcategoryid` int DEFAULT NULL,
  `item_name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f_category` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `labels` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `top_pics` varchar(21) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dietary_prefences` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `mrp` double DEFAULT NULL,
  `offer_price` double DEFAULT NULL,
  `desc` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `position` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `categoryid`, `subcategoryid`, `item_name`, `f_category`, `labels`, `top_pics`, `dietary_prefences`, `quantity`, `mrp`, `offer_price`, `desc`, `item_image`, `status`, `position`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'French Fries', '1', '6', NULL, NULL, NULL, 300, 290, 'This food crust holds a gooey blend of melted mozzarella, tangy tomato sauce, and a sprinkle of fresh basil.', '1728992170.jpg', 'Active', 6, '2024-09-20 19:02:41', '2024-12-25 15:30:23'),
(2, 1, 8, 'Chicken Tikka', '2', '6', NULL, NULL, NULL, 400, 399, 'taste is good.', '1726834433.jpg', 'Active', 4, '2024-09-20 19:13:53', '2025-07-13 10:14:08'),
(3, 2, 5, 'Paneer Butter Masala', '1', '3', NULL, NULL, NULL, 500, 480, 'taste is good.', '1726834570.jpg', 'Active', 7, '2024-09-20 19:16:10', '2024-12-25 15:30:23'),
(4, 2, 6, 'Chicken Biryani', '2', '3', NULL, NULL, NULL, 400, 390, 'taste is good.', '1726834623.jpg', 'Active', 9, '2024-09-20 19:17:03', '2024-12-25 15:30:23'),
(5, 2, 5, 'Karahi Paneer', '1', '7', NULL, NULL, NULL, 400, 200, 'taste is good.', '1726834669.jpg', 'Active', 5, '2024-09-20 19:17:49', '2024-12-25 15:30:23'),
(6, 3, 7, 'Kaju Katli', '1', '5', NULL, NULL, NULL, 1002, 1001, 'This food crust holds a gooey blend of melted mozzarella, tangy tomato sauce, and a sprinkle of fresh basil.', '1726835582.jpg', 'Active', 3, '2024-09-20 19:33:02', '2024-12-25 15:30:23'),
(7, 3, 7, 'Laddu', '1', '7,3', NULL, NULL, NULL, 300, 300, 'taste is good.', '1726835640.webp', 'Active', 9, '2024-09-20 19:34:00', '2024-10-18 18:44:31'),
(8, 2, 6, 'Egg Masala', '2', '3,5', NULL, NULL, NULL, 400, 400, 'taste is good.', '1727073532.webp', 'Active', 9, '2024-09-23 13:38:52', '2024-10-18 19:31:33'),
(9, 2, 5, 'Paneet Tikka2', '1', '4', NULL, NULL, NULL, 40, 4, 'taste is good.', '1727374274.jpg', 'Active', 8, '2024-09-27 01:11:14', '2024-12-25 15:30:23'),
(10, 1, 4, 'Chicken Tikka', '2', '6', NULL, NULL, NULL, 500, 500, 'This food crust holds a gooey blend of melted mozzarella, tangy tomato sauce, and a sprinkle of fresh basil.', '1728992153.jfif', 'Active', 1, '2024-10-08 12:15:56', '2024-12-25 15:30:23'),
(11, 3, 9, 'chocolate icecream', '1', '3,5', NULL, NULL, NULL, 111, 10, 'This food crust holds a gooey blend of melted mozzarella, tangy tomato sauce, and a sprinkle of fresh basil.', '1728992117.jpg', 'Active', 0, '2024-10-08 13:34:29', '2024-12-25 15:30:23'),
(12, 2, 6, 'Afgani chicken', '2', '6,4', NULL, NULL, NULL, 500, 390, 'This food crust holds a gooey blend of melted mozzarella, tangy tomato sauce, and a sprinkle of fresh basil.', '1728909007.webp', 'Active', 2, '2024-10-14 19:30:07', '2024-12-25 15:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `item_labels`
--

CREATE TABLE `item_labels` (
  `id` int NOT NULL,
  `items_id` int DEFAULT NULL,
  `item_name` varchar(80) DEFAULT NULL,
  `label_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `item_labels`
--

INSERT INTO `item_labels` (`id`, `items_id`, `item_name`, `label_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'French Fries', 5, '2024-09-20 12:02:41', '2024-09-20 12:02:41'),
(2, 2, 'Chicken Tikka', 6, '2024-09-20 12:13:53', '2024-09-20 12:13:53'),
(3, 3, 'Paneer Butter Masala', 3, '2024-09-20 12:16:10', '2024-09-20 12:16:10'),
(4, 3, 'Paneer Butter Masala', 7, '2024-09-20 12:16:10', '2024-09-20 12:16:10'),
(5, 4, 'Chicken Biryani', 4, '2024-09-20 12:17:03', '2024-09-20 12:17:03'),
(6, 5, 'Karahi Paneer', 7, '2024-09-20 12:17:49', '2024-09-20 12:17:49'),
(7, 6, 'Kaju Katli', 5, '2024-09-20 12:33:02', '2024-09-20 12:33:02'),
(8, 7, 'Laddu', 7, '2024-09-20 12:34:00', '2024-09-20 12:34:00'),
(9, 7, 'Laddu', 3, '2024-09-20 12:34:00', '2024-09-20 12:34:00'),
(10, 8, 'Egg Masala', 3, '2024-09-23 06:38:52', '2024-09-23 06:38:52'),
(11, 8, 'Egg Masala', 5, '2024-09-23 06:38:52', '2024-09-23 06:38:52'),
(12, 10, 'Chicken tikka1', 4, '2024-10-08 05:15:56', '2024-10-08 05:15:56'),
(13, 10, 'Chicken tikka1', 5, '2024-10-08 05:15:56', '2024-10-08 05:15:56'),
(14, 12, 'Afgani chicken', 6, '2024-10-14 12:30:07', '2024-10-14 12:30:07'),
(15, 12, 'Afgani chicken', 4, '2024-10-14 12:30:07', '2024-10-14 12:30:07');

-- --------------------------------------------------------

--
-- Table structure for table `label_settings`
--

CREATE TABLE `label_settings` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `label_icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `label_settings`
--

INSERT INTO `label_settings` (`id`, `name`, `label_icon`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Best Seller', '1725615517.png', '', '2024-09-06 09:38:37', '2024-11-23 09:03:52'),
(4, 'Top Rated', '1725615528.png', '', '2024-09-06 09:38:48', '2024-09-06 09:38:48'),
(5, 'Kid\'s Choice', '1725615572.png', '', '2024-09-06 09:39:32', '2024-10-16 12:13:33'),
(6, 'Spicy', '1725615580.png', '', '2024-09-06 09:39:40', '2024-09-20 03:20:13'),
(7, 'No Garlic or Onion', '1725615596.jpg', '', '2024-09-06 09:39:56', '2024-09-19 13:16:55');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_07_24_064936_create_category_table', 1),
(6, '2024_07_26_092528_create_users_verify_table', 1),
(7, '2024_08_07_045317_create_categories_table', 2),
(8, '2024_08_07_054456_create_subcaregories_table', 3),
(9, '2024_08_07_063705_create_sub_categories_table', 4),
(10, '2024_08_09_094501_create_items_table', 5),
(11, '2024_08_12_115832_create_vendors_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `orderid` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `itemid` int DEFAULT NULL,
  `item_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` double DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `status` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderid`, `itemid`, `item_name`, `quantity`, `price`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 'HY29011', 1, 'Tamato Soup', 1, 150, 150, 'Pending', '2024-09-03 17:17:15', '2024-09-03 17:17:15'),
(2, 'HY95979', 1, 'French Fry', 2, 490, 980, 'Pending', '2024-09-10 23:54:42', '2024-09-10 23:54:42'),
(3, 'HY27732', 1, 'Allu Tikki', 1, 180, 180, 'Pending', '2024-09-12 17:41:22', '2024-09-12 17:41:22'),
(5, 'HY76164', 1, 'French Fries', 1, 290, 290, 'Pending', '2024-09-22 02:19:12', '2024-09-22 02:19:12'),
(6, 'HY24969', 1, 'French Fries', 1, 290, 290, 'Pending', '2024-09-23 18:39:43', '2024-09-23 18:39:43'),
(7, 'HY63077', 8, 'Egg Masala', 3, 400, 1200, 'Pending', '2024-09-23 18:40:14', '2024-09-23 18:40:14'),
(8, 'HY52493', 1, 'French Fries', 2, 290, 580, 'Pending', '2024-09-23 18:40:42', '2024-09-23 18:40:42'),
(9, 'HY89986', 1, 'French Fries', 1, 290, 290, 'Pending', '2024-09-23 19:58:06', '2024-09-23 19:58:06'),
(10, 'HY50568', 2, 'Chicken Tikka', 1, 399, 399, 'Pending', '2024-09-25 19:05:40', '2024-09-25 19:05:40'),
(11, 'HY95664', 8, 'Egg Masala', 1, 400, 400, 'Pending', '2024-09-26 01:03:52', '2024-09-26 01:03:52'),
(12, 'HY48555', 3, 'Paneer Butter Masala', 1, 480, 480, 'Pending', '2024-09-26 01:04:37', '2024-09-26 01:04:37'),
(13, 'HY59881', 1, 'French Fries', 1, 290, 290, 'Pending', '2024-09-26 11:25:59', '2024-09-26 11:25:59'),
(14, 'HY90052', 1, 'French Fries', 1, 290, 290, 'Pending', '2024-09-26 11:29:07', '2024-09-26 11:29:07'),
(15, 'HY60036', 1, 'French Fries', 1, 290, 290, 'Pending', '2024-10-10 15:18:41', '2024-10-10 15:18:41');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `primary_colors`
--

CREATE TABLE `primary_colors` (
  `id` int NOT NULL,
  `primary_color` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `position` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `primary_colors`
--

INSERT INTO `primary_colors` (`id`, `primary_color`, `position`, `created_at`, `updated_at`) VALUES
(1, '#89a20b', 0, '2024-09-30 10:25:36', '2024-10-08 08:40:51'),
(2, '#0793cf', 0, '2024-09-30 10:25:45', '2024-10-08 08:40:59'),
(3, '#049f80', 0, '2024-09-30 10:25:49', '2024-10-08 08:43:24'),
(4, '#0c64a7', 0, '2024-09-30 10:25:49', '2024-10-08 08:55:00'),
(5, '#0793cf', 0, '2024-09-30 10:25:49', '2024-10-08 08:40:32');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `categoryid` int DEFAULT NULL,
  `category_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subcategory` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int NOT NULL DEFAULT '0',
  `total_items` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `categoryid`, `category_name`, `subcategory`, `position`, `total_items`, `created_at`, `updated_at`) VALUES
(1, 1, 'Parent', 'Starter', 5, 0, '2024-09-20 11:36:51', '2024-10-08 16:17:52'),
(2, 2, 'Parent', 'Main Course', 6, 0, '2024-09-20 11:37:19', '2024-10-08 16:17:52'),
(3, 3, 'Parent', 'Sweet', 8, 0, '2024-09-20 11:37:29', '2024-10-08 16:17:52'),
(4, 1, 'Starter', 'Fries', 0, 1, '2024-09-20 11:37:37', '2024-10-09 12:18:17'),
(5, 2, 'Main Course', 'Paneer', 3, 3, '2024-09-20 11:38:12', '2024-10-08 16:17:52'),
(6, 2, 'Main Course', 'Chicken', 1, 2, '2024-09-20 11:38:23', '2024-10-09 14:15:14'),
(7, 3, 'Sweet', 'Dry Sweet', 7, 2, '2024-09-20 11:38:43', '2024-10-08 16:17:52'),
(8, 1, 'Starter', 'Tikka', 4, 1, '2024-09-20 11:38:52', '2024-10-08 16:17:52'),
(9, 3, 'Sweet', 'IceCrean', 2, 0, '2024-09-20 18:15:55', '2024-10-08 16:17:52');

-- --------------------------------------------------------

--
-- Table structure for table `top_pics`
--

CREATE TABLE `top_pics` (
  `id` bigint UNSIGNED NOT NULL,
  `top_pics` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `top_pics`
--

INSERT INTO `top_pics` (`id`, `top_pics`, `created_at`, `updated_at`) VALUES
(1, 'Best Seller', '2024-08-21 12:31:43', '2024-08-21 12:31:43'),
(2, 'Top Rated', '2024-08-21 12:32:06', '2024-08-21 12:32:06'),
(3, 'None', '2024-08-21 12:32:47', '2024-08-21 12:32:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Kundan', 'kundan.techiesquad@gmail.com', NULL, '$2y$10$zJ2EIWOrTNnfprZa2SyDmO3KSlG/HS1d/31zDHAXohNgWvCjPAEhu', 'N9krWPnjN7romaRfSJowUOwaTIxijgt9dl9z46C7IDnaineYHjfGlatE9q8M', '2024-07-24 07:02:38', '2024-09-03 00:55:51'),
(2, 'Admin', 'admin@techiesquad.in', NULL, '$2y$10$uN4i3XCJfF0kt0dqK5io4uSxC8i722d6YSRnVZCdpBJdA5hLZO/o.', 'IqKXNOGelcbk1LLQHDxJkU0fjhVwaRIfEuoRVYPlg2e0WG5bOo87p5LcjE5r', '2024-08-06 06:22:44', '2024-09-03 17:25:40');

-- --------------------------------------------------------

--
-- Table structure for table `users_verify`
--

CREATE TABLE `users_verify` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `address`, `mobile`, `email`, `created_at`, `updated_at`) VALUES
(1, 'kundan', 'Patna', '1234567890', 'kundan@gmail.com', '2024-08-12 14:12:17', '2024-08-12 14:12:17'),
(2, 'Mohit', 'ara', '5555444433', 'dfssdf@as.fff', '2024-08-13 07:07:29', '2024-08-13 07:07:29'),
(3, 'Ramesh', 'Zilla', '8787878787', 'Romhj@gmail.com', '2024-08-13 07:09:17', '2024-08-13 07:09:17'),
(4, 'Ramakant Shah', 'Nepal', '8787878787', 'ajkshd@as.sss', '2024-08-13 07:12:53', '2024-08-13 07:12:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_profiles`
--
ALTER TABLE `company_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dietary_prefences`
--
ALTER TABLE `dietary_prefences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_otps`
--
ALTER TABLE `email_otps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `food_categories`
--
ALTER TABLE `food_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_labels`
--
ALTER TABLE `item_labels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `label_settings`
--
ALTER TABLE `label_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `primary_colors`
--
ALTER TABLE `primary_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `top_pics`
--
ALTER TABLE `top_pics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_verify`
--
ALTER TABLE `users_verify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_profiles`
--
ALTER TABLE `company_profiles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dietary_prefences`
--
ALTER TABLE `dietary_prefences`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `email_otps`
--
ALTER TABLE `email_otps`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_categories`
--
ALTER TABLE `food_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `item_labels`
--
ALTER TABLE `item_labels`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `label_settings`
--
ALTER TABLE `label_settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `primary_colors`
--
ALTER TABLE `primary_colors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `top_pics`
--
ALTER TABLE `top_pics`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_verify`
--
ALTER TABLE `users_verify`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
