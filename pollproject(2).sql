-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2023 at 05:25 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pollproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `option_id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `option_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `poll_id`, `option_text`) VALUES
(106, 47, 'Winter'),
(107, 47, 'Summer'),
(108, 47, 'Spring'),
(109, 47, 'Fall'),
(145, 58, 'apple'),
(146, 58, 'pineapple'),
(147, 58, 'grape'),
(148, 58, 'orange'),
(164, 65, 'Lamborghini'),
(165, 65, 'Buggati'),
(166, 65, 'Hennessey'),
(167, 65, 'Pagani'),
(168, 66, 'IOS'),
(169, 66, 'Android'),
(170, 66, 'Microsoft Windows'),
(171, 67, 'Fendi'),
(172, 67, 'Gucci'),
(173, 67, 'Dior'),
(174, 67, 'Chanel'),
(175, 67, 'Versace'),
(176, 68, 'WhatsApp'),
(177, 68, 'Instagram'),
(178, 68, 'Youtube'),
(179, 68, 'Threads'),
(180, 68, 'Tiktok'),
(186, 71, 'Easy'),
(187, 71, 'Medium'),
(188, 71, 'Hard');

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `poll_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `expires_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `creator_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`poll_id`, `question`, `title`, `created_at`, `expires_at`, `is_active`, `creator_id`) VALUES
(47, 'What\'s your favorite weather?', 'Weather', '2023-08-11 22:01:43', NULL, 1, 22),
(58, 'what\'s your favorite fruit?', 'Fruits', '2023-08-13 00:03:24', NULL, 1, 26),
(65, 'Which one is the most expensive car?', 'Car', '2023-08-14 03:45:27', NULL, 1, 25),
(66, 'Which System do you use?', 'OS Systems', '2023-08-14 03:49:27', NULL, 1, 25),
(67, 'What brand you like?', 'Brands', '2023-08-14 03:54:34', NULL, 1, 25),
(68, 'Which app you use the most?', 'Social App', '2023-08-14 03:58:35', NULL, 1, 25),
(71, 'How hard was the test?', 'Midterm', '2023-08-14 06:01:05', '2023-08-15 06:00:00', 1, 30);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`) VALUES
(22, 'Sara Mohammed', 'sara@gmail.com', '$2y$10$enXOH5N4sqORaTbPgnQJD.WA3wgmLUV4kVg4A.S8uHauLpd.dorX.'),
(24, 'Faisal Nasser', 'hakos@gmail.com', '$2y$10$SWhM9Rdy4qFKh4ohNYv1neTltSPcqQx8/zJmFzHh6M6A/bU9EIppK'),
(25, 'Ahmed Ali ', 'ahmed@gmail.com', '$2y$10$L0AJb2J0D410xmEeGk.mc.VWvwoAX.0XNSeVYz/LiaE9HTug2x1h6'),
(26, 'Noora Jassim', 'sara2@gmail.com', '$2y$10$SjBy.pbXFrnexntEBin3meZVeUxCh6GWMwJO88TaogmU6L1ZruwsW'),
(27, 'Ali Abbas', 'Ali@gmail.com', '$2y$10$5E8g438r17dtuSorOxdSteKwTaKblaIuQdJnHLCSRjDDQpvMPy9ve'),
(28, 'Faisal Fahad', 'fahed@gmail.com', '$2y$10$NJmWriegruBbh.T5TyupzORBdD2TsmV9hK/uwCE/fIoJc19N7kcJm'),
(29, 'Hussain Nooh', 'hussaino@gmail.com', '$2y$10$YmVJ6pExjYwEBoErXwOxtuWXXMkLbmVC8uDsFx0jgGj.tA6xT4/2u'),
(30, 'Test Bot', 'testbot@gmail.com', '$2y$10$5Pu/n4S6DnBUwVF/h20VxuuIXqI8fsGjWTvmiUR4y6XkDe8Egz.9O');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `vote_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `poll_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `date_and_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`vote_id`, `user_id`, `poll_id`, `option_id`, `date_and_time`) VALUES
(37, 25, 65, 165, '2023-08-14 03:45:48'),
(38, 25, 66, 168, '2023-08-14 03:49:31'),
(39, 25, 58, 147, '2023-08-14 03:50:19'),
(40, 25, 67, 171, '2023-08-14 03:54:48'),
(41, 25, 68, 180, '2023-08-14 03:58:58'),
(42, 27, 47, 107, '2023-08-14 04:41:20'),
(43, 25, 47, 108, '2023-08-14 04:50:33'),
(44, 27, 58, 145, '2023-08-14 04:51:13'),
(45, 27, 65, 165, '2023-08-14 04:51:27'),
(46, 27, 66, 168, '2023-08-14 04:51:34'),
(47, 27, 67, 173, '2023-08-14 04:51:51'),
(48, 27, 68, 177, '2023-08-14 04:52:02'),
(49, 22, 47, 107, '2023-08-14 04:54:50'),
(50, 22, 58, 146, '2023-08-14 04:55:03'),
(51, 22, 65, 165, '2023-08-14 04:55:25'),
(52, 22, 66, 168, '2023-08-14 04:55:31'),
(53, 22, 67, 175, '2023-08-14 04:55:45'),
(54, 22, 68, 176, '2023-08-14 04:56:00'),
(55, 26, 47, 109, '2023-08-14 04:57:45'),
(56, 26, 58, 148, '2023-08-14 04:57:56'),
(57, 26, 65, 166, '2023-08-14 04:58:06'),
(58, 26, 66, 169, '2023-08-14 04:58:16'),
(59, 26, 67, 174, '2023-08-14 04:58:37'),
(60, 26, 68, 179, '2023-08-14 04:58:48'),
(61, 24, 47, 106, '2023-08-14 04:59:18'),
(62, 24, 58, 145, '2023-08-14 04:59:32'),
(63, 24, 65, 165, '2023-08-14 04:59:44'),
(64, 24, 66, 168, '2023-08-14 04:59:50'),
(65, 24, 67, 172, '2023-08-14 04:59:59'),
(66, 24, 68, 178, '2023-08-14 05:00:14'),
(67, 28, 47, 106, '2023-08-14 05:02:49'),
(68, 28, 58, 145, '2023-08-14 05:03:03'),
(69, 28, 65, 167, '2023-08-14 05:03:17'),
(70, 28, 66, 170, '2023-08-14 05:03:25'),
(71, 28, 67, 172, '2023-08-14 05:03:52'),
(72, 28, 68, 178, '2023-08-14 05:04:02'),
(74, 30, 71, 187, '2023-08-14 06:01:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `poll_id` (`poll_id`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`poll_id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`vote_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `poll_id` (`poll_id`),
  ADD KEY `option_id` (`option_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `poll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_ibfk_1` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`poll_id`) ON DELETE CASCADE;

--
-- Constraints for table `polls`
--
ALTER TABLE `polls`
  ADD CONSTRAINT `polls_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`poll_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_ibfk_3` FOREIGN KEY (`option_id`) REFERENCES `options` (`option_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
