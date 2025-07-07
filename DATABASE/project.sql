-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2024 at 04:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `name`, `email`, `number`, `date`, `time`, `address`, `status`) VALUES
(30, 'sita', 'sita@gmail.com', 9736478263, '2024-10-06', '7:00 PM', 'abc', 'confirmed'),
(31, 'akansha', 'aku@gmail.com', 9277261876, '2024-09-26', '7:30 PM', 'rangtara society', 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_images`
--

CREATE TABLE `appointment_images` (
  `id` int(11) NOT NULL,
  `appointment_id` int(255) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_images`
--

INSERT INTO `appointment_images` (`id`, `appointment_id`, `img_name`, `price`, `images`) VALUES
(34, 30, 'img-34', 150.00, 'images/western/img-34.png'),
(35, 30, 'img-2', 150.00, 'images/kankupagla/img-2.png'),
(36, 31, 'img-19', 300.00, 'images/western/img-19.png'),
(37, 31, 'img-4', 200.00, 'images/kankupagla/img-4.png'),
(38, 31, 'img-35', 150.00, 'images/western/img-35.png');

-- --------------------------------------------------------

--
-- Table structure for table `arabic_images`
--

CREATE TABLE `arabic_images` (
  `id` int(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `price` int(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arabic_images`
--

INSERT INTO `arabic_images` (`id`, `image_name`, `image_path`, `price`) VALUES
(1, 'img-1', 'images/arabic/img-1.png', 250),
(2, 'img-2', 'images/arabic/img-2.png', 100),
(3, 'img-3', 'images/arabic/img-3.png', 150),
(4, 'img-4', 'images/arabic/img-4.png', 150),
(5, 'img-5', 'images/arabic/img-5.png', 150),
(6, 'img-6', 'images/arabic/img-6.png', 150),
(7, 'img-7', 'images/arabic/img-7.png', 200),
(8, 'img-8', 'images/arabic/img-8.png', 300),
(9, 'img-9', 'images/arabic/img-9.png', 200),
(10, 'img-10', 'images/arabic/img-10.png', 350),
(11, 'img-11', 'images/arabic/img-11.png', 300),
(12, 'img-12', 'images/arabic/img-12.png', 300),
(13, 'img-13', 'images/arabic/img-13.png', 250),
(14, 'img-14', 'images/arabic/img-14.png', 300),
(15, 'img-15', 'images/arabic/img-15.png', 200),
(16, 'img-16', 'images/arabic/img-16.png', 350),
(17, 'img-17', 'images/arabic/img-17.png', 350),
(18, 'img-18', 'images/arabic/img-18.png', 300),
(19, 'img-19', 'images/arabic/img-19.png', 300),
(20, 'img-20', 'images/arabic/img-20.png', 350),
(21, 'img-21', 'images/arabic/img-21.png', 250),
(22, 'img-22', 'images/arabic/img-22.png', 200),
(23, 'img-23', 'images/arabic/img-23.png', 200),
(24, 'img-24', 'images/arabic/img-24.png', 100),
(25, 'img-25', 'images/arabic/img-25.png', 150),
(26, 'img-26', 'images/arabic/img-26.png', 200),
(27, 'img-27', 'images/arabic/img-27.png', 250),
(28, 'img-28', 'images/arabic/img-28.png', 200),
(29, 'img-29', 'images/arabic/img-29.png', 200),
(30, 'img-30', 'images/arabic/img-30.png', 150),
(31, 'img-31', 'images/arabic/img-31.png', 250),
(32, 'img-32', 'images/arabic/img-32.png', 250),
(33, 'img-33', 'images/arabic/img-33.png', 200),
(34, 'img-34', 'images/arabic/img-34.png', 200),
(35, 'img-35', 'images/arabic/img-35.png', 50),
(36, 'img-36', 'images/arabic/img-36.png', 150),
(37, 'img-37', 'images/arabic/img-37.png', 200),
(38, 'img-38', 'images/arabic/img-38.png', 150),
(39, 'img-39', 'images/arabic/img-39.png', 150),
(40, 'img-40', 'images/arabic/img-40.png', 100),
(41, 'img-41', 'images/arabic/img-41.png', 100),
(42, 'img-42', 'images/arabic/img-42.png', 150),
(43, 'img-43', 'images/arabic/img-43.png', 150),
(44, 'img-44', 'images/arabic/img-44.png', 100),
(45, 'img-45', 'images/arabic/img-45.png', 100),
(46, 'img-46', 'images/arabic/img-46.png', 100),
(47, 'img-47', 'images/arabic/img-47.png', 100),
(48, 'img-48', 'images/arabic/img-48.png', 100),
(49, 'img-49', 'images/arabic/img-49.png', 100),
(50, 'img-50', 'images/arabic/img-50.png', 100),
(51, 'img-51', 'images/arabic/img-51.png', 50),
(52, 'img-52', 'images/arabic/img-52.png', 100),
(53, 'img-53', 'images/arabic/img-53.png', 150),
(54, 'img-54', 'images/arabic/img-54.png', 50),
(55, 'img-55', 'images/arabic/img-55.png', 100),
(56, 'img-56', 'images/arabic/img-56.png', 100),
(57, 'img-57', 'images/arabic/img-57.png', 150),
(58, 'img-58', 'images/arabic/img-58.png', 100),
(59, 'img-59', 'images/arabic/img-59.png', 100),
(60, 'img-60', 'images/arabic/img-60.png', 100),
(61, 'img-61', 'images/arabic/img-61.png', 100),
(62, 'img-62', 'images/arabic/img-62.png', 150),
(63, 'img-63', 'images/arabic/img-63.png', 50),
(64, 'img-64', 'images/arabic/img-64.png', 50),
(65, 'img-65', 'images/arabic/img-65.png', 100),
(66, 'img-66', 'images/arabic/img-66.png', 150),
(67, 'img-67', 'images/arabic/img-67.png', 100),
(68, 'img-68', 'images/arabic/img-68.png', 100),
(69, 'img-69', 'images/arabic/img-69.png', 100),
(70, 'img-70', 'images/arabic/img-70.png', 50),
(71, 'img-71', 'images/arabic/img-71.png', 100),
(72, 'img-72', 'images/arabic/img-72.png', 100),
(73, 'img-73', 'images/arabic/img-73.png', 100),
(74, 'img-74', 'images/arabic/img-74.png', 100),
(75, 'img-75', 'images/arabic/img-75.png', 100);

-- --------------------------------------------------------

--
-- Table structure for table `babyshower_images`
--

CREATE TABLE `babyshower_images` (
  `id` int(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `babyshower_images`
--

INSERT INTO `babyshower_images` (`id`, `image_name`, `image_path`, `price`) VALUES
(1, 'img-1', 'images/baby-shower/img-1.png', 450),
(2, 'img-2', 'images/baby-shower/img-2.png', 600),
(3, 'img-3', 'images/baby-shower/img-3.png', 550),
(4, 'img-4', 'images/baby-shower/img-4.png', 800),
(5, 'img-5', 'images/baby-shower/img-5.png', 500),
(6, 'img-6', 'images/baby-shower/img-6.png', 650),
(7, 'img-7', 'images/baby-shower/img-7.png', 650),
(8, 'img-8', 'images/baby-shower/img-8.png', 550),
(9, 'img-9', 'images/baby-shower/img-9.png', 700),
(10, 'img-10', 'images/baby-shower/img-10.png', 50),
(11, 'img-11', 'images/baby-shower/img-11.png', 550),
(12, 'img-12', 'images/baby-shower/img-12.png', 500),
(13, 'img-13', 'images/baby-shower/img-13.png', 400),
(14, 'img-14', 'images/baby-shower/img-14.png', 1500),
(15, 'img-15', 'images/baby-shower/img-15.png', 650),
(16, 'img-16', 'images/baby-shower/img-16.png', 400),
(17, 'img-17', 'images/baby-shower/img-17.png', 500),
(18, 'img-18', 'images/baby-shower/img-18.png', 1500),
(19, 'img-19', 'images/baby-shower/img-19.png', 1000),
(20, 'img-20', 'images/baby-shower/img-20.png', 500),
(21, 'img-21', 'images/baby-shower/img-21.png', 600),
(22, 'img-22', 'images/baby-shower/img-22.png', 2000),
(23, 'img-23', 'images/baby-shower/img-23.png', 800),
(24, 'img-24', 'images/baby-shower/img-24.png', 750),
(25, 'img-25', 'images/baby-shower/img-25.png', 400),
(26, 'img-26', 'images/baby-shower/img-26.png', 700);

-- --------------------------------------------------------

--
-- Table structure for table `bridal_images`
--

CREATE TABLE `bridal_images` (
  `id` int(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bridal_images`
--

INSERT INTO `bridal_images` (`id`, `image_name`, `image_path`, `price`) VALUES
(1, 'img-1', 'images/bridal/img-1.png', 2000),
(2, 'img-2', 'images/bridal/img-2.png', 3000),
(3, 'img-3', 'images/bridal/img-3.png', 1500),
(4, 'img-4', 'images/bridal/img-4.png', 6000),
(5, 'img-5', 'images/bridal/img-5.png', 6000),
(6, 'img-6', 'images/bridal/img-6.png', 13000),
(7, 'img-7', 'images/bridal/img-7.png', 15000),
(8, 'img-8', 'images/bridal/img-8.png', 5000),
(9, 'img-9', 'images/bridal/img-9.png', 7000),
(10, 'img-10', 'images/bridal/img-10.png', 1000),
(11, 'img-11', 'images/bridal/img-11.png', 4000),
(12, 'img-12', 'images/bridal/img-12.png', 4000),
(13, 'img-13', 'images/bridal/img-13.png', 5000),
(14, 'img-14', 'images/bridal/img-14.png', 5000),
(15, 'img-15', 'images/bridal/img-15.png', 800),
(16, 'img-16', 'images/bridal/img-16.png', 600),
(17, 'img-17', 'images/bridal/img-17.png', 1000),
(18, 'img-18', 'images/bridal/img-18.png', 1500),
(19, 'img-19', 'images/bridal/img-19.png', 2000),
(20, 'img-20', 'images/bridal/img-20.png', 1500),
(21, 'img-21', 'images/bridal/img-21.png', 1000),
(22, 'img-22', 'images/bridal/img-22.png', 2000),
(23, 'img-23', 'images/bridal/img-23.png', 1500),
(24, 'img-24', 'images/bridal/img-24.png', 2000),
(25, 'img-25', 'images/bridal/img-25.png', 2500),
(26, 'img-26', 'images/bridal/img-26.png', 1000),
(27, 'img-27', 'images/bridal/img-27.png', 1500),
(28, 'img-28', 'images/bridal/img-28.png', 2000),
(29, 'img-29', 'images/bridal/img-29.png', 1500),
(30, 'img-30', 'images/bridal/img-30.png', 2000),
(31, 'img-31', 'images/bridal/img-31.png', 4000),
(32, 'img-32', 'images/bridal/img-32.png', 3000),
(33, 'img-33', 'images/bridal/img-33.png', 800),
(34, 'img-34', 'images/bridal/img-34.png', 1500),
(35, 'img-35', 'images/bridal/img-35.png', 1000),
(36, 'img-36', 'images/bridal/img-36.png', 1000),
(37, 'img-37', 'images/bridal/img-37.png', 1200),
(38, 'img-38', 'images/bridal/img-38.png', 900),
(39, 'img-39', 'images/bridal/img-39.png', 1000),
(40, 'img-40', 'images/bridal/img-40.png', 2000),
(41, 'img-41', 'images/bridal/img-41.png', 1000),
(42, 'img-42', 'images/bridal/img-42.png', 1500),
(43, 'img-43', 'images/bridal/img-43.png', 1000),
(44, 'img-44', 'images/bridal/img-44.png', 2000),
(45, 'img-45', 'images/bridal/img-45.png', 2000),
(46, 'img-46', 'images/bridal/img-46.png', 2500),
(47, 'img-47', 'images/bridal/img-47.png', 1000),
(48, 'img-48', 'images/bridal/img-48.png', 1000),
(49, 'img-49', 'images/bridal/img-49.png', 1500),
(50, 'img-50', 'images/bridal/img-50.png', 1000),
(51, 'img-51', 'images/bridal/img-51.png', 2000),
(52, 'img-52', 'images/bridal/img-52.png', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `kankupagla_images`
--

CREATE TABLE `kankupagla_images` (
  `id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kankupagla_images`
--

INSERT INTO `kankupagla_images` (`id`, `image_name`, `image_path`, `price`) VALUES
(1, 'img-1', 'images/kankupagla/img-1.png', 250),
(2, 'img-2', 'images/kankupagla/img-2.png', 150),
(3, 'img-3', 'images/kankupagla/img-3.png', 150),
(4, 'img-4', 'images/kankupagla/img-4.png', 200),
(5, 'img-5', 'images/kankupagla/img-5.png', 150),
(6, 'img-6', 'images/kankupagla/img-6.png', 200),
(7, 'img-7', 'images/kankupagla/img-7.png', 250),
(8, 'img-8', 'images/kankupagla/img-8.png', 100),
(9, 'img-9', 'images/kankupagla/img-9.png', 150),
(10, 'img-10', 'images/kankupagla/img-10.png', 200),
(11, 'img-11', 'images/kankupagla/img-11.png', 150),
(12, 'img-12', 'images/kankupagla/img-12.png', 150),
(13, 'img-13', 'images/kankupagla/img-13.png', 300),
(14, 'img-14', 'images/kankupagla/img-14.png', 100),
(15, 'img-15', 'images/kankupagla/img-15.png', 100),
(16, 'img-16', 'images/kankupagla/img-16.png', 350),
(17, 'img-17', 'images/kankupagla/img-17.png', 300),
(18, 'img-18', 'images/kankupagla/img-18.png', 250),
(19, 'img-19', 'images/kankupagla/img-19.png', 300),
(20, 'img-20', 'images/kankupagla/img-20.png', 250),
(21, 'img-21', 'images/kankupagla/img-21.png', 350),
(22, 'img-22', 'images/kankupagla/img-22.png', 350),
(23, 'img-23', 'images/kankupagla/img-23.png', 300),
(24, 'img-24', 'images/kankupagla/img-24.png', 300),
(25, 'img-25', 'images/kankupagla/img-25.png', 300),
(26, 'img-26', 'images/kankupagla/img-26.png', 200),
(27, 'img-27', 'images/kankupagla/img-27.png', 250),
(28, 'img-28', 'images/kankupagla/img-28.png', 350),
(29, 'img-29', 'images/kankupagla/img-29.png', 150),
(30, 'img-30', 'images/kankupagla/img-30.png', 100),
(31, 'img-31', 'images/kankupagla/img-31.png', 300),
(32, 'img-32', 'images/kankupagla/img-32.png', 350),
(33, 'img-33', 'images/kankupagla/img-33.png', 400),
(34, 'img-34', 'images/kankupagla/img-34.png', 350),
(35, 'img-35', 'images/kankupagla/img-35.png', 300),
(36, 'img-36', 'images/kankupagla/img-36.png', 100),
(37, 'img-37', 'images/kankupagla/img-37.png', 350),
(38, 'img-38', 'images/kankupagla/img-38.png', 400),
(39, 'img-39', 'images/kankupagla/img-39.png', 150),
(40, 'img-40', 'images/kankupagla/img-40.png', 350),
(41, 'img-41', 'images/kankupagla/img-41.png', 300),
(42, 'img-42', 'images/kankupagla/img-42.png', 300),
(43, 'img-43', 'images/kankupagla/img-43.png', 100),
(44, 'img-44', 'images/kankupagla/img-44.png', 150),
(45, 'img-45', 'images/kankupagla/img-45.png', 100),
(46, 'img-46', 'images/kankupagla/img-46.png', 150),
(47, 'img-47', 'images/kankupagla/img-47.png', 300),
(48, 'img-48', 'images/kankupagla/img-48.png', 250),
(49, 'img-49', 'images/kankupagla/img-49.png', 200),
(50, 'img-50', 'images/kankupagla/img-50.png', 350),
(51, 'img-51', 'images/kankupagla/img-51.png', 150),
(52, 'img-52', 'images/kankupagla/img-52.png', 100),
(53, 'img-53', 'images/kankupagla/img-53.png', 150),
(54, 'img-54', 'images/kankupagla/img-54.png', 150),
(55, 'img-55', 'images/kankupagla/img-55.png', 150),
(56, 'img-56', 'images/kankupagla/img-56.png', 250),
(57, 'img-57', 'images/kankupagla/img-57.png', 200),
(58, 'img-58', 'images/kankupagla/img-58.png', 250),
(59, 'img-59', 'images/kankupagla/img-59.png', 150),
(60, 'img-60', 'images/kankupagla/img-60.png', 150),
(61, 'img-61', 'images/kankupagla/img-61.png', 150),
(62, 'img-62', 'images/kankupagla/img-62.png', 250),
(63, 'img-63', 'images/kankupagla/img-63.png', 100),
(64, 'img-64', 'images/kankupagla/img-64.png', 300),
(65, 'img-65', 'images/kankupagla/img-65.png', 200),
(66, 'img-66', 'images/kankupagla/img-66.png', 250),
(67, 'img-67', 'images/kankupagla/img-67.png', 150),
(68, 'img-68', 'images/kankupagla/img-68.png', 150),
(69, 'img-69', 'images/kankupagla/img-69.png', 100),
(70, 'img-70', 'images/kankupagla/img-70.png', 150),
(71, 'img-71', 'images/kankupagla/img-71.png', 250),
(72, 'img-72', 'images/kankupagla/img-72.png', 200),
(73, 'img-73', 'images/kankupagla/img-73.png', 200),
(74, 'img-74', 'images/kankupagla/img-74.png', 150),
(75, 'img-75', 'images/kankupagla/img-75.png', 150),
(76, 'img-76', 'images/kankupagla/img-76.png', 50),
(77, 'img-77', 'images/kankupagla/img-77.png', 100),
(78, 'img-78', 'images/kankupagla/img-78.png', 150),
(79, 'img-79', 'images/kankupagla/img-79.png', 300),
(80, 'img-80', 'images/kankupagla/img-80.png', 200),
(81, 'img-81', 'images/kankupagla/img-81.png', 350),
(82, 'img-82', 'images/kankupagla/img-82.png', 350),
(83, 'img-83', 'images/kankupagla/img-83.png', 150),
(84, 'img-84', 'images/kankupagla/img-84.png', 150),
(85, 'img-85', 'images/kankupagla/img-85.png', 150),
(86, 'img-86', 'images/kankupagla/img-86.png', 200),
(87, 'img-87', 'images/kankupagla/img-87.png', 150),
(88, 'img-88', 'images/kankupagla/img-88.png', 300),
(89, 'img-89', 'images/kankupagla/img-89.png', 150),
(90, 'img-90', 'images/kankupagla/img-90.png', 200),
(91, 'img-91', 'images/kankupagla/img-91.png', 150),
(92, 'img-92', 'images/kankupagla/img-92.png', 150),
(93, 'img-93', 'images/kankupagla/img-93.png', 150),
(94, 'img-94', 'images/kankupagla/img-94.png', 150),
(95, 'img-95', 'images/kankupagla/img-95.png', 100),
(96, 'img-96', 'images/kankupagla/img-96.png', 100),
(97, 'img-97', 'images/kankupagla/img-97.png', 200),
(98, 'img-98', 'images/kankupagla/img-98.png', 100),
(99, 'img-99', 'images/kankupagla/img-99.png', 150),
(100, 'img-100', 'images/kankupagla/img-100.png', 350);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(10) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `package_description` varchar(1000) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `package_name`, `package_description`, `image`, `price`) VALUES
(1, 'Traditional Bridal Mehndi Package', '- Includes intricate designs covering both hands \r\n  and feet.\r\n- Designs are traditional and often include \r\n  motifs like paisleys, peacocks, and floral \r\n  patterns.\r\n- Customization based on the bride\'s preferences \r\n  and the cultural significance of Mehndi.', 'images/index/package-1.png', 5000),
(2, 'Guest Mehndi Package', '- Designed for guests attending weddings or \r\n  parties.\r\n- Features simpler designs compared to bridal \r\n  Mehndi.\r\n- Applied on hands and sometimes feet.', 'images/index/package-2.png', 600),
(3, 'Simple Mehndi Package', '- Basic designs suitable for smaller events or \r\n  casual gatherings.\r\n- Focuses on minimalistic patterns such as Arabic \r\n  motifs or simple floral designs.\r\n- Applied on hands only.', 'images/index/package-3.png', 200),
(4, 'Special Occasion Mehndi Package', '- Customized for celebrations like birthdays, baby \r\n  showers, or festivals.\r\n- Designs are festive and thematic, tailored to \r\n  match the occasion.\r\n- Can include personalized elements or symbols \r\n  relevant to the event.\r\n', 'images/index/package-4.png', 500),
(5, 'Destination Wedding Mehndi Package', '- Specifically tailored for weddings held at \r\n  destination venues.\r\n- Includes travel costs for the Mehndi artist.\r\n- Designs can vary from traditional to \r\n  contemporary based on the couple\'s preferences.', 'images/index/package-5.png', 4000),
(6, 'Magic Party Package', '- Suitable for groups of friends or family \r\n  organizing a Mehndi party.\r\n- Offers discounted rates per person compared to \r\n  individual bookings.\r\n- Designs are typically simpler to accommodate \r\n  multiple guests within a specified time frame.', 'images/index/package-6.png\r\n', 100);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `username`, `password`, `address`, `created_at`) VALUES
(1, 'vanshi', 'vanshiDepani@gmail.com', '9688746578', 'shivanya', '$2y$10$67OHtIfwJc9SnjY3l8Rjbe2PWfAPkGU4uFuQImHeyHcJBuZ6jU0NO', 'applewood', '2024-09-03 12:05:15'),
(15, 'kritika kapoor', 'kritika@gmail.com', '9277932889', 'kritu', '$2y$10$9iqYtQM9i3R04rigup1TLO1arVJHR6EyYN/YE3VEU75WSdey2vOd.', 'mumbai', '2024-09-30 02:30:35');

-- --------------------------------------------------------

--
-- Table structure for table `western_images`
--

CREATE TABLE `western_images` (
  `id` int(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `western_images`
--

INSERT INTO `western_images` (`id`, `image_name`, `image_path`, `price`) VALUES
(1, 'img-1', 'images/western/img-1.png', 400),
(2, 'img-2', 'images/western/img-2.png', 250),
(3, 'img-3', 'images/western/img-3.png', 450),
(4, 'img-4', 'images/western/img-4.png', 400),
(5, 'img-5', 'images/western/img-5.png', 450),
(6, 'img-6', 'images/western/img-6.png', 350),
(7, 'img-7', 'images/western/img-7.png', 350),
(8, 'img-8', 'images/western/img-8.png', 400),
(9, 'img-9', 'images/western/img-9.png', 300),
(10, 'img-10', 'images/western/img-10.png', 350),
(11, 'img-11', 'images/western/img-11.png', 400),
(12, 'img-12', 'images/western/img-12.png', 350),
(13, 'img-13', 'images/western/img-13.png', 350),
(14, 'img-14', 'images/western/img-14.png', 300),
(15, 'img-15', 'images/western/img-15.png', 450),
(16, 'img-16', 'images/western/img-16.png', 350),
(17, 'img-17', 'images/western/img-17.png', 400),
(18, 'img-18', 'images/western/img-18.png', 600),
(19, 'img-19', 'images/western/img-19.png', 300),
(20, 'img-20', 'images/western/img-20.png', 300),
(21, 'img-21', 'images/western/img-21.png', 450),
(22, 'img-22', 'images/western/img-22.png', 350),
(23, 'img-23', 'images/western/img-23.png', 450),
(24, 'img-24', 'images/western/img-24.png', 350),
(25, 'img-25', 'images/western/img-25.png', 400),
(26, 'img-26', 'images/western/img-26.png', 450),
(27, 'img-27', 'images/western/img-27.png', 400),
(28, 'img-28', 'images/western/img-28.png', 200),
(29, 'img-29', 'images/western/img-29.png', 200),
(30, 'img-30', 'images/western/img-30.png', 200),
(31, 'img-31', 'images/western/img-31.png', 150),
(32, 'img-32', 'images/western/img-32.png', 200),
(33, 'img-33', 'images/western/img-33.png', 150),
(34, 'img-34', 'images/western/img-34.png', 150),
(35, 'img-35', 'images/western/img-35.png', 150),
(36, 'img-36', 'images/western/img-36.png', 350),
(37, 'img-37', 'images/western/img-37.png', 250),
(38, 'img-38', 'images/western/img-38.png', 300),
(39, 'img-39', 'images/western/img-39.png', 400),
(40, 'img-40', 'images/western/img-40.png', 200),
(41, 'img-41', 'images/western/img-41.png', 200),
(42, 'img-42', 'images/western/img-42.png', 400),
(43, 'img-43', 'images/western/img-43.png', 150),
(44, 'img-44', 'images/western/img-44.png', 300),
(45, 'img-45 ', 'images/western/img-45.png', 250),
(46, 'img-46', 'images/western/img-46.png', 150),
(47, 'img-47', 'images/western/img-47.png', 200),
(48, 'img-48', 'images/western/img-48.png', 450);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `appointment_images`
--
ALTER TABLE `appointment_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_appointment_id` (`appointment_id`);

--
-- Indexes for table `arabic_images`
--
ALTER TABLE `arabic_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `babyshower_images`
--
ALTER TABLE `babyshower_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bridal_images`
--
ALTER TABLE `bridal_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kankupagla_images`
--
ALTER TABLE `kankupagla_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `western_images`
--
ALTER TABLE `western_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `appointment_images`
--
ALTER TABLE `appointment_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `arabic_images`
--
ALTER TABLE `arabic_images`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `babyshower_images`
--
ALTER TABLE `babyshower_images`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `bridal_images`
--
ALTER TABLE `bridal_images`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `kankupagla_images`
--
ALTER TABLE `kankupagla_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `western_images`
--
ALTER TABLE `western_images`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment_images`
--
ALTER TABLE `appointment_images`
  ADD CONSTRAINT `fk_appointment_images_appointment` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`appointment_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
