<?php

class Sensor{
    // definição dos atributos da classe Sensor e dos tipos de dados
    private int $id_sensor;
    private string $modelo;
    private float $leitura_temperatura;

    public function __construct(int $id_sensor, string $modelo, float $leitura_temperatura) {
        $this->id_sensor = $id_sensor;
        $this->modelo = $modelo;
        $this->leitura_temperatura = $leitura_temperatura;
    }

    public function getId(): int{
        return $this->id_sensor;
    }

    public function getModelo(): string{
        return $this->modelo;
    }

    public function getLeituraTemperatura(): float{
        return $this->leitura_temperatura;
    } 

    public function setLeituraTemperatura(float $leituraGerada): void{
        $this->leitura_temperatura = $leituraGerada;
    }

    public function ClassificarTemperatura(): string{
        if($this->leitura_temperatura < 60){
            return "Normal";
        }else if ($this->leitura_temperatura <= 80){
            return "Atenção";
        }else{
            return "Crítico";
        }
    }
}