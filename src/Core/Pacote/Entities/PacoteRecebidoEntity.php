<?php

namespace Src\Core\Pacote\Entities;

use \Exception;

final class PacoteRecebidoEntity{
    private ?int $id;
    private string $dataRecebimento;
    private string $doador;

    public function __construct(string $dataRecebimento, string $doador, ?int $id = null) {
        if( $dataRecebimento == '' ){
            throw new Exception('Data de recebimento inválida');
        }

        if($doador == ''){
            throw new Exception('Doador inválido');
        }

        $this->dataRecebimento = $dataRecebimento;
        $this->doador = $doador;
        $this->id = $id;
    }

    public static function create(string $dataRecebimento, string $doador, ?int $id = null): PacoteRecebidoEntity{
        return new PacoteRecebidoEntity($dataRecebimento, $doador, $id);
    }

    /**
     * Get the value of id
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of dataRecebimento
     */ 
    public function getDataRecebimento(): string
    {
        return $this->dataRecebimento;
    }

    /**
     * Get the value of doador
     */ 
    public function getDoador(): string
    {
        return $this->doador;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(?int $id): self
    {
        if( $id == null ){
            throw new Exception('Não é possível atribuir uma ID nulo.');
        }

        if( $this->id !== null ){
            throw new Exception('Produto já possui um ID.');
        }

        $this->id = $id;

        return $this;
    }
}
