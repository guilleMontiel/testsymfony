-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: mysqlDB
-- Tiempo de generación: 06-04-2021 a las 10:52:37
-- Versión del servidor: 5.7.33
-- Versión de PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbGuille`
--
CREATE DATABASE IF NOT EXISTS `dbGuille` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dbGuille`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_sector`
--

CREATE TABLE `cliente_sector` (
  `id` int(11) NOT NULL,
  `id_user_id` int(11) NOT NULL,
  `id_sector_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `sector_id` int(11) DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `sector_id`, `nombre`, `telefono`, `email`) VALUES
(1, 2, 'CGM IT', '+54224445667', 'guillemontiel@cgmit.com'),
(2, 1, 'HORIZONTE SEGUROS S.A', '44556677', 'horizonte@horizonte.com'),
(5, 5, 'Bull Market', '99987722111', 'bull@market.com'),
(6, 2, 'Globant', NULL, 'globant@globant.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sector`
--

CREATE TABLE `sector` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sector`
--

INSERT INTO `sector` (`id`, `nombre`) VALUES
(1, 'Seguros Generales'),
(2, 'SIstemas'),
(3, 'Transportes'),
(4, 'Metales'),
(5, 'Finanzas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nombre`) VALUES
(1, 'jose@cliente.com', '[\"ROLE_CLIENTE\"]', '$argon2id$v=19$m=65536,t=4,p=1$ujMbnz4qGQi/YeWhtuwA/g$VzmEOhSfeuvXXJNn6J8VVTrsEDN7fXktLtzeVeKoIEY', 'Jose'),
(3, 'guille@admin.com', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$ujMbnz4qGQi/YeWhtuwA/g$VzmEOhSfeuvXXJNn6J8VVTrsEDN7fXktLtzeVeKoIEY', 'Guillermo'),
(4, 'belen@cliente.com', '[\"ROLE_CLIENTE\"]', '$argon2id$v=19$m=65536,t=4,p=1$yY+lfzZVTF8nQPH8D9EJrA$hZOrxMUjzWMlVkWKu9q8J0za9s9R+zt+oE12CxBjVaA', 'Belen'),
(5, 'estefi@cliente.com', '[\"ROLE_CLIENTE\"]', '$argon2id$v=19$m=65536,t=4,p=1$yY+lfzZVTF8nQPH8D9EJrA$hZOrxMUjzWMlVkWKu9q8J0za9s9R+zt+oE12CxBjVaA', 'Estefania'),
(6, 'nuevo@cliente.com', '[\"ROLE_CLIENTE\"]', '$argon2id$v=19$m=65536,t=4,p=1$QSHASmtN1D/9BccfbfP3xg$b1eAgsvLr2FnsiaZoIVgqdYhWZCCkyRhQjLI7hUflRk', 'juan perez');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente_sector`
--
ALTER TABLE `cliente_sector`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F4A035A379F37AE5` (`id_user_id`),
  ADD KEY `IDX_F4A035A35EA07440` (`id_sector_id`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B8D75A50DE95C867` (`sector_id`);

--
-- Indices de la tabla `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente_sector`
--
ALTER TABLE `cliente_sector`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `sector`
--
ALTER TABLE `sector`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente_sector`
--
ALTER TABLE `cliente_sector`
  ADD CONSTRAINT `FK_F4A035A35EA07440` FOREIGN KEY (`id_sector_id`) REFERENCES `sector` (`id`),
  ADD CONSTRAINT `FK_F4A035A379F37AE5` FOREIGN KEY (`id_user_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `FK_B8D75A50DE95C867` FOREIGN KEY (`sector_id`) REFERENCES `sector` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
