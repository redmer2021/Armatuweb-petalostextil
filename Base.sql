/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `cache`;

CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `cache_locks`;

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `failed_jobs`;

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `jobs`;

CREATE TABLE IF NOT EXISTS `job_batches` (
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

DELETE FROM `job_batches`;

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1);

CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `password_reset_tokens`;

CREATE TABLE IF NOT EXISTS `sessions` (
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

DELETE FROM `sessions`;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('ucgwLL6SjqQvmXo3vxtJQOl20D6cb5eLMRw93qOQ', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaFJtUmcxcFBydjUzTUQxeWwxZXQ4ajdHb0s5cXBCYW5CNkdYdW5TeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wYW5lbERlQ29udHJvbCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1762289147);

CREATE TABLE IF NOT EXISTS `tb_articulos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoria` tinyint unsigned DEFAULT NULL,
  `nombre` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descrip` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `compoKit` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `caracDest` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `usosRec` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `notas` longtext COLLATE utf8mb4_unicode_ci,
  `medidas` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peso` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cuotas` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio` decimal(20,2) DEFAULT NULL,
  `descPorTransfer` tinyint DEFAULT NULL,
  `stockActual` tinyint DEFAULT NULL,
  `visitas` int DEFAULT NULL,
  `pausado` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `tb_articulos`;
INSERT INTO `tb_articulos` (`id`, `codigo`, `categoria`, `nombre`, `descrip`, `compoKit`, `caracDest`, `usosRec`, `notas`, `medidas`, `peso`, `cuotas`, `precio`, `descPorTransfer`, `stockActual`, `visitas`, `pausado`, `created_at`, `updated_at`) VALUES
	(1, 'ASD124', 1, 'Flores de Japón', NULL, NULL, NULL, NULL, NULL, '144 cm x 200 cm', '120 g', '3 cuotas sin interés de 14,166.66', 42500.00, 25, 10, 1414, 1, '2025-09-10 20:09:02', '2025-09-10 20:09:02'),
	(2, 'FDS100', 1, 'Almendrado', NULL, NULL, NULL, NULL, NULL, '144 cm x 200 cm', '120 g', '3 cuotas sin interés de 14,166.66', 42500.00, 25, 25, 501, 2, '2025-09-10 20:10:33', '2025-09-10 20:10:34'),
	(3, 'SDK123', 2, 'Repasadores nido de avejas - pack x 4', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam qui aspernatur voluptatem nobis. Autem quidem illo dicta sequi asperiores cupiditate, dolor maiores reprehenderit explicabo facere, doloremque velit suscipit, laborum optio.     Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam qui aspernatur voluptatem nobis. Autem quidem illo dicta sequi asperiores cupiditate, dolor maiores reprehenderit explicabo facere, doloremque velit suscipit, laborum optio.     Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam qui aspernatur voluptatem nobis. Autem quidem illo dicta sequi asperiores cupiditate, dolor maiores reprehenderit explicabo facere, doloremque velit suscipit, laborum optio.    ', NULL, NULL, NULL, NULL, '50 cm x 67 cm', '40 g', NULL, 10000.00, 25, 5, 1125, 2, '2025-09-10 20:12:12', '2025-09-10 20:12:13'),
	(4, 'KJD333', 3, 'Toallón con capucha - Espacial', 'TOALLÓN CON CAPUCHA + 2 TOALLITAS DE MANO – 100% ALGODÓN DOBLE FELPA\r\nIdeal para la rutina diaria de tu bebé. Combina suavidad, comodidad y funcionalidad en un solo producto. Perfecto para usar en casa, en el jardín o llevar en el bolso.\r\n', '- 1 toallón con capucha – Medida: 80 x 80 cm\r\nConfeccionado en algodón doble felpa ultra absorbente. Su capucha lo hace ideal para envolver al bebé luego del baño, manteniéndolo seco y abrigado.\r\n\r\n- 2 toallitas de mano – Medida: 30 x 40 cm\r\nPrácticas para llevar al jardín, usar como pañito multiuso o tener siempre a mano en el bolso del bebé.\r\n\r\nConfeccionado en algodón doble felpa 100%, extra suave al tacto, con excelente absorción y durabilidad.', 'Algodón 100% doble felpa: extra suave al tacto y de gran absorción.\r\nCosturas reforzadas para mayor durabilidad.\r\nNo pierde suavidad con los lavados.\r\nApto para lavarropas.\r\nEstampados infantiles con motivos delicados y colores suaves.\r\nConsultá disponibilidad al momento de comprar para elegir tu diseño preferido.\r\n', '- Bebés recién nacidos y niños pequeños.\r\n- Salida del baño.\r\n- Jardín maternal.\r\n- Regalo de nacimiento o baby shower.', 'El color del producto puede variar levemente en relación con la imagen, debido a la iluminación y la partida del tejido.\r\nLa imágenes son a modo de ilustración. ', '80 cm x 80 cm', '240 g', '6 cuotas sin interés de 3,666.66', 24000.00, 25, 100, 43, 1, '2025-09-10 20:13:41', '2025-09-10 20:13:41');

CREATE TABLE IF NOT EXISTS `tb_carrito` (
  `id` int NOT NULL AUTO_INCREMENT,
  `guidCarrito` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `idArticulo` int NOT NULL,
  `cantidad` int NOT NULL,
  `precioUnit` decimal(20,2) NOT NULL DEFAULT '0.00',
  `estado` tinyint NOT NULL DEFAULT (0),
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `tb_carrito`;
INSERT INTO `tb_carrito` (`id`, `guidCarrito`, `idArticulo`, `cantidad`, `precioUnit`, `estado`, `created_at`, `updated_at`) VALUES
	(54, '615cc623-d6ba-4498-a627-73a777a24138', 4, 1, 24000.00, 1, '2025-10-29 19:00:41', '2025-10-29 19:55:24'),
	(55, '615cc623-d6ba-4498-a627-73a777a24138', 3, 1, 10000.00, 1, '2025-10-29 19:10:21', '2025-10-29 19:55:24'),
	(56, '615cc623-d6ba-4498-a627-73a777a24138', 1, 1, 42500.00, 1, '2025-10-29 19:54:57', '2025-10-29 19:55:24'),
	(58, 'fbc60019-dd02-4384-bc5e-66fe3dc9be83', 2, 1, 42500.00, 0, '2025-10-29 20:00:27', '2025-10-29 20:00:27'),
	(59, '81d00768-ac67-4812-a13d-a9edff187b8e', 3, 1, 10000.00, 1, '2025-10-29 20:06:29', '2025-10-29 20:14:08'),
	(60, '81d00768-ac67-4812-a13d-a9edff187b8e', 2, 1, 42500.00, 0, '2025-10-29 20:14:07', '2025-10-29 20:14:07'),
	(61, '522a3414-afcf-468e-9939-ee4ac6bdb66c', 1, 1, 42500.00, 1, '2025-10-29 20:14:45', '2025-10-29 20:16:19'),
	(62, '522a3414-afcf-468e-9939-ee4ac6bdb66c', 4, 2, 24000.00, 0, '2025-10-29 20:16:18', '2025-10-29 20:16:21'),
	(63, '6a70a6b3-eb8b-47a8-bef4-ae47ecfcd28f', 2, 1, 42500.00, 1, '2025-10-29 20:16:37', '2025-10-29 20:19:09'),
	(64, '6a70a6b3-eb8b-47a8-bef4-ae47ecfcd28f', 1, 1, 42500.00, 0, '2025-10-29 20:19:08', '2025-10-29 20:19:08'),
	(65, 'c7cf3427-8c13-49d2-b2f4-af8647a3c511', 1, 2, 42500.00, 1, '2025-10-29 20:19:34', '2025-10-29 20:22:00'),
	(66, 'c7cf3427-8c13-49d2-b2f4-af8647a3c511', 4, 3, 24000.00, 1, '2025-10-29 20:21:15', '2025-10-29 20:22:00'),
	(68, 'a9885d46-c417-413d-ab93-1826bb1ad98f', 2, 3, 42500.00, 1, '2025-11-03 14:08:23', '2025-11-03 14:13:04'),
	(69, 'a9885d46-c417-413d-ab93-1826bb1ad98f', 4, 1, 24000.00, 1, '2025-11-03 14:11:52', '2025-11-03 14:12:20'),
	(70, '45d10d22-7e82-4825-85bb-9c2ee030d530', 3, 1, 10000.00, 1, '2025-11-03 14:13:18', '2025-11-03 15:08:22');

CREATE TABLE IF NOT EXISTS `tb_categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `tb_categorias`;
INSERT INTO `tb_categorias` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
	(1, 'Manteles', '2025-09-15 18:03:31', '2025-09-15 18:03:31'),
	(2, 'Repasadores', '2025-09-15 18:03:31', '2025-09-15 18:03:31'),
	(3, 'Toallones bebé', '2025-09-15 18:03:31', '2025-09-15 18:03:31'),
	(4, 'Almohadones', '2025-09-15 18:03:31', '2025-09-15 18:03:31'),
	(5, 'Toallones', '2025-09-15 18:03:31', '2025-09-15 18:03:31'),
	(6, 'Flores de tela', '2025-09-15 18:03:31', '2025-09-15 18:03:31'),
	(7, 'Turbantes', '2025-09-15 18:03:31', '2025-09-15 18:03:31'),
	(8, 'Delantales', '2025-09-15 18:03:31', '2025-09-15 18:03:31'),
	(9, 'Cortinas', '2025-09-15 18:03:31', '2025-09-15 18:03:31');

CREATE TABLE IF NOT EXISTS `tb_direc_envios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idUser` bigint DEFAULT NULL,
  `tipDirec` tinyint DEFAULT NULL,
  `direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localidad` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barrio` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idProvincia` tinyint DEFAULT NULL,
  `codPostal` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `tb_direc_envios`;
INSERT INTO `tb_direc_envios` (`id`, `idUser`, `tipDirec`, `direccion`, `localidad`, `barrio`, `idProvincia`, `codPostal`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Antonio Machado', 'CABA', '558', 24, '1405', '2025-10-02 18:02:43', '2025-10-02 18:03:39'),
	(3, 3, 1, 'Antonio Machado 558', 'Caballito', 'Caballito', 24, '1405', '2025-10-15 14:49:58', '2025-11-03 17:23:30'),
	(6, 6, 1, 'Calle y altura - editado', '', 'Caballito - editado', 24, '1405', '2025-11-03 14:46:40', '2025-11-03 14:48:00');

CREATE TABLE IF NOT EXISTS `tb_envios_pendientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `guidCarrito` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dirCalleAltura` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dirProvincia` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dirLocalidad` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dirBarrio` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dirCodPostal` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dirEntreCalles` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint DEFAULT NULL,
  `enviarPor` tinyint DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `tb_envios_pendientes`;
INSERT INTO `tb_envios_pendientes` (`id`, `guidCarrito`, `dirCalleAltura`, `dirProvincia`, `dirLocalidad`, `dirBarrio`, `dirCodPostal`, `dirEntreCalles`, `estado`, `enviarPor`, `created_at`, `updated_at`) VALUES
	(1, '615cc623-d6ba-4498-a627-73a777a24138', 'Antonio Machado', 'buenos aires', 'Caballito', NULL, '1405', 'Ambroseti y Acoyte', 0, 1, '2025-10-29 16:50:03', '2025-10-29 16:50:03'),
	(2, '615cc623-d6ba-4498-a627-73a777a24138', 'uno', 'tres', 'cuatro', NULL, 'cinco', 'seis', 0, 1, '2025-10-29 16:55:24', '2025-10-29 16:55:24'),
	(3, 'a9885d46-c417-413d-ab93-1826bb1ad98f', 'Antonio Machado 558', '1', 'Caballito', '', '1405', '', 0, 1, '2025-11-03 11:11:24', '2025-11-03 11:11:24'),
	(4, 'a9885d46-c417-413d-ab93-1826bb1ad98f', 'Antonio Machado 558', '24', '', 'Caballito', '1405', '', 0, 2, '2025-11-03 11:12:20', '2025-11-03 11:12:20'),
	(5, '45d10d22-7e82-4825-85bb-9c2ee030d530', 'Calle y altura - editado', '24', '', 'Caballito - editado', '1405', 'RS - Editado', 0, 2, '2025-11-03 12:08:22', '2025-11-03 12:08:22');

CREATE TABLE IF NOT EXISTS `tb_fotos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_articulo` int DEFAULT NULL,
  `nro_foto` tinyint DEFAULT NULL,
  `nomFoto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `tb_fotos`;
INSERT INTO `tb_fotos` (`id`, `id_articulo`, `nro_foto`, `nomFoto`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '524412691_17861635677444131_5128841696800824046_n.webp', '2025-09-10 23:15:00', '2025-09-10 23:15:01'),
	(2, 2, 1, '523932479_17861635650444131_7019052093686442167_n.webp', '2025-09-10 23:16:13', '2025-09-10 23:16:14'),
	(3, 3, 1, '524378155_17861270319444131_4858165964405648848_n.webp', '2025-09-10 23:16:53', '2025-09-10 23:16:53'),
	(4, 4, 1, '527938130_17862732834444131_8614832077531511354_n.webp', '2025-09-10 23:16:53', '2025-09-10 23:16:53'),
	(5, 1, 2, '523932479_17861635650444131_7019052093686442167_n.webp', '2025-09-10 23:16:53', '2025-09-10 23:16:53'),
	(6, 1, 3, '524398293_17861635668444131_9079809091768109536_n.webp', '2025-09-10 23:16:53', '2025-09-10 23:16:53'),
	(7, 1, 4, '524890003_17861635638444131_7354434449787566008_n.webp', '2025-09-10 23:16:53', '2025-09-10 23:16:53'),
	(8, 3, 2, '522278642_17861270310444131_6915188114892089691_n.webp', '2025-09-10 23:16:53', '2025-09-10 23:16:53'),
	(9, 3, 3, '524378155_17861270319444131_4858165964405648848_n.webp', '2025-09-10 23:16:53', '2025-09-10 23:16:53'),
	(10, 3, 4, '527145330_17862336756444131_7099154658963453433_n.webp', '2025-09-10 23:16:53', '2025-09-10 23:16:53'),
	(11, 3, 5, '527188967_17862336747444131_9082503933697181980_n.webp', '2025-09-10 23:16:53', '2025-09-10 23:16:53'),
	(12, 4, 2, '527276334_17862732762444131_9165476238841151670_n.webp', '2025-09-10 23:16:53', '2025-09-10 23:16:53'),
	(13, 4, 3, '528322835_17862732807444131_4680481195230986907_n.webp', '2025-09-10 23:16:53', '2025-09-10 23:16:53'),
	(14, 2, 2, '527238038_17862335967444131_3999704133648464046_n.webp', '2025-09-10 23:16:13', '2025-09-10 23:16:13'),
	(15, 2, 3, '527292099_17862335976444131_2310943107417420591_n.webp', '2025-09-10 23:16:13', '2025-09-10 23:16:13');

CREATE TABLE IF NOT EXISTS `tb_provincias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `impoEnvio` decimal(20,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `tb_provincias`;
INSERT INTO `tb_provincias` (`id`, `nombre`, `impoEnvio`, `created_at`, `updated_at`) VALUES
	(1, 'BUENOS AIRES', 1000.00, '2021-05-02 00:39:48', '2021-05-02 00:39:48'),
	(2, 'CATAMARCA', 1000.00, '2021-05-02 00:39:48', '2021-05-02 00:39:48'),
	(3, 'CÓRDOBA', 1000.00, '2021-05-02 00:39:48', '2021-05-02 00:39:48'),
	(4, 'CORRIENTES', 1000.00, '2021-05-02 00:39:48', '2021-05-02 00:39:48'),
	(5, 'CHACO', 1000.00, '2021-05-02 00:39:48', '2021-05-02 00:39:48'),
	(6, 'CHUBUT', 1000.00, '2021-05-02 00:39:48', '2021-05-02 00:39:48'),
	(7, 'ENTRE RIOS', 1000.00, '2021-05-02 00:39:48', '2021-05-02 00:39:48'),
	(8, 'FORMOSA', 1000.00, '2021-05-02 00:39:48', '2021-05-02 00:39:48'),
	(9, 'JUJUY', 1000.00, '2021-05-02 00:39:48', '2021-05-02 00:39:48'),
	(10, 'LA PAMPA', 1000.00, '2021-05-02 00:39:48', '2021-05-02 00:39:48'),
	(11, 'LA RIOJA', 1000.00, '2021-05-02 00:39:48', '2021-05-02 00:39:48'),
	(12, 'MENDOZA', 1000.00, '2021-05-02 00:39:48', '2021-05-02 00:39:48'),
	(13, 'MISIONES', 1000.00, '2021-05-02 00:39:48', '2021-05-02 00:39:48'),
	(14, 'NEUQUEN', 1000.00, '2021-05-02 00:39:48', '2021-05-02 00:39:48'),
	(15, 'RIO NEGRO', 1000.00, '2021-05-02 00:39:48', '2021-05-02 00:39:48'),
	(16, 'SALTA', 1000.00, '2021-05-02 00:39:48', '2021-05-02 00:39:48'),
	(17, 'SAN JUAN', 1000.00, '2021-05-02 00:39:48', '2021-05-02 00:39:48'),
	(18, 'SAN LUIS', 1000.00, '2021-05-02 00:39:48', '2021-05-02 00:39:48'),
	(19, 'SANTA CRUZ', 1000.00, '2021-05-02 00:39:48', '2021-05-02 00:39:48'),
	(20, 'SANTA FE', 1000.00, '2021-05-02 00:39:48', '2021-05-02 00:39:48'),
	(21, 'SANTIAGO DEL ESTERO', 1000.00, '2021-05-02 00:39:48', '2021-05-02 00:39:48'),
	(22, 'TIERRA DEL FUEGO', 1000.00, '2021-05-02 00:39:48', '2021-05-02 00:39:48'),
	(23, 'TUCUMÁN', 1000.00, '2021-05-02 00:39:48', '2021-05-02 00:39:48'),
	(24, 'CIUDAD DE BUENOS AIRES', 1000.00, '2021-05-02 00:39:48', '2021-05-02 00:39:48');

CREATE TABLE IF NOT EXISTS `tb_suscriptores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `tb_suscriptores`;
INSERT INTO `tb_suscriptores` (`id`, `email`, `created_at`, `updated_at`) VALUES
	(1, 'rmerlo@gmail.com', '2025-10-28 19:25:16', '2025-10-28 19:25:16'),
	(3, 'rdm1@gmail.com', '2025-10-28 19:35:01', '2025-10-28 19:35:01'),
	(4, 'rmerlo1@gmail.com', '2025-10-28 19:35:34', '2025-10-28 19:35:34'),
	(5, 'rmerlo@gmail.com.ar', '2025-10-28 19:36:19', '2025-10-28 19:36:19'),
	(6, 'rmerlo2@gmail.com', '2025-10-28 19:45:26', '2025-10-28 19:45:26');

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomApe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefonos` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activation_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validation_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validation_expires` datetime DEFAULT NULL,
  `estado` tinyint unsigned DEFAULT NULL,
  `rol` tinyint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `nomApe`, `telefonos`, `email_verified_at`, `password`, `remember_token`, `activation_token`, `validation_token`, `validation_expires`, `estado`, `rol`, `created_at`, `updated_at`) VALUES
	(3, 'Rene Daniel Merlo', 'rmerlo@gmail.com', 'Rene Daniel Merlo', NULL, NULL, '$2y$12$Q.yKq40ZDwan0XVg0LM3fu8BoEP.x7Nl6PkU1UQjz1G7JBZTwbM.e', NULL, '', NULL, NULL, 1, 2, '2025-10-15 14:49:57', '2025-11-03 17:23:30'),
	(6, 'rdm', 'rdm@gmail.com', 'rdm', NULL, NULL, '$2y$12$hFmyCNtazuIjWMZ/VZPG9etnUsh5upjgmhw2KzGUkuw7shJ2ziQ12', NULL, '', NULL, NULL, 1, 1, '2025-11-03 14:46:40', '2025-11-03 14:48:00');

CREATE TABLE `vta_carrito` (
	`id` INT NOT NULL,
	`guidCarrito` VARCHAR(1) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`idArticulo` INT NOT NULL,
	`cantidad` INT NOT NULL,
	`precioUnit` DECIMAL(20,2) NOT NULL,
	`nombre` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`stockActual` TINYINT NULL,
	`nro_foto` TINYINT NULL,
	`nomFoto` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`estado` TINYINT NOT NULL
);

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

CREATE TABLE `vta_foto_principal` (
	`id` INT NOT NULL,
	`id_articulo` INT NULL,
	`nro_foto` TINYINT NULL,
	`nomFoto` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`created_at` TIMESTAMP NULL,
	`updated_at` TIMESTAMP NULL
);

DROP TABLE IF EXISTS `vta_carrito`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vta_carrito` AS select `a`.`id` AS `id`,`a`.`guidCarrito` AS `guidCarrito`,`a`.`idArticulo` AS `idArticulo`,`a`.`cantidad` AS `cantidad`,`a`.`precioUnit` AS `precioUnit`,`b`.`nombre` AS `nombre`,`b`.`stockActual` AS `stockActual`,`c`.`nro_foto` AS `nro_foto`,`c`.`nomFoto` AS `nomFoto`,`a`.`estado` AS `estado` from ((`tb_carrito` `a` join `tb_articulos` `b` on((`a`.`idArticulo` = `b`.`id`))) join `vta_foto_principal` `c` on((`a`.`idArticulo` = `c`.`id_articulo`)))
;

DROP TABLE IF EXISTS `vta_catalogo`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vta_catalogo` AS select `a`.`id` AS `id`,`a`.`codigo` AS `codigo`,`a`.`categoria` AS `categoria`,`c`.`nombre` AS `nomCategoria`,`a`.`nombre` AS `nombre`,`a`.`precio` AS `precio`,`b`.`nomFoto` AS `nomFoto`,`a`.`cuotas` AS `cuotas`,`a`.`descPorTransfer` AS `descPorTransfer`,`a`.`stockActual` AS `stockActual`,`a`.`visitas` AS `visitas`,`a`.`descrip` AS `descrip`,`a`.`compoKit` AS `compoKit`,`a`.`caracDest` AS `caracDest`,`a`.`usosRec` AS `usosRec`,`a`.`medidas` AS `medidas`,`a`.`peso` AS `peso`,`a`.`notas` AS `notas`,`a`.`pausado` AS `pausado` from ((`tb_articulos` `a` join `vta_foto_principal` `b` on((`a`.`id` = `b`.`id_articulo`))) join `tb_categorias` `c` on((`a`.`categoria` = `c`.`id`)))
;

DROP TABLE IF EXISTS `vta_foto_principal`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vta_foto_principal` AS select `a`.`id` AS `id`,`a`.`id_articulo` AS `id_articulo`,`a`.`nro_foto` AS `nro_foto`,`a`.`nomFoto` AS `nomFoto`,`a`.`created_at` AS `created_at`,`a`.`updated_at` AS `updated_at` from `tb_fotos` `a` where (`a`.`nro_foto` = 1)
;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
