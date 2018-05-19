<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/repositorioUsuario.inc.php';
include_once 'app/ValidadorLogin.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/validadorContraseña.inc.php';
if(!ControlSesion::sesion_iniciada()){
    Redireccion::redirigir(SERVIDOR);
}
$ok=false;
$usuario_modificado=false;
$titulo ='editor contraseña';
include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar2.inc.php';
if(isset($_POST['ok'])){
 $validador= new validadorContraseña($_POST['contraseña'],$_POST['contraseña2']);
 if($validador -> contraseña_valida()){
     $usuario_modificado=repositorioUsuario::actualizarContraseña(password_hash($validador ->getContraseña(),PASSWORD_DEFAULT),$_SESSION['id_usuario'],Conexion::obtener_conexion());
 }
}
?>
<div class="container py-1">
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
                                    <label for="uname1">contraseña nueva</label>
                                    <input type="password" class="form-control form-control-lg rounded-0" name="contraseña"  placeholder="*****"
                                    required autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Repetir contraseña nueva</label>
                                    <input type="password" name="contraseña2" class="form-control form-control-lg rounded-0" placeholder="*****" required="" autocomplete="new-password">
                                </div>
                                <?php 
                                 if(isset($_POST['ok'])){
                                   if(!$validador ->contraseña_valida()){
                                       $validador ->mostrar_error_contraseña();
                                   }
                                }
                                ?>
                                <br>
                            
                                <button type="submit" name="ok" class="btn botoncss form-control" >Confirmar cambio</button>
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
<div class="modal fade" id="dialogoCorrecto">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                <!-- cabecera del diálogo -->
                                <div class="modal-header">
                                    <a type="button" class="btn btn-primary ml-auto" href="<?php echo RUTA_PERFIL ?>" >X</a>
                                </div>

                                <!-- cuerpo del diálogo -->
                                <div class="modal-body">
                                    <h4>El cambio de contraseña se realizo correctamente</h4>
                                     <?php $ok=true;?>
                                    <br>
                                    <br>
                                </div>


                            </div>
                        </div>
                    </div>
                    <?php
 include_once 'plantillas/documento-cierre.inc.php';
 if($usuario_modificado){
 ?>
 <script>$('.modal').modal('show');</script>
 <?php }
 

 ?>                    
<!--/container-->