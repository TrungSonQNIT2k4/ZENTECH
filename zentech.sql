-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 14, 2024 lúc 11:36 AM
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
-- Cấu trúc bảng cho bảng `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address_type` enum('Home','Office') DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `ward` varchar(50) DEFAULT NULL,
  `specific_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `fullname` text NOT NULL,
  `status` text NOT NULL,
  `Password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `username`, `fullname`, `status`, `Password`) VALUES
(1, 'son0806', 'Sơn Võ', 'student', 'son0806');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `banner`
--

INSERT INTO `banner` (`id`, `image_path`, `link`) VALUES
(1, '/ZENTECH/Data/Image/bannerNoel.png', '#'),
(2, '/ZENTECH/Data/Image/bannerZentech.png', '#'),
(3, '/ZENTECH/Data/Image/bannerS24ULT.jpg', '#');

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
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `image_path`, `price`, `description`, `created_at`, `updated_at`) VALUES
(101, 'iPhone 16 Pro Max VN/A', '/ZENTECH/Data/Image/ip16promax.jpg', 34990000.00, NULL, '2024-12-03 17:19:31', '2024-12-03 17:19:39'),
(102, 'iPhone 16 Pro VN/A', '/ZENTECH/Data/Image/ip16pro.jpg', 28990000.00, NULL, '2024-12-03 17:19:31', '2024-12-03 17:19:49'),
(103, 'iPhone 16 Plus VN/A', '/ZENTECH/Data/Image/ip16plus.jpg', 25990000.00, NULL, '2024-12-03 17:19:31', '2024-12-03 17:20:09'),
(104, 'iPhone 16 VN/A', '/ZENTECH/Data/Image/ip16.jpg', 22290000.00, NULL, '2024-12-03 17:19:31', '2024-12-03 17:20:17'),
(201, 'Samsung Galaxy A55', '/ZENTECH/Data/Image/A55.jpg', 8490000.00, 'Smartphone với cấu hình mạnh mẽ và thiết kế đẹp.', '2024-12-03 16:09:59', '2024-12-03 16:11:19'),
(202, 'Samsung Galaxy Fold 6', '/ZENTECH/Data/Image/S24.jpg', 41990000.00, NULL, '2024-12-03 16:20:27', '2024-12-03 16:20:27'),
(203, 'Samsung Galaxy Z Flip 6', '/ZENTECH/Data/Image/zflip.jpg', 26990000.00, NULL, '2024-12-03 16:20:27', '2024-12-03 16:20:27'),
(204, 'Samsung Galaxy S24 Ultra', '/ZENTECH/Data/Image/fold.jpg', 29990000.00, NULL, '2024-12-03 16:20:27', '2024-12-03 16:24:38'),
(205, 'Samsung S23 Ultra', '/ZENTECH/Data/Image/s23ultra.jpg', 25990000.00, NULL, '2024-12-03 17:14:42', '2024-12-03 17:15:13'),
(301, 'xiaomi 14', '/ZENTECH/Data/Image/xiaomi14.jpg', 18990000.00, NULL, '2024-12-05 09:52:03', '2024-12-05 09:56:16'),
(302, 'xiaomi 14 ultra', '/ZENTECH/Data/Image/xiaomi14ult.jpg', 27990000.00, NULL, '2024-12-05 09:52:47', '2024-12-05 09:56:24'),
(303, 'xiaomi 14T', '/ZENTECH/Data/Image/xiaomi14T.jpg', 13990000.00, NULL, '2024-12-05 09:53:49', '2024-12-05 09:56:28'),
(304, 'xiaomi Redmi note 13 pro 5G', '/ZENTECH/Data/Image/xiaomirmn13pro.jpg', 5150000.00, NULL, '2024-12-05 09:56:02', '2024-12-05 09:56:31'),
(401, 'oppo find n3', '/ZENTECH/Data/Image/oppofindn3.jpg', 41990000.00, NULL, '2024-12-05 10:20:16', '2024-12-05 10:29:41'),
(402, 'oppo find n3 flip', '/ZENTECH/Data/Image/oppofindn3flip.jpg', 17490000.00, NULL, '2024-12-05 10:21:16', '2024-12-05 10:29:48'),
(403, 'oppo find x8 pro', '/ZENTECH/Data/Image/oppofindx8pro.jpg', 29990000.00, NULL, '2024-12-05 10:28:05', '2024-12-05 10:29:52'),
(404, 'oppo find x7 ultra', '/ZENTECH/Data/Image/oppofindx7ult.jpg', 25890000.00, NULL, '2024-12-05 10:29:23', '2024-12-05 10:29:56'),
(501, 'Galaxy Buds 3 pro', '/ZENTECH/Data/Image/buds3pro.jpg', 5090000.00, NULL, '2024-12-05 15:06:04', '2024-12-05 15:06:04'),
(502, 'Magsafe', '/ZENTECH/Data/Image/magsafe.jpg', 1599000.00, NULL, '2024-12-05 15:06:49', '2024-12-05 15:06:49'),
(503, 'Airpod 3', '/ZENTECH/Data/Image/airpods3.png', 3890000.00, NULL, '2024-12-05 15:07:34', '2024-12-05 15:35:25'),
(504, 'Airpod pro 2', '/ZENTECH/Data/Image/airpodpro2.jpg', 5790000.00, NULL, '2024-12-05 15:10:19', '2024-12-05 15:10:19');

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
(1, 'Sơn', 'Võ', '231/01', '0905857860', 'trungsonbd2004@gmail.com', '$2y$10$JXm5kNBQMLwvJcsnnZxoWeU7oV1i9AVDXYxyWbsoC35XL32lbBXsy', NULL, NULL, '675c6a23e9f8e_anh_doi_ta_mau.jpg'),
(3, 'Trân', 'Nguyễn', '27 NVH', '0964860022', 'baotranxsb@gmail.com', '$2y$10$wWpUgLvVi0x9OIcpO2XAoOCO2n5D6VU5vTtu3rMOpMTq1vEPL01oC', NULL, NULL, '675c5a487bb17_babyMay.jpg'),
(4, 'Tường', 'Đỗ', 'Tây Sơn', '0905234234', 'tuong@gmail.com', '$2y$10$TX4h4jKxDyDNXEVtS3pUDuNmU7fGJPEl4GprgnNNos0wXiPNVF5he', NULL, NULL, '675c5acc9b84e_fa19a81c-c6d7-409a-806d-ee0e46100b8b.jpg');

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
-- Cấu trúc bảng cho bảng `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `video_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `videos`
--

INSERT INTO `videos` (`id`, `video_path`) VALUES
(1, '/ZENTECH/Data/Image/adv16prm.mp4'),
(2, '/ZENTECH/Data/Image/advs24ult.mp4'),
(3, '/ZENTECH/Data/Image/advxiaomi14.mp4'),
(4, '/ZENTECH/Data/Image/advoppon3flip.mp4'),
(5, '/ZENTECH/Data/Image/advoppox8.mp4');

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
-- Chỉ mục cho bảng `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`),
  ADD KEY `email` (`email`);

--
-- Chỉ mục cho bảng `version`
--
ALTER TABLE `version`
  ADD PRIMARY KEY (`version_id`);

--
-- Chỉ mục cho bảng `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id_voucher`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=505;

--
-- AUTO_INCREMENT cho bảng `replies`
--
ALTER TABLE `replies`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `fk_user_address` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
