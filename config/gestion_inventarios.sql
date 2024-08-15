-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-08-2024 a las 07:20:08
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestion_inventarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cambios`
--

CREATE TABLE `cambios` (
  `id` int(11) NOT NULL,
  `tabla` varchar(50) DEFAULT NULL,
  `campo` varchar(50) DEFAULT NULL,
  `valor_anterior` varchar(255) DEFAULT NULL,
  `valor_nuevo` varchar(255) DEFAULT NULL,
  `registro_id` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_registro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cambios`
--

INSERT INTO `cambios` (`id`, `tabla`, `campo`, `valor_anterior`, `valor_nuevo`, `registro_id`, `fecha`, `id_registro`) VALUES
(1, 'productos', 'nombre', 'Sprite', 'Coca Cola', 2, '2024-08-15 04:08:25', 0),
(2, 'productos', 'precio', '15.00', '10', 2, '2024-08-15 04:08:25', 0),
(3, 'productos', 'stock', '20', '15', 2, '2024-08-15 04:08:25', 0),
(4, 'productos', 'nombre', 'Coca Cola', 'Sprite', 2, '2024-08-15 04:10:07', 0),
(5, 'productos', 'precio', '10.00', '15', 2, '2024-08-15 04:10:07', 0),
(6, 'productos', 'stock', '15', '20', 3, '2024-08-15 04:10:35', 0),
(7, 'productos', 'nombre', 'Sprite', 'Coca Cola', 2, '2024-08-15 04:11:13', 0),
(8, 'productos', 'descripcion', 'Gaseosas', 'Gaseosa', 2, '2024-08-15 04:11:13', 0),
(9, 'productos', 'precio', '15.00', '12', 2, '2024-08-15 04:11:13', 0),
(10, 'productos', 'stock', '15', '10', 2, '2024-08-15 04:11:13', 0),
(11, 'productos', 'precio', '12.00', '12.25', 2, '2024-08-15 04:12:42', 0),
(12, 'proveedores', 'nombre', 'Coca - Cola', 'Coca - Cola', NULL, '2024-08-15 04:18:22', 0),
(13, 'proveedores', 'direccion', 'Ibarra', 'Ibarra', NULL, '2024-08-15 04:18:22', 0),
(14, 'proveedores', 'telefono', '0999738698', '0999738698', NULL, '2024-08-15 04:18:22', 0),
(15, 'proveedores', 'email', 'bryan_zac22@hotmail.com', 'bryan_zac22@hotmail.com', NULL, '2024-08-15 04:18:22', 0),
(16, 'proveedores', 'direccion', 'Ibarra', 'Otavalo', NULL, '2024-08-15 04:19:13', 0),
(17, 'ordenes_compra', 'estado', 'Completa', 'Pendiente', NULL, '2024-08-15 05:16:49', 1),
(18, 'ordenes_compra', 'estado', 'Cancelada', 'Pendiente', NULL, '2024-08-15 05:17:32', 3),
(19, 'ordenes_compra', 'estado', 'Pendiente', 'Cancelada', NULL, '2024-08-15 05:18:11', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_compra`
--

CREATE TABLE `ordenes_compra` (
  `id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `estado` enum('Pendiente','Completa','Cancelada') DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ordenes_compra`
--

INSERT INTO `ordenes_compra` (`id`, `proveedor_id`, `fecha`, `total`, `estado`) VALUES
(1, 1, '2024-08-17', 500.50, 'Pendiente'),
(2, 2, '2024-08-11', 152.75, 'Completa'),
(3, 1, '2024-08-15', 200.00, 'Cancelada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `producto_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `proveedor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`producto_id`, `nombre`, `descripcion`, `precio`, `stock`, `proveedor_id`) VALUES
(2, 'Coca Cola', 'Gaseosa', 12.25, 10, NULL),
(3, 'Leche', 'Lacteos', 2.00, 20, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `proveedor_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`proveedor_id`, `nombre`, `direccion`, `telefono`, `email`) VALUES
(1, 'Coca - Cola', 'Otavalo', '0999738698', 'bryan_zac22@hotmail.com'),
(2, 'Nestle', 'Ibarra', '0999785988', 'brytektwitch@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cambios`
--
ALTER TABLE `cambios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ordenes_compra`
--
ALTER TABLE `ordenes_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proveedor_id` (`proveedor_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`producto_id`),
  ADD KEY `proveedor_id` (`proveedor_id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`proveedor_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cambios`
--
ALTER TABLE `cambios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `ordenes_compra`
--
ALTER TABLE `ordenes_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `producto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `proveedor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ordenes_compra`
--
ALTER TABLE `ordenes_compra`
  ADD CONSTRAINT `ordenes_compra_ibfk_1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`proveedor_id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`proveedor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
