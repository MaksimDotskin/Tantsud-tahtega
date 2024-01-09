-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 08 2024 г., 11:11
-- Версия сервера: 10.4.27-MariaDB
-- Версия PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tantsid`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tantsid`
--

CREATE TABLE `tantsid` (
  `id` int(11) NOT NULL,
  `tantsupaar` varchar(30) DEFAULT NULL,
  `punktid` int(11) DEFAULT 0,
  `kommentaarid` text DEFAULT NULL,
  `ava_paev_` datetime DEFAULT NULL,
  `avalik` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `tantsid`
--

INSERT INTO `tantsid` (`id`, `tantsupaar`, `punktid`, `kommentaarid`, `ava_paev_`, `avalik`) VALUES
(1, 'Max+Bogdan', 15, NULL, NULL, 1),
(2, 'Olga+Artur', 61, NULL, NULL, 1),
(4, 'test', 16, NULL, '2024-01-18 11:23:54', 1),
(5, 'g', 6, NULL, NULL, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tantsid`
--
ALTER TABLE `tantsid`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tantsupaar` (`tantsupaar`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tantsid`
--
ALTER TABLE `tantsid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
