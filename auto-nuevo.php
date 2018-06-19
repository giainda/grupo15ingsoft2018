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

include_once "plantillas/documento-declaracion.inc.php";
include_once "plantillas/navbar2.inc.php";
if (!ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(SERVIDOR);
}
Conexion::abrir_conexion();
if (isset($_GET['patente']) && !empty($_GET['patente'])) {
    $patente = $_GET['patente'];
}
$ok = 0;
if (isset($_POST['enviar'])) {
    $validador = new ValidadorAuto($_POST['marca'], $_POST['modelo'], $_POST['capasidad'], $_POST['color']);

    if ($validador->auto_valido()) {
        $auto = new Auto($patente, $validador->obtener_marca(), $validador->obtener_modelo(), $validador->obtener_capasidad(), $validador->obtener_color(), $_POST['tipoAuto'], 1);
        RepositorioAuto::insertar_auto(Conexion::obtener_conexion(), $auto);
        if (!repositorioConductor::esConductor(Conexion::obtener_conexion(), $_SESSION['id_usuario'])) {
            RepositorioConductor::insertar_conductor(Conexion::obtener_conexion(), $_SESSION['id_usuario']);
        }
        RepositorioTiene::crearRelacion(Conexion::obtener_conexion(), $_SESSION['id_usuario'], $auto->getPatente());
        $ok = 1;
    }
}
?>
<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
        <div class="container contenedorasd">
            <div class="card text-center">
                <div class="card-heading">
                    <h3 class="panel-tittle">Introduce los datos del vehículo</h3>
                </div>
                <div class="card-body">
                    <form role="form" method="post" action="<?php echo RUTA_AUTO_NUEVO . '?patente=' . $_GET['patente']; ?>">
                        <?php
                        if (isset($_POST['enviar'])) {
                            include_once 'plantillas/registro_auto_validado.inc.php';
                        } else {
                            include_once 'plantillas/registro_auto_vacio.inc.php';
                        }
                        ?>

                    </form>

                </div>
            </div>
        </div>
    </div>                

</div>
<div class="modal fade" id="dialogoCorrecto">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- cabecera del diálogo -->
            <div class="modal-header">
                <a type="button" class="btn btn-primary ml-auto" href="<?php echo RUTA_PERFIL ?>" >X</a>
            </div>

            <!-- cuerpo del diálogo -->
            <div class="modal-body">
                <h4>El vehículo fue vinculado correctamente</h4>
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