<?php
include_once "app/repositorioViaje.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/ControlSesion.inc.php";
include_once "plantillas/documento-declaracion.inc.php";
include_once "plantillas/navbar2.inc.php";

if(isset($_POST['buscar'])){
    if($_POST['vehiculo']==='Cualquiera'){
      $viajes=RepositorioViaje::buscarCualquierVehiculo(Conexion::obtener_conexion(),$_POST['origen'],$_POST['destino']);    
    }else{
        $viajes=RepositorioViaje::buscarConVehiculo(Conexion::obtener_conexion(),$_POST['origen'],$_POST['destino'],$_POST['vehiculo']);
    }
}

?>
<div class="container contenerasd">
<div class="card rounded-0">
    <div class="card-header text-center">
        <h3 class="mb-0">
        busqueda de viaje </h3>
    </div>
    <div class="card-body">
    <form class="form" role="form"  method="POST" >
        <br>
         <div class="row">
         <div class="col-md-4">
           <div class="input-group ">
              <div class="input-group-prepend">
                 <span class="input-group-text" id="inputGroup-sizing-lg">Origen</span>
              </div>
              <input type="text" name="origen" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" required>
          </div>
         </div>
         <div class="col-md-4">
         <div class="input-group ">
              <div class="input-group-prepend">
                 <span class="input-group-text" id="inputGroup-sizing-lg">Destino</span>
              </div>
              <input type="text" name="destino" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" required>
          </div>
         </div>
         <div class="col-md-4">
           <div class="input-group mb-3">
             <div class="input-group-prepend">
             <label class="input-group-text" for="inputGroupSelect01">Tipo de vehiculo</label>
             </div>
             <select class="custom-select" name="vehiculo" id="inputGroupSelect01">
               <option selected>Cualquiera</option>
               <option>Auto</option>
               <option>Camioneta</option>
               <option>Combi</option>
               <option>colectivo</option>
             </select>
          </div>
         </div>
         </div>
         <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
            <button type="submit" name="buscar" class="btn botoncss form-control " >Buscar</button>
            </div>
         </div>

    </form>   
    </div>
</div>
<br>
<?php
if(isset($_POST['buscar'])){
    if(!empty($viajes)){
       foreach($viajes as $pos){ ?>
              <div class="card text-center">
                        <div class="card-body">
                            <h3 class="card-title"><?php
                                echo "Viaje desde: <u>", $pos->getInicio(), "</u> Hasta: <u>", $pos->getDestino(),"</u>";
                                if ($pos->getTipoViaje() == 2) {
                                    echo " (Viaje programado)";
                                }
                                ?></h3>
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
         <?php }
        }else{
            echo "<h3>No se encontraron viajes </h3>";
        }
    }
         ?>
</div>


<?php include_once "plantillas/documento-cierre.inc.php";
