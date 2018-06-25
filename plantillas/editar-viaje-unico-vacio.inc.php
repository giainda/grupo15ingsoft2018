<div class="form-group">
    <label>Ciudad origen</label>
    <input type="text" class="form-control" name="origen" value="<?php echo $viaje->getInicio() ?>">
</div>
<div class="form-group">
    <label>Ciudad destino</label>
    <input type="text" class="form-control" name="destino" value="<?php echo $viaje->getDestino()?>">
</div>
<div class="form-group">
    <label>Fecha de inicio</label>
    <?php $valores=explode(' ',$viaje->getFechaInicio());
        $fecha=$valores['0']."T".$valores['1'];?>
    <input type="dateTime-local" id="datetim"  name="fecha"class="form-control" value=<?php echo $fecha?>>
</div>
<div class="form-group">
    <label>Duracion estimada (maximo 24 horas)</label>
    <input type="time" class="form-control" name="duracion" value="<?php echo $viaje->getDuracion()?>">
</div>
<div class="form-group">
    <label>Precio total</label>
    <input type="number" class="form-control" name="precio" value="<?php echo $viaje->getPrecio()?>">
</div>
<div class="form-group">
    <label>Descripcion</label>
    <input type="text" style="HEIGHT: 98px" class="form-control" name="descripcion" value="<?php echo $viaje->getDescripcion() ?>">

</div>

<label for="inputState">vehículo</label>
                            <select id="inputState" name=vehiculo class="form-control">
                            <?php $autos=RepositorioTiene::autos_idConductor(Conexion::obtener_conexion(),$conductor-> getIdUsuario()); 
                            if(isset($autos)){
                                foreach($autos as $auto){
                                if($auto ->getPatente()===$viaje->getPatente()){
                                 echo "<option selected>".$auto->getPatente()."</option>"; }
                                 else{
                                 echo "<option>".$auto->getPatente()."</option>";    
                                 }}} ?>
                            </select>
                            <br>


                            

<h4>Todos los campos son obligatorios</h4>

<br>
<button type="submit"class="btn botoncss" name="enviar">Enviar datos</button>
<button type="reset"class="btn botoncss">Limpiar formulario</button>
   