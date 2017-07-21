 <?php 
    session_start();
             include ('conexion.php');
             $conexi=conectar();

            if( ( (isset($_POST['email'])) && ($_POST['email'] != null) ) && ( (isset($_POST['pass'])) && ($_POST['pass'] != null) ) ){
             $email= $_POST['email'];
             $clave= $_POST['pass'];

              $usuarios = "SELECT * FROM usuario WHERE id_email= '" . $email . "' AND clave='" . $clave . "'";
                $result = mysqli_query($conexi, $usuarios);
                $mostrar = mysqli_fetch_array($result);
                if ($mostrar > 0) { // hay por lo menos uno??
                    if ($mostrar['estado'] == 0){
                        $_SESSION['id'] = $mostrar['id_email'];
                        $_SESSION['admin'] = $mostrar['rol'];
                    }
                    else {
                            
                             
                             $_SESSION['alerta'] = "esta cuenta esta actualmente deshabilitada";
                             header("location:index.php");
                    }
                if ($_SESSION['admin'] == 0){
                  header("location:index.php");
                  mysqli_close($conexion);
                }
                else{
                     if ($_SESSION['admin'] == 1){
                  header("location:indexadmin.php");
                  mysqli_close($conexion);
                    }
                }
             } else {
                 header("location:index.php?error=Error en la clave o en el usuario");
                
             }

}         

    
?>