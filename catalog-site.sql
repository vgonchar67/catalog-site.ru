-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 18 2017 г., 17:29
-- Версия сервера: 5.6.37
-- Версия PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `catalog-site`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `preview_text` text,
  `detail_text` text,
  `active` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `preview_text`, `detail_text`, `active`) VALUES
(1, 'Ноутбуки', NULL, NULL, 1),
(2, 'Ноутбуки', NULL, NULL, 1),
(3, 'Ноутбуки', NULL, NULL, 0),
(4, 'Ноутбуки', NULL, NULL, 1),
(5, 'Ноутбуки', NULL, NULL, 1),
(6, 'Ноутбуки', NULL, NULL, 0),
(7, 'Ноутбуки', NULL, NULL, 0),
(8, 'Ноутбуки', NULL, NULL, 1),
(9, 'Ноутбуки', NULL, NULL, 1),
(10, 'Ноутбуки', NULL, NULL, 0),
(11, 'Ноутбуки', NULL, NULL, 0),
(12, 'Ноутбуки', NULL, NULL, 0),
(13, 'Ноутбуки', NULL, NULL, 0),
(14, 'Владимир Гончар', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `preview_text` text NOT NULL,
  `detail_text` text NOT NULL,
  `active` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `pre_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
