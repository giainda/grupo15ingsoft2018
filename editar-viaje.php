<?php
include_once "app/repositorioAuto.inc.php";
include_once "app/repositorioConductor.inc.php";
include_once "app/repositorioUsuario.inc.php";
include_once "app/repositorioTiene.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/ControlSesion.inc.php";
include_once "app/config.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/ValidadorAuto.inc.php";
include_once "app/ValidadorEditorViajeUnico.inc.php";
include_once "app/repositorioViaje.inc.php";

include_once "plantillas/documento-declaracion.inc.php";
include_once "plantillas/navbar2.inc.php";
if (!ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(SERVIDOR);
}
if(!isset($_GET['idVi'])){
    Redireccion::redirigir(SERVIDOR);
}
$viaje=RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(),$_GET['idVi']);
$conductor = RepositorioConductor::obtener_conductor_por_id(Conexion::obtener_conexion(), $_SESSION['id_usuario']);
$ok = 0;
Conexion::abrir_conexion();
if (isset($_POST['enviar'])) {
    $validador = new ValidadorEditorViajeUnico($viaje->getId(),$_POST['origen'], $_POST['destino'], $_POST['fecha'], $_POST['duracion'], $_POST['precio'], $_POST['descripcion'], $_POST['vehiculo'], Conexion::obtener_conexion());

    if ($validador->registro_valido()) {
        $auto = RepositorioAuto::obtener_por_patente(Conexion::obtener_conexion(), $validador->obtener_vehiculo());
        $viajeh = new Viaje($viaje->getId(), $_SESSION['id_usuario'], $validador->obtener_vehiculo(), $viaje->getFechaCreacion(), $validador->obtener_fecha_inicio(), $validador->obtener_ciudad_origen(), $validador->obtener_ciudad_destino(), $auto->getCapasidad(), $validador->obtener_precio_total(), $validador->obtener_descripcion(), 1, 1, $validador->obtener_duracion(),0);
        RepositorioViaje::editarViaje(Conexion::obtener_conexion(), $viajeh);
        $ok = 1;
    }
}
?>
<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
        <div class="container margen ">
            <div class="card text-center">
                <div class="card-heading">
                    <h3 class="panel-tittle">Editar viaje</h3>
                </div>
                <div class="card-body">
                    <form role="form" method="post" action="<?php RUTA_EDITOR_VIAJE_UNICO."?idVi=".$viaje->getId(); ?>">
<?php
if (isset($_POST['enviar'])) {
    include_once 'plantillas/registro-viaje-unico-validado.inc.php';
} else {
    include_once 'plantillas/editar-viaje-unico-vacio.inc.php';
}
?>

                    </form>

                </div>
            </div>
        </div>
    </div>                

</div>
<div class="modal fade" id="dialogoCorrecto" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- cabecera del diálogo -->
            <div class="modal-header">
                <a type="button" class="btn btn-primary ml-auto" href="<?php echo RUTA_DETALLE_VIAJE."?idViaje=".$viaje->getId()?>" >X</a>
            </div>

            <!-- cuerpo del diálogo -->
            <div class="modal-body">
                <h4>El viaje fue editado con exito</h4>
                <br>
                <br>
            </div>


        </div>
    </div>
</div>









<?php
include_once "plantillas/documento-cierre.inc.php";
if ($ok) {
    ?>
    <script>$('.modal').modal('show');</script>
<?php }
?> 
