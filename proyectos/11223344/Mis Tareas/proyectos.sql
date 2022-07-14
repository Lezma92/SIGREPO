-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2021 a las 09:32:02
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sigproti`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id` int(11) NOT NULL,
  `id_repositorios` int(11) DEFAULT NULL,
  `id_asesor` int(11) NOT NULL,
  `categoria` enum('Estadía','Integradora','Especial') NOT NULL,
  `nombre_proyecto` varchar(50) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `icono` varchar(255) NOT NULL,
  `fecha` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `id_repositorios`, `id_asesor`, `categoria`, `nombre_proyecto`, `descripcion`, `icono`, `fecha`) VALUES
(9, 3, 1, 'Especial', 'Zamanta', 'Aqui se registraran cada una de las practicas realizadas en las clases', '../proyectos/iconos_proyectos/22-07-2021-08.42.00.png', '2021-07-22 06:42:00'),
(12, 1, 1, 'Integradora', 'Aplicaciones', 'Una pequeña descripción de lo que contendrá el repositorio', '../proyectos/iconos_proyectos/22-07-2021-09.51.30.jpg', '2021-07-22 07:51:30'),
(13, 7, 1, 'Integradora', 'Karina', 'kjskjfkjfs ffkjskjfsfskjf fskjfsmf sdfkjsf sfksjfsd fskfsf s', '../proyectos/iconos_proyectos/23-07-2021-06.15.34.png', '2021-07-23 04:15:34'),
(14, 1, 1, 'Estadía', 'Aa', 'Assssss', '../proyectos/iconos_proyectos/23-07-2021-06.29.11.png', '2021-07-23 04:29:11'),
(15, 1, 4, 'Integradora', 'Repositorio', 'Ajajajajajajajaj', '../proyectos/iconos_proyectos/23-07-2021-06.42.54.png', '2021-07-23 04:42:54'),
(16, NULL, 1, 'Integradora', 'jfjksjkfjsfj', '1234 akd', '../proyectos/iconos_proyectos/23-07-2021-07.21.12.png', '2021-07-23 05:21:12'),
(17, NULL, 1, 'Integradora', 'PruebadeRepositorio', 'Aqui se almacenaran todos los archivos de el proyecto de integradora', '../proyectos/iconos_proyectos/30-08-2021-18.00.59.png', '2021-08-30 16:00:59'),
(18, 8, 4, 'Integradora', 'Mirepo', 'sdknajhdajdhjd dadjhadhavsd adhajd adjadbn adajda dadjhabnd adjhad adddad', '../proyectos/iconos_proyectos/30-08-2021-18.24.07.png', '2021-08-30 16:24:07'),
(19, 8, 1, 'Integradora', 'JIJIJI', 'asadhd dadkhad addjh ddjhads ad', '../proyectos/iconos_proyectos/30-08-2021-19.34.30.jpg', '2021-08-30 17:34:30'),
(20, NULL, 1, 'Estadía', 'Mirepo', 'asadhd dadkhad addjh ddjhads ad', '../proyectos/iconos_proyectos/25-11-2021-02.32.55.jpg', '2021-11-25 01:32:55'),
(21, NULL, 4, 'Estadía', 'meroyo', 'jejekdsnf sfjfnf s fjsfjfs', '../proyectos/iconos_proyectos/25-11-2021-02.34.45.jpeg', '2021-11-25 01:34:46'),
(22, 1, 4, 'Estadía', 'Mejores', 'App creadas en clases', '../proyectos/iconos_proyectos/25-11-2021-02.38.28.jpg', '2021-11-25 01:38:28'),
(23, 9, 1, 'Integradora', 'Mis Tareas', 'Portafolio de evidencias 2021', '../proyectos/iconos_proyectos/26-11-2021-10.23.31.png', '2021-11-26 09:23:31');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
