<?php
include_once 'app/conexion.inc.php';
include_once 'app/fotos.inc.php';
include_once 'app/controlSesion.inc.php';
include_once 'app/Redireccion.inc.php';
Conexion::abrir_conexion();
if(isset($_FILES["imagen"])&&!Empty($_FILES["imagen"])){
$foto=new RepositorioFoto();
$foti=$_FILES["imagen"]["name"];
$ruta=$_FILES["imagen"]["tmp_name"];
$destino="imagenes/".$foti;
copy($ruta,$destino);
$foto -> agregar($_GET['id'],$destino,Conexion::obtener_conexion());}
Redireccion::redirigir(RUTA_EDITOR_PERFIL.'?ok=1');

