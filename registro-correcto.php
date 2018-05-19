<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/Redireccion.inc.php';
if(isset($_GET['nombre'])&&!empty($_GET['nombre'])){
    $nombre=$_GET['nombre'];
}else{
    Redireccion::redirigir(SERVIDOR);
}
$titulo = 'registro correcto';
include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar2.inc.php';
?>
<div class="container contenedorasd">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Registro correcto!
                </div>
                <div class="panel-body text-center">
                    <p>¡Gracias por registrarte <b><?php echo $nombre ?></b>!</p>
                    <br>
                    <p><a href=<?php echo RUTA_LOGIN ?>>Inicia sesíon</a> para comenzar a utilizar tu cuenta</p>
                    <br>
                </div>
            </div>  
        </div>
    </div>
</div>