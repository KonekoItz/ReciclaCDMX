-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2026 a las 04:15:23
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
-- Base de datos: `recicla_cdmx`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recolecciones`
--

CREATE TABLE `recolecciones` (
  `id_solicitud` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre_contacto` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` text NOT NULL,
  `motivo` varchar(50) NOT NULL,
  `dia_agendado` varchar(20) NOT NULL,
  `materiales` text NOT NULL,
  `estado_solicitud` varchar(30) DEFAULT 'Pendiente',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recolecciones`
--

INSERT INTO `recolecciones` (`id_solicitud`, `id_usuario`, `nombre_contacto`, `telefono`, `direccion`, `motivo`, `dia_agendado`, `materiales`, `estado_solicitud`, `fecha_creacion`) VALUES
(1, 1, 'koneko', '5528762375', 'dolores guerrero edificio 3A dpto 402, CP. 04480 Coyoacán DF.', 'Sin transporte', 'Sábado', 'cajas y plastico', 'En proceso', '2026-11-17 02:56:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `correo`, `password`, `rol`) VALUES
(1, 'Koneko Recicla', 'neko@recicla.com', '$2y$10$ApykVfpfRk2KWjJdJ/mjD.4fo2LpOq/d3tm0NcVQSBo.KEzj.oBFe', 'registrado'),
(2, 'Itza Admin', 'admin@recicla.com', '$2y$10$S34BGOI61qihvNGoLOqy3uKsgNOBLLQE5ZB3iui0KJLHqaO2KlF0C', 'administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `recolecciones`
--
ALTER TABLE `recolecciones`
  ADD PRIMARY KEY (`id_solicitud`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `recolecciones`
--
ALTER TABLE `recolecciones`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `recolecciones`
--
ALTER TABLE `recolecciones`
  ADD CONSTRAINT `recolecciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
