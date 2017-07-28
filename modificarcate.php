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
  <img src="imagenes/gauchada.png">
</head>
<body> 
  <?php
     include ('conexion.php');
     $conexi=conectar(); 
     $cate=$_GET['id'];
     
      ?>
              <a href="catego.php">Volver</a></br>
              <form id="formu" style="text-align: center;" action="modificamecatego.php?id=<?php echo $_GET['id']; ?>" method="POST"> 
         <fieldset>
        <legend>Opciones de  modificacion de categoria</legend>
        <div class="correte">
          <label> nombre </br>
          <?php   $seleccionado = " ";

                  if (isset($_GET['id'])){
                    $seleccionado = "selected"; } ?>
          <input type="text" name="cate" value="<?php echo $cate; ?>" style="text-transform:lowercase;" required="" onkeyup="javascript:this.value=this.value.toLowerCase();">
          </label> </br>
          <input type="submit" name="modificar"> 
          </div>
          </fieldset>
          </form>
          <?php if(isset($_GET['nadados'])){
              echo "<h4 style='color:red'>".$_GET["nadados"]."</h4>"; 
          } ?>
          <?php if (isset($_GET['oscar'])){
               echo "<h4 style='color:red'>".$_GET["oscar"]."</h4>"; 
            } ?>
          </body>