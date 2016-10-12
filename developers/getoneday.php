<?php
	//include(dirname(__FILE__) . "sensorlist.php");
	//include(dirname(__FILE__) . "function.php");
	include("../sensorlist.php");
	include("../function.php");
	
	//$phpfile_name = dirname(__FILE__) . '/../httpdocs/developers/api/php/sensors.php';
	//$jsfile_name = dirname(__FILE__) . '/../httpdocs/developers/api/js/sensors.js';
	$phpfile_name = './api/php/sensors.php';
	$jsfile_name = './api/js/sensors.js';
	if(!file_exists($phpfile_name)){
		touch( $phpfile_name );
		chmod( $phpfile_name, 0777);
		$phpout = '<?php
';
			
		for($i=0;$i<count($sensorlist);$i++){
			for($j=0;$j<24;$j++){
				$phpout = $phpout.'$'.'data["'.$sensorlist[$i].'"]['.$j.'] = array("0000-00-00 00:00:00","00","00","0000","000","0","0");
';			}
		}
	$phpout = $phpout.'?>';
	$write_fp=@fopen($phpfile_name,"w");	//ファイルパスを格納
		@fputs($write_fp,$phpout);	//文を書き込む
		fclose($write_fp);	//ファイルを閉じる
	}
	if(!file_exists($jsfile_name)){
		touch( $jsfile_name );
		chmod( $jsfile_name, 0777);
		$jsout = 'new Array();
';
			
		for($i=0;$i<count($sensorlist);$i++){
			$jsout = $jsout.'data["'.$sensorlist[$i].'"] = [
	["0000-00-00 00:00:00","00","00","0000","000","0","0"],
	["0000-00-00 00:00:00","00","00","0000","000","0","0"],
	["0000-00-00 00:00:00","00","00","0000","000","0","0"],
	["0000-00-00 00:00:00","00","00","0000","000","0","0"],
	["0000-00-00 00:00:00","00","00","0000","000","0","0"],
	["0000-00-00 00:00:00","00","00","0000","000","0","0"],
	["0000-00-00 00:00:00","00","00","0000","000","0","0"],
	["0000-00-00 00:00:00","00","00","0000","000","0","0"],
	["0000-00-00 00:00:00","00","00","0000","000","0","0"],
	["0000-00-00 00:00:00","00","00","0000","000","0","0"],
	["0000-00-00 00:00:00","00","00","0000","000","0","0"],
	["0000-00-00 00:00:00","00","00","0000","000","0","0"],
	["0000-00-00 00:00:00","00","00","0000","000","0","0"],
	["0000-00-00 00:00:00","00","00","0000","000","0","0"],
	["0000-00-00 00:00:00","00","00","0000","000","0","0"],
	["0000-00-00 00:00:00","00","00","0000","000","0","0"],
	["0000-00-00 00:00:00","00","00","0000","000","0","0"],
	["0000-00-00 00:00:00","00","00","0000","000","0","0"],
	["0000-00-00 00:00:00","00","00","0000","000","0","0"],
	["0000-00-00 00:00:00","00","00","0000","000","0","0"],
	["0000-00-00 00:00:00","00","00","0000","000","0","0"],
	["0000-00-00 00:00:00","00","00","0000","000","0","0"],
	["0000-00-00 00:00:00","00","00","0000","000","0","0"],
	["0000-00-00 00:00:00","00","00","0000","000","0","0"],
];
';
		}
	$write_fp=@fopen($jsfile_name,"w");	//ファイルパスを格納
		@fputs($write_fp,$jsout);	//文を書き込む
		fclose($write_fp);	//ファイルを閉じる
	}
	
	include ($phpfile_name);
	$to_php = '<?php
';
	$to_js = 'data = new Array();
';
	
	$alldata = getAllData();
	
	@$now_time = date("Y-m-d H:i:s");	//時間を格納
	
	for($i=0;$i<count($sensorlist);$i++){
		$to_js = $to_js.'data["'.$sensorlist[$i].'"] = [';
		
		$sensors_data = '
	["'.$now_time.'","'.$alldata[$sensorlist[$i]]["temp"].'","'.$alldata[$sensorlist[$i]]["humi"].'","'.$alldata[$sensorlist[$i]]["pres"].'","'.$alldata[$sensorlist[$i]]["rainFall"].'","'.$alldata[$sensorlist[$i]]["windDir"].'","'.$alldata[$sensorlist[$i]]["windSpe"].'"],';
		
		$to_js = $to_js.$sensors_data;
		$to_php = $to_php."
	$"."data['".$sensorlist[$i]."'][0] = '".$sensors_data."';";
		
		include $phpfile_name;
		
		for($j=0;$j<23;$j++){
			$sensors_data = $data[$sensorlist[$i]][$j];
			$to_js = $to_js.$sensors_data;
			$to_php = $to_php."
	$"."data['".$sensorlist[$i]."'][".($j+1)."] = '".$sensors_data."';";
		}
		$to_js = $to_js.'
];

';
	}
	$to_php = $to_php.'
	?>';
	
	$write_fp=@fopen($jsfile_name,"w");	//ファイルパスを格納
	@fputs($write_fp,$to_js);	//文を書き込む
	fclose($write_fp);	//ファイルを閉じる

	$write_fp=@fopen($phpfile_name,"w");	//ファイルパスを格納
	@fputs($write_fp,$to_php);	//文を書き込む
	fclose($write_fp);	//ファイルを閉じる
?>