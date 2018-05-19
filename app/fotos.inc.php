<?php



class RepositorioFoto{
    public function __construct(){}

    public function esta($conexion,$idUsuario){
        $es=null;
        if(isset($conexion)){
            try{
                $sql="SELECT COUNT(*) AS si FROM fotos WHERE idUsuario= :idUsuario";
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

    public function agregar($id,$foto,$conexion){
        if(isset($conexion)){
            try{
            if (  $this->esta($conexion,$id)){
                $sql="UPDATE fotos SET foto= :foto WHERE idUsuario=:idUsuario";
            }else {
                $sql="INSERT INTO fotos(idUsuario,foto)VALUES(:idUsuario,:foto)";
            }
                $sentencia=$conexion ->prepare($sql);
                $sentencia -> bindParam(':idUsuario',$id,PDO::PARAM_STR);
                $sentencia -> bindParam(':foto',$foto,PDO::PARAM_STR);
                $sentencia ->execute();           
        }catch(PDOException $ex){
            print "error: ". $ex->getMessage();
        }

    }
}
  public function recuperarFoto($id,$conexion){
      if(isset($conexion)){
          try{
              $sql="SELECT foto FROM fotos WHERE idUsuario=:idUsuario";
              $sentencia=$conexion ->prepare($sql);
              $sentencia ->bindParam(':idUsuario',$id,PDO::PARAM_STR);
              $sentencia ->execute();
              $resultado = $sentencia -> fetch();
              $imagen=$resultado['foto'];
          }catch(PDOException $ex){
              print "error: ".$ex ->getMessage();          }
      }return $imagen;
  }
}


    
