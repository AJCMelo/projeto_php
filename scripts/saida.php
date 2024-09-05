<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/out.css">
    <title>Saida</title>
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
    </main>
</body>
</html>