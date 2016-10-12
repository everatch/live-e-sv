<!DOCTYPE HTML>

<html>
<head>
	<meta charset="utf-8">
    <?php
    include 'contents/head.php';
	
	include 'function.php';	//関数ファイルを読み取る（LiveEからデータを取得する関数含め
	
	$dataArray = getData($sensor);	//気象データを格納
	
	$url_now = $_SERVER["REQUEST_URI"];
	$content_now = "top.php";
	?>

	
    <link href="css/content_top.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/clock.js"></script>
	<title>live-E Sensor Viewer</title>

</head>

<?php include 'contents/top_body.php'; ?>

</html>
