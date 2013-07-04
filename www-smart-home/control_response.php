<?php
include 'php_setdata_and_req.php';
$hid = $_GET["h"];
$rid = $_GET["r"];
$did = $_GET["d"];
$state = $_GET["s"];

if(requestToControl($hid,$rid,$did,$state))
	echo "done";
else
	echo "fail";
?>