<?php

namespace Src\Application\Gateways;

use Src\Application\Common\DTOs\Produto\SaveProdutoDTO;
use Src\Core\Produto\Entities\ProdutoEntity;
use Src\Infrastructure\Interfaces\ProdutoDatasource;


final class ProdutoGateway{
    private ProdutoDatasource $dataSource;

    public function __construct(ProdutoDatasource $dataSource) {
        $this->dataSource = $dataSource;
    }


    public function saveProduto( ProdutoEntity $produtoEntity ): ProdutoEntity{
        $criacaoDTO = new SaveProdutoDTO(
            $produtoEntity->getNome(),
        );

        $resultadoDTO = $this->dataSource->saveProduto($criacaoDTO);

        return ProdutoEntity::create(
            $resultadoDTO->nome,
            $resultadoDTO->id
        );
    }
    
}
