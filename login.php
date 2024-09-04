<?php
// Obtém os dados do formulário de login
$user = $_POST['user'];

// Verifica se o username é "55"
if ($user === '55') {
    echo "Login bem-sucedido!";
    // Aqui você pode redirecionar para outra página se quiser
    // header("Location: pagina_sucesso.php");
    // exit();
} else {
    // Mensagem de erro e redirecionamento de volta para a página de login
    echo "<script>alert('Usuário inválido.'); window.location.href='index.html';</script>";
}
?>
