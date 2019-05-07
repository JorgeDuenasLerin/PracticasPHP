/*!40101 SET NAMES utf8 */;

--
-- Base de datos: fruteria
--
DROP DATABASE IF EXISTS `fruteria`;
CREATE DATABASE `fruteria` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `fruteria`;


CREATE TABLE IF NOT EXISTS `tipo` (
  `id` int NOT NULL,
  `nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `tipo` (`id`, `nombre`) VALUES
(1, 'Frutas'),
(2, 'Vegetales'),
(3, 'Frutos secos'),
(4, 'Huevos'),
(5, 'Otros productos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text,
  `precio` decimal(10,2) NOT NULL,
  `ecologico` boolean DEFAULT false NOT NULL,
  `tipo` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`),
  FOREIGN KEY tipo_fk (tipo)
				REFERENCES tipo(id)
);

--
-- Volcar la base de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `descripcion`, `precio`, `ecologico`, `tipo`) VALUES

(1, 'Tomates pare', 'Tomates pera', '1.95', false, 2);
(2, 'Pimientos verde', 'Pimiento verde', '1.85', false, 2);
(3, 'Manzana golden', 'Manzana golden', '1.95', false, 1);
(4, 'Manzana Ecológica', 'Manzana eco', '1.95', true, 1);
(5, 'Naranjas zumo', 'Naranjas zumo', '1.95', false, 1);
(6, 'Huevo corral eco', 'Huevo corral eco', '3.95', true, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--
/*
CREATE TABLE IF NOT EXISTS `stock` (
  `producto` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `tienda` int(11) NOT NULL,
  `unidades` int(11) NOT NULL,
  PRIMARY KEY (`producto`,`tienda`),
  KEY `stock_ibfk_2` (`tienda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcar la base de datos para la tabla `stock`
--

INSERT INTO `stock` (`producto`, `tienda`, `unidades`) VALUES
('3DSNG', 1, 1),
('3DSNG', 2, 1),
('3DSNG', 3, 1),
('ACERAX3950', 1, 1),
('ARCLPMP32GBN', 2, 1),
('ARCLPMP32GBN', 3, 2),
('BRAVIA2BX400', 3, 1),
('EEEPC1005PXD', 1, 2),
('EEEPC1005PXD', 2, 1),
('HPMIN1103120', 2, 1),
('HPMIN1103120', 3, 2),
('IXUS115HSAZ', 2, 2),
('KSTDT101G2', 3, 1),
('KSTDTG332GBR', 2, 2),
('KSTMSDHC8GB', 1, 1),
('KSTMSDHC8GB', 2, 2),
('KSTMSDHC8GB', 3, 2),
('LEGRIAFS306', 2, 1),
('LGM237WDP', 1, 1),
('LJPROP1102W', 2, 2),
('OPTIOLS1100', 1, 3),
('OPTIOLS1100', 2, 1),
('PAPYRE62GB', 1, 1),
('PAPYRE62GB', 2, 1),
('PAPYRE62GB', 3, 1),
('PBELLI810323', 2, 1),
('PIXMAIP4850', 2, 1),
('PIXMAIP4850', 3, 2),
('PIXMAMP252', 2, 1),
('PS3320GB', 1, 1),
('PWSHTA3100PT', 2, 2),
('PWSHTA3100PT', 3, 2),
('SMSGCLX3175', 2, 1),
('SMSN150101LD', 3, 1),
('SMSSMXC200PB', 2, 1),
('STYLUSSX515W', 1, 1),
('TSSD16GBC10J', 3, 2),
('ZENMP48GB300', 1, 3),
('ZENMP48GB300', 2, 2),
('ZENMP48GB300', 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda`
--

CREATE TABLE IF NOT EXISTS `tienda` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tlf` varchar(13) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `tienda`
--

INSERT INTO `tienda` (`cod`, `nombre`, `tlf`) VALUES
(1, 'CENTRAL', '600100100'),
(2, 'SUCURSAL1', '600100200'),
(3, 'SUCURSAL2', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `contrasena` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcar la base de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `contrasena`) VALUES
('dwes', 'e8dc8ccd5e5f9e3a54f07350ce8a2d3d');

*/
