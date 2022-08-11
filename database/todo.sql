-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-07-2022 a las 19:40:19
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `todo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `cursoid` int(11) NOT NULL,
  `profesorid` int(11) NOT NULL,
  `nombre_curso` varchar(120) NOT NULL,
  `descripcion_curso` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos_estudiantes`
--

CREATE TABLE `cursos_estudiantes` (
  `cursoeid` int(11) NOT NULL,
  `cursoid` int(11) NOT NULL,
  `estudianteid` int(11) NOT NULL,
  `nota_final` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `estudianteid` int(11) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `apellido` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(255) NOT NULL,
  `topicoid` int(11) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`estudianteid`, `nombre`, `apellido`, `email`, `password`, `topicoid`, `estado`) VALUES
(1, 'Jose', 'Ara', 'jose@ucateci.com', '$2y$10$MG4dBb8eslgckljzlZZXIuf99tbF..Ae6Cvy7JQH2gdKk/G3OGp5e', 2, 'Activo'),
(2, 'Pedro', 'Ara', 'pedro123@ucateci.com', '$2y$10$TIwfpx7n2MydKNJajNfEN.qp.924cjE7AQN/b98qPEHWXeWaclZkm', 2, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros_profesores`
--

CREATE TABLE `libros_profesores` (
  `libroid` int(11) NOT NULL,
  `topicoid` int(11) NOT NULL,
  `profesorid` int(11) NOT NULL,
  `titulo` varchar(120) NOT NULL,
  `descripcion` varchar(120) NOT NULL,
  `tamano` int(11) NOT NULL,
  `tipo` varchar(120) NOT NULL,
  `nombre_archivo` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones_libros`
--

CREATE TABLE `notificaciones_libros` (
  `notificacionid` int(11) NOT NULL,
  `topicoid` int(11) NOT NULL,
  `mensaje` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `profesorid` int(11) NOT NULL,
  `username` varchar(120) NOT NULL,
  `apellido` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(255) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`profesorid`, `username`, `apellido`, `email`, `password`, `estado`) VALUES
(1, 'Admin', 'Lopez', 'admin@ucateci.com', '$2y$10$yrEjEL9gXS8c6ReGvxwDlelU3pzGk5kDoiLk1ZNVsa2dMhy6Wq.lK', 'Activo'),
(2, 'Hector', 'Ara', 'hector@ucateci.com', '$2y$10$Q7IESxEAjLdu/akvObxex.3qIleZMUG4PD.P2XrLVCJikQRopwYDq', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `tareaid` int(11) NOT NULL,
  `cursoid` int(11) NOT NULL,
  `titulo_tarea` varchar(120) NOT NULL,
  `descripcion` varchar(120) NOT NULL,
  `tamano` int(11) NOT NULL,
  `tipo` varchar(120) NOT NULL,
  `nombre_archivo` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas_estudiantes`
--

CREATE TABLE `tareas_estudiantes` (
  `tareaeid` int(11) NOT NULL,
  `estudianteid` int(11) NOT NULL,
  `tareaid` int(11) NOT NULL,
  `tamano_entrega` int(11) NOT NULL,
  `tipo_entrega` varchar(120) NOT NULL,
  `nombre_entrega` varchar(120) NOT NULL,
  `nota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `topicos`
--

CREATE TABLE `topicos` (
  `topicoid` int(11) NOT NULL,
  `topico` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `topicos`
--

INSERT INTO `topicos` (`topicoid`, `topico`) VALUES
(1, 'Matematicas'),
(2, 'Informatica'),
(3, 'Biologia'),
(4, 'Ciencias Sociales'),
(5, 'Fisica'),
(6, 'Ingenieria'),
(7, 'Psicologia'),
(8, 'Musica');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`cursoid`) USING BTREE,
  ADD KEY `curso_fk_profesorid` (`profesorid`) USING BTREE;

--
-- Indices de la tabla `cursos_estudiantes`
--
ALTER TABLE `cursos_estudiantes`
  ADD PRIMARY KEY (`cursoeid`),
  ADD KEY `cursos_estudiantes_fk_cursoid` (`cursoid`),
  ADD KEY `cursos_estudiantes_fk_estudianteid` (`estudianteid`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`estudianteid`),
  ADD KEY `estudiante_fk_topicoid` (`topicoid`) USING BTREE;

--
-- Indices de la tabla `libros_profesores`
--
ALTER TABLE `libros_profesores`
  ADD PRIMARY KEY (`libroid`),
  ADD KEY `libros_profesores_fk_topicoid` (`topicoid`),
  ADD KEY `libros_profesores_fk_profesorid` (`profesorid`);

--
-- Indices de la tabla `notificaciones_libros`
--
ALTER TABLE `notificaciones_libros`
  ADD PRIMARY KEY (`notificacionid`) USING BTREE,
  ADD KEY `notificaciones_libros_fk_topicoid` (`topicoid`) USING BTREE;

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`profesorid`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`tareaid`),
  ADD KEY `tareas_fk_cursoid` (`cursoid`);

--
-- Indices de la tabla `tareas_estudiantes`
--
ALTER TABLE `tareas_estudiantes`
  ADD PRIMARY KEY (`tareaeid`),
  ADD KEY `tareas_estudiantes_fk_estudianteid` (`estudianteid`),
  ADD KEY `tareas_estudiantes_fk_tareaid` (`tareaid`);

--
-- Indices de la tabla `topicos`
--
ALTER TABLE `topicos`
  ADD PRIMARY KEY (`topicoid`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `cursoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `cursos_estudiantes`
--
ALTER TABLE `cursos_estudiantes`
  MODIFY `cursoeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `estudianteid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `libros_profesores`
--
ALTER TABLE `libros_profesores`
  MODIFY `libroid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `notificaciones_libros`
--
ALTER TABLE `notificaciones_libros`
  MODIFY `notificacionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `profesorid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `tareaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tareas_estudiantes`
--
ALTER TABLE `tareas_estudiantes`
  MODIFY `tareaeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `topicos`
--
ALTER TABLE `topicos`
  MODIFY `topicoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libros_profesores`
--
ALTER TABLE `libros_profesores`
  ADD CONSTRAINT `libros_profesores_fk_profesorid` FOREIGN KEY (`profesorid`) REFERENCES `profesores` (`profesorid`),
  ADD CONSTRAINT `libros_profesores_fk_topicoid` FOREIGN KEY (`topicoid`) REFERENCES `topicos` (`topicoid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
