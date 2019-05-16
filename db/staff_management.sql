-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: May 15, 2019 at 02:20 AM
-- Server version: 5.6.43
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `staff_management`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`%` PROCEDURE `fetch_all_users` ()  BEGIN
                select * from users;
            END$$

DELIMITER ;

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
(13, '2014_10_12_000000_create_users_table', 1),
(14, '2014_10_12_100000_create_password_resets_table', 1),
(15, '2019_03_27_032200_create_tblposition_table', 1),
(16, '2019_03_27_033249_create_tbldetail_table', 1),
(17, '2019_03_27_033701_create_tblcheckin_table', 1),
(18, '2019_04_02_041712_create_tbldepartment_table', 1),
(19, '2019_04_02_042741_create_tbllog_table', 1),
(20, '2019_04_02_043257_create_tblemail_table', 1),
(21, '2019_04_03_044705_drop_tblstaff_position_table', 1),
(22, '2019_04_08_142420_create_user_activations_table', 1),
(23, '2019_04_08_143457_alter_users_table', 1),
(24, '2019_04_09_033129_create_tblcheckout_table', 1),
(25, '2019_04_15_150625_statistics_checkout', 2),
(26, '2019_04_18_045116_create_tblstatistic_table', 2),
(27, '2019_04_18_074139_add_id_staff_to_tbllog_table', 2),
(28, '2019_04_18_075146_add_id_staff_to_tbllog', 2),
(29, '2019_04_19_103521_add_id_staff_to_tblstatistic', 2),
(30, '2019_04_22_015939_create_tbltime_table', 2),
(31, '2019_04_25_084223_add_status_to_tblcheckin', 2),
(32, '2019_05_02_022039_add_token_to_user_activation', 2),
(33, '2019_05_03_035756_remove_content_from_tblemail', 2),
(34, '2019_05_03_040610_remove_content_from_email', 3),
(35, '2019_05_03_043105_add_user_id_to_tblemail', 3),
(36, '2019_05_13_083510_alter_table_tbllog', 3),
(37, '2019_05_13_083702_alter_table_tblcheckin', 4),
(38, '2019_05_13_094053_create_tblmonth_table', 4),
(39, '2019_05_14_033346_remove_finish_hour_from_tblcheckin', 4),
(40, '2019_05_14_033749_add_finish_hour_to_tblcheckin', 5),
(41, '2019_05_14_083515_create_tbl_timelog_table', 6),
(42, '2019_05_14_091128_create_tbl_log_detail_table', 6),
(43, '2019_05_14_160901_add_checkdate_to_tbltimelog', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblcheckin`
--

CREATE TABLE `tblcheckin` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_statist` int(10) UNSIGNED NOT NULL,
  `start_hour` time NOT NULL DEFAULT '08:30:00',
  `check_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `finish_hour` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblcheckin`
--

INSERT INTO `tblcheckin` (`id`, `id_statist`, `start_hour`, `check_date`, `created_at`, `updated_at`, `status`, `finish_hour`) VALUES
(1, 1, '11:10:00', '2019-05-14', '2019-05-14 04:10:02', '2019-05-14 06:14:02', 1, '13:14:00'),
(2, 15, '11:16:00', '2019-05-14', '2019-05-14 04:16:08', '2019-05-14 04:58:41', 1, '11:58:00'),
(3, 16, '11:21:00', '2019-05-14', '2019-05-14 04:21:36', '2019-05-14 04:38:57', 1, '11:38:00'),
(4, 17, '13:17:00', '2019-05-14', '2019-05-14 06:17:19', '2019-05-14 06:18:26', 1, '13:18:00'),
(5, 18, '13:27:00', '2019-05-14', '2019-05-14 06:28:01', '2019-05-14 06:28:17', 1, '13:28:00'),
(6, 19, '13:33:00', '2019-05-14', '2019-05-14 06:33:37', '2019-05-14 06:34:00', 1, '13:33:00'),
(7, 20, '22:07:00', '2019-05-14', '2019-05-14 15:07:38', '2019-05-14 15:08:02', 1, '22:08:00'),
(8, 20, '22:07:00', '2019-05-14', '2019-05-14 15:07:41', '2019-05-14 15:07:41', 0, NULL),
(9, 20, '22:07:00', '2019-05-14', '2019-05-14 15:07:42', '2019-05-14 15:07:42', 0, NULL),
(10, 20, '22:07:00', '2019-05-14', '2019-05-14 15:07:42', '2019-05-14 15:07:42', 0, NULL),
(11, 20, '22:07:00', '2019-05-14', '2019-05-14 15:07:42', '2019-05-14 15:07:42', 0, NULL),
(12, 20, '22:07:00', '2019-05-14', '2019-05-14 15:07:42', '2019-05-14 15:07:42', 0, NULL),
(13, 26, '22:18:00', '2019-05-14', '2019-05-14 15:18:41', '2019-05-14 15:19:19', 1, '22:19:00'),
(14, 27, '22:33:00', '2019-05-14', '2019-05-14 15:33:55', '2019-05-14 15:38:17', 1, '22:38:00'),
(15, 28, '23:00:00', '2019-05-14', '2019-05-14 16:00:29', '2019-05-14 16:00:47', 1, '23:00:00'),
(16, 29, '23:05:00', '2019-05-14', '2019-05-14 16:05:19', '2019-05-14 16:05:36', 1, '23:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblcheckout`
--

CREATE TABLE `tblcheckout` (
  `id` int(10) UNSIGNED NOT NULL,
  `month` int(11) NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartment`
--

CREATE TABLE `tbldepartment` (
  `id` int(10) UNSIGNED NOT NULL,
  `department_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbldepartment`
--

INSERT INTO `tbldepartment` (`id`, `department_name`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 'IT', 12, '2019-05-14 15:43:52', '2019-05-14 15:43:52'),
(2, 'Nhân sự', 23, '2019-05-14 15:44:00', '2019-05-14 15:44:00'),
(3, 'Kế Toán', 24, '2019-05-14 15:44:12', '2019-05-14 15:44:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbldetail`
--

CREATE TABLE `tbldetail` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_staff` int(10) UNSIGNED NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `larary` double NOT NULL,
  `phone` int(11) NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbldetail`
--

INSERT INTO `tbldetail` (`id`, `id_staff`, `dob`, `gender`, `larary`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 151, '2000-05-03', 'Nữ', 123, 345260388, 'Ninh Binh', '2019-05-14 15:50:23', '2019-05-14 15:50:23');

-- --------------------------------------------------------

--
-- Table structure for table `tblemail`
--

CREATE TABLE `tblemail` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_recive` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbllog`
--

CREATE TABLE `tbllog` (
  `id` int(10) UNSIGNED NOT NULL,
  `datetime_log` datetime NOT NULL,
  `action` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_staff` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbllog`
--

INSERT INTO `tbllog` (`id`, `datetime_log`, `action`, `created_at`, `updated_at`, `id_staff`) VALUES
(2, '2019-05-13 21:39:10', 'Login', '2019-05-13 14:39:10', '2019-05-13 14:39:10', 1),
(3, '2019-05-13 22:11:44', 'Login', '2019-05-13 15:11:44', '2019-05-13 15:11:44', 1),
(4, '2019-05-14 08:55:39', 'Login', '2019-05-14 01:55:39', '2019-05-14 01:55:39', 1),
(5, '2019-05-14 11:10:02', 'Checkin', '2019-05-14 04:10:02', '2019-05-14 04:10:02', 1),
(6, '2019-05-14 11:15:54', 'Login', '2019-05-14 04:15:54', '2019-05-14 04:15:54', 2),
(7, '2019-05-14 11:16:08', 'Checkin', '2019-05-14 04:16:08', '2019-05-14 04:16:08', 2),
(8, '2019-05-14 11:21:25', 'Login', '2019-05-14 04:21:25', '2019-05-14 04:21:25', 5),
(9, '2019-05-14 11:21:36', 'Checkin', '2019-05-14 04:21:36', '2019-05-14 04:21:36', 5),
(10, '2019-05-14 11:58:31', 'Login', '2019-05-14 04:58:31', '2019-05-14 04:58:31', 2),
(11, '2019-05-14 13:13:58', 'Login', '2019-05-14 06:13:58', '2019-05-14 06:13:58', 1),
(12, '2019-05-14 13:17:12', 'Login', '2019-05-14 06:17:12', '2019-05-14 06:17:12', 23),
(13, '2019-05-14 13:17:19', 'Checkin', '2019-05-14 06:17:19', '2019-05-14 06:17:19', 23),
(14, '2019-05-14 13:27:55', 'Login', '2019-05-14 06:27:55', '2019-05-14 06:27:55', 24),
(15, '2019-05-14 13:28:01', 'Checkin', '2019-05-14 06:28:01', '2019-05-14 06:28:01', 24),
(16, '2019-05-14 13:33:28', 'Login', '2019-05-14 06:33:28', '2019-05-14 06:33:28', 25),
(17, '2019-05-14 13:33:37', 'Checkin', '2019-05-14 06:33:37', '2019-05-14 06:33:37', 25),
(18, '2019-05-14 22:07:30', 'Login', '2019-05-14 15:07:30', '2019-05-14 15:07:30', 21),
(19, '2019-05-14 22:07:38', 'Checkin', '2019-05-14 15:07:38', '2019-05-14 15:07:38', 21),
(25, '2019-05-14 22:18:35', 'Login', '2019-05-14 15:18:35', '2019-05-14 15:18:35', 22),
(26, '2019-05-14 22:18:41', 'Checkin', '2019-05-14 15:18:41', '2019-05-14 15:18:41', 22),
(27, '2019-05-14 22:32:43', 'Login', '2019-05-14 15:32:43', '2019-05-14 15:32:43', 23),
(28, '2019-05-14 22:33:49', 'Login', '2019-05-14 15:33:49', '2019-05-14 15:33:49', 11),
(29, '2019-05-14 22:33:55', 'Checkin', '2019-05-14 15:33:55', '2019-05-14 15:33:55', 11),
(30, '2019-05-14 22:43:52', 'Create Department', '2019-05-14 15:43:52', '2019-05-14 15:43:52', 11),
(31, '2019-05-14 22:44:00', 'Create Department', '2019-05-14 15:44:00', '2019-05-14 15:44:00', 11),
(32, '2019-05-14 22:44:12', 'Create Department', '2019-05-14 15:44:12', '2019-05-14 15:44:12', 11),
(33, '2019-05-14 22:50:23', 'Created User ', '2019-05-14 15:50:23', '2019-05-14 15:50:23', 11),
(34, '2019-05-14 23:00:24', 'Login', '2019-05-14 16:00:24', '2019-05-14 16:00:24', 151),
(35, '2019-05-14 23:00:29', 'Checkin', '2019-05-14 16:00:29', '2019-05-14 16:00:29', 151),
(36, '2019-05-14 23:05:12', 'Login', '2019-05-14 16:05:12', '2019-05-14 16:05:12', 16),
(37, '2019-05-14 23:05:19', 'Checkin', '2019-05-14 16:05:19', '2019-05-14 16:05:19', 16);

-- --------------------------------------------------------

--
-- Table structure for table `tbllogdetail`
--

CREATE TABLE `tbllogdetail` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_timelog` int(10) UNSIGNED NOT NULL,
  `checkin_time` time DEFAULT NULL,
  `checkout_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbllogdetail`
--

INSERT INTO `tbllogdetail` (`id`, `id_timelog`, `checkin_time`, `checkout_time`, `created_at`, `updated_at`) VALUES
(1, 8, '22:33:56', NULL, '2019-05-14 15:33:56', '2019-05-14 15:33:56'),
(2, 9, '23:00:29', NULL, '2019-05-14 16:00:29', '2019-05-14 16:00:29'),
(3, 10, '23:05:19', NULL, '2019-05-14 16:05:19', '2019-05-14 16:05:19');

-- --------------------------------------------------------

--
-- Table structure for table `tblmonth`
--

CREATE TABLE `tblmonth` (
  `id` int(10) UNSIGNED NOT NULL,
  `month` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblposition`
--

CREATE TABLE `tblposition` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_department` int(10) UNSIGNED NOT NULL,
  `position_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblposition`
--

INSERT INTO `tblposition` (`id`, `id_department`, `position_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Intern', 'EOjVGUFQw2L00705HVFj', NULL, NULL),
(2, 1, 'Fresher', 'kpUCXuKzyxt1VHGGmR6g', NULL, NULL),
(3, 3, 'Senior', '1HwJVRnntnxMCOWXFRU7', NULL, NULL),
(4, 2, 'Junior', 'DT8doNo9DmdlVF0Xh7On', NULL, NULL),
(5, 1, 'Coder', '7NXjyIbZoHt8XLGXwC3T', NULL, NULL),
(6, 1, 'Intern', 'xkr5NUxYBRkGNK77Sktc', NULL, NULL),
(7, 1, 'Fresher', 'Fjjc8stvVXFzaWijxe8x', NULL, NULL),
(8, 3, 'Senior', 'euUnpodbrm6XJSlcX5WA', NULL, NULL),
(9, 2, 'Junior', 'BO5uMlkRUhHpyYodRc5L', NULL, NULL),
(10, 1, 'Coder', '2eOtVO1lZCy7jW7aTiyg', NULL, NULL),
(11, 1, 'Intern', '1cLkyP6hGDWc0Q1PENTU', NULL, NULL),
(12, 1, 'Fresher', 'KokuhQy07fvv5o5Iet4B', NULL, NULL),
(13, 3, 'Senior', '2XiuqM260HEc2YlyhjcT', NULL, NULL),
(14, 2, 'Junior', 'MBBP2SPsx8KEUZASeORf', NULL, NULL),
(15, 1, 'Coder', 'CvDphLra1jkhI133sHf4', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblstatistic`
--

CREATE TABLE `tblstatistic` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_month` int(10) UNSIGNED NOT NULL,
  `id_staff` int(10) UNSIGNED NOT NULL,
  `total_working_hour` double NOT NULL DEFAULT '0',
  `total_leave_hour` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblstatistic`
--

INSERT INTO `tblstatistic` (`id`, `id_month`, `id_staff`, `total_working_hour`, `total_leave_hour`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 0, 0, '2019-05-14 03:43:56', '2019-05-14 03:43:56'),
(15, 2, 2, 0, 0, '2019-05-14 04:16:08', '2019-05-14 04:16:08'),
(16, 2, 5, 0, 0, '2019-05-14 04:21:36', '2019-05-14 04:21:36'),
(17, 2, 23, 0, 0, '2019-05-14 06:17:19', '2019-05-14 06:17:19'),
(18, 2, 24, 1, 479, '2019-05-14 06:28:01', '2019-05-14 06:28:18'),
(19, 2, 25, 0, 480, '2019-05-14 06:33:37', '2019-05-14 06:34:00'),
(20, 2, 21, 1, 959, '2019-05-14 15:07:38', '2019-05-14 15:08:02'),
(21, 2, 21, 0, 0, '2019-05-14 15:07:41', '2019-05-14 15:07:41'),
(22, 2, 21, 0, 0, '2019-05-14 15:07:42', '2019-05-14 15:07:42'),
(23, 2, 21, 0, 0, '2019-05-14 15:07:42', '2019-05-14 15:07:42'),
(24, 2, 21, 0, 0, '2019-05-14 15:07:42', '2019-05-14 15:07:42'),
(25, 2, 21, 0, 0, '2019-05-14 15:07:42', '2019-05-14 15:07:42'),
(26, 2, 22, 1, 479, '2019-05-14 15:18:41', '2019-05-14 15:19:20'),
(27, 2, 11, 5, 475, '2019-05-14 15:33:55', '2019-05-14 15:38:17'),
(28, 2, 151, 0, 480, '2019-05-14 16:00:29', '2019-05-14 16:00:47'),
(29, 2, 16, 0, 480, '2019-05-14 16:05:19', '2019-05-14 16:05:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbltime`
--

CREATE TABLE `tbltime` (
  `id` int(10) UNSIGNED NOT NULL,
  `month` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbltime`
--

INSERT INTO `tbltime` (`id`, `month`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, NULL),
(2, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbltimelog`
--

CREATE TABLE `tbltimelog` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `checkdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbltimelog`
--

INSERT INTO `tbltimelog` (`id`, `user_id`, `status`, `created_at`, `updated_at`, `checkdate`) VALUES
(1, 21, 0, '2019-05-14 15:07:38', '2019-05-14 15:07:38', '0000-00-00'),
(2, 21, 0, '2019-05-14 15:07:41', '2019-05-14 15:07:41', '0000-00-00'),
(3, 21, 0, '2019-05-14 15:07:42', '2019-05-14 15:07:42', '0000-00-00'),
(4, 21, 0, '2019-05-14 15:07:42', '2019-05-14 15:07:42', '0000-00-00'),
(5, 21, 0, '2019-05-14 15:07:42', '2019-05-14 15:07:42', '0000-00-00'),
(6, 21, 0, '2019-05-14 15:07:43', '2019-05-14 15:07:43', '0000-00-00'),
(7, 22, 0, '2019-05-14 15:18:41', '2019-05-14 15:18:41', '0000-00-00'),
(8, 11, 0, '2019-05-14 15:33:55', '2019-05-14 15:33:55', '0000-00-00'),
(9, 151, 0, '2019-05-14 16:00:29', '2019-05-14 16:00:29', '0000-00-00'),
(10, 16, 0, '2019-05-14 16:05:19', '2019-05-14 16:05:19', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_department` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_department`, `image`, `fullname`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `active`) VALUES
(1, 3, 'images/5.jpeg', 'Amir Denesik', 'e9dnjpBgud@gmail.com', NULL, '$2y$10$3RIlgioWj4h8E1oBpkxoz.JbFSNb8VUi7A1xcQwIUrNeL7spFHr0K', 1, NULL, NULL, NULL, 1),
(2, 3, 'images/4.jpeg', 'Audrey Morar', 'tfbHxh9OLm@gmail.com', NULL, '$2y$10$t07QPY7OimiWREXuJdlY5.YoSebBcVLbzRQpqprG9sjhkb/.zN2YK', 0, NULL, NULL, NULL, 1),
(3, 1, 'images/5.jpeg', 'Vida Abshire', 'SG05RDUBUD@gmail.com', NULL, '$2y$10$stgi9FEr8Tz3elE81xMkR.hSF8VJUetttUfUs0ZW55vbaesAN8gzm', 0, NULL, NULL, NULL, 0),
(4, 1, 'images/5.jpeg', 'Otis Heaney', 'qoOAVDPu3p@gmail.com', NULL, '$2y$10$dwM7WOIERXp2v6akhudzm.hSh33C.QV/RsZu4owMjGZqAGyDW.BhG', 0, NULL, NULL, NULL, 0),
(5, 2, 'images/10.jpeg', 'German Marks', 'thRlGnMi9I@gmail.com', NULL, '$2y$10$NZjTw98s0HmnSwdq9eUg7uQ8IjgHZsY7gID2ORdtUAkjI7.RVCltC', 1, NULL, NULL, NULL, 1),
(6, 2, 'images/6.jpeg', 'Sadye Cremin', '0wab65RuK2@gmail.com', NULL, '$2y$10$iLCWPtskdjBLI2nKLbDxaes.uIxbZVUrRdsLgKyk5Xv/0p23FzWtG', 1, NULL, NULL, NULL, 1),
(7, 1, 'images/8.jpeg', 'Howell Fadel', 'ylkAm7Qa3V@gmail.com', NULL, '$2y$10$YSwOpzGIxQ7yEmjUpZwKnOvJyoq9dfR9xIwAiCD4cbi6CcFGlSdNa', 0, NULL, NULL, NULL, 0),
(8, 2, 'images/8.jpeg', 'Dr. Pauline Sauer', 'fCOplhol8x@gmail.com', NULL, '$2y$10$4InnN.H6U0f7bRj3pl.O5O18ffEKRQl1aikRcc8GbcxPn27Cbj56W', 0, NULL, NULL, NULL, 0),
(9, 2, 'images/6.jpeg', 'Blair Sipes', 'oK8z8b6gwn@gmail.com', NULL, '$2y$10$RHjj0ixR9HD4mDRRbG8kR.FWYWYkQo4oNoei4IxhYRdcZUE9qgBIS', 0, NULL, NULL, NULL, 0),
(10, 3, 'images/5.jpeg', 'Seth Ledner', 'cbdZv3pEQr@gmail.com', NULL, '$2y$10$bYmDtSPmDEex4ivPHUiwMOeWUMzp1A.8E7uXeLLqD62x7Zj8Hvcqu', 0, NULL, NULL, NULL, 0),
(11, 2, 'images/2.jpeg', 'Philip Hodkiewicz DVM', 'DL9uUYibvo@gmail.com', NULL, '$2y$10$nmeSN/rux0P3n/Ktk/p7.uF5KQ/QYFlGlymdsXDuEYxnr5dhJIKVO', 1, NULL, NULL, NULL, 1),
(12, 2, 'images/7.jpeg', 'Miss Anika Abbott', 'BzoZ06Le17@gmail.com', NULL, '$2y$10$WXGWlyzFt12L3BCRAKcx0OCIQSMi4jk7sK6G5PuNbaBToetE3o/xy', 1, NULL, NULL, NULL, 1),
(13, 3, 'images/7.jpeg', 'Melvina Schiller', 'aY0aur1OGj@gmail.com', NULL, '$2y$10$HzvffEEHtw0rn1dQdGM./e7GokE3Gtse30CFY0zfVTf/7Jcbqv3tS', 0, NULL, NULL, NULL, 1),
(14, 1, 'images/8.jpeg', 'Godfrey Rogahn', 'TYDPaRVSnA@gmail.com', NULL, '$2y$10$6686jdTmlxnjXXBnnD.oNO2jsQwLY2aq96lb7f5jxnmWrbxlCQbdi', 0, NULL, NULL, NULL, 1),
(15, 1, 'images/7.jpeg', 'Xavier Hansen', '0v0fgooTow@gmail.com', NULL, '$2y$10$v2w261K44S4A8OpUNudGAOh8SXEyPugnNcCQv7BAzG3FPWRJHclme', 0, NULL, NULL, NULL, 0),
(16, 1, 'images/10.jpeg', 'Clyde Stoltenberg', 'PABLFJbA6n@gmail.com', NULL, '$2y$10$QqSbLzt3eAv3QNiWvUXqdO4P44GBFiobpcKbMWANjePO2HHdXXt/e', 1, NULL, NULL, NULL, 1),
(17, 3, 'images/6.jpeg', 'Aniya Larkin', '6xGJliOjML@gmail.com', NULL, '$2y$10$PJDThHlBtYI0OypSC7bAte3L.AT8TCKfkX9EhqD/6AikNlVhxTlN6', 0, NULL, NULL, NULL, 0),
(18, 3, 'images/2.jpeg', 'Dr. Shaylee Bailey', '38L7YoR4iB@gmail.com', NULL, '$2y$10$03jrRYGcP3GfC/8kM4mfDuH7thFQL8ZW/E.TgmWuH3Ancyk8Z.udO', 0, NULL, NULL, NULL, 0),
(19, 1, 'images/8.jpeg', 'Raina Turcotte', 'GqvJmjoxqz@gmail.com', NULL, '$2y$10$t6Fi0lT2DzEwqhY0nH5VkeeqpvfjEXbrCeOGVEV08wPqlHfAQetgK', 1, NULL, NULL, NULL, 0),
(20, 1, 'images/9.jpeg', 'Tanya Shields', '2StKvx1xO8@gmail.com', NULL, '$2y$10$5xxcon2o9LWKF2GMnBwjcedc4h2GmXHOGeU2c31Z9WptEO9GM7hk6', 1, NULL, NULL, NULL, 0),
(21, 1, 'images/1.jpeg', 'Irwin Luettgen', '1rYgEeMFgj@gmail.com', NULL, '$2y$10$TE2y.6QEhL94zRi9AV77v.607gLXmzvTDmlJkRgYohbYumQoPy8Xq', 1, NULL, NULL, NULL, 1),
(22, 1, 'images/10.jpeg', 'Shayne Borer', 'Be8TfaFUJo@gmail.com', NULL, '$2y$10$hoG4jpZM62oHlFONWudJv.N.OYQ2/p.dA/iEK7fnuG1po6HOb1E7y', 1, NULL, NULL, NULL, 1),
(23, 1, 'images/4.jpeg', 'Declan Padberg', 'b3TNkrOjqN@gmail.com', NULL, '$2y$10$kQPeN95RPrgtgp3UGyIKx.0GTWUNKOT27LgtvgFRmNuoYb.jkamyG', 1, NULL, NULL, NULL, 1),
(24, 2, 'images/8.jpeg', 'Virginia Klein', 'b2fA87BbEO@gmail.com', NULL, '$2y$10$QyzAasrpMN2VVrLGinRaXO3tSk9EKQK6vmWbgtfP4HCxpgSOB5RBa', 0, NULL, NULL, NULL, 1),
(25, 2, 'images/10.jpeg', 'Ms. Asa Metz Jr.', 'BnB1CQiNf4@gmail.com', NULL, '$2y$10$7e9N6fqpzduQwms1TYLqo.8o4nrq.pafeivP6ySIsuzn5.p0ojw2G', 0, NULL, NULL, NULL, 1),
(26, 1, 'images/9.jpeg', 'Nigel Welch', 'LrwiHmWjwh@gmail.com', NULL, '$2y$10$mrfecjv8xiZspzk13BCwRuse7uHUy5tojblpMtXCNy3lD6ndQ2hiq', 0, NULL, NULL, NULL, 0),
(27, 3, 'images/7.jpeg', 'Milo Hickle', 'Miq0ARzbTD@gmail.com', NULL, '$2y$10$Mbh6MQWhrkC6WqmKbj/Je.zGduiQ5O.0pG.U2ioSCCDr3O2f0nI6C', 1, NULL, NULL, NULL, 0),
(28, 1, 'images/9.jpeg', 'Mr. Kayden Larson PhD', '2eW638znqW@gmail.com', NULL, '$2y$10$KynS2YQ5JXXqJh4jUMxuNeI6T5UUbe2QQ7F.wVfNOekkErG5s6Dga', 0, NULL, NULL, NULL, 0),
(29, 1, 'images/7.jpeg', 'Cicero Hahn V', 'eGUDwlfh3d@gmail.com', NULL, '$2y$10$l.ircIKXPb7zjK2C29TOeufg.U/7d0XvH.j1viCW6Ru3WUmTp6Lma', 1, NULL, NULL, NULL, 0),
(30, 2, 'images/9.jpeg', 'Jules Feeney DVM', 'hbvwm924s7@gmail.com', NULL, '$2y$10$CWGJ3XrbC3dAXwEcLwsYIu4HLYM0F9y675ssDlZQwmTYo2bKpblMO', 1, NULL, NULL, NULL, 0),
(31, 3, 'images/7.jpeg', 'Janet Bayer', 'Pnu1It6e4i@gmail.com', NULL, '$2y$10$isrgambEknqCNf0CKQCjfuhr2pVtAbQfzDZYO.HikmUh9P4PHKoFW', 0, NULL, NULL, NULL, 0),
(32, 2, 'images/3.jpeg', 'Santina VonRueden', 'FHou91mK16@gmail.com', NULL, '$2y$10$VJDn4e9RU0Uy/Xt708eZZu.LkzvsLv7RakV04HLgobMIBJWtR4ki6', 0, NULL, NULL, NULL, 1),
(33, 2, 'images/9.jpeg', 'Janis Rutherford MD', 'JryfKiIZVP@gmail.com', NULL, '$2y$10$/wnAngf9zbKPtQhJmNnJJ.9YyGW6F/1YjfzCLLBljAqNo1qK.zAry', 1, NULL, NULL, NULL, 0),
(34, 3, 'images/3.jpeg', 'Camden Carroll Jr.', 'ydC1MK2MhN@gmail.com', NULL, '$2y$10$AWG99GivHr72tB9IXGyYGexvKwPyPNXDXfswlb3zDPI8RZ20av/.m', 0, NULL, NULL, NULL, 0),
(35, 3, 'images/10.jpeg', 'Alysa Cassin IV', 'j1MQ2gquty@gmail.com', NULL, '$2y$10$R6UQ0wwXiXZ78jOaP3hr2O8x/YYH5C9GBaLfRZHJZUCnBkLkoKnB.', 1, NULL, NULL, NULL, 0),
(36, 1, 'images/3.jpeg', 'Matteo Pagac DDS', 'dCZ04EGGTT@gmail.com', NULL, '$2y$10$wacEoMRmbibMEgSDF9fJle6Tqy4b6l7Gu03XIIgfrtxJFwf59Os9a', 1, NULL, NULL, NULL, 0),
(37, 3, 'images/8.jpeg', 'Hyman Lang', 'o5BDu6DAQ9@gmail.com', NULL, '$2y$10$OrZy.eFmHlVwQY9oBkUZkuPtj5bdzc6sukAXQjf/5PK98RdfT/SvC', 0, NULL, NULL, NULL, 0),
(38, 3, 'images/5.jpeg', 'Susan Skiles', 'Asa4BD266V@gmail.com', NULL, '$2y$10$7fOfPrlxycxYSUxSXN7yZ..WmLbfZtXDvv7/lFjec8WP8WPwSnJMi', 1, NULL, NULL, NULL, 0),
(39, 3, 'images/4.jpeg', 'Kariane Brown', '7wMES3uQwV@gmail.com', NULL, '$2y$10$9Khkw17EZcPHOvlRok9OteW6TSb8rwT0vppQayaw9flCaIWaG2ROq', 0, NULL, NULL, NULL, 0),
(40, 2, 'images/2.jpeg', 'Angelo Boehm', 'XtRvNZWMhU@gmail.com', NULL, '$2y$10$wmQGEJ/GzSnl4/.8EgVT1e4xlO8kx.zzX0UE.b3kmh49Ppcpg34OW', 1, NULL, NULL, NULL, 0),
(41, 1, 'images/6.jpeg', 'Dr. Cruz Bartell Jr.', 'cJLG7AC60p@gmail.com', NULL, '$2y$10$j3blQ14I9KxabGZo4ltCkeIUcKWNhSKIY2/NH82iqUKwvkGR7SGUS', 0, NULL, NULL, NULL, 0),
(42, 3, 'images/2.jpeg', 'Mr. Virgil Tremblay', 'pxBscFnzZr@gmail.com', NULL, '$2y$10$xq4DmtVVKQtrolh7J.Y0TeeXy/Uq1Pp31khxInho12MT9XIu700WS', 1, NULL, NULL, NULL, 0),
(43, 3, 'images/1.jpeg', 'Quentin Toy', 'KNJTFeC4b0@gmail.com', NULL, '$2y$10$pzEPo1uBS4PZdwt6/R4Wy.xi9qctC1.W2Q8AMjfrm21APB39TXqlW', 0, NULL, NULL, NULL, 0),
(44, 3, 'images/2.jpeg', 'Avis Strosin', 'Rgq24FTLMq@gmail.com', NULL, '$2y$10$2.jGRlyEHeD3.dbSY9PZCOjJsdFvaZqxYs99G4EW3.f.JsOTWzFCK', 1, NULL, NULL, NULL, 0),
(45, 1, 'images/10.jpeg', 'Mervin Collins', 'fBc3sGLj5D@gmail.com', NULL, '$2y$10$.o.8t4fQpRn.dS1dhSz7C.fN1B3Rs8AnoWTQ5jBR9WMmtRPFJ0lOa', 1, NULL, NULL, NULL, 0),
(46, 3, 'images/5.jpeg', 'Myriam Tromp', 'yJRNdMYC7R@gmail.com', NULL, '$2y$10$Yxz8t1bMTggA/JMmMF9SS.7EfuedOvxODda0bMVygdRvzbUV1cmeW', 1, NULL, NULL, NULL, 0),
(47, 2, 'images/6.jpeg', 'Tiffany Casper PhD', '6qAKtzl3PS@gmail.com', NULL, '$2y$10$XFqHMoiZzhH49SQeUHkdGe/C.WKACgRY1zo34OXVX1GnbH6bw8D2a', 1, NULL, NULL, NULL, 0),
(48, 1, 'images/1.jpeg', 'Prof. Hailee Dicki II', 'pb7wbChJUh@gmail.com', NULL, '$2y$10$KIremE0uwwfs2lrIHFtZ0OEAmdSW7GKkOXHotnQSJvfIFKzJAlOSi', 1, NULL, NULL, NULL, 0),
(49, 3, 'images/8.jpeg', 'Prof. Wendell Koepp', 'hHdBA7CvMz@gmail.com', NULL, '$2y$10$9o.GuATbv5ATyFIH.stQV.R9NUbyvSRwXDtT1T46utLzP3qAEkVFW', 1, NULL, NULL, NULL, 0),
(50, 2, 'images/2.jpeg', 'Dr. Jaycee Kihn II', 'Bfro1qLK3D@gmail.com', NULL, '$2y$10$ccFmux38Sy9hRfb2H5lp2uVWl4td1vQihg3NPANKFryT.h6OAx3de', 0, NULL, NULL, NULL, 0),
(51, 2, 'images/6.jpeg', 'Cecile Stracke', 'UaD4A2yaYV@gmail.com', NULL, '$2y$10$NeL6Fb.apV5qgKvUBuK/xuT5MPY5ct54yk7m2OWBAF8HTxlnREVsi', 0, NULL, NULL, NULL, 0),
(52, 2, 'images/3.jpeg', 'Gina Lemke', '15Exc15ujN@gmail.com', NULL, '$2y$10$qVlxqfYsqx06fzA.OTHv3uVdBNtufxiSy8NNJQ2l8IOkJfpR3NWcO', 0, NULL, NULL, NULL, 0),
(53, 3, 'images/1.jpeg', 'Rory Huels', 'PciVrfL8al@gmail.com', NULL, '$2y$10$3.F8Aex6B8YLC/MwxHipJ.HOWKeJNlKbHFYTBybx98qtEIbfALo3C', 0, NULL, NULL, NULL, 0),
(54, 2, 'images/5.jpeg', 'Jany Macejkovic', '8DZ3wLJ90l@gmail.com', NULL, '$2y$10$udAq/u30/Ecl8O01jnRZDudAMH29o.Amxz3KzpCFQFZ04NDQthBM.', 0, NULL, NULL, NULL, 0),
(55, 3, 'images/6.jpeg', 'Lou Rowe', 'MTzt3tFEsa@gmail.com', NULL, '$2y$10$d63nD4TA/HETFCV8xLYbXuUQQB370M4/1/nVO5vljo4fk8UO51xbq', 0, NULL, NULL, NULL, 0),
(56, 2, 'images/2.jpeg', 'Esther Keeling IV', '3lYn5nvml5@gmail.com', NULL, '$2y$10$HVUfJZ78Q0h3UaK/jNYZVOIsCy3E0llqbpVTUFTqPj7MlBgC49NWe', 1, NULL, NULL, NULL, 0),
(57, 3, 'images/7.jpeg', 'Greyson Langosh', 'NJtyqZgcF7@gmail.com', NULL, '$2y$10$elu0/bYTcm5x2cUuijEWhuW.P832br13Pcv.Df3qX4uW9YhPwBGc.', 1, NULL, NULL, NULL, 0),
(58, 1, 'images/5.jpeg', 'Brenden Smith III', 'nZBFcWpj1p@gmail.com', NULL, '$2y$10$oikaMNfZrGhMWdTVNIHPGu9wOWWLVy6PsfZ3vZzBXuf.qZWEfzQha', 1, NULL, NULL, NULL, 0),
(59, 1, 'images/5.jpeg', 'Kayden Walter', 'Z8kYz5094R@gmail.com', NULL, '$2y$10$ausn2Gj4qB9ckVovzc/HX.aYnRqwhug37r2xI2OvEdZwtTGav4jLu', 0, NULL, NULL, NULL, 0),
(60, 3, 'images/7.jpeg', 'Emanuel Raynor', 'ZrUIJvz0g6@gmail.com', NULL, '$2y$10$sgy.7vHHlgIGxZLM2wv1DOxHpP/y3n7NXF9kCZcNXC6C.xmSE4L5y', 1, NULL, NULL, NULL, 0),
(61, 2, 'images/8.jpeg', 'Monique Blanda', 'Dg5lB2zT9U@gmail.com', NULL, '$2y$10$i4rfzqa5Tq60VgymyIeUAeX3efXI.dxIUB3HH7xwGfRNP4IIcX3fi', 0, NULL, NULL, NULL, 0),
(62, 3, 'images/6.jpeg', 'Rick Blanda DVM', 'RL71R76QSZ@gmail.com', NULL, '$2y$10$e/5/ykYlQOf1hNv6XXxDeuX8NHfaWcz7Qj1b3XzP93T1SkV6TVfaC', 0, NULL, NULL, NULL, 0),
(63, 3, 'images/6.jpeg', 'Marquis Hermann', 'eAjqei2rcl@gmail.com', NULL, '$2y$10$Kp8jVNFtRe2QsLJRlbqJsOhFJ/11u6gdtfHpbbiHT/xRM8ORSdfC6', 1, NULL, NULL, NULL, 0),
(64, 2, 'images/9.jpeg', 'Miss Shaina Roob', 'he5ErO8JdW@gmail.com', NULL, '$2y$10$lTpGVNovMzTgaoynBwxhC.AU4hFn/x0rn8jNorxt31QuruA8XVeRO', 1, NULL, NULL, NULL, 0),
(65, 2, 'images/5.jpeg', 'Maryjane West', 'kieKwvJDTb@gmail.com', NULL, '$2y$10$qZuyGaSNFbK0FQgxBdKNMu2rLWBU1H5tbgwWcJZz/j1oWShwkHgme', 1, NULL, NULL, NULL, 0),
(66, 2, 'images/3.jpeg', 'Prof. Marilou Wilderman', 'L7KTli3JcQ@gmail.com', NULL, '$2y$10$tW73o9nitNteb5hKmHWCOetlrcylS8Z/G9KTx.IvZY49d9rtuJTSe', 0, NULL, NULL, NULL, 0),
(67, 1, 'images/3.jpeg', 'Quentin Jerde', 'JwHsPH8a8q@gmail.com', NULL, '$2y$10$Gj9A59aBBX0TuZAe7Fol4eFjib3Je8IY5Ym9lyx217mkFSoFDK6Xa', 0, NULL, NULL, NULL, 0),
(68, 2, 'images/9.jpeg', 'Brigitte Stehr', 'ELzjft1iqa@gmail.com', NULL, '$2y$10$d4UqfVLE5VxHtk5tQcBdzurFJKuobZQWhDEjI024xUERyEu1wPVjy', 1, NULL, NULL, NULL, 0),
(69, 1, 'images/2.jpeg', 'Aliza Kuvalis', 'KbXDtWRTjt@gmail.com', NULL, '$2y$10$uB07BQStAsYCDW6WTyMxmOfOKsi7RMLTTeJ7PW9xc4ewDAzW2lgwy', 0, NULL, NULL, NULL, 0),
(70, 3, 'images/1.jpeg', 'Aiden Collier', 'Gp0MxXQonR@gmail.com', NULL, '$2y$10$0zGbdKD8IYkBY7mfpZJ1m.aUuekMzFvJE1xoP7DIw/xE7S6xokMRS', 0, NULL, NULL, NULL, 0),
(71, 3, 'images/3.jpeg', 'Sofia Reichel II', 'ykZqMRZ42l@gmail.com', NULL, '$2y$10$xWJv/We5NG.AMQTNGnokmuP8PE/Qq424pe5UitRacXTBWePSHtSSe', 0, NULL, NULL, NULL, 0),
(72, 1, 'images/9.jpeg', 'Kaylah Von V', 'CZhKm68ErA@gmail.com', NULL, '$2y$10$/MxJ4eX/3iNXV7fH9o5ht.wcKi3Xx1FcYqo5GMU6q69Dtzc4NCnoi', 0, NULL, NULL, NULL, 0),
(73, 1, 'images/2.jpeg', 'Annetta Hilpert', 'sN5ezZ8XK5@gmail.com', NULL, '$2y$10$hy2bVmNzzsM1gZYEVJxCrOOlonFbpVkCj9zPhwy991ClJDO5BF6oq', 0, NULL, NULL, NULL, 0),
(74, 3, 'images/7.jpeg', 'Elliot Bogan II', 'OqYTtbkSB7@gmail.com', NULL, '$2y$10$42drycxU78Uhn2USJQ3/muaohL8T8WetF8tt5WMXo91xXl2pI0isa', 1, NULL, NULL, NULL, 0),
(75, 1, 'images/2.jpeg', 'Demetris Gaylord', 'k5C4fFtQEq@gmail.com', NULL, '$2y$10$OnO80X.3cL6UvYIfXnuQz.ePZ/r7yrHqDRUZJJ9otdf9hZFeTdJYC', 0, NULL, NULL, NULL, 0),
(76, 2, 'images/6.jpeg', 'Lamar Veum', '7kc86uKPPJ@gmail.com', NULL, '$2y$10$KUAJEKNLCJWQ/69ed7cCWORetBwqi8LGiVAzQ.dzMZ60Bg2kNZAni', 0, NULL, NULL, NULL, 0),
(77, 2, 'images/2.jpeg', 'Jamey Larson V', 'tl9jZBNI2j@gmail.com', NULL, '$2y$10$zRHjaWxllUmBEvyRrDRGI.GY9aIuQgNksb05aN9CnRge0hPLCdJXe', 0, NULL, NULL, NULL, 0),
(78, 1, 'images/4.jpeg', 'Gabriel O\'Kon', '3a3Z5EuUKt@gmail.com', NULL, '$2y$10$igHlNDbYzJOubJkqBCFaCOOJaEHJQ33p0BEObt1fSVCteyiX7.Sea', 1, NULL, NULL, NULL, 0),
(79, 3, 'images/2.jpeg', 'Prof. Ford Crona', '2ggjTcrfhH@gmail.com', NULL, '$2y$10$f0VpVu8H.LR9aKET6YUZpOPTzX.pdgc9zAQO11djyr0Dx8JTV7u1i', 1, NULL, NULL, NULL, 0),
(80, 1, 'images/2.jpeg', 'Lori Legros', '6ByQFeJbNk@gmail.com', NULL, '$2y$10$3LFsEkXujzPoK1ccHf6SWuiigE6oRtU48yxQM4KHaY.5XM7zEwd5y', 1, NULL, NULL, NULL, 0),
(81, 3, 'images/5.jpeg', 'Einar Lesch I', '0tAurkjeQY@gmail.com', NULL, '$2y$10$2b4LcrELcZKL8HnS9R2HJOpLE2bIJAIU1mMO897XTT0acG0FOxI86', 1, NULL, NULL, NULL, 0),
(82, 3, 'images/7.jpeg', 'Keagan Mitchell', 'Zqoa9Yawmu@gmail.com', NULL, '$2y$10$/pkvQFaX9/OW3msw.MIqi.N2fUXuLaIatXktaV76Gnh/6nV76plP.', 1, NULL, NULL, NULL, 0),
(83, 2, 'images/3.jpeg', 'Yazmin Boyer III', 'zE5fAdjBdn@gmail.com', NULL, '$2y$10$AXhvShbKUNnspUEIe/xlguOJkOuvBoxq5DrlOahjP3xCn79nxJdkq', 0, NULL, NULL, NULL, 0),
(84, 2, 'images/5.jpeg', 'Zoe Turcotte', 'nJeLw1TPy9@gmail.com', NULL, '$2y$10$mfXRP3kEOIu7lIoUK6z1A.ljjp22ORGgHPmmG8uv/9hsXauJOTW1u', 0, NULL, NULL, NULL, 0),
(85, 2, 'images/2.jpeg', 'Miss Wendy Mitchell DVM', 'LyKE16FZv7@gmail.com', NULL, '$2y$10$GlqHJOU7ylzFlGbUNxkaSuXrHBp2McuXSeh6sjH8hIMzJAAhOa7vC', 0, NULL, NULL, NULL, 0),
(86, 1, 'images/7.jpeg', 'Mrs. Rita Walsh', '4SpCbwKUzK@gmail.com', NULL, '$2y$10$j2hIvP8yRc3B1ZMgr4e5nu5Go15cKASsde/OvqhaMvIFeOhi/O7iK', 1, NULL, NULL, NULL, 0),
(87, 1, 'images/6.jpeg', 'Prof. Aaron Schiller', 'JvA5UdxoH7@gmail.com', NULL, '$2y$10$11MDVEpP5wCDTQ5DNAn.OuqXXtWRvSZsQVqzVo4/dVRl2s6BPXGkW', 0, NULL, NULL, NULL, 0),
(88, 2, 'images/9.jpeg', 'Ms. Selena Rodriguez', '8UbcDDlEBV@gmail.com', NULL, '$2y$10$/L9Ni75gJV0hbMWT31dWdeT71yWfHi.sdV7cXFjW/hKyRbYSkkHGW', 1, NULL, NULL, NULL, 0),
(89, 3, 'images/1.jpeg', 'Aurore Jerde IV', 'rorFFJ6vzF@gmail.com', NULL, '$2y$10$fPb6ICKchHQIuxPHtWThv.oGi/ZKobAFR9y/iILE/GHY.gQffGIrC', 0, NULL, NULL, NULL, 0),
(90, 3, 'images/2.jpeg', 'Arnulfo Schuster', 'sysPWE178V@gmail.com', NULL, '$2y$10$A4erJKqV5fhpdLBXOJCPqevWRJVQHFsob5hd93IQZ179ecpThGiGm', 0, NULL, NULL, NULL, 0),
(91, 1, 'images/3.jpeg', 'Mr. Orion Schowalter', 'u6ZA5o9eUg@gmail.com', NULL, '$2y$10$uGpNGMXJbFcPAmvadu.f6OBdaqDUgzE0YUc5SCx9aa2QMyk5dgm.G', 1, NULL, NULL, NULL, 0),
(92, 1, 'images/4.jpeg', 'Sincere Bartoletti PhD', 'oVHoiwAWPg@gmail.com', NULL, '$2y$10$tj/Ho.P8EKY.K7NFPYp4EeuBK.oKQrPP3/HmqeXfN6p/SCi2kmOr.', 0, NULL, NULL, NULL, 0),
(93, 2, 'images/6.jpeg', 'Dr. Jerod Franecki', 'CeyTNIS7dq@gmail.com', NULL, '$2y$10$SKgD.SjTZbxVdk8S1d/8z.WuyCFpc0Zsxe7fKmDIUN5ytjHzQO6t6', 0, NULL, NULL, NULL, 0),
(94, 3, 'images/8.jpeg', 'Dr. Heber Wolf', 'YfwxE3h66p@gmail.com', NULL, '$2y$10$04n2ODRD.SQl3RdiBcaVC.lx9mVyqML4K23/pJbFtOFfGs2uSRVl2', 0, NULL, NULL, NULL, 0),
(95, 2, 'images/10.jpeg', 'Dr. Jermey Conroy III', '5kPOuQmd4P@gmail.com', NULL, '$2y$10$AcZCG9sedAObxt56zuKuieHredUN/AMieO2ykTtE6xhgMVMcbjbna', 1, NULL, NULL, NULL, 0),
(96, 3, 'images/7.jpeg', 'Rachel Dietrich', 'll3v6IzJAy@gmail.com', NULL, '$2y$10$KRwOinr3GjR7oRLUrkfe8.4KNGG2YRBTxcl3KM/0tzI8hcMdmldRu', 1, NULL, NULL, NULL, 0),
(97, 1, 'images/2.jpeg', 'Mr. Lambert Gislason I', 'UEHy5Wg2im@gmail.com', NULL, '$2y$10$vTMwei/67W4hFNjrpanfi.3UH00Biq.ukmUkHwGLVrZ6OSZYiQvxa', 1, NULL, NULL, NULL, 0),
(98, 2, 'images/6.jpeg', 'Shirley Jast', 'ifytkZ0vgj@gmail.com', NULL, '$2y$10$Vd23T7CuCQ2kWfAZyLp//uiGvXPIuK9uR9XkBq6gfOvVedKRZIq4m', 1, NULL, NULL, NULL, 0),
(99, 3, 'images/2.jpeg', 'Novella Schmeler', 'wkpzFxj06i@gmail.com', NULL, '$2y$10$G4kuLgykOqan6tais7Z2q.ZM5oo8fWM7Pmo46Rl3Vvrx5P7PdbSQC', 1, NULL, NULL, NULL, 0),
(100, 2, 'images/7.jpeg', 'Mrs. Britney Denesik DVM', 'mIgJeLFqrC@gmail.com', NULL, '$2y$10$6npuCUHXfO6iQ6NRoyURH.k17d1q.baKxIJqtBdFjEpRW8kaCaGza', 0, NULL, NULL, NULL, 0),
(101, 2, 'images/10.jpeg', 'Mrs. Elvie Kertzmann III', 'K4jXDEr8AM@gmail.com', NULL, '$2y$10$wB3uDxGHUDwBHl9pBmTpfuHc864WFjTB1ditdQq0.JDmkTMHvQIzK', 0, NULL, NULL, NULL, 0),
(102, 1, 'images/3.jpeg', 'Amani Batz', 'zqrxTv6gH2@gmail.com', NULL, '$2y$10$9du8uLCo0U.pblsYWe2JtecIfl5QgHk.TFHHYwwkQ.UFvdDFuGRj.', 0, NULL, NULL, NULL, 0),
(103, 3, 'images/4.jpeg', 'Sandra Steuber', 'FDv0r4QoeB@gmail.com', NULL, '$2y$10$9FMtikIuDiVk1yEkJjuh9.EAdMDNIOg7tTpM6TIa/ARL4qhnxyYom', 0, NULL, NULL, NULL, 0),
(104, 2, 'images/3.jpeg', 'Julien McLaughlin', 'wBuwXjUkCL@gmail.com', NULL, '$2y$10$xOsqRTF/eQUThRnnAw4n8uJpASrzFP59KMamJxQg1a.Nnv0e8g/Ti', 1, NULL, NULL, NULL, 0),
(105, 1, 'images/6.jpeg', 'Hans Metz', 't4hsyUaUb6@gmail.com', NULL, '$2y$10$3UoTA54ZFWNMRRkgcLPRXucVIu4hR3/W..2Vju9gYXjB/tI87UpGW', 0, NULL, NULL, NULL, 0),
(106, 1, 'images/5.jpeg', 'Kayden Murazik', 'PzW1I92qC2@gmail.com', NULL, '$2y$10$QOHX.RblLYKSrMO1UEjAjOgDYR4WrQBp1.MTw.tFw8BFH/3xiY3/W', 0, NULL, NULL, NULL, 0),
(107, 3, 'images/3.jpeg', 'Naomie Mann', 'Re2teWoy28@gmail.com', NULL, '$2y$10$tpU4Ks.9OJ4xoFyzYFoN2e9w6CcwC.euq0F5rztLiZNktKB.ScGc2', 0, NULL, NULL, NULL, 0),
(108, 1, 'images/9.jpeg', 'Sonya Weimann', 'Ui8XrcjYc4@gmail.com', NULL, '$2y$10$5kQctTQGCqS02qbF.b2goeG0E17fC55oMpKz1b5GDHXvWiMqxQNle', 0, NULL, NULL, NULL, 0),
(109, 3, 'images/7.jpeg', 'Prof. Alda Weissnat III', 'GqlSqvTuzx@gmail.com', NULL, '$2y$10$JCFFruoSp9gKUhkNfkkx/O3Q6Q3wPYIA.oLVBrL9bHLuZEoPhcPdO', 1, NULL, NULL, NULL, 0),
(110, 3, 'images/2.jpeg', 'Evalyn Gleichner', 'Q0nD2l3dsX@gmail.com', NULL, '$2y$10$IghNzSnkdQ4NuD2gguaraO.75JhCxRs75SgjcgtkAr05lmMJuVoyi', 1, NULL, NULL, NULL, 0),
(111, 2, 'images/10.jpeg', 'Lorine Ryan', 'mL9VjME4jB@gmail.com', NULL, '$2y$10$qx9JNF7zkuVV1a04QdnS6u.3ZUbOutpfCWnhDWCSZyhUVoqcIzDPO', 1, NULL, NULL, NULL, 0),
(112, 3, 'images/2.jpeg', 'Dallin Parisian', '8P46pBWbIS@gmail.com', NULL, '$2y$10$VRb3jqFvf2ePRBEQ7SH5EeyKFVKXGjYWS9q0gayQwC/4e07h8l1nS', 1, NULL, NULL, NULL, 0),
(113, 1, 'images/1.jpeg', 'Marina Upton', 'thVsjt5ZVK@gmail.com', NULL, '$2y$10$HLaReWEerQnw813aQxoMf.fZ6uRD0UWeG8hoFdx0piVAEy42CraIa', 1, NULL, NULL, NULL, 0),
(114, 1, 'images/7.jpeg', 'Hardy Mertz Sr.', 'dRp1Ic3d8D@gmail.com', NULL, '$2y$10$8OvRKRckK2yCIYiT77My6OZCjX2n2HF/q.EMiFJxlxt.TAELfJHlG', 1, NULL, NULL, NULL, 0),
(115, 3, 'images/5.jpeg', 'Prof. Gabe Schuppe Sr.', 'LEOy6PopDB@gmail.com', NULL, '$2y$10$7y0D48v4.la/0ZtqAhDAMefo.fyQ2bWVphWLv66.fSabZqV2g6Uvm', 1, NULL, NULL, NULL, 0),
(116, 1, 'images/4.jpeg', 'Susan Crona', 'cLGMrRcINy@gmail.com', NULL, '$2y$10$T71oCwnPG0M0f5.LZWxhNON4eSzQqnC8X4NZu1lvjQWF.Mr54Dfuy', 1, NULL, NULL, NULL, 0),
(117, 3, 'images/5.jpeg', 'Tanya Jaskolski', 'GvHlhVdZZo@gmail.com', NULL, '$2y$10$Ym0rt2JWx4gESgtRCrciseOmMtrfQtftrFaSYyjXiQ1FAkjf5yj0O', 1, NULL, NULL, NULL, 0),
(118, 1, 'images/9.jpeg', 'Dr. Margarete Murazik PhD', 'xgxnPyc5r2@gmail.com', NULL, '$2y$10$JLMu9kvLZoOtAtFE1HWl.um7a8bPBvEVGWj4des.EF8/U9/y8BLUe', 0, NULL, NULL, NULL, 0),
(119, 2, 'images/7.jpeg', 'Prof. Kathryne Ernser III', 'OANpagStfc@gmail.com', NULL, '$2y$10$MAue8Y4EGx7Shs3LEWiyluOjIQT2ER0fNkqRsfZJ5wWc9VeJE.72u', 0, NULL, NULL, NULL, 0),
(120, 3, 'images/8.jpeg', 'Kamryn Boehm DDS', 'rIM7SQVljB@gmail.com', NULL, '$2y$10$E2Cq95vVxg2KoZVTKOljmuD9.X2dphA6h.0IUF6FcWF7Mz3Mi0IDi', 0, NULL, NULL, NULL, 0),
(121, 2, 'images/2.jpeg', 'Prof. Lily Jaskolski DVM', 'Cr2Gu5HnYU@gmail.com', NULL, '$2y$10$2oZLG3y82Obu/.wdMfxGFOGj59DX4moA/zbfr0fle/Rsg.k5K6tZ.', 0, NULL, NULL, NULL, 0),
(122, 2, 'images/7.jpeg', 'Novella Streich', 'rk9sSJX5iX@gmail.com', NULL, '$2y$10$dglk80PEHaZ5DyoTPKJqYOYwbIZYS9ONd5U8dqrpLyQ3LZH2dWX62', 1, NULL, NULL, NULL, 0),
(123, 3, 'images/3.jpeg', 'Prof. Roselyn Berge V', '3lmovwQ1PB@gmail.com', NULL, '$2y$10$wDHk.dW.gjUepooPOmNP4eIk3Y/tD3mS6vHlmkmoAmXV0sdpEQGMq', 1, NULL, NULL, NULL, 0),
(124, 2, 'images/7.jpeg', 'Fleta Gerlach', 'uYlfKRZiCb@gmail.com', NULL, '$2y$10$oJhRDmTxRw.1iQrQEzRPHeT/t9440kpT4Z1FgFkhv9HoTeQEhDlCO', 0, NULL, NULL, NULL, 0),
(125, 2, 'images/9.jpeg', 'Marguerite Sporer', 'Ygz5QVmbv8@gmail.com', NULL, '$2y$10$eJX5xosKrJ66GupdoFWgSuQkChVx6ndgSRGaj/7437wuSpiBc4g2G', 0, NULL, NULL, NULL, 0),
(126, 1, 'images/7.jpeg', 'Juwan Lockman III', 'QdVwfXCPKe@gmail.com', NULL, '$2y$10$ymkSEauEorc67TnxbmWg2O/iBCQQxydySeRZ294od1JEz6m3x05xy', 1, NULL, NULL, NULL, 0),
(127, 2, 'images/6.jpeg', 'Toni Haley', 'D3D1pWA8bs@gmail.com', NULL, '$2y$10$7EfO9WRApahLRsEuD3tis.H.W6Bw4YQRcldGyh8Bm6V/EYNGACBym', 1, NULL, NULL, NULL, 0),
(128, 2, 'images/6.jpeg', 'Prof. Willa Yost', 'B0q0pTJ4j6@gmail.com', NULL, '$2y$10$Gz7VQsXHQ71Emt81jFc/FOj4Kilyz1xKxfU.myBq1dZsm/Dimz/Va', 0, NULL, NULL, NULL, 0),
(129, 1, 'images/7.jpeg', 'Prof. Jammie Osinski I', 'yEqxBkeZsM@gmail.com', NULL, '$2y$10$BgJ5XXtmgLPAiNrZUIPvi.EyampXQ4nbs0husLra/dRUOcFjD7mBG', 1, NULL, NULL, NULL, 0),
(130, 3, 'images/7.jpeg', 'Mr. Brycen Pacocha', 'TrlDPpkAgW@gmail.com', NULL, '$2y$10$Q9pLnmkJrbdxqpW76bkY0OPY6FZWCLUIwMdversj.N/vPiVZ3hPlG', 1, NULL, NULL, NULL, 0),
(131, 3, 'images/5.jpeg', 'Annette Steuber', 'g0PsTFoE4m@gmail.com', NULL, '$2y$10$ugwLl0Vv01QGzCR0SC3PiuUimqmj3kfWBWltmEnUqTW42yrtHw/nS', 1, NULL, NULL, NULL, 0),
(132, 1, 'images/4.jpeg', 'Pasquale Kerluke II', '0xLwCuUH5s@gmail.com', NULL, '$2y$10$OmCIIGLaHNGuyfVA8NJhBe/7fZ/opIkHjuSodLOZx3d7kAlR7ZWFi', 1, NULL, NULL, NULL, 0),
(133, 3, 'images/7.jpeg', 'Judge Abernathy', 'IBuHttjQfK@gmail.com', NULL, '$2y$10$zgGftLg3I8YSGgEgrmzD2OGtGkkkXtxAwxqi9omFKSqlPTDd9.Xgm', 0, NULL, NULL, NULL, 0),
(134, 2, 'images/6.jpeg', 'Dr. Rowan Weber III', 'bZ3v1uwsC4@gmail.com', NULL, '$2y$10$SGKWE0ia170Zcefez6061u3xLUFS34Vf3k3OLW1b1WwiQWbT2qAAG', 1, NULL, NULL, NULL, 0),
(135, 2, 'images/6.jpeg', 'Kavon Ratke', 'EeF1N4OWGt@gmail.com', NULL, '$2y$10$91pAyPowT90cJEpOXY2bu.nEW3Od707qTF8zOZnb1bcoywJ105hE2', 1, NULL, NULL, NULL, 0),
(136, 2, 'images/6.jpeg', 'Dr. Polly Gottlieb', 'vphtFZIU93@gmail.com', NULL, '$2y$10$1vx/5t7sTurbVypG.LiXL.lcUtuvpIY/UVhViDFbsKq/ukacMlfWK', 1, NULL, NULL, NULL, 0),
(137, 1, 'images/4.jpeg', 'Greg Bartell', 'xiktTzabBg@gmail.com', NULL, '$2y$10$5q/Zy3cE5Hjtcqt4GgDmQu.esENv1g700.A7VF5GJlOehiTfBnKXm', 0, NULL, NULL, NULL, 0),
(138, 3, 'images/6.jpeg', 'Daniella Bruen', 'vp6qqRQCoQ@gmail.com', NULL, '$2y$10$Ywnmnekw3R3QW1WXpL/V2OOLJMb1v033qocT49NaZVGowmre4jL92', 0, NULL, NULL, NULL, 0),
(139, 1, 'images/10.jpeg', 'Vince Hodkiewicz', 'w6y1JNjLSt@gmail.com', NULL, '$2y$10$3OMVZKdgUHNxhu86hxXNvuwwisSb8jjeHAIL1HDGeYnHoIkSA00w.', 1, NULL, NULL, NULL, 0),
(140, 1, 'images/1.jpeg', 'Callie Reichel', 'QQfbEYjS7J@gmail.com', NULL, '$2y$10$3P9U/wrxEcdNbBEvcKKYsekGXE4rOULFzo/CceXNJSZADaZmQigvu', 1, NULL, NULL, NULL, 0),
(141, 3, 'images/5.jpeg', 'Prof. Stacy McLaughlin', '1YORrJrKw6@gmail.com', NULL, '$2y$10$ddAbIossDnSiSq0UV0sPQuT4Yt9U79dDgzS1otuvINpHHa0eUThxO', 0, NULL, NULL, NULL, 0),
(142, 2, 'images/3.jpeg', 'Keenan Jaskolski I', 'f0xcOguobX@gmail.com', NULL, '$2y$10$I5UNfslTmUvtpcV4sEOUM.A.4eANRmXPwuX3itkByoUNxzU3XsEX6', 0, NULL, NULL, NULL, 0),
(143, 1, 'images/1.jpeg', 'Aron Kozey Sr.', 'GcwqXKgO6q@gmail.com', NULL, '$2y$10$hEDYe6LRh8c9KyfibdSpfuVDKJ/F1DYrCVMuKZbBNKJJqpXECqNVe', 0, NULL, NULL, NULL, 0),
(144, 2, 'images/2.jpeg', 'Chelsey Franecki', 'wLOnGh93Sq@gmail.com', NULL, '$2y$10$MfXIRiOZd7uxDiNJOwTsee6N.2/xo0OcyLnE7EP20gVgRR/xMkAyi', 1, NULL, NULL, NULL, 0),
(145, 1, 'images/10.jpeg', 'Al Trantow', '6oX0KVxvYO@gmail.com', NULL, '$2y$10$tlFI6ja.mQUFcOYlJMB1t.WIXkA2AvVls5FTEolfmSHGF5CoyvGXu', 1, NULL, NULL, NULL, 0),
(146, 1, 'images/4.jpeg', 'Alan Zieme', 'YvVNqvdHIt@gmail.com', NULL, '$2y$10$CJKjfgTdi7d7Oe0PUZrABegOUipHHQRBeEZbrHqC7n0M.cwsUMz7C', 1, NULL, NULL, NULL, 0),
(147, 2, 'images/4.jpeg', 'Novella Cormier', 'BxR5n9tE6C@gmail.com', NULL, '$2y$10$73gX7r0mK1HxdDAqMQH81uTBiNeQx9rUB1Fd7A2V/oQDOFgiQCPdC', 1, NULL, NULL, NULL, 0),
(148, 3, 'images/8.jpeg', 'Prof. Kamille Hoppe MD', 'kqUCt497SG@gmail.com', NULL, '$2y$10$vJ8SSc8J8PIccyZF/fFcieRf5q23e0hlv/yLSBoa5t.rHZSCuPuYq', 1, NULL, NULL, NULL, 0),
(149, 3, 'images/2.jpeg', 'Ozella Feeney', 'fx3kxe5F0P@gmail.com', NULL, '$2y$10$q0iwMOwWQEDVlyaB4hzvae1Wg.TMxyP91EvHhILMTYZPJnVMsaI/2', 0, NULL, NULL, NULL, 0),
(150, 2, 'images/10.jpeg', 'Jonathan Bailey', 'lMwvL7D7P9@gmail.com', NULL, '$2y$10$6eRmdXKHl5AKi6hL0byY9.kqdsQeiFby9PbR4jEyccTrTdn1sTy1K', 0, NULL, NULL, NULL, 0),
(151, 1, 'images/CNmAxcuRofhcCnFtuongvy2.jpg', 'Hien Pham', 'hienhien2511997@gmail.com', NULL, '$2y$10$JI1iN6vwn2E2S3dwgoSRzeOBQFBtqKgHOqgQEbV1nwhP/PCwCafUq', 1, NULL, '2019-05-14 15:50:23', '2019-05-14 15:50:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_activations`
--

CREATE TABLE `user_activations` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `activation_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id` int(10) UNSIGNED NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `tblcheckin`
--
ALTER TABLE `tblcheckin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcheckout`
--
ALTER TABLE `tblcheckout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbldepartment`
--
ALTER TABLE `tbldepartment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbldetail`
--
ALTER TABLE `tbldetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblemail`
--
ALTER TABLE `tblemail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbllog`
--
ALTER TABLE `tbllog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbllogdetail`
--
ALTER TABLE `tbllogdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmonth`
--
ALTER TABLE `tblmonth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblposition`
--
ALTER TABLE `tblposition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstatistic`
--
ALTER TABLE `tblstatistic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltime`
--
ALTER TABLE `tbltime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltimelog`
--
ALTER TABLE `tbltimelog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_activations`
--
ALTER TABLE `user_activations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_activations_activation_code_index` (`activation_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblcheckin`
--
ALTER TABLE `tblcheckin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tblcheckout`
--
ALTER TABLE `tblcheckout`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbldepartment`
--
ALTER TABLE `tbldepartment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbldetail`
--
ALTER TABLE `tbldetail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblemail`
--
ALTER TABLE `tblemail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbllog`
--
ALTER TABLE `tbllog`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbllogdetail`
--
ALTER TABLE `tbllogdetail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblmonth`
--
ALTER TABLE `tblmonth`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblposition`
--
ALTER TABLE `tblposition`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tblstatistic`
--
ALTER TABLE `tblstatistic`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbltime`
--
ALTER TABLE `tbltime`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbltimelog`
--
ALTER TABLE `tbltimelog`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `user_activations`
--
ALTER TABLE `user_activations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
