-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 12 mai 2019 à 18:56
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `classes`
--

INSERT INTO `classes` (`id`, `name`) VALUES
(1, 'L2 MIAGE'),
(2, 'L1 MIASHS'),
(3, 'L2 SC'),
(4, 'L3 MIAGE'),
(5, 'L3 SC'),
(6, 'M1 MIAGE'),
(7, 'M1 SC'),
(8, 'M2 MIAGE'),
(9, 'M2 SC');

-- --------------------------------------------------------

--
-- Structure de la table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `sexe` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `students`
--

INSERT INTO `students` (`id`, `lastname`, `firstname`, `photo`, `sexe`) VALUES
(1, 'Ait Hsaine', 'Myriam', 'aithsain1u.jpg', 'F'),
(2, 'Arnould', 'Maxime', 'arnould78u.jpg', 'M'),
(3, 'Beirao', 'Camille', 'beirao1u.jpg', 'F'),
(4, 'Beloual', 'Mehdi', 'beloual2u.jpg', 'M'),
(5, 'Bouche', 'Valentine', 'bouche19u.jpg', 'F'),
(6, 'Bouvin', 'Alexis', 'bouvin4u.jpg', 'M'),
(7, 'Broche', 'Cameron', 'broche2u.jpg', 'M'),
(8, 'Callonego', 'Colleen', 'calloneg1u.jpg', 'F'),
(9, 'Carbonnier', 'Nicolas', 'carbonni1u.jpg', 'M'),
(10, 'Chabbert', 'Benjamin', 'chabbert4u.jpg', 'M'),
(11, 'Cholley', 'Wendie', 'cholley17u.jpg', 'F'),
(12, 'Claudin', 'Lou', 'claudin6u.jpg', 'F'),
(13, 'Cossin', 'Alain', 'cossin8u.jpg', 'M'),
(14, 'Couroux', 'Gabriel', 'couroux1u.jpg', 'M'),
(15, 'Darrou', 'Cedric', 'darrou2u.jpg', 'M'),
(16, 'Drouot', 'Vincent', 'drouot27u.jpg', 'M'),
(17, 'Dumont', 'Lucille', 'dumont57u.jpg', 'F'),
(18, 'Dupont', 'Felix', 'dupont115u.jpg', 'M'),
(19, 'Gaborit', 'Florian', 'gaborit3u.jpg', 'M'),
(20, 'Garni', 'Tristan', 'garni3u.jpg', 'M'),
(21, 'Hadj Messaoud', 'Yousra', 'hadjmess1u.jpg', 'F'),
(22, 'Halgue', 'Scott', 'halgue1u.jpg', 'M'),
(23, 'Herbin', 'Aurelien', 'herbin11u.jpg', 'M'),
(24, 'Husson', 'Gael', 'husson71u.jpg', 'M'),
(25, 'Klein', 'Dylan', 'klein214u.jpg', 'M'),
(26, 'Koch', 'Anne-Sophie', 'koch68u.jpg', 'F'),
(27, 'Lacour', 'Emilien', 'lacour43u.jpg', 'M'),
(28, 'Laprevote', 'Anne', 'laprevot6u.jpg', 'F'),
(29, 'Lefebvre', 'Manon', 'lefebvr87u.jpg', 'F'),
(30, 'Louis', 'Cecile', 'louis147u.jpg', 'F'),
(31, 'Macalou', 'Mariam', 'macalou4u.jpg', 'F'),
(32, 'Mananjara', 'Linah Chilande', 'mananjar2u.jpg', 'F'),
(33, 'Meligner', 'Ludovic', 'meligner3u.jpg', 'M'),
(34, 'Melz', 'Kenny', 'melz1u.jpg', 'M'),
(35, 'Merchat', 'Valentin', 'merchat1u.jpg', 'M'),
(36, 'Minger', 'Nathan', 'minger3u.jpg', 'M'),
(37, 'Nabid', 'Rayane', 'nabid1u.jpg', 'M'),
(38, 'Pailler', 'Morgane', 'pailler5u.jpg', 'F'),
(39, 'Palin', 'Theo-Michel', 'palin4u.jpg', 'M'),
(40, 'Perrot', 'Elise', 'perrot28u.jpg', 'F'),
(41, 'Petitjean', 'Nicolas', 'petitj116u.jpg', 'M'),
(42, 'Picard', 'Jeremy', 'picard85u.jpg', 'M'),
(43, 'Pierrat', 'Charly', 'pierrat55u.jpg', 'M'),
(44, 'Pintore', 'Angeline', 'pintore6u.jpg', 'F'),
(45, 'Pitault', 'Jeremy', 'pitault3u.jpg', 'M'),
(46, 'Plaut', 'Gregoire', 'plaut2u.jpg', 'M'),
(47, 'Point', 'Laure', 'point1u.jpg', 'F'),
(48, 'Ramorino', 'Eva', 'ramorino2u.jpg', 'F'),
(49, 'Rchidi', 'Souha', 'rchidi1u.jpg', 'F'),
(50, 'Ribeyre', 'Virgil', 'ribeyre6u.jpg', 'M'),
(51, 'Ruhland', 'Chloe', 'ruhland5u.jpg', 'F'),
(52, 'Scheffmann', 'Tom', 'scheffma4u.jpg', 'M'),
(53, 'Sohbi', 'Elias', 'sohbi2u.jpg', 'M'),
(54, 'Soquet', 'Chloe', 'soquet1u.jpg', 'F'),
(55, 'Tardot', 'William', 'tardot1u.jpg', 'M'),
(56, 'Valoti', 'Matteo', 'valoti1u.jpg', 'M'),
(57, 'Watelet', 'Manon', 'watelet4u.jpg', 'F'),
(58, 'Wysocki', 'Tom', 'wysocki3u.jpg', 'M'),
(59, 'Zahm', 'Florian', 'zahm8u.jpg', 'M'),
(60, 'Zlatkov', 'Mickael', 'zlatkov1u.jpg', 'M');

-- --------------------------------------------------------

--
-- Structure de la table `studentsclasses`
--

CREATE TABLE `studentsclasses` (
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `studentsclasses`
--

INSERT INTO `studentsclasses` (`student_id`, `class_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 3),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 3),
(10, 1),
(11, 1),
(12, 3),
(13, 1),
(14, 1),
(15, 3),
(16, 1),
(17, 3),
(18, 1),
(19, 1),
(20, 3),
(21, 1),
(22, 1),
(23, 3),
(24, 3),
(25, 3),
(26, 1),
(27, 3),
(28, 3),
(29, 3),
(30, 1),
(31, 1),
(32, 3),
(33, 1),
(34, 1),
(35, 1),
(36, 3),
(37, 1),
(38, 3),
(39, 1),
(40, 3),
(41, 3),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 3),
(47, 3),
(48, 3),
(49, 1),
(50, 1),
(51, 3),
(52, 3),
(53, 1),
(54, 1),
(55, 3),
(56, 1),
(57, 3),
(58, 3),
(59, 1),
(60, 3);

-- --------------------------------------------------------

--
-- Structure de la table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `login` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `email` varchar(32) CHARACTER SET ascii NOT NULL,
  `password` char(96) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `photo` varchar(32) NOT NULL DEFAULT 'noProfil.png',
  `score` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `teachersclasses`
--

CREATE TABLE `teachersclasses` (
  `teacher_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `studentsclasses`
--
ALTER TABLE `studentsclasses`
  ADD PRIMARY KEY (`student_id`,`class_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Index pour la table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `teachersclasses`
--
ALTER TABLE `teachersclasses`
  ADD PRIMARY KEY (`teacher_id`,`class_id`),
  ADD KEY `class_id` (`class_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT pour la table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `studentsclasses`
--
ALTER TABLE `studentsclasses`
  ADD CONSTRAINT `studentsclasses_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `studentsclasses_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`);

--
-- Contraintes pour la table `teachersclasses`
--
ALTER TABLE `teachersclasses`
  ADD CONSTRAINT `teachersclasses_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`),
  ADD CONSTRAINT `teachersclasses_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
