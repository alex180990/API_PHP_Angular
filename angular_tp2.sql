-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 29, 2024 at 09:22 PM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `angular_tp2`
--

-- --------------------------------------------------------

--
-- Table structure for table `auteur`
--

CREATE TABLE `auteur` (
  `id_auteur` int NOT NULL,
  `nom_auteur` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `utilisateur_auteur` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `verifie_auteur` tinyint(1) NOT NULL DEFAULT '0',
  `courriel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `twitch` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `site_web` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description_auteur` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auteur`
--

INSERT INTO `auteur` (`id_auteur`, `nom_auteur`, `utilisateur_auteur`, `verifie_auteur`, `courriel`, `facebook`, `instagram`, `twitch`, `site_web`, `description_auteur`) VALUES
(73, 'alex', 'API-PHP', 0, 'courriel-3', 'facebook-3', 'instagram-3', 'twitch-3', 'site_web-3', 'description_auteur'),
(75, 'nom', 'nom', 0, 'courriel', 'facebook', 'instagram', 'twitch', 'site_web', 'description_auteur'),
(76, 'nom', 'nom', 0, 'courriel', 'facebook', 'instagram', 'twitch', 'site_web', 'description_auteur'),
(77, 'nom', 'nom', 0, 'courriel', 'facebook', 'instagram', 'twitch', 'site_web', 'description_auteur'),
(79, 'nom', 'nom', 0, 'courriel', 'facebook', 'instagram', 'twitch', 'site_web', 'description_auteur'),
(82, '', 'nom', 0, 'courriel', 'facebook', 'instagram', 'twitch', 'site_web', 'description_auteur'),
(83, '', 'nom', 0, 'courriel', 'facebook', 'instagram', 'twitch', 'site_web', 'description_auteur');

-- --------------------------------------------------------

--
-- Table structure for table `avis`
--

CREATE TABLE `avis` (
  `id_avis` int NOT NULL,
  `note_avis` int NOT NULL,
  `commentaire_avis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fk_video` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `avis`
--

INSERT INTO `avis` (`id_avis`, `note_avis`, `commentaire_avis`, `fk_video`) VALUES
(21, 0, 'commentaire_avis', 47);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `fk_auteur` int NOT NULL,
  `date_publication` datetime NOT NULL,
  `duree` int NOT NULL,
  `nombre_vues` int NOT NULL,
  `score` int NOT NULL DEFAULT '0',
  `sous_titres` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `nom`, `description`, `code`, `fk_auteur`, `date_publication`, `duree`, `nombre_vues`, `score`, `sous_titres`) VALUES
(45, 'ABC-045', 'description', '0', 73, '2024-01-28 20:52:07', 10, 0, 0, 'SS'),
(47, 'ABC-047', 'description', '0', 73, '2024-01-28 21:04:06', 10, 0, 10, 'SS'),
(48, 'alex-1', 'description', '0', 76, '2024-01-28 21:04:06', 10, 0, 0, 'SS'),
(49, 'alex-1', 'description', '0', 77, '2024-01-28 21:04:07', 10, 0, 0, 'SS'),
(51, 'alex-1', 'description', '0', 79, '2024-01-29 13:55:38', 10, 0, 0, 'SS'),
(54, 'alex-1', 'description', '0', 82, '2024-01-29 13:59:27', 10, 0, 0, 'SS'),
(55, 'alex-1', '', '0', 83, '2024-01-29 14:00:00', 10, 0, 0, 'SS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auteur`
--
ALTER TABLE `auteur`
  ADD PRIMARY KEY (`id_auteur`);

--
-- Indexes for table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id_avis`),
  ADD KEY `fk_video` (`fk_video`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auteur`
--
ALTER TABLE `auteur`
  MODIFY `id_auteur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `avis`
--
ALTER TABLE `avis`
  MODIFY `id_avis` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `fk_video` FOREIGN KEY (`fk_video`) REFERENCES `video` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
