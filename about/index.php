<!DOCTYPE HTML>

<html>
<head>
	<meta charset="utf-8">
    
    <?php
    include 'contents/head.php';
	
	$url_now = $_SERVER["REQUEST_URI"];
	$content_now = "about.php";
	?>

	
    <link href="css/content_about.css" rel="stylesheet" type="text/css">
	<title>About us --- live-E Sensor Viewer</title>

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
			show_left_menu("d",$lang,$sensor);
		?>
    </div>
</div>
<!----------------------content----------------------->
<div id="content">
<!----------------------content_about----------------------->
	<div id="content_about" class="appear">
    	<div id="hs_info" class="radius">
			<div id="hs_pic">
        		<a href="img/Kashiwanoha-HighSchool_l.JPG" target="_blank">
					<img class="img" src="img/Kashiwanoha-HighSchool.JPG" width=80% height=80% border="none"></img>
            	</a>
                <br/><br/>
            	<?php
					echo $lang_school;
				?>
   			</div>
            <br>--------------------------------------------------------
            	<h2 style="text-align:left; padding-left:23px;">Updates:</h2>
            <div id="update">
            	<table>
                    <?php
						include "contents/update.php";
					?>
                </table>
            </div>
            <br>--------------------------------------------------------
            	<h2 style="text-align:left; padding-left:23px;">License Info:</h2>
            <div id="license">
            ・<a href="http://jquery.com/" target="_blank">Copyright 2013 jQuery Foundation and other contributors</a></br>
            ・<a href="https://developers.google.com/maps/documentation/javascript/tutorial" target="_blank">Google Maps JavaScript API v3</a></br>
            ・<a href="https://developers.google.com/chart/terms" target="_blank">Google Chart Tools</a></br>
            ・<a href="http://www.gutp.jp/fiap/kit.html" target="_blank">IEEE 1888</a></br>
            ・<a href="about:blank" target="_blank">Live E! SOAPインタフェース</a>
            </div>
        </div>
		<div id="mem_info" class="radius">
                <div onClick="window.open('http://www.live-e.org/');" style="cursor:pointer; padding:10px 0px;">
                	<img src="img/livee.png" width=110px height=110px border="none" style="padding:5px 20px"></img>
                    </br>
                    <div class="info_t">
                		Live E!
                    </div>
                    <div class="info">
                    	</br>&nbsp;&nbsp;広義の地球(Earth)に関する生きた(Live)環境(Environment)情報が自由に流通し共有される電子(Electronics)情報基盤を形成発展させ、自律的で自由な環境情報の利用法、安心安全で効率性の高い活動空間（＝環境）の創造を目指す。
                    </div>
                </div>
                <div onClick="window.open('https://www.facebook.com/reo.nakayama.5');" style="cursor:pointer; padding:10px 0px;">
                	<img src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-ash3/c29.29.369.369/s160x160/561862_191633770970882_80081095_n.jpg" width=110px height=110px border="none" style="padding:5px 20px"></img>
                	</br>
                    <div class="info_t">
                    	Reo Nakayama
                    </div>
                    <div class="info">
                    	</br>Sensor Viewer制作
                    </div>
                </div>
                <div class="info_t" style="text-align:center; padding:30px 0 15px 0;">- -- --- -- Banner -- --- -- -</div>
                <div class="info" onClick="window.open('http://cis.kashiwanoha.ed.jp/');" style="text-align:center; cursor:pointer;">
                	<img src="http://saas01.netcommons.net/kashiwanoha/htdocs/?action=common_download_main&upload_id=19836"></img>
                    <br/>千葉県立柏の葉高校 情報理数科
                </div>
                <br/>
                <div class="info" onClick="window.open('http://www.live-e.org/');" style="text-align:center; cursor:pointer;">
                	<img src="http://www.live-e.org/img/common/logo.gif" width="150px" height="50px"></img>
                    <br/>Live E!プロジェクト
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
