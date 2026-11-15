-- ================================================================
-- DDL: Creacion de la tabla fincas
-- Asignatura: Desarrollo Web | Ejercicio N.º 4: Finca
-- Arquitectura Hexagonal con DDD y CQRS en PHP
-- ================================================================

USE crud_usuarios;

CREATE TABLE IF NOT EXISTS fincas (
    id VARCHAR(36) PRIMARY KEY,
    nombre VARCHAR(120) NOT NULL,
    num_hectareas DECIMAL(10, 2) NOT NULL,
    metros_cuadrados DECIMAL(12, 2) NOT NULL,
    propietario VARCHAR(120) NOT NULL,
    capataz VARCHAR(120) NOT NULL,
    pais VARCHAR(60) NOT NULL,
    departamento VARCHAR(60) NOT NULL,
    ciudad VARCHAR(60) NOT NULL,
    produce_leche TINYINT(1) NOT NULL DEFAULT 0,
    produce_cereales TINYINT(1) NOT NULL DEFAULT 0,
    produce_frutas TINYINT(1) NOT NULL DEFAULT 0,
    produce_verduras TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_fincas_departamento_ciudad (departamento, ciudad),
    INDEX idx_fincas_propietario (propietario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
