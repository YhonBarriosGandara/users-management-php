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

## 3. Puesta en Marcha y Pruebas Locales (Nativa)

### Requisitos
- PHP 8.2+ con extensión `pdo_mysql` habilitada.
- Servidor MySQL o MariaDB en ejecución en `localhost:3306`.

### Configuración
1. Clonar el repositorio y configurar variables de entorno:
   ```bash
   cp .env.example .env
   ```
2. Inicializar la base de datos ejecutando los scripts SQL unificados:
   ```bash
   mysql -u Estudiante -pDeveloper crud_usuarios < sql/01_schema.sql
   mysql -u Estudiante -pDeveloper crud_usuarios < sql/02_seeds.sql
   ```
3. Iniciar el servidor web local con PHP:
   ```bash
   php -S localhost:8000 -t public
   ```
4. Abrir en el navegador:
   - Panel de Fincas: `http://localhost:8000/index.php?action=fincas.list`
   - Registro de Finca: `http://localhost:8000/index.php?action=fincas.create`

---

## 4. Ejecución con Docker y Docker Compose (Paso 24)

El proyecto incluye contenedores listos para producción que levantan tanto la base de datos MariaDB 10.11 como el servidor Apache con PHP 8.2 y las semillas precargadas:

```bash
# Construir y levantar los servicios en segundo plano
docker compose up -d

# Verificar estado y salud de los contenedores
docker compose ps

# Acceder a la aplicación
http://localhost:8000/index.php?action=fincas.list
```

---

## 5. Pruebas Automatizadas con Postman (Paso 23)

Se suministra una colección exportada en formato Postman v2.1 ubicada en `postman/users-management-php.postman_collection.json`.

### Endpoints cubiertos en la colección:
- **Gestión de Fincas (Ejercicio N.º 4):**
  - `GET /index.php?action=fincas.list` (Listado completo)
  - `GET /index.php?action=fincas.create` (Formulario de creación)
  - `POST /index.php?action=fincas.store` (Creación con cálculo automático de $m^2$)
  - `GET /index.php?action=fincas.show&id={id}` (Detalle técnico del predio)
  - `GET /index.php?action=fincas.edit&id={id}` (Formulario de edición)
  - `POST /index.php?action=fincas.update&id={id}` (Actualización de atributos)
  - `POST /index.php?action=fincas.delete&id={id}` (Eliminación en cascada)
- **Gestión de Usuarios:**
  - `GET /index.php?action=users.list` (Listar usuarios)
  - `POST /index.php?action=login` (Autenticación con sesión)

---

## 6. Migración de Base de Datos a la Nube (Paso 17)

Para aprovisionar y migrar la base de datos a servicios en la nube (Aiven, Render, Railway, TiDB Serverless, Clever Cloud):
1. Configurar las credenciales remotas en el archivo `.env`:
   ```env
   DB_HOST=servidor-remoto-mysql.com
   DB_PORT=3306
   DB_DATABASE=crud_usuarios
   DB_USERNAME=usuario_remoto
   DB_PASSWORD=password_remoto
   ```
2. Ejecutar el asistente de migración:
   ```bash
   chmod +x scripts/migrate_to_cloud.sh
   ./scripts/migrate_to_cloud.sh
   ```

---

## 7. Despliegue en la Nube con Render / Zeabur (Paso 25)

El repositorio incluye manifiestos de Infraestructura como Código (IaC):
- **Render (`render.yaml`):** Despliegue de servicio web en contenedor Docker con healthcheck en `/index.php?action=fincas.list`.
- **Zeabur (`zeabur.json`):** Despliegue serverless de contenedor con exposición en puerto 80.

---

## 8. Integración Continua con GitHub Actions (Paso 26)

El pipeline configurado en `.github/workflows/ci.yml` se ejecuta automáticamente en cada `push` o `pull request` realizando:
1. **Linting y Validación Sintáctica:** Verificación estricta de sintaxis con `php -l` en todos los archivos del proyecto bajo PHP 8.2.
2. **Validación de Descriptores:** Comprobación de integridad de `.env.example`, `sql/01_schema.sql` y `sql/02_seeds.sql`.
3. **Build de Contenedor Docker:** Construcción automatizada de la imagen Docker en runners de GitHub.

