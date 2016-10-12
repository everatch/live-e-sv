<?php
function getData($sID) {
	include '../sensorlist.php';	//センサーリストを読み取る(sIDからsensorIdやsensorNameを取得)
	
	@$type["time_n"] = date("mdHi");	//時間を格納
	@$type["time"] = date("Y/m/d H:i:s");
	
	$cache_file = '../cache/'.$sID.'.php';
	if(!file_exists($cache_file)){
		touch( $cache_file );
		chmod( $cache_file, 0777);
	}else{
		include $cache_file;
		if($type["time_n"] - $type_["time_n"] < 10){
			return $type_;
		}
	}
	
	$to_cache = '<?php
	$'.'type_["time_n"] = '.$type["time_n"].';
	$'.'type_["time"] = "'.date("Y/m/d H:i:s").'";
	';
	
	$sensor = array("http://".$sensorId[$sID]."Temperature","http://".$sensorId[$sID]."Humidity","http://".$sensorId[$sID]."Pressure","http://".$sensorId[$sID]."RainFall","http://".$sensorId[$sID]."WindDir","http://".$sensorId[$sID]."WindSpeed",);
	
	// Prepare Keys
	$keys = array();
	for($i=0;$i<6;$i++){
		$keys[$i] = array("id"=>$sensor[$i], "attrName"=>"time", "select"=>"maximum");
	}
	// Generate Query, Header, and Transport for query
	$query=array("type"=>"storage", "id"=>uuid(), "key"=>$keys);
	$header=array("query"=>$query);
	$transport=array("header"=>$header); 
	$queryRQ=array("transport"=>$transport); 
	// Call an IEEE1888 Storage server
	// Specify the IP address of the SDK.
	$server = new SoapClient("http://live-e-storage.hongo.wide.ad.jp/axis2/services/FIAPStorage?wsdl");
	$queryRS = $server->query($queryRQ); 
	// Parse IEEE1888 FETCH-Response 1 (Error Handling)
	if($queryRS == NULL){
		echo "Error occured -- the result is empty.";
		exit;
	}
	if(($transport=$queryRS->transport) == NULL){
		echo "Error occured -- the transport in the result is empty.";
		exit;
	}
	if(($header=$transport->header) == NULL){
		echo "Error occured -- the header in the transport is empty.";
		exit;
	}
	if(@$header->OK == NULL){
		return "-";
		if($header->error == NULL){
			echo "Error occured -- neither OK nor error presented in the header.";
			exit;
		}
		echo "Error:".$header->error->_;
		exit;
	}
	
	$dataName = array('temp','humi','pres','rainFall','day_rainFall','windDir','Max_windDir','Min_windDir','windSpe','Max_windSpe','Min_windSpe','CO2','SolarPower','GlobalSolarRadiation');	//データの種類を配列に格納
	$type = array_flip ($dataName);	//配列名と格納されている内容を反転　ex.a[1]="me" ⇒ a['me']=1
	$j=0;
	
	// Parse IEEE1888 FETCH-Response 2 (Data Parsing, and Print out)
	if($transport->body != NULL){
		$point = $transport->body->point;
		for($i=0;$i<count($point);$i++){$id=$point[$i]->id;
		$value=$point[$i]->value;
		if( $value!=NULL ){
			$time=$value->time;
			$val=$value->_;
			//echo $id." ".$time."  ".$val."\n";
			$val = round((float)$val,2);	//小数点1ケタ
			
			if(!empty($val)){
				$type[$dataName[$j]] = $val;	//$dataに数値が存在するなら配列に入れる
				$j++;
			}else{
				$type[$dataName[$j]] = '---';	//$dataに数値が存在しないなら'---'を入れる
				$j++;
			}
		}
	}
}
for($k=0;$k<count($dataName);$k++){
	$to_cache = $to_cache.'
	$'.'type_["'.$dataName[$k].'"] = "'.$type[$dataName[$k]].'";';
}
	
	$to_cache = $to_cache.'
?>';
	$write_fp=@fopen($cache_file,"w");	//ファイルパスを格納
	@fputs($write_fp,$to_cache);	//文を書き込む
	fclose($write_fp);	//ファイルを閉じる
	return $type;	//配列を返す
}


function getAllData() {
	include '../sensorlist.php';	//センサーリストを読み取る(sIDからsensorIdやsensorNameを取得)
	
	function uuid(){
		return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
		mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff), mt_rand( 0, 0xffff ),
		mt_rand( 0, 0x0fff ) | 0x4000,
		mt_rand( 0, 0x3fff ) | 0x8000,
		mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff), mt_rand( 0, 0xffff ));
	}
		
		// Prepare Keys
		$keys = array();
		$num = 0;
		for($i=0;$i<count($sensorlist);$i++){
			$sID=$sensorlist[$i];
			$sensor = array("http://".$sensorId[$sID]."Temperature","http://".$sensorId[$sID]."Humidity","http://".$sensorId[$sID]."Pressure","http://".$sensorId[$sID]."RainFall","http://".$sensorId[$sID]."WindDir","http://".$sensorId[$sID]."WindSpeed",);
			for($j=0;$j<6;$j++){
				$keys[$num] = array("id"=>$sensor[$j], "attrName"=>"time", "select"=>"maximum");
				$num++;
			}
		}
		
		// Generate Query, Header, and Transport for query
		$query=array("type"=>"storage", "id"=>uuid(), "acceptableSize"=>count($keys)*2, "key"=>$keys);
		$header=array("query"=>$query);
		$transport=array("header"=>$header); 
		$queryRQ=array("transport"=>$transport); 
		// Call an IEEE1888 Storage server
		// Specify the IP address of the SDK.
		$server = new SoapClient("http://live-e-storage.hongo.wide.ad.jp/axis2/services/FIAPStorage?wsdl");
		$queryRS = $server->query($queryRQ); 
		// Parse IEEE1888 FETCH-Response 1 (Error Handling)
		if($queryRS == NULL){
			echo "Error occured -- the result is empty.";
			exit;
		}
		if(($transport=$queryRS->transport) == NULL){
			echo "Error occured -- the transport in the result is empty.";
			exit;
		}
		if(($header=$transport->header) == NULL){
			echo "Error occured -- the header in the transport is empty.";
			exit;
		}
		if($header->OK == NULL){
			if($header->error == NULL){
				echo "Error occured -- neither OK nor error presented in the header.";
				exit;
			}
			echo "Error:".$header->error->_;
			exit;
		}
		
		$dataName = array('temp','humi','pres','rainFall','windDir','windSpe');	//データの種類を配列に格納
		$l = 0;
		$m = 0;
		
		//$ex = $transport->body->point;
		//print_r($ex);
		
		// Parse IEEE1888 FETCH-Response 2 (Data Parsing, and Print out)
		if($transport->body != NULL){
			$point = $transport->body->point;
			for($k=0;$k<count($point);$k++){$id=$point[$k]->id;
			@$value=$point[$k]->value;
			if( $value!=NULL ){
				$time=$value->time;
				$val=$value->_;
				$val = round((float)$val,2);	//小数点1ケタ
				
				if(!empty($val)){
					$sID=$sensorlist[$m];
					$types[$sID][$dataName[$l]] = $val;	//$dataに数値が存在するなら配列に入れる
					$l++;
				}else{
					$sID=$sensorlist[$m];
					$types[$sID][$dataName[$l]] = '---';	//$dataに数値が存在しないなら'---'を入れる
					$l++;
				}
				if($l==6){
					$l=0;
					$m++;
				}

			}else{
					$sID=$sensorlist[$m];
					$types[$sID][$dataName[$l]] = '---';	//$dataに数値が存在しないなら'---'を入れる
					$l++;
					if($l==6){
						$l=0;
						$m++;
					}
				}
		}
	}
	return $types;	//配列を返す
}

?>
