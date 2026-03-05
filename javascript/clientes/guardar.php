<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre = $_POST['nombre'];
    $domicilio = $_POST['domicilio'];
    $giro = $_POST['giro'];
    $razon_social = $_POST['razon_social'];

    include '../lib/conn.php';

    $sql = "INSERT INTO clientesss(nombre, domicilio, giro, razon_social)" .
    "VALUES ('".$nombre."', '".$domicilio."', '".$giro."', '".$razon_social."');";

    if($conexion->query($sql)== TRUE){
        $mensaje = "<br> Nuevo registro creado exitosamente";

    }else{
         $mensaje = "Error:" . $sql . "<br>" . $conexion->error;

    }
    $conexion->close();
    echo"<br><br>si se ejecuto";

    header("location: index.php?mensaje=" . urlencode($mensaje));
    exit;
}else{
    echo "Error: la pagina solo carga con POST.";
exit; 
}
