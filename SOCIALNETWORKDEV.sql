-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Lun 19 Janvier 2015 à 14:52
-- Version du serveur :  5.5.38
-- Version de PHP :  5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `SOCIALNETWORKDEV`
--
CREATE DATABASE IF NOT EXISTS `SOCIALNETWORKDEV` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `SOCIALNETWORKDEV`;

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
`id_post` int(11) unsigned NOT NULL,
  `id_user` int(11) NOT NULL,
  `contenu` varchar(300) NOT NULL DEFAULT '',
  `titre` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
`id_user` int(11) unsigned NOT NULL,
  `nom_user` varchar(20) DEFAULT NULL,
  `prenom_user` varchar(20) DEFAULT NULL,
  `mail_user` varchar(50) NOT NULL DEFAULT '',
  `password_user` varchar(40) NOT NULL,
  `date_de_naissance_user` date DEFAULT NULL,
  `sexe_user` varchar(5) DEFAULT NULL,
  `adresse_user` varchar(50) DEFAULT NULL,
  `code_postal_user` varchar(5) DEFAULT NULL,
  `ville_user` varchar(30) DEFAULT NULL,
  `pays_user` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`id_post`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id_user`), ADD UNIQUE KEY `mail` (`mail_user`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
MODIFY `id_post` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
MODIFY `id_user` int(11) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
