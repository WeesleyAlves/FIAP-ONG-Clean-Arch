<?php

namespace Src\Application\Gateways;

use PDO;
use Src\Core\Pacote\Entities\PacoteRecebidoEntity;
use Src\Core\Pacote\Interfaces\PacoteDataSource;


final class PacoteGateway implements PacoteDataSource
{
    private ?PDO $conn;

    public function __construct(?PDO $conn) {
        $this->conn = $conn;
    }

    public function savePacoteRecebido(PacoteRecebidoEntity $pacoteEntity): PacoteRecebidoEntity{
        // TODA A LOGICA DE INSERÇÃO
        // $this->conn->exec("FAZ ALGUMA COISA AI");

        //SETA O ID DO NEGOCIO E RETORNA;
        $pacoteEntity->setId(rand(0, 1000));
        return $pacoteEntity;
    }
}
