    <div id="bar_lang" onMouseOver="block('lang_menu');none('style_menu');" onClick="show('lang_menu');" style="cursor: default">
    	<?php
            echo '| <h class="fontf">'.$lang_lang.'</h>';
			if ($lang){
				$str = '<img src="img/coun/'.$lang.'.gif"></img> |';
			}else if (isset($_GET['lang'])){
				$str = '<img src="img/coun/'.$lang.'.gif"></img> |';
			}else{
				$str = '<img src="img/coun/jp.gif"></img> |';
			}
			echo $str;
		?>
        <div id="lang_menu" class="close" onMouseOut="none('lang_menu');">
			<?php
				if($lang != "jp"){
			?>
			<div id="jp" class="lang_button dark" onMouseOver="lang_button('jp');" onMouseOut="lang_button('jp');" onClick="CookieWrite('lang','jp'); location.reload();" style="color:rgb(255,255,255); cursor:pointer;">
				日本語 <img src="img/coun/jp.gif" border="0"></img>
			</div>
			<?php
				}
				if($lang != "en"){
			?>
			<div id="en" class="lang_button dark" onMouseOver="lang_button('en');" onMouseOut="lang_button('en');" onClick="CookieWrite('lang','en'); location.reload();" style="color:rgb(255,255,255); cursor:pointer;">
        		English <img src="img/coun/en.gif" border="0"></img>
            </div>
        	<?php
				}
				if($lang != "kr"){
        	?>
			<div id="kr" class="lang_button dark" onMouseOver="lang_button('kr');" onMouseOut="lang_button('kr');" onClick="CookieWrite('lang','kr'); location.reload();" style="color:rgb(255,255,255); cursor:pointer;">
        		한국어 <img src="img/coun/kr.gif" border="0"></img>
			</div>
            <?php
				}
				if($lang != "sc"){
        	?>
			<div id="sc" class="lang_button dark" onMouseOver="lang_button('sc');" onMouseOut="lang_button('sc');" onClick="CookieWrite('lang','sc'); location.reload();" style="color:rgb(255,255,255); cursor:pointer;">
        		中文 <img src="img/coun/sc.gif" border="0"></img>
			</div>
       		<?php
				}
			?>
        </div>
	</div>
    
    <?php
		$num_style = 1;
		while($num_style<99){
			$style_file = "templates/".$num_style."/info.php";
			if(!file_exists($style_file)){
				break;
			}
			
			$num_style++;
		}
	?>
    <div id="bar_style" onMouseOver="block('style_menu');none('lang_menu');" onClick="show('style_menu');">
    	| <h class="fontf" style="cursor: default">Change the Style</h>&nbsp;
        <div id="style_menu" class="close" onMouseOut="none('style_menu');">
            
            <?php
				$echo_1 = '"';
				if(@$style){
					echo "<div id=".$echo_1."default".$echo_1." style=".$echo_1."color:rgb(255,255,255); cursor:pointer;".$echo_1." class=".$echo_1."lang_button dark".$echo_1." onMouseOver=".$echo_1."lang_button('default');".$echo_1." onMouseOut=".$echo_1."lang_button('default');".$echo_1." onClick=".$echo_1."CookieWrite('style','0');location.reload();".$echo_1.">Default</div>";
				}
				for($i=1;$i<$num_style;$i++){
					if(@$style != $i){
						include_once ("templates/".$i."/info.php");
						$html = "<div id=".$echo_1.$style_name.$echo_1." style=".$echo_1."color:rgb(255,255,255); cursor:pointer;".$echo_1." class=".$echo_1."lang_button dark".$echo_1." onMouseOver=".$echo_1."lang_button('".$style_name."');".$echo_1." onMouseOut=".$echo_1."lang_button('".$style_name."');".$echo_1." onClick=".$echo_1."CookieWrite('style','".$i."');location.reload();".$echo_1.">
		".$style_name;
						if($mini_logo){
							$html = $html.'&nbsp;<img src="'.$mini_logo.'" width="17" height="17" style="position:relative; top:2px; border-radius:0.3em; border:solid 0px rgb(255,255,255);"></img>';
						}
						$html = $html."
	</div>";
						echo $html;
					}
				}
			?>
    	
        </div>
    </div>
    
    <div id="bar_mobile" onClick="CookieWrite('pc','false'); location.href='mobile/index.php'" style="display:none;">
    	| <h class="fontf">Mobile page</h>&nbsp;
        </div>
    </div>