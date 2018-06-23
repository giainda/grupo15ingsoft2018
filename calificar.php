<?php


include_once "app/repositorioUsuario.inc.php";
include_once "app/repositorioConductor.inc.php";
include_once "app/repositorioCalificacionPendiente.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/ControlSesion.inc.php";
include_once "plantillas/documento-declaracion.inc.php";
include_once "plantillas/navbar2.inc.php";
include_once "app/repositorioCalificacion.inc.php";
if(!ControlSesion::sesion_iniciada()){
   Redireccion::redirigir(SERVIDOR);
}
if(!isset($_GET['idPs'])){
    Redireccion::redirigir(SERVIDOR);
}

if(isset($_POST['enviar'])){
    $cal=RepositorioCalificacionPendiente::calificacion_pendiente_id(Conexion::obtener_conexion(),$_GET['idPs']);
    if($_POST['radios']=='option1'){
          if($cal->getEsAConductor()){
              RepositorioConductor::positivo($cal->getIdUsuarioACalificar(),Conexion::obtener_conexion());
          }else{
              RepositorioUsuario::positivo($cal->getIdUsuarioACalificar(),Conexion::obtener_conexion());
          } 
          $texto="<i class='fas fa-thumbs-up fa-2x'></i> ".$_POST['texto'];  
    }else{
        if($cal->getEsAConductor()){
            RepositorioConductor::negativo($cal->getIdUsuarioACalificar(),Conexion::obtener_conexion());
        }else{
            RepositorioUsuario::negativo($cal->getIdUsuarioACalificar(),Conexion::obtener_conexion());
        }
        $texto="<i class='fas fa-thumbs-down fa-2x'></i> ".$_POST['texto'];  
        /*crear califiacion */
    }
    RepositorioCalificacion::crear_calificacion(Conexion::obtener_conexion(),$cal->getIdUsuarioACalificar(),$texto);
    RepositorioCalificacionPendiente::calificado($cal->getId(),Conexion::obtener_conexion());
    Redireccion::redirigir(RUTA_CALIFICACIONES_PENDIENTES);

}


?>
<div class="container contenedorasd">
 <div class="card text-center">
   <div class="card-body">
   <form role="form" method="post" action='<?php echo "calificar.php?idPs=".$_GET['idPs']; ?>'>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="radios" id="exampleRadios1" value="option1" checked>
  <label class="form-check-label" for="exampleRadios1">
  <i class="fas fa-thumbs-up fa-4x"></i>
  </label>
</div>
&nbsp;
&nbsp;
&nbsp;
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="radios" id="exampleRadios2" value="option2">
  <label class="form-check-label" for="exampleRadios2">
  <i class="fas fa-thumbs-down fa-4x"></i>
  </label>
</div>
<br>
<br>
<h3>Mensaje:</h3>
<input class="form-control form-control-lg" type="text" name='texto' placeholder="mensaje" required>
<button type="submit" name="enviar" class="btn botoncss  color1">Calificar</button>
</form>
   </div>
 </div>
</div>