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
	
	include ('conexion.php');
    $conexi=conectar();
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
		<a href="panel.php">Volver </a> </br> 
<h1 style="text-align: center;">Vea las compras realizadas y el total recaudado entre dos fechas</h1></br>
<h3>Elija dos fechas y presione continuar para consultar las compras hechas y el dinero recaudado:</h3></br></br>
<form action="listadoganancias.php" method="post">
	<div class="correte">
	<label>Fecha Minima (desde): </br>
    <input title="Ingrese la fecha minima" type="date" name="fech1" id="fech1" size="32" min="2017-05-01"  max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>"  required=""/></label> </br></br>

    <label>Fecha Maxima (hasta): </br>
    <input title="Ingrese la fecha maxima" type="date" name="fech2" id="fech2" size="32" min="2017-05-01"  max="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>"  required=""/></label> </br></br>

    <input type="submit" name="" value="continuar">
    </div>
</form>
<?php
if (isset($_GET['mal'])){
        echo "<h4 style='color:red'>".$_GET["mal"]."</h4>"; 
    }
?>
</body>
</html>    