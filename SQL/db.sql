-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-07-2020 a las 00:25:34
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bigbluepay`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customer_token`
--

CREATE TABLE `customer_token` (
  `id` int(11) NOT NULL,
  `id_client` varchar(20) NOT NULL,
  `last_four` int(4) NOT NULL,
  `customer_token` varchar(90) NOT NULL,
  `value` int(6) NOT NULL,
  `payed` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `customer_token`
--

INSERT INTO `customer_token` (`id`, `id_client`, `last_four`, `customer_token`, `value`, `payed`) VALUES
(1, 'John Doe', 0, '72297b129741d0660a930b685ea024cd3ac1ac9fc84d37be5a7dcbe3e4b11ec5', 0, 0),
(9, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(10, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(11, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(12, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(13, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(14, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(15, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(16, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(17, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(18, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(19, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(20, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(21, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(22, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(23, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(24, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(25, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(26, '1061705320', 75, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(27, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(28, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(29, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(30, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(31, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(32, '10617053202', 6075, 'e31f9fe5227d72e4a1eefdf50ddb7c1ac8390422d43d4df988de485f4f1f4fd5', 0, 0),
(33, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(34, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(35, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(36, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(37, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(38, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(39, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(40, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(41, '1061705320', 6075, 'e4996c6f45e721ed6e2dbaa14f86a531bb5713c633bb859e9b7a14ecd3a64f6e', 0, 0),
(42, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(43, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(44, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(45, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(46, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(47, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(48, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(49, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(50, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(51, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(52, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(53, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0),
(54, '1061705320', 6075, '542d39fb876ccb94a2b75afdebf36a97ca728884d3669baa5b67748bcaef4dc2', 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `customer_token`
--
ALTER TABLE `customer_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `customer_token`
--
ALTER TABLE `customer_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
