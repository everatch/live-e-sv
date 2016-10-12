<script type="text/javascript">
window.onload = googlemaps;

function googlemaps(type_num) {
	
	jQuery( function() {
		jQuery( '#jquery-ui-slider' ) . slider( {
        range: 'min',
        value: 240,
        min: 1,
        max: 240,
        step: 1,
        slide: function( event, ui ) {
			var type = document.getElementsByName("type");
  
					for(var i=0;i<type.length;i++) {    //radioボタンの場合、同じ名前のHTML要素が１つ以上存在する  
						if (type[i].checked && type[i].value == 'none') {
							type = 0;
						}else if (type[i].checked && type[i].value == 'Temperature') { 
							type = 1;
						} else if (type[i].checked && type[i].value == 'Humidity') { 
							type = 2;
						} else if (type[i].checked && type[i].value == 'Pressure') { 
							type = 3;
						} else if (type[i].checked && type[i].value == 'RainFall') { 
							type = 4;
						} else if (type[i].checked && type[i].value == 'WindDir') { 
							type = 5;
						} else if (type[i].checked && type[i].value == 'WindSpeed') { 
							type = 6;
						}  
					} 
			
			sensors_icon(type);
        }
    } );
	} );
	sensors = new Array();
	
	<?php
	include 'sensorlist.php';	//センサーリストを取得
	include 'function.php';	//関数ファイルを読み取る（LiveEからデータを取得する関数含め）
	include 'conf.php';	//DB情報
    $sensors = getAllData();
		
	$dataType = array("temp","humi","pres","rainFall","windDir","windSpe");
	
	for($i=0;$i<count($sensorlist);$i++){
		echo 'sensors["'.$sensorlist[$i].'"] = new Array();';
		for($j=0;$j<count($dataType);$j++){
			@$datas = $sensors[$sensorlist[$i]][$dataType[$j]];
			echo 'sensors["'.$sensorlist[$i].'"]["'.$dataType[$j].'"] = "'.$datas.'";';
		}
	}
	
	for($i=0;$i<count($sensorlist_map);$i++){
		
	}
	?>

	var map = new google.maps.Map(document.getElementById("map"), {
		zoom : 10,
		center : new google.maps.LatLng(35.755555555, 139.75555555555555),
		mapTypeId : google.maps.MapTypeId.TERRAIN
	});

	function getColor(data_value){
		var red = 35;
		var yel = 30;
		var whi = 20;
		var sky = 10;
		var blu = 0;
		if(data_value >= red){
			return "FF0000|FFFFFF";
		}else if(data_value >= yel){
			data_value = 255-Math.round((data_value - yel) * (255 / (red - yel)));
			return "FF"+toSixteen(data_value)+"00|"+textcolor(data_value,1);
		}else if(data_value >= whi){
			data_value =255- Math.round((data_value - whi) * (255 / (yel - whi)));
			return "FFFF"+toSixteen(data_value)+"|000000";
		}else if(data_value >= sky){
			data_value = Math.round((data_value - sky) * (255 / (whi - sky)));
			return toSixteen(data_value)+"FFFF|000000";
		}else if(data_value >= blu){
			data_value = Math.round((data_value - blu) * (255 / (sky - blu)));
			return "00"+toSixteen(data_value)+"FF|"+textcolor(data_value,1);
		}else{
			return "0000FF|FFFFFF";
		}
		function toSixteen(value){
			if(value < 16){
				return "0" + value.toString(16);
			}else{
				return value.toString(16);
			}
		}
		function textcolor(value,type){
			if(value < 123 && type == 1 || value > 122 && type == 0){
				return "FFFFFF";
			}else{
				return "000000";
			}
		}
	}
	function sensors_icon(type){
		if(type == 0){
			<?php
			for($i=0;$i<count($sensorlist_map);$i++){
				echo "mak_".$sensorlist_map[$i].".setIcon('img/map/marker.png');";
			}
			?>
			return 0;
		}
		
		var slider_value = jQuery( '#jquery-ui-slider' ) . slider( 'value' );
		var time_value = Math.floor((240 - slider_value) / 10);
		<?php
		for($i=0;$i<count($sensorlist_map);$i++){
			echo "if(data['".$sensorlist_map[$i]."'][time_value][type] == '---'){
				mak_".$sensorlist_map[$i].".setIcon('http://chart.apis.google.com/chart?chst=d_bubble_text_small&chld=edge_bc|None|000000|FFFFFF');
			}else{ 
				var icon_url = 'http://chart.apis.google.com/chart?chst=d_bubble_text_small&chld=edge_bc|'+data['".$sensorlist_map[$i]."'][time_value][type]+'|'+getColor(data['".$sensorlist_map[$i]."'][time_value][type]);
				mak_".$sensorlist_map[$i].".setIcon(icon_url);
			}";
		}
		?>
	}
	
	<?php
	for($i=0;$i<count($sensorlist_map);$i++){
		/*ピンを表示*/
		echo "var mak_".$sensorlist_map[$i]." = new google.maps.Marker({
			position: new google.maps.LatLng(".$sensor_coordinates[$sensorlist_map[$i]]."),
			map:map,
			icon: 'img/map/marker.png',
			animation: google.maps.Animation.DROP,
			title:'".$lang_sName[$sensorlist_map[$i]]."',
		});	";
		/*クリックで情報ウィンドウ表示*/
		echo "google.maps.event.addListener(mak_".$sensorlist_map[$i].", 'click', function() {
			showInfoWindow(this,'".$sensorlist_map[$i]."','".$lang_sName[$sensorlist_map[$i]]."');
		});";
	}
	?>
	/* 情報ウィンドウの表示 */
	var infowindow;
    function showInfoWindow(data,type,sensorname){
    	/* 既に開かれていたら閉じる */
    	if(infowindow) infowindow.close();
    	infowindow=new google.maps.InfoWindow({
        	/* クリックしたマーカーのタイトルと緯度・経度を情報ウィンドウに表示 */
        	content:"<div id='info'><h3>"+sensorname+"</h3><br /><table style='font-family: Verdana, 'MS Gothic', Osaka-mono, monospace, sans-serif !important;'>"
				+"<tr><th><?php echo $lang_temp.":&nbsp;"; ?></th><th>"+sensors[type]["temp"]+"&nbsp;℃</th></tr>"
				+"<tr><th><?php echo $lang_humi.":&nbsp;"; ?></th><th>"+sensors[type]["humi"]+"&nbsp;%</th></tr>"
				+"<tr><th><?php echo $lang_pres.":&nbsp;"; ?></th><th>"+sensors[type]["pres"]+"&nbsp;hPa</th></tr>"
				+"<tr><th><?php echo $lang_prec.":&nbsp;"; ?></th><th>"+sensors[type]["rainFall"]+"&nbsp;mm/h</th></tr>"
				+"<tr><th><?php echo $lang_win_dir.":&nbsp;"; ?></th><th>"+sensors[type]["windDir"]+"&nbsp;°</th></tr>"
				+"<tr><th><?php echo $lang_win_spe.":&nbsp;"; ?></th><th>"+sensors[type]["windSpe"]+"&nbsp;m/s</th></tr></table></div>",
    	});
		infowindow.open(map,data);
    }	
	
	if(type_num && type_num == 1){
		sensors_icon(1);
	}
}
</script>