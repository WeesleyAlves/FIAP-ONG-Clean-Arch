<?php

namespace  Src\Core\Pacote\UseCases;

use Exception;
use Src\Application\Common\DTOs\Pacote\ProdutoPacoteDTO;
use Src\Application\Gateways\PacoteGateway;
use Src\Core\Pacote\Entities\PacoteProdutoEntity;
use Src\Core\Pacote\Interfaces\PacoteDataSource;

final class AdicionarProdutoPacote{
    private PacoteGateway $pacoteGateway;
    
    public function __construct(PacoteGateway $pacoteGateway) {
        $this->pacoteGateway = $pacoteGateway;
    }

    public function execute( ProdutoPacoteDTO $produtoPacoteDTO ): PacoteProdutoEntity{
        try {
            $pacoteProdutoEntity = PacoteProdutoEntity::create(
                $produtoPacoteDTO->idPacote,
                $produtoPacoteDTO->idProduto,
                $produtoPacoteDTO->quantidadeRecebida,
            );

        } catch (Exception $e) {
            throw new Exception("Erro ao criar entidade de ProdutoPacote: " . $e->getMessage() );
        }

        $pacoteProdutoEntity = $this->pacoteGateway->saveProdutoPacote( $pacoteProdutoEntity );

        return $pacoteProdutoEntity;
    }
}
