<?php

namespace Src\Core\Produto\UseCases;

use Exception;
use Src\Application\Common\DTOs\Produto\ProdutoDTO;
use Src\Core\Produto\Entities\ProdutoEntity;
use Src\Core\Produto\Interfaces\ProdutoDatasource;

final class CriarProduto{
    private ProdutoDatasource $produtoDatasource;

    public function __construct(ProdutoDatasource $produtoDatasource){
        $this->produtoDatasource = $produtoDatasource;
    }

    public function execute( ProdutoDTO $produtoDTO ): ProdutoEntity{
        try {
            $produtoEntity = ProdutoEntity::create(
                $produtoDTO->nome,
            );

        } catch (Exception $e) {
            throw new Exception("Erro ao criar entidade de Produto: " . $e->getMessage() );
        }


        return $this->produtoDatasource->saveProduto( $produtoEntity );
    }
}
