-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2023 at 12:47 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `albaik_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `footer_sliders`
--

CREATE TABLE `footer_sliders` (
  `id` int(20) NOT NULL,
  `fslider_image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `footer_sliders`
--

INSERT INTO `footer_sliders` (`id`, `fslider_image`, `title`, `short_description`, `link`, `created_at`, `updated_at`) VALUES
(3, '1685962886.png', 'Footer Second slide label', 'Some representative placeholder content for the second slide.', 'link', NULL, NULL),
(4, '1685962935.png', 'Footer Slide Title', 'Some representative placeholder content for the Frist slide.', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `frontsettings`
--

CREATE TABLE `frontsettings` (
  `id` int(20) NOT NULL,
  `popular_icon` mediumtext DEFAULT NULL,
  `offer_icon` mediumtext DEFAULT NULL,
  `logo_img` mediumtext DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `facebooklink` varchar(255) DEFAULT NULL,
  `twitterlink` varchar(255) DEFAULT NULL,
  `linkdinlink` varchar(255) DEFAULT NULL,
  `youtubelink` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `frontsettings`
--

INSERT INTO `frontsettings` (`id`, `popular_icon`, `offer_icon`, `logo_img`, `description`, `address`, `phone`, `email`, `facebooklink`, `twitterlink`, `linkdinlink`, `youtubelink`) VALUES
(1, '1686126623.png', '16860636461.png', '1686066338.png', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nesciunt soluta ipsam dolorum perferendis at nihil autem iusto perspiciatis laudantium quia, nobis aliquid voluptas possimus doloremque non voluptatibus nam voluptates ullam.', '3100 Danforth Avenue Torento, Canada', '647-352-5009', 'support@albaik.com', 'https://facebook.com/', 'https://twitter.com/', 'https://linkedin.com/', 'https://youtube.com/');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `footer_sliders`
--
ALTER TABLE `footer_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontsettings`
--
ALTER TABLE `frontsettings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `footer_sliders`
--
ALTER TABLE `footer_sliders`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `frontsettings`
--
ALTER TABLE `frontsettings`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
