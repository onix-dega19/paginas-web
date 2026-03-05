<?php
$server = "localhost";
    $user = "root";
    $pass = "";
    $bd = "mipagina";

    //$server = "sql302.infinityfree.com";
    //$user = "if0_40970312";
    //$pass = "jTOjh4j2U2NM";
    //$bd = "if0_40970312_mipagina";

    $conexion = new mysqli($server,$user, $pass,$bd);

    if($conexion->connect_error){
        die("conexion fallida:" .$conexion->connect_error);
    }else{
        echo "conexion exitosa";
    }
