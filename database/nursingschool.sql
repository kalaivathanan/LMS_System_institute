-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2024 at 03:27 PM
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
-- Database: `nursingschool`
--

-- --------------------------------------------------------

--
-- Table structure for table `acadamiccalenders`
--

CREATE TABLE `acadamiccalenders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `batch` varchar(255) NOT NULL,
  `lessoncontent` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `slotsize` double NOT NULL,
  `uid` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'not conducted',
  `color` varchar(255) NOT NULL,
  `allday` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `teacherid` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `acadamiccalenders`
--

INSERT INTO `acadamiccalenders` (`id`, `subject`, `batch`, `lessoncontent`, `start`, `end`, `slotsize`, `uid`, `status`, `color`, `allday`, `created_at`, `updated_at`, `teacherid`) VALUES
(33, '9', '2', 'not set', '2023-11-20 07:00:00', '2023-11-20 07:30:00', 0.5, 1, 'Not Conducted', '#3d9970', 1, '2023-11-20 22:58:59', '2023-11-20 22:58:59', NULL),
(34, '2', '2', 'not set', '2023-12-03 06:30:00', '2023-12-03 07:00:00', 0.5, 1, 'Not Conducted', '#ff4136', 1, '2023-12-08 21:27:15', '2023-12-08 21:27:15', NULL),
(35, '3', '2', 'not set', '2024-01-18 06:30:00', '2024-01-18 07:00:00', 0.5, 1, 'Not Conducted', '#ff4136', 1, '2023-12-08 21:27:16', '2024-01-13 12:44:15', 2),
(36, '2', '2', 'not set', '2024-01-08 07:00:00', '2024-01-08 07:30:00', 0.5, 1, 'Not Conducted', '#ff4136', 1, '2024-01-10 08:55:19', '2024-01-10 08:55:19', NULL),
(37, '2', '2', 'not set', '2024-01-09 07:00:00', '2024-01-09 07:30:00', 0.5, 1, 'Not Conducted', '#ff4136', 1, '2024-01-13 12:14:23', '2024-01-13 12:14:23', NULL),
(38, '1', '2', 'not set', '2024-01-11 07:30:00', '2024-01-11 08:00:00', 0.5, 1, 'Not Conducted', '#0074d9', 1, '2024-01-13 12:24:45', '2024-01-13 12:24:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `ininame` varchar(255) NOT NULL,
  `nic` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `paddress` varchar(255) NOT NULL,
  `raddress` varchar(255) DEFAULT NULL,
  `hphone` varchar(255) NOT NULL,
  `mphone` varchar(255) NOT NULL,
  `wphone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `batchid` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'applied'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `fullname`, `ininame`, `nic`, `dob`, `gender`, `paddress`, `raddress`, `hphone`, `mphone`, `wphone`, `email`, `created_at`, `updated_at`, `batchid`, `status`) VALUES
(2, 'prasith', 'dddd', '198321903550', '1977-07-09', 'Male', 'kaluwalla galle', 'ambalangoda', '0123456789', '0123456789', '0123456789', 'prasith@gmail.com', '2023-09-19 23:43:44', '2023-09-19 23:48:11', 4, 'Registered'),
(13, 'chamidu', 'k.t.c.d. de silva', '790890132V', '1970-01-01', 'Female', 'ambalangoda', 'ambalangoda www', '0123456789', '0123456780', '0123456780', 'chamidu49@yahoo.com', '2023-08-31 00:18:39', '2023-08-31 00:18:39', 2, 'applied');

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coursecode` varchar(255) NOT NULL,
  `realcourseid` bigint(20) UNSIGNED NOT NULL,
  `fee` double NOT NULL,
  `startdate` varchar(255) DEFAULT NULL,
  `installment` varchar(255) NOT NULL DEFAULT '1',
  `daysperweek` varchar(255) NOT NULL DEFAULT '5',
  `duration` varchar(255) NOT NULL,
  `public` varchar(255) NOT NULL,
  `basepayment` double NOT NULL,
  `regFee` double NOT NULL DEFAULT 0,
  `batchstatus` varchar(255) NOT NULL DEFAULT 'on goin',
  `enddate` varchar(255) DEFAULT NULL,
  `lockdate` varchar(255) DEFAULT NULL,
  `createdby` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `center` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`id`, `coursecode`, `realcourseid`, `fee`, `startdate`, `installment`, `daysperweek`, `duration`, `public`, `basepayment`, `regFee`, `batchstatus`, `enddate`, `lockdate`, `createdby`, `created_at`, `updated_at`, `center`) VALUES
(2, 'd12', 3, 25000, NULL, '2', '5', '45', 'Fulltime', 5000, 1000, 'not started', NULL, NULL, '1', '2023-09-01 09:29:32', '2023-09-01 09:29:32', 1),
(4, 'eta04', 2, 8000, NULL, '2', '5', '45', 'Fulltime', 5000, 1000, 'not started', NULL, NULL, '1', '2023-09-18 10:10:31', '2023-09-18 10:10:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `batchsubjects`
--

CREATE TABLE `batchsubjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `hours` int(11) NOT NULL,
  `courseid` bigint(20) UNSIGNED NOT NULL,
  `batchid` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `teacherid` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batchsubjects`
--

INSERT INTO `batchsubjects` (`id`, `code`, `name`, `hours`, `courseid`, `batchid`, `created_at`, `updated_at`, `color`, `teacherid`, `status`) VALUES
(1, 'iusto', 'Quos dicta eveniet maxime velit.', 0, 3, 2, '2023-09-01 09:29:32', '2024-01-13 11:42:10', '#0074D9', 2, 'active'),
(2, 'unde', 'Ipsum commodi itaque eius velit rerum qui ratione.', 87, 3, 2, '2023-09-01 09:29:33', '2024-01-13 11:43:00', '#FF4136', 4, 'active'),
(3, 'dolor', 'Aut dolores et tenetur in porro laudantium officiis.', 57, 3, 2, '2023-09-01 09:29:33', '2024-01-13 12:44:15', '#2ECC40', 2, 'active'),
(4, 'aut', 'Quidem et quam ut ipsam rerum eum veritatis.', 8, 3, 2, '2023-09-01 09:29:33', '2023-09-01 09:29:33', '#FF851B', NULL, 'active'),
(5, 'tenetur', 'Consequatur et quasi eligendi totam quasi mollitia.', 49, 3, 2, '2023-09-01 09:29:33', '2023-09-01 09:29:33', '#7FDBFF', NULL, 'active'),
(7, 'velit', 'Laborum corrupti voluptatem facere ea itaque perspiciatis.', 55, 3, 2, '2023-09-01 09:29:33', '2024-01-13 11:43:59', '#01FF70', NULL, 'inactive'),
(8, 'iusto', 'Iusto', 222, 3, 2, '2023-09-01 09:29:33', '2023-11-23 09:10:56', '#F012BE', NULL, 'inactive'),
(9, 'dfdf', 'chamidu', 23, 3, 2, '2023-09-01 09:29:33', '2023-09-01 09:29:33', '#3D9970', NULL, 'active'),
(10, 'dfdf', 'user', 323, 3, 2, '2023-09-01 09:29:33', '2023-09-01 09:29:33', '#111111', NULL, 'active'),
(25, 'corporis', 'Et exercitationem dicta doloremque earum.', 32, 3, 2, '2023-09-01 09:29:33', '2023-09-01 09:29:33', '#B10DC9', NULL, 'active'),
(36, 'gfg', 'fgsd', 34, 2, 4, '2023-09-18 10:10:31', '2023-09-18 10:10:31', '#0074D9', 3, 'active'),
(37, 'dfdf', '20Syringersss', 433, 2, 4, '2023-09-18 10:10:31', '2023-09-18 10:10:31', '#FF4136', 4, 'active'),
(38, 'uuiu', 'tyt', 344, 2, 4, '2023-09-18 10:10:31', '2023-09-18 10:10:31', '#2ECC40', 5, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `centers`
--

CREATE TABLE `centers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `centername` varchar(255) NOT NULL,
  `centercode` varchar(45) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `managerid` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `centers`
--

INSERT INTO `centers` (`id`, `centername`, `centercode`, `address`, `phone`, `fax`, `email`, `status`, `managerid`, `created_at`, `updated_at`) VALUES
(1, 'galle', 'g', NULL, NULL, NULL, NULL, 'active', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coursemodels`
--

CREATE TABLE `coursemodels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `nortionlHours` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `createdby` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coursemodels`
--

INSERT INTO `coursemodels` (`id`, `code`, `name`, `description`, `type`, `nortionlHours`, `status`, `createdby`, `created_at`, `updated_at`) VALUES
(1, 'etb11', 'ict l5', 'ICT L5', 'Fulltime', '44', 'active', '1', '2023-02-15 06:16:57', '2023-02-15 06:16:57'),
(2, 'eta04', 'tcL5', 'Telecommunication technology', 'Fulltime', '720', 'active', '1', '2023-02-15 16:10:23', '2023-02-15 16:10:23'),
(3, 'd12', 'dddd', 'dd', 'Fulltime', '720', 'active', '1', '2023-03-20 10:25:35', '2023-03-20 10:25:35'),
(4, 'MIT', 'MIT', 'Msc in it', 'Fulltime', '790', 'active', '1', '2023-05-09 11:22:43', '2023-05-09 11:22:43'),
(5, 'M001', 'Master of Information Technology', 'Master degree program in IT', 'Fulltime', '1400', 'active', '1', '2023-08-25 14:57:32', '2023-08-25 14:57:32'),
(6, 'A001', 'abc', 'dfd', 'Fulltime', '790', 'active', '1', NULL, NULL),
(7, 'B34', 'fdfd', 'rtr', 'Fulltime', '790', 'active', '1', NULL, NULL),
(8, 'f34', 'dfre', 'rtr', 'Fulltime', '790', 'active', '1', NULL, NULL),
(9, 't45', 'fgfge', 'gg', 'Fulltime', '790', 'active', '1', NULL, NULL),
(10, 'r67', 'hhh', 'eee', 'active', '456', 'active', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coursesubjects`
--

CREATE TABLE `coursesubjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `hours` int(11) NOT NULL,
  `courseid` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coursesubjects`
--

INSERT INTO `coursesubjects` (`id`, `code`, `name`, `hours`, `courseid`, `created_at`, `updated_at`) VALUES
(4, 'ullam', 'Rerum itaque neque eum minima.', 22, 8, '2023-08-28 09:29:08', '2023-08-28 09:29:08'),
(8, 'porro', 'Et quaerat consequuntur sequi est voluptatem.', 67, 4, '2023-08-28 09:30:43', '2023-08-28 09:30:43'),
(10, 'iusto', 'Quos dicta eveniet maxime velit.', 0, 3, '2023-08-28 09:30:43', '2023-08-28 09:30:43'),
(23, 'unde', 'Ipsum commodi itaque eius velit rerum qui ratione.', 87, 3, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(24, 'dolor', 'Aut dolores et tenetur in porro laudantium officiis.', 57, 3, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(25, 'aut', 'Quidem et quam ut ipsam rerum eum veritatis.', 8, 3, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(26, 'tenetur', 'Consequatur et quasi eligendi totam quasi mollitia.', 49, 3, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(28, 'corporis', 'Et exercitationem dicta doloremque earum.', 32, 3, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(30, 'velit', 'Laborum corrupti voluptatem facere ea itaque perspiciatis.', 55, 3, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(32, 'enim', 'Laboriosam voluptas non qui placeat.', 5, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(34, 'est', 'Rerum delectus in iste nobis nihil hic voluptatibus.', 22, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(35, 'debitis', 'In eaque voluptas officia ipsam voluptate adipisci.', 14, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(36, 'perspiciatis', 'Quis ut possimus vel et odit corporis sed.', 14, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(38, 'consequatur', 'Ab possimus voluptas magni.', 87, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(42, 'quam', 'Est voluptatibus ea eos harum.', 16, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(43, 'occaecati', 'In vitae occaecati est odit possimus voluptatem.', 93, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(44, 'ut', 'Doloribus libero autem maiores aspernatur recusandae adipisci.', 38, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(46, 'nihil', 'Doloremque sit rem ratione vitae saepe facilis soluta.', 40, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(47, 'aliquid', 'Optio voluptas ut voluptates et omnis consequuntur sequi officia.', 92, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(48, 'delectus', 'Similique illo velit facere molestiae tempore sunt.', 79, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(49, 'quisquam', 'Nisi eos molestias odit minima ut eius.', 46, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(50, 'corrupti', 'Ullam repudiandae voluptatem perspiciatis nemo exercitationem eos.', 64, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(51, 'laudantium', 'Est corporis corporis quas ut iure dolore.', 71, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(52, 'beatae', 'Iste cumque maxime delectus ipsa iste vel error.', 87, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(54, 'possimus', 'Inventore voluptas et sapiente temporibus reiciendis.', 34, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(57, 'ipsam', 'Repellendus atque et dolorum quibusdam.', 8, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(63, 'blanditiis', 'Voluptas corporis eaque ad eaque.', 78, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(65, 'pariatur', 'Vel non tempore animi vel.', 56, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(66, 'asperiores', 'Provident ex reiciendis iste molestiae enim.', 1, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(67, 'saepe', 'Et tempora aliquid iusto molestiae.', 46, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(68, 'tempore', 'Eveniet quisquam necessitatibus at modi consequatur.', 93, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(69, 'nemo', 'Asperiores error voluptatem id voluptate.', 75, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(70, 'culpa', 'Modi tempora unde quo dolore consequuntur.', 51, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(71, 'impedit', 'Pariatur esse temporibus nesciunt eveniet quasi ut.', 60, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(72, 'magni', 'Rerum quibusdam qui qui eveniet et dolorem.', 46, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(73, 'sit', 'Nihil vel odio molestias atque iste quam.', 89, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(74, 'esse', 'Sint consequatur eum eum distinctio ducimus deserunt sint.', 35, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(75, 'dolore', 'Rerum sit repellat aut sint eveniet sit vel rerum.', 96, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(76, 'doloremque', 'Sapiente cum soluta quis vero.', 37, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(77, 'vero', 'Facere doloribus aut qui officiis.', 24, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(78, 'praesentium', 'Quas a dolore vitae magnam odit.', 3, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(79, 'amet', 'Sit aperiam consequatur explicabo.', 86, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(80, 'natus', 'Suscipit blanditiis vel reprehenderit id consequuntur tempora maiores.', 51, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(81, 'facilis', 'Ut quia nihil accusamus aut molestias et.', 59, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(82, 'dolores', 'Ut sit et est et et quisquam aut.', 43, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(83, 'excepturi', 'Commodi neque quam aut facilis ducimus.', 12, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(84, 'ullam', 'Id ratione quia quo cum et corrupti.', 97, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(85, 'quod', 'Ullam sint iure nisi adipisci.', 9, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(86, 'ab', 'Quibusdam explicabo qui cupiditate harum recusandae est.', 41, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(87, 'numquam', 'Quis ut debitis pariatur omnis provident.', 36, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(88, 'inventore', 'Aliquam minus voluptas sed quibusdam.', 44, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(89, 'dolorem', 'Et omnis et commodi rem error doloremque.', 70, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(90, 'quae', 'Et repellat autem voluptatem culpa exercitationem at.', 19, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(91, 'molestiae', 'Inventore omnis ullam molestias tempore et quia.', 58, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(92, 'minima', 'Repellendus est voluptate sed aut et molestias.', 0, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(93, 'nam', 'Dolores est voluptatum dolor quia sint dignissimos iure dignissimos.', 91, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(94, 'incidunt', 'Tempora consequatur consectetur earum sit occaecati error.', 60, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(95, 'atque', 'Quae et aut quia accusamus.', 70, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(96, 'reiciendis', 'Aut fugit voluptates et consequuntur.', 31, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(97, 'id', 'Saepe vel quasi dolor cum molestiae.', 76, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(98, 'quia', 'Iure nobis minima eveniet distinctio ut aliquid ex officia.', 86, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(99, 'dicta', 'Est asperiores rerum necessitatibus magni.', 91, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(100, 'optio', 'Quia aut ut nulla eius.', 88, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(101, 'cum', 'Praesentium quos delectus possimus est eaque asperiores.', 97, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(102, 'animi', 'Velit illo nihil nihil voluptas occaecati voluptatem.', 27, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(103, 'eos', 'Est quo non deserunt quibusdam alias quidem.', 2, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(104, 'nisi', 'Quos sed rerum sit sit dolorem labore.', 97, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(105, 'quos', 'Itaque ut optio earum et.', 4, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(106, 'odio', 'Velit a reprehenderit ab a.', 85, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(107, 'iusto', 'Nulla repudiandae et tenetur voluptatem autem deleniti in.', 33, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(108, 'temporibus', 'Assumenda velit maxime occaecati quia suscipit.', 24, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(109, 'odit', 'Voluptas asperiores culpa reiciendis eaque.', 28, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(110, 'deleniti', 'Maxime perspiciatis est velit aperiam atque autem.', 15, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(111, 'sed', 'Et laboriosam reiciendis ipsa officia eos.', 19, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(112, 'a', 'Quidem nisi dignissimos molestiae quae veniam blanditiis quisquam quis.', 71, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(113, 'provident', 'Quae vitae provident voluptatem quasi dolorum quam doloribus.', 25, 1, '2023-08-28 09:33:07', '2023-08-28 09:33:07'),
(114, 'gfg', 'fgsd', 34, 2, '2023-08-28 16:59:27', '2023-08-28 16:59:27'),
(115, 'iusto', 'Iusto', 222, 3, '2023-08-28 17:12:39', '2023-08-28 17:12:39'),
(116, 'dfdf', '20Syringersss', 433, 2, '2023-08-28 17:13:24', '2023-08-28 17:13:24'),
(117, 'uuiu', 'tyt', 344, 2, '2023-08-28 17:14:40', '2023-08-28 17:14:40'),
(118, 'dfdf', 'chamidu', 23, 3, '2023-08-29 01:20:19', '2023-08-29 01:20:19'),
(119, 'dfdf', 'user', 323, 3, '2023-08-29 02:49:41', '2023-08-29 02:49:41'),
(120, 'dfdf', 'hasantha', 454, 5, '2023-08-29 02:51:25', '2023-08-29 02:51:25'),
(121, '222', 'chamidubbbbbbbbbbbbbb', 45, 10, '2023-09-24 14:13:40', '2023-09-24 14:13:40');

-- --------------------------------------------------------

--
-- Table structure for table `doc_types`
--

CREATE TABLE `doc_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctype` varchar(255) NOT NULL,
  `Desc` varchar(255) DEFAULT NULL,
  `active` varchar(255) NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doc_types`
--

INSERT INTO `doc_types` (`id`, `doctype`, `Desc`, `active`, `created_at`, `updated_at`) VALUES
(1, 'photo', 'Three Photo', 'yes', NULL, NULL),
(2, 'medical', NULL, 'no', NULL, NULL),
(3, 'birth certificate', NULL, 'no', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `uid` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `allday` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `type`, `start`, `end`, `uid`, `color`, `allday`, `created_at`, `updated_at`) VALUES
(1, 'cvcv', 'Trial', '2023-05-10 20:22:00', '2023-05-10 20:22:00', 84, '#000000', 0, '2023-05-09 09:22:51', '2023-05-09 09:22:51'),
(2, 'Registration Fee Due', 'payment', '2023-05-07 00:00:00', '2023-05-07 00:00:00', 84, '#FF0000', 1, NULL, NULL),
(3, 'dsdsd', 'Trial', '2023-05-09 20:38:00', '2023-05-09 23:30:00', 84, '#000000', 1, '2023-05-09 09:39:02', '2023-05-09 09:39:02'),
(4, 'cvcv55', 'Trial', '2023-08-22 20:51:00', '2023-08-25 20:51:00', 82, '#000000', 1, '2023-08-22 09:52:14', '2023-08-22 09:52:14'),
(5, 'vbvb', 'Trial', '2023-08-22 20:52:00', '2023-08-22 21:52:00', 82, '#000000', 1, '2023-08-22 09:53:08', '2023-08-22 09:53:08'),
(6, 'aaa', 'Trial', '2023-08-22 20:54:00', '2023-08-22 22:55:00', 82, '#000000', 1, '2023-08-22 09:54:33', '2023-08-22 09:54:33'),
(7, 'vcvc', 'Trial', '2023-08-31 12:13:00', '2023-08-31 14:01:00', 1, '#000000', 1, '2023-08-31 04:13:37', '2023-09-01 02:43:52'),
(8, 'dbms', 'Trial', '2023-08-31 16:00:00', '2023-08-31 16:30:00', 1, 'hsl(70 , 70%, 50%)', 1, '2023-08-31 07:02:46', '2023-09-01 02:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `regno` varchar(255) NOT NULL,
  `jobtype` varchar(255) NOT NULL,
  `regdate` datetime NOT NULL,
  `amount` decimal(9,2) NOT NULL,
  `examdate` datetime DEFAULT NULL,
  `examstatus` varchar(255) NOT NULL DEFAULT 'Pending',
  `lpermitno` varchar(255) DEFAULT NULL,
  `lpermitdate` datetime DEFAULT NULL,
  `lpermitexp` datetime DEFAULT NULL,
  `trialdate` datetime DEFAULT NULL,
  `jobstatus` varchar(255) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `regno`, `jobtype`, `regdate`, `amount`, `examdate`, `examstatus`, `lpermitno`, `lpermitdate`, `lpermitexp`, `trialdate`, `jobstatus`, `created_at`, `updated_at`, `uid`) VALUES
(1, 'A001', 'New', '2020-05-25 00:00:00', 8000.00, '2020-06-23 00:00:00', 'Pass', '1213232', '2020-06-26 00:00:00', '2020-09-23 00:00:00', '2020-06-22 00:00:00', 'Pending', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_docs`
--

CREATE TABLE `job_docs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `regno` varchar(255) NOT NULL,
  `docid` bigint(20) NOT NULL,
  `sn` varchar(255) NOT NULL,
  `recived` date DEFAULT NULL,
  `issued` date DEFAULT NULL,
  `expired` date DEFAULT NULL,
  `isrecieved` varchar(255) NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_docs`
--

INSERT INTO `job_docs` (`id`, `regno`, `docid`, `sn`, `recived`, `issued`, `expired`, `isrecieved`, `created_at`, `updated_at`) VALUES
(1, 'A001', 1, 'A009', '2020-02-02', NULL, NULL, 'Yes', NULL, NULL),
(2, 'A001', 2, 'B1223', '2022-05-06', NULL, NULL, 'Yes', NULL, NULL),
(3, 'A001', 3, '9056', '2022-05-07', NULL, NULL, 'Yes', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(17, '2014_10_12_100000_create_password_resets_table', 2),
(18, '2018_08_08_100000_create_telescope_entries_table', 2),
(19, '2019_08_19_000000_create_failed_jobs_table', 2),
(20, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(21, '2023_01_15_122514_create_people_table', 2),
(22, '2023_01_15_172211_create_jobs_table', 2),
(23, '2023_01_16_123629_create_doc_types_table', 2),
(24, '2023_01_16_124031_create_job_docs_table', 2),
(25, '2023_01_20_000435_create_events_table', 2),
(26, '2023_01_29_155307_create_coursemodels_table', 3),
(27, '2023_02_13_003730_create_applicants_table', 3),
(28, '2023_02_13_201026_create_batches_table', 3),
(29, '2023_02_13_201917_add_batchid_to_applicants_table', 3),
(30, '2023_02_14_070148_create_centers_table', 3),
(32, '2014_10_12_000000_create_users_table', 4),
(33, '2023_02_15_125103_addcenter_to_user', 5),
(43, '2023_02_19_114015_add_status_to_applicant', 5),
(44, '2023_02_20_075343_create_student_models_table', 6),
(45, '2023_02_20_080531_create_student_payments_models_table', 6),
(46, '2023_02_22_223328_add_center_foreign_key_to_batch_table', 7),
(47, '2023_03_16_152605_add_center_to_student_model_table', 8),
(48, '2023_03_17_215754_add_designation_to_users_table', 9),
(49, '2023_03_17_233608_create_permission_tables', 10),
(50, '2023_08_25_212858_create_coursesubjects_table', 11),
(51, '2023_08_29_103449_create_batchsubjects_table', 12),
(52, '2023_08_30_110535_create_batch_table', 13),
(54, '2023_09_01_033643_create_acadamiccalenders_table', 14),
(55, '2023_09_01_104447_add_color_to_batchsubjects_table', 15),
(57, '2023_09_20_152022_add_status_to_people_table', 16),
(60, '2023_09_24_194201_create_subject_teacher_table', 17),
(61, '2023_09_24_200022_add_teacher_id_to_acadamiccalenders', 17),
(62, '2023_11_21_043641_add_teacher_id_to_batchsubjects', 18),
(63, '2023_11_23_130116_add_status_to_batchsubjects', 19);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(4, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(6, 'App\\Models\\User', 82),
(6, 'App\\Models\\User', 83),
(6, 'App\\Models\\User', 84),
(6, 'App\\Models\\User', 85),
(6, 'App\\Models\\User', 87),
(6, 'App\\Models\\User', 90),
(7, 'App\\Models\\User', 91),
(7, 'App\\Models\\User', 92),
(7, 'App\\Models\\User', 93),
(7, 'App\\Models\\User', 95),
(7, 'App\\Models\\User', 96),
(8, 'App\\Models\\User', 1),
(8, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uid` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `ininame` varchar(255) NOT NULL,
  `regno` varchar(255) NOT NULL,
  `nic` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `paddress` varchar(255) NOT NULL,
  `raddress` varchar(255) DEFAULT NULL,
  `hphone` varchar(255) NOT NULL,
  `mphone` varchar(255) NOT NULL,
  `wphone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `catogary` varchar(255) NOT NULL DEFAULT 'Trainee',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `uid`, `fullname`, `ininame`, `regno`, `nic`, `dob`, `gender`, `paddress`, `raddress`, `hphone`, `mphone`, `wphone`, `email`, `catogary`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 'chamidu Devaka De silva', 'K. T. C. D de Silva', 'A001', '790890132V', '1979-02-24', 'male', '52 Maha Ambalangoda', '52 Maha Ambalangoda', '0712294034', '0912258511', '0712294034', 'user@home.com', 'admin', NULL, NULL, 'inactive'),
(2, 91, 'amal de', 'amal de silva', 'A001', '560890123V', '1956-03-29', 'male', 'dfdfcvcv', 'ambalngoda wwwsdsd', '0123456789', '0100456789', '0123456780', 'amal@mail.com', 'academic', '2023-09-21 09:33:51', '2023-09-23 22:55:21', 'active'),
(3, 92, 'vimal', 'k.t.c.d. de silva', 'A001', '970890132V', '1987-03-24', 'male', 'kaluwalla galle', 'fdfd', '0123456789', '0123456700', '0123456786', 'chamidu49@yahoo.com', 'academic', '2023-09-21 09:46:18', '2023-09-23 22:55:29', 'active'),
(4, 93, 'lisala', 'k.t.l.s deso;b', 'A004', '690890132V', '1979-07-04', 'male', 'dfd fgfgf', 'galle', '0123456789', '0123456733', '0123456786', 'admin@gmail.com', 'academic', '2023-09-23 20:41:15', '2023-11-23 16:49:13', 'active'),
(5, 95, 'disuls', 'dfd dfdf', 'A005', '590890132V', '1980-03-23', 'male', 'dfdf', 'ambalangoda', '0123456789', '0123456733', '3433343433', 'ueser@gmail.com', 'academic', '2023-09-23 20:43:45', '2023-11-23 16:49:24', 'active'),
(6, 96, 'sakuni', 'k.t.c.d. de silva', 'A006', '740890132V', '1984-03-23', 'female', 'kaluwalla galle', 'erer', '0123456789', '0100456789', '0123456786', 'usser@gmail.com', 'academic', '2023-09-23 22:42:50', '2023-11-23 16:49:34', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(3, 'log student', 'web', '2024-01-16 14:27:45', '2024-01-16 14:27:45'),
(4, 'mypermission', 'web', '2024-01-17 09:42:14', '2024-01-17 09:42:14');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(6, 'Student', 'web', '2024-01-16 08:47:51', '2024-01-16 08:47:51'),
(7, 'Teacher', 'web', '2024-01-17 09:17:30', '2024-01-17 09:17:30'),
(8, 'Admin', 'web', '2024-01-17 09:17:56', '2024-01-17 09:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `student_models`
--

CREATE TABLE `student_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `regNo` varchar(255) NOT NULL,
  `applicantid` bigint(20) UNSIGNED NOT NULL,
  `registerd` date DEFAULT NULL,
  `completed` date DEFAULT NULL,
  `dropout` date DEFAULT NULL,
  `dropReason` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Registered',
  `uid` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `center` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_models`
--

INSERT INTO `student_models` (`id`, `regNo`, `applicantid`, `registerd`, `completed`, `dropout`, `dropReason`, `status`, `uid`, `created_at`, `updated_at`, `center`) VALUES
(1, 'galle_d12_6_13', 13, '2023-03-20', NULL, NULL, NULL, 'Registered', 82, '2023-03-20 04:59:47', '2023-03-20 04:59:47', 1),
(2, 'galle_etb11_5_15', 15, '2023-04-05', NULL, NULL, NULL, 'Registered', 83, '2023-04-05 05:54:43', '2023-04-05 05:54:43', 1),
(3, 'galle_etb11_1_12', 12, '2023-05-09', NULL, NULL, NULL, 'Registered', 84, '2023-05-09 03:37:54', '2023-05-09 03:37:54', 1),
(4, 'galle_MIT_7_16', 16, '2023-05-09', NULL, NULL, NULL, 'Registered', 85, '2023-05-09 05:58:07', '2023-05-09 05:58:07', 1),
(5, 'galle_MIT_8_17', 17, '2023-08-25', NULL, NULL, NULL, 'Registered', 87, '2023-08-25 09:43:09', '2023-08-25 09:43:09', 1),
(8, 'galle__4_2', 2, '2023-09-20', NULL, NULL, NULL, 'Registered', 90, '2023-09-19 18:18:12', '2023-09-19 18:18:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_payments_models`
--

CREATE TABLE `student_payments_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `order` varchar(255) NOT NULL,
  `paidDate` varchar(255) DEFAULT NULL,
  `duedate` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `applicantid` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_payments_models`
--

INSERT INTO `student_payments_models` (`id`, `type`, `amount`, `order`, `paidDate`, `duedate`, `status`, `invoice`, `applicantid`, `created_at`, `updated_at`) VALUES
(1, 'Registration Fee', 1000, '1', NULL, '2023-03-20', 'false', NULL, 13, '2023-03-20 04:59:47', '2023-03-20 04:59:47'),
(2, 'Base Fee', 2000, '2', NULL, '2023-03-27', 'false', NULL, 13, '2023-03-20 04:59:47', '2023-03-20 04:59:47'),
(3, 'Instalement 1', 3000, '3', NULL, NULL, 'false', NULL, 13, '2023-03-20 04:59:47', '2023-03-20 04:59:47'),
(4, 'Instalement 2', 3000, '4', NULL, NULL, 'false', NULL, 13, '2023-03-20 04:59:47', '2023-03-20 04:59:47'),
(5, 'Registration Fee', 1000, '1', '2023-04-05', '2023-04-05', 'true', '1221', 15, '2023-04-05 05:54:43', '2023-04-05 05:54:43'),
(6, 'Base Fee', 2000, '2', NULL, '2023-04-12', 'false', NULL, 15, '2023-04-05 05:54:43', '2023-04-05 05:54:43'),
(7, 'Instalement 1', 2000, '3', NULL, '2023-03-20', 'false', NULL, 15, '2023-04-05 05:54:43', '2023-04-05 05:54:43'),
(8, 'Instalement 2', 2000, '4', NULL, '2023-04-17', 'false', NULL, 15, '2023-04-05 05:54:43', '2023-04-05 05:54:43'),
(9, 'Instalement 3', 2000, '5', NULL, '2023-05-15', 'false', NULL, 15, '2023-04-05 05:54:43', '2023-04-05 05:54:43'),
(10, 'Registration Fee', 1000, '1', '2023-05-09', '2023-05-09', 'true', '1233', 12, '2023-05-09 03:37:54', '2023-05-09 03:37:54'),
(11, 'Base Fee', 2000, '2', NULL, '2023-05-16', 'false', NULL, 12, '2023-05-09 03:37:54', '2023-05-09 03:37:54'),
(12, 'Instalement 1', 3000, '3', NULL, NULL, 'false', NULL, 12, '2023-05-09 03:37:54', '2023-05-09 03:37:54'),
(13, 'Instalement 2', 3000, '4', NULL, NULL, 'false', NULL, 12, '2023-05-09 03:37:54', '2023-05-09 03:37:54'),
(14, 'Registration Fee', 1000, '1', '2023-05-09', '2023-05-09', 'true', '23232', 16, '2023-05-09 05:58:07', '2023-05-09 05:58:07'),
(15, 'Base Fee', 2000, '2', NULL, '2023-05-16', 'false', NULL, 16, '2023-05-09 05:58:07', '2023-05-09 05:58:07'),
(16, 'Instalement 1', 3500, '3', NULL, NULL, 'false', NULL, 16, '2023-05-09 05:58:07', '2023-05-09 05:58:07'),
(17, 'Instalement 2', 3500, '4', NULL, NULL, 'false', NULL, 16, '2023-05-09 05:58:07', '2023-05-09 05:58:07'),
(18, 'Registration Fee', 1000, '1', '2023-08-25', '2023-08-25', 'true', '1234', 17, '2023-08-25 09:43:09', '2023-08-25 09:43:09'),
(19, 'Base Fee', 60000, '2', '2023-08-25', '2023-09-01', 'true', '2345', 17, '2023-08-25 09:43:09', '2023-08-25 09:43:09'),
(20, 'Instalement 1', -21000, '3', NULL, NULL, 'false', NULL, 17, '2023-08-25 09:43:09', '2023-08-25 09:43:09'),
(21, 'Instalement 2', -21000, '4', NULL, NULL, 'false', NULL, 17, '2023-08-25 09:43:09', '2023-08-25 09:43:09'),
(24, 'Registration Fee', 1000, '1', '2023-09-20', '2023-09-20', 'true', '2222', 2, '2023-09-19 18:18:13', '2023-09-19 18:18:13'),
(25, 'Base Fee', 5000, '2', NULL, '2023-09-27', 'false', NULL, 2, '2023-09-19 18:18:13', '2023-09-19 18:18:13'),
(26, 'Instalement 1', 1500, '3', NULL, NULL, 'false', NULL, 2, '2023-09-19 18:18:13', '2023-09-19 18:18:13'),
(27, 'Instalement 2', 1500, '4', NULL, NULL, 'false', NULL, 2, '2023-09-19 18:18:13', '2023-09-19 18:18:13');

-- --------------------------------------------------------

--
-- Table structure for table `subjectteacher`
--

CREATE TABLE `subjectteacher` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacherid` bigint(20) UNSIGNED NOT NULL,
  `courseid` bigint(20) UNSIGNED NOT NULL,
  `subjectid` bigint(20) UNSIGNED NOT NULL,
  `rateperhour` decimal(10,2) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjectteacher`
--

INSERT INTO `subjectteacher` (`id`, `teacherid`, `courseid`, `subjectid`, `rateperhour`, `startdate`, `enddate`, `status`, `created_at`, `updated_at`) VALUES
(6, 4, 2, 1, 600.00, '2023-11-14', '2023-11-22', 'Unassinged', '2023-11-20 16:39:53', '2023-11-20 16:39:53'),
(7, 1, 2, 2, 1.00, '2024-01-17', '2024-01-25', 'Unassinged', '2024-01-11 10:26:43', '2024-01-11 10:26:43'),
(8, 2, 2, 4, 1.00, '2024-01-17', '2024-01-25', 'Unassinged', '2024-01-11 10:33:16', '2024-01-11 10:33:16'),
(9, 2, 2, 2, 1.00, '2024-01-16', '2024-01-25', 'Unassinged', '2024-01-11 10:33:49', '2024-01-11 10:33:49'),
(10, 2, 2, 2, 1.00, '2024-01-15', '2024-01-18', 'Unassinged', '2024-01-11 10:37:00', '2024-01-11 10:37:00'),
(11, 2, 2, 2, 1.00, '2023-01-15', '2023-01-18', 'inactive', '2024-01-11 10:39:46', '2024-01-12 10:12:00'),
(12, 2, 2, 4, 1.00, '2024-01-13', '2024-01-26', 'Unassinged', '2024-01-11 10:41:21', '2024-01-11 10:41:21'),
(13, 2, 2, 5, 1.00, '2024-01-13', '2024-01-26', 'Unassinged', '2024-01-11 10:42:41', '2024-01-11 10:42:41'),
(16, 2, 2, 1, 444.00, '2024-01-16', '2024-01-26', 'active', '2024-01-12 00:03:34', '2024-01-12 00:03:34'),
(19, 3, 2, 3, 444.00, '2024-01-16', '2024-01-26', 'Unassinged', '2024-01-12 00:05:34', '2024-01-12 00:05:34'),
(20, 3, 2, 3, 444.00, '2024-01-16', '2024-01-13', 'inactive', '2024-01-12 00:05:34', '2024-01-12 05:18:58'),
(22, 2, 2, 3, 1.00, '2024-01-13', '2024-01-31', 'Unassinged', '2024-01-12 04:27:37', '2024-01-12 04:27:37'),
(23, 2, 2, 3, 1.00, '2024-01-13', '2024-01-26', 'active', '2024-01-12 05:18:58', '2024-01-12 05:18:58'),
(24, 3, 2, 2, 1.00, '2024-01-14', '2024-01-27', 'active', '2024-01-12 10:12:00', '2024-01-12 10:12:00'),
(25, 3, 2, 9, 1.00, '2024-01-14', '2024-01-25', 'active', '2024-01-12 10:36:42', '2024-01-12 10:36:42'),
(26, 5, 2, 25, 1.00, '2024-01-16', '2024-01-26', 'active', '2024-01-12 10:41:48', '2024-01-12 10:41:48'),
(27, 3, 2, 3, 1.00, '2024-01-16', '2024-01-26', 'active', '2024-01-12 10:55:01', '2024-01-12 10:55:01'),
(28, 3, 2, 3, 1.00, '2024-01-14', '2024-01-18', 'active', '2024-01-12 10:55:41', '2024-01-12 10:55:41'),
(29, 2, 2, 3, 1.00, '2024-01-14', '2024-01-19', 'active', '2024-01-12 10:57:12', '2024-01-12 10:57:12'),
(30, 3, 2, 3, 1.00, '2024-01-14', '2024-01-27', 'active', '2024-01-12 11:01:00', '2024-01-12 11:01:00'),
(31, 3, 2, 3, 1.00, '2024-01-14', '2024-01-25', 'active', '2024-01-12 11:03:04', '2024-01-12 11:03:04'),
(32, 3, 2, 3, 1.00, '2024-01-14', '2024-01-24', 'active', '2024-01-12 11:09:12', '2024-01-12 11:09:12'),
(33, 2, 2, 2, 1.00, '2024-01-20', '2024-01-19', 'active', '2024-01-13 05:21:28', '2024-01-13 05:21:28'),
(35, 3, 2, 2, 1.00, '2024-01-14', '2024-01-25', 'active', '2024-01-13 06:11:24', '2024-01-13 06:11:24'),
(36, 4, 2, 2, 1.00, '2024-01-14', '2024-01-25', 'active', '2024-01-13 06:13:00', '2024-01-13 06:13:00'),
(37, 2, 2, 3, 1.00, '2024-01-01', '2024-01-09', 'active', '2024-01-13 06:15:05', '2024-01-13 06:15:05'),
(41, 2, 2, 3, 2.00, '2024-01-14', '2024-01-19', 'active', '2024-01-13 07:14:15', '2024-01-13 07:14:15');

-- --------------------------------------------------------

--
-- Table structure for table `telescope_entries_tags`
--

CREATE TABLE `telescope_entries_tags` (
  `entry_uuid` char(36) NOT NULL,
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `telescope_entries_tags`
--

INSERT INTO `telescope_entries_tags` (`entry_uuid`, `tag`) VALUES
('9b1b4f10-de25-4c6f-b536-aacbc7a649a4', 'Spatie\\Permission\\Models\\Role'),
('9b1b4f10-e0eb-4c8b-b3e8-0005ed54544c', 'Spatie\\Permission\\Models\\Permission'),
('9b1b4f1e-15e1-490d-a0b2-57fc35181c6b', 'Spatie\\Permission\\Models\\Role'),
('9b1b4f1e-1b0f-4767-91d4-de74ebe27fab', 'Spatie\\Permission\\Models\\Permission'),
('9b1b50dc-71d5-426d-9484-9bc31e4aff4b', 'Spatie\\Permission\\Models\\Role'),
('9b1b50dc-746c-4475-b212-8f470812f858', 'Spatie\\Permission\\Models\\Permission'),
('9b1b50e9-e767-4632-ba93-1026b9562ca6', 'Spatie\\Permission\\Models\\Role'),
('9b1b50e9-e9c5-479a-9a8c-030c9537d5c5', 'Spatie\\Permission\\Models\\Permission'),
('9b1bb8a9-34e3-4fdb-a891-c6f78b1aa113', 'Spatie\\Permission\\Models\\Role'),
('9b1bb8a9-497c-4ad9-b4dd-ef73262795c0', 'Spatie\\Permission\\Models\\Permission'),
('9b1bb9bd-861e-4a36-b8a2-e74bd26e47b9', 'Spatie\\Permission\\Models\\Role'),
('9b1bb9bd-9208-4bc0-9446-11361c915367', 'Spatie\\Permission\\Models\\Permission'),
('9b1bbc8d-72b0-4f01-b53d-387f15aba02b', 'Spatie\\Permission\\Models\\Role'),
('9b1bbc8d-75a7-4c48-a6a5-b461e232e8df', 'Spatie\\Permission\\Models\\Permission'),
('9b1bbc98-55bb-49e2-9c56-fa0191610ea5', 'Spatie\\Permission\\Models\\Role'),
('9b1bbc9a-b471-43f0-af22-954f1bff1d25', 'Spatie\\Permission\\Models\\Role'),
('9b1bbc9a-bd0b-46f1-b7ef-cfb7578c383a', 'Spatie\\Permission\\Models\\Permission'),
('9b1bbc9c-bfee-4b45-a87d-ea6c906a413e', 'Spatie\\Permission\\Models\\Role'),
('9b1bbc9c-c71b-40df-a926-217cf8a07fd5', 'Spatie\\Permission\\Models\\Permission'),
('9b1bbc9d-5b1b-4d8f-b53b-44908e514907', 'Spatie\\Permission\\Models\\Role'),
('9b1bbc9d-61e7-4a5b-be0c-871b7fa62dce', 'Spatie\\Permission\\Models\\Permission'),
('9b1bbd45-3d6c-4917-bcfe-d68f7c52b1d2', 'Spatie\\Permission\\Models\\Role'),
('9b1bbd45-40b7-45a7-8335-4575ad5d6028', 'Spatie\\Permission\\Models\\Permission'),
('9b1bbd4f-ec75-4099-a9c5-1883dc2f6002', 'Spatie\\Permission\\Models\\Role'),
('9b1bbd4f-f126-4635-aacd-1a687bef9b4d', 'Spatie\\Permission\\Models\\Permission'),
('9b1bbd72-a7ac-46cc-a962-101e58d06fa0', 'Spatie\\Permission\\Models\\Role'),
('9b1bbd72-a9b9-40a6-99f1-ddb22602582c', 'Spatie\\Permission\\Models\\Permission'),
('9b1bbdb7-bf51-4c30-b619-c0ca689c5686', 'Spatie\\Permission\\Models\\Role'),
('9b1bbdb7-c19b-44b1-8a48-bde3bba9e8ba', 'Spatie\\Permission\\Models\\Permission'),
('9b1bbdbe-9c2b-40b4-b6cf-d4dcb3b47502', 'Spatie\\Permission\\Models\\Role'),
('9b1bbdbe-9ef3-4c8c-ac7d-9249ff8b65ef', 'Spatie\\Permission\\Models\\Permission'),
('9b1bbdc7-2174-4d32-b69f-2decb12ec860', 'Spatie\\Permission\\Models\\Role'),
('9b1bbdc7-2e0c-4875-b59e-692b232bc7c3', 'Spatie\\Permission\\Models\\Permission'),
('9b1bbdc7-b21d-4737-bb85-b6114b7b78d5', 'Spatie\\Permission\\Models\\Role'),
('9b1bbdc7-b7af-40cb-affa-540eab634ccf', 'Spatie\\Permission\\Models\\Permission'),
('9b1bbe3b-983e-46ae-af82-4f59c293614b', 'Spatie\\Permission\\Models\\Role'),
('9b1bbe3b-9d27-44cd-bcbf-166fe21cff19', 'Spatie\\Permission\\Models\\Permission'),
('9b1bbe41-f4d7-4b34-8fd6-2048ed9bc08d', 'Spatie\\Permission\\Models\\Role'),
('9b1bbe41-fc08-4570-aa6a-d2b446e71d9e', 'Spatie\\Permission\\Models\\Permission'),
('9b1bbe42-9510-4425-b378-f14df13fd9a0', 'Spatie\\Permission\\Models\\Role'),
('9b1bbe42-a02d-411f-b858-f4ddfa3b641a', 'Spatie\\Permission\\Models\\Permission'),
('9b1bbe43-3ab5-4174-804d-8451e2f2e581', 'Spatie\\Permission\\Models\\Role'),
('9b1bbe43-3d80-4021-81e7-d697308da6c2', 'Spatie\\Permission\\Models\\Permission'),
('9b1bbe43-b244-4609-b080-324feecd8358', 'Spatie\\Permission\\Models\\Role'),
('9b1bbe43-b481-462f-8a90-b1d629493d96', 'Spatie\\Permission\\Models\\Permission'),
('9b1bc0a2-4e86-47a7-ade6-ae0fb9564f85', 'Spatie\\Permission\\Models\\Permission'),
('9b1bc0aa-fc92-40fa-b5bf-e8a7d220a072', 'Spatie\\Permission\\Models\\Permission'),
('9b1bc0ab-1747-4498-a4d8-b8f45b7b4ece', 'Spatie\\Permission\\Models\\Permission:2'),
('9b1bc0b0-e710-45eb-be9a-6dabd429d6ef', 'Spatie\\Permission\\Models\\Permission'),
('9b1bc0b8-b791-47b1-91ac-977572cdfeca', 'Spatie\\Permission\\Models\\Permission'),
('9b1bc0b8-eb8d-4077-9daa-80f2b79fa13e', 'Spatie\\Permission\\Models\\Permission:1'),
('9b1bc120-e3a2-45d6-afb0-fa2eb98004b5', 'Spatie\\Permission\\Models\\Permission:3'),
('9b1bc122-7c5e-4506-a456-a43953e95d20', 'Spatie\\Permission\\Models\\Permission'),
('9b1bc122-ed74-4f96-81a8-03f9dd8f5f6a', 'Spatie\\Permission\\Models\\Permission'),
('9b1bc172-d4cc-4a00-bb5e-510208c8e41b', 'Spatie\\Permission\\Models\\Role'),
('9b1bc172-d7b9-4155-a3c0-02da3f4ab642', 'Spatie\\Permission\\Models\\Permission'),
('9b1bc180-a755-418a-8fd4-721235842db0', 'Spatie\\Permission\\Models\\Role'),
('9b1bc181-7aed-4537-ae5a-e4787f5b5f8b', 'Spatie\\Permission\\Models\\Role'),
('9b1bc181-83b2-4425-a7ca-85642fb1737e', 'Spatie\\Permission\\Models\\Permission'),
('9b1bc182-13df-4638-90e0-e49dbfe5fc80', 'Spatie\\Permission\\Models\\Role'),
('9b1bc182-163e-4fda-bdd6-16f1114d1050', 'Spatie\\Permission\\Models\\Permission'),
('9b1bc182-9c24-4d69-a3d0-66f14cb5d3d9', 'Spatie\\Permission\\Models\\Role'),
('9b1bc182-9fd2-4fd1-9f4f-431fc3c2a879', 'Spatie\\Permission\\Models\\Permission'),
('9b1bc5c2-d6c0-435f-8664-2fd25004d881', 'Spatie\\Permission\\Models\\Role'),
('9b1bc5c2-da45-41ef-b53b-3bb2d8b662c7', 'Spatie\\Permission\\Models\\Permission'),
('9b1bc61c-645d-482f-80ab-ceaa79687206', 'Spatie\\Permission\\Models\\Role'),
('9b1bc61c-6602-449c-88f7-b6f67656dbd8', 'Spatie\\Permission\\Models\\Permission'),
('9b1bc68d-cb4a-43fa-8ed5-3308195c1d41', 'Spatie\\Permission\\Models\\Role'),
('9b1bc68d-cd7d-4dbe-9800-5a58ee321b70', 'Spatie\\Permission\\Models\\Permission'),
('9b1bc880-348a-4b9a-8d94-bcc2575fd608', 'Spatie\\Permission\\Models\\Role'),
('9b1bc880-377b-4220-91ca-1044ef2c96f7', 'Spatie\\Permission\\Models\\Permission'),
('9b1bca10-cf44-45de-9d75-b29766835873', 'Spatie\\Permission\\Models\\Role'),
('9b1bca10-d25c-4ab7-8d1d-9f949d2dce20', 'Spatie\\Permission\\Models\\Permission'),
('9b1bcb32-3d24-48c2-9c95-23dc7bc806ba', 'Spatie\\Permission\\Models\\Role'),
('9b1bcb32-3ffc-4d54-be12-6fdc9871cfd4', 'Spatie\\Permission\\Models\\Permission'),
('9b1bcb4e-48ca-4b50-b093-be3b64107431', 'Spatie\\Permission\\Models\\Role'),
('9b1bcb4e-4bc0-423d-857e-93d1c3529a97', 'Spatie\\Permission\\Models\\Permission'),
('9b1bcbf4-8507-4321-b5bd-c077f568aed9', 'Spatie\\Permission\\Models\\Role'),
('9b1bcbf4-86f7-43c1-8353-5143450ea326', 'Spatie\\Permission\\Models\\Permission'),
('9b1bcc40-1693-46a2-b6eb-45112df24eb6', 'Spatie\\Permission\\Models\\Role'),
('9b1bcc40-193b-421e-b89a-6ab5c2d2786e', 'Spatie\\Permission\\Models\\Permission'),
('9b1bcd26-43db-4a32-8eba-8e52c91faf2a', 'Spatie\\Permission\\Models\\Role'),
('9b1bcd26-46f9-415e-a123-1b5a3b168795', 'Spatie\\Permission\\Models\\Permission'),
('9b1bcd4a-5962-4d5d-a2c5-b5581e79bb35', 'Spatie\\Permission\\Models\\Role'),
('9b1bcd4a-5c32-4276-a7d0-f4223c8a9fed', 'Spatie\\Permission\\Models\\Permission'),
('9b1bcdd4-8328-481d-b444-0e2a44e0fd44', 'Spatie\\Permission\\Models\\Role'),
('9b1bcdd4-8575-4108-a767-e5d0f7eaca49', 'Spatie\\Permission\\Models\\Permission'),
('9b1bcf4b-7db3-41d4-a941-08f7aca8cc49', 'Spatie\\Permission\\Models\\Role'),
('9b1bcf4b-8266-4458-96eb-a017d76b75f5', 'Spatie\\Permission\\Models\\Permission'),
('9b1bd277-8340-4531-a8cd-3eeda4b563b9', 'Spatie\\Permission\\Models\\Role'),
('9b1bd277-8669-4a5a-81a3-e1fa89eb6844', 'Spatie\\Permission\\Models\\Permission'),
('9b1bd277-8943-467f-ab71-b13b4cc07015', 'App\\Models\\User'),
('9b1bd2ef-04c1-4064-805a-9951c2309bbb', 'Spatie\\Permission\\Models\\Role'),
('9b1bd2ef-071d-487d-bee1-e5749286fd60', 'Spatie\\Permission\\Models\\Permission'),
('9b1bd2ef-09ca-40cb-8d72-4cc3688e1234', 'App\\Models\\User'),
('9b1bd32a-0deb-416f-b1d6-ab56f177e74b', 'Spatie\\Permission\\Models\\Role'),
('9b1bd32a-0f6f-4543-9282-968529cb6a25', 'Spatie\\Permission\\Models\\Permission'),
('9b1bd32a-10f9-4369-b051-e940b27c1b1c', 'App\\Models\\User'),
('9b1bd495-9b46-4098-b7c2-84a40ead95b3', 'Spatie\\Permission\\Models\\Role'),
('9b1bd495-9ccf-4624-a0f2-c63153742149', 'Spatie\\Permission\\Models\\Permission'),
('9b1bd495-9ed3-49e7-add6-a0aa10e4fbdb', 'App\\Models\\User'),
('9b1bd52a-3875-40ee-aee0-4aca8a833458', 'Spatie\\Permission\\Models\\Role'),
('9b1bd52a-3a86-405a-b3f1-e6a4a1ae3653', 'Spatie\\Permission\\Models\\Permission'),
('9b1bd52a-3cc1-4e7a-8e52-4bd143aae0a2', 'App\\Models\\User'),
('9b1bd55d-0557-46f2-b09c-a278523e9993', 'Spatie\\Permission\\Models\\Role'),
('9b1bd55d-0782-479d-9d3a-7dc4331ba19e', 'Spatie\\Permission\\Models\\Permission'),
('9b1bd55d-0965-4487-a01d-00eb7d7956ed', 'App\\Models\\User'),
('9b1bd5c3-c337-412c-b828-1e138949181e', 'Spatie\\Permission\\Models\\Role'),
('9b1bd5c3-c586-4ad9-b018-2340d75ce60f', 'Spatie\\Permission\\Models\\Permission'),
('9b1bd5c3-c71f-4bf3-9f9e-f6a67c6d50d9', 'App\\Models\\User'),
('9b1bd5cf-fa6e-4cc5-88fb-200eea514a71', 'App\\Models\\User'),
('9b1bd692-d768-40f4-9ef4-3181e5b3c7e9', 'Spatie\\Permission\\Models\\Role'),
('9b1bd692-d99d-404f-81ed-8d76c62cdded', 'Spatie\\Permission\\Models\\Permission'),
('9b1bd692-dcef-4e37-9b31-eab9f00cdc4c', 'App\\Models\\User'),
('9b1bd69a-edee-48c2-b2ef-bdc7fddaa382', 'Spatie\\Permission\\Models\\Role'),
('9b1bd69a-eff0-4250-be66-ae145807d3ef', 'Spatie\\Permission\\Models\\Permission'),
('9b1bd69a-f202-4a01-bc76-e9a9050ba002', 'App\\Models\\User'),
('9b1bd6a6-3449-48c7-857b-e4b1abc96ae4', 'App\\Models\\User'),
('9b1bd6a6-35cd-462e-b6a0-e16c175c332b', 'Spatie\\Permission\\Models\\Role'),
('9b1bd6a6-ad9a-4908-810d-afdaae61ec41', 'Spatie\\Permission\\Models\\Role'),
('9b1bd6a6-aff6-407a-ab15-e4081f772aee', 'Spatie\\Permission\\Models\\Permission'),
('9b1bd6a6-b1f4-4012-a585-48b83e429f14', 'App\\Models\\User'),
('9b1bd701-55e8-415c-aa19-4dd32f6ac3b8', 'App\\Models\\User'),
('9b1bd701-578c-42e3-bf82-2076fee031e5', 'Spatie\\Permission\\Models\\Role'),
('9b1bd702-3d93-4fb4-923f-fdf0e3c4a094', 'Spatie\\Permission\\Models\\Role'),
('9b1bd702-3f18-4f9a-8f4c-06008fd06dd4', 'Spatie\\Permission\\Models\\Permission'),
('9b1bd702-40a1-4aed-904f-9b03cfbcc855', 'App\\Models\\User'),
('9b1bd731-7c9c-4c34-8c33-7f584f9ae387', 'App\\Models\\User'),
('9b1bd731-7e2b-443e-9e90-f5a43d873ace', 'Spatie\\Permission\\Models\\Role'),
('9b1bd731-ed2e-4016-ac8b-6dff5ed01823', 'Spatie\\Permission\\Models\\Role'),
('9b1bd731-ef47-4d83-b085-f9483e48aa23', 'Spatie\\Permission\\Models\\Permission'),
('9b1bd731-f164-4fdd-8c4c-8904b700bb97', 'App\\Models\\User'),
('9b1d53e4-e91f-4201-9472-34b0548093a5', 'Spatie\\Permission\\Models\\Role'),
('9b1d53e4-f893-4e97-9987-4a2b9b431be7', 'Spatie\\Permission\\Models\\Permission'),
('9b1d53e5-00fc-487d-b166-c0bfbf9271e4', 'App\\Models\\User'),
('9b1d54b3-b793-4f3d-855c-e5cc4e614a47', 'Spatie\\Permission\\Models\\Role'),
('9b1d54b3-ba53-47fe-9912-980fbecf4186', 'Spatie\\Permission\\Models\\Permission'),
('9b1d54b3-bd3f-4465-bec0-119b1b2869e2', 'App\\Models\\User'),
('9b1d5528-c1eb-46f1-a883-8f4d64fb73a7', 'Spatie\\Permission\\Models\\Role:7'),
('9b1d5529-c11f-48eb-a75a-0c4767e28222', 'Spatie\\Permission\\Models\\Role'),
('9b1d5529-c2c6-41ec-8b9b-ed2d74b693a8', 'Spatie\\Permission\\Models\\Permission'),
('9b1d5529-c467-4394-ab69-d57fb85859da', 'App\\Models\\User'),
('9b1d552a-482d-4010-8a1e-602a79897e97', 'Spatie\\Permission\\Models\\Role'),
('9b1d552a-49de-4500-8752-03829fefea5d', 'Spatie\\Permission\\Models\\Permission'),
('9b1d552a-4b4b-4535-8da6-10d3d38e3280', 'App\\Models\\User'),
('9b1d5550-23c6-4dd0-a403-3ddaa1356923', 'Spatie\\Permission\\Models\\Role:8'),
('9b1d5551-0c55-42af-8dce-61a58f93dd49', 'Spatie\\Permission\\Models\\Role'),
('9b1d5551-0ee6-493b-ba81-e76154705e01', 'Spatie\\Permission\\Models\\Permission'),
('9b1d5551-109f-4c84-ae19-b07381dbd6e7', 'App\\Models\\User'),
('9b1d5551-8fd3-496c-b452-0b06205e570a', 'Spatie\\Permission\\Models\\Role'),
('9b1d5551-91f8-428d-be8d-0cb3b040e402', 'Spatie\\Permission\\Models\\Permission'),
('9b1d5551-93c2-416a-a313-3da6bd8e411a', 'App\\Models\\User'),
('9b1d583d-6169-4f8f-97f3-37f2ca0b6569', 'Spatie\\Permission\\Models\\Role'),
('9b1d583d-63db-4a82-b9c2-053572d29258', 'Spatie\\Permission\\Models\\Permission'),
('9b1d583d-6604-456d-9456-66e5bef91328', 'App\\Models\\User'),
('9b1d5880-77f7-4feb-b3c3-8c98c1131ce6', 'Spatie\\Permission\\Models\\Role'),
('9b1d5880-7a59-4b2a-b2d5-a00e3cbe7010', 'Spatie\\Permission\\Models\\Permission'),
('9b1d5880-7bfa-493d-8962-bdf8b05eb412', 'App\\Models\\User'),
('9b1d58db-3012-41c1-b6d3-3292c7001cba', 'Spatie\\Permission\\Models\\Role'),
('9b1d58db-3226-4be0-927f-09c06698716a', 'Spatie\\Permission\\Models\\Permission'),
('9b1d58db-3471-4b21-80e7-3d6b570c2e1e', 'App\\Models\\User'),
('9b1d593c-9a79-4cf4-a7f5-2db768d59d21', 'Spatie\\Permission\\Models\\Role'),
('9b1d593c-9c2e-4a45-8db3-443733abe4df', 'Spatie\\Permission\\Models\\Permission'),
('9b1d593c-9efd-4ae9-b48e-966a8ff9fe29', 'App\\Models\\User'),
('9b1d599a-1264-434b-9605-f6ec0d0510a4', 'Spatie\\Permission\\Models\\Role'),
('9b1d599a-14f5-42a5-9253-1745fa679a6b', 'Spatie\\Permission\\Models\\Permission'),
('9b1d599a-16a1-4b69-b0e4-703d9ab42956', 'App\\Models\\User'),
('9b1d5a61-569e-44bb-a4ed-90fd6f929423', 'Spatie\\Permission\\Models\\Role'),
('9b1d5a61-5852-437f-84b4-41aa95c7e73d', 'Spatie\\Permission\\Models\\Permission'),
('9b1d5a61-5a36-48e3-b3cc-0714baa3b90a', 'App\\Models\\User'),
('9b1d5b09-e336-4d28-af74-32a761610c6a', 'Spatie\\Permission\\Models\\Role'),
('9b1d5b09-e604-49a7-b884-c10c649a6feb', 'Spatie\\Permission\\Models\\Permission'),
('9b1d5b09-e848-460a-b6a5-6614a4cb2a7b', 'App\\Models\\User'),
('9b1d5b24-b0bc-4bec-9b6b-16abf633ddbd', 'Spatie\\Permission\\Models\\Role'),
('9b1d5b24-b339-42a3-b399-2892f38f4aa6', 'Spatie\\Permission\\Models\\Permission'),
('9b1d5b24-b51e-45b6-a9a1-ea14c388fa53', 'App\\Models\\User'),
('9b1d5c68-134c-4f0e-9d3d-c5217b3d3118', 'Spatie\\Permission\\Models\\Role'),
('9b1d5c68-17b2-44e4-a5ae-71087abc7743', 'Spatie\\Permission\\Models\\Permission'),
('9b1d5c68-1b54-4e7d-9d5e-f837e52e3b82', 'App\\Models\\User'),
('9b1d5cb3-3870-4de3-a065-7091297a96b2', 'Spatie\\Permission\\Models\\Role'),
('9b1d5cb3-3b01-462c-9457-ec2384b61395', 'Spatie\\Permission\\Models\\Permission'),
('9b1d5cb3-3c99-4c00-9ceb-07d30a2a41f8', 'App\\Models\\User'),
('9b1d5cd5-6a12-4a78-b605-f6882726772b', 'Spatie\\Permission\\Models\\Role'),
('9b1d5cd5-6c71-497c-baa8-7c3afd889288', 'Spatie\\Permission\\Models\\Permission'),
('9b1d5cd5-6ec3-4008-8c19-b7bf2cbfd946', 'App\\Models\\User'),
('9b1d5dbf-ce09-453f-b065-80adbeaac29e', 'Spatie\\Permission\\Models\\Permission'),
('9b1d5dff-ec44-49ec-8793-a35077bdddc5', 'Spatie\\Permission\\Models\\Permission:4'),
('9b1d5e02-9e62-4735-903c-18a6cd67e147', 'Spatie\\Permission\\Models\\Permission'),
('9b1d5e05-6e05-4f92-95a1-86c31ecee798', 'Spatie\\Permission\\Models\\Permission'),
('9b1d5e1d-57ed-4a0f-b769-5eea78f9a1ee', 'Spatie\\Permission\\Models\\Permission'),
('9b1d5e46-f1d0-48bc-b33a-1f5e008ee3a1', 'Spatie\\Permission\\Models\\Role'),
('9b1d5e46-f39c-4978-a7cf-7a833c520adf', 'Spatie\\Permission\\Models\\Permission'),
('9b1d5e46-f601-4133-8e04-0ce292713ba2', 'App\\Models\\User'),
('9b1d5e6a-09e1-4e96-81de-fea9e49f06fb', 'App\\Models\\User'),
('9b1d5e6b-106d-45a2-892b-e78f30efc4d5', 'Spatie\\Permission\\Models\\Role'),
('9b1d5e6b-12cd-4798-81c4-5b1b57ba3ca3', 'Spatie\\Permission\\Models\\Permission'),
('9b1d5e6b-14b6-41e3-a638-a024d715a76a', 'App\\Models\\User'),
('9b1fa7f3-b0cd-42d6-abc0-e0175fe3062b', 'App\\Models\\User'),
('9b1fa7f3-e626-434b-863d-6a2aca115fad', 'Auth:1'),
('9b1fa7f4-65a7-4287-aa5d-223a923f521a', 'App\\Models\\User'),
('9b1fa7f4-687c-4091-be27-9d59c13b0747', 'Auth:1'),
('9b1fa7f4-70c7-4cbe-b092-4f5266ed8f80', 'Auth:1'),
('9b1fa7f4-7873-4eb0-8a69-fc151e0b8cfd', 'Auth:1'),
('9b1fa7f4-7df7-4fa6-9e1f-822d7ab8fb7d', 'Auth:1'),
('9b1fa7f4-7f23-4c2c-bdc8-3ea634372236', 'Auth:1'),
('9b1fa85a-22a4-4b91-9cef-07ce62d9ffbb', 'App\\Models\\User'),
('9b1fa85a-24e6-43b4-afb8-397b812953be', 'Auth:1'),
('9b1fa85a-2540-4bb2-aa00-73a30b16080f', 'Auth:1'),
('9b1fa85a-26da-41f9-84ab-e0f2bf41cb9c', 'Auth:1'),
('9b1fa85a-2733-4fb5-853b-a2c6ccd69190', 'Auth:1'),
('9b1fa85a-289d-4aba-bcd3-12421605bb01', 'Auth:1'),
('9b1fa85c-e92b-4813-9f35-07ef89e83d36', 'App\\Models\\User'),
('9b1fa85c-eb32-4373-be8c-1e5aa621bff8', 'Auth:1'),
('9b1fa85c-f798-4d70-a1d4-2f6b964f59bb', 'Auth:1'),
('9b1fa85c-f972-48a2-9192-94db67a7e97e', 'Auth:1'),
('9b1fa85c-f9da-4d57-88e6-a5cd8f5e80dd', 'Auth:1'),
('9b1fa85c-fb65-4af9-bac6-17d62d8d3eae', 'Auth:1'),
('9b1fa85e-8425-4a71-a436-eb9ebde461b9', 'App\\Models\\User'),
('9b1fa85e-880d-4c19-9dee-0770dab46962', 'Auth:1'),
('9b1fa85e-88ad-43a1-9483-b0940db59542', 'Auth:1'),
('9b1fa85e-894a-4aea-8fa0-925e9470d260', 'Auth:1'),
('9b1fa85e-8982-4227-ba09-15df295b70ff', 'app\\Models\\coursemodel'),
('9b1fa85e-8982-4227-ba09-15df295b70ff', 'Auth:1'),
('9b1fa85e-9a13-47a2-b29d-035ab1a24e28', 'Auth:1'),
('9b1fa864-61dd-420e-ac48-eb8c29ac7fe5', 'App\\Models\\User'),
('9b1fa864-640c-41f1-8207-e14e3bb64171', 'Auth:1'),
('9b1fa864-717b-4aae-a1f0-9ca5f14f0a67', 'Auth:1'),
('9b1fa864-7371-464f-8776-1c2b5bc71f7a', 'Auth:1'),
('9b1fa864-741c-467a-95e0-f0ea9833bbd9', 'Auth:1'),
('9b1fa864-754d-4531-b589-bef1ea328bd2', 'Auth:1'),
('9b1fa865-ec50-4892-a8dc-952e08b3617b', 'App\\Models\\User'),
('9b1fa865-eec0-4c1f-83c8-b716d49b17e4', 'Auth:1'),
('9b1fa865-ef69-4172-8f37-642db6b01092', 'Auth:1'),
('9b1fa865-f0c9-4618-aed3-64f17e377e71', 'Auth:1'),
('9b1fa865-f100-4954-96aa-a8bee5f0e921', 'app\\Models\\Batch'),
('9b1fa865-f100-4954-96aa-a8bee5f0e921', 'Auth:1'),
('9b1fa865-f515-4f12-a8a0-7b3ea72657e4', 'Auth:1'),
('9b1fa869-beb2-4e7b-ad14-28ecb442ec97', 'App\\Models\\User'),
('9b1fa869-c0c4-4fa6-94b1-20a69fa0f935', 'Auth:1'),
('9b1fa869-c10d-4cc4-875c-cc961a99983c', 'app\\Models\\coursemodel'),
('9b1fa869-c10d-4cc4-875c-cc961a99983c', 'Auth:1'),
('9b1fa869-c2df-40d7-97e6-ceafb68843fd', 'Auth:1'),
('9b1fa869-db8b-4f05-b6e8-eb5fe16dfb60', 'Auth:1'),
('9b1fa869-dd3a-43bc-8ecd-fc94d46a5a23', 'Auth:1'),
('9b1fa869-dda0-4c40-8759-084b6dae0add', 'Auth:1'),
('9b1fa869-e005-4258-988c-3dc7708afd93', 'Auth:1'),
('9b1fa893-b805-44d4-a703-f1f668263b6e', 'App\\Models\\User'),
('9b1fa893-ba92-4058-931e-06ef013ed0d3', 'Auth:1'),
('9b1fa893-baf3-4cf6-9f60-2b50c3d2d0f4', 'Auth:1'),
('9b1fa893-bc90-4bb1-9e5e-7e9a17c6de60', 'Auth:1'),
('9b1fa893-bce6-4326-beb5-9cc06c142047', 'Auth:1'),
('9b1fa893-be14-417e-8e34-2a68ef685b21', 'Auth:1'),
('9b1fa8e7-8da4-4560-a458-bf3f8fb4e042', 'App\\Models\\User'),
('9b1fa8e7-90bb-49ee-98f9-0b130a4608e5', 'Auth:1'),
('9b1fa8e7-9386-4179-a508-7479135ea12a', 'Auth:1'),
('9b1fa8e7-95ed-4c8a-89ca-3d35ae512546', 'Auth:1'),
('9b1fa8e7-9691-414e-a857-33613e2898e9', 'Auth:1'),
('9b1fa8e7-97f7-4e9a-8696-c19b4a909aff', 'Auth:1'),
('9b1fa933-47e0-4bc5-8956-0d90091b7d45', 'App\\Models\\User'),
('9b1fa933-4ae3-422f-9d45-78bd04988f63', 'Auth:1'),
('9b1fa933-4ccc-43d1-968c-05a97d957d4d', 'Auth:1'),
('9b1fa933-4f2b-4f05-83ca-c8c56c0fd5e0', 'Auth:1'),
('9b1fa933-4fce-455c-8e2d-b099e436df89', 'Auth:1'),
('9b1fa933-5102-4b03-b1d4-1e83a1ba6f07', 'Auth:1'),
('9b1fa95e-a4c7-4d26-a09c-a70aaa44423b', 'App\\Models\\User'),
('9b1fa95e-a73f-45cd-a0f9-cd4c1e20f7d9', 'Auth:1'),
('9b1fa95e-a9c7-4570-ba2b-83a675999484', 'Auth:1'),
('9b1fa95e-aba6-4f2a-afdc-2411f8d136e3', 'Auth:1'),
('9b1fa95e-ac07-47b2-a01d-da06985127ec', 'Auth:1'),
('9b1fa95e-ad2f-4c66-886b-b6b1039e0b27', 'Auth:1'),
('9b1fac03-a6bc-4744-8b8e-2bdaa87c21a7', 'App\\Models\\User'),
('9b1fac03-b304-4159-8e52-e282599627fc', 'Auth:1'),
('9b1fac03-bfa2-48e4-87cf-266ec3c5e887', 'Auth:1'),
('9b1fac03-c701-4479-b8c3-21e1c41496e0', 'Auth:1'),
('9b1fac03-c7f7-4b1b-99d9-c7663afa0f82', 'Auth:1'),
('9b1fac03-cad9-4ea6-99f3-f054968583b6', 'Auth:1'),
('9b1fac53-6be9-4ac3-bee7-e401a6ea29a3', 'App\\Models\\User'),
('9b1fac54-2066-4731-b972-d7b0ef8b2688', 'Auth:1'),
('9b1fac55-7fa1-4303-bc02-7da0ddec564b', 'Auth:1'),
('9b1fac77-5b09-4e50-af2e-aecc79d02d4d', 'App\\Models\\User'),
('9b1fac77-5d41-4d6c-a1b6-576b5fbb2038', 'Auth:1'),
('9b1fac77-6145-4398-8828-05b20806dc58', 'Auth:1'),
('9b1fac77-63b7-4d41-b8b8-de8c5051f7e9', 'Auth:1'),
('9b1fac77-645a-4d27-b74c-935e80f9a48d', 'Auth:1'),
('9b1fac77-66be-4ac9-8f42-623b71eb1f4b', 'Auth:1'),
('9b1fad00-b66f-43a8-aff5-26126df8e7d9', 'App\\Models\\User'),
('9b1fad00-b966-4f31-be83-7529e2070c37', 'Auth:1'),
('9b1fad00-b9bb-4e26-86b0-f100a3c209af', 'App\\Models\\Person'),
('9b1fad00-b9bb-4e26-86b0-f100a3c209af', 'Auth:1'),
('9b1fad00-bacc-4484-808b-009e1ce02c59', 'Auth:1'),
('9b1fad00-bb24-4467-b806-4de9ed76275b', 'app\\Models\\jobs'),
('9b1fad00-bb24-4467-b806-4de9ed76275b', 'Auth:1'),
('9b1fad01-433b-426d-90da-0f3599b1f11d', 'Auth:1'),
('9b1fad01-43ad-4e00-8b83-1fa6e81c35fd', 'App\\Models\\jobDocs'),
('9b1fad01-43ad-4e00-8b83-1fa6e81c35fd', 'Auth:1'),
('9b1fad01-4704-4c45-99a6-1d36177e0ff0', 'Auth:1'),
('9b1fad01-534f-4b6c-b704-6617492ad2b4', 'Auth:1'),
('9b1fad01-561b-4f33-8519-e3140501b95a', 'Auth:1'),
('9b1fad01-5c42-4588-b4b6-b7eba494167d', 'Auth:1'),
('9b1fad01-5e12-48f2-928c-1dd22bb8ed75', 'Auth:1'),
('9b1fad1e-8588-4376-9d3c-a58ecade6c9f', 'App\\Models\\User'),
('9b1fad1e-889c-439e-9956-b9bfaf4affea', 'Auth:1'),
('9b1fad1e-893f-4033-bc22-4894f9a247c0', 'Auth:1'),
('9b1fad1e-8c2c-4ae2-bba1-25d36fc9468c', 'Auth:1'),
('9b1fad1e-8c92-4525-8001-9477f09dd6e1', 'Auth:1'),
('9b1fad1e-8da4-45c1-b7f4-3424653b2a7f', 'Auth:1'),
('9b1fad26-986b-477c-a889-3fc3b816d1b6', 'App\\Models\\User'),
('9b1fad26-9bde-4efd-a2a6-3ea139e08cd3', 'Auth:1'),
('9b1fad26-9c68-4709-a52a-8339951347d4', 'Auth:1'),
('9b1fad26-9eb0-4299-ad82-30817d259edf', 'Auth:1'),
('9b1fad26-9f2c-4c18-b7c4-e63521b74e78', 'Auth:1'),
('9b1fad26-a0aa-4352-846d-6111fd6fe9bb', 'Auth:1'),
('9b1fadc7-3b69-4822-9ac1-35be7d660868', 'App\\Models\\User'),
('9b1fae05-cada-4c35-b59b-f68b7c22fd3f', 'App\\Models\\User'),
('9b1fae06-0130-4c83-a35f-656bf50374c8', 'Auth:82'),
('9b1fae06-7f82-41cd-8893-465186ab00cd', 'App\\Models\\User'),
('9b1fae06-8205-431d-8033-9329c6621a7f', 'Auth:82'),
('9b1fae06-826e-4e2f-ab44-05f2bf89399f', 'Auth:82'),
('9b1fae06-84cf-4b5b-a3a6-e92d76f93fa3', 'Auth:82'),
('9b1fae06-8559-4b41-af89-9b82cf50dc9c', 'Auth:82'),
('9b1fae06-86c4-46e2-9497-7efa327533a8', 'Auth:82'),
('9b1fbb2f-e109-464a-a930-fefbb70dbdd7', 'App\\Models\\User'),
('9b1fbb2f-e3ce-42cd-b10d-427a71c705c7', 'Auth:82'),
('9b1fbb2f-e5d0-47ff-bf97-2e3e050447ff', 'Auth:82'),
('9b1fbb2f-e80e-48f7-b7a5-0b410b6871d1', 'Auth:82'),
('9b1fbb2f-e876-4fac-ba0b-b4c8814f27fd', 'Auth:82'),
('9b1fbb2f-e996-48d3-a8af-5cf71adc32de', 'Auth:82'),
('9b1fbbec-52d8-46a7-9c1a-600dbb009bd7', 'App\\Models\\User'),
('9b1fbbec-5587-4d14-8fb6-ce336e71d56d', 'Auth:82'),
('9b1fbbec-5793-414b-9eaa-efe90c6a695c', 'Auth:82'),
('9b1fbbec-5a69-4c75-8b93-bf6419ef9d31', 'Auth:82'),
('9b1fbbec-5af3-4dac-9b3f-e0cf2ce61ba2', 'Auth:82'),
('9b1fbbec-5c5b-4881-ad33-54759aefba3f', 'Auth:82'),
('9b2140e3-cce6-4c4b-987d-c97c71f6edab', 'Spatie\\Permission\\Models\\Role'),
('9b2140e3-d9c4-4765-a499-b9f533628ca2', 'Spatie\\Permission\\Models\\Permission'),
('9b2140e3-de0c-49a7-90b4-b9d286cec09a', 'App\\Models\\User'),
('9b216248-4c2e-4aff-b7cb-f84df149de4f', 'App\\Models\\User'),
('9b216248-88fa-4d95-adbb-5e8809f37b95', 'Auth:1'),
('9b216249-0bf7-4269-aeaa-fc0258bf4654', 'App\\Models\\User'),
('9b216249-10d2-4ff0-9818-6fd18a8de95d', 'Auth:1'),
('9b216249-1e71-414e-afde-704e6cf0537f', 'Auth:1'),
('9b216249-25a7-411d-87f1-bbdd825e87c4', 'Auth:1'),
('9b216249-2a3a-4b4a-ac15-1e25c2fe8a7c', 'Auth:1'),
('9b216249-2cf9-4544-a1f0-7501b4fcd651', 'Auth:1'),
('9b2162c9-f5a1-4059-921d-7bc96d13ece2', 'App\\Models\\User'),
('9b2162c9-f80d-4bc9-a302-ca8337289ac7', 'Auth:1'),
('9b2162c9-fa51-441f-b8c8-01a65c91a1ea', 'Auth:1'),
('9b2162c9-fbec-4c52-ad3d-560dc7771f9d', 'Auth:1'),
('9b2162c9-fc46-4ccc-b78c-844c36c2cfa3', 'Auth:1'),
('9b2162c9-fd56-420a-b7aa-ff944b6e982e', 'Auth:1'),
('9b21642a-3f6e-43d0-b42d-c11d3e8ec7f2', 'App\\Models\\User'),
('9b21642a-4348-4149-a680-1c3280a2e774', 'Auth:1'),
('9b21642a-ae32-4b4e-891f-fa064ae2bc85', 'App\\Models\\User'),
('9b21642a-b19f-4ade-bf15-e86446d69a73', 'Auth:1'),
('9b21642a-b208-4144-accf-cde327147e25', 'Auth:1'),
('9b21642a-b3c8-4084-b20d-bf9851b9cbee', 'Auth:1'),
('9b21642a-b42a-4e92-bf4f-d5099429253b', 'Auth:1'),
('9b21642a-b52e-4579-8a0c-53aa930af684', 'Auth:1'),
('9b216434-26da-4659-b053-ab10eae72ef9', 'Spatie\\Permission\\Models\\Role'),
('9b216434-30da-49c3-8911-48223940174f', 'Spatie\\Permission\\Models\\Permission'),
('9b216434-32d6-422b-85c4-8301912ecf7c', 'App\\Models\\User'),
('9b216683-b867-4390-8204-4ff3b70c5904', 'Spatie\\Permission\\Models\\Role'),
('9b216683-ba61-4f47-8cbd-d5ce0ffb758f', 'Spatie\\Permission\\Models\\Permission'),
('9b216683-bcc9-4a37-9b0f-6a9268af47ec', 'App\\Models\\User'),
('9b2166f9-c475-4b98-8f53-6cbc06dc6381', 'App\\Models\\User'),
('9b2166f9-d31d-4940-8cce-99418bef43b2', 'Auth:1'),
('9b2166f9-d6aa-4ebc-8fc9-b6bf2deceb78', 'Auth:1'),
('9b216713-feac-46f9-b800-bc7775f2ea6e', 'App\\Models\\User'),
('9b216714-025d-45db-8bd7-b6ca554be959', 'Auth:1'),
('9b216714-662f-4fd1-8559-fcdb334c062b', 'App\\Models\\User'),
('9b216714-692e-4d6b-922c-cb57d59d4cfb', 'Auth:1'),
('9b216714-6b77-41d9-b00b-bb42e71f85fb', 'Auth:1'),
('9b2167f8-a20b-4ab2-8193-1c894fd25073', 'App\\Models\\User'),
('9b2167f8-a52e-4bb6-b862-c7fbc15be608', 'Spatie\\Permission\\Models\\Role'),
('9b2167f9-228c-4c1b-950b-054fec9847ab', 'Spatie\\Permission\\Models\\Role'),
('9b2167f9-2481-45ab-8822-734d266a3160', 'Spatie\\Permission\\Models\\Permission'),
('9b2167f9-261f-443a-9d58-2a5f37b4c6e1', 'App\\Models\\User'),
('9b21681c-f804-4dad-b0df-467620bd0f15', 'App\\Models\\User'),
('9b21681c-fb22-4473-9c39-c41920dfa046', 'Auth:1'),
('9b21681d-732b-4a7a-bfd8-2b5a6dfd9948', 'App\\Models\\User'),
('9b21681d-7973-4dc4-98d1-47804debf798', 'Auth:1'),
('9b21681d-79dd-416b-b176-1902c345699a', 'Auth:1'),
('9b21681d-79dd-416b-b176-1902c345699a', 'Spatie\\Permission\\Models\\Role'),
('9b21681d-b3c4-4911-a8b7-3ed5f67ffe60', 'Auth:1'),
('9b21681d-b46d-438b-a594-729f10c01291', 'Auth:1'),
('9b21681d-b750-4732-b7f0-b2caa1a8d3c2', 'Auth:1'),
('9b21681d-b807-4708-822a-76b9031ee1ea', 'Auth:1'),
('9b21681d-c463-4459-a17a-3883af98fe20', 'Auth:1'),
('9b2168b2-4cf2-46a9-ad1c-3a462d6d5e55', 'App\\Models\\User'),
('9b2168b2-4f3d-497f-adc4-09db5d05b0a6', 'Spatie\\Permission\\Models\\Role'),
('9b2168b2-bfec-418a-b2e7-9d8b68b1dbb0', 'Spatie\\Permission\\Models\\Role'),
('9b2168b2-c1ae-428e-bef2-69e491df1dfe', 'Spatie\\Permission\\Models\\Permission'),
('9b2168b2-c330-4beb-96b3-90636173eab9', 'App\\Models\\User'),
('9b2168bd-421d-44c2-9256-6036c5775f03', 'App\\Models\\User'),
('9b2168bd-4445-47af-ad3c-8f4e5b1455ba', 'Spatie\\Permission\\Models\\Role'),
('9b2168bd-c0a6-4b6e-844f-b00ecf3e5084', 'Spatie\\Permission\\Models\\Role'),
('9b2168bd-c26d-4733-889a-853fbb3e2ae3', 'Spatie\\Permission\\Models\\Permission'),
('9b2168bd-c479-4fd3-9adb-40dfcad91373', 'App\\Models\\User'),
('9b2168cd-b3fa-4a6d-ab4d-25b590627ffd', 'App\\Models\\User'),
('9b21692a-9a2e-4331-b2a7-b3cd36306bf8', 'App\\Models\\User'),
('9b21692a-c16c-4112-b75d-9910d00d1d38', 'Auth:82'),
('9b21692b-3617-43c4-bc7d-1654762fc287', 'App\\Models\\User'),
('9b21692b-39fb-4bd8-8d29-49a0ad6ff8c2', 'Auth:82'),
('9b21692b-3a55-404c-ab47-27db0622ec9f', 'Auth:82'),
('9b21692b-3a55-404c-ab47-27db0622ec9f', 'Spatie\\Permission\\Models\\Role'),
('9b21692b-3ca0-4843-94bf-da5d988e57eb', 'Auth:82'),
('9b2169b7-fa1d-43e9-8716-a185555aceb0', 'App\\Models\\User'),
('9b2169b7-fe40-40d8-82d5-9ac7eb52527c', 'Auth:82'),
('9b2169b7-fe98-4ac4-997b-9536a450563b', 'Auth:82'),
('9b2169b7-fe98-4ac4-997b-9536a450563b', 'Spatie\\Permission\\Models\\Role'),
('9b2169b8-01ca-46a4-a7be-c974e5843095', 'Auth:82'),
('9b2169b8-044a-4030-a117-558a3e3217f1', 'Auth:82'),
('9b2169b8-0635-4e75-8415-64b46aa307f1', 'Auth:82'),
('9b2169b8-07d1-4459-b89a-ef2701932749', 'Auth:82'),
('9b2169b8-0946-4327-a720-0e1ad576bfc1', 'Auth:82'),
('9b2169c8-5429-41eb-b57c-74cc549baf06', 'App\\Models\\User'),
('9b216ea2-cba8-4200-a151-3b9555b44a65', 'App\\Models\\User'),
('9b216ea2-f1ab-457f-ad0a-ec047173be50', 'Auth:82'),
('9b216ea3-7e74-4de8-9256-9a4772dfd423', 'App\\Models\\User'),
('9b216ea3-81e2-49a2-becc-eb2509d964f9', 'Auth:82'),
('9b216ea3-821e-447d-bdb2-7046818fb31f', 'Auth:82'),
('9b216ea3-821e-447d-bdb2-7046818fb31f', 'Spatie\\Permission\\Models\\Role'),
('9b216ea3-846f-4764-8332-8285b744b823', 'Auth:82'),
('9b216ea3-8645-4d8a-87a1-a370a79412aa', 'Auth:82'),
('9b216ea3-8838-4426-9d64-0278fa310466', 'Auth:82'),
('9b216ea3-8996-4594-8de8-67405603626c', 'Auth:82'),
('9b2171b7-f486-4b8c-a105-b7dcd13dd79a', 'App\\Models\\User'),
('9b2171b7-f984-4a51-b05f-1c7d50a18ddd', 'Auth:82'),
('9b2171b7-f9c8-467e-842d-faae85d7ecf4', 'Auth:82'),
('9b2171b7-f9c8-467e-842d-faae85d7ecf4', 'Spatie\\Permission\\Models\\Role'),
('9b2171b7-fc4a-4285-b289-e7b866a606ae', 'Auth:82'),
('9b2171b7-fed8-4658-b3ba-383f8f24c7e9', 'Auth:82'),
('9b2171b8-010c-485a-811b-a9061a2f5781', 'Auth:82'),
('9b2171b8-041e-4a3e-9c1c-c8a02fdca8bd', 'Auth:82'),
('9b2172c7-135d-41c6-bcab-a0ea7d87c78c', 'App\\Models\\User'),
('9b2172c7-192b-4c82-8a89-85ba2295e52d', 'Auth:82'),
('9b2172c7-198d-41ff-a0b6-04ca4667b75e', 'Auth:82'),
('9b2172c7-198d-41ff-a0b6-04ca4667b75e', 'Spatie\\Permission\\Models\\Role'),
('9b2172c7-1d30-43a8-9249-34af218fc647', 'Auth:82'),
('9b2172c7-913f-4752-a898-5a201e2a1446', 'Auth:82'),
('9b2172c7-95ac-488d-b632-80adf4e01936', 'Auth:82'),
('9b2172c7-978e-4da8-90f5-736c1a885001', 'Auth:82'),
('9b217374-e5e5-42ec-bd63-e137f72c3d1f', 'App\\Models\\User'),
('9b217374-e928-4d03-908d-a052b9942933', 'Auth:82'),
('9b217374-e968-406f-bf20-5d9a0b01b6fb', 'Auth:82'),
('9b217374-e968-406f-bf20-5d9a0b01b6fb', 'Spatie\\Permission\\Models\\Role'),
('9b217374-ebdb-446e-a028-e0018b3f5bff', 'Auth:82'),
('9b217374-edab-480f-b6fa-42841293b45c', 'Auth:82'),
('9b217374-ef62-4688-8ae7-3b3b5c4fc02d', 'Auth:82'),
('9b217374-f07a-4caa-93a1-b8fa85682f96', 'Auth:82'),
('9b217448-5530-4e2e-b623-5b7b8bf44f94', 'App\\Models\\User'),
('9b217448-5a00-409a-a1b0-0afbc5621767', 'Auth:82'),
('9b217448-5a90-4449-a492-561eafee9d5f', 'Auth:82'),
('9b217448-5a90-4449-a492-561eafee9d5f', 'Spatie\\Permission\\Models\\Role'),
('9b217448-5e4a-4c9f-bc42-24ff71be1201', 'Auth:82'),
('9b217448-639c-45ee-b01d-f884f6c0f7cb', 'Auth:82'),
('9b217448-9cea-4768-9059-916d5e0c04a9', 'Auth:82'),
('9b217448-ef30-4d5b-bd49-e5b2431d894f', 'Auth:82'),
('9b21745c-160b-4b4c-8751-17c9e3ae6a59', 'App\\Models\\User'),
('9b21745c-1997-4bbb-9c5e-7044d021e654', 'Auth:82'),
('9b21745c-19db-43f1-af4a-8b94090f5c71', 'Auth:82'),
('9b21745c-19db-43f1-af4a-8b94090f5c71', 'Spatie\\Permission\\Models\\Role'),
('9b21745c-1cee-4dc4-aed4-5e58d1873d9a', 'Auth:82'),
('9b21745c-1f29-407e-9405-031a47af9b10', 'Auth:82'),
('9b21745c-210f-4588-8398-6d929170f39b', 'Auth:82'),
('9b21745c-2285-4b15-8434-85aae92df5e0', 'Auth:82'),
('9b2174be-3c4d-48d1-a274-75affb5fd0ed', 'App\\Models\\User'),
('9b2174be-3fe3-4a89-a95f-2f259105c3f7', 'Auth:82'),
('9b2174be-aa39-47f1-aeac-a635d682eeff', 'App\\Models\\User'),
('9b2174be-af34-4d2d-8b2c-86cdbedd9549', 'Auth:82'),
('9b2174be-afa3-43e6-bbdd-5599ff58e46a', 'Auth:82'),
('9b2174be-afa3-43e6-bbdd-5599ff58e46a', 'Spatie\\Permission\\Models\\Role'),
('9b2174be-b2eb-48e8-a066-28a2f12adb68', 'Auth:82'),
('9b2174be-b38d-41ee-a1a2-25e6c7e62af3', 'Auth:82'),
('9b2174be-b6aa-4f4d-856a-a79dab50997d', 'Auth:82'),
('9b2174be-b841-4668-8ba5-3653bc3edb8c', 'Auth:82'),
('9b21751d-c19d-4fb4-bdd4-9eafb37442ca', 'App\\Models\\User'),
('9b21751d-c63b-4788-b369-a0cb3cabfd25', 'Auth:82'),
('9b21751d-c69e-4251-aed3-0daff595664a', 'Auth:82'),
('9b21751d-c69e-4251-aed3-0daff595664a', 'Spatie\\Permission\\Models\\Role'),
('9b21751d-c8f3-4209-ba92-ac70f30aafdd', 'Auth:82'),
('9b21751d-ccab-4a14-bbec-01107e8e365a', 'Auth:82'),
('9b21751d-cf5d-4faa-af4c-5eec9d7f1544', 'Auth:82'),
('9b21751d-d0d2-4b4d-9e96-f15dbd813b0d', 'Auth:82'),
('9b2175a3-fda2-4bb7-a3d5-1cbfab2d6802', 'App\\Models\\User'),
('9b2175a4-03f5-46ef-a7c1-e400c68a4632', 'Auth:82'),
('9b2175a4-045b-4bff-b3e5-631d8cd71c17', 'Auth:82'),
('9b2175a4-045b-4bff-b3e5-631d8cd71c17', 'Spatie\\Permission\\Models\\Role'),
('9b2175a4-07b2-4da3-840e-1dee05a96fb9', 'Auth:82'),
('9b2175a4-0ae2-4468-8d2b-efb0f23cab7b', 'Auth:82'),
('9b2175a4-0d97-49cc-bdc6-f631a30cff03', 'Auth:82'),
('9b2175a4-0f4c-4643-b0b3-3594290173eb', 'Auth:82'),
('9b2175bc-6d71-40f0-9e97-0d91c05a6caa', 'App\\Models\\User'),
('9b2175bc-732c-4550-a1aa-3e17fcf14b76', 'Auth:82'),
('9b2175bc-73a0-4b85-ab47-6c4af90802dc', 'Auth:82'),
('9b2175bc-73a0-4b85-ab47-6c4af90802dc', 'Spatie\\Permission\\Models\\Role'),
('9b2175bc-7710-4447-85ad-e5907d522c7d', 'Auth:82'),
('9b2175bc-77de-4ff1-91fb-5d604dc32fd6', 'Auth:82'),
('9b2175bc-7b5f-4821-801e-8738af0f4a38', 'Auth:82'),
('9b2175bc-7cf5-43e7-a8cf-1c38b209a295', 'Auth:82'),
('9b2175e9-436d-4f88-86a6-38f966a73c11', 'App\\Models\\User'),
('9b2175e9-4a36-4014-867e-afb0397ee661', 'Auth:82'),
('9b2175e9-4ac9-4503-827e-615fec5d10da', 'Auth:82'),
('9b2175e9-4ac9-4503-827e-615fec5d10da', 'Spatie\\Permission\\Models\\Role'),
('9b2175e9-4ef6-4f86-857f-c8499df35dce', 'Auth:82'),
('9b2175e9-4f9f-4e4e-bd30-6c92fa0026e2', 'Auth:82'),
('9b2175e9-5364-4d35-a475-b834406b8d7f', 'Auth:82'),
('9b2175e9-5509-436d-97cd-ff69ba44a1f6', 'Auth:82'),
('9b21762a-3947-43e5-a71c-e1f1c56e0ce7', 'App\\Models\\User'),
('9b21762a-3ee8-42b5-b2a4-06bbdc26f3bf', 'Auth:82'),
('9b21762a-3f60-45ee-9677-00290a0b1afe', 'Auth:82'),
('9b21762a-3f60-45ee-9677-00290a0b1afe', 'Spatie\\Permission\\Models\\Role'),
('9b21762a-42df-4fce-80d0-16b4bdba6515', 'Auth:82'),
('9b21762a-4656-4e76-bfcb-2ebd93d13b9e', 'Auth:82'),
('9b21762a-4a94-4ab7-b46a-762b439aea20', 'Auth:82'),
('9b21762a-4c57-4643-81d5-5bc9afbfe0fe', 'Auth:82'),
('9b217670-2e23-4d04-9359-d25ecab04348', 'App\\Models\\User'),
('9b217670-3331-46ee-af6e-583dc3671f5a', 'Auth:82'),
('9b217670-3391-436b-9419-1c99680f004c', 'Auth:82'),
('9b217670-3391-436b-9419-1c99680f004c', 'Spatie\\Permission\\Models\\Role'),
('9b217670-367a-413e-9051-921aa6b7e4ac', 'Auth:82'),
('9b217670-3828-46a1-96d5-18d61bdce6ac', 'Auth:82'),
('9b217670-3a8f-4451-90e1-d63da33822ff', 'Auth:82'),
('9b217670-3bb9-4184-bfaf-8964550cdb50', 'Auth:82'),
('9b2176a5-7920-47af-aac4-f669870437e8', 'App\\Models\\User'),
('9b2176a5-803f-4601-aae6-96be42b6f370', 'Auth:82'),
('9b2176a5-80a9-4856-874d-b0caf196f42a', 'Auth:82'),
('9b2176a5-80a9-4856-874d-b0caf196f42a', 'Spatie\\Permission\\Models\\Role'),
('9b2176a5-84b1-4b69-a6e1-179f0f38836e', 'Auth:82'),
('9b2176a5-86fa-4da6-a0d2-cc5e4bf71962', 'Auth:82'),
('9b2176a5-8ac9-422c-ab84-f7b0de1ea7f7', 'Auth:82'),
('9b2176a5-8c74-4ed1-80ff-ab791f300e20', 'Auth:82'),
('9b217745-bde9-4a19-8175-7e9faf41e64f', 'App\\Models\\User'),
('9b217745-c2aa-40df-a0af-ebb4df3a296d', 'Auth:82'),
('9b217745-c330-47f5-bbb6-74419a176b31', 'Auth:82'),
('9b217745-c330-47f5-bbb6-74419a176b31', 'Spatie\\Permission\\Models\\Role'),
('9b217745-c623-4ff6-9278-ffb52ce62933', 'Auth:82'),
('9b217745-c7a1-4451-941d-fb02dda0a5c1', 'Auth:82'),
('9b217745-c996-4061-bb05-729f2b60f63d', 'Auth:82'),
('9b217745-cbad-4056-8d3c-ff6f68bcc42f', 'Auth:82'),
('9b217795-e5f9-4e76-9715-ec2077801fd1', 'App\\Models\\User'),
('9b217795-ec70-4019-8535-90976d31c285', 'Auth:82'),
('9b217795-eccf-497b-8969-903df1f1cddc', 'Auth:82'),
('9b217795-eccf-497b-8969-903df1f1cddc', 'Spatie\\Permission\\Models\\Role'),
('9b217795-f141-486f-ad06-4ad169247bd6', 'Auth:82'),
('9b217795-f33e-4e54-9ab3-2711c65b7cc8', 'Auth:82'),
('9b217795-f78d-4f71-bf25-15e35faf3007', 'Auth:82'),
('9b217795-f94a-4687-aca7-12eb6695ab53', 'Auth:82'),
('9b2177c6-a514-446a-b265-f6ba2ce52091', 'App\\Models\\User'),
('9b2177c6-ab18-4207-9a99-f7d2b24e7480', 'Auth:82'),
('9b2177c6-aba7-49bb-b8f8-40509834caf4', 'Auth:82'),
('9b2177c6-aba7-49bb-b8f8-40509834caf4', 'Spatie\\Permission\\Models\\Role'),
('9b2177c6-afb0-4bf6-b0cb-b56ea324c29a', 'Auth:82'),
('9b2177c6-b04a-4a06-b359-3718acccf4f8', 'Auth:82'),
('9b2177c6-b4c5-4db6-a4e0-8476877955c3', 'Auth:82'),
('9b2177c6-b6a9-42e1-8738-a41897e62e5b', 'Auth:82'),
('9b21781a-5927-4ffa-bf44-3df7c39a2f14', 'App\\Models\\User'),
('9b21781a-5c12-46ef-af90-697b69be8fe6', 'Auth:82'),
('9b21781a-5c4d-4b3a-b292-bef916bfa348', 'Auth:82'),
('9b21781a-5c4d-4b3a-b292-bef916bfa348', 'Spatie\\Permission\\Models\\Role'),
('9b21781a-5f02-4910-b5bf-a4dcadef80c2', 'Auth:82'),
('9b21781a-5f5a-49c9-9a07-ce287f644def', 'Auth:82'),
('9b21781a-6108-49c8-8030-52e4a112742c', 'Auth:82'),
('9b21781a-621d-41a2-b8a1-0254221f0055', 'Auth:82'),
('9b217887-9eaa-49c8-bd77-e2e2e76dca3b', 'App\\Models\\User'),
('9b217887-a46c-415b-bfd3-5dcc5eb01f7b', 'Auth:82'),
('9b217887-a4df-4a5c-a67a-ccf9a8f4efc1', 'Auth:82'),
('9b217887-a4df-4a5c-a67a-ccf9a8f4efc1', 'Spatie\\Permission\\Models\\Role'),
('9b217887-a819-404c-8c04-a6141d3a4888', 'Auth:82'),
('9b217887-aa51-4473-8414-21fe2da0410c', 'Auth:82'),
('9b217887-ada6-4746-ba0e-1d97271291e5', 'Auth:82'),
('9b217887-af2a-4a8a-8243-dc84bec8f265', 'Auth:82'),
('9b21792b-dae1-41f4-a8c7-e103c12d711d', 'App\\Models\\User'),
('9b21792b-df38-4d8e-a9e7-3d27eaf4a641', 'Auth:82'),
('9b21792b-dfa5-4a72-b8d1-562994ecd36c', 'Auth:82'),
('9b21792b-dfa5-4a72-b8d1-562994ecd36c', 'Spatie\\Permission\\Models\\Role'),
('9b21792b-e350-4ed3-80f4-2543a2138f6f', 'Auth:82'),
('9b21792b-e49c-481f-b571-5c794feedc44', 'Auth:82'),
('9b21792b-e762-4c38-80e9-fd3def4f0538', 'Auth:82'),
('9b21792b-e93f-4561-98f7-c13c5dfab4b6', 'Auth:82'),
('9b21796d-e3b4-4d2e-8434-e22245fffecd', 'App\\Models\\User'),
('9b21796d-e8f8-403c-b92c-5a376cc2f5ed', 'Auth:82'),
('9b21796d-e994-4337-a453-8c0de8248bca', 'Auth:82'),
('9b21796d-e994-4337-a453-8c0de8248bca', 'Spatie\\Permission\\Models\\Role'),
('9b21796d-ecd5-4a63-9833-4f96df7f164f', 'Auth:82'),
('9b21796d-ed3f-4bed-9498-cf404ee85f59', 'Auth:82'),
('9b21796d-f024-4e2d-a3d9-4d2d3a9f581f', 'Auth:82'),
('9b21796d-f1a4-4ed3-bee5-7e9aa56e90d5', 'Auth:82'),
('9b21797e-71d8-4034-983d-56abae0e802a', 'App\\Models\\User'),
('9b21797e-7523-4d0c-8648-b59d67513182', 'Auth:82'),
('9b21797e-755d-4110-aac1-e5e3c15e82ca', 'Auth:82'),
('9b21797e-755d-4110-aac1-e5e3c15e82ca', 'Spatie\\Permission\\Models\\Role'),
('9b21797e-78b0-4e8e-8359-556987ac3f9a', 'Auth:82'),
('9b21797e-7933-4cd8-bec5-3110028a9d7c', 'Auth:82'),
('9b21797e-7ba4-4333-8262-2f1287d37241', 'Auth:82'),
('9b21797e-7d7c-4697-9532-fb1e45ce82d1', 'Auth:82'),
('9b217982-2417-4679-9c88-6475692b63d9', 'App\\Models\\User'),
('9b217982-28be-434f-b7bd-9b0ddfd9a3fe', 'Auth:82'),
('9b217982-d43e-49fb-8f11-e7da4ea43ff7', 'App\\Models\\User'),
('9b217982-e3b7-47e8-b13f-f90f59d66d04', 'Auth:82'),
('9b217982-e42c-4b9d-a445-cd2c08f5f9b3', 'Auth:82'),
('9b217982-e42c-4b9d-a445-cd2c08f5f9b3', 'Spatie\\Permission\\Models\\Role'),
('9b217982-e799-4d6e-b989-9b80b2ecb5d5', 'Auth:82'),
('9b217982-e836-4a3a-9c2b-1620d8b0cb14', 'Auth:82'),
('9b217982-eb42-4631-a3ad-a2ba86fcd389', 'Auth:82'),
('9b217982-ecae-4aa0-8765-4768a4cbdfb7', 'Auth:82'),
('9b21798b-7bb4-4d00-acc3-b4de18283f52', 'App\\Models\\User'),
('9b2179bc-972c-4875-9b51-e9174401220f', 'App\\Models\\User'),
('9b2179ca-fc66-4ec6-9ef7-b791b2d37f25', 'App\\Models\\User'),
('9b2179cb-227c-4262-b150-a3250b896dcc', 'Auth:1'),
('9b2179cb-22e4-48bd-8c28-5ef1c4f3a254', 'Auth:1'),
('9b2179cb-2744-4303-a8ab-5a26bc23c356', 'Auth:1'),
('9b2179cb-c970-4820-9e21-6ba9d42b853b', 'App\\Models\\User'),
('9b2179cb-cf23-4517-843d-4812e66c0e93', 'Auth:1'),
('9b2179cb-cf6a-4002-b6b1-fdcac302df6c', 'Auth:1'),
('9b2179cb-cf6a-4002-b6b1-fdcac302df6c', 'Spatie\\Permission\\Models\\Role'),
('9b2179cb-d1ca-4e60-8733-b154e247fa0d', 'Auth:1'),
('9b2179cb-d233-41af-af6d-cce38deabc0d', 'Auth:1'),
('9b2179cb-d44c-4e30-8d17-bf798fde751e', 'Auth:1'),
('9b2179cb-d50c-435e-9b26-3ef7b36e7a50', 'Auth:1'),
('9b2179cb-d690-4658-89d0-69d2dff40a53', 'Auth:1'),
('9b2256a5-e9ad-4286-b915-9b7f1f8f5849', 'App\\Models\\User'),
('9b2256a6-1a87-47a8-82aa-36faeb339cab', 'Auth:82'),
('9b2256a7-6209-40cc-9c51-a89d507f763b', 'App\\Models\\User'),
('9b2256a7-7126-4691-aaee-684195da89ef', 'Auth:82'),
('9b2256a7-7198-4b1b-bdd0-c901e95417b9', 'Auth:82'),
('9b2256a7-7198-4b1b-bdd0-c901e95417b9', 'Spatie\\Permission\\Models\\Role'),
('9b2256a7-75ad-4ed0-85f6-794f90c4c24f', 'Auth:82'),
('9b2256a7-7d45-4d87-9c9d-52a34487a358', 'Auth:82'),
('9b2256a7-83d7-4fbb-915b-a805b799e074', 'Auth:82'),
('9b2256a7-88b7-4c5b-8831-bbe742221cdc', 'Auth:82'),
('9b2256a7-8ac2-404a-8b58-ae7bf5ef5eea', 'Auth:82'),
('9b226177-241e-44eb-92c1-7239687afb31', 'App\\Models\\User'),
('9b226177-26c1-4be0-a574-91b15ba6f5f4', 'Auth:82'),
('9b226177-2701-4474-95a4-05720c36707f', 'App\\Models\\studentModel'),
('9b226177-2701-4474-95a4-05720c36707f', 'Auth:82'),
('9b226177-b160-4149-b8e5-4072e852a6a8', 'Auth:82'),
('9b226177-b65f-422f-bb96-bfa8f1565b5e', 'Auth:82'),
('9b226177-dd61-454f-adb5-ecc2e101bf10', 'Auth:82'),
('9b2263f2-65f0-4234-9387-97df7b1ad2b8', 'App\\Models\\User'),
('9b2263f2-6785-495e-b09a-480edb1f025a', 'Auth:82'),
('9b2263f2-67d4-4d72-b5b0-35491c6d2f53', 'App\\Models\\studentModel'),
('9b2263f2-67d4-4d72-b5b0-35491c6d2f53', 'Auth:82'),
('9b2263f2-69c3-4c93-8ed9-1d71224d5a2f', 'Auth:82'),
('9b2263f2-69fd-48e3-ae74-55487712fd48', 'App\\Models\\Applicant'),
('9b2263f2-69fd-48e3-ae74-55487712fd48', 'Auth:82'),
('9b2263f2-6ae4-4e66-9c23-cf96341e306c', 'Auth:82'),
('9b2263f2-6b1a-44cf-802c-286f05ed892d', 'app\\Models\\Batch'),
('9b2263f2-6b1a-44cf-802c-286f05ed892d', 'Auth:82'),
('9b2263f2-6e0d-4356-976d-0b25b089ad28', 'Auth:82'),
('9b2263f2-7dbb-4d45-8439-968b2ce51368', 'Auth:82'),
('9b22654c-497c-4324-93a8-7a347fef04af', 'App\\Models\\User'),
('9b22654c-4b35-4a7e-b3ce-def6d1895d13', 'Auth:82'),
('9b22654c-4b73-4e57-97bc-0b811c42e03b', 'App\\Models\\studentModel'),
('9b22654c-4b73-4e57-97bc-0b811c42e03b', 'Auth:82'),
('9b22654c-4cc6-40ca-b038-f7fc15c393ba', 'Auth:82'),
('9b22654c-4d03-4866-a75e-5af75a44b14e', 'App\\Models\\Applicant'),
('9b22654c-4d03-4866-a75e-5af75a44b14e', 'Auth:82'),
('9b22654c-4dba-43b9-b8bf-a997a9212a59', 'Auth:82'),
('9b22654c-4df6-4b3d-978d-ded780810d19', 'app\\Models\\Batch'),
('9b22654c-4df6-4b3d-978d-ded780810d19', 'Auth:82'),
('9b22654c-513e-4db4-843d-de835af5daeb', 'Auth:82'),
('9b22654c-6068-4f99-900d-8fa88b77b778', 'Auth:82');

-- --------------------------------------------------------

--
-- Table structure for table `telescope_monitoring`
--

CREATE TABLE `telescope_monitoring` (
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `center` bigint(20) UNSIGNED DEFAULT NULL,
  `desig` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `profile_pic`, `remember_token`, `created_at`, `updated_at`, `center`, `desig`) VALUES
(1, 'chamidu', 'chamidu', 'user@gmail.com', NULL, '$2y$10$tm/2A6YGZtZHycjzqg.PVOZwUf9zwYC561FZhyNNffuDle8rw.BoO', '1_1710053009.png', '', '2023-01-17 01:08:51', '2024-03-10 01:13:29', 1, 'admin'),
(2, 'devaka', 'devaka', 'dd@gmail.com', NULL, '$2y$10$BX2t1bbQZX79a7flscGYkeJXnlTH900PwfGAq6qRaFsQ1fJNH9sQq', NULL, '', '2023-01-17 01:08:51', '2023-01-26 09:24:40', 1, 'admin'),
(82, 'nimal', '790890144V', 'chamidudevaka@gmail.com', NULL, '$2y$10$N7lIpopMV/jwfHz1aJbn7OQS4ekO1if8QRw.0CbmM97EFZEh/rM/2', '82_1679328048.png', NULL, '2023-03-20 10:29:47', '2023-03-20 10:30:48', 1, 'student'),
(83, 'amal', '860890132V', 'amal@1979.com', NULL, '$2y$10$MjzWzHAyC8QkP/y8zKIk0unXNJUTBlhxBmvv0N5nQmVINGadbl0eS', NULL, NULL, '2023-04-05 11:24:43', '2023-04-05 11:24:43', 1, 'student'),
(84, 'devaka de silva', '800890132V', 'xyzr@gmail.com', NULL, '$2y$10$hvx4Frwgg7E.Tml48NfbmeWYODgYRT1yAIh13HjXZP.F4q2A8EYeS', '84_1683643173.png', NULL, '2023-05-09 09:07:54', '2023-05-09 09:09:33', 1, 'student'),
(85, 'kamal de silva', '490123123V', 'kamal@gmail.com', NULL, '$2y$10$Ffc.h8VW.D0Q5x2WhhuYSOFnwgXUV7mG31ahgPfbxt4LLoA32j7oi', '85_1683651553.png', NULL, '2023-05-09 11:28:07', '2023-05-09 11:29:13', 1, 'student'),
(87, 'nevindi', '860892132V', 'nevindi@abc.com', NULL, '$2y$10$Cp.0QL1bggNR8T3YWIpcs.8OI3W4luGgFyl8c3M6ngLqLS3Nr4IDu', NULL, NULL, '2023-08-25 15:13:09', '2023-08-25 15:13:09', 1, 'student'),
(90, 'prasith', '198321903550', 'prasith@gmail.com', NULL, '$2y$10$IqVORmKe8m2hf5Y27kNDC.9VKB8dmEq2B3RrZU.ifa.vtKHiJc3Hq', NULL, NULL, '2023-09-19 23:48:12', '2023-09-19 23:48:12', 1, 'student'),
(91, 'amal de silava', 'aaaaa', 'amal@mail.com', NULL, '$2y$10$3XSiNXzfW789mc3UujI6quuzJhf4W2CSMc0D8ftHqJHX7pOpoa0Ly', NULL, NULL, '2023-09-21 09:33:51', '2023-09-21 09:33:51', 1, 'academic'),
(92, 'vimal', 'www', 'chamidu49@yahoo.com', NULL, '$2y$10$lMAgZvnWeZ9n.9g2Myqfu.f/Xs7hcdgIJElY5uOt8iDPySGxG8nla', NULL, NULL, '2023-09-21 09:46:18', '2023-09-21 09:46:18', 1, 'academic'),
(93, 'lisala', 'devakavcv', 'admin@gmail.com', NULL, '$2y$10$2OgmxAERgC5pMXds4kKTEu5vkaaQ9Z8ootVi02eE6K5QbEyYDhuWC', NULL, NULL, '2023-09-23 20:41:15', '2023-09-23 20:41:15', 1, 'academic'),
(95, 'disuls', 'disuls', 'ueser@gmail.com', NULL, '$2y$10$Alt1JSOi3csjnioDBkSpWunPlu/syFgrchmfL5kQ8hhx5pOzGjzhG', NULL, NULL, '2023-09-23 20:43:45', '2023-09-23 20:43:45', 1, 'academic'),
(96, 'sakuni', 'dimu', 'usser@gmail.com', NULL, '$2y$10$CRNWiJe4OVxkY/cQXhKgp.wOY0DJA2ZBDC5OEAa4yqR/sq6w/5kaG', NULL, NULL, '2023-09-23 22:42:50', '2023-09-23 22:42:50', 1, 'academic');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acadamiccalenders`
--
ALTER TABLE `acadamiccalenders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batchsubjects`
--
ALTER TABLE `batchsubjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `centers`
--
ALTER TABLE `centers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `centers_managerid_foreign` (`managerid`);

--
-- Indexes for table `coursemodels`
--
ALTER TABLE `coursemodels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coursesubjects`
--
ALTER TABLE `coursesubjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_types`
--
ALTER TABLE `doc_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_docs`
--
ALTER TABLE `job_docs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_prmsn_id_fgn` (`role_id`);

--
-- Indexes for table `student_models`
--
ALTER TABLE `student_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_payments_models`
--
ALTER TABLE `student_payments_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjectteacher`
--
ALTER TABLE `subjectteacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `telescope_entries_tags`
--
ALTER TABLE `telescope_entries_tags`
  ADD KEY `telescope_entries_tags_entry_uuid_tag_index` (`entry_uuid`,`tag`),
  ADD KEY `telescope_entries_tags_tag_index` (`tag`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_ctr_frgn` (`center`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acadamiccalenders`
--
ALTER TABLE `acadamiccalenders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `batchsubjects`
--
ALTER TABLE `batchsubjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `centers`
--
ALTER TABLE `centers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coursemodels`
--
ALTER TABLE `coursemodels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `coursesubjects`
--
ALTER TABLE `coursesubjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `doc_types`
--
ALTER TABLE `doc_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job_docs`
--
ALTER TABLE `job_docs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_models`
--
ALTER TABLE `student_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_payments_models`
--
ALTER TABLE `student_payments_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `subjectteacher`
--
ALTER TABLE `subjectteacher`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_prmsn_id_fgn` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_prmsn_prmsn_id_fgn` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `telescope_entries_tags`
--
ALTER TABLE `telescope_entries_tags`
  ADD CONSTRAINT `telescope_entries_tags_entry_uuid_foreign` FOREIGN KEY (`entry_uuid`) REFERENCES `telescope_entries` (`uuid`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ctr_frgn` FOREIGN KEY (`center`) REFERENCES `centers` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
