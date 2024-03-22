-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 22 mars 2024 à 14:48
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

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE `faq` (
  `id_faq` bigint(11) NOT NULL,
  `question` text NOT NULL,
  `reponse` text NOT NULL,
  `dat_question` datetime NOT NULL,
  `dat_reponse` datetime NOT NULL,
  `id_user` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `faq`
--

INSERT INTO `faq` (`id_faq`, `question`, `reponse`, `dat_question`, `dat_reponse`, `id_user`) VALUES
(16, 'Comment puis-je me connecter à mon compte?', 'Pour vous connecter à votre compte, vous devez saisir votre adresse e-mail et votre mot de passe dans les champs appropriés.', '2024-03-19 14:53:41', '2024-03-19 14:53:41', 1),
(17, 'Comment puis-je modifier mes informations personnelles?', 'Pour modifier vos informations personnelles, accédez à votre profil et cliquez sur \"Modifier\".', '2024-03-19 14:53:41', '2024-03-19 14:53:41', 2),
(18, 'Comment puis-je supprimer mon compte?', 'Pour supprimer votre compte, accédez à votre profil et cliquez sur \"Supprimer\".', '2024-03-19 14:53:41', '0000-00-00 00:00:00', 3),
(19, 'Comment puis-je signaler un problème ou un bug?', 'Pour signaler un problème ou un bug, veuillez remplir le formulaire de contact et décrire le problème ou le bug rencontré.', '2024-03-19 14:53:41', '2024-03-19 14:53:41', 2),
(20, 'Comment puis-je me déconnecter de mon compte?', 'Pour vous déconnecter de votre compte, cliquez sur le bouton \"Déconnexion\" en haut à droite de la page.', '2024-03-19 14:53:41', '2024-03-19 14:53:41', 1),
(21, 'Comment puis-je réinitialiser mon mot de passe?', 'Pour réinitialiser votre mot de passe, cliquez sur \"Mot de passe oublié\" lors de la connexion.', '2024-03-19 14:53:41', '2024-03-19 14:53:41', 3);

-- --------------------------------------------------------

--
-- Structure de la table `ligue`
--

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
(1, 'aa', 'aa', 'aa@aa.net', 1, 1),
(2, 'bb', 'bb', 'bb@bb.net', 2, 1),
(3, 'cc', 'cc', 'cc@cc.net', 3, 5),
(11, 'lucas', '$2y$10$PPLGDuwEML.jTnSyB4t5meoS8FvMs2CmhEmZI3uZ5d60797GtHoKC', 'lucas.rauzy@gmail.com', 3, 1),
(12, 'ee', '$2y$10$dfVdaDDx2EVb2xb35McJdeY1DU1t7DcVZ8U8n07pi2lcd4D8Sc146', 'ee@ee.ee', 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `usertype`
--

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
  ADD KEY `FK_iduser` (`id_user`);

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
  MODIFY `id_faq` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `faq`
--
ALTER TABLE `faq`
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
