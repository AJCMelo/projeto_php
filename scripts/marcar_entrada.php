<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../index.php");
    exit();
}

// Configurações do banco de dados
$servername = "192.168.102.100";
$username = "container55";
$password = "1F(255685)";
$dbname = "BD55";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Define os parâmetros para a stored procedure
$container = (int)$_SESSION['container'];
$acao = 0; // Ação 0 para verificar se a entrada pode ser marcada

// Prepara a chamada da procedure com os parâmetros
$stmt = $conn->prepare("CALL BD55.processachamada(?, ?, @p_saida_retorno, @p_saida_mensagem)");
if (!$stmt) {
    die("Erro na preparação da consulta: " . $conn->error);
}
$stmt->bind_param("ii", $container, $acao);
$stmt->execute();
$stmt->close();

// Obtém o valor de retorno e a mensagem da variável de saída
$result = $conn->query("SELECT @p_saida_retorno AS retorno, @p_saida_mensagem AS mensagem");

if (!$result) {
    die("Erro na execução da consulta: " . $conn->error);

}

$row = $result->fetch_assoc();
$retorno = $row['retorno'];
$mensagem = $row['mensagem'];
$result->free();

// Se o retorno é 1, a entrada pode ser marcada
if ($retorno == 1) {
    // Define a ação como 1 para marcar a entrada
    $acaoEntrada = 1;

    // Prepara a chamada da procedure novamente para marcar a entrada
    $stmt = $conn->prepare("CALL BD55.processachamada(?, ?, @p_saida_retorno, @p_saida_mensagem)");

    if (!$stmt) {
        die("Erro na preparação da consulta: " . $conn->error);

    }

    $stmt->bind_param("ii", $container, $acaoEntrada);
    $stmt->execute();
    $stmt->close();

    // Obtém o valor de retorno e a mensagem da variável de saída novamente
    $resultEntrada = $conn->query("SELECT @p_saida_retorno AS retorno, @p_saida_mensagem AS mensagem");

    if (!$resultEntrada) {
        die("Erro na execução da consulta: " . $conn->error);

    }

    $rowEntrada = $resultEntrada->fetch_assoc();
    $retornoEntrada = $rowEntrada['retorno'];
    $mensagemEntrada = $rowEntrada['mensagem'];
    $resultEntrada->free();

    if ($retornoEntrada == 1) {
        // Se a entrada foi marcada com sucesso
        echo "<script>alert('Entrada registrada com sucesso!');</script>";
        $_SESSION['marcouEntrada'] = true;
        exit();

    } else {
        // Se houve um erro ao tentar marcar a entrada
        echo "<script>alert('Não há registro de aula no momento.'); window.location.href='../usuario.php';</script>";
        exit();

    }
} else {
    // Se o retorno inicial não permitia marcar entrada, exibe a mensagem correspondente
    echo "<script>alert('Não há registro de aula no momento.'); window.location.href='../usuario.php';</script>";
    exit();

}

// Fecha a conexão
$conn->close();

?>
