<?php

function getLastNDays($days, $format = 'd/m'){
    $m = date("m"); $de= date("d"); $y= date("Y");
    $dateArray = array();
    for($i=0; $i<=$days-1; $i++){
        $dateArray[] = '' . date($format, mktime(0,0,0,$m,($de-$i),$y)) . ''; 
    }
    return array_reverse($dateArray);
}
$arr = getLastNDays(10, 'Y-m-d');
$date = '2018-09-14';
$date = date('d M Y', strtotime($date));



?>

<div class="row">
	<div class="col-md-12">
		<?php 
		include "dashboard_slider.php"; 
		?>
	</div>
	<div class="col-md-0"></div>
</div>

<style type="text/css">
	
</style>