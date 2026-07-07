-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2026 at 04:11 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `komikkami`
--

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id_chapter` int(11) NOT NULL,
  `id_komik` int(11) NOT NULL,
  `nomor_chapter` float NOT NULL,
  `judul_chapter` varchar(255) NOT NULL,
  `content_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id_chapter`, `id_komik`, `nomor_chapter`, `judul_chapter`, `content_path`) VALUES
(4, 12, 1, 'Maomao Kecebur Got', 'img/chapters/komik_12_ch_1/'),
(5, 12, 2, 'Aby Telungkup', 'img/chapters/komik_12_ch_2/'),
(6, 12, 3, 'Adit Sirazi', 'img/chapters/komik_12_ch_3/'),
(7, 13, 1, 'Biji Melayang', 'img/chapters/komik_13_ch_1/'),
(8, 13, 2, 'Biji Okarun', 'img/chapters/komik_13_ch_2/'),
(9, 14, 1, 'Bintang', 'img/chapters/komik_14_ch_1/'),
(10, 14, 2, 'Kakak Adek', 'img/chapters/komik_14_ch_2/'),
(11, 14, 3, 'Pengasuh', 'img/chapters/komik_14_ch_3/'),
(12, 15, 1, 'Mission', 'img/chapters/komik_15_ch_1/'),
(13, 16, 1, 'Chinatsu Senpai', 'img/chapters/komik_16_ch_1/'),
(14, 16, 2, 'You Have To Go To Nationals', 'img/chapters/komik_16_ch_2/'),
(15, 17, 1, 'The Legendary Hitman', 'img/chapters/komik_17_ch_1/'),
(16, 17, 2, 'Sakamoto Famliy Rules', 'img/chapters/komik_17_ch_2/'),
(17, 17, 3, 'Officer Nakase And The Mysterious Hero', 'img/chapters/komik_17_ch_3/'),
(18, 18, 1, '-', 'img/chapters/komik_18_ch_1/');

-- --------------------------------------------------------

--
-- Table structure for table `komik`
--

CREATE TABLE `komik` (
  `id_komik` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `sinopsis` text NOT NULL,
  `genre` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `artist` varchar(100) NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `tahun_rilis` varchar(4) NOT NULL,
  `status` enum('Ongoing','Completed') NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komik`
--

INSERT INTO `komik` (`id_komik`, `judul`, `sinopsis`, `genre`, `author`, `artist`, `publisher`, `tahun_rilis`, `status`, `gambar`) VALUES
(12, 'Kusuriya No Hitorigoto', 'Maomao, an apothecary daughter, has been plucked from her peaceful life and sold to the lowest echelons of the imperial court. Now merely a maid, Maomao settles into her new mundane life and hides her extensive knowledge of medicine in order to avoid any unwanted attention.\r\n\r\nNot long after Maomao arrival, the emperor infant children inexplicably begin to experience grave symptoms—almost as if a curse has been cast. The curious Maomao easily solves the mystery and, to remain out of the limelight, attempts to leave an anonymous tip. Unfortunately, the dashing and perceptive eunuch Jinshi sees through it and manages to single her out.\r\n\r\nIn recognition of her talent, Maomao is promoted to lady-in-waiting for the emperors favorite concubine, Gyokuyou. As Maomao continues to remedy the numerous ailments afflicting the imperial court, her pharmaceutical expertise quickly proves indispensable.', 'Drama, Mystery, Romance, Comedy', 'Hyūganatsu ', 'Hyūganatsu ', 'Shōsetsuka ni Narō', '2017', 'Completed', 'Apoteker.jpg'),
(13, 'Dandadan', 'Ghosts, monsters, aliens, teen romance, battles...and the kitchen sink! This series has it all! Takakura, an occult maniac who doesnt believe in ghosts, and Ayase, a girl who doesnt believe in aliens, try to overcome their differences when they encounter the paranormal! This manga is out of this world!', 'Supernatural, Comedy, School, Adult', 'Yukinobu Tatsu', 'Yukinobu Tatsu', 'Haiqal', '2020', 'Ongoing', '4b801f70.jpg'),
(14, 'Oshi No Ko', 'Four years after their birth, Ai is murdered by the same stalker, leading Aqua to deduce that their biological father, actor Hikaru Kamiki, orchestrated the crime. The twins, adopted by Ai former agency head Miyako Saitō, enter the entertainment industry: Ruby revives Ai idol group B-Komachi with actress Kana Arima and YouTuber Mem-cho, while Aqua pursues acting to investigate and exact revenge on Hikaru.', 'Drama, Mystery, Supernatural', 'Aka Akasaka', 'Mengo Yokoyari', 'Shueisha ', '2023', 'Completed', '34681579.jpg'),
(15, 'Kagurabachi', 'Young Chihiro spends his days training under his famous swordsmith father. One day he hopes to become a great sword-maker himself. The goofy father and the serious son--they thought these days would last forever. But suddenly, tragedy strikes. A dark day soaked in blood. Chihiro and his blade now live only for revenge. Epic sword battle action!f', 'Action, Dark Fantasy', 'Takeru Hokazono', 'Takeru Hokazono', 'Shueisha', '2023', 'Ongoing', '8279a189.jpg'),
(16, 'Ao No Hako', 'Taiki Inomata is on the boys badminton team at sports powerhouse Eimei Junior and Senior High. He in love with basketball player Chinatsu Kano, the older girl he trains alongside every morning in the gym. One Spring day, their relationship takes a sharp turn ... And thus begins this brand-new series of love, sports and youth!', 'Romance, Sports, Comedy, School', 'Kouji Miura', 'Kouji Miura', 'Shueisha', '2021', 'Ongoing', '8ace9f6d.jpg'),
(17, 'Sakamoto Days', 'Taro Sakamoto was the ultimate assassin, feared by villains and admired by hitmen. But one day...he fell in love! Retirement, marriage, fatherhood and then... Sakamoto gained weight! The chubby guy who runs the neighborhood store is actually a former legendary hitman! Can he protect his family from danger? Get ready to experience a new kind of action comedy series!', 'Action, Comedy, Slice Of Life', 'Yuto Suzuki', 'Yuto Suzuki', 'Shueisha', '2020', 'Ongoing', 'f2a5c7b4.jpg'),
(18, 'Lv 2 Kara Cheat', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit quo laborum architecto quisquam? A quaerat consectetur perferendis, doloremque est nam inventore obcaecati unde, eos natus eaque molestias odit corporis tempore repellat! Sapiente expedita accusamus ratione excepturi dignissimos aliquam minus dicta quo esse, nesciunt in, veniam impedit minima dolores reprehenderit dolorem sequi quod unde temporibus labore architecto! Blanditiis possimus voluptatum ipsum!', 'Comedy, Isekai, Action, Romance, Slice Of Life', 'Taufik', 'Taufik', 'Shueisha', '2021', 'Ongoing', 'k9chzfpnok941.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `username`, `password`, `role`) VALUES
(5, 'admin', '$2y$10$gDDSA0IwiDqErPII3hGHleav7aCySkTt1NjcnaFG.EK9LXsaqv8BK', 'admin'),
(9, 'aksa', '$2y$10$hqjsIdjcp2/o3WewCVUNj.ZYWaLiMynR2gp7igcpcjn/BZ6x6eIpq', 'user'),
(10, 'zayyan', '$2y$10$J29HUGRfogG9KSy757QLw.zXSKUyUY6KaNHPo525ukAfB1az5nUeO', 'admin'),
(11, 'dzakwan', '$2y$10$f7OCqu2wPO4diW9LRneZSOpZiDLdhSyzntnseSzaR31Q1SH1CW2YW', 'user'),
(12, 'rizky', '$2y$10$TAbO.LlITHLfavYP.uay1eUkZJ7EdmUN5DtTix99n29Np4xBN6DRO', 'user'),
(13, 'taufik', '$2y$10$.EouMkqccgvWZUxJWOGa1ONpW7uxWERFg1JbnnpxYzdBv7Guy08Yu', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id_chapter`),
  ADD KEY `id_komik` (`id_komik`);

--
-- Indexes for table `komik`
--
ALTER TABLE `komik`
  ADD PRIMARY KEY (`id_komik`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id_chapter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `komik`
--
ALTER TABLE `komik`
  MODIFY `id_komik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `chapters_ibfk_1` FOREIGN KEY (`id_komik`) REFERENCES `komik` (`id_komik`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
