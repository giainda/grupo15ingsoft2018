<?php
include_once "app/Conexion.inc.php";
include_once "app/ControlSesion.inc.php";
include_once "app/repositorioViaje.inc.php";
include_once "app/repositorioConductor.inc.php";
include_once "app/repositorioUsuario.inc.php";
include_once "app/repositorioAuto.inc.php";
include_once "app/repositorioViajePertenece.inc.php";
include_once "app/repositorioViajeProgramado.inc.php";
include_once "app/repositorioCalificacionPendiente.inc.php";
include_once "app/repositorioPagoPendiente.inc.php";
include_once "app/repositorioViaja.inc.php";
include_once "app/repositorioPostula.inc.php";
include_once "app/repositorioNotificacion.inc.php"; 
include_once "app/Redireccion.inc.php";
include_once "plantillas/documento-declaracion.inc.php";
include_once "plantillas/navbar2.inc.php";
Conexion::abrir_conexion();
if (isset($_GET['idViaje']) && !empty($_GET['idViaje'])) {
    $idViaje = $_GET['idViaje'];
} else {
    Redireccion::redirigir(SERVIDOR);
}
$viaje = RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(), $idViaje);
if (empty($viaje)) {
    Redireccion::redirigir(SERVIDOR);
}
if($viaje->getTerminado()){
    Redireccion::redirigir(SERVIDOR);
}
$ok = 2;
if (!ControlSesion::sesion_iniciada()) {
    $ok = 1;
} else {
    if ($viaje->getIdConductor() !== $_SESSION['id_usuario']) {
        $ok = 3;
    }
}
$usuarioCon = RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(), $viaje->getIdConductor());
if(isset($_POST['enviar'])){
    $oka = 1;
    $error ="";
    $usuario=RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(),$_SESSION['id_usuario']);
    if($usuario->getCodigo_tarjeta()==0){
        Redireccion::redirigir(RUTA_INGRESO_TARJETA."?vi=".$_GET['idViaje']);
    }
    
    if (RepositorioCalificacionPendiente::debeCalificacion(Conexion::obtener_conexion(), $_SESSION['id_usuario'])) {
        $error = $error . "tiene calificaciones pendientes <br>";
        $oka=2;
    }
    if (RepositorioPagoPendiente::debePago(Conexion::obtener_conexion(), $_SESSION['id_usuario'])) {
        $error = $error . "tiene pagos pendientes <br>";
        $oka=2;
    }
    if ($viaje->getTipoViaje() == 1) {
        $tengoViaje = RepositorioViaje::tieneViajeFechaDuracion(Conexion::obtener_conexion(), $_SESSION['id_usuario'], $viaje->getFechaInicio(), $viaje->getDuracion());
        if ($tengoViaje !== '') {
            $error = $error . $tengoViaje . "<br>";
            $oka=2;
        }
        $aceptadoViaje = RepositorioViaja::viajesViajaFechaDuracion(Conexion::obtener_conexion(), $_SESSION['id_usuario'], $viaje->getFechaInicio(), $viaje->getDuracion());
        if ($aceptadoViaje !== '') {
            $error = $error . $aceptadoViaje . "<br>";
            $oka=2;
        }
    } else {
        $relacion = RepositorioViajePertenece::viajeIdViaje(Conexion::obtener_conexion(), $idViaje);
      $viajes = RepositorioViajePertenece::viajesIdProgramado(Conexion::obtener_conexion(), $relacion->getIdViajeProgramado());
        $cont = 1;
        foreach ($viajes as $vi) {
            $via = RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(), $vi->getIdViaje());
            $tengoViaje = RepositorioViaje::tieneViajeFechaDuracion(Conexion::obtener_conexion(), $_SESSION['id_usuario'], $via->getFechaInicio(), $via->getDuracion());
            if ($tengoViaje !== '') {
                $error = $error . $tengoViaje . "(Fecha N° " . $cont . ")<br>";
                $oka=2;
            }
            $aceptadoViaje = RepositorioViaja::viajesViajaFechaDuracion(Conexion::obtener_conexion(), $_SESSION['id_usuario'], $via->getFechaInicio(), $via->getDuracion());
            if ($aceptadoViaje !== '') {
                $error = $error . $aceptadoViaje . "(Fecha N° " . $cont . ")<br>";
                $oka=2;
            }
            $cont = $cont + 1;
        }
    }
    if ($oka!==2) {
        echo "error";
        $texto='Un usuario se postulo a tu <a href="'.RUTA_DETALLE_VIAJE.'?idViaje='.$viaje->getId().'">viaje</a> desde: '.$viaje->getInicio().' hasta: '.$viaje->getDestino();
         RepositorioNotificacion::crearNotificacion(Conexion::obtener_conexion(),$usuarioCon->getId(),$texto);
    if ($viaje->getTipoViaje() == 1) {
            RepositorioPostula::crearRelacion(Conexion::obtener_conexion(), $_SESSION['id_usuario'], $viaje->getId());
        } else {
            foreach ($viajes as $vi) {
                RepositorioPostula::crearRelacion(Conexion::obtener_conexion(), $_SESSION['id_usuario'], $vi->getIdViaje());
            }
        }
        Redireccion::redirigir(RUTA_DETALLE_VIAJE."?idViaje=".$viaje->getId());
    } else {
        Redireccion::redirigir(RUTA_DETALLE_VIAJE."?idViaje=".$viaje->getId()."&&erro=".$error);
    }
    
}

/* ok=1 sin sesion, ok=2 coductor, ok=3 no conductor con sesion iniciada */
?>
<div class="container contenedorasd">
    <div class="row">
        <div class="col-md-4">
            <?php if ($ok != 2) { ?>
                <div class="card">
                    <div class="card-heading color1">
                        <h1>Conductor </h1>
                    </div>
                    <div class="card-body text-center">
                        <?php
                        
                        echo "<h3>", $usuarioCon->getNombre(), " ", $usuarioCon->getApellido(), "</h3>";
                        ?>
                        <br>
                        <a href="<?php echo RUTA_MOSTRAR_PERFIL . "?idUsuarios=" . $usuarioCon->getId(); ?>" class="btn botoncss form-control color1">Ver Perfil</a>
                        <br>     
                    </div>
                </div>
                <div class="card">
                    <div class="card-heading color1">
                        <h1>Vehiculo</h1>
                    </div>
                    <div class="card-body text-center">
                        <?php
                        $vehiculo = RepositorioAuto::obtener_por_patente(Conexion::obtener_conexion(), $viaje->getPatente());
                        echo "<h4>Patente: </h4><h3>", $vehiculo->getPatente(), "</h3>";
                        echo "<hr align='left'>";
                        echo "<br>";
                        echo "<h4>Marca: </h4><h3>", $vehiculo->getMarca(), "</h3>";
                        echo "<hr align='left'>";
                        echo "<br>";
                        echo "<h4>Modelo: </h4><h3>", $vehiculo->getModelo(), "</h3>";
                        echo "<hr align='left'>";
                        echo "<br>";
                        echo "<h4>Color: </h4><h3>", $vehiculo->getColor(), "</h3>";
                        echo "<hr align='left'>";
                        echo "<br>";
                        echo "<h4>Tipo de vehículo: </h4><h3>", $vehiculo->getTipo(), "</h3>";
                        echo "<hr align='left'>";
                        echo "<br>";
                        ?>
                        <a href="<?php echo RUTA_MOSTRAR_AUTO . "?patente=" . $vehiculo->getPatente(); ?>" class="btn botoncss form-control color1">Ver vehiculo</a> 
                    </div>
                </div>
            <?php } else {
                ?>
                <a href="<?php echo RUTA_MOSTRAR_POSTULANTES . "?idViaje=" . $viaje->getId(); ?>" class="btn botoncss form-control color1">Ver postulantes</a>
                <br>
                <a href="<?php echo RUTA_MOSTRAR_ACEPTADOS . "?idViaje=" . $viaje->getId(); ?>" class="btn botoncss form-control color1">Ver pasajeros</a>
                <br>
                <?php
                if($viaje->getTipoViaje()==1){ 
                $ahora =new DateTime(date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s')))); 
                $fecha= new DateTime(date('Y-m-d H:i:s',strtotime($viaje->getFechaInicio())));
                   if($ahora<$fecha){
                       $cant=RepositorioPostula::personas_postuladas_idViaje(Conexion::obtener_conexion(),$viaje->getId());
                       if(count($cant)){
                        echo "<h3>el viaje tiene postulantes, no puede ser editado</h3>"; 
                       }else{
                           $cont=RepositorioViaja::viaja_idViaje(Conexion::obtener_conexion(),$viaje->getId());
                           if(count($cant)){
                            echo "<h3>el viaje tiene pasajeros, no puede ser editado</h3>";   
                           }else{
                               ?><a href="<?php echo RUTA_EDITOR_VIAJE_UNICO."?idVi=".$viaje->getId(); ?>" class="btn botoncss form-control color1">Editar viaje</a> <?php
                           }
                       }
                   }else{
                       echo "<h3>el viaje ya empezó, no puede ser editado</h3>";
                   }
                }else{
                    $relacion=RepositorioViajePertenece::viajeIdViaje(Conexion::obtener_conexion(),$viaje->getId());
                    $viajeProgramado=RepositorioViajeProgramado::obtener_por_idViajeProgramado(Conexion::obtener_conexion(),$relacion->getIdViajeProgramado());
                    $ahora =new DateTime(date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s')))); 
                    $fecha= new DateTime(date('Y-m-d H:i:s',strtotime($viajeProgramado->getFechaInicio())));
                    if($ahora<$fecha){
                        $cant=RepositorioPostula::personas_postuladas_idViaje(Conexion::obtener_conexion(),$viaje->getId());
                        if(count($cant)){
                         echo "<h3>el viaje tiene postulantes, no puede ser editado</h3>"; 
                        }else{
                            $cont=RepositorioViaja::viaja_idViaje(Conexion::obtener_conexion(),$viaje->getId());
                            if(count($cant)){
                             echo "<h3>el viaje tiene pasajeros, no puede ser editado</h3>";   
                            }else{
                                ?><a href="<?php echo RUTA_EDITOR_VIAJE_MULTIPLE."?idVi=".$viaje->getId(); ?>" class="btn botoncss form-control color1">Editar viaje</a> <?php
                            }
                        }
                    }else{
                        echo "<h3>el viaje ya empezó, no puede ser editado</h3>";
                    }
                }
                ?>
                
            <?php } ?>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-heading color1">
                    <h1>Información del viaje</h1>
                </div>
                <div class="card-body text-center">
                    <?php
                    if ($viaje->getTipoViaje() == 1) {
                        echo "<h4>Tipo de viaje: </h4><h3> Casual </h3>";
                    } else {
                        echo "<h4>Tipo de viaje: </h4><h3> Programado </h3>";
                    }
                    ?>
                    <hr align="left">
                    <br>
                    <?php
                    echo "<h4>Ciudad origen: </h4><h3>", $viaje->getInicio(), "</h3>";
                    ?>
                    <hr align="left">
                    <br>

                    <?php
                    echo "<h4>Ciudad destino: </h4><h3>", $viaje->getDestino(), "</h3>";
                    ?>
                    <hr align="left">
                    <br>

                    <?php
                    echo "<h4>Asientos: </h4><h3>", $viaje->getAsientos(), "</h3>";
                    ?>
                    <hr align="left">
                    <br>

                    <?php
                    echo "<h4>Precio total: </h4><h3>$", $viaje->getPrecio(), "( $", round($viaje->getPrecio() / $viaje->getAsientos()), " por tripulante)</h3>";
                    ?>
                    <hr align="left">
                    <br>

                    <?php
                    echo "<h4>Descripcion: </h4><h3>", $viaje->getDescripcion(), "</h3>";
                    ?>
                    <hr align="left">
                    <br>

                    <?php
                    echo "<h4>Duracion: </h4><h3>", $viaje->getDuracion(), " Hora/s</h3>";
                    ?>
                    <hr align="left">
                    <br>
                    <?php if ($viaje->getTipoViaje() == 1) { ?>
                        <?php
                        echo "<h4>Fecha: </h4><h3>", $viaje->getFechaInicio(), "</h3>";
                        ?>
                        <hr align="left">
                        <br>
                        <?php
                    } else {
                        $relacion = RepositorioViajePertenece::viajeIdViaje(Conexion::obtener_conexion(), $idViaje);
                        $viajes = RepositorioViajePertenece::viajesIdProgramado(Conexion::obtener_conexion(), $relacion->getIdViajeProgramado());
                        $cant = 1;
                        foreach ($viajes as $vi) {
                            $via = RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(), $vi->getIdViaje());
                            echo "<h4>Fecha N° ", $cant, ": </h4><h3>", $via->getFechaInicio(), "</h3>";
                            echo "<hr>";
                            $cant = $cant + 1;
                        }
                        ?>
                        <br>
                        <?php
                        echo "<h4>Precio total a pagar por pasajero: </h4><h3>$", round(($viaje->getPrecio() / $viaje->getAsientos()) * $cant), "</h3>";
                        echo "<h5>*Precio del asiento multiplicado la cantidad de fechas del viaje programado*</h5>"
                        ?>
                        <hr align="left">
                        <br>
                    <?php } ?>
                </div>
            </div>
        </div> 
    </div>

    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <?php if ($ok == 3) { 
                $misPostulaciones = RepositorioPostula::viajes_postulado_idUsuario2(Conexion::obtener_conexion(), $_SESSION['id_usuario']);
                if (isset($misPostulaciones)) {
                    foreach ($misPostulaciones as $pos) {
                        if (($viaje->getId() === $pos->getIdViaje()) ) {
                            $ok =4;
                        }
                    }
                }
                if($ok==4){
                    echo "<h3>Usted ya se postulo anteriormente a este viaje</h3>";
                }else{
                    if($viaje->getTipoViaje()==2){
                        $viajeP=RepositorioViajeProgramado::obtener_por_idViajeProgramado(Conexion::obtener_conexion(),1);
                        date_default_timezone_set('America/Argentina/Buenos_Aires');
                        $actual=new DateTime(date("Y-m-d H:i:s"));
                        $fecha= new DateTime($viajeP->getFechaInicio());
                        if($actual>$fecha){
                            echo "<h3>Este viaje ya comenzó</h3>" ; 
                            $ok=5;
                        }
                    }


                 if($ok!==5){   
                
                
                ?>
                <form role="form" method="post" action="<?php echo RUTA_DETALLE_VIAJE."?idViaje=".$viaje->getId();?>">
                <button type="submit" name="enviar" class="btn botoncss form-control color1">Postularse al viaje</button>
                </form>
                <?php
            }}} else {
                if ($ok == 1) {
                    echo "<h3>Para postularse a este viaje debe <a href='" . RUTA_LOGIN . "'>Iniciar sesion</a> o <a href='" . RUTA_REGISTRO . "'>Crear cuenta</a> si todavia no tiene una </h3>";
                }
            }
            ?>
        </div>    
    </div>  
</div>
<div class="modal fade text-center" id="dialogo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">X</button>
            </div>
            <div class="modal-body">
                <?php
                   echo "<h3>".$_GET['erro']."</h3>";
                ?> 

            </div>
        </div>
    </div>
</div>


<?php

include_once "plantillas/documento-cierre.inc.php";
?>

  <?php 
  if(isset($_GET['erro'])){
  ?> 
  <script>$('#dialogo').modal('show');</script>   
  <?php
   }  
 
   