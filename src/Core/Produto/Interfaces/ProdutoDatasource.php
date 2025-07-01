<?php

namespace Src\Core\Produto\Interfaces;

use Src\Core\Produto\Entities\ProdutoEntity;

interface ProdutoDatasource{
    public function saveProduto( ProdutoEntity $produtoEntity ): ProdutoEntity;
}
