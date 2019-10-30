-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2019 at 09:55 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

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
  `coordinate` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`id`, `club_acronym`, `club_name`, `address`, `coordinate`) VALUES
(1, 'TRPC', 'Taguig Racing Pigeon Club', '', '');

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
-- Table structure for table `p_achievement`
--

CREATE TABLE `p_achievement` (
  `id` int(20) NOT NULL,
  `uid` int(50) NOT NULL,
  `pid` int(50) NOT NULL,
  `achievement` longtext NOT NULL,
  `file` text NOT NULL,
  `date_time_enter` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `p_achievement`
--

INSERT INTO `p_achievement` (`id`, `uid`, `pid`, `achievement`, `file`, `date_time_enter`) VALUES
(3, 1, 73, 'NDR Champion 2019', '1-73-12523012_1547564758890685_4759035368963506982_n.jpg.jpeg', '2019-05-20 08:28:12'),
(5, 1, 73, 'Champion 2018', '1-73-53178311_138155863892765_4829554487989370880_n.jpg.jpeg', '2019-05-16 03:36:19'),
(8, 1, 62, 'mahusay award', '1-62-53160313_138155847226100_180881645727907840_n.jpg.jpeg', '2019-05-16 06:24:18'),
(9, 1, 62, 'SDR 2015', '', '2019-05-21 06:09:50'),
(10, 1, 62, 'SDR 2012', '', '2019-05-21 06:09:50'),
(11, 1, 69, 'NDR 2018', '', '2019-05-21 06:15:10');

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
  `date_time_enter` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `code` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `p_details`
--

INSERT INTO `p_details` (`id`, `uid`, `ring_nr`, `colour`, `name`, `strain`, `gender`, `dam_ring_nr`, `sire_ring_nr`, `date_hatched`, `status`, `obtain_through`, `remarks`, `photo`, `date_time_enter`, `code`) VALUES
(62, 1, 'au 2017 jedds 31496', 'Dark check', 'Roca-001', 'roger florizoone', 'C', '', '', '0000-00-00', 'Active', 'Gift Bird', 'GB from Bio Research dtd 06 Feb 2019', 'pigeon_photo/62.jpeg', '2019-05-26 02:33:20', 2040548621),
(64, 1, 'dbx 18 0307', 'Blue check', 'Roca-002', 'E. Debruxelles', 'H', '', '', '0000-00-00', 'Active', 'Purchased', 'Purchased from Bio Research dtd 06 April 2019', 'pigeon_photo/64.jpeg', '2019-05-26 02:31:48', 0),
(65, 1, 'dbx 18 0204', 'Blue bar', 'roca-003', 'E. Debruxelles', 'C', '', '', '0000-00-00', 'Active', 'Purchased', 'Purchased from Bio Research dtd 06 Apr 19', 'pigeon_photo/65.jpeg', '2019-05-26 02:23:17', 2040693756),
(66, 1, 'TRPC 2019 a2-1-541', 'Dark check', 'Roca-004', 'R. Florizoone x Taiwan (Unknown)', 'C', 'TFPF 2018 200092', 'AU 2017 JEDDS 31496', '2019-04-18', 'Active', 'Hatched', '', 'pigeon_photo/66.jpeg', '2019-05-26 02:23:37', 1236140866),
(67, 1, 'pnpa 12 gbh 168', 'Almond', '', 'unknown', 'H', '', '', '0000-00-00', 'Active', 'Purchased', 'Purchased from Aranque', 'pigeon_photo/67.jpeg', '2019-05-15 05:55:37', 0),
(68, 1, 'pha 2019 325798', 'Almond', '', 'unknown', 'C', '', '', '0000-00-00', 'Active', 'Purchased', 'Purchased from Aranque', 'pigeon_photo/68.jpeg', '2019-05-15 05:56:30', 0),
(69, 1, 'TFPF 2018 200092', 'Dark/Dirty', '', 'Taiwan(Unknown)', 'H', '', '', '0000-00-00', 'Active', 'Purchased', 'Purchased from Aranque', 'pigeon_photo/69.jpeg', '2019-05-15 06:16:32', 0),
(71, 2, 'aa', 'aa', 'aa', '', '', '', '', '0000-00-00', '', '', '', '', '2019-05-11 08:22:49', 0),
(73, 1, '1234', 'Ash red', '', 'sample', 'C', 'tfpf 2018 200092', 'au 2017 jedds 31496', '2019-05-12', 'Active', 'Hatched', 'sagsa ghas gah gsha gshag sgha gastuqiwgqahsjkasjkahsa gjhkasyuqihjakshajs yuaky8yq2wkjhqasjkhajks yahs jahsjas uksjkahsja shajyhkuysa', 'pigeon_photo/73.jpeg', '2019-05-27 05:45:43', 2147483647),
(74, 1, '222', 'Black mottle', '', 'secret', 'H', 'tfpf 2018 200092', 'TRPC 2019 A2-1-541', '0000-00-00', 'Active', 'Hatched', '', 'pigeon_photo/74.jpeg', '2019-05-21 07:30:14', 0),
(75, 1, '9999', 'Blue bar', 'sample', 'R. Florizoone x Taiwan (Unknown)', 'U', 'TFPF 2018 200092', 'au 2017 jedds 31496', '2019-05-05', 'Active', 'Hatched', '', '', '2019-05-15 04:04:29', 0),
(76, 1, '44444', 'Andalusian', '', 'Taiwan(Unknown)', 'C', '', '', '0000-00-00', 'Active', 'Gift Bird', '', '', '2019-05-15 04:01:09', 0),
(77, 1, '3333', 'Andalusian', '', 'R. Florizoone x Taiwan (Unknown)', 'U', 'DBX 18 0307', 'AU 2017 JEDDS 31496', '2019-05-12', 'Active', 'Hatched', '', '', '2019-05-15 04:01:35', 0),
(78, 1, '77', 'Blue bar', '', 'R. Florizoone x Taiwan (Unknown)', 'C', 'TFPF 2018 200092', 'TRPC 2019 A2-1-541', '0000-00-00', 'Active', 'Hatched', '', '', '2019-05-15 04:02:13', 0),
(79, 1, '989898', 'Black', '', 'Florizoone x Taiwan', 'U', 'TFPF 2018 200092', 'AU 2017 JEDDS 31496', '2019-05-10', 'Active', 'Hatched', '', '', '2019-05-15 04:03:43', 0);

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
(3, 'Lost'),
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
  `distance` double NOT NULL,
  `date_start` date NOT NULL,
  `date_expire` datetime NOT NULL,
  `time_release` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training`
--

INSERT INTO `training` (`id`, `uid`, `type`, `race_point`, `distance`, `date_start`, `date_expire`, `time_release`) VALUES
(9, 1, 'sprint may', 'sucat pque', 8.02, '2019-05-27', '2019-05-27 17:00:00', '2019-05-27 07:00:00');

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

--
-- Dumping data for table `training_entries`
--

INSERT INTO `training_entries` (`id`, `tid`, `uid`, `pid`, `code`, `clock`) VALUES
(54, 9, 1, 65, 2040693756, 1),
(55, 9, 1, 66, 1236140866, 1),
(56, 9, 1, 62, 2040548621, 1),
(59, 9, 1, 67, 0, 1),
(60, 9, 1, 69, 0, 1);

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
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `code` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training_result`
--

INSERT INTO `training_result` (`id`, `uid`, `tid`, `pid`, `ring_nr`, `color`, `strain`, `gender`, `type`, `race_point`, `distance`, `time_release`, `time_arrived`, `date_update`, `code`) VALUES
(55, 1, 9, 65, 'dbx 18 0204', 'Blue bar', 'E. Debruxelles', 'C', 'sprint may', 'SUCAT PQUE', 8020, '2019-05-27 07:00:00', '2019-05-27 14:03:35', '2019-05-27 06:03:35', 2040693756),
(56, 1, 9, 62, 'au 2017 jedds 31496', 'Dark check', 'Roger Florizoone', 'C', 'sprint may', 'SUCAT PQUE', 8020, '2019-05-27 07:00:00', '2019-05-27 14:03:44', '2019-05-27 06:03:44', 2040548621),
(57, 1, 9, 66, 'TRPC 2019 a2-1-541', 'Dark check', 'R. Florizoone X Taiwan (Unknown)', 'C', 'sprint may', 'SUCAT PQUE', 8020, '2019-05-27 07:00:00', '2019-05-27 14:03:46', '2019-05-27 06:03:46', 1236140866),
(58, 1, 9, 67, 'PNPA 12 GBH 168', 'Almond', 'Unknown', 'H', 'SPRINT MAY', 'SUCAT PQUE', 8020, '2019-05-27 07:00:00', '2019-05-27 14:06:00', '2019-05-27 06:06:12', 0),
(59, 1, 9, 69, 'TFPF 2018 200092', 'Dark/Dirty', 'Taiwan(Unknown)', 'H', 'SPRINT MAY', 'SUCAT PQUE', 8020, '2019-05-27 07:00:00', '2019-05-27 14:07:00', '2019-05-27 06:06:28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(20) NOT NULL,
  `type_id` int(10) NOT NULL,
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
  `date_time_enter` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `type_id`, `username`, `password`, `fullname`, `loft_name`, `address`, `coord_long`, `coord_lat`, `prof_pic`, `contact_nr`, `email`, `date_subscribe`, `date_expired`, `date_time_enter`) VALUES
(1, 3, '31ec9ae5bb8de31eda83b347b46e1333', 'd439e5e3efaf275d861f89dfa876a4f7', 'S3VydXNha2kgSWNoaWdv', 'QW5idSBMb2Z0', 'US0xMC1KIE1hY29wYSBTdC4sIEJOUywgTlNKRiwgV2VzdGVybiBCaWN1dGFuLCBUYWd1aWcgQ2l0eQ==', 'MTIgMjAgMTAuMjAwIE4=', 'MTIgMjAgMTAuMzAwIEU=', 'profile_pic/1.jpeg', 'MDk0MzEyMzQ1Ng==', 'aWNoaWdvQGdtYWlsLmNvbQ==', '2019-05-07 11:55:00', '2019-05-31 00:00:00', '2019-05-16 05:38:17'),
(2, 3, '85d92f7f71438003167168932da09b65', 'd439e5e3efaf275d861f89dfa876a4f7', 'YmVyZG9uZw==', '', '', '', '', '', '', '', '2019-05-06 22:30:00', '2019-05-06 22:30:00', '2019-05-07 12:00:30');

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
-- Indexes for table `obtain_through`
--
ALTER TABLE `obtain_through`
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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `obtain_through`
--
ALTER TABLE `obtain_through`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `p_achievement`
--
ALTER TABLE `p_achievement`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `p_details`
--
ALTER TABLE `p_details`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `training`
--
ALTER TABLE `training`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `training_entries`
--
ALTER TABLE `training_entries`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `training_result`
--
ALTER TABLE `training_result`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
