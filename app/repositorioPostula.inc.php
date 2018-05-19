<?php
include_once 'app/postula.inc.php';

class RepositorioPostula{

public static function viajes_postulado_idUsuario($conexion,$idUsuario){
    $postulado=array();
    if(isset($conexion)){
        try{
            $sql="SELECT * FROM postula WHERE idUsuario = :idUsuario";
            $sentencia = $conexion -> prepare($sql);
            $sentencia -> bindParam( ":idUsuario" , $idUsuario, PDO::PARAM_STR);
            $sentencia -> execute();
            $resultado = $sentencia -> fetchAll();
            if(count($resultado)){
                foreach($resultado as $fila){
                    $postulado[]= new Postula($fila['idUsuario'],$fila['idViaje'],$fila['eliminado']);
                }

            }else{
                print 'no se postulo a nada';
            }

        }catch(PDOException $ex){
            print 'error' . $ex ->getMessage();
        }

    }
    return $postulado;
}
public static function noEliminado($conexion,$idUsuario,$idViaje){
    $noeliminado=null;
    if(isset($conexion)){
        try{
            $sql="SELECT eliminado FROM postula WHERE idUsuario = :idUsuario AND idViaje = :idViaje";
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


}