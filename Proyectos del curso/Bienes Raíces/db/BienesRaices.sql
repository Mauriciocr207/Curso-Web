CREATE DATABASE  IF NOT EXISTS `bienesraices_crud` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bienesraices_crud`;
-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: bienesraices_crud
-- ------------------------------------------------------
-- Server version	8.0.33

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
-- Table structure for table `propiedades`
--

DROP TABLE IF EXISTS `propiedades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `propiedades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `descripcion` longtext,
  `habitaciones` int DEFAULT NULL,
  `wc` int DEFAULT NULL,
  `estacionamiento` int DEFAULT NULL,
  `creado` date DEFAULT NULL,
  `vendedor_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_propiedades_vendedor_idx` (`vendedor_id`),
  CONSTRAINT `fk_propiedades_vendedores` FOREIGN KEY (`vendedor_id`) REFERENCES `vendedores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propiedades`
--

LOCK TABLES `propiedades` WRITE;
INSERT INTO `propiedades` VALUES (1,'Casa con piscina ',2123.00,'91f62600f3445e01a4ec61cb3b9162b2.jpg','asdasdasdasaddsaddsadddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd',2,1,1,'2023-05-16',1),(2,'Casa con piscina ',12312312.00,'5e6f47cd3899d8701bf20d981a5dda72.jpg','13213213123213211321321312321321132132131232132113213213123213211321321312321321132132131232132113213213123213211321321312321321132132131232132113213213123213211321321312321321132132131232132113213213123213211321321312321321',2,1,1,'2023-05-16',2),(3,'Casa',1232.00,'28d512f0b8f97b464e3e10972eb3156c.jpg','asdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdas',3,2,2,'2023-05-16',1),(4,'Casa con piscina ',111111.00,'e943b24e2479f7a53801a7d215a81ded.jpg','asdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdas',2,2,2,'2023-05-16',1),(5,'Casa con piscina ',232323.00,'24e79f7988881eba5ad6849c21bc296f.jpg','asdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdas',3,3,3,'2023-05-16',2),(6,'asda',231313.00,'aba144ec209ce8a3dffb3acafb6c9eac.jpg','asdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdas',4,4,4,'2023-05-16',1),(7,'Casa con piscina ',123123.00,'c60d17fd7427ecd63a0cc62f0943b384.jpg','asdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdas',2,2,2,'2023-05-16',1),(9,'12321',3123123.00,'4a606c188b4b45ba231660f1bdf2b600.jpg','asdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdasasdasdsadasdsadsadsadasdas',2,2,2,'2023-05-16',1);
/*!40000 ALTER TABLE `propiedades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendedores`
--

DROP TABLE IF EXISTS `vendedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendedores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendedores`
--

LOCK TABLES `vendedores` WRITE;
/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
INSERT INTO `vendedores` VALUES (1,'Juan','de la Torre','1234567890'),(2,'Karen','Perez','1234567890');
/*!40000 ALTER TABLE `vendedores` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-15 23:09:00
