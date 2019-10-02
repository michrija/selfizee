-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 23 juil. 2019 à 15:06
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
-- Structure de la table `evenement_posts`
--

CREATE TABLE `evenement_posts` (
  `id` int(11) NOT NULL,
  `evenement_id` int(11) NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `contenus` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `evenement_posts` ADD `slug` VARCHAR(255) NULL AFTER `titre`;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `evenement_posts`
--
ALTER TABLE `evenement_posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `evenement_posts`
--
ALTER TABLE `evenement_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
