<?php 
include 'php_list_device.php';
$arrHome = listHome();
?>
<html>
<head>
<title>Smart Home Project!</title>

<script src="jquery-2.0.2.js"></script>
<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="./fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="./fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="./fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

<link rel="stylesheet" type="text/css" href="mystyle.css">
<script>
$(document).ready(function() {
	$('.fancybox').fancybox();
	setInterval("refreshState()",1000);
});
function top_title(str){
$('#top_bar_title').text(str);
}
function refreshState(){
$.ajax({
	url:'device_control_inhouse.xml',
	dataType:'xml',
	success:function(data){
		$(data).find('neighbor home').each(function(){
			var hid = $(this).attr('id');
			var home = $(this);
			$(home).find('room').each(function(){
				var rid = $(this).attr('id');
				var room = $(this);
				$(room).find('device').each(function(){
					var did = $(this).attr('id');
					var state = $(this).find('state').text();
					$('#'+hid+'_'+rid+'_'+did).children('.control').attr('class','control fancybox fancybox.ajax state-'+state);
					return true;
				});
			});
		});
	},
	error:function(){
	}
	});
}
function flowcontrol(str)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("page").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","web_flowcontrol.php?back=0&cmd="+str,true);
xmlhttp.send();
}
function back(str)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("back_botton").setAttribute("onclick",xmlhttp.responseText);
    }
  }
xmlhttp.open("GET","web_flowcontrol.php?back=1&cmd="+str,true);
xmlhttp.send();
}

</script>
</head>

<body>
<div id="content" class="shadow">
	<div id="top_bar">
		<div id="back_botton" onclick="flowcontrol('menu');back('none');top_title('Menu');">  </div>
		<div id="home_botton" onclick="flowcontrol('menu');back('none');top_title('Menu');">  </div>
		<div id="top_bar_title">Menu</div>
	</div>
	<div id="page" class="plate">
<?php
		foreach($arrHome as $key => $value){
echo "
		<div id=\"".$key."\" class=\"tile\" onclick=\"top_title('".addslashes($value)."');flowcontrol('".$key."');back('menu');\">
			<div class=\"tile_title\">".$value."</div>
		</div>
";
		}
		
		?>
		<div id="group_control" class="tile" onclick="flowcontrol('group_control');back('menu');top_title('Group Control');">
			<div class="tile_title">Group Control</div>
		</div>
		<div id="setting" class="tile" onclick="flowcontrol('setting');back('menu');top_title('Setting');">
			<div class="tile_title">Setting</div>
		</div>
	</div>
</div>
</form>
</body>
</html>