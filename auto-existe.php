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
$ok=0;
if(!ControlSesion::sesion_iniciada()){
    Redireccion::redirigir(SERVIDOR);
}
if(isset($_GET['patente'])&&!empty($_GET['patente'])){
    $auto=RepositorioAuto::obtener_por_patente(Conexion::obtener_conexion(),$_GET['patente']);
}else{
    Redireccion::redirigir(SERVIDOR);
}
if(isset($_POST['enviar'])){
    if(!RepositorioConductor::esConductor(Conexion::obtener_conexion(),$_SESSION['id_usuario'])){
        RepositorioConductor::insertar_conductor(Conexion::obtener_conexion(),$_SESSION['id_usuario']);
    }
    RepositorioTiene::crearRelacion(Conexion::obtener_conexion(),$_SESSION['id_usuario'],$auto ->getPatente());
    $ok=1;
    if(!RepositorioAuto::esta_activo(Conexion::obtener_conexion(),$auto->getPatente())){
        RepositorioAuto::restablecer($auto->getPatente(),Conexion::obtener_conexion());

    }
}
?>

<div class="container text-center contenedorasd">
    <h3>El vehículo ya existe</h3>
    <div class="card text-center">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo "Patente: ", $auto->getPatente(), ", tipo: ", $auto->getTipo(); ?></h5>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <p class="card-text"><?php echo "<h4>marca: </h4>", $auto->getMarca(); ?> </p>
                                                                </div> 
                                                            </div>
                                                        </div>  
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <p class="card-text"><?php echo "<h4>modelo: </h4>", $auto->getModelo(); ?> </p>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <p class="card-text"><?php echo "<h4>capacidad: </h4>", $auto->getCapasidad(); ?> </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <p class="card-text"><?php echo "<h4>color: </h4>", $auto->getColor(); ?> </p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

<h2>¿decea vincular este auto a su cuenta?</h2>
<div class="row">
    <div class=col-md-3>
</div>
<div class=col-md-3>
<form class="form" role="form" autocomplete="off" id="formPatente" novalidate="" method="POST">
<button type="submit"class="btn botoncss form-control " name="enviar">aceptar</button></form>
</div>
<div class=col-md-3>
<button  onclick="location.href='<?PHP echo RUTA_INGRESO_PATENTE ?>';" class="btn botoncss form-control">no es mi auto</button>    
</div>
</div>
</div>
<div class="modal fade" id="dialogoCorrecto">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                <!-- cabecera del diálogo -->
                                <div class="modal-header">
                                    <a type="button" class="btn btn-primary ml-auto" href="<?php echo RUTA_PERFIL ?>" >X</a>
                                </div>

                                <!-- cuerpo del diálogo -->
                                <div class="modal-body">
                                    <h4>El vehículo fue vinculado correctamente</h4>
                                    <br>
                                    <br>
                                </div>


                            </div>
                        </div>
                    </div>







<?php
include_once "plantillas/documento-cierre.inc.php";
if($ok){
    ?>
    <script>$('.modal').modal('show');</script>
    <?php }
    
   
    ?> 
