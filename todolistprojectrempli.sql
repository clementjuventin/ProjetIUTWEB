-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 08 jan. 2021 à 14:07
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `todolistproject`
--

-- --------------------------------------------------------

--
-- Structure de la table `list`
--

DROP TABLE IF EXISTS `list`;
CREATE TABLE IF NOT EXISTS `list` (
  `listId` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(200) NOT NULL,
  `user` varchar(60) NOT NULL,
  `isPublic` int(16) NOT NULL,
  PRIMARY KEY (`listId`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `list`
--

INSERT INTO `list` (`listId`, `label`, `user`, `isPublic`) VALUES
(15, 'TÃ¢che du jour privÃ©e', 'user', 0),
(18, 'TÃ¢che commune publique', '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `listId` int(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(512) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(20) NOT NULL,
  `isDone` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=201 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `task`
--

INSERT INTO `task` (`listId`, `title`, `description`, `id`, `color`, `isDone`) VALUES
(15, 'DÃ©poser un colis Ã  la poste', '', 197, '#ffd6a5', 0),
(15, 'DÃ©jeuner', '8h30 avec Matthieu Reefond', 198, '#ffc6ff', 1),
(18, 'Faire un rendez vous sur teams', '9h', 199, '#9bf6ff', 0),
(15, 'Faire les courses', 'beurre, lait, baguette, cyberpunk', 195, '#a0c4ff', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`login`, `password`) VALUES
('user', '$2y$12$BGmJmfsVNEIK62/ugnW46ujRKRxavJpc6ScSLDC.0zvzA9tQ0AswC');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
