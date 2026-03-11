<!-- PURA IA-->
<?php
session_start();

include_once '../bd/goleDAO.php';

// 1. Verifica se o usuário está logado
if(!isset($_SESSION['usuario_id'])){
    // Se não estiver logado, redireciona
    header('Location: index.php');
    exit();
}

$idLogado = $_SESSION['usuario_id'];
$goleDAO = new goleDAO();
$rotulos = $goleDAO->rotulosuser($idLogado);

// 2. Define o estilo de exibição se houver rótulos
$estiloDisplay = ($rotulos && count($rotulos) > 0) ? 'display: grid;' : 'display: block;';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css"> <title>Galeria de Rótulos - Grongus Beer</title>
    
    <style>
        /* Apenas um CSS simples de exemplo para a galeria */
        .galeria-rotulos {
            width: 90%;
            margin: 20px auto;
            /* Usamos a variável PHP para definir o display */
            display: grid; 
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            padding: 10px;
        }
        .rotulo-item {
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
            text-align: center;
        }
        .rotulo-item img {
            width: 100%;
            height: 150px; /* Altura fixa para os previews */
            object-fit: contain; /* Garante que a imagem caiba sem cortar */
            background-color: #f9f9f9;
        }
        .rotulo-item a {
            display: block;
            padding: 5px;
            text-decoration: none;
            color: #333;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <header class="main-header">
        <a href="index.php">
            <img src="../img/logo/Logo App Grongus.png" alt="Grongus Beer Logo" id="logo">
        </a>
    </header>

    <h2>🍻 Minha Galeria de Rótulos</h2>
    
    <div class="galeria-rotulos">
        <?php if ($rotulos && count($rotulos) > 0): ?>
            <?php foreach ($rotulos as $rotulo): ?>
                <div class="rotulo-item">
                    <a href="detalhes.php?id=<?php echo $rotulo['id']; ?>">
                        <img src="../<?php echo htmlspecialchars($rotulo['rotulo']); ?>" 
                             alt="Rótulo da Cerveja ID: <?php echo $rotulo['id']; ?>">
                        </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; grid-column: 1 / -1;">
                Parece que você ainda não cadastrou nenhum rótulo. Bora beber e avaliar! 🍺
            </p>
        <?php endif; ?>
    </div>
    
    <form action="home.php" method="get" class="formv" style="text-align: center; margin-top: 20px;">
        <button class="btn-s" type="submit">Voltar para Home</button>
    </form>
</body>
</html>