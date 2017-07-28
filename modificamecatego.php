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
	include ('conexion.php');
     $conexi=conectar(); 
	$cate=$_GET['id']; 
	if(isset($_POST['cate']) and !empty($_POST['cate'])){
		$cat=$_POST['cate'];

	$aux="SELECT * from categoria where nombre = '$cat'";
			$auxtres=mysqli_query($conexi,$aux);
			$dos=mysqli_fetch_array($auxtres);
			if ($dos == 0){
				$oscargomez="UPDATE categoria set nombre= '$cat' where nombre = '$cate'";
				$gomez=mysqli_query($conexi,$oscargomez);
				header("location:catebienmodifica.php");
					
			}
			else {
				header("location:modificarcate.php?id=$cate&oscar=La categoria ingresada ya existe en este sistema");
				

			}
	}


	?>