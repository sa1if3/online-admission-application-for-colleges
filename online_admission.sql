-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 10, 2020 at 06:14 AM
-- Server version: 8.0.20-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_admission`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super@admin.com', '$2y$10$ycTZv.aYTQTAT.Uo2Znbe.ZLFbM0DYm.8ZisLs3aK7pUYRK1TJOaO', 1, NULL, '2020-06-18 03:55:25', '2020-06-18 03:55:25');

-- --------------------------------------------------------

--
-- Table structure for table `admin_permission`
--

CREATE TABLE `admin_permission` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_role`
--

CREATE TABLE `admin_role` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_role`
--

INSERT INTO `admin_role` (`id`, `role_id`, `admin_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `application_record`
--

CREATE TABLE `application_record` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `application_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0 - Not Submitted, 1 - Submitted, 2- Accepted, 3- Rejected',
  `course_record_id` bigint UNSIGNED NOT NULL,
  `student_id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `gender_record_id` bigint UNSIGNED DEFAULT NULL,
  `caste_record_id` bigint UNSIGNED DEFAULT NULL,
  `religion_record_id` bigint UNSIGNED DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hs_board_record_id` bigint UNSIGNED DEFAULT NULL,
  `hs_pass_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hs_division` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hs_percentage` int DEFAULT NULL,
  `hs_subjects` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hs_total_marks` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hs_student_marks` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hslc_board_record_id` bigint UNSIGNED DEFAULT NULL,
  `hslc_pass_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hslc_division` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hslc_percentage` int DEFAULT NULL,
  `file_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_hs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_hslc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_dob` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_caste` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkPWD` tinyint(1) NOT NULL DEFAULT '0',
  `checkBPL` tinyint(1) NOT NULL DEFAULT '0',
  `major` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `elective` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complete_percentage` int NOT NULL DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `board_record`
--

CREATE TABLE `board_record` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `board_record`
--

INSERT INTO `board_record` (`id`, `created_at`, `updated_at`, `name`) VALUES
(2, '2020-06-18 11:25:21', '2020-06-18 12:00:38', 'CBSE'),
(3, '2020-06-18 12:00:04', '2020-06-18 12:00:04', 'SEBA');

-- --------------------------------------------------------

--
-- Table structure for table `category_record`
--

CREATE TABLE `category_record` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_record`
--

INSERT INTO `category_record` (`id`, `created_at`, `updated_at`, `name`) VALUES
(2, '2020-06-18 13:27:50', '2020-06-18 13:27:50', 'ALL'),
(3, '2020-06-18 13:27:59', '2020-06-18 13:27:59', 'SC'),
(4, '2020-06-18 13:28:05', '2020-06-18 13:28:05', 'ST'),
(5, '2020-06-18 13:28:14', '2020-06-18 13:28:14', 'OBC'),
(6, '2020-06-18 13:28:36', '2020-06-18 13:28:36', 'GEN');

-- --------------------------------------------------------

--
-- Table structure for table `course_record`
--

CREATE TABLE `course_record` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `course_prefix` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NA',
  `course_counter` int NOT NULL DEFAULT '1',
  `course_semester` int NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `compulsory` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `major` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `elective` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_record`
--

INSERT INTO `course_record` (`id`, `created_at`, `updated_at`, `name`, `description`, `course_prefix`, `course_counter`, `course_semester`, `active`, `compulsory`, `major`, `elective`) VALUES
(2, '2020-06-18 13:58:39', '2020-07-10 04:32:32', 'Arts (Honours)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n    Vivamus accumsan libero at placerat luctus.\r\n    Sed laoreet quam at turpis molestie, vitae molestie massa sagittis.\r\n    Ut a quam porta, rhoncus mi lobortis, dictum ex.\r\n    Sed eu magna dapibus, molestie nibh vitae, euismod dui.\r\n    Suspendisse eget turpis sagittis, elementum est vitae, placerat diam.', 'ARH', 1, 2, 1, 'English,Assamese(MIL)/Alt. English,Env. Studies', 'English,Assamese,Pol. Science,Education,Logic & Philosophy', 'Pol. Science, Education, Logic & Philosophy,History,Sociology,Hindi,Arabic,Economics,Geography'),
(3, '2020-06-21 16:07:19', '2020-07-10 04:33:33', 'Arts (Regular)', 'Fusce fringilla velit quis ligula pulvinar, at gravida dui congue.\r\n    Maecenas mollis nisi eget sodales vehicula.\r\n    Integer tempor libero vel dignissim vestibulum.', 'ARR', 1, 3, 1, 'English,Assamese(MIL)/Alt. English,Env. Studies', NULL, 'Pol. Science, Education, Logic & Philosophy,History,Sociology,Hindi,Arabic,Economics,Geography');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_record`
--

CREATE TABLE `feedback_record` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_record_id` bigint UNSIGNED NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feedback_message` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback_record`
--

INSERT INTO `feedback_record` (`id`, `created_at`, `updated_at`, `name`, `email`, `course_record_id`, `department`, `feedback_message`) VALUES
(1, '2020-06-27 06:57:40', '2020-06-27 06:57:40', 'Saifur Rahman', 'saifur.rahman18@gmail.com', 2, NULL, 'I really love this course.');

-- --------------------------------------------------------

--
-- Table structure for table `fee_body_record`
--

CREATE TABLE `fee_body_record` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee` double(20,2) NOT NULL,
  `checkPWD` tinyint(1) NOT NULL DEFAULT '0',
  `checkBPL` tinyint(1) NOT NULL DEFAULT '0',
  `category_record_id` bigint UNSIGNED NOT NULL,
  `course_record_id` bigint UNSIGNED NOT NULL,
  `gender_record_id` bigint UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gender_record`
--

CREATE TABLE `gender_record` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gender_record`
--

INSERT INTO `gender_record` (`id`, `created_at`, `updated_at`, `name`) VALUES
(1, '2020-06-18 12:16:31', '2020-06-18 12:16:31', 'ALL'),
(2, '2020-06-18 12:16:06', '2020-06-18 12:21:57', 'Female'),
(3, '2020-06-18 12:14:52', '2020-06-18 12:22:04', 'Male'),
(4, '2020-06-18 12:21:48', '2020-06-18 12:21:48', 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2017_03_06_023521_create_admins_table', 1),
(3, '2017_03_06_053834_create_admin_role_table', 1),
(4, '2018_03_06_023523_create_roles_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_01_120121_create_permissions_table', 1),
(7, '2019_12_01_163205_create_permission_role_table', 1),
(8, '2019_12_01_163233_create_admin_permission_table', 1),
(9, '2020_06_18_050721_create_board_record', 2),
(10, '2020_06_18_050750_create_gender_record', 2),
(11, '2020_06_18_050822_create_category_record', 2),
(12, '2020_06_18_050858_create_course_record', 2),
(15, '2020_06_18_051014_create_fee_body_record', 3),
(16, '2020_06_19_153408_create_students_table', 4),
(17, '2020_06_21_113302_create_religion_record', 5),
(20, '2020_06_22_111433_create_application_record', 6),
(21, '2020_06_23_135830_create_password_resets_table', 7),
(22, '2020_06_23_143825_create_otp_table', 8),
(23, '2020_06_23_150220_create_jobs_table', 9),
(24, '2020_06_27_054557_create_feedback_record', 10),
(25, '2020_06_29_082236_create_new_fee_record_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `new_fee_record`
--

CREATE TABLE `new_fee_record` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fee_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee_year` int NOT NULL DEFAULT '0',
  `gen` int NOT NULL,
  `sc` int NOT NULL,
  `st` int NOT NULL,
  `obc` int NOT NULL,
  `pwd` int NOT NULL,
  `bpl` int NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `course_record_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `new_fee_record`
--

INSERT INTO `new_fee_record` (`id`, `created_at`, `updated_at`, `fee_name`, `fee_year`, `gen`, `sc`, `st`, `obc`, `pwd`, `bpl`, `active`, `course_record_id`) VALUES
(2, '2020-06-29 12:47:24', '2020-06-29 15:09:47', 'Tuition Fees', 1, 10001, 10001, 10001, 10001, 10001, 10001, 1, 2),
(3, '2020-06-29 12:47:38', '2020-06-29 12:47:38', 'Tuition Fees', 2, 5000, 5000, 5000, 5000, 5000, 5000, 1, 2),
(4, '2020-06-29 14:03:07', '2020-06-29 15:11:41', 'Admission Fee', 0, 3001, 501, 504, 1001, 201, 10, 1, 2),
(5, '2020-06-29 14:27:28', '2020-06-29 14:27:28', 'Lab Fee', 1, 1500, 1500, 1500, 1500, 1500, 1500, 1, 2),
(6, '2020-07-10 04:30:53', '2020-07-10 04:30:53', 'Admission Fee', 0, 1000, 1000, 1000, 1000, 1000, 1000, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `otp` int NOT NULL,
  `student_id` int UNSIGNED NOT NULL,
  `counter` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `parent`, `created_at`, `updated_at`) VALUES
(1, 'CreateAdmin', 'Admin', '2020-06-18 03:55:25', '2020-06-18 03:55:25'),
(2, 'CreateRole', 'Role', '2020-06-18 03:55:25', '2020-06-18 03:55:25'),
(3, 'ReadAdmin', 'Admin', '2020-06-18 03:55:25', '2020-06-18 03:55:25'),
(4, 'ReadRole', 'Role', '2020-06-18 03:55:25', '2020-06-18 03:55:25'),
(5, 'UpdateAdmin', 'Admin', '2020-06-18 03:55:25', '2020-06-18 03:55:25'),
(6, 'UpdateRole', 'Role', '2020-06-18 03:55:25', '2020-06-18 03:55:25'),
(7, 'DeleteAdmin', 'Admin', '2020-06-18 03:55:25', '2020-06-18 03:55:25'),
(8, 'DeleteRole', 'Role', '2020-06-18 03:55:25', '2020-06-18 03:55:25');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 4, NULL, NULL),
(5, 1, 5, NULL, NULL),
(6, 1, 6, NULL, NULL),
(7, 1, 7, NULL, NULL),
(8, 1, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `religion_record`
--

CREATE TABLE `religion_record` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `religion_record`
--

INSERT INTO `religion_record` (`id`, `created_at`, `updated_at`, `name`) VALUES
(1, '2020-06-21 11:43:39', '2020-06-21 11:46:09', 'Hinduism'),
(3, '2020-06-21 12:01:22', '2020-06-21 12:01:22', 'Islam'),
(4, '2020-06-21 12:02:23', '2020-06-21 12:02:23', 'Christianity'),
(5, '2020-06-21 12:02:37', '2020-06-21 12:02:37', 'Sikhism'),
(6, '2020-06-21 12:02:46', '2020-06-21 12:02:46', 'Jainism'),
(7, '2020-06-21 12:03:07', '2020-06-21 12:03:07', 'Zoroastrianism'),
(8, '2020-06-21 12:03:26', '2020-06-21 12:03:26', 'Judaism'),
(9, '2020-06-21 12:03:52', '2020-06-21 12:03:52', 'Baha\'i Faith'),
(10, '2020-06-21 12:04:02', '2020-06-21 12:04:02', 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'super', '2020-06-18 03:55:25', '2020-06-18 03:55:25');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `where_am_i` tinyint NOT NULL DEFAULT '99',
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_verified_at` timestamp NULL DEFAULT NULL,
  `course_record_id` bigint UNSIGNED DEFAULT NULL,
  `course_semester` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_permission`
--
ALTER TABLE `admin_permission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_permission_admin_id_permission_id_unique` (`admin_id`,`permission_id`),
  ADD KEY `admin_permission_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `admin_role`
--
ALTER TABLE `admin_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_role_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `application_record`
--
ALTER TABLE `application_record`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `application_record_application_id_unique` (`application_id`),
  ADD KEY `application_record_course_record_id_foreign` (`course_record_id`),
  ADD KEY `application_record_student_id_foreign` (`student_id`),
  ADD KEY `application_record_gender_record_id_foreign` (`gender_record_id`),
  ADD KEY `application_record_caste_record_id_foreign` (`caste_record_id`),
  ADD KEY `application_record_religion_record_id_foreign` (`religion_record_id`),
  ADD KEY `application_record_hs_board_record_id_foreign` (`hs_board_record_id`),
  ADD KEY `application_record_hslc_board_record_id_foreign` (`hslc_board_record_id`);

--
-- Indexes for table `board_record`
--
ALTER TABLE `board_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_record`
--
ALTER TABLE `category_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_record`
--
ALTER TABLE `course_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback_record`
--
ALTER TABLE `feedback_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedback_record_course_record_id_foreign` (`course_record_id`);

--
-- Indexes for table `fee_body_record`
--
ALTER TABLE `fee_body_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fee_body_record_gender_record_id_foreign` (`gender_record_id`),
  ADD KEY `fee_body_record_category_record_id_foreign` (`category_record_id`),
  ADD KEY `fee_body_record_course_record_id_foreign` (`course_record_id`);

--
-- Indexes for table `gender_record`
--
ALTER TABLE `gender_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_fee_record`
--
ALTER TABLE `new_fee_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `new_fee_record_course_record_id_foreign` (`course_record_id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `otp_student_id_foreign` (`student_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_name_index` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permission_role_role_id_permission_id_unique` (`role_id`,`permission_id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `religion_record`
--
ALTER TABLE `religion_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_email_unique` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD KEY `course_record_id` (`course_record_id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_permission`
--
ALTER TABLE `admin_permission`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_role`
--
ALTER TABLE `admin_role`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `application_record`
--
ALTER TABLE `application_record`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `board_record`
--
ALTER TABLE `board_record`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category_record`
--
ALTER TABLE `category_record`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `course_record`
--
ALTER TABLE `course_record`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback_record`
--
ALTER TABLE `feedback_record`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fee_body_record`
--
ALTER TABLE `fee_body_record`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gender_record`
--
ALTER TABLE `gender_record`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `new_fee_record`
--
ALTER TABLE `new_fee_record`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `religion_record`
--
ALTER TABLE `religion_record`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_permission`
--
ALTER TABLE `admin_permission`
  ADD CONSTRAINT `admin_permission_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admin_permission_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `admin_role`
--
ALTER TABLE `admin_role`
  ADD CONSTRAINT `admin_role_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `application_record`
--
ALTER TABLE `application_record`
  ADD CONSTRAINT `application_record_caste_record_id_foreign` FOREIGN KEY (`caste_record_id`) REFERENCES `category_record` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `application_record_course_record_id_foreign` FOREIGN KEY (`course_record_id`) REFERENCES `course_record` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `application_record_gender_record_id_foreign` FOREIGN KEY (`gender_record_id`) REFERENCES `gender_record` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `application_record_hs_board_record_id_foreign` FOREIGN KEY (`hs_board_record_id`) REFERENCES `board_record` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `application_record_hslc_board_record_id_foreign` FOREIGN KEY (`hslc_board_record_id`) REFERENCES `board_record` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `application_record_religion_record_id_foreign` FOREIGN KEY (`religion_record_id`) REFERENCES `religion_record` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `application_record_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feedback_record`
--
ALTER TABLE `feedback_record`
  ADD CONSTRAINT `feedback_record_course_record_id_foreign` FOREIGN KEY (`course_record_id`) REFERENCES `course_record` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `fee_body_record`
--
ALTER TABLE `fee_body_record`
  ADD CONSTRAINT `fee_body_record_category_record_id_foreign` FOREIGN KEY (`category_record_id`) REFERENCES `category_record` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `fee_body_record_course_record_id_foreign` FOREIGN KEY (`course_record_id`) REFERENCES `course_record` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `fee_body_record_gender_record_id_foreign` FOREIGN KEY (`gender_record_id`) REFERENCES `gender_record` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `new_fee_record`
--
ALTER TABLE `new_fee_record`
  ADD CONSTRAINT `new_fee_record_course_record_id_foreign` FOREIGN KEY (`course_record_id`) REFERENCES `course_record` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `otp`
--
ALTER TABLE `otp`
  ADD CONSTRAINT `otp_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`course_record_id`) REFERENCES `course_record` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
