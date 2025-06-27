<?php

namespace Src\Application\Common\DTOs\Pacote;

use Src\Core\Pacote\Entities\PacoteRecebidoEntity;

final class PacoteRecebidoOutputDTO{
    public ?int $id;
    public string $dataRecebimento;
    public string $doador;

    
    public function __construct(string $dataRecebimento, string $doador, ?int $id) {
        $this->id = $id;
        $this->dataRecebimento = $dataRecebimento;
        $this->doador = $doador;
    }

    public static function fromEntity( PacoteRecebidoEntity $entity ): PacoteRecebidoOutputDTO{
        return new self(
            $entity->getId(),
            $entity->getDataRecebimento(),
            $entity->getDoador()
        );
    }
}
