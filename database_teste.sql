-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- SO do servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- A despejar estrutura da base de dados para sanipower
CREATE DATABASE IF NOT EXISTS `sanipower` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sanipower`;

-- A despejar estrutura para tabela sanipower.carrinho_compras
CREATE TABLE IF NOT EXISTS `carrinho_compras` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_encomenda` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_proposta` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_cliente` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_user` int unsigned DEFAULT NULL,
  `referencia` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designacao` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `pvp` double(8,2) DEFAULT NULL,
  `discount` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qtd` int unsigned DEFAULT NULL,
  `iva` int DEFAULT NULL,
  `model` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_ref` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela sanipower.carrinho_compras: ~5 rows (aproximadamente)
DELETE FROM `carrinho_compras`;
INSERT INTO `carrinho_compras` (`id`, `id_encomenda`, `id_proposta`, `id_cliente`, `id_user`, `referencia`, `designacao`, `price`, `pvp`, `discount`, `qtd`, `iva`, `model`, `image_ref`, `created_at`, `updated_at`) VALUES
	(5, '5515c', '', '5515', 1, 'LGAC18BKNSK', 'LG® MonoSplit Mural Inverter Prestige R32 Wi-Fi Unidade Inte', 507.01, 780.01, '35%', 1, NULL, 'AC18BK.NSK', 'https://storage.sanipower.pt/storage/produtos/37/37-1-12.jpg', '2024-06-05 07:35:16', '2024-06-05 07:35:16'),
	(6, '5650A', '', '5650', 1, 'LGAC18BKNSK', 'LG® MonoSplit Mural Inverter Prestige R32 Wi-Fi Unidade Inte', 507.01, 780.01, '35%', 2, 12, 'AC18BK.NSK', 'https://storage.sanipower.pt/storage/produtos/37/37-1-12.jpg', '2024-06-05 14:20:15', '2024-06-05 14:20:15'),
	(8, '5650x', '', '5650', 1, 'AC-3NDA8255', 'Ar Condicionado Mono-Split Mural UE+UI R32', 892.53, 1785.06, '50%', 2, 12, '18.000 Btus', 'https://storage.sanipower.pt/storage/produtos/37-A/37-A-1-2.jpg', '2024-06-05 15:36:34', '2024-06-05 15:36:34'),
	(9, '5650x', '', '5650', 1, 'AC-XCOOL27R', 'Ar Condicionado Mono-Split Mural UE+UI R32', 440.00, 880.00, '50%', 4, 12, '9.000 Btus', 'https://storage.sanipower.pt/storage/produtos/37-A/37-A-1-2.jpg', '2024-06-05 15:36:34', '2024-06-05 15:36:34'),
	(10, '5650s', '', '5650', 1, 'AC-XCOOL27R', 'X-Cool® Pen Wi-FI', 440.00, 880.00, '50%', 2, 12, '9.000 Btus', 'https://storage.sanipower.pt/storage/produtos/37-A/37-A-1-4.jpg', '2024-06-05 15:37:58', '2024-06-05 15:37:58'),
	(11, '5650s', '', '5650', 1, 'AC-XWIFI', 'X-Cool® Pen Wi-FI', 27.00, 122.50, '', 2, 12, '', 'https://storage.sanipower.pt/storage/produtos/37-A/37-A-1-4.jpg', '2024-06-05 15:37:59', '2024-06-05 15:37:59'),
	(12, '', '5650M', '5650', 1, '2010100000', 'Joelho Latão F/F', 5.70, 11.40, '50%', 2, 12, '10cm - 1"', 'https://storage.sanipower.pt/storage/produtos/1/1-1-1.jpg', '2024-06-06 09:26:23', '2024-06-06 09:26:23'),
	(13, '', '5650M', '5650', 1, 'LGAC09BKNSJ', 'LG® MonoSplit Mural Inverter Prestige R32 Wi-Fi Unidade Exte', 429.01, 660.01, '35%', 1, 12, 'AC09BK.NSJ', 'https://storage.sanipower.pt/storage/produtos/37/37-1-13.jpg', '2024-06-06 09:26:35', '2024-06-06 09:26:35');

-- A despejar estrutura para tabela sanipower.comentarios
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_visita` int DEFAULT NULL,
  `stamp` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `comentario` longtext,
  `id_user` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela sanipower.comentarios: ~11 rows (aproximadamente)
DELETE FROM `comentarios`;
INSERT INTO `comentarios` (`id`, `id_visita`, `stamp`, `tipo`, `comentario`, `id_user`, `created_at`, `updated_at`) VALUES
	(25, NULL, 'AJ24052463446,940000002', 'encomendas', 'COmentario', 1, '2024-05-27 15:11:34', '2024-05-27 15:11:34'),
	(26, NULL, 'AJ24052463446,940000002', 'propostas', 'propostas', 1, '2024-05-27 15:11:46', '2024-05-27 15:11:46'),
	(27, NULL, 'AJ24052463446,940000002', 'propostas', '', 1, '2024-06-03 12:43:32', '2024-06-03 12:43:32'),
	(28, NULL, 'RCL24051762767,248000001', 'propostas', '', 1, '2024-06-03 12:43:37', '2024-06-03 12:43:37'),
	(29, NULL, 'AJ24052463446,940000002', 'propostas', 'rreetfteet', 1, '2024-06-03 12:43:49', '2024-06-03 12:43:49'),
	(30, NULL, 'AJ24060464631,514000002', 'encomendas', 'Uma curiosidade interessante sobre o Império Romano é que eles tinham uma espécie de "corrida de bigas" nas competições de circo. As corridas de bigas (chariot races) eram eventos extremamente populares na Roma Antiga, realizadas principalmente no Circus Maximus, que era um dos maiores estádios de Roma. Este tipo de corrida envolvia carros puxados por cavalos, geralmente dois ou quatro cavalos por carro, e os condutores (aurigas) competiam em alta velocidade ao longo de uma pista oval.', 1, '2024-06-05 14:18:15', '2024-06-05 14:18:15'),
	(31, NULL, 'AJ24060464631,514000002', 'encomendas', 'Lorem Ipsum\nis simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 3, '2024-06-05 14:18:22', '2024-06-05 14:18:22'),
	(32, NULL, 'AJ24050661766,429000001', 'propostas', 'Teste meu puto', 1, '2024-06-05 14:39:01', '2024-06-05 14:39:01'),
	(33, NULL, 'JOS24060564519,964000002', 'encomendas', 'beleza irmao colega, lega, video aula, visseee', 1, '2024-06-06 09:27:38', '2024-06-06 09:27:38'),
	(34, NULL, 'JOS24060564519,964000002', 'encomendas', 'Traditional heading elements are designed to work best in the meat of your page content. When you need a heading to stand out, consider using a display heading—a larger, slightly more opinionated heading style.', 3, '2024-06-06 09:44:17', '2024-06-06 09:44:17'),
	(35, NULL, 'JOS24060564519,964000002', 'encomendas', 'BELEZA GALERARAAAEAWEAE', 1, '2024-06-06 09:45:18', '2024-06-06 09:45:18');

-- A despejar estrutura para tabela sanipower.failed_jobs
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

-- A despejar dados para tabela sanipower.failed_jobs: ~0 rows (aproximadamente)
DELETE FROM `failed_jobs`;

-- A despejar estrutura para tabela sanipower.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela sanipower.migrations: ~9 rows (aproximadamente)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2014_10_12_100000_create_password_resets_table', 1),
	(4, '2019_08_19_000000_create_failed_jobs_table', 1),
	(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(6, '2024_03_14_092329_add_foto_to_users_table', 2),
	(7, '2024_05_28_081901_create_visitas_table', 3),
	(8, '2024_05_28_082117_create_comentarios_table', 3),
	(9, '2024_06_03_164430_create_carrinho_compras_table', 3);

-- A despejar estrutura para tabela sanipower.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela sanipower.password_resets: ~0 rows (aproximadamente)
DELETE FROM `password_resets`;

-- A despejar estrutura para tabela sanipower.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela sanipower.password_reset_tokens: ~0 rows (aproximadamente)
DELETE FROM `password_reset_tokens`;

-- A despejar estrutura para tabela sanipower.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela sanipower.personal_access_tokens: ~0 rows (aproximadamente)
DELETE FROM `personal_access_tokens`;

-- A despejar estrutura para tabela sanipower.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela sanipower.users: ~1 rows (aproximadamente)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `imagem`, `created_at`, `updated_at`) VALUES
	(1, 'João Mendes', 'admin@admin.com', NULL, '$2y$12$OIQ8K6JsYPVFRkK4lGanLuLPVV6lXIdg7IDN15C2h9ZuQNPcnPlOW', 'eOoXS7XfjqnfFkci9xihmS17z9lqpSk3y570M4xylbqQHe5uuyHP3P0Gmvaf', 'icons8-bowler-hat-48.png', '2024-03-13 10:07:39', '2024-06-06 10:27:46'),
	(3, 'Teste', 'teste@gmail.com', NULL, '$2y$12$OIQ8K6JsYPVFRkK4lGanLuLPVV6lXIdg7IDN15C2h9ZuQNPcnPlOW', 'i4MH2IyGrPAAsxFdLTGhzqv3HRVEsOnnVHM5jwoFik0tRTw6labpFwI1s8IV', NULL, '2024-06-06 10:20:54', '2024-06-06 10:20:55');

-- A despejar estrutura para tabela sanipower.visitas
CREATE TABLE IF NOT EXISTS `visitas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `numero_cliente` int DEFAULT NULL,
  `assunto` varchar(150) DEFAULT NULL,
  `relatorio` longtext,
  `pendentes_proxima_visita` longtext,
  `comentario_encomendas` longtext,
  `comentario_propostas` longtext,
  `comentario_financeiro` longtext,
  `comentario_ocorrencias` longtext,
  `data` varchar(50) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela sanipower.visitas: ~0 rows (aproximadamente)
DELETE FROM `visitas`;
INSERT INTO `visitas` (`id`, `numero_cliente`, `assunto`, `relatorio`, `pendentes_proxima_visita`, `comentario_encomendas`, `comentario_propostas`, `comentario_financeiro`, `comentario_ocorrencias`, `data`, `user_id`, `created_at`, `updated_at`) VALUES
	(13, 5650, '', '', '', '', '', '', NULL, '2024-06-03', 1, '2024-06-03 12:43:54', '2024-06-03 12:43:54'),
	(14, 5650, '', 'Relatorio', 'Sem pendentes', 'COmentario', '', '', NULL, '2024-06-05', 1, '2024-06-05 14:38:09', '2024-06-05 14:38:09');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
