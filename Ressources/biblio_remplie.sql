-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 28 fév. 2023 à 18:13
-- Version du serveur : 5.7.36
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `biblio`
--

-- --------------------------------------------------------

--
-- Structure de la table `auteurs`
--

CREATE TABLE `auteurs` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Dates_vie` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `auteurs`
--

INSERT INTO `auteurs` (`Id`, `Nom`, `Prenom`, `Dates_vie`) VALUES
(1, 'Baudelaire', 'Charles', '1821 - 1867'),
(2, 'Hugo', 'Victor', '1802 - 1885'),
(3, 'Stendhal', 'Henri', '1783-1842'),
(4, 'Rousseau', 'Jean-Jacques', '1700 - 1750'),
(5, 'Voltaire', 'François-Marie', '1700 - 1750'),
(6, 'De Coubertin', 'Pierre', '1700 - 1750'),
(7, 'Corneille', 'Jean', '1700 - 1750'),
(8, 'Damazio', 'Alain', '1700 - 1750');

-- --------------------------------------------------------

--
-- Structure de la table `emprunts`
--

CREATE TABLE `emprunts` (
  `Id_Livres` int(11) NOT NULL,
  `Id_Utilisateurs` int(11) NOT NULL,
  `Date_resa` date NOT NULL,
  `Date_retour` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

CREATE TABLE `genres` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Resume` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `genres`
--

INSERT INTO `genres` (`Id`, `Nom`, `Resume`) VALUES
(1, 'PoÃ©sie', 'Fleuron de la littÃ©rature'),
(2, 'Roman', 'Ou comment s\'Ã©vader de sa vie'),
(3, 'Science-fiction', 'L\'ouverture vers de nouveaux mondes');

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

CREATE TABLE `livres` (
  `Id` int(11) NOT NULL,
  `Titre` varchar(200) NOT NULL,
  `Date_publi` date NOT NULL,
  `Stock` int(11) NOT NULL,
  `Resume` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `livres`
--

INSERT INTO `livres` (`Id`, `Titre`, `Date_publi`, `Stock`, `Resume`) VALUES
(4, 'De l\'éducation', '2023-02-01', 4, 'zerh'),
(5, 'La zone du dehors', '2013-02-01', 1, 'Un super bouquin dystopique qui fait un clin d\'oeil à 1984.'),
(10, 'Les furtifs', '2020-02-12', 1, 'Une merveille'),
(11, 'la zone du dehors', '2012-12-12', 3, 'son premier roman'),
(12, 'la horde du contrevent', '2016-02-20', 4, 'youpi'),
(13, 'Harry Potter', '2002-02-02', 2, 'c\'est pas le bon auteur ...'),
(16, 'Ã‰lÃ©phant', '2023-02-05', 1, 'pleins d\'accents hÃ©hÃ©hÃ©'),
(17, 'Les fleurs du mal', '2023-02-14', 3, 'Un bon truc de romantique !!!!!'),
(18, 'Le Rouge et le Noir', '2023-02-02', 2, 'Un bon bouquin de fou furieux, oÃ¹ l\'amour dicte des actes dÃ©biles'),
(19, 'Les MisÃ©rables', '2023-02-01', 2, 'Un super bouquin');

-- --------------------------------------------------------

--
-- Structure de la table `relationlivresauteurs`
--

CREATE TABLE `relationlivresauteurs` (
  `Id_Auteurs` int(11) NOT NULL,
  `Id_Livres` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `relationlivresauteurs`
--

INSERT INTO `relationlivresauteurs` (`Id_Auteurs`, `Id_Livres`) VALUES
(4, 4),
(8, 10),
(8, 11),
(8, 12),
(2, 13),
(2, 16),
(1, 17),
(1, 18),
(1, 19);

-- --------------------------------------------------------

--
-- Structure de la table `relationlivresgenres`
--

CREATE TABLE `relationlivresgenres` (
  `Id_Genres` int(11) NOT NULL,
  `Id_Livres` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `relationlivresgenres`
--

INSERT INTO `relationlivresgenres` (`Id_Genres`, `Id_Livres`) VALUES
(3, 10),
(3, 11),
(3, 12),
(2, 13),
(2, 16),
(1, 17),
(1, 18),
(1, 19);

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `Id_Livres` int(11) NOT NULL,
  `Id_Utilisateurs` int(11) NOT NULL,
  `Date_mise_cote` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Telephone` varchar(20) NOT NULL,
  `Login` varchar(50) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Gestionnaire` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `auteurs`
--
ALTER TABLE `auteurs`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `emprunts`
--
ALTER TABLE `emprunts`
  ADD PRIMARY KEY (`Id_Livres`,`Id_Utilisateurs`),
  ADD KEY `Emprunts_Utilisateurs0_FK` (`Id_Utilisateurs`);

--
-- Index pour la table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `livres`
--
ALTER TABLE `livres`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `relationlivresauteurs`
--
ALTER TABLE `relationlivresauteurs`
  ADD PRIMARY KEY (`Id_Auteurs`,`Id_Livres`),
  ADD KEY `RelationLivresAuteurs_Livres0_FK` (`Id_Livres`);

--
-- Index pour la table `relationlivresgenres`
--
ALTER TABLE `relationlivresgenres`
  ADD PRIMARY KEY (`Id_Genres`,`Id_Livres`),
  ADD KEY `RelationLivresGenres_Livres0_FK` (`Id_Livres`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`Id_Livres`,`Id_Utilisateurs`),
  ADD KEY `Reservations_Utilisateurs0_FK` (`Id_Utilisateurs`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `auteurs`
--
ALTER TABLE `auteurs`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `genres`
--
ALTER TABLE `genres`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `livres`
--
ALTER TABLE `livres`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emprunts`
--
ALTER TABLE `emprunts`
  ADD CONSTRAINT `Emprunts_Livres_FK` FOREIGN KEY (`Id_Livres`) REFERENCES `livres` (`Id`),
  ADD CONSTRAINT `Emprunts_Utilisateurs0_FK` FOREIGN KEY (`Id_Utilisateurs`) REFERENCES `utilisateurs` (`Id`);

--
-- Contraintes pour la table `relationlivresauteurs`
--
ALTER TABLE `relationlivresauteurs`
  ADD CONSTRAINT `RelationLivresAuteurs_Auteurs_FK` FOREIGN KEY (`Id_Auteurs`) REFERENCES `auteurs` (`Id`),
  ADD CONSTRAINT `RelationLivresAuteurs_Livres0_FK` FOREIGN KEY (`Id_Livres`) REFERENCES `livres` (`Id`);

--
-- Contraintes pour la table `relationlivresgenres`
--
ALTER TABLE `relationlivresgenres`
  ADD CONSTRAINT `RelationLivresGenres_Genres_FK` FOREIGN KEY (`Id_Genres`) REFERENCES `genres` (`Id`),
  ADD CONSTRAINT `RelationLivresGenres_Livres0_FK` FOREIGN KEY (`Id_Livres`) REFERENCES `livres` (`Id`);

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `Reservations_Livres_FK` FOREIGN KEY (`Id_Livres`) REFERENCES `livres` (`Id`),
  ADD CONSTRAINT `Reservations_Utilisateurs0_FK` FOREIGN KEY (`Id_Utilisateurs`) REFERENCES `utilisateurs` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
