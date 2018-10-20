-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 20, 2018 at 05:00 PM
-- Server version: 5.6.41-84.1
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `steve_520coa`
--

-- --------------------------------------------------------

--
-- Table structure for table `mgt_users`
--

CREATE TABLE `mgt_users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userLevel` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mgt_users`
--

INSERT INTO `mgt_users` (`id`, `firstname`, `lastname`, `username`, `password`, `userLevel`) VALUES
(1, 'super', 'admin', 'super', '21232f297a57a5a743894a0e4a801fc3', 0),
(10, 'Super', 'Duper', 'superduper', '21232f297a57a5a743894a0e4a801fc3', 0),
(3, 'John', 'Jones', 'jones', '21232f297a57a5a743894a0e4a801fc3', 1),
(5, 'Daniel', 'Wolf', 'daniel', '21232f297a57a5a743894a0e4a801fc3', 1),
(6, 'Stephen', 'Padgett', 'steve', '21232f297a57a5a743894a0e4a801fc3', 1),
(7, 'Baker', 'Chad', 'chad', '21232f297a57a5a743894a0e4a801fc3', 1),
(9, 'Stephen', 'Padgett2', 'steve2', '21232f297a57a5a743894a0e4a801fc3', 1),
(11, 'John Q', 'Auditor', 'audit', '21232f297a57a5a743894a0e4a801fc3', 1),
(12, 'Eric', 'Hillis', 'ehillis', '6f1ed002ab5595859014ebf0951522d9', 1),
(13, 'System', 'Administrator', 'master', '21232f297a57a5a743894a0e4a801fc3', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mgt_users`
--
ALTER TABLE `mgt_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mgt_users`
--
ALTER TABLE `mgt_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
