<script type="text/javascript">
	
	sensors = new Array();
	
	<?php
    $sensors = getAllData();
		
	$dataType = array("temp","humi","pres","rainFall","windDir","windSpe");
	
	for($i=0;$i<count($sensorlist);$i++){
		echo 'sensors["'.$sensorlist[$i].'"] = new Array();';
		for($j=0;$j<count($dataType);$j++){
			$datas = $sensors[$sensorlist[$i]][$dataType[$j]];
			echo 'sensors["'.$sensorlist[$i].'"]["'.$dataType[$j].'"] = "'.$datas.'";';
		}
	}
	?>
function initialize() {

	var map = new google.maps.Map(document.getElementById("maps"), {
		zoom : 10,
		center : new google.maps.LatLng(35.686555,139.770877),
		mapTypeId : google.maps.MapTypeId.TERRAIN
	});

	var image = '../img/map/marker.png';
	
	<?php
	for($i=0;$i<count($sensorlist_map);$i++){
		/*ピンを表示*/
		echo "var mak_".$sensorlist_map[$i]." = new google.maps.Marker({
			position: new google.maps.LatLng(".$sensor_coordinates[$sensorlist_map[$i]]."),
			map:map,
			icon: image,
			animation: google.maps.Animation.DROP,
			title:'".$lang_sName[$sensorlist_map[$i]]."',
		});	";
		/*クリックで情報ウィンドウ表示*/
		echo "google.maps.event.addListener(mak_".$sensorlist_map[$i].", 'click', function() {
			showInfoWindow(this,'".$sensorlist_map[$i]."','".$lang_sName[$sensorlist_map[$i]]."');
		});";
	}
	?>
            function showInfoWindow(data,type,sensorname){
				document.getElementById("data_form").innerHTML='<nobr style="padding:0 10px;"><?php echo $lang_temp." :&nbsp;&nbsp;";?><data>'+sensors[type]["temp"]+'&nbsp;℃</data>&nbsp;&nbsp;&nbsp;<?php echo $lang_humi." :&nbsp;&nbsp;";?><data>'+sensors[type]["humi"]+'&nbsp;%</data>&nbsp;&nbsp;&nbsp;<?php echo $lang_pres." :&nbsp;&nbsp;";?><data>'+sensors[type]["pres"]+'&nbsp;hPa</data>&nbsp;&nbsp;&nbsp;<?php echo $lang_prec." :&nbsp;&nbsp;";?><data>'+sensors[type]["rainFall"]+'&nbsp;mm/h</data>&nbsp;&nbsp;&nbsp;<?php echo $lang_win_dir." :&nbsp;&nbsp;";?><data>'+sensors[type]["windDir"]+'&nbsp;°</data>&nbsp;&nbsp;&nbsp;<?php echo $lang_win_spe." :&nbsp;&nbsp;";?><data>'+sensors[type]["windSpe"]+'&nbsp;m/s</data></nobr>';
			
				document.getElementById("data_time").innerHTML=sensorname+'&nbsp;&nbsp;-&nbsp;&nbsp;Data on <?php echo date("Y/m/d H:i:s"); ?><br/>';
				document.getElementById("head").innerHTML='LiveE! Sensor Viewer Mobile<br/><a style="font-size:12px;">'+sensorname+'</a>';
				CookieWrite('sID',type);
            }
}
</script>