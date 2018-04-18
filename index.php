<?php

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'log';
}

$logPath = __DIR__ . '/logs/access.log';

switch ($action) {
    case 'log':

        $clientInfo = [
            'server' => $_SERVER,
            'session' => $_SESSION,
            'request' => [
                'GET' => $_GET,
                'POST' => $_POST
            ],
            'cookie' => $_COOKIE,
            'files' => $_FILES
        ];

        $logMessage = [];
        $logMessage[] = '#######################';
        $logMessage[] = date('Y-m-d H:i:s');
        $logMessage[] = '***********************';
        $logMessage[] = json_encode($clientInfo);
        $logMessage[] = '#######################';
        $logMessage[] = '';
        $logMessage[] = '';
        $logMessage[] = '';

        file_put_contents($logPath, implode(PHP_EOL, $logMessage), FILE_APPEND);

        include_once __DIR__ . '/stub.php';

        break;
    case 'read':
        echo file_get_contents($logPath);
        break;
    case 'flush':
        file_put_contents($logPath, '');
        echo 'flushed';
}