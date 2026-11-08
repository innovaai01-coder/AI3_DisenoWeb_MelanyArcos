
<?php
require_once 'conexion.php';

$mensaje = "";
$tipo = "";

$sku = "";
$nombre = "";
$categoria = "";
$precio = "";
$stock = "";
$descripcion = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $sku = trim($_POST["sku"] ?? "");
    $nombre = trim($_POST["nombre"] ?? "");
    $categoria = trim($_POST["categoria"] ?? "");
    $precio = trim($_POST["precio"] ?? "");
    $stock = trim($_POST["stock"] ?? "");
    $descripcion = trim($_POST["descripcion"] ?? "");

    if (
        !preg_match('/^[a-zA-Z0-9-]{2,32}$/', $sku) ||
        $nombre === "" || strlen($nombre) > 120 ||
        $categoria === "" || strlen($categoria) > 60 ||
        !preg_match('/^\d{1,8}(\.\d{1,2})?$/', $precio) ||
        !preg_match('/^\d{1,7}$/', $stock) ||
        strlen($descripcion) > 1000
    ) {
        $mensaje = "Revisa los datos ingresados.";
        $tipo = "error";
    } else {
        try {
            $sql = "INSERT INTO productos
                (sku, nombre, categoria, precio, stock, descripcion)
                VALUES
                (:sku, :nombre, :categoria, :precio, :stock, :descripcion)";

            $sentencia = $conexion->prepare($sql);

            $sentencia->execute([
                ":sku" => $sku,
                ":nombre" => $nombre,
                ":categoria" => $categoria,
                ":precio" => $precio,
                ":stock" => $stock,
                ":descripcion" => $descripcion
            ]);

            $mensaje = "Producto registrado correctamente.";
            $tipo = "exito";

            $sku = $nombre = $categoria = "";
            $precio = $stock = $descripcion = "";

        } catch (PDOException $error) {
            error_log($error->getMessage());
            $mensaje = $error->getCode() == "23000"
                ? "Ese codigo de producto ya existe."
                : "No se pudo guardar el producto.";
            $tipo = "error";
        }
    }
}

function limpiar($texto) {
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Registro de Productos - ECOTEC</title>

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
    max-width: 620px;
    margin: auto;
    background: white;
    padding: 35px;
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

label {
    display: block;
    margin-top: 15px;
    font-weight: bold;
}

input, textarea {
    width: 100%;
    padding: 12px;
    margin-top: 6px;
    border: 1px solid #cbd5e1;
    border-radius: 7px;
    font: inherit;
}

button {
    width: 100%;
    margin-top: 25px;
    padding: 14px;
    background: #1764c0;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background: #104a91;
}

.mensaje {
    padding: 12px;
    border-radius: 7px;
    margin-top: 18px;
}

.exito {
    background: #dcfce7;
    color: #166534;
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
<p class="subtitulo">Proyecto Diseño Web - ECOTEC</p>

<h2>Registrar nuevo producto</h2>

<?php if ($mensaje !== ""): ?>
    <div class="mensaje <?php echo $tipo; ?>">
        <?php echo limpiar($mensaje); ?>
    </div>
<?php endif; ?>

<form method="POST" action="">

<label>Codigo del producto (SKU)</label>
<input type="text" name="sku" required
       minlength="2" maxlength="32"
       pattern="[a-zA-Z0-9-]+"
       value="<?php echo limpiar($sku); ?>">

<label>Nombre del producto</label>
<input type="text" name="nombre" required
       maxlength="120"
       value="<?php echo limpiar($nombre); ?>">

<label>Categoria</label>
<input type="text" name="categoria" required
       maxlength="60"
       value="<?php echo limpiar($categoria); ?>">

<label>Precio ($)</label>
<input type="number" name="precio" required
       min="0" max="99999999.99" step="0.01"
       value="<?php echo limpiar($precio); ?>">

<label>Cantidad disponible</label>
<input type="number" name="stock" required
       min="0" max="9999999" step="1"
       value="<?php echo limpiar($stock); ?>">

<label>Descripcion</label>
<textarea name="descripcion" maxlength="1000"
          rows="3"><?php echo limpiar($descripcion); ?></textarea>

<button type="submit">Guardar producto</button>

</form>
</div>
</body>
</html>
