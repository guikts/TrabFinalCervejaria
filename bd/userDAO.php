<?php
include_once '../bd/conexao.php';
function caduser($nome, $email, $senha): void {
    
    try {
        $conexao = conectar("cervejaria", "root", "");
        $sql_usuario = "INSERT INTO usuario (nome, email, senha) VALUES (:nome, :email, :senha)";
        $pstmt_usuario = $conexao->prepare($sql_usuario);
        $pstmt_usuario->bindValue(":nome", $nome);
        $pstmt_usuario->bindValue(":email", $email);
        $pstmt_usuario->bindValue(":senha", $senha);
        $pstmt_usuario->execute();
    } catch (PDOException $e) {
    }
    $conexao = encerrar();
}

function logar($nome, $senha): bool {
    try{
        $conexao = conectar("cervejaria", "root", "");
        $sql_login = "SELECT id, nome FROM usuario WHERE nome = :nome AND senha = :senha"; 
        $pstmt_login = $conexao->prepare($sql_login);
        $pstmt_login->bindValue(":nome", $nome);
        $pstmt_login->bindValue(":senha", $senha);
        $pstmt_login->execute();
        $usuario = $pstmt_login->fetch(PDO::FETCH_ASSOC);

        if($usuario){
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['usuario_id'] = $usuario['id'];
            return true; 
        } else {
            return false;
        }
    } catch(PDOException $e){
        echo "Erro ao logar: " . $e->getMessage();
        return false;
    }

}

?>