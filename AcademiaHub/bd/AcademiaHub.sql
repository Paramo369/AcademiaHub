CREATE DATABASE academiahub;
USE academiahub;

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido_paterno VARCHAR(50) NOT NULL,
    apellido_materno VARCHAR(50),
    correo_electronico VARCHAR(100) NOT NULL,
    nombre_usuario VARCHAR(50) NOT NULL,
    contrasena VARCHAR(255) NOT NULL
);


CREATE TABLE administradores (
    id_administrador INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido_paterno VARCHAR(50) NOT NULL,
    apellido_materno VARCHAR(50),
    correo_electronico VARCHAR(100) NOT NULL,
    nombre_usuario VARCHAR(50) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    tipo_rol VARCHAR(20) NOT NULL DEFAULT 'admin'
);

CREATE TABLE cursos (
    id_curso INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    creador_del_curso VARCHAR(50) NOT NULL,
    imagen VARCHAR(255) 
);

CREATE TABLE seminarios (
    id_seminario INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    orador VARCHAR(255),
    fecha DATE,
    imagen VARCHAR(255) 
);

CREATE TABLE usuario_curso (
    id_usuario INT NOT NULL,
    id_curso INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_curso) REFERENCES cursos(id_curso)
); 

CREATE TABLE usuario_seminario (
    id_usuario INT NOT NULL,
    id_seminario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_seminario) REFERENCES seminarios(id_seminario)
); 

CREATE TABLE admin_curso (
    id_administrador INT NOT NULL,
    id_curso INT NOT NULL,
    FOREIGN KEY (id_administrador) REFERENCES administradores(id_administrador),
    FOREIGN KEY (id_curso) REFERENCES cursos(id_curso)
); 

CREATE TABLE admin_seminario (
    id_administrador INT NOT NULL,
    id_seminario INT NOT NULL,
    FOREIGN KEY (id_administrador) REFERENCES administradores(id_administrador),
    FOREIGN KEY (id_seminario) REFERENCES seminarios(id_seminario)
); 

--Tablas y Triggers

CREATE TABLE reg_cursos (
    id_curso INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    creador_del_curso VARCHAR(50) NOT NULL,
    imagen VARCHAR(255),
    registro DATETIME
);

CREATE TABLE reg_seminarios (
    id_seminario INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    orador VARCHAR(255),
    fecha DATE,
    imagen VARCHAR(255),
    registro DATETIME
);

CREATE TRIGGER cursos_AI 
AFTER INSERT ON cursos 
FOR EACH ROW 
INSERT INTO reg_cursos (id_curso, nombre, descripcion, creador_del_curso, imagen, registro) 
VALUES (NEW.id_curso, NEW.nombre, NEW.descripcion, NEW.creador_del_curso, NEW.imagen, NOW());

CREATE TRIGGER seminarios_AD
AFTER DELETE ON seminarios
FOR EACH ROW
INSERT INTO reg_seminarios (id_seminario, nombre, descripcion, orador, fecha, imagen, registro)
VALUES (OLD.id_seminario, OLD.nombre, OLD.descripcion, OLD.orador, OLD.fecha, OLD.imagen, NOW());

--Vista

CREATE VIEW vista_cursos AS
SELECT id_curso, nombre, descripcion, creador_del_curso, imagen
FROM cursos;


SELECT * FROM vista_cursos;
