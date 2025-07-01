<?php

namespace Src\Application\Controllers;

use InvalidArgumentException;
use PDO;
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

final class PacoteController{
    private ?PDO $conn;

    public function __construct(?PDO $conn) {
        $this->conn = $conn;
    }
    
    public function criarPacoteRecebido(PacoteRecebidoDTO $pacoteDTO): PacoteRecebidoPresenter{
        $pacoteDatasource = new PacoteGateway( $this->conn );
        $produtoDatasource = new ProdutoGateway( $this->conn );

        $criarPacoteUseCase = new CriarPacoteRecebido($pacoteDatasource);
        $criarProdutoUseCase = new CriarProduto( $produtoDatasource );
        $adicionarProdutoPacoteUseCase = new AdicionarProdutoPacote($pacoteDatasource);

        $pacoteEntity = $criarPacoteUseCase->execute( $pacoteDTO );

        $produtosCriados = array();

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

            $produtosCriados[] = ProdutoPresenter::fromEntity( $produtoEntity, $quantidade);
        }


        return PacoteRecebidoPresenter::create( $pacoteEntity, $produtosCriados );
    }
}
