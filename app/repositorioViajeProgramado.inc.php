<?php
include_once "app/viajeProgramado.inc.php";

class RepositorioViajeProgramado{
    public static function insertar_viaje($conexion,$viajeProgramado){
        $viaje_insertado = false;
        if(isset($conexion)){
            try{
                $sql = "INSERT INTO viajesprogramados(fechaInicio, fechaFin, activo)
                 VALUES(:fechaInicio, :fechaFin, 1)";
                $sentencia= $conexion -> prepare($sql);
                $obFechaInicio=$viajeProgramado -> getFechaInicio();
                $obFechaFin=$viajeProgramado -> getFechaFin();
                $sentencia -> bindParam(':fechaInicio',$obFechaInicio,PDO::PARAM_STR);
                $sentencia -> bindParam(':fechaFin',$obFechaFin,PDO::PARAM_STR);
                $viaje_insertado = $sentencia -> execute();
            }catch (PDOException $ex){
                print 'error'. $ex -> getMessage();
            }
        }
        return $conexion->lastInsertId();
     }
     public static function todosViajesProgramados($conexion){
        $viajes=array();
        if(isset($conexion)){
            try{
                $sql="SELECT * FROM viajesprogramados WHERE activo=1";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $viajes[]= new ViajeProgramado($fila['idViajeProgramado'],$fila['fechaInicio'],$fila['fechaFin'],$fila['activo']);
                    }
                }
    
            }catch(PDOException $ex){
                print 'error' . $ex ->getMessage();
            }
    
        }
        return $viajes;
    }
    public static function termina($conexion,$idViajeProgramado){
        $ok=false;
        if(isset($conexion)){
            try{
                $sql="UPDATE viajepertenece SET activo=0 WHERE idViajeProgramado=:idViajeProgramado";
                $sentencia=$conexion ->prepare($sql);
                $sentencia ->bindParam(":idViajeProgramado", $idViajeProgramado, PDO::PARAM_STR);
                $sentencia ->execute();
              $ok=true;
            }catch(PDOException $ex){
                print "erro: ". $ex->getMessage();
            }
        }
        return $ok;
    }
    public static function obtener_por_idViajeProgramado($conexion,$idViajeProgramado){
        $viaje=null;
        if(isset($conexion)){
            try{
                $sql="SELECT * FROM viajesprogramados WHERE idViajeProgramado = :idViajeProgramado";
                $sentencia = $conexion -> prepare($sql);
                $sentencia ->bindParam(':idViajeProgramado',$idViajeProgramado,PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch();
                if(!empty($resultado)){
                    $viaje=new ViajeProgramado($resultado['idViajeProgramado'],$resultado['fechaInicio'],$resultado['fechaFin'],$resultado['activo']);
                }
            }catch(PDOException $ex){
                print 'error'. $ex->getMessage();
            }

        }
        return $viaje;

    }
    public static function actualiza($conexion,$idViajeProgramado,$max,$min){
        $ok=false;
        if(isset($conexion)){
            try{
                $sql="UPDATE viajesprogramados SET fechaInicio=:mini , fechaFin=:maxi WHERE idViajeProgramado=:idViajeProgramado";
                $sentencia=$conexion ->prepare($sql);
                $sentencia ->bindParam(":idViajeProgramado", $idViajeProgramado, PDO::PARAM_STR);
                $sentencia ->bindParam(":mini", $min, PDO::PARAM_STR);
                $sentencia ->bindParam(":maxi", $max, PDO::PARAM_STR);
                $sentencia ->execute();
              $ok=true;
            }catch(PDOException $ex){
                print "erro: ". $ex->getMessage();
            }
        }
        return $ok;
    }
}