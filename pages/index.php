<?php
session_start();
include_once '../bd/userDAO.php'; 

if (isset($_POST['btlog'])) {
    if (!empty($_POST['nome']) && !empty($_POST['senha'])) {
        $nome = $_POST['nome'];
        $senha = $_POST['senha']; 
        
        if (logar($nome, $senha)) { 
             header('Location: home.php');
             exit();
        } else {
             echo "<h2>Erro: Nome de usuário ou senha incorretos.</h2>";
        }

    } else {
        echo "<h2>Atenção: Por favor, preencha todos os dados do usuário!</h2>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>GrongusBeer</title>
</head>
<body>
    <header id="hi">
        <a href="index.php">
            <img src="../img/logo/Logo App Grongus.png" alt="Grongus Beer Logo" id="logo">
        </a>
    </header>
    <div id="intro">
        <h1>.</h1>
    </div>
    <div id="divp">
        <h1>GRONGUS BEER</h1>
        <form action="index.php" method="post" id="formp"> 

            <div class="formp">
                <h3>Nome de Usuário</h3>
                <input type="text" class="cxi" name="nome">
            </div>

            <div class="formp">
                <h3>Senha</h3>
                <input type="text" class="cxi" name="senha">
            </div>

            <input id="btlog" class="btn-p" type="submit" name="btlog" value="Entrar">
        </form>

        <h4>Não é membro ainda? Cadastre-se grátis!</h4>
        <form action="cadastro.php">
            <input id="btcad" class="btn-s" type="submit" name="btcad" value="Cadastrar-se">
        </form>
    </div>
</body>
</html>





