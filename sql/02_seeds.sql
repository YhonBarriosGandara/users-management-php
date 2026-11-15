-- ================================================================
-- DML UNIFICADO: Datos semilla de prueba
-- Asignatura: Desarrollo Web — Unidad 3
-- Entidades: Roles, Users y 7 Fincas Colombianas
-- ================================================================

INSERT INTO roles (id, name) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Estudiante')
ON DUPLICATE KEY UPDATE name = VALUES(name);

INSERT INTO users (id, name, email, password, role, status) VALUES
('1', 'Administrador', 'admin@crud.com', 'admin123', 'ADMIN', 'ACTIVE'),
('2', 'Operador Agrícola', 'operador@crud.com', 'operador123', 'MEMBER', 'ACTIVE')
ON DUPLICATE KEY UPDATE name = VALUES(name);

INSERT INTO fincas (
    id,
    nombre,
    num_hectareas,
    metros_cuadrados,
    propietario,
    capataz,
    pais,
    departamento,
    ciudad,
    produce_leche,
    produce_cereales,
    produce_frutas,
    produce_verduras
) VALUES
('FINCA-001', 'Finca La Esperanza', 120.50, 1205000.00, 'Roberto Gómez', 'Pedro Martínez', 'Colombia', 'Antioquia', 'Rionegro', 1, 0, 1, 0),
('FINCA-002', 'Hacienda La Primavera', 350.00, 3500000.00, 'Elena Vargas', 'Luis Morales', 'Colombia', 'Cundinamarca', 'Facatativá', 1, 1, 0, 0),
('FINCA-003', 'Villa Paraíso', 45.00, 450000.00, 'Carlos Mendoza', 'Jorge Ruiz', 'Colombia', 'Bolívar', 'Turbaco', 0, 0, 1, 1),
('FINCA-004', 'Granja San Jerónimo', 85.00, 850000.00, 'Ana Lucía Torres', 'Andrés Castro', 'Colombia', 'Boyacá', 'Duitama', 0, 1, 0, 1),
('FINCA-005', 'Agropecuaria Santa Lucía', 500.00, 5000000.00, 'Fernando Ospina', 'Héctor Jiménez', 'Colombia', 'Meta', 'Villavicencio', 1, 1, 0, 0),
('FINCA-006', 'Finca El Encanto', 60.00, 600000.00, 'Patricia Herrera', 'Nelson Ortiz', 'Colombia', 'Santander', 'San Gil', 0, 0, 1, 1),
('FINCA-007', 'Hato Ganadero Los Pinos', 220.00, 2200000.00, 'Guillermo Restrepo', 'Manuel Benítez', 'Colombia', 'Córdoba', 'Montería', 1, 0, 0, 0)
ON DUPLICATE KEY UPDATE nombre = VALUES(nombre);
