<?php
session_start(); // Inicia a sessão

// Obtém os dados do formulário de login
$user = $_POST['user'];

// Verifica se o username é "55"
if ($user === '55') {
    // Define uma variável de sessão indicando que o usuário está logado
    $_SESSION['loggedin'] = true;

    // Aqui você pode redirecionar para outra página se quiser
    header("Location: usuario.php");
    exit();

} else {
    // Mensagem de erro e redirecionamento de volta para a página de login
    echo "<script>alert('Usuário inválido.'); window.location.href='index.html';</script>";

}

?>
