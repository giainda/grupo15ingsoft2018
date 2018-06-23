<?php
include_once "app/calificacion.php";

class RepositorioCalificacion{
   
    

    public function crear_calificacion($conexion,$idUsuario,$texto){
        $conexion_creada=false;
        if(isset($conexion)){
            try{
                $sql="INSERT INTO calificaciones ( idUsuario, texto) VALUES ( :idUsuario, :texto)";
                $sentencia =$conexion ->prepare($sql);
                $sentencia ->bindParam(':idUsuario',$idUsuario,PDO::PARAM_STR);
                $sentencia ->bindParam(':texto',$texto,PDO::PARAM_STR);
                $conexion_creada=$sentencia ->execute();
    
    
            }catch(PDOException $ex){
                print 'error'. $ex -> getMessage()." aca asdasd";
            }
        }return $conexion_creada; 
    }
    public static function calificacion_idUsuario($conexion,$idUsuario){
        $viaja=array();
        if(isset($conexion)){
            try{
                $sql="SELECT * FROM calificaciones WHERE idUsuario = :idUsuario ORDER BY id DESC";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam( ":idUsuario" , $idUsuario, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $viaja[]= new Calificacion($fila['id'],$fila['idUsuario'],$fila['texto']);
                    }
    
                }
    
            }catch(PDOException $ex){
                print 'error' . $ex ->getMessage();
            }
    
        }
        return $viaja;
    }
}