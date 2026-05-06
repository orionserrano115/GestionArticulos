<?php
// Configuración de conexión
$host = "mysql-trainee115.alwaysdata.net";
$user = "trainee115";   // cambia si tu usuario es distinto
$pass = "clase1234";       // coloca tu contraseña si aplica
$db   = "trainee115_gestionarticulos";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Operaciones CRUD
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $accion = $_POST["accion"];

    if ($accion === "agregar") {
        $codigo   = $_POST["codigo"];
        $nombre   = $_POST["nombre"];
        $marca    = $_POST["marca"];
        $cantidad = $_POST["cantidad"];
        $bodega   = $_POST["bodega"];

        $sql = "INSERT INTO articulos (codigo, nombre, marca, cantidad, bodega) 
                VALUES ('$codigo','$nombre','$marca','$cantidad','$bodega')";
        $conn->query($sql);
    }

    if ($accion === "editar") {
        $codigo   = $_POST["codigo"];
        $nombre   = $_POST["nombre"];
        $marca    = $_POST["marca"];
        $cantidad = $_POST["cantidad"];
        $bodega   = $_POST["bodega"];

        $sql = "UPDATE articulos 
                SET nombre='$nombre', marca='$marca', cantidad='$cantidad', bodega='$bodega' 
                WHERE codigo='$codigo'";
        $conn->query($sql);
    }

    if ($accion === "borrar") {
        $codigo = $_POST["codigo"];
        $sql = "DELETE FROM articulos WHERE codigo='$codigo'";
        $conn->query($sql);
    }
}

// Consultar artículos
$result = $conn->query("SELECT * FROM articulos");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Artículos</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f9; margin: 20px; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background: #007BFF; color: white; }
        tr:nth-child(even) { background: #f9f9f9; }
        form { margin-top: 20px; background: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 0 5px #ccc; }
        input, select { padding: 8px; margin: 5px; }
        button { padding: 8px 12px; background: #007BFF; color: white; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <h1>Gestión de Artículos</h1>

    <!-- Formulario -->
    <form id="formArticulo" method="POST">
        <input type="hidden" name="accion" id="accion" value="agregar">
        <input type="text" name="codigo" id="codigo" placeholder="Código (ID)" required>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
        <input type="text" name="marca" id="marca" placeholder="Marca" required>
        <input type="number" name="cantidad" id="cantidad" placeholder="Cantidad" required>
        <input type="text" name="bodega" id="bodega" placeholder="Bodega" required>
        <button type="submit">Guardar</button>
    </form>

    <!-- Tabla -->
    <table>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Cantidad</th>
            <th>Bodega</th>
            <th>Acciones</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row["codigo"] ?></td>
            <td><?= $row["nombre"] ?></td>
            <td><?= $row["marca"] ?></td>
            <td><?= $row["cantidad"] ?></td>
            <td><?= $row["bodega"] ?></td>
            <td>
                <button onclick="editarArticulo('<?= $row['codigo'] ?>','<?= $row['nombre'] ?>','<?= $row['marca'] ?>','<?= $row['cantidad'] ?>','<?= $row['bodega'] ?>')">Editar</button>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="accion" value="borrar">
                    <input type="hidden" name="codigo" value="<?= $row['codigo'] ?>">
                    <button type="submit">Borrar</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <script>
        function editarArticulo(codigo, nombre, marca, cantidad, bodega) {
            document.getElementById("accion").value = "editar";
            document.getElementById("codigo").value = codigo;
            document.getElementById("nombre").value = nombre;
            document.getElementById("marca").value = marca;
            document.getElementById("cantidad").value = cantidad;
            document.getElementById("bodega").value = bodega;
        }
    </script>
</body>
</html>
