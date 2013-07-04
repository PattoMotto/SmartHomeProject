<?php 
include 'php_list_device.php';
$arrHome = listHome();
?>
<html>
<head>
<title>Smart Home Project!</title>
<script src="jquery-2.0.2.js"></script>
<link rel="stylesheet" type="text/css" href="mystyle.css">
<script>
var now = "menu_page";
var back = "login_page";
function now_page(var1){
switch(var1){
case "menu_page" :
	now = "menu_page";
	back = "login_page";
	$("#menu_page").show();
	$("#top_bar_title").text("Menu");
	$("#back_botton").hide();
<?php
foreach($arrHome as $key => $value){
echo "$(\"#".$key."_page\").hide();
";
$arrRoom = listRoom($key);
	foreach($arrRoom as $key_j => $value_j){
		echo "$(\"#".$key."_".$key_j."_page\").hide();
	";
	}
}
?>
	$("#setting_page").hide();
	break;
<?php

foreach($arrHome as $key => $value){
echo "
case \"".$key."_page\" :
	now = \"".$key."_page\";
	back = \"menu_page\";
    $(\"#menu_page\").hide();
	$(\"#top_bar_title\").text($(\"#".$key."\").children(\".tile_title\").text());
	$(\"#".$key."_page\").show();
	";
	foreach($arrHome as $key_i => $value_i){
	$arrRoom = listRoom($key);
		foreach($arrRoom as $key_j => $value_j){
			echo "$(\"#".$key_i."_".$key_j."_page\").hide();
	";
	if($key_i == $key)continue;
			echo "$(\"#".$key_i."_page\").hide();
	";
	
		}
	}

echo "$(\"#back_botton\").show();
	break;
";
$arrRoom = listRoom($key);
	foreach($arrRoom as $key_j => $value_j){
echo "
case \"".$key."_".$key_j."_page\" :
	now = \"".$key."_".$key_j."_page\";
	back = \"".$key."_page\";
    $(\"#menu_page\").hide();
	$(\"#top_bar_title\").text($(\"#".$key."_".$key_j."\").children(\".tile_title\").text());
	$(\"#".$key."_".$key_j."_page\").show();
	$(\"#".$key."_page\").hide();
	";
	foreach($arrHome as $key_i => $value_i){
	$arrRoom = listRoom($key);
		foreach($arrRoom as $key_k => $value_k){
			if($key_j == $key_k)continue;
			echo "$(\"#".$key_i."_".$key_k."_page\").hide();
	";
	if($key_i == $key)continue;
			echo "$(\"#".$key_i."_page\").hide();
	";
	
		}
	}

echo "$(\"#back_botton\").show();
	break;
";
	}
}
?>
case "setting_page" :
	now = "setting_page";
	back = "menu_page";
    $("#menu_page").hide();
	$("#top_bar_title").text("Setting");
	$("#setting_page").show();
	$("#back_botton").show();
	break;
}
}
$(document).ready(function(){
  now_page(now);
<?php

foreach($arrHome as $key => $value){
echo  "$(\"#".$key."\").click(function(){
	now_page(\"".$key."_page\");
});
";
$arrRoom = listRoom($key);
	foreach($arrRoom as $key_i => $value_i){
	echo  "$(\"#".$key."_".$key_i."\").click(function(){
	now_page(\"".$key."_".$key_i."_page\");
});
";
	}
}
  ?>
  $("#setting").click(function(){
	now_page("setting_page");
  }); 

  $("#home_botton").click(function(){
		now_page("menu_page");
	});
	
  $("#back_botton").click(function(){
	now_page(back);
  });
  
    
	
});
</script>

</head>

<body>
<div id="content">
	<div id="top_bar">
		<div id="back_botton">  </div>
		<div id="home_botton">  </div>
		<div id="top_bar_title">Menu</div>
	</div>
	<div id="menu_page" class="plate">
		<?php
		foreach($arrHome as $key => $value){
echo "
		<div id=\"".$key."\" class=\"tile\">
			<div class=\"tile_title\">".$value."</div>
		</div>
";
		}
		
		?>
		<div class="tile">
			<div class="tile_title">Group Control</div>
		</div>
		<div id="setting" class="tile">
			<div class="tile_title">Setting</div>
		</div>
	</div>
<?php

foreach($arrHome as $key => $value){
$arrRoom = listRoom($key);
echo"	<div id=".$key."_page class=\"plate\">";
		foreach($arrRoom as $key_1 => $value_1){
		echo "
		<div id = \"".$key."_".$key_1."\" class=\"tile\">
			<div class=\"tile_title\">".$value_1."</div>
		</div>
";
		}
echo"	</div>";
foreach($arrRoom as $key_1 => $value_1){
$arrDevice = listDevice($key,$key_1);
echo"
	<div id=".$key."_".$key_1."_page class=\"plate\">";
		foreach($arrDevice as $key_2 => $value_2){
		echo "
		<div id = \"".$key."_".$key_1."_".$key_2."\" class=\"tile\">
			<div class=\"tile_title\">".$value_2."</div>
			<div class=\"control\">  </div>
			<div class=\"timer\">  </div>
		</div>
";
		}
echo"	</div>";
}
}
?>	
	<div id="setting_page" class="plate">
		<div class="sub_bar">
			<div class="sub_title">View</div>
		</div>
		<div class="tile">
			<div class="checked">  </div>
			<div class="tile_title">Standard</div>
		</div>
		<div class="tile">
			<div class="check">  </div>
			<div class="tile_title">Advance</div>
		</div>
		<div class="tile">
			<div class="check">  </div>
			<div class="tile_title">High contrast</div>
		</div>
	</div>
</div>
</form>
</body>
</html>