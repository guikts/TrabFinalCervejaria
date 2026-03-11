<?php
include_once '../bd/conexao.php';
function listarpl($idUsuario){
    $conexao = conectar("cervejaria", "root", "");

    $sql = "SELECT c.tipo, avg(c.avaliacao) as media
            FROM cerveja c
            WHERE c.usuario_id = :id
            GROUP BY c.tipo
            ORDER BY c.tipo;";
    
    $pstmt = $conexao->prepare($sql);
    $pstmt->bindValue(':id', $idUsuario, PDO::PARAM_INT);
    $pstmt->execute();

    echo "<table>";
    echo "<thead><tr>
            <th>Tipo</th>
            <th>Média</th>
          </tr></thead>";
    
    echo "<tbody>";

    while($linha = $pstmt->fetch()){
        echo "<tr>";
        echo "<td>" . $linha['tipo'] . "</td>";
        echo "<td>" . $linha['media'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";

    $conexao = encerrar();
}

function rank($idUsuario){
    $conexao = conectar("cervejaria", "root", "");

    $sql = "SELECT c.nome, c.avaliacao
            FROM cerveja c
            WHERE c.usuario_id = :id
            GROUP BY c.tipo
            ORDER BY c.avaliacao DESC;";
    
    $pstmt = $conexao->prepare($sql);
    $pstmt->bindValue(':id', $idUsuario, PDO::PARAM_INT);
    $pstmt->execute();

    echo "<table>";
    echo "<thead><tr>
            <th>Nome</th>
            <th>Nota</th>
          </tr></thead>";
    
    echo "<tbody>";

    while($linha = $pstmt->fetch()){
        echo "<tr>";
        echo "<td>" . $linha['nome'] . "</td>";
        echo "<td>" . $linha['avaliacao'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";

    $conexao = encerrar();
}

function mensal($idUsuario){
    $conexao = conectar("cervejaria", "root", "");

    $sql = "SELECT DATE_FORMAT(c.data, '%Y-%M') AS mes, count(*) AS quantidade
            FROM cerveja c
            WHERE c.usuario_id = :id
            GROUP BY mes
            ORDER BY mes DESC;";
    
    $pstmt = $conexao->prepare($sql);
    $pstmt->bindValue(':id', $idUsuario, PDO::PARAM_INT);
    $pstmt->execute();

    echo "<table>";
    echo "<thead><tr>
            <th>Mês</th>
            <th>Quantidade de Degustações</th>
          </tr></thead>";
    
    echo "<tbody>";

    while($linha = $pstmt->fetch()){
        echo "<tr>";
        echo "<td>" . $linha['mes'] . "</td>";
        echo "<td>" . $linha['quantidade'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";

    $conexao = encerrar();
}

?>