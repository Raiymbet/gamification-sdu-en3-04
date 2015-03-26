-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 26 2015 г., 11:35
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tb_groups`
--

INSERT INTO `tb_groups` (`id`, `title`, `teacher_id`, `secret_code`, `category`) VALUES
(1, 'IT GAMERS', 1, 'XFDS', 'IT');

-- --------------------------------------------------------

--
-- Структура таблицы `tb_group_students`
--

CREATE TABLE IF NOT EXISTS `tb_group_students` (
`id` int(11) NOT NULL,
  `id_groups` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `approved` int(11) NOT NULL,
  `date_request` date NOT NULL COMMENT 'время запроса',
  `date_approved` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tb_group_students`
--

INSERT INTO `tb_group_students` (`id`, `id_groups`, `id_student`, `approved`, `date_request`, `date_approved`) VALUES
(1, 1, 1, 1, '2015-03-05', '2015-03-07');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tb_questions`
--

INSERT INTO `tb_questions` (`id`, `id_tournament`, `question`, `type_question`, `level_question`) VALUES
(1, 1, 'Что такое SQL?', 1, '3'),
(2, 1, 'Найдите метод сортировки данных?', 1, '3'),
(3, 1, 'Какой язык программирование Python?', 1, '2'),
(4, 1, 'Сколько битов имеет тип boolean?', 1, '1'),
(5, 1, '? - выявление и устранение ошибок в программах', 2, '2');

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
  `photo_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `group_name` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tb_student`
--

INSERT INTO `tb_student` (`id`, `name`, `surname`, `password`, `birthday`, `gender`, `email`, `photo_url`, `phone_number`, `group_name`) VALUES
(1, 'Raiymbet', 'Tukpetov', '2ac683870d5aa948f983b97337b700ce', '0000-00-00', 'm', 'tukpetov@bk.ru', 'image.jpg', '87755472936', 'EN3_04kz'),
(2, 'Raiymbet', 'Tukpetov', '2ac683870d5aa948f983b97337b700ce', '0000-00-00', 'm', 'tukpessstov@bk.ru', 'image.jpg', '87755472936', 'EN3_04kz'),
(3, 'Raika', 'Adrahman', 'd9b1d7db4cd6e70935368a1efb10e377', '2015-03-01', 'F', 'tukpetov@mail.ru', 'image.jpg', '87755472936', '');

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
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tb_teacher`
--

INSERT INTO `tb_teacher` (`id`, `name`, `surname`, `password`, `birthday`, `email`, `phone_number`, `gender`, `photo_url`) VALUES
(1, 'Test', 'Teacher', '12345', '2015-03-03', 'test@com.com', '+77020322', 'M', 'image.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `tb_tournaments`
--

CREATE TABLE IF NOT EXISTS `tb_tournaments` (
`id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_groups` int(11) NOT NULL,
  `id_teacher` int(11) NOT NULL,
  `datetime_added` datetime NOT NULL,
  `time_limit` int(11) NOT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `when_opened` datetime NOT NULL,
  `when_closed` datetime NOT NULL,
  `public` tinyint(1) NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tb_tournaments`
--

INSERT INTO `tb_tournaments` (`id`, `title`, `id_groups`, `id_teacher`, `datetime_added`, `time_limit`, `status`, `when_opened`, `when_closed`, `public`, `description`) VALUES
(1, 'Season tour', 1, 1, '2015-03-07 00:00:00', 30, 'yes', '2015-03-26 00:00:00', '2015-03-31 00:00:00', 1, 'Its test games. Please, dont be worry');

-- --------------------------------------------------------

--
-- Структура таблицы `tb_variants`
--

CREATE TABLE IF NOT EXISTS `tb_variants` (
`id` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `correct` tinyint(1) NOT NULL,
  `text` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(19, 5, 1, 'ОТЛАДКА');

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `tb_group_students`
--
ALTER TABLE `tb_group_students`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `tb_questions`
--
ALTER TABLE `tb_questions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `tb_student`
--
ALTER TABLE `tb_student`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `tb_student_result`
--
ALTER TABLE `tb_student_result`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `tb_teacher`
--
ALTER TABLE `tb_teacher`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `tb_tournaments`
--
ALTER TABLE `tb_tournaments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `tb_variants`
--
ALTER TABLE `tb_variants`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
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
ADD CONSTRAINT `tb_group_students_ibfk_1` FOREIGN KEY (`id_student`) REFERENCES `tb_student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
