-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-05-2024 a las 04:55:32
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `servyviajes_two`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `academic_grades`
--

CREATE TABLE `academic_grades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `events_id` bigint(20) UNSIGNED NOT NULL,
  `estatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `academic_grades`
--

INSERT INTO `academic_grades` (`id`, `descripcion`, `events_id`, `estatus`, `created_at`, `updated_at`) VALUES
(19, 'hola 1', 25, 1, '2024-01-17 23:56:35', '2024-01-17 23:56:35'),
(20, 'hola 2', 25, 1, '2024-01-17 23:56:35', '2024-01-17 23:56:35'),
(23, 'bebe 1', 24, 1, '2024-01-17 23:57:35', '2024-01-17 23:57:35'),
(28, 'grado 1', 26, 1, '2024-02-12 02:26:40', '2024-02-12 02:26:40'),
(29, 'grado 2', 26, 1, '2024-02-12 02:26:40', '2024-02-12 02:26:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assistants`
--

CREATE TABLE `assistants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `codigo_beca` varchar(255) DEFAULT NULL,
  `categoria_id` bigint(20) UNSIGNED NOT NULL,
  `grado_academico` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido_paterno` varchar(255) DEFAULT NULL,
  `apellido_materno` varchar(255) DEFAULT NULL,
  `correo_electronico` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) NOT NULL,
  `comentario` mediumtext DEFAULT NULL,
  `pais_id` bigint(20) UNSIGNED NOT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `especialidad` varchar(255) DEFAULT NULL,
  `institucion` varchar(255) DEFAULT NULL,
  `evento_id` bigint(20) UNSIGNED NOT NULL,
  `facturacion` int(11) NOT NULL,
  `rfc` varchar(255) DEFAULT NULL,
  `nombre_fiscal` varchar(255) DEFAULT NULL,
  `correo_facturacion` varchar(255) DEFAULT NULL,
  `codigo_postal` varchar(255) DEFAULT NULL,
  `regimen_fiscal_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cfdi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comentario_facturacion` mediumtext DEFAULT NULL,
  `estatus` int(11) NOT NULL,
  `monto_total` double(8,2) DEFAULT NULL,
  `tipo_pago_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estatus_de_pago` int(11) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `descuento` double(8,2) DEFAULT NULL,
  `academic_grade_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `assistants`
--

INSERT INTO `assistants` (`id`, `codigo_beca`, `categoria_id`, `grado_academico`, `nombre`, `apellido_paterno`, `apellido_materno`, `correo_electronico`, `telefono`, `comentario`, `pais_id`, `estado`, `ciudad`, `especialidad`, `institucion`, `evento_id`, `facturacion`, `rfc`, `nombre_fiscal`, `correo_facturacion`, `codigo_postal`, `regimen_fiscal_id`, `cfdi_id`, `comentario_facturacion`, `estatus`, `monto_total`, `tipo_pago_id`, `created_at`, `updated_at`, `estatus_de_pago`, `user_id`, `descuento`, `academic_grade_id`) VALUES
(1, 'wwwwwww', 8, 'asdsad', 'sdfsa', 'sadfsd', 'sadfsd', 'sdfsa', 'sfsad', 'sdfas', 1, 'sdfsd', 'sadfas', 'asdfs', 'sadfsa', 20, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 555.00, 1, '2023-12-12 23:53:49', '2023-12-12 23:53:49', 1, NULL, NULL, NULL),
(2, 'sdfsd', 8, 'dsafsd', 'asdfsa', 'asdfs', 'asdfsda', 'sadfsa', 'asdf', 'sadfas', 1, 'sdfsa', 'asdfsa', 'asfsad', 'safas', 20, 1, 'sdfsd', 'sadfs', 'asfsad', 'safsa', 1, 1, 'sadfs', 1, 555.00, 1, '2023-12-13 00:02:21', '2023-12-13 00:02:21', 2, NULL, NULL, NULL),
(3, 'gjgj', 8, 'sdfsa', 'safs', 'sadfs', 'safsad', 'sadfsad', 'sadfsa', 'asdfsa', 1, 'sdfas', 'sadfas', 'sdafsa', 'asfs', 20, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 555.00, 1, '2023-12-13 01:41:45', '2023-12-13 01:41:45', 3, NULL, NULL, NULL),
(4, 'sdfsdfsad', 8, 'sdfsad', 'sadfsa', 'sadfsad', 'sadfsa', 'sadfdsa', 'sdfs', 'sadfsa', 1, 'sdfsa', 'safsa', 'safsa', 'safsa', 20, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 555.00, 1, '2023-12-13 01:45:59', '2023-12-13 01:45:59', 0, NULL, NULL, NULL),
(5, 'beca123', 8, 'acade jorge', 'jorge', 'vargas', 'mora', 'jorge@test.com', '042444', 'comentarios', 1, 'estado', 'ciudad', 'especial', 'institu', 20, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 555.00, 1, '2023-12-13 02:36:25', '2023-12-13 02:36:25', 1, NULL, NULL, NULL),
(6, 'dfsafsdf', 8, 'safsadfsa', 'dsfsad', 'safsdfsadf', 'dfsadfsadf', 'sdafsfs@gmail.com', '5645646', 'sdfasd', 1, 'dsfs', 'sfsdf', 'asdfsa', 'sadfsdf', 21, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 900.01, 1, '2023-12-14 01:36:32', '2023-12-14 01:36:32', 1, NULL, NULL, NULL),
(7, 'dsdfs', 8, 'sdfdsf', 'sdfsda', 'sdfdsf', 'sadfsa', 'sadfasd@gmail.com', '5446546', NULL, 1, 'das', 'sdfsad', 'sadfasd', 'sadfsd', 21, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 900.01, 1, '2023-12-14 01:51:16', '2023-12-14 01:51:16', 1, NULL, NULL, NULL),
(8, 'sdfsadf 858585', 2, 'sdfsadf', 'asdfsd', 'safsd', 'asfsd', 'sadfasd@gmail.com', '64564564', 'ddd', 1, 'sdfsadf', 'asfsd', 'sfsaf', 'asdfasdf', 21, 1, 'sdfdsa', 'dfd', 'dfsf', 'dfasdfsa', 1, 1, 'asfdasdfa', 1, 0.00, 1, '2023-12-14 22:14:07', '2023-12-14 22:14:07', 1, NULL, NULL, NULL),
(9, 'asdasdasd', 4, 'dddf', 'd', 'fsdf', 'dfadsf', 'sadfsd@gmail.com', '5415464', NULL, 1, 'dfdfd', 'fd', 'dfdaf', 'sdfsd', 21, 1, 'sdfsdf', 'sadfs', 'safsdf', 'dsfasd', 1, 1, 'sdfds', 1, 752.24, 1, '2023-12-14 22:19:43', '2023-12-14 22:19:43', 1, NULL, NULL, NULL),
(10, 'codigo beca', 8, 'sdfsd', 'sdfsd', 'sadfsadf', 'sadfsad', 'sdfsadf@gmail.com', '456464', NULL, 1, 'sdfsa', 'asdfsa', 'asdfsadas', 'fsad', 21, 1, 'rfcccc', 'sdfsd', 'sdfsdf', 'safs', 1, 1, NULL, 1, 900.01, 1, '2023-12-14 23:23:08', '2023-12-20 21:37:04', 1, NULL, NULL, NULL),
(11, 'Codigo beca', 5, 'Grado', 'Nombre', 'Apellido p', 'Apellido m', 'correo@gmail.com', '5456467', 'comentarios', 1, 'Estado', 'Ciudad', 'Especialidad', 'Institucion', 23, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 821.00, 1, '2023-12-18 21:42:16', '2023-12-20 22:33:56', 1, NULL, NULL, NULL),
(12, NULL, 5, 'gradoootesttttt', 'nombreff', 'ape', 'ape', 'correo@gmail.com', '46546546546546', NULL, 1, 'estadi', 'ciudad', 'especialidad', 'institucq', 23, 1, 'rfc', 'filscal', 'corre', 'cd', NULL, NULL, 'comentario', 1, 821.00, 1, '2024-01-05 21:29:45', '2024-01-05 22:56:10', 1, NULL, NULL, NULL),
(13, 'sdfs354135', 8, 'sdfdsa', 'sadfds', 'sdfsad', 'sdfsadfsd', 'dfasdasd@gmail.com', '5465465456', NULL, 1, 'esfasd', 'sdafsdf', 'sadfsad', 'sdfsadf', 24, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10.00, 1, '2024-01-17 01:26:52', '2024-01-17 01:26:52', 1, NULL, NULL, NULL),
(14, 'sdfs354135', 8, 'sdfsadf', 'sdfsadlflk', 'kjsafklsjadklj', 'kjsdklfjsdklfj', 'jlksdjsdf@gmail.com', '4654654654', NULL, 1, 'sdfsad', 'safsad', 'safsa', 'asfsafsa', 20, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 900.01, 1, '2024-01-17 01:29:21', '2024-01-17 01:29:21', 1, NULL, 10.00, NULL),
(15, 'sdfs354135', 8, 'dsfasd', 'sdahfshdfjkh', 'jkhdsfkjashdkjh', 'kjhasdkjfhdskjh', 'kjfhaskj@gmail.com', '576547', NULL, 1, 'sdfsd', 'asdfas', 'sdfasd', 'dsfsaf', 20, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 810.01, 1, '2024-01-17 01:33:05', '2024-01-17 01:33:05', 1, NULL, 10.00, NULL),
(16, 'sdfs354135', 8, 'sdafsdfsa', 'sdfsadh', 'sjdfjsdaj', 'sdfisajdoi', 'oisdjfaosd@gmnaiol.c0', '545465', NULL, 1, 'sdfsd', 'asdfsad', 'sdfsadf', 'asdfsdf', 20, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 810.01, 1, '2024-01-17 01:58:20', '2024-01-17 01:58:20', 1, NULL, 10.00, NULL),
(17, 'sdfs354135', 8, 'sdafsdfsa', 'sdfsadh', 'sjdfjsdaj', 'sdfisajdoi', 'oisdjfaosd@gmnaiol.c0', '545465', NULL, 1, 'sdfsd', 'asdfsad', 'sdfsadf', 'asdfsdf', 20, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 810.01, 1, '2024-01-17 02:00:40', '2024-01-17 02:00:40', 1, NULL, 10.00, NULL),
(18, 'sdfs354135', 8, 'sdafsdfsa', 'sdfsadh', 'sjdfjsdaj', 'sdfisajdoi', 'oisdjfaosd@gmnaiol.c0', '545465', NULL, 1, 'sdfsd', 'asdfsad', 'sdfsadf', 'asdfsdf', 20, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 499.50, 1, '2024-01-17 02:02:38', '2024-01-17 02:02:38', 1, NULL, 10.00, NULL),
(19, 'sdfs354135', 8, 'sdafsdfsa', 'sdfsadh', 'sjdfjsdaj', 'sdfisajdoi', 'oisdjfaosd@gmnaiol.c0', '545465', NULL, 1, 'sdfsd', 'asdfsad', 'sdfsadf', 'asdfsdf', 20, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 499.50, 1, '2024-01-17 02:05:03', '2024-01-17 02:05:03', 1, NULL, 10.00, NULL),
(20, 'sdfs354135', 8, 'dfasdfs', 'asdfasd', 'sadfsadfkj', 'kjsahdfkjsadh', 'kjsadhfksjah@gmail.com', '44654654', NULL, 1, 'sdfasdf', 'sdfsdfsaf', 'sadfsdfsd', 'sadfsadf', 20, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 499.50, 1, '2024-01-17 02:06:14', '2024-01-17 02:06:14', 1, NULL, 10.00, NULL),
(21, 'sdfs354135', 8, 'sdfsaf', 'dsflksjdflj', 'lkjdflkajsdflk', 'sdafklsadj', 'klasjdflksj@gmail.com', '54564654', NULL, 1, 'sdfsad', 'asfasdf', 'asdfsad', 'asdfsad', 20, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 499.50, 1, '2024-01-17 02:07:52', '2024-01-17 02:07:52', 1, NULL, 10.00, NULL),
(22, NULL, 3, 'grado 1', 'dfasdf', 'fsafds', 'fdsafs', 'fsadfsd@fsadfsd', '4353453453', NULL, 1, 'fgsfd', 'gsdfg', 'sfgdfg', 'dsffg', 26, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10.00, 2, '2024-03-25 07:37:27', '2024-03-25 07:37:27', 1, NULL, 0.00, NULL),
(23, NULL, 3, 'grado 1', 'dfasdf', 'fsafds', 'fdsafs', 'fsadfsd@fsadfsd', '4353453453', NULL, 1, 'fgsfd', 'gsdfg', 'sfgdfg', 'dsffg', 26, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10.00, 2, '2024-03-25 07:44:21', '2024-03-25 07:44:21', 1, NULL, 0.00, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `available_categories`
--

CREATE TABLE `available_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `costo` double(8,2) NOT NULL,
  `events_id` bigint(20) UNSIGNED NOT NULL,
  `estatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `available_categories`
--

INSERT INTO `available_categories` (`id`, `category_id`, `costo`, `events_id`, `estatus`, `created_at`, `updated_at`) VALUES
(6, 8, 555.00, 20, 1, '2023-12-07 00:30:21', '2023-12-07 00:30:21'),
(14, 8, 900.01, 21, 1, '2023-12-09 01:56:17', '2023-12-09 01:56:17'),
(15, 5, 150.52, 21, 1, '2023-12-09 01:56:17', '2023-12-09 01:56:17'),
(16, 4, 752.24, 21, 1, '2023-12-09 01:56:17', '2023-12-09 01:56:17'),
(17, 2, 152.58, 21, 1, '2023-12-09 01:56:17', '2023-12-09 01:56:17'),
(18, 8, 250.52, 19, 1, '2023-12-09 01:56:58', '2023-12-09 01:56:58'),
(20, 1, 700.00, 22, 1, '2023-12-15 23:07:15', '2023-12-15 23:07:15'),
(30, 5, 10.00, 23, 1, '2024-01-17 00:50:33', '2024-01-17 00:50:33'),
(47, 8, 10.00, 25, 1, '2024-01-17 23:56:35', '2024-01-17 23:56:35'),
(48, 5, 20.00, 25, 1, '2024-01-17 23:56:35', '2024-01-17 23:56:35'),
(51, 8, 10.00, 24, 1, '2024-01-17 23:57:35', '2024-01-17 23:57:35'),
(52, 5, 50.00, 24, 1, '2024-01-17 23:57:35', '2024-01-17 23:57:35'),
(58, 3, 10.00, 26, 1, '2024-02-12 02:26:40', '2024-02-12 02:26:40'),
(59, 5, 19.99, 26, 1, '2024-02-12 02:26:40', '2024-02-12 02:26:40'),
(60, 1, 80.00, 26, 1, '2024-02-12 02:26:40', '2024-02-12 02:26:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `landing_eventos_id` bigint(20) UNSIGNED DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `banners`
--

INSERT INTO `banners` (`id`, `landing_eventos_id`, `banner`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '8f9cb14a29.jpeg', '2024-01-05 20:12:17', '2024-01-05 20:13:54', '2024-01-05 20:13:54'),
(2, 1, '8f9cb14a29.jpeg', '2024-01-05 20:13:54', '2024-01-05 20:13:54', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `estatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `descripcion`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'Categoría 6', 1, '2023-11-13 22:36:20', '2023-12-07 00:29:40'),
(2, 'Categoría 5', 0, '2023-11-13 22:36:29', '2023-12-14 22:18:19'),
(3, 'Categoría 4', 1, '2023-11-14 05:04:24', '2023-12-07 00:29:17'),
(4, 'Categoría 3', 1, '2023-11-14 05:04:38', '2023-12-07 00:29:06'),
(5, 'Categoría 2', 1, '2023-11-14 15:17:58', '2023-12-07 00:28:50'),
(6, 'conferencista1', 2, '2023-11-15 14:56:55', '2023-11-15 14:57:11'),
(7, '´´´+', 2, '2023-11-15 16:23:51', '2023-11-16 14:43:10'),
(8, 'Categoría 1', 1, '2023-11-15 21:59:03', '2023-12-07 00:28:35'),
(9, 'Hostess', 0, '2023-11-16 14:43:01', '2023-12-02 01:38:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cfdi`
--

CREATE TABLE `cfdi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `estatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cfdi`
--

INSERT INTO `cfdi` (`id`, `nombre`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'CFDI', 1, '2023-12-06 18:43:38', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `constancies`
--

CREATE TABLE `constancies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `estatus` int(11) DEFAULT NULL,
  `assistants_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `constancies`
--

INSERT INTO `constancies` (`id`, `nombre`, `estatus`, `assistants_id`, `created_at`, `updated_at`) VALUES
(1, '1702410829_constancia.pdf', 1, 1, '2023-12-12 23:53:49', '2023-12-12 23:53:49'),
(2, '1702411341_constancia.jpg', 1, 2, '2023-12-13 00:02:21', '2023-12-13 00:02:21'),
(3, '1702417305_constancia.jpg', 1, 3, '2023-12-13 01:41:45', '2023-12-13 01:41:45'),
(4, '1702417559_constancia.pdf', 1, 4, '2023-12-13 01:45:59', '2023-12-13 01:45:59'),
(5, '1702420586_constancia.pdf', 1, 5, '2023-12-13 02:36:26', '2023-12-13 02:36:26'),
(6, '1702503393_constancia.jpg', 1, 6, '2023-12-14 01:36:33', '2023-12-14 01:36:33'),
(7, '1702504276_constancia.jpg', 1, 7, '2023-12-14 01:51:16', '2023-12-14 01:51:16'),
(8, '1702577647_constancia.jpg', 1, 8, '2023-12-14 22:14:07', '2023-12-14 22:14:07'),
(9, '1702577983_constancia.jpg', 1, 9, '2023-12-14 22:19:43', '2023-12-14 22:19:43'),
(10, '1702581788_constancia.jpg', 1, 10, '2023-12-14 23:23:08', '2023-12-14 23:23:08'),
(11, '1704480970_constancia.jpg', 1, 12, '2024-01-05 22:56:10', '2024-01-05 22:56:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countrys`
--

CREATE TABLE `countrys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `estatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `countrys`
--

INSERT INTO `countrys` (`id`, `nombre`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'México', 1, '2023-12-06 18:43:59', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `porcentaje` double(8,2) NOT NULL,
  `vigencia` date NOT NULL,
  `codigo_descuento` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cantidad_disponible` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `discounts`
--

INSERT INTO `discounts` (`id`, `nombre`, `porcentaje`, `vigencia`, `codigo_descuento`, `cantidad`, `estatus`, `created_at`, `updated_at`, `cantidad_disponible`) VALUES
(1, 'nombre descuento', 10.00, '2023-12-18', 'sdfs354135', 8, 1, '2023-12-15 23:10:57', '2024-01-17 02:07:52', 7),
(2, 'xdetg', 10.00, '2023-12-23', 'sdfsfafs', 8, 1, '2023-12-18 20:55:22', '2023-12-18 20:55:22', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `sede` varchar(255) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_termino` date NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `politicas` mediumtext NOT NULL,
  `hotel_id` bigint(20) UNSIGNED DEFAULT NULL,
  `estatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `beneficiario` varchar(255) DEFAULT NULL,
  `banco` varchar(255) DEFAULT NULL,
  `numero_cuenta` varchar(255) DEFAULT NULL,
  `clabe_interbancaria` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `events`
--

INSERT INTO `events` (`id`, `nombre`, `sede`, `fecha_inicio`, `fecha_termino`, `descripcion`, `politicas`, `hotel_id`, `estatus`, `created_at`, `updated_at`, `beneficiario`, `banco`, `numero_cuenta`, `clabe_interbancaria`) VALUES
(13, 'jorge', 'calabozo', '2023-11-28', '2023-11-28', 'Good hotel', 'Politica', 1, 2, '2023-11-29 19:58:17', '2023-11-29 19:58:17', NULL, NULL, NULL, NULL),
(14, 'jorges', 'calabozo', '2023-11-28', '2023-11-28', 'Good hotel', 'Politica', 1, 2, '2023-11-29 20:00:34', '2023-11-29 20:00:34', NULL, NULL, NULL, NULL),
(15, 'Evento 5', 'calabozo', '2023-11-28', '2023-11-28', 'Good hotel', 'Politica', 1, 2, '2023-11-29 20:08:05', '2023-12-07 00:31:02', NULL, NULL, NULL, NULL),
(16, 'jorges44ss', 'calabozo', '2023-11-28', '2023-11-28', 'Good hotel', 'Politica', 1, 2, '2023-11-29 20:11:05', '2023-11-30 01:46:19', NULL, NULL, NULL, NULL),
(17, 'Evento 4', 'sede', '2023-11-06', '2023-11-07', 'des', 'poli', 2, 2, '2023-11-30 01:32:22', '2023-12-07 00:31:24', NULL, NULL, NULL, NULL),
(18, 'miguel', 'sedeeeeeee', '2023-11-19', '2023-12-20', 'bebebbebeb', 'papapappapa', 1, 2, '2023-11-30 01:35:56', '2023-11-30 01:45:34', NULL, NULL, NULL, NULL),
(19, 'Evento 3', 'sede', '2023-11-08', '2023-11-13', 'descripcion', 'politicas', 2, 2, '2023-11-30 19:37:10', '2023-12-07 00:31:15', NULL, NULL, NULL, NULL),
(20, 'Evento 2', 'sedds', '2023-11-06', '2023-11-02', 'desc', 'politicas', 2, 2, '2023-11-30 20:25:56', '2023-12-07 00:30:21', NULL, NULL, NULL, NULL),
(21, 'Evento 1', 'holaaaa333', '2023-12-18', '2023-12-19', 'ddd', 'eee', 2, 2, '2023-12-01 20:54:22', '2023-12-07 00:30:08', NULL, NULL, NULL, NULL),
(22, 'evento hoy', 'evento hoy', '2023-12-14', '2023-12-15', 'deevento hoy', 'deevento hoy', 1, 2, '2023-12-15 00:32:50', '2023-12-15 23:07:14', NULL, NULL, NULL, NULL),
(23, 'Evento calabozo', 'Evento calabozo', '2023-12-19', '2023-12-19', 'Evento calabozo', 'Evento calabozo', 1, 2, '2023-12-15 23:09:08', '2023-12-15 23:09:08', NULL, NULL, NULL, NULL),
(24, 'testttttttttt testttttttttt', 'testttttttttt testttttttttt', '2023-12-21', '2023-12-22', 'testttttttttt testttttttttt', 'testttttttttt testttttttttt', NULL, 2, '2023-12-21 20:10:51', '2024-01-17 00:50:25', NULL, NULL, NULL, NULL),
(25, 'evento miguel', 'evento miguel', '2024-01-17', '2024-01-31', 'des', 'polidd', 1, 1, '2024-01-17 22:52:25', '2024-01-17 22:52:25', NULL, NULL, NULL, NULL),
(26, 'evento miguel 2', 'evento miguel', '2024-01-17', '2024-01-31', 'descripcion', 'politicas', 3, 1, '2024-01-17 22:55:10', '2024-02-12 02:26:39', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ruta` mediumtext NOT NULL,
  `estatus` int(11) NOT NULL,
  `gallery_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `galleries`
--

INSERT INTO `galleries` (`id`, `ruta`, `estatus`, `gallery_id`, `created_at`, `updated_at`) VALUES
(6, 'f424dc9ef3.png', 1, 1, '2023-12-02 00:24:35', '2023-12-02 00:24:35'),
(7, '3abbe1f0bc.png', 1, 1, '2023-12-02 00:24:35', '2023-12-02 00:24:35'),
(8, 'd57356b769.png', 1, 1, '2023-12-02 00:24:35', '2023-12-02 00:24:35'),
(9, '0027ae544e.png', 1, 1, '2023-12-02 00:24:35', '2023-12-02 00:24:35'),
(10, 'aab3a77c46.png', 1, 1, '2023-12-02 00:24:36', '2023-12-02 00:24:36'),
(11, '3bfa07bc46.png', 1, 1, '2023-12-02 00:25:16', '2023-12-02 00:25:16'),
(12, 'f0c4f6ec1b.png', 1, 2, '2023-12-18 18:22:17', '2023-12-18 18:22:17'),
(13, '95d9c1d080.png', 1, 2, '2023-12-18 18:22:18', '2023-12-18 18:22:18'),
(14, '709bca5163.png', 1, 2, '2023-12-18 18:22:18', '2023-12-18 18:22:18'),
(15, '6a102a83ea.png', 1, 3, '2024-01-22 21:18:48', '2024-01-22 21:18:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotels`
--

CREATE TABLE `hotels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `politicas` mediumtext NOT NULL,
  `estatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `check_in` varchar(255) DEFAULT NULL,
  `check_out` varchar(255) DEFAULT NULL,
  `beneficiario` varchar(255) DEFAULT NULL,
  `banco` varchar(255) DEFAULT NULL,
  `numero_cuenta` varchar(255) DEFAULT NULL,
  `clabe_interbancaria` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hotels`
--

INSERT INTO `hotels` (`id`, `nombre`, `direccion`, `descripcion`, `politicas`, `estatus`, `created_at`, `updated_at`, `check_in`, `check_out`, `beneficiario`, `banco`, `numero_cuenta`, `clabe_interbancaria`) VALUES
(1, 'test 1', 'test 1', 'test 1', 'test 1', 1, '2023-12-02 00:05:21', '2023-12-18 18:29:58', '12:00', '20:00', NULL, NULL, NULL, NULL),
(2, 'test 2', 'test 2', 'test 2', 'test 2', 1, '2023-12-18 18:22:17', '2024-01-18 02:25:12', '10:30', '18:30', NULL, NULL, NULL, NULL),
(3, 'hotel 3', 'dierer', 'ffff', 'sssss', 1, '2024-01-22 21:18:47', '2024-01-22 21:18:47', '05:16', '06:55', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `landings`
--

CREATE TABLE `landings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nosotros` longtext DEFAULT NULL,
  `mensaje` longtext DEFAULT NULL,
  `telefono_fijo` varchar(255) DEFAULT NULL,
  `telefono_movil` varchar(255) DEFAULT NULL,
  `correo_contacto` varchar(255) DEFAULT NULL,
  `url_facebook` varchar(255) DEFAULT NULL,
  `domicilio` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `imagen_mensaje` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `landings`
--

INSERT INTO `landings` (`id`, `nosotros`, `mensaje`, `telefono_fijo`, `telefono_movil`, `correo_contacto`, `url_facebook`, `domicilio`, `imagen`, `imagen_mensaje`, `created_at`, `updated_at`) VALUES
(1, 'Nosotros', 'mensaje', '5456464', '56465465465', 'sadfsad@gmail.com', 'www.face.com', 'domilicilio', '20fb64778c.jpeg', NULL, '2024-01-05 20:10:25', '2024-01-05 20:10:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `landing_banners`
--

CREATE TABLE `landing_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `landing_id` bigint(20) UNSIGNED DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `landing_eventos`
--

CREATE TABLE `landing_eventos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color_fondo` varchar(255) DEFAULT NULL,
  `event_id` bigint(20) UNSIGNED DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `logo_evento` varchar(255) DEFAULT NULL,
  `logo_asociacion` varchar(255) DEFAULT NULL,
  `que_incluye` longtext DEFAULT NULL,
  `pdf_programa` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `dias` varchar(255) DEFAULT NULL,
  `conferencias` varchar(255) DEFAULT NULL,
  `profesores` varchar(255) DEFAULT NULL,
  `facebook` longtext DEFAULT NULL,
  `instagram` longtext DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `twitter` longtext DEFAULT NULL,
  `iframe_maps` longtext DEFAULT NULL,
  `show_hotel` tinyint(1) DEFAULT NULL,
  `show_event` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `landing_eventos`
--

INSERT INTO `landing_eventos` (`id`, `color_fondo`, `event_id`, `slug`, `logo_evento`, `logo_asociacion`, `que_incluye`, `pdf_programa`, `status`, `created_at`, `updated_at`, `deleted_at`, `dias`, `conferencias`, `profesores`, `facebook`, `instagram`, `whatsapp`, `twitter`, `iframe_maps`, `show_hotel`, `show_event`) VALUES
(1, '#ee2f2f', 13, NULL, 'e836ca0399.jpeg', '17b9b3e628.jpeg', 'dddd', NULL, 1, '2024-01-05 20:12:17', '2024-01-05 20:13:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2023_10_31_175714_create_roles_table', 1),
(4, '2023_10_31_180557_create_permisologia_table', 1),
(5, '2023_10_31_180705_create_permisos_table', 1),
(6, '2014_10_12_000000_create_users_table', 2),
(7, '2023_11_13_162715_create_categories_table', 3),
(8, '2023_11_15_204214_create_services_of_hotels_table', 4),
(9, '2023_11_15_204405_create_gallery_table', 4),
(10, '2023_11_15_202417_create_hotels_table', 5),
(11, '2023_11_15_211106_modificar_columnas_en_hotels', 6),
(12, '2023_11_16_200145_remove_columns_and_foreign_keys_from_hotels_table', 7),
(13, '2023_11_16_200246_add_new_column_to_services_of_hotels_table', 8),
(14, '2023_11_16_204224_add_new_column_to_gallery_table', 9),
(15, '2023_11_17_210209_drop_table_gallery', 10),
(16, '2023_11_17_210507_create_galleries_table', 11),
(17, '2023_11_28_203832_create_events_table', 12),
(21, '2023_11_28_205046_create_available_categories_table', 13),
(47, '2023_12_01_205245_create_discounts_table', 14),
(48, '2023_12_06_181206_create_countrys_table', 14),
(49, '2023_12_06_181827_create_tax_regimes_table', 14),
(50, '2023_12_06_182620_create_payment_types_table', 15),
(51, '2023_12_06_183022_create_cfdi_table', 15),
(52, '2023_12_06_183701_create_assistants_table', 16),
(53, '2023_12_06_183830_create_constancies_table', 17),
(54, '2023_12_06_183841_create_payment_proofs_table', 17),
(55, '2023_12_14_191719_modify_codigo_beca_assistants', 18),
(56, '2023_12_18_134215_add_campos_hotels', 19),
(57, '2023_12_18_163515_add_campos_discounts', 20),
(58, '2023_12_19_144210_modify_hotel_id_events', 21),
(59, '2023_12_21_190046_create_plan_types_table', 22),
(60, '2023_12_21_193338_create_rooms_by_hotels_table', 23),
(61, '2023_12_20_003325_create_landings_table', 24),
(62, '2023_12_22_163043_add_cantidad_registrada_rooms_by_hotels', 25),
(63, '2023_12_29_005951_create_landing_eventos_table', 26),
(64, '2023_12_29_010057_create_banners_table', 26),
(65, '2023_12_29_010113_create_patrocinadores_table', 26),
(66, '2023_12_29_010125_create_programas_table', 26),
(67, '2024_01_08_211355_add_estatus_pago_assistants', 27),
(68, '2024_01_08_180147_add_columns_landing_eventos_table', 28),
(69, '2024_01_10_154027_modify_rooms_by_hotels', 29),
(70, '2024_01_10_193752_add_slug_to_landing_eventos_table', 30),
(71, '2024_01_15_205939_add_user_id_to_assistants_table', 30),
(72, '2024_01_16_212033_add_columns_descuento_assistants_table', 31),
(73, '2024_01_17_173855_create_academic_grades_table', 32),
(74, '2024_01_25_214941_add_columns_to_password_reset_tokens_table', 33),
(75, '2024_01_25_215536_change_token_column_type_in_password_reset_tokens_table', 33),
(76, '2024_01_26_004404_add_id_to_password_reset_tokens_table', 33),
(77, '2024_01_27_000711_add_columns_to_password_reset_tokens_table', 33),
(78, '2024_01_30_191845_add_columns_to_users_table', 34),
(80, '2024_02_01_214623_create_reservations_table', 35),
(81, '2024_02_01_223226_create_reservation_details_table', 36),
(85, '2024_02_01_223832_create_reservation_rooms_table', 37),
(86, '2024_02_01_225023_create_reservation_room_details_table', 37),
(87, '2024_02_02_205649_add_id_pago_reservations', 38),
(88, '2024_02_07_133355_create_reserve_payments_table', 39),
(91, '2024_02_10_000132_add_user_id_to_reservations_table', 40),
(92, '2024_02_19_041814_add_direccion_cp_reserve_payments_table', 40),
(95, '2024_02_14_140200_add_columns_to_events_table', 41),
(96, '2024_02_26_031838_add_observaciones_reservatios_table', 42),
(97, '2024_02_19_140349_add_columns_to_hotels_table', 43),
(98, '2024_02_28_014130_add_columns_to_landing_eventos_table', 43),
(99, '2024_02_28_200005_add_imagen_mensaje_to_landings_table', 43),
(100, '2024_02_28_200342_create_landing_banners_table', 43),
(101, '2024_03_01_174835_add_academic_grade_id_to_assistants_table', 43),
(102, '2024_03_04_235315_add_columns_to_payment_proofs', 43),
(103, '2024_03_05_232637_add_twitter_to_landing_eventos_table', 43),
(104, '2024_03_11_191121_add_columns_clave_reservations_to_reservations', 43);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `token` longtext NOT NULL,
  `reset_attempts` int(11) DEFAULT NULL,
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patrocinadores`
--

CREATE TABLE `patrocinadores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `landing_eventos_id` bigint(20) UNSIGNED DEFAULT NULL,
  `patrocinador` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `patrocinadores`
--

INSERT INTO `patrocinadores` (`id`, `landing_eventos_id`, `patrocinador`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '2737dc3b0b.jpeg', '2024-01-05 20:12:18', '2024-01-05 20:13:54', '2024-01-05 20:13:54'),
(2, 1, 'cd60d51f68.jpeg', '2024-01-05 20:13:54', '2024-01-05 20:13:54', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_proofs`
--

CREATE TABLE `payment_proofs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `estatus` int(11) DEFAULT NULL,
  `assistants_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `motion` varchar(255) DEFAULT NULL,
  `voucher` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `payment_proofs`
--

INSERT INTO `payment_proofs` (`id`, `nombre`, `estatus`, `assistants_id`, `created_at`, `updated_at`, `payment_id`, `date`, `amount`, `motion`, `voucher`) VALUES
(1, '1702410829_comprobante.png', 1, 1, '2023-12-12 23:53:49', '2023-12-12 23:53:49', NULL, NULL, NULL, NULL, NULL),
(2, '1702411341_comprobante.jpg', 1, 2, '2023-12-13 00:02:21', '2023-12-13 00:02:21', NULL, NULL, NULL, NULL, NULL),
(3, '1702417305_comprobante.jpg', 1, 3, '2023-12-13 01:41:45', '2023-12-13 01:41:45', NULL, NULL, NULL, NULL, NULL),
(4, '1702417559_comprobante.pdf', 1, 4, '2023-12-13 01:45:59', '2023-12-13 01:45:59', NULL, NULL, NULL, NULL, NULL),
(5, '1702420586_comprobante.png', 1, 5, '2023-12-13 02:36:26', '2023-12-13 02:36:26', NULL, NULL, NULL, NULL, NULL),
(6, '1702503393_comprobante.jpg', 1, 6, '2023-12-14 01:36:33', '2023-12-14 01:36:33', NULL, NULL, NULL, NULL, NULL),
(7, '1702504276_comprobante.png', 1, 7, '2023-12-14 01:51:16', '2023-12-14 01:51:16', NULL, NULL, NULL, NULL, NULL),
(8, '1702577648_comprobante.jpg', 1, 8, '2023-12-14 22:14:08', '2023-12-14 22:14:08', NULL, NULL, NULL, NULL, NULL),
(9, '1702577983_comprobante.jpg', 1, 9, '2023-12-14 22:19:43', '2023-12-14 22:19:43', NULL, NULL, NULL, NULL, NULL),
(10, '1702581788_comprobante.jpg', 1, 10, '2023-12-14 23:23:08', '2023-12-14 23:23:08', NULL, NULL, NULL, NULL, NULL),
(13, NULL, 0, 22, '2024-03-25 07:37:49', '2024-03-25 07:37:49', 2, '2024-03-25', 10.00, 'trmadkmrexhz2w58lr2l', ''),
(14, NULL, 0, 23, '2024-03-25 07:44:24', '2024-03-25 07:44:24', 2, '2024-03-25', 10.00, 'tr1k5nlduyneume1ndxp', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_types`
--

CREATE TABLE `payment_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `estatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `payment_types`
--

INSERT INTO `payment_types` (`id`, `nombre`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'Transferencia', 1, '2023-12-06 18:44:56', NULL),
(2, 'Openpay', 1, '2024-02-15 12:26:49', '2024-02-15 12:26:49'),
(3, 'Deposito', 1, '2024-03-25 01:35:07', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisologia`
--

CREATE TABLE `permisologia` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `estatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_rol` bigint(20) UNSIGNED NOT NULL,
  `id_permisologia` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_types`
--

CREATE TABLE `plan_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `estatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `plan_types`
--

INSERT INTO `plan_types` (`id`, `nombre`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'Todo incluido', 1, '2023-12-21 19:02:51', NULL),
(2, 'Sólo habitación', 1, '2023-12-21 19:02:51', NULL),
(3, 'Habitación con desayuno', 1, '2023-12-21 19:03:32', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas`
--

CREATE TABLE `programas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `landing_eventos_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dia` varchar(255) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `horario` varchar(255) DEFAULT NULL,
  `modulo_conferencia` varchar(255) DEFAULT NULL,
  `coordinador_profesor` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `programas`
--

INSERT INTO `programas` (`id`, `landing_eventos_id`, `dia`, `fecha`, `horario`, `modulo_conferencia`, `coordinador_profesor`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '5', '2024-01-12', '10', 'do', 'sss', '2024-01-05 20:12:18', '2024-01-05 20:13:54', '2024-01-05 20:13:54'),
(2, 1, '5', '2024-01-12', '10', 'do', 'sss', '2024-01-05 20:13:55', '2024-01-05 20:13:55', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_entrada` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `cantidad_noches` int(11) NOT NULL,
  `nombre_solicitante` varchar(255) DEFAULT NULL,
  `apellido_solicitante` varchar(255) DEFAULT NULL,
  `correo_solicitante` varchar(255) DEFAULT NULL,
  `telefono_solicitante` varchar(255) DEFAULT NULL,
  `ciudad_solicitante` varchar(255) DEFAULT NULL,
  `monto_total` double(8,2) NOT NULL,
  `estatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `observaciones` mediumtext DEFAULT NULL,
  `clave_reservation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservations`
--

INSERT INTO `reservations` (`id`, `event_id`, `hotel_id`, `plan_id`, `fecha_entrada`, `fecha_salida`, `cantidad_noches`, `nombre_solicitante`, `apellido_solicitante`, `correo_solicitante`, `telefono_solicitante`, `ciudad_solicitante`, `monto_total`, `estatus`, `created_at`, `updated_at`, `payment_id`, `user_id`, `observaciones`, `clave_reservation`) VALUES
(1, 26, 3, 3, '2024-03-19', '2024-03-21', 2, 'dsfas', 'fdafs', 'fads@fsdaf', '2312342342', 'fsdafsd', 410.00, 0, '2024-03-19 08:40:01', '2024-03-19 08:40:01', NULL, NULL, NULL, 'onhGneDgbo1710823201152'),
(2, 26, 3, 3, '2024-03-19', '2024-03-21', 2, 'dsfsa', 'fadsf', 'fadss@fsda', '3242342342', 'fadsdfsad', 410.00, 0, '2024-03-19 08:45:57', '2024-03-19 08:45:57', NULL, NULL, NULL, 'nHOvEWEgWN1710823557077'),
(3, 26, 3, 3, '2024-03-19', '2024-03-21', 2, 'dafds', 'fasdf', 'dfasdf@fsadsdf', '3242343242', 'fdsafsdfas', 40.00, 0, '2024-03-19 08:46:53', '2024-03-19 08:46:53', NULL, NULL, NULL, 'ctXan6vbNQ1710823612887');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservation_details`
--

CREATE TABLE `reservation_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reservation_id` bigint(20) UNSIGNED NOT NULL,
  `concept` varchar(255) DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservation_details`
--

INSERT INTO `reservation_details` (`id`, `reservation_id`, `concept`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 'Presidencial', 40.00, '2024-03-19 08:40:01', '2024-03-19 08:40:01'),
(2, 1, 'topoe pppppppppuuu', 370.00, '2024-03-19 08:40:01', '2024-03-19 08:40:01'),
(3, 1, 'menores', 0.00, '2024-03-19 08:40:01', '2024-03-19 08:40:01'),
(4, 2, 'Presidencial', 40.00, '2024-03-19 08:45:57', '2024-03-19 08:45:57'),
(5, 2, 'topoe pppppppppuuu', 370.00, '2024-03-19 08:45:57', '2024-03-19 08:45:57'),
(6, 2, 'menores', 0.00, '2024-03-19 08:45:58', '2024-03-19 08:45:58'),
(7, 3, 'Presidencial', 40.00, '2024-03-19 08:46:53', '2024-03-19 08:46:53'),
(8, 3, 'menores', 0.00, '2024-03-19 08:46:53', '2024-03-19 08:46:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservation_rooms`
--

CREATE TABLE `reservation_rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reservation_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `room_type_name` varchar(255) DEFAULT NULL,
  `adults_quantity` int(11) NOT NULL,
  `minor_quantity` int(11) NOT NULL,
  `estatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservation_rooms`
--

INSERT INTO `reservation_rooms` (`id`, `reservation_id`, `room_id`, `room_type_name`, `adults_quantity`, `minor_quantity`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Presidencial', 1, 0, 1, '2024-03-19 08:40:02', '2024-03-19 08:40:02'),
(2, 1, 3, 'topoe pppppppppuuu', 1, 0, 1, '2024-03-19 08:40:02', '2024-03-19 08:40:02'),
(3, 2, 1, 'Presidencial', 1, 0, 1, '2024-03-19 08:45:58', '2024-03-19 08:45:58'),
(4, 2, 3, 'topoe pppppppppuuu', 1, 0, 1, '2024-03-19 08:45:58', '2024-03-19 08:45:58'),
(5, 3, 1, 'Presidencial', 1, 0, 1, '2024-03-19 08:46:53', '2024-03-19 08:46:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservation_rooms_details`
--

CREATE TABLE `reservation_rooms_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reservation_room_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `estatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservation_rooms_details`
--

INSERT INTO `reservation_rooms_details` (`id`, `reservation_room_id`, `name`, `last_name`, `age`, `type`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 1, 'sdfs', 'fasdf', NULL, 'adult', 1, '2024-03-19 08:40:02', '2024-03-19 08:40:02'),
(2, 2, 'fasd', 'dfas', NULL, 'adult', 1, '2024-03-19 08:40:02', '2024-03-19 08:40:02'),
(3, 3, 'dsfsa', 'afsd', NULL, 'adult', 1, '2024-03-19 08:45:58', '2024-03-19 08:45:58'),
(4, 4, 'asfs', 'adfsd', NULL, 'adult', 1, '2024-03-19 08:45:58', '2024-03-19 08:45:58'),
(5, 5, 'dfasdf', 'adsfsd', NULL, 'adult', 1, '2024-03-19 08:46:53', '2024-03-19 08:46:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserve_payments`
--

CREATE TABLE `reserve_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reservation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `motion` varchar(255) DEFAULT NULL,
  `voucher` varchar(255) DEFAULT NULL,
  `estatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `cp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reserve_payments`
--

INSERT INTO `reserve_payments` (`id`, `reservation_id`, `payment_id`, `date`, `amount`, `motion`, `voucher`, `estatus`, `created_at`, `updated_at`, `direccion`, `cp`) VALUES
(1, 1, 1, '2024-03-14', 31.00, 'sdfsda', '1710823202_comprobante.png', 0, '2024-03-19 08:40:02', '2024-03-19 08:40:02', NULL, NULL),
(2, 2, 1, '2024-03-12', 23.00, 'dsfasf', '1710823558_comprobante.png', 0, '2024-03-19 08:45:58', '2024-03-19 08:45:58', NULL, NULL),
(3, 3, 1, '2024-03-13', 23.00, 'fdsgsfd', '1710823613_comprobante.png', 0, '2024-03-19 08:46:53', '2024-03-19 08:46:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `estatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `descripcion`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 1, '2023-11-01 01:15:35', '2023-11-01 01:15:35'),
(2, 'Cliente', 1, '2023-11-01 02:29:05', '2023-11-01 02:29:05'),
(3, 'Cliente2', 1, '2023-11-01 04:16:44', '2023-11-01 04:16:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rooms_by_hotels`
--

CREATE TABLE `rooms_by_hotels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `tipo_habitacion` varchar(255) DEFAULT NULL,
  `precio_adulto` double(8,2) DEFAULT NULL,
  `sencilla` double(8,2) DEFAULT NULL,
  `doble` double(8,2) DEFAULT NULL,
  `triple` double(8,2) DEFAULT NULL,
  `cuadruple` double(8,2) DEFAULT NULL,
  `edad_minima` int(11) DEFAULT NULL,
  `edad_maxima` int(11) DEFAULT NULL,
  `precio_menores` double(8,2) DEFAULT NULL,
  `habitaciones_disponibles` int(11) DEFAULT NULL,
  `vigencia` date DEFAULT NULL,
  `estatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cantidad_registrada` int(11) DEFAULT NULL,
  `infante_edad_minima` int(11) DEFAULT NULL,
  `infante_edad_maxima` int(11) DEFAULT NULL,
  `infante_precio_menores` double(8,2) DEFAULT NULL,
  `aplica` int(11) DEFAULT NULL,
  `junior_edad_minima` int(11) DEFAULT NULL,
  `junior_edad_maxima` int(11) DEFAULT NULL,
  `junior_precio_menores` double(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rooms_by_hotels`
--

INSERT INTO `rooms_by_hotels` (`id`, `hotel_id`, `plan_id`, `tipo_habitacion`, `precio_adulto`, `sencilla`, `doble`, `triple`, `cuadruple`, `edad_minima`, `edad_maxima`, `precio_menores`, `habitaciones_disponibles`, `vigencia`, `estatus`, `created_at`, `updated_at`, `cantidad_registrada`, `infante_edad_minima`, `infante_edad_maxima`, `infante_precio_menores`, `aplica`, `junior_edad_minima`, `junior_edad_maxima`, `junior_precio_menores`) VALUES
(1, 3, 3, 'Presidencial', 10.00, 20.00, 25.00, 30.00, 40.00, 6, 12, 15.00, 18, '2023-12-19', 1, '2023-12-22 01:07:56', '2024-03-19 08:46:53', 20, 0, 6, 10.00, 1, 13, 16, 20.00),
(2, 1, 1, 'Mater prod', 15.00, 10.00, 15.00, 20.00, 25.00, 6, 12, 8.00, 0, '2024-02-21', 1, '2023-12-22 01:36:51', '2024-02-26 02:44:14', 11, 0, 6, 5.00, 1, 13, 16, 10.00),
(3, 3, 3, 'topoe pppppppppuuu', 20.00, 185.00, 2158.00, 15.00, 651.00, 100, 105, 515.00, 19, '2024-02-11', 1, '2023-12-22 20:35:23', '2024-03-19 08:45:57', 20, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(4, 1, 2, 'Habitación especial', NULL, 10.00, 15.00, 20.00, 25.00, 6, 12, 8.00, 0, '2024-02-21', 1, '2024-01-10 21:18:03', '2024-02-26 02:44:02', 10, 0, 6, 5.00, 1, 13, 16, 10.00),
(5, 1, 2, 'Luna de miel 2', NULL, 10.00, 15.00, 20.00, 25.00, 6, 12, 8.00, 0, '2024-02-21', 1, '2024-01-10 21:34:46', '2024-02-26 02:43:52', 10, 0, 6, 5.00, 1, 13, 16, 10.00),
(6, 1, 3, 'Luna de miel', NULL, 10.00, 15.00, 20.00, 25.00, 6, 12, 8.00, 10, '2024-02-20', 1, '2024-01-10 21:37:10', '2024-02-26 02:43:32', 10, 0, 6, 5.00, 1, 13, 16, 10.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services_of_hotels`
--

CREATE TABLE `services_of_hotels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `estatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `services_of_hotels`
--

INSERT INTO `services_of_hotels` (`id`, `descripcion`, `estatus`, `created_at`, `updated_at`, `hotel_id`) VALUES
(6, 'test 1', 1, '2023-12-18 18:29:58', '2023-12-18 18:29:58', 1),
(9, 'test 2', 1, '2024-01-18 02:25:13', '2024-01-18 02:25:13', 2),
(10, 'test 3', 1, '2024-01-18 02:25:13', '2024-01-18 02:25:13', 2),
(11, 'services 1', 1, '2024-01-22 21:18:47', '2024-01-22 21:18:47', 3),
(12, 'services 2', 1, '2024-01-22 21:18:47', '2024-01-22 21:18:47', 3),
(13, 'services 3', 1, '2024-01-22 21:18:48', '2024-01-22 21:18:48', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tax_regimes`
--

CREATE TABLE `tax_regimes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `estatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tax_regimes`
--

INSERT INTO `tax_regimes` (`id`, `nombre`, `estatus`, `created_at`, `updated_at`) VALUES
(1, 'Régimen fiscal', 1, '2023-12-06 18:45:40', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_rol` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido_paterno` varchar(255) DEFAULT NULL,
  `apellido_materno` varchar(255) DEFAULT NULL,
  `telefono_movil` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `id_rol`, `name`, `email`, `nombre`, `apellido_paterno`, `apellido_materno`, `telefono_movil`, `ciudad`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `estatus`) VALUES
(3, 1, 'Susana Cuéllar', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$8Bv27piIHdM07Qtk75rMtuV0ceiG0udwcYDQbm8d5aQPBeWVR3hSa', NULL, '2023-11-01 01:40:00', '2023-11-01 01:40:00', 1),
(4, 1, 'Yanfran Blanco', 'yan@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$03Mb3vOWr7uY.CxFhXVCsO79VWt1C2CxECzKu3tZI7ZOh.doKAQpq', NULL, '2023-11-03 00:25:56', '2023-11-03 00:25:56', 1),
(5, 2, 'cliente', 'test@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$xHJTCeAj4YhS9yMGjE5NQOIpD3Isq3XPoNoeCKidR9Wrqs1QEsmWa', NULL, '2023-11-23 23:20:24', '2023-11-23 23:20:24', 1),
(6, 2, 'ddsdsd ddddddd', 'dsdsa@fsdf', 'ddsdsd', 'ddddddd', NULL, '3423423423', 'dsfsadf', NULL, '$2y$12$.hd2d9WSAw23T94.vtkHvOWoMD.58vYPqXs6oBChPyvTFWsNW1Q1u', NULL, '2024-03-18 07:19:49', '2024-03-18 07:19:49', 1),
(7, 2, 'sddq vdsfsad', 'fas@dasf', 'sddq', 'vdsfsad', NULL, '3242342342', 'fsdfsad', NULL, '$2y$12$eS3AqIwWd3td.8CyNtypde6Pj3S/te5O1MP.hbMRnX7f/7KNS4dn.', NULL, '2024-03-19 08:34:08', '2024-03-19 08:34:08', 1),
(8, 2, 'dfasdf fsafds fdsafs', 'fsadfsd@fsadfsd', 'dfasdf', 'fsafds', 'fdsafs', '4353453453', 'gsdfg', NULL, '$2y$12$1Sl6Zzi29OCeSXjjLZcixOHM/WuUtKuH4Jpg1VPv7.jaa.JN6xXH2', NULL, '2024-03-25 07:37:27', '2024-03-25 07:37:27', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `academic_grades`
--
ALTER TABLE `academic_grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_grades_events_id_foreign` (`events_id`);

--
-- Indices de la tabla `assistants`
--
ALTER TABLE `assistants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assistants_categoria_id_foreign` (`categoria_id`),
  ADD KEY `assistants_pais_id_foreign` (`pais_id`),
  ADD KEY `assistants_evento_id_foreign` (`evento_id`),
  ADD KEY `assistants_regimen_fiscal_id_foreign` (`regimen_fiscal_id`),
  ADD KEY `assistants_cfdi_id_foreign` (`cfdi_id`),
  ADD KEY `assistants_tipo_pago_id_foreign` (`tipo_pago_id`);

--
-- Indices de la tabla `available_categories`
--
ALTER TABLE `available_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `available_categories_category_id_foreign` (`category_id`),
  ADD KEY `available_categories_events_id_foreign` (`events_id`);

--
-- Indices de la tabla `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cfdi`
--
ALTER TABLE `cfdi`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `constancies`
--
ALTER TABLE `constancies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `constancies_assistants_id_foreign` (`assistants_id`);

--
-- Indices de la tabla `countrys`
--
ALTER TABLE `countrys`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_hotel_id_foreign` (`hotel_id`);

--
-- Indices de la tabla `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galleries_gallery_id_foreign` (`gallery_id`);

--
-- Indices de la tabla `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `landings`
--
ALTER TABLE `landings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `landing_banners`
--
ALTER TABLE `landing_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `landing_eventos`
--
ALTER TABLE `landing_eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `patrocinadores`
--
ALTER TABLE `patrocinadores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `payment_proofs`
--
ALTER TABLE `payment_proofs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_proofs_assistants_id_foreign` (`assistants_id`),
  ADD KEY `payment_proofs_payment_id_foreign` (`payment_id`);

--
-- Indices de la tabla `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisologia`
--
ALTER TABLE `permisologia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permisos_id_rol_foreign` (`id_rol`),
  ADD KEY `permisos_id_permisologia_foreign` (`id_permisologia`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `plan_types`
--
ALTER TABLE `plan_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `programas`
--
ALTER TABLE `programas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_event_id_foreign` (`event_id`),
  ADD KEY `reservations_hotel_id_foreign` (`hotel_id`),
  ADD KEY `reservations_plan_id_foreign` (`plan_id`),
  ADD KEY `reservations_payment_id_foreign` (`payment_id`);

--
-- Indices de la tabla `reservation_details`
--
ALTER TABLE `reservation_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_details_reservation_id_foreign` (`reservation_id`);

--
-- Indices de la tabla `reservation_rooms`
--
ALTER TABLE `reservation_rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_rooms_reservation_id_foreign` (`reservation_id`),
  ADD KEY `reservation_rooms_room_id_foreign` (`room_id`);

--
-- Indices de la tabla `reservation_rooms_details`
--
ALTER TABLE `reservation_rooms_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_rooms_details_reservation_room_id_foreign` (`reservation_room_id`);

--
-- Indices de la tabla `reserve_payments`
--
ALTER TABLE `reserve_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reserve_payments_reservation_id_foreign` (`reservation_id`),
  ADD KEY `reserve_payments_payment_id_foreign` (`payment_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rooms_by_hotels`
--
ALTER TABLE `rooms_by_hotels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooms_by_hotels_hotel_id_foreign` (`hotel_id`),
  ADD KEY `rooms_by_hotels_plans_id_foreign` (`plan_id`);

--
-- Indices de la tabla `services_of_hotels`
--
ALTER TABLE `services_of_hotels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_of_hotels_hotel_id_foreign` (`hotel_id`);

--
-- Indices de la tabla `tax_regimes`
--
ALTER TABLE `tax_regimes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_id_rol_foreign` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `academic_grades`
--
ALTER TABLE `academic_grades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `assistants`
--
ALTER TABLE `assistants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `available_categories`
--
ALTER TABLE `available_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `cfdi`
--
ALTER TABLE `cfdi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `constancies`
--
ALTER TABLE `constancies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `countrys`
--
ALTER TABLE `countrys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `landings`
--
ALTER TABLE `landings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `landing_banners`
--
ALTER TABLE `landing_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `landing_eventos`
--
ALTER TABLE `landing_eventos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `patrocinadores`
--
ALTER TABLE `patrocinadores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `payment_proofs`
--
ALTER TABLE `payment_proofs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `permisologia`
--
ALTER TABLE `permisologia`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plan_types`
--
ALTER TABLE `plan_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `programas`
--
ALTER TABLE `programas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reservation_details`
--
ALTER TABLE `reservation_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `reservation_rooms`
--
ALTER TABLE `reservation_rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `reservation_rooms_details`
--
ALTER TABLE `reservation_rooms_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `reserve_payments`
--
ALTER TABLE `reserve_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rooms_by_hotels`
--
ALTER TABLE `rooms_by_hotels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `services_of_hotels`
--
ALTER TABLE `services_of_hotels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tax_regimes`
--
ALTER TABLE `tax_regimes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `academic_grades`
--
ALTER TABLE `academic_grades`
  ADD CONSTRAINT `academic_grades_events_id_foreign` FOREIGN KEY (`events_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `assistants`
--
ALTER TABLE `assistants`
  ADD CONSTRAINT `assistants_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assistants_cfdi_id_foreign` FOREIGN KEY (`cfdi_id`) REFERENCES `cfdi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assistants_evento_id_foreign` FOREIGN KEY (`evento_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assistants_pais_id_foreign` FOREIGN KEY (`pais_id`) REFERENCES `countrys` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assistants_regimen_fiscal_id_foreign` FOREIGN KEY (`regimen_fiscal_id`) REFERENCES `tax_regimes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assistants_tipo_pago_id_foreign` FOREIGN KEY (`tipo_pago_id`) REFERENCES `payment_types` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `available_categories`
--
ALTER TABLE `available_categories`
  ADD CONSTRAINT `available_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `available_categories_events_id_foreign` FOREIGN KEY (`events_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `constancies`
--
ALTER TABLE `constancies`
  ADD CONSTRAINT `constancies_assistants_id_foreign` FOREIGN KEY (`assistants_id`) REFERENCES `assistants` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_gallery_id_foreign` FOREIGN KEY (`gallery_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `payment_proofs`
--
ALTER TABLE `payment_proofs`
  ADD CONSTRAINT `payment_proofs_assistants_id_foreign` FOREIGN KEY (`assistants_id`) REFERENCES `assistants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payment_proofs_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payment_types` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_id_permisologia_foreign` FOREIGN KEY (`id_permisologia`) REFERENCES `permisologia` (`id`),
  ADD CONSTRAINT `permisos_id_rol_foreign` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`);

--
-- Filtros para la tabla `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payment_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plan_types` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reservation_details`
--
ALTER TABLE `reservation_details`
  ADD CONSTRAINT `reservation_details_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reservation_rooms`
--
ALTER TABLE `reservation_rooms`
  ADD CONSTRAINT `reservation_rooms_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservation_rooms_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms_by_hotels` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reservation_rooms_details`
--
ALTER TABLE `reservation_rooms_details`
  ADD CONSTRAINT `reservation_rooms_details_reservation_room_id_foreign` FOREIGN KEY (`reservation_room_id`) REFERENCES `reservation_rooms` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reserve_payments`
--
ALTER TABLE `reserve_payments`
  ADD CONSTRAINT `reserve_payments_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payment_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reserve_payments_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `rooms_by_hotels`
--
ALTER TABLE `rooms_by_hotels`
  ADD CONSTRAINT `rooms_by_hotels_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rooms_by_hotels_plans_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plan_types` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `services_of_hotels`
--
ALTER TABLE `services_of_hotels`
  ADD CONSTRAINT `services_of_hotels_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_rol_foreign` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
