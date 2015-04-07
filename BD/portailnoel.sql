-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-11-2012 a las 14:31:03
-- Versión del servidor: 5.1.37
-- Versión de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `portailnoel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pn_annonce`
--

CREATE TABLE IF NOT EXISTS `pn_annonce` (
  `id_annonce` int(11) NOT NULL AUTO_INCREMENT,
  `montant_usser` int(11) DEFAULT NULL,
  `id_provincia` int(11) DEFAULT NULL,
  `id_usser` int(11) DEFAULT NULL,
  `descripcion` text,
  `rango_gasto` int(11) DEFAULT NULL,
  `clasificacion` char(1) DEFAULT NULL,
  `id_municipio` int(11) DEFAULT NULL,
  `nombre` text,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id_annonce`),
  KEY `id_usser` (`id_usser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Volcar la base de datos para la tabla `pn_annonce`
--

INSERT INTO `pn_annonce` (`id_annonce`, `montant_usser`, `id_provincia`, `id_usser`, `descripcion`, `rango_gasto`, `clasificacion`, `id_municipio`, `nombre`, `fecha`) VALUES
(34, 10, 1, 134, 'Acere es mi cumplea', 1, '1', 1, 'Mi cumplea', '2012-11-03'),
(35, 20, 1, 134, 'otro cunpleao loko ', 1, '1', 1, 'otro pedido para mi cumplea', '2012-10-31'),
(36, 50, 2, 134, 'Solo para restaurantes modo pago', 1, '2', 8, 'Cena Grande ', '2012-10-31'),
(37, 10, 2, 134, 'dasdasdasdasdasdasdasdasdasd', 1, '1', 8, 'Adicionando nuevo Anuncio', '2012-11-23'),
(38, 12, 4, 134, 'adasdasda ds asd asd asdasd', 2, '2', 10, 'Anuncio 1', '2012-11-30'),
(39, 12, 15, 134, 'asdasdasdasdasd', 1, '1', 4, 'Anuncio 2', '2012-11-30'),
(40, 12, 15, 134, 'asdasdasd', 1, '1', 4, 'Anuncio 3', '2012-11-30'),
(41, 12, 2, 134, 'asdasdasdasdasd', 3, '2', 8, 'Anuncio 4', '2012-12-29'),
(42, 12, 12, 134, 'Rango medio,', 2, '2', 2, 'Anuncio 5', '2012-11-30'),
(43, 12, 12, 134, 'asdasdasd', 3, '1', 3, 'Anuncio 6', '2012-11-30'),
(44, 112, 1, 134, 'asdasdasdasd', 2, '2', 12, 'Anuncio 7', '2012-12-28'),
(45, 12, 1, 134, 'sdasdasd', 1, '1', 11, 'Anuncio 8', '2012-11-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pn_borrador_form_restaurant`
--

CREATE TABLE IF NOT EXISTS `pn_borrador_form_restaurant` (
  `id_borrador` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `direccion` text,
  `email` varchar(100) DEFAULT NULL,
  `id_provincia` int(11) DEFAULT NULL,
  `id_municipio` int(11) DEFAULT NULL,
  `cif` int(11) DEFAULT NULL,
  `codigo_postal` int(11) DEFAULT NULL,
  `nota` text,
  `tipo_pago` int(11) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `id_comercial` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_borrador`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `pn_borrador_form_restaurant`
--

INSERT INTO `pn_borrador_form_restaurant` (`id_borrador`, `nombre`, `direccion`, `email`, `id_provincia`, `id_municipio`, `cif`, `codigo_postal`, `nota`, `tipo_pago`, `telefono`, `id_comercial`) VALUES
(2, 'Prueba de salva', '', '', 1, 0, 0, 0, '', 1, '', 138),
(3, 'Campaña completa', 'adsasdasdasdasdasdasdasd', '', 1, 0, 0, 0, 'campaña completa', 2, '', 138),
(4, 'Prueba de update', 'direccion update', '', 1, 0, 0, 0, 'Prueba de update direccion', 0, '', 138),
(5, '', '', '', 1, 0, 0, 0, '', 0, '', 138);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pn_comercial_promo_usser`
--

CREATE TABLE IF NOT EXISTS `pn_comercial_promo_usser` (
  `id_usser_add` int(11) DEFAULT NULL,
  `id_comercialp` int(11) DEFAULT NULL,
  KEY `id_usser_add` (`id_usser_add`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `pn_comercial_promo_usser`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pn_config_nom_registro`
--

CREATE TABLE IF NOT EXISTS `pn_config_nom_registro` (
  `id_nom_config` int(11) NOT NULL AUTO_INCREMENT,
  `cantPedido` int(11) DEFAULT NULL,
  `cantImg` int(11) DEFAULT NULL,
  `id_nom_registro` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_nom_config`),
  UNIQUE KEY `id_nom_config` (`id_nom_config`),
  KEY `id_nom_registro` (`id_nom_registro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `pn_config_nom_registro`
--

INSERT INTO `pn_config_nom_registro` (`id_nom_config`, `cantPedido`, `cantImg`, `id_nom_registro`) VALUES
(1, 5, 5, 0),
(2, 10, 10, 1),
(3, 15, 15, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pn_dialogo`
--

CREATE TABLE IF NOT EXISTS `pn_dialogo` (
  `id_dialogo` int(11) NOT NULL AUTO_INCREMENT,
  `id_restaurante` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_anuncio` int(11) NOT NULL,
  PRIMARY KEY (`id_dialogo`),
  UNIQUE KEY `id_dialogo` (`id_dialogo`),
  KEY `id_anuncio` (`id_anuncio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcar la base de datos para la tabla `pn_dialogo`
--

INSERT INTO `pn_dialogo` (`id_dialogo`, `id_restaurante`, `id_usuario`, `id_anuncio`) VALUES
(7, 136, 134, 34),
(8, 136, 134, 37);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pn_dialogo_texto`
--

CREATE TABLE IF NOT EXISTS `pn_dialogo_texto` (
  `id_dialogo_texto` int(11) NOT NULL AUTO_INCREMENT,
  `remitente` int(11) NOT NULL,
  `dialogo` text NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `leido` varchar(20) DEFAULT '0',
  `id_dialogo` int(11) NOT NULL,
  PRIMARY KEY (`id_dialogo_texto`),
  UNIQUE KEY `id_dialogo_texto` (`id_dialogo_texto`),
  KEY `id_dialogo_texto_2` (`id_dialogo_texto`,`remitente`,`dialogo`(1),`fecha`,`leido`),
  KEY `id_dialogo_texto_3` (`id_dialogo_texto`,`remitente`,`dialogo`(1),`fecha`,`leido`),
  KEY `id_dialogo_texto_4` (`id_dialogo_texto`,`remitente`,`fecha`,`dialogo`(1),`leido`),
  KEY `id_dialogo_texto_5` (`id_dialogo_texto`,`remitente`,`dialogo`(1),`fecha`,`leido`),
  KEY `id_dialogo` (`id_dialogo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Volcar la base de datos para la tabla `pn_dialogo_texto`
--

INSERT INTO `pn_dialogo_texto` (`id_dialogo_texto`, `remitente`, `dialogo`, `fecha`, `leido`, `id_dialogo`) VALUES
(34, 136, 'oe socio dime que vola ', '2012-10-27 01:54:10', '1', 7),
(35, 134, 'pero en cuanto tu me lodjas loko', '2012-10-27 10:29:40', '1', 7),
(36, 136, 'Chama que vola dime si te cuadra', '2012-10-27 18:07:28', '1', 7),
(37, 134, 'Ta bien loko ahora te acepto no joda mas ', '2012-10-27 18:09:52', '1', 7),
(38, 136, 'loko que vola', '2012-10-30 20:40:03', '1', 8),
(39, 136, 'chama ', '2012-10-30 20:40:23', '1', 8),
(40, 134, 'lko me cuadra', '2012-10-30 20:41:44', '1', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pn_menu_fotos`
--

CREATE TABLE IF NOT EXISTS `pn_menu_fotos` (
  `id_foto` int(11) NOT NULL AUTO_INCREMENT,
  `id_restaurante` int(11) DEFAULT NULL,
  `url` text,
  PRIMARY KEY (`id_foto`),
  UNIQUE KEY `id_foto` (`id_foto`),
  KEY `id_menu` (`id_restaurante`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Volcar la base de datos para la tabla `pn_menu_fotos`
--

INSERT INTO `pn_menu_fotos` (`id_foto`, `id_restaurante`, `url`) VALUES
(34, 136, '4ace9c4bd78bf1df234e52cd2e30c655.jpg'),
(35, 185, '8457fc3fdf5ed554f11d17c87f172a3b.PNG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pn_menu_restaurante`
--

CREATE TABLE IF NOT EXISTS `pn_menu_restaurante` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `id_restaurante` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id_menu`),
  UNIQUE KEY `id_menu` (`id_menu`),
  KEY `id_restaurante` (`id_restaurante`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Volcar la base de datos para la tabla `pn_menu_restaurante`
--

INSERT INTO `pn_menu_restaurante` (`id_menu`, `id_restaurante`, `nombre`, `descripcion`) VALUES
(54, 136, 'Arroz Frito', 'Arroz frito'),
(55, 136, 'Arroz Morro', 'carne en corncerva'),
(56, 136, 'Arroz Morro', 'carne en corncerva'),
(57, 136, 'Arroz con carne', 'carne en corncerva'),
(68, 136, 'qwe', 'qweqweqwe'),
(69, 185, 'Arozz', 'Prueba de Menu'),
(70, 185, 'otro menu', 'descripcion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pn_modalites_conditions`
--

CREATE TABLE IF NOT EXISTS `pn_modalites_conditions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `pn_modalites_conditions`
--

INSERT INTO `pn_modalites_conditions` (`id`, `description`) VALUES
(1, 'Prueba de requecitos hay que aceptarlo obligao');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pn_municipalite`
--

CREATE TABLE IF NOT EXISTS `pn_municipalite` (
  `id_municipalite` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(100) DEFAULT NULL,
  `id_province` int(11) NOT NULL,
  PRIMARY KEY (`id_municipalite`),
  KEY `id_province` (`id_province`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcar la base de datos para la tabla `pn_municipalite`
--

INSERT INTO `pn_municipalite` (`id_municipalite`, `prenom`, `id_province`) VALUES
(1, 'Nuevo Vedado', 1),
(2, 'Moa', 12),
(3, 'Sagua ', 12),
(4, 'Baracoa', 15),
(8, 'Artemisa', 2),
(10, 'Cerro', 4),
(11, 'San Luis', 1),
(12, 'Juane', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pn_nom_tipo_registro`
--

CREATE TABLE IF NOT EXISTS `pn_nom_tipo_registro` (
  `id_nom_registro` int(11) NOT NULL AUTO_INCREMENT,
  `nom_registro` text,
  PRIMARY KEY (`id_nom_registro`),
  UNIQUE KEY `id_nom_registro` (`id_nom_registro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `pn_nom_tipo_registro`
--

INSERT INTO `pn_nom_tipo_registro` (`id_nom_registro`, `nom_registro`) VALUES
(0, 'gratis'),
(1, 'media_campana\r\nmedia_campaña'),
(2, 'campaña_completa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pn_nom_usser`
--

CREATE TABLE IF NOT EXISTS `pn_nom_usser` (
  `tipo_usser` int(11) NOT NULL AUTO_INCREMENT,
  `groupe` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`tipo_usser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcar la base de datos para la tabla `pn_nom_usser`
--

INSERT INTO `pn_nom_usser` (`tipo_usser`, `groupe`) VALUES
(1, 'Admin'),
(2, 'usuario'),
(3, 'restaurante'),
(5, 'comercial venta'),
(6, 'comercial promocion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pn_promociones_restaurante`
--

CREATE TABLE IF NOT EXISTS `pn_promociones_restaurante` (
  `id_promociones` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_promocion` varchar(20) DEFAULT NULL,
  `id_restaurante` int(11) DEFAULT NULL,
  `url` text,
  `texto` text,
  `nombre` varchar(100) DEFAULT NULL,
  `publicada` int(11) DEFAULT '0',
  `author` int(11) DEFAULT NULL,
  `activa` int(11) DEFAULT '0',
  `activa_restaurante` int(11) DEFAULT '0',
  PRIMARY KEY (`id_promociones`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Volcar la base de datos para la tabla `pn_promociones_restaurante`
--

INSERT INTO `pn_promociones_restaurante` (`id_promociones`, `tipo_promocion`, `id_restaurante`, `url`, `texto`, `nombre`, `publicada`, `author`, `activa`, `activa_restaurante`) VALUES
(1, 'text', 136, NULL, 'Promocion a el balcon', 'Promocion El Balcon', 1, 14, 1, 1),
(3, 'text', 136, NULL, 'pal caraadam sdka msdla kms dla mlsdm lakdm lasfj sifg idbjdf db udbfvjdu fvbudb fjkeb', 'Promocion Laguna azul', 1, 14, 1, 1),
(16, 'text', 137, NULL, 'Promocion el frambollan', 'Promocion El Frambollan', NULL, 14, 0, 0),
(17, 'text', 136, NULL, 'Ven aki las mejores oferrtas', 'Promocion Hector', 0, 14, 1, 1),
(27, 'img', 136, 'ea1f7564deb1f7d7364493f0f0588d36.jpg', NULL, 'Promocios tipo imagen', 1, 14, 1, 0),
(28, 'img', 137, '9844e99f405a3650ac928689841a0588.jpg', '', 'Otra tipo imagen', 0, 14, 0, 0),
(29, 'img', 146, '31ec8147535be70a765957a1ffba77f8.jpg', '', 'laguna Azul', 0, 14, 0, 0),
(30, 'text', -1, NULL, 'asdasdasdasd asdasdasd asd asd asd asda dsa sd asd asd asd asd asda sd asd asd asda sd asd asdasd asd', 'Portada', 0, 14, 1, 0),
(31, 'img', 152, '6cdf800027e482aa2634b309fa8d40c4.jpg', NULL, 'Prueba', 0, 147, 1, 0),
(33, 'img', 152, 'abf900c57dc545f4476a81dc490afaa7.jpg', NULL, 'Prueba', 0, 147, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pn_province`
--

CREATE TABLE IF NOT EXISTS `pn_province` (
  `id_province` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_province`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcar la base de datos para la tabla `pn_province`
--

INSERT INTO `pn_province` (`id_province`, `prenom`) VALUES
(1, 'Pinar del Rio'),
(2, 'Artemisa'),
(3, 'Mayabeque'),
(4, 'La Habana'),
(5, 'Matanza'),
(6, 'Villa Clara'),
(7, 'Cienfuego'),
(8, 'Sancti Spíritu'),
(9, 'Ciego de Avila'),
(10, 'Camaguey'),
(11, 'Las Tunas'),
(12, 'Holguín'),
(13, 'Granma'),
(14, 'Santiago de Cuba'),
(15, 'Guantánamo'),
(16, 'La Isla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pn_restaurant`
--

CREATE TABLE IF NOT EXISTS `pn_restaurant` (
  `id_restaurant` int(11) NOT NULL AUTO_INCREMENT,
  `direccion` text,
  `cif` text,
  `telefono` varchar(100) DEFAULT NULL,
  `codigo_postal` varchar(20) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_tipo_registro` int(11) DEFAULT '0',
  `logo` text,
  PRIMARY KEY (`id_restaurant`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Volcar la base de datos para la tabla `pn_restaurant`
--

INSERT INTO `pn_restaurant` (`id_restaurant`, `direccion`, `cif`, `telefono`, `codigo_postal`, `id_usuario`, `id_tipo_registro`, `logo`) VALUES
(12, 'EN Moa y en la habana ', '125', '58152374', '83330', 136, 0, NULL),
(13, 'el frambollan', '125', '58152374', '83330', 137, 0, NULL),
(18, 'La laguna', '1254', '58152374', '83330', 146, 0, NULL),
(19, 'asdasasdasdasddasd', '253', '5862365', '123123', 152, 1, NULL),
(20, 'asdasdasdasdasdasd', '123', '58152374', '123123', 153, 2, NULL),
(21, 'adadasdasdasd', '123123', '85685658', '123123123', 154, 1, NULL),
(22, 'sadasdasdasd', '123', '5845865', '12312', 155, 0, NULL),
(23, 'asdasdasdasdasd', '213', '58152374', '123', 156, 0, NULL),
(24, 'asdasdad dasdasdasd', '123', '58152374', '123123', 158, 0, NULL),
(25, 'asdasdasd', '123', '58152374', '123', 160, 1, NULL),
(26, 'asdakl sdlak sdlkals dmlamksd ', '258', '58152374', '830352', 161, 2, NULL),
(27, '123123123123', '123', '58152374', '12312', 162, 2, NULL),
(28, 'asdada dsa d asdasd asdasd', '123', '13123123', '123123', 163, 0, NULL),
(29, 'asdasdasdasd', '123', '586945', '123123', 164, 0, NULL),
(30, 'adsasdasdasd', '123123', '123123123', '12312312', 165, 0, NULL),
(31, 'asdasdasd', '123', '8569', '123123', 166, 0, NULL),
(32, 'asdasdasd', '123', '8569', '123123', 167, 2, NULL),
(33, 'asdasdasd', '123', '8569', '123123', 168, 2, NULL),
(34, 'adasdasd asd', '123', '58152374', '123', 169, 2, NULL),
(37, 'asdasdasdasd', '123', '23123', '123', 178, 0, 'a4ab6844c9e652af57ad62450fcd82a6.jpg'),
(38, '12312312312', '1231', '85685658', '12312', 179, 2, '7b1713cbf7ade47fdc207e9e882bd575.png'),
(43, 'dasdq wq qw qw eqwe qwe', '123123', '58152374', '123123', 185, 2, '18ed15688dc372038dfcfaed4eea1e0b.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pn_restaurant_annonce`
--

CREATE TABLE IF NOT EXISTS `pn_restaurant_annonce` (
  `id_restaurant` int(11) NOT NULL,
  `id_annonce` int(11) NOT NULL,
  `costo` int(11) DEFAULT NULL,
  `descripcion` text,
  `aceptado` varchar(10) DEFAULT '0',
  PRIMARY KEY (`id_restaurant`,`id_annonce`),
  KEY `id_annonce` (`id_annonce`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `pn_restaurant_annonce`
--

INSERT INTO `pn_restaurant_annonce` (`id_restaurant`, `id_annonce`, `costo`, `descripcion`, `aceptado`) VALUES
(136, 34, 200, 'Chama en 200 fula te cuadra', '1'),
(136, 37, 123, 'asdasdasdasdasdasd', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pn_restaurant_datos_config`
--

CREATE TABLE IF NOT EXISTS `pn_restaurant_datos_config` (
  `id_restaurante_datos_config` int(11) NOT NULL AUTO_INCREMENT,
  `id_restaurante` int(11) NOT NULL,
  `cantPedidos` int(11) DEFAULT NULL,
  `cantFotos` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_restaurante_datos_config`),
  UNIQUE KEY `id_restaurante_datos_config` (`id_restaurante_datos_config`),
  UNIQUE KEY `id_restaurante` (`id_restaurante`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Volcar la base de datos para la tabla `pn_restaurant_datos_config`
--

INSERT INTO `pn_restaurant_datos_config` (`id_restaurante_datos_config`, `id_restaurante`, `cantPedidos`, `cantFotos`) VALUES
(2, 136, 2, 2),
(3, 137, 0, 0),
(4, 139, 0, 0),
(5, 142, 0, 0),
(6, 144, 0, 0),
(7, 145, 0, 0),
(8, 146, 0, 0),
(9, 152, 0, 0),
(10, 153, 0, 0),
(11, 154, 0, 0),
(12, 155, 0, 0),
(13, 156, 0, 0),
(14, 158, 0, 0),
(15, 160, 0, 0),
(16, 161, 0, 0),
(17, 162, 0, 0),
(18, 163, 0, 0),
(19, 164, 0, 0),
(20, 165, 0, 0),
(21, 166, 0, 0),
(22, 167, 0, 0),
(23, 168, 0, 0),
(24, 169, 0, 0),
(25, 174, 0, 0),
(26, 176, 0, 0),
(27, 178, 0, 0),
(28, 179, 0, 0),
(29, 180, 0, 0),
(30, 181, 0, 0),
(31, 183, 0, 0),
(32, 184, 0, 0),
(33, 185, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pn_usser`
--

CREATE TABLE IF NOT EXISTS `pn_usser` (
  `id_usser` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_usser` int(11) NOT NULL,
  `email` varchar(128) NOT NULL DEFAULT '',
  `section_active` int(11) DEFAULT NULL,
  `nombre` char(128) DEFAULT NULL,
  `apellidos` varchar(128) DEFAULT NULL,
  `id_province` int(11) DEFAULT NULL,
  `id_municipalite` int(11) DEFAULT NULL,
  `password` text,
  `codigo_activacion` text,
  PRIMARY KEY (`id_usser`,`tipo_usser`),
  UNIQUE KEY `email` (`email`),
  KEY `Refpn_nom_usser1` (`tipo_usser`),
  KEY `Refpn_province5` (`id_province`),
  KEY `Refpn_municipalite14` (`id_municipalite`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=186 ;

--
-- Volcar la base de datos para la tabla `pn_usser`
--

INSERT INTO `pn_usser` (`id_usser`, `tipo_usser`, `email`, `section_active`, `nombre`, `apellidos`, `id_province`, `id_municipalite`, `password`, `codigo_activacion`) VALUES
(14, 1, 'admin@gmail.com', 1, 'Hector Luis', 'Reyes Pupo', 1, 1, 'admin', NULL),
(134, 2, 'usuario@gmail.com', 1, 'Heidy Alejandra', 'ReyesBarrizonte', 1, 1, 'USUARIO', NULL),
(135, 2, 'usuario1@gmail.com', 1, 'Zury', 'Sadai', 12, 1, 'usuario', NULL),
(136, 3, 'balcon@gmail.com', 1, 'El Balcon', '', 2, 8, 'balcon', NULL),
(137, 3, 'frb@gmail.com', 1, 'frambollan', '', 12, 3, 'frb', NULL),
(138, 5, 'cmv@gmail.com', 1, 'Comercial', 'Ventas', 4, 10, 'cmv', NULL),
(146, 3, 'lgazul@gmail.com', 1, 'La Laguna Azul', '', 12, 2, 'CJ657w1efn', NULL),
(147, 6, 'cmp@gmail.com', 1, 'Comercial', 'Promocion', 2, 8, 'cmp', NULL),
(152, 3, 'rest1@gmail.com', 1, 'Restaurante Media', '', 4, 10, 'JD33WLqj76', NULL),
(153, 3, 'rest2@gmail.com', 1, 'Restaurante Completa', '', 15, 4, 'jwkNhU3fq3', NULL),
(154, 3, 'frambollan@gmail.com', 0, 'frambollan', '', 2, 8, 'HpIkjdOSCv', NULL),
(155, 3, 'campana@gmail.com', 0, 'camoaaCOmpleta', '', 15, 4, 'US7cIqB1nZ', NULL),
(156, 3, 'rcmp1@gmail.com', 0, 'Restaurante Completa 1', '', 15, 1, 'Wx78jYH22Q', NULL),
(158, 3, 'cima@gmail.com', 0, 'Disco Cima', '', 12, 1, '0zq9bAtQs2', NULL),
(160, 3, 'rm1@gmail.com', 0, 'Restaurante Media 1', '', 15, 1, 'B5nVbihDkN', NULL),
(161, 3, 'rcmp2@gmail.com', 0, 'Restaurante Completa 2', '', 12, 1, 'GZSLLjKUQs', NULL),
(162, 3, 'rcmp3@gmail.com', 0, 'Restaurante Completa 3', '', 4, 1, 'ghasy0lAt9', NULL),
(163, 3, 'pcmv@gmail.com', 1, 'Prueba CMV', '', 15, 1, 'w4Uc7eC9Ng', NULL),
(164, 3, 'pcmv1@gmail.com', 1, 'Prueba CMV', '', 2, 1, 'mHNIu3pnGE', NULL),
(165, 3, 'pcmv3@gmail.com', 1, 'Prueba CMV3', '', 12, 1, '258czwVKRg', NULL),
(166, 3, 'pcmv4@gmail.com', 1, 'Prueba CMV 4', '', 2, 1, 'cqasdlJjka', NULL),
(167, 3, 'pcmv5@gmail.com', 1, 'Prueba CMV 5', '', 4, 1, 'QXfNlHKXPp', NULL),
(168, 3, 'pcmv6@gmail.com', 1, 'Prueba CMV 6', '', 4, 1, 'CCXNXQ3y1f', NULL),
(169, 3, 'pcmv7@gmail.com', 1, 'Prueba CMV 7', '', 15, 1, 'nuPI4vCZsC', NULL),
(178, 3, 'qqqqqqq@aaaa.aa', 0, 'asdasdasd', '', 2, 1, 'bm5MkL4i3q', NULL),
(179, 3, 'rcmpLogo@gmail.com', 0, 'Restaurante Completa', '', 1, 1, 'AXuT5uKPZE', NULL),
(185, 3, 'elpapi@gmail.com', 1, 'El Papi', '', 12, 1, 'e156e72ceae746a0d444dfa9249a2bc8cad7a62a', 'je9bX');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pn_usser_comercial_promocion`
--

CREATE TABLE IF NOT EXISTS `pn_usser_comercial_promocion` (
  `id_cmp` int(11) NOT NULL AUTO_INCREMENT,
  `id_usser` int(11) DEFAULT NULL,
  `cant_prom_hechas` int(11) DEFAULT NULL,
  `cant_prom_activas` int(11) DEFAULT NULL,
  `cant_prom_delete` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cmp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `pn_usser_comercial_promocion`
--


--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `pn_annonce`
--
ALTER TABLE `pn_annonce`
  ADD CONSTRAINT `id_usser` FOREIGN KEY (`id_usser`) REFERENCES `pn_usser` (`id_usser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pn_comercial_promo_usser`
--
ALTER TABLE `pn_comercial_promo_usser`
  ADD CONSTRAINT `id_usser_add` FOREIGN KEY (`id_usser_add`) REFERENCES `pn_usser` (`id_usser`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pn_config_nom_registro`
--
ALTER TABLE `pn_config_nom_registro`
  ADD CONSTRAINT `id_nom_registro` FOREIGN KEY (`id_nom_registro`) REFERENCES `pn_nom_tipo_registro` (`id_nom_registro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pn_dialogo`
--
ALTER TABLE `pn_dialogo`
  ADD CONSTRAINT `id_anuncio` FOREIGN KEY (`id_anuncio`) REFERENCES `pn_annonce` (`id_annonce`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pn_dialogo_texto`
--
ALTER TABLE `pn_dialogo_texto`
  ADD CONSTRAINT `id_dialogo` FOREIGN KEY (`id_dialogo`) REFERENCES `pn_dialogo` (`id_dialogo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pn_menu_restaurante`
--
ALTER TABLE `pn_menu_restaurante`
  ADD CONSTRAINT `id_restaurante` FOREIGN KEY (`id_restaurante`) REFERENCES `pn_restaurant` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pn_municipalite`
--
ALTER TABLE `pn_municipalite`
  ADD CONSTRAINT `id_province` FOREIGN KEY (`id_province`) REFERENCES `pn_province` (`id_province`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pn_restaurant`
--
ALTER TABLE `pn_restaurant`
  ADD CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `pn_usser` (`id_usser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pn_restaurant_annonce`
--
ALTER TABLE `pn_restaurant_annonce`
  ADD CONSTRAINT `id_annonce` FOREIGN KEY (`id_annonce`) REFERENCES `pn_annonce` (`id_annonce`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_restaurant` FOREIGN KEY (`id_restaurant`) REFERENCES `pn_restaurant` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
