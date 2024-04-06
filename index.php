<?php
session_start();

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$auth_keys = array(
    '123' => true,
    'ZandaBtHCdUNhvrYR' => true
);

$tempoMaximoInatividade = 1800; // 30 minutos

if (isset($_SESSION['ultimo_acesso'])) {
    if (time() - $_SESSION['ultimo_acesso'] > $tempoMaximoInatividade) {
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }
}

$auth_key = isset($_POST['auth_key']) ? htmlspecialchars($_POST['auth_key']) : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Erro: Token CSRF inválido.");
    }

    if (empty($auth_key)) {
        $_SESSION['login_status'] = "Por favor, preencha todos os campos.";
    } else {
        if (!empty($auth_key) && isset($auth_keys[$auth_key])) {
            $_SESSION['auth_key'] = $auth_key;
            header("Location: painel.php");
            exit();
        } else {
            $_SESSION['login_status'] = "Chave de autenticação inválida.";
        }
    }
}

$_SESSION['ultimo_acesso'] = time();
?>

<!DOCTYPE html>
<!-- By XT904 | Github: Github.com/XT904
███████╗ █████╗ ███╗   ██╗██████╗  █████╗      ██╗   ██╗██╗   ██╗
╚══███╔╝██╔══██╗████╗  ██║██╔══██╗██╔══██╗    ███║  ███║██║   ██║
  ███╔╝ ███████║██╔██╗ ██║██║  ██║███████║    ╚██║  ╚██║██║   ██║
 ███╔╝  ██╔══██║██║╚██╗██║██║  ██║██╔══██║     ██║   ██║╚██╗ ██╔╝
███████╗██║  ██║██║ ╚████║██████╔╝██║  ██║     ██║██╗██║ ╚████╔╝ 
╚══════╝╚═╝  ╚═╝╚═╝  ╚═══╝╚═════╝ ╚═╝  ╚═╝     ╚═╝╚═╝╚═╝  ╚═══╝  
                                                                   
-->
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Zanda</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.ico">
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body class="bg-panel">
    <div class="login-panel">
        <div class="container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="panel" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                <h2 class="ani-logo"><span style="font-size: 7rem;">Zanda</span></h2>
                <?php
                if (isset($_SESSION['login_status'])) {
                    $statusClass = ($_SESSION['login_status'] === "Login bem-sucedido! Redirecionando...") ? "success" : "error";
                    echo '<div class="alert alert-' . $statusClass . '" role="alert">' . htmlspecialchars($_SESSION['login_status'], ENT_QUOTES, 'UTF-8') . '</div>';
                    unset($_SESSION['login_status']);
                }
                ?>
                <input class="ani-input" name="auth_key" type="password" id="auth_key" required="">
                <button class="button" type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
