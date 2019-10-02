-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 16 août 2019 à 17:22
-- Version du serveur :  10.3.16-MariaDB
-- Version de PHP :  7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `selfizee_event_09052019`
--

-- --------------------------------------------------------

--
-- Structure de la table `type_mise_en_pages`
--

CREATE TABLE `type_mise_en_pages` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_mise_en_pages`
--

INSERT INTO `type_mise_en_pages` (`id`, `nom`, `created`, `modified`) VALUES
(1, 'Choisir et personnaliser un visuel choisi dans le catalogue', '2019-08-16 00:00:00', NULL),
(2, 'Importer ma propre mise en page', '2019-08-16 00:00:00', NULL),
(3, 'Créer ma mise en page depuis une base vierge', '2019-08-16 00:00:00', NULL),
(4, 'Pas besoin de mise en page', '2019-08-16 00:00:00', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `type_mise_en_pages`
--
ALTER TABLE `type_mise_en_pages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `type_mise_en_pages`
--
ALTER TABLE `type_mise_en_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
