-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2025 at 02:40 PM
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
  `quantity_before` int(11) NOT NULL,
  `quantity_after` int(11) NOT NULL,
  `status` int(11) NOT NULL,
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
  `status` int(11) NOT NULL,
  `date_sent` datetime DEFAULT NULL,
  `warehouse` longtext NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `customer_fullname` varchar(100) NOT NULL,
  `courier` varchar(100) DEFAULT NULL,
  `platform` varchar(100) NOT NULL,
  `order_num` varchar(50) DEFAULT NULL,
  `order_line_id` varchar(50) NOT NULL,
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
  `keyword` varchar(100) NOT NULL,
  `parent_barcode` varchar(30) DEFAULT NULL,
  `safety` int(11) NOT NULL,
  `capital` decimal(10,2) DEFAULT NULL,
  `wholesale` decimal(10,2) DEFAULT NULL,
  `srp` decimal(10,2) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `hashed_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchased_order`
--

CREATE TABLE `purchased_order` (
  `id` int(11) NOT NULL,
  `warehouse` varchar(255) DEFAULT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `date_order` datetime DEFAULT NULL,
  `date_received` datetime DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
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
  `product_id` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `hashed_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `id` int(11) NOT NULL,
  `unique_barcode` varchar(30) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `reason` longtext NOT NULL,
  `date` datetime NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `warehouse` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rts_content`
--

CREATE TABLE `rts_content` (
  `id` int(11) NOT NULL,
  `unique_barcode` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `rts_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rts_logs`
--

CREATE TABLE `rts_logs` (
  `id` int(11) NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `reason` longtext NOT NULL,
  `status` int(1) NOT NULL,
  `warehouse` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `item_status` int(11) NOT NULL,
  `inbound_id` int(11) NOT NULL,
  `outbound_id` varchar(17) NOT NULL,
  `outbounded_by` varchar(100) NOT NULL,
  `unique_barcode` varchar(30) DEFAULT NULL,
  `barcode_extension` int(11) NOT NULL,
  `product_id` varchar(100) DEFAULT NULL,
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
  `status` varchar(20) DEFAULT NULL,
  `st_id` int(11) DEFAULT NULL
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
  `status` varchar(50) NOT NULL,
  `user_pw` varchar(255) NOT NULL,
  `otp` int(6) NOT NULL,
  `first_login` varchar(5) NOT NULL,
  `hashed_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_position`, `user_fname`, `user_mname`, `user_lname`, `pfp`, `email`, `birth_date`, `warehouse_access`, `address`, `status`, `user_pw`, `otp`, `first_login`, `hashed_id`) VALUES
(2, 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35', 'Jose', 'Mercado', 'Rizal', '', 'administrator@admin.admin', '2018-11-08 00:00:00', '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a,4a44dc15364204a80fe80e9039455cc1608281820fe2b24f1e5233ade6af1dd5,4fc82b26aecb47d2868c4efbe3581732a3e7cbcc6c2efb32062c08170a05eeb8', NULL, '1', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 0, '', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35');

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
(2, 'Administrator', 'capital_sales,fast_brand,fast_category,weekly_sales,total_orders,fast_products,po_logs,new_po,inbound_logs,new_inbound,stock,logistics,stock_transfer,rack_transfer,returnproduct,returns,finance,forecasting,users,audit,admin_category,admin_brand,product_list,admin_warehouse,admin_supplier,admin_platform,admin_courier,barcode_reprint,admin_accessess,item-destination', 0, NULL, '2024-11-10 16:03:01', '1', 'd4735e3a265e16eee03f59718b9b5d03019c07d8b6c51f90da3a666eec13ab35');

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
(1, 'Administration', 0, '2024-11-10 15:15:29', 1, '4b227777d4dd1fc61c6f884f48641d02b4d121d3fd328cb08b5531fcacdabf8a');

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
-- Indexes for table `rts_content`
--
ALTER TABLE `rts_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rts_logs`
--
ALTER TABLE `rts_logs`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courier`
--
ALTER TABLE `courier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inbound_logs`
--
ALTER TABLE `inbound_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_location`
--
ALTER TABLE `item_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logistic_partner`
--
ALTER TABLE `logistic_partner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `rts_content`
--
ALTER TABLE `rts_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rts_logs`
--
ALTER TABLE `rts_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_position`
--
ALTER TABLE `user_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `warehouse_stock_safety`
--
ALTER TABLE `warehouse_stock_safety`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
