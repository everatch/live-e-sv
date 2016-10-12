<?php
require_once('twitteroauth.php');
require_once('function.php');

$dataArray = getData('Chiba Prefectural Kashiwanoha Senior HighSchool');	//気象データを格納

$consumerKey = "q6swKkTrlnYYO4zOLwadmw";
$consumerSecret = "DLgEWFbbM47XhqIwsxFsPx5mqYW3j1W4lBoN0yRQ";
$accessToken = "702538339-IZnP82lQZWD9EXPCHAn8TSUxSDyFXViBRds680IZ";
$accessTokenSecret = "kDaMOcCqXegXa9jfCIxbWO3qJ202ijNL5CPNIFtnANk";

// OAuthオブジェクトの生成
$twObj = new TwitterOAuth($consumerKey,$consumerSecret,$accessToken,$accessTokenSecret);

if($dataArray['temp'] < 1){
	$comment = "とても寒いですね！！川も凍っているかもしれません、防寒対策は万全にしましょう！";
}else if($dataArray['temp'] < 15){
	$comment = "外は寒いです、暖かい服装でお出かけしましょう！";
}else if($dataArray['temp'] < 22){
	if($dataArray['rainFall'] == 0){
		$comment = "涼しいでしょう、外で遊べる絶好のチャンスです！";
	}else{
		$comment = "涼しいでしょう、雨が降っているので室内で遊びましょう！";
	}
}else if($dataArray['temp'] < 35){
	if($dataArray['humi'] < 70){
		$comment = "暑い！涼しい服装でお出かけしましょう！";
	}else{
		$comment = "蒸し暑いです！湿度も高いので、除湿をしましょう！";
	}
}else if($dataArray['temp'] > 35){
	$comment = "猛暑ですよ！暑さ対策をしっかり！熱中症を防ぐために、水分補給をこまめにしましょう！";
}

if($dataArray['humi'] < 30){
	$comment_1 = "　湿度も低いようです、乾燥やインフルエンザにはご注意を！";
}else{
	$comment_1 = " ";
}

if($dataArray['rainFall'] == 0){
	$comment_2 = " ";
}else if($dataArray['rainFall'] < 10){
	$comment_2 = "　雨がぽつぽつと降っていますね、お出かけには傘をお持ちしましょう！";
}else if($dataArray['rainFall'] < 20){
	$comment_2 = "　雨がザーザーと降っていますね、お出かけには傘をお持ちしましょう！";
}else if($dataArray['rainFall'] < 30){
	$comment_2 = "　雨が土砂降りですね、傘をさしても濡れますので、外出にはご注意を！";
}else if($dataArray['rainFall'] < 50){
	$comment_2 = "　バケツをひっくり返したような雨です、傘をさしても濡れますので、外出にはご注意を！";
}else if($dataArray['rainFall'] < 80){
	$comment_2 = "　滝のような雨が降っています、車の運転も危険です、お出かけは控えましょう！";
}else if($dataArray['rainFall'] >= 80){
	$comment_2 = "　猛烈な雨が降っています、災害が発生する恐れがあります、厳重に警戒をしてください！";
}

if($dataArray['windSpe'] > 15){
	$comment_3 = "　風も強いようです、お出かけにはご注意を！";
}else if($dataArray['windSpe'] > 10){
	$comment_3 = "　風もやや強いようです、お出かけにはご注意を！";
}else{
	$comment_3 = " ";
}

if($dataArray['pres'] < 999 && $dataArray['windSpe'] > 18){
	$comment = "　台風が来ているかもしれません、気象情報をこまめにチェックしてください。";
}else if($dataArray['pres'] < 999 && $dataArray['windSpe'] > 44){
	$comment = "　台風が非常に強いです、お出かけ控えましょう！";
}else if($dataArray['pres'] < 999 && $dataArray['windSpe'] > 54){
	$comment = "　猛烈な台風が近づいてます、外出はやめましょう！";
}else{
	$comment = $comment.$comment_1.$comment_2.$comment_3;	
}

@$dates = date("[H:i]");	//時間を格納

$message = $dates."　　気温：".$dataArray['temp']." ℃　　湿度：".$dataArray['humi']." %　　気圧：".$dataArray['pres']." Pa　　雨量：".$dataArray['rainFall']." mm/h　　風向：".$dataArray['windDir']." °　風速：".$dataArray['windSpe']." m/s　[---comment---]　".$comment;

$vRequest = $twObj->OAuthRequest("https://api.twitter.com/1/statuses/update.xml","POST",array("status"=>$message));

header("Content-Type: application/xml");
echo $vRequest;

?>