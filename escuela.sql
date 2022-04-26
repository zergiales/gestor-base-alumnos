-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-02-2022 a las 09:55:27
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `escuela`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(3) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `dni` char(10) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `idTipoVia` varchar(20) DEFAULT NULL,
  `nombreVia` varchar(10) DEFAULT NULL,
  `numeroVia` int(3) DEFAULT NULL,
  `localidad` varchar(50) DEFAULT NULL,
  `telefono` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `nombre`, `apellidos`, `dni`, `fechaNacimiento`, `idTipoVia`, `nombreVia`, `numeroVia`, `localidad`, `telefono`) VALUES
(90, 'adam', 'calin', '12345', '0444-03-12', '2', 'hdhd', 0, '1111', 111),
(92, 'marcos', 'bermudez', '123455', '2222-12-12', '1', 'arci', 15, 'azuqueca', 11111),
(93, 'der', 'ddd', 'ddddd', '4444-04-04', '1', '222º', 12, 'ssss', 222),
(94, 'adam', 'hola1', '1111', '2021-09-08', 'interurbana', '22', 111, 'alovera', 777);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(40) NOT NULL,
  `password` varchar(60) NOT NULL,
  `permisos` varchar(6) NOT NULL,
  `fechaAlta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `password`, `permisos`, `fechaAlta`) VALUES
('encri', '$2y$10$AK8PWjvIeYpGiCG5GLV52uoo2rFLBCFw4MkjC7uC4TldPJIzj0yre', 'admin', '2022-02-22'),
('encri2', '$2y$10$fchP26bG3x8WQafVWanEAOlUSimWiiW/aabbdLtdKvmO8yfwV9neu', 'visor', '2022-02-22'),
('sergio', '$2y$10$DkOVYHfhkTkZe0AXK56fEOUIK47hdHj1JjuGPyjTmKs3zYeKO47Ya', 'admin', '2022-02-22'),
('visor', '$2y$10$sDpKhXBORzK/0WH6HMAN.uwya7FFjxE07vajipvWX1qAHYZBvvf0K', 'visor', '2022-02-22');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idTipoVia` (`idTipoVia`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
