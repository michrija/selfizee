-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 04 sep. 2019 à 11:10
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `selfizeev2`
--

-- --------------------------------------------------------

--
-- Structure de la table `editeur_templates`
--

DROP TABLE IF EXISTS `editeur_templates`;
CREATE TABLE IF NOT EXISTS `editeur_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_editeur` varchar(255) DEFAULT NULL,
  `type_menu` enum('fonds','elements','contours','textes') NOT NULL DEFAULT 'fonds',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `editeur_templates`
--

INSERT INTO `editeur_templates` (`id`, `type_editeur`, `type_menu`) VALUES
(5, 'Images de fonds', 'fonds'),
(6, 'Textures', 'fonds'),
(7, 'Photos', 'elements'),
(8, 'Photos', 'contours');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
