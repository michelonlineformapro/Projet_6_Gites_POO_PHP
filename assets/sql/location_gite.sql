-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 18 avr. 2022 à 10:41
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `location_gite`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateurs`
--

DROP TABLE IF EXISTS `administrateurs`;
CREATE TABLE IF NOT EXISTS `administrateurs` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `email_admin` varchar(255) NOT NULL,
  `password_admin` varchar(255) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `administrateurs`
--

INSERT INTO `administrateurs` (`id_admin`, `email_admin`, `password_admin`) VALUES
(1, 'admin@admin.com', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `type_gite` varchar(250) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `type_gite`) VALUES
(1, 'Maison'),
(2, 'Villa'),
(3, 'Appartement'),
(4, 'Chalet'),
(5, 'Camping'),
(6, 'Hotel'),
(7, 'Igloo'),
(8, 'Yourt'),
(9, 'Cabane bois'),
(10, 'Tente');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id_commentaire` int(11) NOT NULL AUTO_INCREMENT,
  `auteur_commentaire` varchar(255) NOT NULL,
  `contenus_commentaire` text NOT NULL,
  `gite_id` int(11) NOT NULL,
  PRIMARY KEY (`id_commentaire`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id_commentaire`, `auteur_commentaire`, `contenus_commentaire`, `gite_id`) VALUES
(1, 'Michael25', 'Ce gite est trés sympa dans un cade bucolique et le proprio est cool', 1),
(2, 'Sophie38', 'Ce gite est trés sympa dans un cade bucolique et le proprio est cool mais dans cette région il fait trés froid', 2),
(3, 'Laurent45', 'Super gite mais beaucoup de chien qui hurle la nuit', 3),
(4, 'Laurent45', 'Super gite mais beaucoup de chien qui hurle la nuit', 4),
(5, 'Marie84', 'Tres cool mais attention a la neige sur votre voiture au petit matin c galère', 5),
(7, 'Test', 'vous permettant de cuisiner en libre accès. Salon commun accessible à tous les hôtes avec cheminée à l\'ancienne, Tv, bibliothèque. Internet wifi. ', 1),
(8, 'Lolo7845', 'Super gites trés cool avec un espace jeux pour les enfants c vraiment trés cool', 2),
(9, 'Tito45', 'Ce gite est trés sympa dans un cade bucolique et le proprio est cool mais dans cette région il fait trés froid', 4),
(10, 'Re TITO par id', 'Ce gite est trés sympa dans un cade bucolique et le proprio est cool mais dans cette région il fait trés froid', 5),
(11, 'tito@test.fr', 'Ce gite est degeulasse plein de crotte de rats et un odeur bizare', 2),
(13, 'tito@test.fr', 'cool ce gite', 6),
(14, 'tito@test.fr', 'a c le test des commentaires', 7),
(15, 'tito@test.fr', 'yoyo cool alsace', 9),
(16, 'tito@test.fr', 'Test d\'ajout de commentaire', 9);

-- --------------------------------------------------------

--
-- Structure de la table `gites`
--

DROP TABLE IF EXISTS `gites`;
CREATE TABLE IF NOT EXISTS `gites` (
  `id_gite` int(11) NOT NULL AUTO_INCREMENT,
  `nom_gite` varchar(250) NOT NULL,
  `description_gite` text NOT NULL,
  `img_gite` varchar(255) NOT NULL,
  `prix_gite` float NOT NULL,
  `nbr_chambre` int(11) NOT NULL,
  `nbr_sdb` int(11) NOT NULL,
  `disponible` tinyint(1) NOT NULL,
  `zone_geo` int(11) NOT NULL,
  `date_arrivee` datetime NOT NULL,
  `date_depart` datetime DEFAULT NULL,
  `gite_categorie` int(11) NOT NULL,
  `commentaire_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_gite`),
  KEY `gite_category` (`gite_categorie`),
  KEY `Indes des commentaires` (`commentaire_id`),
  KEY `zone_geo` (`zone_geo`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `gites`
--

INSERT INTO `gites` (`id_gite`, `nom_gite`, `description_gite`, `img_gite`, `prix_gite`, `nbr_chambre`, `nbr_sdb`, `disponible`, `zone_geo`, `date_arrivee`, `date_depart`, `gite_categorie`, `commentaire_id`) VALUES
(1, 'Gite de la Drome', 'Julien vous accueille au chalet l\'Aiglon à Saint-Gervais, dans l\'ambiance cosy et chaleureuse de ce vaste chalet rénové et décoré \'à la savoyarde\'.\r\nA votre disposition, 5 chambres (2 à 4 personnes), avec sanitaires privatifs pour chaque chambre (douche, lavabo, wc). Grande salle vitrée au rez-de-chaussée pour le petit-déjeuner. A votre disposition: cuisine équipée (four, m-ondes) vous permettant de cuisiner en libre accès. Salon commun accessible à tous les hôtes avec cheminée à l\'ancienne, Tv, bibliothèque. Internet wifi. ', 'assets/img/236603_440_791.jpg', 123.25, 1, 1, 1, 1, '2021-03-18 00:00:00', '2021-06-18 00:00:00', 1, 2),
(3, 'Gite de Chartreuse', 'A proximité de tous commerces et services, au cœur du village, Sabrina et Thierry vous accueillent dans leur Chalet de standing à l\'atmosphère familiale et chaleureuse. Prestations de très grande qualité pour ces 3 chambres spacieuses et confortables de 2 à 4 personnes, soigneusement aménagées dans un esprit montagne. Dans chaque chambre: salle de bains privative (douche et/ou baignoire), TV, internet wifi et balcon ou terrasse privatif.', 'assets/img/280605_440_791.jpg', 154.25, 3, 3, 1, 2, '2021-03-31 00:00:00', '2021-10-23 00:00:00', 4, 1),
(5, 'Gite Haute-Alsace', 'L’incontournable Route des Vins d’Alsace qui déroule son itinéraire à travers le vignoble sur 170km du nord au sud de la région. Venez déguster nos vins blancs : Sylvaner, Pinot blanc, Riesling, Muscat, Pinot gris, Gewurztraminer, soit 51 Grands Crus pour les amateurs de viticulture. Visitez les villages traditionnels comme Saint-Hippolyte, village reconnu pour son vin rouge, Ribeauvillé avec sa fête des Ménétriers et autres petits villages comme Riquewihr ou Kaysersberg , reconnus pour leurs marchés de Noël. Vous pourrez prolonger votre expérience au cœur des rites, coutumes et légendes de la région au cours d’une journée immersive à l’Écomusée d’Alsace.', 'assets/img/12.jpg', 452.25, 2, 3, 1, 3, '2022-03-02 00:00:00', '2022-03-18 00:00:00', 7, 3),
(6, 'Gite d\'Alsace', 'Strasbourg capitale européenne vous prouvera à quel point tradition et modernité peuvent cohabiter. Célèbre pour son marché de Noël, son quartier historique de la Petite France, venez flâner dans le quartier de la Neustadt, classée au patrimoine mondial de l’UNESCO et arrêtez-vous devant l’imposante Cathédrale.\r\nPuis direction Obernai, le Mont Sainte-Odile où vous alternerez balade à VTT et randonnées. Les spectacles de la volerie des aigles ou la Montagne des singes vous attendent au pied de l’imposant Château du Haut-Koenigsbourg. Retracez l’histoire de l’Alsace et de la Moselle de 1870 jusqu’à la réconciliation franco-allemande et la construction Européenne en visitant le Mémorial d’Alsace Lorraine.', 'assets/img/143651_440_791.jpg', 758.25, 5, 2, 1, 4, '2021-03-31 00:00:00', '2021-06-18 00:00:00', 5, 4),
(7, 'Gite Isère', 'Julien vous accueille au chalet l\'Aiglon à Saint-Gervais, dans l\'ambiance cosy et chaleureuse de ce vaste chalet rénové et décoré \'à la savoyarde\'.\r\nA votre disposition, 5 chambres (2 à 4 personnes), avec sanitaires privatifs pour chaque chambre (douche, lavabo, wc). Grande salle vitrée au rez-de-chaussée pour le petit-déjeuner. A votre disposition: cuisine équipée (four, m-ondes) vous permettant de cuisiner en libre accès. Salon commun accessible à tous les hôtes avec cheminée à l\'ancienne, Tv, bibliothèque. Internet wifi. ', 'assets/img/236603_440_791.jpg', 123.25, 1, 1, 1, 5, '2021-04-22 00:00:00', '2021-07-17 00:00:00', 1, 5),
(8, 'Gite du Lot', 'A proximité de tous commerces et services, au cœur du village, Sabrina et Thierry vous accueillent dans leur Chalet de standing à l\'atmosphère familiale et chaleureuse. Prestations de très grande qualité pour ces 3 chambres spacieuses et confortables de 2 à 4 personnes, soigneusement aménagées dans un esprit montagne. Dans chaque chambre: salle de bains privative (douche et/ou baignoire), TV, internet wifi et balcon ou terrasse privatif.', 'assets/img/280605_440_791.jpg', 454.25, 3, 3, 1, 6, '2021-03-31 00:00:00', '2022-02-18 00:00:00', 4, 1),
(9, 'Gite Loire', 'L’incontournable Route des Vins d’Alsace qui déroule son itinéraire à travers le vignoble sur 170km du nord au sud de la région. Venez déguster nos vins blancs : Sylvaner, Pinot blanc, Riesling, Muscat, Pinot gris, Gewurztraminer, soit 51 Grands Crus pour les amateurs de viticulture. Visitez les villages traditionnels comme Saint-Hippolyte, village reconnu pour son vin rouge, Ribeauvillé avec sa fête des Ménétriers et autres petits villages comme Riquewihr ou Kaysersberg , reconnus pour leurs marchés de Noël. Vous pourrez prolonger votre expérience au cœur des rites, coutumes et légendes de la région au cours d’une journée immersive à l’Écomusée d’Alsace.', 'assets/img/58360_780019_29.jpg', 784.25, 4, 3, 1, 7, '2022-03-29 00:00:00', '2022-03-30 00:00:00', 8, 2),
(10, 'Gite PACA', 'Strasbourg capitale européenne vous prouvera à quel point tradition et modernité peuvent cohabiter. Célèbre pour son marché de Noël, son quartier historique de la Petite France, venez flâner dans le quartier de la Neustadt, classée au patrimoine mondial de l’UNESCO et arrêtez-vous devant l’imposante Cathédrale.\r\nPuis direction Obernai, le Mont Sainte-Odile où vous alternerez balade à VTT et randonnées. Les spectacles de la volerie des aigles ou la Montagne des singes vous attendent au pied de l’imposant Château du Haut-Koenigsbourg. Retracez l’histoire de l’Alsace et de la Moselle de 1870 jusqu’à la réconciliation franco-allemande et la construction Européenne en visitant le Mémorial d’Alsace Lorraine.', 'assets/img/143651_440_791.jpg', 758.25, 5, 2, 1, 8, '2021-04-20 00:00:00', '2022-04-22 19:53:03', 5, 3),
(11, 'Gite Var', 'Julien vous accueille au chalet l\'Aiglon à Saint-Gervais, dans l\'ambiance cosy et chaleureuse de ce vaste chalet rénové et décoré \'à la savoyarde\'.\r\nA votre disposition, 5 chambres (2 à 4 personnes), avec sanitaires privatifs pour chaque chambre (douche, lavabo, wc). Grande salle vitrée au rez-de-chaussée pour le petit-déjeuner. A votre disposition: cuisine équipée (four, m-ondes) vous permettant de cuisiner en libre accès. Salon commun accessible à tous les hôtes avec cheminée à l\'ancienne, Tv, bibliothèque. Internet wifi. ', 'assets/img/236603_440_791.jpg', 153.25, 1, 1, 1, 9, '2021-04-20 00:00:00', '2021-07-16 00:00:00', 1, 4),
(12, 'Gite du Cheval', 'A proximité de tous commerces et services, au cœur du village, Sabrina et Thierry vous accueillent dans leur Chalet de standing à l\'atmosphère familiale et chaleureuse. Prestations de très grande qualité pour ces 3 chambres spacieuses et confortables de 2 à 4 personnes, soigneusement aménagées dans un esprit montagne. Dans chaque chambre: salle de bains privative (douche et/ou baignoire), TV, internet wifi et balcon ou terrasse privatif.', 'assets/img/280605_440_791.jpg', 414.25, 3, 3, 1, 10, '2021-03-31 00:00:00', '2022-04-14 00:00:00', 4, 1),
(13, 'Gite du Chien', 'L’incontournable Route des Vins d’Alsace qui déroule son itinéraire à travers le vignoble sur 170km du nord au sud de la région. Venez déguster nos vins blancs : Sylvaner, Pinot blanc, Riesling, Muscat, Pinot gris, Gewurztraminer, soit 51 Grands Crus pour les amateurs de viticulture. Visitez les villages traditionnels comme Saint-Hippolyte, village reconnu pour son vin rouge, Ribeauvillé avec sa fête des Ménétriers et autres petits villages comme Riquewihr ou Kaysersberg , reconnus pour leurs marchés de Noël. Vous pourrez prolonger votre expérience au cœur des rites, coutumes et légendes de la région au cours d’une journée immersive à l’Écomusée d’Alsace.', 'assets/img/63154_914267_14.jpg', 741.25, 2, 3, 1, 11, '2022-03-28 00:00:00', '2022-03-30 00:00:00', 6, 5),
(14, 'Gite OURS', 'Strasbourg capitale européenne vous prouvera à quel point tradition et modernité peuvent cohabiter. Célèbre pour son marché de Noël, son quartier historique de la Petite France, venez flâner dans le quartier de la Neustadt, classée au patrimoine mondial de l’UNESCO et arrêtez-vous devant l’imposante Cathédrale.\r\nPuis direction Obernai, le Mont Sainte-Odile où vous alternerez balade à VTT et randonnées. Les spectacles de la volerie des aigles ou la Montagne des singes vous attendent au pied de l’imposant Château du Haut-Koenigsbourg. Retracez l’histoire de l’Alsace et de la Moselle de 1870 jusqu’à la réconciliation franco-allemande et la construction Européenne en visitant le Mémorial d’Alsace Lorraine.', 'assets/img/143651_440_791.jpg', 458.25, 5, 2, 1, 2, '2021-05-11 00:00:00', '2022-06-11 00:00:00', 5, 1),
(15, 'Gite Annecy', 'Aux portes du Chamonix (10 minutes en voiture), dans un hameau calme de montagne, gite de 35m2 d\'accès indépendant aménagé au 1er étage d\'un chalet de construction récente, mitoyen de l\'habitation des propriétaires. Pièce à vivre avec coin cuisine, espace détente ( canapé ), chambre (1 lit 140cm), salle de bains / wc. Chauffage central. ', 'assets/img/gite.jpg', 125.25, 4, 3, 1, 3, '2021-04-01 00:00:00', '2030-06-11 00:00:00', 4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `regions`
--

DROP TABLE IF EXISTS `regions`;
CREATE TABLE IF NOT EXISTS `regions` (
  `id_region` int(10) NOT NULL AUTO_INCREMENT,
  `nom_region` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_region`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `regions`
--

INSERT INTO `regions` (`id_region`, `nom_region`, `slug`) VALUES
(1, 'Guadeloupe', 'guadeloupe'),
(2, 'Martinique', 'martinique'),
(3, 'Guyane', 'guyane'),
(4, 'La Réunion', 'la reunion'),
(5, 'Mayotte', 'mayotte'),
(6, 'Île-de-France', 'ile de france'),
(7, 'Centre-Val de Loire', 'centre val de loire'),
(8, 'Bourgogne-Franche-Comté', 'bourgogne franche comte'),
(9, 'Normandie', 'normandie'),
(10, 'Hauts-de-France', 'hauts de france'),
(11, 'Grand Est', 'grand est'),
(12, 'Pays de la Loire', 'pays de la loire'),
(13, 'Bretagne', 'bretagne'),
(14, 'Nouvelle-Aquitaine', 'nouvelle aquitaine'),
(15, 'Occitanie', 'occitanie'),
(16, 'Auvergne-Rhône-Alpes', 'auvergne rhone alpes'),
(17, 'Provence-Alpes-Côte d\'Azur', 'provence alpes cote dazur'),
(18, 'Corse', 'corse'),
(19, 'Collectivités d\'Outre-Mer', 'collectivites doutre mer');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `email`, `password`) VALUES
(1, 'tito@test.fr', 'test'),
(2, 'micpiwo@hotmail.fr', 'Sladpowa38'),
(10, 'test@test.com', 'test'),
(11, 'robert@cool.fr', 'azerty'),
(18, 'michel@michel.com', 'azertyui'),
(21, 'francois@laposte.net', 'zzzzzzzz'),
(22, 'admin@games.com', 'administration'),
(23, 'admin@admin.com', 'administration'),
(24, 'robert@test.fr', 'azerty'),
(25, 'joe@gotmail.fr', '123'),
(26, 'bob@laposte.net', '123');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `gites`
--
ALTER TABLE `gites`
  ADD CONSTRAINT `gites_ibfk_1` FOREIGN KEY (`gite_categorie`) REFERENCES `categories` (`id_categorie`),
  ADD CONSTRAINT `gites_ibfk_2` FOREIGN KEY (`commentaire_id`) REFERENCES `commentaires` (`id_commentaire`),
  ADD CONSTRAINT `gites_ibfk_3` FOREIGN KEY (`zone_geo`) REFERENCES `regions` (`id_region`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
