-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-01-2024 a las 16:40:26
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectofinal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_menu`
--

CREATE TABLE `detalle_menu` (
  `id_detalle` bigint(20) NOT NULL,
  `menuid` bigint(20) NOT NULL,
  `productoid` bigint(20) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_menu`
--

INSERT INTO `detalle_menu` (`id_detalle`, `menuid`, `productoid`, `cantidad`) VALUES
(1, 5, 1, 0),
(2, 5, 1, 0),
(3, 5, 1, 0),
(4, 5, 1, 10),
(5, 5, 1, 10),
(6, 1, 1, 10),
(7, 1, 2, 5),
(8, 1, 1, 10),
(9, 1, 7, 10),
(10, 6, 1, 40),
(11, 6, 7, 50),
(12, 3, 2, 100),
(13, 2, 7, 100),
(14, 7, 1, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `idinventario` bigint(20) NOT NULL,
  `productoid` bigint(20) NOT NULL,
  `fecha_ingreso` varchar(10) NOT NULL,
  `stock` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`idinventario`, `productoid`, `fecha_ingreso`, `stock`, `status`) VALUES
(1, 1, '10-01-2024', 10, 1),
(2, 1, '11-01-2024', 10, 1),
(3, 7, '12-01-2024', 50, 1),
(4, 2, '15-01-2024', 50, 1),
(5, 1, '15-01-2024', 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `idmenu` bigint(20) NOT NULL,
  `personaid` bigint(20) NOT NULL,
  `dia` varchar(20) NOT NULL,
  `nombre_plato` varchar(50) NOT NULL,
  `horario` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`idmenu`, `personaid`, `dia`, `nombre_plato`, `horario`, `tipo`, `fecha`, `status`) VALUES
(1, 1, 'Domingo', 'Pasta con pollo', 1, 2, '2023-12-10', 2),
(2, 1, 'Domingo', 'Pasta con pollo', 1, 2, '2023-12-10', 1),
(3, 1, 'Domingo', 'Prueba', 1, 1, '2023-12-10', 1),
(4, 1, 'Domingo', 'Prueba 3', 1, 1, '2023-12-10', 1),
(5, 1, 'Miercoles', 'Arroz chino', 2, 2, '2023-12-20', 1),
(6, 2, 'Viernes', 'pizza', 2, 2, '2024-01-12', 1),
(7, 1, 'Domingo', 'Pasta con mortadela', 2, 2, '2024-01-14', 7),
(8, 1, 'Domingo', 'Arepas con queso', 1, 1, '2024-01-14', 1),
(9, 1, 'Domingo', 'Hallacas', 2, 2, '2024-01-14', 1),
(10, 1, 'Domingo', 'Pan de queso', 2, 2, '2024-01-14', 1),
(11, 1, 'Domingo', 'Arroz con pollo', 2, 2, '2024-01-14', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `idmodulo` bigint(20) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`idmodulo`, `titulo`, `descripcion`, `status`) VALUES
(1, 'Dashboard', 'Dashboard', 1),
(2, 'Usuarios', 'Usuarios del Sistema', 1),
(3, 'Productos', 'Productos del Programa de alimentación escolar', 1),
(4, 'Inventario', 'Inventario', 1),
(5, 'Menús', 'Menús', 1),
(6, 'Reportes', 'Reportes', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idpermiso` bigint(20) NOT NULL,
  `rolid` bigint(20) NOT NULL,
  `moduloid` bigint(20) NOT NULL,
  `r` int(11) NOT NULL,
  `w` int(11) NOT NULL,
  `u` int(11) NOT NULL,
  `d` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idpermiso`, `rolid`, `moduloid`, `r`, `w`, `u`, `d`) VALUES
(7, 2, 1, 1, 1, 1, 0),
(8, 2, 2, 1, 1, 1, 0),
(9, 2, 3, 1, 1, 1, 1),
(10, 2, 4, 1, 1, 1, 1),
(11, 2, 5, 1, 1, 1, 1),
(214, 4, 1, 1, 0, 0, 0),
(215, 4, 2, 1, 0, 0, 0),
(216, 4, 3, 1, 0, 0, 0),
(217, 4, 4, 1, 0, 0, 0),
(218, 4, 5, 0, 0, 0, 0),
(276, 1, 1, 1, 1, 1, 1),
(277, 1, 2, 1, 1, 1, 1),
(278, 1, 3, 1, 1, 1, 1),
(279, 1, 4, 1, 1, 1, 1),
(280, 1, 5, 1, 1, 1, 1),
(281, 1, 6, 1, 1, 1, 1),
(282, 3, 1, 1, 1, 1, 0),
(283, 3, 2, 0, 0, 0, 0),
(284, 3, 3, 1, 1, 1, 1),
(285, 3, 4, 1, 1, 1, 1),
(286, 3, 5, 0, 1, 1, 1),
(287, 3, 6, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idpersona` bigint(20) NOT NULL,
  `nacionalidad` char(1) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `password` varchar(75) NOT NULL,
  `token` varchar(100) NOT NULL,
  `rolid` bigint(20) NOT NULL,
  `datecreated` date NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idpersona`, `nacionalidad`, `cedula`, `nombre`, `apellido`, `telefono`, `correo`, `password`, `token`, `rolid`, `datecreated`, `status`) VALUES
(1, 'V', '26838485', 'Marwin', 'Perdomo', 4263363650, 'perdomomarwin@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', 1, '2023-12-05', 1),
(2, 'V', '30712093', 'Felianni Valentina', 'Alvarado', 4242108281, 'felianni.apba@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', 1, '2023-12-05', 1),
(3, 'V', '14197690', 'Mayelin', 'Vivas', 4241936994, 'mayelinnvivas@hotmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', 1, '2023-12-07', 0),
(4, 'V', '32159635', 'Darwin Alejandro', 'Perdomo', 4167260328, 'darwinalejandro@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', 2, '2023-12-07', 0),
(5, 'V', '12639634', 'Marwin', 'Sierra', 424156734, 'sierra@gmail.com', '13370f63b23f85213b620c330247c68dc78d2a0e2fa80f5959169fb1abfc81f2', '', 1, '2023-12-07', 0),
(6, 'V', '32262814', 'Mariana', 'Perdomo', 424165494, 'mari@hotmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', 2, '2023-12-07', 0),
(7, 'V', '12414', 'Asdhshf', 'Afsdhfh', 47856654, 'dsahgh@info.com', '86bc7fdce8155cd4812899b2fedaafa12afc85f7b8d1dfd48ab171d1ab6aea9a', '', 2, '2023-12-07', 0),
(9, 'E', '80456123', 'Prueba', 'Prueba Apellido', 2124823740, 'prueba@info.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', 4, '2023-12-08', 0),
(10, 'V', '301578992', 'Darwin', 'Perdomo', 424123897, 'darwin@hotmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', 2, '2024-01-12', 1),
(11, 'V', '804561', 'Mariana Valentina', 'Perdomo', 4164671235, 'mariana@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', 3, '2024-01-12', 1),
(12, 'V', '606975348', 'Maye', 'Vivas Vias', 412496843, 'maye@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '', 4, '2024-01-17', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idproducto` bigint(20) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idproducto`, `nombre`, `descripcion`, `datecreated`, `status`) VALUES
(1, 'Pansito', 'pan de queso', '2023-12-07 23:46:56', 1),
(2, 'Nutrichicha', 'clap', '2023-12-07 23:58:11', 1),
(3, 'Prueba', 'prueba definitivamente', '2023-12-07 23:58:24', 0),
(4, 'Prueba Dos', 'prueba', '2023-12-08 02:49:49', 0),
(5, 'Ejemplo 1', 'ejemplo 3', '2023-12-08 04:05:49', 0),
(6, 'La Que Frao', 'frao', '2023-12-09 02:15:55', 0),
(7, 'Pasta', 'pasta revolucionaria', '2024-01-12 18:53:03', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` bigint(20) NOT NULL,
  `nombrerol` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `nombrerol`, `descripcion`, `status`) VALUES
(1, 'Administrador', 'Administrador del Sistema', 1),
(2, 'Directivo', 'Directores del Plantel', 1),
(3, 'Jefe de Cocina', 'Jefe, de la cocina encargado del manejo del sistema', 1),
(4, 'Cocinero', 'Cocinero', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_menu`
--
ALTER TABLE `detalle_menu`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `menuid` (`menuid`),
  ADD KEY `productoid` (`productoid`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`idinventario`),
  ADD KEY `productoid` (`productoid`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`idmenu`),
  ADD KEY `personaid` (`personaid`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`idmodulo`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idpermiso`),
  ADD KEY `rolid` (`rolid`),
  ADD KEY `moduloid` (`moduloid`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idpersona`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `rolid` (`rolid`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idproducto`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_menu`
--
ALTER TABLE `detalle_menu`
  MODIFY `id_detalle` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `idinventario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `idmenu` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `idmodulo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idpermiso` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idpersona` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idproducto` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_menu`
--
ALTER TABLE `detalle_menu`
  ADD CONSTRAINT `detalle_menu_ibfk_1` FOREIGN KEY (`menuid`) REFERENCES `menus` (`idmenu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_menu_ibfk_2` FOREIGN KEY (`productoid`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`productoid`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`personaid`) REFERENCES `persona` (`idpersona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`moduloid`) REFERENCES `modulo` (`idmodulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
