<?php
include_once "app/repositorioAuto.inc.php";
include_once "app/repositorioConductor.inc.php";
include_once "app/repositorioUsuario.inc.php";
include_once "app/repositorioTiene.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/ControlSesion.inc.php";
include_once "app/config.inc.php";
include_once "app/Redireccion.inc.php";
include_once "plantillas/documento-declaracion.inc.php";
include_once "plantillas/navbar2.inc.php";
if (!ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(SERVIDOR);
}

$usuario = RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(), $_SESSION["id_usuario"]);

?>
<div class="container py-1">
    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-6 mx-auto">

                    <!-- form card login -->
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="mb-0">Para utilizar las principales funcionalidades de la pagina, debe ingresar su codigo de tarjeta de credito</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" id="formPatente" novalidate="" method="POST">
                            
                                <div class="form-group">
                                    <label>Codigo de su tarjeta (12 digitos)</label>
                                    <input type="text" name="tarjeta" class="form-control form-control-lg rounded-0" placeholder="123412341234" required>
                                </div>
                                <br>
                                <?php
                                $error = '';
                                if (isset($_POST['comprobar'])) {
                                    if (empty($_POST['tarjeta'])) {
                                        echo "<div class= 'alert alert-danger' role='alert'> debe rellenar el campo tarjeta</div>";
                                    } else {
                                        if (isset($_POST['tarjeta'])) {
                                            if(strlen($_POST['tarjeta'])!==12){
                                                echo "<div class= 'alert alert-danger' role='alert'> formato de tarjeta incorrecto</div>";
                                            }else{
                                                RepositorioUsuario::tarjetaIngreso($_SESSION['id_usuario'],$_POST['tarjeta'],Conexion::obtener_conexion());
                                                if(isset($_GET['vi'])){
                                                    Redireccion::redirigir(RUTA_DETALLE_VIAJE."?idViaje=".$_GET['vi']);
                                                }else{
                                                Redireccion::redirigir(SERVIDOR);}
                                            }}}}
                                ?>
                                <br>
                                <button type="submit" name="comprobar" class="btn botoncss form-control" >Confirmar</button>
                            </form>
                        </div>
                        <!--/card-block-->
                    </div>
                    <!-- /form card login -->

                </div>


            </div>
            <!--/row-->

        </div>
        <!--/col-->
    </div>
    <!--/row-->
</div>
<!--/container-->
<?php include_once "plantillas/documento-cierre.inc.php"; ?>
