-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 03, 2025 at 05:13 PM
-- Server version: 5.7.44
-- PHP Version: 8.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bstin_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `analytics`
--

CREATE TABLE `analytics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referrer_host` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referrer_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser_language` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `utm_source` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `utm_medium` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `utm_campaign` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pageview` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `criterion_id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `evidence_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `criterion_id`, `name_ar`, `name_en`, `file_path`, `created_at`, `updated_at`, `evidence_code`) VALUES
(2, 1, 'قائمة المعايير', 'lest', 'attachments/qcH4NWmLosysBqsTROQ20KYeOgKIYBwikpkhIQGx.png', '2025-04-10 05:45:08', '2025-04-10 05:45:08', '1.1.1'),
(3, 1, 'دليل اخر', 'link', 'attachments/OnNidqByTTOgS9LkS9YWyKM4igp2QLADYJFDAMFF.pdf', '2025-04-10 05:45:08', '2025-04-10 05:45:08', '2.2.2'),
(5, 4, 'مرفق 1', 'attach 1', 'attachments/dRWiSV1aXDW53MaKdIxLEnfguYIGWNaYW3tBQWML.png', '2025-05-02 06:54:51', '2025-05-02 06:54:51', '1.1.1'),
(6, 4, 'مرفق 2', 'attach 2', 'attachments/pDIpX0XSIw6VlqYGLbeW74CePiHma3QgSS5jlodH.png', '2025-05-02 06:54:51', '2025-05-02 06:54:51', '2.2.2'),
(7, 1, 'دليل رابع', '4', 'attachments/75v4UffbUfpA6QPnacx8OFre28IBhRKuM0N3v9PO.png', '2025-05-02 07:03:05', '2025-05-02 07:03:05', '4.4.4');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `commentable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `user_id`, `commentable_type`, `commentable_id`, `parent_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'هذا المحك يحتاج الى اكثر من شاهد', 1, 'App\\Models\\Criterion', 1, NULL, '2025-04-10 05:17:26', '2025-05-02 06:49:30', '2025-05-02 06:49:30'),
(2, 'ارجو تزويدنا بالمرفقات المطلوبه', 1, 'App\\Models\\Criterion', 1, 1, '2025-04-10 05:18:20', '2025-04-10 05:18:20', NULL),
(3, 'اضافة شواهد اخرى', 1, 'App\\Models\\Criterion', 2, NULL, '2025-04-10 05:28:55', '2025-04-10 05:28:55', NULL),
(4, 'رد على التعليق', 1, 'App\\Models\\Criterion', 2, 3, '2025-04-10 05:29:42', '2025-04-10 05:29:42', NULL),
(5, 'المحك التجريبي الأول', 1, 'App\\Models\\Criterion', 4, NULL, '2025-05-02 06:34:44', '2025-05-02 06:35:18', '2025-05-02 06:35:18');

-- --------------------------------------------------------

--
-- Table structure for table `comment_attachments`
--

CREATE TABLE `comment_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `criteria`
--

CREATE TABLE `criteria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `standard_id` bigint(20) UNSIGNED NOT NULL,
  `sequence` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_ar` text COLLATE utf8mb4_unicode_ci,
  `content_en` text COLLATE utf8mb4_unicode_ci,
  `is_met` tinyint(1) NOT NULL DEFAULT '0',
  `fulfillment_status` int(10) UNSIGNED DEFAULT NULL,
  `completion_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`id`, `standard_id`, `sequence`, `name_ar`, `name_en`, `content_ar`, `content_en`, `is_met`, `fulfillment_status`, `completion_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, '1.1.1', 'تدار المؤسسة ....', 'The institution is managed...', '<p style=\"text-align: right;\">تدار المؤسسة من قبل مجلس ) أو ما يوازيه في المؤسسات التعليمية الصغيرة ( له مهام <a href=\"https://bst-inn.net/storage/attachments/OnNidqByTTOgS9LkS9YWyKM4igp2QLADYJFDAMFF.pdf\" target=\"_blank\" rel=\"noopener\">وصلاحيات</a> محددة، وتقيم كفاءتها بشكل <a href=\"https://bst-inn.net/storage/attachments/8SJD8GbBaB5wKzXpYqe1xUNhbVh1bMlsMXjAjU2J.jpg\">دوري</a></p>\r\n<p style=\"text-align: right;\">&nbsp;</p>\r\n<p style=\"text-align: right;\">&nbsp;</p>\r\n<p style=\"text-align: right;\">&nbsp;</p>\r\n<p style=\"text-align: right;\"><a href=\"https://bst-inn.net/storage/attachments/qcH4NWmLosysBqsTROQ20KYeOgKIYBwikpkhIQGx.png\" target=\"_blank\" rel=\"noopener\">1.1.1</a></p>\r\n<p style=\"text-align: right;\"><a href=\"https://bst-inn.net/storage/attachments/OnNidqByTTOgS9LkS9YWyKM4igp2QLADYJFDAMFF.pdf\">2.2.2</a></p>\r\n<p style=\"text-align: right;\"><a href=\"https://bst-inn.net/storage/attachments/75v4UffbUfpA6QPnacx8OFre28IBhRKuM0N3v9PO.png\" target=\"_blank\" rel=\"noopener\">4.4.4</a></p>', NULL, 0, 1, NULL, '2025-03-24 18:46:21', '2025-05-02 07:03:53', NULL),
(2, 2, '1.1.2', 'تعمل المؤسسة بموجب ...', 'The organization operates under...', NULL, NULL, 0, 1, NULL, '2025-03-25 06:31:36', '2025-03-25 19:07:36', NULL),
(3, 4, '1.2.1', 'لدى قيادة المؤسسة ....', 'The leadership of the institution...', '<p style=\"text-align: right;\">لدى قيادة المؤسسة نظام إداري فعال يستند إلى سياسات وإجراءات واضحة ومحددة ومعلنة، تتوافق مع السياسات العامة للقيادة العليا للقطاع التابعة له .</p>', '<p>The institution\'s leadership has an effective administrative system based on clear, specific, and announced policies and procedures that are consistent with the general policies of the senior leadership of the sector to which it belongs.</p>', 0, 1, NULL, '2025-03-25 21:32:53', '2025-03-25 21:34:05', NULL),
(4, 15, '9.1.1', 'المحك الأول التجريبي', 'test test 11', '<p>هنا يتم وضع المحتوى الخاص بالمحك باللغة العربية&nbsp;</p>', NULL, 0, 1, NULL, '2025-05-02 06:31:57', '2025-05-02 06:52:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `products_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_template_langs`
--

CREATE TABLE `email_template_langs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL,
  `lang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `criterion_id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `criterion_id`, `name_ar`, `name_en`, `url`, `created_at`, `updated_at`) VALUES
(2, 4, 'رابط الدليل الثاني', 'scound link', 'https://www.youtube.com/', '2025-05-02 06:52:07', '2025-05-02 06:52:07'),
(3, 4, 'الرابط الثالث', 'three likn', 'https://www.linkedin.com/', '2025-05-02 06:53:54', '2025-05-02 06:53:54'),
(4, 1, 'الرابط الثالث', '3', 'https://www.linkedin.com/', '2025-05-02 07:01:56', '2025-05-02 07:01:56'),
(5, 1, 'الرابط الرابع', '4', 'https://www.youtube.com/', '2025-05-02 07:02:19', '2025-05-02 07:02:19');

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2020_05_02_075614_create_email_templates_table', 1),
(6, '2020_05_02_075630_create_email_template_langs_table', 1),
(7, '2020_05_02_075647_create_user_email_templates_table', 1),
(8, '2020_05_21_065337_create_permission_tables', 1),
(9, '2021_02_15_071203_create_user_details_table', 1),
(10, '2021_05_08_124950_create_settings_table', 1),
(11, '2021_08_24_035614_create_sessions_table', 1),
(12, '2022_01_17_081407_create__customers_table', 1),
(13, '2023_04_26_124916_create_analytics_table', 1),
(14, '2023_06_08_060646_create_template_table', 1),
(15, '2023_06_27_114942_create_languages_table', 1),
(16, '2023_12_08_064807_add_is_active_to_table', 1),
(17, '2024_02_01_032744_add_columns_in_users_table', 1),
(18, '2025_03_17_115835_create_criteria_table', 1),
(19, '2025_03_19_190344_create_links_table', 1),
(20, '2025_03_19_190358_create_attachments_table', 1),
(21, '2025_03_24_174542_create_standards_table', 2),
(22, '2025_03_24_230325_modify_sequence_in_standards_table', 3),
(23, '2025_04_06_211925_create_comments_table', 4),
(24, '2025_04_06_214052_add_soft_deletes_to_criteria_table', 4),
(25, '2025_04_07_142533_create_comment_attachments_table', 4),
(26, '2025_04_08_000000_create_user_standards_table', 4),
(27, '2025_04_09_201001_add_evidance_code_to_attachments_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(5, 'App\\Models\\User', 4);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Manage Dashboard', 'web', '2025-03-13 20:06:10', '2025-03-13 20:06:10'),
(2, 'Manage User', 'web', '2025-03-13 20:06:10', '2025-03-13 20:06:10'),
(3, 'Create User', 'web', '2025-03-13 20:06:10', '2025-03-13 20:06:10'),
(4, 'Edit User', 'web', '2025-03-13 20:06:10', '2025-03-13 20:06:10'),
(5, 'Delete User', 'web', '2025-03-13 20:06:10', '2025-03-13 20:06:10'),
(6, 'Manage Role', 'web', '2025-03-13 20:06:10', '2025-03-13 20:06:10'),
(7, 'Create Role', 'web', '2025-03-13 20:06:10', '2025-03-13 20:06:10'),
(8, 'Delete Role', 'web', '2025-03-13 20:06:10', '2025-03-13 20:06:10'),
(9, 'Edit Role', 'web', '2025-03-13 20:06:10', '2025-03-13 20:06:10'),
(10, 'Reset Password', 'web', '2025-03-13 20:06:10', '2025-03-13 20:06:10'),
(11, 'Manage Email Template', 'web', '2025-03-13 20:06:10', '2025-03-13 20:06:10'),
(12, 'Edit Email Template', 'web', '2025-03-13 20:06:10', '2025-03-13 20:06:10'),
(13, 'Create Criteria', 'web', NULL, NULL),
(14, 'Edit Criteria', 'web', NULL, NULL),
(15, 'Manage Criteria', 'web', NULL, NULL),
(16, 'Delete Criteria', 'web', NULL, NULL),
(17, 'Create Standard', 'web', NULL, NULL),
(18, 'Edit Standard', 'web', NULL, NULL),
(19, 'Manage Standard', 'web', NULL, NULL),
(20, 'Delete Standard', 'web', NULL, NULL),
(21, 'Manage Language', 'web', NULL, NULL),
(22, 'Manage Settings', 'web', NULL, NULL),
(23, 'Create Comments', 'web', NULL, NULL),
(24, 'Edit Comments', 'web', NULL, NULL),
(25, 'Manage Comments', 'web', NULL, NULL),
(26, 'Delete Comments', 'web', NULL, NULL),
(27, 'Show User', 'web', '2025-03-13 20:06:10', '2025-03-13 20:06:10'),
(28, 'Show Criteria', 'web', NULL, NULL),
(29, 'Show Standard', 'web', NULL, NULL),
(30, 'Show Comments', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `store_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'super admin', 'web', '1', 0, '2025-03-13 20:06:10', '2025-03-13 20:06:10'),
(2, 'user', 'web', NULL, 1, '2025-03-25 21:20:17', '2025-03-25 21:20:17'),
(3, 'Follow-up official', 'web', NULL, 1, '2025-03-25 21:22:45', '2025-03-25 21:22:45'),
(4, 'القيادة العليا', 'web', NULL, 1, '2025-04-06 10:30:06', '2025-04-06 10:30:06'),
(5, 'دور تجريبي', 'web', NULL, 1, '2025-05-02 06:39:24', '2025-05-02 06:39:24');

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
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(19, 2),
(28, 2),
(29, 2),
(15, 3),
(27, 3),
(28, 3),
(29, 3),
(30, 3),
(1, 4),
(2, 4),
(6, 4),
(15, 4),
(19, 4),
(21, 4),
(22, 4),
(25, 4),
(27, 4),
(28, 4),
(29, 4),
(30, 4),
(1, 5),
(6, 5),
(7, 5),
(8, 5),
(9, 5),
(13, 5),
(14, 5),
(15, 5),
(16, 5),
(17, 5),
(18, 5),
(19, 5),
(20, 5),
(21, 5),
(23, 5),
(24, 5),
(25, 5),
(26, 5),
(28, 5),
(29, 5),
(30, 5);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `type`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'theme_layout', 'rtl', NULL, 1, NULL, NULL),
(2, 'theme_mode', 'light', 'common', 1, NULL, NULL),
(3, 'layout_font', 'Majalla', 'common', 1, NULL, NULL),
(4, 'accent_color', 'preset-1', 'common', 1, NULL, NULL),
(5, 'sidebar_caption', 'true', 'common', 1, NULL, NULL),
(7, 'layout_width', 'false', 'common', 1, NULL, NULL),
(20, 'app_name', 'معهد الدراسات الفنية للقوات الجوية بالظهران', NULL, 1, NULL, NULL),
(23, 'company_logo', '1_logo.png', NULL, 1, NULL, NULL),
(24, 'facility_name_ar', 'معهد الدراسات الفنية للقوات الجوية', NULL, 1, NULL, NULL),
(25, 'facility_name_en', 'Air Force Technical Studies Institute', NULL, 1, NULL, NULL),
(26, 'vision_ar', '<p>الرؤية</p>', NULL, 1, NULL, NULL),
(31, 'light_logo', '1_light_logo.png', NULL, 1, NULL, NULL),
(48, 'company_favicon', '1_favicon.png', NULL, 1, NULL, NULL),
(89, 'vision_en', '', NULL, 1, NULL, NULL),
(90, 'goals_ar', '<p>أهداف المنشأة&nbsp;</p>', NULL, 1, NULL, NULL),
(91, 'goals_en', '', NULL, 1, NULL, NULL),
(98, 'report_guidelines_ar', '', NULL, 1, NULL, NULL),
(99, 'report_guidelines_en', '<p><label class=\"form-label\" for=\"reportGuidelinesEnglish\">ضوابط إعداد التقرير (إنجليزي)</label></p>', NULL, 1, NULL, NULL),
(100, 'contact_name_ar', '', NULL, 1, NULL, NULL),
(101, 'contact_name_en', '', NULL, 1, NULL, NULL),
(102, 'contact_position_ar', '', NULL, 1, NULL, NULL),
(103, 'contact_position_en', '', NULL, 1, NULL, NULL),
(104, 'report_date', '2025-03-28', NULL, 1, NULL, NULL),
(105, 'report_preparer_name', '', NULL, 1, NULL, NULL),
(106, 'contact_email', '', NULL, 1, NULL, NULL),
(107, 'contact_phone', '', NULL, 1, NULL, NULL),
(141, 'executive_summary', '<p><label class=\"form-label\" for=\"executive_summary\">الملخص التنفيذي</label></p>', NULL, 1, NULL, NULL),
(144, 'statistical_data', '<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 8.5pt; text-align: right; line-height: 120%; mso-layout-grid-align: none; text-autospace: none; vertical-align: middle; direction: rtl; unicode-bidi: embed;\"><span lang=\"AR-YE\" style=\"font-size: 14.0pt; line-height: 120%; font-family: \'DIN NEXT&trade; ARABIC MEDIUM\',sans-serif; color: #52b5c2; mso-bidi-language: AR-YE;\">4.1 البيانات الإحصائية</span></p>\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 8.5pt; text-align: right; line-height: 120%; mso-layout-grid-align: none; text-autospace: none; vertical-align: middle; direction: rtl; unicode-bidi: embed;\"><span class=\"a\"><span lang=\"AR-SA\" style=\"font-size: 12.0pt; line-height: 120%; font-family: \'DIN NEXT&trade; ARABIC REGULAR\',sans-serif; color: #5279bb;\">1.4.1 هيئة التعليم والتدريب</span></span></p>\r\n<div align=\"center\">\r\n<table class=\"MsoNormalTable\" dir=\"rtl\" style=\"width: 92.84%; mso-cellspacing: .7pt; background: white; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; mso-yfti-tbllook: 1184; mso-padding-alt: 0cm 5.4pt 0cm 5.4pt; mso-table-dir: bidi; mso-border-insideh: .25pt solid white; mso-border-insideh-themecolor: background1; mso-border-insidev: .25pt solid white; mso-border-insidev-themecolor: background1;\" border=\"1\" width=\"92%\" cellpadding=\"0\">\r\n<tbody>\r\n<tr style=\"mso-yfti-irow: 0; mso-yfti-firstrow: yes; height: 15.5pt;\">\r\n<td style=\"width: 4.12%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #4C3D8E; padding: 0cm 5.4pt 0cm 5.4pt; height: 15.5pt;\" rowspan=\"3\" width=\"4%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span lang=\"AR-SA\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC REGULAR\',sans-serif; color: white; mso-themecolor: background1;\">م</span></p>\r\n</td>\r\n<td style=\"width: 10.18%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #4C3D8E; padding: 0cm 5.4pt 0cm 5.4pt; height: 15.5pt;\" rowspan=\"3\" width=\"10%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span lang=\"AR-SA\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC REGULAR\',sans-serif; color: white; mso-themecolor: background1;\"><span style=\"mso-spacerun: yes;\">&nbsp;</span>القسم العلمي أو التصنيف المعتمد</span></p>\r\n</td>\r\n<td style=\"width: 27.32%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #4C3D8E; padding: 0cm 5.4pt 0cm 5.4pt; height: 15.5pt;\" colspan=\"3\" width=\"27%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span lang=\"AR-SA\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC REGULAR\',sans-serif; color: white; mso-themecolor: background1;\">عدد أعضاء هيئة التعليم من حملة الدكتوراه</span></p>\r\n</td>\r\n<td style=\"width: 36.64%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #4C3D8E; padding: 0cm 5.4pt 0cm 5.4pt; height: 15.5pt;\" colspan=\"3\" width=\"36%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span lang=\"AR-SA\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC REGULAR\',sans-serif; color: white; mso-themecolor: background1;\">عدد هيئة التعليم </span></p>\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span lang=\"AR-SA\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC REGULAR\',sans-serif; color: white; mso-themecolor: background1;\">من غير حملة الدكتوراه</span></p>\r\n</td>\r\n<td style=\"width: 20.74%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #4C3D8E; padding: 0cm 5.4pt 0cm 5.4pt; height: 15.5pt;\" colspan=\"3\" valign=\"top\" width=\"20%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span lang=\"AR-SA\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC REGULAR\',sans-serif; color: white; mso-themecolor: background1;\">إجمالي </span></p>\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span lang=\"AR-SA\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC REGULAR\',sans-serif; color: white; mso-themecolor: background1;\">عدد هيئة التدريس</span></p>\r\n</td>\r\n</tr>\r\n<tr style=\"mso-yfti-irow: 1; page-break-inside: avoid; height: 20.7pt;\">\r\n<td style=\"width: 17.92%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #4C3D8E; padding: 0cm 5.4pt 0cm 5.4pt; height: 20.7pt;\" colspan=\"2\" width=\"17%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif; color: white; mso-themecolor: background1;\"><span style=\"mso-spacerun: yes;\">&nbsp;</span></span></p>\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span lang=\"AR-SA\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif; color: white; mso-themecolor: background1;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 9.24%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #999EFF; padding: 0cm 5.4pt 0cm 5.4pt; mso-rotate: 90; height: 20.7pt;\" rowspan=\"2\" width=\"9%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"text-align: center; direction: rtl; unicode-bidi: embed; margin: 0cm 5.65pt 0cm 5.65pt;\" align=\"center\"><span lang=\"AR-SA\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif; color: white; mso-themecolor: background1;\">الإجمالي</span></p>\r\n</td>\r\n<td style=\"width: 22.84%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #4C3D8E; padding: 0cm 5.4pt 0cm 5.4pt; height: 20.7pt;\" colspan=\"2\" width=\"22%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span lang=\"AR-SA\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif; color: white; mso-themecolor: background1;\"><span style=\"mso-spacerun: yes;\">&nbsp;</span></span></p>\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span lang=\"AR-SA\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif; color: white; mso-themecolor: background1;\"><span style=\"mso-spacerun: yes;\">&nbsp;</span></span></p>\r\n</td>\r\n<td style=\"width: 13.64%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #999EFF; padding: 0cm 5.4pt 0cm 5.4pt; mso-rotate: 90; height: 20.7pt;\" rowspan=\"2\" width=\"13%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"text-align: center; direction: rtl; unicode-bidi: embed; margin: 0cm 5.65pt 0cm 5.65pt;\" align=\"center\"><span lang=\"AR-SA\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif; color: white; mso-themecolor: background1;\">الإجمالي</span></p>\r\n</td>\r\n<td style=\"width: 7.28%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #999EFF; padding: 0cm 5.4pt 0cm 5.4pt; mso-rotate: 90; height: 20.7pt;\" rowspan=\"2\" width=\"7%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span lang=\"AR-SA\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif; color: white; mso-themecolor: background1;\">ذكور</span></p>\r\n</td>\r\n<td style=\"width: 5.86%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #999EFF; padding: 0cm 5.4pt 0cm 5.4pt; mso-rotate: 90; height: 20.7pt;\" rowspan=\"2\" width=\"5%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span lang=\"AR-SA\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif; color: white; mso-themecolor: background1;\">إناث</span></p>\r\n</td>\r\n<td style=\"width: 7.26%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #999EFF; padding: 0cm 5.4pt 0cm 5.4pt; mso-rotate: 90; height: 20.7pt;\" rowspan=\"2\" width=\"7%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span lang=\"AR-SA\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif; color: white; mso-themecolor: background1;\">الإجمالي</span></p>\r\n</td>\r\n</tr>\r\n<tr style=\"mso-yfti-irow: 2; page-break-inside: avoid; height: 34.8pt;\">\r\n<td style=\"width: 8.8%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #999EFF; padding: 0cm 5.4pt 0cm 5.4pt; mso-rotate: 90; height: 34.8pt;\" width=\"8%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"text-align: center; direction: rtl; unicode-bidi: embed; margin: 0cm 5.65pt 0cm 5.65pt;\" align=\"center\"><span lang=\"AR-SA\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif; color: white; mso-themecolor: background1;\">ذكور</span></p>\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"text-align: center; direction: rtl; unicode-bidi: embed; margin: 0cm 5.65pt 0cm 5.65pt;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif; color: white; mso-themecolor: background1;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 8.96%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #999EFF; padding: 0cm 5.4pt 0cm 5.4pt; mso-rotate: 90; height: 34.8pt;\" width=\"8%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"text-align: center; direction: rtl; unicode-bidi: embed; margin: 0cm 5.65pt 0cm 5.65pt;\" align=\"center\"><span lang=\"AR-SA\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif; color: white; mso-themecolor: background1;\">إناث</span></p>\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"text-align: center; direction: rtl; unicode-bidi: embed; margin: 0cm 5.65pt 0cm 5.65pt;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif; color: white; mso-themecolor: background1;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 9.5%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #999EFF; padding: 0cm 5.4pt 0cm 5.4pt; mso-rotate: 90; height: 34.8pt;\" width=\"9%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"text-align: center; direction: rtl; unicode-bidi: embed; margin: 0cm 5.65pt 0cm 5.65pt;\" align=\"center\"><span lang=\"AR-SA\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif; color: white; mso-themecolor: background1;\">ذكور</span></p>\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"text-align: center; direction: rtl; unicode-bidi: embed; margin: 0cm 5.65pt 0cm 5.65pt;\" align=\"center\"><span style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif; color: white; mso-themecolor: background1;\"><span style=\"mso-spacerun: yes;\">&nbsp;</span></span></p>\r\n</td>\r\n<td style=\"width: 13.16%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #999EFF; padding: 0cm 5.4pt 0cm 5.4pt; mso-rotate: 90; height: 34.8pt;\" width=\"13%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"text-align: center; direction: rtl; unicode-bidi: embed; margin: 0cm 5.65pt 0cm 5.65pt;\" align=\"center\"><span style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif; color: white; mso-themecolor: background1;\"><span style=\"mso-spacerun: yes;\">&nbsp;</span></span></p>\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"text-align: center; direction: rtl; unicode-bidi: embed; margin: 0cm 5.65pt 0cm 5.65pt;\" align=\"center\"><span lang=\"AR-SA\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif; color: white; mso-themecolor: background1;\">إناث</span></p>\r\n</td>\r\n</tr>\r\n<tr style=\"mso-yfti-irow: 3;\">\r\n<td style=\"width: 4.12%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #D9D9D9; mso-background-themecolor: background1; mso-background-themeshade: 217; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"4%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span lang=\"AR-SA\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif; color: black; mso-color-alt: windowtext;\">1</span></p>\r\n</td>\r\n<td style=\"width: 10.18%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #D9D9D9; mso-background-themecolor: background1; mso-background-themeshade: 217; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"10%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 8.8%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #D9D9D9; mso-background-themecolor: background1; mso-background-themeshade: 217; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"8%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 8.96%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #D9D9D9; mso-background-themecolor: background1; mso-background-themeshade: 217; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"8%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 9.24%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #D9D9D9; mso-background-themecolor: background1; mso-background-themeshade: 217; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"9%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 9.5%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #D9D9D9; mso-background-themecolor: background1; mso-background-themeshade: 217; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"9%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 13.16%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #D9D9D9; mso-background-themecolor: background1; mso-background-themeshade: 217; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"13%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 13.64%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #D9D9D9; mso-background-themecolor: background1; mso-background-themeshade: 217; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"13%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 7.28%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #D9D9D9; mso-background-themecolor: background1; mso-background-themeshade: 217; padding: 0cm 5.4pt 0cm 5.4pt;\" valign=\"top\" width=\"7%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 5.86%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #D9D9D9; mso-background-themecolor: background1; mso-background-themeshade: 217; padding: 0cm 5.4pt 0cm 5.4pt;\" valign=\"top\" width=\"5%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 7.26%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #D9D9D9; mso-background-themecolor: background1; mso-background-themeshade: 217; padding: 0cm 5.4pt 0cm 5.4pt;\" valign=\"top\" width=\"7%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n</tr>\r\n<tr style=\"mso-yfti-irow: 4;\">\r\n<td style=\"width: 4.12%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #F2F2F2; mso-background-themecolor: background1; mso-background-themeshade: 242; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"4%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span lang=\"AR-SA\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif; color: black; mso-color-alt: windowtext;\">2</span></p>\r\n</td>\r\n<td style=\"width: 10.18%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #F2F2F2; mso-background-themecolor: background1; mso-background-themeshade: 242; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"10%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 8.8%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #F2F2F2; mso-background-themecolor: background1; mso-background-themeshade: 242; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"8%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 8.96%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #F2F2F2; mso-background-themecolor: background1; mso-background-themeshade: 242; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"8%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 9.24%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #F2F2F2; mso-background-themecolor: background1; mso-background-themeshade: 242; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"9%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 9.5%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #F2F2F2; mso-background-themecolor: background1; mso-background-themeshade: 242; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"9%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 13.16%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #F2F2F2; mso-background-themecolor: background1; mso-background-themeshade: 242; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"13%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 13.64%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #F2F2F2; mso-background-themecolor: background1; mso-background-themeshade: 242; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"13%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 7.28%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #F2F2F2; mso-background-themecolor: background1; mso-background-themeshade: 242; padding: 0cm 5.4pt 0cm 5.4pt;\" valign=\"top\" width=\"7%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 5.86%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #F2F2F2; mso-background-themecolor: background1; mso-background-themeshade: 242; padding: 0cm 5.4pt 0cm 5.4pt;\" valign=\"top\" width=\"5%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 7.26%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #F2F2F2; mso-background-themecolor: background1; mso-background-themeshade: 242; padding: 0cm 5.4pt 0cm 5.4pt;\" valign=\"top\" width=\"7%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n</tr>\r\n<tr style=\"mso-yfti-irow: 5; mso-yfti-lastrow: yes;\">\r\n<td style=\"width: 4.12%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #D9D9D9; mso-background-themecolor: background1; mso-background-themeshade: 217; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"4%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span lang=\"AR-SA\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif; color: black; mso-color-alt: windowtext;\">3</span></p>\r\n</td>\r\n<td style=\"width: 10.18%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #D9D9D9; mso-background-themecolor: background1; mso-background-themeshade: 217; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"10%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 8.8%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #D9D9D9; mso-background-themecolor: background1; mso-background-themeshade: 217; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"8%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 8.96%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #D9D9D9; mso-background-themecolor: background1; mso-background-themeshade: 217; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"8%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 9.24%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #D9D9D9; mso-background-themecolor: background1; mso-background-themeshade: 217; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"9%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 9.5%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #D9D9D9; mso-background-themecolor: background1; mso-background-themeshade: 217; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"9%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 13.16%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #D9D9D9; mso-background-themecolor: background1; mso-background-themeshade: 217; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"13%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 13.64%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #D9D9D9; mso-background-themecolor: background1; mso-background-themeshade: 217; padding: 0cm 5.4pt 0cm 5.4pt;\" width=\"13%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 7.28%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #D9D9D9; mso-background-themecolor: background1; mso-background-themeshade: 217; padding: 0cm 5.4pt 0cm 5.4pt;\" valign=\"top\" width=\"7%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 5.86%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #D9D9D9; mso-background-themecolor: background1; mso-background-themeshade: 217; padding: 0cm 5.4pt 0cm 5.4pt;\" valign=\"top\" width=\"5%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n<td style=\"width: 7.26%; border: solid white 1.0pt; mso-border-themecolor: background1; mso-border-alt: solid white .25pt; background: #D9D9D9; mso-background-themecolor: background1; mso-background-themeshade: 217; padding: 0cm 5.4pt 0cm 5.4pt;\" valign=\"top\" width=\"7%\">\r\n<p class=\"MsoNormal\" dir=\"RTL\" style=\"margin-bottom: 0cm; text-align: center; direction: rtl; unicode-bidi: embed;\" align=\"center\"><span dir=\"LTR\" style=\"font-size: 10.0pt; line-height: 107%; font-family: \'DIN NEXT&trade; ARABIC LIGHT\',sans-serif;\">&nbsp;</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', NULL, 1, NULL, NULL),
(145, 'education_training', '<p><label class=\"form-label\" for=\"trainingInfo\">Education and Training Information</label></p>', NULL, 1, NULL, NULL),
(146, 'classification', '<p><label class=\"form-label\" for=\"classification\">Classification Details</label></p>', NULL, 1, NULL, NULL),
(147, 'qualification_info', '<p>Qualificatio ormatio</p>', NULL, 1, NULL, NULL),
(148, 'data_discussion', '<p>Data Discussio</p>', NULL, 1, NULL, NULL),
(149, 'evaluation_info', '<p>aluation Informatio</p>', NULL, 1, NULL, NULL),
(150, 'recommendation_info', '<p>Recommendation Informatio</p>', NULL, 1, NULL, NULL),
(157, 'messages_ar', '', NULL, 1, NULL, NULL),
(158, 'messages_en', '', NULL, 1, NULL, NULL),
(167, 'attachments', '<p><a href=\"https://bst-inn.net/storage/attachments/75v4UffbUfpA6QPnacx8OFre28IBhRKuM0N3v9PO.png\" target=\"_blank\" rel=\"noopener\">المرفق الاول&nbsp;</a></p>', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `standards`
--

CREATE TABLE `standards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'main',
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sequence` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `introduction_ar` text COLLATE utf8mb4_unicode_ci,
  `introduction_en` text COLLATE utf8mb4_unicode_ci,
  `description_ar` longtext COLLATE utf8mb4_unicode_ci,
  `description_en` longtext COLLATE utf8mb4_unicode_ci,
  `summary_ar` longtext COLLATE utf8mb4_unicode_ci,
  `summary_en` longtext COLLATE utf8mb4_unicode_ci,
  `completion_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'incomplete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `standards`
--

INSERT INTO `standards` (`id`, `type`, `parent_id`, `sequence`, `name_ar`, `name_en`, `introduction_ar`, `introduction_en`, `description_ar`, `description_en`, `summary_ar`, `summary_en`, `completion_status`, `created_at`, `updated_at`) VALUES
(1, 'main', NULL, '1', 'الحوكمة والقيادة', 'Governance and Leadership', '<p style=\"text-align: right;\">المقدمة (عربي)</p>', NULL, '<p style=\"text-align: right;\">الوصف (عربي)</p>', NULL, '<p style=\"text-align: right;\">الملخص (عربي)</p>', NULL, 'completed', '2025-03-24 16:12:43', '2025-04-10 05:36:19'),
(2, 'sub', 1, '1.1', 'الحوكمة', 'Governance', NULL, NULL, NULL, NULL, NULL, NULL, 'partially_completed', '2025-03-24 17:52:37', '2025-04-06 08:28:15'),
(3, 'main', NULL, '2', 'نظام ضمان الجودة', 'Quality assurance system', NULL, NULL, NULL, NULL, NULL, NULL, 'partially_completed', '2025-03-25 06:44:35', '2025-04-06 13:16:05'),
(4, 'sub', 1, '1.2', 'القيادة', 'leadership', NULL, NULL, NULL, NULL, NULL, NULL, 'incomplete', '2025-03-25 21:29:20', '2025-03-25 21:29:20'),
(5, 'sub', 3, '2.1', 'الالتزام المؤسسي بتحسين الجودة', 'Institutional commitment to quality improvement', NULL, NULL, '<p style=\"text-align: right;\">الالتزام المؤسس ي بتحسين الجودة :<br>تلتزم المؤسسة بدعم عمليات ضمان الجودة والتحسين المستمر، وتتحمل قيادتها العليا وكافة إدارات المؤسسة وأقسامها مسؤولية تطبيق معايير الجودة في كافة أنشطة<br>لنظام ضمان جودة شامل يتضمن عمليات للتخطيط والتنفيذ والمراقبة والتطوير المستمر&nbsp; *</p>', '<p>Institutional Commitment to Quality Improvement:<br>The organization is committed to supporting quality assurance and continuous improvement processes. Its senior leadership and all departments and divisions are responsible for implementing quality standards in all activities of a comprehensive quality assurance system that includes processes for planning, implementation, monitoring, and continuous development.</p>', NULL, NULL, 'completed', '2025-03-25 21:43:26', '2025-04-05 11:16:28'),
(6, 'main', NULL, '3', 'الموار المؤسسية', 'Enterprise resources', '<p>وصف المعيار الثالث</p>', '<p>Desc</p>', '<p>fasddsfddsfd</p>', NULL, NULL, NULL, 'incomplete', '2025-04-06 03:09:50', '2025-04-06 12:33:20'),
(7, 'sub', 6, '3.1', 'معيار فرعي', '3', NULL, NULL, NULL, NULL, NULL, NULL, 'incomplete', '2025-04-06 10:34:17', '2025-04-06 10:34:17'),
(8, 'main', NULL, '4', 'التعليم والتدريب', 'Education and training', NULL, NULL, NULL, NULL, NULL, NULL, 'incomplete', '2025-04-06 12:34:38', '2025-04-06 12:34:38'),
(9, 'main', NULL, '5', 'الطلاب', 'Students', NULL, NULL, NULL, NULL, NULL, NULL, 'incomplete', '2025-04-06 12:35:12', '2025-04-06 12:35:12'),
(10, 'main', NULL, '6', 'أعضاء هيئة التعليم والتدريب', 'Members of the Education', NULL, NULL, NULL, NULL, NULL, NULL, 'incomplete', '2025-04-06 12:35:54', '2025-04-06 12:36:34'),
(11, 'main', NULL, '7', 'الدراسات والأبحاث', 'Studies and research', NULL, NULL, NULL, NULL, NULL, NULL, 'incomplete', '2025-04-06 12:37:16', '2025-04-06 12:37:16'),
(12, 'main', NULL, '8', 'السلامة وإدارة المخاطر', 'Safety and risk management', NULL, NULL, NULL, NULL, NULL, NULL, 'incomplete', '2025-04-06 12:37:46', '2025-04-06 12:37:46'),
(13, 'sub', 1, '1.3', 'التخطيط الاستراتيجي', 'Strategic planning', NULL, NULL, NULL, NULL, NULL, NULL, 'incomplete', '2025-04-06 12:49:51', '2025-04-06 12:49:51'),
(14, 'main', NULL, '9', 'معيار  رئيسي تجريبي', 'test main', '<p>المقدمة عربي</p>', '<p>test</p>', '<p>الوصف عربي</p>', '<p>test</p>', '<p>المخلص عربي</p>', '<p>test</p>', 'partially_completed', '2025-05-02 06:26:39', '2025-05-02 06:27:15'),
(15, 'sub', 14, '9.1', 'معيار فرعي 1', 'test sub1', NULL, NULL, '<p>وصف المعيار الفرعي الاول</p>', '<p>test sub1</p>', NULL, NULL, 'incomplete', '2025-05-02 06:30:25', '2025-05-02 06:30:25');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `template_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prompt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `field_json` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_tone` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_store` int(11) DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `plan` int(11) NOT NULL DEFAULT '1',
  `requested_plan` int(11) NOT NULL DEFAULT '0',
  `trial_plan` int(11) NOT NULL DEFAULT '0',
  `trial_expire_date` date DEFAULT NULL,
  `plan_expire_date` date DEFAULT NULL,
  `storage_limit` double(8,2) NOT NULL DEFAULT '0.00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `mode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'light',
  `plan_is_active` int(11) NOT NULL DEFAULT '1',
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_disable` int(11) NOT NULL DEFAULT '0',
  `is_enable_login` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `user_name`, `email`, `email_verified_at`, `password`, `remember_token`, `lang`, `current_store`, `avatar`, `type`, `plan`, `requested_plan`, `trial_plan`, `trial_expire_date`, `plan_expire_date`, `storage_limit`, `created_by`, `mode`, `plan_is_active`, `is_active`, `is_disable`, `is_enable_login`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', '93847201', 'superadmin@example.com', '2025-03-13 20:06:10', '$2y$10$/XbWDaV9g5gQJvcxz28I6eKF0H0o36aNy4ZZ/Eh0EXhd0BYYrpBRS', NULL, 'arabic', NULL, NULL, 'super admin', 1, 0, 0, NULL, NULL, 0.00, 0, 'light', 1, 1, 0, 1, '2025-03-13 20:06:11', '2025-04-17 07:46:02'),
(2, 'user@gmail.com', '194837274', 'user@gmail.com', '2025-03-26 15:34:14', '$2y$12$tXN4j5IvLT/2307HpZc3T.j1Rd.P.SZTmG9ZSO5cf2vYxE6rcyMA2', NULL, 'english', NULL, 'avatar.png', 'user', 1, 0, 0, NULL, NULL, 0.00, 0, 'light', 1, 1, 0, 1, '2025-03-26 15:34:14', '2025-03-26 15:34:14'),
(3, 'Ethiraj', '647716399', 'ethiraj@example.com', '2025-04-06 02:44:08', '$2y$12$zi.0r6a1IQtU7UuJE7frWuvyCcHBv.EsTyMHR993od5DF/rR1vG9C', NULL, 'arabic', NULL, 'avatar.png', 'user', 1, 0, 0, NULL, NULL, 0.00, 0, 'light', 1, 1, 0, 1, '2025-04-06 02:44:08', '2025-04-29 05:40:13'),
(4, 'خالد2', '981', NULL, '2025-04-06 02:44:08', '$2y$12$Jxanl3XpEU6f5byLsEmvDOeI6TqL1C9Nr7ahE1Fw2gzURKiwicbXW', NULL, NULL, NULL, NULL, 'دور تجريبي', 1, 0, 0, NULL, NULL, 0.00, 0, 'light', 1, 0, 0, 1, '2025-05-02 06:42:05', '2025-05-03 11:12:35');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_field_title_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field_title_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field_title_3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field_title_4` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `special_instruct` text COLLATE utf8mb4_unicode_ci,
  `location_id` int(11) NOT NULL DEFAULT '0',
  `shipping_id` int(11) NOT NULL DEFAULT '0',
  `billing_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_email_templates`
--

CREATE TABLE `user_email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `template_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_standards`
--

CREATE TABLE `user_standards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `standard_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_standards`
--

INSERT INTO `user_standards` (`id`, `user_id`, `standard_id`, `created_at`, `updated_at`) VALUES
(1, 4, 1, '2025-05-02 06:42:05', '2025-05-02 06:42:05'),
(2, 4, 2, '2025-05-02 06:42:05', '2025-05-02 06:42:05'),
(3, 4, 4, '2025-05-02 06:42:05', '2025-05-02 06:42:05'),
(4, 4, 13, '2025-05-02 06:42:05', '2025-05-02 06:42:05'),
(5, 4, 3, '2025-05-02 06:42:05', '2025-05-02 06:42:05'),
(6, 4, 5, '2025-05-02 06:42:05', '2025-05-02 06:42:05'),
(7, 4, 6, '2025-05-02 06:42:05', '2025-05-02 06:42:05'),
(8, 4, 7, '2025-05-02 06:42:05', '2025-05-02 06:42:05'),
(9, 4, 8, '2025-05-02 06:42:05', '2025-05-02 06:42:05'),
(10, 4, 9, '2025-05-02 06:42:05', '2025-05-02 06:42:05'),
(11, 4, 10, '2025-05-02 06:42:05', '2025-05-02 06:42:05'),
(12, 4, 11, '2025-05-02 06:42:05', '2025-05-02 06:42:05'),
(13, 4, 12, '2025-05-02 06:42:05', '2025-05-02 06:42:05'),
(14, 4, 14, '2025-05-02 06:42:05', '2025-05-02 06:42:05'),
(15, 4, 15, '2025-05-02 06:42:05', '2025-05-02 06:42:05'),
(16, 1, 1, '2025-05-03 11:10:57', '2025-05-03 11:10:57'),
(17, 1, 2, '2025-05-03 11:10:57', '2025-05-03 11:10:57'),
(18, 1, 4, '2025-05-03 11:10:57', '2025-05-03 11:10:57'),
(19, 1, 13, '2025-05-03 11:10:57', '2025-05-03 11:10:57'),
(20, 1, 3, '2025-05-03 11:10:57', '2025-05-03 11:10:57'),
(21, 1, 5, '2025-05-03 11:10:57', '2025-05-03 11:10:57'),
(22, 1, 6, '2025-05-03 11:10:57', '2025-05-03 11:10:57'),
(23, 1, 7, '2025-05-03 11:10:57', '2025-05-03 11:10:57'),
(24, 1, 8, '2025-05-03 11:10:57', '2025-05-03 11:10:57'),
(25, 1, 9, '2025-05-03 11:10:57', '2025-05-03 11:10:57'),
(26, 1, 10, '2025-05-03 11:10:57', '2025-05-03 11:10:57'),
(27, 1, 11, '2025-05-03 11:10:57', '2025-05-03 11:10:57'),
(28, 1, 12, '2025-05-03 11:10:57', '2025-05-03 11:10:57'),
(29, 1, 14, '2025-05-03 11:10:57', '2025-05-03 11:10:57'),
(30, 1, 15, '2025-05-03 11:10:57', '2025-05-03 11:10:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analytics`
--
ALTER TABLE `analytics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_commentable_type_commentable_id_index` (`commentable_type`,`commentable_id`),
  ADD KEY `comments_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `comment_attachments`
--
ALTER TABLE `comment_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_attachments_comment_id_foreign` (`comment_id`);

--
-- Indexes for table `criteria`
--
ALTER TABLE `criteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `criteria_standard_id_standard_type_index` (`standard_id`),
  ADD KEY `sequence` (`sequence`),
  ADD KEY `fulfillment_status` (`fulfillment_status`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_template_langs`
--
ALTER TABLE `email_template_langs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_name_parent_id_unique` (`name`,`parent_id`);

--
-- Indexes for table `standards`
--
ALTER TABLE `standards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `standards_parent_id_foreign` (`parent_id`),
  ADD KEY `sequence` (`sequence`),
  ADD KEY `completion_status` (`completion_status`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_email_templates`
--
ALTER TABLE `user_email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_standards`
--
ALTER TABLE `user_standards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_standards_user_id_standard_id_unique` (`user_id`,`standard_id`),
  ADD KEY `user_standards_standard_id_foreign` (`standard_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analytics`
--
ALTER TABLE `analytics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comment_attachments`
--
ALTER TABLE `comment_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `criteria`
--
ALTER TABLE `criteria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_template_langs`
--
ALTER TABLE `email_template_langs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `standards`
--
ALTER TABLE `standards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_email_templates`
--
ALTER TABLE `user_email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_standards`
--
ALTER TABLE `user_standards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comment_attachments`
--
ALTER TABLE `comment_attachments`
  ADD CONSTRAINT `comment_attachments_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `standards`
--
ALTER TABLE `standards`
  ADD CONSTRAINT `standards_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `standards` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_standards`
--
ALTER TABLE `user_standards`
  ADD CONSTRAINT `user_standards_standard_id_foreign` FOREIGN KEY (`standard_id`) REFERENCES `standards` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_standards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
