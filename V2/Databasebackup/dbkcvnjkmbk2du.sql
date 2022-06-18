-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 22, 2022 at 05:41 PM
-- Server version: 5.7.32-35-log
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbkcvnjkmbk2du`
--

-- --------------------------------------------------------

--
-- Table structure for table `bannedIP`
--

CREATE TABLE `bannedIP` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `timeStamp` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `idImage` int(11) NOT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `idImage` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `titleImage` varchar(255) NOT NULL,
  `descImage` varchar(255) NOT NULL,
  `imgFullName` varchar(255) NOT NULL,
  `orderImage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`idImage`, `user`, `titleImage`, `descImage`, `imgFullName`, `orderImage`) VALUES
(13, 'admin', 'Band Sighting', 'Here we see Beau in one his most famous renditions', '62083c558e05e9.72155944.jpg', 1),
(14, 'admin', 'Alcohol Beau ', 'It seems Beau got into a liquor cabinet it is unknown how he may act while inebriated', '62083c977f3679.55921806.jpg', 2),
(15, 'admin', 'Quick shot', 'Hastily taken photograph as beau appears in an individuals house', '62083ce72c7a47.93767847.jpg', 3),
(16, 'SeekerOfTruth', 'Hidden in the bushes', 'While I was walking down the street I peered into the bushes and saw him', '62083da13f54f2.15903896.jpg', 4),
(17, 'SeekerOfTruth', 'Into Action', '', '62192f802ede23.89626407.png', 5);

-- --------------------------------------------------------

--
-- Table structure for table `profilepic`
--

CREATE TABLE `profilepic` (
  `ID` int(11) NOT NULL,
  `user` varchar(225) NOT NULL,
  `type` varchar(25) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profilepic`
--

INSERT INTO `profilepic` (`ID`, `user`, `type`, `status`) VALUES
(12, 'SeekerOfTruth', '.jpg', 1),
(15, 'JoeSwonson', '.png', 0),
(16, 'Onlooker225', '.png', 0),
(17, 'Michael123', '.png', 0),
(18, 'admin', '.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remoteIP` varchar(255) NOT NULL,
  `bio` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `remoteIP`, `bio`) VALUES
(1, 'admin', 'adminPassword12345', '', 'Welcome friend. Enjoy the findings.'),
(13, 'SeekerOfTruth', 'SeekerOfTruth12345', '24.63.98.132', 'Looking for the answers from the true god'),
(16, 'JoeSwonson', 'JoeSwonson44', '24.63.98.132', 'Polish farmer that has seen Beaus light'),
(17, 'Onlooker225', 'Onlooker225', '24.63.98.132', NULL),
(18, 'Michael123', 'Michael123', '50.214.230.98', 'Hello');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `vote` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `idImage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `vote`, `userID`, `idImage`) VALUES
(1, 1, 13, 16),
(2, 1, 1, 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bannedIP`
--
ALTER TABLE `bannedIP`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`idImage`);

--
-- Indexes for table `profilepic`
--
ALTER TABLE `profilepic`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bannedIP`
--
ALTER TABLE `bannedIP`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `idImage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `profilepic`
--
ALTER TABLE `profilepic`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
