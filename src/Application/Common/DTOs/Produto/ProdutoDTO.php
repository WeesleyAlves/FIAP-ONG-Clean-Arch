<?php

namespace Src\Application\Common\DTOs\Produto;

use InvalidArgumentException;

final class ProdutoDTO{
    public $nome;

    public function __construct(string $nome) {
        if (empty($nome)) {
            throw new InvalidArgumentException('Nome não pode ser vazio');
        }

        $this->nome = $nome;
    }

    public static function fromArray( array $data ): self{
        if (!isset($data['nome']) || !is_string($data['nome'])) {
            throw new InvalidArgumentException('Campo "nome" é obrigatório e deve ser uma string.');
        }

        return new self(
            $data['nome'],
        );
    }
}
