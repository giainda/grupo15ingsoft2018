<?php

include_once "mensaje.inc.php";

class RepositorioMensaje{
    public static function mensajes_viaje($conexion,$idViaje){
        $mensajes=array();
        if(isset($conexion)){
            try{
                $sql="SELECT * FROM mensajes WHERE idViaje = :idViaje ORDER BY fecha DESC";
                $sentencia = $conexion -> prepare($sql); 
                $sentencia -> bindParam( ":idViaje" , $idViaje, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $mensajes[]= new Mensaje($fila['id'],$fila['idUsuario'],$fila['idViaje'],$fila['fecha'],$fila['texto'],$fila['respuesta']);
                    }
    
                }
    
            }catch(PDOException $ex){
                print 'error' . $ex ->getMessage();
            }
    
        }
        return $mensajes;
    }
    public function crear_mensaje($conexion,$mensaje){
        $ok=false;
        if(isset($conexion)){
            try{
                $sql="INSERT INTO mensajes (idUsuario,idViaje,fecha,texto,respuesta) VALUES (:idUsuario,:idViaje,NOW(),:texto,'')";
                $sentencia =$conexion ->prepare($sql);
                $idU=$mensaje->getIdUsuario();
                $idV=$mensaje->getIdViaje();
                $tex=$mensaje->getTexto();
                $sentencia ->bindParam(':idUsuario',$idU,PDO::PARAM_STR);
                $sentencia ->bindParam(':idViaje',$idV,PDO::PARAM_STR);
                $sentencia ->bindParam(':texto',$tex,PDO::PARAM_STR);
                $ok=$sentencia ->execute();
    
    
            }catch(PDOException $ex){
                print 'error'. $ex -> getMessage();
            }
        }return $ok; 
    }
    public static function respuesta($idMensaje,$conexion,$respuesta){
        $ok=false;
        if(isset($conexion)){
            try{
                $sql="UPDATE mensajes SET respuesta=:respuesta WHERE id=:id";
                $sentencia=$conexion ->prepare($sql);
                $sentencia ->bindParam(":id", $idMensaje, PDO::PARAM_STR);
                $sentencia ->bindParam(":respuesta",$respuesta, PDO::PARAM_STR);
                $sentencia ->execute();
              $ok=true;
            }catch(PDOException $ex){
                print "erro: ". $ex->getMessage();
            }
        }
        return $ok;
    }
    public static function mensajes_id($conexion,$id){
        $mensajes='';
        if(isset($conexion)){
            try{
                $sql="SELECT * FROM mensajes WHERE id = :id";
                $sentencia = $conexion -> prepare($sql); 
                $sentencia -> bindParam( ":id" , $id, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch();
                        $mensajes= new Mensaje($resultado['id'],$resultado['idUsuario'],$resultado['idViaje'],$resultado['fecha'],$resultado['texto'],$resultado['respuesta']);
    
            }catch(PDOException $ex){
                print 'error' . $ex ->getMessage();
            }
    
        }
        return $mensajes;
    } 
}