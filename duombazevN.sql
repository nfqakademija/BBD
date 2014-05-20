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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Mėsa','/images/meat.png'),(2,'Žuvis','/images/fish.png'),(3,'Pieno produktai','/images/milk.png'),(4,'Grūdinė kultūra','/images/grain.png'),(5,'Riešutai','/images/nuts.png'),(6,'Daržovės','/images/vegetables.png'),(7,'Vaisiai','/images/fruits.png'),(8,'Paukštiena','/images/poultry.png'),(9,'Sojos produktai','/images/soy.png'),(10,'Pagrindinai','/images/main.png');
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
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cooking_time`
--

LOCK TABLES `cooking_time` WRITE;
/*!40000 ALTER TABLE `cooking_time` DISABLE KEYS */;
INSERT INTO `cooking_time` VALUES (1,'00:05:00','time.png',''),(2,'00:20:00','time.png',''),(3,'00:10:00','time.png',''),(4,'00:15:00','time.png',''),(5,'00:25:00','time.png',''),(6,'00:30:00','time.png',''),(7,'00:35:00','time.png',''),(8,'00:40:00','time.png',''),(9,'00:45:00','time.png',''),(10,'00:50:00','time.png',''),(11,'00:55:00','time.png',''),(12,'01:00:00','time.png',''),(13,'01:05:00','time.png','');
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
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `about` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES (1,'Maxina Pramonės','Parduotuvė',54.911369,23.983001,'Maxima.png','Maxima');
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
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,'Kiauliena','1',1),(2,1,'Jautiena','1',1),(3,1,'Aviena','1',1),(4,1,'Veršiena','1',1),(5,8,'Vištiena','2',1),(6,8,'Kalakutiena','2',1),(7,8,'Antiena','2',1),(8,8,'Žąsiena','2',1),(9,2,'Ungurys','3',1),(10,2,'Šamas','3',1),(11,2,'Karpis','3',1),(12,2,'Lašiša','3',1),(13,2,'Ešerys','3',1),(14,2,'Karšis','3',1),(15,2,'Kuoja','3',1),(16,2,'Silkė','3',1),(17,2,'Lydeka','3',1),(18,2,'Menkė','3',1),(19,2,'Tunas','3',1),(20,2,'Vėgėlė','3',1),(21,2,'Stinta','3',1),(22,2,'Plekšnė','3',1),(23,2,'Skumbrė','3',1),(24,7,'Agrastas','4',1),(25,7,'Agurkas','4',1),(26,7,'Agurotis','4',1),(27,7,'Aronija','4',1),(28,7,'Avietė','4',1),(29,7,'Braškė','4',1),(30,7,'Bruknė','4',1),(31,7,'Erškėtis','4',1),(32,7,'Gervuogė','4',1),(33,7,'Gudobelė','4',1),(34,7,'Ieva','4',1),(35,7,'Katuogė','4',1),(36,7,'Kriaušė','4',1),(37,7,'Mėlynė','4',1),(38,7,'Melionas','4',1),(39,7,'Obuolys','4',1),(40,7,'Paprikas','4',1),(41,7,'Pomidotas','4',1),(42,7,'Putinas','4',1),(43,7,'Juodieji serbentai','4',1),(44,7,'Raudonieji serbentai','4',1),(45,7,'Slyva','4',1),(46,7,'spanguolė','4',1),(47,7,'Svarainis','4',1),(48,7,'Šaltalankis','4',1),(49,7,'Šermukšnis','4',1),(50,7,'Šilauogė','4',1),(51,7,'Trešnė','4',1),(52,7,'Vynuogė žalioji','4',1),(53,7,'Vynuogė raudonoji','4',1),(54,7,'Vyšnia','4',1),(55,7,'Žemuogė','4',1),(56,7,'Abrikosas','4',1),(57,7,'Alyvuogė','4',1),(58,7,'Ananasas','4',1),(59,7,'Apelsinas','4',1),(60,7,'Arbūzas','4',1),(61,7,'Avokadas','4',1),(62,7,'Baklažanas','4',1),(63,7,'Bananas','4',1),(64,7,'Citrina','4',1),(65,7,'Datulė','4',1),(66,7,'Figa','4',1),(67,7,'Granatas','4',1),(68,7,'Kivis','4',1),(69,7,'Mandarinas','4',1),(70,7,'Mangas','4',1),(71,7,'Papaja','4',1),(72,7,'Pasiflora','4',1),(73,7,'Persikas','4',1),(74,7,'Persimomas','4',1),(75,7,'Greipfrutas','4',1),(76,6,'Bulvė','5',1),(77,6,'Artišokas','5',1),(78,6,'Rabarbaras','5',1),(79,6,'Baltagūžis kopūstas','5',1),(80,6,'Briuselio kopūstas','5',1),(81,6,'Brokolis','5',1),(82,6,'Garbanotasis kopūstas','5',1),(83,6,'Pekino kopūstas','5',1),(84,6,'Žiedinis kopūstas','5',1),(85,6,'Česnakas','5',1),(86,6,'Poras','5',1),(87,6,'Svogūnas','5',1),(88,6,'Burokėlis','5',1),(89,6,'Morka','5',1),(90,6,'Ridikas','5',1),(91,6,'Ridikėlis','5',1),(92,6,'Ropė','5',1),(93,6,'Salieras','5',1),(94,6,'Rugštynė','5',1),(95,6,'Salotos','5',1),(96,6,'Špinatai','5',1),(97,6,'Pupelės','5',1),(98,6,'Šparaginės pupelės','5',1),(99,6,'Pupos','5',1),(100,6,'Žirniai','5',1),(101,6,'Kukūruzai','5',1),(102,6,'Agurkas','5',1),(103,6,'Agurotis','5',1),(104,6,'Cukinija','5',1),(105,6,'Moliūgas','5',1),(106,6,'Patisonas','5',1),(107,6,'Baklažanas','5',1),(108,6,'Pomidoras','5',1),(109,3,'Pienas','6',2),(110,3,'Grietinė','6',2),(111,3,'Grietinėlė','6',2),(112,3,'Varškė','6',1),(113,3,'Surelis','6',3),(114,3,'Jogurtas','6',2),(115,3,'Pasukos','6',2),(116,3,'Kondensuotas pienas','6',2),(117,3,'Kiaušiniai','6',3),(118,3,'Varškės sūris','6',1),(119,3,'Fermentinis sūris','6',1),(120,3,'Pelėsinis sūris','6',1),(121,3,'Majonezas','6',2),(122,4,'Miltas','7',1),(123,4,'Ryžai','7',1),(124,4,'Grikiai','7',1),(125,4,'Manai','7',1),(126,4,'Žirniai','7',1),(127,4,'Lęšiai','7',1),(128,4,'Dribsniai','7',1),(129,5,'Migdolai','8',1),(130,5,'Žemės riešutai','8',1),(131,5,'Lazdyno riešutai','8',1),(132,5,'Graikiški riešutai','8',1),(133,5,'Pistacijos','8',1),(134,5,'Anakardžio riešutai','8',1),(135,3,'Sviestas','6',1),(136,10,'Aliejus','9',2),(137,10,'Kiaušinai','9',3),(138,10,'Miltai','9',1),(139,10,'Druska','9',1),(140,1,'Briediena','1',1),(141,1,'Šerniena','1',1),(142,1,'Zuikiena','1',1),(143,1,'Tiušiena','1',1),(144,1,'Elniena','1',1);
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
INSERT INTO `recipe_products` VALUES (1,2,10),(5,2,4);
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
INSERT INTO `recipe_property` VALUES (2,1),(2,4),(2,5);
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
  `types_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cookingTime_id` int(11) DEFAULT NULL,
  `mainCookingMethod_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A369E2B5F92F3E70` (`country_id`),
  KEY `IDX_A369E2B54741E894` (`celebration_id`),
  KEY `IDX_A369E2B54EF1D9AC` (`cookingTime_id`),
  KEY `IDX_A369E2B5DC86C9EC` (`mainCookingMethod_id`),
  KEY `IDX_A369E2B5A76ED395` (`user_id`),
  KEY `IDX_A369E2B58EB23357` (`types_id`),
  CONSTRAINT `FK_A369E2B54741E894` FOREIGN KEY (`celebration_id`) REFERENCES `celebration` (`id`),
  CONSTRAINT `FK_A369E2B54EF1D9AC` FOREIGN KEY (`cookingTime_id`) REFERENCES `cooking_time` (`id`),
  CONSTRAINT `FK_A369E2B58EB23357` FOREIGN KEY (`types_id`) REFERENCES `types` (`id`),
  CONSTRAINT `FK_A369E2B5A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_A369E2B5DC86C9EC` FOREIGN KEY (`mainCookingMethod_id`) REFERENCES `main_cooking_method` (`id`),
  CONSTRAINT `FK_A369E2B5F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipes`
--

LOCK TABLES `recipes` WRITE;
/*!40000 ALTER TABLE `recipes` DISABLE KEYS */;
INSERT INTO `recipes` VALUES (1,NULL,'bandymas','nu ir kaip saugo','asd',NULL,NULL,NULL,NULL,NULL),(2,1,'Kiauliena','Kepam','/images/food (15).jpg',1,4,NULL,5,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `steps`
--

LOCK TABLES `steps` WRITE;
/*!40000 ALTER TABLE `steps` DISABLE KEYS */;
INSERT INTO `steps` VALUES (1,1,'Pirmas stepas Nuskusk bulves');
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

-- Dump completed on 2014-05-20 13:54:07
