<?php 
include ("../dll/bloqueDeSeguridad.php");
require "../dll/conexion.php";
$objeConexion = new Conexion();
include ("../dll/conexionsql.php");
extract($_GET);
/*Obtener los datos de db*/
$id=base64_decode($id);
$sql="SELECT * from usuario where idUsuario = '$id'";
$ressql=mysql_query($sql,$con);
$totdatos=mysql_num_rows($ressql);
if($totdatos>0){

	while ($row=mysql_fetch_array($ressql)) {
		$idUsuario=$row[0];
		$noCedula=$row[1];
		$usrNombre=$row[2];
		$usrApellido=$row[3];
		$usrCorreo=$row[4];
		$usrContrasena=$row[5];
		$usrUsuario=$row[6];
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


	<!--=========================CONTENEDOR=============================== -->


	<div class="contenedor">
		<?php 
		include ("../php/menu_admin.php");
		?>
		<section id="content">
			
			<table class="table">
				<tbody>
					<tr>
						<td> <center>   
							<form class="form-horizontal" name="edificio" action="../php/actUsr.php?id=<?php echo base64_encode($idUsuario) ?>" method="POST">
								<h3>Editar Usuarios:</h3>
								<table>
									<tbody>
											<tr>
												<td><label class="control-label">N° de Cédula:</label></td>
												<td><input name="noCedula" type="text" placeholder="Número de Cédula" required value="<?php echo $noCedula; ?>"></td>
											</tr>
											<tr>
												<td><label class="control-label">Nombre:</label></td>
												<td><input type="text" placeholder="Nombres:" name="usrNombre" required value="<?php echo $usrNombre; ?>"></td>
											</tr>
											<tr>
												<td><label class="control-label">Apellidos:</label></td>
												<td><input type="text" placeholder="Apellidos:" name="usrApellido" required value="<?php echo $usrApellido; ?>"></td>
											</tr>
											<tr>
												<td><label class="control-label" for="inputEmail">Email</label></td>
												<td><input type="text" name="usrCorreo" placeholder="E-mail del Usuario" required value="<?php echo $usrCorreo; ?>"></td>
											</tr>
											<tr>
												<td><label class="control-label">Usuario:</label></td>
												<td><input type="text" placeholder="usuario login:" name="usrUsuario" required value="<?php echo $usrUsuario; ?>"></td>
											</tr>
											<tr>
												<td><label class="control-label">Contraseña:</label></td>
												<td><input type="password" name="usrContrasena" placeholder="contraseña login" required ></td>
											</tr>
											<tr>
											<td>
											<center>
												<button class=" btn btn-primary" type="submit"> Guardar </button>
												<button class="btn btn-danger" type="reset"> Limpiar </button>
												<input class="btn btn-warning" type="button" name="Cancelar" value="Cancelar" onClick="location.href='../index.php'">

											</center>
											</td>
											</tr>
											
										</tbody>
									</table>
									<p></p>
								</form>
							</center>
						</td>
					</tr>	
				</tbody>	
			</table>
			<?php
			include("../php/listarUsr.php");
			?>

		</section>
	</div>
	<!--==========================FIN CONTENEDOR============================== -->

	<!-- FOOTER	======================================================== -->
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