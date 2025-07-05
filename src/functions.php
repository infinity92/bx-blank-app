<?php

function callRest($queryUrl, $queryData)
{
$curl = curl_init();
    curl_setopt_array($curl, array(
		CURLOPT_SSL_VERIFYPEER => 0,
		CURLOPT_POST => true,
		CURLOPT_HEADER => 0,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $queryUrl,
		CURLOPT_POSTFIELDS => $queryData,
	));

    $result = curl_exec($curl);
    curl_close($curl);

    return $result;
}

function debug(mixed $data, string $file = 'debug.log'): void
{
	file_put_contents($_SERVER['DOCUMENT_ROOT'].'/logs/'.$file, print_r($data, true)."\r\n", FILE_APPEND);
}

function dump(...$items): void
{
	echo '<pre>';
	var_dump($items);
	echo '</pre>';
}
