-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 15 2015 г., 17:54
-- Версия сервера: 5.6.20
-- Версия PHP: 5.5.15

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tb_questions`
--

CREATE TABLE IF NOT EXISTS `tb_questions` (
`id` int(11) NOT NULL,
  `id_tournament` int(11) NOT NULL,
  `question` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `level_question` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tb_student`
--

CREATE TABLE IF NOT EXISTS `tb_student` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `surname` int(11) NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `photo_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `group_name` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tb_teacher`
--

CREATE TABLE IF NOT EXISTS `tb_teacher` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `photo_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tb_variants`
--

CREATE TABLE IF NOT EXISTS `tb_variants` (
`id` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `correct` tinyint(1) NOT NULL,
  `text` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_groups`
--
ALTER TABLE `tb_groups`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_teacher` (`teacher_id`);

--
-- Indexes for table `tb_group_students`
--
ALTER TABLE `tb_group_students`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_student` (`id_student`), ADD KEY `fk_groups` (`id_groups`);

--
-- Indexes for table `tb_questions`
--
ALTER TABLE `tb_questions`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_questions_to_tournament` (`id_tournament`);

--
-- Indexes for table `tb_student`
--
ALTER TABLE `tb_student`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_student_result`
--
ALTER TABLE `tb_student_result`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_teacher`
--
ALTER TABLE `tb_teacher`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tournaments`
--
ALTER TABLE `tb_tournaments`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_tournaments_to_groups` (`id_groups`), ADD KEY `fk_tournaments_to_teacher` (`id_teacher`);

--
-- Indexes for table `tb_variants`
--
ALTER TABLE `tb_variants`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_variant_to_questions` (`id_question`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_groups`
--
ALTER TABLE `tb_groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_group_students`
--
ALTER TABLE `tb_group_students`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_questions`
--
ALTER TABLE `tb_questions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_student_result`
--
ALTER TABLE `tb_student_result`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_tournaments`
--
ALTER TABLE `tb_tournaments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_variants`
--
ALTER TABLE `tb_variants`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tb_groups`
--
ALTER TABLE `tb_groups`
ADD CONSTRAINT `fk_teacher` FOREIGN KEY (`teacher_id`) REFERENCES `tb_teacher` (`id`);

--
-- Ограничения внешнего ключа таблицы `tb_group_students`
--
ALTER TABLE `tb_group_students`
ADD CONSTRAINT `fk_groups` FOREIGN KEY (`id_groups`) REFERENCES `tb_groups` (`id`),
ADD CONSTRAINT `fk_student` FOREIGN KEY (`id_student`) REFERENCES `tb_student` (`id`);

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
ADD CONSTRAINT `fk_tournaments_to_teacher` FOREIGN KEY (`id_teacher`) REFERENCES `tb_teacher` (`id`);

--
-- Ограничения внешнего ключа таблицы `tb_variants`
--
ALTER TABLE `tb_variants`
ADD CONSTRAINT `fk_variant_to_questions` FOREIGN KEY (`id_question`) REFERENCES `tb_questions` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
