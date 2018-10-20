-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 20, 2018 at 05:06 PM
-- Server version: 5.6.41-84.1
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `steve_520coa`
--

-- --------------------------------------------------------

--
-- Table structure for table `generic_list2`
--

CREATE TABLE `generic_list2` (
  `id` int(11) NOT NULL,
  `f1` varchar(500) DEFAULT NULL,
  `f2` varchar(500) DEFAULT NULL,
  `f3` varchar(500) DEFAULT NULL,
  `f4` varchar(500) DEFAULT NULL,
  `listType` varchar(500) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `generic_list2`
--
ALTER TABLE `generic_list2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `generic_list2`
--
ALTER TABLE `generic_list2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
