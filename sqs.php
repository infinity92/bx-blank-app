<?php
include_once __DIR__ . '/src/functions.php';
debug($_REQUEST, 'request_sqs.log');
if (isset($_POST['Action']) && $_POST['Action'] === 'SendMessage' && isset($_POST['MessageBody']))
{
	$messageBody = base64_decode($_POST['MessageBody']);
	$messages = unserialize($messageBody, ['allowed_classes' => false]);

	foreach ($messages as $message) {
		parse_str($message['QUERY_DATA'], $data);
		$ch = curl_init();
		curl_setopt_array($ch, [
			CURLOPT_URL => $message['QUERY_URL'],
			CURLOPT_POST => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POSTFIELDS => http_build_query($data),
		]);
		$result = curl_exec($ch);
		$httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		debug($httpStatus, 'request_sqs.log');
	}
}

header("HTTP/1.0 200 OK");