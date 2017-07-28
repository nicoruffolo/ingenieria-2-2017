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
	//if (isset($_SESSION['emi'])){
		//echo $_SESSION['emi'];
	//}
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
	<a href="reputa.php"> Volver</a> 
  <?php 
     include ('conexion.php');
     $conexi=conectar();
     $id=$_GET['id'];
     $consulta="SELECT * from reputacion where id_nombre = '$id'";
     $valores=mysqli_query($conexi,$consulta);
     $i=mysqli_fetch_array($valores);
      ?>
     <h1 style="text-align: center;">Modificacion de reputacion</h1></br></br>
     <form action="modireputa.php?id=<?php echo $id;?>" method="post" enctype="multipart/form-data"> 
     	  <div class="correte">
     	  			<label >Nombre de la reputacion</br>
					<!-- pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$-->
					<input title="Falta el nombre" type="text"  name="nombre" id="nombre" size="32" value="<?php echo $i['id_nombre'];?>" required="" onkeyup="javascript:this.value=this.value.toLowerCase();"/></label> </br>

					<label for="user_login">Puntaje Minimo </br>
					<input title="Se necesita un puntaje" type="number" name="min" id="min" 
					 size="6" maxlength="6" value="<?php echo $i['puntaje_inicial'];?>" required/></label>  </br>

					<label>Puntaje Maximo(opcional) </br>
					<input title="Se necesita un puntaje" type="number" name="max" id="max" size="6" maxlength="6" placeholder="Sin puntaje maximo" value="<?php if($i['puntaje_final'] != null){echo $i['puntaje_final'];}?>"/></label> </br>

					<input type="submit" name="" value="Modificar reputacion">

			</div>

     </form>
     <?php
     if (isset($_GET['msj'])){
           echo "<h4 style='color:red'>".$_GET["msj"]."</h4>"; 
                    }
     if (isset($_GET['error'])){
           echo "<h4 style='color:red'>".$_GET["error"]."</h4>"; 
                    }
     if (isset($_GET['igual'])){
           echo "<h4 style='color:red'>".$_GET["igual"]."</h4>"; 
                    }  ?>

</body>
</html>