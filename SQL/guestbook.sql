-- phpMyAdmin SQL Dump
-- version 3.4.4
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 26 2014 г., 22:21
-- Версия сервера: 5.1.40
-- Версия PHP: 5.2.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `guestbook`
--

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `pID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `ptext` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `pdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=64 ;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`pID`, `userID`, `ptext`, `pdate`) VALUES
(63, 23, '\\\\\\\\ \\"test\\" /?.&&*@#$%^*;~`<iNpUt type=\\"text\\" />С„С‹РІР°.&%\\\\ \\''<b>t_e_st</b>\\''<img src=x onerror=\\"alert(\\''xss\\'')\\"/>', '2014-05-26 17:46:48'),
(62, 23, 'РіРѕСЃС‚СЊ', '2014-05-26 17:43:48'),
(61, 13, 'СЃРѕРѕР±С‰РµРЅРёРµ ', '2014-05-26 15:54:00'),
(58, 13, 'С‚РµРєСЃС‚ СЃРѕРѕР±С‰РµРЅРёСЏ', '2014-05-23 15:27:14'),
(57, 13, 'message', '2014-05-20 09:00:22');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uID` int(11) NOT NULL AUTO_INCREMENT,
  `uname` text COLLATE utf8_unicode_ci NOT NULL,
  `usname` text COLLATE utf8_unicode_ci NOT NULL,
  `uemail` text COLLATE utf8_unicode_ci NOT NULL,
  `upassword` text COLLATE utf8_unicode_ci NOT NULL,
  `uavatar` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`uID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`uID`, `uname`, `usname`, `uemail`, `upassword`, `uavatar`) VALUES
(23, 'Р“РѕСЃС‚СЊ ', '', 'guest@mail.ru', 'df6d2338b2b8fce1ec2f6dda0a630eb0', 'usr/23.gif'),
(13, 'Kitten', '', 'kitten1704@mail.ru', 'e10adc3949ba59abbe56e057f20f883e', 'usr/13.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
