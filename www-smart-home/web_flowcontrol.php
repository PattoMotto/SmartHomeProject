<?php
include 'php_list_device.php';
$arrHome = listHome();
$back=$_GET["back"];
$cmd=$_GET["cmd"];
if(!$back){
	if($cmd=="menu"){
			foreach($arrHome as $key => $value){
			echo "
			<div id=\"".$key."\" class=\"tile\" onclick=\"flowcontrol('".$key."');back('menu');top_title('".addslashes($value)."');\">
				<div class=\"tile_title\">".$value."</div>
			</div>
	";
			}
			echo "
			<div id=\"group_control\" class=\"tile\" onclick=\"flowcontrol('group_control');back('menu');top_title('Group Control');\">
				<div class=\"tile_title\">Group Control</div>
			</div>
			<div id=\"setting\" class=\"tile\" onclick=\"flowcontrol('setting');back('menu');top_title('Setting');\">
				<div class=\"tile_title\">Setting</div>
			</div>
	";
	}else if($cmd=="setting"){
	 echo "
		<div id=\"setting_page\" class=\"plate\">
			<div class=\"sub_bar\">
				<div class=\"sub_title\">View</div>
			</div>
			<div class=\"tile\">
				<div class=\"checked\">  </div>
				<div class=\"tile_title\">Standard</div>
			</div>
			<div class=\"tile\">
				<div class=\"check\">  </div>
				<div class=\"tile_title\">Advance</div>
			</div>
			<div class=\"tile\">
				<div class=\"check\">  </div>
				<div class=\"tile_title\">High contrast</div>
			</div>
		</div>
";
	}else{
	foreach($arrHome as $hid => $value){
		$arrRoom = listRoom($hid);
		if($cmd==$hid){
		
		echo"	<div id=".$hid."_page class=\"plate\" >";
				foreach($arrRoom as $rid => $value_1){
				echo "
				<div id = \"".$hid."_".$rid."\" class=\"tile\" onclick=\"flowcontrol('".$hid."_".$rid."');back('".$hid."');top_title('".addslashes($value_1)."');\">
					<div class=\"tile_title\">".$value_1."</div>
				</div>
";
				}
		echo"	</div>
";
		exit;
			}
		foreach($arrRoom as $rid => $value_1){
		if($cmd==$hid."_".$rid){
		$arrDevice = listDevice($hid,$rid);
		echo"
			<div id=".$hid."_".$rid."_page class=\"plate\">";
				foreach($arrDevice as $did => $value_2){
				echo "
				<div id = \"".$hid."_".$rid."_".$did."\" class=\"tile\">
					<div class=\"tile_title\">".$value_2."</div>
					<div class=\"control fancybox fancybox.ajax state-".getDeviceData($hid,$rid,$did)->state."\" href=\"control.php?cmd=c&h=".$hid."&r=".$rid."&d=".$did."\">  </div>
					<div class=\"timer fancybox fancybox.ajax\" href=\"control.php?cmd=t&h=".$hid."&r=".$rid."&d=".$did."\">  </div>
				</div>
";
				}
		echo"	</div>";
		exit;
		}
		}
	}
	}
}
else{
if($cmd == "none" || $cmd == "menu"){
	echo "flowcontrol('menu');back('none');top_title('Menu');";
}
else if($cmd == "group_control"){
}
else {
	foreach($arrHome as $hid => $value){
		if($cmd==$hid){
			echo "flowcontrol('".$hid."');back('menu');top_title('".addslashes($value)."');";
			exit;
		}
	}
}
}
?>