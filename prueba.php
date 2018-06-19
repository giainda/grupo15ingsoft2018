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


<?php
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



