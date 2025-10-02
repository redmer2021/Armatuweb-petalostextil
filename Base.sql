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
	('JJ3fnhRkW7VQJE3KrT708k8a3N5eTDs1duBhrulT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYU81NEJUY2k2RVkzWnlzb3FvU0htVUN3bkQya2NlY1Z3MGc1VVJuQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758919454);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `tb_articulos`;
INSERT INTO `tb_articulos` (`id`, `codigo`, `categoria`, `nombre`, `descrip`, `compoKit`, `caracDest`, `usosRec`, `notas`, `medidas`, `peso`, `cuotas`, `precio`, `descPorTransfer`, `stockActual`, `visitas`, `created_at`, `updated_at`) VALUES
	(1, 'ASD124', 1, 'Flores de Japón', NULL, NULL, NULL, NULL, NULL, '144 cm x 200 cm', '120 g', '3 cuotas sin interés de 14,166.66', 42500.00, 5, 10, 1412, '2025-09-10 20:09:02', '2025-09-10 20:09:02'),
	(2, 'FDS100', 1, 'Almendrado', NULL, NULL, NULL, NULL, NULL, '144 cm x 200 cm', '120 g', '3 cuotas sin interés de 14,166.66', 42500.00, 10, 25, 500, '2025-09-10 20:10:33', '2025-09-10 20:10:34'),
	(3, 'SDK123', 2, 'Repasadores nido de avejas - pack x 4', NULL, NULL, NULL, NULL, NULL, '50 cm x 67 cm', '40 g', NULL, 10000.00, 25, 5, 1125, '2025-09-10 20:12:12', '2025-09-10 20:12:13'),
	(4, 'KJD333', 3, 'Toallón con capucha - Espacial', 'TOALLÓN CON CAPUCHA + 2 TOALLITAS DE MANO – 100% ALGODÓN DOBLE FELPA\r\nIdeal para la rutina diaria de tu bebé. Combina suavidad, comodidad y funcionalidad en un solo producto. Perfecto para usar en casa, en el jardín o llevar en el bolso.\r\n', '- 1 toallón con capucha – Medida: 80 x 80 cm\r\nConfeccionado en algodón doble felpa ultra absorbente. Su capucha lo hace ideal para envolver al bebé luego del baño, manteniéndolo seco y abrigado.\r\n\r\n- 2 toallitas de mano – Medida: 30 x 40 cm\r\nPrácticas para llevar al jardín, usar como pañito multiuso o tener siempre a mano en el bolso del bebé.\r\n\r\nConfeccionado en algodón doble felpa 100%, extra suave al tacto, con excelente absorción y durabilidad.', 'Algodón 100% doble felpa: extra suave al tacto y de gran absorción.\r\nCosturas reforzadas para mayor durabilidad.\r\nNo pierde suavidad con los lavados.\r\nApto para lavarropas.\r\nEstampados infantiles con motivos delicados y colores suaves.\r\nConsultá disponibilidad al momento de comprar para elegir tu diseño preferido.\r\n', '- Bebés recién nacidos y niños pequeños.\r\n- Salida del baño.\r\n- Jardín maternal.\r\n- Regalo de nacimiento o baby shower.', 'El color del producto puede variar levemente en relación con la imagen, debido a la iluminación y la partida del tejido.\r\nLa imágenes son a modo de ilustración. ', '80 cm x 80 cm', '240 g', '6 cuotas sin interés de 3,666.66', 24000.00, 30, 100, 41, '2025-09-10 20:13:41', '2025-09-10 20:13:41');

CREATE TABLE IF NOT EXISTS `tb_carrito` (
  `id` int NOT NULL AUTO_INCREMENT,
  `guidCarrito` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `idArticulo` int NOT NULL,
  `cantidad` int NOT NULL,
  `precioUnit` decimal(20,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `tb_carrito`;
INSERT INTO `tb_carrito` (`id`, `guidCarrito`, `idArticulo`, `cantidad`, `precioUnit`, `created_at`, `updated_at`) VALUES
	(33, '615cc623-d6ba-4498-a627-73a777a24138', 3, 2, 10000.00, '2025-09-19 21:31:37', '2025-09-26 18:01:52'),
	(35, '615cc623-d6ba-4498-a627-73a777a24138', 4, 2, 24000.00, '2025-09-22 17:23:54', '2025-09-26 18:01:52'),
	(36, '615cc623-d6ba-4498-a627-73a777a24138', 2, 2, 42500.00, '2025-09-22 20:58:48', '2025-09-26 18:01:52');

CREATE TABLE IF NOT EXISTS `tb_categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `tb_categorias`;
INSERT INTO `tb_categorias` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
	(1, 'Manteles', '2025-09-15 18:03:31', '2025-09-15 18:03:31'),
	(2, 'Repasadores', '2025-09-15 18:03:31', '2025-09-15 18:03:31'),
	(3, 'Toallones bebé', '2025-09-15 18:03:31', '2025-09-15 18:03:31'),
	(4, 'Almohadones', '2025-09-15 18:03:31', '2025-09-15 18:03:31'),
	(5, 'Toallones', '2025-09-15 18:03:31', '2025-09-15 18:03:31'),
	(6, 'Flores de tela', '2025-09-15 18:03:31', '2025-09-15 18:03:31');

CREATE TABLE IF NOT EXISTS `tb_direc_envios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idUser` bigint DEFAULT NULL,
  `tipDirec` tinyint DEFAULT NULL,
  `calle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `altura` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localidad` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idProvincia` tinyint DEFAULT NULL,
  `codPostal` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `tb_direc_envios`;

CREATE TABLE IF NOT EXISTS `tb_fotos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_articulo` int DEFAULT NULL,
  `nro_foto` tinyint DEFAULT NULL,
  `nomFoto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `tb_fotos`;
INSERT INTO `tb_fotos` (`id`, `id_articulo`, `nro_foto`, `nomFoto`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '524412691_17861635677444131_5128841696800824046_n.webp', '2025-09-10 20:15:00', '2025-09-10 20:15:01'),
	(2, 2, 1, '523932479_17861635650444131_7019052093686442167_n.webp', '2025-09-10 20:16:13', '2025-09-10 20:16:14'),
	(3, 3, 1, '524378155_17861270319444131_4858165964405648848_n.webp', '2025-09-10 20:16:53', '2025-09-10 20:16:54'),
	(4, 4, 1, '527938130_17862732834444131_8614832077531511354_n.webp', '2025-09-10 20:17:35', '2025-09-10 20:17:36');

CREATE TABLE IF NOT EXISTS `tb_provincias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `tb_provincias`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomApe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefonos` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `nomApe`, `telefonos`, `email_verified_at`, `password`, `remember_token`, `estado`, `created_at`, `updated_at`) VALUES
	(1, 'rmerlo', 'rmerlo@gmail.com', 'René Merlo', '', NULL, '$2y$12$60mgICo388uwrQ15Jt0lEu8T8Nttz5aJmMPEGvyKkU5eklx2VzWPW', NULL, 1, '2025-09-26 19:03:31', '2025-09-26 19:03:31');

CREATE TABLE `vta_carrito` (
	`id` INT NOT NULL,
	`guidCarrito` VARCHAR(1) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`idArticulo` INT NOT NULL,
	`cantidad` INT NOT NULL,
	`precioUnit` DECIMAL(20,2) NOT NULL,
	`nombre` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`stockActual` TINYINT NULL,
	`nro_foto` TINYINT NULL,
	`nomFoto` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci'
);

CREATE TABLE `vta_catalogo` (
	`id` INT NOT NULL,
	`codigo` VARCHAR(1) NULL COLLATE 'utf8mb4_unicode_ci',
	`categoria` TINYINT UNSIGNED NULL,
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
	`notas` LONGTEXT NULL COLLATE 'utf8mb4_unicode_ci'
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
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vta_carrito` AS select `a`.`id` AS `id`,`a`.`guidCarrito` AS `guidCarrito`,`a`.`idArticulo` AS `idArticulo`,`a`.`cantidad` AS `cantidad`,`a`.`precioUnit` AS `precioUnit`,`b`.`nombre` AS `nombre`,`b`.`stockActual` AS `stockActual`,`c`.`nro_foto` AS `nro_foto`,`c`.`nomFoto` AS `nomFoto` from ((`tb_carrito` `a` join `tb_articulos` `b` on((`a`.`idArticulo` = `b`.`id`))) join `tb_fotos` `c` on((`a`.`idArticulo` = `c`.`id_articulo`)))
;

DROP TABLE IF EXISTS `vta_catalogo`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vta_catalogo` AS select `a`.`id` AS `id`,`a`.`codigo` AS `codigo`,`a`.`categoria` AS `categoria`,`a`.`nombre` AS `nombre`,`a`.`precio` AS `precio`,`b`.`nomFoto` AS `nomFoto`,`a`.`cuotas` AS `cuotas`,`a`.`descPorTransfer` AS `descPorTransfer`,`a`.`stockActual` AS `stockActual`,`a`.`visitas` AS `visitas`,`a`.`descrip` AS `descrip`,`a`.`compoKit` AS `compoKit`,`a`.`caracDest` AS `caracDest`,`a`.`usosRec` AS `usosRec`,`a`.`medidas` AS `medidas`,`a`.`peso` AS `peso`,`a`.`notas` AS `notas` from (`tb_articulos` `a` join `vta_foto_principal` `b` on((`a`.`id` = `b`.`id_articulo`)))
;

DROP TABLE IF EXISTS `vta_foto_principal`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vta_foto_principal` AS select `a`.`id` AS `id`,`a`.`id_articulo` AS `id_articulo`,`a`.`nro_foto` AS `nro_foto`,`a`.`nomFoto` AS `nomFoto`,`a`.`created_at` AS `created_at`,`a`.`updated_at` AS `updated_at` from `tb_fotos` `a` where (`a`.`nro_foto` = 1)
;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
