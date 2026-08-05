-- Tabla contacto para el formulario de contacto
-- Ejecutar este script DESPUES de importar Base_Datos_Libreria.sql
-- en la misma base de datos (dblibreria)

USE `dblibreria`;

CREATE TABLE IF NOT EXISTS `contacto` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `fecha` DATETIME NOT NULL,
  `correo` VARCHAR(100) NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `asunto` VARCHAR(150) NOT NULL,
  `comentario` TEXT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- NOTA: el enunciado pide los campos (id, fecha, correo, correo, nombre,
-- asunto, comentario). MySQL no permite dos columnas con el mismo nombre
-- "correo" en una misma tabla, así que se asumió que fue un error de
-- tipeo en el documento y se dejó una sola columna "correo".
