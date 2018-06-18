<?php

include_once "app/Conexion.inc.php";
include_once "app/repositorioUsuario.inc.php";
include_once "app/repositorioPostula.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/repositorioViaje.inc.php";
include_once "plantillas/documento-declaracion.inc.php";
include_once "plantillas/navbar2.inc.php";

if(!isset($_GET['idViaje'])){
    Redireccion::redirigir(SERVIDOR);
}
$viaje=RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(),$_GET['idViaje']);
if(empty($viaje)){
    Redireccion::redirigir(SERVIDOR);    
}
if($_SESSION['id_usuario']!==$viaje->getIdConductor()){
    Redireccion::redirigir(SERVIDOR);
}
$postulaciones=RepositorioPostula::personas_postuladas_idViaje(Conexion::obtener_conexion(),$viaje->getId());

?>

<div class="container contenedorasd">
<div class="card color1">
                <div class="card-heading color1">
                    <h1>Postulantes</h1>
                </div>
            </div>
 <div class="card">
    <div class="card-body">
      <?php if(empty($postulaciones)){
          echo "<h3>no hay postulantes </h3>";
      }
          ?>
      <?php foreach($postulaciones as $pos){
        $usuario=RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(),$pos->getIdUsuario());  
      ?>
      <div class="row">
      
           <div class="col-md-5">
           <br>
              <h3><?php $cant=1; echo $usuario->getNombre()." ".$usuario->getApellido(); ?></h3>  
              <hr>           
           </div>
           <div class="col-md-7">
           <div class="row">
            <div class="col-md-3">

            <a href="#" class="btn botoncss form-control color1"data-toggle="modal" data-target="#dialogo3">Aceptar</a>
            </div>
            <div class="col-md-3">
            <a href="#" class="btn botoncss form-control color1"data-toggle="modal" data-target="#dialogo3">Rechazar</a>
            </div>
            <div class="col-md-6">
            <div class="dropdown">
            <button class="btn botoncss dropdown-toggle form-control" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Calificaciones
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <p class="dropdown-item"><i class="fas fa-thumbs-up fa-2x"></i><?php echo " ".$usuario->getCalificacionPos()."";?> &nbsp; &nbsp; &nbsp; <i class="fas fa-thumbs-down fa-2x"></i> <?php echo " ".$usuario->getCalificacionNeg() ?></p>
  </div>
</div>
            </div>
          
           </div>
           </div>
           
      </div>
      <?php $cant=$cant+1; }?>
    </div>
 </div>           
</div>
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




<?php
include_once "plantillas/documento-cierre.inc.php";
