<?php
require("pdo.class.php");

$pdo = Database::conexao();

$busca = $pdo->prepare("select * from pessoas;");
$busca->execute();
$dados = $busca->fetch(PDO::FETCH_ASSOC);

echo '<pre>';
while ($linha = $busca->fetch(PDO::FETCH_ASSOC)){
    var_dump($linha);
}   
echo '</pre>';
?> 
