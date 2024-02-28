CREATE TABLE `states` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci


CREATE TABLE `cities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cities_state_id_foreign` (`state_id`),
  CONSTRAINT `cities_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci


CREATE TABLE `addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_id` bigint unsigned NOT NULL,
  `city_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `addresses_state_id_foreign` (`state_id`),
  KEY `addresses_city_id_foreign` (`city_id`),
  CONSTRAINT `addresses_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  CONSTRAINT `addresses_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci


CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address_id` bigint unsigned DEFAULT NULL,
  `city_id` bigint unsigned DEFAULT NULL,
  `state_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_address_id_foreign` (`address_id`),
  KEY `users_city_id_foreign` (`city_id`),
  KEY `users_state_id_foreign` (`state_id`),
  CONSTRAINT `users_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`),
  CONSTRAINT `users_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  CONSTRAINT `users_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci




INSERT INTO states (name,acr,created_at,updated_at) VALUES
	 ('São Paulo','SP',NULL,NULL),
	 ('Rio de Janeiro','RJ',NULL,NULL),
	 ('Acre','AC',NULL,NULL),
	 ('Alagoas','AL',NULL,NULL),
	 ('Amapá','AP',NULL,NULL),
	 ('Amazonas','AM',NULL,NULL),
	 ('Bahia','BA',NULL,NULL),
	 ('Ceará','CE',NULL,NULL),
	 ('Distrito Federal','DF',NULL,NULL),
	 ('Espírito Santo','ES',NULL,NULL);
INSERT INTO states (name,acr,created_at,updated_at) VALUES
	 ('Goiás','GO',NULL,NULL),
	 ('Maranhão','MA',NULL,NULL),
	 ('Mato Grosso','MT',NULL,NULL),
	 ('Mato Grosso do Sul','MS',NULL,NULL),
	 ('Minas Gerais','MG',NULL,NULL),
	 ('Pará','PA',NULL,NULL),
	 ('Paraíba','PB',NULL,NULL),
	 ('Paraná','PR',NULL,NULL),
	 ('Pernambuco','PE',NULL,NULL),
	 ('Piauí','PI',NULL,NULL);
INSERT INTO states (name,acr,created_at,updated_at) VALUES
	 ('Rio Grande do Norte','RN',NULL,NULL),
	 ('Rio Grande do Sul','RS',NULL,NULL),
	 ('Rondônia','RO',NULL,NULL),
	 ('Roraima','RR',NULL,NULL),
	 ('Santa Catarina','SC',NULL,NULL),
	 ('Sergipe','SE',NULL,NULL),
	 ('Tocantins','TO',NULL,NULL);

INSERT INTO cities (name,state_id,created_at,updated_at) VALUES
	 ('São Paulo',1,NULL,NULL),
	 ('Osasco',1,NULL,NULL),
	 ('Barueri',1,NULL,NULL),
	 ('Paraty',2,NULL,NULL),
	 ('Rio de Janeiro',2,NULL,NULL),
	 ('Niterói',2,NULL,NULL);

INSERT INTO addresses (street,postal_code,complement,state_id,city_id,created_at,updated_at) VALUES
	 ('Rua Rod Cormier','01254623','bloco b',1,1,'2024-02-28 00:44:21','2024-02-28 00:44:21'),
	 ('Rua Melany Christiansen','01254623','bloco b',1,1,'2024-02-28 00:44:21','2024-02-28 00:44:21'),
	 ('Rua Ezra Fisher','01254623','bloco b',1,1,'2024-02-28 00:44:21','2024-02-28 00:44:21');
	 
	 
	 