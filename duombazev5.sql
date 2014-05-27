-- MySQL dump 10.13  Distrib 5.5.35, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: bbd
-- ------------------------------------------------------
-- Server version	5.5.35-0+wheezy1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Mėsa','/images/meat.png'),(2,'Žuvis','/images/fish.png'),(3,'Pieno produktai','/images/milk.png'),(4,'Grūdinė kultūra','/images/grain.png'),(5,'Riešutai','/images/nuts.png'),(6,'Daržovės','/images/vegetables.png'),(7,'Vaisiai','/images/fruits.png'),(8,'Paukštiena','/images/poultry.png'),(9,'Sojos produktai','/images/soy.png'),(10,'Pagrindinai','/images/main.png'),(11,'Žuvies gėrybės','/images/seafood.png'),(12,'Prieskoniai','/images/spices.png'),(13,'Žolės','/images/grass.png'),(14,'Gėrimai','/images/drinks.png');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `celebration`
--

DROP TABLE IF EXISTS `celebration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `celebration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `celebration`
--

LOCK TABLES `celebration` WRITE;
/*!40000 ALTER TABLE `celebration` DISABLE KEYS */;
INSERT INTO `celebration` VALUES (1,'Kūčios','/images/kucios.png'),(2,'Kalėdos','/images/cristmas.png'),(3,'Velykos','/images/eastern.png'),(4,'Gimtadienis','/images/birthday.png'),(5,'Vestuves','wedding.png');
/*!40000 ALTER TABLE `celebration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `recipe_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5F9E962AA76ED395` (`user_id`),
  KEY `IDX_5F9E962A59D8A214` (`recipe_id`),
  CONSTRAINT `FK_5F9E962A59D8A214` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`),
  CONSTRAINT `FK_5F9E962AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cooking_time`
--

DROP TABLE IF EXISTS `cooking_time`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cooking_time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` time NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cooking_time`
--

LOCK TABLES `cooking_time` WRITE;
/*!40000 ALTER TABLE `cooking_time` DISABLE KEYS */;
INSERT INTO `cooking_time` VALUES (1,'00:05:00','',''),(2,'00:20:00','',''),(3,'00:10:00','',''),(4,'00:15:00','',''),(5,'00:25:00','',''),(6,'00:30:00','',''),(7,'00:35:00','',''),(8,'00:40:00','',''),(9,'00:45:00','',''),(10,'00:50:00','',''),(11,'00:55:00','',''),(12,'01:00:00','',''),(13,'01:15:00','',''),(14,'01:30:00','',''),(15,'01:45:00','',''),(16,'02:00:00','',''),(17,'02:30:00','',''),(18,'03:00:00','','');
/*!40000 ALTER TABLE `cooking_time` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Lietuva','/images/lituhania.png'),(2,'Kinija','/images/china.png'),(3,'Japonija','/images/japan.png'),(4,'Indija','/images/india.png'),(5,'Rusija','/images/russia.png'),(6,'Ukraina','/images/ukraine.png'),(7,'Turkija','/images/turkey.png'),(8,'Prancūzija','/images/france.png'),(9,'Italija','/images/italia.png'),(10,'Vokietija','/images/germany.png'),(11,'JAV','/images/jav.png'),(12,'Lenkija','/images/poland.png'),(13,'Ispanija','/images/spain.png'),(14,'Tailandas','/images/tailand.png'),(15,'Didžioji Britanija','/images/britan.png'),(16,'Airija','ireland.png');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facts`
--

DROP TABLE IF EXISTS `facts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facts`
--

LOCK TABLES `facts` WRITE;
/*!40000 ALTER TABLE `facts` DISABLE KEYS */;
INSERT INTO `facts` VALUES (1,'Ne'),(2,'Apyniuose yra antioksidantų, bet, norėdami pajusti jų naudą, turėtumėte išgerti 446 litrus alaus per dieną.'),(3,'Amerikiečiai suvalgo 10 milijardų spurgų, o britai išgeria 60 milijardų arbatos puodelių per metus.'),(4,'„Coca Cola“ yra pati mėgstamiausia... Meksikoje, o „Heinz“ kečupo parduodama vidutiniškai po du indelius kiekvienam pasaulio gyventojui.'),(5,'Du tūkstančius metų šokoladas buvo žinomas tik kaip gėrimas. Pirmoji šokolado plytelė buvo parduota tik 1849 metais.'),(6,'Pusė viso pasaulyje pagaminamo maisto sugenda arba yra išmetama.'),(7,'Visi bananai yra genetiškai identiški, nes bananų medžiai klonuojami jau kelis dešimtmečius.'),(8,'Mikrobangų krosnelėje kepami spragėsiai išleidžia plaučiams toksiškas dujas.'),(9,'Rozmarino aliejus yra daug stipresnis mėsos konservantas nei sintetiniai.'),(10,'Vyšnios mažina podagros simptomus ir padeda išvengti artrito.'),(11,'Petražolės pritraukia kenkėjus, todėl padeda apsaugoti nuo jų kitas daržo gėrybes.'),(12,'Raugintuose kopūstuose gausu vitaminų ir probiotikų, todėl jie iki šiol laikomi būtina jūreivių valgiaraščio sudėtine dalimi.'),(13,'Raudonėliuose daugiau antioksidantų nei mėlynėse.'),(14,'7 % amerikiečių kasdien valgo restoranuose „McDonald’s“.'),(15,'1995 metais japonai pirmą kartą per visą istoriją suvartojo daugiau mėsos negu ryžių.'),(16,'Senovės Graikijoje vynas visada buvo skiedžiamas jūros vandeniu'),(17,'Paprastai prie žuvies patiekiamas baltas vynas, o prie mėsos – raudonas. Vienintelė išimtis yra tunas – jis valgomas su raudonu vynu.'),(18,'Daugiau kaip 40 % užauginamų migdolų sunaudojami šokoladui gaminti.'),(19,'Pasaulyje yra daugiau kaip 20 000 vyno rūšių.'),(20,'Raudonos arba rožinės spalvos greipfrutuose vitamino C yra daugiau negu įprastuose (geltonos spalvos).'),(21,'Kai kur Kinijoje vietoje cukraus į arbatą beriama druskos.'),(22,'Net 96 % agurko sudaro vanduo.'),(23,'Kasmet pasaulyje suvartojama apie 567 milijardus vištų kiaušinių.'),(24,'Žaliojoje arbatoje vitamino C yra 50 % daugiau negu juodojoje.'),(25,'Kasdien Didžiojoje Britanijoje išgeriama 185 milijonai puodelių arbatos.'),(26,'Per savo gyvenimą žmogus suvalgo maždaug 40 tonų maisto.'),(27,'Medus yra vienintelis produktas kuris negenda. Jis išsilaiko net ir 3000 metų'),(28,'Įdėjus drėgnus arbatos maišelius į sportinį krepįš ar sportbačius, šie ištrauks iš jų nemalonų kvapą.'),(29,'Valgydamas žmogus ne tik patenkina savo fiziologinį poreikį, bet ir patiria malonumą.'),(30,'Japonijoje parduodami astuonkoju,vistu sparneliu, kaktusu ir krabu skonio ledai.'),(31,'Dabar vistiena yra 266% riebesne negu pries 40 metu.'),(32,'Per metus suvalgome apie 500kg maisto.'),(33,'Kad pagamintu 1kg medaus, bites turi aplankyti 4mln. geliu ir nukeliauti 160000km.'),(34,'Iš žemės riešutų aliejaus gaminamas glicerinas, kuris yra naudojamas nitroglicerino gamybai, o šis komponentas yra viena iš sudedamųjų dinamito dalių.');
/*!40000 ALTER TABLE `facts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likes` (
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`recipe_id`),
  KEY `IDX_49CA4E7DA76ED395` (`user_id`),
  KEY `IDX_49CA4E7D59D8A214` (`recipe_id`),
  CONSTRAINT `FK_49CA4E7D59D8A214` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`),
  CONSTRAINT `FK_49CA4E7DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `about` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES (1,'Maxina Pramonės','Parduotuvė',54.911369,23.983001,'Maxima','',''),(2,'Kebabinė','Kebabine',54.904547,23.888415,'','Kebabinė','/images/kebabine.png');
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `main_cooking_method`
--

DROP TABLE IF EXISTS `main_cooking_method`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `main_cooking_method` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `main_cooking_method`
--

LOCK TABLES `main_cooking_method` WRITE;
/*!40000 ALTER TABLE `main_cooking_method` DISABLE KEYS */;
INSERT INTO `main_cooking_method` VALUES (1,'Kepimas','/images/baking.png'),(2,'Grilyje','/images/grill.png'),(3,'Džiovinti','/images/dry.png'),(4,'Garuose','/images/steam.png'),(5,'Išmaišyti','/images/mix.png'),(6,'Marinuoti','/images/pickle.png'),(7,'Mikrobangėje','/images/microwave.png'),(8,'Orkaitėje','/images/oven.png'),(9,'Rauginti','/images/leaven.png'),(10,'Išrūkyti','/images/smokedout.png'),(11,'Plakti','/images/whisk.png'),(12,'Sušaldyti','/images/frozen.png'),(13,'Ištroškinti','/images/braise.png'),(14,'Išvirti','/images/boil.png');
/*!40000 ALTER TABLE `main_cooking_method` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produced_recipes`
--

DROP TABLE IF EXISTS `produced_recipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produced_recipes` (
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`recipe_id`),
  KEY `IDX_7899DD86A76ED395` (`user_id`),
  KEY `IDX_7899DD8659D8A214` (`recipe_id`),
  CONSTRAINT `FK_7899DD8659D8A214` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`),
  CONSTRAINT `FK_7899DD86A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produced_recipes`
--

LOCK TABLES `produced_recipes` WRITE;
/*!40000 ALTER TABLE `produced_recipes` DISABLE KEYS */;
/*!40000 ALTER TABLE `produced_recipes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B3BA5A5A12469DE2` (`category_id`),
  KEY `IDX_B3BA5A5AF8BD700D` (`unit_id`),
  CONSTRAINT `FK_B3BA5A5A12469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `FK_B3BA5A5AF8BD700D` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,'Kiauliena','1',1),(2,1,'Jautiena','1',1),(3,1,'Aviena','1',1),(4,1,'Veršiena','1',1),(5,8,'Vištiena','2',1),(6,8,'Kalakutiena','2',1),(7,8,'Antiena','2',1),(8,8,'Žąsiena','2',1),(9,2,'Ungurys','3',1),(10,2,'Šamas','3',1),(11,2,'Karpis','3',1),(12,2,'Lašiša','3',1),(13,2,'Ešerys','3',1),(14,2,'Karšis','3',1),(15,2,'Kuoja','3',1),(16,2,'Silkė','3',1),(17,2,'Lydeka','3',1),(18,2,'Menkė','3',1),(19,2,'Tunas','3',1),(20,2,'Vėgėlė','3',1),(21,2,'Stinta','3',1),(22,2,'Plekšnė','3',1),(23,2,'Skumbrė','3',1),(24,7,'Agrastas','4',1),(26,6,'Agurotis','4',1),(27,7,'Aronija','4',1),(28,7,'Avietė','4',1),(29,7,'Braškė','4',1),(30,7,'Bruknė','4',1),(31,7,'Erškėtis','4',1),(32,7,'Gervuogė','4',1),(33,7,'Gudobelė','4',1),(34,7,'Ieva','4',1),(35,7,'Katuogė','4',1),(36,7,'Kriaušė','4',1),(37,7,'Mėlynė','4',1),(38,7,'Melionas','4',1),(39,7,'Obuolys','4',1),(40,7,'Paprikas','4',1),(42,7,'Putinas','4',1),(43,7,'Juodieji serbentai','4',1),(44,7,'Raudonieji serbentai','4',1),(45,7,'Slyva','4',1),(46,7,'spanguolė','4',1),(47,7,'Svarainis','4',1),(48,7,'Šaltalankis','4',1),(49,7,'Šermukšnis','4',1),(50,7,'Šilauogė','4',1),(51,7,'Trešnė','4',1),(52,7,'Vynuogė žalioji','4',1),(53,7,'Vynuogė raudonoji','4',1),(54,7,'Vyšnia','4',1),(55,7,'Žemuogė','4',1),(56,7,'Abrikosas','4',1),(57,7,'Alyvuogė','4',1),(58,7,'Ananasas','4',1),(59,7,'Apelsinas','4',1),(60,7,'Arbūzas','4',1),(61,7,'Avokadas','4',1),(63,7,'Bananas','4',1),(64,7,'Citrina','4',1),(65,7,'Datulė','4',1),(66,7,'Figa','4',1),(67,7,'Granatas','4',1),(68,7,'Kivis','4',1),(69,7,'Mandarinas','4',1),(70,7,'Mangas','4',1),(71,7,'Papaja','4',1),(72,7,'Pasiflora','4',1),(73,7,'Persikas','4',1),(74,7,'Persimomas','4',1),(75,7,'Greipfrutas','4',1),(76,6,'Bulvė','5',1),(77,6,'Artišokas','5',1),(78,6,'Rabarbaras','5',1),(79,6,'Baltagūžis kopūstas','5',1),(80,6,'Briuselio kopūstas','5',1),(81,6,'Brokolis','5',1),(82,6,'Garbanotasis kopūstas','5',1),(83,6,'Pekino kopūstas','5',1),(84,6,'Žiedinis kopūstas','5',1),(85,6,'Česnakas','5',1),(86,6,'Poras','5',1),(87,6,'Svogūnas','5',1),(88,6,'Burokėlis','5',1),(89,6,'Morka','5',1),(90,6,'Ridikas','5',1),(91,6,'Ridikėlis','5',1),(92,6,'Ropė','5',1),(93,6,'Salieras','5',1),(94,6,'Rugštynė','5',1),(95,6,'Salotos','5',1),(96,6,'Špinatai','5',1),(97,6,'Pupelės','5',1),(98,6,'Šparaginės pupelės','5',1),(99,6,'Pupos','5',1),(100,6,'Žirniai','5',1),(101,6,'Kukūruzai','5',1),(102,6,'Agurkas','5',1),(104,6,'Cukinija','5',1),(105,6,'Moliūgas','5',1),(106,6,'Patisonas','5',1),(107,6,'Baklažanas','5',1),(108,6,'Pomidoras','5',1),(109,3,'Pienas','6',2),(110,3,'Grietinė','6',2),(111,3,'Grietinėlė','6',2),(112,3,'Varškė','6',1),(113,3,'Surelis','6',3),(114,3,'Jogurtas','6',2),(115,3,'Pasukos','6',2),(116,3,'Kondensuotas pienas','6',2),(117,3,'Kiaušiniai','6',3),(118,3,'Varškės sūris','6',1),(119,3,'Fermentinis sūris','6',1),(120,3,'Pelėsinis sūris','6',1),(121,3,'Majonezas','6',2),(122,4,'Miltas','7',1),(123,4,'Ryžai','7',1),(124,4,'Grikiai','7',1),(125,4,'Manai','7',1),(126,4,'Džiovinti žirniai','7',1),(127,4,'Lęšiai','7',1),(128,4,'Dribsniai','7',1),(129,5,'Migdolai','8',1),(130,5,'Žemės riešutai','8',1),(131,5,'Lazdyno riešutai','8',1),(132,5,'Graikiški riešutai','8',1),(133,5,'Pistacijos','8',1),(134,5,'Anakardžio riešutai','8',1),(135,3,'Sviestas','6',1),(136,10,'Aliejus','9',2),(138,10,'Miltai','9',1),(139,10,'Druska','9',1),(140,1,'Briediena','1',1),(141,1,'Šerniena','1',1),(142,1,'Zuikiena','1',1),(143,1,'Tiušiena','1',1),(144,1,'Elniena','1',1),(145,11,'Krevetės','8',1),(146,4,'Džiuvesėliai','7',1),(147,4,'Malti džiuvesėliai','7',1),(148,6,'Česnakas','4',1),(149,6,'Žaliosis alyvuogės','4',1),(150,12,'Juodieji malti pipirai','8',1),(151,12,'Druska','8',1),(152,6,'Kaprėliai','5',1),(153,3,'Kokosų pienas','3',2),(154,12,'Kepimo milteliai','10',1),(155,6,'Vyšniniai pomidorai','5',1),(156,3,'Saldus pieniškas sūris','5',3),(157,12,'Ciberžolė','10',1),(158,11,'Kalendra','10',1),(159,12,'Kanapių sėklos','10',1),(160,12,'Linų sėmenys','10',1),(161,13,'Pienes lapai','11',1),(162,12,'Pienės žiedai','11',1),(163,10,'Medus','5',1),(164,7,'Nektarinai','4',3),(165,4,'makaronai','5',1),(166,12,'Čiobrelis','11',1),(167,12,'Citrinų sultys','10',2),(168,9,'Sojos padažas','2',2),(169,12,'Krakmolas','5',1),(170,11,'Cukraus pudra','5',1),(171,7,'Šaldytos uogos','5',1),(172,11,'Tabasko padazas','5',1),(173,10,'Alyvuogių aliejus','10',2),(174,4,'Lavašas','5',3),(175,13,'Krapai','11',1),(176,13,'Petražolės','11',1),(177,6,'Raudonasis svogunas','50',1),(178,12,'Cinamonas','s',1),(179,1,'Vištienos sparneliai','as',1),(180,12,'Garstyčios','5',1),(181,14,'Apelsinų sultys','5',2),(182,12,'Apelsino žievelė','as',1),(183,6,'Svogūnų laiškai','2',1),(184,12,'Kakava','a',1),(185,12,'Kokoso drožlės','1',1),(186,12,'Kumino','2',1);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `properties`
--

LOCK TABLES `properties` WRITE;
/*!40000 ALTER TABLE `properties` DISABLE KEYS */;
INSERT INTO `properties` VALUES (1,'Aštru','/images/Hot'),(2,'Rūgštu','/images/sour.png'),(3,'Sūru','/images/salty.png'),(4,'Egzotiška','/images/exotic.png'),(5,'Pigu','/images/cheap.png'),(6,'Greita','/images/fast.png'),(7,'Pikantiška','/images/spicy.png'),(8,'Pusryčiams','/images/breakfast.png'),(9,'Pietums','/images/lunch.png'),(10,'Vakarienei','/images/dinner.png'),(11,'Švediškam stalui','/images/swedish.png'),(12,'Užkanda prie alaus','/images/beer.png'),(13,'vegetariška','/images/vegetarian.png'),(14,'Veganiška','/images/vegan.png'),(15,'Vaikams','/images/for_kids.png'),(16,'Dietinis','/images/diet.png'),(17,'Gydomasis','health.png');
/*!40000 ALTER TABLE `properties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe_products`
--

DROP TABLE IF EXISTS `recipe_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipe_products` (
  `product_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`recipe_id`),
  KEY `IDX_C52AFFC44584665A` (`product_id`),
  KEY `IDX_C52AFFC459D8A214` (`recipe_id`),
  CONSTRAINT `FK_C52AFFC44584665A` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `FK_C52AFFC459D8A214` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_products`
--

LOCK TABLES `recipe_products` WRITE;
/*!40000 ALTER TABLE `recipe_products` DISABLE KEYS */;
INSERT INTO `recipe_products` VALUES (1,2,10),(6,6,250),(10,6,10),(12,8,800),(29,6,150),(40,11,500),(59,12,700),(59,16,500),(61,10,3),(63,14,4),(63,16,2),(64,8,1),(76,15,200),(79,11,500),(85,7,2),(85,8,2),(87,6,2),(87,8,2),(89,15,100),(91,12,50),(95,12,500),(109,16,50),(111,8,100),(111,9,200),(114,5,400),(114,10,700),(116,4,250),(117,4,3),(117,16,2),(122,16,100),(132,5,20),(132,12,80),(135,4,50),(135,8,30),(135,16,50),(136,6,60),(136,11,0),(136,15,1),(138,4,180),(139,8,0),(139,10,0),(139,11,0),(139,12,0),(139,15,0),(139,16,0),(150,8,0),(150,10,0),(150,11,0),(150,12,0),(153,14,300),(158,15,3),(161,5,20),(162,5,40),(163,5,20),(163,6,20),(163,8,60),(163,12,5),(163,13,60),(163,14,40),(164,6,2),(165,6,200),(167,6,60),(167,10,60),(167,11,50),(168,8,0),(169,8,150),(170,9,150),(170,16,50),(171,9,500),(172,10,0),(173,10,60),(173,12,50),(173,16,30),(174,11,4),(175,11,20),(176,11,20),(177,12,50),(178,12,2),(179,13,1),(180,13,50),(181,13,1),(182,13,20),(183,13,100),(184,14,30),(185,14,40),(186,15,3);
/*!40000 ALTER TABLE `recipe_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe_property`
--

DROP TABLE IF EXISTS `recipe_property`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipe_property` (
  `recipe_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  PRIMARY KEY (`recipe_id`,`property_id`),
  KEY `IDX_FD62B94059D8A214` (`recipe_id`),
  KEY `IDX_FD62B940549213EC` (`property_id`),
  CONSTRAINT `FK_FD62B940549213EC` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_FD62B94059D8A214` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_property`
--

LOCK TABLES `recipe_property` WRITE;
/*!40000 ALTER TABLE `recipe_property` DISABLE KEYS */;
INSERT INTO `recipe_property` VALUES (2,1),(2,4),(2,5),(3,10),(3,11),(4,6),(4,15),(5,5),(5,6),(5,8),(5,16),(6,9),(6,10),(6,16),(8,9),(8,10),(8,13),(9,6),(9,9),(9,10),(9,15),(10,7),(10,9),(10,10),(10,13),(11,6),(11,9),(11,13),(12,9),(12,10),(13,1),(13,7),(13,9),(14,4),(14,6),(15,1),(15,2),(15,3),(15,4),(15,5),(15,6),(15,7),(15,8),(15,9),(15,10),(15,11),(15,12),(15,13),(15,14),(15,15),(15,17),(16,4),(16,8),(16,16);
/*!40000 ALTER TABLE `recipe_property` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `celebration_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cookingTime_id` int(11) DEFAULT NULL,
  `mainCookingMethod_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A369E2B5F92F3E70` (`country_id`),
  KEY `IDX_A369E2B54741E894` (`celebration_id`),
  KEY `IDX_A369E2B54EF1D9AC` (`cookingTime_id`),
  KEY `IDX_A369E2B5DC86C9EC` (`mainCookingMethod_id`),
  KEY `IDX_A369E2B5A76ED395` (`user_id`),
  KEY `IDX_A369E2B58EB23357` (`type_id`),
  CONSTRAINT `FK_A369E2B54741E894` FOREIGN KEY (`celebration_id`) REFERENCES `celebration` (`id`),
  CONSTRAINT `FK_A369E2B54EF1D9AC` FOREIGN KEY (`cookingTime_id`) REFERENCES `cooking_time` (`id`),
  CONSTRAINT `FK_A369E2B58EB23357` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`),
  CONSTRAINT `FK_A369E2B5A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_A369E2B5DC86C9EC` FOREIGN KEY (`mainCookingMethod_id`) REFERENCES `main_cooking_method` (`id`),
  CONSTRAINT `FK_A369E2B5F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipes`
--

LOCK TABLES `recipes` WRITE;
/*!40000 ALTER TABLE `recipes` DISABLE KEYS */;
INSERT INTO `recipes` VALUES (2,1,'Kiauliena','Kepam','/images/food (15).jpg',1,4,NULL,5,1),(3,NULL,'Menkės kukuliai su daržovėmis ir kokoso pienu','Menkės kukuliai su daržovėmis ir kokoso pienu','/images/recipe1.jpg',1,4,NULL,10,13),(4,NULL,'Beatos keksiukai su kremu ir mėlynėmis Kondensuoto pieno keksiukai','Kondensuoto pieno keksiukai. Beatos receptai','/images/recipe2.jpg',4,3,NULL,7,8),(5,NULL,'Sveika: jogurtas su pienėmis','Sveikas gėrimas','/images/recipe4.jpg',NULL,1,NULL,3,11),(6,NULL,'Salotos su kalakutiena ir vaisiais','Valgoma 4 valandos po pagaminimo','/images/recipe5.jpg',NULL,7,NULL,8,1),(7,NULL,'Greitas lašišos troškinys','Lašiša pamarinuoti iš anksčiau','/images/recipe6.jpg',1,4,NULL,5,8),(8,NULL,'Greitas lašišos troškinys','Lašiša pamarinuoti iš anksčiau','/images/recipe6.jpg',1,4,NULL,5,8),(9,NULL,'Naminiai ledai su uogomis','Greita ir skanu','/images/recipe7.jpg',NULL,3,NULL,13,11),(10,NULL,'Avokadų sriuba','Valgyti sriuba galėsite tik už poros valandų nuo pagaminimo.','/images/recipe8.jpg',NULL,8,NULL,3,5),(11,NULL,'Lavašas su daržovėmis','Į suktinukus galima įvynioti plonus sūrio gabalėlius.','/images/recipe9.jpg',NULL,12,NULL,4,5),(12,1,'Ridikėlių salotos su apelsinais','Gerai atgaivina, tinkamos vasaros metu','/images/recipe10.jpg',NULL,7,NULL,10,5),(13,1,'Vištienos sparneliai','Jokių kitų prieskonių nereikia, kaip pvz., druskos, pipirų ir pan.','/images/recipe11.jpg',NULL,4,NULL,12,2),(14,14,'Šokoladinis kokteilis su bananais ir kokoso pienu','Geras gaivus kokteiliukas vasarai.','/images/recipe12.jpg',4,1,NULL,1,11),(15,1,'Naminiai daržovių traškučiai','Tinka prie visko','/images/recipe13.jpg',NULL,12,NULL,4,1),(16,15,'Angliški blyneliai su karamelizuotais bananais','Gardūs angliški blyneliai','/images/recipe14.jpg',NULL,3,NULL,2,1);
/*!40000 ALTER TABLE `recipes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shopping_list`
--

DROP TABLE IF EXISTS `shopping_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shopping_list` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shopping_list`
--

LOCK TABLES `shopping_list` WRITE;
/*!40000 ALTER TABLE `shopping_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `shopping_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shopping_list_products`
--

DROP TABLE IF EXISTS `shopping_list_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shopping_list_products` (
  `product_id` int(11) NOT NULL,
  `shopping_list_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`shopping_list_id`),
  KEY `IDX_BF02812D4584665A` (`product_id`),
  KEY `IDX_BF02812D23245BF9` (`shopping_list_id`),
  CONSTRAINT `FK_BF02812D23245BF9` FOREIGN KEY (`shopping_list_id`) REFERENCES `shopping_list` (`id`),
  CONSTRAINT `FK_BF02812D4584665A` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shopping_list_products`
--

LOCK TABLES `shopping_list_products` WRITE;
/*!40000 ALTER TABLE `shopping_list_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `shopping_list_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shoppinglists`
--

DROP TABLE IF EXISTS `shoppinglists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shoppinglists` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`product_id`),
  KEY `IDX_2C0AB3FFA76ED395` (`user_id`),
  KEY `IDX_2C0AB3FF4584665A` (`product_id`),
  CONSTRAINT `FK_2C0AB3FF4584665A` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `FK_2C0AB3FFA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shoppinglists`
--

LOCK TABLES `shoppinglists` WRITE;
/*!40000 ALTER TABLE `shoppinglists` DISABLE KEYS */;
/*!40000 ALTER TABLE `shoppinglists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `steps`
--

DROP TABLE IF EXISTS `steps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `steps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recipe_id` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_34220A7259D8A214` (`recipe_id`),
  CONSTRAINT `FK_34220A7259D8A214` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `steps`
--

LOCK TABLES `steps` WRITE;
/*!40000 ALTER TABLE `steps` DISABLE KEYS */;
INSERT INTO `steps` VALUES (6,3,'Menkės filė sumalti, sudėti pusę smulkiai supjaustyto svogūno ir česnako skiltelę, įmušti kiaušinį, sudėti džiūvėsėlius, pipirus, druską ir susmulkintus kaparėlius.'),(7,3,'Gerai išminkyti faršą, formuoti kukulius ir dėti į garų puodą- 5-7 min.'),(8,3,'Keptuvėje įkaitinti aliejų, sudėti likusį susmulkintą svogūną, susmulkintas alyvuoges, trumpai apkepti.'),(9,3,'Tada sudėti kalafiorus ir šparagines pupeles, įpilti apie pusę stiklinės vandens (jei turite įpilkite sultinio), įberti druskos ir patroškinti apie 5 minutes.'),(10,3,'Pabaigoje sudėti kukulius ir supilti kokosų pieną ir dar patroškinti, kol padažas užvirs.'),(11,4,'Kondensuotą pieną supilkite į dubenį, įmuškite kiaušinius ir sumaišykite su šaukštu, kad nebesimatytų kiaušinių.'),(12,4,'Sviestą ištirpinkite ir supilkite į kondensuoto pieno masę, išmaišykite.'),(13,4,'Miltus persijokite su kepimo milteliais ir įmaišykite į kondensuoto pieno bei kiaušinių masę. Išeina tiršta tešla.'),(14,4,'Po kelis šaukštus tešlos sukrėskite į keksiukų kepimo formą ir pašaukite į orkaitę. Kepkite apie 25 minutes 190 laipsnių temperatūroje.'),(15,5,'Į jogurtą suberkite smulkintus pienių lapus ir žiedus, sudėkite medų.\n'),(16,5,'Plaktuvu plakite masę 3 min. Supilkite į stiklines, įberkite smulkintų graikinių riešutų.'),(17,6,'Išverdame makaronus pagal nurodymus ant pakuotės. Perpilame šaltu vandeniu ir paliekame nusausėti. Įkaitiname keptuvę su aliejumi.'),(18,6,'Kalakutienos krūtinėlę supjaustome juostelėmis ir sudedame į keptuvę, kur kepame maždaug 4 minutes, kol apskrus iš visų pusių.\n'),(19,6,'Dubenyje sumaišome smulkintus svogūnus, makaronus ir sudedame keptą kalakutieną. Sumaišome medų, likusį aliejų, citrinos sultis ir čiobrelius.'),(20,6,'Padažą užpilame ant makaronų su kalakutiena. Dedame į šaldytuvą bent 4 valandoms. Prieš patiekiant supjaustome nektarinus ar slyvas, braškes ir sumaišome kartu su kalakutiena bei makaronais'),(21,7,'Lašišą supjaustyti gabaliukais, apšlakstyti citrinos sultimis, druska, pipirais, įspausti česnako ir sudėti tirpintą medų. Leisti kelias valandas pasimarinuoti.\n'),(22,8,'Lašišą supjaustyti gabaliukais, apšlakstyti citrinos sultimis, druska, pipirais, įspausti česnako ir sudėti tirpintą medų. Leisti kelias valandas pasimarinuoti'),(23,8,'Į keptuvę pilti aliejaus, dėti sviestą ir pakepinti pjaustytą svogūną iki karamelinės spalvos. Į maišelį suberti krakmolą ir nusausintą lašišą, gerai supurtyti ir pilti į keptuvę, maišant kepti 5-6 minutes. Baigus kepti, apšlakstyti citrinos sultimis, soj'),(24,9,'Neatšildytas šaldytas uogas suberkite į elektrinį plaktuvą ir kelias sekundes malkite, kol gausite cukraus dydžio kristalus. Tada supilkite pusę stiklinės grietinėlės ir vėl plakite. Suberkite cukraus pudrą, supilkite grietinėlę ir dar paplakite, kol gaus'),(25,9,'Patiekite iš karto.'),(26,9,'Cukraus pudros kiekį reguliuokite pagal norą, uogas taip pat galite rinktis tas, kurias labiausiai mėgstate.'),(27,10,'Dviejų avokadų minkštimą sutrinkite trintuvu su citrinos sultimis, druska, pipirais. Supilkite jogurtą, padažą, alyvuogių aliejų, dar kartą išplakite.'),(28,10,'Gautą masę supilkite į dubenį, uždenkite plėvele ir 2 val. pastatykite į šaldytuvą.'),(29,10,'Prieš patiekdami sriubą, trečio avokado minkštimą supjaustykite griežinėliais, juos apšlakstykite citrinos sultimis. Išpilstykite sriubą į dubenėlius, papuoškite avokado griežinėliais.'),(30,11,'Morkas, kopūstą, raudonąsias paprikas supjaustykite šiaudeliais. '),(31,11,'Suberkite susmulkintus žalumynus: petražoles ir krapus. Apšlakstykite daržoves citrinos sultimis, pabarstykite druska ir pipirais.'),(32,11,'Įdarą dėkite ant lavašo ir suvyniokite plonais vamzdeliais. Įkaitinkite nedidelį kiekį aliejaus ir lengvai apkepkite kiekvieną suktinuką iš abiejų pusių po keletą minučių.'),(33,12,'Supjaustykite apelsiną skiltelėmis, išimkite sėklas, pašalinkite baltąjį sluoksnį.'),(34,12,'Sudėkite į indą, apšlakstykite medumi, cinamonu, uždenkite ir palikite valandai kambario temperatūroje'),(35,12,'Lėkštėje išdėliokite suplėšytus salotų lapus, ridikėlius, svogūnus, apšlakstykite aliejumi, pabarstykite druska, pipirais, viską pamaišykite'),(36,12,'Prieš tiekiant uždėkite apelsinų skilteles, užpilkite susidariusiomis sultimis. Apibarstykite pakepintais graikiniais riešutais.'),(37,13,'Iš pateiktų produktų sumaišome marinatą ir sudedame vištienos sparnelius.'),(38,13,'Rekomenduojama palaikyti bent porą valandų. Kepti ant žarijų.'),(39,14,'Kokoso pieną 1 min. paplakite plaktuvu.'),(40,14,'Nulupkite bananus, supjaustykite gabalėliais, sudėkite į plaktuvo indą, sudėkite medų ir kakavą, išplakite.'),(41,14,'Suberkite į kokteilį kokoso drožles, išmaišykite.'),(42,14,'Supilstykite kokteilį į taures ir patiekite.'),(43,15,'Daržoves nuvalykite ir supjaustykite labai plonomis riekelėmis. Jas gerai perplaukite po tekančiu vandeniu, kad išsiplautų krakmolas.'),(44,15,'Nukoškite ir gerai nusausinkite.\nAliejų įkaitinkite iki 170`C.\n'),(45,15,'Kepkite riebaluose, kol gražiai apskrus.'),(46,15,'Išgriebkite ant popierinių servetėlių, pagardinkite druska ir prieskoniais.'),(47,15,'Morkoms tiks malta kalendra, bulvėms - kuminas, '),(48,16,'Į tešlos ruošimo dubenį sudėkite kiaušinius, pieną, miltus, cukrų, druską. Viską sumaišykite plakikliu ir kepkite lietinius.'),(49,16,'Bananą apkepkite svieste. Kai jis įgaus auksinę spalvą, į keptuvę dėkite šiek tiek cukraus.'),(50,16,'Kai cukrus ištirps, įpilkite truputį šviežiai spaustų apelsinų sulčių ir pakepkite dar 5 minutes.\n'),(51,16,'Į blyną dėkite bananą ir apliekite padažu, kuriame jis kepė.');
/*!40000 ALTER TABLE `steps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types`
--

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` VALUES (1,'Gėrimai','/images/drinks.png'),(2,'Kepiniai','/images/pastries.png'),(3,'Desertai','/images/deserts.png'),(4,'Antrieji patiekalai','/images/second_dishes.png'),(5,'Konservuoti patiekalai','/images/canned_meals.png'),(6,'Košės','/images/porridges.png'),(7,'Salotos','/images/salads.png'),(8,'Sriubos','/images/soups.png'),(9,'Sumuštiniai','/images/sandwitches.png'),(10,'Troškiniai','/images/stews.png'),(11,'Uogienės','/images/jams.png'),(12,'Užkandžiai','/images/snacks.png');
/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `units`
--

LOCK TABLES `units` WRITE;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` VALUES (1,'kg.'),(2,'l.'),(3,'vnt.');
/*!40000 ALTER TABLE `units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_fridge`
--

DROP TABLE IF EXISTS `user_fridge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_fridge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_fridge`
--

LOCK TABLES `user_fridge` WRITE;
/*!40000 ALTER TABLE `user_fridge` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_fridge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_products`
--

DROP TABLE IF EXISTS `user_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_products` (
  `product_id` int(11) NOT NULL,
  `user_fridge_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`user_fridge_id`),
  KEY `IDX_5337BE5A4584665A` (`product_id`),
  KEY `IDX_5337BE5A144403BD` (`user_fridge_id`),
  CONSTRAINT `FK_5337BE5A144403BD` FOREIGN KEY (`user_fridge_id`) REFERENCES `user_fridge` (`id`),
  CONSTRAINT `FK_5337BE5A4584665A` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_products`
--

LOCK TABLES `user_products` WRITE;
/*!40000 ALTER TABLE `user_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `facebook_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_access_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_1483A5E9A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-05-27 13:27:01
