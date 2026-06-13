-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-05-2026 a las 09:42:41
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
-- Base de datos: `bd_justificantes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_alumnos`
--

CREATE TABLE `tbl_alumnos` (
  `nombre` varchar(25) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `No_control` int(11) NOT NULL,
  `correo` varchar(75) NOT NULL,
  `password` varchar(20) NOT NULL,
  `apellidos` varchar(35) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_asignatura`
--

CREATE TABLE `tbl_asignatura` (
  `id_materia` int(11) NOT NULL,
  `nombre` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_control_escolar`
--

CREATE TABLE `tbl_control_escolar` (
  `id_control_escolar` int(11) NOT NULL,
  `nombre_admin` varchar(25) NOT NULL,
  `password` varchar(20) NOT NULL,
  `apellidos_admin` varchar(25) NOT NULL,
  `turno` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_grupos`
--

CREATE TABLE `tbl_grupos` (
  `id_grupo` int(11) NOT NULL,
  `carrera` varchar(35) NOT NULL,
  `turno` varchar(15) NOT NULL,
  `acronimo` varchar(8) NOT NULL,
  `grado_letra` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_grupos`
--

INSERT INTO `tbl_grupos` (`id_grupo`, `carrera`, `turno`, `acronimo`, `grado_letra`) VALUES
(1, 'Sistemas Computacionales', 'Matutino', 'ISC', '1A'),
(2, 'Sistemas Computacionales', 'Matutino', 'ISC', '1A'),
(3, 'Contabilidad', 'Vespertino', 'CON', '3B'),
(4, 'Contabilidad', 'Vespertino', 'CON', '3B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_justificantes`
--

CREATE TABLE `tbl_justificantes` (
  `id_justificantes` int(11) NOT NULL,
  `fecha_solicitud` date NOT NULL,
  `estado` varchar(15) NOT NULL,
  `fecha_resolucion` date NOT NULL,
  `motivo` varchar(25) NOT NULL,
  `folio` varchar(16) NOT NULL,
  `evidencia` varchar(250) NOT NULL,
  `razon` varchar(200) NOT NULL,
  `fechas_justificadas` varchar(10) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_control_escolar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_maestro`
--

CREATE TABLE `tbl_maestro` (
  `id_maestro` int(11) NOT NULL,
  `nombre_maestro` varchar(75) NOT NULL,
  `telefono` char(10) NOT NULL,
  `rfc` char(13) NOT NULL,
  `pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_m_g`
--

CREATE TABLE `tbl_m_g` (
  `id_materia_grupo` int(11) NOT NULL,
  `id_materia` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_m_m`
--

CREATE TABLE `tbl_m_m` (
  `id_maestro_materia` int(11) NOT NULL,
  `semestre` int(11) NOT NULL,
  `id_maestro` int(11) NOT NULL,
  `id_materia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tutor`
--

CREATE TABLE `tbl_tutor` (
  `id_tutor` int(11) NOT NULL,
  `nombre_tutor` varchar(25) NOT NULL,
  `apellido_tutor` varchar(25) NOT NULL,
  `telefono_tutor` char(10) NOT NULL,
  `correo_tutor` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tutor_alumno`
--

CREATE TABLE `tbl_tutor_alumno` (
  `parentesco` varchar(25) NOT NULL,
  `id_tutor_alumno` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_tutor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_alumnos`
--
ALTER TABLE `tbl_alumnos`
  ADD PRIMARY KEY (`id_alumno`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indices de la tabla `tbl_asignatura`
--
ALTER TABLE `tbl_asignatura`
  ADD PRIMARY KEY (`id_materia`);

--
-- Indices de la tabla `tbl_control_escolar`
--
ALTER TABLE `tbl_control_escolar`
  ADD PRIMARY KEY (`id_control_escolar`);

--
-- Indices de la tabla `tbl_grupos`
--
ALTER TABLE `tbl_grupos`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `tbl_justificantes`
--
ALTER TABLE `tbl_justificantes`
  ADD PRIMARY KEY (`id_justificantes`),
  ADD KEY `id_alumno` (`id_alumno`),
  ADD KEY `id_control_escolar` (`id_control_escolar`);

--
-- Indices de la tabla `tbl_maestro`
--
ALTER TABLE `tbl_maestro`
  ADD PRIMARY KEY (`id_maestro`);

--
-- Indices de la tabla `tbl_m_g`
--
ALTER TABLE `tbl_m_g`
  ADD PRIMARY KEY (`id_materia_grupo`),
  ADD KEY `id_materia` (`id_materia`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indices de la tabla `tbl_m_m`
--
ALTER TABLE `tbl_m_m`
  ADD PRIMARY KEY (`id_maestro_materia`),
  ADD KEY `id_maestro` (`id_maestro`),
  ADD KEY `id_materia` (`id_materia`);

--
-- Indices de la tabla `tbl_tutor`
--
ALTER TABLE `tbl_tutor`
  ADD PRIMARY KEY (`id_tutor`);

--
-- Indices de la tabla `tbl_tutor_alumno`
--
ALTER TABLE `tbl_tutor_alumno`
  ADD PRIMARY KEY (`id_tutor_alumno`),
  ADD KEY `id_alumno` (`id_alumno`),
  ADD KEY `id_tutor` (`id_tutor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_alumnos`
--
ALTER TABLE `tbl_alumnos`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_asignatura`
--
ALTER TABLE `tbl_asignatura`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_control_escolar`
--
ALTER TABLE `tbl_control_escolar`
  MODIFY `id_control_escolar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_grupos`
--
ALTER TABLE `tbl_grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_justificantes`
--
ALTER TABLE `tbl_justificantes`
  MODIFY `id_justificantes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_maestro`
--
ALTER TABLE `tbl_maestro`
  MODIFY `id_maestro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_m_g`
--
ALTER TABLE `tbl_m_g`
  MODIFY `id_materia_grupo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_m_m`
--
ALTER TABLE `tbl_m_m`
  MODIFY `id_maestro_materia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_tutor`
--
ALTER TABLE `tbl_tutor`
  MODIFY `id_tutor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_tutor_alumno`
--
ALTER TABLE `tbl_tutor_alumno`
  MODIFY `id_tutor_alumno` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_alumnos`
--
ALTER TABLE `tbl_alumnos`
  ADD CONSTRAINT `tbl_alumnos_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `tbl_grupos` (`id_grupo`);

--
-- Filtros para la tabla `tbl_justificantes`
--
ALTER TABLE `tbl_justificantes`
  ADD CONSTRAINT `tbl_justificantes_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `tbl_alumnos` (`id_alumno`),
  ADD CONSTRAINT `tbl_justificantes_ibfk_2` FOREIGN KEY (`id_control_escolar`) REFERENCES `tbl_control_escolar` (`id_control_escolar`);

--
-- Filtros para la tabla `tbl_m_g`
--
ALTER TABLE `tbl_m_g`
  ADD CONSTRAINT `tbl_m_g_ibfk_1` FOREIGN KEY (`id_materia`) REFERENCES `tbl_asignatura` (`id_materia`),
  ADD CONSTRAINT `tbl_m_g_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `tbl_grupos` (`id_grupo`);

--
-- Filtros para la tabla `tbl_m_m`
--
ALTER TABLE `tbl_m_m`
  ADD CONSTRAINT `tbl_m_m_ibfk_1` FOREIGN KEY (`id_maestro`) REFERENCES `tbl_maestro` (`id_maestro`),
  ADD CONSTRAINT `tbl_m_m_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `tbl_asignatura` (`id_materia`);

--
-- Filtros para la tabla `tbl_tutor_alumno`
--
ALTER TABLE `tbl_tutor_alumno`
  ADD CONSTRAINT `tbl_tutor_alumno_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `tbl_alumnos` (`id_alumno`),
  ADD CONSTRAINT `tbl_tutor_alumno_ibfk_2` FOREIGN KEY (`id_tutor`) REFERENCES `tbl_tutor` (`id_tutor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
