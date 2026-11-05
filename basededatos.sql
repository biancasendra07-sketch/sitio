CREATE DATABASE IF NOT EXISTS crepusculo CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE crepusculo;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS libros;
DROP TABLE IF EXISTS peliculas;
DROP TABLE IF EXISTS personajes;

-- Usuarios del sitio. Las contraseñas se guardan con password_hash(), nunca en texto plano.
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    tipo_usuario ENUM('admin', 'usuario') NOT NULL DEFAULT 'usuario'
);

-- Usuarios de prueba. Contraseñas: bianca123, facu123, sofi123, franco123, valentina123
INSERT INTO usuarios (nombre, email, password, tipo_usuario) VALUES
('Bianca', 'bianca@gmail.com', '$2y$10$RDIMHKkd1QJTwAi8b2Vzku8.5yrRP5xCWltDOkTKyEH8VIYNLrlBG', 'admin'),
('Facundo', 'facundo@gmail.com', '$2y$10$Ur5WOV.sa1Omg15gKowq4OtWdb8QX3d6dkJV6zXM2U6fPwywHuyda', 'usuario'),
('Sofia', 'sofi@hotmail.com', '$2y$10$5bgS/dzhZQv3wCeqd/AAm.Hr3tItjuyo0NLt46IMApz/pxlbXGuPW', 'usuario'),
('Franco', 'franco@hotmail.com', '$2y$10$/zd1am4xPXv2Ui871VZ5QO7dznCJW86W7iJw75FuirEpJrs4q/Tz6', 'usuario'),
('Valentina', 'valentina@hotmail.com', '$2y$10$8TjN15WPDRfYbH1wmkflje35fDK/oFDixiytCr3rYT8kMzVXY1MUu', 'usuario');

CREATE TABLE libros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255) NOT NULL,
    fecha_publicacion DATE NOT NULL,
    orden_saga INT NOT NULL,
    sinopsis TEXT NULL
);

INSERT INTO libros (titulo, autor, fecha_publicacion, orden_saga, sinopsis) VALUES
('Crepúsculo', 'Stephenie Meyer', '2005-10-05', 1, 'Bella Swan se muda a Forks y conoce a Edward Cullen, un vampiro que se enamora de ella. A medida que su relación se desarrolla, Bella se enfrenta a peligros y secretos del mundo sobrenatural.'),
('Luna Nueva', 'Stephenie Meyer', '2006-10-05', 2, 'Después de la partida de Edward, Bella se sumerge en la tristeza y la soledad. Sin embargo, encuentra consuelo en su amistad con Jacob Black, un hombre lobo, y se enfrenta a nuevas amenazas que ponen en peligro su vida.'),
('Eclipse', 'Stephenie Meyer', '2007-08-07', 3, 'Bella se encuentra atrapada entre su amor por Edward y su amistad con Jacob. Mientras se avecina una guerra entre vampiros y hombres lobo, Bella debe tomar decisiones difíciles que afectarán su futuro y el de aquellos que ama.'),
('Amanecer', 'Stephenie Meyer', '2008-08-02', 4, 'Bella y Edward se casan y esperan un hijo. Sin embargo, el embarazo de Bella trae consigo complicaciones y peligros inesperados. La familia Cullen se enfrenta a desafíos que pondrán a prueba su amor y su lealtad, mientras luchan por proteger a su hija y mantener la paz entre vampiros y hombres lobo.'),
('Sol de Medianoche', 'Stephenie Meyer', '2020-08-04', 5, NULL);

CREATE TABLE peliculas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    fecha_estreno DATE NOT NULL,
    director VARCHAR(255) NOT NULL,
    duracion_minutos INT NOT NULL,
    sinopsis TEXT NULL,
    numero_libro INT NULL
);

INSERT INTO peliculas (titulo, fecha_estreno, director, duracion_minutos, sinopsis, numero_libro) VALUES
('Crepúsculo', '2008-11-21', 'Catherine Hardwicke', 122, 'Bella Swan se muda a Forks y conoce a Edward Cullen, un vampiro que se enamora de ella. A medida que su relación se desarrolla, Bella se enfrenta a peligros y secretos del mundo sobrenatural.', 1),
('Luna Nueva', '2009-11-20', 'Chris Weitz', 130, 'Después de la partida de Edward, Bella se sumerge en la tristeza y la soledad. Sin embargo, encuentra consuelo en su amistad con Jacob Black, un hombre lobo, y se enfrenta a nuevas amenazas que ponen en peligro su vida.', 2),
('Eclipse', '2010-06-30', 'David Slade', 124, 'Bella se encuentra atrapada entre su amor por Edward y su amistad con Jacob. Mientras se avecina una guerra entre vampiros y hombres lobo, Bella debe tomar decisiones difíciles que afectarán su futuro y el de aquellos que ama.', 3),
('Amanecer - Parte 1', '2011-11-18', 'Bill Condon', 117, 'Bella y Edward se casan y esperan un hijo. Sin embargo, el embarazo de Bella trae consigo complicaciones y peligros inesperados. La familia Cullen se enfrenta a desafíos que pondrán a prueba su amor y su lealtad, mientras luchan por proteger a su hija y mantener la paz entre vampiros y hombres lobo.', 4);

-- Personajes para el buscador. "imagen" guarda la ruta del archivo, no la imagen.
CREATE TABLE personajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    especie ENUM('humano', 'vampiro', 'hombre lobo') NOT NULL,
    familia VARCHAR(255) NULL,
    grupo ENUM('protagonista', 'secundario') NOT NULL DEFAULT 'secundario',
    descripcion TEXT NULL,
    imagen VARCHAR(255) NOT NULL,
    numero_libro INT NULL
);

INSERT INTO personajes (nombre, especie, familia, grupo, descripcion, imagen, numero_libro) VALUES
('Bella Swan', 'humano', NULL, 'protagonista', 'Inteligente y decidida, es capaz de enfrentarse a cualquier peligro por las personas que ama. Su llegada a Forks cambia para siempre su vida y la de quienes la rodean.', 'images/bella-swan.jpg', 1),
('Edward Cullen', 'vampiro', 'Cullen', 'protagonista', 'Un vampiro centenario con apariencia de adolescente. Edward lucha contra su naturaleza mientras intenta proteger a Bella de los peligros de su mundo.', 'images/edward-cullen.jpg', 1),
('Jacob Black', 'hombre lobo', 'Quileute', 'protagonista', 'El amigo leal de Bella pertenece a una comunidad marcada por antiguos secretos. Su transformación lo enfrenta a un destino que nunca eligió.', 'images/jacob-black.jpg', 2),
('Victoria', 'vampiro', NULL, 'secundario', 'Es una vampira que busca vengarse de Bella y Edward después de la muerte de James. Su habilidad para escapar y sobrevivir sostiene su plan de venganza.', 'images/victoria.jpg', 1),
('James', 'vampiro', NULL, 'secundario', 'Es un vampiro rastreador extremadamente hábil y una de las primeras grandes amenazas para Bella. Se caracteriza por perseguir obsesivamente a sus víctimas.', 'images/james.jpg', 1),
('Alice Cullen', 'vampiro', 'Cullen', 'secundario', 'La hermana de Edward puede ver posibles futuros. Su energía y sensibilidad la convierten en una de las figuras más queridas de la familia Cullen.', 'images/alice-cullen.jpg', 1),
('Carlisle Cullen', 'vampiro', 'Cullen', 'secundario', 'El líder de la familia Cullen eligió vivir sin dañar a los humanos. Su compasión y experiencia sostienen a todos durante los momentos más difíciles.', 'images/carlisle-cullen.jpg', 1),
('Jasper Hale', 'vampiro', 'Cullen', 'secundario', 'Es uno de los hermanos Cullen y posee la capacidad de percibir y controlar las emociones de quienes lo rodean. Tiene un pasado relacionado con otros grupos de vampiros.', 'images/jasper-hale.jpg', 1),
('Rosalie Hale', 'vampiro', 'Cullen', 'secundario', 'Es una de las hermanas Cullen y se caracteriza por su belleza, personalidad fuerte y carácter reservado. A pesar de su apariencia distante, protege profundamente a su familia.', 'images/rosalie-hale.jpg', 1),
('Esme Cullen', 'vampiro', 'Cullen', 'secundario', 'Esme Cullen es la madre adoptiva de la familia Cullen. Se destaca por su carácter cariñoso y protector, y por mantener unida a su familia.', 'images/esme-cullen.jpg', 1);
