-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2022 at 04:27 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `memo_e1870907`
--
CREATE DATABASE IF NOT EXISTS `memo_e1870907` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `memo_e1870907`;

-- --------------------------------------------------------

--
-- Table structure for table `tache`
--

CREATE TABLE `tache` (
  `id` int(11) NOT NULL,
  `texte` varchar(200) NOT NULL COMMENT 'Texte de la tâche.',
  `accomplie` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Valeur 0 pour non-accomplie, et 1 pour accomplie.',
  `date_ajout` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'La date à laquelle la tâche est ajoutée',
  `utilisateur_id` int(11) DEFAULT NULL COMMENT 'Ce champ n''est pas utilisé dans le TP, ignorez-le!'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tache`
--

INSERT INTO `tache` (`id`, `texte`, `accomplie`, `date_ajout`, `utilisateur_id`) VALUES
(1, 'Faire mon travaux pratique de web', 0, '2022-12-02 00:00:00', 0),
(2, 'Faire ma presentation en design', 0, '2022-12-02 00:00:00', 0),
(3, 'Finir mon cegep', 0, '2022-12-02 00:00:00', 0),
(4, 'Aller a mes cours', 0, '2022-12-02 00:00:00', 0),
(5, 'Faire les course', 0, '2022-12-02 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tache`
--
ALTER TABLE `tache`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
