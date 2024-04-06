<?php
session_start();

// Verifica se a sessão de autenticação está ativa
if (!isset($_SESSION['auth_key'])) {
    // Redireciona para a página de login se não estiver autenticado
    header("Location: index.php");
    exit();
} else {
    // Verifica se o método de requisição é GET ou POST
    if ($_SERVER['REQUEST_METHOD'] === 'GET' || $_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verifica se o parâmetro 'action' foi enviado
        if(isset($_REQUEST['action'])) {
            // Lista de ações permitidas
            $allowedActions = array('desligar', 'reiniciar', 'desconectar_internet', 'bloquear');

            // Verifica se a ação solicitada está na lista de ações permitidas
            if (in_array($_REQUEST['action'], $allowedActions)) {
                // Executa a ação solicitada
                $action = $_REQUEST['action'];
                switch ($action) {
                    case 'desligar':
                        // Executa o comando de desligamento do sistema
                        exec('shutdown -s -t 0');
                        echo "1";
                        break;
                    case 'reiniciar':
                        // Executa o comando de reiniciar o sistema
                        exec('shutdown -r -t 0');
                        echo "1";
                        break;
                    case 'desconectar_internet':
                        // Executa o comando de desconectar da internet
                        exec('ipconfig /release');
                        echo "1";
                        break;
                    case 'bloquear':
                        // Executa o comando para bloquear o PC
                        exec('rundll32.exe user32.dll,LockWorkStation');
                        echo "1";
                        break;
                    default:
                        echo "0";
                        break;
                }
            } else {
                // Ação não permitida
                echo "0";
            }
        } else {
            // Nenhuma ação especificada
            echo "0";
        }
    } else {
        // Método de requisição não suportado
        echo "0";
    }
}

// Chave de autenticação (sua implementação)
$auth_key = $_SESSION['auth_key'];
?>
