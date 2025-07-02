<?php

namespace Src\Application\Gateways;

use Src\Application\Common\DTOs\Pacote\SavePacoteRecebidoDTO;
use Src\Application\Common\DTOs\Pacote\SaveProdutoPacoteDTO;
use Src\Core\Pacote\Entities\PacoteProdutoEntity;
use Src\Core\Pacote\Entities\PacoteRecebidoEntity;
use Src\Infrastructure\Interfaces\PacoteDataSource;



final class PacoteGateway{
    private PacoteDataSource $dataSource;

    public function __construct(PacoteDataSource $dataSource) {
        $this->dataSource = $dataSource;
    }

    public function savePacoteRecebido(PacoteRecebidoEntity $pacoteEntity): PacoteRecebidoEntity{
        $criacaoDTO = new SavePacoteRecebidoDTO(
            $pacoteEntity->getDataRecebimento(),
            $pacoteEntity->getDoador(),
        );

        $resultadoDTO = $this->dataSource->savePacoteRecebido( $criacaoDTO );

        return PacoteRecebidoEntity::create(
            $resultadoDTO->dataRecebimento,
            $resultadoDTO->doador,
            $resultadoDTO->id
        );
    }

    public function saveProdutoPacote(PacoteProdutoEntity $pacoteProdutoEntity): PacoteProdutoEntity{
        $criacaoDTO = new SaveProdutoPacoteDTO(
            $pacoteProdutoEntity->getIdPacote(),
            $pacoteProdutoEntity->getIdProduto(),
            $pacoteProdutoEntity->getQuantidadeRecebida(),
        );

        $resultadoDTO = $this->dataSource->saveProdutoPacote($criacaoDTO );

        return PacoteProdutoEntity::create(
            $resultadoDTO->idPacote,
            $resultadoDTO->idProduto,
            $resultadoDTO->quantidadeRecebida
        );
    }
}
