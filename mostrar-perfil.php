<?php
include_once 'app/Conexion.inc.php';
include_once 'app/config.inc.php';
include_once 'app/redireccion.inc.php';
include_once 'app/repositorioUsuario.inc.php';
include_once 'app/repositorioTiene.inc.php';
include_once 'app/repositorioConductor.inc.php';
include_once 'app/fotos.inc.php';
include_once 'plantillas/documento-declaracion.inc.php';

if (!isset($_GET['idUsuarios'])) {
    Redireccion::redirigir(SERVIDOR);
}

Conexion::abrir_conexion();
$usuario = RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(), $_GET['idUsuarios']);
if (empty($usuario)) {
    Redireccion::redirigir(SERVIDOR);
}
if (RepositorioConductor::esConductor(Conexion::obtener_conexion(), $usuario->getId())) {
    $conductor = RepositorioConductor::obtener_conductor_por_id(Conexion::obtener_conexion(), $usuario->getId());
}

include_once 'plantillas/navbar2.inc.php';
?>
<div class="container contenedorasd">
    <div class="row">
        <div class="col-md-4"> 
            <div class="card">
                <?php
                $imagen = "img/usuario.jpg";
                $foto = new RepositorioFoto();
                if ($foto->esta(Conexion::obtener_conexion(), $usuario->getId())) {
                    $imagen = $foto->recuperarFoto($usuario->getId(), Conexion::obtener_conexion());
                }
                ?>
                <img class="card-img-top" src="<?php echo $imagen ?>" alt="Card image cap">            
                <div class="card-body text-center">
                    <h4 class="card-title"><?php
                        echo ' ', $usuario->getNombre(), ' ', $usuario->getApellido();
                        ?></h4>

                    <br>
                    <br>

                </div>
            </div>
        </div>
        <div class="col-md-8 text-center">
            <div class="card color1">
                <div class="card-heading color1">
                    <h1>Información</h1>
                </div>
            </div>
            <p class="card-text text-center">

                <?php
                echo "<h4>Calificaciones como pasajero: </h4><br><h3>Positivas: ", $usuario->getCalificacionPos(), '<br>Negativas: ', $usuario->getCalificacionNeg(), '<h3>';
                ?>
                <br>
                <hr>
                <?php
                if (RepositorioConductor::esConductor(Conexion::obtener_conexion(), $usuario->getId())) {

                    echo "<h4>Calificaciones como conductor: </h4><br><h3>Positivas: ", $conductor->getCalificacionPos(), '<br>Negativas: ', $conductor->getCalificacionNeg(), '<h3>';
                    ?>
                    <br>
                    <hr>
                    <?php
                }
                echo "<h4>Correo: </h4><h3>", $usuario->getCorreo(), "</h3>";
                ?>
                <br>
                <hr>
                <?php
                echo "<h4>Nacimiento: </h4><h3>", $usuario->getFechanac(), "</h3>";
                ?>
                <br>
                <hr>
                <?php
                ?>         
            </p>
        </div>

        <?php
        include_once 'plantillas/documento-cierre.inc.php';
        ?>
