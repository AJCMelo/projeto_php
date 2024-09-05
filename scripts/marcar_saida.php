<?php
session_start();

// Verifica se o usuário está logado e se a entrada foi marcada
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !isset($_SESSION['marcouEntrada']) || $_SESSION['marcouEntrada'] !== true) {
    echo "<script>alert('Você precisa estar logado e ter marcado a entrada para marcar a saída.'); window.location.href='../index.php';</script>";
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
$acao = 2; // Ação 2 para marcar saída

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

// Verifica o resultado e redireciona ou exibe uma mensagem
if ($retorno == 1) {
    echo "<script>alert('Saída registrada com sucesso!');</script>";
    $_SESSION['marcouEntrada'] = false; // Reseta o status de marcação de entrada
    $_SESSION['marcouSaida'] = true; // Reseta o status de marcação de entrada
    exit();
    
} else {
    echo "<script>alert('$mensagem'); window.location.href='../usuario.php';</script>";
    exit();
    
}

// Fecha a conexão
$conn->close();
?>
