-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 15 déc. 2024 à 02:10
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bd_todoapp`
--

-- --------------------------------------------------------

--
-- Structure de la table `add_ask`
--

CREATE TABLE `add_ask` (
  `id` int(11) NOT NULL,
  `to_do` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `etat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `add_ask`
--

INSERT INTO `add_ask` (`id`, `to_do`, `username`, `etat`) VALUES
(1, 'manger', 'Guerchom', 1),
(4, 'fast and furiois', 'Guerchom', 0),
(7, 'se lebron James', 'Guerchom', 1),
(8, 'dormir', 'Guerchom', 1),
(10, 'se lebrn james', 'Guerchom', 1),
(11, 'fast and furiois', 'Guerchom', 0),
(12, 'fast and furiois', 'Guerchom', 0),
(13, 'fast and furiois', 'pididi', 0),
(14, 'fast and furiois', 'pididi', 0),
(15, 'fast and furiois', 'pididi', 0),
(16, 'fast and furiois', 'pididi', 1),
(19, 'fast and furiois', 'pididi', 0),
(37, 'se lebron James', 'dixneuf', 1),
(40, 'Search and confirm in todo app', 'dixneuf', 0),
(41, 'sport at 17', 'dixneuf', 0),
(42, 'We up at 10', 'dixneuf', 1),
(43, 'REVOIR LES BAILS EN ANGLAIS ', 'dixneuf', 0),
(44, 'Create account ', 'dixneuf', 0),
(45, 'revoir aussi les messages ', 'dixneuf', 0),
(47, 'clean code, modal de fermeture, icon supp, and all icons, copy2024', 'dixneuf', 1),
(48, 'profil supp', 'dixneuf', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `noms` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_ajout` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `noms`, `username`, `password`, `date_ajout`) VALUES
(1, '', 'didip', '121212', '2024-12-10'),
(2, '', 'didip', '121212', '2024-12-10'),
(3, 'Guerchom KubalukA Kubaluka', 'pididi', '12345', '2024-12-10'),
(4, 'Gigi Dixneuf Gigi19', 'Guerchom', '243831103120', '2024-12-10'),
(5, 'Blacko', 'Admin', '667667', '2024-12-10'),
(6, 'Guerchom Gigi', 'dixneuf', '667667', '2024-12-11');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `add_ask`
--
ALTER TABLE `add_ask`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `add_ask`
--
ALTER TABLE `add_ask`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
