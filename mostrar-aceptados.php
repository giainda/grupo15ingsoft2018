<?php
include_once "app/Conexion.inc.php";
include_once "app/repositorioUsuario.inc.php";
include_once "app/repositorioViaja.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/repositorioViaje.inc.php";
include_once "app/repositorioViajePertenece.inc.php";
include_once "app/repositorioViajeProgramado.inc.php";
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
if($viaje->getTipoViaje()==1){ 
    $ahora =new DateTime(date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s')))); 
    $fecha= new DateTime(date('Y-m-d H:i:s',strtotime($viaje->getFechaInicio())));
       if($ahora>$fecha){
           $terminado=1;
       }
    }else{
        $relacion=RepositorioViajePertenece::viajeIdViaje(Conexion::obtener_conexion(),$viaje->getId());
        $viajeProgramado=RepositorioViajeProgramado::obtener_por_idViajeProgramado(Conexion::obtener_conexion(),$relacion->getIdViajeProgramado());
        $ahora =new DateTime(date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s')))); 
        $fecha= new DateTime(date('Y-m-d H:i:s',strtotime($viajeProgramado->getFechaInicio())));
        if($ahora>$fecha){
            $terminado=1;           
        }
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
                            <?php if(isset($terminado)){
                                echo "<h4>no se puede eliminar pasajero, el viaje ya comenzó</h4>";
                            }else{ ?>
                            <button onclick="location.href = '<?php echo "eliminar-pasajero.inc.php?idViajeS=".$viaje->getId()."&&id_usuario=".$usuario->getId() ?>';"class="botoncss form-control">Eliminar</button>
                            <?php }  ?>
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
    <br>
    <h4>*si elimina algun pasajero, usted será sancionado con calificacion negativa, si el viaje es multiple, será una calificacion negativa por cada viaje*</h4>           
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



