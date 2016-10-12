function getHTML(lang,id,num,bc_1,bc_2,cellSize) {	

	var html = "";
	var backcolor = "";
            
	if(num > 24){
		num = 24;
	}
	 
    for (var i = 0 ;i<num ;i++) {
		if(i%2 == 0){
			backcolor = bc_1;
		}else{ backcolor = bc_2; }
		
		var time = data[id][i][0];
		var temp = data[id][i][1];
		var humi = data[id][i][2];
		var pres = data[id][i][3];
		var rainfall = data[id][i][4];
		var winddir = data[id][i][5];
		var windspe = data[id][i][6];
			
		var winddirText = windDir_toText(lang,windspe,winddir);
								
		var comment = getComment(lang,temp,humi,pres,rainfall,windspe);
		
		if(lang == "jp"){
			html += '<div style="background-color: '+backcolor+'; padding:5px 10px;);"><table style="text-align:left; font-size:13px;">'+
					'<tr><td>気温：'+temp+' ℃</td>'+
					'<td>気圧：'+pres+' hPa</td></tr>'+
					'<tr><td>湿度：'+humi+' %</td>'+
					'<td>雨量：'+rainfall+' mm/h</td></tr>'+
					'<tr><td>風速：'+windspe+'m/s</td>'+
					'<td>風向：'+winddirText+'</td></tr></table>'+
					'<div style="text-align:left; font-size:13px;">'+comment+'</div>'+
					'<div style="text-align:right; font-size:13px;">'+time+'</div></div>'; 
		}else if(lang == "en"){
			html += '<div style="background-color: '+backcolor+'; padding:5px 10px;);"><table style="text-align:left; font-size:14px;">'+
					'<tr><td>Temperature： '+temp+' ℃</td></tr>'+
					'<tr><td>Humidity： '+humi+' %</td></tr>'+
					'<tr><td>Pressure： '+pres+' hPa</td></tr>'+
					'<tr><td>Precipitation： '+rainfall+' mm/h</td></tr>'+
					'<tr><td>Wind speed： '+winddirText+'</td></tr></tr>'+
					'<tr><td>Wind direction： '+windspe+'m/s</td></table>'+
					'<div style="text-align:left; font-size:14px;">'+comment+'</div>'+
					'<div style="text-align:right; font-size:13px;">'+time+'</div></div>';
		}
    }
	return html;
}
	
function sv_showForm(text,lang,id,num,size_w,size_h,bc_t,tc_t,bc_b,tc_b,bc_1,bc_2,tc,code){
	
	if(lang != "jp" && lang != "en"){
		lang = "jp";
	}
	if(!text){
		text = lang_sName[id];
	}
	var lang_sName = getName(lang);
	if(!lang_sName[id]){
		document.write('<div id="sv_api1_error" style="height:'+size_h+'px; width:'+size_w+'px; background:'+bc_1+'; text-align:center;">error:Can not find the id"'+id+'"!</div>');
		return 0;
	}
	if(size_w>500){
		size_w = 250;
	}
	if(size_h == 0){
		
	}else if(!size_h){
		size_h = "auto";
	}else if(size_h>800){
		size_h = 800;
	}
	var cellSize = (size_w-65)/2;
	var html = getHTML(lang,id,num,bc_1,bc_2,cellSize);

	var headcenter = "padding:3px 0;";
	if(lang_sName[id].length < 12){
		headcenter = "padding:14px 0;";
	}
	if(text == "none"){
		var tittle = '';
		size_h_c = size_h;
	}else{
		var tittle = '<div style="text-align:center; background:'+bc_t+'; font-size:22px; overflow: hidden; font-weight:bold; color:'+tc_t+'; '+ headcenter +'">'+text+'</div>';
		size_h_c = size_h-72;
	}
	var dush = "'";
	if(!code){
		document.write('<div style="height:'+size_h+'px; width:'+size_w+'px;">'+tittle+'<div id="sv_showForm" style="height:'+(size_h_c)+'px; overflow:auto; color:'+tc+';">'+html+'</div>'+'<div style="text-align:center; background:'+bc_b+'; padding:3px; font-size:16px; color:'+tc_b+'; cursor:pointer;" onClick="window.open('+dush+'http://www.live-e-sv.info/index.php?sID='+id+'&lang='+lang+dush+');">Sensor Viewer</div></div>');
	}else if(code == "recode"){return '<div style="height:'+size_h+'px; width:'+size_w+'px;">'+tittle+'<div id="sv_showForm" style="height:'+(size_h_c)+'px; overflow:auto; color:'+tc+';">'+html+'</div>'+'<div style="text-align:center; background:'+bc_b+'; padding:3px; font-size:16px; color:'+tc_b+'; cursor:pointer;" onClick="window.open('+dush+'http://www.live-e-sv.info/index.php?sID='+id+'&lang='+lang+dush+');">Sensor Viewer</div></div>'
	}else if(code == "auto"){
		document.write('<div style="height:100%; width:100%;">'+tittle+'<div id="sv_showForm" style="height:100%; overflow:auto; color:'+tc+';">'+html+'</div>'+'<div style="text-align:center; background:'+bc_b+'; padding:3px; font-size:16px; color:'+tc_b+'; cursor:pointer;" onClick="window.open('+dush+'http://www.live-e-sv.info/index.php?sID='+id+'&lang='+lang+dush+');">Sensor Viewer</div></div>');
	}
}

function getComment(lang,temp,humi,pres,rainfall,windspe){
	var comment="";
	
	if(lang == "jp"){
		if(temp < 1){
			comment = "<br/>とても寒いですね！！川も凍っているかもしれません、防寒対策は万全にしましょう！";
		}else if(temp < 15){
			comment = "<br/>外は寒いです、暖かい服装でお出かけしましょう！";
		}else if(temp < 22){
			if(rainfall == 0 || rainfall == "---"){
				comment = "<br/>涼しいでしょう、外で遊べる絶好のチャンスです！";
			}else{
				comment = "<br/>涼しいでしょう、雨が降っているので室内で遊びましょう！";
			}
		}else if(temp < 35){
			if(humi < 70){
				comment = "<br/>暑い！涼しい服装でお出かけしましょう！";
			}else{
				comment = "<br/>蒸し暑いです！湿度も高いので、除湿をしましょう！";
			}
		}else if(temp > 35){
			comment = "<br/>猛暑ですよ！暑さ対策をしっかり！熱中症を防ぐために、水分補給をこまめにしましょう！";
		}
		
		if(humi < 30){
			comment += "<br/>湿度も低いようです、乾燥やインフルエンザにはご注意を！";
		}else{
			comment += " ";
		}
		
		if(rainfall == 0){
			comment = " ";
		}else if(rainfall < 10){
			comment = "<br/>雨がぽつぽつと降っていますね、お出かけには傘をお持ちしましょう！";
		}else if(rainfall < 20){
			comment = "<br/>雨がザーザーと降っていますね、お出かけには傘をお持ちしましょう！";
		}else if(rainfall < 30){
			comment = "<br/>雨が土砂降りですね、傘をさしても濡れますので、外出にはご注意を！";
		}else if(rainfall < 50){
			comment = "<br/>バケツをひっくり返したような雨です、傘をさしても濡れますので、外出にはご注意を！";
		}else if(rainfall < 80){
			comment = "<br/>滝のような雨が降っています、車の運転も危険です、お出かけは控えましょう！";
		}else if(rainfall >= 80){
			comment = "<br/>猛烈な雨が降っています、災害が発生する恐れがあります、厳重に警戒をしてください！";
		}
		
		if(windspe > 15){
			comment += "<br/>風も強いようです、お出かけにはご注意を！";
		}else if(windspe > 10){
			comment += "<br/>風もやや強いようです、お出かけにはご注意を！";
		}else{
			comment += " ";
		}
		
		if(pres < 999 && windspe > 18){
			comment = "<br/>台風が来ているかもしれません、気象情報をこまめにチェックしてください。";
		}else if(pres < 999 && windspe > 44){
			comment = "<br/>台風が非常に強いです、お出かけ控えましょう！";
		}else if(pres < 999 && windspe > 54){
			comment = "<br/>猛烈な台風が近づいてます、外出はやめましょう！";
		}
	}else if(lang == "en"){
		if(temp < 1){
			comment = "<br/>It's so cold !! Let deemed measures against cold !";
		}else if(temp < 15){
			comment = "<br/>It is cold outside, Put on warm clothes if you go out !";
		}else if(temp < 22){
			if(rainfall == 0){
				comment = "<br/>Very cool now ! Let's play outside !";
			}else{
				comment = "<br/>It's cool, but I'm afraid it's raining now...";
			}
		}else if(temp < 35){
			if(humi < 70){
				comment = "<br/>It's being hot ! ";
			}else{
				comment = "<br/>It's humid now ! Also the temperature is high !";
			}
		}else if(temp > 35){
			comment = "<br/>My god ! It's too hot ! Get enough water, and be careful not to take a heat stroke !";
		}
		
		if(humi < 30){
			comment += "<br/>The humidity is low. Please note that in the dry and flu !";
		}else{
			comment += " ";
		}
		
		if(rainfall == 0){
			comment += " ";
		}else if(rainfall < 10){
			comment += "<br/>It's drizzling !";
		}else if(rainfall < 20){
			comment += "<br/>It's raining ! Don't forget your umbrella.";
		}else if(rainfall < 30){
			comment += "<br/>It's raining ! Don't forget your umbrella.";
		}else if(rainfall < 50){
			comment += "<br/>Outside is heavy rain. Please be careful.";
		}else if(rainfall < 80){
			comment += "<br/>Outside is heavy rain. Please be careful.";
		}else if(rainfall >= 80){
			comment += "<br/>Oh,my god !!";
		}
		
		if(windspe > 15){
			comment += "<br/>The wind seems strong.";
		}else if(windspe > 10){
			comment += "<br/>The wind seems strong.";
		}else{
			comment += " ";
		}
		
		if(pres < 999 && windspe > 18){
			comment = "<br/>Is it a Typhoon ?";
		}else if(pres < 999 && windspe > 44){
			comment = "<br/>Is it a Typhoon ?";
		}else if(pres < 999 && windspe > 54){
			comment = "<br/>It is very dangerous here.";
		}
	}
	return comment;
}

	function windDir_toText(lang,windspe,winddir){
		var winddirText = "";		
		
		if(lang == "jp"){
			if(windspe == 0){
				winddirText = "無風";
			}else if(winddir > 348.75 || winddir < 11.25){
				winddirText = "北";
			}else if(winddir < 33.75){
				winddirText = "北北東";
			}else if(winddir < 56.25){
				winddirText = "北東";
			}else if(winddir < 78.75){
				winddirText = "東北東";
			}else if(winddir < 101.25){
				winddirText = "東";
			}else if(winddir < 123.75){
				winddirText = "東南東";
			}else if(winddir < 146.25){
				winddirText = "南東";
			}else if(winddir < 168.75){
				winddirText = "南南東";
			}else if(winddir < 191.25){
				winddirText = "南";
			}else if(winddir < 213.75){
				winddirText = "南南西";
			}else if(winddir < 236.25){
				winddirText = "南西";
			}else if(winddir < 258.75){
				winddirText = "西南西";
			}else if(winddir < 281.25){
				winddirText = "西";
			}else if(winddir < 303.75){
				winddirText = "西北西";
			}else if(winddir < 326.25){
				winddirText = "北西";
			}else if(winddir < 348.75){
				winddirText = "北北西";
			}
		}else if(lang == "en"){
			if(windspe == 0){
				winddirText = "None";
			}else if(winddir > 348.75 || winddir < 11.25){
				winddirText = "North";
			}else if(winddir < 33.75){
				winddirText = "NNE";
			}else if(winddir < 56.25){
				winddirText = "NE";
			}else if(winddir < 78.75){
				winddirText = "ENE";
			}else if(winddir < 101.25){
				winddirText = "East";
			}else if(winddir < 123.75){
				winddirText = "EWE";
			}else if(winddir < 146.25){
				winddirText = "SE";
			}else if(winddir < 168.75){
				winddirText = "SSE";
			}else if(winddir < 191.25){
				winddirText = "South";
			}else if(winddir < 213.75){
				winddirText = "SSW";
			}else if(winddir < 236.25){
				winddirText = "SW";
			}else if(winddir < 258.75){
				winddirText = "WSW";
			}else if(winddir < 281.25){
				winddirText = "West";
			}else if(winddir < 303.75){
				winddirText = "WNW";
			}else if(winddir < 326.25){
				winddirText = "NW";
			}else if(winddir < 348.75){
				winddirText = "NNW";
			}
		}
		return winddirText;
	}
function getName(lang){
	lang_sName = new Array();
	
	if(lang == "jp"){
		lang_sName['s_mito01'] = '水戸芸術館';
		lang_sName['l_ano'] = 'アスパ日本橋オフィス';
		lang_sName['l_kashiwanoha_h'] = '千葉県立柏の葉高校';
		lang_sName['d_dsi_demo'] = 'DSIデモ';
		lang_sName['d_dsi_demo2'] = 'DSIデモ2';
		lang_sName['l_Ehome'] = 'デモ3';
		lang_sName['t_MtFuji_A'] = '富士山ふもとA-1';
		lang_sName['t_MtFuji_B'] = '富士山ふもとA-2';
		lang_sName['t_MtFuji_C'] = '富士山ふもとA-3';
		lang_sName['l_sci_hokudai'] = '北海道大学理学部';
		lang_sName['l_IitateVillage'] = 'IitateVillage-5';
		lang_sName['l_1_itc_u_tokyo'] = '東京大学<br>情報基盤センター';
		lang_sName['l_otsuchi_u_tokyo'] = '東京大学<br>大気海洋研究所';
		lang_sName['l_O_buiding'] = '慶應義塾大学<br>新川崎タウンキャンパス';
		lang_sName['l_hiyoshi'] = '慶應義塾大学<br>日吉キャンパス';
		lang_sName['l_krupp_solar'] = '上智大学<br>クルップホール';
		lang_sName['m_Musashi_HighSchool'] = '武蔵高等学校';
		lang_sName['l_iizuka_naudata'] = '株式会社<br>なうデータ研究所';
		lang_sName['l_nayoro_star'] = 'なよろ市立天文台';
		lang_sName['l_nerimakogyo_h_ClassRoom'] = '練馬工業高等学校(クラス)';
		lang_sName['l_2_itc_u_tokyo'] = '東京農工大学<br>小金キャンパス';
		lang_sName['l_1_cf_u_tokyo'] = '東京大学秩父演習林1';
		lang_sName['l_2_cf_u_tokyo'] = '東京大学秩父演習林2';
		lang_sName['l_PP_AngkornetISP'] = 'プノンペン';
		lang_sName['l_sophia_krupp2'] = '上智大学<br>クルップホール2';
		lang_sName['l_sophia_sj2'] = '上智大学SJハウス2';
		lang_sName['l_T_Residence'] = 'とある方の自宅';
		lang_sName['l_kashiwa_u_tokyo'] = '東京大学<br>柏キャンパス';
		lang_sName['l_komaba2_u_tokyo'] = '東京大学<br>駒場キャンパス';
		lang_sName['l_fm_a_u_tokyo'] = '東京大学<br>田無キャンパス';
		lang_sName['l_030000127312'] = '都立葛西工業高校';
		lang_sName['l_titech_tsubame'] = '東京工業大学ツバメ';
		lang_sName['l_akirudai'] = '東京都立秋留台高校';
		lang_sName['t_den_enchofu_h'] = '東京都立田園調布高校';
		lang_sName['l_hachioji_soushi'] = '東京都立八王子桑子高校';
		lang_sName['l_Kagakugijyutu_h'] = '東京都立科学技術高校';
		lang_sName['t_katsushikasogo_h'] = '東京都立葛飾総合高校';
		lang_sName['t_kirigaoka_h'] = '東京都立桐ヶ丘高校';
		lang_sName['l_kitatoshimakogyo_h'] = '東京都立北豊島工業高校';
		lang_sName['l_kuramaekogyo_h'] = '東京都立蔵前工業高校';
		lang_sName['l_Machidakogyo_h'] = '東京都立町田工業高校';
		lang_sName['l_Nerimakogyo_h'] = '東京都立練馬工業高校';
		lang_sName['l_Sumidakogyo_h'] = '東京都立隅田工業高校';
		lang_sName['l_mtama_h'] = '東京都立多摩高校';
		lang_sName['l_tama_st_h'] = '東京都立多摩科学技術高校';
		lang_sName['l_Tamakogyo_h'] = '東京都立多摩工業高校';
		lang_sName['l_Tanashikogyo_h'] = '東京都立田無工業高校';
		lang_sName['t_toyama_h'] = '東京都立戸山高校';
		lang_sName['t_yashio_h'] = '東京都立八潮高校';
		lang_sName['l_030000049bc2'] = '神応小学校';
		lang_sName['t_setagaya_sogo_h'] = '都立世田谷総合高校';
		lang_sName['o_hadano_y_center'] = '表丹沢野外活動センター';
		lang_sName['l_Minamiosawa'] = '首都大学東京_南大沢キャンパス';
		lang_sName['o_hadano_city_hall'] = '秦野市役所西庁舎';
		lang_sName['o_hadano_firestation'] = '秦野市消防署鶴巻分署';
		lang_sName['l_030000049c92'] = '奈良先端科学技術大学院<br>大学　情報科学研究科';
		lang_sName['l_f_t_i_branch_office'] = '鳥取市役所福部支所';
		lang_sName['l_tottori_ekinan_city_hall'] = '鳥取駅南シティホール';
		lang_sName['l_NorthBuilding_indoor'] = '鳥取環境大';
		lang_sName['l_m_t_i_branch_office'] = '鳥取市役所用瀬支所';
		lang_sName['l_s_t_i_branch_office'] = '鳥取市役所佐治支所';
		lang_sName['l_k_t_i_branch_office'] = '鳥取市役所金高支所';
		lang_sName['l_a_t_i_b_office'] = '鳥取市役所青谷支所';
		lang_sName['k_s_j_h_s'] = '庄中学校';
		lang_sName['k_m_h_j_h_school'] = '真備東中学校';
		lang_sName['k_mabi_shisho'] = '倉敷市真備支所';
		lang_sName['k_kurese_elementary_school'] = '呉妹小学校';
		lang_sName['k_t_h_j_high_school'] = '北中学校';
		lang_sName['k_h_j_h_school'] = '東中学校';
		lang_sName['k_nis_jur_h_school'] = '西中学校';
		lang_sName['k_minami_junior_high_school'] = '南中学校';
		lang_sName['k_touyou_junior_high_school'] = '東陽中学校';
		lang_sName['k_tatsumi_junior_high_school'] = '多津美中学校';
		lang_sName['k_shinden_junior_high_school'] = '新田中学校';
		lang_sName['k_ku_daii_junior_high_school'] = '倉敷第一中学校';
		lang_sName['k_funaho_junior_high_school'] = '船穂中学校';
		lang_sName['k_gounai_junior_high_school'] = '郷内中学校';
		lang_sName['k_fukuda_junior_high_school'] = '福田中学校';
		lang_sName['k_mizushima_shisho'] = '水島支所';
		lang_sName['k_turajima_junior_high_school'] = '連島中学校';
		lang_sName['k_tam_kita_junior_high_school'] = '玉島北中学校';
		lang_sName['k_taa_higashi_jo_high_school'] = '玉島東中学校';
		lang_sName['k_taa_nii_ju_high_school'] = '玉島西中学校';
		lang_sName['k_sami_elementary_school'] = '沙美小学校';
		lang_sName['k_nanpo_elementary_school'] = '南浦小学校';
		lang_sName['k_shonen_shizennoie'] = '少年自然の家';
		lang_sName['k_kotoura_junior_high_school'] = '琴浦中学校';
		lang_sName['k_ajino_junior_high_school'] = '味野中学校';
		lang_sName['k_shimotsui_junior_high_school'] = '下津井中学校';
		lang_sName['l_03000006ac52'] = '広島大学附属福山中・高等学校';
		lang_sName['h_higashi_hiroshima_campus'] = '広島大学<br>情報メディア教育研究センター';
		lang_sName['l_03000004a442'] = '広島大学大学院教育科学研究科';
		lang_sName['l_hiroshima_city_university'] = '広島市立大学';
		lang_sName['l_03000005c2f2'] = '広島市立大学情報処理センター';
		lang_sName['l_hiroshima_children_museum'] = 'こども文化科学館';
		lang_sName['l_03000004a472'] = '広島大学法科大学院（大学院法務研究科）';
		lang_sName['h_kasumi_campus'] = '広島大学附属図書館医学分館';
		lang_sName['l_hiroshima_municipal_tech_hs'] = '広島市立広島工業高校';
		lang_sName['l_03000005bcf2'] = '広島市立広島工業高校2';
		lang_sName['l_03000004a0d2'] = '広島大学大学院理学研究科附属宮島自然植物実験所';
	}
	if(lang == "en"){
		lang_sName["s_mito01"] = "ART TOWER MITO";
		lang_sName["l_ano"] = "Asupa Nihonbashi office";
		lang_sName["l_kashiwanoha_h"] = "Chiba Prefectural Kashiwanoha Senior HighSchool";
		lang_sName["d_dsi_demo"] = "DSI Demo";
		lang_sName["d_dsi_demo2"] = "DSI Demo2";
		lang_sName["l_Ehome"] = "Demo3";
		lang_sName["t_MtFuji_A"] = "Foot of Mt.Fuji A-1";
		lang_sName["t_MtFuji_B"] = "Foot of Mt.Fuji A-2";
		lang_sName["t_MtFuji_C"] = "Foot of Mt.Fuji A-3";
		lang_sName["l_sci_hokudai"] = "Graduate School of Science, Hokkaido university";
		lang_sName["l_IitateVillage"] = "IitateVillage-5";
		lang_sName["l_1_itc_u_tokyo"] = "Information Technology Center, The University of Tokyo";
		lang_sName["l_otsuchi_u_tokyo"] = "International Coastal Research Center, Atmosphere and Ocean Research Institute, The University of Tokyo";
		lang_sName["l_O_buiding"] = "KEIO UNIVERSITY K2 TOWN CAMPUS";
		lang_sName["l_hiyoshi"] = "Keio University Hiyoshi Campus RF";
		lang_sName["l_krupp_solar"] = "Krupp Hall, Sophia University";
		lang_sName["m_Musashi_HighSchool"] = "Musashi Senior HighSchool";
		lang_sName["l_iizuka_naudata"] = "NaU Data Institute Inc.";
		lang_sName["l_nayoro_star"] = "Nayoro Observatory";
		lang_sName["l_nerimakogyo_h_ClassRoom"] = "Nerima Technical High School (Class Room)";
		lang_sName["l_2_itc_u_tokyo"] = "No.1, Koganei Campus, Tokyo University of Agriculture and Technology";
		lang_sName["l_1_cf_u_tokyo"] = "No.1, University Forest in Chichibu, The University of Tokyo";
		lang_sName["l_2_cf_u_tokyo"] = "No.2, University Forest in Chichibu, The University of Tokyo";
		lang_sName["l_PP_AngkornetISP"] = "Phunon Penh";
		lang_sName["l_sophia_krupp2"] = "Sophia.krupp2";
		lang_sName["l_sophia_sj2"] = "Sophia.sj2";
		lang_sName["l_T_Residence"] = "T-Residence";
		lang_sName["l_kashiwa_u_tokyo"] = "The University of Tokyo Kashiwa Campus";
		lang_sName["l_komaba2_u_tokyo"] = "The University of Tokyo Komaba2 Campus";
		lang_sName["l_fm_a_u_tokyo"] = "The University of Tokyo Tanashi Campus";
		lang_sName["l_030000127312"] = "Tokyo Metropolitan Kasai Technical High School";
		lang_sName["l_titech_tsubame"] = "Tokyo Institute of Technology TSUBAME";
		lang_sName["l_akirudai"] = "Tokyo Metropolitan Akirudai High School";
		lang_sName["t_den_enchofu_h"] = "Tokyo Metropolitan Den-encyofu High School";
		lang_sName["l_hachioji_soushi"] = "Tokyo Metropolitan Hachioji-soushi High School";
		lang_sName["l_Kagakugijyutu_h"] = "Tokyo Metropolitan High School of Science and Technology";
		lang_sName["t_katsushikasogo_h"] = "Tokyo Metropolitan Katsushika Sogo High School";
		lang_sName["t_kirigaoka_h"] = "Tokyo Metropolitan Kirigaoka High School";
		lang_sName["l_kitatoshimakogyo_h"] = "Tokyo Metropolitan Kitatoshima Technical High School";
		lang_sName["l_kuramaekogyo_h"] = "Tokyo Metropolitan Kuramae Technical High School";
		lang_sName["l_Machidakogyo_h"] = "Tokyo Metropolitan Machida Technical High School";
		lang_sName["l_Nerimakogyo_h"] = "Tokyo Metropolitan Nerima Technical High School";
		lang_sName["l_Sumidakogyo_h"] = "Tokyo Metropolitan Sumida Technical High School";
		lang_sName["l_mtama_h"] = "Tokyo Metropolitan Tama High School";
		lang_sName["l_tama_st_h"] = "Tokyo Metropolitan Tama High School of Science and Technology";
		lang_sName["l_Tamakogyo_h"] = "Tokyo Metropolitan Tama Technical High School";
		lang_sName["l_Tanashikogyo_h"] = "Tokyo Metropolitan Tanashi Technical High School";
		lang_sName["t_toyama_h"] = "Tokyo Metropolitan Toyama High School";
		lang_sName["t_yashio_h"] = "Tokyo Metropolitan Yshio High School";
		lang_sName['l_030000049bc2'] = 'Shinno elementary shcool';
		lang_sName['t_setagaya_sogo_h'] = 'Tokyo Metropolitan Setagaya Sogo High School';
		lang_sName['o_hadano_y_center'] = 'Omote tanzawa outdoor activity center';
		lang_sName['l_Minamiosawa'] = 'TMU(Minamiosawa)';
		lang_sName['o_hadano_city_hall'] = 'Hadano city hall(west buil.)';
		lang_sName['o_hadano_firestation'] = 'Hadano Fire station Tsurumaki branch';
		lang_sName['l_030000049c92'] = 'Nara Institute of Science and Technology';
		lang_sName['l_f_t_i_branch_office'] = 'Tottori City Fukube Town Integrated Branch Office';
		lang_sName['l_tottori_ekinan_city_hall'] = 'Tottori Eki-Nan City Hall';
		lang_sName['l_NorthBuilding_indoor'] = 'Tottori University of Environmental Studies, North Building, Indoor';
		lang_sName['l_m_t_i_branch_office'] = 'Tottori City Mochigase Town Integrated Branch Office';
		lang_sName['l_s_t_i_branch_office'] = 'Tottori City Saji Town Integrated Branch Office';
		lang_sName['l_k_t_i_branch_office'] = 'Tottori City Kedaka Town Integrated Branch Office';
		lang_sName['l_a_t_i_b_office'] = 'Tottori City Aoya Town Integrated Branch Office';
		lang_sName['k_s_j_h_s'] = 'Sho junior high school';
		lang_sName['k_m_h_j_h_school'] = 'Makibi higashi junior high school';
		lang_sName['k_mabi_shisho'] = 'Kurashiki Mabi shisho';
		lang_sName['k_kurese_elementary_school'] = 'Kurese elementary school';
		lang_sName['k_t_h_j_high_school'] = 'Kita junior high school';
		lang_sName['k_h_j_h_school'] = 'Higashi junior high school';
		lang_sName['k_nis_jur_h_school'] = 'Nishi junior high school';
		lang_sName['k_minami_junior_high_school'] = 'Minami junior high school';
		lang_sName['k_touyou_junior_high_school'] = 'Touyou junior high school';
		lang_sName['k_tatsumi_junior_high_school'] = 'Tatsumi junior high school';
		lang_sName['k_shinden_junior_high_school'] = 'Shinden junior high school';
		lang_sName['k_ku_daii_junior_high_school'] = 'Kurashiki daiichi junior high school';
		lang_sName['k_funaho_junior_high_school'] = 'funaho junior high school';
		lang_sName['k_gounai_junior_high_school'] = 'Gounai junior high school';
		lang_sName['k_fukuda_junior_high_school'] = 'fukuda junior high school';
		lang_sName['k_mizushima_shisho'] = 'Mizushima shisho';
		lang_sName['k_turajima_junior_high_school'] = 'Turajima junior high school';
		lang_sName['k_tam_kita_junior_high_school'] = 'Tamashima kita junior high school';
		lang_sName['k_taa_higashi_jo_high_school'] = 'Tamashima higashi junior high school';
		lang_sName['k_taa_nii_ju_high_school'] = 'Tamashima nishi junior high school';
		lang_sName['k_sami_elementary_school'] = 'Sami elementary school';
		lang_sName['k_nanpo_elementary_school'] = 'Nanpo elementary school';
		lang_sName['k_shonen_shizennoie'] = 'Shonen shizennoie';
		lang_sName['k_kotoura_junior_high_school'] = 'Kotoura junior high school';
		lang_sName['k_ajino_junior_high_school'] = 'Ajino junior high school';
		lang_sName['k_shimotsui_junior_high_school'] = 'Shimotsui junior high school';
		lang_sName['l_03000006ac52'] = 'Fukuyama secondary school attached a university of Hiroshima';
		lang_sName['h_higashi_hiroshima_campus'] = 'Information Media Center, Hiroshima University';
		lang_sName['l_03000004a442'] = 'Graduate School of pedagogy, The University of Hiroshima';
		lang_sName['l_hiroshima_city_university'] = 'Hiroshima City University';
		lang_sName['l_03000005c2f2'] = 'Data processing center, Hiroshima city university';
		lang_sName['l_hiroshima_children_museum'] = 'Hiroshima Childrens Museum';
		lang_sName['l_03000004a472'] = 'Graduate School of law, The University of Hiroshima';
		lang_sName['h_kasumi_campus'] = 'Medical Science Branch Library, Hiroshima University';
		lang_sName['l_hiroshima_municipal_tech_hs'] = 'Hiroshima Municipal Technical High School';
		lang_sName['l_03000005bcf2'] = 'Hiroshima municipal Hiroshima industrial high school';
		lang_sName['l_03000004a0d2'] = 'Miyajima Natural Botanical Garden, Hiroshima University';
		lang_sName['i_building7'] = 'Inria Paris - Rocquencourt';
	}
	return lang_sName;
}