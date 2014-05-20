<?php
extract($_POST);
extract($_GET);
$id=base64_decode($id);
include("../dll/conexionsql.php");
	/*Obtener los datos de db*/
	
	$sql="update edificio set edfNombre='$edfNombre',usrCorreo='$usrCorreo' WHERE idEdificio='$id'";
	
	
	if($ressql=mysql_query($sql,$con)){
		echo "<script> alert('Datos actualizados');
		 window.location='../pages/addedf.php'</script>";
	}else{
		echo "<script> alert('Error. Datos no actualizados');
		 window.location='../pages/addedf.php'</script>";
	}
	?>