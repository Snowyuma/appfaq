-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 26 mars 2024 à 15:00
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `appfaq`
--
CREATE DATABASE IF NOT EXISTS `appfaq` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `appfaq`;

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

DROP TABLE IF EXISTS `faq`;
CREATE TABLE `faq` (
  `id_faq` bigint(11) NOT NULL,
  `question` text NOT NULL,
  `reponse` text DEFAULT NULL,
  `dat_question` datetime NOT NULL,
  `dat_reponse` datetime DEFAULT NULL,
  `id_user` bigint(11) NOT NULL,
  `id_ligue` bigint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `faq`
--

INSERT INTO `faq` (`id_faq`, `question`, `reponse`, `dat_question`, `dat_reponse`, `id_user`, `id_ligue`) VALUES
(4, 'quelles sont les règles?', NULL, '2024-03-26 14:28:09', NULL, 15, NULL),
(6, 'comment compter les points ?', 'avec ses doigts', '2024-03-26 14:28:38', NULL, 15, NULL),
(7, 'pourquoi ça s\'appelle le Volley?', NULL, '2024-03-26 14:29:33', NULL, 15, NULL),
(8, 'qu\'elles sont les règles?', NULL, '2024-03-26 14:31:19', NULL, 16, NULL),
(9, 'combien de temps dure un match?', NULL, '2024-03-26 14:31:36', NULL, 16, NULL),
(10, 'qu\'elles sont les plus grosses fautes?', NULL, '2024-03-26 14:32:07', NULL, 16, NULL),
(11, 'combien y a-t-il d\'arbitres?', NULL, '2024-03-26 14:32:19', NULL, 16, NULL),
(12, 'combien de temps durent les matchs?', NULL, '2024-03-26 14:33:04', NULL, 17, NULL),
(13, 'comment compter les points ?', NULL, '2024-03-26 14:33:41', NULL, 17, NULL),
(14, 'combien de pas sans rebon on peut faire ?', NULL, '2024-03-26 14:34:48', NULL, 17, NULL),
(15, 'peut-on frapper des joueurs en pleins visage ou leurs crever les yeux pour gagner ?', NULL, '2024-03-26 14:35:06', NULL, 17, NULL),
(16, 'commbien de temps dure un match?', NULL, '2024-03-26 14:35:47', NULL, 18, NULL),
(17, 'cobien de joueurs dans une équipe?', NULL, '2024-03-26 14:36:04', NULL, 18, NULL),
(18, 'de qu\'elle taille est le terrain?', NULL, '2024-03-26 14:36:19', NULL, 18, NULL),
(19, 'pourquoi y at-til des arbitres?', NULL, '2024-03-26 14:36:32', NULL, 18, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ligue`
--

DROP TABLE IF EXISTS `ligue`;
CREATE TABLE `ligue` (
  `id_ligue` bigint(11) NOT NULL,
  `lib_ligue` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `ligue`
--

INSERT INTO `ligue` (`id_ligue`, `lib_ligue`) VALUES
(1, 'football'),
(2, 'basket'),
(3, 'volley'),
(4, 'handball'),
(5, 'toutes_ligues');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` bigint(11) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `id_usertype` bigint(11) NOT NULL,
  `id_ligue` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `pseudo`, `mdp`, `mail`, `id_usertype`, `id_ligue`) VALUES
(15, 'mathias', '$2y$10$DDPxWTLRB8hEhQmkey2kfOk7jiNr1erORNgotJpqrBc2mjfJUPPHm', 'mathias@mathias.net', 1, 3),
(16, 'lucas', '$2y$10$b8AlAfgGWPXUxWLPc1T3ounUkrtrePoQE3RL1GxB15ryLxMDY1sbe', 'lucas@lucas.net', 1, 1),
(17, 'mathieu', '$2y$10$0eoeNrlKV2oQXFd5.qjhEeJGOHl3U589uuL9zUf03mBMKlDemtRdi', 'mathieu@mathieu.net', 1, 2),
(18, 'samuel', '$2y$10$nMNCgKeFArz.AFByF4nba.JcqzNcxcN8xXH5v8st3J0rWOy24Yxzi', 'samuel@samuel.net', 1, 4),
(20, 'superadmin', '$2y$10$uGOuzCj5XntG8jgaup0s1OleF8/jOm5mcfW5lsGhG29BM.Tu8xPKK', 'superadmin@superadmin.net', 3, 5),
(21, 'adminvolley', '$2y$10$72PEoKTCBwd.aNdXmTMCKeqL5eXSOtVkWlFlfVAUaiGUNXb44fD1i', 'adminvolley@adminvolley.net', 2, 3),
(22, 'adminfoot', '$2y$10$Q45ZK74BeXwUaco8G6QME.p/Wl/h4/oG.wurcv4.lT.xreVeHu/Te', 'adminfoot@adminfoot.net', 2, 1),
(23, 'adminbascket', '$2y$10$QWsJnZLud8VI8TTRbo3Q9uVs41TiYTZ9aWSrp0JOcwSSki1hr2vlW', 'adminbascket@adminbascket.net', 2, 2),
(24, 'adminhand', '$2y$10$MnLIsO6f613V6Ne9pv927.8LPpf3e/6xx8G7/qDXtC35hIXRfU5Bu', 'adminhand@adminhand.net', 2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `usertype`
--

DROP TABLE IF EXISTS `usertype`;
CREATE TABLE `usertype` (
  `id_usertype` bigint(11) NOT NULL,
  `lib_usertype` varchar(50) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `usertype`
--

INSERT INTO `usertype` (`id_usertype`, `lib_usertype`, `Description`) VALUES
(1, 'user', 'un utilisateur comme les autres'),
(2, 'administateur', 'un utilisateur qui gére une ligue'),
(3, 'superadmin', 'un administrateur de toute les ligues');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id_faq`),
  ADD KEY `FK_iduser` (`id_user`),
  ADD KEY `FK_ligue_user` (`id_ligue`);

--
-- Index pour la table `ligue`
--
ALTER TABLE `ligue`
  ADD PRIMARY KEY (`id_ligue`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `FK_usertype` (`id_usertype`),
  ADD KEY `FK_ligue` (`id_ligue`);

--
-- Index pour la table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`id_usertype`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `faq`
--
ALTER TABLE `faq`
  MODIFY `id_faq` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `FK_ligue_faq` FOREIGN KEY (`id_ligue`) REFERENCES `ligue` (`id_ligue`),
  ADD CONSTRAINT `FK_ligue_user` FOREIGN KEY (`id_ligue`) REFERENCES `user` (`id_ligue`),
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_ligue` FOREIGN KEY (`id_ligue`) REFERENCES `ligue` (`id_ligue`),
  ADD CONSTRAINT `FK_usertype` FOREIGN KEY (`id_usertype`) REFERENCES `usertype` (`id_usertype`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
