-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2024 a las 02:27:11
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bicicletas_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bicicletas`
--

CREATE TABLE `bicicletas` (
  `id` int(11) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `anio` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `id_tipos_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bicicletas`
--

INSERT INTO `bicicletas` (`id`, `marca`, `anio`, `color`, `id_tipos_fk`) VALUES
(41, 'Haro', 2002, 'blanco', 9),
(45, 'Redline', 1990, 'negro', 9),
(46, 'Mongoose', 2020, 'blanco', 9),
(74, 'Gazelle', 2024, 'rojo', 15),
(75, 'Trek', 2015, 'plata', 15),
(76, 'Trek', 2001, 'rojo', 16),
(77, 'Giant', 2016, 'azul', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `descripcion`) VALUES
(9, 'BMX', 'Bicicletas BMX: diseñadas específicamente para carreras y acrobacias. Son compactas, con un marco robusto y una geometría que favorece la resistencia. Al ser ligeras facilitan saltos y trucos, siendo perfectas para su uso en competiciones. '),
(15, 'Urbana', 'Bicicletas urbanas: diseñadas para el uso diario en entornos urbanos. Son prácticas, cómodas y suelen tener un diseño sencillo. Incluyen cambios de marchas, guardabarros y una postura de conducción más erguida para mayor comodidad. '),
(16, 'Montaña', 'Bicicletas de montaña: diseñadas para terrenos difíciles e irregulares. Tienen un marco resistente, neumáticos anchos, múltiples marchas, además de, suspensión tanto delantera como trasera, para absorber impactos y proporcionar mayor control. Ideales para montañas o caminos rocosos.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(1, 'webadmin', '$2y$10$a1DbH2zqLhuiBFtMsIUT3OVVno6enOhlZWDorkV3Poq6.D.Z4vOcu');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bicicletas`
--
ALTER TABLE `bicicletas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipos_fk` (`id_tipos_fk`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bicicletas`
--
ALTER TABLE `bicicletas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bicicletas`
--
ALTER TABLE `bicicletas`
  ADD CONSTRAINT `bicicletas_ibfk_1` FOREIGN KEY (`id_tipos_fk`) REFERENCES `categoria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
