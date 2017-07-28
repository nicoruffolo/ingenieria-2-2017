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
	<img src="imagenes/gauchada.png">
</head>
<body> 
  <?php
     include ('conexion.php');
     $conexi=conectar();
     $id = $_GET['id'];
     ?> <div> <a style="margin-right:1250px;margin-top: 12px; " href="detallefavor.php?id=<?php echo $_GET['id']; ?>"> Volver </a> </div> <?php
     $gauchada="SELECT * from gauchada   where id=" . $id;
     $guardar=mysqli_query($conexi, $gauchada);
     $i = mysqli_fetch_array($guardar);
     $ciu=$i['ciudad'];
     $cate=$i['caterogia'];
     //echo($ciu);exit();
    ?>
              <form id="formu" style="text-align: center;" action="modificargaucha.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data"> 
         <fieldset>
        <legend>Opciones de  modificacion de gauchada</legend>
        <div class="correte">
          <label> nombre </br>
          <?php   $seleccionado = " ";

                  if (isset($_POST['nombre']) && $_POST['nombre'] == $i['titulo']  ){
                    $seleccionado = "selected"; } ?>
          <input title="Ingrese el nombre de gauchada a modificar" type="text" name="nombre" id="nombre" size="32"  value= "<?php echo $i['titulo'];?> " required="">
          </label>  </br>
          <label> descripcion </br>
          <?php   $seleccionado = " ";

                  if (isset($_POST['descri']) && $_POST['descri'] == $i['descripcion']  ){
                    $seleccionado = "selected"; } ?>
          <input title="Ingrese el nombre de gauchada a modificar" type="text" name="descri" id="nombre" size="32"  value= "<?php echo $i['descripcion'];?> " required="">
          </label>  </br>
          <?php
          $ciudades = "SELECT nombre from  ciudad where nombre != '$ciu'";
          //echo($ciudades);exit();
          $ciudada = mysqli_query($conexi,$ciudades); ?> 
          </br> Ciudad:</br>
           <select  name="ciu" >
                <option value= "<?php echo ($ciu);?>" selected="selected"> <?php echo ($ciu);?> </option>
             <?php 
               
               while ($r=mysqli_fetch_array($ciudada)) {
                  $seleccionado = "";
                  if (isset($_POST['ciu']) && $_POST['ciu'] == $r['nombre']  ){
                    $seleccionado = "selected"; }
                   ?> <option <?php echo $seleccionado ?> value=<?php echo $r['nombre'];?> > <?php echo  $r['nombre']; ?> </option>
                  

              <?php  }

             ?>
         </select>
         </br></br> Categoria: </br>
          <?php
          $ada="SELECT nombre from categoria where nombre != '$cate'";
          $cataga=mysqli_query($conexi,$ada); ?>
          <select  name="cate" >
                <option value= "<?php echo ($cate);?>" selected="selected"> <?php echo ($cate);?> </option>
             <?php 
               
               while ($q=mysqli_fetch_array($cataga)) {
                  $seleccionado = "";
                  if (isset($_POST['cate']) && $_POST['cate'] == $q['nombre']  ){
                    $seleccionado = "selected"; }
                   ?> <option <?php echo $seleccionado ?> value=<?php echo $q['nombre'];?> > <?php echo  $q['nombre']; ?> </option>
                  

              <?php  }

             ?>
         </select>  

            </br>
             <p>  
                      <?php if($i['foto'] == null){ ?>
                     <img width="200" src="imagenes/avatar.png"> <?php } 
                     else {
                      ?> <img width="200" src="mostrar.php?id=<?php echo $i ['id'];?>"/>
                    </a> 
                  <?php } ?>    
                    </p>
          

           <label>Imagen </label> </br>

           <p>Elige una imagen: <input type="file" name="foto" id="foto" class="input" ><br> </p> </br>
           </br> 
           <input type="hidden" name="idgauchada" value= "<?php echo $i['id'];?> ">
            <input id="envio" type="submit" name="enviar">Modificar gauchada</button>
            </div>
      </fieldset>
     </form>
     <script type="text/javascript">

$('formu').bind('change keyup', function() {

    if($(this).validate().checkForm()) {

        $('envio').attr('disabled', false);

    } else {

        $('envio').attr('disabled', true);

    } });

</script>
       
</body>
</html>     


    



            