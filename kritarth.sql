-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2017 at 11:13 AM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kritarth`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `regid` varchar(10) NOT NULL,
  `name` text NOT NULL,
  `rollno` text NOT NULL,
  `university` text NOT NULL,
  `school` text NOT NULL,
  `email` text NOT NULL,
  `age` text NOT NULL,
  `gender` text NOT NULL,
  `phone` text NOT NULL,
  `event1` text NOT NULL,
  `event2` text NOT NULL,
  `paid` int(11) NOT NULL DEFAULT '0',
  `md5key` text NOT NULL,
  `verified` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `regid`, `name`, `rollno`, `university`, `school`, `email`, `age`, `gender`, `phone`, `event1`, `event2`, `paid`, `md5key`, `verified`) VALUES
(89, 'KR00089', 'jnsa', '34213', '', '', 'sad@kbd.com', '11', 'F', '9038911111', 'Galapagos Island', '-1', 0, '', 0),
(90, 'KR00090', 'hbka', '1023', '', '', 'hjbad@hbas.com', '0', 'F', '9831075533', 'Kausative', '-1', 0, '', 0),
(91, 'KR00091', 'ahldakldn', '13134', '', '', 'ad@jbkd.com', '09/01/2001', 'F', '9038916952', '-1', 'Storyfie', 0, '', 0),
(116, 'KR00116', 'ldnka', '1213', '', '', 'adaa@kmd.com', '13', 'F', '9831075581', 'Devils Advocate', '', 0, '', 0),
(125, 'KR00125', 'ABHIJOY SARKAR', '1505089', 'KIITian', '', 'asterdan712@gmail.com', '20', 'F', '9038906952', 'Devils Advocate', '', 0, '0dc7ff0aff5e2a09bca25fdd52e1d804', 1),
(126, 'KR00126', 'Ali', '', 'School', 'Loyola School', 'ali@gmail.com', '20', 'F', '9038905512', '', '', 0, 'aa0857e51e558a0c063f9a0b3add3818', 0);

-- --------------------------------------------------------

--
-- Table structure for table `webhook`
--

CREATE TABLE `webhook` (
  `id` int(11) NOT NULL,
  `payment_id` text NOT NULL,
  `payment_request_id` text NOT NULL,
  `kritarth_id` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD UNIQUE KEY `regid` (`regid`);

--
-- Indexes for table `webhook`
--
ALTER TABLE `webhook`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
--
-- AUTO_INCREMENT for table `webhook`
--
ALTER TABLE `webhook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
