<?php



class RepositorioFotoAuto{
    public function __construct(){}

    public function esta($conexion,$patente){
        $es=null;
        if(isset($conexion)){
            try{
                $sql="SELECT COUNT(*) AS si FROM fotoauto WHERE patente= :patente";
                $sentencia=$conexion -> prepare($sql);
                $sentencia -> bindParam(':patente',$patente,PDO::PARAM_STR);
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

    public function agregar($patente,$foto,$conexion){
        if(isset($conexion)){
            try{
            if (  $this->esta($conexion,$patente)){
                $sql="UPDATE fotoauto SET foto= :foto WHERE patente=:patente";
            }else {
                $sql="INSERT INTO fotoauto(patente,foto)VALUES(:patente,:foto)";
            }
                $sentencia=$conexion ->prepare($sql);
                $sentencia -> bindParam(':patente',$patente,PDO::PARAM_STR);
                $sentencia -> bindParam(':foto',$foto,PDO::PARAM_STR);
                $sentencia ->execute();           
        }catch(PDOException $ex){
            print "error: ". $ex->getMessage();
        }

    }
}
  public function recuperarFoto($patente,$conexion){
      if(isset($conexion)){
          try{
              $sql="SELECT foto FROM fotoauto WHERE patente=:patente";
              $sentencia=$conexion ->prepare($sql);
              $sentencia ->bindParam(':patente',$patente,PDO::PARAM_STR);
              $sentencia ->execute();
              $resultado = $sentencia -> fetch();
              $imagen=$resultado['foto'];
          }catch(PDOException $ex){
              print "error: ".$ex ->getMessage();          }
      }return $imagen;
  }
}


    
