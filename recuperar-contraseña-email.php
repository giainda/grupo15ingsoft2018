<?php

include_once "app/repositorioUsuario.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/Redireccion.inc.php";
include_once "plantillas/documento-declaracion.inc.php";
include_once "plantillas/navbar2.inc.php";
Conexion::abrir_conexion();
if(isset($_POST['login'])){
    if(RepositorioUsuario :: email_existe(Conexion::obtener_conexion(),$_POST['correo'])){
        $usuario=RepositorioUsuario::obtener_usuario_por_email(Conexion::obtener_conexion(),$_POST['correo']);
        if(($usuario->getNombre()===$_POST['nombre'])&&($usuario->getApellido()===$_POST['apellido'])){        
        Redireccion::redirigir(RUTA_RECUPERAR_CONTRASEÑA."?idUs=".$usuario->getId()."&&nom=".$usuario->getNombre());
     }}}
?>
<div class="container py-1">
    <div class="row">
        <div class="col-md-12">
            
            <div class="row">
                <div class="col-md-6 mx-auto">

                    <!-- form card login -->
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="mb-0">Recuperacion de contraseña</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form"  method="POST">
                
                                <div class="form-group">
                                    <label>Introduzca el correo con el que tiene su cuenta creada</label>
                                    <input type="email" name="correo" class="form-control form-control-lg rounded-0" placeholder="correo" required >
                                </div>
                                <div class="form-group">
                                    <label>Nombre que tiene en su cuenta</label>
                                    <input type="text" name="nombre" class="form-control form-control-lg rounded-0" placeholder="nombre" required >
                                </div>
                                <div class="form-group">
                                    <label>Apellido que tiene en su cuenta</label>
                                    <input type="text" name="apellido" class="form-control form-control-lg rounded-0" placeholder="apellido" required >
                                </div>
                                <?php
                                if(isset($_POST['login'])){
                                    if(RepositorioUsuario :: email_existe(Conexion::obtener_conexion(),$_POST['correo'])){
                                        echo "<br><div class='alert alert-danger' role='alert'>
                                        <h4> nombre o apellido incorrecto </h4> 
                                        </div><br>";
                                     }else{
                                        echo "<br><div class='alert alert-danger' role='alert'>
                                        <h4> no hay ninguna cuenta creada con ese Email </h4> 
                                    </div><br>";
                                    }

                                    
                                    }
                                 ?>
                                <button type="submit" name="login" class="btn botoncss form-control" >Confirmar correo</button>
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

<?php
include_once "plantillas/documento-cierre.inc.php";