<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Grongus Beer</title>
</head>
<body id="bodyc">
    <header>
        <a href="index.php">
            <img src="../img/logo/Logo App Grongus.png" alt="Grongus Beer Logo" id="logo">
        </a>
    </header>
    <h2>Cadastro de Degustador</h2>

    <div id="divpc">
    <form action="cadastro.php" method="post" id="formp"> 
        <div class="divs">
            <h3>NOME DE USUÁRIO</h3>
            <input type="text" id="nome" class="cxi" name="nome">
        </div>

        <div class="divs">
            <h3>E-MAIL</h3>
            <input type="text" id="email" class="cxi" name="email">
        </div>

        <div class="divs">
            <h3>SENHA</h3>
            <input type="text" id="senha" class="cxi" name="senha" required>
        </div>
        <div class="divs">+
            <input id="btcad" class="btn-p" type="submit" name="btcad" value="CADASTRAR">
        </div>
    </form>
        <form action="index.php" method="get"  id="voltar">
            <input id="btvolt" class="btn-s" type="submit" name="btvolt" value="VOLTAR">
        </form>
    </div>

</body>

</html>

<?php

include_once '..\bd\userDAO.php'; 
if (isset($_POST['btcad'])) {
    if (!empty($_POST['nome']) || !empty($_POST['email']) || !empty($_POST['senha'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        caduser($nome, $email, $senha);
        header('Location: index.php');
        exit;
        
    } else {
        echo "<h2>Atenção: Por favor, preencha todos os dados do usuário!</h2>";
    }
}
?>