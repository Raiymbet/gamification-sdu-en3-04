-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 13 2015 г., 12:13
-- Версия сервера: 5.6.21
-- Версия PHP: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `db_gamification`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tb_groups`
--

CREATE TABLE IF NOT EXISTS `tb_groups` (
`id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `secret_code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tb_groups`
--

INSERT INTO `tb_groups` (`id`, `title`, `teacher_id`, `secret_code`, `category`) VALUES
(1, 'EN_3_04KZ', 1, 'XFDS', 'IT'),
(12, 'EN3_04KZ', 1, 'SX0JW', 'IT');

-- --------------------------------------------------------

--
-- Структура таблицы `tb_group_students`
--

CREATE TABLE IF NOT EXISTS `tb_group_students` (
`id` int(11) NOT NULL,
  `id_groups` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `approved` int(11) NOT NULL,
  `date_request` datetime NOT NULL COMMENT 'время запроса',
  `date_approved` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tb_group_students`
--

INSERT INTO `tb_group_students` (`id`, `id_groups`, `id_student`, `approved`, `date_request`, `date_approved`) VALUES
(24, 12, 1, 1, '2015-05-10 21:01:19', '2015-05-10 21:01:34'),
(26, 1, 1, 0, '2015-05-12 19:36:00', '2015-05-12 19:36:00');

-- --------------------------------------------------------

--
-- Структура таблицы `tb_questions`
--

CREATE TABLE IF NOT EXISTS `tb_questions` (
`id` int(11) NOT NULL,
  `id_tournament` int(11) NOT NULL,
  `question` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `type_question` int(11) NOT NULL,
  `level_question` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tb_questions`
--

INSERT INTO `tb_questions` (`id`, `id_tournament`, `question`, `type_question`, `level_question`) VALUES
(1, 1, 'Что такое SQL?', 1, '3'),
(2, 1, 'Найдите метод сортировки данных?', 1, '3'),
(3, 1, 'Какой язык программирование Python?', 1, '2'),
(4, 1, 'Сколько битов имеет тип boolean?', 1, '1'),
(5, 1, '? - выявление и устранение ошибок в программах', 2, '2'),
(6, 23, 'Что такое SQL?', 1, '3'),
(7, 1, 'Каждый юный программист может допустить синтаксическую ошибку в коде.С каждого ошибки,он учится стать лучше.', 3, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `tb_student`
--

CREATE TABLE IF NOT EXISTS `tb_student` (
`id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `photo_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'person.png',
  `phone_number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `group_name` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tb_student`
--

INSERT INTO `tb_student` (`id`, `name`, `surname`, `password`, `birthday`, `gender`, `email`, `photo_url`, `phone_number`, `group_name`) VALUES
(1, 'Raiymbet', 'Tukpetov', '2ac683870d5aa948f983b97337b700ce', '0000-00-00', 'm', 'tukpetov@bk.ru', 'person_1.png', '87755472936', 'EN3_04kz'),
(2, 'Raiymbet', 'Tukpetov', '2ac683870d5aa948f983b97337b700ce', '0000-00-00', 'm', 'tukpessstov@bk.ru', 'person.png', '87755472936', 'EN3_04kz'),
(3, 'Raika', 'Adrahman', 'd9b1d7db4cd6e70935368a1efb10e377', '2015-03-01', 'F', 'tukpetov@mail.ru', 'person.png', '87755472936', ''),
(4, 'Акжол', 'Бакытжан', 'e0caa3d5f0081b1bf1406afb936f184c', '2010-02-01', 'M', 'akz@mail.ru', 'person.png', '+7(707)77-77-77', 'EN3_04KZ'),
(5, 'Акжол', 'Бакытжан', 'e0caa3d5f0081b1bf1406afb936f184c', '1993-02-02', '1', 'azzzzkz@mail.ru', 'person.png', '+7(777)77-77-77', '10'),
(6, 'Акжол', 'Бакытжан', 'e0caa3d5f0081b1bf1406afb936f184c', '1993-02-02', '1', 'sds@mail.ru', 'person.png', '+7(777)77-77-77', '10'),
(7, 'Alimkhan', 'Dosumbetov', 'e0caa3d5f0081b1bf1406afb936f184c', '1993-06-01', '1', 'alim@mail.ru', 'person.png', '+7(777)77-77-77', '10'),
(8, 'Alimkhan', 'Dosumbetov', 'e0caa3d5f0081b1bf1406afb936f184c', '1993-06-01', '1', 'masmalsk@mail.ru', 'person.png', '+7(777)77-77-77', '10'),
(9, 'Kenguru', 'ASKS', 'dac50055396fb62610dac6de725ed1be', '2015-04-15', '2', 'tukpetov@mail.zxx', 'person.png', '+7(777)77-77-77', '2'),
(10, 'Илья', 'Ильин', 'e0caa3d5f0081b1bf1406afb936f184c', '1993-06-03', '1', 'iylyin993@mail.ru', 'person.png', '+7(777)77-77-77', '10'),
(11, 'Алабай', 'Шалабай', 'e0caa3d5f0081b1bf1406afb936f184c', '1993-02-02', '1', 'akz@msil.ru', 'person.png', '+7(777)77-77-77', '10'),
(12, 'Алабай', 'Шалабай', 'e0caa3d5f0081b1bf1406afb936f184c', '1993-02-02', '1', 'akaz@msil.ru', 'person.png', '+7(777)77-77-77', '10'),
(13, 'Алабай', 'Шалабай', 'e0caa3d5f0081b1bf1406afb936f184c', '1993-02-02', '1', 'a1az@msil.ru', 'person.png', '+7(777)77-77-77', '10'),
(14, 'Алабай', 'Шалабай', 'e0caa3d5f0081b1bf1406afb936f184c', '1993-02-02', '1', 'a2az@msil.ru', 'person.png', '+7(777)77-77-77', '10'),
(15, 'Алабай', 'Шалабай', 'e0caa3d5f0081b1bf1406afb936f184c', '1993-02-02', '1', 'a3az@msil.ru', 'person.png', '+7(777)77-77-77', '10'),
(16, 'Алабай', 'Шалабай', 'e0caa3d5f0081b1bf1406afb936f184c', '1993-02-02', '1', 'a4az@msil.ru', 'person.png', '+7(777)77-77-77', '10'),
(17, 'Алабай', 'Алматинсков', 'e0caa3d5f0081b1bf1406afb936f184c', '1994-06-14', '1', 'alabai1@mail.ru', 'person.png', '+7(707)42-10-35', '10'),
(18, 'Аккент', 'Алписбаев', 'e0caa3d5f0081b1bf1406afb936f184c', '2015-04-16', '1', 'akkken@ml.ru', 'person.png', '+7(777)77-77-77', '10'),
(19, 'Алпис', 'Билимбейв', 'e0caa3d5f0081b1bf1406afb936f184c', '1993-03-10', '1', 'ala@mail.ru', 'person.png', '+7(777)77-77-77', '10');

-- --------------------------------------------------------

--
-- Структура таблицы `tb_student_result`
--

CREATE TABLE IF NOT EXISTS `tb_student_result` (
`id` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_tournament` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `time_end` int(11) NOT NULL,
  `percent_correct` int(11) NOT NULL,
  `correct_answers` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tb_student_result`
--

INSERT INTO `tb_student_result` (`id`, `id_student`, `id_tournament`, `score`, `time_end`, `percent_correct`, `correct_answers`, `datetime`) VALUES
(3, 1, 1, 250, 17, 20, 2, '2015-04-11 18:25:31'),
(4, 3, 1, 270, 20, 70, 3, '2015-04-14 00:00:00'),
(5, 1, 23, 150, 46, 0, 1, '2015-04-12 19:33:19'),
(6, 10, 1, 300, 31, 50, 2, '2015-04-17 03:18:30'),
(8, 16, 1, 175, 41, 33, 1, '2015-04-17 03:41:30'),
(12, 17, 1, 350, 41, 67, 3, '2015-04-17 04:04:34'),
(14, 18, 1, 275, 43, 33, 2, '2015-04-17 04:12:55'),
(15, 19, 1, 500, 26, 67, 4, '2015-04-17 04:15:36');

-- --------------------------------------------------------

--
-- Структура таблицы `tb_teacher`
--

CREATE TABLE IF NOT EXISTS `tb_teacher` (
`id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `photo_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tb_teacher`
--

INSERT INTO `tb_teacher` (`id`, `name`, `surname`, `password`, `birthday`, `email`, `phone_number`, `gender`, `photo_url`) VALUES
(1, 'Жасдаурен', 'Дуйсебеков', '12345', '2015-03-03', 'test@com.com', '+77020322', 'M', 'zhasdauren.jpg'),
(2, 'Latuta', 'Konstantin', '123456Bb', '2015-05-05', 'latuta@ce.sdu.edu.kz', '+7(707)12-12-12', 'M', 'latuta.jpeg');

-- --------------------------------------------------------

--
-- Структура таблицы `tb_tournaments`
--

CREATE TABLE IF NOT EXISTS `tb_tournaments` (
`id` int(11) NOT NULL,
  `title` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `id_groups` int(11) NOT NULL,
  `id_teacher` int(11) NOT NULL,
  `datetime_added` datetime NOT NULL,
  `time_limit` int(11) NOT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `when_opened` datetime NOT NULL,
  `when_closed` datetime NOT NULL,
  `public` tinyint(1) NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tb_tournaments`
--

INSERT INTO `tb_tournaments` (`id`, `title`, `id_groups`, `id_teacher`, `datetime_added`, `time_limit`, `status`, `when_opened`, `when_closed`, `public`, `description`) VALUES
(1, 'Season tour', 1, 1, '2015-03-07 00:00:00', 60, 'yes', '2015-03-26 00:00:00', '2015-04-30 14:02:20', 1, 'Its test games. Please, dont be worry'),
(22, 'Hello World', 1, 1, '2015-04-06 11:54:06', 90, 'yes', '2015-04-06 11:54:06', '0000-00-00 00:00:00', 1, 'Би'),
(23, 'Время играть', 1, 1, '2015-03-07 00:00:00', 50, 'yes', '2015-03-26 00:00:00', '2015-04-30 14:02:20', 1, 'It will be good game');

-- --------------------------------------------------------

--
-- Структура таблицы `tb_variants`
--

CREATE TABLE IF NOT EXISTS `tb_variants` (
`id` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `correct` tinyint(1) NOT NULL,
  `text` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tb_variants`
--

INSERT INTO `tb_variants` (`id`, `id_question`, `correct`, `text`) VALUES
(1, 1, 0, 'Сервер'),
(2, 1, 0, 'Метод хранение данных'),
(3, 1, 1, 'База данных'),
(4, 1, 0, 'Формат файла'),
(5, 2, 0, 'JSON'),
(6, 2, 0, 'XML'),
(7, 2, 1, 'Bubble'),
(8, 2, 0, 'USB'),
(9, 3, 0, 'Процедурный'),
(10, 3, 0, 'Скриптовый'),
(11, 3, 1, 'Интерпретатор'),
(12, 3, 0, 'Ассоицативные'),
(13, 4, 1, '1'),
(16, 4, 0, '2'),
(17, 4, 0, '16'),
(18, 4, 0, '8'),
(19, 5, 1, 'ОТЛАДКА'),
(20, 6, 0, 'Сервер'),
(21, 6, 0, 'Метод хранение данных'),
(22, 6, 1, 'База данных'),
(23, 6, 0, 'Формат файла'),
(24, 7, 1, 'юный'),
(25, 7, 1, 'синтаксическую');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tb_groups`
--
ALTER TABLE `tb_groups`
 ADD PRIMARY KEY (`id`), ADD KEY `teacher_id` (`teacher_id`);

--
-- Индексы таблицы `tb_group_students`
--
ALTER TABLE `tb_group_students`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_groups` (`id_groups`), ADD KEY `id_student` (`id_student`);

--
-- Индексы таблицы `tb_questions`
--
ALTER TABLE `tb_questions`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_questions_to_tournament` (`id_tournament`);

--
-- Индексы таблицы `tb_student`
--
ALTER TABLE `tb_student`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `tb_student_result`
--
ALTER TABLE `tb_student_result`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tb_teacher`
--
ALTER TABLE `tb_teacher`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tb_tournaments`
--
ALTER TABLE `tb_tournaments`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_tournaments_to_groups` (`id_groups`), ADD KEY `id_teacher` (`id_teacher`);

--
-- Индексы таблицы `tb_variants`
--
ALTER TABLE `tb_variants`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_variant_to_questions` (`id_question`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tb_groups`
--
ALTER TABLE `tb_groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `tb_group_students`
--
ALTER TABLE `tb_group_students`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT для таблицы `tb_questions`
--
ALTER TABLE `tb_questions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `tb_student`
--
ALTER TABLE `tb_student`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT для таблицы `tb_student_result`
--
ALTER TABLE `tb_student_result`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `tb_teacher`
--
ALTER TABLE `tb_teacher`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `tb_tournaments`
--
ALTER TABLE `tb_tournaments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT для таблицы `tb_variants`
--
ALTER TABLE `tb_variants`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tb_groups`
--
ALTER TABLE `tb_groups`
ADD CONSTRAINT `tb_groups_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `tb_teacher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tb_group_students`
--
ALTER TABLE `tb_group_students`
ADD CONSTRAINT `fk_groups` FOREIGN KEY (`id_groups`) REFERENCES `tb_groups` (`id`),
ADD CONSTRAINT `tb_group_students_ibfk_1` FOREIGN KEY (`id_student`) REFERENCES `tb_student` (`id`);

--
-- Ограничения внешнего ключа таблицы `tb_questions`
--
ALTER TABLE `tb_questions`
ADD CONSTRAINT `fk_questions_to_tournament` FOREIGN KEY (`id_tournament`) REFERENCES `tb_tournaments` (`id`);

--
-- Ограничения внешнего ключа таблицы `tb_tournaments`
--
ALTER TABLE `tb_tournaments`
ADD CONSTRAINT `fk_tournaments_to_groups` FOREIGN KEY (`id_groups`) REFERENCES `tb_groups` (`id`),
ADD CONSTRAINT `tb_tournaments_ibfk_1` FOREIGN KEY (`id_teacher`) REFERENCES `tb_teacher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tb_variants`
--
ALTER TABLE `tb_variants`
ADD CONSTRAINT `fk_variant_to_questions` FOREIGN KEY (`id_question`) REFERENCES `tb_questions` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
