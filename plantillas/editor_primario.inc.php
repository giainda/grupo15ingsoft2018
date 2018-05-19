
<div class="form-group">
    <label>Nombre</label>
    <input type="text" class="form-control" name="nombre" placeholder="nombre"<?php echo 'value="'.$usuario-> getNombre() .'"';?>>
</div>
<div class="form-group">
    <label>apellido</label>
    <input type="text" class="form-control" name="apellido" placeholder="apellido"<?php echo 'value="'.$usuario-> getApellido() .'"'; ?>>
</div>
<?php if($usuario ->getCodigo_tarjeta()!=0){?>
<div class="form-group">
    <label>codigo tarjeta</label>
    <input type="text" class="form-control" name="codigo_tarjeta" placeholder="123412341234"<?php echo 'value="'.$usuario-> getCodigo_tarjeta() .'"'; ?>>
</div>
<br>
<?php }?>

  

<button type="submit"class="btn botoncss" name="enviar">Confirmar cambios</button>
<br>
<br>
<br>
