-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 12 oct. 2018 à 09:33
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
-- Base de données :  `selfizee_event_26092018`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients_customs`
--

CREATE TABLE `clients_customs` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `signature_email` text,
  `ps_publicite` text,
  `ps_bandeau_par_defaut` varchar(255) DEFAULT NULL,
  `ps_couleur_de_fond` varchar(255) DEFAULT NULL,
  `gs_nom` varchar(255) DEFAULT NULL,
  `gs_slug` varchar(255) DEFAULT NULL,
  `gs_is_public` varchar(255) DEFAULT NULL,
  `gs_titre` varchar(255) DEFAULT NULL,
  `gs_sous_titre` varchar(255) DEFAULT NULL,
  `gs_couleur` varchar(255) DEFAULT NULL,
  `gs_img_banniere` varchar(255) DEFAULT NULL,
  `gs_is_livredor_active` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `clients_customs`
--
ALTER TABLE `clients_customs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `clients_customs`
--
ALTER TABLE `clients_customs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
