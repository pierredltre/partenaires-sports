-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 12 nov. 2020 à 20:12
-- Version du serveur :  5.7.30
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `php_sport`
--

-- --------------------------------------------------------

--
-- Structure de la table `niveaux_sportifs`
--

CREATE TABLE `niveaux_sportifs` (
  `id` int(11) NOT NULL,
  `niveau` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '1970-01-01 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `niveaux_sportifs`
--

INSERT INTO `niveaux_sportifs` (`id`, `niveau`, `created_at`, `updated_at`) VALUES
(1, 'débutant', '2020-11-08 20:31:48', '1970-01-01 00:00:00'),
(2, 'confirmé', '2020-11-08 20:31:48', '1970-01-01 00:00:00'),
(3, 'pro', '2020-11-08 20:32:03', '1970-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `sports`
--

CREATE TABLE `sports` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '1970-01-01 00:00:01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sports`
--

INSERT INTO `sports` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'Football', '2020-11-08 19:39:42', '1970-01-01 00:00:01'),
(2, 'Basketball', '2020-11-08 19:40:00', '1970-01-01 00:00:01'),
(3, 'Rugby', '2020-11-08 19:40:43', '1970-01-01 00:00:01'),
(4, 'Natation', '2020-11-08 19:41:33', '1970-01-01 00:00:01'),
(5, 'Judo', '2020-11-08 19:41:57', '1970-01-01 00:00:01');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `prenom` varchar(200) NOT NULL,
  `ville` varchar(200) NOT NULL,
  `email` varchar(500) NOT NULL,
  `mot_de_passe` varchar(500) NOT NULL,
  `sport_pratique` varchar(20) NOT NULL,
  `niveau` varchar(20) NOT NULL,
  `avatar` varchar(500) NOT NULL DEFAULT 'user.png',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `last_login` datetime NOT NULL DEFAULT '1970-01-01 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `niveaux_sportifs`
--
ALTER TABLE `niveaux_sportifs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `niveaux_sportifs`
--
ALTER TABLE `niveaux_sportifs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `sports`
--
ALTER TABLE `sports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
