<?php
include_once 'app/conexion.inc.php';
include_once 'app/fotosAuto.inc.php';
include_once 'app/controlSesion.inc.php';
include_once 'app/Redireccion.inc.php';
Conexion::abrir_conexion();
if(isset($_FILES["imagen"])&&!Empty($_FILES["imagen"])){
$foto=new RepositorioFotoAuto();
$foti=$_FILES["imagen"]["name"];
$ruta=$_FILES["imagen"]["tmp_name"];
$destino="imagenesAuto/".$foti;
copy($ruta,$destino);
$foto -> agregar($_GET['patente'],$destino,Conexion::obtener_conexion());}
Redireccion::redirigir(RUTA_EDITOR_AUTO.'?ok=1&patente='.$_GET['patente']);