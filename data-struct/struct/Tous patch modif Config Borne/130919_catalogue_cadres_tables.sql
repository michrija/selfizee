-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 13 sep. 2019 à 14:47
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
-- Structure de la table `catalogue_cadres`
--

CREATE TABLE `catalogue_cadres` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `nom_origine` varchar(255) DEFAULT NULL,
  `chemin` text DEFAULT NULL,
  `nbr_pose` int(11) DEFAULT NULL,
  `type_cadre` varchar(255) DEFAULT NULL,
  `format_id` int(11) DEFAULT NULL,
  `evenement_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `catalogue_cadres`
--

INSERT INTO `catalogue_cadres` (`id`, `titre`, `file_name`, `nom_origine`, `chemin`, `nbr_pose`, `type_cadre`, `format_id`, `evenement_id`, `created`, `modified`) VALUES
(9, 'VegetaC1 cadre', '4fcf547f-950a-4c7a-969d-d1710807a95f.jpg', '3.jpg', 'E:\\BOULOT\\xampp\\htdocs\\event-selfizee-v2\\webroot\\import\\config_bornes\\786\\cadre_catalogue\\4fcf547f-950a-4c7a-969d-d1710807a95f.jpg', 2, NULL, 4, 786, '2019-09-12 07:28:12', '2019-09-12 08:24:42'),
(11, 'da', '7d64da86-0648-4374-a88b-9838d0a65dbb.jpg', '8.jpg', 'E:\\BOULOT\\xampp\\htdocs\\event-selfizee-v2\\webroot\\import\\config_bornes\\786\\cadre_catalogue\\7d64da86-0648-4374-a88b-9838d0a65dbb.jpg', 3, NULL, 3, 786, '2019-09-12 07:56:27', '2019-09-12 08:20:05');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `catalogue_cadres`
--
ALTER TABLE `catalogue_cadres`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `catalogue_cadres`
--
ALTER TABLE `catalogue_cadres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
