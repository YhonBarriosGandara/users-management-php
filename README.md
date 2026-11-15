# Sistema de Gestión de Usuarios y Fincas (Ejercicio N.º 4)

**Asignatura:** Desarrollo Web | **Unidad 3**  
**Estudiante:** Yhon Barrios Gándara (`ybarriosg@unicartagena.edu.co`)  
**Institución:** Universidad de Cartagena — Centro de Tecnologías para la Educación Virtual (CTEV)  
**Entidad Asignada:** Ejercicio N.º 4 — **Finca** (12 atributos de negocio) + Entidad común **Usuario**  
**Patrón Arquitectural:** Arquitectura Hexagonal (Ports & Adapters), Domain-Driven Design (DDD) y CQRS en PHP puro  

---

## 1. Descripción del Proyecto

Aplicación web empresarial desarrollada en **PHP 8.3+** sobre arquitectura de software moderna desacoplada del framework, aplicando los principios de:
- **Domain-Driven Design (DDD):** Modelado táctico desde el dominio hacia afuera, encapsulando reglas en Value Objects inmutables, constructores nombrados y eventos de dominio.
- **Arquitectura Hexagonal (Puertos y Adaptadores):** Separación estricta de capas (`Domain`, `Application`, `Infrastructure`, `Entrypoints` y `Common`), garantizando el Principio de Inversión de Dependencias (DIP).
- **CQRS (Command Query Responsibility Segregation):** Segregación clara entre operaciones de escritura (Commands) y operaciones de lectura (Queries).
- **Entidades Implementadas:**
  1. **Usuario:** Gestión completa, autenticación basada en sesiones y recuperación de contraseñas.
  2. **Finca (Ejercicio 4):** Gestión integral de propiedades agropecuarias con sus 12 atributos oficiales:
     - `nombre` (string)
     - `numHectareas` (decimal)
     - `metrosCuadrados` (decimal, cálculo automático $1\text{ ha} = 10,000\text{ m}^2$)
     - `propietario` (string)
     - `capataz` (string)
     - `pais` (string)
     - `departamento` (string)
     - `ciudad` (string)
     - `produceLeche` (boolean)
     - `produceCereales` (boolean)
     - `produceFrutas` (boolean)
     - `produceVerduras` (boolean)

---

## 2. Estructura Arquitectural del Proyecto

```
users-management-php/
├── Domain/                                 # Capa de Dominio (Reglas de Negocio Puras)
│   ├── Events/                             # Eventos de dominio (FincaCreated, Updated, Deleted)
│   ├── Exceptions/                         # Excepciones de negocio (FincaNotFound, InvalidFincaData)
│   ├── Models/                             # Modelos inmutables (FincaModel, UserModel)
│   └── ValueObjects/                       # Value Objects (FincaId, FincaNombre, FincaSuperficie, etc.)
│
├── Application/                            # Capa de Aplicación (Casos de Uso)
│   ├── Ports/
│   │   ├── In/                             # Puertos de Entrada (CreateFincaUseCase, etc.)
│   │   └── Out/                            # Puertos de Salida (SaveFincaPort, GetFincaByIdPort, etc.)
│   └── Services/
│       ├── Dto/
│       │   ├── Commands/                   # Comandos de escritura (CreateFincaCommand, etc.)
│       │   └── Queries/                    # Consultas de lectura (GetFincaByIdQuery, etc.)
│       ├── Mappers/                        # FincaApplicationMapper
│       └── CreateFincaService.php          # Servicios que orquestan los casos de uso
│
├── Infrastructure/                         # Capa de Infraestructura (Implementaciones Tecnológicas)
│   ├── Adapters/
│   │   └── Persistence/MySQL/              # Adaptador MySQL con PDO y Prepared Statements
│   │       ├── Database/                   # Scripts DDL (fincas.sql) y Semilla (fincas_seed.sql)
│   │       ├── Dto/                        # FincaPersistenceDto
│   │       ├── Entity/                     # FincaEntity
│   │       ├── Mapper/                     # FincaPersistenceMapper
│   │       └── Repository/                 # FincaRepositoryMySQL
│   └── Entrypoints/Web/                    # Adaptadores de Entrada (Controladores y Presentación)
│       ├── Controllers/                    # FincaController, DTOs de Request y Response
│       └── Presentation/Views/             # Vistas HTML/PHP (fincas/list, create, edit, show)
│
├── Common/                                 # Lógica transversal
│   ├── ClassLoader.php                     # Autoloader estricto sin dependencias externas
│   ├── DependencyInjection.php             # Contenedor de Inversión de Control (IoC)
│   └── EnvLoader.php                       # Lector de variables de entorno (.env)
│
└── public/
    └── index.php                           # Front Controller y Enrutador del Sistema
```

---

## 3. Puesta en Marcha y Pruebas Locales

### Requisitos
- PHP 8.2+ con extensión `pdo_mysql` habilitada.
- Servidor MySQL o MariaDB en ejecución en `localhost:3306`.

### Configuración
1. Clonar el repositorio y configurar variables de entorno:
   ```bash
   cp .env.example .env
   ```
2. Inicializar la base de datos ejecutando los scripts SQL:
   ```bash
   mysql -u Estudiante -pDeveloper crud_usuarios < Infrastructure/Adapters/Persistence/MySQL/Database/fincas.sql
   mysql -u Estudiante -pDeveloper crud_usuarios < Infrastructure/Adapters/Persistence/MySQL/Database/fincas_seed.sql
   ```
3. Iniciar el servidor web local con PHP:
   ```bash
   php -S localhost:8000 -t public
   ```
4. Abrir en el navegador:
   - Panel de Fincas: `http://localhost:8000/?route=fincas.index`
   - Registro de Finca: `http://localhost:8000/?route=fincas.create`
