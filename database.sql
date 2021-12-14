-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:8889
-- Thời gian đã tạo: Th12 14, 2021 lúc 04:00 AM
-- Phiên bản máy phục vụ: 5.7.34
-- Phiên bản PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `sitepay`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `api_connect`
--

CREATE TABLE `api_connect` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `public_key` varchar(255) NOT NULL,
  `security_key` varchar(255) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `api_connect`
--

INSERT INTO `api_connect` (`id`, `email`, `public_key`, `security_key`, `created`) VALUES
(1, 'lctiendat@gmail.com', 'd3402ac888192f5e9cbc0d42bb6138e22c4ce26c', '62a5d82032e6c28bf18dd917824d13f09318d919', '2021-12-10 20:46:36'),
(2, 'contact.letiendat@gmail.com', '4a3da142ee8668bf7bdaf132c65d3d3c7a1ee6a5', '62f6bcaabbb2294407c1289b99f3d297afdba473', '2021-12-12 20:35:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `attendance`
--

INSERT INTO `attendance` (`id`, `email`, `ip`, `created`) VALUES
(9, 'lctiendat@gmail.com', '125.235.4.59', '2021-12-13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banks`
--

CREATE TABLE `banks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `delete_flag` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `banks`
--

INSERT INTO `banks` (`id`, `name`, `logo`, `delete_flag`, `created`, `modified`) VALUES
(1, 'Vietcombank', 'https://portal.vietcombank.com.vn/Resources/no-image-news.jpg?RenditionID=3', 0, '2021-12-07 10:25:32', '2021-12-07 10:35:44'),
(2, 'BIDV', 'https://typhukhongdo.vn/wp-content/uploads/2021/06/ma-ngan-hang-bidv-la-gi.jpg', 0, '2021-12-07 17:02:02', '2021-12-07 17:02:16'),
(3, 'VietinBank', 'https://yt3.ggpht.com/ytc/AKedOLQTXbv82ByhokCMzRliL2dV41J4sDyZCUT-BBU7Ew=s900-c-k-c0x00ffffff-no-rj', 0, '2021-12-08 10:56:12', '2021-12-08 10:56:12'),
(4, 'Sacombank', 'https://free.vector6.com/wp-content/uploads/2020/04/019-Logo-NganHang-Sacombank-1.jpg', 0, '2021-12-08 10:57:40', '2021-12-08 10:57:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bank_of_users`
--

CREATE TABLE `bank_of_users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `bank` int(11) NOT NULL,
  `holder` varchar(255) NOT NULL,
  `card_number` varchar(255) NOT NULL,
  `date_card` varchar(255) NOT NULL,
  `delete_flag` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `bank_of_users`
--

INSERT INTO `bank_of_users` (`id`, `email`, `bank`, `holder`, `card_number`, `date_card`, `delete_flag`, `created`) VALUES
(6, 'lctiendat@gmail.com', 3, 'LE CONG TIEN DAT', '1234567656678766', '2021-10', 0, '2021-12-13 09:43:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bank_transaction_histories`
--

CREATE TABLE `bank_transaction_histories` (
  `id` int(11) NOT NULL,
  `tranding_code` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `transaction_type` varchar(255) NOT NULL,
  `transaction_amount` varchar(255) NOT NULL,
  `recharge_code` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `reason` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `bank_transaction_histories`
--

INSERT INTO `bank_transaction_histories` (`id`, `tranding_code`, `email`, `bank`, `transaction_type`, `transaction_amount`, `recharge_code`, `status`, `reason`, `ip`, `created`, `modified`) VALUES
(2, '1030397899', 'lctiendat@gmail.com', '', 'recharge', '50000', 'Nap Tien Vao Tai Khoan lctiendat@gmail.com - VioPay', 'pending', 'Rút tiền thành công', '125.235.4.59', '2021-12-04 21:09:59', '2021-12-04 21:10:24'),
(3, '8009324929', 'lctiendat@gmail.com', '', 'recharge', '100000', 'Nap Tien Vao Tai Khoan lctiendat@gmail.com - VioPay', 'pending', 'Rút tiền thành công', '125.235.4.59', '2021-12-06 12:23:32', '2021-12-05 12:23:49'),
(4, '5392738571', 'lctiendat@gmail.com', '8765678276351426', 'withdraw', '50000', NULL, 'pending', 'Rút tiền thành công', '125.235.4.59', '2021-12-06 14:48:38', '2021-12-12 16:00:14'),
(5, '6133036377', 'lctiendat@gmail.com', '8765678276351426', 'withdraw', '100000', NULL, 'pending', 'Rút tiền thành công', '125.235.4.59', '2021-12-07 14:49:13', '2021-12-12 16:08:23'),
(6, '4521683713', 'lctiendat@gmail.com', '', 'recharge', '50000', 'Nap Tien Vao Tai Khoan lctiendat@gmail.com - VioPay', 'cancel', 'test', '125.235.4.59', '2021-12-07 14:51:09', '2021-12-12 16:28:03'),
(7, '8557591846', 'lctiendat@gmail.com', '', 'recharge', '100000', 'Nap Tien Vao Tai Khoan lctiendat@gmail.com - VioPay', 'accept', 'Rút tiền thành công', '125.235.4.59', '2021-12-07 14:51:37', '2021-12-12 16:27:50'),
(8, '1749987614', 'lctiendat@gmail.com', '8765678276351426', 'withdraw', '200000', NULL, 'pending', 'test', '125.235.4.59', '2021-12-07 14:53:45', '2021-12-12 16:09:04'),
(9, '0876925528', 'lctiendat@gmail.com', '', 'recharge', '50000', 'Nap Tien Vao Tai Khoan lctiendat@gmail.com - VioPay', 'accept', 'Rút tiền thành công', '125.235.4.59', '2021-12-07 14:55:28', '2021-12-12 16:24:23'),
(10, '3033451886', 'lctiendat@gmail.com', '1762567876351428', 'withdraw', '50000', NULL, 'pending', 'tét', '125.235.4.59', '2021-12-09 17:12:48', '2021-12-12 16:08:14'),
(11, '8106160669', 'lctiendat@gmail.com', '', 'recharge', '50000', 'Nap Tien Vao Tai Khoan lctiendat@gmail.com - VioPay', 'accept', 'Rút tiền thành công', '125.235.4.59', '2021-12-12 21:39:35', '2021-12-12 21:40:00'),
(12, '9403943314', 'lctiendat@gmail.com', '1762567876351428', 'withdraw', '50000', NULL, 'pending', '', '125.235.4.59', '2021-12-12 22:00:31', NULL),
(13, '6711380918', 'lctiendat@gmail.com', '1762567876351428', 'withdraw', '50000', NULL, 'pending', '', '125.235.4.59', '2021-12-12 22:02:42', NULL),
(14, '6215244854', 'lctiendat@gmail.com', '1762567876351428', 'withdraw', '50000', NULL, 'pending', '', '125.235.4.59', '2021-12-12 22:04:57', NULL),
(15, '3277176399', 'lctiendat@gmail.com', '1762567876351428', 'withdraw', '50000', NULL, 'pending', '', '125.235.4.59', '2021-12-12 22:06:26', NULL),
(16, '9931149899', 'lctiendat@gmail.com', '', 'recharge', '50000', 'Nap Tien Vao Tai Khoan lctiendat@gmail.com - VioPay', 'pending', '', '125.235.4.59', '2021-12-13 09:44:11', NULL),
(17, '5890467918', 'lctiendat@gmail.com', '1234567656678766', 'withdraw', '50000', NULL, 'pending', '', '125.235.4.59', '2021-12-13 09:44:47', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `delete_flag` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `description`, `content`, `thumbnail`, `slug`, `delete_flag`, `created`, `modified`) VALUES
(1, 'ẢNH: TP.HCM chính thức triển khai tiêm mũi 3 vaccine phòng Covid-19 cho người dân', 'ẢNH: TP.HCM chính thức triển khai tiêm mũi 3 vaccine phòng Covid-19 cho người dân', 'Ghi nhận tại điểm tiêm trường Đại học Công nghiệp (quận Gò Vấp, TP.HCM), công tác chuẩn bị tiêm chủng được diễn ra nghiêm túc, đảm bảo các quy định về phòng chống dịch bệnh.', 'https://vcdn1-dulich.vnecdn.net/2021/07/16/8-1626444967.jpg?w=1200&h=0&q=100&dpr=1&fit=crop&s=GfgGn4dNuKZexy1BGkAUNA', 'test-5746508385', 0, '2021-12-10 11:50:26', '2021-12-10 11:50:26'),
(2, 'Nóng: Lâm Khánh Chi và chồng kém 8 tuổi ly hôn sau 4 năm chung sống', 'Nóng: Lâm Khánh Chi và chồng kém 8 tuổi ly hôn sau 4 năm chung sống', 'Thời gian qua, vợ chồng Lâm Khánh Chi không còn xuất hiện bên nhau nhiều như trước. Việc mỹ nhân chuyển giới liên tục đăng status ẩn ý còn làm rộ nghi vấn trục trặc hôn nhân sau 4 năm gắn bó.', 'https://i.pinimg.com/280x280_RS/12/6d/dd/126dddbafa26a88babd9e8540c6d0bd7.jpg', 'n-ng-l-m-kh-nh-chi-v-ch--6357801058', 0, '2021-12-10 11:51:17', '2021-12-10 11:51:17'),
(3, 'Một sao Việt hạng A bị tố mặc đồ fake ở giải MAMA năm nào, phản ứng của stylist khiến netizen cười 1 bên miệng', 'Một sao Việt hạng A bị tố mặc đồ fake ở giải MAMA năm nào, phản ứng của stylist khiến netizen cười 1 bên miệng', 'MAMA - Giải thưởng Âm nhạc Châu Á Mnet là lễ trao giải mang tầm ảnh hưởng lớn ở Châu Á, tiếng tăm vang dội tới hàng thập kỷ. Được nhận giải thưởng của sự kiện này là niềm vinh dự của hầu hết mọi ngôi sao, nhất là những gương mặt trẻ tuổi muốn chắp cánh cho danh tiếng bay ra khỏi địa hạt làng giải trí nơi mình đang hoạt động.', 'https://i.pinimg.com/280x280_RS/12/6d/dd/126dddbafa26a88babd9e8540c6d0bd7.jpg', 'm-t-sao-vi-t-h-ng-a-b--7607915698', 0, '2021-12-10 11:52:25', '2021-12-10 11:52:25'),
(4, '7 phim bom tấn xuất sắc, đình đám nhất 2021: Công nương Diana của Kristen Stewart xịn nhưng công chúa Disney gốc Việt còn đỉnh hơn!', '7 phim bom tấn xuất sắc, đình đám nhất 2021: Công nương Diana của Kristen Stewart xịn nhưng công chúa Disney gốc Việt còn đỉnh hơn!', '7 phim bom tấn xuất sắc, đình đám nhất 2021: Công nương Diana của Kristen Stewart xịn nhưng công chúa Disney gốc Việt còn đỉnh hơn!', 'https://vcdn1-dulich.vnecdn.net/2021/07/16/8-1626444967.jpg?w=1200&h=0&q=100&dpr=1&fit=crop&s=GfgGn4dNuKZexy1BGkAUNA', '7-phim-bom-t-n-xu-t-s-c--3186122373', 0, '2021-12-10 12:52:34', '2021-12-10 12:52:34'),
(5, 'App MBBank nằm trong Top ứng dụng yêu thích App Store 2021', 'App MBBank nằm trong Top ứng dụng yêu thích App Store 2021', 'App MBBank nằm trong Top ứng dụng yêu thích App Store 2021', 'https://vcdn1-dulich.vnecdn.net/2021/07/16/8-1626444967.jpg?w=1200&h=0&q=100&dpr=1&fit=crop&s=GfgGn4dNuKZexy1BGkAUNA', 'app-mbbank-n-m-trong-top--5115773839', 0, '2021-12-10 16:54:41', '2021-12-10 16:54:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `thread` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `logs`
--

INSERT INTO `logs` (`id`, `thread`, `ip`, `created`) VALUES
(1, 'lctiendat@gmail.com đăng ký tài khoản', '125.235.4.59', '2021-12-04 17:33:06'),
(2, 'contact.letiendat@gmail.com đăng ký tài khoản', '125.235.4.59', '2021-12-08 20:05:28'),
(3, 'lecongphucchuong@gmail.com đăng ký tài khoản', '125.235.4.59', '2021-12-12 22:20:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `thread` varchar(255) NOT NULL,
  `delete_flag` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `notifications`
--

INSERT INTO `notifications` (`id`, `email`, `thread`, `delete_flag`, `created`) VALUES
(2, 'lctiendat@gmail.com', 'Yêu cầu nạp 50000đ đã được duyệt', 1, '2021-12-04 21:10:24'),
(3, 'lctiendat@gmail.com', 'Yêu cầu nạp 100000đ đã được duyệt', 1, '2021-12-05 12:23:49'),
(4, 'lctiendat@gmail.com', 'Yêu cầu rút 50000 đ đã được duyệt', 1, '2021-12-07 14:49:58'),
(5, 'lctiendat@gmail.com', 'Yêu cầu nạp 100000đ đã được duyệt', 1, '2021-12-07 14:52:16'),
(6, 'manhhung@gmail.com', 'Bạn vừa nhận được 50000 đ từ lctiendat@gmail.com', 0, '2021-12-08 10:31:13'),
(7, 'manhhung@gmail.com', 'Bạn vừa nhận được 50000 đ từ lctiendat@gmail.com', 0, '2021-12-08 10:32:01'),
(8, 'lctiendat@gmail.com', 'Bạn vừa nhận được 50000 đ từ manhhung@gmail.com', 1, '2021-12-11 12:15:09'),
(9, 'lctiendat@gmail.com', 'Yêu cầu rút 50000 đ đã được duyệt', 1, '2021-12-12 15:44:09'),
(10, 'lctiendat@gmail.com', 'Yêu cầu rút 200000 đ đã được duyệt', 1, '2021-12-12 15:44:45'),
(11, 'lctiendat@gmail.com', 'Yêu cầu rút 50000 đ đã được duyệt', 1, '2021-12-12 15:47:44'),
(12, 'lctiendat@gmail.com', 'Yêu cầu rút 100000 đ đã được duyệt', 1, '2021-12-12 15:48:07'),
(13, 'lctiendat@gmail.com', 'Yêu cầu rút 50000 đ đã được duyệt', 1, '2021-12-12 15:57:22'),
(14, 'lctiendat@gmail.com', 'Yêu cầu rút 200000 đ đã được duyệt', 1, '2021-12-12 15:58:04'),
(15, 'lctiendat@gmail.com', 'Yêu cầu rút 50000 đ đã được duyệt', 1, '2021-12-12 15:58:19'),
(16, 'lctiendat@gmail.com', 'Yêu cầu rút 50000 đ đã được duyệt', 1, '2021-12-12 15:58:43'),
(17, 'lctiendat@gmail.com', 'Yêu cầu rút 50000 đ đã được duyệt', 1, '2021-12-12 15:59:26'),
(18, 'lctiendat@gmail.com', 'Yêu cầu rút 50000 đ đã được duyệt', 1, '2021-12-12 16:00:14'),
(19, 'lctiendat@gmail.com', 'Yêu cầu rút 100000 đ đã được duyệt', 1, '2021-12-12 16:08:23'),
(20, 'lctiendat@gmail.com', 'Yêu cầu rút 200000 đ đã được duyệt', 1, '2021-12-12 16:08:38'),
(21, 'lctiendat@gmail.com', 'Yêu cầu rút 200000 đ đã được duyệt', 1, '2021-12-12 16:08:59'),
(22, 'lctiendat@gmail.com', 'Yêu cầu nạp 50000đ đã được duyệt', 1, '2021-12-12 16:16:04'),
(23, 'lctiendat@gmail.com', 'Yêu cầu nạp 50000đ đã được duyệt', 1, '2021-12-12 16:24:23'),
(24, 'lctiendat@gmail.com', 'Yêu cầu nạp 100000đ đã được duyệt', 1, '2021-12-12 16:27:50'),
(25, 'lctiendat@gmail.com', 'Yêu cầu nạp 50000đ đã được duyệt', 1, '2021-12-12 21:40:00'),
(26, 'manhhung@gmail.com', 'Bạn vừa nhận được 50000 đ từ lctiendat@gmail.com', 0, '2021-12-12 21:41:23'),
(27, 'manhhung@gmail.com', 'Bạn vừa nhận được 50000 đ từ lctiendat@gmail.com', 0, '2021-12-12 21:57:19'),
(28, 'manhhung@gmail.com', 'Bạn vừa nhận được 50000 đ từ lctiendat@gmail.com', 0, '2021-12-13 09:41:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `otp_securities`
--

CREATE TABLE `otp_securities` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `otp_securities`
--

INSERT INTO `otp_securities` (`id`, `email`, `otp`, `ip`, `created`) VALUES
(1, 'lctiendat@gmail.com', 'cT2DNenMGZ', '125.235.4.59', '2021-12-07 14:48:19'),
(2, 'lctiendat@gmail.com', '1IwHSKMUIQ', '125.235.4.59', '2021-12-07 14:48:59'),
(3, 'lctiendat@gmail.com', 'rCjJCwtzrK', '125.235.4.59', '2021-12-07 14:53:30'),
(4, 'lctiendat@gmail.com', 'bQRDKivZKD', '125.235.4.59', '2021-12-08 10:21:11'),
(5, 'lctiendat@gmail.com', 'LT5gS0GQdq', '125.235.4.59', '2021-12-08 11:11:11'),
(6, 'lctiendat@gmail.com', 'jG9U4J2MnY', '125.235.4.59', '2021-12-08 17:26:41'),
(7, 'contact.letiendat@gmail.com', '8vTTrrbHon', '125.235.4.59', '2021-12-08 18:58:33'),
(8, 'contact.letiendat@gmail.com', 'B9H7cCHgzX', '125.235.4.59', '2021-12-08 20:03:25'),
(9, 'lctiendat@gmail.com', 'lHackWseFF', '125.235.4.59', '2021-12-09 17:11:20'),
(10, 'lctiendat@gmail.com', 'xNc4qU2VlF', '125.235.4.59', '2021-12-09 17:12:37'),
(11, 'lctiendat@gmail.com', 'T7xddQLvwv', '::1', '2021-12-09 17:28:37'),
(12, 'lctiendat@gmail.com', '7uB0AqxrN4', '125.235.4.59', '2021-12-09 20:45:30'),
(13, 'lctiendat@gmail.com', 'fbRcXFj2a2', '::1', '2021-12-10 09:29:13'),
(14, 'contact.letiendat@gmail.com', 't56fnWmVp2', '125.235.4.59', '2021-12-10 17:29:22'),
(15, 'manhhung@gmail.com', 'PlExdBTWao', '125.235.4.59', '2021-12-11 12:14:48'),
(16, 'lctiendat@gmail.com', 'W9G6ci4KSW', '125.235.4.59', '2021-12-12 21:40:46'),
(17, 'lctiendat@gmail.com', '55r60hS7gW', '125.235.4.59', '2021-12-12 21:55:04'),
(18, 'lctiendat@gmail.com', 'aqHhWALqwB', '125.235.4.59', '2021-12-12 21:57:01'),
(19, 'lctiendat@gmail.com', 'g8jwYMYfz9', '125.235.4.59', '2021-12-12 21:57:57'),
(20, 'lctiendat@gmail.com', 'qvw0t8IivR', '125.235.4.59', '2021-12-12 22:00:14'),
(21, 'lctiendat@gmail.com', 'tkkB4hAW6G', '125.235.4.59', '2021-12-12 22:02:14'),
(22, 'lctiendat@gmail.com', '2MePPw4Stb', '125.235.4.59', '2021-12-12 22:04:35'),
(23, 'lctiendat@gmail.com', 'nnl3MiSDoE', '125.235.4.59', '2021-12-12 22:06:14'),
(24, 'lecongphucchuong@gmail.com', 'Gv5Q3I8BG6', '125.235.4.59', '2021-12-12 22:20:05'),
(25, 'lctiendat@gmail.com', 'jlhaCKM0KL', '125.235.4.59', '2021-12-13 09:41:14'),
(26, 'lctiendat@gmail.com', 'njSuVX0oz7', '125.235.4.59', '2021-12-13 09:44:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phinxlog`
--

CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `phinxlog`
--

INSERT INTO `phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20211023034756, 'CreateUsers', '2021-12-04 10:25:42', '2021-12-04 10:25:42', 0),
(20211023051620, 'CreateLogs', '2021-12-04 10:25:42', '2021-12-04 10:25:42', 0),
(20211023052203, 'CreateTransactionHistories', '2021-12-04 10:25:42', '2021-12-04 10:25:42', 0),
(20211024090400, 'CreateOtpsecurities', '2021-12-04 10:25:42', '2021-12-04 10:25:42', 0),
(20211107034231, 'CreateUserLatestIp', '2021-12-04 10:25:42', '2021-12-04 10:25:42', 0),
(20211121144949, 'CreateBanks', '2021-12-07 02:49:13', '2021-12-07 02:49:13', 0),
(20211122045959, 'CreateBankOfUsers', '2021-12-04 10:25:42', '2021-12-04 10:25:42', 0),
(20211123135602, 'CreateBankTransactionHistories', '2021-12-04 10:25:42', '2021-12-04 10:25:42', 0),
(20211125083451, 'CreateUserStatus', '2021-12-04 10:25:42', '2021-12-04 10:25:43', 0),
(20211130035611, 'CreateAttendance', '2021-12-04 10:25:43', '2021-12-04 10:25:43', 0),
(20211130072934, 'CreateVouchers', '2021-12-04 10:25:43', '2021-12-04 10:25:43', 0),
(20211201072709, 'CreateVoucherOfUsers', '2021-12-04 10:25:43', '2021-12-04 10:25:43', 0),
(20211201123252, 'CreateApiConnect', '2021-12-10 11:40:50', '2021-12-10 11:40:50', 0),
(20211204123109, 'CreateNotifications', '2021-12-04 13:35:42', '2021-12-04 13:35:42', 0),
(20211205095205, 'CreateBlogs', '2021-12-10 04:24:49', '2021-12-10 04:24:49', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transaction_histories`
--

CREATE TABLE `transaction_histories` (
  `id` int(11) NOT NULL,
  `tranding_code` varchar(255) NOT NULL,
  `transmitter` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `amount_of_money` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `transaction_histories`
--

INSERT INTO `transaction_histories` (`id`, `tranding_code`, `transmitter`, `receiver`, `amount_of_money`, `content`, `ip`, `created`) VALUES
(1, '8837186380', 'lctiendat@gmail.com', 'manhhung@gmail.com', '11111', 'Chuyển tiền', '125.235.4.59', '2021-12-05 14:18:16'),
(2, '4162100932', 'manhhung@gmail.com', 'lctiendat@gmail.com', '100000', 'Chuyển tiền', '125.235.4.59', '2021-12-05 14:21:02'),
(3, '6021781216', 'manhhung@gmail.com', 'lctiendat@gmail.com', '50000', 'Chuyển tiền', '125.235.4.59', '2021-12-05 16:20:30'),
(4, '1724209674', 'manhhung@gmail.com', 'lctiendat@gmail.com', '50000', 'Chuyển tiền', '125.235.4.59', '2021-12-05 16:21:38'),
(5, '6598501601', 'manhhung@gmail.com', 'lctiendat@gmail.com', '50000', 'Chuyển tiền', '125.235.4.59', '2021-12-05 16:23:12'),
(6, '6937807699', 'manhhung@gmail.com', 'lctiendat@gmail.com', '50000', 'Chuyển tiền', '125.235.4.59', '2021-12-05 16:26:11'),
(7, '4937349526', 'manhhung@gmail.com', 'lctiendat@gmail.com', '50000', 'Chuyển tiền', '125.235.4.59', '2021-12-05 16:26:32'),
(8, '4104793253', 'lctiendat@gmail.com', 'manhhung@gmail.com', '50000', 'Chuyển tiền', '125.235.4.59', '2021-12-08 10:27:45'),
(9, '3732522672', 'lctiendat@gmail.com', 'manhhung@gmail.com', '50000', 'Chuyển tiền', '125.235.4.59', '2021-12-08 10:28:03'),
(10, '3636739705', 'lctiendat@gmail.com', 'manhhung@gmail.com', '50000', 'Chuyển tiền', '125.235.4.59', '2021-12-08 10:28:34'),
(11, '0772407984', 'lctiendat@gmail.com', 'manhhung@gmail.com', '50000', 'Chuyển tiền', '125.235.4.59', '2021-12-08 10:31:13'),
(12, '3929249216', 'lctiendat@gmail.com', 'manhhung@gmail.com', '50000', 'Chuyển tiền', '125.235.4.59', '2021-12-08 10:32:01'),
(13, '2253117821', 'manhhung@gmail.com', 'lctiendat@gmail.com', '50000', 'Chuyển tiền', '125.235.4.59', '2021-12-11 12:15:09'),
(14, '8797334517', 'lctiendat@gmail.com', 'manhhung@gmail.com', '50000', 'Chuyển tiền', '125.235.4.59', '2021-12-12 21:41:23'),
(15, '6568408389', 'lctiendat@gmail.com', 'manhhung@gmail.com', '50000', 'Chuyển tiền', '125.235.4.59', '2021-12-12 21:57:19'),
(16, '8942161196', 'lctiendat@gmail.com', 'manhhung@gmail.com', '50000', 'Chuyển tiền', '125.235.4.59', '2021-12-13 09:41:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar-default.png',
  `cash` varchar(255) NOT NULL DEFAULT '0',
  `coin` varchar(255) NOT NULL DEFAULT '0',
  `token_renew` varchar(255) NOT NULL,
  `token_login` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `delete_flag` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `avatar`, `cash`, `coin`, `token_renew`, `token_login`, `role`, `delete_flag`, `created`, `modified`) VALUES
(1, 'LE CONG TIEN DAT', 'lctiendat@gmail.com', 'a642a77abd7d4f51bf9226ceaf891fcbb5b299b8875048414ed89e8650cffcd7828a94226cdcc057', 'avatar-default.png', '900000', '1500', '4da1e38b7935b28e5185b759e6ceea7b09348a2c875048414ed89e8650cffcd7828a94226cdcc057', '0b2a12f7706175605706ed9ae56501fbe734fdcc875048414ed89e8650cffcd7828a94226cdcc057', 'admin', 0, '2021-12-04 17:33:06', '2021-12-13 09:45:44'),
(2, 'HAU MANH HUNG', 'manhhung@gmail.com', 'a642a77abd7d4f51bf9226ceaf891fcbb5b299b8875048414ed89e8650cffcd7828a94226cdcc057', 'avatar-default.png', '2050000', '2600', '2da1e38b7935b28e5185b759e6ceea7b09348a2c875048414ed89e8650cffcd7828a94226cdcc057', '1b2a12f7706175605706ed9ae56501fbe734fdcc875048414ed89e8650cffcd7828a94226cdcc057', 'admin', 0, '2021-12-04 17:33:06', '2021-12-11 21:26:00'),
(3, 'LE TIEN DAT', 'contact.letiendat@gmail.com', 'a642a77abd7d4f51bf9226ceaf891fcbb5b299b8875048414ed89e8650cffcd7828a94226cdcc057', 'avatar-default.png', '270000', '1100', '7deac5c875195e8770da5f7cefcb6292ffb412a4875048414ed89e8650cffcd7828a94226cdcc057', 'ae7da61bb715ae5e4f24306e41db99fb7573d59d875048414ed89e8650cffcd7828a94226cdcc057', 'user', 0, '2021-12-08 20:05:27', '2021-12-13 08:11:20'),
(4, 'LE CONG DAT', 'lecongphucchuong@gmail.com', 'a642a77abd7d4f51bf9226ceaf891fcbb5b299b8875048414ed89e8650cffcd7828a94226cdcc057', 'avatar-default.png', '100000', '0', '006a186a078ce5cc85129f639677f915f5f2051f875048414ed89e8650cffcd7828a94226cdcc057', '8c7bdc7455bd00f625e99b5124964cb7cd1d00c7875048414ed89e8650cffcd7828a94226cdcc057', 'user', 0, '2021-12-12 22:20:37', '2021-12-13 09:49:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_latest_ip`
--

CREATE TABLE `user_latest_ip` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `user_latest_ip`
--

INSERT INTO `user_latest_ip` (`id`, `email`, `ip`, `created`) VALUES
(1, 'lctiendat@gmail.com', '125.235.4.59', '2021-12-04 19:14:04'),
(2, 'manhhung@gmail.com', '125.235.4.59', '2021-12-04 19:14:04'),
(3, 'lctiendat@gmail.com', '::1', '2021-12-10 09:29:44'),
(4, 'contact.letiendat@gmail.com', '125.235.4.59', '2021-12-10 17:30:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_status`
--

CREATE TABLE `user_status` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `lock_time` date NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `delete_flag` int(11) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `user_status`
--

INSERT INTO `user_status` (`id`, `email`, `lock_time`, `reason`, `delete_flag`, `created`, `modified`) VALUES
(1, 'manhhung@gmail.com', '2021-12-08', 'thích', 0, '2021-12-07 14:42:22', '2021-12-07 14:43:17'),
(2, 'contact.letiendat@gmail.com', '2021-12-13', 'tét', 0, '2021-12-12 11:46:00', '2021-12-12 14:08:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vouchers`
--

CREATE TABLE `vouchers` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `money` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `coin` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `delete_flag` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `expired_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `vouchers`
--

INSERT INTO `vouchers` (`id`, `title`, `description`, `code`, `money`, `amount`, `coin`, `type`, `delete_flag`, `created`, `expired_time`) VALUES
(1, 'Giảm 50K  đơn', 'Giảm 50K  đơn', 'GIAMGIA50K', '50000', '98', '5000', 'reduce', 0, '2021-12-16 15:17:08', '2021-12-20'),
(2, 'Hoàn 50% đơn', 'Hoàn 50% đơn', 'HOANTIEN50', '50', '95', '500', 'refund', 0, '2021-12-07 15:20:27', '2021-12-14'),
(3, 'Giảm 100K', 'Giảm 100K', 'GIAMGIA100K', '100000', '1', '10000', 'reduce', 0, '2021-12-12 18:17:52', '2021-12-27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `voucher_of_users`
--

CREATE TABLE `voucher_of_users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `delete_flag` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `voucher_of_users`
--

INSERT INTO `voucher_of_users` (`id`, `email`, `code`, `ip`, `delete_flag`, `created`, `modified`) VALUES
(3, 'lctiendat@gmail.com', 'HOANTIEN50', '125.235.4.59', 0, '2021-12-13 09:45:44', '2021-12-13 09:45:44');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `api_connect`
--
ALTER TABLE `api_connect`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bank_of_users`
--
ALTER TABLE `bank_of_users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bank_transaction_histories`
--
ALTER TABLE `bank_transaction_histories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `otp_securities`
--
ALTER TABLE `otp_securities`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `phinxlog`
--
ALTER TABLE `phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Chỉ mục cho bảng `transaction_histories`
--
ALTER TABLE `transaction_histories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user_latest_ip`
--
ALTER TABLE `user_latest_ip`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `voucher_of_users`
--
ALTER TABLE `voucher_of_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `api_connect`
--
ALTER TABLE `api_connect`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `bank_of_users`
--
ALTER TABLE `bank_of_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `bank_transaction_histories`
--
ALTER TABLE `bank_transaction_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `otp_securities`
--
ALTER TABLE `otp_securities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `transaction_histories`
--
ALTER TABLE `transaction_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `user_latest_ip`
--
ALTER TABLE `user_latest_ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `user_status`
--
ALTER TABLE `user_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `voucher_of_users`
--
ALTER TABLE `voucher_of_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
