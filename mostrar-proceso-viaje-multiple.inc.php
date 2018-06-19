<?php
include_once "app/viaje.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/ControlSesion.inc.php";
include_once "plantillas/documento-declaracion.inc.php";
include_once "plantillas/navbar2.inc.php";
include_once "app/viajeProgramado.inc.php";
include_once "app/repositorioViajeProgramado.inc.php";
include_once "app/repositorioViaje.inc.php";
include_once "app/repositorioViajePertenece.inc.php";
if (!ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(SERVIDOR);
}
$ok = 0;
Conexion::abrir_conexion();
$arreglo = $_SESSION['array'];
$viaje = $arreglo[0];
if (isset($_POST['agregar'])) {
    Redireccion::redirigir(RUTA_AGREGAR_FECHA);
}
if (isset($_POST['cancelar'])) {
    Redireccion::redirigir(SERVIDOR);
}
if (isset($_POST['enviar'])) {
    $min = '';
    $max = '';
    $fechas = array();
    foreach ($arreglo as $viaje) {
        $fechas[] = $viaje->getFechaInicio();
    }
    $max = max($fechas);
    $min = min($fechas);
    $viajeProgramado = new ViajeProgramado('', $min, $max, 1);
    $idP = RepositorioViajeProgramado::insertar_viaje(Conexion::obtener_conexion(), $viajeProgramado);
    foreach ($arreglo as $viaje) {
        $idV = RepositorioViaje::insertar_viaje2(Conexion::obtener_conexion(), $viaje);
        RepositorioViajePertenece::crearRelacion(Conexion::obtener_conexion(), $idP, $idV);
    }
    Redireccion::redirigir(SERVIDOR);
}
?>


<div class="container ">
    <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title"><?php echo "<h2>Viaje desde: ", $viaje->getInicio(), ", Hasta: ", $viaje->getDestino(), "<h2>"; ?></h5>
            <div class="row">

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text"><?php echo "<h4>precio total: </h4> $", $viaje->getPrecio(); ?> </p>
                        </div> 
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text"><?php echo "<h4>Descripcion: </h4>", $viaje->getDescripcion(); ?> </p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <?php
            $cant = 1;
            foreach ($_SESSION['array'] as $vi) {
                ?>   
                <div class="row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text"><?php echo "<h4>Fecha ingresada N°" . $cant . ": </h4>", $vi->getFechaInicio(); ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $cant = $cant + 1;
            }
            ?>   
        </div> 
    </div>
    <?php
    if (count($_SESSION['array']) > 1) {
        ?>
        <br>
        <div class="card text-center">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                    </div>

                    <form role="form" method="post" >
                        <button type="submit"class="btn botoncss" name="enviar" onclick="location.href = '<?php echo RUTA_MOSTRAR_PROCESO_VIAJE_MULTIPLE ?>';" >Confirmar</button>       
                        <button class="btn botoncss" name="agregar"onclick="location.href = '<?php echo RUTA_AGREGAR_FECHA ?>';">Agregar fecha</button>
                        <button class="btn botoncss" name="cancelar"onclick="location.href = '<?php echo SERVIDOR ?>';">Cancelar</button>

                </div>
            </div>
        </div>



        <?php
    } else {
        ?>
        <br>
        <div class="card text-center">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-3">
                        <a href="<?php echo RUTA_AGREGAR_FECHA ?>" class="btn botoncss form-control color1">Agregar fecha</a>       
                    </div>
                    <div class="col-md-3">
                        <a href="<?php echo SERVIDOR ?>" class="btn botoncss form-control color1">Cancelar</a>       
                    </div>
                </div>
                <br>

            </div>
        </div>
<?php } ?>
    <br>


</div>
<?php
include_once "plantillas/documento-cierre.inc.php";
