<!DOCTYPE html> 
<html> 
	<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
    <meta property="og:title" content="LiveE! Sensor Viewer for Mobile"/>
	<meta property="og:description" content="(Mobile only)LiveE!から取得した環境情報の公開や活用"/>
    <meta property="og:image" content="http://www.live-e-sv.info/img/preview_mobile.png" />
	<meta property="og:url" content="http://www.live-e-sv.info/mobile/"/>
	<meta property="og:type" content="website"/>
	<meta property="og:site_name" content="LiveE! Sensor Viewer for Mobile"/>
    
    <link rel="apple-touch-icon" href="http://www.live-e-sv.info/img/preview_mobile.png" />
    
    <meta name="keywords" content="sensor viewer,senser,live-e,live-e-sv,センサー,柏の葉高校,高大連携" />
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<title>Sensor Viewer Mobile</title>
    <?php
		if(@$_COOKIE["lang"] && @$_COOKIE["sID"] && @$_COOKIE["wID"]){
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
		}else{
			echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=setting.php">';
		}
    	
		include '../sensorlist.php';		
		include '../lang/'.$lang.'.php';
		include 'function.php';
		include 'gomap.php';	
		
		$dataArray = getData($sensor);
	?>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<link rel="stylesheet" href="style.css" />
    <script type="text/javascript" src="../js/cookie.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&language=<?php if($lang == 'en'){echo 'en';}else if($lang == 'kr'){echo 'ko';}else if($lang == 'sc'){echo 'ZH-ch';}else{echo 'jp';} ?>"></script>
	<script charset="utf-8" src="http://www.live-e-sv.info/developers/api/js/sensors.js"></script>
	<script charset="utf-8" src="data_show.js"></script>
    
    <script type="text/javascript">  
		if (navigator.userAgent.indexOf('iPhone') != -1 || navigator.userAgent.indexOf('Android') > 0) { 
		}else{ 
			document.location = "http://www.live-e-sv.info/";
		}
	</script>

</head> 
<body onLoad="getScrollPosition();"> 



<div id="content">
<div id="top">
<div id="head">LiveE! Sensor Viewer for Mobile<br/><a style="font-size:12px;"><?php echo $lang_sName[$sensor]; ?></a></div>
	<div id="content_top">
        <div id="data_form">
            <nobr style="padding:0 10px;">
                <?php
                    echo $lang_temp." :&nbsp;&nbsp;";
                ?>
                    <data>
                    <?php
                        echo $dataArray['temp']."&nbsp;℃";
                    ?>
                    </data>
                &nbsp;&nbsp;&nbsp;
                <?php
                    echo $lang_humi." :&nbsp;&nbsp;";
                ?>
                    <data>
                    <?php
                        echo $dataArray['humi']."&nbsp;%";
                    ?>
                    </data>
                &nbsp;&nbsp;&nbsp;
                <?php
                    echo $lang_pres." :&nbsp;&nbsp;";
                ?>
                    <data>
                    <?php
                        echo $dataArray['pres']."&nbsp;hPa";
                    ?>
                    </data>
                &nbsp;&nbsp;&nbsp;
                <?php
                    echo $lang_prec." :&nbsp;&nbsp;";
                ?>
                    <data>
                    <?php
                    echo $dataArray['rainFall']."&nbsp;mm/h";
                    ?>
                    </data>
                &nbsp;&nbsp;&nbsp;
                <?php
                    echo $lang_win_dir." :&nbsp;&nbsp;";
                ?>
                    <data>
                    <?php
                        echo $dataArray['windDir']."&nbsp;°";
                    ?>
                    </data>
                &nbsp;&nbsp;&nbsp;
                <?php
                    echo $lang_win_spe." :&nbsp;&nbsp;";
                ?>
                    <data>
                    <?php
                        echo $dataArray['windSpe']."&nbsp;m/s";
                    ?>
                    </data>
            </nobr>
        </div>
        <?php
            if(!@$dataArray['time']){@$dataArray['time'] = date("Y/m/d H:i:s");}
            echo '<div id="data_time">'.$lang_sName[$sensor].'&nbsp;&nbsp;-&nbsp;&nbsp;Data on '.$dataArray["time"].' <br/></div>';
        ?>
        <div id="menu">
            <table>
                <tr class="menu_icon">
                    <th onClick="change_content('home');">
                        Home
                    </th>
                    <th style="width:3px;">
                        |
                    </th>
                    <th onClick="change_content('maps');">
                        Maps
                    </th>
                    <th style="width:3px;">
                        |
                    </th>
                    <th onClick="change_content('logs');">
                        Logs
                    </th>
                </tr>
            </table>
        </div>
    </div>
    </div>
    <div id="mirror"></div>
    <div id="home">
    
    <?php
	//ライブドアの天気予報を表示する関数
	function lwws($city,$day){
	 
		//XMLデータ取得用ベースURL
		$req = "http://weather.livedoor.com/forecast/webservice/rest/v1";
		
		//XMLデータ取得用リクエストURL生成
		$req .= "?city=".$city."&day=".$day;
		
		//XMLファイルをパースし、オブジェクトを取得
		$xml = simplexml_load_file($req)
		or die("XMLパースエラー");
		 
		//$xmlオブジェクトの中身を確認する場合は、以下のコメントを外す
		/*
		echo "<pre>";
		var_dump ($xml);
		echo "</pre>";
		*/
		$ret = '<div class="lwws">';
		$ret .= "<table>";
		$ret .= "<tr><th colspan='4' style='font-size:25px;'>".$xml->title."</th></tr>";
		$ret .= "<tr>";
		$ret .= "<th>&nbsp;</th>";
		$ret .= "<th style='text-align:right;'><img src=\"".$xml->image->url."\" alt=\"".$xml->image->title."\"></div>";
		$ret .= "<th style='text-align:left;'><a style='color:rgb(255,0,0)'>最高気温&nbsp;".$xml->temperature->max->celsius."&nbsp;度</a>";
		$ret .= "<br/><a style='color:rgb(0,0,255)'>最低気温&nbsp;".$xml->temperature->min->celsius."&nbsp;度</a></th>";
		$ret .= "<th>&nbsp;</th>";
		$ret .= "</tr>";
		$ret .= "</table>";
		$ret .= "<div style='padding:10px 20px;'>".$xml->description."</div>";
		$ret .= "</div>";
		return $ret;
		
	}
	
	//ライブドアの天気予報を表示する関数をコールする
	echo lwws($weather_id,"tomorrow");
  
	?>
    
    </div>
    <div id="maps" style="width:100%; height:100%"></div>
    <div id="logs">
    <script>new sv_showForm("none","<?php if($lang == "jp"){echo 'jp';}else{echo 'en';}?>","<?php echo $sensor;?>",24,320,520,"rgba(0,0,0,0.4)","rgba(255,255,255,1)","rgba(0,0,0,0.4)","rgba(255,255,255,1)","rgba(0,0,0,0.5)","rgba(0,0,0,0.4)","rgba(255,255,255,1)","auto");</script>
    </div>
</div>
    
    <div id="contents_back">
    	<div id="setting_" style="display:none;background:rgba(255,255,255,0.8); position:relative; top:10%; height:auto;">
            <form name="default_set">
                Default Language:&nbsp;&nbsp;&nbsp;
                <select name='default_lang' id='default_lang' onChange="change_form_lang()">
                    <option value="jp" <?php if($lang == "jp"){echo "selected";} ?>>日本語</option>
                    <option value="en" <?php if($lang == "en"){echo "selected";} ?>>English</option>
                    <option value="sc" <?php if($lang == "sc"){echo "selected";} ?>>中文</option>
                    <option value="kr" <?php if($lang == "kr"){echo "selected";} ?>>한국어</option>
                </select>
                <br/>Default Sensor:<br/>
                <select name='default_sensor' id='default_sensor' style="width:90%; overflow:hidden;">
                    <?php
                        for($i=0;$i<count($sensorlist);$i++){
							if($sensor == $sensorlist[$i]){
                            	echo '<option value="'.$sensorlist[$i].'" selected>'.$lang_sName[$sensorlist[$i]].'</option>';
							}else{
								echo '<option value="'.$sensorlist[$i].'">'.$lang_sName[$sensorlist[$i]].'</option>';
							}
                        }
                    ?>
                </select>
                <br/><br/>Weather forecast(Japanese only):
                <br/>Region:&nbsp;
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
                <br/>Provinc:&nbsp;
                <select name='province' id='province' onChange="set_city(<?php echo @$weather_id;?>);">
                    <option value="">&nbsp;&nbsp;&nbsp;</option>
                </select>
                &nbsp;&nbsp;&nbsp;City:&nbsp;
                <select name='city' id='city'>
                    <option value="">&nbsp;&nbsp;&nbsp;</option>
                </select>
                <br/><br/>
                <input type="button" value="&nbsp;Ok&nbsp;" onClick="start(); location.href='index.php';" style="position:relative; float:right; bottom:10px; right:0px;"></input>
                &nbsp;&nbsp;&nbsp;
                <input type="button" value="&nbsp;Return&nbsp;" onClick="document.getElementById('setting_').className='disappear'; document.getElementById('contents_back').className='disappear';" style="position:relative; float:right; bottom:10px; right:10px;"></input>
            </form>
        </div>
    
    
        <div id="about">
        	<a style="float:right; position:fixed; top:12px; right:15px; font-size:27px; background-color:rgba(0,0,0,0.4)" onClick="document.getElementById('about').className='disappear'; document.getElementById('contents_back').className='disappear';">&nbsp;×&nbsp;</a>
            <div style="text-align:center;"><img src="../img/livee.png"></img></div>
            <br>--------------------------------------------------------
            <div id="update">
            	<table style="text-align:left">
                    <?php
						include "../contents/update.php";
					?>
                </table>
            </div>
        </div>        
    </div>
</div>
    
<div id="foot">
    <div style="float:left">&nbsp;&nbsp;Copyright © 2012</div>
    <div style="float:right">
    	<a onClick="document.getElementById('contents_back').className='appear';document.getElementById('setting_').className='appear';set_province(<?php if(@!$province_id){echo 0;}echo @$province_id?>);set_city(<?php echo $weather_id?>);">Setting</a>&nbsp;|&nbsp;
        <a onClick="location.href='../index.php?pc=true';">PC</a>&nbsp;|&nbsp;
        <a onClick="document.getElementById('contents_back').className='appear';document.getElementById('about').className='appear';">About</a>&nbsp;&nbsp;
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
			location.reload();
		}
	</script>

</body>
</html>