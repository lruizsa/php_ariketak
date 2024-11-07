-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: 10.14.0.2    Database: mydatabase
-- ------------------------------------------------------
-- Server version	5.5.5-10.9.8-MariaDB-1:10.9.8+maria~ubu2204

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
-- Table structure for table `films`
--

DROP TABLE IF EXISTS `films`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `films` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `img` text DEFAULT NULL,
  `ISAN` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `ISAN` (`ISAN`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `films`
--

LOCK TABLES `films` WRITE;
/*!40000 ALTER TABLE `films` DISABLE KEYS */;
INSERT INTO `films` VALUES (1,'The Matrix',1999,'matrix.jpg','0000-0001-2345-6789-ABCD-0'),(2,'Inception',2010,'inception.jpg','ISAN 0000-0001-2345-6789-ABCD-1'),(3,'Interstellar',2014,'Interstellar.jpg','ISAN 0000-0001-2345-6789-ABCD-2'),(4,'Avengers: Endgame',2019,'AvengersEndgame.jpg','ISAN 0000-0001-2345-6789-ABCD-3'),(5,'The Dark Knight',2008,'TheDarkKnight.jpg','ISAN 0000-0001-2345-6789-ABCD-4'),(6,'Spider-Man: No Way Home',2021,'spiderMan.jpg','ISAN 0000-0001-2345-6789-ABCD-5'),(7,'Iron Man',2008,'ironMan.jpg','ISAN 0000-0001-2345-6789-ABCD-6'),(8,'Wonder Woman',2017,'wonderWoman.jpg','ISAN 0000-0001-2345-6789-ABCD-7'),(9,'Captain America: Civil War',2016,'civilWar.jpg','ISAN 0000-0001-2345-6789-ABCD-8'),(10,'Hulk',2003,'hulk.jpg','ISAN 0000-0001-2345-6789-ABCD-9');
/*!40000 ALTER TABLE `films` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puntuazioa`
--

DROP TABLE IF EXISTS `puntuazioa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `puntuazioa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `nota` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `user_id` (`user_id`,`film_id`),
  KEY `film_id` (`film_id`),
  CONSTRAINT `puntuazioa_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `puntuazioa_ibfk_2` FOREIGN KEY (`film_id`) REFERENCES `films` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puntuazioa`
--

LOCK TABLES `puntuazioa` WRITE;
/*!40000 ALTER TABLE `puntuazioa` DISABLE KEYS */;
INSERT INTO `puntuazioa` VALUES (1,1,1,8.5),(2,1,2,9),(3,2,3,9.5),(4,2,4,7),(5,3,5,8.8),(6,3,6,8),(7,4,7,7.5),(8,5,8,9.2),(9,6,9,9),(10,7,10,7.8),(11,8,1,8),(12,9,3,9.1),(13,10,2,8.9),(14,5,5,8.4),(15,4,9,9.3),(19,11,4,1),(20,11,9,2),(21,11,6,1),(22,11,3,3),(23,11,5,9),(24,11,1,9);
/*!40000 ALTER TABLE `puntuazioa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text DEFAULT NULL,
  `username` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `avatar` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'john.doe@example.com','johndoe','password123','cat.png'),(2,'jane.smith@example.com','janesmith','password456','cat.png'),(3,'peter.parker@example.com','spiderman','password789','cat.png'),(4,'tony.stark@example.com','ironman','passwordIron','cat.png'),(5,'bruce.wayne@example.com','batman','passwordBat','cat.png'),(6,'clark.kent@example.com','superman','passwordSuper','cat.png'),(7,'diana.prince@example.com','wonderwoman','passwordDiana','cat.png'),(8,'natasha.romanoff@example.com','blackwidow','passwordNatasha','cat.png'),(9,'steve.rogers@example.com','captainamerica','passwordSteve','cat.png'),(10,'bruce.banner@example.com','hulk','passwordHulk','cat.png'),(11,'manex@mail.com','manex','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3','manex.png');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'mydatabase'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-18 10:48:35
