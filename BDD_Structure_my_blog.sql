-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 04 août 2020 à 13:20
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

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_title`, `comment_date`, `comment_content`, `post_id`, `users_id`, `validate_id`, `treatment_date`) VALUES
(31, 'coucou', '2020-06-05 16:45:13', 'ça va ?', 39, 9, 1, '2020-06-05 16:45:13'),
(3, 'salut, test 1', '2019-11-17 20:49:13', 'FSDGBQZBVQZ', 3, 9, 2, '2020-06-09 11:48:39'),
(6, 'bfwdbdfndngngxfn', '2019-11-18 10:42:01', 'ngdnwxgnwxgfnxcvnxwdfg', 3, 9, 2, '2020-06-04 15:12:05'),
(18, 'VQB %BKN µM$*bsfn, b$*q&²', '2019-12-01 13:01:12', 'br$*efonqb$*qn b$*an$biofdn s$*bosnfbfq\r\nbqndfbn$qinb\r\nqzerobnqsdfs\r\nb^qnfd^p\r\nbglm?Z\r\nEOGN?VQS\r\nDFVLMQ?\r\nBRVPQER?BIOQDFNFBOPNQ\r\n', 1, 9, 2, '2020-06-08 19:16:20'),
(17, 'dsqgbqzerbhsdfbn', '2019-12-01 13:00:54', 'qetnsdfnqerhqem,r$*bpùsdgn,b$pqùzeknv£INVQS\r\np,jv$opqqsonhgb\r\nq\r\nBGNQDFIBNQ\r\nV<SNBV£QPSµOGQBV', 3, 9, 2, '2020-04-24 08:09:35'),
(16, 'dvqze ùvklsdfn ùvklm', '2019-12-01 13:00:38', 'vgklqzdbv*qkzerlqzernb$*qekbnq$ù*e', 3, 9, 2, '2020-04-24 08:09:32'),
(15, 'Salut, voici un nouveau commentaire', '2019-12-01 12:59:41', 'Comment dire, je n\'ai pas grand chose à dire, mais je pense qu\'il est important d\'alimenter le blog, Google aime bien ça !', 3, 9, 2, '2020-04-24 08:09:12'),
(19, 'qefbseq,nbopq?KRN', '2019-12-01 13:01:19', '', 1, 9, 2, '2020-04-24 08:09:43'),
(32, 'salut', '2020-06-05 16:47:54', 'ça va ?', 39, 9, 1, '2020-06-05 16:47:54'),
(30, 'coucou', '2020-06-05 16:44:12', '&ccedil;a va ?', 33, 9, 2, '2020-06-05 14:49:49'),
(21, 'bgqebkln ,qù$*on,bvrqe', '2019-12-01 13:01:54', 'bn eqùkbnqrer4g5bqd4bqdlmbvqer\r\nqgrb qlmkb25qsdfhbq,;mvwq35sfwq<56bgvwqq<\r\nvbq,<fsdbnwq5', 1, 9, 2, '2020-04-24 08:09:46'),
(22, '', '2019-12-01 16:51:46', '', 3, 9, 2, '2020-04-24 08:09:48'),
(23, '', '2019-12-01 16:52:59', '', 3, 9, 2, '2020-04-24 08:10:28'),
(24, 'bvfsdqbqfbqdfb', '2019-12-01 22:36:58', 'fqbqsbnbqerbqefb', 3, 10, 2, '2020-04-24 08:10:30'),
(25, 'Salut, Nouveau comment !', '2019-12-10 21:37:51', 'Hello Word, Comment ça va ?\r\n\r\nIci la lune, il caille un peu et attention au radiation !\r\n\r\ncdt,', 3, 9, 2, '2020-04-24 08:10:31'),
(26, 'test', '2019-12-10 22:15:24', 'tdgsvsdv,n*>vl,sd*v\r\n<vd,<s\r\ndvl<\r\ndvmn<sb\r\n<sùm^,lmdgv,\r\nw<sùmpgbv', 2, 9, 2, '2020-04-24 08:10:33'),
(27, 'Jolie Site internet !', '2020-04-16 14:47:04', 'J’espère que mon commentaire va être validé, je trouve vraiment que ce site est très sympa !\r\nBonne continuation :)', 1, 11, 2, '2020-04-24 08:10:24'),
(28, 'Sympa la charte graphique !', '2020-05-05 16:14:21', 'Salut,\r\n\r\n Je voulais déposer un petit commentaire car je trouve vraiment le blog sympa, visuellement en tout cas,\r\n\r\nje te souhaite bonne continuation et je prends note de l\'adresse de ton site et ferai appel à toi au besoin,\r\n\r\nCdt,', 1, 9, 2, '2020-05-05 14:14:42'),
(29, 'Salut j\'aime bien ce site', '2020-05-26 08:29:12', 'Vraiment sympa ton site, c\'est cool', 17, 9, 2, '2020-05-26 06:31:49'),
(33, 'coucou ça va et toi ?', '2020-06-05 16:50:08', 'ça va bien', 39, 9, 2, '2020-06-05 14:50:33'),
(34, 'Cool mon commentaire est passé', '2020-06-05 16:53:46', 'En même temps je suis sympa :)', 39, 9, 1, '2020-06-05 16:53:46'),
(35, 'Cool mon commentaire est passé', '2020-06-05 16:54:02', 'En même temps je suis sympa :)', 39, 9, 1, '2020-06-05 16:54:02'),
(36, 'Cool mon commentaire est passé', '2020-06-05 16:56:54', 'En même temps je suis sympa :)', 39, 9, 2, '2020-06-05 14:57:08'),
(37, 'Ah celui là aussi !', '2020-06-05 16:57:35', 'C\'est moi qui vais alimenter ton site', 39, 9, 2, '2020-06-05 14:58:02'),
(38, 'test message', '2020-06-05 17:07:47', 'alors le message s\'affiche ?', 39, 9, 1, '2020-06-05 17:07:47'),
(39, 'test message', '2020-06-05 17:09:16', 'alors le message s\'affiche ?', 39, 9, 1, '2020-06-05 17:09:16'),
(40, 'est celui là tu l\'accepte', '2020-06-05 17:09:35', 'Pas sûr ?', 39, 9, 1, '2020-06-05 17:09:35'),
(41, 'est celui là tu l\'accepte', '2020-06-05 17:09:56', 'Pas sûr ?', 39, 9, 1, '2020-06-05 17:09:56'),
(42, 'prends ça', '2020-06-05 17:10:16', 'Boum !', 39, 9, 1, '2020-06-05 17:10:16'),
(43, 'prends ça', '2020-06-05 17:12:34', 'Boum !', 39, 9, 1, '2020-06-05 17:12:34'),
(44, 'prends ça', '2020-06-05 17:12:49', 'Boum !', 39, 9, 1, '2020-06-05 17:12:49'),
(45, 'cdsvsdv', '2020-06-05 17:12:58', 'vsdvswdv', 39, 9, 1, '2020-06-05 17:12:58'),
(46, 'cdsvsdv', '2020-06-05 17:13:35', 'vsdvswdv', 39, 9, 1, '2020-06-05 17:13:35'),
(47, 'vsdbqzrbrqzb', '2020-06-05 17:13:47', 'qerbqerberqb', 39, 9, 1, '2020-06-05 17:13:47'),
(48, 'cette fois c\'est la bonne', '2020-06-05 17:19:50', 'Allez on y crois !', 39, 9, 1, '2020-06-05 17:19:50'),
(49, 'cette fois c\'est la bonne', '2020-06-05 17:20:22', 'Allez on y crois !', 39, 9, 1, '2020-06-05 17:20:22'),
(50, 'cette fois c\'est la bonne', '2020-06-05 17:21:37', 'Allez on y crois !', 39, 9, 1, '2020-06-05 17:21:37'),
(51, 'cette fois c\'est la bonne', '2020-06-05 17:22:20', 'Allez on y crois !', 39, 9, 1, '2020-06-05 17:22:20'),
(52, 'cette fois c\'est la bonne', '2020-06-05 17:23:29', 'Allez on y crois !', 39, 9, 1, '2020-06-05 17:23:29'),
(53, 'cette fois c\'est la bonne', '2020-06-05 17:31:05', 'Allez on y crois !', 39, 9, 1, '2020-06-05 17:31:05'),
(54, 'cette fois c\'est la bonne', '2020-06-05 17:31:27', 'Allez on y crois !', 39, 9, 3, '2020-08-04 12:56:19'),
(55, 'dvsd vSMSNbmS%Lb', '2020-06-08 20:19:05', 'ùlbfùbneqKBv nd\r\nl KV KDNZKBVNKMZ', 40, 9, 2, '2020-06-08 18:19:19'),
(56, 'Message de validation de commentaire', '2020-06-16 08:38:10', 'Salut Jérôme,\r\n\r\n Peux tu me dire comment tu as fait pour le message qui s\'affiche sous forme de bandeau ?\r\n\r\nMerci pour ton aide,\r\n\r\ncdt,', 40, 9, 1, '2020-06-16 08:38:10'),
(57, 'alert(&#34;test&#34;)', '2020-06-25 16:16:52', 'alert(&#34;test&#34;)', 42, 9, 2, '2020-06-25 14:19:09'),
(58, 'dacsq', '2020-06-25 17:45:59', 'cazcqscz', 42, 9, 1, '2020-06-25 17:45:59');

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
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post_list`
--

INSERT INTO `post_list` (`post_id`, `post_title`, `users_id`, `post_date`, `post_chapo`, `post_content`, `modification_date`) VALUES
(1, 'C\'est là que tout commence !', 9, '2019-10-08 00:00:00', 'Bienvenue sur mon blog, il est temps de commencer à poster sur le blog ! j\'attends vos commentaires avec impatience.  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam rhoncus mauris id m', 'Bienvenue sur mon blog, il est temps de commencer à poster sur le blog ! j\'attends vos commentaires avec impatience.\r\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam rhoncus mauris id magna suscipit, eu blandit metus laoreet. Maecenas rhoncus euismod efficitur. In quis est id ex hendrerit auctor. Aliquam mollis nibh id nisi ullamcorper vehicula. Sed suscipit tincidunt nulla in pretium. Mauris eleifend maximus elit non egestas. Suspendisse tellus ante, pharetra ac nunc a, pulvinar commodo tortor. Nunc placerat metus sed augue eleifend fermentum. Duis laoreet risus sem, ut interdum odio commodo in. Nulla ultrices, nunc id lobortis tristique, arcu enim volutpat ante, quis ultrices neque odio sed ligula. Vivamus malesuada lacus et tellus scelerisque convallis. Vestibulum congue ultricies urna id rutrum.\r\n\r\nFusce vel dapibus ex. Nullam consequat eget elit vel aliquam. Sed ut sodales massa. Maecenas eu semper sapien. Curabitur volutpat orci vel velit pharetra accumsan. Phasellus nec interdum justo, vitae molestie nunc. Maecenas sed rutrum magna. Phasellus gravida malesuada ante sed commodo. Quisque vulputate diam mauris, posuere dictum justo fringilla a. Nam congue sapien tempor, semper ante quis, imperdiet ipsum. Cras non nisi nec velit volutpat cursus sit amet vel sem. Maecenas aliquet iaculis ante, et aliquam orci semper eget. Maecenas tincidunt suscipit lobortis. Aliquam at arcu sagittis, iaculis turpis ut, faucibus ipsum. ', NULL),
(13, 'On va devoir', 9, '2020-04-03 18:45:05', '<p>Cr&eacute;er plein de poste pour essayer les fonctionnalit&eacute;s</p>\r\n<p>J\'esp&eacute;re que &ccedil;a va aller</p>', '<p>Cr&eacute;er plein de poste pour essayer les fonctionnalit&eacute;s</p>\r\n<p>J\'esp&eacute;re que &ccedil;a va aller</p>', NULL),
(32, 'Je vais créer un nouveau post pour voir ci la class session fonctionne correctement', 9, '2020-05-26 09:23:51', '<p>Suspense, je me demande si cela va fonctionner</p>\r\n<p>&nbsp;</p>\r\n<p>il faut encapsuler les donn&eacute;es</p>', '<p>Suspense, je me demande si cela va fonctionner</p>\r\n<p>&nbsp;</p>\r\n<p>il faut encapsuler les donn&eacute;es</p>', NULL),
(10, 'Bon ok, je recommence', 9, '2020-04-03 17:02:22', '<p>Cette fois ci c\'est la bonne,</p>\r\n<p>Je vais enfin r&eacute;ussir &agrave; modifier mon poste,</p>\r\n<p>Je suis s&ucirc;r que tout va bien se passer</p>', '<p>Cette fois ci c\'est la bonne,</p>\r\n<p>Je vais enfin r&eacute;ussir &agrave; modifier mon poste,</p>\r\n<p>Je suis s&ucirc;r que tout va bien se passer</p>', '2020-04-03 16:22:26'),
(11, 'Il faut refaire un jolie post, bien présenté !', 9, '2020-04-03 17:02:35', '<p>Je n\'ai pas sp&eacute;cialement d\'inspiration, il faut que je parvienne a alimenter mon site, le contenu est tr&eacute;s important.</p>\r\n<p>Imaginez un site vide ! qui va vouloir aller le consuler ', '<p>Je n\'ai pas sp&eacute;cialement d\'inspiration, il faut que je parvienne a alimenter mon site, le contenu est tr&eacute;s important.</p>\r\n<p>Imaginez un site vide ! qui va vouloir aller le consuler ? personne et c\'est normal</p>', '2020-04-03 16:21:29'),
(33, 'ça marche ?', 9, '2020-05-26 09:24:19', '<p>test class session</p>', '<p>test class session</p>', NULL),
(25, 'Coucou c\'est nous !', 9, '2020-04-03 18:46:39', '<p>Comment &ccedil;a va les poteaux</p>', '<p>Comment &ccedil;a va les poteaux</p>', '2020-05-05 15:41:31'),
(27, 'Alors là normalement ça fonctionne', 9, '2020-04-03 18:46:47', '<p>Voici le contenu</p>\r\n<p>je peux en ajouter, sans probl&eacute;me !</p>', '<p>Voici le contenu</p>\r\n<p>je peux en ajouter, sans probl&eacute;me !</p>', '2020-05-05 15:32:48'),
(31, 'Je ne sais pas si ma magouille va fonctionner ....', 9, '2020-05-05 17:52:20', '<p>Suspense, on est impatient de savoir si c\'est bon</p>', '<p>Suspense, on est impatient de savoir si c\'est bon</p>', NULL),
(36, 'nouveau post 04-06-2020 à 16h09', 9, '2020-05-29 15:26:49', '<p>Il est nouveau</p>\r\n<p>On ajoute du nouveau contenu</p>', '<p>Il est nouveau</p>\r\n<p>On ajoute du nouveau contenu</p>', '2020-06-04 14:10:04'),
(37, 'encore un nouveau post modifié le 04-06-2020 à 15h46', 9, '2020-05-29 15:29:43', '<p>il en faut plein !</p>\r\n<p>Je suis d&eacute;&ccedil;u, le Codacy n\'a pas beaucoup boug&eacute; ....</p>', '<p>il en faut plein !</p>\r\n<p>Je suis d&eacute;&ccedil;u, le Codacy n\'a pas beaucoup boug&eacute; ....</p>', '2020-06-04 13:48:58'),
(43, 'Je modifie ce poste car les lorem c&#39;est pas super !', 9, '2020-08-04 15:18:03', 'Voil&agrave;, je fais tout simplement une modification\r\nJe suis s&ucirc;r que cela va fonctionner', 'Voil&agrave;, je fais tout simplement une modification\r\nJe suis s&ucirc;r que cela va fonctionner', '2020-08-04 13:19:01'),
(40, 'Je vais écrire du vrai texte ça fait mieux Modifié le 09-06-2020', 9, '2020-06-08 20:18:47', '<p>Il semble que vous ayez vraiment envie de lire tout ce que je poste ! je ne vais pas r&eacute;ussi &agrave; satisfaire votre soif inssaciable de connaissance . ici aussi c\'est modifi&eacute; le 09-', '<p>Il semble que vous ayez vraiment envie de lire tout ce que je poste ! je ne vais pas r&eacute;ussi &agrave; satisfaire votre soif inssaciable de connaissance . ici aussi c\'est modifi&eacute; le 09-06-2020</p>', '2020-06-09 11:48:27');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) NOT NULL,
  `Pseudo` varchar(100) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `law_id` int(11) DEFAULT '4',
  `token` varchar(255) DEFAULT NULL,
  `create_date_users` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`users_id`),
  KEY `law_table_users_table_fk` (`law_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`users_id`, `mail`, `Pseudo`, `mdp`, `law_id`, `token`, `create_date_users`) VALUES
(9, 'jpochet@lhermitte.fr', 'Jérôme', '$2y$10$zzxFR9vmbT88kid5ODK7juUfZC9rEBK/9i.pQyJ7ZP8b272cYKmwS', 1, '', '2019-11-05 20:02:42'),
(29, 'patricia@patricia.fr', 'patricia', '$2y$10$G2RA8BOgBCngIcPdgTW3y.m0aS14YcX9p32retsiGfyXFtH/6aI96', 4, NULL, '2020-06-08 21:04:40'),
(11, 'louise@louise.fr', 'Louise', '$2y$10$TmiYE1BtKrWuleynpOmSmOD89x/H4Fif6VvFUm51EcJc/L7PBaPIq', 3, NULL, '2019-11-30 16:00:12'),
(14, 'sabrina@sabrina.fr', 'sabrina', '$2y$10$ZKyN6yiF/he5Kd7VQHYL5e96cwB1Cp7z.lTcxIZPyvr/vmGR.hSou', 4, NULL, '2020-01-20 20:02:42'),
(28, 'philippe@philippe.fr', 'philippe', '$2y$10$EXMWBSerJo4WqEdjOBRLguVBXzh7agseBPnRcdPdTzoRneU3dT47G', 3, NULL, '2020-05-07 13:50:23'),
(32, 'bruno@bruno.fr', 'bruno', '$2y$10$mCHmjNWKwWBkClTQZl40DOyqU.KUVpIlBNIUDrpW9hBHjCJ3vO39y', 4, NULL, '2020-06-15 14:57:21'),
(31, 'yves@yves.fr', 'yves', '$2y$10$zlONCqhqleVJMoadLwijy.lJ4wmatUgQhcEzQBtGe.2/4FVUEUMKy', 3, NULL, '2020-06-15 14:55:25'),
(23, 'jmlhermitte@lhermitte.fr', 'jml', '$2y$10$JvdIeEU7Hi5odt5KrF0Ht.kUWDsWKtPY3yZmsm4J9N.UV4A7B2A8i', 3, NULL, '2020-04-24 10:21:02'),
(24, 'laurent@laurent.fr', 'laurent', '$2y$10$NS8eGtYboBaWIXzpyVmh4eDX9ip7VnhahJjrGFxfnuH/c3OnYmQwa', 4, NULL, '2020-04-24 10:21:21'),
(25, 'thomas@thomas.fr', 'thomas', '$2y$10$pDU3Vh6kQLrRDGIK3CMWcehJx/QHewLrxWYwtT6I84sYbgxKdJE2i', 3, NULL, '2020-04-24 10:21:40'),
(26, 'xavier@xavier.fr', 'xavier', '$2y$10$DwQbGvtJxGHqs9BtHxOEyemFZv8jFSSynvirFranGecE8/nWnSk.i', 3, NULL, '2020-04-24 10:22:13'),
(33, 'lucien@lucien.fr', 'lucien', '$2y$10$sKtc31MGQQ4d3zFDJq2JDuNFlmYwIZIk0IJ.m0SCN0y.MlVWmwHO2', 4, NULL, '2020-06-25 14:24:33'),
(34, 'daniel@daniel.fr', 'daniel', '$2y$10$moojP4Zn.FdK0.r20X2bn.0oBAkmvMb685DMcHm8Kv0ClbpWpby6m', 4, NULL, '2020-06-25 14:27:14');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
