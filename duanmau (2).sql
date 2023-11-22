-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 22, 2023 lúc 10:41 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `duanmau`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` bigint(20) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `parent_id`, `created_at`, `update_at`, `deleted_at`, `user_id`) VALUES
(25, 'áo khoác nam', 26, '2023-11-17 23:52:17', '2023-11-17 23:52:17', NULL, 84),
(26, 'thời trang nam', 0, '2023-11-21 16:12:51', '2023-11-21 16:12:51', NULL, 84),
(27, 'thời trang nữ', 0, '2023-11-21 16:13:08', '2023-11-21 16:13:08', NULL, 84),
(28, 'thời trang cho bé', 0, '2023-11-21 16:13:20', '2023-11-21 16:13:20', NULL, 84),
(29, 'áo sơ mi nam', 26, '2023-11-21 16:18:15', '2023-11-21 16:18:15', NULL, 84),
(30, 'quần tay nam', 26, '2023-11-21 16:18:28', '2023-11-21 16:18:28', NULL, 84),
(31, 'áo khoác nữ', 27, '2023-11-21 16:18:44', '2023-11-21 16:18:44', NULL, 84);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) NOT NULL,
  `text` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `paren_id` bigint(20) DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `id` bigint(11) NOT NULL,
  `id_user` bigint(20) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `name` varchar(40) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `alt` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `update_at` timestamp NULL DEFAULT current_timestamp(),
  `create_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `image`
--

INSERT INTO `image` (`id`, `alt`, `image_url`, `product_id`, `update_at`, `create_at`, `deleted_at`) VALUES
(26, 'description image Áo sơ mi nam dài tay Aristino ALS02903', 'store/images/0e173639ae4218c86b2c5ba528230aab.webp', 22, '2023-11-22 09:38:01', '2023-11-22 09:38:01', NULL),
(27, 'description image Áo sơ mi nam dài tay Aristino ALS02903', 'store/images/67895d07a9c9e54ac270856ef365447c.webp', 22, '2023-11-22 09:38:01', '2023-11-22 09:38:01', NULL),
(28, 'description image Áo sơ mi nam dài tay Aristino ALS02903', 'store/images/ede83ec93e84fdbc69fe2046459b0cc1.webp', 22, '2023-11-22 09:38:01', '2023-11-22 09:38:01', NULL),
(29, 'description image Áo sơ mi nam dài tay Aristino ALS12102 màu Xanh tím than', 'store/images/070fe03339c5e37c4844c99a68d14e16.webp', 24, '2023-11-22 09:39:28', '2023-11-22 09:39:28', NULL),
(30, 'description image Áo sơ mi nam dài tay Aristino ALS12102 màu Xanh tím than', 'store/images/dec08b8a5e5fcc3b6f393e7a91235149.webp', 24, '2023-11-22 09:39:28', '2023-11-22 09:39:28', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `text` varchar(255) NOT NULL,
  `watched_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(11) NOT NULL,
  `payment_method_id` bigint(20) NOT NULL,
  `status_id` bigint(20) NOT NULL,
  `total` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `customers_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_item`
--

CREATE TABLE `order_item` (
  `id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `price` bigint(20) NOT NULL,
  `quaytity` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `product_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment_method`
--

CREATE TABLE `payment_method` (
  `id` bigint(20) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `delete_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` bigint(20) NOT NULL,
  `count_likes` bigint(20) DEFAULT 0,
  `count_comments` bigint(20) DEFAULT 0,
  `category_id` bigint(20) NOT NULL,
  `count_views` bigint(20) DEFAULT 0,
  `count_buy` bigint(20) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `delete_at` int(11) DEFAULT NULL,
  `feature_image` varchar(255) DEFAULT NULL,
  `quantity` bigint(20) DEFAULT 0,
  `discount` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `user_id`, `description`, `price`, `count_likes`, `count_comments`, `category_id`, `count_views`, `count_buy`, `created_at`, `updated_at`, `delete_at`, `feature_image`, `quantity`, `discount`) VALUES
(22, 'Áo sơ mi nam dài tay Aristino ALS02903', 84, '<p>FORM D&Aacute;NG:&nbsp;Regular Fit<br>THIẾT KẾ:<br>- &Aacute;o sơ mi d&agrave;i tay phom d&aacute;ng Regular Fit su&ocirc;ng nhẹ, vừa vặn t&ocirc;n d&aacute;ng<br>- &Aacute;o thiết kế đơn giản c&ugrave;ng m&agrave;u trắng in chấm xanh mang đến phong c&', 715500, 0, 0, 29, 0, 0, '2023-11-22 09:38:01', '2023-11-22 16:38:01', NULL, 'store/images/b46db704c13cced6a74d8522ae38b374.webp', 12, 795000),
(24, 'Áo sơ mi nam dài tay Aristino ALS12102 màu Xanh tím than', 84, '', 805500, 0, 0, 29, 0, 0, '2023-11-22 09:39:28', '2023-11-22 16:39:28', NULL, 'store/images/ea3aad0be7150a57d12fff4057f02a9f.webp', 123, 795000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(11) NOT NULL,
  `id_product` bigint(20) NOT NULL,
  `id_order` bigint(20) NOT NULL,
  `email` varchar(10) NOT NULL,
  `text` varchar(255) NOT NULL,
  `scores` int(2) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

CREATE TABLE `role` (
  `id` bigint(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`id`, `name`, `description`) VALUES
(1, 'khách hàng', ''),
(2, 'khách vip', ''),
(3, 'nhân viên', NULL),
(4, 'quản lý', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `status`
--

CREATE TABLE `status` (
  `id` bigint(20) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `role_id` tinyint(1) NOT NULL,
  `email_vaildate` varchar(255) DEFAULT NULL,
  `google_id` varchar(250) DEFAULT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `logged_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `locked` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `photo_url`, `role_id`, `email_vaildate`, `google_id`, `facebook_id`, `logged_at`, `created_at`, `updated_at`, `locked`) VALUES
(84, 'Phúc Nuyễn Hoàng', 'admin01', '$2y$10$Xn1AnWnuh45g1vi07WVGcOoXAC3eZ.mBIpj3va2fkmHD5C0O9jjyy', 'store/avatar/5166769102803e3d2df578980e76017c.png', 1, NULL, NULL, NULL, NULL, '2023-11-17 11:54:53', '2023-11-17 11:54:53', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Chỉ mục cho bảng `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_id` (`customers_id`),
  ADD KEY `payment_method_id` (`payment_method_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Chỉ mục cho bảng `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_order` (`id_order`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `status`
--
ALTER TABLE `status`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_method` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);

--
-- Các ràng buộc cho bảng `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Các ràng buộc cho bảng `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_reviews_ibfk_2` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
