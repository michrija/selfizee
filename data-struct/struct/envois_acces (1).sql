-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 15 mars 2019 à 09:55
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
-- Structure de la table `envois_acces`
--

CREATE TABLE `envois_acces` (
  `id` int(11) NOT NULL,
  `destinateurs` text,
  `user_id` int(11) DEFAULT NULL COMMENT 'L''acces',
  `evenement_id` int(11) DEFAULT NULL,
  `commentaire` text,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `envois_acces`
--

INSERT INTO `envois_acces` (`id`, `destinateurs`, `user_id`, `evenement_id`, `commentaire`, `created`) VALUES
(3, 'celest1.pr@gmail.com, bboychuristan@gmail.com', 98, 784, NULL, '2019-03-13 13:53:06'),
(4, 'celest1.pr@gmail.com', 102, 780, '<p style=\"text-align: left;\">Voici les accès à notre event !</p><p style=\"text-align: left;\"><span style=\"font-size: 1rem;\">Url : <a href=\"https://manager.selfizee.fr/\" target=\"_blank\">https://manager.selfizee.fr/</a></span><br></p><p style=\"text-align: left;\">Login: DDSCASFD</p><p style=\"text-align: left;\">Mot de passe : 4n6S2</p><p style=\"text-align: left;\"><br></p><p style=\"text-align: left;\">Merci.</p>', '2019-03-15 09:08:05'),
(5, 'celest1.pr@gmail.com', 102, 780, '<p style=\"text-align: left;\">Voici les accès à notre event !</p><p style=\"text-align: left;\"><span style=\"font-size: 1rem;\">Url : <a href=\"https://manager.selfizee.fr/\" target=\"_blank\">https://manager.selfizee.fr/</a></span><br></p><p style=\"text-align: left;\">Login: DDSCASFD</p><p style=\"text-align: left;\">Mot de passe : 4n6S2</p><p style=\"text-align: left;\"><br></p><p style=\"text-align: left;\">Merci.</p>', '2019-03-15 09:09:26');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `envois_acces`
--
ALTER TABLE `envois_acces`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `envois_acces`
--
ALTER TABLE `envois_acces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
