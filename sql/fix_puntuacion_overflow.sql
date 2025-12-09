
-- Fix puntuacion overflow
ALTER TABLE Partida MODIFY COLUMN puntuacion SMALLINT UNSIGNED NOT NULL;
