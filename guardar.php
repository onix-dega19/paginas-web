<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre = $_POST['nombre'];
    $domicilio = $_POST['domicilio'];
    $giro = $_POST['giro'];
    $razon_social = $_POST['razon_social'];

    $server = "localhost";
    $user = "root";
    $pass = "";
    $bd = "mipagina";


    $server = "sql302.infinityfree.com";
    $user = "if0_40970312";
    $pass = "jTOjh4j2U2NM";
    $bd = "if0_40970312_mipagina";

    $conexion = new mysqli($server,$user, $pass,$bd);

    if($conexion->connect_error){
        die("conwxion fallida:" .$conexion->connect_error);
    }else{
        echo "conexion exitosa";
    }

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
