<?php

namespace Src\Application\Common\DTOs\Pacote;

use InvalidArgumentException;

final class PacoteRecebidoDTO{
    public string $dataRecebimento;
    public string $doador;

    public function __construct(string $dataRecebimento, string $doador) {
        if (empty($dataRecebimento)) {
            throw new InvalidArgumentException('Data de recebimento não pode ser vazia.');
        }

        if (empty($doador)) {
            throw new InvalidArgumentException('Doador não pode ser vazio.');
        }

        $this->dataRecebimento = $dataRecebimento;
        $this->doador = $doador;
    }

    public static function fromArray( array $data ): self{
        if (!isset($data['dataRecebimento']) || !is_string($data['dataRecebimento'])) {
            throw new InvalidArgumentException('Campo "dataRecebimento" é obrigatório e deve ser uma string.');
        }

        if (!isset($data['doador']) || !is_string($data['doador'])) {
            throw new InvalidArgumentException('Campo "doador" é obrigatório e deve ser uma string.');
        }

        return new self(
            $data['dataRecebimento'],
            $data['doador']
        );
    }
}
