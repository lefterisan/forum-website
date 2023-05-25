-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 20, 2023 at 10:47 PM
-- Server version: 5.7.41-0ubuntu0.18.04.1
-- PHP Version: 7.3.33-10+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`com_id`, `content`, `date`, `user_id`, `post_id`) VALUES
(115, ' test', '2023-05-18 02:40:10', 70, 7),
(116, ' test', '2023-05-18 02:42:15', 70, 7),
(117, ' test', '2023-05-18 02:43:33', 70, 7),
(118, ' hello', '2023-05-18 02:44:44', 70, 7),
(119, ' geia ', '2023-05-18 02:45:58', 70, 7),
(120, ' ti kanis', '2023-05-18 02:46:03', 70, 7),
(121, ' haha', '2023-05-18 02:46:07', 70, 7),
(122, ' arakse re mi trelenese sti zwh einai afta', '2023-05-18 02:48:09', 70, 6),
(124, ' test', '2023-05-18 02:50:00', 70, 7),
(126, 'De mas niazi re mas me enoxlis', '2023-05-19 16:51:44', 70, 11);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `content`, `user_id`, `date`) VALUES
(1, 'test', ' test', 70, '2023-05-14 23:04:08'),
(2, 'test', 'test', 70, '2023-05-15 17:07:55'),
(3, 'kalispera', 'ime trelos', 70, '2023-05-15 19:08:31'),
(4, 'ENAS  MEGALSO TITLTOS XDXDXDXDXDENAS  MEGALSO TITLTOS XDXDXDXDXDENAS  MEGALSO TITLTOS XDXDXDXDXDENAS  MEGALSO TITLTOS XDXDXDXDXDENAS  MEGALSO TITLTOS XDXDXDXDXDENAS  MEGALSO TITLTOS XDXDXDXDXDENAS  MEGALSO TITLTOS XDXDXDXDXDENAS  MEGALSO TITLTOS XDXDXDXDXDENAS  MEGALSO TITLTOS XDXDXDXDXDENAS  MEGALSO TITLTOS XDXDXDXDXDENAS  MEGALSO TITLTOS XDXDXDXDXD', 'AFTO EINAI ENA TERASTIO KIMENOAEDEWRG0IESRHUPNOIESRHUPNOIEHTSRJ[OIEHSRJ;IOSJEH\'RIOJP\'ROIS ETSRJP\'OIS EHRJP\'[OIJPIHRA JPOA HRJP[O PA RPARA EHRA 0EPH9RA EHTRA OP EHTRA', 70, '2023-05-15 19:22:35'),
(5, 'kalispera', 'den ime kala ', 71, '2023-05-15 20:05:17'),
(6, 'Why cant i stop playing new vegas', 'Help I am addicted to new vegas for at least 5 years now. I can\'t stop thinking about playing it and becuase of it\'s superior writing i can\'t enjoy any other game. Is there a cure? ', 72, '2023-05-18 00:46:33'),
(7, 'alo akomi test', 'nai alo ena test', 70, '2023-05-18 01:33:45'),
(9, 'hello world', 'hello world', 70, '2023-05-18 02:54:53'),
(10, 'KALISPERA PEDIA', 'KSERI KANIS GIATI DEN ANIGI TO PC? 8ELW NA PEKSO FORTNITE KAI DE MPORO UwU.', 70, '2023-05-19 16:47:59'),
(11, 'XERETO TIN PAREA', 'AFTO TO ACCOUNT 8A GINI DELETE APLA I8ELA NA SAS XERETISO OLOUS KAI OLES!!!!', 73, '2023-05-19 16:50:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `surname` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(128) NOT NULL,
  `psw` varchar(255) NOT NULL,
  `simplepush_key` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `username`, `psw`, `simplepush_key`) VALUES
(64, '3fb4027018430c44e8fd13fd9b3ad03f', '78fb718b892b27abd3babea5f1feb61f', 'b2659cee5479299725d710a75cece2a2', '59963b9ae3e31f4e81f38ffa82efdd27', '7e04c695308111caf09095a52bc67c1a', '341456'),
(70, 'Eleftherios', 'andriotis', 'lefteris786@gmail.com', 'lefterakis', '$2y$10$M.M2ecClafLv47RjCX7YyuwCjomSVWq1bkEmUqCDAXY.8jn4.jr9G', '000000'),
(71, 'Eleftherios', 'andriotis', 'lefteris123@gmail.com', 'p20andr', '$2y$10$LmLgWsolZSFxGtAh3FSgeeOL2dMRnBaT8fn0Fvwb20Bp4P286v7AK', '000000'),
(72, 'Nikolas', 'Karakonstantis', 'p20kara6@ionio.gr', 'TheMojaveCourier', '$2y$10$WzVpMeLITaZXcqonD88s6uhHbvn4KoUpgKk/134MIwxn1sgnTlRKi', '000000'),
(73, '8c719745d1b3422a376187e98944f0b2', '692d5cc992f66f23d0691fd476b20295', '06bb3d72e809b6540b430f361a441dc0', '2bbdb178d68ca52d6beb2e8d954f2df9', 'b8d37cacfeb48ffa80a8502b6bc99947', '715fb8');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
