function api_1(type){
	var tittle = document.set_api1.tittle.value;
	var sensor = document.set_api1.sensor.value;
	var width = document.set_api1.width.value;
	var height = document.set_api1.height.value;
	var datas = document.set_api1.datas.value;
	var bc_t = document.set_api1.bc_t.value;
	var tc_t = document.set_api1.tc_t.value;
	var bc_b = document.set_api1.bc_b.value;
	var tc_b = document.set_api1.tc_b.value;
	var bc_1 = document.set_api1.bc_1.value;
	var bc_2 = document.set_api1.bc_2.value;
	var tc = document.set_api1.tc.value;
	for(var i=0;i<document.getElementsByName("language").length;i++){
		if (document.getElementsByName("language")[i].checked) {
				var language = document.getElementsByName("language")[i].value;
		}
	}
	
	if(!tittle){
		tittle = "Tittle";
	}
	if(!width){
		width = 285;
	}
	if(!height){
		height = 520;
	}
	if(!datas){
		datas = 20;
	}
	if(!bc_t){
		bc_t = "rgba(0,0,0,0.4)";
	}
	if(!tc_t){
		tc_t = "rgba(255,255,255,1)";
	}
	if(!bc_b){
		bc_b = "rgba(0,0,0,0.4)";
	}
	if(!tc_b){
		tc_b = "rgba(255,255,255,1)";
	}
	if(!bc_1){
		bc_1 = "rgba(0,0,0,0.5)";
	}
	if(!bc_2){
		bc_2 = "rgba(0,0,0,0.4)";
	}
	if(!tc){
		tc = "rgba(255,255,255,1)";
	}
	
	var recode = sv_showForm(tittle,language,sensor,datas,width,height,bc_t,tc_t,bc_b,tc_b,bc_1,bc_2,tc,"recode");
	
	document.getElementById("sample_form").innerHTML=recode;
	
	if(type == "code"){
		document.getElementById("review").innerHTML= '<textarea name="code" rows="12" cols="42" readonly style="color:rgba(0,0,0,0.35);"><script charset="utf-8" src="http://www.live-e-sv.info/developers/api/js/sensors.js"></script><script charset="utf-8" src="http://www.live-e-sv.info/developers/api/data_show.js"></script><script>new sv_showForm("'+tittle+'","'+language+'","'+sensor+'",'+datas+','+width+','+height+',"'+bc_t+'","'+tc_t+'","'+bc_b+'","'+tc_b+'","'+bc_1+'","'+bc_2+'","'+tc+'");</script></textarea>';
	}
}

function api_2(type){
	var sensor = document.set_api2.sensor.value;
	var width = document.set_api2.width.value;
	var bc = document.set_api2.bc.value;
	var bc_1 = document.set_api2.bc_1.value;
	var bc_2 = document.set_api2.bc_2.value;
	var bc_3 = document.set_api2.bc_3.value;
	var bc_4 = document.set_api2.bc_4.value;
	var bc_c = document.set_api2.bc_c.value;
	var tc_1 = document.set_api2.tc_1.value;
	var tc_2 = document.set_api2.tc_2.value;
	var tc_3 = document.set_api2.tc_3.value;
	var tc_4 = document.set_api2.tc_4.value;
	var tc_c = document.set_api2.tc_c.value;

	for(var i=0;i<document.getElementsByName("language_2").length;i++){
		if (document.getElementsByName("language_2")[i].checked) {
				var language = document.getElementsByName("language_2")[i].value;
		}
	}
	
	if(!width){
		width = 223;
	}
	if(!bc){
		bc = "rgba(0,0,0,0.2)";
	}
	if(!bc_1){
		bc_1 = "rgba(0,0,0,0.7)";
	}
	if(!bc_2){
		bc_2 = "rgba(0,0,0,0.2)";
	}
	if(!bc_3){
		bc_3 = "rgba(0,0,0,0.3)";
	}
	if(!bc_4){
		bc_4 = "rgba(0,0,0,0.4)";
	}
	if(!bc_c){
		bc_c = "rgba(255,255,255,0.7)";
	}
	if(!tc_1){
		tc_1 = "rgba(255,255,255,1)";
	}
	if(!tc_2){
		tc_2 = "rgba(10,10,10,1)";
	}
	if(!tc_3){
		tc_3 = "rgba(10,10,10,1)";
	}
	if(!tc_4){
		tc_4 = "rgba(10,10,10,1)";
	}
	if(!tc_c){
		tc_c = "rgba(0,0,0,1)";
	}
	
	var recode = sv_showNowForm(language,sensor,width,0,bc,bc_1,bc_2,bc_3,bc_4,bc_c,tc_1,tc_2,tc_3,tc_4,tc_c,"recode");
	
	document.getElementById("sample_form_2").innerHTML = recode;
	
	if(type == "code"){
		document.getElementById("review_2").innerHTML= '<textarea name="code" rows="12" cols="42" readonly style="color:rgba(0,0,0,0.35);"><script charset="utf-8" src="http://www.live-e-sv.info/developers/api/js/sensors.js"></script><script charset="utf-8" src="http://www.live-e-sv.info/developers/api/data_show.js"></script><script>new sv_showNowForm("'+language+'","'+sensor+'",'+width+',0,"'+bc+'","'+bc_1+'","'+bc_2+'","'+bc_3+'","'+bc_4+'","'+bc_c+'","'+tc_1+'","'+tc_2+'","'+tc_3+'","'+tc_4+'","'+tc_c+'");</script></textarea>';
	}
}