-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 22 mars 2019 à 03:16
-- Version du serveur :  10.1.33-MariaDB
-- Version de PHP :  7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `selfizee_event_09122018`
--

-- --------------------------------------------------------

--
-- Structure de la table `credits`
--

CREATE TABLE `credits` (
  `id` int(11) NOT NULL,
  `credit` double DEFAULT NULL,
  `etat` int(11) NOT NULL DEFAULT '0' COMMENT '0:en attante, 1:Valide, 2:Refuse',
  `description` text,
  `client_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `credits`
--

INSERT INTO `credits` (`id`, `credit`, `etat`, `description`, `client_id`, `created`, `modified`) VALUES
(1, 1000, 0, NULL, 1, '2019-03-18 11:38:27', '0000-00-00 00:00:00'),
(2, 300, 0, NULL, 1, '2019-03-18 11:56:37', '0000-00-00 00:00:00'),
(3, 500, 0, NULL, 69, '2019-03-18 12:33:32', '0000-00-00 00:00:00'),
(4, 1200, 1, NULL, 147, '2019-03-18 12:35:50', '0000-00-00 00:00:00'),
(5, 100, 1, NULL, 69, '2019-03-18 13:49:21', '0000-00-00 00:00:00'),
(6, 8, 1, NULL, 69, '2019-03-19 10:24:16', '0000-00-00 00:00:00'),
(7, 550, 0, NULL, 69, '2019-03-20 15:26:50', '2019-03-20 15:26:50'),
(8, 200, 0, NULL, 1, '2019-03-21 04:26:07', '2019-03-21 04:26:07');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `credits`
--
ALTER TABLE `credits`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `credits`
--
ALTER TABLE `credits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
