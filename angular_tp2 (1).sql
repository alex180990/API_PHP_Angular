-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 25, 2024 at 10:10 PM
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
(75, 'nom', 'nom', 0, 'courriel', 'facebook', 'instagram', 'twitch', 'site_web', 'description_auteur'),
(76, 'nom', 'nom', 0, 'courriel', 'facebook', 'instagram', 'twitch', 'site_web', 'description_auteur'),
(77, 'nom', 'nom', 0, 'courriel', 'facebook', 'instagram', 'twitch', 'site_web', 'description_auteur'),
(79, 'nom', 'nom', 0, 'courriel', 'facebook', 'instagram', 'twitch', 'site_web', 'description_auteur'),
(84, 'alex', 'API-PHP', 0, 'courriel-3', 'facebook-3', 'instagram-3', 'twitch-3', 'site_web-3', 'description_auteur'),
(85, 'alex', 'API-PHP', 0, 'courriel-3', 'facebook-3', 'instagram-3', 'twitch-3', 'site_web-3', 'description_auteur'),
(86, 'alex', 'API-PHP', 0, 'courriel-3', 'facebook-3', 'instagram-3', 'twitch-3', 'site_web-3', 'description_auteur'),
(87, 'alex', 'alex', 0, 'alexandre_cp@live.ca', '', '', '', '', 'test'),
(88, 'sad', 'sd', 0, 'sda', 'sd', 'sd', 'sd', 'dsdas', 'sd'),
(89, 'Alex', 'Alex-4', 0, '', '', '', '', '', 'alex'),
(90, 'asdf', 'sadf', 0, '', '', '', '', '', 'asdf'),
(91, 'asdfasd', 'dfasdf', 0, '', '', '', '', '', 'dsaf'),
(92, '', '', 0, '', '', '', '', '', ''),
(93, '', '', 0, '', '', '', '', '', ''),
(94, '', '', 0, '', '', '', '', '', ''),
(95, 'sdf', '', 0, '', '', '', '', '', ''),
(96, 'dsfadf', 'dsfadf', 0, '', '', '', '', '', 'dsafdasf'),
(97, 'fdsafasdf', 'fdsafsdf', 0, '', '', '', '', '', 'fdsafs'),
(98, 'alex', 'API-PHP', 0, 'courriel-3', 'facebook-3', 'instagram-3', 'twitch-3', 'site_web-3', 'description_auteur');

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
(21, 0, 'commentaire_avis', 49),
(22, 0, 'commentaire_avis-2', 49),
(23, 0, 'commentaire_avis', 48),
(24, 0, 'commentaire_avis', 48),
(25, 0, 'commentaire_avis', 48),
(26, 0, 'commentaire_avis', 48),
(27, 0, 'commentaire_avis', 48),
(28, 0, 'asdSA', 56),
(29, 0, 'asdf', 48),
(30, 0, 'test', 59),
(31, 0, 'test-2', 59),
(32, 0, 'dhjdh', 59);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `categorie` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
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

INSERT INTO `video` (`id`, `nom`, `description`, `categorie`, `code`, `fk_auteur`, `date_publication`, `duree`, `nombre_vues`, `score`, `sous_titres`) VALUES
(48, 'alex-2', 'description', 'AA', '00', 76, '2024-01-28 21:04:06', 5000, 925, 1250, 'SS'),
(49, 'alex-1', 'description', 'AA', '00', 77, '2024-01-28 21:04:07', 65000, 15645, 2500, 'SS'),
(51, 'alex-1', 'description', 'AA', '0', 79, '2024-01-29 13:55:38', 75000, 543453454, 2453, 'SS'),
(56, 'ABC-045', 'description', 'AA', '00', 84, '2024-02-19 18:09:57', 3000, 1268, 36541, 'SS'),
(57, 'ABC-055', 'description', 'AA', '010', 85, '2024-02-19 18:27:27', 10, 0, 0, 'SS'),
(58, 'ABC-050', 'description', 'BB', '0', 86, '2024-02-19 18:49:46', 60, 14681456, 5500, 'SS'),
(59, 'Test', 'tdsd', 'BB', '10', 87, '2024-02-19 20:29:52', 10, 0, 0, 'ss'),
(60, 'Alexandre Cloutier-Pilon', 'dsa', 'BB', '45', 88, '2024-02-19 21:11:35', 10, 0, 0, 'sad'),
(61, 'ABC-040', 'Test', 'BB', '15', 89, '2024-02-19 21:18:34', 23432, 23432, 3524, 'SS'),
(62, 'ABC-010', 'test', 'BB', '00', 90, '2024-02-19 21:25:14', 10, 0, 0, 'ss'),
(63, 'dsafads', 'dsafa', 'BB', '041', 91, '2024-02-19 21:56:29', 10, 0, 0, 'dfasdf'),
(64, 'sdfasdf', 'asdfa', 'CC', '0', 92, '2024-02-19 21:57:31', 10, 0, 0, ''),
(65, 'asdf', 'asdfa', 'CC', '0', 93, '2024-02-19 21:58:54', 10, 0, 0, 'dasf'),
(66, 'asdfa', 'dsaf', 'CC', '100', 94, '2024-02-19 21:59:56', 3242, 3214, 3421, 'asdfads'),
(67, 'dasfadsf', 'asdfsdaf', 'CC', '0', 95, '2024-02-19 22:00:54', 10, 0, 0, 'asdfsa'),
(68, 'dsafd', 'dsafdsf', 'CC', '0', 96, '2024-02-19 22:07:52', 10, 0, 0, 'fdsaf'),
(69, 'fasdfads', 'fdfasfsad', 'CC', '0', 97, '2024-02-19 22:12:57', 224545, 54532, 453543, 'asdfdsf');

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
  MODIFY `id_auteur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `avis`
--
ALTER TABLE `avis`
  MODIFY `id_avis` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

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
