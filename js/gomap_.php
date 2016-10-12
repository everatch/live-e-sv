<script type="text/javascript">
window.onload = googlemaps;

function googlemaps(type_num) {
	
	jQuery( function() {
		jQuery( '#jquery-ui-slider' ) . slider( {
        range: 'min',
        value: 240,
        min: 1,
        max: 240,
        step: 1,
        slide: function( event, ui ) {
			var type = document.getElementsByName("type");
  
					for(var i=0;i<type.length;i++) {    //radioボタンの場合、同じ名前のHTML要素が１つ以上存在する  
						if (type[i].checked && type[i].value == 'none') {
							type = 0;
						}else if (type[i].checked && type[i].value == 'Temperature') { 
							type = 1;
						} else if (type[i].checked && type[i].value == 'Humidity') { 
							type = 2;
						} else if (type[i].checked && type[i].value == 'Pressure') { 
							type = 3;
						} else if (type[i].checked && type[i].value == 'RainFall') { 
							type = 4;
						} else if (type[i].checked && type[i].value == 'WindDir') { 
							type = 5;
						} else if (type[i].checked && type[i].value == 'WindSpeed') { 
							type = 6;
						}  
					} 
			
			sensors_icon(type);
        }
    } );
	} );
	sensors = new Array();
	
	<?php
	include 'sensorlist.php';	//センサーリストを取得
	include 'function.php';	//関数ファイルを読み取る（LiveEからデータを取得する関数含め）
    $sensors = getAllData();
		
	$dataType = array("temp","humi","pres","rainFall","windDir","windSpe");
	
	for($i=0;$i<count($sensorlist);$i++){
		echo 'sensors["'.$sensorlist[$i].'"] = new Array();';
		for($j=0;$j<count($dataType);$j++){
			@$datas = $sensors[$sensorlist[$i]][$dataType[$j]];
			echo 'sensors["'.$sensorlist[$i].'"]["'.$dataType[$j].'"] = "'.$datas.'";';
		}
	}
	
	?>

	var map = new google.maps.Map(document.getElementById("map"), {
		zoom : 10,
		center : new google.maps.LatLng(35.755555555, 139.75555555555555),
		mapTypeId : google.maps.MapTypeId.TERRAIN
	});

	function getColor(data_value){
		var red = 35;
		var yel = 30;
		var whi = 20;
		var sky = 10;
		var blu = 0;
		if(data_value >= red){
			return "FF0000|FFFFFF";
		}else if(data_value >= yel){
			data_value = 255-Math.round((data_value - yel) * (255 / (red - yel)));
			return "FF"+toSixteen(data_value)+"00|"+textcolor(data_value,1);
		}else if(data_value >= whi){
			data_value =255- Math.round((data_value - whi) * (255 / (yel - whi)));
			return "FFFF"+toSixteen(data_value)+"|0000"+toSixteen(255-data_value,0);
		}else if(data_value >= sky){
			data_value = Math.round((data_value - sky) * (255 / (whi - sky)));
			return toSixteen(data_value)+"FFFF|"+textcolor(data_value,0);
		}else if(data_value >= blu){
			data_value = Math.round((data_value - blu) * (255 / (sky - blu)));
			return "00"+toSixteen(data_value)+"FF|"+textcolor(data_value,1);
		}else{
			return "0000FF|FFFFFF";
		}
		function toSixteen(value){
			if(value < 16){
				return "0" + value.toString(16);
			}else{
				return value.toString(16);
			}
		}
		function textcolor(value,type){
			if(value < 123 && type == 1 || value > 122 && type == 0){
				return "FFFFFF";
			}else{
				return "000000";
			}
		}
	}
	
	function sensors_icon(type){
		
		if(type == 0){
			<?php
			for($i=0;$i<count($sensorlist_map);$i++){
				echo "mak_".$sensorlist_map[$i].".setIcon('img/map/marker.png');";
			}
			?>
			return 0;
		}
		
		var slider_value = jQuery( '#jquery-ui-slider' ) . slider( 'value' );
		var time_value = Math.floor((240 - slider_value) / 10);
		<?php
		for($i=0;$i<count($sensorlist_map);$i++){
			echo "if(data['".$sensorlist_map[$i]."'][time_value][type] == '---'){
				mak_".$sensorlist_map[$i].".setIcon('http://chart.apis.google.com/chart?chst=d_bubble_text_small&chld=edge_bc|None|000000|FFFFFF');
			}else{ 
				var icon_url = 'http://chart.apis.google.com/chart?chst=d_bubble_text_small&chld=edge_bc|'+data['".$sensorlist_map[$i]."'][time_value][type]+'|'+getColor(data['".$sensorlist_map[$i]."'][time_value][type]);
				mak_".$sensorlist_map[$i].".setIcon(icon_url);
			}";
		}
		?>
	}
	
	var mak_s_mito01 = new google.maps.Marker({
		position: new google.maps.LatLng(36.380661,140.465827),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 水戸芸術館\nART TOWER MITO ',
	});	var mak_l_ano = new google.maps.Marker({
		position: new google.maps.LatLng(35.686555,139.770877),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' アスパ日本橋オフィス\nAsupa Nihonbashi office '
	});	var mak_l_kashiwanoha_h = new google.maps.Marker({
		position: new google.maps.LatLng(35.891988,139.945065),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 千葉県立柏の葉高校\nChiba Prefectural Kashiwanoha Senior HighSchool ',
	});	var mak_t_MtFuji_A = new google.maps.Marker({
		position: new google.maps.LatLng(35.448802,138.616283),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 富士山ふもとA-1\nFoot of Mt.Fuji A-1 '
	});	var mak_t_MtFuji_C = new google.maps.Marker({
		position: new google.maps.LatLng(35.449169,138.613815),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 富士山ふもとA-3\nFoot of Mt.Fuji A-3 '
	});	var mak_l_sci_hokudai = new google.maps.Marker({
		position: new google.maps.LatLng(43.072728,141.339455),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 北海道大学大学院理学院\nGraduate School of Science, Hokkaido university '
	});	var mak_l_1_itc_u_tokyo = new google.maps.Marker({
		position: new google.maps.LatLng(35.715707,139.764504),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京大学情報基盤センター\nInformation Technology Center, The University of Tokyo '
	});	var mak_l_otsuchi_u_tokyo = new google.maps.Marker({
		position: new google.maps.LatLng(35.900181,139.933033),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京大学大気海洋研究所\nInternational Coastal Research Center, Atmosphere and Ocean Research Institute, The University of Tokyo '
	});	var mak_l_O_buiding = new google.maps.Marker({
		position: new google.maps.LatLng(35.546724,139.671807),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 慶應義塾大学新川崎タウンキャンパス\nKEIO UNIVERSITY K2 TOWN CAMPUS '
	});	var mak_l_hiyoshi = new google.maps.Marker({
		position: new google.maps.LatLng(35.552032,139.647174),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 慶應義塾大学日吉キャンパス\nKeio University Hiyoshi Campus RF '
	});	var mak_l_krupp_solar = new google.maps.Marker({
		position: new google.maps.LatLng(35.682802,139.733756),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 上智大学クルップホール屋上太陽光発電\nKrupp Hall, Sophia University '
	});	var mak_m_Musashi_HighSchool = new google.maps.Marker({
		position: new google.maps.LatLng(35.736029,139.667349),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 武蔵高等学校\nMusashi Senior HighSchool '
	});	var mak_l_iizuka_naudata = new google.maps.Marker({
		position: new google.maps.LatLng(33.650023,130.667009),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 株式会社なうデータ研究所\nNaU Data Institute Inc. '
	});	var mak_l_nayoro_star = new google.maps.Marker({
		position: new google.maps.LatLng(44.37417,142.482827),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' なよろ市立天文台\nNayoro Observatory '
	});	var mak_l_nerimakogyo_h_ClassRoom = new google.maps.Marker({
		position: new google.maps.LatLng(35.754509,139.654704),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 練馬工業高等学校(クラス)\nNerima Technical High School (Class Room) '
	});	var mak_l_2_itc_u_tokyo = new google.maps.Marker({
		position: new google.maps.LatLng(35.699857,139.518447),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京農工大学小金キャンパス\nNo.1, Koganei Campus, Tokyo University of Agriculture and Technology '
	});	var mak_l_1_cf_u_tokyo = new google.maps.Marker({
		position: new google.maps.LatLng(35.937108,138.803823),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京大学秩父演習林1\nNo.1, University Forest in Chichibu, The University of Tokyo '
	});	var mak_l_2_cf_u_tokyo = new google.maps.Marker({
		position: new google.maps.LatLng(35.938515,138.803008),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京大学秩父演習林2\nNo.2, University Forest in Chichibu, The University of Tokyo '
	});	var mak_l_PP_AngkornetISP = new google.maps.Marker({
		position: new google.maps.LatLng(11.542458,104.901087),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' プノンペン\nPhunon Penh '
	});	var mak_l_kashiwa_u_tokyo = new google.maps.Marker({
		position: new google.maps.LatLng(35.902714,139.938971),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京大学柏キャンパス\nThe University of Tokyo Kashiwa Campus '
	});	var mak_l_komaba2_u_tokyo = new google.maps.Marker({
		position: new google.maps.LatLng(35.660144,139.684682),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京大学駒場キャンパス\nThe University of Tokyo Komaba2 Campus '
	});	var mak_l_fm_a_u_tokyo = new google.maps.Marker({
		position: new google.maps.LatLng(35.713418,139.762434),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京大学田無キャンパス\nThe University of Tokyo Tanashi Campus '
	});	var mak_l_030000127312 = new google.maps.Marker({
		position: new google.maps.LatLng(35.683624,139.878842),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 都立葛西工業高校\nTokyo Metropolitan Kasai Technical High School '
	});	var mak_l_titech_tsubame = new google.maps.Marker({
		position: new google.maps.LatLng(35.513594,139.482346),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京工業大学ツバメ\nTokyo Institute of Technology TSUBAME '
	});	var mak_l_akirudai = new google.maps.Marker({
		position: new google.maps.LatLng(35.732204,139.300731),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京都立秋留台高校\nTokyo Metropolitan Akirudai High School '
	});	var mak_t_den_enchofu_h = new google.maps.Marker({
		position: new google.maps.LatLng(35.582311,139.67656),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京都立田園調布高校\nTokyo Metropolitan Den-encyofu High School '
	});	var mak_l_hachioji_soushi = new google.maps.Marker({
		position: new google.maps.LatLng(35.65823,139.305509),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京都立八王子桑志高校\nTokyo Metropolitan Hachioji-soushi High School '
	});	var mak_l_Kagakugijyutu_h = new google.maps.Marker({
		position: new google.maps.LatLng(35.686981,139.821981),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京都立科学技術高校\nTokyo Metropolitan High School of Science and Technology '
	});	var mak_t_katsushikasogo_h = new google.maps.Marker({
		position: new google.maps.LatLng(35.777968,139.864902),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京都立葛飾総合高校\nTokyo Metropolitan Katsushika Sogo High School '
	});	var mak_t_kirigaoka_h = new google.maps.Marker({
		position: new google.maps.LatLng(35.781878,139.707026),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京都立桐ヶ丘高校\nTokyo Metropolitan Kirigaoka High School '
	});	var mak_l_kitatoshimakogyo_h = new google.maps.Marker({
		position: new google.maps.LatLng(35.760746,139.697139),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京都立北豊島工業高校\nTokyo Metropolitan Kitatoshima Technical High School '
	});	var mak_l_kuramaekogyo_h = new google.maps.Marker({
		position: new google.maps.LatLng(35.700418,139.791003),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京都立蔵前工業高校\nTokyo Metropolitan Kuramae Technical High School '
	});	var mak_l_Machidakogyo_h = new google.maps.Marker({
		position: new google.maps.LatLng(35.575493,139.421471),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京都立町田工業高校\nTokyo Metropolitan Machida Technical High School '
	});	var mak_l_Nerimakogyo_h = new google.maps.Marker({
		position: new google.maps.LatLng(35.754498,139.654705),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京都立練馬工業高校\nTokyo Metropolitan Nerima Technical High School '
	});	var mak_l_Sumidakogyo_h = new google.maps.Marker({
		position: new google.maps.LatLng(35.68522,139.807036),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京都立隅田工業高校\nTokyo Metropolitan Sumida Technical High School '
	});	var mak_l_mtama_h = new google.maps.Marker({
		position: new google.maps.LatLng(35.789568,139.24667),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京都立多摩高校\nTokyo Metropolitan Tama High School '
	});	var mak_l_tama_st_h = new google.maps.Marker({
		position: new google.maps.LatLng(35.6998,139.500991),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京都立多摩科学技術高校\nTokyo Metropolitan Tama High School of Science and Technology '
	});	var mak_l_Tamakogyo_h = new google.maps.Marker({
		position: new google.maps.LatLng(35.716019,139.338744),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京都立多摩工業高校\nTokyo Metropolitan Tama Technical High School '
	});	var mak_l_Tanashikogyo_h = new google.maps.Marker({
		position: new google.maps.LatLng(35.720728,139.548192),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京都立田無工業高校\nTokyo Metropolitan Tanashi Technical High School '
	});	var mak_t_toyama_h = new google.maps.Marker({
		position: new google.maps.LatLng(35.706613,139.710569),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京都立戸山高校\nTokyo Metropolitan Toyama High School '
	});	var mak_t_yashio_h = new google.maps.Marker({
		position: new google.maps.LatLng(35.611827,139.746564),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東京都立八潮高校\nTokyo Metropolitan Yshio High School '
	});
	
	var mak_l_030000049bc2 = new google.maps.Marker({
		position: new google.maps.LatLng(35.642073,139.729507),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 神応小学校\nShinno elementary shcool '
	});	var mak_t_setagaya_sogo_h = new google.maps.Marker({
		position: new google.maps.LatLng(35.621755,139.618979),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 都立世田谷総合高校\nTokyo Metropolitan Setagaya Sogo High School '
	});	var mak_o_hadano_y_center = new google.maps.Marker({
		position: new google.maps.LatLng(35.418377,139.195147),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 表丹沢野外活動センター\nOmote tanzawa outdoor activity center '
	});	var mak_l_Minamiosawa = new google.maps.Marker({
		position: new google.maps.LatLng(35.617165,139.376936),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 首都大学東京_南大沢キャンパス\nTMU(Minamiosawa) '
	});	var mak_o_hadano_city_hall = new google.maps.Marker({
		position: new google.maps.LatLng(35.374729,139.220005),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 秦野市役所西庁舎\nHadano city hall(west buil.) '
	});	var mak_o_hadano_firestation = new google.maps.Marker({
		position: new google.maps.LatLng(35.38006,139.211063),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 秦野市消防署鶴巻分署\nHadano Fire station Tsurumaki branch '
	});	var mak_l_030000049c92 = new google.maps.Marker({
		position: new google.maps.LatLng(34.732495,135.732654),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 奈良先端科学技術大学院大学 情報科学研究科\nNara Institute of Science and Technology '
	});	var mak_l_f_t_i_branch_office = new google.maps.Marker({
		position: new google.maps.LatLng(35.54472,134.284539),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 鳥取市役所福部支所\nTottori City Fukube Town Integrated Branch Office '
	});	var mak_l_tottori_ekinan_city_hall = new google.maps.Marker({
		position: new google.maps.LatLng(35.492249,134.227324),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 鳥取駅南シティホール\nTottori Eki-Nan City Hall '
	});	var mak_l_NorthBuilding_indoor = new google.maps.Marker({
		position: new google.maps.LatLng(35.450863,134.255129),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 鳥取環境大\nTottori University of Environmental Studies, North Building, Indoor '
	});	var mak_l_m_t_i_branch_office = new google.maps.Marker({
		position: new google.maps.LatLng(35.342791,134.207474),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 鳥取市役所用瀬支所\nTottori City Mochigase Town Integrated Branch Office '
	});	var mak_l_s_t_i_branch_office = new google.maps.Marker({
		position: new google.maps.LatLng(35.329587,134.113865),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 鳥取市役所佐治支所\nTottori City Saji Town Integrated Branch Office '
	});	var mak_l_k_t_i_branch_office = new google.maps.Marker({
		position: new google.maps.LatLng(35.501131,134.235092),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 鳥取市役所金高支所\nTottori City Kedaka Town Integrated Branch Office '
	});	var mak_l_a_t_i_b_office = new google.maps.Marker({
		position: new google.maps.LatLng(35.50113,134.235094),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 鳥取市役所青谷支所\nTottori City Aoya Town Integrated Branch Office '
	});	var mak_k_s_j_h_s = new google.maps.Marker({
		position: new google.maps.LatLng(34.643824,133.825077),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 庄中学校\nSho junior high school '
	});	var mak_k_m_h_j_h_school = new google.maps.Marker({
		position: new google.maps.LatLng(34.643111,133.71219),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 真備東中学校\nMakibi higashi junior high school '
	});	var mak_k_mabi_shisho = new google.maps.Marker({
		position: new google.maps.LatLng(34.62908,133.692235),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 倉敷市真備支所\nKurashiki Mabi shisho '
	});	var mak_k_kurese_elementary_school = new google.maps.Marker({
		position: new google.maps.LatLng(34.625395,133.657055),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 呉妹小学校\nKurese elementary school '
	});	var mak_k_t_h_j_high_school = new google.maps.Marker({
		position: new google.maps.LatLng(34.478309,135.395744),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 北中学校\nKita junior high school '
	});	var mak_k_h_j_h_school = new google.maps.Marker({
		position: new google.maps.LatLng(34.631149,135.630416),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東中学校\nHigashi junior high school '
	});	var mak_k_nis_jur_h_school = new google.maps.Marker({
		position: new google.maps.LatLng(34.671513,135.478625),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 西中学校\nNishi junior high school '
	});	var mak_k_minami_junior_high_school = new google.maps.Marker({
		position: new google.maps.LatLng(34.954566,139.107301),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 南中学校\nMinami junior high school '
	});	var mak_k_touyou_junior_high_school = new google.maps.Marker({
		position: new google.maps.LatLng(34.499918,135.413939),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 東陽中学校\nTouyou junior high school '
	});	var mak_k_tatsumi_junior_high_school = new google.maps.Marker({
		position: new google.maps.LatLng(34.575195,133.799773),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 多津美中学校\nTatsumi junior high school '
	});	var mak_k_shinden_junior_high_school = new google.maps.Marker({
		position: new google.maps.LatLng(35.541192,139.62242),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 新田中学校\nShinden junior high school '
	});	var mak_k_ku_daii_junior_high_school = new google.maps.Marker({
		position: new google.maps.LatLng(34.583865,133.728677),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 倉敷第一中学校\nKurashiki daiichi junior high school '
	});	var mak_k_funaho_junior_high_school = new google.maps.Marker({
		position: new google.maps.LatLng(35.795234,140.132308),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 船穂中学校\nfunaho junior high school '
	});	var mak_k_gounai_junior_high_school = new google.maps.Marker({
		position: new google.maps.LatLng(34.538446,133.815123),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 郷内中学校\nGounai junior high school '
	});	var mak_k_fukuda_junior_high_school = new google.maps.Marker({
		position: new google.maps.LatLng(34.536633,133.761143),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 福田中学校\nfukuda junior high school '
	});	var mak_k_mizushima_shisho = new google.maps.Marker({
		position: new google.maps.LatLng(34.539907,133.741336),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 水島支所\nMizushima shisho '
	});	var mak_k_turajima_junior_high_school = new google.maps.Marker({
		position: new google.maps.LatLng(34.545452,133.726598),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 連島中学校\nTurajima junior high school '
	});	var mak_k_tam_kita_junior_high_school = new google.maps.Marker({
		position: new google.maps.LatLng(34.563774,133.671057),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 玉島北中学校\nTamashima kita junior high school '
	});	var mak_k_taa_higashi_jo_high_school = new google.maps.Marker({
		position: new google.maps.LatLng(34.540862,133.679249),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 玉島東中学校\nTamashima higashi junior high school '
	});	var mak_k_taa_nii_ju_high_school = new google.maps.Marker({
		position: new google.maps.LatLng(34.531785,133.660909),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 玉島西中学校\nTamashima nishi junior high school '
	});	var mak_k_sami_elementary_school = new google.maps.Marker({
		position: new google.maps.LatLng(34.504139,133.632778),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 沙美小学校\nSami elementary school '
	});	var mak_k_nanpo_elementary_school = new google.maps.Marker({
		position: new google.maps.LatLng(34.498468,133.612816),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 南浦小学校\nNanpo elementary school '
	});	var mak_k_shonen_shizennoie = new google.maps.Marker({
		position: new google.maps.LatLng(36.410909,140.384698),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 少年自然の家\nShonen shizennoie '
	});	var mak_k_kotoura_junior_high_school = new google.maps.Marker({
		position: new google.maps.LatLng(34.479909,133.831381),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 琴浦中学校\nKotoura junior high school '
	});	var mak_k_ajino_junior_high_school = new google.maps.Marker({
		position: new google.maps.LatLng(34.464237,133.801535),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 味野中学校\nAjino junior high school '
	});	var mak_k_shimotsui_junior_high_school = new google.maps.Marker({
		position: new google.maps.LatLng(34.442919,133.802543),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 下津井中学校\nShimotsui junior high school '
	});	var mak_l_03000006ac52 = new google.maps.Marker({
		position: new google.maps.LatLng(34.50313,133.411728),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 広島大学附属福山中・高等学校\nFukuyama secondary school attached a university of Hiroshima '
	});	var mak_h_higashi_hiroshima_campus = new google.maps.Marker({
		position: new google.maps.LatLng(34.385203,132.455292),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 広島大学情報メディア教育研究センター\nInformation Media Center, Hiroshima University '
	});	var mak_l_03000004a442 = new google.maps.Marker({
		position: new google.maps.LatLng(34.385205,132.455294),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 広島大学大学院教育科学研究科\nGraduate School of pedagogy, The University of Hiroshima '
	});	var mak_l_hiroshima_city_university = new google.maps.Marker({
		position: new google.maps.LatLng(34.438475,132.414432),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 広島市立大学\nHiroshima City University '
	});	var mak_l_03000005c2f2 = new google.maps.Marker({
		position: new google.maps.LatLng(34.385207,132.455292),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 広島市立大学情報処理センター\nData processing center, Hiroshima city university '
	});	var mak_l_hiroshima_children_museum = new google.maps.Marker({
		position: new google.maps.LatLng(34.398498,132.45377),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' こども文化科学館\nHiroshima Childrens Museum '
	});	var mak_l_03000004a472 = new google.maps.Marker({
		position: new google.maps.LatLng(34.398498,132.453778),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 広島大学法科大学院（大学院法務研究科）\nGraduate School of law, The University of Hiroshima '
	});	var mak_h_kasumi_campus = new google.maps.Marker({
		position: new google.maps.LatLng(34.385207,132.455292),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 広島大学附属図書館医学分館\nMedical Science Branch Library, Hiroshima University '
	});	var mak_l_hiroshima_municipal_tech_hs = new google.maps.Marker({
		position: new google.maps.LatLng(34.377207,132.489674),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 広島市立広島工業高校\nHiroshima Municipal Technical High School '
	});	var mak_l_03000005bcf2 = new google.maps.Marker({
		position: new google.maps.LatLng(34.373973,132.492317),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 広島市立広島工業高校2\nHiroshima municipal Hiroshima industrial high school '
	});	var mak_l_03000004a0d2 = new google.maps.Marker({
		position: new google.maps.LatLng(34.283202,132.288212),
		map:map,
		icon: 'img/map/marker.png',
		animation: google.maps.Animation.DROP,
		title:' 広島大学大学院理学研究科附属宮島自然植物実験所\nMiyajima Natural Botanical Garden, Hiroshima University '});
<?php
for($i=0;$i<count($sensorlist_map);$i++){
	echo "google.maps.event.addListener(mak_".$sensorlist_map[$i].", 'click', function() {
		showInfoWindow(this,'".$sensorlist_map[$i]."','".$lang_sName[$sensorlist_map[$i]]."');
	});";
}
?>
			var infowindow;

/* 情報ウィンドウ表示 */
            function showInfoWindow(data,type,sensorname){
                /* 既に開かれていたら閉じる */
                if(infowindow) infowindow.close();
                infowindow=new google.maps.InfoWindow({
                    /* クリックしたマーカーのタイトルと緯度・経度を情報ウィンドウに表示 */
                    content:"<div id='info'><h3>"+sensorname+"</h3><br /><table style='font-family: Verdana, 'MS Gothic', Osaka-mono, monospace, sans-serif !important;'>"
											+"<tr><th><?php echo $lang_temp.":&nbsp;"; ?></th><th>"+sensors[type]["temp"]+"&nbsp;℃</th></tr>"
											+"<tr><th><?php echo $lang_humi.":&nbsp;"; ?></th><th>"+sensors[type]["humi"]+"&nbsp;%</th></tr>"
											+"<tr><th><?php echo $lang_pres.":&nbsp;"; ?></th><th>"+sensors[type]["pres"]+"&nbsp;hPa</th></tr>"
											+"<tr><th><?php echo $lang_prec.":&nbsp;"; ?></th><th>"+sensors[type]["rainFall"]+"&nbsp;mm/h</th></tr>"
											+"<tr><th><?php echo $lang_win_dir.":&nbsp;"; ?></th><th>"+sensors[type]["windDir"]+"&nbsp;°</th></tr>"
											+"<tr><th><?php echo $lang_win_spe.":&nbsp;"; ?></th><th>"+sensors[type]["windSpe"]+"&nbsp;m/s</th></tr></table></div>",
                });
				
                infowindow.open(map,data);
            }	
	
	if(type_num && type_num == 1){
		sensors_icon(1);
	}
}
</script>