<div class="form-group">
    <label>Ciudad origen</label>
    <input type="text" class="form-control" name="origen" placeholder="Ciudad origen">
</div>
<div class="form-group">
    <label>Ciudad destino</label>
    <input type="text" class="form-control" name="destino" placeholder="Ciudad destino">
</div>

<div class="form-group">
    <label>Duracion estimada (maximo 24 horas)</label>
    <input type="time" class="form-control" name="duracion" placeholder="1">
</div>
<div class="form-group">
    <label>Precio total</label>
    <input type="number" class="form-control" name="precio" placeholder="1000">
</div>
<div class="form-group">
    <label>Descripcion</label>
    <input type="text" style="HEIGHT: 98px" class="form-control" name="descripcion" placeholder="">

</div>

<label for="inputState">vehículo</label>
                            <select id="inputState" name=vehiculo class="form-control">
                            <?php $autos=RepositorioTiene::autos_idConductor(Conexion::obtener_conexion(),$conductor-> getIdUsuario()); 
                            if(isset($autos)){
                            foreach($autos as $auto){
                             echo "<option>".$auto->getPatente()."</option>"; }} ?>
                            </select>
                            <br>
                            <div class="form-group">
    <label>Fecha de inicio</label>
    <input type="dateTime-local" id="datetim"  name="fecha"class="form-control">
</div>
<br>                            


                            

<h4>Todos los campos son obligatorios</h4>

<br>
<button type="submit"class="btn botoncss" name="enviar">Iniciar creación</button>
<button type="reset"class="btn botoncss">Limpiar formulario</button>
   