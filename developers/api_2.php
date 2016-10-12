<html>
	<body>
        
		<div id="api_2" style="background-color:rgba(255,255,255,1); height:100%; display:none;">
            <div id="api_select">
                <table width="100%">
                	<tr style="font-family:Arial, Helvetica, sans-serif;">
                    	<td width="50%" style="padding:9px 0;text-align:center;background-color:rgba(255,255,255,0.2);cursor:pointer;" onClick="none('api_2');block('api_1');">API 1</td>
                    	<td width="50%" style="padding:9px 0;text-align:center;background-color:rgba(255,255,255,1);cursor:default;">API 2</td>
                    </tr>
                </table>
            </div>
        	<div id="select_2">
            </div>
        	<div id="input_2" style="padding:50px 25px; width:320px; float:left; ackground:rgba(0,0,0,0.1);">
            	<div id="selectform_2">
            		<div style="background:rgb(255,140,50); color:#FFFFFF; padding:5px; font-size:24px;"><?php echo $lang_deve_1_setting; ?></div><br/><br/>
                    <form name="set_api2">
                    <table style="table-layout:fixed; font-family:Arial, Helvetica, sans-serif;" width="350px">
                        <tr>
                            <td width="90px"><?php echo $lang_deve_1_sensor; ?>:</td>
                            <td colspan="2"><select name="sensor" style="width:230px;" onChange="api_2();">
                                <?php
                                for($i=0;$i<count($sensorlist);$i++){
                                    if($sensorlist[$i] == $sensor){
                                        echo '<option value="'.$sensorlist[$i].'" selected>'.$lang_sName[$sensorlist[$i]].'</option>';
                                    }else{echo '<option value="'.$sensorlist[$i].'">'.$lang_sName[$sensorlist[$i]].'</option>';}
                                }
                                ?>
                            </select></td>
                        </tr>
                        <tr>
                            <td><?php echo $lang_deve_1_language; ?>:</td>
                            <td><input type="radio" name="language_2" value="jp" onChange="api_2();" <?php if($lang=="jp") echo "checked"; ?>> <?php echo $lang_deve_1_japanese; ?></td>
                            <td><input type="radio" name="language_2" value="en" onChange="api_2();" <?php if($lang!="jp") echo "checked"; ?>> <?php echo $lang_deve_1_english; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $lang_deve_1_size; ?>:</td>
                            <td><?php echo $lang_deve_1_width; ?> <input type="text" name="width" placeholder="223" size="1" maxlength="3" onChange="api_2();">px</td>
                            <td><?php echo $lang_deve_1_height; ?> 113 px</td>
                        </tr>
                        <tr>
                        	<td><?php echo $lang_deve_1_color; ?>:</td>
                            <td colspan="2" style="text-align:center; background-color:rgb(200,200,200); padding:5px 0;"><?php echo $lang_deve_2_bgcolor; ?></td>
                        </tr>
                        <tr>
                        	<td style="color:red; font-size:12px;"><br/><br/>※IE(Internet</td>
                        	<td>(<?php echo $lang_deve_2_lt; ?>) <input type="text" name="bc_1" placeholder="rgba(0,0,0,0.7)" size="15" onChange="api_2();"></td>
                        	<td>(<?php echo $lang_deve_2_rt; ?>) <input type="text" name="bc_2" placeholder="rgba(0,0,0,0.2)" size="15" onChange="api_2();"></td>
                        </tr>
                        <tr>
                        	<td style="color:red; font-size:12px;"> Explore)では<br/>透明度の指定に<br/>対応していません</td>
                        	<td>(<?php echo $lang_deve_2_lb; ?>) <input type="text" name="bc_3" placeholder="rgba(0,0,0,0.3)" size="15" onChange="api_2();"></td>
                        	<td>(<?php echo $lang_deve_2_rb; ?>) <input type="text" name="bc_4" placeholder="rgba(0,0,0,0.4)" size="15" onChange="api_2();"></td>
                        </tr>
                        <tr>
                        	<td style="color:red; font-size:12px;">ので、rgbaの代<br/>わりにrgbをお使<br/>いください</td>
                            <td>(<?php echo $lang_deve_2_overall; ?>) <input type="text" name="bc" placeholder="rgba(0,0,0,0.2)" size="15" onChange="api_2();"></td>
                            <td>(<?php echo $lang_deve_2_comment; ?>) <input type="text" name="bc_c" placeholder="rgba(255,255,255,0.7)" size="15" onChange="api_2();"></td>
                        </tr>
                        <tr><td style="color:rgb(160,160,164); font-size:14px;">色について</td><td></td><td></td></tr>
                        <tr>
                        	<td style="color:rgb(160,160,164); font-size:14px;">r:赤(0~255)<br/>g:緑(0~255)</td>
                            <td colspan="2" style="text-align:center; background-color:rgb(200,200,200); padding:5px 0;"><?php echo $lang_deve_2_txtcolor; ?></td>
                        </tr>
                        <tr>
                        	<td style="color:rgb(160,160,164); font-size:14px;">b:青(0~255)<br/>a:透明(0~1)</td>
                        	<td>(<?php echo $lang_deve_2_lt; ?>) <input type="text" name="tc_1" placeholder="rgba(255,255,255,1)" size="15" onChange="api_2();"></td>
                        	<td>(<?php echo $lang_deve_2_rt; ?>) <input type="text" name="tc_2" placeholder="rgba(10,10,10,1)" size="15" onChange="api_2();"></td>
                        </tr>
                        <tr>
                        	<td style="color:red; font-size:12px;"><br/>赤の場合<br/>rgb(255,0,0)</td>
                        	<td>(<?php echo $lang_deve_2_lb; ?>) <input type="text" name="tc_3" placeholder="rgba(10,10,10,1)" size="15" onChange="api_2();"></td>
                        	<td>(<?php echo $lang_deve_2_rb; ?>) <input type="text" name="tc_4" placeholder="rgba(10,10,10,1)" size="15" onChange="api_2();"></td>
                        </tr>
                        <tr>
                        	<td style="color:red; font-size:12px;">rgba(255,0,0,1)<br/>または #FF0000<br/>または red</td>
                            <td colspan="2">(<?php echo $lang_deve_2_comment; ?>)<br/><input type="text" name="tc_c" placeholder="rgba(0,0,0,1)" size="15" onChange="api_2();"></td>
                        </tr>
                        <tr>
                        	<td colspan="3" style="text-align:right;">
                            	<input type="button" name="tocode" value="<?php echo $lang_deve_1_show_code; ?>" onClick="api_2('code');">
                            </td>
                        </tr>
                    </table>
                    </form>
                    <br/><br/>
            	</div>
            </div>
            <div id="sample_2" style="padding:50px 25px; float:right; width:320px;">
                <div style="background:rgb(255,140,50); color:#FFFFFF; padding:5px; font-size:24px;"><?php echo $lang_deve_1_review; ?></div><br/><br/>
                <div id="sample_form_2">
					<script>
                        new sv_showNowForm(
                            "<?php echo $lang; ?>",/*language(jp/en) default:jp*/
                            "<?php echo $sensor; ?>",/*sensor id*/
                            223,/*width(222-300)*/
							0,
                            "rgba(0,0,0,0.2)",/*back color all*/
                            "rgba(0,0,0,0.7)",/*back color 1*/
                            "rgba(0,0,0,0.2)",/*back color 2*/
                            "rgba(0,0,0,0.3)",/*back color 3*/
                            "rgba(0,0,0,0.4)",/*back color 4*/
                            "rgba(255,255,255,0.7)",/*back color comment*/
                            "rgba(255,255,255,1)",/*text color 1*/
                            "rgba(10,10,10,1)",/*text color 2*/
                            "rgba(10,10,10,1)",/*text color 3*/
                            "rgba(10,10,10,1)",/*text color 4*/
                            "rgba(0,0,0,1)"/*text color comment*/
                        );
					</script>
                </div>
        <br/><br/><br/><br/>
                <div style="background:rgb(255,140,50); color:#FFFFFF; padding:5px; font-size:24px;"><?php echo $lang_deve_1_code; ?></div><br/><br/>
                    <div id="review_2"><textarea name="code" rows="12" cols="42" readonly style="color:rgba(0,0,0,0.35);"><script charset="utf-8" src="http://www.live-e-sv.info/developers/api/js/sensors.js">
</script><script charset="utf-8" src="developers/api/data_show.js"></script>
<script>
new sv_showNowForm("<?php echo $lang; ?>","l_kashiwanoha_h",223,0,"rgba(0,0,0,0.2)","rgba(0,0,0,0.7)","rgba(0,0,0,0.2)","rgba(0,0,0,0.3)","rgba(0,0,0,0.4)","rgba(255,255,255,0.7)","rgba(255,255,255,1)","rgba(10,10,10,1)","rgba(10,10,10,1)","rgba(10,10,10,1)","rgba(0,0,0,1)");
</script></textarea>
					</div>
                <div style="text-align:left; font-size:13px; position:relative; left:10px;">Put the code into your web page where you want to show it.</div>
			</div>
        </div>
        
	</body>
</html>