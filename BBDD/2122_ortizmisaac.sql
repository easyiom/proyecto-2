-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-12-2021 a las 23:45:20
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_restaurante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_mantenimiento`
--

CREATE TABLE `tbl_mantenimiento` (
  `id_inci` int(11) NOT NULL,
  `datos_inci` text DEFAULT NULL,
  `fecha_ini_inci` datetime NOT NULL,
  `fecha_fin_inci` datetime DEFAULT NULL,
  `id_mes_fk` int(11) NOT NULL,
  `id_use_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_mantenimiento`
--

INSERT INTO `tbl_mantenimiento` (`id_inci`, `datos_inci`, `fecha_ini_inci`, `fecha_fin_inci`, `id_mes_fk`, `id_use_fk`) VALUES
(1, 'hola que ase', '2021-11-10 15:06:45', '2021-11-17 15:06:45', 1, 4),
(2, 'ewewe', '2021-11-10 15:15:42', '2021-11-10 15:51:01', 43, 4),
(3, 'ldshfslfsdf', '2021-11-10 15:17:22', '2021-11-10 15:51:18', 8, 4),
(4, 'dst', '2021-11-10 15:57:53', '2021-11-10 17:11:07', 1, 4),
(5, 'ufg', '2021-11-10 17:11:46', '2021-11-10 17:12:59', 32, 4),
(6, 'tyfghv', '2021-11-10 17:13:15', '2021-11-10 17:13:22', 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_mesa`
--

CREATE TABLE `tbl_mesa` (
  `id_mes` int(11) NOT NULL,
  `status_mes` enum('Libre','Mantenimiento','Ocupado/Reservado') NOT NULL,
  `capacidad_mes` int(3) NOT NULL,
  `id_sal_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_mesa`
--

INSERT INTO `tbl_mesa` (`id_mes`, `status_mes`, `capacidad_mes`, `id_sal_fk`) VALUES
(1, 'Libre', 2, 1),
(2, 'Libre', 2, 1),
(3, 'Libre', 2, 1),
(4, 'Libre', 2, 1),
(5, 'Libre', 2, 1),
(6, 'Libre', 2, 1),
(7, 'Libre', 2, 1),
(8, 'Libre', 2, 1),
(9, 'Libre', 2, 1),
(10, 'Libre', 2, 1),
(11, 'Libre', 2, 1),
(12, 'Libre', 2, 1),
(13, 'Libre', 4, 1),
(14, 'Libre', 4, 1),
(15, 'Libre', 2, 2),
(16, 'Libre', 2, 2),
(17, 'Libre', 2, 2),
(18, 'Libre', 2, 2),
(19, 'Libre', 4, 2),
(20, 'Libre', 4, 2),
(21, 'Libre', 4, 2),
(22, 'Libre', 4, 2),
(23, 'Libre', 6, 2),
(24, 'Libre', 6, 2),
(25, 'Libre', 6, 2),
(26, 'Libre', 10, 2),
(27, 'Libre', 2, 3),
(28, 'Libre', 2, 3),
(29, 'Libre', 4, 3),
(30, 'Libre', 4, 3),
(31, 'Libre', 4, 3),
(32, 'Libre', 4, 3),
(33, 'Libre', 4, 3),
(34, 'Libre', 4, 3),
(35, 'Libre', 2, 4),
(36, 'Libre', 2, 4),
(37, 'Libre', 4, 4),
(38, 'Libre', 4, 4),
(39, 'Libre', 4, 4),
(40, 'Libre', 6, 4),
(41, 'Libre', 6, 4),
(42, 'Libre', 2, 5),
(43, 'Libre', 2, 5),
(44, 'Libre', 4, 5),
(45, 'Libre', 4, 5),
(46, 'Libre', 4, 5),
(47, 'Libre', 2, 5),
(48, 'Libre', 4, 2),
(49, 'Libre', 4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_reserva`
--

CREATE TABLE `tbl_reserva` (
  `id_res` int(11) NOT NULL,
  `horaIni_res` datetime NOT NULL,
  `horaFin_res` datetime DEFAULT NULL,
  `datos_res` varchar(30) NOT NULL,
  `id_use_fk` int(11) NOT NULL,
  `id_mes_fk` int(11) NOT NULL,
  `estado_res` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_reserva`
--

INSERT INTO `tbl_reserva` (`id_res`, `horaIni_res`, `horaFin_res`, `datos_res`, `id_use_fk`, `id_mes_fk`, `estado_res`) VALUES
(45, '2021-12-13 18:04:21', '2021-12-13 18:18:19', 'qwd', 2, 12, 1),
(47, '2021-12-18 21:06:02', '2021-12-18 21:06:20', 'Hola queta2', 2, 25, 1),
(48, '2021-12-18 21:06:10', '2021-12-18 21:06:15', 'Hola quetal', 2, 23, 1),
(49, '2021-12-18 21:04:00', '2021-12-18 22:34:00', 'Caracla', 2, 21, 0),
(50, '2021-12-20 20:58:00', '2021-12-20 22:28:00', 'Hola que tal', 2, 28, 1),
(51, '2021-12-20 21:00:00', '2021-12-20 22:30:00', 'Hola que ase', 2, 29, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_sala`
--

CREATE TABLE `tbl_sala` (
  `id_sal` int(11) NOT NULL,
  `nombre_sal` varchar(50) DEFAULT NULL,
  `capacidad_sal` int(3) DEFAULT NULL,
  `imagen_sal` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_sala`
--

INSERT INTO `tbl_sala` (`id_sal`, `nombre_sal`, `capacidad_sal`, `imagen_sal`) VALUES
(1, 'Sala Romance2', 32, '2021-12-20-23-34-38_heart-dynamic-premium.png'),
(2, 'Salón Sol', 52, 'sun-dynamic-color.png'),
(3, 'Sala gourmet', 28, 'glass-dynamic-color.png'),
(4, 'Terraza Luna', 28, 'moon-dynamic-clay.png'),
(5, 'Terraza estrellas', 16, 'star-dynamic-color.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `id_use` int(11) NOT NULL,
  `nombre_use` varchar(45) DEFAULT NULL,
  `email_use` varchar(50) NOT NULL,
  `pwd_use` varchar(50) NOT NULL,
  `tipo_use` enum('Camarero','Admin','Mantenimiento') NOT NULL,
  `foto_use` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id_use`, `nombre_use`, `email_use`, `pwd_use`, `tipo_use`, `foto_use`) VALUES
(1, 'Alfredo', 'blumal@fje.edu', '81dc9bdb52d04dc20036dbd8313ed055', 'Camarero', NULL),
(2, 'Isaac', 'isaac@fje.edu', '81dc9bdb52d04dc20036dbd8313ed055', 'Admin', NULL),
(3, 'Raul', 'raulseleccion@fje.edu', '1fa3356b1eb65f144a367ff8560cb406', 'Camarero', NULL),
(4, 'Manolo', 'manolo@fje.edu', '827ccb0eea8a706c4c34a16891f84e7b', 'Mantenimiento', NULL),
(5, 'Sergio', 'sergio@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Camarero', NULL),
(11, 'Arnau', 'arnau@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Camarero', NULL),
(12, 'Merino', 'smerino@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Camarero', NULL),
(14, 'David', 'david@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Camarero', NULL),
(16, 'Victor', 'quesada@gmail.com', '202cb962ac59075b964b07152d234b70', 'Camarero', NULL),
(18, 'Paco', 'paco@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Camarero', NULL),
(19, 'Alan', 'alan@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Camarero', NULL),
(21, 'Pepe', 'pepelu@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Camarero', '../public/users/2021-12-20-21-17-30_descarga.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_mantenimiento`
--
ALTER TABLE `tbl_mantenimiento`
  ADD PRIMARY KEY (`id_inci`),
  ADD KEY `fk_mesa_inci` (`id_mes_fk`),
  ADD KEY `fk_usuario_inci` (`id_use_fk`);

--
-- Indices de la tabla `tbl_mesa`
--
ALTER TABLE `tbl_mesa`
  ADD PRIMARY KEY (`id_mes`),
  ADD KEY `fk_sala_mesa_idx` (`id_sal_fk`);

--
-- Indices de la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  ADD PRIMARY KEY (`id_res`),
  ADD KEY `fk_mesa_reserva_idx` (`id_mes_fk`),
  ADD KEY `fk_usuario_reserva_idx` (`id_use_fk`);

--
-- Indices de la tabla `tbl_sala`
--
ALTER TABLE `tbl_sala`
  ADD PRIMARY KEY (`id_sal`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`id_use`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_mantenimiento`
--
ALTER TABLE `tbl_mantenimiento`
  MODIFY `id_inci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_mesa`
--
ALTER TABLE `tbl_mesa`
  MODIFY `id_mes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  MODIFY `id_res` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `tbl_sala`
--
ALTER TABLE `tbl_sala`
  MODIFY `id_sal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `id_use` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_mantenimiento`
--
ALTER TABLE `tbl_mantenimiento`
  ADD CONSTRAINT `fk_mesa_inci` FOREIGN KEY (`id_mes_fk`) REFERENCES `tbl_mesa` (`id_mes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_inci` FOREIGN KEY (`id_use_fk`) REFERENCES `tbl_usuario` (`id_use`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_mesa`
--
ALTER TABLE `tbl_mesa`
  ADD CONSTRAINT `fk_sala_mesa` FOREIGN KEY (`id_sal_fk`) REFERENCES `tbl_sala` (`id_sal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  ADD CONSTRAINT `fk_mesa_reserva` FOREIGN KEY (`id_mes_fk`) REFERENCES `tbl_mesa` (`id_mes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_reserva` FOREIGN KEY (`id_use_fk`) REFERENCES `tbl_usuario` (`id_use`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
