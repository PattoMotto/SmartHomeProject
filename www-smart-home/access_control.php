<?php
if(!empty($_POST)){
	if(($_POST['user']!=NULL && $_POST['pwd'] != NULL) &&
	( $_POST['user']=="neung" && $_POST['pwd']=="qwerty")){
		echo "pass";
	}
	else{
		echo "fail";
	}
}
else{
	echo "Type username and password.";
}
?>