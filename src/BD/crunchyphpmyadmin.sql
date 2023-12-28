-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-12-2023 a las 20:27:45
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crunchydb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id_pedido` int(11) DEFAULT NULL,
  `id_plato` int(11) DEFAULT NULL,
  `unidades` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `mesa` int(11) DEFAULT NULL,
  `estado_pedido` enum('Pendiente','Confirmado','Completado') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_hora_pedido` datetime DEFAULT NULL,
  `id_reserva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos`
--

CREATE TABLE `platos` (
  `id_plato` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ingredientes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoria` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subcategoria` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio` decimal(5,2) DEFAULT NULL,
  `estado` enum('activado','desactivado') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `platos`
--

INSERT INTO `platos` (`id_plato`, `nombre`, `ingredientes`, `categoria`, `subcategoria`, `precio`, `estado`) VALUES
(43, 'enchiladas de pollo rojas', 'Tres flautas de maíz rellenas de pollo bañadas en ricas salsas cubiertas de queso', 'entrante', 'enchiladas', '14.90', 'activado'),
(44, 'enchiladas de pollo verdes', 'Tres flautas de maíz con pollo bañadas en rica salsa y cubiertas de queso', 'entrante', 'enchiladas', '14.90', 'activado'),
(47, 'enchiladas de pollo de mole', 'Tres flautas de maíz rellenas de pollo bañadas en rica salsa y cubiertas de queso', 'entrante', 'enchiladas', '14.90', 'activado'),
(49, 'fajitas de pollo', 'Tiras de pollo adobadas con verduras a la plancha', 'principal', 'fajitas', '11.90', 'activado'),
(50, 'tacos al pastor', 'Carne de cerdo adobada en trompo. Adobada con chile, especias, cilantro y piña', 'principal', 'tacos', '12.50', 'activado'),
(51, 'tarta de limón', 'Deliciosa tarta de limón a base de galleta, con merengue', 'postre', 'nachos', '6.90', 'activado'),
(52, 'sorbete de limón y tequila', 'Acaba con un refrescante y alegre sorbete', 'postre', 'sorbetes', '6.90', 'activado'),
(53, 'margarita frozen', 'Tequila, triple seco, limón fresco. Jarra de 1L', 'bebida', 'margaritas', '23.95', 'activado'),
(54, 'café con leche', '', 'bebida', 'cafe', '2.95', 'activado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `mesa` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_hora_reserva` datetime DEFAULT NULL,
  `personas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Disparadores `reservas`
--
DELIMITER $$
CREATE TRIGGER `tr_actualizar_pedidos` AFTER UPDATE ON `reservas` FOR EACH ROW BEGIN
    UPDATE pedidos
    SET mesa = NEW.mesa, 
        fecha_hora_pedido = NEW.fecha_hora_reserva
    WHERE id_reserva = NEW.id_reserva;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restar`
--

CREATE TABLE `restar` (
  `id_plato` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `restar`
--

INSERT INTO `restar` (`id_plato`, `id_producto`, `cantidad`) VALUES
(NULL, 1, '0.20'),
(NULL, 2, '0.50'),
(NULL, 3, '3.00'),
(NULL, 1, '0.20'),
(NULL, 2, '0.50'),
(NULL, 3, '3.00'),
(NULL, 1, '0.20'),
(NULL, 2, '0.50'),
(NULL, 3, '3.00'),
(NULL, 1, '0.13'),
(NULL, 2, '0.10'),
(NULL, 1, '0.20'),
(NULL, 2, '0.30'),
(NULL, 3, '5.00'),
(NULL, 1, '0.40'),
(NULL, 2, '0.40'),
(NULL, 3, '6.00'),
(NULL, 1, '3.00'),
(NULL, 2, '2.00'),
(NULL, 3, '4.00'),
(NULL, 1, '1.00'),
(NULL, 3, '1.00'),
(NULL, 1, '3.00'),
(NULL, 1, '1.00'),
(NULL, 2, '0.20'),
(NULL, 3, '3.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(5,2) NOT NULL,
  `cantidad` decimal(5,2) NOT NULL
) ;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`id_producto`, `nombre_producto`, `precio`, `cantidad`) VALUES
(1, 'Lechuga', '0.50', '20.00'),
(2, 'Pollo', '6.00', '9.50'),
(3, 'Tortita', '1.00', '100.00'),
(4, 'Tomate', '5.00', '20.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contrasena` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` enum('admin','cocinero','camarero') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellidos`, `contrasena`, `rol`, `email`) VALUES
(1, 'Sancho', 'Panza', '1234', 'admin', 'sancho@crunchy.com'),
(2, 'Alonso', 'Quijano', '1234', 'cocinero', 'quijote@quijote.com'),
(3, 'Dulcinea', 'del Toboso', '1234', 'camarero', 'dulcinea@crunchy.com'),
(4, 'Pepe', 'De la Torre', '1234', 'camarero', 'pepe@crunchy.com'),
(5, 'Beatriz', 'Fernandez', '1234', 'camarero', 'bea@crunchy.com'),
(6, 'Rocinante', 'Exposito', '1234', 'admin', 'rocinante@crunchy.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD UNIQUE KEY `id_plato` (`id_plato`,`id_pedido`),
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_reserva` (`id_reserva`);

--
-- Indices de la tabla `platos`
--
ALTER TABLE `platos`
  ADD PRIMARY KEY (`id_plato`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `restar`
--
ALTER TABLE `restar`
  ADD KEY `id_plato` (`id_plato`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `nombre_producto` (`nombre_producto`) USING HASH;

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `platos`
--
ALTER TABLE `platos`
  MODIFY `id_plato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`id_plato`) REFERENCES `platos` (`id_plato`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_reserva`) REFERENCES `reservas` (`id_reserva`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `restar`
--
ALTER TABLE `restar`
  ADD CONSTRAINT `restar_ibfk_1` FOREIGN KEY (`id_plato`) REFERENCES `platos` (`id_plato`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `restar_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `stock` (`id_producto`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
