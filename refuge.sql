-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 05, 2025 at 08:22 AM
-- Server version: 8.4.6
-- PHP Version: 8.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `refuge`
--

-- --------------------------------------------------------

--
-- Table structure for table `adoptions`
--

CREATE TABLE `adoptions` (
  `id` int NOT NULL,
  `idAnimal` int NOT NULL,
  `idAdoptant` int NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `adoptions`
--

INSERT INTO `adoptions` (`id`, `idAnimal`, `idAdoptant`, `date`) VALUES
(7, 6, 7, '2024-09-20'),
(8, 9, 8, '2024-10-05'),
(9, 7, 9, '2024-10-18'),
(10, 10, 3, '2024-11-01');

-- --------------------------------------------------------

--
-- Table structure for table `animaux`
--

CREATE TABLE `animaux` (
  `id` int NOT NULL,
  `type` varchar(50) NOT NULL,
  `race` varchar(15) DEFAULT NULL,
  `nom` varchar(50) NOT NULL,
  `age` varchar(4) NOT NULL,
  `description` varchar(150) NOT NULL,
  `statut` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `animaux`
--

INSERT INTO `animaux` (`id`, `type`, `race`, `nom`, `age`, `description`, `statut`) VALUES
(1, 'Chien', NULL, 'Rex', '3', 'Berger allemand joueur et affectueux', 1),
(2, 'Chat', NULL, 'Misty', '2', 'Chatte douce et curieuse', 1),
(3, 'Lapin', NULL, 'Coco', '1', 'Petit lapin blanc très calme', 1),
(4, 'Chien', NULL, 'Lucky', '5', 'Golden retriever sociable', 1),
(5, 'Chat', NULL, 'Shadow', '4', 'Chat noir très câlin', 1),
(6, 'Chien', NULL, 'Bella', '2', 'Chienne vive et obéissante', 1),
(7, 'Tortue', NULL, 'Speedy', '7', 'Tortue d’eau tranquille', 1),
(8, 'Chat', NULL, 'Luna', '3', 'Chatte grise très joueuse', 1),
(9, 'Oiseau', NULL, 'Kiwi', '1', 'Perruche colorée bavarde', 1),
(10, 'Chien', NULL, 'Max', '6', 'Husky affectueux et énergique', 1),
(11, 'chien', NULL, 'Rex', '5', 'Chien joueur et affectueux', 0),
(12, 'chat', NULL, 'Mimi', '3', 'Chat calme et câlin', 0),
(13, 'chien', NULL, 'Rocky', '2', 'Chien énergique', 0),
(14, 'chat', NULL, 'Luna', '4', 'Chat curieux', 0),
(15, 'chien', NULL, 'bobert', '55', 'cmiezbcpaziebcipzuabera', 0),
(16, 'chien', NULL, 'pijb', '55', 'Test', 0),
(17, 'Chien', NULL, 'Lombard', '111', 'zqdqzd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `statut` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `password`, `adresse`, `statut`) VALUES
(1, 'Martin', 'Sophie', 'sophie.martin@example.com', 'pass1234', '12 rue des Fleurs, Lyon', 0),
(2, 'Dupont', 'Lucas', 'lucas.dupont@example.com', 'azerty', '5 avenue du Parc, Paris', 0),
(3, 'Durand', 'Emma', 'emma.durand@example.com', 'motdepasse', '8 rue Victor Hugo, Lille', 0),
(4, 'Petit', 'Thomas', 'thomas.petit@example.com', '123456', '3 rue des Lilas, Marseille', 0),
(5, 'Moreau', 'Clara', 'clara.moreau@example.com', 'pwd789', '27 boulevard Voltaire, Nantes', 0),
(6, 'Lefebvre', 'Hugo', 'hugo.lefebvre@example.com', 'adminpass', '10 rue Pasteur, Toulouse', 1),
(7, 'Garcia', 'Julie', 'julie.garcia@example.com', 'chien2024', '18 rue du Soleil, Nice', 0),
(8, 'Roux', 'Nathan', 'nathan.roux@example.com', 'chaton', '7 rue Lafayette, Bordeaux', 0),
(9, 'Fontaine', 'Laura', 'laura.fontaine@example.com', 'securepwd', '22 rue Montaigne, Dijon', 0),
(10, 'Lambert', 'Paul', 'paul.lambert@example.com', 'refuge123', '15 rue Carnot, Reims', 1),
(11, 'Lombard', 'Romain', 'rlombard2005@gmail.com', '$2y$12$KkcaYV6VfVABFZoc06ns4OQHbWx/bwQttBozE/hrJAyI0eBfqTXiy', 'Rue Deguin, 13', 1),
(13, 'Lombard', 'Romain', '2rlombard2005@gmail.com', '$2y$12$KkcaYV6VfVABFZoc06ns4OQHbWx/bwQttBozE/hrJAyI0eBfqTXiy', 'Rue Deguin, 13', 0),
(14, 'Doe', 'John', 'test@testmail.com', '$2y$12$jVWCRd3byyOBxMq7PcHZTu/pYFJYb03fhx2vwgABPK0SLM/D6aKGS', 'bfiebrbpcezrvhzçh', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adoptions`
--
ALTER TABLE `adoptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `animaux`
--
ALTER TABLE `animaux`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adoptions`
--
ALTER TABLE `adoptions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `animaux`
--
ALTER TABLE `animaux`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
