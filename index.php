
<?php

// =============================================
// 1. INCLUSÃO DAS CLASSES
// =============================================

require_once __DIR__ . "/class/Esteira.class.php";
require_once __DIR__ . "/class/Peca.class.php";
require_once __DIR__ . "/class/Sensor.class.php";


// =============================================
// 2. CONFIGURAÇÕES INICIAIS
// =============================================

// Define o fuso horário utilizado pelo sistema.
date_default_timezone_set('America/Sao_Paulo');

// Define o diretório de armazenamento das sessões e inicia a sessão.
session_save_path(__DIR__ . "/sessions");
session_start();


// =============================================
// 3. INICIALIZAÇÃO DOS DADOS DA PRODUÇÃO
// =============================================

// Inicializa os dados caso ainda não existam na sessão.
if (!isset($_SESSION["lotePecas"])) {
    $_SESSION["lotePecas"] = [];
    $_SESSION["proximaPeca"] = 1;
    $_SESSION["paradaEmergencia"] = false;
}

// Controla se todas as peças do lote foram produzidas.
if (!isset($_SESSION["producaoConcluida"])) {
    $_SESSION["producaoConcluida"] = false;
}


// =============================================
// 4. TRATAMENTO DAS SOLICITAÇÕES DO OPERADOR
// =============================================

// Verifica se o operador solicitou a retomada da produção.
if (isset($_POST["retomar"])) {

    $_SESSION["paradaEmergencia"] = false;

    // Redireciona para evitar o reenvio do formulário.
    header("Location: index.php");
    exit;
}

// Verifica se o operador solicitou uma nova produção.
if (isset($_POST["nova_producao"])) {

    $_SESSION["lotePecas"] = [];
    $_SESSION["proximaPeca"] = 1;
    $_SESSION["paradaEmergencia"] = false;
    $_SESSION["producaoConcluida"] = false;

    header("Location: index.php");
    exit;
}


// =============================================
// 5. DECLARAÇÃO E INICIALIZAÇÃO DAS VARIÁVEIS
// =============================================

$sensorId = 1;
$totalPecasProduzidas = 10;

// Recupera a posição da próxima peça a ser produzida.
$contadorPecas = $_SESSION["proximaPeca"] - 1;

// Recupera os registros armazenados na sessão.
$lotePecas = $_SESSION["lotePecas"];

// Recupera o estado da parada de emergência.
$paradaEmergencia = $_SESSION["paradaEmergencia"];


// =============================================
// 6. CRIAÇÃO DOS OBJETOS
// =============================================

$sensor = new Sensor($sensorId, "SENSOR-ULTRA", 0.0);

$esteira = new Esteira(1, "X-01", "Esteira de produção Ultra");


// =============================================
// 7. SIMULAÇÃO DA PRODUÇÃO
// =============================================

// A produção só continua se não houver uma parada de emergência.
if (!$paradaEmergencia) {

    // Loop responsável por simular a produção das peças do lote.
    for ($i = $contadorPecas; $i < $totalPecasProduzidas; $i++) {

        $contadorPecas++;

        $nomePeca = "Peça #" . $contadorPecas;

        // Gera uma leitura de temperatura entre 45°C e 95°C.
        $novaLeitura = rand(450, 950) / 10;

        // Atualiza a leitura do sensor e recupera a temperatura.
        $sensor->setLeituraTemperatura($novaLeitura);
        $temperaturaAtual = $sensor->getLeituraTemperatura();

        // Classifica a temperatura conforme as regras da classe Sensor.
        $situacao = $sensor->classificarTemperatura();

        // Cria o objeto correspondente à peça produzida.
        $objetoPeca = new Peca($contadorPecas, $nomePeca);

        // Armazena os dados da peça no array do lote.
        array_push($lotePecas, [
            "id" => $contadorPecas,
            "peca" => $objetoPeca,
            "id_sensor" => $sensor->getId(),
            "modelo_sensor" => $sensor->getModelo(),
            "temperatura" => $temperaturaAtual,
            "situacao" => $situacao,
            "timestamp" => date('H:i:s')
        ]);

        // Atualiza os dados da produção na sessão.
        $_SESSION["lotePecas"] = $lotePecas;
        $_SESSION["proximaPeca"] = $contadorPecas + 1;


        // 8. VERIFICAÇÃO DA TEMPERATURA CRÍTICA

        // Se a temperatura for crítica, interrompe a produção.
        if ($situacao === "Crítico") {

            $paradaEmergencia = true;

            // Registra a parada na sessão.
            $_SESSION["paradaEmergencia"] = true;

            break;
        }
    }

    // Verifica se todas as peças do lote foram produzidas.
    if ($contadorPecas >= $totalPecasProduzidas) {
        $_SESSION["producaoConcluida"] = true;
    }
}


// =============================================
// 9. CONTROLE DOS BOTÕES
// =============================================

// Verifica se o botão de retomada deve ser exibido.
$mostrarBotaoRetomar = $paradaEmergencia && !$_SESSION["producaoConcluida"];

// Verifica se o botão de nova produção deve ser exibido.
$mostrarBotaoNovaProducao = $_SESSION["producaoConcluida"];


// =============================================
// 10. EXIBIÇÃO DA PÁGINA
// =============================================

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TechMill 4.0 | Painel Industrial</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Cabeçalho com a logo do projeto -->
    <header class="cabecalho">
        <img src="./docs/img/logo_tech_mill.png" alt="Logo TechMill 4.0">
    </header>


    <!-- Painel principal -->
    <main class="painel">

        <h1>Monitoramento da Produção</h1>

        <p>Relatório de telemetria industrial</p>


        <!-- Informações sobre o andamento da produção -->
        <div class="meta-producao">

            Peças produzidas:

            <strong>
                <?= count($lotePecas) ?> de <?= $totalPecasProduzidas ?>
            </strong>

            <?php if ($_SESSION["producaoConcluida"]): ?>

                <span class="status-concluido">
                    ✓ Produção finalizada
                </span>

            <?php endif; ?>

        </div>


        <!-- Botão para retomar a produção -->
        <?php if ($mostrarBotaoRetomar): ?>

            <form method="POST">
                <button type="submit" name="retomar" value="1">
                    Retomar produção
                </button>
            </form>

        <?php endif; ?>


        <!-- Botão para iniciar uma nova produção -->
        <?php if ($mostrarBotaoNovaProducao): ?>

            <form method="POST">
                <button type="submit" name="nova_producao" value="1">
                    Nova produção
                </button>
            </form>

        <?php endif; ?>


        <!-- Aviso de interrupção por temperatura crítica -->
        <?php if ($paradaEmergencia && !$_SESSION["producaoConcluida"]): ?>

            <div class="aviso-critico">

                <strong>⚠ ALERTA DE TEMPERATURA!</strong>

                <p>Produção interrompida devido à temperatura crítica.</p>

            </div>

        <?php endif; ?>


        <!-- Tabela com os registros da produção -->
        <table>

            <tr>
                <th>ID</th>
                <th>Peça</th>
                <th>ID Sensor</th>
                <th>Modelo do Sensor</th>
                <th>Temperatura</th>
                <th>Situação</th>
                <th>Horário</th>
            </tr>

            <!-- Percorre os registros armazenados no array do lote -->
            <?php foreach ($lotePecas as $item): ?>

                <?php
                    // Define a classe CSS correspondente à situação.
                    $classeEstado = ($item["situacao"] === "Crítico")
                        ? "critico"
                        : strtolower($item["situacao"]);
                ?>

                <tr>

                    <td><?= $item["id"] ?></td>

                    <td><?= $item["peca"]->getNomePeca() ?></td>

                    <td><?= $item["id_sensor"] ?></td>

                    <td><?= $item["modelo_sensor"] ?></td>

                    <td><?= $item["temperatura"] ?> °C</td>

                    <td class="estado <?= $classeEstado ?>">
                        <?= $item["situacao"] ?>
                    </td>

                    <td><?= $item["timestamp"] ?></td>

                </tr>

            <?php endforeach; ?>

        </table>

    </main>

</body>
</html>

