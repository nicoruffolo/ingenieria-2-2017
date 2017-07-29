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
	include ("conexion.php");
    $conexi = conectar();
    $id=$_GET['id'];
    $adic="SELECT * from reputacion where id_nombre = '$id'";
    $whar=mysqli_query($conexi,$adic);
    $b=mysqli_fetch_array($whar);
    $prev="";
    if($b['puntaje_final'] == null){
        $prev="no";
    }
    $lista1="SELECT * from reputacion where estado = 0 order by puntaje_inicial";
    $hago1=mysqli_query($conexi,$lista1);
    $next=false;
    $ant_ide="";
    $ant_inicial="";
    $ant_final="";
    $ant_extremo="";
    while ($i = mysqli_fetch_array($hago1)){
        $reputacion=$i['id_nombre'];
        if($next == true){
        	$next=false;
        	if($i['puntaje_final'] != null){
        		$puntos=$i['puntaje_final'];
        		$consulta="UPDATE reputacion set puntaje_inicial = $puntos where id_nombre = '$reputacion'";
        		$query=mysqli_query($conexi,$consulta);
        	}
        }
        if ($reputacion == $id){
        	if (($ant_ide != "") and ($ant_inicial != "") and ($ant_extremo != "")){
        		if($ant_extremo == 1){
        			if($prev == "no"){
        				$puntos=$i['puntaje_inicial'];
        				$consulta="UPDATE reputacion set puntaje_inicial = $puntos where id_nombre = '$ant_ide'";
        				$query=mysqli_query($conexi,$consulta);
        			}
        			else {
        				$puntos=$i['puntaje_final'];
        				$consulta="UPDATE reputacion set puntaje_inicial = $puntos where id_nombre = '$ant_ide'";
        				$query=mysqli_query($conexi,$consulta);
        			}
        		}
        		else {
        		if ($prev == "no"){
        			$puntos=$i['puntaje_inicial'];
        			$consulta="UPDATE reputacion set puntaje_final = $puntos where id_nombre = '$ant_ide'";
        			$query=mysqli_query($conexi,$consulta);
        		}
        		else {
        			$puntos=$i['puntaje_final'];
        			$consulta="UPDATE reputacion set puntaje_final = $puntos where id_nombre = '$ant_ide'";
        			$query=mysqli_query($conexi,$consulta);
        		}
        	}
        }
        else {
        	$next=true;
        }
    }    			
        		
        	
        
        
        $ant_ide=$i['id_nombre'];
        $ant_inicial=$i['puntaje_inicial'];
        $ant_final=$i['puntaje_final'];
        $ant_extremo=$i['extremo'];


    ?>          
<?php
    }
?>
<?php
$consulta2="UPDATE reputacion set estado = 1 where id_nombre = '$id'";
$query2=mysqli_query($conexi,$consulta2);
$consulta9="SELECT min(puntaje_inicial) from reputacion where estado = 0";
$claro=mysqli_query($conexi,$consulta9);
$lamax=mysqli_fetch_array($claro);
$consulta10="SELECT max(puntaje_inicial) from reputacion where estado = 0";
$claro1=mysqli_query($conexi,$consulta10);
$lamin=mysqli_fetch_array($claro1);
$puntomin=$lamax['min(puntaje_inicial)'];
$puntomax=$lamin['max(puntaje_inicial)'];
$consulta11="UPDATE reputacion set extremo = 1, puntaje_final= null where estado = 0 and puntaje_inicial = $puntomin";
$query15=mysqli_query($conexi,$consulta11);
$consulta12="UPDATE reputacion set extremo= 1, puntaje_final= null where estado = 0 and puntaje_inicial = $puntomax";
$query16=mysqli_query($conexi,$consulta12);
$consulta15="UPDATE reputacion set extremo = 0 where estado = 0 and puntaje_inicial != $puntomin and puntaje_inicial != $puntomax";
$query20=mysqli_query($conexi,$consulta15);
$juan="UPDATE reputacion set puntaje_final = null where estado = 0 and extremo = 0 and puntaje_inicial = puntaje_final";
$robert=mysqli_query($conexi,$juan);
header("location:eliminareputaexitosa.php");
