<?php

file_put_contents('./requests.log', print_r($_REQUEST, true));
if (($_REQUEST['api-key'] ?? null) === 'error')
{
    header("HTTP/1.1 400 Bad Request");
    $errors[] = [
        'field' => 'api-key',
        'message' => 'You input invalid value',
    ];
    $response = [
        'status' => 'error',
        'errors' => $errors
    ];
    echo json_encode($response);
    exit();
}

header("HTTP/1.1 200 OK");
header("Content-Type: application/json");
$response = ['status' => 'success'];
echo json_encode($response);
exit();
