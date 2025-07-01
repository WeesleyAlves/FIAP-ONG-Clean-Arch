<?php


namespace Src\Core\Pacote\UseCases;

use Exception;
use Src\Application\Common\DTOs\Pacote\PacoteRecebidoDTO;
use Src\Core\Pacote\Entities\PacoteRecebidoEntity;
use Src\Core\Pacote\Interfaces\PacoteDataSource;

final class CriarPacoteRecebido{
    private PacoteDataSource $pacoteDataSource;

    public function __construct(PacoteDataSource $pacoteDataSource) {
        $this->pacoteDataSource = $pacoteDataSource;
    }

    public function execute( PacoteRecebidoDTO $pacoteRecebidoDto ): PacoteRecebidoEntity{
        try {
            $pacoteEntity = PacoteRecebidoEntity::create(
                $pacoteRecebidoDto->dataRecebimento,
                $pacoteRecebidoDto->doador
            );

        } catch (Exception $e) {
            throw new Exception("Erro ao criar entidade de Pacote: " . $e->getMessage() );
        }

        $pacoteEntity = $this->pacoteDataSource->savePacoteRecebido($pacoteEntity);

        return $pacoteEntity;
    }
}
