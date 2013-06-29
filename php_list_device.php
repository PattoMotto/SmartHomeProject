<?php

	function listHome($xml){
		$i=1;
		foreach($xml as $home) {
			$homename["h{$i}"] = $home["name"];
			$i++;	
		}
		return $homename;
	}
	function listRoom($xml, $hid){
		$i=1;
		foreach($xml as $home) {
			if($home['id'] == $hid)
			foreach($home as $room){
				$roomname["r{$i}"] = $room["name"];
				$i++;
			}
		}
		return $roomname;
	}
	function listDevice($xml, $hid, $rid){
		$i=1;
		foreach($xml as $home) {
			if($home['id'] == $hid)
			foreach($home as $room){
				if($room['id'] == $rid)
					foreach($room as $device){
						$devicename["d{$i}"] = $device["name"];
						$i++;
					}
			}
		}
		return $devicename;
	}
	
	$path = 'device_control_inhouse.xml';
	$xml = simplexml_load_file($path);
	$arrayhome = listHome($xml);
	$arrayroom = listRoom($xml, "h1");
	$arraydevice = listDevice($xml, "h1", "r3");
	
	print $arrayhome['h1'];
	print $arrayroom['r3'];
	print $arraydevice['d3'];
		
	$xml->asXml($path);
	
?>