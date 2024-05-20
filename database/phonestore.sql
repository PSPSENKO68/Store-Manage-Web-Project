-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 09, 2024 lúc 08:20 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `phonestore`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `avatar` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `avatar`) VALUES
(6, 'Huawei', '1713945762Huawei.jpg'),
(10, 'Samsung', '1713945840Samsung.jpg'),
(11, 'Xiaomi', '1714024729Xiaomi.png'),
(12, 'Vivo', '1714024747Vivo.jpg'),
(13, 'Realme', '1714024777Realme.png'),
(14, 'Oppo', '1714024808Oppo.jpg'),
(15, 'Nokia', '1714024878Nokia.jpg'),
(16, 'Apple', '1714024931Apple.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `phonenumber` varchar(11) DEFAULT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`id`, `phonenumber`, `fullname`, `address`) VALUES
(13, '0839028339', 'Ngô Xuân Minh An', '123 Nguyễn Hữu Thọ'),
(14, '0914032929', 'Ngô Xuân Hiếu', '88 Trần Hưng Đạo'),
(15, '0345739820', 'Phạm Trần Hương Ly', '83 Tôn Đức Thắng '),
(16, '0123456789', 'Nguyễn Khánh Duy', '6942 Hồ Chí Minh'),
(17, '0835021739', 'Nguyễn Phước Hải', '19 Phạm Văn Đồng'),
(18, '0456739876', 'Ngô Xuân Hiến', '99 Nguyễn Thị Thập'),
(19, '0493758578', 'Trương Mỹ Lan', '183 Nguyễn Bỉnh Khiêm'),
(20, '0394758375', 'Ngô Xuân Lý', '99 Lenovo'),
(21, '0384758472', 'Nguyễn Thế Vinh', '95 Apple'),
(22, '09485730229', 'Ngô Đình Diệm', 'Dinh Độc Lâp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `total_money` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `price`, `num`, `total_money`) VALUES
(53, 25, 41, 1300, 1, 1300),
(54, 25, 34, 1350, 1, 1350),
(55, 26, 31, 1200, 1, 1200),
(56, 26, 19, 1400, 1, 1400),
(57, 27, 17, 1380, 1, 1380),
(58, 28, 29, 1100, 1, 1100),
(59, 28, 6, 1250, 1, 1250),
(60, 28, 16, 1350, 1, 1350),
(61, 28, 24, 1250, 1, 1250),
(62, 28, 45, 1050, 1, 1050),
(63, 28, 56, 1150, 1, 1150),
(64, 28, 74, 1800, 1, 1800),
(65, 28, 66, 1000, 1, 1000),
(66, 28, 80, 800, 1, 800),
(67, 28, 76, 1300, 1, 1300),
(68, 28, 22, 1150, 1, 1150),
(69, 28, 25, 1100, 1, 1100),
(70, 28, 35, 1200, 1, 1200),
(71, 28, 61, 1200, 1, 1200),
(72, 28, 72, 1500, 1, 1500),
(74, 30, 27, 1130, 1, 1130),
(75, 31, 29, 1100, 1, 1100),
(76, 31, 28, 1170, 1, 1170),
(77, 32, 4, 1300, 1, 1300),
(78, 32, 21, 1500, 1, 1500),
(79, 33, 4, 1300, 1, 1300),
(80, 33, 40, 1250, 1, 1250),
(81, 34, 4, 1300, 1, 1300),
(82, 34, 57, 1130, 1, 1130),
(83, 34, 2, 1200, 1, 1200),
(84, 35, 4, 1300, 2, 2600),
(85, 35, 3, 1250, 1, 1250),
(86, 35, 16, 1350, 1, 1350),
(87, 36, 4, 1300, 1, 1300),
(88, 36, 38, 1270, 1, 1270),
(89, 36, 62, 1000, 1, 1000),
(90, 37, 67, 980, 1, 980),
(91, 38, 78, 1500, 1, 1500),
(92, 38, 73, 1600, 1, 1600),
(93, 39, 80, 800, 1, 800),
(94, 39, 4, 1300, 1, 1300),
(95, 40, 4, 1300, 1, 1300),
(96, 40, 18, 1320, 1, 1320),
(97, 41, 13, 1450, 1, 1450),
(98, 41, 18, 1320, 1, 1320),
(99, 42, 28, 1170, 1, 1170),
(100, 42, 2, 1200, 1, 1200);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_history`
--

CREATE TABLE `order_history` (
  `id` int(11) NOT NULL,
  `totalmoney` double DEFAULT NULL,
  `money_in` double DEFAULT NULL,
  `money_out` double DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `cost` int(11) NOT NULL,
  `invoice` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_history`
--

INSERT INTO `order_history` (`id`, `totalmoney`, `money_in`, `money_out`, `order_date`, `quantity`, `customer_id`, `cost`, `invoice`) VALUES
(25, 2650, 2700, 50, '2024-05-07 17:01:28', 2, 13, 2050, '13_20240507_170128_invoice.pdf'),
(26, 2600, 2600, 0, '2024-05-07 17:26:16', 2, 14, 2000, '14_20240507_172616_invoice.pdf'),
(27, 1380, 1400, 20, '2024-05-07 17:27:52', 1, 15, 1080, '15_20240507_172752_invoice.pdf'),
(28, 18200, 20000, 1800, '2024-05-07 19:40:21', 15, 16, 13700, '16_20240507_194021_invoice.pdf'),
(30, 1130, 1130, 0, '2024-05-07 20:08:22', 1, 17, 830, '17_20240507_200822_invoice.pdf'),
(31, 2270, 3000, 730, '2024-05-07 20:58:19', 2, 16, 1670, '16_20240507_205819_invoice.pdf'),
(32, 2800, 3000, 200, '2024-05-07 21:05:35', 2, 18, 2200, '18_20240507_210535_invoice.pdf'),
(33, 2550, 2600, 50, '2024-05-07 21:10:09', 2, 13, 1950, '13_20240507_211009_invoice.pdf'),
(34, 3630, 4000, 370, '2024-05-07 21:15:54', 3, 19, 2730, '19_20240507_211554_invoice.pdf'),
(35, 5200, 12345, 7145, '2024-05-08 15:24:31', 4, 16, 4000, '16_20240508_152431_invoice.pdf'),
(36, 3570, 4000, 430, '2024-05-08 15:25:55', 3, 13, 2670, '13_20240508_152555_invoice.pdf'),
(37, 980, 1000, 20, '2024-05-08 15:36:24', 1, 16, 680, '16_20240508_153624_invoice.pdf'),
(38, 3100, 3500, 400, '2024-05-08 15:37:22', 2, 13, 2500, '13_20240508_153722_invoice.pdf'),
(39, 2100, 2500, 400, '2024-05-08 15:40:05', 2, 20, 1500, '20_20240508_154005_invoice.pdf'),
(40, 2620, 3000, 380, '2024-05-08 15:41:08', 2, 21, 2020, '21_20240508_154108_invoice.pdf'),
(41, 2770, 3000, 230, '2024-05-08 15:43:10', 2, 22, 2170, '22_20240508_154310_invoice.pdf'),
(42, 2370, 10000, 7630, '2024-05-09 13:16:54', 2, 16, 1770, '16_20240509_131654_invoice.pdf');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `avatar` varchar(250) DEFAULT NULL,
  `price_in` double DEFAULT NULL,
  `price_out` double DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `sold` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `avatar`, `price_in`, `price_out`, `category_id`, `created_at`, `updated_at`, `quantity`, `sold`) VALUES
(2, 'Huawei P50 Pro', 'huawei_p50_pro.jpg', 900, 1200, 6, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 93, 5),
(3, 'Huawei Mate 50', 'huawei_mate_50.jpg', 950, 1250, 6, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 144, 5),
(4, 'Huawei Nova 9', 'huawei_nova_9.jpg', 1000, 1300, 6, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 104, 15),
(5, 'Huawei Enjoy 20 Plus', 'huawei_enjoy_20_plus.jpg', 800, 1100, 6, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 69, 10),
(6, 'Huawei Honor Magic 4', 'huawei_honor_magic_4.jpg', 950, 1250, 6, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 89, 1),
(10, 'Huawei Watch GT 4', 'huawei_watch_gt_4.jpg', 950, 1250, 6, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 100, 0),
(12, 'Samsung Galaxy S24 Ultra', 'samsung_galaxy_s24_ultra.jpg', 1100, 1400, 10, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 100, 0),
(13, 'Samsung Galaxy S24', 'samsung_galaxy_s24.jpg', 1150, 1450, 10, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 148, 2),
(14, 'Samsung Galaxy A90', 'samsung_galaxy_a90.jpg', 1200, 1500, 10, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 119, 1),
(15, 'Samsung Galaxy Z Fold 5', 'samsung_galaxy_z_fold_5.jpg', 1000, 1300, 10, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 80, 0),
(16, 'Samsung Galaxy Tab S8', 'samsung_galaxy_tab_s8.jpg', 1050, 1350, 10, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 88, 2),
(17, 'Samsung Galaxy Watch 5', 'samsung_galaxy_watch_5.jpg', 1080, 1380, 10, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 109, 1),
(18, 'Samsung Galaxy Buds 3', 'samsung_galaxy_buds_3.jpg', 1020, 1320, 10, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 126, 4),
(19, 'Samsung Galaxy Book Pro', 'samsung_galaxy_book_pro.jpg', 1100, 1400, 10, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 67, 3),
(20, 'Samsung Galaxy Fit 2', 'samsung_galaxy_fit_2.jpg', 1150, 1450, 10, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 100, 0),
(21, 'Samsung Galaxy SmartTag+', 'samsung_galaxy_smarttag_plus.jpg', 1200, 1500, 10, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 138, 2),
(22, 'Xiaomi Mi 12 Pro', 'xiaomi_mi_12_pro.jpg', 850, 1150, 11, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 99, 1),
(23, 'Xiaomi Redmi K50', 'xiaomi_redmi_k50.jpg', 900, 1200, 11, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 149, 1),
(24, 'Xiaomi Black Shark 5', 'xiaomi_black_shark_5.jpg', 950, 1250, 11, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 119, 1),
(25, 'Xiaomi Poco X5', 'xiaomi_poco_x5.jpg', 800, 1100, 11, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 79, 1),
(26, 'Xiaomi Mi Pad 6', 'xiaomi_mi_pad_6.jpg', 850, 1150, 11, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 90, 0),
(27, 'Xiaomi Redmi AirDots 4', 'xiaomi_redmi_airdots_4.jpg', 830, 1130, 11, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 109, 1),
(28, 'Xiaomi Mi Band 7', 'xiaomi_mi_band_7.jpg', 870, 1170, 11, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 128, 2),
(29, 'Xiaomi Mi Watch 3', 'xiaomi_mi_watch_3.jpg', 800, 1100, 11, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 68, 2),
(30, 'Xiaomi Redmi Note 11', 'xiaomi_redmi_note_11.jpg', 850, 1150, 11, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 100, 0),
(31, 'Xiaomi Mi Robot Vacuum', 'xiaomi_mi_robot_vacuum.jpg', 900, 1200, 11, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 139, 1),
(32, 'Vivo X90 Pro', 'vivo_x90_pro.jpg', 950, 1250, 12, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 100, 0),
(33, 'Vivo Y60', 'vivo_y60.jpg', 1000, 1300, 12, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 149, 1),
(34, 'Vivo V25', 'vivo_v25.jpg', 1050, 1350, 12, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 119, 1),
(35, 'Vivo S9e', 'vivo_s9e.jpg', 900, 1200, 12, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 79, 1),
(36, 'Vivo T1 5G', 'vivo_t1_5g.jpg', 950, 1250, 12, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 89, 1),
(37, 'Vivo Y20s', 'vivo_y20s.jpg', 930, 1230, 12, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 110, 0),
(38, 'Vivo X50 Pro+', 'vivo_x50_pro_plus.jpg', 970, 1270, 12, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 129, 1),
(39, 'Vivo Watch 2', 'vivo_watch_2.jpg', 900, 1200, 12, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 70, 0),
(40, 'Vivo TWS Neo 4', 'vivo_tws_neo_4.jpg', 950, 1250, 12, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 98, 2),
(41, 'Vivo Wireless Charger', 'vivo_wireless_charger.jpg', 1000, 1300, 12, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 138, 2),
(42, 'Realme GT 3 Pro', 'realme_gt_3_pro.jpg', 800, 1100, 13, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 100, 0),
(43, 'Realme Narzo 50', 'realme_narzo_50.jpg', 850, 1150, 13, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 150, 0),
(44, 'Realme Q5', 'realme_q5.jpg', 900, 1200, 13, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 120, 0),
(45, 'Realme X9 Max', 'realme_x9_max.jpg', 750, 1050, 13, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 79, 1),
(46, 'Realme Buds Air 3', 'realme_buds_air_3.jpg', 800, 1100, 13, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 89, 1),
(47, 'Realme Watch 2 Pro', 'realme_watch_2_pro.jpg', 780, 1080, 13, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 110, 0),
(48, 'Realme Power Bank 2', 'realme_power_bank_2.jpg', 820, 1120, 13, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 130, 0),
(49, 'Realme Smart Scale', 'realme_smart_scale.jpg', 750, 1050, 13, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 70, 0),
(50, 'Realme TWS Neo 3', 'realme_tws_neo_3.jpg', 800, 1100, 13, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 100, 0),
(51, 'Realme Smart Cam 360', 'realme_smart_cam_360.jpg', 850, 1150, 13, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 140, 0),
(52, 'Oppo Find X5 Pro', 'oppo_find_x5_pro.jpg', 850, 1150, 14, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 100, 0),
(53, 'Oppo Reno 7', 'oppo_reno_7.jpg', 900, 1200, 14, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 150, 0),
(54, 'Oppo A96', 'oppo_a96.jpg', 950, 1250, 14, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 120, 0),
(55, 'Oppo K10', 'oppo_k10.jpg', 800, 1100, 14, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 80, 0),
(56, 'Oppo Enco Free 2', 'oppo_enco_free_2.jpg', 850, 1150, 14, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 89, 1),
(57, 'Oppo Band 2', 'oppo_band_2.jpg', 830, 1130, 14, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 109, 1),
(58, 'Oppo Watch Free', 'oppo_watch_free.jpg', 870, 1170, 14, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 130, 0),
(59, 'Oppo 65W SuperVOOC Charger', 'oppo_65w_supervooc_charger.jpg', 800, 1100, 14, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 69, 1),
(60, 'Oppo Smart Tag', 'oppo_smart_tag.jpg', 850, 1150, 14, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 100, 0),
(61, 'Oppo AirVOOC Wireless Charger', 'oppo_airvooc_wireless_charger.jpg', 900, 1200, 14, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 138, 2),
(62, 'Nokia G20', 'nokia_g20.jpg', 700, 1000, 15, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 99, 1),
(63, 'Nokia X100', 'nokia_x100.jpg', 750, 1050, 15, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 150, 0),
(64, 'Nokia C30', 'nokia_c30.jpg', 800, 1100, 15, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 119, 1),
(65, 'Nokia 5.4', 'nokia_5_4.jpg', 650, 950, 15, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 80, 0),
(66, 'Nokia Power Earbuds Lite', 'nokia_power_earbuds_lite.jpg', 700, 1000, 15, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 89, 1),
(67, 'Nokia Smart TV 55', 'nokia_smart_tv_55.jpg', 680, 980, 15, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 109, 1),
(72, 'Apple iPhone 15 Plus', 'apple_iphone_15_plus.jpg', 1200, 1500, 16, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 99, 1),
(73, 'Apple iPhone 15 Pro', 'apple_iphone_15_pro.jpg', 1300, 1600, 16, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 149, 1),
(74, 'Apple iPad Pro 2024', 'apple_ipad_pro_2024.jpg', 1500, 1800, 16, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 119, 1),
(75, 'Apple MacBook Pro 2024', 'apple_macbook_pro_2024.jpg', 2000, 2300, 16, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 80, 0),
(76, 'Apple AirPods Pro 2', 'apple_airpods_pro_2.jpg', 1000, 1300, 16, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 89, 1),
(77, 'Apple Watch Series 10', 'apple_watch_series_10.jpg', 1100, 1400, 16, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 110, 0),
(78, 'Apple HomePod Max', 'apple_homepod_max.jpg', 1200, 1500, 16, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 129, 1),
(79, 'Apple MagSafe Battery Pack', 'apple_magsafe_battery_pack.jpg', 800, 1100, 16, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 69, 1),
(80, 'Apple Magic Keyboard', 'apple_magic_keyboard.jpg', 500, 800, 16, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 96, 4),
(81, 'Apple Leather Case for iPhone 15 Plus', 'apple_leather_case_for_iphone_15_plus.jpg', 100, 200, 16, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 137, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `pass` varchar(32) DEFAULT NULL,
  `avatar` varchar(250) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `login` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `block` int(11) DEFAULT NULL,
  `activation_code` varchar(250) NOT NULL,
  `authentication` int(11) NOT NULL,
  `activation_time` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `username`, `pass`, `avatar`, `role`, `login`, `status`, `block`, `activation_code`, `authentication`, `activation_time`) VALUES
(26, 'Ngô Xuân Bình ', 'nxbinh2004@gmail.com', 'admin', '123456', 'IMG_3482.JPG', 1, 1, 1, 0, '35c56cd7690d1eeccfa1f280d954ffe0', 1, '2024-04-24 13:32:04.000000'),
(28, 'Phạm Trần Hương Ly', 'lysmile135@gmail.com', 'lysmile135', '123456', 'IMG_4328.JPG', 0, 1, 0, 0, '77de1eef1c2fe2eb66164355fb1e3d29', 1, '2024-04-25 14:42:22.000000');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Chỉ mục cho bảng `order_history`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT cho bảng `order_history`
--
ALTER TABLE `order_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order_history` (`id`);

--
-- Các ràng buộc cho bảng `order_history`
--
ALTER TABLE `order_history`
  ADD CONSTRAINT `order_history_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
