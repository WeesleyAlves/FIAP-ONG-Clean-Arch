<?php

namespace Src\Infrastructure\Interfaces;

use Src\Application\Common\DTOs\Produto\SaveProdutoDTO;

interface ProdutoDatasource{
    public function saveProduto( SaveProdutoDTO $saveProdutoDTO ): SaveProdutoDTO;
}
