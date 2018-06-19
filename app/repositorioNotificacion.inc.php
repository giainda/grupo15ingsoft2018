<?php
include_once "notificacion.inc.php";


class RepositorioNotificacion{
    public function crearNotificacion($conexion,$idUsuario,$texto){
        $notificacionCreada=false;
        if(isset($conexion)){
            try{
                $sql="INSERT INTO notificacion (idUsuario,texto,leido,fechaNoti) VALUES (:idUsuario,:texto,0,NOW())";
                $sentencia =$conexion ->prepare($sql);
                $sentencia ->bindParam(':idUsuario',$idUsuario,PDO::PARAM_STR);
                $sentencia ->bindParam(':texto',$texto,PDO::PARAM_STR);
                $notificacionCreada=$sentencia ->execute();
    
    
            }catch(PDOException $ex){
                print 'error'. $ex -> getMessage();
            }
        }return $notificacionCreada; 
    }
    public static function notificacionesUsuarioLeidas($conexion,$idUsuario){
        $notificaciones=array();
        if(isset($conexion)){
            try{
                $sql="SELECT * FROM notificacion WHERE idUsuario = :idUsuario AND leido=1 ORDER BY fechaNoti DESC ";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam( ":idUsuario" , $idUsuario, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $notificaciones[]= new Notificacion($fila['idUsuario'],$fila['texto'],$fila['leido'],$fila['fechaNoti']);
                    }}
    
            }catch(PDOException $ex){
                print 'error' . $ex ->getMessage();
            }
    
        }
        return $notificaciones;
    }
    public static function notificacionesUsuarioNoLeidas($conexion,$idUsuario){
        $notificaciones=array();
        if(isset($conexion)){
            try{
                $sql="SELECT * FROM notificacion WHERE idUsuario = :idUsuario AND leido=0 ORDER BY fechaNoti";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam( ":idUsuario" , $idUsuario, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $notificaciones[]= new Notificacion($fila['idUsuario'],$fila['texto'],$fila['leido'],$fila['fechaNoti']);
                    }}
    
            }catch(PDOException $ex){
                print 'error' . $ex ->getMessage();
            }
    
        }
        return $notificaciones;
    }
    public static function leida($idUsuario,$conexion){
        $actualizacion_correcta=false;
        if(isset($conexion)){
            try{
                $sql="UPDATE notificacion SET leido=1 WHERE idUsuario=:idUsuario and leido=0";
                $sentencia=$conexion ->prepare($sql);
                $sentencia -> bindParam( ":idUsuario" , $idUsuario, PDO::PARAM_STR);
                $sentencia ->execute();
            
                    $actualizacion_correcta=true;
    
                   
    
            }catch(PDOException $ex){
                print "error: ".$ex->getMessage();
    
            }
        }
        return $actualizacion_correcta;
    }
}