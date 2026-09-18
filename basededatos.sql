create database crepusuculo;
create table usuarios(
    id int primary key auto_increment,
    nombre varchar(255) not null, 
    email varchar(255) not null,
    password varchar(255) not null,
    tipo_usuario enum( 'admin', 'usuario') not null
);
CREATE TABLE libros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255) NOT NULL,
    fecha_publicacion DATE NOT NULL,
    orden_saga INT NOT NULL,
    sinopsis TEXT NULL
);

CREATE TABLE peliculas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    fecha_estreno DATE NOT NULL,
    director VARCHAR(255) NOT NULL,
    duracion_minutos INT NOT NULL,
    sinopsis TEXT NULL,
    numero_libro INT NULL
);

CREATE TABLE personajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    especie ENUM('humano', 'vampiro', 'hombre lobo') NOT NULL,
    familia VARCHAR(255) NULL,
    descripcion TEXT NULL,
    numero_libro INT NULL
);
