<?php

namespace Src\Application\Presenters;

use Src\Core\Pacote\Entities\PacoteRecebidoEntity;

final class PacoteRecebidoPresenter{
    public string $dataRecebimento;
    public string $doador;

    public function __construct(string $dataRecebimento, string $doador,) {
        $this->dataRecebimento = date( "d/m/Y H:i:s", strtotime( $dataRecebimento ) );
        $this->doador = $doador;
    }
    public static function fromEntity( PacoteRecebidoEntity $entity ): PacoteRecebidoPresenter{
        return new self(
            $entity->getDataRecebimento(),
            $entity->getDoador(),
        );
    }
}
