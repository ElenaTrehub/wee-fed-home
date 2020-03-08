-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 08 2020 г., 13:34
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `well-fed-home_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `idCategory` bigint(20) UNSIGNED NOT NULL,
  `categoryTitle` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`idCategory`, `categoryTitle`) VALUES
(2, 'Блюда из мяса'),
(5, 'Блюда из овощей'),
(3, 'Блюда из рыбы'),
(6, 'Салаты'),
(1, 'Холодные закуски');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `idComment` bigint(20) UNSIGNED NOT NULL,
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `idRecipe` bigint(20) UNSIGNED NOT NULL,
  `commentText` varchar(2500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `updatedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`idComment`, `idUser`, `idRecipe`, `commentText`, `createdAt`, `updatedAt`) VALUES
(9, 6, 77, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.', '2020-02-22 08:55:47', '2020-02-22 08:55:47'),
(10, 6, 79, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн.', '2020-03-02 08:43:29', '2020-03-02 08:43:29'),
(11, 6, 80, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн.', '2020-03-02 08:43:53', '2020-03-02 08:43:53'),
(12, 13, 81, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн.', '2020-03-02 09:05:57', '2020-03-02 09:05:57'),
(13, 6, 81, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн.', '2020-03-02 09:14:22', '2020-03-02 09:14:22'),
(14, 6, 81, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн.', '2020-03-02 09:14:50', '2020-03-02 09:14:50'),
(15, 6, 81, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн.', '2020-03-02 09:14:59', '2020-03-02 09:14:59'),
(16, 6, 81, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.', '2020-03-08 07:14:43', '2020-03-08 07:14:43');

-- --------------------------------------------------------

--
-- Структура таблицы `cookerbook_recipes`
--

CREATE TABLE `cookerbook_recipes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idCookerBook` bigint(20) UNSIGNED NOT NULL,
  `idRecipe` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `cookerbook_recipes`
--

INSERT INTO `cookerbook_recipes` (`id`, `idCookerBook`, `idRecipe`) VALUES
(28, 5, 81);

-- --------------------------------------------------------

--
-- Структура таблицы `cooker_books`
--

CREATE TABLE `cooker_books` (
  `idCookerBook` bigint(20) UNSIGNED NOT NULL,
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `cooker_books`
--

INSERT INTO `cooker_books` (`idCookerBook`, `idUser`, `createdAt`, `updatedAt`) VALUES
(5, 6, '2020-02-08 09:29:48', '2020-02-08 09:29:48');

-- --------------------------------------------------------

--
-- Структура таблицы `doctor_info`
--

CREATE TABLE `doctor_info` (
  `idDoctorInfo` bigint(20) UNSIGNED NOT NULL,
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `surname` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth` timestamp NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `private_practice` double UNSIGNED DEFAULT NULL,
  `med_practice` double UNSIGNED DEFAULT NULL,
  `description` varchar(2500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passport` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(10) NOT NULL DEFAULT 0,
  `isConfirmed` tinyint(1) NOT NULL DEFAULT 0,
  `dayPay` timestamp NOT NULL,
  `sumPay` double UNSIGNED NOT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `updatedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `doctor_info`
--

INSERT INTO `doctor_info` (`idDoctorInfo`, `idUser`, `surname`, `name`, `second_name`, `birth`, `phone`, `private_practice`, `med_practice`, `description`, `passport`, `rating`, `isConfirmed`, `dayPay`, `sumPay`, `createdAt`, `updatedAt`) VALUES
(38, 12, 'Петрова', 'Елена', 'Васильевна', '1993-06-23 21:00:00', '+380669632514', 2, 5, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.', 'uploads/doctors//ytCJQ9XzwOWSDvMlOv6PkWyuQVw0B1w5ykHTJhpF.jpeg', 0, 0, '2020-03-20 15:54:51', 200, '2020-02-20 15:54:51', '2020-03-04 12:02:04'),
(41, 6, 'Иванов', 'Семен', 'Петрович', '1995-06-20 21:00:00', '+380501234569', 2, 5, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.', 'uploads/doctors//ldzPlynswJGqIgP7Q4JR21jBdxuwmKkQRVnEMHvM.jpeg', 2, 1, '2020-03-20 16:46:10', 200, '2020-02-20 16:46:10', '2020-03-06 08:56:31'),
(42, 14, 'Петров', 'Иван', 'Евгеньевич', '1989-03-02 21:00:00', '+380996324585', 2, 6, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.', 'uploads/doctors//yfwe3HD1jsOpiNK4DjfTqNhb5UVhaeTLrfaxsblA.jpeg', 0, 1, '2020-04-04 11:28:24', 200, '2020-03-04 11:28:24', '2020-03-08 06:03:28'),
(43, 15, 'Овчаренко', 'Ольга', 'Ивановна', '1991-03-03 21:00:00', '+380664568796', 5, 6, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.', 'uploads/doctors//TA33IRSnHqmrIDF19ppNgyBJFEyD9JTZ6UjurffP.jpeg', 1, 1, '2020-04-04 11:32:59', 200, '2020-03-04 11:32:59', '2020-03-06 08:47:11');

-- --------------------------------------------------------

--
-- Структура таблицы `ingredients`
--

CREATE TABLE `ingredients` (
  `idIngredient` bigint(20) UNSIGNED NOT NULL,
  `titleIngredient` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` int(10) UNSIGNED NOT NULL,
  `idRecipe` bigint(20) UNSIGNED NOT NULL,
  `idUnit` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `ingredients`
--

INSERT INTO `ingredients` (`idIngredient`, `titleIngredient`, `count`, `idRecipe`, `idUnit`) VALUES
(20, 'makaroni', 0, 79, 3),
(21, 'milk', 1, 79, 2),
(23, 'Мясо курицы', 1, 80, 2),
(24, 'Мука', 1, 80, 2),
(25, 'Картошка', 1, 77, 2),
(26, 'Мука', 2, 77, 2),
(27, 'яблоко', 1, 81, 13),
(28, 'Груша', 1, 81, 13);

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `idMessage` bigint(20) UNSIGNED NOT NULL,
  `idSender` bigint(20) UNSIGNED NOT NULL,
  `idTaker` bigint(20) UNSIGNED NOT NULL,
  `textMessage` varchar(2500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isRead` tinyint(1) NOT NULL DEFAULT 0,
  `createdAt` timestamp NOT NULL,
  `updatedAt` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`idMessage`, `idSender`, `idTaker`, `textMessage`, `isRead`, `createdAt`, `updatedAt`) VALUES
(1, 6, 11, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн.', 1, '2020-02-11 16:23:41', '2020-03-04 12:28:35'),
(2, 11, 6, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. ', 1, '2020-02-11 17:00:00', '2020-03-08 07:23:00'),
(86, 11, 6, 'В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн.', 1, '2020-03-02 08:30:43', '2020-03-08 07:23:00'),
(87, 11, 6, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн.', 1, '2020-03-02 12:06:26', '2020-03-08 07:23:00'),
(101, 6, 11, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне.', 1, '2020-03-02 15:08:46', '2020-03-04 12:28:35'),
(102, 6, 11, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне.', 1, '2020-03-02 15:10:36', '2020-03-04 12:28:35'),
(103, 6, 11, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне.', 1, '2020-03-02 15:12:10', '2020-03-04 12:28:35'),
(104, 6, 11, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне.', 1, '2020-03-02 15:12:51', '2020-03-04 12:28:35'),
(105, 6, 11, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне.', 1, '2020-03-02 15:14:57', '2020-03-04 12:28:35'),
(106, 6, 11, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне.', 1, '2020-03-02 15:14:57', '2020-03-04 12:28:35'),
(107, 6, 11, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне.', 1, '2020-03-02 15:15:45', '2020-03-04 12:28:35'),
(108, 6, 11, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне.', 1, '2020-03-02 15:20:35', '2020-03-04 12:28:35'),
(109, 6, 11, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне.', 1, '2020-03-02 15:21:00', '2020-03-04 12:28:35'),
(110, 6, 11, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне.', 1, '2020-03-02 15:45:39', '2020-03-04 12:28:35'),
(111, 6, 11, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне.', 1, '2020-03-02 15:46:01', '2020-03-04 12:28:35'),
(112, 6, 11, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне.', 1, '2020-03-02 15:48:46', '2020-03-04 12:28:35'),
(113, 13, 11, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века.', 1, '2020-03-03 06:00:45', '2020-03-08 07:22:39'),
(114, 13, 11, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века.', 1, '2020-03-03 06:06:59', '2020-03-08 07:22:39'),
(115, 13, 11, 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века.', 1, '2020-03-03 06:17:44', '2020-03-08 07:22:39'),
(116, 6, 11, 'http://localhost:1252/laravel/well-fed-home/public', 0, '2020-03-08 07:22:55', '2020-03-08 07:22:55');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_01_24_100240_create_roles_table', 1),
(4, '2020_01_24_144510_create_roles_user_table', 1),
(5, '2020_01_26_143413_create_categories_table', 2),
(6, '2020_01_26_143958_create_recipes_table', 2),
(7, '2020_01_27_111902_create_recipe_steps_table', 2),
(9, '2020_02_06_183736_create-comments', 3),
(10, '2020_02_07_184106_create-user-recipe-like', 4),
(11, '2020_02_07_184329_create-user-recipe-dislike', 4),
(12, '2020_02_08_071944_create_cooker_book', 5),
(13, '2020_02_08_073307_create_cookerbook_recipes', 5),
(14, '2020_02_11_183452_create_message_migration', 6),
(15, '2020_02_17_150211_create_services', 7),
(16, '2020_02_17_150934_ceate_servicies_users', 7),
(17, '2020_02_19_093027_create_doctor_info', 8),
(18, '2020_02_20_083044_update_recipe', 8),
(19, '2020_02_20_084653_create_specialty', 8),
(20, '2020_02_20_090424_create_user_doctor_like', 9),
(21, '2020_02_20_090656_create_user_doctor_dislike', 9),
(22, '2020_02_20_130415_update_services_user', 10),
(23, '2020_02_20_190213_update_service_user', 11),
(24, '2020_02_20_193508_create_services_users', 12),
(25, '2020_02_20_200325_update_doctor_info', 13),
(26, '2020_02_21_174547_create_unit', 14),
(27, '2020_02_21_174926_create_ingredients', 14),
(28, '2020_02_21_180434_delete_ingredient', 15),
(29, '2020_02_26_082829_add_user_is_block', 16),
(30, '2020_03_03_094825_delete_user_is_block', 17);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `recipes`
--

CREATE TABLE `recipes` (
  `idRecipe` bigint(20) UNSIGNED NOT NULL,
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `recipeTitle` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipePhoto` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recipeDescription` varchar(2500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idCategory` bigint(20) UNSIGNED NOT NULL,
  `timePrepare` int(10) UNSIGNED DEFAULT NULL,
  `calory` double UNSIGNED DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `updatedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `recipes`
--

INSERT INTO `recipes` (`idRecipe`, `idUser`, `recipeTitle`, `recipePhoto`, `recipeDescription`, `idCategory`, `timePrepare`, `calory`, `createdAt`, `updatedAt`) VALUES
(77, 6, 'Вареники с картошкой', 'uploads/recipe/Z2zJ9D6oY62hTlBdeoIF9dcPnFAiLEVRELgNWn6f.jpeg', 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.', 2, 45, 350, NULL, NULL),
(79, 6, 'Гороховый суп', 'uploads/recipe/NsAJYuQw4f2wF2eg32qV79h5h4Ms3yAiAlY1cSox.jpeg', 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.', 2, 60, 5, NULL, NULL),
(80, 6, 'Отбивные', 'uploads/recipe/VyUxmSY3gMeZgEtFzA91yRWt2SmZWHDOVjBuo4Jo.jpeg', 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.', 2, 45, 400, NULL, NULL),
(81, 13, 'Фруктовая запеканка', 'uploads/recipe/bLnVtYeH3s0C9x2aNeSdq1fAVaAGUlzfuwBvMGqm.jpeg', 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн.', 5, 25, 150, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `recipe_steps`
--

CREATE TABLE `recipe_steps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idRecipe` bigint(20) UNSIGNED NOT NULL,
  `stepPhoto` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stepNumber` int(10) UNSIGNED NOT NULL,
  `stepDescription` varchar(2500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `recipe_steps`
--

INSERT INTO `recipe_steps` (`id`, `idRecipe`, `stepPhoto`, `stepNumber`, `stepDescription`) VALUES
(90, 79, 'uploads/recipeStep/79/6Oa04t9LiNU883KprsaC5F4iBB79FWeHKNvtEYke.jpeg', 1, 'Крем завернуть в тесто'),
(91, 80, 'uploads/recipeStep/80/Pl2SNHyywW7Uy8dgxlrErtpxUvSYnyYA4oLwvbwA.jpeg', 1, 'Положите мясо в рукав'),
(92, 80, 'uploads/recipeStep/80/BfKbjvnfRSsrKcMVA50IX84d4OpbSlf4fQdsEvyf.jpeg', 2, 'Заверните начинку'),
(93, 77, NULL, 1, 'Положите мясо в рукав'),
(94, 77, NULL, 2, 'Заверните начинку');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `idRole` bigint(20) UNSIGNED NOT NULL,
  `titleRole` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`idRole`, `titleRole`) VALUES
(3, 'admin'),
(2, 'doctor'),
(1, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `roles_user`
--

CREATE TABLE `roles_user` (
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `idRole` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles_user`
--

INSERT INTO `roles_user` (`idUser`, `idRole`) VALUES
(4, 1),
(5, 1),
(6, 1),
(11, 3),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(14, 2),
(15, 2),
(6, 2),
(12, 2),
(16, 1),
(16, 2),
(17, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `idService` bigint(20) UNSIGNED NOT NULL,
  `titleService` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`idService`, `titleService`) VALUES
(2, 'Диета для женщин в период беременности'),
(3, 'Здоровое питание'),
(1, 'Коррекция веса'),
(4, 'Питание при различных заболеваниях');

-- --------------------------------------------------------

--
-- Структура таблицы `services_users`
--

CREATE TABLE `services_users` (
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `idService` bigint(20) UNSIGNED NOT NULL,
  `sum` double UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `services_users`
--

INSERT INTO `services_users` (`idUser`, `idService`, `sum`) VALUES
(6, 1, 300),
(6, 2, 300),
(12, 1, 300),
(12, 2, 500),
(12, 4, 400),
(14, 3, 200),
(15, 3, 150),
(15, 4, 450);

-- --------------------------------------------------------

--
-- Структура таблицы `specialty`
--

CREATE TABLE `specialty` (
  `idSpecialty` bigint(20) UNSIGNED NOT NULL,
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `titleSpecialty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urlDiplom` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `specialty`
--

INSERT INTO `specialty` (`idSpecialty`, `idUser`, `titleSpecialty`, `urlDiplom`) VALUES
(33, 12, 'Эдокринолог. Врач высшей категории', 'uploads/specialty//gdUGP1koQdtK7j2ClQXzlStwEi3lRFWqklmSOLYu.jpeg'),
(36, 6, 'Диетолог. Врач первой категории', 'uploads/specialty//bmn4WP4fjMDu2ENU7KMe9GSyploZZFIlaprSCXYp.jpeg'),
(37, 14, 'Эдокринолог. Врач высшей категории', 'uploads/specialty//6KDtOoamwEThF5Ab5YriJPPQfgDq9rsyTjV60RoI.jpeg'),
(38, 15, 'Диетолог. Врач первой категории', 'uploads/specialty//wPLwwlqiIcySg9pd7SVziUvts6FCEClAOnV9fb5F.jpeg'),
(39, 15, 'Эдокринолог. Врач высшей категории', 'uploads/specialty//Pob1Jy9RGUeM6dtZvx1Wcdr0NGnBOkFtThkJ8utH.jpeg');

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE `statuses` (
  `idStatus` bigint(20) UNSIGNED NOT NULL,
  `titleStatus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `statuses`
--

INSERT INTO `statuses` (`idStatus`, `titleStatus`) VALUES
(3, 'active_user'),
(1, 'anonim'),
(2, 'block_user');

-- --------------------------------------------------------

--
-- Структура таблицы `units`
--

CREATE TABLE `units` (
  `idUnit` bigint(20) UNSIGNED NOT NULL,
  `titleUnit` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `units`
--

INSERT INTO `units` (`idUnit`, `titleUnit`) VALUES
(5, 'гр'),
(2, 'кг'),
(1, 'л'),
(6, 'мл'),
(3, 'ст.л.'),
(4, 'ч.л.'),
(13, 'шт.');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userPhoto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` int(11) NOT NULL DEFAULT 0,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idStatus` bigint(20) UNSIGNED NOT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `updatedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `userPhoto`, `rating`, `email`, `email_verified_at`, `password`, `remember_token`, `idStatus`, `createdAt`, `updatedAt`) VALUES
(4, 'Dimon', NULL, 0, 'dimon@gmail.com', NULL, '$2y$10$DRPNJsNkOB5dUf12v4CKd.2VpWwTCH5LzNzuQ6tr28SOygTZ.4xpC', NULL, 3, '2020-01-24 18:45:02', '2020-02-26 07:11:52'),
(5, 'valy', NULL, 0, 'valy@gmail.com', NULL, '$2y$10$nXFYnnAkm9Q4KBv.EyqlDu3ORXL8iOVI7ExFVVubHsYv36tt2XoQa', NULL, 3, '2020-01-24 18:52:27', '2020-03-03 06:26:30'),
(6, 'Semen', 'uploads/user/BltSf3irnqFCC16ENFJjZOz8J0FLSljotpqhdiMz.jpeg', 3, 'semen@gmail.com', NULL, '$2y$10$XwUV32S5hgHv0zpo55Bgwuqm/yhsqX8eXyJofKYmVmKs9DhZ2EzY6', 'Afd3K2EPWt1KT5PslFF0Y4nUYvj0Jxiebh9qFMqOcuH3wpCmFStu04c105GQ', 3, '2020-01-29 06:29:28', '2020-02-22 08:55:13'),
(11, 'Enga', NULL, 0, 'enga@gmail.com', NULL, '$2y$10$jlJlN3JirBg/teBWInShueeiQf94GDVRn3If2CQM9vsgJEBS6hvU2', NULL, 3, '2020-02-06 12:05:47', '2020-02-06 12:05:47'),
(12, 'lena', NULL, 0, 'lena@gmail.com', NULL, '$2y$10$zLvjWbE5R2jW41tv58dZ5.B81vbKFXXV/znQsOBMiZeslfAZZyntm', NULL, 3, '2020-02-20 15:52:13', '2020-02-20 15:52:13'),
(13, 'sasa', NULL, 0, 'sasa@gmail.com', NULL, '$2y$10$5UvoRXo0MN4kRr0DIgTs0e9ntneVCJGNoXx4iHfdwHP1yDFXMdFS2', NULL, 3, '2020-03-02 08:45:37', '2020-03-03 06:40:15'),
(14, 'ivan', NULL, 0, 'ivan@gmail.com', NULL, '$2y$10$2jNQpluFrRvBE29w5MhTCekzXm2t6zCE5r5r11Oeq0OEyJkYqiiDS', NULL, 3, '2020-03-04 11:20:51', '2020-03-04 11:20:51'),
(15, 'olga', NULL, 0, 'olga@gmail.com', NULL, '$2y$10$Ppo2tufinMWkoBLWUmiHH.vBld.a2eTYM6qVfzT/bC7d9ehT2gHD2', NULL, 3, '2020-03-04 11:30:41', '2020-03-04 11:30:41'),
(16, 'ira', NULL, 0, 'ira@gmail.com', NULL, '$2y$10$bjHFiFcaWS7RCE5Ko.3diO4LuyAmdmNVtTXO6LbrKORa.wiRfOKHy', NULL, 3, '2020-03-04 12:35:16', '2020-03-04 12:35:16'),
(17, 'natali', NULL, 0, 'natali@gmail.com', NULL, '$2y$10$j.ZbcKyJcvi./Ft1CUBlkO8QoRR4xcqyqmqFOIUmyPWvEbqG9O1cW', NULL, 3, '2020-03-08 05:24:29', '2020-03-08 05:24:29');

-- --------------------------------------------------------

--
-- Структура таблицы `user_doctor_dislike`
--

CREATE TABLE `user_doctor_dislike` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `idDoctorInfo` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_doctor_dislike`
--

INSERT INTO `user_doctor_dislike` (`id`, `idUser`, `idDoctorInfo`) VALUES
(7, 6, 42);

-- --------------------------------------------------------

--
-- Структура таблицы `user_doctor_like`
--

CREATE TABLE `user_doctor_like` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `idDoctorInfo` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_doctor_like`
--

INSERT INTO `user_doctor_like` (`id`, `idUser`, `idDoctorInfo`) VALUES
(8, 6, 41);

-- --------------------------------------------------------

--
-- Структура таблицы `user_recipe_dislike`
--

CREATE TABLE `user_recipe_dislike` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `idRecipe` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `user_recipe_like`
--

CREATE TABLE `user_recipe_like` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `idRecipe` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_recipe_like`
--

INSERT INTO `user_recipe_like` (`id`, `idUser`, `idRecipe`) VALUES
(8, 6, 77);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`idCategory`),
  ADD UNIQUE KEY `categories_categorytitle_unique` (`categoryTitle`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`idComment`),
  ADD KEY `comments_iduser_foreign` (`idUser`),
  ADD KEY `comments_idrecipe_foreign` (`idRecipe`);

--
-- Индексы таблицы `cookerbook_recipes`
--
ALTER TABLE `cookerbook_recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cookerbook_recipes_idcookerbook_foreign` (`idCookerBook`),
  ADD KEY `cookerbook_recipes_idrecipe_foreign` (`idRecipe`);

--
-- Индексы таблицы `cooker_books`
--
ALTER TABLE `cooker_books`
  ADD PRIMARY KEY (`idCookerBook`),
  ADD KEY `cooker_books_iduser_foreign` (`idUser`);

--
-- Индексы таблицы `doctor_info`
--
ALTER TABLE `doctor_info`
  ADD PRIMARY KEY (`idDoctorInfo`),
  ADD UNIQUE KEY `doctor_info_iduser_unique` (`idUser`);

--
-- Индексы таблицы `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`idIngredient`),
  ADD KEY `ingredients_idrecipe_foreign` (`idRecipe`),
  ADD KEY `ingredients_idunit_foreign` (`idUnit`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`idMessage`),
  ADD KEY `messages_idsender_foreign` (`idSender`),
  ADD KEY `messages_idtaker_foreign` (`idTaker`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`idRecipe`),
  ADD KEY `recipes_iduser_foreign` (`idUser`),
  ADD KEY `recipes_idcategory_foreign` (`idCategory`);

--
-- Индексы таблицы `recipe_steps`
--
ALTER TABLE `recipe_steps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipe_steps_idrecipe_foreign` (`idRecipe`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRole`),
  ADD UNIQUE KEY `roles_titlerole_unique` (`titleRole`);

--
-- Индексы таблицы `roles_user`
--
ALTER TABLE `roles_user`
  ADD KEY `roles_user_idrole_foreign` (`idRole`),
  ADD KEY `idRole` (`idUser`) USING BTREE;

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`idService`),
  ADD UNIQUE KEY `services_titleservice_unique` (`titleService`);

--
-- Индексы таблицы `services_users`
--
ALTER TABLE `services_users`
  ADD UNIQUE KEY `services_users_iduser_idservice_unique` (`idUser`,`idService`),
  ADD KEY `services_users_idservice_foreign` (`idService`);

--
-- Индексы таблицы `specialty`
--
ALTER TABLE `specialty`
  ADD PRIMARY KEY (`idSpecialty`),
  ADD KEY `specialty_iduser_foreign` (`idUser`);

--
-- Индексы таблицы `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`idStatus`),
  ADD UNIQUE KEY `statuses_titlestatus_unique` (`titleStatus`);

--
-- Индексы таблицы `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`idUnit`),
  ADD UNIQUE KEY `units_titleunit_unique` (`titleUnit`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_idstatus_foreign` (`idStatus`);

--
-- Индексы таблицы `user_doctor_dislike`
--
ALTER TABLE `user_doctor_dislike`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_doctor_dislike_iduser_foreign` (`idUser`),
  ADD KEY `user_doctor_dislike_iddoctorinfo_foreign` (`idDoctorInfo`);

--
-- Индексы таблицы `user_doctor_like`
--
ALTER TABLE `user_doctor_like`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_doctor_like_iduser_foreign` (`idUser`),
  ADD KEY `user_doctor_like_iddoctorinfo_foreign` (`idDoctorInfo`);

--
-- Индексы таблицы `user_recipe_dislike`
--
ALTER TABLE `user_recipe_dislike`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_recipe_dislike_iduser_foreign` (`idUser`),
  ADD KEY `user_recipe_dislike_idrecipe_foreign` (`idRecipe`);

--
-- Индексы таблицы `user_recipe_like`
--
ALTER TABLE `user_recipe_like`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_recipe_like_iduser_foreign` (`idUser`),
  ADD KEY `user_recipe_like_idrecipe_foreign` (`idRecipe`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `idCategory` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `idComment` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `cookerbook_recipes`
--
ALTER TABLE `cookerbook_recipes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `cooker_books`
--
ALTER TABLE `cooker_books`
  MODIFY `idCookerBook` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `doctor_info`
--
ALTER TABLE `doctor_info`
  MODIFY `idDoctorInfo` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблицы `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `idIngredient` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `idMessage` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `recipes`
--
ALTER TABLE `recipes`
  MODIFY `idRecipe` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT для таблицы `recipe_steps`
--
ALTER TABLE `recipe_steps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `idRole` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `idService` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `specialty`
--
ALTER TABLE `specialty`
  MODIFY `idSpecialty` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблицы `statuses`
--
ALTER TABLE `statuses`
  MODIFY `idStatus` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `units`
--
ALTER TABLE `units`
  MODIFY `idUnit` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `user_doctor_dislike`
--
ALTER TABLE `user_doctor_dislike`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `user_doctor_like`
--
ALTER TABLE `user_doctor_like`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `user_recipe_dislike`
--
ALTER TABLE `user_recipe_dislike`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user_recipe_like`
--
ALTER TABLE `user_recipe_like`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_idrecipe_foreign` FOREIGN KEY (`idRecipe`) REFERENCES `recipes` (`idRecipe`),
  ADD CONSTRAINT `comments_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `cookerbook_recipes`
--
ALTER TABLE `cookerbook_recipes`
  ADD CONSTRAINT `cookerbook_recipes_idcookerbook_foreign` FOREIGN KEY (`idCookerBook`) REFERENCES `cooker_books` (`idCookerBook`),
  ADD CONSTRAINT `cookerbook_recipes_idrecipe_foreign` FOREIGN KEY (`idRecipe`) REFERENCES `recipes` (`idRecipe`);

--
-- Ограничения внешнего ключа таблицы `cooker_books`
--
ALTER TABLE `cooker_books`
  ADD CONSTRAINT `cooker_books_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `doctor_info`
--
ALTER TABLE `doctor_info`
  ADD CONSTRAINT `doctor_info_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `ingredients_idrecipe_foreign` FOREIGN KEY (`idRecipe`) REFERENCES `recipes` (`idRecipe`),
  ADD CONSTRAINT `ingredients_idunit_foreign` FOREIGN KEY (`idUnit`) REFERENCES `units` (`idUnit`);

--
-- Ограничения внешнего ключа таблицы `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_idsender_foreign` FOREIGN KEY (`idSender`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_idtaker_foreign` FOREIGN KEY (`idTaker`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_idcategory_foreign` FOREIGN KEY (`idCategory`) REFERENCES `categories` (`idCategory`),
  ADD CONSTRAINT `recipes_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `recipe_steps`
--
ALTER TABLE `recipe_steps`
  ADD CONSTRAINT `recipe_steps_idrecipe_foreign` FOREIGN KEY (`idRecipe`) REFERENCES `recipes` (`idRecipe`);

--
-- Ограничения внешнего ключа таблицы `roles_user`
--
ALTER TABLE `roles_user`
  ADD CONSTRAINT `roles_user_idrole_foreign` FOREIGN KEY (`idRole`) REFERENCES `roles` (`idRole`),
  ADD CONSTRAINT `roles_user_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `services_users`
--
ALTER TABLE `services_users`
  ADD CONSTRAINT `services_users_idservice_foreign` FOREIGN KEY (`idService`) REFERENCES `services` (`idService`),
  ADD CONSTRAINT `services_users_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `specialty`
--
ALTER TABLE `specialty`
  ADD CONSTRAINT `specialty_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_idstatus_foreign` FOREIGN KEY (`idStatus`) REFERENCES `statuses` (`idStatus`);

--
-- Ограничения внешнего ключа таблицы `user_doctor_dislike`
--
ALTER TABLE `user_doctor_dislike`
  ADD CONSTRAINT `user_doctor_dislike_iddoctorinfo_foreign` FOREIGN KEY (`idDoctorInfo`) REFERENCES `doctor_info` (`idDoctorInfo`),
  ADD CONSTRAINT `user_doctor_dislike_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_doctor_like`
--
ALTER TABLE `user_doctor_like`
  ADD CONSTRAINT `user_doctor_like_iddoctorinfo_foreign` FOREIGN KEY (`idDoctorInfo`) REFERENCES `doctor_info` (`idDoctorInfo`),
  ADD CONSTRAINT `user_doctor_like_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_recipe_dislike`
--
ALTER TABLE `user_recipe_dislike`
  ADD CONSTRAINT `user_recipe_dislike_idrecipe_foreign` FOREIGN KEY (`idRecipe`) REFERENCES `recipes` (`idRecipe`),
  ADD CONSTRAINT `user_recipe_dislike_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_recipe_like`
--
ALTER TABLE `user_recipe_like`
  ADD CONSTRAINT `user_recipe_like_idrecipe_foreign` FOREIGN KEY (`idRecipe`) REFERENCES `recipes` (`idRecipe`),
  ADD CONSTRAINT `user_recipe_like_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
