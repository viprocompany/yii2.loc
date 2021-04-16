-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 16 2021 г., 12:39
-- Версия сервера: 5.7.29
-- Версия PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yii2_loc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `moderation` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`id`, `author_id`, `text`, `parent_id`, `product_id`, `moderation`, `created`, `is_admin`) VALUES
(1, 3, '!!!!!!!!!!!!!!!!!!!!!!!!!', NULL, 3, NULL, '2021-04-15 00:00:00', NULL),
(2, 3, '???????????????????', NULL, 2, NULL, '2021-04-15 00:00:00', NULL),
(3, 1, '98н98', NULL, 3, 1, '2021-04-15 23:15:24', NULL),
(4, 1, 'шшшшшшшш', NULL, 3, 1, '2021-04-15 23:16:50', NULL),
(5, 1, 'test parent_id', 1, 5, 1, '2021-04-16 10:07:41', NULL),
(6, 1, 'ggggg', NULL, 2, NULL, '2021-04-16 12:17:48', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-comment-product_id` (`product_id`),
  ADD KEY `author_id` (`author_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
