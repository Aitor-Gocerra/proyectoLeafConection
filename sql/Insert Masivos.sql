-- ######################################
-- Datos para la tabla Tematica
-- ######################################
INSERT INTO Tematica (idTematica, tematica) VALUES
(1, 'Medio Ambiente'),
(2, 'Sostenibilidad'),
(3, 'Reciclaje'),
(4, 'Energías Renovables'),
(5, 'Fauna y Flora'),
(6, 'Cambio Climático');

-- ######################################
-- Datos para la tabla Consejos
-- ######################################
INSERT INTO Consejos (consejo, idTematica) VALUES
('Ahorra agua cerrando el grifo mientras te cepillas los dientes.', 1),
('Utiliza bolsas de tela reutilizables para tus compras.', 2),
('Separa correctamente el plástico, papel y vidrio.', 3),
('Considera la instalación de bombillas LED de bajo consumo.', 4),
('Planta un árbol nativo en tu jardín o comunidad.', 1),
('Revisa y repara las fugas de agua en casa para evitar desperdicio.', 2),
('Dona la ropa que ya no uses en lugar de tirarla.', 3),
('Aprovecha la luz natural al máximo para reducir el consumo eléctrico.', 4);

-- ######################################
-- Datos para la tabla Usuario
-- Contraseñas sencillas en texto plano para pruebas.
-- ######################################
INSERT INTO Usuario (idUsuario, nombre, correo, pw, estado) VALUES
(1, 'Alice Green', 'alice@ejemplo.com', 'alice1', 1),
(2, 'Bob Earth', 'bob@ejemplo.com', 'bob123', 1),
(3, 'Charlie Wind', 'charlie@ejemplo.com', 'charlie45', 1),
(4, 'Diana Leaf', 'diana@ejemplo.com', 'diana67', 1),
(5, 'Erick Water', 'erick@ejemplo.com', 'erick89', 1),
(6, 'Fiona Fire', 'fiona@ejemplo.com', 'fiona01', 1);

-- ######################################
-- Datos para la tabla Amigos
-- Se respetan las restricciones: idUsuario1 < idUsuario2
-- Estado 1: Aceptada | Estado 0: Pendiente
-- ######################################
INSERT INTO Amigos (idUsuario1, idUsuario2, estado) VALUES
(1, 2, 1),  -- Alice y Bob (Aceptada)
(1, 3, 0),  -- Alice a Charlie (Pendiente)
(2, 4, 1),  -- Bob y Diana (Aceptada)
(3, 4, 1),  -- Charlie y Diana (Aceptada)
(5, 6, 0),  -- Erick a Fiona (Pendiente)
(1, 4, 1);  -- Alice y Diana (Aceptada)



-- ######################################
-- Datos para la tabla Palabras
-- ######################################
INSERT INTO Palabras (idPalabra, palabra, definicion) VALUES
(1, 'Ecosistema', 'Comunidad de seres vivos y el medio natural en que viven.'),
(2, 'Compostaje', 'Proceso de descomposición de materia orgánica para abono.'),
(3, 'Biomasa', 'Materia orgánica originada en un proceso biológico, utilizable como fuente de energía.'),
(4, 'Huella', 'Rastro o señal que deja un organismo o actividad en el medio ambiente.'),
(5, 'Biodiversidad', 'Variedad de formas de vida en la Tierra.');



-- ######################################
-- Datos para la tabla PistasPalabras
-- ######################################
INSERT INTO PistasPalabras (idPalabra, pista) VALUES
(1, 'Incluye factores bióticos y abióticos.'),
(2, 'Se utiliza para producir fertilizante natural.'),
(3, 'Es una fuente de energía renovable.'),
(4, 'A menudo se mide en carbono.'),
(5, 'Es la riqueza de la vida en nuestro planeta.');



-- ######################################
-- Datos para la tabla Frases
-- ######################################
INSERT INTO Frases (idFrase, frase, palabraFaltante) VALUES
(1, 'La ______ solar es una fuente de energía inagotable.', 'energía'),
(2, 'Reciclar el ______ ayuda a reducir la contaminación.', 'plástico'),
(3, 'El ______ es esencial para la vida en el planeta.', 'agua'),
(4, 'Los bosques son el ______ de muchos animales.', 'hogar'),
(5, 'El efecto ______ calienta la atmósfera terrestre.', 'invernadero');



-- ######################################
-- Datos para la tabla PistasFrase
-- ######################################
INSERT INTO PistasFrase (idFrase, pista) VALUES
(1, 'Se obtiene directamente del sol.'),
(2, 'Material que se usa para envases y botellas.'),
(3, 'Cubre la mayor parte de la superficie terrestre.'),
(4, 'Sinónimo de vivienda o morada.'),
(5, 'Se produce por la concentración de gases.');



-- ######################################
-- Datos para la tabla Noticias
-- ######################################
INSERT INTO Noticias (idNoticia, titulo, noticia, urlImagen) VALUES
(1, 'Récord de árboles plantados en el mundo', 'Organizaciones de todo el mundo celebran el récord de plantación, superando las estimaciones iniciales...', 'https://ejemplo.com/imagen1.jpg'),
(2, 'Innovación en el reciclaje de baterías', 'Una nueva tecnología promete hacer el proceso de reciclaje de baterías de litio más eficiente y ecológico...', 'https://ejemplo.com/imagen2.jpg'),
(3, 'El impacto del plástico en los océanos', 'Científicos alertan sobre el aumento de microplásticos en las zonas abisales y costeras.', 'https://ejemplo.com/imagen3.jpg'),
(4, 'Avance en la energía geotérmica', 'Se descubre un nuevo método para extraer energía del calor interno de la Tierra de forma más económica.', 'https://ejemplo.com/imagen4.jpg');



-- ######################################
-- Datos para la tabla Preguntas, Opciones y RespuestaCorrecta (Noticia 1)
-- ######################################
INSERT INTO Preguntas (idNoticia, nPregunta, pregunta) VALUES
(1, 1, '¿Qué evento mundial se destaca en la Noticia 1?'),
(1, 2, 'Según la noticia, ¿qué fue superado?');

INSERT INTO Opciones (idNoticia, nPregunta, nOpcion, opcion) VALUES
(1, 1, 1, 'Récord de donaciones a ONGs'),
(1, 1, 2, 'Récord de árboles plantados'),
(1, 1, 3, 'Descubrimiento de nuevas especies'),
(1, 2, 1, 'Las previsiones de crecimiento económico'),
(1, 2, 2, 'Las estimaciones iniciales de plantación'),
(1, 2, 3, 'El presupuesto destinado al proyecto');

INSERT INTO RespuestaCorrecta (idNoticia, nPregunta, nOpcion) VALUES
(1, 1, 2),
(1, 2, 2);



-- ######################################
-- Datos para la tabla Partida
-- ######################################
INSERT INTO Partida (idPartida, temporizador, puntuacion, intentos, idUsuario) VALUES
(1, 120, 10, 3, 1), -- Partida de Alice (Noticia + Palabra)
(2, 90, 8, 2, 2),  -- Partida de Bob (Frase)
(3, 150, 12, 4, 1), -- Otra partida de Alice (Palabra)
(4, 100, 9, 3, 3),  -- Partida de Charlie (Noticia)
(5, 75, 7, 2, 4);   -- Partida de Diana (Frase)


-- ######################################
-- Datos para las tablas de Partida-Item
-- ######################################

-- PalabraDia
INSERT INTO PalabraDia (idPartida, idPalabra) VALUES
(1, 1), -- Partida 1 (Alice) -> Palabra 1 (Ecosistema)
(3, 2); -- Partida 3 (Alice) -> Palabra 2 (Compostaje)

-- FraseDia
INSERT INTO FraseDia (idPartida, idFrase) VALUES
(2, 3), -- Partida 2 (Bob) -> Frase 3 (Agua)
(5, 1); -- Partida 5 (Diana) -> Frase 1 (Energía)

-- NoticiaDia
INSERT INTO NoticiaDia (idPartida, idNoticia) VALUES
(1, 1), -- Partida 1 (Alice) -> Noticia 1
(4, 2); -- Partida 4 (Charlie) -> Noticia 2

-- ######################################
-- Datos para la tabla Administrador
-- Contraseñas sencillas en texto plano para pruebas.
-- ######################################
INSERT INTO Administrador (idAdmin, nombre, correo, password) VALUES
(1, 'Admin Principal', 'admin@leafconnect.com', 'admin1'),
(2, 'Aitor Garcia', 'aitor@leafconnect.com', 'aitor2');