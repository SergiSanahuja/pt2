-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-03-2024 a las 17:56:52
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `activitat_de_cohesio`
--
DROP DATABASE IF EXISTS `activitat_de_cohesio`;
CREATE DATABASE IF NOT EXISTS `activitat_de_cohesio` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `activitat_de_cohesio`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grups`
--

DROP TABLE IF EXISTS `grups`;
CREATE TABLE IF NOT EXISTS `grups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `punts` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grups`
--

INSERT INTO `grups` (`id`, `nom`, `punts`, `email`, `password`) VALUES
(174, 'Grup1', 0, 'Grup1@gmail.com', '$2y$10$gWBAWi7Zy6rMLL849iVPIuv4BpUMbkwgcCcQL8mppct5NB8HjVl0y'),
(175, 'Grup2', 0, 'Grup2@gmail.com', '$2y$10$i3TOg/h4dmsH4.1AJAnSSeZs1fE8K3jvJS37vunekzkmKuSIV2R6S'),
(176, 'Grup3', 0, 'Grup3@gmail.com', '$2y$10$Dio0ONHGBZOw5mopC1.HSOdshOUo7yqgG2b2xWCdm3h6ezF18QJEG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL,
  `password` text NOT NULL,
  `session_token` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id`, `email`, `password`, `session_token`) VALUES
(1, 'admin@example.com', '$2y$10$je1QqCk4kRhKb2ATUgCA9.VHK4WCxcCfMCrPlmzUEreGMcdHqixrG', 0),
(2, 'prova@example.com', '$2y$10$xcZGdZlbYpEH5W/X18GdkOpyGHb5eNB2M4prx4fi2bxgwyMBXjwpS', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materials`
--

DROP TABLE IF EXISTS `materials`;
CREATE TABLE IF NOT EXISTS `materials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `quantitat` int(11) NOT NULL,
  `imatge` text DEFAULT NULL,
  `pagat` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tallers`
--

DROP TABLE IF EXISTS `tallers`;
CREATE TABLE IF NOT EXISTS `tallers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `material` text NOT NULL,
  `professor` varchar(45) NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

DROP TABLE IF EXISTS `usuaris`;
CREATE TABLE IF NOT EXISTS `usuaris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `cognom` varchar(30) NOT NULL,
  `edat` int(11) NOT NULL,
  `curs` varchar(20) NOT NULL,
  `grup` varchar(20) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `prof` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`id`, `nom`, `cognom`, `edat`, `curs`, `grup`, `admin`, `prof`) VALUES
(113, 'sergi', 'Apellido 1', 20, 'DAW1', 'Grup1', 0, 0),
(114, 'Martin', 'Apellido 2', 20, 'DAW1', 'Grup2', 0, 0),
(115, 'adria', 'Apellido 3', 20, 'DAW1', 'Grup2', 0, 0),
(116, 'mayank', 'Apellido 4', 20, 'DAW1', 'Grup3', 0, 0),
(117, 'abel', 'Apellido 5', 20, 'DAW1', 'Grup2', 0, 0),
(118, 'mario', 'Apellido 6', 14, 'DAW1', 'Grup2', 0, 0),
(119, 'angel', 'Apellido 7', 20, 'DAW1', 'Grup2', 0, 0),
(120, 'elyas', 'Apellido 8', 20, 'DAW1', 'Grup2', 0, 0),
(121, 'alberto', 'Apellido 9', 20, 'DAW1', 'Grup1', 0, 0),
(122, 'raul', 'Apellido 10', 20, 'DAW2', 'Grup1', 0, 0),
(123, 'eric', 'Apellido 11', 20, 'DAW2', 'Grup2', 0, 0),
(124, 'david', 'Apellido 12', 21, 'DAW2', 'Grup3', 0, 0),
(125, 'Alumno1', 'Apellido 13', 22, 'DAW2', 'Grup2', 0, 0),
(126, 'Alumno14', 'Apellido 14', 45, 'DAW2', 'Grup2', 0, 0),
(127, 'Alumno15', 'Apellido 15', 24, 'DAW2', 'Grup3', 0, 0),
(128, 'Alumno16', 'Apellido 16', 25, 'DAW2', 'Grup1', 0, 0),
(129, 'Alumno17', 'Apellido 17', 26, 'DAW2', 'Grup3', 0, 0),
(130, 'Alumno18', 'Apellido 18', 27, 'SMX1', 'Grup1', 0, 0),
(131, 'Alumno19', 'Apellido 19', 28, 'SMX1', 'Grup3', 0, 0),
(132, 'Alumno20', 'Apellido 20', 29, 'SMX1', 'Grup3', 0, 0),
(133, 'Alumno21', 'Apellido 21', 30, 'SMX1', 'Grup1', 0, 0),
(134, 'Alumno22', 'Apellido 22', 31, 'SMX1', 'Grup2', 0, 0),
(135, 'Alumno23', 'Apellido 23', 32, 'SMX2', 'Grup3', 0, 0),
(136, 'Alumno24', 'Apellido 24', 33, 'SMX2', 'Grup1', 0, 0),
(137, 'Alumno25', 'Apellido 25', 34, 'SMX2', 'Grup1', 0, 0),
(138, 'Alumno26', 'Apellido 26', 35, 'ASIX1', 'Grup1', 0, 0),
(139, 'Alumno27', 'Apellido 27', 36, 'ASIX1', 'Grup3', 0, 0),
(140, 'Alumno28', 'Apellido 28', 37, 'ASIX1', 'Grup3', 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
