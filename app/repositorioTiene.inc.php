<?php
include_once 'app/tiene.inc.php';

class RepositorioTiene{
public static function crearRelacion($conexion,$idConductor,$patente){
    $conexion_creada=false;
    if(isset($conexion)){
        try{
            $sql="INSERT INTO tiene (idConductor,patente,activo) VALUES (:idConductor,:patente,1)";
            $sentencia =$conexion ->prepare($sql);
            $sentencia ->bindParam(':idConductor',$idConductor,PDO::PARAM_STR);
            $sentencia ->bindParam(':patente',$patente,PDO::PARAM_STR);
            $conexion_creada=$sentencia ->execute();


        }catch(PDOException $ex){
            print 'error'. $ex -> getMessage();
        }
    }return $conexion_creada;
}    

public static function autos_idConductor($conexion,$idConductor){
    $autos=array();
    if(isset($conexion)){
        try{
            $sql="SELECT * FROM tiene WHERE idConductor = :idConductor";
            $sentencia = $conexion -> prepare($sql);
            $sentencia -> bindParam( ":idConductor" , $idConductor, PDO::PARAM_STR);
            $sentencia -> execute();
            $resultado = $sentencia -> fetchAll();
            if(count($resultado)){
                foreach($resultado as $fila){
                    $autos[]= new Tiene($fila['idConductor'],$fila['patente'],$fila['activo']);
                }

            }else{
                print 'no tiene autos';
            }

        }catch(PDOException $ex){
            print 'error' . $ex ->getMessage();
        }

    }
    return $autos;
}
public static function activo($conexion,$idConductor,$patente){
    $activo=null;
    if(isset($conexion)){
        try{
            $sql="SELECT activo FROM tiene WHERE idConductor = :idConductor AND patente = :patente";
            $sentencia = $conexion -> prepare($sql);
            $sentencia -> bindParam( ":idConductor" , $idConductor, PDO::PARAM_STR);
            $sentencia -> bindParam( ":patente" , $patente, PDO::PARAM_STR);
            $sentencia -> execute();
            $resultado = $sentencia -> fetch();
            
                if($resultado['activo']){
                    $activo=true;
                }else{
                    $activo=false;
                
            }
        }catch(PDOException $ex){
            print "error". $ex ->getMessage();
        }
    }
    return $activo;
}
public static function existeRelacion($conexion,$idConductor,$patente){
    $existe=null;
    if(isset($conexion)){
        try{
            $sql="SELECT COUNT(*)as total FROM tiene WHERE idConductor = :idConductor AND patente = :patente";
            $sentencia = $conexion -> prepare($sql);
            $sentencia -> bindParam( ":idConductor" , $idConductor, PDO::PARAM_STR);
            $sentencia -> bindParam( ":patente" , $patente, PDO::PARAM_STR);
            $sentencia -> execute();
            $resultado = $sentencia -> fetch();
            if($resultado['total']){
                $existe=true;
            }else{
                $existe=false;
            }

}catch(PDOException $ex){
    print "error" . $ex ->getMessage();

}
    }return $existe;

}
public static function eliminar($patente,$idConductor,$conexion){
    $ok=false;
    if(isset($conexion)){
        try{
            $sql="UPDATE tiene SET activo=0 WHERE patente=:patente AND idConductor=:idConductor";
            $sentencia=$conexion ->prepare($sql);
            $sentencia ->bindParam(":patente", $patente, PDO::PARAM_STR);
            $sentencia ->bindParam(":idConductor", $idConductor, PDO::PARAM_STR);
            $sentencia ->execute();
          $ok=true;
        }catch(PDOException $ex){
            print "erro: ". $ex->getMessage();
        }
    }
    return $ok;
} 
public static function autoExisteRelacion($conexion,$patente){
    $existe=null;
    if(isset($conexion)){
        try{
            $sql="SELECT COUNT(*)as total FROM tiene WHERE patente = :patente";
            $sentencia = $conexion -> prepare($sql);
            $sentencia -> bindParam( ":patente" , $patente, PDO::PARAM_STR);
            $sentencia -> execute();
            $resultado = $sentencia -> fetch();
            if($resultado['total']){
                $existe=true;
            }else{
                $existe=false;
            }

}catch(PDOException $ex){
    print "error" . $ex ->getMessage();

}
    }return $existe;

}
}