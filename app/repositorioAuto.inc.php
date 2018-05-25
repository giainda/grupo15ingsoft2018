<?php
include_once 'app/auto.inc.php';

class RepositorioAuto{
    public static function obtener_por_patente($conexion,$patente){
        $auto=null;
        if(isset($conexion)){
            try{
                $sql="SELECT * FROM auto WHERE patente = :patente";
                $sentencia = $conexion -> prepare($sql);
                $sentencia ->bindParam(':patente',$patente,PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch();
                if(!empty($resultado)){
                    $auto=new Auto($resultado['patente'],$resultado['marca'],$resultado['modelo'],$resultado['capasidad'],$resultado['color'],$resultado['tipo'],$resultado['activo']);
                }
            }catch(PDOException $ex){
                print 'error'. $ex->getMessage();
            }

        }
        return $auto;

    }
    public static function esta_activo($conexion,$patente){
        $activo=null;
        if(isset($conexion)){
            try{
                $sql="SELECT activo FROM auto WHERE patente = :patente";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam( ":patente" , $patente, PDO::PARAM_STR);
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
    public static function eliminar($patente,$conexion){
        $ok=false;
        if(isset($conexion)){
            try{
                $sql="UPDATE auto SET activo=0 WHERE patente=:patente";
                $sentencia=$conexion ->prepare($sql);
                $sentencia ->bindParam(":patente", $patente, PDO::PARAM_STR);
                $sentencia ->execute();
              $ok=true;
            }catch(PDOException $ex){
                print "erro: ". $ex->getMessage();
            }
        }
        return $ok;
    } 
    public static function restablecer($patente,$conexion){
        $ok=false;
        if(isset($conexion)){
            try{
                $sql="UPDATE auto SET activo=1 WHERE patente=:patente";
                $sentencia=$conexion ->prepare($sql);
                $sentencia ->bindParam(":patente", $patente, PDO::PARAM_STR);
                $sentencia ->execute();
              $ok=true;
            }catch(PDOException $ex){
                print "erro: ". $ex->getMessage();
            }
        }
        return $ok;
    }  
    public static function insertar_auto($conexion,$auto){
        $auto_insertado = false;
        if(isset($conexion)){
            try{
                $sql = "INSERT INTO auto(patente, marca, modelo, capasidad, color, tipo, activo)
                 VALUES(:patente, :marca, :modelo, :capasidad, :color,:tipo,1)";
                $sentencia= $conexion -> prepare($sql);
                $obPatente= $auto ->getPatente();
                $obMarca= $auto ->getMarca();
                $obModelo= $auto ->getModelo();
                $obCapasidad= $auto ->getCapasidad();
                $obColor= $auto ->getColor();
                $obTipo= $auto ->getTipo();
                $sentencia -> bindParam(':patente',$obPatente,PDO::PARAM_STR);
                $sentencia -> bindParam(':marca',$obMarca,PDO::PARAM_STR);
                $sentencia -> bindParam(':modelo',$obModelo,PDO::PARAM_STR);
                $sentencia -> bindParam(':capasidad',$obCapasidad,PDO::PARAM_STR);
                $sentencia -> bindParam(':color',$obColor,PDO::PARAM_STR);
                $sentencia -> bindParam(':tipo',$obTipo,PDO::PARAM_STR);
                $auto_insertado = $sentencia -> execute();
            }catch (PDOException $ex){
                print 'error'. $ex -> getMessage();
            }
        }
        return $auto_insertado;
     }
     public static function actualizarInfo($capasidad,$color,$patente,$conexion){
        $actualizacion_correcta=false;
        if(isset($conexion)){
            try{
                $sql="UPDATE auto SET capasidad= :capasidad, color=:color  WHERE patente=:patente";
                $sentencia=$conexion ->prepare($sql);
                $sentencia -> bindParam( ":patente" , $patente, PDO::PARAM_STR);
                $sentencia -> bindParam( ":capasidad" , $capasidad, PDO::PARAM_STR);
                $sentencia -> bindParam( ":color" , $color, PDO::PARAM_STR);
                $sentencia ->execute();
            
                    $actualizacion_correcta=true;

                   

            }catch(PDOException $ex){
                print "error: ".$ex->getMessage();

            }
        }
        return $actualizacion_correcta;
    } 
}