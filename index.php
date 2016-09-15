<?php
$ch = curl_init();
$post_data = false;

		curl_setopt_array($ch, array(
			CURLOPT_CUSTOMREQUEST => 'GET',
//			CURLOPT_URL => "https://dev3.iconneqt.nl:443/api/v1/lists",
			CURLOPT_URL => "https://crm08.iconneqt.nl:443/api/v1/lists",
			CURLOPT_USERPWD => "Martijn van der Lee" .':' . "rUjHNQp9exVH3U4wTxHCFhY",
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HEADER => true,
		));

		if ($post_data) {
			if (is_array($post_data) || is_object($post_data)) {
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
			} else {
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data, JSON_NUMERIC_CHECK));
			}
		}

		if (($result = curl_exec($ch)) === false) {
			throw new Exception(curl_error($ch), curl_errno($ch));
		};

		list($headers, $body) = explode("\r\n\r\n", $result);

		$httpcode = curl_getinfo($ch);
		var_dump($httpcode, $ch, $headers, $body);
		if ($httpcode >= 400) {
			preg_match('~HTTP/\S+ ([0-9]{3}) (.+)~m', $headers, $status);
			
		}

		curl_close($ch);

		return json_decode($body);