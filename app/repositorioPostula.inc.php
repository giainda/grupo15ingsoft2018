<?php
include_once 'app/postula.inc.php';

class RepositorioPostula{

public static function viajes_postulado_idUsuario($conexion,$idUsuario){
    $postulado=array();
    if(isset($conexion)){
        try{
            $sql="SELECT * FROM postula WHERE idUsuario = :idUsuario AND eliminado=1";
            $sentencia = $conexion -> prepare($sql);
            $sentencia -> bindParam( ":idUsuario" , $idUsuario, PDO::PARAM_STR);
            $sentencia -> execute();
            $resultado = $sentencia -> fetchAll();
            if(count($resultado)){
                foreach($resultado as $fila){
                    $postulado[]= new Postula($fila['idUsuario'],$fila['idViaje'],$fila['eliminado']);
                }

            }else{
                print '     No hay viajes pendientes';
            }

        }catch(PDOException $ex){
            print 'error' . $ex ->getMessage();
        }

    }
    return $postulado;
}
public static function personas_postuladas_idViaje($conexion,$idViaje){
    $postulados=array();
    if(isset($conexion)){
        try{
            $sql="SELECT * FROM postula WHERE idViaje = :idViaje AND eliminado=1";
            $sentencia = $conexion -> prepare($sql);
            $sentencia -> bindParam( ":idViaje" , $idViaje, PDO::PARAM_STR);
            $sentencia -> execute();
            $resultado = $sentencia -> fetchAll();
            if(count($resultado)){
                foreach($resultado as $fila){
                    $postulados[]= new Postula($fila['idUsuario'],$fila['idViaje'],$fila['eliminado']);
                }}

        }catch(PDOException $ex){
            print 'error' . $ex ->getMessage();
        }

    }
    return $postulados;
}
public static function viajes_postulado_idUsuario2($conexion,$idUsuario){
    $postulado=array();
    if(isset($conexion)){
        try{
            $sql="SELECT * FROM postula WHERE idUsuario = :idUsuario ";
            $sentencia = $conexion -> prepare($sql);
            $sentencia -> bindParam( ":idUsuario" , $idUsuario, PDO::PARAM_STR);
            $sentencia -> execute();
            $resultado = $sentencia -> fetchAll();
            if(count($resultado)){
                foreach($resultado as $fila){
                    $postulado[]= new Postula($fila['idUsuario'],$fila['idViaje'],$fila['eliminado']);
                }}

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
public function crearRelacion($conexion,$idUsuario,$idViaje){
    $conexion_creada=false;
    if(isset($conexion)){
        try{
            $sql="INSERT INTO postula (idUsuario,idViaje,eliminado) VALUES (:idUsuario,:idViaje,1)";
            $sentencia =$conexion ->prepare($sql);
            $sentencia ->bindParam(':idUsuario',$idUsuario,PDO::PARAM_STR);
            $sentencia ->bindParam(':idViaje',$idViaje,PDO::PARAM_STR);
            $conexion_creada=$sentencia ->execute();


        }catch(PDOException $ex){
            print 'error'. $ex -> getMessage();
        }
    }return $conexion_creada; 
}




}