-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 09:07 AM
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
-- Database: `phonestore`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `avatar` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
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
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `phonenumber` varchar(11) DEFAULT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `phonenumber`, `fullname`, `address`) VALUES
(1, '0971927226', 'admin', '123 Dương Bá Trạc'),
(2, '012345678', 'Ngu', '123 Nguyễn Hữu Thọ'),
(3, '12345678', 'khùng', '123 ABC'),
(4, '', '', ''),
(5, '', '', ''),
(6, '', '', ''),
(7, '', '', ''),
(8, '', '', ''),
(9, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
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
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `price`, `num`, `total_money`) VALUES
(1, 2, 5, 1100, 3, 3300),
(2, 2, 3, 1250, 1, 1250),
(3, 3, 5, 1100, 3, 3300),
(4, 3, 3, 1250, 1, 1250),
(5, 4, 2, 1200, 1, 1200),
(6, 4, 3, 1250, 1, 1250),
(7, 4, 4, 1300, 1, 1300),
(8, 5, 2, 1200, 1, 1200),
(9, 6, 3, 1250, 1, 1250),
(10, 6, 4, 1300, 1, 1300),
(11, 6, 5, 1100, 1, 1100),
(12, 7, 2, 1200, 1, 1200),
(13, 8, 2, 1200, 1, 1200),
(14, 8, 3, 1250, 1, 1250),
(15, 9, 5, 1100, 1, 1100),
(16, 10, 19, 1400, 1, 1400),
(17, 11, 18, 1320, 2, 2640);

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

CREATE TABLE `order_history` (
  `id` int(11) NOT NULL,
  `totalmoney` double DEFAULT NULL,
  `money_in` double DEFAULT NULL,
  `money_out` double DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_history`
--

INSERT INTO `order_history` (`id`, `totalmoney`, `money_in`, `money_out`, `order_date`, `quantity`, `customer_id`, `cost`) VALUES
(1, 4550, 5000, 0, '2024-04-29 15:36:03', 4, 1, 0),
(2, 4550, 5000, 0, '2024-04-29 15:36:38', 4, 1, 0),
(3, 4550, 5000, 0, '2024-04-29 15:43:47', 4, 1, 0),
(4, 3750, 4000, 250, '2024-04-29 15:44:13', 3, 1, 0),
(5, 1200, 2000, 800, '2024-04-29 16:20:47', 1, 1, 0),
(6, 3650, 4000, 350, '2024-05-05 05:30:14', 3, 1, 0),
(7, 1200, 3000, 1800, '2024-05-06 07:29:39', 1, 1, 0),
(8, 2450, 12346, 9896, '2024-05-06 07:30:50', 2, 1, 0),
(9, 1100, 2000, 900, '2024-05-06 08:28:16', 1, 1, 800),
(10, 1400, 3000, 1600, '2024-05-06 08:28:30', 1, 1, 1100),
(11, 2640, 5000, 2360, '2024-05-06 08:28:59', 2, 1, 2040);

-- --------------------------------------------------------

--
-- Table structure for table `product`
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
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `avatar`, `price_in`, `price_out`, `category_id`, `created_at`, `updated_at`, `quantity`, `sold`) VALUES
(2, 'Huawei P50 Pro', 'huawei_p50_pro.jpg', 900, 1200, 6, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 97, 1),
(3, 'Huawei Mate 50', 'huawei_mate_50.jpg', 950, 1250, 6, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 148, 1),
(4, 'Huawei Nova 9', 'huawei_nova_9.jpg', 1000, 1300, 6, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 119, 0),
(5, 'Huawei Enjoy 20 Plus', 'huawei_enjoy_20_plus.jpg', 800, 1100, 6, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 78, 1),
(6, 'Huawei Honor Magic 4', 'huawei_honor_magic_4.jpg', 950, 1250, 6, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 90, 0),
(10, 'Huawei Watch GT 4', 'huawei_watch_gt_4.jpg', 950, 1250, 6, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 100, 0),
(12, 'Samsung Galaxy S24 Ultra', 'samsung_galaxy_s24_ultra.jpg', 1100, 1400, 10, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 100, 0),
(13, 'Samsung Galaxy S24', 'samsung_galaxy_s24.jpg', 1150, 1450, 10, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 150, 0),
(14, 'Samsung Galaxy A90', 'samsung_galaxy_a90.jpg', 1200, 1500, 10, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 120, 0),
(15, 'Samsung Galaxy Z Fold 5', 'samsung_galaxy_z_fold_5.jpg', 1000, 1300, 10, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 80, 0),
(16, 'Samsung Galaxy Tab S8', 'samsung_galaxy_tab_s8.jpg', 1050, 1350, 10, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 90, 0),
(17, 'Samsung Galaxy Watch 5', 'samsung_galaxy_watch_5.jpg', 1080, 1380, 10, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 110, 0),
(18, 'Samsung Galaxy Buds 3', 'samsung_galaxy_buds_3.jpg', 1020, 1320, 10, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 128, 2),
(19, 'Samsung Galaxy Book Pro', 'samsung_galaxy_book_pro.jpg', 1100, 1400, 10, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 69, 1),
(20, 'Samsung Galaxy Fit 2', 'samsung_galaxy_fit_2.jpg', 1150, 1450, 10, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 100, 0),
(21, 'Samsung Galaxy SmartTag+', 'samsung_galaxy_smarttag_plus.jpg', 1200, 1500, 10, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 140, 0),
(22, 'Xiaomi Mi 12 Pro', 'xiaomi_mi_12_pro.jpg', 850, 1150, 11, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 100, 0),
(23, 'Xiaomi Redmi K50', 'xiaomi_redmi_k50.jpg', 900, 1200, 11, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 150, 0),
(24, 'Xiaomi Black Shark 5', 'xiaomi_black_shark_5.jpg', 950, 1250, 11, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 120, 0),
(25, 'Xiaomi Poco X5', 'xiaomi_poco_x5.jpg', 800, 1100, 11, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 80, 0),
(26, 'Xiaomi Mi Pad 6', 'xiaomi_mi_pad_6.jpg', 850, 1150, 11, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 90, 0),
(27, 'Xiaomi Redmi AirDots 4', 'xiaomi_redmi_airdots_4.jpg', 830, 1130, 11, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 110, 0),
(28, 'Xiaomi Mi Band 7', 'xiaomi_mi_band_7.jpg', 870, 1170, 11, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 130, 0),
(29, 'Xiaomi Mi Watch 3', 'xiaomi_mi_watch_3.jpg', 800, 1100, 11, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 70, 0),
(30, 'Xiaomi Redmi Note 11', 'xiaomi_redmi_note_11.jpg', 850, 1150, 11, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 100, 0),
(31, 'Xiaomi Mi Robot Vacuum', 'xiaomi_mi_robot_vacuum.jpg', 900, 1200, 11, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 140, 0),
(32, 'Vivo X90 Pro', 'vivo_x90_pro.jpg', 950, 1250, 12, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 100, 0),
(33, 'Vivo Y60', 'vivo_y60.jpg', 1000, 1300, 12, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 150, 0),
(34, 'Vivo V25', 'vivo_v25.jpg', 1050, 1350, 12, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 120, 0),
(35, 'Vivo S9e', 'vivo_s9e.jpg', 900, 1200, 12, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 80, 0),
(36, 'Vivo T1 5G', 'vivo_t1_5g.jpg', 950, 1250, 12, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 90, 0),
(37, 'Vivo Y20s', 'vivo_y20s.jpg', 930, 1230, 12, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 110, 0),
(38, 'Vivo X50 Pro+', 'vivo_x50_pro_plus.jpg', 970, 1270, 12, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 130, 0),
(39, 'Vivo Watch 2', 'vivo_watch_2.jpg', 900, 1200, 12, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 70, 0),
(40, 'Vivo TWS Neo 4', 'vivo_tws_neo_4.jpg', 950, 1250, 12, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 100, 0),
(41, 'Vivo Wireless Charger', 'vivo_wireless_charger.jpg', 1000, 1300, 12, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 140, 0),
(42, 'Realme GT 3 Pro', 'realme_gt_3_pro.jpg', 800, 1100, 13, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 100, 0),
(43, 'Realme Narzo 50', 'realme_narzo_50.jpg', 850, 1150, 13, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 150, 0),
(44, 'Realme Q5', 'realme_q5.jpg', 900, 1200, 13, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 120, 0),
(45, 'Realme X9 Max', 'realme_x9_max.jpg', 750, 1050, 13, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 80, 0),
(46, 'Realme Buds Air 3', 'realme_buds_air_3.jpg', 800, 1100, 13, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 90, 0),
(47, 'Realme Watch 2 Pro', 'realme_watch_2_pro.jpg', 780, 1080, 13, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 110, 0),
(48, 'Realme Power Bank 2', 'realme_power_bank_2.jpg', 820, 1120, 13, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 130, 0),
(49, 'Realme Smart Scale', 'realme_smart_scale.jpg', 750, 1050, 13, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 70, 0),
(50, 'Realme TWS Neo 3', 'realme_tws_neo_3.jpg', 800, 1100, 13, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 100, 0),
(51, 'Realme Smart Cam 360', 'realme_smart_cam_360.jpg', 850, 1150, 13, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 140, 0),
(52, 'Oppo Find X5 Pro', 'oppo_find_x5_pro.jpg', 850, 1150, 14, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 100, 0),
(53, 'Oppo Reno 7', 'oppo_reno_7.jpg', 900, 1200, 14, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 150, 0),
(54, 'Oppo A96', 'oppo_a96.jpg', 950, 1250, 14, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 120, 0),
(55, 'Oppo K10', 'oppo_k10.jpg', 800, 1100, 14, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 80, 0),
(56, 'Oppo Enco Free 2', 'oppo_enco_free_2.jpg', 850, 1150, 14, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 90, 0),
(57, 'Oppo Band 2', 'oppo_band_2.jpg', 830, 1130, 14, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 110, 0),
(58, 'Oppo Watch Free', 'oppo_watch_free.jpg', 870, 1170, 14, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 130, 0),
(59, 'Oppo 65W SuperVOOC Charger', 'oppo_65w_supervooc_charger.jpg', 800, 1100, 14, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 70, 0),
(60, 'Oppo Smart Tag', 'oppo_smart_tag.jpg', 850, 1150, 14, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 100, 0),
(61, 'Oppo AirVOOC Wireless Charger', 'oppo_airvooc_wireless_charger.jpg', 900, 1200, 14, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 140, 0),
(62, 'Nokia G20', 'nokia_g20.jpg', 700, 1000, 15, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 100, 0),
(63, 'Nokia X100', 'nokia_x100.jpg', 750, 1050, 15, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 150, 0),
(64, 'Nokia C30', 'nokia_c30.jpg', 800, 1100, 15, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 120, 0),
(65, 'Nokia 5.4', 'nokia_5_4.jpg', 650, 950, 15, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 80, 0),
(66, 'Nokia Power Earbuds Lite', 'nokia_power_earbuds_lite.jpg', 700, 1000, 15, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 90, 0),
(67, 'Nokia Smart TV 55', 'nokia_smart_tv_55.jpg', 680, 980, 15, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 110, 0),
(72, 'Apple iPhone 15 Plus', 'apple_iphone_15_plus.jpg', 1200, 1500, 16, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 100, 0),
(73, 'Apple iPhone 15 Pro', 'apple_iphone_15_pro.jpg', 1300, 1600, 16, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 150, 0),
(74, 'Apple iPad Pro 2024', 'apple_ipad_pro_2024.jpg', 1500, 1800, 16, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 120, 0),
(75, 'Apple MacBook Pro 2024', 'apple_macbook_pro_2024.jpg', 2000, 2300, 16, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 80, 0),
(76, 'Apple AirPods Pro 2', 'apple_airpods_pro_2.jpg', 1000, 1300, 16, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 90, 0),
(77, 'Apple Watch Series 10', 'apple_watch_series_10.jpg', 1100, 1400, 16, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 110, 0),
(78, 'Apple HomePod Max', 'apple_homepod_max.jpg', 1200, 1500, 16, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 130, 0),
(79, 'Apple MagSafe Battery Pack', 'apple_magsafe_battery_pack.jpg', 800, 1100, 16, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 70, 0),
(80, 'Apple Magic Keyboard', 'apple_magic_keyboard.jpg', 500, 800, 16, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 100, 0),
(81, 'Apple Leather Case for iPhone 15 Plus', 'apple_leather_case_for_iphone_15_plus.jpg', 100, 200, 16, '2024-04-25 13:12:25', '2024-04-25 13:12:25', 140, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
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
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `username`, `pass`, `avatar`, `role`, `login`, `status`, `block`, `activation_code`, `authentication`, `activation_time`) VALUES
(26, 'Ngô Xuân Bình ', 'nxbinh2004@gmail.com', 'admin', '123456', 'admin.jpg', 1, 1, 1, 0, '35c56cd7690d1eeccfa1f280d954ffe0', 1, '2024-04-24 13:32:04.000000'),
(28, 'Phạm Trần Hương Ly', 'lysmile135@gmail.com', 'lysmile135', '123456', '1714030942IMG_4328.JPG', 0, 1, 0, 0, '77de1eef1c2fe2eb66164355fb1e3d29', 1, '2024-04-25 14:42:22.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `order_history`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order_history`
--
ALTER TABLE `order_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order_history` (`id`);

--
-- Constraints for table `order_history`
--
ALTER TABLE `order_history`
  ADD CONSTRAINT `order_history_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
