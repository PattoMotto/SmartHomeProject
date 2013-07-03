<?php
	$path = 'device_control_inhouse.xml';
	$xml = simplexml_load_file($path);
	
	function setData($datatype, $data){
		foreach($xml as $home) {
			foreach($home as $room) {
				if($room["webreq"] == "1")
				foreach($room as $device){
					if($device["webreq"] == "1"){
						$device->{$datatype} = $data;
						echo $home["name"]," ",$room["name"]," ",$device["name"]," ",$datatype," change to ",$data,"<br>";
					}
				}
			}
		}
	}
	function setWebRequest($hid, $rid, $did, $data){
		foreach($xml as $home) {
			if($home["id"] == $hid)
			foreach($home as $room) {
				if($room["id"] == $rid){
					$room["webreq"] = $data;
					foreach($room as $device){
						if($device["id"] == $did) $device["webreq"] = $data;
					}
				}
			}
		}
	}
?>