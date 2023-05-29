-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023 年 05 月 25 日 07:22
-- 伺服器版本： 10.4.28-MariaDB
-- PHP 版本： 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `test`
--

-- --------------------------------------------------------

--
-- 資料表結構 `chair`
--

CREATE TABLE `chair` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `ID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `chair`
--

INSERT INTO `chair` (`name`, `email`, `phone_number`, `ID`) VALUES
('李榮三', 'leejs@fcu.edu.tw', '0424517250#3700 #3767', 'T0001');

-- --------------------------------------------------------

--
-- 資料表結構 `conference_proceeding`
--

CREATE TABLE `conference_proceeding` (
  `ID` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `conference` varchar(255) NOT NULL,
  `page` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `conference_proceeding`
--

INSERT INTO `conference_proceeding` (`ID`, `author`, `title`, `date`, `conference`, `page`, `place`) VALUES
(1, 'Chen, T.H., Chew, C. J., Chen, Y. C., and Lee, J.S.', 'Preserving Collusion-free and Traceability in Car-sharing System based on Blockchain', '2022-12-01', 'International Computer Symposium (ICS 2022)', '1-12', 'National Taipei University of Business'),
(14, '應瑞傑、蔡國裕、李榮三、周澤捷', 'Mobile Roadside Units Clustering Protocol based on Reputation Inventory', '0000-00-00', 'Cryptology and Information Security Conference ', '', '勤益科技大學 ');

-- --------------------------------------------------------

--
-- 資料表結構 `image`
--

CREATE TABLE `image` (
  `ID` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `uploaded_on` datetime NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `image`
--

INSERT INTO `image` (`ID`, `file_name`, `uploaded_on`, `status`) VALUES
(1, '899631.jpg', '2023-05-22 12:23:27', '1');

-- --------------------------------------------------------

--
-- 資料表結構 `industry_academy_cooperation_project`
--

CREATE TABLE `industry_academy_cooperation_project` (
  `title` varchar(255) NOT NULL,
  `date_begin` date NOT NULL,
  `date_end` date NOT NULL,
  `position` varchar(255) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `industry_academy_cooperation_project`
--

INSERT INTO `industry_academy_cooperation_project` (`title`, `date_begin`, `date_end`, `position`, `ID`) VALUES
('資安服務專案', '2023-01-01', '2023-12-01', '主持人', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `journal_article`
--

CREATE TABLE `journal_article` (
  `ID` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `page` varchar(255) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `organization` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `journal_article`
--

INSERT INTO `journal_article` (`ID`, `author`, `title`, `date`, `page`, `volume`, `number`, `organization`) VALUES
(4, 'Lee, J.S., Chen, Y. C., Chew, C. J., Hong, W. Z., Fan, Y.Y., Li, B.', 'Constructing Gene Features for Robust 3D Mesh Zero-watermarking', '2023-03-01', '', 73, 0, ''),
(5, 'Lee, J.S., Chen, Y. C., Hsieh, Y.H., Chang, S.H., and Huynh, N .T.', 'Preserving friendly stacking and weighted shadows in selective scalable secret image sharing,', '2023-02-01', '', 0, 0, '');

-- --------------------------------------------------------

--
-- 資料表結構 `literature`
--

CREATE TABLE `literature` (
  `ISBN` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `publishing_house` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `literature`
--

INSERT INTO `literature` (`ISBN`, `title`, `author`, `publishing_house`, `date`) VALUES
('9789864345205', '資訊生活安全、行動智慧應用與網駭實務', '王旭正、李榮三、魏國瑞', '博碩', '2020-09-30');

-- --------------------------------------------------------

--
-- 資料表結構 `login`
--

CREATE TABLE `login` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('123', '123');

-- --------------------------------------------------------

--
-- 資料表結構 `nstc_project`
--

CREATE TABLE `nstc_project` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date_begin` date NOT NULL,
  `date_end` date NOT NULL,
  `position` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `nstc_project`
--

INSERT INTO `nstc_project` (`ID`, `title`, `date_begin`, `date_end`, `position`, `code`) VALUES
(1, '植基於深度學習之未知網路攻擊暨惡意程式行為偵察技術', '2022-08-01', '2023-07-01', '主持人', 'NSTC111-2221-E-035-053-');

-- --------------------------------------------------------

--
-- 資料表結構 `skill`
--

CREATE TABLE `skill` (
  `name` varchar(255) NOT NULL,
  `ID` varchar(255) NOT NULL,
  `serial_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `skill`
--

INSERT INTO `skill` (`name`, `ID`, `serial_number`) VALUES
('無線通訊', 'T0001', 1),
('資訊安全', 'T0001', 2),
('電子商務', 'T0001', 3),
('密碼學', 'T0001', 4),
('區塊鏈技術與應用', 'T0001', 5);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `chair`
--
ALTER TABLE `chair`
  ADD PRIMARY KEY (`ID`);

--
-- 資料表索引 `conference_proceeding`
--
ALTER TABLE `conference_proceeding`
  ADD PRIMARY KEY (`ID`);

--
-- 資料表索引 `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`ID`);

--
-- 資料表索引 `industry_academy_cooperation_project`
--
ALTER TABLE `industry_academy_cooperation_project`
  ADD PRIMARY KEY (`ID`);

--
-- 資料表索引 `journal_article`
--
ALTER TABLE `journal_article`
  ADD PRIMARY KEY (`ID`);

--
-- 資料表索引 `literature`
--
ALTER TABLE `literature`
  ADD PRIMARY KEY (`ISBN`);

--
-- 資料表索引 `nstc_project`
--
ALTER TABLE `nstc_project`
  ADD PRIMARY KEY (`ID`);

--
-- 資料表索引 `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`serial_number`),
  ADD KEY `ID` (`ID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `conference_proceeding`
--
ALTER TABLE `conference_proceeding`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `image`
--
ALTER TABLE `image`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `industry_academy_cooperation_project`
--
ALTER TABLE `industry_academy_cooperation_project`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `journal_article`
--
ALTER TABLE `journal_article`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=361;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `nstc_project`
--
ALTER TABLE `nstc_project`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `skill`
--
ALTER TABLE `skill`
  MODIFY `serial_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `skill`
--
ALTER TABLE `skill`
  ADD CONSTRAINT `skill_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `chair` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
