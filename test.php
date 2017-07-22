<?php
	$conexi=mysqli_connect("localhost","root","","ingedos") or die("ingreso");
	$data=mysqli_fetch_assoc(mysqli_query($conexi,"SELECT * FROM usuario WHERE id_email='laconchadetumadre@hotmail.com'"));
?>
<img src="<?php echo 'data:image/'.$data['tipofoto'].'; base64,'.base64_encode($data['foto']) ?>">