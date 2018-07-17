<?php
include_once 'app/viaje.inc.php';

class RepositorioViaje{
    public static function obtener_por_idViaje($conexion,$idViaje){
        $viaje=null;
        if(isset($conexion)){
            try{
                $sql="SELECT * FROM viajes WHERE idViaje = :idViaje";
                $sentencia = $conexion -> prepare($sql);
                $sentencia ->bindParam(':idViaje',$idViaje,PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch();
                if(!empty($resultado)){
                    $viaje=new Viaje($resultado['idViaje'],$resultado['idConductor'],$resultado['patente'],$resultado['fechaCreacion'],$resultado['fechaInicio'],$resultado['inicio'],$resultado['destino'],$resultado['asientos'],$resultado['precio'],$resultado['descripcion'],$resultado['tipoViaje'],$resultado['estado'],$resultado['duracion'],$resultado['terminado']);
                }
            }catch(PDOException $ex){
                print 'error'. $ex->getMessage();
            }

        }
        return $viaje;

    }
    public static function esta_activo($conexion,$id){
        $activo=null;
        if(isset($conexion)){
            try{
                $sql="SELECT activo FROM viajes WHERE id = :id";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam( ":id" , $id, PDO::PARAM_STR);
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
    public static function viajes_por_idConductor($conexion,$idConductor){
        $viajes=array();
        if(isset($conexion)){
            try{
                $sql="SELECT * FROM viajes WHERE idConductor = :idConductor AND estado=1 ORDER BY fechaInicio";
                $sentencia = $conexion -> prepare($sql); 
                $sentencia -> bindParam( ":idConductor" , $idConductor, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $viajes[]= new Viaje($fila['idViaje'],$fila['idConductor'],$fila['patente'],$fila['fechaCreacion'],$fila['fechaInicio'],$fila['inicio'],$fila['destino'],$fila['asientos'],$fila['precio'],$fila['descripcion'],$fila['tipoViaje'],$fila['estado'],$fila['duracion'],$fila['terminado']);
                    }
    
                }else{
                    print '       No hay viajes creados';
                }
    
            }catch(PDOException $ex){
                print 'error' . $ex ->getMessage();
            }
    
        }
        return $viajes;
    } 
    public static function viajes_por_idConductor2($conexion,$idConductor){
        $viajes=array();
        if(isset($conexion)){
            try{
                $sql="SELECT * FROM viajes WHERE idConductor = :idConductor AND estado=1";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam( ":idConductor" , $idConductor, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $viajes[]= new Viaje($fila['idViaje'],$fila['idConductor'],$fila['patente'],$fila['fechaCreacion'],$fila['fechaInicio'],$fila['inicio'],$fila['destino'],$fila['asientos'],$fila['precio'],$fila['descripcion'],$fila['tipoViaje'],$fila['estado'],$fila['duracion'],$fila['terminado']);
                    }
    
                }
    
            }catch(PDOException $ex){
                print 'error' . $ex ->getMessage();
            }
    
        }
        return $viajes;
    } 
    public static function tieneViaje($conexion,$idConductor){
        $es=null;
        if(isset($conexion)){
            try{
                $sql="SELECT COUNT(*) AS si FROM viajes WHERE idConductor= :idConductor";
                $sentencia=$conexion -> prepare($sql);
                $sentencia -> bindParam(':idConductor',$idConductor,PDO::PARAM_STR);
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
    public static function autoTieneViaje($conexion,$patente){
        $es=null;
        if(isset($conexion)){
            try{
                $sql="SELECT COUNT(*) AS si FROM viajes WHERE patente= :patente  AND estado=1";
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
    public static function autoTieneViajeId($conexion,$idConductor,$patente){
        $es=null;
        if(isset($conexion)){
            try{
                $sql="SELECT COUNT(*) AS si FROM viajes WHERE idConductor= :idConductor AND patente= :patente AND estado=1";
                $sentencia=$conexion -> prepare($sql);
                $sentencia -> bindParam(':patente',$patente,PDO::PARAM_STR);
                $sentencia -> bindParam(':idConductor',$idConductor,PDO::PARAM_STR);
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
    public static function insertar_viaje($conexion,$viaje){
        $viaje_insertado = false;
        if(isset($conexion)){
            try{
                $sql = "INSERT INTO viajes(idConductor, patente, fechaCreacion, fechaInicio, inicio, destino, asientos,
                precio, descripcion, tipoViaje, estado, duracion, terminado)
                 VALUES(:idConductor, :patente, NOW(), :fechaInicio, :inicio, :destino,:asientos,:precio,:descripcion,:tipoViaje,1,:duracion,0)";
                $sentencia= $conexion -> prepare($sql);
                $obidConductor= $viaje ->getIdConductor();
                $obpatente= $viaje ->getPatente();
                $obFechaInicio= $viaje ->getFechaInicio();
                $obInicio= $viaje ->getInicio();
                $obDestino= $viaje ->getDestino();
                $obAsientos= $viaje ->getAsientos();
                $obPrecio= $viaje ->getPrecio();
                $obDescripcion= $viaje ->getDescripcion();
                $obTipoViaje= $viaje ->getTipoViaje();
                $obDuracion= $viaje -> getDuracion();
                $sentencia -> bindParam(':idConductor',$obidConductor,PDO::PARAM_STR);
                $sentencia -> bindParam(':patente',$obpatente,PDO::PARAM_STR);
                $sentencia -> bindParam(':fechaInicio',$obFechaInicio,PDO::PARAM_STR);
                $sentencia -> bindParam(':inicio',$obInicio,PDO::PARAM_STR);
                $sentencia -> bindParam(':destino',$obDestino,PDO::PARAM_STR);
                $sentencia -> bindParam(':asientos',$obAsientos,PDO::PARAM_STR);
                $sentencia -> bindParam(':precio',$obPrecio,PDO::PARAM_STR);
                $sentencia -> bindParam(':descripcion',$obDescripcion,PDO::PARAM_STR);
                $sentencia -> bindParam(':tipoViaje',$obTipoViaje,PDO::PARAM_STR);
                $sentencia -> bindParam(':duracion',$obDuracion,PDO::PARAM_STR);
                $viaje_insertado = $sentencia -> execute();
            }catch (PDOException $ex){
                print 'error'. $ex -> getMessage();
            }
        }
        return $viaje_insertado;
     }
     public static function viajes_por_patente($conexion,$patente){
        $viajes=array();
        if(isset($conexion)){
            try{
                $sql="SELECT * FROM viajes WHERE patente = :patente AND estado=1";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam( ":patente" , $patente, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $viajes[]= new Viaje($fila['idViaje'],$fila['idConductor'],$fila['patente'],$fila['fechaCreacion'],$fila['fechaInicio'],$fila['inicio'],$fila['destino'],$fila['asientos'],$fila['precio'],$fila['descripcion'],$fila['tipoViaje'],$fila['estado'],$fila['duracion'],$fila['terminado']);
                    }
    
                }else{
                    print '       No hay viajes creados';
                }
    
            }catch(PDOException $ex){
                print 'error' . $ex ->getMessage();
            }
    
        }
        return $viajes;
    }
     
    public static function insertar_viaje2($conexion,$viaje){
        $viaje_insertado = false;
        if(isset($conexion)){
            try{
                $sql = "INSERT INTO viajes(idConductor, patente, fechaCreacion, fechaInicio, inicio, destino, asientos,
                precio, descripcion, tipoViaje, estado, duracion, terminado)
                 VALUES(:idConductor, :patente, NOW(), :fechaInicio, :inicio, :destino,:asientos,:precio,:descripcion,:tipoViaje,1,:duracion,0)";
                $sentencia= $conexion -> prepare($sql);
                $obidConductor= $viaje ->getIdConductor();
                $obpatente= $viaje ->getPatente();
                $obFechaInicio= $viaje ->getFechaInicio();
                $obInicio= $viaje ->getInicio();
                $obDestino= $viaje ->getDestino();
                $obAsientos= $viaje ->getAsientos();
                $obPrecio= $viaje ->getPrecio();
                $obDescripcion= $viaje ->getDescripcion();
                $obTipoViaje= $viaje ->getTipoViaje();
                $obDuracion= $viaje -> getDuracion();
                $sentencia -> bindParam(':idConductor',$obidConductor,PDO::PARAM_STR);
                $sentencia -> bindParam(':patente',$obpatente,PDO::PARAM_STR);
                $sentencia -> bindParam(':fechaInicio',$obFechaInicio,PDO::PARAM_STR);
                $sentencia -> bindParam(':inicio',$obInicio,PDO::PARAM_STR);
                $sentencia -> bindParam(':destino',$obDestino,PDO::PARAM_STR);
                $sentencia -> bindParam(':asientos',$obAsientos,PDO::PARAM_STR);
                $sentencia -> bindParam(':precio',$obPrecio,PDO::PARAM_STR);
                $sentencia -> bindParam(':descripcion',$obDescripcion,PDO::PARAM_STR);
                $sentencia -> bindParam(':tipoViaje',$obTipoViaje,PDO::PARAM_STR);
                $sentencia -> bindParam(':duracion',$obDuracion,PDO::PARAM_STR);
                $viaje_insertado = $sentencia -> execute();
            }catch (PDOException $ex){
                print 'error'. $ex -> getMessage();
            }
        }
        return $conexion->lastInsertId();
     }
     public static function viajesCreadosResientes($conexion){
        $viajes=array();
        if(isset($conexion)){
            try{
                $sql="SELECT * FROM viajes WHERE estado=1 ORDER BY fechaCreacion DESC LIMIT 20";
                $sentencia = $conexion -> prepare($sql); 
                $sentencia -> bindParam( ":idConductor" , $idConductor, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $viajes[]= new Viaje($fila['idViaje'],$fila['idConductor'],$fila['patente'],$fila['fechaCreacion'],$fila['fechaInicio'],$fila['inicio'],$fila['destino'],$fila['asientos'],$fila['precio'],$fila['descripcion'],$fila['tipoViaje'],$fila['estado'],$fila['duracion'],$fila['terminado']);
                    }
    
                }else{
                    print '       No hay viajes creados';
                }
    
            }catch(PDOException $ex){
                print 'error' . $ex ->getMessage();
            }
    
        }
        return $viajes;
    }




    public static function tieneViajeFechaDuracion($conexion,$idConductor,$fechaInicio,$duracion){
        $viajes=array();
        if(isset($conexion)){
            try{
                $sql="SELECT * FROM viajes WHERE idConductor = :idConductor AND estado=1";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam( ":idConductor" , $idConductor, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $viajes[]= new Viaje($fila['idViaje'],$fila['idConductor'],$fila['patente'],$fila['fechaCreacion'],$fila['fechaInicio'],$fila['inicio'],$fila['destino'],$fila['asientos'],$fila['precio'],$fila['descripcion'],$fila['tipoViaje'],$fila['estado'],$fila['duracion'],$fila['terminado']);
                    }   
                }   
            }catch(PDOException $ex){
                print 'error' . $ex ->getMessage();
            }   
        }
        if(isset($viajes)){
            foreach ($viajes as $viaje){
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
                        return "usted ya tiene un viaje creado en esa fecha y horario"; 
                     }
                 }else{
                    if($fecha <= $fecha2){
                     if($sumTime2 >= $fecha2){
                        return "usted ya tiene un viaje creado en esa fecha y horario";
                     }
    
                 }
                 }
            }
        }
        return '';
    }
    public static function todosLosViajes($conexion){
        $viajes=array();
        if(isset($conexion)){
            try{
                $sql="SELECT * FROM viajes WHERE  estado=1";
                $sentencia = $conexion -> prepare($sql); 
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $viajes[]= new Viaje($fila['idViaje'],$fila['idConductor'],$fila['patente'],$fila['fechaCreacion'],$fila['fechaInicio'],$fila['inicio'],$fila['destino'],$fila['asientos'],$fila['precio'],$fila['descripcion'],$fila['tipoViaje'],$fila['estado'],$fila['duracion'],$fila['terminado']);
                    }
    
                }
    
            }catch(PDOException $ex){
                print 'error' . $ex ->getMessage();
            }
    
        }
        return $viajes;
    }
    public static function todosLosViajesSinTerminar($conexion){
        $viajes=array();
        if(isset($conexion)){
            try{
                $sql="SELECT * FROM viajes WHERE  estado=2 AND terminado=0";
                $sentencia = $conexion -> prepare($sql); 
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $viajes[]= new Viaje($fila['idViaje'],$fila['idConductor'],$fila['patente'],$fila['fechaCreacion'],$fila['fechaInicio'],$fila['inicio'],$fila['destino'],$fila['asientos'],$fila['precio'],$fila['descripcion'],$fila['tipoViaje'],$fila['estado'],$fila['duracion'],$fila['terminado']);
                    }
    
                }
    
            }catch(PDOException $ex){
                print 'error' . $ex ->getMessage();
            }
    
        }
        return $viajes;
    }
    public static function comienza($conexion,$idViaje){
        $ok=false;
        if(isset($conexion)){
            try{
                $sql="UPDATE viajes SET estado=2 WHERE idViaje=:idViaje";
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
    public static function termina($conexion,$idViaje){
        $ok=false;
        if(isset($conexion)){
            try{
                $sql="UPDATE viajes SET terminado=1 WHERE idViaje=:idViaje";
                $sentencia=$conexion ->prepare($sql);
                $sentencia ->bindParam(":idViaje", $idViaje, PDO::PARAM_STR);
                $ok=$sentencia ->execute();

              
            }catch(PDOException $ex){
                print "erro: ". $ex->getMessage();
            }
        }
        return $ok;
    }
    public static function editarViaje($conexion,$viaje){
        $viaje_insertado = false;
        if(isset($conexion)){
            try{
                $sql = "UPDATE viajes SET  patente=:patente, fechaInicio=:fechaInicio, inicio=:inicio, destino=:destino, asientos=:asientos,
                precio=:precio, descripcion=:descripcion, duracion=:duracion WHERE idViaje=:id";
                
                $sentencia= $conexion -> prepare($sql);
                $obpatente= $viaje ->getPatente();
                $obFechaInicio= $viaje ->getFechaInicio();
                $obInicio= $viaje ->getInicio();
                $obDestino= $viaje ->getDestino();
                $obAsientos= $viaje ->getAsientos();
                $obPrecio= $viaje ->getPrecio();
                $obDescripcion= $viaje ->getDescripcion();
                $obDuracion= $viaje -> getDuracion();
                $obId=$viaje->getId();
                $sentencia -> bindParam(':id',$obId,PDO::PARAM_STR);
                $sentencia -> bindParam(':patente',$obpatente,PDO::PARAM_STR);
                $sentencia -> bindParam(':fechaInicio',$obFechaInicio,PDO::PARAM_STR);
                $sentencia -> bindParam(':inicio',$obInicio,PDO::PARAM_STR);
                $sentencia -> bindParam(':destino',$obDestino,PDO::PARAM_STR);
                $sentencia -> bindParam(':asientos',$obAsientos,PDO::PARAM_STR);
                $sentencia -> bindParam(':precio',$obPrecio,PDO::PARAM_STR);
                $sentencia -> bindParam(':descripcion',$obDescripcion,PDO::PARAM_STR);
                $sentencia -> bindParam(':duracion',$obDuracion,PDO::PARAM_STR);
                $viaje_insertado = $sentencia -> execute();
            }catch (PDOException $ex){
                print 'error'. $ex -> getMessage();
            }
        }
        return $viaje_insertado;
     }

     public static function borrar($conexion,$idViaje){
        $ok=false;
        if(isset($conexion)){
            try{
                $sql="DELETE FROM viajes WHERE idViaje=:idViaje";
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
    public static function buscarCualquierVehiculo($conexion,$origen,$destino){
        $viajes=array();
        if(isset($conexion)){
            try{
                $sql="SELECT * from viajes where inicio=:origen and destino=:destino and estado=1";
                $sentencia=$conexion ->prepare($sql);
                $sentencia ->bindParam(":origen", $origen, PDO::PARAM_STR);
                $sentencia ->bindParam(":destino", $destino, PDO::PARAM_STR);
                $sentencia ->execute();
                $resultado = $sentencia -> fetchAll();
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $viajes[]= new Viaje($fila['idViaje'],$fila['idConductor'],$fila['patente'],$fila['fechaCreacion'],$fila['fechaInicio'],$fila['inicio'],$fila['destino'],$fila['asientos'],$fila['precio'],$fila['descripcion'],$fila['tipoViaje'],$fila['estado'],$fila['duracion'],$fila['terminado']);
                    }
    
                }
    
            }catch(PDOException $ex){
                print 'error' . $ex ->getMessage();
            }
            
        }return $viajes;
    }
    public static function buscarConVehiculo($conexion,$origen,$destino,$vehiculo){
        $viajes=array();
        if(isset($conexion)){
            try{
                $sql="SELECT * from viajes v inner join auto ve on(v.patente=ve.patente)
                where v.inicio=:origen and v.destino=:destino and estado=1 and ve.tipo=:vehiculo";
                $sentencia= $conexion ->prepare($sql);
                $sentencia ->bindParam(":origen",$origen, PDO::PARAM_STR);
                $sentencia ->bindParam(":destino",$destino, PDO::PARAM_STR);
                $sentencia ->bindParam(":vehiculo",$vehiculo, PDO::PARAM_STR);
                $sentencia ->execute();
                $resultado = $sentencia -> fetchAll();
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $viajes[]= new Viaje($fila['idViaje'],$fila['idConductor'],$fila['patente'],$fila['fechaCreacion'],$fila['fechaInicio'],$fila['inicio'],$fila['destino'],$fila['asientos'],$fila['precio'],$fila['descripcion'],$fila['tipoViaje'],$fila['estado'],$fila['duracion'],$fila['terminado']);
                    }
    
                }
    
            }catch(PDOException $ex){
                print 'error' . $ex ->getMessage();
            }
            
        }return $viajes;
    }
       
}