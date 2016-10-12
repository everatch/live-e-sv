    <meta property="og:title" content="Live E! Sensor Viewer"/>
	<meta property="og:description" content="Live E! Sensor Viewer とは、LiveE!プロジェクトが所有しているセンサーから環境情報を取得し、一般公開及び情報を活用したサービスを提供。"/>
    <meta property="og:image" content="http://www.live-e-sv.info/img/preview.png" />
	<meta property="og:url" content="http://www.live-e-sv.info/"/>
	<meta property="og:type" content="website"/>
	<meta property="og:site_name" content="Live E! Sensor Viewer"/>
    
    <link rel="apple-touch-icon" href="http://www.live-e-sv.info/img/preview_mobile.png" />
    
    <meta name="keywords" content="sensor viewer,senser,live-e,live-e-sv,センサー,柏の葉高校,高大連携" />
    <meta name="description" content="Live E! Sensor Viewer とは、LiveE!プロジェクトが所有しているセンサーから環境情報を取得し、一般公開及び情報を活用したサービスを提供。"/>
    
    <script type="text/javascript">  
		if (navigator.userAgent.indexOf('iPhone') != -1 || navigator.userAgent.indexOf('Android') > 0) {  
			<?php
				/*if (isset($_GET['sID']) && isset($_GET['lang'])){
					echo 'document.location = "mobile/index.php?sID='.$_GET['sID'].'&lang='.$_GET['lang'].'";';
				}else if (isset($_GET['sID'])){
					echo 'document.location = "mobile/index.php?sID='.$_GET['sID'].'";';
				}else if (isset($_GET['lang'])){
					echo 'document.location = "mobile/index.php?lang='.$_GET['lang'].'";';
				}else{
					
				}*/
				if (isset($_GET['pc']) || isset($_COOKIE['pc'])){
					if(@$_COOKIE['pc'] == 'true'){
					}
					if(@$_COOKIE['pc'] == 'false'){
						echo 'document.location = "mobile/index.php";';
					}
				}else{
					echo 'document.location = "mobile/index.php";';
				}
			?>
		}
	</script>
    
<?php
	if(@$_COOKIE["lang"] || @$_COOKIE["sID"]){
		if(@$_COOKIE["lang"]){		
			$lang = $_COOKIE["lang"];
		}
		if(@$_COOKIE["sID"]){
			$sensor = $_COOKIE["sID"];
		}
	}
	if(@$_COOKIE["style"]){		
		$style = $_COOKIE["style"];
		echo '<link href="templates/'.$style.'/style.css" rel="stylesheet" type="text/css">';
	}
	
	$ua = $_SERVER['HTTP_USER_AGENT'];
	if ((@ereg("iPhone",$ua)) || (@ereg("iPod",$ua))){
		echo '<link href="css/style_mobile.css" rel="stylesheet" type="text/css">';
		echo '<meta name="viewport" content="width=1024px" />';
	}
		/* animation未対応のブラウザの処理 */
		/* js/javascript.js | style.css アニメーションあり*/
		/* js/javascript_static.js | style_static.css アニメーションなし*/
	    $Agent = getenv( "HTTP_USER_AGENT" );
	    if( mb_ereg( "MSIE", $Agent ) ){ 
			echo '<link href="css/style_static.css" rel="stylesheet" type="text/css">';
			echo '<script type="text/javascript" src="js/javascript_static.js"></script>';
	    } elseif( mb_ereg( "Firefox", $Agent ) ) {
			echo '<link href="css/style_static.css" rel="stylesheet" type="text/css">';
			echo '<script type="text/javascript" src="js/javascript_static.js"></script>';
	    } elseif( mb_ereg( "Safari", $Agent ) ) {
			echo '<link href="css/styles.css" rel="stylesheet" type="text/css">';
			echo '<script type="text/javascript" src="js/javascript.js"></script>';
	    } elseif( mb_ereg( "Chrome", $Agent ) ) {
			echo '<link href="css/styles.css" rel="stylesheet" type="text/css">';
			echo '<script type="text/javascript" src="js/javascript.js"></script>';
	    } else {
			echo '<link href="css/style_static.css" rel="stylesheet" type="text/css">';
			echo '<script type="text/javascript" src="js/javascript_static.js"></script>';
	    }
   
	/*URLから引数を取得*/
	// [sID]センサーの変数
	if (!@$sensor && isset($_GET['sID'])){
		$sensor = $_GET['sID'];
	}else if(!@$sensor){
		$sensor = "l_kashiwanoha_h";
	}
	// [lang]言語
	if (!@$lang && isset($_GET['lang'])){
		$lang = $_GET['lang'];
	}else if(!@$lang){
		$lang = 'jp';
	}
	
	if($lang == "jp"){
		echo '<meta http-equiv="content-language" content="ja">';
	}else if($lang == "kr"){
		echo '<meta http-equiv="content-language" content="ko">';
	}else if($lang == "en"){
		echo '<meta http-equiv="content-language" content="en">';
	}else if($lang == "sc"){
		echo '<meta http-equiv="content-language" content="zh">';
	}
	
	/*言語ごとにフォントを変える*/
	echo '<style type="text/css">';
	if($lang == "jp"){
		echo 'body {font-family : "ＨＧゴシックＥ", "ＭＳ ゴシック", "MS Gothic", "Osaka－等幅", Osaka-mono, monospace;}';
	}else if($lang == "en"){
		echo 'body {font-family : Verdana, Geneva, sans-serif;}';
		echo 'h {font-family: "Times New Roman", Times, serif;}';
		echo 'ul {font-family: "Times New Roman", Times, serif;}';
	}else if($lang == "kr"){
		echo 'body {font-family : Tahoma, Geneva, sans-serif;}';
		echo 'h {font-family: "Times New Roman", Times, serif;}';
	}else if($lang == "sc"){
		echo 'body {font-family : "宋体", NSimSun, Hei, sans-serif;}';
		echo 'h {font-family: "Times New Roman", Times, serif;}';
	}else{
		echo 'body {font-family : "ＨＧゴシックＥ", "ＭＳ ゴシック", "MS Gothic", "Osaka－等幅", Osaka-mono, monospace;}';
	}
	echo '</style>';
	
	include 'lang/'.$lang.'.php';	//言語ファイルを読み取る
	include 'sensorlist.php';	//センサーリストを取得
?>
<script type="text/javascript" src="js/cookie.js"></script>