<?php
    include ('conexion.php');
     $conexi=conectar();
	session_start();
	 if (isset($_SESSION['admin']) && $_SESSION['admin']==0) {

		$_SESSION['guarda'] = "no sos un administrador";
		header("location:index.php");
	}
	if (empty($_SESSION['id'])){
		$_SESSION['fede'] = "Imposible acceder a este sitio";
		header("location:index.php");
	}
	if (isset($_SESSION['emi'])){
		echo $_SESSION['emi'];
	}
	if (isset($_POST['cate']) ){
			$cate=$_POST['cate'];
			$aux="SELECT * from categoria where nombre = '$cate'";
			$auxtres=mysqli_query($conexi,$aux);
			$dos=mysqli_fetch_array($auxtres);
			if ($dos == 0){
				$oscargomez="INSERT INTO categoria values ('$cate',0)";
				$gomez=mysqli_query($conexi,$oscargomez);
				header("location:cateexitosa.php");
					
			}
			else {
				header("location:agregarcate.php?nada=Ya existe una categoria con ese nombre");

			}
	}


	?>
 