<?php

namespace Src\Application\Presenters;

use Src\Core\Pacote\Entities\PacoteRecebidoEntity;

final class PacoteRecebidoPresenter{
    public int $id;
    public string $dataRecebimento;
    public string $doador;
    public array $produtos;
    

    public function __construct(string $dataRecebimento, string $doador, array $produtos, int $id) {
        $this->dataRecebimento = date( "d/m/Y H:i:s", strtotime( $dataRecebimento ) );
        $this->doador = $doador;
        $this->produtos = $produtos;
        $this->id = $id;
    }

    public static function create( PacoteRecebidoEntity $entity, array $produtos ): PacoteRecebidoPresenter{
        return new self(
            $entity->getDataRecebimento(),
            $entity->getDoador(),
            $produtos,
            $entity->getId()
        );
    }
}
