-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th12 23, 2024 lúc 11:26 AM
-- Phiên bản máy phục vụ: 8.0.30
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `draft_datn`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'concentration', NULL, NULL),
(2, 'style', NULL, NULL),
(3, 'frag_group', NULL, NULL),
(4, 'frag_time', NULL, NULL),
(5, 'frag_distance', NULL, NULL),
(6, 'country', NULL, NULL),
(7, 'brand', NULL, NULL),
(8, 'age_group', NULL, NULL),
(9, 'ingredient', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` bigint UNSIGNED NOT NULL,
  `attribute_id` bigint UNSIGNED NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 'Eau de Parfum', NULL, NULL),
(2, 1, 'Eau De Toilette (EDT)', NULL, NULL),
(3, 1, 'Parfum', NULL, NULL),
(6, 1, 'Cologne', NULL, NULL),
(7, 2, 'Mạnh mẽ, nam tính, sang trọng', NULL, NULL),
(8, 2, 'Nam tính, tươi mát', NULL, NULL),
(9, 2, 'Sang trọng, quyến rũ, ngọt ngào', NULL, NULL),
(10, 2, 'Nữ tính, tươi tắn, gợi cảm', NULL, NULL),
(11, 2, 'Mạnh mẽ, trẻ trung, hiện đại', NULL, NULL),
(12, 3, 'Floral Fruity - Hương hoa cỏ trái cây', NULL, NULL),
(13, 3, 'Floral Woody Musk - Hương hoa cỏ, gỗ xạ hương', NULL, NULL),
(14, 3, 'Oriental Floral - Hương hoa cỏ phương Đông', NULL, NULL),
(15, 3, 'Oriental Fougere - Hương dương xỉ phương Đông', NULL, NULL),
(16, 4, '3 - 6h', NULL, NULL),
(17, 4, '6 - 8h', NULL, NULL),
(18, 4, 'Trên 12h', NULL, NULL),
(19, 4, '4 - 6h', NULL, NULL),
(20, 5, '1 cánh tay', NULL, NULL),
(21, 5, 'Thoang thoảng trên da', NULL, NULL),
(22, 5, 'Trên 2m', NULL, NULL),
(23, 5, '1m', NULL, NULL),
(24, 6, 'Nhật bản', NULL, NULL),
(25, 6, 'Ý', NULL, NULL),
(26, 6, 'Pháp', NULL, NULL),
(27, 6, 'Hàn Quốc', NULL, NULL),
(28, 7, 'Dior', NULL, NULL),
(29, 7, 'Versace', NULL, NULL),
(30, 7, 'Armaf', NULL, NULL),
(31, 7, 'Lacoste', NULL, NULL),
(32, 8, '16+', NULL, NULL),
(33, 8, '25+', NULL, NULL),
(34, 8, '40+', NULL, NULL),
(35, 8, '60+', NULL, NULL),
(36, 9, 'None', NULL, NULL),
(37, 2, 'Hiện đại, thanh lịch, nam tính', '2024-11-05 20:36:11', '2024-11-05 20:36:11'),
(38, 7, 'Yves Saint Laurent', '2024-11-05 20:38:46', '2024-11-05 20:38:46'),
(39, 2, 'Nam tính, ấm áp', '2024-11-09 09:00:05', '2024-11-09 09:00:05'),
(40, 3, 'Aromatic Fougere - Hương thơm thảo mộc', '2024-11-09 09:01:51', '2024-11-09 09:01:51'),
(41, 3, 'Woody Spicy - Hương gỗ thơm cay nồng', '2024-11-09 09:44:59', '2024-11-09 09:44:59'),
(43, 6, 'Ả Rập', '2024-11-15 08:36:38', '2024-11-15 08:36:38'),
(44, 7, 'Giorgio Armani', '2024-11-15 20:48:31', '2024-11-15 20:48:31'),
(45, 3, 'Aromatic Aquatic - Hương thơm biển', '2024-11-15 20:49:49', '2024-11-15 20:49:49'),
(46, 7, 'Chanel', '2024-11-18 06:58:50', '2024-11-18 06:58:50'),
(47, 3, 'Woody Aromatic - Hương gỗ thơm và thảo mộc', '2024-11-18 07:02:18', '2024-11-18 07:02:18'),
(48, 7, 'Gucci', '2024-11-18 07:05:59', '2024-11-18 07:05:59'),
(49, 2, 'Nữ tính, tươi mát, lãng mạn', '2024-11-18 07:06:59', '2024-11-18 07:06:59'),
(50, 7, 'Calvin Klein', '2024-12-09 03:46:50', '2024-12-09 03:46:50'),
(51, 2, 'Cổ điển, thanh lịch', '2024-12-09 03:48:16', '2024-12-09 03:48:16'),
(52, 6, 'Mỹ', '2024-12-09 03:49:30', '2024-12-09 03:49:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Nước Hoa Nam', 'Nước hoa nam cao cấp chính hãng', 'nuoc-hoa-nam', 1, '2024-10-17 23:06:01', '2024-12-07 05:54:15'),
(2, 'Nước Hoa Nữ', 'Nước hoa nữ cao cấp chính hãng', 'nuoc-hoa-nu', 1, '2024-10-18 22:58:45', '2024-10-18 22:58:45'),
(3, 'Nước hoa Mini', 'Nước hoa Mini', 'nuoc-hoa-mini', 1, '2024-11-15 08:33:05', '2024-11-15 08:33:05'),
(4, 'Nước hoa chính hãng', 'Nước hoa chính hãng', 'nuoc-hoa-chinh-hang', 1, '2024-12-09 03:45:41', '2024-12-09 03:45:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `commentable_id` int NOT NULL,
  `commentable_type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `parent_id` int DEFAULT NULL,
  `content` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `rating` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `commentable_id`, `commentable_type`, `user_id`, `parent_id`, `content`, `rating`, `created_at`, `updated_at`) VALUES
(17, 31, 'product', 1, NULL, 'Quá tuyệt vời !', 5, '2024-11-10 10:22:47', '2024-11-10 10:22:47'),
(18, 31, 'product', 5, NULL, 'Đã mua 2 lần rất ưng ý', 5, '2024-11-10 10:24:05', '2024-11-10 10:24:05'),
(19, 31, 'product', 5, NULL, 'Đã mua lần thứ 3 rất ưng', 5, '2024-11-10 10:26:13', '2024-11-10 10:26:13'),
(20, 30, 'product', 5, NULL, 'Shop tư vấn nhiệt tình, sản phẩm chất lượng', 5, '2024-11-10 10:26:56', '2024-11-10 10:26:56'),
(21, 41, 'product', 1, NULL, 'Tuyệt vời quá đi thôi', 5, '2024-11-15 08:26:06', '2024-11-15 08:26:06'),
(22, 45, 'product', 7, NULL, 'Sản phẩm khá ok nhưng giao hàng quá lâu', 4, '2024-11-15 20:54:54', '2024-11-15 20:54:54'),
(23, 44, 'product', 1, NULL, 'sản phẩm tốt tư vấn nhiệt tình', 5, '2024-11-16 11:19:58', '2024-11-16 11:19:58'),
(24, 44, 'product', 8, NULL, 'Đã mua 5 lần tuyệt vời', 5, '2024-11-16 21:09:51', '2024-11-16 21:09:51'),
(25, 30, 'product', 12, NULL, 'hài lòng', 5, '2024-11-25 07:00:44', '2024-11-25 07:00:44'),
(26, 41, 'product', 12, NULL, 'hỗ trợ nhiệt tình', 5, '2024-11-25 07:01:42', '2024-11-25 07:01:42'),
(27, 42, 'product', 12, NULL, 'sản phẩm tốt', 4, '2024-11-25 07:02:18', '2024-11-25 07:02:18'),
(28, 43, 'product', 12, NULL, 'đã mua 2 lọ tặng bạn gái', 5, '2024-11-25 07:02:48', '2024-11-25 07:02:48'),
(29, 50, 'product', 12, NULL, 'sản phẩm chất lượng, shop tư vấn nhiệt tình', 5, '2024-11-25 08:25:11', '2024-11-25 08:25:11'),
(30, 50, 'product', 11, NULL, 'chất lượng ổn', 4, '2024-11-25 08:49:08', '2024-11-25 08:49:08'),
(35, 10, 'post', 1, NULL, 'bài viết ý nghĩa', NULL, '2024-12-05 03:15:08', '2024-12-05 03:15:08'),
(36, 42, 'product', 1, NULL, 'quá tuyệt vời', 5, '2024-12-05 03:18:45', '2024-12-05 03:18:45'),
(37, 43, 'product', 14, NULL, 'quá tuyệt vời', 5, '2024-12-09 05:03:04', '2024-12-09 05:03:04'),
(38, 49, 'product', 9, NULL, 'sản phẩm tốt', 5, '2024-12-09 18:26:51', '2024-12-09 18:26:51'),
(39, 43, 'product', 1, NULL, 'Sản phẩm ổn trong mức giá', 5, '2024-12-16 19:32:10', '2024-12-16 19:32:10'),
(40, 10, 'post', 16, NULL, 'quá hay', NULL, '2024-12-22 06:34:30', '2024-12-22 06:34:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
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
-- Cấu trúc bảng cho bảng `inventory_changes`
--

CREATE TABLE `inventory_changes` (
  `id` int NOT NULL,
  `value` int DEFAULT NULL,
  `entry_date` datetime DEFAULT NULL,
  `type` varchar(10) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `admin_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `inventory_changes`
--

INSERT INTO `inventory_changes` (`id`, `value`, `entry_date`, `type`, `note`, `admin_id`, `created_at`, `updated_at`) VALUES
(51, 148000000, NULL, 'IN', NULL, 1, '2024-11-15 15:57:31', '2024-11-15 15:57:31'),
(52, 151000000, NULL, 'IN', NULL, 1, '2024-11-16 03:59:56', '2024-11-16 03:59:56'),
(53, 15500000, NULL, 'IN', NULL, 1, '2024-11-18 14:20:57', '2024-11-18 14:20:57'),
(54, 434700000, NULL, 'IN', NULL, 1, '2024-11-18 14:29:06', '2024-11-18 14:29:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_10_01_204637_create_roles_table', 2),
(6, '2024_10_01_204731_create_permissions_table', 2),
(7, '2024_10_01_204748_create_role_user_table', 2),
(8, '2024_10_01_204808_create_permission_role_table', 2),
(9, '2024_10_18_034832_create_product_related_tables', 3),
(10, '2024_10_18_035508_create_order_related_tables', 4),
(11, '2024_10_18_064637_create_attributes_and_related_tables', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `pre_value` int NOT NULL,
  `discount` int NOT NULL DEFAULT '0',
  `value` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `order_date` datetime NOT NULL,
  `payment_status` int NOT NULL,
  `status` int NOT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_company_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_cost` int DEFAULT NULL,
  `log` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `pre_value`, `discount`, `value`, `name`, `phone`, `address`, `description`, `order_date`, `payment_status`, `status`, `payment_method`, `delivery_company_code`, `shipping_code`, `shipping_cost`, `log`, `created_at`, `updated_at`) VALUES
(79, 1, 8900000, 0, 8900000, 'Quyền Admin', '0987654321', '{\"province\":\"201\",\"district\":\"1490\",\"ward\":\"1A0814\",\"address\":\"35\\/ Ph\\u01b0\\u1eddng Y\\u00ean S\\u1edf\\/ Qu\\u1eadn Ho\\u00e0ng Mai\\/ H\\u00e0 N\\u1ed9i\"}', '', '2024-11-14 16:04:41', 0, 7, 'Cash', 'GHN', 'LDHD9T', 42350, '[\"2024-11-15 16:04:41 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-11-15 16:05:39 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-11-16 05:18:53 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-11-16 05:38:13 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-11-16 05:38:41 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-11-16 06:00:34 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-11-16 06:07:54 - \\u0110ang giao h\\u00e0ng\",\"2024-11-16 06:08:06 - Ho\\u00e0n tr\\u1ea3\"]', '2024-11-15 09:04:41', '2024-11-15 23:08:06'),
(80, 5, 7440000, 0, 7440000, 'Lê Hoàng', '0976092858', '{\"province\":\"201\",\"district\":\"1488\",\"ward\":\"1A0320\",\"address\":\"226\\/ Ph\\u01b0\\u1eddng V\\u0129nh Tuy\\/ Qu\\u1eadn Hai B\\u00e0 Tr\\u01b0ng\\/ H\\u00e0 N\\u1ed9i\"}', '', '2024-11-15 16:14:15', 1, 5, 'Cash', 'GHN', 'LDHD9H', 42350, '[\"2024-11-15 16:14:15 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-11-15 16:14:24 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-11-16 05:21:44 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-11-16 06:00:42 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-11-16 06:23:31 - \\u0110ang giao h\\u00e0ng\",\"2024-12-09 00:54:51 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-12-09 11:24:03 - \\u0110ang giao h\\u00e0ng\",\"2024-12-09 11:26:18 - \\u0110\\u00e3 giao h\\u00e0ng\"]', '2024-11-15 09:14:15', '2024-12-09 04:26:18'),
(81, 5, 2680000, 0, 2680000, 'Lê Hoàng', '0987654321', '{\"province\":\"201\",\"district\":\"1488\",\"ward\":\"1A0320\",\"address\":\"226\\/ Ph\\u01b0\\u1eddng V\\u0129nh Tuy\\/ Qu\\u1eadn Hai B\\u00e0 Tr\\u01b0ng\\/ H\\u00e0 N\\u1ed9i\"}', '', '2024-10-10 16:15:23', 1, 5, 'Cash', 'GHN', 'LDHD9A', 42350, '[\"2024-11-15 16:15:23 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-11-15 16:15:56 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-11-16 05:27:00 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-11-16 06:00:49 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-11-16 06:23:35 - \\u0110ang giao h\\u00e0ng\",\"2024-12-09 00:54:56 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-12-09 11:24:08 - \\u0110ang giao h\\u00e0ng\",\"2024-12-09 11:26:23 - \\u0110\\u00e3 giao h\\u00e0ng\"]', '2024-11-15 09:15:23', '2024-12-09 04:26:23'),
(82, 7, 2060000, 0, 2060000, 'Trần Hoàn', '0978090858', '{\"province\":\"268\",\"district\":\"1826\",\"ward\":\"220424\",\"address\":\"Th\\u00f4n 4\\/ X\\u00e3 T\\u1ee9 D\\u00e2n\\/ Huy\\u1ec7n Kho\\u00e1i Ch\\u00e2u\\/ H\\u01b0ng Y\\u00ean\"}', 'Không giao vào thứ 6', '2024-11-16 03:37:33', 1, 5, 'Online', 'GHN', 'LDHD9X', 47850, '[\"2024-11-16 03:37:33 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-11-16 03:38:20 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-11-16 05:26:42 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-11-16 06:00:56 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-11-16 06:23:39 - \\u0110ang giao h\\u00e0ng\",\"2024-12-09 00:55:01 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-12-09 11:24:13 - \\u0110ang giao h\\u00e0ng\",\"2024-12-09 11:26:28 - \\u0110\\u00e3 giao h\\u00e0ng\"]', '2024-11-15 20:37:33', '2024-12-09 04:26:28'),
(83, 7, 13300000, 0, 13300000, 'Trần Hoàn', '0818678698', '{\"province\":\"268\",\"district\":\"1826\",\"ward\":\"220423\",\"address\":\"Th\\u00f4n 5\\/ X\\u00e3 Thu\\u1ea7n H\\u01b0ng\\/ Huy\\u1ec7n Kho\\u00e1i Ch\\u00e2u\\/ H\\u01b0ng Y\\u00ean\"}', 'Hỏi thăm nhà chú Bảy', '2024-09-18 03:41:46', 1, 5, 'Online', 'GHN', 'LDHD98', 47850, '[\"2024-11-16 03:41:46 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-11-16 03:42:15 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-11-16 05:27:16 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-11-16 06:01:04 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-11-16 06:23:42 - \\u0110ang giao h\\u00e0ng\",\"2024-12-09 00:55:06 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-12-09 11:24:18 - \\u0110ang giao h\\u00e0ng\",\"2024-12-09 11:26:33 - \\u0110\\u00e3 giao h\\u00e0ng\"]', '2024-11-15 20:41:46', '2024-12-09 04:26:33'),
(84, 7, 11300000, 0, 11300000, 'Trần Hoàn', '0362085442', '{\"province\":\"201\",\"district\":\"1490\",\"ward\":\"1A0813\",\"address\":\"188\\/ Ph\\u01b0\\u1eddng V\\u0129nh H\\u01b0ng\\/ Qu\\u1eadn Ho\\u00e0ng Mai\\/ H\\u00e0 N\\u1ed9i\"}', 'Không giao giờ hành chính', '2024-08-22 04:02:52', 1, 5, 'Cash', 'GHN', 'LDHD9Y', 42350, '[\"2024-11-16 04:02:52 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-11-16 04:03:02 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-11-16 05:27:28 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-11-16 06:01:15 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-11-16 06:23:46 - \\u0110ang giao h\\u00e0ng\",\"2024-12-09 00:55:11 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-12-09 11:24:23 - \\u0110ang giao h\\u00e0ng\",\"2024-12-09 11:26:38 - \\u0110\\u00e3 giao h\\u00e0ng\"]', '2024-11-15 21:02:52', '2024-12-09 04:26:38'),
(85, 8, 3410000, 0, 3410000, 'Nguyễn Huy', '0987654321', '{\"province\":\"235\",\"district\":\"3233\",\"ward\":\"800091\",\"address\":\"Th\\u00f4n 8\\/ X\\u00e3 Trung Ph\\u00fac C\\u01b0\\u1eddng\\/ Huy\\u1ec7n Nam \\u0110\\u00e0n\\/ Ngh\\u1ec7 An\"}', '', '2024-07-18 04:06:45', 1, 5, 'Cash', 'GHN', 'LDHD6F', 47850, '[\"2024-11-16 04:06:45 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-11-16 04:07:12 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-11-16 05:27:41 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-11-16 05:28:25 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-11-16 05:28:43 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-11-16 05:32:12 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-11-16 05:32:21 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-11-16 05:33:19 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-11-16 05:55:31 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-11-16 05:55:45 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-11-16 05:56:36 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-11-16 06:01:19 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-11-16 06:23:49 - \\u0110ang giao h\\u00e0ng\",\"2024-12-09 00:55:16 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-12-09 11:24:29 - \\u0110ang giao h\\u00e0ng\",\"2024-12-09 11:26:43 - \\u0110\\u00e3 giao h\\u00e0ng\"]', '2024-11-15 21:06:45', '2024-12-09 04:26:43'),
(86, 8, 13300000, 0, 13300000, 'Nguyễn Huy', '0987654321', '{\"province\":\"235\",\"district\":\"3233\",\"ward\":\"800091\",\"address\":\"Th\\u00f4n 8\\/ X\\u00e3 Trung Ph\\u00fac C\\u01b0\\u1eddng\\/ Huy\\u1ec7n Nam \\u0110\\u00e0n\\/ Ngh\\u1ec7 An\"}', '', '2024-06-18 04:07:06', 1, 5, 'Cash', 'GHN', 'LDHD67', 47850, '[\"2024-11-16 04:07:06 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-11-16 04:07:14 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-11-16 05:57:12 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-11-16 06:01:24 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-11-16 06:23:53 - \\u0110ang giao h\\u00e0ng\",\"2024-12-09 00:55:21 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-12-09 01:06:34 - \\u0110ang giao h\\u00e0ng\",\"2024-12-09 11:32:36 - \\u0110\\u00e3 giao h\\u00e0ng\"]', '2024-11-15 21:07:06', '2024-12-09 04:32:36'),
(87, 8, 23800000, 0, 23800000, 'Nguyễn Huy', '0987654321', '{\"province\":\"235\",\"district\":\"3233\",\"ward\":\"800091\",\"address\":\"Th\\u00f4n 8\\/ X\\u00e3 Trung Ph\\u00fac C\\u01b0\\u1eddng\\/ Huy\\u1ec7n Nam \\u0110\\u00e0n\\/ Ngh\\u1ec7 An\"}', '', '2024-02-08 04:09:35', 1, 5, 'Cash', 'GHN', 'LDHD6G', 47850, '[\"2024-11-16 04:09:35 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-11-16 04:10:20 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-11-16 05:58:32 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-11-16 06:01:27 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-11-16 06:23:56 - \\u0110ang giao h\\u00e0ng\",\"2024-12-09 00:55:26 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-12-09 01:05:39 - \\u0110ang giao h\\u00e0ng\",\"2024-12-09 11:32:41 - \\u0110\\u00e3 giao h\\u00e0ng\"]', '2024-11-15 21:09:35', '2024-12-09 04:32:41'),
(88, 8, 11900000, 0, 11900000, 'Nguyễn Huy', '0987654321', '{\"province\":\"235\",\"district\":\"3233\",\"ward\":\"800091\",\"address\":\"Th\\u00f4n 8\\/ X\\u00e3 Trung Ph\\u00fac C\\u01b0\\u1eddng\\/ Huy\\u1ec7n Nam \\u0110\\u00e0n\\/ Ngh\\u1ec7 An\"}', '', '2024-03-16 04:11:49', 1, 5, 'Cash', 'GHN', 'LDHD6U', 47850, '[\"2024-11-16 04:11:49 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-11-16 04:12:53 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-11-16 05:58:58 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-11-16 06:01:30 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-11-16 06:23:59 - \\u0110ang giao h\\u00e0ng\",\"2024-12-09 00:55:31 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-12-15 08:50:39 - \\u0110ang giao h\\u00e0ng\",\"2024-12-15 08:51:50 - \\u0110\\u00e3 giao h\\u00e0ng\"]', '2024-11-15 21:11:49', '2024-12-15 01:51:50'),
(89, 8, 8040000, 0, 8040000, 'Nguyễn Huy', '0987654321', '{\"province\":\"235\",\"district\":\"3233\",\"ward\":\"800091\",\"address\":\"Th\\u00f4n 8\\/ X\\u00e3 Trung Ph\\u00fac C\\u01b0\\u1eddng\\/ Huy\\u1ec7n Nam \\u0110\\u00e0n\\/ Ngh\\u1ec7 An\"}', '', '2024-04-10 04:12:14', 0, 7, 'Cash', 'VNPOST', 'VNP89', 40000, '[\"2024-11-16 04:12:14 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-11-16 04:12:59 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-11-16 05:59:37 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-11-16 06:01:34 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-11-16 06:06:38 - \\u0110ang giao h\\u00e0ng\",\"2024-11-16 06:06:51 - Ho\\u00e0n tr\\u1ea3\"]', '2024-11-15 21:12:14', '2024-11-15 23:06:51'),
(90, 8, 9920000, 0, 9920000, 'Nguyễn Huy', '0987654321', '{\"province\":\"235\",\"district\":\"3233\",\"ward\":\"800091\",\"address\":\"Th\\u00f4n 8\\/ X\\u00e3 Trung Ph\\u00fac C\\u01b0\\u1eddng\\/ Huy\\u1ec7n Nam \\u0110\\u00e0n\\/ Ngh\\u1ec7 An\"}', '', '2024-05-10 04:12:44', 1, 5, 'Cash', 'VNPOST', 'VNP90', 40000, '[\"2024-11-16 04:12:44 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-11-16 04:13:04 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-11-16 05:59:59 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-11-16 06:01:37 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-11-16 06:06:26 - \\u0110ang giao h\\u00e0ng\",\"2024-12-07 03:33:51 - \\u0110\\u00e3 giao h\\u00e0ng\"]', '2024-11-15 21:12:44', '2024-12-06 20:33:51'),
(91, 8, 280000, 0, 280000, 'Nguyễn Huy', '0987654321', '{\"province\":\"235\",\"district\":\"3233\",\"ward\":\"800091\",\"address\":\"Th\\u00f4n 8\\/ X\\u00e3 Trung Ph\\u00fac C\\u01b0\\u1eddng\\/ Huy\\u1ec7n Nam \\u0110\\u00e0n\\/ Ngh\\u1ec7 An\"}', '', '2024-11-16 04:19:16', 1, 5, 'Online', 'GHN', 'LDHD9M', 47850, '[\"2024-11-16 04:19:16 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-11-16 05:43:37 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-11-16 05:44:40 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-11-16 06:01:45 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-11-16 06:24:03 - \\u0110ang giao h\\u00e0ng\",\"2024-12-07 03:34:01 - \\u0110\\u00e3 giao h\\u00e0ng\"]', '2024-11-15 21:19:16', '2024-12-06 20:34:01'),
(92, 1, 2680000, 0, 2680000, 'Quyền Admin', '0987654321', '{\"province\":\"201\",\"district\":\"1490\",\"ward\":\"1A0814\",\"address\":\"35\\/ Ph\\u01b0\\u1eddng Y\\u00ean S\\u1edf\\/ Qu\\u1eadn Ho\\u00e0ng Mai\\/ H\\u00e0 N\\u1ed9i\"}', '', '2024-10-10 05:42:12', 1, 5, 'Cash', 'GHN', 'LDHD9R', 42350, '[\"2024-11-16 05:42:12 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-11-16 05:42:27 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-11-16 05:42:52 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-11-16 06:01:50 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-11-16 06:24:07 - \\u0110ang giao h\\u00e0ng\",\"2024-12-09 00:55:36 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-12-09 11:24:39 - \\u0110ang giao h\\u00e0ng\",\"2024-12-09 11:26:53 - \\u0110\\u00e3 giao h\\u00e0ng\"]', '2024-11-15 22:42:12', '2024-12-09 04:26:53'),
(93, 3, 1780000, 0, 1780000, 'Lê Anh Khoa', '0818666222', '{\"province\":\"268\",\"district\":\"2194\",\"ward\":\"220710\",\"address\":\"Th\\u00f4n 4\\/ X\\u00e3 Quang H\\u01b0ng\\/ Huy\\u1ec7n Ph\\u00f9 C\\u1eeb\\/ H\\u01b0ng Y\\u00ean\"}', 'Không giao thứ 6', '2024-11-17 06:31:23', 1, 5, 'Cash', 'GHN', 'LDYRK4', 47850, '[\"2024-11-17 06:31:23 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-11-18 14:31:44 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-12-07 07:30:38 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-12-08 20:23:34 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-12-09 00:48:10 - \\u0110ang giao h\\u00e0ng\",\"2024-12-09 11:32:46 - \\u0110\\u00e3 giao h\\u00e0ng\"]', '2024-11-16 23:31:23', '2024-12-09 04:32:46'),
(94, 10, 2680000, 0, 2680000, 'Quang Bình', '0975892462', '{\"province\":\"268\",\"district\":\"2046\",\"ward\":\"220909\",\"address\":\"Th\\u00f4n 8\\/ X\\u00e3 T\\u00e2n Quang\\/ Huy\\u1ec7n V\\u0103n L\\u00e2m\\/ H\\u01b0ng Y\\u00ean\"}', '', '2024-04-10 06:19:22', 1, 5, 'Cash', 'GHN', 'LDYRKW', 47850, '[\"2024-11-18 06:19:22 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-11-18 14:31:50 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-12-07 07:33:13 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-12-08 20:23:45 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-12-15 08:50:44 - \\u0110ang giao h\\u00e0ng\",\"2024-12-15 08:51:54 - \\u0110\\u00e3 giao h\\u00e0ng\"]', '2024-11-17 23:19:22', '2024-12-15 01:51:54'),
(95, 10, 280000, 0, 280000, 'Quang Bình', '0976091587', '{\"province\":\"268\",\"district\":\"2046\",\"ward\":\"220909\",\"address\":\"16\\/ X\\u00e3 T\\u00e2n Quang\\/ Huy\\u1ec7n V\\u0103n L\\u00e2m\\/ H\\u01b0ng Y\\u00ean\"}', '', '2024-11-18 06:27:49', 1, 6, 'Online', 'GHN', 'LDHAWU', 47850, '[\"2024-11-18 06:27:49 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-11-18 14:30:34 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-11-18 14:30:49 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-12-07 07:00:32 - \\u0110\\u00e3 h\\u1ee7y\",\"2024-12-07 07:03:20 - \\u0110\\u00e3 h\\u1ee7y\",\"2024-12-07 07:06:36 - \\u0110\\u00e3 h\\u1ee7y\",\"2024-12-07 07:09:18 - \\u0110\\u00e3 h\\u1ee7y\",\"2024-12-07 07:11:01 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-12-07 07:11:26 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-12-07 07:11:43 - \\u0110\\u00e3 h\\u1ee7y\"]', '2024-11-17 23:27:49', '2024-12-07 00:11:43'),
(96, 11, 23900000, 0, 23900000, 'Nguyễn Hoàn', '0976708225', '{\"province\":\"201\",\"district\":\"1486\",\"ward\":\"1A0421\",\"address\":\"22\\/ Ph\\u01b0\\u1eddng V\\u0103n Mi\\u1ebfu\\/ Qu\\u1eadn \\u0110\\u1ed1ng \\u0110a\\/ H\\u00e0 N\\u1ed9i\"}', '', '2024-11-18 14:40:39', 1, 5, 'Online', 'GHN', 'LDYMWW', 42350, '[\"2024-11-18 14:40:39 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-11-18 14:42:36 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-12-08 20:28:38 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-12-08 20:29:08 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-12-09 01:04:59 - \\u0110ang giao h\\u00e0ng\",\"2024-12-09 11:32:26 - \\u0110\\u00e3 giao h\\u00e0ng\"]', '2024-11-18 07:40:39', '2024-12-09 04:32:26'),
(97, 1, 6780000, 0, 6780000, 'Quyền Admin', '0987654321', '{\"province\":\"201\",\"district\":\"1490\",\"ward\":\"1A0814\",\"address\":\"35\\/ Ph\\u01b0\\u1eddng Y\\u00ean S\\u1edf\\/ Qu\\u1eadn Ho\\u00e0ng Mai\\/ H\\u00e0 N\\u1ed9i\"}', '', '2024-11-19 01:43:12', 1, 5, 'Cash', 'GHN', 'LDYRHL', 42350, '[\"2024-11-19 01:43:12 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-11-19 01:44:24 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-12-07 15:23:38 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-12-07 16:04:35 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-12-08 23:19:26 - \\u0110ang giao h\\u00e0ng\",\"2024-12-08 23:28:43 - \\u0110\\u00e3 giao h\\u00e0ng\"]', '2024-11-18 18:43:12', '2024-12-08 16:28:43'),
(98, 11, 5650000, 0, 5650000, 'Nguyễn Hoàn', '0818618635', '{\"province\":\"201\",\"district\":\"1486\",\"ward\":\"1A0421\",\"address\":\"22\\/ Ph\\u01b0\\u1eddng V\\u0103n Mi\\u1ebfu\\/ Qu\\u1eadn \\u0110\\u1ed1ng \\u0110a\\/ H\\u00e0 N\\u1ed9i\"}', '', '2024-01-19 01:44:43', 0, 6, 'Cash', 'GHTK', 'GTK10', 30000, '[\"2024-11-19 01:44:43 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-12-08 20:16:32 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-12-09 11:55:03 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-12-10 01:14:27 - \\u0110\\u00e3 h\\u1ee7y\"]', '2024-11-18 18:44:43', '2024-12-09 18:14:27'),
(99, 12, 9850000, 0, 9850000, 'lelong', '0976090852', '{\"province\":\"201\",\"district\":\"3440\",\"ward\":\"13010\",\"address\":\"26\\/ Ph\\u01b0\\u1eddng Xu\\u00e2n Ph\\u01b0\\u01a1ng\\/ Qu\\u1eadn Nam T\\u1eeb Li\\u00eam\\/ H\\u00e0 N\\u1ed9i\"}', '', '2024-11-25 13:12:04', 1, 5, 'Cash', 'GHN', 'LDR7LD', 42350, '[\"2024-11-25 13:12:04 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-12-08 20:17:45 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-12-10 01:14:45 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-12-10 01:18:23 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-12-15 08:55:16 - \\u0110ang giao h\\u00e0ng\",\"2024-12-15 08:56:46 - \\u0110\\u00e3 giao h\\u00e0ng\"]', '2024-11-25 06:12:04', '2024-12-15 01:56:46'),
(100, 12, 6650000, 0, 6650000, 'lelong', '0987654322', '{\"province\":\"201\",\"district\":\"3440\",\"ward\":\"13010\",\"address\":\"26\\/ Ph\\u01b0\\u1eddng Xu\\u00e2n Ph\\u01b0\\u01a1ng\\/ Qu\\u1eadn Nam T\\u1eeb Li\\u00eam\\/ H\\u00e0 N\\u1ed9i\"}', '', '2024-11-25 13:12:52', 1, 5, 'Cash', 'GHN', 'LDR7LP', 42350, '[\"2024-11-25 13:12:52 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-12-07 06:49:16 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-12-10 01:15:00 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-12-10 01:18:28 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-12-15 08:55:06 - \\u0110ang giao h\\u00e0ng\",\"2024-12-15 08:56:51 - \\u0110\\u00e3 giao h\\u00e0ng\"]', '2024-11-25 06:12:52', '2024-12-15 01:56:51'),
(101, 12, 2680000, 0, 2680000, 'lelong', '0987654322', '{\"province\":\"201\",\"district\":\"3440\",\"ward\":\"13010\",\"address\":\"26\\/ Ph\\u01b0\\u1eddng Xu\\u00e2n Ph\\u01b0\\u01a1ng\\/ Qu\\u1eadn Nam T\\u1eeb Li\\u00eam\\/ H\\u00e0 N\\u1ed9i\"}', '', '2024-11-25 13:13:15', 0, 6, 'Cash', NULL, NULL, NULL, '[\"2024-11-25 13:13:15 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-12-07 06:50:51 - \\u0110\\u00e3 h\\u1ee7y\"]', '2024-11-25 06:13:15', '2024-12-06 23:50:51'),
(102, 5, 1880000, 0, 1880000, 'Lê Hoàng', '0979568290', '{\"province\":\"201\",\"district\":\"1488\",\"ward\":\"1A0320\",\"address\":\"226\\/ Ph\\u01b0\\u1eddng V\\u0129nh Tuy\\/ Qu\\u1eadn Hai B\\u00e0 Tr\\u01b0ng\\/ H\\u00e0 N\\u1ed9i\"}', '', '2024-12-06 04:55:43', 1, 5, 'Cash', 'GHN', 'LDR7LB', 42350, '[\"2024-12-06 04:55:43 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-12-06 04:55:55 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-12-10 01:15:35 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-12-10 01:18:33 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-12-15 08:55:11 - \\u0110ang giao h\\u00e0ng\",\"2024-12-15 08:56:41 - \\u0110\\u00e3 giao h\\u00e0ng\"]', '2024-12-05 21:55:43', '2024-12-15 01:56:41'),
(103, 1, 4810000, 0, 4810000, 'Quyền Admin', '0987654321', '{\"province\":\"201\",\"district\":\"1490\",\"ward\":\"1A0814\",\"address\":\"35\\/ Ph\\u01b0\\u1eddng Y\\u00ean S\\u1edf\\/ Qu\\u1eadn Ho\\u00e0ng Mai\\/ H\\u00e0 N\\u1ed9i\"}', '', '2024-12-07 10:41:39', 1, 5, 'Cash', 'GHN', 'LDYRW3', 42350, '[\"2024-12-07 10:41:39 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-12-07 10:41:52 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-12-07 10:42:07 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-12-08 20:23:53 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-12-09 00:23:06 - \\u0110ang giao h\\u00e0ng\",\"2024-12-09 11:32:31 - \\u0110\\u00e3 giao h\\u00e0ng\"]', '2024-12-07 03:41:39', '2024-12-09 04:32:31'),
(104, 13, 14280000, 0, 14280000, 'Quyen Nguyen', '0818918935', '{\"province\":\"268\",\"district\":\"1717\",\"ward\":\"220217\",\"address\":\"Th\\u00f4n 4\\/ X\\u00e3 V\\u0169 X\\u00e1\\/ Huy\\u1ec7n Kim \\u0110\\u1ed9ng\\/ H\\u01b0ng Y\\u00ean\"}', '', '2024-12-09 11:15:28', 1, 5, 'Online', 'GHN', 'LNAERN', 27500, '[\"2024-12-09 11:15:28 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-12-09 11:45:35 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-12-10 01:15:47 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-12-10 01:18:38 - \\u0110\\u00e3 giao h\\u00e0ng\"]', '2024-12-09 04:15:28', '2024-12-09 18:18:38'),
(105, 13, 22950000, 0, 22950000, 'Quyen Nguyen', '0818918935', '{\"province\":\"268\",\"district\":\"1717\",\"ward\":\"220217\",\"address\":\"Th\\u00f4n 4\\/ X\\u00e3 V\\u0169 X\\u00e1\\/ Huy\\u1ec7n Kim \\u0110\\u1ed9ng\\/ H\\u01b0ng Y\\u00ean\"}', 'Không giao thứ 7', '2024-12-09 11:36:17', 1, 5, 'Cash', 'GHTK', 'GTK15', 45000, '[\"2024-12-09 11:36:17 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-12-09 11:45:38 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\",\"2024-12-15 09:03:40 - \\u0110\\u00e3 ho\\u00e0n thi\\u1ec7n\",\"2024-12-15 09:19:47 - Ch\\u1edd l\\u1ea5y h\\u00e0ng\",\"2024-12-15 09:19:54 - \\u0110ang giao h\\u00e0ng\",\"2024-12-15 09:19:58 - \\u0110\\u00e3 giao h\\u00e0ng\"]', '2024-12-09 04:36:17', '2024-12-15 02:19:58'),
(106, 13, 22950000, 0, 22950000, 'Quyen Nguyen', '0818918935', '{\"province\":\"268\",\"district\":\"1717\",\"ward\":\"220217\",\"address\":\"Th\\u00f4n 4\\/ X\\u00e3 V\\u0169 X\\u00e1\\/ Huy\\u1ec7n Kim \\u0110\\u1ed9ng\\/ H\\u01b0ng Y\\u00ean\"}', 'Không giao thứ 7', '2024-12-01 11:36:18', 0, 1, 'Cash', NULL, NULL, NULL, '[\"2024-12-09 11:36:18 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-12-09 11:45:41 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\"]', '2024-12-09 04:36:18', '2024-12-09 04:45:41'),
(107, 13, 250000, 0, 250000, 'Quyen Nguyen', '0979245683', '{\"province\":\"268\",\"district\":\"1717\",\"ward\":\"220217\",\"address\":\"Th\\u00f4n 4\\/ X\\u00e3 V\\u0169 X\\u00e1\\/ Huy\\u1ec7n Kim \\u0110\\u1ed9ng\\/ H\\u01b0ng Y\\u00ean\"}', '', '2024-12-02 11:45:02', 0, 1, 'Cash', NULL, NULL, NULL, '[\"2024-12-09 11:45:02 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-12-09 11:45:45 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\"]', '2024-12-09 04:45:02', '2024-12-09 04:45:45'),
(108, 13, 3180000, 0, 3180000, 'Quyen Nguyen', '0976999222', '{\"province\":\"268\",\"district\":\"1717\",\"ward\":\"220217\",\"address\":\"Th\\u00f4n 4\\/ X\\u00e3 V\\u0169 X\\u00e1\\/ Huy\\u1ec7n Kim \\u0110\\u1ed9ng\\/ H\\u01b0ng Y\\u00ean\"}', '', '2024-12-03 11:56:06', 0, 1, 'Cash', NULL, NULL, NULL, '[\"2024-12-09 11:56:06 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-12-10 01:10:54 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\"]', '2024-12-09 04:56:06', '2024-12-09 18:10:54'),
(109, 14, 18650000, 0, 18650000, 'Đào Phú', '0979251252', '{\"province\":\"201\",\"district\":\"1490\",\"ward\":\"1A0814\",\"address\":\"126\\/ Ph\\u01b0\\u1eddng Y\\u00ean S\\u1edf\\/ Qu\\u1eadn Ho\\u00e0ng Mai\\/ H\\u00e0 N\\u1ed9i\"}', '', '2024-12-04 12:00:00', 0, 1, 'Cash', NULL, NULL, NULL, '[\"2024-12-09 12:00:00 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-12-10 01:10:58 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\"]', '2024-12-09 05:00:00', '2024-12-09 18:10:58'),
(110, 14, 4000000, 0, 4000000, 'Đào Phú', '0979525562', '{\"province\":\"201\",\"district\":\"1490\",\"ward\":\"1A0814\",\"address\":\"126\\/ Ph\\u01b0\\u1eddng Y\\u00ean S\\u1edf\\/ Qu\\u1eadn Ho\\u00e0ng Mai\\/ H\\u00e0 N\\u1ed9i\"}', '', '2024-12-05 12:01:16', 0, 1, 'Cash', NULL, NULL, NULL, '[\"2024-12-09 12:01:16 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-12-10 01:11:02 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\"]', '2024-12-09 05:01:16', '2024-12-09 18:11:02'),
(111, 14, 1880000, 0, 1880000, 'Đào Phú', '0976666222', '{\"province\":\"201\",\"district\":\"1490\",\"ward\":\"1A0814\",\"address\":\"126\\/ Ph\\u01b0\\u1eddng Y\\u00ean S\\u1edf\\/ Qu\\u1eadn Ho\\u00e0ng Mai\\/ H\\u00e0 N\\u1ed9i\"}', '', '2024-12-09 12:03:30', 0, 1, 'Cash', NULL, NULL, NULL, '[\"2024-12-09 12:03:30 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-12-10 01:11:12 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\"]', '2024-12-09 05:03:30', '2024-12-09 18:11:12'),
(112, 7, 1300000, 0, 1300000, 'Trần Hoàn', '0987654322', '{\"province\":\"268\",\"district\":\"2045\",\"ward\":\"221011\",\"address\":\"16\\/ X\\u00e3 Xu\\u00e2n Quan\\/ Huy\\u1ec7n V\\u0103n Giang\\/ H\\u01b0ng Y\\u00ean\"}', '', '2024-12-09 12:40:36', 0, 1, 'Cash', NULL, NULL, NULL, '[\"2024-12-09 12:40:36 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-12-10 01:11:16 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\"]', '2024-12-09 05:40:36', '2024-12-09 18:11:16'),
(113, 7, 1780000, 0, 1780000, 'Trần Hoàn', '0987654322', '{\"province\":\"268\",\"district\":\"2045\",\"ward\":\"221011\",\"address\":\"16\\/ X\\u00e3 Xu\\u00e2n Quan\\/ Huy\\u1ec7n V\\u0103n Giang\\/ H\\u01b0ng Y\\u00ean\"}', '', '2024-12-02 12:41:20', 0, 1, 'Cash', NULL, NULL, NULL, '[\"2024-12-09 12:41:20 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-12-10 01:12:25 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\"]', '2024-12-09 05:41:20', '2024-12-09 18:12:25'),
(114, 7, 3357000, 0, 3357000, 'Trần Hoàn', '0987654333', '{\"province\":\"268\",\"district\":\"2045\",\"ward\":\"221011\",\"address\":\"16\\/ X\\u00e3 Xu\\u00e2n Quan\\/ Huy\\u1ec7n V\\u0103n Giang\\/ H\\u01b0ng Y\\u00ean\"}', '', '2024-12-09 12:44:24', 0, 1, 'Cash', NULL, NULL, NULL, '[\"2024-12-09 12:44:24 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\",\"2024-12-10 01:14:00 - \\u0110\\u00e3 x\\u00e1c nh\\u1eadn\"]', '2024-12-09 05:44:24', '2024-12-09 18:14:00'),
(115, 7, 3730000, 0, 3730000, 'Trần Hoàn', '0987654333', '{\"province\":\"268\",\"district\":\"2045\",\"ward\":\"221011\",\"address\":\"16\\/ X\\u00e3 Xu\\u00e2n Quan\\/ Huy\\u1ec7n V\\u0103n Giang\\/ H\\u01b0ng Y\\u00ean\"}', '', '2024-12-09 12:46:08', 0, 0, 'Cash', NULL, NULL, NULL, '[\"2024-12-09 12:46:08 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\"]', '2024-12-09 05:46:08', '2024-12-09 05:46:08'),
(116, 5, 2260000, 0, 2260000, 'Lê Hoàng', '0979865862', '{\"province\":\"201\",\"district\":\"1488\",\"ward\":\"1A0320\",\"address\":\"226\\/ Ph\\u01b0\\u1eddng V\\u0129nh Tuy\\/ Qu\\u1eadn Hai B\\u00e0 Tr\\u01b0ng\\/ H\\u00e0 N\\u1ed9i\"}', '', '2024-12-09 12:47:09', 0, 0, 'Cash', NULL, NULL, NULL, '[\"2024-12-09 12:47:09 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\"]', '2024-12-09 05:47:09', '2024-12-09 05:47:09'),
(117, 14, 3180000, 0, 3180000, 'Đào Phú', '0818659652', '{\"province\":\"201\",\"district\":\"1490\",\"ward\":\"1A0814\",\"address\":\"126\\/ Ph\\u01b0\\u1eddng Y\\u00ean S\\u1edf\\/ Qu\\u1eadn Ho\\u00e0ng Mai\\/ H\\u00e0 N\\u1ed9i\"}', '', '2024-12-09 12:49:14', 0, 0, 'Cash', NULL, NULL, NULL, '[\"2024-12-09 12:49:14 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\"]', '2024-12-09 05:49:14', '2024-12-09 05:49:14'),
(118, 14, 3730000, 0, 3730000, 'Đào Phú', '0975236232', '{\"province\":\"201\",\"district\":\"1490\",\"ward\":\"1A0814\",\"address\":\"126\\/ Ph\\u01b0\\u1eddng Y\\u00ean S\\u1edf\\/ Qu\\u1eadn Ho\\u00e0ng Mai\\/ H\\u00e0 N\\u1ed9i\"}', '', '2024-12-09 12:51:32', 0, 0, 'Cash', NULL, NULL, NULL, '[\"2024-12-09 12:51:32 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\"]', '2024-12-09 05:51:32', '2024-12-09 05:51:32'),
(119, 10, 250000, 0, 250000, 'Quang Bình', '0975266222', '{\"province\":\"201\",\"district\":\"1493\",\"ward\":\"1A0711\",\"address\":\"252\\/ Ph\\u01b0\\u1eddng Th\\u01b0\\u1ee3ng \\u0110\\u00ecnh\\/ Qu\\u1eadn Thanh Xu\\u00e2n\\/ H\\u00e0 N\\u1ed9i\"}', '', '2024-12-09 12:53:52', 0, 0, 'Cash', NULL, NULL, NULL, '[\"2024-12-09 12:53:52 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\"]', '2024-12-09 05:53:52', '2024-12-09 05:53:52'),
(120, 10, 400000, 0, 400000, 'Quang Bình', '0975266366', '{\"province\":\"201\",\"district\":\"1493\",\"ward\":\"1A0711\",\"address\":\"252\\/ Ph\\u01b0\\u1eddng Th\\u01b0\\u1ee3ng \\u0110\\u00ecnh\\/ Qu\\u1eadn Thanh Xu\\u00e2n\\/ H\\u00e0 N\\u1ed9i\"}', '', '2024-12-09 12:54:25', 0, 0, 'Cash', NULL, NULL, NULL, '[\"2024-12-09 12:54:25 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\"]', '2024-12-09 05:54:25', '2024-12-09 05:54:25'),
(121, 10, 2680000, 0, 2680000, 'Quang Bình', '0975266366', '{\"province\":\"201\",\"district\":\"1493\",\"ward\":\"1A0711\",\"address\":\"252\\/ Ph\\u01b0\\u1eddng Th\\u01b0\\u1ee3ng \\u0110\\u00ecnh\\/ Qu\\u1eadn Thanh Xu\\u00e2n\\/ H\\u00e0 N\\u1ed9i\"}', '', '2024-12-09 12:55:25', 0, 0, 'Cash', NULL, NULL, NULL, '[\"2024-12-09 12:55:25 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\"]', '2024-12-09 05:55:25', '2024-12-09 05:55:25'),
(122, 9, 4130000, 0, 4130000, 'Quản lý Khoa', '0979852856', '{\"province\":\"249\",\"district\":\"1730\",\"ward\":\"190512\",\"address\":\"\\u0110\\u1ed9i 6\\/ X\\u00e3 T\\u01b0\\u01a1ng Giang\\/ Th\\u1ecb x\\u00e3 T\\u1eeb S\\u01a1n\\/ B\\u1eafc Ninh\"}', '', '2024-12-10 01:23:53', 0, 0, 'Cash', NULL, NULL, NULL, '[\"2024-12-10 01:23:53 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\"]', '2024-12-09 18:23:53', '2024-12-09 18:23:53'),
(123, 9, 4130000, 0, 4130000, 'Quản lý Khoa', '0979852856', '{\"province\":\"249\",\"district\":\"1730\",\"ward\":\"190512\",\"address\":\"\\u0110\\u1ed9i 6\\/ X\\u00e3 T\\u01b0\\u01a1ng Giang\\/ Th\\u1ecb x\\u00e3 T\\u1eeb S\\u01a1n\\/ B\\u1eafc Ninh\"}', '', '2024-12-10 01:24:01', 0, 0, 'Cash', NULL, NULL, NULL, '[\"2024-12-10 01:24:01 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\"]', '2024-12-09 18:24:01', '2024-12-09 18:24:01'),
(124, 9, 1880000, 0, 1880000, 'Quản lý Khoa', '0979526528', '{\"province\":\"249\",\"district\":\"1730\",\"ward\":\"190512\",\"address\":\"\\u0110\\u1ed9i 6\\/ X\\u00e3 T\\u01b0\\u01a1ng Giang\\/ Th\\u1ecb x\\u00e3 T\\u1eeb S\\u01a1n\\/ B\\u1eafc Ninh\"}', '', '2024-12-10 01:25:45', 0, 0, 'Cash', NULL, NULL, NULL, '[\"2024-12-10 01:25:45 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\"]', '2024-12-09 18:25:45', '2024-12-09 18:25:45'),
(125, 9, 3730000, 0, 3730000, 'Quản lý Khoa', '0979526528', '{\"province\":\"249\",\"district\":\"1730\",\"ward\":\"190512\",\"address\":\"\\u0110\\u1ed9i 6\\/ X\\u00e3 T\\u01b0\\u01a1ng Giang\\/ Th\\u1ecb x\\u00e3 T\\u1eeb S\\u01a1n\\/ B\\u1eafc Ninh\"}', '', '2024-12-10 01:27:04', 0, 0, 'Cash', NULL, NULL, NULL, '[\"2024-12-10 01:27:04 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\"]', '2024-12-09 18:27:04', '2024-12-09 18:27:04'),
(126, 3, 3730000, 0, 3730000, 'Lê Việt', '0818628625', '{\"province\":\"268\",\"district\":\"2194\",\"ward\":\"220712\",\"address\":\"Th\\u00f4n 4\\/ X\\u00e3 Ti\\u1ec1n Ti\\u1ebfn\\/ Huy\\u1ec7n Ph\\u00f9 C\\u1eeb\\/ H\\u01b0ng Y\\u00ean\"}', 'Không giao thứ 5', '2024-12-21 07:47:15', 0, 0, 'Cash', NULL, NULL, NULL, '[\"2024-12-21 07:47:15 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\"]', '2024-12-21 00:47:15', '2024-12-21 00:47:15'),
(127, 1, 1330000, 0, 1330000, 'Quyền Admin', '0362085442', '{\"province\":\"201\",\"district\":\"1490\",\"ward\":\"1A0814\",\"address\":\"35\\/ Ph\\u01b0\\u1eddng Y\\u00ean S\\u1edf\\/ Qu\\u1eadn Ho\\u00e0ng Mai\\/ H\\u00e0 N\\u1ed9i\"}', '', '2024-12-21 10:19:43', 0, 0, 'Cash', NULL, NULL, NULL, '[\"2024-12-21 10:19:43 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\"]', '2024-12-21 03:19:43', '2024-12-21 03:19:43'),
(128, 5, 400000, 0, 400000, 'Lê Hoàng', '0362085442', '{\"province\":\"201\",\"district\":\"1488\",\"ward\":\"1A0320\",\"address\":\"226\\/ Ph\\u01b0\\u1eddng V\\u0129nh Tuy\\/ Qu\\u1eadn Hai B\\u00e0 Tr\\u01b0ng\\/ H\\u00e0 N\\u1ed9i\"}', '', '2024-12-22 12:19:55', 0, 0, 'Cash', NULL, NULL, NULL, '[\"2024-12-22 12:19:55 - \\u0110\\u1eb7t th\\u00e0nh c\\u00f4ng\"]', '2024-12-22 05:19:55', '2024-12-22 05:19:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_size_id` bigint UNSIGNED NOT NULL,
  `product_size_info` json DEFAULT NULL,
  `quantity` int NOT NULL,
  `item_value` int NOT NULL,
  `entry_price` int DEFAULT NULL COMMENT 'gia nhap vao',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_size_id`, `product_size_info`, `quantity`, `item_value`, `entry_price`, `created_at`, `updated_at`) VALUES
(132, 79, 129, '{\"product_id\": 42, \"product_name\": \"Versace Dylan Blue EDT\", \"product_image\": \"../admin_assets/images/product/versace-pour-homme-dylan-blue_1.jpg.webp\", \"product_size_id\": 129, \"product_size_name\": 100, \"product_size_price\": 1780000, \"product_entry_price\": 1500000, \"product_size_discount\": 5}', 5, 8900000, 7500000, '2024-11-15 09:04:41', '2024-11-15 09:04:41'),
(133, 80, 132, '{\"product_id\": 43, \"product_name\": \"Yves Saint Laurent Libre EDP\", \"product_image\": \"../admin_assets/images/product/yves-saint-laurent-libre-edp_1-600x600.jpg.webp\", \"product_size_id\": 132, \"product_size_name\": 50, \"product_size_price\": 2480000, \"product_entry_price\": 2000000, \"product_size_discount\": 5}', 3, 7440000, 6000000, '2024-11-15 09:14:15', '2024-11-15 09:14:15'),
(134, 81, 126, '{\"product_id\": 41, \"product_name\": \"Dior Sauvage EDP\", \"product_image\": \"../admin_assets/images/product/dior-sauvage-edp_1.jpg.webp\", \"product_size_id\": 126, \"product_size_name\": 60, \"product_size_price\": 2680000, \"product_entry_price\": 2200000, \"product_size_discount\": 5}', 1, 2680000, 2200000, '2024-11-15 09:15:23', '2024-11-15 09:15:23'),
(135, 82, 129, '{\"product_id\": 42, \"product_name\": \"Versace Dylan Blue EDT\", \"product_image\": \"../admin_assets/images/product/versace-pour-homme-dylan-blue_1.jpg.webp\", \"product_size_id\": 129, \"product_size_name\": 100, \"product_size_price\": 1780000, \"product_entry_price\": 1500000, \"product_size_discount\": 5}', 1, 1780000, 1500000, '2024-11-15 20:37:33', '2024-11-15 20:37:33'),
(136, 82, 133, '{\"product_id\": 44, \"product_name\": \"Armaf Club De Nuit Intense Man EDT Mini\", \"product_image\": \"../admin_assets/images/product/armaf-club-de-nuit-intense-man-edt-mini-10ml_1.jpg.webp\", \"product_size_id\": 133, \"product_size_name\": 10, \"product_size_price\": 280000, \"product_entry_price\": 200000, \"product_size_discount\": 5}', 1, 280000, 200000, '2024-11-15 20:37:33', '2024-11-15 20:37:33'),
(137, 83, 93, '{\"product_id\": 30, \"product_name\": \"Versace Eros EDT\", \"product_image\": \"../admin_assets/images/product/versace-eros_1.jpg.webp\", \"product_size_id\": 93, \"product_size_name\": 50, \"product_size_price\": 1330000, \"product_entry_price\": 1100000, \"product_size_discount\": 5}', 10, 13300000, 11000000, '2024-11-15 20:41:46', '2024-11-15 20:41:46'),
(138, 84, 134, '{\"product_id\": 45, \"product_name\": \"Giorgio Armani Acqua Di Gio Pour Homme EDT\", \"product_image\": \"../admin_assets/images/product/giorgio-armani-acqua-di-gio-pour-homme_1-600x600.jpg.webp\", \"product_size_id\": 134, \"product_size_name\": 30, \"product_size_price\": 1130000, \"product_entry_price\": 800000, \"product_size_discount\": 5}', 10, 11300000, 8000000, '2024-11-15 21:02:52', '2024-11-15 21:02:52'),
(139, 85, 136, '{\"product_id\": 46, \"product_name\": \"Giorgio Armani Acqua Di Gio Parfum Mini\", \"product_image\": \"../admin_assets/images/product/giorgio-armani-acqua-di-gio-parfum-mini-5ml_1-600x600.jpg.webp\", \"product_size_id\": 136, \"product_size_name\": 5, \"product_size_price\": 400000, \"product_entry_price\": 300000, \"product_size_discount\": 5}', 1, 400000, 300000, '2024-11-15 21:06:45', '2024-11-15 21:06:45'),
(140, 85, 134, '{\"product_id\": 45, \"product_name\": \"Giorgio Armani Acqua Di Gio Pour Homme EDT\", \"product_image\": \"../admin_assets/images/product/giorgio-armani-acqua-di-gio-pour-homme_1-600x600.jpg.webp\", \"product_size_id\": 134, \"product_size_name\": 30, \"product_size_price\": 1130000, \"product_entry_price\": 800000, \"product_size_discount\": 5}', 1, 1130000, 800000, '2024-11-15 21:06:45', '2024-11-15 21:06:45'),
(141, 85, 131, '{\"product_id\": 43, \"product_name\": \"Yves Saint Laurent Libre EDP\", \"product_image\": \"../admin_assets/images/product/yves-saint-laurent-libre-edp_1-600x600.jpg.webp\", \"product_size_id\": 131, \"product_size_name\": 30, \"product_size_price\": 1880000, \"product_entry_price\": 1500000, \"product_size_discount\": 5}', 1, 1880000, 1500000, '2024-11-15 21:06:45', '2024-11-15 21:06:45'),
(142, 86, 93, '{\"product_id\": 30, \"product_name\": \"Versace Eros EDT\", \"product_image\": \"../admin_assets/images/product/versace-eros_1.jpg.webp\", \"product_size_id\": 93, \"product_size_name\": 50, \"product_size_price\": 1330000, \"product_entry_price\": 1100000, \"product_size_discount\": 5}', 10, 13300000, 11000000, '2024-11-15 21:07:06', '2024-11-15 21:07:06'),
(143, 87, 95, '{\"product_id\": 30, \"product_name\": \"Versace Eros EDT\", \"product_image\": \"../admin_assets/images/product/versace-eros_1.jpg.webp\", \"product_size_id\": 95, \"product_size_name\": 200, \"product_size_price\": 2380000, \"product_entry_price\": 2100000, \"product_size_discount\": 5}', 10, 23800000, 21000000, '2024-11-15 21:09:35', '2024-11-15 21:09:35'),
(144, 88, 95, '{\"product_id\": 30, \"product_name\": \"Versace Eros EDT\", \"product_image\": \"../admin_assets/images/product/versace-eros_1.jpg.webp\", \"product_size_id\": 95, \"product_size_name\": 200, \"product_size_price\": 2380000, \"product_entry_price\": 2100000, \"product_size_discount\": 5}', 5, 11900000, 10500000, '2024-11-15 21:11:49', '2024-11-15 21:11:49'),
(145, 89, 126, '{\"product_id\": 41, \"product_name\": \"Dior Sauvage EDP\", \"product_image\": \"../admin_assets/images/product/dior-sauvage-edp_1.jpg.webp\", \"product_size_id\": 126, \"product_size_name\": 60, \"product_size_price\": 2680000, \"product_entry_price\": 2200000, \"product_size_discount\": 5}', 3, 8040000, 6600000, '2024-11-15 21:12:14', '2024-11-15 21:12:14'),
(146, 90, 132, '{\"product_id\": 43, \"product_name\": \"Yves Saint Laurent Libre EDP\", \"product_image\": \"../admin_assets/images/product/yves-saint-laurent-libre-edp_1-600x600.jpg.webp\", \"product_size_id\": 132, \"product_size_name\": 50, \"product_size_price\": 2480000, \"product_entry_price\": 2000000, \"product_size_discount\": 5}', 4, 9920000, 8000000, '2024-11-15 21:12:44', '2024-11-15 21:12:44'),
(147, 91, 133, '{\"product_id\": 44, \"product_name\": \"Armaf Club De Nuit Intense Man EDT Mini\", \"product_image\": \"../admin_assets/images/product/armaf-club-de-nuit-intense-man-edt-mini-10ml_1.jpg.webp\", \"product_size_id\": 133, \"product_size_name\": 10, \"product_size_price\": 280000, \"product_entry_price\": 200000, \"product_size_discount\": 5}', 1, 280000, 200000, '2024-11-15 21:19:16', '2024-11-15 21:19:16'),
(148, 92, 126, '{\"product_id\": 41, \"product_name\": \"Dior Sauvage EDP\", \"product_image\": \"../admin_assets/images/product/dior-sauvage-edp_1.jpg.webp\", \"product_size_id\": 126, \"product_size_name\": 60, \"product_size_price\": 2680000, \"product_entry_price\": 2200000, \"product_size_discount\": 5}', 1, 2680000, 2200000, '2024-11-15 22:42:12', '2024-11-15 22:42:12'),
(149, 93, 129, '{\"product_id\": 42, \"product_name\": \"Versace Dylan Blue EDT\", \"product_image\": \"../admin_assets/images/product/versace-pour-homme-dylan-blue_1.jpg.webp\", \"product_size_id\": 129, \"product_size_name\": 100, \"product_size_price\": 1780000, \"product_entry_price\": 1500000, \"product_size_discount\": 5}', 1, 1780000, 1500000, '2024-11-16 23:31:23', '2024-11-16 23:31:23'),
(150, 94, 126, '{\"product_id\": 41, \"product_name\": \"Dior Sauvage EDP\", \"product_image\": \"../admin_assets/images/product/dior-sauvage-edp_1.jpg.webp\", \"product_size_id\": 126, \"product_size_name\": 60, \"product_size_price\": 2680000, \"product_entry_price\": 2200000, \"product_size_discount\": 5}', 1, 2680000, 2200000, '2024-11-17 23:19:22', '2024-11-17 23:19:22'),
(151, 95, 133, '{\"product_id\": 44, \"product_name\": \"Armaf Club De Nuit Intense Man EDT Mini\", \"product_image\": \"../admin_assets/images/product/armaf-club-de-nuit-intense-man-edt-mini-10ml_1.jpg.webp\", \"product_size_id\": 133, \"product_size_name\": 10, \"product_size_price\": 280000, \"product_entry_price\": 200000, \"product_size_discount\": 5}', 1, 280000, 200000, '2024-11-17 23:27:49', '2024-11-17 23:27:49'),
(152, 96, 128, '{\"product_id\": 41, \"product_name\": \"Dior Sauvage EDP\", \"product_image\": \"../admin_assets/images/product/dior-sauvage-edp_1.jpg.webp\", \"product_size_id\": 128, \"product_size_name\": 200, \"product_size_price\": 4780000, \"product_entry_price\": 4600000, \"product_size_discount\": 5}', 5, 23900000, 23000000, '2024-11-18 07:40:39', '2024-11-18 07:40:39'),
(153, 97, 134, '{\"product_id\": 45, \"product_name\": \"Giorgio Armani Acqua Di Gio Pour Homme EDT\", \"product_image\": \"../admin_assets/images/product/giorgio-armani-acqua-di-gio-pour-homme_1-600x600.jpg.webp\", \"product_size_id\": 134, \"product_size_name\": 30, \"product_size_price\": 1130000, \"product_entry_price\": 800000, \"product_size_discount\": 5}', 6, 6780000, 4800000, '2024-11-18 18:43:13', '2024-11-18 18:43:13'),
(154, 98, 134, '{\"product_id\": 45, \"product_name\": \"Giorgio Armani Acqua Di Gio Pour Homme EDT\", \"product_image\": \"../admin_assets/images/product/giorgio-armani-acqua-di-gio-pour-homme_1-600x600.jpg.webp\", \"product_size_id\": 134, \"product_size_name\": 30, \"product_size_price\": 1130000, \"product_entry_price\": 800000, \"product_size_discount\": 5}', 5, 5650000, 4000000, '2024-11-18 18:44:43', '2024-11-18 18:44:43'),
(155, 99, 129, '{\"product_id\": 42, \"product_name\": \"Versace Dylan Blue EDT\", \"product_image\": \"../admin_assets/images/product/versace-pour-homme-dylan-blue_1.jpg.webp\", \"product_size_id\": 129, \"product_size_name\": 100, \"product_size_price\": 1780000, \"product_entry_price\": 1500000, \"product_size_discount\": 5}', 1, 1780000, 1500000, '2024-11-25 06:12:04', '2024-11-25 06:12:04'),
(156, 99, 131, '{\"product_id\": 43, \"product_name\": \"Yves Saint Laurent Libre EDP\", \"product_image\": \"../admin_assets/images/product/yves-saint-laurent-libre-edp_1-600x600.jpg.webp\", \"product_size_id\": 131, \"product_size_name\": 30, \"product_size_price\": 1880000, \"product_entry_price\": 1500000, \"product_size_discount\": 5}', 2, 3760000, 3000000, '2024-11-25 06:12:04', '2024-11-25 06:12:04'),
(157, 99, 134, '{\"product_id\": 45, \"product_name\": \"Giorgio Armani Acqua Di Gio Pour Homme EDT\", \"product_image\": \"../admin_assets/images/product/giorgio-armani-acqua-di-gio-pour-homme_1-600x600.jpg.webp\", \"product_size_id\": 134, \"product_size_name\": 30, \"product_size_price\": 1130000, \"product_entry_price\": 800000, \"product_size_discount\": 5}', 1, 1130000, 800000, '2024-11-25 06:12:04', '2024-11-25 06:12:04'),
(158, 99, 138, '{\"product_id\": 48, \"product_name\": \"Dior Homme Intense EDP\", \"product_image\": \"../admin_assets/images/product/dior-homme-intense_1-600x600.jpg.webp\", \"product_size_id\": 138, \"product_size_name\": 100, \"product_size_price\": 3180000, \"product_entry_price\": 2450000, \"product_size_discount\": 5}', 1, 3180000, 2450000, '2024-11-25 06:12:04', '2024-11-25 06:12:04'),
(159, 100, 93, '{\"product_id\": 30, \"product_name\": \"Versace Eros EDT\", \"product_image\": \"../admin_assets/images/product/versace-eros_1.jpg.webp\", \"product_size_id\": 93, \"product_size_name\": 50, \"product_size_price\": 1330000, \"product_entry_price\": 1100000, \"product_size_discount\": 5}', 5, 6650000, 5500000, '2024-11-25 06:12:52', '2024-11-25 06:12:52'),
(160, 101, 126, '{\"product_id\": 41, \"product_name\": \"Dior Sauvage EDP\", \"product_image\": \"../admin_assets/images/product/dior-sauvage-edp_1.jpg.webp\", \"product_size_id\": 126, \"product_size_name\": 60, \"product_size_price\": 2680000, \"product_entry_price\": 2100000, \"product_size_discount\": 5}', 1, 2680000, 2100000, '2024-11-25 06:13:15', '2024-11-25 06:13:15'),
(161, 102, 131, '{\"product_id\": 43, \"product_name\": \"Yves Saint Laurent Libre EDP\", \"product_image\": \"../admin_assets/images/product/yves-saint-laurent-libre-edp_1-600x600.jpg.webp\", \"product_size_id\": 131, \"product_size_name\": 30, \"product_size_price\": 1880000, \"product_entry_price\": 1500000, \"product_size_discount\": 5}', 1, 1880000, 1500000, '2024-12-05 21:55:43', '2024-12-05 21:55:43'),
(162, 103, 126, '{\"product_id\": 41, \"product_name\": \"Dior Sauvage EDP\", \"product_image\": \"../admin_assets/images/product/dior-sauvage-edp_1.jpg.webp\", \"product_size_id\": 126, \"product_size_name\": 60, \"product_size_price\": 2680000, \"product_entry_price\": 2100000, \"product_size_discount\": 5}', 1, 2680000, 2100000, '2024-12-07 03:41:39', '2024-12-07 03:41:39'),
(163, 103, 131, '{\"product_id\": 43, \"product_name\": \"Yves Saint Laurent Libre EDP\", \"product_image\": \"../admin_assets/images/product/yves-saint-laurent-libre-edp_1-600x600.jpg.webp\", \"product_size_id\": 131, \"product_size_name\": 30, \"product_size_price\": 1880000, \"product_entry_price\": 1500000, \"product_size_discount\": 5}', 1, 1880000, 1500000, '2024-12-07 03:41:39', '2024-12-07 03:41:39'),
(164, 103, 133, '{\"product_id\": 44, \"product_name\": \"Armaf Club De Nuit Intense Man EDT Mini\", \"product_image\": \"../admin_assets/images/product/armaf-club-de-nuit-intense-man-edt-mini-10ml_1.jpg.webp\", \"product_size_id\": 133, \"product_size_name\": 10, \"product_size_price\": 250000, \"product_entry_price\": 180000, \"product_size_discount\": 5}', 1, 250000, 180000, '2024-12-07 03:41:39', '2024-12-07 03:41:39'),
(165, 104, 95, '{\"product_id\": 30, \"product_name\": \"Versace Eros EDT\", \"product_image\": \"../admin_assets/images/product/versace-eros_1.jpg.webp\", \"product_size_id\": 95, \"product_size_name\": 200, \"product_size_price\": 2380000, \"product_entry_price\": 2100000, \"product_size_discount\": 5}', 6, 14280000, 12600000, '2024-12-09 04:15:28', '2024-12-09 04:15:28'),
(166, 105, 135, '{\"product_id\": 45, \"product_name\": \"Giorgio Armani Acqua Di Gio Pour Homme EDT\", \"product_image\": \"../admin_assets/images/product/giorgio-armani-acqua-di-gio-pour-homme_1-600x600.jpg.webp\", \"product_size_id\": 135, \"product_size_name\": 50, \"product_size_price\": 1530000, \"product_entry_price\": 1150000, \"product_size_discount\": 5}', 15, 22950000, 17250000, '2024-12-09 04:36:17', '2024-12-09 04:36:17'),
(167, 106, 135, '{\"product_id\": 45, \"product_name\": \"Giorgio Armani Acqua Di Gio Pour Homme EDT\", \"product_image\": \"../admin_assets/images/product/giorgio-armani-acqua-di-gio-pour-homme_1-600x600.jpg.webp\", \"product_size_id\": 135, \"product_size_name\": 50, \"product_size_price\": 1530000, \"product_entry_price\": 1150000, \"product_size_discount\": 5}', 15, 22950000, 17250000, '2024-12-09 04:36:18', '2024-12-09 04:36:18'),
(168, 107, 133, '{\"product_id\": 44, \"product_name\": \"Armaf Club De Nuit Intense Man EDT Mini\", \"product_image\": \"../admin_assets/images/product/armaf-club-de-nuit-intense-man-edt-mini-10ml_1.jpg.webp\", \"product_size_id\": 133, \"product_size_name\": 10, \"product_size_price\": 250000, \"product_entry_price\": 180000, \"product_size_discount\": 5}', 1, 250000, 180000, '2024-12-09 04:45:02', '2024-12-09 04:45:02'),
(169, 108, 138, '{\"product_id\": 48, \"product_name\": \"Dior Homme Intense EDP\", \"product_image\": \"../admin_assets/images/product/dior-homme-intense_1-600x600.jpg.webp\", \"product_size_id\": 138, \"product_size_name\": 100, \"product_size_price\": 3180000, \"product_entry_price\": 2450000, \"product_size_discount\": 5}', 1, 3180000, 2450000, '2024-12-09 04:56:07', '2024-12-09 04:56:07'),
(170, 109, 140, '{\"product_id\": 49, \"product_name\": \"Chanel Bleu De Chanel EDP\", \"product_image\": \"../admin_assets/images/product/chanel-bleu-de-chanel-edp_1-600x600.jpg.webp\", \"product_size_id\": 140, \"product_size_name\": 100, \"product_size_price\": 3730000, \"product_entry_price\": 3050000, \"product_size_discount\": 5}', 5, 18650000, 15250000, '2024-12-09 05:00:00', '2024-12-09 05:00:00'),
(171, 110, 136, '{\"product_id\": 46, \"product_name\": \"Giorgio Armani Acqua Di Gio Parfum Mini\", \"product_image\": \"../admin_assets/images/product/giorgio-armani-acqua-di-gio-parfum-mini-5ml_1-600x600.jpg.webp\", \"product_size_id\": 136, \"product_size_name\": 5, \"product_size_price\": 400000, \"product_entry_price\": 320000, \"product_size_discount\": 5}', 10, 4000000, 3200000, '2024-12-09 05:01:16', '2024-12-09 05:01:16'),
(172, 111, 131, '{\"product_id\": 43, \"product_name\": \"Yves Saint Laurent Libre EDP\", \"product_image\": \"../admin_assets/images/product/yves-saint-laurent-libre-edp_1-600x600.jpg.webp\", \"product_size_id\": 131, \"product_size_name\": 30, \"product_size_price\": 1880000, \"product_entry_price\": 1500000, \"product_size_discount\": 5}', 1, 1880000, 1500000, '2024-12-09 05:03:30', '2024-12-09 05:03:30'),
(173, 112, 133, '{\"product_id\": 44, \"product_name\": \"Armaf Club De Nuit Intense Man EDT Mini\", \"product_image\": \"../admin_assets/images/product/armaf-club-de-nuit-intense-man-edt-mini-10ml_1.jpg.webp\", \"product_size_id\": 133, \"product_size_name\": 10, \"product_size_price\": 250000, \"product_entry_price\": 180000, \"product_size_discount\": 5}', 2, 500000, 360000, '2024-12-09 05:40:36', '2024-12-09 05:40:36'),
(174, 112, 136, '{\"product_id\": 46, \"product_name\": \"Giorgio Armani Acqua Di Gio Parfum Mini\", \"product_image\": \"../admin_assets/images/product/giorgio-armani-acqua-di-gio-parfum-mini-5ml_1-600x600.jpg.webp\", \"product_size_id\": 136, \"product_size_name\": 5, \"product_size_price\": 400000, \"product_entry_price\": 320000, \"product_size_discount\": 5}', 2, 800000, 640000, '2024-12-09 05:40:36', '2024-12-09 05:40:36'),
(175, 113, 129, '{\"product_id\": 42, \"product_name\": \"Versace Dylan Blue EDT\", \"product_image\": \"../admin_assets/images/product/versace-pour-homme-dylan-blue_1.jpg.webp\", \"product_size_id\": 129, \"product_size_name\": 100, \"product_size_price\": 1780000, \"product_entry_price\": 1500000, \"product_size_discount\": 5}', 1, 1780000, 1500000, '2024-12-09 05:41:20', '2024-12-09 05:41:20'),
(176, 114, 144, '{\"product_id\": 52, \"product_name\": \"Calvin Klein (CK) CK One\", \"product_image\": \"../admin_assets/images/product/nuoc-hoa-calvin-klein-ck-ck-one-cho-ca-nam-va-nu-15ml-5c6299a13d249-12022019170209.webp\", \"product_size_id\": 144, \"product_size_name\": 10, \"product_size_price\": 269000, \"product_entry_price\": 220000, \"product_size_discount\": 5}', 3, 807000, 660000, '2024-12-09 05:44:24', '2024-12-09 05:44:24'),
(177, 114, 143, '{\"product_id\": 51, \"product_name\": \"Armaf Club De Nuit Intense Man EDT\", \"product_image\": \"../admin_assets/images/product/nuoc-hoa-nam-armaf-club-de-nuit-intense-man-eau-de-toilette-105ml-6711b6a62a9b0-18102024081518.webp\", \"product_size_id\": 143, \"product_size_name\": 105, \"product_size_price\": 850000, \"product_entry_price\": 650000, \"product_size_discount\": 5}', 3, 2550000, 1950000, '2024-12-09 05:44:24', '2024-12-09 05:44:24'),
(178, 115, 140, '{\"product_id\": 49, \"product_name\": \"Chanel Bleu De Chanel EDP\", \"product_image\": \"../admin_assets/images/product/chanel-bleu-de-chanel-edp_1-600x600.jpg.webp\", \"product_size_id\": 140, \"product_size_name\": 100, \"product_size_price\": 3730000, \"product_entry_price\": 3050000, \"product_size_discount\": 5}', 1, 3730000, 3050000, '2024-12-09 05:46:08', '2024-12-09 05:46:08'),
(179, 116, 142, '{\"product_id\": 50, \"product_name\": \"Gucci Bloom EDP Mini\", \"product_image\": \"../admin_assets/images/product/gucci-bloom-edp-mini-5ml_2-600x600.jpg.webp\", \"product_size_id\": 142, \"product_size_name\": 5, \"product_size_price\": 380000, \"product_entry_price\": 310000, \"product_size_discount\": 5}', 1, 380000, 310000, '2024-12-09 05:47:09', '2024-12-09 05:47:09'),
(180, 116, 131, '{\"product_id\": 43, \"product_name\": \"Yves Saint Laurent Libre EDP\", \"product_image\": \"../admin_assets/images/product/yves-saint-laurent-libre-edp_1-600x600.jpg.webp\", \"product_size_id\": 131, \"product_size_name\": 30, \"product_size_price\": 1880000, \"product_entry_price\": 1500000, \"product_size_discount\": 5}', 1, 1880000, 1500000, '2024-12-09 05:47:09', '2024-12-09 05:47:09'),
(181, 117, 138, '{\"product_id\": 48, \"product_name\": \"Dior Homme Intense EDP\", \"product_image\": \"../admin_assets/images/product/dior-homme-intense_1-600x600.jpg.webp\", \"product_size_id\": 138, \"product_size_name\": 100, \"product_size_price\": 3180000, \"product_entry_price\": 2450000, \"product_size_discount\": 5}', 1, 3180000, 2450000, '2024-12-09 05:49:14', '2024-12-09 05:49:14'),
(182, 118, 140, '{\"product_id\": 49, \"product_name\": \"Chanel Bleu De Chanel EDP\", \"product_image\": \"../admin_assets/images/product/chanel-bleu-de-chanel-edp_1-600x600.jpg.webp\", \"product_size_id\": 140, \"product_size_name\": 100, \"product_size_price\": 3730000, \"product_entry_price\": 3050000, \"product_size_discount\": 5}', 1, 3730000, 3050000, '2024-12-09 05:51:32', '2024-12-09 05:51:32'),
(183, 119, 133, '{\"product_id\": 44, \"product_name\": \"Armaf Club De Nuit Intense Man EDT Mini\", \"product_image\": \"../admin_assets/images/product/armaf-club-de-nuit-intense-man-edt-mini-10ml_1.jpg.webp\", \"product_size_id\": 133, \"product_size_name\": 10, \"product_size_price\": 250000, \"product_entry_price\": 180000, \"product_size_discount\": 5}', 1, 250000, 180000, '2024-12-09 05:53:52', '2024-12-09 05:53:52'),
(184, 120, 136, '{\"product_id\": 46, \"product_name\": \"Giorgio Armani Acqua Di Gio Parfum Mini\", \"product_image\": \"../admin_assets/images/product/giorgio-armani-acqua-di-gio-parfum-mini-5ml_1-600x600.jpg.webp\", \"product_size_id\": 136, \"product_size_name\": 5, \"product_size_price\": 400000, \"product_entry_price\": 320000, \"product_size_discount\": 5}', 1, 400000, 320000, '2024-12-09 05:54:25', '2024-12-09 05:54:25'),
(185, 121, 126, '{\"product_id\": 41, \"product_name\": \"Dior Sauvage EDP\", \"product_image\": \"../admin_assets/images/product/dior-sauvage-edp_1.jpg.webp\", \"product_size_id\": 126, \"product_size_name\": 60, \"product_size_price\": 2680000, \"product_entry_price\": 2100000, \"product_size_discount\": 5}', 1, 2680000, 2100000, '2024-12-09 05:55:25', '2024-12-09 05:55:25'),
(186, 122, 140, '{\"product_id\": 49, \"product_name\": \"Chanel Bleu De Chanel EDP\", \"product_image\": \"../admin_assets/images/product/chanel-bleu-de-chanel-edp_1-600x600.jpg.webp\", \"product_size_id\": 140, \"product_size_name\": 100, \"product_size_price\": 3730000, \"product_entry_price\": 3050000, \"product_size_discount\": 5}', 1, 3730000, 3050000, '2024-12-09 18:23:53', '2024-12-09 18:23:53'),
(187, 122, 136, '{\"product_id\": 46, \"product_name\": \"Giorgio Armani Acqua Di Gio Parfum Mini\", \"product_image\": \"../admin_assets/images/product/giorgio-armani-acqua-di-gio-parfum-mini-5ml_1-600x600.jpg.webp\", \"product_size_id\": 136, \"product_size_name\": 5, \"product_size_price\": 400000, \"product_entry_price\": 320000, \"product_size_discount\": 5}', 1, 400000, 320000, '2024-12-09 18:23:53', '2024-12-09 18:23:53'),
(188, 123, 140, '{\"product_id\": 49, \"product_name\": \"Chanel Bleu De Chanel EDP\", \"product_image\": \"../admin_assets/images/product/chanel-bleu-de-chanel-edp_1-600x600.jpg.webp\", \"product_size_id\": 140, \"product_size_name\": 100, \"product_size_price\": 3730000, \"product_entry_price\": 3050000, \"product_size_discount\": 5}', 1, 3730000, 3050000, '2024-12-09 18:24:01', '2024-12-09 18:24:01'),
(189, 123, 136, '{\"product_id\": 46, \"product_name\": \"Giorgio Armani Acqua Di Gio Parfum Mini\", \"product_image\": \"../admin_assets/images/product/giorgio-armani-acqua-di-gio-parfum-mini-5ml_1-600x600.jpg.webp\", \"product_size_id\": 136, \"product_size_name\": 5, \"product_size_price\": 400000, \"product_entry_price\": 320000, \"product_size_discount\": 5}', 1, 400000, 320000, '2024-12-09 18:24:01', '2024-12-09 18:24:01'),
(190, 124, 131, '{\"product_id\": 43, \"product_name\": \"Yves Saint Laurent Libre EDP\", \"product_image\": \"../admin_assets/images/product/yves-saint-laurent-libre-edp_1-600x600.jpg.webp\", \"product_size_id\": 131, \"product_size_name\": 30, \"product_size_price\": 1880000, \"product_entry_price\": 1500000, \"product_size_discount\": 5}', 1, 1880000, 1500000, '2024-12-09 18:25:45', '2024-12-09 18:25:45'),
(191, 125, 140, '{\"product_id\": 49, \"product_name\": \"Chanel Bleu De Chanel EDP\", \"product_image\": \"../admin_assets/images/product/chanel-bleu-de-chanel-edp_1-600x600.jpg.webp\", \"product_size_id\": 140, \"product_size_name\": 100, \"product_size_price\": 3730000, \"product_entry_price\": 3050000, \"product_size_discount\": 5}', 1, 3730000, 3050000, '2024-12-09 18:27:04', '2024-12-09 18:27:04'),
(192, 126, 140, '{\"product_id\": 49, \"product_name\": \"Chanel Bleu De Chanel EDP\", \"product_image\": \"../admin_assets/images/product/chanel-bleu-de-chanel-edp_1-600x600.jpg.webp\", \"product_size_id\": 140, \"product_size_name\": 100, \"product_size_price\": 3730000, \"product_entry_price\": 3050000, \"product_size_discount\": 5}', 1, 3730000, 3050000, '2024-12-21 00:47:15', '2024-12-21 00:47:15'),
(193, 127, 93, '{\"product_id\": 30, \"product_name\": \"Versace Eros EDT\", \"product_image\": \"../admin_assets/images/product/versace-eros_1.jpg.webp\", \"product_size_id\": 93, \"product_size_name\": 50, \"product_size_price\": 1330000, \"product_entry_price\": 1100000, \"product_size_discount\": 5}', 1, 1330000, 1100000, '2024-12-21 03:19:43', '2024-12-21 03:19:43'),
(194, 128, 136, '{\"product_id\": 46, \"product_name\": \"Giorgio Armani Acqua Di Gio Parfum Mini\", \"product_image\": \"../admin_assets/images/product/giorgio-armani-acqua-di-gio-parfum-mini-5ml_1-600x600.jpg.webp\", \"product_size_id\": 136, \"product_size_name\": 5, \"product_size_price\": 400000, \"product_entry_price\": 320000, \"product_size_discount\": 5}', 1, 400000, 320000, '2024-12-22 05:19:55', '2024-12-22 05:19:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'view_products', 'Xem sản phẩm', NULL, NULL),
(2, 'edit_products', 'Sửa sản phẩm', NULL, NULL),
(3, 'delete_products', 'Xóa sản phẩm', NULL, NULL),
(5, 'user_permission', 'Phân quyền *', '2024-10-01 22:39:38', '2024-10-01 22:39:38'),
(6, 'manager.home', 'Trang chủ *', '2024-10-15 03:38:11', '2024-10-15 03:38:11'),
(7, 'manager.product', 'Quản lý sản phẩm *', '2024-10-15 03:48:23', '2024-10-15 03:48:23'),
(8, 'manager.promotion', 'Quản lý mã giảm giá *', '2024-10-27 06:23:46', '2024-10-27 06:23:46'),
(9, 'manager.order', 'Quản lý đơn hàng *', '2024-10-27 06:35:27', '2024-10-27 06:35:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permission_role`
--

INSERT INTO `permission_role` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(6, 3, 1, NULL, NULL),
(10, 5, 1, NULL, NULL),
(13, 1, 5, NULL, NULL),
(14, 1, 6, NULL, NULL),
(15, 1, 7, NULL, NULL),
(16, 6, 1, NULL, NULL),
(17, 1, 8, NULL, NULL),
(18, 1, 9, NULL, NULL),
(30, 12, 1, NULL, NULL),
(31, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `summary` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` enum('public','hidden') COLLATE utf8mb3_unicode_ci NOT NULL,
  `comment_status` enum('enabled','disabled','auto') COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tags` text COLLATE utf8mb3_unicode_ci,
  `views` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `title`, `category`, `summary`, `content`, `status`, `comment_status`, `image`, `user_id`, `created_at`, `updated_at`, `slug`, `tags`, `views`) VALUES
(10, 'Gợi ý chọn nước hoa nam phù hợp', 'Góc review', 'Tips hữu ích để lựa chọn nước hoa phù hợp cho nam', '<p style=\"margin-right: 0px; margin-bottom: 1rem; margin-left: 0px; color: rgb(0, 0, 0); line-height: 1.65; scroll-behavior: smooth; padding: 0px; font-family: &quot;Space Grotesk&quot;, sans-serif; font-size: 16px; text-align: justify;\"><span style=\"scroll-behavior: smooth; margin: 0px; padding: 0px; font-weight: bolder;\">1. Nước hoa cho nam theo phong cách cổ điển</span></p><p style=\"margin-right: 0px; margin-bottom: 1rem; margin-left: 0px; color: rgb(0, 0, 0); line-height: 1.65; scroll-behavior: smooth; padding: 0px; font-family: &quot;Space Grotesk&quot;, sans-serif; font-size: 16px; text-align: justify;\">Nếu bạn là người theo chủ nghĩa truyền thống, hiếm có loại nước hoa nào có thể đứng vững như vậy. Những chai nước hoa theo phong cách cổ điển thường là những chai có nhóm gỗ ấm nồng và truyền thống. Những chai nước hoa này thường chứa các hương gỗ, hương thảo để tạo nên sự tinh tế và đặc biệt cho nước hoa.&nbsp;</p><p style=\"margin-right: 0px; margin-bottom: 1rem; margin-left: 0px; color: rgb(0, 0, 0); line-height: 1.65; scroll-behavior: smooth; padding: 0px; font-family: &quot;Space Grotesk&quot;, sans-serif; font-size: 16px; text-align: justify;\">BKPerfume gợi ý nước hoa phù hợp cho bạn: BKPerfume BKPerfume Vàng, BKPerfume&nbsp;&nbsp;Goodmen Xanh</p><p style=\"margin-right: 0px; margin-bottom: 1rem; margin-left: 0px; color: rgb(0, 0, 0); line-height: 1.65; scroll-behavior: smooth; padding: 0px; font-family: &quot;Space Grotesk&quot;, sans-serif; font-size: 16px; text-align: justify;\"></p><p style=\"margin-right: 0px; margin-bottom: 1rem; margin-left: 0px; color: rgb(0, 0, 0); line-height: 1.65; scroll-behavior: smooth; padding: 0px; font-family: &quot;Space Grotesk&quot;, sans-serif; font-size: 16px; text-align: justify;\"><img src=\"/posts/images/image_17333049664533.jpg\" /><span style=\"scroll-behavior: smooth; margin: 0px; padding: 0px; font-weight: bolder;\"><br style=\"scroll-behavior: smooth; margin: 0px; padding: 0px;\"></span></p><p style=\"margin-right: 0px; margin-bottom: 1rem; margin-left: 0px; color: rgb(0, 0, 0); line-height: 1.65; scroll-behavior: smooth; padding: 0px; font-family: &quot;Space Grotesk&quot;, sans-serif; font-size: 16px; text-align: justify;\"><span style=\"scroll-behavior: smooth; margin: 0px; padding: 0px; font-weight: bolder;\">2. Nước hoa cho nam theo phong cách sang trọng, hiện đại<br style=\"scroll-behavior: smooth; margin: 0px; padding: 0px;\"></span></p><p style=\"margin-right: 0px; margin-bottom: 1rem; margin-left: 0px; color: rgb(0, 0, 0); line-height: 1.65; scroll-behavior: smooth; padding: 0px; font-family: &quot;Space Grotesk&quot;, sans-serif; font-size: 16px; text-align: justify;\">Với phong cách này, bạn có thể tìm kiếm các loại nước hoa nam trung tính và cân bằng. Mùi hương gỗ, hoa quả, và các loại hương thảo mộc nhẹ sẽ phù hợp với phong cách lịch lãm và tự tin của người đàn ông trưởng thành và hiện đại.<br style=\"scroll-behavior: smooth; margin: 0px; padding: 0px;\"></p><p style=\"margin-right: 0px; margin-bottom: 1rem; margin-left: 0px; color: rgb(0, 0, 0); line-height: 1.65; scroll-behavior: smooth; padding: 0px; font-family: &quot;Space Grotesk&quot;, sans-serif; font-size: 16px; text-align: justify;\">BKPerfume gợi ý nước hoa phù hợp cho bạn: BKPerfume&nbsp;&nbsp;Lavish<br style=\"scroll-behavior: smooth; margin: 0px; padding: 0px;\"></p><p style=\"margin-right: 0px; margin-bottom: 1rem; margin-left: 0px; color: rgb(0, 0, 0); line-height: 1.65; scroll-behavior: smooth; padding: 0px; font-family: &quot;Space Grotesk&quot;, sans-serif; font-size: 16px; text-align: justify;\"><img src=\"https://api.fostech.vn/public/file/shared/64dc3c76e10d2a69850fc099\" width=\"915\" height=\"915\" style=\"scroll-behavior: smooth; margin: 0px; padding: 0px; max-width: 100%; height: auto;\"></p><p style=\"margin-right: 0px; margin-bottom: 1rem; margin-left: 0px; color: rgb(0, 0, 0); line-height: 1.65; scroll-behavior: smooth; padding: 0px; font-family: &quot;Space Grotesk&quot;, sans-serif; font-size: 16px; text-align: justify;\"><span style=\"scroll-behavior: smooth; margin: 0px; padding: 0px; font-weight: bolder;\"><br style=\"scroll-behavior: smooth; margin: 0px; padding: 0px;\"></span></p><p style=\"margin-right: 0px; margin-bottom: 1rem; margin-left: 0px; color: rgb(0, 0, 0); line-height: 1.65; scroll-behavior: smooth; padding: 0px; font-family: &quot;Space Grotesk&quot;, sans-serif; font-size: 16px; text-align: justify;\"><span style=\"scroll-behavior: smooth; margin: 0px; padding: 0px; font-weight: bolder;\">3. Nước hoa nam theo phong cách táo bạo, cuốn hút</span>&nbsp;</p><p style=\"margin-right: 0px; margin-bottom: 1rem; margin-left: 0px; color: rgb(0, 0, 0); line-height: 1.65; scroll-behavior: smooth; padding: 0px; font-family: &quot;Space Grotesk&quot;, sans-serif; font-size: 16px; text-align: justify;\">Nếu bạn là một người đàn ông theo phong cách táo bạo và muốn tìm một loại nước hoa phù hợp, bạn có thể lựa chọn những hương thơm từ gỗ như gỗ đàn hương, gỗ tuyết tùng, đậu Tonka, sự hòa trộn táo bạo và bí ẩn, tạo ra một dư vị nam tính và cuốn hút.&nbsp;</p><p style=\"margin-right: 0px; margin-bottom: 1rem; margin-left: 0px; color: rgb(0, 0, 0); line-height: 1.65; scroll-behavior: smooth; padding: 0px; font-family: &quot;Space Grotesk&quot;, sans-serif; font-size: 16px; text-align: justify;\">BKPerfume&nbsp;&nbsp;gợi ý nước hoa phù hợp cho bạn:BKPerfume&nbsp;&nbsp;Man In Black</p><p style=\"margin-right: 0px; margin-bottom: 1rem; margin-left: 0px; color: rgb(0, 0, 0); line-height: 1.65; scroll-behavior: smooth; padding: 0px; font-family: &quot;Space Grotesk&quot;, sans-serif; font-size: 16px; text-align: justify;\"><img src=\"https://api.fostech.vn/public/file/shared/64dc3c76e10d2a69850fc090\" width=\"915\" height=\"915\" style=\"scroll-behavior: smooth; margin: 0px; padding: 0px; max-width: 100%; height: auto;\"></p>', 'public', 'enabled', 'posts/images/1733461925-versace-pour-homme-dylan-blue_5.jpg.webp', 1, '2024-11-05 01:36:38', '2024-12-22 08:23:37', 'goi-y-chon-nuoc-hoa-nam-phu-hop', 'nước hoa, nước hoa nam, nước hoa chính hãng', 60),
(32, 'Dior Homme Intense lựa chọn hoàn hảo cho sự kiện trang trọng', 'Kiến thức về nước hoa', 'Dior Homme Intense sẽ giúp bạn xây dựng hình ảnh của một người đàn ông mạnh mẽ, tự tin và lịch lãm.', '<p style=\"margin-bottom: 1.3em; font-family: Roboto, Helvetica, sans-serif; color: rgb(22, 22, 24); font-size: 15.2px;\">Dior Homme Intense mở đầu với hương thơm tươi mát và nhẹ nhàng của hoa oải hương, mang lại cảm giác thanh khiết và dễ chịu. Hương giữa là sự kết hợp đầy gợi cảm giữa hoa diên vĩ và hương Ambrette, tạo nên một lớp hương đầy nam tính và sang trọng. Cuối cùng, hương gỗ tuyết tùng Virginia và cỏ hương bài mang lại sự ấm áp và bền bỉ cho tầng hương cuối, giúp hương thơm kéo dài và để lại ấn tượng sâu sắc.</p><p style=\"margin-bottom: 1.3em; font-family: Roboto, Helvetica, sans-serif; color: rgb(22, 22, 24); font-size: 15.2px;\">Dior Homme Intense mang lại cảm giác nam tính, lịch lãm và đầy gợi cảm. Đây là một mùi hương lý tưởng cho những buổi tối lãng mạn hoặc sự kiện trang trọng, nơi bạn muốn tỏa sáng và để lại ấn tượng mạnh mẽ. Hương thơm này toát lên vẻ đẹp nam tính, tinh tế và cuốn hút, khiến người sử dụng trở nên tự tin và phong cách.</p><p style=\"margin-bottom: 1.3em; font-family: Roboto, Helvetica, sans-serif; color: rgb(22, 22, 24); font-size: 15.2px;\">Thuộc nhóm hương Woody Floral Musk, Dior Homme Intense phù hợp với những người đàn ông tự tin, lịch lãm và có gu thẩm mỹ tinh tế. Họ thường là những người có phong cách riêng, biết cách chăm sóc bản thân và luôn mong muốn thể hiện cái tôi độc đáo.</p><p style=\"margin-bottom: 1.3em; font-family: Roboto, Helvetica, sans-serif; color: rgb(22, 22, 24); font-size: 15.2px;\">Dior Homme Intense sẽ giúp bạn xây dựng hình ảnh của một người đàn ông mạnh mẽ, tự tin và lịch lãm. Đây là mùi hương dành cho những ai muốn để lại ấn tượng sâu sắc và khó quên trong mắt người khác.</p><p><img src=\"/posts/images/image_17319364405271.jpg\" /><br></p>', 'public', 'enabled', 'posts/images/1731936440-dior-homme-intense_3-600x600.jpg.webp', 1, '2024-11-18 06:27:20', '2024-12-22 06:34:15', 'dior-homme-intense-lua-chon-hoan-hao-cho-su-kien-trang-trong', 'nước hoa, nước hoa nam', 22);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `gender` int NOT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `trending` int NOT NULL DEFAULT '0',
  `view` int NOT NULL DEFAULT '0',
  `affiliate` int NOT NULL DEFAULT '1',
  `status` int NOT NULL DEFAULT '1',
  `is_deleted` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `price`, `gender`, `images`, `short_description`, `detail_description`, `trending`, `view`, `affiliate`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(30, 1, 'Versace Eros EDT', 'versace-eros-edt', 100, 1, '../admin_assets/images/product/versace-eros_1.jpg.webp,../admin_assets/images/product/versace-eros_2.jpg.webp,../admin_assets/images/product/versace-eros_4.jpg.webp', 'Một biểu tượng của sự mạnh mẽ và đam mê, hoàn hảo cho những buổi hẹn hò đầy lãng mạn và các sự kiện quan trọng.', '<p style=\"margin-bottom: 1.3em; font-family: Roboto, Helvetica, sans-serif; color: rgb(22, 22, 24); font-size: 15.2px;\">Versace Eros là một hương thơm thuộc nhóm Aromatic Fougere, được ra mắt vào năm 2012 bởi nhà sáng tạo Aurelien Guichard. Đây là sự kết hợp hoàn hảo giữa sức mạnh và đam mê, lấy cảm hứng từ thần thoại Hy Lạp và hình ảnh vị thần tình yêu Eros.</p><ul style=\"list-style-position: initial; list-style-image: initial; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; margin-bottom: 1.3em; font-family: Roboto, Helvetica, sans-serif; color: rgb(22, 22, 24); font-size: 15.2px;\"><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Top note (hương đầu):</span>&nbsp;Bạc hà, táo xanh, chanh</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Heart note (hương giữa):</span>&nbsp;Đậu Tonka, hoa phong lữ, Ambroxan</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Base note (hương cuối):</span>&nbsp;Vanilla, cỏ vetiver, rêu sồi, tuyết tùng, gỗ đàn hương</li></ul><p style=\"margin-bottom: 1.3em; font-family: Roboto, Helvetica, sans-serif; color: rgb(22, 22, 24); font-size: 15.2px;\">Versace Eros mở đầu với sự tươi mát của bạc hà, táo xanh và chanh, tạo cảm giác sảng khoái và tràn đầy năng lượng. Hương giữa phát triển với sự ấm áp và ngọt ngào của đậu Tonka, hoa phong lữ và Ambroxan, mang lại cảm giác gợi cảm và lôi cuốn. Cuối cùng, hương vanilla, cỏ vetiver, rêu sồi và các loại gỗ tạo nên một nền tảng mạnh mẽ và nam tính, kéo dài độ lưu hương và sự quyến rũ.</p><p style=\"margin-bottom: 1.3em; font-family: Roboto, Helvetica, sans-serif; color: rgb(22, 22, 24); font-size: 15.2px;\">Hương thơm của Versace Eros EDT mang lại cảm giác tự tin, mạnh mẽ và đầy cuốn hút. Đây là một mùi hương lý tưởng cho các buổi tối hẹn hò, sự kiện quan trọng hoặc khi bạn muốn tạo ấn tượng mạnh mẽ.</p><p style=\"margin-bottom: 1.3em; font-family: Roboto, Helvetica, sans-serif; color: rgb(22, 22, 24); font-size: 15.2px;\">Versace Eros thuộc nhóm hương Aromatic Fougere, phù hợp với những người đàn ông mạnh mẽ, quyết đoán và đầy đam mê. Những người này thường có phong cách sống năng động, luôn tự tin và khao khát chinh phục thử thách. Họ là những người biết cách thể hiện bản thân và không ngại khẳng định cái tôi trong mắt người đối diện.</p><p style=\"margin-bottom: 1.3em; font-family: Roboto, Helvetica, sans-serif; color: rgb(22, 22, 24); font-size: 15.2px;\">Với Versace Eros, bạn sẽ xây dựng được hình ảnh một quý ông quyến rũ, đầy tự tin và phong cách. Đây là sự lựa chọn hoàn hảo để bạn trở nên nổi bật và cuốn hút trong mọi hoàn cảnh.</p><ul style=\"list-style-position: initial; list-style-image: initial; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; margin-bottom: 1.3em; font-family: Roboto, Helvetica, sans-serif; color: rgb(22, 22, 24); font-size: 15.2px;\"><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Độ lưu hương:</span>&nbsp;4/5</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Độ tỏa hương:</span>&nbsp;4/5</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Nịnh mũi:</span>&nbsp;4.5/5</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Thời điểm:</span>&nbsp;Thích hợp dùng vào buổi tối, trong các sự kiện, hẹn hò và những dịp đặc biệt.</li></ul>', 0, 60, 1, 1, 0, '2024-11-09 08:57:13', '2024-12-23 01:13:25'),
(41, 1, 'Dior Sauvage EDP', 'dior-sauvage-edp', 100, 1, '../admin_assets/images/product/dior-sauvage-edp_1.jpg.webp,../admin_assets/images/product/dior-sauvage-edp_2.jpg.webp,../admin_assets/images/product/dior-sauvage-edp_4.jpg.webp', 'Hương thơm nam tính và ấm áp, lý tưởng cho những buổi tối lãng mạn.', '<div id=\"text-2621798131\" class=\"text\" style=\"font-family: Roboto, Helvetica, sans-serif; font-size: 1.2rem;\"><h2 style=\"font-size: 1.6em; margin-bottom: 0.5em; text-rendering: optimizespeed; width: 807.5px; line-height: 1.3; font-weight: 700;\"><font color=\"#000000\">Chi tiết về sản phẩm</font></h2></div><div id=\"gap-1119934897\" class=\"gap-element clearfix\" style=\"font-family: Roboto, Helvetica, sans-serif; padding-top: 10px; font-size: 15.2px; height: auto;\"></div><div class=\"custom-attributes\" style=\"font-family: Roboto, Helvetica, sans-serif; margin-bottom: 20px; font-size: 15.2px;\"><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Phân loại:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/nuoc-hoa/\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Nước hoa</font></a></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Thương hiệu:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/dior-vn/\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Dior</font></a></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Xuất xứ:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><font color=\"#000000\">Pháp</font></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Năm phát hành:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><font color=\"#000000\">2018</font></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Nồng độ:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/nong-do/eau-de-parfum-edp/\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Eau de Parfum (EDP)</font></a></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Nhóm hương:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/nhom-huong/amber-fougere\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Amber Fougere</font></a></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Nhà chế tác:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/nha-che-tac/francois-demachy\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Francois Demachy</font></a></span></p></div><div class=\"product-description\" style=\"font-family: Roboto, Helvetica, sans-serif; font-size: 15.2px;\"><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\">Dior Sauvage Eau de Parfum (EDP) là một hương thơm thuộc nhóm hương Aromatic Fougere, được ra mắt vào năm 2018. Được sáng tạo bởi nhà pha chế nước hoa François Demachy, Sauvage EDP mang đến một phiên bản đậm đà và sâu lắng hơn so với phiên bản EDT.</font></p><div class=\"fragrance-notes\" style=\"text-align: center; max-width: 600px; margin: 0px auto;\"><h3 style=\"margin-bottom: 0.5em; text-rendering: optimizespeed; width: 600px; font-size: 1.2em; font-weight: 700; background-image: linear-gradient(to right, rgb(255, 195, 160) 0%, rgb(255, 175, 189) 100%); padding: 5px 10px; display: inline-block; border-radius: 5px;\"><font color=\"#000000\">Hương đầu:</font></h3><div class=\"notes-container top-notes\" style=\"display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; padding-bottom: 2em;\"><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/bergamot.webp\" alt=\"Quả Cam Đắng (Bergamot)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Quả Cam Đắng (Bergamot)</span></div></div><h3 style=\"margin-bottom: 0.5em; text-rendering: optimizespeed; width: 600px; font-size: 1.2em; font-weight: 700; background-image: linear-gradient(to right, rgb(255, 195, 160) 0%, rgb(255, 175, 189) 100%); padding: 5px 10px; display: inline-block; border-radius: 5px;\"><font color=\"#000000\">Hương giữa:</font></h3><div class=\"notes-container middle-notes\" style=\"display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; padding-bottom: 2em;\"><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/sichuan-pepper.webp\" alt=\"Tiêu Sichuan (Sichuan Pepper)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Tiêu Sichuan (Sichuan Pepper)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/lavender.webp\" alt=\"Hoa Oải Hương (Lavender)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hoa Oải Hương (Lavender)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/star-anise.webp\" alt=\"Đại Hồi (Star Anise)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Đại Hồi (Star Anise)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/nutmeg.webp\" alt=\"Nhục Đậu Khấu (Nutmeg)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Nhục Đậu Khấu (Nutmeg)</span></div></div><h3 style=\"margin-bottom: 0.5em; text-rendering: optimizespeed; width: 600px; font-size: 1.2em; font-weight: 700; background-image: linear-gradient(to right, rgb(255, 195, 160) 0%, rgb(255, 175, 189) 100%); padding: 5px 10px; display: inline-block; border-radius: 5px;\"><font color=\"#000000\">Hương cuối:</font></h3><div class=\"notes-container base-notes\" style=\"display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; padding-bottom: 2em;\"><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/ambroxan.webp\" alt=\"Long Diên Hương (Ambroxan/ Ambergris)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Long Diên Hương (Ambroxan/ Ambergris)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/vanilla.webp\" alt=\"Hương Va-ni (Vanilla)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hương Va-ni (Vanilla)</span></div></div></div><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\">Dior Sauvage EDP mở đầu với hương cam bergamot Calabria tươi mát và mạnh mẽ, mang lại cảm giác sảng khoái và cuốn hút. Hương giữa là sự hòa quyện của tiêu Sichuan cay nồng, hoa oải hương thơm ngát, nhục đậu khấu và hồi, tạo nên một lớp hương đầy phức tạp và tinh tế. Tầng hương cuối với ambroxan và vanilla mang đến sự ấm áp, sâu lắng và gợi cảm, giúp hương thơm kéo dài và để lại ấn tượng mạnh mẽ.</font></p><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\">Dior Sauvage EDP mang lại cảm giác ấm áp, mạnh mẽ và đầy nam tính. Hương thơm này rất phù hợp khi sử dụng trong những buổi tối lãng mạn, các sự kiện quan trọng hoặc những dịp đặc biệt. Nó toát lên vẻ tự tin và cuốn hút, khiến người sử dụng trở thành tâm điểm chú ý.</font></p><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\">Thuộc nhóm hương Aromatic Fougere, Dior Sauvage EDP phù hợp với những người đàn ông mạnh mẽ, tự tin và có phong cách riêng. Họ thường là những người yêu thích sự sang trọng, tinh tế và luôn tìm kiếm sự hoàn hảo. Mùi hương này giúp họ thể hiện sự mạnh mẽ, quyến rũ và đẳng cấp của mình.</font></p><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\">Sử dụng Dior Sauvage EDP sẽ giúp bạn xây dựng hình ảnh của một người đàn ông tự tin, mạnh mẽ và đầy sức hút. Đây là mùi hương dành cho những ai muốn để lại ấn tượng sâu sắc và khó quên trong mắt người khác.</font></p><ul style=\"list-style-position: initial; list-style-image: initial; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; margin-bottom: 1.3em;\"><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Độ lưu hương:</span>&nbsp;5/5</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Độ tỏa hương:</span>&nbsp;4/5</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Nịnh mũi:</span>&nbsp;4/5</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Thời điểm:</span>&nbsp;Thích hợp cho buổi tối, sự kiện quan trọng và các dịp đặc biệt.</li></ul></div>', 0, 38, 1, 1, 0, '2024-11-15 08:12:42', '2024-12-09 05:55:32'),
(42, 1, 'Versace Dylan Blue EDT', 'versace-dylan-blue-edt', 100, 1, '../admin_assets/images/product/versace-pour-homme-dylan-blue_1.jpg.webp,../admin_assets/images/product/versace-pour-homme-dylan-blue_2.jpg.webp,../admin_assets/images/product/versace-pour-homme-dylan-blue_5.jpg.webp', 'Sự kết hợp giữa sự tươi mát và nam tính mạnh mẽ, hoàn hảo cho các buổi hẹn hò và những dịp đặc biệt.', '<div id=\"text-2006041815\" class=\"text\" style=\"font-family: Roboto, Helvetica, sans-serif; font-size: 1.2rem;\"><h2 style=\"font-size: 1.6em; margin-bottom: 0.5em; text-rendering: optimizespeed; width: 807.5px; line-height: 1.3; font-weight: 700;\"><font color=\"#000000\">Chi tiết về sản phẩm</font></h2></div><div id=\"gap-1539745639\" class=\"gap-element clearfix\" style=\"font-family: Roboto, Helvetica, sans-serif; padding-top: 10px; font-size: 15.2px; height: auto;\"></div><div class=\"custom-attributes\" style=\"font-family: Roboto, Helvetica, sans-serif; margin-bottom: 20px; font-size: 15.2px;\"><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Phân loại:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/nuoc-hoa/\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Nước hoa</font></a></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Thương hiệu:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/versace-vn/\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Versace</font></a></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Xuất xứ:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><font color=\"#000000\">Ý</font></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Năm phát hành:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><font color=\"#000000\">2016</font></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Nồng độ:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/nong-do/eau-de-toilette-edt/\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Eau de Toilette (EDT)</font></a></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Nhà chế tác:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/nha-che-tac/alberto-morillas\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Alberto Morillas</font></a></span></p></div><div class=\"product-description\" style=\"font-family: Roboto, Helvetica, sans-serif; font-size: 15.2px;\"><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\">Versace Dylan Blue là một hương thơm thuộc nhóm Aromatic Fougere, được ra mắt vào năm 2016. Được tạo ra bởi nhà sáng tạo Alberto Morillas, chai nước hoa này thể hiện sự mạnh mẽ, tự tin và quyến rũ của người đàn ông hiện đại.</font></p><div class=\"fragrance-notes\" style=\"text-align: center; max-width: 600px; margin: 0px auto;\"><h3 style=\"margin-bottom: 0.5em; text-rendering: optimizespeed; width: 600px; font-size: 1.2em; font-weight: 700; background-image: linear-gradient(to right, rgb(255, 195, 160) 0%, rgb(255, 175, 189) 100%); padding: 5px 10px; display: inline-block; border-radius: 5px;\"><font color=\"#000000\">Hương đầu:</font></h3><div class=\"notes-container top-notes\" style=\"display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; padding-bottom: 2em;\"><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/calabrian-bergamot.webp\" alt=\"Cam Đắng Calabrian (Calabrian Bergamot)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Cam Đắng Calabrian (Calabrian Bergamot)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/water-note.webp\" alt=\"Hương Nước (Water Notes)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hương Nước (Water Notes)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/grapefruit.webp\" alt=\"Quả Bưởi Tây (Grapefruit)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Quả Bưởi Tây (Grapefruit)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/italian-fig-leaves.webp\" alt=\"Lá Sung (Fig Leaf)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Lá Sung (Fig Leaf)</span></div></div><h3 style=\"margin-bottom: 0.5em; text-rendering: optimizespeed; width: 600px; font-size: 1.2em; font-weight: 700; background-image: linear-gradient(to right, rgb(255, 195, 160) 0%, rgb(255, 175, 189) 100%); padding: 5px 10px; display: inline-block; border-radius: 5px;\"><font color=\"#000000\">Hương giữa:</font></h3><div class=\"notes-container middle-notes\" style=\"display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; padding-bottom: 2em;\"><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/ambroxan.webp\" alt=\"Long Diên Hương (Ambroxan/ Ambergris)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Long Diên Hương (Ambroxan/ Ambergris)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/black-pepper.webp\" alt=\"Tiêu Đen (Black Pepper)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Tiêu Đen (Black Pepper)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/patchouli.webp\" alt=\"Hoắc Hương (Patchouli)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hoắc Hương (Patchouli)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/violet-leaf.webp\" alt=\"Lá Hoa Violet (Violet Leaf)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Lá Hoa Violet (Violet Leaf)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/papyrus.webp\" alt=\"Cây Papyrus\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Cây Papyrus</span></div></div><h3 style=\"margin-bottom: 0.5em; text-rendering: optimizespeed; width: 600px; font-size: 1.2em; font-weight: 700; background-image: linear-gradient(to right, rgb(255, 195, 160) 0%, rgb(255, 175, 189) 100%); padding: 5px 10px; display: inline-block; border-radius: 5px;\"><font color=\"#000000\">Hương cuối:</font></h3><div class=\"notes-container base-notes\" style=\"display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; padding-bottom: 2em;\"><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/incense.webp\" alt=\"Mùi Khói Thơm (Incense)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Mùi Khói Thơm (Incense)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/musks.webp\" alt=\"Xạ Hương (Musk)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Xạ Hương (Musk)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/tonka-bean.webp\" alt=\"Đậu Tonka (Tonka Bean)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Đậu Tonka (Tonka Bean)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/saffron.webp\" alt=\"Hoa Nghệ Tây (Saffron)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hoa Nghệ Tây (Saffron)</span></div></div></div><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\">Versace Dylan Blue mở đầu với sự tươi mát của quả bưởi, cam bergamot Calabria và nước, kết hợp với lá vả tạo nên một cảm giác sảng khoái và tràn đầy năng lượng. Hương giữa được xây dựng bởi lá violet, gỗ Papyrus, cây hoắc hương và hương tiêu đen, mang lại một tầng hương đầy nam tính và mạnh mẽ. Cuối cùng, hương xạ hương, hương trầm, đậu Tonka và nghệ tây tạo nên một nền tảng ấm áp, quyến rũ và bền vững.</font></p><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\">Hương thơm của Versace Dylan Blue mang lại cảm giác tươi mát, mạnh mẽ và đầy nam tính. Đây là một mùi hương lý tưởng cho các buổi tối hẹn hò, sự kiện quan trọng hoặc khi bạn muốn tạo ấn tượng mạnh mẽ và đầy tự tin.</font></p><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\">Versace Dylan Blue thuộc nhóm hương Aromatic Fougere, phù hợp với những người đàn ông mạnh mẽ, tự tin và năng động. Những người này có phong cách sống hiện đại, luôn tìm kiếm sự mới mẻ và không ngại thử thách. Họ là những người biết cách tạo dựng hình ảnh và luôn muốn trở thành tâm điểm của mọi sự chú ý.</font></p><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\">Sử dụng Versace Dylan Blue, bạn sẽ xây dựng được hình ảnh một quý ông hiện đại, phong cách và đầy quyến rũ. Đây là sự lựa chọn hoàn hảo để bạn trở nên nổi bật và ghi dấu ấn mạnh mẽ trong mắt mọi người.</font></p><ul style=\"list-style-position: initial; list-style-image: initial; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; margin-bottom: 1.3em;\"><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Độ lưu hương:</span>&nbsp;4/5</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Độ tỏa hương:</span>&nbsp;4/5</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Nịnh mũi:</span>&nbsp;4.5/5</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Thời điểm:</span>&nbsp;Thích hợp dùng vào buổi tối, trong các sự kiện, hẹn hò và những dịp đặc biệt.</li></ul><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\">Versace Dylan Blue không chỉ là một chai nước hoa, mà là biểu tượng của sự mạnh mẽ và quyến rũ. Hãy để Versace Dylan Blue trở thành vũ khí bí mật của bạn trong hành trình chinh phục mọi thử thách và khẳng định bản thân.</font></p><div><br></div></div>', 0, 29, 1, 1, 0, '2024-11-15 08:17:05', '2024-12-18 07:42:22'),
(43, 2, 'Yves Saint Laurent Libre EDP', 'yves-saint-laurent-libre-edp', 100, 0, '../admin_assets/images/product/yves-saint-laurent-libre-edp_1-600x600.jpg.webp,../admin_assets/images/product/yves-saint-laurent-libre-edp_2-600x600.jpg.webp,../admin_assets/images/product/yves-saint-laurent-libre-edp_5-600x600.jpg.webp', 'Hương thơm tự do, quyến rũ, hoàn hảo cho các dịp đặc biệt và ngày thường.', '<div id=\"text-502803461\" class=\"text\" style=\"font-family: Roboto, Helvetica, sans-serif; font-size: 1.2rem;\"><h2 style=\"font-size: 1.6em; margin-bottom: 0.5em; text-rendering: optimizespeed; width: 807.5px; line-height: 1.3; font-weight: 700;\"><font color=\"#000000\">Chi tiết về sản phẩm</font></h2></div><div id=\"gap-1624624718\" class=\"gap-element clearfix\" style=\"font-family: Roboto, Helvetica, sans-serif; padding-top: 10px; font-size: 15.2px; height: auto;\"></div><div class=\"custom-attributes\" style=\"font-family: Roboto, Helvetica, sans-serif; margin-bottom: 20px; font-size: 15.2px;\"><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Phân loại:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/nuoc-hoa/\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Nước hoa</font></a></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Thương hiệu:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/yves-saint-laurent-vn/\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Yves Saint Laurent</font></a></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Xuất xứ:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><font color=\"#000000\">Pháp</font></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Năm phát hành:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><font color=\"#000000\">2019</font></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Nồng độ:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/nong-do/eau-de-parfum-edp/\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Eau de Parfum (EDP)</font></a></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Nhóm hương:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/nhom-huong/khong-co\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">KHÔNG CÓ</font></a></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Nhà chế tác:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><font color=\"#000000\"><a href=\"https://orchard.vn/nha-che-tac/anne-flipo\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\">Anne Flipo</a>,&nbsp;<a href=\"https://orchard.vn/nha-che-tac/carlos-benaim\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\">Carlos Benaim</a></font></span></p></div><div class=\"product-description\" style=\"font-family: Roboto, Helvetica, sans-serif; font-size: 15.2px;\"><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\">Yves Saint Laurent Libre EDP là một chai nước hoa thuộc nhóm hương Floral, ra mắt năm 2019. Được tạo ra bởi Anne Flipo và Carlos Benaim, Libre là sự kết hợp hài hòa giữa các hương liệu hoa cỏ và hương vani, thể hiện sự tự do và nữ tính mạnh mẽ.</font></p><div class=\"fragrance-notes\" style=\"text-align: center; max-width: 600px; margin: 0px auto;\"><h3 style=\"margin-bottom: 0.5em; text-rendering: optimizespeed; width: 600px; font-size: 1.2em; font-weight: 700; background-image: linear-gradient(to right, rgb(255, 195, 160) 0%, rgb(255, 175, 189) 100%); padding: 5px 10px; display: inline-block; border-radius: 5px;\"><font color=\"#000000\">Hương đầu:</font></h3><div class=\"notes-container top-notes\" style=\"display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; padding-bottom: 2em;\"><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/lavender.webp\" alt=\"Hoa Oải Hương (Lavender)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hoa Oải Hương (Lavender)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/mandarin-orange.webp\" alt=\"Quả Quýt (Mandarin Orange)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Quả Quýt (Mandarin Orange)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/blackcurrant.webp\" alt=\"Quả Lý Chua Đen (Black Currant)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Quả Lý Chua Đen (Black Currant)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/petitgrain.webp\" alt=\"Tinh Dầu Lá Cam (Petitgrain)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Tinh Dầu Lá Cam (Petitgrain)</span></div></div><h3 style=\"margin-bottom: 0.5em; text-rendering: optimizespeed; width: 600px; font-size: 1.2em; font-weight: 700; background-image: linear-gradient(to right, rgb(255, 195, 160) 0%, rgb(255, 175, 189) 100%); padding: 5px 10px; display: inline-block; border-radius: 5px;\"><font color=\"#000000\">Hương giữa:</font></h3><div class=\"notes-container middle-notes\" style=\"display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; padding-bottom: 2em;\"><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/lavender.webp\" alt=\"Hoa Oải Hương (Lavender)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hoa Oải Hương (Lavender)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/orange-blossom.webp\" alt=\"Hoa Cam (Orange Blossom)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hoa Cam (Orange Blossom)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/jasmine.webp\" alt=\"Hoa Nhài (Jasmine)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hoa Nhài (Jasmine)</span></div></div><h3 style=\"margin-bottom: 0.5em; text-rendering: optimizespeed; width: 600px; font-size: 1.2em; font-weight: 700; background-image: linear-gradient(to right, rgb(255, 195, 160) 0%, rgb(255, 175, 189) 100%); padding: 5px 10px; display: inline-block; border-radius: 5px;\"><font color=\"#000000\">Hương cuối:</font></h3><div class=\"notes-container base-notes\" style=\"display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; padding-bottom: 2em;\"><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/madagascar-vanilla.webp\" alt=\"Madagascar Vanilla\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Madagascar Vanilla</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/musks.webp\" alt=\"Xạ Hương (Musk)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Xạ Hương (Musk)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/cedar.webp\" alt=\"Gỗ Tuyết Tùng (Cedar)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Gỗ Tuyết Tùng (Cedar)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/ambroxan.webp\" alt=\"Long Diên Hương (Ambroxan/ Ambergris)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Long Diên Hương (Ambroxan/ Ambergris)</span></div></div></div><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\">Libre mở đầu với sự tươi mát và sảng khoái của lavender, mandarin orange, black currant và petitgrain. Tầng hương giữa tỏa sáng với sự quyến rũ của hoa oải hương, hoa cam và hoa nhài, mang lại cảm giác nữ tính và gợi cảm. Cuối cùng, tầng hương cuối với vani Madagascar, xạ hương, tuyết tùng và hổ phách, tạo nên một mùi hương ấm áp, bền lâu và cuốn hút.</font></p><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\">Hương thơm của Libre mang lại cảm giác tự do, quyến rũ và hiện đại, phù hợp với các dịp đặc biệt, công sở hay những ngày thường. Đây là mùi hương dễ gây ấn tượng và làm say lòng người đối diện.</font></p><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\">Thuộc nhóm hương Floral, Libre phù hợp với những người phụ nữ yêu thích sự tự do, mạnh mẽ và cá tính. Những người sử dụng mùi hương này thường có phong cách thời trang tinh tế, tự tin và luôn muốn thể hiện bản thân. Họ yêu thích sự độc đáo và luôn biết cách thu hút sự chú ý.</font></p><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\">Chai nước hoa này giúp xây dựng hình ảnh của một người phụ nữ tự do, hiện đại và đầy quyến rũ. Hương thơm của Libre không chỉ làm tăng thêm sự tự tin mà còn giúp người phụ nữ thể hiện được cá tính và phong cách riêng biệt của mình.</font></p><ul style=\"list-style-position: initial; list-style-image: initial; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; margin-bottom: 1.3em;\"><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Độ lưu hương:</span>&nbsp;4/5</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Độ tỏa hương:</span>&nbsp;4/5</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Nịnh mũi:</span>&nbsp;4.5/5</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Thời điểm:</span>&nbsp;Thích hợp dùng hằng ngày, công sở, sự kiện, hẹn hò</li></ul><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\">Yves Saint Laurent Libre EDP là sự lựa chọn hoàn hảo cho những ai tìm kiếm một mùi hương tự do, quyến rũ và bền lâu</font></p></div>', 0, 21, 1, 1, 0, '2024-11-15 08:32:10', '2024-12-23 03:59:17');
INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `price`, `gender`, `images`, `short_description`, `detail_description`, `trending`, `view`, `affiliate`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(44, 3, 'Armaf Club De Nuit Intense Man EDT Mini', 'armaf-club-de-nuit-intense-man-edt-mini', 100, 1, '../admin_assets/images/product/armaf-club-de-nuit-intense-man-edt-mini-10ml_1.jpg.webp,../admin_assets/images/product/armaf-club-de-nuit-intense-man-edt-mini-10ml_2.jpg.webp,../admin_assets/images/product/armaf-club-de-nuit-intense-man-edt-mini-10ml_3.jpg.webp', 'Hương thơm nam tính và mạnh mẽ, lý tưởng cho các buổi tiệc tối và những dịp quan trọng.', '<div style=\"text-align: justify;\"><span style=\"color: brown; font-family: Roboto, Helvetica, sans-serif; font-size: 1.2em; font-weight: 700; text-align: center;\">Hương đầu:</span></div><div class=\"notes-container top-notes\" style=\"font-family: Roboto, Helvetica, sans-serif; display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; padding-bottom: 2em; color: rgb(22, 22, 24); font-size: 15.2px; text-align: center;\"><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/lemon.webp\" alt=\"Chanh Vàng (Lemon)\" class=\"fragrance-image\" style=\"text-align: center; display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"text-align: center; display: block; margin-top: 5px;\">Chanh Vàng (Lemon)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/pineapple.webp\" alt=\"Dứa (Pineapple)\" class=\"fragrance-image\" style=\"text-align: center; display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"text-align: center; display: block; margin-top: 5px;\">Dứa (Pineapple)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/bergamot.webp\" alt=\"Quả Cam Đắng (Bergamot)\" class=\"fragrance-image\" style=\"text-align: center; display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"text-align: center; display: block; margin-top: 5px;\">Quả Cam Đắng (Bergamot)</span></div></div><h3 style=\"color: brown; margin-bottom: 0.5em; text-rendering: optimizespeed; width: 600px; font-size: 1.2em; font-family: Roboto, Helvetica, sans-serif; font-weight: 700; background-image: linear-gradient(to right, rgb(255, 195, 160) 0%, rgb(255, 175, 189) 100%); padding: 5px 10px; display: inline-block; border-radius: 5px; text-align: center;\"><div style=\"text-align: center;\"><span style=\"font-size: 1.2em;\">Hương giữa:</span></div></h3><div class=\"notes-container middle-notes\" style=\"font-family: Roboto, Helvetica, sans-serif; display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; padding-bottom: 2em; color: rgb(22, 22, 24); font-size: 15.2px; text-align: center;\"><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/11/unknown.jpg.webp\" alt=\"Cây Bạch Dương (Birch)\" class=\"fragrance-image\" style=\"text-align: center; display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"text-align: center; display: block; margin-top: 5px;\">Cây Bạch Dương (Birch)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/jasmine.webp\" alt=\"Hoa Nhài (Jasmine)\" class=\"fragrance-image\" style=\"text-align: center; display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"text-align: center; display: block; margin-top: 5px;\">Hoa Nhài (Jasmine)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/red-rose.webp\" alt=\"Hoa Hồng (Rose)\" class=\"fragrance-image\" style=\"text-align: center; display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"text-align: center; display: block; margin-top: 5px;\">Hoa Hồng (Rose)</span></div></div><h3 style=\"color: brown; margin-bottom: 0.5em; text-rendering: optimizespeed; width: 600px; font-size: 1.2em; font-family: Roboto, Helvetica, sans-serif; font-weight: 700; background-image: linear-gradient(to right, rgb(255, 195, 160) 0%, rgb(255, 175, 189) 100%); padding: 5px 10px; display: inline-block; border-radius: 5px; text-align: center;\"><div style=\"text-align: center;\"><span style=\"font-size: 1.2em;\">Hương cuối:</span></div></h3><div class=\"notes-container base-notes\" style=\"font-family: Roboto, Helvetica, sans-serif; display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; padding-bottom: 2em; color: rgb(22, 22, 24); font-size: 15.2px; text-align: center;\"><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/musks.webp\" alt=\"Xạ Hương (Musk)\" class=\"fragrance-image\" style=\"text-align: center; display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"text-align: center; display: block; margin-top: 5px;\">Xạ Hương (Musk)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/ambroxan.webp\" alt=\"Long Diên Hương (Ambroxan/ Ambergris)\" class=\"fragrance-image\" style=\"text-align: center; display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"text-align: center; display: block; margin-top: 5px;\">Long Diên Hương (Ambroxan/ Ambergris)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/patchouli.webp\" alt=\"Hoắc Hương (Patchouli)\" class=\"fragrance-image\" style=\"text-align: center; display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"text-align: center; display: block; margin-top: 5px;\">Hoắc Hương (Patchouli)</span></div></div>', 0, 22, 1, 1, 0, '2024-11-15 08:38:32', '2024-12-23 03:58:19'),
(45, 1, 'Giorgio Armani Acqua Di Gio Pour Homme EDT', 'giorgio-armani-acqua-di-gio-pour-homme-edt', 100, 1, '../admin_assets/images/product/giorgio-armani-acqua-di-gio-pour-homme_1-600x600.jpg.webp,../admin_assets/images/product/giorgio-armani-acqua-di-gio-pour-homme_2-600x600.jpg.webp,../admin_assets/images/product/giorgio-armani-acqua-di-gio-pour-homme_3-600x600.jpg.webp', 'Hương thơm tươi mát và thanh lịch, lý tưởng cho những ngày hè và các hoạt động ngoài trời.', '<div id=\"text-1299567682\" class=\"text\" style=\"font-family: Roboto, Helvetica, sans-serif; font-size: 1.2rem;\"><h2 style=\"font-size: 1.6em; margin-bottom: 0.5em; text-rendering: optimizespeed; width: 807.5px; line-height: 1.3; font-weight: 700;\"><font color=\"#000000\">Chi tiết về sản phẩm</font></h2></div><div id=\"gap-1382223876\" class=\"gap-element clearfix\" style=\"font-family: Roboto, Helvetica, sans-serif; padding-top: 10px; font-size: 15.2px; height: auto;\"></div><div class=\"custom-attributes\" style=\"font-family: Roboto, Helvetica, sans-serif; margin-bottom: 20px; font-size: 15.2px;\"><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Phân loại:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/nuoc-hoa/\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Nước hoa</font></a></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Thương hiệu:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/giorgio-armani-vn/\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Giorgio Armani</font></a></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Xuất xứ:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><font color=\"#000000\">Pháp</font></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Năm phát hành:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><font color=\"#000000\">1995</font></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Nồng độ:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/nong-do/eau-de-toilette-edt/\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Eau de Toilette (EDT)</font></a></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Nhóm hương:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/nhom-huong/aromatic-aquatic\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Aromatic Aquatic (Hương Thơm Biển)</font></a></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Nhà chế tác:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/nha-che-tac/khong-co\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">KHÔNG CÓ</font></a></span></p></div><div class=\"product-description\" style=\"font-family: Roboto, Helvetica, sans-serif; font-size: 15.2px;\"><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\">Giorgio Armani Acqua Di Gio Pour Homme là một hương thơm thuộc nhóm hương Aromatic Aquatic, được ra mắt vào năm 1996. Được sáng tạo bởi nhà pha chế nước hoa nổi tiếng Alberto Morillas, Acqua Di Gio Pour Homme mang đến một phong cách tươi mát, nhẹ nhàng và đầy nam tính, gợi nhớ đến vẻ đẹp tự nhiên của đảo Pantelleria, nơi Giorgio Armani đã dành kỳ nghỉ.</font></p><div class=\"fragrance-notes\" style=\"text-align: center; max-width: 600px; margin: 0px auto;\"><h3 style=\"margin-bottom: 0.5em; text-rendering: optimizespeed; width: 600px; font-size: 1.2em; font-weight: 700; background-image: linear-gradient(to right, rgb(255, 195, 160) 0%, rgb(255, 175, 189) 100%); padding: 5px 10px; display: inline-block; border-radius: 5px;\"><font color=\"#000000\">Hương đầu:</font></h3><div class=\"notes-container top-notes\" style=\"display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; padding-bottom: 2em;\"><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/water-note.webp\" alt=\"Hương Nước (Water Notes)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hương Nước (Water Notes)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/bergamot.webp\" alt=\"Quả Cam Đắng (Bergamot)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Quả Cam Đắng (Bergamot)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/mandarin-orange.webp\" alt=\"Quả Quýt (Mandarin Orange)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Quả Quýt (Mandarin Orange)</span></div></div><h3 style=\"margin-bottom: 0.5em; text-rendering: optimizespeed; width: 600px; font-size: 1.2em; font-weight: 700; background-image: linear-gradient(to right, rgb(255, 195, 160) 0%, rgb(255, 175, 189) 100%); padding: 5px 10px; display: inline-block; border-radius: 5px;\"><font color=\"#000000\">Hương giữa:</font></h3><div class=\"notes-container middle-notes\" style=\"display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; padding-bottom: 2em;\"><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/jasmine.webp\" alt=\"Hoa Nhài (Jasmine)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hoa Nhài (Jasmine)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/11/unknown.jpg.webp\" alt=\"Quả Hồng (Persimmon)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Quả Hồng (Persimmon)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/11/unknown.jpg.webp\" alt=\"Cải Xoong (Nasturtium)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Cải Xoong (Nasturtium)</span></div></div><h3 style=\"margin-bottom: 0.5em; text-rendering: optimizespeed; width: 600px; font-size: 1.2em; font-weight: 700; background-image: linear-gradient(to right, rgb(255, 195, 160) 0%, rgb(255, 175, 189) 100%); padding: 5px 10px; display: inline-block; border-radius: 5px;\"><font color=\"#000000\">Hương cuối:</font></h3><div class=\"notes-container base-notes\" style=\"display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; padding-bottom: 2em;\"><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/patchouli.webp\" alt=\"Hoắc Hương (Patchouli)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hoắc Hương (Patchouli)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/amber.webp\" alt=\"Hổ Phách (Amber)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hổ Phách (Amber)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/neroli.webp\" alt=\"Tinh Dầu Hoa Cam (Neroli)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Tinh Dầu Hoa Cam (Neroli)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/rosemary.webp\" alt=\"Cây Hương Thảo (Rosemary)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Cây Hương Thảo (Rosemary)</span></div></div></div><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\">Giorgio Armani Acqua Di Gio Pour Homme mở đầu với sự tươi mát và sảng khoái của cam Bergamot, quả chanh, quả chanh vàng, cam quýt, hoa cam và quả chanh xanh, mang lại cảm giác tràn đầy năng lượng và sảng khoái. Hương giữa là sự hòa quyện tinh tế của hương biển, hoa nhài, hoa hồng, lá đào, cây hương thảo, hoa tím, nhục đậu khấu và mộc tê, tạo nên một lớp hương phong phú và thanh lịch. Cuối cùng, tầng hương cuối với hổ phách, hoắc hương, xạ hương và gỗ tuyết tùng mang lại cảm giác ấm áp, sâu lắng và bền bỉ.</font></p><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\">Acqua Di Gio Pour Homme mang lại cảm giác tươi mát, tự tin và đầy nam tính. Hương thơm này rất phù hợp khi sử dụng trong những ngày hè nóng bức, các hoạt động ngoài trời hoặc những chuyến du lịch biển. Nó toát lên vẻ năng động và thanh lịch, giúp người sử dụng trở nên nổi bật và cuốn hút.</font></p><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\">Thuộc nhóm hương Aromatic Aquatic, Giorgio Armani Acqua Di Gio Pour Homme phù hợp với những người đàn ông năng động, tự tin và yêu thích sự tươi mát. Họ thường là những người có phong cách sống hiện đại, yêu thích thể thao và các hoạt động ngoài trời. Mùi hương này giúp họ thể hiện sự mạnh mẽ, khỏe khoắn và cuốn hút của mình một cách tự nhiên.</font></p><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\">Acqua Di Gio Pour Homme sẽ giúp bạn xây dựng hình ảnh của một người đàn ông năng động, tự tin và đầy sức sống. Đây là mùi hương dành cho những ai muốn để lại ấn tượng tích cực và khó quên trong mắt người khác.</font></p><ul style=\"list-style-position: initial; list-style-image: initial; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; margin-bottom: 1.3em;\"><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Độ lưu hương:</span>&nbsp;3/5</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Độ tỏa hương:</span>&nbsp;3/5</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Nịnh mũi:</span>&nbsp;4/5</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Thời điểm:</span>&nbsp;Thích hợp cho ban ngày, mùa hè, các hoạt động ngoài trời và du lịch biển.</li></ul></div>', 0, 20, 1, 1, 0, '2024-11-15 20:51:50', '2024-12-22 01:40:30'),
(46, 3, 'Giorgio Armani Acqua Di Gio Parfum Mini', 'giorgio-armani-acqua-di-gio-parfum-mini', 100, 1, '../admin_assets/images/product/giorgio-armani-acqua-di-gio-parfum-mini-5ml_1-600x600.jpg.webp,../admin_assets/images/product/giorgio-armani-acqua-di-gio-parfum-mini-5ml_2-600x600.jpg.webp', 'Với hương thơm của biển cả, hương gỗ, và cam chanh, tạo nên một phong cách thanh lịch, mạnh mẽ và đầy tinh tế, lý tưởng cho cả ngày lẫn đêm.', '<div id=\"text-901771257\" class=\"text\" style=\"font-family: Roboto, Helvetica, sans-serif; font-size: 1.2rem;\"><h2 style=\"font-size: 1.6em; margin-bottom: 0.5em; text-rendering: optimizespeed; width: 807.5px; line-height: 1.3; font-weight: 700;\"><font color=\"#000000\">Chi tiết về sản phẩm</font></h2></div><div id=\"gap-264660412\" class=\"gap-element clearfix\" style=\"font-family: Roboto, Helvetica, sans-serif; padding-top: 10px; font-size: 15.2px; height: auto;\"></div><div class=\"custom-attributes\" style=\"font-family: Roboto, Helvetica, sans-serif; margin-bottom: 20px; font-size: 15.2px;\"><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Phân loại:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/nuoc-hoa/\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Nước hoa</font></a></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Thương hiệu:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/giorgio-armani-vn/\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Giorgio Armani</font></a></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Xuất xứ:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><font color=\"#000000\">Ý</font></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Năm phát hành:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><font color=\"#000000\">2023</font></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Nồng độ:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/nong-do/parfum/\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Parfum</font></a></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Nhóm hương:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/nhom-huong/woody-aquatic\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Woody Aquatic (Hương Gỗ Thơm Mát)</font></a></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Nhà chế tác:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/nha-che-tac/alberto-morillas\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Alberto Morillas</font></a></span></p></div><div class=\"product-description\" style=\"font-family: Roboto, Helvetica, sans-serif; font-size: 15.2px;\"><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\"><span style=\"font-weight: bolder;\">Giorgio Armani Acqua Di Gio Parfum</span>&nbsp;là sự lựa chọn hoàn hảo cho những người đàn ông muốn thể hiện sự tự tin, phóng khoáng và đầy bản lĩnh. Với hương thơm tươi mát và sâu lắng, Acqua Di Gio Parfum mang đến cảm giác tự nhiên, cuốn hút và đầy mạnh mẽ trong từng khoảnh khắc.</font></p><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\">Ra mắt vào năm 2023,&nbsp;<span style=\"font-weight: bolder;\">Acqua Di Gio Parfum</span>&nbsp;là phiên bản mới nhất trong dòng nước hoa huyền thoại của Giorgio Armani, được phát triển bởi nhà chế tác nước hoa Alberto Morillas. Phiên bản Parfum mang lại sự đậm đà hơn, kết hợp giữa hương tươi mát của biển và chiều sâu ấm áp của gỗ, khiến nó trở nên đặc biệt và khác biệt so với những phiên bản trước.</font></p><div class=\"fragrance-notes\" style=\"text-align: center; max-width: 600px; margin: 0px auto;\"><h3 style=\"margin-bottom: 0.5em; text-rendering: optimizespeed; width: 600px; font-size: 1.2em; font-weight: 700; background-image: linear-gradient(to right, rgb(255, 195, 160) 0%, rgb(255, 175, 189) 100%); padding: 5px 10px; display: inline-block; border-radius: 5px;\"><font color=\"#000000\">Hương đầu:</font></h3><div class=\"notes-container top-notes\" style=\"display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; padding-bottom: 2em;\"><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/marine-notes.webp\" alt=\"Hương Đại Dương (Marine Notes)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hương Đại Dương (Marine Notes)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/bergamot.webp\" alt=\"Quả Cam Đắng (Bergamot)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Quả Cam Đắng (Bergamot)</span></div></div><h3 style=\"margin-bottom: 0.5em; text-rendering: optimizespeed; width: 600px; font-size: 1.2em; font-weight: 700; background-image: linear-gradient(to right, rgb(255, 195, 160) 0%, rgb(255, 175, 189) 100%); padding: 5px 10px; display: inline-block; border-radius: 5px;\"><font color=\"#000000\">Hương giữa:</font></h3><div class=\"notes-container middle-notes\" style=\"display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; padding-bottom: 2em;\"><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/rosemary.webp\" alt=\"Cây Hương Thảo (Rosemary)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Cây Hương Thảo (Rosemary)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/clary-sage.webp\" alt=\"Cây Xô Thơm (Clary Sage)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Cây Xô Thơm (Clary Sage)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/geranium.webp\" alt=\"Hoa Phong Lữ (Geranium)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hoa Phong Lữ (Geranium)</span></div></div><h3 style=\"margin-bottom: 0.5em; text-rendering: optimizespeed; width: 600px; font-size: 1.2em; font-weight: 700; background-image: linear-gradient(to right, rgb(255, 195, 160) 0%, rgb(255, 175, 189) 100%); padding: 5px 10px; display: inline-block; border-radius: 5px;\"><font color=\"#000000\">Hương cuối:</font></h3><div class=\"notes-container base-notes\" style=\"display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; padding-bottom: 2em;\"><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/olibanum.webp\" alt=\"Nhũ hương (Olibanum)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Nhũ hương (Olibanum)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/patchouli.webp\" alt=\"Hoắc Hương (Patchouli)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hoắc Hương (Patchouli)</span></div></div></div><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\"><span style=\"font-weight: bolder;\">Acqua Di Gio Parfum</span>&nbsp;thuộc nhóm hương Aromatic Aquatic (Hương Thơm Biển), mang đặc điểm tươi mát, gợi cảm và đầy nam tính. Hương thơm mở đầu với sự tươi mới và sảng khoái của cam Bergamot và hương biển, tạo nên một khởi đầu đầy sức sống và nhẹ nhàng. Tầng hương giữa mang đến sự pha trộn hài hòa của các loại thảo mộc như xô thơm và hương thảo, thêm chút ấm áp và nam tính. Cuối cùng, hương gỗ tuyết tùng, hoắc hương và cỏ vetiver kết hợp tạo nên sự mạnh mẽ, bền bỉ và đầy quyến rũ.</font></p><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\"><span style=\"font-weight: bolder;\">Acqua Di Gio Parfum</span>&nbsp;là hương thơm hoàn hảo cho các sự kiện ban ngày, từ công sở đến các buổi gặp gỡ trang trọng, nhưng cũng đủ tinh tế và quyến rũ để sử dụng trong những buổi tối lãng mạn hoặc các sự kiện quan trọng. Nó giúp xây dựng hình ảnh một người đàn ông mạnh mẽ, tự tin và đầy sức hút.</font></p><ul style=\"list-style-position: initial; list-style-image: initial; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; margin-bottom: 1.3em;\"><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Độ lưu hương:</span>&nbsp;4.5/5</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Độ tỏa hương:</span>&nbsp;4/5</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Nịnh mũi:</span>&nbsp;4.5/5</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Thời điểm:</span>&nbsp;Thích hợp cho mọi mùa, cả ngày lẫn đêm.</li></ul><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\"><span style=\"font-weight: bolder;\">Giorgio Armani Acqua Di Gio Parfum</span>&nbsp;không chỉ là một hương thơm tươi mát, mà còn mang trong mình sự tinh tế và mạnh mẽ. Đây là hương thơm lý tưởng cho những người đàn ông hiện đại, những người muốn cảm nhận sự tự do và phong cách trong mọi hoàn cảnh. Với Acqua Di Gio Parfum, bạn sẽ luôn tự tin và cuốn hút, khiến mỗi khoảnh khắc trở nên đáng nhớ và đặc biệt.</font></p></div>', 0, 6, 1, 1, 0, '2024-11-15 20:58:39', '2024-12-18 07:39:06'),
(48, 1, 'Dior Homme Intense EDP', 'dior-homme-intense-edp', 100, 1, '../admin_assets/images/product/dior-homme-intense_1-600x600.jpg.webp,../admin_assets/images/product/dior-homme-intense_2-600x600.jpg.webp,../admin_assets/images/product/dior-homme-intense_3-600x600.jpg.webp', 'Hương thơm nam tính và gợi cảm, hoàn hảo cho những buổi tối lãng mạn và sự kiện trang trọng.', '<div class=\"custom-attributes\" style=\"font-family: Roboto, Helvetica, sans-serif; margin-bottom: 20px; font-size: 15.2px;\"><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Phân loại:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/nuoc-hoa/\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Nước hoa</font></a></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Thương hiệu:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/dior-vn/\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Dior</font></a></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Xuất xứ:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><font color=\"#000000\">Ý</font></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Năm phát hành:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><font color=\"#000000\">2011</font></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Nồng độ:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/nong-do/eau-de-parfum-edp/\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Eau de Parfum (EDP)</font></a></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Nhóm hương:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/nhom-huong/woody-floral-musk/\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Woody Floral Musk</font></a></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Nhà chế tác:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><a href=\"https://orchard.vn/nha-che-tac/francois-demachy/\" style=\"touch-action: manipulation; text-decoration: none; font-family: Roboto, Helvetica, sans-serif !important;\"><font color=\"#000000\">Francois Demachy</font></a></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Phong cách:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><font color=\"#000000\">Ấm áp (Cozy), Lãng mạn (Romantic), Nữ tính (Feminine), Thanh lịch (Elegant)</font></span></p><p style=\"margin: 5px 0px; display: flex; flex-wrap: wrap;\"><strong style=\"font-weight: bold; width: 200px; padding-right: 10px; flex-shrink: 0;\"><font color=\"#000000\">Dịp sử dụng:</font></strong><span style=\"flex: 1 1 0%; word-break: break-word;\"><font color=\"#000000\">Hẹn hò, Lãng mạn, Mùa đông</font></span></p></div><div class=\"product-description\" style=\"font-family: Roboto, Helvetica, sans-serif; font-size: 15.2px;\"><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\">Dior Homme Intense là một hương thơm thuộc nhóm hương Woody Floral Musk, được ra mắt vào năm 2007. Đây là một phiên bản nồng độ cao hơn và sâu sắc hơn của Dior Homme, được sáng tạo bởi nhà pha chế nước hoa François Demachy.</font></p><p style=\"margin-right: 0px; margin-bottom: 1.3em; margin-left: 0px; color: rgb(22, 22, 24);\">Dior Homme Intense mở đầu với hương thơm tươi mát và nhẹ nhàng của hoa oải hương, mang lại cảm giác thanh khiết và dễ chịu. Hương giữa là sự kết hợp đầy gợi cảm giữa hoa diên vĩ và hương Ambrette, tạo nên một lớp hương đầy nam tính và sang trọng. Cuối cùng, hương gỗ tuyết tùng Virginia và cỏ hương bài mang lại sự ấm áp và bền bỉ cho tầng hương cuối, giúp hương thơm kéo dài và để lại ấn tượng sâu sắc.</p><p style=\"margin-right: 0px; margin-bottom: 1.3em; margin-left: 0px; color: rgb(22, 22, 24);\">Dior Homme Intense mang lại cảm giác nam tính, lịch lãm và đầy gợi cảm. Đây là một mùi hương lý tưởng cho những buổi tối lãng mạn hoặc sự kiện trang trọng, nơi bạn muốn tỏa sáng và để lại ấn tượng mạnh mẽ. Hương thơm này toát lên vẻ đẹp nam tính, tinh tế và cuốn hút, khiến người sử dụng trở nên tự tin và phong cách.</p><p style=\"margin-right: 0px; margin-bottom: 1.3em; margin-left: 0px; color: rgb(22, 22, 24);\">Thuộc nhóm hương Woody Floral Musk, Dior Homme Intense phù hợp với những người đàn ông tự tin, lịch lãm và có gu thẩm mỹ tinh tế. Họ thường là những người có phong cách riêng, biết cách chăm sóc bản thân và luôn mong muốn thể hiện cái tôi độc đáo.</p><p style=\"margin-right: 0px; margin-bottom: 1.3em; margin-left: 0px; color: rgb(22, 22, 24);\">Dior Homme Intense sẽ giúp bạn xây dựng hình ảnh của một người đàn ông mạnh mẽ, tự tin và lịch lãm. Đây là mùi hương dành cho những ai muốn để lại ấn tượng sâu sắc và khó quên trong mắt người khác.</p><p style=\"margin-right: 0px; margin-bottom: 20px; margin-left: 0px; color: rgb(102, 102, 102); font-family: Jost, sans-serif; font-size: 16px;\"><img src=\"http://127.0.0.1:8000/posts/images/image_17319364405271.jpg\" style=\"border: 0px; max-width: 100%; height: auto;\"></p><p style=\"margin-bottom: 1.3em;\"><font color=\"#000000\"><br></font></p></div>', 0, 3, 1, 1, 0, '2024-11-18 06:29:02', '2024-12-18 08:19:30');
INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `price`, `gender`, `images`, `short_description`, `detail_description`, `trending`, `view`, `affiliate`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(49, 1, 'Chanel Bleu De Chanel EDP', 'chanel-bleu-de-chanel-edp', 100, 1, '../admin_assets/images/product/chanel-bleu-de-chanel-edp_1-600x600.jpg.webp,../admin_assets/images/product/chanel-bleu-de-chanel-edp_2-600x600.jpg.webp,../admin_assets/images/product/chanel-bleu-de-chanel-edp_3-600x600.jpg.webp', 'Hương thơm nam tính và tinh tế, lý tưởng cho mọi dịp từ công sở đến tiệc tối.', '<p style=\"margin-bottom: 1.3em; font-family: Roboto, Helvetica, sans-serif; font-size: 15.2px;\"><font color=\"#000000\">Bleu De Chanel Eau de Parfum (EDP) là một hương thơm thuộc nhóm hương Woody Aromatic, được ra mắt vào năm 2014. Được sáng tạo bởi nhà pha chế nước hoa Jacques Polge, Bleu De Chanel EDP là phiên bản mạnh mẽ và sâu lắng hơn của dòng Bleu De Chanel.</font></p><ul style=\"list-style-position: initial; list-style-image: initial; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; margin-bottom: 1.3em; font-family: Roboto, Helvetica, sans-serif; font-size: 15.2px;\"><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Top note (hương đầu):</span>&nbsp;Bưởi, chanh vàng, bạc hà, hồng tiêu, nhục đậu khấu, gừng</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Heart note (hương giữa):</span>&nbsp;Hoa nhài, hoa phong lữ, Iso E Super</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Base note (hương cuối):</span>&nbsp;Hương gỗ, nhựa labdanum, gỗ đàn hương, hoắc hương, tuyết tùng, nhựa olebanum, hổ phách</li></ul><div class=\"fragrance-notes\" style=\"font-family: Roboto, Helvetica, sans-serif; text-align: center; max-width: 600px; margin: 0px auto; font-size: 15.2px;\"><h3 style=\"margin-bottom: 0.5em; text-rendering: optimizespeed; width: 600px; font-size: 1.2em; font-weight: 700; background-image: linear-gradient(to right, rgb(255, 195, 160) 0%, rgb(255, 175, 189) 100%); padding: 5px 10px; display: inline-block; border-radius: 5px;\"><font color=\"#000000\">Hương đầu (5 - 15 phút)</font></h3><div class=\"notes-container top-notes\" style=\"display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; padding-bottom: 2em;\"><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/grapefruit.webp\" alt=\"Quả Bưởi Tây (Grapefruit)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Quả Bưởi Tây (Grapefruit)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/lemon.webp\" alt=\"Chanh Vàng (Lemon)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Chanh Vàng (Lemon)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/mint.webp\" alt=\"Bạc Hà (Mint)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Bạc Hà (Mint)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/pink-pepper.webp\" alt=\"Hạt Tiêu Hồng (Pink Pepper)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hạt Tiêu Hồng (Pink Pepper)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/bergamot.webp\" alt=\"Quả Cam Đắng (Bergamot)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Quả Cam Đắng (Bergamot)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/aldehydes.webp\" alt=\"Hương Aldehydes\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hương Aldehydes</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/coriander.webp\" alt=\"Ngò Thơm (Coriander)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Ngò Thơm (Coriander)</span></div></div><h3 style=\"margin-bottom: 0.5em; text-rendering: optimizespeed; width: 600px; font-size: 1.2em; font-weight: 700; background-image: linear-gradient(to right, rgb(255, 195, 160) 0%, rgb(255, 175, 189) 100%); padding: 5px 10px; display: inline-block; border-radius: 5px;\"><font color=\"#000000\">Hương giữa (20 - 60 phút)</font></h3><div class=\"notes-container middle-notes\" style=\"display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; padding-bottom: 2em;\"><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/ginger.webp\" alt=\"Gừng (Ginger)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Gừng (Ginger)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/nutmeg.webp\" alt=\"Nhục Đậu Khấu (Nutmeg)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Nhục Đậu Khấu (Nutmeg)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/jasmine.webp\" alt=\"Hoa Nhài (Jasmine)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hoa Nhài (Jasmine)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/melon.webp\" alt=\"Dưa Lưới (Melon)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Dưa Lưới (Melon)</span></div></div><h3 style=\"margin-bottom: 0.5em; text-rendering: optimizespeed; width: 600px; font-size: 1.2em; font-weight: 700; background-image: linear-gradient(to right, rgb(255, 195, 160) 0%, rgb(255, 175, 189) 100%); padding: 5px 10px; display: inline-block; border-radius: 5px;\"><font color=\"#000000\">Hương cuối (&gt;6 tiếng)</font></h3><div class=\"notes-container base-notes\" style=\"display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; padding-bottom: 2em;\"><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/incense.webp\" alt=\"Mùi Khói Thơm (Incense)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Mùi Khói Thơm (Incense)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/amber.webp\" alt=\"Hổ Phách (Amber)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hổ Phách (Amber)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/cedar.webp\" alt=\"Gỗ Tuyết Tùng (Cedar)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Gỗ Tuyết Tùng (Cedar)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/sandalwood.webp\" alt=\"Gỗ Đàn Hương (Sandalwood)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Gỗ Đàn Hương (Sandalwood)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/patchouli.webp\" alt=\"Hoắc Hương (Patchouli)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hoắc Hương (Patchouli)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/amberwood.webp\" alt=\"Hương Gỗ Hổ Phách (Amberwood)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hương Gỗ Hổ Phách (Amberwood)</span></div><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/labdanum.webp\" alt=\"Hương Nhựa Thơm Labdanum\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hương Nhựa Thơm Labdanum</span></div></div></div><p style=\"margin-bottom: 1.3em; font-family: Roboto, Helvetica, sans-serif; font-size: 15.2px;\"><font color=\"#000000\">Chanel Bleu De Chanel EDP mở đầu với sự tươi mát và sảng khoái của bưởi, chanh vàng và bạc hà, kết hợp với sự cay nồng của hồng tiêu, nhục đậu khấu và gừng, tạo nên một khởi đầu đầy năng lượng và cuốn hút. Hương giữa là sự kết hợp tinh tế của hoa nhài, hoa phong lữ và Iso E Super, mang lại sự cân bằng và tinh tế. Cuối cùng, hương gỗ, nhựa labdanum, gỗ đàn hương, hoắc hương, tuyết tùng, nhựa olebanum và hổ phách mang lại cảm giác ấm áp, sâu lắng và bền bỉ.</font></p><p style=\"margin-bottom: 1.3em; font-family: Roboto, Helvetica, sans-serif; font-size: 15.2px;\"><font color=\"#000000\">Chanel Bleu De Chanel EDP mang lại cảm giác tự tin, tinh tế và nam tính. Hương thơm này rất phù hợp khi sử dụng trong mọi dịp, từ công sở hàng ngày đến các buổi tiệc tối quan trọng. Nó toát lên vẻ đẹp thanh lịch và cuốn hút, giúp người sử dụng trở nên nổi bật và tự tin.</font></p><p style=\"margin-bottom: 1.3em; font-family: Roboto, Helvetica, sans-serif; font-size: 15.2px;\"><font color=\"#000000\">Thuộc nhóm hương Woody Aromatic, Chanel Bleu De Chanel EDP phù hợp với những người đàn ông hiện đại, tự tin và có phong cách riêng. Họ thường là những người yêu thích sự thanh lịch, tinh tế và luôn hướng tới sự hoàn hảo. Mùi hương này giúp họ thể hiện sự nam tính, mạnh mẽ và cuốn hút của mình một cách tự nhiên.</font></p><p style=\"margin-bottom: 1.3em; font-family: Roboto, Helvetica, sans-serif; font-size: 15.2px;\"><font color=\"#000000\">Chanel Bleu De Chanel EDP sẽ giúp bạn xây dựng hình ảnh của một người đàn ông lịch lãm, tự tin và đầy sức hút. Đây là mùi hương dành cho những ai muốn để lại ấn tượng sâu sắc và khó quên trong mắt người khác.</font></p><ul style=\"list-style-position: initial; list-style-image: initial; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; margin-bottom: 1.3em; font-family: Roboto, Helvetica, sans-serif; font-size: 15.2px;\"><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Độ lưu hương:</span>&nbsp;4/5</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Độ tỏa hương:</span>&nbsp;4/5</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Nịnh mũi:</span>&nbsp;4/5</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Thời điểm:</span>&nbsp;Thích hợp cho mọi dịp, từ công sở hàng ngày đến các buổi tiệc tối quan trọng.</li></ul>', 0, 6, 1, 1, 0, '2024-11-18 07:04:32', '2024-12-18 07:35:51'),
(50, 3, 'Gucci Bloom EDP Mini', 'gucci-bloom-edp-mini', 100, 0, '../admin_assets/images/product/gucci-bloom-edp-mini-5ml_2-600x600.jpg.webp,../admin_assets/images/product/gucci-bloom-edp-mini-5ml_4-600x600.jpg.webp', 'Hương thơm thanh khiết và nữ tính, lý tưởng cho những buổi hẹn hò lãng mạn và các dịp đặc biệt.', '<p style=\"margin-bottom: 1.3em; font-family: Roboto, Helvetica, sans-serif; color: rgb(22, 22, 24); font-size: 15.2px;\">Gucci Bloom là một hương thơm dành cho phái nữ thuộc nhóm Floral, được ra mắt vào năm 2017. Được tạo ra bởi nhà sáng tạo Alberto Morillas, Gucci Bloom mang đến sự thanh khiết và nữ tính, gợi nhớ đến những khu vườn hoa tươi nở rộ, đầy sức sống.</p><div class=\"fragrance-notes\" style=\"font-family: Roboto, Helvetica, sans-serif; text-align: center; max-width: 600px; margin: 0px auto; color: rgb(22, 22, 24); font-size: 15.2px;\"><h3 style=\"color: brown; margin-bottom: 0.5em; text-rendering: optimizespeed; width: 600px; font-size: 1.2em; font-weight: 700; background-image: linear-gradient(to right, rgb(255, 195, 160) 0%, rgb(255, 175, 189) 100%); padding: 5px 10px; display: inline-block; border-radius: 5px;\">Hương đầu (5 - 15 phút)</h3><div class=\"notes-container top-notes\" style=\"display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; padding-bottom: 2em;\"><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/jasmine.webp\" alt=\"Hoa Nhài (Jasmine)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hoa Nhài (Jasmine)</span></div></div><h3 style=\"color: brown; margin-bottom: 0.5em; text-rendering: optimizespeed; width: 600px; font-size: 1.2em; font-weight: 700; background-image: linear-gradient(to right, rgb(255, 195, 160) 0%, rgb(255, 175, 189) 100%); padding: 5px 10px; display: inline-block; border-radius: 5px;\">Hương giữa (20 - 60 phút)</h3><div class=\"notes-container middle-notes\" style=\"display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; padding-bottom: 2em;\"><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/tuberose.webp\" alt=\"Hoa Huệ Trắng (Tuberose)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hoa Huệ Trắng (Tuberose)</span></div></div><h3 style=\"color: brown; margin-bottom: 0.5em; text-rendering: optimizespeed; width: 600px; font-size: 1.2em; font-weight: 700; background-image: linear-gradient(to right, rgb(255, 195, 160) 0%, rgb(255, 175, 189) 100%); padding: 5px 10px; display: inline-block; border-radius: 5px;\">Hương cuối (&gt;6 tiếng)</h3><div class=\"notes-container base-notes\" style=\"display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; padding-bottom: 2em;\"><div class=\"fragrance-term\" style=\"font-size: 12.92px; display: inline-block; width: 120px; position: relative; cursor: pointer;\"><img decoding=\"async\" src=\"https://orchard.vn/wp-content/uploads/2024/10/rangoon-creeper.webp\" alt=\"Hoa Sử Quân Tử (Rangoon Creeper)\" class=\"fragrance-image\" style=\"display: block; height: 68px; max-width: 100%; opacity: 1; transition: opacity 1s; width: 68px; margin: 0px auto;\"><span class=\"fragrance-name\" style=\"display: block; margin-top: 5px;\">Hoa Sử Quân Tử (Rangoon Creeper)</span></div></div></div><p style=\"margin-bottom: 1.3em; font-family: Roboto, Helvetica, sans-serif; color: rgb(22, 22, 24); font-size: 15.2px;\">Gucci Bloom mở đầu với hương thơm tinh tế và quyến rũ của hoa nhài, mang lại cảm giác tươi mát và ngọt ngào. Hương giữa là sự hòa quyện của hoa huệ và hoa kim ngân, tạo nên một tầng hương hoa cỏ thanh khiết và nữ tính. Cuối cùng, hương rễ cây diên vĩ mang lại một nền tảng ấm áp và bền vững, giúp mùi hương kéo dài và trở nên cuốn hút hơn.</p><p style=\"margin-bottom: 1.3em; font-family: Roboto, Helvetica, sans-serif; color: rgb(22, 22, 24); font-size: 15.2px;\">Hương thơm của Gucci Bloom mang lại cảm giác thanh khiết, nữ tính và đầy quyến rũ. Đây là một mùi hương lý tưởng cho các buổi hẹn hò lãng mạn, các sự kiện quan trọng hoặc khi bạn muốn tạo ấn tượng nhẹ nhàng và tinh tế.</p><p style=\"margin-bottom: 1.3em; font-family: Roboto, Helvetica, sans-serif; color: rgb(22, 22, 24); font-size: 15.2px;\">Gucci Bloom thuộc nhóm hương Floral, phù hợp với những người phụ nữ trẻ trung, lãng mạn và yêu thích sự thanh khiết. Những người này có phong cách sống hiện đại, không ngại thể hiện cái tôi cá nhân và luôn tìm kiếm vẻ đẹp trong từng khoảnh khắc. Họ là những người biết cách tận hưởng cuộc sống và luôn tỏa sáng trong mọi hoàn cảnh.</p><p style=\"margin-bottom: 1.3em; font-family: Roboto, Helvetica, sans-serif; color: rgb(22, 22, 24); font-size: 15.2px;\">Với Gucci Bloom, bạn sẽ xây dựng được hình ảnh một quý cô thanh khiết, tinh tế và đầy cuốn hút. Đây là sự lựa chọn hoàn hảo để bạn trở nên nổi bật và ghi dấu ấn mạnh mẽ trong mắt mọi người.</p><ul style=\"list-style-position: initial; list-style-image: initial; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; margin-bottom: 1.3em; font-family: Roboto, Helvetica, sans-serif; color: rgb(22, 22, 24); font-size: 15.2px;\"><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Độ lưu hương:</span>&nbsp;4/5</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Độ tỏa hương:</span>&nbsp;4/5</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Nịnh mũi:</span>&nbsp;4.5/5</li><li style=\"margin-bottom: 0.6em; margin-left: 1.3em;\"><span style=\"font-weight: bolder;\">Thời điểm:</span>&nbsp;Thích hợp dùng hằng ngày, trong các buổi hẹn hò, các sự kiện quan trọng và những dịp đặc biệt.</li></ul>', 0, 7, 1, 1, 0, '2024-11-18 07:08:37', '2024-12-23 03:58:46'),
(51, 1, 'Armaf Club De Nuit Intense Man EDT', 'armaf-club-de-nuit-intense-man-edt', 100, 1, '../admin_assets/images/product/nuoc-hoa-nam-armaf-club-de-nuit-intense-man-eau-de-toilette-105ml-6711b6a62a9b0-18102024081518.webp,../admin_assets/images/product/nuoc-hoa-nam-armaf-club-de-nuit-intense-man-eau-de-toilette-105ml-6711b6a62b07b-18102024081518.webp', 'Sản phẩm nổi bật nhờ sự pha trộn tinh tế giữa các nốt hương mạnh mẽ và thanh lịch, tạo nên một dấu ấn đặc trưng dành cho những quý ông hiện đại.', '<h2 style=\"margin: 5px auto 7px; padding: 0px; font-weight: var(--bold600); font-size: 18pt; font-family: Arial, Helvetica, sans-serif;\"><font color=\"#000000\">Giới thiệu thương hiệu nước hoa Armaf</font></h2><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;\"><font color=\"#000000\">Thương hiệu Armaf bắt đầu từ những năm 2010 và nhanh chóng nổi tiếng trên toàn cầu nhờ những dòng nước hoa chất lượng cao nhưng có mức giá phải chăng. Armaf chuyên tạo ra những sản phẩm nước hoa có sự pha trộn độc đáo, lấy cảm hứng từ những hương thơm đẳng cấp trên thế giới, và nước hoa Club De Nuit Intense For Man là một trong những thành công nổi bật của thương hiệu này.</font></p><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px; text-align: center;\"><font color=\"#000000\"><img data-src=\"https://cdn.vuahanghieu.com/unsafe/0x0/left/top/smart/filters:quality(90)/https://admin.vuahanghieu.com/upload/news/content/2024/10/nuoc-hoa-nam-armaf-club-de-nuit-intense-man-eau-de-toilette-105ml-6-jpg-1729214319-18102024081839.jpg\" class=\"product-img-responsive\" alt=\"Nước Hoa Nam Armaf Club De Nuit Intense Man Eau De Toilette 105ml - Nước hoa - Vua Hàng Hiệu\" src=\"https://cdn.vuahanghieu.com/unsafe/0x0/left/top/smart/filters:quality(90)/https://admin.vuahanghieu.com/upload/news/content/2024/10/nuoc-hoa-nam-armaf-club-de-nuit-intense-man-eau-de-toilette-105ml-6-jpg-1729214319-18102024081839.jpg\" style=\"margin: 0px; padding: 0px; border: 0px; vertical-align: top; object-fit: contain; max-width: 100%; height: auto;\"></font></p><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px; text-align: center;\"><em style=\"margin: 0px; padding: 0px;\"><font color=\"#000000\">Armaf Club De Nuit Intense For Man</font></em></p><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;\"><font color=\"#000000\">Armaf khởi đầu từ sự kết hợp giữa nghệ thuật sáng tạo hương thơm và sự tỉ mỉ trong từng chi tiết sản xuất. Không chỉ chú trọng đến chất lượng mùi hương, mà Armaf còn chăm chút đến thiết kế và cảm nhận người dùng, tạo nên dấu ấn riêng biệt trên thị trường nước hoa toàn cầu. Mặc dù ra đời muộn hơn so với nhiều thương hiệu khác, nhưng Armaf nhanh chóng khẳng định vị trí của mình nhờ những sản phẩm đột phá, trong đó có Club De Nuit Intense.</font></p><h2 style=\"margin: 5px auto 7px; padding: 0px; font-weight: var(--bold600); font-size: 18pt; font-family: Arial, Helvetica, sans-serif;\"><font color=\"#000000\">Thiết kế nước hoa Armaf Club De Nuit Intense For Man</font></h2><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;\"><font color=\"#000000\">Thiết kế của chai&nbsp;<span style=\"text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">nước hoa Armaf</span>&nbsp;Club De Nuit Intense For Man mang đậm nét sang trọng, mạnh mẽ với chai thủy tinh màu đen tuyền, tạo cảm giác bí ẩn và đầy cuốn hút. Hình dáng chai được thiết kế vuông vắn, chắc chắn, tượng trưng cho sự nam tính và mạnh mẽ của phái mạnh. Nắp chai có các chi tiết kim loại sáng bóng, tạo nên sự tương phản tinh tế, đồng thời làm nổi bật logo và tên sản phẩm khắc sắc nét trên thân chai.</font></p><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px; text-align: center;\"><font color=\"#000000\"><img data-src=\"https://cdn.vuahanghieu.com/unsafe/0x0/left/top/smart/filters:quality(90)/https://admin.vuahanghieu.com/upload/news/content/2024/10/nuoc-hoa-nam-armaf-club-de-nuit-intense-man-eau-de-toilette-105ml-5-jpg-1729214334-18102024081854.jpg\" class=\"product-img-responsive\" alt=\"Nước Hoa Nam Armaf Club De Nuit Intense Man Eau De Toilette 105ml - Nước hoa - Vua Hàng Hiệu\" src=\"https://cdn.vuahanghieu.com/unsafe/0x0/left/top/smart/filters:quality(90)/https://admin.vuahanghieu.com/upload/news/content/2024/10/nuoc-hoa-nam-armaf-club-de-nuit-intense-man-eau-de-toilette-105ml-5-jpg-1729214334-18102024081854.jpg\" style=\"margin: 0px; padding: 0px; border: 0px; vertical-align: top; object-fit: contain; max-width: 100%; height: auto;\"></font></p><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;\"><font color=\"#000000\">Điểm nhấn trong thiết kế là viên đá lấp lánh đính trên cổ chai, mang lại cảm giác cao cấp và tinh tế. Với kích thước 105ml, nước hoa Armaf Club De Nuit Intense For Man đủ lớn để bạn sử dụng trong một thời gian dài mà vẫn giữ được độ bền của mùi hương. Thiết kế của chai cũng rất thuận tiện để mang theo bên mình hoặc trưng bày trên bàn trang điểm, tạo nên điểm nhấn nổi bật cho không gian cá nhân.</font></p><h2 style=\"margin: 5px auto 7px; padding: 0px; font-weight: var(--bold600); font-size: 18pt; font-family: Arial, Helvetica, sans-serif;\"><font color=\"#000000\">Mùi hương Armaf Club De Nuit Intense For Man</font></h2><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;\"><font color=\"#000000\">Mùi hương đặc trưng của Armaf Club De Nuit Intense For Man là sự kết hợp tinh tế và mạnh mẽ, dành riêng cho những quý ông cá tính và cuốn hút. Đây là một hương thơm thuộc nhóm hương gỗ cay nồng, mang đến sự nam tính đầy bí ẩn nhưng cũng không kém phần thanh lịch. Armaf Club De Nuit Intense được đánh giá là một trong những dòng nước hoa nam có khả năng làm bật lên sự mạnh mẽ, tự tin của phái mạnh, phù hợp với nhiều phong cách khác nhau.</font></p><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px; text-align: center;\"><font color=\"#000000\"><img data-src=\"https://cdn.vuahanghieu.com/unsafe/0x0/left/top/smart/filters:quality(90)/https://admin.vuahanghieu.com/upload/news/content/2024/10/nuoc-hoa-nam-armaf-club-de-nuit-intense-man-eau-de-toilette-105ml-3-jpg-1729214343-18102024081903.jpg\" class=\"product-img-responsive\" alt=\"Nước Hoa Nam Armaf Club De Nuit Intense Man Eau De Toilette 105ml - Nước hoa - Vua Hàng Hiệu\" src=\"https://cdn.vuahanghieu.com/unsafe/0x0/left/top/smart/filters:quality(90)/https://admin.vuahanghieu.com/upload/news/content/2024/10/nuoc-hoa-nam-armaf-club-de-nuit-intense-man-eau-de-toilette-105ml-3-jpg-1729214343-18102024081903.jpg\" style=\"margin: 0px; padding: 0px; border: 0px; vertical-align: top; object-fit: contain; max-width: 100%; height: auto;\"></font></p><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;\"><strong style=\"margin: 0px; padding: 0px;\"><font color=\"#000000\">Note hương</font></strong></p><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;\"><font color=\"#000000\">Armaf Club De Nuit Intense For Man mở đầu với nốt hương đầu tươi mát của chanh vàng, cam bergamot, táo và dứa, mang lại cảm giác sảng khoái và đầy sinh lực ngay từ lần đầu sử dụng. Tiếp đến là nốt hương giữa ấm áp và nam tính từ gỗ bạch dương, hoa nhài và hoa hồng, tạo nên chiều sâu đầy cuốn hút. Cuối cùng, nốt hương cuối lưu lại trên da là sự hòa quyện đầy tinh tế giữa hoắc hương, vani, long diên hương và xạ hương, mang đến sự ấm áp và gợi cảm lâu dài.</font></p><ul style=\"margin-right: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px; margin-left: 20px !important; list-style: inherit !important;\"><li style=\"margin: 0px; padding: 0px;\">Hương đầu: Quả chanh vàng, Quả lý chua đen, Quả táo xanh, Cam Bergamot, Quả dứa (quả thơm)</li><li style=\"margin: 0px; padding: 0px;\">Hương giữa: Hoa hồng, Hoa nhài, Gỗ Bu-lô</li><li style=\"margin: 0px; padding: 0px;\">Hương cuối: Hương Va ni, Long diên hương, Xạ hương, Cây hoắc hương</li></ul><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;\"><strong style=\"margin: 0px; padding: 0px;\"><font color=\"#000000\">Độ tỏa hương</font></strong></p><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px; text-align: center;\"><strong style=\"margin: 0px; padding: 0px;\"><font color=\"#000000\"><img data-src=\"https://cdn.vuahanghieu.com/unsafe/0x0/left/top/smart/filters:quality(90)/https://admin.vuahanghieu.com/upload/news/content/2024/10/nuoc-hoa-nam-armaf-club-de-nuit-intense-man-eau-de-toilette-105ml-4-jpg-1729214356-18102024081916.jpg\" class=\"product-img-responsive\" alt=\"Nước Hoa Nam Armaf Club De Nuit Intense Man Eau De Toilette 105ml - Nước hoa - Vua Hàng Hiệu\" src=\"https://cdn.vuahanghieu.com/unsafe/0x0/left/top/smart/filters:quality(90)/https://admin.vuahanghieu.com/upload/news/content/2024/10/nuoc-hoa-nam-armaf-club-de-nuit-intense-man-eau-de-toilette-105ml-4-jpg-1729214356-18102024081916.jpg\" style=\"margin: 0px; padding: 0px; border: 0px; vertical-align: top; object-fit: contain; max-width: 100%; height: auto;\"></font></strong></p><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;\"><font color=\"#000000\">Với độ tỏa hương mạnh mẽ, Armaf Club De Nuit Intense For Man dễ dàng để lại ấn tượng khó quên cho những người xung quanh. Mùi hương này có khả năng tỏa xa và giữ mùi lâu, kéo dài suốt cả ngày, giúp người dùng luôn tự tin trong mọi hoàn cảnh. Đây là một lựa ch.ọn lý tưởng cho những buổi gặp gỡ, sự kiện quan trọng hoặc thậm chí là buổi hẹn hò lãng mạn.</font></p><h2 style=\"margin: 5px auto 7px; padding: 0px; font-weight: var(--bold600); font-size: 18pt; font-family: Arial, Helvetica, sans-serif;\"><font color=\"#000000\">Đối tượng phù hợp Armaf Club De Nuit Intense For Man</font></h2><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;\"><font color=\"#000000\">Nước hoa Armaf Club De Nuit Intense For Man dành cho những quý ông yêu thích phong cách mạnh mẽ, cá tính nhưng vẫn muốn giữ lại chút thanh lịch. Mùi hương đầy cuốn hút của sản phẩm phù hợp với người đàn ông trưởng thành, tự tin và biết cách thể hiện bản thân trong cuộc sống và công việc. Đặc biệt, nước hoa này rất hợp với những ai muốn tạo dấu ấn riêng biệt và không ngại thử thách bản thân qua những trải nghiệm mới mẻ.</font></p><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px; text-align: center;\"><font color=\"#000000\"><img data-src=\"https://cdn.vuahanghieu.com/unsafe/0x0/left/top/smart/filters:quality(90)/https://admin.vuahanghieu.com/upload/news/content/2024/10/nuoc-hoa-nam-armaf-club-de-nuit-intense-man-eau-de-toilette-105ml-7-jpg-1729214366-18102024081926.jpg\" class=\"product-img-responsive\" alt=\"Nước Hoa Nam Armaf Club De Nuit Intense Man Eau De Toilette 105ml - Nước hoa - Vua Hàng Hiệu\" src=\"https://cdn.vuahanghieu.com/unsafe/0x0/left/top/smart/filters:quality(90)/https://admin.vuahanghieu.com/upload/news/content/2024/10/nuoc-hoa-nam-armaf-club-de-nuit-intense-man-eau-de-toilette-105ml-7-jpg-1729214366-18102024081926.jpg\" style=\"margin: 0px; padding: 0px; border: 0px; vertical-align: top; object-fit: contain; max-width: 100%; height: auto;\"></font></p><h2 style=\"margin: 5px auto 7px; padding: 0px; font-weight: var(--bold600); font-size: 18pt; font-family: Arial, Helvetica, sans-serif;\"><font color=\"#000000\">Thời điểm sử dụng Armaf Club De Nuit Intense For Man</font></h2><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;\"><font color=\"#000000\">Armaf Club De Nuit Intense For Man là dòng nước hoa lý tưởng cho mùa thu và mùa đông, khi tiết trời se lạnh giúp các nốt hương ấm áp, cay nồng phát huy tối đa sức hút của chúng. Ngoài ra, sản phẩm này cũng rất phù hợp khi sử dụng vào các buổi tối, trong những sự kiện quan trọng hoặc các buổi tiệc sang trọng.</font></p><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;\"><font color=\"#000000\">Nhờ sự kết hợp hài hòa giữa các tầng hương, Armaf Club De Nuit Intense For Man không chỉ giúp bạn nổi bật trong những dịp đặc biệt mà còn có thể sử dụng trong cuộc sống hàng ngày, đem lại cảm giác tự tin và quyến rũ.</font></p>', 0, 0, 1, 1, 0, '2024-12-09 03:38:20', '2024-12-09 03:38:20'),
(52, 4, 'Calvin Klein (CK) CK One', 'calvin-klein-ck-ck-one', 100, 0, '../admin_assets/images/product/nuoc-hoa-calvin-klein-ck-ck-one-cho-ca-nam-va-nu-15ml-5c6299a13d249-12022019170209.webp,../admin_assets/images/product/nuoc-hoa-calvin-klein-ck-ck-one-cho-ca-nam-va-nu-100ml-6666827566326-10062024113501.webp', 'Calvin Klein CK One mang trong mình sự tươi mát và tinh khiết và đồng thời thể hiện được một cái nhìn mới của nước hoa.', '<p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;\"><font color=\"#000000\"><strong style=\"margin: 0px; padding: 0px;\"><span style=\"text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Nước hoa Calvin Klein</span>&nbsp;CK One 100ml</strong>&nbsp;là dòng&nbsp;<span style=\"text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">nước hoa hàng hiệu</span>&nbsp;của&nbsp;<span style=\"text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">thương hiệu Calvin Klein</span>&nbsp;dành cho cả nam và nữ thuộc dòng Cam Quýt - Thơm Ngát.&nbsp;<strong style=\"margin: 0px; padding: 0px;\">Calvin Klein CK One</strong>&nbsp;mang trong mình sự tươi mát và tinh khiết và đồng thời thể hiện được một cái nhìn mới của nước hoa.</font></p><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px; text-align: center;\"><font color=\"#000000\"><img data-src=\"https://cdn.vuahanghieu.com/unsafe/0x0/left/top/smart/filters:quality(90)/https://admin.vuahanghieu.com/upload/news/content/2024/06/nuoc-hoa-calvin-klein-ck-ck-one-cho-ca-nam-va-nu-100ml-jpg-1717994129-10062024113529.jpg\" class=\"product-img-responsive\" alt=\"Nước Hoa Calvin Klein (CK) CK One Cho Cả Nam Và Nữ, 100ml - Nước hoa - Vua Hàng Hiệu\" src=\"https://cdn.vuahanghieu.com/unsafe/0x0/left/top/smart/filters:quality(90)/https://admin.vuahanghieu.com/upload/news/content/2024/06/nuoc-hoa-calvin-klein-ck-ck-one-cho-ca-nam-va-nu-100ml-jpg-1717994129-10062024113529.jpg\" style=\"margin: 0px; padding: 0px; border: 0px; vertical-align: top; object-fit: contain; max-width: 100%; height: auto;\"></font></p><h2 style=\"margin: 5px auto 7px; padding: 0px; font-weight: var(--bold600); font-size: 18pt; font-family: Arial, Helvetica, sans-serif;\"><strong style=\"margin: 0px; padding: 0px; font-size: var(--gap22) !important;\"><font color=\"#000000\">Lịch sử nước hoa Calvin Klein CK One</font></strong></h2><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;\"><font color=\"#000000\"><strong style=\"margin: 0px; padding: 0px;\">Nước hoa Calvin Klein CK One&nbsp;</strong>được ra mắt vào năm 1994 và là một sáng tạo của hai nhà sáng chế nước hoa&nbsp;<a href=\"https://www.facebook.com/watch/?v=251480506299032\" style=\"margin: 0px; padding: 0px; text-decoration: none;\">Alberto Morillas</a>&nbsp;và&nbsp;<a href=\"https://www.fragrantica.com/noses/Harry_Fremont.html\" style=\"margin: 0px; padding: 0px; text-decoration: none;\">Harry Fremont</a>.&nbsp;<a href=\"https://vuahanghieu.com/calvin-klein/nuoc-hoa\" title=\"Nước hoa CK\" data-keyword-link=\"157\" style=\"margin: 0px; padding: 0px; text-decoration: none;\">Nước hoa CK</a>&nbsp;nổi tiếng trong mát, tự nhiên với mùi thơm nhẹ nhàng, thư giãn khiến bạn luôn có cảm giác muốn dùng nó và ngửi thấy nó phảng phất quanh mình.</font></p><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;\"><img class=\"product-img-responsive\" data-src=\"https://cdn.vuahanghieu.com/unsafe/0x0/left/top/smart/filters:quality(90)/https://admin.vuahanghieu.com/upload/news/content/2020/10/nuoc-hoa-ck-one-unisex-100ml-anh-3-jpg-1578286948-06012020120228-jpg-1603099314-19102020162154.jpg\" alt=\"Nước Hoa Calvin Klein (CK) CK One Cho Cả Nam Và Nữ, 100ml - Nước hoa - Vua Hàng Hiệu\" width=\"600\" src=\"https://cdn.vuahanghieu.com/unsafe/0x0/left/top/smart/filters:quality(90)/https://admin.vuahanghieu.com/upload/news/content/2020/10/nuoc-hoa-ck-one-unisex-100ml-anh-3-jpg-1578286948-06012020120228-jpg-1603099314-19102020162154.jpg\" style=\"margin: 0px auto; padding: 0px; border: 0px; vertical-align: top; object-fit: contain; max-width: 100%; height: auto; display: block;\"></p><h2 style=\"margin: 5px auto 7px; padding: 0px; font-weight: var(--bold600); font-size: 18pt; font-family: Arial, Helvetica, sans-serif;\"><strong style=\"margin: 0px; padding: 0px; font-size: var(--gap22) !important;\"><font color=\"#000000\">Thiết kế chai nước hoa Calvin Klein CK One 100ml đơn giản, cá tính</font></strong></h2><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;\"><font color=\"#000000\">Chính bản thân của chai&nbsp;<a href=\"https://vuahanghieu.com/nuoc-hoa-calvin-klein-ck-ck-one-cho-ca-nam-va-nu-100ml-ph000511\" style=\"margin: 0px; padding: 0px; text-decoration: none;\"><strong style=\"margin: 0px; padding: 0px;\">nước hoa Calvin Klein CK One 100ml</strong></a>&nbsp;cũng đã mang lại yếu tố tươi mát khi kết hợp thủy tinh mờ như băng với nắp chai bằng kim loại bạc sáng bóng. Bạn có thể sử dụng&nbsp;<strong style=\"margin: 0px; padding: 0px;\">nước hoa CK One</strong>&nbsp;lên cả người một cách thật hào phóng vì hương thơm rất nhẹ nhàng và thư giãn, mang lại cảm giác thân mật. Hương thơm rất thích hợp cho việc sử dụng vào ban ngày cho dù bạn đang đi làm hoặc đang phiêu lưu vào những dịp cuối tuần.</font></p><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;\"><img class=\"product-img-responsive\" data-src=\"https://cdn.vuahanghieu.com/unsafe/0x0/left/top/smart/filters:quality(90)/https://admin.vuahanghieu.com/upload/news/content/2020/10/ck-one-2-chiaki-vn-jpg-1478161853-03112016153053-jpg-1582874736-28022020142536-jpg-1583486931-06032020162851-jpg-1603099323-19102020162203.jpg\" alt=\"Nước Hoa Calvin Klein (CK) CK One Cho Cả Nam Và Nữ, 100ml - Nước hoa - Vua Hàng Hiệu\" width=\"600\" height=\"343\" src=\"https://cdn.vuahanghieu.com/unsafe/0x0/left/top/smart/filters:quality(90)/https://admin.vuahanghieu.com/upload/news/content/2020/10/ck-one-2-chiaki-vn-jpg-1478161853-03112016153053-jpg-1582874736-28022020142536-jpg-1583486931-06032020162851-jpg-1603099323-19102020162203.jpg\" style=\"margin: 0px auto; padding: 0px; border: 0px; vertical-align: top; object-fit: contain; max-width: 100%; height: auto; display: block;\"></p><h2 style=\"margin: 5px auto 7px; padding: 0px; font-weight: var(--bold600); font-size: 18pt; font-family: Arial, Helvetica, sans-serif;\"><strong style=\"margin: 0px; padding: 0px; font-size: var(--gap22) !important;\"><font color=\"#000000\">Mùi hương nước hoa Calvin Klein CK One thanh lịch, tinh tế</font></strong></h2><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;\"><font color=\"#000000\">Hương thơm ban đầu mang lại nhiều ý tưởng và cảm hứng cho người dùng. Sau đó hương thơm nở rộ với hương hoa nhài tươi, mang lại cảm giác tươi mát. Hương trà xanh và huyết phách mang lại một chút ấm áp đầy tinh tế cho hỗn hợp nước hoa. Hương đu đủ và dứa hòa huyện cùng với một ít hoa oải hương tạo nên một lớp hương nền đầy sảng khoái và tràn đầy năng lượng. Tất cả tạo nên mùi hương đặc trưng khó quên của&nbsp;<strong style=\"margin: 0px; padding: 0px;\">CK One</strong>.</font></p><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;\"><img class=\"product-img-responsive\" data-src=\"https://cdn.vuahanghieu.com/unsafe/0x0/left/top/smart/filters:quality(90)/https://admin.vuahanghieu.com/upload/news/content/2020/12/nuoc-hoa-calvin-klein-ck-one-edt-jpg-1608794788-24122020142628.jpg\" alt=\"Nước Hoa Calvin Klein (CK) CK One Cho Cả Nam Và Nữ, 100ml - Nước hoa - Vua Hàng Hiệu\" width=\"600\" height=\"600\" src=\"https://cdn.vuahanghieu.com/unsafe/0x0/left/top/smart/filters:quality(90)/https://admin.vuahanghieu.com/upload/news/content/2020/12/nuoc-hoa-calvin-klein-ck-one-edt-jpg-1608794788-24122020142628.jpg\" style=\"margin: 0px auto; padding: 0px; border: 0px; vertical-align: top; object-fit: contain; max-width: 100%; height: auto; display: block;\"></p><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;\"><font color=\"#000000\"><a href=\"https://vuahanghieu.com/calvin-klein/nuoc-hoa/ck-one\" style=\"margin: 0px; padding: 0px; text-decoration: none;\">Nước hoa CK One</a>&nbsp;là tổ hợp trong sự đa dạng nhiều phong cách, một chút gì đó mong manh nữ tính, một chút gì đó phóng khoáng, mạnh mẽ; là loại&nbsp;<a href=\"https://vuahanghieu.com/nuoc-hoa\" style=\"margin: 0px; padding: 0px; text-decoration: none;\">nước hoa cao cấp</a>&nbsp;mang đến cho người ta cảm giác an ủi, trân trọng trong từng khoảnh khắc với 3 tầng hương.</font></p><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;\"><font color=\"#000000\">Mở đầu là hương tươi mát, dịu nhẹ của trái thơm, mùi sương, quýt, đu đủ, cam bergamot, đậu khẩu, chanh. Hương giữa là sự ngọt ngào, say đắm của nhục đậu khấu, hoa violet, gốc cây oris, hoa nhài, huệ, thung lũng, hoa hồng. Lớp hướng cuối với hương thêm bền bỉ, nồng nàn của gỗ đàn hương, xạ hương, tuyết tùng, gỗ cây oakmoss&nbsp;</font></p><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;\"><font color=\"#000000\">&nbsp;</font></p><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;\"><img class=\"product-img-responsive\" data-src=\"https://cdn.vuahanghieu.com/unsafe/0x0/left/top/smart/filters:quality(90)/https://admin.vuahanghieu.com/upload/news/content/2020/04/ck-one-png-1586922768-15042020105248.png\" alt=\"Nước Hoa Calvin Klein (CK) CK One Cho Cả Nam Và Nữ, 100ml - Nước hoa - Vua Hàng Hiệu\" width=\"600\" height=\"600\" src=\"https://cdn.vuahanghieu.com/unsafe/0x0/left/top/smart/filters:quality(90)/https://admin.vuahanghieu.com/upload/news/content/2020/04/ck-one-png-1586922768-15042020105248.png\" style=\"margin: 0px auto; padding: 0px; border: 0px; vertical-align: top; object-fit: contain; max-width: 100%; height: auto; display: block;\"></p><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;\"><font color=\"#000000\">&nbsp;</font></p><p style=\"margin-top: 10px; margin-right: 0px; margin-left: 0px; padding: 0px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;\"><font color=\"#000000\">Bạn có thể sử dụng&nbsp;<span style=\"text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">nước hoa của Calvin Klein</span>&nbsp;lên cả người một cách thật hào phóng vì hương thơm rất nhẹ nhàng và thư giãn, mang lại cảm giác thân mật.</font></p>', 0, 0, 1, 0, 0, '2024-12-09 03:52:24', '2024-12-23 03:10:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `attribute_value_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `attribute_value_id`, `created_at`, `updated_at`) VALUES
(578, 30, 29, '2024-11-09 10:23:40', '2024-11-09 10:23:40'),
(579, 30, 2, '2024-11-09 10:23:40', '2024-11-09 10:23:40'),
(580, 30, 7, '2024-11-09 10:23:40', '2024-11-09 10:23:40'),
(581, 30, 40, '2024-11-09 10:23:40', '2024-11-09 10:23:40'),
(582, 30, 17, '2024-11-09 10:23:40', '2024-11-09 10:23:40'),
(583, 30, 20, '2024-11-09 10:23:40', '2024-11-09 10:23:40'),
(584, 30, 32, '2024-11-09 10:23:40', '2024-11-09 10:23:40'),
(585, 30, 36, '2024-11-09 10:23:40', '2024-11-09 10:23:40'),
(586, 30, 25, '2024-11-09 10:23:40', '2024-11-09 10:23:40'),
(679, 41, 28, '2024-11-15 08:12:42', '2024-11-15 08:12:42'),
(680, 41, 1, '2024-11-15 08:12:42', '2024-11-15 08:12:42'),
(681, 41, 39, '2024-11-15 08:12:42', '2024-11-15 08:12:42'),
(682, 41, 40, '2024-11-15 08:12:42', '2024-11-15 08:12:42'),
(683, 41, 18, '2024-11-15 08:12:42', '2024-11-15 08:12:42'),
(684, 41, 20, '2024-11-15 08:12:42', '2024-11-15 08:12:42'),
(685, 41, 32, '2024-11-15 08:12:42', '2024-11-15 08:12:42'),
(686, 41, 36, '2024-11-15 08:12:42', '2024-11-15 08:12:42'),
(687, 41, 26, '2024-11-15 08:12:42', '2024-11-15 08:12:42'),
(688, 42, 29, '2024-11-15 08:17:06', '2024-11-15 08:17:06'),
(689, 42, 2, '2024-11-15 08:17:06', '2024-11-15 08:17:06'),
(690, 42, 7, '2024-11-15 08:17:06', '2024-11-15 08:17:06'),
(691, 42, 40, '2024-11-15 08:17:06', '2024-11-15 08:17:06'),
(692, 42, 17, '2024-11-15 08:17:06', '2024-11-15 08:17:06'),
(693, 42, 23, '2024-11-15 08:17:06', '2024-11-15 08:17:06'),
(694, 42, 32, '2024-11-15 08:17:06', '2024-11-15 08:17:06'),
(695, 42, 36, '2024-11-15 08:17:06', '2024-11-15 08:17:06'),
(696, 42, 25, '2024-11-15 08:17:06', '2024-11-15 08:17:06'),
(697, 43, 38, '2024-11-15 08:32:10', '2024-11-15 08:32:10'),
(698, 43, 1, '2024-11-15 08:32:10', '2024-11-15 08:32:10'),
(699, 43, 9, '2024-11-15 08:32:10', '2024-11-15 08:32:10'),
(700, 43, 12, '2024-11-15 08:32:10', '2024-11-15 08:32:10'),
(701, 43, 17, '2024-11-15 08:32:10', '2024-11-15 08:32:10'),
(702, 43, 21, '2024-11-15 08:32:10', '2024-11-15 08:32:10'),
(703, 43, 33, '2024-11-15 08:32:10', '2024-11-15 08:32:10'),
(704, 43, 36, '2024-11-15 08:32:10', '2024-11-15 08:32:10'),
(705, 43, 26, '2024-11-15 08:32:10', '2024-11-15 08:32:10'),
(706, 44, 30, '2024-11-15 08:38:32', '2024-11-15 08:38:32'),
(707, 44, 2, '2024-11-15 08:38:32', '2024-11-15 08:38:32'),
(708, 44, 7, '2024-11-15 08:38:32', '2024-11-15 08:38:32'),
(709, 44, 12, '2024-11-15 08:38:32', '2024-11-15 08:38:32'),
(710, 44, 16, '2024-11-15 08:38:32', '2024-11-15 08:38:32'),
(711, 44, 21, '2024-11-15 08:38:32', '2024-11-15 08:38:32'),
(712, 44, 32, '2024-11-15 08:38:32', '2024-11-15 08:38:32'),
(713, 44, 36, '2024-11-15 08:38:32', '2024-11-15 08:38:32'),
(714, 44, 43, '2024-11-15 08:38:32', '2024-11-15 08:38:32'),
(715, 45, 44, '2024-11-15 20:51:50', '2024-11-15 20:51:50'),
(716, 45, 2, '2024-11-15 20:51:50', '2024-11-15 20:51:50'),
(717, 45, 37, '2024-11-15 20:51:50', '2024-11-15 20:51:50'),
(718, 45, 45, '2024-11-15 20:51:50', '2024-11-15 20:51:50'),
(719, 45, 16, '2024-11-15 20:51:50', '2024-11-15 20:51:50'),
(720, 45, 21, '2024-11-15 20:51:50', '2024-11-15 20:51:50'),
(721, 45, 32, '2024-11-15 20:51:50', '2024-11-15 20:51:50'),
(722, 45, 36, '2024-11-15 20:51:50', '2024-11-15 20:51:50'),
(723, 45, 26, '2024-11-15 20:51:50', '2024-11-15 20:51:50'),
(724, 46, 44, '2024-11-15 20:58:39', '2024-11-15 20:58:39'),
(725, 46, 3, '2024-11-15 20:58:39', '2024-11-15 20:58:39'),
(726, 46, 37, '2024-11-15 20:58:39', '2024-11-15 20:58:39'),
(727, 46, 45, '2024-11-15 20:58:39', '2024-11-15 20:58:39'),
(728, 46, 17, '2024-11-15 20:58:39', '2024-11-15 20:58:39'),
(729, 46, 23, '2024-11-15 20:58:39', '2024-11-15 20:58:39'),
(730, 46, 33, '2024-11-15 20:58:39', '2024-11-15 20:58:39'),
(731, 46, 36, '2024-11-15 20:58:39', '2024-11-15 20:58:39'),
(732, 46, 25, '2024-11-15 20:58:39', '2024-11-15 20:58:39'),
(742, 48, 28, '2024-11-18 06:29:02', '2024-11-18 06:29:02'),
(743, 48, 1, '2024-11-18 06:29:02', '2024-11-18 06:29:02'),
(744, 48, 39, '2024-11-18 06:29:02', '2024-11-18 06:29:02'),
(745, 48, 13, '2024-11-18 06:29:02', '2024-11-18 06:29:02'),
(746, 48, 18, '2024-11-18 06:29:02', '2024-11-18 06:29:02'),
(747, 48, 22, '2024-11-18 06:29:02', '2024-11-18 06:29:02'),
(748, 48, 33, '2024-11-18 06:29:02', '2024-11-18 06:29:02'),
(749, 48, 36, '2024-11-18 06:29:02', '2024-11-18 06:29:02'),
(750, 48, 25, '2024-11-18 06:29:02', '2024-11-18 06:29:02'),
(751, 49, 46, '2024-11-18 07:04:32', '2024-11-18 07:04:32'),
(752, 49, 1, '2024-11-18 07:04:32', '2024-11-18 07:04:32'),
(753, 49, 37, '2024-11-18 07:04:32', '2024-11-18 07:04:32'),
(754, 49, 47, '2024-11-18 07:04:32', '2024-11-18 07:04:32'),
(755, 49, 17, '2024-11-18 07:04:32', '2024-11-18 07:04:32'),
(756, 49, 22, '2024-11-18 07:04:32', '2024-11-18 07:04:32'),
(757, 49, 32, '2024-11-18 07:04:32', '2024-11-18 07:04:32'),
(758, 49, 36, '2024-11-18 07:04:32', '2024-11-18 07:04:32'),
(759, 49, 26, '2024-11-18 07:04:32', '2024-11-18 07:04:32'),
(760, 50, 48, '2024-11-18 07:08:37', '2024-11-18 07:08:37'),
(761, 50, 1, '2024-11-18 07:08:37', '2024-11-18 07:08:37'),
(762, 50, 49, '2024-11-18 07:08:37', '2024-11-18 07:08:37'),
(763, 50, 12, '2024-11-18 07:08:37', '2024-11-18 07:08:37'),
(764, 50, 19, '2024-11-18 07:08:37', '2024-11-18 07:08:37'),
(765, 50, 20, '2024-11-18 07:08:37', '2024-11-18 07:08:37'),
(766, 50, 32, '2024-11-18 07:08:37', '2024-11-18 07:08:37'),
(767, 50, 36, '2024-11-18 07:08:37', '2024-11-18 07:08:37'),
(768, 50, 26, '2024-11-18 07:08:37', '2024-11-18 07:08:37'),
(769, 51, 30, '2024-12-09 03:38:20', '2024-12-09 03:38:20'),
(770, 51, 2, '2024-12-09 03:38:20', '2024-12-09 03:38:20'),
(771, 51, 39, '2024-12-09 03:38:20', '2024-12-09 03:38:20'),
(772, 51, 41, '2024-12-09 03:38:20', '2024-12-09 03:38:20'),
(773, 51, 17, '2024-12-09 03:38:20', '2024-12-09 03:38:20'),
(774, 51, 22, '2024-12-09 03:38:20', '2024-12-09 03:38:20'),
(775, 51, 32, '2024-12-09 03:38:20', '2024-12-09 03:38:20'),
(776, 51, 36, '2024-12-09 03:38:20', '2024-12-09 03:38:20'),
(777, 51, 43, '2024-12-09 03:38:20', '2024-12-09 03:38:20'),
(778, 52, 50, '2024-12-09 03:52:24', '2024-12-09 03:52:24'),
(779, 52, 2, '2024-12-09 03:52:24', '2024-12-09 03:52:24'),
(780, 52, 51, '2024-12-09 03:52:24', '2024-12-09 03:52:24'),
(781, 52, 12, '2024-12-09 03:52:24', '2024-12-09 03:52:24'),
(782, 52, 16, '2024-12-09 03:52:24', '2024-12-09 03:52:24'),
(783, 52, 23, '2024-12-09 03:52:24', '2024-12-09 03:52:24'),
(784, 52, 32, '2024-12-09 03:52:24', '2024-12-09 03:52:24'),
(785, 52, 36, '2024-12-09 03:52:24', '2024-12-09 03:52:24'),
(786, 52, 52, '2024-12-09 03:52:24', '2024-12-09 03:52:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `volume` int NOT NULL,
  `quantity` int NOT NULL,
  `inventory_quantity` int DEFAULT '0',
  `price` int NOT NULL,
  `entry_price` int DEFAULT '0',
  `discount` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `volume`, `quantity`, `inventory_quantity`, `price`, `entry_price`, `discount`, `created_at`, `updated_at`) VALUES
(93, 30, 50, 73, 78, 1330000, 1100000, 5, '2024-11-09 08:57:13', '2024-12-06 23:49:16'),
(94, 30, 100, 100, 200, 1730000, 1500000, 5, '2024-11-09 08:57:13', '2024-12-05 22:04:59'),
(95, 30, 200, 179, 189, 2380000, 2100000, 5, '2024-11-09 08:57:13', '2024-12-09 04:45:35'),
(126, 41, 60, 13, 28, 2680000, 2100000, 5, '2024-11-15 08:12:42', '2024-12-07 03:41:52'),
(127, 41, 100, 20, 40, 3430000, 3150000, 5, '2024-11-15 08:12:42', '2024-11-18 07:29:06'),
(128, 41, 200, 25, 45, 4780000, 4600000, 5, '2024-11-15 08:12:42', '2024-11-18 07:42:36'),
(129, 42, 100, 6, 11, 1780000, 1500000, 5, '2024-11-15 08:17:05', '2024-12-09 18:12:25'),
(130, 42, 200, 25, 30, 2380000, 200000, 5, '2024-11-15 08:17:05', '2024-11-15 08:57:31'),
(131, 43, 30, 11, 21, 1880000, 1500000, 5, '2024-11-15 08:32:10', '2024-12-09 18:11:12'),
(132, 43, 50, 23, 43, 2480000, 2000000, 5, '2024-11-15 08:32:10', '2024-11-15 21:13:04'),
(133, 44, 10, 18, 43, 250000, 180000, 5, '2024-11-15 08:38:32', '2024-12-09 18:11:16'),
(134, 45, 30, 24, 74, 1130000, 800000, 5, '2024-11-15 20:51:50', '2024-12-08 13:17:45'),
(135, 45, 50, 40, 125, 1530000, 1150000, 5, '2024-11-15 20:51:50', '2024-12-09 04:45:41'),
(136, 46, 5, 134, 189, 400000, 320000, 5, '2024-11-15 20:58:39', '2024-12-09 18:11:16'),
(138, 48, 100, 28, 48, 3180000, 2450000, 5, '2024-11-18 06:29:02', '2024-12-09 18:10:54'),
(139, 48, 150, 30, 50, 4130000, 3550000, 5, '2024-11-18 06:29:02', '2024-11-18 07:29:06'),
(140, 49, 100, 45, 75, 3730000, 3050000, 5, '2024-11-18 07:04:32', '2024-12-09 18:10:58'),
(141, 49, 150, 50, 70, 4530000, 3750000, 5, '2024-11-18 07:04:32', '2024-11-18 07:29:06'),
(142, 50, 5, 35, 85, 380000, 310000, 5, '2024-11-18 07:08:37', '2024-11-18 07:20:57'),
(143, 51, 105, 42, 47, 850000, 650000, 5, '2024-12-09 03:38:20', '2024-12-09 18:14:00'),
(144, 52, 10, 17, 17, 269000, 220000, 5, '2024-12-09 03:52:24', '2024-12-09 18:14:00'),
(145, 52, 100, 20, 20, 549000, 450000, 5, '2024-12-09 03:52:24', '2024-12-09 03:52:24'),
(146, 52, 200, 25, 25, 990000, 900000, 10, '2024-12-09 03:52:24', '2024-12-09 03:52:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `promotions`
--

CREATE TABLE `promotions` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `start_date` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `end_date` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `discount` int NOT NULL,
  `product_list` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `promotions`
--

INSERT INTO `promotions` (`id`, `name`, `start_date`, `end_date`, `code`, `discount`, `product_list`, `created_at`, `updated_at`) VALUES
(15, 'Khuyến mãi 30/12', '30/12/2024', '30/1/2025', 'KM30', 5, '[\"41\",\"43\",\"44\",\"46\",\"48\",\"49\",\"50\"]', '2024-12-05 21:38:50', '2024-12-05 21:38:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'editor', NULL, NULL),
(3, 'viewer', NULL, NULL),
(5, 'guest', '2024-10-01 22:27:02', '2024-10-01 22:27:16'),
(6, 'customer', '2024-10-23 02:21:06', '2024-10-23 02:21:06'),
(12, 'Thực tập', '2024-11-17 04:37:38', '2024-12-20 04:37:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 2, 2, NULL, NULL),
(3, 3, 3, NULL, NULL),
(8, 1, 1, NULL, NULL),
(15, 1, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `stock_entries`
--

CREATE TABLE `stock_entries` (
  `id` int NOT NULL,
  `inventory_changes_id` int DEFAULT NULL,
  `product_size_id` int DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `entry_date` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `entry_price` int DEFAULT NULL,
  `supplier_name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `expiry_date` varchar(50) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `damaged_reason` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `stock_entries`
--

INSERT INTO `stock_entries` (`id`, `inventory_changes_id`, `product_size_id`, `product_name`, `entry_date`, `quantity`, `entry_price`, `supplier_name`, `expiry_date`, `damaged_reason`, `created_at`, `updated_at`) VALUES
(66, 51, 133, 'Product Name', '2024-11-15 15:57:31', 5, 200000, '', '22-2-2222', '', '2024-11-15 15:57:31', '2024-11-15 15:57:31'),
(67, 51, 131, 'Product Name', '2024-11-15 15:57:31', 10, 1500000, '', '22-2-2222', '', '2024-11-15 15:57:31', '2024-11-15 15:57:31'),
(68, 51, 132, 'Product Name', '2024-11-15 15:57:31', 20, 2000000, '', '22-2-2222', '', '2024-11-15 15:57:31', '2024-11-15 15:57:31'),
(69, 51, 129, 'Product Name', '2024-11-15 15:57:31', 5, 1500000, '', '22-2-2222', '', '2024-11-15 15:57:31', '2024-11-15 15:57:31'),
(70, 51, 130, 'Product Name', '2024-11-15 15:57:31', 5, 200000, '', '22-2-2222', '', '2024-11-15 15:57:31', '2024-11-15 15:57:31'),
(71, 51, 126, 'Product Name', '2024-11-15 15:57:31', 5, 2200000, '', '22-2-2222', '', '2024-11-15 15:57:31', '2024-11-15 15:57:31'),
(72, 51, 127, 'Product Name', '2024-11-15 15:57:31', 5, 3200000, '', '22-2-2222', '', '2024-11-15 15:57:31', '2024-11-15 15:57:31'),
(73, 51, 128, 'Product Name', '2024-11-15 15:57:31', 5, 4500000, '', '22-2-2222', '', '2024-11-15 15:57:31', '2024-11-15 15:57:31'),
(74, 51, 93, 'Product Name', '2024-11-15 15:57:31', 5, 1100000, '', '22-2-2222', '', '2024-11-15 15:57:31', '2024-11-15 15:57:31'),
(75, 51, 94, 'Product Name', '2024-11-15 15:57:31', 5, 1500000, '', '22-2-2222', '', '2024-11-15 15:57:31', '2024-11-15 15:57:31'),
(76, 51, 95, 'Product Name', '2024-11-15 15:57:31', 10, 2100000, '', '22-2-2222', '', '2024-11-15 15:57:31', '2024-11-15 15:57:31'),
(77, 52, 134, 'Product Name', '2024-11-16 03:59:56', 50, 800000, '', '22-2-2222', '', '2024-11-16 03:59:56', '2024-11-16 03:59:56'),
(78, 52, 135, 'Product Name', '2024-11-16 03:59:56', 80, 1200000, '', '22-2-2222', '', '2024-11-16 03:59:56', '2024-11-16 03:59:56'),
(79, 52, 136, 'Product Name', '2024-11-16 03:59:56', 50, 300000, '', '22-2-2222', '', '2024-11-16 03:59:56', '2024-11-16 03:59:56'),
(80, 53, 142, 'Product Name', '2024-11-18 14:20:57', 50, 310000, '', '22-2-2222', '', '2024-11-18 14:20:57', '2024-11-18 14:20:57'),
(81, 54, 133, 'Product Name', '2024-11-18 14:29:06', 20, 180000, '', '22-2-2222', '', '2024-11-18 14:29:06', '2024-11-18 14:29:06'),
(82, 54, 140, 'Product Name', '2024-11-18 14:29:06', 30, 3050000, '', '22-2-2222', '', '2024-11-18 14:29:06', '2024-11-18 14:29:06'),
(83, 54, 141, 'Product Name', '2024-11-18 14:29:06', 20, 3750000, '', '22-2-2222', '', '2024-11-18 14:29:06', '2024-11-18 14:29:06'),
(84, 54, 138, 'Product Name', '2024-11-18 14:29:06', 20, 2450000, '', '22-2-2222', '', '2024-11-18 14:29:06', '2024-11-18 14:29:06'),
(85, 54, 139, 'Product Name', '2024-11-18 14:29:06', 20, 3550000, '', '22-2-2222', '', '2024-11-18 14:29:06', '2024-11-18 14:29:06'),
(86, 54, 126, 'Product Name', '2024-11-18 14:29:06', 10, 2100000, '', '22-2-2222', '', '2024-11-18 14:29:06', '2024-11-18 14:29:06'),
(87, 54, 127, 'Product Name', '2024-11-18 14:29:06', 15, 3150000, '', '22-2-2222', '', '2024-11-18 14:29:06', '2024-11-18 14:29:06'),
(88, 54, 128, 'Product Name', '2024-11-18 14:29:06', 15, 4600000, '', '22-2-2222', '', '2024-11-18 14:29:06', '2024-11-18 14:29:06'),
(89, 54, 136, 'Product Name', '2024-11-18 14:29:06', 5, 320000, '', '22-2-2222', '', '2024-11-18 14:29:06', '2024-11-18 14:29:06'),
(90, 54, 135, 'Product Name', '2024-11-18 14:29:06', 5, 1150000, '', '22-2-2222', '', '2024-11-18 14:29:06', '2024-11-18 14:29:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tb_transactions`
--

CREATE TABLE `tb_transactions` (
  `id` int NOT NULL,
  `gateway` varchar(100) NOT NULL,
  `transaction_date` timestamp NOT NULL,
  `account_number` varchar(100) DEFAULT NULL,
  `sub_account` varchar(250) DEFAULT NULL,
  `amount_in` decimal(20,2) DEFAULT '0.00',
  `amount_out` decimal(20,2) DEFAULT '0.00',
  `accumulated` decimal(20,2) DEFAULT '0.00',
  `code` varchar(250) DEFAULT NULL,
  `transaction_content` text,
  `reference_number` varchar(255) DEFAULT NULL,
  `body` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `tb_transactions`
--

INSERT INTO `tb_transactions` (`id`, `gateway`, `transaction_date`, `account_number`, `sub_account`, `amount_in`, `amount_out`, `accumulated`, `code`, `transaction_content`, `reference_number`, `body`, `created_at`, `updated_at`) VALUES
(22, 'MBBank', '2023-03-25 07:02:37', '9870102038888', NULL, 0.00, 0.00, 0.00, NULL, 'Test', 'MBVCB.3278907687', '', '2024-11-06 02:06:49', '2024-11-06 02:06:49'),
(2, 'MBBank', '2024-11-03 15:19:29', '9870102038888', NULL, 2000.00, 0.00, 0.00, NULL, 'NGUYEN CONG QUYEN chuyen tien tu Viettel Money', 'FT24309447747530', 'BankAPINotify NGUYEN CONG QUYEN chuyen tien tu Viettel Money', '2024-11-03 09:14:09', '2024-11-03 09:14:09'),
(3, 'MBBank', '2024-10-30 03:00:00', '9870102038888', NULL, 1500000.00, 0.00, 1500000.00, NULL, 'Tiền lương tháng 10', 'MB.001', 'Tiền lương từ công ty', '2024-11-03 09:14:09', '2024-11-03 09:14:09'),
(4, 'MBBank', '2024-10-31 05:30:00', '1234567890', NULL, 0.00, 300000.00, 1200000.00, NULL, 'Thanh toán điện thoại', 'TCB.002', 'Thanh toán hóa đơn điện thoại tháng 10', '2024-11-03 09:14:09', '2024-11-03 09:14:09'),
(5, 'MBBank', '2024-11-01 07:45:30', '987654321', NULL, 0.00, 750000.00, 450000.00, NULL, 'Mua sắm online', 'VCB.003', 'Mua hàng trên trang thương mại điện tử', '2024-11-03 09:14:09', '2024-11-03 09:14:09'),
(6, 'MBBank', '2024-11-02 02:15:00', '1357924680', NULL, 2000000.00, 0.00, 2450000.00, NULL, 'Tiền thưởng', 'SCB.004', 'Tiền thưởng tháng 11', '2024-11-03 09:14:09', '2024-11-03 09:14:09'),
(7, 'MBBank', '2024-11-03 09:30:00', '246813579', NULL, 0.00, 500000.00, 1950000.00, NULL, 'Rút tiền ATM', 'BIDV.005', 'Rút tiền mặt tại ATM', '2024-11-03 09:14:09', '2024-11-03 09:14:09'),
(21, 'MBBank', '2024-11-05 05:19:15', '9870102038888', NULL, 5000.00, 0.00, 0.00, NULL, 'OD54', 'FT24310029404410', 'BankAPINotify OD54', '2024-11-04 22:19:20', '2024-11-04 22:19:20'),
(23, 'MBBank', '2024-11-06 09:07:08', '9870102038888', NULL, 10000.00, 0.00, 0.00, NULL, 'OD57', 'FT24311295330862', 'BankAPINotify OD57', '2024-11-06 02:07:15', '2024-11-06 02:07:15'),
(20, 'MBBank', '2024-11-04 15:54:35', '987010203', NULL, 5660000.00, 0.00, 23325000.00, '', 'OD51', '', NULL, '2024-11-04 08:54:34', '2024-11-04 08:54:34'),
(18, 'MBBank', '2024-11-04 10:33:08', '987010203', NULL, 55000.00, 0.00, 105000.00, '', 'ODTEST2', '', NULL, '2024-11-04 08:39:01', '2024-11-04 08:39:01'),
(19, 'MBBank', '2024-11-04 15:39:37', '987010203', NULL, 17560000.00, 0.00, 17665000.00, '', 'OD50', '', NULL, '2024-11-04 08:48:08', '2024-11-04 08:48:08'),
(17, 'MBBank', '2024-11-04 04:38:32', '9870102038888', NULL, 5000.00, 0.00, 0.00, NULL, 'OD45', 'FT24309170441419', 'BankAPINotify OD45', '2024-11-03 21:38:39', '2024-11-03 21:38:39'),
(16, 'MBBank', '2024-11-04 04:30:47', '9870102038888', NULL, 5000.00, 0.00, 0.00, NULL, 'OD44', 'FT24309065000679', 'BankAPINotify OD44', '2024-11-03 21:31:10', '2024-11-03 21:31:10'),
(15, 'MBBank', '2024-11-03 09:30:00', '246813579', NULL, 0.00, 500000.00, 1950000.00, NULL, 'Rút tiền ATM', 'BIDV.008', 'Rút tiền mặt tại ATM', '2024-11-03 09:18:54', '2024-11-12 00:59:06'),
(24, 'MBBank', '2024-11-12 00:53:09', '987010203', 'NULL', 0.00, 500000.00, 23825000.00, '', 'Tra tien', '', NULL, '2024-11-11 17:53:15', '2024-11-12 00:59:35'),
(25, 'MBBank', '2024-11-16 03:38:03', '987010203', NULL, 2060000.00, 0.00, 25885000.00, '', 'OD82', '', NULL, '2024-11-15 20:38:04', '2024-11-15 20:38:04'),
(26, 'MBBank', '2024-11-16 03:42:00', '987010203', NULL, 13300000.00, 0.00, 39185000.00, '', 'OD83', '', NULL, '2024-11-15 20:42:02', '2024-11-15 20:42:02'),
(27, 'MBBank', '2024-11-16 04:19:51', '987010203', NULL, 280000.00, 0.00, 39465000.00, '', 'OD91', '', NULL, '2024-11-15 21:19:52', '2024-11-15 21:19:52'),
(28, 'MBBank', '2024-11-16 14:06:00', '9870102038888', NULL, 1.00, 0.00, 0.00, NULL, 'NODATA', '9870102038888-20241116', 'BankAPINotify NODATA', '2024-11-17 23:27:56', '2024-11-17 23:27:56'),
(29, 'MBBank', '2024-11-18 06:28:18', '987010203', NULL, 280000.00, 0.00, 39745000.00, '', 'OD95', '', NULL, '2024-11-17 23:28:21', '2024-11-17 23:28:21'),
(30, 'MBBank', '2024-11-18 14:41:46', '987010203', NULL, 23900000.00, 0.00, 63645000.00, '', 'OD96', '', NULL, '2024-11-18 07:41:46', '2024-11-18 07:41:46'),
(31, 'MBBank', '2024-12-02 10:17:53', '9870102038888', NULL, 2250000.00, 0.00, 0.00, NULL, 'MBVCB.7782670909.621154.NGUYEN TIENTHANG chuyen tien.CT tu 0011004349835 NGUYEN TIEN THANG toi 9870102038888 NGUYEN CONG QUYEN tai MB- Ma G', 'FT24337835690981', 'BankAPINotify MBVCB.7782670909.621154.NGUYEN TIENTHANG chuyen tien.CT tu 0011004349835 NGUYEN TIEN THANG toi 9870102038888 NGUYEN CONG QUYEN tai MB- Ma G', '2024-12-09 04:15:35', '2024-12-09 04:15:35'),
(32, 'MBBank', '2024-12-02 11:30:02', '9870102038888', NULL, 0.00, 2250000.00, 0.00, NULL, 'NGUYEN CONG QUYEN chuyen tien', 'FT24337108140620', 'BankAPINotify NGUYEN CONG QUYEN chuyen tien', '2024-12-09 04:15:35', '2024-12-09 04:15:35'),
(33, 'MBBank', '2024-12-09 11:15:51', '987010203', NULL, 14280000.00, 0.00, 77925000.00, '', 'OD104', '', NULL, '2024-12-09 04:15:55', '2024-12-09 04:15:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cart` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wishlist` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secret_key` int DEFAULT NULL,
  `verify_code` int DEFAULT NULL,
  `status` int DEFAULT '1',
  `preferences` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `avatar`, `birthday`, `gender`, `address`, `cart`, `wishlist`, `secret_key`, `verify_code`, `status`, `preferences`) VALUES
(1, 'Quyền Admin', 'admin@gmail.com', NULL, NULL, '$2y$10$4i8IvH6i.gWwVDNvKSI40.GRqlym5VBx8VMHIwElecglBf2ZEAG9S', NULL, NULL, '2024-12-15 10:17:20', NULL, '2002', 1, '{\"provinceId\":\"201\",\"districtId\":\"1490\",\"wardCode\":\"1A0808\",\"detailAddress\":\"35\"}', NULL, NULL, NULL, NULL, 1, NULL),
(2, 'Editor User', 'editor@gmail.com', NULL, NULL, '$2a$12$uPQ3sskArcLp.zj31vwOi.uLeV5RboVKYeqjnpCeZR1xHSC2HnsHm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(3, 'Viewer User', 'viewer@example.com', NULL, NULL, '$2a$12$8iEjSd4c8Vgkt0iNqJ8/a.W8IMJSgb2ekfz.wedcdY6AB9g24xCgO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(5, 'Lê Hoàng', 'lehoang123@gmail.com', NULL, NULL, '$2y$10$u7FXmPbxOQPvEB4al1N/7.1avT07Rj3iO3JXTc.k44zZnBt7Y0mUy', NULL, '2024-10-25 01:56:59', '2024-11-02 02:53:08', NULL, '2002', 1, '{\"provinceId\":\"201\",\"districtId\":\"1488\",\"wardCode\":\"1A0319\",\"detailAddress\":\"226\"}', NULL, NULL, NULL, NULL, 1, NULL),
(6, 'Lê Quyền', 'lequyen@gmail.com', NULL, NULL, '$2y$10$9cMhgBevoE1ihIM383/E/.ttSbdx5kN5aKM9iR8H5zypWFKANowca', NULL, '2024-11-03 22:13:10', '2024-11-03 22:13:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(7, 'Trần Hoàn', 'tranhoan@gmail.com', NULL, NULL, '$2y$10$FruWpSE2DKIENfHEtcPEpOePjOT7w4R2e93PetxT3KZao.ECYxhK6', NULL, '2024-11-15 20:33:20', '2024-12-09 05:40:57', NULL, '2006', 1, '{\"provinceId\":\"268\",\"districtId\":\"2045\",\"wardCode\":\"221011\",\"detailAddress\":\"16\"}', NULL, NULL, NULL, NULL, 1, NULL),
(8, 'Nguyễn Huy', 'nguyenhuy@gmail.com', NULL, NULL, '$2y$10$upWZUPkjsFWHRWH0T1hfOedQ1Fl.a6LsulGmJ9no3Vgf5LNjdbJhm', NULL, '2024-11-15 21:05:35', '2024-11-15 22:58:10', NULL, '2002', 1, '{\"provinceId\":\"225\",\"districtId\":\"1598\",\"wardCode\":\"800184\",\"detailAddress\":\"Th\\u00f4n 8\"}', NULL, NULL, NULL, NULL, 1, NULL),
(9, 'Quản lý Khoa', 'quanlykhoa@gmail.com', NULL, NULL, '$2y$10$jToT3m6wEvcsUzzu9fU0qOtd2g.Yx2ay9CoiWzxlRoselGXrlDngi', NULL, '2024-11-17 02:30:44', '2024-12-22 08:32:00', NULL, '1996', 1, '{\"provinceId\":\"249\",\"districtId\":\"1730\",\"wardCode\":\"190511\",\"detailAddress\":\"\\u0110\\u1ed9i 6\"}', NULL, NULL, NULL, NULL, 1, NULL),
(10, 'Quang Bình', 'quangbinh@gmail.com', NULL, NULL, '$2y$10$L2I8646ARxz8eI1LBbdBCewfJiYwvIdBdFMAZChy8BL3R4SnRSRcu', NULL, '2024-11-17 23:18:49', '2024-12-09 05:53:25', NULL, '2002', 1, '{\"provinceId\":\"201\",\"districtId\":\"1493\",\"wardCode\":\"1A0710\",\"detailAddress\":\"252\"}', NULL, NULL, NULL, NULL, 1, NULL),
(11, 'Nguyễn Hoàn', 'nguyenhoan@gmail.com', NULL, NULL, '$2y$10$Gqec5JwkWw6nJKORAiU7b.3TllxIkIDcC2yqgOGMRvBIk0bDUu5Gi', NULL, '2024-11-18 07:37:34', '2024-11-18 07:40:06', NULL, '2002', 1, '{\"provinceId\":\"201\",\"districtId\":\"1486\",\"wardCode\":\"1A0419\",\"detailAddress\":\"22\"}', NULL, NULL, NULL, NULL, 1, NULL),
(12, 'lelong', 'lelong@gmail.com', NULL, NULL, '$2y$10$7w7pUKOPwo7lOFolCaoTbuNevOP6HsElN.geh/NWn9fgZ/TzGd236', NULL, '2024-11-25 06:10:02', '2024-11-25 06:11:20', NULL, '2002', 1, '{\"provinceId\":\"201\",\"districtId\":\"3440\",\"wardCode\":\"13009\",\"detailAddress\":\"26\"}', NULL, NULL, NULL, NULL, 1, NULL),
(13, 'Quyen Nguyen', 'adquyen122@gmail.com', NULL, NULL, '$2y$10$Q0bd/IGDpzrvZO.UK.SxJ.i3xy1UTL0S7c6SRvLkrFcEq9Z8to1Ta', NULL, '2024-12-09 04:11:16', '2024-12-09 04:14:03', NULL, '2002', 1, '{\"provinceId\":\"268\",\"districtId\":\"1717\",\"wardCode\":\"220214\",\"detailAddress\":\"Th\\u00f4n 4\"}', NULL, NULL, NULL, NULL, 1, NULL),
(14, 'Đào Phú', 'daophu@gmail.com', NULL, NULL, '$2y$10$NMbVMtMewiFjeR/0zMFXT.ASOjDD7iL1IiUGy.TtglT59AVV5GuJ6', NULL, '2024-12-09 04:57:43', '2024-12-09 04:59:37', NULL, '2005', 0, '{\"provinceId\":\"201\",\"districtId\":\"1490\",\"wardCode\":\"1A0810\",\"detailAddress\":\"126\"}', NULL, NULL, NULL, NULL, 1, NULL),
(16, 'Bách khoa hà Nội', 'hust@gmail.com', NULL, NULL, '$2y$10$QMe7i42bVlQmdYdCwhlEYezjZgzSeU1bsyGoKQ11eBAuyr7ytOzCq', NULL, '2024-12-22 05:21:26', '2024-12-22 05:21:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_values_attribute_id_foreign` (`attribute_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `inventory_changes`
--
ALTER TABLE `inventory_changes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_size_id_foreign` (`product_size_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attributes_product_id_foreign` (`product_id`),
  ADD KEY `product_attributes_attribute_value_id_foreign` (`attribute_value_id`);

--
-- Chỉ mục cho bảng `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_sizes_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `stock_entries`
--
ALTER TABLE `stock_entries`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tb_transactions`
--
ALTER TABLE `tb_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `inventory_changes`
--
ALTER TABLE `inventory_changes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT cho bảng `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=823;

--
-- AUTO_INCREMENT cho bảng `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT cho bảng `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `stock_entries`
--
ALTER TABLE `stock_entries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT cho bảng `tb_transactions`
--
ALTER TABLE `tb_transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD CONSTRAINT `attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_size_id_foreign` FOREIGN KEY (`product_size_id`) REFERENCES `product_sizes` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD CONSTRAINT `product_attributes_attribute_value_id_foreign` FOREIGN KEY (`attribute_value_id`) REFERENCES `attribute_values` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_attributes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
