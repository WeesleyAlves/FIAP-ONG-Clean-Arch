<?php

namespace Src\Core\Pacote\Interfaces;

use Src\Core\Pacote\Entities\PacoteRecebidoEntity;

interface PacoteDataSource{
    public function savePacoteRecebido(PacoteRecebidoEntity $pacote): PacoteRecebidoEntity;
}