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
}