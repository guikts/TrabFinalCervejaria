<?php
function conectar($bd, $usuario, $senha){
    return new PDO("mysql:host=localhost;dbname=$bd;", $usuario, $senha);
}

function encerrar(){
    return null;
}

?>