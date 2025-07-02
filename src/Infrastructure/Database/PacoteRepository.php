<?php

namespace Src\Infrastructure\Database;

use PDO;
use Src\Application\Common\DTOs\Pacote\SavePacoteRecebidoDTO;
use Src\Application\Common\DTOs\Pacote\SaveProdutoPacoteDTO;
use Src\Infrastructure\Interfaces\PacoteDataSource;

final class PacoteRepository implements PacoteDataSource{

    private ?PDO $pdo;

    public function __construct(?PDO $pdo){
        $this->pdo = $pdo;
    }

    public function savePacoteRecebido(SavePacoteRecebidoDTO $dto): SavePacoteRecebidoDTO{
        //logica de inserção e bla bla bla

        return new SavePacoteRecebidoDTO(
            $dto->dataRecebimento,
            $dto->doador,
            rand(0 , 1000)
        );
    }

    public function saveProdutoPacote(SaveProdutoPacoteDTO $dto): SaveProdutoPacoteDTO{
        //logica de inserção e bla bla bla

        return new SaveProdutoPacoteDTO(
            $dto->idPacote,
            $dto->idProduto,
            $dto->quantidadeRecebida,
        );

    }
}