<!DOCTYPE HTML>

<html>
<head>
	<meta charset="utf-8">
	<title>Sensors on maps --- live-E Sensor Viewer</title>
    <?php
    include 'contents/head.php';
	include './js/gomap.php';
	
	$url_now = $_SERVER["REQUEST_URI"];
	$content_now = "map.php";
    
	?>	
    <!-- google maps -->
    <link href="css/content_gomap.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&language=<?php if($lang == 'en'){echo 'en';}else if($lang == 'kr'){echo 'ko';}else if($lang == 'sc'){echo 'ZH-ch';}else{echo 'jp';} ?>"></script>
    
    <!-- jquery -->
    <link rel="stylesheet" href="jquery_ui/themes/base/jquery.ui.all.css" />
    <script type="text/javascript" src="jquery_ui/jquery-1.9.0.js"></script>
    <script type="text/javascript" src="jquery_ui/ui/jquery-ui.js"></script>
	<script type="text/javascript" src="http://www.live-e-sv.info/developers/api/js/sensors.js"></script>

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
			show_left_menu("b",$lang,$sensor);
		?>
    </div>
</div>
<!----------------------content----------------------->
<div id="content">    
<!----------------------content_gomap----------------------->
	<div id="content_gomap" class="appear">
    	<div id="type_select_form">
        	<form name="type_select">
            	<table>
                	<tr>
                    	<th width="6%">
                            <input type="radio" name="type" value="none" onChange="document.getElementById('time_slider').style.display='none';googlemaps();" checked>
                                <?php echo $lang_map_none; ?>
                            </input>
                        </th>
                    	<th width="11%">
                            <input type="radio" name="type" value="Temperature" onChange="document.getElementById('time_slider').style.display='block';googlemaps(1);">
                                <?php echo $lang_map_temperature; ?>
                            </input>
                        </th>
                    	<th width="10%">
                            <input type="radio" name="type" value="Humidity" onChange="document.getElementById('time_slider').style.display='block';googlemaps(2);" disabled>
                                <?php echo $lang_map_humidity; ?>
                            </input>
                        </th>
                    	<th width="10%">
                            <input type="radio" name="type" value="Pressure" onChange="document.getElementById('time_slider').style.display='block';googlemaps(3);" disabled>
                                <?php echo $lang_map_pressure; ?>
                            </input>
                        </th>
                    	<th width="10%">
                            <input type="radio" name="type" value="RainFall" onChange="document.getElementById('time_slider').style.display='block';googlemaps(4);" disabled>
                                <?php echo $lang_map_rainfall; ?>
                            </input>
                        </th>
                    	<th width="11%">
                            <input type="radio" name="type" value="WindDir" onChange="document.getElementById('time_slider').style.display='block';googlemaps(5);" disabled>
                                <?php echo $lang_map_winddir; ?>
                            </input>
                        </th>
                    	<th width="12%">
                            <input type="radio" name="type" value="WindSpeed" onChange="document.getElementById('time_slider').style.display='block';googlemaps(6);" disabled>
                                <?php echo $lang_map_windspeed; ?>
                            </input>
                        </th>
                    </tr>
                </table>
            </form>
        </div>
    	<div id="show_map">
			<div id="map"></div>
            <div id="time_slider">
                <img src="http://www.live-e-sv.info/img/ruler.png" width="50px" height="250px" style="z-index:9999;position:absolute;left:712px;top:68px;" />
                <div id="jquery-ui-slider"></div>
                <div id="time_text">
                    23 22 21 20 19 18 17 16 15 14 13 12 11 10 9 8 7 6 5 4 3 2 1 0
                    <div style="font-size:15px">(<?php echo $lang_map_hoursago; ?>)</div>
                </div>
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
