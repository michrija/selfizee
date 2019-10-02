-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 22 août 2019 à 19:51
-- Version du serveur :  10.1.37-MariaDB
-- Version de PHP :  7.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données :  `selfizee_event`
--

-- --------------------------------------------------------

--
-- Structure de la table `type_animations`
--

DROP TABLE IF EXISTS `type_animations`;
CREATE TABLE `type_animations` (
  `id` int(11) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `image_illustration` varchar(120) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_animations`
--

INSERT INTO `type_animations` (`id`, `nom`, `description`, `image_illustration`, `created`, `modified`) VALUES
(1, 'Carte postale paysage', '1 pose - 10x15 cm', 'animation-1.png', '2018-10-16 12:35:08', '2018-10-16 12:35:08'),
(2, 'Carte postale portrait', '1 pose - 10x15 cm', 'animation-2.png', '2018-10-16 12:35:08', '2018-10-16 12:35:08'),
(3, 'Marque-Page', '3 poses - 5x15cm en 2 exemplaires', 'animation-3.png', '2018-10-16 12:34:03', '2018-10-16 12:34:03'),
(4, 'Polaroid ', '1 pose - 10x15 cm', 'animation-4.png', '2018-10-16 12:34:39', '2018-10-16 12:34:39'),
(5, 'Carte postale multishoot', '2 à 4 poses - 10x15 cm', 'animation-5.png', '2018-10-16 12:34:21', '2018-10-16 12:34:21');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `type_animations`
--
ALTER TABLE `type_animations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `type_animations`
--
ALTER TABLE `type_animations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;
