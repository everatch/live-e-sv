<?php
if (isset($_GET['id'])){
	$id = $_GET['id'];
}else{
	$id = "l_kashiwanoha_h";
}

$url = 'http://www.live-e-sv.info/developers/api/xml/'.$id.'.xml';
$xml = simplexml_load_file($url);
$xml->asXML('data.xml');
?>