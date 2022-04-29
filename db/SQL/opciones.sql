-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-04-2019 a las 17:29:35
-- Versión del servidor: 5.7.25-0ubuntu0.18.04.2
-- Versión de PHP: 7.2.15-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `siia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones`
--

CREATE TABLE `opciones` (
  `id_opcion` int(11) NOT NULL COMMENT 'Id Tabla Opciones',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre de la Opcion: Imagen Texto ',
  `valor` longtext NOT NULL COMMENT 'Valor que se le da al Nombre'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Opciones del Sistema de Sia';

--
-- Volcado de datos para la tabla `opciones`
--

INSERT INTO `opciones` (`id_opcion`, `nombre`, `valor`) VALUES
(1, 'titulo', ''),
(2, 'logo', 'assets/img/logoHeader_j9rcK84myYnuevoLogo_0.png'),
(3, 'super', 'FALSE'),
(4, 'logo_app', 'assets/img/siia_logo.png'),
(5, 'modal', '0'),
(6, 'informacionModal', '<p>El <strong>23 de agosto de 2018</strong> entr&oacute; en funcionamiento el Sistema Integrado de Informaci&oacute;n de Acreditaci&oacute;n (SIIA), una plataforma que permite a las entidades del sector solidario realizar el tr&aacute;mite de acreditaci&oacute;n, consulta hist&oacute;rica, renovaciones, certificaciones de cursos y reportes estad&iacute;sticos, entre otras acciones, relacionadas con la autorizaci&oacute;n para impartir cursos de educaci&oacute;n solidaria.</p>\n\n<p>Esta plataforma reemplaz&oacute; al <a href=\"http://sitios.orgsolidarias.gov.co/SIA/\" target=\"_blank\">Sistema de Informaci&oacute;n y Acreditaci&oacute;n (SIA)</a>, que estar&aacute; disponible para realizar consultas hasta el pr&oacute;ximo <strong>31 de enero de 2019</strong>, de manera que invitamos a todas las entidades acreditadas, que a&uacute;n no han completado el proceso de migraci&oacute;n al nuevo SIIA, hacerlo dentro de las fechas estipuladas para evitar inconvenientes futuros.</p>\n\n<p>Recuerde que si est&aacute; interesado en acreditar su organizaci&oacute;n para impartir formaci&oacute;n en econom&iacute;a solidaria, en las modalidades de curso b&aacute;sico de econom&iacute;a solidaria y/o curso b&aacute;sico de econom&iacute;a solidaria con &eacute;nfasis en trabajo asociado, puede hacerlo en l&iacute;nea y de manera gratuita.</p>\n\n<p><em>Lo invitamos a consultar el proceso en nuestro portal web <a href=\"https://www.orgsolidarias.gov.co/\" target=\"_blank\">www.orgsolidarias.gov.co</a> para mayor informaci&oacute;n escribanos al correo electr&oacute;nico: <a href=\"mailto:atencionalciudadano@orgsolidarias.gov.co\">atencionalciudadano@orgsolidarias.gov.co</a></em></p>\n');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `opciones`
--
ALTER TABLE `opciones`
  ADD PRIMARY KEY (`id_opcion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `opciones`
--
ALTER TABLE `opciones`
  MODIFY `id_opcion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id Tabla Opciones', AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
