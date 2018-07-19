<?php
include_once 'app/Config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ValidadorRegistro.inc.php';
include_once 'app/Redireccion.inc.php';

if (isset($_POST['enviar'])) {
    Conexion::abrir_conexion();
    $validador = new ValidadorRegistro($_POST['correo'], $_POST['nombre'], $_POST['apellido'], $_POST['fechanac'], $_POST['contraseña'], $_POST['contraseña2'], Conexion::obtener_conexion());

    if ($validador->registro_valido()) {
        $usuario = new Usuario('', $validador->obtener_correo(), $validador->obtener_nombre(), $validador->obtener_apellido(), $validador->obtener_fechanac(), password_hash($validador->obtener_contraseña(), PASSWORD_DEFAULT), 0, 0, 0, 0, 1);
        $usuario_insertado = RepositorioUsuario :: insertar_usuario(Conexion::obtener_conexion(), $usuario);
        if ($usuario_insertado) {
            Redireccion::redirigir(RUTA_REGISTRO_CORRECTO . '?nombre=' . $usuario->getNombre());
        }
    }Conexion::cerrar_conexion();
}
$titulo = 'unAventon registro';
include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar2.inc.php';
?>
<div class="container">
    <div class="jumbotron">
        <h1 class="text-center">Formulario de registro</h1>
    </div>
</div>    
<div class="container margen">
    <div class="row">
        <div class="col-md-6 text-center">
            <div class="card tex-center">
                <div class="card-heading">
                    <h3 class="panel-tittle">Instrucciónes</h3>
                </div>
                <div class="card-body">
                    <br>
                    <p class="text-justify">
                        El nombre de usuario debe tener mas de 3 caracteres y menos 24
                    </p>

                    <p class="text-justify">
                        El apellido debe tener mas de 4 caracteres y menos de 24
                    </p>

                    <p class="text-justify">    
                        El correo debe ser un correo valido y no utilizado por otra cuenta
                    </p>

                    <p class="text-justify">
                        La fecha de nacimiento debe ser una fecha valida en formato
                        DD/MM/YYYY, ademas, para tener acceso 
                        a las funcionalidades de "Un Aventon", usted debe ser mayor de 18 años.
                    </p>

                    <p class="text-justify">
                        La contraseña y la comprobacion de contraseña deben coincidir

                    </p>



                    <a href="<?php echo RUTA_LOGIN; ?>">¿ya tienes cuenta?</a>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-center" >
            <div class="card text-center">
                <div class="card-heading">
                    <h3 class="panel-tittle">Intrduce tus datos</h3>
                </div>
                <div class="card-body">
                    <form role="form" method="post" action="<?php echo RUTA_REGISTRO ?>">
                        <?php
                        if (isset($_POST['enviar'])) {
                            include_once 'plantillas/registro_validado.inc.php';
                        } else {
                            include_once 'plantillas/registro_vacio.inc.php';
                        }
                        ?>

                    </form>

                </div>
            </div>


        </div>
    </div>
</div>
<br>
<br>




<?php
include_once 'plantillas/documento-cierre.inc.php';
?>