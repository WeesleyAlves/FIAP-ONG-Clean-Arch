<?php

namespace  Src\Core\Pacote\UseCases;

use Exception;
use Src\Application\Common\DTOs\Pacote\ProdutoPacoteDTO;
use Src\Core\Pacote\Entities\PacoteProdutoEntity;
use Src\Core\Pacote\Interfaces\PacoteDataSource;

final class AdicionarProdutoPacote{
    private PacoteDataSource $pacoteDataSource;
    
    public function __construct(PacoteDataSource $pacoteDataSource) {
        $this->pacoteDataSource = $pacoteDataSource;
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

        $pacoteProdutoEntity = $this->pacoteDataSource->saveProdutoPacote( $pacoteProdutoEntity );

        return $pacoteProdutoEntity;
    }
}
