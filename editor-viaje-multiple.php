<?php
include_once "app/repositorioAuto.inc.php";
include_once "app/repositorioConductor.inc.php";
include_once "app/repositorioUsuario.inc.php";
include_once "app/repositorioTiene.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/ControlSesion.inc.php";
include_once "app/config.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/ValidadorAuto.inc.php";
include_once "app/ValidadorEditorViajeMultiple.inc.php";
include_once "app/repositorioViaje.inc.php";
include_once "app/repositorioViajePertenece.inc.php";
include_once "app/repositorioViajeProgramado.inc.php";
include_once "app/validadorHorarioNuevo.inc.php";

include_once "plantillas/documento-declaracion.inc.php";
include_once "plantillas/navbar2.inc.php";
Conexion::abrir_conexion();
if (!ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(SERVIDOR);
}
if(!isset($_GET['idVi'])){
    Redireccion::redirigir(SERVIDOR);
}
$fechas=array();
$viaje=RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(),$_GET['idVi']);
$viajeProgramado=RepositorioViajePertenece::viajeIdViaje(Conexion::obtener_conexion(),$viaje->getId());
$relaciones=RepositorioViajePertenece::viajesIdProgramado(Conexion::obtener_conexion(),$viajeProgramado->getIdViajeProgramado());
foreach($relaciones as $re){
    $v=RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(),$re->getIdViaje());
    $fechas[]=$v->getFechaInicio();
}
$max = max($fechas);
$min = min($fechas);
RepositorioViajeProgramado::actualiza(Conexion::obtener_conexion(),$viajeProgramado->getIdViajeProgramado(),$max,$min);
$conductor = RepositorioConductor::obtener_conductor_por_id(Conexion::obtener_conexion(), $_SESSION['id_usuario']);
$ok = 0;

if (isset($_POST['enviar'])) {
    $validador = new ValidadorEditorViajeMultiple($viaje->getId(),$_POST['origen'], $_POST['destino'], $viaje->getFechaInicio(), $_POST['duracion'], $_POST['precio'], $_POST['descripcion'], $_POST['vehiculo'], Conexion::obtener_conexion());
    if ($validador->registro_valido()) {
        $auto = RepositorioAuto::obtener_por_patente(Conexion::obtener_conexion(), $validador->obtener_vehiculo());
        foreach($relaciones as $re){
        $viajen=RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(),$re->getIdViaje());    
        $viajeh = new Viaje($viajen->getId(), $_SESSION['id_usuario'], $validador->obtener_vehiculo(), $viajen->getFechaCreacion(), $viajen->getFechaInicio(), $validador->obtener_ciudad_origen(), $validador->obtener_ciudad_destino(), $auto->getCapasidad(), $validador->obtener_precio_total(), $validador->obtener_descripcion(), 2, 1, $validador->obtener_duracion(),0);
        RepositorioViaje::editarViaje(Conexion::obtener_conexion(), $viajeh);
        $ok = 1;
    }}

}
if(isset($_POST['enviarHora'])){
    $valida=new ValidadorHorarioNuevo($viaje->getId(),$viaje->getFechaInicio(),$_POST['horari'],$viaje->getDuracion(),
    $viaje->getPatente(),Conexion::obtener_conexion());
    if ($valida->registro_valido()) {
        $auto = RepositorioAuto::obtener_por_patente(Conexion::obtener_conexion(), $viaje->getPatente());
        foreach($relaciones as $re){
        $viajen=RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(),$re->getIdViaje()); 
        $valores=explode(' ',$viajen->getFechaInicio());
        $fechaNueva=$valores[0].' '.$_POST['horari'];   
        $viajeh = new Viaje($viajen->getId(), $_SESSION['id_usuario'], $viajen->getPatente(), $viajen->getFechaCreacion(), $fechaNueva, $viajen->getInicio(), $viajen->getDestino(), $auto->getCapasidad(), $viajen->getPrecio(), $viajen->getDescripcion(), 2, 1, $viajen->getDuracion(),0);
        RepositorioViaje::editarViaje(Conexion::obtener_conexion(), $viajeh);
        $ok = 1;
    }}
   

}
?>
<div class="row">
    <div class="col-md-6">
        <div class="container ">
            <div class="card text-center">
                <div class="card-heading">
                    <h3 class="panel-tittle">Editar informacion de los viajes</h3>
                </div>
                <div class="card-body">
                    <form role="form" method="post" action="<?php echo "editor-viaje-multiple.php?idVi=".$viaje->getId(); ?>">
<?php
if (isset($_POST['enviar'])) {
    include_once 'plantillas/editar-viaje-multiple-validado.inc.php';
} else {
    include_once 'plantillas/editar-viaje-multiple-vacio.inc.php';
}
?>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
      <div class="container">
      <div class="row">
         <div class="col-md-12">
           <div class="card text-center">  
           <div class="card-heading">
                    <h3 class="panel-tittle">Editar fechas</h3>
                </div>         
               <div class="card-body">
                  <?php 
                  foreach($relaciones as $re){
                      ?>
                      <div class="row">
               <div class="col-md-6">
                      <?php
                    $viaje=RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(),$re->getIdViaje());
                    echo "<br>";
                    echo "<h3>".$viaje->getFechaInicio()."</h3>";
                    echo "<br>";
                    echo "<hr>";
                    ?>
                    </div>
                    <div class="col-md-6">
                    <br>
                     <h3><a href="editor-fecha.php?idVi=<?php echo $viaje->getId()?>">editar</a>&nbsp;&nbsp; <a href="borrar-fecha.inc.php?idVi=<?php echo $viaje->getId() ?>"> borrar</a></h3>
                     <br>
                     <hr>
                    </div>
               </div>
                    <?php
                  }
                  
                  ?>
                <a href="<?php echo "fecha-nueva-editor.php?idVi=".$viaje->getId()?>" class="btn botoncss  color1">Agregar nueva fecha</a>
               </div>
           </div>
          </div>
      </div>
      <br>
      <br>
      <div class="row">
          <div class="col-md-12">
              <div class="card text-center">
                   <div class="card-heading">
                       <h3>Editar horario de los viajes</h3>
                   </div>
                   <div class="card-body">
                   <form role="form" method="post" action="<?php "editor-viaje-multiple.php?idVi=".$viaje->getId(); ?>">

                   <?php $valores=explode(' ',$viaje->getFechaInicio()); ?>
                       <label>Horario</label>
                       <input type="time" class="form-control" name="horari" value="<?php echo $valores[1]?>">
                       <?php if(isset($_POST['enviarHora'])){
                           $valida->mostrar_error_fecha_inicio();
                       } ?>

                   <button type="submit"class="btn botoncss" name="enviarHora">Cambiar</button>
                   </form>
                   </div>
              </div> 
          </div>
      </div>
    </div> 
    </div>               

</div>
<div class="modal fade" id="dialogoCorrecto">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- cabecera del diálogo -->


            <!-- cuerpo del diálogo -->
            <div class="modal-body">
                 <?php if(isset($_GET['err'])){
                ?>
                 <h4>No puede tener menos de dos fechas. edite una existente o agregue una nueva y luego borre la que desea</h4>
                <?php 
                }else{
                     ?>
                <h4>El viaje fue editado con exito</h4>
                <?php } ?>
                <br>
                <br>
            </div>


        </div>
    </div>
</div>









<?php
include_once "plantillas/documento-cierre.inc.php";
if ($ok) {
    ?>
    <script>$('.modal').modal('show');</script>
<?php }
if(isset($_GET['err'])){
    ?>
    <script>$('.modal').modal('show');</script>
<?php  
}
?> 
