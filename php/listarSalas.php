<?php 
/*Conexion al servidor de mysql*/
include("../dll/conexionsql.php");
extract($_GET);
if(!isset($bandera)){
	/*Obtener los datos de db*/
	$sql="SELECT salas.idSalas, salas.idEdificio, salas.salNombre, salas.salLocalizacion, salas.salCapacidad, salas.salDescripcion, edificio.edfNombre from salas inner join edificio on salas.idEdificio = edificio.idEdificio";
	$ressql=mysql_query($sql,$con);
	$totdatos=mysql_num_rows($ressql);
	if($totdatos>0){
		echo "<table border='0' class='table table-hover'>";
		echo "<h3 class=\"azul\">Lista de Salas</h3>";
		echo "<tr>";
		echo "<th scope='col'>"."Nombre"."</th>";
		echo "<th scope='col'>"."Descripción"."</th>";
		echo "<th scope='col'>"."Capacidad(Personas)"."</th>";
		echo "<th scope='col'>"."edificio"."</th>";
		echo "<th scope='col'>"."Localización"."</th>";
		echo "<th scope='col'>"."Editar"."</th>";
		echo "<th scope='col'>"."Eliminar"."</th>";
		echo "</tr>";
		while ($row=mysql_fetch_array($ressql)) {
			echo "<tr class='filas'>";
			echo "<td>".$row['salNombre']."</td>";
			echo "<td><textarea rows=\"2\" readonly disabled cols=\"10\">".$row['salDescripcion']."</textarea></td>";	
			echo "<td>".$row['salCapacidad']."</td>";
			echo "<td>".$row['edfNombre']."</td>";
			echo "<td>".$row['salLocalizacion']."</td>";
			echo "<td>
			<a href='actSala.php?id=".base64_encode($row['idSalas'])."'>
				<i class='icon-pencil'></i>
			</a>
		</td>";
		echo "<td>
		<a href='../php/listarSalas.php?id=".base64_encode($row['idSalas'])."&bandera=1'>
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
	$sql1="SELECT resEvento FROM  reserva WHERE idSalas='$id'";
	
	$ressql=mysql_query($sql1,$con);
	$totdatos=mysql_num_rows($ressql);
	if($totdatos>0){
		echo "<script>alert ('Sala en uso, No se puede eliminar');
		window.location='../pages/addsala.php';</script>";
	}else{
		$sql="delete from salas where idSalas='$id'";
		if($ressql=mysql_query($sql,$con)){
			echo "<script>alert ('Sala eliminada');
			window.location='../pages/addsala.php';</script>";
		}else{
			echo "<script>alert ('Error. Sala no eliminada');
			window.location='../pages/addsala.php';</script>";
		}
	}
}
}
mysql_close($con);
?>