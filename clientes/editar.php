<?php
session_start();

// Verificar que el usuario esté autenticado
//if (!isset($_SESSION['usuario'])) {
  //  header('Location: ../index.php');
    //exit;
//}

$cliente_id = $_GET['id'] ?? null;
// Incluir conexión a la base de datos
require_once '../lib/conn.php';


// Obtener datos del usuario

    $stmt = $conexion->prepare("SELECT * FROM clientesss WHERE id = ?");
    $stmt->bind_param('i', $cliente_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $cliente = $result->fetch_assoc();

if (!$cliente){
header('Location: index.php');
exit;
}

// Procesar formulario de actualización
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $domicilio = $_POST['domicilio'];
    $giro = $_POST['giro'];
    $razon_social = $_POST['razon_social'];

    // Validar campos
    if (empty($nombre) || empty($domicilio)) {
        $mensaje = 'El nombre y domicilio son requeridos';
        $tipo_mensaje = 'error';
    } else {
            $stmt = $conexion->prepare("UPDATE clientesss SET nombre = ?, domicilio = ?, giro = ?, razon_social = ? WHERE id = ?");
            $stmt->bind_param('ssssii', $nombre, $domicilio, $giro, $razon_social, $id);
        }

        if ($stmt->execute()) {
            $mensaje = 'Usuario actualizado correctamente';
            $tipo_mensaje = 'exito';
            // Recargar datos del usuario
            $stmt = $conexion->prepare("SELECT id, nombre, giro, razon_social FROM clientesss WHERE id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $usuario = $resultado->fetch_assoc();
        } else {
            $mensaje = 'Error al actualizar el usuario';
            $tipo_mensaje = 'error';
        }
        $stmt->close();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
        .contenedor { max-width: 500px; margin: 50px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #333; margin-bottom: 20px; text-align: center; }
        .formulario { display: flex; flex-direction: column; gap: 15px; }
        label { font-weight: bold; color: #555; }
        input, select { padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; }
        input:focus, select:focus { outline: none; border-color: #007bff; box-shadow: 0 0 5px rgba(0,123,255,0.3); }
        .botones { display: flex; gap: 10px; justify-content: center; }
        button { padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
        .btn-guardar { background: #28a745; color: white; }
        .btn-guardar:hover { background: #218838; }
        .btn-cancelar { background: #6c757d; color: white; text-decoration: none; text-align: center; }
        .btn-cancelar:hover { background: #5a6268; }
        .mensaje { padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .mensaje.exito { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .mensaje.error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="contenedor">
        <h1>Editar Cliente</h1>

        <?php if ($cliente): ?>
            <form method="POST" action = "update.php">
                <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">

                <div>
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($cliente['nombre']); ?>" required>
                </div>

                <div>
                    <label for="domicilio">Domicilio:</label>
                    <input type="text" id="domicilio" name="domicilio" value="<?php echo htmlspecialchars($cliente['domicilio']); ?>" required>
                </div>

                <div>
                    <label for="giro">Giro:</label>
                    <input type="text" id="giro" name="giro" value="<?php echo htmlspecialchars($cliente['giro']); ?>" required>
                </div>

                <div>
                    <label for="razon_social">Razon Social:</label>
                    <input type="text" id="razon_social" name="razon_social" value="<?php echo htmlspecialchars($cliente['razon_social']); ?>" required>
                </div>
                </div>

                <div class="botones">
                    <button type="submit" class="btn-guardar">Guardar Cambios</button>
                    <a href="index.php" class="btn-cancelar">Cancelar</a>
                </div>
            </form>
        <?php else: ?>
            <p style="text-align: center; color: #999;">cliente no encontrado</p>
        <?php endif; ?>
    </div>
</body>
</html>