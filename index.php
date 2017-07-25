 <?php 
    session_start();
   if (isset($_SESSION['admin']) && $_SESSION['admin']==1) {

    $_SESSION['emi'] = "sos un administrador";
    header("location:indexadmin.php");
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
     $conexi=conectar();
     $where=" where 1=1 ";
     $where2=" where 1=1 ";  
          if (isset($_POST['tit']) && !empty($_POST['tit'])){
          $titulo=$_POST['tit'];
          $where.=" and titulo like '%".$titulo."%'";
       }
     
       if (isset($_POST['ciu']) && !empty($_POST['ciu'])){
         // $ciudad=$_POST['ciu'];
          $where.=" and ciudad ='" . $_POST['ciu'] . "' ";
       }

       if (isset($_POST['cate']) && !empty($_POST['cate'])){
         // $ciudad=$_POST['ciu'];
          $where.=" and caterogia ='" . $_POST['cate'] . "' ";
       }


     $gauchada="SELECT * from gauchada".$where." and  estado = 0 and fecha_vencimiento > NOW() order by cant_postulantes ,fecha_creacion  "; 
    
      $ciudades = "SELECT nombre from  ciudad";
     $categ = "SELECT nombre from categoria where estado = 0";

     $guardar=mysqli_query($conexi, $gauchada);
     $ciudada = mysqli_query($conexi,$ciudades);
     $mostrar = mysqli_query($conexi,$categ);

    
     
        ?>     <h2> Buscar Gauchada </h2>
       <form method="POST" action="index.php" required="required">
        <?php    $seleccionado = "";

          if ( (isset($_POST['tit'])) && (!empty($_POST['tit'])) ){
            $seleccionado = $_POST['tit'];
          } ?>
        
         ingrese el titulo <input type="text" value="<?php echo $seleccionado;?>" name="tit"> </br>
        </br>
         
      
   ingrese la ciudad:   <select  name="ciu" >
                <option value="" > Seleccione... </option>
             <?php
               
               while ($i=mysqli_fetch_array($ciudada)) {
                  $seleccionado = "";
                  if (isset($_POST['ciu']) && $_POST['ciu'] == $i['nombre']  ){
                    $seleccionado = "selected"; }
                   ?> <option <?php echo $seleccionado ?> value=<?php echo $i['nombre'];?> > <?php echo  $i['nombre']; ?> </option>
                  

              <?php  }

             ?>
         </select>
         </br>

  Seleccione la categoria:      <select  name="cate">
             <option value="" > Seleccione... </option>
             <?php
               
               while ($i=mysqli_fetch_array($mostrar)) {
                  $selecci = " ";
                  if (isset($_POST['cate']) && $_POST['cate'] == $i['nombre']  ){
                    $selecci = "selected"; 
                  }
                   ?> <option <?php echo $selecci ?> value=<?php echo $i['nombre'];?> > <?php echo  $i['nombre']; ?> </option>
                  

              <?php  }

             ?>
         </select>
         </br>
          

              <input type="submit" name="buscar" value="buscar"></br></br>
              <a href="index.php" >Home </a>

</form> 
       <?php if ( isset($_SESSION['id'])){ ?>
           <a style="margin-left: 1250px;" href="cerrarsesion.php "> Cerrar sesion </a> </br> <?php  if (isset($_GET['bien'])){
                       echo "<h4 style='color:red'>".$_GET["bien"]."</h4>"; 
                    } ?>  </br>
             <div style="margin-top: -22px;"> <a style="margin-right:   1250px; " href="publicarfavor.php ">   Publicar Favor </a> </div>
                                               <a href="comprarcredito.php" >Obtener credito </a> </br>
                                               <a href="perfil.php" >Ver mi perfil </a> </br>   
                                               <?php 
                                              if (isset($_SESSION['guarda']) && $_SESSION['admin']==0) {
                                                      echo $_SESSION['guarda'];
                                                }
                                                     ?>        
                                              
           <h1 style="">  Bienvenido! </h1>
           <?php echo ($_SESSION['id']); ?> </br>
         <?php ?>  Creditos:  <?php $credito = "SELECT credito from usuario where id_email= '" . $_SESSION['id'] . "' ";
     $resu=mysqli_query($conexi,$credito);
     $i=mysqli_fetch_array($resu);
          echo ($i['credito'] ); ?> </br> <?php
          $califi="SELECT calificaciones from usuario where id_email= '" . $_SESSION['id'] . "' ";
          $kalio= mysqli_query($conexi,$califi);
          $ret= mysqli_fetch_array($kalio);
          if ($ret['calificaciones'] == 0 ){
            echo "No tienes calificaciones pendientes";
          }
          else {
            echo "Aun tienes calificaciones pendientes que realizar";
          }
        }                                             


  ?>
 

  <div style="float: right;">
  <?php if (! isset($_SESSION['id'])){ 
      ?>
    <form  action="sesion.php" method="post">
    <h3 style="padding-left: 60px;" > Iniciar sesion: </h3> 
    <div style="margin-left: 54px;">
     <tr > <td >Email: </td><td > <input  style="margin-right:  120px;"  type="email" name="email" id="email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" size=""  required=""></td> </br>
                    <td>Clave: </td><td  style="margin-left: 50px;" ><input  " type="password" name="pass" id="pass" required=""></td> 
                   </br>
                   <button class="submit" type="submit">Login</button>
                   <a href="registro.php" >  Registrarme </a> 
                   <a href="index.php"> Home </a>  
                    <?php if (isset($_GET["error"])) {
                    echo "<h4 style='color:red'>".$_GET["error"]."</h4>"; 
                   }
                   if (isset($_GET['msj'])){
                       echo "<h4 style='color:red'>".$_GET["msj"]."</h4>"; 
                    }
                    if (isset($_GET['no'])){
                       echo "<h4 style='color:red'>".$_GET["no"]."</h4>"; 
                    }  ?> </br> <?php 
                    if (isset($_SESSION['alerta'])){
                       echo $_SESSION['alerta']; 
                    }
                   

                    if (isset($_SESSION['fede'])){
                      echo $_SESSION['fede'];
                    }
                 ?>
            </tr>
     </div>
        </form>
  </div>
  <?php } ?>
  </br>
   <div class="img-rounded">
    
</div> </br>
     


  </div>


       <div class="mover">

         <h2 style="margin-top: -80px;margin-left: 78px;"> Gauchadas</h2> </br>
       </div>
      <?php $ok=false;
          while ($i = mysqli_fetch_array($guardar)) {
            $ok= true;
            $lagauchada=$i['id'];
            $jamon="SELECT count(*) from postulantes where id_favor = $lagauchada and seleccion is not null";
            //echo($jamon);exit();
            $query=mysqli_query($conexi,$jamon);
            $tu=mysqli_fetch_array($query);
            if($tu['count(*)'] == 0){
            ?>
            <div style="padding-left: 524px;"> <?php 
               ?> <h3> <?php echo   $i['titulo']; ?> </h3> </br>
                 <p> 
                     <?php if (isset($_SESSION['id'])){  
                     ?> <a href="detallefavor.php?id=<?php echo $i ['id']; ?>">Detalles</a> 
                       

                       <?php } ?>
                     <br>
                      <?php if($i['foto'] == null){ ?>
                     <img width="360" src="imagenes/avatar.png"> <?php } 
                     else {
                      ?> <img width="360" src="mostrar.php?id=<?php echo $i ['id'];?>"/>
                    </a> 
                  <?php } ?>          
            </p>
              
          
            </div>
               <?php } ?> 
              <?php } ?>          
              <?php
              //$reik = mysqli_fetch_array($guardar);
              //echo($reik); exit();
              if (!$ok){ ?> 
               <h2><i>No se encontraron resultados</i></h2>
           <?php }
    ?>          
        <?php 

        
    ?>
    </div>


 
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
   
</body>

<footer>



</footer>
</html>