<?php
include_once 'app/conductor.inc.php';

class RepositorioConductor{
    public static function insertar_conductor($conexion,$idUsuario){
        $usuario_insertado = false;
        if(isset($conexion)){
            try{
                $sql = "INSERT INTO conductor(idUsuario, calificacionPos, calificacionNeg)
                 VALUES(:idUsuario, 0, 0)";
                $sentencia= $conexion -> prepare($sql);
                $sentencia -> bindParam(':idUsuario',$idUsuario,PDO::PARAM_STR);
                $usuario_insertado = $sentencia -> execute();
            }catch (PDOException $ex){
                print 'error'. $ex -> getMessage();
            }
        }
        return $usuario_insertado;
     }
     public static function obtener_conductor_por_id($conexion,$idUsuario){
        $conductor=null;
        if(isset($conexion)){
            try{
                
                $sql="SELECT * FROM conductor WHERE idUsuario = :idUsuario";
                $sentencia =$conexion -> prepare($sql);
                $sentencia -> bindParam( ":idUsuario" , $idUsuario, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado=$sentencia -> fetch();
                if(!empty($resultado)){
                    $conductor =new Conductor($resultado['idUsuario'],$resultado['calificacionPos'],$resultado['calificacionNeg']);
                }
            }catch(PDOException $ex){
                print "error". $ex ->getMessage();
            }
        }
        return $conductor;
        
    }


  public static function esConductor($conexion,$idUsuario){
      $es=null;
      if(isset($conexion)){
          try{
              $sql="SELECT COUNT(*) AS si FROM conductor WHERE idUsuario= :idUsuario";
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
}