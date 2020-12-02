-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 02 déc. 2020 à 13:13
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
-- Base de données : `ecommerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `p_commandes`
--

DROP TABLE IF EXISTS `p_commandes`;
CREATE TABLE IF NOT EXISTS `p_commandes` (
  `id_commade` int(10) NOT NULL AUTO_INCREMENT,
  `id_client` int(10) NOT NULL,
  `id_produit` varchar(25) NOT NULL,
  `quantite_commande` int(25) NOT NULL,
  `prix_commande` double NOT NULL,
  PRIMARY KEY (`id_commade`),
  KEY `id_client` (`id_client`),
  KEY `id_produit` (`id_produit`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p_commandes`
--

INSERT INTO `p_commandes` (`id_commade`, `id_client`, `id_produit`, `quantite_commande`, `prix_commande`) VALUES
(1, 2345, '01coo2B', 12, 21.96),
(2, 1234, '05cooCC', 48, 247.2),
(3, 789, '10coo2L', 1, 315.99),
(4, 25864, '03cooDG', 26, 13.26);

-- --------------------------------------------------------

--
-- Structure de la table `p_produits`
--

DROP TABLE IF EXISTS `p_produits`;
CREATE TABLE IF NOT EXISTS `p_produits` (
  `id_produit` varchar(10) NOT NULL,
  `nom_produit` varchar(25) NOT NULL,
  `desc_produit` varchar(2000) NOT NULL,
  `prix_produit` float NOT NULL,
  `stock_produit` int(10) DEFAULT NULL,
  `urlImage_produit` varchar(250) NOT NULL,
  PRIMARY KEY (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p_produits`
--

INSERT INTO `p_produits` (`id_produit`, `nom_produit`, `desc_produit`, `prix_produit`, `stock_produit`, `urlImage_produit`) VALUES
('01coo2B', 'Cookie2Baz', 'Premier cookie créé par la société, il est l\'emblème de notre marque avec sa recette secrette.', 1.83, 6394, '../template/img/cookiesMagasin/cookie2Baz.png'),
('02cooOG', 'CookieOGalak', 'Deuxième cookie créé par la société, bien meilleur que le premier, car il est au galak', 4.5, 2514, '../template/img/cookiesMagasin/cookieGalac.png'),
('03cooDG', 'CookieDesGeux', 'Quatrième cookie créé par la société, moins bon que tous les autres, car il n\'y a que le beurre...', 0.51, 15480, '../template/img/cookiesMagasin/cookieNul.png'),
('05cooCC', 'CookieCoca', 'Recette légendaire créé en 1994, le cookie est fait a base de feuille de coca venue directement du matchupitchu. Interdit sur le marché en 2004, il fut remit au gout du jour en 2010 suite a une modification de sa recette', 5.15, 650, '../template/img/cookiesMagasin/cookieOCoca.png'),
('06cooCB', 'CookieCubique', '/give @a Minecraft:cookie', 128, 64, '../template/img/cookiesMagasin/cookieCubique.png'),
('10coo2L', 'Cookie2Luxe', 'Cookie reservé au +10, il inspire le luxe et la richesse, avec ce cookie c\'est le bonheur garantie', 315.99, 8, '../template/img/cookiesMagasin/cookieDeluxe.png'),
('coo07CT', 'CookieCute', 'awwn', 1.94, 245, '../template/img/cookiesMagasin/cookieCute.png'),
('coo08WB', 'CookieWeb', 'PHPSESSID=aapot', 101.01, 110010110, '../template/img/cookiesMagasin/cookieCookie.png');

-- --------------------------------------------------------

--
-- Structure de la table `p_utilisateurs`
--

DROP TABLE IF EXISTS `p_utilisateurs`;
CREATE TABLE IF NOT EXISTS `p_utilisateurs` (
  `id_utilisateur` int(10) NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(25) NOT NULL,
  `prenom_utilisateur` varchar(25) NOT NULL,
  `mail_utilisateur` varchar(64) NOT NULL,
  `mdp_utilisateur` varchar(10) NOT NULL,
  `adresse_utilisateur` varchar(64) NOT NULL,
  `ddn_utilisateur` date NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=25865 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p_utilisateurs`
--

INSERT INTO `p_utilisateurs` (`id_utilisateur`, `nom_utilisateur`, `prenom_utilisateur`, `mail_utilisateur`, `mdp_utilisateur`, `adresse_utilisateur`, `ddn_utilisateur`) VALUES
(789, 'Garcia', 'Loris', 'loris.garcia@microsoft.com', 'mdt8', '46 boulevar du chemin, 34071 Montpellier', '2001-05-31'),
(1234, 'Senechal', 'Damien', 'damien.selechal@yahoo.f', 'mdt1', '12 rue de l\'avenue, 34090 Montpellier', '2000-03-28'),
(2345, 'Abatecola', 'Margoul', 'margoul.abatepascola@google.eu', 'mdt2', '2 rue du boulevar, 34080 Montpellier', '2001-09-21'),
(25864, 'Umaitor', 'bob', 'umaitor.bob@apple.arg', 'gpasdide', '12 impasse du boulevard, 11110 Coursan', '1998-03-11');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `p_commandes`
--
ALTER TABLE `p_commandes`
  ADD CONSTRAINT `c_produit` FOREIGN KEY (`id_produit`) REFERENCES `p_produits` (`id_produit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `c_utilisateur` FOREIGN KEY (`id_client`) REFERENCES `p_utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
