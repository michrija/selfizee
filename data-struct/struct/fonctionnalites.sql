-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 22 août 2019 à 08:59
-- Version du serveur :  5.7.9
-- Version de PHP :  7.2.9

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
-- Structure de la table `fonctionalite_evenements`
--

DROP TABLE IF EXISTS `fonctionalite_evenements`;
CREATE TABLE IF NOT EXISTS `fonctionalite_evenements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evenement_id` int(11) NOT NULL,
  `fonctionnalite_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_fonctionalite_evenements` (`evenement_id`),
  KEY `FK_fonctionalite_evenements_2` (`fonctionnalite_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fonctionalite_evenements`
--



-- --------------------------------------------------------

--
-- Structure de la table `fonctionnalites`
--

DROP TABLE IF EXISTS `fonctionnalites`;
CREATE TABLE IF NOT EXISTS `fonctionnalites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  `description` text,
  `texte_helper` text,
  `titre_link` varchar(250) NOT NULL,
  `link` varchar(250) NOT NULL,
  `ordre` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fonctionnalites`
--

INSERT INTO `fonctionnalites` (`id`, `nom`, `description`, `texte_helper`, `titre_link`, `link`, `ordre`) VALUES
(1, 'Envoi email', 'Personnalisation du contenu de l\'email envoyé aux participants', '', 'Email', 'email-configurations/add/', 1),
(2, 'Envoi sms', 'Envoyé des photos par sms aux participants (nécéssite l\'activation de la collecte du téléphone portable )\r\n', '', 'Sms', 'sms-configurations/add/', 2),
(3, 'Configuration bornes', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam\r\n', '', 'Borne', 'configuration-bornes/add/', 3),
(4, 'Personnalisation de la galerie souvenir', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam\r\n', '', 'Galerie Souvenir', 'galeries/add/', 4),
(5, 'Personnalisation de la page souvenir', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam\r\n', NULL, 'Page souvenir', 'page-souvenirs/add/', 5),
(6, 'Configuration réseaux sociaux', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam\r\n', NULL, 'Réseaux Sociaux', 'rs-configurations/add/', 6),
(7, 'Positon formualire', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam', NULL, 'Formulaire', 'csv-colonne-positions/liste/', 7),
(8, 'Plannification', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam\r\n', NULL, 'Plannification', 'crons/add/', 8),
(9, 'Publication automatique sur la page Facebook ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam\r\n', '', 'Facebook Auto', 'facebook-autos/liste/', 9),
(10, 'Page de contenu', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam', '', 'Page de contenu', 'evenement-posts/liste/', 10);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `fonctionalite_evenements`
--
ALTER TABLE `fonctionalite_evenements`
  ADD CONSTRAINT `FK_fonctionalite_evenements` FOREIGN KEY (`evenement_id`) REFERENCES `evenements` (`id`),
  ADD CONSTRAINT `FK_fonctionalite_evenements_2` FOREIGN KEY (`fonctionnalite_id`) REFERENCES `fonctionnalites` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
