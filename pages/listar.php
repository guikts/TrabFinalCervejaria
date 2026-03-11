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
    <title>Listagem e Pesquisa - Grongus Beer</title>
</head>

<body> 

    <header>
        <a href="index.php">
            <img src="../img/logo/Logo App Grongus.png" alt="Grongus Beer Logo" id="logo">
        </a>
    </header>

    <div id="divpl">
        <h1>Suas Degustações Cadastradas</h1>
        <p class="legenda">Filtre, ordene e encontre sua cerveja favorita.</p>

        <div>
            <form class="fft" action="listar.php" method="get">
                
                <div class="filtrostipo">
                    <h3>Filtrar por Estilo:</h3>
                    <select id="filtro-estilo" name="estilo" class="cxi">
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

                <div class="filtronota">
                    <h3>Nota Mínima:</h3>
                    <input type="number" id="filtro-nota" name="nota" class="cxi" min="0" max="10" placeholder="Ex: 8.0">
                </div>

                <div class="filtrodata">
                    <h3>Filtrar Após Data:</h3>
                    <input type="date" id="filtro-data" name="data" class="cxi">
                </div>

                <div class="filtroordem">
                    <h3>Ordenar por:</h3>
                    <select id="ordenar" name="ordem" class="cxi">
                        <option value="avaliacao_desc">Avaliação (Maior)</option>
                        <option value="nome_asc">Nome (A-Z)</option>
                        <option value="pais_asc">País (A-Z)</option>
                        <option value="data_desc">Mais Recente</option>
                    </select>
                </div>
                
                <button type="submit" class="btn-p">APLICAR FILTROS</button>
            </form>
        </div>
        
        <p class="contagem">Exibindo suas degustações.</p>

        <div class="table-responsive">
            <table class="degustacao-table">
                <thead>
                    <tr>
                        <th>Nome da Cerveja</th>
                        <th>Estilo</th>
                        <th>IBU</th>
                        <th>Nota</th>
                        <th>Data</th>
                        <th>País</th>
                        <th>Detalhes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
        if($idLogado > 0){
            
            $filtros = [
                'estilo' => $_GET['estilo'] ?? '', // Se não existir, fica vazio
                'nota'   => $_GET['nota'] ?? '',
                'data'   => $_GET['data'] ?? '',
                'ordem'  => $_GET['ordem'] ?? ''
            ];

            $dao = new goleDAO(); 
            
           
            $dao->listarCeva($idLogado, $filtros);

        } else {
            echo "<tr><td colspan='7'>Você precisa fazer login.</td></tr>";
        }
    ?>
                </tbody>
            </table>
        </div>
        
        <form action="home.php" method="get" class="formv">
            <button class="btn-s" type="submit">Voltar para Home</button>
        </form>

    </div>
</body>
</html>