USE tienda_discos;
SET NAMES utf8mb4;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    direccion VARCHAR(200),
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE artistas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    pais VARCHAR(50),
    anio_inicio INT
);

CREATE TABLE generos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE albumes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    artista_id INT NOT NULL,
    genero_principal_id INT NOT NULL,
    anio INT NOT NULL,
    portada MEDIUMBLOB,
    FOREIGN KEY (artista_id) REFERENCES artistas(id),
    FOREIGN KEY (genero_principal_id) REFERENCES generos(id)
);

CREATE TABLE ediciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    album_id INT NOT NULL,
    formato ENUM('Vinilo', 'CD', 'Casete') NOT NULL,
    precio DECIMAL(8,2) NOT NULL,
    existencias INT NOT NULL DEFAULT 0,
    UNIQUE (album_id, formato),
    FOREIGN KEY (album_id) REFERENCES albumes(id) ON DELETE CASCADE
);

CREATE TABLE generos_secundarios (
    album_id INT NOT NULL,
    genero_id INT NOT NULL,
    PRIMARY KEY (album_id, genero_id),
    FOREIGN KEY (album_id) REFERENCES albumes(id) ON DELETE CASCADE,
    FOREIGN KEY (genero_id) REFERENCES generos(id)
);

CREATE TABLE canciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    album_id INT NOT NULL,
    numero INT NOT NULL,
    titulo VARCHAR(150) NOT NULL,
    duracion TIME,
    UNIQUE (album_id, numero),
    FOREIGN KEY (album_id) REFERENCES albumes(id) ON DELETE CASCADE
);

CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10,2) NOT NULL,
    estado ENUM('Pendiente', 'Enviado', 'Entregado', 'Cancelado') NOT NULL DEFAULT 'Pendiente',
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE detalle_pedido (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    edicion_id INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(8,2) NOT NULL,
    UNIQUE (pedido_id, edicion_id),
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
    FOREIGN KEY (edicion_id) REFERENCES ediciones(id)
);

CREATE TABLE resenas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    album_id INT NOT NULL,
    calificacion INT NOT NULL CHECK (calificacion BETWEEN 1 AND 5),
    comentario TEXT,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (usuario_id, album_id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (album_id) REFERENCES albumes(id) ON DELETE CASCADE
);

INSERT INTO generos (nombre) VALUES
('Rock alternativo'), ('Electrónica'), ('Post-rock'), ('Hip hop');

INSERT INTO artistas (nombre, pais, anio_inicio) VALUES
('Radiohead', 'Reino Unido', 1985),
('Gorillaz', 'Reino Unido', 1998),
('Godspeed You! Black Emperor', 'Canadá', 1994),
('Aphex Twin', 'Reino Unido', 1985);

INSERT INTO albumes (titulo, artista_id, genero_principal_id, anio) VALUES
('Kid A', 1, 1, 2000),
('OK Computer', 1, 1, 1997),
('Gorillaz', 2, 4, 2001),
('Lift Your Skinny Fists Like Antennas to Heaven', 3, 3, 2000),
('Selected Ambient Works 85-92', 4, 2, 1992);

INSERT INTO ediciones (album_id, formato, precio, existencias) VALUES
(1, 'Vinilo', 749.00, 5),
(2, 'CD', 299.00, 10),
(3, 'Vinilo', 699.00, 3),
(4, 'Vinilo', 899.00, 2),
(5, 'Casete', 249.00, 4);

INSERT INTO generos_secundarios (album_id, genero_id) VALUES
(1, 2),
(3, 1),
(3, 2),
(4, 1);

INSERT INTO canciones (album_id, numero, titulo, duracion) VALUES
(1, 1, 'Everything in Its Right Place', '00:04:11'),
(1, 2, 'Kid A', '00:04:44'),
(1, 3, 'The National Anthem', '00:05:51'),
(2, 1, 'Airbag', '00:04:44'),
(2, 2, 'Paranoid Android', '00:06:23'),
(3, 1, 'Re-Hash', '00:03:37'),
(3, 2, '19-2000', '00:03:27'),
(4, 1, 'Storm', '00:22:32'),
(5, 1, 'Xtal', '00:04:54');

INSERT INTO usuarios (nombre, correo, contrasena, direccion) VALUES
('Ana López', 'ana@correo.com', '$2y$10$V2JQTaGdtFKnt6Xd7fMSr.6JcQC5daY8G8xQxgRfOIQHkaTVpqMaW', 'Av. Universidad 100, CDMX'),
('Luis Pérez', 'luis@correo.com', '$2y$10$CNW9H5uUfYBvPjCMpnuXTOmMWTqxV3dXNuedCg3zeghPbW41.MyGu', 'Calle Reforma 25, Edomex');

INSERT INTO pedidos (usuario_id, total, estado) VALUES
(1, 1048.00, 'Enviado'),
(2, 899.00, 'Pendiente');

INSERT INTO detalle_pedido (pedido_id, edicion_id, cantidad, precio_unitario) VALUES
(1, 1, 1, 749.00),
(1, 2, 1, 299.00),
(2, 4, 1, 899.00);

INSERT INTO resenas (usuario_id, album_id, calificacion, comentario) VALUES
(1, 1, 5, 'Llegó en perfecto estado, suena increíble.'),
(2, 4, 5, 'Una obra maestra del post-rock.');
