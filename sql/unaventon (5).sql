-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-06-2018 a las 19:43:50
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `unaventon`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auto`
--

CREATE TABLE `auto` (
  `patente` varchar(7) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `modelo` varchar(20) NOT NULL,
  `capasidad` int(11) NOT NULL,
  `color` varchar(20) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `activo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `auto`
--

INSERT INTO `auto` (`patente`, `marca`, `modelo`, `capasidad`, `color`, `tipo`, `activo`) VALUES
('aa111aa', 'ford', 'focus', 4, 'blanco', 'Auto', 1),
('aa222aa', 'asdasd', 'asdasd', 3, 'asdasd', 'Combi', 1),
('aa333aa', 'Mercedez', 'asdasd', 4, 'negro', 'Auto', 1),
('aaa111', 'toyota', 'asdasd', 3, 'negro', 'Camioneta', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `texto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion_pendiente`
--

CREATE TABLE `calificacion_pendiente` (
  `id` int(11) NOT NULL,
  `idUsuariocalificador` int(11) NOT NULL,
  `idusuarioACalificar` int(11) NOT NULL,
  `activo` tinyint(4) NOT NULL,
  `esAConductor` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conductor`
--

CREATE TABLE `conductor` (
  `idUsuario` int(11) NOT NULL,
  `calificacionPos` int(11) NOT NULL,
  `calificacionNeg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `conductor`
--

INSERT INTO `conductor` (`idUsuario`, `calificacionPos`, `calificacionNeg`) VALUES
(1, 0, 0),
(2, 0, 0),
(3, 0, 0),
(5, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotoauto`
--

CREATE TABLE `fotoauto` (
  `patente` varchar(7) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `idUsuario` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idViaje` int(11) NOT NULL,
  `texto` text NOT NULL,
  `respuesta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion`
--

CREATE TABLE `notificacion` (
  `idUsuario` int(11) NOT NULL,
  `texto` text NOT NULL,
  `leido` tinyint(4) NOT NULL,
  `fechaNoti` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notificacion`
--

INSERT INTO `notificacion` (`idUsuario`, `texto`, `leido`, `fechaNoti`) VALUES
(3, 'Un usuario se postulo a tu <a href=\"http://localhost/unAventon/detalle-viaje.php?idViaje=3\">viaje</a> desde: asdasd hasta: asdasd', 1, '2018-06-27 13:36:45'),
(1, 'su solicitud para unirse al <a href=\"http://localhost/unAventon/detalle-viaje.php?idViaje=3\">viaje</a> desde: asdasd hasta:asdasd fue aceptada', 1, '2018-06-27 13:37:11'),
(2, 'Un usuario se postulo a tu <a href=\"http://localhost/unAventon/detalle-viaje.php?idViaje=5\">viaje</a> desde: asdasd hasta: tandil', 1, '2018-06-27 14:04:43'),
(4, 'su solicitud para unirse al <a href=\"http://localhost/unAventon/detalle-viaje.php?idViaje=5\">viaje</a> desde: asdasd hasta:tandil fue aceptada', 0, '2018-06-27 14:05:53'),
(3, 'Un usuario se postulo a tu <a href=\"http://localhost/unAventon/detalle-viaje.php?idViaje=3\">viaje</a> desde: asdasd hasta: asdasd', 0, '2018-06-27 14:37:39'),
(3, 'Un usuario se postulo a tu <a href=\"http://localhost/unAventon/detalle-viaje.php?idViaje=3\">viaje</a> desde: asdasd hasta: asdasd', 0, '2018-06-27 14:39:11'),
(3, 'Un usuario se postulo a tu <a href=\"http://localhost/unAventon/detalle-viaje.php?idViaje=3\">viaje</a> desde: asdasd hasta: asdasd', 0, '2018-06-27 14:40:44'),
(3, 'Un usuario se postulo a tu <a href=\"http://localhost/unAventon/detalle-viaje.php?idViaje=3\">viaje</a> desde: asdasd hasta: asdasd', 0, '2018-06-27 14:43:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_pendiente`
--

CREATE TABLE `pago_pendiente` (
  `id` int(11) NOT NULL,
  `idUsuarioDeudor` int(11) NOT NULL,
  `idusuarioCobrador` int(11) NOT NULL,
  `activo` tinyint(4) NOT NULL,
  `monto` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postula`
--

CREATE TABLE `postula` (
  `idUsuario` int(11) NOT NULL,
  `idViaje` int(11) NOT NULL,
  `eliminado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `postula`
--

INSERT INTO `postula` (`idUsuario`, `idViaje`, `eliminado`) VALUES
(1, 3, 0),
(4, 5, 0),
(7, 3, 1),
(8, 3, 1),
(9, 3, 1),
(10, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiene`
--

CREATE TABLE `tiene` (
  `idConductor` int(11) NOT NULL,
  `patente` varchar(7) NOT NULL,
  `activo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tiene`
--

INSERT INTO `tiene` (`idConductor`, `patente`, `activo`) VALUES
(1, 'aaa111', 1),
(2, 'aaa111', 1),
(3, 'aa111aa', 1),
(2, 'aa222aa', 1),
(5, 'aa333aa', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellido` varchar(25) NOT NULL,
  `fechanac` date NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `fondos` int(11) NOT NULL,
  `codigo_tarjeta` varchar(12) NOT NULL,
  `calificacionPos` int(11) NOT NULL,
  `calificacionNeg` int(11) NOT NULL,
  `activo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `correo`, `nombre`, `apellido`, `fechanac`, `contrasena`, `fondos`, `codigo_tarjeta`, `calificacionPos`, `calificacionNeg`, `activo`) VALUES
(1, 'prueba1@hotmail.es', 'prueba1', 'asdasd', '1996-03-09', '$2y$10$NKnQ641ab3J2dI.E3shwNecz27fZnqtelc13TF8qeWM4RRYmTfZ4m', 2000, '123412341234', 0, 0, 1),
(2, 'prueba2@hotmail.es', 'prueba2', 'asdasd', '1996-03-09', '$2y$10$meIKYuosfVYe2CSOTfmh2eISW2oGjeK.BlDofxLVVPRV2uvtjzhNi', 0, '123412341234', 0, 0, 1),
(3, 'prueba3@hotmail.es', 'prueba3', 'asdasd', '1996-03-09', '$2y$10$2uzIl80BHjwLFdcuDz6ACuydRtdUJrkJKZokHSDNE1vE9uImDx7Ty', 0, '123412341234', 0, 0, 1),
(4, 'prueba4@hotmail.es', 'prueba4', 'asdasd', '1996-03-09', '$2y$10$kvUcE7fqIEZG0Yjz/CRox.Fcl3L2gN0hOoasILeHWaV1q.TeTEFxu', 0, '123412341234', 0, 0, 1),
(5, 'prueba5@hotmail.es', 'prueba5', 'asdasd', '1996-03-09', '$2y$10$9VyJH8FtQYPsHFeXpZpBEuBbO9K0iQpcT/EUt7z5uSUlPVTUon9E6', 0, '0', 0, 0, 1),
(6, 'prueba6@hotmail.es', 'prueba6', 'asdasd', '1996-03-09', '$2y$10$bgACIU16owOW0VbAaEzSe.AmxaIMZf5qu/9KaNnmPAPhgLnTVdYSm', 0, '0', 0, 0, 1),
(7, 'prueba8@hotmail.eS', 'prueba8', 'asdasd', '1996-03-09', '$2y$10$Cz8Snn4A03LimvGUDlKs8uJ1mlv/7eYpGyvHU9YKdIVEhs1Clwvui', 0, '123412341234', 0, 0, 1),
(8, 'prueba7@hotmail.es', 'prueba7', 'asdasd', '1996-03-09', '$2y$10$qZIL7mVvL3Stygv8F1u3lu2mjA.6hamvo6PtiyWnnYIe3yNzzgFV2', 0, '123412341234', 0, 0, 1),
(9, 'prueba9@hotmail.es', 'prueba9', 'asdasd', '1996-03-09', '$2y$10$lLnd3hLLH/b3KmK/fJIr6OAhVip9RTCKPByAS2/GVYlO39XAGw9VW', 0, '123412341234', 0, 0, 1),
(10, 'prueba10@hotmail.es', 'prueba10', 'asasdasd', '1996-03-09', '$2y$10$e0eCGRQ5faIRphWTYb7xEeQakhQjWezeAYL0PXNuNREfYIwr8c4wi', 0, '123412341234', 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viaja`
--

CREATE TABLE `viaja` (
  `idUsuario` int(11) NOT NULL,
  `idViaje` int(11) NOT NULL,
  `eliminado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viaja`
--

INSERT INTO `viaja` (`idUsuario`, `idViaje`, `eliminado`) VALUES
(1, 3, 1),
(4, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajepertenece`
--

CREATE TABLE `viajepertenece` (
  `idViajeProgramado` int(11) NOT NULL,
  `idViaje` int(11) NOT NULL,
  `activo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes`
--

CREATE TABLE `viajes` (
  `idViaje` int(11) NOT NULL,
  `idConductor` int(11) NOT NULL,
  `patente` varchar(7) NOT NULL,
  `fechaCreacion` date NOT NULL,
  `fechaInicio` datetime NOT NULL,
  `inicio` varchar(20) NOT NULL,
  `destino` varchar(20) NOT NULL,
  `asientos` int(11) NOT NULL,
  `precio` float NOT NULL,
  `descripcion` text NOT NULL,
  `tipoViaje` varchar(30) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `duracion` time NOT NULL,
  `terminado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viajes`
--

INSERT INTO `viajes` (`idViaje`, `idConductor`, `patente`, `fechaCreacion`, `fechaInicio`, `inicio`, `destino`, `asientos`, `precio`, `descripcion`, `tipoViaje`, `estado`, `duracion`, `terminado`) VALUES
(1, 1, 'aaa111', '2018-06-27', '2018-07-01 12:00:00', 'la plata', 'bsas', 3, 2000, 'asdasdasdasdasd', '1', 1, '01:00:00', 0),
(2, 2, 'aaa111', '2018-06-27', '2018-07-02 12:00:00', 'la plata', 'tandil', 3, 2000, 'asdasdasdasd', '1', 1, '04:00:00', 0),
(3, 3, 'aa111aa', '2018-06-27', '2018-07-03 12:00:00', 'asdasd', 'asdasd', 4, 1200, 'asdasdasdasdasdasdasd', '1', 1, '03:00:00', 0),
(5, 2, 'aa222aa', '2018-06-27', '2018-07-03 12:00:00', 'asdasd', 'tandil', 3, 3000, 'kamñldkgjnladjkfnvkjlsrfkgnjvkls', '1', 1, '04:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajesprogramados`
--

CREATE TABLE `viajesprogramados` (
  `idViajeProgramado` int(11) NOT NULL,
  `fechaInicio` datetime NOT NULL,
  `fechaFin` datetime NOT NULL,
  `activo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auto`
--
ALTER TABLE `auto`
  ADD PRIMARY KEY (`patente`),
  ADD UNIQUE KEY `patente` (`patente`);

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `calificacion_pendiente`
--
ALTER TABLE `calificacion_pendiente`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `idUsuariocalificador` (`idUsuariocalificador`),
  ADD KEY `idusuarioACalificar` (`idusuarioACalificar`);

--
-- Indices de la tabla `conductor`
--
ALTER TABLE `conductor`
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `fotoauto`
--
ALTER TABLE `fotoauto`
  ADD KEY `patente` (`patente`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `pago_pendiente`
--
ALTER TABLE `pago_pendiente`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `idUsuarioDeudor` (`idUsuarioDeudor`),
  ADD KEY `idusuarioCobrador` (`idusuarioCobrador`);

--
-- Indices de la tabla `postula`
--
ALTER TABLE `postula`
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idViaje` (`idViaje`);

--
-- Indices de la tabla `tiene`
--
ALTER TABLE `tiene`
  ADD KEY `idConductor` (`idConductor`),
  ADD KEY `patente` (`patente`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `viaja`
--
ALTER TABLE `viaja`
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idViaje` (`idViaje`);

--
-- Indices de la tabla `viajepertenece`
--
ALTER TABLE `viajepertenece`
  ADD KEY `idViajeProgramado` (`idViajeProgramado`),
  ADD KEY `idViaje` (`idViaje`);

--
-- Indices de la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD PRIMARY KEY (`idViaje`),
  ADD UNIQUE KEY `idViaje` (`idViaje`),
  ADD KEY `idConductor` (`idConductor`);

--
-- Indices de la tabla `viajesprogramados`
--
ALTER TABLE `viajesprogramados`
  ADD PRIMARY KEY (`idViajeProgramado`),
  ADD UNIQUE KEY `idViajeProgramado` (`idViajeProgramado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `calificacion_pendiente`
--
ALTER TABLE `calificacion_pendiente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pago_pendiente`
--
ALTER TABLE `pago_pendiente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `viajes`
--
ALTER TABLE `viajes`
  MODIFY `idViaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `viajesprogramados`
--
ALTER TABLE `viajesprogramados`
  MODIFY `idViajeProgramado` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `calificaciones_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `calificacion_pendiente`
--
ALTER TABLE `calificacion_pendiente`
  ADD CONSTRAINT `calificacion_pendiente_ibfk_1` FOREIGN KEY (`idUsuariocalificador`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `calificacion_pendiente_ibfk_2` FOREIGN KEY (`idusuarioACalificar`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `conductor`
--
ALTER TABLE `conductor`
  ADD CONSTRAINT `conductor_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `fotoauto`
--
ALTER TABLE `fotoauto`
  ADD CONSTRAINT `fotoauto_ibfk_1` FOREIGN KEY (`patente`) REFERENCES `auto` (`patente`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fotos_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD CONSTRAINT `notificacion_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pago_pendiente`
--
ALTER TABLE `pago_pendiente`
  ADD CONSTRAINT `pago_pendiente_ibfk_1` FOREIGN KEY (`idUsuarioDeudor`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pago_pendiente_ibfk_2` FOREIGN KEY (`idusuarioCobrador`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `postula`
--
ALTER TABLE `postula`
  ADD CONSTRAINT `postula_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `postula_ibfk_2` FOREIGN KEY (`idViaje`) REFERENCES `viajes` (`idViaje`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tiene`
--
ALTER TABLE `tiene`
  ADD CONSTRAINT `tiene_ibfk_1` FOREIGN KEY (`idConductor`) REFERENCES `conductor` (`idUsuario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tiene_ibfk_2` FOREIGN KEY (`patente`) REFERENCES `auto` (`patente`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `viaja`
--
ALTER TABLE `viaja`
  ADD CONSTRAINT `viaja_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `viaja_ibfk_2` FOREIGN KEY (`idViaje`) REFERENCES `viajes` (`idViaje`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `viajepertenece`
--
ALTER TABLE `viajepertenece`
  ADD CONSTRAINT `viajepertenece_ibfk_1` FOREIGN KEY (`idViajeProgramado`) REFERENCES `viajesprogramados` (`idViajeProgramado`) ON UPDATE CASCADE,
  ADD CONSTRAINT `viajepertenece_ibfk_2` FOREIGN KEY (`idViaje`) REFERENCES `viajes` (`idViaje`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD CONSTRAINT `viajes_ibfk_1` FOREIGN KEY (`idConductor`) REFERENCES `conductor` (`idUsuario`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
