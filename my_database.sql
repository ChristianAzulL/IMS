-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2024 at 02:38 AM
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
-- Database: `my_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `hashed_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand_name`, `date`, `user_id`, `hashed_id`) VALUES
(1, 'ROG', '2024-12-07 09:10:37', 0, '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b'),
(2, 'Acer', '2024-12-07 09:11:15', 0, 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `hashed_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `date`, `user_id`, `hashed_id`) VALUES
(1, 'Laptop Charger', '2024-12-07 09:10:22', 0, '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b');

-- --------------------------------------------------------

--
-- Table structure for table `courier`
--

CREATE TABLE `courier` (
  `id` int(11) NOT NULL,
  `courier_name` varchar(255) DEFAULT NULL,
  `logistic_partner` varchar(80) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `hashed_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courier`
--

INSERT INTO `courier` (`id`, `courier_name`, `logistic_partner`, `date`, `user_id`, `hashed_id`) VALUES
(1, 'NinjanVan', NULL, '2024-11-18 07:02:09', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b'),
(2, 'JnT', NULL, '2024-11-18 07:02:17', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35'),
(3, 'Flash Express', NULL, '2024-11-18 07:02:27', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce'),
(4, 'Own Rider', NULL, '2024-11-18 07:02:34', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a');

-- --------------------------------------------------------

--
-- Table structure for table `inbound_logs`
--

CREATE TABLE `inbound_logs` (
  `id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `supplier` varchar(80) NOT NULL,
  `date_received` datetime NOT NULL,
  `user_id` varchar(80) NOT NULL,
  `warehouse` varchar(80) NOT NULL,
  `hashed_id` longtext DEFAULT NULL,
  `unique_key` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inbound_logs`
--

INSERT INTO `inbound_logs` (`id`, `po_id`, `supplier`, `date_received`, `user_id`, `warehouse`, `hashed_id`, `unique_key`) VALUES
(1, 2, '', '2024-12-07 00:00:00', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', NULL, '81dbdd476b2af76e');

-- --------------------------------------------------------

--
-- Table structure for table `item_location`
--

CREATE TABLE `item_location` (
  `id` int(11) NOT NULL,
  `location_name` varchar(50) DEFAULT NULL,
  `warehouse` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `hashed_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_location`
--

INSERT INTO `item_location` (`id`, `location_name`, `warehouse`, `date`, `user_id`, `hashed_id`) VALUES
(5, 'Shelf A', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-12-06 20:52:14', '0', NULL),
(6, 'Shelf B', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-12-06 20:52:23', '0', NULL),
(7, 'Shelf C', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-12-06 20:52:30', '0', NULL),
(8, 'Rack A', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-12-06 20:52:37', '0', NULL),
(9, 'Rack B', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-12-06 20:52:46', '0', NULL),
(10, 'Rack C', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-12-06 20:52:54', '0', NULL),
(11, 'Bogambilya A', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-12-06 20:53:07', '0', NULL),
(12, 'Bogambilya B', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-12-06 20:53:13', '0', NULL),
(13, 'Bogambilya C', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-12-06 20:53:19', '0', NULL),
(14, 'Rack A-1-1', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-12-06 20:53:31', '0', NULL),
(15, 'Rack A-1-2', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683', '2024-12-06 20:53:39', '0', NULL),
(16, 'Rack A-1-1', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683', '2024-12-06 20:54:19', '0', NULL),
(17, 'Shelf A-1', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451', '2024-12-06 20:54:27', '0', NULL),
(18, 'Shelf A-2', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451', '2024-12-06 20:54:34', '0', NULL),
(19, 'Shelf A-1-1', '2c624232cdd221771294dfbb310aca000a0df6ac8b66b696d90ef06fdefb64a3', '2024-12-06 20:54:43', '0', NULL),
(20, 'Shelf B-1-1', '2c624232cdd221771294dfbb310aca000a0df6ac8b66b696d90ef06fdefb64a3', '2024-12-06 20:54:52', '0', NULL),
(21, 'Shelf A-B-1', '19581e27de7ced00ff1ce50b2047e7a567c76b1cbaebabe5ef03f7c3017bb5b7', '2024-12-06 20:55:01', '0', NULL),
(22, 'Shelf A-B-2', '19581e27de7ced00ff1ce50b2047e7a567c76b1cbaebabe5ef03f7c3017bb5b7', '2024-12-06 20:55:14', '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logistic_partner`
--

CREATE TABLE `logistic_partner` (
  `id` int(11) NOT NULL,
  `logistic_name` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `hashed_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logistic_partner`
--

INSERT INTO `logistic_partner` (`id`, `logistic_name`, `date`, `user_id`, `hashed_id`) VALUES
(1, 'Lazada', '2024-11-18 07:01:46', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b'),
(2, 'Shoppee', '2024-11-18 07:01:52', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `action` longtext DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `hashed_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `outbound_content`
--

CREATE TABLE `outbound_content` (
  `id` int(11) NOT NULL,
  `unique_barcode` varchar(30) DEFAULT NULL,
  `sold_price` decimal(10,2) DEFAULT NULL,
  `product_id` varchar(80) NOT NULL,
  `tax` varchar(5) DEFAULT NULL,
  `hashed_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `outbound_logs`
--

CREATE TABLE `outbound_logs` (
  `id` int(11) NOT NULL,
  `date_sent` datetime DEFAULT NULL,
  `warehouse` varchar(80) NOT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `customer_fname` varchar(50) DEFAULT NULL,
  `customer_lname` varchar(50) DEFAULT NULL,
  `customer_address` longtext DEFAULT NULL,
  `customer_contact` varchar(13) DEFAULT NULL,
  `courier` int(11) DEFAULT NULL,
  `logistic_partner` int(11) DEFAULT NULL,
  `logistic_code` varchar(30) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `tax` varchar(5) DEFAULT NULL,
  `hashed_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_img` longtext DEFAULT NULL,
  `category` longtext DEFAULT NULL,
  `brand` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `parent_barcode` varchar(30) DEFAULT NULL,
  `safety` int(11) NOT NULL,
  `capital` decimal(10,2) DEFAULT NULL,
  `wholesale` decimal(10,2) DEFAULT NULL,
  `srp` decimal(10,2) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `hashed_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_img`, `category`, `brand`, `description`, `parent_barcode`, `safety`, `capital`, `wholesale`, `srp`, `date`, `user_id`, `hashed_id`) VALUES
(1, '../../assets/img/Acer-Aspire-3-A314-35-charger-1182-888.jpg', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'Laptop Charger Type C', '10000021', 0, NULL, NULL, NULL, '2024-12-07 09:12:02', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b'),
(2, '../../assets/img/rog.jpg', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'Laptop Charger Type C for ROG ally Z1', '1000992', 0, NULL, NULL, NULL, '2024-12-07 09:12:40', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35');

-- --------------------------------------------------------

--
-- Table structure for table `purchased_order`
--

CREATE TABLE `purchased_order` (
  `id` int(11) NOT NULL,
  `warehouse` varchar(80) DEFAULT NULL,
  `supplier` varchar(80) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `date_order` datetime DEFAULT NULL,
  `date_received` datetime DEFAULT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `generated_po` varchar(3) NOT NULL,
  `pdf` longblob NOT NULL,
  `hashed_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchased_order_content`
--

CREATE TABLE `purchased_order_content` (
  `id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `hashed_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `item_status` int(11) NOT NULL,
  `inbound_id` int(11) NOT NULL,
  `unique_barcode` varchar(30) DEFAULT NULL,
  `product_id` varchar(80) DEFAULT NULL,
  `parent_barcode` varchar(30) DEFAULT NULL,
  `batch_code` varchar(30) DEFAULT NULL,
  `capital` decimal(10,2) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `item_location` varchar(255) NOT NULL,
  `warehouse` varchar(80) DEFAULT NULL,
  `supplier` varchar(80) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `pdf` longblob NOT NULL,
  `hashed_id` longtext DEFAULT NULL,
  `unique_key` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `item_status`, `inbound_id`, `unique_barcode`, `product_id`, `parent_barcode`, `batch_code`, `capital`, `price`, `item_location`, `warehouse`, `supplier`, `date`, `user_id`, `pdf`, `hashed_id`, `unique_key`) VALUES
(1, 0, 1, '10000021-1', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', '10000021', 'Batch_10001', 165.00, NULL, '', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683', '2024-12-07 09:13:35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', '81dbdd476b2af76e'),
(2, 0, 1, '10000021-2', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', '10000021', 'Batch_10001', 165.00, NULL, '', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683', '2024-12-07 09:13:35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '81dbdd476b2af76e'),
(3, 0, 1, '10000021-3', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', '10000021', 'Batch_10001', 165.00, NULL, '', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683', '2024-12-07 09:13:35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '81dbdd476b2af76e'),
(4, 0, 1, '10000021-4', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', '10000021', 'Batch_10001', 165.00, NULL, '', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683', '2024-12-07 09:13:35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '81dbdd476b2af76e'),
(5, 0, 1, '10000021-5', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', '10000021', 'Batch_10001', 165.00, NULL, '', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683', '2024-12-07 09:13:35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '81dbdd476b2af76e'),
(6, 0, 1, '10000021-6', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', '10000021', 'Batch_10001', 165.00, NULL, '', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683', '2024-12-07 09:13:35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683', '81dbdd476b2af76e'),
(7, 0, 1, '10000021-7', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', '10000021', 'Batch_10001', 165.00, NULL, '', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683', '2024-12-07 09:13:35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451', '81dbdd476b2af76e'),
(8, 0, 1, '10000021-8', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', '10000021', 'Batch_10001', 165.00, NULL, '', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683', '2024-12-07 09:13:35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '2c624232cdd221771294dfbb310aca000a0df6ac8b66b696d90ef06fdefb64a3', '81dbdd476b2af76e'),
(9, 0, 1, '10000021-9', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', '10000021', 'Batch_10001', 165.00, NULL, '', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683', '2024-12-07 09:13:35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '19581e27de7ced00ff1ce50b2047e7a567c76b1cbaebabe5ef03f7c3017bb5b7', '81dbdd476b2af76e'),
(10, 0, 1, '10000021-10', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', '10000021', 'Batch_10001', 165.00, NULL, '', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683', '2024-12-07 09:13:35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '4a44dc15364204a80fe80e9039455cc1608281820fe2b24f1e5233ade6af1dd5', '81dbdd476b2af76e'),
(11, 0, 1, '1000992-1', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '1000992', 'Batch_0008', 1165.00, NULL, '', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451', '2024-12-07 09:13:35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8', '81dbdd476b2af76e'),
(12, 0, 1, '1000992-2', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '1000992', 'Batch_0008', 1165.00, NULL, '', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451', '2024-12-07 09:13:35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '6b51d431df5d7f141cbececcf79edf3dd861c3b4069f0b11661a3eefacbba918', '81dbdd476b2af76e'),
(13, 0, 1, '1000992-3', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '1000992', 'Batch_0008', 1165.00, NULL, '', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451', '2024-12-07 09:13:35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '3fdba35f04dc8c462986c992bcf875546257113072a909c162f7e470e581e278', '81dbdd476b2af76e'),
(14, 0, 1, '1000992-4', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '1000992', 'Batch_0008', 1165.00, NULL, '', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451', '2024-12-07 09:13:35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61', '81dbdd476b2af76e'),
(15, 0, 1, '1000992-5', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '1000992', 'Batch_0008', 1165.00, NULL, '', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451', '2024-12-07 09:13:35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'e629fa6598d732768f7c726b4b621285f9c3b85303900aa912017db7617d8bdb', '81dbdd476b2af76e'),
(16, 0, 1, '1000992-6', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '1000992', 'Batch_0008', 1165.00, NULL, '', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451', '2024-12-07 09:13:35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'b17ef6d19c7a5b1ee83b907c595526dcb1eb06db8227d650d5dda0a9f4ce8cd9', '81dbdd476b2af76e'),
(17, 0, 1, '1000992-7', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '1000992', 'Batch_0008', 1165.00, NULL, '', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451', '2024-12-07 09:13:35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '4523540f1504cd17100c4835e85b7eefd49911580f8efff0599a8f283be6b9e3', '81dbdd476b2af76e'),
(18, 0, 1, '1000992-8', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '1000992', 'Batch_0008', 1165.00, NULL, '', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451', '2024-12-07 09:13:35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '4ec9599fc203d176a301536c2e091a19bc852759b255bd6818810a42c5fed14a', '81dbdd476b2af76e'),
(19, 0, 1, '1000992-9', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '1000992', 'Batch_0008', 1165.00, NULL, '', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451', '2024-12-07 09:13:35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '9400f1b21cb527d7fa3d3eabba93557a18ebe7a2ca4e471cfe5e4c5b4ca7f767', '81dbdd476b2af76e'),
(20, 0, 1, '1000992-10', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '1000992', 'Batch_0008', 1165.00, NULL, '', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451', '2024-12-07 09:13:35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'f5ca38f748a1d6eaf726b8a42fb575c3c71f1864a8143301782de13da2d9202b', '81dbdd476b2af76e');

-- --------------------------------------------------------

--
-- Table structure for table `stock_timeline`
--

CREATE TABLE `stock_timeline` (
  `id` int(11) NOT NULL,
  `unique_barcode` varchar(30) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `action` longtext DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `hashed_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_transfer`
--

CREATE TABLE `stock_transfer` (
  `id` int(11) NOT NULL,
  `from_warehouse` varchar(80) DEFAULT NULL,
  `to_warehouse` varchar(80) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `from_userid` varchar(80) DEFAULT NULL,
  `received_userid` varchar(80) DEFAULT NULL,
  `date_out` datetime DEFAULT NULL,
  `date_received` datetime DEFAULT NULL,
  `remarks_sender` longtext DEFAULT NULL,
  `remarks_receiver` longtext DEFAULT NULL,
  `hashed_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_transfer_content`
--

CREATE TABLE `stock_transfer_content` (
  `id` int(11) NOT NULL,
  `unique_barcode` varchar(30) DEFAULT NULL,
  `qty_sent` int(11) DEFAULT NULL,
  `qty_received` int(11) DEFAULT NULL,
  `hashed_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `supplier_name` varchar(100) DEFAULT NULL,
  `supplier_address` longtext DEFAULT NULL,
  `local_international` varchar(13) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `hashed_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `supplier_name`, `supplier_address`, `local_international`, `date`, `user_id`, `hashed_id`) VALUES
(1, 'Supplier_1', NULL, NULL, '2024-12-06 21:39:16', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b'),
(2, 'Supplier_2', NULL, NULL, '2024-12-06 21:39:16', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35'),
(3, 'Supplier_3', NULL, NULL, '2024-12-06 21:39:16', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce'),
(4, 'Supplier_4', NULL, NULL, '2024-12-06 21:39:16', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a'),
(5, 'Supplier_5', NULL, NULL, '2024-12-06 21:39:16', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d'),
(6, 'Black Mamba Corp', NULL, 'International', '2024-12-07 09:07:41', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683'),
(7, 'ROG Ph', NULL, 'Local', '2024-12-07 09:08:03', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_position` longtext DEFAULT NULL,
  `user_fname` varchar(50) DEFAULT NULL,
  `user_mname` varchar(50) DEFAULT NULL,
  `user_lname` varchar(50) DEFAULT NULL,
  `pfp` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `birth_date` datetime DEFAULT NULL,
  `warehouse_access` longtext DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `user_pw` varchar(255) NOT NULL,
  `otp` int(6) NOT NULL,
  `hashed_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_position`, `user_fname`, `user_mname`, `user_lname`, `pfp`, `email`, `birth_date`, `warehouse_access`, `address`, `status`, `user_pw`, `otp`, `hashed_id`) VALUES
(2, 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'Jose', 'Mercado', 'Rizal', '', 'administrator@admin.admin', '2018-11-08 00:00:00', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35,4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a,ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d,e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683,7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451,2c624232cdd221771294dfbb310aca000a0df6ac8b66b696d90ef06fdefb64a3,19581e27de7ced00ff1ce50b2047e7a567c76b1cbaebabe5ef03f7c3017bb5b7', NULL, '1', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 0, 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35'),
(3, 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'andres', 'Boni', 'Bonifacio', '', 'administrator2@admin.admin', '2024-11-12 00:00:00', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', NULL, '1', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 0, '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce'),
(4, '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', 'Christiano', 'Hotdog', 'Iglesyanity', '', 'sample@sample.sample', '2024-11-05 00:00:00', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', NULL, '1', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 0, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a'),
(5, 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'sample', 'sample', 'sampel', '', 'christianazul18@yahoo.com', '2024-12-02 00:00:00', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35,ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', NULL, NULL, 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 0, 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d'),
(6, 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'John', 'John', 'Cena', '', 'johncena@yahoo.com', '2024-12-02 00:00:00', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451', NULL, '1', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 0, 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683');

-- --------------------------------------------------------

--
-- Table structure for table `user_position`
--

CREATE TABLE `user_position` (
  `id` int(11) NOT NULL,
  `position_name` varchar(50) DEFAULT NULL,
  `access` longtext DEFAULT NULL,
  `position_status` int(11) NOT NULL,
  `warehouse` varchar(80) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `hashed_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_position`
--

INSERT INTO `user_position` (`id`, `position_name`, `access`, `position_status`, `warehouse`, `date`, `user_id`, `hashed_id`) VALUES
(2, 'Administrator', 'po_logs,new_po,inbound_logs,product_list,product_destination,stock,logistics,stock_transfer,returns,finance,forecasting,users,administration', 0, NULL, '2024-11-10 16:03:01', '1', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35'),
(3, 'Sample only', 'administration', 0, NULL, '2024-11-12 18:19:16', '0', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(11) NOT NULL,
  `warehouse_name` varchar(255) DEFAULT NULL,
  `warehouse_status` int(1) NOT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `hashed_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`id`, `warehouse_name`, `warehouse_status`, `date`, `user_id`, `hashed_id`) VALUES
(1, 'Warehouse Sample 2', 0, '2024-11-10 15:15:29', 1, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a'),
(2, 'Warehouse Sample 1', 0, '2024-11-10 15:05:46', 1, 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35'),
(5, 'Warehouse Sample 3', 0, '2024-11-10 15:15:42', 1, 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d'),
(6, 'Warehouse Sample 4', 0, '2024-11-10 15:26:08', 1, 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683'),
(7, 'Warehouse Sample 5', 0, '2024-11-10 15:27:18', 1, '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451'),
(8, 'Warehouse Sample 6', 0, '2024-11-10 15:30:00', 1, '2c624232cdd221771294dfbb310aca000a0df6ac8b66b696d90ef06fdefb64a3'),
(9, 'Warehouse Sample 7', 0, '2024-11-10 15:45:59', 1, '19581e27de7ced00ff1ce50b2047e7a567c76b1cbaebabe5ef03f7c3017bb5b7');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_stock_safety`
--

CREATE TABLE `warehouse_stock_safety` (
  `id` int(11) NOT NULL,
  `product_id` varchar(80) DEFAULT NULL,
  `safety` int(11) DEFAULT NULL,
  `warehouse` varchar(80) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `hashed_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courier`
--
ALTER TABLE `courier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inbound_logs`
--
ALTER TABLE `inbound_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_location`
--
ALTER TABLE `item_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logistic_partner`
--
ALTER TABLE `logistic_partner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outbound_content`
--
ALTER TABLE `outbound_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outbound_logs`
--
ALTER TABLE `outbound_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchased_order`
--
ALTER TABLE `purchased_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchased_order_content`
--
ALTER TABLE `purchased_order_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_timeline`
--
ALTER TABLE `stock_timeline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_transfer`
--
ALTER TABLE `stock_transfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_transfer_content`
--
ALTER TABLE `stock_transfer_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_position`
--
ALTER TABLE `user_position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_stock_safety`
--
ALTER TABLE `warehouse_stock_safety`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courier`
--
ALTER TABLE `courier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inbound_logs`
--
ALTER TABLE `inbound_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item_location`
--
ALTER TABLE `item_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `logistic_partner`
--
ALTER TABLE `logistic_partner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `outbound_content`
--
ALTER TABLE `outbound_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `outbound_logs`
--
ALTER TABLE `outbound_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchased_order`
--
ALTER TABLE `purchased_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchased_order_content`
--
ALTER TABLE `purchased_order_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `stock_timeline`
--
ALTER TABLE `stock_timeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_transfer`
--
ALTER TABLE `stock_transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_transfer_content`
--
ALTER TABLE `stock_transfer_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_position`
--
ALTER TABLE `user_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `warehouse_stock_safety`
--
ALTER TABLE `warehouse_stock_safety`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
