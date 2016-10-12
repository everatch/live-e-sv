<html>
  <head>
  </head>
  <body>

  <?php
	$start = "2013-1-1T19:0:0";
	$end = "2013-1-10T15:53:0";
	//$sum_times = ((($e_year - $s_year) * 365 + ($e_month - $s_month) * 30 + $e_day - $s_day) * 24 + $e_hour - $s_hour) * 60 + $e_minute - $s_minute;
	$sum_times = (strtotime($end) - strtotime($start)) / 60;
	$div_times = round($sum_times / 10);
	
	$sum_times = $start." +".$sum_times." minutes";
	echo date('Y-m-d', strtotime($sum_times))."T".date('H:i:s', strtotime($sum_times));
  ?>
    
  </body>
</html>