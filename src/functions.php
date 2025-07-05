<?php

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
