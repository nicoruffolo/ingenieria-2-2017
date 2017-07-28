<?php 
    session_start();
    if (empty($_SESSION['id'])){
      {
      header("location:index.php?no=Inicie Sesion por favor"); }
    } ?>

<!DOCTYPE html>
<html>
<head>
	  <meta charset="utf-8">
	<title>Una Gauchada</title>
	<img src="imagenes/gauchada.png">
    
	<meta name="viewport" content="">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="estilis.css">
</head>
	
</head>
<body>
    <?php
     include ('conexion.php');
     $conexi=conectar();
  ?>
  <a href="index.php"> Cancelar compra </a>
    <h2 style="text-align: center;"> Obtenga su compra aqui  </h2>
    <form action="altadecredito.php" method="post" onsubmit="return validacion()">
     <div style="text-align:center;">
     	<label  >Numero de tarjeta</br>
          <input title="falta el numero de tarjeta " type="text" placeholder="xxxx xxxx xxxx xxxx" name="tarjeta" id="tarjeta" onKeypress="if (event.keyCode < 48 || event.keyCode > 57 ) event.returnValue = false;" maxlength="16" size="16" pattern= "[0-9]{16}" required=" "/></label> </br>
    <label  >Numero de seguridad</br>
          <input title="falta el codigo de seguridad " type="text" placeholder="xxxx" name="codigo" id="codigo" onKeypress="if (event.keyCode < 48 || event.keyCode > 57 ) event.returnValue = false;" maxlength="4" size="4" pattern= "[0-9]{3,4}" required=""/></label> </br>
    <label  > Fecha de vencimiento</br>
        <p>
           <input title="falta el mes" type="number" name="mes" size="3" maxlength="2"  placeholder="mm" min="01" max="12"   onKeypress="if (event.keyCode < 48 || event.keyCode > 57 ) event.returnValue = false;"   pattern="[0-9]{2}" required=""> /
           <input title="falta el anio" type="number" name="anio" size="3" maxlength="2" placeholder="yy" min="17"  max="22" onKeypress="if (event.keyCode < 48 || event.keyCode > 57 ) event.returnValue = false;"  pattern="[0-9]{2}" required="">

        </p>



		<label for="" > Ingrese la cantidad de creditos a comprar (1 credito = $50, maximo hasta 99 creditos sin excepcion)</br>
				<input title="" type="text" name="credito" id="credito" size="2" placeholder="xx"    onKeypress="if (event.keyCode < 48 || event.keyCode > 57 ) event.returnValue = false;"          maxlength="2"  pattern="[0-9]{1,2}" required=""/></label>  </br>
			<input type="submit" name="" value="aceptar"> </br>
			  <?php if (isset($_GET["errordos"])) {
                    echo "<h4 style='color:red'>".$_GET["errordos"]."</h4>"; 
                   }
                   if (isset($_GET["errortres"])){
                   		echo "<h4 style='color:red'>".$_GET["errortres"]."</h4>";
                    } 
                     if (isset($_GET["errornuevo"])){
                      echo "<h4 style='color:red'>".$_GET["errornuevo"]."</h4>";
                    }
            
                  ?>
     </div>

    </form>
</body>
</html>