CREATE DATABASE crepusculo;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    tipo_usuario ENUM('admin', 'usuario') NOT NULL
);

INSERT INTO usuarios (nombre, email, password, tipo_usuario)
VALUES ('Bianca', 'bianca@gmail.com', 'bianca123', 'admin');

INSERT INTO usuarios (nombre, email, password, tipo_usuario)
VALUES ('Facundo', 'facundo@gmail.com', 'facu123', 'usuario');

INSERT INTO usuarios (nombre, email, password, tipo_usuario)
VALUES ('Sofia', 'sofi@hotmail.com', 'sofi123', 'usuario');

INSERT INTO usuarios (nombre, email, password, tipo_usuario)
VALUES ('Franco', 'franco@hotmail.com', 'franco123', 'usuario');

INSERT INTO usuarios (nombre, email, password, tipo_usuario)
VALUES ('Valentina', 'valentina@hotmail.com', 'valentina123', 'usuario');

CREATE TABLE libros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255) NOT NULL,
    fecha_publicacion DATE NOT NULL,
    orden_saga INT NOT NULL,
    sinopsis TEXT NULL
);

INSERT INTO libros (titulo, autor, fecha_publicacion, orden_saga, sinopsis)
VALUES ('Crepúsculo', 'Stephenie Meyer', '2005-10-05', 1, 'Bella Swan se muda a Forks y conoce a Edward Cullen, un vampiro que se enamora de ella. A medida que su relación se desarrolla, Bella se enfrenta a peligros y secretos del mundo sobrenatural.');

INSERT INTO libros (titulo, autor, fecha_publicacion, orden_saga, sinopsis)
VALUES ('Luna Nueva', 'Stephenie Meyer', '2006-10-05', 2, 'Después de la partida de Edward, Bella se sumerge en la tristeza y la soledad. Sin embargo, encuentra consuelo en su amistad con Jacob Black, un hombre lobo, y se enfrenta a nuevas amenazas que ponen en peligro su vida.');

INSERT INTO libros (titulo, autor, fecha_publicacion, orden_saga, sinopsis)
VALUES ('Eclipse', 'Stephenie Meyer', '2007-08-07', 3, 'Bella se encuentra atrapada entre su amor por Edward y su amistad con Jacob. Mientras se avecina una guerra entre vampiros y hombres lobo, Bella debe tomar decisiones difíciles que afectarán su futuro y el de aquellos que ama.');

INSERT INTO libros (titulo, autor, fecha_publicacion, orden_saga, sinopsis)
VALUES ('Amanecer', 'Stephenie Meyer', '2008-08-02', 4, 'Bella y Edward se casan y esperan un hijo. Sin embargo, el embarazo de Bella trae consigo complicaciones y peligros inesperados. La familia Cullen se enfrenta a desafíos que pondrán a prueba su amor y su lealtad, mientras luchan por proteger a su hija y mantener la paz entre vampiros y hombres lobo.');

INSERT INTO libros (titulo, autor, fecha_publicacion, orden_saga, sinopsis)
VALUES ('Sol de Medianoche', 'Stephenie Meyer', '2020-08-04', 5, NULL);

CREATE TABLE peliculas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    fecha_estreno DATE NOT NULL,
    director VARCHAR(255) NOT NULL,
    duracion_minutos INT NOT NULL,
    sinopsis TEXT NULL,
    numero_libro INT NULL
);

INSERT INTO peliculas (titulo, fecha_estreno, director, duracion_minutos, sinopsis, numero_libro)
VALUES ('Crepúsculo', '2008-11-21', 'Catherine Hardwick', 122, 'Bella Swan se muda a Forks y conoce a Edward Cullen, un vampiro que se enamora de ella. A medida que su relación se desarrolla, Bella se enfrenta a peligros y secretos del mundo sobrenatural.', 1);

INSERT INTO peliculas (titulo, fecha_estreno, director, duracion_minutos, sinopsis, numero_libro)
VALUES ('Luna Nueva', '2009-11-20', 'Chris Weitz', 130, 'Después de la partida de Edward, Bella se sumerge en la tristeza y la soledad. Sin embargo, encuentra consuelo en su amistad con Jacob Black, un hombre lobo, y se enfrenta a nuevas amenazas que ponen en peligro su vida.', 2);

INSERT INTO peliculas (titulo, fecha_estreno, director, duracion_minutos, sinopsis, numero_libro)
VALUES ('Eclipse', '2010-06-30', 'David Slade', 124, 'Bella se encuentra atrapada entre su amor por Edward y su amistad con Jacob. Mientras se avecina una guerra entre vampiros y hombres lobo, Bella debe tomar decisiones difíciles que afectarán su futuro y el de aquellos que ama.', 3);

INSERT INTO peliculas (titulo, fecha_estreno, director, duracion_minutos, sinopsis, numero_libro)
VALUES ('Amanecer - Parte 1', '2011-11-18', 'Bill Condon', 117, 'Bella y Edward se casan y esperan un hijo. Sin embargo, el embarazo de Bella trae consigo complicaciones y peligros inesperados. La familia Cullen se enfrenta a desafíos que pondrán a prueba su amor y su lealtad, mientras luchan por proteger a su hija y mantener la paz entre vampiros y hombres lobo.', 4);

CREATE TABLE personajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    especie ENUM('humano', 'vampiro', 'hombre lobo') NOT NULL,
    familia VARCHAR(255) NULL,
    descripcion TEXT NULL,
    numero_libro INT NULL
);

INSERT INTO personajes (nombre, especie, familia, descripcion, numero_libro)
VALUES ('Bella Swan', 'humano', NULL, 'Protagonista de la saga, una joven que se muda a Forks y se enamora de Edward Cullen, un vampiro.', 1);

INSERT INTO personajes (nombre, especie, familia, descripcion, numero_libro)
VALUES ('Edward Cullen', 'vampiro', 'Cullen', 'Vampiro que se enamora de Bella Swan. Es parte de la familia Cullen y lucha por proteger a Bella de los peligros del mundo sobrenatural.', 1);

INSERT INTO personajes (nombre, especie, familia, descripcion, numero_libro)
VALUES ('Jacob Black', 'hombre lobo', 'Quileute', 'Amigo de Bella y miembro de la tribu Quileute. Se convierte en un hombre lobo y desarrolla sentimientos románticos hacia Bella, lo que genera un conflicto con Edward.', 2);

INSERT INTO personajes (nombre, especie, familia, descripcion, numero_libro)
VALUES ('Alice Cullen', 'vampiro', 'Cullen', 'Vampira y miembro de la familia Cullen. Es conocida por su habilidad para ver el futuro y su personalidad alegre y optimista. Se convierte en una amiga cercana de Bella y la apoya en su relación con Edward.', 1);

INSERT INTO personajes (nombre, especie, familia, descripcion, numero_libro)
VALUES ('Emmett Cullen', 'vampiro', 'Cullen', NULL, 1);

INSERT INTO personajes (nombre, especie, familia, descripcion, numero_libro)
VALUES ('Rosalie Hale', 'vampiro', 'Cullen', NULL, 1);