-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 11 2019 г., 14:44
-- Версия сервера: 5.5.62
-- Версия PHP: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `testproject`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

CREATE TABLE `cities` (
  `city_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cities`
--

INSERT INTO `cities` (`city_id`, `name`) VALUES
(3, 'Киев'),
(4, 'Львов'),
(5, 'Одесса'),
(6, 'Харьков'),
(7, 'Днепропетровск');

-- --------------------------------------------------------

--
-- Структура таблицы `complexes`
--

CREATE TABLE `complexes` (
  `complex_id` int(10) NOT NULL,
  `city_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `complexes`
--

INSERT INTO `complexes` (`complex_id`, `city_id`, `name`) VALUES
(5, 3, 'ЖК Покровський посад'),
(7, 3, 'ЖК Володимирський'),
(8, 3, 'ЖК Яскравий'),
(10, 4, 'ЖК Старий Сихів'),
(11, 4, 'ЖК Семицвіт'),
(12, 5, 'ЖК Золота Ера');

-- --------------------------------------------------------

--
-- Структура таблицы `flats`
--

CREATE TABLE `flats` (
  `flat_id` int(10) NOT NULL,
  `house_id` int(10) NOT NULL,
  `flat_type_id` int(10) NOT NULL,
  `square` decimal(10,3) NOT NULL,
  `price` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `flats`
--

INSERT INTO `flats` (`flat_id`, `house_id`, `flat_type_id`, `square`, `price`) VALUES
(43, 29, 3, '56.000', 2250000),
(44, 30, 3, '56.000', 2250000),
(45, 31, 3, '56.000', 2250000),
(46, 29, 6, '134.000', 5380100),
(47, 30, 6, '134.000', 5380100),
(48, 31, 6, '134.000', 5380100),
(49, 32, 3, '68.000', 2250000),
(50, 35, 5, '84.600', 2250000),
(51, 34, 4, '84.000', 2192400),
(52, 33, 5, '74.000', 2000000),
(53, 36, 5, '110.490', 3856101),
(54, 37, 8, '156.630', 3856101),
(55, 36, 5, '98.120', 3330000),
(56, 39, 4, '54.000', 803000),
(57, 40, 4, '54.000', 803000),
(58, 41, 4, '54.000', 803000),
(60, 41, 3, '60.600', 803000);

-- --------------------------------------------------------

--
-- Структура таблицы `flat_types`
--

CREATE TABLE `flat_types` (
  `flat_type_id` int(10) NOT NULL,
  `name` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `flat_types`
--

INSERT INTO `flat_types` (`flat_type_id`, `name`) VALUES
(3, '1 комната'),
(4, '2 комнаты'),
(5, '3 комнаты'),
(6, '4 комнаты'),
(7, '5 комнат'),
(8, '5 комнат (двухуровневая)'),
(9, '6 комнат (двухуровневая)'),
(10, 'студия');

-- --------------------------------------------------------

--
-- Структура таблицы `houses`
--

CREATE TABLE `houses` (
  `house_id` int(10) NOT NULL,
  `complex_id` int(10) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `houses`
--

INSERT INTO `houses` (`house_id`, `complex_id`, `address`) VALUES
(29, 5, 'вул. Глибочицька, 32а'),
(30, 5, 'вул. Глибочицька, 32б'),
(31, 5, 'вул. Глибочицька, 32в'),
(32, 7, 'вул. Антоновича (Горького), 109'),
(33, 8, 'вул. Дегтяренка, 31б'),
(34, 8, 'вул. Дегтяренка, 33'),
(35, 8, 'вул. Дегтяренка, 34'),
(36, 10, 'вул. Зелена, 273'),
(37, 11, 'вул. Шевченка, 60'),
(38, 11, 'вул. Шевченка, 61'),
(39, 12, 'вул. Миколаївська, 3'),
(40, 12, 'вул. Миколаївська, 4'),
(41, 12, 'вул. Миколаївська, 5');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1567888595),
('m190907_170227_create_base_tables', 1567888598),
('m190911_105159_column_type_change', 1568200109);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `login` varchar(64) NOT NULL,
  `passhash` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`user_id`, `login`, `passhash`) VALUES
(1, 'admin', '$2y$13$mbYnq5j6FR5YOXMrcBmUEevQMBZl49dRJ0k8LVozns.FZKRKl6IXG');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Индексы таблицы `complexes`
--
ALTER TABLE `complexes`
  ADD PRIMARY KEY (`complex_id`),
  ADD KEY `fk_complex_to_city` (`city_id`);

--
-- Индексы таблицы `flats`
--
ALTER TABLE `flats`
  ADD PRIMARY KEY (`flat_id`),
  ADD KEY `fk_flat_to_house` (`house_id`),
  ADD KEY `fk_flat_to_flat_type` (`flat_type_id`);

--
-- Индексы таблицы `flat_types`
--
ALTER TABLE `flat_types`
  ADD PRIMARY KEY (`flat_type_id`);

--
-- Индексы таблицы `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`house_id`),
  ADD KEY `fk_house_to_complex` (`complex_id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `complexes`
--
ALTER TABLE `complexes`
  MODIFY `complex_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `flats`
--
ALTER TABLE `flats`
  MODIFY `flat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT для таблицы `flat_types`
--
ALTER TABLE `flat_types`
  MODIFY `flat_type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `houses`
--
ALTER TABLE `houses`
  MODIFY `house_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `complexes`
--
ALTER TABLE `complexes`
  ADD CONSTRAINT `fk_complex_to_city` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `flats`
--
ALTER TABLE `flats`
  ADD CONSTRAINT `fk_flat_to_flat_type` FOREIGN KEY (`flat_type_id`) REFERENCES `flat_types` (`flat_type_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_flat_to_house` FOREIGN KEY (`house_id`) REFERENCES `houses` (`house_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `houses`
--
ALTER TABLE `houses`
  ADD CONSTRAINT `fk_house_to_complex` FOREIGN KEY (`complex_id`) REFERENCES `complexes` (`complex_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
