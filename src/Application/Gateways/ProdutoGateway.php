<?php

namespace Src\Application\Gateways;

use PDO;
use Src\Core\Produto\Entities\ProdutoEntity;
use Src\Core\Produto\Interfaces\ProdutoDatasource;

final class ProdutoGateway implements ProdutoDatasource{
    private ?PDO $conn;

    public function __construct(?PDO $conn) {
        $this->conn = $conn;
    }
    public function saveProduto( ProdutoEntity $produtoEntity ): ProdutoEntity{
        // TODA A LOGICA DE INSERÇÃO
        // $this->conn->exec("FAZ ALGUMA COISA AI");

        //SETA O ID DO NEGOCIO E RETORNA;
        $produtoEntity->setId( rand(0, 1000) );

        return $produtoEntity;
    }
    
}
