function showNotification(message, type) {
    var notificationPanel = document.getElementById('notificationPanel');
    var notificationContent = document.getElementById('notificationContent');
    var notificationMessage = document.getElementById('notificationMessage');

    notificationMessage.innerText = message;
    notificationContent.classList.remove('notification-success', 'notification-danger');

    if (type === 'success') {
        notificationContent.classList.add('notification-success');
    } else if (type === 'danger') {
        notificationContent.classList.add('notification-danger');
    }

    notificationContent.classList.add('show-notification');

    setTimeout(function() {
        notificationContent.classList.remove('show-notification');
    }, 3000); // Duração da notificação (em milissegundos)
}

// Exemplo de uso:
// showNotification('Login bem-sucedido!', 'success');
// showNotification('Erro ao efetuar login!', 'danger');


function enviarRequisicao(acao) {
    // Criar uma nova requisição XMLHttpRequest
    var xhr = new XMLHttpRequest();
    
    // Configurar a requisição para enviar um POST para 'send.php' com a ação especificada
    xhr.open('POST', 'send.php?action=' + acao, true);
    
    // Definir o cabeçalho Content-Type para 'application/x-www-form-urlencoded'
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    // Enviar a requisição sem parâmetros
    xhr.send();
}

// Adicionar um ouvinte de eventos aos elementos de ícone
document.getElementById('shutdown').addEventListener('click', function() {
    enviarRequisicao('desligar');
});

document.getElementById('restart').addEventListener('click', function() {
    enviarRequisicao('reiniciar');
});

document.getElementById('wifi').addEventListener('click', function() {
    enviarRequisicao('gerir_wifi');
})

document.getElementById('lock').addEventListener('click', function() {
    enviarRequisicao('bloquear');
})

document.getElementById('logout').addEventListener('click', function() {
    // Redirecionar para o arquivo logout.php
    window.location.href = 'logout.php';
});

