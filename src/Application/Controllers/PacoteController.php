<?php

namespace Src\Application\Controllers;

use InvalidArgumentException;
use PDO;
use Src\Application\Common\DTOs\Pacote\PacoteRecebidoDTO;
use Src\Application\Common\DTOs\Pacote\ProdutoPacoteDTO;
use Src\Application\Gateways\PacoteGateway;
use Src\Application\Presenters\PacoteRecebidoPresenter;
use Src\Core\Pacote\UseCases\AdicionarProdutoPacote;
use Src\Core\Pacote\UseCases\CriarPacoteRecebido;

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
        $criarPacoteUseCase = new CriarPacoteRecebido($pacoteDatasource);
        $adicionarProdutoUseCase = new AdicionarProdutoPacote($pacoteDatasource);

        // foreach ($data["produtos"] as $produto) {
        //     $dto = ProdutoPacoteDTO::fromArray($produto);

        //     $adicionarProdutoUseCase->execute($dto);
        // }


        $result = $criarPacoteUseCase->execute( $pacoteDTO );

        return PacoteRecebidoPresenter::fromEntity($result);
    }
}
