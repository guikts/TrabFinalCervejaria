<?php

class goleDAO {
    private $conexao;

    public function __construct(){
        try{
            // Cria a conexão ao iniciar a classe
            $this->conexao = new PDO("mysql:host=localhost;dbname=cervejaria;", "root", "");
        }catch (PDOException $e){
            die("Erro na conexão com o banco de dados: " . $e->getMessage()); 
        }
    }

    public function caddeg(array $info): bool {
        try {
            $sql_gole = "INSERT INTO cerveja (nome, tipo, porcentagem, ibu, pais, fabricante, data, local, avaliacao, comentarios, rotulo, usuario_id) VALUES (:nome, :tipo, :porcentagem, :ibu, :pais, :fabricante, :data, :local, :avaliacao, :comentarios, :rotulo, :usuario_id)";
            $pstmt_gole = $this->conexao->prepare($sql_gole);
            
            $ibu_num = $this->convibu($info['ibu']);
            $nota_num = $this->convnota($info['nota']);

            $pstmt_gole->bindValue(":nome", $info['nomeC']);
            $pstmt_gole->bindValue(":tipo", $info['tipo']);
            $pstmt_gole->bindValue(":porcentagem", $info['teorA']);
            $pstmt_gole->bindValue(":ibu", $ibu_num, PDO::PARAM_INT);
            $pstmt_gole->bindValue(":pais", $info['origemC']);
            $pstmt_gole->bindValue(":fabricante", $info['fabrC']);
            $pstmt_gole->bindValue(":data", $info['data']);
            $pstmt_gole->bindValue(":local", $info['local']);
            $pstmt_gole->bindValue(":avaliacao", $nota_num, PDO::PARAM_INT);
            $pstmt_gole->bindValue(":comentarios", $info['comentario']);
            $pstmt_gole->bindValue(":usuario_id", $info['usuario_id'], PDO::PARAM_INT);
            $pstmt_gole->bindValue(":rotulo", $info['rotulo']);
            
            $pstmt_gole->execute();

            return true;
        } catch (PDOException $e) {
            echo "Erro ao cadastrar: " .$e->getMessage();
            return false;
        }
    }
    
    private function convibu(string $ibubd):int{
        switch($ibubd){
            case "baixo": return 12;
            case "medio": return 35;
            case "alto": return 45;
            case "muitoalto": return 65;
            default: return 0;
        }
    }

    private function convnota(string $notabd): int{
        switch($notabd){
            case "zero": return 0;
            case "um": return 1;
            case "dois": return 2;
            case "tres": return 3;
            case "quatro": return 4;
            case "cinco": return 5;
            case "seis": return 6;
            case "sete": return 7;
            case "oito": return 8;
            case "nove": return 9;
            case "dez": return 10;
            default: return 0;
        }
    }

 public function listarCeva($idUsuario, $filtros = []) {
        $sql = "SELECT id, nome, tipo, porcentagem, IBU, pais, 
                       fabricante, data, local, avaliacao, comentarios
                FROM cerveja 
                WHERE usuario_id = :id ";

        if (!empty($filtros['estilo'])) {
            $sql .= " AND tipo = :estilo ";
        }
        
        if (!empty($filtros['nota'])) {
            $sql .= " AND avaliacao >= :nota "; 
        }

        if (!empty($filtros['data'])) {
            $sql .= " AND data >= :data "; 
        }

        $ordemSQL = " ORDER BY nome ASC"; 
        
        if (!empty($filtros['ordem'])) {
            switch ($filtros['ordem']) {
                case 'avaliacao_desc': $ordemSQL = " ORDER BY avaliacao DESC"; break;
                case 'nome_asc':       $ordemSQL = " ORDER BY nome ASC"; break;
                case 'pais_asc':       $ordemSQL = " ORDER BY pais ASC"; break;
                case 'data_desc':      $ordemSQL = " ORDER BY data DESC"; break;
            }
        }
        $sql .= $ordemSQL;

        $pstmt = $this->conexao->prepare($sql);

        $pstmt->bindValue(':id', $idUsuario);

        if (!empty($filtros['estilo'])) {
            $pstmt->bindValue(':estilo', $filtros['estilo']);
        }
        
        if (!empty($filtros['nota'])) {
            $pstmt->bindValue(':nota', $filtros['nota']);
        }

        if (!empty($filtros['data'])) {
            $pstmt->bindValue(':data', $filtros['data']);
        }

        $pstmt->execute();

        if ($pstmt->rowCount() == 0) {
            echo "<tr><td colspan='7'>Nenhuma cerveja encontrada com esses filtros.</td></tr>";
            return;
        }

        while($linha = $pstmt->fetch()){
            $dataExibe = !empty($linha['data']) ? date('d/m/Y', strtotime($linha['data'])) : '-';
            
            echo "<tr>";
            echo "<td>" . $linha['nome'] . "</td>";
            echo "<td>" . $linha['tipo'] . "</td>";
            echo "<td>" . $linha['IBU'] . "</td>";
            echo "<td>" . $linha['avaliacao'] . "/10</td>"; 
            echo "<td>" . $dataExibe . "</td>";
            echo "<td>" . $linha['pais'] . "</td>";
            echo "<td><a href='detalhes.php?id=" . $linha['id'] . "'>Ver Mais</a></td>"; 
            echo "</tr>";
        }
    }

    public function rotulosuser(int $idUsuario){
        try{
        $sql = "SELECT c.id, c.rotulo
                FROM cerveja c
                WHERE c.usuario_id = :id AND 
                      rotulo IS NOT NULL AND
                      rotulo != ''
                ORDER BY data DESC";
        $pstmt = $this->conexao->prepare($sql);
        $pstmt->bindValue(':id', $idUsuario, PDO::PARAM_INT);
        $pstmt->execute();

        return $pstmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Erro ao carregar rótulos: " . $e->getMessage();
            return false;
        }
        }
    }




?>