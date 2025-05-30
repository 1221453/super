<?php
$pesquisa = $_GET['q'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>Resultados da Pesquisa</title>
    <link rel="stylesheet" href="../styles/pesquisa.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .resultados {
            padding: 2rem;
            font-size: 1.2rem;
        }
        .produto {
            padding: 1rem;
            border: 1px solid #ddd;
            margin-bottom: 1rem;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="linha-topo"></div>
    <div class="container">
        <header class="top-bar">
            <div class="logo">
                <div class="logo-box">S</div>
                <span class="logo-text">Super</span>
            </div>
            <div class="nav-buttons">
                <a href="../index.html" class="btn">INÍCIO</a>
                <a href="../produto.html" class="btn">PRODUTOS</a>
            </div>
        </header>

        <main class="search-bar">
            <?php if ($pesquisa): ?>
                <h2>Resultados da pesquisa para: <em><?= htmlspecialchars($pesquisa) ?></em></h2>

                <!-- Simulação de resultados -->
                <div class="produto">Produto: <?= htmlspecialchars($pesquisa) ?> Integral 1L</div>
                <div class="produto">Produto: <?= htmlspecialchars($pesquisa) ?> com Chocolate</div>
                <div class="produto">Produto: <?= htmlspecialchars($pesquisa) ?> Light</div>

            <?php else: ?>
                <p>Introduza um termo na pesquisa.</p>
            <?php endif; ?>
        </main>

        <div class="linha-rodape-total"></div>
        <footer class="footer-links">
            <a href="#">Contactos</a>
            <a href="#">Links úteis</a>
            <a href="#">Termo de Serviço</a>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </footer>
    </div>
</body>
</html>
