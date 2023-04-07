-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Apr 07, 2023 at 08:58 PM
-- Server version: 10.9.4-MariaDB-1:10.9.4+maria~ubu2204
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `developmentdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `author` varchar(255) NOT NULL,
  `posted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `author`, `posted_at`) VALUES
(1, 'Test title', 'test content', 'test author', '2022-11-30 13:09:55'),
(2, 'Another test title', 'Some more test content', 'test author', '2022-11-29 13:09:55');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'bread'),
(3, 'vegetables');

-- --------------------------------------------------------

--
-- Table structure for table `Movie`
--

CREATE TABLE `Movie` (
  `_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `director` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `genre` varchar(50) NOT NULL,
  `dateProduced` varchar(10) NOT NULL,
  `price` varchar(7) NOT NULL,
  `image` varchar(100) NOT NULL,
  `rating` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Movie`
--

INSERT INTO `Movie` (`_id`, `title`, `director`, `description`, `genre`, `dateProduced`, `price`, `image`, `rating`) VALUES
(1, 'Avatar: The Way of Water', 'James Cameron', 'Jake Sully lives with his newfound family formed on the extrasolar moon Pandora. Once a familiar threat returns to finish what was previously started, Jake must work with Neytiri and the army of the Na&#039;vi race to protect their home.', 'Action', '2022-12-16', '€20.00', '63cc25fd945f9.jpg', '7.90'),
(4, 'Glass Onion: A Knives Out Mystery', 'Rian Johnson', 'Five long-time friends are invited to the Greek island home of billionaire Miles Bron. All five know Bron from way back and owe their current wealth, fame and careers to him. The main event is a murder weekend game with Bron to be the victim. In reality, they all have reasons to kill him. Also invited is Benoit Blanc, the world&#039;s greatest detective', 'Drama', '2022-12-23', ' €20.00', 'a-knives-out-mystery.jpg', '9.50'),
(37, 'Violent Night', 'Tommy Wirkola', 'When a group of mercenaries attack the estate of a wealthy family, Santa Claus must step in to save the day (and Christmas).', 'Comedy', '2022-12-02', '$20', '63cc31fef2dfa.jpg', '6.7'),
(38, 'Fall', 'Scott Mann', 'Drowning in a sea of grief, 51 painful weeks after the life-altering incident that scarred her for life, emotionally fragile rock climber Becky reluctantly decides to confront her fears. And as her thrill-seeking friend Hunter re-enters Becky&#039;s ruined life, the two experienced climbers embark on a high-risk climbing adventure to the top of the abandoned 2,000-foot B67 TV tower: an anxiety-inducing, vertigo-inspiring construction of weather-beaten metal and rattling rivets in the middle of the Mojave desert. However, when the peril-laden climb doesn&#039;t go as planned, the women must summon up every last ounce of courage and strength to devise a plan for a safe return home--or die trying.', 'Thriller', '2022-08-12', '$20', '63cc3258d4275.jpg', '6.4'),
(42, 'Title', 'Director', 'asdg', 'Genre', '2023-03-31', '$20', '', '10.0'),
(44, 'asdf', 'asdf', 'asdf', 'asdf', '2023-04-06', '1', '643024c2a61f0.png', '1');

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `_id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `dateOrdered` varchar(20) NOT NULL,
  `movieID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`_id`, `userID`, `dateOrdered`, `movieID`) VALUES
(1, 4, '2023-01-19 13:45:31', 4),
(2, 4, '2023-01-19 14:43:53', 4),
(3, 4, '2023-01-19 20:55:22', 1),
(4, 4, '2023-01-19 21:14:45', 4),
(5, 4, '2023-01-19 21:15:38', 4),
(6, 4, '2023-01-19 21:17:17', 4),
(7, 3, '2023-01-21 19:14:32', 1),
(8, 3, '2023-04-07', 1),
(9, 3, '2023-04-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` varchar(8000) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `description`, `image`, `category_id`) VALUES
(1, 'Ciabatta', '2.50', 'Ciabatta (which translates to slipper!) is an Italian bread made with wheat flour, salt, yeast, and water. Though it\'s texture and crust vary slightly throughout Italy, the essential ingredients remain the same. Ciabatta is best for sandwiches and paninis, naturally.', 'https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/957759184-1529703875.jpg?crop=1.00xw:0.645xh;0,0.104xh&resize=980:*', 1),
(2, 'Whole Wheat Bread', '2.00', 'Unlike white bread, whole-wheat bread is made from flour that uses almost the entire wheat grain—with the bran and germ in tact. This means more nutrients and fiber per slice! ', 'https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/whole-wheat-bread-horizontal-1-jpg-1590195849.jpg?crop=0.735xw:0.735xh;0.187xw,0.128xh&resize=980:*', 1),
(3, 'Artichoke', '1.50', 'Artichokes contain an unusual organic acid called cynarin which affects taste and may be the reason why water appears to taste sweet after eating artichokes. The flavour of wine is similarly altered and many wine experts believe that wine shouldn’t accompany artichokes.', 'https://www.vegetables.co.nz/assets/vegetables/_resampled/FillWyI0MDAiLCIzMDAiXQ/artichokes-globe.png', 3),
(4, 'Asparagus ', '3.00', 'Asparagus originated in the Eastern Mediterranean and was a favourite of the Greeks and Romans who used it as a medicine. Varieties of asparagus grow wild in parts of Europe, Turkey, Africa, Middle East and Asia.', 'https://www.vegetables.co.nz/assets/vegetables/_resampled/FillWyI0MDAiLCIzMDAiXQ/asparagus.png', 3);

-- --------------------------------------------------------

--
-- Table structure for table `Stock`
--

CREATE TABLE `Stock` (
  `movieId` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `isadmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `address` varchar(100) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `birthdate` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `firstname`, `lastname`, `email`, `password`, `isAdmin`, `address`, `postcode`, `birthdate`) VALUES
(3, 'Philip', 'Tsagli', 'phils@email.com', '$2y$10$1yVEgcJH39OZrMxZS4pDgeseh9UoKSe.zdqwDSb83daCAfJd4c6oC', 1, 'Kikkenstein', '1104TX', '2023-01-04'),
(4, 'Admin', 'Admin', 'admin@email.com', '$2y$10$7sYtFaTNzQOb67GEPJLzZO9zvIT7cI1Ol/UGnrsFhmlya.q4pjr4a', 1, 'Inholland ', '1234AG', '2022-12-29'),
(13, 'Philip', 'Tsagli', 'philiptsagli@email.com', '$2y$10$SApFR2mMPQv5C5cLO34VWeQ/gGctCcxqd6hNvRE4mRiNKm2toXWai', 0, 'Kikkenstein', '1104TX', '2023-01-04'),
(15, 'Philip', 'Tsagli', 'philiptsasdfaagli@gmail.com', '$2y$10$sDYI98hqqPUpXufIRApcJOKVeFsW3pemwlpdZmI947GEusEfOew8O', 0, 'Kikkenstein', '1104TX', '2023-03-29'),
(16, 'nonadmin', 'nonadmin', 'nonadmin@email.com', '$2y$10$aRK8wb0NT3beU8q6XSjVpOIQ7T9zQ4P0eUfLzPGrMn8/67QXhRr/q', 0, 'asdfasdf', '1234AG', '2023-04-07'),
(19, 'new ', 'admin', 'newadmin@email.com', '$2y$10$T2K68Gsfk/vqvzkRTX9.pevk5m/3ht2C4qTOB52Mvp5oLd4X7YoEC', 1, 'asdfas', 'sadf', '2023-03-30');

-- --------------------------------------------------------

--
-- Table structure for table `userss`
--

CREATE TABLE `userss` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userss`
--

INSERT INTO `userss` (`id`, `username`, `password`, `email`) VALUES
(1, 'username', '$2y$10$DQlV0u9mFmtOWsOdxXX9H.4kgzEB3E8o97s.S.Pdy4klUAdBvtVh.', 'username@password.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Movie`
--
ALTER TABLE `Movie`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`_id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `movieID` (`movieID`);

--
-- Indexes for table `Stock`
--
ALTER TABLE `Stock`
  ADD KEY `movieId` (`movieId`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Movie`
--
ALTER TABLE `Movie`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `Orders_ibfk_2` FOREIGN KEY (`movieID`) REFERENCES `Movie` (`_id`);

--
-- Constraints for table `Stock`
--
ALTER TABLE `Stock`
  ADD CONSTRAINT `Stock_ibfk_1` FOREIGN KEY (`movieId`) REFERENCES `Movie` (`_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
