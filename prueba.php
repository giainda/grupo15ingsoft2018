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
$patente='as123ad';
$primera=substr($patente,0,2);
            $prin=substr($patente,0,5);

            $segunda=substr($prin,2,5);
            $tercera=substr($patente,5,7);
            print $tercera;
            print 'asd';


