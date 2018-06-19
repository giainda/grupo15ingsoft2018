<?php

include_once 'app/repositorioAuto.inc.php';
include_once 'app/repositorioTiene.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/config.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/Conexion.inc.php';
Conexion::abrir_conexion();
if (!ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(SERVIDOR);
}
if (isset($_GET['patente']) && !empty($_GET['patente'])) {
    $patente = $_GET['patente'];
} else {
    Redireccion::redirigir(SERVIDOR);
}
$auto = RepositorioAuto::obtener_por_patente(Conexion::obtener_conexion(), $patente);
if (!RepositorioTiene::existeRelacion(Conexion::obtener_conexion(), $_SESSION['id_usuario'], $auto->getPatente())) {
    Redireccion::redirigir(SERVIDOR);
}


Conexion::abrir_conexion();
RepositorioTiene::eliminar($auto->getPatente(), $_SESSION['id_usuario'], Conexion::obtener_conexion());
if (!RepositorioTiene::autoExisteRelacion(cONEXION::obtener_conexion(), $auto->getPatente())) {
    RepositorioAuto::eliminar($auto->getPatente(), Conexion::obtener_conexion());
}
Redireccion::redirigir(RUTA_PERFIL);
