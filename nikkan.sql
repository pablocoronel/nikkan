-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-11-2017 a las 18:10:40
-- Versión del servidor: 10.1.24-MariaDB
-- Versión de PHP: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nikkan`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dato_empresas`
--

CREATE TABLE `dato_empresas` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `dato_empresas`
--

INSERT INTO `dato_empresas` (`id`, `tipo`, `texto`, `created_at`, `updated_at`) VALUES
(1, 'Ubicación', 'Honduras 4658, Palermo, CABA, Argentina', '2017-10-27 03:00:00', '2017-10-30 18:04:53'),
(2, 'Teléfono', '(+5411) 2084-8606', '2017-10-27 03:00:00', '2017-10-30 18:05:10'),
(3, 'Correo', 'contacto@nikka-n.com.ar', '2017-10-27 03:00:00', '2017-10-30 18:05:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logos`
--

CREATE TABLE `logos` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruta` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `logos`
--

INSERT INTO `logos` (`id`, `tipo`, `ruta`, `created_at`, `updated_at`) VALUES
(1, 'Logo principal', 'images/logos/logo_principal.png', NULL, '2017-10-30 18:03:04'),
(2, 'Logo footer', 'images/logos/logo_footer.png', NULL, '2017-10-30 18:03:23'),
(3, 'favicon', 'images/logos/logo_favicon.png', NULL, '2017-10-30 18:04:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metadatos`
--

CREATE TABLE `metadatos` (
  `id` int(10) UNSIGNED NOT NULL,
  `seccion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keyword` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `metadatos`
--

INSERT INTO `metadatos` (`id`, `seccion`, `keyword`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'home', 'nikka-n', 'nikka-n', '2017-10-27 03:00:00', '2017-10-30 20:46:12'),
(2, 'empresa', 'nikkan', 'nikkan', NULL, NULL),
(3, 'coleccion', 'nikkan', 'nikkan', NULL, NULL),
(4, 'campaña', 'nikkan', 'nikkan', NULL, NULL),
(5, 'showroom', 'nikkan', 'nikkan', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2017_10_26_142925_create_users_table', 1),
(2, '2017_10_26_143018_create_password_resets_table', 1),
(3, '2017_10_26_145224_modificar_tabla_users_columna_email_null', 2),
(5, '2017_10_27_132821_crear_tabla_metadato', 3),
(7, '2017_10_27_150714_crear_tabla_datosempresa', 4),
(8, '2017_10_27_165924_crear_tabla_redes_sociales', 5),
(10, '2017_10_30_140354_crear_tabla_logo', 6),
(12, '2017_10_31_171407_crear_tabla_seccion_home_slider', 7),
(13, '2017_10_31_183603_crear_tabla_seccion_home_destacado', 8),
(14, '2017_10_31_192431_crear_tabla_seccion_empresa_portada', 9),
(16, '2017_10_31_194842_crear_tabla_seccion_empresa_slider', 10),
(17, '2017_11_01_123011_crear_tabla_seccion_showroom_portada', 11),
(18, '2017_11_01_123211_crear_tabla_seccion_showroom_slider', 12),
(19, '2017_11_01_132827_crear_tabla_seccion_contacto_mapa', 13),
(20, '2017_11_01_133112_crear_tabla_seccion_contacto_portada', 14),
(21, '2017_11_01_135925_cambiar_columna_en_tabla_seccion_contacto_mapa', 15),
(22, '2017_11_01_143717_cambiar_propidad_de_columna_en_tabla_seccion_contacto_mapa', 16),
(23, '2017_11_01_145954_crear_tabla_seccion_campania_slider', 17),
(25, '2017_11_01_154645_crear_tabla_seccion_documento_pdf', 18),
(26, '2017_11_03_133607_cambiar_tipo_en_tabla_empresa_portada', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `redes_sociales`
--

CREATE TABLE `redes_sociales` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ubicacion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vinculo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruta` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orden` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `redes_sociales`
--

INSERT INTO `redes_sociales` (`id`, `nombre`, `ubicacion`, `vinculo`, `ruta`, `orden`, `created_at`, `updated_at`) VALUES
(3, 'instagram', 'superior', 'https://www.instagram.com/nikkadenicoleneumann/', 'images/redes_sociales/instagramsuperior.png', 'ab', '2017-10-30 15:55:51', '2017-10-30 18:48:10'),
(4, 'instagram', 'inferior', 'https://www.instagram.com/nikkadenicoleneumann/', 'images/redes_sociales/instagraminferior.png', 'ab', '2017-10-30 16:02:32', '2017-10-30 18:48:31'),
(10, 'facebook', 'superior', 'http://www.facebook.com/nikkaoficial', 'images/redes_sociales/facebooksuperior.png', 'aa', '2017-10-30 18:22:53', '2017-10-30 18:40:23'),
(11, 'facebook', 'inferior', 'https://www.facebook.com/nikkaoficial', 'images/redes_sociales/facebookinferior.png', 'aa', '2017-10-30 18:34:04', '2017-10-30 18:40:46'),
(12, 'twitter', 'superior', 'http://twitter.com/nikkaoficial', 'images/redes_sociales/twittersuperior.png', 'ac', '2017-10-30 18:53:24', '2017-10-30 18:53:24'),
(13, 'twitter', 'inferior', 'https://twitter.com/nikkaoficial', 'images/redes_sociales/twitterinferior.png', 'ac', '2017-10-30 18:56:18', '2017-10-30 18:56:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion_campania_sliders`
--

CREATE TABLE `seccion_campania_sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `ruta` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vinculo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `orden` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `seccion_campania_sliders`
--

INSERT INTO `seccion_campania_sliders` (`id`, `ruta`, `vinculo`, `texto`, `orden`, `created_at`, `updated_at`) VALUES
(2, 'images/seccion_campania_sliders/slider_2.jpeg', '', '', 'aa', '2017-11-01 18:13:04', '2017-11-03 17:50:23'),
(3, 'images/seccion_campania_sliders/slider_3.jpeg', '', '', 'ab', '2017-11-03 17:58:14', '2017-11-03 17:58:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion_contacto_mapas`
--

CREATE TABLE `seccion_contacto_mapas` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `seccion_contacto_mapas`
--

INSERT INTO `seccion_contacto_mapas` (`id`, `codigo`, `created_at`, `updated_at`) VALUES
(1, 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6569.032658932488!2d-58.426604!3d-34.591103!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x482b0ad437bc6f03!2sNIKKA+N.!5e0!3m2!1ses!2sar!4v1509546898822', '2017-11-01 03:00:00', '2017-11-03 18:51:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion_contacto_portadas`
--

CREATE TABLE `seccion_contacto_portadas` (
  `id` int(10) UNSIGNED NOT NULL,
  `ruta` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titulo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `seccion_contacto_portadas`
--

INSERT INTO `seccion_contacto_portadas` (`id`, `ruta`, `titulo`, `texto`, `created_at`, `updated_at`) VALUES
(1, 'images/seccion_contacto_portadas/portada_1.jpeg', '', '', '2017-11-01 03:00:00', '2017-11-03 18:32:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion_documento_pdfs`
--

CREATE TABLE `seccion_documento_pdfs` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruta` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orden` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `seccion_documento_pdfs`
--

INSERT INTO `seccion_documento_pdfs` (`id`, `nombre`, `ruta`, `orden`, `created_at`, `updated_at`) VALUES
(1, 'Constancia de inscripción en AFIP', 'documents/afip/afip.pdf', '', '2017-11-01 03:00:00', '2017-11-01 20:34:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion_empresa_portadas`
--

CREATE TABLE `seccion_empresa_portadas` (
  `id` int(10) UNSIGNED NOT NULL,
  `ruta` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titulo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `seccion_empresa_portadas`
--

INSERT INTO `seccion_empresa_portadas` (`id`, `ruta`, `titulo`, `texto`, `created_at`, `updated_at`) VALUES
(1, 'images/seccion_empresa_portadas/portada_1.jpeg', 'NIKKA', 'Desde siempre tuve fascinación por los zapatos, los accesorios y el diseño en general. Después de trabajar muchos años en el mundo de la moda como modelo, hoy encontré en este proyecto la forma de fusionar esa fascinación… Con mi infinito amor por los animales. Nuestro principal objetivo es crear productos con identidad propia, calidad y diseño, respetando y amando la vida ante todas las cosas. Es por eso que en Nikka podrás encontrar zapatos, botas, carteras y abrigos de piel 100% cruelty free!', '2017-10-31 03:00:00', '2017-11-03 17:00:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion_empresa_sliders`
--

CREATE TABLE `seccion_empresa_sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `ruta` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vinculo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `orden` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `seccion_empresa_sliders`
--

INSERT INTO `seccion_empresa_sliders` (`id`, `ruta`, `vinculo`, `texto`, `orden`, `created_at`, `updated_at`) VALUES
(2, 'images/seccion_empresa_sliders/slider_2.jpeg', '', '', 'aa', '2017-11-01 15:02:33', '2017-11-03 17:35:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion_home_destacados`
--

CREATE TABLE `seccion_home_destacados` (
  `id` int(10) UNSIGNED NOT NULL,
  `ruta` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vinculo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `orden` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `seccion_home_destacados`
--

INSERT INTO `seccion_home_destacados` (`id`, `ruta`, `vinculo`, `texto`, `orden`, `created_at`, `updated_at`) VALUES
(2, 'images/seccion_home_destacados/destacado_2.jpeg', 'a', 'a', 'aa', '2017-10-31 21:59:25', '2017-11-02 18:02:20'),
(3, 'images/seccion_home_destacados/destacado_3.jpeg', 'a', 'a', 'ab', '2017-11-02 18:01:59', '2017-11-02 18:01:59'),
(4, 'images/seccion_home_destacados/destacado_4.jpeg', 'a', 'a', 'ac', '2017-11-02 18:02:57', '2017-11-02 18:02:57'),
(5, 'images/seccion_home_destacados/destacado_5.jpeg', 'a', 'a', 'ad', '2017-11-02 18:03:37', '2017-11-02 18:03:37'),
(6, 'images/seccion_home_destacados/destacado_6.jpeg', 'a', 'a', 'ae', '2017-11-02 18:03:50', '2017-11-02 18:03:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion_home_sliders`
--

CREATE TABLE `seccion_home_sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `ruta` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vinculo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `orden` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `seccion_home_sliders`
--

INSERT INTO `seccion_home_sliders` (`id`, `ruta`, `vinculo`, `texto`, `orden`, `created_at`, `updated_at`) VALUES
(9, 'images/seccion_home_sliders/slider_9.jpeg', 'a', 'a', 'a', '2017-10-31 21:28:13', '2017-11-02 17:32:55'),
(12, 'images/seccion_home_sliders/slider_12.jpeg', 'a', 's', 'ab', '2017-11-02 17:33:36', '2017-11-02 17:33:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion_showroom_portadas`
--

CREATE TABLE `seccion_showroom_portadas` (
  `id` int(10) UNSIGNED NOT NULL,
  `ruta` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titulo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `seccion_showroom_portadas`
--

INSERT INTO `seccion_showroom_portadas` (`id`, `ruta`, `titulo`, `texto`, `created_at`, `updated_at`) VALUES
(1, 'images/seccion_showroom_portadas/portada_1.jpeg', 'VISITANOS', '<p style=\"text-align: center;\">HONDURAS 4658 - OFICINA 111 - PALERMO - CABA - ARGENTINA&nbsp;|TEL&Eacute;FONO: (+5411) 2084 8606 DE LUNES A SAB&Aacute;DOS DE 11 a 19 HS.</p>', '2017-11-01 03:00:00', '2017-11-03 18:15:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion_showroom_sliders`
--

CREATE TABLE `seccion_showroom_sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `ruta` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vinculo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `orden` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `seccion_showroom_sliders`
--

INSERT INTO `seccion_showroom_sliders` (`id`, `ruta`, `vinculo`, `texto`, `orden`, `created_at`, `updated_at`) VALUES
(1, 'images/seccion_showroom_sliders/slider_1.jpeg', '', '', 'aa', '2017-11-03 18:20:01', '2017-11-03 18:20:01'),
(2, 'images/seccion_showroom_sliders/slider_2.jpeg', '', '', 'ab', '2017-11-03 18:20:47', '2017-11-03 18:20:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nivel` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usuario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nivel`, `nombre`, `email`, `usuario`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'administrador', 'pablo', NULL, 'pablo', '$2y$10$QhEB0DwyI90r6SUCDCm.nOq.JmRSFblHJn6INo9S6N2yamyXuaZXq', '7qRgBeW7YVUirndKcl4TMMX6oohf2EUfOFhPkAtJHNoZADo89tTghPqoNSvW', '2017-10-27 18:48:19', '2017-10-27 18:48:19');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dato_empresas`
--
ALTER TABLE `dato_empresas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `logos`
--
ALTER TABLE `logos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `metadatos`
--
ALTER TABLE `metadatos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `redes_sociales`
--
ALTER TABLE `redes_sociales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seccion_campania_sliders`
--
ALTER TABLE `seccion_campania_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seccion_contacto_mapas`
--
ALTER TABLE `seccion_contacto_mapas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seccion_contacto_portadas`
--
ALTER TABLE `seccion_contacto_portadas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seccion_documento_pdfs`
--
ALTER TABLE `seccion_documento_pdfs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seccion_empresa_portadas`
--
ALTER TABLE `seccion_empresa_portadas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seccion_empresa_sliders`
--
ALTER TABLE `seccion_empresa_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seccion_home_destacados`
--
ALTER TABLE `seccion_home_destacados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seccion_home_sliders`
--
ALTER TABLE `seccion_home_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seccion_showroom_portadas`
--
ALTER TABLE `seccion_showroom_portadas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seccion_showroom_sliders`
--
ALTER TABLE `seccion_showroom_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dato_empresas`
--
ALTER TABLE `dato_empresas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `logos`
--
ALTER TABLE `logos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `metadatos`
--
ALTER TABLE `metadatos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `redes_sociales`
--
ALTER TABLE `redes_sociales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `seccion_campania_sliders`
--
ALTER TABLE `seccion_campania_sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `seccion_contacto_mapas`
--
ALTER TABLE `seccion_contacto_mapas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `seccion_contacto_portadas`
--
ALTER TABLE `seccion_contacto_portadas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `seccion_documento_pdfs`
--
ALTER TABLE `seccion_documento_pdfs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `seccion_empresa_portadas`
--
ALTER TABLE `seccion_empresa_portadas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `seccion_empresa_sliders`
--
ALTER TABLE `seccion_empresa_sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `seccion_home_destacados`
--
ALTER TABLE `seccion_home_destacados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `seccion_home_sliders`
--
ALTER TABLE `seccion_home_sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `seccion_showroom_portadas`
--
ALTER TABLE `seccion_showroom_portadas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `seccion_showroom_sliders`
--
ALTER TABLE `seccion_showroom_sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
