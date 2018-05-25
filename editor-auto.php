<?php
 include_once 'app/Config.inc.php';
 include_once 'app/Conexion.inc.php';
 include_once 'app/Usuario.inc.php';
 include_once 'app/RepositorioAuto.inc.php';
 include_once 'app/Redireccion.inc.php';
 include_once 'app/ControlSesion.inc.php';
 include_once 'app/validadorEditorAuto.inc.php';
 include_once 'plantillas/documento-declaracion.inc.php';
 include_once 'app/fotos.inc.php';
 if (!ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(SERVIDOR);
}
if(isset($_GET['patente'])&&!empty($_GET['patente'])){
    $patente=$_GET['patente'];}else{Redireccion::redirigir(SERVIDOR);}
$auto_modificado=false;
Conexion::abrir_conexion();
$auto = RepositorioAuto::obtener_por_patente(Conexion::obtener_conexion(),$patente);
if (isset($_POST['enviar'])){
    $validador =new ValidadorEditorAuto($_POST['capasidad'],$_POST['color']);
if($validador->editor_valido()){
    $auto_modificado = RepositorioAuto:: actualizarInfo($validador->obtener_capasidad(),$validador->obtener_color(),$auto -> getPatente(),Conexion::obtener_conexion());
    }   
    }



 $titulo='unAventon editor auto';


 include_once 'plantillas/navbar2.inc.php';
 
 ?>
<div class="container ">
    <div class="jumbotron">
        <h1 class="text-center">Formulario editor de informacion del auto</h1>
    </div>
</div>  
<br>
<br>  
    <div class="container contenedorasd">
        <div class="row">
            
            <div class="col-md-6 text-center" >
                <div class="card text-center">
                    <div class="card-heading">
                        <h3 class="panel-tittle">Cambiar datos auto</h3>
                    </div>
                    <div class="card-body">
                        <form role="form" method="post" action="<?php echo RUTA_EDITOR_AUTO."?patente=".$patente;?>">
                            <?php
                             if (isset($_POST['enviar'])){
                                include_once 'plantillas/editor_auto_validado.inc.php';
                             }else{
                                include_once 'plantillas/editor_auto_vacio.inc.php';

                             }
                             
                            ?>
                            </form>
                             
                        
                        
                    </div>
                </div>
            
                
            </div>
            <div class="col-md-6 text-center ">               
             <div class="card text-center">
                    <div class="card-heading">
                        <h3 class="panel-tittle">Actualizar foto</h3>
                     <div class="card-body ">
                     <form action ="tratadoDeImagenAuto.inc.php?patente=<?php echo $patente?>" method="post" enctype="multipart/form-data">
                               <labe>Seleccione su imagen </label>
                               <input type="file" name="imagen" accept="image/png, .jpeg, .jpg, image/gif" required>
                               <input type="submit" value="aceptar">
                               
                            </form> 
                     </div>
                </div>
                </div>    
             </div>
        </div>
    </div>
    <br>
    <br>
    <div class="modal fade" id="dialogoCorrecto">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                <!-- cabecera del diálogo -->
                                <div class="modal-header">
                                <a type="button" class="btn botoncss ml-auto" href="<?php echo RUTA_MOSTRAR_AUTO."?patente=".$patente; ?>" >X</a>
                                </div>

                                <!-- cuerpo del diálogo -->
                                <div class="modal-body">
                                    <?php if(!isset($_GET['ok'])){?>
                                    <h4>Los cambios se realizaron correctamente</h4><?php }else{?><h4>La foto se subio correctamente</h4><?php } ?>
                                    <br>
                                    <br>
                                </div>


                            </div>
                        </div>
                    </div>




<?php
 include_once 'plantillas/documento-cierre.inc.php';
 if($auto_modificado){
 ?>
 <script>$('.modal').modal('show');</script>
 <?php }
 if(isset($_GET['ok'])){
     ?>
     <script>$('.modal').modal('show');</script>
     <?php   
 } 
 ?>
 