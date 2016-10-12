function CookieWrite(kword, kdata)
{
  if(!navigator.cookieEnabled){
    alert("Can not Write to cookie !");
    return;
  }
  document.cookie = kword + "=" + escape(kdata) + ";expires=Thu, 1-Jan-2030 00:00:00 GMT";// + new Data(2050,1).toGMTString();
}

function CookieRead(kword)
{
  if(typeof(kword) == "undefined")　　// キーワードなし
    return "";        // 何もしないで戻る
  kword = kword + "=";
  kdata = "";
  scookie = document.cookie + ";";　　　　// クッキー情報を読み込む
  start = scookie.indexOf(kword);   　// キーワードを検索
  if (start != -1){    // キーワードと一致するものあり
    end = scookie.indexOf(";", start);    // 情報の末尾位置を検索
    kdata = unescape(scookie.substring(start + kword.length, end));  // データ取り出し
  }
  return kdata;
}

function tpURL()
{
	var lang = CookieRead("lang");
	var sID = CookieRead("sID");
	
	location.href("");
}