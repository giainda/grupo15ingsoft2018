<?php
include_once 'app/Usuario.inc.php';


class RepositorioUsuario{

    public static function obtener_todos($conexion){
    $usuarios = array();
    if (isset($conexion)){
        try{
            $sql = "SELECT * FROM usuarios";
            $sentencia = $conexion -> prepare($sql);
            $sentencia -> execute();
            $resultado = $sentencia -> fetchAll();
            if (count($resultado)){
                foreach($resultado as $fila){
                    $usuarios[] = new Usuario(
                       $fila['id'],$fila['correo'],$fila['nombre'],$fila['apellido'],$fila['fechanac'],$fila['contraseña'],$fila['fondos'],$fila['codigo_targeta'],$fila['calificacionPos'],$fila['calificacionNeg'],$fila['activo']);

                }
            }else{
                print 'no hay usuarios';
            }

        }catch (PDOException $ex){
            print "error". $ex -> getMessage();
        }
    }
    return $usuarios;
    }
    public static function obtener_numero_usuarios($conexion){
        $total_usuarios =null;
        if (isset($conexion)){
            try{
                $sql="SELECT COUNT(*) as total FROM usuarios";
                $sentencia= $conexion -> prepare($sql);
                $sentencia -> execute();
                $resultado=$sentencia -> fetch();
                $total_usuarios=$resultado['total'];

            }catch(PDOException $ex){
                print 'error'. $ex -> getMessage();
            }

        }
        return $total_usuarios;
    }
    public static function insertar_usuario($conexion,$usuario){
       $usuario_insertado = false;
       if(isset($conexion)){
           try{
               $sql = "INSERT INTO usuarios(correo, nombre, apellido, fechanac, contrasena, fondos, codigo_tarjeta,
               calificacionPos, calificacionNeg, activo)
                VALUES(:correo, :nombre, :apellido, :fechanac, :contrasena, 0, :codigo_tarjeta,0,0,1)";
               $sentencia= $conexion -> prepare($sql);
               $obCorreo= $usuario ->getCorreo();
               $obNombre= $usuario ->getNombre();
               $obApellido= $usuario ->getApellido();
               $obFechanac= $usuario ->getFechanac();
               $obContrasena= $usuario ->getContraseña();
               $obCodigo_targeta= $usuario ->getCodigo_tarjeta();
               $sentencia -> bindParam(':correo',$obCorreo,PDO::PARAM_STR);
               $sentencia -> bindParam(':nombre',$obNombre,PDO::PARAM_STR);
               $sentencia -> bindParam(':apellido',$obApellido,PDO::PARAM_STR);
               $sentencia -> bindParam(':fechanac',$obFechanac,PDO::PARAM_STR);
               $sentencia -> bindParam(':contrasena',$obContrasena,PDO::PARAM_STR);
               $sentencia -> bindParam(':codigo_tarjeta',$obCodigo_targeta,PDO::PARAM_STR);
               $usuario_insertado = $sentencia -> execute();
           }catch (PDOException $ex){
               print 'error'. $ex -> getMessage();
           }
       }
       return $usuario_insertado;
    }
    public static function email_existe($conexion, $email){
        $email_existe=true;
        if(isset($conexion)){
            try{
                $sql="SELECT * FROM usuarios WHERE correo = :correo";
                $sentencia = $conexion ->prepare($sql);
                $sentencia -> bindParam( ':correo', $email ,PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();
                if(count($resultado)){
                    $email_existe=true;
                }else{
                    $email_existe=false;

                }

                }catch(PDOException $ex){
                    print 'error' . $ex -> getMessage();
                }
            }return $email_existe;
    }
    public static function obtener_usuario_por_email($conexion,$email){
        $usuario=null;
        if(isset($conexion)){
            try{
                $sql="SELECT * FROM usuarios WHERE correo = :correo";
                $sentencia =$conexion -> prepare($sql);
                $sentencia -> bindParam( ":correo" , $email, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado=$sentencia -> fetch();
                if(!empty($resultado)){
                    $usuario =new Usuario($resultado['id'],$resultado['correo'],$resultado['nombre'],$resultado['apellido'],$resultado['fechanac'],$resultado['contrasena'],$resultado['fondos'],
                    $resultado['codigo_tarjeta'],$resultado['calificacionPos'],$resultado['calificacionNeg'],$resultado['activo']);
                }
            }catch(PDOException $ex){
                print "error". $ex ->getMessage();
            }
        }
        return $usuario;
        
    }
    public static function esta_activo($conexion,$email){
        $activo=null;
        if(isset($conexion)){
            try{
                $sql="SELECT activo FROM usuarios WHERE correo = :correo";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam( ":correo" , $email, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch();
                
                    if($resultado['activo']){
                        $activo=true;
                    }else{
                        $activo=false;
                    
                }
            }catch(PDOException $ex){
                print "error". $ex ->getMessage();
            }
        }
        return $activo;
    }
    public static function obtener_usuario_por_id($conexion,$id){
        $usuario=null;
        if(isset($conexion)){
            try{
                $sql="SELECT * FROM usuarios WHERE id = :id";
                $sentencia =$conexion -> prepare($sql);
                $sentencia -> bindParam( ":id" , $id, PDO::PARAM_STR);               
                $sentencia -> execute();
                $resultado=$sentencia -> fetch();
                if(!empty($resultado)){
                    $usuario =new Usuario($resultado['id'],$resultado['correo'],$resultado['nombre'],$resultado['apellido'],$resultado['fechanac'],$resultado['contrasena'],$resultado['fondos'],
                    $resultado['codigo_tarjeta'],$resultado['calificacionPos'],$resultado['calificacionNeg'],$resultado['activo']);
                }
            }catch(PDOException $ex){
                print "error". $ex ->getMessage();
            }
        }
        return $usuario;
        
    }
    public static function actualizarInfo($nombre,$apellido,$codigo_tarjeta,$id,$conexion){
        $actualizacion_correcta=false;
        if(isset($conexion)){
            try{
                $sql="UPDATE usuarios SET nombre= :nombre, apellido=:apellido, codigo_tarjeta=:codigo_tarjeta WHERE id=:id";
                $sentencia=$conexion ->prepare($sql);
                $sentencia -> bindParam( ":id" , $id, PDO::PARAM_STR);
                $sentencia -> bindParam( ":nombre" , $nombre, PDO::PARAM_STR);
                $sentencia -> bindParam( ":apellido" , $apellido, PDO::PARAM_STR);
                $sentencia -> bindParam( ":codigo_tarjeta" , $codigo_tarjeta, PDO::PARAM_STR);
                $sentencia ->execute();
            
                    $actualizacion_correcta=true;

                   

            }catch(PDOException $ex){
                print "error: ".$ex->getMessage();

            }
        }
        return $actualizacion_correcta;
    } 
    public static function actualizarContraseña($contraseña,$id,$conexion){
        $actualizacion_correcta=false;
        if(isset($conexion)){
            try{
                $sql= "UPDATE usuarios SET contrasena=:contrasena WHERE id= :id";
                $sentencia = $conexion -> prepare($sql);
                $sentencia ->bindParam( ":id", $id, PDO::PARAM_STR);
                $sentencia ->bindParam( ":contrasena", $contraseña, PDO::PARAM_STR);
                $sentencia ->execute();
                $actualizacion_correcta=true;

            }catch(PDOException $ex){
                print "error: ".$ex->getMessage();

            }
        }
        return $actualizacion_correcta;
    }
    public static function eliminar($id,$conexion){
        $ok=false;
        if(isset($conexion)){
            try{
                $sql="UPDATE usuarios SET activo=0 WHERE id=:id";
                $sentencia=$conexion ->prepare($sql);
                $sentencia ->bindParam(":id", $id, PDO::PARAM_STR);
                $sentencia ->execute();
              $ok=true;
            }catch(PDOException $ex){
                print "erro: ". $ex->getMessage();
            }
        }
        return $ok;
    }
}