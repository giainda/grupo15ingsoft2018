<?php
include_once "app/repositorioCalificacion.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/Conexion.inc.php";
include_once "plantillas/documento-declaracion.inc.php";
include_once "plantillas/navbar2.inc.php";
Conexion::abrir_conexion();
if(!ControlSesion::sesion_iniciada()){
    Redireccion::redirigir(SERVIDOR);
}

$calificaciones=repositorioCalificacion::calificacion_idUsuario(Conexion::obtener_conexion(),$_SESSION['id_usuario']);

?>
<div class="container contenedorasd">
<div class="card color1">
        <div class="card-heading color1">
            <h1>Calificaciones</h1>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <?php
            if (empty($calificaciones)) {
                echo "<h3>no hay calificaciones</h3>";
            }
            ?>
            <?php
            foreach ($calificaciones as $pos) {
                ?>
                <div class="row">

                    <div class="col-md-12">
                        <br>
                        <h3><?php
                            $cant = 1;
                            echo $pos->getTexto();
                            ?></h3>  
                        <hr>           
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
