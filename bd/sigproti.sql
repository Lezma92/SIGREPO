-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-07-2022 a las 23:49:39
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

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `activarAlumno` (IN `idDatos` INT(11), IN `id_alumno` INT(11), IN `id_espera` INT(11), IN `matricula` INT(8))  BEGIN
INSERT INTO usuarios (id_datos_personales,nick,pswrd,nivel_user) VALUES(idDatos,matricula,(select pswrd from alumnos where id = id_alumno),"Alumno");
UPDATE usuarios_espera SET estado = "Activo" WHERE id = id_espera; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarAlumno` (IN `idDatos` INT(11), IN `idUsuario` INT(11), IN `idAlumno` INT(11), IN `mat` INT(11), IN `nom` VARCHAR(35), IN `app` VARCHAR(35), IN `grup` VARCHAR(15), IN `nivelEstudio` VARCHAR(15), IN `pass` VARCHAR(35), IN `nivel` VARCHAR(35))  BEGIN
UPDATE datos_personales 
SET 
    matricula = mat,
    nombre = nom,
    apellidos = app
WHERE
    id = idDatos;
UPDATE alumnos 
SET 
    grupo = grup,
    nivel_estudio = nivelEstudio,
    pswrd = pass
WHERE
    id = idAlumno;
UPDATE usuarios 
SET 
    nick = mat,
    pswrd = pass,
    nivel_user = nivel
WHERE
    id = idUsuario;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `datosUsuariosAdmin` (IN `idDato` INT(11), IN `idUser` INT(11))  BEGIN
SELECT 
    usu.id,
    usu.nick,
    usu.nivel_user,
    dat_p.matricula,
    dat_p.nombre,
    dat_p.apellidos,
    usu.pswrd
FROM
    usuarios AS usu
        INNER JOIN
    datos_personales AS dat_p ON dat_p.id = usu.id_datos_personales
WHERE
    usu.id = idUser AND dat_p.id = idDato;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarAlumnos` (IN `idUsuario` INT(11), IN `idAlumno` INT(11), IN `idDatos` INT(11))  BEGIN
DELETE FROM usuarios WHERE id = idUsuario;
DELETE FROM alumnos WHERE id = idAlumno;
DELETE FROM datos_personales WHERE id = idDatos;
DELETE FROM usuarios_espera WHERE id_datos_personales = idDatos;
END$$

CREATE DEFINER=`misael`@`localhost` PROCEDURE `eliminarUsuariosAd` (IN `idUsu` INT(11), IN `idDatos` INT(11))  BEGIN
DELETE FROM usuarios 
WHERE
    id = idUsu;
DELETE FROM datos_personales 
WHERE
    id = idDatos;
DELETE FROM asesores
WHERE id_datos = idDatos; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getDatosAlumnos` (IN `mat` INT(11))  BEGIN
SELECT 
    dat_p.id AS idDatos,
    al.id AS idAlumno,
    usu.id AS idUsuario,
    dat_p.matricula,
    dat_p.nombre,
    dat_p.apellidos,
    al.grupo,
    al.nivel_estudio,
    usu.pswrd
FROM
    datos_personales AS dat_p
        INNER JOIN
    alumnos AS al ON dat_p.id = al.id_datos_personales
        INNER JOIN
    usuarios AS usu ON dat_p.id = usu.id_datos_personales
        AND usu.id_datos_personales = al.id_datos_personales
WHERE
    dat_p.matricula = mat;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getUsers` (IN `nick` INT(11), IN `pass` VARCHAR(35))  BEGIN
SELECT
	usu.id,
    usu.nick,
    usu.nivel_user,
    usu.pswrd,
    al.grupo,
    al.nivel_estudio
FROM
    usuarios AS usu
        INNER JOIN
    datos_personales AS dat_p ON dat_p.id = usu.id_datos_personales
        LEFT JOIN
    alumnos AS al ON al.id_datos_personales = dat_p.id
WHERE
    usu.nick = nick
        AND usu.pswrd = pass;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarArchivos` (IN `id_proyecto` INT(11), IN `nombre` VARCHAR(255), IN `tipo` VARCHAR(255), IN `tama` VARCHAR(255), IN `ruta` VARCHAR(255))  BEGIN
INSERT INTO archivos (id_proyecto,nombre,tipo,tama,ruta,fecha,hora) VALUES(id_proyecto,nombre,tipo,tama,ruta,curdate(),CURTIME());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarEspera` ()  begin
	SELECT 
    dt_p.id as idDatos,
    al.id as id_alumno,
    usu_e.id as id_espera,
    dt_p.matricula,
    CONCAT(dt_p.nombre, ' ', dt_p.apellidos) AS nombre,
    al.grupo,
    al.nivel_estudio,
    usu_e.estado
FROM
    usuarios_espera AS usu_e
        INNER JOIN
    datos_personales AS dt_p ON dt_p.id = usu_e.id_datos_personales
        INNER JOIN
    alumnos AS al ON al.id_datos_personales = dt_p.id
        AND usu_e.id_datos_personales = al.id_datos_personales
WHERE
    usu_e.estado = 'Espera'
ORDER BY dt_p.matricula ASC , al.grupo ASC, dt_p.nombre asc, al.nivel_estudio ASC;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarProyecto` (IN `matricula` VARCHAR(12), IN `idAsesor` INT(11), IN `cat` VARCHAR(25), IN `nombre_pro` VARCHAR(50), IN `descrip` VARCHAR(255), IN `ruta` VARCHAR(255))  BEGIN
	INSERT INTO proyectos(id_repositorios, id_asesor, categoria, nombre_proyecto, descripcion, icono, fecha) 
	VALUES((SELECT id FROM repositorios WHERE nombre = matricula),idAsesor,cat,nombre_pro,descrip,ruta,CURRENT_TIMESTAMP());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `resultadoTotal` (IN `nivel` VARCHAR(8), IN `cat` VARCHAR(11))  BEGIN 
SELECT 
    pro.id as idProyecto,
    rep.id as idRepositorio,
    dat_p.matricula
FROM
    proyectos AS pro
        INNER JOIN
    repositorios AS rep ON rep.id = pro.id_repositorios
        INNER JOIN
    alumnos AS al ON al.id = rep.id_alumno
        INNER JOIN
    datos_personales AS dat_p ON dat_p.id = al.id_datos_personales
WHERE
    al.nivel_estudio = nivel and pro.categoria = cat order by pro.fecha DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateDatosUser` (IN `idDatos` INT(11), IN `idUser` INT(11), IN `mat` INT(11), IN `nom` VARCHAR(35), IN `app` VARCHAR(50), IN `pass` VARCHAR(35), IN `nivel` VARCHAR(35))  BEGIN
UPDATE datos_personales 
SET 
    matricula = mat,
    nombre = nom,
    apellidos = app
WHERE
    id = idDatos;
    
UPDATE usuarios 
SET 
    nick = mat,
    pswrd = pass,
    nivel_user = nivel
WHERE
    id = idUser;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `verAlumnos` ()  BEGIN
SELECT 
    datp.id AS idDatos,
    al.id AS idAlumno,
    usu.id AS idUsuario,
    datp.matricula,
    datp.nombre,
    datp.apellidos,
    al.grupo,
    al.nivel_estudio,
    usu.nivel_user,
    usu.pswrd
FROM
    datos_personales AS datp
        INNER JOIN
    alumnos AS al ON al.id_datos_personales = datp.id
        INNER JOIN
    usuarios AS usu ON usu.id_datos_personales = datp.id
        AND usu.nivel_user = 'Alumno';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `verArchivos` (IN `idproyecto` INT(11))  BEGIN
SELECT arch.id as idArchivo,arch.id_proyecto as idProyecto,arch.nombre, arch.ruta, arch.tama, arch.tipo,arch.fecha,arch.hora FROM archivos AS arch WHERE arch.id_proyecto = idproyecto ORDER BY arch.hora DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `verArchivosAlumnos` (IN `idproyecto` INT(11))  BEGIN
SELECT 
	arch.id as idArchivo,arch.id_proyecto as idProyecto,arch.nombre, arch.ruta, arch.tama, arch.tipo, arch.fecha,arch.hora
    FROM archivos AS arch 
WHERE arch.id_proyecto = idproyecto  
		AND arch.tipo <> 'application/zip'
        AND arch.tipo <> 'application/sql';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `verProyectos` (IN `matricula` INT(11))  BEGIN 
SELECT 
    pro.id as idProyecto,
    rep.id as idRepositorio,
    dat_p.matricula,
    pro.nombre_proyecto,
    pro.categoria,
    pro.descripcion,
    pro.icono,
    pro.fecha
FROM
    proyectos AS pro
        INNER JOIN
    repositorios AS rep ON rep.id = pro.id_repositorios
        INNER JOIN
    alumnos AS al ON al.id = rep.id_alumno
        INNER JOIN
    datos_personales AS dat_p ON dat_p.id = al.id_datos_personales
WHERE
    dat_p.matricula = matricula;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `verProyectosAdmin` (IN `nivel` VARCHAR(8), IN `cat` VARCHAR(11), IN `inicio` INT(8), IN `final` INT(8))  BEGIN 
SELECT 
    pro.id as idProyecto,
    rep.id as idRepositorio,
    dat_p.matricula,
    concat(dat_p.nombre," ",dat_p.apellidos) as nombreAlumno,
    al.grupo,
    pro.nombre_proyecto,
    pro.categoria,
    pro.descripcion,
    pro.icono,
    pro.fecha
FROM
    proyectos AS pro
        INNER JOIN
    repositorios AS rep ON rep.id = pro.id_repositorios
        INNER JOIN
    alumnos AS al ON al.id = rep.id_alumno
        INNER JOIN
    datos_personales AS dat_p ON dat_p.id = al.id_datos_personales
WHERE
    al.nivel_estudio = nivel and pro.categoria = cat order by pro.fecha DESC LIMIT inicio,final;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `verProyectosCategoria` (IN `nivel` VARCHAR(8))  BEGIN 
SELECT 
    pro.id as idProyecto,
    rep.id as idRepositorio,
    dat_p.matricula,
    concat(dat_p.nombre," ",dat_p.apellidos) as nombreAlumno,
    al.grupo,
    pro.nombre_proyecto,
    pro.categoria,
    pro.descripcion,
    pro.icono,
    pro.fecha
FROM
    proyectos AS pro
        INNER JOIN
    repositorios AS rep ON rep.id = pro.id_repositorios
        INNER JOIN
    alumnos AS al ON al.id = rep.id_alumno
        INNER JOIN
    datos_personales AS dat_p ON dat_p.id = al.id_datos_personales
WHERE
    al.nivel_estudio = nivel order by pro.fecha DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `verUsuarios` ()  BEGIN
SELECT 
    datp.id AS idDatos,
    usu.id as idUser,
    datp.matricula,
    datp.nombre,
    datp.apellidos,
    usu.nivel_user
FROM
    datos_personales AS datp
        INNER JOIN
    usuarios AS usu ON datp.id = usu.id_datos_personales
WHERE
    usu.nivel_user = 'Administrador'
        OR usu.nivel_user = 'Maestro';
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(11) NOT NULL,
  `id_datos_personales` int(11) DEFAULT NULL,
  `id_carrera` int(1) NOT NULL,
  `grupo` varchar(10) NOT NULL,
  `nivel_estudio` enum('TSU','ING') DEFAULT NULL,
  `pswrd` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `id_datos_personales`, `id_carrera`, `grupo`, `nivel_estudio`, `pswrd`) VALUES
(2, 3, 1, 'ITI9-2', 'ING', '12345'),
(3, 4, 4, 'ITI9-2', 'ING', '12345'),
(5, 6, 5, 'ITI2-2', 'ING', '1'),
(6, 7, 6, 'ITI8-2', 'ING', '12345'),
(7, 11, 7, 'ITI8-2', 'ING', '1'),
(8, 14, 7, 'ITI6C', 'ING', '1'),
(9, 18, 3, 'KAS', 'TSU', '12'),
(10, 19, 3, 'IT9-9', 'ING', '1'),
(11, 20, 2, 'IT2-5', 'ING', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id` int(11) NOT NULL,
  `id_proyecto` int(11) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `tama` varchar(255) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`id`, `id_proyecto`, `nombre`, `tipo`, `tama`, `ruta`, `fecha`, `hora`) VALUES
(24, 14, 'Account.png', 'image/png', '639', '../proyectos/18307081/Aa/Account.png', '2021-07-22', '23:45:16'),
(25, 18, 'Captura de pantalla (132).png', 'image/png', '79070', '../proyectos/12345678/Mirepo/Captura de pantalla (132).png', '2021-08-30', '13:02:10'),
(26, 18, 'jj.jpg', 'image/jpeg', '40421', '../proyectos/12345678/Mirepo/jj.jpg', '2021-08-30', '13:08:37'),
(43, 23, 'proyectos.sql', 'application/octet-stream', '3888', '../proyectos/11223344/Mis Tareas/proyectos.sql', '2021-12-01', '13:33:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asesores`
--

CREATE TABLE `asesores` (
  `id` int(11) NOT NULL,
  `id_datos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asesores`
--

INSERT INTO `asesores` (`id`, `id_datos`) VALUES
(1, 1),
(4, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id` int(1) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `logo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id`, `nombre`, `logo`) VALUES
(1, 'Procesos Alimentarios', 'http://localhost/sigrepo/logos/pa.png'),
(2, 'Mantenimiento Industrial', 'http://localhost/sigrepo/logos/m.png'),
(3, 'Desarrollo y Gestión de Software', 'http://localhost/sigrepo/logos/TI.png'),
(4, 'Energías Renovables', 'http://localhost/sigrepo/logos/er.png'),
(5, 'Gestión del Capital Humano', 'http://localhost/sigrepo/logos/pa.png'),
(6, 'Metal Mecánica', 'http://localhost/sigrepo/logos/mm.png'),
(7, 'Logística Internacional', 'http://localhost/sigrepo/logos/li.png'),
(8, 'Gestión y Desarrollo Turístico', 'http://localhost/sigrepo/logos/gdt.png'),
(9, 'Gastronomía', 'http://localhost/sigrepo/logos/GA.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_personales`
--

CREATE TABLE `datos_personales` (
  `id` int(11) NOT NULL,
  `matricula` int(8) NOT NULL,
  `nombre` varchar(35) NOT NULL,
  `apellidos` varchar(35) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datos_personales`
--

INSERT INTO `datos_personales` (`id`, `matricula`, `nombre`, `apellidos`, `fecha`) VALUES
(1, 1, 'prueba', 'pruebas', '2021-07-21'),
(3, 18307081, 'Beny Antonio', 'Jimenez Juarez', '2021-07-21'),
(4, 18307034, 'Karina', 'Vasquez Carrasquedo', '2021-07-21'),
(6, 55555, 'Juana', 'La Cubana', '2021-07-22'),
(7, 1452, 'Luna', 'Lkeba A', '2021-07-22'),
(11, 1111111, 'Rosas', 'R s', '2021-07-22'),
(13, 252525, 'Admin', 'Admin Admin', '2021-07-22'),
(14, 12345678, 'F', 'F a', '2021-08-30'),
(17, 152022020, 'Juana ', 'Zamora Raul', '2021-11-25'),
(18, 152525, 'jasjkad', 'akjdjkakdj', '2021-11-25'),
(19, 11223344, 'Rosas Imelda', 'Santos Sanxhes', '2021-11-26'),
(20, 2525, 'amsndsa', 'adshdajdjsd aasdadha', '2021-12-02');

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repositorios`
--

CREATE TABLE `repositorios` (
  `id` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `nombre` varchar(35) NOT NULL,
  `ruta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `repositorios`
--

INSERT INTO `repositorios` (`id`, `id_alumno`, `nombre`, `ruta`) VALUES
(1, 2, '18307081', '../proyectos/18307081'),
(2, 3, '16307034', '../proyectos/16307034'),
(3, 1, '18307010', '../proyectos/18307010'),
(4, 4, '15', '../proyectos/15'),
(5, 5, '12', '../proyectos/12'),
(6, 6, '1452', '../proyectos/1452'),
(7, 7, '1111111', '../proyectos/1111111'),
(8, 8, '12345678', '../proyectos/12345678'),
(9, 10, '11223344', '../proyectos/11223344'),
(10, 11, '2525', '../proyectos/2525');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `id_datos_personales` int(11) NOT NULL,
  `nick` int(8) NOT NULL,
  `pswrd` varchar(35) NOT NULL,
  `nivel_user` enum('Administrador','Maestro','Alumno') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_datos_personales`, `nick`, `pswrd`, `nivel_user`) VALUES
(1, 1, 1, '1', 'Administrador'),
(2, 3, 18307081, '12345', 'Alumno'),
(3, 4, 18307034, '12345', 'Alumno'),
(4, 2, 18307010, '12345', 'Alumno'),
(5, 5, 16, '12345', 'Alumno'),
(6, 6, 55555, '1', 'Alumno'),
(8, 7, 1452, '12345', 'Alumno'),
(10, 11, 1111111, '1', 'Alumno'),
(11, 13, 252525, '1', 'Maestro'),
(12, 14, 12345678, '1', 'Alumno'),
(13, 19, 11223344, '1', 'Alumno'),
(14, 20, 2525, '1', 'Alumno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_espera`
--

CREATE TABLE `usuarios_espera` (
  `id` int(11) NOT NULL,
  `id_datos_personales` int(11) NOT NULL,
  `estado` enum('Espera','Activo','Baja') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios_espera`
--

INSERT INTO `usuarios_espera` (`id`, `id_datos_personales`, `estado`) VALUES
(2, 3, 'Activo'),
(3, 4, 'Activo'),
(5, 6, 'Activo'),
(6, 7, 'Activo'),
(7, 11, 'Activo'),
(8, 14, 'Activo'),
(9, 18, 'Espera'),
(10, 19, 'Activo'),
(11, 20, 'Activo');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vistaasesores`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vistaasesores` (
`idAsesor` int(11)
,`idDatos` int(11)
,`matricula` int(8)
,`nombre` varchar(71)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vistaasesores`
--
DROP TABLE IF EXISTS `vistaasesores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vistaasesores`  AS SELECT `asesor`.`id` AS `idAsesor`, `dat_p`.`id` AS `idDatos`, `dat_p`.`matricula` AS `matricula`, concat(`dat_p`.`nombre`,' ',`dat_p`.`apellidos`) AS `nombre` FROM (`asesores` `asesor` join `datos_personales` `dat_p` on(`asesor`.`id_datos` = `dat_p`.`id`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_datos_personales` (`id_datos_personales`);

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asesores`
--
ALTER TABLE `asesores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_datos` (`id_datos`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matricula` (`matricula`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `repositorios`
--
ALTER TABLE `repositorios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_datos_personales` (`id_datos_personales`),
  ADD UNIQUE KEY `nick` (`nick`);

--
-- Indices de la tabla `usuarios_espera`
--
ALTER TABLE `usuarios_espera`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_datos_personales` (`id_datos_personales`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `asesores`
--
ALTER TABLE `asesores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `repositorios`
--
ALTER TABLE `repositorios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuarios_espera`
--
ALTER TABLE `usuarios_espera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
