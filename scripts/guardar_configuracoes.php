<?php
session_start();   
// scripts/guardar_configuracoes.php
// Verifica se o utilizador está autenticado
if (!isset($_SESSION['utilizador'])) {
    header('Location: login.php');
    exit;
} 
// Verifica se o utilizador tem permissão de administrador
if ($_SESSION['utilizador']['funcao'] !== 'Administrador') {
    header('Location: acesso_negado.php');
    exit;
}
// Inclui o ficheiro de configuração
require_once 'config.php';
// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém as configurações do formulário
    $configuracoes = [
        'site_name' => $_POST['site_name'] ?? '',
        'site_description' => $_POST['site_description'] ?? '',
        'admin_email' => $_POST['admin_email'] ?? '',
        'timezone' => $_POST['timezone'] ?? '',
    ];
    
    // Valida as configurações
    foreach ($configuracoes as $key => $value) {
        if (empty($value)) {
            $_SESSION['mensagem'] = "O campo {$key} não pode estar vazio.";
            header('Location: configuracoes.php');
            exit;
        }
    }
    
    // Guarda as configurações no ficheiro de configuração
    file_put_contents('config.php', "<?php\nreturn " . var_export($configuracoes, true) . ";\n");
    
    // Define a mensagem de sucesso
    $_SESSION['mensagem'] = 'Configurações guardadas com sucesso.';
    
    // Redireciona para a página de configurações
    header('Location: configuracoes.php');
    exit;
}
// Exibe erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);