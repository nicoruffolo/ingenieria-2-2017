<?php 
    session_start();
    if ( empty($_SESSION['id'])){
       header("location:index.php?no=Inicie Sesion por favor"); }
    
     $idies = $_SESSION['id'];


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
    ?> <div> <a style="margin-right:1250px;margin-top: 12px; " href="perfil.php "> Volver </a> </div> 
    <div> <a style="margin-right:1250px;margin-top: 12px; " href="editarprivi.php ">   Editar Privacidad </a> </div>
    <?php


     $conexi=conectar();
  	 $usuarios = "SELECT * from usuario where id_email= '" . $_SESSION['id'] . "' ";
                $result = mysqli_query($conexi, $usuarios);
               ?> <div style="text-align: center;"> <?php
                $i= mysqli_fetch_array($result)
             ?>   	  
        <form style="text-align: center;" action="editarper.php" method="POST" enctype="multipart/form-data"> 
         <fieldset>
        <legend>Opciones de  modificacion de perfil</legend>
        <div class="correte">
          <label> Email </br>
          <?php   $seleccionado = " ";

                  if (isset($_POST['nombre']) && $_POST['nombre'] == $i['id_email']  ){
                    $seleccionado = "selected"; } ?>
          <input title="Ingrese usuario" type="text" name="nombre" id="nombre" size="32"  value= "<?php echo $i['id_email'];?> ">
          </label>  </br>
         
           <label> telefono </br>
            <?php   $seleccionado = " ";
            if (isset($_POST['tel']) && $_POST['tel'] == $i['telefono']  ){
                    $seleccionado = "selected"; } ?>
          <input title="Ingrese usuario" type="text" name="tel" id="nombre" size="32"  value= "<?php echo $i['telefono'];?>" required=""> </br> 
           <label> nombre </br>
            <?php   $seleccionado = " ";
          if (isset($_POST['usu']) && $_POST['usu'] == $i['nombre']  ){
                    $seleccionado = "selected"; } ?>
          <input title="Ingrese usuario" type="text" name="usu" id="nombre" size="32"  value= " <?php echo $i['nombre'];?>" required=""> </br> 

              <label> apellido </br>
            <?php   $seleccionado = " ";
          if (isset($_POST['nombre']) && $_POST['apellido'] == $i['apellido']  ){
                    $seleccionado = "selected"; } ?>
          <input title="Ingrese usuario" type="text" name="apellido" id="nombre" size="32"  value= " <?php echo $i['apellido'];?>" required=""> </br> 
          </br>
          <p> <?php
            if($i['foto'] == null ){
                     ?> <img src="imagenes/avatar.png"> <?php } else { ?>
            <img width="360" src="mostrarusuario.php?id=<?php $_SESSION['id'];?>"/> 
            <?php  } ?>
                  
            </p>

          <label>Imagen </label> </br>

           <p>Elige una imagen: <input type="file" name="foto" id="foto" class="input" ><br> </p> </br>
           </br> 
           <input type="hidden" name="idgauchada" value= "<?php echo $i['id'];?> ">
            <input type="submit" name="enviar">Guardar cambios</button></br>
            <?php
            if (isset($_GET['no'])){
                       echo "<h4 style='color:red'>".$_GET["no"]."</h4>";
            }

            ?>
            </div>
      </fieldset>
     </form>
       
</body>
</html>     


    


