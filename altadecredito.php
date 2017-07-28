<?php
   include ('conexion.php');
     $conexi=conectar();
     session_start();
     $id = $_SESSION['id'];
     $fecha = date("Y-m-d");
           if(  isset($_POST['credito']) and !empty($_POST['credito']) ){
             	$credito= $_POST['credito'];
         	if ($credito > 0){
	                    	$saldos = "SELECT  credito FROM usuario WHERE id_email= '" . $id . "' ";
	                        
	               			$result = mysqli_query($conexi, $saldos);
	                		$mostrar = mysqli_fetch_array($result);
	               				 $compranueva = "insert into compra values ('','$credito','$fecha','$id')";
	               				// var_dump($compranueva);die;
								 //exit($compranueva);			  		  	
						    	 $resultado = mysqli_query($conexi, $compranueva);
						 	 	 $act=$mostrar['credito'] + $credito;
						 	 	 $modificar = "update usuario set credito=".$act." where id_email='$id'";
						 	 	// exit($modificar);
						 	 	 $result= mysqli_query($conexi, $modificar);
						 	 	 //exit($result);
						 	 	 header("location:creditoobtenido.php");
							

	               	}
	               		else {
                      if ($nrotarjeta=='123456789') {
                        header("location:comprarcredito.php?errornuevo=Tarjeta sin saldo suficiente");
                      } else {
               			header("location:comprarcredito.php?errordos=Tarjeta invalida");
                     }
               		}
               	}

       
         else {
                	header("location:comprarcredito.php?errortres=Debe ingresar al menos un credito para comprar");
                }

         
    ?>