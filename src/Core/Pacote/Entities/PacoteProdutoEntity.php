<?php


namespace Src\Core\Pacote\Entities;

use Exception;

final class PacoteProdutoEntity{
    private int $idPacote;
    private int $idProduto;
    private int $quantidadeRecebida;

    public function __construct(int $idPacote, int $idProduto, int $quantidadeRecebida) {
        if( $idPacote < 1 ){
            throw new Exception('ID Pacote inválido');
        }

        if($idProduto < 1){
            throw new Exception('ID Produto inválido');
        }

        if($quantidadeRecebida < 1){
            throw new Exception('Não permitidos produtos com quantidade total menor que 1');
        }

        $this->idPacote = $idPacote;
        $this->idProduto = $idProduto;
        $this->quantidadeRecebida = $quantidadeRecebida;
    }

    public static function create(int $idPacote, int $idProduto, int $quantidadeRecebida): PacoteProdutoEntity{
        return new PacoteProdutoEntity($idPacote, $idProduto, $quantidadeRecebida);
    }


    /**
     * Get the value of idPacote
     */ 
    public function getIdPacote()
    {
        return $this->idPacote;
    }

    /**
     * Get the value of idProduto
     */ 
    public function getIdProduto()
    {
        return $this->idProduto;
    }

    /**
     * Get the value of quantidadeRecebida
     */ 
    public function getQuantidadeRecebida()
    {
        return $this->quantidadeRecebida;
    }
}
