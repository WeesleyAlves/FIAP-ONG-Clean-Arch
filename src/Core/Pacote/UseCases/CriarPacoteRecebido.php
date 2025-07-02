<?php


namespace Src\Core\Pacote\UseCases;

use Exception;
use Src\Application\Common\DTOs\Pacote\PacoteRecebidoDTO;
use Src\Application\Gateways\PacoteGateway;
use Src\Core\Pacote\Entities\PacoteRecebidoEntity;

final class CriarPacoteRecebido{
    private PacoteGateway $pacoteGateway;

    public function __construct(PacoteGateway $pacoteGateway) {
        $this->pacoteGateway = $pacoteGateway;
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

        $pacoteEntity = $this->pacoteGateway->savePacoteRecebido($pacoteEntity);

        return $pacoteEntity;
    }
}
