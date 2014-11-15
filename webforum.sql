-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 13 Novembre 2014 à 12:53
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `webforum`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `CatId` int(11) NOT NULL AUTO_INCREMENT,
  `CatLibelle` varchar(100) NOT NULL,
  `CatDate` datetime NOT NULL,
  `UserId` int(11) NOT NULL,
  PRIMARY KEY (`CatId`),
  KEY `UserId` (`UserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`CatId`, `CatLibelle`, `CatDate`, `UserId`) VALUES
(1, 'Categorie 1', '2014-11-11 11:30:08', 12),
(2, 'Categorie 2', '2014-11-11 11:30:22', 12),
(3, 'Categorie 3', '2014-11-11 11:30:32', 12);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `MesId` int(11) NOT NULL AUTO_INCREMENT,
  `MesText` varchar(500) NOT NULL,
  `MesDate` datetime NOT NULL,
  `UserId` int(11) NOT NULL,
  `TopicId` int(11) NOT NULL,
  PRIMARY KEY (`MesId`),
  KEY `UserId` (`UserId`),
  KEY `TopicId` (`TopicId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`MesId`, `MesText`, `MesDate`, `UserId`, `TopicId`) VALUES
(1, 'message 1', '2014-11-11 11:37:01', 12, 1),
(2, 'message 2', '2014-11-11 11:37:01', 13, 1),
(3, 'message 3', '2014-11-11 11:37:01', 14, 1),
(4, 'message 1', '2014-11-11 11:37:01', 12, 2),
(5, 'message 2', '2014-11-11 11:37:01', 13, 2),
(6, 'message 3', '2014-11-11 11:37:01', 14, 2),
(7, 'message 1', '2014-11-11 11:37:01', 12, 3),
(8, 'message 2', '2014-11-11 11:37:01', 13, 3),
(9, 'message 3', '2014-11-11 11:37:01', 14, 3),
(10, 'message 1', '2014-11-11 11:37:01', 12, 4),
(11, 'message 2', '2014-11-11 11:37:01', 13, 4),
(12, 'message 3', '2014-11-11 11:37:01', 14, 4),
(13, 'message 1', '2014-11-11 11:37:01', 12, 5),
(14, 'message 2', '2014-11-11 11:37:01', 13, 5),
(15, 'message 3', '2014-11-11 11:37:01', 14, 5),
(16, 'message 1', '2014-11-11 11:37:01', 12, 6),
(17, 'message 2', '2014-11-11 11:37:01', 13, 6),
(18, 'message 3', '2014-11-11 11:37:01', 14, 6);

-- --------------------------------------------------------

--
-- Structure de la table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `TopicId` int(11) NOT NULL AUTO_INCREMENT,
  `TopicLibelle` varchar(100) NOT NULL,
  `TopicDate` datetime NOT NULL,
  `UserId` int(11) NOT NULL,
  `CatId` int(11) NOT NULL,
  PRIMARY KEY (`TopicId`),
  KEY `UserId` (`UserId`),
  KEY `CatId` (`CatId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `topics`
--

INSERT INTO `topics` (`TopicId`, `TopicLibelle`, `TopicDate`, `UserId`, `CatId`) VALUES
(1, 'Topic 1.1', '2014-11-11 11:33:02', 12, 1),
(2, 'Topic 1.2', '2014-11-11 11:33:02', 13, 1),
(3, 'Topic 2.1', '2014-11-11 11:33:02', 12, 2),
(4, 'Topic 2.2', '2014-11-11 11:33:02', 13, 2),
(5, 'Topic 3.1', '2014-11-11 11:33:02', 12, 3),
(6, 'Topic 3.2', '2014-11-11 11:33:02', 13, 3);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UserId` int(11) NOT NULL AUTO_INCREMENT,
  `UserLogin` varchar(50) NOT NULL,
  `UserPassword` varchar(50) NOT NULL,
  `UserRole` int(11) NOT NULL,
  `UserAvatar` varchar(200) NOT NULL,
  PRIMARY KEY (`UserId`),
  UNIQUE KEY `UserLogin` (`UserLogin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`UserId`, `UserLogin`, `UserPassword`, `UserRole`, `UserAvatar`) VALUES
(12, 'admin', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 3, 'defaut.jpg'),
(13, 'moderateur', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 2, 'defaut.jpg'),
(14, 'utilisateur', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 1, 'defaut.jpg');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`TopicId`) REFERENCES `topics` (`TopicId`);

--
-- Contraintes pour la table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`),
  ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`CatId`) REFERENCES `categories` (`CatId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
