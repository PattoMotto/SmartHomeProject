<?php
include 'php_list_device.php';
$cmd = $_GET["cmd"];
$hid = $_GET["h"];
$rid = $_GET["r"];
$did = $_GET["d"];
$device=getDeviceData($hid,$rid ,$did);
$response = "h=".$hid."&r=".$rid."&d=".$did."&s=".($device->state=="1" ? "0":"1");
switch($cmd){
case 'c':	
	echo "<div><div class=\"device_title\">".$device["name"]."</div>";
	echo "<div id=\"botton\" class=\"state-botton state-".($device->state=="1" ? "0":"1")."\" onclick=\"response()\">".($device->state=="1" ? "Turn off":"Turn on")."</div>";
	echo "</div>";
	break;
case 't':
	break;
default: echo "Passing variable error!!<br>";

}
//print_r (getDeviceData("h1","r1","d1"));
?>
<script>
function response()
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
    document.getElementById("botton").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","control_response.php?<?php echo $response; ?>",true);
xmlhttp.send();
setTimeout("parent.$.fancybox.close()", 500);
}
</script>