-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 15 Décembre 2017 à 11:33
-- Version du serveur :  5.6.20-log
-- Version de PHP :  5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `boutique_livre`
--

CREATE TABLE IF NOT EXISTS `boutique_livre` (
`no_article` int(20) NOT NULL,
  `type_article` varchar(20) NOT NULL,
  `titre` varchar(60) NOT NULL,
  `auteur` varchar(60) NOT NULL,
  `prix` float NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `boutique_livre`
--

INSERT INTO `boutique_livre` (`no_article`, `type_article`, `titre`, `auteur`, `prix`) VALUES
(1, 'Livre', 'Les Fleurs du mal', 'Ch. Baudelaire', 3.5),
(2, 'Livre', 'Travaux pratiques avec Excel 2016', 'F. Lemainque', 19.5),
(3, 'Livre', 'La nausée', 'J.P. Sartre', 21.5),
(4, 'Livre', 'Guerre et Paix', 'Léon Tolstoï', 9.2),
(5, 'Livre', 'Le médecin malgré lui', 'Molière', 5.6);

-- --------------------------------------------------------

--
-- Structure de la table `boutique_musique`
--

CREATE TABLE IF NOT EXISTS `boutique_musique` (
`no_article` int(20) NOT NULL,
  `type_article` varchar(20) NOT NULL,
  `titre` varchar(60) NOT NULL,
  `artiste` varchar(60) NOT NULL,
  `prix` float NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `boutique_musique`
--

INSERT INTO `boutique_musique` (`no_article`, `type_article`, `titre`, `artiste`, `prix`) VALUES
(1, 'CD', 'Revolver', 'Beatles', 8.99),
(2, 'CD', 'Abbey Road', 'Beatles', 8.99),
(3, 'CD', 'Best of Amstrong', 'Louis Amstrong', 9.95),
(4, 'CD', 'Toccata et fugue en D mineur', 'Ludwig von Beethoven', 9.95);

-- --------------------------------------------------------

--
-- Structure de la table `profil_utilisateur`
--

CREATE TABLE IF NOT EXISTS `profil_utilisateur` (
  `nom` varchar(40) NOT NULL,
  `id_utilisateur` varchar(20) NOT NULL,
  `motdepasse` varchar(20) NOT NULL,
  `adresse_ligne1` varchar(40) NOT NULL,
  `adresse_ligne2` varchar(40) DEFAULT NULL,
  `ville` varchar(20) NOT NULL,
  `pays` varchar(20) NOT NULL,
  `codepostal` varchar(5) NOT NULL,
  `sexe` varchar(3) NOT NULL,
  `an_naissance` varchar(4) NOT NULL,
  `adresse_email` varchar(20) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `solde_compte` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `profil_utilisateur`
--

INSERT INTO `profil_utilisateur` (`nom`, `id_utilisateur`, `motdepasse`, `adresse_ligne1`, `adresse_ligne2`, `ville`, `pays`, `codepostal`, `sexe`, `an_naissance`, `adresse_email`, `telephone`, `solde_compte`) VALUES
('Barnabay', 'barnleboss', '123', 'qezh', 'ujvg', 'mkhg', 'yhgv', '12456', 'M', '0404', 'barn@gmail.com', '1245789865', 0),
('dubois', 'dubois', '123', '3 place des Saules', NULL, 'Moulin', 'France', '54100', 'Mr', '1970', 'dubois@fai.fr', '12345678', 112.31),
('Dupont', 'dupont', 'password', '3 allée des Glycines', NULL, 'Montpellier', 'France', '34000', 'Mr', '1970', 'jdupont@fai.fr', '12345678', 204.5),
('Gab', 'Gab04', '123', 'qetlmh', 'lglkug', 'liugmu', 'syrjk', '31456', 'm', '1234', 'qetjh@qetj', '1245789865', 0),
('Joe', 'Joe1', '147', 'mhqrzeg', 'lùqnrezh', 'mqknhu', 'pays', '98735', 'M', '1999', 'adresse@email.com', '0514874351', 0),
('Rignal', 'o.rignal', 'p@$$word', '', NULL, '', '', '', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
`no_commande` int(11) NOT NULL,
  `id_utilisateur` varchar(20) NOT NULL,
  `no_article` varchar(20) NOT NULL,
  `type_article` varchar(10) NOT NULL,
  `quantité` int(11) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `etat` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Contenu de la table `transaction`
--

INSERT INTO `transaction` (`no_commande`, `id_utilisateur`, `no_article`, `type_article`, `quantité`, `date`, `etat`) VALUES
(22, 'dupont', '2', 'Livre', 1, '2015-09-11', 'En attente'),
(23, 'dupont', '4', 'C.D.', 1, '2015-09-11', 'En attente'),
(24, 'dubois', '3', 'Livre', 1, '2015-09-11', 'En attente'),
(26, 'dubois', '2', 'Livre', 1, '2015-09-13', 'En attente'),
(27, 'dubois', '1', 'CD', 1, '2015-09-13', 'En attente');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `boutique_livre`
--
ALTER TABLE `boutique_livre`
 ADD PRIMARY KEY (`no_article`), ADD KEY `index_on_livre_no_article` (`no_article`), ADD KEY `index_on_livre_titre` (`titre`), ADD KEY `index_on_livre_auteur` (`auteur`), ADD KEY `no_article` (`no_article`), ADD KEY `titre` (`titre`), ADD KEY `auteur` (`auteur`);

--
-- Index pour la table `boutique_musique`
--
ALTER TABLE `boutique_musique`
 ADD PRIMARY KEY (`no_article`), ADD KEY `index_on_musique_no_article` (`no_article`), ADD KEY `index_on_musique_titre` (`titre`), ADD KEY `index_on_musique_artiste` (`artiste`), ADD KEY `no_article` (`no_article`), ADD KEY `titre` (`titre`), ADD KEY `artiste` (`artiste`);

--
-- Index pour la table `profil_utilisateur`
--
ALTER TABLE `profil_utilisateur`
 ADD PRIMARY KEY (`id_utilisateur`);

--
-- Index pour la table `transaction`
--
ALTER TABLE `transaction`
 ADD PRIMARY KEY (`no_commande`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `boutique_livre`
--
ALTER TABLE `boutique_livre`
MODIFY `no_article` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `boutique_musique`
--
ALTER TABLE `boutique_musique`
MODIFY `no_article` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `transaction`
--
ALTER TABLE `transaction`
MODIFY `no_commande` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
