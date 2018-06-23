<?php
include_once "app/repositorioUsuario.inc.php";
include_once "app/repositorioPagoPendiente.inc.php";
include_once "app/ControlSesion.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/Conexion.inc.php";
include_once "plantillas/documento-declaracion.inc.php";
include_once "plantillas/navbar2.inc.php";
Conexion::abrir_conexion();
if(!isset($_GET['idCobrador'])){
    Redireccion::redirigir(SERVIDOR);
}
if(!isset($_GET['monto'])){
    Redireccion::redirigir(SERVIDOR);
}
if(!isset($_GET['idPs'])){
    Redireccion::redirigir(SERVIDOR);
}
if(!ControlSesion::sesion_iniciada()){
    Redireccion::redirigir(SERVIDOR);
}
if(isset($_POST['enviar'])){
    $saldo=RepositorioUsuario::saldoUsuario(Conexion::obtener_conexion(),$_SESSION['id_usuario']);
    $saldo=$saldo-$_GET['monto'];
    RepositorioUsuario::nuevoSaldo(Conexion::obtener_conexion(),$_SESSION['id_usuario'],$saldo);
    Redireccion::redirigir(RUTA_PAGOS_PENDIENTES."?err=2");
}

$saldo=RepositorioUsuario::saldoUsuario(Conexion::obtener_conexion(),$_GET['idCobrador']);
$saldo=$saldo+$_GET['monto'];
RepositorioUsuario::nuevoSaldo(Conexion::obtener_conexion(),$_GET['idCobrador'],$saldo);
RepositorioPagoPendiente::pagado($_GET['idPs'],Conexion::obtener_conexion());
$miSaldo=RepositorioUsuario::saldoUsuario(Conexion::obtener_conexion(),$_SESSION['id_usuario']);
if($miSaldo<$_GET['monto']){
Redireccion::redirigir(RUTA_PAGOS_PENDIENTES."?err=1");
}?>
<div class="modal fade" id="dialogo" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- cabecera del diálogo -->



            <div class="modal-body">

             <h3>Tiene fondos suficientes en su cuenta, ¿Decea pagar con tarjeta o con los fondos de su cuenta?</h3>
             <form role="form" method="post" action="<?php echo 'pagar.inc.php?idCobrador='.$_GET['idCobrador'].'&&monto='.$_GET['monto'].'&&idPs='.$_GET['idPs'];?>">
                <button type="submit" name="enviar" class="btn botoncss form-control color1">Con mis fondos</button>
                </form>
                <a href='<?php echo RUTA_PAGOS_PENDIENTES."?err=1"?>' class="btn botoncss form-control color1" >Tarjeta</a>
            </div>
        </div>
    </div>
</div>

<?php
include_once "plantillas/documento-cierre.inc.php";

if($miSaldo>$_GET['monto']){
    ?> 
  <script>$('#dialogo').modal('show');</script>   
  <?php
   } 


