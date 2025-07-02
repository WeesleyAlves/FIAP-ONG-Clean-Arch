<?php

namespace Src\Application\Common\DTOs\Pacote;

final class SavePacoteRecebidoDTO{
    public string $dataRecebimento;
    public string $doador;

    public ?int $id;
    

    public function __construct(string $dataRecebimento, string $doador, ?int $id = null) {
        $this->dataRecebimento = $dataRecebimento;
        $this->doador = $doador;
        $this->id = $id;
    }
}
