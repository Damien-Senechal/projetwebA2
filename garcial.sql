-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  Dim 13 déc. 2020 à 11:50
-- Version du serveur :  5.5.47-0+deb8u1
-- Version de PHP :  7.2.22-1+0~20190902.26+debian8~1.gbpd64eb7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `garcial`
--

-- --------------------------------------------------------

--
-- Structure de la table `p_commandes`
--

CREATE TABLE `p_commandes` (
  `id_commande` int(10) NOT NULL,
  `id_client` int(10) DEFAULT NULL,
  `prix_commande` double NOT NULL,
  `date_commande` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p_commandes`
--

INSERT INTO `p_commandes` (`id_commande`, `id_client`, `prix_commande`, `date_commande`) VALUES
(5, 2, 10.61, '2020-12-03'),
(6, 3, 10840.51, '2020-10-07'),
(8, 1, 1431.27, '2020-12-12'),
(9, 1, 5.15, '2020-12-12'),
(10, NULL, 1.83, '2020-12-12'),
(11, NULL, 14.82, '2020-12-12'),
(12, 1, 52.53, '2020-12-12'),
(13, 5, 1.83, '2020-12-12'),
(14, 5, 1424.09, '2020-12-12'),
(15, NULL, 147.29, '2020-12-12'),
(16, NULL, 69.69, '2020-12-12'),
(17, NULL, 74.84, '2020-12-13'),
(18, 5, 348.45, '2020-12-13');

-- --------------------------------------------------------

--
-- Structure de la table `p_detail_commandes`
--

CREATE TABLE `p_detail_commandes` (
  `id_detail` int(11) NOT NULL,
  `id_commande` int(24) NOT NULL,
  `id_produit` varchar(10) NOT NULL,
  `quantite_produit_detail` int(64) NOT NULL,
  `prix_detail` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p_detail_commandes`
--

INSERT INTO `p_detail_commandes` (`id_detail`, `id_commande`, `id_produit`, `quantite_produit_detail`, `prix_detail`) VALUES
(1, 6, '10coo2L', 20, 10840),
(2, 6, '03cooDG', 1, 0.51),
(3, 5, '01coo2B', 2, 3.66),
(4, 5, '02cooOG', 1, 4.5),
(5, 5, '05cooCC', 1, 1.94),
(6, 5, '03cooDG', 1, 0.51),
(7, 8, '02cooCT', 3, 209.07),
(8, 8, '06cooCB', 1, 128),
(9, 8, '10coo2L', 2, 1084),
(10, 8, '03cooDG', 20, 10.2),
(11, 8, '15cooCO', 1, 0),
(12, 9, '05cooCC', 1, 5.15),
(16, 10, '01coo2B', 1, 1.83),
(17, 11, '02cooOG', 2, 9),
(18, 11, 'coo07CT', 3, 5.82),
(19, 12, '03cooDG', 103, 52.53),
(20, 13, '01coo2B', 1, 1.83),
(21, 14, '05cooCC', 100, 515),
(22, 14, 'coo08WB', 9, 909.09),
(23, 15, 'coo07CT', 40, 77.6),
(24, 15, '02cooCT', 1, 69.69),
(25, 16, '02cooCT', 1, 69.69),
(26, 17, '02cooCT', 1, 69.69),
(27, 17, '05cooCC', 1, 5.15),
(28, 18, '02cooCT', 5, 348.45);

-- --------------------------------------------------------

--
-- Structure de la table `p_produits`
--

CREATE TABLE `p_produits` (
  `id_produit` varchar(10) NOT NULL,
  `nom_produit` varchar(25) NOT NULL,
  `desc_produit` varchar(2000) NOT NULL,
  `prix_produit` float NOT NULL,
  `stock_produit` int(10) DEFAULT NULL,
  `urlImage_produit` varchar(2500) NOT NULL,
  `categorie_produit` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p_produits`
--

INSERT INTO `p_produits` (`id_produit`, `nom_produit`, `desc_produit`, `prix_produit`, `stock_produit`, `urlImage_produit`, `categorie_produit`) VALUES
('01coo2B', 'Cookie2Baz', 'Premier cookie créé par la société, il est l\'emblème de notre marque avec sa recette secrète.', 1.83, 6390, 'template/img/cookiesMagasin/cookie2Baz.png', 'BestSeller'),
('02cooCT', 'Cookie CT', 'C\'est un cookie qui se bat contre les forces terroristes grâce à son Famas', 69.69, 412, 'template/img/cookiesMagasin/cookieCT.png', ''),
('02cooOG', 'CookieOGalak', 'Deuxième cookie créé par la société, bien meilleur que le premier, car il est au galak', 4.5, 2512, 'template/img/cookiesMagasin/cookieGalak.png', NULL),
('03cooDG', 'CookieDesGeux', 'Quatrième cookie créé par la société, moins bon que tous les autres, car il n\'y a que le beurre...', 0.51, 15377, 'template/img/cookiesMagasin/cookieNul.png', 'pafou'),
('05cooCC', 'CookieOCoca', 'Recette légendaire créé en 1994, le cookie est fait à base de feuille de coca venue directement du Machu Picchu. Interdit sur le marché en 2004, il fut remis au gout du jour en 2010 suites à une modification de sa recette', 5.15, 545, 'template/img/cookiesMagasin/cookieOCoca.png', 'Illégal'),
('06cooCB', 'CookieCubique', '/give @p minecraft:cookie 1', 128, 64, 'template/img/cookiesMagasin/cookieCubique.png', ''),
('10coo2L', 'Cookie2Luxe', 'Cookie réservé au +10, il inspire le luxe et la richesse, avec ce cookie c\'est le bonheur garanti', 542, 4, 'template/img/cookiesMagasin/cookieDeluxe.png', 'Ilésher'),
('15cooCO', 'CookieDesGoûtes', 'En vrai, l\'alcool c\'est du cookie...', 0, 0, 'template/img/cookiesMagasin/2889056bd30bfe051955291390fb4aaa.png', 'H²O'),
('coo07CT', 'CookieCute', 'awwn', 1.94, 506, 'template/img/cookiesMagasin/cookieCute.png', '(ﾉ◕ヮ◕)ﾉ'),
('coo08WB', 'CookieWeb', 'PHPSESSID=aapot', 101.01, 110001, 'template/img/cookiesMagasin/cookieCookie.png', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `p_utilisateurs`
--

CREATE TABLE `p_utilisateurs` (
  `id_utilisateur` int(10) NOT NULL,
  `nom_utilisateur` varchar(25) NOT NULL,
  `prenom_utilisateur` varchar(25) NOT NULL,
  `mail_utilisateur` varchar(64) NOT NULL,
  `mdp_utilisateur` varchar(2000) NOT NULL,
  `adresse_utilisateur` varchar(64) NOT NULL,
  `admin_utilisateur` tinyint(1) DEFAULT NULL,
  `histoire_utilisateur` varchar(2000) DEFAULT NULL,
  `nonce_utilisateur` varchar(33) DEFAULT NULL,
  `ddn_utilisateur` date DEFAULT NULL,
  `urlImage_utilisateur` varchar(2500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `p_utilisateurs`
--

INSERT INTO `p_utilisateurs` (`id_utilisateur`, `nom_utilisateur`, `prenom_utilisateur`, `mail_utilisateur`, `mdp_utilisateur`, `adresse_utilisateur`, `admin_utilisateur`, `histoire_utilisateur`, `nonce_utilisateur`, `ddn_utilisateur`, `urlImage_utilisateur`) VALUES
(1, 'Garcia', 'Loris', 'ouioui@oui.oui', '40773cc8981985976a3d2d7e0a16bb7c191fdc76fa0e28891a41c6b872b5c183', '2 rue du boulevar', 1, 'Chef d\'entreprise et pas toi !', '', '2001-05-28', 'template/img/imagesUtilisateurs/loris.png'),
(2, 'Teuse', 'Ashe', 'ashe.teuse@de.cookie', '51005c8c8704748531bf87e28163b87edbd1c0d1985fe236bf242c8d08236bda', '2 rue du 5 avenue du 3', 0, 'C\'est Ashe Teuse, elle même.', '', '2009-10-27', 'template/img/imagesUtilisateurs/ashe.png'),
(3, 'Corleone', 'Freeze', 'philip@ekip.so', '35f4c1d5cb0a6103d7ff3b31ee02ccf4c5dcd5cfd6aeecbe97819cb31b668d1e', '6 rue de l\'Ekip', 0, 'Sur la ceinture j’ai la gorgone/Dans la cuisine j’ai la technique à Gordon/J’ai oublié 80% de ma scolarité/J’écris comme si j’ai fait la Sorbonne (Donquixote Doflamingo)', '', '1992-06-06', 'template/img/imagesUtilisateurs/freeze.png'),
(4, 'Senechal', 'Damien', 'damien.selechal@yahoo.f', '2aba813e03bff7304e9571f399a78282c3500881cf6b4452389e07b0a021e6ee', '12 rue de l\'avenue, 34090 Montpellier', 1, 'Vous l\'entendez vous?', '', '1998-04-27', 'template/img/imagesUtilisateurs/damien.png'),
(5, 'Abatecola', 'Morgan', 'mrgl.abatepascola@ggle.eu', '1eca983402ccae9fa3616262000b9ae49c0fb055ee3331843bd8363f8126bd6a', '2 rue du boulevar, 34080 Montpellier', 1, 'Jamais il se tait meme quand il parle pas', '', '2001-09-21', 'template/img/imagesUtilisateurs/41ab78124ca8b90b690355f2e1820f62.png'),
(6, 'Umaitor', 'Bob', 'umaitor.bob@apple.arg', '0b56ff88f18f66a496c6d3b79d68a29592b39af3a9401fc0325a9a1aefae931e', '12 impasse du boulevard, 11110 Coursan', 1, 'c\'est bob.il fait 2m7', '', '1620-11-12', 'template/img/imagesUtilisateurs/bob.png'),
(7, 'Moral', 'Telia', 'telia.moral@universite.fr', '4d25fe0a16832b711b5e8a40039eda6c3e315c4a8c32799e101c6cad539183aa', '320 rue du cuisto trop fort', 0, 'Je cuisine trop bien les cookie', '', '2000-02-03', 'template/img/imagesUtilisateurs/8c3a62f666629d84296b474c8d61ebf6.png'),
(8, 'Etlesminimoys', 'Arthurs', 'je.suis.petit@nain.com', '0504184e6876f1a184121a52b419cc8992fab57d43b172c74df1e817ba02805f', '1 petite rue', 0, 'Il est pas très grand', NULL, '2006-11-29', 'template/img/imagesUtilisateurs/ae4ba86a131b231338a9a9e9e43e92dd.png'),
(9, 'Joris', 'Unpeumoulet', 'Joris.Unpeumoulet@gmail.com', 'd48acd11fc97e15d0d687d9c75f53e50445671e03c39ac51e4eeddf90f1c769f', '8 rue a Montpellier', 0, 'Le meilleur  prof (apres clement)', '', '1994-01-01', 'template/img/imagesUtilisateurs/5b533851e321b9dc004c08abdca0704d.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `p_commandes`
--
ALTER TABLE `p_commandes`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `p_detail_commandes`
--
ALTER TABLE `p_detail_commandes`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_cmd_detail-id_cmd_cmd` (`id_commande`),
  ADD KEY `id_produit_detail-id_produit_produit` (`id_produit`);

--
-- Index pour la table `p_produits`
--
ALTER TABLE `p_produits`
  ADD PRIMARY KEY (`id_produit`);

--
-- Index pour la table `p_utilisateurs`
--
ALTER TABLE `p_utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `p_commandes`
--
ALTER TABLE `p_commandes`
  MODIFY `id_commande` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `p_detail_commandes`
--
ALTER TABLE `p_detail_commandes`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `p_utilisateurs`
--
ALTER TABLE `p_utilisateurs`
  MODIFY `id_utilisateur` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `p_commandes`
--
ALTER TABLE `p_commandes`
  ADD CONSTRAINT `c_utilisateur` FOREIGN KEY (`id_client`) REFERENCES `p_utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `p_detail_commandes`
--
ALTER TABLE `p_detail_commandes`
  ADD CONSTRAINT `id_cmd_detail-id_cmd_cmd` FOREIGN KEY (`id_commande`) REFERENCES `p_commandes` (`id_commande`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_produit_detail-id_produit_produit` FOREIGN KEY (`id_produit`) REFERENCES `p_produits` (`id_produit`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
