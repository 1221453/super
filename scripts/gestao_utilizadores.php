<?php
session_start();

// Conexão à base de dados
$db = new SQLite3(__DIR__ . '/../db/super.db');

// Remover utilizadores se o formulário for submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remover'])) {
    $remover = $_POST['remover'];
    $stmt = $db->prepare('DELETE FROM utilizadores WHERE email = :email');

    foreach ($remover as $email) {
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->execute();
    }

    $_SESSION['mensagem'] = "Utilizador(es) removido(s) com sucesso.";
    header('Location: gestao_utilizadores.php');
    exit;
}

// Obter utilizadores da base de dados
$utilizadores = $db->query('SELECT * FROM utilizadores');
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <title>Gestão de Utilizadores</title>
  <link rel="stylesheet" href="../styles/base.css">
  <link rel="stylesheet" href="../styles/admin.css">
</head>
<body>
  <div class="container">
    <h2>GESTÃO DE UTILIZADORES
      <button type="button" class="criar" onclick="window.location.href='criar_utilizador.html'">CRIAR UTILIZADOR</button>
    </h2>

    <?php if (isset($_SESSION['mensagem'])): ?>
      <p style="color: green;"><strong><?= htmlspecialchars($_SESSION['mensagem']) ?></strong></p>
      <?php unset($_SESSION['mensagem']); ?>
    <?php endif; ?>

    <form action="gestao_utilizadores.php" method="post">
      <table>
        <thead>
          <tr>
            <th>NOME</th>
            <th>EMAIL</th>
            <th>FUNÇÃO</th>
            <th>REMOVER</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $utilizadores->fetchArray(SQLITE3_ASSOC)): ?>
            <tr>
              <td><?= htmlspecialchars($row['username']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td><?= htmlspecialchars($row['tipo']) ?></td>
              <td><input type="checkbox" name="remover[]" value="<?= htmlspecialchars($row['email']) ?>"></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>

      <button type="submit" class="guardar">REMOVER SELECIONADOS</button>´

     <div class="nav-buttons">
  <a href="../admin.html" class="btn">⬅ Voltar</a>
 
</div>

    </form>
  </div>
</body>
</html>
