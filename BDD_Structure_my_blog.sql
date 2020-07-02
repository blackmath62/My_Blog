-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 25 juin 2020 à 17:38
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `my_blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_title` varchar(255) NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_content` text NOT NULL,
  `post_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `validate_id` int(11) DEFAULT '1',
  `treatment_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`),
  KEY `comment_validation_table_comment_table_fk` (`validate_id`),
  KEY `users_table_comment_table_fk` (`users_id`),
  KEY `post_list_table_comment_table_fk` (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `comment_validation`
--

DROP TABLE IF EXISTS `comment_validation`;
CREATE TABLE IF NOT EXISTS `comment_validation` (
  `validate_id` int(11) NOT NULL AUTO_INCREMENT,
  `validation_label` varchar(255) NOT NULL,
  PRIMARY KEY (`validate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment_validation`
--

INSERT INTO `comment_validation` (`validate_id`, `validation_label`) VALUES
(1, 'En Attente'),
(2, 'validé'),
(3, 'Refusé');

-- --------------------------------------------------------

--
-- Structure de la table `law`
--

DROP TABLE IF EXISTS `law`;
CREATE TABLE IF NOT EXISTS `law` (
  `law_id` int(11) NOT NULL AUTO_INCREMENT,
  `law_label` varchar(255) NOT NULL,
  PRIMARY KEY (`law_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `law`
--

INSERT INTO `law` (`law_id`, `law_label`) VALUES
(1, 'Administrateur'),
(3, 'Visiteur'),
(4, 'Inconnu');

-- --------------------------------------------------------

--
-- Structure de la table `post_list`
--

DROP TABLE IF EXISTS `post_list`;
CREATE TABLE IF NOT EXISTS `post_list` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_title` varchar(255) NOT NULL,
  `users_id` int(11) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_chapo` varchar(200) NOT NULL,
  `post_content` text NOT NULL,
  `modification_date` datetime DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  KEY `users_table_post_list_table_fk` (`users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) NOT NULL,
  `Pseudo` varchar(100) NOT NULL,
  `users_name` varchar(255) DEFAULT NULL,
  `users_last_name` varchar(255) DEFAULT NULL,
  `mdp` varchar(255) NOT NULL,
  `law_id` int(11) DEFAULT '4',
  `img_users` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `create_date_users` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`users_id`),
  KEY `law_table_users_table_fk` (`law_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
