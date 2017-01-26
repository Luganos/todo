-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 26 2017 г., 14:27
-- Версия сервера: 5.7.15-log
-- Версия PHP: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `simple-blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `author`
--

CREATE TABLE IF NOT EXISTS `author` (
`author_id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `author`
--

INSERT INTO `author` (`author_id`, `name`) VALUES
(2, 'Lugano'),
(3, 'Picazzo');

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
`comment_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `author_id` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`comment_id`, `text`, `author_id`, `created`) VALUES
(16, 'First comment', 2, '2017-01-26 13:48:29'),
(17, 'Second comment', 2, '2017-01-26 13:48:40'),
(18, 'Third comment', 2, '2017-01-26 13:48:51'),
(19, 'First comment', 3, '2017-01-26 13:50:40'),
(20, 'Second comment', 3, '2017-01-26 13:50:52'),
(21, 'Third comment ', 3, '2017-01-26 13:51:02');

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE IF NOT EXISTS `task` (
`task_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `deadline` date NOT NULL,
  `status` int(11) NOT NULL,
  `done` date DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `task`
--

INSERT INTO `task` (`task_id`, `text`, `deadline`, `status`, `done`, `created`) VALUES
(11, 'First task', '2017-03-10', 1, '2017-01-26', '2017-01-26 13:36:24'),
(12, 'Second task', '2017-03-30', 1, '2017-01-26', '2017-01-26 13:49:11');

-- --------------------------------------------------------

--
-- Структура таблицы `task_to_comment`
--

CREATE TABLE IF NOT EXISTS `task_to_comment` (
  `task_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `task_to_comment`
--

INSERT INTO `task_to_comment` (`task_id`, `comment_id`) VALUES
(11, 16),
(11, 17),
(11, 18),
(12, 19),
(12, 20),
(12, 21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
 ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
 ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
 ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `task_to_comment`
--
ALTER TABLE `task_to_comment`
 ADD PRIMARY KEY (`comment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
