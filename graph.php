<!DOCTYPE HTML>

<html>
<head>
	<meta charset="utf-8">    
    <?php
    include 'contents/head.php';
	
	$url_now = $_SERVER["REQUEST_URI"];
	$content_now = "graph.php";
	?>

	
    <link href="css/content_graph.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/graph.js"></script>
	<title>Graph --- live-E Sensor Viewer</title>

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
    
<!----------------------content_graph----------------------->
	<div id="content_graph" class="appear">
    
    
   	  <div id="inform">
        	
            <form name="setgraphform">
        
        	<table width="460" border="0">
            <tr height="35">
            	<th width="200">
           	    <div align="right"><?php echo $lang_graphtype; ?>&nbsp;</div>
                </th>
                
                <th width="12"></th>
                
            	<th width="188">
                <div align="left">
                    <select name='graph_type'>
                      <option value='line'><?php echo $lang_linegraph; ?></option>
                      <!--<option value='bar'><?php //echo $lang_bargraph; ?></option>-->
                    </select>
                </div>
                </th>
            </tr>
            
            <tr height="35">
            	<th>
                <div align="right"><?php echo $lang_sensortype; ?>(<?php echo $lang_left; ?>)&nbsp;</div></th>
            	
                
                <th width="12"></th>
                
            	<th>
                  <div align="left">
                    <!--<select name='sensor_type_l' onchange="sensor_set();">-->
                    <select name='sensor_type_l'>
                      <option value="">-----</option>
                      <option value="Temperature"><?php echo $lang_temp; ?></option>
                      <option value="Humidity"><?php echo $lang_humi; ?></option>
                      <option value="Pressure"><?php echo $lang_pres; ?></option>
                      <option value="RainFall"><?php echo $lang_prec; ?></option>
                      <option value="WindDir"><?php echo $lang_win_dir; ?></option>
                      <option value="WindSpeed"><?php echo $lang_win_spe; ?></option>
                    </select>
                </div></th>
            </tr>
            
            <tr height="35">
            	<th>
                <div align="right"><?php echo $lang_sensortype; ?>(<?php echo $lang_right; ?>)&nbsp;</div></th>
            	
                
                <th width="12"></th>
                
            	<th>
                  <div align="left">
                    <select name='sensor_type_r' disabled>
                      <option value="">Disabled</option>
                      <option value="0"></option>
                      <option value="1"></option>
                      <option value="2"></option>
                      <option value="3"></option>
                      <option value="4"></option>
                    </select>
                </div></th>
            </tr>
            
            <tr height="35">
            	<th>
                <div align="right">
                    <input type="radio" name="comparing" value="sensor" checked>
                        <?php echo $lang_comp_sensor ?>
                    </input>
                </div></th>
                <th width="12"></th>
                
            	<th>
                <div align="left">
                    <input type="radio" name="comparing" value="time" disabled>
                        <?php echo $lang_comp_time ?>
                    </input>
                </div></th>
            </tr>
            </table>
            
            <br>
            <br>
            <input type="button" value="Sample">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" value="Start" onClick="start_graphs();">
                
                </form>
                
                <script type="text/javascript">
				<!--

				var temp = new Array(<?php echo '"-----","'.$lang_humi.'","'.$lang_pres.'","'.$lang_prec.'","'.$lang_win_dir.'","'.$lang_win_spe.'"' ?>);
				var humi = new Array(<?php echo '"-----","'.$lang_temp.'","'.$lang_pres.'","'.$lang_prec.'","'.$lang_win_dir.'","'.$lang_win_spe.'"' ?>);
				var pres = new Array(<?php echo '"-----","'.$lang_temp.'","'.$lang_humi.'","'.$lang_prec.'","'.$lang_win_dir.'","'.$lang_win_spe.'"' ?>);
				var prec = new Array(<?php echo '"-----","'.$lang_temp.'","'.$lang_humi.'","'.$lang_pres.'","'.$lang_win_dir.'","'.$lang_win_spe.'"' ?>);
				var win_dir = new Array(<?php echo '"-----","'.$lang_temp.'","'.$lang_humi.'","'.$lang_pres.'","'.$lang_prec.'","'.$lang_win_spe.'"' ?>);
				var win_spe = new Array(<?php echo '"-----","'.$lang_temp.'","'.$lang_humi.'","'.$lang_pres.'","'.$lang_prec.'","'.$lang_win_dir.'"' ?>);			
				
				function sensor_set(){
				
				  //オプションタグを連続して書き換える
				  for ( i=1; i<6; i++ ){
				
					//選択したリーグによって分岐
					switch (document.setgraphform.sensor_type_l.selectedIndex){
					  case 0: document.setgraphform.sensor_type_r.options[i].text="";break;
					  case 1: document.setgraphform.sensor_type_r.options[i].text=temp[i];break;
					  case 2: document.setgraphform.sensor_type_r.options[i].text=humi[i];break;
					  case 3: document.setgraphform.sensor_type_r.options[i].text=pres[i];break;
					  case 4: document.setgraphform.sensor_type_r.options[i].text=prec[i];break;
					  case 5: document.setgraphform.sensor_type_r.options[i].text=win_dir[i];break;
					  case 6: document.setgraphform.sensor_type_r.options[i].text=win_spe[i];break;
					}
				  }
				}
				
				function start_graphs(){
										
					var graph_type = document.setgraphform.graph_type.value;
					
					if(document.setgraphform.sensor_type_l.value){
						var sensor_type_l = document.setgraphform.sensor_type_l.value;
					}else{
						alert ("<?php echo $lang_hint_nodata; ?>");
						return 0;
					}
					
					if(document.setgraphform.sensor_type_r.value){
						if(document.setgraphform.sensor_type_l.value == "temp"){
							var sens_r_str = new Array("humi","pres","prec","win_dir","win_spe")
						}else if(document.setgraphform.sensor_type_l.value == "humi"){
							var sens_r_str = new Array("temp","pres","prec","win_dir","win_spe")
						}else if(document.setgraphform.sensor_type_l.value == "pres"){
							var sens_r_str = new Array("temp","humi","prec","win_dir","win_spe")
						}else if(document.setgraphform.sensor_type_l.value == "prec"){
							var sens_r_str = new Array("temp","humi","pres","win_dir","win_spe")
						}else if(document.setgraphform.sensor_type_l.value == "win_dir"){
							var sens_r_str = new Array("temp","humi","pres","prec","win_spe")
						}else if(document.setgraphform.sensor_type_l.value == "win_spe"){
							var sens_r_str = new Array("temp","humi","pres","prec","win_dir")
						}
						var sensor_type_r = document.setgraphform.sensor_type_r.value;
						
						sensor_type_r = "&sens_r=" + sens_r_str[sensor_type_r];
					}else{
						var sensor_type_r = "";
					}
					
					var comparing = document.getElementsByName("comparing");
  
					for(var i=0;i<comparing.length;i++) {    //radioボタンの場合、同じ名前のHTML要素が１つ以上存在する  
						if (comparing[i].checked && comparing[i].value == 'sensor') {
							comparing = "sensor";
						}else if (comparing[i].checked && comparing[i].value == 'time') { 
							comparing = "time";
						}  
					}  
					
					var graphs_url = "graph_" + comparing + ".php<?php echo '?sID='.$sensor.'&lang='.$lang;?>&graph=" + graph_type + "&sens_l=" + sensor_type_l + sensor_type_r;
					
					location.href = graphs_url;
				}
				// -->
				</script>
                
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