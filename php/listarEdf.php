<?php 
/*Conexion al servidor de mysql*/
include("../dll/conexionsql.php");
extract($_GET);
if(!isset($bandera)){
	/*Obtener los datos de db*/
	$sql="SELECT idEdificio, edfNombre, usrCorreo FROM edificio";
	$ressql=mysql_query($sql,$con);
	$totdatos=mysql_num_rows($ressql);
	if($totdatos>0){
		echo "<table border='0' class='table table-hover'>";
		echo "<h3 class=\"azul\">Lista de Edificios</h3>";
		echo "<tr>";
		echo "<th scope='col'>"."Nombre"."</th>";
		echo "<th scope='col'>"."Correo Administrador"."</th>";
		echo "<th scope='col'>"."Editar"."</th>";
		echo "<th scope='col'>"."Eliminar"."</th>";
		echo "</tr>";
		while ($row=mysql_fetch_array($ressql)) {
			echo "<tr class='filas'>";
			echo "<td>".$row['edfNombre']."</td>";
			echo "<td>".$row['usrCorreo']."</td>";
			echo "<td>
			<a href='actEdf.php?id=".base64_encode($row['idEdificio'])."'>
				<i class='icon-pencil'></i>
			</a>
		</td>";
		echo "<td>
		<a href='../php/listarEdf.php?id=".base64_encode($row['idEdificio'])."&bandera=1'>
			<i class='icon-trash'></i>
		</a>
	</td>";
	echo "</tr>";	
}
echo "</table";
}else{
	echo "No hay datos!!";
}
}else{
if($bandera==1){
	$id=base64_decode($id);
	$sql1="SELECT resEvento FROM  reserva WHERE idEdificio='$id'";
	
	$ressql=mysql_query($sql1,$con);
	$totdatos=mysql_num_rows($ressql);
	if($totdatos>0){
		echo "<script>alert ('Edificio en uso, No se puede eliminar');
		window.location='../pages/addEdf.php';</script>";
	}else{
		$sql="delete from edificio where idEdificio='$id'";
		if($ressql=mysql_query($sql,$con)){
			echo "<script>alert ('Edificio eliminado');
			window.location='../pages/addEdf.php';</script>";		
		}else{
			echo "<script>alert ('Error. Edificio no eliminado');
			window.location='../pages/addEdf.php';</script>";
		}
	}
}
}
mysql_close($con);
?>