-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-08-2019 a las 02:24:49
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mapache`
--

--
-- Volcado de datos para la tabla `modules`
--

INSERT INTO `modules` (`Module_Name`, `Coordinates`, `Directions`, `Image_Path`, `created_at`, `updated_at`) VALUES
('A', '20.653944081625937,-103.32570453252974', 'Ayudanos a describir este lugar :)', 'img/modulos/MA.jpg', NULL, NULL),
('B', '20.65404514798493,-103.32502479599897', 'Ayudanos a describir este lugar :)', 'img/modulos/MB.jpg', NULL, NULL),
('C', '20.65424129128033,-103.32520490881836', 'Ayudanos a describir este lugar :)', 'img/modulos/MC.jpg', NULL, NULL),
('CTA', '20.656425945665873,-103.32491676648222', 'Ayudanos a describir este lugar :)', 'img/modulos/MCTA.jpg', NULL, NULL),
('D', '20.654508464194123,-103.32550953466888', 'Ayudanos a describir este lugar :)', 'img/modulos/MD.jpg', NULL, NULL),
('E', '20.65561779543377,-103.32552294570445', 'Ayudanos a describir este lugar :)', 'img/modulos/ME.jpg', NULL, NULL),
('G', '20.655841036962713,-103.32699349150192', 'Ayudanos a describir este lugar :)', 'img/modulos/MG.jpg', NULL, NULL),
('MV2', '20.65812254511502,-103.32603779908179', 'Ayudanos a describir este lugar :)', 'img/modulos/MV2.jpg', NULL, NULL),
('N', '20.656905633818923,-103.32620326723102', 'Ayudanos a describir este lugar :)', 'img/modulos/MN.jpg', NULL, NULL),
('O', '20.65729934538342,-103.32621482486846', 'Ayudanos a describir este lugar :)', 'img/modulos/MO.jpg', NULL, NULL),
('Q', '20.657631204542653,-103.32489886682265', 'por definir', 'img/modulos/MQ.jpg', NULL, NULL),
('T', 'Por definir', 'por definir', 'por definir', NULL, NULL),
('UCT-1', '20.656438126127156,-103.32532802024919', 'Edificio Beta', 'img/modulos/MBETA.jpg', NULL, NULL),
('UCT-2', '20.656237148813744,-103.32530924477314', 'Edificio Alfa', 'img/modulos/MALFA.jpg', NULL, NULL),
('X', '20.658249692124826,-103.3268488327696', 'por definir', 'img/modulos/MX.jpg', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
