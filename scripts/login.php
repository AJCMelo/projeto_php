<?php
session_start(); // Inicia a sessão

// Configurações do banco de dados
$servername = "192.168.102.100"; // IP do seu servidor de banco de dados
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
$acao = 4; // Define a ação como 4, conforme sua descrição

// Convertendo o user para inteiro
$user_id = (int)$user;

// Prepara e executa a chamada da procedure para verificar o container/usuário
$stmt = $conn->prepare("CALL BD55.processachamadacerta(?, ?)");

// Liga os parâmetros à consulta: "s" para string (user) e "i" para inteiro (acao)
$stmt->bind_param("ii", $user_id, $acao);
$stmt->execute();

// Obter o resultado da procedure
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    // Container/usuário encontrado, armazene a informação na sessão
    $_SESSION['container'] = $user_id; // ou outra informação relevante do resultado

    // Redirecionar para a página do usuário
    header("Location: ../usuario.php");
    exit();
} else {
    // Se o container/usuário não for encontrado, exibe uma mensagem de erro e redireciona de volta para o login
    echo "<script>alert('Usuário não encontrado.'); window.location.href='../index.html';</script>";
    exit();
}

// Fecha a conexão
$stmt->close();
$conn->close();
?>