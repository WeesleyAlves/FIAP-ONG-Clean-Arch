<?php

namespace Src\Application\Controllers;

use Src\Application\Common\DTOs\Pacote\PacoteRecebidoDTO;
use Src\Application\Common\DTOs\Pacote\ProdutoPacoteDTO;
use Src\Application\Common\DTOs\Produto\ProdutoDTO;
use Src\Application\Gateways\PacoteGateway;
use Src\Application\Gateways\ProdutoGateway;
use Src\Application\Presenters\PacoteRecebidoPresenter;
use Src\Application\Presenters\ProdutoPresenter;
use Src\Core\Pacote\UseCases\AdicionarProdutoPacote;
use Src\Core\Pacote\UseCases\CriarPacoteRecebido;
use Src\Core\Produto\UseCases\CriarProduto;
use Src\Infrastructure\Interfaces\PacoteDataSource;
use Src\Infrastructure\Interfaces\ProdutoDatasource;

final class PacoteController{
    private PacoteDataSource $pacoteDataSource;
    private ProdutoDatasource $produtoDatasource;

    public function __construct(PacoteDataSource $pacoteDataSource, ProdutoDatasource $produtoDatasource) {
        $this->pacoteDataSource = $pacoteDataSource;
        $this->produtoDatasource = $produtoDatasource;
    }
    
    public function criarPacoteRecebido(PacoteRecebidoDTO $pacoteDTO): PacoteRecebidoPresenter{
        $pacoteGateway = new PacoteGateway( $this->pacoteDataSource );
        $produtoGateway = new ProdutoGateway( $this->produtoDatasource );

        $criarPacoteUseCase = new CriarPacoteRecebido($pacoteGateway);
        $criarProdutoUseCase = new CriarProduto( $produtoGateway );
        $adicionarProdutoPacoteUseCase = new AdicionarProdutoPacote($pacoteGateway);

        $pacoteEntity = $criarPacoteUseCase->execute( $pacoteDTO );

        $produtosCriados = [];

        foreach ($pacoteDTO->produtos as $produto) {
            $produtoDTO = ProdutoDTO::fromArray($produto);

            $produtoEntity = $criarProdutoUseCase->execute($produtoDTO);

            $quantidade = $produto["quantidade"];

            $produtoPacoteDTO = new ProdutoPacoteDTO(
                $pacoteEntity->getId(),
                $produtoEntity->getId(),
                $quantidade
            );

            $adicionarProdutoPacoteUseCase->execute( $produtoPacoteDTO );

            $produtosCriados[] = ProdutoPresenter::create( $produtoEntity, $quantidade);
        }


        return PacoteRecebidoPresenter::create( $pacoteEntity, $produtosCriados );
    }
}
