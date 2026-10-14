-- =============================================================================
-- Clinical Software - cambios de base de datos para PRODUCCION
--
-- Migraciones incluidas:
--   2026_10_13_000001_create_notification_logs_table        (cumpleanos por correo)
--   2026_08_14_000001_create_rips_provider_configs_table    (RIPS sin factura)
--   2026_08_14_000002_create_rips_reports_table             (RIPS sin factura)
--
-- Solo CREA tablas nuevas. No modifica ni borra tablas existentes ni datos.
-- Se puede ejecutar mas de una vez sin error (IF NOT EXISTS / WHERE NOT EXISTS).
-- Ejecutar en phpMyAdmin con la base de datos de produccion seleccionada.
-- =============================================================================

-- 1) Notificaciones: registro de envios y deduplicacion (cumpleanos)
CREATE TABLE IF NOT EXISTS `notification_logs` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(40) NOT NULL,
  `channel` VARCHAR(20) NOT NULL,
  `patient_id` INT UNSIGNED NULL,
  `reference` VARCHAR(60) NULL,
  `recipient` VARCHAR(191) NULL,
  `status` VARCHAR(20) NOT NULL,
  `detail` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notification_logs_type_patient_id_reference_index` (`type`, `patient_id`, `reference`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2) RIPS sin factura: configuracion del prestador
CREATE TABLE IF NOT EXISTS `rips_provider_configs` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `owner_user_id` INT UNSIGNED NOT NULL,
  `num_documento_id_obligado` VARCHAR(12) NOT NULL,
  `cod_prestador` VARCHAR(12) NULL,
  `next_num_nota` BIGINT UNSIGNED NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rips_provider_configs_owner_user_id_unique` (`owner_user_id`),
  UNIQUE KEY `rips_provider_configs_num_documento_id_obligado_unique` (`num_documento_id_obligado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3) RIPS sin factura: reportes guardados
CREATE TABLE IF NOT EXISTS `rips_reports` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `owner_user_id` INT UNSIGNED NOT NULL,
  `num_documento_id_obligado` VARCHAR(12) NOT NULL,
  `num_nota` VARCHAR(30) NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rips_reports_num_documento_id_obligado_num_nota_unique` (`num_documento_id_obligado`, `num_nota`),
  KEY `rips_reports_owner_user_id_created_at_index` (`owner_user_id`, `created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4) Registro en la tabla migrations (para que "php artisan migrate" no intente crearlas de nuevo)
SET @batch := (SELECT COALESCE(MAX(`batch`), 0) + 1 FROM `migrations`);

INSERT INTO `migrations` (`migration`, `batch`)
SELECT m.`name`, @batch
FROM (
  SELECT '2026_08_14_000001_create_rips_provider_configs_table' AS `name`
  UNION ALL SELECT '2026_08_14_000002_create_rips_reports_table'
  UNION ALL SELECT '2026_10_13_000001_create_notification_logs_table'
) AS m
WHERE NOT EXISTS (
  SELECT 1 FROM `migrations` AS x WHERE x.`migration` = m.`name`
);

-- 5) Verificacion: deben aparecer las 3 tablas
SELECT TABLE_NAME
FROM information_schema.TABLES
WHERE TABLE_SCHEMA = DATABASE()
  AND TABLE_NAME IN ('notification_logs', 'rips_provider_configs', 'rips_reports');
