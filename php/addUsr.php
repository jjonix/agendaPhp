<?php 
	extract($_POST);
	/*Conexion al servidor de mysql*/
	include('../dll/conexionsql.php');
	/*Obtener los datos de db*/
	
	$sql="insert  into usuario values('','$numCed1','$nombres1','$apellidos1','$correo1',MD5('$contraseña1'),'$usuario1')";	
	if($ressql=mysql_query($sql,$con)){
		echo "<script> alert('Usuario agregado.');
		window.location='../pages/addUsr.php'</script>";
	}else{
		echo "<script> alert('Error. Usuario no agregado.');
		window.location='../pages/addUsr.php'</script>";
	}
?>