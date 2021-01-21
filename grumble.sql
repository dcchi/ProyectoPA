-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-01-2021 a las 17:07:38
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `grumble`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carta`
--

CREATE TABLE `carta` (
  `idCarta` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `nombreCarta` varchar(50) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `carta`
--

INSERT INTO `carta` (`idCarta`, `idUsuario`, `nombreCarta`) VALUES
(1, 1, 'Bar del Admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `media`
--

CREATE TABLE `media` (
  `idPost` int(11) NOT NULL,
  `foto` varchar(200) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `particular`
--

CREATE TABLE `particular` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `apellidos` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `sexo` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `foto` varchar(200) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `particular`
--

INSERT INTO `particular` (`idUsuario`, `nombre`, `apellidos`, `sexo`, `fechaNacimiento`, `foto`) VALUES
(2, 'Pepe', 'Perez Ramirez', 'M', '1998-06-20', '1610209571184836.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `idPost` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `mensaje` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesional`
--

CREATE TABLE `profesional` (
  `idUsuario` int(11) NOT NULL,
  `direccion` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `nombreDuenyo` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `fechaCreacion` date DEFAULT NULL,
  `foto` varchar(350) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `profesional`
--

INSERT INTO `profesional` (`idUsuario`, `direccion`, `nombreDuenyo`, `telefono`, `fechaCreacion`, `foto`) VALUES
(1, 'c/ del Admin', 'Pinedin', 672728588, '2021-01-04', '1609779518Harley-Quinn.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta`
--

CREATE TABLE `receta` (
  `idReceta` int(11) NOT NULL,
  `idCarta` int(11) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL,
  `nombreReceta` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `foto` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `tipo` varchar(50) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `receta`
--

INSERT INTO `receta` (`idReceta`, `idCarta`, `idUsuario`, `nombreReceta`, `foto`, `tipo`) VALUES
(1, 1, 1, 'Champolla', NULL, 'Primeros'),
(3, 1, 1, 'Amborgueso', NULL, 'Primeros'),
(4, 1, 1, 'PatatasBravas', NULL, 'Entrante'),
(11, 0, 1, 'Agua', NULL, 'Bebidas'),
(12, 0, 1, 'TartaQueso', NULL, 'Postres'),
(13, 1, 1, 'Guisantes', NULL, 'Segundos'),
(14, 0, 1, 'Macarrones', NULL, 'Primeros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reseña`
--

CREATE TABLE `reseña` (
  `idResenya` int(11) NOT NULL,
  `idParticular` int(11) DEFAULT NULL,
  `idProfesional` int(11) DEFAULT NULL,
  `mensaje` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `valoracion` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguidor`
--

CREATE TABLE `seguidor` (
  `idUsuario` int(11) DEFAULT NULL,
  `idSeguidor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nickName` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `tipo` varchar(2) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nickName`, `email`, `password`, `tipo`) VALUES
(1, 'admin', 'admin@admin.es', '$2y$10$7o7dY/65F4ntUpDwhlGySusOTgv8TtuNilJkwNJD0vZlCaapk0w6O', 'M'),
(2, '@pepePerez', 'elpepe@gmail.com', '$2y$10$Chtl6V.22IzIaQhq.0YuB.ZrvNrbCB6YQDVzmvx6.qxs550p7sr2G', 'P');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carta`
--
ALTER TABLE `carta`
  ADD PRIMARY KEY (`idCarta`);

--
-- Indices de la tabla `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`idPost`);

--
-- Indices de la tabla `particular`
--
ALTER TABLE `particular`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`idPost`);

--
-- Indices de la tabla `profesional`
--
ALTER TABLE `profesional`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `receta`
--
ALTER TABLE `receta`
  ADD PRIMARY KEY (`idReceta`);

--
-- Indices de la tabla `reseña`
--
ALTER TABLE `reseña`
  ADD PRIMARY KEY (`idResenya`);

--
-- Indices de la tabla `seguidor`
--
ALTER TABLE `seguidor`
  ADD PRIMARY KEY (`idSeguidor`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carta`
--
ALTER TABLE `carta`
  MODIFY `idCarta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `idPost` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `profesional`
--
ALTER TABLE `profesional`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `receta`
--
ALTER TABLE `receta`
  MODIFY `idReceta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `reseña`
--
ALTER TABLE `reseña`
  MODIFY `idResenya` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seguidor`
--
ALTER TABLE `seguidor`
  MODIFY `idSeguidor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
