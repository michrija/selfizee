-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 16 août 2019 à 17:24
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
-- Structure de la table `config_bornes`
--

CREATE TABLE `config_bornes` (
  `id` int(11) NOT NULL,
  `evenement_id` int(11) DEFAULT NULL,
  `type_mise_en_page_id` int(11) NOT NULL,
  `catalogue_id` int(11) NOT NULL,
  `decompte_prise_photo` int(11) DEFAULT NULL,
  `is_reprise_photo` tinyint(1) DEFAULT NULL,
  `is_incrustation_fond_vert` tinyint(1) DEFAULT NULL,
  `is_prise_coordonnee` tinyint(1) DEFAULT NULL,
  `titre_formulaire` varchar(255) DEFAULT NULL,
  `is_impression` tinyint(1) DEFAULT NULL,
  `is_multi_impression` tinyint(1) DEFAULT NULL,
  `nbr_max_multi_impression` int(11) DEFAULT NULL,
  `has_limite_impression` tinyint(1) DEFAULT NULL,
  `nbr_max_photo` int(11) DEFAULT NULL,
  `texte_impression` text DEFAULT NULL,
  `is_impression_auto` tinyint(1) DEFAULT NULL,
  `nbr_copie_impression_auto` int(11) DEFAULT NULL,
  `decompte_time_out` int(11) DEFAULT NULL,
  `num_borne` varchar(255) DEFAULT NULL,
  `taille_ecran_id` int(11) DEFAULT NULL,
  `type_imprimante_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `config_bornes`
--

INSERT INTO `config_bornes` (`id`, `evenement_id`, `type_mise_en_page_id`, `catalogue_id`, `decompte_prise_photo`, `is_reprise_photo`, `is_incrustation_fond_vert`, `is_prise_coordonnee`, `titre_formulaire`, `is_impression`, `is_multi_impression`, `nbr_max_multi_impression`, `has_limite_impression`, `nbr_max_photo`, `texte_impression`, `is_impression_auto`, `nbr_copie_impression_auto`, `decompte_time_out`, `num_borne`, `taille_ecran_id`, `type_imprimante_id`) VALUES
(1, NULL, 2, 1, 1, 1, 1, 1, 'ssqdq', 1, 1, 1, 1, 1, 'kln', 1, 1, 1, NULL, 2, 1),
(2, 1420, 2, 1, NULL, 1, 0, 0, 'scs', 1, 1, NULL, 1, 2, 'scs', 1, -3, NULL, '3', 1, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `config_bornes`
--
ALTER TABLE `config_bornes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_config_bornes_evenement` (`evenement_id`),
  ADD KEY `FK_config_bornes_mise_en_page` (`type_mise_en_page_id`),
  ADD KEY `FK_config_bornes_catalogue` (`catalogue_id`),
  ADD KEY `FK_config_bornes_type_impirmante` (`type_imprimante_id`),
  ADD KEY `FK_config_bornes_taille_ecran` (`taille_ecran_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `config_bornes`
--
ALTER TABLE `config_bornes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `config_bornes`
--
ALTER TABLE `config_bornes`
  ADD CONSTRAINT `FK_config_bornes_catalogue` FOREIGN KEY (`catalogue_id`) REFERENCES `catalogues` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_config_bornes_evenement` FOREIGN KEY (`evenement_id`) REFERENCES `evenements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_config_bornes_mise_en_page` FOREIGN KEY (`type_mise_en_page_id`) REFERENCES `type_mise_en_pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_config_bornes_taille_ecran` FOREIGN KEY (`taille_ecran_id`) REFERENCES `taille_ecrans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_config_bornes_type_impirmante` FOREIGN KEY (`type_imprimante_id`) REFERENCES `type_imprimantes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
