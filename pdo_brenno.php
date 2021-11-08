<?php

//Conexão
try {
    $pdo = new PDO ('mysql:dbname=cadastro;host=localhost', 'root', 'qwe123@@');
} 
catch (PDOException $e){
    echo "Banco de dados nao encontrado".$e -> getMenssage();
}
catch(Exception $e){
    echo "error:".$e -> getMenssage();
}

//Insert 
//$pdo->query("insert into pessoas(nome, profissao, nascimento, sexo, peso, altura, nacionalidade) values ('PDO', 'faço programa', '2021-01-01', 'M', '87.5', '1.78', 'china');");

//Delete
//$del = $pdo->query("delete from pessoas where id = '14'");

//Update
//$upd = $pdo->query("update pessoas set nome = 'Gabriela' where id = '9'");

//Select 
$slc = $pdo->prepare("select * from pessoas where id = :id");
$slc->bindvalue(":id", 9);
$slc->execute();
$prt = $slc->fetch(PDO::FETCH_ASSOC);
foreach ($prt as $key => $value) {

    echo $key.": ".$value."<br>";

}
?>