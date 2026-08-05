<?php
/**
 * Archivo de conexión a la base de datos utilizando PDO.
 * Ajusta las constantes de abajo según tu servidor (local u hosting remoto).
 */

// ==== Configuración de la base de datos ====
define('DB_HOST', 'sql311.infinityfree.com');
define('DB_NAME', 'if0_42586806_dblibreria');
define('DB_USER', 'if0_42586806');
define('DB_PASS', 'nRQsrNa3bHLJZCG');
define('DB_CHARSET', 'utf8mb4');

/**
 * Devuelve una instancia PDO conectada a la base de datos.
 * Se usa un patrón simple para no abrir múltiples conexiones.
 */
function obtenerConexion(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;

        $opciones = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $opciones);
        } catch (PDOException $e) {
            die('Error de conexión a la base de datos: ' . $e->getMessage());
        }
    }

    return $pdo;
}
