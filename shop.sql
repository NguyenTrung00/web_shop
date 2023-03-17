-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2023 at 02:19 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminPass` varchar(255) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `level` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `adminName`, `adminEmail`, `adminPass`, `adminUser`, `level`) VALUES
(5, 'admin', 'meival@gmail.com', '123456', 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `idBrand` int(11) NOT NULL,
  `brandName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`idBrand`, `brandName`) VALUES
(2, 'Apple'),
(3, 'Dell'),
(5, 'Xiaomi'),
(6, 'Oppo'),
(7, 'Oneplus'),
(8, 'Huawei'),
(9, 'Panasonic'),
(11, 'Samsung');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `idCart` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `idSession` varchar(255) NOT NULL,
  `proName` varchar(255) NOT NULL,
  `proPrice` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`idCart`, `idProduct`, `idSession`, `proName`, `proPrice`, `quantity`, `image`) VALUES
(43, 14, '9qdbdorr7jtr7lljjg9ja69in8', 'Bếp nướng ', '7000000', 1, '5dd2e43d0f.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `idCategory` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`idCategory`, `catName`) VALUES
(1, 'Laptop'),
(3, 'Desktop'),
(4, 'Moblies Phone'),
(10, 'Houseware');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `idCustomer` int(11) NOT NULL,
  `cusName` varchar(200) NOT NULL,
  `cusEmail` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`idCustomer`, `cusName`, `cusEmail`, `address`, `country`, `phone`, `password`) VALUES
(11, 'Nguyễn Thành Trung', 'abc123@gmail.com', 'quận 10, Hồ Chí Minh', 'HCM', '09233322344', 'e10adc3949ba59abbe56e057f20f883e'),
(16, 'Nguyễn Thùy Trang', 'dung123@gmail.com', 'Quang Trung, Quận 12, Tp Hồ Chí Minh', 'HCM', '08234177877', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `idOrder` int(11) NOT NULL,
  `idCustomer` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `proName` varchar(255) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `orderPrice` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`idOrder`, `idCustomer`, `idProduct`, `proName`, `quantity`, `orderPrice`, `image`, `orderDate`, `status`) VALUES
(56, 11, 3, 'Dell g15', '1', '20000000', 'cf04fa2218.jfif', '2023-03-16 15:20:57', 0),
(58, 16, 10, 'Tu lanh Panasonic', '1', '5000000', '8bb9bcc7c6.jfif', '2023-03-16 15:21:07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `idProduct` int(11) NOT NULL,
  `proName` varchar(255) NOT NULL,
  `idCategory` int(11) NOT NULL,
  `idBrand` int(11) NOT NULL,
  `proPrice` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` tinytext NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`idProduct`, `proName`, `idCategory`, `idBrand`, `proPrice`, `image`, `description`, `type`) VALUES
(3, 'Dell g15', 1, 3, '20000000', 'cf04fa2218.jfif', '<p>Dell g15</p>', 1),
(6, 'iphone 12', 4, 2, '18000000', '7470b17fd4.webp', '<p>Iphone 12</p>', 1),
(7, 'iphone 13', 4, 2, '20000000', 'a7ffe0594f.webp', '<p>iphone 13</p>', 1),
(8, 'Xiaomi 13 pro', 4, 5, '19000000', 'd4817ec6a6.webp', '<p>Xiaomi 13 pro</p>', 0),
(9, 'macbook 14', 1, 2, '35000000', '9b87c8a6ae.jfif', '<p>Macbook 14</p>', 0),
(10, 'Tu lanh Panasonic', 10, 9, '5000000', '8bb9bcc7c6.jfif', '<p>tu lanh panasonic</p>', 0),
(11, 'Laptop Huawei ', 1, 8, '20000000', '5a7702eb2c.jfif', '<p>laptop huawei</p>', 0),
(12, 'Galaxy S23 Ultra', 4, 11, '30000000', '74827d2d82.webp', '<p>galaxy s23 ultra</p>', 0),
(13, 'Máy giặt ', 10, 9, '6000000', 'a988f12bd5.jfif', '<p>m&aacute;y giặt&nbsp;</p>', 1),
(14, 'Bếp nướng ', 10, 9, '7000000', '5dd2e43d0f.jfif', '<p>m&aacute;y giặt Samsung</p>', 1),
(15, 'PC Dell', 3, 3, '12000000', '9a56aaed10.jfif', '<p>D&agrave;n PC của h&atilde;ng Dell</p>', 1),
(16, 'Oneplus 11', 4, 7, '19000000', '8a0a1ab144.webp', '<p>Điện thoại Oneplus 11 mới ra mắt. Hứa hẹn sẽ mang lại nhiều tr&atilde;i nghiệm th&uacute; vị d&agrave;nh cho Fan Oneplus</p>', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`idBrand`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`idCart`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`idCategory`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`idCustomer`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`idOrder`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`idProduct`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `idBrand` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `idCart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `idCategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `idCustomer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `idOrder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `idProduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
