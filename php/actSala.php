<?php
extract($_POST);
extract($_GET);
$id=base64_decode($id);
include("../dll/conexionsql.php");
	/*Obtener los datos de db*/
	
	$sql="update salas set idEdificio='$edificio2',salNombre='$nombre',salLocalizacion='$locaEdf2',salCapacidad='$capacidad2',salDescripcion='$descripSala2' where idSalas='$id'";
	
	
	if($ressql=mysql_query($sql,$con)){
		echo "<script> alert('Datos de Sala actualizados.');
		window.location='../pages/addsala.php'</script>";
	}else{
		echo "<script> alert('Error. Datos de Sala no actualizados.');
		window.location='../pages/addsala.php'</script>";
	}
	?>