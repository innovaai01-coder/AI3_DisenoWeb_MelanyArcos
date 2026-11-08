
<?php
// Conexion segura a MySQL utilizando PDO

$servidor = getenv('DB_HOST') ?: 'localhost';
$base_datos = getenv('DB_NAME') ?: 'db_sistema_web';
$usuario = getenv('DB_USER') ?: 'root';
$contrasena = getenv('DB_PASS');

if ($contrasena === false) {
    $contrasena = '';
}

try {
    $conexion = new PDO(
        "mysql:host=$servidor;dbname=$base_datos;charset=utf8mb4",
        $usuario,
        $contrasena
    );

    $conexion->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    $conexion->setAttribute(
        PDO::ATTR_EMULATE_PREPARES,
        false
    );

} catch (PDOException $error) {
    error_log($error->getMessage());
    http_response_code(500);
    die("No se pudo conectar a la base de datos.");
}
