<?php
$fechanac = "1990/09/04";
$date = date("Y-m-d", strtotime($fechanac));
$newdate = strtotime('+18 year', strtotime($date));
$newdate = date('Y-m-d', $newdate);
echo $date;
echo $newdate;

$fechaasd = "1990/05/03 23:40";
$date = date("Y-m-d", strtotime($fechaasd));
$newdate = strtotime('+1 hour', strtotime($date));
echo $newdate;
if ($newdate > date('Y-m-d')) {
    echo 'true';
} else {
    echo 'false';
}
echo date('Y-m-d');
$patente = 'as123ad';
$primera = substr($patente, 0, 2);
$prin = substr($patente, 0, 5);

$segunda = substr($prin, 2, 5);
$tercera = substr($patente, 5, 7);
print $tercera;
print 'asd';
if(isset($_POST['enviar']))
{
    echo $_POST['exampleRadios'];
}
include_once "plantillas/documento-declaracion.inc.php";
?>

<input id="datetime" readonly="readonly">
<label for="add_fields_placeholder">Placeholder: </label>
<select name="add_fields_placeholder" id="add_fields_placeholder">
    <option value="50">50</option>
    <option value="100">100</option>
    <option value="Other">Other</option>
</select>
<div id="add_fields_placeholderValue">
    Price:
    <input type="text" name="add_fields_placeholderValue" id="add_fields_placeholderValue">
</div>​
<?php
$cant = 2;
$fechaasd = "1990/05/03 23:40";
$cenvertedTime = date('Y-m-d H:i:s', strtotime('+' . $cant . ' hour', strtotime($fechaasd)));
echo $cenvertedTime;
?>
<form role="form" method="post" action="prueba.php">
<div class="form-check">
  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
  <label class="form-check-label" for="exampleRadios1">
    Default radio
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2asd">
  <label class="form-check-label" for="exampleRadios2">
    Second default radio
  </label>
</div>
<button type="submit" name="enviar" class="btn botoncss form-control color1">Con mis fondos</button>
</form>

<br>
<br>
<br>
<form  role="form" method="post" action="prueba.php">
<div class="form-group">
    <label>Duracion estimada (horas)</label>
    <input type="time" class="form-control" name="duracion" placeholder="1">
</div>
<button type="submit"class="btn botoncss" name="enviar">Enviar datos</button>
</form>
<?php
if(isset($_POST['enviar'])){
   $time= $_POST['duracion'];
   echo $time;
   $arr= getDate((new DateTime($time))->getTimeStamp());
   echo "<br>";
   echo $arr['hours'];}


include_once "plantillas/documento-cierre.inc.php";
?>
<script> $("#datetime").datetimepicker();

    $(document).ready(function ()
    {
        $("#add_fields_placeholder").change(function ()
        {
            if ($(this).val() == "Other")
            {
                $("#add_fields_placeholderValue").show();
            } else
            {
                $("#add_fields_placeholderValue").hide();
            }
        });
        $("#add_fields_placeholderValue").hide();
    });</script>



