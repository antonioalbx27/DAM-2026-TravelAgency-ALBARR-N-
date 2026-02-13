Drop database if exists PHPViajesAntoine;
CREATE DATABASE PHPViajesAntoine;
USE PHPViajesAntoine;

CREATE TABLE viajes (
    id_viaje INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    planeta VARCHAR(150) NOT NULL,
    descripcion TEXT,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    destacado BOOLEAN DEFAULT FALSE,
    plazas INT NOT NULL,
    imagen VARCHAR(255)
);

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    apellidos VARCHAR(150) NOT NULL,
    correo VARCHAR(150) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    admin VARCHAR(2) NOT NULL DEFAULT 'NO'
);

INSERT INTO viajes (titulo, descripcion, fecha_inicio, fecha_fin, precio, destacado, plazas, imagen) VALUES
('Safari en las Dunas de Tatooine', 'Vive la experiencia de los dos soles. Incluye visita a la cantina de Mos Eisley, taller de reparación de droides y una emocionante carrera de vainas como espectador.', '2026-06-15', '2026-06-22', 1250.00, 1, 20, 'tatooine_sunset.jpg'),

('Esquí Extremo en Hoth', 'Solo para valientes. Disfruta de las pistas heladas del sistema Hoth. Incluye alquiler de Tauntaun y visita guiada a las ruinas de la Base Eco. Ropa térmica obligatoria.', '2026-12-01', '2026-12-10', 2100.50, 0, 15, 'hoth_glacier.jpg'),

('Retiro Espiritual en Dagobah', 'Desconecta de la tecnología y conecta con la Fuerza en los pantanos de Dagobah. Curso intensivo de meditación y levantamiento de piedras. Comida a base de raíces incluida.', '2026-05-10', '2026-05-20', 850.00, 0, 5, 'dagobah_swamp.jpg'),

('Lujo Real en Naboo', 'Disfruta de la arquitectura de Theed y los tranquilos lagos. Paseo en submarino Gungan y cena de gala en el Palacio Real. Ideal para lunas de miel.', '2026-07-01', '2026-07-15', 3500.00, 1, 10, 'naboo_palace.jpg'),

('Vida Nocturna en Coruscant', 'La ciudad que nunca duerme. Tour por el Distrito Uscru, entrada VIP al Club Outlander y visita panorámica al antiguo Templo Jedi. Transporte en aerotaxi incluido.', '2026-09-05', '2026-09-12', 1800.00, 1, 40, 'coruscant_lights.jpg'),

('Escapada Rural a Endor', 'Convive con la naturaleza en la luna santuario. Alojamiento en cabañas arbóreas, rutas en moto speeder y banquetes tradicionales con la tribu local.', '2026-08-10', '2026-08-17', 1450.00, 1, 25, 'endor_forest.jpg'),

('Crucero por las Nubes de Bespin', 'Hospédate en la Ciudad de las Nubes. Vistas atardecer inigualables, minería de gas Tibanna y cenas de alta cocina. Cuidado con los tratos que empeoran.', '2026-10-20', '2026-10-25', 2900.00, 0, 12, 'bespin_cloudcity.jpg'),

('Aventura Volcánica en Mustafar', 'Turismo de riesgo en estado puro. Observa los ríos de lava desde plataformas seguras y visita la fortaleza de Lord Vader. Traje ignífugo incluido en el precio.', '2026-11-01', '2026-11-05', 1600.00, 0, 8, 'mustafar_lava.jpg'),

('Expedición Wookiee en Kashyyyk', 'Explora las Tierras Sombrías y los inmensos árboles Wroshyr. Aprende sobre la historia de la batalla de Kashyyyk y la cultura de los Wookiees.', '2026-04-15', '2026-04-25', 2200.00, 0, 18, 'kashyyyk_beach.jpg'),

('Tour de Contrabandistas en Batuu', 'Visita el Borde Exterior y el puesto de avanzada Black Spire. Construye tu propio sable de luz y prueba la leche azul en la cantina de Oga. ¡Cuidado con la Primera Orden!', '2026-03-01', '2026-03-08', 1950.00, 1, 30, 'batuu_spire.jpg');

UPDATE viajes SET planeta = 'Tatooine' WHERE titulo = 'Safari en las Dunas de Tatooine';
UPDATE viajes SET planeta = 'Hoth' WHERE titulo = 'Esquí Extremo en Hoth';
UPDATE viajes SET planeta = 'Dagobah' WHERE titulo = 'Retiro Espiritual en Dagobah';
UPDATE viajes SET planeta = 'Naboo' WHERE titulo = 'Lujo Real en Naboo';
UPDATE viajes SET planeta = 'Coruscant' WHERE titulo = 'Vida Nocturna en Coruscant';
UPDATE viajes SET planeta = 'Endor' WHERE titulo = 'Escapada Rural a Endor';
UPDATE viajes SET planeta = 'Bespin' WHERE titulo = 'Crucero por las Nubes de Bespin';
UPDATE viajes SET planeta = 'Mustafar' WHERE titulo = 'Aventura Volcánica en Mustafar';
UPDATE viajes SET planeta = 'Kashyyyk' WHERE titulo = 'Expedición Wookiee en Kashyyyk';
UPDATE viajes SET planeta = 'Batuu' WHERE titulo = 'Tour de Contrabandistas en Batuu';

INSERT INTO viajes (titulo, planeta, descripcion, fecha_inicio, fecha_fin, precio, destacado, plazas, imagen) VALUES
('Safari en las Dunas', 'Tatooine', 'Vive la experiencia de los dos soles. Incluye visita a la cantina de Mos Eisley, taller de reparación de droides y una emocionante carrera de vainas.', '2026-06-15', '2026-06-22', 1250.00, 1, 20, 'tatooine_sunset.jpg'),

('Esquí Extremo en la Base Eco', 'Hoth', 'Solo para valientes. Disfruta de las pistas heladas. Incluye alquiler de Tauntaun y visita guiada a las ruinas de la antigua base rebelde.', '2026-12-01', '2026-12-10', 2100.50, 0, 15, 'hoth_glacier.jpg'),

('Retiro Espiritual Jedi', 'Dagobah', 'Desconecta de la tecnología y conecta con la Fuerza en los pantanos. Curso intensivo de meditación. Comida a base de raíces incluida.', '2026-05-10', '2026-05-20', 850.00, 0, 5, 'dagobah_swamp.jpg'),

('Lujo Real en Theed', 'Naboo', 'Disfruta de la arquitectura y los tranquilos lagos. Paseo en submarino Gungan y cena de gala en el Palacio Real.', '2026-07-01', '2026-07-15', 3500.00, 1, 10, 'naboo_palace.jpg'),

('Vida Nocturna en la Capital', 'Coruscant', 'La ciudad que nunca duerme. Tour por el Distrito Uscru, entrada VIP al Club Outlander y visita panorámica al antiguo Templo Jedi.', '2026-09-05', '2026-09-12', 1800.00, 1, 40, 'coruscant_lights.jpg'),

('Escapada Rural con Ewoks', 'Endor', 'Convive con la naturaleza en la luna santuario. Alojamiento en cabañas arbóreas y rutas en moto speeder.', '2026-08-10', '2026-08-17', 1450.00, 1, 25, 'endor_forest.jpg'),

('Crucero por las Nubes', 'Bespin', 'Hospédate en la Ciudad de las Nubes. Vistas atardecer inigualables y cenas de alta cocina. Cuidado con los tratos que empeoran.', '2026-10-20', '2026-10-25', 2900.00, 0, 12, 'bespin_cloudcity.jpg'),

('Aventura Volcánica', 'Mustafar', 'Turismo de riesgo. Observa los ríos de lava desde plataformas seguras y visita la fortaleza de Lord Vader.', '2026-11-01', '2026-11-05', 1600.00, 0, 8, 'mustafar_lava.jpg'),

('Expedición Wookiee', 'Kashyyyk', 'Explora las Tierras Sombrías y los inmensos árboles Wroshyr. Aprende sobre la cultura de los Wookiees.', '2026-04-15', '2026-04-25', 2200.00, 0, 18, 'kashyyyk_beach.jpg'),

('Tour de Contrabandistas', 'Batuu', 'Visita el puesto de avanzada Black Spire. Construye tu propio sable de luz y prueba la leche azul en la cantina de Oga.', '2026-03-01', '2026-03-08', 1950.00, 1, 30, 'batuu_spire.jpg');

INSERT INTO usuarios (nombre, apellidos, correo, contraseña, admin)
VALUES ('Antonio', 'Albarrán', 'aalbjoy2704@g.educaand.es', '12345', 'SI');