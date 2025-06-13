<?php
session_start();
$db = new SQLite3(__DIR__ . '/../db/super.db');

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID inválido.";
    exit;
}

// Verifica se o utilizador atual é admin
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    echo "Acesso negado. Apenas administradores podem editar utilizadores.";
    exit;
}

// Se for POST, atualizar dados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $tipo = trim($_POST['tipo'] ?? '');
    $novaSenha = trim($_POST['nova_senha'] ?? '');

    $stmt = $db->prepare("UPDATE utilizadores SET nome = :nome, email = :email, tipo = :tipo WHERE id = :id");
    $stmt->bindValue(':nome', $nome, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':tipo', $tipo, SQLITE3_TEXT);
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $stmt->execute();

    // Atualizar password se foi fornecida
    if (!empty($novaSenha)) {
        $stmtSenha = $db->prepare("UPDATE utilizadores SET password = :password WHERE id = :id");
        $stmtSenha->bindValue(':password', password_hash($novaSenha, PASSWORD_DEFAULT), SQLITE3_TEXT);
        $stmtSenha->bindValue(':id', $id, SQLITE3_INTEGER);
        $stmtSenha->execute();
    }

    // Redireciona com mensagem (pode ser melhorado via flash session)
    header("Location: ../admin.html");
    exit;
}

// Buscar dados do utilizador atual
$stmt = $db->prepare("SELECT * FROM utilizadores WHERE id = :id");
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
$res = $stmt->execute();
$utilizador = $res->fetchArray(SQLITE3_ASSOC);

if (!$utilizador) {
    echo "Utilizador não encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>Editar Utilizador</title>
</head>
<body>
    <h2>Editar Utilizador</h2>
    <form method="post">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($utilizador['nome']) ?>" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($utilizador['email']) ?>" required><br>

        <label>Tipo:</label>
        <select name="tipo">
            <option value="cliente" <?= $utilizador['tipo'] === 'cliente' ? 'selected' : '' ?>>Cliente</option>
            <option value="funcionario" <?= $utilizador['tipo'] === 'funcionario' ? 'selected' : '' ?>>Funcionário</option>
            <option value="admin" <?= $utilizador['tipo'] === 'admin' ? 'selected' : '' ?>>Administrador</option>
            <option value="cliente" <?= $utilizador['tipo'] === 'cliente' ? 'selected' : '' ?>>Cliente</option>
        </select><br><br>

        <label>Nova Palavra-passe (deixar vazio para manter):</label>
        <input type="password" name="nova_senha"><br><br>

        <button type="submit">Guardar Alterações</button>
        <a href="../admin.html">Cancelar</a>
    </form>
</body>
</html>
