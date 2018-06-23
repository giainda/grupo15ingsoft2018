<?php
include_once "app/Redireccion.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/repositorioCalificacionPendiente.inc.php";
include_once "app/repositorioUsuario.inc.php";
include_once "plantillas/documento-declaracion.inc.php";
include_once "plantillas/navbar2.inc.php";
Conexion::abrir_conexion();
if(!ControlSesion::sesion_iniciada()){
    Redireccion::redirigir(SERVIDOR);
}

$calificacionesPendientes=repositorioCalificacionPendiente::calificacion_pendiente_idUsuario(Conexion::obtener_conexion(),$_SESSION['id_usuario']);

?>
<div class="container contenedorasd">
<div class="card color1">
        <div class="card-heading color1">
            <h1>Calificaciones pendientes</h1>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <?php
            if (empty($calificacionesPendientes)) {
                echo "<h3>no hay calificaciones pendientes</h3>";
            }
            ?>
            <?php
            foreach ($calificacionesPendientes as $pos) {
               $usuario=RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(),$pos->getIdUsuarioACalificar());
                ?>
                <div class="row">

                    <div class="col-md-8">
                        <br>
                        <h3><?php
                            $cant = 1;
                            echo "Debes calificar a: " .$usuario->getNombre() . " " . $usuario->getApellido();
                            ?></h3>  
                        <hr>           
                    </div>
                    <div class="col-md-4">
                        <div class="row">

                            <div class="col-md-12">
                            <?php $path='calificar.php?idPs='.$pos->getId(); ?>
                            <a href="<?php echo $path ?>" class="btn botoncss form-control color1">Calificar</a>
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

<?php 
include_once "plantillas/documento-cierre.inc.php";
