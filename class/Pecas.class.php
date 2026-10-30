<?php

class Pecas{
    // definição dos atributos da classe Peça e dos tipos de dados
    private int $id_peca;
    private string $nome_peca;

    public function __construct(int $id_peca, string $nome_peca) {
        $this->id_peca = $id_peca;
        $this->nome_peca = $nome_peca;
    }

    public function getId(): int{
        return $this->id_peca;
    }

    public function getNomePeca(): string{
        return $this->nome_peca;
    } 
}