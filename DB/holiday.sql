-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 
-- 伺服器版本： 10.4.11-MariaDB
-- PHP 版本： 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `holiday`
--

-- --------------------------------------------------------

--
-- 資料表結構 `2020_holiday`
--

CREATE TABLE `2020_holiday` (
  `calendar` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `number` varchar(4) DEFAULT NULL,
  `day` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `2020_holiday`
--

INSERT INTO `2020_holiday` (`calendar`, `date`, `number`, `day`) VALUES
('行事曆', '0000-00-00', '假日編號', '假日名稱'),
('', '2020-01-01', '', '元旦'),
('', '2020-01-23', '', '農曆春節彈性放假'),
('', '2020-01-24', '', '除夕'),
('', '2020-01-25', '', '初一'),
('', '2020-01-26', '', '初二'),
('', '2020-01-27', '', '初三'),
('', '2020-01-28', '', '初四'),
('', '2020-01-29', '', '初五'),
('', '2020-02-28', '', '二二八和平紀念日'),
('', '2020-04-02', '', '民族掃墓節補假一天'),
('', '2020-04-03', '', '兒童節'),
('', '2020-04-04', '', '民族掃墓節'),
('', '2020-05-01', '', '勞動節'),
('', '2020-06-25', '', '端午節'),
('', '2020-06-26', '', '端午節彈性放假'),
('', '2020-10-01', '', '中秋節'),
('', '2020-10-02', '', '中秋節彈性放假'),
('', '2020-10-09', '', '國慶日補假一天'),
('', '2020-10-10', '', '國慶日');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
