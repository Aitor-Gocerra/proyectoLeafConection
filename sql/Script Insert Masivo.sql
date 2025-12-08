-- ============================
-- Script de Insert Masivo
-- Base de datos: leafconnect
-- ============================
USE leafconnect;

-- ============================
-- Inserción de Usuarios
-- ============================
-- NOTA: Todas las contraseñas están hasheadas con BCRYPT
-- Contraseña para todos los usuarios de prueba: "password123"
-- Hash BCRYPT: $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi

INSERT INTO Usuario (nombre, correo, pw, estado) VALUES
('Juan Pérez', 'juan.perez@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('María García', 'maria.garcia@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('Carlos López', 'carlos.lopez@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('Ana Martínez', 'ana.martinez@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('Pedro Sánchez', 'pedro.sanchez@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('Laura Rodríguez', 'laura.rodriguez@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('David Fernández', 'david.fernandez@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('Carmen Díaz', 'carmen.diaz@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('Miguel Torres', 'miguel.torres@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('Isabel Ruiz', 'isabel.ruiz@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('Antonio Gómez', 'antonio.gomez@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('Rosa Hernández', 'rosa.hernandez@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('Francisco Moreno', 'francisco.moreno@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('Elena Jiménez', 'elena.jimenez@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('José Álvarez', 'jose.alvarez@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('Lucía Romero', 'lucia.romero@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('Manuel Navarro', 'manuel.navarro@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('Sofía Serrano', 'sofia.serrano@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('Javier Gil', 'javier.gil@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('Paula Castro', 'paula.castro@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1);

-- ============================
-- Inserción de Relaciones de Amistad
-- ============================
INSERT INTO Amigos (idUsuario1, idUsuario2, estado) VALUES
(1, 2, 1), -- Juan y María son amigos
(1, 3, 1), -- Juan y Carlos son amigos
(1, 5, 0), -- Juan envió solicitud a Pedro (pendiente)
(2, 4, 1), -- María y Ana son amigas
(2, 6, 1), -- María y Laura son amigas
(3, 4, 1), -- Carlos y Ana son amigos
(3, 7, 0), -- Carlos envió solicitud a David (pendiente)
(4, 5, 1), -- Ana y Pedro son amigos
(5, 6, 1), -- Pedro y Laura son amigos
(6, 7, 1), -- Laura y David son amigos
(7, 8, 1), -- David y Carmen son amigos
(8, 9, 1), -- Carmen y Miguel son amigos
(9, 10, 1), -- Miguel e Isabel son amigos
(10, 11, 0), -- Isabel envió solicitud a Antonio (pendiente)
(11, 12, 1), -- Antonio y Rosa son amigos
(12, 13, 1), -- Rosa y Francisco son amigos
(13, 14, 1), -- Francisco y Elena son amigos
(14, 15, 1), -- Elena y José son amigos
(15, 16, 1), -- José y Lucía son amigos
(16, 17, 0); -- Lucía envió solicitud a Manuel (pendiente)

-- ============================
-- Inserción de Temáticas
-- ============================
INSERT INTO Tematica (tematica) VALUES
('Salud Mental'),
('Educación Ambiental'),
('Cambio Climático'),
('Biodiversidad'),
('Sostenibilidad'),
('Energías Renovables'),
('Contaminación'),
('Conservación'),
('Reciclaje'),
('Agua');

-- ============================
-- Inserción de Consejos
-- ============================
INSERT INTO Consejos (consejo, fechaProgramada, idTematica) VALUES
('Respira profundo durante 5 minutos cada mañana para reducir el estrés', '2025-01-10 08:00:00', 1),
('Reduce el uso de plásticos desechables en tu día a día', '2025-01-11 09:00:00', 2),
('Apaga las luces cuando no las necesites para ahorrar energía', '2025-01-12 10:00:00', 6),
('Planta un árbol en tu comunidad para ayudar al medio ambiente', '2025-01-13 08:00:00', 4),
('Usa transporte público o bicicleta para reducir tu huella de carbono', '2025-01-14 07:00:00', 3),
('Separa tus residuos correctamente para facilitar el reciclaje', '2025-01-15 09:00:00', 9),
('Consume productos locales y de temporada', '2025-01-16 08:00:00', 5),
('Reduce el consumo de carne para disminuir el impacto ambiental', '2025-01-17 10:00:00', 5),
('Cierra el grifo mientras te cepillas los dientes', '2025-01-18 08:00:00', 10),
('Desconecta los aparatos electrónicos que no uses', '2025-01-19 09:00:00', 6),
('Camina descalzo sobre la hierba para conectar con la naturaleza', NULL, 1),
('Participa en limpiezas de playas y parques', NULL, 7),
('Usa bolsas reutilizables para tus compras', NULL, 9),
('Comparte tus conocimientos sobre sostenibilidad con otros', NULL, 2),
('Aprovecha la luz natural durante el día', NULL, 6);

-- ============================
-- Inserción de Palabras
-- ============================
INSERT INTO Palabras (palabra, definicion, fechaProgramada) VALUES
('Resiliencia', 'Capacidad de adaptación frente a adversidades', '2025-01-10 00:00:00'),
('Biodiversidad', 'Variedad de vida en el planeta', '2025-01-11 00:00:00'),
('Empatía', 'Capacidad de comprender los sentimientos ajenos', '2025-01-12 00:00:00'),
('Sostenible', 'Que puede mantenerse sin agotar recursos', '2025-01-13 00:00:00'),
('Ecosistema', 'Comunidad de seres vivos en un ambiente', '2025-01-14 00:00:00'),
('Fotosíntesis', 'Proceso por el que las plantas producen alimento', NULL),
('Compostaje', 'Descomposición de materia orgánica', NULL),
('Renovable', 'Que puede regenerarse naturalmente', NULL),
('Eutrofización', 'Exceso de nutrientes en cuerpos de agua', NULL),
('Permacultura', 'Diseño agrícola sostenible', NULL),
('Huella', 'Impacto ambiental de actividades humanas', NULL),
('Simbiosis', 'Relación beneficiosa entre organismos', NULL),
('Cambio', 'Alteración en el clima global', NULL),
('Carbono', 'Elemento fundamental en compuestos orgánicos', NULL),
('Ozono', 'Gas que protege de la radiación ultravioleta', NULL);

-- ============================
-- Inserción de Frases
-- ============================
INSERT INTO Frases (frase, palabraFaltante, fechaProgramada) VALUES
('El cambio climático es una ____ global que nos afecta a todos', 'crisis', '2025-01-10 00:00:00'),
('La ____ es esencial para mantener el equilibrio ecológico', 'biodiversidad', '2025-01-11 00:00:00'),
('Debemos cuidar nuestros ____ naturales para las futuras generaciones', 'recursos', '2025-01-12 00:00:00'),
('La ____ de residuos ayuda a reducir la contaminación', 'reducción', '2025-01-13 00:00:00'),
('Las energías ____ son clave para un futuro sostenible', 'renovables', '2025-01-14 00:00:00'),
('El agua es un recurso ____ que debemos proteger', 'vital', NULL),
('La ____ es fundamental para entender a los demás', 'empatía', NULL),
('Plantar árboles ayuda a combatir el ____ climático', 'cambio', NULL),
('La educación ambiental es ____ para crear conciencia', 'esencial', NULL),
('Los océanos son el ____ de nuestro planeta', 'pulmón', NULL);

-- ============================
-- Inserción de Noticias
-- ============================
INSERT INTO Noticias (titulo, noticia, fechaProgramada, urlImagen) VALUES
('Nueva reserva natural en España', 'Se ha creado una nueva reserva natural en los Pirineos para proteger especies en peligro de extinción. Esta iniciativa busca preservar el hábitat de animales como el oso pardo y el quebrantahuesos.', '2025-01-10 00:00:00', 'https://example.com/reserva-natural.jpg'),
('Récord de energía solar en 2024', 'España alcanza un nuevo récord en producción de energía solar durante el último año. Las instalaciones fotovoltaicas han aumentado un 40% respecto al año anterior.', '2025-01-11 00:00:00', 'https://example.com/energia-solar.jpg'),
('Campaña de limpieza de océanos', 'Voluntarios de todo el mundo se unen para limpiar las playas y océanos. La iniciativa ha logrado retirar más de 100 toneladas de plástico en un solo fin de semana.', '2025-01-12 00:00:00', 'https://example.com/limpieza-oceanos.jpg'),
('Descubrimiento de nueva especie en el Amazonas', 'Científicos descubren una nueva especie de rana en la selva amazónica. Este hallazgo resalta la importancia de conservar estos ecosistemas únicos.', NULL, 'https://example.com/nueva-especie.jpg'),
('Ciudades apuestan por el transporte eléctrico', 'Varias ciudades europeas anuncian planes para electrificar su flota de autobuses. El objetivo es reducir las emisiones de CO2 en un 50% para 2030.', NULL, 'https://example.com/transporte-electrico.jpg');

-- ============================
-- Inserción de Partidas
-- ============================
INSERT INTO Partida (fecha, temporizador, puntuacion, intentos, idUsuario) VALUES
('2025-01-05 10:30:00', 180, 8, 3, 1),
('2025-01-05 11:15:00', 240, 10, 2, 2),
('2025-01-05 14:20:00', 150, 6, 4, 3),
('2025-01-06 09:00:00', 200, 9, 2, 1),
('2025-01-06 10:45:00', 220, 7, 3, 4),
('2025-01-06 16:30:00', 190, 8, 3, 5),
('2025-01-07 08:15:00', 210, 10, 1, 2),
('2025-01-07 12:00:00', 170, 5, 5, 6),
('2025-01-07 15:45:00', 230, 9, 2, 7),
('2025-01-08 09:30:00', 160, 6, 4, 3);

-- ============================
-- Inserción de PalabraDia
-- ============================
INSERT INTO PalabraDia (idPartida, idPalabra) VALUES
(1, 1), -- Juan jugó con "Resiliencia"
(2, 1), -- María jugó con "Resiliencia"
(3, 2), -- Carlos jugó con "Biodiversidad"
(4, 3), -- Juan jugó con "Empatía"
(5, 3), -- Ana jugó con "Empatía"
(6, 4), -- Pedro jugó con "Sostenible"
(7, 4), -- María jugó con "Sostenible"
(8, 5), -- Laura jugó con "Ecosistema"
(9, 5); -- David jugó con "Ecosistema"

-- ============================
-- Inserción de FraseDia
-- ============================
INSERT INTO FraseDia (idPartida, idFrase) VALUES
(10, 1); -- Carlos jugó con la frase del cambio climático

-- ============================
-- Inserción de Preguntas para Noticias
-- ============================
INSERT INTO Preguntas (idNoticia, nPregunta, pregunta) VALUES
(1, 1, '¿Dónde se ha creado la nueva reserva natural?'),
(1, 2, '¿Qué especies se busca proteger?'),
(2, 1, '¿En qué porcentaje han aumentado las instalaciones fotovoltaicas?'),
(2, 2, '¿Qué tipo de energía se menciona en la noticia?'),
(3, 1, '¿Cuántas toneladas de plástico se retiraron?'),
(3, 2, '¿Quiénes participaron en la campaña?'),
(4, 1, '¿Qué tipo de animal fue descubierto?'),
(4, 2, '¿Dónde se realizó el descubrimiento?'),
(5, 1, '¿Qué tipo de transporte se va a electrificar?'),
(5, 2, '¿Cuál es el objetivo de reducción de CO2?');

-- ============================
-- Inserción de Opciones para Preguntas
-- ============================
INSERT INTO Opciones (idNoticia, nPregunta, nOpcion, opcion) VALUES
-- Noticia 1, Pregunta 1
(1, 1, 1, 'En los Pirineos'),
(1, 1, 2, 'En la Sierra Nevada'),
(1, 1, 3, 'En Doñana'),
-- Noticia 1, Pregunta 2
(1, 2, 1, 'Lince ibérico y águila imperial'),
(1, 2, 2, 'Oso pardo y quebrantahuesos'),
(1, 2, 3, 'Lobo ibérico y buitre leonado'),
-- Noticia 2, Pregunta 1
(2, 1, 1, '30%'),
(2, 1, 2, '40%'),
(2, 1, 3, '50%'),
-- Noticia 2, Pregunta 2
(2, 2, 1, 'Energía eólica'),
(2, 2, 2, 'Energía solar'),
(2, 2, 3, 'Energía hidráulica'),
-- Noticia 3, Pregunta 1
(3, 1, 1, '50 toneladas'),
(3, 1, 2, '100 toneladas'),
(3, 1, 3, '150 toneladas'),
-- Noticia 3, Pregunta 2
(3, 2, 1, 'Solo científicos'),
(3, 2, 2, 'Solo gobiernos'),
(3, 2, 3, 'Voluntarios de todo el mundo'),
-- Noticia 4, Pregunta 1
(4, 1, 1, 'Una rana'),
(4, 1, 2, 'Un pájaro'),
(4, 1, 3, 'Un mamífero'),
-- Noticia 4, Pregunta 2
(4, 2, 1, 'En el Amazonas'),
(4, 2, 2, 'En África'),
(4, 2, 3, 'En Asia'),
-- Noticia 5, Pregunta 1
(5, 1, 1, 'Taxis'),
(5, 1, 2, 'Autobuses'),
(5, 1, 3, 'Trenes'),
-- Noticia 5, Pregunta 2
(5, 2, 1, '30% para 2030'),
(5, 2, 2, '50% para 2030'),
(5, 2, 3, '70% para 2030');

-- ============================
-- Inserción de Respuestas Correctas
-- ============================
INSERT INTO RespuestaCorrecta (idNoticia, nPregunta, nOpcion) VALUES
(1, 1, 1), -- En los Pirineos
(1, 2, 2), -- Oso pardo y quebrantahuesos
(2, 1, 2), -- 40%
(2, 2, 2), -- Energía solar
(3, 1, 2), -- 100 toneladas
(3, 2, 3), -- Voluntarios de todo el mundo
(4, 1, 1), -- Una rana
(4, 2, 1), -- En el Amazonas
(5, 1, 2), -- Autobuses
(5, 2, 2); -- 50% para 2030

-- ============================
-- Inserción de Pistas para Palabras
-- ============================
INSERT INTO PistasPalabras (idPalabra, pista) VALUES
(1, 'Capacidad de recuperarse tras una dificultad'),
(1, 'Se usa mucho en psicología'),
(2, 'Variedad de especies en un lugar'),
(2, 'Es fundamental para la salud del planeta'),
(3, 'Ponerse en el lugar del otro'),
(3, 'Sentimiento de comprensión'),
(4, 'Que puede durar en el tiempo'),
(4, 'No agota los recursos naturales'),
(5, 'Sistema natural de seres vivos'),
(5, 'Incluye flora, fauna y ambiente'),
(6, 'Proceso que realizan las plantas'),
(6, 'Necesita luz solar y clorofila'),
(7, 'Transformación de residuos orgánicos'),
(7, 'Sirve como fertilizante natural'),
(8, 'Recurso que se puede regenerar'),
(8, 'Como la energía solar o eólica');

-- ============================
-- Inserción de Pistas para Frases
-- ============================
INSERT INTO PistasFrase (idFrase, pista) VALUES
(1, 'Es un problema muy grave'),
(1, 'Afecta al medio ambiente'),
(2, 'Variedad de vida'),
(2, 'Es importante para el equilibrio'),
(3, 'Lo que nos da la naturaleza'),
(3, 'Puede ser agua, aire, minerales'),
(4, 'Menos es más'),
(4, 'Relacionado con basura'),
(5, 'Energía limpia'),
(5, 'Como el sol o el viento');

-- ============================
-- Inserción de Administradores
-- ============================
-- NOTA: Contraseña para todos: "admin123"
-- Hash BCRYPT: $2y$10$YourBcryptHashHere1234567890123456789012345678901234567890
INSERT INTO Administrador (nombre, correo, password) VALUES
('Admin Principal', 'admin@leafconnect.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Moderador Contenidos', 'moderador@leafconnect.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Soporte Técnico', 'soporte@leafconnect.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- ============================
-- FIN DEL SCRIPT
-- ============================
