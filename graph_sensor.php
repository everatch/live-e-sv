<!DOCTYPE HTML>

<html>
<head>
	<meta charset="utf-8">
	<title>Graph --- live-E Sensor Viewer</title>
    <?php
    include 'contents/head.php';
	include "function.php";
	
	// グラフ
	if (isset($_GET['graph'])){
		$graph = $_GET['graph'];
	}else{
		$graph = 'line';
	}
	if (isset($_GET['sens_l'])){
		$sens_l = $_GET['sens_l'];
	}else{
		$sens_l = 'Temperature';
	}
	if (isset($_GET['sens_r'])){
		$sens_r = $_GET['sens_r'];
	}else{
		$sens_r = '';
	}
	if (isset($_GET['s_date'])){
		$s_date = $_GET['s_date'];
	}else{
		$s_date = date("Ymd");
	}
	if (isset($_GET['s_time'])){
		$s_time = $_GET['s_time'];
	}else{
		$s_time = date("His");
	}
	if (isset($_GET['e_date'])){
		$e_date = $_GET['e_date'];
	}else{
		$e_date = date("Ymd");
	}
	if (isset($_GET['e_time'])){
		$e_time = $_GET['e_time'];
	}else{
		$e_time = date("His");
	}
	if (isset($_GET['series_'])){
		$series_ = $_GET['series_'];
	}
	
	//シリーズ
	for($num=0;$num<10;$num++){
		$num_id = 'series'.$num;
		if (isset($_GET[$num_id])){
			$series[$num] = $_GET[$num_id];
		}else{
			break;
		}
	}
	
	if($s_date > $e_date){
		$e_date = $s_date;
	}
	
	$s_second = $s_time % 100;
	$s_minute = ($s_time - $s_second) / 100 % 100;
	$s_hour = ($s_time - $s_second - $s_minute*100) / 10000;
	$s_day = $s_date % 100;
	$s_month = ($s_date - $s_day) / 100 % 100;
	$s_year = ($s_date - $s_day - $s_month*100) / 10000;
	
	$e_second = $e_time % 100;
	$e_minute = ($e_time - $e_second) / 100 % 100;
	$e_hour = ($e_time - $e_second - $e_minute*100) / 10000;
	$e_day = $e_date % 100;
	$e_month = ($e_date - $e_day) / 100 % 100;
	$e_year = ($e_date - $e_day - $e_month*100) / 10000;
		
	$url_now = $_SERVER["REQUEST_URI"];
	$content_now = "graph.php";
	?>

	
    <link href="css/content_graph.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/graph.js"></script>

</head>

<body>
    
			<script type="text/javascript">
			<!--
				/*JavaScriptの関数を読み取る*/
				block(input);
				none(input);
				lang_button(input);
				button_over(input);
				button_out(input);
				button_click(input);
			// -->
			</script>
<!----------------------bar----------------------->

<div id="bar">
	<div id="bar_">
    <!--------------------現在の言語＆言語リスト-------------------->
		<?php include ("contents/con_top_bar.php");?>
	
            <script language="JavaScript">
			<!--
			var link_hint_count=0;
			
			function link_hint(hint_mess,url){
				if ( window.confirm(hint_mess) ){
					location.href = url;
				}else{
					document.getElementById("a").style.background='rgba(0,0,0,0)';
					document.getElementById("a").style.color="rgb(92,92,92)";
					document.getElementById("a").style.textShadow=" 0 0 2px rgb(92,92,92)";
					document.getElementById("a").className='menu_button off';
					document.getElementById("b").style.background='rgba(0,0,0,0)';
					document.getElementById("b").style.color="rgb(92,92,92)";
					document.getElementById("b").style.textShadow=" 0 0 2px rgb(92,92,92)";
					document.getElementById("b").className='menu_button off';
					document.getElementById("d").style.background='rgba(0,0,0,0)';
					document.getElementById("d").style.color="rgb(92,92,92)";
					document.getElementById("d").style.textShadow=" 0 0 2px rgb(92,92,92)";
					document.getElementById("d").className='menu_button off';
					
					document.getElementById("c").style.background="rgba(0,0,0,0.3)";
					document.getElementById("c").style.color="rgb(235,235,235)";
					document.getElementById("c").style.textShadow=" 0 0 2px (235,235,235)";
					document.getElementById("c").className='menu_button click';
					return 0;
				}
			}
			// -->
            </script>
    </div>
</div>

<!----------------------header----------------------->
<div id="header">
	<div id="logo">
    	<a href="index.php">
        	<?php include "contents/logo.php"; ?>
        </a>
	</div>
	<div id="l_menu">
		<?php
			include "contents/left_menu.php";
			show_left_menu("c",$lang,$sensor);
		?>
    </div>
</div>
<!----------------------content----------------------->
<div id="content">
    
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
	<!--
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        	<?php
			if(@$series[0]){
				echo "['Time'";
				for($i=0;$i<count($series);$i++){
					echo ",'".$lang_sName[$series[$i]]."'";
				}
				echo "],";
				getTimeData($series,$sens_l,$s_year,$s_month,$s_day,$s_hour,$s_minute,$s_second,$e_year,$e_month,$e_day,$e_hour,$e_minute,$e_second);
			}
			?>
        ]);

        var options = {
          title: '<?php echo $sens_l; ?>'
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
	  -->
    </script>
<!----------------------content_graph----------------------->
	<div id="content_graph">
    
    <div id="graph_back">
    	
        <?php
		$series_display = "none";
		if(@$series[0]){
    		echo '<div id="chart_div" style="width: 830px; height: 350px;"></div>';
			$series_display = "block";
		}
		?>
        
        <div id="add_buttom" align="right" style="display:<?php echo $series_display; ?>">
        
        	<script type="text/javascript">
			<!--
				function block_series() {
					document.getElementById("add_series_ground").style.display="block";
				}
				
				function nonek_series() {
					document.getElementById("add_series_ground").style.display="none";
				}
				
				function add_series() {
					var series = document.addseriesform.series.value;
					
					var graphs_url = "&series<?php echo count($series); ?>=" + series;
					
					location.href = location.href + graphs_url;
					
				}
			-->
			</script>
            
        	<input type="button" value="<?php echo $lang_graph_redo; ?>" onClick="location.href = 'graph.php'">&nbsp;&nbsp;&nbsp;<input type="button" value="<?php echo $lang_graph_addseries; ?>" onClick="block_series();">
        </div>
        
        <div id="add_series_ground" style="display:none">
        	<div id="add_series">
            	<div align="center">
                <form name="addseriesform">
                    <table width="505">
                    <tr><th>&nbsp;</th></tr>
                    <tr>
                        <th width="65">
                            <?php echo $lang_graph_series; ?>
                        </th>
                        <th>
                        <div align="right">
                            <select name='series'>
                                <?php
									for($i=0;$i<count($sensorlist);$i++){
										echo "<option value=".$sensorlist[$i].">".$lang_sName[$sensorlist[$i]]."</option>";
									}
								?>
                            </select>
                        </th>
                    </tr>
                    
                    <tr><th>&nbsp;</th></tr>
                    <tr><th>&nbsp;</th></tr>
                    <tr><th>&nbsp;</th></tr>
                    
                    <tr><th></th><th>
                    	<div align="right"><input type="button" value="<?php echo $lang_graph_cancle; ?>" onClick="nonek_series();">&nbsp;&nbsp;&nbsp;<input type="button" value="<?php echo $lang_graph_add; ?>" onClick="add_series();"></div>
                    </tr></th>
                    </table>
                </form>
                </div>
        	</div>
        </div>
                
        <div id="timesform"<?php if(@$series[0]){ echo ' style="display:none"'; }?> align="center">
            <form name="settimeform">
        
        	<table width="525" border="0">
            <tr height="35">
            	<th width="90">
           	    <div align="right"><?php //echo $lang_graphtype; ?>&nbsp;</div>
                </th>
                
                <th width="35"></th>
                
            	<th width="90">
           	    <div align="center"><?php echo $lang_graph_year; ?>&nbsp;</div>
                </th>
                
            	<th width="90">
           	    <div align="center"><?php echo $lang_graph_month; ?>&nbsp;</div>
                </th>
                
            	<th width="90">
           	    <div align="center"><?php echo $lang_graph_day; ?>&nbsp;</div>
                </th>
                
            	<th width="90">
           	    <div align="center"><?php echo $lang_graph_hour; ?>&nbsp;</div>
                </th>
                
            	<th width="90">
           	    <div align="center"><?php echo $lang_graph_minute; ?>&nbsp;</div>
                </th>
                
            	<th width="90">
           	    <div align="center"><?php echo $lang_graph_second; ?>&nbsp;</div>
                </th>
            </tr>
            
            <tr height="35">
            	<th>
                <div align="right"><?php echo $lang_graph_start; ?>&nbsp;</div></th>
            	
                
                <th width="49"></th>
                
            	<th>
                  <div align="center">
                    <select name='s_year' onChange="getEndMonth('start');getMonthEndDay('start');time_check();">
                      <?php
					  	for($i=date(Y);$i>1999;$i--){
							if($i == $s_year){
								$selected = " selected";
							}else{ $selected = ""; }
							echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
						}
					  ?>
                    </select>
                </div></th>
                
            	<th>
                  <div align="center">
                    <select name='s_month' onChange="getMonthEndDay('start');time_check();">
                      <?php
					  	if($s_year == date(Y)){
							$months = date(m) + 1;
						}else{
							$months = 13;
						}
					  	for($i=1;$i<$months;$i++){
							if($i == $s_month){
								$selected = " selected";
							}else{ $selected = ""; }
							echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
						}
					  ?>
                    </select>
                </div></th>
                
            	<th>
                  <div align="center">
                    <select name='s_day' onChange="time_check('start');">
                      <?php
					  	if($s_month == 2){
							if($s_year % 4 == 0){
								if($s_year % 100 == 0){
									if($s_year % 400 == 0){
										$leap_year = 1;
									}else{ $leap_year = 0; }
								}else{ $leap_year = 1; }
							}else{ $leap_year = 0; }
							if($leap_year == 1){
								$days = 30;
							}else{ $days = 29; }
						}else if ($s_month == 4 || $s_month == 6 || $s_month == 9 || $s_month == 11){
							$days = 31;
						}else{ $days = 32; }
						
						if($s_day >= $days){
							$s_day = $days - 1;
						}
					  
					    if($s_month == date(m)){
							$days = date(d) + 1;
						}
						
					  	for($i=1;$i<$days;$i++){
							if($i == $s_day){
								$selected = " selected";
							}else{ $selected = ""; }
							echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
						}
					  ?>
                    </select>
                </div></th>
                
            	<th>
                  <div align="center">
                    <select name='s_hour' onChange="time_check('start');">
                      <?php
					  	for($i=1;$i<24;$i++){
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
					  ?>
                    </select>
                </div></th>
                
            	<th>
                  <div align="center">
                    <select name='s_minute' onChange="time_check('start');">
                      <?php
					  	for($i=1;$i<60;$i++){
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
					  ?>
                    </select>
                </div></th>
                
            	<th>
                  <div align="center">
                    <select name='s_second' onChange="time_check('start');">
                      <?php
					  	for($i=1;$i<60;$i++){
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
					  ?>
                    </select>
                </div></th>
            </tr>
            
            <tr height="35">
            	<th>
                <div align="right"><?php echo $lang_graph_end; ?>&nbsp;</div></th>
            	
                
                <th width="49"></th>
                
            	<th>
                  <div align="center">
                    <select name='e_year' onChange="getEndMonth('end');getMonthEndDay('end');time_check();">
                      <?php
					  	for($i=date(Y);$i>1999;$i--){
							if($i == $e_year){
								$selected = " selected";
							}else{ $selected = ""; }
							echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
						}
					  ?>
                    </select>
                </div></th>
                
            	<th>
                  <div align="center">
                    <select name='e_month' onChange="getMonthEndDay('end');time_check();">
                      <?php
					  	if($e_year == date(Y)){
							$months = date(m) + 1;
						}else{
							$months = 13;
						}
					  	for($i=1;$i<$months;$i++){
							if($i == $e_month){
								$selected = " selected";
							}else{ $selected = ""; }
							echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
						}
					  ?>
                    </select>
                </div></th>
                
            	<th>
                  <div align="center">
                    <select name='e_day' onChange="time_check('end');">
                      <?php
					  	if($e_month == 2){
							if($e_year % 4 == 0){
								if($e_year % 100 == 0){
									if($e_year % 400 == 0){
										$leap_year = 1;
									}else{ $leap_year = 0; }
								}else{ $leap_year = 1; }
							}else{ $leap_year = 0; }
							if($leap_year == 1){
								$days = 30;
							}else{ $days = 29; }
						}else if ($e_month == 4 || $e_month == 6 || $e_month == 9 || $e_month == 11){
							$days = 31;
						}else{ $days = 32; }
						
						if($e_day >= $days){
							$e_day = $days - 1;
						}
						
						if($e_month == date(m)){
							$days = date(d) + 1;
						}
					  
					  	for($i=1;$i<$days;$i++){
							if($i == $e_day){
								$selected = " selected";
							}else{ $selected = ""; }
							echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
						}
					  ?>
                    </select>
                </div></th>
                
            	<th>
                  <div align="center">
                    <select name='e_hour' onChange="time_check('end');">
                      <?php
					  	for($i=1;$i<24;$i++){
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
					  ?>
                    </select>
                </div></th>
                
            	<th>
                  <div align="center">
                    <select name='e_minute' onChange="time_check('end');">
                      <?php
					  	for($i=1;$i<60;$i++){
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
					  ?>
                    </select>
                </div></th>
                
            	<th>
                  <div align="center">
                    <select name='e_second' onChange="time_check('end');">
                      <?php
					  	for($i=1;$i<60;$i++){
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
					  ?>
                    </select>
                </div></th>
            </tr>
            </table>
            
            <br>
            <br>
            
            <table width="505">
            <tr>
            	<th width="65">
            		<?php echo $lang_graph_series; ?>
            	</th>
            	<th>
                <div align="right">
            		<select name='series'>
                        <?php
							for($i=0;$i<count($sensorlist);$i++){
								if($sensorlist[$i] == $series_){
									echo "<option value=".$sensorlist[$i]." selected>".$lang_sName[$sensorlist[$i]]."</option>";
								}else{
									echo "<option value=".$sensorlist[$i].">".$lang_sName[$sensorlist[$i]]."</option>";
								}
							}
						?>
                    </select>
            	</th>
            </tr>
            
            </table>
            
            <br>
            <br>
            <div align="right"><input type="button" value="  <?php echo $lang_graph_create; ?>  " onClick="start_graphs();"></div>
                
                </form>
                
                <script type="text/javascript">
				<!--
				function getEndMonth(type) {
					if(type == "start"){
						var s_year = document.settimeform.s_year.value;
						
						var data = new Date();
						if(s_year == data.getFullYear()){
							document.settimeform.s_month.length = data.getMonth()+1;
							for(var i=0;i<data.getMonth()+1;i++){
								document.settimeform.s_month.options[i].value = i+1;
								document.settimeform.s_month.options[i].text = i+1;
							}
						}else{
							document.settimeform.s_month.length = 12;
							for(var i=0;i<12;i++){
								document.settimeform.s_month.options[i].value = i+1;
								document.settimeform.s_month.options[i].text = i+1;
							}
						}
					}else if(type == "end"){
						var e_year = document.settimeform.e_year.value;
						
						var data = new Date();
						if(e_year == data.getFullYear()){
							document.settimeform.e_month.length = data.getMonth()+1;
							for(var i=0;i<data.getMonth()+1;i++){
								document.settimeform.e_month.options[i].value = i+1;
								document.settimeform.e_month.options[i].text = i+1;
							}
						}else{
							document.settimeform.e_month.length = 12;
							for(var i=0;i<12;i++){
								document.settimeform.e_month.options[i].value = i+1;
								document.settimeform.e_month.options[i].text = i+1;
							}
						}
					}
				}
				
				function getMonthEndDay(type) {
					if(type == "start"){
						var s_year = document.settimeform.s_year.value;
						var s_month = document.settimeform.s_month.value;
						
						var data = new Date(s_year, s_month, 0);
						document.settimeform.s_day.length = data.getDate();
						
						for(var i=0;i<data.getDate();++i){
							document.settimeform.s_day.options[i].value = i+1;
							document.settimeform.s_day.options[i].text = i+1;
						}
					}else if(type == "end"){
						var e_year = document.settimeform.e_year.value;
						var e_month = document.settimeform.e_month.value;
						
						var data = new Date(e_year, e_month, 0);
						document.settimeform.e_day.length = data.getDate();
						
						for(var i=0;i<data.getDate();++i){
							document.settimeform.e_day.options[i].value = i+1;
							document.settimeform.e_day.options[i].text = i+1;
						}						
					}
				}
				
				function time_check(type){
					var s_year = document.settimeform.s_year.value;
					var s_month = document.settimeform.s_month.value;
					var s_day = document.settimeform.s_day.value;
					var s_hour = document.settimeform.s_hour.value;
					var s_minute = document.settimeform.s_minute.value;
					var s_second = document.settimeform.s_second.value;
					
					var e_year = document.settimeform.e_year.value;
					var e_month = document.settimeform.e_month.value;
					var e_day = document.settimeform.e_day.value;
					var e_hour = document.settimeform.e_hour.value;
					var e_minute = document.settimeform.e_minute.value;
					var e_second = document.settimeform.e_second.value;
						
					if(type == "start"){
						var data = new Date();
						
						if(data.getFullYear() == s_year && data.getMonth()+1 == s_month && data.getDate() == s_day){
							if(data.getHours() < s_hour){
								alert("no");
								document.settimeform.s_hour.selectedIndex = data.getHours()-2;
							}else if(data.getHours() == s_hour && data.getMinutes() < s_minute){
								alert("no");
								document.settimeform.s_minute.selectedIndex = data.getHours()-2;
							}else if(data.getHours() == s_hour && data.getMinutes() == s_minute && data.getSeconds() < s_second){
								alert("no");
								document.settimeform.s_second.selectedIndex = data.getHours()-2;
							}
						}
					}else if(type == "end"){
						var data = new Date();
						
						if(data.getFullYear() == e_year && data.getMonth()+1 == e_month && data.getDate() == e_day){
							if(data.getHours() < e_hour){
								alert("Selected values are inaccurate.");
								document.settimeform.e_hour.selectedIndex = data.getHours()-2;
							}else if(data.getHours() == e_hour && data.getMinutes() < e_minute){
								alert("Selected values are inaccurate.");
								document.settimeform.e_minute.selectedIndex = data.getHours()-2;
							}else if(data.getHours() == e_hour && data.getMinutes() == e_minute && data.getSeconds() < s_second){
								alert("Selected values are inaccurate.");
								document.settimeform.e_second.selectedIndex = data.getHours()-2;
							}
						}
					}
					var start_time = s_year + "/" + s_month + "/" + s_day + " " + s_hour + ":" + s_minute + ":" + s_second;
					var end_time = e_year + "/" + e_month + "/" + e_day + " " + e_hour + ":" + e_minute + ":" + e_second;
					start_time = new Date(start_time);
					end_time = new Date(end_time);
					if(start_time.getTime() > end_time.getTime()) {
						alert("Selected values are inaccurate");
						document.settimeform.e_year.selectedIndex = document.settimeform.s_year.selectedIndex;
						document.settimeform.e_month.selectedIndex = document.settimeform.s_month.selectedIndex;
						document.settimeform.e_day.selectedIndex = document.settimeform.s_day.selectedIndex;
						document.settimeform.e_hour.selectedIndex = document.settimeform.s_hour.selectedIndex;
						document.settimeform.e_minute.selectedIndex = document.settimeform.s_minute.selectedIndex;
						document.settimeform.e_second.selectedIndex = document.settimeform.s_second.selectedIndex;
					}
				}
				
				function start_graphs(){
					var s_year = document.settimeform.s_year.value;
					var s_month = document.settimeform.s_month.value;
					var s_day = document.settimeform.s_day.value;
					var s_hour = document.settimeform.s_hour.value;
					var s_minute = document.settimeform.s_minute.value;
					var s_second = document.settimeform.s_second.value;
					
					var e_year = document.settimeform.e_year.value;
					var e_month = document.settimeform.e_month.value;
					var e_day = document.settimeform.e_day.value;
					var e_hour = document.settimeform.e_hour.value;
					var e_minute = document.settimeform.e_minute.value;
					var e_second = document.settimeform.e_second.value;
					
					var s_date = s_year * 10000 + s_month * 100 + s_day * 1;
					var s_time = s_hour * 10000 + s_minute * 100 + s_second * 1;
					
					var e_date = e_year * 10000 + e_month * 100 + e_day * 1;
					var e_time = e_hour * 10000 + e_minute * 100 + e_second * 1;
					
					if(s_date == e_date && s_time == e_time){
						window.alert("Start time is the same as end time.");
						return 0;
					}
					
					var series = document.settimeform.series.value;
					
					var graphs_url = "&s_date=" + s_date + "&s_time=" + s_time + "&e_date=" + e_date + "&e_time=" + e_time + "&series<?php echo count(@$series); ?>=" + series;
					
					location.href = location.href + graphs_url;
				}
				// -->
				</script>
                
        </div>
    
    </div>
    
	</div>
</div>
<!----------------------footer----------------------->
<?php
	include "contents/foot.php";
?>
<!----------------------/footer----------------------->

<div id="return_to_mobile" style="display:none" onClick="location.href='mobile/index.php';CookieWrite('pc','false');">
	Return to Mobile
</div>

</body>
</html>
