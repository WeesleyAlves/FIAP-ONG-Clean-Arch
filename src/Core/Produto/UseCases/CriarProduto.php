<?php

namespace Src\Core\Produto\UseCases;

use Exception;
use Src\Application\Common\DTOs\Produto\ProdutoDTO;
use Src\Application\Gateways\ProdutoGateway;
use Src\Core\Produto\Entities\ProdutoEntity;

final class CriarProduto{
    private ProdutoGateway $produtoGateway;

    public function __construct(ProdutoGateway $produtoGateway){
        $this->produtoGateway = $produtoGateway;
    }

    public function execute( ProdutoDTO $produtoDTO ): ProdutoEntity{
        try {
            $produtoEntity = ProdutoEntity::create(
                $produtoDTO->nome,
            );

        } catch (Exception $e) {
            throw new Exception("Erro ao criar entidade de Produto: " . $e->getMessage() );
        }


        return $this->produtoGateway->saveProduto( $produtoEntity );
    }
}
