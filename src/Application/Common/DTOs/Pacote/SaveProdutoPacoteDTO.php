<?php

namespace Src\Application\Common\DTOs\Pacote;

final class SaveProdutoPacoteDTO{
    public int $idPacote;
    public int $idProduto;
    public int $quantidadeRecebida;

    public function __construct(int $idPacote, int $idProduto, int $quantidadeRecebida) {
        $this->idPacote = $idPacote;
        $this->idProduto = $idProduto;
        $this->quantidadeRecebida = $quantidadeRecebida;
    }
}
