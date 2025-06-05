<?php
$db = new SQLite3('../dados.db');

$nome = $_POST['nome_produto'];
$preco = $_POST['preco'];
$marca = $_POST['marca'];
$descricao = $_POST['descricao'];

$targetDir = "../imagens_produtos/";
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true); 
}

if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
    $imagemNome = basename($_FILES["imagem"]["name"]);
    $imagemCaminho = $targetDir . $imagemNome;

    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $imagemCaminho)) {
   
        $stmt = $db->prepare("INSERT INTO produtos (nome, preco, marca, descricao, imagem) VALUES (?, ?, ?, ?, ?)");
        $stmt->bindValue(1, $nome);
        $stmt->bindValue(2, $preco);
        $stmt->bindValue(3, $marca);
        $stmt->bindValue(4, $descricao);
        $stmt->bindValue(5, $imagemNome);
        $stmt->execute();

        echo "Produto '$nome' adicionado com sucesso!";
    } else {
        echo "Erro ao guardar a imagem.";
    }
} else {
    echo "Erro no upload da imagem.";
}
?>