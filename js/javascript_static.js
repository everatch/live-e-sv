function none(input) {
	var objID=document.getElementById( input );
	objID.style.display='none';
}
				
function block(input) {
	var objID=document.getElementById( input );
	objID.style.display='block';
}

function show(input) {
	var objID=document.getElementById( input );
	if(objID.className=='close') {
		objID.style.display='block';
		objID.className='open';
	}else{
		objID.style.display='none';
		objID.className='close';
	}
}

function lang_button(input) {
	var objID=document.getElementById( input );
	if(objID.className=='lang_button dark') {
		objID.style.background="rgba(172,172,172,1)";
		objID.style.color="rgb(30,30,30)";
		objID.className='lang_button light';
	}else{
		objID.style.background="rgba(172,172,172,0)";
		objID.style.color="rgb(255,255,255)";
		objID.className='lang_button dark';
	}
}

function button_over(input) {
	var objID=document.getElementById( input );
	if(objID.className=='menu_button off') {
		objID.style.background="rgba(0,0,0,0.3)";
		objID.style.color="rgb(235,235,235)";
		objID.style.textShadow=" 0 0 2px rgb(235,235,235)";
		objID.className='menu_button on';
	}else if(objID.className=='menu_button click'){
		objID.style.background="rgba(0,0,0,0.5)";
		objID.style.color="rgb(235,235,235)";
		objID.style.textShadow=" 0 0 2px rgb(235,235,235)";
		objID.className='menu_button clicks';
	}
}
function button_out(input) {
	var objID=document.getElementById( input );
	if(objID.className=='menu_button on') {
		objID.style.background='rgba(0,0,0,0)';
		objID.style.color="rgb(92,92,92)";
		objID.style.textShadow=" 0 0 2px rgb(92,92,92)";
		objID.className='menu_button off';
	}else if(objID.className=='menu_button clicks'){
		objID.style.background="rgba(0,0,0,0.3)";
		objID.style.color="rgb(235,235,235)";
		objID.style.textShadow=" 0 0 2px rgb(235,235,235)";
		objID.className='menu_button click';
	}
}
function button_click(input) {
	if(document.getElementById("a").className=='menu_button click'){
		document.getElementById("a").style.background='rgba(0,0,0,0)';
		document.getElementById("a").style.color="rgb(92,92,92)";
		document.getElementById("a").style.textShadow=" 0 0 2px rgb(92,92,92)";
		document.getElementById("a").className='menu_button off';
	}else if(document.getElementById("b").className=='menu_button click'){
		document.getElementById("b").style.background='rgba(0,0,0,0)';
		document.getElementById("b").style.color="rgb(92,92,92)";
		document.getElementById("b").style.textShadow=" 0 0 2px rgb(92,92,92)";
		document.getElementById("b").className='menu_button off';
	}else if(document.getElementById("c").className=='menu_button click'){
		document.getElementById("c").style.background='rgba(0,0,0,0)';
		document.getElementById("c").style.color="rgb(92,92,92)";
		document.getElementById("c").style.textShadow=" 0 0 2px rgb(92,92,92)";
		document.getElementById("c").className='menu_button off';
	}else if(document.getElementById("d").className=='menu_button click'){
		document.getElementById("d").style.background='rgba(0,0,0,0)';
		document.getElementById("d").style.color="rgb(92,92,92)";
		document.getElementById("d").style.textShadow=" 0 0 2px rgb(92,92,92)";
		document.getElementById("d").className='menu_button off';
	}
	
	var objID=document.getElementById( input );
	if(objID.className=='menu_button on') {
		objID.style.background="rgba(0,0,0,0.5)";
		objID.style.color="rgb(235,235,235)";
		objID.style.textShadow=" 0 0 2px (235,235,235)";
		objID.className='menu_button clicks';
	}else if(objID.className=='menu_button click'){
		objID.style.background="rgba(0,0,0,0.2)";
		objID.style.color="rgb(235,235,235)";
		objID.style.textShadow=" 0 0 2px (235,235,235)";
		objID.className='menu_button click';
	}
}
function content_show(input) {
	if(document.getElementById("content_top").style.display='block'){
		document.getElementById("content_top").style.display='none';
	}
	if(document.getElementById("content_gomap").style.display='block'){
		document.getElementById("content_gomap").style.display='none';
	}
	if(document.getElementById("content_graph").style.display='block'){
		document.getElementById("content_graph").style.display='none';
	}if(document.getElementById("content_about").style.display='block'){
		document.getElementById("content_about").style.display='none';
	}
	
	var objID=document.getElementById( input );
	if(objID.style.display='none') {
		objID.style.display='block';
	}else{
		
	}
}



function getKey(key){
	var str=location.search.substring(1);
	if(str){
		var x=str.split("&");
		for(var i=0;i<x.length;i++){
			var y=x[i].split("=");
			if(y[0]==key) return y[1];
		}
		return "";
	}else{
		return "";
	}
}
window.onload=function(){
	var language = getKey("lang");
	if(language == "jp"){
		document.body.style.fontFamily='"ＨＧゴシックＥ", "ＭＳ ゴシック", "MS Gothic", "Osaka－等幅", Osaka-mono, monospace';
	}else if(language == "en"){
		document.body.style.fontFamily='Verdana, Geneva, sans-serif';
	}else if(language == "kr"){
		document.body.style.fontFamily=' Tahoma, Geneva, sans-serif';
	}else if(language == "sc"){
		document.body.style.fontFamily='"宋体", NSimSun, Hei, sans-serif';
	}else{
		document.body.style.fontFamily='"ＨＧゴシックＥ", "ＭＳ ゴシック", "MS Gothic", "Osaka－等幅", Osaka-mono, monospace';
	}
}