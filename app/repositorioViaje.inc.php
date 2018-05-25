<?php
include_once 'app/viaje.inc.php';

class RepositorioViaje{
    public static function obtener_por_idViaje($conexion,$idViaje){
        $viaje=null;
        if(isset($conexion)){
            try{
                $sql="SELECT * FROM viajes WHERE idViaje = :idViaje";
                $sentencia = $conexion -> prepare($sql);
                $sentencia ->bindParam(':idViaje',$idViaje,PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch();
                if(!empty($resultado)){
                    $viaje=new Viaje($resultado['idViaje'],$resultado['idConductor'],$resultado['patente'],$resultado['fechaCreacion'],$resultado['fechaInicio'],$resultado['inicio'],$resultado['destino'],$resultado['asientos'],$resultado['precio'],$resultado['descripcion'],$resultado['tipoViaje'],$resultado['estado']);
                }
            }catch(PDOException $ex){
                print 'error'. $ex->getMessage();
            }

        }
        return $viaje;

    }
    public static function esta_activo($conexion,$id){
        $activo=null;
        if(isset($conexion)){
            try{
                $sql="SELECT activo FROM viajes WHERE id = :id";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam( ":id" , $id, PDO::PARAM_STR);
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
    public static function viajes_por_idConductor($conexion,$idConductor){
        $viajes=array();
        if(isset($conexion)){
            try{
                $sql="SELECT * FROM viajes WHERE idConductor = :idConductor";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam( ":idConductor" , $idConductor, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $viajes[]= new Viaje($fila['idViaje'],$fila['idConductor'],$fila['patente'],$fila['fechaCreacion'],$fila['fechaInicio'],$fila['inicio'],$fila['destino'],$fila['asientos'],$fila['precio'],$fila['descripcion'],$fila['tipoViaje'],$fila['estado']);
                    }
    
                }else{
                    print 'este conductor no tiene viajes';
                }
    
            }catch(PDOException $ex){
                print 'error' . $ex ->getMessage();
            }
    
        }
        return $viajes;
    } 
    public static function tieneViaje($conexion,$idConductor){
        $es=null;
        if(isset($conexion)){
            try{
                $sql="SELECT COUNT(*) AS si FROM viajes WHERE idConductor= :idConductor";
                $sentencia=$conexion -> prepare($sql);
                $sentencia -> bindParam(':idConductor',$idConductor,PDO::PARAM_STR);
                $sentencia ->execute();
                $resultado=$sentencia ->fetch();
                if($resultado['si']){
                    $es=true;
                }else{
                    $es=false;
                }
            }catch(PDOException $ex){
              print 'error: '. $ex ->getMessage();
    
            }
        }
       return $es;
    }
    public static function autoTieneViaje($conexion,$patente){
        $es=null;
        if(isset($conexion)){
            try{
                $sql="SELECT COUNT(*) AS si FROM viajes WHERE patente= :patente";
                $sentencia=$conexion -> prepare($sql);
                $sentencia -> bindParam(':patente',$patente,PDO::PARAM_STR);
                $sentencia ->execute();
                $resultado=$sentencia ->fetch();
                if($resultado['si']){
                    $es=true;
                }else{
                    $es=false;
                }
            }catch(PDOException $ex){
              print 'error: '. $ex ->getMessage();
    
            }
        }
       return $es;
    } 
     
}