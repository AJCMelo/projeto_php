<?php
session_start();

// Verifica se o usuário está logado
if (isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === true) {
    header("Location: usuario.php");
    exit();

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/style.css">
    <title>IFRN</title>
</head>
<body>

    <header id="header">
        <img src="assets/ifrn-banner.png" alt="Logo IFRN">
    </header>

    <main>
        <form id="form" action="./scripts/login.php" method="post">
            <label for="user" id="label">
                Usuário:
                <input id="user" name="user" type="text" placeholder="Usuário" required/>
            </label>
            <label for="pass" id="label">
                Senha:
                <input id="pass" name="pass" type="password" placeholder="Senha" required/>
            </label>

            <button type="submit" id="btn">Entrar</button>
        </form>
    </main>
    
</body>
</html>
