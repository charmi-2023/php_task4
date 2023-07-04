-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 04, 2023 at 09:35 PM
-- Server version: 8.0.33
-- PHP Version: 8.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessType`
--

CREATE TABLE `accessType` (
  `id` int NOT NULL,
  `access_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `accessType`
--

INSERT INTO `accessType` (`id`, `access_type`) VALUES
(1, 'admin'),
(2, 'user'),
(4, 'teacher'),
(5, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `assigned_standards`
--

CREATE TABLE `assigned_standards` (
  `student_id` int DEFAULT NULL,
  `standard_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `assigned_standards`
--

INSERT INTO `assigned_standards` (`student_id`, `standard_id`) VALUES
(84, 3),
(84, 4),
(74, 3);

-- --------------------------------------------------------

--
-- Table structure for table `chapter`
--

CREATE TABLE `chapter` (
  `chap_id` int NOT NULL,
  `chap_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chapter`
--

INSERT INTO `chapter` (`chap_id`, `chap_name`) VALUES
(2, 'gdgdthtgyhjk'),
(3, 'tansen'),
(4, 'the wonder called sleep'),
(5, 'vlhsa'),
(6, 'vlhsa');

-- --------------------------------------------------------

--
-- Table structure for table `standard`
--

CREATE TABLE `standard` (
  `stand_id` int NOT NULL,
  `standards` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `standard`
--

INSERT INTO `standard` (`stand_id`, `standards`) VALUES
(2, 10),
(3, 7),
(4, 8),
(6, 9);

-- --------------------------------------------------------

--
-- Table structure for table `standard_subject`
--

CREATE TABLE `standard_subject` (
  `id` int NOT NULL,
  `stand_id` int DEFAULT NULL,
  `sub_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `standard_subject`
--

INSERT INTO `standard_subject` (`id`, `stand_id`, `sub_id`) VALUES
(1, 3, 3),
(2, 3, 3),
(3, 3, 4),
(4, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_id` int NOT NULL,
  `sub_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sub_id`, `sub_name`) VALUES
(2, 'dhjskads'),
(3, 'english'),
(4, 'hindi'),
(6, 'gujarati'),
(7, 'sanskrit'),
(9, 'maths'),
(10, 'social science'),
(11, 'hsad');

-- --------------------------------------------------------

--
-- Table structure for table `subject_chapter`
--

CREATE TABLE `subject_chapter` (
  `id` int NOT NULL,
  `sub_id` int DEFAULT NULL,
  `chap_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subject_chapter`
--

INSERT INTO `subject_chapter` (`id`, `sub_id`, `chap_id`) VALUES
(1, 2, 6),
(2, 3, 3),
(3, 3, 3),
(4, 3, 3),
(5, 3, 4),
(6, 3, 2),
(7, 3, 3),
(8, 2, 2),
(9, 6, 5),
(10, 7, 5),
(11, 4, 4),
(12, 6, 4),
(13, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `userType`
--

CREATE TABLE `userType` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `access_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `userType`
--

INSERT INTO `userType` (`id`, `user_id`, `access_type`) VALUES
(1, 73, 'teacher'),
(2, 74, 'student'),
(3, 75, 'user'),
(4, 76, 'teacher'),
(5, 77, 'teacher'),
(6, 78, 'user'),
(7, 79, 'admin'),
(8, 80, 'teacher'),
(9, 80, 'user'),
(10, 82, 'user'),
(11, 83, 'admin'),
(12, 84, 'student'),
(13, 85, 'admin'),
(14, 84, 'user'),
(15, 87, 'teacher');

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `image`) VALUES
(70, 'bbfdsf', 'fdf@fg', '$2y$10$.eHb7N1NJoX.qAJd7zCoyOuYl1/bg2l2jwCWHATkZagukCvFNPVu6', ''),
(71, 'rtg', 'rfef@rtg', '202cb962ac59075b964b07152d234b70', NULL),
(72, 'new', 'mitul@gmail.com', '523af537946b79c4f8369ed39ba78605', NULL),
(73, 'new', 'mitulaa@gmail.com', 'c20ad4d76fe97759aa27a0c99bff6710', NULL),
(74, 'abc', 'charmi@gmail.com', '7815696ecbf1c96e6894b779456d330e', NULL),
(75, 'abc', 'abc@ab', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(76, 'vlog', 'vlog@vlog', 'c20ad4d76fe97759aa27a0c99bff6710', NULL),
(77, 'nehal', 'nehal@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(78, 'rutu', 'rutu@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(79, 'tushar', 'tushar1@gma', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(80, 'parth', 'parth@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(81, 'parth', 'parth1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(82, 'mitul', 'mitull@gm', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(83, 'purvi', 'purvi@gmail', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(84, 'new', 'xtz@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(85, 'mann', 'mann@gmsijid', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(86, 'new', 'zvzv@zvzv', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(87, 'new', 'zvzv@zvzvz', '202cb962ac59075b964b07152d234b70', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessType`
--
ALTER TABLE `accessType`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chapter`
--
ALTER TABLE `chapter`
  ADD PRIMARY KEY (`chap_id`);

--
-- Indexes for table `standard`
--
ALTER TABLE `standard`
  ADD PRIMARY KEY (`stand_id`);

--
-- Indexes for table `standard_subject`
--
ALTER TABLE `standard_subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stand_id` (`stand_id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `subject_chapter`
--
ALTER TABLE `subject_chapter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_id` (`sub_id`),
  ADD KEY `chap_id` (`chap_id`);

--
-- Indexes for table `userType`
--
ALTER TABLE `userType`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessType`
--
ALTER TABLE `accessType`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `chapter`
--
ALTER TABLE `chapter`
  MODIFY `chap_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `standard`
--
ALTER TABLE `standard`
  MODIFY `stand_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `standard_subject`
--
ALTER TABLE `standard_subject`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `sub_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subject_chapter`
--
ALTER TABLE `subject_chapter`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `userType`
--
ALTER TABLE `userType`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `standard_subject`
--
ALTER TABLE `standard_subject`
  ADD CONSTRAINT `standard_subject_ibfk_1` FOREIGN KEY (`stand_id`) REFERENCES `standard` (`stand_id`),
  ADD CONSTRAINT `standard_subject_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `subject` (`sub_id`);

--
-- Constraints for table `subject_chapter`
--
ALTER TABLE `subject_chapter`
  ADD CONSTRAINT `subject_chapter_ibfk_1` FOREIGN KEY (`sub_id`) REFERENCES `subject` (`sub_id`),
  ADD CONSTRAINT `subject_chapter_ibfk_2` FOREIGN KEY (`chap_id`) REFERENCES `chapter` (`chap_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
