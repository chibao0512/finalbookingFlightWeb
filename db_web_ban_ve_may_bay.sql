-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 08:39 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_web_ban_ve_may_bay`
--

-- --------------------------------------------------------

--
-- Table structure for table `airline_companies`
--

CREATE TABLE `airline_companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_home` tinyint(4) DEFAULT 0,
  `sort` tinyint(4) DEFAULT 0,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `airline_companies`
--

INSERT INTO `airline_companies` (`id`, `code_no`, `name`, `logo`, `show_home`, `sort`, `status`, `created_at`, `updated_at`) VALUES
(2, 'VIETJETAIR', 'Vietjet Air', '2024-03-03__f0b8ac835fda8195dbe9a85cd9c2bbc0.png', 1, 1, 0, '2024-03-03 03:02:01', '2024-03-03 03:02:01'),
(3, 'VNA', 'Vietnam Airlines', '2024-03-03__982387abe0d11d7130fea7758212b0b2.webp', 1, 2, 0, '2024-03-03 03:03:31', '2024-03-03 03:03:31'),
(4, 'BBAW', 'Bamboo Airways', '2024-03-03__d106e094d4e694c2fb90e31b437bb7b7.webp', 1, 3, 0, '2024-03-03 03:05:19', '2024-03-24 03:02:11');

-- --------------------------------------------------------

--
-- Table structure for table `airports`
--

CREATE TABLE `airports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `code_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `airports`
--

INSERT INTO `airports` (`id`, `location_id`, `code_no`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'HAN', 'Nội Bài', '2024-02-28 11:02:58', '2024-02-28 11:02:58'),
(2, 2, 'SGN', 'Tân Sơn Nhất', '2024-02-28 11:04:11', '2024-02-28 11:04:11'),
(3, 8, 'DAD', 'Đà Nẵng', '2024-02-28 11:04:57', '2024-02-28 11:04:57'),
(4, 3, 'HPH', 'Cát Bi', '2024-02-28 11:05:55', '2024-02-28 11:05:55');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `show_home` tinyint(4) NOT NULL DEFAULT 0,
  `view` int(11) NOT NULL DEFAULT 0,
  `description` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contents` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 2,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `name`, `slug`, `show_home`, `view`, `description`, `image`, `contents`, `category_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Du xuân với hàng loạt vé máy bay ưu đãi của Vietjet', 'du-xuan-voi-hang-loat-ve-may-bay-uu-dai-cua-vietjet', 0, 0, 'Đổi gió đi chơi Tết xa với những cảnh đẹp rực rỡ hoa xuân của nước mình không bạn ơi? Một Hà Nội cổ kính! Một Đà Nẵng sôi động! Một Phú Quốc thanh bình, đẹp hơn ngọc bích! Một Nha Trang trong vắt, xanh lam mơ mộng! Một Điện Biên với ngàn hoa đào, mai,…', '2024-03-21__60d2d5192066a39d4684654231225301.jpg', '<p>Đổi gi&oacute; đi chơi Tết xa với những cảnh đẹp rực rỡ hoa xu&acirc;n của nước m&igrave;nh kh&ocirc;ng bạn ơi? Một H&agrave; Nội cổ k&iacute;nh! Một Đ&agrave; Nẵng s&ocirc;i động! Một Ph&uacute; Quốc thanh b&igrave;nh, đẹp hơn ngọc b&iacute;ch! Một Nha Trang trong vắt, xanh lam mơ mộng! Một Điện Bi&ecirc;n với ng&agrave;n hoa đ&agrave;o, mai,&hellip;</p>', 1, 1, 1, '2024-03-21 09:06:19', '2024-03-23 04:59:58');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT 0,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `show_home` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `slug`, `status`, `show_home`, `created_at`, `updated_at`) VALUES
(1, 'Tin khuyến mại', 0, 'tin-khuyen-mai', 1, 1, '2024-03-21 08:37:47', '2024-03-21 16:36:48'),
(2, 'Kinh nghiệm bay', 0, 'kinh-nghiem-bay', 1, 1, '2024-03-21 08:52:14', '2024-03-21 16:36:41'),
(3, 'Tin tức', 0, 'tin-tuc', 1, 1, '2024-03-21 08:52:26', '2024-03-21 16:36:35');

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
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plane_id` bigint(20) UNSIGNED NOT NULL,
  `start_location_id` bigint(20) UNSIGNED NOT NULL,
  `start_airport_id` bigint(20) UNSIGNED NOT NULL,
  `end_location_id` bigint(20) UNSIGNED NOT NULL,
  `end_airport_id` bigint(20) UNSIGNED NOT NULL,
  `code_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_day` datetime DEFAULT NULL,
  `start_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_day` datetime DEFAULT NULL,
  `end_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` bigint(20) NOT NULL DEFAULT 0,
  `price_vip` bigint(20) DEFAULT 0,
  `taxes_fees` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) DEFAULT 1,
  `type` tinyint(4) DEFAULT 1,
  `tax_percentage` bigint(15) DEFAULT 0,
  `expense` bigint(15) DEFAULT 0,
  `baby_ticket` bigint(25) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`id`, `plane_id`, `start_location_id`, `start_airport_id`, `end_location_id`, `end_airport_id`, `code_no`, `start_day`, `start_time`, `end_day`, `end_time`, `price`, `price_vip`, `taxes_fees`, `status`, `type`, `tax_percentage`, `expense`, `baby_ticket`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 2, 2, 'DFKH', '2024-04-25 07:30:00', NULL, '2024-04-25 08:50:00', NULL, 1500000, NULL, 0, 1, 1, 0, 0, 0, '2024-03-03 10:38:13', '2024-04-21 16:32:50'),
(2, 2, 3, 4, 2, 2, 'QH2901', '2024-04-23 09:00:00', NULL, '2024-04-23 10:30:00', NULL, 1500000, 2000000, 0, 1, 1, 52, 250000, 150000, '2024-03-24 03:06:40', '2024-04-21 16:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `group_permission`
--

CREATE TABLE `group_permission` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_permission`
--

INSERT INTO `group_permission` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Quản lý địa điểm', NULL, '2024-04-21 17:56:07', '2024-04-21 17:56:34'),
(2, 'Quản lý sân bay', NULL, '2024-04-21 17:56:48', '2024-04-21 17:56:48'),
(3, 'Quản lý hãng máy bay', NULL, '2024-04-21 17:56:57', '2024-04-21 17:56:57'),
(4, 'Quản lý máy bay', NULL, '2024-04-21 17:57:06', '2024-04-21 17:57:06'),
(5, 'Quản lý chuyến bay', NULL, '2024-04-21 17:57:58', '2024-04-21 17:57:58'),
(6, 'Quản lý danh mục tin tức', NULL, '2024-04-21 17:58:13', '2024-04-21 17:58:13'),
(7, 'Quản lý tin tức', NULL, '2024-04-21 17:58:19', '2024-04-21 17:58:19'),
(8, 'Quản lý  đặt vé', NULL, '2024-04-21 17:58:38', '2024-04-21 18:37:11'),
(9, 'Quản lý vai trò', NULL, '2024-04-21 17:59:23', '2024-04-21 17:59:23'),
(10, 'Quản lý người dùng', NULL, '2024-04-21 17:59:30', '2024-04-21 17:59:30'),
(11, 'Quản lý hệ thống', NULL, '2024-04-21 17:59:37', '2024-04-21 17:59:37');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `code_no`, `name`, `created_at`, `updated_at`) VALUES
(1, 'HAN', 'Hà Nội', '2024-02-28 10:37:31', '2024-02-28 10:37:31'),
(2, 'SGN', 'TP Hồ Chí Minh', '2024-02-28 10:38:10', '2024-02-28 10:40:02'),
(3, 'HPH', 'Hải Phòng', '2024-02-28 10:38:48', '2024-02-28 10:38:48'),
(4, 'VCA', 'Cần Thơ', '2024-02-28 10:39:08', '2024-02-28 10:39:08'),
(5, 'DIN', 'Điện Biên', '2024-02-28 10:39:25', '2024-02-28 10:40:17'),
(6, 'VDO', 'Vân Đồn', '2024-02-28 10:39:42', '2024-02-28 10:39:42'),
(7, 'THD', 'Thanh Hóa', '2024-02-28 10:40:43', '2024-02-28 10:40:43'),
(8, 'DAD', 'Đà Nẵng', '2024-02-28 10:40:58', '2024-02-28 10:40:58'),
(9, 'UIH', 'Quy Nhơn', '2024-02-28 10:41:12', '2024-02-28 10:41:12'),
(10, 'CXR', 'Nha Trang', '2024-02-28 10:41:38', '2024-02-28 10:41:38'),
(11, 'PQC', 'Phú Quốc', '2024-02-28 10:41:52', '2024-02-28 10:41:52');

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
(5, '2023_04_13_172933_laravel_entrust_setup_tables', 1),
(6, '2024_02_27_172003_create_locations_table', 1),
(7, '2024_02_27_172005_create_airports_table', 1),
(8, '2024_02_27_172120_create_airline_companies_table', 1),
(9, '2024_02_27_172441_create_planes_table', 1),
(10, '2024_02_27_172527_create_flights_table', 2),
(11, '2024_03_21_151210_create_categories_table', 3),
(12, '2024_03_21_151555_create_articles_table', 3),
(13, '2024_04_01_231132_create_transports_table', 4),
(14, '2024_04_02_013405_create_transactions_table', 5),
(16, '2024_04_06_102858_create_payments_table', 5),
(17, '2024_04_06_100637_create_tickets_table', 6);

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `money` double(20,2) DEFAULT NULL COMMENT 'Số tiền thanh toán',
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nội dung thanh toán',
  `vnp_response_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Mã phản hồi',
  `code_vnpay` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Mã giao dịch vnpay',
  `code_bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Mã ngân hàng',
  `time` datetime DEFAULT NULL COMMENT 'Thời gian chuyển khoản',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `transaction_id`, `money`, `notes`, `vnp_response_code`, `code_vnpay`, `code_bank`, `time`, `created_at`, `updated_at`) VALUES
(1, 8, 1500000.00, 'THANH TOAN VE MAY BAY', '00', '14378500', 'NCB', '2024-04-15 01:46:00', NULL, NULL),
(2, 7, 2660000.00, 'THANH TOAN VE MAY BAY', '00', '14378506', 'NCB', '2024-04-15 01:53:00', NULL, NULL),
(3, 9, 3237600.00, 'THANH TOAN VE MAY BAY', '00', '14386803', 'NCB', '2024-04-21 23:39:00', NULL, NULL),
(4, 11, 1500000.00, 'THANH TOAN VE MAY BAY', '00', '14386844', 'NCB', '2024-04-22 00:07:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_permission_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `group_permission_id`, `created_at`, `updated_at`) VALUES
(1, 'danh-sach-dia-diem', 'Danh sách địa điểm', NULL, 1, '2024-04-21 18:00:04', '2024-04-21 18:00:04'),
(2, 'them-moi-dia-diem', 'Thêm mới địa điểm', NULL, 1, '2024-04-21 18:00:15', '2024-04-21 18:00:15'),
(3, 'chinh-sua-dia-diem', 'Chỉnh sửa địa điểm', NULL, 1, '2024-04-21 18:00:34', '2024-04-21 18:00:34'),
(4, 'xoa-dia-diem', 'Xóa địa điểm', NULL, 1, '2024-04-21 18:00:43', '2024-04-21 18:00:43'),
(5, 'danh-sach-san-bay', 'Danh sách sân bay', NULL, 2, '2024-04-21 18:01:11', '2024-04-21 18:01:11'),
(6, 'chinh-sua-san-bay', 'Chỉnh sửa sân bay', NULL, 2, '2024-04-21 18:01:21', '2024-04-21 18:01:21'),
(7, 'xoa-san-bay', 'Xóa sân bay', NULL, 2, '2024-04-21 18:01:34', '2024-04-21 18:01:34'),
(8, 'danh-sach-hang-may-bay', 'Danh sách hãng máy bay', NULL, 3, '2024-04-21 18:02:27', '2024-04-21 18:02:27'),
(9, 'them-moi-hang-may-bay', 'Thêm mới hãng máy bay', NULL, 3, '2024-04-21 18:03:08', '2024-04-21 18:03:08'),
(10, 'chinh-sua-hang-may-bay', 'Chỉnh sửa hãng máy bay', NULL, 3, '2024-04-21 18:03:21', '2024-04-21 18:03:21'),
(11, 'xoa-hang-may-bay', 'Xóa hãng máy bay', NULL, 3, '2024-04-21 18:03:30', '2024-04-21 18:03:30'),
(12, 'danh-sach-may-bay', 'Danh sách máy bay', NULL, 4, '2024-04-21 18:04:32', '2024-04-21 18:04:32'),
(13, 'them-moi-may-bay', 'Thêm mới máy bay', NULL, 4, '2024-04-21 18:04:45', '2024-04-21 18:04:45'),
(14, 'chinh-sua-may-bay', 'Chỉnh sửa máy bay', NULL, 4, '2024-04-21 18:04:58', '2024-04-21 18:04:58'),
(15, 'xoa-may-bay', 'Xóa máy bay', NULL, 4, '2024-04-21 18:05:21', '2024-04-21 18:05:21'),
(16, 'danh-sach-chuyen-bay', 'Danh sách chuyến bay', NULL, 5, '2024-04-21 18:07:03', '2024-04-21 18:07:03'),
(17, 'them-moi-chuyen-bay', 'Thêm mới chuyến bay', NULL, 5, '2024-04-21 18:08:32', '2024-04-21 18:08:32'),
(18, 'chinh-sua-chuyen-bay', 'Chỉnh sửa chuyến bay', NULL, 5, '2024-04-21 18:08:44', '2024-04-21 18:08:44'),
(19, 'xoa-chuyen-bay', 'Xóa chuyến bay', NULL, 5, '2024-04-21 18:09:30', '2024-04-21 18:09:30'),
(20, 'danh-sach-danh-muc-tin-tuc', 'Danh sách danh mục tin tức', NULL, 6, '2024-04-21 18:09:55', '2024-04-21 18:09:55'),
(21, 'them-moi-danh-muc-tin-tuc', 'Thêm mới danh mục tin tức', NULL, 6, '2024-04-21 18:10:19', '2024-04-21 18:10:19'),
(22, 'chinh-sua-danh-muc-tin-tuc', 'Chỉnh sửa danh mục tin tức', NULL, 6, '2024-04-21 18:10:31', '2024-04-21 18:10:31'),
(23, 'xoa-danh-muc-tin-tuc', 'Xóa danh mục tin tức', NULL, 6, '2024-04-21 18:10:42', '2024-04-21 18:10:42'),
(24, 'danh-sach-tin-tuc', 'Danh sách tin tức', NULL, 7, '2024-04-21 18:11:28', '2024-04-21 18:11:28'),
(25, 'them-moi-tin-tuc', 'Thêm mới tin tức', NULL, 7, '2024-04-21 18:11:40', '2024-04-21 18:11:40'),
(26, 'chinh-sua-tin-tuc', 'Chỉnh sửa tin tức', NULL, 7, '2024-04-21 18:11:51', '2024-04-21 18:11:51'),
(27, 'xoa-tin-tuc', 'Xóa tin tức', NULL, 7, '2024-04-21 18:11:59', '2024-04-21 18:11:59'),
(28, 'them-moi-san-bay', 'Thêm mới sân bay', NULL, 2, '2024-04-21 18:13:15', '2024-04-21 18:13:15'),
(29, 'danh-sach-dat-ve', 'Danh sách đặt vé', NULL, 8, '2024-04-21 18:13:43', '2024-04-21 18:13:43'),
(30, 'danh-sach-vai-tro', 'Danh sách vai trò', NULL, 9, '2024-04-21 18:14:08', '2024-04-21 18:14:08'),
(31, 'them-moi-vai-tro', 'Thêm mới vai trò', NULL, 9, '2024-04-21 18:14:17', '2024-04-21 18:14:17'),
(32, 'chinh-sua-vai-tro', 'Chỉnh sửa vai trò', NULL, 9, '2024-04-21 18:14:27', '2024-04-21 18:14:27'),
(33, 'xoa-vai-tro', 'Xóa vai trò', NULL, 9, '2024-04-21 18:14:37', '2024-04-21 18:14:37'),
(34, 'danh-sach-nguoi-dung', 'Danh sách người dùng', NULL, 10, '2024-04-21 18:14:46', '2024-04-21 18:14:46'),
(35, 'them-moi-nguoi-dung', 'Thêm mới người dùng', NULL, 10, '2024-04-21 18:15:26', '2024-04-21 18:15:26'),
(36, 'chinh-sua-nguoi-dung', 'Chỉnh sửa người dùng', NULL, 10, '2024-04-21 18:15:35', '2024-04-21 18:15:35'),
(37, 'xoa-nguoi-dung', 'Xóa người dùng', NULL, 10, '2024-04-21 18:15:44', '2024-04-21 18:15:44'),
(38, 'truy-cap-he-thong', 'Truy cập hệ thống', NULL, 11, '2024-04-21 18:15:53', '2024-04-21 18:15:53'),
(39, 'toan-quyen-quan-ly', 'Toàn quyền quản lý', NULL, 11, '2024-04-21 18:16:03', '2024-04-21 18:16:03'),
(40, 'xoa-dat-ve', 'Xóa đặt vé', NULL, 8, '2024-04-21 18:36:06', '2024-04-21 18:36:06');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(39, 1);

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
-- Table structure for table `planes`
--

CREATE TABLE `planes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `airline_company_id` bigint(20) UNSIGNED NOT NULL,
  `code_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_seats` int(11) NOT NULL DEFAULT 0,
  `number_seats_vip` int(11) NOT NULL DEFAULT 0,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `planes`
--

INSERT INTO `planes` (`id`, `airline_company_id`, `code_no`, `name`, `number_seats`, `number_seats_vip`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'VJ162', 'Airbus A330 (máy bay lớn)', 60, 30, NULL, 1, '2024-03-03 03:06:16', '2024-03-03 09:11:04'),
(2, 4, 'QH290', 'Airbus A321', 150, 20, NULL, 1, '2024-03-24 03:04:26', '2024-03-24 03:04:26');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'Administrator', 'Administrator', '2024-04-14 16:25:40', '2024-04-14 16:25:40'),
(2, 'nhan-vien', 'Nhân viên', 'Nhân viên', '2024-04-14 16:25:50', '2024-04-14 16:25:50'),
(3, 'nguoi-dung', 'Người dùng', NULL, '2024-04-21 18:38:25', '2024-04-21 18:38:25');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `transport_id` bigint(20) UNSIGNED DEFAULT NULL,
  `flight_id` bigint(20) UNSIGNED NOT NULL,
  `code_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seats` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `transport_price` bigint(20) DEFAULT NULL,
  `transport_weight` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `transaction_id`, `transport_id`, `flight_id`, `code_no`, `gender`, `type`, `name`, `card`, `seats`, `birthday`, `transport_price`, `transport_weight`, `status`, `created_at`, `updated_at`) VALUES
(3, 3, 1, 2, 'AOun32', 1, 'adult', 'Nguyễn Văn A', '034094001935', 'C1', '2024-01-18', 232000, NULL, 0, '2024-04-06 19:36:22', '2024-04-14 15:28:52'),
(4, 3, NULL, 2, 'LPAj7E', 2, 'adult', 'Nguyễn Văn B', '034094001936', 'D1', '2024-04-01', NULL, NULL, 0, '2024-04-06 19:36:22', '2024-04-14 15:28:52'),
(5, 4, NULL, 2, 'oWaBQW', 1, 'adult', 'Nguyễn Văn Dược', '034094001935', 'A1', '1994-07-11', NULL, NULL, 0, '2024-04-14 02:08:35', '2024-04-14 15:30:41'),
(6, 5, 2, 2, 'OZgOfT', 1, 'adult', 'Nguyễn Văn Dược', '034094001935', 'B1', '2024-04-16', 270000, NULL, 0, '2024-04-14 02:21:39', '2024-04-14 15:31:46'),
(7, 6, 1, 2, 'aAPfMV', 1, 'adult', 'Nguyen Van Duoc', '034094001935', NULL, '1994-07-11', 232000, NULL, 0, '2024-04-14 15:58:01', '2024-04-14 15:58:01'),
(8, 7, NULL, 2, '6ahQj5', 1, 'adult', 'Nguyễn Văn A', '034094001935', 'E1', '1994-07-11', NULL, NULL, 0, '2024-04-14 16:27:39', '2024-04-14 18:53:24'),
(9, 8, NULL, 1, '4SyrAV', 1, 'adult', 'Nguyễn Văn Dược', '034094001935', 'A1', '1994-07-11', NULL, NULL, 0, '2024-04-14 18:40:42', '2024-04-14 18:48:38'),
(10, 9, 4, 2, 'MkBkBA', 1, 'adult', 'Nguyen Van A', '034094001965', 'F1', '2023-10-11', 380000, NULL, 0, '2024-04-21 16:38:04', '2024-04-21 16:39:41'),
(11, 10, NULL, 2, 'xYg4zZ', 1, 'adult', 'Nguyễn Văn A', '034094001955', 'A2', '2024-04-04', NULL, NULL, 0, '2024-04-21 16:54:16', '2024-04-21 16:54:27'),
(12, 11, NULL, 1, '6BZVVy', 1, 'adult', 'Nguyễn Văn A', '03409455895', 'B1', '2024-04-03', NULL, NULL, 0, '2024-04-21 16:54:47', '2024-04-21 17:11:43');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flight_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `code_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adult` int(11) DEFAULT NULL,
  `children` int(11) DEFAULT NULL,
  `baby` int(11) DEFAULT NULL,
  `start_location_id` bigint(20) UNSIGNED NOT NULL,
  `end_location_id` bigint(20) UNSIGNED NOT NULL,
  `start_day` datetime DEFAULT NULL,
  `end_day` datetime DEFAULT NULL,
  `price` bigint(20) DEFAULT NULL,
  `baby_ticket` bigint(20) DEFAULT NULL,
  `expense` bigint(20) DEFAULT NULL COMMENT 'phụ phí',
  `tax_percentage` int(11) DEFAULT NULL COMMENT 'phần trăm tính thuế',
  `ticket_class` tinyint(4) NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `taxes_fees` bigint(20) NOT NULL DEFAULT 0,
  `total_money` bigint(20) NOT NULL DEFAULT 0,
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `flight_id`, `user_id`, `code_no`, `name`, `phone`, `email`, `adult`, `children`, `baby`, `start_location_id`, `end_location_id`, `start_day`, `end_day`, `price`, `baby_ticket`, `expense`, `tax_percentage`, `ticket_class`, `status`, `taxes_fees`, `total_money`, `payment_method`, `type`, `created_at`, `updated_at`) VALUES
(3, 2, NULL, '17124321828587', 'Nguyễn Văn A', '0359020898', 'duocnvoit@gmail.com', 2, 0, 0, 3, 2, '2024-04-07 09:00:00', '2024-04-07 10:30:00', 1500000, 150000, 250000, 52, 1, 3, 1810640, 5292640, 'payment', 1, NULL, '2024-04-21 15:26:14'),
(4, 2, NULL, '17130605156483', 'Nguyễn Văn Dược', '0359020898', 'duocnvoit@gmail.com', 1, 0, 0, 3, 2, '2024-04-18 09:00:00', '2024-04-19 10:30:00', 1500000, 150000, 250000, 52, 1, 2, 910000, 2660000, 'payment', 1, '2024-04-14 02:08:35', '2024-04-14 15:30:41'),
(5, 2, 2, '17130612992295', 'Nguyễn Văn Dược', '0928817228', 'duocnvoit@gmail.com', 1, 0, 0, 3, 2, '2024-04-18 09:00:00', '2024-04-19 10:30:00', 1500000, 150000, 250000, 52, 1, 2, 1050400, 3070400, 'payment', 1, '2024-04-14 02:21:39', '2024-04-14 15:31:46'),
(6, 2, 1, '17131102819049', 'Nguyễn Văn Dược', '0928817228', 'duocnvoit@gmail.com', 1, 0, 0, 3, 2, '2024-04-18 09:00:00', '2024-04-19 10:30:00', 1500000, 150000, 250000, 52, 1, 1, 1030640, 3012640, 'payment-online', 1, '2024-04-14 15:58:01', '2024-04-14 16:11:57'),
(7, 2, 2, '17131120596525', 'Nguyễn Văn Dược', '0928817228', 'duocnvoit@gmail.com', 1, 0, 0, 3, 2, '2024-04-18 09:00:00', '2024-04-19 10:30:00', 1500000, 150000, 250000, 52, 1, 1, 910000, 2660000, 'payment-online', 1, '2024-04-14 16:27:39', '2024-04-14 16:27:47'),
(8, 1, NULL, '17131200424777', 'Nguyễn Văn Dược', '0359020898', 'duocnvoit@gmail.com', 1, 0, 0, 1, 2, '2024-04-22 07:30:00', '2024-04-22 08:50:00', 1500000, 0, 0, 0, 1, 3, 0, 1500000, 'payment-online', 1, '2024-04-14 18:40:42', '2024-04-21 15:26:45'),
(9, 2, 3, '17137174841737', 'Nguyễn Văn A', '0359020898', 'nguyenvana@gmail.com', 1, 0, 0, 3, 2, '2024-04-23 09:00:00', '2024-04-23 10:30:00', 1500000, 150000, 250000, 52, 1, 3, 1107600, 3237600, 'payment-online', 1, '2024-04-21 16:38:04', '2024-04-21 16:41:14'),
(10, 2, 3, '17137184565438', 'Nguyễn Văn A', '0359020898', 'nguyenvana@gmail.com', 1, 0, 0, 3, 2, '2024-04-23 09:00:00', '2024-04-23 10:30:00', 1500000, 150000, 250000, 52, 1, 2, 910000, 2660000, 'payment', 1, '2024-04-21 16:54:16', '2024-04-21 16:54:27'),
(11, 1, 3, '17137184874258', 'Nguyễn Văn A', '0359020898', 'nguyenvana@gmail.com', 1, 0, 0, 1, 2, '2024-04-25 07:30:00', '2024-04-25 08:50:00', 1500000, 0, 0, 0, 1, 3, 0, 1500000, 'payment-online', 1, '2024-04-21 16:54:47', '2024-04-21 17:11:42');

-- --------------------------------------------------------

--
-- Table structure for table `transports`
--

CREATE TABLE `transports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `airline_company_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` bigint(20) NOT NULL,
  `weight` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transports`
--

INSERT INTO `transports` (`id`, `airline_company_id`, `title`, `price`, `weight`, `created_at`, `updated_at`) VALUES
(1, 4, 'Buy 15kg - 232,000 đ', 232000, 15, NULL, NULL),
(2, 4, 'Buy 20kg - 270,000 đ', 270000, 20, NULL, NULL),
(3, 4, 'Buy 25kg - 325,000 đ', 325000, 25, NULL, NULL),
(4, 4, 'Buy 30kg - 380,000 đ', 380000, 30, NULL, NULL),
(5, 4, 'Buy 35kg - 435,000 đ', 435000, 35, NULL, NULL),
(6, 4, 'Buy 40kg - 490,000 đ', 490000, 40, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `type` tinyint(4) DEFAULT 1,
  `status` tinyint(4) DEFAULT 1,
  `gender` tinyint(4) DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `avatar`, `address`, `birthday`, `type`, `status`, `gender`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '0928817228', NULL, '$2y$10$TUYvS7G1h5zFAGXIEOznG.ceqFsbEUVgTteENFGW.bv7/Byt93QvS', '', NULL, NULL, 0, 1, 1, '99GnvLFpHkBE6pJh8RCm7S2zTgCQpkTTILB8BYJV1eBhqNf1dFArAfUQpflT', '2024-02-28 09:49:59', '2024-02-28 09:49:59'),
(2, 'Nguyễn Văn Dược', 'duocnvoit@gmail.com', '0928817228', NULL, '$2y$10$R4jrzMFxQwHWGaRP4gnZ/OlY33PtW0VEQ8UvUGNomnE586ShKMxmS', NULL, 'Hà Nội', '1994-07-11', 2, 1, 1, 'R93dRXf5Kup8TgDxNU0tKNvdMHQlLhLjHHDVuFOyi8CpA5doNYbC157mpfUL', '2024-03-23 07:47:01', '2024-04-18 09:09:28'),
(3, 'Nguyễn Văn A', 'nguyenvana@gmail.com', '0359020898', NULL, '$2y$10$lBaVHj55H/yjRZH6PFtZ8eiRO6EXXVhJRohITjbnKNGxNnRWG89.2', NULL, 'Hà Nội', '2023-05-10', 2, 1, 1, '6GptoQDSV6peWSaF1UxrwcKtXTRvQVw1tGDyuZ07DJTcbd3EMfDPvDpZPL7e', '2024-04-21 16:35:43', '2024-04-21 16:35:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airline_companies`
--
ALTER TABLE `airline_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `airports`
--
ALTER TABLE `airports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `airports_location_id_foreign` (`location_id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_slug_index` (`slug`),
  ADD KEY `articles_show_home_index` (`show_home`),
  ADD KEY `articles_category_id_index` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_index` (`parent_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flights_plane_id_foreign` (`plane_id`),
  ADD KEY `flights_start_location_id_foreign` (`start_location_id`),
  ADD KEY `flights_start_airport_id_foreign` (`start_airport_id`),
  ADD KEY `flights_end_location_id_foreign` (`end_location_id`),
  ADD KEY `flights_end_airport_id_foreign` (`end_airport_id`);

--
-- Indexes for table `group_permission`
--
ALTER TABLE `group_permission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_permission_name_unique` (`name`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`),
  ADD KEY `permissions_group_permission_id_foreign` (`group_permission_id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planes_airline_company_id_foreign` (`airline_company_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tickets_code_no_unique` (`code_no`),
  ADD KEY `tickets_transaction_id_foreign` (`transaction_id`),
  ADD KEY `tickets_transport_id_foreign` (`transport_id`),
  ADD KEY `tickets_flight_id_foreign` (`flight_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_code_no_unique` (`code_no`),
  ADD KEY `transactions_flight_id_foreign` (`flight_id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_start_location_id_foreign` (`start_location_id`),
  ADD KEY `transactions_end_location_id_foreign` (`end_location_id`);

--
-- Indexes for table `transports`
--
ALTER TABLE `transports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transports_airline_company_id_foreign` (`airline_company_id`);

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
-- AUTO_INCREMENT for table `airline_companies`
--
ALTER TABLE `airline_companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `airports`
--
ALTER TABLE `airports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `group_permission`
--
ALTER TABLE `group_permission`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `planes`
--
ALTER TABLE `planes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transports`
--
ALTER TABLE `transports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `airports`
--
ALTER TABLE `airports`
  ADD CONSTRAINT `airports_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `flights_end_airport_id_foreign` FOREIGN KEY (`end_airport_id`) REFERENCES `airports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `flights_end_location_id_foreign` FOREIGN KEY (`end_location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `flights_plane_id_foreign` FOREIGN KEY (`plane_id`) REFERENCES `planes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `flights_start_airport_id_foreign` FOREIGN KEY (`start_airport_id`) REFERENCES `airports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `flights_start_location_id_foreign` FOREIGN KEY (`start_location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_group_permission_id_foreign` FOREIGN KEY (`group_permission_id`) REFERENCES `group_permission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `planes`
--
ALTER TABLE `planes`
  ADD CONSTRAINT `planes_airline_company_id_foreign` FOREIGN KEY (`airline_company_id`) REFERENCES `airline_companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_flight_id_foreign` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_transport_id_foreign` FOREIGN KEY (`transport_id`) REFERENCES `transports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_end_location_id_foreign` FOREIGN KEY (`end_location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_flight_id_foreign` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_start_location_id_foreign` FOREIGN KEY (`start_location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transports`
--
ALTER TABLE `transports`
  ADD CONSTRAINT `transports_airline_company_id_foreign` FOREIGN KEY (`airline_company_id`) REFERENCES `airline_companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
