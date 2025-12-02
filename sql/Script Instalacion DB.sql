CREATE DATABASE IF NOT EXISTS leafconnect;
USE leafconnect;

-- ============================
-- Tabla Usuario
-- ============================
CREATE TABLE Usuario (
    idUsuario SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(150) NOT NULL,
    correo VARCHAR(150) NOT NULL UNIQUE,
    pw CHAR(60) NOT NULL, -- bcrypt size standard
    estado BIT NOT NULL DEFAULT 1,
    CONSTRAINT pk_idUsuario PRIMARY KEY (idUsuario)
);

-- ============================
-- Tabla Amigos
-- ============================
CREATE TABLE Amigos (
    idUsuario1 SMALLINT UNSIGNED NOT NULL,
    idUsuario2 SMALLINT UNSIGNED NOT NULL,
    fechaSolicitud TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    estado BIT NOT NULL DEFAULT 0,

    CONSTRAINT pk_amigo PRIMARY KEY (idUsuario1, idUsuario2),

    -- FK + cascada
    CONSTRAINT fk_amigo1 FOREIGN KEY (idUsuario1)
        REFERENCES Usuario(idUsuario) ON DELETE CASCADE,

    CONSTRAINT fk_amigo2 FOREIGN KEY (idUsuario2)
        REFERENCES Usuario(idUsuario) ON DELETE CASCADE,

    -- Evitar amistad consigo mismo
    CONSTRAINT chk_no_mismo_usuario CHECK (idUsuario1 <> idUsuario2),

    -- Evitar duplicados invertidos (1,2) y (2,1)
    CONSTRAINT chk_orden_usuarios CHECK (idUsuario1 < idUsuario2)
);

-- ============================
-- Tabla Tematica
-- ============================
CREATE TABLE Tematica (
    idTematica TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    tematica VARCHAR(100) NOT NULL,
    CONSTRAINT pk_idTematica PRIMARY KEY (idTematica)
);

-- ============================
-- Tabla Consejos
-- ============================
CREATE TABLE Consejos (
    idConsejo SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    consejo VARCHAR(255) NOT NULL,
    fechaProgramada TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    idTematica TINYINT UNSIGNED NOT NULL,

    CONSTRAINT pk_idConsejo PRIMARY KEY (idConsejo),
    CONSTRAINT fk_consejo_idTematica FOREIGN KEY (idTematica)
        REFERENCES Tematica(idTematica) ON DELETE CASCADE
);

-- ============================
-- Tabla Partida
-- ============================
CREATE TABLE Partida (
    idPartida INT UNSIGNED NOT NULL AUTO_INCREMENT,
    fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    temporizador SMALLINT UNSIGNED NOT NULL,
    puntuacion TINYINT UNSIGNED NOT NULL,
    intentos TINYINT UNSIGNED NOT NULL,
    idUsuario SMALLINT UNSIGNED NOT NULL,

    CONSTRAINT pk_idPartida PRIMARY KEY (idPartida),
    CONSTRAINT fk_idUsuario_partidas FOREIGN KEY (idUsuario)
        REFERENCES Usuario(idUsuario) ON DELETE CASCADE
);

-- ============================
-- Tabla Palabras
-- ============================
CREATE TABLE Palabras (
    idPalabra SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    palabra VARCHAR(70) NOT NULL,
    definicion VARCHAR(180) NOT NULL,
    fechaProgramada TIMESTAMP NULL,
    fechaCreacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pk_idPalabra PRIMARY KEY (idPalabra)
);

-- ============================
-- Tabla Frases
-- ============================
CREATE TABLE Frases (
    idFrase SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    frase VARCHAR(255) NOT NULL,
    palabraFaltante VARCHAR(40) NOT NULL,
    fechaProgramada TIMESTAMP NULL,
    fechaCreacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pk_idFrase PRIMARY KEY (idFrase)
);

-- ============================
-- Tabla Noticias
-- ============================
CREATE TABLE Noticias (
    idNoticia SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    titulo VARCHAR(120) NOT NULL,
    noticia TEXT NOT NULL,
    fechaProgramada TIMESTAMP NULL,
    fechaCreacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    urlImagen VARCHAR(255) NOT NULL,
    CONSTRAINT pk_idNoticia PRIMARY KEY (idNoticia)
);

-- ============================
-- PalabraDia
-- ============================
CREATE TABLE PalabraDia (
    idPartida INT UNSIGNED NOT NULL,
    idPalabra SMALLINT UNSIGNED NOT NULL,

    CONSTRAINT pk_palabraDia PRIMARY KEY (idPartida, idPalabra),
    CONSTRAINT fk_idPartida_palabraDia FOREIGN KEY (idPartida)
        REFERENCES Partida(idPartida) ON DELETE CASCADE,
    CONSTRAINT fk_idPalabra_palabraDia FOREIGN KEY (idPalabra)
        REFERENCES Palabras(idPalabra) ON DELETE CASCADE
);

-- ============================
-- FraseDia
-- ============================
CREATE TABLE FraseDia (
    idPartida INT UNSIGNED NOT NULL,
    idFrase SMALLINT UNSIGNED NOT NULL,

    CONSTRAINT pk_fraseDia PRIMARY KEY (idPartida, idFrase),
    CONSTRAINT fk_idPartida_fraseDia FOREIGN KEY (idPartida)
        REFERENCES Partida(idPartida) ON DELETE CASCADE,
    CONSTRAINT fk_idFrase_fraseDia FOREIGN KEY (idFrase)
        REFERENCES Frases(idFrase) ON DELETE CASCADE
);

-- ============================
-- NoticiaDia
-- ============================
CREATE TABLE NoticiaDia (
    idPartida INT UNSIGNED NOT NULL,
    idNoticia SMALLINT UNSIGNED NOT NULL,

    CONSTRAINT pk_noticiaDia PRIMARY KEY (idPartida, idNoticia),
    CONSTRAINT fk_idPartida_noticiaDia FOREIGN KEY (idPartida)
        REFERENCES Partida(idPartida) ON DELETE CASCADE,
    CONSTRAINT fk_idNoticia_noticiaDia FOREIGN KEY (idNoticia)
        REFERENCES Noticias(idNoticia) ON DELETE CASCADE
);

-- ============================
-- Preguntas
-- ============================
CREATE TABLE Preguntas (
    idNoticia SMALLINT UNSIGNED NOT NULL,
    nPregunta TINYINT NOT NULL,
    pregunta VARCHAR(150) NOT NULL,

    CONSTRAINT pk_idPregunta PRIMARY KEY (idNoticia, nPregunta),
    CONSTRAINT fk_idNoticia FOREIGN KEY (idNoticia)
        REFERENCES Noticias(idNoticia) ON DELETE CASCADE
);

-- ============================
-- Opciones
-- ============================
CREATE TABLE Opciones (
    idNoticia SMALLINT UNSIGNED NOT NULL,
    nPregunta TINYINT NOT NULL,
    nOpcion TINYINT NOT NULL,
    opcion VARCHAR(150) NOT NULL,

    CONSTRAINT pk_idOpcion PRIMARY KEY (idNoticia, nPregunta, nOpcion),
    CONSTRAINT fk_idPregunta FOREIGN KEY (idNoticia, nPregunta)
        REFERENCES Preguntas(idNoticia, nPregunta) ON DELETE CASCADE
);

-- ============================
-- RespuestaCorrecta
-- ============================
CREATE TABLE RespuestaCorrecta (
    idNoticia SMALLINT UNSIGNED NOT NULL,
    nPregunta TINYINT NOT NULL,
    nOpcion TINYINT NOT NULL,

    CONSTRAINT pk_idRespuestaCorrecta PRIMARY KEY (idNoticia, nPregunta),
    CONSTRAINT fk_idRespuestaCorrecta FOREIGN KEY (idNoticia, nPregunta, nOpcion)
        REFERENCES Opciones(idNoticia, nPregunta, nOpcion) ON DELETE CASCADE
);

-- ============================
-- PistasPalabras
-- ============================
CREATE TABLE PistasPalabras (
    idPista SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    idPalabra SMALLINT UNSIGNED NOT NULL,
    pista VARCHAR(200) NOT NULL,

    CONSTRAINT pk_PistaPalabra PRIMARY KEY (idPista),
    CONSTRAINT fk_idPalabra_pistaPalabra FOREIGN KEY (idPalabra)
        REFERENCES Palabras(idPalabra) ON DELETE CASCADE
);

-- ============================
-- PistasFrase
-- ============================
CREATE TABLE PistasFrase (
    idPista SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    idFrase SMALLINT UNSIGNED NOT NULL,
    pista VARCHAR(200) NOT NULL,

    CONSTRAINT pk_PistaFrase PRIMARY KEY (idPista),
    CONSTRAINT fk_idFrase_pistaFrase FOREIGN KEY (idFrase)
        REFERENCES Frases(idFrase) ON DELETE CASCADE
);

-- ============================
-- Administrador
-- ============================
CREATE TABLE Administrador (
    idAdmin SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(200) NOT NULL,
    correo VARCHAR(200) NOT NULL UNIQUE,
    password CHAR(60) NOT NULL, -- igual que Usuario
    CONSTRAINT pk_idAdmin PRIMARY KEY (idAdmin)
);
