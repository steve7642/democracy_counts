-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 20, 2018 at 05:10 PM
-- Server version: 5.6.41-84.1
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `steve_520coa`
--

-- --------------------------------------------------------

--
-- Table structure for table `generic_list`
--

DROP TABLE IF EXISTS `generic_list`;
CREATE TABLE `generic_list` (
  `id` int(11) NOT NULL,
  `lastpdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `f1` varchar(500) DEFAULT NULL,
  `f2` varchar(500) DEFAULT NULL,
  `f3` varchar(500) DEFAULT NULL,
  `f4` varchar(500) DEFAULT NULL,
  `f5` varchar(500) DEFAULT NULL,
  `f6` varchar(500) DEFAULT NULL,
  `f7` varchar(500) DEFAULT NULL,
  `f8` varchar(500) DEFAULT NULL,
  `f9` varchar(500) DEFAULT NULL,
  `f10` varchar(500) DEFAULT NULL,
  `f11` varchar(500) DEFAULT NULL,
  `f12` varchar(500) DEFAULT NULL,
  `f13` varchar(500) DEFAULT NULL,
  `f14` varchar(500) DEFAULT NULL,
  `f15` varchar(500) DEFAULT NULL,
  `f16` varchar(500) DEFAULT NULL,
  `f17` varchar(500) DEFAULT NULL,
  `f18` varchar(500) DEFAULT NULL,
  `f19` varchar(500) DEFAULT NULL,
  `f20` varchar(500) DEFAULT NULL,
  `f21` varchar(500) DEFAULT NULL,
  `f22` varchar(500) DEFAULT NULL,
  `f23` varchar(500) DEFAULT NULL,
  `f24` varchar(500) DEFAULT NULL,
  `f25` varchar(500) DEFAULT NULL,
  `f26` varchar(500) DEFAULT NULL,
  `f27` varchar(500) DEFAULT NULL,
  `f28` varchar(500) DEFAULT NULL,
  `f29` varchar(500) DEFAULT NULL,
  `f30` varchar(500) DEFAULT NULL,
  `f31` varchar(500) DEFAULT NULL,
  `f32` varchar(500) DEFAULT NULL,
  `f33` varchar(500) DEFAULT NULL,
  `area` text,
  `listType` varchar(500) DEFAULT NULL,
  `area1` text,
  `area2` text,
  `area3` text,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `createDate` datetime DEFAULT NULL,
  `nRepeat` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `generic_list`
--
ALTER TABLE `generic_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `generic_list`
--
ALTER TABLE `generic_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
