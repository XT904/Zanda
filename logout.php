<?php
// Desabilita a exibição de erros para evitar revelar informações sensíveis
ini_set('display_errors', 'Off');

// Inicia a sessão
session_start();

// Verifica se o usuário está autenticado antes de encerrar a sessão
if (isset($_SESSION['auth_key'])) {
    // Limpa todas as variáveis de sessão
    $_SESSION = array();

    // Invalida o cookie de sessão
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
    }

    // Destrói a sessão
    session_destroy();
}

// Redireciona o usuário para a página inicial
header("Location: index.php");
exit();
?>
