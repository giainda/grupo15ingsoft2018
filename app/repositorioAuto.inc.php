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
}