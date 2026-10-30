<?php

class Esteira{
    // definição dos atributos da classe Esteira e dos tipos de dados
    private int $id_esteira;
    private string $codigo_esteira;
    private string $nome_esteira;

    public function __construct(int $id_esteira, string $codigo_esteira, string $nome_esteira) {
        $this->id_esteira = $id_esteira;
        $this->codigo_esteira = $codigo_esteira;
        $this->nome_esteira = $nome_esteira;
    }

    public function getId(): int{
        return $this->id_esteira;
    }

    public function getCodigo(): string{
        return $this->codigo_esteira;
    } 

    public function getNome(): string{
        return $this->nome_esteira;
    } 
}