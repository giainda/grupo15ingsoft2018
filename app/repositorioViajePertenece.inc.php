<?php
include_once 'app/viajePertenece.inc.php';

class RepositorioViajePertenece{
    public function crearRelacion($conexion,$idViajeProgramado,$idViaje){
        $conexion_creada=false;
        if(isset($conexion)){
            try{
                $sql="INSERT INTO viajepertenece (idViajeProgramado,idViaje,activo) VALUES (:idViajeProgramado,:idViaje,1)";
                $sentencia =$conexion ->prepare($sql);
                $sentencia ->bindParam(':idViajeProgramado',$idViajeProgramado,PDO::PARAM_STR);
                $sentencia ->bindParam(':idViaje',$idViaje,PDO::PARAM_STR);
                $conexion_creada=$sentencia ->execute();
    
    
            }catch(PDOException $ex){
                print 'error'. $ex -> getMessage();
            }
        }return $conexion_creada; 
    }
    public static function viajesIdProgramado($conexion,$idViajeProgramado){
        $relaciones=array();
        if(isset($conexion)){
            try{
                $sql="SELECT * FROM viajepertenece c INNER JOIN viajes v ON (c.idViaje=v.idViaje) WHERE idViajeProgramado = :idViajeProgramado ORDER BY v.fechaInicio";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam( ":idViajeProgramado" , $idViajeProgramado, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $relaciones[]= new viajePertenece($fila['idViajeProgramado'],$fila['idViaje'],$fila['activo']);
                    }
                }
            }catch(PDOException $ex){
                print 'error' . $ex ->getMessage();
            }
    
        }
        return $relaciones;
    }
    public static function viajeIdViaje($conexion,$idViaje){
        $relacion='';
        if(isset($conexion)){
            try{
                $sql="SELECT * FROM viajepertenece WHERE idViaje = :idViaje";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam( ":idViaje" , $idViaje, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch();
                if(!empty($resultado)){
                        $relacion= new viajePertenece($resultado['idViajeProgramado'],$resultado['idViaje'],$resultado['activo']);

                }
            }catch(PDOException $ex){
                print 'error' . $ex ->getMessage();
            }
    
        }
        return $relacion;
    }
    public static function termina($conexion,$idViaje){
        $ok=false;
        if(isset($conexion)){
            try{
                $sql="UPDATE viajepertenece SET activo=0 WHERE idViaje=:idViaje";
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
