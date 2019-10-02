-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 16 août 2019 à 17:25
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
-- Structure de la table `ecrans_navigations`
--

CREATE TABLE `ecrans_navigations` (
  `id` int(11) NOT NULL,
  `config_borne_id` int(11) DEFAULT NULL,
  `page_accueil_image_fond` varchar(255) DEFAULT NULL,
  `page_accueil_couleur_fond` varchar(255) DEFAULT NULL,
  `page_config_fond_id` int(11) DEFAULT NULL,
  `page_accueil_image_btn` varchar(255) DEFAULT NULL,
  `page_accueil_couleur_btn` varchar(255) DEFAULT NULL,
  `page_config_bouton_id` int(11) DEFAULT NULL,
  `page_config_police_id` int(11) DEFAULT NULL,
  `page_prise_photos_image_fond` varchar(255) DEFAULT NULL,
  `page_prise_photos_couleur_fond` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ecrans_navigations`
--

INSERT INTO `ecrans_navigations` (`id`, `config_borne_id`, `page_accueil_image_fond`, `page_accueil_couleur_fond`, `page_config_fond_id`, `page_accueil_image_btn`, `page_accueil_couleur_btn`, `page_config_bouton_id`, `page_config_police_id`, `page_prise_photos_image_fond`, `page_prise_photos_couleur_fond`, `created`, `modified`) VALUES
(1, 2, '58999960-d64b-4789-9616-9bad80114394.jpg', '', NULL, '217a0927-8e6f-4c3b-86d6-55bfeeea5eb1.jpg', '', NULL, NULL, 'sdsds', 'dsfs', '2019-08-16 11:32:18', '2019-08-16 15:21:04');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ecrans_navigations`
--
ALTER TABLE `ecrans_navigations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ecrans_navigations`
--
ALTER TABLE `ecrans_navigations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
