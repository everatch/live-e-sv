
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="test.css">

<title>ページのタイトル</title>

</head>
<body>

<!-- コンテナ開始 -->
<div id="container">
<div id="containerInner">


<!-- ヘッダ開始 -->
<div id="header">
［ヘッダ］
</div>
<!-- ヘッダ終了 -->


<!-- メニューバー -->

<div id="menu">
<A Href="http://www.yahoo.co.jp/">グラフ</A>
　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　
<A Href="http://www.yahoo.co.jp/">グラフ</A>
　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　
<A Href="http://www.yahoo.co.jp/">グラフ</A>
</div>

<!-- menu終了 -->


<!-- ナビゲーション開始 -->
<div id="nav">
［左サイドバー］
</div>
<!-- ナビゲーション終了 -->

<!-- メインカラム開始 -->
<div id="content">



<div id="contentInner">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title>Google Maps API3 Sample</title>
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
window.onload = function() {
var map = new google.maps.Map(document.getElementById("map_canvas"), {
zoom : 5,
center : new google.maps.LatLng(37, 136),
mapTypeId : google.maps.MapTypeId.ROADMAP
});
}
//]]>
</script>
</head>
<body>
<div id="map_canvas" style="width: 500px; height: 400px"></div>
</body>
</div>

</div>
<!-- メインカラム終了 -->

<!-- サブナビゲーション開始 -->
<div id="aside">
［右サイドバー］
</div>
<!-- サブナビゲーション終了 -->

<!-- フッタ開始 -->
<div id="footer">
［フッタ］
</div>
<!-- フッタ終了 -->


</div>
</div>
<!-- コンテナ終了 -->

</body>
</html>

