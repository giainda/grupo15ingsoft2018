<?php

include_once 'app/repositorioUsuario.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/config.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/Conexion.inc.php';

if (!ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(SERVIDOR);
}
Conexion::abrir_conexion();
RepositorioUsuario::eliminar($_SESSION['id_usuario'], Conexion::obtener_conexion());
ControlSesion::cerrar_sesion();
Redireccion::redirigir(SERVIDOR);
