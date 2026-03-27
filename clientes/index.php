<?php
session_start();

require_once '../lib/conn.php';

// Obtener usuarios de la base de datos
$sql = "SELECT * FROM clientesss ORDER BY id DESC";
$result = $conexion->query($sql);
$clientes = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 30px;
        }
        h1 {
            color: #333;
            margin-bottom: 30px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 15px;
        }
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .btn-nuevo {
            background-color: #28a745;
            color: white;
        }
        .btn-nuevo:hover {
            background-color: #218838;
            color: white;
        }
        .tabla-usuarios {
            font-size: 0.95rem;
        }
        .tabla-usuarios thead {
            background-color: #007bff;
            color: white;
        }
        .tabla-usuarios tbody tr:hover {
            background-color: #f5f5f5;
        }
        .acciones {
            display: flex;
            gap: 5px;
            justify-content: center;
        }
        .btn-sm {
            padding: 0.4rem 0.6rem;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-section">
            <h1><i class="fas fa-users"></i> Listado de clientes</h1>
            <a href="crear.php" class="btn btn-nuevo">
                <i class="fas fa-plus"></i> Nuevo Cliente
            </a>
        </div>

        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($_SESSION['mensaje']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; 
            unset($_SESSION['mensaje']);
        ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($_GET['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (count($clientes) > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover tabla-usuarios">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>domicilio</th>
                            <th>Giro</th>
                            <th>Razón Social</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes as $cliente): ?>
                            <tr>
                                <td><?php echo $cliente['id']; ?></td>
                                <td><?php echo htmlspecialchars($cliente['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['domicilio']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['giro']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['razon_social']); ?></td>
                                <td>
                                    <div class="acciones">
                                        <a href="ver.php?id=<?php echo $cliente['id']; ?>" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="editar.php?id=<?php echo $cliente['id']; ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="delete.php" 
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?');">
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                ><i class="fas fa-trash"></i></button>
                                            <input id="id" name="id" type="hidden" 
                                                value="<?php echo $cliente['id']; ?>">
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> No hay clientes registrados
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>