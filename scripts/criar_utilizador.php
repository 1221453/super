<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new SQLite3(__DIR__ . '/../db/super.db');

    $nome = trim($_POST['nome'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $tipo = $_POST['tipo'] ?? 'cliente';

    if ($nome && $username && $email && $password) {
        $stmt = $db->prepare("
            INSERT INTO utilizadores (nome, username, password, email, tipo) 
            VALUES (:nome, :username, :password, :email, :tipo)
        ");
        $stmt->bindValue(':nome', $nome, SQLITE3_TEXT);
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':tipo', $tipo, SQLITE3_TEXT);

        if ($stmt->execute()) {
            $_SESSION['mensagem'] = "✅ Utilizador criado com sucesso.";
            header('Location: gestao_utilizadores.php');
            exit;
        } else {
            echo "❌ Erro ao inserir na base de dados.";
        }
    } else {
        echo "⚠️ Preenche todos os campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <title>Criar Novo Utilizador</title>
</head>
<body>
  <h2>Criar Novo Utilizador</h2>

  <form action="criar_utilizador.php" method="post">
    Nome: <input type="text" name="nome" required>
    Username: <input type="text" name="username" required>
    Email: <input type="email" name="email" required>
    Password: <input type="password" name="password" required>
    Função:
    <select name="tipo">
      <option value="estudante">Estudante</option>
      <option value="cliente">Cliente</option>
      <option value="funcionario">Funcionário</option>
      <option value="admin">Administrador</option>
    </select>
    <button type="submit">CRIAR UTILIZADOR</button>
  </form>

  <p><a href="../admin.html">⬅ Voltar para Administração</a></p>
</body>
</html>
