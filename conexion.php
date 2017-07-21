<?php
function conectar()
{
    $conexion = mysqli_connect("localhost", "root", "", "ingedos") or die(" no ingreso");
    return $conexion;
}
// retornamos la conexion aplicada 
?>
