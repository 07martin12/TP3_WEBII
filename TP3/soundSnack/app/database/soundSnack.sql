-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2025 a las 08:54:51
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `soundsnack`
--
CREATE DATABASE IF NOT EXISTS `soundsnack` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `soundsnack`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artists`
--

CREATE TABLE `artists` (
  `id_artist` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `biography` text DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `date_of_death` date DEFAULT NULL,
  `place_of_birth` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `artists`
--

INSERT INTO `artists` (`id_artist`, `name`, `biography`, `cover`, `date_of_birth`, `date_of_death`, `place_of_birth`) VALUES
(1, 'Axel Patricio Fernando Witteveen', 'Axel Patricio Fernando Witteveen, es un cantante y compositor argentino. Ha sido galardonado con cinco Premios Carlos Gardel, un MTV Europe Music Awards, un MTV Latinoamérica, dos 40 principales, un MTV Millennial Awards, un Kids Choice Awards Argentina, un TVyNovelas, un Heat Latin Music Awards, entre otros.', '/soundSnack/assets/img/covers/artists/axelWitteveen.jpg', '1977-01-01', NULL, 'Rafael Calzada, Almirante Brown, Buenos Aires, Argentina'),
(2, 'Airbag', 'Airbag es una banda argentina de Rock fundada en Don Torcuato, Gran Buenos Aires, en el año 1999. La banda fue fundada e integrada por los hermanos Gastón Sardelli, Patricio Sardelli y Guido Sardelli donde empezaron con los primeros ensayos a mediados de los años noventa bajo el nombre de Los Nietos de Chuck, donde hacían covers de Chuck Berry, The Beatles y Creedence, entre otros.', '/soundSnack/assets/img/covers/artists/airbag.jpg', '1999-01-01', NULL, 'Don Torcuato, Buenos Aires, Argentina'),
(3, 'Tan Biónica', 'Tan Biónica es un grupo musical de rock argentino surgido en Buenos Aires en el año 2001 formado por Chano, Seby, Bambi y Diega. Desde 2016 el grupo estuvo en un impasse hasta el 17 de marzo de 2023, cuando Chano se presentó en el Lollapalooza Argentina y anunció oficialmente el regreso de la banda.', '/soundSnack/assets/img/covers/artists/tanBionica.jpg', '2001-01-01', NULL, 'Buenos Aires, Argentina'),
(4, 'Miranda!', 'Miranda! es un dúo argentino de pop formado en 2001 integrado por Ale Sergi y Juliana Gattas.', '/soundSnack/assets/img/covers/artists/miranda.jpg', '2001-01-01', NULL, 'Buenos Aires, Argentina'),
(5, 'Bad Bunny', 'Bad Bunny nació en San Juan, Puerto Rico, el 10 de marzo de 1994. Es compositor y cantante de música urbana, sobre todo trap y reggaetón.', '/soundSnack/assets/img/covers/artists/badbunny.jpg', '1994-03-10', NULL, 'San Juan, Puerto Rico'),
(6, 'Lady Gaga', 'Stefani Joanne Angelina Germanotta, conocida por su nombre artístico Lady Gaga, es una cantante, compositora, productora, bailarina, actriz, activista y diseñadora de moda estadounidense.', '/soundSnack/assets/img/covers/artists/ladygaga.jpg', '1986-03-28', NULL, 'Nueva York, Estados Unidos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `songs`
--

CREATE TABLE `songs` (
  `id_song` smallint(5) UNSIGNED NOT NULL,
  `id_artist` smallint(5) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `album` varchar(100) NOT NULL,
  `duration` decimal(4,2) DEFAULT NULL,
  `genre` varchar(50) NOT NULL,
  `video` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `songs`
--

INSERT INTO `songs` (`id_song`, `id_artist`, `title`, `album`, `duration`, `genre`, `video`) VALUES
(1, 1, 'La Clave Para Conquistarte', 'La Clave Para Conquistarte', 4.16, 'Pop/Balada', 'https://youtu.be/XqCoOoYCwKA?si=oe9OYtxO3Mpld3-N'),
(2, 1, 'Hoy Es Hoy', 'Hoy', 3.50, 'Pop', 'https://youtu.be/i4YX0vrDqgc?si=LeVPPueNzVs4Tnti'),
(3, 1, 'Dulce Amargo', 'Amo', 4.12, 'Pop/Rock', 'https://youtu.be/RTdh9QD6338?si=bafnB8nkYRErXwYt'),
(4, 3, 'Víctimas', 'Hola Mundo', 3.55, 'Pop/Rock', 'https://youtu.be/oVQbqVL3Ifs?si=bjb-vOKfFjJPDNPN'),
(5, 3, 'Tus Horas Mágicas', 'Hola Mundo', 4.02, 'Pop', 'https://youtu.be/trvkG1hHzPo?si=FE_1-kMKfXevFp6s'),
(6, 3, 'Arruinarse', 'Canciones del Huracán', 3.48, 'Pop/Rock', 'https://youtu.be/tkcLP9risaA?si=KYh4wwy9HV1wL9Y2'),
(7, 2, 'Algo Personal', 'Libertad', 3.45, 'Rock', 'https://youtu.be/xl9TOQgw8pE?si=JYe_TIrgHTIYj4K6'),
(8, 2, 'La Moda del Montón', 'Libertad', 4.01, 'Rock', 'https://youtu.be/V-Q8McPur38?si=4YNu9YkGyAsUz4eo'),
(9, 2, 'Mi Sensación', 'Una Hora a Tokyo', 3.57, 'Rock', 'https://youtu.be/35JNhNQEjt8?si=cBH_tNHFSh_KFSUz'),
(10, 4, 'Don', 'El Disco de tu Corazón', 3.50, 'Pop', 'https://youtu.be/eap0G9ldKc0?si=J9yg7-MplwPrQH3H'),
(11, 4, 'Perfecta', 'El Disco de tu Corazón', 3.40, 'Pop', 'https://youtu.be/a3hOeU7w59o?si=QdBfy1Ny5KKnYhkQ'),
(12, 4, 'Yo te diré', 'Sin Restricciones', 3.30, 'Pop', 'https://youtu.be/y6-H9HMb9qM?si=8Ji_yi1T-aTZZhXl'),
(13, 5, 'Dakiti', 'El Último Tour del Mundo', 3.25, 'Reggaetón', 'https://youtu.be/TmKh7lAwnBI'),
(14, 5, 'Tití Me Preguntó', 'Un Verano Sin Ti', 4.00, 'Reggaetón', 'https://youtu.be/Cr8K88UcO0s?si=3oBrHaRo62aPtF3Q'),
(15, 5, 'Amorfoda', 'Grandes Éxitos', 3.45, 'Reggaetón', 'https://youtu.be/kLpH1nSLJSs?si=vzG54BkEJfCVF5uc'),
(16, 6, 'Poker Face', 'The Fame', 3.58, 'Pop', 'https://youtu.be/bESGLojNYSo'),
(17, 6, 'Bad Romance', 'The Fame Monster', 4.54, 'Pop', 'https://youtu.be/qrO4YZeyl0I'),
(18, 6, 'Abracadabra', 'Mayhem', 3.43, 'Electropop', 'https://www.youtube.com/watch?v=vBynw9Isr28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `name`, `email`, `password`, `profile_photo`) VALUES
(1, 'webadmin', 'webadmin@gmail.com', '$2y$10$3NbNAqg6Sd.oXEHcTv8cB..Czx2YC2GNQ0429UYK9VmW4SmLxXNQm', '/soundSnack/assets/img/covers/users/webadmin.png'),
(2, 'Malena', 'malenaManzzalini@gmail.com', '$2y$10$rBFJYuyEee1THNxgH/uTfeXngmXQbty7o9rLzTV9stlcvxQDhlDnS', '/soundSnack/assets/img/covers/users/defaultUser.jpg'),
(3, 'Martin', 'Martin@gmail.com', '$2y$10$grah4RlK1n4WeqrwfF8IBednjA9exDUmHxjem6mZd5y5RlXjnXYsm', '/soundSnack/assets/img/covers/users/defaultUser.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id_artist`);

--
-- Indices de la tabla `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id_song`),
  ADD KEY `fk_songs_artist` (`id_artist`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `artists`
--
ALTER TABLE `artists`
  MODIFY `id_artist` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `songs`
--
ALTER TABLE `songs`
  MODIFY `id_song` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `fk_songs_artist` FOREIGN KEY (`id_artist`) REFERENCES `artists` (`id_artist`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
