<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.html");
    exit();

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Dashboard</title>
</head>
<body>
    <main>
        <section id='container'>
            <span id="containerID">Container: <?php echo $_SESSION['container']; ?></span>
            <div id='btn-wrapper'>
                <button id='in' onclick="window.location.href='scripts/entrada.php'">Entrada</button>
                <button id='out' onclick="window.location.href='scripts/saida.php'">Saida</button>
                <button id='report' onclick="window.location.href='scripts/relatorio.php'">Relatório</button>
            </div>
            <button id='logout' onclick="window.location.href='scripts/logout.php'">Logout</button>
        </section>
    </main>
</body>
</html>