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
    <input type="text" class="form-control" name="fechanac" placeholder="YYYY/MM/DD"<?php $validador -> mostrar_fechanac()?>>
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
<div class="form-group">
    <label>codigo_tarjeta</label>
    <input type="text" class="form-control" name="codigo_tarjeta" placeholder="123412341234"<?php $validador -> mostrar_codigo_tarjeta()?>>
    <?php
      $validador -> mostrar_error_codigo_tarjeta(); 
    ?>
</div>
<br>
<button type="submit"class="btn btn-default btn-primary" name="enviar">Enviar datos</button>
<button type="reset"class="btn btn-default btn-primary">Limpiar formulario</button>