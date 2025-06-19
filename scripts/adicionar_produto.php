<?php
$db = new SQLite3('../dados.db');

// Só continua se for uma submissão POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Previne erros se algum campo estiver em falta
    $nome = $_POST['nome_produto'] ?? null;
    $preco = $_POST['preco'] ?? null;
    $marca = $_POST['marca'] ?? null;
    $imagem = $_POST['imagem'] ?? null;
    $descricao = $_POST['descricao'] ?? null;

    // Verifica se os campos obrigatórios foram preenchidos
    if ($nome && $preco && $marca && isset($_FILES['imagem'])) {
        $targetDir = "../imagens_produtos/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true); 
        }

        if ($_FILES['imagem']['error'] === 0) {
            $imagemNome = basename($_FILES["imagem"]["name"]);
            $imagemCaminho = $targetDir . $imagemNome;

            if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $imagemCaminho)) {
                $stmt = $db->prepare("INSERT INTO produtos (nome, preco, marca, descricao, imagem) VALUES (?, ?, ?, ?, ?)");
                $stmt->bindValue(1, $nome);
                $stmt->bindValue(2, $preco);
                $stmt->bindValue(3, $marca);
                $stmt->bindValue(4, $descricao);
                $stmt->bindValue(5, $imagem);
                $stmt->execute();

                echo "<script>alert('Produto \"$nome\" adicionado com sucesso!'); window.history.back()</script>";
            } else {
                echo "<script>alert('Erro ao guardar a imagem.'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Erro no upload da imagem: " . $_FILES['imagem']['error'] . "'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Campos obrigatórios em falta.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Acesso inválido ao script.'); window.history.back();</script>";
}
?>
