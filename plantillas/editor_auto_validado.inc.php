
<div class="form-group">
    <label>Capasidad</label>
    <input type="number" class="form-control" name="capasidad" placeholder="Cpasidad"<?php $validador -> mostrar_capasidad()?>>
    <?php
      $validador -> mostrar_error_capasidad(); 
    ?>
</div>
<div class="form-group">
    <label>Color</label>
    <input type="text" class="form-control" name="color" placeholder="Color"<?php $validador -> mostrar_color()?>>
    <?php
      $validador -> mostrar_error_color(); 
    ?>
</div>
<br>
<button type="submit"class="btn botoncss" name="enviar">Confirmar cambios</button>
<br>
<br>
<br>