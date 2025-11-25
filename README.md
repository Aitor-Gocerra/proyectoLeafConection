# LeafConection

**LeafConection** es un juego educativo de palabras, frases y contribuciones de usuarios, desarrollado con **PHP** (backend) y **JavaScript** (frontend).  
El proyecto incluye un **panel de administración** para moderar contenido, usuarios y gestionar el juego.

## Estructura del proyecto
/reciquiz
│
├── /api ← Backend PHP (controladores, modelos, rutas)
├── /frontend ← Área pública (jugadores)
├── /administracion ← Panel del administrador
├── /scripts ← Scripts automáticos (CRON)
└── README.md


**Ramas principales en Git:**

- `development` ← rama principal de integración  
- `feature/nombre` ← ramas individuales por cada desarrollador  
- `main` ← producción (solo versiones estables)

## Características

### Área pública (jugadores)
- Registro e inicio de sesión de usuarios
- Juegos de palabras, frases y contribuciones
- Ranking y estadísticas
- Gestión de amigos y socialización
- Sistema de puntuaciones y progreso

### Panel de administración
- CRUD de palabras, frases y noticias
- Moderación de usuarios y contribuciones
- Dashboard con métricas y reportes
- Ajustes del juego

### Seguridad
- Middleware de autenticación y roles
- Control de acceso para administradores
- Validación y sanitización de datos

## Tecnologías

- **Backend:** PHP, MySQL  
- **Frontend:** HTML, CSS, JavaScript (modular)  
- **Control de versiones:** Git, GitHub  
- **Automatización:** Scripts CRON para tareas periódicas  
git clone https://github.com/tu-usuario/reciquiz.git
cd reciquiz
