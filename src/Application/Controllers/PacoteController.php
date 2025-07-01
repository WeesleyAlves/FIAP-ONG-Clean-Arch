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
use Src\Core\Pacote\UseCases\AdicionarProdutoPacote;
use Src\Core\Pacote\UseCases\CriarPacoteRecebido;
use Src\Core\Produto\UseCases\CriarProduto;

final class PacoteController{
    private ?PDO $conn;

    public function __construct(?PDO $conn) {
        $this->conn = $conn;
    }
    
    public function criarPacoteRecebido(array $data): PacoteRecebidoPresenter{
        if( !isset( $data["produtos"] ) || !is_array($data["produtos"]) || count($data["produtos"]) == 0 ){
            throw new InvalidArgumentException("É necessário informar o campo 'produtos', e deve conter pelo menos 1 produto.");
        }

        $pacoteDTO = PacoteRecebidoDTO::fromArray($data);

        $pacoteDatasource = new PacoteGateway( $this->conn );
        $produtoDatasource = new ProdutoGateway( $this->conn );

        $criarPacoteUseCase = new CriarPacoteRecebido($pacoteDatasource);
        $criarProdutoUseCase = new CriarProduto( $produtoDatasource );
        $adicionarProdutoPacoteUseCase = new AdicionarProdutoPacote($pacoteDatasource);

        $pacoteEntity = $criarPacoteUseCase->execute( $pacoteDTO );


        foreach ($data["produtos"] as $produto) {
            $produtoDTO = ProdutoDTO::fromArray($produto);

            $produtoEntity = $criarProdutoUseCase->execute($produtoDTO);

            $produtoPacoteDTO = new ProdutoPacoteDTO(
                $pacoteEntity->getId(),
                $produtoEntity->getId(),
                $produto["quantidade"]
            );

            $adicionarProdutoPacoteUseCase->execute( $produtoPacoteDTO );
        }



        return PacoteRecebidoPresenter::fromEntity($pacoteEntity);
    }
}
