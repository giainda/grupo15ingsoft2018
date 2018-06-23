<?php
include_once "app/repositorioPagoPendiente.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/repositorioUsuario.inc.php";
include_once "plantillas/documento-declaracion.inc.php";
include_once "plantillas/navbar2.inc.php";
Conexion::abrir_conexion();
if(!ControlSesion::sesion_iniciada()){
    Redireccion::redirigir(SERVIDOR);
}

$pagosPendientes=repositorioPagoPendiente::pago_pendiente_idUsuario(Conexion::obtener_conexion(),$_SESSION['id_usuario']);

?>
<div class="container contenedorasd">
<div class="card color1">
        <div class="card-heading color1">
            <h1>Pagos pendientes</h1>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <?php
            if (empty($pagosPendientes)) {
                echo "<h3>no hay pagos pendientes</h3>";
            }
            ?>
            <?php
            foreach ($pagosPendientes as $pos) {
               $usuario=RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(),$pos->getIdUsuarioCobrador());
                ?>
                <div class="row">

                    <div class="col-md-8">
                        <br>
                        <h3><?php
                            $cant = 1;
                            echo "Debes pago a: " .$usuario->getNombre() . " " . $usuario->getApellido(). ", Monto: ".$pos->getMonto();
                            ?></h3>  
                        <hr>           
                    </div>
                    <div class="col-md-4">
                        <div class="row">

                            <div class="col-md-12">
                            <?php $path='pagar.inc.php?idCobrador='.$usuario->getId().'&&monto='.$pos->getMonto().'&&idPs='.$pos->getId(); ?>
                            <a href="<?php echo $path ?>" class="btn botoncss form-control color1"data-toggle="modal" data-target="#dialogo1">Pagar</a>
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
</div>
<div class="modal fade" id="dialogo">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- cabecera del diálogo -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">X</button>
            </div>


            <div class="modal-body">
            <?php if($_GET['err']==1){?>
                <h3>Pago realizado correctamente, se ha descontado el monto en su cuenta bancaria</h3>
            <?php }else{?>
                <h3>Pago realizado correctamente, se ha descontado el monto de los fondos de su cuenta</h3>
            <?php }?>
            </div>
        </div>
    </div>
</div>
<?php 
include_once "plantillas/documento-cierre.inc.php";
if(isset($_GET['err'])){
    ?> 
  <script>$('#dialogo').modal('show');</script>   
  <?php
   } 