-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 06 mars 2024 à 14:33
-- Version du serveur : 10.3.39-MariaDB-0+deb10u2
-- Version de PHP : 8.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `burkle_shoes`
--

-- --------------------------------------------------------

--
-- Structure de la table `Article`
--

CREATE TABLE `Article` (
  `id_article` int(11) NOT NULL,
  `nom_article` varchar(100) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `id_marque` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `id_vendeur` int(11) NOT NULL,
  `genre` varchar(30) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Article`
--

INSERT INTO `Article` (`id_article`, `nom_article`, `id_cat`, `id_marque`, `prix`, `id_vendeur`, `genre`, `description`) VALUES
(1, 'NB550', 1, 3, 160, 1, 'Femme', 'Le retour d\'une légende. Portée à l\'origine par les pros, la nouvelle 550 rend hommage au modèle original de 1989 avec ses détails classiques typiques de l\'époque : simples, épurés et fidèles à leur héritage.'),
(2, 'Salomon ACS+', 1, 5, 160, 4, 'Homme', 'Clin d’œil au passé. Hommage à la quintessence des chaussures techniques, l’ACS + est une adaptation moderne d’un modèle mythique, d’une chaussure qui a façonné des années d’expertise en trail running. Une icône du trail running, ancrée dans l’histoire et améliorée grâce à l’Agile Chassis™ System qui accroît la stabilité.\r\n'),
(3, 'Blazer Mid \'77 Jumbo', 1, 1, 110, 2, 'Homme', 'Quand le style vintage fusionne avec l\'énergie du Swoosh ! Nous avons ajouté des ergots aux proportions exagérées, des logos oversize et des coutures premium à vos chaussures de basketball préférées de l\'époque.\r\nVous apprécierez aussi l\'adhérence, la résistance et le style emblématique de la chaussure d\'origine, avec ce modèle tout droit sorti de l\'année 77.'),
(4, 'Pegasus 40', 2, 1, 130, 1, 'Femme', 'La Pegasus 40 offre un excellent mix entre confort, maintien et dynamisme, et convient particulièrement aux coureurs à foulée neutre, de poids intermédiaire, jusqu´à 85 kilos maximum.\r\nLes chaussures offrent une combinaison idéale entre amorti et réactivité, pour courir quelle que soit votre allure, rapide ou lente, et quelles que soient les distances.'),
(5, 'Nike Zoom Fly 5', 2, 1, 170, 4, 'Homme', 'Assurez pendant votre entraînement hebdomadaire et pulvérisez vos records personnels avec une chaussure résistante qui vous accompagne partout, de vos runs quotidiens jusqu\'à la ligne d\'arrivée de votre course préférée.\r\nAssurez pendant votre entraînement hebdomadaire et pulvérisez vos records personnels avec une chaussure résistante qui vous accompagne partout, de vos runs quotidiens jusqu\'à la ligne d\'arrivée de votre course préférée.'),
(6, 'MH500 MID GRIS', 3, 6, 75, 3, 'Homme', 'Nous avons conçu cette chaussure imperméable pour vous qui randonnez régulièrement. Découvrez la montagne en alliant le confort à chacun de vos pas.\r\nRandonnez en confort : le concept EVOFIT qui s\'adapte à votre pied. Randonnez en sécurité : une tige mi-hauteur en cuir, imperméable avec des pare-pierres en caoutchouc et une semelle accrocheuse.'),
(7, 'SALOMON X ULTRA PIONNEER GORETEX MID', 3, 5, 160, 3, 'Homme', 'Inspirée par le succès de notre franchise X ULTRA™, cette chaussure de randonnée mi-montante est la partenaire idéale des passionnés d’outdoor. La X ULTRA™ PIONEER MID CLIMASALOMON™ WATERPROOF réunit toutes les technologies indispensables, dont une protection imperméable, mais reste suffisamment polyvalente pour accompagner vos déplacements quotidiens.'),
(8, 'Vans Yacht Club Old Skool', 4, 4, 80, 4, 'Homme', 'Chaussures de skate classiques signées Vans et premières du genre à arborer la légendaire bande latérale, les Vans Yacht Club Old Skool à lacets arborent une tige basse résistante en toile et en daim.\r\nElles possèdent également un bout renforcé pour résister à l\'usure et un col rembourré conjuguant maintien et flexibilité, sans oublier l\'emblématique semelle extérieure gaufrée en caoutchouc.'),
(9, 'Roses Checkerboard Old Skool Personalisées', 4, 4, 115, 1, 'Femme', 'Vans Customs est une tradition depuis 1966, quand Paul Van Doren a commencé à confectionner des chaussures à partir de tous les tissus et matériaux que les gens lui amenaient à son magasin.\r\nAujourd\'hui, nous avons toujours cette créativité à cœur. Choisis ton modèle, tes couleurs et tes motifs, et crée une paire bien à toi.'),
(10, 'NIKE P-6000', 1, 1, 110, 4, 'Femme', 'Mélangeant des éléments d\'anciennes Pegasus, la Nike P-6000 est faite de mesh respirant et de revêtements horizontaux et verticaux. Son look running tout droit sorti des années 2000 est aussi majestueux qu\'un cheval ailé.\r\nConçue à partir des Nike Pegasus 25 et 2006 pour le côté esthétique, elle t\'assure aussi un confort total pour conquérir la rue.'),
(11, 'Jackal II', 3, 7, 175, 3, 'Homme', 'Chaussure de Mountain Running® destinée aux performances sur des distances ULTRA-LONGUES. Semelle en commun avec Jackal II, amortissante et dotée de la technologie Infinitoo® pour une réduction énergétique.'),
(12, 'Helios III Woman', 2, 7, 150, 3, 'Femme', 'Chaussure “door to trail” conçue pour l\'entraînement et la course sur terrainsdurs off-road.'),
(13, 'Ultra Raptor II Leather Woman GTX', 3, 7, 200, 3, 'Femme', 'Version mid-cut du modèle de trail running Ultra Raptor II, idéale pour le fast hiking et la randonnée avec des charges légères. Imperméable et respirante grâce à la membrane GORE-TEX Extended Comfort.'),
(14, 'Chaussure Samba OG', 1, 2, 120, 1, 'Femme', 'Indémodable modèle imaginé à l\'origine pour le football, la Samba fait son retour dans un coloris épuré.\r\nLa Adidas Samba OG Cloud White affiche une base en cuir pleine fleur blanc accompagnée d\'un mudguard en suède entre le beige et le gris. Des détails dorés comme le \"Samba\" sur le panneau latéral subliment l\'empeigne, tout comme les trois bandes noires accordées au heeltab. Pour conclure le tout, une gumsole prend place sous cette paire.\r\nCette icône du streetwear fera le bonheur des amateurs de son style et sa silhouette rétro.'),
(15, 'Chaussure Adizero Adios Pro 3.0', 2, 2, 250, 1, 'Femme', 'Gagnez en vitesse et en légèreté avec la chaussure adidas adizero adios 7. Elle allie parfaitement dynamisme et confort afin de se rendre incontournable sur les routes et chemins tracés.'),
(16, 'Chaussure Forum Low', 1, 2, 110, 4, 'Femme', 'Plus qu\'une chaussure, c\'est un message. La chaussure adidas Forum a fait son apparition en 1984 et s\'est faite remarquer sur les parquets et dans le monde de la musique.\r\nCette chaussure classique ravive l\'attitude des 80\'s, l\'énergie explosive des parquets et l\'iconique design avec une bride en X à la cheville, dans une version basse conçue pour la rue.'),
(17, 'Phantom and Malachite', 4, 1, 120, 2, 'Homme', 'Ce modèle personnalisable s\'inspire de l\'histoire de Jarritos®️ et de ses célèbres sacs en toile. Ceux-ci servaient à collecter les fruits destinés à aromatiser les boissons.'),
(18, 'Nike SB Zoom Blazer Low Pro GT (WHITE BLACK GUM)', 4, 1, 85, 4, 'Homme', 'Repensée d\'après les observations de Grant Taylor, la Nike SB Zoom Blazer Low Pro GT revisite un modèle plébiscité par la communauté du skate. Cette nouvelle version présente une bande placée plus haut pour plus de résistance.'),
(19, 'Fresh Foam X 1080v12', 2, 3, 190, 3, 'Homme', 'Si nous ne fabriquions qu\'une seule chaussure de running, ce serait la 1080. Ce qui rend la 1080 unique, ce n\'est pas seulement que c\'est la meilleure chaussure de running que nous fabriquons, mais c’est aussi la plus polyvalente.\r\nLa 1080 affiche des performances supérieures à tous les types de coureurs, que vous vous entraîniez pour une compétition d’envergure mondiale ou que vous preniez un train aux heures de pointe.'),
(20, 'Nike BRSB', 4, 1, 85, 1, 'Homme', 'Une silhouette familière fait son retour avec la Nike BRSB. La plupart des détails sont inspirés de la Nike Cortez d\'origine, du style color-block au motif en dents de scie sur la semelle.'),
(21, 'Nike Air Force 1 Lover XX', 1, 1, 130, 2, 'Femme', 'La Nike Air Force 1 Lover XX associe un style sobre et facile à enfiler à une semelle intermédiaire compensée, un intérieur confortable et des perforations irisées.'),
(22, 'Made in USA 990v6', 1, 3, 250, 2, 'Femme', 'Les designers originaux de la 990 devaient créer la meilleure chaussure de running du marché. Le produit fini a dépassé toutes leurs attentes.\r\nEn résumé, la 990 est une chaussure de si grande qualité que nous n\'avons jamais cessé de la fabriquer. Le modèle de dernière génération, le 990v6, présente une version épurée des panneaux en maille et des superpositions en daim, ainsi que les technologies de semelle intermédiaire FuelCell et ENCAP.'),
(23, '840v2', 3, 3, 115, 3, 'Femme', 'La chaussure de marche 840v2 pour hommes revêt le style d\'une sneaker polyvalente adaptée à différentes vitesses et surfaces de marche.\r\nDotée d\'un amorti ABZORB pour absorber les chocs et d\'une semelle extérieure en caoutchouc résistante, cette chaussure de marche pour hommes vous offre la protection et le confort dont vous avez besoin au quotidien.'),
(24, 'Chaussure De Randonnée Terrex AX4 GORE-TEX', 3, 2, 150, 4, 'Homme', 'Partez sur les chemins de randonnée avec la chaussure adidas Terrex AX4 Gore-Tex pour homme et profitez de ses multiples qualités. La semelle intermédiaire en mousse EVA à double densité promet un amorti performant afin d\'assurer votre stabilité. Particulièrement efficace, elle absorbe les chocs pour des foulées fluides.'),
(25, 'Chaussures SK8-HI', 4, 4, 90, 2, 'Femme', 'Lancées en 1978 sous le nom de Style 38, les chaussures Sk8-Hi affichaient notre désormais emblématique Sidestripe sur une silhouette montante inédite et innovante.'),
(26, 'MH100 MID Turquoise', 3, 6, 60, 3, 'Femme', 'La chaussure imperméable faite pour les randonnées occasionnelles en montagne, conçue au pied du Mont Blanc !\r\nOffrez du confort et de la protection à vos pieds, grâce à un amorti sur toute la longueur de la semelle, le maintien de la tige montante et à une membrane imperméable les maintenant au sec.'),
(27, 'XT-WINGS 2', 1, 5, 140, 1, 'Femme', 'Nous avons revisité la version originale de la Wings, qui a fait ses preuves sur les terrains les plus difficiles, en la proposant dans un vaste choix de coloris. Le châssis et la tige sont conçus pour maintenir parfaitement le pied et inspirer confiance sur tous les terrains.'),
(28, 'adidas Originals - Sunshine - Baskets - Jaune', 1, 2, 110, 2, 'Femme', 'La Adidas Sunshine est imprégnée du soleil de la Floride. Il suffit de regarder le daim orange et les 3 bandes jaunes pour s’en rendre compte. Le dessin sur sa languette enfonce le clou. La semelle intérieure de notre sneaker casual rayonne grâce à un imprimé ensoleillé.'),
(29, 'XT-6', 1, 5, 180, 2, 'Homme', 'Lancée pour la première fois en 2013, la XT-6 est la chaussure préférée de plusieurs athlètes de niveau mondial sur les courses d’ultra-distance dans des conditions exécrables. Elle revient désormais avec des coloris et des matériaux revus et améliorés tout en conservant le même niveau d’amorti, de durabilité et de contrôle en descente.'),
(30, 'Geox CARS MCQUEEN', 1, 8, 60, 3, 'Homme', 'Ces baskets basses Geox x Cars présentent une fermeture par scratchs, un tirant d\'enfilage sur le devant, des détails ajourés et des motifs s\'inspirant de l\'univers Cars.');

-- --------------------------------------------------------

--
-- Structure de la table `Categorie`
--

CREATE TABLE `Categorie` (
  `id_cat` int(1) NOT NULL,
  `nom_cat` varchar(30) NOT NULL,
  `description_cat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Categorie`
--

INSERT INTO `Categorie` (`id_cat`, `nom_cat`, `description_cat`) VALUES
(1, 'Sneakers', 'Dérivées des modèles conçus pour le sport, elles sont appréciées pour leur confort et leur style.'),
(2, 'Running', 'Les chaussures de running sont conçues pour absorber les chocs et favoriser le mouvement vers l\'avant, tout en restant légères pour vous permettre de survoler la route ou la piste.'),
(3, 'Randonnée', 'Une chaussure de marche est une chaussure spécialement conçue pour la marche à pied ou la randonnée pédestre. Elle assure de meilleures adhérence et accroche sur le sol qu\'une chaussure de sport.'),
(4, 'Skate', 'Les chaussures de skate ou les chaussures de skateboard sont un type de chaussures spécialement conçues et fabriquées pour être utilisées dans le skateboard.');

-- --------------------------------------------------------

--
-- Structure de la table `Client`
--

CREATE TABLE `Client` (
  `id_client` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `mdp_client` text NOT NULL,
  `email_client` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Client`
--

INSERT INTO `Client` (`id_client`, `username`, `mdp_client`, `email_client`) VALUES
(41, 'invité', '$2y$10$fw8nHoNroM2sc0phMl23AeddqtDMzIm0cjomTecE1snHM.TiNKhe2', 'invite@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `Favoris`
--

CREATE TABLE `Favoris` (
  `id_client` int(11) NOT NULL,
  `id_article` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Favoris`
--

INSERT INTO `Favoris` (`id_client`, `id_article`) VALUES
(41, 1),
(41, 12);

-- --------------------------------------------------------

--
-- Structure de la table `Feedback`
--

CREATE TABLE `Feedback` (
  `id_article` int(11) NOT NULL,
  `note_article` int(11) NOT NULL,
  `com_article` text NOT NULL,
  `id_client` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Image`
--

CREATE TABLE `Image` (
  `id_article` int(11) NOT NULL,
  `lien_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Image`
--

INSERT INTO `Image` (`id_article`, `lien_image`) VALUES
(1, './images/shoes/NB550/nb550-1.webp'),
(1, './images/shoes/NB550/nb550-2.webp'),
(1, './images/shoes/NB550/nb550-3.webp'),
(2, './images/shoes/ACS/ACS-1.webp'),
(2, './images/shoes/ACS/ACS-2.webp'),
(2, './images/shoes/ACS/ACS-3.webp'),
(3, './images/shoes/JUMBO/JUMBO-1.webp'),
(3, './images/shoes/JUMBO/JUMBO-2.webp'),
(3, './images/shoes/JUMBO/JUMBO-3.webp'),
(4, './images/shoes/PEGASUS/PEGASUS-1.webp'),
(4, './images/shoes/PEGASUS/PEGASUS-2.webp'),
(4, './images/shoes/PEGASUS/PEGASUS-3.webp'),
(5, './images/shoes/FLY/FLY-1.webp'),
(5, './images/shoes/FLY/FLY-2.webp'),
(5, './images/shoes/FLY/FLY-3.webp'),
(6, './images/shoes/MH500/MH500-1.webp'),
(6, './images/shoes/MH500/MH500-2.webp'),
(6, './images/shoes/MH500/MH500-3.webp'),
(7, './images/shoes/GORETEX/GORETEX-1.webp'),
(7, './images/shoes/GORETEX/GORETEX-2.webp'),
(7, './images/shoes/GORETEX/GORETEX-3.webp'),
(8, './images/shoes/YACHT/YACHT-1.webp'),
(8, './images/shoes/YACHT/YACHT-2.webp'),
(8, './images/shoes/YACHT/YACHT-3.webp'),
(9, './images/shoes/ROSES/ROSES-1.webp'),
(9, './images/shoes/ROSES/ROSES-2.webp'),
(9, './images/shoes/ROSES/ROSES-3.webp'),
(10, './images/shoes/P6000/P6000-1.webp'),
(10, './images/shoes/P6000/P6000-2.webp'),
(10, './images/shoes/P6000/P6000-3.webp'),
(11, './images/shoes/JACKAL/JACKAL-1.webp'),
(11, './images/shoes/JACKAL/JACKAL-2.webp'),
(11, './images/shoes/JACKAL/JACKAL-3.webp'),
(12, './images/shoes/HELIOS/HELIOS-1.webp'),
(12, './images/shoes/HELIOS/HELIOS-2.webp'),
(12, './images/shoes/HELIOS/HELIOS-3.webp'),
(13, './images/shoes/RAPTOR/RAPTOR-1.webp'),
(13, './images/shoes/RAPTOR/RAPTOR-2.webp'),
(13, './images/shoes/RAPTOR/RAPTOR-3.webp'),
(14, './images/shoes/SAMBA/SAMBA-1.webp'),
(14, './images/shoes/SAMBA/SAMBA-2.webp'),
(14, './images/shoes/SAMBA/SAMBA-3.webp'),
(15, './images/shoes/ADIZERO/ADIZERO-1.webp'),
(15, './images/shoes/ADIZERO/ADIZERO-2.webp'),
(15, './images/shoes/ADIZERO/ADIZERO-3.webp'),
(16, './images/shoes/FORUM/FORUM-1.webp'),
(16, './images/shoes/FORUM/FORUM-2.webp'),
(16, './images/shoes/FORUM/FORUM-3.webp'),
(17, './images/shoes/PHANTOM/PHANTOM-1.webp'),
(17, './images/shoes/PHANTOM/PHANTOM-1.webp'),
(17, './images/shoes/PHANTOM/PHANTOM-1.webp'),
(18, './images/shoes/SBSKATE/SBSKATE-1.webp'),
(18, './images/shoes/SBSKATE/SBSKATE-2.webp'),
(18, './images/shoes/SBSKATE/SBSKATE-3.webp'),
(19, './images/shoes/FOAM/FOAM-1.webp'),
(19, './images/shoes/FOAM/FOAM-2.webp'),
(19, './images/shoes/FOAM/FOAM-3.webp'),
(20, './images/shoes/BRSB/BRSB-1.webp'),
(20, './images/shoes/BRSB/BRSB-2.webp'),
(20, './images/shoes/BRSB/BRSB-3.webp'),
(21, './images/shoes/LOVER/LOVER-1.webp'),
(21, './images/shoes/LOVER/LOVER-2.webp'),
(21, './images/shoes/LOVER/LOVER-3.webp'),
(22, './images/shoes/USA/USA-1.webp'),
(22, './images/shoes/USA/USA-2.webp'),
(22, './images/shoes/USA/USA-3.webp'),
(23, './images/shoes/840/840-1.webp'),
(23, './images/shoes/840/840-2.webp'),
(23, './images/shoes/840/840-3.webp'),
(24, './images/shoes/TERREX/TERREX-1.webp'),
(24, './images/shoes/TERREX/TERREX-2.webp'),
(24, './images/shoes/TERREX/TERREX-3.webp'),
(25, './images/shoes/SK8/SK8-1.webp'),
(25, './images/shoes/SK8/SK8-2.webp'),
(25, './images/shoes/SK8/SK8-3.webp'),
(26, './images/shoes/MH100/MH100-1.webp'),
(26, './images/shoes/MH100/MH100-2.webp'),
(26, './images/shoes/MH100/MH100-3.webp'),
(27, './images/shoes/WINGS/WINGS-1.webp'),
(27, './images/shoes/WINGS/WINGS-2.webp'),
(27, './images/shoes/WINGS/WINGS-3.webp'),
(28, './images/shoes/SUNSHINE/SUNSHINE-1.webp'),
(28, './images/shoes/SUNSHINE/SUNSHINE-2.webp'),
(28, './images/shoes/SUNSHINE/SUNSHINE-3.webp'),
(29, './images/shoes/XT6/XT6-1.webp'),
(29, './images/shoes/XT6/XT6-2.webp'),
(29, './images/shoes/XT6/XT6-3.webp'),
(30, './images/shoes/CARS/CARS-1.webp'),
(30, './images/shoes/CARS/CARS-2.webp'),
(30, './images/shoes/CARS/CARS-3.webp');

-- --------------------------------------------------------

--
-- Structure de la table `Marques`
--

CREATE TABLE `Marques` (
  `id_marque` int(11) NOT NULL,
  `nom_marque` varchar(30) NOT NULL,
  `description_marque` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Marques`
--

INSERT INTO `Marques` (`id_marque`, `nom_marque`, `description_marque`) VALUES
(1, 'Nike', 'Chaîne de magasins proposant des chaussures, vêtements et accessoires de sport Nike.'),
(2, 'Adidas', 'Adidas est une firme allemande fondée en 1949 par Adolf Dassler, spécialisée dans la fabrication d\'articles de sport, basée à Herzogenaurach en Allemagne. Elle est mondialement connue sous l\'appellation « la marque aux trois bandes », des trois bandes parallèles qui constituent son logo.'),
(3, 'New Balance', 'New Balance Athletics est un équipementier sportif américain.'),
(4, 'Vans', 'Magasin de détail proposant les chaussures et les vêtements décontractés de la marque, inspirés du surf et du skateboard.'),
(5, 'Salomon', 'L\'entreprise Salomon, fondée en 1947 à Annecy en Haute-Savoie, est une marque spécialisée dans les articles de sports et de loisirs. Elle est distribuée dans plus de 160 pays.'),
(6, 'Quechua', 'Quechua est une marque de produits pour la pratique de la randonnée nature et en montagne. Créée en 1997, cette entreprise est localisée à Passy en Haute-Savoie et compte environ 200 employés.'),
(7, 'La Sportiva', 'Articles techniques et écologiques pour la randonnée, l\'escalade et la course à pied.'),
(8, 'Geox', 'Geox est une entreprise italienne de chaussures et de prêt-à-porter située à Montebelluna dans la province de Trévise.');

-- --------------------------------------------------------

--
-- Structure de la table `Vendeur`
--

CREATE TABLE `Vendeur` (
  `id_vendeur` int(11) NOT NULL,
  `nom_vendeur` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Vendeur`
--

INSERT INTO `Vendeur` (`id_vendeur`, `nom_vendeur`) VALUES
(1, 'Courir'),
(2, 'Wethenew'),
(3, 'Décathlon'),
(4, 'Footlocker');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Article`
--
ALTER TABLE `Article`
  ADD PRIMARY KEY (`id_article`),
  ADD KEY `id_cat` (`id_cat`),
  ADD KEY `id_marque` (`id_marque`,`id_vendeur`),
  ADD KEY `id_vendeur` (`id_vendeur`);

--
-- Index pour la table `Categorie`
--
ALTER TABLE `Categorie`
  ADD UNIQUE KEY `id_cat` (`id_cat`);

--
-- Index pour la table `Client`
--
ALTER TABLE `Client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `Favoris`
--
ALTER TABLE `Favoris`
  ADD KEY `id_client` (`id_client`,`id_article`),
  ADD KEY `id_article` (`id_article`);

--
-- Index pour la table `Feedback`
--
ALTER TABLE `Feedback`
  ADD KEY `id_article` (`id_article`),
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `Image`
--
ALTER TABLE `Image`
  ADD KEY `id_article` (`id_article`);

--
-- Index pour la table `Marques`
--
ALTER TABLE `Marques`
  ADD PRIMARY KEY (`id_marque`);

--
-- Index pour la table `Vendeur`
--
ALTER TABLE `Vendeur`
  ADD PRIMARY KEY (`id_vendeur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Article`
--
ALTER TABLE `Article`
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `Categorie`
--
ALTER TABLE `Categorie`
  MODIFY `id_cat` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `Client`
--
ALTER TABLE `Client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `Marques`
--
ALTER TABLE `Marques`
  MODIFY `id_marque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `Vendeur`
--
ALTER TABLE `Vendeur`
  MODIFY `id_vendeur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Article`
--
ALTER TABLE `Article`
  ADD CONSTRAINT `Article_ibfk_1` FOREIGN KEY (`id_marque`) REFERENCES `Marques` (`id_marque`),
  ADD CONSTRAINT `Article_ibfk_2` FOREIGN KEY (`id_cat`) REFERENCES `Categorie` (`id_cat`),
  ADD CONSTRAINT `Article_ibfk_4` FOREIGN KEY (`id_vendeur`) REFERENCES `Vendeur` (`id_vendeur`);

--
-- Contraintes pour la table `Favoris`
--
ALTER TABLE `Favoris`
  ADD CONSTRAINT `Favoris_ibfk_2` FOREIGN KEY (`id_article`) REFERENCES `Article` (`id_article`),
  ADD CONSTRAINT `Favoris_ibfk_3` FOREIGN KEY (`id_client`) REFERENCES `Client` (`id_client`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Feedback`
--
ALTER TABLE `Feedback`
  ADD CONSTRAINT `Feedback_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `Article` (`id_article`),
  ADD CONSTRAINT `Feedback_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `Client` (`id_client`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Image`
--
ALTER TABLE `Image`
  ADD CONSTRAINT `Image_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `Article` (`id_article`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
