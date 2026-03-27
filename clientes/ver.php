<?php
// Formulario para ver datos del cliente
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Aquí iría tu lógica de conexión a BD y obtener datos
// $cliente = obtenerClientePorId($id);
// Ejemplo de datos (reemplazar con datos reales de BD):
$cliente = [
    'id' => $id,
    'nombre' =>  '',
    'domicilio' => '',
    'giro' => '',
    'razon_social' =>''
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Cliente</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 500px; margin: 20px 0; }
        th, td { border: 1px solid #ccc; padding: 12px; text-align: left; }
        th { background-color: #f5f5f5; font-weight: bold; }
        .button-group { margin-top: 20px; }
        button { padding: 8px 15px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <h1>Ver Cliente</h1>
    
    <table>
        <tr>
            <th>Campo</th>
            <th>Valor</th>
        </tr>
        <tr>
            <td>ID</td>
            <td><?php echo htmlspecialchars($cliente['id']); ?></td>
        </tr>
        <tr>
            <td>Nombre</td>
            <td><?php echo htmlspecialchars($cliente['nombre']); ?></td>
        </tr>
        <tr>
            <td>Domicilio</td>
            <td><?php echo htmlspecialchars($cliente['domicilio']); ?></td>
        </tr>
        <tr>
            <td>Giro</td>
            <td><?php echo htmlspecialchars($cliente['giro']); ?></td>
        </tr>
        <tr>
            <td>Razón Social</td>
            <td><?php echo htmlspecialchars($cliente['razon_social']); ?></td>
        </tr>
    </table>
    
    <div class="button-group">
        <a href="index.php"><button type="button">Volver</button></a>
    </div>
</body>
</html>