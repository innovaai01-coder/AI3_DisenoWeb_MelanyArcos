
<?php
require_once 'conexion.php';

$productos = [];
$errorConsulta = false;

try {
    $sql = "SELECT id, sku, nombre, categoria,
                   precio, stock, descripcion,
                   fecha_creacion
            FROM productos
            ORDER BY id DESC";

    $sentencia = $conexion->prepare($sql);
    $sentencia->execute();

    $productos = $sentencia->fetchAll(
        PDO::FETCH_ASSOC
    );

} catch (PDOException $error) {
    error_log($error->getMessage());
    $errorConsulta = true;
}

function limpiar($valor) {
    return htmlspecialchars(
        (string)($valor ?? ''),
        ENT_QUOTES,
        'UTF-8'
    );
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, initial-scale=1">

<title>Productos Registrados - ECOTEC</title>

<style>
* {
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background: #eef2f7;
    margin: 0;
    padding: 30px 15px;
}

.contenedor {
    max-width: 1100px;
    margin: auto;
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 5px 20px #00000015;
}

h1 {
    text-align: center;
    color: #17365d;
}

.subtitulo {
    text-align: center;
    color: #64748b;
}

.boton {
    display: inline-block;
    background: #1764c0;
    color: white;
    padding: 12px 20px;
    margin: 20px 0;
    text-decoration: none;
    border-radius: 8px;
}

.boton:hover {
    background: #104a91;
}

.tabla-responsive {
    width: 100%;
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    min-width: 800px;
}

th {
    background: #17365d;
    color: white;
    padding: 14px;
    text-align: left;
}

td {
    padding: 12px;
    border-bottom: 1px solid #e2e8f0;
}

tr:nth-child(even) {
    background: #f8fafc;
}

tr:hover {
    background: #eaf2ff;
}

.mensaje {
    padding: 15px;
    background: #f1f5f9;
    border-radius: 8px;
    margin-top: 20px;
}

.error {
    background: #fee2e2;
    color: #991b1b;
}
</style>
</head>

<body>

<div class="contenedor">

<h1>Sistema de Inventario</h1>

<p class="subtitulo">
Proyecto de Diseño Web - ECOTEC
</p>

<h2>Listado de Productos Registrados</h2>

<a class="boton" href="registro.php">
    + Registrar nuevo producto
</a>

<?php if ($errorConsulta): ?>

    <div class="mensaje error">
        No se pudieron consultar los productos.
    </div>

<?php elseif (count($productos) === 0): ?>

    <div class="mensaje">
        Todavia no hay productos registrados.
    </div>

<?php else: ?>

<div class="tabla-responsive">
<table>

<thead>
<tr>
    <th>ID</th>
    <th>Codigo</th>
    <th>Producto</th>
    <th>Categoria</th>
    <th>Precio</th>
    <th>Stock</th>
    <th>Descripcion</th>
    <th>Fecha de registro</th>
</tr>
</thead>

<tbody>

<?php foreach ($productos as $producto): ?>

<tr>
    <td><?= limpiar($producto['id']) ?></td>

    <td><?= limpiar($producto['sku']) ?></td>

    <td><?= limpiar($producto['nombre']) ?></td>

    <td><?= limpiar($producto['categoria']) ?></td>

    <td>
        $<?= number_format(
            (float)$producto['precio'], 2
        ) ?>
    </td>

    <td><?= limpiar($producto['stock']) ?></td>

    <td><?= limpiar($producto['descripcion']) ?></td>

    <td>
        <?= limpiar($producto['fecha_creacion']) ?>
    </td>
</tr>

<?php endforeach; ?>

</tbody>
</table>
</div>

<?php endif; ?>

</div>

</body>
</html>
