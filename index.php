
<?php
include('dll/conexionsql.php');
extract($_GET);
session_start();
if (isset($_SESSION['autenticado'])){
    header("Location: pages/index.php");}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="boot/img/favicon.png">
	<link href="UtplCss/tema.css" rel="stylesheet">

	<title>UTPL|Reserva de Salas|Administrador</title>
	<!-- Utpl theme-->


	<!--=========================calendario=============================== -->
	<link rel='stylesheet' type='text/css' href='dll/fullcalendar/fullcalendar.css' />
	<script type='text/javascript' src='dll/fullcalendar/jquery.min.js'></script>
	<script type='text/javascript' src='dll/fullcalendar/fullcalendar.js'></script>
	<script type='text/javascript' src='dll/fullcalendar/fullcalendar.min.js'></script>
	<script type='text/javascript' src='dll/fullcalendar/jquery-ui.custom.min.js'></script>
	
	<script>

		$(document).ready(function() {

			var date = new Date();
			var d = date.getDate();
			var m = date.getMonth();
			var y = date.getFullYear();

			var calendar = $('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				},
				editable: true,
				events: [
				<?php
				$loc="index";
				include("dll/conexionsql.php");
				include("php/jsonCal.php");
				?>	

				]
			});

		});

	</script>
<script>
	$(document).ready(function(){
		$("#edificio").change(function () {
			$("#edificio option:selected").each(function () {
				elegido=$(this).val();
				$.post("php/retornaSalas.php", { elegido: elegido }, function(data){
					$("#salas").html(data);
				});            
			});
		})
	});
</script>
<!--=============================calendario=========================== -->
</head>

<body>
	<!--========================ENCABEZADO================================ -->

	<header>

		<section class="encabezado">
			<div class="logo">
				<a href="http://www.utpl.edu.ec"><img src="http://www.utpl.edu.ec/sites/all/themes/utpl/images/logo.png"></img></a>
			</div>
			<div class="tituloPag" id="clickeable" onclick="location.href='index.php';" style="cursor:pointer;">
				<h1 > 
					reserva de salas
				</h1>
			</div>
		</section>

	</header>

	<!--==========================FIN ENCABEZADO============================== -->


	<!--=========================CONTENEDOR=============================== -->


	<div class="contenedor">
		<!--================================Menu======================== -->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<p class="brand" href="#" style="color: ;">Calendario <?php if(isset($sala)){echo '- '.$name;}?></p>
					<div class="nav-collapse">
						<ul class="nav" style="float:right;">
							<li>
								<form class="form-inline" style="margin-top:5px;" action="index.php" method="post">
									<label>Edificio:</label>
									<select name="edificio" id="edificio" style="width:150px">
										<option selected="">Seleccione</option>
										<?php
										include("dll/conexionsql.php");
										$sql="SELECT idEdificio, edfNombre FROM edificio";
										$ressql=mysql_query($sql,$con);
										$totdatos=mysql_num_rows($ressql);
										if($totdatos>0){
											while($row=mysql_fetch_array($ressql)){
												echo "<option value=\"".$row['idEdificio']."\">".$row['edfNombre']."</option>";
											}
										}else{
											echo "<option>No hay datos</option>";
										}
										?>
									</select>
									<label>Sala:</label>
									<select id="salas" name="salas" style="width:150px" onchange="location.href='index.php?sala='+salas.options[salas.selectedIndex].value+'&name='+salas.options[salas.selectedIndex].text;">
										<option selected=""> Seleccione</option>
									</select>
								</form>
							</li>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									Ir al día:
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li style="margin-top:10px;">
										<form action="index.php" method="post" name="irAlDia" class="form-horizontal">
											<table>
												<tbody>


													<tr>
														<td>
															<label>Día:</label>
														</td>
														<td>
															<select name="diaB" style="width:55px;">
																<?php
																for ($i=1; $i<=31; $i++) {
																	if ($i == date('j'))
																		echo '<option value="'.$i.'" selected>'.$i.'</option>';
																	else
																		echo '<option value="'.$i.'">'.$i.'</option>';
																}
																?>
															</select>
														</td>
														<td>
															<label>Mes:</label>
														</td>
														<td>
															<select name="mesB" style="width:100px;">
																<option value="" selected>Mes</option>
																<option value="0">Enero</option>
																<option value="1">Febrero</option>
																<option value="2">Marzo</option>
																<option value="3">Abril</option>
																<option value="4">Mayo</option>
																<option value="5">Junio</option>
																<option value="6">Julio</option>
																<option value="7">Agosto</option>
																<option value="8">Septiembre</option>
																<option value="9">Octubre</option>
																<option value="10" >Noviembre</option>
																<option value="11">Diciembre</option>
															</select>
														</td>
														<td>
															<label>Año:</label>
														</td>
														<td>
															<select name="anioB" style="width:100px;">
																<?php
																for($i=date('o')+10; $i>=1980; $i--){
																	if ($i == date('o'))
																		echo '<option value="'.$i.'" selected>'.$i.'</option>';
																	else
																		echo '<option value="'.$i.'">'.$i.'</option>';
																}
																?>
															</select>
														</td>
													</tr>
													<tr>
														<td colspan="6">
															<center>
																<input style="width:100px; margin-top:5px; " type="button" onclick="var indice = document.irAlDia.diaB.selectedIndex; var d=document.irAlDia.diaB.options[indice].value;indice = document.irAlDia.mesB.selectedIndex; var m=document.irAlDia.mesB.options[indice].value;indice = document.irAlDia.anioB.selectedIndex; var a=document.irAlDia.anioB.options[indice].value;$('#calendar').fullCalendar('gotoDate', a,m, d);" value="Ir" />
															</center>
														</td>
													</tr>

												</tbody>
											</table>
										</form>
									</li>
								</ul>
							</li>
							<li ><a href="pages/buscador.php"><i class="icon-search"></i>Buscador</a></li>
							<li><a  href="pages/login.php" style="color:#B32922;"><i class="icon-off"></i>Iniciar Sesión</a></li>						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>
		<!--==========================fin menu============================== -->
		<div id="calendar">

		</div>
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

	<script src="boot/js/bootstrap.min.js"></script>

</body>
</html>
