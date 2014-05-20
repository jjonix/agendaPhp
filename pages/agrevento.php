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
    <script language="javascript" src="http://code.jquery.com/jquery.js"></script>
    <script language="javascript">
        $(document).ready(
            function(){
                $("#edificio").change(function () {
                   $("#edificio option:selected").each(function () {
                    elegido=$(this).val();
                    $.post("../php/retornaSalas.php", { elegido: elegido }, function(data){
                        $("#salas").html(data);
                    });            
                });
               })
            });
    </script>
    <script language="javascript">
    function validarForm(formulario) {
        //valida si es una fecha anterior
        dia = document.getElementById("dia").value;
        mes = document.getElementById("mes").value;
        annio = document.getElementById("annio").value;
        fecha_texto = mes+"/"+dia+"/"+annio;
        fechaRes= new Date();
        fechaRes.setTime(Date.parse(fecha_texto));
        var fechaAct = new Date();
        if(fechaRes<fechaAct){
            alert('No se pueden agregar reservas de fechas anteriores');
            return false;
        }
        

        //valida duracion del evento
        if (!formulario.todoDia.checked){
            masHora=0;
            indexM=formulario.minutos.selectedIndex;
            min1=parseInt(formulario.minutos.options[indexM].value);
            //alert(min1);
            indexMd=formulario.minutosDur.selectedIndex;
            min2=parseInt(formulario.minutosDur.options[indexMd].value);
            //alert(min2);
            indexH=formulario.hora.selectedIndex;
            hora1=parseInt(formulario.hora.options[indexH].value);
            //alert(hora1);
            indexHd=formulario.horaDur.selectedIndex;
            hora2=parseInt(formulario.horaDur.options[indexHd].value);
            //alert(hora2);
            if(min2==0 && hora2==0){
                alert('Seleccione una duración válida');
                return false;
            }else{
                sumMin=min1+min2;
                if(sumMin>59){
                     masHora=sumMin/60;
                     masHora=((masHora*1) << 0) / 1;
                    sumMin=sumMin-(masHora*60);
                }
                sumHora=hora1+hora2;
                totHora=sumHora+masHora;
                if(totHora>24){
                    alert('Seleccione Bien la duración sobrepasa el tiempo disponible para este dia '+totHora+':'+sumMin);  
                    return false;
                }else{
                    if(totHora==24 && sumMin>0){
                    alert('Seleccione Bien la duración sobrepasa el tiempo disponible para este dia '+totHora+':'+sumMin);  
                    return false;
                    }
                }
            }
        }

        //Valida seleccion de salas
        lista = formulario.salas;
        opciones = lista.options;
        for (i=0;i<opciones.length;i++) {
            if (opciones[i].selected == true ) {
                if(opciones[i].value=='null'){
                    alert('Realice bien su seleccion de salas');
                    lista.focus();
                    return false;
                }
            }
        }
        if(!document.getElementById('nsemana').checked && !document.getElementById('ning').checked ){
        //valida si la fecha tope es anterior a la fecha inicio
        dia = document.getElementById("dia").value;
        mes = document.getElementById("mes").value;
        annio = document.getElementById("annio").value;
        diaTop = document.getElementById("diaTop").value;
        mesTop = document.getElementById("mesTop").value;
        annioTop = document.getElementById("anioTop").value;
        fecha_texto = mes+"/"+dia+"/"+annio;
        fecha_texto_Top = mesTop+"/"+diaTop+"/"+annioTop;
        fechaRes= new Date();
        fechaRes.setTime(Date.parse(fecha_texto));
        fechaResTop= new Date();
        fechaResTop.setTime(Date.parse(fecha_texto_Top));
        if(fechaResTop<=fechaRes){
            alert('La fecha tope no puede ser menor o igual a la fecha de inicio');
            return false;
        }
        }


        return true;
    }
    </script>
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
        <form class="form-horizontal" name="evento" action="../php/addEvt.php" method="POST" onsubmit="return validarForm(this);">
                <div id="padre" class="limpiar">
                    <fieldset>
                        <legend>Agregar Evento</legend>
                        <div class="bloque">
                            <div class="fila limpiar">                         
                                <div class="etiqueta">
                                    <label class="control-label">Evento:</label>
                                </div>
                                <div class="ingreso">
                                    <input name="nomEv" type="text" placeholder="Nombre del evento" required>
                                </div>
                            </div>
                            
                            <div class="fila limpiar">                        
                                <div class="etiqueta">  
                                    <label class="control-label">Persona Responsable:</label>                      
                                </div>
                                <div class="ingreso">  
                                    <input type="text" placeholder="Nombre de la persona responsable:" name="perRes" required>                      
                                </div>
                            </div>
                            <div class="fila limpiar">                         
                                <div class="etiqueta">
                                    <label class="control-label">Extensión:</label>
                                </div>
                                <div class="ingreso">
                                    <input type="text" placeholder="Número de extensión telefónica:" name="telfExt" id="telfExt" required>
                                </div>
                            </div>

                            <div class="fila limpiar">                        
                                <div class="etiqueta">
                                    <label class="control-label">Unidad que organiza:</label>
                                </div>
                                <div class="ingreso"> 
                                    <input type="text" placeholder="Nombre de la unidad:" name="uniOrg" required>                      
                                </div>
                            </div>
                            <div class="fila limpiar">                        
                                <div class="etiqueta"> 
                                    <label class="control-label">Fecha:</label>                       
                                </div>
                                <div class="ingreso">  
                                    <select name="dia" id="dia" style="width:55px;">
                                        <?php
                                        if(isset($_GET['day'])){
                                            echo '<option value="'.$_GET['day'].'" selected>'.$_GET['day'].'</option>';
                                        }

                                        for ($i=1; $i<=31; $i++) {
                                            if ($i == date('j')){
                                                if(!isset($_GET['day'])){
                                                    echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                                }else{
                                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                                }
                                            }else
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                        ?>
                                    </select>
                                    <select name="mes" id="mes" style="width:65px;">
                                        <?php
                                        if(isset($_GET['month'])){
                                            echo '<option value="'.$_GET['month'].'" selected>'.$_GET['month'].'</option>';
                                        }
                                        for ($i=1; $i<=12; $i++) {
                                            if ($i == date('m')){
                                                if(!isset($_GET['month'])){
                                                    echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                                }
                                            }else
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                        ?>
                                    </select>

                                    <select name="anio" id="annio" style="width:91px;">
                                        <?php
                                        if(isset($_GET['year'])){
                                            echo '<option value="'.$_GET['year'].'" selected>'.$_GET['year'].'</option>';
                                        }
                                        for($i=date('o'); $i<=date('o')+10; $i++){
                                            if ($i == date('o')){
                                                if(!isset($_GET['year'])){
                                                    echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                                }
                                            }else
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                        ?>
                                    </select>                      
                                </div>
                            </div>
                            <div class="fila limpiar">                        
                                <div class="etiqueta">
                                    <label class="control-label">Duración:</label>
                                </div>
                                <div class="ingreso"> 
                                    <span>HH:</span>
                                    <select name="horaDur" style="width:55px;" id="horaDur"disabled>
                                        <?php
                                        for ($i=0; $i<=23; $i++) {
                                            if ($i == 0)
                                                echo '<option value="'.$i.'" selected>'.sprintf("%02s",$i).'</option>';
                                            else
                                                echo '<option value="'.$i.'">'.sprintf("%02s",$i).'</option>';
                                        }
                                        ?>
                                    </select>
                                    <span>MM:</span>
                                    <select name="minutosDur" style="width:65px;" id="minutosDur" disabled>
                                        <?php
                                        for ($i=00; $i<=59; $i=$i+10) {
                                            if ($i == 0)
                                                echo '<option value="'.$i.'" selected>'.sprintf("%02s",$i).'</option>';
                                            else
                                                echo '<option value="'.$i.'">'.sprintf("%02s",$i).'</option>';
                                        }
                                        ?>
                                    </select>
                                    Todo el día: <input type="checkbox" id="todoDia" checked value="allDay" name="todoDia" onclick="habilita0();document.evento.horaDur.disabled=!document.evento.horaDur.disabled;document.evento.minutosDur.disabled=!document.evento.minutosDur.disabled">
                                </div>
                            </div>
                            <div class="fila limpiar">                         
                                <div class="etiqueta">
                                    <label class="control-label">Hora inicio:</label>
                                </div>
                                <div class="ingreso">
                                    <span> HH: </span>
                                    <select name="hora" style="width:55px;" id="hora" disabled>
                                        <?php
                                        for ($i=6; $i<=23; $i++) {
                                            if ($i == 6)
                                                echo '<option value="'.$i.'" selected>'.sprintf("%02s",$i).'</option>';
                                            else
                                                echo '<option value="'.$i.'">'.sprintf("%02s",$i).'</option>';
                                        }
                                        ?>
                                    </select>
                                    <span> MM:</span>
                                    <select name="minutos" style="width:65px;" id="minutos" disabled>
                                        <?php
                                        for ($i=00; $i<=59; $i=$i+10) {
                                            if ($i == 0)
                                                echo '<option value="'.$i.'" selected>'.sprintf("%02s",$i).'</option>';
                                            else
                                                echo '<option value="'.$i.'">'.sprintf("%02s",$i).'</option>';
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>

                            <div class="fila limpiar">                        
                                <div class="etiqueta"> 
                                    <label class="control-label">Edificios:</label>                      
                                </div>
                                <div class="ingreso"> 
                                    <select name="edificio" id="edificio">
                                        <option selected=""></option>
                                        <?php
                                        include("../dll/conexionsql.php");
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
                                </div>
                            </div>
                            <div class="fila limpiar">                        
                                <div class="etiqueta"> 
                                    <label class="control-label">Salas:</label>                      
                                </div>
                                <div class="ingreso"> 
                                    <select id="salas" multiple name="salas[]">
                                    </select>                      
                                </div>
                            </div>
                        </div> 
                        

                        <div class="bloque">
                            <div class="fila limpiar">                        
                                <div class="etiqueta"> 
                                    <label class="control-label">Tipo:</label>                      
                                </div>
                                <div class="ingreso">  
                                    <select name="tipo">
                                        <option value="interna">Interna</option>
                                        <option value="externa">Externa</option>
                                    </select>                     
                                </div>
                            </div>
                            <script>

                                function habilita0(){ 
                                    document.evento.hora.disabled=!document.evento.hora.disabled; 
                                    document.evento.minutos.disabled = !document.evento.minutos.disabled ; 
                                } 
                                function habilita2(){ 
                                    document.evento.diaTop.disabled = false; 
                                    document.evento.mesTop.disabled = false; 
                                    document.evento.anioTop.disabled = false; 
                                } 

                                function habilita1(){ 
                                    document.evento.diaTop.disabled = true; 
                                    document.evento.mesTop.disabled = true; 
                                    document.evento.anioTop.disabled = true;

                                } 
                                function habilita3(){ 
                                    document.evento.nsemanas.disabled = false;

                                } 
                                function habilita4(){ 
                                    document.evento.rep_day1.disabled = false;
                                    document.evento.rep_day1.checked = false;
                                    document.evento.rep_day2.disabled = false;
                                    document.evento.rep_day2.checked = false;
                                    document.evento.rep_day3.disabled = false;
                                    document.evento.rep_day3.checked = false;
                                    document.evento.rep_day4.disabled = false;
                                    document.evento.rep_day4.checked = false;
                                    document.evento.rep_day5.disabled = false;
                                    document.evento.rep_day5.checked = false;
                                    document.evento.rep_day6.disabled = false;
                                    document.evento.rep_day6.checked = false;
                                    document.evento.rep_day0.disabled = false;
                                    document.evento.rep_day0.checked = false;

                                }
                                function habilita5(){ 
                                    document.evento.rep_day1.disabled = true;
                                    document.evento.rep_day2.disabled = true;
                                    document.evento.rep_day3.disabled = true;
                                    document.evento.rep_day4.disabled = true;
                                    document.evento.rep_day5.disabled = true;
                                    document.evento.rep_day6.disabled = true;
                                    document.evento.rep_day0.disabled = true;

                                } 
                                
                            </script> 
                            <div class="fila limpiar">                        
                                <div class="etiqueta"> 
                                    <label class="control-label">Tipo Repeticion:</label>                      
                                </div>
                                <div class="ingreso"> 
                                    <input id="ning" type="RADIO" checked value="0" name="rep_type" onclick="habilita1();habilita5()">
                                    Ninguna
                                    <input type="RADIO" value="1" name="rep_type" onclick="habilita2();habilita5()">
                                    Diaria
                                    <input type="RADIO" value="2" name="rep_type" onclick="habilita2();habilita4()">
                                    Semanal<br>
                                    <input type="RADIO" value="3" name="rep_type" onclick="habilita2();habilita5()">
                                    Mensual
                                    <input type="RADIO" value="4" name="rep_type" onclick="habilita2();habilita5()">
                                    Anual
                                    <input id="nsemana"type="RADIO" value="5"  name="rep_type" onclick="habilita1(); habilita3();habilita5();">
                                    n-Semanas
                                    <br>
                                </div>
                            </div>
                            <div class="fila limpiar">                        
                                <div class="etiqueta">  
                                    <label class="control-label">Fecha tope de repetición:</label>                     
                                </div>
                                <div class="ingreso">  
                                    <select name="diaTop" id="diaTop" style="width:55px;" disabled="true">
                                        <?php
                                        for ($i=1; $i<=31; $i++) {
                                            if ($i == date('j'))
                                                echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                            else
                                                echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                        ?>
                                    </select>
                                    <select name="mesTop" id="mesTop" style="width:65px;" disabled="true">
                                        <?php
                                        for ($i=1; $i<=12; $i++) {
                                            if ($i == date('m'))
                                                echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                            else
                                                echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                        ?>
                                    </select>

                                    <select name="anioTop" id="anioTop" style="width:91px;" disabled="true">
                                        <?php
                                        for($i=date('o'); $i<=date('o')+5; $i++){
                                            if ($i == date('o'))
                                                echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                            else
                                                echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                        ?>
                                    </select>                     
                                </div>
                            </div>
                            <div class="fila limpiar">                        
                                <div class="etiqueta">
                                    <label class="control-label">Día de repetición:</label>                       
                                </div>
                                <div class="ingreso">   
                                    <p>
                                        <span><input type="CHECKBOX" name="rep_day1" disabled="true">  Lunes </span>
                                        <span><input type="CHECKBOX" name="rep_day2" disabled="true"> Martes</span>
                                        <span><input type="CHECKBOX" name="rep_day3" disabled="true"> Miércoles</span>
                                    </p>
                                    <p>
                                        <span><input type="CHECKBOX" name="rep_day4" disabled="true"> Jueves</span>
                                        <span><input type="CHECKBOX" name="rep_day5" disabled="true"> Viernes</span>
                                        <span><input type="CHECKBOX" name="rep_day6" disabled="true"> Sábado </span>
                                    </p>
                                    <p>                                        
                                        <span><input type="CHECKBOX" name="rep_day0" disabled="true"> Domingo</span>
                                    </p>
                                </div>
                            </div>
                            <div class="fila limpiar">                        
                                <div class="etiqueta">
                                    <label class="control-label">Número de semanas:</label>                       
                                </div>
                                <div class="ingreso">  
                                    <input type="text" placeholder="n - semanas" name="nsemanas" disabled="true">                     
                                </div>
                            </div>
                            <div class="fila limpiar">                        
                                <center><button class=" btn btn-primary" type="submit"> Guardar </button>
                                    <button class="btn btn-danger" type="reset"> Limpiar </button>
                                    <input class="btn btn-warning" type="button" name="Cancelar" value="Cancelar" onClick="location.href='../index.php'">
                                </center>
                            </div>
                        </div>
                    </fieldset> 
                </div>
            </form>
        </section>
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="../boot/js/bootstrap.min.js"></script>
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