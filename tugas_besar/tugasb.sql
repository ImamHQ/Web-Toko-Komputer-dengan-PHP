-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2022 at 08:56 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugasb`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(1, 'RAM'),
(2, 'Monitor'),
(4, 'Laptop'),
(5, 'VGA'),
(6, 'Processor'),
(7, 'Keyboard'),
(8, 'Mouse');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `idp` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `namak` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `stockk` enum('habis','tersedia') DEFAULT 'tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`idp`, `kategori_id`, `namak`, `harga`, `foto`, `detail`, `stockk`) VALUES
(1, 2, 'LENOVO MONITOR 22&quot; L22e-20 FHD IPS', 1265000, 'uzzQpJhVPNWk0dJiVqx9.jpg', 'Resolution 1920 x 1080', 'tersedia'),
(2, 1, 'RAM KINGSTON HYPER X', 539000, 'RZvSYd4fkvZbUA4lb9hp.jpg', 'GAMING DDR4 8GB LONGDIMM ', 'tersedia'),
(3, 4, 'LAPTOP Acer Swift 3 SF316-51-51DT', 8629000, 'Lno5sV1XgMH5BG0b2owG.jpg', 'Core I5 Gen 11 RAM 16GB SSD 512GB', 'tersedia'),
(4, 5, 'ZOTAC GAMING GeForce GTX 1660', 3500000, 'a0SubxNdFmw5Gxnzk6GM.jpg', '6GB GDDR5 - Orange', 'tersedia'),
(5, 6, 'Intel Core i5 12600K', 4559000, 'KlrWBlvcnJi4El0cGtd1.jpg', '3.4GHz 10 Core 16 Threads', 'tersedia'),
(6, 7, 'Rexus DAIVA RX-D68', 429000, 'q8q3BdSD1HsjEYvujiHE.jpg', 'Outemu Mechanical Keyboard Gaming - Putih, Brown Switch', 'tersedia'),
(7, 7, 'Keychron K2', 1104000, 'Av2opD4xu0hqPK3Rrkbe.jpg', 'WHITE Backlight PLASTIC Frame Wireless Mechanical Keyboard - Red Switch', 'tersedia'),
(8, 7, 'Fantech MAXPOWER MK853', 479000, 'Ka2QJ9GVFnFXfOp6bLuQ.jpg', 'Mechanical Keyboard Gaming - Blue Switch', 'tersedia'),
(9, 1, 'G.SKILL F4-3200C16D-16GVKB', 1145000, 'MPcqEcsu9LRHCZt5MZdm.jpg', 'RipjawsV 16GB (2x8GB) DDR4 3200MHz', 'tersedia'),
(10, 1, 'Memory G.SKILL - F4-3200C16D-16GTZN Trident Z Neo', 1780000, 'gnJrDiLMzNyYZgeVZquD.png', '                    16GB (2x8GB) DDR4                ', 'tersedia'),
(11, 8, 'Logitech G102 V2 Lightsync', 230000, 'uAFbSM3tY0W8i5DhCPc0.jpg', 'Gaming Mouse - Hitam', 'tersedia'),
(12, 8, 'Logitech G PRO X SUPERLIGHT', 1889000, 'xffF1ekZO40RWZ7gfmoI.jpg', '                    Mouse Gaming Wireless E-Sports - Putih &amp; HItam                ', 'tersedia'),
(13, 8, 'RAZER Deathadder V2', 749000, '6ZdOrFr60QK6z5sddFcb.jpg', 'True 20,000 DPI Focus+ optical sensor', 'tersedia'),
(14, 2, 'Monitor LED SPC SM-19HD', 967000, '035WinEVINFvbC098CiT.jpg', '19 Inch VGA HDMI Garansi Resmi', 'tersedia'),
(15, 5, 'ASUS GeForce RTX 2060', 8853000, '4JJbO4A7G6rNF0DRsjUG.png', 'Dual OC RTX2060 6GB GDDR6 VGA Nvidia', 'tersedia'),
(16, 2, 'Xiaomi Monitor Gaming', 5825000, 'NoSGoTXEGFTkDq9oFE14.jpg', '144Hz 34 inch Curved WQHD Original LED', 'tersedia'),
(17, 2, 'LG 24 LED 24GN600-B', 2775000, 'BAp8v7uNtfEjOb0NzMYn.jpg', 'Gaming UltraGear 144Hz IPS - Response Time 1ms', 'tersedia'),
(18, 6, 'AMD Ryzen 3 3200G', 2951000, 'mwXepeh4FuuRNsoJzqvh.png', '3200 G Tray + Original Fan', 'tersedia'),
(19, 6, 'AMD RYZEN 5 5600X', 4079000, '51NuI7Vjvd6B8vzdXelF.jpg', 'Processor AMD AM4 Zen 3 Vermeer 6 Cores 12 Threads - Tray', 'tersedia'),
(20, 6, 'Intel core i5 10400F', 1820000, '40QYHOYxpzJFMbx8FKYw.jpg', 'BOX Socket 1200 NEW ITEM !!!', 'tersedia'),
(21, 4, 'HP Pav Gaming 15-ec2047AX', 12799000, 'IfiU9vdF5lnamlFUORBj.png', 'Laptop/Ryzen 5/8GB/NVIDIARTX1650/512GBSSD', 'tersedia'),
(22, 4, 'LENOVO Legion 5 Pro Ryzen 7 5800H', 22999000, 'Uk2lQaBNNrqxU23ISgJF.jpg', 'RTX3060 1TB SSD 16GB 16&quot; WQXGA W11 - Tanpa headset', 'tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2a$12$dlR1BexETMClrkNknpvCA.1XbIIP8ZUQn.DylTHuqSCw5QFtOQnLO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idp`),
  ADD KEY `namak` (`namak`),
  ADD KEY `kategori_produk` (`kategori_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `idp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `kategori_produk` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
