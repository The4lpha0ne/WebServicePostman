-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2024 at 04:04 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `richardfvg_webservice`
--

-- --------------------------------------------------------

--
-- Table structure for table `tm_categoria`
--

CREATE TABLE `tm_categoria` (
  `cat_id` int(11) NOT NULL,
  `cat_nom` varchar(50) NOT NULL,
  `cat_obs` varchar(250) NOT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `tm_categoria`
--

INSERT INTO `tm_categoria` (`cat_id`, `cat_nom`, `cat_obs`, `est`) VALUES
(1, 'Televisores', 'Observación TV', 1),
(2, 'Refrigeradoras', 'Observación Refrigeradoras', 1),
(3, 'Cocinas', 'Observación TV', 1),
(4, 'Lavadoras', 'Observación Refrigeradoras', 1),
(5, 'Actualizacion', 'Actualizacion Obs', 1),
(6, 'Envio Desde Postman', 'Envio Obs Postman', 1),
(7, 'Envio Desde Postman2', 'Envio Obs Postman2', 1),
(8, 'Electrónicos', 'Observación Electrónicos', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tm_producto`
--

CREATE TABLE `tm_producto` (
  `prod_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `prod_nom` varchar(100) NOT NULL,
  `prod_desc` text DEFAULT NULL,
  `prod_precio` decimal(10,2) NOT NULL,
  `est` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tm_producto`
--

INSERT INTO `tm_producto` (`prod_id`, `cat_id`, `prod_nom`, `prod_desc`, `prod_precio`, `est`) VALUES
(1, 1, 'TV 4K actualizada', 'Descripción del TV 4K', '800.00', 1),
(2, 8, 'Monitor 4K', 'Descripción Monitor 4K', '300.00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tm_categoria`
--
ALTER TABLE `tm_categoria`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tm_producto`
--
ALTER TABLE `tm_producto`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tm_categoria`
--
ALTER TABLE `tm_categoria`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tm_producto`
--
ALTER TABLE `tm_producto`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tm_producto`
--
ALTER TABLE `tm_producto`
  ADD CONSTRAINT `tm_producto_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `tm_categoria` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
