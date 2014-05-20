<?php
include("../dll/conexionsql.php");
$sql="SELECT idSalas, salNombre FROM salas where idEdificio = \"".$_POST['elegido']."\"";
$ressql=mysql_query($sql,$con);
$totdatos=mysql_num_rows($ressql);
if($totdatos>0){
	echo '<option value="null" selected=""> Seleccione</option>';
    while($row=mysql_fetch_array($ressql)){
    	if($row['idSalas']==$_POST['sal']){
			echo "<option selected value=\"".$row['idSalas']."\">".$row['salNombre']."</option>";
		}else{
        echo "<option value=\"".$row['idSalas']."\">".$row['salNombre']."</option>";
    }
    }
}


?>