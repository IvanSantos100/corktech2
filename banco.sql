-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: 186.202.152.176    Database: netiarpainel_sgcork
-- ------------------------------------------------------
-- Server version	5.1.73-rel14.11-log

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
-- Table structure for table `centro_distribuicoes`
--

DROP TABLE IF EXISTS `centro_distribuicoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `centro_distribuicoes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` enum('1','2','3') COLLATE utf8_unicode_ci NOT NULL,
  `prazo_fabrica` int(11) NOT NULL,
  `prazo_nacional` int(11) NOT NULL,
  `prazo_regional` int(11) NOT NULL,
  `valor_base` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `centro_distribuicoes`
--

LOCK TABLES `centro_distribuicoes` WRITE;
/*!40000 ALTER TABLE `centro_distribuicoes` DISABLE KEYS */;
INSERT INTO `centro_distribuicoes` VALUES (1,'CORKTECH','1',90,5,5,0.85,'2017-05-05 22:34:42','2017-05-07 23:54:34'),(2,'Corktech - MEIONORTE','2',90,5,5,0.90,'2017-05-05 22:34:42','2017-05-07 23:51:51'),(3,'Fio Trançado','3',90,5,5,9.00,'2017-05-05 22:34:43','2017-05-08 14:25:56'),(4,'CorkECO','2',90,15,5,0.90,'2017-05-07 23:51:07','2017-05-07 23:51:07');
/*!40000 ALTER TABLE `centro_distribuicoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tamanho` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `espessura` double(8,2) NOT NULL,
  `atacado` double(8,2) NOT NULL,
  `varejo` double(8,2) NOT NULL,
  `granel` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes`
--

LOCK TABLES `classes` WRITE;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
INSERT INTO `classes` VALUES (2,'Divina Floatting - Digital Series - WOOD','1235 x 190 mm',11.00,1.41,1.41,0.24,'2017-05-07 19:09:51','2017-05-07 20:19:22'),(3,'Divina Floatting - Digital Series - STONE','605 x 445mm',11.00,1.62,1.62,0.27,'2017-05-07 20:07:05','2017-05-07 20:19:39'),(4,'Divina Floatting - Cork Series','1235 x 300 mm',11.00,2.22,2.22,0.37,'2017-05-07 20:08:59','2017-05-07 20:18:04'),(5,'Divina Floatting - Vynil Series - WOOD','1250 x 225 mm',11.00,1.68,1.68,0.28,'2017-05-07 20:11:00','2017-05-07 20:19:32'),(6,'Divina Floatting - Vynil Series - STONE','605 x 445mm',11.00,1.62,1.62,0.27,'2017-05-07 20:14:15','2017-05-07 20:18:42'),(7,'Divina Floatting - Wood Series','1235 x 190 mm',11.00,1.41,1.41,0.27,'2017-05-07 20:17:11','2017-05-07 20:18:58'),(8,'Divina GLUE - Digital Series','600 x 450 mm',6.00,11.34,1.62,0.27,'2017-05-07 20:22:21','2017-05-07 20:22:21'),(9,'Divina GLUE - Cork Series - 60x45','600 x 450 mm',6.00,11.34,1.62,0.27,'2017-05-07 20:23:04','2017-05-07 20:23:42'),(10,'Divina GLUE - Cork Series - 60x30','600 x 300 mm',6.00,7.56,1.08,0.18,'2017-05-07 20:25:07','2017-05-07 20:25:07'),(11,'Divina GLUE - Cork Series - 30x30','300 x 300 mm',6.00,7.56,0.54,0.09,'2017-05-07 20:27:13','2017-05-07 20:27:59'),(13,'CMW Floating','915 x 300 mm',4.00,1.65,1.65,0.28,'2017-05-07 20:42:08','2017-05-07 20:42:08'),(14,'CMW GLUE - 60x45','600 x 450 mm',4.00,17.82,1.62,0.27,'2017-05-07 20:44:33','2017-05-07 20:44:33'),(15,'CMW GLUE - 60x30','600 x 300 mm',4.00,11.88,1.08,0.18,'2017-05-07 20:46:56','2017-05-07 20:46:56'),(16,'CMW GLUE - 30x30','300 x 300 mm',4.00,11.34,0.54,0.09,'2017-05-07 20:49:41','2017-05-07 20:49:41'),(17,'WALL ROLLS - Em Rolo - 2mm','5500 x 700 mm',2.00,3.85,3.85,0.35,'2017-05-07 21:07:00','2017-05-07 21:09:28'),(18,'WALL ROLLS - Em Rolo - 0,5mm','10000 x 700 mm',0.50,7.00,7.00,0.35,'2017-05-07 21:08:06','2017-05-07 21:09:37'),(19,'WALL TILES - Em Placas - 60x45','600 x 450 mm',3.00,23.76,2.97,0.27,'2017-05-07 21:11:54','2017-05-07 21:11:54'),(20,'WALL TILES - Em Placas - 60x30','600 x 300 mm',3.00,15.84,1.98,0.18,'2017-05-07 21:13:10','2017-05-07 21:13:10'),(21,'WALL TILES - Em Placas - 30x30','300 x 300 mm',3.00,15.84,0.99,0.09,'2017-05-07 21:15:11','2017-05-07 21:15:11'),(22,'Dinamic Cork - 3D - 60x30','600 x 300 mm',8.00,4.50,0.18,0.18,'2017-05-07 21:19:02','2017-05-07 21:22:39'),(23,'Dinamic Cork - 3D - 90x60','900 x 600 mm',8.00,6.48,0.54,0.54,'2017-05-07 21:23:29','2017-05-07 21:23:29'),(24,'Corkinsu - Placas 10mm','1000 x 500mm',10.00,10.00,0.50,0.50,'2017-05-07 21:28:42','2017-05-07 21:28:42'),(25,'Corkinsu - Placas 20mm','1000 x 500mm',20.00,7.50,0.50,0.50,'2017-05-07 21:29:22','2017-05-07 21:29:22'),(26,'Corkinsu - Placas 30mm','1000 x 500mm',30.00,5.00,0.50,0.50,'2017-05-07 21:32:17','2017-05-07 21:32:17'),(27,'Corkinsu - Placas 40mm','1000 x 500mm',40.00,4.00,0.50,0.50,'2017-05-07 21:33:13','2017-05-07 21:33:13'),(28,'Corkinsu - Placas 50mm','1000 x 500mm',50.00,3.00,0.50,0.50,'2017-05-07 21:34:07','2017-05-07 21:34:07'),(29,'Corkinsu - Placas 60mm','1000 x 500mm',60.00,2.50,0.50,0.50,'2017-05-07 21:34:44','2017-05-07 21:34:44'),(30,'Underlay 15MS - Manta 1,6mm/10','10000 x 1000 mm',1.60,10.00,10.00,0.10,'2017-05-07 21:37:02','2017-05-07 21:41:35'),(31,'Underlay 15MS - Manta 1,8mm/10','10000 x 1000 mm',1.80,10.00,10.00,0.10,'2017-05-07 21:38:54','2017-05-07 21:41:43'),(32,'Underlay 15MS - Manta 2mm/10','10000 x 1000 mm',2.00,10.00,10.00,0.10,'2017-05-07 21:39:53','2017-05-07 21:41:51'),(33,'Underlay 15MS - Manta 2mm/20','20000 x 1000 mm',2.00,20.00,20.00,0.10,'2017-05-07 21:41:08','2017-05-07 21:44:00'),(34,'Underlay 15MS - Manta 2mm/30','30000 x 1000 mm',2.00,30.00,30.00,0.10,'2017-05-07 21:43:05','2017-05-07 21:44:09'),(35,'Underlay 15MS - Manta 2,8mm/10','10000 x 1000 mm',2.80,10.00,10.00,0.10,'2017-05-07 21:43:52','2017-05-07 21:43:52'),(36,'Underlay 15MS - Manta 3mm/10','10000 x 1000 mm',3.00,10.00,10.00,0.10,'2017-05-07 21:45:15','2017-05-07 21:45:15'),(37,'Underlay 15MS - Manta 3,8mm/10','10000 x 1000 mm',3.80,10.00,10.00,0.10,'2017-05-07 21:46:54','2017-05-07 21:46:54'),(38,'Underlay 15MS - Manta 4mm/10','10000 x 1000 mm',4.00,10.00,10.00,0.10,'2017-05-07 22:32:34','2017-05-07 22:32:34'),(39,'Underlay 15MS - Manta 4mm/15','15000 x 1000 mm',4.00,15.00,15.00,0.10,'2017-05-07 22:33:23','2017-05-07 22:33:23'),(40,'Underlay 15MS - Manta 5mm/10','10000 x 1000 mm',5.00,10.00,10.00,0.10,'2017-05-07 22:34:28','2017-05-07 22:34:28'),(41,'Underlay 15MS - Manta 6mm/10','10000 x 1000 mm',6.00,10.00,10.00,0.10,'2017-05-07 22:35:38','2017-05-07 22:35:38'),(42,'Underlay 15MS - Manta 10mm/10','10000 x 1000 mm',10.00,10.00,10.00,0.10,'2017-05-07 22:36:10','2017-05-07 22:36:22'),(43,'Underlay 15MS - Manta 12mm/10','10000 x 1000 mm',12.00,8.00,8.00,0.10,'2017-05-07 22:36:46','2017-05-07 22:37:29'),(44,'Underlay 40BR - 2mm/10','10000 x 1000 mm',2.00,10.00,10.00,0.10,'2017-05-07 22:38:03','2017-05-07 22:38:03'),(45,'Underlay 40BR - 2mm/20','20000 x 1000 mm',2.00,20.00,20.00,0.10,'2017-05-07 22:38:37','2017-05-07 22:38:37'),(46,'Underlay 40BR - 2mm/30','30000 x 1000 mm',2.00,30.00,30.00,0.10,'2017-05-07 22:39:39','2017-05-07 22:39:39'),(47,'Underlay 40BR - 2,8mm/10','10000 x 1000 mm',2.80,10.00,10.00,0.10,'2017-05-07 22:41:50','2017-05-07 22:41:50'),(48,'Underlay 40BR - 3mm/10','10000 x 1000 mm',3.00,10.00,10.00,0.10,'2017-05-07 22:42:30','2017-05-07 22:42:30'),(49,'Underlay 40BR - 3,8mm/10','10000 x 1000 mm',3.80,10.00,10.00,0.10,'2017-05-07 22:43:48','2017-05-07 22:43:48'),(50,'Underlay 40BR - 4mm/10','10000 x 1000 mm',4.00,10.00,10.00,0.10,'2017-05-07 22:44:37','2017-05-07 22:44:37'),(51,'Underlay 40BR - 4mm/15','15000 x 1000 mm',4.00,15.00,15.00,0.10,'2017-05-07 22:45:11','2017-05-07 22:45:11'),(52,'Underlay 40BR - 5mm/12','12000 x 1000 mm',5.00,12.00,12.00,0.10,'2017-05-07 22:48:20','2017-05-07 22:48:20'),(53,'Underlay 40BR - 6mm/10','10000 x 1000 mm',6.00,10.00,10.00,0.10,'2017-05-07 22:48:56','2017-05-07 22:48:56'),(54,'Tecido - Cork n\'roll - 0,8mm','25000 x 1400 mm',0.80,35.00,0.10,0.10,'2017-05-07 22:58:07','2017-05-07 22:59:25'),(55,'Tecido - Cork n\'roll - 1,2mm','25000 x 1400 mm',1.20,35.00,0.10,0.10,'2017-05-07 22:59:17','2017-05-07 22:59:17'),(56,'Indefinido','1',1.00,1.00,1.00,1.00,'2017-05-07 23:50:24','2017-05-07 23:50:24');
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` enum('1','2') COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `documento` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `endereco` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bairro` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cidade` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uf` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cep` int(8) DEFAULT NULL,
  `senha` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsavel` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fone` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clientes_documento_unique` (`documento`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (2,'1','Carlos Silva Filho','84887435304','Estrada da Maioba','Cond. Maraville','São Luís','MA',65054040,'$2y$10$yZBzcNrpIMM1LnyKtWAD4.rnyI2iWIXDYAfKkWTvj1VLkbjM2I5lq','Carlos Silva Filho','981140090','981140090','2017-05-08 13:39:47','2017-05-08 13:55:08'),(3,'2','Corkline Industria e Comercio','26324797000176','R CINCO, N 12','Bairro Cohapam','São Luís','MA',65062710,'$2y$10$vkQRllsQC/v6yZc4fFZ3oe3HQ.61byWheQcN6hoTvHT5dIUWEL5y.','Carlos Silva Filho','981140090','981140090','2017-05-08 13:40:42','2017-05-08 13:40:42'),(13,'2','Radio e Tv Difusora','06275598000108','avenida Camboa n120 bairro camboa',NULL,'São Luis','Maranhão',65099110,'$2y$10$scGJ/UHY/m6UiUs0I1TBC.SL7x24Kb7hIyB8qB5S9iRpKZdgTXTNC',NULL,NULL,NULL,'2017-07-24 21:31:37','2017-07-24 21:31:37'),(14,'2','Rca Empreendimentos Alimenticios - Botiquim','11343221000189','Av Mario Meireles  numero 04 rua 22 Ponta d Areia',NULL,'São Luis','Maranhão',65077640,'$2y$10$T06ytoaB.LI0AE0icVyuk.ReUXKP7mVq/dTrxaVRyZLDSFhJ0lB/2','Carol Azevedo',NULL,NULL,'2017-07-24 21:34:22','2017-07-24 21:34:22'),(5,'1','alexsandro de jesus caldas coelho','33100314387','rua jupiter, 13 ed jose goncalo apto 1302','renascenca II','sao luis','ma',65075045,'$2y$10$IYPLT6u55YT0hvws80Lawuk.AOiTsP37hthzL6SqXwNUKfr.FDpGi','alex','33031374','991167640','2017-05-08 13:56:22','2017-05-08 13:56:22'),(8,'2','G S C DE BRITO - ME (Fio Trançado Ambientação)','15711316000169','Avenida dos Holandeses, 01','Quadra 01, Estrada da Raposa, Lote Central','Sao José de Ribamar','MA',65110000,'$2y$10$//fpjhypMnt4/qG52BbIle1r9B8N3EPy4KYh/k1kRGxkyiSu2fM/y','Paraguaçu','00000000000','00000000000','2017-07-17 21:19:28','2017-07-17 21:20:17'),(9,'2','UNIVERSIDADE CEUMA','23689763000359','Rua Josué Montello, 01','Renascença','São Luís','MA',65075120,'$2y$10$x/mZePgabzoCkbIj1KYMge5y3XAPp9poL320duaAF2ksmCcTLNSb2','CEUMA','00000000000','00000000000','2017-07-17 21:24:08','2017-07-17 21:24:08'),(10,'2','ABBEVILLE HOTEIS E TURISMO LTDA','04875854000172',NULL,NULL,'São Luís','MA',NULL,'$2y$10$e9Bcll5lbwdhE/.gLjS/UeR7x6SpZBpn1Q3Xtpk.B6rs3D.b0RlLu',NULL,'00000000000',NULL,'2017-07-24 20:50:03','2017-07-24 20:50:03'),(11,'2','Memorial maranhense Ltda','07740772000109',NULL,NULL,NULL,NULL,NULL,'$2y$10$bGX3NtNUw5gM5IESe9XOKeMXNk963yr5MigSPvikEUQ58kZWWUxzW',NULL,'00000000000',NULL,'2017-07-24 20:56:45','2017-07-24 20:56:45'),(12,'2','SL PARTICIPAÇÕES LTDA','14480252000170',NULL,NULL,NULL,NULL,NULL,'$2y$10$3ApqKIYaAngewIKfDWgdq.1EAefcLUwaRGG.w0OmY8op3J500QfkC',NULL,'00000000000',NULL,'2017-07-24 21:06:24','2017-07-24 21:06:24'),(15,'2','L C Melos Sales','20424960000196','av são luis rei de frança numero 04 quadra 09',NULL,'São Luis','Maranhão',65065470,'$2y$10$fGJLkt0tUAXflUQkzZQ0UOqrERbnsWVPc6EOsMhomkevN/DSMn15u','Atenas Bistro',NULL,NULL,'2017-07-24 21:38:58','2017-07-24 21:38:58');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estampas`
--

DROP TABLE IF EXISTS `estampas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estampas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `estampa` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estampas`
--

LOCK TABLES `estampas` WRITE;
/*!40000 ALTER TABLE `estampas` DISABLE KEYS */;
INSERT INTO `estampas` VALUES (1,'AMBER 3',NULL,'2017-05-06 16:22:20','2017-05-08 00:17:57'),(2,'OPAL',NULL,'2017-05-07 23:15:29','2017-05-08 00:09:46'),(3,'Kangaroo',NULL,'2017-05-08 00:20:19','2017-05-08 00:20:19'),(4,'Corkinsu',NULL,'2017-05-08 17:09:15','2017-05-08 17:09:15'),(5,'Agate',NULL,'2017-05-08 17:26:12','2017-05-08 17:26:12'),(7,'Antelope',NULL,'2017-05-08 17:31:02','2017-05-08 17:31:02'),(8,'Horse',NULL,'2017-05-08 17:34:02','2017-05-08 17:34:02'),(9,'D Black Armani',NULL,'2017-05-08 17:44:41','2017-05-08 17:44:41'),(10,'D Carrara Estatuario',NULL,'2017-05-08 17:46:59','2017-05-08 17:46:59'),(11,'Quartz',NULL,'2017-05-08 17:53:44','2017-05-08 17:53:44'),(12,'Thyme Dark',NULL,'2017-05-08 17:56:45','2017-05-08 17:56:45'),(13,'Travertino Serrado',NULL,'2017-05-08 17:59:54','2017-05-08 17:59:54'),(14,'Opal',NULL,'2017-05-08 18:02:52','2017-05-08 18:02:52'),(15,'Quartz Brow',NULL,'2017-05-08 18:05:01','2017-05-08 18:05:01'),(16,'Amber',NULL,'2017-05-08 18:07:24','2017-05-08 18:07:24'),(17,'Pearl',NULL,'2017-05-08 18:11:34','2017-05-08 18:11:34'),(18,'Melon',NULL,'2017-05-08 18:14:46','2017-05-08 18:14:46'),(19,'Pear Black',NULL,'2017-05-08 18:17:43','2017-05-08 18:17:43'),(20,'Leather Col. Exotic II',NULL,'2017-05-08 18:21:28','2017-05-08 18:21:28'),(21,'Coconut White',NULL,'2017-05-08 18:23:44','2017-05-08 18:23:44'),(22,'Vera',NULL,'2017-05-08 18:27:13','2017-05-08 18:27:13'),(23,'Chic List Poisedon C',NULL,'2017-05-08 18:31:16','2017-05-08 18:31:16'),(24,'Gold',NULL,'2017-05-08 18:35:39','2017-05-08 18:35:39'),(25,'Silver',NULL,'2017-05-08 18:37:38','2017-05-08 18:37:38'),(26,'Chic List Cement',NULL,'2017-05-08 18:42:19','2017-05-08 18:42:19'),(27,'Cherries',NULL,'2017-05-08 18:44:19','2017-05-08 18:44:19'),(28,'Orange',NULL,'2017-05-08 18:45:58','2017-05-08 18:45:58'),(29,'Diamond',NULL,'2017-05-08 18:48:55','2017-05-08 18:48:55'),(30,'Waves',NULL,'2017-05-08 18:51:17','2017-05-08 18:51:17'),(31,'15 ms',NULL,'2017-05-08 18:54:52','2017-05-08 18:54:52'),(32,'40BR',NULL,'2017-05-08 18:58:35','2017-05-08 18:58:35'),(33,'Vera Brown',NULL,'2017-05-11 18:03:09','2017-05-11 18:03:09'),(34,'Vera Silver',NULL,'2017-05-11 18:09:16','2017-05-11 18:09:16'),(35,'Vera Cream',NULL,'2017-05-11 18:12:44','2017-05-11 18:12:44'),(36,'Elizabeth',NULL,'2017-05-11 18:16:48','2017-05-11 18:16:48'),(38,'Gabrielle Brown',NULL,'2017-05-11 18:22:31','2017-05-11 18:22:31'),(39,'Mary',NULL,'2017-05-11 18:24:56','2017-05-11 18:24:56'),(40,'Melon Brown',NULL,'2017-05-11 18:29:50','2017-05-11 18:29:50'),(41,'Dourado',NULL,'2017-05-11 18:37:23','2017-05-11 18:37:23'),(42,'Bronze',NULL,'2017-05-11 18:47:43','2017-05-11 18:47:43');
/*!40000 ALTER TABLE `estampas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estoques`
--

DROP TABLE IF EXISTS `estoques`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estoques` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lote` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `valor` double(8,2) NOT NULL,
  `quantidade` double NOT NULL,
  `centrodistribuicao_id` int(10) unsigned NOT NULL,
  `produto_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `estoques_centrodistribuicao_id_foreign` (`centrodistribuicao_id`),
  KEY `estoques_produto_id_foreign` (`produto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=120 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estoques`
--

LOCK TABLES `estoques` WRITE;
/*!40000 ALTER TABLE `estoques` DISABLE KEYS */;
INSERT INTO `estoques` VALUES (1,'1',167.27,71.28,1,3,'2017-07-24 22:20:10','2017-07-24 22:20:10'),(2,'1',42.13,89,1,4,'2017-07-24 22:20:10','2017-07-24 22:54:58'),(3,'1',84.25,109,1,5,'2017-07-24 22:20:10','2017-07-24 22:54:53'),(4,'1',126.38,40,1,6,'2017-07-24 22:20:10','2017-07-24 22:54:53'),(5,'1',163.55,65,1,7,'2017-07-24 22:20:10','2017-07-24 22:54:53'),(6,'1',210.63,35,1,8,'2017-07-24 22:20:10','2017-07-24 22:54:52'),(7,'1',167.27,69.66,1,10,'2017-07-24 22:20:10','2017-07-24 22:54:51'),(8,'1',240.86,66.42,1,11,'2017-07-24 22:20:10','2017-07-24 22:54:53'),(9,'1',321.15,45.37,1,12,'2017-07-24 22:20:10','2017-07-24 22:54:53'),(10,'1',338.99,45.37,1,13,'2017-07-24 22:20:10','2017-07-24 22:54:53'),(11,'1',343.45,25.53,1,14,'2017-07-24 22:20:10','2017-07-24 22:54:53'),(12,'1',354.60,21.06,1,15,'2017-07-24 22:20:10','2017-07-24 22:54:53'),(13,'1',354.60,21.06,1,16,'2017-07-24 22:20:10','2017-07-24 22:54:51'),(14,'1',363.52,66.42,1,17,'2017-07-24 22:20:10','2017-07-24 22:54:53'),(15,'1',501.80,28.2,1,18,'2017-07-24 22:20:10','2017-07-24 22:54:52'),(16,'1',501.80,44.82,1,19,'2017-07-24 22:20:10','2017-07-24 22:54:52'),(17,'1',515.18,18.87,1,20,'2017-07-24 22:20:10','2017-07-24 22:54:52'),(18,'1',546.40,1.11,1,21,'2017-07-24 22:20:10','2017-07-24 22:54:52'),(19,'1',557.55,18.87,1,22,'2017-07-24 22:20:10','2017-07-24 22:54:53'),(112,'1',408.87,35,2,23,'2017-07-24 22:54:53','2017-07-24 22:54:53'),(21,'1',490.64,29.47,1,24,'2017-07-24 22:20:10','2017-07-24 22:54:53'),(22,'1',557.55,32.45,1,25,'2017-07-24 22:20:10','2017-07-24 22:54:53'),(23,'1',557.55,12.6,1,26,'2017-07-24 22:20:10','2017-07-24 22:54:53'),(24,'1',185.85,7.7,1,27,'2017-07-24 22:20:10','2017-07-24 22:54:53'),(25,'1',235.41,5.58,1,28,'2017-07-24 22:20:10','2017-07-24 22:54:53'),(100,'1',235.41,21,2,29,'2017-07-24 22:54:53','2017-07-24 22:54:53'),(27,'1',247.80,15.4,1,30,'2017-07-24 22:20:10','2017-07-24 22:54:53'),(28,'1',272.58,15.4,1,31,'2017-07-24 22:20:10','2017-07-24 22:54:53'),(29,'1',272.58,28,1,32,'2017-07-24 22:20:10','2017-07-24 22:54:53'),(30,'1',309.75,14,1,33,'2017-07-24 22:20:10','2017-07-24 22:54:51'),(88,'1',322.14,19.25,2,34,'2017-07-24 22:54:53','2017-07-24 22:54:53'),(32,'1',322.14,3.85,1,35,'2017-07-24 22:20:10','2017-07-24 22:54:53'),(33,'1',1059.35,9.9,1,36,'2017-07-24 22:20:10','2017-07-24 22:54:53'),(34,'1',1304.67,11.7,1,37,'2017-07-24 22:20:10','2017-07-24 22:54:53'),(113,'1',31.22,257,2,38,'2017-07-24 22:54:53','2017-07-24 23:22:45'),(36,'1',39.65,20,1,39,'2017-07-24 22:20:10','2017-07-24 22:54:53'),(37,'1',104.08,36,1,40,'2017-07-24 22:20:10','2017-07-24 22:54:53'),(93,'1',2065.00,5,2,56,'2017-07-24 22:54:53','2017-07-24 22:54:53'),(39,'1',137.67,5,1,57,'2017-07-24 22:20:10','2017-07-24 22:20:10'),(40,'1',1652.00,2,1,58,'2017-07-24 22:20:10','2017-07-24 22:20:10'),(41,'2',42.13,319,1,4,'2017-07-24 22:20:19','2017-07-24 22:54:53'),(42,'2',84.25,210,1,5,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(43,'2',126.38,100,1,6,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(44,'2',210.63,30,1,8,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(45,'2',167.27,53.46,1,10,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(46,'2',321.15,16.5,1,12,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(47,'2',343.45,34.02,1,14,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(48,'2',363.52,34.02,1,17,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(49,'2',501.80,16.92,1,18,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(50,'2',546.40,26.64,1,21,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(51,'2',408.87,35,1,23,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(52,'2',557.55,35,1,26,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(53,'2',185.85,38.5,1,27,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(54,'2',235.41,79.2,1,28,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(55,'2',247.80,15.4,1,30,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(56,'2',272.58,15.4,1,31,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(57,'2',272.58,42,1,32,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(58,'2',31.22,3040,1,38,'2017-07-24 22:20:19','2017-07-24 22:54:58'),(59,'2',39.65,250,1,39,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(60,'2',104.08,200,1,40,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(61,'2',260.19,23.76,1,41,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(62,'2',284.97,23.76,1,42,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(63,'2',260.19,23.76,1,43,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(64,'2',284.97,23.76,1,44,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(65,'2',247.87,11.88,1,45,'2017-07-24 22:20:19','2017-07-24 22:54:58'),(66,'2',235.41,31.68,1,46,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(67,'2',334.53,11.55,1,47,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(68,'2',297.36,26.95,1,48,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(69,'2',168.50,40,1,49,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(70,'2',260.19,31.68,1,50,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(71,'2',16.65,350,1,51,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(72,'2',20.82,400,1,52,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(73,'2',41.63,300,1,53,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(74,'2',52.04,1300,1,54,'2017-07-24 22:20:19','2017-07-24 22:54:58'),(75,'2',62.45,800,1,55,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(76,'2',2065.00,7,1,56,'2017-07-24 22:20:19','2017-07-24 22:54:58'),(77,'2',1652.00,2,1,58,'2017-07-24 22:20:19','2017-07-24 22:20:19'),(78,'1',167.27,1.62,2,10,'2017-07-24 22:54:51','2017-07-24 22:54:51'),(79,'1',354.60,1.62,2,16,'2017-07-24 22:54:51','2017-07-24 22:54:51'),(80,'1',309.75,7,2,33,'2017-07-24 22:54:51','2017-07-24 22:54:51'),(81,'1',210.63,1,2,8,'2017-07-24 22:54:52','2017-07-24 22:54:52'),(82,'1',501.80,3.76,2,18,'2017-07-24 22:54:52','2017-07-24 23:17:46'),(83,'1',501.80,0.54,2,19,'2017-07-24 22:54:52','2017-07-24 22:54:52'),(84,'1',546.40,25.53,2,21,'2017-07-24 22:54:52','2017-07-24 22:54:52'),(85,'1',515.18,1.11,2,20,'2017-07-24 22:54:52','2017-07-24 22:54:52'),(86,'1',1304.67,0.18,2,37,'2017-07-24 22:54:53','2017-07-24 22:54:53'),(87,'1',1059.35,1.98,2,36,'2017-07-24 22:54:53','2017-07-24 22:54:53'),(89,'1',557.55,1.11,2,22,'2017-07-24 22:54:53','2017-07-24 22:54:53'),(90,'1',84.25,31,2,5,'2017-07-24 22:54:53','2017-07-24 23:20:28'),(92,'1',163.55,5,2,7,'2017-07-24 22:54:53','2017-07-24 22:54:53'),(94,'1',363.52,1.62,2,17,'2017-07-24 22:54:53','2017-07-24 22:54:53'),(95,'1',354.60,1.62,2,15,'2017-07-24 22:54:53','2017-07-24 22:54:53'),(96,'1',338.99,0.83,2,13,'2017-07-24 22:54:53','2017-07-24 22:54:53'),(97,'1',240.86,1.62,2,11,'2017-07-24 22:54:53','2017-07-24 22:54:53'),(98,'1',343.45,1.11,2,14,'2017-07-24 22:54:53','2017-07-24 22:54:53'),(99,'1',321.15,0.83,2,12,'2017-07-24 22:54:53','2017-07-24 22:54:53'),(101,'1',185.85,11.55,2,27,'2017-07-24 22:54:53','2017-07-24 22:54:53'),(102,'1',235.41,26.1,2,28,'2017-07-24 22:54:53','2017-07-24 22:54:53'),(103,'1',247.80,3.85,2,30,'2017-07-24 22:54:53','2017-07-24 22:54:53'),(104,'1',322.14,15.4,2,35,'2017-07-24 22:54:53','2017-07-24 22:54:53'),(105,'1',272.58,7,2,32,'2017-07-24 22:54:53','2017-07-24 22:54:53'),(106,'1',272.58,3.85,2,31,'2017-07-24 22:54:53','2017-07-24 22:54:53'),(107,'1',104.08,44,2,40,'2017-07-24 22:54:53','2017-07-24 22:54:53'),(108,'1',39.65,180,2,39,'2017-07-24 22:54:53','2017-07-24 22:54:53'),(109,'1',557.55,22.4,2,26,'2017-07-24 22:54:53','2017-07-24 22:54:53'),(110,'1',490.64,5.53,2,24,'2017-07-24 22:54:53','2017-07-24 22:54:53'),(111,'1',557.55,1.4,2,25,'2017-07-24 22:54:53','2017-07-24 23:17:46'),(114,'2',42.13,1,2,4,'2017-07-24 22:54:53','2017-07-24 22:54:53'),(115,'2',2065.00,2,2,56,'2017-07-24 22:54:58','2017-07-24 22:54:58'),(116,'2',247.87,19.8,2,45,'2017-07-24 22:54:58','2017-07-24 22:54:58'),(118,'2',31.22,160,2,38,'2017-07-24 22:54:58','2017-07-24 22:54:58'),(119,'1',42.13,1,2,4,'2017-07-24 22:54:58','2017-07-24 22:54:58');
/*!40000 ALTER TABLE `estoques` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itens_pedidos`
--

DROP TABLE IF EXISTS `itens_pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itens_pedidos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pedido_id` int(10) unsigned NOT NULL,
  `produto_id` int(10) unsigned NOT NULL,
  `quantidade` double(8,2) NOT NULL,
  `preco` double(8,2) NOT NULL,
  `prazoentrega` INT(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lote` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `itens_pedidos_pedido_id_foreign` (`pedido_id`),
  KEY `itens_pedidos_produto_id_foreign` (`produto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=182 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itens_pedidos`
--

LOCK TABLES `itens_pedidos` WRITE;
/*!40000 ALTER TABLE `itens_pedidos` DISABLE KEYS */;
INSERT INTO `itens_pedidos` VALUES (156,1,4,90.00,42.13,'2017-01-01',NULL,NULL,NULL),(3,1,5,150.00,84.25,'2017-01-01',NULL,NULL,NULL),(7,1,6,50.00,126.38,'01',NULL,NULL,NULL),(5,1,8,36.00,210.63,'01',NULL,NULL,NULL),(6,1,22,19.98,557.55,'01',NULL,NULL,NULL),(8,1,7,70.00,163.55,'01',NULL,NULL,NULL),(9,1,20,19.98,515.18,'01',NULL,NULL,NULL),(10,1,14,26.64,343.45,'01',NULL,NULL,NULL),(11,1,21,26.64,546.40,'01',NULL,NULL,NULL),(12,1,18,39.48,501.80,'01',NULL,NULL,NULL),(13,1,19,45.36,501.80,'01',NULL,NULL,NULL),(14,1,12,46.20,321.15,'01',NULL,NULL,NULL),(15,1,13,46.20,338.99,'01',NULL,NULL,NULL),(16,1,11,68.04,240.86,'01',NULL,NULL,NULL),(17,1,17,68.04,363.52,'01',NULL,NULL,NULL),(18,1,15,22.68,354.60,'01',NULL,NULL,NULL),(19,1,16,22.68,354.60,'01',NULL,NULL,NULL),(20,1,3,71.28,167.27,'01',NULL,NULL,NULL),(161,5,56,1.00,2065.00,'01',NULL,NULL,2),(158,1,10,71.28,167.27,'01',NULL,NULL,NULL),(23,1,26,35.00,557.55,'01',NULL,NULL,NULL),(24,1,23,35.00,408.87,'01',NULL,NULL,NULL),(25,1,25,35.00,557.55,'01',NULL,NULL,NULL),(26,1,24,35.00,490.64,'01',NULL,NULL,NULL),(27,1,28,31.68,235.41,'01',NULL,NULL,NULL),(28,1,34,19.25,322.14,'01',NULL,NULL,NULL),(29,1,30,19.25,247.80,'01',NULL,NULL,NULL),(30,1,31,19.25,272.58,'01',NULL,NULL,NULL),(31,1,27,19.25,185.85,'01',NULL,NULL,NULL),(32,1,35,19.25,322.14,'01',NULL,NULL,NULL),(33,1,29,21.00,235.41,'01',NULL,NULL,NULL),(34,1,32,35.00,272.58,'01',NULL,NULL,NULL),(35,1,33,21.00,309.75,'01',NULL,NULL,NULL),(36,1,36,11.88,1059.35,'01',NULL,NULL,NULL),(37,1,37,11.88,1304.67,'01',NULL,NULL,NULL),(163,5,36,0.18,1059.35,'01',NULL,NULL,1),(39,1,40,80.00,104.08,'01',NULL,NULL,NULL),(40,1,39,200.00,39.65,'01',NULL,NULL,NULL),(41,2,4,320.00,42.13,'01',NULL,NULL,NULL),(42,2,5,210.00,84.25,'01',NULL,NULL,NULL),(44,2,6,100.00,126.38,'01',NULL,NULL,NULL),(45,2,8,30.00,210.63,'01',NULL,NULL,NULL),(46,2,21,26.64,546.40,'01',NULL,NULL,NULL),(47,2,18,16.92,501.80,'01',NULL,NULL,NULL),(48,2,12,16.50,321.15,'01',NULL,NULL,NULL),(49,2,14,34.02,343.45,'01',NULL,NULL,NULL),(50,2,17,34.02,363.52,'01',NULL,NULL,NULL),(51,2,10,53.46,167.27,'01',NULL,NULL,NULL),(52,2,26,35.00,557.55,'01',NULL,NULL,NULL),(53,2,23,35.00,408.87,'01',NULL,NULL,NULL),(54,2,28,79.20,235.41,'01',NULL,NULL,NULL),(55,2,41,23.76,260.19,'01',NULL,NULL,NULL),(56,2,42,23.76,284.97,'01',NULL,NULL,NULL),(57,2,43,23.76,260.19,'01',NULL,NULL,NULL),(58,2,44,23.76,284.97,'01',NULL,NULL,NULL),(59,2,45,31.68,247.87,'01',NULL,NULL,NULL),(60,2,46,31.68,235.41,'01',NULL,NULL,NULL),(61,2,47,11.55,334.53,'01',NULL,NULL,NULL),(62,2,30,15.40,247.80,'01',NULL,NULL,NULL),(63,2,31,15.40,272.58,'01',NULL,NULL,NULL),(64,2,48,26.95,297.36,'01',NULL,NULL,NULL),(65,2,27,38.50,185.85,'01',NULL,NULL,NULL),(66,2,32,42.00,272.58,'01',NULL,NULL,NULL),(67,2,38,3200.00,31.22,'01',NULL,NULL,NULL),(68,2,40,200.00,104.08,'01',NULL,NULL,NULL),(69,2,39,250.00,39.65,'01',NULL,NULL,NULL),(70,2,49,40.00,168.50,'01',NULL,NULL,NULL),(71,2,50,31.68,260.19,'01',NULL,NULL,NULL),(72,2,51,350.00,16.65,'01',NULL,NULL,NULL),(73,2,52,400.00,20.82,'01',NULL,NULL,NULL),(74,2,53,300.00,41.63,'01',NULL,NULL,NULL),(75,2,54,1320.00,52.04,'01',NULL,NULL,NULL),(76,2,55,800.00,62.45,'01',NULL,NULL,NULL),(77,1,57,5.00,137.67,'01',NULL,NULL,NULL),(78,1,58,2.00,1652.00,'01',NULL,NULL,NULL),(79,1,56,5.00,2065.00,'01',NULL,NULL,NULL),(80,2,58,2.00,1652.00,'01',NULL,NULL,NULL),(81,2,56,9.00,2065.00,'01',NULL,NULL,NULL),(107,3,10,1.62,167.27,'01',NULL,NULL,1),(112,3,16,1.62,354.60,'01',NULL,NULL,1),(127,3,33,7.00,309.75,'01',NULL,NULL,1),(125,3,8,1.00,210.63,'01',NULL,NULL,1),(118,3,18,11.28,501.80,'01',NULL,NULL,1),(119,3,19,0.54,501.80,'01',NULL,NULL,1),(117,3,21,25.53,546.40,'01',NULL,NULL,1),(116,3,20,1.11,515.18,'01',NULL,NULL,1),(121,3,37,0.18,1304.67,'01',NULL,NULL,1),(120,3,36,1.98,1059.35,'01',NULL,NULL,1),(126,3,34,19.25,322.14,'01',NULL,NULL,1),(115,3,22,1.11,557.55,'01',NULL,NULL,1),(122,3,5,41.00,84.25,'01',NULL,NULL,1),(123,3,6,10.00,126.38,'01',NULL,NULL,1),(124,3,7,5.00,163.55,'01',NULL,NULL,1),(151,3,56,5.00,2065.00,'01',NULL,NULL,1),(113,3,17,1.62,363.52,'01',NULL,NULL,1),(111,3,15,1.62,354.60,'01',NULL,NULL,1),(109,3,13,0.83,338.99,'01',NULL,NULL,1),(110,3,11,1.62,240.86,'01',NULL,NULL,1),(152,3,14,1.11,343.45,'01',NULL,NULL,1),(108,3,12,0.83,321.15,'01',NULL,NULL,1),(128,3,29,21.00,235.41,'01',NULL,NULL,1),(129,3,27,11.55,185.85,'01',NULL,NULL,1),(130,3,28,26.10,235.41,'01',NULL,NULL,1),(131,3,30,3.85,247.80,'01',NULL,NULL,1),(132,3,35,15.40,322.14,'01',NULL,NULL,1),(133,3,32,7.00,272.58,'01',NULL,NULL,1),(134,3,31,3.85,272.58,'01',NULL,NULL,1),(135,3,40,44.00,104.08,'01',NULL,NULL,1),(168,3,39,180.00,39.65,'01',NULL,NULL,1),(137,3,26,22.40,557.55,'01',NULL,NULL,1),(138,3,24,5.53,490.64,'01',NULL,NULL,1),(139,3,25,2.55,557.55,'01',NULL,NULL,1),(140,3,23,35.00,408.87,'01',NULL,NULL,1),(146,4,56,2.00,2065.00,'01',NULL,NULL,2),(142,4,45,19.80,247.87,'01',NULL,NULL,2),(143,4,54,20.00,52.04,'01',NULL,NULL,2),(155,4,38,160.00,31.22,'01',NULL,NULL,2),(157,1,38,280.00,31.22,'01',NULL,NULL,NULL),(164,5,37,0.18,1304.67,'01',NULL,NULL,1),(166,7,33,7.00,309.75,'01',NULL,NULL,1),(169,3,38,280.00,31.22,'01',NULL,NULL,1),(170,3,4,1.00,42.13,'01',NULL,NULL,2),(171,4,4,1.00,42.13,'01',NULL,NULL,1),(172,9,6,10.00,126.38,'01',NULL,NULL,1),(173,10,18,7.52,501.80,'01',NULL,NULL,1),(174,10,38,22.00,31.22,'01',NULL,NULL,1),(175,10,25,1.15,557.55,'01',NULL,NULL,1),(176,11,54,20.00,52.04,'01',NULL,NULL,2),(177,12,5,10.00,84.25,'01',NULL,NULL,1),(179,13,38,1.00,31.22,'01',NULL,NULL,1),(181,14,38,1.00,31.22,'01',NULL,NULL,1);
/*!40000 ALTER TABLE `itens_pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=367 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (353,'2014_10_12_000000_create_users_table',1),(354,'2014_10_12_100000_create_password_resets_table',1),(355,'2017_03_09_150751_create_classes_table',1),(356,'2017_03_09_150941_create_estampas_table',1),(357,'2017_03_09_150980_create_tipo_produtos_table',1),(358,'2017_03_11_021700_create_produtos_table',1),(359,'2017_03_11_150300_create_centro_distribuicaoes_table',1),(360,'2017_03_13_142108_create_estoques_table',1),(361,'2017_03_14_171413_create_clientes_table',1),(362,'2017_03_29_210844_create_pedidos_table',1),(363,'2017_03_30_204311_create_itens_pedidos_table',1),(364,'2017_04_05_123133_add_users_to_centro_distribuicoes_table',1),(365,'2017_04_29_183246_add_lote_itens_pedido_table',1),(366,'2017_06_02_015605_add_codigo_produtos_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` enum('1','2','3') COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('1','2') COLLATE utf8_unicode_ci NOT NULL,
  `valor_base` double(8,2) NOT NULL DEFAULT '0.00',
  `desconto` double(8,2) NOT NULL DEFAULT '0.00',
  `forma_pagamento` text COLLATE utf8_unicode_ci NOT NULL,
  `obs` text COLLATE utf8_unicode_ci,
  `origem_id` int(10) unsigned DEFAULT NULL,
  `destino_id` int(10) unsigned DEFAULT NULL,
  `cliente_id` int(10) unsigned DEFAULT NULL,
  `date_confirmacao` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedidos_origem_id_foreign` (`origem_id`),
  KEY `pedidos_destino_id_foreign` (`destino_id`),
  KEY `pedidos_cliente_id_foreign` (`cliente_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (1,'1','2',433397.02,0.00,'A vista',NULL,NULL,1,5,NULL,'2017-06-23 21:14:24','2017-07-24 22:20:10'),(2,'1','2',556452.12,0.00,'A vista',NULL,NULL,1,10,NULL,'2017-06-23 22:13:20','2017-07-24 22:20:19'),(3,'2','2',124714.62,0.00,'A vista',NULL,1,2,NULL,NULL,'2017-07-03 22:05:56','2017-07-24 22:54:53'),(4,'2','2',15115.96,0.00,'1',NULL,1,2,NULL,NULL,'2017-07-06 16:35:21','2017-07-24 22:54:58'),(5,'3','1',2490.52,0.00,'CONSIGNADO',NULL,2,NULL,8,NULL,'2017-07-17 21:27:42','2017-07-17 21:35:30'),(7,'3','1',2168.25,0.00,'3 x',NULL,2,NULL,10,NULL,'2017-07-24 21:43:44','2017-07-24 21:58:56'),(9,'3','2',1263.80,0.00,'A vista',NULL,2,NULL,11,NULL,'2017-07-24 23:03:08','2017-07-24 23:04:09'),(10,'3','2',5101.56,62.00,'A vista',NULL,2,NULL,10,NULL,'2017-07-24 23:12:02','2017-07-24 23:17:46'),(11,'3','2',1040.80,0.00,'A vista',NULL,2,NULL,12,NULL,'2017-07-24 23:18:06','2017-07-24 23:18:40'),(12,'3','2',842.50,0.00,'A vista',NULL,2,NULL,13,NULL,'2017-07-24 23:19:56','2017-07-24 23:20:28'),(13,'3','2',31.22,0.00,'A vista',NULL,2,NULL,14,NULL,'2017-07-24 23:21:32','2017-07-24 23:22:45'),(14,'3','1',31.22,52.00,'A vista',NULL,2,NULL,8,NULL,'2017-07-24 23:23:44','2017-07-24 23:24:38'),(15,'3','1',0.00,0.00,'A vista',NULL,2,NULL,15,NULL,'2017-07-24 23:30:35','2017-07-24 23:30:35');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `preco` double(8,2) NOT NULL,
  `estampa_id` int(10) unsigned NOT NULL,
  `classe_id` int(10) unsigned NOT NULL,
  `tipoproduto_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `codigo` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `produtos_estampa_id_foreign` (`estampa_id`),
  KEY `produtos_classe_id_foreign` (`classe_id`),
  KEY `produtos_tipoproduto_id_foreign` (`tipoproduto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,'Piso Flutuante - Natural PEAR',515.18,2,4,2,'2017-05-08 00:09:05','2017-05-08 00:09:05',''),(2,'Piso Flutuante - Natural AMBER',557.55,1,4,2,'2017-05-08 00:18:23','2017-05-08 00:18:23',''),(3,'CMW Piso Colado - Kangaroo',167.27,3,16,2,'2017-05-08 00:21:43','2017-06-02 05:17:22','123457'),(4,'Placa Natural 10mm',42.13,4,24,6,'2017-05-08 17:10:34','2017-05-08 17:10:34',''),(5,'Placa Natural 20mm',84.25,4,25,6,'2017-05-08 17:11:44','2017-05-08 17:11:44',''),(6,'Placa Natural 3omm',126.38,4,26,6,'2017-05-08 17:13:14','2017-05-08 17:13:14',''),(7,'Placa Natural 30 (Polido)',163.55,4,26,6,'2017-05-08 17:15:19','2017-05-08 17:15:19',''),(8,'Placa Natural 50mm',210.63,4,28,6,'2017-05-08 17:16:14','2017-05-08 17:16:14',''),(15,'Colado - Digital  - Black Armani',354.60,9,8,2,'2017-05-08 17:46:14','2017-05-21 14:23:36',''),(10,'CMW Piso Colado - Kangaroo',167.27,3,14,2,'2017-05-08 17:22:07','2017-05-08 17:22:07',''),(11,'Pavimento Colado C - Agate',240.86,5,9,2,'2017-05-08 17:27:37','2017-07-05 22:14:51','FGD25E06AH001'),(12,'CMW Flutuante - Antelope',321.15,7,13,2,'2017-05-08 17:32:44','2017-06-02 05:16:35','123456'),(13,'CMW Piso Flutuante - Horse',338.99,8,13,2,'2017-05-08 17:37:10','2017-05-08 17:37:10',''),(14,'Flutuante - Natural - Agate',343.45,5,4,2,'2017-05-08 17:41:42','2017-05-21 14:21:55',''),(16,'Colado - Digital - Carrara Estatuario',354.60,10,2,2,'2017-05-08 17:52:50','2017-05-21 14:23:50',''),(17,'Colado C - Quartz',363.52,11,4,2,'2017-05-08 17:55:58','2017-05-08 17:55:58',''),(18,'Flutuante - Digital - Thyme Dark',501.80,12,2,2,'2017-05-08 17:58:26','2017-05-21 14:22:10',''),(19,'Flutuante - Digital - Travestino Serrano',501.80,13,3,2,'2017-05-08 18:01:41','2017-05-21 14:24:28',''),(20,'Flutuante - Natural - Opal',515.18,14,4,2,'2017-05-08 18:04:32','2017-05-21 14:22:40',''),(21,'Flutuante - Natural - Quartz Brow',546.40,15,4,2,'2017-05-08 18:06:18','2017-05-21 14:22:53',''),(22,'Flutuante - Natual - Amber',557.55,16,4,2,'2017-05-08 18:09:09','2017-05-21 14:22:27',''),(23,'Tecido Pearl EH',408.87,17,54,4,'2017-05-08 18:14:21','2017-05-08 18:14:21',''),(24,'Tecido Melon EH',490.64,18,54,4,'2017-05-08 18:17:04','2017-05-08 18:20:19',''),(25,'Tecido Pearl Black EZ',557.55,19,55,4,'2017-05-08 18:19:53','2017-05-08 18:19:53',''),(26,'Tecido Leather Col. Exotic II',557.55,20,54,4,'2017-05-08 18:23:11','2017-05-08 18:23:11',''),(27,'Revestimento Parede - Coconut White',185.85,21,17,3,'2017-05-08 18:26:32','2017-05-08 18:26:32',''),(28,'Revestimento Parede em Placa - Vera',235.41,22,20,3,'2017-05-08 18:30:17','2017-05-08 18:30:17',''),(29,'Revestimento de Parede - Chic List Poisedon Cork',235.41,23,18,3,'2017-05-08 18:34:50','2017-05-08 18:34:50',''),(30,'Revestimento de Parede - Gold',247.80,24,17,3,'2017-05-08 18:36:44','2017-05-08 18:36:44',''),(31,'Revestimento de Parede - Silver',272.58,25,17,3,'2017-05-08 18:39:33','2017-05-08 18:39:33',''),(32,'Revestimento de Parede em Rolo - Pearl',272.58,17,18,3,'2017-05-08 18:41:39','2017-05-08 18:41:39',''),(33,'Revestimento de Parede - Chic List Cement',309.75,26,18,3,'2017-05-08 18:43:26','2017-05-08 18:43:26',''),(34,'Revestimento de Parede - Cherries',322.14,27,17,3,'2017-05-08 18:45:27','2017-05-08 18:45:27',''),(35,'Revestimento de Parede - Orange',322.14,28,17,3,'2017-05-08 18:47:08','2017-05-08 18:47:08',''),(36,'Revestimento de Parede 3D - Diamonds',1059.35,29,22,3,'2017-05-08 18:50:49','2017-05-08 18:50:49',''),(37,'Revestimento de Parede 3D - Waves',1304.67,30,22,3,'2017-05-08 18:53:02','2017-05-08 18:53:02',''),(38,'Rolo de Cortiça 3mm',31.22,31,36,5,'2017-05-08 18:56:36','2017-05-08 18:56:36',''),(39,'Rolo de Cortiça Sustentável 2mm',39.65,32,44,5,'2017-05-08 19:00:12','2017-05-08 19:00:12',''),(40,'Rolo de Cortiça 10mm',104.08,31,42,5,'2017-05-08 19:03:32','2017-05-08 19:03:32',''),(41,'Revestimento de Parede Placa - Vera Brown',260.19,33,19,3,'2017-05-11 18:08:34','2017-05-11 18:08:34',''),(42,'Revestimento de Paredes em Placa - Vera Silver',284.97,34,19,3,'2017-05-11 18:12:05','2017-05-11 18:12:05',''),(43,'Revestimento de Parede Placa - Vera Cream',260.19,35,19,3,'2017-05-11 18:14:01','2017-05-11 18:16:14',''),(44,'Revestimento de Parede Placa - Elizabeth',284.97,36,19,3,'2017-05-11 18:19:09','2017-05-11 18:19:09',''),(45,'Revestimento de Parede - Gabrielle Brown',247.87,38,20,3,'2017-05-11 18:24:31','2017-05-11 18:24:31',''),(46,'Revestimento de Parede Placas - Mary',235.41,39,20,3,'2017-05-11 18:26:35','2017-05-11 18:29:24',''),(47,'Revestimento de Parede Rolo - Melon Brown',334.53,40,17,3,'2017-05-11 18:36:35','2017-05-11 18:36:35',''),(48,'Revestimento de Parede - Bronze',297.36,42,17,3,'2017-05-11 18:49:42','2017-05-11 18:49:42',''),(49,'Placa Natural 40mm',168.50,4,27,6,'2017-07-03 16:44:51','2017-07-03 16:44:51','PLA100050040F'),(50,'Revestimento de Parede - Vera Brown',260.19,33,20,3,'2017-07-03 16:54:00','2017-07-03 16:54:00','WGD21E03APC546'),(51,'Rolo de Cortiça 1,6mm',16.65,31,30,5,'2017-07-03 17:16:21','2017-07-03 17:16:21','CI1011.6R15MS'),(52,'Rolo de Cortiça 2mm',20.82,31,32,5,'2017-07-03 17:18:41','2017-07-03 17:18:41','CI10102R15MS'),(53,'Rolo de Cortiça 4mm',41.63,31,38,5,'2017-07-03 17:20:35','2017-07-03 17:20:35','CI10104R15MS'),(54,'Rolo de Cortiça 5mm',52.04,31,40,5,'2017-07-03 17:26:47','2017-07-03 17:26:47','CI10105R15MS'),(55,'Rolo de Cortiça 6mm',62.45,31,41,5,'2017-07-03 17:28:10','2017-07-03 17:28:10','CI10106R15MS'),(56,'Kit de Amostras',2065.00,31,56,9,'2017-07-03 21:36:46','2017-07-03 21:36:46','FFAMOSTRAS'),(57,'Discos de Cortiça (milheiro de disco)',137.67,31,56,9,'2017-07-03 21:40:26','2017-07-03 21:40:26','DI2662R'),(58,'Banco de Cortiça',1652.00,31,56,8,'2017-07-03 21:41:35','2017-07-03 21:41:35','YOOCBNCORK');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_produtos`
--

DROP TABLE IF EXISTS `tipo_produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_produtos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_produtos`
--

LOCK TABLES `tipo_produtos` WRITE;
/*!40000 ALTER TABLE `tipo_produtos` DISABLE KEYS */;
INSERT INTO `tipo_produtos` VALUES (2,'Piso','2017-05-07 23:47:22','2017-05-07 23:47:22'),(3,'Revestimento de Parede','2017-05-07 23:47:32','2017-05-07 23:47:32'),(4,'Tecido','2017-05-07 23:47:42','2017-05-07 23:47:42'),(5,'Manta TermoAcúsitica','2017-05-07 23:48:03','2017-05-07 23:48:03'),(6,'Placas TermoAcústicas','2017-05-07 23:49:12','2017-05-07 23:49:12'),(7,'Rolhas','2017-05-07 23:49:36','2017-05-07 23:49:36'),(8,'Bancos de Cortíca','2017-05-07 23:49:49','2017-05-07 23:49:49'),(9,'Diversos','2017-07-03 21:35:10','2017-07-03 21:35:10');
/*!40000 ALTER TABLE `tipo_produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `endereco` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bairro` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cidade` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uf` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cep` int(11) DEFAULT NULL,
  `fone` int(11) DEFAULT NULL,
  `celular` int(11) DEFAULT NULL,
  `is_permission` tinyint(4) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `centrodistribuicao_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_centrodistribuicao_id_foreign` (`centrodistribuicao_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@corktech.com','$2y$10$cYTnouAg14P6KacyE4UsJO4ziRbHJZuUp2oMY.BjZQuLRybGlY3UO','82796 Homenick Extension\nRodrigohaven, NE 22353-1395','teste','New Danykaview','Mrs. Mazie Labadie',4831233,123456,123456,1,'m1B3bz9koIJg5fvEAVP3PmqLrsFs1iEe2RoiOwjNRI455mU1pBvhm1r84seQ','2017-05-05 22:34:43','2017-05-05 22:34:43',1),(2,'User','user@corktech.com','$2y$10$cYTnouAg14P6KacyE4UsJO4ziRbHJZuUp2oMY.BjZQuLRybGlY3UO','4158 Hahn Junction Apt. 327\nBaileyshire, CA 73628','teste','West Cathy','Sierra Cole',1470464,123456,123456,2,'u2hvVi8OtL','2017-05-05 22:34:43','2017-05-05 22:34:43',2),(3,'Bruno Mendonca','bruno@corktech.eco.br','$2y$10$U71HvLJQGpDSGZ1m8opBKeXNm9ls1xuvTYk9YxSRiwmTRHIDNTOLS','Av Sao Marcos','Calhau','SAO LUIS','MA',65062710,984137182,984137182,1,NULL,'2017-05-08 13:50:38','2017-05-08 13:51:50',1),(4,'Bruno Andres Mendonca','pakamao@hotmail.com','$2y$10$9oP1DGwtZzl5v6l0bRBfGO6NOVYyMB5/phplCMNrN17/cnhrEeRzO','av sao marcos q c edf trinidad ap 902','Ponta d areia','Sao Luis','Ma',65077310,32275993,984137182,1,NULL,'2017-05-08 13:58:37','2017-05-08 14:05:12',1),(5,'alexsandro de jesus caldas coelho','alex.coelho@corktech.eco.br','$2y$10$Wzgh8orPD3bSyX0G8G7ZguluW9J0zdDxD7YMQZEF1EtT8gjNEDoUa','rua jupiter n 13 , edificio jose goncalo apto 1302','renascenca II','sao luis','ma',65075045,33031374,991167640,1,NULL,'2017-05-08 13:59:00','2017-05-08 13:59:00',1),(6,'Ibsen','ibsen@corkeco.com.br','$2y$10$2yda13EbwrVYJY03OL6dVO.wqUA5JeDuiYtc1O4N2AnDUGHkZ4EaK','Rua','Bairro','Cidade','CE',85000,983133414,981414144,2,NULL,'2017-05-08 15:04:09','2017-06-04 01:33:35',4),(7,'Ana Carolina Soares','atendimento@corktech.eco.br','$2y$10$c6bhmtzcBTjS/m97gemV6O1fKdBcDodC8hqivHLY3Kl1Y5TuSoXFC','Rua das Sucupiras Quadra 56 - Casa 27','Renascença','São Luis','MA',65075400,981145711,981145711,2,'mBINT5nop2BNg7ifWcAirjXwwiwLWVKRhfXw7UHh5PXfXh0hiwh0v5WcKdZo','2017-05-10 13:00:51','2017-06-06 22:33:50',2),(8,'Rafael Ferreira','rafael.ferreira@corktech.eco.br','$2y$10$AXG04jWBfFV9E2Sk7l7z/.uOms4zpTn/8lXiVq3iERhJi9yd6keYC','Rua Raul Azevedo, Q. B - Casa 13','São Francisco','São Luis','MA',65076770,988778889,988778889,2,'oeMeNx57ZvCSisdECBLzVYiJLMiqI4Fk1S3sPKbM2WutaSergUXlPFmVYHUz','2017-05-10 14:05:46','2017-06-06 22:58:19',2),(9,'Carlos Netiar','carlos@corktech.eco.br','$2y$10$lIByl8DPy97e2eV7TjM5COuT0is2XJHMsVRIoH90nUJxPdxo8ab/2','Estrada da Maioba, Cond. Maraville','Forquilha','São Luís','MA',65054040,981140090,981140090,2,'FdRypGKE8qMWZ4r2onIHDEAxyg1hJOl0RNt6eX0v1epbubHbhWwN6g17gXW9','2017-05-27 18:31:33','2017-05-27 18:31:33',2);
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

-- Dump completed on 2017-07-26 22:58:35
