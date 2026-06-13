-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: sql101.infinityfree.com
-- Tiempo de generación: 09-06-2026 a las 22:33:46
-- Versión del servidor: 11.4.12-MariaDB
-- Versión de PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `if0_42064861_bd_justificantes`
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
('Cristian', 3, '2211003', 'gamez.cristian.cb37@gmail.com', '1234', 'Gamez', 3),
('sebastiÃ¡n', 4, '12345', 'islas.sebastian.cb37@gmail.com', '$2y$10$CWM1LtiJjxNBosMyYzp6kuKiXYhLaQ0/aZo99rxflr789fcCjvmgu', 'peraza', 1),
('da', 5, '123456', 'massiel.mancinas@cbtis037.edu.mx', '$2y$10$s/5x8vXBC0Ux.uhAIj9wruPqijj/I9cwqmcxtEWO6O18SsnwA0lB.', 'a', 2),
('cristian', 6, '14', 'rfc111@gmail.com', '$2y$10$JqRvBZCX5TpQ9itV8G/dkORtSpRNjtLz0q/QDrySg38JW34h2W6wu', 'valenzuela', 2),
('cristian', 7, '12', 'meneses.alejandro.cb37@gmail.com', '$2y$10$vkPqcc.6juaG8BK/qUyLt.a5jKNOAI5J4Vk90a3L4J/A4edqz.Hcu', 'valenzuela', 1);

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
(1, 'Progra', 'Mañana', 'P1', '4AMPR'),
(2, 'Soporte', 'Tarde', 'S1', '5BMPR'),
(3, 'Redes', 'Mañana', 'R1', '6AMEL');

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
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_control_escolar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_justificantes`
--

INSERT INTO `tbl_justificantes` (`id_justificantes`, `fecha_solicitud`, `estado`, `fecha_resolucion`, `motivo`, `folio`, `evidencia`, `razon`, `fecha_inicio`, `fecha_fin`, `id_alumno`, `id_control_escolar`) VALUES
(1, '2026-05-31', 'Aprobado', '2026-05-31', 'Medico', 'JUST-94D81CBE', '1780273472-6a1cd140dcc8c.php', 'elpepe', '2026-06-22', '2026-06-26', 1, 1),
(2, '2026-05-31', 'Rechazado', '2026-05-31', 'Academico', 'JUST-FED5D206', '1780273555-6a1cd1934eddc.php', '22110012211001', '2026-05-28', '2026-05-30', 1, 1),
(3, '2026-05-31', 'Aprobado', '2026-05-31', 'Academico', 'JUST-807E9D1A', '1780273765-6a1cd265ea79a.docx', '321321', '2026-05-29', '2026-05-30', 1, 1),
(4, '2026-05-31', 'Aprobado', '2026-05-31', 'Medico', 'JUST-CF13B3D1', '1780274574-6a1cd58e21226.pdf', '321', '2026-05-26', '2026-05-28', 1, 1),
(5, '2026-05-31', 'Aprobado', '2026-05-31', 'Academico', 'JUST-2879C7F6', '1780274968-6a1cd718e9234.png', '241421', '2026-06-22', '2026-06-28', 1, 1),
(6, '2026-06-01', 'Rechazado', '2026-06-01', 'Academico', 'JUST-7A3CC4A2', '1780333337-6a1dbb19a5175.png', 'el toro tapo la entrada', '2026-05-25', '2026-05-29', 2, 1),
(7, '2026-06-02', 'Aprobado', '2026-06-02', 'Medico', 'JUST-BA5F5B61', '1780417283-6a1f0303306f6.pdf', 'Me enferme', '2026-05-31', '2026-06-01', 4, 1),
(8, '2026-06-02', 'Aprobado', '2026-06-02', 'Medico', 'JUST-D26B202A', '1780417429-6a1f0395ba1a5.jpg', 'sgfds', '2026-05-15', '2026-05-15', 4, 1),
(9, '2026-06-02', 'Aprobado', '2026-06-02', 'Academico', 'JUST-ABBDA4D1', '1780417507-6a1f03e35eea1.docx', 'gdf', '2026-05-15', '2026-05-15', 4, 1),
(10, '2026-06-02', 'Aprobado', '2026-06-07', 'Familiar', 'JUST-A581D839', '1780418125-6a1f064d13bbb.jpg', 'rtw', '2026-05-15', '2026-05-15', 5, 1),
(11, '2026-06-02', 'Aprobado', '2026-06-07', 'Academico', 'JUST-69C769C9', '1780421847-6a1f14d7a904e.png', 'fsfasf', '2026-06-26', '2026-06-30', 1, 1),
(12, '2026-06-02', 'Aprobado', '2026-06-02', 'Academico', 'JUST-1B00EDDC', '1780466569-6a1fc389c0179.png', 'razon', '2026-06-16', '2026-06-24', 1, 1),
(13, '2026-06-03', 'Aprobado', '2026-06-07', 'Familiar', 'JUST-6A20645F', '1780519486-6a20923e5ccbd.png', 'saldre de viaje', '2026-06-03', '2026-06-05', 1, 1),
(14, '2026-06-07', 'Aprobado', '2026-06-07', 'Medico', 'JUST-382DBCD3', '1780865117-6a25d85db038c.png', 'f', '2026-06-03', '2026-06-18', 7, 1),
(15, '2026-06-07', 'Aprobado', '2026-06-07', 'Medico', 'JUST-167275CC', '1780865527-6a25d9f7b7fcd.png', '2', '2026-06-04', '2026-06-17', 7, 1),
(16, '2026-06-07', 'Aprobado', '2026-06-07', 'Medico', 'JUST-B7C45261', '1780865718-6a25dab653ce1.png', '2', '2026-06-11', '2222-02-22', 7, 1),
(17, '2026-06-07', 'Aprobado', '2026-06-07', 'Medico', 'JUST-86887770', '1780867191-6a25e07713207.png', '3', '3333-03-31', '3333-03-31', 7, 1),
(18, '2026-06-09', 'Aprobado', '2026-06-09', 'Medico', 'JUST-89A5F69E', '1781049513-6a28a8a994cc8.png', 'Estoy enfermo :(', '2026-06-10', '2026-06-11', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_maestro`
--

CREATE TABLE `tbl_maestro` (
  `id_maestro` int(11) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `nombre_maestro` varchar(75) NOT NULL,
  `telefono` char(10) NOT NULL,
  `rfc` char(13) NOT NULL,
  `pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_maestro`
--

INSERT INTO `tbl_maestro` (`id_maestro`, `correo`, `nombre_maestro`, `telefono`, `rfc`, `pass`) VALUES
(1, 'data.losientobb@gmail.com', 'Carlos', '6442311682', 'RFCM1', '1234'),
(2, 'cristiangamezvzla@gmail.com', 'Laura', '6441912242', 'RFCM2', '1234'),
(3, 'motileonardo20@gmail.com\r\n', 'Pedro', '6221639355', 'RFCM3', '1234');

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
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id_justificantes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
