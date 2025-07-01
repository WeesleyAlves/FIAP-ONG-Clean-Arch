<?php

namespace Src\API\Handlers;

use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Src\Application\Controllers\PacoteController;

final class PacotesHandler{

    private App $app;
    private PacoteController $pacoteController;

    public function __construct(App $app, ?PDO $conn) {
        $this->app = $app;
        $this->pacoteController = new PacoteController($conn);
    }

    public function run() {

        $this->app->post('/pacotes/criar-novo', function (Request $request, Response $response, $args){
            $pacoteCriado = $this->pacoteController->criarPacoteRecebido( $request->getParsedBody() );

            $body = array(
                "status" => 201,
                "mensagem" => "Pacote criado com sucesso",
                "data" => $pacoteCriado,
            );

            $response->getBody()->write(json_encode($body, JSON_UNESCAPED_SLASHES));

            return $response->withStatus(200)
                ->withHeader('Content-Type', 'application/json');
        });

    }
}
