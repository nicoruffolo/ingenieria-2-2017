<?php
 session_start();
 $mensaje[1]= "Ya existe una cuenta de usuario con ese email";
 $error=1;
?>
<!DOCTYPE html>
<html>
<head>
	<title> Una Gauchada</title>
	<img src="imagenes/mari.png">
	<link href="estilis.css" rel="stylesheet">
	<script src="javaa.js"></script>
</head>
<body>
     <div style="text-align: left;">
     	<a href="index.php" > volver </a>
     </div>
     <form action="registro.php" method="post" enctype="multipart/form-data"> 
     	  <div class="correte">
					<label for="user_login" > Nombre </br>
					<input title="Se necesita un nombre" type="text" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" name="nombre" id="nombre" 
					value="<?php if (isset($_POST['nombre'])){ echo $_POST['nombre'];} ?>"  size="32" required/></label>  </br>

					<label  > Apellido </br>
					<input title="Falta apellido" type="text" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" name="apellido" id="apellido" size="32"   value="<?php if (isset($_POST['apellido'])){ echo $_POST['apellido'];} ?>"             required=""/></label> </br>

					<label  >Clave </br>
					<input title="Falta la clave" type="password" name="pass" id="pass"  size="32" required=" "/></label> </br>


					<label > Email (example@algo.com)</br>
					<!-- pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$-->
					<input title="Falta correo" type="email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+.com"   name="correo" id="correo" size="32" onkeyup="javascript:this.value=this.value.toLowerCase();"   value="<?php if (
							$error == "Ya existe una cuenta de usuario con ese email"){
						if(isset($_POST['correo'])){  echo $_POST['correo']; }}?>"         required=""/></label> </br>

					<label  > Domicilio </br>
					<input title="Falta ciudad" type="text" name="ciudad" id="ciudad"   value="<?php if (isset($_POST['ciudad'])){ echo $_POST['ciudad'];} ?>"    size="32" required=""/></label>  </br>

					<label  >Telefono</br>
					<input title="Falta el numero de telefono " type="number" name="numero" id="numero"   value="<?php if (isset($_POST['numero'])){ echo $_POST['numero'];} ?>"     onKeypress="if (event.keyCode < 48 || event.keyCode > 57 ) event.returnValue = false;" size="32" required=" "/></label> </br>
					
					

				    <label  >Fecha de nacimiento </br>
					<input title="Falta la fecha " type="date" name="fech" id="fech" size="32" min="1940-01-01"  max="2016-12-31"   value="<?php if (isset($_POST['fech'])){ echo $_POST['fech'];} ?>"    required=" "/></label> </br> 

					 <label>Imagen </label> </br>
           			 <input type="file" name="imagen" id="imagen" accept="image/*"/> </br>

					<input type="submit" name="" value="Enviar">
					  <?php if (isset($_GET["repetido"])) {
                    echo "<h4 style='color:red'>".$_GET["repetido"]."</h4>"; 
                   }
                   ?>
				
			</div>

     </form>

</body>
</html>



<?php
   include ("conexion.php");
            $conexi = conectar();
            
             if(isset($_POST['apellido']) and !empty($_POST['apellido']) and  isset($_POST['nombre']) and !empty($_POST['nombre']) and  isset($_POST['ciudad']) and !empty($_POST['ciudad'])  and  isset($_POST['pass']) and !empty($_POST['pass']) and  isset($_POST['numero']) and !empty($_POST['numero'])  and  isset($_POST['fech']) and !empty($_POST['fech']) and  isset($_POST['correo']) and !empty($_POST['correo'])    ){
           // $test=mysqli_fetch_assoc(mysqli_query($conexi,"SELECT count(*) from usuario where id_email='".$_POST['correo']."'"));
           // exit(var_export($test));
              $apellido = $_POST['apellido'];
			  $nombre= $_POST['nombre'];
			  $ciudad= $_POST['ciudad'];
			  $clave= $_POST['pass'];
			  $numero= $_POST['numero'];
			  $fecha=$_POST['fech'];
			  $nombreuser= $_POST['correo']; 
			  $usuarios = "SELECT * FROM usuario WHERE id_email='" . $nombreuser . "'";
              $result = mysqli_query($conexi, $usuarios);
              $user=mysqli_fetch_array($result);
                if(sizeof($user)==0){ 
                	if (isset($_FILES["imagen"]) && !empty($_FILES["imagen"]) ){
                		$imagen=explode('/',$_FILES['imagen']['type']);
              			if ($imagen[0] == 'image'){
							$img = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
               				$tipo=$imagen[1];
               				  $usuarionue = "insert into usuario VALUES  ('$nombreuser', '$clave','$img','$tipo','1','$fecha','$numero','','','$nombre','$apellido',0)";
               				  //exit($usuarionue);
						     $resultado = mysqli_query($conexi, $usuarionue);
						     $_SESSION['id'] = $nombreuser;
						     header("location:registroexitoso.php");
						   //  header("location:index.php?msj=usuario creado satisfactoriamente");
						}
					}

						if(count($_FILES) != 0 ) {
								
								
						  		 $usuarionue = "insert into usuario  (`id_email`, `clave`, `credito`, `fecha_nac`, `telefono`, `puntos`, `estado`, `nombre`, `apellido`, `calificaciones`)  values  ('$nombreuser', '$clave','1','$fecha','$numero','0','0','$nombre','$apellido',0)";
						  		 	 //echo ($usuarionue);exit();
								     $resultado = mysqli_query($conexi, $usuarionue);
								     $_SESSION['id'] = $nombreuser;
								     header("location:registroexitoso.php");
								     //exit($resultado);
								  //  header("location:index.php?msj=Se ha registrado exitosamente");
								 }    

						  
				}
				else {
						    
						    
						    echo ($mensaje[$error]);
							//header("location:registro.php?repetido=Ya existe una cuenta con el email ingresado");
					}

			}
		
	  			 
?> 