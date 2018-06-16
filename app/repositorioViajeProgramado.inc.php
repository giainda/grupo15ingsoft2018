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
}