<?php

namespace Src\Application\Common\DTOs\Pacote;

use InvalidArgumentException;

final class ProdutoPacoteDTO{
    public int $idPacote;
    public int $idProduto;
    public int $quantidadeRecebida;

    public function __construct(int $idPacote, int $idProduto, int $quantidadeRecebida) {
        if( $idPacote < 1 ){
            throw new InvalidArgumentException('ID Pacote inválido');
        }

        if($idProduto < 1){
            throw new InvalidArgumentException('ID Produto inválido');
        }

        if($quantidadeRecebida < 1){
            throw new InvalidArgumentException('Não permitidos produtos com quantidade total menor que 1');
        }

        $this->idPacote = $idPacote;
        $this->idProduto = $idProduto;
        $this->quantidadeRecebida = $quantidadeRecebida;
    }

    public static function fromArray( array $data ): self{
        if (!isset($data['idPacote']) || !is_numeric($data['idPacote'])) {
            throw new InvalidArgumentException('Campo "idPacote" é obrigatório e deve ser um número.');
        }

        if (!isset($data['idProduto']) || !is_numeric($data['idProduto'])) {
            throw new InvalidArgumentException('Campo "idProduto" é obrigatório e deve ser um número.');
        }

        if (!isset($data['quantidadeRecebida']) || !is_numeric($data['quantidadeRecebida'])) {
            throw new InvalidArgumentException('Campo "quantidadeRecebida" é obrigatório e deve ser um número.');
        }

        return new self(
            $data['dataRecebimento'],
            $data['doador'],
            $data['quantidadeRecebida']
        );
    }
}
