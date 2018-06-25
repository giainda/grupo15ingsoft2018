<?php
include_once "app/repositorioViaje.inc.php";
include_once "app/repositorioViajePertenece.inc.php";
include_once "app/ControlSesion.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/Redireccion.inc.php";
include_once "plantillas/documento-declaracion.inc.php";
include_once "plantillas/navbar2.inc.php";
include_once "app/ValidadorEditorFechaMultiple.inc.php";
Conexion::abrir_conexion();
if (!ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(SERVIDOR);
}
if(!isset($_GET['idVi'])){
    Redireccion::redirigir(SERVIDOR);
}
$viaje=RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(),$_GET['idVi']);
$viajeProgramado=RepositorioViajePertenece::viajeIdViaje(Conexion::obtener_conexion(),$viaje->getId());
$relaciones=RepositorioViajePertenece::viajesIdProgramado(Conexion::obtener_conexion(),$viajeProgramado->getIdViajeProgramado());
if (isset($_POST['cancelar'])) {
   Redireccion::redirigir(RUTA_EDITOR_VIAJE_MULTIPLE."?idVi=".$viaje->getId());
}
if (isset($_POST['enviar'])) {
    $fecha = new dateTime($viaje->getFechaInicio());
    $arr = getDate($fecha->getTimestamp());
    $new = date("Y-m-d H:i", strtotime('+' . $arr['hours'] . ' hours', strtotime($_POST['fecha'])));
    $new = date("Y/m/d H:i", strtotime('+' . $arr['minutes'] . ' minutes', strtotime($new)));

    $validador = new ValidadorEditorFechaMultiple($new, $viaje->getDuracion(), $viaje->getPatente(),$viaje->getId(), Conexion::obtener_conexion());
    if ($validador->registro_valido()) {
        $viajeNue = new Viaje('', $_SESSION['id_usuario'], $viaje->getPatente(), $viaje->getFechaCreacion(), $new, $viaje->getInicio(), $viaje->getDestino(), $viaje->getAsientos(), $viaje->getPrecio(), $viaje->getDescripcion(), 2, 1, $viaje->getDuracion(),0);
        $id=RepositorioViaje::insertar_viaje2(Conexion::obtener_conexion(),$viajeNue);
        RepositorioViajePertenece::crearRelacion(Conexion::obtener_conexion(),$viajeProgramado->getIdViajeProgramado(),$id);       
        Redireccion::redirigir(RUTA_EDITOR_VIAJE_MULTIPLE."?idVi=".$viaje->getId());
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <form role="form" method="post" >
                        
                        <?php
                          if (isset($_POST['enviar'])) {
                           ?>
                           <label>Nueva fecha</label>
                        <input type="date" name="fecha" class="form-control" value="<?php echo $_POST['fecha']?>">
                           <?php   
                           $validador->mostrar_error_fecha_inicio();
                          }else{
                              ?>
                              <label>Nueva fecha</label>
                        
                        <input type="date" name="fecha" class="form-control" >
                              
                              <?php

                          }
?>
                        <button type="submit"class="btn botoncss" name="enviar" onclick="location.href ='editor-fecha.php';" >Agregar</button>       
                        <button class="btn botoncss" name="cancelar"onclick="location.href ='<?php echo RUTA_EDITOR_VIAJE_MULTIPLE."?idVi=".$viaje->getId()?>';">Cancelar</button>
                        <br>
                        <br>  
                    </form>
                </div>
            </div> 

        </div>



    </div>
</div>
<?php include_once "plantillas/documento-cierre.inc.php"; ?>

