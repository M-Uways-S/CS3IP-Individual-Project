-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 08, 2025 at 09:26 AM
-- Server version: 11.5.2-MariaDB
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

DROP TABLE IF EXISTS `feedbacks`;
CREATE TABLE IF NOT EXISTS `feedbacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feedback_text` text NOT NULL,
  `submitted_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `feedback_text`, `submitted_at`) VALUES
(1, 'test 1', '2025-04-26 23:52:52'),
(2, 'test again', '2025-04-26 23:58:57'),
(3, 'Anonymous test feedback', '2025-05-04 08:24:37');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

DROP TABLE IF EXISTS `quiz_questions`;
CREATE TABLE IF NOT EXISTS `quiz_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `correct_option` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`) VALUES
(3, 'What is a cookie mainly used for?', 'Storing large files', 'Remembering user preferences', 'Encrypting server data', 'Improving image quality', 'B'),
(4, 'Which type of cookie is deleted when you close your browser?', 'Persistent cookie', 'Tracking cookie', 'Session cookie', 'Secure cookie', 'C'),
(5, 'First-party cookies are set by:', 'Ad networks', 'The site you are visiting', 'A different domain', 'Your browser company', 'B'),
(6, 'Where can you inspect cookies in your browser?', 'Developer Tools → Network Tab', 'Developer Tools → Application/Storage Tab', 'Settings → Display Tab', 'Help → About', 'B'),
(7, 'LocalStorage differs from cookies because:', 'It sends data to the server automatically', 'It can store bigger amounts of data', 'It deletes itself after session ends', 'It encrypts data', 'B'),
(8, 'What technique identifies users without cookies?', 'Browser Fingerprinting', 'Cookie Mirroring', 'Session Replaying', 'Content Spoofing', 'A'),
(9, 'Under GDPR, websites must:', 'Automatically accept cookies', 'Give users an opt-out only', 'Provide clear opt-in consent', 'Hide cookie settings', 'C'),
(10, 'What is a third-party cookie?', 'A cookie set by the website you are visiting', 'A cookie set by another domain embedded on the page', 'A cookie created by the browser', 'A cookie installed by antivirus software', 'B'),
(11, 'How can you manage cookies in Chrome?', 'Privacy and security settings → Cookies and site data', 'Appearance settings', 'Downloads settings', 'Extensions settings', 'A'),
(12, 'What does \"Incognito Mode\" help with?', 'Encrypts all web traffic', 'Stops cookies from being created at all', 'Deletes cookies after you close the window', 'Blocks all ads automatically', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_scores`
--

DROP TABLE IF EXISTS `quiz_scores`;
CREATE TABLE IF NOT EXISTS `quiz_scores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `score` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10015 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `score`) VALUES
(1, 'testuser', 'password123', 0),
(2, 'test2', '$2y$10$XsxTt2eUl.SBv5yNGZDLYOzaYQrXmOFJ1n2pR/1yUPqrFkhD1J.4e', 6),
(3, 'test3', '$2y$10$MsYSFmWAj6yo8J9QCpMX4eHJH8uc1k4ciuRquqCgiixq9.958G702', 1),
(10012, 'leader_user1', '$2y$10$jASAuVUcwXoMR4re9MlOR.viwsPbfwwHgfJIiE1nFv2QuE5n1sjQ6', 5),
(10013, 'leader_user2', '$2y$10$uXb/ZIiigt7rHEOG8FtCNuV6PxAWN/fBtTD.FFC3YizMsHjOBB02e', 9),
(10014, 'leader_user3', '$2y$10$Q6NZiPmG1rAEPBfS/3MknuLnJQMeoUecoVu5YJ5JZgsPghcxqyPfG', 7);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
