-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-09-2026 a las 00:22:19
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
-- Base de datos: `crepusuculo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `orden_saga` int(11) NOT NULL,
  `sinopsis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `titulo`, `autor`, `fecha_publicacion`, `orden_saga`, `sinopsis`) VALUES
(1, 'Crepúsculo', 'Stephenie Meyer', '2005-10-05', 1, 'Bella Swan se muda a Forks y conoce a Edward Cullen, un vampiro que se enamora de ella. A medida que su relación se desarrolla, Bella se enfrenta a peligros y secretos del mundo sobrenatural.'),
(2, 'Luna Nueva', 'Stephenie Meyer', '2006-10-05', 2, 'Después de la partida de Edward, Bella se sumerge en la tristeza y la soledad. Sin embargo, encuentra consuelo en su amistad con Jacob Black, un hombre lobo, y se enfrenta a nuevas amenazas que ponen en peligro su vida.'),
(3, 'Eclipse', 'Stephenie Meyer', '2007-08-07', 3, 'Bella se encuentra atrapada entre su amor por Edward y su amistad con Jacob. Mientras se avecina una guerra entre vampiros y hombres lobo, Bella debe tomar decisiones difíciles que afectarán su futuro y el de aquellos que ama.'),
(4, 'Amanecer', 'Stephenie Meyer', '2008-08-02', 4, 'Bella y Edward se casan y esperan un hijo. Sin embargo, el embarazo de Bella trae consigo complicaciones y peligros inesperados. La familia Cullen se enfrenta a desafíos que pondrán a prueba su amor y su lealtad, mientras luchan por proteger a su hija y mantener la paz entre vampiros y hombres lobo.'),
(5, 'Sol de Medianoche', 'Stephenie Meyer', '2020-08-04', 5, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `fecha_estreno` date NOT NULL,
  `director` varchar(255) NOT NULL,
  `duracion_minutos` int(11) NOT NULL,
  `sinopsis` text DEFAULT NULL,
  `numero_libro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id`, `titulo`, `fecha_estreno`, `director`, `duracion_minutos`, `sinopsis`, `numero_libro`) VALUES
(1, 'Crepúsculo', '2008-11-21', 'Catherine Hardwick', 122, 'Bella Swan se muda a Forks y conoce a Edward Cullen, un vampiro que se enamora de ella. A medida que su relación se desarrolla, Bella se enfrenta a peligros y secretos del mundo sobrenatural.', 1),
(2, 'Luna Nueva', '2009-11-20', 'Chris Weitz', 130, 'Después de la partida de Edward, Bella se sumerge en la tristeza y la soledad. Sin embargo, encuentra consuelo en su amistad con Jacob Black, un hombre lobo, y se enfrenta a nuevas amenazas que ponen en peligro su vida.', 2),
(3, 'Eclipse', '2010-06-30', 'David Slade', 124, 'Bella se encuentra atrapada entre su amor por Edward y su amistad con Jacob. Mientras se avecina una guerra entre vampiros y hombres lobo, Bella debe tomar decisiones difíciles que afectarán su futuro y el de aquellos que ama.', 3),
(4, 'Amanecer - Parte 1', '2011-11-18', 'Bill Condon', 117, 'Bella y Edward se casan y esperan un hijo. Sin embargo, el embarazo de Bella trae consigo complicaciones y peligros inesperados. La familia Cullen se enfrenta a desafíos que pondrán a prueba su amor y su lealtad, mientras luchan por proteger a su hija y mantener la paz entre vampiros y hombres lobo.', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personajes`
--

CREATE TABLE `personajes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `especie` enum('humano','vampiro','hombre lobo') NOT NULL,
  `familia` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `numero_libro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personajes`
--

INSERT INTO `personajes` (`id`, `nombre`, `especie`, `familia`, `descripcion`, `numero_libro`) VALUES
(1, 'Bella Swan', 'humano', NULL, 'Protagonista de la saga, una joven que se muda a Forks y se enamora de Edward Cullen, un vampiro.', 1),
(2, 'Edward Cullen', 'vampiro', 'Cullen', 'Vampiro que se enamora de Bella Swan. Es parte de la familia Cullen y lucha por proteger a Bella de los peligros del mundo sobrenatural.', 1),
(3, 'Jacob Black', 'hombre lobo', 'Quileute', 'Amigo de Bella y miembro de la tribu Quileute. Se convierte en un hombre lobo y desarrolla sentimientos románticos hacia Bella, lo que genera un conflicto con Edward.', 2),
(4, 'Alice Cullen', 'vampiro', 'Cullen', 'Vampira y miembro de la familia Cullen. Es conocida por su habilidad para ver el futuro y su personalidad alegre y optimista. Se convierte en una amiga cercana de Bella y la apoya en su relación con Edward.', 1),
(5, 'Emmett Cullen', 'vampiro', 'Cullen', NULL, 1),
(6, 'Rosalie Hale', 'vampiro', 'Cullen', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo_usuario` enum('admin','usuario') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `tipo_usuario`) VALUES
(1, 'Bianca', 'bianca@gmail.com', 'bianca123', 'admin'),
(2, 'Facundo', 'facundo@gmail.com', 'facu123', 'usuario'),
(3, 'Sofia', 'sofi@hotmail.com', 'sofi123', 'usuario'),
(4, 'Franco', 'franco@hotmail.com', 'franco123', 'usuario'),
(5, 'Valentina', 'valentina@hotmail.com', 'valentina123', 'usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personajes`
--
ALTER TABLE `personajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `personajes`
--
ALTER TABLE `personajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
