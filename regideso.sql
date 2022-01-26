-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 05 août 2021 à 15:32
-- Version du serveur :  10.4.8-MariaDB
-- Version de PHP :  7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `regideso`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_agent`
--

CREATE TABLE `t_agent` (
  `IdAgent` int(11) NOT NULL,
  `NomAgent` varchar(20) NOT NULL,
  `PostnomAgent` varchar(20) NOT NULL,
  `PrenomAgent` varchar(20) NOT NULL,
  `QuartierAgent` int(11) NOT NULL,
  `TelephoneAgent` int(11) NOT NULL,
  `DateNaissance` date NOT NULL,
  `Username` varchar(15) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Photo` text NOT NULL,
  `CodeFonction` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_agent`
--

INSERT INTO `t_agent` (`IdAgent`, `NomAgent`, `PostnomAgent`, `PrenomAgent`, `QuartierAgent`, `TelephoneAgent`, `DateNaissance`, `Username`, `Password`, `Photo`, `CodeFonction`) VALUES
(1, 'Baraka', 'Bigega', 'Espoir', 1, 977553723, '1999-11-04', 'espoir', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', 1),
(2, 'Akilimali', 'Baraka', 'Michael', 8, 977657733, '2002-02-02', 'mick', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'DSC_0160.jpg', 3),
(6, 'Luciana', 'Watsongo', 'Lucia', 5, 971292917, '2000-02-09', 'lucia', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'IMG_2875.jpg', 3),
(7, 'Francois', 'Big', 'Bigega', 9, 988776622, '2000-02-12', 'franck', 'd033e22ae348aeb5660fc2140aec35850c4da997', '_MG_0029.jpg', 1),
(8, 'Baraka', 'Mutabazi', 'Charles', 9, 977966626, '1966-12-01', 'baraka', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'IMG_20180614_165057.jpg', 2),
(9, 'Sifa', 'Saidi', 'Siska', 1, 988337744, '2000-12-12', 'siska', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'IMG_8406.jpg', 3),
(10, 'Siwa', 'Mumbere', 'Carin', 10, 988776655, '1998-12-12', 'carin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '20112020-_MG_0358.JPG', 2),
(11, 'Abio', 'Bomongoyo', '', 8, 988833888, '2000-10-10', 'abio', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'DSC_0037.jpg', 2),
(12, 'Shekinah', 'Malekani', 'Kavira', 9, 988776644, '2000-12-02', 'kavira', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '20112020-_MG_0938.JPG', 3);

-- --------------------------------------------------------

--
-- Structure de la table `t_annee`
--

CREATE TABLE `t_annee` (
  `CodeAnnee` int(11) NOT NULL,
  `Annee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_annee`
--

INSERT INTO `t_annee` (`CodeAnnee`, `Annee`) VALUES
(1, 2021),
(2, 2022),
(3, 2023),
(4, 2024),
(5, 2025);

-- --------------------------------------------------------

--
-- Structure de la table `t_avenue`
--

CREATE TABLE `t_avenue` (
  `CodeAvenue` int(11) NOT NULL,
  `Avenue` varchar(100) NOT NULL,
  `CodeQuartier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_avenue`
--

INSERT INTO `t_avenue` (`CodeAvenue`, `Avenue`, `CodeQuartier`) VALUES
(1, 'LOASHI', 3),
(2, 'DU MARCHE', 7),
(3, '17 JANVIER', 7),
(4, 'LUMUMBA', 15),
(5, 'DE LA FRONTIERE', 15);

-- --------------------------------------------------------

--
-- Structure de la table `t_categorie_paiement`
--

CREATE TABLE `t_categorie_paiement` (
  `CodeCategorie` int(11) NOT NULL,
  `Categorie` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_commune`
--

CREATE TABLE `t_commune` (
  `CodeCommune` int(11) NOT NULL,
  `Commune` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_commune`
--

INSERT INTO `t_commune` (`CodeCommune`, `Commune`) VALUES
(1, 'KARISIMBI'),
(2, 'GOMA');

-- --------------------------------------------------------

--
-- Structure de la table `t_fonction`
--

CREATE TABLE `t_fonction` (
  `CodeFonction` int(11) NOT NULL,
  `Fonction` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_fonction`
--

INSERT INTO `t_fonction` (`CodeFonction`, `Fonction`) VALUES
(1, 'Superadmin'),
(2, 'Comptable'),
(3, 'Verificateur');

-- --------------------------------------------------------

--
-- Structure de la table `t_menage`
--

CREATE TABLE `t_menage` (
  `IdMenage` int(11) NOT NULL,
  `NumParcelle` int(11) NOT NULL,
  `ResponsableMenage` varchar(255) NOT NULL,
  `TelephoneResponsable` int(11) NOT NULL,
  `EmailResponsable` varchar(50) NOT NULL,
  `CodeQuartier` int(11) NOT NULL,
  `CodeAvenue` int(11) NOT NULL,
  `CodeVerificateur` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `LongeurParcelle` float NOT NULL,
  `LargeurParcelle` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_menage`
--

INSERT INTO `t_menage` (`IdMenage`, `NumParcelle`, `ResponsableMenage`, `TelephoneResponsable`, `EmailResponsable`, `CodeQuartier`, `CodeAvenue`, `CodeVerificateur`, `Status`, `LongeurParcelle`, `LargeurParcelle`) VALUES
(1, 12, 'AISHA BARAKA', 977665544, '', 15, 5, 6, 0, 20, 20),
(2, 12, 'MWENDAPOLE MARTIN', 988776655, '', 4, 3, 2, 0, 12, 40),
(3, 80, 'BISIMWA BARAKA', 988447755, 'esese@gmail.com', 8, 4, 6, 0, 30, 40),
(4, 30, 'SHEKINAH KAVIRA', 988776655, '', 15, 5, 9, 0, 25, 25),
(5, 20, 'FEZA', 988776654, '', 23, 2, 12, 0, 30, 20);

-- --------------------------------------------------------

--
-- Structure de la table `t_mois`
--

CREATE TABLE `t_mois` (
  `CodeMois` int(11) NOT NULL,
  `Mois` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_mois`
--

INSERT INTO `t_mois` (`CodeMois`, `Mois`) VALUES
(1, 'Janvier'),
(2, 'Fevrier'),
(3, 'Mars'),
(4, 'Avril'),
(5, 'Mai'),
(6, 'Juin'),
(7, 'Juillet'),
(8, 'Aout'),
(9, 'Septembre'),
(10, 'Octobre'),
(11, 'Novembre'),
(12, 'Decembre');

-- --------------------------------------------------------

--
-- Structure de la table `t_paiement`
--

CREATE TABLE `t_paiement` (
  `CodePaiement` int(11) NOT NULL,
  `CodeMenage` int(11) NOT NULL,
  `CodeMois` int(11) NOT NULL,
  `CodeAnnee` int(11) NOT NULL,
  `CodeRapport` int(11) NOT NULL,
  `Montant` double NOT NULL,
  `DatePaiement` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_paiement`
--

INSERT INTO `t_paiement` (`CodePaiement`, `CodeMenage`, `CodeMois`, `CodeAnnee`, `CodeRapport`, `Montant`, `DatePaiement`) VALUES
(1, 1, 7, 1, 2, 156, '2021-08-04'),
(2, 1, 6, 1, 3, 120, '2021-08-04'),
(3, 1, 5, 1, 4, 144, '2021-08-04'),
(4, 1, 4, 1, 9, 36, '2021-08-04'),
(5, 2, 4, 1, 8, 110, '2021-08-04'),
(6, 2, 2, 1, 6, 65, '2021-08-04'),
(7, 4, 7, 1, 11, 20, '2021-08-05');

-- --------------------------------------------------------

--
-- Structure de la table `t_quartier`
--

CREATE TABLE `t_quartier` (
  `CodeQuartier` int(11) NOT NULL,
  `Quartier` varchar(50) NOT NULL,
  `Prevision` double NOT NULL,
  `CodeCommune` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_quartier`
--

INSERT INTO `t_quartier` (`CodeQuartier`, `Quartier`, `Prevision`, `CodeCommune`) VALUES
(1, 'LES VOLCANS', 7, 2),
(2, 'MIKENO', 6, 2),
(3, 'KATINDO', 5, 2),
(4, 'HIMBI', 5, 2),
(5, 'KYESHERO', 4, 2),
(7, 'MUGUNGA', 5, 1),
(8, 'NDOSHO', 4, 1),
(9, 'KATOYI', 5, 1),
(10, 'MAJENGO', 7, 1),
(11, 'MABANGA-SUD', 3, 1),
(12, 'MABANGA-NORD', 3, 1),
(13, 'KASIKA', 5, 1),
(14, 'MAPENDO', 5, 1),
(15, 'BIRERE', 5, 1),
(16, 'VIRUNGA', 3, 1),
(17, 'OFFICE', 4, 1),
(18, 'KAHEMBE', 4, 1),
(22, 'LAC-VERT', 4, 2),
(23, 'XXX', 4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `t_rapport`
--

CREATE TABLE `t_rapport` (
  `CodeRapport` int(11) NOT NULL,
  `DateRapport` date NOT NULL,
  `State` int(11) NOT NULL,
  `Consommation` decimal(10,0) NOT NULL,
  `CodeMenage` int(11) NOT NULL,
  `CodeMois` int(11) NOT NULL,
  `CodeAnnee` int(11) NOT NULL,
  `CodeVerificateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_rapport`
--

INSERT INTO `t_rapport` (`CodeRapport`, `DateRapport`, `State`, `Consommation`, `CodeMenage`, `CodeMois`, `CodeAnnee`, `CodeVerificateur`) VALUES
(2, '2021-08-03', 1, '13', 1, 7, 1, 6),
(3, '2021-08-03', 1, '10', 1, 6, 1, 6),
(4, '2021-08-03', 1, '12', 1, 5, 1, 6),
(5, '2021-08-03', 0, '10', 2, 1, 1, 2),
(6, '2021-08-03', 1, '13', 2, 2, 1, 2),
(7, '2021-08-03', 0, '30', 2, 3, 1, 2),
(8, '2021-08-03', 1, '22', 2, 4, 1, 2),
(9, '2021-08-04', 1, '3', 1, 4, 1, 6),
(10, '2021-08-05', 0, '13', 1, 9, 1, 6),
(11, '2021-08-05', 1, '4', 4, 7, 1, 9),
(12, '2021-08-05', 0, '10', 5, 7, 1, 1),
(13, '2021-08-05', 0, '5', 5, 6, 1, 12);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_agent`
--
ALTER TABLE `t_agent`
  ADD PRIMARY KEY (`IdAgent`),
  ADD KEY `fk_agent_fonction` (`CodeFonction`),
  ADD KEY `fk_agent_quartier` (`QuartierAgent`);

--
-- Index pour la table `t_annee`
--
ALTER TABLE `t_annee`
  ADD PRIMARY KEY (`CodeAnnee`);

--
-- Index pour la table `t_avenue`
--
ALTER TABLE `t_avenue`
  ADD PRIMARY KEY (`CodeAvenue`),
  ADD KEY `fk_avenue_quartier` (`CodeQuartier`);

--
-- Index pour la table `t_categorie_paiement`
--
ALTER TABLE `t_categorie_paiement`
  ADD PRIMARY KEY (`CodeCategorie`);

--
-- Index pour la table `t_commune`
--
ALTER TABLE `t_commune`
  ADD PRIMARY KEY (`CodeCommune`);

--
-- Index pour la table `t_fonction`
--
ALTER TABLE `t_fonction`
  ADD PRIMARY KEY (`CodeFonction`);

--
-- Index pour la table `t_menage`
--
ALTER TABLE `t_menage`
  ADD PRIMARY KEY (`IdMenage`),
  ADD KEY `fk_menage_quartier` (`CodeQuartier`),
  ADD KEY `fk_menage_verificateur` (`CodeVerificateur`),
  ADD KEY `fk_menage_avenue` (`CodeAvenue`);

--
-- Index pour la table `t_mois`
--
ALTER TABLE `t_mois`
  ADD PRIMARY KEY (`CodeMois`);

--
-- Index pour la table `t_paiement`
--
ALTER TABLE `t_paiement`
  ADD PRIMARY KEY (`CodePaiement`),
  ADD KEY `fk_paiement_rapport` (`CodeRapport`),
  ADD KEY `fk_paiement_menage` (`CodeMenage`);

--
-- Index pour la table `t_quartier`
--
ALTER TABLE `t_quartier`
  ADD PRIMARY KEY (`CodeQuartier`),
  ADD KEY `fk_quartier_commune` (`CodeCommune`);

--
-- Index pour la table `t_rapport`
--
ALTER TABLE `t_rapport`
  ADD PRIMARY KEY (`CodeRapport`),
  ADD KEY `fk_rapport_mois` (`CodeMois`),
  ADD KEY `fk_rapport_annee` (`CodeAnnee`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_agent`
--
ALTER TABLE `t_agent`
  MODIFY `IdAgent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `t_annee`
--
ALTER TABLE `t_annee`
  MODIFY `CodeAnnee` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `t_avenue`
--
ALTER TABLE `t_avenue`
  MODIFY `CodeAvenue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `t_categorie_paiement`
--
ALTER TABLE `t_categorie_paiement`
  MODIFY `CodeCategorie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_commune`
--
ALTER TABLE `t_commune`
  MODIFY `CodeCommune` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `t_fonction`
--
ALTER TABLE `t_fonction`
  MODIFY `CodeFonction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `t_menage`
--
ALTER TABLE `t_menage`
  MODIFY `IdMenage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `t_mois`
--
ALTER TABLE `t_mois`
  MODIFY `CodeMois` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `t_paiement`
--
ALTER TABLE `t_paiement`
  MODIFY `CodePaiement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `t_quartier`
--
ALTER TABLE `t_quartier`
  MODIFY `CodeQuartier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `t_rapport`
--
ALTER TABLE `t_rapport`
  MODIFY `CodeRapport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_agent`
--
ALTER TABLE `t_agent`
  ADD CONSTRAINT `fk_agent_fonction` FOREIGN KEY (`CodeFonction`) REFERENCES `t_fonction` (`CodeFonction`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_agent_quartier` FOREIGN KEY (`QuartierAgent`) REFERENCES `t_quartier` (`CodeQuartier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_avenue`
--
ALTER TABLE `t_avenue`
  ADD CONSTRAINT `fk_avenue_quartier` FOREIGN KEY (`CodeQuartier`) REFERENCES `t_quartier` (`CodeQuartier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_menage`
--
ALTER TABLE `t_menage`
  ADD CONSTRAINT `fk_menage_avenue` FOREIGN KEY (`CodeAvenue`) REFERENCES `t_avenue` (`CodeAvenue`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_menage_quartier` FOREIGN KEY (`CodeQuartier`) REFERENCES `t_quartier` (`CodeQuartier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_menage_verificateur` FOREIGN KEY (`CodeVerificateur`) REFERENCES `t_agent` (`IdAgent`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_paiement`
--
ALTER TABLE `t_paiement`
  ADD CONSTRAINT `fk_paiement_menage` FOREIGN KEY (`CodeMenage`) REFERENCES `t_menage` (`IdMenage`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_paiement_rapport` FOREIGN KEY (`CodeRapport`) REFERENCES `t_rapport` (`CodeRapport`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_quartier`
--
ALTER TABLE `t_quartier`
  ADD CONSTRAINT `fk_quartier_commune` FOREIGN KEY (`CodeCommune`) REFERENCES `t_commune` (`CodeCommune`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_rapport`
--
ALTER TABLE `t_rapport`
  ADD CONSTRAINT `fk_rapport_annee` FOREIGN KEY (`CodeAnnee`) REFERENCES `t_annee` (`CodeAnnee`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rapport_mois` FOREIGN KEY (`CodeMois`) REFERENCES `t_mois` (`CodeMois`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
