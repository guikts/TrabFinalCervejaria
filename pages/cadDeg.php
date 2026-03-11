<?php
session_start();

include_once '../bd/goleDAO.php';

if(!isset($_SESSION['usuario_id'])){
    header('Location: index.php');
    exit();
}

if (isset($_POST['btcadDeg'])){
    if(empty($_POST['nomeC']) || empty($_POST['tipo']) || empty($_POST['data']) || empty($_POST['teorA']) || empty($_POST['ibu']) || empty($_POST['nota']) || empty($_POST['origemC']) || empty($_POST['fabrC']) || empty($_POST['local']) || empty($_POST['comentario'])){
        echo "<h2>Atenção: Por favor, preencha todos os campos!</h2>";
    } 
    elseif (isset($_FILES['rotulo']) && $_FILES['rotulo']['error'] === UPLOAD_ERR_OK) {

            $cd = '../img/geral/';
            $extensao = pathinfo($_FILES['rotulo']['name'], PATHINFO_EXTENSION);
            $nomearquni = time() . '_' . uniqid() . '.' . $extensao;
            $cdc = $cd . $nomearquni;

            if (move_uploaded_file($_FILES['rotulo']['tmp_name'], $cdc)) {
                $cdcbd = 'img/geral/' . $nomearquni;

        $info = [
            'nomeC' => $_POST['nomeC'],
            'tipo' => $_POST['tipo'],
            'teorA' => $_POST['teorA'],
            'ibu' => $_POST['ibu'],
            'origemC' => $_POST['origemC'],
            'fabrC' => $_POST['fabrC'],
            'local' => $_POST['local'],
            'data' => $_POST['data'],
            'nota' => $_POST['nota'],
            'comentario' => $_POST['comentario'],
            'usuario_id' => $_SESSION['usuario_id'],
            'rotulo' => $cdcbd
        ];
        $dao = new goleDAO();
        if ($dao->caddeg($info)){
            echo "<h1>Degustação Cadastrada com Sucesso!</h1>";
            header('Location:  home.php');
            exit();
        }else{
            echo "<h1>Erro ao Cadastrar Degustação!</h1>";
        }
    }else{
        echo "<h2>Erro ao enviar o arquivo do rótulo.</h2>";}
    }
} else{
    echo "<h2>Atenção: Por favor, envie a foto do rótulo!</h2>";
}


?>



<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>GRONGUS BEER</title>
</head>

<body>

    <header>
        <a href="index.php">
            <img src="../img/logo/Logo App Grongus.png" alt="Grongus Beer Logo" id="logo">
        </a>
    </header>

    <div id="divcd">
        <form action="cadDeg.php" method="post" enctype="multipart/form-data">

            <h3 for="nomeC">Nome da Cerveja:</h3><br>
            <input type="text" id="nomeC" class="cxi" name="nomeC"><br><br>

            
            <h3 for="tipoC">Tipo da Cerveja:</h3><br>

            <div id="tipoC">
                <label for="tipo">Tipo de Cerveja:</label>
                    <select id="tipo" name="tipo">
                        <option value="">Selecione</option>
                        <option value="pilsen">Pilsen/Lager</option>
                        <option value="blondeale">Blonde Ale</option>
                        <option value="weiss">Weissbier</option>
                        <option value="ipa">IPA</option>
                        <option value="stout">Stout</option>
                        <option value="porter">Porter</option>
                        <option value="pale ale">Pale Ale</option>
                        <option value="sour">Sour</option>
                        <option value="red ale">Red Ale</option>
                    </select>
            </div>

            <h3 for="teorA">Porcentagem de Alcool:</h3><br>
            <input type="number" id="teorA" class="cxi" name="teorA" value="0">


            <h3 for="ibu">IBU:</h3><br>
            <div id="ibu">
                <label><input type="radio" name="ibu" value="baixo" class="radio"> entre 10 e 15</label><br>
                <label><input type="radio" name="ibu" value="medio" class="radio"> aprox 35</label><br>
                <label><input type="radio" name="ibu" value="alto" class="radio"> maior ou igual a 40</label><br>
                <label><input type="radio" name="ibu" value="muitoalto" class="radio"> maior que 60</label><br>
            </div>

            <h3 for="origemC">País de Origem da Cerveja:</h3><br>
            <input type="text" id="origemC" class="cxi" name="origemC"><br><br>

            <h3 for="fabrC">Fabricante da Cerveja:</h3><br>
            <input type="text" id="fabrC" class="cxi" name="fabrC"><br><br>

            <h3 for="data">Data de Degustação</h3>
            <input type="date" name="data" value="data" class="cxi">

            <h3 for="local">Local da Degustação</h3>
            <input type="text" name="local" value="local" class="cxi">

    <h3 for="notaC">Avaliação</h3><br>
    <div id="nota">
        <label><input type="radio" name="nota" value="zero" class="radio"> 0</label>
        <label><input type="radio" name="nota" value="um" class="radio"> 1</label>
        <label><input type="radio" name="nota" value="dois" class="radio"> 2</label>
        <label><input type="radio" name="nota" value="tres" class="radio"> 3</label>
        <label><input type="radio" name="nota" value="quatro" class="radio"> 4</label>
        <label><input type="radio" name="nota" value="cinco" class="radio"> 5</label>
        <label><input type="radio" name="nota" value="seis" class="radio"> 6</label>
        <label><input type="radio" name="nota" value="sete" class="radio"> 7</label>
        <label><input type="radio" name="nota" value="oito" class="radio"> 8</label>
        <label><input type="radio" name="nota" value="nove" class="radio"> 9</label>
        <label><input type="radio" name="nota" value="dez" class="radio"> 10</label>
    </div>

    <h3 for="comentario">Comentários Pessoais</h3>
    <textarea id="comentario" class="cxi" name="comentario"></textarea><br><br>

    <h3 for="rotulo">Foto do Rótulo</h3>
    <input type="file" id="rotulo" class="cxi" name="rotulo"><br><br>


        <input type="submit" class="btn-p" id="gambiarra" name="btcadDeg" value="CADASTRAR DEGUSTAÇÃO">
</form> 
    <form action="home.php" method="get"  id="voltar">
        <input id="btvolt" class="btn-s" type="submit" name="btvolt" value="VOLTAR">
    </form>
</div>
</body>
</html>




