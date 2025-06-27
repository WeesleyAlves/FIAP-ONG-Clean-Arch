<?php

namespace Src\Core\Pacote\Entities;

use \Exception;

final class PacoteRecebidoEntity{
    private ?int $id;
    private string $data_recebimento;
    private string $doador;

    public function __construct(string $data_recebimento, string $doador, ?int $id = null) {
        if( $data_recebimento == '' ){
            throw new Exception('Data de recebimento inválida');
        }

        if($doador == ''){
            throw new Exception('Doador inválido');
        }

        $this->data_recebimento = $data_recebimento;
        $this->doador = $doador;
        $this->id = $id;
    }

    static function create(string $data_recebimento, string $doador, ?int $id = null): PacoteRecebidoEntity{
        return new PacoteRecebidoEntity($data_recebimento, $doador, $id);
    }

    /**
     * Get the value of id
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of data_recebimento
     */ 
    public function getData_recebimento(): string
    {
        return $this->data_recebimento;
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
