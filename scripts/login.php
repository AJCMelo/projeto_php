<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Inicia a sessão

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

// Obtém o nome do usuário do formulário de login
$user = $_POST['user'];
$pass = $_POST['pass'];
$acao = 4; // Define a ação como 4

// Convertendo o user para inteiro
$user_id = (int)$user;

// Prepara e executa a chamada da procedure para verificar o container/usuário
$query = "CALL BD55.processachamada(?, ?, @p_saida_retorno, @p_saida_mensagem)";
$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Falha na preparação da statement: " . $conn->error);

}

$stmt->bind_param("ii", $user_id, $acao);

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
$retorno = (int)$row['retorno']; // Converter para inteiro

if ($retorno === 1 && $pass == '123') {
    // Login bem-sucedido
    $_SESSION['container'] = $user_id; // Armazene o ID do usuário na sessão
    $_SESSION['loggedin'] = true; // Define a sessão como logada
    header("Location: ../usuario.php"); // Redireciona para a página do usuário
    exit();

} else {
    // Falha no login
    echo "<script>alert('Usuário ou senha não encontrado.'); window.location.href='../index.php';</script>";
    exit();

}

// Fecha a conexão
$conn->close();
?>
