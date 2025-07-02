<?php

namespace Src\Infrastructure\Database;

use PDO;
use Src\Application\Common\DTOs\Produto\SaveProdutoDTO;
use Src\Infrastructure\Interfaces\ProdutoDatasource;

final class ProdutoRepository implements ProdutoDatasource{

    private ?PDO $pdo;

    public function __construct(?PDO $pdo){
        $this->pdo = $pdo;
    }

    public function saveProduto( SaveProdutoDTO $saveProdutoDTO ): SaveProdutoDTO{
        // logica de inseção e tudo mais com ORM ou sei la o uqe

        return new SaveProdutoDTO(
            $saveProdutoDTO->nome,
            rand(1, 1000),
        );
    }

}