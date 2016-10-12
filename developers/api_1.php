<html>
	<body>
		<div id="api_1" style="background-color:rgba(255,255,255,1); height:100%; display:block;">
            <div id="api_select">
                <table width="100%">
                	<tr style="font-family:Arial, Helvetica, sans-serif;">
                    	<td width="50%" style="padding:9px 0;text-align:center;background-color:rgba(255,255,255,1);cursor:default;">API 1</td>
                    	<td width="50%" style="padding:9px 0;text-align:center;background-color:rgba(255,255,255,0.2);cursor:pointer;" onClick="none('api_1');block('api_2');">API 2</td>
                    </tr>
                </table>
            </div>
        	<div id="select">
            </div>
        	<div id="input" style="padding:50px 25px; float:left; width:320px; ackground:rgba(0,0,0,0.1);">
            	<div id="selectform">
            		<div style="background:rgb(0,127,170); color:#FFFFFF; padding:5px; font-size:24px;"><?php echo $lang_deve_1_setting; ?></div><br/><br/>
                    <form name="set_api1">
                    <table style="table-layout:fixed;" width="350px">
                        <tr>
                            <td width="90px"><?php echo $lang_deve_1_title; ?>:</td>
                            <td colspan="2"><input type="text" name="tittle" onChange="api_1();" placeholder="<?php echo $lang_sName[$sensor]; ?>"></td>
                        </tr>
                        <tr>
                            <td><?php echo $lang_deve_1_sensor; ?>:</td>
                            <td colspan="2"><select name="sensor" style="width:230px;" onChange="api_1();">
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
                            <td><input type="radio" name="language" value="jp" onChange="api_1();" <?php if($lang=="jp") echo "checked"; ?>> <?php echo $lang_deve_1_japanese; ?></td>
                            <td><input type="radio" name="language" value="en" onChange="api_1();" <?php if($lang!="jp") echo "checked"; ?>> <?php echo $lang_deve_1_english; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $lang_deve_1_size; ?>:</td>
                            <td><?php echo $lang_deve_1_width; ?> <input type="text" name="width" placeholder="285" size="1" maxlength="3" onChange="api_1();">px</td>
                            <td><?php echo $lang_deve_1_height; ?> <input type="text" name="height" placeholder="520" size="1" maxlength="3" onChange="api_1();">px</td>
                        </tr>
                        <tr>
                            <td><?php echo $lang_deve_1_datas; ?>:</td>
                            <td><input type="text" name="datas" placeholder="20" size="1" maxlength="2" onChange="api_1();"></td>
                        </tr>
                        <tr>
                        	<td><?php echo $lang_deve_1_color; ?>:</td>
                        	<td><?php echo $lang_deve_1_back; ?>(<?php echo $lang_deve_1_top; ?>): <input type="text" name="bc_t" placeholder="rgba(0,0,0,0.4)" size="15" onChange="api_1();"></td>
                        	<td><?php echo $lang_deve_1_text; ?>(<?php echo $lang_deve_1_top; ?>): <input type="text" name="tc_t" placeholder="rgba(255,255,255,1)" size="15" onChange="api_1();"></td>
                        </tr>
                        <tr>
                        	<td></td>
                        	<td><?php echo $lang_deve_1_back; ?>(<?php echo $lang_deve_1_foot; ?>): <input type="text" name="bc_b" placeholder="rgba(0,0,0,0.4)" size="15" onChange="api_1();"></td>
                        	<td><?php echo $lang_deve_1_text; ?>(<?php echo $lang_deve_1_foot; ?>): <input type="text" name="tc_b" placeholder="rgba(255,255,255,1)" size="15" onChange="api_1();"></td>
                        </tr>
                        <tr>
                        	<td></td>
                        	<td><?php echo $lang_deve_1_back; ?> 1 (<?php echo $lang_deve_1_contents; ?>): <input type="text" name="bc_1" placeholder="rgba(0,0,0,0.5)" size="15" onChange="api_1();"></td>
                        	<td><?php echo $lang_deve_1_back; ?> 2 (<?php echo $lang_deve_1_contents; ?>): <input type="text" name="bc_2" placeholder="rgba(0,0,0,0.4)" size="15" onChange="api_1();"></td>
                        </tr>
                        <tr>
                        	<td></td>
                        	<td colspan="2"><?php echo $lang_deve_1_text; ?>(<?php echo $lang_deve_1_contents; ?>): <input type="text" name="tc" placeholder="rgba(255,255,255,1)" size="15" onChange="api_1();"></td>
                        </tr>
                        <tr>
                        	<td colspan="3" style="text-align:right;">
                            	<input type="button" name="tocode" value="<?php echo $lang_deve_1_show_code; ?>" onClick="api_1('code');">
                            </td>
                        </tr>
                    </table>
                    </form>
                    <br/><br/>
                    <div style="background:rgb(0,127,170); color:#FFFFFF; padding:5px; font-size:24px;"><?php echo $lang_deve_1_code; ?></div><br/><br/>
                    <div id="review"><textarea name="code" rows="12" cols="42" readonly style="color:rgba(0,0,0,0.35);"><script charset="utf-8" src="http://www.live-e-sv.info/developers/api/js/sensors.js">
</script><script charset="utf-8" src="developers/api/data_show.js"></script>
<script>
new sv_showForm("<?php echo $lang_sName[$sensor]; ?>","<?php echo $lang; ?>","<?php echo $sensor; ?>",24,285,520,"rgba(0,0,0,0.4)","rgba(255,255,255,1)","rgba(0,0,0,0.4)","rgba(255,255,255,1)","rgba(0,0,0,0.5)","rgba(0,0,0,0.4)","rgba(255,255,255,1)");
</script></textarea>
					</div>
                    <div style="text-align:left; font-size:13px; position:relative; left:10px;">Put the code into your web page where you want to show it.</div>
            	</div>
            </div>
            <div id="sample" style="padding:50px 25px; float:right; width:320px;">
                <div style="background:rgb(0,127,170); color:#FFFFFF; padding:5px; font-size:24px;"><?php echo $lang_deve_1_review; ?></div><br/><br/>
                <script charset="utf-8" src="http://www.live-e-sv.info/developers/api/js/sensors.js"></script>
                <script charset="utf-8" src="http://www.live-e-sv.info/developers/api/data_show.js"></script>
                <div id="sample_form">
					<script>
                    new sv_showForm(
                        "<?php echo $lang_sName[$sensor]; ?>",
                        "<?php echo $lang; ?>",/*language(jp/en) default:jp*/
                        "<?php echo $sensor; ?>",/*sensor id*/
                        24,/*number of data(3~24)*/
                        285,/*width(235-300)*/
                        520,/*height(300-800)*/
                        "rgba(0,0,0,0.4)",/*back color top*/
                        "rgba(255,255,255,1)",/*text color top*/
                        "rgba(0,0,0,0.4)",/*back color bottom*/
                        "rgba(255,255,255,1)",/*text color bottom*/
                        "rgba(0,0,0,0.5)",/*back color 1*/
                        "rgba(0,0,0,0.4)",/*back color 2*/
                        "rgba(255,255,255,1)"/*text color*/
                    );
                    </script>
                </div>
            </div>
        </div>
	</body>
</html>