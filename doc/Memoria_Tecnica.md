# Memoria Técnica del Proyecto: ReziQuiz

## 1. Introducción
**ReziQuiz** es una aplicación web interactiva diseñada para fomentar el aprendizaje y el entretenimiento a través de juegos lingüísticos y culturales. El proyecto combina elementos lúdicos con gestión de usuarios, ofreciendo una experiencia personalizada.

Este documento describe la arquitectura, tecnologías y funcionalidades del sistema, sirviendo como manual técnico y de presentación.

## 2. Objetivos del Proyecto
- **Entretener y Educar**: Proporcionar mini-juegos diarios como "Palabra del Día", "Frase del Día" y "Noticia del Día".
- **Gestión de Progreso**: Permitir a los usuarios registrarse, iniciar sesión y guardar sus puntuaciones.
- **Administración**: Ofrecer un panel de control para que los administradores gestionen el contenido (palabras, frases, noticias).
- **Aprendizaje**: Servir como proyecto demostrativo de competencias en desarrollo web Full Stack (DAW).

## 3. Tecnologías Utilizadas

### Backend
- **Lenguaje**: PHP 8.x
- **Arquitectura**: MVC (Modelo-Vista-Controlador)
    - Separación clara de la lógica de negocio, la interfaz y el acceso a datos.

### Frontend
- **Lenguajes**: HTML5, CSS3, JavaScript (ES6+)
- **Diseño**: Responsivo y moderno sin uso excesivo de frameworks pesados, priorizando CSS nativo.
- **Comunicación**: AJAX/Fetch API para actualizaciones dinámicas sin recargar la página (SPA-feel en los juegos).

### Base de Datos
- **Motor**: MySQL / MariaDB
- **Acceso**: PHP Data Objects (PDO) para seguridad y flexibilidad.
- **Seguridad**: Sentencias preparadas para prevenir inyecciones SQL.

## 4. Estructura del Proyecto
El proyecto sigue una estructura modular para facilitar el mantenimiento:

```
src/
├── game/
│   ├── javaScript/    # Lógica del cliente (Controladores JS)
│   ├── php/
│   │   ├── controladores/ # Lógica de negocio PHP
│   │   ├── modelos/       # Acceso a Base de Datos
│   │   └── vistas/        # Interfaz de Usuario
├── admin/             # Módulo de administración
├── DOC/               # Documentación del proyecto
└── assets/            # Imágenes y estilos globales
```

## 5. Funcionalidades Principales

### 5.1 Juegos Diarios
- **Palabra del Día**: Juego de adivinanza donde el usuario debe descubrir una palabra oculta con pistas.
- **Frase del Día**: El usuario completa frases célebres o populares.
- **Noticia del Día**: Cuestionario tipo Quiz sobre actualidad.
- **Mecánicas**: Temporizador, sistema de puntuación y registro de intentos.

### 5.2 Gestión de Usuarios
- **Registro y Login**: Sistema seguro con almacenamiento de contraseñas.
- **Sesiones**: Manejo de sesiones PHP para mantener la identidad del usuario.
- **Perfil**: Visualización de estadísticas y progreso.

### 5.3 Panel de Administración
- **CRUD Completo**: Crear, Leer, Actualizar y Borrar palabras, frases y noticias.
- **Buscador**: Herramienta para localizar contenido rápidamente.

## 6. Detalles de Implementación Destacados
- **Patrón MVC en JS**: Se ha replicado el patrón MVC en el frontend para los juegos, organizando el código en Modelos (API calls), Vistas (DOM manipulation) y Controladores (Lógica del juego).
- **Optimización**: Código simplificado y limpio, evitando sobre-ingeniería innecesaria.
- **Seguridad**: Uso estricto de PDO y validación de sesiones.

## 7. Conclusión
ReziQuiz demuestra la capacidad de crear una aplicación web completa, funcional y escalable, aplicando las mejores prácticas de desarrollo aprendidas en el ciclo de Desarrollo de Aplicaciones Web.
