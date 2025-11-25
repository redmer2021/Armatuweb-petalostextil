-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.36 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.13.0.7147
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla bd_petalostextil.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_petalostextil.cache: ~0 rows (aproximadamente)
DELETE FROM `cache`;

-- Volcando estructura para tabla bd_petalostextil.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_petalostextil.cache_locks: ~0 rows (aproximadamente)
DELETE FROM `cache_locks`;

-- Volcando estructura para tabla bd_petalostextil.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_petalostextil.failed_jobs: ~0 rows (aproximadamente)
DELETE FROM `failed_jobs`;

-- Volcando estructura para tabla bd_petalostextil.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_petalostextil.job_batches: ~0 rows (aproximadamente)
DELETE FROM `job_batches`;

-- Volcando estructura para tabla bd_petalostextil.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_petalostextil.jobs: ~0 rows (aproximadamente)
DELETE FROM `jobs`;

-- Volcando estructura para tabla bd_petalostextil.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_petalostextil.migrations: ~2 rows (aproximadamente)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1);

-- Volcando estructura para tabla bd_petalostextil.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_petalostextil.password_reset_tokens: ~0 rows (aproximadamente)
DELETE FROM `password_reset_tokens`;

-- Volcando estructura para tabla bd_petalostextil.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_petalostextil.sessions: ~1 rows (aproximadamente)
DELETE FROM `sessions`;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('TZ9fkMLuk2rT4iNSDRuBViEf0LR8eHDwrhsLbruO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYVB0cTc5Ykxkc3d1VDFNOTZZQzVvMWlGM2JTTDRidURUQ2l5MHlSZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6OToiZGF0b3NfZmFjIjthOjg6e3M6NzoiY2Fycml0byI7TzoyOToiSWxsdW1pbmF0ZVxTdXBwb3J0XENvbGxlY3Rpb24iOjI6e3M6ODoiACoAaXRlbXMiO2E6MTp7aTowO086ODoic3RkQ2xhc3MiOjk6e3M6MjoiaWQiO2k6NTtzOjExOiJndWlkQ2Fycml0byI7czozNjoiZDY3ZGFlMzAtNGMzNy00MmEyLTkyOTktYzc4NTczYTIzZTIzIjtzOjEwOiJpZEFydGljdWxvIjtpOjQ7czo4OiJjYW50aWRhZCI7aToyO3M6MTA6InByZWNpb1VuaXQiO3M6ODoiMjQwMDAuMDAiO3M6Njoibm9tYnJlIjtzOjMxOiJUb2FsbMOzbiBjb24gY2FwdWNoYSAtIEVzcGFjaWFsIjtzOjExOiJzdG9ja0FjdHVhbCI7aTo4O3M6Nzoibm9tRm90byI7czo1NDoiNTI4MzIyODM1XzE3ODYyNzMyODA3NDQ0MTMxXzQ2ODA0ODExOTUyMzA5ODY5MDdfbi53ZWJwIjtzOjY6ImVzdGFkbyI7aTowO319czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO31zOjg6InRpcEVudmlvIjtpOjA7czoxNDoiZGlyQ2FsbGVBbHR1cmEiO3M6MDoiIjtzOjEyOiJkaXJQcm92aW5jaWEiO3M6MDoiIjtzOjEyOiJkaXJMb2NhbGlkYWQiO3M6MDoiIjtzOjk6ImRpckJhcnJpbyI7czowOiIiO3M6MTI6ImRpckNvZFBvc3RhbCI7czowOiIiO3M6MTE6InRvdGFsUHJlY2lvIjtzOjg6IjQ4MDAwLjAwIjt9fQ==', 1764039318);

-- Volcando estructura para tabla bd_petalostextil.tb_articulos
CREATE TABLE IF NOT EXISTS `tb_articulos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoria` tinyint unsigned DEFAULT NULL,
  `nombre` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descrip` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `compoKit` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `caracDest` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `usosRec` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `notas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `medidas` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peso` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cuotas` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio` decimal(20,2) DEFAULT NULL,
  `descPorTransfer` tinyint DEFAULT NULL,
  `stockActual` tinyint DEFAULT NULL,
  `visitas` int DEFAULT NULL,
  `pausado` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_petalostextil.tb_articulos: ~5 rows (aproximadamente)
DELETE FROM `tb_articulos`;
INSERT INTO `tb_articulos` (`id`, `codigo`, `categoria`, `nombre`, `descrip`, `compoKit`, `caracDest`, `usosRec`, `notas`, `medidas`, `peso`, `cuotas`, `precio`, `descPorTransfer`, `stockActual`, `visitas`, `pausado`, `created_at`, `updated_at`) VALUES
	(1, 'ASD124', 1, 'Flores de Japón', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse placeat nobis, sit officia ex ipsum dignissimos omnis odio odit quaerat. Voluptas quidem quod asperiores dolorum debitis assumenda architecto sequi explicabo?', NULL, NULL, NULL, NULL, '144 cm x 200 cm', '120 g', '', 42500.00, 5, 10, 1434, 2, '2025-09-10 23:09:02', '2025-11-06 23:58:09'),
	(2, 'FDS100', 1, 'Almendrado', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse placeat nobis, sit officia ex ipsum dignissimos omnis odio odit quaerat. Voluptas quidem quod asperiores dolorum debitis assumenda architecto sequi explicabo? Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse placeat nobis, sit officia ex ipsum dignissimos omnis odio odit quaerat. Voluptas quidem quod asperiores dolorum debitis assumenda architecto sequi explicabo? Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse placeat nobis, sit officia ex ipsum dignissimos omnis odio odit quaerat. Voluptas quidem quod asperiores dolorum debitis assumenda architecto sequi explicabo?', NULL, NULL, NULL, NULL, '144 cm x 200 cm', '120 g', '', 42500.00, 10, 25, 521, 2, '2025-09-10 23:10:33', '2025-11-06 23:57:59'),
	(3, 'SDK123', 2, 'Repasadores nido de avejas - pack x 4', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse placeat nobis, sit officia ex ipsum dignissimos omnis odio odit quaerat. Voluptas quidem quod asperiores dolorum debitis assumenda architecto sequi explicabo?', NULL, NULL, NULL, NULL, '50 cm x 67 cm', '40 g', '', 10000.00, 25, 5, 1149, 2, '2025-09-10 23:12:12', '2025-09-10 23:12:13'),
	(4, 'KJD333', 3, 'Toallón con capucha - Espacial', 'TOALLÓN CON CAPUCHA + 2 TOALLITAS DE MANO – 100% ALGODÓN DOBLE FELPA\r\nIdeal para la rutina diaria de tu bebé. Combina suavidad, comodidad y funcionalidad en un solo producto. Perfecto para usar en casa, en el jardín o llevar en el bolso.\r\n', '- 1 toallón con capucha – Medida: 80 x 80 cm\r\nConfeccionado en algodón doble felpa ultra absorbente. Su capucha lo hace ideal para envolver al bebé luego del baño, manteniéndolo seco y abrigado.\r\n\r\n- 2 toallitas de mano – Medida: 30 x 40 cm\r\nPrácticas para llevar al jardín, usar como pañito multiuso o tener siempre a mano en el bolso del bebé.\r\n\r\nConfeccionado en algodón doble felpa 100%, extra suave al tacto, con excelente absorción y durabilidad.', 'Algodón 100% doble felpa: extra suave al tacto y de gran absorción.\r\nCosturas reforzadas para mayor durabilidad.\r\nNo pierde suavidad con los lavados.\r\nApto para lavarropas.\r\nEstampados infantiles con motivos delicados y colores suaves.\r\nConsultá disponibilidad al momento de comprar para elegir tu diseño preferido.\r\n', '- Bebés recién nacidos y niños pequeños.\r\n- Salida del baño.\r\n- Jardín maternal.\r\n- Regalo de nacimiento o baby shower.', 'El color del producto puede variar levemente en relación con la imagen, debido a la iluminación y la partida del tejido.\r\nLa imágenes son a modo de ilustración. ', '80 cm x 80 cm', '240 g', '', 24000.00, 30, 8, 61, 2, '2025-09-10 23:13:41', '2025-09-10 23:13:41'),
	(5, 'hgd324', 9, 'Toallón dama', 'Descripción', 'Composición', 'Características destacadas', 'Usos recomendados', NULL, '0.90 * 1.6 mts', '350g', NULL, 35000.00, 25, 10, 24, 2, '2025-11-06 23:38:46', '2025-11-08 02:26:20');

-- Volcando estructura para tabla bd_petalostextil.tb_carrito
CREATE TABLE IF NOT EXISTS `tb_carrito` (
  `id` int NOT NULL AUTO_INCREMENT,
  `guidCarrito` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `idArticulo` int NOT NULL,
  `nomFoto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad` int NOT NULL,
  `estado` tinyint NOT NULL DEFAULT (0),
  `precioUnit` decimal(20,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_petalostextil.tb_carrito: ~4 rows (aproximadamente)
DELETE FROM `tb_carrito`;
INSERT INTO `tb_carrito` (`id`, `guidCarrito`, `idArticulo`, `nomFoto`, `cantidad`, `estado`, `precioUnit`, `created_at`, `updated_at`) VALUES
	(1, '68d5d523-94ef-4d3c-b89e-f5b4bc712292', 1, '524398293_17861635668444131_9079809091768109536_n.webp', 1, 1, 42500.00, '2025-11-25 01:07:11', '2025-11-25 01:08:55'),
	(2, '68d5d523-94ef-4d3c-b89e-f5b4bc712292', 2, '527238038_17862335967444131_3999704133648464046_n.webp', 1, 1, 42500.00, '2025-11-25 01:07:24', '2025-11-25 01:08:55'),
	(3, '68d5d523-94ef-4d3c-b89e-f5b4bc712292', 4, '527938130_17862732834444131_8614832077531511354_n.webp', 1, 1, 24000.00, '2025-11-25 01:07:35', '2025-11-25 01:08:55'),
	(4, '68d5d523-94ef-4d3c-b89e-f5b4bc712292', 5, 'art_1762568767.PNG', 1, 1, 35000.00, '2025-11-25 01:07:41', '2025-11-25 01:08:55'),
	(5, 'd67dae30-4c37-42a2-9299-c78573a23e23', 4, '528322835_17862732807444131_4680481195230986907_n.webp', 2, 1, 24000.00, '2025-11-25 02:48:40', '2025-11-25 02:48:58');

-- Volcando estructura para tabla bd_petalostextil.tb_categorias
CREATE TABLE IF NOT EXISTS `tb_categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_petalostextil.tb_categorias: ~9 rows (aproximadamente)
DELETE FROM `tb_categorias`;
INSERT INTO `tb_categorias` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
	(1, 'Manteles', '2025-09-13 18:16:32', '2025-09-13 18:16:33'),
	(2, 'Repasadores', '2025-09-13 18:16:35', '2025-09-13 18:16:36'),
	(3, 'Toallones bebe', '2025-09-13 18:16:39', '2025-09-13 18:16:39'),
	(4, 'Almohadones', '2025-09-13 18:16:41', '2025-09-13 18:16:41'),
	(5, 'Flores de tela', '2025-09-13 18:16:43', '2025-09-13 18:16:43'),
	(6, 'Turbantes', '2025-09-13 18:16:47', '2025-09-13 18:16:47'),
	(7, 'Delantales', '2025-09-13 18:16:47', '2025-09-13 18:16:47'),
	(8, 'Cortinas', '2025-09-13 18:16:47', '2025-09-13 18:16:47'),
	(9, 'Toallones', '2025-11-06 23:44:13', '2025-11-06 23:44:14');

-- Volcando estructura para tabla bd_petalostextil.tb_direc_envios
CREATE TABLE IF NOT EXISTS `tb_direc_envios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idUser` bigint DEFAULT NULL,
  `tipDirec` tinyint DEFAULT NULL,
  `direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localidad` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barrio` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idProvincia` tinyint DEFAULT NULL,
  `codPostal` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_petalostextil.tb_direc_envios: ~2 rows (aproximadamente)
DELETE FROM `tb_direc_envios`;
INSERT INTO `tb_direc_envios` (`id`, `idUser`, `tipDirec`, `direccion`, `localidad`, `barrio`, `idProvincia`, `codPostal`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, 'Antonio Machado', 'Caballito', NULL, 24, '1405', '2025-09-28 20:42:41', '2025-09-28 20:42:41'),
	(14, 15, 1, 'Paraguay', 'Recoleta', NULL, 24, '1425', '2025-10-14 23:53:33', '2025-10-14 23:53:33');

-- Volcando estructura para tabla bd_petalostextil.tb_envios_pendientes
CREATE TABLE IF NOT EXISTS `tb_envios_pendientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `guidCarrito` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dirCalleAltura` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dirProvincia` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dirLocalidad` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dirBarrio` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dirCodPostal` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dirEntreCalles` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint DEFAULT NULL,
  `enviarPor` tinyint DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_petalostextil.tb_envios_pendientes: ~4 rows (aproximadamente)
DELETE FROM `tb_envios_pendientes`;
INSERT INTO `tb_envios_pendientes` (`id`, `guidCarrito`, `dirCalleAltura`, `dirProvincia`, `dirLocalidad`, `dirBarrio`, `dirCodPostal`, `dirEntreCalles`, `estado`, `enviarPor`, `created_at`, `updated_at`) VALUES
	(3, '9be0c4ae-efa4-4de9-9dd0-a48da0c532f4', 'uno', 'tres', 'cuatro', NULL, 'cinco', 'seis', 0, 2, '2025-10-29 19:35:37', '2025-10-29 19:35:37'),
	(4, '7c72b514-dd34-4919-8b09-817bf83a9750', 'Dirección cba', '3', 'Barrio las Flores', '', '8374', 'sd -sd', 0, 1, '2025-10-29 23:52:10', '2025-10-29 23:52:10'),
	(5, '7c72b514-dd34-4919-8b09-817bf83a9750', 'Antonio Machado 558', '0', 'Barrio las Flores', 'Caballito', '1405', 'sd', 0, 2, '2025-10-29 23:54:09', '2025-10-29 23:54:09'),
	(6, 'a5462d75-b643-47b4-9ff3-b77880146f1e', 'Antonio Machado', '24', '', 'Caballito', '1405', 'Ambroseti y Acoyte', 0, 2, '2025-10-29 23:59:34', '2025-10-29 23:59:34');

-- Volcando estructura para tabla bd_petalostextil.tb_fotos
CREATE TABLE IF NOT EXISTS `tb_fotos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_articulo` int DEFAULT NULL,
  `nro_foto` tinyint DEFAULT NULL,
  `nomFoto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_petalostextil.tb_fotos: ~16 rows (aproximadamente)
DELETE FROM `tb_fotos`;
INSERT INTO `tb_fotos` (`id`, `id_articulo`, `nro_foto`, `nomFoto`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '524412691_17861635677444131_5128841696800824046_n.webp', '2025-09-10 20:15:00', '2025-09-10 20:15:01'),
	(2, 2, 1, '523932479_17861635650444131_7019052093686442167_n.webp', '2025-09-10 20:16:13', '2025-09-10 20:16:14'),
	(3, 3, 1, '524378155_17861270319444131_4858165964405648848_n.webp', '2025-09-10 20:16:53', '2025-09-10 20:16:53'),
	(4, 4, 1, '527938130_17862732834444131_8614832077531511354_n.webp', '2025-09-10 20:16:53', '2025-09-10 20:16:53'),
	(5, 1, 2, '523932479_17861635650444131_7019052093686442167_n.webp', '2025-09-10 20:16:53', '2025-09-10 20:16:53'),
	(6, 1, 3, '524398293_17861635668444131_9079809091768109536_n.webp', '2025-09-10 20:16:53', '2025-09-10 20:16:53'),
	(7, 1, 4, '524890003_17861635638444131_7354434449787566008_n.webp', '2025-09-10 20:16:53', '2025-09-10 20:16:53'),
	(8, 3, 2, '522278642_17861270310444131_6915188114892089691_n.webp', '2025-09-10 20:16:53', '2025-09-10 20:16:53'),
	(9, 3, 3, '524378155_17861270319444131_4858165964405648848_n.webp', '2025-09-10 20:16:53', '2025-09-10 20:16:53'),
	(10, 3, 4, '527145330_17862336756444131_7099154658963453433_n.webp', '2025-09-10 20:16:53', '2025-09-10 20:16:53'),
	(11, 3, 5, '527188967_17862336747444131_9082503933697181980_n.webp', '2025-09-10 20:16:53', '2025-09-10 20:16:53'),
	(12, 4, 2, '527276334_17862732762444131_9165476238841151670_n.webp', '2025-09-10 20:16:53', '2025-09-10 20:16:53'),
	(13, 4, 3, '528322835_17862732807444131_4680481195230986907_n.webp', '2025-09-10 20:16:53', '2025-09-10 20:16:53'),
	(14, 2, 2, '527238038_17862335967444131_3999704133648464046_n.webp', '2025-09-10 20:16:13', '2025-09-10 20:16:13'),
	(15, 2, 3, '527292099_17862335976444131_2310943107417420591_n.webp', '2025-09-10 20:16:13', '2025-09-10 20:16:13'),
	(18, 5, 1, 'art_1762568767.PNG', '2025-11-08 02:26:20', '2025-11-08 02:26:20');

-- Volcando estructura para tabla bd_petalostextil.tb_fotos_tmp
CREATE TABLE IF NOT EXISTS `tb_fotos_tmp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nroArtic` int DEFAULT NULL,
  `nroFoto` tinyint DEFAULT NULL,
  `nomFoto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `regEstado` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_petalostextil.tb_fotos_tmp: ~6 rows (aproximadamente)
DELETE FROM `tb_fotos_tmp`;
INSERT INTO `tb_fotos_tmp` (`id`, `nroArtic`, `nroFoto`, `nomFoto`, `user`, `regEstado`, `created_at`, `updated_at`) VALUES
	(10, 348153, 1, 'art_1762479719.PNG', 'rmerlo@gmail.com', NULL, '2025-11-07 01:41:59', '2025-11-07 01:41:59'),
	(11, 522458, 1, 'art_1762479764.PNG', 'rmerlo@gmail.com', NULL, '2025-11-07 01:42:44', '2025-11-07 01:42:44'),
	(12, 153433, 1, 'art_1762479829.PNG', 'rmerlo@gmail.com', NULL, '2025-11-07 01:43:49', '2025-11-07 01:43:49'),
	(13, 592571, 1, 'art_1762479869.PNG', 'rmerlo@gmail.com', NULL, '2025-11-07 01:44:29', '2025-11-07 01:44:29'),
	(14, 858744, 1, 'art_1762479893.PNG', 'rmerlo@gmail.com', NULL, '2025-11-07 01:44:53', '2025-11-07 01:44:53'),
	(15, 996900, 1, 'art_1762480032.PNG', 'rmerlo@gmail.com', NULL, '2025-11-07 01:47:12', '2025-11-07 01:47:12');

-- Volcando estructura para tabla bd_petalostextil.tb_provincias
CREATE TABLE IF NOT EXISTS `tb_provincias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `impoEnvio` decimal(20,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_petalostextil.tb_provincias: ~24 rows (aproximadamente)
DELETE FROM `tb_provincias`;
INSERT INTO `tb_provincias` (`id`, `nombre`, `impoEnvio`, `created_at`, `updated_at`) VALUES
	(1, 'BUENOS AIRES', 7500.00, '2025-09-28 21:00:00', '2025-11-08 23:47:28'),
	(2, 'CATAMARCA', 5000.00, '2025-09-28 21:00:00', '2025-11-08 23:44:55'),
	(3, 'CÓRDOBA', 6800.00, '2025-09-28 21:00:00', '2025-11-08 23:51:10'),
	(4, 'CORRIENTES', 7000.00, '2025-09-28 21:00:00', '2025-09-28 21:00:00'),
	(5, 'CHACO', 5200.00, '2025-09-28 21:00:00', '2025-11-08 23:48:52'),
	(6, 'CHUBUT', 6000.00, '2025-09-28 21:00:00', '2025-09-28 21:00:00'),
	(7, 'ENTRE RIOS', 5500.00, '2025-09-28 21:00:00', '2025-09-28 21:00:00'),
	(8, 'FORMOSA', 3400.00, '2025-09-28 21:00:00', '2025-09-28 21:00:00'),
	(9, 'JUJUY', 10000.00, '2025-09-28 21:00:00', '2025-09-28 21:00:00'),
	(10, 'LA PAMPA', 7000.00, '2025-09-28 21:00:00', '2025-11-24 16:29:19'),
	(11, 'LA RIOJA', 3500.00, '2025-09-28 21:00:00', '2025-09-28 21:00:00'),
	(12, 'MENDOZA', 8500.00, '2025-09-28 21:00:00', '2025-09-28 21:00:00'),
	(13, 'MISIONES', 9000.00, '2025-09-28 21:00:00', '2025-09-28 21:00:00'),
	(14, 'NEUQUEN', 14000.00, '2025-09-28 21:00:00', '2025-09-28 21:00:00'),
	(15, 'RIO NEGRO', 3000.00, '2025-09-28 21:00:00', '2025-09-28 21:00:00'),
	(16, 'SALTA', 12500.00, '2025-09-28 21:00:00', '2025-11-08 23:47:39'),
	(17, 'SAN JUAN', 2500.00, '2025-09-28 21:00:00', '2025-09-28 21:00:00'),
	(18, 'SAN LUIS', 4000.00, '2025-09-28 21:00:00', '2025-09-28 21:00:00'),
	(19, 'SANTA CRUZ', 6000.00, '2025-09-28 21:00:00', '2025-09-28 21:00:00'),
	(20, 'SANTA FE', 7000.00, '2025-09-28 21:00:00', '2025-09-28 21:00:00'),
	(21, 'SANTIAGO DEL ESTERO', 8000.00, '2025-09-28 21:00:00', '2025-09-28 21:00:00'),
	(22, 'TIERRA DEL FUEGO', 9000.00, '2025-09-28 21:00:00', '2025-09-28 21:00:00'),
	(23, 'TUCUMÁN', 2000.00, '2025-09-28 21:00:00', '2025-09-28 21:00:00'),
	(24, 'CIUDAD DE BUENOS AIRES', 10000.00, '2025-09-28 21:00:00', '2025-09-28 21:00:00');

-- Volcando estructura para tabla bd_petalostextil.tb_suscriptores
CREATE TABLE IF NOT EXISTS `tb_suscriptores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_petalostextil.tb_suscriptores: ~0 rows (aproximadamente)
DELETE FROM `tb_suscriptores`;

-- Volcando estructura para tabla bd_petalostextil.tb_variables
CREATE TABLE IF NOT EXISTS `tb_variables` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idVariable` tinyint DEFAULT NULL,
  `item` tinyint DEFAULT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_petalostextil.tb_variables: ~9 rows (aproximadamente)
DELETE FROM `tb_variables`;
INSERT INTO `tb_variables` (`id`, `idVariable`, `item`, `nombre`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Pedido Ingresado', '2025-11-24 17:39:14', '2025-11-24 17:39:14'),
	(2, 1, 2, 'Pedido Enviado', '2025-11-24 17:39:14', '2025-11-24 17:39:14'),
	(3, 2, 1, 'Si', '2025-11-24 17:39:14', '2025-11-24 17:39:14'),
	(4, 2, 2, 'No', '2025-11-24 17:39:14', '2025-11-24 17:39:14'),
	(5, 3, 1, 'Transferencia', '2025-11-24 17:39:14', '2025-11-24 17:39:14'),
	(6, 3, 2, 'Mercado Pago', '2025-11-24 17:39:14', '2025-11-24 17:39:14'),
	(7, 4, 1, 'Correo Argentino', '2025-11-24 17:39:14', '2025-11-24 17:39:14'),
	(8, 4, 2, 'Moto', '2025-11-24 17:39:14', '2025-11-24 17:39:14'),
	(9, 4, 3, 'Retiro en Local', '2025-11-24 17:39:14', '2025-11-24 17:39:14');

-- Volcando estructura para tabla bd_petalostextil.tb_ventas
CREATE TABLE IF NOT EXISTS `tb_ventas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `guidCarrito` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nroVenta` int DEFAULT NULL,
  `estado` tinyint DEFAULT NULL,
  `fecVenta` datetime DEFAULT NULL,
  `fecEnvio` datetime DEFAULT NULL,
  `linkSeguimiento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enviarADirAlt` tinyint DEFAULT NULL,
  `dtosFacNombre` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dtosFacApellido` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dtosFacDireccion` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dtosFacProvincia` tinyint DEFAULT NULL,
  `dtosFacLocCiudad` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dtosFacCodPostal` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dtosFacTelefono` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dtosFacCorreoE` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dtosAltNombre` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dtosAltApellido` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dtosAltDireccion` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dtosAltProvincia` tinyint DEFAULT NULL,
  `dtosAltLocCiudad` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dtosAltCodPostal` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dtosFacNotas` varchar(1500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalEnvio` decimal(20,6) DEFAULT NULL,
  `totalPedido` decimal(20,6) DEFAULT NULL,
  `totalDescTransfer` decimal(20,6) DEFAULT NULL,
  `formaDePago` tinyint DEFAULT NULL,
  `enviarPor` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_petalostextil.tb_ventas: ~1 rows (aproximadamente)
DELETE FROM `tb_ventas`;
INSERT INTO `tb_ventas` (`id`, `guidCarrito`, `nroVenta`, `estado`, `fecVenta`, `fecEnvio`, `linkSeguimiento`, `enviarADirAlt`, `dtosFacNombre`, `dtosFacApellido`, `dtosFacDireccion`, `dtosFacProvincia`, `dtosFacLocCiudad`, `dtosFacCodPostal`, `dtosFacTelefono`, `dtosFacCorreoE`, `dtosAltNombre`, `dtosAltApellido`, `dtosAltDireccion`, `dtosAltProvincia`, `dtosAltLocCiudad`, `dtosAltCodPostal`, `dtosFacNotas`, `totalEnvio`, `totalPedido`, `totalDescTransfer`, `formaDePago`, `enviarPor`, `created_at`, `updated_at`) VALUES
	(1, '68d5d523-94ef-4d3c-b89e-f5b4bc712292', 86757209, 2, '2025-11-24 22:08:55', '2025-11-24 23:37:49', 'Esta es la confirmación de despacho via cargo de tu producto, espero que lo disfrutes y que te sirva un montón.', 1, 'Rene', 'Merlo', '558 Antonio Machado', 1, 'CABA', '1405', '01149820586', 'rmerlo@gmail.com', 'Rene', 'Merlo', '558 Antonio Machado', 1, 'CABA', '1405', 'Esta es una prueba de transferencia de datos', 7500.000000, 115500.000000, 36000.000000, 1, 1, '2025-11-25 01:08:55', '2025-11-25 02:37:49'),
	(2, 'd67dae30-4c37-42a2-9299-c78573a23e23', 77108974, 2, '2025-11-24 23:48:58', '2025-11-24 23:54:37', 'link de seguimiento', 2, 'Rene', 'Merlo', '558 Antonio Machado', 1, 'CABA', '1405', '01149820586', 'rmerlo@gmail.com', '', '', '', 0, '', '', '', 0.000000, 36000.000000, 12000.000000, 1, 3, '2025-11-25 02:48:58', '2025-11-25 02:54:37');

-- Volcando estructura para tabla bd_petalostextil.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomApe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefonos` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `activation_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validation_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validation_expires` timestamp NULL DEFAULT NULL,
  `estado` tinyint unsigned DEFAULT NULL,
  `rol` tinyint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla bd_petalostextil.users: ~2 rows (aproximadamente)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `nomApe`, `telefonos`, `email_verified_at`, `password`, `activation_token`, `remember_token`, `validation_token`, `validation_expires`, `estado`, `rol`, `created_at`, `updated_at`) VALUES
	(1, 'rmerlo', 'rmerlo@gmail.com', 'René Merlo', '', NULL, '$2y$12$h47JR8tPXxPqah/OdwogAO0no/iWLIOXBen3PpXf9ignMxhSFi8q6', NULL, NULL, NULL, NULL, 1, 2, '2025-09-26 22:03:31', '2025-11-08 22:36:33'),
	(15, 'Natalia Merlo', 'natimerlo95@gmail.com', 'Natalia Merlo', NULL, NULL, '$2y$12$0Y/qEEujBEzjz38i70r4O.zMRIvc2Q4ENWQRQJfQjlcmQGrP3Ml7K', '', NULL, NULL, NULL, 1, 2, '2025-10-14 23:53:33', '2025-10-14 23:53:33');

-- Volcando estructura para vista bd_petalostextil.vta_carrito
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `vta_carrito` (
	`id` INT NOT NULL,
	`guidCarrito` VARCHAR(1) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`idArticulo` INT NOT NULL,
	`cantidad` INT NOT NULL,
	`precioUnit` DECIMAL(20,2) NOT NULL,
	`nombre` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`stockActual` TINYINT NULL,
	`nomFoto` VARCHAR(1) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`estado` TINYINT NOT NULL
);

-- Volcando estructura para vista bd_petalostextil.vta_catalogo
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `vta_catalogo` (
	`id` INT NOT NULL,
	`codigo` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`categoria` TINYINT UNSIGNED NULL,
	`nomCategoria` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`nombre` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`precio` DECIMAL(20,2) NULL,
	`nomFoto` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`cuotas` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`descPorTransfer` TINYINT NULL,
	`stockActual` TINYINT NULL,
	`visitas` INT NULL,
	`descrip` LONGTEXT NULL COLLATE 'utf8mb4_unicode_ci',
	`compoKit` LONGTEXT NULL COLLATE 'utf8mb4_unicode_ci',
	`caracDest` LONGTEXT NULL COLLATE 'utf8mb4_unicode_ci',
	`usosRec` LONGTEXT NULL COLLATE 'utf8mb4_unicode_ci',
	`medidas` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`peso` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`notas` LONGTEXT NULL COLLATE 'utf8mb4_unicode_ci',
	`pausado` TINYINT NULL
);

-- Volcando estructura para vista bd_petalostextil.vta_envios_dir_alt
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `vta_envios_dir_alt` (
	`item` TINYINT NULL,
	`nombre` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci'
);

-- Volcando estructura para vista bd_petalostextil.vta_estado_pedidos
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `vta_estado_pedidos` (
	`item` TINYINT NULL,
	`nombre` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci'
);

-- Volcando estructura para vista bd_petalostextil.vta_forma_de_pago
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `vta_forma_de_pago` (
	`item` TINYINT NULL,
	`nombre` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci'
);

-- Volcando estructura para vista bd_petalostextil.vta_foto_principal
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `vta_foto_principal` (
	`id` INT NOT NULL,
	`id_articulo` INT NULL,
	`nro_foto` TINYINT NULL,
	`nomFoto` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`created_at` TIMESTAMP NULL,
	`updated_at` TIMESTAMP NULL
);

-- Volcando estructura para vista bd_petalostextil.vta_lista_de_ventas
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `vta_lista_de_ventas` (
	`id` INT NOT NULL,
	`guidCarrito` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`nroVenta` INT NULL,
	`estado` TINYINT NULL,
	`estadoDesc` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`fecVenta` DATETIME NULL,
	`fecEnvio` DATETIME NULL,
	`linkSeguimiento` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`enviarADirAlt` TINYINT NULL,
	`dtosFacNombre` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`dtosFacApellido` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`dtosFacDireccion` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`dtosFacProvincia` TINYINT NULL,
	`dtosFacProvinciaNombre` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`dtosFacLocCiudad` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`dtosFacCodPostal` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`dtosFacTelefono` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`dtosFacCorreoE` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`dtosAltNombre` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`dtosAltApellido` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`dtosAltDireccion` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`dtosAltProvincia` TINYINT NULL,
	`dtosAltProvinciaNombre` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`dtosAltLocCiudad` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`dtosAltCodPostal` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`dtosFacNotas` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`formaDePago` TINYINT NULL,
	`formaDePagoDesc` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`totalPedido` DECIMAL(20,6) NULL,
	`totalEnvio` DECIMAL(20,6) NULL,
	`totalDescTransfer` DECIMAL(20,6) NULL,
	`enviarPor` TINYINT NULL
);

-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `vta_carrito`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vta_carrito` AS select `a`.`id` AS `id`,`a`.`guidCarrito` AS `guidCarrito`,`a`.`idArticulo` AS `idArticulo`,`a`.`cantidad` AS `cantidad`,`a`.`precioUnit` AS `precioUnit`,`b`.`nombre` AS `nombre`,`b`.`stockActual` AS `stockActual`,`a`.`nomFoto` AS `nomFoto`,`a`.`estado` AS `estado` from (`tb_carrito` `a` join `tb_articulos` `b` on((`a`.`idArticulo` = `b`.`id`)))
;

-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `vta_catalogo`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vta_catalogo` AS select `a`.`id` AS `id`,`a`.`codigo` AS `codigo`,`a`.`categoria` AS `categoria`,`c`.`nombre` AS `nomCategoria`,`a`.`nombre` AS `nombre`,`a`.`precio` AS `precio`,`b`.`nomFoto` AS `nomFoto`,`a`.`cuotas` AS `cuotas`,`a`.`descPorTransfer` AS `descPorTransfer`,`a`.`stockActual` AS `stockActual`,`a`.`visitas` AS `visitas`,`a`.`descrip` AS `descrip`,`a`.`compoKit` AS `compoKit`,`a`.`caracDest` AS `caracDest`,`a`.`usosRec` AS `usosRec`,`a`.`medidas` AS `medidas`,`a`.`peso` AS `peso`,`a`.`notas` AS `notas`,`a`.`pausado` AS `pausado` from ((`tb_articulos` `a` left join `vta_foto_principal` `b` on((`a`.`id` = `b`.`id_articulo`))) left join `tb_categorias` `c` on((`a`.`categoria` = `c`.`id`)))
;

-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `vta_envios_dir_alt`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vta_envios_dir_alt` AS select `a`.`item` AS `item`,`a`.`nombre` AS `nombre` from `tb_variables` `a` where (`a`.`idVariable` = 2)
;

-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `vta_estado_pedidos`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vta_estado_pedidos` AS select `a`.`item` AS `item`,`a`.`nombre` AS `nombre` from `tb_variables` `a` where (`a`.`idVariable` = 1)
;

-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `vta_forma_de_pago`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vta_forma_de_pago` AS select `a`.`item` AS `item`,`a`.`nombre` AS `nombre` from `tb_variables` `a` where (`a`.`idVariable` = 3)
;

-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `vta_foto_principal`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vta_foto_principal` AS select `a`.`id` AS `id`,`a`.`id_articulo` AS `id_articulo`,`a`.`nro_foto` AS `nro_foto`,`a`.`nomFoto` AS `nomFoto`,`a`.`created_at` AS `created_at`,`a`.`updated_at` AS `updated_at` from `tb_fotos` `a` where (`a`.`nro_foto` = 1)
;

-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `vta_lista_de_ventas`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vta_lista_de_ventas` AS select `a`.`id` AS `id`,`a`.`guidCarrito` AS `guidCarrito`,`a`.`nroVenta` AS `nroVenta`,`a`.`estado` AS `estado`,`b`.`nombre` AS `estadoDesc`,`a`.`fecVenta` AS `fecVenta`,`a`.`fecEnvio` AS `fecEnvio`,`a`.`linkSeguimiento` AS `linkSeguimiento`,`a`.`enviarADirAlt` AS `enviarADirAlt`,`a`.`dtosFacNombre` AS `dtosFacNombre`,`a`.`dtosFacApellido` AS `dtosFacApellido`,`a`.`dtosFacDireccion` AS `dtosFacDireccion`,`a`.`dtosFacProvincia` AS `dtosFacProvincia`,`d`.`nombre` AS `dtosFacProvinciaNombre`,`a`.`dtosFacLocCiudad` AS `dtosFacLocCiudad`,`a`.`dtosFacCodPostal` AS `dtosFacCodPostal`,`a`.`dtosFacTelefono` AS `dtosFacTelefono`,`a`.`dtosFacCorreoE` AS `dtosFacCorreoE`,`a`.`dtosAltNombre` AS `dtosAltNombre`,`a`.`dtosAltApellido` AS `dtosAltApellido`,`a`.`dtosAltDireccion` AS `dtosAltDireccion`,`a`.`dtosAltProvincia` AS `dtosAltProvincia`,`e`.`nombre` AS `dtosAltProvinciaNombre`,`a`.`dtosAltLocCiudad` AS `dtosAltLocCiudad`,`a`.`dtosAltCodPostal` AS `dtosAltCodPostal`,`a`.`dtosFacNotas` AS `dtosFacNotas`,`a`.`formaDePago` AS `formaDePago`,`c`.`nombre` AS `formaDePagoDesc`,`a`.`totalPedido` AS `totalPedido`,`a`.`totalEnvio` AS `totalEnvio`,`a`.`totalDescTransfer` AS `totalDescTransfer`,`a`.`enviarPor` AS `enviarPor` from ((((`tb_ventas` `a` left join `vta_estado_pedidos` `b` on((`a`.`estado` = `b`.`item`))) left join `vta_forma_de_pago` `c` on((`a`.`formaDePago` = `c`.`item`))) left join `tb_provincias` `d` on((`a`.`dtosFacProvincia` = `d`.`id`))) left join `tb_provincias` `e` on((`a`.`dtosAltProvincia` = `e`.`id`)))
;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
