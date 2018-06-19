<?php
include_once "app/RepositorioAuto.inc.php";
include_once "app/RepositorioTiene.inc.php";
include_once "app/Auto.inc.php";
include_once "app/ControlSesion.inc.php";
include_once "app/Conexion.inc.php";
include_once "plantillas/documento-declaracion.inc.php";
include_once "plantillas/navbar2.inc.php";
include_once "app/redireccion.inc.php";
include_once "app/repositorioViaje.inc.php";
include_once "app/fotosAuto.inc.php";
if (isset($_GET['patente']) && !empty($_GET['patente'])) {
    $patente = $_GET['patente'];
} else {
    Redireccion::redirigir(SERVIDOR);
}
$auto = RepositorioAuto::obtener_por_patente(Conexion::obtener_conexion(), $patente);
?>
<br>
<div class="container contenedorasd">
    <div class="row">
        <div class="col-md-4">
            <?php
            $imagen = "img/auto.jpg";
            $foto = new RepositorioFotoAuto();
            if ($foto->esta(Conexion::obtener_conexion(), $patente)) {
                $imagen = $foto->recuperarFoto($patente, Conexion::obtener_conexion());
            }
            ?>
            <img class="card-img-top"  src="<?php echo $imagen ?>" alt="Card image cap">
            <?php
            if (ControlSesion::sesion_iniciada()) {
                if (RepositorioTiene::existeRelacion(Conexion::obtener_conexion(), $_SESSION['id_usuario'], $auto->getPatente())) {
                    ?> 
                    <div class="card">
                        <div class="card-body">  
                            <a href="<?php echo RUTA_EDITOR_AUTO . "?patente=" . $auto->getPatente(); ?> " class="btn botoncss form-control color1">Editar vehículo</a>
                            <a href="#" class="btn botoncss form-control color1"data-toggle="modal" data-target="#dialogo3">Eliminar vehículo</a>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <div class="col-md-8 text-center"> 
            <div class="card color1 ">
                <div class="card-heading color1">
                    <h1>Información del vehículo</h1>
                </div>
            </div>          
            <div class="card-body text-center">
                <?php
                ?>
                <?php
                echo "<h4>Patente: </h4><h3>", $auto->getPatente(), "</h3>";
                ?>
                <br>
                <hr>
                <?php
                echo "<h4>Marca: </h4><h3>", $auto->getMarca(), "</h3>";
                ?>
                <br>
                <hr>
                <?php
                echo "<h4>Modelo: </h4><h3>", $auto->getModelo(), "</h3>";
                ?>
                <br>
                <hr>
                <?php
                echo "<h4>Capacidad: </h4><h3>", $auto->getCapasidad(), "</h3>";
                ?>
                <br>
                <hr>
                <?php
                echo "<h4>Color: </h4><h3>", $auto->getColor(), "</h3>";
                ?>
                <br>
                <hr>
            </div>


        </div>
    </div>
</div>
</div>
</div> 
<div class="modal fade" id="dialogo3">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- cabecera del diálogo -->
            <div class="modal-header">
                <h4 class="modal-title">Eliminación de vehículo</h4>
                <button type="button" class="close" data-dismiss="modal">X</button>
            </div>

            <!-- Eliminar auto -->
            <div class="modal-body">
                <?php
                if (!RepositorioViaje::autoTieneViajeId(Conexion::obtener_conexion(), $_SESSION['id_usuario'], $auto->getPatente())) {
                    echo "Usted esta habilitado para eliminar su vinculo con este vehículo,
                                            ¿Esta seguro de que desea hacerlo?";
                    ?> <div class="row">
                        <div class= "col-md-6">
                            <button onclick="location.href = '<?php echo RUTA_ELIMINAR_AUTO . "?patente=" . $auto->getPatente() ?>';"class="botoncss form-control">Si</button>
                        </div>
                        <div class= "col-md-6">
                            <button class="botoncss form-control" data-dismiss="modal">No</button>
                        </div>
                    </div>  <?php
                } else {
                    $error = "no puede borrar este vehículo: tiene al menos un viaje creado con este auto <br>";
                    ?>
                    <br><div class= 'alert alert-danger' role='alert'>
                        <?php echo $error;
                        ?>
                    </div>
                    <?php
                }
                ?>

            </div>
        </div>
    </div>
</div>  


<?php
include_once "plantillas/documento-cierre.inc.php";
