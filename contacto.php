<?php

include_once "app/repositorioUsuario.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/Redireccion.inc.php";
include_once "plantillas/documento-declaracion.inc.php";
include_once "plantillas/navbar2.inc.php";
Conexion::abrir_conexion();
if(!ControlSesion::sesion_iniciada()){
    Redireccion::redirigir(SERVIDOR);
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
                            <h3 class="mb-0">Contacto</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form"  method="POST">
                
                                <div class="form-group">
                                    <label>Correo en que desea su respuesta</label>
                                    <input type="email" name="correo" class="form-control form-control-lg rounded-0" placeholder="correo" required >
                                </div>
                                <div class="form-group">
                                    <label>escriba aquí su consulta</label>
                                    <input type="text" name="apellido" class="form-control form-control-lg rounded-0" style="height:150px;"  placeholder="apellido" required >
                                </div>
                                <?php
                                if(isset($_POST['login'])){
                                        echo "<br><div class='alert alert-success' role='alert'>
                                        <h4> mensaje enviado correctamente </h4> 
                                    </div><br>";
                                    }

                                    
                                    
                                 ?>
                                <button type="submit" name="login" class="btn botoncss form-control" >Enviar</button>
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