<?php 
	extract($_POST);
	/*Conexion al servidor de mysql*/
	include('../dll/conexionsql.php');
	/*Obtener los datos de db*/
	
	$sql="insert  into salas values('','$salEdificio','$salNombre','$salLocalizacion','$salCapacidad','$salDescripcion')";
	$ressql=mysql_query($sql,$con);
	echo "<script> window.location='../pages/addsala.php'</script>";
?>