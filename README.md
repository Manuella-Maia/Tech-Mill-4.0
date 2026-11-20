# TechMill 4.0 — Painel IoT de Telemetria Industrial

## 1. Sobre o projeto

O **TechMill 4.0** é um projeto acadêmico desenvolvido em PHP para a atividade **Operação Fábrica 4.0 — Painel IoT de Telemetria Industrial**, proposta pelo SENAI.

O sistema simula o monitoramento de uma linha de produção industrial, utilizando leituras de temperatura para acompanhar as condições de funcionamento da produção.

As informações são processadas pelo PHP e apresentadas em um painel web, permitindo visualizar as peças produzidas, identificar alterações de temperatura e reconhecer situações críticas.

## 2. Objetivo

Desenvolver uma aplicação que represente o monitoramento de uma produção industrial, aplicando conceitos de programação, orientação a objetos, estruturas de repetição, estruturas condicionais e desenvolvimento de interfaces web.

## 3. Funcionalidades

- Simulação de até 10 ciclos de produção por lote.
- Geração de leituras de temperatura para as peças.
- Classificação das temperaturas conforme as regras de negócio.
- Armazenamento dos registros utilizando sessões PHP.
- Exibição dos dados em uma tabela de monitoramento.
- Identificação visual dos estados de temperatura.
- Interrupção da simulação ao identificar uma temperatura crítica.
- Exibição de alerta de temperatura crítica.
- Possibilidade de retomar a produção após uma parada.
- Indicação de conclusão do lote.
- Possibilidade de iniciar uma nova produção após a conclusão.

## 4. Regras de negócio

A classificação das temperaturas segue as faixas estabelecidas na atividade:

| Classificação | Temperatura |
|---|---|
| Normal | Abaixo de 60 °C |
| Atenção | De 60 °C até 80 °C |
| Crítico | Acima de 80 °C |

### Comportamento do sistema

- **Normal:** a produção continua normalmente.
- **Atenção:** o sistema identifica uma condição que exige atenção.
- **Crítico:** a simulação é interrompida automaticamente.

Quando uma temperatura crítica é identificada, o sistema registra a peça correspondente, interrompe os ciclos seguintes e apresenta um alerta no painel.

A produção pode ser retomada por meio da opção disponibilizada na interface.

## 5. Tecnologias utilizadas

- **PHP:** processamento dos dados, regras de negócio e simulação.
- **HTML5:** estruturação da interface web.
- **CSS3:** estilização do painel.
- **Programação Orientada a Objetos (POO):** organização do código por meio de classes.
- **Sessões PHP:** manutenção dos dados da produção entre requisições.
- **Git e GitHub:** controle de versão e armazenamento do projeto.

## 6. Estrutura do projeto

```text
Tech-Mill-4.0/
│
├── class/
│   ├── Esteira.class.php
│   ├── Peca.class.php
│   └── Sensor.class.php
│
├── docs/
│   └── img/
│       ├── fundo_pagina.jpeg
│       └── logo_tech_mill.png
│
├── sessions/
│   └── .gitkeep
│
├── .gitignore
├── index.php
├── README.md
└── style.css
```

### Organização dos arquivos

- **class/:** reúne as classes utilizadas na simulação.
- **Esteira.class.php:** representa a esteira da produção.
- **Peca.class.php:** representa as peças produzidas.
- **Sensor.class.php:** representa o sensor e a classificação das leituras de temperatura.
- **docs/img/:** armazena as imagens utilizadas na interface.
- **sessions/:** diretório destinado ao armazenamento dos arquivos de sessão PHP.
- **.gitkeep:** mantém a pasta `sessions` no repositório.
- **.gitignore:** define os arquivos e diretórios que não devem ser rastreados pelo Git.
- **index.php:** arquivo principal, responsável pelo processamento da simulação e apresentação do painel.
- **style.css:** contém as regras de estilização.
- **README.md:** documentação do projeto.

## 7. Funcionamento da aplicação

A aplicação realiza a simulação dos ciclos de produção e registra as informações de cada peça.

Durante cada ciclo, o sistema:

1. Atualiza o contador de peças.
2. Gera uma leitura de temperatura.
3. Envia a leitura ao objeto responsável pelo sensor.
4. Classifica a temperatura conforme as regras de negócio.
5. Registra as informações da peça produzida.
6. Atualiza os dados armazenados na sessão.
7. Verifica se ocorreu uma condição crítica.

Caso a temperatura ultrapasse 80 °C, a simulação é interrompida. Os registros já realizados permanecem disponíveis no painel.

### Persistência dos dados

O sistema utiliza sessões PHP para preservar os registros da produção entre as requisições, evitando que uma simples atualização da página gere automaticamente um novo lote.

A retomada permite continuar a simulação a partir da próxima peça. Após a conclusão dos 10 ciclos, a interface disponibiliza a opção de iniciar uma nova produção.

## 8. Como executar o projeto

### Pré-requisitos

- Sistema operacional Windows.
- Laragon instalado.
- Navegador web.
- Editor de código, como Visual Studio Code.

### Executando com Laragon

1. Instale e abra o Laragon.
2. Copie ou clone o repositório para a pasta `www`, localizada no diretório de instalação do Laragon.
3. Abra o Laragon e clique em **Start All** para iniciar os serviços.
4. Abra o navegador e acesse o endereço local do projeto.

Exemplo:

```text
http://localhost/Tech-Mill-4.0/
```

5. O painel de monitoramento será carregado e a simulação poderá ser acompanhada pela interface.

**Observação:** o endereço pode variar conforme o nome da pasta do projeto dentro do diretório `www`.

## 9. Divisão de responsabilidades

O desenvolvimento foi organizado conforme a divisão de funções proposta na atividade.

### Manuella Maia Lopes — Integrante A

**Arquiteta de Telemetria e Estrutura de Repetição**

Responsável pela estrutura de repetição, processamento dos ciclos de produção e controle dos incrementos da simulação.

### Maria Clara de Souza Cerqueira — Integrante B

**Engenheira de Regras de Negócio e Interface Web**

Responsável pelas regras de negócio, estruturas condicionais, operadores relacionais e lógicos, classificação das temperaturas e apresentação das informações na interface web.

## 10. Considerações finais

O desenvolvimento do TechMill 4.0 permitiu aplicar conceitos fundamentais da programação em um cenário de simulação industrial.

A atividade envolveu organização de código, programação orientada a objetos, processamento de dados, estruturas de controle e desenvolvimento de interfaces web, aproximando os conhecimentos de programação de situações relacionadas à Indústria 4.0.

---

**Projeto acadêmico desenvolvido no âmbito das atividades do SENAI.**