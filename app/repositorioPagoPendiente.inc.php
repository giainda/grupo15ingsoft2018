<?php
include_once 'app/pagoPendiente.inc.php';

class RepositorioPagoPendiente{

public static function pago_pendiente_idUsuario($conexion,$idUsuarioDeudor){
    $viaja=array();
    if(isset($conexion)){
        try{
            $sql="SELECT * FROM pago_pendiente WHERE idUsuarioDeudor = :idUsuarioDeudor AND activo=1";
            $sentencia = $conexion -> prepare($sql);
            $sentencia -> bindParam( ":idUsuarioDeudor" , $idUsuarioDeudor, PDO::PARAM_STR);
            $sentencia -> execute();
            $resultado = $sentencia -> fetchAll();
            if(count($resultado)){
                foreach($resultado as $fila){
                    $viaja[]= new PagoPendiente($fila['id'],$fila['idUsuarioDeudor'],$fila['idusuarioCobrador'],$fila['monto']);
                }

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
            $sql="SELECT COUNT(*) AS si FROM pago_pendiente WHERE idUsuarioDeudor= :idUsuarioDeudor AND activo=1";
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
public function crearPagoPendiente($conexion,$idUsuario,$idConductor,$monto){
    $conexion_creada=false;
    if(isset($conexion)){
        try{
            $sql="INSERT INTO pago_pendiente (idUsuarioDeudor,idUsuarioCobrador,activo,monto) VALUES (:idUsuario,:idConductor,1,:monto)";
            $sentencia =$conexion ->prepare($sql);
            $sentencia ->bindParam(':idUsuario',$idUsuario,PDO::PARAM_STR);
            $sentencia ->bindParam(':monto',$monto,PDO::PARAM_STR);
            $sentencia ->bindParam(':idConductor',$idConductor,PDO::PARAM_STR);
            $conexion_creada=$sentencia ->execute();


        }catch(PDOException $ex){
            print 'error'. $ex -> getMessage()." crarPagoPendiente";
        }
    }return $conexion_creada; 
}
public static function pagado($id,$conexion){
    $ok=false;
    if(isset($conexion)){
        try{
            $sql="UPDATE pago_pendiente SET activo=0 WHERE id=:id";
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