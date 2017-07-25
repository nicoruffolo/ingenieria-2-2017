<?php
	session_start();
	$mensaje[1]= "Ya existe una cuenta en este sistema con ese email";
    $error=1;
	 if (isset($_SESSION['admin']) && $_SESSION['admin']==0) {

		$_SESSION['guarda'] = "no sos un administrador";
		header("location:index.php");
	}
	if (empty($_SESSION['id'])){
		$_SESSION['fede'] = "Imposible acceder a este sitio";
		header("location:index.php");
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
  <?php
     include ('conexion.php');
     $conexi=conectar(); ?>
     <a href="panel.php"> Volver </a>
     <h1 style="text-align: center;">Alta de un nuevo administrador</h1></br></br>
     <h3>Ingrese en los campos que se muestran a continuacion los datos del administrador a dar de alta:</h3></br></br>
     <form action="agregaradmin.php" method="post" enctype="multipart/form-data"> 
     	  <div class="correte">
     	  			<label > Email del Administrador (example@algo.com)</br>
					<!-- pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$-->
					<input title="Falta correo" type="email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+.com"   name="correo" id="correo" size="32"   value="<?php if (
							$error == "Ya existe una cuenta en este sistema con ese email"){
						if(isset($_POST['correo'])){  echo $_POST['correo']; }}?>" required=""/></label> </br>

					<label for="user_login"> Nombre del Administrador </br>
					<input title="Se necesita un nombre" type="text" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" name="nombre" id="nombre" 
					value="<?php if (isset($_POST['nombre'])){ echo $_POST['nombre'];} ?>"  size="32" required/></label>  </br>

					<label> Apellido del Administrador </br>
					<input title="Falta apellido" type="text" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" name="apellido" id="apellido" size="32"   value="<?php if (isset($_POST['apellido'])){ echo $_POST['apellido'];} ?>" required=""/></label> </br>

					<input type="submit" name="" value="Enviar">

			</div>

     </form>

</body>
</html>

<?php
if(isset($_POST['apellido']) and !empty($_POST['apellido']) and  isset($_POST['nombre']) and !empty($_POST['nombre']) and  isset($_POST['correo']) and !empty($_POST['correo'])){
			 $apellido = $_POST['apellido'];
			 $nombre= $_POST['nombre'];
			 $nombreadmin= $_POST['correo'];
			 $usuarios = "SELECT * FROM usuario WHERE id_email='" . $nombreadmin . "'";
             $result = mysqli_query($conexi, $usuarios);
             $user=mysqli_fetch_array($result);
             if(sizeof($user)==0){
             		$usuarionue = "insert into usuario  (`id_email`, `clave`, `credito`, `fecha_nac`, `telefono`, `puntos`, `estado`, `nombre`, `apellido`, `calificaciones`, `rol`)  values  ('$nombreadmin', '1234','0','0000-00-00','0','0','0','$nombre','$apellido','0',1)";
             		//echo($usuarionue);
             		$resultado = mysqli_query($conexi,$usuarionue);
             		header("location:adminexitoso.php?id=$nombreadmin");
             }
             else {
             	echo ($mensaje[$error]);
             }
  
  }            