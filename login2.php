<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/repositorioUsuario.inc.php';
include_once 'app/ValidadorLogin.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';
if (ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(SERVIDOR);
}
if (isset($_POST['login'])) {
    Conexion::abrir_conexion();
    $validador = new ValidadorLogin($_POST['email'], $_POST['clave'], Conexion::obtener_conexion());
    if ($validador->obtener_error() === '' && !is_null($validador->obtener_usuario())) {
        ControlSesion::iniciar_sesion($validador->obtener_usuario()->getId(), $validador->obtener_usuario()->getNombre());
        Redireccion::redirigir(SERVIDOR);
    }
    Conexion::cerrar_conexion();
}

$titulo = 'Login';
include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar2.inc.php';
?>
<div class="container py-1">
    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-6 mx-auto">

                    <!-- form card login -->
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="mb-0">Iniciar Sesion</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" id="formLogin" novalidate="" method="POST">
                                <div class="form-group">
                                    <label for="uname1">Correo</label>
                                    <input type="email" class="form-control form-control-lg rounded-0" name="email"  placeholder="email"
                                    <?php
                                    if (isset($_POST['login']) && isset($_POST['email']) && !empty($_POST['email'])) {
                                        echo 'value="' . $_POST['email'] . '"';
                                    }
                                    ?>required autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input type="password" name="clave" class="form-control form-control-lg rounded-0" placeholder="contraseña" required="" autocomplete="new-password">
                                </div>
                                <?php
                                if (isset($_POST['login'])) {
                                    $validador->mostrar_error();
                                }
                                ?>
                                <br>
                                <a href="recuperar-contraseña-email.php">¿Olvidó su contraseña?</a>
                                <br>
                                <button type="submit" name="login" class="btn botoncss form-control" >Iniciar Sesion</button>
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