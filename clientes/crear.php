<?php
session_start();

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $domicilio = isset($_POST['domicilio']) ? trim($_POST['domicilio']) : '';
    $giro = isset($_POST['giro']) ? trim($_POST['giro']) : '';
    $razon_social = isset($_POST['razon_social']) ? trim($_POST['razon_social']) : '';

    //validaciones campos vacios
    if(empty($nombre) || empty($domicilio) || empty($giro) || empty($razon_social)){
        $mensaje = "Todos los campos son obligatorios.";
    } else {
        // Insertar nuevo usuario en la base de datos
        // Incluir archivo de conexión a base de datos
        include 'conexion.php'; // Asegúrate de tener este archivo configurado
        
        $sql = "INSERT INTO clientesss (nombre, domicilio, giro, razon_social) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssss", $nombre, $domicilio, $giro, $razon_social);

        if ($stmt->execute()) {
            $mensaje = "Cliente creado exitosamente.";
            $stmt->close();
        } else {
            $mensaje = "Error al crear el cliente: " . $conexion->error;
            $stmt->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Clientes</title>
</head>
<body>
    <h1>Registro de clientes</h1>
    <form action="" method="post">
        <table border="1">
            <tr>
                <td>Nombre:</td>
                <td><input type="text" name="nombre" id="nombre" required></td>
            </tr>
            <tr>
                <td>Domicilio:</td>
                <td><input type="text" name="domicilio" id="domicilio" required></td>
            </tr>
            <tr>
                <td>Giro:</td>
                <td><input type="text" name="giro" id="giro" required></td>
            </tr>
            <tr>
                <td>Razon social:</td>
                <td><input type="text" name="razon_social" id="razon_social" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <input type="submit" value="guardar cliente">
                </td>
            </tr>
        </table>
    </form>
    <?php
    if(!empty($mensaje)){
        echo "<p>" . htmlspecialchars($mensaje) . "</p>";
    }
    ?>
</body>
</html>
