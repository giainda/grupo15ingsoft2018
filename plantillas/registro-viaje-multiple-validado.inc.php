<div class="form-group">
    <label>Ciudad origen</label>
    <input type="text" class="form-control" name="origen" placeholder="Ciudad origen"<?php $validador -> mostrar_ciudad_origen()?>>

<?php
      $validador -> mostrar_error_ciudad_origen(); 
    ?>
    </div>
<div class="form-group">
    <label>Ciudad destino</label>
    <input type="text" class="form-control" name="destino" placeholder="Ciudad destino"<?php $validador -> mostrar_ciudad_destino()?>>

<?php
      $validador -> mostrar_error_ciudad_destino(); 
    ?>
    </div>

  </div>  
<div class="form-group">
    <label>Duracion estimada (horas)</label>
    <input type="number" class="form-control" name="duracion" placeholder="1"<?php $validador -> mostrar_duracion()?>>

<?php
      $validador -> mostrar_error_duracion(); 
    ?>
    </div>
<div class="form-group">
    <label>Precio total</label>
    <input type="number" class="form-control" name="precio" placeholder="1000"<?php $validador -> mostrar_precio_total()?>>

<?php
      $validador -> mostrar_error_precio_total(); 
    ?>
    </div>
<div class="form-group">
    <label>Descripcion</label>
    <input type="text" style="HEIGHT: 98px" class="form-control" name="descripcion" placeholder=""<?php $validador -> mostrar_descripcion()?>>


<?php
      $validador -> mostrar_error_descripcion(); 
    ?>
  </div>  
<?php $patente=$validador -> obtener_vehiculo()?>
<label for="inputState">vehículo</label>
                            <select id="inputState" name=vehiculo class="form-control">
                            <?php $autos=RepositorioTiene::autos_idConductor(Conexion::obtener_conexion(),$conductor-> getIdUsuario()); 
                            if(isset($autos)){
                            foreach($autos as $auto){
                            if($auto ->getPatente()===$patente){
                             echo "<option selected>".$auto->getPatente()."</option>"; }
                             else{
                             echo "<option>".$auto->getPatente()."</option>";    
                             }}} ?>
                            </select>
                            <br>
                            <div class="form-group">
    <label>Primera fecha</label>
    <input id="datetime" readonly="readonly"class="form-control" name="fecha" placeholder=""<?php $validador -> mostrar_fecha_inicio()?>>

<?php
      $validador -> mostrar_error_fecha_inicio(); 
    ?>
    <br>                            


                            

<h4>Todos los campos son obligatorios</h4>

<br>
<button type="submit"class="btn botoncss" name="enviar">Iniciar creación</button>
<button type="reset"class="btn botoncss">Limpiar formulario</button>