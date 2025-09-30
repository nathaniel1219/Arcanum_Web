-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2025 at 07:46 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lar_arcanum`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-09-29 07:11:23', '2025-09-29 07:11:23'),
(2, 2, '2025-09-29 12:07:41', '2025-09-29 12:07:41'),
(3, 3, '2025-09-30 00:57:24', '2025-09-30 00:57:24');

-- --------------------------------------------------------

--
-- Table structure for table `cartitem`
--

CREATE TABLE `cartitem` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cartitem`
--

INSERT INTO `cartitem` (`id`, `cart_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(6, 1, 2, 1, '2025-09-30 10:15:34', '2025-09-30 10:15:34'),
(7, 1, 20, 1, '2025-09-30 12:10:55', '2025-09-30 12:10:55');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_09_005032_create_products_table', 1),
(5, '2025_09_09_005451_create_cart_table', 1),
(6, '2025_09_09_005856_create_cartitem_table', 1),
(7, '2025_09_09_005946_create_orders_table', 1),
(8, '2025_09_09_010027_create_orderitem_table', 1),
(9, '2025_09_09_012836_create_personal_access_tokens_table', 1),
(10, '2025_09_09_013814_add_two_factor_columns_to_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE `orderitem` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 3500.00, '2025-09-30 00:34:37', '2025-09-30 00:34:37'),
(2, 1, 5, 1, 62500.00, '2025-09-30 00:34:37', '2025-09-30 00:34:37'),
(3, 1, 8, 1, 1800.00, '2025-09-30 00:34:37', '2025-09-30 00:34:37');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `order_status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `order_date`, `order_status`, `created_at`, `updated_at`) VALUES
(1, 2, 67800.00, '2025-09-30 11:34:37', 'Pending', '2025-09-30 00:34:37', '2025-09-30 11:31:13'),
(2, 1, 4534.47, '2025-09-30 12:43:17', 'Shipped', '2025-09-30 01:43:17', '2025-09-30 10:07:39');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `sub_category` varchar(50) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `description`, `price`, `category`, `sub_category`, `image_url`, `details`, `created_at`, `updated_at`) VALUES
(1, 'SV Prismatic Evolutions', 'Booster Pack', 3600.00, 'TCG', 'pokemon', '1_prismatic_evo.jpg', 'This booster pack includes 10 randomly assorted cards from the Prismatic Evolutions expansion. Ideal for collectors and competitive players.', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(2, 'Scarlet and Violet Twilight Masquerade', 'Booster Pack', 3500.00, 'TCG', 'pokemon', '2_sv_bp.jpg', 'Twilight Masquerade introduces mysterious new Pokémon and powerful Trainer cards. Includes one sealed booster pack with 10 cards.', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(3, 'Scarlet and Violet Surging Sparks', 'Booster Pack', 3700.00, 'TCG', 'pokemon', '3_sv_surging_sparks_bp.png', 'Surging Sparks features dynamic electric-type Pokémon and updated gameplay mechanics. Each pack contains 10 cards.', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(4, 'Shrouded Fable', 'Booster Bundle', 10400.00, 'TCG', 'pokemon', '4_sf_bb.png', 'Shrouded Fable Booster Bundle comes with 6 booster packs and exclusive promotional inserts.', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(5, 'Scarlet and Violet Temporal Forces', 'Premium Collection', 62500.00, 'TCG', 'pokemon', '5_sv_temporal_forced_bb.jpeg', 'Temporal Forces Premium Collection includes 8 booster packs, a promo card, and a collector’s pin. A must-have for enthusiasts.', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(6, 'SV Obsidian Flames 125/197 Charizard ex', 'Half Art', 2500.00, 'TCG', 'pokemon', '6_charizard_art.jpeg', 'A rare Charizard ex card (125/197) from Obsidian Flames. Beautiful half-art collectible for serious Pokémon fans.', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(7, 'Pokemon Go', 'Booster Pack', 1800.00, 'TCG', 'pokemon', '7_pokemon_go_bp.jpeg', 'This Pokémon Go-themed booster pack captures the fun of the mobile game in trading card format. Contains 10 cards.', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(8, 'Scarlet and Violet Stellar Crown', 'Booster Pack', 1800.00, 'TCG', 'pokemon', '8_sv_stellar_crown_bp.png', 'Stellar Crown brings a cosmic twist to Scarlet & Violet. Each pack includes 10 cards focused on space-themed Pokémon.', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(9, 'Shrouded Fable Greninja ex Special ', 'Premium Collection', 20900.00, 'TCG', 'pokemon', '9_sf_greninja_box.jpeg', 'Greninja ex Special Premium Collection includes exclusive promo cards and premium packaging. Perfect for competitive players.', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(10, 'Yu-Gi-Oh! Egyptian Gods Structure Deck: Slifer the Sky Dragon (Unlimited)', 'Structure Deck', 4800.00, 'TCG', 'Yu-Gi-Oh', '10_silfer_ygo.jpeg', 'Structure Deck featuring Slifer the Sky Dragon, designed to enhance Divine-Beast strategies.', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(11, 'Yu-Gi-Oh! Egyptian Gods Structure Deck: Obelisk the Tormentor', 'Structure Deck', 4800.00, 'TCG', 'Yu-Gi-Oh', '11_obelisk_ygo.png', 'Structure Deck featuring Obelisk the Tormentor, focusing on powerful Tribute Summon tactics.', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(12, 'Quarter Century Stampede Booster Box', 'Booster Box', 36000.00, 'TCG', 'Yu-Gi-Oh', '12_stampede_bb_ygo.jpeg', '24 packs per box, each with 5 cards. Final chance to obtain Quarter Century Secret Rares celebrating the 25th anniversary.', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(13, 'Quarter Century Stampede Booster Pack', 'Booster Pack', 1600.00, 'TCG', 'Yu-Gi-Oh', '13_stampede_bp_ygo.jpeg', 'Each pack contains 5 cards with a guaranteed luxury secret rare, featuring nostalgic reprints and fan-voted cards.', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(14, 'Structure Deck: Blue-Eyes White Destiny', 'Structure Deck', 4800.00, 'TCG', 'Yu-Gi-Oh', '14_blueeyes_ygo.jpeg', '50-card deck centered around Blue-Eyes Ultimate Spirit Dragon, including new Synchro and Link Monsters.', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(15, 'Alliance Insight Booster Box', 'Booster Box', 36000.00, 'TCG', 'Yu-Gi-Oh', '15_alliance_bb_ygo.jpeg', '24 packs per box, each with 9 cards. Final set featuring Quarter Century Secret Rares, focusing on the VRAINS era.', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(16, 'Alliance Insight Booster Pack', 'Booster Pack', 1600.00, 'TCG', 'Yu-Gi-Oh', '16_alliance_bp_ygo.jpeg', 'Each pack contains 9 cards from the Alliance Insight set, highlighting the final appearance of Quarter Century Secret Rares.', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(17, 'Legendary Decks II (2024 Unlimited Reprint)', 'Deck Set', 12000.00, 'TCG', 'Yu-Gi-Oh', '17_lege_decks_ygo.jpeg', 'Includes three 43-card decks based on Yugi, Kaiba, and Joey, featuring iconic cards like Exodia and Blue-Eyes White Dragon.', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(18, 'ALIN-EN004 Dark Magician Girl the Magician\'s Apprentice (Secret Rare)', 'Single Card', 6000.00, 'TCG', 'Yu-Gi-Oh', '18_mag_girl_ygo.jpeg', 'Secret Rare effect monster card from the Alliance Insight set, featuring Dark Magician Girl as the Magician\'s Apprentice.', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(19, 'Lebron James Funko Pop', 'Vinyl Figure', 4800.00, 'Figures', 'Funko Pop', '19_LeBRON.png', 'Celebrate the NBA superstar with this Funko Pop! figure of LeBron James in his Los Angeles Lakers uniform, capturing his iconic presence on the court.', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(20, 'Ice Spice Funko Pop', 'Vinyl Figure', 4800.00, 'Figures', 'Funko Pop', '20_icespice.png', 'Top the charts with Pop! Ice Spice! Rocking the ensemble from her Y2K! album, this exclusive artist adds a dash of nostalgia to your music collection.', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(21, 'Nezuko Kamado (Demon Form) Funko Pop', 'Vinyl Figure', 4800.00, 'Figures', 'Funko Pop', '21_nezuko.png', 'Expand your Demon Slayer collection with Pop! Nezuko Kamado in her Demon Form. This vinyl figure stands approximately 3.95 inches tall.', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(22, 'John Wick with Dual Blades Funko Pop', 'Vinyl Figure', 4800.00, 'Figures', 'Funko Pop', '22_johnwick.png', 'This Funko Pop! figure features John Wick wielding dual blades, capturing the intense action and style of the legendary assassin.', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(23, 'Kuromi Funko Pop', 'Vinyl Figure', 4800.00, 'Figures', 'Funko Pop', '23_kuromi.png', 'Add a touch of mischief to your collection with Pop! Kuromi, the charmingly cheeky character from the Hello Kitty universe.', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(24, 'Satoru Gojo Funko Pop', 'Vinyl Figure', 4800.00, 'Figures', 'Funko Pop', '24_gojo.png', 'Join the world of Jujutsu Kaisen with Pop! Satoru Gojo, the powerful sorcerer known for his exceptional skills and enigmatic personality.', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(25, 'Suguru Geto Funko Pop', 'Vinyl Figure', 4800.00, 'Figures', 'Funko Pop', '25_geto.png', 'Enroll in Tokyo Jujutsu High and learn to battle foes like this exclusive POP! Premium Suguru Geto with Cursed Spirit Dragon!', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(26, 'Heimerdinger Funko Pop', 'Vinyl Figure', 4800.00, 'Figures', 'Funko Pop', '26_heimerdinger.png', 'Bring home the brilliant inventor from League of Legends with Pop! Heimerdinger, featuring his signature gadgets and distinctive look.', '2025-09-29 12:45:49', '2025-09-29 12:45:49'),
(27, 'Pennywise with Spider Legs Funko Pop', 'Vinyl Figure', 4800.00, 'Figures', 'Funko Pop', '27_pennywise.png', 'Have a laugh with Pop! Pennywise with Spider Legs! This clown is ready to terrify your IT collection as he bares his frightening fangs.', '2025-09-29 12:45:49', '2025-09-29 12:45:49');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('CfX9SAy4cfQpGgGfEAVn7WqL2dWNKreh7Y5t5SZO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoib2RDZERPSVhkN1FKV0Z6ZUpBTkhKT0dDUmw2MUk4ZzJrT256OUZjZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1759254079);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `is_admin`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'nate', 'nathaniel@gmail.com', NULL, '$2y$12$fcjoNLikpCF.4tmRJc9SxugdRxpXVbIHTVUXUGik6jIWFbkb0CpyC', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2025-09-29 07:11:23', '2025-09-29 07:11:23'),
(2, 'bumi', 'bumi@mail.com', NULL, '$2y$12$dvI3CRPGjSBJ2w3asvbzA.RjgVPzVuKkArr6DIGyOO4DyP.fAEAR.', NULL, NULL, NULL, 0, NULL, NULL, NULL, '2025-09-29 12:07:41', '2025-09-29 12:07:41'),
(3, 'Dulya', 'duli@mail.com', NULL, '$2y$12$AG2MHFIdH2eXmHJcPV7oJ.LWp4ZgDpV9Rkl5KaAj4KLhfPl4CWG9m', NULL, NULL, NULL, 0, NULL, NULL, NULL, '2025-09-30 00:57:24', '2025-09-30 00:57:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_user_id_foreign` (`user_id`);

--
-- Indexes for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cartitem_cart_id_product_id_unique` (`cart_id`,`product_id`),
  ADD KEY `cartitem_product_id_foreign` (`product_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderitem_order_id_foreign` (`order_id`),
  ADD KEY `orderitem_product_id_foreign` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cartitem`
--
ALTER TABLE `cartitem`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD CONSTRAINT `cartitem_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cartitem_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `orderitem_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderitem_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
