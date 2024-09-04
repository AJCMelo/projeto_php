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
    <link rel="stylesheet" href="dashboard.css">
    <title>Dashboard</title>
</head>
<body>
    <main>
        <section id='container'>
            <div id='btn-wrapper'>
                <button id='in'>Entrada</button>
                <button id='out'>Saida</button>
                <button id='report'>Relatório</button>
            </div>
            <button id='logout'>Logout</button>
        </section>
    </main>
</body>
</html>