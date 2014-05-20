<?php
// Conexión a la base de datos y seleccion de registros


function nomSalas($idSal,$idEdf,$con) 
{
  //sql para consulta del  nombre de la sala y del edificio
  $sql2="SELECT salas.idEdificio, 
  salas.salNombre,
  edificio.edfNombre 
  from salas 
  inner join edificio on salas.idEdificio = edificio.idEdificio 
  where salas.idSalas = '$idSal' AND salas.idEdificio = '$idEdf'";
  //Ejecutar SQL
  $ressql=mysql_query($sql2,$con);
  while ($row=mysql_fetch_array($ressql)) {
    //se guarda en una variable el nombre de la sala y del edificio
    $txt= $row['salNombre']." - ".$row['edfNombre'];
    //se retorna la variable
    return $txt;  
  }
}


if(isset($sala)!=0){
  $sql = "SELECT * FROM reserva where idSalas=".$sala."";
}else{
  $sql = "SELECT * FROM reserva";
}
$cont=0;
$resulset = mysql_query($sql, $con);

$totdatos=mysql_num_rows($resulset);

while ($obj = mysql_fetch_object($resulset)) {
  if(utf8_encode($obj->resAllDay)==true){
    $dur="true";
    $resDuracion1="00:00:00";
  }else{
    $dur="false";
    $resDuracion1=$obj->resDurH.":".$obj->resDurM.":00";
  }
  $cont=$cont+1;
  echo '{
    id: \''.$obj->idReserva.'\',
    title: \''.utf8_encode($obj->resEvento).' : '.nomSalas($obj->idSalas,$obj->idEdificio,$con).'\',
    allDay:'.$dur.',
    start: new Date('.substr(utf8_encode($obj->resFecha), 6).',
      '.substr(utf8_encode($obj->resFecha), 3,2).'-1,
      '.substr(utf8_encode($obj->resFecha), 0,2).',
      '.utf8_encode($obj->resH).',
      '.utf8_encode($obj->resM).',
      00),
    end: \''.substr(utf8_encode($obj->resFecha), 6).'-'.substr(utf8_encode($obj->resFecha), 3,2).'-'.substr(utf8_encode($obj->resFecha), 0,2).'T'.$resDuracion1.'\',
    color: \'#FDBE0F\',
    textColor: \'black\',
    url:'.(($loc=='index')?' \'pages/descEvt2.php?idEvento=':' \'descEvt.php?idEvento=').$obj->idReserva.'\'
}';
if ($cont < $totdatos)
  echo ',';
}

?>

