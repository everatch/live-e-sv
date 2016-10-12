<?php
function getData($sID) {
	
	$url = ("http://live-e2.hongo.wide.ad.jp/localsensorlist.php");	//URL（データ源）を格納
	
	@$source = file_get_contents($url);	//ページのソースを格納
	
	if(!$source){
		/*タイムアウトやソースが上手く読み取らない場合は"---"を返す*/
		
		for($j=0;$j<12;$j++){
			$type[$dataName[$j]] = '---';	//$dataに数値が存在しないなら'---'を入れる
		}
		return $type;	//配列を返す
		
	}

	$index = strpos ($source, $sID);	//センサーの名前で検索、データの位置情報を格納

	for($i=0;$i<15;$i++) {
		$getSource[$i] = mb_substr($source, $index + 310 + 220 * $i, 230, 'utf-8');	//データを15個に分割
	}
	$dataName = array('temp','humi','pres','rainFall','day_rainFall','windDir','Max_windDir','Min_windDir','windSpe','Max_windSpe','Min_windSpe','CO2','SolarPower','GlobalSolarRadiation');	//データの種類を配列に格納
	$type = array_flip ($dataName);	//配列名と格納されている内容を反転　ex.a[1]="me" ⇒ a['me']=1

	for($j=0;$j<12;$j++){

		$pattern = '/<big><big>(\d*|\d*\.\d*)<\/big><\/big>/'; //正規表現
		preg_match($pattern,$getSource[$j],$matches);	//正規表現でソースからタグを除いたデータ部分を取り出す　$matches[0]:文字列　$matches[0]:数字
		
		if( isset($matches[1])) {
			$data = $matches[1];	//数値が存在するなら$dataに格納
		}
		if(!empty($data)){
			$type[$dataName[$j]] = $data;	//$dataに数値が存在するなら配列に入れる
		}else{
			$type[$dataName[$j]] = '---';	//$dataに数値が存在しないなら'---'を入れる
		}
	}
	return $type;	//配列を返す
}

?>
