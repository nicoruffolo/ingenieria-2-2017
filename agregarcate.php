<?php
	session_start();
	 if (isset($_SESSION['admin']) && $_SESSION['admin']==0) {

		$_SESSION['guarda'] = "no sos un administrador";
		header("location:index.php");
	}
	if (empty($_SESSION['id'])){
		$_SESSION['fede'] = "Imposible acceder a este sitio";
		header("location:index.php");
	}
	if (isset($_SESSION['emi'])){
		echo $_SESSION['emi'];
	}
	?>
	<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Una Gauchada</title>
	<img src="imagenes/mari.png">
    
	<meta name="viewport" content="">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="estilis.css">
</head>
<body> 
<h1 style="text-align: center;">Agregue una nueva categoria:</h1></br>
<a href="catego.php">Volver </a> </br> 
	
	<form action="altadecate.php" method="post">   <h4> Nueva categoria: </br>	<input type="text" name="cate" value="" pattern="[a-z]+" style="text-transform:lowercase;" required=""  pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" onkeyup="javascript:this.value=this.value.toLowerCase();" onClick="nospaces();">  </h4> </br>
		<input type="submit" name="enviar">
   </form> <?php
   if (isset($_GET['nada'])){
        echo "<h4 style='color:red'>".$_GET["nada"]."</h4>"; 
    }
    ?>
   <script type="text/javascript"> 
function nospaces(){ 
orig=document.form2.text2.value; 
nuev=orig.split(' '); 
nuev=nuev.join(''); 
document.form2.text2.value=nuev; 
if(nuev=orig.split(' ').length>=2) confirm('Se han eliminido espacios'); 
} 
</script>
    