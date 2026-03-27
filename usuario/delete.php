<?php
session_start();
//validamos que la solicitud sea metodo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {    
    header('Location: index.php');
    exist;
} else {
    //tomamos loa valores que viene por metodo ´post
    $id = $_POST['id'];
    //validamos si el valor no vienen vacio
    if (!empty($id)) {
        header('Location: index.php');
        exist;
}
//conexion a la base de datos
include('../lib/conn.php');
//eliminar el registro usando prepared statement
$stmt = $conn->prepare("DELETE FROM usuario WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

//VALIDAMOS SI SE ELIMINO Y REDIRECCIONA 
$_SESSION['mensaje'] =  "Usuario eliminado exitosamente.";  
header('Location: index.php');
exit;
}
?>