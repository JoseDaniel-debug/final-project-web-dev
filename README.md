# Librería Online — Proyecto Final (Programación Web / ITLA)

Portal web en PHP + PDO + Bootstrap 5 que muestra el catálogo de libros y
autores de la base de datos `dblibreria`, y permite enviar mensajes a
través de un formulario de contacto.

## 📁 Estructura del proyecto

```
proyecto_libreria/
├── config/
│   └── conexion.php        # Conexión PDO a la base de datos
├── includes/
│   ├── header.php          # Navbar + apertura de HTML (Bootstrap)
│   └── footer.php          # Cierre de HTML + scripts
├── css/
│   └── style.css           # Estilos propios
├── js/
│   └── script.js           # Validaciones y buscador con JavaScript
├── sql/
│   ├── Base_Datos_Libreria.sql   # Base de datos original proporcionada
│   └── tabla_contacto.sql        # Script para crear la tabla "contacto"
├── index.php                # Página de inicio (resumen)
├── libros.php                # Listado de libros (con filtro y buscador)
├── autores.php                # Listado de autores
└── contacto.php              # Formulario de contacto (POST -> tabla contacto)
```

## 🚀 Instalación local (XAMPP / Laragon / WAMP)

1. **Base de datos**
   - Abre phpMyAdmin y crea una base de datos llamada `dblibreria`.
   - Importa el archivo `sql/Base_Datos_Libreria.sql` (pestaña *Importar*).
   - Luego importa (o ejecuta en la pestaña SQL) el archivo
     `sql/tabla_contacto.sql` para crear la tabla `contacto`.

2. **Archivos del proyecto**
   - Copia la carpeta `proyecto_libreria` dentro de tu carpeta de
     servidor local, por ejemplo:
     - XAMPP: `C:\xampp\htdocs\proyecto_libreria`
     - Laragon: `C:\laragon\www\proyecto_libreria`

3. **Configurar la conexión**
   - Abre `config/conexion.php` y ajusta si es necesario:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_NAME', 'dblibreria');
     define('DB_USER', 'root');
     define('DB_PASS', '');       // en XAMPP normalmente vacío
     ```

4. **Ejecutar**
   - Enciende Apache y MySQL desde el panel de XAMPP/Laragon.
   - Visita: `http://localhost/proyecto_libreria/index.php`

## ☁️ Publicar en un hosting/servidor remoto gratuito

El enunciado pide publicarlo en un servidor gratuito **distinto a Replit
o CodeSandbox** (ambos no soportan bien PHP + MySQL persistente). Algunas
opciones gratuitas que sí soportan PHP + MySQL:

- **InfinityFree** (infinityfree.net) — hosting gratuito con PHP y MySQL.
- **000webhost** (000webhost.com)
- **Somee.com** u otro hosting compartido gratuito con soporte PHP/MySQL.

Pasos generales:
1. Crea una cuenta y un sitio nuevo en el hosting elegido.
2. Crea una base de datos MySQL desde su panel (cPanel / panel propio) y
   anota host, nombre de la BD, usuario y contraseña que te asignen.
3. Entra a phpMyAdmin del hosting e importa `Base_Datos_Libreria.sql` y
   `tabla_contacto.sql`.
4. Actualiza las constantes en `config/conexion.php` con los datos que
   te dio el hosting (host, nombre BD, usuario, contraseña).
5. Sube todos los archivos del proyecto vía FTP o el administrador de
   archivos del panel, dentro de la carpeta pública (`public_html` o
   similar).
6. Visita la URL pública que te asignó el hosting.

## 📤 Subir el código fuente a GitHub

1. Crea un repositorio nuevo en GitHub (público).
2. Desde la carpeta del proyecto:
   ```bash
   git init
   git add .
   git commit -m "Proyecto final - Librería Online"
   git branch -M main
   git remote add origin https://github.com/TU_USUARIO/TU_REPOSITORIO.git
   git push -u origin main
   ```
3. Comparte el link del repositorio para la revisión del código fuente.

## ✅ Requisitos cubiertos

- [x] Importación de la base de datos "Librería".
- [x] Plantilla Bootstrap 5 (vía CDN).
- [x] Portal completamente en español.
- [x] Página con listado de libros (`libros.php`).
- [x] Página con listado de autores (`autores.php`).
- [x] Página con formulario de contacto (`contacto.php`).
- [x] Tabla `contacto` (id, fecha, correo, nombre, asunto, comentario).
- [x] Datos del formulario almacenados en la tabla `contacto`.
- [x] Todas las conexiones y consultas hechas con **PDO**.
- [x] CSS y JavaScript propios aplicados.
- [x] Uso de `GET` (filtro de categoría en libros) y `POST` (formulario
      de contacto).
- [x] Uso de `foreach`, `count()` y `sizeof()`.

> **Nota sobre la tabla `contacto`:** el enunciado lista los campos como
> `(id, fecha, correo, correo, nombre, asunto, comentario)`, con
> "correo" repetido dos veces. Como MySQL no permite dos columnas con el
> mismo nombre en una tabla, se asumió que fue un error de tipeo en el
> documento y se dejó una sola columna `correo`.
