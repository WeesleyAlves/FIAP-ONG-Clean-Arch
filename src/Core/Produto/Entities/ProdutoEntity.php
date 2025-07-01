<?php


namespace Src\Core\Produto\Entities;

use Exception;

final class ProdutoEntity{
    private ?int $id;
    private string $nome;

    public function __construct(string $nome, ?int $id = null ) {
        if(!is_string( $nome ) || $nome == ''){
            throw new Exception('Nome do produto inválido');
        }

        $this->nome = $nome;
        $this->id = $id;
    }

    public static function create(string $nome, ?int $id = null): ProdutoEntity{
        return new ProdutoEntity($nome, $id);
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(int $id): self
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

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }
}
