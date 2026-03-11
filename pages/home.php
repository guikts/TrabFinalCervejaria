<?php
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Grongus Beer</title>
</head>
<body>
    <header class="hh">
        <a href="index.php">
            <img src="../img/logo/Logo App Grongus.png" alt="Grongus Beer Logo" id="logo">
        </a>
    </header>
    <div id="divph">

        <?php
            if(isset($_SESSION['nome'])){
                $nome = $_SESSION['nome'];
                echo "<h2>Bem-Vindo(a) $nome</h2>";
            }
            else {
                echo "<h2>Bem-Vindo(a) Usuário</h2>";
            }
        ?>

        <p class="legends">O que deseja fazer?</p>
        
        <form class="formshome" action="cadDeg.php" method="post">
            <button class="btn-p" id="btnhome">Cadastrar Degustação 📝</button>
        </form>
        <form class="formshome" action="listar.php">
            <button class="btn-s" id="btnhome">Listar e Pesquisar 🔍</button>
        </form>
        <form class="formshome" action="galeria.php">
            <button class="btn-p" id="btnhome">Galeria de Rótulos 🖼️</button>
        </form>
        <form class="formshome" action="estatisticas.php">
            <button class="btn-s" id="btnhome">Estatísticas 📊</button>
        </form>
    </div>

    
</body>
</html>