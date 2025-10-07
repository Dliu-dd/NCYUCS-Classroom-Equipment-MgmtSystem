-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 07, 2024 at 05:02 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21678063_ncyucsie_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '文章 id',
  `title` varchar(30) NOT NULL DEFAULT '' COMMENT '標題',
  `category` varchar(50) NOT NULL DEFAULT '' COMMENT '分類',
  `content` text NOT NULL COMMENT '內文',
  `publish` tinyint(1) NOT NULL COMMENT '是否發布',
  `create_date` datetime NOT NULL COMMENT '建立日期',
  `modify_date` datetime DEFAULT NULL COMMENT '修改日期'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `category`, `content`, `publish`, `create_date`, `modify_date`) VALUES
(14, '生日快樂', '', '祝小童20歲生日快樂!\n要永遠記得樂觀進取向上，小心YMCA', 1, '2024-01-05 14:54:57', '2024-01-07 09:57:23'),
(15, '要不要一起抓寶', '', '快來加我IG!\nIG:perfectmiiia', 1, '2024-01-05 14:57:01', '2024-01-07 09:41:29'),
(16, '<快訊>許政穆教授勁爆內幕!!!!!', '', '-------------------------------------------------------------------------------------防雷線----------------------------------------------------------------------------------\n歐沒事啦\n我就知道你會想叫我們點這個公告 hehe', 1, '2024-01-05 15:00:05', '2024-01-07 10:02:15'),
(17, '許腎慨', '', '因為他期中考99分，所以沒在讀計網，在那邊攻擊我們的網站\n趕快修回去辣=', 1, '2024-01-05 15:05:19', '2024-01-07 09:43:25'),
(18, '正妹IG', '', 'tung__0105', 1, '2024-01-05 15:20:21', '2024-01-05 18:48:45'),
(21, '早睡早起', '', '睡眠不足', 1, '2024-01-05 18:01:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `classname` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `teacher` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `classroom` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `weekday` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `start` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `end` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `classname`, `teacher`, `classroom`, `weekday`, `start`, `end`) VALUES
(1, '微積分(II)', '', '401', '1', '2', '4'),
(2, '電子電路學', '', '401', '1', '5', '6'),
(3, '計算機專題(I)', '', '402', '3', '7', '9'),
(4, '系統程式', '', '402', '4', '1', '2'),
(5, '組合語言與實習', '', '402', '4', '3', '5'),
(6, '量子計算導論與程式設計', '', '403', '3', '2', '4'),
(7, '機器學習導論', '', '403', '4', '2', '4'),
(8, '程式語言學', '', '413', '1', '2', '4'),
(9, '機率學', '', '413', '1', '7', '9'),
(10, '演算法導論', '', '413', '2', '2', '4'),
(11, '圖訊辨識導論與剖析', '', '413', '3', '2', '4'),
(12, '網路程式設計', '', '413', '4', '7', '9'),
(13, '安全程式設計與駭客攻防技術', '', '415', '1', '5', '7'),
(14, '行動裝置應用程式設計', '', '415', '2', '2', '4'),
(15, '網頁程式設計', '', '415', '2', '7', '9'),
(16, '物件導向程式設計', '', '415', '3', '2', '4'),
(17, '計算機圖學', '', '415', '4', '2', '4'),
(18, '遊戲程式設計', '', '415', '5', '2', '4');

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `id` varchar(10) NOT NULL,
  `name` varchar(10) NOT NULL,
  `day` varchar(10) NOT NULL,
  `start` varchar(1) NOT NULL,
  `end` varchar(1) NOT NULL,
  `classname` varchar(20) NOT NULL,
  `teacher` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`id`, `name`, `day`, `start`, `end`, `classname`, `teacher`) VALUES
('1', '401', '', '0', '0', '', '0'),
('2', '402', '', '0', '0', '', '0'),
('3', '403', '', '0', 'o', '', '0'),
('4', '413', '', '0', '0', '', '0'),
('5', '415', '', '0', '0', '', '0'),
('6', '416', '', '0', '0', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `meetingroom`
--

CREATE TABLE `meetingroom` (
  `id` varchar(10) NOT NULL,
  `name` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meetingroom`
--

INSERT INTO `meetingroom` (`id`, `name`) VALUES
('1', '519'),
('2', '520'),
('3', '523'),
('4', '524');

-- --------------------------------------------------------

--
-- Table structure for table `reserved_classroom`
--

CREATE TABLE `reserved_classroom` (
  `id` varchar(15) NOT NULL,
  `studentid` varchar(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `classroom` varchar(3) NOT NULL,
  `item` varchar(10) NOT NULL,
  `BorrowDay` date NOT NULL,
  `weekday` varchar(1) NOT NULL,
  `start` varchar(5) NOT NULL,
  `end` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reserved_classroom`
--

INSERT INTO `reserved_classroom` (`id`, `studentid`, `username`, `classroom`, `item`, `BorrowDay`, `weekday`, `start`, `end`) VALUES
('1094841-c-1', '1094841', '李昱佑', '416', '鑰匙, 冷氣, 單槍', '2024-01-31', '3', '1', '3'),
('1112915-c-1', '1112915', '劉曉曈', '402', '冷氣', '2024-01-25', '4', '7', '8'),
('1112916-c-1', '1112916', '蔡承諭', '416', '鑰匙, 冷氣, 單槍', '2024-01-27', '', '1', '2'),
('1114536-c-2', '1114536', '劉又榛', '402', '冷氣, 單槍', '2024-02-02', '', '7', 'B'),
('1114536-c-3', '1114536', '劉又榛', '401', '鑰匙, 單槍', '2024-02-02', '', '8', '9'),
('1114536-c-5', '1114536', '劉又榛', '401', '鑰匙, 冷氣', '2024-02-11', '7', '2', '3'),
('1114536-c-6', '1114536', '劉又榛', '402', '單槍', '2024-01-17', '3', 'A', 'B'),
('1114536-c-7', '1114536', '劉又榛', '413', '單槍', '2024-01-26', '5', '9', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `reserved_item`
--

CREATE TABLE `reserved_item` (
  `id` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `studentid` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `brand` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `item` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `BorrowDay` date NOT NULL,
  `BorrowTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reserved_item`
--

INSERT INTO `reserved_item` (`id`, `studentid`, `username`, `brand`, `item`, `BorrowDay`, `BorrowTime`) VALUES
('1112915-i-1', '1112915', '劉曉曈', '筆電', '鏡頭', '2024-02-01', '22:23:00'),
('1112916-i-1', '1112916', '蔡承諭', '筆電', '充電器', '2024-02-01', '03:26:00'),
('1112916-i-2', '1112916', '蔡承諭', '筆電', '充電器', '2024-01-07', '01:30:00'),
('1112916-i-3', '1112916', '蔡承諭', 'DV', '充電器', '2024-01-23', '01:31:00'),
('1112916-i-4', '1112916', '蔡承諭', '筆電', '充電器', '2024-02-06', '14:10:00'),
('1112916-i-5', '1112916', '蔡承諭', 'DC', '傳輸線, 充電器, 鏡頭, 電池, 記憶卡', '2024-02-07', '02:13:00'),
('1112916-i-6', '1112916', '蔡承諭', '筆電', '充電器', '2024-02-07', '08:26:00'),
('1114536-i-1', '1114536', '劉又榛', 'DC', '充電器, 鏡頭', '2024-02-01', '02:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `reserved_meetingroom`
--

CREATE TABLE `reserved_meetingroom` (
  `id` varchar(15) NOT NULL,
  `studentid` varchar(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `meetingroom` varchar(3) NOT NULL,
  `teacher` varchar(5) NOT NULL,
  `item` varchar(10) NOT NULL,
  `BorrowDay` date NOT NULL,
  `start` varchar(1) NOT NULL,
  `end` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reserved_meetingroom`
--

INSERT INTO `reserved_meetingroom` (`id`, `studentid`, `username`, `meetingroom`, `teacher`, `item`, `BorrowDay`, `start`, `end`) VALUES
('1112915-m-1', '1112915', '劉曉曈', '523', '菜咪亞', '單槍', '2024-01-25', '1', '9'),
('1112915-m-2', '1112915', '劉曉曈', '520', '許政穆', '單槍', '2024-02-01', '1', 'B'),
('1112916-m-4', '1112916', '蔡承諭', '519', '曉曈學姊', '鑰匙, 單槍', '2024-01-10', 'C', 'D'),
('1112916-m-5', '1112916', '蔡承諭', '524', '劉曉曈:)', '鑰匙, 單槍', '2024-01-18', '1', '1'),
('1112916-m-6', '1112916', '蔡承諭', '523', '曉曈學姊', '單槍', '2024-01-09', 'C', 'D'),
('1112916-m-7', '1112916', '蔡承諭', '523', 'lilu', '鑰匙, 單槍', '2024-02-06', '1', '1'),
('1112916-m-8', '1112916', '蔡承諭', '523', '猜成語', '單槍', '2024-01-31', '1', '1'),
('1114536-m-1', '1114536', '劉又榛', '519', '王智弘', '鑰匙, 單槍', '2024-01-25', '1', '8'),
('1114536-m-2', '1114536', '劉又榛', '520', '王智弘', '鑰匙', '2024-02-04', '1', '2');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentid` varchar(7) NOT NULL,
  `username` varchar(5) NOT NULL,
  `password` varchar(200) NOT NULL,
  `gmail` varchar(22) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `phonenum` varchar(12) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentid`, `username`, `password`, `gmail`, `mail`, `phonenum`, `role`) VALUES
('', '寫晚誠', 'cf158c5db07314abe889d2d59e031f3930c6a026875fe274a3d0abe51dbea27f83b795c62b6be48293b9e5f009b5153435ba157712ff2eb640aa28289829b40f', 'codeblock@gmail.com', 'codeblock@gmail.com', '0900-629-993', 'others'),
('04Dm!N', '管理員', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 'csie@mail.ncyu.edu.tw', 'admin@gmail.com', '05-2717740', 'admin'),
('', 'Nancy', '3115b8e43395b0209d3705ee38e3bc1c99ee11a3dab7ff186095938bde9c67aaba0d044c3d20fa77cc30edd2f3dc5e9ceb505b53f5444f5f810c452c272e0a2d', 'geniuszhao@gmail.com', 'geniuszhao@gmail.com', '0912-345-678', 'others'),
('', '許正牧', '1c3f2226c83540c9ac8adaa3f82fc31af7d28b722289333eb8349356587b7e649a479a3d7f23cbe603c6ffb99ad4ec7d07e2b6577685b0e537443108bed24dd1', 'hjm@gmail.com', 'hjm@gmail.com', '0911-234-222', 'teacher'),
('', 'lilu', 'c81b32fa1010d5dae06e2303ba0e5c2390d19503061f6f014359b63079af796346dd109d4e662371204a757f4cca3f63db6921705da535984d3851fc3d854063', 'lilulilu@gmail.com', 'lilulilu@gmail.com', '0900-629-992', 'others'),
('1094841', '李昱佑', 'fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3eabe', 's1094841@g.ncyu.edu.tw', 's1094841@g.ncyu.edu.tw', '0963870420', 'student'),
('1102928', ' 林聖博', 'c81b32fa1010d5dae06e2303ba0e5c2390d19503061f6f014359b63079af796346dd109d4e662371204a757f4cca3f63db6921705da535984d3851fc3d854063', 's1102928@g.ncyu.edu.tw', 's1102928@g.ncyu.edu.tw', '0979-716-130', 'student'),
('1112915', '劉曉曈', 'f74f2603939a53656948480ce71f1ce466685b6654fd22c61c1f2ce4e2c96d1cd02d162b560c4beaf1ae45f3471dc5cbc1ce040701c0b5c38457988aa00fe97f', 's1112915@g.ncyu.edu.tw', 'm7006578@gmail.com.tw', '0900-629-992', 'student'),
('1112916', '蔡承諭', '48ecf6bdee06f82fb24cd70e23c0b4def3f9aed7c59c87ece93c4e698ac2de0956a253d55b3ab36d150d5859f3944a978012fd633d665a0fdaa6795513cb849d', 's1112916@g.ncyu.edu.tw', 'miayaya1391@gmail.com', '0905-502-942', 'student'),
('1112922', '顏名妤', 'd043853439443ac73ff39bf4927529a31da09c60b5e5c52b5cb2ebaefe307c60a2a50f3b32c1ba90b42de16ff7544b3aa67e7f1b8388863e35da4b91c4c48cba', 's1112922@g.ncyu.edu.tw', 'zt1711zt1711@gmail.com', '0966-516-151', 'student'),
('1112933', '謝婉成', '831a57be64e591e47568481ea43ac8d93b994fb14529c3c244948b87b77241f7bb3f097d58e6d4d3fa9cb913ef32fbf1be8d26aeb7be54427385028b2b6f6047', 's1112933@g.ncyu.edu.tw', '0998765432@gmail.com', '0998765432', 'student'),
('1112934', '醜企鵝', '659e27ba558ea9c7a1b8d0fba51be716bda3e7a9c644676a5be5031dd923fef424f2cb4fe143c89bf95856591ea43a715ff6a61ad92e5d07bbe66f96d4293d86', 's1112934@g.ncyu.edu.tw', '0923456789@gmail.com', '0923456789', 'student'),
('1112961', '橘子', 'f41a884d7a3cf5f956252117a1c0c602c0d903a64f441dbe96bb8cac06072719fc513ea7ce9f87863ca5662df8916c4b6942bbba1d38fe8fef71404b173e3a1c', 's1112961@g.ncyu.edu.tw', 'orange6636@gmail.com', '0911-111-111', 'teacher'),
('1114536', '劉又榛', '9b71d224bd62f3785d96d46ad3ea3d73319bfbc2890caadae2dff72519673ca72323c3d99ba5c11d7c7acc6e14b8c5da0c4663475c2e5c3adef46f73bcdec043', 's1114536@g.ncyu.edu.tw', 'dd@gmail.com', '0966-123-456', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `week`
--

CREATE TABLE `week` (
  `year` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `week_no` int(2) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `week`
--

INSERT INTO `week` (`year`, `week_no`, `start`, `end`) VALUES
('112-2', 1, '2024-02-18', '2024-02-24'),
('112-2', 2, '2024-02-25', '2024-03-02'),
('112-2', 3, '2024-03-03', '2024-03-09'),
('112-2', 4, '2024-03-10', '2024-03-16'),
('112-2', 5, '2024-03-17', '2024-03-23'),
('112-2', 6, '2024-03-24', '2024-03-30'),
('112-2', 7, '2024-03-31', '2024-04-06'),
('112-2', 8, '2024-04-07', '2024-04-13'),
('112-2', 9, '2024-04-14', '2024-04-20'),
('112-2', 10, '2024-04-21', '2024-04-27'),
('112-2', 11, '2024-04-28', '2024-05-04'),
('112-2', 12, '2024-05-05', '2024-05-11'),
('112-2', 13, '2024-05-12', '2024-05-18'),
('112-2', 14, '2024-05-19', '2024-05-25'),
('112-2', 15, '2024-05-26', '2024-06-01'),
('112-2', 16, '2024-06-02', '2024-06-08'),
('112-2', 17, '2024-06-09', '2024-06-15'),
('112-2', 18, '2024-06-16', '2024-06-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meetingroom`
--
ALTER TABLE `meetingroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reserved_classroom`
--
ALTER TABLE `reserved_classroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reserved_item`
--
ALTER TABLE `reserved_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reserved_meetingroom`
--
ALTER TABLE `reserved_meetingroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`gmail`);

--
-- Indexes for table `week`
--
ALTER TABLE `week`
  ADD PRIMARY KEY (`week_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '文章 id', AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
