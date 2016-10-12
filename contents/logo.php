<dir id="logo_img" style="background-image:url('<?php
	if(@$_COOKIE["style"]){	
		$style = $_COOKIE["style"];
		$style_logo_path = "templates/".$style."/img/logo.png";
		if(@file_exists($style_logo_path)){
			echo "templates/".$style."/img/logo.png";
		}else{ echo 'img/logo.png'; }
	}else{ echo 'img/logo.png'; }
	?>');">
    <dir id="logo_text">
		<?php echo $lang_school; ?>
    </dir>
</dir>