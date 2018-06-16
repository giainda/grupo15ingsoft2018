<?php
include_once "app/Conexion.inc.php";
include_once "app/repositorioUsuario.inc.php";
include_once "app/ControlSesion.inc.php";
include_once "app/repositorioCalificacionPendiente.inc.php";
include_once "app/repositorioPagoPendiente.inc.php";
include_once "app/Redireccion.inc.php";
include_once "plantillas/navbar2.inc.php";
include_once "plantillas/documento-declaracion.inc.php";
if (!ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(SERVIDOR);
}
$usuario = RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(), $_SESSION['id_usuario']);
if( RepositorioCalificacionPendiente::debeCalificacion(Conexion::obtener_conexion(), $usuario->getId()) || RepositorioPagoPendiente::debePago(Conexion::obtener_conexion(), $usuario->getId())){
    Redireccion::redirigir(SERVIDOR."?cod=1");
}
?>
  <div class="container text-center">
  <div class="jumbotron">
        <h1 class="text-center">Seleccione el tipo de viaje</h1>
    </div>
    <div class="row">       
      <div class="col-md">        
          <div class="card" >
            <img class="card-img-top" src="img/calendar.jpg"  height="360">            
            <div class="card-body">
              <h4 class="card-title">Viaje ocasional</h4>
              <p class="card-text">Crea un viaje con fecha, origen y destino determinados para un único día. </p>
              <a href="<?php echo RUTA_CREAR_VIAJE_UNICO ?>" class="btn btn-primary botoncss">Crear</a>
            </div>
          </div>          
      </div>

      <div class="col-md">        
          <div class="card">
          <img class="card-img-bottom" src="img/CALENDARIO.jpg" height="360">   
            <div class="card-body">
              <h4 class="card-title">Vieajes múltiples </h4>
              <p class="card-text">Organiza una serie de viajes con una fecha, origen y destino determinado </p>
              <a href="<?php echo RUTA_CREAR_VIAJE_MULTIPLE ?>" class="btn btn-primary botoncss">Crear</a>
            </div>
                                 
          </div>          
      </div>
      
    </div>
  </div>
</body>
<br>
<br>
</html>
<?php 
include_once "plantillas/documento-cierre.inc.php";
