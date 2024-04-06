<?php
ini_set('display_errors', 'Off');
session_start();
if (!isset($_SESSION['auth_key'])) {
    header("Location: index.php");
    exit();
}
$auth_key = $_SESSION['auth_key'];


$sistema_operacional = php_uname('s'); // Nome do sistema operacional
$versao_php = phpversion(); // Versão do PHP
$versao_apache = apache_get_version(); // Versão do Apache (se disponível)

// Obter o IP do servidor
$ip_servidor = $_SERVER['SERVER_ADDR'];

// Usar ipinfo.io para obter informações sobre a localização do IP do servidor
$dados_ip = file_get_contents('https://ipinfo.io/' . $ip_servidor . '/json');
$dados_ip_array = json_decode($dados_ip, true);

// Exibir informações sobre a localização do IP do servidor
$localizacao_servidor = isset($dados_ip_array['city']) ? $dados_ip_array['city'] . ', ' : '';
$localizacao_servidor .= isset($dados_ip_array['region']) ? $dados_ip_array['region'] . ', ' : '';
$localizacao_servidor .= isset($dados_ip_array['country']) ? $dados_ip_array['country'] : '';

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
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Painel de Controle</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" type="text/css" href="css/painel.css">
</head>
<body>
<div class="panel">
    <div class="icon" id="shutdown">
        <i class="fas fa-power-off"></i>
        <span>Desligar</span>
    </div>
    <div class="icon" id="restart">
        <i class="fas fa-redo-alt"></i>
        <span>Reiniciar</span>
    </div>
    <div class="icon" id="wifi">
        <i class="fas fa-wifi"></i>
        <span>Gerir Wi-Fi</span>
    </div>
	<div class="icon" id="lock">
        <i class="fas fa-lock"></i>
        <span>Bloquear</span>
    </div>
    <div class="icon" id="logout">
        <i class="fas fa-sign-out-alt"></i>
        <span>Terminar Sessão</span>
    </div>
</div>
<div class="system-info-panel">
    <div class="panel-header">
        <h2>Informações do Sistema</h2>
    </div>
    <div class="panel-body">
        <ul>
            <li><strong>Sistema Operacional:</strong> <?php echo $sistema_operacional; ?></li>
            <li><strong>Versão do PHP:</strong> <?php echo $versao_php; ?></li>
            <li><strong>Versão do Apache:</strong> <?php echo $versao_apache; ?></li>
            <li><strong>IP do Servidor:</strong> <?php echo $ip_servidor; ?></</li>
            <li><strong>Localização do Servidor:</strong> <?php echo $localizacao_servidor; ?></li>
        </ul>
    </div>
</div>
<div class="notification-popup" id="notificationPopup">
    <div class="notification-content">
        <span class="close-button" onclick="closeNotification()">×</span>
        <p id="notificationMessage"></p>
    </div>
</div>

<script src="js/script.js"></script>
</body>
</html>
