<?php
	$path = 'device_control_inhouse.xml';
	$xml = simplexml_load_file($path);
	
	function setData($hid, $rid, $did, $datatype, $data){
		global $xml, $path;
		foreach($xml as $home) {
			if($home["id"] == $hid)
			foreach($home as $room) {
				if($room["id"] == $rid && $room["webreq"] == "1")
				foreach($room as $device){
					if($device["id"] == $did && $device["webreq"] == "1"){
						$device->{$datatype} = $data;
						$xml->asXml($path);
						//echo $home["name"]," ",$room["name"]," ",$device["name"]," ",$datatype," change to ",$data,"<br>";
						return true;
					}
				}
			}
		}
		return false;
	}
	function setWebRequest($hid, $rid, $did, $data){
		global $xml,$path;
		foreach($xml as $home) {
			if($home["id"] == $hid)
			foreach($home as $room) {
				if($room["id"] == $rid){
					$room["webreq"] = $data;
					foreach($room as $device){
						if($device["id"] == $did){
							$device["webreq"] = $data;
							$xml->asXml($path);
							return true;
						}
					}
				}
			}
		}
		return false;
	}
	function requestToControl($hid, $rid, $did, $state){
		return (setWebRequest($hid, $rid, $did, "1") && setData($hid, $rid, $did, "state", $state));
	}
?>