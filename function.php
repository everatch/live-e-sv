<?php
function getData($sID) {
	include 'sensorlist.php';	//センサーリストを読み取る(sIDからsensorIdやsensorNameを取得)
	
	@$type["time_n"] = date("mdHi");	//時間を格納
	@$type["time"] = date("Y/m/d H:i:s");
	
	$cache_file = 'cache/'.$sID.'.php';
	if(!file_exists($cache_file)){
		touch( $cache_file );
		chmod( $cache_file, 0777);
	}else{
		include $cache_file;
		if($type["time_n"] - $type_["time_n"] < 10){
			return $type_;
		}
	}
	
	@$to_cache = '<?php $'.'type_["time_n"] = '.$type["time_n"].'; $'.'type_["time"] = "'.date("Y/m/d H:i:s").'";
	';
	
	function uuid(){
		return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
		mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff), mt_rand( 0, 0xffff ),
		mt_rand( 0, 0x0fff ) | 0x4000,
		mt_rand( 0, 0x3fff ) | 0x8000,
		mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff), mt_rand( 0, 0xffff ));
	}
	
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
	//$server = new SoapClient("http://fiap-dev.gutp.ic.i.u-tokyo.ac.jp/axis2/services/FIAPStorage?wsdl");
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
	include 'sensorlist.php';	//センサーリストを読み取る(sIDからsensorIdやsensorNameを取得)
	
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
		//$server = new SoapClient("http://fiap-dev.gutp.ic.i.u-tokyo.ac.jp/axis2/services/FIAPStorage?wsdl");
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
function getTimeData($sID,$types,$s_year,$s_month,$s_day,$s_hour,$s_minute,$s_second,$e_year,$e_month,$e_day,$e_hour,$e_minute,$e_second) {
	include 'sensorlist.php';	//センサーリストを読み取る(sIDからsensorIdやsensorNameを取得)
	
	$key = array();
	$serise = array();
	$serise_time = array();
	
	$server = new SoapClient("http://live-e-storage.hongo.wide.ad.jp/axis2/services/FIAPStorage?wsdl");
	//$server = new SoapClient("http://fiap-dev.gutp.ic.i.u-tokyo.ac.jp/axis2/services/FIAPStorage?wsdl");
	
	function uuid(){
		return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
		mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff), mt_rand( 0, 0xffff ),
		mt_rand( 0, 0x0fff ) | 0x4000,
		mt_rand( 0, 0x3fff ) | 0x8000,
		mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff), mt_rand( 0, 0xffff ));
	}
	
	$start_time = $s_year."-".$s_month."-".$s_day."T".$s_hour.":".$s_minute.":".$s_second;
	$to_time = $s_year."-".$s_month."-".$s_day."T".$s_hour.":".$s_minute.":".$s_second;
	$end_time = $e_year."-".$e_month."-".$e_day."T".$e_hour.":".$e_minute.":".$e_second;
	
	$sum_time = (strtotime($end_time) - strtotime($start_time)) / 60;
	$div_time = round($sum_time / 100);
					
	while(strtotime($to_time) <= strtotime($end_time)){
		$start_time = $to_time;
		
		$plus_time = $to_time." +".$div_time." minutes";
		$to_time = date('Y-m-d', strtotime($plus_time))."T".date('H:i:s', strtotime($plus_time));
		
		$start = $start_time.".0000000+09:00";
		$end = $to_time.".0000000+09:00";
		
		for($i=0;$i<count($sID);$i++){
			$sensor = "http://".$sensorId[$sID[$i]].$types;
	
			$key[$i]=array("id"=>$sensor, "attrName"=>"time", "gteq"=>$start, "lt"  =>$end, "select" =>"minimum" );
		}
		 
		for($secount=0;$secount<count($sID);$secount++){
			$datacount = 0;
			$serise[$secount] = array();
			$serise_time[$secount] = array();
			// Iteratively Retrieve Data and Print Out by FETCH protocol 
			$cursor=NULL;
			do{ 
				$query=array("type"=>"storage", "id"=>uuid(), "acceptableSize"=>"100", "key"=>$key[$secount]);
				if($cursor!=NULL){
			 		$query["cursor"]=$cursor;
		  		}
				$header=array("query"=>$query);
				$transport=array("header"=>$header);
				$queryRQ=array("transport"=>$transport); 
				$queryRS=$server->query($queryRQ);
		
				$transport=$queryRS->transport;
				if($transport->header->OK!=NULL){
					$point=$transport->body->point;
					for($i=0;$i<count($point);$i++){
						if(count($point)==1){
							$id=$point->id;
							$value=@$point->value;
							if(!@$point->value){
								$value=" ";
							}
						}else{
							$id=$point[$i]->id;
							$value=$point[$i]->value;
						}
						for($j=0;$j<count($value);$j++){
							if(count($value)==1){
								$time=@$value->time;
								$val=@$value->_;
							}else{
								$time=$value[$j]->time;
								$val=$value[$j]->_;
							}
							$serise[$secount][$datacount] = round($val,2);
							$serise_time[$secount][$datacount] = substr($time, 0, 10)." ".substr($time, 11, 5);
							$datacount++;
						}
					}
					if(array_key_exists("cursor",$transport->header->query)){
						$cursor=$transport->header->query->cursor;
					}else{
						$cursor=NULL;
					}
				}else if($transport->header->error!=NULL){
					echo $transport->header->error->_;
					exit(0);
				} 
			}while($cursor!=NULL); 
			echo "\n";
		}
		for($i=0;$i<count($serise[0]);$i++){
			if($serise_time[0][$i] != @$serise_time[0][$i-1]){
				if($serise_time[0][$i] != 0){
					echo "['".$serise_time[0][$i]."'";
					for($j=0;$j<count($sID);$j++){
						echo ",".$serise[$j][$i];
					}
					echo "],\n";
				}
			}
		}
	}
}
?>
