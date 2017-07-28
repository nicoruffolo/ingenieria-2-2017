<?php
session_start();
include("conexion.php");
$conexi=conectar();
$comentario = $_GET['id'];
$idgauchada= $_GET['valor3'];
if(isset($_POST['respuesta']) and (!empty($_POST['respuesta'])) ){
				
             $respuesta = $_POST['respuesta']; 
            
			  
		 $modificar = "UPDATE  comentarios set respuesta='$respuesta'  where id_comentario = '" . $_GET['id'] . "' ";
		 $result= mysqli_query($conexi, $modificar);
		 $aux= "SELECT * from comentarios  where id_comentario = '" . $_GET['id'] . "' ";
		 $result = mysqli_query($conexi,$aux);
		 $a=mysqli_fetch_array($result);
		  header("location:respuestaexitosa.php?id=$idgauchada");	
		//header("location:detallefavor.php?id=<?php echo $a ['gauchada_id'];
}
		
else{
		header("location:index.php");
		}

?>