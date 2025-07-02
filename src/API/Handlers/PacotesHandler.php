<?php

namespace Src\API\Handlers;

use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Src\Application\Common\DTOs\Pacote\PacoteRecebidoDTO;
use Src\Application\Controllers\PacoteController;
use Src\Infrastructure\Database\PacoteRepository;
use Src\Infrastructure\Database\ProdutoRepository;

final class PacotesHandler{

    private App $app;
    private PacoteController $pacoteController;

    public function __construct(App $app, ?PDO $conn) {
        $this->app = $app;

        $pacoteDataSource = new PacoteRepository($conn);
        $produtoDataSource = new ProdutoRepository($conn);

        $this->pacoteController = new PacoteController( 
            $pacoteDataSource,
            $produtoDataSource
        );
    }

    public function run() {

        $this->app->post('/pacotes/criar-novo', function (Request $request, Response $response, $args){
            $dto = PacoteRecebidoDTO::fromArray( $request->getParsedBody() );

            $pacoteCriado = $this->pacoteController->criarPacoteRecebido( $dto );

            $body = array(
                "status" => 200,
                "mensagem" => "Pacote criado com sucesso",
                "data" => $pacoteCriado,
            );

            $response->getBody()->write(json_encode($body, JSON_UNESCAPED_SLASHES));

            return $response->withStatus(200)
                ->withHeader('Content-Type', 'application/json');
        });

    }
}
