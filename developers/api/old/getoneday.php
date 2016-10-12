<?php
	include(dirname(__FILE__) . "/../httpdocs/sensorlist.php");
	include(dirname(__FILE__) . "/../httpdocs/function.php");
	
	$alldata = getAllData();
	
	@$now_time = date("Y-m-d H:i:s");	//時間を格納
	
	for($i=0;$i<count($sensorlist);$i++){
		$xmlfile_name = dirname(__FILE__) . '/../httpdocs/developers/api/xml/'.$sensorlist[$i].'.xml';
		if(!file_exists($xmlfile_name)){
			touch( $xmlfile_name );
			chmod( $xmlfile_name, 0777);
		}
		
		$phpfile_name = dirname(__FILE__) . '/../httpdocs/developers/api/php/'.$sensorlist[$i].'.php';
		if(!file_exists($phpfile_name)){
			touch( $phpfile_name );
			chmod( $phpfile_name, 0777);
			$new_php = "<?php
$"."data = array('
	<sensor>
		<time>0000-00-00 00:00:00</time>
	　　<temp>---</temp>
	　　<humi>---</humi>
	　　<pres>---</pres>
	　　<rainfall>---</rainfall>
	　　<winddir>---</winddir>
	　　<windspe>---</windspe>
	</sensor>','
	<sensor>
		<time>0000-00-00 00:00:00</time>
	　　<temp>---</temp>
	　　<humi>---</humi>
	　　<pres>---</pres>
	　　<rainfall>---</rainfall>
	　　<winddir>---</winddir>
	　　<windspe>---</windspe>
	</sensor>','
	<sensor>
		<time>0000-00-00 00:00:00</time>
	　　<temp>---</temp>
	　　<humi>---</humi>
	　　<pres>---</pres>
	　　<rainfall>---</rainfall>
	　　<winddir>---</winddir>
	　　<windspe>---</windspe>
	</sensor>','
	<sensor>
		<time>0000-00-00 00:00:00</time>
	　　<temp>---</temp>
	　　<humi>---</humi>
	　　<pres>---</pres>
	　　<rainfall>---</rainfall>
	　　<winddir>---</winddir>
	　　<windspe>---</windspe>
	</sensor>','
	<sensor>
		<time>0000-00-00 00:00:00</time>
	　　<temp>---</temp>
	　　<humi>---</humi>
	　　<pres>---</pres>
	　　<rainfall>---</rainfall>
	　　<winddir>---</winddir>
	　　<windspe>---</windspe>
	</sensor>','
	<sensor>
		<time>0000-00-00 00:00:00</time>
	　　<temp>---</temp>
	　　<humi>---</humi>
	　　<pres>---</pres>
	　　<rainfall>---</rainfall>
	　　<winddir>---</winddir>
	　　<windspe>---</windspe>
	</sensor>','
	<sensor>
		<time>0000-00-00 00:00:00</time>
	　　<temp>---</temp>
	　　<humi>---</humi>
	　　<pres>---</pres>
	　　<rainfall>---</rainfall>
	　　<winddir>---</winddir>
	　　<windspe>---</windspe>
	</sensor>','
	<sensor>
		<time>0000-00-00 00:00:00</time>
	　　<temp>---</temp>
	　　<humi>---</humi>
	　　<pres>---</pres>
	　　<rainfall>---</rainfall>
	　　<winddir>---</winddir>
	　　<windspe>---</windspe>
	</sensor>','
	<sensor>
		<time>0000-00-00 00:00:00</time>
	　　<temp>---</temp>
	　　<humi>---</humi>
	　　<pres>---</pres>
	　　<rainfall>---</rainfall>
	　　<winddir>---</winddir>
	　　<windspe>---</windspe>
	</sensor>','
	<sensor>
		<time>0000-00-00 00:00:00</time>
	　　<temp>---</temp>
	　　<humi>---</humi>
	　　<pres>---</pres>
	　　<rainfall>---</rainfall>
	　　<winddir>---</winddir>
	　　<windspe>---</windspe>
	</sensor>','
	<sensor>
		<time>0000-00-00 00:00:00</time>
	　　<temp>---</temp>
	　　<humi>---</humi>
	　　<pres>---</pres>
	　　<rainfall>---</rainfall>
	　　<winddir>---</winddir>
	　　<windspe>---</windspe>
	</sensor>','
	<sensor>
		<time>0000-00-00 00:00:00</time>
	　　<temp>---</temp>
	　　<humi>---</humi>
	　　<pres>---</pres>
	　　<rainfall>---</rainfall>
	　　<winddir>---</winddir>
	　　<windspe>---</windspe>
	</sensor>','
	<sensor>
		<time>0000-00-00 00:00:00</time>
	　　<temp>---</temp>
	　　<humi>---</humi>
	　　<pres>---</pres>
	　　<rainfall>---</rainfall>
	　　<winddir>---</winddir>
	　　<windspe>---</windspe>
	</sensor>','
	<sensor>
		<time>0000-00-00 00:00:00</time>
	　　<temp>---</temp>
	　　<humi>---</humi>
	　　<pres>---</pres>
	　　<rainfall>---</rainfall>
	　　<winddir>---</winddir>
	　　<windspe>---</windspe>
	</sensor>','
	<sensor>
		<time>0000-00-00 00:00:00</time>
	　　<temp>---</temp>
	　　<humi>---</humi>
	　　<pres>---</pres>
	　　<rainfall>---</rainfall>
	　　<winddir>---</winddir>
	　　<windspe>---</windspe>
	</sensor>','
	<sensor>
		<time>0000-00-00 00:00:00</time>
	　　<temp>---</temp>
	　　<humi>---</humi>
	　　<pres>---</pres>
	　　<rainfall>---</rainfall>
	　　<winddir>---</winddir>
	　　<windspe>---</windspe>
	</sensor>','
	<sensor>
		<time>0000-00-00 00:00:00</time>
	　　<temp>---</temp>
	　　<humi>---</humi>
	　　<pres>---</pres>
	　　<rainfall>---</rainfall>
	　　<winddir>---</winddir>
	　　<windspe>---</windspe>
	</sensor>','
	<sensor>
		<time>0000-00-00 00:00:00</time>
	　　<temp>---</temp>
	　　<humi>---</humi>
	　　<pres>---</pres>
	　　<rainfall>---</rainfall>
	　　<winddir>---</winddir>
	　　<windspe>---</windspe>
	</sensor>','
	<sensor>
		<time>0000-00-00 00:00:00</time>
	　　<temp>---</temp>
	　　<humi>---</humi>
	　　<pres>---</pres>
	　　<rainfall>---</rainfall>
	　　<winddir>---</winddir>
	　　<windspe>---</windspe>
	</sensor>','
	<sensor>
		<time>0000-00-00 00:00:00</time>
	　　<temp>---</temp>
	　　<humi>---</humi>
	　　<pres>---</pres>
	　　<rainfall>---</rainfall>
	　　<winddir>---</winddir>
	　　<windspe>---</windspe>
	</sensor>','
	<sensor>
		<time>0000-00-00 00:00:00</time>
	　　<temp>---</temp>
	　　<humi>---</humi>
	　　<pres>---</pres>
	　　<rainfall>---</rainfall>
	　　<winddir>---</winddir>
	　　<windspe>---</windspe>
	</sensor>','
	<sensor>
		<time>0000-00-00 00:00:00</time>
	　　<temp>---</temp>
	　　<humi>---</humi>
	　　<pres>---</pres>
	　　<rainfall>---</rainfall>
	　　<winddir>---</winddir>
	　　<windspe>---</windspe>
	</sensor>','
	<sensor>
		<time>0000-00-00 00:00:00</time>
	　　<temp>---</temp>
	　　<humi>---</humi>
	　　<pres>---</pres>
	　　<rainfall>---</rainfall>
	　　<winddir>---</winddir>
	　　<windspe>---</windspe>
	</sensor>','
	<sensor>
		<time>0000-00-00 00:00:00</time>
	　　<temp>---</temp>
	　　<humi>---</humi>
	　　<pres>---</pres>
	　　<rainfall>---</rainfall>
	　　<winddir>---</winddir>
	　　<windspe>---</windspe>
	</sensor>');
?>";	//文を格納
			$write_fp=@fopen($phpfile_name,"w");	//ファイルパスを格納
			@fputs($write_fp,$new_php);	//エラー文を書き込む
			fclose($write_fp);	//ファイルを閉じる
		}
		
		$sensors_data = '　<sensor>
		<time>'.$now_time.'</time>
	　　<temp>'.$alldata[$sensorlist[$i]]["temp"].'</temp>
	　　<humi>'.$alldata[$sensorlist[$i]]["humi"].'</humi>
	　　<pres>'.$alldata[$sensorlist[$i]]["pres"].'</pres>
	　　<rainfall>'.$alldata[$sensorlist[$i]]["rainFall"].'</rainfall>
	　　<winddir>'.$alldata[$sensorlist[$i]]["windDir"].'</winddir>
	　　<windspe>'.$alldata[$sensorlist[$i]]["windSpe"].'</windspe>
	　</sensor>';
		
		$xml_php = $sensors_data;
		
		include $phpfile_name;
		
		for($j=0;$j<count($data)-1;$j++){
			$sensors_data = $sensors_data.$data[$j];
			$xml_php = $xml_php."','".$data[$j];
		}
		$to_xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
	<sensors>
	'.$sensors_data.'
	</sensors>';	//文を格納
		$write_fp=@fopen($xmlfile_name,"w");	//ファイルパスを格納
		@fputs($write_fp,$to_xml);	//文を書き込む
		fclose($write_fp);	//ファイルを閉じる
		
		$to_php = "<?php
$"."data = array('
	".$xml_php."');
?>";	//文を格納
		$write_fp=@fopen($phpfile_name,"w");	//ファイルパスを格納
		@fputs($write_fp,$to_php);	//文を書き込む
		fclose($write_fp);	//ファイルを閉じる
	}

?>