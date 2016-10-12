function get_time() {
	var now = new Date();
	var year = now.getFullYear();
	var month = now.getMonth();
	var date = now.getDate();
	var day = now.getDay();
	var hours = now.getHours();
	var minutes = now.getMinutes();
	var seconds = now.getSeconds();
	var am_pm = "a.m.";

	month = month + 1;

	if(hours == 12 && minutes == 0) {
		document.getElementById( "am_pm" ).style.fontSize = "25px";
		am_pm = "noon";
	}

	if(hours == 24 && minutes == 0) {
		hours = 0;
		document.getElementById( 'am_pm' ).style.fontSize = "22px";
		am_pm = "mid<br/>night";
	}else if(hours > 12) {
		hours = hours - 12;
		am_pm = "p.m.";
	}

	if(hours == 12 && minutes > 0) {
		hours = hours - 12;
		am_pm = "p.m.";
	}

	if(hours < 10) {
		hours = "0" + hours;
	}

	if(minutes < 10) {
		minutes = "0" + minutes;
	}

	if(seconds < 10) {
		seconds = "0" + seconds;
	}
	
	var language = CookieRead("lang");
	if(language == "jp"){
		var jp_day = new Array("日曜日","月曜日","火曜日","水曜日","木曜日","金曜日","土曜日");
		day = jp_day[day];
	}else if(language == "en"){
		var en_day = new Array("Sun","Mon","Tue","Wed","Thu","Fri","Sat");
		day = en_day[day];
	}else if(language == "kr"){
		var kr_day = new Array("일요일","월요일","화요일","수요일","목요일","금요일","토요일");
		day = kr_day[day];
	}else if(language == "sc"){
		var sc_day = new Array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
		day = sc_day[day];
	}else{
		var jp_day = new Array("日曜日","月曜日","火曜日","水曜日","木曜日","金曜日","土曜日");
		day = jp_day[day];
	}

	document.getElementById("clock_date").innerHTML = year + "." + month + "." + date + " " + day;

	document.getElementById("am_pm").innerHTML = am_pm;
	document.getElementById("hours").innerHTML = hours;
	document.getElementById("minutes").innerHTML = minutes;
	document.getElementById("seconds").innerHTML = seconds + "&nbsp;";
	document.getElementById("colon").innerHTML = ":";
	setTimeout(function(){ document.getElementById("colon").innerHTML = "&nbsp;"; },500);

	setTimeout("get_time();", 1000);
}

window . onload = get_time;