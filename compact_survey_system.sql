-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2024 at 11:59 AM
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
-- Database: `compact_survey_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `Id` int(12) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `AdminCode` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`Id`, `firstName`, `lastName`, `email`, `password`, `AdminCode`) VALUES
(1, 'textadmin1', 'textadmin1', 'textadmin1@admin.com', '1234', '1234'),
(2, 'admintest', 'admintest', 'admintest@admin.com', '12', '12'),
(3, 'admin1', 'admin1', 'admin1@admin.com', '12', '12');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) DEFAULT NULL,
  `question_text` varchar(255) NOT NULL,
  `question_type` enum('text','radio','multiple') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `survey_id`, `question_text`, `question_type`) VALUES
(1, 1, 'q1', 'radio'),
(2, 1, 'q2 ', 'multiple'),
(3, 1, 'nandowd', 'text'),
(4, 2, 'does it work?', 'text'),
(5, 2, 'are u satisfied with it ? ', 'multiple'),
(6, 3, 'text test', 'text'),
(7, 3, 'radio test', 'radio'),
(8, 3, 'mutiple choice test', 'multiple'),
(9, 4, ' 8/23 q1 text', 'text'),
(10, 4, '8/23 q2 radio', 'radio'),
(11, 4, '8/23 q3 qcm', 'multiple'),
(12, 5, 'q1', 'text'),
(13, 6, 'ad', 'text'),
(14, 7, '1234', 'text'),
(25, 14, 'fdasdf', 'text'),
(26, 14, 'we2', 'radio'),
(27, 14, '2adww', 'multiple'),
(28, 15, 'QSAS', 'text'),
(32, 17, 'how is the text area looking', 'text'),
(36, 19, '23', 'text'),
(37, 19, 'we', 'multiple'),
(38, 19, 'radio qest?', 'radio');

-- --------------------------------------------------------

--
-- Table structure for table `question_options`
--

CREATE TABLE `question_options` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `option_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question_options`
--

INSERT INTO `question_options` (`id`, `question_id`, `option_text`) VALUES
(1, 1, '1 - 5 days'),
(2, 1, '1 -3 dats'),
(3, 2, 'dkwdpwkp'),
(4, 2, 'wokdowkd'),
(5, 5, 'yes'),
(6, 5, 'no '),
(7, 5, 'uncertain'),
(8, 7, 'q1 '),
(9, 7, 'q2'),
(10, 7, 'q3'),
(11, 8, 'q1 t'),
(12, 8, 'q2 t'),
(13, 8, 'q3 t'),
(14, 10, 'option 1 radio '),
(15, 10, 'option 2 radio'),
(16, 10, 'option 3 radio'),
(17, 11, 'option 1 qcm'),
(18, 11, 'option 2 qcm'),
(19, 11, 'option 3 qcm'),
(29, 26, 'dds'),
(30, 26, 'ffaf'),
(31, 26, 'xxx'),
(32, 27, '3asd'),
(33, 27, 'gsds'),
(34, 27, 'vvvv'),
(47, 37, '2344'),
(48, 37, '2233'),
(49, 37, '555'),
(50, 38, 'wwrad'),
(51, 38, '2dsdfrad');

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `response` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `responses`
--

INSERT INTO `responses` (`id`, `survey_id`, `user_id`, `question_id`, `response`) VALUES
(26, 4, 4, 11, 'option 3 qcm'),
(36, 14, 4, 25, 'wdsdfs'),
(37, 14, 4, 26, 'dds'),
(38, 14, 4, 27, '3asd'),
(39, 14, 4, 27, 'gsds'),
(40, 14, 5, 25, 'dsfs'),
(41, 14, 5, 26, 'dds'),
(42, 14, 5, 27, '3asd'),
(43, 14, 5, 27, 'vvvv'),
(44, 15, 5, 28, 'SAqs'),
(45, 17, 4, 32, 'lllml'),
(54, 19, 4, 36, 'w2'),
(55, 19, 4, 37, '2344'),
(56, 19, 4, 37, '555'),
(57, 19, 4, 38, 'wwrad'),
(58, 15, 4, 28, '6kimujnyhbtgvfcxd'),
(59, 17, 6, 32, 'its looking nice :3');

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `id` int(11) NOT NULL,
  `survey_title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_Id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`id`, `survey_title`, `description`, `created_at`, `admin_Id`) VALUES
(1, 'popop', 'wdpwlpdlwd', '2024-08-15 11:31:04', NULL),
(2, 'new test', 'test to see if the code woks ', '2024-08-19 09:02:30', NULL),
(3, 'survey test', 'it s test to see how it works ', '2024-08-19 12:10:46', NULL),
(4, '8/23/2024 test', 'this is a test for long descriptions Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem est in minus asperiores praesentium iusto nam fugiat, dolorem non ab doloribus excepturi quasi numquam cupiditate optio accusamus quibusdam autem commodi?', '2024-08-23 10:12:08', NULL),
(5, 'test for admin id ', 'testing to see if the admin id is gonna show', '2024-08-27 13:17:01', NULL),
(6, 'test1', 'sdwdsdwd f', '2024-08-28 09:58:11', NULL),
(7, '12341', '1234', '2024-08-28 09:59:22', NULL),
(14, 'dsawds', 'asdwa', '2024-08-28 12:54:57', 3),
(15, 'sq,qsq', 'sSQSQQ', '2024-08-28 13:19:37', 3),
(17, 'css testt', 'testing to see how the css looks like for taking the survey', '2024-08-29 09:44:46', 3),
(19, 'fina final one', 'the final test', '2024-08-29 12:43:16', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(12) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `firstName`, `lastName`, `email`, `password`) VALUES
(1, 'text1', 'text1', 'text1@user.com', '1234'),
(2, 'person1', 'person1', 'person1@user.com', '123'),
(3, 'person2', 'person2', 'person2@user.com', '123'),
(4, 'person3', 'person3', 'person3@user.com', '12'),
(5, 'ado', 'adp', 'ado@user.com', '12'),
(6, 'oz', 'ozziz', 'oz@user.com', '12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `survey_id` (`survey_id`);

--
-- Indexes for table `question_options`
--
ALTER TABLE `question_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `survey_id` (`survey_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_Id` (`admin_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `question_options`
--
ALTER TABLE `question_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question_options`
--
ALTER TABLE `question_options`
  ADD CONSTRAINT `question_options_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `responses_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `responses_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `responses_ibfk_3` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `surveys`
--
ALTER TABLE `surveys`
  ADD CONSTRAINT `surveys_ibfk_1` FOREIGN KEY (`admin_Id`) REFERENCES `admins` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
