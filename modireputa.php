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
    if(isset($_POST['nombre']) and !empty($_POST['nombre'])){
    	$repu=$_POST['nombre'];
    	$original=ucwords($repu);
    	$consulta1="SELECT count(*) from reputacion where id_nombre = '$original' and id_nombre != '$id'";
    	$query1=mysqli_query($conexi,$consulta1);
    	$cuenta=mysqli_fetch_array($query1);
    	if($cuenta['count(*)'] > 0){
    		header("location:modificarreputa.php?id=$id&msj=Ya existe una reputacion con ese nombre");
            exit();
    	}
    }
    $ok=false;
    if ($_POST['max'] != ""){
       $ok=true;
    //exit();
}

    if((isset($_POST['nombre']) and !empty($_POST['nombre']) and  isset($_POST['min']) and !empty($_POST['min']) and  isset($_POST['max']) and !empty($_POST['max'])) or ($ok)){
        $minimo=$_POST['min'];
        $maximo=$_POST['max'];
        if($minimo > $maximo){
            //if(($minimo > 0) and ($maximo > 0)) {
            header("location:modificarreputa.php?id=$id&error=Asegurese que el puntaje minimo sea menor al puntaje maximo"); exit(); //}
        }
        if($minimo == $maximo){
            header("location:modificarreputa.php?id=$id&igual=Los puntajes minimo y maximo no deben ser iguales");
            exit();
        }
        $borro="UPDATE reputacion set estado = 1 where estado = 0 and puntaje_inicial BETWEEN $minimo AND $maximo and puntaje_final BETWEEN $minimo AND $maximo and id_nombre != '$id'";
        $borro2="UPDATE reputacion set estado = 1 where estado = 0 and puntaje_inicial BETWEEN $minimo AND $maximo and extremo = 0 and puntaje_final is null and id_nombre != '$id'";
        //echo("hola");exit();
        $hacer1=mysqli_query($conexi,$borro);
        $hacer2=mysqli_query($conexi,$borro2);
        $adic="SELECT min(puntaje_inicial) from reputacion where estado = 0";
        $tabi=mysqli_query($conexi,$adic);
        $luz=mysqli_fetch_array($tabi);
        $guardo=$luz['min(puntaje_inicial)'];
        $adic2="SELECT max(puntaje_inicial) from reputacion where estado = 0";
        $tabi2=mysqli_query($conexi,$adic2);
        $luz2=mysqli_fetch_array($tabi2);
        $guardo2=$luz2['max(puntaje_inicial)'];
        $insertar="UPDATE reputacion set id_nombre = '$original', puntaje_inicial = $minimo, puntaje_final = $maximo where id_nombre = '$id'";
        //echo($insertar);exit();
        $inserto=mysqli_query($conexi,$insertar);
        $lista="SELECT * from reputacion where estado = 0 order by puntaje_inicial,puntaje_final";
        //echo($lista);exit();
        $hago=mysqli_query($conexi,$lista);
        $prev=false;
        $next=false;
        $ant_id="";
        $ant_ini="";
        $ant_fin="";
        $ant_extr="";
        while ($i = mysqli_fetch_array($hago)){
            if ($next == true){
                //echo("true");exit();
                $nombresito=$i['id_nombre'];
                $puntito=$ant_fin2 + 1;
                $next=false;
                $filo="UPDATE reputacion set puntaje_inicial = $puntito where id_nombre = '$nombresito'";
                //echo($filo);exit();
                $filo1=mysqli_query($conexi,$filo);
             }
            if ($prev == true){
                $acti=$i['id_nombre'];
                $prev= false;
                $si=$i['puntaje_inicial'];
                if (($i['extremo'] == 1) and ($ant_extr == 1) and ($si <= $ant_fin)){
                   $next=true;
                   $valor=$ant_ini - 1;
                   $queda="UPDATE reputacion set puntaje_inicial = $valor where estado = 0 and id_nombre = '$acti'";
                   $conexion=mysqli_query($conexi,$queda);
                   $ant_fin2=$ant_fin; 
                } else {
                $puntos=$ant_fin + 1;
                $blu="UPDATE reputacion set puntaje_inicial = $puntos where id_nombre = '$acti'";
                $ya=mysqli_query($conexi,$blu);
                if(($i['puntaje_final'] == null) and ($si != $puntos)){
                    $otra="UPDATE reputacion set puntaje_final = $si where id_nombre = '$acti'";
                    $uo=mysqli_query($conexi,$otra);
                }
               } 
            }
            if($i['id_nombre'] == $original){
                $act=$i['id_nombre'];
                $prev=true;
                if(($ant_id == "") and ($ant_ini == "") and ($ant_fin == "") and ($ant_extr == "")){
                        $cam="UPDATE reputacion set extremo = 1 where id_nombre = '$act'";
                        $bien=mysqli_query($conexi,$cam);
                        $i['extremo']=1;
                } else {
                    if($ant_fin != null){
                        $fin=$i['puntaje_inicial'] - 1;
                        $modi="UPDATE reputacion set puntaje_final = $fin where id_nombre = '$ant_id'";
                        $cam3=mysqli_query($conexi,$modi);
                    }
                    if(($ant_fin == null) and ($ant_extr == 1)){
                       if($i['puntaje_inicial'] == $guardo2){
                        $fin3=$i['puntaje_final'] + 1;
                        $yeahi="UPDATE reputacion set puntaje_inicial = $fin3 where id_nombre = '$ant_id'";
                        $yayao=mysqli_query($conexi,$yeahi); 
                       } else {
                        if($i['puntaje_inicial'] == $guardo){
                           $fin2=$i['puntaje_inicial'] - 1;
                           $yeah="UPDATE reputacion set puntaje_inicial = $fin2 where id_nombre = '$ant_id'";
                           $yaya=mysqli_query($conexi,$yeah); 
                        } else {
                       $fin2=$i['puntaje_inicial'] - 1;
                        $moda="UPDATE reputacion set puntaje_final = $fin2 where id_nombre = '$ant_id'";
                        $cam6=mysqli_query($conexi,$moda); } }
                    }
                }   
            }

            $ant_id=$i['id_nombre'];
            $ant_ini=$i['puntaje_inicial'];
            $ant_fin=$i['puntaje_final'];
            $ant_extr=$i['extremo'];
       
        ?>          
<?php
    }
?>
<?php

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
        $yesi="SELECT id_nombre from reputacion where estado = 0 and puntaje_inicial = $puntomin";
        $yesi2=mysqli_query($conexi,$yesi);
        $yesi3=mysqli_fetch_array($yesi2);
        if ($yesi3['id_nombre'] == $original){
            $pan="UPDATE reputacion set puntaje_inicial = $maximo where id_nombre = '$original'";
            $pan2=mysqli_query($conexi,$pan);
        }
        $juan="UPDATE reputacion set puntaje_final = null where estado = 0 and extremo = 0 and puntaje_inicial = puntaje_final";
        $robert=mysqli_query($conexi,$juan);

    }
    	

    else {
        //exit();
    	$minimo=$_POST['min'];
    	$borro="UPDATE reputacion set estado = 1 where estado = 0 and puntaje_inicial = $minimo and extremo = 0 and puntaje_final is null and id_nombre != '$id'";
    	$hacer=mysqli_query($conexi,$borro);
    	$insertar="UPDATE reputacion set id_nombre = '$original', puntaje_inicial = $minimo, puntaje_final = null where id_nombre = '$id'";
        //echo($insertar);exit();
    	$inserto=mysqli_query($conexi,$insertar);
    	$lista="SELECT * from reputacion where estado = 0 order by puntaje_inicial,puntaje_final";
        //echo($lista);exit();
    	$hago=mysqli_query($conexi,$lista);
    	$prev=false;
    	$next=false;
    	$ant_id="";
    	$ant_ini="";
    	$ant_fin="";
    	$ant_extr="";
    	while ($i = mysqli_fetch_array($hago)){
    		if ($next == true){$next=false;}
    		if ($prev == true){
    			$acti=$i['id_nombre'];
    			$prev= false;
    			$next=true;
                $si=$i['puntaje_inicial'];
                if (($i['extremo'] == 1) and ($ant_extr == 1) and ($si == $ant_ini)){
                   $valor=$ant_ini - 1;
                   $queda="UPDATE reputacion set puntaje_inicial = $valor where estado = 0 and id_nombre = '$acti'";
                   $conexion=mysqli_query($conexi,$queda); 
                } else {
                $puntos=$ant_ini + 1;
                $blu="UPDATE reputacion set puntaje_inicial = $puntos where id_nombre = '$acti'";
                $ya=mysqli_query($conexi,$blu);
                if(($i['puntaje_final'] == null) and ($si != $puntos)){
                    $otra="UPDATE reputacion set puntaje_final = $si where id_nombre = '$acti'";
                    $uo=mysqli_query($conexi,$otra);
                }
                }
    		}
    		if($i['id_nombre'] == $original){
    			$act=$i['id_nombre'];
    			$prev=true;
                $opcional1=$ant_ini;
                $opcional2=$ant_id;
    		    if(($ant_id == "") and ($ant_ini == "") and ($ant_fin == "") and ($ant_extr == "")){
    		    		$cam="UPDATE reputacion set extremo = 1 where id_nombre = '$act'";
    		    		$bien=mysqli_query($conexi,$cam);
                        $i['extremo']=1;
    		    } else {
    		    	if($ant_fin != null){
    		    		$fin=$i['puntaje_inicial'] - 1;
    		    		$modi="UPDATE reputacion set puntaje_final = $fin where id_nombre = '$ant_id'";
    		    		$cam3=mysqli_query($conexi,$modi);
    		    	}
                    if(($ant_fin == null) and ($ant_extr == 1)){
                       $fin2=$i['puntaje_inicial'] - 1;
                        $moda="UPDATE reputacion set puntaje_final = $fin2 where id_nombre = '$ant_id'";
                        $cam6=mysqli_query($conexi,$moda); 
                    }
    		    }	
			}

    		$ant_id=$i['id_nombre'];
    		$ant_ini=$i['puntaje_inicial'];
    		$ant_fin=$i['puntaje_final'];
    		$ant_extr=$i['extremo'];
?>    		
<?php
    }
?>
<?php
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
}


$lista1="SELECT * from reputacion where estado = 0 order by puntaje_inicial,puntaje_final";
//echo($lista1);exit()
$hago1=mysqli_query($conexi,$lista1);
        $ant_ide="";
        $ant_inicial="";
        $ant_final="";
        $ant_extremo="";
        while ($a = mysqli_fetch_array($hago1)){
            $reputacion=$a['id_nombre'];
            //echo $reputacion;exit();
            if (($ant_ide != "") and ($ant_inicial != "") and ($ant_extremo != "")){
                if($ant_final == null){
                    $valor=$ant_inicial + 1;
                    $modificacion="UPDATE reputacion set puntaje_inicial = $valor where id_nombre = '$reputacion'";
                    $barbaro=mysqli_query($conexi,$modificacion);
                } else {
                    $valor=$ant_final + 1;
                    $modificacion="UPDATE reputacion set puntaje_inicial = $valor where id_nombre = '$reputacion'";
                    $barbaro=mysqli_query($conexi,$modificacion);
                }
            }
            $ant_ide=$a['id_nombre'];
            $ant_inicial=$a['puntaje_inicial'];
            $ant_final=$a['extremo'];
            $ant_final=$a['puntaje_final'];
            $ant_extremo=$a['extremo'];   
    ?>          
<?php
    }
?>
<?php
if($prev == true){
    $consulta29="SELECT * from reputacion where id_nombre = '$id'";
    $query29=mysqli_query($conexi,$consulta29);
    $w=mysqli_fetch_array($query29);
    //echo($w['puntaje_inicial']);exit();
    $consulta30="UPDATE reputacion set puntaje_inicial = $minimo where id_nombre = '$id'";
    $query30=mysqli_query($conexi,$consulta30);
    if ($opcional1 == $minimo){
    $puntajesito=$minimo + 1;
    $consulta31="UPDATE reputacion set puntaje_inicial = $puntajesito where id_nombre = '$opcional2'";
    $query31=mysqli_query($conexi,$consulta31);
} else {
    if($minimo > $opcional1){
       $puntajesito=$minimo - 1;
       $consulta50="UPDATE reputacion set puntaje_final = $puntajesito where id_nombre = '$opcional2'";
       $query50=mysqli_query($conexi,$consulta50); 
    }
}
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
}


header("location:modificarepuexitosa.php?id=$id");