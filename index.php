<?php

require_once __DIR__ . "/class/Esteira.class.php";
require_once __DIR__ . "/class/Peca.class.php";
require_once __DIR__ . "/class/Sensor.class.php";

// 1. DECLARAÇÃO DE VARIÁVEIS E INICIALIZAÇÃO

$sensorId = 1;
$totalPecasProduzidas = 5;
$contadorPecas = 0;
$contadorSensores = 0;
$lotePecas = [];

// criação do objeto esteira e do objeto sensor
$sensor = new Sensor($sensorId, "SENSOR-ULTRA", 0.0);
$esteira = new Esteira(1, "X-01", "Esteira de produção Ultra");


// Loop para a produção de 5 lotes
for($i = 0; $i < $totalPecasProduzidas; $i++){
    $contadorPecas++;
    $nomePeca = "Peça #" . $contadorPecas;

    $novaLeitura = rand(450, 950) / 10;

    $sensor->setLeituraTemperatura($novaLeitura);

    $temperaturaAtual = $sensor->getLeituraTemperatura();

    $objetoPeca = new Peca($contadorPecas, $nomePeca);

    array_push($lotePecas, [
        "id" => $contadorPecas,
        "peca" => $objetoPeca,
        "id_sensor" => $sensor->getId(),
        "modelo_sensor" => $sensor->getModelo(),
        "temperatura" => $temperaturaAtual,
        'timestamp'   => date('H:i:s')
    ]);
}

// interação do array de lote de peças 

foreach($lotePecas as $item){
    $idLote = $item["id"];
    $objetoPeca = $item["peca"];
    $idSensor = $item["id_sensor"];
    $temperatura = $item["temperatura"];

    //para realizar a leitura de outras informações armazenadas dentro do vetor
    //siga o mesmo padrão de declaração de variavel armazenando o item que esta armazenado no vetor.
    // estrutura chave-valor
    // exemplo: chave "id_sensor" e valor = 1

    /*
     * PONTO DE ENTREGA PARA O INTEGRANTE B:
     * O Integrante B utilizará $tempLeitura nas condicionais:
     * - Normal:  $tempLeitura < 60
     * - Atenção: $tempLeitura >= 60 && $tempLeitura <= 80
     * - Crítico: $tempLeitura > 80
     */
}
