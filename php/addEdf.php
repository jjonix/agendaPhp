<?php 
	extract($_POST);
	/*Conexion al servidor de mysql*/
	include ('../dll/conexionsql.php');
	/*Obtener los datos de db*/
	$sql="SELECT usrCorreo from usuario";
	$ressql=mysql_query($sql,$con);
	$row=mysql_fetch_array($ressql);
	
	$sql="insert  into edificio values('','$nomEdf3','".$row['usrCorreo']."')";
	
	
	if($ressql=mysql_query($sql,$con)){
		echo "<script> alert('Edificio agregado.');
		window.location='../pages/addedf.php'</script>";
	}else{
		echo "<script> alert('Error. Edificio no agregado.');
		window.location='../pages/addedf.php'</script>";
	}
?>