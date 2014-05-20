<?php
extract($_POST);
extract($_GET);
$id=base64_decode($id);
include("../dll/conexionsql.php");

function nomSalas($idSal,$idEdf) 
{
	//sql para consulta del  nombre de la sala y del edificio
	$sql2="SELECT salas.idEdificio, 
	salas.salNombre,
	edificio.edfNombre 
	from salas 
	inner join edificio on salas.idEdificio = edificio.idEdificio 
	where salas.idSalas = '$idSal' AND salas.idEdificio = '$idEdf'";
	//Importar datos de conexion a la base de datos
	include("../dll/conexionsql.php");
	//Ejecutar SQL
	$ressql=mysql_query($sql2,$con);
	while ($row=mysql_fetch_array($ressql)) {
		//se guarda en una variable el nombre de la sala y del edificio
		$txt= $row['salNombre']." localizada en el edificio ".$row['edfNombre'];
		//se retorna la variable
		return $txt;	
	}
}
	/*Obtener los datos de db*/
	$resFecha=sprintf("%02s",$dia)."-".sprintf("%02s",$mes)."-".$anio;
	if(isset($hora)){
		$resH=sprintf("%02s",$hora);
		$resM=sprintf("%02s",$minutos);
		$resAllDay=0;
		$resDur=new DateTime(''.$hora.':'.$minutos.':00');
		$resDurH=sprintf("%02s",$horaDur);
		$resDurM=sprintf("%02s",$minutosDur);
		$resDur->add(new DateInterval('PT'.$resDurH.'H'.$minutosDur.'M'));
		$resDurH=date_format($resDur, 'H');
		$resDurM=date_format($resDur, 'i');
		//Se almacena la hora de inicio en formato DATE
		$horaTemp=new DateTime(''.$resH.':'.$resM.':00');
	}else{
		$resH="00";
		$resM="00";
		$resDurH="00";
		$resDurM="00";
		$resAllDay=1;
	}

$sql="SELECT idReserva, resEvento, resResponsable FROM reserva WHERE  resAllDay = 1 AND resFecha = '$resFecha' AND idSalas = '$idSalas' AND idEdificio='$idEdificio' AND idReserva<>$id ";
$ressql=mysql_query($sql,$con);
$totdatos=mysql_num_rows($ressql);
if($totdatos>0){

	echo "<script>alert ('Existe un evento todo el dia');
	window.location='../pages/index.php';
</script>";
}else{
	$sql="SELECT idReserva, resEvento, resResponsable, resH, resM, resDurH,resDurM FROM reserva WHERE  resFecha = '$resFecha' AND idSalas = '$idSalas' AND idEdificio='$idEdificio' AND idReserva<>$id ORDER BY resH";
	$ressql=mysql_query($sql,$con);
	$totdatos=mysql_num_rows($ressql);
	$band= 0;
	$fechRes="";
	if(!isset($todoDia)){
		if($totdatos>0){
			$log="";
			while ($row=mysql_fetch_array($ressql) AND $band==0) {
				$horaResTemp=new DateTime(''.$row['resH'].':'.$row['resM'].':00');
				$horaResDurTemp=new DateTime(''.$row['resDurH'].':'.$row['resDurM'].':00');
				if ($horaTemp>$horaResTemp AND $horaTemp<$horaResDurTemp) {
					$band = $band+1;
					$log = " ".$log.$fechRes."en  ". nomSalas($idSalas,$idEdificio)."";
				}else{
				}
				if($band==0){
					if ($resDur>$horaResTemp AND $resDur<$horaResDurTemp) {
						$band = $band+1;
						$log = " ".$log.$fechRes."en  ". nomSalas($idSalas,$idEdificio)."";
						
					}else{
					}
				}
				if($band==0){
					if ($horaTemp<$horaResTemp AND $horaResTemp<$resDur) {
						$band = $band+1;
						$log = " ".$log.$fechRes."en  ". nomSalas($idSalas,$idEdificio)."";
						
					}else{
					}
				}
				if($band==0){
					if ($horaTemp<$horaResDurTemp AND $horaResDurTemp<$resDur) {
						$band = $band+1;
						$log = " ".$log.$fechRes."en  ". nomSalas($idSalas,$idEdificio)."";
						
					}else{
					}
				}
			}
		}
	}else{
		if($totdatos>0){
			$band = $band+1;
		}
	}
	if($band==0){
		$sql="update reserva set 
				resEvento='$resEvento',
				resResponsable='$resResponsables',
				resExtension='$resExtension',
				resUnidad='$resUnidad',
				resFecha='$resFecha',
				resH='$resH',
				resM='$resM',
				resDurH='$resDurH',
				resDurM='$resDurM',
				resAllDay='$resAllDay',
				idEdificio='$idEdificio',
				idSalas='$idSalas',
				resTipo='$resTipo'
				where idReserva='$id'";
		if($ressql=mysql_query($sql,$con)){
			echo "<script> alert('Reserva actualizada.');
			window.location='../index.php'</script>";
		}else{
			echo "<script> alert('Error.Reserva no actualizada.');
			window.location='../index.php'</script>";
		}
	}else{
		if(isset($todoDia)){
			echo "<script>alert('Ya existe una reserva en este día');</script>";

		}else{
			echo "<script>alert('ya existe una reserva en ese horario el día: $log');</script>";
		}
	}
}
echo "<script> window.location='../index.php'</script>";
