-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: toko_bangunan
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `action` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` bigint unsigned DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `properties` json DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_logs_user_id_foreign` (`user_id`),
  KEY `activity_logs_subject_type_subject_id_index` (`subject_type`,`subject_id`),
  CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_logs`
--

LOCK TABLES `activity_logs` WRITE;
/*!40000 ALTER TABLE `activity_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('toko-bangunan-cache-admin@tokobangunan.tes|127.0.0.1','i:1;',1785681935),('toko-bangunan-cache-admin@tokobangunan.tes|127.0.0.1:timer','i:1785681935;',1785681935);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (2,'Semen & Bahan Bangunan','semen-bahan-bangunan-6a4c7cbb710dd',NULL,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(3,'Besi & Baja','besi-baja-6a4c7cbb80e15',NULL,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(4,'Cat & Pelapis','cat-pelapis-6a4c7cbb82064',NULL,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(5,'Pipa & Sanitair','pipa-sanitair-6a4c7cbb83147',NULL,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(6,'Listrik & Lampu','listrik-lampu-6a4c7cbb8463d',NULL,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(7,'Kayu & Triplek','kayu-triplek-6a4c7cbb85605',NULL,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(8,'Keramik & Lantai','keramik-lantai-6a4c7cbb8696a',NULL,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(9,'Perkakas & Alat Tukang','perkakas-alat-tukang-6a4c7cbb87c4c',NULL,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(10,'Paku, Baut & Mur','paku-baut-mur-6a4c7cbb88f94',NULL,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(11,'Atap & Rangka','atap-rangka-6a4c7cbb8a2ab',NULL,'2026-07-06 21:12:43','2026-07-06 21:12:43');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'Bapak Joko (Kontraktor)','0812-1111-2222','joko.kontraktor@gmail.com','Perumahan Griya Asri Blok C2','2026-07-06 21:12:43','2026-07-06 21:12:43'),(2,'CV Bangun Sentosa','021-7778899','admin@bangunsentosa.co.id','Jl. Raya Bogor KM 25','2026-07-06 21:12:43','2026-07-06 21:12:43'),(3,'Ibu Wati','0813-4444-5555',NULL,'Jl. Melati No. 7','2026-07-06 21:12:43','2026-07-06 21:12:43'),(4,'Bapak Dedi','0857-6666-7777',NULL,'Komplek Puri Indah No. 15','2026-07-06 21:12:43','2026-07-06 21:12:43');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(5,'2026_07_04_135315_create_roles_table',2),(6,'2026_07_04_135329_add_role_and_profile_fields_to_users_table',2),(7,'2026_07_04_135336_create_categories_table',2),(8,'2026_07_04_135344_create_suppliers_table',2),(9,'2026_07_04_135350_create_customers_table',2),(10,'2026_07_04_135428_create_products_table',2),(11,'2026_07_04_141841_create_purchases_table',3),(12,'2026_07_04_141923_create_purchase_details_table',3),(13,'2026_07_04_141929_create_sales_table',3),(14,'2026_07_04_141935_create_sale_details_table',3),(15,'2026_07_04_141944_create_stock_movements_table',3),(16,'2026_07_04_141950_create_stock_opnames_table',3),(17,'2026_07_04_141956_create_stock_opname_details_table',3),(18,'2026_07_04_142016_create_settings_table',3),(19,'2026_08_02_154924_create_activity_logs_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sku` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `supplier_id` bigint unsigned DEFAULT NULL,
  `unit` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pcs',
  `purchase_price` bigint unsigned NOT NULL DEFAULT '0',
  `selling_price` bigint unsigned NOT NULL DEFAULT '0',
  `stock` int NOT NULL DEFAULT '0',
  `min_stock` int NOT NULL DEFAULT '5',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_sku_unique` (`sku`),
  UNIQUE KEY `products_barcode_unique` (`barcode`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_supplier_id_foreign` (`supplier_id`),
  KEY `products_name_index` (`name`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'SMN-001','8991002300011','Semen Portland 50kg',2,3,'sak',62000,68000,0,20,NULL,NULL,1,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(2,'SMN-002','8991002300028','Semen Putih 40kg',2,3,'sak',75000,82000,5,10,NULL,NULL,1,'2026-07-06 21:12:43','2026-08-02 08:05:08'),(3,'SMN-003',NULL,'Pasir Cor per m3',2,NULL,'m3',250000,300000,0,5,NULL,NULL,1,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(4,'BSI-001','8991002400015','Besi Beton Ulir 10mm',3,4,'batang',68000,75000,4,30,NULL,NULL,1,'2026-07-06 21:12:43','2026-08-02 08:02:00'),(5,'BSI-002','8991002400022','Besi Beton Polos 8mm',3,4,'batang',45000,52000,1,30,NULL,NULL,1,'2026-07-06 21:12:43','2026-08-02 07:52:05'),(6,'BSI-003',NULL,'Kawat Bendrat 1kg',3,4,'kg',18000,22000,5,15,NULL,NULL,1,'2026-07-06 21:12:43','2026-08-02 08:05:08'),(7,'CAT-001','8991002500012','Cat Tembok Putih 25kg',4,5,'pail',195000,225000,0,10,NULL,NULL,1,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(8,'CAT-002','8991002500029','Cat Kayu & Besi 1kg',4,5,'kaleng',45000,55000,0,15,NULL,NULL,1,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(9,'CAT-003',NULL,'Kuas Cat 3 Inci',4,5,'pcs',8000,12000,0,20,NULL,NULL,1,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(10,'PIP-001','8991002600019','Pipa PVC 3 Inci AW',5,6,'batang',62000,72000,0,15,NULL,NULL,1,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(11,'PIP-002','8991002600026','Kran Air Stainless',5,6,'pcs',25000,35000,0,20,NULL,NULL,1,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(12,'PIP-003',NULL,'Lem Pipa PVC 100gr',5,6,'pcs',12000,17000,0,25,NULL,NULL,1,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(13,'LIS-001','8991002700016','Kabel Listrik NYM 2x1.5mm',6,7,'meter',6500,8500,2,100,NULL,NULL,1,'2026-07-06 21:12:43','2026-08-02 08:02:00'),(14,'LIS-002','8991002700023','Lampu LED Bulb 12W',6,7,'pcs',18000,25000,0,30,NULL,NULL,1,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(15,'LIS-003',NULL,'Saklar Tunggal',6,7,'pcs',9000,14000,0,20,NULL,NULL,1,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(16,'KYU-001',NULL,'Triplek 9mm 122x244',7,NULL,'lembar',95000,115000,0,10,NULL,NULL,1,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(17,'KYU-002',NULL,'Kaso Kayu 5x7',7,NULL,'batang',35000,42000,0,20,NULL,NULL,1,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(18,'KRM-001','8991002800013','Keramik Lantai 40x40',8,NULL,'dus',65000,78000,0,15,NULL,NULL,1,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(19,'PRK-001',NULL,'Palu Konde 500gr',9,NULL,'pcs',35000,48000,0,10,NULL,NULL,1,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(20,'PRK-002',NULL,'Gergaji Kayu 24 Inci',9,NULL,'pcs',45000,62000,0,8,NULL,NULL,1,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(21,'PKU-001',NULL,'Paku Beton 5cm 1kg',10,NULL,'kg',22000,28000,0,20,NULL,NULL,1,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(22,'ATP-001',NULL,'Genteng Metal Pasir',11,NULL,'lembar',32000,40000,0,30,NULL,NULL,1,'2026-07-06 21:12:43','2026-07-06 21:12:43');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_details`
--

DROP TABLE IF EXISTS `purchase_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchase_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `purchase_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `price` bigint unsigned NOT NULL,
  `subtotal` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_details_purchase_id_foreign` (`purchase_id`),
  KEY `purchase_details_product_id_foreign` (`product_id`),
  CONSTRAINT `purchase_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `purchase_details_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_details`
--

LOCK TABLES `purchase_details` WRITE;
/*!40000 ALTER TABLE `purchase_details` DISABLE KEYS */;
INSERT INTO `purchase_details` VALUES (1,1,2,5,75000,375000,'2026-08-02 08:05:08','2026-08-02 08:05:08'),(2,1,6,3,18000,54000,'2026-08-02 08:05:08','2026-08-02 08:05:08');
/*!40000 ALTER TABLE `purchase_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchases` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `purchase_date` date NOT NULL,
  `total_amount` bigint unsigned NOT NULL DEFAULT '0',
  `status` enum('pending','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'completed',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `purchases_invoice_number_unique` (`invoice_number`),
  KEY `purchases_supplier_id_foreign` (`supplier_id`),
  KEY `purchases_user_id_foreign` (`user_id`),
  CONSTRAINT `purchases_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL,
  CONSTRAINT `purchases_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchases`
--

LOCK TABLES `purchases` WRITE;
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
INSERT INTO `purchases` VALUES (1,'PB-20260802-0001',5,1,'2026-08-02',429000,'completed',NULL,'2026-08-02 08:05:08','2026-08-02 08:05:08');
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','admin','Akses penuh ke seluruh sistem','2026-07-04 07:14:11','2026-07-04 07:14:11'),(2,'Owner','owner','Pemilik toko, akses laporan & pengaturan','2026-07-04 07:14:11','2026-07-04 07:14:11'),(3,'Kasir','kasir','Akses transaksi penjualan','2026-07-04 07:14:11','2026-07-04 07:14:11'),(4,'Gudang','gudang','Akses stok dan pembelian barang','2026-07-04 07:14:11','2026-07-04 07:14:11');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sale_details`
--

DROP TABLE IF EXISTS `sale_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sale_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sale_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `price` bigint unsigned NOT NULL,
  `subtotal` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sale_details_sale_id_foreign` (`sale_id`),
  KEY `sale_details_product_id_foreign` (`product_id`),
  CONSTRAINT `sale_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `sale_details_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sale_details`
--

LOCK TABLES `sale_details` WRITE;
/*!40000 ALTER TABLE `sale_details` DISABLE KEYS */;
INSERT INTO `sale_details` VALUES (1,1,5,1,52000,52000,'2026-08-02 07:52:05','2026-08-02 07:52:05');
/*!40000 ALTER TABLE `sale_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sales` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `sale_date` datetime NOT NULL,
  `total_amount` bigint unsigned NOT NULL DEFAULT '0',
  `discount` bigint unsigned NOT NULL DEFAULT '0',
  `tax` bigint unsigned NOT NULL DEFAULT '0',
  `grand_total` bigint unsigned NOT NULL DEFAULT '0',
  `paid_amount` bigint unsigned NOT NULL DEFAULT '0',
  `change_amount` bigint unsigned NOT NULL DEFAULT '0',
  `payment_method` enum('cash','transfer','qris','debit') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `status` enum('completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'completed',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sales_invoice_number_unique` (`invoice_number`),
  KEY `sales_customer_id_foreign` (`customer_id`),
  KEY `sales_user_id_foreign` (`user_id`),
  CONSTRAINT `sales_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL,
  CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (1,'INV-20260802-0001',NULL,1,'2026-08-02 14:52:05',52000,3000,0,49000,0,0,'cash','completed',NULL,'2026-08-02 07:52:05','2026-08-02 07:52:05');
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('apmM30G1EltgcXJscwmyaJ4MVGPQZytaYefFwh9Q',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0','eyJfdG9rZW4iOiJCM05kZzVmY2JRQlhBcllBd2pZYXNFSjNYMEQ3c2lkOElsMkNJRlpUIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2JhY2t1cHMiLCJyb3V0ZSI6ImJhY2t1cHMuaW5kZXgifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjF9',1785687473),('xw9EzxZ2mSYwxhP0N0laRza18wb9JOjFBixKOPu3',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.127.0 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36','eyJfdG9rZW4iOiI2MVVYNG1HeXZpUGlHZ0hsU2lPVTZPd1g3UG5Ta3IxSU9tWk1ZSmZZIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xvZ2luIiwicm91dGUiOiJsb2dpbiJ9fQ==',1785687032);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `store_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Toko Bangunan',
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt_footer` text COLLATE utf8mb4_unicode_ci,
  `default_tax_percent` decimal(5,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'BANGUNAN','settings/LfhZkiNaElf0d8QZrAfVjPGhJHLZoirbVIc4ViYL.png','Jl. Contoh No. 123, Kota Anda','023232737434','info@tokobangunanjaya.test','Terima kasih telah berbelanja. Barang yang sudah dibeli tidak dapat dikembalikan.',0.00,'2026-07-04 07:36:15','2026-08-02 08:26:57');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_movements`
--

DROP TABLE IF EXISTS `stock_movements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stock_movements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `type` enum('in','out','adjustment') COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` bigint unsigned DEFAULT NULL,
  `quantity` int NOT NULL,
  `stock_before` int NOT NULL,
  `stock_after` int NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_movements_product_id_foreign` (`product_id`),
  KEY `stock_movements_user_id_foreign` (`user_id`),
  KEY `stock_movements_reference_type_reference_id_index` (`reference_type`,`reference_id`),
  CONSTRAINT `stock_movements_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `stock_movements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_movements`
--

LOCK TABLES `stock_movements` WRITE;
/*!40000 ALTER TABLE `stock_movements` DISABLE KEYS */;
INSERT INTO `stock_movements` VALUES (1,5,'adjustment','opname',1,2,0,2,1,'Stock Opname OPN-20260802-0001','2026-08-02 07:51:19','2026-08-02 07:51:19'),(2,5,'out','sale',1,1,2,1,1,'Penjualan INV-20260802-0001','2026-08-02 07:52:05','2026-08-02 07:52:05'),(3,4,'adjustment','opname',2,4,0,4,1,'Stock Opname OPN-20260802-0002','2026-08-02 08:02:00','2026-08-02 08:02:00'),(4,13,'adjustment','opname',2,2,0,2,1,'Stock Opname OPN-20260802-0002','2026-08-02 08:02:00','2026-08-02 08:02:00'),(5,6,'adjustment','opname',2,2,0,2,1,'Stock Opname OPN-20260802-0002','2026-08-02 08:02:00','2026-08-02 08:02:00'),(6,2,'in','purchase',1,5,0,5,1,'Pembelian PB-20260802-0001','2026-08-02 08:05:08','2026-08-02 08:05:08'),(7,6,'in','purchase',1,3,2,5,1,'Pembelian PB-20260802-0001','2026-08-02 08:05:08','2026-08-02 08:05:08');
/*!40000 ALTER TABLE `stock_movements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_opname_details`
--

DROP TABLE IF EXISTS `stock_opname_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stock_opname_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `stock_opname_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `system_stock` int NOT NULL,
  `physical_stock` int NOT NULL,
  `difference` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_opname_details_stock_opname_id_foreign` (`stock_opname_id`),
  KEY `stock_opname_details_product_id_foreign` (`product_id`),
  CONSTRAINT `stock_opname_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `stock_opname_details_stock_opname_id_foreign` FOREIGN KEY (`stock_opname_id`) REFERENCES `stock_opnames` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_opname_details`
--

LOCK TABLES `stock_opname_details` WRITE;
/*!40000 ALTER TABLE `stock_opname_details` DISABLE KEYS */;
INSERT INTO `stock_opname_details` VALUES (1,1,5,0,2,2,'2026-08-02 07:51:19','2026-08-02 07:51:19'),(2,1,4,0,0,0,'2026-08-02 07:51:19','2026-08-02 07:51:19'),(3,1,8,0,0,0,'2026-08-02 07:51:19','2026-08-02 07:51:19'),(4,1,7,0,0,0,'2026-08-02 07:51:19','2026-08-02 07:51:19'),(5,1,22,0,0,0,'2026-08-02 07:51:19','2026-08-02 07:51:19'),(6,1,20,0,0,0,'2026-08-02 07:51:19','2026-08-02 07:51:19'),(7,1,13,0,0,0,'2026-08-02 07:51:19','2026-08-02 07:51:19'),(8,1,17,0,0,0,'2026-08-02 07:51:19','2026-08-02 07:51:19'),(9,1,6,0,0,0,'2026-08-02 07:51:19','2026-08-02 07:51:19'),(10,1,18,0,0,0,'2026-08-02 07:51:19','2026-08-02 07:51:19'),(11,1,11,0,0,0,'2026-08-02 07:51:19','2026-08-02 07:51:19'),(12,1,9,0,0,0,'2026-08-02 07:51:19','2026-08-02 07:51:19'),(13,1,14,0,0,0,'2026-08-02 07:51:19','2026-08-02 07:51:19'),(14,1,12,0,0,0,'2026-08-02 07:51:19','2026-08-02 07:51:19'),(15,1,21,0,0,0,'2026-08-02 07:51:19','2026-08-02 07:51:19'),(16,1,19,0,0,0,'2026-08-02 07:51:19','2026-08-02 07:51:19'),(17,1,3,0,0,0,'2026-08-02 07:51:19','2026-08-02 07:51:19'),(18,1,10,0,0,0,'2026-08-02 07:51:19','2026-08-02 07:51:19'),(19,1,15,0,0,0,'2026-08-02 07:51:19','2026-08-02 07:51:19'),(20,1,1,0,0,0,'2026-08-02 07:51:19','2026-08-02 07:51:19'),(21,1,2,0,0,0,'2026-08-02 07:51:19','2026-08-02 07:51:19'),(22,1,16,0,0,0,'2026-08-02 07:51:19','2026-08-02 07:51:19'),(23,2,5,1,1,0,'2026-08-02 08:02:00','2026-08-02 08:02:00'),(24,2,4,0,4,4,'2026-08-02 08:02:00','2026-08-02 08:02:00'),(25,2,8,0,0,0,'2026-08-02 08:02:00','2026-08-02 08:02:00'),(26,2,7,0,0,0,'2026-08-02 08:02:00','2026-08-02 08:02:00'),(27,2,22,0,0,0,'2026-08-02 08:02:00','2026-08-02 08:02:00'),(28,2,20,0,0,0,'2026-08-02 08:02:00','2026-08-02 08:02:00'),(29,2,13,0,2,2,'2026-08-02 08:02:00','2026-08-02 08:02:00'),(30,2,17,0,0,0,'2026-08-02 08:02:00','2026-08-02 08:02:00'),(31,2,6,0,2,2,'2026-08-02 08:02:00','2026-08-02 08:02:00'),(32,2,18,0,0,0,'2026-08-02 08:02:00','2026-08-02 08:02:00'),(33,2,11,0,0,0,'2026-08-02 08:02:00','2026-08-02 08:02:00'),(34,2,9,0,0,0,'2026-08-02 08:02:00','2026-08-02 08:02:00'),(35,2,14,0,0,0,'2026-08-02 08:02:00','2026-08-02 08:02:00'),(36,2,12,0,0,0,'2026-08-02 08:02:00','2026-08-02 08:02:00'),(37,2,21,0,0,0,'2026-08-02 08:02:00','2026-08-02 08:02:00'),(38,2,19,0,0,0,'2026-08-02 08:02:00','2026-08-02 08:02:00'),(39,2,3,0,0,0,'2026-08-02 08:02:00','2026-08-02 08:02:00'),(40,2,10,0,0,0,'2026-08-02 08:02:00','2026-08-02 08:02:00'),(41,2,15,0,0,0,'2026-08-02 08:02:00','2026-08-02 08:02:00'),(42,2,1,0,0,0,'2026-08-02 08:02:00','2026-08-02 08:02:00'),(43,2,2,0,0,0,'2026-08-02 08:02:00','2026-08-02 08:02:00'),(44,2,16,0,0,0,'2026-08-02 08:02:00','2026-08-02 08:02:00');
/*!40000 ALTER TABLE `stock_opname_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_opnames`
--

DROP TABLE IF EXISTS `stock_opnames`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stock_opnames` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `opname_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `opname_date` date NOT NULL,
  `status` enum('draft','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `stock_opnames_opname_number_unique` (`opname_number`),
  KEY `stock_opnames_user_id_foreign` (`user_id`),
  CONSTRAINT `stock_opnames_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_opnames`
--

LOCK TABLES `stock_opnames` WRITE;
/*!40000 ALTER TABLE `stock_opnames` DISABLE KEYS */;
INSERT INTO `stock_opnames` VALUES (1,'OPN-20260802-0001',1,'2026-08-02','completed',NULL,'2026-08-02 07:51:19','2026-08-02 07:51:19'),(2,'OPN-20260802-0002',1,'2026-08-02','completed',NULL,'2026-08-02 08:02:00','2026-08-02 08:02:00');
/*!40000 ALTER TABLE `stock_opnames` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `suppliers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` VALUES (2,'Persero','Toko 1','0812345678','123@gmail.com','Teknik Elektro Universitas Negeri Semarang, Sekaran, Gunung Pati, Jawa Tengah, Indonesia',0,'2026-07-06 21:00:51','2026-07-06 21:06:02'),(3,'PT Semen Indonusa','Budi Santoso','021-5551234','sales@semenindonusa.co.id','Jl. Industri Raya No. 45, Jakarta',1,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(4,'CV Baja Makmur Jaya','Siti Aminah','021-5559876','cs@bajamakmur.co.id','Jl. Rawa Bali No. 12, Bekasi',1,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(5,'Toko Cat Warna Ceria','Hendra Wijaya','0812-3344-5566','hendra@catwarnaceria.com','Jl. Kelapa Gading No. 8, Jakarta',1,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(6,'UD Pipa Sejahtera','Andi Prasetyo','0813-2211-9988','andi@pipasejahtera.id','Jl. Pahlawan No. 21, Tangerang',1,'2026-07-06 21:12:43','2026-07-06 21:12:43'),(7,'PT Listrik Terang Abadi','Rina Kartika','021-5552211','rina@listrikterang.co.id','Jl. Ahmad Yani No. 100, Bogor',1,'2026-07-06 21:12:43','2026-07-06 21:12:43');
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Administrator','admin@tokobangunan.test',NULL,NULL,1,'2026-07-04 07:36:15','$2y$12$8o9knDno1UhXeCJbVQNM0.G0HCo5aWRPrVpV6FV5D7TN6UWgWixqi','0GCCyzy1adMVl9f5cyC5mfjwCLsH1ZYEi1PJMBYebPDbcsYZ52P4hpB6vgvE','2026-07-04 07:14:12','2026-07-04 07:36:15'),(2,2,'TUBAGUS KHOLVI','vyy@gmail.com','12345678','Teknik Elektro Universitas Negeri Semarang, Sekaran, Gunung Pati, Jawa Tengah, Indonesia',1,NULL,'$2y$12$EbyCtAJmwY3Rcai.cm6B0egMX8baUzD/Z9lUcLZmQ1dOJ4EA2loUa',NULL,'2026-07-06 21:19:08','2026-07-06 21:19:08');
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

-- Dump completed on 2026-08-02 23:20:15
