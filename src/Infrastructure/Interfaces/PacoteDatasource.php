<?php

namespace Src\Infrastructure\Interfaces;

use Src\Application\Common\DTOs\Pacote\SavePacoteRecebidoDTO;
use Src\Application\Common\DTOs\Pacote\SaveProdutoPacoteDTO;

interface PacoteDataSource{
    public function savePacoteRecebido(SavePacoteRecebidoDTO $dto): SavePacoteRecebidoDTO;
    public function saveProdutoPacote(SaveProdutoPacoteDTO $dto): SaveProdutoPacoteDTO;
}