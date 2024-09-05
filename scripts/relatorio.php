<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../index.html");
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

$container = (int)$_SESSION['container']; // Pega o container vigente
$acao = 3; // Ação do relatório

$query = "CALL BD55.teste(?, ?, @p_saida_retorno)";
$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Falha na preparação da statement: " . $conn->error);
}

$stmt->bind_param("ii", $container, $acao);

// Executa a instrução
if (!$stmt->execute()) {
    die("Erro na execução da consulta: " . $stmt->error);
}

$stmt->close();

// Obtém o valor de retorno da variável de saída
$result = $conn->query("SELECT @p_saida_retorno AS retorno");

if (!$result) {
    die("Erro ao buscar o resultado: " . $conn->error);
}

$row = $result->fetch_assoc();
$retorno = $row['retorno']; // Armazena o valor de retorno

$conn->close();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/report.css">
    <title>Relatorio</title>
</head>
<body>
    <h1>relatorio <?php echo $retorno; ?></h1>
</body>
</html>