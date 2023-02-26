-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 26 2023 г., 15:26
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `qasam`
--

-- --------------------------------------------------------

--
-- Структура таблицы `employees`
--

CREATE TABLE `employees` (
  `employee_id` varchar(36) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'id записи',
  `employee_surname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'фамилия сотрудника',
  `employee_first_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'имя сотрудника',
  `employee_second_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'отчество сотрудника',
  `employee_position` varchar(25) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'должность сотрудника',
  `employee_photo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'storage/empty.png' COMMENT 'ссылка на фотографию'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `employees`
--

INSERT INTO `employees` (`employee_id`, `employee_surname`, `employee_first_name`, `employee_second_name`, `employee_position`, `employee_photo`) VALUES
('036cf0ad-43ea-411d-b90d-ac1cee0d205b', 'Нагаслаева', 'Валентина', 'Александровна', 'врач-стоматолог', 'storage/empty.png'),
('13c4719b-d5e4-432b-ad67-4cbc085604f9', 'Отосин', 'Александр', 'Эдуардович', 'врач-стоматолог', 'storage/empty.png'),
('458316ca-3e2c-4508-9865-7be2fc96a069', 'Старикова', 'Ольга', 'Антоновна', 'врач-терапевт участковый', 'storage/empty.png'),
('5ac39b4b-2f77-4300-8703-939be9a891b5', 'Кожевников', 'Александр', 'Петрович', 'врач-психиатр', 'storage/empty.png'),
('5e43be5c-50a7-45c5-acb0-a295be4ed3aa', 'Червинский', 'Андрей', 'Николаевич', 'врач-терапевт участковый', 'Chervinsky.png'),
('8878c13a-b03c-479b-8c4d-b75b77ea452e', 'Шилова', 'Светлана', 'Викторовна', 'врач-хирург', 'storage/empty.png'),
('a48af8a9-ed9e-4523-a2e9-13981b3660a8', 'Кулагина', 'Анна', 'Адександровна', 'зубной врач', 'Kulagina.png'),
('ba2f6f70-79bf-4611-a253-7fae1045ebea', 'Капитан', 'Дарья', 'Владимировна', 'врач-терапевт участковый', 'storage/empty.png'),
('bad6a119-f891-4bef-8af8-bfc808ca419d', 'Леонов', 'Сергей', 'Николаевич', 'врач-хирург', 'storage/empty.png');

-- --------------------------------------------------------

--
-- Структура таблицы `rating_records`
--

CREATE TABLE `rating_records` (
  `rating_record_id` varchar(36) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'id записи',
  `rating_record_employee_id` varchar(36) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'id сотрудника, которого оценивают',
  `rating_record_comment` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'комментарий к оценке',
  `rating_record_status` tinyint(1) NOT NULL COMMENT 'активен ли еще талон для голосования или нет.\r\n1. активен\r\n2. не активен',
  `rating_record_value` tinyint(1) DEFAULT NULL COMMENT 'сама оценка по 5-ти бальной шкале',
  `rating_record_activation_date` date DEFAULT NULL COMMENT 'дата, когда была проставлена оценка'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Таблица содержит данные об оценках сотрудников';

--
-- Дамп данных таблицы `rating_records`
--

INSERT INTO `rating_records` (`rating_record_id`, `rating_record_employee_id`, `rating_record_comment`, `rating_record_status`, `rating_record_value`, `rating_record_activation_date`) VALUES
('48bf5aa4-cc0a-4501-8951-fb027cce2efe', '5e43be5c-50a7-45c5-acb0-a295be4ed3aa', '', 2, 3, '2023-02-26'),
('9991cf6a-c1de-44f8-864d-27775706188e', 'a48af8a9-ed9e-4523-a2e9-13981b3660a8', 'Нориально!', 2, 3, '2023-02-26');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Индексы таблицы `rating_records`
--
ALTER TABLE `rating_records`
  ADD PRIMARY KEY (`rating_record_id`),
  ADD KEY `rating_record_employee_id` (`rating_record_employee_id`);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `rating_records`
--
ALTER TABLE `rating_records`
  ADD CONSTRAINT `rating_records_ibfk_1` FOREIGN KEY (`rating_record_employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
