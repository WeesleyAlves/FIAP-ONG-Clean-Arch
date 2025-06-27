<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Src\API\Handlers\PacotesHandler;

$app->get('/', function (Request $request, Response $response, $args) {
    $data = array(
        "status" => 200,
        "mensagem" => "API iniciada com sucesso!",
    );

    $payload = json_encode( $data );

    $response->withStatus(200)->getBody()->write( $payload );

    return $response->withHeader('Content-Type', 'application/json');;
});

$pacotesHandler = new PacotesHandler($app, $conn);

$pacotesHandler->run();