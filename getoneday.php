<?php
	//include(dirname(__FILE__) . "/../httpdocs/sensorlist.php");
	//include(dirname(__FILE__) . "/../httpdocs/function.php");
	include("sensorlist.php");
	include("function.php");
	
	//$phpfile_name = dirname(__FILE__) . '/../httpdocs/developers/api/php/sensors.php';
	//$jsfile_name = dirname(__FILE__) . '/../httpdocs/developers/api/js/sensors.js';
	$phpfile_name = 'developers/api/php/sensors.php';
	$jsfile_name = 'developers/api/js/sensors.js';
	
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
	
	// データベースサーバへの接続
	//$db = mysql_connect('localhost','sv_admin','0471327521');
	$db = mysql_connect('localhost','root','daiseikou');

	// データベースの選択
	$db_name = 'sensor_viewer_sql';
	mysql_select_db($db_name,$db);
	
	mysql_set_charset("utf8");
		
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
		// テーブルが存在しない場合
		if(!table_exists($db_name,$sensorlist[$i],$db))
		{
			// テーブル作成用SQL文
			$str_sql = "CREATE TABLE {$sensorlist[$i]}"
							. "("
							. "id int(10),"
							. "data_time datetime,"
							. "temp float(5),"
							. "humi float(5),"
							. "press float(7),"
							. "rainFull float(6),"
							. "winDir float(5),"
							. "winSpe float(6)"
							. ");";
	
			// SQL文の実行
			mysql_query($str_sql,$db);
		}
		
		//ユーザの数を取得
		$first_result = 'SELECT COUNT(*) FROM '.$sensorlist[$i]; //全体件数を取得するシンプルなSQLクエリを別途用意
		list($data_num) = mysql_fetch_row(mysql_query($first_result));
		
		if($alldata[$sensorlist[$i]]['temp'] == "---"){
			$alldata[$sensorlist[$i]]['temp'] = -999;
		}
		if($alldata[$sensorlist[$i]]['humi'] == "---"){
			$alldata[$sensorlist[$i]]['humi'] = -999;
		}
		if($alldata[$sensorlist[$i]]['pres'] == "---"){
			$alldata[$sensorlist[$i]]['pres'] = -999;
		}
		if($alldata[$sensorlist[$i]]['rainFall'] == "---"){
			$alldata[$sensorlist[$i]]['rainFall'] = -999;
		}
		if($alldata[$sensorlist[$i]]['windDir'] == "---"){
			$alldata[$sensorlist[$i]]['windDir'] = -999;
		}
		if($alldata[$sensorlist[$i]]['windSpe'] == "---"){
			$alldata[$sensorlist[$i]]['windSpe'] = -999;
		}
		
		//データを入力
		$sql = "INSERT INTO $sensorlist[$i] (id, data_time, temp, humi, press, rainFull, winDir, winSpe) VALUES ($data_num, '$now_time', ".$alldata[$sensorlist[$i]]['temp'].", ".$alldata[$sensorlist[$i]]['humi'].", ".$alldata[$sensorlist[$i]]['pres'].", ".$alldata[$sensorlist[$i]]['rainFall'].", ".$alldata[$sensorlist[$i]]['windDir'].", ".$alldata[$sensorlist[$i]]['windSpe'].")";
				
		$result_flag = mysql_query($sql,$db);
		
	}
	$to_php = $to_php.'
	?>';
	
	$write_fp=@fopen($jsfile_name,"w");	//ファイルパスを格納
	@fputs($write_fp,$to_js);	//文を書き込む
	fclose($write_fp);	//ファイルを閉じる

	$write_fp=@fopen($phpfile_name,"w");	//ファイルパスを格納
	@fputs($write_fp,$to_php);	//文を書き込む
	fclose($write_fp);	//ファイルを閉じる
	
	// データベースサーバの切断
	mysql_close($db);
	
	// ----------------------------------------------
	// テーブルの存在チェック関数の定義
	function table_exists($db_name,$tbl_name,$db)
	{
		$sql = 'SHOW TABLES FROM '.$db_name.' like "'.$tbl_name.'"';
		$rst = mysql_query($sql);
		
		if (mysql_num_rows($rst)) {
			return true;
		} else {
			return false;
		}
	}
?>