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

// Prepara a chamada da procedure
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

// Captura o conjunto de resultados retornado pela procedure
$result = $stmt->get_result();

// Verifica se há resultados
if ($result) {
    // Armazena todos os resultados em uma variável
    $data = $result->fetch_all(MYSQLI_ASSOC);

}

// Fecha a instrução e a conexão
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/report.css">
    <title>Relatório</title>
</head>
<body>
    <header id="header">
        <img src="../assets/ifrn-banner.png" alt="Logo IFRN">
    </header>

    <main>
        <div id="back-wrapper">
            <span>Relatório container <?php echo $_SESSION['container']; ?></span>
            <button id="btn" onclick="window.location.href='../usuario.php'">Voltar para tela inicial</button>
        </div>
        <section id="wrapper">
            <table>
                <tr>
                    <th>Data Aula</th>
                    <th>Número de Aulas</th>
                    <th>Dia da Semana</th>
                    <th>Conteúdo</th>
                    <th>Início</th>
                    <th>Fim</th>
                    <th>Entrada do aluno</th>
                    <th>Saida do aluno</th>
                    <th>Presenças</th>
                    <th>Faltas</th>
                </tr>
                <?php if (isset($data) && !empty($data)) : ?>
                    <?php foreach ($data as $row) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['dataaula']); ?></td>
                            <td><?php echo htmlspecialchars($row['numaulas']); ?></td>
                            <td><?php echo htmlspecialchars($row['semana']); ?></td>
                            <td><?php echo htmlspecialchars($row['conteudo']); ?></td>
                            <td><?php echo htmlspecialchars($row['Inicio']); ?></td>
                            <td><?php echo htmlspecialchars($row['Fim']); ?></td>
                            <td><?php echo htmlspecialchars($row['entrada_aluno']); ?></td>
                            <td><?php echo htmlspecialchars($row['saida_aluno']); ?></td>
                            <td><?php echo htmlspecialchars($row['Presencas']); ?></td>
                            <td><?php echo htmlspecialchars($row['Faltas']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8">Nenhum dado encontrado.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </section>
    </main>
</body>
</html>

