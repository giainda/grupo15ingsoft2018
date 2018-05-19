<?php
include_once 'app/Conexion.inc.php';
include_once 'app/config.inc.php';
include_once 'app/redireccion.inc.php';
include_once 'app/repositorioUsuario.inc.php';
include_once 'app/repositorioViaje.inc.php';
include_once 'app/repositorioViaja.inc.php';
include_once 'app/repositorioPostula.inc.php';
include_once 'app/controlSesion.inc.php';
include_once 'app/repositorioAuto.inc.php';
include_once 'app/repositorioTiene.inc.php';
include_once 'app/repositorioConductor.inc.php';
include_once 'app/fotos.inc.php';
include_once 'app/repositorioCalificacionPendiente.inc.php';
include_once 'app/repositorioPagoPendiente.inc.php';

include_once 'plantillas/documento-declaracion.inc.php';
if (!ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(SERVIDOR);
}



Conexion::abrir_conexion();
$usuario = RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(), $_SESSION['id_usuario']);

if (RepositorioConductor::esConductor(Conexion::obtener_conexion(), $usuario->getId())) {
    $conductor = RepositorioConductor::obtener_conductor_por_id(Conexion::obtener_conexion(), $usuario->getId());
}

include_once 'plantillas/navbar2.inc.php';
?>
<div class="container contenedorasd">
    <div class="row">
        <div class="col-md-4"> 
            <div class="card">
                <?php
                $imagen = "img/usuario.jpg";
                $foto = new RepositorioFoto();
                if ($foto->esta(Conexion::obtener_conexion(), $_SESSION['id_usuario'])) {
                    $imagen = $foto->recuperarFoto($_SESSION['id_usuario'], Conexion::obtener_conexion());
                }
                ?>
                <img class="card-img-top" src="<?php echo $imagen ?>" alt="Card image cap">            
                <div class="card-body text-center">
                    <h4 class="card-title">Nombre:<?php
                        if (!empty($usuario)) {
                            echo ' ', $usuario->getNombre(), ' ', $usuario->getApellido();
                        }
                        ?></h4>

                    <a href="<?php echo RUTA_EDITOR_PERFIL ?> " class="btn botoncss form-control color1">Editar Perfil</a>
                    <br>
                    <br>
                    <a href="#" class="btn botoncss form-control color1"data-toggle="modal" data-target="#dialogo1">Ver mis autos</a>
                    <br>
                    <br>
                    <a href="#" class="btn botoncss form-control color1">Agregar auto</a>
                    <br>
                    <br>
                    <a href="#" class="btn botoncss form-control color1"data-toggle="modal" data-target="#dialogo3">Eliminar cuenta</a>
                    <br>
                    <br>
                    <div class="modal fade" id="dialogo3">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- cabecera del diálogo -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Eliminacion de cuenta</h4>
                                    <button type="button" class="close" data-dismiss="modal">X</button>
                                </div>

                                <!-- Eliminar cuenta -->
                                <div class="modal-body">
                                    <?php
                                    if (!RepositorioViaja::viaja(Conexion::obtener_conexion(), $usuario->getId()) && !RepositorioCalificacionPendiente::debeCalificacion(Conexion::obtener_conexion(), $usuario->getId()) && !RepositorioPagoPendiente::debePago(Conexion::obtener_conexion(), $usuario->getId())&&!RepositorioViaje::tieneViaje(Conexion::obtener_conexion(),$usuario->getId())) {
                                        echo "Usted esta habilitado para eliminar su cuenta,
                                            ¿Esta seguro de que decea hacerlo?";
                                        ?> <div class="row">
                                            <div class= "col-md-6">
                                                <button onclick="location.href = '<?php echo RUTA_ELIMINAR_CUENTA ?>';"class="botoncss form-control">Si</button>
                                            </div>
                                            <div class= "col-md-6">
                                                <button class="botoncss form-control" data-dismiss="modal">No</button>
                                            </div>
                                        </div>  <?php
                                    } else {
                                        $error = "no puede borrar su cuenta: <br>";
                                        if (RepositorioViaja::viaja(Conexion::obtener_conexion(), $usuario->getId())) {
                                            $error = $error . "tiene viajes pendientes <br>";
                                        }
                                        if(RepositorioViaje::tieneViaje(Conexion::obtener_conexion(),$usuario->getId())){
                                            $error = $error . "tiene por lo menos un viaje creado <br>";
                                        }
                                        
                                        if (RepositorioCalificacionPendiente::debeCalificacion(Conexion::obtener_conexion(), $usuario->getId())) {
                                            $error = $error . "tiene calificaciones pendientes <br>";
                                        }
                                        if (RepositorioPagoPendiente::debePago(Conexion::obtener_conexion(), $usuario->getId())) {
                                            $error = $error . "tiene pagos pendientes <br>";
                                        }
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
                                       
                    <br>
                    <br>
                    <div class="modal fade" id="dialogo1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <!-- cabecera del diálogo -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Mis autos</h4>
                                    <button type="button botoncss " class="close" data-dismiss="modal">X</button>
                                </div>

                                <!-- cuerpo del diálogo -->
                                <div class="modal-body">
                                    <?php
                                    $tiene = RepositorioTiene::autos_idConductor(Conexion::obtener_conexion(), $_SESSION['id_usuario']);
                                    foreach ($tiene as $pos) {
                                        if ($pos->getActivo()) {
                                            $auto = RepositorioAuto::obtener_por_patente(Conexion::obtener_conexion(), $pos->getPatente());
                                            ?>
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo "Patente: ", $auto->getPatente(), ", tipo: ", $auto->getTipo(); ?></h5>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <p class="card-text"><?php echo "<h4>marca: </h4>", $auto->getMarca(); ?> </p>
                                                                </div> 
                                                            </div>
                                                        </div>  
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <p class="card-text"><?php echo "<h4>modelo: </h4>", $auto->getModelo(); ?> </p>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <p class="card-text"><?php echo "<h4>capasidad: </h4>", $auto->getCapasidad(); ?> </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <p class="card-text"><?php echo "<h4>color: </h4>", $auto->getColor(); ?> </p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
        <?php
    }
}
?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="col-md-8 text-center">
            <div class="card color1">
                <div class="card-heading color1">
                    <h1>Información</h1>
                </div>
            </div>
            <p class="card-text text-center">

                <?php
                if (!empty($usuario)) {
                    echo "<h4>calificaciones como pasajero: </h4><br><h3>Positivas: ", $usuario->getCalificacionPos(), '<br>Negativas: ',$usuario->getCalificacionNeg(),'<h3>';
                    ?>
                    <br>
                    <br>
    <?php
    if (RepositorioConductor::esConductor(Conexion::obtener_conexion(), $usuario->getId())) {

        echo "<h4>calificaciones como conductor: </h4><br><h3>Positivas: ", $conductor->getCalificacionPos(), '<br>Negativas: ',$conductor->getCalificacionNeg(),'<h3>';
        ?>
                        <br>
                        <br>
                        <?php
                    }
                    echo "<h4>Correo: </h4><h3>", $usuario->getCorreo(), "</h3>";
                    ?>
                    <br>
                    <br>
                    <?php
                    echo "<h4>nacimiento: </h4><h3>", $usuario->getFechanac(), "</h3>";
                    ?>
                    <br>
                    <br>
                    <?php
                    if($usuario->getCodigo_Tarjeta()!=0){
                    echo "<h4>tarjeta: </h4><h3>", "********".substr($usuario->getCodigo_Tarjeta(),8,12), "</h3>";
                    
                    ?>
                    <br>
                    <br><?php }
    
    if (RepositorioConductor::esConductor(Conexion::obtener_conexion(), $usuario->getId())) {
    echo "<h4>fondos: </h4><h3>", $usuario->getFondos(), "</h3>";}
}
?>         
            </p>
        </div>
        <a href"#" class='btn botoncss form-control' data-toggle='collapse' data-target='#infoviaje'>
           <h5> Información de mis viajes </h5>
            <i class="fas fa-caret-down"></i>
        </a>
        <br>
        <br>
    </div>

    <div id='infoviaje' class='collapse'>
        <br>
        <br>                  
        <h3 id="titulo">Viajes a los que me postulé: </h3>
        <?php
        $postulado = RepositorioPostula::viajes_postulado_idUsuario(Conexion::obtener_conexion(), $_SESSION['id_usuario']);
        foreach ($postulado as $pos) {
            if ($pos->getEliminado()) {
                $viaje = RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(), $pos->getIdViaje());
                ?>
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo "Viaje desde: ", $viaje->getInicio(), ", Hasta: ", $viaje->getDestino(); ?></h5>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-text"><?php echo "<h4>precio total: </h4> $", $viaje->getPrecio(); ?> </p>
                                    </div> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-text"><?php echo "<h4>fecha : </h4>", $viaje->getFechaInicio(); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">

                            </div>
                            <div class="col-md-3">
                                <a href="#" class="btn botoncss">Ver Viaje</a>
                            </div>    
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        <h3 id="titulo">Viajes en los que fui aceptado: </h3>
<?php
$viaja = RepositorioViaja::viajes_viaja_idUsuario(Conexion::obtener_conexion(), $_SESSION['id_usuario']);
foreach ($viaja as $pos) {
    $viaje = RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(), $pos->getIdViaje());
    ?>
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title"><?php echo "Viaje desde: ", $viaje->getInicio(), " Hasta: ", $viaje->getDestino(); ?></h5>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-text"><?php echo "<h4>precio total: </h4> $", $viaje->getPrecio(); ?> </p>
                                </div> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-text"><?php echo "<h4>fecha: </h4>", $viaje->getFechaInicio(); ?> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">

                        </div>
                        <div class="col-md-3">
                            <a href="#" class="btn botoncss">Ver Viaje</a>
                        </div>    
                    </div>
                </div>
            </div>
            <?php
        }if (RepositorioConductor::esConductor(Conexion::obtener_conexion(), $usuario->getId())) {
            ?>

            <h3 id="titulo">Viajes creados por mi: </h3>
    <?php
    $viajes = RepositorioViaje::viajes_por_idConductor(Conexion::obtener_conexion(), $_SESSION['id_usuario']);
    foreach ($viajes as $pos) {
        ?>
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo "Viaje desde: ", $pos->getInicio(), " Hasta: ", $pos->getDestino(); ?></h5>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-text"><?php echo "<h4>precio total: </h4> $", $pos->getPrecio(); ?> </p>
                                    </div> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-text"><?php echo "<h4>fecha: </h4>", $pos->getFechaInicio(); ?> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">

                            </div>
                            <div class="col-md-3">
                                <a href="#" class="btn botoncss">Ver Viaje</a>
                            </div>    
                        </div>
                    </div>
                </div>
        <?php
    }
}
?>
    </div>
</div>

</div>
</div>





<?php
include_once 'plantillas/documento-cierre.inc.php';
