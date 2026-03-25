-- MySQL dump 10.13  Distrib 8.0.44, for Win64 (x86_64)
--
-- Host: localhost    Database: snikei
-- ------------------------------------------------------
-- Server version	8.0.44

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `message` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'trump ','trump@usa.com','oh no web error','2026-03-13 11:08:28'),(2,'biden','biden@usa.com','chao admin','2026-03-13 11:11:21'),(3,'putin','putin@russsian.com','hello word','2026-03-13 11:11:52'),(4,'maiantiem','maiantiem@gmail.com','hehehe','2026-03-21 13:29:27');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `category` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (3,'Stride Sneakers','We have this product in United States warehouse. If destination means you can receive the parcel faster and earlier than expected.','sneakers',450000.00,420000.00,10,'1772990265_6892607b7cd6a58d010644a0_image.png','2026-03-08 17:17:45'),(4,'Flexora Boot','We have this product in United States warehouse. If destination means you can receive the parcel faster and earlier than expected.','boots',530000.00,520000.00,6,'1772991145_68a036b612965524103dc627_f-boot.png','2026-03-08 17:32:25'),(5,'Strideon Boot','We have this product in United States warehouse. If destination means you can receive the parcel faster and earlier than expected.','boots',450000.00,400000.00,6,'1772991323_68926242b7c4f1a30b7667bf_image (2).png','2026-03-08 17:35:23'),(6,'Flexora High Neck','We have this product in United States warehouse. If destination means you can receive the parcel faster and earlier than expected.','high-neck',480000.00,460000.00,12,'1773032991_68a03805667e031c13a3e7cc_f-hight-neck.png','2026-03-09 05:09:51'),(7,'Boltrek Sports Shoe','We have this product in United States warehouse. If destination means you can receive the parcel faster and earlier than expected.','sports-shoe',350000.00,320000.00,10,'1773033057_68a0370a1a953b87bd54b59d_shoe-2.png','2026-03-09 05:10:57'),(8,'Zunk Sports Shoe','We have this product in United States warehouse. If destination means you can receive the parcel faster and earlier than expected.','sports-shoe',340000.00,300000.00,16,'1773033143_689262f1a93361c871877453_image (3).png','2026-03-09 05:12:23'),(9,'Yono Loafers','We have this product in United States warehouse. If destination means you can receive the parcel faster and earlier than expected.','loafers',520000.00,510000.00,20,'1773033437_68a03981177dc57b2dcc9112_loafer-2.png','2026-03-09 05:17:17'),(19,'Orinzo Running Shoe','We have this product in United States warehouse. If destination means you can receive the parcel faster and earlier than expected.','running',420000.00,400000.00,NULL,'689266bef1c36b117d2613a0_image (6).png','2026-03-21 09:45:22'),(20,'Kixen Loafers','We have this product in United States warehouse. If destination means you can receive the parcel faster and earlier than expected.','loafers',490000.00,430000.00,NULL,'68926744f482c2cb2d36317c_image (7).png','2026-03-23 12:18:42'),(21,'Thrivo Oxford Shoe','We have this product in United States warehouse. If destination means you can receive the parcel faster and earlier than expected.','oxford',450000.00,400000.00,NULL,'6892617fb57614fecfd4463c_image (1).png','2026-03-23 12:20:16'),(22,'Grvity Oxford Shoe','We have this product in United States warehouse. If destination means you can receive the parcel faster and earlier than expected.','oxford',420000.00,400000.00,NULL,'68a036160123c0be15af5bb7_oxford-2.png','2026-03-23 12:21:27'),(23,'Eclipse Sneakers','We have this product in United States warehouse. If destination means you can receive the parcel faster and earlier than expected.','sneakers',450000.00,430000.00,NULL,'68a0368f03f08bf146a04fde_eclipse.png','2026-03-23 12:23:04'),(24,'Runx Running Shoe','We have this product in United States warehouse. If destination means you can receive the parcel faster and earlier than expected.','running',480000.00,460000.00,12,'68a0385b89e3d0f08c4744e7_running-2.png','2026-03-24 14:25:43'),(25,'Formal Movo Shoe','We have this product in United States warehouse. If destination means you can receive the parcel faster and earlier than expected.','formal',440000.00,430000.00,12,'68a037b8ebc8cd2d4b3a6578_formal-movo.png','2026-03-24 14:56:43'),(26,'Formal Rovik Shoe','We have this product in United States warehouse. If destination means you can receive the parcel faster and earlier than expected.','formal',550000.00,530000.00,20,'6892663a641afcc78be81df2_image (4).png','2026-03-24 14:57:24');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Trump','donaldtrump@gmail.com','$2y$10$Ud6tno.x13sG105ZdgP.wuuMimz/tVa85ssmYdyLb2lvMkmXt4iZS','user','2026-03-06 22:47:39'),(2,'Putin','putin@gmail.com','$2y$10$f79pWIwVr4wrX9uCGKbbxOsgCmPJMDva/SSmbmIJ6trepXH8sRhrO','user','2026-03-06 22:52:25'),(5,'admin','admin@gmail.com','$2y$10$nLP5mCxioVnGACL13MeaCu8C3btnZ0Y9xglFv8vKPHNJXdQ3Yd6X.','admin','2026-03-09 01:25:36'),(6,'kimjonun','kimjonun@gmail.com','$2y$10$s16qeAFFIJNU5SisDNljsehe9P5..xfGGdc6bmYtkGNByrMibXiXu','user','2026-03-09 01:27:02'),(8,'congphuong','congphuong@gmail.com','$2y$10$jx7G2Ik7V7RDHbeXbzUbBu8E2soyz2npSxmjX595BSCIokTbdsTNe','user','2026-03-09 01:28:42'),(11,'vantoan','vantoan@gmail.com','$2y$10$cInVad9I2vdIz1LTLZdLx.AFgmMuSuYXDRq.slzfhlWftXUk5uykq','user','2026-03-09 01:30:02'),(15,'ducnt05','ducnt05@gmail.com','$2y$10$QbzFQ2KMPes8MF/YwvSo5e9cgrTPIjJ/ryFyYE/pJHRlU2P8tAmna','user','2026-03-09 04:56:12'),(16,'nduc2710','nduc2710@gmail.com','$2y$10$.eZNo4Dmr7vNmWu.cSeNDup7vqFu64kSClTpp6CvEdbLRm6sj6zyu','user','2026-03-10 13:14:32'),(17,'maiantiem','maiantiem@gmail.com','$2y$10$kM0KL5Hpf5sP3UkdqLqg0u2RtwvTL2l1Uye8krBb/1u14yeCqpoHi','user','2026-03-21 06:22:00');
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

-- Dump completed on 2026-03-24 22:59:31
