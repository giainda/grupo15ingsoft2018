<?php
include_once 'app/calificacionPendiente.inc.php';

class RepositorioCalificacionPendiente{

public static function calificacion_pendiente_idUsuario($conexion,$idUsuariocalificador){
    $viaja=array();
    if(isset($conexion)){
        try{
            $sql="SELECT * FROM calificacion_pendiente WHERE idUsuariocalificador = :idUsuariocalificador";
            $sentencia = $conexion -> prepare($sql);
            $sentencia -> bindParam( ":idUsuariocalificador" , $idUsuariocalificador, PDO::PARAM_STR);
            $sentencia -> execute();
            $resultado = $sentencia -> fetchAll();
            if(count($resultado)){
                foreach($resultado as $fila){
                    $viaja[]= new Postula($fila['idUsuariocalificador'],$fila['idUsuariAcalificar']);
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
public static function debeCalificacion($conexion,$idUsuariocalificador){
    $es=null;
    if(isset($conexion)){
        try{
            $sql="SELECT COUNT(*) AS si FROM calificacion_pendiente WHERE idUsuariocalificador= :idUsuariocalificador";
            $sentencia=$conexion -> prepare($sql);
            $sentencia -> bindParam(':idUsuariocalificador',$idUsuariocalificador,PDO::PARAM_STR);
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