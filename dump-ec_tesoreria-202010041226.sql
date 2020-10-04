-- MySQL dump 10.13  Distrib 8.0.21, for Linux (x86_64)
--
-- Host: localhost    Database: ec_tesoreria
-- ------------------------------------------------------
-- Server version	8.0.21

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
-- Table structure for table `acceso`
--

DROP TABLE IF EXISTS `acceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acceso` (
  `id` int NOT NULL AUTO_INCREMENT,
  `perfil` int NOT NULL,
  `modulo` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_acceso_modulo_idx` (`modulo`),
  KEY `fk_acceso_perfil_idx` (`perfil`),
  CONSTRAINT `fk_acceso_modulo` FOREIGN KEY (`modulo`) REFERENCES `modulo` (`id`),
  CONSTRAINT `fk_acceso_perfil` FOREIGN KEY (`perfil`) REFERENCES `perfil` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acceso`
--

LOCK TABLES `acceso` WRITE;
/*!40000 ALTER TABLE `acceso` DISABLE KEYS */;
INSERT INTO `acceso` VALUES (1,1,1),(2,1,9),(3,1,20),(4,1,2),(5,1,3),(6,1,4),(7,1,5),(8,1,6),(9,1,7),(10,1,8),(11,1,10),(12,1,11),(14,1,13),(15,1,14),(16,1,15),(17,1,16),(18,1,17),(19,1,18),(20,1,19),(26,3,9),(27,3,10),(28,3,18),(29,3,19),(30,3,20);
/*!40000 ALTER TABLE `acceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asociacion`
--

DROP TABLE IF EXISTS `asociacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asociacion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `telefono` varchar(250) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `municipio` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_asociacion_municipio_idx` (`municipio`),
  CONSTRAINT `fk_asociacion_municipio` FOREIGN KEY (`municipio`) REFERENCES `municipio` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asociacion`
--

LOCK TABLES `asociacion` WRITE;
/*!40000 ALTER TABLE `asociacion` DISABLE KEYS */;
INSERT INTO `asociacion` VALUES (1,'Alto Magdalena','1234567','Cra 24 No. 47 - 07',525),(2,'Sur Colombiana','1234567','Cra 23 No. 23 - 23',567);
/*!40000 ALTER TABLE `asociacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auditoria`
--

DROP TABLE IF EXISTS `auditoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auditoria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `operacion` int NOT NULL,
  `observacion` text,
  `tabla` varchar(250) NOT NULL,
  `usuario` int NOT NULL,
  `fecha` date NOT NULL,
  `ip` varchar(250) NOT NULL,
  `iglesia` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_auditoria_operacion_idx` (`operacion`),
  KEY `fk_auditoria_iglesia_idx` (`iglesia`),
  KEY `fk_auditoria_usuario_idx` (`usuario`),
  CONSTRAINT `fk_auditoria_iglesia` FOREIGN KEY (`iglesia`) REFERENCES `iglesia` (`id`),
  CONSTRAINT `fk_auditoria_operacion` FOREIGN KEY (`operacion`) REFERENCES `operacion` (`id`),
  CONSTRAINT `fk_auditoria_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auditoria`
--

LOCK TABLES `auditoria` WRITE;
/*!40000 ALTER TABLE `auditoria` DISABLE KEYS */;
INSERT INTO `auditoria` VALUES (1,1,'Test de funcionamiento','usuario',1,'2013-03-02','200.22.32.12',1);
/*!40000 ALTER TABLE `auditoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `descripcion` text,
  `estado` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Programas','Programas Instalados',1),(2,'Panel de Control','Panel de Administración de Programas',1);
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departamento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `pais` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_departamento_pais_idx` (`pais`),
  CONSTRAINT `fk_departamento_pais` FOREIGN KEY (`pais`) REFERENCES `pais` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamento`
--

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` VALUES (1,'Amazonas',50),(2,'Antioquia',50),(3,'Arauca',50),(4,'AtlÃ¡ntico',50),(5,'BolÃ­var',50),(6,'BoyacÃ¡',50),(7,'Caldas',50),(8,'CaquetÃ¡',50),(9,'Casanare',50),(10,'Cauca',50),(11,'Cesar',50),(12,'ChocÃ³',50),(13,'CÃ³rdoba',50),(14,'Cundinamarca',50),(15,'GÃ¼ainia',50),(16,'Guaviare',50),(17,'Huila',50),(18,'La Guajira',50),(19,'Magdalena',50),(20,'Meta',50),(21,'NariÃ±o',50),(22,'Norte de Santander',50),(23,'Putumayo',50),(24,'Quindo',50),(25,'Risaralda',50),(26,'San AndrÃ©s y Providencia',50),(27,'Santander',50),(28,'Sucre',50),(29,'Tolima',50),(30,'Valle del Cauca',50),(31,'VaupÃ©s',50),(32,'Vichada',50);
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distrito`
--

DROP TABLE IF EXISTS `distrito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `distrito` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `pastor` int NOT NULL,
  `asociacion` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_distrito_asociacion_idx` (`asociacion`),
  KEY `fk_distrito_pastor_idx` (`pastor`),
  CONSTRAINT `fk_distrito_asociacion` FOREIGN KEY (`asociacion`) REFERENCES `asociacion` (`id`),
  CONSTRAINT `fk_distrito_pastor` FOREIGN KEY (`pastor`) REFERENCES `pastor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distrito`
--

LOCK TABLES `distrito` WRITE;
/*!40000 ALTER TABLE `distrito` DISABLE KEYS */;
INSERT INTO `distrito` VALUES (1,'Palermo',1,1),(2,'Tequendama',1,2);
/*!40000 ALTER TABLE `distrito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `donante`
--

DROP TABLE IF EXISTS `donante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `donante` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `identificacion` varchar(100) DEFAULT NULL,
  `iglesia` int NOT NULL,
  `usuario` int DEFAULT NULL COMMENT 'Este campo tiene el id del registro de la tabla usuario con el que se relaciona el donante.',
  PRIMARY KEY (`id`),
  KEY `fk_donante_iglesia_idx` (`iglesia`),
  CONSTRAINT `fk_donante_iglesia` FOREIGN KEY (`iglesia`) REFERENCES `iglesia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `donante`
--

LOCK TABLES `donante` WRITE;
/*!40000 ALTER TABLE `donante` DISABLE KEYS */;
INSERT INTO `donante` VALUES (2,'Familia GarzÃ³n Fagua','',1,NULL),(3,'Familia GarzÃ³n Mosquera','',1,NULL),(4,'Jorge Ferro','123456789',1,NULL);
/*!40000 ALTER TABLE `donante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entrada`
--

DROP TABLE IF EXISTS `entrada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `entrada` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `descripcion` text,
  `iglesia` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_entrada_iglesia_idx` (`iglesia`),
  CONSTRAINT `fk_entrada_iglesia` FOREIGN KEY (`iglesia`) REFERENCES `iglesia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entrada`
--

LOCK TABLES `entrada` WRITE;
/*!40000 ALTER TABLE `entrada` DISABLE KEYS */;
INSERT INTO `entrada` VALUES (1,'Diezmo','10%',1),(2,'Ofrenda Global','Ofrenda Global',1),(3,'Ofrenda Pro-Templo','Ofrenda Pro-Templo',1);
/*!40000 ALTER TABLE `entrada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `iglesia`
--

DROP TABLE IF EXISTS `iglesia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `iglesia` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `telefono` varchar(250) NOT NULL,
  `municipio` int NOT NULL,
  `distrito` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_iglesia_municipio_idx` (`municipio`),
  KEY `fk_iglesia_distrito_idx` (`distrito`),
  CONSTRAINT `fk_iglesia_distrito` FOREIGN KEY (`distrito`) REFERENCES `distrito` (`id`),
  CONSTRAINT `fk_iglesia_municipio` FOREIGN KEY (`municipio`) REFERENCES `municipio` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `iglesia`
--

LOCK TABLES `iglesia` WRITE;
/*!40000 ALTER TABLE `iglesia` DISABLE KEYS */;
INSERT INTO `iglesia` VALUES (1,'Sistema - Iglesia de Prueba','Cra 24 No. 47 - 07','1234567',525,1),(2,'El Camino','Cra 24 No. 47 - 07','1234567',525,1),(3,'La Mesa Central','Cra 16 No. 5 - 56','1234567',567,2);
/*!40000 ALTER TABLE `iglesia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulo`
--

DROP TABLE IF EXISTS `modulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `modulo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `identificador` varchar(100) NOT NULL,
  `descripcion` text,
  `ruta` varchar(250) NOT NULL,
  `icono` varchar(250) NOT NULL,
  `categoria` int NOT NULL DEFAULT '1',
  `favorito` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_modulo_categoria_idx` (`categoria`),
  CONSTRAINT `fk_modulo_categoria` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulo`
--

LOCK TABLES `modulo` WRITE;
/*!40000 ALTER TABLE `modulo` DISABLE KEYS */;
INSERT INTO `modulo` VALUES (1,'Usuarios','users','MÃ³dulo para la administraciÃ³n de usuarios del sistema.','users','Users.png',2,1),(2,'Iglesias','church','MÃ³dulo para la administraciÃ³n de iglesias','church','Database.png',2,1),(3,'Accesos','access','MÃ³dulo para la administraciÃ³n de permisos','access','Login.png',2,0),(4,'Asociaciones','associations','MÃ³dulo para la administraciÃ³n de asociaciones','associations','Users.png',2,0),(5,'Auditoria','audit','MÃ³dulo para el seguimiento y la auditorÃ­a','audit','Settings.png',2,1),(6,'CategorÃ­as','categories','MÃ³dulo para la categorizaciÃ³n de los mÃ³dulos','categories','Users.png',2,0),(7,'Departamentos','departments','MÃ³dulo para la administraciÃ³n de departamentos o estados','departments','Users.png',2,0),(8,'Distritos','districts','MÃ³dulo para la administraciÃ³n de distritos de la iglesia','districts','Users.png',2,0),(9,'Donantes','donors','MÃ³dulo para la administraciÃ³n de donantes','donors','Chat.png',1,1),(10,'Entradas','inflows','MÃ³dulo para la administraciÃ³n de entradas de dinero','inflows','Invoice.png',1,1),(11,'MÃ³dulos','modules','MÃ³dulo para la administraciÃ³n de mÃ³dulos del sistema','modules','Add.png',2,1),(13,'Municipios','towns','MÃ³dulo para la administraciÃ³n de municipios','towns','Users.png',2,0),(14,'AuditorÃ­a - Operaciones','operations','MÃ³dulo para la administraciÃ³n de operaciones de auditorÃ­a','operations','Settings.png',2,0),(15,'Paises','countries','MÃ³dulo para la administraciÃ³n de paises','countries','Users.png',2,0),(16,'Pastores','pastors','MÃ³dulo para la administraciÃ³n de datos de pastores','pastors','Register.png',2,1),(17,'Perfiles','profiles','MÃ³dulo para la administraciÃ³n de perfiles o roles del sistema','profiles','Users.png',2,0),(18,'Remesa','consignment','MÃ³dulo para la administraciÃ³n de la remesa','consignment','Login.png',1,1),(19,'Rubros','entries','MÃ³dulo para la administraciÃ³n de rubros','entries','Delete.png',1,1),(20,'Sobres','envelope','MÃ³dulo para la administraciÃ³n de sobres','envelope','Edit.png',1,1);
/*!40000 ALTER TABLE `modulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimiento`
--

DROP TABLE IF EXISTS `movimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movimiento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rubro` int NOT NULL,
  `concepto` text NOT NULL,
  `valor` double NOT NULL,
  `tipo` int NOT NULL,
  `rubro_aux` int DEFAULT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_movimiento_rubro_idx` (`rubro`),
  KEY `fk_movimiento_tipo_idx` (`tipo`),
  KEY `fk_movimiento_rubro_aux_idx` (`rubro_aux`),
  CONSTRAINT `fk_movimiento_rubro` FOREIGN KEY (`rubro`) REFERENCES `rubro` (`id`),
  CONSTRAINT `fk_movimiento_rubro_aux` FOREIGN KEY (`rubro_aux`) REFERENCES `rubro` (`id`),
  CONSTRAINT `fk_movimiento_tipo` FOREIGN KEY (`tipo`) REFERENCES `movimiento_tipo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimiento`
--

LOCK TABLES `movimiento` WRITE;
/*!40000 ALTER TABLE `movimiento` DISABLE KEYS */;
INSERT INTO `movimiento` VALUES (1,5,'Concepto',10000,1,NULL,'2014-03-30'),(2,5,'Entrada directa a rubro.',200000,1,NULL,'2014-04-06'),(3,5,'Salida de prueba',25500,2,NULL,'2014-04-06'),(4,5,'test',1000,2,NULL,'2014-04-06'),(5,5,'Entrada para pruebas',2000,1,NULL,'2014-04-06'),(6,5,'Entrada corregida',300000,1,NULL,'2014-04-06'),(9,5,'Entrada automÃ¡tica conforme a configuraciÃ³n por registro de sobre.',35430,1,NULL,'2014-04-06'),(10,5,'Salida automÃ¡tica conforme a configuraciÃ³n por eliminaciÃ³n de entrada del sobre.',35430,2,NULL,'2014-04-06'),(11,2,'Entrada automÃ¡tica conforme a configuraciÃ³n por registro de sobre.',10000,1,NULL,'2014-04-20'),(12,5,'Entrada automÃ¡tica conforme a configuraciÃ³n por registro de sobre.',5000,1,NULL,'2014-04-20'),(13,2,'Compra de recordatorios e. sabÃ¡tica',10000,2,NULL,'2014-04-20'),(14,5,'Traspaso a Ministerios Personales.',20000,3,2,'2014-04-20'),(15,2,'Entrada automÃ¡tica conforme a configuraciÃ³n por registro de sobre.',6000,1,NULL,'2015-05-16'),(16,2,'Salida automÃ¡tica conforme a configuraciÃ³n por eliminaciÃ³n de entrada del sobre.',6000,2,NULL,'2015-05-16');
/*!40000 ALTER TABLE `movimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimiento_tipo`
--

DROP TABLE IF EXISTS `movimiento_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movimiento_tipo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimiento_tipo`
--

LOCK TABLES `movimiento_tipo` WRITE;
/*!40000 ALTER TABLE `movimiento_tipo` DISABLE KEYS */;
INSERT INTO `movimiento_tipo` VALUES (1,'Entrada','Entrada de presupuesto'),(2,'Salida','Salida de presupuesto'),(3,'Traspaso','Movimiento de presupuesto entre rubros');
/*!40000 ALTER TABLE `movimiento_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `municipio`
--

DROP TABLE IF EXISTS `municipio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `municipio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `departamento` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_municipio_departamento_idx` (`departamento`),
  CONSTRAINT `fk_municipio_departamento` FOREIGN KEY (`departamento`) REFERENCES `departamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1103 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `municipio`
--

LOCK TABLES `municipio` WRITE;
/*!40000 ALTER TABLE `municipio` DISABLE KEYS */;
INSERT INTO `municipio` VALUES (1,'Leticia',1),(2,'Puerto NariÃ±o',1),(3,'Abejorral',2),(4,'AbriaquÃ­',2),(5,'Alejandria',2),(6,'AmagÃ¡',2),(7,'Amalfi',2),(8,'Andes',2),(9,'AngelÃ³polis',2),(10,'Angostura',2),(11,'AnorÃ­',2),(12,'AnzÃ¡',2),(13,'ApartadÃ³',2),(14,'Arboletes',2),(15,'Argelia',2),(16,'Armenia',2),(17,'Barbosa',2),(18,'Bello',2),(19,'Belmira',2),(20,'Betania',2),(21,'Betulia',2),(22,'BolÃ­var',2),(23,'BriceÃ±o',2),(24,'BurÃ­tica',2),(25,'Caicedo',2),(26,'Caldas',2),(27,'Campamento',2),(28,'CaracolÃ­',2),(29,'Caramanta',2),(30,'Carepa',2),(31,'Carmen de Viboral',2),(32,'Carolina',2),(33,'Caucasia',2),(34,'CaÃ±asgordas',2),(35,'ChigorodÃ³',2),(36,'Cisneros',2),(37,'CocornÃ¡',2),(38,'ConcepciÃ³n',2),(39,'Concordia',2),(40,'Copacabana',2),(41,'CÃ¡ceres',2),(42,'Dabeiba',2),(43,'Don MatÃ­as',2),(44,'EbÃ©jico',2),(45,'El Bagre',2),(46,'EntrerrÃ­os',2),(47,'Envigado',2),(48,'Fredonia',2),(49,'Frontino',2),(50,'Giraldo',2),(51,'Girardota',2),(52,'Granada',2),(53,'Guadalupe',2),(54,'Guarne',2),(55,'GuatapÃ©',2),(56,'GÃ³mez Plata',2),(57,'Heliconia',2),(58,'Hispania',2),(59,'ItagÃ¼Ã­',2),(60,'Ituango',2),(61,'JardÃ­n',2),(62,'JericÃ³',2),(63,'La Ceja',2),(64,'La Estrella',2),(65,'La Pintada',2),(66,'La UniÃ³n',2),(67,'Liborina',2),(68,'Maceo',2),(69,'Marinilla',2),(70,'MedellÃ­n',2),(71,'Montebello',2),(72,'MurindÃ³',2),(73,'MutatÃ¡',2),(74,'NariÃ±o',2),(75,'NechÃ­',2),(76,'NecoclÃ­',2),(77,'Olaya',2),(78,'Peque',2),(79,'PeÃ±ol',2),(80,'Pueblorrico',2),(81,'Puerto BerrÃ­o',2),(82,'Puerto Nare',2),(83,'Puerto Triunfo',2),(84,'Remedios',2),(85,'Retiro',2),(86,'RÃ­onegro',2),(87,'Sabanalarga',2),(88,'Sabaneta',2),(89,'Salgar',2),(90,'San AndrÃ©s de CuerquÃ­a',2),(91,'San Carlos',2),(92,'San Francisco',2),(93,'San JerÃ³nimo',2),(94,'San JosÃ© de MontaÃ±a',2),(95,'San Juan de UrabÃ¡',2),(96,'San LuÃ­s',2),(97,'San Pedro',2),(98,'San Pedro de UrabÃ¡',2),(99,'San Rafael',2),(100,'San Roque',2),(101,'San Vicente',2),(102,'Santa BÃ¡rbara',2),(103,'Santa FÃ© de Antioquia',2),(104,'Santa Rosa de Osos',2),(105,'Santo Domingo',2),(106,'Santuario',2),(107,'Segovia',2),(108,'SonsÃ³n',2),(109,'SopetrÃ¡n',2),(110,'TarazÃ¡',2),(111,'Tarso',2),(112,'TitiribÃ­',2),(113,'Toledo',2),(114,'Turbo',2),(115,'TÃ¡mesis',2),(116,'Uramita',2),(117,'Urrao',2),(118,'Valdivia',2),(119,'Valparaiso',2),(120,'VegachÃ­',2),(121,'Venecia',2),(122,'VigÃ­a del Fuerte',2),(123,'YalÃ­',2),(124,'Yarumal',2),(125,'YolombÃ³',2),(126,'YondÃ³ (Casabe)',2),(127,'Zaragoza',2),(128,'Arauca',3),(129,'Arauquita',3),(130,'Cravo Norte',3),(131,'FortÃºl',3),(132,'Puerto RondÃ³n',3),(133,'Saravena',3),(134,'Tame',3),(135,'Baranoa',4),(136,'Barranquilla',4),(137,'Campo de la Cruz',4),(138,'Candelaria',4),(139,'Galapa',4),(140,'Juan de Acosta',4),(141,'Luruaco',4),(142,'Malambo',4),(143,'ManatÃ­',4),(144,'Palmar de Varela',4),(145,'Piojo',4),(146,'Polonuevo',4),(147,'Ponedera',4),(148,'Puerto Colombia',4),(149,'RepelÃ³n',4),(150,'Sabanagrande',4),(151,'Sabanalarga',4),(152,'Santa LucÃ­a',4),(153,'Santo TomÃ¡s',4),(154,'Soledad',4),(155,'Suan',4),(156,'TubarÃ¡',4),(157,'Usiacuri',4),(158,'AchÃ­',5),(159,'Altos del Rosario',5),(160,'Arenal',5),(161,'Arjona',5),(162,'Arroyohondo',5),(163,'Barranco de Loba',5),(164,'Calamar',5),(165,'Cantagallo',5),(166,'Cartagena',5),(167,'Cicuco',5),(168,'Clemencia',5),(169,'CÃ³rdoba',5),(170,'El Carmen de BolÃ­var',5),(171,'El Guamo',5),(172,'El PeÃ±on',5),(173,'Hatillo de Loba',5),(174,'MaganguÃ©',5),(175,'Mahates',5),(176,'Margarita',5),(177,'MarÃ­a la Baja',5),(178,'MompÃ³s',5),(179,'Montecristo',5),(180,'Morales',5),(181,'NorosÃ­',5),(182,'Pinillos',5),(183,'Regidor',5),(184,'RÃ­o Viejo',5),(185,'San Cristobal',5),(186,'San Estanislao',5),(187,'San Fernando',5),(188,'San Jacinto',5),(189,'San Jacinto del Cauca',5),(190,'San Juan de Nepomuceno',5),(191,'San MartÃ­n de Loba',5),(192,'San Pablo',5),(193,'Santa Catalina',5),(194,'Santa Rosa ',5),(195,'Santa Rosa del Sur',5),(196,'SimitÃ­',5),(197,'Soplaviento',5),(198,'Talaigua Nuevo',5),(199,'Tiquisio (Puerto Rico)',5),(200,'Turbaco',5),(201,'TurbanÃ¡',5),(202,'Villanueva',5),(203,'Zambrano',5),(204,'Almeida',6),(205,'Aquitania',6),(206,'Arcabuco',6),(207,'BelÃ©n',6),(208,'Berbeo',6),(209,'Beteitiva',6),(210,'Boavita',6),(211,'BoyacÃ¡',6),(212,'BriceÃ±o',6),(213,'Buenavista',6),(214,'Busbanza',6),(215,'Caldas',6),(216,'Campohermoso',6),(217,'Cerinza',6),(218,'Chinavita',6),(219,'ChiquinquirÃ¡',6),(220,'Chiscas',6),(221,'Chita',6),(222,'Chitaraque',6),(223,'ChivatÃ¡',6),(224,'ChÃ­quiza',6),(225,'ChÃ­vor',6),(226,'CiÃ©naga',6),(227,'Coper',6),(228,'Corrales',6),(229,'CovarachÃ­a',6),(230,'CubarÃ¡',6),(231,'Cucaita',6),(232,'Cuitiva',6),(233,'CÃ³mbita',6),(234,'Duitama',6),(235,'El Cocuy',6),(236,'El Espino',6),(237,'Firavitoba',6),(238,'Floresta',6),(239,'GachantivÃ¡',6),(240,'Garagoa',6),(241,'Guacamayas',6),(242,'Guateque',6),(243,'GuayatÃ¡',6),(244,'GuicÃ¡n',6),(245,'GÃ¡meza',6),(246,'IzÃ¡',6),(247,'Jenesano',6),(248,'JericÃ³',6),(249,'La Capilla',6),(250,'La Uvita',6),(251,'La Victoria',6),(252,'Labranzagrande',6),(253,'Macanal',6),(254,'MaripÃ­',6),(255,'Miraflores',6),(256,'Mongua',6),(257,'MonguÃ­',6),(258,'MoniquirÃ¡',6),(259,'Motavita',6),(260,'Muzo',6),(261,'Nobsa',6),(262,'Nuevo ColÃ³n',6),(263,'OicatÃ¡',6),(264,'Otanche',6),(265,'Pachavita',6),(266,'Paipa',6),(267,'Pajarito',6),(268,'Panqueba',6),(269,'Pauna',6),(270,'Paya',6),(271,'Paz de RÃ­o',6),(272,'Pesca',6),(273,'Pisva',6),(274,'Puerto BoyacÃ¡',6),(275,'PÃ¡ez',6),(276,'Quipama',6),(277,'RamiriquÃ­',6),(278,'RondÃ³n',6),(279,'RÃ¡quira',6),(280,'SaboyÃ¡',6),(281,'SamacÃ¡',6),(282,'San Eduardo',6),(283,'San JosÃ© de Pare',6),(284,'San LuÃ­s de Gaceno',6),(285,'San Mateo',6),(286,'San Miguel de Sema',6),(287,'San Pablo de Borbur',6),(288,'Santa MarÃ­a',6),(289,'Santa Rosa de Viterbo',6),(290,'Santa SofÃ­a',6),(291,'Santana',6),(292,'Sativanorte',6),(293,'Sativasur',6),(294,'Siachoque',6),(295,'SoatÃ¡',6),(296,'Socha',6),(297,'SocotÃ¡',6),(298,'Sogamoso',6),(299,'Somondoco',6),(300,'Sora',6),(301,'SoracÃ¡',6),(302,'SotaquirÃ¡',6),(303,'SusacÃ³n',6),(304,'SutamarchÃ¡n',6),(305,'Sutatenza',6),(306,'SÃ¡chica',6),(307,'Tasco',6),(308,'Tenza',6),(309,'TibanÃ¡',6),(310,'Tibasosa',6),(311,'TinjacÃ¡',6),(312,'Tipacoque',6),(313,'Toca',6),(314,'ToguÃ­',6),(315,'TopagÃ¡',6),(316,'Tota',6),(317,'Tunja',6),(318,'Tunungua',6),(319,'TurmequÃ©',6),(320,'Tuta',6),(321,'TutasÃ¡',6),(322,'Ventaquemada',6),(323,'Villa de Leiva',6),(324,'ViracachÃ¡',6),(325,'ZetaquirÃ¡',6),(326,'Ãšmbita',6),(327,'Aguadas',7),(328,'Anserma',7),(329,'Aranzazu',7),(330,'BelalcÃ¡zar',7),(331,'ChinchinÃ¡',7),(332,'Filadelfia',7),(333,'La Dorada',7),(334,'La Merced',7),(335,'La Victoria',7),(336,'Manizales',7),(337,'Manzanares',7),(338,'Marmato',7),(339,'Marquetalia',7),(340,'Marulanda',7),(341,'Neira',7),(342,'Norcasia',7),(343,'Palestina',7),(344,'Pensilvania',7),(345,'PÃ¡cora',7),(346,'Risaralda',7),(347,'RÃ­o Sucio',7),(348,'Salamina',7),(349,'SamanÃ¡',7),(350,'San JosÃ©',7),(351,'SupÃ­a',7),(352,'VillamarÃ­a',7),(353,'Viterbo',7),(354,'Albania',8),(355,'BelÃ©n de los AndaquÃ­es',8),(356,'Cartagena del ChairÃ¡',8),(357,'Curillo',8),(358,'El Doncello',8),(359,'El Paujil',8),(360,'Florencia',8),(361,'La MontaÃ±ita',8),(362,'MilÃ¡n',8),(363,'Morelia',8),(364,'Puerto Rico',8),(365,'San JosÃ© del Fragua',8),(366,'San Vicente del CaguÃ¡n',8),(367,'Solano',8),(368,'Solita',8),(369,'Valparaiso',8),(370,'Aguazul',9),(371,'ChÃ¡meza',9),(372,'Hato Corozal',9),(373,'La Salina',9),(374,'ManÃ­',9),(375,'Monterrey',9),(376,'NunchÃ­a',9),(377,'OrocuÃ©',9),(378,'Paz de Ariporo',9),(379,'Pore',9),(380,'Recetor',9),(381,'Sabanalarga',9),(382,'San LuÃ­s de Palenque',9),(383,'SÃ¡cama',9),(384,'Tauramena',9),(385,'Trinidad',9),(386,'TÃ¡mara',9),(387,'Villanueva',9),(388,'Yopal',9),(389,'Almaguer',10),(390,'Argelia',10),(391,'Balboa',10),(392,'BolÃ­var',10),(393,'Buenos Aires',10),(394,'CajibÃ­o',10),(395,'Caldono',10),(396,'Caloto',10),(397,'Corinto',10),(398,'El Tambo',10),(399,'Florencia',10),(400,'GuachenÃ©',10),(401,'GuapÃ­',10),(402,'InzÃ¡',10),(403,'JambalÃ³',10),(404,'La Sierra',10),(405,'La Vega',10),(406,'LÃ³pez (Micay)',10),(407,'Mercaderes',10),(408,'Miranda',10),(409,'Morales',10),(410,'Padilla',10),(411,'PatÃ­a (El Bordo)',10),(412,'Piamonte',10),(413,'PiendamÃ³',10),(414,'PopayÃ¡n',10),(415,'Puerto Tejada',10),(416,'PuracÃ© (Coconuco)',10),(417,'PÃ¡ez (Belalcazar)',10),(418,'Rosas',10),(419,'San SebastiÃ¡n',10),(420,'Santa Rosa',10),(421,'Santander de Quilichao',10),(422,'Silvia',10),(423,'Sotara (Paispamba)',10),(424,'Sucre',10),(425,'SuÃ¡rez',10),(426,'TimbiquÃ­',10),(427,'TimbÃ­o',10),(428,'ToribÃ­o',10),(429,'TotorÃ³',10),(430,'Villa Rica',10),(431,'Aguachica',11),(432,'AgustÃ­n Codazzi',11),(433,'Astrea',11),(434,'BecerrÃ­l',11),(435,'Bosconia',11),(436,'Chimichagua',11),(437,'ChiriguanÃ¡',11),(438,'CurumanÃ­',11),(439,'El Copey',11),(440,'El Paso',11),(441,'Gamarra',11),(442,'Gonzalez',11),(443,'La Gloria',11),(444,'La Jagua de Ibirico',11),(445,'La Paz (Robles)',11),(446,'Manaure BalcÃ³n del Cesar',11),(447,'Pailitas',11),(448,'Pelaya',11),(449,'Pueblo Bello',11),(450,'RÃ­o de oro',11),(451,'San Alberto',11),(452,'San Diego',11),(453,'San MartÃ­n',11),(454,'Tamalameque',11),(455,'Valledupar',11),(456,'AcandÃ­',12),(457,'Alto BaudÃ³ (Pie de Pato)',12),(458,'Atrato (Yuto)',12),(459,'BagadÃ³',12),(460,'BahÃ­a Solano (MÃºtis)',12),(461,'Bajo BaudÃ³ (Pizarro)',12),(462,'BelÃ©n de BajirÃ¡',12),(463,'BojayÃ¡ (Bellavista)',12),(464,'CantÃ³n de San Pablo',12),(465,'Carmen del DariÃ©n (CURBARADÃ“)',12),(466,'Condoto',12),(467,'CÃ©rtegui',12),(468,'El Carmen de Atrato',12),(469,'Istmina',12),(470,'JuradÃ³',12),(471,'LlorÃ³',12),(472,'Medio Atrato',12),(473,'Medio BaudÃ³',12),(474,'Medio San Juan (ANDAGOYA)',12),(475,'Novita',12),(476,'NuquÃ­',12),(477,'QuibdÃ³',12),(478,'RÃ­o IrÃ³',12),(479,'RÃ­o Quito',12),(480,'RÃ­osucio',12),(481,'San JosÃ© del Palmar',12),(482,'Santa Genoveva de DocorodÃ³',12),(483,'SipÃ­',12),(484,'TadÃ³',12),(485,'UnguÃ­a',12),(486,'UniÃ³n Panamericana (ÃNIMAS)',12),(487,'Ayapel',13),(488,'Buenavista',13),(489,'Canalete',13),(490,'CeretÃ©',13),(491,'ChimÃ¡',13),(492,'ChinÃº',13),(493,'CiÃ©naga de Oro',13),(494,'Cotorra',13),(495,'La Apartada y La Frontera',13),(496,'Lorica',13),(497,'Los CÃ³rdobas',13),(498,'Momil',13),(499,'MontelÃ­bano',13),(500,'Monteria',13),(501,'MoÃ±itos',13),(502,'Planeta Rica',13),(503,'Pueblo Nuevo',13),(504,'Puerto Escondido',13),(505,'Puerto Libertador',13),(506,'PurÃ­sima',13),(507,'SahagÃºn',13),(508,'San AndrÃ©s Sotavento',13),(509,'San Antero',13),(510,'San Bernardo del Viento',13),(511,'San Carlos',13),(512,'San JosÃ© de UrÃ©',13),(513,'San Pelayo',13),(514,'Tierralta',13),(515,'TuchÃ­n',13),(516,'Valencia',13),(517,'Agua de Dios',14),(518,'AlbÃ¡n',14),(519,'Anapoima',14),(520,'Anolaima',14),(521,'Apulo',14),(522,'ArbelÃ¡ez',14),(523,'BeltrÃ¡n',14),(524,'Bituima',14),(525,'BogotÃ¡ D.C.',14),(526,'BojacÃ¡',14),(527,'Cabrera',14),(528,'Cachipay',14),(529,'CajicÃ¡',14),(530,'CaparrapÃ­',14),(531,'Carmen de Carupa',14),(532,'ChaguanÃ­',14),(533,'Chipaque',14),(534,'ChoachÃ­',14),(535,'ChocontÃ¡',14),(536,'ChÃ­a',14),(537,'Cogua',14),(538,'Cota',14),(539,'CucunubÃ¡',14),(540,'CÃ¡queza',14),(541,'El Colegio',14),(542,'El PeÃ±Ã³n',14),(543,'El Rosal',14),(544,'FacatativÃ¡',14),(545,'Fosca',14),(546,'Funza',14),(547,'FusagasugÃ¡',14),(548,'FÃ³meque',14),(549,'FÃºquene',14),(550,'GachalÃ¡',14),(551,'GachancipÃ¡',14),(552,'GachetÃ¡',14),(553,'Gama',14),(554,'Girardot',14),(555,'Granada',14),(556,'GuachetÃ¡',14),(557,'Guaduas',14),(558,'Guasca',14),(559,'GuataquÃ­',14),(560,'Guatavita',14),(561,'Guayabal de Siquima',14),(562,'Guayabetal',14),(563,'GutiÃ©rrez',14),(564,'JerusalÃ©n',14),(565,'JunÃ­n',14),(566,'La Calera',14),(567,'La Mesa',14),(568,'La Palma',14),(569,'La PeÃ±a',14),(570,'La Vega',14),(571,'Lenguazaque',14),(572,'MachetÃ¡',14),(573,'Madrid',14),(574,'Manta',14),(575,'Medina',14),(576,'Mosquera',14),(577,'NariÃ±o',14),(578,'NemocÃ³n',14),(579,'Nilo',14),(580,'Nimaima',14),(581,'Nocaima',14),(582,'Pacho',14),(583,'Paime',14),(584,'Pandi',14),(585,'Paratebueno',14),(586,'Pasca',14),(587,'Puerto Salgar',14),(588,'PulÃ­',14),(589,'Quebradanegra',14),(590,'Quetame',14),(591,'Quipile',14),(592,'Ricaurte',14),(593,'San Antonio de Tequendama',14),(594,'San Bernardo',14),(595,'San Cayetano',14),(596,'San Francisco',14),(597,'San Juan de RÃ­o Seco',14),(598,'Sasaima',14),(599,'SesquilÃ©',14),(600,'SibatÃ©',14),(601,'Silvania',14),(602,'Simijaca',14),(603,'Soacha',14),(604,'SopÃ³',14),(605,'Subachoque',14),(606,'Suesca',14),(607,'SupatÃ¡',14),(608,'Susa',14),(609,'Sutatausa',14),(610,'Tabio',14),(611,'Tausa',14),(612,'Tena',14),(613,'Tenjo',14),(614,'Tibacuy',14),(615,'Tibirita',14),(616,'Tocaima',14),(617,'TocancipÃ¡',14),(618,'TopaipÃ­',14),(619,'UbalÃ¡',14),(620,'Ubaque',14),(621,'UbatÃ©',14),(622,'Une',14),(623,'Venecia (Ospina PÃ©rez)',14),(624,'Vergara',14),(625,'Viani',14),(626,'VillagÃ³mez',14),(627,'VillapinzÃ³n',14),(628,'Villeta',14),(629,'ViotÃ¡',14),(630,'YacopÃ­',14),(631,'ZipacÃ³n',14),(632,'ZipaquirÃ¡',14),(633,'Ãštica',14),(634,'InÃ­rida',15),(635,'Calamar',16),(636,'El Retorno',16),(637,'Miraflores',16),(638,'San JosÃ© del Guaviare',16),(639,'Acevedo',17),(640,'Agrado',17),(641,'Aipe',17),(642,'Algeciras',17),(643,'Altamira',17),(644,'Baraya',17),(645,'Campoalegre',17),(646,'Colombia',17),(647,'ElÃ­as',17),(648,'GarzÃ³n',17),(649,'Gigante',17),(650,'Guadalupe',17),(651,'Hobo',17),(652,'Isnos',17),(653,'La Argentina',17),(654,'La Plata',17),(655,'Neiva',17),(656,'NÃ¡taga',17),(657,'Oporapa',17),(658,'Paicol',17),(659,'Palermo',17),(660,'Palestina',17),(661,'Pital',17),(662,'Pitalito',17),(663,'Rivera',17),(664,'Saladoblanco',17),(665,'San AgustÃ­n',17),(666,'Santa MarÃ­a',17),(667,'Suaza',17),(668,'Tarqui',17),(669,'Tello',17),(670,'Teruel',17),(671,'Tesalia',17),(672,'TimanÃ¡',17),(673,'Villavieja',17),(674,'YaguarÃ¡',17),(675,'Ãquira',17),(676,'Albania',18),(677,'Barrancas',18),(678,'Dibulla',18),(679,'DistracciÃ³n',18),(680,'El Molino',18),(681,'Fonseca',18),(682,'Hatonuevo',18),(683,'La Jagua del Pilar',18),(684,'Maicao',18),(685,'Manaure',18),(686,'Riohacha',18),(687,'San Juan del Cesar',18),(688,'Uribia',18),(689,'Urumita',18),(690,'Villanueva',18),(691,'Algarrobo',19),(692,'Aracataca',19),(693,'AriguanÃ­ (El DifÃ­cil)',19),(694,'Cerro San Antonio',19),(695,'Chivolo',19),(696,'CiÃ©naga',19),(697,'Concordia',19),(698,'El Banco',19),(699,'El PiÃ±on',19),(700,'El RetÃ©n',19),(701,'FundaciÃ³n',19),(702,'Guamal',19),(703,'Nueva Granada',19),(704,'Pedraza',19),(705,'PijiÃ±o',19),(706,'Pivijay',19),(707,'Plato',19),(708,'Puebloviejo',19),(709,'Remolino',19),(710,'Sabanas de San Angel (SAN ANGEL)',19),(711,'Salamina',19),(712,'San SebastiÃ¡n de Buenavista',19),(713,'San ZenÃ³n',19),(714,'Santa Ana',19),(715,'Santa BÃ¡rbara de Pinto',19),(716,'Santa Marta',19),(717,'Sitionuevo',19),(718,'Tenerife',19),(719,'ZapayÃ¡n (PUNTA DE PIEDRAS)',19),(720,'Zona Bananera (PRADO - SEVILLA)',19),(721,'AcacÃ­as',20),(722,'Barranca de UpÃ­a',20),(723,'Cabuyaro',20),(724,'Castilla la Nueva',20),(725,'Cubarral',20),(726,'Cumaral',20),(727,'El Calvario',20),(728,'El Castillo',20),(729,'El Dorado',20),(730,'Fuente de Oro',20),(731,'Granada',20),(732,'Guamal',20),(733,'La Macarena',20),(734,'LejanÃ­as',20),(735,'Mapiripan',20),(736,'Mesetas',20),(737,'Puerto Concordia',20),(738,'Puerto GaitÃ¡n',20),(739,'Puerto Lleras',20),(740,'Puerto LÃ³pez',20),(741,'Puerto Rico',20),(742,'Restrepo',20),(743,'San Carlos de Guaroa',20),(744,'San Juan de Arama',20),(745,'San Juanito',20),(746,'San MartÃ­n',20),(747,'Uribe',20),(748,'Villavicencio',20),(749,'Vista Hermosa',20),(750,'AlbÃ¡n (San JosÃ©)',21),(751,'Aldana',21),(752,'Ancuya',21),(753,'Arboleda (Berruecos)',21),(754,'Barbacoas',21),(755,'BelÃ©n',21),(756,'Buesaco',21),(757,'ChachaguÃ­',21),(758,'ColÃ³n (GÃ©nova)',21),(759,'Consaca',21),(760,'Contadero',21),(761,'Cuaspud (Carlosama)',21),(762,'Cumbal',21),(763,'Cumbitara',21),(764,'CÃ³rdoba',21),(765,'El Charco',21),(766,'El PeÃ±ol',21),(767,'El Rosario',21),(768,'El TablÃ³n de GÃ³mez',21),(769,'El Tambo',21),(770,'Francisco Pizarro',21),(771,'Funes',21),(772,'GuachavÃ©s',21),(773,'Guachucal',21),(774,'Guaitarilla',21),(775,'GualmatÃ¡n',21),(776,'Iles',21),(777,'ImÃºes',21),(778,'Ipiales',21),(779,'La Cruz',21),(780,'La Florida',21),(781,'La Llanada',21),(782,'La Tola',21),(783,'La UniÃ³n',21),(784,'Leiva',21),(785,'Linares',21),(786,'MagÃ¼i (PayÃ¡n)',21),(787,'Mallama (Piedrancha)',21),(788,'Mosquera',21),(789,'NariÃ±o',21),(790,'Olaya Herrera',21),(791,'Ospina',21),(792,'Policarpa',21),(793,'PotosÃ­',21),(794,'Providencia',21),(795,'Puerres',21),(796,'Pupiales',21),(797,'Ricaurte',21),(798,'Roberto PayÃ¡n (San JosÃ©)',21),(799,'Samaniego',21),(800,'San Bernardo',21),(801,'San Juan de Pasto',21),(802,'San Lorenzo',21),(803,'San Pablo',21),(804,'San Pedro de Cartago',21),(805,'SandonÃ¡',21),(806,'Santa BÃ¡rbara (IscuandÃ©)',21),(807,'Sapuyes',21),(808,'Sotomayor (Los Andes)',21),(809,'Taminango',21),(810,'Tangua',21),(811,'Tumaco',21),(812,'TÃºquerres',21),(813,'Yacuanquer',21),(814,'Arboledas',22),(815,'Bochalema',22),(816,'Bucarasica',22),(817,'ChinÃ¡cota',22),(818,'ChitagÃ¡',22),(819,'ConvenciÃ³n',22),(820,'Cucutilla',22),(821,'CÃ¡chira',22),(822,'CÃ¡cota',22),(823,'CÃºcuta',22),(824,'Durania',22),(825,'El Carmen',22),(826,'El Tarra',22),(827,'El Zulia',22),(828,'Gramalote',22),(829,'HacarÃ­',22),(830,'HerrÃ¡n',22),(831,'La Esperanza',22),(832,'La Playa',22),(833,'Labateca',22),(834,'Los Patios',22),(835,'Lourdes',22),(836,'Mutiscua',22),(837,'OcaÃ±a',22),(838,'Pamplona',22),(839,'Pamplonita',22),(840,'Puerto Santander',22),(841,'Ragonvalia',22),(842,'Salazar',22),(843,'San Calixto',22),(844,'San Cayetano',22),(845,'Santiago',22),(846,'Sardinata',22),(847,'Silos',22),(848,'Teorama',22),(849,'TibÃº',22),(850,'Toledo',22),(851,'Villa Caro',22),(852,'Villa del Rosario',22),(853,'Ãbrego',22),(854,'ColÃ³n',23),(855,'Mocoa',23),(856,'Orito',23),(857,'Puerto AsÃ­s',23),(858,'Puerto Caicedo',23),(859,'Puerto GuzmÃ¡n',23),(860,'Puerto LeguÃ­zamo',23),(861,'San Francisco',23),(862,'San Miguel',23),(863,'Santiago',23),(864,'Sibundoy',23),(865,'Valle del Guamuez',23),(866,'VillagarzÃ³n',23),(867,'Armenia',24),(868,'Buenavista',24),(869,'CalarcÃ¡',24),(870,'Circasia',24),(871,'CordobÃ¡',24),(872,'Filandia',24),(873,'GÃ©nova',24),(874,'La Tebaida',24),(875,'Montenegro',24),(876,'Pijao',24),(877,'Quimbaya',24),(878,'Salento',24),(879,'ApÃ­a',25),(880,'Balboa',25),(881,'BelÃ©n de UmbrÃ­a',25),(882,'Dos Quebradas',25),(883,'GuÃ¡tica',25),(884,'La Celia',25),(885,'La Virginia',25),(886,'Marsella',25),(887,'MistratÃ³',25),(888,'Pereira',25),(889,'Pueblo Rico',25),(890,'QuinchÃ­a',25),(891,'Santa Rosa de Cabal',25),(892,'Santuario',25),(893,'Providencia',26),(894,'Aguada',27),(895,'Albania',27),(896,'Aratoca',27),(897,'Barbosa',27),(898,'Barichara',27),(899,'Barrancabermeja',27),(900,'Betulia',27),(901,'BolÃ­var',27),(902,'Bucaramanga',27),(903,'Cabrera',27),(904,'California',27),(905,'Capitanejo',27),(906,'CarcasÃ­',27),(907,'Cepita',27),(908,'Cerrito',27),(909,'CharalÃ¡',27),(910,'Charta',27),(911,'Chima',27),(912,'ChipatÃ¡',27),(913,'Cimitarra',27),(914,'ConcepciÃ³n',27),(915,'Confines',27),(916,'ContrataciÃ³n',27),(917,'Coromoro',27),(918,'CuritÃ­',27),(919,'El Carmen',27),(920,'El Guacamayo',27),(921,'El PeÃ±on',27),(922,'El PlayÃ³n',27),(923,'Encino',27),(924,'Enciso',27),(925,'Floridablanca',27),(926,'FloriÃ¡n',27),(927,'GalÃ¡n',27),(928,'GirÃ³n',27),(929,'Guaca',27),(930,'Guadalupe',27),(931,'Guapota',27),(932,'GuavatÃ¡',27),(933,'Guepsa',27),(934,'GÃ¡mbita',27),(935,'Hato',27),(936,'JesÃºs MarÃ­a',27),(937,'JordÃ¡n',27),(938,'La Belleza',27),(939,'La Paz',27),(940,'LandÃ¡zuri',27),(941,'Lebrija',27),(942,'Los Santos',27),(943,'Macaravita',27),(944,'Matanza',27),(945,'Mogotes',27),(946,'Molagavita',27),(947,'MÃ¡laga',27),(948,'Ocamonte',27),(949,'Oiba',27),(950,'Onzaga',27),(951,'Palmar',27),(952,'Palmas del Socorro',27),(953,'Pie de Cuesta',27),(954,'Pinchote',27),(955,'Puente Nacional',27),(956,'Puerto Parra',27),(957,'Puerto Wilches',27),(958,'PÃ¡ramo',27),(959,'Rio Negro',27),(960,'Sabana de Torres',27),(961,'San AndrÃ©s',27),(962,'San Benito',27),(963,'San GÃ­l',27),(964,'San JoaquÃ­n',27),(965,'San JosÃ© de Miranda',27),(966,'San Miguel',27),(967,'San Vicente del ChucurÃ­',27),(968,'Santa BÃ¡rbara',27),(969,'Santa Helena del OpÃ³n',27),(970,'Simacota',27),(971,'Socorro',27),(972,'Suaita',27),(973,'Sucre',27),(974,'SuratÃ¡',27),(975,'Tona',27),(976,'Valle de San JosÃ©',27),(977,'Vetas',27),(978,'Villanueva',27),(979,'VÃ©lez',27),(980,'Zapatoca',27),(981,'Buenavista',28),(982,'Caimito',28),(983,'ChalÃ¡n',28),(984,'ColosÃ³ (Ricaurte)',28),(985,'Corozal',28),(986,'CoveÃ±as',28),(987,'El Roble',28),(988,'Galeras (Nueva Granada)',28),(989,'Guaranda',28),(990,'La UniÃ³n',28),(991,'Los Palmitos',28),(992,'Majagual',28),(993,'Morroa',28),(994,'Ovejas',28),(995,'Palmito',28),(996,'SampuÃ©s',28),(997,'San Benito Abad',28),(998,'San Juan de Betulia',28),(999,'San Marcos',28),(1000,'San Onofre',28),(1001,'San Pedro',28),(1002,'Sincelejo',28),(1003,'SincÃ©',28),(1004,'Sucre',28),(1005,'TolÃº',28),(1006,'TolÃº Viejo',28),(1007,'Alpujarra',29),(1008,'Alvarado',29),(1009,'Ambalema',29),(1010,'AnzoÃ¡tegui',29),(1011,'Armero (Guayabal)',29),(1012,'Ataco',29),(1013,'Cajamarca',29),(1014,'Carmen de ApicalÃ¡',29),(1015,'Casabianca',29),(1016,'Chaparral',29),(1017,'Coello',29),(1018,'Coyaima',29),(1019,'Cunday',29),(1020,'Dolores',29),(1021,'Espinal',29),(1022,'Falan',29),(1023,'Flandes',29),(1024,'Fresno',29),(1025,'Guamo',29),(1026,'Herveo',29),(1027,'Honda',29),(1028,'IbaguÃ©',29),(1029,'Icononzo',29),(1030,'LÃ©rida',29),(1031,'LÃ­bano',29),(1032,'Mariquita',29),(1033,'Melgar',29),(1034,'Murillo',29),(1035,'Natagaima',29),(1036,'Ortega',29),(1037,'Palocabildo',29),(1038,'Piedras',29),(1039,'Planadas',29),(1040,'Prado',29),(1041,'PurificaciÃ³n',29),(1042,'Rioblanco',29),(1043,'Roncesvalles',29),(1044,'Rovira',29),(1045,'SaldaÃ±a',29),(1046,'San Antonio',29),(1047,'San Luis',29),(1048,'Santa Isabel',29),(1049,'SuÃ¡rez',29),(1050,'Valle de San Juan',29),(1051,'Venadillo',29),(1052,'Villahermosa',29),(1053,'Villarrica',29),(1054,'AlcalÃ¡',30),(1055,'AndalucÃ­a',30),(1056,'Ansermanuevo',30),(1057,'Argelia',30),(1058,'BolÃ­var',30),(1059,'Buenaventura',30),(1060,'Buga',30),(1061,'Bugalagrande',30),(1062,'Caicedonia',30),(1063,'Calima (DariÃ©n)',30),(1064,'CalÃ­',30),(1065,'Candelaria',30),(1066,'Cartago',30),(1067,'Dagua',30),(1068,'El Cairo',30),(1069,'El Cerrito',30),(1070,'El Dovio',30),(1071,'El Ãguila',30),(1072,'Florida',30),(1073,'Ginebra',30),(1074,'GuacarÃ­',30),(1075,'JamundÃ­',30),(1076,'La Cumbre',30),(1077,'La UniÃ³n',30),(1078,'La Victoria',30),(1079,'Obando',30),(1080,'Palmira',30),(1081,'Pradera',30),(1082,'Restrepo',30),(1083,'RiofrÃ­o',30),(1084,'Roldanillo',30),(1085,'San Pedro',30),(1086,'Sevilla',30),(1087,'Toro',30),(1088,'Trujillo',30),(1089,'TulÃºa',30),(1090,'Ulloa',30),(1091,'Versalles',30),(1092,'Vijes',30),(1093,'Yotoco',30),(1094,'Yumbo',30),(1095,'Zarzal',30),(1096,'CarurÃº',31),(1097,'MitÃº',31),(1098,'Taraira',31),(1099,'Cumaribo',32),(1100,'La Primavera',32),(1101,'Puerto CarreÃ±o',32),(1102,'Santa RosalÃ­a',32);
/*!40000 ALTER TABLE `municipio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operacion`
--

DROP TABLE IF EXISTS `operacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `operacion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operacion`
--

LOCK TABLES `operacion` WRITE;
/*!40000 ALTER TABLE `operacion` DISABLE KEYS */;
INSERT INTO `operacion` VALUES (1,'Registro de Usuario','Esta operación ejecuta un insert sobre la tabla de usuarios.');
/*!40000 ALTER TABLE `operacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pais`
--

DROP TABLE IF EXISTS `pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pais` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=255 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pais`
--

LOCK TABLES `pais` WRITE;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
INSERT INTO `pais` VALUES (1,'AfganistÃ¡n'),(2,'Akrotiri'),(3,'Albania'),(4,'Alemania'),(5,'Andorra'),(6,'Angola'),(7,'Anguila'),(8,'AntÃ¡rtida'),(9,'Antigua y Barbuda'),(10,'Antillas Neerlandesas'),(11,'Arabia SaudÃ­'),(12,'Arctic Ocean'),(13,'Argelia'),(14,'Argentina'),(15,'Armenia'),(16,'Aruba'),(17,'Ashmore andCartier Islands'),(18,'Atlantic Ocean'),(19,'Australia'),(20,'Austria'),(21,'AzerbaiyÃ¡n'),(22,'Bahamas'),(23,'BahrÃ¡in'),(24,'Bangladesh'),(25,'Barbados'),(26,'BÃ©lgica'),(27,'Belice'),(28,'BenÃ­n'),(29,'Bermudas'),(30,'Bielorrusia'),(31,'Birmania Myanmar'),(32,'Bolivia'),(33,'Bosnia y Hercegovina'),(34,'Botsuana'),(35,'Brasil'),(36,'BrunÃ©i'),(37,'Bulgaria'),(38,'Burkina Faso'),(39,'Burundi'),(40,'ButÃ¡n'),(41,'Cabo Verde'),(42,'Camboya'),(43,'CamerÃºn'),(44,'CanadÃ¡'),(45,'Chad'),(46,'Chile'),(47,'China'),(48,'Chipre'),(49,'Clipperton Island'),(50,'Colombia'),(51,'Comoras'),(52,'Congo'),(53,'Coral Sea Islands'),(54,'Corea del Norte'),(55,'Corea del Sur'),(56,'Costa de Marfil'),(57,'Costa Rica'),(58,'Croacia'),(59,'Cuba'),(60,'Dhekelia'),(61,'Dinamarca'),(62,'Dominica'),(63,'Ecuador'),(64,'Egipto'),(65,'El Salvador'),(66,'El Vaticano'),(67,'Emiratos Ãrabes Unidos'),(68,'Eritrea'),(69,'Eslovaquia'),(70,'Eslovenia'),(71,'EspaÃ±a'),(72,'Estados Unidos'),(73,'Estonia'),(74,'EtiopÃ­a'),(75,'Filipinas'),(76,'Finlandia'),(77,'Fiyi'),(78,'Francia'),(79,'GabÃ³n'),(80,'Gambia'),(81,'Gaza Strip'),(82,'Georgia'),(83,'Ghana'),(84,'Gibraltar'),(85,'Granada'),(86,'Grecia'),(87,'Groenlandia'),(88,'Guam'),(89,'Guatemala'),(90,'Guernsey'),(91,'Guinea'),(92,'Guinea Ecuatorial'),(93,'Guinea-Bissau'),(94,'Guyana'),(95,'HaitÃ­'),(96,'Honduras'),(97,'Hong Kong'),(98,'HungrÃ­a'),(99,'India'),(100,'Indian Ocean'),(101,'Indonesia'),(102,'IrÃ¡n'),(103,'Iraq'),(104,'Irlanda'),(105,'Isla Bouvet'),(106,'Isla Christmas'),(107,'Isla Norfolk'),(108,'Islandia'),(109,'Islas CaimÃ¡n'),(110,'Islas Cocos'),(111,'Islas Cook'),(112,'Islas Feroe'),(113,'Islas Georgia del Sur y Sandwich del Sur'),(114,'Islas Heard y McDonald'),(115,'Islas Malvinas'),(116,'Islas Marianas del Norte'),(117,'IslasMarshall'),(118,'Islas Pitcairn'),(119,'Islas SalomÃ³n'),(120,'Islas Turcas y Caicos'),(121,'Islas VÃ­rgenes Americanas'),(122,'Islas VÃ­rgenes BritÃ¡nicas'),(123,'Israel'),(124,'Italia'),(125,'Jamaica'),(126,'Jan Mayen'),(127,'JapÃ³n'),(128,'Jersey'),(129,'Jordania'),(130,'KazajistÃ¡n'),(131,'Kenia'),(132,'KirguizistÃ¡n'),(133,'Kiribati'),(134,'Kuwait'),(135,'Laos'),(136,'Lesoto'),(137,'Letonia'),(138,'LÃ­bano'),(139,'Liberia'),(140,'Libia'),(141,'Liechtenstein'),(142,'Lituania'),(143,'Luxemburgo'),(144,'Macao'),(145,'Macedonia'),(146,'Madagascar'),(147,'Malasia'),(148,'Malaui'),(149,'Maldivas'),(150,'MalÃ­'),(151,'Malta'),(152,'Man, Isle of'),(153,'Marruecos'),(154,'Mauricio'),(155,'Mauritania'),(156,'Mayotte'),(157,'MÃ©xico'),(158,'Micronesia'),(159,'Moldavia'),(160,'MÃ³naco'),(161,'Mongolia'),(162,'Montserrat'),(163,'Mozambique'),(164,'Namibia'),(165,'Nauru'),(166,'Navassa Island'),(167,'Nepal'),(168,'Nicaragua'),(169,'NÃ­ger'),(170,'Nigeria'),(171,'Niue'),(172,'Noruega'),(173,'Nueva Caledonia'),(174,'Nueva Zelanda'),(175,'OmÃ¡n'),(176,'Pacific Ocean'),(177,'PaÃ­ses Bajos'),(178,'PakistÃ¡n'),(179,'Palaos'),(180,'PanamÃ¡'),(181,'PapÃºa-Nueva Guinea'),(182,'Paracel Islands'),(183,'Paraguay'),(184,'PerÃº'),(185,'Polinesia Francesa'),(186,'Polonia'),(187,'Portugal'),(188,'Puerto Rico'),(189,'Qatar'),(190,'Reino Unido'),(191,'RepÃºblica Centroafricana'),(192,'RepÃºblica Checa'),(193,'RepÃºblica DemocrÃ¡tica del Congo'),(194,'RepÃºblica Dominicana'),(195,'Ruanda'),(196,'Rumania'),(197,'Rusia'),(198,'SÃ¡hara Occidental'),(199,'Samoa'),(200,'Samoa Americana'),(201,'San CristÃ³bal y Nieves'),(202,'San Marino'),(203,'San Pedro y MiquelÃ³n'),(204,'San Vicente y las Granadinas'),(205,'Santa Helena'),(206,'Santa LucÃ­a'),(207,'Santo TomÃ© y PrÃ­ncipe'),(208,'Senegal'),(209,'Seychelles'),(210,'Sierra Leona'),(211,'Singapur'),(212,'Siria'),(213,'Somalia'),(214,'Southern Ocean'),(215,'Spratly Islands'),(216,'Sri Lanka'),(217,'Suazilandia'),(218,'SudÃ¡frica'),(219,'SudÃ¡n'),(220,'Suecia'),(221,'Suiza'),(222,'Surinam'),(223,'Svalbard y Jan Mayen'),(224,'Tailandia'),(225,'TaiwÃ¡n'),(226,'Tanzania'),(227,'TayikistÃ¡n'),(228,'TerritorioBritÃ¡nicodel OcÃ©ano Indico'),(229,'Territorios Australes Franceses'),(230,'Timor Oriental'),(231,'Togo'),(232,'Tokelau'),(233,'Tonga'),(234,'Trinidad y Tobago'),(235,'TÃºnez'),(236,'TurkmenistÃ¡n'),(237,'TurquÃ­a'),(238,'Tuvalu'),(239,'Ucrania'),(240,'Uganda'),(241,'UniÃ³n Europea'),(242,'Uruguay'),(243,'UzbekistÃ¡n'),(244,'Vanuatu'),(245,'Venezuela'),(246,'Vietnam'),(247,'Wake Island'),(248,'Wallis y Futuna'),(249,'West Bank'),(250,'World'),(251,'Yemen'),(252,'Yibuti'),(253,'Zambia'),(254,'Zimbabue');
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pastor`
--

DROP TABLE IF EXISTS `pastor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pastor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `identificacion` varchar(100) NOT NULL,
  `telefono` varchar(250) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `usuario` int DEFAULT NULL COMMENT 'Este campo tiene el id del registro de la tabla usuario con el que se relaciona el pastor.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `identificacion_UNIQUE` (`identificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pastor`
--

LOCK TABLES `pastor` WRITE;
/*!40000 ALTER TABLE `pastor` DISABLE KEYS */;
INSERT INTO `pastor` VALUES (1,'Anderson Galindo','1234567890','313-461-5981','1987-01-01',NULL);
/*!40000 ALTER TABLE `pastor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perfil` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `tabla` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` VALUES (1,'Administrador','usuario'),(2,'Pastor','pastor'),(3,'Tesorero','usuario');
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remesa`
--

DROP TABLE IF EXISTS `remesa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `remesa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `concepto` varchar(250) NOT NULL,
  `iglesia` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_resema_iglesia_idx` (`iglesia`),
  CONSTRAINT `fk_resema_iglesia` FOREIGN KEY (`iglesia`) REFERENCES `iglesia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remesa`
--

LOCK TABLES `remesa` WRITE;
/*!40000 ALTER TABLE `remesa` DISABLE KEYS */;
INSERT INTO `remesa` VALUES (1,'Diezmo',1),(4,'Ofrenda Global',1),(6,'Ayuda al Colegio',1),(7,'Distrital',1);
/*!40000 ALTER TABLE `remesa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remesa_acumulado`
--

DROP TABLE IF EXISTS `remesa_acumulado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `remesa_acumulado` (
  `id` int NOT NULL AUTO_INCREMENT,
  `remesa` int NOT NULL,
  `valor` double NOT NULL DEFAULT '0',
  `enviado` int NOT NULL DEFAULT '0' COMMENT 'Informa si se ha enviado el dinero de la remesa a la asociación. (Enviado=1, No Enviado=0).',
  `fecha` date DEFAULT NULL COMMENT 'Fecha en que fue enviado el dinero.',
  PRIMARY KEY (`id`),
  KEY `fk_ra_remesa_idx` (`remesa`),
  CONSTRAINT `fk_ra_remesa` FOREIGN KEY (`remesa`) REFERENCES `remesa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='Se guardan los registros de los envíos de las remesas a la asociación con su respectivo valor y fecha de envío.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remesa_acumulado`
--

LOCK TABLES `remesa_acumulado` WRITE;
/*!40000 ALTER TABLE `remesa_acumulado` DISABLE KEYS */;
INSERT INTO `remesa_acumulado` VALUES (1,1,0,0,'2014-04-10'),(4,1,500000,0,'2014-04-11'),(5,1,0,0,'2014-04-11'),(6,4,0,0,'2014-04-11'),(8,6,0,0,'2014-04-20'),(9,1,10000,0,'2014-04-20'),(10,4,30000,0,'2014-04-20'),(11,6,1500,0,'2014-04-20'),(12,7,0,0,'2014-04-20'),(13,1,133321,0,'2015-05-16'),(14,4,48000,0,'2015-05-16'),(15,6,2400,0,'2015-05-16'),(16,7,3600,0,'2015-05-16'),(17,4,30000,0,'2015-05-16'),(18,6,1500,0,'2015-05-16'),(19,7,0,0,'2015-05-16');
/*!40000 ALTER TABLE `remesa_acumulado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remesa_configuracion`
--

DROP TABLE IF EXISTS `remesa_configuracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `remesa_configuracion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `remesa` int NOT NULL,
  `porcentaje` double NOT NULL,
  `entrada` int NOT NULL,
  `fecha` date NOT NULL COMMENT 'Fecha en que se creó la configuración de la remesa.',
  PRIMARY KEY (`id`),
  KEY `fk_rc_remesa_idx` (`remesa`),
  KEY `fk_rc_entrada_idx` (`entrada`),
  CONSTRAINT `fk_rc_entrada` FOREIGN KEY (`entrada`) REFERENCES `entrada` (`id`),
  CONSTRAINT `fk_rc_remesa` FOREIGN KEY (`remesa`) REFERENCES `remesa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Se guarda la configuración de la remesa, dejando la traza de las configuraciones asignadas a cada remesa en caso de querer realizar una auditoria.  El sistema toma la última configuración asignada a una remesa específica.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remesa_configuracion`
--

LOCK TABLES `remesa_configuracion` WRITE;
/*!40000 ALTER TABLE `remesa_configuracion` DISABLE KEYS */;
INSERT INTO `remesa_configuracion` VALUES (1,1,100,1,'2014-04-10'),(2,4,60,2,'2014-04-11'),(3,6,3,2,'2014-04-20'),(4,7,12,2,'2014-04-20');
/*!40000 ALTER TABLE `remesa_configuracion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rubro`
--

DROP TABLE IF EXISTS `rubro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rubro` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `descripcion` text,
  `iglesia` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rubro_iglesia_idx` (`iglesia`),
  CONSTRAINT `fk_rubro_iglesia` FOREIGN KEY (`iglesia`) REFERENCES `iglesia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rubro`
--

LOCK TABLES `rubro` WRITE;
/*!40000 ALTER TABLE `rubro` DISABLE KEYS */;
INSERT INTO `rubro` VALUES (1,'Ancianos','Departamento de Ancianos',1),(2,'Ministerios Personales','Ministerios Personales',1),(3,'Diaconos','Departamento de Diaconos',1),(4,'Diaconisas','Departamento de Diaconisas',1),(5,'ProTemplo','ProTemplo',1);
/*!40000 ALTER TABLE `rubro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rubro_acumulado`
--

DROP TABLE IF EXISTS `rubro_acumulado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rubro_acumulado` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rubro` int NOT NULL,
  `valor` double NOT NULL,
  `fecha` date NOT NULL COMMENT 'Ultima actualización en el acumulado del rubro.',
  PRIMARY KEY (`id`),
  KEY `fk_ra_rubro_idx` (`rubro`),
  CONSTRAINT `fk_ra_rubro` FOREIGN KEY (`rubro`) REFERENCES `rubro` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rubro_acumulado`
--

LOCK TABLES `rubro_acumulado` WRITE;
/*!40000 ALTER TABLE `rubro_acumulado` DISABLE KEYS */;
INSERT INTO `rubro_acumulado` VALUES (1,5,200000,'2014-04-06'),(2,5,-25500,'2014-04-06'),(3,5,-1000,'2014-04-06'),(4,5,2000,'2014-04-06'),(5,5,302000,'2014-04-06'),(6,5,337430,'2014-04-06'),(7,5,302000,'2014-04-06'),(8,2,10000,'2014-04-20'),(9,5,307000,'2014-04-20'),(10,2,0,'2014-04-20'),(11,5,287000,'2014-04-20'),(12,2,20000,'2014-04-20'),(13,2,26000,'2015-05-16'),(14,2,20000,'2015-05-16');
/*!40000 ALTER TABLE `rubro_acumulado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rubro_configuracion`
--

DROP TABLE IF EXISTS `rubro_configuracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rubro_configuracion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rubro` int NOT NULL,
  `porcentaje` double NOT NULL,
  `entrada` int NOT NULL,
  `fecha` date NOT NULL COMMENT 'Fecha de creación de la configuración del rubro.',
  PRIMARY KEY (`id`),
  KEY `fk_rconf_rubro_idx` (`rubro`),
  KEY `fk_rconf_entrada_idx` (`entrada`),
  CONSTRAINT `fk_rconf_entrada` FOREIGN KEY (`entrada`) REFERENCES `entrada` (`id`),
  CONSTRAINT `fk_rconf_rubro` FOREIGN KEY (`rubro`) REFERENCES `rubro` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rubro_configuracion`
--

LOCK TABLES `rubro_configuracion` WRITE;
/*!40000 ALTER TABLE `rubro_configuracion` DISABLE KEYS */;
INSERT INTO `rubro_configuracion` VALUES (8,5,100,3,'2014-03-30'),(9,2,20,2,'2014-04-11');
/*!40000 ALTER TABLE `rubro_configuracion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sobre`
--

DROP TABLE IF EXISTS `sobre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sobre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `numero` int NOT NULL,
  `fecha` date NOT NULL,
  `donante` int NOT NULL,
  `iglesia` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sobre_iglesia_idx` (`iglesia`),
  KEY `fk_sobre_donante_idx` (`donante`),
  CONSTRAINT `fk_sobre_donante` FOREIGN KEY (`donante`) REFERENCES `donante` (`id`),
  CONSTRAINT `fk_sobre_iglesia` FOREIGN KEY (`iglesia`) REFERENCES `iglesia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sobre`
--

LOCK TABLES `sobre` WRITE;
/*!40000 ALTER TABLE `sobre` DISABLE KEYS */;
INSERT INTO `sobre` VALUES (3,1,'2014-03-01',3,1),(6,3,'2014-04-03',2,1),(8,3,'2014-04-19',2,1),(9,4,'2014-04-19',4,1),(10,2,'2014-03-01',4,1);
/*!40000 ALTER TABLE `sobre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sobre_entrada`
--

DROP TABLE IF EXISTS `sobre_entrada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sobre_entrada` (
  `id` int NOT NULL AUTO_INCREMENT,
  `entrada` int NOT NULL,
  `sobre` int NOT NULL,
  `valor` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_se_entrada_idx` (`entrada`),
  KEY `fk_se_sobre_idx` (`sobre`),
  CONSTRAINT `fk_se_entrada` FOREIGN KEY (`entrada`) REFERENCES `entrada` (`id`),
  CONSTRAINT `fk_se_sobre` FOREIGN KEY (`sobre`) REFERENCES `sobre` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sobre_entrada`
--

LOCK TABLES `sobre_entrada` WRITE;
/*!40000 ALTER TABLE `sobre_entrada` DISABLE KEYS */;
INSERT INTO `sobre_entrada` VALUES (2,1,3,30000),(3,1,6,100000),(4,2,6,20000),(5,3,6,10000),(6,3,3,10000),(7,1,8,10000),(8,2,8,50000),(9,3,8,5000),(10,1,10,123321);
/*!40000 ALTER TABLE `sobre_entrada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(250) NOT NULL,
  `clave` varchar(250) NOT NULL,
  `perfil` int NOT NULL,
  `iglesia` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_UNIQUE` (`usuario`),
  KEY `fk_usuario_perfil_idx` (`perfil`),
  KEY `fk_usuario_iglesia_idx` (`iglesia`),
  CONSTRAINT `fk_usuario_iglesia` FOREIGN KEY (`iglesia`) REFERENCES `iglesia` (`id`),
  CONSTRAINT `fk_usuario_perfil` FOREIGN KEY (`perfil`) REFERENCES `perfil` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'administrador','123',1,1),(2,'pastor','123',2,1),(4,'tesorero','123',3,1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'ec_tesoreria'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-04 12:26:45
