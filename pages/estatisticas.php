<?php 
session_start(); 

include_once'../bd/goleDAO.php';
include_once'../bd/userDAO.php';


if(!isset($_SESSION['usuario_id'])){
     
    $idLogado = 0; 
} else {
    $idLogado = $_SESSION['usuario_id'];
}
?>


<!DOCTYPE html>

<html lang="pt-br">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Estatísticas - Grongus Beer</title>
</head>


<body> 
    <header class="main-header">
        <a href="index.php">
            <img src="../img/logo/Logo App Grongus.png" alt="Grongus Beer Logo" id="logo">
        </a>
    </header>
        

        <div id="divpe">

        <h1 class="stats-title">Suas Estatísticas de Degustação 📊</h1>
        <p class="subtitle">Análise profunda da sua jornada cervejeira.</p>
            
                <h2>Média de Notas por Tipo 🍺</h2>
                <div class="tiposmedia">
                    <?php
                    include_once '../bd/bdfunctions.php';
                    listarpl($idLogado);
                    ?>
                </div>

                <h2>Ranking das Favoritas ⭐</h2>
                <div class="ranking">
                    <?php
                    include_once '../bd/bdfunctions.php';
                    rank($idLogado);
                    ?>
                </div>

                <h2>Degustações por Mês 🗓️</h2>
                <div class="qtdemes">
                    <?php
                    include_once '../bd/bdfunctions.php';
                    mensal($idLogado);
                    ?>
                </div>
                <form action="home.php" method="get" class="form-voltar">
            <button class="btn-s" type="submit">Voltar para Home</button>
        </form>
        </div>
        
        

</body>
</html>