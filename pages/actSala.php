<?php 
include ("../dll/bloqueDeSeguridad.php");
require "../dll/conexion.php";
$objeConexion = new Conexion();
include ("../dll/conexionsql.php");
extract($_GET);
$id=base64_decode($id);
/*Obtener los datos de db*/
$sql="SELECT salas.idSalas, salas.idEdificio, salas.salNombre, salas.salLocalizacion, salas.salCapacidad, salas.salDescripcion, 
edificio.edfNombre from salas inner join edificio on salas.idEdificio = edificio.idEdificio where salas.idSalas = '$id'";
$ressql=mysql_query($sql,$con);
$totdatos=mysql_num_rows($ressql);
if($totdatos>0){

	while ($row=mysql_fetch_array($ressql)) {
		$id_reg=$row['idSalas'];
		$idEdificio=$row['idEdificio'];
		$salNombre=$row['salNombre'];
		$salLocalizacion=$row['salLocalizacion'];
		$salCapacidad=$row['salCapacidad'];
		$salDescripcion=$row['salDescripcion'];
		$edfNombre=$row['edfNombre'];
	}
}else{
	echo "No hay datos!!";
}
?>

<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="boot/img/favicon.png">

	<title>UTPL|Reserva de Salas|Administrador</title>
	<!-- Utpl theme-->
	<link href="../UtplCss/login.css" rel="stylesheet">
	<link href="../UtplCss/internas.css" rel="stylesheet">

</head>



<body>
	<!--========================ENCABEZADO================================ -->
	
	<header>

		<section class="encabezado">
			<div class="logo">
				<a href="www.utpl.edu.ec"><img src="http://www.utpl.edu.ec/sites/all/themes/utpl/images/logo.png"></img></a>
			</div>
			<div class="tituloPag" id="clickeable" onclick="location.href='../index.php';" style="cursor:pointer;">
				<h1 > 
					reserva de salas
				</h1>
			</div>
		</section>

	</header>

	<!--==========================FIN ENCABEZADO============================== -->


	<div class="contenedor">
		<?php 
		include ("../php/menu_admin.php");
		?>
		<section id="content">

			<table class="table">
				<tbody>
					<tr>
						<td> <center>   
							<form class="form-horizontal" name="sala" action="../php/actSala.php?id=<?php echo base64_encode($id_reg) ?>" method="POST">
								<h3 class="azul">Editar Sala:</h3>
								<table>
									<tbody>
										<tr>
											<td><label class="control-label">Nombre:</label></td>
											<td>
												<input name="nombre" type="text" class="uneditable-input"  value="<?php echo "$salNombre"; ?>">
											</td>
										</tr>
										<tr>
											<td><label class="control-label">Edificio:</label></td>
											<td><select required name="edificio2">
												<option value="<?php echo $idEdificio?>" selcted><?php echo $edfNombre?></option>
												<?php 
												$query = "select * from edificio";
												$result = mysqli_query($objeConexion->conectarse(), $query) or die(mysqli_error());;
												while($row = mysqli_fetch_array($result)){
													?>
													<option value="<?php echo $row["idEdificio"]; ?>"> 
														<?php echo $row["edfNombre"]; ?> 
													</option>
													<?php
												}
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td><label class="control-label">Localización:</label></td>
										<td><input name="locaEdf2" type="text" placeholder="Localización de la sala" required value="<?php echo $salLocalizacion;?>"></td>
									</tr>
									<tr>
										<td><label class="control-label">Capacidad:</label></td>
										<td><input name="capacidad2" type="text" placeholder="Capacidad de la sala" required value="<?php echo $salCapacidad;?>"</td>
									</tr>
									<tr>
										<td><label class="control-label">Descripción:</label></td>
										<td><textarea name="descripSala2" rows="3" required><?php echo $salDescripcion;?></textarea></td>
									</tr>
									<tr>
										<td></td>
										<td>
											<center><button class=" btn btn-primary" type="submit"> Guardar </button>
												<button class="btn btn-danger" type="reset"> Limpiar </button>
                            					<input class="btn btn-warning" type="button" name="Cancelar" value="Cancelar" onClick="location.href='../index.php'">
											</center></td>
											<td></td>
										</tr>
									</tbody>
								</table>
							</form>
						</center>
					</td>
				</tr>	
			</tbody>	
		</table>
		<?php
		include("../php/listarSalas.php");
		?>
	</div>      
</div>
</section>
</div>

<!--==========================FIN CONTENEDOR============================== -->

<!-- FOOTER
	======================================================== -->
	<footer>


		<div class="containerdiv">          
			<div id="cc">
				<a href="http://creativecommons.org/licenses/by-nc-nd/3.0/ec/" target="_blank"><img src="http://www.utpl.edu.ec/sites/all/themes/utpl/images/cc.jpg"></a>
			</div>  
			<div id="contactinfo">  
				<p>San Cayetano Alto  - Loja Ecuador - Línea Gratuita: 1800 8875 8875</p>
			</div>
			<div id="q">  
				Unidad de Gestión de la Comunicación<br>
				Comunicación Digital
			</div>        
		</div>
	</footer>
	<!-- FIN FOOTER======================================================== -->


</body>
</html>