<?php

require_once __DIR__ . '/../vendor/autoload.php';


use Slim\Factory\AppFactory;



$app = AppFactory::create();
$app->addBodyParsingMiddleware(); 
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

try {
    require_once __DIR__ .'/../src/API/config.php';

} catch (Exception $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Erro interno na inicialização da aplicação: ' . $e->getMessage()]);
    exit;
}


$app->run();