-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: wikisports
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.25-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `url_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_23A0E6612469DE2` (`category_id`),
  KEY `IDX_23A0E66A76ED395` (`user_id`),
  CONSTRAINT `FK_23A0E6612469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_23A0E66A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (1,1,'Tennis','Le tennis est un sport de raquette qui oppose soit deux joueurs soit quatre joueurs qui forment deux équipes de deux. Les joueurs utilisent une raquette cordée verticalement et horizontalement à une tension variant avec la puissance ou l\'effet que l\'on veut obtenir','2022-12-14 11:19:38','2022-12-14 11:19:38','https://i.eurosport.com/2022/12/11/3506855-71484268-2560-1440.jpg',1),(2,1,'Le badminton','Le badminton est un sport de raquette nommé d\'après un château anglais. Il oppose soit deux joueurs, en simple, soit deux paires, en double et en mixte, placés de part et d\'autre d\'un filet. Les joueurs frappent un volant avec une raquette, le contact du volant avec le corps d\'un joueur étant une faute.','2022-12-14 11:20:15','2022-12-14 11:20:15','https://ville-data.com/loisirs-sports/image/badminton-squash-ping-pong.jpg',2),(3,1,'Tennis de table','Le tennis de table, appelé aussi ping-pong, est un sport de raquette opposant deux ou quatre joueurs autour d\'une table. Le tennis de table est une activité de loisir, mais c\'est également un sport olympique depuis 1988.','2022-12-14 11:20:53','2022-12-14 11:20:53','https://upload.wikimedia.org/wikipedia/commons/thumb/b/be/Table_tennis_Rio_2007.jpg/220px-Table_tennis_Rio_2007.jpg',2),(4,2,'Le surf','Le surf (abréviation française de l\'anglais surf-riding, où riding signifie « monter » et surf « (vagues) déferlantes ») est une pratique physique individuelle de glisse sur les vagues, au bord de l\'océan.\r\n\r\nPartie intégrante de la culture hawaïenne traditionnelle, le surf a été popularisé dans le monde par le double champion olympique (1912 et 1920) du 100 m nage libre Duke Kahanamoku dans les premières décennies du XXe siècle, avant de devenir, à la fin du même siècle, une discipline sportive codifiée, pratiquée debout sur une planche courte (shortboard), par opposition aux autres disciplines de glisse sur les vagues comme le longboard, le bodyboard, le bodysurf, le skimboard, le stand up paddle, le windsurf1.','2022-12-14 11:21:58','2022-12-14 11:21:58','https://media.gqmagazine.fr/photos/5b99214421de720011927ba8/16:9/w_2580,c_limit/le_surf_pour_les_nuls_3307.jpg',1),(5,2,'La pêche','La pêche est l\'activité consistant à capturer des animaux aquatiques (poissons, crustacés, céphalopodes, etc.) dans leur biotope (océans, mers, cours d\'eau, étangs, lacs, mares). Elle est pratiquée par les pêcheurs, comme loisir (pêche récréative ou pêche sportive), profession (pêche commerciale) ou pour assurer une autosuffisance alimentaire (pêche de subsistance). Les techniques et engins de pêche sont nombreux, dépendant de l\'espèce recherchée, du milieu, ou encore du bateau ou de l\'outil utilisé. Pêche à pied, pêche sous-marine, pêche au bord de mer ou en mer, ces activités sont le plus souvent encadrées par une réglementation qui tend à se renforcer afin de protéger au mieux la biodiversité1, l\'environnement et les ressources halieutiques (terme qui désigne la connaissance de la biologie et de l\'exploitation des ressources de la pêche).','2022-12-14 11:24:35','2022-12-14 11:24:35','https://www.ma-canne-a-peche.fr/wp-content/uploads/2017/06/materiel-peche-sportive-810x360.jpg',2),(6,2,'L\'aviron','L\'aviron fait partie de la famille des sports nautiques. C\'est un sport olympique depuis la création des Jeux olympiques modernes en 1896 sous l\'impulsion du baron Pierre de Coubertin.','2022-12-14 11:25:17','2022-12-14 11:25:17','https://www.guide-piscine.fr/medias/image/la-pratique-de-l-aviron-1-21582-1200-800.jpg',1),(7,3,'Le judo','Le judo est un art martial, créé au Japon en 1882 par Jigorō Kanō en tant que pédagogie physique, mentale et morale','2022-12-14 11:25:54','2022-12-14 11:25:54','https://upload.wikimedia.org/wikipedia/commons/c/c6/050907-M-7747B-002-Judo.jpg',3),(8,3,'La boxe','La boxe, notamment la « boxe anglaise » règlementée de manière moderne, est un sport de combat pratiqué depuis le XVIIIᵉ siècle à un contre un, qui recourt à des frappes de percussion à l\'aide de gants matelassés','2022-12-14 11:26:44','2022-12-14 11:26:44','https://i.eurosport.com/2022/10/30/3481268-70972528-2560-1440.jpg',1),(9,3,'L\'escrime','L’escrime est un sport de combat. Il s’agit de l’art de toucher un adversaire avec la pointe ou le tranchant d’une arme blanche sur les parties valables sans être touché. On utilise trois types d\'armes : l’épée, le sabre et le fleuret','2022-12-14 11:27:26','2022-12-14 11:27:26','https://resize-europe1.lanmedia.fr/r/622,311,forcex,center-middle/img/var/europe1/storage/images/europe1/sport/l-escrime-l-art-de-la-touche-292826/6201542-1-fre-FR/L-escrime-l-art-de-la-touche.jpg',3),(12,4,'Le saut à l\'élastique','Traduit de l\'anglais-Le saut à l\'élastique, également orthographié saut à l\'élastique, est une activité qui implique une personne sautant d\'une grande hauteur tout en étant reliée à un gros cordon élastique.','2022-12-14 11:32:52','2022-12-14 11:32:52','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTqcpzaYy8eWPNu1iVvFrk6HoovbVUqUsomI0dlqzvrwLRULOdFxGcTDIZCxZxGjNSY_Zk&usqp=CAU',2),(13,4,'Le parachutisme','Le parachutisme est une activité consistant à chuter d\'une hauteur allant d\'une centaine de mètres à plusieurs milliers pour ensuite retourner sur terre avec l\'aide d\'un parachute. Si la personne s\'élance d\'un point fixe, on parle alors plutôt de saut de base.','2022-12-14 11:34:14','2022-12-15 11:54:39','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTh7hPUguzeY6rY3dUKgGPsyK5NrJffKiqQjg&usqp=CAU',1),(14,4,'L\'esacalade','L’escalade, ou grimpe, parfois appelée varappe (désuet)Note 1, est une pratique et un sport consistant à progresser le long d\'une paroi pour atteindre le haut d\'un relief ou d\'une structure artificielle par un cheminement appelé voie ou itinéraire, avec ou sans l\'aide de matériel','2022-12-14 11:35:10','2022-12-14 11:35:10','https://i0.wp.com/lafabriqueverticale.com/wp-content/uploads/2020/05/DSF0375.jpg?resize=600%2C400&ssl=1',4),(15,5,'Le ski','Le ski est un moyen de locomotion1,2 individuel basé sur la glisse pratiqué à l\'aide de patins2 longs et étroits appelés skis, fixés aux pieds, et un ensemble de disciplines sportives essentiellement hivernales. Vulgarisée grâce au ski sur neige2, introduite dans les Alpes et les autres massifs européens à la fin du XIXe siècle, cette pratique est évidemment dépendante de la présence, de la résistance et de l\'épaisseur du manteau neigeux, ce qui limite l\'activité aux régions montagneuses ou nordiques, ainsi qu\'à la saison hivernale, plus rarement en été, dans les stations d\'altitude','2022-12-14 11:36:29','2022-12-14 11:36:29','https://www.glisshop.info/wp-content/uploads/2018/01/fille-ski-1170x781.jpg',1),(16,5,'Le snowboard','Le snowboard, surf des neiges, planche à neige au Canada ou plus rarement planche de neige, est un sport de glisse sur neige. L\'équipement se compose d\'une planche de snowboard, d\'une paire de fixations dont il existe plusieurs types, et d\'une paire de bottes adaptées','2022-12-14 11:37:30','2022-12-14 11:37:30','https://contents.mediadecathlon.com/s820443/k$73acbfe5475704e8026af7b939560dc8/800x0/3120pt2830/4160xcr4160/conseils-faire-du-snowboard.jpg?format=auto&quality=80',2),(17,5,'La luge','Traduit de l\'anglais-La luge, la luge ou la luge est un sport d\'hiver généralement pratiqué en position couchée ou assise sur un véhicule génériquement connu sous le nom de luge, traîneau ou traîneau. Il est à la base de trois sports olympiques : la luge, le skeleton et le bobsleigh','2022-12-14 11:43:41','2022-12-14 11:43:41','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRs-O_LAKMSMPMWhaBrGXkzLa_5UD4_n7XtEg&usqp=CAU',3),(18,6,'La natation','La natation sportive consiste à parcourir dans une piscine, le plus rapidement possible et dans un style codifié par la Fédération internationale de natation, une distance donnée, sans l\'aide d\'aucun accessoire. La natation sportive peut être pratiquée à tout âge.','2022-12-14 11:45:34','2022-12-14 11:45:34','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKR75z9k5CoWuPOvxD0yvPcXxbIkd836_mAg&usqp=CAU',3),(19,6,'Le plongeon','Le plongeon consiste à se lancer dans l\'eau d\'une hauteur plus ou moins importante. Il peut être effectué pour s\'amuser, pour prendre le départ d\'une course de natation ou pratiqué comme un sport à part entière.','2022-12-14 11:46:43','2022-12-14 11:46:43','https://upload.wikimedia.org/wikipedia/commons/thumb/0/04/Salto_ornamental_-_UnB.jpg/220px-Salto_ornamental_-_UnB.jpg',4),(20,6,'Le wakeboard','Le wakeboard est un sport nautique qui apparait au début des années 1980 après l\'avènement du skiboard à partir d\'une combinaison de techniques de ski nautique, de snowboard et de surf. En anglais, wakeboard désigne uniquement la planche, le sport lui-même se disant wakeboarding','2022-12-14 11:48:49','2022-12-14 11:48:49','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSk9TkmQmZ6-vuZVnlMWbCknEWfKeFvFMcjoUx43RMAe_5U9UA-2kMOOfAXBdVUZ1KHfU0&usqp=CAU',1),(21,7,'Le BMX','Le BMX est un sport extrême cycliste, physique, technique et spectaculaire. Il est divisé en deux catégories : la Race où les rideurs font la course, et le Freestyle où les rideurs font des figures. Les pratiquants de ce sport sont nommés pilotes, bicrosseurs, riders.','2022-12-14 11:50:08','2022-12-14 11:50:08','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLZBxDOzr5vQMpy0ChXrpHjtaMcBgspd2SJiJPQt79TUaSD59sWrjXSO8jn5-ZkQHggt8&usqp=CAU',4),(22,7,'Le vélo','En résumé, le vélo est un sport très bénéfique pour la santé, avec peu de contre-indications. Il réduit les risques de diabète, de maladies cardiovasculaires et de dépression, entre autres. En prime, il renforce le système immunitaire, permet un sommeil de meilleure qualité et donne du tonus et de l\'énergie','2022-12-14 11:51:41','2022-12-14 11:51:41','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4WIRmnLJScEOBuYAb590gjwchFGjDGsGHeA&usqp=CAU',1),(23,7,'Le skateboard','Un skateboard ou skate ou une planche à roulettes est un objet composé d\'un plateau sous lequel sont fixés deux essieux maintenant chacun deux roues.','2022-12-14 11:58:16','2022-12-14 11:58:16','https://ffroller-skateboard.fr/wp-content/uploads/11009220_674253722680726_4546329174865534472_n.jpg',2),(24,8,'Le hockey','Le hockey est un sport dans lequel deux équipes jouent l\'une contre l\'autre en essayant de manœuvrer une balle ou un palet dans le but de l\'adversaire à l\'aide d\'une crosse. Il existe de nombreux types de hockey comme le bandy, le hockey sur gazon, le hockey sur glace ou le rink hockey.','2022-12-14 11:59:13','2022-12-14 11:59:13','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRoUpsK3Gj67dtplWK4Kn7TWRVSzxQOug-cSQ&usqp=CAU',3),(25,8,'La patinoire','Une patinoire est une surface d\'eau gelée, ou couverte d\'un matériau synthétique sur laquelle on peut faire du patinage, du bandy, du hockey sur glace, du patinage artistique, du patinage de vitesse, du curling, ou encore du freestyle sur glace','2022-12-14 12:56:38','2022-12-14 12:56:38','https://cdn.sortiraparis.com/images/80/1462/505096-la-patinoire-pailleron-pour-patiner-toute-l-annee.jpg',1),(26,8,'Le bobsleigh','Le bobsleigh est un sport d\'hiver dans lequel des équipes de deux ou quatre bobeurs, assis en file, effectuent des courses chronométrées à bord d\'un engin caréné glissant sur une étroite et sinueuse piste glacée en pente. Il figure dans tous les Jeux olympiques d\'hiver depuis 1924.','2022-12-14 12:57:04','2022-12-14 12:57:04','https://www.sports.gouv.fr/sites/default/files/2022-08/bobsleigh-benoit-ract-2-scaled-e1630575119643-jpg-660.jpg',4);
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `url_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Raquette','2022-12-12 13:24:40','2022-12-12 13:24:42','https://contents.mediadecathlon.com/p1954220/k$1b13dd1cf1afc2104882f7f46ef0ce98/sq/raquette-de-tennis-enfant.jpg?format=auto&f=800x0','La raquette est un instrument utilisé pour pratiquer certains sports : tennis, tennis de table, badminton, padel et squash. Elle permet de renvoyer à l\'adversaire une balle ou un volant. Elle se compose d\'un manche qui permet de la tenir en main, et d\'un tamis qui sert à frapper la balle'),(2,'Aquatique','2022-12-14 10:55:00','2022-12-14 10:55:02','https://upload.wikimedia.org/wikipedia/commons/1/14/Water_sports_composite.jpg','Si la natation est le plus connu, il existe bien d\'autres sports aquatiques. Parmi eux, on trouve notamment l\'aquagym, qui correspond à un cours collectif de gym en piscine.'),(3,'Combat','2022-12-14 11:04:41','2022-12-14 11:04:42','https://images.lanouvellerepublique.fr/image/upload/t_1020w/5f7f3a95aaee924c528b45a3.jpg','Un sport de combat appartient à une famille d\'activités sportives proposant le plus souvent comme forme compétitive un affrontement entre deux combattants.'),(4,'Extrêmes','2022-12-14 11:06:53','2022-12-14 11:06:54','https://www.activites-plein-air.fr/wp-content/uploads/2019/07/sports-extr%C3%AAmes.jpg','Un sport extrême est une activité sportive particulièrement dangereuse pouvant exposer à des blessures graves ou à la mort en cas d\'erreur dans son exécution. Il peut se pratiquer en milieu aquatique, dans le ciel ou sur terre et implique souvent vitesse, hauteur, engagement physique, ainsi qu\'un matériel spécifique'),(5,'Hiver','2022-12-14 11:07:35','2022-12-14 11:07:37','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT2THhP2ih0eqUlqqnC07Wt6Cnm4KCiMo_K_g&usqp=CAU','L\'expression sports d\'hiver est apparue à la fin du XIXᵉ siècle pouvant alors désigner les sports pratiqués l\'hiver ou « ceux pratiqués exclusivement l\'hiver en raison des conditions météorologiques, glace, neige, indispensables à son fonctionnement ».'),(6,'Nautique','2022-12-14 11:10:10','2022-12-14 11:10:11','https://tourscanner.com/blog/wp-content/uploads/2018/02/Featured-image.jpg','Il existe différents types de sports nautiques populaires dans le monde.'),(7,'Cyclisme','2022-12-14 11:13:57','2022-12-14 11:14:00','https://sport-u.com/wp-content/uploads/2018/07/Cyclisme-8.jpg','Le cyclisme recouvre plusieurs notions concernant la bicyclette : il est d\'abord une activité quotidienne pour beaucoup, un loisir pour d\'autres, enfin un sport proposant des courses selon plusieurs'),(8,'Glisse','2022-12-14 11:17:07','2022-12-14 11:17:08','https://www.sport-et-tourisme.fr/wp-content/uploads/2021/09/ice-cross.jpg','La Fédération française des sports de glace (FFSG) est une fédération sportive française regroupant des disciplines très diverses et qui ont comme dénominateur commun de se pratiquer sur la glace. Ce regroupement est un cas unique dans le sport français, ce qui explique sa grande complexité structurelle. ');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20221120160315','2022-11-25 14:19:49',714),('DoctrineMigrations\\Version20221124173713','2022-12-12 09:48:53',80),('DoctrineMigrations\\Version20221204113740','2022-12-12 09:48:53',62),('DoctrineMigrations\\Version20221204131836','2022-12-12 09:48:53',392);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'momodu56@gmail.com','MomoDu56','[\"ROLE_USER\", \"ROLE_ADMIN\"]','$2y$13$Oe/QPVAokbYdw1z.bmF6euWHrHze4j79lVGo8t0YIRXEXzreOfP2K','2022-12-12 13:23:10','2022-12-12 13:23:11'),(2,'lentpoule@gmail.com','LentPoule','[\"ROLE_USER\"]','$2y$10$TvqfrsGF38FnYnzdluY3/eY0t20K4Gj5ivKBiHrtg1N1UcbwY1RWG','2022-12-12 13:28:49','2022-12-12 13:28:49'),(3,'fantome56@gmail.com','Fantome56','[\"ROLE_USER\", \"ROLE_ADMIN\"]','$2y$10$RPKX4AeQnwBi/Pw.diUHcuoUvjgoDjFxTid91jBSLr1BIHqgtaiV6','2022-12-14 12:58:48','2022-12-14 12:58:48'),(4,'chips22@gmail.com','Chips22','[\"ROLE_USER\"]','$2y$13$9NH3XXdGnhgXJ9B9ZfLFpeCz9D6fKM8IFOSKcSsP9wmPTomh.Gsjy','2022-12-14 12:59:11','2022-12-14 12:59:11'),(7,'charlie@gmail.com','Charlie','[\"ROLE_USER\"]','azerty','2022-12-15 10:02:40','2022-12-15 10:02:58');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'wikisports'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-15 16:10:06
