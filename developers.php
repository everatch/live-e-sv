<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
    <?php
	include 'contents/head.php';
	$content_now = 'developers.php';
	?>
	
    <link href="css/content_developers.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/clock.js"></script>
    <script type="text/javascript" src="js/developers.js"></script>
	<title>Developers --- live-E Sensor Viewer</title>

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
				get_time();
			// -->
			</script>
<!----------------------bar----------------------->
<div id="bar">
	<div id="bar_">
    <!--------------------現在の言語＆言語リスト-------------------->
		<?php include ("contents/con_top_bar.php");?>
    </div>
</div>
<!----------------------header & menu----------------------->
<div id="header">
	<div id="logo">
    	<a href="index.php">
        	<?php include "contents/logo.php"; ?>
        </a>
	</div>
	<div id="l_menu">
		<?php
			include "contents/left_menu.php";
			show_left_menu("e",$lang,$sensor);
		?>
    </div>
</div>
<!----------------------content----------------------->
<div id="content">
<!----------------------content_top----------------------->
	<div id="content_developers" class="appear">
    	<?php include "developers/api_1.php"; ?>
    	<?php include "developers/api_2.php"; ?>
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