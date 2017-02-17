-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-12-2016 a las 19:39:11
-- Versión del servidor: 5.5.22
-- Versión de PHP: 5.3.10-1ubuntu3.25

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `DB_Rentadvisor`
--
CREATE DATABASE `DB_Rentadvisor` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `DB_Rentadvisor`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `idcomment` int(11) NOT NULL AUTO_INCREMENT,
  `idobject` double NOT NULL,
  `iduser` double NOT NULL,
  `nameuser` VARCHAR( 255 ) NOT NULL ,
  `created_time` varchar(45) NOT NULL,
  `dateInsert` varchar(45) DEFAULT NULL,
  `content` varchar(10000) DEFAULT NULL,
  `comment` varchar(10000) DEFAULT NULL,
  `post_idpost` int(11) NOT NULL,
  PRIMARY KEY (`idcomment`),
  KEY `fk_comment_post_idx` (`post_idpost`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `picture`
--

CREATE TABLE IF NOT EXISTS `picture` (
  `idpicture` int(11) NOT NULL AUTO_INCREMENT,
  `idobject` double DEFAULT NULL,
  `pathImage` varchar(1000) NOT NULL,
  `iduser` double NOT NULL,
  `created_time` varchar(45) NOT NULL,
  `dateInsert` varchar(45) DEFAULT NULL,
  `content` varchar(10000) DEFAULT NULL,
  `comment` varchar(10000) DEFAULT NULL,
  `comment_idcomment` int(11)  NULL,
  PRIMARY KEY (`idpicture`),
  KEY `fk_picture_comment1_idx` (`comment_idcomment`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `idpost` int(11) NOT NULL AUTO_INCREMENT,
  `idobject` varchar(250) NOT NULL,
  `titlePost` text NOT NULL,
  `nameuser` varchar(255) NOT NULL,
  `iduser` double NOT NULL,
  `created_time` date NOT NULL,
  `dateInsert` varchar(45) DEFAULT NULL,
  `content` varchar(10000) DEFAULT NULL,
  `comment` varchar(10000) DEFAULT NULL,
  PRIMARY KEY (`idpost`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post_has_picture`
--

CREATE TABLE IF NOT EXISTS `post_has_picture` (
  `post_idpost` int(11) NOT NULL,
  `picture_idpicture` int(11) NOT NULL,
  PRIMARY KEY (`post_idpost`,`picture_idpicture`),
  KEY `fk_post_has_picture_picture1_idx` (`picture_idpicture`),
  KEY `fk_post_has_picture_post1_idx` (`post_idpost`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `replie`
--

CREATE TABLE IF NOT EXISTS `replie` (
  `idreplie` int(11) NOT NULL AUTO_INCREMENT,
  `idobject` double NOT NULL,
  `iduser` double NOT NULL,
  `nameuser` VARCHAR( 255 ) NOT NULL ,
  `created_time` varchar(45) NOT NULL,
  `dateInsert` varchar(45) DEFAULT NULL,
  `content` varchar(10000) DEFAULT NULL,
  `comment` mediumtext,
  `comment_idcomment` int(11) NOT NULL,
  PRIMARY KEY (`idreplie`),
  KEY `fk_replie_comment1_idx` (`comment_idcomment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment_post` FOREIGN KEY (`post_idpost`) REFERENCES `post` (`idpost`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `fk_picture_comment1` FOREIGN KEY (`comment_idcomment`) REFERENCES `comment` (`idcomment`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `post_has_picture`
--
ALTER TABLE `post_has_picture`
  ADD CONSTRAINT `fk_post_has_picture_picture1` FOREIGN KEY (`picture_idpicture`) REFERENCES `picture` (`idpicture`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_post_has_picture_post1` FOREIGN KEY (`post_idpost`) REFERENCES `post` (`idpost`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `replie`
--
ALTER TABLE `replie`
  ADD CONSTRAINT `fk_replie_comment1` FOREIGN KEY (`comment_idcomment`) REFERENCES `comment` (`idcomment`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
