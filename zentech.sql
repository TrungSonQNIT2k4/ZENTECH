-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 13, 2024 lúc 05:58 PM
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
-- Cơ sở dữ liệu: `zentech`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `password`, `email`) VALUES
(1, 'Nguyễn Đào Quang Đăng', '123', 'ndqd@'),
(2, 'Nguyễn Thị Lệ Quyền', '12345', 'quyen@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `version_id` int(11) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `color_id`, `version_id`, `quantity`) VALUES
(4, 110, 1, 1, 1, 7),
(4, 110, 1, 1, 2, 7),
(4, 110, 1, 2, 1, 3),
(4, 110, 1, 2, 2, 3),
(4, 110, 1, 3, 1, 4),
(4, 110, 1, 3, 2, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `code_color`
--

CREATE TABLE `code_color` (
  `color_id` int(10) NOT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `code_color`
--

INSERT INTO `code_color` (`color_id`, `color`) VALUES
(1, 'Xanh lá'),
(2, 'Xanh dương'),
(3, 'Đen'),
(4, 'Tím'),
(5, 'Vàng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `color_image`
--

CREATE TABLE `color_image` (
  `image_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  `product_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `color_image`
--

INSERT INTO `color_image` (`image_id`, `color_id`, `img_url`, `product_id`) VALUES
(1, 1, 'redmi-a2-plus-green.png', 1),
(2, 2, 'redmi-a2-plus-blue.png', 1),
(3, 3, 'redmi-a2-plus-black.png', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `noidung` text NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `is_reply` tinyint(1) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`comment_id`, `noidung`, `created_at`, `is_reply`, `product_id`, `customer_id`) VALUES
(1, 'mặt hàng này còn không', '2024-12-06', 1, 1, 1),
(2, 'ở bình định có hàng k ạ', '2024-12-06', 1, 1, 2),
(18, 'tôi muốn mua điện thoại', '2024-12-07', 0, 1, 110),
(19, 'tôi muốn mua mua trả góp', '2024-12-07', 0, 1, 110),
(20, 'tôi muốn mua mua trả góp', '2024-12-07', 0, 1, 110),
(21, 'tôi muốn mua mua trả góp', '2024-12-07', 0, 1, 110),
(22, 'tôi muốn mua điện thoại', '2024-12-08', 0, 1, 110),
(23, 'tôi muốn mua điện thoại', '2024-12-08', 0, 1, 110),
(24, '2024-12-07\r\ntôi muốn mua mua trả góp', '2024-12-10', 0, 1, 110),
(25, '2024-12-07\r\ntôi muốn mua mua trả góp', '2024-12-10', 0, 1, 110),
(26, '2024-12-07\r\ntôi muốn mua mua trả góp', '2024-12-10', 0, 1, 110),
(27, '2024-12-07\r\ntôi muốn mua mua trả góp', '2024-12-10', 0, 1, 110),
(28, '2024-12-07\r\ntôi muốn mua mua trả góp', '2024-12-10', 0, 1, 110),
(29, '8ueruisijidsjjfjfjjf', '2024-12-10', 0, 1, 110);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detail_image`
--

CREATE TABLE `detail_image` (
  `product_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  `image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `detail_image`
--

INSERT INTO `detail_image` (`product_id`, `color_id`, `image_url`, `image_id`) VALUES
(1, 1, 'redmi-a2-plus-green.png', 1),
(1, 1, 'redmi-a2-plus-green-1.png', 3),
(1, 1, 'redmi-a2-plus-green-5.png', 4),
(1, 1, 'redmi-a2-plus-green-4.png', 5),
(1, 1, 'redmi-a2-plus-green-7.png', 6),
(1, 1, 'redmi-a2-plus-green-6.png', 7),
(1, 2, 'redmi-a2-plus-blue-3.png', 8),
(1, 2, 'redmi-a2-plus-blue-5.png', 9),
(1, 2, 'redmi-a2-plus-blue-2.png', 10),
(1, 2, 'redmi-a2-plus-blue-7.png', 11),
(1, 2, 'redmi-a2-plus-blue-4.png', 12),
(1, 3, 'redmi-a2-plus-black-7.png', 1),
(1, 3, 'redmi-a2-plus-black-4.png', 2),
(1, 3, 'redmi-a2-plus-black-3.png', 3),
(1, 3, 'redmi-a2-plus-black-6.png', 4),
(1, 3, 'redmi-a2-plus-black-5.png', 5),
(1, 3, 'redmi-a2-plus-black-2.png', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `motathuoctinh`
--

CREATE TABLE `motathuoctinh` (
  `id_thuoctinh` int(100) NOT NULL,
  `mota` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `motathuoctinh`
--

INSERT INTO `motathuoctinh` (`id_thuoctinh`, `mota`, `product_id`) VALUES
(1, 'Nhựa', 1),
(2, '164.9 x 76.75 x 9.09 mm', 1),
(3, '192g', 1),
(4, 'IPS LCD', 1),
(5, '720x1600', 1),
(6, '6.52 inch', 1),
(7, 'MediaTek Helio G36', 1),
(8, 'Octa-core (4x2.2GHz Cortex-A53 & 4x1.7GHz Cortex-A53)', 1),
(9, 'PowerVR GE8320', 1),
(10, 'Android 12 hoặc 13 (Go Edition)', 1),
(11, '3GB', 1),
(12, '64GB', 1),
(13, 'microSD, hỗ trợ tối đa 1TB', 1),
(14, 'Camera chính 8MP f/2.0', 1),
(15, 'Camera phụ trợ QVGA', 1),
(16, '1080p | 1920x1080 30fps', 1),
(17, 'Có', 1),
(18, '5MP f/2.2', 1),
(19, '1080p | 1920x1080 30fps', 1),
(20, '5000mAh', 1),
(21, '10W', 1),
(22, 'Quét vân tay trên mặt lưng\r\n\r\nGia tốc kế', 1),
(23, '2G, 3G, 4G', 1),
(24, '2 Nano-SIM', 1),
(25, 'Wi-Fi 2.4GHz', 1),
(26, 'GPS L1 | GLONASS G1 | BDS B1I | GALILEO E1', 1),
(27, 'v5.0', 1),
(28, 'microUSB 2.0', 1),
(29, '3.5mm', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(10) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` int(12) DEFAULT NULL,
  `price_sale` int(100) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image_main` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `price_sale`, `category_id`, `brand_id`, `stock`, `created_at`, `updated_at`, `image_main`) VALUES
(1, 'HONOR X5 Plus 4GB/64GB', NULL, 2090000, 2790000, NULL, NULL, NULL, '2024-11-11 16:39:51', '2024-11-11 16:39:51', 'x5-plus-1_638328150414991640.png'),
(2, 'TECHNO SPARK Go 2024 (4+4GB/64GB)', NULL, 1890000, 2190000, NULL, NULL, NULL, '2024-11-11 16:39:51', '2024-11-11 16:39:51', 'tecno-spark-go-2024-black-1.png'),
(3, 'Xiaomi Redmi 12 4GB/128GB', NULL, 2990000, 4290000, NULL, NULL, NULL, '2024-11-11 16:39:51', '2024-11-11 16:39:51', 'tecno-spark-go-2024-black-1.png'),
(4, 'Samsung Galaxy A05-4GB/1128GB', NULL, 2690000, 2790000, NULL, NULL, NULL, '2024-11-11 16:39:51', '2024-11-11 16:39:51', 'a05-den-1.png'),
(5, 'HTC Wildfire E3 lite (4GB/64GB)', NULL, 1790000, 2990000, NULL, NULL, NULL, '2024-11-11 16:39:51', '2024-11-11 16:39:51', 'htc-wildfire-e3-lite-blue.png'),
(6, 'iPhone 16 Pro Max (256GB) - Chính hãng VN/A', NULL, 27000000, 0, NULL, NULL, NULL, '2024-12-13 08:27:12', '2024-12-13 08:27:12', 'iphone-16-pro-max-tu-nhien-1.png'),
(7, 'Điện thoại iPhone 15 (512GB) - Chính hãng VN/A', NULL, 20000000, 18000000, NULL, NULL, NULL, '2024-12-13 08:27:12', '2024-12-13 08:27:12', 'iphone-15-xanh-la-1.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `replies`
--

CREATE TABLE `replies` (
  `reply_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `replies`
--

INSERT INTO `replies` (`reply_id`, `comment_id`, `admin_id`, `content`, `created_at`) VALUES
(1, 1, 1, 'bên mình còn hàng bạn nhé ', '2024-12-06'),
(2, 2, 1, 'dạ có ạ', '2024-12-06'),
(18, 18, 1, 'dạ cảm ơn bạn đã bình luận , mình không biết', '2024-12-07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongso`
--

CREATE TABLE `thongso` (
  `id_thongso` int(11) NOT NULL,
  `thongso` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thongso`
--

INSERT INTO `thongso` (`id_thongso`, `thongso`) VALUES
(1, 'Thông tin chung'),
(2, 'Màn hình'),
(3, 'Hệ điều hành & CPU'),
(4, 'Bộ nhớ & Lưu trữ'),
(5, 'Camera sau'),
(6, 'Camera trước'),
(7, 'Pin & Sạc'),
(8, 'Tiện ích khác'),
(9, 'Kết nối');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thuoctinh`
--

CREATE TABLE `thuoctinh` (
  `id_thuoctinh` int(11) NOT NULL,
  `thuoctinh` varchar(100) NOT NULL,
  `id_thongso` int(11) NOT NULL,
  `is_highlight` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thuoctinh`
--

INSERT INTO `thuoctinh` (`id_thuoctinh`, `thuoctinh`, `id_thongso`, `is_highlight`) VALUES
(1, 'Chất liệu', 1, 1),
(2, 'Kích thước', 1, 1),
(3, 'Trọng lượng', 1, 1),
(4, 'Công nghệ màn hình', 2, 0),
(5, 'Độ phân giải', 2, 0),
(6, 'Kích thước màn hình\r\n\r\n', 2, 1),
(7, 'Vi xử lý', 3, 0),
(8, 'Tốc độ CPU', 3, 0),
(9, 'Vi xử lý đồ họa (GPU)', 3, 0),
(10, 'Hệ điều hành', 3, 1),
(11, 'RAM', 4, 0),
(12, 'Bộ nhớ trong', 4, 1),
(13, 'Thẻ nhớ ngoài\r\n\r\n', 4, 0),
(14, 'Độ phân giải camera trước', 5, 1),
(15, 'Quay video', 5, 0),
(16, 'Đèn Flash', 5, 0),
(17, 'Độ phân giải camera sau', 6, 1),
(18, 'Quay video', 6, 0),
(19, 'Dung lượng pin', 7, 1),
(20, 'Hỗ trợ sạc tối đa', 7, 0),
(21, 'Cảm biến', 8, 0),
(22, 'Mạng di động', 9, 0),
(23, 'Số khe SIM', 9, 1),
(24, 'Wi-Fi', 9, 0),
(25, 'Định vị', 9, 0),
(26, 'Bluetooth', 9, 0),
(27, 'Cổng kết nối/sạc', 9, 0),
(28, 'Jack tai nghe\r\n\r\n', 9, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT 'uploads/default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `lastname`, `firstname`, `address`, `phone`, `email`, `password`, `reset_token_hash`, `reset_token_expires_at`, `profile_image`) VALUES
(1, 'Nhiên', 'Du', '170 An Dương Vương, Quy Nhơn, Bình Định, Việt Nam', '55664479', 'tuekhanhtin@gmail.com', '$2y$10$o9C.cGyUF2AcrLEOjDMBC.zkUKDyak5YXuO4WS1maIkxxdNzo5sGm', NULL, NULL, 'uploads/default.jpg'),
(2, 'Quyền', 'Lệ', 'bình định', '0388993480', 'quyen@', '123', NULL, NULL, 'uploads/default.jpg'),
(3, 'Khánh', 'Trần', '170 An Dương Vương, Quy Nhơn, Bình Định, Việt Nam', '0917593969', 'emrismao@gmail.com', '$2y$10$K1oQRCTeE8D6Fkc3mJfBjethdKRh4BYXb6Xo58GyzrrVUrKkZpzbm', '442af5f74baa75d28035449b6a6e5169227cf0082d76bc847a0bb818a6d7cd34', '2024-11-28 19:29:59', 'uploads/default.jpg'),
(4, 'Phong (Yi Phong)', 'Nhất', '82London', '7894516', 'emrisgrindelwald@gmail.com', '$2y$10$rDA4tpS2ALNEsVDlrMg.A.LXEqFQqH.D9zlyvz1RMr.H34o1PfhOy', 'fa72d197306a352a30247ba8be725e07936b893e65a735cce3ee46073926d86f', '2024-12-03 16:04:18', '674ab87acc714_neka 老头！！！ by 百无一用 (1).png'),
(5, 'Gokce', 'Grindelwald', 'Hành tinh mới', '55791354', 'gellerttrongsinh@gmail.com', '$2y$10$H4DoeJlWdCWfk3S3srdbG.kdqbDGEDm/2hW2zjvKbTM8Y8cYAT1nu', NULL, NULL, 'uploads/default.jpg'),
(110, 'Aurelius (Credence)', 'Dumbledore', 'Hogsmead, London', '188318841314', 'gellertgrindelwald8398@gmail.com', '$2y$10$SAyLEQ48RRcIBWyV03cVJux4rGNJ9H8vK/LlNTX4XKAmmLMxknVAi', NULL, NULL, 'uploads/default.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `version`
--

CREATE TABLE `version` (
  `version_id` int(11) NOT NULL,
  `version` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `version`
--

INSERT INTO `version` (`version_id`, `version`, `product_id`) VALUES
(1, '34GB', 1),
(2, '128GB', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `voucher`
--

CREATE TABLE `voucher` (
  `id_voucher` int(11) NOT NULL,
  `mota` varchar(255) NOT NULL,
  `giagiam` int(100) NOT NULL,
  `ngaytao` date NOT NULL DEFAULT current_timestamp(),
  `product_id` int(11) NOT NULL,
  `ngayhethan` date NOT NULL,
  `stt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `voucher`
--

INSERT INTO `voucher` (`id_voucher`, `mota`, `giagiam`, `ngaytao`, `product_id`, `ngayhethan`, `stt`) VALUES
(0, 'Thu cũ đổi mới lên đời điện thoại Android & Máy tính bảng, tiết kiệm tới 20 triệu đồng ', 100000, '2024-12-09', 1, '0000-00-00', 1),
(1, 'Tặng miễn phí phôi sim khi mua điện thoại, máy tính bảng, laptop hoặc phụ kiện tại Hoàng Hà Mobile', 300000, '2024-12-09', 1, '0000-00-00', 2),
(3, 'Giảm thêm 100.000đ cho tất cả các sản phẩm màn hình khi mua kèm Laptop, MacBook, Máy tính bảng và Điện thoại.', 100000, '2024-12-09', 1, '0000-00-00', 3);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD UNIQUE KEY `cart_id` (`cart_id`,`user_id`,`product_id`,`color_id`,`version_id`);

--
-- Chỉ mục cho bảng `code_color`
--
ALTER TABLE `code_color`
  ADD PRIMARY KEY (`color_id`);

--
-- Chỉ mục cho bảng `color_image`
--
ALTER TABLE `color_image`
  ADD PRIMARY KEY (`image_id`),
  ADD UNIQUE KEY `id` (`image_id`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Chỉ mục cho bảng `detail_image`
--
ALTER TABLE `detail_image`
  ADD UNIQUE KEY `color_id` (`color_id`,`image_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`reply_id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Chỉ mục cho bảng `thongso`
--
ALTER TABLE `thongso`
  ADD PRIMARY KEY (`id_thongso`);

--
-- Chỉ mục cho bảng `thuoctinh`
--
ALTER TABLE `thuoctinh`
  ADD PRIMARY KEY (`id_thuoctinh`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`);

--
-- Chỉ mục cho bảng `version`
--
ALTER TABLE `version`
  ADD PRIMARY KEY (`version_id`);

--
-- Chỉ mục cho bảng `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id_voucher`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `replies`
--
ALTER TABLE `replies`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
