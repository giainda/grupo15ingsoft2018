
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
<?php if($usuario ->getCodigo_tarjeta()!=0){?>
<div class="form-group">
    <label>código_tarjeta</label>
    <input type="text" class="form-control" name="codigo_tarjeta" placeholder="123412341234"<?php $validador -> mostrar_codigo_tarjeta()?>>
    <?php
      $validador -> mostrar_error_codigo_tarjeta(); 
    ?>
</div>
<?php }?>
<br>


<button type="submit"class="btn botoncss" name="enviar">Confirmar cambios</button>
<br>
<br>
<br>

