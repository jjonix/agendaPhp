<?php 
require "../dll/conexion.php";
$objeConexion = new Conexion();
?>
<!DOCTYPE html>
<?php 
include ("../dll/bloqueDeSeguridad.php");

?>

<html>

<head>
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="boot/img/favicon.png">

	<title>UTPL|Reserva de Salas|Administrador</title>
	<!-- Utpl theme-->
	<link href="../UtplCss/tema.css" rel="stylesheet">
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
							<form class="form-horizontal" name="edificio" action="../php/addEdf.php" method="POST">
								<fieldset>
								<legend>Agregar Edificio</legend>
								<table>
									<tbody>
										<tr>
											<td><label class="control-label">Nombre del Edificio:</label></td>
											<td><input name="nomEdf3" type="text" placeholder="Nombre del Edificio" required></td>
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
									<p></p>
									</fieldset>
								</form>
							</center>
						</td>
					</tr>	
				</tbody>	
			</table>
			<?php
			include("../php/listarEdf.php");
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