-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 21 août 2019 à 18:15
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
-- Structure de la table `image_fonds`
--

CREATE TABLE `image_fonds` (
  `id` int(11) NOT NULL,
  `type` enum('accueil','cadre','filtre','remerciement') DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `nom_origine` varchar(255) DEFAULT NULL,
  `chemin` text DEFAULT NULL,
  `nbr_pose` int(11) DEFAULT NULL,
  `theme_id` int(11) DEFAULT NULL,
  `format_id` int(11) DEFAULT NULL,
  `catalogue_id` int(11) DEFAULT NULL,
  `configuration_animation_id` int(11) DEFAULT NULL,
  `configuration_borne_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `image_fonds`
--

INSERT INTO `image_fonds` (`id`, `type`, `file_name`, `nom_origine`, `chemin`, `nbr_pose`, `theme_id`, `format_id`, `catalogue_id`, `configuration_animation_id`, `configuration_borne_id`, `created`, `modified`) VALUES
(1, 'filtre', 'a66fbbae-6621-43e2-8688-9319130a8de3.jpg', NULL, 'E:\\BOULOT\\xampp\\htdocs\\event-selfizee-v2\\webroot\\import\\config_bornes\\image_fonds\\a66fbbae-6621-43e2-8688-9319130a8de3.jpg', NULL, NULL, NULL, 5, NULL, NULL, '2019-08-21 14:54:39', '2019-08-21 14:54:39'),
(2, 'remerciement', '2a97bee2-4147-40e7-810c-045b6ed7408a.jpg', NULL, 'E:\\BOULOT\\xampp\\htdocs\\event-selfizee-v2\\webroot\\import\\config_bornes\\image_fonds\\2a97bee2-4147-40e7-810c-045b6ed7408a.jpg', NULL, NULL, NULL, 5, NULL, NULL, '2019-08-21 14:54:39', '2019-08-21 14:54:39'),
(3, 'accueil', NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '2019-08-21 15:13:47', '2019-08-21 15:13:47'),
(4, 'cadre', NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '2019-08-21 15:13:48', '2019-08-21 15:13:48'),
(5, 'accueil', '1c7ed278-6831-4c82-aaf2-ea919e8c39b4.jpg', 'Default-1 - Copie.jpg', 'E:\\BOULOT\\xampp\\htdocs\\event-selfizee-v2\\webroot\\import\\config_bornes\\image_fonds\\1c7ed278-6831-4c82-aaf2-ea919e8c39b4.jpg', NULL, NULL, NULL, 7, NULL, NULL, '2019-08-21 15:16:08', '2019-08-21 15:16:08'),
(6, 'accueil', '0ba838b1-be71-401e-ba29-146c4ea8d1ef.jpg', 'Default-1 - Copie.jpg', 'E:\\BOULOT\\xampp\\htdocs\\event-selfizee-v2\\webroot\\import\\config_bornes\\image_fonds\\0ba838b1-be71-401e-ba29-146c4ea8d1ef.jpg', NULL, NULL, NULL, 8, NULL, NULL, '2019-08-21 16:00:29', '2019-08-21 16:00:29'),
(7, 'cadre', 'e297685e-56cf-4567-a8db-e7f9600856ba.jpg', 'IMG_20180705_102736.jpg', 'E:\\BOULOT\\xampp\\htdocs\\event-selfizee-v2\\webroot\\import\\config_bornes\\image_fonds\\e297685e-56cf-4567-a8db-e7f9600856ba.jpg', NULL, NULL, NULL, 8, NULL, NULL, '2019-08-21 16:00:29', '2019-08-21 16:00:29'),
(8, 'remerciement', '2fcc746c-1438-4a1c-b44e-171808f997ed.jpg', 'Default-1 - Copie.jpg', 'E:\\BOULOT\\xampp\\htdocs\\event-selfizee-v2\\webroot\\import\\config_bornes\\image_fonds\\2fcc746c-1438-4a1c-b44e-171808f997ed.jpg', NULL, NULL, NULL, 8, NULL, NULL, '2019-08-21 16:00:29', '2019-08-21 16:00:29');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `image_fonds`
--
ALTER TABLE `image_fonds`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `image_fonds`
--
ALTER TABLE `image_fonds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
