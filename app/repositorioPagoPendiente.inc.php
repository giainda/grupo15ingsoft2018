<?php
include_once 'app/pagoPendiente.inc.php';

class RepositorioPagoPendiente{

public static function pago_pendiente_idUsuario($conexion,$idUsuarioDeudor){
    $viaja=array();
    if(isset($conexion)){
        try{
            $sql="SELECT * FROM pago_pendiente WHERE idUsuarioDeudor = :idUsuarioDeudor";
            $sentencia = $conexion -> prepare($sql);
            $sentencia -> bindParam( ":idUsuarioDeudor" , $idUsuarioDeudor, PDO::PARAM_STR);
            $sentencia -> execute();
            $resultado = $sentencia -> fetchAll();
            if(count($resultado)){
                foreach($resultado as $fila){
                    $viaja[]= new Postula($fila['idUsuarioDeudor'],$fila['idUsuariCobrador']);
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
public static function debePago($conexion,$idUsuarioDeudor){
    $es=null;
    if(isset($conexion)){
        try{
            $sql="SELECT COUNT(*) AS si FROM pago_pendiente WHERE idUsuarioDeudor= :idUsuarioDeudor";
            $sentencia=$conexion -> prepare($sql);
            $sentencia -> bindParam(':idUsuarioDeudor',$idUsuarioDeudor,PDO::PARAM_STR);
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