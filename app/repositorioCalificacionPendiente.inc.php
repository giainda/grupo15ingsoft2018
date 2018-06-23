<?php
include_once 'app/calificacionPendiente.inc.php';

class RepositorioCalificacionPendiente{

public static function calificacion_pendiente_idUsuario($conexion,$idUsuariocalificador){
    $viaja=array();
    if(isset($conexion)){
        try{
            $sql="SELECT * FROM calificacion_pendiente WHERE idUsuariocalificador = :idUsuariocalificador AND activo=1";
            $sentencia = $conexion -> prepare($sql);
            $sentencia -> bindParam( ":idUsuariocalificador" , $idUsuariocalificador, PDO::PARAM_STR);
            $sentencia -> execute();
            $resultado = $sentencia -> fetchAll();
            if(count($resultado)){
                foreach($resultado as $fila){
                    $viaja[]= new CalificacionPendiente($fila['id'],$fila['idUsuariocalificador'],$fila['idusuarioACalificar'],$fila['activo'],$fila['esAConductor']);
                }

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
            $sql="SELECT COUNT(*) AS si FROM calificacion_pendiente WHERE idUsuariocalificador= :idUsuariocalificador AND activo=1";
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
public function crearCalificacionPendienteAConductor($conexion,$idUsuario,$idConductor){
    $conexion_creada=false;
    if(isset($conexion)){
        try{
            $sql="INSERT INTO calificacion_pendiente (idUsuariocalificador,idUsuarioACalificar,activo,esAConductor) VALUES (:idUsuario,:idConductor,1,1)";
            $sentencia =$conexion ->prepare($sql);
            $sentencia ->bindParam(':idUsuario',$idUsuario,PDO::PARAM_STR);
            $sentencia ->bindParam(':idConductor',$idConductor,PDO::PARAM_STR);
            $conexion_creada=$sentencia ->execute();


        }catch(PDOException $ex){
            print 'error'. $ex -> getMessage();
        }
    }return $conexion_creada; 
}
public function crearCalificacionPendienteAPasajero($conexion,$idConductor,$idUsuario){
    $conexion_creada=false;
    if(isset($conexion)){
        try{
            $sql="INSERT INTO calificacion_pendiente (idUsuariocalificador,idUsuarioACalificar,activo,esAConductor) VALUES (:idConductor,:idUsuario,1,0)";
            $sentencia =$conexion ->prepare($sql);
            $sentencia ->bindParam(':idUsuario',$idUsuario,PDO::PARAM_STR);
            $sentencia ->bindParam(':idConductor',$idConductor,PDO::PARAM_STR);
            $conexion_creada=$sentencia ->execute();


        }catch(PDOException $ex){
            print 'error'. $ex -> getMessage();
        }
    }return $conexion_creada; 
}
public static function calificacion_pendiente_id($conexion,$id){
    $resultado=null;
    if(isset($conexion)){
        try{
            $sql="SELECT *  FROM calificacion_pendiente WHERE id= :id ";
            $sentencia=$conexion -> prepare($sql);
            $sentencia -> bindParam(':id',$id,PDO::PARAM_STR);
            $sentencia ->execute();
            $fila=$sentencia ->fetch();
            $resultado=new CalificacionPendiente($fila['id'],$fila['idUsuariocalificador'],$fila['idusuarioACalificar'],$fila['activo'],$fila['esAConductor']);
        }catch(PDOException $ex){
          print 'error: '. $ex ->getMessage();

        }
    }
   return $resultado;
}
public static function calificado($id,$conexion){
    $ok=false;
    if(isset($conexion)){
        try{
            $sql="UPDATE calificacion_pendiente SET activo=0 WHERE id=:id";
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