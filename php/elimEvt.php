<?php
extract($_GET);
include("../dll/conexionsql.php");
if($bandera==1){
	
	$sql="delete from reserva where idReserva='$id'";
	if($ressql=mysql_query($sql,$con)){
		echo "<script>alert('Reserva eliminada.');
		location.href='../index.php'</script>";
	}else{
		echo "<script>alert('Error. Reserva no eliminada.');
		location.href='../index.php'</script>";
	}
	

}else{
	if($id==0){
		echo "<script>alert(\"No hay repeticiones\");</script>";
	}else{
		$sql="delete from reserva where idRepeticion='$id'";
		if($ressql=mysql_query($sql,$con)){
			echo "<script>alert('Reserva con repeticiones eliminada.');
			location.href='../index.php'</script>";
		}
		else{
			echo "<script>alert('Error. Reserva no eliminada.');
			location.href='../index.php'</script>";
		}
	}
	echo "<script>location.href='../index.php'</script>";
}
?>