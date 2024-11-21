-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2024 at 09:46 AM
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
-- Database: `angkatan3_laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(60) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `adress` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `customer_name`, `phone`, `adress`, `created_at`, `update_at`) VALUES
(2, 'Hana', '081236459875', '<p>kemayoran pride gesss</p>', '2024-11-15 04:18:39', '2024-11-15 07:57:06'),
(3, 'kak ajeng', '085896734564', '<p>jaksel pride bruhh</p>', '2024-11-15 07:56:48', '2024-11-15 07:56:48'),
(4, 'nauu', '0812453678', '<p>kmy</p>', '2024-11-20 03:16:33', '2024-11-20 03:16:33'),
(5, 'azizah', '08769342156', '<p>indonesia</p>', '2024-11-21 02:11:26', '2024-11-21 02:11:26'),
(6, 'jennie', '084536257456', 'koriyah', '2024-11-21 04:47:58', '2024-11-21 04:47:58'),
(7, 'kak ulan', '0000', '<p>bon jeruk</p>', '2024-11-21 07:19:04', '2024-11-21 07:19:04');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `nama_level` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `nama_level`, `created_at`, `update_at`) VALUES
(1, 'administrator', '2024-11-13 06:20:24', '2024-11-13 06:20:24'),
(2, 'operator', '2024-11-13 06:20:24', '2024-11-13 06:20:24');

-- --------------------------------------------------------

--
-- Table structure for table `trans_laundry_pickup`
--

CREATE TABLE `trans_laundry_pickup` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `pickup_date` date NOT NULL,
  `pickup_pay` double(10,2) NOT NULL,
  `pickup_change` double(10,2) NOT NULL,
  `notes` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trans_laundry_pickup`
--

INSERT INTO `trans_laundry_pickup` (`id`, `id_order`, `id_customer`, `pickup_date`, `pickup_pay`, `pickup_change`, `notes`, `created_at`, `update_at`) VALUES
(1, 7, 5, '2024-11-21', 50000.00, 21.00, '', '2024-11-21 04:28:23', '2024-11-21 04:28:23'),
(2, 9, 6, '2024-11-21', 10000.00, 5000.00, '', '2024-11-21 06:45:48', '2024-11-21 06:45:48'),
(3, 10, 7, '2024-11-21', 50000.00, 11000.00, '', '2024-11-21 07:19:40', '2024-11-21 07:19:40');

-- --------------------------------------------------------

--
-- Table structure for table `trans_order`
--

CREATE TABLE `trans_order` (
  `id` int(11) NOT NULL,
  `id_customer` int(25) NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `order_date` datetime NOT NULL,
  `order_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trans_order`
--

INSERT INTO `trans_order` (`id`, `id_customer`, `order_code`, `order_date`, `order_status`, `created_at`, `update_at`) VALUES
(3, 2, 'INV/201124-0003', '2024-11-20 00:00:00', 0, '2024-11-20 03:14:01', '2024-11-20 03:14:01'),
(5, 2, 'INV/201124-0005', '2024-11-20 00:00:00', 0, '2024-11-20 03:48:07', '2024-11-20 03:48:07'),
(6, 4, 'INV/201124-0006', '2024-11-05 00:00:00', 0, '2024-11-20 05:03:11', '2024-11-20 05:03:11'),
(7, 5, 'INV/211124-0007', '2024-11-25 00:00:00', 1, '2024-11-21 02:12:30', '2024-11-21 04:28:23'),
(9, 6, 'INV/211124-0009', '2024-11-16 00:00:00', 1, '2024-11-21 06:45:33', '2024-11-21 06:45:48'),
(10, 7, 'INV/211124-00010', '2024-11-12 00:00:00', 1, '2024-11-21 07:19:27', '2024-11-21 07:19:40');

-- --------------------------------------------------------

--
-- Table structure for table `trans_order_detail`
--

CREATE TABLE `trans_order_detail` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `qty` int(20) NOT NULL,
  `subtotal` double(10,2) NOT NULL,
  `notes` varchar(155) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trans_order_detail`
--

INSERT INTO `trans_order_detail` (`id`, `id_order`, `id_service`, `qty`, `subtotal`, `notes`, `created_at`, `update_at`) VALUES
(28, 3, 3, 1, 5000.00, '', '2024-11-20 03:14:01', '2024-11-20 03:14:01'),
(29, 5, 4, 1, 4500.00, '', '2024-11-20 03:48:07', '2024-11-20 03:48:07'),
(30, 6, 6, 1, 7000.00, '', '2024-11-20 05:03:11', '2024-11-20 05:03:11'),
(31, 7, 3, 3, 15000.00, '', '2024-11-21 02:12:30', '2024-11-21 02:12:30'),
(32, 7, 6, 2, 14000.00, '', '2024-11-21 02:12:30', '2024-11-21 02:12:30'),
(35, 9, 3, 1, 5000.00, '', '2024-11-21 06:45:33', '2024-11-21 06:45:33'),
(36, 10, 6, 2, 14000.00, '', '2024-11-21 07:19:27', '2024-11-21 07:19:27'),
(37, 10, 5, 5, 25000.00, '', '2024-11-21 07:19:27', '2024-11-21 07:19:27');

-- --------------------------------------------------------

--
-- Table structure for table `type_of_service`
--

CREATE TABLE `type_of_service` (
  `id` int(11) NOT NULL,
  `service_name` varchar(155) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type_of_service`
--

INSERT INTO `type_of_service` (`id`, `service_name`, `price`, `description`, `created_at`, `update_at`) VALUES
(3, 'Cuci dan Gosok', 5000.00, '<p><span style=\"color: rgb(105, 122, 141); font-family: &quot;Public Sans&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Oxygen, Ubuntu, Cantarell, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif;\">Baju bersih, rapih dan wangi customer puas hatipun senang</span></p>', '2024-11-14 08:30:37', '2024-11-14 08:30:37'),
(4, 'Hanya Cuci', 4500.00, '<p>nyuci aja gosok sendiri</p>', '2024-11-14 08:30:53', '2024-11-14 08:30:53'),
(5, 'Hanya Gosok', 5000.00, '<p>males nyuci gosok disini ajahh</p>', '2024-11-14 08:32:36', '2024-11-14 08:32:36'),
(6, 'laundry item besar', 7000.00, '<p>Seperti selimut, karpet,&nbsp;<span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">mantel dan sprei my love</span></p>', '2024-11-15 01:23:46', '2024-11-15 04:34:41');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_level`, `nama`, `email`, `username`, `password`, `foto`, `created_at`, `update_at`) VALUES
(2, 1, 'fifi', 'fifi@gmail.com', 'fifiaja', '123', '', '2024-11-13 06:44:49', '2024-11-14 05:04:42'),
(5, 2, 'pipi', 'pipi@gmail.com', 'pipiaja', '123', '', '2024-11-14 05:04:13', '2024-11-14 05:04:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trans_laundry_pickup`
--
ALTER TABLE `trans_laundry_pickup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indexes for table `trans_order`
--
ALTER TABLE `trans_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indexes for table `trans_order_detail`
--
ALTER TABLE `trans_order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_service` (`id_service`);

--
-- Indexes for table `type_of_service`
--
ALTER TABLE `type_of_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_level` (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trans_laundry_pickup`
--
ALTER TABLE `trans_laundry_pickup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trans_order`
--
ALTER TABLE `trans_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `trans_order_detail`
--
ALTER TABLE `trans_order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `type_of_service`
--
ALTER TABLE `type_of_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `trans_laundry_pickup`
--
ALTER TABLE `trans_laundry_pickup`
  ADD CONSTRAINT `trans_laundry_pickup_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `trans_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trans_laundry_pickup_ibfk_2` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trans_order`
--
ALTER TABLE `trans_order`
  ADD CONSTRAINT `trans_order_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trans_order_detail`
--
ALTER TABLE `trans_order_detail`
  ADD CONSTRAINT `trans_order_detail_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `trans_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trans_order_detail_ibfk_2` FOREIGN KEY (`id_service`) REFERENCES `type_of_service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
