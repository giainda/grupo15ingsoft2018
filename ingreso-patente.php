<?php
include_once "app/repositorioAuto.inc.php";
include_once "app/repositorioConductor.inc.php";
include_once "app/repositorioUsuario.inc.php";
include_once "app/repositorioTiene.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/ControlSesion.inc.php";
include_once "app/config.inc.php";
include_once "app/Redireccion.inc.php";

include_once "plantillas/documento-declaracion.inc.php";
include_once "plantillas/navbar2.inc.php";
if(!ControlSesion::sesion_iniciada()){
    Redireccion::redirigir(SERVIDOR);
}

$usuario=RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(),$_SESSION["id_usuario"]);
if(isset($_POST['patente'])){
    $seleccion=$_POST['tipoPatente'];}

?>
<div class="container py-1">
    <div class="row">
        <div class="col-md-12">
            
            <div class="row">
                <div class="col-md-6 mx-auto">

                    <!-- form card login -->
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="mb-0">Registro de vehículo</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" id="formPatente" novalidate="" method="POST">
                            <label for="inputState">Tipo de patente</label>
                            <select id="inputState" name=tipoPatente class="form-control">
                            <option>MercoSur (aa111aa)</option>
                            <option <?php if(isset($_POST['comprobar'])){if($seleccion==='Argentina (aaa111)'){echo ' selected';}} ?>>Argentina (aaa111)</option>
                            </select>
                            <br>
                                <div class="form-group">
                                    <label>Pantente (Sin espacios)</label>
                                    <input type="text" name="patente" class="form-control form-control-lg rounded-0" placeholder="patente" required="" autocomplete="patente">
                                </div>
                                <br>
                                <?php 
                                $error='';
                                if(isset($_POST['comprobar'])){
                                    if(empty($_POST['patente'])){
                                        echo "<div class= 'alert alert-danger' role='alert'> debe rellenar el campo patente</div>"; 
                                    }else{
                                    if(isset($_POST['patente'])){
                                        $seleccion=$_POST['tipoPatente'];
                                        if($seleccion==='Argentina (aaa111)'){
                                            $primera=substr($_POST['patente'],0,3);
                                            $segunda=substr($_POST['patente'],3,6);
                                            if(!ctype_alpha($primera)||!ctype_digit($segunda)){
                                                echo "<div class= 'alert alert-danger' role='alert'> el formato de la patente no se corresponde con el tipo seleccionado</div>";
                                            }else{
                                                $auto=RepositorioAuto::obtener_por_patente(Conexion::obtener_conexion(),$_POST['patente']);
                                                if($auto!==null){
                                                   
                                                   if(RepositorioTiene::existeRelacion(Conexion::obtener_conexion(),$_SESSION['id_usuario'],$auto->getPatente())){
                                                    echo "<div class= 'alert alert-danger' role='alert'> esta patente ya fue vinculada a su cuenta</div>";
                                                   }else{
                                                     Redireccion::redirigir(RUTA_AUTO_EXISTE.'?patente='.$auto->getPatente());  

                                                   }  

                                                
                                            }else{
                                                Redireccion::redirigir(RUTA_AUTO_NUEVO.'?patente='.$_POST['patente']);
                                                
                                            }
                                        }
                                
                                        }else{
                                            $primera=substr($_POST['patente'],0,2);
                                            $prin=substr($_POST['patente'],0,5);
                                            $segunda=substr($prin,2,5);
                                            $tercera=substr($_POST['patente'],5,7);
                                            if(!ctype_alpha($primera)||!ctype_alpha($tercera)||!ctype_digit($segunda)){
                                                
                                                echo "<div class= 'alert alert-danger' role='alert'> el formato de la patente no se corresponde con el tipo seleccionado</div>";
                                            }else{
                                                $auto=RepositorioAuto::obtener_por_patente(Conexion::obtener_conexion(),$_POST['patente']);
                                                if($auto!==null){
                                                   
                                                   if(RepositorioTiene::existeRelacion(Conexion::obtener_conexion(),$_SESSION['id_usuario'],$auto->getPatente())){
                                                    echo "<div class= 'alert alert-danger' role='alert'> esta patente ya fue vinculada a su cuenta</div>";
                                                   }else{
                                                     Redireccion::redirigir(RUTA_AUTO_EXISTE.'?patente='.$auto->getPatente());  

                                                   }  

                                                
                                            }else{
                                                Redireccion::redirigir(RUTA_AUTO_NUEVO.'?patente='.$_POST['patente']);
                                                
                                            }
                                            }
                                        }
                                    }
                                    }
                                                                    
                                }
                                ?>
                                <br>
                                <button type="submit" name="comprobar" class="btn botoncss form-control" >Confirmar patente</button>
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
include_once "plantillas/documento-cierre.inc.php";?>

