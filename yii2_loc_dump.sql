-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 13 2021 г., 15:05
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
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `parent_id`, `title`, `description`, `keywords`) VALUES
(1, 0, 'Branded Foods', 'Branded Foods description', 'Branded Foods keywords'),
(2, 0, 'Households', 'Households description', 'Households keywords'),
(3, 0, 'Veggies & Fruits', 'Veggies & Fruits description', 'Veggies & Fruits keywords'),
(4, 3, 'Vegetables', 'Vegetables description', 'Vegetables keywords'),
(5, 3, 'Fruits', 'Fruits description', 'Fruits keywords'),
(6, 0, 'Kitchen', NULL, NULL),
(7, 0, 'Short Codes', NULL, NULL),
(8, 0, 'Beverages', NULL, NULL),
(9, 8, 'Soft Drinks', NULL, NULL),
(10, 8, 'Juices', NULL, NULL),
(11, 0, 'Pet Food', NULL, NULL),
(12, 0, 'Frozen Foods', NULL, NULL),
(13, 12, 'Frozen Snacks', NULL, NULL),
(14, 12, 'Frozen Nonveg', NULL, NULL),
(15, 0, 'Bread & Bakery', NULL, NULL),
(16, 0, 'Категория 1', 'Категория 1', '');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `qty` tinyint(3) UNSIGNED NOT NULL,
  `total` decimal(6,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `created_at`, `updated_at`, `qty`, `total`, `status`, `name`, `email`, `phone`, `address`, `note`) VALUES
(34, '2021-03-30 18:47:32', '2021-03-30 18:47:32', 1, '5.00', 0, 'Тестер', 'p.vit2009@yandex.ru', '77777777777777', 'Город', ''),
(35, '2021-03-30 18:57:13', '2021-03-30 18:57:13', 1, '5.00', 0, 'Тест', 'p.vit2009@yandex.ru', '77777777777777', 'Город', ''),
(36, '2021-03-30 19:07:22', '2021-03-30 19:07:22', 2, '10.00', 0, 'Василий', 'p.vit2009@yandex.ru', '77777777777777', 'Город', ''),
(37, '2021-03-30 19:16:58', '2021-03-30 19:16:58', 1, '5.00', 0, 'Тестер', 'p.vit2009@yandex.ru', '77777777777777', 'Город', ''),
(38, '2021-03-30 19:32:21', '2021-03-30 19:32:21', 1, '5.00', 0, 'Тестер', 'p.vit2009@yandex.ru', '77777777777777', 'Город', ''),
(39, '2021-04-01 12:40:23', '2021-04-01 12:40:23', 6, '26.00', 0, 'Василий', 'p.vit2009@yandex.ru', '+7777777', 'Могилёв', 'Самовывоз'),
(40, '2021-04-01 12:42:14', '2021-04-01 19:13:30', 6, '25.00', 0, 'Петров', 'p.vit2009@yandex.ru', '+1111111', 'Минск', 'Клиент:  Самовывоз.\r\nМенеджер:  из магазина или склада?'),
(41, '2021-04-01 12:43:24', '2021-04-01 12:43:24', 4, '12.00', 0, 'Сидоров', 'p.vit2009@yandex.ru', '+1234567', 'Одесса', 'Шоб ви были здоровы'),
(42, '2021-04-01 12:44:10', '2021-04-01 12:44:10', 1, '3.00', 0, 'Иванов ', 'p.vit2009@yandex.ru', '+5555555', 'Москва', ''),
(43, '2021-04-01 13:35:01', '2021-04-01 21:15:25', 4, '15.00', 1, 'Виталий', 'p.vit2009@yandex.ru', '777777777777', 'Могилёв', ''),
(44, '2021-04-01 13:37:09', '2021-04-01 13:37:09', 2, '6.00', 0, 'Василий', 'p.vit2009@yandex.ru', '77777777777777', 'Могилёв', ''),
(45, '2021-04-04 17:23:35', '2021-04-04 17:23:35', 2, '6.00', 1, 'Тест', 'mail@mail.mail', '+1111111', 'Одесса', ''),
(46, '2021-04-06 22:31:41', '2021-04-06 22:31:41', 8, '33.00', 0, 'Иван Петров', 'mail@mail.mail', '+123456789', 'Москва,  3-я ул. Строителей, 25', 'Самовывоз'),
(47, '2021-04-06 22:55:59', '2021-04-06 22:55:59', 1, '3.00', 0, 'Иван Петров', 'mail@mail.mail', '+123456789', 'Москва,  3-я ул. Строителей, 25', '!!!!!!!!!!!!!!!!!!!');

-- --------------------------------------------------------

--
-- Структура таблицы `order_product`
--

CREATE TABLE `order_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(6,2) NOT NULL DEFAULT '0.00',
  `qty` tinyint(4) NOT NULL,
  `total` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `title`, `price`, `qty`, `total`) VALUES
(43, 34, 6, 'fresh mango dasheri (1 kg)', '5.00', 1, '5.00'),
(44, 35, 2, 'chings noodles (75 gm)', '5.00', 1, '5.00'),
(45, 36, 6, 'fresh mango dasheri (1 kg)', '5.00', 2, '10.00'),
(46, 37, 2, 'chings noodles (75 gm)', '5.00', 1, '5.00'),
(47, 38, 2, 'chings noodles (75 gm)', '5.00', 1, '5.00'),
(48, 39, 2, 'chings noodles (75 gm)', '5.00', 1, '5.00'),
(49, 39, 3, 'lahsun sev (150 gm)', '3.00', 2, '6.00'),
(50, 39, 4, 'premium bake rusk (300 gm)', '5.00', 3, '15.00'),
(51, 40, 6, 'fresh mango dasheri (1 kg)', '5.00', 1, '5.00'),
(52, 40, 8, 'fresh broccoli (500 gm)', '4.00', 1, '4.00'),
(53, 40, 5, 'fresh spinach (palak)', '2.00', 2, '4.00'),
(54, 40, 7, 'fresh apple red (1 kg)', '6.00', 2, '12.00'),
(55, 41, 3, 'lahsun sev (150 gm)', '3.00', 1, '3.00'),
(56, 41, 1, 'knorr instant soup (100 gm)', '3.00', 3, '9.00'),
(57, 42, 9, 'mixed fruit juice (1 ltr)', '3.00', 1, '3.00'),
(58, 43, 6, 'fresh mango dasheri (1 kg)', '5.00', 1, '5.00'),
(59, 43, 8, 'fresh broccoli (500 gm)', '4.00', 1, '4.00'),
(60, 43, 5, 'fresh spinach (palak)', '2.00', 1, '2.00'),
(61, 43, 10, 'prune juice - sunsweet (1 ltr)', '4.00', 1, '4.00'),
(62, 44, 9, 'mixed fruit juice (1 ltr)', '3.00', 2, '6.00'),
(63, 45, 3, 'lahsun sev (150 gm)', '3.00', 2, '6.00'),
(64, 46, 3, 'lahsun sev (150 gm)', '3.00', 1, '3.00'),
(65, 46, 4, 'premium bake rusk (300 gm)', '5.00', 1, '5.00'),
(66, 46, 5, 'fresh spinach (palak)', '2.00', 2, '4.00'),
(67, 46, 20, 'test product 3', '7.00', 3, '21.00'),
(68, 46, 21, 'test product', '0.00', 1, '0.00'),
(69, 47, 3, 'lahsun sev (150 gm)', '3.00', 1, '3.00');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `price` decimal(6,2) NOT NULL DEFAULT '0.00',
  `old_price` decimal(6,2) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `is_offer` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `category_id`, `title`, `content`, `price`, `old_price`, `description`, `keywords`, `img`, `is_offer`) VALUES
(1, 1, 'knorr instant soup (100 gm)', '<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n\r\n<p><strong>Excepteur </strong>sint occae cat <span style=\"color:#00FF00\">cupidatat </span>non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla <s>pariatur</s>.</p>\r\n', '3.00', '0.00', 'knorr ', 'knorr ', 'products/2021-04-03/6068736ab5342_76.png', 0),
(2, 1, 'chings noodles (75 gm)', '<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n', '5.00', '8.00', '', '', 'products/2021-04-03/6068737e79e8c_6.png', 1),
(3, 1, 'lahsun sev (150 gm)', '<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n', '3.00', '5.00', '', '', 'products/2021-04-03/606873986aa58_7.png', 1),
(4, 1, 'premium bake rusk (300 gm)', '<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n', '5.00', '7.00', '', '', 'products/2021-04-03/606873aadfd91_8.png', 1),
(5, 4, 'fresh spinach (palak)', '<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n', '2.00', '3.00', '', '', 'products/2021-04-03/606873bddafc7_9.png', 1),
(6, 5, 'fresh mango dasheri (1 kg)', '<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n', '5.00', '8.00', '', '', 'products/2021-04-03/606873d3340c2_10.png', 1),
(7, 5, 'fresh apple red (1 kg)', '<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n', '6.00', '8.00', '', '', 'products/2021-04-03/606873eebbee2_11.png', 1),
(8, 4, 'fresh broccoli (500 gm)', '<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n', '4.00', '6.00', '', '', 'products/2021-04-03/606874029a072_12.png', 1),
(9, 1, 'mixed fruit juice (1 ltr)', '<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n', '3.00', '0.00', '', '', 'products/2021-04-03/6068741337237_13.png', 0),
(10, 10, 'prune juice - sunsweet (1 ltr)', '<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n', '4.00', '0.00', '', '', 'products/2021-04-03/606874256394f_14.png', 0),
(11, 9, 'coco cola zero can (330 ml)', '<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n', '3.00', '0.00', '', '', 'products/2021-04-03/60687447e66f6_15.png', 0),
(12, 9, 'sprite bottle (2 ltr)', '<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n', '3.00', '0.00', '', '', 'products/2021-04-03/60687460dd04a_16.png', 0),
(20, 16, 'test product 3', '<p>test product 3</p>\r\n', '7.00', NULL, '', '', 'products/2021-04-03/60686ee53112b_4.jpg', 0),
(21, 16, 'test product', '<p>111</p>\r\n', '0.00', NULL, '', '', 'products/2021-04-03/60687d1187df5_18.png', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `auth_key` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `auth_key`, `role`) VALUES
(1, 'admin@mail.ru', '$2y$13$LvCdAGrBrSgrniFllqBURePfk/BFsdxWBnu7ZcmtlqB4AOXXRwnce', '6bRqHETETxbe7iIOcy1hn5nJU5LtiMRk', 10),
(3, 'mail@mail.mail', '$2y$13$2TSGdheDIcV2n.E8EddaoeQQ2kCOlUjRYh/W6vsk37u2tLj6FwaY.', 'UG3aIJ00wCk7tTegkM9tf4sNPTf5UyKn', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT для таблицы `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
