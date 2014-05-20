<?php 
/*Conexion al servidor de mysql*/
include("../dll/conexionsql.php");
extract($_GET);
if(!isset($bandera)){
	/*Obtener los datos de db*/
	$sql="SELECT * FROM usuario";
	$ressql=mysql_query($sql,$con);
	$totdatos=mysql_num_rows($ressql);
	if($totdatos>0){
		echo "<table border='0' class='table table-hover'>";
		echo "<h3 class=\"azul\">Lista de Usuarios</h3>";
		echo "<tr>";
		echo "<th scope='col'>"."Num Cédula"."</th>";
		echo "<th scope='col'>"."Nombre"."</th>";
		echo "<th scope='col'>"."Apellido"."</th>";
		echo "<th scope='col'>"."Correo"."</th>";
		echo "<th scope='col'>"."Usuario"."</th>";
		echo "<th scope='col'>"."Editar"."</th>";
		echo "<th scope='col'>"."Eliminar"."</th>";
		echo "</tr>";
		while ($row=mysql_fetch_array($ressql)) {
			if($row[0]!=1){
				echo "<tr class='filas'>";
				echo "<td>".$row[1]."</td>";
				echo "<td>".$row[2]."</td>";
				echo "<td>".$row[3]."</td>";
				echo "<td>".$row[4]."</td>";
				echo "<td>".$row[6]."</td>";
				echo "<td>
				<a href='actUsr.php?id=".base64_encode($row[0])."'>
					<i class='icon-pencil'></i>
				</a>
			</td>";
			echo "<td>
			<a href='../php/listarUsr.php?id=".base64_encode($row[0])."&bandera=1'>
				<i class='icon-trash'></i>
			</a>
		</td>";
		echo "</tr>";
	}	
}
echo "</table";
}else{
	echo "No hay datos!!";
}
}else{
	if($bandera==1){
		$id=base64_decode($id);
		$sql="delete from usuario where idUsuario='$id'";
		$ressql=mysql_query($sql,$con);
		header ("Location: ../pages/addUsr.php");
	}
}
mysql_close($con);
?>