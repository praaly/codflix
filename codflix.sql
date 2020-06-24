-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 24 juin 2020 à 20:35
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `codflix`
--

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Horreur'),
(3, 'Science-Fiction');

-- --------------------------------------------------------

--
-- Structure de la table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `finish_date` datetime DEFAULT NULL,
  `watch_duration` int(11) NOT NULL DEFAULT 0 COMMENT 'in seconds',
  PRIMARY KEY (`id`),
  KEY `history_user_id_fk_media_id` (`user_id`),
  KEY `history_media_id_fk_media_id` (`media_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `listepisode`
--

DROP TABLE IF EXISTS `listepisode`;
CREATE TABLE IF NOT EXISTS `listepisode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_serie` int(11) NOT NULL,
  `id_season` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `summary` longtext NOT NULL,
  `url` text NOT NULL,
  `release_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_season` (`id_season`),
  KEY `id_serie` (`id_serie`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `listepisode`
--

INSERT INTO `listepisode` (`id`, `id_serie`, `id_season`, `name`, `summary`, `url`, `release_date`) VALUES
(5, 3, 1, 'Pilot', '97 years after a nuclear war, human kind is living in space. 100 juvenile delinquents are sent down to Earth to see if the planet is habitable.', 'http://www.youtube.com/embed/ia1Fbg96vL0', '2015-01-20'),
(6, 3, 1, 'Earth Skills', 'Discovering that Jasper may still be alive, Clarke, Bellamy, Finn, Wells and Murphy head out to find him. On the Ark, Abby is determined to prove Earth is habitable, and enlists a mechanic to craft an escape pod.', 'http://www.youtube.com/embed/ia1Fbg96vL0', '2015-01-20'),
(7, 3, 1, 'Murphy\'s Law', 'Bellamy, Clarke and Finn try to protect Charlotte when everyone learns she killed Wells. On the Ark, Abby risks getting floated in order to give Raven the chance to launch the escape pod.', 'http://www.youtube.com/embed/ia1Fbg96vL0', '2015-01-27'),
(8, 3, 3, 'The 48', 'While Clarke struggles to make sense of her bizarre surroundings, Lincoln risks his life to save Octavia, and Kane establishes his authority.', 'http://www.youtube.com/embed/ia1Fbg96vL0', '2015-09-15'),
(9, 3, 3, 'Actes et Conséquences', 'Marcus découvre qu\'Abby a permis à Bellamy et Murphy de s’enfuir et doit à présent la punir pour cela. Octavia approche Indra pour l’aider à retrouver Lincoln, mais cela se retourne contre elle. Clarke trouve un moyen de quitter le Mont Weather, mais doit alors affronter toujours plus d’horreurs.', 'http://www.youtube.com/embed/ia1Fbg96vL0', '2016-06-28'),
(10, 3, 3, 'Les Meilleurs Ennemis ', 'Alors que Clarke et Anya sont en fuite, poursuivies par les hommes armés du Mont Weather, le groupe mené par Bellamy arrive sur le lieu du crash d’une seconde partie de lArche et découvre une survivante. Jaha se réveille dans le désert.', 'http://www.youtube.com/embed/ia1Fbg96vL0', '2016-06-17'),
(11, 3, 3, 'Expérimentations', 'Bellamy et Octavia reviennent au camp, ils y retrouvent Clarke et, ensemble, ils décident de repartir à la recherche de Finn et Murphy. Quand Maya est contaminée par des radiations, Jasper accepte de servir de cobaye.', 'http://www.youtube.com/embed/ia1Fbg96vL0', '2016-07-16'),
(12, 3, 3, 'Le Brouillard de la Guerre', 'Clarke convainc sa mère de retourner au Mont Weather afin de détruire l’antenne qui brouille leurs communications. Marcus et Thelonious sont forcés par les Natifs à faire un choix. De son côté, Jasper fait une découverte qui change tout.', 'http://www.youtube.com/embed/ia1Fbg96vL0', '2016-06-16');

-- --------------------------------------------------------

--
-- Structure de la table `listseason`
--

DROP TABLE IF EXISTS `listseason`;
CREATE TABLE IF NOT EXISTS `listseason` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_serie` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `release_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_serie` (`id_serie`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `listseason`
--

INSERT INTO `listseason` (`id`, `id_serie`, `name`, `release_date`) VALUES
(1, 3, 'Saison 1', '2020-06-24'),
(3, 3, 'Saison 2', '2020-06-24'),
(7, 7, 'Saison 1', '2020-06-16');

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genre_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `release_date` date NOT NULL,
  `summary` longtext NOT NULL,
  `trailer_url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `media_genre_id_fk_genre_id` (`genre_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id`, `genre_id`, `title`, `type`, `status`, `release_date`, `summary`, `trailer_url`) VALUES
(1, 1, 'Mission', 'film', 'ready', '2020-06-23', 'Les membres d\'un commando de la CIA sont envoyés à Prague. Ils ont pour mission d\'appréhender, lors d\'une réception dans l\'ambassade américaine, un espion ennemi qui s\'apprête à dérober une disquette contenant la liste secrète des agents en Europe centrale. Seulement ils ignorent que la CIA, persuadée que le commando est infiltré par une taupe, a envoyé une seconde équipe sur place.', 'http://www.youtube.com/embed/8y5oSx3pB-s'),
(2, 1, 'Top Gun', 'film', 'ready', '2020-06-23', 'Les membres d\'un commando de la CIA sont envoyés à Prague. Ils ont pour mission d\'appréhender, lors d\'une réception dans l\'ambassade américaine, un espion ennemi qui s\'apprête à dérober une disquette contenant la liste secrète des agents en Europe centrale. Seulement ils ignorent que la CIA, persuadée que le commando est infiltré par une taupe, a envoyé une seconde équipe sur place.', 'http://www.youtube.com/embed/g4U4BQW9OEk'),
(3, 3, 'The 100', 'serie', 'ready', '2020-06-24', 'Après une apocalypse nucléaire, les 318 survivants se réfugient dans des stations spatiales et parviennent à y vivre et à se reproduire, atteignant le nombre de 4000 ; 97 ans plus tard, une centaine de jeunes délinquants redescendent sur Terre.', 'http://www.youtube.com/embed/ia1Fbg96vL0'),
(4, 1, 'Edge of Tomorrow', 'film', 'ready', '2014-04-28', 'Dans un futur proche, des hordes d\'extraterrestres ont livré une bataille acharnée contre la Terre et semblent désormais invincibles : aucune armée au monde n\'a réussi à les vaincre. Le commandant William Cage, qui n\'a jamais combattu de sa vie, est envoyé, sans la moindre explication, dans ce qui ressemble à une mission-suicide. Il meurt en l\'espace de quelques minutes et se retrouve projeté dans une boucle temporelle, condamné à revivre le même combat et à mourir de nouveau indéfiniment.', 'https://www.youtube.com/embed/BH0EmXVpCKQ'),
(5, 1, 'Jack Reacher', 'film', 'ready', '2012-12-26', 'Alors qu\'elles se trouvent tranquillement dans un parc, cinq personnes sont froidement abattues par un sniper posté dans un parking leur faisant face. Toutes les pistes mènent à James Barr. Les forces de police appréhendent le suspect numéro un et le placent immédiatement en détention. Alors qu\'il est entendu par les inspecteurs chargés de l\'enquête, Barr n\'avoue rien, mais écrit sur une feuille : \"Trouvez Jack Reacher\"..', 'https://www.youtube.com/embed/ZGFBa7Exr18'),
(6, 1, 'Jack Reacher', 'film', 'ready', '2012-12-26', 'Alors qu\'elles se trouvent tranquillement dans un parc, cinq personnes sont froidement abattues par un sniper posté dans un parking leur faisant face. Toutes les pistes mènent à James Barr. Les forces de police appréhendent le suspect numéro un et le placent immédiatement en détention. Alors qu\'il est entendu par les inspecteurs chargés de l\'enquête, Barr n\'avoue rien, mais écrit sur une feuille : \"Trouvez Jack Reacher\"..', 'https://www.youtube.com/embed/ZGFBa7Exr18'),
(7, 3, 'The 103', 'serie', 'ready', '2020-06-24', 'Après une apocalypse nucléaire, les 318 survivants se réfugient dans des stations spatiales et parviennent à y vivre et à se reproduire, atteignant le nombre de 4000 ; 97 ans plus tard, une centaine de jeunes délinquants redescendent sur Terre.', 'http://www.youtube.com/embed/ia1Fbg96vL0');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `password` varchar(80) NOT NULL,
  `verify` int(1) NOT NULL DEFAULT 0,
  `token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `verify`, `token`) VALUES
(2, 'praaaly@gmail.com', '$2y$12$GfShhQbxF1Ejpr7KEF7V3uOqbJvA.qkf8BFzTW5vsTNgsGFmQ.fRq\r\n\r\n', 1, 'a41bc37769aa660f378d58a181e724106019aff615aeaba1efd102512c7b7b29bbd9f027bd8d29c89d1850d29535a736ffe6');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_media_id_fk_media_id` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `history_user_id_fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `listepisode`
--
ALTER TABLE `listepisode`
  ADD CONSTRAINT `listepisode_ibfk_1` FOREIGN KEY (`id_season`) REFERENCES `listseason` (`id`),
  ADD CONSTRAINT `listepisode_ibfk_2` FOREIGN KEY (`id_serie`) REFERENCES `listseason` (`id_serie`);

--
-- Contraintes pour la table `listseason`
--
ALTER TABLE `listseason`
  ADD CONSTRAINT `listSeason_ibfk_1` FOREIGN KEY (`id_serie`) REFERENCES `media` (`id`);

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_genre_id_b1257088_fk_genre_id` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
