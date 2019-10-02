-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 17 juil. 2019 à 06:29
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
-- Structure de la table `evenement_politiques`
--

CREATE TABLE `evenement_politiques` (
  `id` int(11) NOT NULL,
  `evenement_id` int(11) NOT NULL,
  `contenu` longtext NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `evenement_politiques`
--
ALTER TABLE `evenement_politiques`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `evenement_politiques`
--
ALTER TABLE `evenement_politiques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
