-- ================================================================
-- DDL UNIFICADO: Esquema relacional para MySQL / MariaDB
-- Asignatura: Desarrollo Web — Unidad 3
-- Entidades: Roles, Users y Fincas (Ejercicio N.º 4)
-- Compatible con entornos locales, contenedores Docker y Nube
-- ================================================================

CREATE TABLE IF NOT EXISTS roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS users (
    id VARCHAR(50) NOT NULL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) DEFAULT 'MEMBER',
    status VARCHAR(50) DEFAULT 'ACTIVE',
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS fincas (
    id VARCHAR(36) NOT NULL PRIMARY KEY,
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
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_fincas_departamento_ciudad (departamento, ciudad),
    INDEX idx_fincas_propietario (propietario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
