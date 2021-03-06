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
                    $viaja[]= new Viaja($fila['idUsuario'],$fila['idViaje'],$fila['eliminado']);
                }

            }else{
                print '     No hay viajes pendientes';
            }

        }catch(PDOException $ex){
            print 'error' . $ex ->getMessage();
        }

    }
    return $viaja;
}
public static function viajes_viaja_idUsuario2($conexion,$idUsuario){
    $viaja=array();
    if(isset($conexion)){
        try{
            $sql="SELECT * FROM viaja WHERE idUsuario = :idUsuario and eliminado=1";
            $sentencia = $conexion -> prepare($sql);
            $sentencia -> bindParam( ":idUsuario" , $idUsuario, PDO::PARAM_STR);
            $sentencia -> execute();
            $resultado = $sentencia -> fetchAll();
            if(count($resultado)){
                foreach($resultado as $fila){
                    $viaja[]= new Viaja($fila['idUsuario'],$fila['idViaje'],$fila['eliminado']);
                }}

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






public static function viajesViajaFechaDuracion($conexion,$idUsuario,$fechaInicio,$duracion){
    $viajesViaja=array();
    if(isset($conexion)){
        try{
            $sql="SELECT * FROM viaja WHERE idUsuario = :idUsuario and eliminado=1";
            $sentencia = $conexion -> prepare($sql);
            $sentencia -> bindParam( ":idUsuario" , $idUsuario, PDO::PARAM_STR);
            $sentencia -> execute();
            $resultado = $sentencia -> fetchAll();
            if(count($resultado)){
                foreach($resultado as $fila){
                    $viajesViaja[]= new Viaja($fila['idUsuario'],$fila['idViaje'],$fila['eliminado']);
                }}

        }catch(PDOException $ex){
            print 'error' . $ex ->getMessage();
        }

    }
    if(isset($viajesViaja)){
        include_once "app/repositorioViaje.inc.php";
        foreach($viajesViaja as $viaja ){
            $viaje=RepositorioViaje::obtener_por_idViaje(Conexion::obtener_conexion(),$viaja->getIdViaje());
            $du=$viaje->getDuracion();
                $arr= getDate((new DateTime($duracion))->getTimeStamp());      
                $err= getDate((new DateTime($du))->getTimeStamp());
                $sumTime =date('Y-m-d H:i:s',strtotime('+'.$err['hours'].' hour',strtotime($viaje->getFechaInicio())));
                $sumTime =new DateTime (date('Y-m-d H:i:s',strtotime('+'.$err['minutes'].' minutes',strtotime($sumTime))));
                $sumTime2 =(date('Y-m-d H:i:s',strtotime('+'.$arr['hours'].' hour',strtotime($fechaInicio))));
                $sumTime2 = new DateTime(date('Y-m-d H:i:s',strtotime('+'.$arr['minutes'].' minutes',strtotime($sumTime2))));
            $fecha= new DateTime(date('Y-m-d H:i:s',strtotime($fechaInicio)));
            $fecha2=new DateTime($viaje-> getFechaInicio()); 
             if($fecha >= $fecha2){
                 if($sumTime >= $fecha){
                    return "usted fue aceptado en otro viaje a este horario"; 
                 }
             }else{
                if($fecha <= $fecha2){
                 if($sumTime2 >= $fecha2){
                    return "usted fue aceptado en otro viaje a este horario";
                 }
  
             }
             }
  
        }
    }
    return "";
    
}
public function crearRelacion($conexion,$idUsuario,$idViaje){
    $conexion_creada=false;
    if(isset($conexion)){
        try{
            $sql="INSERT INTO viaja (idUsuario,idViaje,eliminado) VALUES (:idUsuario,:idViaje,1)";
            $sentencia =$conexion ->prepare($sql);
            $sentencia ->bindParam(':idUsuario',$idUsuario,PDO::PARAM_STR);
            $sentencia ->bindParam(':idViaje',$idViaje,PDO::PARAM_STR);
            $conexion_creada=$sentencia ->execute();


        }catch(PDOException $ex){
            print 'error'. $ex -> getMessage();
        }
    }return $conexion_creada; 
}
public static function viaja_idViaje($conexion,$idViaje){
    $viaja=array();
    if(isset($conexion)){
        try{
            $sql="SELECT * FROM viaja WHERE idViaje = :idViaje and eliminado=1";
            $sentencia = $conexion -> prepare($sql);
            $sentencia -> bindParam( ":idViaje" , $idViaje, PDO::PARAM_STR);
            $sentencia -> execute();
            $resultado = $sentencia -> fetchAll();
            if(count($resultado)){
                foreach($resultado as $fila){
                    $viaja[]= new Viaja($fila['idUsuario'],$fila['idViaje'],$fila['eliminado']);
                }}

        }catch(PDOException $ex){
            print 'error' . $ex ->getMessage();
        }

    }
    return $viaja;
}
public static function actualizarInfo($idUsuario,$idViaje,$conexion){
    $actualizacion_correcta=false;
    if(isset($conexion)){
        try{
            $sql="UPDATE viaja SET eliminado=0 WHERE idUsuario=:idUsuario and idViaje=:idViaje";
            $sentencia=$conexion ->prepare($sql);
            $sentencia -> bindParam( ":idUsuario" , $idUsuario, PDO::PARAM_STR);
            $sentencia -> bindParam( ":idViaje" , $idViaje, PDO::PARAM_STR);
            $sentencia ->execute();
        
                $actualizacion_correcta=true;

               

        }catch(PDOException $ex){
            print "error: ".$ex->getMessage();

        }
    }
    return $actualizacion_correcta;
}
public static function borrar($conexion,$idViaje){
    $ok=false;
    if(isset($conexion)){
        try{
            $sql="DELETE FROM viaja WHERE idViaje=:idViaje";
            $sentencia=$conexion ->prepare($sql);
            $sentencia ->bindParam(":idViaje", $idViaje, PDO::PARAM_STR);
            $sentencia ->execute();
          $ok=true;

        }catch(PDOException $ex){
            print "erro: ". $ex->getMessage();
        }
    }
    return $ok;
}


}