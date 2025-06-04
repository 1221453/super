<?php
session_start();

// Lista simulada de utilizadores (em produção isto viria da base de dados)
$utilizadores = [
    'admin' => ['nome' => 'Administrador', 'funcao' => 'Admin'],
    'funcionario' => ['nome' => 'Funcionário', 'funcao' => 'Funcionário'],
    'cliente' => ['nome' => 'Cliente', 'funcao' => 'Cliente'],
    '1221453@isep.ipp.pt' => ['nome' => 'Susana Vieira', 'funcao' => 'Estudante'],
    '1221446@isep.ipp.pt' => ['nome' => 'João Brandão', 'funcao' => 'Estudante'],
];

// Obter emails a remover
$remover = $_POST['remover'] ?? [];

if (!empty($remover)) {
    foreach ($remover as $email) {
        // Aqui seria a lógica para remover da base de dados
        unset($utilizadores[$email]); // Simulação de remoção
    }

    // Guardar feedback em sessão
    $_SESSION['mensagem'] = 'Utilizador(es) removido(s) com sucesso.';
} else {
    $_SESSION['mensagem'] = 'Nenhum utilizador foi selecionado.';
}

// Redirecionar de volta à página de gestão
header('Location: gestao_utilizadores.php');
exit;
?>