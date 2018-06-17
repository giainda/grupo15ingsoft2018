<?php
  include_once "app/Conexion.inc.php";
  include_once "app/ControlSesion.inc.php";
  include_once "app/repositorioViaje.inc.php";
  include_once "app/repositorioConductor.inc.php";
  include_once "app/repositorioUsuario.inc.php";
  include_once "app/repositorioAuto.inc.php";
  include_once "app/repositorioViajePertenece.inc.php";
  include_once "app/repositorioViajeProgramado.inc.php";
  include_once "app/Redireccion.inc.php";
  include_once "plantillas/documento-declaracion.inc.php";
  include_once "plantillas/navbar2.inc.php";
  Conexion::abrir_conexion();
  if(isset($_GET['idViaje'])&&!empty($_GET['idViaje'])){
    $idViaje=$_GET['idViaje'];}else{Redireccion::redirigir(SERVIDOR);
      }
  $viaje=RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(),$idViaje) ;
  if(empty($viaje)){
      Redireccion::redirigir(SERVIDOR);
  }
  
  
  ?>
  <div class="container contenedorasd">
    <div class="row">
       <div class="col-md-4">
       <div class="card">
          <div class="card-heading color1">
              <h1>Conductor </h1>
          </div>
          <div class="card-body text-center">
              <?php $usuarioCon=RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(),$viaje->getIdConductor());
                    echo "<h3>",$usuarioCon->getNombre()," ",$usuarioCon->getApellido(),"</h3>";?>
                    <br>
                <a href="<?php echo RUTA_MOSTRAR_PERFIL."?idUsuarios=".$usuarioCon->getId(); ?>" class="btn botoncss form-control color1">Ver Perfil</a>
                <br>     
          </div>
       </div>
       <div class="card">
         <div class="card-heading color1">
           <h1>Vehiculo</h1>
         </div>
         <div class="card-body text-center">
           <?php $vehiculo=RepositorioAuto::obtener_por_patente(Conexion::obtener_conexion(),$viaje->getPatente()); 
              echo "<h4>Patente: </h4><h3>", $vehiculo->getPatente(), "</h3>";          
              echo  "<hr align='left'>";
              echo "<br>"; 
              echo "<h4>Marca: </h4><h3>", $vehiculo->getMarca(), "</h3>";          
              echo  "<hr align='left'>";
              echo "<br>"; 
              echo "<h4>Modelo: </h4><h3>", $vehiculo->getModelo(), "</h3>";          
              echo  "<hr align='left'>";
              echo "<br>"; 
              echo "<h4>Color: </h4><h3>", $vehiculo->getColor(), "</h3>";          
              echo  "<hr align='left'>";
              echo "<br>"; 
              echo "<h4>Tipo de vehículo: </h4><h3>", $vehiculo->getTipo(), "</h3>";          
              echo  "<hr align='left'>";
              echo "<br>"; 
        ?>
         <a href="<?php echo RUTA_MOSTRAR_AUTO."?patente=".$vehiculo->getPatente(); ?>" class="btn botoncss form-control color1">Ver vehiculo</a> 
        </div>
       </div>
       </div>
       <div class="col-md-8">
             <div class="card">
                <div class="card-heading color1">
                    <h1>Información del viaje</h1>
                </div>
                <div class="card-body text-center">
                <?php 
                   if($viaje->getTipoViaje()==1){
                      echo "<h4>Tipo de viaje: </h4><h3> Casual </h3>";
                   }else{
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
                      echo "<h4>Precio total: </h4><h3>$", $viaje->getPrecio(),"( $",round($viaje->getPrecio()/$viaje->getAsientos())," por pasajero)</h3>";
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
                   <?php if($viaje ->getTipoViaje()==1){?>
                    <?php 
                      echo "<h4>Fecha: </h4><h3>", $viaje->getFechaInicio(), "</h3>";
                   ?>
                   <hr align="left">
                   <br>
                   <?php }else{
                     $relacion=RepositorioViajePertenece::viajeIdViaje(Conexion::obtener_conexion(),$idViaje);
                     $viajes=RepositorioViajePertenece::viajesIdProgramado(Conexion::obtener_conexion(),$relacion->getIdViajeProgramado());
                     $cant=1;
                     foreach($viajes as $vi){
                       $via=RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(),$vi->getIdViaje());
                       echo "<h4>Fecha N° ",$cant,": </h4><h3>", $via->getFechaInicio(), "</h3>"; 
                       echo "<hr>";
                       $cant = $cant+1;
                     } ?>
                       <br>
                     <?php 
                      
                      echo "<h4>Precio total a pagar por pasajero: </h4><h3>$", round(($viaje->getPrecio()/$viaje->getAsientos())*$cant), "</h3>";
                      echo "<h5>*Precio del asiento multiplicado la cantidad de fechas del viaje programado*</h5>"
                      ?>
                      <hr align="left">
                      <br>
                      <?php } ?>
                </div>
             </div>
       </div>  
    </div>
  </div>