-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-04-2024 a las 23:29:52
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
  `titol` varchar(20) NOT NULL,
  `image` text NOT NULL,
  `nom` varchar(20) NOT NULL,
  `punts` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=230 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grups`
--

INSERT INTO `grups` (`id`, `titol`, `image`, `nom`, `punts`) VALUES
(227, 'Gaviota', '2nd Best Name.png', 'Grup1', 0),
(228, 'Grup2', 'default.jpg', 'Grup2', 0),
(229, 'Grup3', 'default.jpg', 'Grup3', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `email` varchar(40) DEFAULT NULL,
  `password` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=257 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`id`, `nom`, `cognom`, `edat`, `curs`, `grup`, `admin`, `prof`, `email`, `password`) VALUES
(141, '', '', 0, '', '', 1, 0, 'admin@example.com', '$2y$10$/aVK5KW1Iqu4MSpafRQ3Tu18Ee6mx8MefqssXniY.qmKPBKS6u6I6'),
(181, 'sergi', 'Apellido 1', 20, 'DAW1', 'Grup1', 0, 0, NULL, NULL),
(182, 'Martin', 'Apellido 2', 20, 'DAW1', 'Grup1', 0, 0, NULL, NULL),
(183, 'adria', 'Apellido 3', 20, 'DAW1', 'Grup2', 0, 0, NULL, NULL),
(184, 'mayank', 'Apellido 4', 20, 'DAW1', 'Grup1', 0, 0, NULL, NULL),
(185, 'abel', 'Apellido 5', 20, 'DAW1', 'Grup2', 0, 0, NULL, NULL),
(186, 'mario', 'Apellido 6', 14, 'DAW1', 'Grup2', 0, 0, NULL, NULL),
(187, 'angel', 'Apellido 7', 20, 'DAW1', 'Grup1', 0, 0, NULL, NULL),
(188, 'elyas', 'Apellido 8', 20, 'DAW1', 'Grup3', 0, 0, NULL, NULL),
(189, 'alberto', 'Apellido 9', 20, 'DAW1', 'Grup3', 0, 0, NULL, NULL),
(190, 'raul', 'Apellido 10', 20, 'DAW2', 'Grup3', 0, 0, NULL, NULL),
(191, 'eric', 'Apellido 11', 20, 'DAW2', 'Grup2', 0, 0, NULL, NULL),
(192, 'david', 'Apellido 12', 21, 'DAW2', 'Grup3', 0, 0, NULL, NULL),
(193, 'Alumno1', 'Apellido 13', 22, 'DAW2', 'Grup2', 0, 0, NULL, NULL),
(194, 'Alumno14', 'Apellido 14', 45, 'DAW2', 'Grup2', 0, 0, NULL, NULL),
(195, 'Alumno15', 'Apellido 15', 24, 'DAW2', 'Grup3', 0, 0, NULL, NULL),
(196, 'Alumno16', 'Apellido 16', 25, 'DAW2', 'Grup2', 0, 0, NULL, NULL),
(197, 'Alumno17', 'Apellido 17', 26, 'DAW2', 'Grup3', 0, 0, NULL, NULL),
(198, 'Alumno18', 'Apellido 18', 27, 'SMX1', 'Grup1', 0, 0, NULL, NULL),
(199, 'Alumno19', 'Apellido 19', 28, 'SMX1', 'Grup1', 0, 0, NULL, NULL),
(200, 'Alumno20', 'Apellido 20', 29, 'SMX1', 'Grup2', 0, 0, NULL, NULL),
(201, 'Alumno21', 'Apellido 21', 30, 'SMX1', 'Grup2', 0, 0, NULL, NULL),
(202, 'Alumno22', 'Apellido 22', 31, 'SMX1', 'Grup1', 0, 0, NULL, NULL),
(203, 'Alumno23', 'Apellido 23', 32, 'SMX2', 'Grup2', 0, 0, NULL, NULL),
(204, 'Alumno24', 'Apellido 24', 33, 'SMX2', 'Grup1', 0, 0, NULL, NULL),
(205, 'Alumno25', 'Apellido 25', 34, 'SMX2', 'Grup3', 0, 0, NULL, NULL),
(206, 'Alumno26', 'Apellido 26', 35, 'ASIX1', 'Grup1', 0, 0, NULL, NULL),
(207, 'Alumno27', 'Apellido 27', 36, 'ASIX1', 'Grup1', 0, 0, NULL, NULL),
(208, 'Alumno28', 'Apellido 28', 37, 'ASIX1', 'Grup3', 0, 0, NULL, NULL),
(216, 'juan', 'asd', 0, '', '', 0, 1, 'a.tarensi2@sapalomera.cat', '$2y$10$BOSZxXm2cZNujC0WAB0C4eHi3JwRAbLkzVHnsCEZzXEPOGNY3V.L.'),
(254, 'Grup1', '', 0, '', '', 0, 0, 'Grup1@gmail.com', '$2y$10$rnMsMF3pMtPQm6U4lb/f1.xY1/Z6//4/7SHxIbw/.1UmQMu/NT3Se'),
(255, 'Grup2', '', 0, '', '', 0, 0, 'Grup2@gmail.com', '$2y$10$LM0jLDMXx/iiybjW9gYCGubttN0ubR/IOJQJprIN1WUyT7rJJGOP.'),
(256, 'Grup3', '', 0, '', '', 0, 0, 'Grup3@gmail.com', '$2y$10$vhkgo7ZF05BR0YHyA/cshOjqXmnPXjd3l4gQ3jFTMBRrkGf7JCGX6');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
