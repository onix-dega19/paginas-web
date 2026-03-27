<?php
session_start();
//validamos que la solicitud sea metodo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //tomamos los valores que vienen por metodo POST
    $id = $_POST['id'];
    //validamos si el valor no viene vacio
    if (!empty($id)) {
        //conexion a la base de datos
        include('../lib/conn.php');
        //eliminar el registro usando prepared statement

        $stmt = $conexion->prepare("DELETE FROM clientesss WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        //VALIDAMOS SI SE ELIMINO Y REDIRECCIONA 
        $_SESSION['mensaje'] = "Cliente eliminado exitosamente.";
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['mensaje'] = "ID no válido.";
        header('Location: index.php');
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}
?>