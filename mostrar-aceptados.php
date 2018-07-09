<?php
include_once "app/Conexion.inc.php";
include_once "app/repositorioUsuario.inc.php";
include_once "app/repositorioViaja.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/repositorioViaje.inc.php";
include_once "plantillas/documento-declaracion.inc.php";
include_once "plantillas/navbar2.inc.php";


if (!isset($_GET['idViaje'])) {
    Redireccion::redirigir(SERVIDOR);
}
$viaje = RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(), $_GET['idViaje']);
if (empty($viaje)) {
    Redireccion::redirigir(SERVIDOR);
}
if ($_SESSION['id_usuario'] !== $viaje->getIdConductor()) {
    Redireccion::redirigir(SERVIDOR);
}
$aceptados = RepositorioViaja::viaja_idViaje(Conexion::obtener_conexion(), $viaje->getId());
?>

<div class="container contenedorasd">
    <div class="card color1">
        <div class="card-heading color1">
            <h1>Pasajeros</h1>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <?php
            if (empty($aceptados)) {
                echo "<h3>no hay postulantes </h3>";
            }
            ?>
            <?php
            foreach ($aceptados as $pos) {
                $usuario = RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(), $pos->getIdUsuario());
                ?>
                <div class="row">

                    <div class="col-md-8">
                        <br>
                        <h3><?php
                            $cant = 1;
                            echo $usuario->getNombre() . " " . $usuario->getApellido();
                            ?></h3>  
                        <hr>           
                    </div>
                    <div class="col-md-4">
                        <div class="row">

                            <div class="col-md-12">
                            <button onclick="location.href = '<?php echo "eliminar-pasajero.inc.php?idViajeS=".$viaje->getId()."&&id_usuario=".$usuario->getId() ?>';"class="botoncss form-control">Eliminar</button>
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
</div>
<div class="modal fade" id="dialogo1">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- cabecera del diálogo -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">X</button>
            </div>


            <div class="modal-body">
              <h3>no implementado</h3>
            
            </div>
        </div>
    </div>
</div>





<?php
include_once "plantillas/documento-cierre.inc.php";



