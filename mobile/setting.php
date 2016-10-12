<!DOCTYPE html> 
<html> 
	<head> 
    <meta charset="utf-8">
	<title>Sensor Viewer Mobile</title>
    <?php
    	include '../sensorlist.php';
		include '../lang/jp.php';
		
		
		if(@$_COOKIE["lang"] || @$_COOKIE["sID"]){
			if(@$_COOKIE["lang"]){		
				$lang = $_COOKIE["lang"];
			}
			if(@$_COOKIE["sID"]){
				$sensor = $_COOKIE["sID"];
			}
			if(@$_COOKIE["wID"]){
				$weather_id = $_COOKIE["wID"];
			}else{
				$weather_id = 0;
			}
			if(@$_COOKIE["pID"]){
				$province_id = $_COOKIE["pID"];
			}else{
				$province_id = 0;
			}
			if(@$_COOKIE["rID"]){
				$region_id = $_COOKIE["rID"];
			}else{
				$region_id = 0;
			}
		}
	?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style.css" />
    <script type="text/javascript" src="../js/cookie.js"></script>
    <script type="text/javascript" src="script.js"></script>
    
    <script type="text/javascript">  
		if (navigator.userAgent.indexOf('iPhone') != -1 || navigator.userAgent.indexOf('Android') > 0) { 
		}else{ 
			document.location = "http://www.live-e-sv.info/"; 
		}
	</script>

</head> 
<body> 

<div id="head">Sensor Viewer for mobile</div>

<div id="content">
	<div id="setting_button" align="center" onClick="document.getElementById('setting_button').style.display='none'; document.getElementById('setting').style.display='block';">
		<a style="color:rgba(0,0,0,0.8); font-size:16px;">
        This is the first time for you to access Sensor Viewer.
        <br/>(Or Cookie data has been deleted.)
        <br/>Please push the icon to start setting.
        <br/>It will take only a few seconds.
        </a>
        <div style="padding-top:15px; padding-bottom:35px;"
        <br/><img src="img/setting.png"></img>
        <br/>Setting&nbsp;
        </div>
    </div>
    <div id="setting">
    	<form name="default_set">
        	Default Language:<br/>
        	<select name='default_lang' id='default_lang' onChange="change_form_lang()">
            	<option value="jp">日本語</option>
            	<option value="en">English</option>
            	<option value="sc">中文</option>
            	<option value="kr">한국어</option>
            </select>
            <br/>Default Sensor:<br/>
        	<select name='default_sensor' id='default_sensor' style="width:90%; overflow:hidden;">
            	<?php
					for($i=0;$i<count($sensorlist);$i++){
						echo '<option value="'.$sensorlist[$i].'">'.$lang_sName[$sensorlist[$i]].'</option>';
					}
				?>
            </select>
            <br/><br/>Weather forecast<br/>(Japanese only):
                <table style="text-align:left; width:200px; height:20px;">
                <tr>
                    <td>Region:&nbsp;</td>
                    <td>
                        <select name='region' id='region' onChange="set_province(<?php @$province_id;?>);set_city(<?php echo @$weather_id;?>);">
                            <option value="">---</option>
                            <?php
                                $region = array("北海道地方","東北地方","東海地方","信越・北陸地方","関東地方","近畿地方","中国地方","四国地方","九州地方","南西諸島地方");
                                for($i=0;$i<count($region);$i++){
                                    if($i == @$region_id){
                                        echo '<option value="'.$i.'" selected>'.$region[$i].'</option>';
                                    }else{echo '<option value="'.$i.'">'.$region[$i].'</option>';}
                                    
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Provinc:&nbsp;</td>
                    <td>
                        <select name='province' id='province' onChange="set_city(<?php echo @$weather_id;?>);">
                            <option value="">&nbsp;&nbsp;&nbsp;</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>City:&nbsp;</td>
                	<td>
                        <select name='city' id='city'>
                            <option value="">&nbsp;&nbsp;&nbsp;</option>
                        </select>
                	</td>
                </tr>
                </table>
                <br/>
            <input type="button" value="&nbsp;Ok!&nbsp;" onClick="start(); location.href='index.php';" style="position:relative; float:right; bottom:15px; right:5px;"></input>
        </form>
    </div>
</div>
    
    <script type="text/javascript">
		function change_form_lang(){
			var lang = document.getElementById('default_lang').value;
			
			if(lang == "jp"){
			<?php
				for($i=0;$i<count($sensorlist);$i++){
					echo 'document.default_set.default_sensor.options['.$i.'].text="'.$lang_sName[$sensorlist[$i]].'";';
				}
			?>
			}else{
			<?php
				for($i=0;$i<count($sensorlist);$i++){
					echo 'document.default_set.default_sensor.options['.$i.'].text="'.$sensorName[$sensorlist[$i]].'";';
				}
			?>
			}
		}
		function start(){
			var lang = document.getElementById('default_lang').value;
			var sensor = document.getElementById('default_sensor').value;
			var city = document.getElementById('city').value;
			var region = document.getElementById('region').value;
			var province = document.getElementById('province').value;
			CookieWrite('lang',lang);
			CookieWrite('sID',sensor);
			CookieWrite('rID',region);
			CookieWrite('pID',province);
			CookieWrite('wID',city);
		}
	</script>
    
<div id="foot">Copyright © 2012</div>

</body>
</html>