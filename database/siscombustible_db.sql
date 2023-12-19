-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 19-12-2023 a las 17:17:08
-- Versión del servidor: 8.0.30
-- Versión de PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `siscombustible_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conductors`
--

CREATE TABLE `conductors` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `licencia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observacion` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `conductors`
--

INSERT INTO `conductors` (`id`, `user_id`, `licencia`, `observacion`, `created_at`, `updated_at`) VALUES
(1, 3, 'C', 'OBS', '2023-12-19 16:31:52', '2023-12-19 16:34:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracions`
--

CREATE TABLE `configuracions` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre_sistema` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razon_social` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ciudad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `web` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actividad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `configuracions`
--

INSERT INTO `configuracions` (`id`, `nombre_sistema`, `alias`, `razon_social`, `ciudad`, `dir`, `fono`, `web`, `actividad`, `correo`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'SISCOMBUSTIBLE', 'SC', 'SISCOMBUSTIBLE S.A.', 'LA PAZ', 'LOS OLIVOS', '7777777', '', 'ACTIVIDAD', 'siscombustible@gmail.com', 'logo.png', NULL, '2023-12-19 13:40:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_accions`
--

CREATE TABLE `historial_accions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `accion` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `datos_original` text COLLATE utf8mb4_unicode_ci,
  `datos_nuevo` text COLLATE utf8mb4_unicode_ci,
  `modulo` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `historial_accions`
--

INSERT INTO `historial_accions` (`id`, `user_id`, `accion`, `descripcion`, `datos_original`, `datos_nuevo`, `modulo`, `fecha`, `hora`, `created_at`, `updated_at`) VALUES
(1, 1, 'MODIFICACIÓN', 'EL USUARIO admin MODIFICÓ LA CONFIGURACIÓN', 'actividad: ACTIVIDAD<br/>alias: SC<br/>ciudad: LA PAZ<br/>correo: siscombustible@gmail.com<br/>created_at: <br/>dir: LOS OLIVOS<br/>fono: 7777777<br/>id: 1<br/>logo: logo.png<br/>nombre_sistema: SISCOMBUSTIBLE<br/>razon_social: SISCOMBUSTIBLE S.A.<br/>updated_at: <br/>web: <br/>', 'actividad: ACTIVIDAD<br/>alias: SC<br/>ciudad: LA PAZ<br/>correo: siscombustible@gmail.com<br/>created_at: <br/>dir: LOS OLIVOS<br/>fono: 7777777<br/>id: 1<br/>logo: logo.png<br/>nombre_sistema: SISCOMBUSTIBLE<br/>razon_social: SISCOMBUSTIBLE S.A.<br/>updated_at: 2023-12-19 09:39:17<br/>web: NULL<br/>', 'CONFIGURACIÓN', '2023-12-19', '09:39:17', '2023-12-19 13:39:17', '2023-12-19 13:39:17'),
(2, 1, 'MODIFICACIÓN', 'EL USUARIO admin MODIFICÓ LA CONFIGURACIÓN', 'actividad: ACTIVIDAD<br/>alias: SC<br/>ciudad: LA PAZ<br/>correo: siscombustible@gmail.com<br/>created_at: <br/>dir: LOS OLIVOS<br/>fono: 7777777<br/>id: 1<br/>logo: logo.png<br/>nombre_sistema: SISCOMBUSTIBLE<br/>razon_social: SISCOMBUSTIBLE S.A.<br/>updated_at: 2023-12-19 09:39:17<br/>web: NULL<br/>', 'actividad: ACTIVIDAD<br/>alias: SC<br/>ciudad: LA PAZ<br/>correo: siscombustible@gmail.com<br/>created_at: <br/>dir: LOS OLIVOS<br/>fono: 7777777<br/>id: 1<br/>logo: logo.png<br/>nombre_sistema: SISCOMBUSTIBLE<br/>razon_social: SISCOMBUSTIBLE S.A.<br/>updated_at: 2023-12-19 09:40:03<br/>web: <br/>', 'CONFIGURACIÓN', '2023-12-19', '09:40:03', '2023-12-19 13:40:03', '2023-12-19 13:40:03'),
(3, 1, 'MODIFICACIÓN', 'EL USUARIO admin MODIFICÓ LA CONFIGURACIÓN', 'actividad: ACTIVIDAD<br/>alias: SC<br/>ciudad: LA PAZ<br/>correo: siscombustible@gmail.com<br/>created_at: <br/>dir: LOS OLIVOS<br/>fono: 7777777<br/>id: 1<br/>logo: logo.png<br/>nombre_sistema: SISCOMBUSTIBLE<br/>razon_social: SISCOMBUSTIBLE S.A.<br/>updated_at: 2023-12-19 09:40:03<br/>web: <br/>', 'actividad: ACTIVIDADS<br/>alias: SCS<br/>ciudad: LA PAZS<br/>correo: siscombustible@gmail.coms<br/>created_at: <br/>dir: LOS OLIVOSS<br/>fono: 7777777S<br/>id: 1<br/>logo: logo.png<br/>nombre_sistema: SISCOMBUSTIBLES<br/>razon_social: SISCOMBUSTIBLE S.A.S<br/>updated_at: 2023-12-19 09:40:33<br/>web: S<br/>', 'CONFIGURACIÓN', '2023-12-19', '09:40:33', '2023-12-19 13:40:33', '2023-12-19 13:40:33'),
(4, 1, 'MODIFICACIÓN', 'EL USUARIO admin MODIFICÓ LA CONFIGURACIÓN', 'actividad: ACTIVIDADS<br/>alias: SCS<br/>ciudad: LA PAZS<br/>correo: siscombustible@gmail.coms<br/>created_at: <br/>dir: LOS OLIVOSS<br/>fono: 7777777S<br/>id: 1<br/>logo: logo.png<br/>nombre_sistema: SISCOMBUSTIBLES<br/>razon_social: SISCOMBUSTIBLE S.A.S<br/>updated_at: 2023-12-19 09:40:33<br/>web: S<br/>', 'actividad: ACTIVIDAD<br/>alias: SC<br/>ciudad: LA PAZ<br/>correo: siscombustible@gmail.com<br/>created_at: <br/>dir: LOS OLIVOS<br/>fono: 7777777<br/>id: 1<br/>logo: logo.png<br/>nombre_sistema: SISCOMBUSTIBLE<br/>razon_social: SISCOMBUSTIBLE S.A.<br/>updated_at: 2023-12-19 09:40:53<br/>web: <br/>', 'CONFIGURACIÓN', '2023-12-19', '09:40:53', '2023-12-19 13:40:53', '2023-12-19 13:40:53'),
(5, 1, 'CREACIÓN', 'EL USUARIO admin REGISTRO UN USUARIO', 'acceso: 1<br/>ci: 1111<br/>ci_exp: LP<br/>correo: JUAN@GMAIL.COM<br/>created_at: 2023-12-19 10:30:38<br/>dir: LOS OLIVOS<br/>fecha_registro: 2023-12-19<br/>fono: 777777<br/>foto: default.png<br/>id: 2<br/>materno: MAMANI<br/>nombre: JUAN<br/>password: $2y$10$8b60BooiXnu5zCZjzPnLFuMWBa55fmckjArCP3DkC7x3UPFzARV8.<br/>paterno: PERES<br/>tipo: ENCARGADO DE COMBUSTIBLE<br/>updated_at: 2023-12-19 10:30:38<br/>usuario: JPERES<br/>', NULL, 'USUARIOS', '2023-12-19', '10:30:38', '2023-12-19 14:30:38', '2023-12-19 14:30:38'),
(6, 1, 'MODIFICACIÓN', 'EL USUARIO admin MODIFICÓ UN USUARIO', 'acceso: 1<br/>ci: 1111<br/>ci_exp: LP<br/>correo: JUAN@GMAIL.COM<br/>created_at: 2023-12-19 10:30:38<br/>dir: LOS OLIVOS<br/>fecha_registro: 2023-12-19<br/>fono: 777777<br/>foto: default.png<br/>id: 2<br/>materno: MAMANI<br/>nombre: JUAN<br/>password: $2y$10$8b60BooiXnu5zCZjzPnLFuMWBa55fmckjArCP3DkC7x3UPFzARV8.<br/>paterno: PERES<br/>tipo: ENCARGADO DE COMBUSTIBLE<br/>updated_at: 2023-12-19 10:30:38<br/>usuario: JPERES<br/>', 'acceso: 1<br/>ci: 1111<br/>ci_exp: LP<br/>correo: JUAN@GMAIL.COM<br/>created_at: 2023-12-19 10:30:38<br/>dir: LOS OLIVOS<br/>fecha_registro: 2023-12-19<br/>fono: 777777<br/>foto: default.png<br/>id: 2<br/>materno: MAMANI<br/>nombre: JUAN<br/>password: $2y$10$8b60BooiXnu5zCZjzPnLFuMWBa55fmckjArCP3DkC7x3UPFzARV8.<br/>paterno: PERES<br/>tipo: ENCARGADO DE COMBUSTIBLE<br/>updated_at: 2023-12-19 10:30:38<br/>usuario: JPERES<br/>', 'USUARIOS', '2023-12-19', '10:32:26', '2023-12-19 14:32:26', '2023-12-19 14:32:26'),
(7, 1, 'MODIFICACIÓN', 'EL USUARIO admin MODIFICÓ UN USUARIO', 'acceso: 1<br/>ci: 1111<br/>ci_exp: LP<br/>correo: JUAN@GMAIL.COM<br/>created_at: 2023-12-19 10:30:38<br/>dir: LOS OLIVOS<br/>fecha_registro: 2023-12-19<br/>fono: 777777<br/>foto: default.png<br/>id: 2<br/>materno: MAMANI<br/>nombre: JUAN<br/>password: $2y$10$8b60BooiXnu5zCZjzPnLFuMWBa55fmckjArCP3DkC7x3UPFzARV8.<br/>paterno: PERES<br/>tipo: ENCARGADO DE COMBUSTIBLE<br/>updated_at: 2023-12-19 10:30:38<br/>usuario: JPERES<br/>', 'acceso: 1<br/>ci: 1111<br/>ci_exp: LP<br/>correo: juan@gmail.com<br/>created_at: 2023-12-19 10:30:38<br/>dir: LOS OLIVOS<br/>fecha_registro: 2023-12-19<br/>fono: 777777<br/>foto: default.png<br/>id: 2<br/>materno: MAMANI<br/>nombre: JUAN<br/>password: $2y$10$8b60BooiXnu5zCZjzPnLFuMWBa55fmckjArCP3DkC7x3UPFzARV8.<br/>paterno: PERES<br/>tipo: ENCARGADO DE COMBUSTIBLE<br/>updated_at: 2023-12-19 10:33:16<br/>usuario: JPERES<br/>', 'USUARIOS', '2023-12-19', '10:33:16', '2023-12-19 14:33:16', '2023-12-19 14:33:16'),
(8, 1, 'MODIFICACIÓN', 'EL USUARIO admin MODIFICÓ UN USUARIO', 'acceso: 1<br/>ci: 1111<br/>ci_exp: LP<br/>correo: juan@gmail.com<br/>created_at: 2023-12-19 10:30:38<br/>dir: LOS OLIVOS<br/>fecha_registro: 2023-12-19<br/>fono: 777777<br/>foto: default.png<br/>id: 2<br/>materno: MAMANI<br/>nombre: JUAN<br/>password: $2y$10$8b60BooiXnu5zCZjzPnLFuMWBa55fmckjArCP3DkC7x3UPFzARV8.<br/>paterno: PERES<br/>tipo: ENCARGADO DE COMBUSTIBLE<br/>updated_at: 2023-12-19 10:33:16<br/>usuario: JPERES<br/>', 'acceso: 0<br/>ci: 1111<br/>ci_exp: LP<br/>correo: juan@gmail.com<br/>created_at: 2023-12-19 10:30:38<br/>dir: LOS OLIVOS<br/>fecha_registro: 2023-12-19<br/>fono: 777777<br/>foto: default.png<br/>id: 2<br/>materno: MAMANI<br/>nombre: JUAN<br/>password: $2y$10$8b60BooiXnu5zCZjzPnLFuMWBa55fmckjArCP3DkC7x3UPFzARV8.<br/>paterno: PERES<br/>tipo: ENCARGADO DE COMBUSTIBLE<br/>updated_at: 2023-12-19 10:34:46<br/>usuario: JPERES<br/>', 'USUARIOS', '2023-12-19', '10:34:46', '2023-12-19 14:34:46', '2023-12-19 14:34:46'),
(9, 1, 'MODIFICACIÓN', 'EL USUARIO admin MODIFICÓ UN USUARIO', 'acceso: 0<br/>ci: 1111<br/>ci_exp: LP<br/>correo: juan@gmail.com<br/>created_at: 2023-12-19 10:30:38<br/>dir: LOS OLIVOS<br/>fecha_registro: 2023-12-19<br/>fono: 777777<br/>foto: default.png<br/>id: 2<br/>materno: MAMANI<br/>nombre: JUAN<br/>password: $2y$10$8b60BooiXnu5zCZjzPnLFuMWBa55fmckjArCP3DkC7x3UPFzARV8.<br/>paterno: PERES<br/>tipo: ENCARGADO DE COMBUSTIBLE<br/>updated_at: 2023-12-19 10:34:46<br/>usuario: JPERES<br/>', 'acceso: 1<br/>ci: 1111<br/>ci_exp: LP<br/>correo: juan@gmail.com<br/>created_at: 2023-12-19 10:30:38<br/>dir: LOS OLIVOS<br/>fecha_registro: 2023-12-19<br/>fono: 777777<br/>foto: default.png<br/>id: 2<br/>materno: MAMANI<br/>nombre: JUAN<br/>password: $2y$10$8b60BooiXnu5zCZjzPnLFuMWBa55fmckjArCP3DkC7x3UPFzARV8.<br/>paterno: PERES<br/>tipo: ENCARGADO DE COMBUSTIBLE<br/>updated_at: 2023-12-19 10:34:51<br/>usuario: JPERES<br/>', 'USUARIOS', '2023-12-19', '10:34:51', '2023-12-19 14:34:51', '2023-12-19 14:34:51'),
(10, 1, 'ELIMINACIÓN', 'EL USUARIO admin ELIMINÓ UN USUARIO', 'acceso: 1<br/>ci: 1111<br/>ci_exp: LP<br/>correo: juan@gmail.com<br/>created_at: 2023-12-19 10:30:38<br/>dir: LOS OLIVOS<br/>fecha_registro: 2023-12-19<br/>fono: 777777<br/>foto: default.png<br/>id: 2<br/>materno: MAMANI<br/>nombre: JUAN<br/>password: $2y$10$5oA2x4ys1./La1c/rRd8auUciCR3rUX9EJUxWN7Z5HOM9YAdvfC/i<br/>paterno: PERES<br/>tipo: ENCARGADO DE COMBUSTIBLE<br/>updated_at: 2023-12-19 10:39:30<br/>usuario: JPERES<br/>', NULL, 'USUARIOS', '2023-12-19', '10:39:45', '2023-12-19 14:39:45', '2023-12-19 14:39:45'),
(11, 1, 'CREACIÓN', 'EL USUARIO admin REGISTRO UN USUARIO', 'acceso: 1<br/>ci: 1111<br/>ci_exp: LP<br/>correo: juan@gmail.com<br/>created_at: 2023-12-19 10:40:17<br/>dir: LOS OLIVOS<br/>fecha_registro: 2023-12-19<br/>fono: 77777777<br/>foto: default.png<br/>id: 2<br/>materno: MAMANI<br/>nombre: JUAN<br/>password: $2y$10$9G3rSNuwX0V5/hu6YTilRuDVlS/RrXBy9QQ/DWowo4mDCYNQT.YvS<br/>paterno: PERES<br/>tipo: ENCARGADO DE COMBUSTIBLE<br/>updated_at: 2023-12-19 10:40:17<br/>usuario: JPERES<br/>', NULL, 'USUARIOS', '2023-12-19', '10:40:17', '2023-12-19 14:40:17', '2023-12-19 14:40:17'),
(12, 1, 'CREACIÓN', 'EL USUARIO  REGISTRO UNA UNIDAD', 'created_at: 2023-12-19 11:37:53<br/>descripcion: DESCRIPCION UNIDAD #1<br/>fecha_registro: 2023-12-19<br/>id: 1<br/>nombre: UNIDAD #1<br/>updated_at: 2023-12-19 11:37:53<br/>', NULL, 'UNIDAD', '2023-12-19', '11:37:53', '2023-12-19 15:37:53', '2023-12-19 15:37:53'),
(13, 1, 'CREACIÓN', 'EL USUARIO  REGISTRO UNA UNIDAD', 'created_at: 2023-12-19 11:39:05<br/>descripcion: <br/>fecha_registro: 2023-12-19<br/>id: 2<br/>nombre: UNIDAD #2<br/>updated_at: 2023-12-19 11:39:05<br/>', NULL, 'UNIDAD', '2023-12-19', '11:39:05', '2023-12-19 15:39:05', '2023-12-19 15:39:05'),
(14, 1, 'ELIMINACIÓN', 'EL USUARIO  ELIMINÓ UNA UNIDAD', 'created_at: 2023-12-19 11:39:05<br/>descripcion: <br/>fecha_registro: 2023-12-19<br/>id: 2<br/>nombre: UNIDAD #2<br/>updated_at: 2023-12-19 11:39:05<br/>', NULL, 'UNIDAD', '2023-12-19', '11:40:37', '2023-12-19 15:40:37', '2023-12-19 15:40:37'),
(15, 1, 'CREACIÓN', 'EL USUARIO  REGISTRO UNA UNIDAD', 'created_at: 2023-12-19 11:41:33<br/>descripcion: <br/>fecha_registro: 2023-12-19<br/>id: 2<br/>nombre: ASD<br/>updated_at: 2023-12-19 11:41:33<br/>', NULL, 'UNIDAD', '2023-12-19', '11:41:33', '2023-12-19 15:41:33', '2023-12-19 15:41:33'),
(16, 1, 'ELIMINACIÓN', 'EL USUARIO  ELIMINÓ UNA UNIDAD', 'created_at: 2023-12-19 11:41:33<br/>descripcion: <br/>fecha_registro: 2023-12-19<br/>id: 2<br/>nombre: ASD<br/>updated_at: 2023-12-19 11:41:33<br/>', NULL, 'UNIDAD', '2023-12-19', '11:41:36', '2023-12-19 15:41:36', '2023-12-19 15:41:36'),
(17, 1, 'CREACIÓN', 'EL USUARIO  REGISTRO UNA UNIDAD', 'created_at: 2023-12-19 12:27:28<br/>descripcion: <br/>fecha_registro: 2023-12-19<br/>id: 2<br/>nombre: FERNANDO<br/>updated_at: 2023-12-19 12:27:28<br/>', NULL, 'UNIDAD', '2023-12-19', '12:27:28', '2023-12-19 16:27:28', '2023-12-19 16:27:28'),
(18, 1, 'CREACIÓN', 'EL USUARIO admin REGISTRO UN CONDUCTOR', 'acceso: 1<br/>ci: 2222<br/>ci_exp: LP<br/>correo: <br/>created_at: 2023-12-19 12:31:51<br/>dir: LOS OLIVOS<br/>fecha_registro: 2023-12-19<br/>fono: 777777<br/>foto: default.png<br/>id: 3<br/>materno: MAMANI<br/>nombre: FERNANDO<br/>password: $2y$10$ESFDr/KIjjfvr257rvXlvO4uIH5ldRTZvSJtho9o6G5B17rZ/PACK<br/>paterno: MAMANI<br/>tipo: CONDUCTOR<br/>updated_at: 2023-12-19 12:31:51<br/>usuario: FMAMANI<br/>', NULL, 'CONDUCTORES', '2023-12-19', '12:31:52', '2023-12-19 16:31:52', '2023-12-19 16:31:52'),
(19, 1, 'MODIFICACIÓN', 'EL USUARIO admin MODIFICÓ UN USUARIO', 'acceso: 1<br/>ci: 1111<br/>ci_exp: LP<br/>correo: juan@gmail.com<br/>created_at: 2023-12-19 10:40:17<br/>dir: LOS OLIVOS<br/>fecha_registro: 2023-12-19<br/>fono: 77777777<br/>foto: default.png<br/>id: 2<br/>materno: MAMANI<br/>nombre: JUAN<br/>password: $2y$10$9G3rSNuwX0V5/hu6YTilRuDVlS/RrXBy9QQ/DWowo4mDCYNQT.YvS<br/>paterno: PERES<br/>tipo: ENCARGADO DE COMBUSTIBLE<br/>updated_at: 2023-12-19 10:40:17<br/>usuario: JPERES<br/>', 'acceso: 1<br/>ci: 1111<br/>ci_exp: LP<br/>correo: juan@gmail.com<br/>created_at: 2023-12-19 10:40:17<br/>dir: LOS OLIVOS<br/>fecha_registro: 2023-12-19<br/>fono: 77777777<br/>foto: default.png<br/>id: 2<br/>materno: MAMANI<br/>nombre: JUAN<br/>password: $2y$10$9G3rSNuwX0V5/hu6YTilRuDVlS/RrXBy9QQ/DWowo4mDCYNQT.YvS<br/>paterno: PERES<br/>tipo: ENCARGADO DE COMBUSTIBLE<br/>updated_at: 2023-12-19 12:33:11<br/>usuario: JPERES<br/>', 'USUARIOS', '2023-12-19', '12:33:11', '2023-12-19 16:33:11', '2023-12-19 16:33:11'),
(20, 1, 'MODIFICACIÓN', 'EL USUARIO admin MODIFICÓ UN USUARIO CONDUCTOR', 'acceso: 1<br/>ci: 2222<br/>ci_exp: LP<br/>correo: <br/>created_at: 2023-12-19 12:31:51<br/>dir: LOS OLIVOS<br/>fecha_registro: 2023-12-19<br/>fono: 777777<br/>foto: default.png<br/>id: 3<br/>materno: MAMANI<br/>nombre: FERNANDO<br/>password: $2y$10$ESFDr/KIjjfvr257rvXlvO4uIH5ldRTZvSJtho9o6G5B17rZ/PACK<br/>paterno: MAMANI<br/>tipo: CONDUCTOR<br/>updated_at: 2023-12-19 12:31:51<br/>usuario: FMAMANI<br/>', 'acceso: 1<br/>ci: 2222<br/>ci_exp: LP<br/>correo: <br/>created_at: 2023-12-19 12:31:51<br/>dir: LOS OLIVOS<br/>fecha_registro: 2023-12-19<br/>fono: 777777<br/>foto: default.png<br/>id: 3<br/>materno: MAMANI<br/>nombre: FERNANDO<br/>password: $2y$10$ESFDr/KIjjfvr257rvXlvO4uIH5ldRTZvSJtho9o6G5B17rZ/PACK<br/>paterno: MAMANI<br/>tipo: CONDUCTOR<br/>updated_at: 2023-12-19 12:31:51<br/>usuario: FMAMANI<br/>', 'CONDUCTORES', '2023-12-19', '12:34:34', '2023-12-19 16:34:34', '2023-12-19 16:34:34'),
(21, 1, 'CREACIÓN', 'EL USUARIO admin REGISTRO UN CONDUCTOR', 'acceso: 0<br/>ci: 1234<br/>ci_exp: CB<br/>correo: <br/>created_at: 2023-12-19 12:36:31<br/>dir: <br/>fecha_registro: 2023-12-19<br/>fono: 7777777<br/>foto: default.png<br/>id: 4<br/>materno: ASD<br/>nombre: ASD<br/>password: $2y$10$F7WiAhFWNOTZAaxntGDXw.l8nxFXWPFkQawLJiD0ybwZ92etxxMLm<br/>paterno: ASD<br/>tipo: CONDUCTOR<br/>updated_at: 2023-12-19 12:36:32<br/>usuario: AASD<br/>', NULL, 'CONDUCTORES', '2023-12-19', '12:36:32', '2023-12-19 16:36:32', '2023-12-19 16:36:32'),
(22, 1, 'ELIMINACIÓN', 'EL USUARIO admin ELIMINÓ UN USUARIO CONDUCTOR', 'acceso: <br/>ci: <br/>ci_exp: <br/>correo: <br/>created_at: <br/>dir: <br/>fecha_registro: <br/>fono: <br/>foto: <br/>id: <br/>materno: <br/>nombre: <br/>password: <br/>paterno: <br/>tipo: <br/>updated_at: <br/>usuario: <br/>', NULL, 'CONDUCTORES', '2023-12-19', '12:36:42', '2023-12-19 16:36:42', '2023-12-19 16:36:42'),
(23, 1, 'ELIMINACIÓN', 'EL USUARIO admin ELIMINÓ UN USUARIO CONDUCTOR', 'acceso: 0<br/>ci: 1234<br/>ci_exp: CB<br/>correo: <br/>created_at: 2023-12-19 12:36:31<br/>dir: <br/>fecha_registro: 2023-12-19<br/>fono: 7777777<br/>foto: default.png<br/>id: 4<br/>materno: ASD<br/>nombre: ASD<br/>password: $2y$10$F7WiAhFWNOTZAaxntGDXw.l8nxFXWPFkQawLJiD0ybwZ92etxxMLm<br/>paterno: ASD<br/>tipo: CONDUCTOR<br/>updated_at: 2023-12-19 12:36:32<br/>usuario: AASD<br/>', NULL, 'CONDUCTORES', '2023-12-19', '12:37:11', '2023-12-19 16:37:11', '2023-12-19 16:37:11'),
(24, 1, 'CREACIÓN', 'EL USUARIO  REGISTRO UN VEHICULO', 'acceso: <br/>ci: <br/>ci_exp: <br/>correo: <br/>created_at: 2023-12-19 13:11:19<br/>dir: <br/>fecha_registro: 2023-12-19<br/>fono: <br/>foto: 1703005879_.jpg<br/>id: 2<br/>materno: <br/>nombre: <br/>password: <br/>paterno: <br/>tipo: TIPO<br/>updated_at: 2023-12-19 13:11:19<br/>usuario: <br/>', NULL, 'VEHICULOS', '2023-12-19', '13:11:19', '2023-12-19 17:11:19', '2023-12-19 17:11:19'),
(25, 1, 'CREACIÓN', 'EL USUARIO  REGISTRO UN VEHICULO', 'acceso: <br/>ci: <br/>ci_exp: <br/>correo: <br/>created_at: 2023-12-19 13:14:23<br/>dir: <br/>fecha_registro: 2023-12-19<br/>fono: <br/>foto: default.png<br/>id: 3<br/>materno: <br/>nombre: <br/>password: <br/>paterno: <br/>tipo: <br/>updated_at: 2023-12-19 13:14:23<br/>usuario: <br/>', NULL, 'VEHICULOS', '2023-12-19', '13:14:23', '2023-12-19 17:14:23', '2023-12-19 17:14:23'),
(26, 1, 'ELIMINACIÓN', 'EL USUARIO  ELIMINÓ UN VEHICULO', 'acceso: <br/>ci: <br/>ci_exp: <br/>correo: <br/>created_at: 2023-12-19 13:14:23<br/>dir: <br/>fecha_registro: 2023-12-19<br/>fono: <br/>foto: default.png<br/>id: 3<br/>materno: <br/>nombre: <br/>password: <br/>paterno: <br/>tipo: <br/>updated_at: 2023-12-19 13:14:23<br/>usuario: <br/>', NULL, 'VEHICULOS', '2023-12-19', '13:16:46', '2023-12-19 17:16:46', '2023-12-19 17:16:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000002_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2022_10_13_132625_create_configuracions_table', 1),
(4, '2023_08_26_190801_create_historial_accions_table', 1),
(5, '2023_12_19_105327_create_unidads_table', 2),
(6, '2023_12_19_105723_create_conductors_table', 2),
(7, '2023_12_19_105733_create_vehiculos_table', 2),
(8, '2023_12_19_105757_create_unidad_solicitantes_table', 2),
(9, '2023_12_19_105825_create_solicitud_combustibles_table', 2),
(10, '2023_12_19_105840_create_recorrido_viajes_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recorrido_viajes`
--

CREATE TABLE `recorrido_viajes` (
  `id` bigint UNSIGNED NOT NULL,
  `unidad_solicitante_id` bigint UNSIGNED NOT NULL,
  `descripcion_recorrido` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `inicio_combustible` double NOT NULL,
  `fin_combustible` double NOT NULL,
  `restante_combustible` double NOT NULL,
  `inicio_kilometraje` double DEFAULT NULL,
  `fin_kilometraje` double DEFAULT NULL,
  `observacion` varchar(700) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_combustibles`
--

CREATE TABLE `solicitud_combustibles` (
  `id` bigint UNSIGNED NOT NULL,
  `unidad_solicitante_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `vehiculo_id` bigint UNSIGNED DEFAULT NULL,
  `combustible` double NOT NULL,
  `nro_vale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_entrega` date NOT NULL,
  `observacion` varchar(700) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidads`
--

CREATE TABLE `unidads` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `unidads`
--

INSERT INTO `unidads` (`id`, `nombre`, `descripcion`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 'UNIDAD #1', 'DESCRIPCION UNIDAD #1', '2023-12-19', '2023-12-19 15:37:53', '2023-12-19 15:37:53'),
(2, 'FERNANDO', NULL, '2023-12-19', '2023-12-19 16:27:28', '2023-12-19 16:27:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_solicitantes`
--

CREATE TABLE `unidad_solicitantes` (
  `id` bigint UNSIGNED NOT NULL,
  `nro` int NOT NULL,
  `codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unidad_id` bigint UNSIGNED NOT NULL,
  `descripcion_viaje` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_solicitud` date NOT NULL,
  `nro_hoja_ruta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conductor` int NOT NULL,
  `vehiculo` int NOT NULL,
  `combustible` int NOT NULL,
  `observacion` varchar(700) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paterno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `materno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ci` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci_exp` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` enum('ADMINISTRADOR','DIRECTOR','ADMINISTRATIVO','ENCARGADO DE COMBUSTIBLE','CONDUCTOR') COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `acceso` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `usuario`, `nombre`, `paterno`, `materno`, `ci`, `ci_exp`, `dir`, `correo`, `fono`, `password`, `tipo`, `foto`, `fecha_registro`, `acceso`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin', NULL, '0000', '', '', 'admin@gmail.com', '', '$2y$10$RrCZZySOwPej2gMFWsrjMe6dLzfaL5Q88h4J75I1FesEBRNPwq1x.', 'ADMINISTRADOR', NULL, '2023-12-14', 1, NULL, NULL),
(2, 'JPERES', 'JUAN', 'PERES', 'MAMANI', '1111', 'LP', 'LOS OLIVOS', 'juan@gmail.com', '77777777', '$2y$10$9G3rSNuwX0V5/hu6YTilRuDVlS/RrXBy9QQ/DWowo4mDCYNQT.YvS', 'ENCARGADO DE COMBUSTIBLE', 'default.png', '2023-12-19', 1, '2023-12-19 14:40:17', '2023-12-19 16:33:11'),
(3, 'FMAMANI', 'FERNANDO', 'MAMANI', 'MAMANI', '2222', 'LP', 'LOS OLIVOS', '', '777777', '$2y$10$ESFDr/KIjjfvr257rvXlvO4uIH5ldRTZvSJtho9o6G5B17rZ/PACK', 'CONDUCTOR', 'default.png', '2023-12-19', 1, '2023-12-19 16:31:51', '2023-12-19 16:31:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` bigint UNSIGNED NOT NULL,
  `placa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marca` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clase` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modelo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `procedencia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `servicio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `traccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `turbo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carroceria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtipo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cilindrada` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nro_puertas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacidad_carga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacidad_plaza` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacidad_arrastre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `placa`, `marca`, `clase`, `modelo`, `procedencia`, `servicio`, `traccion`, `turbo`, `carroceria`, `tipo`, `subtipo`, `cilindrada`, `nro_puertas`, `capacidad_carga`, `capacidad_plaza`, `capacidad_arrastre`, `foto`, `observacion`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(2, '1234', 'VOLVO', 'CLASE', 'MODELO', 'CHINA', 'SERVICIO', 'TRASERA', 'NO', 'ROJA', 'TIPO', 'SUBTIPO', '2300CC', '4', '10000KG', '5', 'CAPACIDAD ARRASTRE', '1703005879_.jpg', 'OBS', '2023-12-19', '2023-12-19 17:11:19', '2023-12-19 17:11:19');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `conductors`
--
ALTER TABLE `conductors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conductors_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `configuracions`
--
ALTER TABLE `configuracions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial_accions`
--
ALTER TABLE `historial_accions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `recorrido_viajes`
--
ALTER TABLE `recorrido_viajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recorrido_viajes_unidad_solicitante_id_foreign` (`unidad_solicitante_id`);

--
-- Indices de la tabla `solicitud_combustibles`
--
ALTER TABLE `solicitud_combustibles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitud_combustibles_unidad_solicitante_id_foreign` (`unidad_solicitante_id`);

--
-- Indices de la tabla `unidads`
--
ALTER TABLE `unidads`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `unidad_solicitantes`
--
ALTER TABLE `unidad_solicitantes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_usuario_unique` (`usuario`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `conductors`
--
ALTER TABLE `conductors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `configuracions`
--
ALTER TABLE `configuracions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `historial_accions`
--
ALTER TABLE `historial_accions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recorrido_viajes`
--
ALTER TABLE `recorrido_viajes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_combustibles`
--
ALTER TABLE `solicitud_combustibles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `unidads`
--
ALTER TABLE `unidads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `unidad_solicitantes`
--
ALTER TABLE `unidad_solicitantes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `conductors`
--
ALTER TABLE `conductors`
  ADD CONSTRAINT `conductors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `recorrido_viajes`
--
ALTER TABLE `recorrido_viajes`
  ADD CONSTRAINT `recorrido_viajes_unidad_solicitante_id_foreign` FOREIGN KEY (`unidad_solicitante_id`) REFERENCES `unidad_solicitantes` (`id`);

--
-- Filtros para la tabla `solicitud_combustibles`
--
ALTER TABLE `solicitud_combustibles`
  ADD CONSTRAINT `solicitud_combustibles_unidad_solicitante_id_foreign` FOREIGN KEY (`unidad_solicitante_id`) REFERENCES `unidad_solicitantes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
