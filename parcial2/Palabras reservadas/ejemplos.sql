-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-04-2026 a las 19:49:28
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ejemplos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `autor_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `nacionalidad` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`autor_id`, `nombre`, `nacionalidad`) VALUES
(1, 'Gabriel García Márquez', 'Colombiano'),
(2, 'Jane Austen', 'Británica'),
(3, 'Haruki Murakami', 'Japonés'),
(4, 'J.K. Rowling', 'Británica'),
(5, 'George Orwell', 'Británica'),
(6, 'Fiódor Dostoyevski', 'Ruso'),
(7, 'Toni Morrison', 'Estadounidense'),
(8, 'J.R.R. Tolkien', 'Británica'),
(9, 'Isabel Allende', 'Chilena'),
(10, 'Franz Kafka', 'Checa'),
(11, 'Virginia Woolf', 'Británica'),
(12, 'Albert Camus', 'Argelino-Francés'),
(13, 'Jorge Luis Borges', 'Argentina'),
(14, 'Chimamanda Ngozi Adichie', 'Nigeriana'),
(15, 'Yukio Mishima', 'Japonés'),
(16, 'Milan Kundera', 'Checo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `categoria_id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `nombre`) VALUES
(1, 'Ficción'),
(2, 'No Ficción'),
(3, 'Ciencia Ficción'),
(4, 'Romance'),
(5, 'Fantasía'),
(6, 'Misterio'),
(7, 'Biografía'),
(8, 'Historia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `libro_id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `autor_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `fecha_publicacion` date DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`libro_id`, `titulo`, `autor_id`, `categoria_id`, `fecha_publicacion`, `precio`) VALUES
(1, 'Cien años de soledad', 1, 1, '1967-05-30', '15.99'),
(2, 'Orgullo y prejuicio', 2, 4, '1813-01-28', '9.99'),
(3, 'Kafka en la orilla', 3, 1, '2002-09-12', '18.50'),
(4, 'Harry Potter y la piedra filosofal', 4, 1, '1997-06-26', '12.99'),
(5, '1984', 5, 1, '1949-06-08', '10.99'),
(6, 'Crimen y castigo', 6, 2, '1866-01-01', '14.50'),
(7, 'Beloved', 7, 3, '1987-09-16', '16.00'),
(8, 'El señor de los anillos', 8, 1, '1954-07-29', '22.99'),
(9, 'Orgullo y prejuicio', 2, 4, '1813-01-28', '9.99'),
(10, 'El retrato de Dorian Gray', 6, 1, '1890-07-01', '11.50'),
(11, 'La casa de los espíritus', 1, 1, '1982-10-01', '13.00'),
(12, 'Sapiens: De animales a dioses', 3, 3, '2011-01-01', '18.99'),
(13, 'El amor en los tiempos del cólera', 1, 1, '1985-09-05', '17.50'),
(14, 'El coronel no tiene quien le escriba', 1, 2, '1961-01-01', '11.99'),
(15, 'Sentido y sensibilidad', 2, 4, '1811-10-30', '9.99'),
(16, 'Emma', 2, 4, '1815-12-23', '10.50'),
(17, 'Norwegian Wood', 3, 1, '1987-09-04', '15.99'),
(18, 'Tokio blues', 3, 2, '1987-09-04', '14.50'),
(19, 'Harry Potter y la cámara secreta', 4, 3, '1998-07-02', '11.99'),
(20, 'Harry Potter y el prisionero de Azkaban', 4, 3, '1999-07-08', '12.99'),
(21, 'Rebelión en la granja', 5, 2, '1945-08-17', '8.99'),
(22, 'Días birmanos', 5, 1, '1934-01-01', '13.50'),
(23, 'Los hermanos Karamázov', 6, 2, '1880-11-01', '19.99'),
(24, 'El idiota', 6, 2, '1869-01-01', '16.50'),
(25, 'La canción de Salomón', 7, 3, '1977-09-20', '14.99'),
(26, 'Sula', 7, 1, '1973-01-01', '12.50'),
(27, 'El hobbit', 8, 3, '1937-09-21', '14.99'),
(28, 'Las dos torres', 8, 3, '1954-11-11', '18.50'),
(29, 'Eva Luna', 9, 1, '1987-01-01', '13.99'),
(30, 'De amor y de sombra', 9, 1, '1984-01-01', '12.50'),
(31, 'El proceso', 10, 2, '1925-01-01', '10.99'),
(32, 'La metamorfosis', 10, 2, '1915-10-15', '8.50'),
(33, 'La señora Dalloway', 11, 1, '1925-05-14', '11.99'),
(34, 'Al faro', 11, 2, '1927-05-05', '10.50'),
(35, 'La peste', 12, 2, '1947-06-10', '13.99'),
(36, 'El exilio y el reino', 12, 5, '1957-03-20', '10.50'),
(37, 'El Aleph', 13, 5, '1949-01-01', '11.99'),
(38, 'Ficciones', 13, 5, '1944-01-01', '12.50'),
(39, 'Americanah', 14, 1, '2013-05-14', '15.99'),
(40, 'Medio sol amarillo', 14, 2, '2006-09-12', '14.50'),
(41, 'El templo del pabellón de oro', 15, 2, '1956-01-01', '15.50'),
(42, 'Confesiones de una máscara', 15, 1, '1949-07-05', '13.99'),
(43, 'La insoportable levedad del ser', 16, 1, '1984-01-01', '14.99'),
(44, 'La broma', 16, 1, '1967-01-01', '12.50'),
(45, 'El retrato de Dorian Gray', 6, 2, '1890-07-01', '11.50'),
(46, 'La importancia de llamarse Ernesto', 12, 6, '1895-02-14', '9.50'),
(47, 'Ana Karenina', 6, 1, '1878-01-01', '18.99'),
(48, 'La muerte de Iván Ilyich', 6, 2, '1886-01-01', '9.99'),
(49, 'En busca del tiempo perdido', 11, 2, '1913-11-14', '21.99'),
(50, 'Jean Santeuil', 11, 2, '1952-01-01', '16.50'),
(51, 'Madame Bovary', 12, 1, '1857-04-01', '12.99'),
(52, 'La educación sentimental', 12, 1, '1869-11-17', '14.50'),
(53, 'Don Quijote de la Mancha', 1, 2, '1605-01-16', '22.99'),
(54, 'Novelas ejemplares', 1, 5, '1613-01-01', '15.50'),
(55, 'Grandes esperanzas', 8, 2, '1861-08-01', '13.99'),
(56, 'Oliver Twist', 8, 2, '1838-11-01', '12.50'),
(57, 'Ulises', 11, 2, '1922-02-02', '24.99'),
(58, 'Dublineses', 11, 5, '1914-06-15', '11.50'),
(59, 'Lolita', 16, 1, '1955-09-15', '14.99'),
(60, 'Pálido fuego', 16, 5, '1962-01-01', '13.50'),
(61, 'Pedro Páramo', 13, 1, '1955-03-19', '11.99'),
(62, 'El llano en llamas', 13, 5, '1953-01-01', '10.50');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`autor_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`libro_id`),
  ADD KEY `autor_id` (`autor_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `autor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `libro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`autor_id`) REFERENCES `autores` (`autor_id`),
  ADD CONSTRAINT `libros_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`categoria_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
