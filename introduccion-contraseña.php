<?php
 include_once 'app/Config.inc.php';
 include_once 'app/Redireccion.inc.php';
 include_once 'app/Conexion.inc.php';
 include_once 'app/Usuario.inc.php';
 include_once 'app/RepositorioUsuario.inc.php';
 include_once 'plantillas/documento-declaracion.inc.php';
 include_once 'plantillas/navbar2.inc.php';
 include_once 'app/validadorLogin.inc.php';


 if(!ControlSesion::sesion_iniciada()){
    Redireccion::redirigir(SERVIDOR);
}
$usuario = RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(), $_SESSION['id_usuario']);
?>
<div class="container py-1 margen">
    <div class="row">
        <div class="col-md-12">
            
            <div class="row">
                <div class="col-md-6 mx-auto">

                    <!-- form card login -->
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="mb-0">Cambio de contraseña</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" id="formLogin" novalidate="" method="POST">
                
                                <div class="form-group">
                                    <label>Introduzca su contraseña actual</label>
                                    <input type="password" name="clave" class="form-control form-control-lg rounded-0" placeholder="contraseña" required="" autocomplete="new-password">
                                </div>
                                <?php
                                if(isset($_POST['login'])){
                                    if(!password_verify($_POST['clave'], RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(), $_SESSION['id_usuario']) ->getContraseña())){
                                        ?> <br><div class='alert alert-danger' role='alert'>
                                                <?php echo "Contraseña incorrecta" ?>
                                            </div><br>
                                            <?php
                                    }else{
                                        Redireccion::redirigir(RUTA_EDITOR_CONTRASEÑA);
                                    }
                                 }
                                 ?>
                                <button type="submit" name="login" class="btn botoncss form-control" >Confirmar contraseña</button>
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