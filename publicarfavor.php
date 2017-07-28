 <?php 
    session_start();
    if (empty($_SESSION['id'])){
    	{
		  header("location:index.php?no=Inicie sesion por favor"); }
    }
	include('conexion.php');
	$conexi = conectar();
	$cate = mysqli_query($conexi,"SELECT nombre FROM categoria where estado = 0");

  ?>
<!DOCTYPE html>
<html>
<head>
	<title> Una Gauchada</title>
	<img src="imagenes/mari.png">
	<link href="estilis.css" rel="stylesheet">
	<script src="javaa.js"></script>
</head>
<body> <?php 
    $a="SELECT credito,calificaciones from usuario where id_email= '" . $_SESSION['id'] . "' ";
    //echo($a);exit();
    $re=mysqli_query($conexi,$a);
    $aux=mysqli_fetch_array($re);
    if (($aux['credito'] == 0) && ($aux['calificaciones'] == 0)){ ?>
        <h1>No tienes credito suficiente</h1></br>
        <h3>Dirigite a nuestra seccion de compra para obtener mas credito</h3>
 <?php }
      if (($aux['credito' > 0]) && ($aux['calificaciones'] == 1)){ ?>
         <h1>Tienes calificaciones sin realizar</h1></br>
         <h3>Califica a los usuarios que has seleccionado como postulantes para publicar nuevas gauchadas</h3>
   <?php }
       if (($aux['credito'] == 0) && ($aux['calificaciones'] == 1)){ ?>
          <h1>Credito Insuficiente y calificaciones sin realizar</h1></br>
          <h3>Obtiene mas credito y califica a tus usuarios postulantes para publicar nuevas gauchadas</h3>
    <?php }  ?>
      <div style="text-align: left;">
     	<a href="index.php" > volver </a>
     </div>
    <?php 
        if (($aux['credito'] > 0) && ($aux['calificaciones'] == 0)) { ?>

            <form action="alta.php" method="POST" enctype="multipart/form-data"> 
            <fieldset>
            <legend>Opciones de  gauchada</legend>
     	      <div class="correte">
					  <label for="user_login" > Titulo </br>
					  <input title="Ingrese titulo" type="text" name="titulo" id="titulo" size="32" required/></label>  </br>

					  <label for="user_login" > Descripcion </br>
					  <input title="Ingrese descripcion" type="text" name="descri" id="descri" size="32" required/></label>  </br>

					  <label > Fechalimite </br>
					  <input title="Ingrese fecha limite" type="date" name="fech" id="fech" size="32" min="<?php echo date("Y-m-d"); ?>" max="2020-12-31" required=""/></label> </br>

					Ciudad:</br> <select name="ciudad" required="">
                    <option value="">Eliga una ciudad</option>
                    <option value="LaPlata">LaPlata</option>
                    <option value="Rawson">Rawson</option>
                    <option value="Retiro">Retiro</option>
                    <option value="Santa cruz">Santa cruz</option>
                    <option value="Mar del Plata">Mar del Plata</option>
                    <option value="San Miguel">San Miguel</option>
                    <option value="San Juan">San Juan</option>
                    <option value="Salta">Salta</option>
                    <option value="Santa Fe">Santa Fe</option>
                    <option value="Rosario">Rosario</option>
                    <option value="Mendoza">Mendoza</option>
                    <option value="Cordoba">Cordoba</option>
                    <option value="Bariloche">Bariloche</option>
					 </select> </br>
					 Categoria </br> <select name="categoria" required="">
              		  <option value="">Eliga una categoria</option>
                		<?php while ($categori = mysqli_fetch_array($cate)) {
                   		echo '<option value="' . $categori['nombre'] . '"';
                   	 //	if (isset($_POST['tipo']) and $tipo['idTipo'] == $_POST['tipo'])
                        	//echo ' selected="selected"';
                    		echo '>' . $categori['nombre'] . '</option>';
               			 } ?>
            		</select></br>
					 <label>Imagen </label> </br>

					 <p>Elige una imagen: <input type="file" name="foto" id="foto" class="input" ><br> </p>

           			
					<input type="submit" name="" value="enviar"> 
					
			</div>
			</fieldset>
     </form>
<?php } ?>
</body>
</html>
