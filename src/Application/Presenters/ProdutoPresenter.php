<?php

namespace Src\Application\Presenters;

use InvalidArgumentException;
use Src\Core\Produto\Entities\ProdutoEntity;

final class ProdutoPresenter{
    public string $nome;
    public int $id;
    public ?int $quantidade;

    public function __construct(string $nome, int $id, ?int $quantidade = null) {
        if( isset($quantidade) && $quantidade !== null && $quantidade < 1 ){
            throw new InvalidArgumentException("Quantidade de produtos inválidos para o Presenter");
        }

        $this->nome = $nome;
        $this->id = $id;
        $this->quantidade = $quantidade;
    }

    public static function fromEntity( ProdutoEntity $entity, ?int $quantidade ): ProdutoPresenter{
        return new ProdutoPresenter(
            $entity->getNome(),
            $entity->getId(),
            $quantidade
        );
    }
}
