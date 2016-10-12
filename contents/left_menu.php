<?php
	function show_left_menu($id,$lang,$sensor){
		include 'lang/'.$lang.'.php';
?>
	<a href="http://www.live-e.org/" target="_blank"><dir id="livee"><img="img/livee.png"></img></dir></a>
    
        <div id="main_menu">

            <div id="a" class="menu_button <?php if($id=="a"){echo "click";}else{echo "off";} ?>" onMouseOver="button_over('a');" onMouseOut="button_out('a')" onClick="button_click('a');location.href='top.php<?php echo '?sID='.$sensor;?>';" style="cursor:pointer;">
				<?php
            		echo $lang_top;
				?>
            </div>
            <div id="b" class="menu_button <?php if($id=="b"){echo "click";}else{echo "off";} ?>" onMouseOver="button_over('b');" onMouseOut="button_out('b')" onClick="button_click('b');location.href='map.php<?php echo '?sID='.$sensor;?>';" style="cursor:pointer;">
				<?php
            		echo $lang_gomap;
				?>
            </div>
            <div id="c" class="menu_button <?php if($id=="c"){echo "click";}else{echo "off";} ?>" onMouseOver="button_over('c');" onMouseOut="button_out('c')" onClick="button_click('c');location.href='graph.php<?php echo '?sID='.$sensor;?>';" style="cursor:pointer;">
				<?php
            		echo $lang_graph;
				?>
            </div>
            <div id="e" class="menu_button <?php if($id=="e"){echo "click";}else{echo "off";} ?>" onMouseOver="button_over('e');" onMouseOut="button_out('e')" onClick="button_click('e');location.href='developers.php<?php echo '?sID='.$sensor;?>';" style="cursor:pointer;">
            	Developers
            </div>
            <div id="d" class="menu_button <?php if($id=="d"){echo "click";}else{echo "off";} ?>" onMouseOver="button_over('d');" onMouseOut="button_out('d')" onClick="button_click('d');location.href='about.php<?php echo '?sID='.$sensor;?>';" style="cursor:pointer;">
				<?php
            		echo $lang_about;
				?>
            </div>
            
            <script>
            document.getElementById("<?php echo $id;?>").onclick=function () {location.href='#';}
            </script>
        </div>
<?php
	}
?>