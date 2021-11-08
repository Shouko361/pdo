<?php

Class Pessoas{

    //Classe privada
    private $pdo;

    //Conexão
    public function __construct($dbname, $host, $user, $pass){

        try{
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$pass);
        }
        catch (PDOException $e){
            echo "Banco de dados nao encontrado".$e -> getMessage();
        }
        catch(Exception $e){
            echo "error:".$e -> getMessage();
        }
        


    }

    //Busca os Dados no Banco de Dados
    public function buscadados(){

        $resp = array();
        $slc = $this->pdo->query("select nome,telefone,email from pessoas order by id");
        $resp = $slc->fetchall(PDO::FETCH_ASSOC);
        return $resp;
    }

    //Cadastra novo usuario
    public function cadastro($nome,$telefone,$email,$profissao,$nascimento,$sexo,$peso,$altura,$nacionalidade){

        //Verifica se ja tem cadastro
        $ver = $this->pdo->prepare("select id from pessoas where email= :e");
        $ver->bindvalue(":e",$email);
        $ver->execute();
        if($ver->rowcount() > 0) //Email ja existe
        {
            return false;
        }
        else //Email não encontrado
        {
            // Cadastra um novo usuario
           $ver = $this->pdo->prepare("insert into pessoas (nome,telefone,email,profissao,nascimento,sexo,peso,altura,nacionalidade) values (:nome,:tel,:email,:prof,:nasc,:s,:p,:a,:nacio)");
            $ver->bindvalue(":nome",$nome);
            $ver->bindvalue(":tel",$telefone);
            $ver->bindvalue(":email",$email);
            $ver->bindvalue(":prof",$profissao);
            $ver->bindvalue(":nasc",$nascimento);
            $ver->bindvalue(":s",$sexo);
            $ver->bindvalue(":p",$peso);
            $ver->bindvalue(":a",$altura);
            $ver->bindvalue(":nacio",$nacionalidade);
            $ver->execute();
            return true;
        }
    }

    //Deleta um usuario
    public function excluir($id){
        $exc = $this->pdo->prepare("delete from pessoas where id = :id");
        $exc->bindvalue(":id",$id);
        $exc->execute();    
    }
}


?>