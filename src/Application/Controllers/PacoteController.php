<?php

namespace Src\Application\Controllers;

use PDO;
use Src\Application\Common\DTOs\Pacote\PacoteRecebidoDTO;
use Src\Application\Gateways\PacoteGateway;
use Src\Application\Presenters\PacoteRecebidoPresenter;
use Src\Core\Pacote\UseCases\CriarPacoteRecebido;

final class PacoteController{
    private ?PDO $conn;

    public function __construct(?PDO $conn) {
        $this->conn = $conn;
    }
    
    public function criarPacoteRecebido(array $data): PacoteRecebidoPresenter{

        $pacoteDTO = PacoteRecebidoDTO::fromArray($data);

        $datasource = new PacoteGateway( $this->conn );
        $useCase = new CriarPacoteRecebido($datasource);


        $result = $useCase->execute( $pacoteDTO );

        return PacoteRecebidoPresenter::fromEntity($result);
    }
}
