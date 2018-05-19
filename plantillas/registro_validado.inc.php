<div class="form-group"> 
    <label>correo</label>
    <input type="email" class="form-control" name="correo" placeholder="correo"<?php $validador -> mostrar_correo()?>>
    <?php
      $validador -> mostrar_error_correo(); 
    ?>
</div>
<div class="form-group">
    <label>nombre</label>
    <input type="text" class="form-control" name="nombre" placeholder="nombre"<?php $validador -> mostrar_nombre()?>>
    <?php
      $validador -> mostrar_error_nombre(); 
    ?>
</div>
<div class="form-group">
    <label>apellido</label>
    <input type="text" class="form-control" name="apellido" placeholder="apellido"<?php $validador -> mostrar_apellido()?>>
    <?php
      $validador -> mostrar_error_apellido(); 
    ?>
</div>
<div class="form-group">
    <label>fecha de nacimienton</label>
    <input type="text" class="form-control" name="fechanac" placeholder="DD/MM/YYYY"<?php $validador -> mostrar_fechanac()?>>
    <?php
      $validador -> mostrar_error_fechanac(); 
    ?>
</div>
<div class="form-group">
    <label>contraseña</label>
    <input type="password" class="form-control" name="contraseña" placeholder="******">
    <?php
      $validador -> mostrar_error_contraseña(); 
    ?>
</div>
<div class="form-group">
    <label>confirmar contraseña</label>
    <input type="password" class="form-control" name="contraseña2" placeholder="******"
    <?php
      $validador -> mostrar_error_contraseña2(); 
    ?>
</div>
<br>
<h4>Todos los campos son obligatorios</h4>

<br>
<button type="submit"class="btn botoncss" name="enviar">Enviar datos</button>
<button type="reset"class="btn botoncss">Limpiar formulario</button>