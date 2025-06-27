<?php

namespace Src\Application\Controllers;

use PDO;
use Src\Application\Common\DTOs\Pacote\PacoteRecebidoInputDTO;
use Src\Application\Common\DTOs\Pacote\PacoteRecebidoOutputDTO;
use Src\Application\Gateways\PacoteGateway;
use Src\Core\Pacote\UseCases\CriarPacoteRecebido;

final class PacoteController{
    private PDO $conn;

    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }
    
    public function CriarPacoteRecebido(array $data): PacoteRecebidoOutputDTO{

        $pacoteDTO = PacoteRecebidoInputDTO::fromArray($data);

        $datasource = new PacoteGateway( $this->conn );
        $useCase = new CriarPacoteRecebido($datasource);


        $result = $useCase->execute( $pacoteDTO );

        return PacoteRecebidoOutputDTO::fromEntity($result);
    }
}
