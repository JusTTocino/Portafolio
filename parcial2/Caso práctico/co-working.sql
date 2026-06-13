-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-04-2026 a las 09:36:08
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `co-working`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `Id_cliente` int(11) NOT NULL,
  `empresa` varchar(50) NOT NULL,
  `rfc` char(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`Id_cliente`, `empresa`, `rfc`) VALUES
(1, 'Google Mexico', 'GOGL123456789'),
(2, 'Apple Sonora', 'APPL987654321'),
(3, 'Netflix MX', 'NFLX456789123'),
(4, 'Coca Cola SA', 'COCA321654987'),
(5, 'Amazon MX', 'AMZN789123456'),
(6, 'Tesla MX', 'TSLA123789456'),
(7, 'Spotify MX', 'SPTY456123789'),
(8, 'Microsoft MX', 'MSFT789456123'),
(9, 'Meta MX', 'META321987654'),
(10, 'Uber MX', 'UBER654321987');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oficinas`
--

CREATE TABLE `oficinas` (
  `Id_oficina` int(11) NOT NULL,
  `tamaño` varchar(50) NOT NULL,
  `precio_hora` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `oficinas`
--

INSERT INTO `oficinas` (`Id_oficina`, `tamaño`, `precio_hora`) VALUES
(1, 'grande', 15.00),
(2, 'mediana', 10.00),
(3, 'pequeña', 5.00),
(4, 'suite ejecutiva', 25.00),
(5, 'sala de juntas', 20.00),
(6, 'coworking abierto', 8.00),
(7, 'privada', 18.00),
(8, 'doble', 12.00),
(9, 'triple', 22.00),
(10, 'penthouse', 50.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `Id_reservas` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `horas_rentadas` int(3) NOT NULL,
  `Id_oficina` int(11) NOT NULL,
  `Id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`Id_reservas`, `fecha`, `horas_rentadas`, `Id_oficina`, `Id_cliente`) VALUES
(1, '2026-04-01', 2, 2, 2),
(2, '2026-04-02', 4, 3, 3),
(3, '2026-04-03', 1, 4, 4),
(4, '2026-04-04', 6, 5, 2),
(5, '2026-04-05', 3, 2, 3),
(6, '2026-04-06', 5, 3, 4),
(7, '2026-04-07', 2, 4, 2),
(8, '2026-04-08', 8, 5, 3),
(9, '2026-04-09', 4, 2, 4),
(10, '2026-04-10', 7, 3, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`Id_cliente`);

--
-- Indices de la tabla `oficinas`
--
ALTER TABLE `oficinas`
  ADD PRIMARY KEY (`Id_oficina`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`Id_reservas`),
  ADD KEY `Id_oficina` (`Id_oficina`),
  ADD KEY `Id_cliente` (`Id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `Id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `oficinas`
--
ALTER TABLE `oficinas`
  MODIFY `Id_oficina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `Id_reservas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`Id_oficina`) REFERENCES `oficinas` (`Id_oficina`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`Id_cliente`) REFERENCES `cliente` (`Id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
