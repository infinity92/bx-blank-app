<?php
include_once __DIR__ . '/src/include/bootstrap.php';
try {
    $app = new \App\Application(new \App\Request());
    echo $app->render();
    $app->finalize();
}
catch (\Throwable $e)
{
    echo '<pre>';
    echo $e->getMessage().' at '.$e->getFile().':'.$e->getLine();
    echo "\r\n";
    echo $e->getTraceAsString();
    echo '</pre>';
    debug(date('d.m.Y H:i:s').' ', 'error.log');
    debug($e->getMessage(), 'error.log');
    debug($e->getTraceAsString()."\r\n", 'error.log');
}
