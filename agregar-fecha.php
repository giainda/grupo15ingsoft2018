<?php
include_once "app/repositorioViaje.inc.php";
include_once "app/ControlSesion.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/Redireccion.inc.php";
include_once "plantillas/documento-declaracion.inc.php";
include_once "plantillas/navbar2.inc.php";
include_once "app/ValidadorFechaMultiple.inc.php";
Conexion::abrir_conexion();
if (!ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(SERVIDOR);
}
$arregloViajes = $_SESSION['array'];

if (isset($_POST['cancelar'])) {
    Redireccion::redirigir(RUTA_MOSTRAR_PROCESO_VIAJE_MULTIPLE . "?ok=2");
}
if (isset($_POST['enviar'])) {
    $viaje = $arregloViajes[0];
    $fecha = new dateTime($viaje->getFechaInicio());
    $arr = getDate($fecha->getTimestamp());
    $new = date("Y-m-d H:i", strtotime('+' . $arr['hours'] . ' hours', strtotime($_POST['fecha'])));
    $new = date("Y/m/d H:i", strtotime('+' . $arr['minutes'] . ' minutes', strtotime($new)));

    $validador = new ValidadorFechaMultiple($arregloViajes, $new, $viaje->getDuracion(), $viaje->getPatente(), Conexion::obtener_conexion());
    if ($validador->registro_valido()) {
        $viajeNue = new Viaje('', $_SESSION['id_usuario'], $viaje->getPatente(), '', $new, $viaje->getInicio(), $viaje->getDestino(), $viaje->getAsientos(), $viaje->getPrecio(), $viaje->getDescripcion(), 2, 1, $viaje->getDuracion(),0);
        $arregloViajes[] = $viajeNue;
        $_SESSION['array'] = $arregloViajes;
        Redireccion::redirigir(RUTA_MOSTRAR_PROCESO_VIAJE_MULTIPLE . "?ok=1");
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <form role="form" method="post" >
                        <label>Nueva fecha</label>
                        <input type="date" name="fecha" class="form-control">
<?php
if (isset($_POST['enviar'])) {
    $validador->mostrar_error_fecha_inicio();
}
?>
                        <button type="submit"class="btn botoncss" name="enviar" onclick="location.href = '<?php echo RUTA_AGREGAR_FECHA ?>';" >Agregar</button>       
                        <button class="btn botoncss" name="cancelar"onclick="location.href = '<?php echo RUTA_MOSTRAR_PROCESO_VIAJE_MULTIPLE ?>';">Cancelar</button>
                        <br>
                        <br>  
                    </form>
                </div>
            </div> 

        </div>



    </div>
</div>
<?php include_once "plantillas/documento-cierre.inc.php"; ?>

