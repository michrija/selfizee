-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 15 mars 2019 à 09:53
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
-- Structure de la table `contenus_emails`
--

CREATE TABLE `contenus_emails` (
  `id` int(11) NOT NULL,
  `contenu` text,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contenus_emails`
--

INSERT INTO `contenus_emails` (`id`, `contenu`, `created`, `modified`) VALUES
(1, '<p style=\"text-align: left;\">Voici les accès à notre event !</p><p style=\"text-align: left;\"><span style=\"font-size: 1rem;\">Url : <a href=\"https://manager.selfizee.fr/\" target=\"_blank\">https://manager.selfizee.fr/</a></span><br></p><p style=\"text-align: left;\">Login: [[LOGIN]]</p><p style=\"text-align: left;\">Mot de passe : [[PASS]]</p><p style=\"text-align: left;\"><br></p><p style=\"text-align: left;\">Merci.</p>', '2019-03-15 05:14:42', '2019-03-15 08:06:17');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `contenus_emails`
--
ALTER TABLE `contenus_emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `contenus_emails`
--
ALTER TABLE `contenus_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
