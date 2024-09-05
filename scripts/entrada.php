<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit();

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/in.css">
    <title>Entrada</title>
</head>
<body>
    <header id="header">
        <img src="../assets/ifrn-banner.png" alt="Logo IFRN">
    </header>
    
    <main>
        <div id="back-wrapper">
            <span>Container <?php echo $_SESSION['container']; ?></span>
            <form action="marcar_entrada.php" method="post">
                <button id="btn" <?php echo isset($_SESSION['marcouEntrada']) && $_SESSION['marcouEntrada'] === true ? 'disabled' : ''; ?>>Registrar entrada</button>
            </form>
            <button id="btn" onclick="window.location.href='../usuario.php'">Voltar para tela inicial</button>
        </div>
    </main>
</body>
</html>