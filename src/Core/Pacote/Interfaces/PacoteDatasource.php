<?php

namespace Src\Core\Pacote\Interfaces;

use Src\Core\Pacote\Entities\PacoteProdutoEntity;
use Src\Core\Pacote\Entities\PacoteRecebidoEntity;

interface PacoteDataSource{
    public function savePacoteRecebido(PacoteRecebidoEntity $pacoteEntity): PacoteRecebidoEntity;
    public function saveProdutoPacote(PacoteProdutoEntity $pacoteEntity): PacoteProdutoEntity;
}