<div class="form-group">
    <label>Marca</label>
    <input type="text" class="form-control" name="marca" placeholder="Marca"<?php $validador -> mostrar_marca()?>>
</div>
<?php
      $validador -> mostrar_error_marca(); 
    ?>
<div class="form-group">
    <label>Modelo</label>
    <input type="text" class="form-control" name="modelo" placeholder="Modelo"<?php $validador -> mostrar_modelo()?>>
</div>
<?php
      $validador -> mostrar_error_modelo(); 
    ?>
<div class="form-group">
    <label>Capacidad</label>
    <input type="number" class="form-control" name="capasidad" placeholder="Capacidad"<?php $validador -> mostrar_capasidad()?>>
</div>
<?php
      $validador -> mostrar_error_capasidad(); 
    ?>
<div class="form-group">
    <label>Color</label>
    <input type="text" class="form-control" name="color" placeholder="Color"<?php $validador -> mostrar_color()?>>
</div>
<?php
      $validador -> mostrar_error_color(); 
    ?>
<label for="inputState">Tipo de vehículo</label>
                            <select id="inputState" name=tipoAuto class="form-control">
                            <option <?php if($_POST['tipoAuto']==='Auto'){ echo 'selected';}?>>Auto</option>
                            <option <?php if($_POST['tipoAuto']==='Camioneta'){ echo 'selected';}?>>Camioneta</option>
                            <option <?php if($_POST['tipoAuto']==='Combi'){ echo 'selected';}?>>Combi</option>
                            <option <?php if($_POST['tipoAuto']==='Colectivo'){ echo 'selected';}?>>Colectivo</option>
                            </select>
                            <br>
                            

<h4>Todos los campos son obligatorios</h4>

<br>
<button type="submit"class="btn botoncss" name="enviar">Enviar datos</button>
<button type="reset"class="btn botoncss">Limpiar formulario</button>