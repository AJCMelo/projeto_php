<?php
session_start();

$user = $_POST['user'];

if ($user === '55') {
    $_SESSION['loggedin'] = true;
    header("Location: ../usuario.php");
    exit();
} else {
    echo "<script>alert('Usuário não encontrado.'); window.location.href='../index.html';</script>";
    exit();

}
?>
