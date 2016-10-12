function getScrollPosition(){	
	var x = document.documentElement.scrollLeft || document.body.scrollLeft;
	var y = document.documentElement.scrollTop  || document.body.scrollTop;
	//var display = document.getElementById("head").style.display;
	var display = "true";
	
	var state = document.getElementById("maps").style.display;
	
	if(state != "block" && y == 0){
		document.getElementById("top").className="show";
		document.getElementById("mirror").className="show";
		display = "true";
	}else if(display == "true" && y >= 50){
		document.getElementById("top").className="hide";
		document.getElementById("mirror").className="hide";
		display = "fulse";
	}
	setTimeout(function(){getScrollPosition()}, 500);
}

function change_content(content){
	var contents = Array("home","maps","logs");
	for(var i=0;i<contents.length;i++){
		document.getElementById(contents[i]).style.display="none";
	}
	document.getElementById("content").className="show";
	document.getElementById("data_form").className="appear";
	document.getElementById("data_time").className="appear";
	document.getElementById("menu").className="show";
	document.getElementById("content").className="show";
	document.getElementById("head").style.display="block";
	document.getElementById(content).style.display="block";
	if(content == "maps"){
		document.getElementById("top").className="hide";
		document.getElementById("content").className="hide";
		initialize();
	}
	if(content == "logs"){
		document.getElementById("data_form").className="disappear";
		document.getElementById("data_time").className="disappear";
		document.getElementById("menu").className="hide_data";
		document.getElementById("content").className="hide_data";
	}
}

function set_province(sele_id){
	var province = Array();
	province[0] = Array("道北","道央","道東","道南");
	province[1] = Array("青森県","秋田県","岩手県","宮城県","山形県","福島県");
	province[2] = Array("静岡県","愛知県","岐阜県","三重県");
	province[3] = Array("富山県","石川県","福井県","新潟県");
	province[4] = Array("茨城県","栃木県","群馬県","埼玉県","東京都","千葉県","神奈川県","長野県","山梨県");
	province[5] = Array("滋賀県","京都府","大阪府","兵庫県","奈良県","和歌山県");
	province[6] = Array("岡山県","広島県","島根県","鳥取県","山口県");
	province[7] = Array("徳島県","香川県","愛媛県","高知県");
	province[8] = Array("福岡県","大分県","長崎県","佐賀県","熊本県","宮崎県","鹿児島県");
	province[9] = Array("沖縄県");
	
	var region = document.default_set.region.value;
	document.default_set.province.options.length =0;
	document.default_set.province.options[0]=new Option("---","---");
	
	for(var i=0;i<province[region].length;i++){
		document.default_set.province.options[i+1]=new Option(province[region][i],i);
	}
	document.default_set.province.selectedIndex=sele_id+1;
}

function set_city(sele_id){
	var city = Array();
	city[0] = Array();
		city[0][0] = Array("稚内","旭川","留萌");
		city[0][1] = Array("札幌","岩見沢","倶知安");
		city[0][2] = Array("網走","北見","紋別","根室","釧路","帯広");
		city[0][3] = Array("室蘭","浦河","函館","江差");
	city[1] = Array();
		city[1][0] = Array("青森","むつ","八戸");
		city[1][1] = Array("秋田","横手");
		city[1][2] = Array("盛岡","宮古","大船渡");
		city[1][3] = Array("仙台","白石");
		city[1][4] = Array("山形","米沢","酒田","新庄");
		city[1][5] = Array("福島","小名浜","若松");
	city[2] = Array();
		city[2][0] = Array("静岡","網代","三島","浜松");
		city[2][1] = Array("名古屋","豊橋");
		city[2][2] = Array("岐阜","高山");
		city[2][3] = Array("津","尾鷲");
	city[3] = Array();
		city[3][0] = Array("富山","伏木");
		city[3][1] = Array("金沢","輪島");
		city[3][2] = Array("福井","敦賀");
		city[3][3] = Array("新潟","長岡","高田","相川");
	city[4] = Array();
		city[4][0] = Array("水戸","土浦");
		city[4][1] = Array("宇都宮","大田原");
		city[4][2] = Array("前橋","みなかみ");
		city[4][3] = Array("さいたま","熊谷","秩父");
		city[4][4] = Array("東京","大島","八丈島","父島");
		city[4][5] = Array("千葉","銚子","館山");
		city[4][6] = Array("横浜","小田原");
		city[4][7] = Array("長野","松本","飯田");
		city[4][8] = Array("甲府","河口湖");
	city[5] = Array();
		city[5][0] = Array("大津","彦根");
		city[5][1] = Array("京都","舞鶴");
		city[5][2] = Array("大阪");
		city[5][3] = Array("神戸","豊岡");
		city[5][4] = Array("奈良","風屋");
	city[6] = Array();
		city[6][0] = Array("岡山","津山");
		city[6][1] = Array("広島","庄原");
		city[6][2] = Array("松江","浜田","西郷");
		city[6][3] = Array("鳥取","米子");
		city[6][4] = Array("下関","山口","柳井","萩");
	city[7] = Array();
		city[7][0] = Array("徳島","日和佐");
		city[7][1] = Array("高松");
		city[7][2] = Array("松山","新居浜","宇和島");
		city[7][3] = Array("高知","室戸","清水");
	city[8] = Array();
		city[8][0] = Array("福岡","八幡","飯塚","久留米");
		city[8][1] = Array("大分","中津","日田","佐伯");
		city[8][2] = Array("長崎","佐世保","厳原","福江");
		city[8][3] = Array("佐賀","伊万里");
		city[8][4] = Array("熊本","阿蘇乙姫","牛深","人吉");
		city[8][5] = Array("宮崎","延岡","都城","高千穂");
		city[8][6] = Array("鹿児島","鹿屋","種子島","名瀬");
	city[9] = Array();
		city[9][0] = Array("那覇","名護","久米島","南大東島","宮古島","石垣島","与那国島");
	
	var region = document.default_set.region.value;
	var province = document.default_set.province.value;
	document.default_set.city.options.length =0;
	document.default_set.city.options[0]=new Option("---","---");
	var id = 0;
	
	for(var i=0;i<=region;i++){
		for(var j=0;j<city[i].length;j++){
			for(var k=0;k<city[i][j].length;k++){
				id++;
				if(i==region && j==province){
					break;
				}
			}
			if(i==region && j==province){
				break;
			}
		}
	}
	for(var i=0;i<city[region][province].length;i++){
		document.default_set.city.options[i+1]=new Option(city[region][province][i],id+i);
	}
			document.default_set.city.selectedIndex=sele_id-id+1;
}