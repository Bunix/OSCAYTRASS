-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2019 at 10:45 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rpodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(5) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `type`) VALUES
(1, 'Admin'),
(2, 'Club Admin'),
(3, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `id` int(5) NOT NULL,
  `club_acronym` varchar(25) NOT NULL,
  `club_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fb_link` text NOT NULL,
  `website` text NOT NULL,
  `coord_long` varchar(20) NOT NULL,
  `coord_lat` varchar(20) NOT NULL,
  `date_subscribe` datetime NOT NULL,
  `date_expired` datetime NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`id`, `club_acronym`, `club_name`, `address`, `contact`, `email`, `fb_link`, `website`, `coord_long`, `coord_lat`, `date_subscribe`, `date_expired`, `logo`) VALUES
(9, 'VFJQQw==', 'VEFHVUlHIFJBQ0lORyBQSUdFT04gQ0xVQg==', 'MjYxLTEzNyBNLiBILiBkZWwgUGlsYXIsIE1hbmlsYSwgMTYzMCBNZXRybyBNYW5pbGEsIFRhZ3VpZyBDaXR5', 'MDkyMjM0NTEyMw==', 'dHJwY0BnbWFpbC5jb20=', 'aHR0cHM6Ly93d3cuZmFjZWJvb2suY29tL2dyb3Vwcy8xMDk2ODY5MzMzNzc2MDE5Lw==', '', 'MTIxLjA2Mjg5Nw==', 'MTQuNTMzNTM=', '2019-06-20 20:52:58', '2020-06-10 08:00:00', 'club_logo/9.jpeg'),
(10, 'UFBSQw==', 'UGhpbGlwcGluZSBQaWdlb24gUmFjaW5nIENsdWI=', '', '', '', '', '', '', '', '2019-06-20 20:54:36', '2021-06-20 08:00:00', ''),
(11, 'Q1BSQw==', 'Q2F2aXRlIFBpZ2VvbiBSYWNpbmcgQ2x1Yg==', '', '', '', '', '', '', '', '2019-06-20 20:55:11', '2022-06-20 08:00:00', 'club_logo/11.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `club_joined_members`
--

CREATE TABLE `club_joined_members` (
  `id` int(50) NOT NULL,
  `uid` int(50) NOT NULL,
  `cid` int(10) NOT NULL,
  `cmid` varchar(50) NOT NULL,
  `loft_name` varchar(255) NOT NULL,
  `name` varchar(200) NOT NULL,
  `scty_code` varchar(50) NOT NULL,
  `d_t_joined` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `club_joined_members`
--

INSERT INTO `club_joined_members` (`id`, `uid`, `cid`, `cmid`, `loft_name`, `name`, `scty_code`, `d_t_joined`) VALUES
(4, 8, 9, 'VC0xMjM0', 'QW5idSBMb2Z0', 'T2N0b2JlciBOYXNo', 'T2N0b2JlciBOYXNoVC0xMjM0', '2019-06-20 13:42:25'),
(7, 8, 11, 'Q1JQQy0yMjI=', 'QW5idSBMb2Z0', 'T2N0b2JlciBOYXNo', 'T2N0b2JlciBOYXNoQ1JQQy0yMjI=', '2019-06-20 13:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `club_members`
--

CREATE TABLE `club_members` (
  `id` int(50) NOT NULL,
  `cid` int(10) NOT NULL,
  `member_club_id` varchar(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `loft_name` varchar(150) NOT NULL,
  `coord_long` varchar(50) NOT NULL,
  `coord_lat` varchar(50) NOT NULL,
  `secret_code` varchar(50) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `d_joined` date NOT NULL,
  `d_t_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `club_members`
--

INSERT INTO `club_members` (`id`, `cid`, `member_club_id`, `name`, `address`, `contact`, `email`, `loft_name`, `coord_long`, `coord_lat`, `secret_code`, `photo`, `d_joined`, `d_t_update`) VALUES
(31, 9, 'VC0xMjM0', 'T2N0b2JlciBOYXNo', 'MTcxIEUgMjR0aCBTdFxyXG4=', 'MDMtODE3NC05MTIz', 'cmViYmVjY2EuZGlkaW9AZGlkaW8uY29tLmF1', 'QW5idSBMb2Z0', 'MTIxLjA2NjU5OA==', 'MTQuNTMyNTE3', 'T2N0b2JlciBOYXNoVC0xMjM0', 'profile_pic/31.jpeg', '2019-06-01', '2019-06-20 13:28:25'),
(32, 9, 'VC0yMzQx', 'TGlseWFubiBRdWlsbGVu', 'MjIyMjIgQWNvbWEgU3Rcclxu', 'MDctOTk5Ny0zMzY2', 'c3RldmllLmhhbGxvQGhvdG1haWwuY29t', 'S2FtYWdvbmcgTG9mdA==', 'MTIxLjA2MjIzMQ==', 'MTQuNTM1MTI0', 'TGlseWFubiBRdWlsbGVuVC0yMzQx', 'profile_pic/32.jpeg', '2019-06-02', '2019-06-20 13:28:52'),
(33, 11, 'Q1JQQy0yMjI=', 'T2N0b2JlciBOYXNo', 'MTcxIEUgMjR0aCBTdFxyXG4=', 'MDMtODE3NC05MTIz', 'cmViYmVjY2EuZGlkaW9AZGlkaW8uY29tLmF1', 'QW5idSBMb2Z0', 'MTIxLjA2NjU5OA==', 'MTQuNTMyNTE3', 'T2N0b2JlciBOYXNoQ1JQQy0yMjI=', 'profile_pic/33.jpeg', '2019-06-17', '2019-06-22 08:21:26');

-- --------------------------------------------------------

--
-- Table structure for table `club_officers`
--

CREATE TABLE `club_officers` (
  `id` int(50) NOT NULL,
  `cid` int(10) NOT NULL,
  `name` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `position` varchar(255) NOT NULL,
  `d_position` date NOT NULL,
  `photo` varchar(100) NOT NULL,
  `remarks` text NOT NULL,
  `d_t_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `club_officers`
--

INSERT INTO `club_officers` (`id`, `cid`, `name`, `address`, `contact`, `email`, `position`, `d_position`, `photo`, `remarks`, `d_t_update`) VALUES
(7, 9, 'S2FteWEgSG93ZQ==', 'NDMxNTcgQ3lwcmVzcyBTdFxyXG4=', 'MDctNzk3Ny02MDM5', 'c2hhd25hLmFsYnJvdWdoQGFsYnJvdWdoLmNvbS5hdQ==', 'UHJlc2lkZW50', '2019-06-07', 'officer_photo/7.jpeg', '', '2019-06-20 13:31:18'),
(8, 9, 'U2VyZW5hIEVsZXk=', 'NiBTIEhhbm92ZXIgQXZlXHJcbg==', 'MDgtODM0NC04OTI5', 'cGF1bGluYV9tYWtlckBtYWtlci5uZXQuYXU=', 'T3JnYW5pemVy', '2019-06-02', 'officer_photo/8.jpeg', '', '2019-06-20 13:31:30');

-- --------------------------------------------------------

--
-- Table structure for table `club_rings`
--

CREATE TABLE `club_rings` (
  `id` int(50) NOT NULL,
  `cid` int(10) NOT NULL,
  `ring_nr` varchar(50) NOT NULL,
  `d_acquired` date NOT NULL,
  `race_cat_id` int(50) NOT NULL,
  `owner_cmid` int(50) NOT NULL,
  `d_entered` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `club_rings`
--

INSERT INTO `club_rings` (`id`, `cid`, `ring_nr`, `d_acquired`, `race_cat_id`, `owner_cmid`, `d_entered`) VALUES
(14, 9, 'TkRSLTIwMTktVC0xMjM=', '2019-06-04', 3, 31, '2019-06-20 13:34:20'),
(15, 9, 'TkRSLTIwMTktVC0xMjQ=', '2019-06-06', 3, 32, '2019-06-20 13:34:54');

-- --------------------------------------------------------

--
-- Table structure for table `club_schedules`
--

CREATE TABLE `club_schedules` (
  `id` int(50) NOT NULL,
  `cid` int(10) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `d_posted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `code`
--

CREATE TABLE `code` (
  `id` int(10) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `code`
--

INSERT INTO `code` (`id`, `code`) VALUES
(1, 'wJ7be1Q3Xt2hSJv4S9qMrJQTzHfpzeS+ZpKS9YzpHQx2Rc3LdkCNk8tWQdyG7tH4'),
(2, '+Qv8KKedT9DMGqd84UexwWYu3PZ8pjZgL9QkEdtP42cb8Lpj+l77MQ=='),
(3, '/vbanS4WKT9X2NbluU40cloXE09Q3ZTZFISBlC/rrGXA2p+9lxsHtQ=='),
(4, 'VzsCz/ejTtE='),
(5, 'R6CJAenMe8OqGnpXP83ZUw=='),
(6, 'ms2i/N6zuuHsi8mbviOfg=='),
(7, 'lyfgH0sDI4Y='),
(8, 'Q7Cy2T44hjddt4Y8ot4+TQ==');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id` int(5) NOT NULL,
  `color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`id`, `color`) VALUES
(1, 'Blue bar'),
(2, 'Blue bar splash'),
(3, 'Blue bar piebald'),
(4, 'Blue bar white flight'),
(5, 'Blue check'),
(6, 'Blue check splash'),
(7, 'Blue check piebald'),
(8, 'Blue check white flight'),
(9, 'Dark check'),
(10, 'Dark check splash'),
(11, 'Dark check pied'),
(12, 'Dark check white flight'),
(13, 'Red bar'),
(14, 'Red bar splash'),
(15, 'Red bar piebald'),
(16, 'Red bar white flight'),
(17, 'Red check'),
(18, 'Red check splash'),
(19, 'Red check piebald'),
(20, 'Red check white flight'),
(21, 'Recessive red'),
(22, 'Red splash'),
(23, 'Brown splash'),
(24, 'Black splash'),
(25, 'Blue splash'),
(26, 'Black'),
(27, 'White'),
(28, 'Grizzle'),
(29, 'Indigo'),
(30, 'Andalusian'),
(31, 'Slate'),
(32, 'Dark/Dirty blue bar'),
(33, 'Lavender'),
(34, 'Brown'),
(35, 'Bronze'),
(36, 'Ticked bird'),
(37, 'Yellow'),
(38, 'Recessive yellow'),
(39, 'Ash-yellow'),
(40, 'Pencil'),
(41, 'Blue check grizzle'),
(42, 'Blue bar grizzle'),
(43, 'Red grizzle'),
(44, 'Tort grizzle'),
(45, 'Homozygous grizzle'),
(46, 'Hetrozygous red grizzle'),
(47, 'Blue spread reduced'),
(48, 'Pastel pink reduced'),
(49, 'Black reduced'),
(50, 'Blue check reduced'),
(51, 'Blue bar reduced'),
(52, 'Blue check reduced'),
(53, 'Almond'),
(54, 'Classic almond'),
(55, 'Brown almond'),
(56, 'Blue almond'),
(57, 'Blue spread almond'),
(58, 'Black tiger'),
(59, 'Brown tiger'),
(60, 'Andalusian tiger'),
(61, 'Ash red opal'),
(62, 'Opal pied bar'),
(63, 'Opal check pied'),
(64, 'Recessive opal'),
(65, 'Blue bar opal'),
(66, 'Opal t-check'),
(67, 'Opal'),
(68, 'Ash red'),
(69, 'Ash red almond'),
(70, 'Dun'),
(71, 'Khaki'),
(72, 'Cream bar'),
(73, 'Milky'),
(74, 'Black mottle');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(50) NOT NULL,
  `uid` int(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `for_sale`
--

CREATE TABLE `for_sale` (
  `id` int(50) NOT NULL,
  `uid` int(50) NOT NULL,
  `pid` int(50) NOT NULL,
  `price` int(10) NOT NULL,
  `fb_link` text NOT NULL,
  `date_publish` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lost_found`
--

CREATE TABLE `lost_found` (
  `id` int(50) NOT NULL,
  `uid` int(50) NOT NULL,
  `pid` int(50) NOT NULL,
  `date_publish` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `obtain_through`
--

CREATE TABLE `obtain_through` (
  `id` int(2) NOT NULL,
  `obtain_through` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obtain_through`
--

INSERT INTO `obtain_through` (`id`, `obtain_through`) VALUES
(1, 'Purchased'),
(2, 'Hatched'),
(3, 'Gift Bird');

-- --------------------------------------------------------

--
-- Table structure for table `other_race`
--

CREATE TABLE `other_race` (
  `id` int(50) NOT NULL,
  `cid` int(50) NOT NULL,
  `type` varchar(255) NOT NULL,
  `race_point` varchar(255) NOT NULL,
  `coord_long` varchar(50) NOT NULL,
  `coord_lat` varchar(50) NOT NULL,
  `date_start` date NOT NULL,
  `date_expire` datetime NOT NULL,
  `time_release` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `other_race`
--

INSERT INTO `other_race` (`id`, `cid`, `type`, `race_point`, `coord_long`, `coord_lat`, `date_start`, `date_expire`, `time_release`) VALUES
(10, 9, 'c2FtcGxlIG90aGVyIHJhY2U=', 'bWFyaW5kdXF1ZQ==', 'MTIwLjMzNDU2', 'MTMuNDk0MjM=', '2019-06-23', '2019-06-23 19:00:00', '2019-06-23 06:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `other_race_entries`
--

CREATE TABLE `other_race_entries` (
  `id` int(50) NOT NULL,
  `cid` int(10) NOT NULL,
  `rid` int(50) NOT NULL,
  `ring_nr` varchar(50) NOT NULL,
  `loft_name` varchar(255) NOT NULL,
  `coord_lat` varchar(255) NOT NULL,
  `coord_long` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(50) NOT NULL,
  `clock` int(11) NOT NULL,
  `d_entered` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `other_race_entries`
--

INSERT INTO `other_race_entries` (`id`, `cid`, `rid`, `ring_nr`, `loft_name`, `coord_lat`, `coord_long`, `name`, `code`, `clock`, `d_entered`) VALUES
(1, 9, 10, 'VFAtMTIzNA==', 'QU5CVSBMT0ZU', 'MTIuMjM0NTY=', 'MTIwLjIyMzQ1', 'QmVyZG9uZyBLYW1vdGU=', 'ODE4MDAy', 1, '2019-06-23 06:29:12'),
(3, 9, 10, 'VFAtMjIzNDU=', 'S0FNT1RFIExPRlQ=', 'MTIuMjIyMg==', 'MTIwLjIyMjI=', 'S2Ftb3Rl', 'MjM0NTY3', 0, '2019-06-23 05:22:50');

-- --------------------------------------------------------

--
-- Table structure for table `other_race_result`
--

CREATE TABLE `other_race_result` (
  `id` int(50) NOT NULL,
  `uid` int(50) NOT NULL,
  `cid` int(50) NOT NULL,
  `rid` int(50) NOT NULL,
  `ring_nr` varchar(150) NOT NULL,
  `club` varchar(50) NOT NULL,
  `type` varchar(255) NOT NULL,
  `race_point` varchar(255) NOT NULL,
  `pt_coord_lat` varchar(255) NOT NULL,
  `pt_coord_long` varchar(255) NOT NULL,
  `name` varchar(150) NOT NULL,
  `loft_name` varchar(30) NOT NULL,
  `my_coord_lat` varchar(255) NOT NULL,
  `my_coord_long` varchar(255) NOT NULL,
  `time_release` datetime NOT NULL,
  `time_arrived` datetime NOT NULL,
  `distance` float NOT NULL,
  `code` varchar(150) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `p_achievement`
--

CREATE TABLE `p_achievement` (
  `id` int(20) NOT NULL,
  `uid` int(50) NOT NULL,
  `pid` int(50) NOT NULL,
  `achievement` longtext NOT NULL,
  `file` text NOT NULL,
  `date_time_enter` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `p_details`
--

CREATE TABLE `p_details` (
  `id` int(50) NOT NULL,
  `uid` int(20) NOT NULL,
  `ring_nr` varchar(50) NOT NULL,
  `colour` varchar(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  `strain` varchar(150) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `dam_ring_nr` varchar(20) NOT NULL,
  `sire_ring_nr` varchar(20) NOT NULL,
  `date_hatched` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `obtain_through` varchar(25) NOT NULL,
  `remarks` longtext NOT NULL,
  `photo` varchar(50) NOT NULL,
  `date_time_enter` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `code` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `p_details`
--

INSERT INTO `p_details` (`id`, `uid`, `ring_nr`, `colour`, `name`, `strain`, `gender`, `dam_ring_nr`, `sire_ring_nr`, `date_hatched`, `status`, `obtain_through`, `remarks`, `photo`, `date_time_enter`, `code`) VALUES
(11, 8, 'NDR-2019-T-123', 'Blue bar', 'Chip 01', 'Roger Florizoone', 'C', '', '', '2017-04-18', 'Active', 'Purchased', '', '', '2019-06-20 13:38:11', 222345),
(12, 8, 'PHA 22010', 'Almond', '', 'Unknown', 'H', '', '', '0000-00-00', 'Active', 'Purchased', '', '', '2019-06-20 13:39:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `race`
--

CREATE TABLE `race` (
  `id` int(50) NOT NULL,
  `cid` int(50) NOT NULL,
  `cat_id` int(50) NOT NULL,
  `type` varchar(255) NOT NULL,
  `race_point` varchar(255) NOT NULL,
  `coord_long` varchar(50) NOT NULL,
  `coord_lat` varchar(50) NOT NULL,
  `date_start` date NOT NULL,
  `date_expire` datetime NOT NULL,
  `time_release` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `race`
--

INSERT INTO `race` (`id`, `cid`, `cat_id`, `type`, `race_point`, `coord_long`, `coord_lat`, `date_start`, `date_expire`, `time_release`) VALUES
(8, 8, 2, 'c2RyIDE=', 'bWFsYXlv', 'MTIzLjc0MjM2MA==', 'MTMuMTM1NTI3', '2019-06-11', '2019-06-12 18:00:00', '2019-06-11 07:00:00'),
(9, 11, 0, 'ZnVuIHJhY2UgMjAxOQ==', 'bWFyaW5kdXF1ZQ==', 'MTIxLjk1ODU2NA==', 'MTMuNDczNTY1', '2019-06-21', '2019-06-23 09:00:00', '2019-06-21 06:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `race_category`
--

CREATE TABLE `race_category` (
  `id` int(50) NOT NULL,
  `cid` int(10) NOT NULL,
  `cat` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `race_category`
--

INSERT INTO `race_category` (`id`, `cid`, `cat`, `description`) VALUES
(3, 9, 'WUIgTkRSIDIwMTk=', 'TkRSIDIwMTkgdG8gYmUgc3RhcnRlZCBvbiAxMiBOb3ZlbWJlciAyMDE5');

-- --------------------------------------------------------

--
-- Table structure for table `race_entries`
--

CREATE TABLE `race_entries` (
  `id` int(50) NOT NULL,
  `cid` int(10) NOT NULL,
  `rid` int(50) NOT NULL,
  `member_id` int(50) NOT NULL,
  `ring_nr` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  `clock` int(11) NOT NULL,
  `d_entered` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `race_result`
--

CREATE TABLE `race_result` (
  `id` int(50) NOT NULL,
  `uid` int(50) NOT NULL,
  `member_id` int(50) NOT NULL,
  `cid` int(50) NOT NULL,
  `rid` int(50) NOT NULL,
  `ring_nr` varchar(150) NOT NULL,
  `club` varchar(50) NOT NULL,
  `type` varchar(255) NOT NULL,
  `race_point` varchar(255) NOT NULL,
  `pt_coord_lat` varchar(255) NOT NULL,
  `pt_coord_long` varchar(255) NOT NULL,
  `my_club_id` varchar(30) NOT NULL,
  `name` varchar(150) NOT NULL,
  `loft_name` varchar(30) NOT NULL,
  `my_coord_lat` varchar(255) NOT NULL,
  `my_coord_long` varchar(255) NOT NULL,
  `time_release` datetime NOT NULL,
  `time_arrived` datetime NOT NULL,
  `distance` float NOT NULL,
  `code` varchar(150) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(2) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(1, 'Active'),
(2, 'Sold'),
(4, 'Cull'),
(5, 'GB'),
(6, 'Deceased');

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE `training` (
  `id` int(50) NOT NULL,
  `uid` int(50) NOT NULL,
  `type` varchar(255) NOT NULL,
  `race_point` varchar(255) NOT NULL,
  `coord_lat` varchar(100) NOT NULL,
  `coord_long` varchar(100) NOT NULL,
  `date_start` date NOT NULL,
  `date_expire` datetime NOT NULL,
  `time_release` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `training_entries`
--

CREATE TABLE `training_entries` (
  `id` int(50) NOT NULL,
  `tid` int(50) NOT NULL,
  `uid` int(50) NOT NULL,
  `pid` int(50) NOT NULL,
  `code` int(30) NOT NULL,
  `clock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `training_result`
--

CREATE TABLE `training_result` (
  `id` int(50) NOT NULL,
  `uid` int(50) NOT NULL,
  `tid` int(50) NOT NULL,
  `pid` int(50) NOT NULL,
  `ring_nr` varchar(150) NOT NULL,
  `color` varchar(100) NOT NULL,
  `strain` varchar(255) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `type` varchar(255) NOT NULL,
  `race_point` varchar(255) NOT NULL,
  `distance` int(50) NOT NULL,
  `time_release` datetime NOT NULL,
  `time_arrived` datetime NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `code` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(20) NOT NULL,
  `type_id` int(10) NOT NULL,
  `club_id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `loft_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `coord_long` varchar(50) NOT NULL,
  `coord_lat` varchar(50) NOT NULL,
  `prof_pic` varchar(150) NOT NULL,
  `contact_nr` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_subscribe` datetime NOT NULL,
  `date_expired` datetime NOT NULL,
  `date_time_enter` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `no_records` int(6) NOT NULL,
  `un` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `type_id`, `club_id`, `username`, `password`, `fullname`, `loft_name`, `address`, `coord_long`, `coord_lat`, `prof_pic`, `contact_nr`, `email`, `date_subscribe`, `date_expired`, `date_time_enter`, `no_records`, `un`) VALUES
(3, 1, 0, 'db97675ee77eec020797aca621a0d922', 'db97675ee77eec020797aca621a0d922', 'YWRtaW4=', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2019-05-31 12:29:05', 0, ''),
(8, 3, 0, 'b56681fcbd8c6d4139550a0b41e17c11', 'd439e5e3efaf275d861f89dfa876a4f7', 'T2N0b2JlciBOYXNo', 'QW5idSBMb2Z0', 'MTcxIEUgMjR0aCBTdA==', 'MTIxLjA2NjU5OA==', 'MTQuNTMyNTE3', 'profile_pic/8.jpeg', 'MDMtODE3NC05MTIzLCAwNDU4LTY2NS0yOTA=', 'cmViYmVjY2EuZGlkaW9AZGlkaW8uY29tLmF1', '2019-06-02 08:00:00', '2019-07-02 08:00:00', '2019-06-23 05:45:24', 500, 'MDkyMjM0NTY3ODY='),
(9, 3, 0, '7f851f195e4cc3fe25f07291615ce3fe', '4efdc61d29386cbc21f1861c1d36b5ac', 'TGlseWFubiBRdWlsbGVu', '', '', '', '', '', '', '', '2019-06-10 08:00:00', '2019-08-10 08:00:00', '2019-06-20 12:43:57', 500, 'MDk5OTEyMzQ1Njc='),
(10, 3, 0, '19980c1f79ef1e95ac76801d52b29fc3', 'aec96d0306c0abc10268fe4eb95f8ca0', 'UnlsaWVnaCBIZWFk', '', '', '', '', '', '', '', '2019-06-20 08:00:00', '2019-07-20 08:00:00', '2019-06-20 12:44:52', 500, 'MDkyMjIzNDU2Nzg='),
(11, 3, 0, 'f73c664e511f426ebc77b22c855bcfcb', '4a28c3c8f26d36aebafa3b65bd181270', 'V2FsZWUgVHJpcGxldHQ=', '', '', '', '', '', '', '', '2019-06-13 08:00:00', '2019-07-13 08:00:00', '2019-06-20 12:45:40', 1000, 'MDkxNzEyMzQ1Njc='),
(12, 3, 0, '2a4f8221bd33e31dd376212adf32e22e', 'ebf0b91c5cb11ada60c0628cac576134', 'S2FyeW1lIER1bm4=', '', '', '', '', '', '', '', '2019-06-07 06:00:00', '2019-08-07 06:00:00', '2019-06-20 12:46:56', 1000000, 'MDkxNzIzNDU2Nzg='),
(13, 3, 0, '42db72dfc1c5fdad3c8ef36490dd343d', '7b3883ba7349fba992cec8e8db7e59b7', 'RXN0ZXBoYW55IFdoaXRuZXk=', '', '', '', '', '', '', '', '2019-06-11 09:00:00', '2019-09-11 09:00:00', '2019-06-20 12:48:27', 1000, 'MDkxNzM0NTY3ODk='),
(14, 3, 0, '400308925e816f46be5f44f97188463a', '6826d8d0159971b814faeff1f74376ea', 'TWFydGV6IFJob2FkZXM=', '', '', '', '', '', '', '', '2019-06-06 05:00:00', '2019-07-06 05:00:00', '2019-06-20 12:49:12', 500, 'MDk0MzEyMzQ1Njc='),
(15, 3, 0, '88816a171b720d235f065c37d909a812', '18054e01cbe27432a46cb6d968fdaa5c', 'UGF0dHkgR2lyYXJkaQ==', '', '', '', '', '', '', '', '2019-06-10 05:00:00', '2019-10-10 05:00:00', '2019-06-20 12:50:06', 500, 'MDkyMjg3NjU0MzI='),
(16, 3, 0, '402ff6429c45270c4e75934ca3abee29', '27fc5a5ffa104006ed1e7ca860b029ab', 'SmF5ZGluIFdoaXRlaGVhZA==', '', '', '', '', '', '', '', '2019-06-12 08:00:00', '2019-07-12 08:00:00', '2019-06-20 12:51:04', 500, 'MDkxNTIzNDUxMjM='),
(17, 3, 0, '739461954994331feb010411b1d9d893', '29591f8a4a0342151279404e9954ea1d', 'UGF0dHkgTWFkZHk=', '', '', '', '', '', '', '', '2019-06-10 07:00:00', '2019-08-10 07:00:00', '2019-06-20 12:51:51', 500, 'MDkxOTY0NTIzNDE='),
(18, 2, 9, 'a5161582e0ce0f00e7ab228cc943a20d', 'd439e5e3efaf275d861f89dfa876a4f7', 'UnlkaWEgQ2hpbGRyZXNz', '', 'VGFndWln', '', '', 'admin_profile_pic/18.jpeg', 'MTIzNDU3ODk=', 'cnlkaWFAeWFob28uY29t', '2019-06-20 20:58:09', '2020-02-29 08:00:00', '2019-06-23 03:29:13', 1, 'a2Ftb3Rl'),
(19, 2, 11, '6c82dfd20cbeef59b7741ffb2b2b7dc1', '4f0f422adb933300860f117ead0c2e25', 'YEtlbm5ldCBUdWdnbGU=', '', '', '', '', 'admin_profile_pic/19.jpeg', '', '', '2019-06-20 20:58:46', '2020-10-10 08:00:00', '2019-06-20 14:01:12', 0, 'a2Vu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `club_joined_members`
--
ALTER TABLE `club_joined_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `club_members`
--
ALTER TABLE `club_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `club_officers`
--
ALTER TABLE `club_officers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `club_rings`
--
ALTER TABLE `club_rings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `club_schedules`
--
ALTER TABLE `club_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `code`
--
ALTER TABLE `code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `for_sale`
--
ALTER TABLE `for_sale`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pid` (`pid`);

--
-- Indexes for table `lost_found`
--
ALTER TABLE `lost_found`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pid` (`pid`);

--
-- Indexes for table `obtain_through`
--
ALTER TABLE `obtain_through`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_race`
--
ALTER TABLE `other_race`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_race_entries`
--
ALTER TABLE `other_race_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_race_result`
--
ALTER TABLE `other_race_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `p_achievement`
--
ALTER TABLE `p_achievement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `p_details`
--
ALTER TABLE `p_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `race`
--
ALTER TABLE `race`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `race_category`
--
ALTER TABLE `race_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `race_entries`
--
ALTER TABLE `race_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `race_result`
--
ALTER TABLE `race_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_entries`
--
ALTER TABLE `training_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_result`
--
ALTER TABLE `training_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `club`
--
ALTER TABLE `club`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `club_joined_members`
--
ALTER TABLE `club_joined_members`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `club_members`
--
ALTER TABLE `club_members`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `club_officers`
--
ALTER TABLE `club_officers`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `club_rings`
--
ALTER TABLE `club_rings`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `club_schedules`
--
ALTER TABLE `club_schedules`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `code`
--
ALTER TABLE `code`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `for_sale`
--
ALTER TABLE `for_sale`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lost_found`
--
ALTER TABLE `lost_found`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `obtain_through`
--
ALTER TABLE `obtain_through`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `other_race`
--
ALTER TABLE `other_race`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `other_race_entries`
--
ALTER TABLE `other_race_entries`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `other_race_result`
--
ALTER TABLE `other_race_result`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `p_achievement`
--
ALTER TABLE `p_achievement`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `p_details`
--
ALTER TABLE `p_details`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `race`
--
ALTER TABLE `race`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `race_category`
--
ALTER TABLE `race_category`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `race_entries`
--
ALTER TABLE `race_entries`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `race_result`
--
ALTER TABLE `race_result`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `training`
--
ALTER TABLE `training`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `training_entries`
--
ALTER TABLE `training_entries`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `training_result`
--
ALTER TABLE `training_result`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
