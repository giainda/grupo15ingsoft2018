<?php
$fechanac="1990/09/04";
$date= date("Y-m-d", strtotime($fechanac));
$newdate= strtotime('+18 year',strtotime($date));
$newdate= date('Y-m-d',$newdate);
echo $date;
echo $newdate;
if ($newdate>date('Y-m-d')){
    echo 'true';
}else{
    echo 'false';
}
echo date('Y-m-d');

