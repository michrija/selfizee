-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 08 août 2019 à 18:38
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
-- Structure de la table `licences`
--

CREATE TABLE `licences` (
  `id` int(11) NOT NULL,
  `id_borne` varchar(255) DEFAULT NULL,
  `duree` varchar(255) DEFAULT NULL,
  `numero_serie_non_crypte` varchar(255) DEFAULT NULL,
  `numero_serie_crypte` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `licences`
--

INSERT INTO `licences` (`id`, `id_borne`, `duree`, `numero_serie_non_crypte`, `numero_serie_crypte`, `created`, `modified`) VALUES
(3, '548', '2', '935NTQ42ANS065', '379RXU86ERW409', '2019-08-05 17:13:34', '2019-08-05 17:13:34'),
(6, '12589', '3', '560MTI1ODK3ANS440', '904QXM5SHO7ERW884', '2019-08-08 12:41:42', '2019-08-08 12:41:42'),
(7, '12589', '3', '483MTI1ODK3ANS517', '827QXM5SHO7ERW951', '2019-08-08 16:34:25', '2019-08-08 16:34:25');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `licences`
--
ALTER TABLE `licences`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `licences`
--
ALTER TABLE `licences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
