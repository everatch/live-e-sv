<body>
  
<div id="sensor_change" style="display:none" onClick="document.getElementById('sensor_change').style.display='none';">
	<div id="sensor_button_">
    	<?php
            $echo_dush = '"';
			for($i=0;$i<count($sensorlist);$i++){
				echo "<a href=".$echo_dush."index.php?sID=".$sensorlist[$i].$echo_dush."><div id=".$echo_dush.$sensorlist[$i].$echo_dush." class=".$echo_dush."lang_button dark".$echo_dush." onMouseOver=".$echo_dush."lang_button('".$sensorlist[$i]."');".$echo_dush." onMouseOut=".$echo_dush."lang_button('".$sensorlist[$i]."');".$echo_dush." onClick='CookieWrite(".$echo_dush."sID".$echo_dush.",".$echo_dush.$sensorlist[$i].$echo_dush.");' style=".$echo_dush."color:rgb(255,255,255); cursor:pointer;".$echo_dush.">
	".$lang_sName[$sensorlist[$i]]."
</div></a>
";
			}
		?>
    </div>
</div>

<!----facebook---->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


    
			<script type="text/javascript">
			<!--
				/*JavaScriptの関数を読み取る*/
				block(input);
				none(input);
				lang_button(input);
				button_over(input);
				button_out(input);
				button_click(input);
				get_time();
			// -->
			</script>
<!----bar----->
<div id="bar">
	<div id="bar_">
    <!----現在の言語＆言語リスト---->
		<?php include ("contents/con_top_bar.php");?>
    </div>
</div>

<!----header & menu----->
<div id="header">
	<div id="logo">
    	<a href="index.php">
        	<?php include "contents/logo.php"; ?>
        </a>
	</div>
	<div id="l_menu">
		<?php
			include "contents/left_menu.php";
			show_left_menu("a",$lang,$sensor);
		?>
    </div>
</div>
<!----content----->
<div id="content">

<!----content_top----->
	<div id="content_top" class="appear">
    
    	
        
<div id="buttons"> 
   
<!----facebook----->
    <div class="fb-like" data-href="http://www.live-e-sv.info/" data-send="true" data-layout="button_count" data-width="450" data-show-faces="true" data-font="arial"></div>
    
    &nbsp;&nbsp;
<!----twitter----->
    <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.live-e-sv.info/" data-lang="ja">ツイート</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<!----google----->
<!-- head 内か、body 終了タグの直前に次のタグを貼り付けてください。 -->
<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
  {lang: 'ja'}
</script>

<!-- +1 ボタン を表示したい位置に次のタグを貼り付けてください。 -->
<div class="g-plusone" data-size="medium" data-href="http://www.live-e-sv.info/"></div>
                
</div>

        
        
    	<div id="sensor" class="radius">
        	<sensorid>
        	Sensor ID : <?php echo $sensorId[$sensor];?>&nbsp;&nbsp;
            </sensorid>
            <h1>
                       
			<?php
				include "contents/seo.php";
				echo $lang_sName[$sensor]."<br/>";
			?>
            
            <img src='img/change_s_u.png' alt='Change the sensor' onMouseOver="this.src='img/change_s_c.png'" onMouseOut="this.src='img/change_s_u.png'" onClick="document.getElementById('sensor_change').style.display='block';" style="cursor:pointer;"></img>
            
            <?php
				if(!@$dataArray['time']){@$dataArray['time'] = date("Y/m/d H:i:s");}
				echo "<h1_>&nbsp;Data on ".$dataArray['time']."  </h1_>";
			?>
            </h1>
            
            <ul>
			<?php
				echo $lang_temp." :&nbsp;&nbsp;&nbsp;";
			?>
            	<data>
				<?php
					echo $dataArray['temp']."&nbsp;℃";
				?>
                </data>
            </ul>
            <ul>
			<?php
				echo $lang_humi." :&nbsp;&nbsp;&nbsp;";
			?>
            	<data>
				<?php
					echo $dataArray['humi']."&nbsp;%";
				?>
                </data>
            </ul>
            <ul>
			<?php
				echo $lang_pres." :&nbsp;&nbsp;&nbsp;";
			?>
            	<data>
				<?php
					echo $dataArray['pres']."&nbsp;hPa";
				?>
                </data>
            </ul>
            <ul>
			<?php
				echo $lang_prec." :&nbsp;&nbsp;&nbsp;";
			?>
            	<data>
				<?php
				echo $dataArray['rainFall']."&nbsp;mm/h";
				?>
                </data>
            </ul>
            <ul>
			<?php
				echo $lang_win_dir." :&nbsp;&nbsp;&nbsp;";
			?>
            	<data>
				<?php
					echo $dataArray['windDir']."&nbsp;°";
				?>
                </data>
            </ul>
            <ul>
			<?php
				echo $lang_win_spe." :&nbsp;&nbsp;&nbsp;";
			?>
            	<data>
				<?php
					echo $dataArray['windSpe']."&nbsp;m/s";
				?>
            	</data>
            </ul>
        </div>

    	<div id="clock">
       		<div id="clock_date"></div>
        	<div id="clock_time">
        		<div id="am_pm"></div>
        		<div id="seconds"></div>
        		<div id="minutes"></div>
                <div id="colon"></div>
        		<div id="hours"></div>
            </div>
        </div>

	<script type="text/javascript">
    function change_form(oldform){
		var newform = "twitter";
		if(newform == oldform) newform = "original";
		document.getElementById(newform).style.display='none';
		document.getElementById(oldform).style.display='block';
	}
    </script>
	<div id="change_twitter" style="width:275px; position:relative; float:right; right:6px; background-color:rgba(255,255,255,0.5); padding:15px 5px;">
        <input type="radio" name="con_select" value="original" onChange="change_form('original');" checked> Original
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="con_select" value="twitter" onChange="change_form('twitter');"> Twitter
    </div>

        <div id="twitter" class="radius">
<!----twitter----->
        	<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
			<script>
				new TWTR.Widget({
					version: 2,
					type: 'profile',
					rpp: 5,
					interval: 30000,
					width: 'auto',
					height:460,
					theme: {
						shell: {
							background: '#cbe7fa',
							color: '#ffffff'
						},
						tweets: {
							background: '#ebf5ff',
							color: '#28a837',
							links: '#229dd6'
						}
					},
					features: {
						scrollbar: true,
						loop: false,
						live: true,
						behavior: 'default'
					}
				}).render().setUser('kashiwanoha_hs').start();
			</script>
        </div>
<!----/twitter----->
<!----original----->
        <div id="original">
			<script charset="utf-8" src="http://www.live-e-sv.info/developers/api/js/sensors.js"></script>
            <script charset="utf-8" src="http://www.live-e-sv.info/developers/api/data_show.js"></script>
            <script>
                new sv_showForm(
				"<?php echo $lang_sName[$sensor]; ?>",
                "<?php echo $lang; ?>",/*language(jp/en) default:jp*/
                "<?php echo $sensor; ?>",/*sensor id*/
                24,/*number of data(3~24)*/
                285,/*width(235-300)*/
                600,/*height(300-800)*/
				"rgba(0,0,0,0.4)",/*back color top*/
				"rgba(255,255,255,1)",/*text color top*/
				"rgba(0,0,0,0.4)",/*back color bottom*/
				"rgba(255,255,255,1)",/*text color bottom*/
                "rgba(0,0,0,0.3)",/*back color 1*/
                "rgba(0,0,0,0.4)",/*back color 2*/
				"rgba(255,255,255,1)"/*text colorm*/
            );
            </script>
        </div>
<!----/original----->
	</div>
</div>
<!----footer----->
<?php
	include "contents/foot.php";
?>
<!----/footer----->

<div id="return_to_mobile" style="display:none" onClick="location.href='mobile/index.php';CookieWrite('pc','false');">
	Return to Mobile
</div>

</body>
