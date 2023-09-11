-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2023 at 01:20 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_shop_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'سایز', '2023-07-29 10:18:53', '2023-07-29 10:18:53'),
(2, 'رنگ', '2023-07-29 10:18:58', '2023-07-29 10:18:58'),
(3, 'طرح', '2023-07-30 07:40:05', '2023-07-30 07:40:05'),
(4, 'نوع دوخت', '2023-08-15 10:44:38', '2023-08-15 10:44:38');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_category`
--

CREATE TABLE `attribute_category` (
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `is_filter` tinyint(1) NOT NULL,
  `is_variation` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_category`
--

INSERT INTO `attribute_category` (`attribute_id`, `category_id`, `is_filter`, `is_variation`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL),
(1, 2, 1, 1, NULL, NULL),
(1, 3, 1, 1, NULL, NULL),
(1, 5, 1, 1, NULL, NULL),
(1, 6, 1, 1, NULL, NULL),
(1, 7, 1, 1, NULL, NULL),
(1, 8, 1, 1, NULL, NULL),
(1, 9, 1, 1, NULL, NULL),
(1, 10, 0, 1, NULL, NULL),
(2, 1, 1, 0, NULL, NULL),
(2, 2, 1, 0, NULL, NULL),
(2, 3, 1, 0, NULL, NULL),
(2, 5, 1, 0, NULL, NULL),
(2, 6, 1, 0, NULL, NULL),
(2, 7, 1, 0, NULL, NULL),
(2, 8, 1, 0, NULL, NULL),
(2, 9, 1, 0, NULL, NULL),
(2, 10, 1, 0, NULL, NULL),
(3, 2, 1, 0, NULL, NULL),
(3, 3, 1, 0, NULL, NULL),
(3, 5, 1, 0, NULL, NULL),
(3, 6, 1, 0, NULL, NULL),
(3, 7, 1, 0, NULL, NULL),
(3, 8, 1, 0, NULL, NULL),
(3, 9, 1, 0, NULL, NULL),
(4, 7, 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `button` varchar(255) DEFAULT NULL,
  `button_link` varchar(255) DEFAULT NULL,
  `banner_position` int(11) NOT NULL,
  `priority` int(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `title`, `description`, `image`, `button`, `button_link`, `banner_position`, `priority`, `is_active`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, '2023_7_31_13_39_8_730945_justin-timberlake-sells-entire-music-catalog.webp', 'فروشگاه', '', 1, 1, 1, '2023-07-31 10:09:08', '2023-07-31 10:09:08'),
(2, NULL, NULL, '2023_7_31_13_39_31_300255_IMG_6314.JPG', 'فروشگاه', '', 1, 2, 1, '2023-07-31 10:09:31', '2023-07-31 10:09:31'),
(4, 'بنر شماره 1', NULL, '2023_8_4_19_45_38_916341_image.jpg', NULL, NULL, 2, 1, 1, '2023-08-04 16:15:38', '2023-08-04 16:15:38'),
(5, 'بنر تست', NULL, '2023_8_4_20_0_41_500427_justin-timberlake-sells-entire-music-catalog.webp', NULL, NULL, 3, 1, 1, '2023-08-04 16:30:41', '2023-08-04 16:30:41'),
(6, NULL, NULL, '2023_8_4_20_6_40_861663_IMG_6314.JPG', NULL, NULL, 3, 2, 1, '2023-08-04 16:36:40', '2023-08-04 16:36:40'),
(7, NULL, NULL, '2023_8_4_20_6_53_606192_image.jpg', NULL, NULL, 3, 3, 1, '2023-08-04 16:36:53', '2023-08-04 16:36:53'),
(8, NULL, NULL, '2023_8_4_20_9_2_928317_Screenshot (167).png', NULL, NULL, 3, 4, 1, '2023-08-04 16:39:02', '2023-08-04 16:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'gucci', 'gucci', 1, '2023-07-29 10:18:33', '2023-07-29 11:13:55'),
(2, 'zara', 'zara', 1, '2023-08-24 12:21:41', '2023-08-24 12:21:41'),
(3, 'asdasdasdasd', 'asdasdasdasd', 1, '2023-08-24 12:21:52', '2023-08-24 12:21:52'),
(4, 'asdfaasf', 'asdfaasf', 1, '2023-08-24 12:21:59', '2023-08-24 12:21:59'),
(5, 'zvzxv', 'zvzxv', 1, '2023-08-24 12:23:08', '2023-08-24 12:23:08'),
(6, 'dfdhfhh', 'dfdhfhh', 1, '2023-08-24 12:24:23', '2023-08-24 12:24:23'),
(7, 'dfhsdfhf', 'dfhsdfhf', 1, '2023-08-24 12:25:24', '2023-08-24 12:25:24'),
(8, 'fsfashf', 'fsfashf', 1, '2023-08-24 12:27:07', '2023-08-24 12:27:07'),
(11, 'پیراهن های صورتی', 'پیراهن-های-صورتی', 1, '2023-09-02 15:09:46', '2023-09-02 15:09:46');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `icon`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 0, 'مردانه', 'Mens', NULL, NULL, 1, '2023-07-29 10:19:18', '2023-07-29 10:19:18'),
(2, 1, 'پیراهن', 'Mens-Shirt', NULL, NULL, 1, '2023-07-29 10:19:41', '2023-07-29 10:19:41'),
(3, 0, 'زنانه', 'Womens', NULL, NULL, 1, '2023-07-30 16:59:16', '2023-07-30 16:59:16'),
(5, 3, 'پیراهن', 'Womens-Shirt', NULL, NULL, 1, '2023-07-30 16:59:53', '2023-08-04 14:06:47'),
(6, 0, 'بچه گانه', 'Children', NULL, NULL, 1, '2023-08-04 14:07:15', '2023-08-04 14:07:15'),
(7, 1, 'شلوار', 'Men-Pants', NULL, NULL, 1, '2023-08-04 14:08:33', '2023-08-04 15:56:44'),
(8, 0, 'بزرگسالان', 'Adults', NULL, NULL, 0, '2023-08-05 13:54:57', '2023-08-05 18:50:13'),
(9, 1, 'کلاه', 'Men-Hat', NULL, NULL, 1, '2023-08-05 16:50:18', '2023-08-05 16:55:55'),
(10, 1, 'تست', 'تست', NULL, NULL, 0, '2023-08-08 13:25:22', '2023-08-08 13:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `approved` int(11) NOT NULL DEFAULT 0,
  `text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `product_id`, `approved`, `text`, `created_at`, `updated_at`) VALUES
(1, 1, 25, 1, 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد', '2023-09-03 15:48:42', '2023-09-05 15:23:59'),
(2, 1, 25, 0, 'asdfasfasf', '2023-09-03 15:49:05', '2023-09-03 15:49:05'),
(3, 1, 25, 1, 'asdfasdfasdf', '2023-09-03 15:49:11', '2023-09-05 16:03:11'),
(4, 1, 25, 1, 'asgasgas', '2023-09-03 15:53:40', '2023-09-05 16:03:07'),
(5, 1, 25, 1, 'ghljghl', '2023-09-03 15:55:00', '2023-09-05 16:03:04'),
(6, 1, 25, 1, 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available', '2023-09-04 19:06:16', '2023-09-05 15:23:55'),
(7, 1, 25, 1, 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available', '2023-09-05 15:25:51', '2023-09-05 15:27:34'),
(8, 1, 25, 1, 'تست شسشسسشب', '2023-09-05 16:06:03', '2023-09-05 16:06:10'),
(9, 3, 25, 1, 'fgkhgfkgfhk', '2023-09-05 19:35:24', '2023-09-05 19:35:36'),
(10, 4, 25, 1, 'asdfasfdsadfsaf', '2023-09-05 19:39:17', '2023-09-05 19:40:10');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_07_21_151518_create_categories_table', 1),
(6, '2023_07_21_152256_create_brands_table', 1),
(7, '2023_07_21_152339_create_products_table', 1),
(8, '2023_07_21_153243_create_tags_table', 1),
(9, '2023_07_21_153318_create_product_tag_table', 1),
(10, '2023_07_21_153456_create_comments_table', 1),
(11, '2023_07_21_153639_create_product_rate_table', 1),
(12, '2023_07_21_153735_create_attributes_table', 1),
(13, '2023_07_21_153800_create_attribute_category_table', 1),
(14, '2023_07_21_153913_create_product_attributes_table', 1),
(15, '2023_07_21_154029_create_product_variations_table', 1),
(16, '2023_07_28_192752_create_product_images_table', 1),
(17, '2023_07_31_124247_create_banner_table', 2),
(18, '2014_10_12_200000_add_two_factor_columns_to_users_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `primary_image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL,
  `delivery_amount` int(11) NOT NULL,
  `delivery_amount_per_product` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `category_id`, `brand_id`, `primary_image`, `description`, `status`, `is_active`, `delivery_amount`, `delivery_amount_per_product`, `created_at`, `updated_at`) VALUES
(15, 'پیراهن صورتی', 'پیراهن-صورتی', 2, 1, '2023_7_29_22_19_6_346052_image.jpg', 'شسیشسی', 0, 1, 20000, 0, '2023-07-29 11:11:20', '2023-08-15 10:05:46'),
(16, 'پیراهن مشکی', 'پیراهن-مشکی', 2, 1, '2023_7_29_22_22_19_266227_IMG_6314.JPG', 'شسیشسی', 1, 1, 20000, 0, '2023-07-29 11:11:37', '2023-07-29 18:52:19'),
(17, 'پیراهن سفید', 'پیراهن-سفید', 2, 1, '2023_8_5_21_21_8_230559_tom-clancy-039-s-ghost-recon-breakpoint-3840x2160-tom-clancys-ghost-recon-breakpoint-e3-2019-poster-4k-21666.jpg', 'بغتنبن', 1, 1, 0, 0, '2023-07-30 08:59:20', '2023-09-02 13:28:27'),
(18, 'پیراهن طرح دار', 'پیراهن-طرح-دار', 2, 1, '2023_8_5_21_21_1_121240_ipad-air-2022-stock-blue-background-dark-mode-3840x2160-7903.png', 'شسیشسیشس', 1, 1, 20000, 0, '2023-08-05 14:25:07', '2023-08-05 17:51:01'),
(19, 'پیراهن قهوه ای', 'پیراهن-قهوه-ای', 2, 1, '2023_8_5_21_18_57_966166_cypher-valorant-pc-games-2021-3840x2160-5536.png', 'شسیشسی', 1, 1, 20000, 0, '2023-08-05 14:25:35', '2023-08-05 17:48:57'),
(20, 'پیراهن زنانه سفید', 'پیراهن-زنانه-سفید', 5, 1, '2023_8_5_21_20_52_709296_2020-12-111.png', 'شسیشسی', 1, 1, 20000, 0, '2023-08-05 14:26:06', '2023-08-05 17:50:52'),
(21, 'پیراهن زنانه مشکی', 'پیراهن-زنانه-مشکی', 5, 1, '2023_8_5_21_19_57_408022_fighter-aircraft-full-moon-outer-space-orange-teal-night-3840x2160-7120.jpg', 'شسیشسی', 1, 1, 20000, 0, '2023-08-05 14:26:33', '2023-08-05 17:49:57'),
(22, 'شلوار مردانه مشکی', 'شلوار-مردانه-مشکی', 7, 1, '2023_8_5_21_19_47_51295_forest-trees-sunrise-woods-fallen-leaves-sun-light-early-3840x2160-4331.jpg', 'سیب', 0, 1, 20000, 0, '2023-08-05 14:27:00', '2023-08-05 17:49:47'),
(23, 'شلوار مردانه ابی', 'شلوار-مردانه-ابی', 7, 1, '2023_8_5_21_21_53_197166_beach-crescent-moon-cloud-landscape-3840x2160-5434.jpg', 'سیبسیب', 1, 1, 20000, 0, '2023-08-05 14:27:43', '2023-08-05 17:51:53'),
(24, 'شلوار مردانه صورتی', 'شلوار-مردانه-صورتی', 7, 1, '2023_8_5_21_19_36_787712_burj-khalifa-dubai-united-arab-emirates-city-skyline-3840x2160-6394.jpg', 'شسیبشبیسی', 1, 1, 20000, 0, '2023-08-05 16:48:47', '2023-08-05 17:49:36'),
(25, 'شلوار مردانه پارچه ای', 'شلوار-مردانه-پارچه-ای', 7, 1, '2023_8_15_14_0_28_748186_wp7121837-call-of-duty-war-zone-ghost-computer-wallpapers.jpg', 'سیبلسب', 1, 1, 20000, 0, '2023-08-05 16:49:19', '2023-08-15 10:30:36'),
(26, 'محصول تست', 'محصول-تست', 9, 1, '2023_9_2_17_1_3_117823_image.jpg', 'شسیبشسبشسب', 0, 1, 0, 0, '2023-09-02 13:31:03', '2023-09-02 13:34:45'),
(27, 'محصول تست شماره 2', 'محصول-تست-شماره-2', 9, 2, '2023_9_4_22_40_56_67890_image.jpg', 'محصول تست شماره 2', 1, 1, 0, 0, '2023-09-04 19:10:56', '2023-09-04 19:10:56');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `attribute_id`, `product_id`, `value`, `is_active`, `created_at`, `updated_at`) VALUES
(18, 2, 15, 'مشکی', 1, '2023-07-29 11:11:20', '2023-07-29 11:11:20'),
(19, 2, 16, 'مشکی', 1, '2023-07-29 11:11:37', '2023-07-29 11:11:37'),
(20, 2, 17, 'سفید صورتی', 1, '2023-07-30 08:59:20', '2023-07-30 10:11:55'),
(21, 3, 17, 'ساده ولی طرح دار', 1, '2023-07-30 08:59:20', '2023-07-30 10:12:14'),
(24, 2, 19, 'مشکی', 1, '2023-08-05 14:25:35', '2023-08-05 14:25:35'),
(25, 3, 19, 'ساده', 1, '2023-08-05 14:25:35', '2023-08-28 12:16:25'),
(26, 2, 20, 'مشکی', 1, '2023-08-05 14:26:06', '2023-08-05 14:26:06'),
(27, 3, 20, 'ساده', 1, '2023-08-05 14:26:06', '2023-08-05 14:26:06'),
(28, 2, 21, 'مشکی', 1, '2023-08-05 14:26:33', '2023-08-05 14:26:33'),
(29, 3, 21, 'ساده', 1, '2023-08-05 14:26:33', '2023-08-05 14:26:33'),
(32, 2, 23, 'قرمز', 1, '2023-08-05 14:27:43', '2023-08-28 12:15:30'),
(33, 3, 23, 'گل گلی', 1, '2023-08-05 14:27:43', '2023-08-28 12:15:30'),
(34, 2, 24, 'مشکی', 1, '2023-08-05 16:48:47', '2023-08-05 16:48:47'),
(35, 3, 24, 'ساده', 1, '2023-08-05 16:48:47', '2023-08-28 12:15:07'),
(41, 2, 25, 'مشکی', 1, '2023-08-26 15:00:26', '2023-08-26 15:00:26'),
(42, 3, 25, 'ساده', 1, '2023-08-26 15:00:26', '2023-08-26 15:00:26'),
(43, 4, 25, 'ساده', 1, '2023-08-26 15:00:26', '2023-08-26 15:00:26'),
(44, 2, 22, 'مشکی', 1, '2023-08-29 11:08:56', '2023-08-29 11:08:56'),
(45, 3, 22, 'ساده', 1, '2023-08-29 11:08:56', '2023-08-29 11:08:56'),
(46, 4, 22, 'ساده', 1, '2023-08-29 11:08:56', '2023-08-29 11:08:56'),
(47, 2, 18, 'ابی', 1, '2023-08-29 11:09:58', '2023-08-29 11:09:58'),
(48, 3, 18, 'ساده', 1, '2023-08-29 11:09:58', '2023-08-29 11:09:58'),
(51, 2, 26, 'مشکی', 1, '2023-09-02 13:34:45', '2023-09-02 13:34:45'),
(52, 3, 26, 'att3', 1, '2023-09-02 13:34:45', '2023-09-02 13:34:45'),
(53, 2, 27, 'سرمه ای', 1, '2023-09-04 19:10:56', '2023-09-04 19:10:56'),
(54, 3, 27, 'ساده', 1, '2023-09-04 19:10:56', '2023-09-04 19:10:56');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(3, 15, '2023_7_29_22_19_6_346052_image.jpg', '2023-07-29 18:49:06', '2023-07-29 18:49:06'),
(6, 15, '2023_7_30_20_18_57_563898_IMG_6314.JPG', '2023-07-30 16:48:57', '2023-07-30 16:48:57'),
(8, 25, '2023_8_15_14_0_28_754609_xiaomi-pad-stock-6016x3384-11667.jpg', '2023-08-15 10:30:28', '2023-08-15 10:30:28'),
(9, 25, '2023_8_28_12_14_30_397368_mountains-sunset-orange-lake-reflection-scenery-snow-3840x2160-2515.jpg', '2023-08-28 08:44:30', '2023-08-28 08:44:30'),
(10, 25, '2023_8_28_12_14_30_402232_night-king-dragon-game-of-thrones-concept-art-3840x2160-10.jpg', '2023-08-28 08:44:30', '2023-08-28 08:44:30'),
(11, 25, '2023_8_28_12_14_30_405274_northern-lights-aurora-borealis-norway-alone-scenic-evening-3840x2160-8669.jpg', '2023-08-28 08:44:30', '2023-08-28 08:44:30'),
(12, 25, '2023_8_28_12_14_30_413691_rainbow-six-siege-3840x2160-4k-19006.jpg', '2023-08-28 08:44:30', '2023-08-28 08:44:30'),
(13, 25, '2023_8_28_12_14_30_416570_rocky-coast-seascape-purple-sky-landscape-dusk-long-3840x2160-4125.jpg', '2023-08-28 08:44:30', '2023-08-28 08:44:30');

-- --------------------------------------------------------

--
-- Table structure for table `product_rate`
--

CREATE TABLE `product_rate` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL,
  `rate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_rate`
--

INSERT INTO `product_rate` (`id`, `user_id`, `product_id`, `comment_id`, `rate`, `created_at`, `updated_at`) VALUES
(1, 1, 25, 1, 3, '2023-09-03 15:48:42', '2023-09-03 15:48:42'),
(2, 1, 25, 2, 1, '2023-09-03 15:49:05', '2023-09-03 15:49:05'),
(3, 1, 25, 3, 5, '2023-09-03 15:49:11', '2023-09-03 15:49:11'),
(4, 1, 25, 4, 5, '2023-09-03 15:53:40', '2023-09-03 15:53:40'),
(5, 1, 25, 5, 3, '2023-09-03 15:55:00', '2023-09-03 15:55:00'),
(6, 1, 25, 6, 1, '2023-09-04 19:06:16', '2023-09-04 19:06:16'),
(7, 1, 25, 7, 5, '2023-09-05 15:25:51', '2023-09-05 15:25:51'),
(8, 1, 25, 8, 3, '2023-09-05 16:06:03', '2023-09-05 16:06:03'),
(9, 3, 25, 9, 3, '2023-09-05 19:35:24', '2023-09-05 19:35:24'),
(10, 4, 25, 10, 5, '2023-09-05 19:39:17', '2023-09-05 19:39:17');

-- --------------------------------------------------------

--
-- Table structure for table `product_tag`
--

CREATE TABLE `product_tag` (
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_tag`
--

INSERT INTO `product_tag` (`tag_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 15, NULL, NULL),
(1, 16, NULL, NULL),
(1, 17, NULL, NULL),
(1, 18, NULL, NULL),
(1, 19, NULL, NULL),
(1, 20, NULL, NULL),
(1, 21, NULL, NULL),
(1, 22, NULL, NULL),
(1, 23, NULL, NULL),
(1, 24, NULL, NULL),
(1, 25, NULL, NULL),
(1, 26, NULL, NULL),
(1, 27, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `price` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `sale_price` int(11) DEFAULT NULL,
  `is_sale` tinyint(1) NOT NULL DEFAULT 0,
  `date_on_sale_from` timestamp NULL DEFAULT NULL,
  `date_on_sale_to` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`id`, `attribute_id`, `product_id`, `price`, `value`, `quantity`, `sku`, `sale_price`, `is_sale`, `date_on_sale_from`, `date_on_sale_to`, `created_at`, `updated_at`) VALUES
(11, 1, 15, 1000, 'L', 0, 'sku', NULL, 0, NULL, NULL, '2023-07-29 11:11:20', '2023-07-29 11:11:20'),
(12, 1, 16, 5000, 'L', 20, 'sku', 50, 1, '2023-08-30 13:25:48', '2023-09-18 13:25:48', '2023-07-29 11:11:37', '2023-08-31 09:56:35'),
(13, 1, 17, 100, 'L', 0, 'sku', NULL, 0, NULL, NULL, '2023-07-30 08:59:20', '2023-09-02 13:27:27'),
(14, 1, 17, 100000, 'M', 2, 'sku', NULL, 0, '2023-08-30 11:46:06', '2023-09-20 11:46:06', '2023-07-30 08:59:20', '2023-09-02 13:28:27'),
(16, 1, 19, 1000, 'L', 20, 'sku', 10, 0, '2023-08-29 13:28:46', '2023-09-18 13:28:46', '2023-08-05 14:25:35', '2023-08-31 09:58:54'),
(17, 1, 20, 1000, 'L', 20, 'sku', NULL, 0, NULL, NULL, '2023-08-05 14:26:06', '2023-08-05 14:26:06'),
(18, 1, 21, 1000, 'L', 20, 'sku', NULL, 0, NULL, NULL, '2023-08-05 14:26:33', '2023-08-05 14:26:33'),
(20, 1, 23, 1000, 'L', 20, 'sku', NULL, 0, NULL, NULL, '2023-08-05 14:27:43', '2023-08-05 14:27:43'),
(21, 1, 24, 1000, 'L', 20, 'sku', NULL, 0, NULL, NULL, '2023-08-05 16:48:47', '2023-08-05 16:48:47'),
(24, 1, 25, 20000, 'S', 2, 'sku', NULL, 0, NULL, NULL, '2023-08-26 15:00:26', '2023-08-28 08:04:02'),
(25, 1, 25, 10000, 'M', 4, 'sku', NULL, 0, NULL, NULL, '2023-08-26 15:00:26', '2023-08-28 08:04:02'),
(26, 1, 25, 30000, 'L', 6, 'sku', 15000, 1, '2023-08-26 12:36:26', '2023-09-20 12:36:26', '2023-08-26 15:00:26', '2023-08-27 09:06:54'),
(27, 1, 25, 40000, 'XXL', 8, 'sku', 32500, 1, '2023-08-21 11:21:29', '2023-09-30 11:21:34', '2023-08-26 15:00:26', '2023-09-08 15:33:38'),
(28, 1, 22, 1000, 'L', 0, 'sku', NULL, 0, NULL, NULL, '2023-08-29 11:08:56', '2023-09-02 09:20:04'),
(29, 1, 18, 200, 'XL', 5, 'sku', NULL, 0, NULL, NULL, '2023-08-29 11:09:58', '2023-08-31 08:18:42'),
(31, 1, 26, 1000, 'L', 0, 'sku', NULL, 0, NULL, NULL, '2023-09-02 13:34:45', '2023-09-02 13:34:45'),
(32, 1, 26, 2000, 'M', 0, 'sku', NULL, 0, NULL, NULL, '2023-09-02 13:34:45', '2023-09-02 13:34:45'),
(33, 1, 27, 2000, 'L', 5, 'sku1', NULL, 0, NULL, NULL, '2023-09-04 19:10:56', '2023-09-04 19:10:56');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'پیراهن', '2023-07-29 10:19:51', '2023-07-29 10:19:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `cell_phone` bigint(255) NOT NULL,
  `otp` int(66) NOT NULL,
  `login_token` varchar(500) NOT NULL,
  `token_expire` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `cell_phone`, `otp`, `login_token`, `token_expire`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'محمد امین شیبانی', 'amin.menestin@gmail.com', NULL, '1234', NULL, NULL, NULL, 9132969940, 311371, '$2y$10$BCthDuG9EJ83aOn2sYdMgec8P.0US1WjywZ7ncds6c5s9CM.WGh0W', '2023-09-05 22:44:51', 'rYNGUAzBhPSWtHEhAT6KKPKNM8ihcB7UGZjueZ20KBvYmW4qwN5vu62ee2YX', '2023-09-01 18:42:45', '2023-09-05 22:42:51'),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9132969512, 9690, '$2y$10$uV.bqpsTA7VKAYSQCIzYJeSNHf7mlXIRKgYehsUVNynFPO4O7TLiO', NULL, NULL, '2023-09-01 17:43:45', '2023-09-01 17:44:07'),
(3, 'U_12354875', NULL, NULL, NULL, NULL, NULL, NULL, 9132981546, 398136, '$2y$10$m7T5pyBdAkaJHf9OW9qg6uf.XX69ZwnGUvs2Yg6ua6R8bQVvGHJ7G', '2023-09-05 19:33:32', 'rBwoKtLiWhpIud4PwprwwFKTdoZhr7bTbpg7gQI5pRMF8KJmhaaIEZ5YV0na', '2023-09-05 19:31:32', '2023-09-05 19:31:32'),
(4, 'test1', 'a@gmail.com', NULL, NULL, NULL, NULL, NULL, 9132658474, 362946, '$2y$10$d01Jg/x3AB.T3NI7AOCcSOSOiHjzqEJJhHD.W0FyVAXItBbZEPUee', '2023-09-05 19:39:43', 'Sscqh2CMWOYT1yCER5pxfY3JKBepC4JIzHl3A1LwXMEn0dUqzrzPUcMM1vSb', '2023-09-05 19:37:43', '2023-09-05 20:07:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_category`
--
ALTER TABLE `attribute_category`
  ADD PRIMARY KEY (`attribute_id`,`category_id`),
  ADD KEY `attribute_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_name_unique` (`name`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_product_id_foreign` (`product_id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attributes_attribute_id_foreign` (`attribute_id`),
  ADD KEY `product_attributes_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_rate`
--
ALTER TABLE `product_rate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_rate_user_id_foreign` (`user_id`),
  ADD KEY `product_rate_product_id_foreign` (`product_id`),
  ADD KEY `comment_id` (`comment_id`);

--
-- Indexes for table `product_tag`
--
ALTER TABLE `product_tag`
  ADD KEY `product_tag_tag_id_foreign` (`tag_id`),
  ADD KEY `product_tag_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variations_attribute_id_foreign` (`attribute_id`),
  ADD KEY `product_variations_product_id_foreign` (`product_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_number_unique` (`cell_phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_rate`
--
ALTER TABLE `product_rate`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_category`
--
ALTER TABLE `attribute_category`
  ADD CONSTRAINT `attribute_category_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attribute_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD CONSTRAINT `product_attributes_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`),
  ADD CONSTRAINT `product_attributes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_rate`
--
ALTER TABLE `product_rate`
  ADD CONSTRAINT `product_rate_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`),
  ADD CONSTRAINT `product_rate_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_rate_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `product_tag`
--
ALTER TABLE `product_tag`
  ADD CONSTRAINT `product_tag_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- Constraints for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD CONSTRAINT `product_variations_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`),
  ADD CONSTRAINT `product_variations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
