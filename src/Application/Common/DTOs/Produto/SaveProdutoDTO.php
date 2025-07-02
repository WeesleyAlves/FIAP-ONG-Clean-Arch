<?php

namespace Src\Application\Common\DTOs\Produto;

final class SaveProdutoDTO{
    public ?int $id;
    public string $nome;

    public function __construct(string $nome, ?int $id = null ) {
        $this->nome = $nome;
        $this->id = $id;
    }
}
