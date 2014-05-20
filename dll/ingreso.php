<?php

extract($_POST);
$link = mysql_connect('localhost', 'root', '');
if (!$link) {
die('Could not connect: ' . mysql_error());
}else{

//echo 'Conectado con éxito al servidor.';

if (!mysql_select_db("salasdb",$link)) 
   { 
     // echo "Error seleccionando la base de datos."; 
      exit(); 

   } else{
   	$password_original = $contrasena;
$password_codificado = md5($password_original);
$result=mysql_query("select usrUsuario, usrContrasena from usuario where usrUsuario = '$usuario' && usrContrasena = '$password_codificado'",$link);

if($row = mysql_fetch_array($result)) { 
 session_start();
$_SESSION["autenticado"]= "SI";
echo '<script language = JavaScript> location.href="../pages/agrevento.php" ; </script>';
   } else {
   	echo '<script language = JavaScript> location.href="../" ; </script>';
   }
   mysql_free_result($result);
}
}
mysql_close($link);
?>




