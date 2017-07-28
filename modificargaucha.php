<?php
session_start();
include("conexion.php");
$conexi=conectar();
$idp = $_GET['id'];
 $idies = $_SESSION['id'];


if(isset($_POST['nombre']) and (!empty($_POST['nombre'])) and  (isset($_POST['descri'])) and (!empty($_POST['descri'])) and  (isset($_POST['ciu'])) and (!empty($_POST['ciu']))  and  (isset($_POST['cate'])) and (!empty($_POST['cate']))    ){
				
             $nombre = $_POST['nombre'];
			  $descri= $_POST['descri'];
			  $ciudad= $_POST['ciu'];
			  $cate= $_POST['cate'];
			  
			  
		 $modificar = "UPDATE  gauchada set titulo='$nombre',descripcion = '$descri',ciudad= '$ciudad',caterogia = '$cate'  where id = '" . $_GET['id'] . "' ";
		
	if (isset($_FILES["foto"]) && !empty($_FILES["foto"])){
			
			$imagen=explode('/',$_FILES['foto']['type']);
             if ($imagen[0] == 'image'){
				$img = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
               	$tipo=$imagen[1];
				$query= "UPDATE  gauchada set titulo='$nombre',descripcion = '$descri',ciudad= '$ciudad',foto='$img',tipoFoto='$tipo' ,caterogia = '$cate'  where id = '" . $_GET['id'] . "' ";
                  $resultado = mysqli_query($conexi,$query);
		   					
			}
		}
		$result= mysqli_query($conexi, $modificar);
		header("location:nomodifico.php?id=$idp");
		
}
		
else{
		header("location:detallefavor.php?id=$idp");
		}

?>