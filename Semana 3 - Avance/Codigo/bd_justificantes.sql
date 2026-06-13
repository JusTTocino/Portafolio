-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2026 a las 01:12:36
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
  `no_control` char(13) NOT NULL,
  `correo` varchar(75) NOT NULL,
  `password` varchar(225) NOT NULL,
  `apellidos` varchar(35) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_alumnos`
--

INSERT INTO `tbl_alumnos` (`nombre`, `id_alumno`, `no_control`, `correo`, `password`, `apellidos`, `id_grupo`) VALUES
('Jose', 1, '2211001', 'meneses.alejandro.cb37@gmail.com', '1234', 'Meneses', 1),
('Eliza', 2, '2211002', 'valenzuela.eliza.cb37@gmail.com', '1234', 'Valenzuela', 2),
('Cristian', 3, '2211003', 'gamez.cristian.cb37@gmail.com', '1234', 'Gamez', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_asignatura`
--

CREATE TABLE `tbl_asignatura` (
  `id_materia` int(11) NOT NULL,
  `nombre` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_asignatura`
--

INSERT INTO `tbl_asignatura` (`id_materia`, `nombre`) VALUES
(1, 'HTML'),
(2, 'Java'),
(3, 'SQL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_control_escolar`
--

CREATE TABLE `tbl_control_escolar` (
  `id_control_escolar` int(11) NOT NULL,
  `rfc` char(13) NOT NULL,
  `nombre_admin` varchar(25) NOT NULL,
  `password` varchar(200) NOT NULL,
  `apellidos_admin` varchar(25) NOT NULL,
  `turno` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_control_escolar`
--

INSERT INTO `tbl_control_escolar` (`id_control_escolar`, `rfc`, `nombre_admin`, `password`, `apellidos_admin`, `turno`) VALUES
(1, 'RFC111', 'Ana', '1234', 'Lopez', 'Mañana'),
(2, 'RFC222', 'Luis', '1234', 'Perez', 'Tarde'),
(3, 'RFC333', 'Mario', '1234', 'Gomez', 'Mañana');

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
(1, 'Progra', 'Mañana', 'P1', '4A'),
(2, 'Soporte', 'Tarde', 'S1', '5B'),
(3, 'Redes', 'Mañana', 'R1', '6C');

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
  `fechas_justificadas` varchar(25) NOT NULL,
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

--
-- Volcado de datos para la tabla `tbl_maestro`
--

INSERT INTO `tbl_maestro` (`id_maestro`, `nombre_maestro`, `telefono`, `rfc`, `pass`) VALUES
(1, 'Carlos', '6441111111', 'RFCM1', '1234'),
(2, 'Laura', '6442222222', 'RFCM2', '1234'),
(3, 'Pedro', '6443333333', 'RFCM3', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_m_g`
--

CREATE TABLE `tbl_m_g` (
  `id_materia_grupo` int(11) NOT NULL,
  `id_materia` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_m_g`
--

INSERT INTO `tbl_m_g` (`id_materia_grupo`, `id_materia`, `id_grupo`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3);

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

--
-- Volcado de datos para la tabla `tbl_m_m`
--

INSERT INTO `tbl_m_m` (`id_maestro_materia`, `semestre`, `id_maestro`, `id_materia`) VALUES
(1, 4, 1, 1),
(2, 5, 2, 2),
(3, 6, 3, 3);

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

--
-- Volcado de datos para la tabla `tbl_tutor`
--

INSERT INTO `tbl_tutor` (`id_tutor`, `nombre_tutor`, `apellido_tutor`, `telefono_tutor`, `correo_tutor`) VALUES
(1, 'Maria', 'Lopez', '6444444444', 'm@m.com'),
(2, 'Juan', 'Perez', '6445555555', 'j@j.com'),
(3, 'Sofia', 'Gomez', '6446666666', 's@s.com');

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
-- Volcado de datos para la tabla `tbl_tutor_alumno`
--

INSERT INTO `tbl_tutor_alumno` (`parentesco`, `id_tutor_alumno`, `id_alumno`, `id_tutor`) VALUES
('Madre', 1, 1, 1),
('Padre', 2, 2, 2),
('Tia', 3, 3, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_alumnos`
--
ALTER TABLE `tbl_alumnos`
  ADD PRIMARY KEY (`id_alumno`),
  ADD UNIQUE KEY `no_control` (`no_control`),
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
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_asignatura`
--
ALTER TABLE `tbl_asignatura`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_control_escolar`
--
ALTER TABLE `tbl_control_escolar`
  MODIFY `id_control_escolar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_grupos`
--
ALTER TABLE `tbl_grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_justificantes`
--
ALTER TABLE `tbl_justificantes`
  MODIFY `id_justificantes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_maestro`
--
ALTER TABLE `tbl_maestro`
  MODIFY `id_maestro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_m_g`
--
ALTER TABLE `tbl_m_g`
  MODIFY `id_materia_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_m_m`
--
ALTER TABLE `tbl_m_m`
  MODIFY `id_maestro_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_tutor`
--
ALTER TABLE `tbl_tutor`
  MODIFY `id_tutor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_tutor_alumno`
--
ALTER TABLE `tbl_tutor_alumno`
  MODIFY `id_tutor_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
