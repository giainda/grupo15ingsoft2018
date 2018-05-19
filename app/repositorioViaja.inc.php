<?php
include_once 'app/viaja.inc.php';

class RepositorioViaja{

public static function viajes_viaja_idUsuario($conexion,$idUsuario){
    $viaja=array();
    if(isset($conexion)){
        try{
            $sql="SELECT * FROM viaja WHERE idUsuario = :idUsuario";
            $sentencia = $conexion -> prepare($sql);
            $sentencia -> bindParam( ":idUsuario" , $idUsuario, PDO::PARAM_STR);
            $sentencia -> execute();
            $resultado = $sentencia -> fetchAll();
            if(count($resultado)){
                foreach($resultado as $fila){
                    $viaja[]= new Postula($fila['idUsuario'],$fila['idViaje'],$fila['eliminado']);
                }

            }else{
                print 'no viaja en nada';
            }

        }catch(PDOException $ex){
            print 'error' . $ex ->getMessage();
        }

    }
    return $viaja;
}
public static function noEliminado($conexion,$idUsuario,$idViaje){
    $noeliminado=null;
    if(isset($conexion)){
        try{
            $sql="SELECT eliminado FROM viaja WHERE idUsuario = :idUsuario AND idViaje = :idViaje";
            $sentencia = $conexion -> prepare($sql);
            $sentencia -> bindParam( ":idUsuario" , $idUsuario, PDO::PARAM_STR);
            $sentencia -> bindParam( ":idViaje" , $idViaje, PDO::PARAM_STR);
            $sentencia -> execute();
            $resultado = $sentencia -> fetch();
            
                if($resultado['eliminado']){
                    $noeliminado=true;
                }else{
                    $noeliminado=false;
                
            }
        }catch(PDOException $ex){
            print "error". $ex ->getMessage();
        }
    }
    return $noeliminado;
}
public static function viaja($conexion,$idUsuario){
    $es=null;
    if(isset($conexion)){
        try{
            $sql="SELECT COUNT(*) AS si FROM viaja WHERE idUsuario= :idUsuario";
            $sentencia=$conexion -> prepare($sql);
            $sentencia -> bindParam(':idUsuario',$idUsuario,PDO::PARAM_STR);
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