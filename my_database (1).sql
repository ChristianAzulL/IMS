-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2024 at 10:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
(1, 'brand_2', '2024-11-18 07:06:55', 0, '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b'),
(2, 'brand_3', '2024-11-18 07:06:55', 0, 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35'),
(3, 'brand_1', '2024-11-18 07:06:55', 0, '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce'),
(4, 'brand_4', '2024-11-18 07:06:55', 0, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a');

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
(1, 'category_D', '2024-11-18 07:06:55', 0, '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b'),
(2, 'category_C', '2024-11-18 07:06:55', 0, 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35'),
(3, 'category_A', '2024-11-18 07:06:55', 0, '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce'),
(4, 'category_B', '2024-11-18 07:06:55', 0, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a');

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
  `hashed_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inbound_logs`
--

INSERT INTO `inbound_logs` (`id`, `po_id`, `supplier`, `date_received`, `user_id`, `warehouse`, `hashed_id`) VALUES
(1, 7, '', '2024-11-13 00:00:00', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', NULL),
(2, 7, '', '2024-11-13 00:00:00', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451', NULL),
(3, 2, '', '2024-11-13 00:00:00', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', NULL),
(4, 2, '', '2024-11-13 00:00:00', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', NULL),
(5, 9, '', '2024-11-13 00:00:00', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683', NULL),
(6, 3, '', '2024-11-05 00:00:00', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', NULL),
(7, 3, '', '2024-11-13 00:00:00', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', NULL),
(8, 7, '', '2024-11-18 00:00:00', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_location`
--

CREATE TABLE `item_location` (
  `id` int(11) NOT NULL,
  `location_name` varchar(50) DEFAULT NULL,
  `warehouse` varchar(80) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `hashed_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_location`
--

INSERT INTO `item_location` (`id`, `location_name`, `warehouse`, `date`, `user_id`, `hashed_id`) VALUES
(1, 'Rack A', '0', '2024-11-22 11:24:45', '0', NULL);

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

INSERT INTO `product` (`id`, `product_img`, `category`, `brand`, `description`, `parent_barcode`, `capital`, `wholesale`, `srp`, `date`, `user_id`, `hashed_id`) VALUES
(1, NULL, '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'item_1', 'barcode_942967', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b'),
(2, NULL, '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'item_2', 'barcode_747340', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35'),
(3, NULL, '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', 'item_3', 'barcode_221013', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce'),
(4, NULL, 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'item_4', 'barcode_481294', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a'),
(5, NULL, '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'item_5', 'barcode_422572', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d'),
(6, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', 'item_6', 'barcode_129327', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683'),
(7, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'item_7', 'barcode_879104', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451'),
(8, NULL, '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'item_8', 'barcode_618793', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2c624232cdd221771294dfbb310aca000a0df6ac8b66b696d90ef06fdefb64a3'),
(9, NULL, '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'item_9', 'barcode_257009', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '19581e27de7ced00ff1ce50b2047e7a567c76b1cbaebabe5ef03f7c3017bb5b7'),
(10, NULL, '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'item_10', 'barcode_508603', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '4a44dc15364204a80fe80e9039455cc1608281820fe2b24f1e5233ade6af1dd5'),
(11, NULL, '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'item_11', 'barcode_885305', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8'),
(12, NULL, 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'item_12', 'barcode_617101', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '6b51d431df5d7f141cbececcf79edf3dd861c3b4069f0b11661a3eefacbba918'),
(13, NULL, '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'item_13', 'barcode_675974', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '3fdba35f04dc8c462986c992bcf875546257113072a909c162f7e470e581e278'),
(14, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'item_14', 'barcode_170002', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61'),
(15, NULL, '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', 'item_15', 'barcode_719616', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'e629fa6598d732768f7c726b4b621285f9c3b85303900aa912017db7617d8bdb'),
(16, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'item_16', 'barcode_490780', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'b17ef6d19c7a5b1ee83b907c595526dcb1eb06db8227d650d5dda0a9f4ce8cd9'),
(17, NULL, 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'item_17', 'barcode_485511', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '4523540f1504cd17100c4835e85b7eefd49911580f8efff0599a8f283be6b9e3'),
(18, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'item_18', 'barcode_271165', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '4ec9599fc203d176a301536c2e091a19bc852759b255bd6818810a42c5fed14a'),
(19, NULL, '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'item_19', 'barcode_441045', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '9400f1b21cb527d7fa3d3eabba93557a18ebe7a2ca4e471cfe5e4c5b4ca7f767'),
(20, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'item_20', 'barcode_689411', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'f5ca38f748a1d6eaf726b8a42fb575c3c71f1864a8143301782de13da2d9202b'),
(21, NULL, '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', 'item_21', 'barcode_639421', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '6f4b6612125fb3a0daecd2799dfd6c9c299424fd920f9b308110a2c1fbd8f443'),
(22, NULL, 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'item_22', 'barcode_603365', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '785f3ec7eb32f30b90cd0fcf3657d388b5ff4297f2f9716ff66e9b69c05ddd09'),
(23, NULL, 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'item_23', 'barcode_533390', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '535fa30d7e25dd8a49f1536779734ec8286108d115da5045d77f3b4185d8f790'),
(24, NULL, '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'item_24', 'barcode_174000', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'c2356069e9d1e79ca924378153cfbbfb4d4416b1f99d41a2940bfdb66c5319db'),
(25, NULL, '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'item_25', 'barcode_971801', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'b7a56873cd771f2c446d369b649430b65a756ba278ff97ec81bb6f55b2e73569'),
(26, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'item_26', 'barcode_847099', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '5f9c4ab08cac7457e9111a30e4664920607ea2c115a1433d7be98e97e64244ca'),
(27, NULL, '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'item_27', 'barcode_818665', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '670671cd97404156226e507973f2ab8330d3022ca96e0c93bdbdb320c41adcaf'),
(28, NULL, 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'item_28', 'barcode_688354', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '59e19706d51d39f66711c2653cd7eb1291c94d9b55eb14bda74ce4dc636d015a'),
(29, NULL, '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'item_29', 'barcode_801624', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '35135aaa6cc23891b40cb3f378c53a17a1127210ce60e125ccf03efcfdaec458'),
(30, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'item_30', 'barcode_943952', NULL, NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '624b60c58c9d8bfb6ff1886c2fd605d2adeb6ea4da576068201b6c6958ce93f4');

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
  `pdf` varchar(30) NOT NULL,
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
  `warehouse` varchar(80) DEFAULT NULL,
  `supplier` varchar(80) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `pdf` longblob NOT NULL,
  `hashed_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `item_status`, `inbound_id`, `unique_barcode`, `product_id`, `parent_barcode`, `batch_code`, `capital`, `price`, `warehouse`, `supplier`, `date`, `user_id`, `pdf`, `hashed_id`) VALUES
(1, 0, 8, 'barcode_942967-1', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'barcode_942967', 'batch_25', 85.12, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b'),
(2, 0, 8, 'barcode_942967-2', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'barcode_942967', 'batch_25', 85.12, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35'),
(3, 0, 8, 'barcode_942967-3', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'barcode_942967', 'batch_25', 85.12, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce'),
(4, 0, 8, 'barcode_942967-4', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'barcode_942967', 'batch_25', 85.12, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a'),
(5, 0, 8, 'barcode_942967-5', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'barcode_942967', 'batch_25', 85.12, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d'),
(6, 0, 8, 'barcode_942967-6', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'barcode_942967', 'batch_25', 85.12, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683'),
(7, 0, 8, 'barcode_942967-7', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'barcode_942967', 'batch_25', 85.12, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451'),
(8, 0, 8, 'barcode_942967-8', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'barcode_942967', 'batch_25', 85.12, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '2c624232cdd221771294dfbb310aca000a0df6ac8b66b696d90ef06fdefb64a3'),
(9, 0, 8, 'barcode_747340-1', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'barcode_747340', 'batch_10', 28.05, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '19581e27de7ced00ff1ce50b2047e7a567c76b1cbaebabe5ef03f7c3017bb5b7'),
(10, 0, 8, 'barcode_747340-2', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'barcode_747340', 'batch_10', 28.05, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '4a44dc15364204a80fe80e9039455cc1608281820fe2b24f1e5233ade6af1dd5'),
(11, 0, 8, 'barcode_747340-3', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'barcode_747340', 'batch_10', 28.05, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8'),
(12, 0, 8, 'barcode_747340-4', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'barcode_747340', 'batch_10', 28.05, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '6b51d431df5d7f141cbececcf79edf3dd861c3b4069f0b11661a3eefacbba918'),
(13, 0, 8, 'barcode_747340-5', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'barcode_747340', 'batch_10', 28.05, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '3fdba35f04dc8c462986c992bcf875546257113072a909c162f7e470e581e278'),
(14, 0, 8, 'barcode_747340-6', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'barcode_747340', 'batch_10', 28.05, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61'),
(15, 0, 8, 'barcode_747340-7', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'barcode_747340', 'batch_10', 28.05, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'e629fa6598d732768f7c726b4b621285f9c3b85303900aa912017db7617d8bdb'),
(16, 0, 8, 'barcode_747340-8', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'barcode_747340', 'batch_10', 28.05, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'b17ef6d19c7a5b1ee83b907c595526dcb1eb06db8227d650d5dda0a9f4ce8cd9'),
(17, 0, 8, 'barcode_747340-9', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'barcode_747340', 'batch_10', 28.05, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '4523540f1504cd17100c4835e85b7eefd49911580f8efff0599a8f283be6b9e3'),
(18, 0, 8, 'barcode_747340-10', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'barcode_747340', 'batch_10', 28.05, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '4ec9599fc203d176a301536c2e091a19bc852759b255bd6818810a42c5fed14a'),
(19, 0, 8, 'barcode_747340-11', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'barcode_747340', 'batch_10', 28.05, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '9400f1b21cb527d7fa3d3eabba93557a18ebe7a2ca4e471cfe5e4c5b4ca7f767'),
(20, 0, 8, 'barcode_747340-12', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'barcode_747340', 'batch_10', 28.05, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'f5ca38f748a1d6eaf726b8a42fb575c3c71f1864a8143301782de13da2d9202b'),
(21, 0, 8, 'barcode_747340-13', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'barcode_747340', 'batch_10', 28.05, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '6f4b6612125fb3a0daecd2799dfd6c9c299424fd920f9b308110a2c1fbd8f443'),
(22, 0, 8, 'barcode_747340-14', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'barcode_747340', 'batch_10', 28.05, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '785f3ec7eb32f30b90cd0fcf3657d388b5ff4297f2f9716ff66e9b69c05ddd09'),
(23, 0, 8, 'barcode_747340-15', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'barcode_747340', 'batch_10', 28.05, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '535fa30d7e25dd8a49f1536779734ec8286108d115da5045d77f3b4185d8f790'),
(24, 0, 8, 'barcode_747340-16', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'barcode_747340', 'batch_10', 28.05, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'c2356069e9d1e79ca924378153cfbbfb4d4416b1f99d41a2940bfdb66c5319db'),
(25, 0, 8, 'barcode_747340-17', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'barcode_747340', 'batch_10', 28.05, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'b7a56873cd771f2c446d369b649430b65a756ba278ff97ec81bb6f55b2e73569'),
(26, 0, 8, 'barcode_747340-18', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'barcode_747340', 'batch_10', 28.05, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '5f9c4ab08cac7457e9111a30e4664920607ea2c115a1433d7be98e97e64244ca'),
(27, 0, 8, 'barcode_747340-19', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'barcode_747340', 'batch_10', 28.05, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '670671cd97404156226e507973f2ab8330d3022ca96e0c93bdbdb320c41adcaf'),
(28, 0, 8, 'barcode_747340-20', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'barcode_747340', 'batch_10', 28.05, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '59e19706d51d39f66711c2653cd7eb1291c94d9b55eb14bda74ce4dc636d015a'),
(29, 0, 8, 'barcode_221013-1', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', 'barcode_221013', 'batch_76', 16.86, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '35135aaa6cc23891b40cb3f378c53a17a1127210ce60e125ccf03efcfdaec458'),
(30, 0, 8, 'barcode_221013-2', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', 'barcode_221013', 'batch_76', 16.86, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '624b60c58c9d8bfb6ff1886c2fd605d2adeb6ea4da576068201b6c6958ce93f4'),
(31, 0, 8, 'barcode_221013-3', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', 'barcode_221013', 'batch_76', 16.86, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'eb1e33e8a81b697b75855af6bfcdbcbf7cbbde9f94962ceaec1ed8af21f5a50f'),
(32, 0, 8, 'barcode_221013-4', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', 'barcode_221013', 'batch_76', 16.86, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'e29c9c180c6279b0b02abd6a1801c7c04082cf486ec027aa13515e4f3884bb6b'),
(33, 0, 8, 'barcode_221013-5', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', 'barcode_221013', 'batch_76', 16.86, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'c6f3ac57944a531490cd39902d0f777715fd005efac9a30622d5f5205e7f6894'),
(34, 0, 8, 'barcode_221013-6', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', 'barcode_221013', 'batch_76', 16.86, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '86e50149658661312a9e0b35558d84f6c6d3da797f552a9657fe0558ca40cdef'),
(35, 0, 8, 'barcode_221013-7', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', 'barcode_221013', 'batch_76', 16.86, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '9f14025af0065b30e47e23ebb3b491d39ae8ed17d33739e5ff3827ffb3634953'),
(36, 0, 8, 'barcode_221013-8', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', 'barcode_221013', 'batch_76', 16.86, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '76a50887d8f1c2e9301755428990ad81479ee21c25b43215cf524541e0503269'),
(37, 0, 8, 'barcode_221013-9', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', 'barcode_221013', 'batch_76', 16.86, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '7a61b53701befdae0eeeffaecc73f14e20b537bb0f8b91ad7c2936dc63562b25'),
(38, 0, 8, 'barcode_221013-10', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', 'barcode_221013', 'batch_76', 16.86, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'aea92132c4cbeb263e6ac2bf6c183b5d81737f179f21efdc5863739672f0f470'),
(39, 0, 8, 'barcode_221013-11', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', 'barcode_221013', 'batch_76', 16.86, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '0b918943df0962bc7a1824c0555a389347b4febdc7cf9d1254406d80ce44e3f9'),
(40, 0, 8, 'barcode_221013-12', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', 'barcode_221013', 'batch_76', 16.86, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'd59eced1ded07f84c145592f65bdf854358e009c5cd705f5215bf18697fed103'),
(41, 0, 8, 'barcode_221013-13', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', 'barcode_221013', 'batch_76', 16.86, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '3d914f9348c9cc0ff8a79716700b9fcd4d2f3e711608004eb8f138bcba7f14d9'),
(42, 0, 8, 'barcode_221013-14', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', 'barcode_221013', 'batch_76', 16.86, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '73475cb40a568e8da8a045ced110137e159f890ac4da883b6b17dc651b3a8049'),
(43, 0, 8, 'barcode_221013-15', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', 'barcode_221013', 'batch_76', 16.86, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '44cb730c420480a0477b505ae68af508fb90f96cf0ec54c6ad16949dd427f13a'),
(44, 0, 8, 'barcode_221013-16', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', 'barcode_221013', 'batch_76', 16.86, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '71ee45a3c0db9a9865f7313dd3372cf60dca6479d46261f3542eb9346e4a04d6'),
(45, 0, 8, 'barcode_481294-1', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'barcode_481294', 'batch_28', 49.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '811786ad1ae74adfdd20dd0372abaaebc6246e343aebd01da0bfc4c02bf0106c'),
(46, 0, 8, 'barcode_481294-2', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'barcode_481294', 'batch_28', 49.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '25fc0e7096fc653718202dc30b0c580b8ab87eac11a700cba03a7c021bc35b0c'),
(47, 0, 8, 'barcode_481294-3', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'barcode_481294', 'batch_28', 49.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '31489056e0916d59fe3add79e63f095af3ffb81604691f21cad442a85c7be617'),
(48, 0, 8, 'barcode_481294-4', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'barcode_481294', 'batch_28', 49.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '98010bd9270f9b100b6214a21754fd33bdc8d41b2bc9f9dd16ff54d3c34ffd71'),
(49, 0, 8, 'barcode_481294-5', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'barcode_481294', 'batch_28', 49.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '0e17daca5f3e175f448bacace3bc0da47d0655a74c8dd0dc497a3afbdad95f1f'),
(50, 0, 8, 'barcode_481294-6', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'barcode_481294', 'batch_28', 49.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '1a6562590ef19d1045d06c4055742d38288e9e6dcd71ccde5cee80f1d5a774eb'),
(51, 0, 8, 'barcode_481294-7', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'barcode_481294', 'batch_28', 49.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '031b4af5197ec30a926f48cf40e11a7dbc470048a21e4003b7a3c07c5dab1baa'),
(52, 0, 8, 'barcode_481294-8', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'barcode_481294', 'batch_28', 49.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '41cfc0d1f2d127b04555b7246d84019b4d27710a3f3aff6e7764375b1e06e05d'),
(53, 0, 8, 'barcode_481294-9', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'barcode_481294', 'batch_28', 49.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '2858dcd1057d3eae7f7d5f782167e24b61153c01551450a628cee722509f6529'),
(54, 0, 8, 'barcode_481294-10', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'barcode_481294', 'batch_28', 49.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '2fca346db656187102ce806ac732e06a62df0dbb2829e511a770556d398e1a6e'),
(55, 0, 8, 'barcode_481294-11', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'barcode_481294', 'batch_28', 49.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '02d20bbd7e394ad5999a4cebabac9619732c343a4cac99470c03e23ba2bdc2bc'),
(56, 0, 8, 'barcode_481294-12', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'barcode_481294', 'batch_28', 49.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '7688b6ef52555962d008fff894223582c484517cea7da49ee67800adc7fc8866'),
(57, 0, 8, 'barcode_481294-13', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'barcode_481294', 'batch_28', 49.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'c837649cce43f2729138e72cc315207057ac82599a59be72765a477f22d14a54'),
(58, 0, 8, 'barcode_422572-1', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', 'barcode_422572', 'batch_79', 43.76, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '6208ef0f7750c111548cf90b6ea1d0d0a66f6bff40dbef07cb45ec436263c7d6'),
(59, 0, 8, 'barcode_422572-2', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', 'barcode_422572', 'batch_79', 43.76, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '3e1e967e9b793e908f8eae83c74dba9bcccce6a5535b4b462bd9994537bfe15c'),
(60, 0, 8, 'barcode_422572-3', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', 'barcode_422572', 'batch_79', 43.76, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '39fa9ec190eee7b6f4dff1100d6343e10918d044c75eac8f9e9a2596173f80c9'),
(61, 0, 8, 'barcode_422572-4', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', 'barcode_422572', 'batch_79', 43.76, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'd029fa3a95e174a19934857f535eb9427d967218a36ea014b70ad704bc6c8d1c'),
(62, 0, 8, 'barcode_422572-5', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', 'barcode_422572', 'batch_79', 43.76, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '81b8a03f97e8787c53fe1a86bda042b6f0de9b0ec9c09357e107c99ba4d6948a'),
(63, 0, 8, 'barcode_422572-6', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', 'barcode_422572', 'batch_79', 43.76, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'da4ea2a5506f2693eae190d9360a1f31793c98a1adade51d93533a6f520ace1c'),
(64, 0, 8, 'barcode_422572-7', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', 'barcode_422572', 'batch_79', 43.76, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'a68b412c4282555f15546cf6e1fc42893b7e07f271557ceb021821098dd66c1b'),
(65, 0, 8, 'barcode_422572-8', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', 'barcode_422572', 'batch_79', 43.76, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '108c995b953c8a35561103e2014cf828eb654a99e310f87fab94c2f4b7d2a04f'),
(66, 0, 8, 'barcode_422572-9', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', 'barcode_422572', 'batch_79', 43.76, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '3ada92f28b4ceda38562ebf047c6ff05400d4c572352a1142eedfef67d21e662'),
(67, 0, 8, 'barcode_422572-10', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', 'barcode_422572', 'batch_79', 43.76, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '49d180ecf56132819571bf39d9b7b342522a2ac6d23c1418d3338251bfe469c8'),
(68, 0, 8, 'barcode_422572-11', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', 'barcode_422572', 'batch_79', 43.76, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'a21855da08cb102d1d217c53dc5824a3a795c1c1a44e971bf01ab9da3a2acbbf'),
(69, 0, 8, 'barcode_422572-12', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', 'barcode_422572', 'batch_79', 43.76, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'c75cb66ae28d8ebc6eded002c28a8ba0d06d3a78c6b5cbf9b2ade051f0775ac4'),
(70, 0, 8, 'barcode_422572-13', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', 'barcode_422572', 'batch_79', 43.76, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'ff5a1ae012afa5d4c889c50ad427aaf545d31a4fac04ffc1c4d03d403ba4250a'),
(71, 0, 8, 'barcode_422572-14', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', 'barcode_422572', 'batch_79', 43.76, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '7f2253d7e228b22a08bda1f09c516f6fead81df6536eb02fa991a34bb38d9be8'),
(72, 0, 8, 'barcode_422572-15', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', 'barcode_422572', 'batch_79', 43.76, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '8722616204217eddb39e7df969e0698aed8e599ba62ed2de1ce49b03ade0fede'),
(73, 0, 8, 'barcode_422572-16', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', 'barcode_422572', 'batch_79', 43.76, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '96061e92f58e4bdcdee73df36183fe3ac64747c81c26f6c83aada8d2aabb1864'),
(74, 0, 8, 'barcode_129327-1', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683', 'barcode_129327', 'batch_88', 18.30, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'eb624dbe56eb6620ae62080c10a273cab73ae8eca98ab17b731446a31c79393a'),
(75, 0, 8, 'barcode_129327-2', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683', 'barcode_129327', 'batch_88', 18.30, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'f369cb89fc627e668987007d121ed1eacdc01db9e28f8bb26f358b7d8c4f08ac'),
(76, 0, 8, 'barcode_129327-3', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683', 'barcode_129327', 'batch_88', 18.30, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'f74efabef12ea619e30b79bddef89cffa9dda494761681ca862cff2871a85980'),
(77, 0, 8, 'barcode_129327-4', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683', 'barcode_129327', 'batch_88', 18.30, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'a88a7902cb4ef697ba0b6759c50e8c10297ff58f942243de19b984841bfe1f73'),
(78, 0, 8, 'barcode_129327-5', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683', 'barcode_129327', 'batch_88', 18.30, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '349c41201b62db851192665c504b350ff98c6b45fb62a8a2161f78b6534d8de9'),
(79, 0, 8, 'barcode_129327-6', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683', 'barcode_129327', 'batch_88', 18.30, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '98a3ab7c340e8a033e7b37b6ef9428751581760af67bbab2b9e05d4964a8874a'),
(80, 0, 8, 'barcode_129327-7', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683', 'barcode_129327', 'batch_88', 18.30, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '48449a14a4ff7d79bb7a1b6f3d488eba397c36ef25634c111b49baf362511afc'),
(81, 0, 8, 'barcode_129327-8', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683', 'barcode_129327', 'batch_88', 18.30, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '5316ca1c5ddca8e6ceccfce58f3b8540e540ee22f6180fb89492904051b3d531'),
(82, 0, 8, 'barcode_129327-9', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683', 'barcode_129327', 'batch_88', 18.30, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'a46e37632fa6ca51a13fe39a567b3c23b28c2f47d8af6be9bd63e030e214ba38'),
(83, 0, 8, 'barcode_129327-10', 'e7f6c011776e8db7cd330b54174fd76f7d0216b612387a5ffcfb81e6f0919683', 'barcode_129327', 'batch_88', 18.30, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'bbb965ab0c80d6538cf2184babad2a564a010376712012bd07b0af92dcd3097d'),
(84, 0, 8, 'barcode_879104-1', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451', 'barcode_879104', 'batch_42', 93.85, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '44c8031cb036a7350d8b9b8603af662a4b9cdbd2f96e8d5de5af435c9c35da69'),
(85, 0, 8, 'barcode_879104-2', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451', 'barcode_879104', 'batch_42', 93.85, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'b4944c6ff08dc6f43da2e9c824669b7d927dd1fa976fadc7b456881f51bf5ccc'),
(86, 0, 8, 'barcode_879104-3', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451', 'barcode_879104', 'batch_42', 93.85, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '434c9b5ae514646bbd91b50032ca579efec8f22bf0b4aac12e65997c418e0dd6'),
(87, 0, 8, 'barcode_879104-4', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451', 'barcode_879104', 'batch_42', 93.85, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'bdd2d3af3a5a1213497d4f1f7bfcda898274fe9cb5401bbc0190885664708fc2'),
(88, 0, 8, 'barcode_879104-5', '7902699be42c8a8e46fbbb4501726517e86b22c56a189f7625a6da49081b2451', 'barcode_879104', 'batch_42', 93.85, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '8b940be7fb78aaa6b6567dd7a3987996947460df1c668e698eb92ca77e425349'),
(89, 0, 8, 'barcode_618793-1', '2c624232cdd221771294dfbb310aca000a0df6ac8b66b696d90ef06fdefb64a3', 'barcode_618793', 'batch_27', 83.83, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'cd70bea023f752a0564abb6ed08d42c1440f2e33e29914e55e0be1595e24f45a'),
(90, 0, 8, 'barcode_618793-2', '2c624232cdd221771294dfbb310aca000a0df6ac8b66b696d90ef06fdefb64a3', 'barcode_618793', 'batch_27', 83.83, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '69f59c273b6e669ac32a6dd5e1b2cb63333d8b004f9696447aee2d422ce63763'),
(91, 0, 8, 'barcode_618793-3', '2c624232cdd221771294dfbb310aca000a0df6ac8b66b696d90ef06fdefb64a3', 'barcode_618793', 'batch_27', 83.83, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '1da51b8d8ff98f6a48f80ae79fe3ca6c26e1abb7b7d125259255d6d2b875ea08'),
(92, 0, 8, 'barcode_618793-4', '2c624232cdd221771294dfbb310aca000a0df6ac8b66b696d90ef06fdefb64a3', 'barcode_618793', 'batch_27', 83.83, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '8241649609f88ccd2a0a5b233a07a538ec313ff6adf695aa44a969dbca39f67d'),
(93, 0, 8, 'barcode_257009-1', '19581e27de7ced00ff1ce50b2047e7a567c76b1cbaebabe5ef03f7c3017bb5b7', 'barcode_257009', 'batch_67', 41.51, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '6e4001871c0cf27c7634ef1dc478408f642410fd3a444e2a88e301f5c4a35a4d'),
(94, 0, 8, 'barcode_257009-2', '19581e27de7ced00ff1ce50b2047e7a567c76b1cbaebabe5ef03f7c3017bb5b7', 'barcode_257009', 'batch_67', 41.51, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'e3d6c4d4599e00882384ca981ee287ed961fa5f3828e2adb5e9ea890ab0d0525'),
(95, 0, 8, 'barcode_257009-3', '19581e27de7ced00ff1ce50b2047e7a567c76b1cbaebabe5ef03f7c3017bb5b7', 'barcode_257009', 'batch_67', 41.51, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'ad48ff99415b2f007dc35b7eb553fd1eb35ebfa2f2f308acd9488eeb86f71fa8'),
(96, 0, 8, 'barcode_257009-4', '19581e27de7ced00ff1ce50b2047e7a567c76b1cbaebabe5ef03f7c3017bb5b7', 'barcode_257009', 'batch_67', 41.51, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '7b1a278f5abe8e9da907fc9c29dfd432d60dc76e17b0fabab659d2a508bc65c4'),
(97, 0, 8, 'barcode_257009-5', '19581e27de7ced00ff1ce50b2047e7a567c76b1cbaebabe5ef03f7c3017bb5b7', 'barcode_257009', 'batch_67', 41.51, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'd6d824abba4afde81129c71dea75b8100e96338da5f416d2f69088f1960cb091'),
(98, 0, 8, 'barcode_257009-6', '19581e27de7ced00ff1ce50b2047e7a567c76b1cbaebabe5ef03f7c3017bb5b7', 'barcode_257009', 'batch_67', 41.51, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '29db0c6782dbd5000559ef4d9e953e300e2b479eed26d887ef3f92b921c06a67'),
(99, 0, 8, 'barcode_257009-7', '19581e27de7ced00ff1ce50b2047e7a567c76b1cbaebabe5ef03f7c3017bb5b7', 'barcode_257009', 'batch_67', 41.51, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '8c1f1046219ddd216a023f792356ddf127fce372a72ec9b4cdac989ee5b0b455'),
(100, 0, 8, 'barcode_257009-8', '19581e27de7ced00ff1ce50b2047e7a567c76b1cbaebabe5ef03f7c3017bb5b7', 'barcode_257009', 'batch_67', 41.51, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'ad57366865126e55649ecb23ae1d48887544976efea46a48eb5d85a6eeb4d306'),
(101, 0, 8, 'barcode_257009-9', '19581e27de7ced00ff1ce50b2047e7a567c76b1cbaebabe5ef03f7c3017bb5b7', 'barcode_257009', 'batch_67', 41.51, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '16dc368a89b428b2485484313ba67a3912ca03f2b2b42429174a4f8b3dc84e44'),
(102, 0, 8, 'barcode_508603-1', '4a44dc15364204a80fe80e9039455cc1608281820fe2b24f1e5233ade6af1dd5', 'barcode_508603', 'batch_6', 46.39, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '37834f2f25762f23e1f74a531cbe445db73d6765ebe60878a7dfbecd7d4af6e1'),
(103, 0, 8, 'barcode_508603-2', '4a44dc15364204a80fe80e9039455cc1608281820fe2b24f1e5233ade6af1dd5', 'barcode_508603', 'batch_6', 46.39, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '454f63ac30c8322997ef025edff6abd23e0dbe7b8a3d5126a894e4a168c1b59b'),
(104, 0, 8, 'barcode_508603-3', '4a44dc15364204a80fe80e9039455cc1608281820fe2b24f1e5233ade6af1dd5', 'barcode_508603', 'batch_6', 46.39, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '5ef6fdf32513aa7cd11f72beccf132b9224d33f271471fff402742887a171edf'),
(105, 0, 8, 'barcode_508603-4', '4a44dc15364204a80fe80e9039455cc1608281820fe2b24f1e5233ade6af1dd5', 'barcode_508603', 'batch_6', 46.39, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '1253e9373e781b7500266caa55150e08e210bc8cd8cc70d89985e3600155e860'),
(106, 0, 8, 'barcode_508603-5', '4a44dc15364204a80fe80e9039455cc1608281820fe2b24f1e5233ade6af1dd5', 'barcode_508603', 'batch_6', 46.39, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '482d9673cfee5de391f97fde4d1c84f9f8d6f2cf0784fcffb958b4032de7236c'),
(107, 0, 8, 'barcode_508603-6', '4a44dc15364204a80fe80e9039455cc1608281820fe2b24f1e5233ade6af1dd5', 'barcode_508603', 'batch_6', 46.39, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '3346f2bbf6c34bd2dbe28bd1bb657d0e9c37392a1d5ec9929e6a5df4763ddc2d'),
(108, 0, 8, 'barcode_508603-7', '4a44dc15364204a80fe80e9039455cc1608281820fe2b24f1e5233ade6af1dd5', 'barcode_508603', 'batch_6', 46.39, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '9537f32ec7599e1ae953af6c9f929fe747ff9dadf79a9beff1f304c550173011'),
(109, 0, 8, 'barcode_885305-1', '4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8', 'barcode_885305', 'batch_25', 74.29, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '0fd42b3f73c448b34940b339f87d07adf116b05c0227aad72e8f0ee90533e699'),
(110, 0, 8, 'barcode_885305-2', '4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8', 'barcode_885305', 'batch_25', 74.29, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '9bdb2af6799204a299c603994b8e400e4b1fd625efdb74066cc869fee42c9df3'),
(111, 0, 8, 'barcode_885305-3', '4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8', 'barcode_885305', 'batch_25', 74.29, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'f6e0a1e2ac41945a9aa7ff8a8aaa0cebc12a3bcc981a929ad5cf810a090e11ae'),
(112, 0, 8, 'barcode_885305-4', '4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8', 'barcode_885305', 'batch_25', 74.29, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'b1556dea32e9d0cdbfed038fd7787275775ea40939c146a64e205bcb349ad02f'),
(113, 0, 8, 'barcode_885305-5', '4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8', 'barcode_885305', 'batch_25', 74.29, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '6c658ee83fb7e812482494f3e416a876f63f418a0b8a1f5e76d47ee4177035cb');
INSERT INTO `stocks` (`id`, `item_status`, `inbound_id`, `unique_barcode`, `product_id`, `parent_barcode`, `batch_code`, `capital`, `price`, `warehouse`, `supplier`, `date`, `user_id`, `pdf`, `hashed_id`) VALUES
(114, 0, 8, 'barcode_885305-6', '4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8', 'barcode_885305', 'batch_25', 74.29, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '9f1f9dce319c4700ef28ec8c53bd3cc8e6abe64c68385479ab89215806a5bdd6'),
(115, 0, 8, 'barcode_885305-7', '4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8', 'barcode_885305', 'batch_25', 74.29, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '28dae7c8bde2f3ca608f86d0e16a214dee74c74bee011cdfdd46bc04b655bc14'),
(116, 0, 8, 'barcode_885305-8', '4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8', 'barcode_885305', 'batch_25', 74.29, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'e5b861a6d8a966dfca7e7341cd3eb6be9901688d547a72ebed0b1f5e14f3d08d'),
(117, 0, 8, 'barcode_885305-9', '4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8', 'barcode_885305', 'batch_25', 74.29, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '2ac878b0e2180616993b4b6aa71e61166fdc86c28d47e359d0ee537eb11d46d3'),
(118, 0, 8, 'barcode_885305-10', '4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8', 'barcode_885305', 'batch_25', 74.29, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '85daaf6f7055cd5736287faed9603d712920092c4f8fd0097ec3b650bf27530e'),
(119, 0, 8, 'barcode_885305-11', '4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8', 'barcode_885305', 'batch_25', 74.29, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '3038bfb575bee6a0e61945eff8784835bb2c720634e42734678c083994b7f018'),
(120, 0, 8, 'barcode_885305-12', '4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8', 'barcode_885305', 'batch_25', 74.29, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '2abaca4911e68fa9bfbf3482ee797fd5b9045b841fdff7253557c5fe15de6477'),
(121, 0, 8, 'barcode_885305-13', '4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8', 'barcode_885305', 'batch_25', 74.29, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '89aa1e580023722db67646e8149eb246c748e180e34a1cf679ab0b41a416d904'),
(122, 0, 8, 'barcode_885305-14', '4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8', 'barcode_885305', 'batch_25', 74.29, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '1be00341082e25c4e251ca6713e767f7131a2823b0052caf9c9b006ec512f6cb'),
(123, 0, 8, 'barcode_885305-15', '4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8', 'barcode_885305', 'batch_25', 74.29, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
(124, 0, 8, 'barcode_885305-16', '4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8', 'barcode_885305', 'batch_25', 74.29, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '6affdae3b3c1aa6aa7689e9b6a7b3225a636aa1ac0025f490cca1285ceaf1487'),
(125, 0, 8, 'barcode_885305-17', '4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8', 'barcode_885305', 'batch_25', 74.29, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '0f8ef3377b30fc47f96b48247f463a726a802f62f3faa03d56403751d2f66c67'),
(126, 0, 8, 'barcode_885305-18', '4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8', 'barcode_885305', 'batch_25', 74.29, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '65a699905c02619370bcf9207f5a477c3d67130ca71ec6f750e07fe8d510b084'),
(127, 0, 8, 'barcode_885305-19', '4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8', 'barcode_885305', 'batch_25', 74.29, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '922c7954216ccfe7a61def609305ce1dc7c67e225f873f256d30d7a8ee4f404c'),
(128, 0, 8, 'barcode_885305-20', '4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8', 'barcode_885305', 'batch_25', 74.29, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '2747b7c718564ba5f066f0523b03e17f6a496b06851333d2d59ab6d863225848'),
(129, 0, 8, 'barcode_617101-1', '6b51d431df5d7f141cbececcf79edf3dd861c3b4069f0b11661a3eefacbba918', 'barcode_617101', 'batch_99', 26.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '6566230e3a3ce3774c1bbc7c18b590ae0f457bbcd511e90e3e7dca2a02e7addc'),
(130, 0, 8, 'barcode_617101-2', '6b51d431df5d7f141cbececcf79edf3dd861c3b4069f0b11661a3eefacbba918', 'barcode_617101', 'batch_99', 26.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '38d66d9692ac590000a91b03a88da1c88d51fab2b78f63171f553ecc551a0c6f'),
(131, 0, 8, 'barcode_617101-3', '6b51d431df5d7f141cbececcf79edf3dd861c3b4069f0b11661a3eefacbba918', 'barcode_617101', 'batch_99', 26.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'eeca91fd439b6d5e827e8fda7fee35046f2def93508637483f6be8a2df7a4392'),
(132, 0, 8, 'barcode_617101-4', '6b51d431df5d7f141cbececcf79edf3dd861c3b4069f0b11661a3eefacbba918', 'barcode_617101', 'batch_99', 26.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'dbb1ded63bc70732626c5dfe6c7f50ced3d560e970f30b15335ac290358748f6'),
(133, 0, 8, 'barcode_617101-5', '6b51d431df5d7f141cbececcf79edf3dd861c3b4069f0b11661a3eefacbba918', 'barcode_617101', 'batch_99', 26.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'd2f483672c0239f6d7dd3c9ecee6deacbcd59185855625902a8b1c1a3bd67440'),
(134, 0, 8, 'barcode_617101-6', '6b51d431df5d7f141cbececcf79edf3dd861c3b4069f0b11661a3eefacbba918', 'barcode_617101', 'batch_99', 26.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '5d389f5e2e34c6b0bad96581c22cee0be36dcf627cd73af4d4cccacd9ef40cc3'),
(135, 0, 8, 'barcode_617101-7', '6b51d431df5d7f141cbececcf79edf3dd861c3b4069f0b11661a3eefacbba918', 'barcode_617101', 'batch_99', 26.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '13671077b66a29874a2578b5240319092ef2a1043228e433e9b006b5e53e7513'),
(136, 0, 8, 'barcode_617101-8', '6b51d431df5d7f141cbececcf79edf3dd861c3b4069f0b11661a3eefacbba918', 'barcode_617101', 'batch_99', 26.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '36ebe205bcdfc499a25e6923f4450fa8d48196ceb4fa0ce077d9d8ec4a36926d'),
(137, 0, 8, 'barcode_617101-9', '6b51d431df5d7f141cbececcf79edf3dd861c3b4069f0b11661a3eefacbba918', 'barcode_617101', 'batch_99', 26.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'd80eae6e96d148b3b2abbbc6760077b66c4ea071f847dab573d507a32c4d99a5'),
(138, 0, 8, 'barcode_617101-10', '6b51d431df5d7f141cbececcf79edf3dd861c3b4069f0b11661a3eefacbba918', 'barcode_617101', 'batch_99', 26.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'd6a4031733610bb080d0bfa794fcc9dbdcff74834aeaab7c6b927e21e9754037'),
(139, 0, 8, 'barcode_617101-11', '6b51d431df5d7f141cbececcf79edf3dd861c3b4069f0b11661a3eefacbba918', 'barcode_617101', 'batch_99', 26.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '8d27ba37c5d810106b55f3fd6cdb35842007e88754184bfc0e6035f9bcede633'),
(140, 0, 8, 'barcode_675974-1', '3fdba35f04dc8c462986c992bcf875546257113072a909c162f7e470e581e278', 'barcode_675974', 'batch_30', 82.13, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'dbae772db29058a88f9bd830e957c695347c41b6162a7eb9a9ea13def34be56b'),
(141, 0, 8, 'barcode_675974-2', '3fdba35f04dc8c462986c992bcf875546257113072a909c162f7e470e581e278', 'barcode_675974', 'batch_30', 82.13, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '2c7d5490e6050836f8f2f0d496b1c8d6a38d4ffac2b898e6e77751bdcd20ebf5'),
(142, 0, 8, 'barcode_675974-3', '3fdba35f04dc8c462986c992bcf875546257113072a909c162f7e470e581e278', 'barcode_675974', 'batch_30', 82.13, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'd4ee9f58e5860574ca98e3b4839391e7a356328d4bd6afecefc2381df5f5b41b'),
(143, 0, 8, 'barcode_675974-4', '3fdba35f04dc8c462986c992bcf875546257113072a909c162f7e470e581e278', 'barcode_675974', 'batch_30', 82.13, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'd6f0c71ef0c88e45e4b3a2118fcb83b0def392d759c901e9d755d0e879028727'),
(144, 0, 8, 'barcode_675974-5', '3fdba35f04dc8c462986c992bcf875546257113072a909c162f7e470e581e278', 'barcode_675974', 'batch_30', 82.13, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '5ec1a0c99d428601ce42b407ae9c675e0836a8ba591c8ca6e2a2cf5563d97ff0'),
(145, 0, 8, 'barcode_170002-1', '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61', 'barcode_170002', 'batch_92', 50.43, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'be47addbcb8f60566a3d7fd5a36f8195798e2848b368195d9a5d20e007c59a0c'),
(146, 0, 8, 'barcode_170002-2', '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61', 'barcode_170002', 'batch_92', 50.43, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '0a5b046d07f6f971b7776de682f57c5b9cdc8fa060db7ef59de82e721c8098f4'),
(147, 0, 8, 'barcode_170002-3', '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61', 'barcode_170002', 'batch_92', 50.43, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '1d28c120568c10e19b9d8abe8b66d0983fa3d2e11ee7751aca50f83c6f4a43aa'),
(148, 0, 8, 'barcode_170002-4', '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61', 'barcode_170002', 'batch_92', 50.43, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'ec2e990b934dde55cb87300629cedfc21b15cd28bbcf77d8bbdc55359d7689da'),
(149, 0, 8, 'barcode_170002-5', '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61', 'barcode_170002', 'batch_92', 50.43, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '05ada863a4cf9660fd8c68e2295f1d35b2264815f5b605003d6625bd9e0492cf'),
(150, 0, 8, 'barcode_170002-6', '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61', 'barcode_170002', 'batch_92', 50.43, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '9ae2bdd7beedc2e766c6b76585530e16925115707dc7a06ab5ee4aa2776b2c7b'),
(151, 0, 8, 'barcode_170002-7', '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61', 'barcode_170002', 'batch_92', 50.43, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '8e612bd1f5d132a339575b8dafb7842c64614e56bcf3d5ab65a0bc4b34329407'),
(152, 0, 8, 'barcode_170002-8', '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61', 'barcode_170002', 'batch_92', 50.43, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '043066daf2109523a7490d4bfad4766da5719950a2b5f96d192fc0537e84f32a'),
(153, 0, 8, 'barcode_170002-9', '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61', 'barcode_170002', 'batch_92', 50.43, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '620c9c332101a5bae955c66ae72268fbcd3972766179522c8deede6a249addb7'),
(154, 0, 8, 'barcode_170002-10', '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61', 'barcode_170002', 'batch_92', 50.43, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '1d0ebea552eb43d0b1e1561f6de8ae92e3de7f1abec52399244d1caed7dbdfa6'),
(155, 0, 8, 'barcode_170002-11', '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61', 'barcode_170002', 'batch_92', 50.43, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '210e3b160c355818509425b9d9e9fd3ea2e287f2c43a13e5be8817140db0b9e6'),
(156, 0, 8, 'barcode_170002-12', '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61', 'barcode_170002', 'batch_92', 50.43, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '0fecf9247f3ddc84db8a804fa3065c013baf6b7c2458c2ba2bf56c2e1d42ddd4'),
(157, 0, 8, 'barcode_170002-13', '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61', 'barcode_170002', 'batch_92', 50.43, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'c75de23d89df36ba921287616ee8edb4c986e328a78e033e57c1e5e2b59c838e'),
(158, 0, 8, 'barcode_170002-14', '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61', 'barcode_170002', 'batch_92', 50.43, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '7ed8f0f3b707956d9fb1e889e11153e0aa0a854983081d262fbe5eede32da7ca'),
(159, 0, 8, 'barcode_170002-15', '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61', 'barcode_170002', 'batch_92', 50.43, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'ff2ccb6ba423d356bd549ed4bfb76e96976a0dcde05a09996a1cdb9f83422ec4'),
(160, 0, 8, 'barcode_170002-16', '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61', 'barcode_170002', 'batch_92', 50.43, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'a512db2741cd20693e4b16f19891e72b9ff12cead72761fc5e92d2aaf34740c1'),
(161, 0, 8, 'barcode_170002-17', '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61', 'barcode_170002', 'batch_92', 50.43, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'bb668ca95563216088b98a62557fa1e26802563f3919ac78ae30533bb9ed422c'),
(162, 0, 8, 'barcode_170002-18', '8527a891e224136950ff32ca212b45bc93f69fbb801c3b1ebedac52775f99e61', 'barcode_170002', 'batch_92', 50.43, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '79d6eaa2676189eb927f2e16a70091474078e2117c3fc607d35cdc6b591ef355'),
(163, 0, 8, 'barcode_719616-1', 'e629fa6598d732768f7c726b4b621285f9c3b85303900aa912017db7617d8bdb', 'barcode_719616', 'batch_94', 73.51, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '3d3286f7cd19074f04e514b0c6c237e757513fb32820698b790e1dec801d947a'),
(164, 0, 8, 'barcode_719616-2', 'e629fa6598d732768f7c726b4b621285f9c3b85303900aa912017db7617d8bdb', 'barcode_719616', 'batch_94', 73.51, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '3f9807cb9ae9fb6c30942af6139909d27753a5e03fe5a5c6e93b014f5b17366f'),
(165, 0, 8, 'barcode_719616-3', 'e629fa6598d732768f7c726b4b621285f9c3b85303900aa912017db7617d8bdb', 'barcode_719616', 'batch_94', 73.51, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'bc52dd634277c4a34a2d6210994a9a5e2ab6d33bb4a3a8963410e00ca6c15a02'),
(166, 0, 8, 'barcode_719616-4', 'e629fa6598d732768f7c726b4b621285f9c3b85303900aa912017db7617d8bdb', 'barcode_719616', 'batch_94', 73.51, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'e0f05da93a0f5a86a3be5fc0e301606513c9f7e59dac2357348aa0f2f47db984'),
(167, 0, 8, 'barcode_490780-1', 'b17ef6d19c7a5b1ee83b907c595526dcb1eb06db8227d650d5dda0a9f4ce8cd9', 'barcode_490780', 'batch_32', 49.07, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '73d3f1ba062585bce51f77d70a26be88c44b55d70f81b8bd7e2ded030ca4454a'),
(168, 0, 8, 'barcode_490780-2', 'b17ef6d19c7a5b1ee83b907c595526dcb1eb06db8227d650d5dda0a9f4ce8cd9', 'barcode_490780', 'batch_32', 49.07, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '80c3cd40fa35f9088b8741bd8be6153de05f661cfeeb4625ffbf5f4a6c3c02c4'),
(169, 0, 8, 'barcode_490780-3', 'b17ef6d19c7a5b1ee83b907c595526dcb1eb06db8227d650d5dda0a9f4ce8cd9', 'barcode_490780', 'batch_32', 49.07, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'f57e5cb1f4532c008183057ecc94283801fcb5afe2d1c190e3dfd38c4da08042'),
(170, 0, 8, 'barcode_490780-4', 'b17ef6d19c7a5b1ee83b907c595526dcb1eb06db8227d650d5dda0a9f4ce8cd9', 'barcode_490780', 'batch_32', 49.07, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '734d0759cdb4e0d0a35e4fd73749aee287e4fdcc8648b71a8d6ed591b7d4cb3f'),
(171, 0, 8, 'barcode_490780-5', 'b17ef6d19c7a5b1ee83b907c595526dcb1eb06db8227d650d5dda0a9f4ce8cd9', 'barcode_490780', 'batch_32', 49.07, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '284de502c9847342318c17d474733ef468fbdbe252cddf6e4b4be0676706d9d0'),
(172, 0, 8, 'barcode_490780-6', 'b17ef6d19c7a5b1ee83b907c595526dcb1eb06db8227d650d5dda0a9f4ce8cd9', 'barcode_490780', 'batch_32', 49.07, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '68519a9eca55c68c72658a2a1716aac3788c289859d46d6f5c3f14760fa37c9e'),
(173, 0, 8, 'barcode_490780-7', 'b17ef6d19c7a5b1ee83b907c595526dcb1eb06db8227d650d5dda0a9f4ce8cd9', 'barcode_490780', 'batch_32', 49.07, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '4a8596a7790b5ca9e067da401c018b3206befbcf95c38121854d1a0158e7678a'),
(174, 0, 8, 'barcode_490780-8', 'b17ef6d19c7a5b1ee83b907c595526dcb1eb06db8227d650d5dda0a9f4ce8cd9', 'barcode_490780', 'batch_32', 49.07, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '41e521adf8ae7a0f419ee06e1d9fb794162369237b46f64bf5b2b9969b0bcd2e'),
(175, 0, 8, 'barcode_490780-9', 'b17ef6d19c7a5b1ee83b907c595526dcb1eb06db8227d650d5dda0a9f4ce8cd9', 'barcode_490780', 'batch_32', 49.07, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'dac53c17c250fd4d4d81eaf6d88435676dac1f3f3896441e277af839bf50ed8a'),
(176, 0, 8, 'barcode_490780-10', 'b17ef6d19c7a5b1ee83b907c595526dcb1eb06db8227d650d5dda0a9f4ce8cd9', 'barcode_490780', 'batch_32', 49.07, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'cba28b89eb859497f544956d64cf2ecf29b76fe2ef7175b33ea59e64293a4461'),
(177, 0, 8, 'barcode_490780-11', 'b17ef6d19c7a5b1ee83b907c595526dcb1eb06db8227d650d5dda0a9f4ce8cd9', 'barcode_490780', 'batch_32', 49.07, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '8cd2510271575d8430c05368315a87b9c4784c7389a47496080c1e615a2a00b6'),
(178, 0, 8, 'barcode_490780-12', 'b17ef6d19c7a5b1ee83b907c595526dcb1eb06db8227d650d5dda0a9f4ce8cd9', 'barcode_490780', 'batch_32', 49.07, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '01d54579da446ae1e75cda808cd188438834fa6249b151269db0f9123c9ddc61'),
(179, 0, 8, 'barcode_485511-1', '4523540f1504cd17100c4835e85b7eefd49911580f8efff0599a8f283be6b9e3', 'barcode_485511', 'batch_93', 13.83, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '3068430da9e4b7a674184035643d9e19af3dc7483e31cc03b35f75268401df77'),
(180, 0, 8, 'barcode_271165-1', '4ec9599fc203d176a301536c2e091a19bc852759b255bd6818810a42c5fed14a', 'barcode_271165', 'batch_54', 84.71, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '7b69759630f869f2723875f873935fed29d2d12b10ef763c1c33b8e0004cb405'),
(181, 0, 8, 'barcode_271165-2', '4ec9599fc203d176a301536c2e091a19bc852759b255bd6818810a42c5fed14a', 'barcode_271165', 'batch_54', 84.71, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '580811fa95269f3ecd4f22d176e079d36093573680b6ef66fa341e687a15b5da'),
(182, 0, 8, 'barcode_271165-3', '4ec9599fc203d176a301536c2e091a19bc852759b255bd6818810a42c5fed14a', 'barcode_271165', 'batch_54', 84.71, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'bfa7634640c53da7cb5e9c39031128c4e583399f936896f27f999f1d58d7b37e'),
(183, 0, 8, 'barcode_271165-4', '4ec9599fc203d176a301536c2e091a19bc852759b255bd6818810a42c5fed14a', 'barcode_271165', 'batch_54', 84.71, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'b8aed072d29403ece56ae9641638ddd50d420f950bde0eefc092ee8879554141'),
(184, 0, 8, 'barcode_271165-5', '4ec9599fc203d176a301536c2e091a19bc852759b255bd6818810a42c5fed14a', 'barcode_271165', 'batch_54', 84.71, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '52f11620e397f867b7d9f19e48caeb64658356a6b5d17138c00dd9feaf5d7ad6'),
(185, 0, 8, 'barcode_441045-1', '9400f1b21cb527d7fa3d3eabba93557a18ebe7a2ca4e471cfe5e4c5b4ca7f767', 'barcode_441045', 'batch_65', 38.80, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '61a229bae1e90331edd986b6bbbe617f7035de88a5bf7c018c3add6c762a6e8d'),
(186, 0, 8, 'barcode_441045-2', '9400f1b21cb527d7fa3d3eabba93557a18ebe7a2ca4e471cfe5e4c5b4ca7f767', 'barcode_441045', 'batch_65', 38.80, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '2811745d7b8d8874f6e653d176cefdd19e05e920ce389b9b7e83e5b2dfa546c7'),
(187, 0, 8, 'barcode_441045-3', '9400f1b21cb527d7fa3d3eabba93557a18ebe7a2ca4e471cfe5e4c5b4ca7f767', 'barcode_441045', 'batch_65', 38.80, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '38b2d03f3256502b1e9db02b2d12aa27a46033ffe6d8c0ef0f2cf6b1530be9d8'),
(188, 0, 8, 'barcode_441045-4', '9400f1b21cb527d7fa3d3eabba93557a18ebe7a2ca4e471cfe5e4c5b4ca7f767', 'barcode_441045', 'batch_65', 38.80, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'd6061bbee6cf13bd73765faaea7cdd0af1323e4b125342ac346047f7c4bda1fc'),
(189, 0, 8, 'barcode_441045-5', '9400f1b21cb527d7fa3d3eabba93557a18ebe7a2ca4e471cfe5e4c5b4ca7f767', 'barcode_441045', 'batch_65', 38.80, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '7045d16ae7f043ec25774a0a85d6f479e5bb019e9c5a1584bc76736d116b8f33'),
(190, 0, 8, 'barcode_441045-6', '9400f1b21cb527d7fa3d3eabba93557a18ebe7a2ca4e471cfe5e4c5b4ca7f767', 'barcode_441045', 'batch_65', 38.80, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '2397346b45823e070f6fc72ac94c0a999d234c472479f0e26b30cdf5942db854'),
(191, 0, 8, 'barcode_441045-7', '9400f1b21cb527d7fa3d3eabba93557a18ebe7a2ca4e471cfe5e4c5b4ca7f767', 'barcode_441045', 'batch_65', 38.80, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '70260742c2952154c84e2ea9f68b1a7397f49b6d343da1ed284093c0bd72c742'),
(192, 0, 8, 'barcode_441045-8', '9400f1b21cb527d7fa3d3eabba93557a18ebe7a2ca4e471cfe5e4c5b4ca7f767', 'barcode_441045', 'batch_65', 38.80, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'eb3be230bbd2844b1f5d8f2e4fab9ffba8ab22cfeeb69c4c1361993ba4f377b9'),
(193, 0, 8, 'barcode_441045-9', '9400f1b21cb527d7fa3d3eabba93557a18ebe7a2ca4e471cfe5e4c5b4ca7f767', 'barcode_441045', 'batch_65', 38.80, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '684fe39f03758de6a882ae61fa62312b67e5b1e665928cbf3dc3d8f4f53e3562'),
(194, 0, 8, 'barcode_441045-10', '9400f1b21cb527d7fa3d3eabba93557a18ebe7a2ca4e471cfe5e4c5b4ca7f767', 'barcode_441045', 'batch_65', 38.80, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '7559ca4a957c8c82ba04781cd66a68d6022229fca0e8e88d8e487c96ee4446d0'),
(195, 0, 8, 'barcode_441045-11', '9400f1b21cb527d7fa3d3eabba93557a18ebe7a2ca4e471cfe5e4c5b4ca7f767', 'barcode_441045', 'batch_65', 38.80, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '1dfacb2ea5a03e0a915999e03b5a56196f1b1664d2f768d1b7eff60ac059789d'),
(196, 0, 8, 'barcode_441045-12', '9400f1b21cb527d7fa3d3eabba93557a18ebe7a2ca4e471cfe5e4c5b4ca7f767', 'barcode_441045', 'batch_65', 38.80, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'b4bbe448fde336bb6a7d7d765f36d3327c772b845e7b54c8282aa08c9775ddd7'),
(197, 0, 8, 'barcode_441045-13', '9400f1b21cb527d7fa3d3eabba93557a18ebe7a2ca4e471cfe5e4c5b4ca7f767', 'barcode_441045', 'batch_65', 38.80, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '8bcbb4c131df56f7c79066016241cc4bdf4e58db55c4f674e88b22365bd2e2ad'),
(198, 0, 8, 'barcode_441045-14', '9400f1b21cb527d7fa3d3eabba93557a18ebe7a2ca4e471cfe5e4c5b4ca7f767', 'barcode_441045', 'batch_65', 38.80, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'a4e00d7e6aa82111575438c5e5d3e63269d4c475c718b2389f6d02932c47f8a6'),
(199, 0, 8, 'barcode_441045-15', '9400f1b21cb527d7fa3d3eabba93557a18ebe7a2ca4e471cfe5e4c5b4ca7f767', 'barcode_441045', 'batch_65', 38.80, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '5a39cadd1b007093db50744797c7a04a34f73b35ed444704206705b02597d6fd'),
(200, 0, 8, 'barcode_441045-16', '9400f1b21cb527d7fa3d3eabba93557a18ebe7a2ca4e471cfe5e4c5b4ca7f767', 'barcode_441045', 'batch_65', 38.80, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '27badc983df1780b60c2b3fa9d3a19a00e46aac798451f0febdca52920faaddf'),
(201, 0, 8, 'barcode_441045-17', '9400f1b21cb527d7fa3d3eabba93557a18ebe7a2ca4e471cfe5e4c5b4ca7f767', 'barcode_441045', 'batch_65', 38.80, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '43974ed74066b207c30ffd0fed5146762e6c60745ac977004bc14507c7c42b50'),
(202, 0, 8, 'barcode_441045-18', '9400f1b21cb527d7fa3d3eabba93557a18ebe7a2ca4e471cfe5e4c5b4ca7f767', 'barcode_441045', 'batch_65', 38.80, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'c17edaae86e4016a583e098582f6dbf3eccade8ef83747df9ba617ded9d31309'),
(203, 0, 8, 'barcode_441045-19', '9400f1b21cb527d7fa3d3eabba93557a18ebe7a2ca4e471cfe5e4c5b4ca7f767', 'barcode_441045', 'batch_65', 38.80, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '4621c1d55fa4e86ce0dae4288302641baac86dd53f76227c892df9d300682d41'),
(204, 0, 8, 'barcode_441045-20', '9400f1b21cb527d7fa3d3eabba93557a18ebe7a2ca4e471cfe5e4c5b4ca7f767', 'barcode_441045', 'batch_65', 38.80, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'fc56dbc6d4652b315b86b71c8d688c1ccdea9c5f1fd07763d2659fde2e2fc49a'),
(205, 0, 8, 'barcode_689411-1', 'f5ca38f748a1d6eaf726b8a42fb575c3c71f1864a8143301782de13da2d9202b', 'barcode_689411', 'batch_22', 17.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'f8809aff4d69bece79dabe35be0c708b890d7eafb841f121330667b77d2e2590'),
(206, 0, 8, 'barcode_689411-2', 'f5ca38f748a1d6eaf726b8a42fb575c3c71f1864a8143301782de13da2d9202b', 'barcode_689411', 'batch_22', 17.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '5cf4e26bd3d87da5e03f80a43a64f1220a1f4ba9e1d6348caea83c06353c3f39'),
(207, 0, 8, 'barcode_689411-3', 'f5ca38f748a1d6eaf726b8a42fb575c3c71f1864a8143301782de13da2d9202b', 'barcode_689411', 'batch_22', 17.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '968076be2e38cf897d4d6cea3faca9c037e1a4e3b4b7744fb2533e07751bd30a'),
(208, 0, 8, 'barcode_689411-4', 'f5ca38f748a1d6eaf726b8a42fb575c3c71f1864a8143301782de13da2d9202b', 'barcode_689411', 'batch_22', 17.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '8df66f64b57424391d363fd6b811fed3c430c77597da265025728bd637bad804'),
(209, 0, 8, 'barcode_689411-5', 'f5ca38f748a1d6eaf726b8a42fb575c3c71f1864a8143301782de13da2d9202b', 'barcode_689411', 'batch_22', 17.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '83f814f7a92e365cbd79f9addceed185761a8d38a06a2d4350bb1fe4b7632b34'),
(210, 0, 8, 'barcode_689411-6', 'f5ca38f748a1d6eaf726b8a42fb575c3c71f1864a8143301782de13da2d9202b', 'barcode_689411', 'batch_22', 17.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'd29d53701d3c859e29e1b90028eec1ca8e2f29439198b6e036c60951fb458aa1'),
(211, 0, 8, 'barcode_689411-7', 'f5ca38f748a1d6eaf726b8a42fb575c3c71f1864a8143301782de13da2d9202b', 'barcode_689411', 'batch_22', 17.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '093434a3ee9e0a010bb2c2aae06c2614dd24894062a1caf26718a01e175569b8'),
(212, 0, 8, 'barcode_689411-8', 'f5ca38f748a1d6eaf726b8a42fb575c3c71f1864a8143301782de13da2d9202b', 'barcode_689411', 'batch_22', 17.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'fa2b7af0a811b9acde602aacb78e3638e8506dfead5fe6c3425b10b526f94bdd'),
(213, 0, 8, 'barcode_689411-9', 'f5ca38f748a1d6eaf726b8a42fb575c3c71f1864a8143301782de13da2d9202b', 'barcode_689411', 'batch_22', 17.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'd48ff4b2f68a10fd7c86f185a6ccede0dc0f2c48538d697cb33b6ada3f1e85db'),
(214, 0, 8, 'barcode_689411-10', 'f5ca38f748a1d6eaf726b8a42fb575c3c71f1864a8143301782de13da2d9202b', 'barcode_689411', 'batch_22', 17.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '802b906a18591ead8a6dd809b262ace4c65c16e89764c40ae326cfcff811e10c'),
(215, 0, 8, 'barcode_689411-11', 'f5ca38f748a1d6eaf726b8a42fb575c3c71f1864a8143301782de13da2d9202b', 'barcode_689411', 'batch_22', 17.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'd86580a57f7bf542e85202283cb845953c9d28f80a8e651db08b2fc0b2d6a731'),
(216, 0, 8, 'barcode_689411-12', 'f5ca38f748a1d6eaf726b8a42fb575c3c71f1864a8143301782de13da2d9202b', 'barcode_689411', 'batch_22', 17.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '0f4121d0ef1df4c86854c7ebb47ae1c93de8aec8f944035eeaa6495dd71a0678'),
(217, 0, 8, 'barcode_689411-13', 'f5ca38f748a1d6eaf726b8a42fb575c3c71f1864a8143301782de13da2d9202b', 'barcode_689411', 'batch_22', 17.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '16badfc6202cb3f8889e0f2779b19218af4cbb736e56acadce8148aba9a7a9f8'),
(218, 0, 8, 'barcode_689411-14', 'f5ca38f748a1d6eaf726b8a42fb575c3c71f1864a8143301782de13da2d9202b', 'barcode_689411', 'batch_22', 17.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '5966abd0cbfc86f98a186531b2b4ee5f6e910120ce13222f98207203dfc9a9a2'),
(219, 0, 8, 'barcode_689411-15', 'f5ca38f748a1d6eaf726b8a42fb575c3c71f1864a8143301782de13da2d9202b', 'barcode_689411', 'batch_22', 17.90, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '314f04b30f62e0056bd059354a5536fb2e302107eed143b5fa2aa0bbba07f608'),
(220, 0, 8, 'barcode_639421-1', '6f4b6612125fb3a0daecd2799dfd6c9c299424fd920f9b308110a2c1fbd8f443', 'barcode_639421', 'batch_44', 38.78, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '36790ecd55c2030dc553685bef719df653f413a20cdad1bfd1dc934c76686ddd'),
(221, 0, 8, 'barcode_639421-2', '6f4b6612125fb3a0daecd2799dfd6c9c299424fd920f9b308110a2c1fbd8f443', 'barcode_639421', 'batch_44', 38.78, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '67e9c3acebb154a282f326d4ff1951cd1f342e58e74d562b556b517da5e56132'),
(222, 0, 8, 'barcode_639421-3', '6f4b6612125fb3a0daecd2799dfd6c9c299424fd920f9b308110a2c1fbd8f443', 'barcode_639421', 'batch_44', 38.78, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '9b871512327c09ce91dd649b3f96a63b7408ef267c8cc5710114e629730cb61f'),
(223, 0, 8, 'barcode_639421-4', '6f4b6612125fb3a0daecd2799dfd6c9c299424fd920f9b308110a2c1fbd8f443', 'barcode_639421', 'batch_44', 38.78, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '56f4da26ed956730309fa1488611ee0f13b0ac95ebb1bc9b5d210e31ff70e79c'),
(224, 0, 8, 'barcode_639421-5', '6f4b6612125fb3a0daecd2799dfd6c9c299424fd920f9b308110a2c1fbd8f443', 'barcode_639421', 'batch_44', 38.78, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '84a5092e4a5b6fe968fd523fb2fc917dbffae44105f82b6b94c8ed5b9a800223'),
(225, 0, 8, 'barcode_639421-6', '6f4b6612125fb3a0daecd2799dfd6c9c299424fd920f9b308110a2c1fbd8f443', 'barcode_639421', 'batch_44', 38.78, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '0e6523810856a138a75dec70a9cf3778a5c70b83ac915f22c33f05db97cb3e68');
INSERT INTO `stocks` (`id`, `item_status`, `inbound_id`, `unique_barcode`, `product_id`, `parent_barcode`, `batch_code`, `capital`, `price`, `warehouse`, `supplier`, `date`, `user_id`, `pdf`, `hashed_id`) VALUES
(226, 0, 8, 'barcode_603365-1', '785f3ec7eb32f30b90cd0fcf3657d388b5ff4297f2f9716ff66e9b69c05ddd09', 'barcode_603365', 'batch_98', 87.55, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '8f1f64db81c40ea10e1e9080c9ae60a7acb8925968c431ee16784dea9841c66f'),
(227, 0, 8, 'barcode_603365-2', '785f3ec7eb32f30b90cd0fcf3657d388b5ff4297f2f9716ff66e9b69c05ddd09', 'barcode_603365', 'batch_98', 87.55, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'dfe62e836a0a6f2633422230c81287700a56e2639652c73f264e6562220c207a'),
(228, 0, 8, 'barcode_533390-1', '535fa30d7e25dd8a49f1536779734ec8286108d115da5045d77f3b4185d8f790', 'barcode_533390', 'batch_11', 11.81, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '9d693eeee1d1899cbc50b6d45df953d3835acf28ee869879b45565fccc814765'),
(229, 0, 8, 'barcode_533390-2', '535fa30d7e25dd8a49f1536779734ec8286108d115da5045d77f3b4185d8f790', 'barcode_533390', 'batch_11', 11.81, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '08490295488a1189099751ebeddb5992313dd2a831e07a92e66d196ddc261777'),
(230, 0, 8, 'barcode_533390-3', '535fa30d7e25dd8a49f1536779734ec8286108d115da5045d77f3b4185d8f790', 'barcode_533390', 'batch_11', 11.81, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'a0eaec5a55dc2f5b2ba523018adc485ff620b9d83509b9f37186a7716e438d21'),
(231, 0, 8, 'barcode_533390-4', '535fa30d7e25dd8a49f1536779734ec8286108d115da5045d77f3b4185d8f790', 'barcode_533390', 'batch_11', 11.81, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '138d9e809e386a7b800791d1f664f56d1c55f3d1ba411b950862729bc486c5ce'),
(232, 0, 8, 'barcode_533390-5', '535fa30d7e25dd8a49f1536779734ec8286108d115da5045d77f3b4185d8f790', 'barcode_533390', 'batch_11', 11.81, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '835d5e8314340ab852a2f979ab4cd53e994dbe38366afb6eed84fe4957b980c8'),
(233, 0, 8, 'barcode_533390-6', '535fa30d7e25dd8a49f1536779734ec8286108d115da5045d77f3b4185d8f790', 'barcode_533390', 'batch_11', 11.81, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'c0509a487a18b003ba05e505419ebb63e57a29158073e381f57160b5c5b86426'),
(234, 0, 8, 'barcode_533390-7', '535fa30d7e25dd8a49f1536779734ec8286108d115da5045d77f3b4185d8f790', 'barcode_533390', 'batch_11', 11.81, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '114bd151f8fb0c58642d2170da4ae7d7c57977260ac2cc8905306cab6b2acabc'),
(235, 0, 8, 'barcode_174000-1', 'c2356069e9d1e79ca924378153cfbbfb4d4416b1f99d41a2940bfdb66c5319db', 'barcode_174000', 'batch_3', 98.93, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '0a2d643bfd24a028cd236e76575d828424ccffbfa47392bd09d8ca9dc85e2f8d'),
(236, 0, 8, 'barcode_971801-1', 'b7a56873cd771f2c446d369b649430b65a756ba278ff97ec81bb6f55b2e73569', 'barcode_971801', 'batch_45', 24.36, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '9a049b03f6fc40bfcf2f136320359257ed4af8513f71aa6fef47f17059bbae23'),
(237, 0, 8, 'barcode_971801-2', 'b7a56873cd771f2c446d369b649430b65a756ba278ff97ec81bb6f55b2e73569', 'barcode_971801', 'batch_45', 24.36, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'f0bc318fb8965cad8d73d578cd03c63b7987dc6a79b906aada091e1b6a13443f'),
(238, 0, 8, 'barcode_971801-3', 'b7a56873cd771f2c446d369b649430b65a756ba278ff97ec81bb6f55b2e73569', 'barcode_971801', 'batch_45', 24.36, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '8ae4c23b80d1e7c8ff79e515fe791ebd68190bae842dda7af193db125f700452'),
(239, 0, 8, 'barcode_971801-4', 'b7a56873cd771f2c446d369b649430b65a756ba278ff97ec81bb6f55b2e73569', 'barcode_971801', 'batch_45', 24.36, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '79bf08685d3138f9b109c3546780f056bc954fd69377b84a2cf23622e464897b'),
(240, 0, 8, 'barcode_971801-5', 'b7a56873cd771f2c446d369b649430b65a756ba278ff97ec81bb6f55b2e73569', 'barcode_971801', 'batch_45', 24.36, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '6af1f692e9496c6d0b668316eccb93276ae6b6774fa728aac31ff40a38318760'),
(241, 0, 8, 'barcode_971801-6', 'b7a56873cd771f2c446d369b649430b65a756ba278ff97ec81bb6f55b2e73569', 'barcode_971801', 'batch_45', 24.36, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '749fc650cacb0f06547520d53c31505c8156e0a3be07073eddb2ef3ad9e383ba'),
(242, 0, 8, 'barcode_971801-7', 'b7a56873cd771f2c446d369b649430b65a756ba278ff97ec81bb6f55b2e73569', 'barcode_971801', 'batch_45', 24.36, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '14063697603e22d600d336bee6cff12c8be93509ce84a0642918d89b2aef1753'),
(243, 0, 8, 'barcode_971801-8', 'b7a56873cd771f2c446d369b649430b65a756ba278ff97ec81bb6f55b2e73569', 'barcode_971801', 'batch_45', 24.36, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '72440a20f54075ac43f51a2cf0dbb2a14366b38a5c01b110ae174abc1cb44238'),
(244, 0, 8, 'barcode_971801-9', 'b7a56873cd771f2c446d369b649430b65a756ba278ff97ec81bb6f55b2e73569', 'barcode_971801', 'batch_45', 24.36, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '82c01ce15b431d420eb6a1febfba7d7a2b69e5bcdcb929cb42cd3e9179d43fc4'),
(245, 0, 8, 'barcode_971801-10', 'b7a56873cd771f2c446d369b649430b65a756ba278ff97ec81bb6f55b2e73569', 'barcode_971801', 'batch_45', 24.36, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '011af72a910ac4acf367eef9e6b761e0980842c30d4e9809840f4141d5163ede'),
(246, 0, 8, 'barcode_971801-11', 'b7a56873cd771f2c446d369b649430b65a756ba278ff97ec81bb6f55b2e73569', 'barcode_971801', 'batch_45', 24.36, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '37c20f19f3272b5ccc3a5d80587eb9deb3f4afcf568c4280fb195568da8eb1a2'),
(247, 0, 8, 'barcode_971801-12', 'b7a56873cd771f2c446d369b649430b65a756ba278ff97ec81bb6f55b2e73569', 'barcode_971801', 'batch_45', 24.36, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '396f804443825586c1283a27fdcadf74abb82008bcd9b260a30912a26563f27d'),
(248, 0, 8, 'barcode_847099-1', '5f9c4ab08cac7457e9111a30e4664920607ea2c115a1433d7be98e97e64244ca', 'barcode_847099', 'batch_74', 88.66, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '766cb53c753baedac5dc782593e04694b3bae3aed057ac2ff98cc1aef6413137'),
(249, 0, 8, 'barcode_847099-2', '5f9c4ab08cac7457e9111a30e4664920607ea2c115a1433d7be98e97e64244ca', 'barcode_847099', 'batch_74', 88.66, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '9f484139a27415ae2e8612bf6c65a8101a18eb5e9b7809e74ca63a45a65f17f4'),
(250, 0, 8, 'barcode_847099-3', '5f9c4ab08cac7457e9111a30e4664920607ea2c115a1433d7be98e97e64244ca', 'barcode_847099', 'batch_74', 88.66, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '1e472b39b105d349bcd069c4a711b44a2fffb8e274714bb07ecfff69a9a7f67b'),
(251, 0, 8, 'barcode_847099-4', '5f9c4ab08cac7457e9111a30e4664920607ea2c115a1433d7be98e97e64244ca', 'barcode_847099', 'batch_74', 88.66, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'c75d3f1f5bcd6914d0331ce5ec17c0db8f2070a2d4285f8e3ff11c6ca19168ff'),
(252, 0, 8, 'barcode_847099-5', '5f9c4ab08cac7457e9111a30e4664920607ea2c115a1433d7be98e97e64244ca', 'barcode_847099', 'batch_74', 88.66, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'd6e5a20b30f87216b2c758f5e7a23c437dbc3dfa1ccb177c474de152bb0ef731'),
(253, 0, 8, 'barcode_847099-6', '5f9c4ab08cac7457e9111a30e4664920607ea2c115a1433d7be98e97e64244ca', 'barcode_847099', 'batch_74', 88.66, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'e7866fdc6672f827c76f6124ca3eeaff44aff8b7caf4ee1469b2ab887e7e7875'),
(254, 0, 8, 'barcode_847099-7', '5f9c4ab08cac7457e9111a30e4664920607ea2c115a1433d7be98e97e64244ca', 'barcode_847099', 'batch_74', 88.66, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '9512d95d00d61bdec03d2b99d6ecc455ee5644ae52d10e7c4a61c93062dc97a3'),
(255, 0, 8, 'barcode_847099-8', '5f9c4ab08cac7457e9111a30e4664920607ea2c115a1433d7be98e97e64244ca', 'barcode_847099', 'batch_74', 88.66, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '9556b82499cc0aaf86aee7f0d253e17c61b7ef73d48a295f37d98f08b04ffa7f'),
(256, 0, 8, 'barcode_847099-9', '5f9c4ab08cac7457e9111a30e4664920607ea2c115a1433d7be98e97e64244ca', 'barcode_847099', 'batch_74', 88.66, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '51e8ea280b44e16934d4d611901f3d3afc41789840acdff81942c2f65009cd52'),
(257, 0, 8, 'barcode_847099-10', '5f9c4ab08cac7457e9111a30e4664920607ea2c115a1433d7be98e97e64244ca', 'barcode_847099', 'batch_74', 88.66, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '4c970004b0678d439f177e77d3cabdb7e9a44df770948ddc2467cbc76b7211c3'),
(258, 0, 8, 'barcode_847099-11', '5f9c4ab08cac7457e9111a30e4664920607ea2c115a1433d7be98e97e64244ca', 'barcode_847099', 'batch_74', 88.66, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'a30f4ef42176d28f0e2293533c5f532e9c9c5696c68813b35315d17edc44f6b1'),
(259, 0, 8, 'barcode_847099-12', '5f9c4ab08cac7457e9111a30e4664920607ea2c115a1433d7be98e97e64244ca', 'barcode_847099', 'batch_74', 88.66, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '7c252ab334fb8fd88e8242c4972c21db9c7ce0b47c9acc4ebfe40c14614cb734'),
(260, 0, 8, 'barcode_847099-13', '5f9c4ab08cac7457e9111a30e4664920607ea2c115a1433d7be98e97e64244ca', 'barcode_847099', 'batch_74', 88.66, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '39bb88f40d3aa2b2fe9dea67be27c74765db0ebb3ff3cf8fb779af6319fa2045'),
(261, 0, 8, 'barcode_818665-1', '670671cd97404156226e507973f2ab8330d3022ca96e0c93bdbdb320c41adcaf', 'barcode_818665', 'batch_49', 76.85, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'e888a676e1926d0c08b5f11fb9116df58b62604b05846f39f8d6fc4dd0ba31f1'),
(262, 0, 8, 'barcode_818665-2', '670671cd97404156226e507973f2ab8330d3022ca96e0c93bdbdb320c41adcaf', 'barcode_818665', 'batch_49', 76.85, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '9e6a72557ada15d02001f024f43f06edc4a31437e0e1bb3eeac36ca2d0c4fda7'),
(263, 0, 8, 'barcode_818665-3', '670671cd97404156226e507973f2ab8330d3022ca96e0c93bdbdb320c41adcaf', 'barcode_818665', 'batch_49', 76.85, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '4be84111a613654b362415e563cb7607df7b203b5d303802a8a546061bbc7847'),
(264, 0, 8, 'barcode_818665-4', '670671cd97404156226e507973f2ab8330d3022ca96e0c93bdbdb320c41adcaf', 'barcode_818665', 'batch_49', 76.85, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'bba58959c32abe688d9cb5222b97de973002a67c412d6a8c8d2a79ac692f32b7'),
(265, 0, 8, 'barcode_818665-5', '670671cd97404156226e507973f2ab8330d3022ca96e0c93bdbdb320c41adcaf', 'barcode_818665', 'batch_49', 76.85, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '768b84ef05f655d57fe22d488451f075365f6cd18a13073466aa826cc0ebdbfb'),
(266, 0, 8, 'barcode_818665-6', '670671cd97404156226e507973f2ab8330d3022ca96e0c93bdbdb320c41adcaf', 'barcode_818665', 'batch_49', 76.85, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'ea5b27556fbb134def2c2fbf944d9cdda3dbdb6b10473a1aec59f6f170c4ca3a'),
(267, 0, 8, 'barcode_818665-7', '670671cd97404156226e507973f2ab8330d3022ca96e0c93bdbdb320c41adcaf', 'barcode_818665', 'batch_49', 76.85, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '8acc23987b8960d83c44541f9f0eb46454cea080ea94d916f56fccf033db866f'),
(268, 0, 8, 'barcode_818665-8', '670671cd97404156226e507973f2ab8330d3022ca96e0c93bdbdb320c41adcaf', 'barcode_818665', 'batch_49', 76.85, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '8b496bf96bbcc9e5ac11c068b6cfb00c32f9d163bb8a3d5af107217499de997a'),
(269, 0, 8, 'barcode_818665-9', '670671cd97404156226e507973f2ab8330d3022ca96e0c93bdbdb320c41adcaf', 'barcode_818665', 'batch_49', 76.85, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'f747870ae666c39b589f577856a0f7198b3b81269cb0326de86d8046f2cf72db'),
(270, 0, 8, 'barcode_818665-10', '670671cd97404156226e507973f2ab8330d3022ca96e0c93bdbdb320c41adcaf', 'barcode_818665', 'batch_49', 76.85, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'd8d1790737d57ac4fe91a2c0a28087c0a97c81f5dc6b19d5e4aec20c08bb95ae'),
(271, 0, 8, 'barcode_818665-11', '670671cd97404156226e507973f2ab8330d3022ca96e0c93bdbdb320c41adcaf', 'barcode_818665', 'batch_49', 76.85, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '3635a91e3da857f7847f68185a116a5260d2593f3913f6b1b66cc2d75b0d6ec0'),
(272, 0, 8, 'barcode_818665-12', '670671cd97404156226e507973f2ab8330d3022ca96e0c93bdbdb320c41adcaf', 'barcode_818665', 'batch_49', 76.85, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '1c6c0bb2c7ecdc3be8e134f79b9de45155258c1f554ae7542dce48f5cc8d63f0'),
(273, 0, 8, 'barcode_818665-13', '670671cd97404156226e507973f2ab8330d3022ca96e0c93bdbdb320c41adcaf', 'barcode_818665', 'batch_49', 76.85, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '303c8bd55875dda240897db158acf70afe4226f300757f3518b86e6817c00022'),
(274, 0, 8, 'barcode_818665-14', '670671cd97404156226e507973f2ab8330d3022ca96e0c93bdbdb320c41adcaf', 'barcode_818665', 'batch_49', 76.85, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '718127812c05853f0bec61582a4a3840b1c844fe11fe1a004b5b7eb8b8b59846'),
(275, 0, 8, 'barcode_818665-15', '670671cd97404156226e507973f2ab8330d3022ca96e0c93bdbdb320c41adcaf', 'barcode_818665', 'batch_49', 76.85, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '3a1dfb05d7257530e6349233688c3e121945c5de50f1273a7620537755d61e45'),
(276, 0, 8, 'barcode_818665-16', '670671cd97404156226e507973f2ab8330d3022ca96e0c93bdbdb320c41adcaf', 'barcode_818665', 'batch_49', 76.85, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'c76b405781134be1dab7fe45adfb8c32104805a01de7b863e1004b66d56edf9f'),
(277, 0, 8, 'barcode_818665-17', '670671cd97404156226e507973f2ab8330d3022ca96e0c93bdbdb320c41adcaf', 'barcode_818665', 'batch_49', 76.85, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '27d719c754aacd492a6dc8a1b76619355abcf5ef473cbec02018d3c57ebbf0d5'),
(278, 0, 8, 'barcode_818665-18', '670671cd97404156226e507973f2ab8330d3022ca96e0c93bdbdb320c41adcaf', 'barcode_818665', 'batch_49', 76.85, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'ee62de25ccc2b55d3a0495244b246fb97055b6f1c2697d837b8e94976c03756f'),
(279, 0, 8, 'barcode_688354-1', '59e19706d51d39f66711c2653cd7eb1291c94d9b55eb14bda74ce4dc636d015a', 'barcode_688354', 'batch_32', 88.33, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'efd96aedf377e20afd95285a7c751a864260bd6a149656a4040c5b7757bdbbb6'),
(280, 0, 8, 'barcode_688354-2', '59e19706d51d39f66711c2653cd7eb1291c94d9b55eb14bda74ce4dc636d015a', 'barcode_688354', 'batch_32', 88.33, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '7f0a22117f8fe0172cf9209ff622b64a51aaeda21d58b5b62685a93dbe2dad25'),
(281, 0, 8, 'barcode_688354-3', '59e19706d51d39f66711c2653cd7eb1291c94d9b55eb14bda74ce4dc636d015a', 'barcode_688354', 'batch_32', 88.33, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '71a1c003a2b855d85582c8f6c7648c49d3fe836408a7e1b5d9b222448acb3c1b'),
(282, 0, 8, 'barcode_688354-4', '59e19706d51d39f66711c2653cd7eb1291c94d9b55eb14bda74ce4dc636d015a', 'barcode_688354', 'batch_32', 88.33, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '27e1615212f3c6ea846ed6c412df1361ce97f006ee20bb5aa2483a3b61d5cadd'),
(283, 0, 8, 'barcode_688354-5', '59e19706d51d39f66711c2653cd7eb1291c94d9b55eb14bda74ce4dc636d015a', 'barcode_688354', 'batch_32', 88.33, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'e0850a775c17a87060c0cf6efad1020e0cbef5a44ba942bef6add5776598de53'),
(284, 0, 8, 'barcode_688354-6', '59e19706d51d39f66711c2653cd7eb1291c94d9b55eb14bda74ce4dc636d015a', 'barcode_688354', 'batch_32', 88.33, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '1e68ed4e3d58a51096a7feea3947f40debf1fd9246ec977eb62ab93c81823ad9'),
(285, 0, 8, 'barcode_688354-7', '59e19706d51d39f66711c2653cd7eb1291c94d9b55eb14bda74ce4dc636d015a', 'barcode_688354', 'batch_32', 88.33, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'a0d177b4967a6d99f4ff117defe1c0d23d4e78ca4630febcb948ee9e4520eff3'),
(286, 0, 8, 'barcode_688354-8', '59e19706d51d39f66711c2653cd7eb1291c94d9b55eb14bda74ce4dc636d015a', 'barcode_688354', 'batch_32', 88.33, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '00328ce57bbc14b33bd6695bc8eb32cdf2fb5f3a7d89ec14a42825e15d39df60'),
(287, 0, 8, 'barcode_688354-9', '59e19706d51d39f66711c2653cd7eb1291c94d9b55eb14bda74ce4dc636d015a', 'barcode_688354', 'batch_32', 88.33, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'd7cdaa5ca0582076c8e772cce739e32c5077cfd24f2ea33f04bb754594989a56'),
(288, 0, 8, 'barcode_688354-10', '59e19706d51d39f66711c2653cd7eb1291c94d9b55eb14bda74ce4dc636d015a', 'barcode_688354', 'batch_32', 88.33, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '23c657f2efda7731a3c1990b25f318fa2eb1332208f97ab9cc2a7eac70ab5a76'),
(289, 0, 8, 'barcode_688354-11', '59e19706d51d39f66711c2653cd7eb1291c94d9b55eb14bda74ce4dc636d015a', 'barcode_688354', 'batch_32', 88.33, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'af180e4359fc6179dc953abdcbdcaf7c146b53e1bee2b335e50dead11ccefa07'),
(290, 0, 8, 'barcode_688354-12', '59e19706d51d39f66711c2653cd7eb1291c94d9b55eb14bda74ce4dc636d015a', 'barcode_688354', 'batch_32', 88.33, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '09895de0407bcb0386733daa14bdb5dfa544505530c634334a05a60f161b71fc'),
(291, 0, 8, 'barcode_688354-13', '59e19706d51d39f66711c2653cd7eb1291c94d9b55eb14bda74ce4dc636d015a', 'barcode_688354', 'batch_32', 88.33, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '33512007840ced1bb0aab68f47cb5f702abd494a15f26bcbe26a1e47af03d841'),
(292, 0, 8, 'barcode_801624-1', '35135aaa6cc23891b40cb3f378c53a17a1127210ce60e125ccf03efcfdaec458', 'barcode_801624', 'batch_26', 81.63, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '6db6eb4af1e18ab81d3878e44672185d60ca8c988c9e2f7783de220735534c33'),
(293, 0, 8, 'barcode_801624-2', '35135aaa6cc23891b40cb3f378c53a17a1127210ce60e125ccf03efcfdaec458', 'barcode_801624', 'batch_26', 81.63, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '7cb676d57114874e00c536916e6dcad2a5d3cb8c9a5abc06335df359cd9a6ef9'),
(294, 0, 8, 'barcode_801624-3', '35135aaa6cc23891b40cb3f378c53a17a1127210ce60e125ccf03efcfdaec458', 'barcode_801624', 'batch_26', 81.63, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '2cfc8ccbd7c0b17615323b41e815651ff2ae9ffae45a4599c0499b98ff940429'),
(295, 0, 8, 'barcode_801624-4', '35135aaa6cc23891b40cb3f378c53a17a1127210ce60e125ccf03efcfdaec458', 'barcode_801624', 'batch_26', 81.63, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '9cfd3c755be26b4e1645918e2a64a26e3d851ede421e0b257f783b443bc443d1'),
(296, 0, 8, 'barcode_801624-5', '35135aaa6cc23891b40cb3f378c53a17a1127210ce60e125ccf03efcfdaec458', 'barcode_801624', 'batch_26', 81.63, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'a0f8b2c4cb1ac82abdb37f0fe5203b97be556c4468c83bba18684d620fd8eaf9'),
(297, 0, 8, 'barcode_801624-6', '35135aaa6cc23891b40cb3f378c53a17a1127210ce60e125ccf03efcfdaec458', 'barcode_801624', 'batch_26', 81.63, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '4c15f47afe7f817fd559e12ddbc276f4930c5822f2049088d6f6605bec7cea56'),
(298, 0, 8, 'barcode_801624-7', '35135aaa6cc23891b40cb3f378c53a17a1127210ce60e125ccf03efcfdaec458', 'barcode_801624', 'batch_26', 81.63, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '76ebdb6d45c61ca12e622118cc90939ade672adf7890aa2b246405d4884dd75a'),
(299, 0, 8, 'barcode_801624-8', '35135aaa6cc23891b40cb3f378c53a17a1127210ce60e125ccf03efcfdaec458', 'barcode_801624', 'batch_26', 81.63, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '308831041ea4863c3f87d222c31f759411898c874a9006b4bd6c745858b8f3bd'),
(300, 0, 8, 'barcode_801624-9', '35135aaa6cc23891b40cb3f378c53a17a1127210ce60e125ccf03efcfdaec458', 'barcode_801624', 'batch_26', 81.63, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '983bd614bb5afece5ab3b6023f71147cd7b6bc2314f9d27af7422541c6558389'),
(301, 0, 8, 'barcode_801624-10', '35135aaa6cc23891b40cb3f378c53a17a1127210ce60e125ccf03efcfdaec458', 'barcode_801624', 'batch_26', 81.63, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'c3ea99f86b2f8a74ef4145bb245155ff5f91cd856f287523481c15a1959d5fd1'),
(302, 0, 8, 'barcode_801624-11', '35135aaa6cc23891b40cb3f378c53a17a1127210ce60e125ccf03efcfdaec458', 'barcode_801624', 'batch_26', 81.63, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'f32828acecb4282c87eaa554d2e1db74e418cd6845843012463a3324028bdd9d'),
(303, 0, 8, 'barcode_801624-12', '35135aaa6cc23891b40cb3f378c53a17a1127210ce60e125ccf03efcfdaec458', 'barcode_801624', 'batch_26', 81.63, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '8bd9c0d453533757387ed019c45617cdc440ba680a67b1a101c85b998ef715c0'),
(304, 0, 8, 'barcode_801624-13', '35135aaa6cc23891b40cb3f378c53a17a1127210ce60e125ccf03efcfdaec458', 'barcode_801624', 'batch_26', 81.63, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'd874e4e4a5df21173b0f83e313151f813bea4f488686efe670ae47f87c177595'),
(305, 0, 8, 'barcode_801624-14', '35135aaa6cc23891b40cb3f378c53a17a1127210ce60e125ccf03efcfdaec458', 'barcode_801624', 'batch_26', 81.63, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '090d3859ff6840b2280f4708cf08cdaed873d967183a4d1deedc1a7964a21eee'),
(306, 0, 8, 'barcode_801624-15', '35135aaa6cc23891b40cb3f378c53a17a1127210ce60e125ccf03efcfdaec458', 'barcode_801624', 'batch_26', 81.63, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '38b83caefa1ef26940f1d07bd4ec94c60809b0f88f2118e82ef8ec2d98938a84'),
(307, 0, 8, 'barcode_943952-1', '624b60c58c9d8bfb6ff1886c2fd605d2adeb6ea4da576068201b6c6958ce93f4', 'barcode_943952', 'batch_56', 60.03, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '6d976934be74941fba578b143ba964eded443d10384e3f3d62a1ba7b4d339df8'),
(308, 0, 8, 'barcode_943952-2', '624b60c58c9d8bfb6ff1886c2fd605d2adeb6ea4da576068201b6c6958ce93f4', 'barcode_943952', 'batch_56', 60.03, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '48a1706eca5ee6148f748ca91a0f7db6ebcf59943532044a7bf60bbe44e5b1d2'),
(309, 0, 8, 'barcode_943952-3', '624b60c58c9d8bfb6ff1886c2fd605d2adeb6ea4da576068201b6c6958ce93f4', 'barcode_943952', 'batch_56', 60.03, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '43c727ee4fc7250574d2ef90cfa16626388a10e1b30d36ece1c272953ad2ed9e'),
(310, 0, 8, 'barcode_943952-4', '624b60c58c9d8bfb6ff1886c2fd605d2adeb6ea4da576068201b6c6958ce93f4', 'barcode_943952', 'batch_56', 60.03, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '226f76b55acb49701e06ded1d95165d179458f6fc37f5c6fc760ae30dec1c378'),
(311, 0, 8, 'barcode_943952-5', '624b60c58c9d8bfb6ff1886c2fd605d2adeb6ea4da576068201b6c6958ce93f4', 'barcode_943952', 'batch_56', 60.03, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '20e9c64c05a54d199610fb7e38135361324b5ed5dcf39c23afe9b48926c07376'),
(312, 0, 8, 'barcode_943952-6', '624b60c58c9d8bfb6ff1886c2fd605d2adeb6ea4da576068201b6c6958ce93f4', 'barcode_943952', 'batch_56', 60.03, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '865736a1c30a82dc67aba820360a01b1d9d0da5643234cd07c4d60b06eb530c5'),
(313, 0, 8, 'barcode_943952-7', '624b60c58c9d8bfb6ff1886c2fd605d2adeb6ea4da576068201b6c6958ce93f4', 'barcode_943952', 'batch_56', 60.03, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '8efbbe9bc19ad2e043c6cdb187c0a0fedde70b6458443ce0b5648ec04ccf4cdf'),
(314, 0, 8, 'barcode_943952-8', '624b60c58c9d8bfb6ff1886c2fd605d2adeb6ea4da576068201b6c6958ce93f4', 'barcode_943952', 'batch_56', 60.03, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '748064be03a08df81e31bd6f9e7e7c4cc9f84b4401b9a3c6e85b7ff816d3ba68'),
(315, 0, 8, 'barcode_943952-9', '624b60c58c9d8bfb6ff1886c2fd605d2adeb6ea4da576068201b6c6958ce93f4', 'barcode_943952', 'batch_56', 60.03, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '377adeb4cd4096adc7ca64b533938cffc6294a9b3534f883b2336a26252cda9a'),
(316, 0, 8, 'barcode_943952-10', '624b60c58c9d8bfb6ff1886c2fd605d2adeb6ea4da576068201b6c6958ce93f4', 'barcode_943952', 'batch_56', 60.03, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '7a20311cf7a4b222d436424480bc65dd0f9d2cefcbbb1fa148ca0d7e1d5bb55a'),
(317, 0, 8, 'barcode_943952-11', '624b60c58c9d8bfb6ff1886c2fd605d2adeb6ea4da576068201b6c6958ce93f4', 'barcode_943952', 'batch_56', 60.03, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '8d1ede4f889e0ed6f0823d8c1821905b9de37a0f851dc270df0dbf72b3c93641'),
(318, 0, 8, 'barcode_943952-12', '624b60c58c9d8bfb6ff1886c2fd605d2adeb6ea4da576068201b6c6958ce93f4', 'barcode_943952', 'batch_56', 60.03, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'aae02129362d611717b6c00ad8d73bf820a0f6d88fca8e515cafe78d3a335965'),
(319, 0, 8, 'barcode_943952-13', '624b60c58c9d8bfb6ff1886c2fd605d2adeb6ea4da576068201b6c6958ce93f4', 'barcode_943952', 'batch_56', 60.03, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '156091ee0884f36de9836d58b6f05f357ec6ef0620c571577ac61f7beac35f8e'),
(320, 0, 8, 'barcode_943952-14', '624b60c58c9d8bfb6ff1886c2fd605d2adeb6ea4da576068201b6c6958ce93f4', 'barcode_943952', 'batch_56', 60.03, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '88820462180e5c893eff2ed73f4ec33e205d1cd5acc4d17fa7b2bca2495d3448'),
(321, 0, 8, 'barcode_943952-15', '624b60c58c9d8bfb6ff1886c2fd605d2adeb6ea4da576068201b6c6958ce93f4', 'barcode_943952', 'batch_56', 60.03, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '8d23cf6c86e834a7aa6eded54c26ce2bb2e74903538c61bdd5d2197997ab2f72'),
(322, 0, 8, 'barcode_943952-16', '624b60c58c9d8bfb6ff1886c2fd605d2adeb6ea4da576068201b6c6958ce93f4', 'barcode_943952', 'batch_56', 60.03, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'f10d91a7596bf5a6773579ff1306afdc363b0be08602c768907c09261cad3a56'),
(323, 0, 8, 'barcode_943952-17', '624b60c58c9d8bfb6ff1886c2fd605d2adeb6ea4da576068201b6c6958ce93f4', 'barcode_943952', 'batch_56', 60.03, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '3949ac1596ec77106a709a618bf5adcb19b77537ce8bcbdf54ff830169cdd084'),
(324, 0, 8, 'barcode_943952-18', '624b60c58c9d8bfb6ff1886c2fd605d2adeb6ea4da576068201b6c6958ce93f4', 'barcode_943952', 'batch_56', 60.03, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '1038e0b72d98745fac0fb015fd9c56704862adf11392936242a2ff5a65629f50'),
(325, 0, 8, 'barcode_943952-19', '624b60c58c9d8bfb6ff1886c2fd605d2adeb6ea4da576068201b6c6958ce93f4', 'barcode_943952', 'batch_56', 60.03, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', '9e11c362bc3d3572970b973d5cd86c073da358b6f9bceaa3be65d1a6487f8819'),
(326, 0, 8, 'barcode_943952-20', '624b60c58c9d8bfb6ff1886c2fd605d2adeb6ea4da576068201b6c6958ce93f4', 'barcode_943952', 'batch_56', 60.03, NULL, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d', '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '', 'a4e987d17584557e2fbed011cddf66dc5185338bc3ef33d4226f86c32b7364dd');

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
(1, 'Supplier A', NULL, 'Local', '2024-11-18 07:01:17', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b'),
(2, 'supplier_3', NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35'),
(3, 'supplier_2', NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce'),
(4, 'supplier_1', NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a'),
(5, 'supplier_4', NULL, NULL, '2024-11-18 07:06:55', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'ef2d127de37b942baad06145e54b0c619a1f22327b2ebbcfbec78f5564afe39d');

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
(3, 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'andres', 'Boni', 'Bonifacio', '', 'administrator2@admin.admin', '2024-11-12 00:00:00', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', NULL, '1', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 0, '4e07408562bedb8b60ce05c1decfe3ad16b72230967de01f640b7e4729b49fce');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courier`
--
ALTER TABLE `courier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inbound_logs`
--
ALTER TABLE `inbound_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `item_location`
--
ALTER TABLE `item_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=327;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
