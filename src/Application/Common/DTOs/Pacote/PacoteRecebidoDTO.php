<?php

namespace Src\Application\Common\DTOs\Pacote;

use InvalidArgumentException;

final class PacoteRecebidoDTO{
    public string $dataRecebimento;
    public string $doador;
    public array $produtos;

    public function __construct(string $dataRecebimento, string $doador, array $produtos) {
        if (empty($dataRecebimento)) {
            throw new InvalidArgumentException('Data de recebimento não pode ser vazia.');
        }

        if (empty($doador)) {
            throw new InvalidArgumentException('Doador não pode ser vazio.');
        }

        if (!isset($produtos) || empty($doador) || !is_array($produtos) || count( $produtos ) == 0 ) {
            throw new InvalidArgumentException('Produtos deve ser uma array({nome, quantidade}), e não pode estar vazio.');
        }

        $this->dataRecebimento = $dataRecebimento;
        $this->doador = $doador;
        $this->produtos = $produtos;
    }

    public static function fromArray( array $data ): self{
        if (!isset($data['dataRecebimento']) || !is_string($data['dataRecebimento'])) {
            throw new InvalidArgumentException('Campo "dataRecebimento" é obrigatório e deve ser uma string.');
        }

        if (!isset($data['doador']) || !is_string($data['doador'])) {
            throw new InvalidArgumentException('Campo "doador" é obrigatório e deve ser uma string.');
        }

        if (!isset($data['produtos']) || !is_array($data['produtos'])) {
            throw new InvalidArgumentException('Campo "produtos" é obrigatório e deve ser um array.');
        }

        return new self(
            $data['dataRecebimento'],
            $data['doador'],
            $data['produtos']
        );
    }
}
