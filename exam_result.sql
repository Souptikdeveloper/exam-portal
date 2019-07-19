-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2019 at 11:19 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `exam_result`
--

CREATE TABLE `exam_result` (
  `id` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `qualifying_exam_score` int(11) NOT NULL,
  `qualifying_exam_status` enum('Pass','Failed') NOT NULL,
  `grading_exam_score` int(11) NOT NULL,
  `grading_exam_status` enum('Pass','Failed') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_result`
--

INSERT INTO `exam_result` (`id`, `user_id`, `qualifying_exam_score`, `qualifying_exam_status`, `grading_exam_score`, `grading_exam_status`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 'Failed', 0, 'Pass', '2019-07-16 12:18:34', '2019-07-16 12:18:34'),
(2, 4, 4, 'Failed', 0, 'Pass', '2019-07-16 12:40:05', '2019-07-16 12:40:05'),
(3, 5, 2, 'Failed', 0, 'Pass', '2019-07-16 12:51:52', '2019-07-16 12:51:52'),
(4, 6, 2, 'Failed', 0, 'Pass', '2019-07-16 13:01:02', '2019-07-16 13:01:02'),
(5, 7, 0, 'Failed', 0, 'Pass', '2019-07-16 13:01:59', '2019-07-16 13:01:59'),
(6, 10, 6, 'Pass', 0, 'Pass', '2019-07-16 12:47:28', '2019-07-16 12:47:28'),
(7, 18, 0, 'Failed', 0, 'Pass', '2019-07-20 03:24:51', '2019-07-20 03:24:51'),
(8, 19, 0, 'Failed', 0, 'Pass', '2019-07-20 03:25:45', '2019-07-20 03:25:45'),
(9, 20, 0, 'Failed', 0, 'Pass', '2019-07-20 03:27:07', '2019-07-20 03:27:07'),
(10, 21, 0, 'Failed', 0, 'Pass', '2019-07-20 03:31:57', '2019-07-20 03:31:57'),
(11, 22, 0, 'Failed', 0, 'Pass', '2019-07-20 03:43:40', '2019-07-20 03:43:40'),
(12, 23, 2, 'Failed', 0, 'Pass', '2019-07-20 03:48:29', '2019-07-20 03:48:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exam_result`
--
ALTER TABLE `exam_result`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exam_result`
--
ALTER TABLE `exam_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
