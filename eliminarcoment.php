<?php
session_start();
include("conexion.php");
$conexi=conectar();
$idcomentario = $_GET['id'];
$idgauchada= $_GET['valor2'];
$modificar = "UPDATE comentarios set estado = 1 where id_comentario = $idcomentario";
$okey = mysqli_query($conexi, $modificar);
header("location:comenteliminado.php?id=$idgauchada");


?>