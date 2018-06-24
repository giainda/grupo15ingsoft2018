<?php
include_once "plantillas/documento-declaracion.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/RepositorioConductor.inc.php";
include_once "app/RepositorioUsuario.inc.php";
include_once "app/ControlSesion.inc.php";
include_once "app/repositorioViaje.inc.php";

include_once "plantillas/navbar2.inc.php"
?>
<center>
    <img src="img/logo3.png" width="300" height="300" alt=""></a>           
</center>
<br>
<br>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-4">        
            <button data-toggle="modal" data-target="#dialogo3" class="button2 form-control">


                <h5 class="stroke">Buscar viaje</h5></button>
            <br>
        </div>
        <div class="col-md-4">
            <button class="button3 form-control"
            <?php
            if (ControlSesion::sesion_iniciada()) {
                if (!RepositorioConductor::esConductor(Conexion::obtener_conexion(), $_SESSION['id_usuario'])) {
                    ?>data-toggle="modal"  data-target="#dialogo1"<?php
                        } else {
                            $usuario=RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(),$_SESSION['id_usuario']);
                            if($usuario->getCodigo_tarjeta()==0){
                                ?> onclick="location.href = '<?php echo RUTA_INGRESO_TARJETA ?>';" <?php   
                            }else{
                            ?> onclick="location.href = '<?php echo RUTA_SELECCION_TIPO_VIAJE ?>';" <?php
                        }} /* este inicio de modal sera remplazado por onclick="location.href='<php RUTA_CREAR_VIAJE ?>';" */
                    } else {
                        ?> data-toggle="modal" data-target="#dialogo1" <?php }
                    ?> ><h5 class="stroke"> Crear viaje</h5></button>
        </div>

    </div>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <a href"#" class='btn botoncss form-control'data-toggle='collapse' data-target='#infoviaje'>
               <h5> <i class="fas fa-caret-down"></i> Viajes creados recientemente <i class="fas fa-caret-down"></i> </h5>
            </a>
            <br>
            <br>
        </div>
    </div>
    <div id='infoviaje'class='collapse'>     
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <?php
                $viajes = RepositorioViaje::viajesCreadosResientes(Conexion::obtener_conexion());
                foreach ($viajes as $pos) {
                    ?>
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title"><?php
                                echo "Viaje desde: ", $pos->getInicio(), " Hasta: ", $pos->getDestino();
                                if ($pos->getTipoViaje() == 2) {
                                    echo " (Viaje programado)";
                                }
                                ?></h5>
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
                                    <a href="<?php echo RUTA_DETALLE_VIAJE . "?idViaje=" . $pos->getId() ?>" class="btn botoncss">Ver Viaje</a>
                                </div>    
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div> 
    <?php if (!ControlSesion::sesion_iniciada() || !RepositorioConductor::esConductor(Conexion::obtener_conexion(), $_SESSION['id_usuario'])) { ?>
        <div class="modal fade" id="dialogo1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- cabecera del diálogo -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">X</button>
                    </div>

                    <!-- Eliminar cuenta -->
                    <div class="modal-body">
                        <?php if (!ControlSesion::sesion_iniciada()) {
                            ?><h3>Debe <a href="<?php echo RUTA_LOGIN ?>">iniciar sesion</a> para usar esta funcionalidad</h3> <?php
                        } else {
                            if (!RepositorioConductor::esConductor(Conexion::obtener_conexion(), $_SESSION['id_usuario'])) {
                                ?><h3> Debe registrar un auto y convertirse en conductor para usar esta funcionalidad</h3><?php
                            }
                        }
                        ?>  
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- este modal en el futuro se borrara, es solo para decir que la funcionalidad no esta implementada todabia -->
    <?php
    if (ControlSesion::sesion_iniciada()) {
        if (RepositorioConductor::esConductor(Conexion::obtener_conexion(), $_SESSION['id_usuario'])) {
            ?>
            <div class="modal fade" id="dialogo2">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- cabecera del diálogo -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">X</button>
                        </div>


                        <div class="modal-body">
                            <h3>esta funcionalidad todavía no esta disponible  </h3> 
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }
    ?>
    <!-- este modal en el futuro se borrara, es solo para decir que la funcionalidad no esta implementada todabia -->
    <div class="modal fade" id="dialogo3">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- cabecera del diálogo -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">X</button>
                </div>


                <div class="modal-body">
                    <h3>esta funcionalidad todavia no esta disponible  </h3> 
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-center" id="dialogo4">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- cabecera del diálogo -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">X</button>
                </div>


                <div class="modal-body">
                    <h3>Para crear un viaje usted no debe tener pagos pendientes ni calificaciones pendientes  </h3> 
                </div>
            </div>
        </div>
    </div>        


    <?php
    include_once "plantillas/documento-cierre.inc.php";
    if (isset($_GET['cod'])) {
        ?>
        <script>$('#dialogo4').modal('show');</script><?php } ?> 
    <script>$('#infoviaje').on('shown.bs.collapse', function () {
            $('html, body').animate({
                scrollTop: $("#infoviaje").offset().top
            }, 500);
        });</script>
