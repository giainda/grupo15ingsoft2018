<?php
 include_once 'app/Config.inc.php';
 include_once 'app/Conexion.inc.php';
 include_once 'app/Usuario.inc.php';
 include_once 'app/RepositorioUsuario.inc.php';
 include_once 'app/Redireccion.inc.php';
 include_once 'app/ControlSesion.inc.php';
 include_once 'app/validadorEditor.inc.php';
 include_once 'plantillas/documento-declaracion.inc.php';
 include_once 'app/fotos.inc.php';
 if (!ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(SERVIDOR);
}
$usuario_modificado=false;
Conexion::abrir_conexion();
$usuario = RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(), $_SESSION['id_usuario']);
if (isset($_POST['enviar'])){
    if($usuario ->getCodigo_tarjeta()!=0){
    $validador =new ValidadorEditor($_POST['nombre'],$_POST['apellido'],$_POST['codigo_tarjeta'],Conexion::obtener_conexion());
    }else{
        $validador =new ValidadorEditor($_POST['nombre'],$_POST['apellido'],111111111111,Conexion::obtener_conexion());  
    }
if($validador->editor_valido()){
    if($usuario ->getCodigo_tarjeta()!=0){
    $usuario_modificado = RepositorioUsuario :: actualizarInfo($validador->obtener_nombre(),$validador->obtener_apellido(),$validador->obtener_codigo_tarjeta(),$_SESSION['id_usuario'],Conexion::obtener_conexion());
    }else{$usuario_modificado = RepositorioUsuario :: actualizarInfo($validador->obtener_nombre(),$validador->obtener_apellido(),0,$_SESSION['id_usuario'],Conexion::obtener_conexion());
    }?>
    
    <?php
    if($usuario_modificado){
        ControlSesion::iniciar_sesion($usuario ->getId(),$validador->obtener_nombre());
    }
    
    }
}


 $titulo='unAventon editor perfil';


 include_once 'plantillas/navbar2.inc.php';
 
 ?>
<div class="container ">
    <div class="jumbotron">
        <h1 class="text-center">Formulario editor de informacion</h1>
    </div>
</div>  
<br>
<br>  
    <div class="container contenedorasd">
        <div class="row">
            
            <div class="col-md-6 text-center" >
                <div class="card text-center">
                    <div class="card-heading">
                        <h3 class="panel-tittle">Cambiar datos</h3>
                    </div>
                    <div class="card-body">
                        <form role="form" method="post" action="<?php echo RUTA_EDITOR_PERFIL?>">
                            <?php
                             if (isset($_POST['enviar'])){
                                include_once 'plantillas/editor_validado.inc.php';
                             }else{
                                include_once 'plantillas/editor_primario.inc.php';

                             }
                             
                            ?>
                            </form>
                             
                        
                        
                    </div>
                </div>
            
                
            </div>
            <div class="col-md-6 text-center ">
                  <div class="card text-center">
                    <div class="card-heading">
                        <h3 class="panel-tittle">Cambiar contraseña</h3>
                     <div class="card-body ">
                      <div class="row ">
                          
                       <div class="col-md-6">
                       <h5>Contraseña</h5>
                      </div>
                       <div class="col-md-6">
                        <a  href="<?php echo RUTA_INTRODUCCION_CONTRASEÑA?>">Cambiar </a>
                     </div>
                     </div>
                </div>
                </div>    
             </div>
             <br>
             <br>
             <div class="card text-center">
                    <div class="card-heading">
                        <h3 class="panel-tittle">Actualizar foto</h3>
                     <div class="card-body ">
                     <form action ="tratadoDeImagen.inc.php?id=<?php echo $_SESSION['id_usuario']?>" method="post" enctype="multipart/form-data">
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
                                <a type="button" class="btn botoncss ml-auto" href="<?php echo RUTA_PERFIL ?>" >X</a>
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
 if($usuario_modificado){
 ?>
 <script>$('.modal').modal('show');</script>
 <?php }if(isset($_GET['ok'])){
     ?>
     <script>$('.modal').modal('show');</script>
     <?php   
 } 
 ?>
 